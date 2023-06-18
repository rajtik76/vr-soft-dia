<?php

namespace Database\Seeders;

use App\Models\Medicine;
use App\Models\User;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    public function run(): void
    {
        foreach (User::all() as $user) {
            Medicine::factory(4)->create(['user_id' => $user->id]);
        }
    }
}
