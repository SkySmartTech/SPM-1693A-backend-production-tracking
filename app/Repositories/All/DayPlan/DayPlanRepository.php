<?php

namespace App\Repositories\All\DayPlan;

use App\Models\DayPlan;
use App\Repositories\All\DayPlan\DayPlanInterface;
use App\Repositories\Base\BaseRepository;

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
}
