<?php

namespace App\Http\Controllers;

use App\Facades\Settings;
use App\Models\Feature\Feature;
use App\Models\Marking\Marking;
use App\Models\Rarity;
use App\Models\SitePage;
use App\Models\Species\Species;
use App\Models\Species\Subtype;
use Auth;
use Illuminate\Http\Request;

class DesignHubController extends Controller {
    public function getDesignHubPageView() {
        return view('designhub.designhub');
    }

    public function getDesignHubPage(Request $request) {
        $markings = self::getDesignHubGenetics($request);
        $rarities = Rarity::whereIn('id', Marking::select('rarity_id')->distinct()->get())->get();
        $trait_categories = Settings::get('designhub_trait_categories');

        if (str_contains(',', $trait_categories)) {
            $trait_categories = explode(',', $trait_categories);
        }

        return view('designhub.designhub', [
            'dh_start'          => SitePage::where('key', 'dh-start')->first(),
            'dh_end'            => SitePage::where('key', 'dh-end')->first(),
            'specieses'         => Species::orderBy('sort', 'DESC')->get(),
            'subtypes'          => Subtype::orderBy('sort', 'DESC')->get(),
            'markings'          => $markings,
            'rarity_list'       => $rarities,
            'trait_lists'       => self::getDesignHubTraitByCategory($request, $trait_categories),
        ]);
    }

    public function getDesignHubGenetics(Request $request) {
        $query = Marking::query();
        $data = $request->only([
            'name',
            'variant',
        ]);

        return $query->orderBy('name', 'ASC')->paginate(20)->appends($request->query());
    }

    public function getDesignHubTraitByCategory(Request $request, $category_ids) {
        $query = Feature::visible(Auth::check() ? Auth::user() : null)->with('category')->with('rarity')->with('species');
        $data = $request->only(['rarity_id', 'feature_category_id', 'species_id', 'subtype_id', 'name', 'sort']);

        return $query->orderBy('id')->whereIn('feature_category_id', $category_ids)->paginate(20)->appends($request->query());
    }
}
