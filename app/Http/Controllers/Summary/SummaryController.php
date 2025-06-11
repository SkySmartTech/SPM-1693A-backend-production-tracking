<?php

namespace App\Http\Controllers\Summary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SummaryController extends Controller
{
    public function getSummary(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = Carbon::parse($request->input('start_date'))->startOfDay();
        $endDate = Carbon::parse($request->input('end_date'))->endOfDay();

        $formattedStartDate = $startDate->format('Y-m-d');
        $formattedEndDate = $endDate->format('Y-m-d');

        $topDefects = DB::table('production_updates')
            ->select('defect_code', DB::raw('count(*) as total'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->whereIn('quality_state', ['rework', 'defect'])
            ->groupBy('defect_code')
            ->orderByDesc('total')
            ->limit(3)
            ->get();

        return response()->json([
            'message' => 'Data fetched successfully',
            'start_date' => $formattedStartDate,
            'end_date' => $formattedEndDate,
            'top_defects' => $topDefects,
        ]);
    }
}
