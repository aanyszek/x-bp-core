<?php
/**
 * Created by PhpStorm.
 * User: aanyszek
 * Date: 10.04.19
 * Time: 15:12
 */

namespace AAnyszek\XBPCore;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;

class PackageServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/x-bp-core.php' => config_path('x-bp-core.php')
        ], 'config');


        $this->mergeConfigFrom(
            __DIR__ . '/config/x-bp-core.php', 'x-bp-core'
        );


        $this->loadViewsFrom(__DIR__ . '/resources/views', 'x-bp-core');

        \View::composer(Config::get('x-bp-core.views', 'backpack::inc.sidebar_content'), function ($view) {
            $menu = Collection::make(Config::get('x-bp-plugins'))
                ->where('show_in_menu', true)
                ->sortBy('order')
                ->groupBy('group');

            $view->with('XBPMenu', \View('x-bp-core::menu-items')->withMenu($menu));
        });

    }
}