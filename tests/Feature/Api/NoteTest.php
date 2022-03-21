<?php

namespace Tests\Feature\Api;

use App\Models\Note;
use App\Models\Scheduling;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NoteTest extends TestCase
{
    /**
     * Test Get ALL Notes By Scheduling
     *
     * @return void
     */
    public function test_get_all_notes_by_scheduling()
    {
        $scheduling = Scheduling::factory()->create();

        Note::factory()->count(10)->create([
            'scheduling_id' => $scheduling->id
        ]);

        $response = $this->getJson("/schedules/{$scheduling->uuid}/notes");

        $response->assertStatus(200)
                    ->assertJsonCount(10, 'data');
    }

    /**
     * Test Get ALL Notes By Scheduling
     *
     * @return void
     */
    public function test_not_found_notes_by_scheduling()
    {
        $response = $this->getJson('/schedules/fake_value/notes');

        $response->assertStatus(404);
    }

    /**
     * Test Get ALL Notes By Scheduling
     *
     * @return void
     */
    public function test_get_scheduling_by_patient()
    {
        $scheduling = Scheduling::factory()->create();

        $note = Note::factory()->create([
            'scheduling_id' => $scheduling->id
        ]);

        $response = $this->getJson("/schedules/{$scheduling->uuid}/notes/{$note->uuid}");

        $response->assertStatus(200);
    }

    /**
     * Test Get ALL Notes By Scheduling
     *
     * @return void
     */
    public function test_validations_create_note_by_scheduling()
    {
        $scheduling = scheduling::factory()->create();

        $response = $this->postJson("/schedules/{$scheduling->uuid}/notes", []);

        $response->assertStatus(422);
    }

    /**
     * Test Get ALL Schedules By Patient
     *
     * @return void
     */
    public function test_create_note_by_scheduling()
    {
        $scheduling = scheduling::factory()->create();

        $response = $this->postJson("/schedules/{$scheduling->uuid}/notes", [
            'scheduling' => $scheduling->uuid,
            'note' => 'note 01',
        ]);

        $response->assertStatus(201);
    }

    /**
     * Test Get ALL Schedules By Patient
     *
     * @return void
     */
    public function test_validations_update_note_by_scheduling()
    {
        $scheduling = Scheduling::factory()->create();
        $note = Note::factory()->create();

        $response = $this->putJson("/schedules/{$scheduling->uuid}/notes/{$note->uuid}", []);

        $response->assertStatus(422);
    }

    /**
     * Test Get ALL Schedules By Patient
     *
     * @return void
     */
    public function test_update_note_by_scheduling()
    {
        $scheduling = Scheduling::factory()->create();
        $note = Note::factory()->create();

        $response = $this->putJson("/schedules/{$scheduling->uuid}/notes/{$note->uuid}", [
            'scheduling' => $scheduling->uuid,
            'note' => 'note Updated',
        ]);

        $response->assertStatus(200);
    }

    /**
     * Test Get ALL Schedules By Patient
     *
     * @return void
     */
    public function test_notfound_delete_note_by_scheduling()
    {
        $scheduling = scheduling::factory()->create();

        $response = $this->deleteJson("/schedules/{$scheduling->uuid}/notes/fake_note");

        $response->assertStatus(404);
    }

    /**
     * Test Get ALL Schedules By Patient
     *
     * @return void
     */
    public function test_delete_note_by_scheduling()
    {
        $scheduling = Scheduling::factory()->create();
        $note = Note::factory()->create();

        $response = $this->deleteJson("/schedules/{$scheduling->uuid}/notes/{$note->uuid}");

        $response->assertStatus(204);
    }


}
