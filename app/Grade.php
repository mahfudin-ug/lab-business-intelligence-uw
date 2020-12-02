<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table = 'grade_distributions';
    public $timestamps = false;
    protected $appends = array('gpa');

    const GRADE = [
        'A' => 4,
        'AB' => 3.5,
        'B' => 3,
        'BC' => 2.5,
        'C' => 2,
        'D' => 1,
        'F' => 0,
    ];

    public function getGpaAttribute()
    {
        if (($gradeNumber = $this->a_count + $this->ab_count + $this->b_count + $this->bc_count + $this->c_count + $this->d_count + $this->f_count) == 0) {
            return false;

        } else {
            $gpa = (($this->a_count * self::GRADE['A']) + ($this->ab_count * self::GRADE['AB']) + ($this->b_count * self::GRADE['B']) + ($this->bc_count * self::GRADE['BC']) + ($this->c_count * self::GRADE['C']) + ($this->d_count * self::GRADE['D']) + ($this->f_count * self::GRADE['F'])) 
                    / ($this->a_count + $this->ab_count + $this->b_count + $this->bc_count + $this->c_count + $this->d_count + $this->f_count);
    
            // TODO: 2 decimal point
            return $gpa;  
        }
    }

    /**
     * Model Relation
     */
    public function courseOffering () {
        return $this->belongsTo(CourseOffering::class, 'course_offering_uuid', 'uuid');
    }
}
