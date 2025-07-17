<?php

namespace App\Repositories\All\DayPlan;

use App\Models\DayPlan;
use App\Repositories\All\DayPlan\DayPlanInterface;
use App\Repositories\Base\BaseRepository;
use Carbon\Carbon;

class DayPlanRepository extends BaseRepository implements DayPlanInterface
{
    /**
     * @var DayPlan
     */
    protected $model;

    /**
     *
     * @param DayPlan $model
     */
    public function __construct(DayPlan $model)
    {
        $this->model = $model;
    }


    public function getLatestUploaded(){
        $latestBatchTime = DayPlan::orderBy('created_at', 'desc')->first()?->created_at;

        if (!$latestBatchTime) {
            return collect();
        }

        return DayPlan::where('created_at', $latestBatchTime)->get();
    }


}
