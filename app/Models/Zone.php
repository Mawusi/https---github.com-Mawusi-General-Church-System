<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = ['country_id', 'name'];

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function group_churches(){
        return $this->hasMany(GroupChurch::class);
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
