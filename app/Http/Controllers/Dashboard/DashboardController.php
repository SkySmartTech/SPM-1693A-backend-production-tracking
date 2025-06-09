<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DayPlan;
use App\Models\ProductionUpdate;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function countHourlyTarget()
    {
        $shiftStart = Carbon::createFromTime(8, 0, 0);
        $now = Carbon::now();

        $hoursSinceShiftStart = floor($shiftStart->diffInHours($now));
        $currentHourStart = $shiftStart->copy()->addHours($hoursSinceShiftStart);
        $currentHourEnd = $currentHourStart->copy()->addHour();

        $dayPlans = DB::table('day_plans')->select('lineNo', 'perHourPcs')->get();

        $successCounts = DB::table('production_updates')
            ->select('lineNo', DB::raw('COUNT(*) as success_count'))
            ->where('qualityState', 'success')
            ->whereBetween('serverDateTime', [$currentHourStart, $currentHourEnd])
            ->groupBy('lineNo')
            ->get();

        $results = $dayPlans->map(function ($plan) use ($successCounts) {
            $matched = $successCounts->firstWhere('lineNo', $plan->line_no);
            $actualSuccess = $matched ? $matched->success_count : 0;
            $balance = $plan->per_hour_pcs - $actualSuccess;

            return [
                'lineNo'         => $plan->line_no,
                'perHourTarget' => $plan->per_hour_pcs,
                'actualSuccess'  => $actualSuccess,
                'hourlyBalance'  => $balance,
            ];
        });

        return response()->json([
            'hour' => $currentHourStart->format('H:i') . ' - ' . $currentHourEnd->format('H:i'),
            'data' => $results
        ]);
    }

    public function countUptoNowTargetArchive()
    {
        $startTime = Carbon::today()->setTime(8, 0, 0);
        $now = Carbon::now();
        $uptoNowMinutes = $now->greaterThan($startTime) ? $startTime->diffInMinutes($now) : 0;
        $uptoNowMinutes = min((int) $uptoNowMinutes, 540);
        $workingMinutes = 9 * 60;

        $today = Carbon::today();

        $dayPlans = DB::table('day_plans')
            ->whereDate('created_at', $today)
            ->get();

        $results = $dayPlans->map(function ($plan) use ($uptoNowMinutes, $workingMinutes, $startTime, $now) {
            $uptoNowTarget = ($plan->plan_tgt_pcs * $uptoNowMinutes) / $workingMinutes;

            $archivedTarget = DB::table('production_updates')
                ->where('lineNo', $plan->line_no)
                ->where('qualityState', 'success')
                ->whereBetween('created_at', [$startTime, $now])
                ->count();

            $performanceEFI = $uptoNowTarget > 0
                ? round($archivedTarget / $uptoNowTarget, 2)
                : 0;

            $uptoNowBalance = round($uptoNowTarget - $archivedTarget);
            $todayBalance = $plan->plan_tgt_pcs - $archivedTarget;

            return [
                'team_no'            => $plan->line_no,
                'today_target'       => $plan->plan_tgt_pcs,
                'upto_now_minutes'   => $uptoNowMinutes,
                'upto_now_target'    => round($uptoNowTarget, 2),
                'upto_now_achieved'  => $archivedTarget,
                'upto_now_balance'   => $uptoNowBalance,
                'today_balance'      => $todayBalance,
                'performance_efi'    => $performanceEFI,
            ];
        });

        return response()->json($results, 200);
    }

    public function countTotalCheckQty()
    {
        $today = Carbon::today();

        $results = DB::table('production_updates as pu')
            ->select(
                'pu.lineNo',
                DB::raw("SUM(CASE WHEN pu.quality_state = 'success' THEN 1 ELSE 0 END) as success"),
                DB::raw("SUM(CASE WHEN pu.quality_state = 'defect' THEN 1 ELSE 0 END) as defect"),
                DB::raw("SUM(CASE WHEN pu.quality_state = 'rework' THEN 1 ELSE 0 END) as rework"),
                DB::raw("COUNT(*) as total_check_quantity"),
                DB::raw("(
                    SELECT sub.defectCode
                    FROM production_updates as sub
                    WHERE sub.line_no = pu.lineNo
                        AND DATE(sub.server_date_time) = '$today'
                        AND sub.quality_state IN ('defect', 'rework')
                        AND sub.defect_code IS NOT NULL
                    GROUP BY sub.defectCode
                    ORDER BY COUNT(*) DESC
                    LIMIT 1
                ) as top_defect_code")
            )
            ->whereDate('pu.serverDateTime', $today)
            ->groupBy('pu.lineNo')
            ->get();

        $defectCodes = DB::table('production_updates')
            ->select('lineNo', 'defectCode', DB::raw('COUNT(*) as count'))
            ->whereDate('serverDateTime', $today)
            ->whereIn('qualityState', ['defect', 'rework'])
            ->whereNotNull('defectCode')
            ->groupBy('lineNo', 'defectCode')
            ->get()
            ->groupBy('lineNo');

        foreach ($results as $result) {
            $lineNo = $result->line_no;
            $rawCounts = $defectCodes[$lineNo] ?? collect();

            $result->defect_code_counts = $rawCounts->map(function ($item) {
                return [
                    'defectCode' => $item->defect_code,
                    'count' => $item->count
                ];
            })->values();

            $totalDefects = $result->defect + $result->rework;
            $totalCheckQty = $result->total_check_quantity;
            $result->dhu = $totalCheckQty > 0
                ? round(($totalDefects * 100) / $totalCheckQty, 2)
                : 0.00;
        }

        return response()->json($results);
    }

    public function countLineEFI()
    {
        $today = Carbon::today();

        $workingHours = 8;

        $results = DB::table('day_plans')
            ->select(
                'lineNo',
                'smv',
                'planTgtPcs',
                'presentLinkers',
                DB::raw("ROUND(
                    CASE
                        WHEN present_linkers > 0 THEN
                            (smv * planTgtPcs) / (presentLinkers * $workingHours * 60)
                        ELSE 0
                    END, 2
                ) as line_efi")
            )
            ->whereDate('created_at', $today)
            ->get();

        return response()->json($results);
    }

}
