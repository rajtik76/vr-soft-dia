<?php

namespace App\Http\Controllers\Grid;

use App\Http\Controllers\Controller;
use App\Http\Resources\MedicineResource;
use App\Models\Medicine;
use App\Services\GridHandler;
use Illuminate\Http\JsonResponse;

class MedicineController extends Controller
{
    public function __invoke(GridHandler $handler): JsonResponse
    {
        return response()->json(
            $handler
                ->setResource(MedicineResource::class)
                ->setBuilder(Medicine::query()->where('user_id', auth()->id()))
        );
    }
}
