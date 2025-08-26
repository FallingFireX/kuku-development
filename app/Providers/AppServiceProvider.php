<?php

namespace App\Providers;

use App\Models\Theme;
use App\Providers\Socialite\ToyhouseProvider;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Force MySQL buffered queries immediately
        if (\DB::getDriverName() === 'mysql') {
            \DB::connection()->getPdo()->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        }
    
        Schema::defaultStringLength(191);
        Paginator::defaultView('layouts._pagination');
        Paginator::defaultSimpleView('layouts._simple-pagination');
    
        view()->composer('*', function () {
            $user = Auth::user();
        
            $theme = null;
            $decoratorTheme = null;
        
            if ($user) {
                // Only load relationships if a user is logged in
                $user->loadMissing(['theme', 'decoratorTheme']);
                $theme = $user->theme;
                $decoratorTheme = $user->decoratorTheme;
            }
        
            // Fallback for guests or if user has no theme
            $theme ??= Theme::where('is_default', true)->first();
        
            $conditionalTheme = null;
            if (class_exists('\App\Models\Weather\WeatherSeason')) {
                $conditionalTheme = Theme::where('link_type', 'season')
                    ->where('link_id', Settings::get('site_season'))
                    ->first() ??
                    Theme::where('link_type', 'weather')
                    ->where('link_id', Settings::get('site_weather'))
                    ->first() ??
                    $theme;
            }
        
            View::share('theme', $theme);
            View::share('conditionalTheme', $conditionalTheme);
            View::share('decoratorTheme', $decoratorTheme);
        });
        
        
    
        Collection::macro('paginate', function ($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
    
            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path'     => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });
    
        $this->bootToyhouseSocialite();
    }
    

    /**
     * Boot Toyhouse Socialite provider.
     */
    private function bootToyhouseSocialite() {
        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend(
            'toyhouse',
            function ($app) use ($socialite) {
                $config = $app['config']['services.toyhouse'];

                return $socialite->buildProvider(ToyhouseProvider::class, $config);
            }
        );
    }
}
