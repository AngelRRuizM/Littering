<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Location extends Model
{
    protected $fillable = ['user_id', 'lat', 'lng', 'address', 'name'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function pins(){
        return $this->hasMany(Pin::class);
    }

    public static function validate($data){
        return Validator::make($data, [
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'name' => 'required|max:50|min:1',
            'address' => 'required|max:150|min:1',
            'user_id' => 'reqquired|nummeric|exists:users,id'
        ]);
    }
}
