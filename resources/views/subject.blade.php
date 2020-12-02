@extends('layouts.master')

@section('style')
<style>
</style>
@endsection

@section('content')
<div class="page-inner">
  {{-- <h4 class="page-title">Subject Summary</h4>
  <div class="page-category">
    <ul>
      <li>Average number of students per instructor is <b>?</b>.</li>
      <li>Average number of courses per instructor is <b>?</b>.</li>
      <li>Information benefits: <br>
         - Determining the minimum number of students and courses for an instructor<br>
         - Determining superior courses
      </li>
    </ul>
  </div> --}}
  
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Subject's Performance</div>
        </div>
        <div class="card-body">
            <div id="subjectChart" style="height: 400px; width: 100%;">
            </div>
        </div>
      </div>
    </div>
    
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">
            <span>Subject Clustering based on :</span> 

              <div class="selectgroup selectgroup-secondary selectgroup-pills">
                <label class="selectgroup-item">
                  <input type="radio" name="grade-input" value="A" class="selectgroup-input" checked="">
                  <span class="selectgroup-button selectgroup-button-icon">GPA</span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="grade-input" value="AB" class="selectgroup-input">
                  <span class="selectgroup-button selectgroup-button-icon">Student/Class</span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="grade-input" value="B" class="selectgroup-input">
                  <span class="selectgroup-button selectgroup-button-icon">Student</span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="grade-input" value="D" class="selectgroup-input">
                  <span class="selectgroup-button selectgroup-button-icon">Class</span>
                </label>
              </div>

          </div>
        </div>
        <div class="card-body">
          <div class="chart-container">
            <div class="chartjs-size-monitor"
              style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
              <div class="chartjs-size-monitor-expand"
                style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
              </div>
              <div class="chartjs-size-monitor-shrink"
                style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
              </div>
            </div>
            <canvas id="dataClustered" width="392" height="300" class="chartjs-render-monitor"
              style="display: block; width: 392px; height: 300px;"></canvas>
          </div>
          
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table id="multi-filter-select" class="display table table-striped table-hover" >
              <thead>
                <tr>
                  <th>#</th>
                  <th width="500px">Name</th>
                  <th>GPA</th>
                  <th>Student/Class</th>
                  <th>Student</th>
                  <th>Class</th>
                  <th>Cluster</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th data-skip=true></th>
                  <th data-skip=true></th>
                  <th>GPA</th>
                  <th>Student/Class</th>
                  <th>Student</th>
                  <th>Class</th>
                  <th>Cluster</th>
                </tr>
              </tfoot>
              <tbody>
                @foreach ($subjects as $subject)
                <tr>
                  <td>{!! $loop->iteration !!}</td>
                  <td>{!! $subject->name !!}</td>
                  <td>{!! $subject->avg_gpa !!}</td>
                  <td>{!! $subject->avg_num_grades !!}</td>
                  <td>{!! $subject->total_num_grades !!}</td>
                  <td>{!! $subject->total_num_courses !!}</td>
                  <td>{!! $subject->cluster !!}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection

@section ('script')
<script type="text/javascript">
window.onload = function() {

  var subjectsAvgGpa = {!! $subjectsAvgGpa !!}
  var subjectsAvgGrade = {!! $subjectsAvgGrade !!}

  // Casting the y
  Object.keys(subjectsAvgGpa).forEach(k => {
    subjectsAvgGpa[k].y = parseFloat(subjectsAvgGpa[k].y);
    subjectsAvgGrade[k].y = parseFloat(subjectsAvgGrade[k].y);
  })

  var subjectChart = new CanvasJS.Chart("subjectChart",
    {
      zoomEnabled: true,
      toolTip:{   
        shared: true
      },
      legend: {
        horizontalAlign: "center",
        verticalAlign: "bottom", 
        fontSize: 15
      },
      axisY:{
          minimum: 0
      },
      data: [{
          type: "stackedColumn",
          name: 'GPA',
          showInLegend: true,
          dataPoints: subjectsAvgGpa
        },  
        {
          type: "stackedColumn",
          name: 'Students/Class',
          showInLegend: true,
          dataPoints: subjectsAvgGrade
      }]
    });
    subjectChart.render();

  // Clustering
  /* Dataset */
  var dataClusteredLabels = {!!json_encode($clusteringLabels) !!};
  var dataClusteredChart = document.getElementById('dataClustered').getContext('2d');
  var dataClusteredGpa = {!!json_encode($clusteringGpa) !!};
  var dataClusteredGradeCourse = {!!json_encode($clusteringGradeCourse) !!};
  var dataClusteredGrade = {!!json_encode($clusteringGrade) !!};
  var dataClusteredCourse = {!!json_encode($clusteringCourse) !!};

  /* Instructors charts */
  var myDataClusteredChart = new Chart(dataClusteredChart, {
    type: 'scatter',
    data: {
      labels: dataClusteredLabels,
      datasets: [{
        label: "Cluster 1",
        backgroundColor: '#FF5252',
        borderColor: '#FF5252',
        data: dataClusteredGpa[0]
      },{
        label: "Cluster 2",
        backgroundColor: '#673AB7',
        borderColor: '#673AB7',
        data: dataClusteredGpa[1]
      },{
        label: "Cluster 3",
        backgroundColor: '#26A69A',
        borderColor: '#26A69A',
        data: dataClusteredGpa[2]
      },{
        label: "Cluster 4",
        backgroundColor: '#D4E157',
        borderColor: '#D4E157',
        data: dataClusteredGpa[3]
      }],
    },
    options: clusteringOptions
  });

  $('input[name=grade-input]').change( function() {
    switch(this.value) {
      case 'A':
        addData(myDataClusteredChart, dataClusteredLabels, dataClusteredGpa);
        break;
      case 'AB':
        addData(myDataClusteredChart, dataClusteredLabels, dataClusteredGradeCourse);
        break;
      case 'B':
        addData(myDataClusteredChart, dataClusteredLabels, dataClusteredGrade);
        break;
      case 'D':
        addData(myDataClusteredChart, dataClusteredLabels, dataClusteredCourse);
        break;
    }
  })

  function addData(chart, label, data) {
    chart.data.datasets.forEach((dataset, key) => {
        dataset.data = data[key];
    });
    chart.update();
  }

  $('#multi-filter-select').DataTable(datatablesOptions);

}

  </script>
  
@endsection
