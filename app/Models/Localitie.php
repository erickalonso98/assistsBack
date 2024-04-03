<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localitie extends Model
{
    use HasFactory;

    protected $table = 'localities';

    public function municipalitie(){
        return $this->belongsTo(Municipalitie::class);
    }
}
