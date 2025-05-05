<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdateRequest;
use App\Repositories\All\User\UserInterface;
use Illuminate\Support\Facades\Hash;

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
        $user = $this->userInterface->findById($id);


        $data = $request->validated();

        $updatedUser = $this->userInterface->update($id, $data);

        if (!$updatedUser) {
            return response()->json([
                'message' => 'Failed to update user.',
            ], 500);
        }

        return response()->json([
            'message' => 'User updated successfully!',
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
