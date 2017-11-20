<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ResidueType;

class Pin extends Model
{
    protected $fillable = ['user_id', 'residue_type_id', 'location_id'];
    protected $dates = ['updated_at'];

    public function residue_type(){
        return $this->belongsTo(ResidueType::class);
    }

    public function location(){
        return $this->belongsTo(Location::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
