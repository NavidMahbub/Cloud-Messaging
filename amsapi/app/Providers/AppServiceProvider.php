<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Http\Resources\Json\Resource;

use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    
    public function boot()
    {
        Schema::defaultStringLength(191);
        Resource::withoutWrapping();
    }

    
    public function register()
    {
        //
    }
}
