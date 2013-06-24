<?php
/*
*	code to rate the media and collect the ratings from the user
*	
*	
*/
	function iom_pk_Rate_Image_admin_page()
	{
		include_once("script.js");
		include_once("script1.js");
		global $wpdb;
		$tablename = $wpdb-> prefix . "iod_pk_media_stored";
		$rsObj = $wpdb->get_row( "
		SELECT content ,image_id 
		FROM `$tablename` 
		ORDER BY rand()  
		LIMIT 1");
		?>

		<form enctype="multipart/form-data" action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
		<div id=content style = "display: inline-block;">
		<img src="<?php echo $rsObj->content;?>" style="width:300px; height:300px; border:40px solid white; float:center;" />
		</div>
		<input type='hidden' name='image_id' id='image_id' value='<?php echo $rsObj->image_id;?>'/>
		<div>
	<?php
		$tablename = $wpdb-> prefix . "iod_pk_media_settings";
		
		$query = "SELECT slider_val,no_of_sliders from `$tablename`";
		$slideObj = $wpdb->get_row($query);
		if($slideObj->slider_val == 2)
		{
			iom_pk_show_doubleslider();			
	?>
			<input type='hidden' name="select_slider" value="second"/>
	<?php
		}
		else
			{
				iom_pk_show_singleslider();
				?>
				<input type='hidden' name="select_slider" value="first"/>
				<?php
			}
		
		?>
		</div>
		<br/>
		<br/>
		<p align="left">
		<input type="submit" value="Save" style="float:left;"> 
		</p>
		<?php
	}	
	
	
	if (isset($_POST['image_id']))
	{
		iom_pk_rate_submit(); 
		return;
	}
	
	function iom_pk_rate_submit()
	{
		if(!empty($_POST) && $_POST["image_id"] != "")			
			$id1 = $_POST["image_id"];
		if(!empty($_POST) && $_POST["select_slider"] != "")
			$slider=$_POST["select_slider"];
		if(!empty($_POST) && $_POST["count"] != "")
			$count=$_POST["count"];

		include_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		
		$ques=$_POST["ques"];
		$str="amount";
		
		if(strcasecmp($slider,first)==0)
		{
			for ($i = 1; $i < $count; $i++) {
			
				$amt[$i]=$_POST[$str.$i];
			}
		}
		else
		{
			for ($i = 11; $i < $count; $i++) {
				$result_arr = explode("-",$_POST[$str.$i]);
				$min[$i]=floatval($result_arr[0]);
				$max[$i]=floatval($result_arr[1]);
			}
		}
		
		$table = $wpdb-> prefix . "iod_pk_media_rank";
		
		if(strcasecmp($slider,first)==0)
		{
			for ($i = 1; $i < $count; $i++) {
				$max = floatval($amt[$i]);
				$query = "INSERT INTO `wp_iod_pk_media_rank`(image_id1,image_id2,question_id,min_value,max_value) VALUES ('".$id1."','".$id2."',$ques[$i],NULL,$max)";
				dbDelta($query);
			}
			return 1;
			$query = "INSERT INTO `wp_iod_pk_media_rate`(image_id,min_value,max_value) VALUES ('".$id1."',NULL,$max)";
			dbDelta($query);
		}
		else
		{
			$result_arr = explode("-",$amt);
			$min=floatval($result_arr[0]);
			$max=floatval($result_arr[1]);
		//Writes the information to the database
			$query = "INSERT INTO `wp_iod_pk_media_rate`(image_id,min_value,max_value) VALUES ('".$id1."',$min,$max)"; 
			dbDelta($query);
		}
	}