<?php

namespace App;

use App\CourseOffering;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    public $timestamps = false;

    /**
     * Model Relation
     */
    public function courseOfferings () {
        return $this->hasMany(CourseOffering::class, 'course_uuid', 'uuid');
    }
    public function grades () {
        return $this->hasManyThrough(Grade::class, CourseOffering::class, 'course_uuid', 'course_offering_uuid', 'uuid', 'uuid');
    }

}
