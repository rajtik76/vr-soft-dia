<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\BloodSugarReading;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class BloodSugarReadingFactory extends Factory
{
    protected $model = BloodSugarReading::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'date' => $this->faker->unique()->date(),
            'before_breakfast' => $this->faker->randomFloat(nbMaxDecimals: 1, max: 25.0),
            'after_breakfast' => $this->faker->randomFloat(nbMaxDecimals: 1, max: 25.0),
            'before_lunch' => $this->faker->randomFloat(nbMaxDecimals: 1, max: 25.0),
            'after_lunch' => $this->faker->randomFloat(nbMaxDecimals: 1, max: 25.0),
            'before_dinner' => $this->faker->randomFloat(nbMaxDecimals: 1, max: 25.0),
            'after_dinner' => $this->faker->randomFloat(nbMaxDecimals: 1, max: 25.0),
            'note' => $this->faker->boolean() ? $this->faker->text() : null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
