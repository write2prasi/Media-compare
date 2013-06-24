<?php

iom_pk_display_questions();

function iom_pk_display_questions()
{
	echo "Hello";
	global $wpdb;
	$tablename = $wpdb-> prefix . "iod_pk_media_settings";
	$query = "SELECT no_of_sliders from `$tablename`";
	$rsObj = $wpdb->get_row($query);
	echo
	die();
}
	function iom_pk_save_settings()
	{
		global $wpdb;
		$image = $_POST["rate"];
		$slider = $_POST["slider"];
		$label_rate=$_POST['label_rate'];
		
		include_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			
		if(strcasecmp($slider,Singleslider)==0)
		{
			$slide_val=1;
		}
		else
		{
			$slide_val=2;
		}
		
		if(strcasecmp($image,Single)==0)
		{
			$image_val=1;
		}
		else
		{
			$image_val=2;
		}
		
		
		
		
		//$slide_val=int($slide_val);
		//$image_val=int($image_val);
		$query = "INSERT INTO `$tablename`(image_val,slider_val,no_of_sliders)VALUES($image_val,$slide_val,$label_rate)";
		$wpdb->query($query);
		
		$tablename = $wpdb-> prefix . "iod_pk_media_settings";
		$query = "SELECT image_val from $tablename`";
		$data_obj = $wpdb->get_row($query);
		if($data_obj->image_val==1)
		{
			Database::iod_pk_media_rate_create_table();
		}
		else
		{
			Database::iod_pk_media_rank_create_table();
		}
		
	}
