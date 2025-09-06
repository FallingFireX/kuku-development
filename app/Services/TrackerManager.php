<?php

namespace App\Services;

use App\Facades\Notifications;
use App\Facades\Settings;
use App\Models\Tracker\Tracker;
use App\Models\User\User;
use Carbon\Carbon;
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
                'user_id'       => $user->id,
                'character_id'  => $data['character_id'],
                'gallery_id'    => $data['gallery_id'] ?? null,
                'url'           => $data['url'] ?? null,
                'status'        => $isDraft ? 'Draft' : 'Pending',
                'comments'      => $data['comments'],
                'data'          => null,
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
                    'tracker_id'    => $tracker->id,
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
     */
    public function updateTrackerSettings($data) {
        try {
            if (!$data) {
                throw new \Exception('Invalid data, something went wrong.');
            }

            if (isset($data['level_name'])) {
                $i = 0;
                foreach ($data['level_name'] as $name) {
                    if ($name !== null && $data['level_threshold'][$i] !== null) {
                        $levels[$name] = $data['level_threshold'][$i];
                        $i++;
                    }
                }

                $manager = new SiteOptionsManager();
                $manager->updateOption([
                    'key'   => 'xp_levels',
                    'value' => json_encode($levels) ?? null,
                ]);

                //Unset these after updating so we can update the calculator array
                unset($data['level_name']);
                unset($data['level_threshold']);
            }
            if (isset($data['word_count_conversion_rate'])) {
                //Set up the word count conversion rate
                $manager = new SiteOptionsManager();
                $manager->updateOption([
                    'key'   => 'xp_lit_conversion_options',
                    'value' => json_encode([
                        'conversion_rate' => $data['word_count_conversion_rate'],
                        'round_to'        => $data['round_to'],
                    ]),
                ]);

                //Unset after updating
                unset($data['word_count_conversion_rate']);
                unset($data['round_to']);
            }
            if (isset($data['field_name'])) {
                \Log::info('CALCULATOR DATA:', $data);

                $form_config = [];

                //Set up the parent fields
                $field_id = 0;
                foreach ($data['field_name'] as $field_name) {
                    if ($field_name !== null) {
                        $form_config[$field_id] = [
                            'field_name'        => $field_name,
                            'field_type'        => $data['field_type'][$field_id],
                            'field_description' => $data['field_desc'][$field_id],
                            'field_options'     => [],
                        ];
                        $field_id++;
                    }
                }
                //Find the children and set them into 'field_options' for their parent
                foreach ($data as $sub_name => $value) {
                    $name_array = explode('_', $sub_name);
                    \Log::info('OPTIONS:', [$sub_name.' - SPLIT: '.print_r($name_array, true)]);
                    // if(count($name_array) > 2) {
                    //     $option_field = $name_array[2]; //ex: label
                    //     $field_group = $name_array[3]; //ex: group_id
                    //     $option_id = $name_array[4]; //ex: option_id

                    //     $rename_fields = [
                    //         'value' => 'point_value',
                    //         'desc'  => 'description',
                    //         'label' => 'label',
                    //     ];

                    //     if($option_field) {
                    //         $form_config[$field_group]['field_options'][$option_id][$rename_fields][$option_field]] = $value;
                    //     }

                    //     unset($data[$sub_name]);
                    // }
                }

                /*
                 * If all turns out right the array should look something like this:
                 * {
                 * "0": {
                 * "field_name": "name",
                 * "field_type": "type",
                 * "field_description": "desc",
                 * "field_options": {
                 * "0": {
                 * "point_value": 0,
                 * "label": "label",
                 * "description": "desc"
                 * }
                 * }
                 * },
                 * "literature": {
                 * "conversion_rate": "cr",
                 * "round_to": 100
                 * }
                 * }
                 */

                \Log::info('FINISHED FORM:', $form_config);
            }
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
