<?php

declare(strict_types=1);

namespace App\Http\Controllers\Grid;

use App\Http\Controllers\Controller;
use App\Http\Resources\BloodSugarReadingResource;
use App\Models\BloodSugarReading;
use App\Services\GridHandler;
use Illuminate\Http\JsonResponse;

class BloodSugarReadingsController extends Controller
{
    public function __invoke(GridHandler $handler): JsonResponse
    {
        return response()->json(
            $handler
                ->setResource(BloodSugarReadingResource::class)
                ->setBuilder(BloodSugarReading::query()->where('user_id', auth()->id()))
        );
    }
}
