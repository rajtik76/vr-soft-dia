<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicineRequest;
use App\Http\Resources\MedicineResource;
use App\Models\Medicine;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Inertia\Response;

class MedicineController extends Controller
{
    public function index(): Response
    {
        return inertia('Medicine/Index');
    }

    public function store(MedicineRequest $request): RedirectResponse
    {
        $medicine = Medicine::create(Arr::add($request->validated(), 'user_id', auth()->id()));

        return to_route('medicine.index')->withSuccess(trans('alert.medicine.created', ['medicine' => $medicine->name]));
    }

    public function create(): Response
    {
        return inertia('Medicine/Create', [
            'medicine' => MedicineResource::make(new Medicine())
        ]);
    }

    public function edit(Medicine $medicine): Response
    {
        return inertia('Medicine/Edit', [
            'medicine' => $medicine
        ]);
    }

    public function update(MedicineRequest $request, Medicine $medicine): RedirectResponse
    {
        $this->authorize('update', $medicine);

        $medicine->update($request->validated());

        return to_route('medicine.index')->withSuccess(trans('alert.medicine.updated', ['medicine' => $medicine->name]));
    }

    public function destroy(Medicine $medicine): RedirectResponse
    {
        $this->authorize('delete', $medicine);

        $medicineName = $medicine->name;
//        $medicine->delete();

        return to_route('medicine.index')->withSuccess(trans('alert.medicine.deleted', ['medicine' => $medicineName]));
    }
}
