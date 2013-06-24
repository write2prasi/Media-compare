<?php
/*
*	Settings page to modify the settings 
*	
*	
*/

define('IOM_PK_SLUG', 'Media-compare');
define('IOM_PK_DIR', WP_PLUGIN_URL.'/'.IOM_PK_SLUG.'/');	

	function iom_pk_set_admin_page()
	{
		//echo IOM_PK_DIR;
		wp_enqueue_style( 'nycsv', IOM_PK_DIR . 'ny-csv.css', '', '1.0.6', 'screen' );
		global $wpdb;
		$table = $wpdb-> prefix . "iod_pk_media_settings";
		$query = "SELECT 
				image_val, slider_val, no_of_sliders 
				FROM `$table`";
		$setObj = $wpdb->get_row($query);
		?>
		<h2><b> Settings </b></h2>
		<div id="wrapper">
		<div id="page">
		<div id="nycsvColumns">
				<div id="nycsvColumn1">
				<?php if(!isset($_GET["noofquestions"]) && !isset($_GET["enty"]))
				{ ?>
					<form id="form1" name="form1" enctype="multipart/form-data" action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
					<table style ="float:left; " cellspacing="0"  border="0" class="wp-list-table widefat">
						<tr> 
							<td>
								Rate number of images
							</td>
							<td>
							<table style ="float:right; " cellspacing="0"  border="0" class="wp-list-table widefat">
								<tbody>
									<tr>
										<td>
											<input type="radio" name="rate" value="Single" <?php if($setObj->image_val == 1) echo "checked";?> <?php if($setObj->image_val == 1) echo "disabled";?> >
										</td>
										<td>Single Image</td>
									</tr>
									<tr>
										<td>
											<input type="radio" name="rate" value="Double" <?php if($setObj->image_val == 2) echo "checked";?> <?php if($setObj->image_val == 2) echo "disabled";?>>
										</td>
										<td>
											Two Images
										</td>
									</tr>
								</tbody>	
							</table>
							</td>
						</tr>
						<tr>
							<td>
								Point rating vs Range rating
							</td>
							<td>							
								<table cellspacing="0"  border="0" class="wp-list-table widefat">
								<tbody>
									<tr>
										<td>
											<input type="radio" name="slider" value="Singleslider" <?php if($setObj->slider_val == 1) echo "checked";?> <?php if($setObj->slider_val == 1) echo "disabled";?>>
										</td>
										<td>Point </td>
									</tr>
									<tr>
										<td>
											<input type="radio" name="slider" value="Doubleslider" <?php if($setObj->slider_val == 2) echo "checked";?> <?php if($setObj->slider_val == 2) echo "disabled";?>>
										</td>
										<td>
											Range 
										</td>
									</tr>
								</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								Number of Questions
							</td>
							<td>
								<input type="text" name="no_of_ques" value = "<?php if($setObj->no_of_sliders != "") echo $setObj->no_of_sliders;?>" <?php if($setObj->no_of_sliders != "") echo "readonly=\"true\"";?>>
							</td>
						</tr>
					</table>
				</div>
					<br/>
					<br/>
					<p class="submit">
								<input type="hidden" name='save-set' value='add'/>
								<input type="submit" class="button-primary" value="Next"> 
					</p>
					</form>
					<?php 
					} 
					else
					{ 
						if(!isset($_GET["entry"]))
						{
							//echo "true";
							iom_pk_show_questions($_GET["noofquestions"],0); 
						}
						else
						{
							//echo "false";
							iom_pk_show_questions( $setObj->no_of_sliders,1); 
						}
					} 
		?>
				
		</div>
		</div>
		</div>
	<?php
	}
	
	if (isset($_POST['slider']) && isset($_POST['rate'])&& !(empty($_POST['no_of_ques'])))
	{
		//echo "hello";
		$no_of_ques= $_POST['no_of_ques'];
		iom_pk_save_settings(); 
		$lasturl = $_SERVER["HTTP_REFERER"]."&noofquestions=$no_of_ques";
		header("location: $lasturl");
		iom_pk_show_questions($_POST['no_of_ques'],0);
	}
	else if(isset($_POST['save-set']))
	{
		global $wpdb;
		$table = $wpdb-> prefix . "iod_pk_media_settings";
		$query = "SELECT 
				image_val, slider_val, no_of_sliders 
				FROM `$table`";
		$setObj = $wpdb->get_row($query);
		//echo $setObj->slider_val;
		$lasturl = $_SERVER["HTTP_REFERER"]."&noofquestions=$setObj->slider_val&entry=1";
		header("location: $lasturl");
		iom_pk_show_questions($setObj->slider_val,1);
	
	}
	
	function iom_pk_save_settings()
	{
		global $wpdb;
		$image = $_POST["rate"];
		$slider = $_POST["slider"];
		$no_of_ques=$_POST['no_of_ques'];
		
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
		
		$tablename = $wpdb-> prefix . "iod_pk_media_settings";
		
		
		//$slide_val=int($slide_val);
		//$image_val=int($image_val);
		$query = "INSERT INTO `$tablename`(image_val,slider_val,no_of_sliders)VALUES($image_val,$slide_val,$no_of_ques)";
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
		//echo "<pre>"; print_r($_SERVER); echo "</pre>";
		//add_query_arg( 'noofquestions', '$no_of_ques' );
		
		
	}
	
	
	
	function iom_pk_show_questions($count,$flag)
	{
	//echo $count;
	//echo $_SERVER["HTTP_REFERER"];
	echo "<div id=\"quest\">";
	if($flag ==0)
	{
	?>
	<form enctype='multipart/form-data' name='form2' name='form2' id='form2' action='<?php echo $_SERVER['PHP_SELF'] ?>' method='POST' >
	
	<?php
	for ($i=0; $i<$count; $i++)
	{
		echo "<table cellspacing=\"0\"  border=\"0\" class=\"wp-list-table widefat\" style=\"width:500px;\">";
		echo "<tr><td> The question for rating :</td><td>";
		echo "<input type=\"text\"  name=\"textfield[$i]\" style=\"width:300px;\">";
		echo "</td></tr><tr><td> Left label :</td><td>";
		echo "<input type=\"text\" name=\"leftfield[$i]\" style=\"width:300px;\">";
		echo "</td></tr><tr><td> Label at centre :</td><td>";
		echo "<input type=\"text\" name=\"centrefield[$i]\"style=\"width:300px;\">";
		echo "</td></tr><tr><td> Right Label: </td><td>";
		echo "<input type=\"text\" name=\"rightfield[$i]\"style=\"width:300px;\">";
		echo"</td></tr><tr><td>&nbsp</tr></td>";
	}
	echo "</table></div>";
	?>
	<br/>
	<br/>
		<input type="hidden" name='count' value='<?php echo $count ?>'/>
		<input type="submit" name='save-ques' class="button-primary" value="Add Questions"> 
		</form>
		
	<?php
	}
	else
	{
		global $wpdb;
		$table = $wpdb-> prefix . "iod_pk_media_questions";
		$query = "SELECT 
				question_name, left_label, right_label, center_label
				FROM `$table`";
		$ques_res = $wpdb->get_results($query);
		
		//print_r($ques_res );
	?>
	<form enctype='multipart/form-data' name='form2' name='form2' id='form2' action='<?php echo $_SERVER['PHP_SELF'] ?>' method='POST' >
	<?php
		foreach( $ques_res as $ques)
		{
	?>
		<table cellspacing="0"  border="0" class="wp-list-table widefat" style="width:500px;">
		<tr><td> The question for rating :</td><td>
		<input type="text"  name="textfield[$i]" style="width:300px;" value = "<?php echo $ques->question_name;?>" readonly="true">
		</td></tr><tr><td> Left label :</td><td>
		<input type="text" name="leftfield[$i]" style="width:300px;" value = "<?php echo $ques->left_label;?>" readonly="true">
		</td></tr><tr><td> Label at centre :</td><td>
		<input type="text" name="centrefield[$i]"style="width:300px;" value = "<?php echo $ques->center_label;?>" readonly="true">
		</td></tr><tr><td> Right Label: </td><td>
		<input type="text" name="rightfield[$i]"style="width:300px;" value = "<?php echo $ques->right_label;?>" readonly="true">
		</td></tr><tr><td>&nbsp</tr></td>
	<?php
	}
	echo "</table></div>";
	?>
	<br/>
	<br/>
		<input type="hidden" name='count' value='<?php echo $count ?>'/>
		<input type="submit" name='next-ques' class="button-primary" value="Go back"> 
		</form>
		
	<?php
	}
	}
	
	
	if (isset($_POST['next-ques']))
	{
		//$noofquestions = $_GET["noofquestions"];
		$pos = strrpos($_SERVER["HTTP_REFERER"], "&");
		$loc =  substr($_SERVER["HTTP_REFERER"], 0, $pos);
		$pos1 = strrpos($loc, "&");
		$loc1= substr($loc,0, $pos1);
		//echo $loc1;
		//iom_pk_save_questions();
		header("location: $loc1");
	}
	
	if (isset($_POST['save-ques']))
	{
		//$noofquestions = $_GET["noofquestions"];
		$pos = strrpos($_SERVER["HTTP_REFERER"], "&");
		$loc =  substr($_SERVER["HTTP_REFERER"], 0, $pos);
		iom_pk_save_questions();
		header("location: $loc");
	}
	
	function iom_pk_save_questions()
	{
		// "<pre>";
		//print_r($_POST);
		//print_r($_SERVER);
		//die();
		global $wpdb;
		//echo "</pre>";
		$tablename_ques = $wpdb-> prefix . "iod_pk_media_questions";
		//echo $tablename_ques;
		global $wpdb;
		$count = $_POST["count"];
		//echo $count;
		$ques=$_POST["textfield"];
			//echo $ques[$i];
		$left=$_POST["leftfield"];
		$right=$_POST["rightfield"];
		$centre=$_POST["centrefield"];
		for ($i=0; $i<$count; $i++)
		{
			$query = "INSERT INTO `$tablename_ques`(question_name,left_label,right_label,center_label)VALUES('$ques[$i]','$left[$i]','$right[$i]','$centre[$i]');";
			echo $query;
			$wpdb->query($query);
		}
	}

	/* EOF*/
	?>