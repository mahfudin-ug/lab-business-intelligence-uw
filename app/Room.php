<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';
    public $timestamps = false;
    
    public function sections () {
        return $this->hasMany(Section::class, 'room_uuid', 'uuid');
    }
}
