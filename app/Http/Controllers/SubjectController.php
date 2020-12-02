<?php

namespace App\Http\Controllers;

use App\Instructor;
use Illuminate\Http\Request;
use Phpml\Clustering\KMeans;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Find top course based on GPA
        $subjects = DB::table('subject_gpas')->get();

        $data = $subjects->map(function ($item, $key) {
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
            
            foreach ($cluster as $subjectKey=>$subject) {
                $floor = ($clusterKey == 0) ? $clusterKey : ($clusterKey-0.3);
                $upper = ($clusterKey == 2) ? $clusterKey : ($clusterKey+0.3);
                $x = rand($floor*100, $upper*100)/100;

                array_push($clusteringGpa[$clusterKey], ['x' => $x, 'y' => $subject[0]]);
                array_push($clusteringGradeCourse[$clusterKey], ['x' => $x, 'y' => $subject[1]]);
                array_push($clusteringGrade[$clusterKey], ['x' => $x, 'y' => $subject[2]]);
                array_push($clusteringCourse[$clusterKey], ['x' => $x, 'y' => $subjects[$subjectKey]->total_num_courses]);

                array_push($clusteringLabels[$clusterKey], $subjects[$subjectKey]->name); 
                $subjects[$subjectKey]->cluster = $clusterKey;
            }

        }

        $subjectsAvgGpa = $subjects->map( function($item) {
                                return [
                                    'label' => $item->name,
                                    'y' => $item->avg_gpa
                                ];
                            });
        $subjectsAvgGrade = $subjects->map( function($item) {
                                return [
                                    'label' => $item->name,
                                    'y' => $item->avg_num_grades
                                ];
                            });

        return view('subject', compact(
            'subjectsAvgGrade', 
            'subjectsAvgGpa', 
            'clusteringGpa',
            'clusteringGradeCourse',
            'clusteringGrade',
            'clusteringCourse',
            'clusteringLabels',
            'subjects'
        ));
    }

}
