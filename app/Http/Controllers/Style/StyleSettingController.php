<?php

namespace App\Http\Controllers\Style;

use App\Http\Controllers\Controller;
use App\Http\Requests\Style\StyleCreateRequest;
use App\Repositories\All\Style\StyleInterface;

class StyleSettingController extends Controller
{
    protected $styleInterface;

    public function __construct(StyleInterface $styleInterface)
    {
        $this->styleInterface = $styleInterface;
    }

    public function index()
    {
        $styles = $this->styleInterface->all();
        return response()->json($styles, 200);
    }

    public function allStyles()
    {
        $styleNos = $this->styleInterface->all()->pluck('style_no');
        return response()->json($styleNos, 200);
    }

    public function store(StyleCreateRequest $request)
    {
        $validatedStyle = $request->validated();

        $this->styleInterface->create($validatedStyle);

        return response()->json([
            'message' => 'Style Created successfully!',
        ], 201);
    }

    public function show(string $id)
    {
        $style = $this->styleInterface->findById($id);
        return response()->json($style, 200);
    }

    public function update(StyleCreateRequest $request, string $id)
    {
        $style = $this->styleInterface->findById($id);

        if (!$style) {
            return response()->json([
                'message' => 'Style not found!',
            ], 404);
        }

        $validatedStyle = $request->validated();

        $updatedStyle = $this->styleInterface->update($id, $validatedStyle);

        if (!$updatedStyle) {
            return response()->json([
                'message' => 'Failed to update style.',
            ], 500);
        }

        return response()->json([
            'message' => 'Style updated successfully!',
            'data' => $updatedStyle
        ], 200);
    }

    public function destroy($id)
    {
        $this->styleInterface->deleteById($id);
        return response()->json();
    }
}
