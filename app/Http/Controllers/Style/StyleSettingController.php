<?php

namespace App\Http\Controllers\Style;

use App\Http\Controllers\Controller;
use App\Http\Requests\Style\StyleCreateRequest;
use App\Http\Requests\Style\StyleUpdateRequest;
use App\Repositories\All\Style\StyleInterface;
use Illuminate\Http\Request;

class StyleSettingController extends Controller
{
    protected $styleInterface;

    public function __construct(StyleInterface $styleInterface)
    {
        $this->styleInterface = $styleInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $styles = $this->styleInterface->all();

        if ($styles->isEmpty()) {
            return response()->json([
                'message' => 'No styles found!',
            ], 404);
        }

        return response()->json([
            'message' => 'Styles retrieved successfully!',
            'data' => $styles
        ], 200);
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
    public function store(StyleCreateRequest $request)
    {
        $validatedStyle = $request->validated();

        $this->styleInterface->create($validatedStyle);

        return response()->json([
            'message' => 'Style Created successfully!',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $style = $this->styleInterface->findById($id);

        if (!$style) {
            return response()->json([
                'message' => 'Style not found!',
            ], 404);
        }

        return response()->json([
            'message' => 'Style retrieved successfully!',
            'data' => $style
        ], 200);
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
    public function update(StyleUpdateRequest $request, string $id)
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $style = $this->styleInterface->findById($id);

        if (!$style) {
            return response()->json([
                'message' => 'Style not found!',
            ], 404);
        }

        $this->styleInterface->deleteById($id);

        return response()->json([
            'message' => 'Style deleted successfully!',
        ], 200);
    }
}
