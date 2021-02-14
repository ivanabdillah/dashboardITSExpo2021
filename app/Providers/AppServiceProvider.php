<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $menu = [
                ['header' => 'main_navigation'],
                [
                    'text'  => 'Biodata',
                    'url' => '/pengguna/biodata',
                    'icon' => 'fa fa-fw fa-users',
                    'active' => ['/pengguna/biodata']
                ],
                ['header' => 'account_settings'],
                [
                    'text'        => 'Ubah Password',
                    'url'         => '/pengguna/password',
                    'icon'        => 'fa fa-fw fa-lock',
                    'active'      => ['/pengguna/password/*']
                ]
            ];

            foreach ($menu as $item) {
                $event->menu->add($item);
            }
        });
    }
}
