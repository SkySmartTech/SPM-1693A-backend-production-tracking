<?php

namespace App\Http\Controllers\Color;

use App\Http\Controllers\Controller;
use App\Http\Requests\Color\ColorCreateRequest;
use App\Http\Requests\Color\ColorUpdateRequest;
use App\Repositories\All\Color\ColorInterface;
use Illuminate\Http\Request;

class ColorSettingController extends Controller
{
    protected $colorInterface;

    public function __construct(ColorInterface $colorInterface)
    {
        $this->colorInterface = $colorInterface;
    }

    public function index()
    {
        $colors = $this->colorInterface->all();

        if ($colors->isEmpty()) {
            return response()->json([
                'message' => 'No colors found!',
            ], 404);
        }

        return response()->json([
            'message' => 'Colors retrieved successfully!',
            'data' => $colors
        ], 200);
    }

    public function store(ColorCreateRequest $request){

        $validatedColor = $request->validated();

        $this->colorInterface->create($validatedColor);

        return response()->json([
            'message' => 'Color Created successfully!',
        ], 201);
    }

    public function update(ColorUpdateRequest $request, $id)
    {
        $color = $this->colorInterface->findById($id);

        if (!$color) {
            return response()->json([
                'message' => 'Color not found!',
            ], 404);
        }

        $validatedColor = $request->validated();

        $updatedColor = $this->colorInterface->update($id, $validatedColor);

        if (!$updatedColor) {
            return response()->json([
                'message' => 'Failed to update color.',
            ], 500);
        }

        return response()->json([
            'message' => 'Color updated successfully!',
            'data' => $updatedColor
        ], 200);
    }

    public function destroy($id)
    {
        $color = $this->colorInterface->findById($id);

        if (!$color) {
            return response()->json([
                'message' => 'Color not found!',
            ], 404);
        }

        $this->colorInterface->deleteById($id);

        return response()->json([
            'message' => 'Color deleted successfully!',
        ], 200);
    }

    public function show($id)
    {
        $color = $this->colorInterface->findById($id);

        if (!$color) {
            return response()->json([
                'message' => 'Color not found!',
            ], 404);
        }

        return response()->json([
            'message' => 'Color retrieved successfully!',
            'data' => $color
        ], 200);
    }

}
