<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    use HasFactory;

    protected $fillable = [
                            'country_id', 
                            'zone_id',
                            'group_church_id', 
                            'pastor', 
                            'name'
                        ];

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function zone(){
        return $this->belongsTo(Zone::class);
    }

    public function group_church(){
        return $this->belongsTo(GroupChurch::class);
    }

    public function soul_winners(){
        return $this->hasMany(SoulWinner::class);
    }

    public function souls(){
        return $this->hasMany(Soul::class);
    }

    public function fellowships(){
        return $this->hasMany(Fellowship::class);
    }
}
