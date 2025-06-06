<?php

namespace App\Repositories\All\Operation;

use App\Models\Operation;
use App\Repositories\All\Operation\OperationInterface;
use App\Repositories\Base\BaseRepository;

class OperationRepository extends BaseRepository implements OperationInterface
{
    /**
     * @var Operation
     */
    protected $model;

    /**
     *
     * @param Operation $model
     */
    public function __construct(Operation $model)
    {
        $this->model = $model;
    }
}
