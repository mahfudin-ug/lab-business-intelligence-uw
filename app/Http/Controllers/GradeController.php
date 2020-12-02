<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Find top course based on GPA
//         $courses = DB::table('course_gpas')->get();
//         $avgGPACourse = $courses->avg('avg_gpa');
//         // $bestCourses = $courses
// dd ($courses->take(10), $courses->where('avg_gpa', '!=', null), $courses);

        $bestCourses = DB::table('course_gpas')
                    ->where('avg_num_grades', '>', 22)
                    ->orderByRaw('avg_gpa DESC NULLS LAST, avg_num_grades DESC')
                    ->take(10)
                    ->get();
        $worstCourses = DB::table('course_gpas')
                    ->where('avg_num_grades', '>', 22)
                    ->orderByRaw('avg_gpa ASC NULLS LAST, avg_num_grades DESC')
                    ->take(10)
                    ->get();

        $bestInstructors = DB::table('instructor_gpas')
                    ->where('avg_num_grades', '>', 29)
                    ->orderByRaw('avg_gpa DESC NULLS LAST, avg_num_grades DESC')
                    ->take(10)
                    ->get();
        $worstInstructors = DB::table('instructor_gpas')
                    ->where('avg_num_grades', '>', 29)
                    ->orderByRaw('avg_gpa ASC NULLS LAST, avg_num_grades DESC')
                    ->take(10)
                    ->get();        
        
        $bestSubjects = DB::table('subject_gpas')
                    ->where('avg_num_grades', '>', 21)
                    ->orderByRaw('avg_gpa DESC NULLS LAST, avg_num_grades DESC')
                    ->take(10)
                    ->get();
        $worstSubjects = DB::table('subject_gpas')
                    ->where('avg_num_grades', '>', 21)
                    ->orderByRaw('avg_gpa ASC NULLS LAST, avg_num_grades DESC')
                    ->take(10)
                    ->get();        
        
        $bestCourses = self::toChartDataset($bestCourses, 'name', 'avg_gpa', 'avg_num_grades');
        $worstCourses = self::toChartDataset($worstCourses, 'name', 'avg_gpa', 'avg_num_grades');
        $bestInstructors = self::toChartDataset($bestInstructors, 'name', 'avg_gpa', 'avg_num_grades');
        $worstInstructors = self::toChartDataset($worstInstructors, 'name', 'avg_gpa', 'avg_num_grades');
        $bestSubjects = self::toChartDataset($bestSubjects, 'name', 'avg_gpa', 'avg_num_grades');
        $worstSubjects = self::toChartDataset($worstSubjects, 'name', 'avg_gpa', 'avg_num_grades');
        
        return view('grade', compact('bestCourses', 'worstCourses', 'bestInstructors', 'worstInstructors', 'bestSubjects', 'worstSubjects'));
    }

}
