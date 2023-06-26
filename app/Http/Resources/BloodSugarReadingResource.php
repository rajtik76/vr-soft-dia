<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\BloodSugarReading;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin BloodSugarReading */
class BloodSugarReadingResource extends JsonResource
{
    /**
     * @return array{
     *     id: int,
     *     date: string,
     *     before_breakfast: float,
     *     after_breakfast: float,
     *     before_lunch: float,
     *     after_lunch: float,
     *     before_dinner: float,
     *     after_dinner: float,
     *     note: string | null,
     *     created_at: string,
     *     updated_at: string,
     * }
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date->toDateString(),
            'before_breakfast' => $this->before_breakfast,
            'after_breakfast' => $this->after_breakfast,
            'before_lunch' => $this->before_lunch,
            'after_lunch' => $this->after_lunch,
            'before_dinner' => $this->before_dinner,
            'after_dinner' => $this->after_dinner,
            'note' => $this->note,
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
