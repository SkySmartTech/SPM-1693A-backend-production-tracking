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

    public function countSuccess()
    {
        $count = ProductionUpdate::where('qualityState', 'Success')->count();
        return response()->json($count);
    }

    public function countRework()
    {
        $count = ProductionUpdate::where('qualityState', 'Rework')->count();
        return response()->json($count);
    }

    public function countDefect()
    {
        $count = ProductionUpdate::where('qualityState', 'Defect')->count();
        return response()->json($count);
    }

    public function store(ProductionUpdateCreateRequest $request)
    {
        $validatedProduction = $request->validated();

        $this->productionUpdateInterface->create($validatedProduction);

        return response()->json([
            'message' => 'Production Updated successfully!',
        ], 201);
    }

    public function countSuccessPerHour()
    {
        $shiftStart = Carbon::parse('08:00:00');

        $records = ProductionUpdate::where('qualityState', 'Success')
                    ->whereDate('serverDateTime', today())
                    ->get();

        $hourlyCounts = array_fill(1, 8, 0);

        foreach ($records as $record) {
            $time = Carbon::parse($record->server_date_time);
            $diffInMinutes = $shiftStart->diffInMinutes($time, false);

            if ($diffInMinutes >= 0 && $diffInMinutes < 480) {
                $hourSlot = intdiv($diffInMinutes, 60) + 1;
                $hourlyCounts[$hourSlot]++;
            }
        }

        return response()->json([$hourlyCounts]);
    }

}
