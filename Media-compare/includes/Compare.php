<?php
/*
*	code to compare the media and collect the ratings from the user
*	
*	
*/



function iom_pk_show_singleslider()
{
	global $wpdb;
	$tablename = $wpdb-> prefix . "iod_pk_media_questions";
	$query = "SELECT question_id,question_name, left_label, right_label, center_label
				FROM `$tablename`";
	$ques_res = $wpdb->get_results($query);
	$count = 1;
	foreach( $ques_res as $ques)
	{
?>
		<input type='hidden' name="<?php echo "ques[$count]"; ?>" id="<?php echo "ques[$count]"; ?>" value='<?php echo $ques->question_id;?>'/>
		<label for="amount"><b><?php echo $ques->question_name; ?></b><br></label>
		<input type="text" name="<?php echo "amount".$count; ?>" id="<?php echo "amount".$count; ?>" style="border: 0; color: #f6931f; font-weight: bold;" />
		<br/>
		<div style="float:left;margin-right:10px;"><?php echo $ques->left_label; ?></div>
		<div id="<?php echo "slider-range-min".$count; ?>" style =" width: 50%; float:left; margin-right:10px;"></div>
		<div style="float:left"><?php echo $ques->right_label; ?></div>
		<br/>
		<div style="width: 50%; text-align: center;"><?php echo $ques->center_label; ?></div>
		<br/>
<?php
		$count=$count+1;
	}
?>
	<input type='hidden' name="count" id="count" value='<?php echo $count;?>'/>
<?php
}

function iom_pk_show_doubleslider()
{
	global $wpdb;
	$tablename = $wpdb-> prefix . "iod_pk_media_questions";
	$query = "SELECT question_id,question_name, left_label, right_label, center_label
				FROM `$tablename`";
	$ques_res = $wpdb->get_results($query);
	$count = 11;
	foreach( $ques_res as $ques)
	{
	
?>
		<input type='hidden' name="<?php echo "ques[$count]"; ?>" id="<?php echo "ques[$count]"; ?>" value='<?php echo $ques->question_id;?>'/>
		<label for="amount"><b><?php echo $ques->question_name; ?></b><br></label>
		<input type="text" name="<?php echo "amount".$count; ?>" id="<?php echo "amount".$count; ?>" style="border: 0; color: #f6931f; font-weight: bold;" />		
		<br/>
		<div style="float:left;margin-right:10px;"><?php echo $ques->left_label; ?></div>
		<div id="<?php echo "slider-range".$count; ?>" style ="width: 50%; float:left; margin-right:10px;"></div>
		<div style="float:left"><?php echo $ques->right_label; ?></div>
		<br/>
		<div style="width: 50%; text-align: center;"><?php echo $ques->center_label; ?></div>
		<br/>
<?php
		$count=$count+1;

	}
?>
	<input type='hidden' name="count" id="count" value='<?php echo $count;?>'/>
<?php

}

function iom_pk_Rank_Image_admin_page()
{
	include_once("script.js");
	include_once("script1.js");
	//include_once("script2.js");
		
		$isSuccess = 0;
		global $wpdb;
		$tablename = $wpdb-> prefix . "iod_pk_media_stored";
		$rsObj = $wpdb->get_row( "
		SELECT d1.content as content1,
		d2.content as content2 ,
		d1.image_id as image1,
		d2.image_id as image2 
		FROM `$tablename` d1, `$tablename` d2
		where d1.image_id<>d2.image_id order by rand()  
		LIMIT 1");

		?>

		<form enctype="multipart/form-data" action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
		<div id=content style="width:820px; display:inline-block;">
		<img src="<?php echo $rsObj->content1;?>" style="width:300px; height:300px; border:40px solid white; float:left;" />
		<img src="<?php echo $rsObj->content2;?>" style="width:300px; height:300px; border:40px solid white;"/>
		</div>
		<input type='hidden' name='image_id1' id='image_id1' value='<?php echo $rsObj->image1;?>'/>
		<input type='hidden' name='image_id2' id='image_id2' value='<?php echo $rsObj->image2;?>'/>
		
		<?php
			
			$tablename = $wpdb-> prefix . "iod_pk_media_settings";
			//echo $tablename;
			$query = "SELECT slider_val,no_of_sliders from `$tablename`";
			$slideObj = $wpdb->get_row($query);
			// $slideObj = (int)$slideObj;
			//$type =gettype ( $slideObj );
			//echo $type;
			//echo "<pre>";
			// print_r( $slideObj);
			// echo "</pre>";
			//echo $slideObj->slider_val;
			if($slideObj->slider_val == 2)
			{
				iom_pk_show_doubleslider();
				//iom_pk_show_doubleslider($slideObj->label_rate,$slideObj->label_left,$slideObj->label_right);
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
		<br/>
		<br/>
		<p align="left">
		<input type="submit" value="Funny" style="float:left;"> 
		</p>
		<?php
	}
	
	if (isset($_POST['image_id1']))
	{
		//echo "<pre>";
		//print_r($_POST);
		//echo"</pre>";
		$isSuccess = iom_pk_compare_submit(); 
		return;
	}
	
	
	function iom_pk_compare_submit()
	{
		global $wpdb;
		
		if(!empty($_POST) && $_POST["image_id1"] != "")			
			$id1 = $_POST["image_id1"];
		if(!empty($_POST) && $_POST["image_id2"] != "")			
			$id2 = $_POST["image_id2"];
		if(!empty($_POST) && $_POST["select_slider"] != "")
			$slider=$_POST["select_slider"];
		if(!empty($_POST) && $_POST["count"] != "")
			$count=$_POST["count"];
		
		$ques=$_POST["ques"];
		//echo "<pre>";
		//print_r($ques);
		//echo"</pre>";
		
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
		//echo "<pre>";
		//print_r($min);
		//echo"</pre>";
		
		//echo "<pre>";
		//print_r($max);
		//echo"</pre>";

		include_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		
		$table = $wpdb-> prefix . "iod_pk_media_rank";
		
		if(strcasecmp($slider,first)==0)
		{
			for ($i = 1; $i < $count; $i++) {
				$max = floatval($amt[$i]);
				$query = "INSERT INTO `$table`(image_id1,image_id2,question_id,min_value,max_value) VALUES ('".$id1."','".$id2."',$ques[$i],NULL,$max)";
				dbDelta($query);
			}
			return 1;
		}
		else
		{
		//Writes the information to the database 
			for ($i = 11; $i < $count; $i++) {
				$query = "INSERT INTO `$table`(image_id1,image_id2,question_id,min_value,max_value) VALUES ('".$id1."','".$id2."',$ques[$i],$min[$i],$max[$i])";
				//echo $query;
				dbDelta($query);
			}
			return 1;
		}
		return 0;
	}