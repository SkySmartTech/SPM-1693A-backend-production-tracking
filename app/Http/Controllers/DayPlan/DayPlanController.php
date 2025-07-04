<?php

namespace App\Http\Controllers\DayPlan;

use App\Http\Controllers\Controller;
use App\Http\Requests\DayPlan\DayPlanCreateRequest;
use App\Models\DayPlan;
use App\Models\ProductionUpdate;
use App\Repositories\All\DayPlan\DayPlanInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DayPlanController extends Controller
{
    protected $dayPlanInterface;

    public function __construct(DayPlanInterface $dayPlanInterface)
    {
        $this->dayPlanInterface = $dayPlanInterface;
    }

    public function index()
    {
        $dayPlans = $this->dayPlanInterface->getLatestUploadedSet();
        return response()->json($dayPlans, 200);
    }

    public function show(Request $request)
    {
        $request->validate([
            'lineNo' => 'required|string',
        ]);
        
        $lineNo = $request->input('lineNo');
        $today = now()->toDateString();

        $dayPlan = DayPlan::where('lineNo', $request->input('lineNo'))
                        ->select('style', 'buyer', 'gg', 'smv', 'availableCader')
                        ->first();

        $records = ProductionUpdate::where('lineNo', $lineNo)
                ->whereDate('created_at', $today)
                ->get();

        $successCount = $records->where('qualityState', 'Success')->count();
        $reworkCount = $records->where('qualityState', 'Rework')->count();
        $defectCount = $records->where('qualityState', 'Defect')->count();
        $shiftStart = Carbon::createFromTime(8, 0, 0);
        $hourlyCounts = array_fill(1, 8, 0);


        foreach ($records->where('qualityState', 'Success') as $record) {
            if ($record->serverDateTime) {
                $time = Carbon::parse($record->serverDateTime);
                $diffInMinutes = $shiftStart->diffInMinutes($time, false);
                if ($diffInMinutes >= 0 && $diffInMinutes < 480) {
                    $hourSlot = intdiv($diffInMinutes, 60) + 1;
                    $hourlyCounts[$hourSlot]++;
                }
            }
        }

        return response()->json([
            'dayPlan' => $dayPlan,
            'successCount' => $successCount,
            'reworkCount' => $reworkCount,
            'defectCount' => $defectCount,
            'hourlySuccess' => $hourlyCounts
        ], 200);
    }

    public function store(DayPlanCreateRequest $request)
    {
        $validatedDayPlan = $request->validated();

        foreach ($validatedDayPlan['day_plans'] as $plan) {
            $this->dayPlanInterface->create($plan);
        }

        return response()->json([
            'message' => 'Day Plans Created successfully!',
        ], 201);
    }

    public function allTeams()
    {
        $teamNos = $this->dayPlanInterface->all()->pluck('lineNo');
        return response()->json($teamNos, 200);
    }

}
