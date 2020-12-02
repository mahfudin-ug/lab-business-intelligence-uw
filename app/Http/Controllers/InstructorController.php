<?php

namespace App\Http\Controllers;

use App\Instructor;
use Illuminate\Http\Request;
use Phpml\Clustering\KMeans;
use Illuminate\Support\Facades\DB;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Find top course based on GPA
        $instructors = DB::table('instructor_gpas')->get();

        $data = $instructors->map(function ($item, $key) {
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
            
            foreach ($cluster as $instructorKey=>$instructor) {
                $floor = ($clusterKey == 0) ? $clusterKey : ($clusterKey-0.3);
                $upper = ($clusterKey == 2) ? $clusterKey : ($clusterKey+0.3);
                $x = rand($floor*100, $upper*100)/100;

                array_push($clusteringGpa[$clusterKey], ['x' => $x, 'y' => $instructor[0]]);
                array_push($clusteringGradeCourse[$clusterKey], ['x' => $x, 'y' => $instructor[1]]);
                array_push($clusteringGrade[$clusterKey], ['x' => $x, 'y' => $instructor[2]]);
                array_push($clusteringCourse[$clusterKey], ['x' => $x, 'y' => $instructors[$instructorKey]->total_num_courses]);

                array_push($clusteringLabels[$clusterKey], $instructors[$instructorKey]->name); 
                $instructors[$instructorKey]->cluster = $clusterKey;
            }

        }

        $avgStudent = number_format($instructors->avg('total_num_grades'), 2);
        $avgCourse = number_format($instructors->avg('total_num_courses'), 2);

        $instructorsAvgGrade = $instructors->map( function($item) {
                                return [
                                    'label' => $item->name,
                                    'y' => number_format($item->avg_num_grades, 2)
                                ];
                            });
        $instructorsAvgGpa = $instructors->map( function($item) {
                                return [
                                    'label' => $item->name,
                                    'y' => number_format($item->avg_gpa, 2)
                                ];
                            });

                        
        return view('instructor', compact(
            'instructorsAvgGrade', 
            'instructorsAvgGpa', 
            'clusteringGpa',
            'clusteringGradeCourse',
            'clusteringGrade',
            'clusteringCourse',
            'clusteringLabels',
            'instructors',

            'avgStudent', 
            'avgCourse'
        ));
    }

}
