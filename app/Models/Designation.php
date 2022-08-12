<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function soul_winners(){
        return $this->hasMany(SoulWinner::class);
    }

    public function souls(){
        return $this->hasMany(Soul::class);
    }

    public function fellowship(){
        return $this->belongsTo(Fellowship::class);
    }
}
