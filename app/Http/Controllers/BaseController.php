<?php


namespace App\Http\Controllers;


use Auth;
use db;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Base\Base;


class BaseController extends Controller
{

    public function getBasesPageView() {
        return view('designhub.basespage');     
    }


    public function getBasePage(Request $request) {
        return view('designhub.basespage', [ 
            'bases'      => Base::where('is_visible', 1)->get(),
        ]);
    }

}
