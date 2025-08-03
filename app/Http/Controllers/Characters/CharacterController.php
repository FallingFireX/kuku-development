<?php

namespace App\Http\Controllers\Characters;

use App\Facades\Settings;
use App\Http\Controllers\Controller;
use App\Models\Base\Base;
use App\Models\Carrier\Carrier;
use App\Models\Character\Character;
use App\Models\Character\CharacterCurrency;
use App\Models\Character\CharacterItem;
use App\Models\Character\CharacterMarking;
use App\Models\Character\CharacterProfile;
use App\Models\Character\CharacterTransfer;
use App\Models\Currency\Currency;
use App\Models\Gallery\GallerySubmission;
use App\Models\Item\Item;
use App\Models\Item\ItemCategory;
use App\Models\Marking\Marking;
use App\Models\User\User;
use App\Models\User\UserCurrency;
use App\Models\User\UserItem;
use App\Services\CharacterManager;
use App\Services\CurrencyManager;
use App\Services\DesignUpdateManager;
use App\Services\InventoryManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Route;

class CharacterController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Character Controller
    |--------------------------------------------------------------------------
    |
    | Handles displaying and acting on a character.
    |
    */

    /**
     * Create a new controller instance.
     */
    public function __construct() {
        $this->middleware(function ($request, $next) {
            $slug = Route::current()->parameter('slug');
            $query = Character::myo(0)->where('slug', $slug);
            if (!(Auth::check() && Auth::user()->hasPower('manage_characters'))) {
                $query->where('is_visible', 1);
            }
            $this->character = $query->first();
            if (!$this->character) {
                abort(404);
            }

            $this->character->updateOwner();

            if (config('lorekeeper.extensions.previous_and_next_characters.display')) {
                $query = Character::myo(0);
                // Get only characters of this category if pull number is limited to category
                if (config('lorekeeper.settings.character_pull_number') === 'category') {
                    $query->where('character_category_id', $this->character->character_category_id);
                }

                if (!(Auth::check() && Auth::user()->hasPower('manage_characters'))) {
                    $query->where('is_visible', 1);
                }

                // Get the previous and next characters, if they exist
                $prevCharName = null;
                $prevCharUrl = null;
                $nextCharName = null;
                $nextCharUrl = null;

                if ($query->count()) {
                    $characters = $query->orderBy('number', 'DESC')->get();

                    // Filter
                    $lowerChar = $characters->where('number', '<', $this->character->number)->first();
                    $higherChar = $characters->where('number', '>', $this->character->number)->last();
                }

                if (config('lorekeeper.extensions.previous_and_next_characters.reverse') == 0) {
                    $nextCharacter = $lowerChar;
                    $previousCharacter = $higherChar;
                } else {
                    $previousCharacter = $lowerChar;
                    $nextCharacter = $higherChar;
                }

                if (!$previousCharacter || $previousCharacter->id == $this->character->id) {
                    $previousCharacter = null;
                } else {
                    $prevCharName = $previousCharacter->fullName;
                    $prevCharUrl = $previousCharacter->url;
                }

                if (!$nextCharacter || $nextCharacter->id == $this->character->id) {
                    $nextCharacter = null;
                } else {
                    $nextCharName = $nextCharacter->fullName;
                    $nextCharUrl = $nextCharacter->url;
                }

                $extPrevAndNextBtns = ['prevCharName' => $prevCharName, 'prevCharUrl' => $prevCharUrl, 'nextCharName' => $nextCharName, 'nextCharUrl' => $nextCharUrl];
                View::share('extPrevAndNextBtns', $extPrevAndNextBtns);
            }

            return $next($request);
        });
    }

    /**
     * Shows a character's masterlist entry.
     *
     * @param string $slug
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacter($slug) {
        $markings = $this->getMarkingFinalArray();

        return view('character.character', [
            'character'             => $this->character,
            'markings'              => $markings,
            'pheno'                 => $this->getMarkingLinkedArray($markings),
            'geno'                  => $this->getMarkingLinkedArray($markings, 'genotype'),
            'showMention'           => true,
            'extPrevAndNextBtnsUrl' => '',
        ]);
    }

    /**
     * Gets the final array for the character genome.
     *
     * @return array
     */
    public function getMarkingFinalArray() {
        $markings = CharacterMarking::where('character_id', $this->character->id)->get();

        if (!$markings->count()) {
            return [];
        }

        $rendered = [];
        foreach ($markings as $marking) {
            $temp = Marking::where('id', $marking->marking_id)->first();
            $rendered['is_chimera'] = $marking->data === null ? 0 : 1;
            $has_multi_bases = false;
            if ($marking->carrier_id) {
                //Add carriers if needed
                $rendered['carriers'][$marking->carrier_id] = Carrier::where('id', $marking->carrier_id)->pluck('name')->toArray();
            }
            if (str_contains($marking->base_id, '|')) {
                $has_multi_bases = true;
                $multi_bases = explode('|', $marking->base_id);
                foreach ($multi_bases as $base) {
                    $temp_bases[] = Base::where('id', $base)->pluck('code', 'name')->toArray();
                }
            }
            if ($temp) {
                if ($rendered['is_chimera'] === 1) {
                    $marksrender[$marking->data][$temp->order_in_genome][] = [
                        'name'          => $temp->name,
                        'is_dominant'   => $marking->is_dominant,
                        'code'          => $marking->code,
                        'link'          => $temp->getUrlAttribute(),
                        'base_info'     => $has_multi_bases ? $temp_bases : Base::where('id', $marking->base_id)->pluck('code', 'name')->toArray(),
                    ];
                } else {
                    $marksrender[0][$temp->order_in_genome][] = [
                        'name'          => $temp->name,
                        'is_dominant'   => $marking->is_dominant,
                        'code'          => $marking->code,
                        'link'          => $temp->getUrlAttribute(),
                        'base_info'     => $has_multi_bases ? $temp_bases : Base::where('id', $marking->base_id)->pluck('code', 'name')->toArray(),
                    ];
                }
            }
        }
        ksort($marksrender);
        $rendered['markings'] = $marksrender;

        return $rendered;
    }

    /**
     * Gets the phenotype for the character genome.
     *
     * @param mixed $markings
     * @param mixed $type
     *
     * @return string
     */
    public function getMarkingLinkedArray($markings, $type = 'phenotype') {
        $bases = $this->getBaseCoat();
        if (!is_array($markings) || !array_key_exists('markings', $markings)) {
            return 'Unknown';
        }
        $chimera = false;
        if (array_key_exists('is_chimera', $markings) && $markings['is_chimera'] == 1) {
            $chimera = true;
            $geno_sides = [];
        }

        $html_inner = [];

        //return $markings;

        foreach ($markings['markings'] as $side => $group) {
            //Sides - Max of 2 for chimera
            $sideInner = $this->handleMarkingGroup($group, $type);
            $geno_sides[$side] = $sideInner;

            //Get the bases per side
            $geno_sides[$side][2] = $bases;
            ksort($geno_sides[$side]);
        }
        foreach ($geno_sides as $i => $side) {
            $html_inner[] = $this->renderFinalMarkingOutput($side, $type);
        }
        if (count($html_inner) == 2) {
            $seperator = ($type == 'phenotype' ? ' // ' : '//');
            $html_inner = implode($seperator, $html_inner);
        } else {
            $html_inner = implode('', $html_inner);
        }

        return $html_inner;
    }

    public function handleMarkingGroup($group, $type = 'phenotype') {
        $html_inner = [];
        foreach ($group as $id => $order_group) {
            //Inside each order group, we have the markings
            foreach ($order_group as $marking) {
                //Individual markings
                $html_inner[$id][] = $this->renderIndividualMarking($marking, $type);
            }
        }

        return $html_inner;
    }

    /**
     * Gets the individual gene template for the marking string.
     *
     * @param mixed $marking
     * @param mixed $type
     *
     * @return string
     */
    public function renderIndividualMarking($marking, $type = 'phenotype') {
        $marking = (object) $marking;
        $url = $marking->link;

        switch ($type) {
            case 'phenotype':
                $text = $marking->name;
                if ($marking->name == 'Glint') {
                    if ($marking->is_dominant) {
                        $text = array_key_first($marking->base_info[0]).'/'.array_key_first($marking->base_info[1]).' '.$text;
                    } else {
                        $text = array_key_first($marking->base_info).' '.$text;
                    }
                }
                break;
            case 'genotype':
                $text = $marking->code;
                if ($marking->name == 'Glint') {
                    if ($marking->is_dominant) {
                        $text = $text.'-'.array_values($marking->base_info[0])[0].'/'.array_values($marking->base_info[1])[0];
                    } else {
                        $text = $text.'-'.array_values($marking->base_info)[0];
                    }
                }
                break;
            default:
                $text = $marking->name;
        }

        return '<a href="'.$url.'" class="marking-link">'.$text.'</a>';
    }

    /**
     * Gets the genotype for the character genome.
     *
     * @param mixed $array
     * @param mixed $type
     *
     * @return string
     */
    public function renderFinalMarkingOutput($array, $type = 'phenotype') {
        if (!is_array($array)) {
            return 'Unknown';
        }

        switch ($type) {
            case 'phenotype':
                $base = $array[2] ?? 'Unknown';
                unset($array[2]);

                foreach ($array as $order => $marking_group) {
                    foreach ($marking_group as $marking) {
                        if ($order < 2) {
                            $temp[0][] = $marking;
                        } elseif ($order > 2 && $order < 9) {
                            $temp[1][] = $marking;
                        } elseif ($order >= 9) {
                            $temp[2][] = $marking;
                        }
                    }
                }

                $html = implode(' ', $temp[0]).' '.$base[0]['name'];
                if (isset($temp[1]) && count($temp[1]) > 0) {
                    $html .= ' with '.implode(' ', $temp[1]);
                }
                $html .= isset($temp[2]) ? ' and '.implode(' ', $temp[2]) : '';

                break;
            case 'genotype':
                $html = $array[2][0]['code'].'+';
                unset($array[2]);

                foreach ($array as $order => $marking_group) {
                    foreach ($marking_group as $marking) {
                        if ($order < 9) {
                            $temp[0][] = $marking;
                        } elseif ($order >= 9) {
                            $temp[1][] = $marking;
                        }
                    }
                }
                $html .= implode('/', $temp[0]);
                $html .= (array_key_exists(1, $temp) && count($temp[1]) > 0 ? '/'.implode('/', $temp[1]) : '');

                break;
        }

        return '<span class="marking-output">'.$html.'</span>';
    }

    /**
     * Gets the genotype for the character genome.
     *
     * @return array
     */
    public function getBaseCoat() {
        if (str_contains($this->character->base, '|')) {
            $chimera_bases = [];
            $bases = explode('|', $this->character->base);
            if (count($bases) > 1) {
                foreach ($bases as $b) {
                    $temp = Base::where('id', $b)->first();
                    $chimera_bases[] = [
                        'name' => $temp->name,
                        'code' => $temp->code,
                    ];
                }

                return $chimera_bases;
            }
        }

        //If Not Chimera, Continue as normal
        $base = Base::where('id', $this->character->base)->first();

        if (!$base) {
            return [
                'name'  => 'Unknown',
                'code'  => '??',
            ];
        }

        return [0 => [
            'name'  => $base->name,
            'code'  => $base->code,
        ]];
    }

    /**
     * Shows a character's profile.
     *
     * @param string $slug
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterProfile($slug) {
        return view('character.profile', [
            'character'             => $this->character,
            'extPrevAndNextBtnsUrl' => '/profile',
        ]);
    }

    /**
     * Shows a character's edit profile page.
     *
     * @param string $slug
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getEditCharacterProfile($slug) {
        if (!Auth::check()) {
            abort(404);
        }

        $isMod = Auth::user()->hasPower('manage_characters');
        $isOwner = ($this->character->user_id == Auth::user()->id);
        if (!$isMod && !$isOwner) {
            abort(404);
        }

        return view('character.edit_profile', [
            'character' => $this->character,
        ]);
    }

    /**
     * Edits a character's profile.
     *
     * @param App\Services\CharacterManager $service
     * @param string                        $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEditCharacterProfile(Request $request, CharacterManager $service, $slug) {
        if (!Auth::check()) {
            abort(404);
        }

        $isMod = Auth::user()->hasPower('manage_characters');
        $isOwner = ($this->character->user_id == Auth::user()->id);
        if (!$isMod && !$isOwner) {
            abort(404);
        }

        $request->validate(CharacterProfile::$rules);

        if ($service->updateCharacterProfile($request->only(['name', 'link', 'text', 'is_gift_art_allowed', 'is_gift_writing_allowed', 'is_trading', 'alert_user']), $this->character, Auth::user(), !$isOwner)) {
            flash('Profile edited successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

        return redirect()->back();
    }

    /**
     * Shows a character's gallery.
     *
     * @param string $slug
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterGallery(Request $request, $slug) {
        return view('character.gallery', [
            'character'             => $this->character,
            'extPrevAndNextBtnsUrl' => '/gallery',
            'submissions'           => GallerySubmission::whereIn('id', $this->character->gallerySubmissions->pluck('gallery_submission_id')->toArray())->visible(Auth::user() ?? null)->orderBy('created_at', 'DESC')->paginate(20),
        ]);
    }

    /**
     * Shows a character's images.
     *
     * @param string $slug
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterImages($slug) {
        return view('character.images', [
            'user'                  => Auth::check() ? Auth::user() : null,
            'character'             => $this->character,
            'extPrevAndNextBtnsUrl' => '/images',
        ]);
    }

    /**
     * Shows a character's inventory.
     *
     * @param string $slug
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterInventory($slug) {
        $categories = ItemCategory::visible(Auth::check() ? Auth::user() : null)->where('is_character_owned', '1')->orderBy('sort', 'DESC')->get();
        $itemOptions = Item::whereIn('item_category_id', $categories->pluck('id'));

        $items = count($categories) ?
            $this->character->items()
                ->where('count', '>', 0)
                ->orderByRaw('FIELD(item_category_id,'.implode(',', $categories->pluck('id')->toArray()).')')
                ->orderBy('name')
                ->orderBy('updated_at')
                ->get()
                ->groupBy(['item_category_id', 'id']) :
            $this->character->items()
                ->where('count', '>', 0)
                ->orderBy('name')
                ->orderBy('updated_at')
                ->get()
                ->groupBy(['item_category_id', 'id']);

        return view('character.inventory', [
            'character'             => $this->character,
            'extPrevAndNextBtnsUrl' => '/inventory',
            'categories'            => $categories->keyBy('id'),
            'items'                 => $items,
            'logs'                  => $this->character->getItemLogs(),
        ] + (Auth::check() && (Auth::user()->hasPower('edit_inventories') || Auth::user()->id == $this->character->user_id) ? [
            'itemOptions'   => $itemOptions->pluck('name', 'id'),
            'userInventory' => UserItem::with('item')->whereIn('item_id', $itemOptions->pluck('id'))->whereNull('deleted_at')->where('count', '>', '0')->where('user_id', Auth::user()->id)->get()->filter(function ($userItem) {
                return $userItem->isTransferrable == true;
            })->sortBy('item.name'),
            'page'          => 'character',
        ] : []));
    }

    /**
     * Shows a character's bank.
     *
     * @param string $slug
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterBank($slug) {
        $character = $this->character;

        return view('character.bank', [
            'character'             => $this->character,
            'extPrevAndNextBtnsUrl' => '/bank',
            'currencies'            => $character->getCurrencies(true),
            'logs'                  => $this->character->getCurrencyLogs(),
        ] + (Auth::check() && Auth::user()->id == $this->character->user_id ? [
            'takeCurrencyOptions' => Currency::where('allow_character_to_user', 1)->where('is_user_owned', 1)->where('is_character_owned', 1)->whereIn('id', CharacterCurrency::where('character_id', $this->character->id)->pluck('currency_id')->toArray())->orderBy('sort_character', 'DESC')->pluck('name', 'id')->toArray(),
            'giveCurrencyOptions' => Currency::where('allow_user_to_character', 1)->where('is_user_owned', 1)->where('is_character_owned', 1)->whereIn('id', UserCurrency::where('user_id', Auth::user()->id)->pluck('currency_id')->toArray())->orderBy('sort_user', 'DESC')->pluck('name', 'id')->toArray(),

        ] : []) + (Auth::check() && (Auth::user()->hasPower('edit_inventories') || Auth::user()->id == $this->character->user_id) ? [
            'currencyOptions' => Currency::where('is_character_owned', 1)->orderBy('sort_character', 'DESC')->pluck('name', 'id')->toArray(),
        ] : []));
    }

    /**
     * Transfers currency between the user and character.
     *
     * @param App\Services\CharacterManager $service
     * @param string                        $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCurrencyTransfer(Request $request, CurrencyManager $service, $slug) {
        if (!Auth::check()) {
            abort(404);
        }

        $action = $request->get('action');
        $sender = ($action == 'take') ? $this->character : Auth::user();
        $recipient = ($action == 'take') ? Auth::user() : $this->character;

        if ($service->transferCharacterCurrency($sender, $recipient, Currency::where(($action == 'take') ? 'allow_character_to_user' : 'allow_user_to_character', 1)->where('id', $request->get(($action == 'take') ? 'take_currency_id' : 'give_currency_id'))->first(), $request->get('quantity'))) {
            flash('Currency transferred successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

        return redirect()->back();
    }

    /**
     * Handles inventory item processing, including transferring items between the user and character.
     *
     * @param App\Services\CharacterManager $service
     * @param string                        $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postInventoryEdit(Request $request, InventoryManager $service, $slug) {
        if (!Auth::check()) {
            abort(404);
        }
        switch ($request->get('action')) {
            default:
                flash('Invalid action selected.')->error();
                break;
            case 'give':
                $sender = Auth::user();
                $recipient = $this->character;

                if ($service->transferCharacterStack($sender, $recipient, UserItem::find($request->get('stack_id')), $request->get('stack_quantity'), Auth::user())) {
                    flash('Item transferred successfully.')->success();
                } else {
                    foreach ($service->errors()->getMessages()['error'] as $error) {
                        flash($error)->error();
                    }
                }
                break;
            case 'name':
                return $this->postName($request, $service);
                break;
            case 'delete':
                return $this->postDelete($request, $service);
                break;
            case 'take':
                return $this->postItemTransfer($request, $service);
                break;
        }

        return redirect()->back();
    }

    /**
     * Shows a character's currency logs.
     *
     * @param string $slug
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterCurrencyLogs($slug) {
        return view('character.currency_logs', [
            'character'             => $this->character,
            'extPrevAndNextBtnsUrl' => '/currency-logs',
            'logs'                  => $this->character->getCurrencyLogs(0),
        ]);
    }

    /**
     * Shows a character's item logs.
     *
     * @param mixed $slug
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterItemLogs($slug) {
        return view('character.item_logs', [
            'character'             => $this->character,
            'extPrevAndNextBtnsUrl' => '/item-logs',
            'logs'                  => $this->character->getItemLogs(0),
        ]);
    }

    /**
     * Shows a character's ownership logs.
     *
     * @param string $slug
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterOwnershipLogs($slug) {
        return view('character.ownership_logs', [
            'character'             => $this->character,
            'extPrevAndNextBtnsUrl' => '/ownership',
            'logs'                  => $this->character->getOwnershipLogs(0),
        ]);
    }

    /**
     * Shows a character's ownership logs.
     *
     * @param string $slug
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterLogs($slug) {
        return view('character.character_logs', [
            'character'             => $this->character,
            'extPrevAndNextBtnsUrl' => '/change-log',
            'logs'                  => $this->character->getCharacterLogs(),
        ]);
    }

    /**
     * Shows a character's submissions.
     *
     * @param mixed $slug
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterSubmissions($slug) {
        return view('character.submission_logs', [
            'character'             => $this->character,
            'extPrevAndNextBtnsUrl' => '/submissions',
            'logs'                  => $this->character->getSubmissions(),
        ]);
    }

    /**
     * Shows a character's transfer page.
     *
     * @param string $slug
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getTransfer($slug) {
        if (!Auth::check()) {
            abort(404);
        }

        $isMod = Auth::user()->hasPower('manage_characters');
        $isOwner = ($this->character->user_id == Auth::user()->id);
        if (!$isMod && !$isOwner) {
            abort(404);
        }

        return view('character.transfer', [
            'character'      => $this->character,
            'transfer'       => CharacterTransfer::active()->where('character_id', $this->character->id)->first(),
            'cooldown'       => Settings::get('transfer_cooldown'),
            'transfersQueue' => Settings::get('open_transfers_queue'),
            'userOptions'    => User::visible()->orderBy('name')->pluck('name', 'id')->toArray(),
        ]);
    }

    /**
     * Opens a transfer request for a character.
     *
     * @param App\Services\CharacterManager $service
     * @param string                        $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postTransfer(Request $request, CharacterManager $service, $slug) {
        if (!Auth::check()) {
            abort(404);
        }

        if ($service->createTransfer($request->only(['recipient_id', 'user_reason']), $this->character, Auth::user())) {
            flash('Transfer created successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

        return redirect()->back();
    }

    /**
     * Cancels a transfer request for a character.
     *
     * @param App\Services\CharacterManager $service
     * @param string                        $slug
     * @param int                           $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCancelTransfer(Request $request, CharacterManager $service, $slug, $id) {
        if (!Auth::check()) {
            abort(404);
        }

        if ($service->cancelTransfer(['transfer_id' => $id], Auth::user())) {
            flash('Transfer cancelled.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

        return redirect()->back();
    }

    /**
     * Shows a character's design update approval page.
     *
     * @param string $slug
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterApproval($slug) {
        if (!Auth::check() || $this->character->user_id != Auth::user()->id) {
            abort(404);
        }

        return view('character.update_form', [
            'character' => $this->character,
            'queueOpen' => Settings::get('is_design_updates_open'),
            'request'   => $this->character->designUpdate()->active()->first(),
        ]);
    }

    /**
     * Opens a new design update approval request for a character.
     *
     * @param App\Services\DesignUpdateManager $service
     * @param string                           $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCharacterApproval($slug, DesignUpdateManager $service) {
        if (!Auth::check() || $this->character->user_id != Auth::user()->id) {
            abort(404);
        }

        if ($request = $service->createDesignUpdateRequest($this->character, Auth::user())) {
            flash('Successfully created new design update request draft.')->success();

            return redirect()->to($request->url);
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

        return redirect()->back();
    }

    /**
     * Transfers inventory items back to a user.
     *
     * @param App\Services\InventoryManager $service
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function postItemTransfer(Request $request, InventoryManager $service) {
        if ($service->transferCharacterStack($this->character, $this->character->user, CharacterItem::find($request->get('ids')), $request->get('quantities'), Auth::user())) {
            flash('Item transferred successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

        return redirect()->back();
    }

    /**
     * Names an inventory stack.
     *
     * @param App\Services\CharacterManager $service
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function postName(Request $request, InventoryManager $service) {
        $request->validate([
            'stack_name' => 'nullable|max:100',
        ]);

        if ($service->nameStack($this->character, CharacterItem::find($request->get('ids')), $request->get('stack_name'), Auth::user())) {
            flash('Item named successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

        return redirect()->back();
    }

    /**
     * Deletes an inventory stack.
     *
     * @param App\Services\CharacterManager $service
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function postDelete(Request $request, InventoryManager $service) {
        if ($service->deleteStack($this->character, CharacterItem::find($request->get('ids')), $request->get('quantities'), Auth::user())) {
            flash('Item deleted successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

        return redirect()->back();
    }
}
