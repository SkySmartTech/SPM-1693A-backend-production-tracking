<?php

namespace App\Http\Controllers\Summary;

use App\Http\Controllers\Controller;
use App\Models\ProductionUpdate;
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
            'lineNo'     => 'nullable|string'
        ]);

        $startDate = Carbon::parse($request->input('start_date'))->startOfDay();
        $endDate = Carbon::parse($request->input('end_date'))->endOfDay();
        $lineNo = $request->input('lineNo');

        $query = ProductionUpdate::whereBetween('serverDateTime', [$startDate, $endDate]);
        if ($lineNo) {
            $query->where('lineNo', $lineNo);
        }

        $totalSuccess = (clone $query)->where('qualityState', 'success')->count();
        $totalRework  = (clone $query)->where('qualityState', 'rework')->count();
        $totalDefect  = (clone $query)->where('qualityState', 'defect')->count();

        $topDefectsQuery = DB::table('production_updates')
            ->select('defectCode', DB::raw('count(*) as total'))
            ->whereBetween('serverDateTime', [$startDate, $endDate])
            ->whereIn('qualityState', ['rework', 'defect'])
            ->whereNotNull('defectCode');

        if ($lineNo) {
            $topDefectsQuery->where('lineNo', $lineNo);
        }

        $topDefects = $topDefectsQuery
            ->groupBy('defectCode')
            ->orderByDesc('total')
            ->limit(3)
            ->get();

        $productionData = $query->orderBy('serverDateTime', 'asc')->get();

        return response()->json([
            //'start_date'    => $startDate->toDateString(),
            //'end_date'      => $endDate->toDateString(),
            'lineNo'        => $lineNo ?? 'All',
            'total_success' => $totalSuccess,
            'total_rework'  => $totalRework,
            'total_defect'  => $totalDefect,
            'top_defects'   => $topDefects,
            'production'    => $productionData,
        ]);
    }
}
