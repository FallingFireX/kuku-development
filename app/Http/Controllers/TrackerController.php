<?php

namespace App\Http\Controllers;

use App\Models\Tracker\Tracker;
use Illuminate\Http\Request;

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

        if (!$tracker) {
            abort(404);
        }

        return view('tracker.index', [
            'tracker'          => $tracker,
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

        if (!$tracker) {
            abort(404);
        }

        return view('tracker.index_edit', [
            'tracker'          => $tracker,
            'cardData'         => $tracker->getDataAttribute(),
        ]);
    }
}
