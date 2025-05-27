<?php

namespace App\Repositories\All\CheckPoint;

use App\Models\CheckPoint;
use App\Repositories\All\CheckPoint\CheckPointInterface;
use App\Repositories\Base\BaseRepository;

class CheckPointRepository extends BaseRepository implements CheckPointInterface
{
    /**
     * @var CheckPoint
     */
    protected $model;

    /**
     *
     * @param CheckPoint $model
     */
    public function __construct(CheckPoint $model)
    {
        $this->model = $model;
    }
}
