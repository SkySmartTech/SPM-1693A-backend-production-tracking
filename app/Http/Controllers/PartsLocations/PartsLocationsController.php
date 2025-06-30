<?php

namespace App\Http\Controllers\PartsLocations;

use App\Http\Controllers\Controller;
use App\Http\Requests\PartLocation\PartLocationCreateRequest;
use App\Repositories\All\PartLocation\PartLocationInterface;

class PartsLocationsController extends Controller
{
    protected $partLocationInterface;

    public function __construct(PartLocationInterface $partLocationInterface)
    {
        $this->partLocationInterface = $partLocationInterface;
    }


    public function index()
    {
        $partLocations = $this->partLocationInterface->all();
        return response()->json($partLocations, 200);
    }

    public function store(PartLocationCreateRequest $request)
    {
        $validatedPartLocation = $request->validated();

        $this->partLocationInterface->create($validatedPartLocation);

        return response()->json([
            'message' => 'Part Location Created successfully!',
        ], 201);
    }

    public function show(string $id)
    {
        $partLocation = $this->partLocationInterface->findById($id);
        return response()->json($partLocation, 200);
    }

    public function update(PartLocationCreateRequest $request, $id)
    {
        $partLocation = $this->partLocationInterface->findById($id);

        if (!$partLocation) {
            return response()->json([
                'message' => 'Part Location not found!',
            ], 404);
        }

        $validatedPartLocation = $request->validated();

        $updatedPartLocation = $this->partLocationInterface->update($id, $validatedPartLocation);

        if (!$updatedPartLocation) {
            return response()->json([
                'message' => 'Failed to update Part Location.',
            ], 500);
        }

        return response()->json([
            'message' => 'Part Location updated successfully!',
        ], 200);
    }

    public function destroy($id)
    {
        $this->partLocationInterface->deleteById($id);
        return response()->json();
    }
}
