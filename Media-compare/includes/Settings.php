<?php
/*
*	Download CSV file
*	
*	

	
*/

define('IOM_PK_SLUG', 'Media-compare');
define('IOM_PK_DIR', WP_PLUGIN_URL.'/'.IOM_PK_SLUG.'/');	

	function iom_pk_settings_admin_page()
	{
		wp_enqueue_style( 'nycsv', IOM_PK_DIR . 'ny-csv.css', '', '1.0.6', 'screen' );
		$srcurl = 'export-data-to-csv-format/';
		?>
		<div id="wrapper">
			<div class="titlebg" id="plugin_title">
				<span class="head i_mange_coupon"><h2><?php echo "Download data as CSV format";?></h2></span>
			</div>
		<div id="page">
			<div id="nycsvColumns">
				<div id="nycsvColumn1">
					<form enctype="multipart/form-data" action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
						<p class="submit">
							<input type="hidden" name='command' value='add'/>
							<input type="submit" class="button-primary" value="Download CSV"> 
						</p>
					</form>
				</div>
			</div>
		</div>
		</div>
	<?php
	}
	
	if (isset($_POST['command']))
	{
		global $wpdb;
		$tablename = $wpdb-> prefix . "iod_pk_media_settings";
		//echo $tablename;
		$query = "SELECT image_val,slider_val from `$tablename`";
		$slideObj = $wpdb->get_row($query);
		$image_val=$slideObj->image_val;
		//$slider_val=$slideObj->image_val;
		if($image_val==1)
		{
			$table_disp=$wpdb-> prefix ."iod_pk_media_rate";
			iom_pk_show_csv($table_disp,1,$slideObj->slider_val); 
			echo "hello";
		}
		else
		{
			
			$table_disp=$wpdb-> prefix ."iod_pk_media_rank";
			iom_pk_show_csv($table_disp,0,$slideObj->slider_val); 
		}
		return;
	}
	
	function iom_pk_show_csv($getTable,$flag,$slider)
	{
		global $wpdb;
		$table_save = $wpdb-> prefix ."iod_pk_media_stored";
		$table_ques = $wpdb-> prefix ."iod_pk_media_questions";
		echo $slider;
		if($flag == 0 && $slider == 1)
		{
			//echo "hello";
			$query = "SELECT a.image_name,b.image_name,question_name,max_value as Rating
					FROM $getTable S ,$table_save a,$table_save b,$table_ques Q  
					WHERE S.image_id1=a.image_id and S.image_id2=b.image_id and S.question_id = Q.question_id ";
		}
		else if($flag == 0 && $slider == 2)
		{
			//echo "hello1";
			$query = "SELECT a.image_name,b.image_name,question_name,min_value as Min_Rating,max_value as Max_Rating
					FROM $getTable S ,$table_save a,$table_save b,$table_ques Q  
					WHERE S.image_id1=a.image_id and S.image_id2=b.image_id and S.question_id = Q.question_id ";
		}
		else if($flag == 1 && $slider == 1)
		{
			$query = "SELECT a.image_name,question_name,max_value as Rating
					FROM $getTable S ,$table_save a,$table_ques Q  
					WHERE S.image_id=a.image_id and S.question_id = Q.question_id ";
		}
		else
		{
			$query = "SELECT a.image_name,question_name,min_value as Min_Rating,max_value as Max_Rating
					FROM $getTable S ,$table_save a,$table_ques Q  
					WHERE S.image_id=a.image_id and S.question_id = Q.question_id ";
		}
		//echo $query;
		$export = mysql_query ($query ) or die ( "Sql error : " . mysql_error( ) );
		$fields = mysql_num_fields ( $export );
		for ( $i = 0; $i < $fields; $i++ )
		{
			$header .= mysql_field_name( $export , $i ) . ",";
		}
		while( $row = mysql_fetch_row( $export ) )
		{
			$line = '';
			foreach( $row as $value )
			{                                            
				if ( ( !isset( $value ) ) || ( $value == "" ) )
				{
					$value = "\t";
				}
				else
				{
					$value = str_replace( '"' , '""' , $value );
					$value = '"' . $value . '"' . ",";
				}
				$line .= $value;
			}
			$data .= trim( $line ) . "\n";
		}
		$data = str_replace( "\r" , "" , $data );

		if ( $data == "" )
		{
			$data = "\n(0) Records Found!\n";                        
		}

		header("Content-type: text/csv");
		header("Content-Disposition: attachment; filename=rating_data.csv");
		header("Pragma: no-cache");
		header("Expires: 0");
		print "$header\n$data";
		die();


	
	}

	/* EOF*/