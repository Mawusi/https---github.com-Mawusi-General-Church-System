<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupChurch extends Model
{
    use HasFactory;

    protected $fillable = ['country_id', 'zone_id', 'pastor', 'name'];

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function zone(){
        return $this->belongsTo(Zone::class);
    }

    public function churches(){
        return $this->hasMany(Church::class);
    }

    public function fellowships(){
        return $this->hasMany(Fellowship::class);
    }

    public function soul_winners(){
        return $this->hasMany(SoulWinner::class);
    }

    public function souls(){
        return $this->hasMany(Soul::class);
    }

    
}
