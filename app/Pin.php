<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ResidueType;
use Illuminate\Support\Facades\Validator;

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

    public static function validate($data){
        return Validator::make($data, [
            'residue_type_id' => 'required|numeric|exists:residue_types,id',
            'location_id' => 'required|numeric|exists:locations,id',
        ]);
    }
}
