<?php

namespace App\Repositories\All\Color;

use App\Models\ColorSetting;
use App\Repositories\All\Color\ColorInterface;
use App\Repositories\Base\BaseRepository;

class ColorRepository extends BaseRepository implements ColorInterface
{
    /**
     * @var ColorSetting
     */
    protected $model;

    /**
     *
     * @param ColorSetting $model
     */
    public function __construct(ColorSetting $model)
    {
        $this->model = $model;
    }
}
