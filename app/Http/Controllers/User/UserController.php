<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserProfileUpdateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Repositories\All\User\UserInterface;

class UserController extends Controller
{
    protected $userInterface;

    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }


    public function index()
    {
        $users = $this->userInterface->all();
        return response()->json($users, 200);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $data = $request->validated();

        $updatedUser = $this->userInterface->update($id, $data);

        return response()->json([
            'message' => 'User updated successfully!',
            'data' => $updatedUser,
        ]);
    }

    public function profile($id)
    {
        $user = $this->userInterface->findById($id, [
            'id',
            'employeeName',
            'username',
            'password',
            'department',
            'contact',
            'email'
        ]);

        $user->makeVisible('password');
        return response()->json($user, 200);
    }

    public function profile_update(UserProfileUpdateRequest $request, $id)
    {
        $data = $request->validated();
        $updatedUser = $this->userInterface->update($id, $data);

        return response()->json([
            'message' => 'User Profile updated successfully!',
            'data' => $updatedUser,
        ]);
    }

    public function show($id)
    {
        $user = $this->userInterface->findById($id);
        return response()->json($user, 200);
    }


}
