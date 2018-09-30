<?php

namespace Railken\Amethyst\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;
use Railken\Amethyst\Schemas\UserSchema;
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

    /** 
     * The attributes that should be hidden for arrays. 
     *  
     * @var array   
     */ 
    protected $hidden = [   
        'password', 
    ];
    
    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('amethyst.user.managers.user.table');
        $this->fillable = (new UserSchema())->getNameFillableAttributes();
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
