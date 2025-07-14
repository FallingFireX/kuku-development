<?php


namespace App\Http\Controllers;


use Auth;
use db;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rarity;
use App\Models\Marking\Marking;


class MarkingController extends Controller
{

    public function getMarkingPage($slug) {
        $marking = Marking::where('slug', $slug)->where('is_visible', 1)->first();
        if(!$marking) {
            abort(404);
        }

        return view('designhub.marking', ['marking' => $marking]);
    }

}
