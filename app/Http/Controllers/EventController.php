<?php


namespace App\Http\Controllers;


use Auth;
use db;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SitePage;


class EventController extends Controller
{
    public function getFOD()     
    {
    return view('events.fod');     
    }


    public function getFODindex() 
{
    $userTheme = auth()->user()->theme;
    $page = SitePage::where('key', 'fod-2025')->first();

    // Create an object or array with properties to match the view's expectations
    $theme = (object) [
        'cssUrl' => ($page && $page->key === 'fod-2025') 
            ? 'kukuri-arpg.com.2.css'  // Event theme
            : $userTheme,
        'prioritize_css' => false,  // Example default value
        'has_css' => true,          // Set to true since the theme has CSS
    ];

    return view('events.fod', [ 
        'page' => $page,
        'theme' => $theme
    ]);
}
}
