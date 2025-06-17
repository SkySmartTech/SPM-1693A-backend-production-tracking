<?php

namespace App\Repositories\All\ProductionUpdate;

use App\Models\ProductionUpdate;
use App\Repositories\All\ProductionUpdate\ProductionUpdateInterface;
use App\Repositories\Base\BaseRepository;

class ProductionUpdateRepository extends BaseRepository implements ProductionUpdateInterface
{
    /**
     * @var ProductionUpdate
     */
    protected $model;

    /**
     *
     * @param ProductionUpdate $model
     */
    public function __construct(ProductionUpdate $model)
    {
        $this->model = $model;
    }
}
