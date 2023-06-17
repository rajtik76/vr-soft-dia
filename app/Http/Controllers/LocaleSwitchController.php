<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class LocaleSwitchController extends Controller
{
    public function __invoke(string $locale): JsonResponse
    {
        session()->put('locale', $locale);

        return response()->json(['locale' => $locale]);
    }
}
