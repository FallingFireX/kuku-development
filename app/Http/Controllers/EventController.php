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

    // Use the on-site file manager CSS path
    $themeUrl = ($page && $page->key === 'fod-2025') 
        ? 'themes/2.css'   // Local file manager theme
        : $userTheme;

    // Pass the theme object to match the theme manager structure
    $theme = (object) [
        'cssUrl' => $themeUrl,
        'prioritize_css' => false,  
        'has_css' => true,          
    ];

    return view('events.fod', [ 
        'page' => $page,
        'theme' => $theme
    ]);
}

}
