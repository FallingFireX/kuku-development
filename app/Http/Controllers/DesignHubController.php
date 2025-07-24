<?php

namespace App\Http\Controllers;

use App\Models\Feature\Feature;
use App\Models\Marking\Marking;
use Auth;
use Illuminate\Http\Request;

class DesignHubController extends Controller {
    public function getDesignHubPageView() {
        return view('designhub.designhub');
    }

    public function getDesignHubPage(Request $request) {

        $markings = DesignHubController::getDesignHubGenetics($request);
        $rarities = Rarity::whereIn('id', Marking::select('rarity_id')->distinct()->get())->get();

        return view('designhub.designhub', [ 
            'markings'      => $markings,
            'rarity_list'   => $rarities,
            'corrupt_mutations' => DesignHubController::getDesignHubTraitByCategory($request, 4), //Swap '4' to the category ID
            'magical_mutations' => DesignHubController::getDesignHubTraitByCategory($request, 5), //Swap '5' to the category ID
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

    public function getDesignHubTraitByCategory(Request $request, $category_id) {
        $query = Feature::visible(Auth::check() ? Auth::user() : null)->with('category')->with('rarity')->with('species');
        $data = $request->only(['rarity_id', 'feature_category_id', 'species_id', 'subtype_id', 'name', 'sort']);

        return $query->orderBy('id')->where('feature_category_id', $category_id)->paginate(20)->appends($request->query());
    }
}
