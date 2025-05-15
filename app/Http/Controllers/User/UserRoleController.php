<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRole\UserRoleCreateRequest;
use App\Http\Requests\UserRole\UserRoleUpdateRequest;
use App\Repositories\All\UserRole\UserRoleInterface;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    protected $userRoleInterface;

    public function __construct(UserRoleInterface $userRoleInterface)
    {
        $this->userRoleInterface = $userRoleInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_roles = $this->userRoleInterface->all();
        return response()->json($user_roles, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRoleCreateRequest $request)
    {
        $validated = $request->validated();

        $this->userRoleInterface->create($validated);

        return response()->json([
            'message' => 'User Role created successfully!',
            'Data'=>$validated
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRoleUpdateRequest $request, $id)
    {
        $data = $request->validated();

        $updatedUserRole = $this->userRoleInterface->update($id, $data);

        return response()->json([
            'message' => 'User Role updated successfully!',
            'data' => $updatedUserRole,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->userRoleInterface->deleteById($id);
        return response()->json();
    }
}
