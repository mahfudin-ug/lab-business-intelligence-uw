<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseOffering extends Model
{
    protected $table = 'course_offerings';
    public $timestamps = false;

    const TERM_CODE = [
        1072 => '2006 Fall',
        1074 => '2007 Spring',
        1082 => '2007 Fall',
        1084 => '2008 Spring',
        1092 => '2008 Fall',
        1094 => '2009 Spring',
        1102 => '2009 Fall',
        1104 => '2010 Spring',
        1112 => '2010 Fall',
        1114 => '2011 Spring',
        1122 => '2011 Fall',
        1132 => '2012 Fall',
        1134 => '2013 Spring',
        1142 => '2013 Fall',
        1144 => '2014 Spring',
        1152 => '2014 Fall',
        1154 => '2015 Spring',
        1162 => '2015 Fall',
        1164 => '2016 Spring',
        1172 => '2016 Fall',
        1174 => '2017 Spring',
        1182 => '2017 Fall',
    ];

    
    /**
     * Model Relation
     */
    public function course () {
        return $this->belongsTo(Course::class, 'course_uuid', 'uuid');
    }
    public function grades () {
        return $this->hasMany(Grade::class, 'course_offering_uuid', 'uuid');
    }
    public function subjects () {
        return $this->belongsToMany(Subject::class, 'subject_memberships', 'course_offering_uuid', 'subject_code', 'uuid', 'code');
    }
    public function sections () {
        return $this->hasMany(Section::class, 'course_offering_uuid', 'uuid');
    }

}
