<?php

namespace Amethyst\Models;

use Amethyst\Core\ConfigurableModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Railken\Lem\Contracts\EntityContract;

/**
 * @property string $name
 * @property string $email
 * @property string $role
 * @property int    $enabled
 * @property string $notes
 * @property string $token
 */
class User extends Model implements EntityContract
{
    use SoftDeletes;
    use ConfigurableModel;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->ini('amethyst.user.data.user');
        parent::__construct($attributes);
    }

    /**
     * Set password attribute.
     *
     * @param string $pass
     */
    public function setPasswordAttribute($pass)
    {
        $this->attributes['password'] = bcrypt($pass);
    }
}
