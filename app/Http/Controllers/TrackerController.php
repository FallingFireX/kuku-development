<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Character\Character;
use App\Models\Tracker\Tracker;
use App\Services\TrackerManager;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackerController extends Controller {

    /**
     * Shows an individual tracker card.
     *
     * @param mixed $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getTrackerCard($id) {
        $tracker = Tracker::where('id', $id)->first();

        if(!$tracker){
            abort(404);
        }

        return view('tracker.index', [
            'tracker'      => $tracker,
            'cardData'         => $tracker->getDataAttribute(),
        ]);
    }

    /**
     * Shows the page to request an edit to an existing tracker card.
     *
     * @param mixed $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getTrackerCardEditRequest($id) {
        $tracker = Tracker::where('id', $id)->first();

        if(!$tracker){
            abort(404);
        }

        return view('tracker.index_edit', [
            'tracker'      => $tracker,
            'cardData'         => $tracker->getDataAttribute(),
        ]);
    }

}