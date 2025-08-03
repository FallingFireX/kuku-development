<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Feature\Feature;
use App\Models\Feature\FeatureCategory;
use App\Models\Rarity;
use App\Models\Species\Species;
use App\Models\Species\Subtype;
use App\Services\FeatureService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeatureController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Feature Controller
    |--------------------------------------------------------------------------
    |
    | Creates a route for the traits page, which lists the required trait. Pages are ONLY used when specificed.
    |
    */

    public function getTraitPage($name) {
        $trait = Feature::where('name', $name)->where('is_visible', 1)->first();
        if (!$trait) {
            abort(404);
        }
        if(!$trait->full_page) {
            return redirect()->to('/world/traits?name='.$trait->name);
        }

        return view('designhub.trait', ['trait' => $trait]);
    }

    
}
