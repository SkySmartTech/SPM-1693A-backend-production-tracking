<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;
use App\Models\User;
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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'epf' => 'required|string',
            'employeeName' => 'required|string',
            'username' => 'required|string|unique:users',
            'password' => 'required|string',
            'department' => 'required|string',
            'contact' => 'required|string',
            'email' => 'required|email|unique:users',
            'userType' => 'required|string',
            'availability' => 'required|string',
            'status' => 'required|string',
        ]);
        $validated['password'] = Hash::make($validated['password']);

        $user = $this->userInterface->create($validated);


        return response()->json([
            'message' => 'User registered successfully!',
            'user' => $user,
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
