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
        return view('designhub.designhub', [
            'markings'          => self::getDesignHubGenetics($request),
            'corrupt_mutations' => self::getDesignHubTraitByCategory($request, 4),
            'magical_mutations' => self::getDesignHubTraitByCategory($request, 5),
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
