<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\BloodSugarReading;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
use Symfony\Component\HttpFoundation\Request;

/**
 * @property-read BloodSugarReading $bloodSugarReading
 * @property-read float $before_breakfast
 * @property-read float $after_breakfast
 * @property-read float $before_lunch
 * @property-read float $after_lunch
 * @property-read float $before_dinner
 * @property-read float $after_dinner
 */
class BloodSugarReadingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'date' => ['required', 'date', Rule::unique('blood_sugar_readings', 'date')->ignore($this->bloodSugarReading?->id)],
            'before_breakfast' => ['numeric', 'min:0'],
            'after_breakfast' => ['numeric', 'min:0'],
            'before_lunch' => ['numeric', 'min:0'],
            'after_lunch' => ['numeric', 'min:0'],
            'before_dinner' => ['numeric', 'min:0'],
            'after_dinner' => ['numeric', 'min:0'],
            'note' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                $validated = $validator->validated();
                Arr::pull($validated, 'note');
                Arr::pull($validated, 'date');
                $sum = array_sum($validated);
                if ($sum === 0) {
                    $validator->errors()->add(
                        'before_breakfast',
                        trans('validation.custom.before_breakfast.sum')
                    );
                }
            },
        ];
    }

    public function authorize(): bool
    {
        return $this->isMethod(Request::METHOD_POST) || auth()->user()->can('update', $this->bloodSugarReading);
    }
}
