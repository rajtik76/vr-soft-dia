<?php

namespace Database\Seeders;

use App\Models\BloodSugarReading;
use App\Models\User;
use Illuminate\Database\Seeder;

class BloodSugarReadingSeeder extends Seeder
{
    public function run(): void
    {
        foreach (User::all() as $user) {
            BloodSugarReading::factory(20)->create(['user_id' => $user->id]);
        }
    }
}
