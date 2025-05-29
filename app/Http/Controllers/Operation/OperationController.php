<?php

namespace App\Http\Controllers\Operation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Operation\OperationCreateRequest;
use App\Repositories\All\Operation\OperationInterface;

class OperationController extends Controller
{
    protected $operationInterface;

    public function __construct(OperationInterface $operationInterface)
    {
        $this->operationInterface = $operationInterface;
    }


    public function index()
    {
        $operations = $this->operationInterface->all();
        return response()->json($operations, 200);
    }


    public function store(OperationCreateRequest $request)
    {
        $validatedOperation = $request->validated();

        $this->operationInterface->create($validatedOperation);

        return response()->json([
            'message' => 'Operation Created successfully!',
        ], 201);
    }

    public function update(OperationCreateRequest $request, $id)
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


    public function destroy($id)
    {
        $this->operationInterface->deleteById($id);
        return response()->json();
    }
}
