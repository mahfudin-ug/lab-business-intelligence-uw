@extends('layouts.master')

@section('content')
<div class="page-inner">
  <h4 class="page-title">Grade Summary</h4>
  <div class="page-category">
    <ul>
      <li>Average total of GPA per course is ?.</li>
      <li>Average total of GPA per instructor is ?.</li>
      <li>Average total of GPA per department is ?.</li>
      <li>Information benefits: <br>
         - Determining the minimum total of GPA for a course, an instructor, and a department<br>
         - Determining hard courses, instructors and departments to get GPA<br>
         - Determining easy courses, instructors and departments to get GPA<br>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Top Best Performing Courses</div>
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
            <canvas id="bestCourses" width="392" height="300" class="chartjs-render-monitor"
              style="display: block; width: 392px; height: 300px;"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Top Worst Performing Courses</div>
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
            <canvas id="worstCourses" width="392" height="300" class="chartjs-render-monitor"
              style="display: block; width: 392px; height: 300px;"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Top Best Performing Instructors</div>
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
            <canvas id="bestInstructors" width="392" height="300" class="chartjs-render-monitor"
              style="display: block; width: 392px; height: 300px;"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Top Worst Performing Instructors</div>
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

    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Top Best Performing Departments</div>
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
            <canvas id="bestSubjects" width="392" height="300" class="chartjs-render-monitor"
              style="display: block; width: 392px; height: 300px;"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Top Worst Performing Departments</div>
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
            <canvas id="worstSubjects" width="392" height="300" class="chartjs-render-monitor"
              style="display: block; width: 392px; height: 300px;"></canvas>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection

@section ('script')
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
  var bestCoursesChart = document.getElementById('bestCourses').getContext('2d');
  var bestCourses = {!!json_encode($bestCourses) !!};
  var worstCoursesChart = document.getElementById('worstCourses').getContext('2d');
  var worstCourses = {!!json_encode($worstCourses) !!};

  var bestInstructorsChart = document.getElementById('bestInstructors').getContext('2d');
  var bestInstructors = {!!json_encode($bestInstructors) !!};
  var worstInstructorsChart = document.getElementById('worstInstructors').getContext('2d');
  var worstInstructors = {!!json_encode($worstInstructors) !!};

  var bestSubjectsChart = document.getElementById('bestSubjects').getContext('2d');
  var bestSubjects = {!!json_encode($bestSubjects) !!};
  var worstSubjectsChart = document.getElementById('worstSubjects').getContext('2d');
  var worstSubjects = {!!json_encode($worstSubjects) !!};

  /* Courses charts */
  var myBestCoursesChart = new Chart(bestCoursesChart, {
    type: 'bar',
    data: {
      labels: bestCourses.label,
      datasets: [{
        label: "Average GPA",
        backgroundColor: '#8BC34A',
        borderColor: '#8BC34A',
        data: bestCourses.value,
      }, {
        label: "Average Student Number",
        backgroundColor: '#177dff',
        borderColor: '#177dff',
        data: bestCourses.avg,
      }],
    },
    options: options
  });
  var myWorstCoursesChart = new Chart(worstCoursesChart, {
    type: 'bar',
    data: {
      labels: worstCourses.label,
      datasets: [{
        label: "Average GPA",
        backgroundColor: '#F44336',
        borderColor: '#F44336',
        data: worstCourses.value,
      }, {
        label: "Average Student Number",
        backgroundColor: '#177dff',
        borderColor: '#177dff',
        data: worstCourses.avg,
      }],
    },
    options: options
  });

  /* Instructor charts */
  var myBestInstructorsChart = new Chart(bestInstructorsChart, {
    type: 'bar',
    data: {
      labels: bestInstructors.label,
      datasets: [{
        label: "Average GPA",
        backgroundColor: '#8BC34A',
        borderColor: '#8BC34A',
        data: bestInstructors.value,
      }, {
        label: "Average Student Number",
        backgroundColor: '#177dff',
        borderColor: '#177dff',
        data: bestInstructors.avg,
      }],
    },
    options: options
  });
  var myWorstInstructorsChart = new Chart(worstInstructorsChart, {
    type: 'bar',
    data: {
      labels: worstInstructors.label,
      datasets: [{
        label: "Average GPA",
        backgroundColor: '#F44336',
        borderColor: '#F44336',
        data: worstInstructors.value,
      }, {
        label: "Average Student Number",
        backgroundColor: '#177dff',
        borderColor: '#177dff',
        data: worstInstructors.avg,
      }],
    },
    options: options
  });

  /* Subject charts */
  var myBestSubjectsChart = new Chart(bestSubjectsChart, {
    type: 'bar',
    data: {
      labels: bestSubjects.label,
      datasets: [{
        label: "Average GPA",
        backgroundColor: '#8BC34A',
        borderColor: '#8BC34A',
        data: bestSubjects.value,
      }, {
        label: "Average Student Number",
        backgroundColor: '#177dff',
        borderColor: '#177dff',
        data: bestSubjects.avg,
      }],
    },
    options: options
  });
  var myWorstSubjectsChart = new Chart(worstSubjectsChart, {
    type: 'bar',
    data: {
      labels: worstSubjects.label,
      datasets: [{
        label: "Average GPA",
        backgroundColor: '#F44336',
        borderColor: '#F44336',
        data: worstSubjects.value,
      }, {
        label: "Average Student Number",
        backgroundColor: '#177dff',
        borderColor: '#177dff',
        data: worstSubjects.avg,
      }],
    },
    options: options
  });

</script>
@endsection
