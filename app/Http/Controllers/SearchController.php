<?php

namespace App\Http\Controllers;

use App\Models\SiteIndex;
use DB;
use Illuminate\Http\Request;

class SearchController extends Controller {
    public function siteSearch(Request $request) {
        $input = $request->input('s');

        $result = SiteIndex::where('title', 'like', '%'.$input.'%')
            ->orWhere('description', 'like', '%'.$input.'%')
            ->limit(25)
            ->get();

        foreach ($result as $r) {
            $url = (new SiteIndex)->findPageUrlStructure($r->type, $r->identifier);
            $row = '<div class="resultrow"><a href="'.$url.'"><div class="title"><span class="badge badge-secondary">'.$r->type.'</span>'.$r->title.'</div></a></div>';
            echo $row;
        }
    }
}
