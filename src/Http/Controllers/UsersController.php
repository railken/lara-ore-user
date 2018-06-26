<?php

namespace Railken\LaraOre\Http\Controllers;

use Railken\LaraOre\Api\Http\Controllers\RestController;
use Railken\LaraOre\Api\Http\Controllers\Traits as RestTraits;
use Railken\LaraOre\User\UserManager;
use Illuminate\Support\Facades\Config;

class UsersController extends RestController
{
    use RestTraits\RestIndexTrait;
    use RestTraits\RestShowTrait;
    use RestTraits\RestCreateTrait;
    use RestTraits\RestUpdateTrait;
    use RestTraits\RestRemoveTrait;

    public $queryable = [
        'id',
        'token',
        'name',
        'email',
        'password',
        'notes',
        'enabled',
        'created_at',
        'updated_at',
    ];

    public $fillable = [
        'name',
        'token',
        'email',
        'password',
        'notes',
        'enabled',
    ];

    /**
     * Construct.
     */
    public function __construct(UserManager $manager)
    {
        $this->queryable = array_merge($this->queryable, array_keys(Config::get('ore.user.attributes')));
        $this->fillable = array_merge($this->fillable, array_keys(Config::get('ore.user.attributes')));
        $this->manager = $manager;
        $this->manager->setAgent($this->getUser());
        parent::__construct();
    }

    /**
     * Create a new instance for query.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function getQuery()
    {
        return $this->manager->repository->getQuery();
    }
}
