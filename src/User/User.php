<?php

namespace Railken\LaraOre\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Railken\Laravel\Manager\Contracts\AgentContract;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Support\Facades\Config;

class User extends Authenticatable implements EntityContract, AgentContract
{
    use HasApiTokens;
    use Notifiable;
    use EntrustUserTrait { restore as private restore1; }
    use SoftDeletes { restore as private restore2; }

    /**
     * {@inheritDoc}
     */
    public function restore()
    {
        $this->restore1();
        $this->restore2();
    }

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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pendingEmail()
    {
        return $this->hasOne(UserPendingEmail::class, 'user_id')->latest();
    }

    /**
     * Set password attribute.
     *
     * @param string $pass
     *
     * @return void
     */
    public function setPasswordAttribute($pass)
    {
        $this->attributes['password'] = bcrypt($pass);
    }

    /**
     * Retrieve user for passport oauth.
     *
     * @param string $identifier
     *
     * @return User
     */
    public function findForPassport($identifier)
    {
        return (new \Railken\LaraOre\User\UserManager())->getRepository()->getQuery()->orWhere(function ($q) use ($identifier) {
            return $q->orWhere('email', $identifier)->orWhere('name', $identifier);
        })->where('enabled', 1)->first();
    }
}
