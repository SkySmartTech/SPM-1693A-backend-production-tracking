<?php

namespace App\Http\Controllers\DayPlan;

use App\Http\Controllers\Controller;
use App\Http\Requests\DayPlan\DayPlanCreateRequest;
use App\Models\DayPlan;
use App\Repositories\All\DayPlan\DayPlanInterface;
use Illuminate\Http\Request;

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
            'style'  => 'required|string',
        ]);

        $dayPlan = DayPlan::where('lineNo', $request->input('lineNo'))
                        ->where('style', $request->input('style'))
                        ->select('buyer', 'gg', 'smv', 'availableCader')
                        ->first();

        return response()->json($dayPlan);
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
