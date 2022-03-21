<?php

namespace Tests\Feature\Api;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PatientTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all_patients_by_user()
    {
        $user = User::factory()->create();

        Patient::factory()->count(10)->create([
            'user_id' => $user->id
        ]);

        $response = $this->getJson("/users/{$user->uuid}/patients");

        $response->assertStatus(200)
                    ->assertJsonCount(10, 'data');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_not_found_patients_by_user()
    {
        $response = $this->getJson('/users/fake_value/patients');

        $response->assertStatus(404);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_patient_by_user()
    {
        $user = User::factory()->create();

        $patient = Patient::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->getJson("/users/{$user->uuid}/patients/{$patient->uuid}");

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_validations_create_patient_by_user()
    {
        $user = User::factory()->create();

        $response = $this->postJson("/users/{$user->uuid}/patients", []);

        $response->assertStatus(422);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_create_module_by_course()
    // {
    //     $user = User::factory()->create();

    //     $response = $this->postJson("/users/{$user->uuid}/patients", [
    //         'user' => $user->uuid,
    //         'name' => 'Patient',
    //     ]);

    //     $response->assertStatus(201);
    // }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_validations_update_patient_by_user()
    {
        $user = User::factory()->create();
        $patient = Patient::factory()->create();

        $response = $this->putJson("/users/{$user->uuid}/patients/{$patient->uuid}", []);

        $response->assertStatus(422);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_update_module_by_course()
    {
        $user = User::factory()->create();
        $patient = Patient::factory()->create();

        $response = $this->putJson("/users/{$user->uuid}/patients/{$patient->uuid}", [
            'user' => $user->uuid,
            'name' => 'Patient Updated',
        ]);

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_notfound_delete_patient_by_user()
    {
        $user = User::factory()->create();

        $response = $this->deleteJson("/users/{$user->uuid}/patients/fake_patient");

        $response->assertStatus(404);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_delete_patient_by_user()
    {
        $user = User::factory()->create();
        $patient = Patient::factory()->create();

        $response = $this->deleteJson("/users/{$user->uuid}/patients/{$patient->uuid}");

        $response->assertStatus(204);
    }

}
