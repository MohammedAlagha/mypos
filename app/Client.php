<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];

    protected $fillable = ['name','mobile','phone','address'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }//end getNameAttribute
}
