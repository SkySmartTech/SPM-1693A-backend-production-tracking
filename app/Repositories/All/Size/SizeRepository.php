<?php

namespace App\Repositories\All\Size;

use App\Models\SizeSetting;
use App\Repositories\All\Size\SizeInterface;
use App\Repositories\Base\BaseRepository;

class SizeRepository extends BaseRepository implements SizeInterface
{
    /**
     * @var SizeSetting
     */
    protected $model;

    /**
     *
     * @param SizeSetting $model
     */
    public function __construct(SizeSetting $model)
    {
        $this->model = $model;
    }
}
