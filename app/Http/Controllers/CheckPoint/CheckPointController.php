<?php

namespace App\Http\Controllers\CheckPoint;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckPoint\CheckPointCreateRequest;
use App\Repositories\All\CheckPoint\CheckPointInterface;
use Illuminate\Http\Request;

class CheckPointController extends Controller
{
    protected $checkPointInterface;

    public function __construct(CheckPointInterface $checkPointInterface)
    {
        $this->checkPointInterface = $checkPointInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checkPoints = $this->checkPointInterface->all();
        return response()->json($checkPoints, 200);
    }

    public function allCheckPoints()
    {
        $checkPoints = $this->checkPointInterface->all()->pluck('check_point_name');
        return response()->json($checkPoints, 200);
    }

    public function store(CheckPointCreateRequest $request)
    {
        $validatedcheckPoint = $request->validated();

        $this->checkPointInterface->create($validatedcheckPoint);

        return response()->json([
            'message' => 'Check Point Created successfully!',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $checkPoint = $this->checkPointInterface->findById($id);
        return response()->json($checkPoint, 200);
    }

    public function update(CheckPointCreateRequest $request, $id)
    {
        $checkPoint = $this->checkPointInterface->findById($id);

        if (!$checkPoint) {
            return response()->json([
                'message' => 'Check Point not found!',
            ], 404);
        }

        $validatedCheckPoint = $request->validated();

        $updatedCheckPoint = $this->checkPointInterface->update($id, $validatedCheckPoint);

        if (!$updatedCheckPoint) {
            return response()->json([
                'message' => 'Failed to update Check Point.',
            ], 500);
        }

        return response()->json([
            'message' => 'Check Point updated successfully!',
            'data' => $updatedCheckPoint
        ], 200);
    }

    public function destroy($id)
    {
        $this->checkPointInterface->deleteById($id);
        return response()->json();
    }
}
