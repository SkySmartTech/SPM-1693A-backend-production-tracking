<?php

namespace App\Repositories\All\AddUser;

use App\Models\User;
use App\Repositories\All\AddUser\AddUserInterface;
use App\Repositories\Base\BaseRepository;

class AddUserRepository extends BaseRepository implements AddUserInterface
{
    /**
     * @var User
     */
    protected $model;

    /**
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
