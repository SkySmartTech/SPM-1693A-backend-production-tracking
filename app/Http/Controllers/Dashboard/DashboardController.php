<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DayPlan;
use App\Models\ProductionUpdate;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function countPerformanceEFI()
    {

    }

    public function countHourlyTarget()
    {
        $shiftStart = Carbon::createFromTime(8, 0, 0);
        $now = Carbon::now();

        $hoursSinceShiftStart = floor($shiftStart->diffInHours($now));
        $currentHourStart = $shiftStart->copy()->addHours($hoursSinceShiftStart);
        $currentHourEnd = $currentHourStart->copy()->addHour();

        $dayPlans = DB::table('day_plans')->select('line_no', 'per_hour_pcs')->get();

        $successCounts = DB::table('production_updates')
            ->select('line_no', DB::raw('COUNT(*) as success_count'))
            ->where('quality_state', 'success')
            ->whereBetween('server_date_time', [$currentHourStart, $currentHourEnd])
            ->groupBy('line_no')
            ->get();

        $results = $dayPlans->map(function ($plan) use ($successCounts) {
            $matched = $successCounts->firstWhere('line_no', $plan->line_no);
            $actualSuccess = $matched ? $matched->success_count : 0;
            $balance = $plan->per_hour_pcs - $actualSuccess;

            return [
                'line_no'         => $plan->line_no,
                'per_hour_target' => $plan->per_hour_pcs,
                'actual_success'  => $actualSuccess,
                'hourly_balance'  => $balance,
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
                ->where('line_no', $plan->line_no)
                ->where('quality_state', 'success')
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

        $results = DB::table('production_updates')
            ->select(
                'line_no',
                DB::raw("SUM(CASE WHEN quality_state = 'success' THEN 1 ELSE 0 END) as success"),
                DB::raw("SUM(CASE WHEN quality_state = 'defect' THEN 1 ELSE 0 END) as defect"),
                DB::raw("SUM(CASE WHEN quality_state = 'rework' THEN 1 ELSE 0 END) as rework"),
                DB::raw("COUNT(*) as total_check_quantity")
            )
            ->whereDate('server_date_time', $today)
            ->groupBy('line_no')
            ->get();

        return response()->json($results);
    }

    public function countTotalDefectQty()
    {

    }

    public function countDefectPerUnit()
    {

    }

    public function countLineEFI()
    {

    }
}
