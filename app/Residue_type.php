<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pin;

class Residue_type extends Model
{
    public function pins(){
        return $this->hasMany(Pin::class);
    }
}
