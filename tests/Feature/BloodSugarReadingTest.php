<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\BloodSugarReading;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class BloodSugarReadingTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    private User $anotherUser;

    public function test_blood_sugar_reading_create(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->post(route('bloodSugarReading.store'), [
                'date' => Carbon::create(2000, 2, 2),
                'before_breakfast' => 1.1,
                'after_breakfast' => 2.1,
                'before_lunch' => 1.2,
                'after_lunch' => 2.2,
                'before_dinner' => 1.3,
                'after_dinner' => 2.3,
                'note' => 'current-note',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('bloodSugarReading');
        $this->assertDatabaseCount('blood_sugar_readings', 1);
        $this->assertDatabaseHas('blood_sugar_readings', [
            'user_id' => $this->user->id,
            'date' => Carbon::create(2000, 2, 2),
            'before_breakfast' => 1.1,
            'after_breakfast' => 2.1,
            'before_lunch' => 1.2,
            'after_lunch' => 2.2,
            'before_dinner' => 1.3,
            'after_dinner' => 2.3,
            'note' => 'current-note',
        ]);
    }

    public function test_blood_sugar_reading_update(): void
    {
        /** @var BloodSugarReading $bloodSugarReading */
        $bloodSugarReading = BloodSugarReading::factory()->create([
            'user_id' => $this->user->id,
            'date' => Carbon::create(2000, 2, 2),
            'before_breakfast' => 1.1,
            'after_breakfast' => 2.1,
            'before_lunch' => 1.2,
            'after_lunch' => 2.2,
            'before_dinner' => 1.3,
            'after_dinner' => 2.3,
            'note' => 'current-note',
        ]);

        $response = $this
            ->actingAs($this->user)
            ->patch(route('bloodSugarReading.update', $bloodSugarReading->id), [
                'date' => Carbon::create(2002, 4, 4),
                'before_breakfast' => 3.0,
                'after_breakfast' => 3.5,
                'before_lunch' => 4.0,
                'after_lunch' => 4.5,
                'before_dinner' => 5.0,
                'after_dinner' => 5.5,
                'note' => 'updated-note',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('bloodSugarReading');
        $this->assertDatabaseCount('blood_sugar_readings', 1);
        $this->assertDatabaseHas('blood_sugar_readings', [
            'user_id' => $this->user->id,
            'date' => Carbon::create(2002, 4, 4),
            'before_breakfast' => 3.0,
            'after_breakfast' => 3.5,
            'before_lunch' => 4.0,
            'after_lunch' => 4.5,
            'before_dinner' => 5.0,
            'after_dinner' => 5.5,
            'note' => 'updated-note',
        ]);
    }

    public function test_another_user_blood_sugar_reading_update_fail(): void
    {
        /** @var BloodSugarReading $bloodSugarReading */
        $bloodSugarReading = BloodSugarReading::factory()->create([
            'user_id' => $this->anotherUser->id,
            'date' => Carbon::create(2000, 2, 2),
            'before_breakfast' => 1.1,
            'after_breakfast' => 2.1,
            'before_lunch' => 1.2,
            'after_lunch' => 2.2,
            'before_dinner' => 1.3,
            'after_dinner' => 2.3,
            'note' => 'current-note',
        ]);

        $response = $this
            ->actingAs($this->user)
            ->patch(route('bloodSugarReading.update', $bloodSugarReading->id), [
                'date' => Carbon::create(2002, 4, 4),
                'before_breakfast' => 3.0,
                'after_breakfast' => 3.5,
                'before_lunch' => 4.0,
                'after_lunch' => 4.5,
                'before_dinner' => 5.0,
                'after_dinner' => 5.5,
                'note' => 'updated-note',
            ]);

        $response->assertForbidden();
        $this->assertDatabaseCount('blood_sugar_readings', 1);
        $this->assertDatabaseHas('blood_sugar_readings', [
            'user_id' => $this->anotherUser->id,
            'date' => Carbon::create(2000, 2, 2),
            'before_breakfast' => 1.1,
            'after_breakfast' => 2.1,
            'before_lunch' => 1.2,
            'after_lunch' => 2.2,
            'before_dinner' => 1.3,
            'after_dinner' => 2.3,
            'note' => 'current-note',
        ]);
    }

    public function test_blood_sugar_reading_delete(): void
    {
        /** @var BloodSugarReading $bloodSugarReading */
        $bloodSugarReading = BloodSugarReading::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $response = $this
            ->actingAs($this->user)
            ->delete(route('bloodSugarReading.destroy', $bloodSugarReading->id));

        $response->assertRedirect('bloodSugarReading');
        $this->assertDatabaseCount('blood_sugar_readings', 0);
    }

    public function test_another_user_blood_sugar_reading_delete_fail(): void
    {
        /** @var BloodSugarReading $bloodSugarReading */
        $bloodSugarReading = BloodSugarReading::factory()->create([
            'user_id' => $this->anotherUser->id,
        ]);

        $response = $this
            ->actingAs($this->user)
            ->delete(route('bloodSugarReading.destroy', $bloodSugarReading->id));

        $response->assertForbidden();
        $this->assertDatabaseCount('blood_sugar_readings', 1);
        $this->assertDatabaseHas('blood_sugar_readings', [
            'user_id' => $this->anotherUser->id,
        ]);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->anotherUser = User::factory()->create();
    }
}
