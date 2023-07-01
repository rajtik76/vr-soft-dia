<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Medicine;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class MedicineTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    private User $anotherUser;

    public function test_medicine_create(): void
    {
        $response = $this
            ->actingAs($this->user)
            ->post(route('medicine.store'), [
                'name' => 'new-medicine-name',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('medicine');
        $this->assertDatabaseCount('medicines', 1);
        $this->assertDatabaseHas('medicines', [
            'user_id' => $this->user->id,
            'name' => 'new-medicine-name',
        ]);
    }

    public function test_medicine_update(): void
    {
        /** @var Medicine $medicine */
        $medicine = Medicine::factory()->create([
            'user_id' => $this->user->id,
            'name' => 'current-medicine-name',
        ]);

        $response = $this
            ->actingAs($this->user)
            ->patch(route('medicine.update', $medicine->id), [
                'name' => 'new-medicine-name',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('medicine');
        $this->assertDatabaseCount('medicines', 1);
        $this->assertDatabaseHas('medicines', [
            'user_id' => $this->user->id,
            'name' => 'new-medicine-name',
        ]);
    }

    public function test_another_user_medicine_update_fail(): void
    {
        /** @var Medicine $medicine */
        $medicine = Medicine::factory()->create([
            'user_id' => $this->anotherUser->id,
            'name' => 'current-medicine-name',
        ]);

        $response = $this
            ->actingAs($this->user)
            ->patch(route('medicine.update', $medicine->id), [
                'name' => 'new-medicine-name',
            ]);

        $response->assertForbidden();
        $this->assertDatabaseCount('medicines', 1);
        $this->assertDatabaseHas('medicines', [
            'user_id' => $this->anotherUser->id,
            'name' => 'current-medicine-name',
        ]);
    }

    public function test_medicine_delete(): void
    {
        /** @var Medicine $medicine */
        $medicine = Medicine::factory()->create([
            'user_id' => $this->user->id,
            'name' => 'current-medicine-name',
        ]);

        $response = $this
            ->actingAs($this->user)
            ->delete(route('medicine.destroy', $medicine->id));

        $response->assertRedirect('medicine');
        $this->assertDatabaseCount('medicines', 0);
    }

    public function test_another_user_medicine_delete_fail(): void
    {
        /** @var Medicine $medicine */
        $medicine = Medicine::factory()->create([
            'user_id' => $this->anotherUser->id,
            'name' => 'current-medicine-name',
        ]);

        $response = $this
            ->actingAs($this->user)
            ->delete(route('medicine.destroy', $medicine->id));

        $response->assertForbidden();
        $this->assertDatabaseCount('medicines', 1);
        $this->assertDatabaseHas('medicines', [
            'user_id' => $this->anotherUser->id,
            'name' => 'current-medicine-name',
        ]);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->anotherUser = User::factory()->create();
    }
}
