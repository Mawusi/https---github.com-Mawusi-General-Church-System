<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoulWinner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'contact',
        'location',
        'cell',

        'country_id', 
        'zone_id',
        'group_church_id', 
        'church_id', 

        'fellowship_id',
        'designation_id'
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

    public function church(){
        return $this->belongsTo(Church::class);
    }

    public function fellowship(){
        return $this->belongsTo(Fellowship::class);
    }

    public function designation(){
        return $this->belongsTo(Designation::class);
    }

    public function souls(){
        return $this->hasMany(Soul::class);
    }
}
