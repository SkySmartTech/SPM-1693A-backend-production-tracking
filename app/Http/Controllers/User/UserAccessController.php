<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAccess\UserAccessCreateRequest;
use App\Http\Requests\UserAccess\UserAccessUpdateRequest;
use App\Repositories\All\UserAccess\UserAccessInterface;
use Illuminate\Http\Request;

class UserAccessController extends Controller
{
    protected $userAccessInterface;

    public function __construct(UserAccessInterface $userAccessInterface)
    {
        $this->userAccessInterface = $userAccessInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userAccesses = $this->userAccessInterface->all();
        return response()->json($userAccesses, 200);
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
    public function store(UserAccessCreateRequest $request)
    {
        $validated = $request->validated();

        $this->userAccessInterface->create($validated);

        return response()->json([
            'message' => 'User Access created successfully!',
            'Data'=>$validated
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $userAccess = $this->userAccessInterface->findById($id);
        return response()->json($userAccess, 200);
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
    public function update(UserAccessUpdateRequest $request, $id)
    {
        $data = $request->validated();

        $updatedUserAccess = $this->userAccessInterface->update($id, $data);

        return response()->json([
            'message' => 'User Access updated successfully!',
            'data' => $updatedUserAccess,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->userAccessInterface->deleteById($id);
        return response()->json();
    }
}
