@extends('layouts.master')

@section('content')
<div class="page-inner">
  <h4 class="page-title">Room Summary</h4>
  <div class="page-category">
    <ul>
      <li>Average number of room used duration is <b>{{ $avgDuration }}</b> hour(s) per week .</li>
      <li>Information benefits: <br>
          - Optimizing time of rooms usage
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">GPA v Class</div>
        </div>
        <div class="card-body">
            <div id="roomChart" style="height: 400px; width: 100%;">
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

  var roomsDataset = {!! $roomsDataset !!}

  // Casting the y
  Object.keys(roomsDataset).forEach(k => {
    roomsDataset[k].y = parseFloat(roomsDataset[k].y);
  })

  var chart = new CanvasJS.Chart("roomChart",
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
      data: [ 
      {
        type: "stackedColumn",
        name: 'Duration (hours in week)',
      showInLegend: true,
        dataPoints: roomsDataset
      }
      ]
    });

    chart.render();
    
  }

  </script>
  <script src="{{ asset('js/canvasjs.min.js') }}"></script>
@endsection
