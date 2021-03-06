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
            $menu = [];
            if (Auth::user()->role_id == 1) {
                $menu = [
                    ['header' => 'NAVIGASI UTAMA'],
                    [
                        'text'  => 'Pengumuman',
                        'url' => '/pengguna/pengumuman',
                        'icon' => 'fa fa-fw fa-bullhorn',
                        'active' => ['/pengguna/pengumuman']
                    ],
                    [
                        'text'  => 'Biodata',
                        'url' => '/pengguna/biodata',
                        'icon' => 'fa fa-fw fa-users',
                        'active' => ['/pengguna/biodata']
                    ],
                    [
                        'text'  => 'Pembayaran',
                        'url' => '/pengguna/pembayaran',
                        'icon' => 'fa fa-fw fa-money-check-alt',
                        'active' => ['/pengguna/pembayaran']
                    ],
                    [
                        'text'  => 'Pengumpulan',
                        'url' => '/pengguna/submission',
                        'icon' => 'fa fa-fw fa-trophy',
                        'active' => ['/pengguna/submission']
                    ],
                    [
                        'text'  => 'Berkas Dikumpulkan',
                        'url' => '/pengguna/submission/diunggah',
                        'icon' => 'fa fa-fw fa-file-upload',
                        'active' => ['/pengguna/submission/diunggah']
                    ],
                    ['header' => 'PENGATURAN AKUN'],
                    [
                        'text'        => 'Ubah Password',
                        'url'         => '/pengguna/password',
                        'icon'        => 'fa fa-fw fa-lock',
                        'active'      => ['/pengguna/password/*']
                    ]
                ];
            } elseif (Auth::user()->role_id == 2) {
                $menu = [
                    ['header' => 'NAVIGASI UTAMA'],
                    [
                        'text'  => 'Beranda',
                        'url' => '/admin/dashboard',
                        'icon' => 'fa fa-fw fa-home',
                        'active' => ['/admin/dashboard']
                    ],
                    [
                        'text'  => 'Pengumuman',
                        'url' => '/admin/pengumuman',
                        'icon' => 'fa fa-fw fa-bullhorn',
                        'active' => ['/admin/pengumuman']
                    ],
                    [
                        'text'  => 'Pembayaran',
                        'url' => '/admin/pembayaran',
                        'icon' => 'fa fa-fw fa-funnel-dollar',
                        'active' => ['/admin/pembayaran/*', 'admin/peserta/*']
                    ],
                    [
                        'text'  => 'Instruksi',
                        'url' => '/admin/instruksi',
                        'icon' => 'fa fa-fw fa-scroll',
                        'active' => ['/admin/instruksi/*']
                    ],
                    [
                        'text'  => 'Promo',
                        'url' => '/admin/promo',
                        'icon' => 'fa fa-fw fa-ticket-alt',
                        'active' => ['/admin/promo']
                    ],
                    [
                        'text'  => 'Berkas Dikumpulkan',
                        'url' => '/admin/submission',
                        'icon' => 'fa fa-fw fa-file-upload',
                        'active' => ['/admin/submission/*']
                    ],
                    ['header' => 'PENGATURAN AKUN'],
                    [
                        'text'        => 'Ubah Password',
                        'url'         => '/admin/password',
                        'icon'        => 'fa fa-fw fa-lock',
                        'active'      => ['/admin/password/*']
                    ]
                ];
            }


            foreach ($menu as $item) {
                $event->menu->add($item);
            }
        });
    }
}
