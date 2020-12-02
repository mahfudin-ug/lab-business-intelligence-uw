@extends('layouts.master')

@section('content')
<div class="page-inner">
  <h4 class="page-title">Grade Clustering</h4>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">
            <span>Course Clustering on Grade :</span> 

              <div class="selectgroup selectgroup-secondary selectgroup-pills">
                <label class="selectgroup-item">
                  <input type="radio" name="grade-input" value="A" class="selectgroup-input" checked="">
                  <span class="selectgroup-button selectgroup-button-icon">A</span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="grade-input" value="AB" class="selectgroup-input">
                  <span class="selectgroup-button selectgroup-button-icon">AB</span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="grade-input" value="B" class="selectgroup-input">
                  <span class="selectgroup-button selectgroup-button-icon">B</span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="grade-input" value="BC" class="selectgroup-input">
                  <span class="selectgroup-button selectgroup-button-icon">BC</span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="grade-input" value="C" class="selectgroup-input">
                  <span class="selectgroup-button selectgroup-button-icon">C</span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="grade-input" value="D" class="selectgroup-input">
                  <span class="selectgroup-button selectgroup-button-icon">D</span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="grade-input" value="F" class="selectgroup-input">
                  <span class="selectgroup-button selectgroup-button-icon">F</span>
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
          <div class="card-sub">
            <legend>Summary</legend>
            <table class="table table-head-bg-primary mt-4">
              <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col">Course Total</th>
                  <th scope="col">A Range</th>
                  <th scope="col">AB Range</th>
                  <th scope="col">B Range</th>
                  <th scope="col">BC Range</th>
                  <th scope="col">C Range</th>
                  <th scope="col">D Range</th>
                  <th scope="col">F Range</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($summaries as $summary)
                  <tr>
                    <th>{{ $summary['name'] }}</th>
                    <td>{{ $summary['length'] }}</td>
                    <td>{{ $summary['a_range'] }}</td>
                    <td>{{ $summary['ab_range'] }}</td>
                    <td>{{ $summary['b_range'] }}</td>
                    <td>{{ $summary['bc_range'] }}</td>
                    <td>{{ $summary['c_range'] }}</td>
                    <td>{{ $summary['d_range'] }}</td>
                    <td>{{ $summary['f_range'] }}</td>
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
        display: false
      }],
      yAxes: [{
        
      }],
    },    
    tooltips: {
      mode: 'point',
      intersect: false,
      callbacks: {
        title: function (tooltipItems, data) {
          var dsId = tooltipItems[0].datasetIndex;
          // var indexId = tooltipItems[0].index;
          // return data.labels[dsId][indexId]; //do something with title
          return data.datasets[dsId].label;
        },
        label: function (tooltipItems, data) {

          var dsId = tooltipItems.datasetIndex;
          var indexId = tooltipItems.index;
          return data.labels[dsId][indexId] + ' : ' + data.datasets[dsId].data[indexId].y;

        }
      }
    },
  };

  /* Dataset */
  var dataClusteredLabels = {!!json_encode($clusteringLabels) !!};
  var dataClusteredChart = document.getElementById('dataClustered').getContext('2d');
  var dataClusteredA = {!!json_encode($clusteringGradeA) !!};
  var dataClusteredAB = {!!json_encode($clusteringGradeAB) !!};
  var dataClusteredB = {!!json_encode($clusteringGradeB) !!};
  var dataClusteredBC = {!!json_encode($clusteringGradeBC) !!};
  var dataClusteredC = {!!json_encode($clusteringGradeC) !!};
  var dataClusteredD = {!!json_encode($clusteringGradeD) !!};
  var dataClusteredF = {!!json_encode($clusteringGradeF) !!};

  /* Instructors charts */
  var myDataClusteredChart = new Chart(dataClusteredChart, {
    type: 'scatter',
    data: {
      labels: dataClusteredLabels,
      datasets: [{
        label: "Cluster 1",
        backgroundColor: '#FF5252',
        borderColor: '#FF5252',
        data: dataClusteredA[0]
      },{
        label: "Cluster 2",
        backgroundColor: '#673AB7',
        borderColor: '#673AB7',
        data: dataClusteredA[1]
      },{
        label: "Cluster 3",
        backgroundColor: '#26A69A',
        borderColor: '#26A69A',
        data: dataClusteredA[2]
      },{
        label: "Cluster 4",
        backgroundColor: '#D4E157',
        borderColor: '#D4E157',
        data: dataClusteredA[3]
      },{
        label: "Cluster 5",
        backgroundColor: '#FF9800',
        borderColor: '#FF9800',
        data: dataClusteredA[4]
      }],
    },
    options: options
  });

  $('input[name=grade-input]').change( function() {
    switch(this.value) {
      case 'A':
        addData(myDataClusteredChart, dataClusteredLabels, dataClusteredA);
        break;
      case 'AB':
        addData(myDataClusteredChart, dataClusteredLabels, dataClusteredAB);
        break;
      case 'B':
        addData(myDataClusteredChart, dataClusteredLabels, dataClusteredB);
        break;
      case 'BC':
        addData(myDataClusteredChart, dataClusteredLabels, dataClusteredBC);
        break;
      case 'C':
        addData(myDataClusteredChart, dataClusteredLabels, dataClusteredC);
        break;
      case 'D':
        addData(myDataClusteredChart, dataClusteredLabels, dataClusteredD);
        break;
      case 'F':
        addData(myDataClusteredChart, dataClusteredLabels, dataClusteredF);
        break;
    }
  })

  // $('#data-changer').click( function() {
  //   addData(myDataClusteredChart, dataClusteredLabels, dataClusteredAB);
  // });

  function addData(chart, label, data) {
    // chart.data.labels.push(label);
    chart.data.datasets.forEach((dataset, key) => {
        dataset.data = data[key];
    });
    chart.update();
  }


</script>
@endsection
