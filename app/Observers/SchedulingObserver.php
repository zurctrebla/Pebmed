<?php

namespace App\Observers;

use App\Models\Scheduling;
use Illuminate\Support\Str;

class SchedulingObserver
{
    /**
     * Handle the Scheduling "creating" event.
     *
     * @param  \App\Models\Scheduling  $scheduling
     * @return void
     */
    public function creating(Scheduling $scheduling)
    {
        $scheduling->uuid = Str::uuid();
    }

    /**
     * Handle the Scheduling "updated" event.
     *
     * @param  \App\Models\Scheduling  $scheduling
     * @return void
     */
    public function updated(Scheduling $scheduling)
    {
        //
    }

    /**
     * Handle the Scheduling "deleted" event.
     *
     * @param  \App\Models\Scheduling  $scheduling
     * @return void
     */
    public function deleted(Scheduling $scheduling)
    {
        //
    }

    /**
     * Handle the Scheduling "restored" event.
     *
     * @param  \App\Models\Scheduling  $scheduling
     * @return void
     */
    public function restored(Scheduling $scheduling)
    {
        //
    }

    /**
     * Handle the Scheduling "force deleted" event.
     *
     * @param  \App\Models\Scheduling  $scheduling
     * @return void
     */
    public function forceDeleted(Scheduling $scheduling)
    {
        //
    }
}
