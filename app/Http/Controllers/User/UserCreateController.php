<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCreateRequest;
use App\Repositories\All\User\UserInterface;
use Illuminate\Support\Facades\Hash;

class UserCreateController extends Controller
{
    protected $userInterface;

    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    public function userCreate(UserCreateRequest $request)
    {
        $validated = $request->validated(); //without password confirm
        $validated['password'] = Hash::make($validated['password']);

        $this->userInterface->create($validated);

        return response()->json([
            'message' => 'User created successfully!',
        ], 201);
    }
}
