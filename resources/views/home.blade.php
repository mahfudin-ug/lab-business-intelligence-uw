@extends('layouts.master')

@section('style')
<style>
</style>
@endsection

@section('content')
<div class="page-inner">
  {{-- <h4 class="page-title">Instructor Summary</h4> --}}
  {{-- <div class="page-category">
    <ul>
      <li>Average number of students per instructor is <b>{{ $avgStudent }}</b>.</li>
  <li>Average number of courses per instructor is <b>{{ $avgCourse }}</b>.</li>
  <li>Information benefits: <br>
    - Determining the minimum number of students and courses for an instructor<br>
    - Determining superior instructors
  </li>
  </ul>
</div> --}}

<div class="row">
  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <div class="card-title"><small>GPA distribution based on</small> Instructor</div>
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
          <canvas id="instructorChart" style="width: 463px; height: 400px; display: block;" width="463" height="300"
            class="chartjs-render-monitor"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <div class="card-title"><small>GPA distribution based on</small> Course</div>
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
          <canvas id="classChart" style="width: 463px; height: 400px; display: block;" width="463" height="300"
            class="chartjs-render-monitor"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <div class="card-title"><small>GPA distribution based on</small> Subject</div>
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
          <canvas id="subjectChart" style="width: 463px; height: 400px; display: block;" width="463" height="300"
            class="chartjs-render-monitor"></canvas>
        </div>
      </div>
    </div>
  </div>

</div>

</div>
@endsection

@section ('script')
<script type="text/javascript">
  var options = {
      responsive: true,
      maintainAspectRatio: false,
      legend: {
        position: 'bottom',
        labels: {
          fontColor: 'rgb(154, 154, 154)',
          fontSize: 11,
          usePointStyle: true,
          padding: 20
        }
      },
      pieceLabel: {
        render: 'percentage',
        fontColor: 'white',
        fontSize: 14,
      },
      // tooltips: true,
      layout: {
        padding: {
          left: 20,
          right: 20,
          top: 20,
          bottom: 20
        }
      }
    };

  var backgroundColor = ['#8BC34A', '#03A9F4', '#26A69A', '#D4E157', "#FFEB3B", "#fdaf4b", "#FF5252"];
  var instructorChart = document.getElementById('instructorChart').getContext('2d'),
      classChart = document.getElementById('classChart').getContext('2d'),
      subjectChart = document.getElementById('subjectChart').getContext('2d');

  var myPieChart = new Chart(instructorChart, {
    type: 'pie',
    data: {
      datasets: [{
        data: {!! json_encode($instructorSummary['data']) !!},
        backgroundColor: backgroundColor,
        borderWidth: 0
      }],
      labels: {!! json_encode($instructorSummary['label']) !!}
    },
    options: options
  });

  var myPieChart = new Chart(classChart, {
    type: 'pie',
    data: {
      datasets: [{
        data: {!! json_encode($courseSummary['data']) !!},
        backgroundColor: backgroundColor,
        borderWidth: 0
      }],
      labels: {!! json_encode($courseSummary['label']) !!}
    },
    options: options
  });

  var myPieChart = new Chart(subjectChart, {
    type: 'pie',
    data: {
      datasets: [{
        data: {!! json_encode($subjectSummary['data']) !!},
        backgroundColor: backgroundColor,
        borderWidth: 0
      }],
      labels: {!! json_encode($subjectSummary['label']) !!}
    },
    options: options
  });


</script>
<script src="{{ asset('js/canvasjs.min.js') }}"></script>
@endsection
