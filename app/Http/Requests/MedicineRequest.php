<?php

namespace App\Http\Requests;

use App\Models\Medicine;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Request;

/**
 * @property-read Medicine | null $medicine
 */
class MedicineRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('medicines', 'name')->where('user_id', auth()->id())->ignore($this->medicine?->id)
            ]
        ];
    }

    public function authorize(): bool
    {
        return $this->isMethod(Request::METHOD_POST) || auth()->user()->can('update', $this->medicine);
    }
}
