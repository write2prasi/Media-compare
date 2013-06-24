		<link rel = "stylesheet" href = "<?php echo plugins_url('/Media-compare/css/jquery-ui.css'); ?>" />
		<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
		<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
		<link rel="stylesheet" href="/resources/demos/style.css" />
		<script>
		$(function() {
			$( "#slider-range-min1" ).slider({
			range: "min",
			value: 0.5,
			min: 0,
			max: 1,
			step:0.01,
			slide: function( event, ui ) {
			$( "#amount1" ).val(ui.value );
		}
		});
		$( "#amount1" ).val($( "#slider-range-min1" ).slider( "value" ) );
		
			$( "#slider-range-min2" ).slider({
			range: "min",
			value: 0.5,
			min: 0,
			max: 1,
			step:0.01,
			slide: function( event, ui ) {
			$( "#amount2" ).val(ui.value );
		}
		});
		$( "#amount2" ).val($( "#slider-range-min2" ).slider( "value" ) );
		
		$( "#slider-range-min3" ).slider({
			range: "min",
			value: 0.5,
			min: 0,
			max: 1,
			step:0.01,
			slide: function( event, ui ) {
			$( "#amount3" ).val(ui.value );
		}
		});
		$( "#amount3" ).val($( "#slider-range-min3" ).slider( "value" ) );
		
		$( "#slider-range-min4" ).slider({
			range: "min",
			value: 0.5,
			min: 0,
			max: 1,
			step:0.01,
			slide: function( event, ui ) {
			$( "#amount4" ).val(ui.value );
		}
		});
		$( "#amount4" ).val($( "#slider-range-min4" ).slider( "value" ) );
		
			$( "#slider-range-min5" ).slider({
			range: "min",
			value: 0.5,
			min: 0,
			max: 1,
			step:0.01,
			slide: function( event, ui ) {
			$( "#amount5" ).val(ui.value );
		}
		});
		$( "#amount5" ).val($( "#slider-range-min5" ).slider( "value" ) );
		
		$( "#slider-range-min6" ).slider({
			range: "min",
			value: 0.5,
			min: 0,
			max: 1,
			step:0.01,
			slide: function( event, ui ) {
			$( "#amount6" ).val(ui.value );
		}
		});
		$( "#amount6" ).val($( "#slider-range-min6" ).slider( "value" ) );
		
			$( "#slider-range-min7" ).slider({
			range: "min",
			value: 0.5,
			min: 0,
			max: 1,
			step:0.01,
			slide: function( event, ui ) {
			$( "#amount7" ).val(ui.value );
		}
		});
		$( "#amount7" ).val($( "#slider-range-min7" ).slider( "value" ) );
		
		$( "#slider-range-min8" ).slider({
			range: "min",
			value: 0.5,
			min: 0,
			max: 1,
			step:0.01,
			slide: function( event, ui ) {
			$( "#amount8" ).val(ui.value );
		}
		});
		$( "#amount8" ).val($( "#slider-range-min8" ).slider( "value" ) );
		
			$( "#slider-range-min9" ).slider({
			range: "min",
			value: 0.5,
			min: 0,
			max: 1,
			step:0.01,
			slide: function( event, ui ) {
			$( "#amount9" ).val(ui.value );
		}
		});
		$( "#amount9" ).val($( "#slider-range-min9" ).slider( "value" ) );
		
		$( "#slider-range-min10" ).slider({
			range: "min",
			value: 0.5,
			min: 0,
			max: 1,
			step:0.01,
			slide: function( event, ui ) {
			$( "#amount10" ).val(ui.value );
		}
		});
		$( "#amount10" ).val($( "#slider-range-min10" ).slider( "value" ) );
		
		});
		
		
		</script>