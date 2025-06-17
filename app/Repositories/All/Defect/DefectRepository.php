<?php

namespace App\Repositories\All\Defect;

use App\Models\Defect;
use App\Repositories\All\Defect\DefectInterface;
use App\Repositories\Base\BaseRepository;

class DefectRepository extends BaseRepository implements DefectInterface
{
    /**
     * @var Defect
     */
    protected $model;

    /**
     *
     * @param Defect $model
     */
    public function __construct(Defect $model)
    {
        $this->model = $model;
    }
}
