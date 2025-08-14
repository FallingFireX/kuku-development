<?php

namespace App\Http\Controllers;

use App\Models\SiteOptions;
use App\Models\User\User;
use Illuminate\Support\Facades\Auth;

class XPCalcController extends Controller {
    /**
     * Display the XP Calculator page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getXPCalc() {
        // Check if the user is logged in
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Get the current user's data
        $user = Auth::user();
        $users_character = Auth::user()->characters()->with('image')->visible()->whereNull('trade_id')->get();

        // Get site options for the XP Calculator
        $xp_calc_form = SiteOptions::where('key', 'xp_calc_form')->first() ?? null;

        return view('tracker.xp_calc', [
            'users_character'   => $users_character,
            'xp_calc_form'      => $xp_calc_form,
        ]);
    }
}
