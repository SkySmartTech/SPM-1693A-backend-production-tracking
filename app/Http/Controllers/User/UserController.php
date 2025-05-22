<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserProfileUpdateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Repositories\All\User\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $userInterface;

    public function __construct(UserInterface $userInterface) {
        $this->userInterface = $userInterface;
    }


    public function index()
    {
        $users = $this->userInterface->all();
        return response()->json($users, 200);
    }

    public function show(Request $request)
    {
        $user = $request->user();

        $userData = [
            'id'           => $user->id,
            'employeeName' => $user->employeeName,
            'username'     => $user->username,
            'password'     => $user->password,
            'department'   => $user->department,
            'contact'      => $user->contact,
            'email'        => $user->email,
        ];

        return response()->json($userData, 200);

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
