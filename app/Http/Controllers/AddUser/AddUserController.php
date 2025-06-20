<?php

namespace App\Http\Controllers\AddUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCreateRequest;
use App\Repositories\All\AddUser\AddUserInterface;
use Illuminate\Http\Request;

class AddUserController extends Controller
{
    protected $addUserInterface;

    public function __construct(AddUserInterface $addUserInterface)
    {
        $this->addUserInterface = $addUserInterface;
    }

    public function store(UserCreateRequest $request)
    {
        $validatedData = $request->validated();

        $this->addUserInterface->create($validatedData);

        return response()->json([
            'message' => 'User created successfully!',
        ], 201);
    }
}
