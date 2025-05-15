<?php

namespace App\Http\Controllers\Operation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Operation\OperationCreateRequest;
use App\Http\Requests\Operation\OperationUpdateRequest;
use App\Repositories\All\Operation\OperationInterface;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    protected $operationInterface;

    public function __construct(OperationInterface $operationInterface)
    {
        $this->operationInterface = $operationInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $operations = $this->operationInterface->all();
        return response()->json($operations, 200);
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
    public function store(OperationCreateRequest $request)
    {
        $validatedOperation = $request->validated();

        $this->operationInterface->create($validatedOperation);

        return response()->json([
            'message' => 'Operation Created successfully!',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $operation = $this->operationInterface->findById($id);
        return response()->json($operation, 200);
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
    public function update(OperationUpdateRequest $request, $id)
    {
        $operation = $this->operationInterface->findById($id);

        if (!$operation) {
            return response()->json([
                'message' => 'Operation not found!',
            ], 404);
        }

        $validatedOperation = $request->validated();

        $updatedOperation = $this->operationInterface->update($id, $validatedOperation);

        if (!$updatedOperation) {
            return response()->json([
                'message' => 'Failed to update Operation.',
            ], 500);
        }

        return response()->json([
            'message' => 'Operation updated successfully!',
            'data' => $updatedOperation
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->operationInterface->deleteById($id);
        return response()->json();
    }
}
