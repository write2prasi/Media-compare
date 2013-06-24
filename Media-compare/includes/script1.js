		<link rel = "stylesheet" href = "<?php echo plugins_url('/Media-compare/css/jquery-ui.css'); ?>" />
		<link rel = "stylesheet" href = "<?php echo plugins_url('/Media-compare/css/jquery-ui-1.8.2.custom.css'); ?>" />
		<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
		<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
		<link rel="stylesheet" href="/resources/demos/style.css" />
		<script>
			
		$(function() {
		
			$( "#slider-range11" ).slider({
		range: true,
		min: 0,
		max: 1,
		step:0.01,
		values: [ 0, 0.5 ],
		slide: function( event, ui ) {
			$( "#amount11" ).val(  ui.values[ 0 ] + " - " + ui.values[ 1 ] );
		}
		});
		$( "#amount11" ).val(  $( "#slider-range11" ).slider( "values", 0 ) +
		" - " + $( "#slider-range11" ).slider( "values", 1 ) );
		
		
		$( "#slider-range12" ).slider({
		range: true,
		min: 0,
		max: 1,
		step:0.01,
		values: [ 0, 0.5 ],
		slide: function( event, ui ) {
			$( "#amount12" ).val(  ui.values[ 0 ] + " - " + ui.values[ 1 ] );
		}
		});
		$( "#amount12" ).val(  $( "#slider-range12" ).slider( "values", 0 ) +
		" - " + $( "#slider-range12" ).slider( "values", 1 ) );
		
		$( "#slider-range13" ).slider({
		range: true,
		min: 0,
		max: 1,
		step:0.01,
		values: [ 0, 0.5 ],
		slide: function( event, ui ) {
			$( "#amount13" ).val(  ui.values[ 0 ] + " - " + ui.values[ 1 ] );
		}
		});
		$( "#amount13" ).val(  $( "#slider-range13" ).slider( "values", 0 ) +
		" - " + $( "#slider-range13" ).slider( "values", 1 ) );
		
			$( "#slider-range14" ).slider({
		range: true,
		min: 0,
		max: 1,
		step:0.01,
		values: [ 0, 0.5 ],
		slide: function( event, ui ) {
			$( "#amount14" ).val(  ui.values[ 0 ] + " - " + ui.values[ 1 ] );
		}
		});
		$( "#amount14" ).val(  $( "#slider-range14" ).slider( "values", 0 ) +
		" - " + $( "#slider-range14" ).slider( "values", 1 ) );
		
		$( "#slider-range15" ).slider({
		range: true,
		min: 0,
		max: 1,
		step:0.01,
		values: [ 0, 0.5 ],
		slide: function( event, ui ) {
			$( "#amount15" ).val(  ui.values[ 0 ] + " - " + ui.values[ 1 ] );
		}
		});
		$( "#amount15" ).val(  $( "#slider-range15" ).slider( "values", 0 ) +
		" - " + $( "#slider-range15" ).slider( "values", 1 ) );
		
		
		$( "#slider-range16" ).slider({
		range: true,
		min: 0,
		max: 1,
		step:0.01,
		values: [ 0, 0.5 ],
		slide: function( event, ui ) {
			$( "#amount16" ).val(  ui.values[ 0 ] + " - " + ui.values[ 1 ] );
		}
		});
		$( "#amount16" ).val(  $( "#slider-range16" ).slider( "values", 0 ) +
		" - " + $( "#slider-range16" ).slider( "values", 1 ) );
		
		$( "#slider-range17" ).slider({
		range: true,
		min: 0,
		max: 1,
		step:0.01,
		values: [ 0, 0.5 ],
		slide: function( event, ui ) {
			$( "#amount17" ).val(  ui.values[ 0 ] + " - " + ui.values[ 1 ] );
		}
		});
		$( "#amount17" ).val(  $( "#slider-range17" ).slider( "values", 0 ) +
		" - " + $( "#slider-range17" ).slider( "values", 1 ) );
		
			$( "#slider-range18" ).slider({
		range: true,
		min: 0,
		max: 1,
		step:0.01,
		values: [ 0, 0.5 ],
		slide: function( event, ui ) {
			$( "#amount18" ).val(  ui.values[ 0 ] + " - " + ui.values[ 1 ] );
		}
		});
		$( "#amount18" ).val(  $( "#slider-range18" ).slider( "values", 0 ) +
		" - " + $( "#slider-range18" ).slider( "values", 1 ) );
		
		$( "#slider-range19" ).slider({
		range: true,
		min: 0,
		max: 1,
		step:0.01,
		values: [ 0, 0.5 ],
		slide: function( event, ui ) {
			$( "#amount19" ).val(  ui.values[ 0 ] + " - " + ui.values[ 1 ] );
		}
		});
		$( "#amount19" ).val(  $( "#slider-range19" ).slider( "values", 0 ) +
		" - " + $( "#slider-range19" ).slider( "values", 1 ) );
		
			$( "#slider-range20" ).slider({
		range: true,
		min: 0,
		max: 1,
		step:0.01,
		values: [ 0, 0.5 ],
		slide: function( event, ui ) {
			$( "#amount20" ).val(  ui.values[ 0 ] + " - " + ui.values[ 1 ] );
		}
		});
		$( "#amount20" ).val(  $( "#slider-range20" ).slider( "values", 0 ) +
		" - " + $( "#slider-range20" ).slider( "values", 1 ) );
		
		});
		
			 
		</script>