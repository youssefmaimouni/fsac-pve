<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('unique_module_in_filiere', function ($attribute, $value, $parameters, $validator) {
            $filiereId = $parameters[0];
    
            // Vérifier si le nom du module est unique dans la filière spécifiée
            return !DB::table('modules')
                ->where('id_filiere', $filiereId)
                ->where('intitule_module', $value)
                ->exists();
        });
    }
}
