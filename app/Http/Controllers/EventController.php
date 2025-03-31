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

    // External URL or default theme
    $themeUrl = ($page && $page->key === 'fod-2025') 
        ? 'https://www.kukuri-arpg.com/themes/2.css'   // Remote theme
        : $userTheme;

    // Handle external CSS by downloading it locally
    if (filter_var($themeUrl, FILTER_VALIDATE_URL)) {
        // Define local path on the live server
        $localPath = public_path('css/external-theme.css');

        // Download only if the file doesn't exist or is outdated
        if (!File::exists($localPath) || now()->diffInMinutes(File::lastModified($localPath)) > 60) {
            try {
                $response = Http::get($themeUrl);

                if ($response->successful()) {
                    File::put($localPath, $response->body());
                }
            } catch (\Exception $e) {
                \Log::error("Failed to download theme: " . $e->getMessage());
            }
        }

        // Use the local file path in the view
        $themeUrl = 'css/external-theme.css';
    }

    // Pass the local or original theme path
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
