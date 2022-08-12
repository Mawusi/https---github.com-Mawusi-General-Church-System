<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function zones(){
        return $this->hasMany(Zone::class);
    }

    public function group_churches(){
        return $this->hasMany(GroupChurch::class);
    }

    public function churches(){
        return $this->hasMany(GroupChurch::class);
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
