<?php

namespace App\Services;

use App\Facades\Notifications;
use App\Facades\Settings;
use App\Models\Tracker\Tracker;
use App\Models\Character\Character;
use App\Models\User\User;
use App\Models\SiteOptions;
use App\Services\SiteOptionsManager;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class TrackerManager extends Service {
    /*
    |--------------------------------------------------------------------------
    | Tracker Manager
    |--------------------------------------------------------------------------
    |
    | Handles creation and modification of submission data.
    |
    */

    /**
     * Creates a new tracker card..
     *
     * @param array                 $data
     * @param \App\Models\User\User $user
     * @param bool                  $isClaim
     * @param mixed                 $isDraft
     *
     * @return mixed
     */
    public function createTrackerCard($data, $user) {
        DB::beginTransaction();

        try {
            if (!isset($data['character_id'])) {
                throw new \Exception('Please select a character.');
            }

            // Create the tracker card itself.
            $tracker = Tracker::create([
                'user_id'   => $user->id,
                'character_id'  => $data['character_id'],
                'gallery_id'    => $data['gallery_id'] ?? null,
                'url'       => $data['url'] ?? null,
                'status'    => $isDraft ? 'Draft' : 'Pending',
                'comments'  => $data['comments'],
                'data'      => null,
            ]);

            return $this->commitReturn($tracker);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Edits an existing tracker card.
     *
     * @param array                 $data
     * @param \App\Models\User\User $user
     * @param bool                  $isClaim
     * @param mixed                 $tracker
     * @param mixed                 $isSubmit
     *
     * @return mixed
     */
    public function editTrackerCard($tracker, $data, $user, $isSubmit = false) {
        DB::beginTransaction();

        try {

            if ($isSubmit) {
                $tracker->update(['status' => 'Pending']);
            }

            // Modify submission
            $tracker->update([
                'url'           => $data['url'] ?? null,
                'updated_at'    => Carbon::now(),
                'comments'      => $data['comments'],
            ]);

            return $this->commitReturn($tracker);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Cancels a tracker card.
     *
     * @param mixed $data the tracker card data
     * @param mixed $user the user performing the cancellation
     */
    public function cancelTrackerCard($data, $user) {
        DB::beginTransaction();

        try {
            // 1. check that the tracker exists
            // 2. check that the tracker is pending
            if (!isset($data['tracker'])) {
                $tracker = Tracker::where('status', 'Pending')->where('id', $data['id'])->first();
            } elseif ($data['tracker']->status == 'Pending') {
                $tracker = $data['tracker'];
            } else {
                $tracker = null;
            }
            if (!$tracker) {
                throw new \Exception('Invalid tracker card.');
            }

            // Set staff comments
            if (isset($data['staff_comments']) && $data['staff_comments']) {
                $data['parsed_staff_comments'] = parse($data['staff_comments']);
            } else {
                $data['parsed_staff_comments'] = null;
            }

            if ($user->id != $tracker->user_id) {
                // The only things we need to set are:
                // 1. staff comment
                // 2. staff ID
                // 3. status
                $tracker->update([
                    'staff_comments'        => $data['staff_comments'],
                    'updated_at'            => Carbon::now(),
                    'staff_id'              => $user->id,
                    'status'                => 'Draft',
                ]);

                Notifications::create('TRACKER_SUBMISSION_CANCELLED', $tracker->user, [
                    'staff_url'     => $user->url,
                    'staff_name'    => $user->name,
                    'tracker_id' => $tracker->id,
                ]);
            } else {
                // This is when a user cancels their own submission back into draft form
                $tracker->update([
                    'status'     => 'Draft',
                    'updated_at' => Carbon::now(),
                ]);
            }

            return $this->commitReturn($tracker);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Rejects a submission.
     *
     * @param array                 $data
     * @param \App\Models\User\User $user
     *
     * @return mixed
     */
    public function rejectTrackerCard($data, $user) {
        DB::beginTransaction();

        try {
            // 1. check that the tracker exists
            // 2. check that the tracker is pending
            if (!isset($data['tracker'])) {
                $tracker = Tracker::where('status', 'Pending')->where('id', $data['id'])->first();
            } elseif ($data['tracker']->status == 'Pending') {
                $tracker = $data['tracker'];
            } else {
                $tracker = null;
            }
            if (!$tracker) {
                throw new \Exception('Invalid tracker card.');
            }

            if (isset($data['staff_comments']) && $data['staff_comments']) {
                $data['parsed_staff_comments'] = parse($data['staff_comments']);
            } else {
                $data['parsed_staff_comments'] = null;
            }

            // The only things we need to set are:
            // 1. staff comment
            // 2. staff ID
            // 3. status
            $tracker->update([
                'staff_comments'        => $data['staff_comments'],
                'staff_id'              => $user->id,
                'status'                => 'Rejected',
            ]);

            Notifications::create('TRACKER_SUBMISSION_REJECTED', $tracker->user, [
                'staff_url'     => $user->url,
                'staff_name'    => $user->name,
                'tracker_id'    => $tracker->id,
            ]);

            if (!$this->logAdminAction($user, 'Tracker Rejected', 'Rejected tracker <a href="'.$tracker->viewurl.'">#'.$tracker->id.'</a>')) {
                throw new \Exception('Failed to log admin action.');
            }

            return $this->commitReturn($tracker);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Approves a submission.
     *
     * @param array                 $data
     * @param \App\Models\User\User $user
     *
     * @return mixed
     */
    public function approveTrackerCard($data, $user) {
        DB::beginTransaction();

        try {
            // 1. check that the tracker exists
            // 2. check that the tracker is pending
            $tracker = Tracker::where('status', 'Pending')->where('id', $data['id'])->first();
            if (!$tracker) {
                throw new \Exception('Invalid tracker card.');
            }

            // Logging data
            $promptLogType = $tracker->prompt_id ? 'Prompt Rewards' : 'Claim Rewards';
            $promptData = [
                'data' => 'Received rewards for '.($tracker->prompt_id ? 'submission' : 'claim').' (<a href="'.$tracker->viewUrl.'">#'.$tracker->id.'</a>)',
            ];

            // Finally, set:
            // 1. staff comments
            // 2. staff ID
            // 3. status
            $tracker->update([
                'staff_comments'        => $data['staff_comments'],
                'staff_id'              => $user->id,
                'status'                => 'Approved',
            ]);

            Notifications::create('TRACKER_SUBMISSION_APPROVED', $tracker->user, [
                'staff_url'     => $user->url,
                'staff_name'    => $user->name,
                'tracker_id'    => $tracker->id,
            ]);

            if (!$this->logAdminAction($user, 'Tracker Approved', 'Approved submission <a href="'.$tracker->viewurl.'">#'.$tracker->id.'</a>')) {
                throw new \Exception('Failed to log admin action.');
            }

            return $this->commitReturn($tracker);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Deletes a submission.
     *
     * @param mixed $data the data of the submission to be deleted
     * @param mixed $user the user performing the deletion
     */
    public function deleteTrackerCard($data, $user) {
        DB::beginTransaction();
        try {
            // 1. check that the tracker exists
            // 2. check that the tracker is a draft
            if (!isset($data['tracker'])) {
                $tracker = Tracker::where('status', 'Draft')->where('id', $data['id'])->first();
            } elseif ($data['tracker']->status == 'Pending') {
                $tracker = $data['tracker'];
            } else {
                $tracker = null;
            }
            if (!$tracker) {
                throw new \Exception('Invalid tracker card.');
            }
            if ($user->id != $tracker->user_id) {
                throw new \Exception('This is not your tracker card.');
            }
            $tracker->delete();

            return $this->commitReturn($tracker);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Updates all of the tracker settings to the site_options table.
     *
     * @param mixed $data the data of the submission to be deleted
     * @param mixed $user the user performing the deletion
     */
    public function updateTrackerSettings($data) {
        try {
            if (!$data) {
                throw new \Exception('Invalid data, something went wrong.');
            }

            if(isset($data['level_name'])) {
                $i = 0;
                foreach($data['level_name'] as $name) {
                    if($name !== null && $data['level_threshold'][$i] !== null) {
                        $levels[$name] = $data['level_threshold'][$i];
                        $i++;
                    }
                }

                $manager = new SiteOptionsManager();
                $manager->updateOption([
                    'key'   => 'xp_levels',
                    'value' => json_encode($levels) ?? null,
                ]);

                // unset($data['level_name']);
                // unset($data['level_threshold']);
            }
            // if(isset($data['option_name'])) {

            // }

        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**************************************************************************************************************
     *
     * PRIVATE FUNCTIONS
     *
     **************************************************************************************************************/

    /**
     * Helper function to remove all empty/zero/falsey values.
     *
     * @param array $value
     *
     * @return array
     */
    private function innerNull($value) {
        return array_values(array_filter($value));
    }

    /**************************************************************************************************************
     *
     * ATTACHMENT FUNCTIONS
     *
     **************************************************************************************************************/

}
