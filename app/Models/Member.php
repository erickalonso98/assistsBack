<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'members';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function events(){
        return $this->belongsToMany(Event::class);
    }
}
