<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodSugarReading extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = ['date' => 'date'];
}
