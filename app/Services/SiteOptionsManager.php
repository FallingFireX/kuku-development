<?php

namespace App\Services;

use App\Models\SiteOptions;
use Illuminate\Support\Facades\DB;

class SiteOptionsManager extends Service {
    /*
    |--------------------------------------------------------------------------
    | Site Options Manager
    |--------------------------------------------------------------------------
    |
    | Handles creation, modification and usage of site options.
    |
    */

    /**
     * Update or create an option.
     *
     * @param array $data
     *
     * @return \App\Models\SiteOptions|bool
     */
    public function updateOption($data) {
        DB::beginTransaction();

        try {
            $option = SiteOptions::where('key', $data['key'])->first();

            if (!$option) {
                $option = SiteOptions::create([
                    'key'        => $data['key'],
                    'value'      => $data['value'] ?? null,
                ]);
            } else {
                \Log::info('UPDATED INSTEAD:', $data);
                $option->update([
                    'key'   => $data['key'],
                    'value' => $data['value'],
                ]);
                $option->save();
                \Log::info('Option save result:', [$result, $option]);
            }

            return $this->commitReturn($option);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Delete an option.
     *
     * @param array $data
     *
     * @return bool
     */
    public function deleteOption($data) {
        DB::beginTransaction();

        try {
            if (!isset($data['key'])) {
                throw new \Exception('Invalid option selected.');
            }
            $option = SiteOptions::where('key', $data['key'])->first();

            $option->delete();

            return $this->commitReturn(true);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }
}
