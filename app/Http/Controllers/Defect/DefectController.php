<?php

namespace App\Http\Controllers\Defect;

use App\Http\Controllers\Controller;
use App\Http\Requests\Defect\DefectCreateRequest;
use App\Http\Requests\Defect\DefectUpdateRequest;
use App\Repositories\All\Defect\DefectInterface;
use Illuminate\Http\Request;

class DefectController extends Controller
{
    protected $defectInterface;

    public function __construct(DefectInterface $defectInterface)
    {
        $this->defectInterface = $defectInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $defects = $this->defectInterface->all();
        return response()->json($defects, 200);
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
    public function store(DefectCreateRequest $request)
    {
        $validatedDefect = $request->validated();

        $this->defectInterface->create($validatedDefect);

        return response()->json([
            'message' => 'Defect Created successfully!',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $defect = $this->defectInterface->findById($id);
        return response()->json($defect, 200);
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
    public function update(DefectUpdateRequest $request, $id)
    {
        $defect = $this->defectInterface->findById($id);

        if (!$defect) {
            return response()->json([
                'message' => 'Defect not found!',
            ], 404);
        }

        $validatedDefect = $request->validated();

        $updatedDefect = $this->defectInterface->update($id, $validatedDefect);

        if (!$updatedDefect) {
            return response()->json([
                'message' => 'Failed to update Defect.',
            ], 500);
        }

        return response()->json([
            'message' => 'Defect updated successfully!',
            'data' => $updatedDefect
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->defectInterface->deleteById($id);
        return response()->json();
    }
}
