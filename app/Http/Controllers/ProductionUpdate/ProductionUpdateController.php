<?php

namespace App\Http\Controllers\ProductionUpdate;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductionUpdate\ProductionUpdateCreateRequest;
use App\Models\ProductionUpdate;
use App\Repositories\All\ProductionUpdate\ProductionUpdateInterface;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductionUpdateController extends Controller
{
    protected $productionUpdateInterface;

    public function __construct(ProductionUpdateInterface $productionUpdateInterface)
    {
        $this->productionUpdateInterface = $productionUpdateInterface;
    }

    public function store(ProductionUpdateCreateRequest $request)
    {
        $validatedProduction = $request->validated();
        $validatedProduction['serverDateTime'] = Carbon::now();

        $this->productionUpdateInterface->create($validatedProduction);

        $successCount = ProductionUpdate::where('qualityState', 'Success')->whereDate('serverDateTime', Carbon::today())->count();
        $reworkCount = ProductionUpdate::where('qualityState', 'Rework')->whereDate('serverDateTime', Carbon::today())->count();
        $defectCount = ProductionUpdate::where('qualityState', 'Defect')->whereDate('serverDateTime', Carbon::today())->count();
        return response()->json([
            'message' => 'Production Updated successfully!',
            'success' => $successCount,
            'rework' => $reworkCount,
            'defect' => $defectCount
        ], 201);
    }

}
