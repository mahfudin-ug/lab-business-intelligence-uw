<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';
    public $timestamps = false;
    
    public function courseOfferings () {
        return $this->belongsToMany(CourseOffering::class, 'subject_memberships', 'subject_code', 'course_offering_uuid', 'code', 'uuid');
    }
}
