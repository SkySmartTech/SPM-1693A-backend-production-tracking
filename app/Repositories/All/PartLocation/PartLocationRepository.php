<?php

namespace App\Repositories\All\PartLocation;

use App\Models\PartLocation;
use App\Repositories\All\PartLocation\PartLocationInterface;
use App\Repositories\Base\BaseRepository;

class PartLocationRepository extends BaseRepository implements PartLocationInterface
{
    /**
     * @var PartLocation
     */
    protected $model;

    /**
     *
     * @param PartLocation $model
     */
    public function __construct(PartLocation $model)
    {
        $this->model = $model;
    }
}
