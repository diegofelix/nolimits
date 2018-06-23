<?php
namespace NoLimits\User;

use Illuminate\Contracts\Auth\Authenticatable;
use MongolidLaravel\MongolidModel;

class User extends MongolidModel implements Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf',
        'phone',
        'zipCode',
        'street',
        'number',
        'complement',
        'district',
        'city',
        'state',
    ];

    protected $collection = 'users';

    public function getAuthIdentifierName()
    {
        return '_id';
    }

    public function getAuthIdentifier()
    {
        return $this->_id;
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($rememberToken)
    {
        $this->remember_token = $rememberToken;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
