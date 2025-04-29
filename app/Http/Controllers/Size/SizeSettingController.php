<?php

namespace App\Http\Controllers\Size;

use App\Http\Controllers\Controller;
use App\Http\Requests\Size\SizeCreateRequest;
use App\Http\Requests\Size\SizeUpdateRequest;
use App\Repositories\All\Size\SizeInterface;
use Illuminate\Http\Request;

class SizeSettingController extends Controller
{
    protected $sizeInterface;

    public function __construct(SizeInterface $sizeInterface)
    {
        $this->sizeInterface = $sizeInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sizes = $this->sizeInterface->all();

        if ($sizes->isEmpty()) {
            return response()->json([
                'message' => 'No sizes found!',
            ], 404);
        }

        return response()->json([
            'message' => 'Sizes retrieved successfully!',
            'data' => $sizes
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
    public function store(SizeCreateRequest $request)
    {
        $validatedSize = $request->validated();

        $this->sizeInterface->create($validatedSize);

        return response()->json([
            'message' => 'Size Created successfully!',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $size = $this->sizeInterface->findById($id);

        if (!$size) {
            return response()->json([
                'message' => 'Size not found!',
            ], 404);
        }

        return response()->json([
            'message' => 'Size retrieved successfully!',
            'data' => $size
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
    public function update(SizeUpdateRequest $request, $id)
    {
        $size = $this->sizeInterface->findById($id);

        if (!$size) {
            return response()->json([
                'message' => 'Size not found!',
            ], 404);
        }

        $validatedSize = $request->validated();

        $updatedSize = $this->sizeInterface->update($id, $validatedSize);

        if (!$updatedSize) {
            return response()->json([
                'message' => 'Failed to update size.',
            ], 500);
        }

        return response()->json([
            'message' => 'Size updated successfully!',
            'data' => $updatedSize
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $size = $this->sizeInterface->findById($id);

        if (!$size) {
            return response()->json([
                'message' => 'Size not found!',
            ], 404);
        }

        $this->sizeInterface->deleteById($id);

        return response()->json([
            'message' => 'Size deleted successfully!',
        ], 200);
    }
}
