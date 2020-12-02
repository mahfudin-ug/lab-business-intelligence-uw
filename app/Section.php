<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'sections';
    public $timestamps = false;

    public function courseOfferings () {
        return $this->belongsTo(CourseOffering::class, 'course_offering_uuid', 'uuid');
    }
    public function room () {
        return $this->belongsTo(Room::class, 'room_uuid', 'uuid');
    }
    public function schedule () {
        return $this->belongsTo(Schedule::class, 'schedule_uuid', 'uuid');
    }
    public function instructors () {
        return $this->belongsToMany(Instructor::class, 'teachings', 'section_uuid', 'instructor_id', 'uuid', 'id');
    }
}
