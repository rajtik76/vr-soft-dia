<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blood_sugar_readings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->date('date');
            $table->float('before_breakfast');
            $table->float('after_breakfast');
            $table->float('before_lunch');
            $table->float('after_lunch');
            $table->float('before_dinner');
            $table->float('after_dinner');
            $table->string('note')->nullable();
            $table->timestamps();

            $table->unique(['date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blood_sugar_readings');
    }
};
