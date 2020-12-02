<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Business Intelligence - University</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ asset('/img/icon.ico') }}" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="{{ asset('/js/plugin/webfont/webfont.min.js') }}"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{ asset('/css/fonts.min.css') }}']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/atlantis.min.css') }}">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{ asset('/css/demo.css') }}">

	<style>
	.form-control {
		height: calc(2.25rem + 2px) !important;
	}
	.table td, .table th {
		padding: 0 !important;
		height: 40px;
	}
	</style>
	@yield('style')
</head>
<body>
	<div class="wrapper">
		@include ('layouts.master_navbar')

		<div class="main-panel">
			<div class="content">
				@yield ('content')
			</div>
			@include ('layouts.master_footer')
		</div>
		
	</div>
	<!--   Core JS Files   -->
	<script src="{{ asset('/js/core/jquery.3.2.1.min.js') }}"></script>
	<script src="{{ asset('/js/core/popper.min.js') }}"></script>
	<script src="{{ asset('/js/core/bootstrap.min.js') }}"></script>

	<!-- jQuery UI -->
	<script src="{{ asset('/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

	<!-- jQuery Scrollbar -->
	<script src="{{ asset('/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>


	<!-- Chart JS -->
	<script src="{{ asset('/js/plugin/chart.js/chart.min.js') }}"></script>

	<!-- jQuery Sparkline -->
	<script src="{{ asset('/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

	<!-- Chart Circle -->
	<script src="{{ asset('/js/plugin/chart-circle/circles.min.js') }}"></script>

	<!-- Datatables -->
	<script src="{{ asset('/js/plugin/datatables/datatables.min.js') }}"></script>

	<!-- Bootstrap Notify -->
	<script src="{{ asset('/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

	<!-- jQuery Vector Maps -->
	<script src="{{ asset('/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
	<script src="{{ asset('/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>

	<!-- Sweet Alert -->
	<script src="{{ asset('/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

	<script src="{{ asset('js/canvasjs.min.js') }}"></script>

	<!-- Atlantis JS -->
	<script src="{{ asset('/js/atlantis.min.js') }}"></script>
	

	<script>
	/* Chart settings */
	var clusteringOptions = {
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
	
	var datatablesOptions = {
				"pageLength": 10,
				initComplete: function () {
					this.api().columns().every( function () {
            var column = this;
            
            if ($(column.footer()).data('skip') != true) {
						var select = $('<select class="form-control"><option value=""></option></select>')
						.appendTo( $(column.footer()).empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
								);

							column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
						} );

						column.data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
            } );
          }
					} );
				}
			}
	</script>

	@yield ('script')
</body>
</html>