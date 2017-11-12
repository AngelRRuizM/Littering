<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['user_id', 'lat', 'lng', 'address', 'name'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function pins(){
        return $this->hasMany(Pin::class);
    }
}
