<?php

namespace App\Http\Controllers\Size;

use App\Http\Controllers\Controller;
use App\Http\Requests\Size\SizeCreateRequest;
use App\Repositories\All\Size\SizeInterface;

class SizeSettingController extends Controller
{
    protected $sizeInterface;

    public function __construct(SizeInterface $sizeInterface)
    {
        $this->sizeInterface = $sizeInterface;
    }

    public function index()
    {
        $sizes = $this->sizeInterface->all();
        return response()->json($sizes, 200);
    }

    public function store(SizeCreateRequest $request)
    {
        $validatedSize = $request->validated();

        $this->sizeInterface->create($validatedSize);

        return response()->json([
            'message' => 'Size Created successfully!',
        ], 201);
    }

    public function update(SizeCreateRequest $request, $id)
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
        $this->sizeInterface->deleteById($id);
        return response()->json();
    }
}
