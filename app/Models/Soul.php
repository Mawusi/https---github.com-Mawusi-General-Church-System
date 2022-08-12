<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soul extends Model
{
    use HasFactory;

    protected $fillable = [
                    'country_id',
                    'zone_id',
                    'group_church_id',
                    'church_id',

                    'soul_winner_id',
                    'fellowship_id',
                    // 'designation_id',
                    
                    'name',
                    'email',
                    'contact', 
                    'location',
                    
                    
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

    public function soul_winner(){
        return $this->belongsTo(SoulWinner::class);
    }

    public function designation(){
        return $this->belongsTo(Designation::class);
    }

}
