<?php

namespace App\Providers;

use App\Models\{
    Note,
    Patient,
    Scheduling,
    User
};
use App\Observers\NoteObserver;
use App\Observers\PatientObserve;
use App\Observers\SchedulingObserver;
use App\Observers\UserObserver;
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
        User::observe(UserObserver::class);
        Patient::observe(PatientObserve::class);
        Scheduling::observe(SchedulingObserver::class);
        Note::observe(NoteObserver::class);
    }
}
