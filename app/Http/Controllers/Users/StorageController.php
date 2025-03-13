<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User\UserStorage;
use App\Services\StorageManager;
use Auth;
use Illuminate\Http\Request;

class StorageController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Storage Controller
    |--------------------------------------------------------------------------
    |
    | Handles storage of items and other objects.
    |
    */

    /**
     * Show the safety deposit box.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex(Request $request) {
        $user = Auth::user();

        $query = UserStorage::where('user_id', $user->id);

        $sort = $request->only(['sort']);
        switch ($sort['sort'] ?? null) {
            default: case 'newest':
                $query->orderBy('created_at', 'DESC');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'ASC');
                break;
        }

        $sum = $query->sum('count');

        if ($query->count()) {
            $query = $query->get()->groupBy('storable_type')->transform(function ($item, $k) {
                return $item->groupBy('storable_id');
            })->first();
        }

        return view('home.storage', [
            'storages'  => $query->paginate(30),
            'sum'       => $sum,
        ]);
    }

    /**
     * Withdraws a stack from the storage.
     *
     * @param App\Services\StorageManager $service
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postWithdraw(Request $request, StorageManager $service) {
        $data = $request->only(['remove', 'remove_one', 'remove_all']);
        if ($service->withdrawStack(Auth::user(), $data)) {
            flash('Storage object(s) retrieved successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

        return redirect()->back();
    }
}
