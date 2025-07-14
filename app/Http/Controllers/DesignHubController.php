<?php


namespace App\Http\Controllers;


use Auth;
use db;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SitePage;
use App\Models\Rarity;
use App\Models\Marking\Marking;
use App\Models\Feature\FeatureCategory;
use App\Models\Feature\Feature;


class DesignHubController extends Controller
{
    public function getDesignHubPageView() {
        return view('designhub.designhub');     
    }


    public function getDesignHubPage(Request $request) {

    return view('designhub.designhub', [ 
            'markings' => DesignHubController::getDesignHubGenetics($request),
            'corrupt_mutations' => DesignHubController::getDesignHubTraitByCategory($request, 4),
            'magical_mutations' => DesignHubController::getDesignHubTraitByCategory($request, 5),
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
