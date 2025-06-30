<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserProfileUpdateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Repositories\All\User\UserInterface;
use Illuminate\Http\Request;

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

    public function store(UserCreateRequest $request)
    {
        $validatedData = $request->validated();

        $this->userInterface->create($validatedData);

        return response()->json([
            'message' => 'User created successfully!',
        ], 201);
    }

    public function show(Request $request)
    {
        $user = $request->user();
        if (! $user || $user->availability != 1) {
            return response()->json(['message' => 'User not available'], 403);
        }

        $userData = $user->toArray();

        return response()->json($userData, 200);

    }

    public function update(UserUpdateRequest $request, $id)
    {
        $data = $request->validated();

        $updatedUser = $this->userInterface->update($id, $data);

        return response()->json([
            'message' => 'User updated successfully!',
        ]);
    }

    public function updateAvailability($id)
    {
        $user = $this->userInterface->findById($id);

        $user->availability = false;
        $user->save();

        return response()->json([
            'message' => 'User deactivated successfully.',
        ]);
    }

    public function profileUpdate(UserProfileUpdateRequest $request, $id)
    {
        $data        = $request->validated();
        $updatedUser = $this->userInterface->update($id, $data);

        return response()->json([
            'message' => 'User Profile updated successfully!',
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $users = $this->userInterface->search($keyword);

        $userData = $users->map(function ($user) {
            $userArray = $user->toArray();

            // $permission            = $this->comPermissionInterface->getById($user->userType);
            // $userArray['userType'] = [
            //     'id'          => $permission->id ?? null,
            //     'userType'    => $permission->userType ?? null,
            //     'description' => $permission->description ?? null,
            // ];

            // $assigneeLevel          = $this->assigneeLevelInterface->getById($user->assigneeLevel);
            // $userArray['userLevel'] = $assigneeLevel ? [
            //     'id'        => $assigneeLevel->id,
            //     'levelId'   => $assigneeLevel->levelId,
            //     'levelName' => $assigneeLevel->levelName,
            // ] : [];

            // $profileImages = is_array($user->profileImage) ? $user->profileImage : json_decode($user->profileImage, true) ?? [];
            // $signedImages  = [];

            // foreach ($profileImages as $uri) {
            //     $signed         = $this->profileImageService->getImageUrl($uri);
            //     $signedImages[] = [
            //         'fileName' => $signed['fileName'] ?? null,
            //         'imageUrl' => $signed['signedUrl'] ?? null,
            //     ];
            // }

            // $userArray['profileImage'] = $signedImages;

            return $userArray;
        });

        return response()->json($userData, 200);
    }

}
