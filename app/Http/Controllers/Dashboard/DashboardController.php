<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Dashboard;
use App\Models\DayPlan;
use App\Models\ProductionUpdate;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function generateFullDashboardData()
    {
        $shiftStart = Carbon::createFromTime(8, 0, 0);
        $startTime = Carbon::today()->setTime(8, 0, 0);
        $now = Carbon::now();
        $uptoNowMinutes = $now->greaterThan($startTime) ? $startTime->diffInMinutes($now) : 0;
        $uptoNowMinutes = min((int) $uptoNowMinutes, 540);
        $workingMinutes = 9 * 60;
        $today = Carbon::today();
        $hoursSinceShiftStart = floor($shiftStart->diffInHours($now));
        $currentHourStart = $shiftStart->copy()->addHours($hoursSinceShiftStart);
        $currentHourEnd = $currentHourStart->copy()->addHour();

        if ($now->lt($shiftStart) || $now->gt($shiftStart->copy()->addHours(9))) {
            return response()->json([
                'message' => 'Outside working hours. No dashboard data generated.'
            ], 200);
        }

        $dayPlans = DB::table('day_plans')
                ->whereDate('created_at', $today)
                ->select('lineNo', 'planTgtPcs', 'perHourPcs')
                ->get();

        $successCounts = DB::table('production_updates')
            ->select('lineNo', DB::raw('COUNT(*) as success_count'))
            ->where('qualityState', 'success')
            ->whereBetween('serverDateTime', [$currentHourStart, $currentHourEnd])
            ->groupBy('lineNo')
            ->get();

        $results = $dayPlans->map(function ($plan) use ($successCounts,$uptoNowMinutes, $workingMinutes, $startTime, $now, $today) {
            $matched = $successCounts->firstWhere('lineNo', $plan->lineNo);
            $actualSuccess = $matched ? $matched->success_count : 0;
            $balance = $plan->perHourPcs - $actualSuccess;

            $uptoNowTarget = ($plan->planTgtPcs * $uptoNowMinutes) / $workingMinutes;

            $archivedTarget = DB::table('production_updates')
                ->where('lineNo', $plan->lineNo)
                ->where('qualityState', 'success')
                ->whereBetween('created_at', [$startTime, $now])
                ->count();

            $performanceEFI = $uptoNowTarget > 0
                ? round($archivedTarget / $uptoNowTarget, 2)
                : 0;

            $uptoNowBalance = round($uptoNowTarget - $archivedTarget);
            $todayBalance = $plan->planTgtPcs - $archivedTarget;

            $checkData = DB::table('production_updates as pu')
                    ->select(
                        'pu.lineNo',
                        DB::raw("SUM(CASE WHEN pu.qualityState = 'Success' THEN 1 ELSE 0 END) as success"),
                        DB::raw("SUM(CASE WHEN pu.qualityState = 'Defect' THEN 1 ELSE 0 END) as defect"),
                        DB::raw("SUM(CASE WHEN pu.qualityState = 'Rework' THEN 1 ELSE 0 END) as rework"),
                        DB::raw("COUNT(*) as total_check_quantity"),
                        DB::raw("(
                            SELECT sub.defectCode
                            FROM production_updates as sub
                            WHERE sub.lineNo = pu.lineNo
                                AND DATE(sub.serverDateTime) = '$today'
                                AND sub.qualityState IN ('defect', 'rework')
                                AND sub.defectCode IS NOT NULL
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

            $defectSummary = [];
            foreach ($checkData as $result) {
                $lineNo = $result->lineNo;
                $rawCounts = $defectCodes[$lineNo] ?? collect();

                $defect_code_counts = $rawCounts->map(function ($item) {
                    return [
                        'defectCode' => $item->defectCode,
                        'count' => $item->count
                    ];
                })->values();

                $totalDefects = $result->defect + $result->rework;
                $totalCheckQty = $result->total_check_quantity;
                $dhu = $totalCheckQty > 0 ? round(($totalDefects * 100) / $totalCheckQty, 2) : 0.00;

                $defectSummary[$lineNo] = [
                    'totalCheckQty'      => $totalCheckQty,
                    'totalDefects'       => $totalDefects,
                    'dhu'                => $dhu,
                    'defect_code_counts' => $defect_code_counts,
                ];
            }

            $resultsLine = DB::table('day_plans')
                    ->select(
                        'lineNo',
                        'smv',
                        'planTgtPcs',
                        'presentLinkers',
                        DB::raw("ROUND(
                            CASE
                                WHEN presentLinkers > 0 THEN
                                    (smv * planTgtPcs) / (presentLinkers * $uptoNowMinutes)
                                ELSE 0
                            END, 2
                        ) as line_efi")
                    )
                    ->whereDate('created_at', $today)
                    ->get();


                $lineEfiMap = [];

                foreach ($resultsLine as $item) {
                    $lineEfiMap[$item->lineNo] = $item->line_efi;
                }

            return [
                'lineNo'            => $plan->lineNo,
                'perHourTarget'     => $plan->perHourPcs,
                'actualSuccess'     => $actualSuccess,
                'hourlyBalance'     => $balance,

                'today_target'       => $plan->planTgtPcs,
                'upto_now_minutes'   => $uptoNowMinutes,
                'upto_now_target'    => round($uptoNowTarget, 2),
                'upto_now_achieved'  => $archivedTarget,
                'upto_now_balance'   => $uptoNowBalance,
                'today_balance'      => $todayBalance,
                'performance_efi'    => $performanceEFI,
                'line_efi'           => $lineEfiMap[$plan->lineNo] ?? 0,

                'totalCheckQty'      => $defectSummary[$plan->lineNo]['totalCheckQty']      ?? 0,
                'totalDefects'       => $defectSummary[$plan->lineNo]['totalDefects']       ?? 0,
                'dhu'                => $defectSummary[$plan->lineNo]['dhu']                ?? 0,
                'defect_code_counts' => $defectSummary[$plan->lineNo]['defect_code_counts'] ?? [],
            ];
        });
    }
}
