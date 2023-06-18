<?php

namespace App\Http\Controllers;

use App\Http\Requests\BloodSugarReadingRequest;
use App\Http\Resources\BloodSugarReadingResource;
use App\Models\BloodSugarReading;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Inertia\Response;

class BloodSugarReadingController extends Controller
{
    public function index(): Response
    {
        return inertia('BloodSugarReading/Index');
    }

    public function store(BloodSugarReadingRequest $request): RedirectResponse
    {
        $bloodSugarReading = BloodSugarReading::create(Arr::add($request->validated(), 'user_id', auth()->id()));

        return to_route('bloodSugarReading.index')->withSuccess(trans('alert.blood_sugar_reading.created', ['reading_date' => $bloodSugarReading->date->toDateString()]));
    }

    public function create(): Response
    {
        return inertia('BloodSugarReading/Create', [
            'reading' => BloodSugarReadingResource::make(new BloodSugarReading([
                'date' => now(),
                'before_breakfast' => 0,
                'after_breakfast' => 0,
                'before_lunch' => 0,
                'after_lunch' => 0,
                'before_dinner' => 0,
                'after_dinner' => 0
            ]))
        ]);
    }

    public function edit(BloodSugarReading $bloodSugarReading): Response
    {
        $this->authorize('update', $bloodSugarReading);

        return inertia('BloodSugarReading/Edit', [
            'reading' => BloodSugarReadingResource::make($bloodSugarReading)
        ]);
    }

    public function update(BloodSugarReadingRequest $request, BloodSugarReading $bloodSugarReading): RedirectResponse
    {
        $this->authorize('update', $bloodSugarReading);

        $bloodSugarReading->update($request->validated());

        return to_route('bloodSugarReading.index')->withSuccess(trans('alert.blood_sugar_reading.updated', ['reading_date' => $bloodSugarReading->date->toDateString()]));
    }

    public function destroy(BloodSugarReading $bloodSugarReading): RedirectResponse
    {
        $this->authorize('delete', $bloodSugarReading);

        $readingDate = $bloodSugarReading->date->toDateString();

        $bloodSugarReading->delete();

        return to_route('bloodSugarReading.index')->withSuccess(trans('alert.blood_sugar_reading.deleted', ['reading_date' => $readingDate]));
    }
}
