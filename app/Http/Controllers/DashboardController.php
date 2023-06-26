<?php

namespace App\Http\Controllers;

use App\Http\Resources\MedicineResource;
use App\Models\BloodSugarReading;
use App\Models\Medicine;
use Carbon\Carbon;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(): Response
    {
        /** @var object{date: Carbon, reading: int} | null $lowestReading */
        $lowestReading = BloodSugarReading::where('user_id', auth()->id())
            ->select('date')
            ->selectRaw('LEAST(before_breakfast, after_breakfast, before_lunch, after_lunch, before_dinner, after_dinner) AS reading')
            ->orderBy('reading')
            ->first();

        /** @var object{date: Carbon, reading: int} | null $highestReading */
        $highestReading = BloodSugarReading::where('user_id', auth()->id())
            ->select('date')
            ->selectRaw('GREATEST(before_breakfast, after_breakfast, before_lunch, after_lunch, before_dinner, after_dinner) AS reading')
            ->orderByDesc('reading')
            ->first();

        $chartData = BloodSugarReading::where('user_id', auth()->id())
            ->latest('date')
            ->limit(7)
            ->get();

        return inertia('Dashboard', [
            'medicines' => MedicineResource::collection(Medicine::where('user_id', auth()->id())->get()),
            'lowestReading' => ['date' => $lowestReading?->date->toDateString(), 'reading' => $lowestReading?->reading],
            'highestReading' => ['date' => $highestReading?->date->toDateString(), 'reading' => $highestReading?->reading],
            'chart' => [
                'labels' => $chartData->map(fn (BloodSugarReading $item) => $item->date->toDateString()),
                'beforeBreakfast' => $chartData->map(fn (BloodSugarReading $item) => $item->before_breakfast),
                'afterBreakfast' => $chartData->map(fn (BloodSugarReading $item) => $item->after_breakfast),
                'beforeLunch' => $chartData->map(fn (BloodSugarReading $item) => $item->before_lunch),
                'afterLunch' => $chartData->map(fn (BloodSugarReading $item) => $item->after_lunch),
                'beforeDinner' => $chartData->map(fn (BloodSugarReading $item) => $item->before_dinner),
                'afterDinner' => $chartData->map(fn (BloodSugarReading $item) => $item->after_dinner),
            ],
        ]);
    }
}
