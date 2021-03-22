<?php

namespace App\Providers;

use App\Acceso;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

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
    public function boot()
    {
        // limit returning the balance to only your dashboard layout
        view()->composer([
            'layouts.master'
        ], function($view) {
            $userbalance = Acceso::orderBy('id', 'ASC')->get();
            //$userbalance = Acceso::where('id_usuario', '=', Auth::user()->id);
            //print_r($userbalance);
            view()->share('modulo', $userbalance);
        });
    }
}
