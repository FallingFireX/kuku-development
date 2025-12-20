<?php

namespace App\Models\Character;

use App\Facades\Notifications;
use App\Models\Award\Award;
use App\Models\Award\AwardLog;
use App\Models\Base\Base;
use App\Models\Carrier\Carrier;
use App\Models\Currency\Currency;
use App\Models\Currency\CurrencyLog;
use App\Models\Gallery\GalleryCharacter;
use App\Models\Item\Item;
use App\Models\Item\ItemLog;
use App\Models\Level\LevelLog;
use App\Models\Marking\Marking;
use App\Models\Model;
use App\Models\Rarity;
use App\Models\Species\Species;
use App\Models\Species\Subtype;
use App\Models\Stat\CountLog;
use App\Models\Stat\ExpLog;
use App\Models\Stat\Stat;
use App\Models\Stat\StatLog;
use App\Models\Stat\StatTransferLog;
use App\Models\Status\StatusEffect;
use App\Models\Status\StatusEffectLog;
use App\Models\Submission\Submission;
use App\Models\Submission\SubmissionCharacter;
use App\Models\Trade\Trade;
use App\Models\User\User;
use App\Models\User\UserCharacterLog;
use App\Models\WorldExpansion\FactionRankMember;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Settings;

class Character extends Model {
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'character_image_id', 'character_category_id', 'rarity_id', 'user_id',
        'owner_alias', 'number', 'slug', 'description', 'parsed_description',
        'is_sellable', 'is_tradeable', 'is_giftable',
        'sale_value', 'kotm', 'adoption', 'donation', 'transferrable_at', 'is_visible',
        'is_gift_art_allowed', 'is_gift_writing_allowed', 'is_trading', 'sort',
        'is_myo_slot', 'name', 'trade_id', 'is_links_open', 'owner_url',
        'home_id', 'home_changed', 'faction_id', 'faction_changed',
        'character_warning', 'folder_id', 'class_id',
        'genotype', 'phenotype', 'gender', 'eyecolor', 'spd', 'def', 'atk', 'diet', 'bio',
        'base',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'characters';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'transferrable_at' => 'datetime',
        'home_changed'     => 'datetime',
        'faction_changed'  => 'datetime',
    ];

    /**
     * Dates on the model to convert to Carbon instances.
     *
     * @var array
     */
    protected $dates = ['transferrable_at', 'home_changed', 'faction_changed'];

    /**
     * Whether the model contains timestamps to be saved and updated.
     *
     * @var string
     */
    public $timestamps = true;

    /**
     * Accessors to append to the model.
     *
     * @var array
     */
    public $appends = ['is_available'];

    /**
     * Validation rules for character creation.
     *
     * @var array
     */
    public static $createRules = [
        'character_category_id' => 'required',
        'rarity_id'             => 'required',
        'user_id'               => 'nullable',
        'number'                => 'required',
        'slug'                  => 'required|alpha_dash',
        'description'           => 'nullable',
        'sale_value'            => 'nullable|decimal:0,2',
        'image'                 => 'required|mimes:jpeg,jpg,gif,png|max:2048',
        'thumbnail'             => 'nullable|mimes:jpeg,jpg,gif,png|max:2048',
        'owner_url'             => 'url|nullable',
        'base'                  => 'nullable',
    ];

    /**
     * Validation rules for character updating.
     *
     * @var array
     */
    public static $updateRules = [
        'character_category_id' => 'required',
        'number'                => 'required',
        'slug'                  => 'required',
        'description'           => 'nullable',
        'sale_value'            => 'nullable|decimal:0,2',
        'image'                 => 'nullable|mimes:jpeg,jpg,gif,png|max:2048',
        'thumbnail'             => 'nullable|mimes:jpeg,jpg,gif,png|max:2048',
        'base'                  => 'nullable',
    ];

    /**
     * Validation rules for MYO slots.
     *
     * @var array
     */
    public static $myoRules = [
        'rarity_id'   => 'nullable',
        'user_id'     => 'nullable',
        'number'      => 'nullable',
        'slug'        => 'nullable',
        'description' => 'nullable',
        'sale_value'  => 'nullable|decimal:0,2',
        'name'        => 'required',
        'image'       => 'nullable|mimes:jpeg,gif,png|max:2048',
        'thumbnail'   => 'nullable|mimes:jpeg,gif,png|max:2048',
        'base'        => 'nullable',
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the user who owns the character.
     */
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the category the character belongs to.
     */
    public function category() {
        return $this->belongsTo(CharacterCategory::class, 'character_category_id');
    }

    /**
     * Get the masterlist image of the character.
     */
    public function image() {
        return $this->belongsTo(CharacterImage::class, 'character_image_id');
    }

    /**
     * Get all images associated with the character.
     *
     * @param mixed|null $user
     */
    public function images($user = null) {
        return $this->hasMany(CharacterImage::class, 'character_id')->images($user);
    }

    /**
     * Get the user-editable profile data of the character.
     */
    public function profile() {
        return $this->hasOne(CharacterProfile::class, 'character_id');
    }

    /**
     * Get character level.
     */
    public function level() {
        return $this->hasOne(CharacterLevel::class, 'character_id');
    }

    /**
     * Get characters stats.
     */
    public function stats() {
        return $this->hasMany(CharacterStat::class, 'character_id');
    }

    /**
     * Get the character's active design update.
     */
    public function designUpdate() {
        return $this->hasMany(CharacterDesignUpdate::class, 'character_id');
    }

    /**
     * Get the trade this character is attached to.
     */
    public function trade() {
        return $this->belongsTo(Trade::class, 'trade_id');
    }

    /**
     * Get the trade this character is attached to.
     */
    public function home() {
        return $this->belongsTo('App\Models\WorldExpansion\Location', 'home_id');
    }

    /**
     * Get the faction this character is attached to.
     */
    public function faction() {
        return $this->belongsTo('App\Models\WorldExpansion\Faction', 'faction_id');
    }

    /**
     * Get the rarity of this character.
     */
    public function rarity() {
        return $this->belongsTo(Rarity::class, 'rarity_id');
    }

    /**
     * Get the character's associated pets.
     */
    public function pets() {
        return $this->hasMany('App\Models\User\UserPet', 'character_id');
    }

    /**
     * Get the character's associated gear.
     */
    public function gear() {
        return $this->hasMany('App\Models\User\UserGear', 'character_id');
    }

    /**
     * Get the character's associated weapons.
     */
    public function weapons() {
        return $this->hasMany('App\Models\User\UserWeapon', 'character_id');
    }

    /**
     * Gets both the character's gear and weapons.
     * Technically not a relation.
     */
    public function equipment() {
        return $this->hasMany('App\Models\User\UserGear', 'character_id')->get()->concat($this->hasMany('App\Models\User\UserWeapon', 'character_id')->get());
    }

    /**
     * Get the character's associated gallery submissions.
     */
    public function gallerySubmissions() {
        return $this->hasMany(GalleryCharacter::class, 'character_id');
    }

    /**
     * Get the character's items.
     */
    public function items() {
        return $this->belongsToMany(Item::class, 'character_items')->withPivot('count', 'data', 'updated_at', 'id', 'stack_name')->whereNull('character_items.deleted_at');
    }

    /**
     * Get the character's awards.
     */
    public function awards() {
        return $this->belongsToMany('App\Models\Award\Award', 'character_awards')->withPivot('count', 'data', 'updated_at', 'id')->whereNull('character_awards.deleted_at');
    }

    /**
     * Get the lineage of the character.
     */
    public function lineage() {
        return $this->hasOne('App\Models\Character\CharacterLineage', 'character_id');
    }

    /**
     * Get the character's associated breeding permissions.
     */
    public function breedingPermissions() {
        return $this->hasMany('App\Models\Character\BreedingPermission', 'character_id');
    }

    /**
     * Get the character's class.
     */
    public function class() {
        return $this->belongsTo('App\Models\Character\CharacterClass', 'class_id');
    }

    /**
     * Get the character's skills.
     */
    public function skills() {
        return $this->hasMany('App\Models\Character\CharacterSkill', 'character_id');
    }

    /**
     * Gets which folder the character currently resides in.
     */
    public function folder() {
        return $this->belongsTo('App\Models\Character\CharacterFolder', 'folder_id');
    }

    /*
    * Get the links for this character
    */
    public function links() {
        // character id can be in either column
        return $this->hasMany(CharacterRelation::class, 'character_1_id')->orWhere('character_2_id', $this->id);
    }

    /**********************************************************************************************

        SCOPES

    **********************************************************************************************/

    /**
     * Scope a query to only include either characters of MYO slots.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param bool                                  $isMyo
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMyo($query, $isMyo = false) {
        return $query->where('is_myo_slot', $isMyo);
    }

    /**
     * Scope a query to only include visible characters.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed|null                            $user
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisible($query, $user = null) {
        if ($user && $user->hasPower('manage_characters')) {
            return $query;
        }

        return $query->where('is_visible', 1);
    }

    /**
     * Scope a query to only include characters that the owners are interested in trading.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTrading($query) {
        return $query->where('is_trading', 1);
    }

    /**
     * Scope a query to only include characters that can be traded.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTradable($query) {
        return $query->where(function ($query) {
            $query->whereNull('transferrable_at')->orWhere('transferrable_at', '<', Carbon::now());
        })->where(function ($query) {
            $query->where('is_sellable', 1)->orWhere('is_tradeable', 1)->orWhere('is_giftable', 1);
        });
    }

    /**
     * Scope a query to only include characters that have the selected markings.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed                                 $markingIds
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithMarkings($query, $markingIds) {
        return $query->join('character_markings', 'characters.id', '=', 'character_markings.character_id')
            ->whereIn('character_markings.marking_id', $markingIds)
            ->select('characters.*')
            ->distinct();
    }

    /**********************************************************************************************

        ACCESSORS

    **********************************************************************************************/

    /**
     * Get the character's availability for activities/transfer.
     *
     * @return bool
     */
    public function getIsAvailableAttribute() {
        if ($this->designUpdate()->active()->exists()) {
            return false;
        }
        if ($this->trade_id) {
            return false;
        }
        if (CharacterTransfer::active()->where('character_id', $this->id)->exists()) {
            return false;
        }

        return true;
    }

    /**
     * Display the owner's name.
     * If the owner is not a registered user on the site, this displays the owner's dA name.
     *
     * @return string
     */
    public function getDisplayOwnerAttribute() {
        if ($this->user_id) {
            return $this->user->displayName;
        } else {
            return prettyProfileLink($this->owner_url);
        }
    }

    /**
     * Gets the character's code.
     * If this is a MYO slot, it will return the MYO slot's name.
     *
     * @return string
     */
    public function getSlugAttribute() {
        if ($this->is_myo_slot) {
            return $this->name;
        } else {
            return $this->attributes['slug'];
        }
    }

    /**
     * Displays the character's name, linked to their character page.
     *
     * @return string
     */
    public function getDisplayNameAttribute() {
        return '<a href="'.$this->url.'" class="display-character">'.$this->fullName.'</a>';
    }

    /**
     * Displays the character's name, linked to their character page.
     *
     * @return string
     */
    public function getGenotypeAttribute() {
        return $this->genotype;
    }

    /**
     * Displays the character's name, linked to their character page.
     *
     * @return string
     */
    public function getPhenotypeAttribute() {
        return $this->phenotype;
    }

    /**
     * Displays the character's name, linked to their character page.
     *
     * @return string
     */
    public function getGenderAttribute() {
        return $this->gender;
    }

    /**
     * Gets the character's name, including their code and user-assigned name.
     * If this is a MYO slot, simply returns the slot's name.
     *
     * @return string
     */
    public function getFullNameAttribute() {
        if ($this->is_myo_slot) {
            return $this->name;
        } else {
            return ($this->name ? $this->name.' ' : '').preg_replace('/^Kuku-/', '', $this->slug);
        }
    }

    /**
     * Gets the character's warnings, if they exist.
     */
    public function getWarningsAttribute() {
        if (config('lorekeeper.settings.enable_character_content_warnings') && $this->image->content_warnings) {
            return '<i class="fa fa-exclamation-triangle text-danger" data-toggle="tooltip" title="'.implode(', ', $this->image->content_warnings).'"></i> ';
        }

        return null;
    }

    /**
     * Gets the character's page's URL.
     *
     * @return string
     */
    public function getUrlAttribute() {
        if ($this->is_myo_slot) {
            return url('myo/'.$this->id);
        } else {
            return url('character/'.$this->slug);
        }
    }

    /**
     * Gets the character's asset type for asset management.
     *
     * @return string
     */
    public function getAssetTypeAttribute() {
        return 'characters';
    }

    /**
     * Gets the character's log type for log creation.
     *
     * @return string
     */
    public function getLogTypeAttribute() {
        return 'Character';
    }

    /**
     * Gets the character's maximum number of breeding permissions.
     *
     * @return int
     */
    public function getMaxBreedingPermissionsAttribute() {
        $currencies = $this->getCurrencies(true)->where('id', Settings::get('breeding_permission_currency'))->first();
        if (!$currencies) {
            return 0;
        }

        return $currencies->quantity;
    }

    /**
     * Gets the character's number of available breeding permissions.
     *
     * @return int
     */
    public function getAvailableBreedingPermissionsAttribute() {
        return $this->maxBreedingPermissions - $this->breedingPermissions->count();
    }

    /**
     * Gets the character's trading, gift art and gift writing status as badges.
     * If this is a MYO slot, only returns trading status.
     *
     * @return string
     */
    public function getMiniBadgeAttribute() {
        $tradingCode = $this->is_trading ? 'badge-success' : 'badge-danger';
        $tradingSection = "<span class='badge ".$tradingCode."'><i class='fas fa-comments-dollar'></i></span>";
        $nonMyoSection = '';

        if (!$this->is_myo_slot) {
            $artCode = $this->is_gift_art_allowed == 1 ? 'badge-success' : ($this->is_gift_art_allowed == 2 ? 'badge-warning text-light' : 'badge-danger');
            $writingCode = $this->is_gift_writing_allowed == 1 ? 'badge-success' : ($this->is_gift_writing_allowed == 2 ? 'badge-warning text-light' : 'badge-danger');
            $nonMyoSection = "<span class='badge ".$artCode."'><i class='fas fa-pencil-ruler'></i></span> <span class='badge ".$writingCode."'><i class='fas fa-file-alt'></i></span> ";
        }

        return ' ・ <i class="fas fa-info-circle help-icon m-0" data-toggle="tooltip" data-html="true" title="'.$nonMyoSection.$tradingSection.'"></i>';
    }

    public function getHomeSettingAttribute() {
        return intval(Settings::get('WE_character_locations'));
    }

    public function getLocationAttribute() {
        $setting = $this->homeSetting;

        switch ($setting) {
            case 1:
                if (!$this->user) {
                    return null;
                } elseif (!$this->user->home) {
                    return null;
                } else {
                    return $this->user->home->fullDisplayName;
                }

            case 2:
                if (!$this->home) {
                    return null;
                } else {
                    return $this->home->fullDisplayName;
                }

            case 3:
                if (!$this->home) {
                    return null;
                } else {
                    return $this->home->fullDisplayName;
                }

            default:
                return null;
        }
    }

    public function getFactionSettingAttribute() {
        return intval(Settings::get('WE_character_factions'));
    }

    public function getCurrentFactionAttribute() {
        $setting = $this->factionSetting;

        switch ($setting) {
            case 1:
                if (!$this->user) {
                    return null;
                } elseif (!$this->user->faction) {
                    return null;
                } else {
                    return $this->user->faction->fullDisplayName;
                }

            case 2:
                if (!$this->faction) {
                    return null;
                } else {
                    return $this->faction->fullDisplayName;
                }

            case 3:
                if (!$this->faction) {
                    return null;
                } else {
                    return $this->faction->fullDisplayName;
                }

            default:
                return null;
        }
    }

    /**
     * Get character's faction rank.
     */
    public function getFactionRankAttribute() {
        if (!isset($this->faction_id) || !$this->faction->ranks()->count()) {
            return null;
        }
        if (FactionRankMember::where('member_type', 'character')->where('member_id', $this->id)->first()) {
            return FactionRankMember::where('member_type', 'character')->where('member_id', $this->id)->first()->rank;
        }
        if ($this->faction->ranks()->where('is_open', 1)->count()) {
            $standing = $this->getCurrencies(true)->where('id', Settings::get('WE_faction_currency'))->first();
            if (!$standing) {
                return $this->faction->ranks()->where('is_open', 1)->where('breakpoint', 0)->first();
            }

            return $this->faction->ranks()->where('is_open', 1)->where('breakpoint', '<=', $standing->quantity)->orderBy('breakpoint', 'DESC')->first();
        }
    }

    /**********************************************************************************************

        OTHER FUNCTIONS

    **********************************************************************************************/

    /**
     * Checks if the character's owner has registered on the site and updates ownership accordingly.
     */
    public function updateOwner() {
        // Return if the character has an owner on the site already.
        if ($this->user_id) {
            return;
        }

        // Check if the owner has an account and update the character's user ID for them.
        $owner = checkAlias($this->owner_url);
        if (is_object($owner)) {
            $this->user_id = $owner->id;
            $this->owner_url = null;
            $this->save();

            $owner->settings->is_fto = 0;
            $owner->settings->save();
        }
    }

    /**
     * Get the character's held currencies.
     *
     * @param bool $showAll
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCurrencies($showAll = false) {
        // Get a list of currencies that need to be displayed
        // On profile: only ones marked is_displayed
        // In bank: ones marked is_displayed + the ones the user has

        $owned = CharacterCurrency::where('character_id', $this->id)->pluck('quantity', 'currency_id')->toArray();

        $currencies = Currency::where('is_character_owned', 1);
        if ($showAll) {
            $currencies->where(function ($query) use ($owned) {
                $query->where('is_displayed', 1)->orWhereIn('id', array_keys($owned));
            });
        } else {
            $currencies = $currencies->where('is_displayed', 1);
        }

        $currencies = $currencies->orderBy('sort_character', 'DESC')->get();

        foreach ($currencies as $currency) {
            $currency->quantity = $owned[$currency->id] ?? 0;
        }

        return $currencies;
    }

    /**
     * Get the character's exp logs.
     *
     * @param int $limit
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection
     */
    public function getExpLogs($limit = 10) {
        $character = $this;
        $query = ExpLog::where(function ($query) use ($character) {
            $query->with('sender')->where('sender_type', 'Character')->where('sender_id', $character->id)->whereNotIn('log_type', ['Staff Grant', 'Prompt Rewards', 'Claim Rewards']);
        })->orWhere(function ($query) use ($character) {
            $query->with('recipient')->where('recipient_type', 'Character')->where('recipient_id', $character->id)->where('log_type', '!=', 'Staff Removal');
        })->orderBy('id', 'DESC');
        if ($limit) {
            return $query->take($limit)->get();
        } else {
            return $query->paginate(30);
        }
    }

    /**
     * Get the character's stat logs.
     *
     * @param int $limit
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection
     */
    public function getStatTransferLogs($limit = 10) {
        $character = $this;
        $query = StatTransferLog::where(function ($query) use ($character) {
            $query->with('sender')->where('sender_type', 'Character')->where('sender_id', $character->id);
        })->orWhere(function ($query) use ($character) {
            $query->with('recipient')->where('recipient_type', 'Character')->where('recipient_id', $character->id);
        })->orderBy('id', 'DESC');

        if ($limit) {
            return $query->take($limit)->get();
        } else {
            return $query->paginate(30);
        }
    }

    /**
     * Get the character's stat logs.
     *
     * @param int $limit
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection
     */
    public function getStatLevelLogs($limit = 10) {
        $character = $this;
        $query = StatLog::where('leveller_type', 'Character')->where('recipient_id', $character->id)->orderBy('id', 'DESC');

        if ($limit) {
            return $query->take($limit)->get();
        } else {
            return $query->paginate(30);
        }
    }

    /**
     * Get the character's level logs.
     *
     * @param int $limit
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection
     */
    public function getLevelLogs($limit = 10) {
        $character = $this;
        $query = LevelLog::where(function ($query) use ($character) {
            $query->with('recipient')->where('leveller_type', 'Character')->where('recipient_id', $character->id);
        })->orderBy('id', 'DESC');
        if ($limit) {
            return $query->take($limit)->get();
        } else {
            return $query->paginate(30);
        }
    }

    /**
     * Get the character's stat count logs.
     *
     * @param int $limit
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection
     */
    public function getCountLogs($limit = 10) {
        $character = $this;
        $query = CountLog::where(function ($query) use ($character) {
            $query->with('sender')->where('sender_type', 'Character')->where('sender_id', $character->id)->whereNotIn('log_type', ['Staff Grant', 'Prompt Rewards', 'Claim Rewards']);
        })->orWhere(function ($query) use ($character) {
            $query->where('character_id', $character->id)->where('log_type', '!=', 'Staff Removal');
        })->orderBy('id', 'DESC');
        if ($limit) {
            return $query->take($limit)->get();
        } else {
            return $query->paginate(30);
        }
    }

    /**
     * Get the character's held currencies as an array for select inputs.
     *
     * @return array
     */
    public function getCurrencySelect() {
        return CharacterCurrency::where('character_id', $this->id)->leftJoin('currencies', 'character_currencies.currency_id', '=', 'currencies.id')->orderBy('currencies.sort_character', 'DESC')->get()->pluck('name_with_quantity', 'currency_id')->toArray();
    }

    /**
     * Get the character's current status effects.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getStatusEffects() {
        // Get a list of status effects that need to be displayed

        $owned = CharacterStatusEffect::where('character_id', $this->id)->pluck('quantity', 'status_effect_id')->toArray();

        $statuses = StatusEffect::query();

        $statuses = $statuses->orderBy('name', 'DESC')->get();

        foreach ($statuses as $status) {
            $status->quantity = $owned[$status->id] ?? 0;
        }

        $statuses = $statuses->filter(function ($status) {
            return $status->quantity > 0;
        });

        return $statuses;
    }

    /**
     * Get the character's currency logs.
     *
     * @param int $limit
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection
     */
    public function getCurrencyLogs($limit = 10) {
        $character = $this;
        $query = CurrencyLog::with('currency')->where(function ($query) use ($character) {
            $query->with('sender.rank')->where('sender_type', 'Character')->where('sender_id', $character->id)->where('log_type', '!=', 'Staff Grant');
        })->orWhere(function ($query) use ($character) {
            $query->with('recipient.rank')->where('recipient_type', 'Character')->where('recipient_id', $character->id)->where('log_type', '!=', 'Staff Removal');
        })->orderBy('id', 'DESC');

        if ($limit) {
            return $query->take($limit)->get();
        } else {
            return $query->paginate(30);
        }
    }

    /**
     * Get the character's status effect logs.
     *
     * @param int $limit
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection
     */
    public function getStatusEffectLogs($limit = 10) {
        $character = $this;
        $query = StatusEffectLog::with('status')->where(function ($query) use ($character) {
            $query->with('recipient.rank')->where('sender_type', 'Character')->where('sender_id', $character->id)->where('log_type', '!=', 'Staff Grant');
        })->orWhere(function ($query) use ($character) {
            $query->with('recipient.rank')->where('recipient_type', 'Character')->where('recipient_id', $character->id)->where('log_type', '!=', 'Staff Removal');
        })->orderBy('id', 'DESC');
        if ($limit) {
            return $query->take($limit)->get();
        } else {
            return $query->paginate(30);
        }
    }

    public function statusEffects() {
        return $this->hasMany(CharacterStatusEffect::class, 'character_id');
    }

    /**
     * Get the character's item logs.
     *
     * @param int $limit
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection
     */
    public function getItemLogs($limit = 10) {
        $character = $this;

        $query = ItemLog::with('item')->where(function ($query) use ($character) {
            $query->with('sender.rank')->where('sender_type', 'Character')->where('sender_id', $character->id)->where('log_type', '!=', 'Staff Grant');
        })->orWhere(function ($query) use ($character) {
            $query->with('recipient.rank')->where('recipient_type', 'Character')->where('recipient_id', $character->id)->where('log_type', '!=', 'Staff Removal');
        })->orderBy('id', 'DESC');

        if ($limit) {
            return $query->take($limit)->get();
        } else {
            return $query->paginate(30);
        }
    }

    /**
     * Get the character's award logs.
     *
     * @param int $limit
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection
     */
    public function getAwardLogs($limit = 10) {
        $character = $this;

        $query = AwardLog::with('award')->where(function ($query) use ($character) {
            $query->with('sender.rank')->where('sender_type', 'Character')->where('sender_id', $character->id)->where('log_type', '!=', 'Staff Grant');
        })->orWhere(function ($query) use ($character) {
            $query->with('recipient.rank')->where('recipient_type', 'Character')->where('recipient_id', $character->id)->where('log_type', '!=', 'Staff Removal');
        })->orderBy('id', 'DESC');

        if ($limit) {
            return $query->take($limit)->get();
        } else {
            return $query->paginate(30);
        }
    }

    /**
     * Get the character's ownership logs.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getOwnershipLogs() {
        $query = UserCharacterLog::with('sender.rank')->with('recipient.rank')->where('character_id', $this->id)->orderBy('id', 'DESC');

        return $query->paginate(30);
    }

    /**
     * Get the character's update logs.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getCharacterLogs() {
        $query = CharacterLog::with('sender.rank')->where('character_id', $this->id)->where('log_type', '!=', 'Skill Awarded')->orderBy('id', 'DESC');

        return $query->paginate(30);
    }

    /**
     * Get the character's update logs.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getCharacterSkillLogs() {
        $query = CharacterLog::with('sender.rank')->where('character_id', $this->id)->where('log_type', 'Skill Awarded')->orderBy('id', 'DESC');

        return $query->paginate(30);
    }

    /**
     * Get submissions that the character has been included in.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getSubmissions() {
        return Submission::with('user.rank')->with('prompt')->where('status', 'Approved')->whereIn('id', SubmissionCharacter::where('character_id', $this->id)->pluck('submission_id')->toArray())->paginate(30);

        // Untested
        // $character = $this;
        // return Submission::where('status', 'Approved')->with(['characters' => function($query) use ($character) {
        //    $query->where('submission_characters.character_id', 1);
        // }])
        // ->whereHas('characters', function($query) use ($character) {
        //    $query->where('submission_characters.character_id', 1);
        // });
        // return Submission::where('status', 'Approved')->where('user_id', $this->id)->orderBy('id', 'DESC')->paginate(30);
    }

    /**
     * Notifies character's bookmarkers in case of a change.
     *
     * @param mixed $type
     */
    public function notifyBookmarkers($type) {
        // Bookmarkers will not be notified if the character is set to not visible
        if ($this->is_visible) {
            $column = null;
            switch ($type) {
                case 'BOOKMARK_TRADING':
                    $column = 'notify_on_trade_status';
                    break;
                case 'BOOKMARK_GIFTS':
                    $column = 'notify_on_gift_art_status';
                    break;
                case 'BOOKMARK_GIFT_WRITING':
                    $column = 'notify_on_gift_writing_status';
                    break;
                case 'BOOKMARK_OWNER':
                    $column = 'notify_on_transfer';
                    break;
                case 'BOOKMARK_IMAGE':
                    $column = 'notify_on_image';
                    break;
            }

            // The owner of the character themselves will not be notified, in the case that
            // they still have a bookmark on the character after it was transferred to them
            $bookmarkers = CharacterBookmark::where('character_id', $this->id)->where('user_id', '!=', $this->user_id);
            if ($column) {
                $bookmarkers = $bookmarkers->where($column, 1);
            }

            $bookmarkers = User::whereIn('id', $bookmarkers->pluck('user_id')->toArray())->get();

            // This may have to be redone more efficiently in the case of large numbers of bookmarkers,
            // but since we're not expecting many users on the site to begin with it should be fine
            foreach ($bookmarkers as $bookmarker) {
                Notifications::create($type, $bookmarker, [
                    'character_url'  => $this->url,
                    'character_name' => $this->fullName,
                ]);
            }
        }
    }

    /**
     * Finds the lineage blacklist level of this character.
     * 0 is no restriction at all
     * 1 is no ancestors but no children
     * 2 is no lineage at all.
     *
     * @param mixed $maxLevel
     *
     * @return int
     */
    public function getLineageBlacklistLevel($maxLevel = 2) {
        return CharacterLineageBlacklist::getBlacklistLevel($this, $maxLevel);
    }

    /**
     * Gets the characters stats, but only those that apply to the character's species / subtype.
     */
    public function getStatsAttribute() {
        $character = $this;
        $stats = Stat::whereHas('limits', function ($query) use ($character) {
            $query->where('species_id', $character->image->species_id)->where('is_subtype', 0);
        })->orWhereHas('limits', function ($query) use ($character) {
            $query->where('species_id', $character->image->subtype_id)->where('is_subtype', 1);
        })->orWhereDoesntHave('limits')->orderBy('name', 'ASC')->get();

        return $this->stats()->whereIn('stat_id', $stats->pluck('id')->toArray())->get();
    }

    /**
     * Propagates stats.
     */
    public function propagateStats() {
        // get all stats where the species limit is the species of the character
        $character = $this;

        // technically, we can propagate all stats, since the above function will only return stats that apply to the character's species
        $stats = Stat::whereHas('limits', function ($query) use ($character) {
            $query->where('species_id', $character->image->species_id)->where('is_subtype', 0);
        })->orWhereHas('limits', function ($query) use ($character) {
            $query->where('species_id', $character->image->subtype_id)->where('is_subtype', 1);
        })->orWhereDoesntHave('limits')->get();

        // prevents running it when unneeded. if there's an error idk lol
        if ($this->stats()->pluck('stat_id')->toArray() != $stats->pluck('id')->toArray()) {
            // we need to do this each time in case a new stat is made. It slows it down but -\(-v-)/-
            foreach ($stats as $stat) {
                if (!$this->stats->where('stat_id', $stat->id)->first()) {
                    // check if stat has a base value that is for this character's species or subtype
                    // subtype takes precedence over species, so check for subtype first
                    $base = null;
                    $base = $stat->hasBaseValue('subtype', $this->image->subtype_id);
                    if (!$base) {
                        $base = $stat->hasBaseValue('species', $this->image->species_id);
                    }

                    $this->stats()->create([
                        'character_id'  => $this->id,
                        'stat_id'       => $stat->id,
                        'count'         => $base ? $base : $stat->base,
                        'current_count' => $base ? $base : $stat->base,
                    ]);
                }
            }

            // Refresh the model instance so that newly created stats are immediately available
            $this->refresh();
        }
    }

    /**
     * Gets total stat count including bonuses etc., without acknowledging current count.
     *
     * @param mixed $stat_id
     */
    public function totalStatCount($stat_id) {
        $stat = $this->stats->where('stat_id', $stat_id)->first();
        $total = $stat->count;
        $total += $this->bonusStatCount($stat_id);

        return $total;
    }

    /**
     * gets the total stat count with current count acknowledgment.
     *
     * @param mixed $stat_id
     */
    public function currentStatCount($stat_id) {
        $stat = $this->stats->where('stat_id', $stat_id)->first();
        $total = $stat->current_count ? $stat->current_count : $stat->count;
        if ($total < 1) {
            return 0; // prevents, for example, hp bonuses from being applied to a character with 0 hp
        }
        $bonusCount = $this->bonusStatCount($stat_id);
        if ($total + $bonusCount > $stat->count + $bonusCount) {
            return $stat->count + $bonusCount;
        } else {
            return $total + $bonusCount;
        }
    }

    /**
     * gets bonus stat count.
     *
     * @param mixed $stat_id
     */
    public function bonusStatCount($stat_id) {
        $total = 0;
        foreach ($this->equipment() as $equipment) {
            if ($equipment->equipment->stats()->where('stat_id', $stat_id)->first()) {
                $total += $equipment->equipment->stats()->where('stat_id', $stat_id)->first()->count;
            }
        }

        return $total;
    }

    /**
     * Gets the equipment that affects a stat.
     *
     * @param mixed $stat_id
     */
    public function getStatEquipment($stat_id) {
        return $this->equipment()->filter(function ($equipment) use ($stat_id) {
            return $equipment->equipment->stats()->where('stat_id', $stat_id)->first();
        });
    }

    public function features() {
        $query = $this
            ->hasMany(CharacterFeature::class, 'character_image_id')->where('character_features.character_type', 'Character')
            ->join('features', 'features.id', '=', 'character_features.feature_id')
            ->leftJoin('feature_categories', 'feature_categories.id', '=', 'features.feature_category_id')
            ->select(['character_features.*', 'features.*', 'character_features.id AS character_feature_id', 'feature_categories.sort']);

        return $query->orderByDesc('sort');
    }

    /**********************************************************************************************

        CHARACTER GENO/PHENO

    **********************************************************************************************/

    /**
     * Gets the final array for the character genome.
     *
     * @return array
     */
    public function getMarkingFinalArray() {
        $markings = CharacterMarking::where('character_id', $this->id)->get();

        if (!$markings->count()) {
            // If no markings, return null
            return null;
        }

        $rendered = [];
        $marksrender = []; // Initialize marksrender array
        foreach ($markings as $marking) {
            $temp = Marking::where('id', $marking->marking_id)->first();
            $rendered['is_chimera'] = $marking->data === null ? 0 : 1;
            $has_multi_bases = false;
            $marking_data = $marking->data ?? 0;
            if ($marking->carrier_id) {
                // Add carriers if needed
                $rendered['carriers'][$marking->carrier_id] = Carrier::where('id', $marking->carrier_id)->pluck('name')->toArray();
            }
            if (str_contains($marking->base_id, '|')) {
                $has_multi_bases = true;
                $multi_bases = explode('|', $marking->base_id);
                $temp_bases = []; // Initialize temp_bases array
                foreach ($multi_bases as $base) {
                    $temp_bases[] = Base::where('id', $base)->pluck('code', 'name')->toArray();
                }
            }
            if ($temp) {
                if ($rendered['is_chimera'] === 1) {
                    $marksrender[$marking_data][$temp->order_in_genome][] = [
                        'marking_id'    => $temp->id,
                        'name'          => $temp->name,
                        'is_dominant'   => $marking->is_dominant,
                        'code'          => $marking->code,
                        'link'          => $temp->getUrlAttribute(),
                        'base_info'     => $has_multi_bases ? $temp_bases : Base::where('id', $marking->base_id)->pluck('code', 'name')->toArray(),
                    ];
                } else {
                    $marksrender[0][$temp->order_in_genome][] = [
                        'marking_id'    => $temp->id,
                        'name'          => $temp->name,
                        'is_dominant'   => $marking->is_dominant,
                        'code'          => $marking->code,
                        'link'          => $temp->getUrlAttribute(),
                        'base_info'     => $has_multi_bases ? $temp_bases : Base::where('id', $marking->base_id)->pluck('code', 'name')->toArray(),
                    ];
                }
            }
        }
        if (!empty($marksrender)) {
            ksort($marksrender);
            $rendered['markings'] = $marksrender;
        } else {
            $rendered['markings'] = [];
        }

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
    /**
     * Gets the phenotype or genotype string for the character genome.
     *
     * @param mixed  $markings
     * @param string $type
     *
     * @return string
     */
    public function getMarkingLinkedArray($markings, $type = 'phenotype') {
        $bases = $this->getBaseCoat();

        // Handle characters with no markings
        if ($markings === null || count($markings) < 1) {
            if (count($bases) > 1 && array_key_exists(1, $bases)) {
                // Chimera with no markings
                return ($type === 'phenotype')
                    ? $bases[0]['name'].' // '.$bases[1]['name']
                    : $bases[0]['code'].'//'.$bases[1]['code'].'/';
            } else {
                // Single base
                if ($type === 'phenotype') {
                    return $bases[0]['name'] ?? $bases['name'];
                } else {
                    return ($bases[0]['code'] ?? $bases['code']).'/';
                }
            }
        }

        // Validate markings array structure
        if (!is_array($markings) || !array_key_exists('markings', $markings)) {
            return 'Unknown';
        }

        $geno_sides = [];

        // Handle each side (primary/secondary)
        foreach ($markings['markings'] as $side => $group) {
            $sideInner = $this->handleMarkingGroup($group, $type);
            $geno_sides[$side] = $sideInner;

            // Attach base color for that side
            $geno_sides[$side][2] = $bases[$side] ?? $bases[0];
            ksort($geno_sides[$side]);
        }

        // Ensure both sides have a base if chimera
        if (!isset($geno_sides[1]) && isset($bases[1])) {
            $geno_sides[1][2] = $bases[1];
        }
        if (!isset($geno_sides[0]) && isset($bases[0])) {
            $geno_sides[0][2] = $bases[0];
        }

        // Render each side’s final output
        $html_inner = [];
        foreach ($geno_sides as $side) {
            $html_inner[] = $this->renderFinalMarkingOutput($side, $type);
        }

        // Join sides with correct separator
        if (count($html_inner) == 2) {
            $separator = ($type == 'phenotype') ? ' // ' : '//';
            $html_inner = implode($separator, $html_inner);
        } else {
            $html_inner = implode('', $html_inner);
        }

        return $html_inner;
    }

    /**
     * Converts raw markings into structured arrays suitable for rendering.
     *
     * @param mixed $group
     * @param mixed $type
     */
    public function handleMarkingGroup($group, $type = 'phenotype') {
        $result = [];

        foreach ($group as $order => $order_group) {
            foreach ($order_group as $marking) {
                $markingArr = (array) $marking;

                // Ensure we have the ID from CharacterMarking table
                $result[$order][] = [
                    'marking_id' => $markingArr['marking_id'] ?? $markingArr['id'] ?? null,
                    'name'       => $markingArr['name'] ?? 'Unknown',
                    'code'       => $markingArr['code'] ?? '??',
                    'link'       => $markingArr['link'] ?? '#',
                ];
            }
        }

        return $result;
    }

    /**
     * Renders the final phenotype/genotype string for a character’s markings.
     *
     * @param array  $array Array of processed markings + base
     * @param string $type  'phenotype' or 'genotype'
     *
     * @return string
     */
    public function renderFinalMarkingOutput($array, $type = 'phenotype') {
        if (!is_array($array)) {
            return 'Unknown';
        }

        switch ($type) {
            case 'phenotype':
                // Base (index 2 in your data)
                $base = $array[2] ?? ['name' => 'Unknown', 'code' => '??'];
                unset($array[2]);

                $beforeMarkings = [];
                $afterMarkings = [];

                $allMarkings = [];

                // Flatten all marking groups into a single array
                foreach ($array as $group) {
                    if (!is_array($group)) {
                        continue;
                    }
                    foreach ($group as $marking) {
                        $allMarkings[] = $marking;
                    }
                }

                // Separate markings by goes_before_base
                foreach ($allMarkings as $marking) {
                    $markingId = $marking['marking_id'] ?? null;

                    // If no marking_id, try to get it from the id field
                    if (!$markingId && isset($marking['id'])) {
                        $markingId = $marking['id'];
                    }

                    // Skip if we can't identify the marking
                    if (!$markingId) {
                        continue;
                    }

                    $originalMarking = Marking::find($markingId);
                    $goesBefore = $originalMarking && $originalMarking->goes_before_base ? true : false;

                    $name = $marking['name'] ?? 'Unknown';
                    $link = $marking['link'] ?? '#';

                    if ($goesBefore) {
                        // Before base: add 'ed' suffix unless exception
                        $exceptions = ['Candied'];
                        $displayName = in_array($name, $exceptions) ? $name : $name.'ed';
                        $beforeMarkings[] = '<a href="'.$link.'" class="marking-link">'.htmlspecialchars($displayName).'</a>';
                    } else {
                        $afterMarkings[] = '<a href="'.$link.'" class="marking-link">'.htmlspecialchars($name).'</a>';
                    }
                }

                // Format lists with commas and "and"
                $beforeText = $this->formatMarkingList($beforeMarkings);
                $afterText = $this->formatMarkingList($afterMarkings);

                // Construct final string
                $html = '';

                if ($beforeText) {
                    $html .= ucfirst($beforeText).' ';
                }

                $html .= htmlspecialchars($base['name']);

                if ($afterText) {
                    $html .= ' with '.$afterText;
                }

                break;

            case 'genotype':
                // Base first
                $html = is_array($array[2]) ? $array[2]['code'].'/' : $array[2].'/';
                unset($array[2]);

                $before = [];
                $after = [];

                // Flatten and separate
                $allMarkings = [];
                foreach ($array as $group) {
                    if (!is_array($group)) {
                        continue;
                    }
                    foreach ($group as $marking) {
                        $allMarkings[] = $marking;
                    }
                }

                foreach ($allMarkings as $marking) {
                    if (!isset($marking['marking_id'])) {
                        continue;
                    }
                    $originalMarking = Marking::find($marking['marking_id']);
                    $goesBefore = $originalMarking ? $originalMarking->goes_before_base : false;

                    $code = $marking['code'] ?? $marking;
                    if ($goesBefore) {
                        $before[] = $code;
                    } else {
                        $after[] = $code;
                    }
                }

                $html .= implode('/', $before);
                if ($before && $after) {
                    $html .= '/';
                }
                $html .= implode('/', $after);

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
        if (str_contains($this->base, '|')) {
            $chimera_bases = [];
            $bases = explode('|', $this->base);
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

        // If Not Chimera, Continue as normal
        $base = Base::where('id', $this->base)->first();

        if (!$base) {
            return [
                [
                    'name'  => 'Unknown',
                    'code'  => '??',
                ],
            ];
        }

        return [0 => [
            'name'  => $base->name,
            'code'  => $base->code,
        ]];
    }

    /**
     * Helper to format an array of markings with commas and "and".
     */
    private function formatMarkingList(array $markings) {
        $count = count($markings);
        if ($count === 0) {
            return '';
        }
        if ($count === 1) {
            return $markings[0];
        }
        if ($count === 2) {
            return $markings[0].' and '.$markings[1];
        }

        return implode(', ', array_slice($markings, 0, -1)).', and '.end($markings);
    }
}
