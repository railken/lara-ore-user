<?php

namespace Railken\LaraOre\User;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Railken\Laravel\Manager\Contracts\AgentContract;
use Railken\Laravel\Manager\Contracts\EntityContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable implements EntityContract, AgentContract
{
    use HasApiTokens, Notifiable, EntrustUserTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ore_users';

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
        'password', 'remember_token',
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
