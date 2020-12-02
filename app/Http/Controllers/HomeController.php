<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Phpml\Clustering\KMeans;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $gradeRange = [
            ['grade' => 'A', 'range' => ['3.51', '4.00']],
            ['grade' => 'AB', 'range' => ['3.01', '3.50']],
            ['grade' => 'B', 'range' => ['2.51', '3.00']],
            ['grade' => 'BC', 'range' => ['2.01', '2.50']],
            ['grade' => 'C', 'range' => ['1.01', '2.00']],
            ['grade' => 'D', 'range' => ['0.01', '1.00']],
            ['grade' => 'F', 'range' => ['0.00', '0.00']]
        ];
        
        $instructors = DB::table('instructor_gpas')->get();
        $courses = DB::table('course_gpas')->get();
        $subjects = DB::table('subject_gpas')->get();

        $instructorSummary = ['label' => [], 'data' => []];
        $courseSummary = ['label' => [], 'data' => []];
        $subjectSummary = ['label' => [], 'data' => []];

        foreach ($gradeRange as $grade) {
            array_push($instructorSummary['data'], $instructors->whereBetween('avg_gpa', $grade['range'])->count());
            array_push($courseSummary['data'], $courses->whereBetween('avg_gpa', $grade['range'])->count());
            array_push($subjectSummary['data'], $subjects->whereBetween('avg_gpa', $grade['range'])->count());
            
            if ($grade['grade'] == 'F') {
                array_push($instructorSummary['label'], $grade['grade'] .' ('. $grade['range'][0] .')');
                array_push($courseSummary['label'], $grade['grade'] .' ('. $grade['range'][0] .')');
                array_push($subjectSummary['label'], $grade['grade'] .' ('. $grade['range'][0] .')');
            } else {
                array_push($instructorSummary['label'], $grade['grade'] .' ('. implode($grade['range'], ' - ') .')');
                array_push($courseSummary['label'], $grade['grade'] .' ('. implode($grade['range'], ' - ') .')');
                array_push($subjectSummary['label'], $grade['grade'] .' ('. implode($grade['range'], ' - ') .')');
            }

        }

        return view('home', compact('instructorSummary', 'courseSummary', 'subjectSummary'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function gradeClustering()
    {
        $courses = DB::table('course_grades')
            ->where('term_code', '1182')
            ->where('num_grades', '>', 0)
            ->get();

        // prepare data
        $data = $courses->map(function ($item, $key) {
            return [
                $item->a_count,
                $item->ab_count,
                $item->b_count,
                $item->bc_count,
                $item->c_count,
                $item->d_count,
                $item->f_count
            ];
        });
        
        $kmeans = new KMeans(5);
        $dataClustered = $kmeans->cluster($data->toArray());
        
        $clusteringGradeA = array();
        $clusteringGradeAB = array();
        $clusteringGradeB = array();
        $clusteringGradeBC = array();
        $clusteringGradeC = array();
        $clusteringGradeD = array();
        $clusteringGradeF = array();
        
        $summaries = array();
        $clusteringLabels = array();
        
        foreach ($dataClustered as $clusterKey=>$cluster) {
            $clusteringGradeA[$clusterKey] = array();
            $clusteringGradeAB[$clusterKey] = array();
            $clusteringGradeB[$clusterKey] = array();
            $clusteringGradeBC[$clusterKey] = array();
            $clusteringGradeC[$clusterKey] = array();
            $clusteringGradeD[$clusterKey] = array();
            $clusteringGradeF[$clusterKey] = array();

            $clusteringLabels[$clusterKey] = array();
            $clusterCollect = collect($cluster);
            $summaries[$clusterKey] = [
                'name' => 'Cluster '. ($clusterKey+1),
                'length' => $clusterCollect->count(),
                'a_range' => $clusterCollect->min(0) .'-'. $clusterCollect->max(0),
                'ab_range' => $clusterCollect->min(1) .'-'. $clusterCollect->max(1),
                'b_range' => $clusterCollect->min(2) .'-'. $clusterCollect->max(2),
                'bc_range' => $clusterCollect->min(3) .'-'. $clusterCollect->max(3),
                'c_range' => $clusterCollect->min(4) .'-'. $clusterCollect->max(4),
                'd_range' => $clusterCollect->min(5) .'-'. $clusterCollect->max(5),
                'f_range' => $clusterCollect->min(6) .'-'. $clusterCollect->max(6)
            ];
            // dd ($cluster, collect($cluster)->min(0));
            
            foreach ($cluster as $courseKey=>$course) {
                $floor = ($clusterKey == 0) ? $clusterKey : ($clusterKey-0.3);
                $upper = ($clusterKey == 4) ? $clusterKey : ($clusterKey+0.3);
                $x = rand($floor*100, $upper*100)/100;

                array_push($clusteringGradeA[$clusterKey], ['x' => $x, 'y' => $course[0]]);
                array_push($clusteringGradeAB[$clusterKey], ['x' => $x, 'y' => $course[1]]);
                array_push($clusteringGradeB[$clusterKey], ['x' => $x, 'y' => $course[2]]);
                array_push($clusteringGradeBC[$clusterKey], ['x' => $x, 'y' => $course[3]]);
                array_push($clusteringGradeC[$clusterKey], ['x' => $x, 'y' => $course[4]]);
                array_push($clusteringGradeD[$clusterKey], ['x' => $x, 'y' => $course[5]]);
                array_push($clusteringGradeF[$clusterKey], ['x' => $x, 'y' => $course[6]]);

                array_push($clusteringLabels[$clusterKey], $courses[$courseKey]->name); 
            }

        }

        return view('clustering', compact(
            'clusteringGradeA',
            'clusteringGradeAB',
            'clusteringGradeB',
            'clusteringGradeBC',
            'clusteringGradeC',
            'clusteringGradeD',
            'clusteringGradeF',
            'clusteringLabels',
            'summaries'
        ));
    }
}
