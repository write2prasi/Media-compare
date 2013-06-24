		<link rel = "stylesheet" href = "<?php echo plugins_url('/Media-compare/css/jquery-ui.css'); ?>" />
		<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
		<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
		<link rel="stylesheet" href="/resources/demos/style.css" />
		<script>
		$(function() {
					$( "#slider-range-short" ).slider({
		range: true,
		min: 0,
		max: 1,
		step:0.01,
		values: [ 0, 0.5 ],
		slide: function( event, ui ) {
			$( "#amount" ).val(  ui.values[ 0 ] + " - " + ui.values[ 1 ] );
		}
		});
		$( "#amount2" ).val(  $( "#slider-range" ).slider( "values", 0 ) +
		" - " + $( "#slider-range" ).slider( "values", 1 ) );
		});
			 
		</script>