<?php

namespace Amethyst\Models;

use Amethyst\Core\ConfigurableModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Railken\Lem\Contracts\EntityContract;

/**
 * @property int $id
 * @property string $token
 * @property string $name
 * @property string $email
 * @property int    $enabled
 */
class User extends Model implements EntityContract
{
    use SoftDeletes;
    use ConfigurableModel;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Create a new Eloquent model instance.
     *
     * @param array<mixed> $attributes
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
    public function setPasswordAttribute($pass): void
    {
        $this->attributes['password'] = bcrypt($pass);
    }
}
