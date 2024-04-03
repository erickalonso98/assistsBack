<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipalitie extends Model
{
    use HasFactory;

    protected $table = 'municipalities';

    public function state(){
        return $this->belongsTo(State::class);
    }

    public function localities(){
        return $this->hasMany(Localitie::class);
    }
}
