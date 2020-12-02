<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';
    public $timestamps = false;

    
    public function sections () {
        return $this->hasMany(Section::class, 'schedule_uuid', 'uuid');
    }
}
