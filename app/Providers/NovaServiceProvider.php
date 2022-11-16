<?php

namespace App\Providers;

use App\Nova\Brand;
use App\Nova\Dashboards\Main;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // Hide Nova's light/dark mode switcher
        // Nova::withoutNotificationCenter();

        $this->getFooterContent();

        $this->getCustomMenu();
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function getFooterContent(): void
    {
        Nova::footer(function ($request) {
            return Blade::render('nova/footer');
        });
    }

    private function getCustomMenu()
    {
        Nova::mainMenu(function(Request $request) {
            return [
                MenuSection::dashboard(Main::class)
                    ->icon('chart-bar')
                    ->withBadge('New', 'success'),

                MenuSection::make('Products', [
                    MenuItem::make('All Products', '/resources/products'),
                    MenuItem::make('Create Product', '/resources/products/new'),
                ])->icon('shopping-bag')->collapsable(),

                Menusection::resource(Brand::class)->icon('tag'),

                MenuSection::make('Users', [
                    MenuItem::make('All Users', '/resources/users'),
                    MenuItem::make('Create User', '/resources/users/new')
                        ->canSee(function(NovaRequest $request) {
                            return $request->user()->is_admin;
                        }),
                ])->icon('users')->collapsable(),

                MenuItem::externalLink('Visit Site', 'https://nova.laravel.com/docs')->openInNewTab()

            ];
        });
    }
}
