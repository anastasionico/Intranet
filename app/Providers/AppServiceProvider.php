<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts/nav' , function($view)
        {
           $view->with('countTasks', \App\Task::countTasks());
           $view->with('countTodayEvent', \App\EventModel::countTodayEvent());
           $view->with('countPendingHoliday', \App\Holiday::countPendingHoliday());
           $view->with('countPendingHolidayRequest', \App\Holiday::countPendingHolidayRequest());
        });
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
}
