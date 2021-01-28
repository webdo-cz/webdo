<?php

namespace App\Providers;

use App\Models\Option;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if(!app()->runningInConsole()) {
            $base = Option::where('group', null)
                ->get()
                ->pluck('value', 'name')
                ->toArray();
            $groups = Option::where('group', '!=' , null)
                ->get()
                ->groupBy('group')
                ->map(function ($pb) { return $pb->keyBy('name'); })
                ->map(function ($pb) { return $pb->pluck('value', 'name'); })
                ->toArray();
            $options = array_merge_recursive($base, $groups);
            config()->set(['option' => $options]);
        }
    }
}
