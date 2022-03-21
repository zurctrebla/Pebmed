<?php

namespace Tests\Feature\Api;

use App\Models\Patient;
use App\Models\Scheduling;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SchedulingTest extends TestCase
{
    /**
     * Test Get ALL Schedules By Patient
     *
     * @return void
     */
    public function test_get_all_schedules_by_patient()
    {
        $patient = Patient::factory()->create();

        Scheduling::factory()->count(10)->create([
            'patient_id' => $patient->id
        ]);

        $response = $this->getJson("/patients/{$patient->uuid}/schedules");

        $response->assertStatus(200)
                    ->assertJsonCount(10, 'data');
    }

    /**
     * Test Get ALL Schedules By Patient
     *
     * @return void
     */
    public function test_notfound_schedules_by_patient()
    {
        $response = $this->getJson('/patients/fake_value/schedules');

        $response->assertStatus(404);
    }

    /**
     * Test Get ALL Schedules By Patient
     *
     * @return void
     */
    public function test_get_scheduling_by_patient()
    {
        $patient = Patient::factory()->create();

        $scheduling = Scheduling::factory()->create([
            'patient_id' => $patient->id
        ]);

        $response = $this->getJson("/patients/{$patient->uuid}/schedules/{$scheduling->uuid}");

        $response->assertStatus(200);
    }

    /**
     * Test Get ALL Schedules By Patient
     *
     * @return void
     */
    public function test_validations_create_scheduling_by_patient()
    {
        $patient = Patient::factory()->create();

        $response = $this->postJson("/patients/{$patient->uuid}/schedules", []);

        $response->assertStatus(422);
    }

    /**
     * Test Get ALL Schedules By Patient
     *
     * @return void
     */
    public function test_create_scheduling_by_patient()
    {
        $patient = Patient::factory()->create();

        $response = $this->postJson("/patients/{$patient->uuid}/schedules", [
            'patient' => $patient->uuid,
            'name' => 'Patient 01',
            'scheduling' => date('YmdHis'),
        ]);

        $response->assertStatus(201);
    }

    /**
     * Test Get ALL Schedules By Patient
     *
     * @return void
     */
    public function test_validations_update_scheduling_by_patient()
    {
        $patient = Patient::factory()->create();
        $scheduling = Scheduling::factory()->create();

        $response = $this->putJson("/patients/{$patient->uuid}/schedules/{$scheduling->uuid}", []);

        $response->assertStatus(422);
    }

    /**
     * Test Get ALL Schedules By Patient
     *
     * @return void
     */
    public function test_update_scheduling_by_patient()
    {
        $patient = Patient::factory()->create();
        $scheduling = Scheduling::factory()->create();

        $response = $this->putJson("/patients/{$patient->uuid}/schedules/{$scheduling->uuid}", [
            'patient' => $patient->uuid,
            'name' => 'Patient Updated',
            'scheduling' => date('YmdHis'),
        ]);

        $response->assertStatus(200);
    }

    /**
     * Test Get ALL Schedules By Patient
     *
     * @return void
     */
    public function test_notfound_delete_scheduling_by_patient()
    {
        $patient = Patient::factory()->create();

        $response = $this->deleteJson("/patients/{$patient->uuid}/schedules/fake_patient");

        $response->assertStatus(404);
    }

    /**
     * Test Get ALL Schedules By Patient
     *
     * @return void
     */
    public function test_delete_scheduling_by_patient()
    {
        $patient = Patient::factory()->create();
        $scheduling = Scheduling::factory()->create();

        $response = $this->deleteJson("/patients/{$patient->uuid}/schedules/{$scheduling->uuid}");

        $response->assertStatus(204);
    }

}
