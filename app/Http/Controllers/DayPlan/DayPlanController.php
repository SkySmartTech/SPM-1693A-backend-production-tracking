<?php

namespace App\Http\Controllers\DayPlan;

use App\Http\Controllers\Controller;
use App\Http\Requests\DayPlan\DayPlanCreateRequest;
use App\Repositories\All\DayPlan\DayPlanInterface;
use Illuminate\Http\Request;

class DayPlanController extends Controller
{
    protected $dayPlanInterface;

    public function __construct(DayPlanInterface $dayPlanInterface)
    {
        $this->dayPlanInterface = $dayPlanInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dayPlans = $this->dayPlanInterface->all();
        return response()->json($dayPlans, 200);
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
    public function store(DayPlanCreateRequest $request)
    {
        $validatedDayPlan = $request->validated();

        $this->dayPlanInterface->create($validatedDayPlan);

        return response()->json([
            'message' => 'Day Plan Created successfully!',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function all_teams()
    {
        $teamNos = $this->dayPlanInterface->all()->pluck('line_no');
        return response()->json($teamNos, 200);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
