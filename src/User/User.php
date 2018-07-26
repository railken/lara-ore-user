<?php

namespace Railken\LaraOre\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Config;
use Railken\Laravel\Manager\Contracts\AgentContract;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

/**
 * @property string $name
 * @property string $email
 * @property string $role
 * @property int    $enabled
 * @property string $notes
 * @property string $token
 */
class User extends Model implements EntityContract, AgentContract
{
    use Notifiable;
    use EntrustUserTrait { restore as private restore1; }
    use SoftDeletes { restore as private restore2; }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'enabled',
        'role',
        'notes',
        'token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
    ];

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = \Illuminate\Support\Facades\Config::get('ore.user.table');
        $this->fillable = array_merge($this->fillable, array_keys(Config::get('ore.user.attributes')));
    }

    /**
     * {@inheritdoc}
     */
    public function restore()
    {
        $this->restore1();
        $this->restore2();
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
