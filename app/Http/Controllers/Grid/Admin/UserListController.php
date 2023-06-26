<?php

namespace App\Http\Controllers\Grid\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\GridHandler;
use Illuminate\Http\JsonResponse;

class UserListController extends Controller
{
    public function __invoke(GridHandler $handler): JsonResponse
    {
        return response()->json($handler
            ->setResource(UserResource::class)
            ->setBuilder(User::query())
        );
    }
}
