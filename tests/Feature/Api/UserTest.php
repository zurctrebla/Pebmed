<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all_users()
    {
        $response = $this->getJson('/users');

        $response->assertStatus(200);
    }

    /**
     * A count feature test users.
     *
     * @return void
     */
    public function test_get_count_users()
    {
        User::factory()->count(100)->create();

        $response = $this->getJson('/users');

        $response->assertJsonCount(100, 'data');

        $response->assertStatus(200);
    }

    /**
     * A not found feature test users.
     *
     * @return void
     */
    public function test_not_found_users()
    {
        $response = $this->getJson('/users/fake_value');

        $response->assertStatus(404);
    }

    /**
     * A found feature test users.
     *
     * @return void
     */
    public function test_get_user()
    {
        $user = User::factory()->create();

        $response = $this->getJson("/users/{$user->uuid}");

        $response->assertStatus(200);
    }

    /**
     * A validations feature test users.
     *
     * @return void
     */
    public function test_validations_create_user()
    {
        $response = $this->postJson('/users', []);

        $response->assertStatus(422);
    }

    /**
     * A create feature test users.
     *
     * @return void
     */
    public function test_create_user()
    {
        $response = $this->postJson('/users', [
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => '12345678'
        ]);

        $response->assertStatus(201);
    }

    /**
     * A create feature test users.
     *
     * @return void
     */
    public function test_validation_update_user()
    {
        $user = User::factory()->create();

        $response = $this->putJson("/users/{$user->uuid}", []);

        $response->assertStatus(422);
    }

    /**
     * A create feature test users.
     *
     * @return void
     */
    public function test_404_update_user()
    {
        $user = User::factory()->create();

        $response = $this->putJson('/users/fake_value', [
                'name' => 'user updated'
        ]);

        $response->assertStatus(404);
    }

    /**
     * A create feature test users.
     *
     * @return void
     */
    public function test_update_user()
    {
        $user = User::factory()->create();

        $response = $this->putJson("/users/{$user->uuid}", [
                'name' => 'user updated'
        ]);

        $response->assertStatus(200);
    }

    /**
     * A create feature test users.
     *
     * @return void
     */
    public function test_404_delete_user()
    {
        $response = $this->deleteJson('/users/fake_value');

        $response->assertStatus(404);
    }

    /**
     * A create feature test users.
     *
     * @return void
     */
    public function test_delete_user()
    {
        $user = User::factory()->create();

        $response = $this->deleteJson("/users/{$user->uuid}");

        $response->assertStatus(204);
    }

}
