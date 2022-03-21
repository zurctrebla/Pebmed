<?php

namespace App\Observers;

use App\Models\Patient;
use Illuminate\Support\Str;

class PatientObserve
{
    /**
     * Handle the Patient "creating" event.
     *
     * @param  \App\Models\Patient  $patient
     * @return void
     */
    public function creating(Patient $patient)
    {
        $patient->uuid = Str::uuid();
    }

    /**
     * Handle the Patient "updated" event.
     *
     * @param  \App\Models\Patient  $patient
     * @return void
     */
    public function updated(Patient $patient)
    {
        //
    }

    /**
     * Handle the Patient "deleted" event.
     *
     * @param  \App\Models\Patient  $patient
     * @return void
     */
    public function deleted(Patient $patient)
    {
        //
    }

    /**
     * Handle the Patient "restored" event.
     *
     * @param  \App\Models\Patient  $patient
     * @return void
     */
    public function restored(Patient $patient)
    {
        //
    }

    /**
     * Handle the Patient "force deleted" event.
     *
     * @param  \App\Models\Patient  $patient
     * @return void
     */
    public function forceDeleted(Patient $patient)
    {
        //
    }
}
