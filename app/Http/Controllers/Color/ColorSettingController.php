<?php

namespace App\Http\Controllers\Color;

use App\Http\Controllers\Controller;
use App\Http\Requests\Color\ColorCreateRequest;
use App\Repositories\All\Color\ColorInterface;

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
        return response()->json($colors, 200);
    }


    public function all_colors()
    {
        $color = $this->colorInterface->all()->pluck('color');
        return response()->json($color, 200);
    }


    public function store(ColorCreateRequest $request){

        $validatedColor = $request->validated();

        $this->colorInterface->create($validatedColor);

        return response()->json([
            'message' => 'Color Created successfully!',
        ], 201);
    }

    public function update(ColorCreateRequest $request, $id)
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
        $this->colorInterface->deleteById($id);
        return response()->json();
    }

    public function show($id)
    {
        $color = $this->colorInterface->findById($id);
        return response()->json($color, 200);
    }

}
