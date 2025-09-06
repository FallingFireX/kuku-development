<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Character\Character;
use App\Models\SiteOptions;
use App\Models\Tracker\Tracker;
use App\Services\TrackerManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackerController extends Controller {
    /**
     * Shows the submission index page.
     *
     * @param string $status
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getTrackerIndex(Request $request, $status = null) {
        $trackers = Tracker::with('character')->where('status', $status ? ucfirst($status) : 'Pending')->whereNotNull('character_id');
        $data = $request->only(['character_id', 'sort']);
        if (isset($data['character_id']) && $data['character_id'] != null) {
            $trackers->whereHas('character', function ($query) use ($data) {
                $query->where('character_id', $data['character_id']);
            });
        }
        if (isset($data['sort'])) {
            switch ($data['sort']) {
                case 'newest':
                    $trackers->sortNewest();
                    break;
                case 'oldest':
                    $trackers->sortOldest();
                    break;
            }
        } else {
            $trackers->sortOldest();
        }

        return view('admin.trackers.index', [
            'trackers'      => $trackers->paginate(30),
            //'categories'    => ['none' => 'Any Category'] + PromptCategory::orderBy('sort', 'DESC')->pluck('name', 'id')->toArray(),
        ]);
    }

    /**
     * Shows the submission detail page.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getTrackerCard($id) {
        $tracker = Tracker::whereNotNull('character_id')->where('id', $id)->where('status', '!=', 'Draft')->first();
        if (!$tracker) {
            abort(404);
        }

        return view('admin.trackers.tracker', [
            'tracker'          => $tracker,
            'cardData'         => $tracker->getDataAttribute(),
            'characters'       => Character::visible(Auth::check() ? Auth::user() : null)->myo(0)->orderBy('slug', 'DESC')->get()->pluck('fullName', 'slug')->toArray(),
        ] + ($tracker->status == 'Pending' ? [
        ] : []));
    }

    /**
     * Creates a new submission.
     *
     * @param App\Services\SubmissionManager $service
     * @param int                            $id
     * @param string                         $action
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postTrackerCard(Request $request, SubmissionManager $service, $id, $action) {
        $data = $request->only(['slug',  'character_rewardable_quantity', 'character_rewardable_id',  'character_rewardable_type', 'character_currency_id', 'rewardable_type', 'rewardable_id', 'quantity', 'staff_comments']);
        if ($action == 'reject' && $service->rejectSubmission($request->only(['staff_comments']) + ['id' => $id], Auth::user())) {
            flash('Submission rejected successfully.')->success();
        } elseif ($action == 'cancel' && $service->cancelSubmission($request->only(['staff_comments']) + ['id' => $id], Auth::user())) {
            flash('Submission canceled successfully.')->success();

            return redirect()->to('admin/submissions');
        } elseif ($action == 'approve' && $service->approveSubmission($data + ['id' => $id], Auth::user())) {
            flash('Submission approved successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

        return redirect()->back();
    }

    /**
     * Gets the tracker settings edit page.
     */
    public function getTrackerSettingsPage(Request $request) {
        $options = SiteOptions::where('key', 'LIKE', 'tracker_%')->get();
        $levels = SiteOptions::where('key', 'xp_levels')->pluck('value');
        $lit_settings = json_decode(SiteOptions::where('key', 'xp_lit_conversion_options')->pluck('value'))[0];

        return view('admin.trackers.trackersettings', [
            'all_options'         => $options,
            'levels'              => isset($levels[0]) ? json_decode($levels[0]) : null,
            'xp_data'             => 'test',
            'lit_settings'        => json_decode($lit_settings),
        ]);
    }

    /**
     * Gets the tracker settings edit page.
     *
     * @param App\Services\TrackerManager $service
     */
    public function saveTrackerSettings(Request $request, TrackerManager $service) {
        $data = $request->all();

        if ($data && $service->updateTrackerSettings($data)) {
            flash('Art Tracker settings updated successfully.');
        } else {
            if (isset($service->errors()->getMessages()['error'])) {
                foreach ($service->errors()->getMessages()['error'] as $error) {
                    flash($error)->error();
                }
            }
        }

        return redirect('/admin/tracker-settings');
    }
}
