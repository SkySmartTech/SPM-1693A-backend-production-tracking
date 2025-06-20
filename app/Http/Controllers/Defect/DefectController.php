<?php

namespace App\Http\Controllers\Defect;

use App\Http\Controllers\Controller;
use App\Http\Requests\Defect\DefectCreateRequest;
use App\Http\Requests\Defect\DefectUpdateRequest;
use App\Repositories\All\Defect\DefectInterface;

class DefectController extends Controller
{
    protected $defectInterface;

    public function __construct(DefectInterface $defectInterface)
    {
        $this->defectInterface = $defectInterface;
    }

    public function index()
    {
        $defects = $this->defectInterface->all();
        return response()->json($defects, 200);
    }

    public function store(DefectCreateRequest $request)
    {
        $validatedDefect = $request->validated();

        $this->defectInterface->create($validatedDefect);

        return response()->json([
            'message' => 'Defect Created successfully!',
        ], 201);
    }

    public function show(string $id)
    {
        $defect = $this->defectInterface->findById($id);
        return response()->json($defect, 200);
    }

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
        ], 200);
    }

    public function destroy(string $id)
    {
        $this->defectInterface->deleteById($id);
        return response()->json();
    }
}
