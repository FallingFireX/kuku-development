<?php

namespace App\Http\Controllers;

use App\Models\SiteOptions;
use App\Models\User\User;
use App\Models\Gallery\GallerySubmission;
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
        $users_character = Auth::user()->characters()->with('image')->visible()->whereNotNull('name')->whereNull('trade_id')->pluck('name', 'id')->toArray();
        $user_galleries = Auth::user()->gallerySubmissions()->where('status', 'Approved')->pluck('title', 'id');

        // Get site options for the XP Calculator
        $xp_calc_form = json_decode(SiteOptions::where('key', 'xp_calculator')->pluck('value')[0]) ?? null;
        $lit_settings = json_decode(SiteOptions::where('key', 'xp_lit_conversion_options')->pluck('value')[0]) ?? null;

        return view('tracker.xp_calc', [
            'users_character'   => $users_character,
            'user_galleries'    => $user_galleries,
            'xp_calc_form'      => $xp_calc_form,
            'lit_settings'      => $lit_settings,
        ]);
    }
}
