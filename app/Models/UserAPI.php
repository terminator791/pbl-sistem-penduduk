<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;


class UserAPI extends Model implements Authenticatable
{
    protected $table = 'usersAPI';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = true;
    public $incrementing = true;

    protected $guarded = ['id'];

    public function getAuthIdentifierName(){
        return 'username';
    }

    public function getAuthIdentifier(){
        return $this->username;
    }


    public function getAuthPassword(){
        return $this->password;
    }

    public function getRememberToken(){
        return $this->token;
    }

    public function setRememberToken($value){
        $this->token = $value;
    }

    public function getRememberTokenName(){
        return 'token';
    }
}
