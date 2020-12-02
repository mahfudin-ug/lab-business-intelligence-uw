@extends('layouts.master')

@section('style')
<style>
.myChartDiv {
  max-width: 1100px;
  max-height: 400px;
}
</style>
@endsection

@section('content')
<div class="page-inner">
  <h4 class="page-title">Instructor Summary</h4>
  <div class="page-category">
    <ul>
      <li>Average number of students per instructor is <b>{{ $avgStudent }}</b>.</li>
      <li>Average number of courses per instructor is <b>{{ $avgCourse }}</b>.</li>
      <li>Information benefits: <br>
         - Determining the minimum number of students and courses for an instructor<br>
         - Determining superior instructors
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Top Instructor with the Most Student</div>
        </div>
        <div class="card-body">
            <div class="myChartDiv">
              <canvas id="myChart" width="1100" height="400"></canvas>
            </div>
                      
        </div>
      </div>
    </div>

  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Top Instructor with the Most Student</div>
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
            <canvas id="mostStudents" width="392" height="300" class="chartjs-render-monitor"
              style="display: block; width: 392px; height: 300px;"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Top Instructor with the Most Course</div>
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
            <canvas id="worstInstructors" width="392" height="300" class="chartjs-render-monitor"
              style="display: block; width: 392px; height: 300px;"></canvas>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection

@section ('script')
<script src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@0.7.3"></script>
<script>
  /* Chart settings */
  var options = {
    responsive: true,
    maintainAspectRatio: false,
    legend: {
      position : 'bottom'
    },
    scales: {
      xAxes: [{
        ticks: {
          callback: function (value) {
            if (value.length > 4) {
              return value.substr(0, 3) + '...'; //truncate
            } else {
              return value
            }
          },
        },
        stacked: true,
      }],
      yAxes: [{
        stacked: true,
      }]
    },    
    tooltips: {
      mode: 'index',
      intersect: false,
      callbacks: {
        title: function (tooltipItems, data) {
          var idx = tooltipItems[0].index;
          return data.labels[idx]; //do something with title
        }
      }
    },
  };

  /* Dataset */
  var mostStudentsChart = document.getElementById('mostStudents').getContext('2d');
  var mostStudents = {!!json_encode($mostStudent) !!};
  var worstInstructorsChart = document.getElementById('worstInstructors').getContext('2d');
  var worstInstructors = {!!json_encode($mostCourse) !!};

  /* Instructors charts */
  var myMostStudentsChart = new Chart(mostStudentsChart, {
    type: 'bar',
    data: {
      labels: mostStudents.label,
      datasets: [{
        label: "Student",
        backgroundColor: '#8BC34A',
        borderColor: '#8BC34A',
        data: mostStudents.value,
      }, {
        label: "Student/Course",
        backgroundColor: '#177dff',
        borderColor: '#177dff',
        data: mostStudents.avg,
      }],
    },
    options: options
  });

  var myWorstInstructorsChart = new Chart(worstInstructorsChart, {
    type: 'bar',
    data: {
      labels: worstInstructors.label,
      datasets: [{
        label: "Course",
        backgroundColor: '#F44336',
        borderColor: '#F44336',
        data: worstInstructors.value,
      }, {
        label: "Student/Course",
        backgroundColor: '#177dff',
        borderColor: '#177dff',
        data: worstInstructors.avg,
      }],
    },
    options: options
  });

</script>
@endsection
