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

    public function __construct(UserInterface $userInterface)
    {
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

        if (! $user || $user->availability != 1) {
            return response()->json(['message' => 'User not available'], 403);
        }

        $permission = $this->comPermissionInterface->getById($user->userType);
        $userData   = $user->toArray();

        $profileImages = is_array($user->profileImage) ? $user->profileImage : json_decode($user->profileImage, true) ?? [];

        $signedImages = [];
        foreach ($profileImages as $uri) {
            $signed         = $this->profileImageService->getImageUrl($uri);
            $signedImages[] = [
                'fileName' => $signed['fileName'] ?? null,
                'imageUrl' => $signed['signedUrl'] ?? null,
            ];
        }

        foreach ($profileImages as &$uri) {
            if (isset($document['gsutil_uri'])) {
                $imageData            = $this->profileImageService->getImageUrl($document['gsutil_uri']);
                $document['imageUrl'] = $imageData['signedUrl'];
                $document['fileName'] = $imageData['fileName'];
            }
        }

        $userData['profileImage'] = $signedImages;

        if ($permission) {
            $userData['permissionObject'] = (array) $permission->permissionObject;
            $userData['userTypeObject']   = [
                'id'   => $permission->id,
                'name' => $permission->userType ?? null,
            ];
        }

        $userData['assigneeLevelObject'] = $this->assigneeLevelInterface->getById($user->assigneeLevel);

        return response()->json($userData, 200);
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
