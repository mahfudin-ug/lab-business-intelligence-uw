<!DOCTYPE HTML>
<html>
<head>
  <script type="text/javascript">
  window.onload = function() {
  function generateData(max) {
      var chartData = [];
      for (x = 0; x < 130000; x++) {
          chartData.push({
            "label" : "Label" + x,
            // "y" : Math.floor((Math.random() * 100) + 1)
            "y" : (Math.random() * max)
          });
      }
      return chartData;
  }
  var chart = new CanvasJS.Chart("chartContainer",
    {
      zoomEnabled: true,
      title:{
      text: "Coal Reserves of Countries"
      },
      toolTip:{   
        shared: true
      },
      axisY:{
         minimum: 0
     },
      data: [
      {
        type: "stackedColumn",
        name: 'GPA',
        dataPoints: generateData(4)
        // dataPoints: [
        //   {  y: 111338 , label: "USA"},
        //   {  y: 49088, label: "Russia" },
        //   {  y: 62200, label: "China" },
        //   {  y: 90085, label: "India" },
        //   {  y: 38600, label: "Australia"},
        //   {  y: 48750, label: "SA"}
        // ]
      },  
      {
        type: "stackedColumn",
        name: 'Students per class',
        dataPoints: generateData(100)
        //  dataPoints: [
        //   {  y: 135305 , label: "USA"},
        //   {  y: 107922, label: "Russia" },
        //   {  y: 52300, label: "China" },
        //   {  y: 3360, label: "India" },
        //   {  y: 39900, label: "Australia"},
        //   {  y: 0, label: "SA"}

        // ]
      }
      ]
    });

    chart.render();
}

  </script>
  <script src="{{ asset('js/canvasjs.min.js') }}"></script>
 </head>
<body>
  <div id="chartContainer" style="height: 300px; width: 100%;">
  </div>
</body>
</html>