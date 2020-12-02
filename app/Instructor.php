<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $table = 'instructors';
    public $timestamps = false;

    
    public function sections () {
        return $this->belongsToMany(Section::class, 'teachings', 'instructor_id', 'section_uuid', 'id', 'uuid');
    }
}
