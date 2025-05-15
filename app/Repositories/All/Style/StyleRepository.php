<?php

namespace App\Repositories\All\Style;

use App\Models\StyleSetting;
use App\Repositories\All\Style\StyleInterface;
use App\Repositories\Base\BaseRepository;

class StyleRepository extends BaseRepository implements StyleInterface
{
    /**
     * @var StyleSetting
     */
    protected $model;

    /**
     *
     * @param StyleSetting $model
     */
    public function __construct(StyleSetting $model)
    {
        $this->model = $model;
    }
}
