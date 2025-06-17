<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Http\Requests\User\UserCreateRequest;
use App\Repositories\All\User\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRegisterController extends Controller
{
    protected $userInterface;

    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRegisterRequest $request)
    {
        $validated = $request->validated(); //with password confirm
        $validated['password'] = Hash::make($validated['password']);

        $this->userInterface->create($validated);

        return response()->json([
            'message' => 'User registered successfully!',
        ], 201);
    }

    public function create(UserCreateRequest $request)
    {
        $validated = $request->validated(); //without password confirm
        $validated['password'] = Hash::make($validated['password']);

        $this->userInterface->create($validated);

        return response()->json([
            'message' => 'User registered successfully!',
        ], 201);
    }
}
