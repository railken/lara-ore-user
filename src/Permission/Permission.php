<?php

namespace Railken\LaraOre\Permission;

use Zizaco\Entrust\EntrustPermission;

/**
 * @static firstOrCreate
 */
class Permission extends EntrustPermission
{
    protected $fillable = ['name'];
}
