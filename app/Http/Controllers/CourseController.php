<?php

namespace App\Http\Controllers;

use App\Instructor;
use Illuminate\Http\Request;
use Phpml\Clustering\KMeans;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Find top course based on GPA
        $courses = DB::table('course_gpas')->get();

        $data = $courses->map(function ($item, $key) {
            return [
                $item->avg_gpa,
                $item->avg_num_grades,
                $item->total_num_grades
            ];
        });

        $kmeans = new KMeans(4);
        $dataClustered = $kmeans->cluster($data->toArray());

        $clusteringGpa = array();
        $clusteringGradeCourse = array();
        $clusteringGrade = array();
        $clusteringCourse = array();

        $clusteringLabels = array();

        foreach ($dataClustered as $clusterKey=>$cluster) {
            $clusteringGpa[$clusterKey] = array();
            $clusteringGradeCourse[$clusterKey] = array();
            $clusteringGrade[$clusterKey] = array();
            $clusteringCourse[$clusterKey] = array();

            $clusteringLabels[$clusterKey] = array();
            
            foreach ($cluster as $courseKey=>$course) {
                $floor = ($clusterKey == 0) ? $clusterKey : ($clusterKey-0.3);
                $upper = ($clusterKey == 2) ? $clusterKey : ($clusterKey+0.3);
                $x = rand($floor*100, $upper*100)/100;

                array_push($clusteringGpa[$clusterKey], ['x' => $x, 'y' => $course[0]]);
                array_push($clusteringGradeCourse[$clusterKey], ['x' => $x, 'y' => $course[1]]);
                array_push($clusteringGrade[$clusterKey], ['x' => $x, 'y' => $course[2]]);
                array_push($clusteringCourse[$clusterKey], ['x' => $x, 'y' => $courses[$courseKey]->total_num_courses]);

                array_push($clusteringLabels[$clusterKey], $courses[$courseKey]->name); 
                $courses[$courseKey]->cluster = $clusterKey;
            }

        }


        $coursesAvgGpa = $courses->map( function($item) {
                                return [
                                    'label' => $item->name,
                                    'y' => $item->avg_gpa
                                ];
                            });
        $coursesAvgGrade = $courses->map( function($item) {
                                return [
                                    'label' => $item->name,
                                    'y' => $item->avg_num_grades
                                ];
                            });
        
     
        return view('course', compact(
            'coursesAvgGrade', 
            'coursesAvgGpa', 
            'clusteringGpa',
            'clusteringGradeCourse',
            'clusteringGrade',
            'clusteringCourse',
            'clusteringLabels',
            'courses'
        ));
    }

}
