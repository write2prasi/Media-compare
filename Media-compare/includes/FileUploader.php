<?php
/*
*	Creates a folder called iod_pk_images in the wp-content area to store all the images
*	Provides a way to uplaod images into this location
*	Copies the images to this location

	
*/	
//add_action('wp_enqueue_scripts', 'pk_load_fileuploader_script');


//include_once("list.css");


	
	function iom_pk_createfolder()
	{
		//pk_load_fileuploader_script();
		$upload_dir = wp_upload_dir();
		//echo $upload_dir['path'];
		//print_r($upload_dir);
		$pathUploads = $upload_dir['basedir'].'/media-uploads/';

		if(!is_dir($pathUploads))
		{
			if(mkdir($pathUploads, 0777, true))
				return true;
				//echo "Done";
			else
				return false;
				//echo "Not done";
					}
		else
		{
			return true;
			//echo "Done ";
		}
	}
	/**
	 * Displays a page for the author to upload images.
	 * This can upload x number of images
	 * It creates a folder in the upload directory and uploads images to that location
	 */
	function iom_pk_upload_admin_page(){
		?>
		<div class="wrap">
			<?php					
				iom_pk_createfolder();
				iom_pk_showDialog();
			?>
		</div>
		<?php
	}	
	
	function iom_pk_showDialog()
	{
		?>
		<h2><b> Upload an Image </b></h2>
		<br/>
		<br/>
		<div id="nm-upload-container">
		<div id="error"></div>
		<body lang="en">
		
		<form enctype="multipart/form-data" action="<?php $_SERVER["PHP_SELF"] ?>" method="POST"> 
		
		<p class="nm-uploader-area">
			<span><?php _e('Select file(s) to upload, once files uploaded click on Add Image button below', 'nm_file_uploader_pro')?></span>
			<br/><br/>
			<input id="file_upload" type="file" name="photo[]" multiple><br> 
			<span id="upload-response"></span>
		</p>
			
		
		<br/>
		<input type="submit" class="button-primary" value="Add Image"> 

		<input type="hidden" name="file-name" id="file-name">
 
		<ul class="nm-file-meta">
		<li class="caption">&nbsp;</li>
		<li class="inputs">
		<div id="working-area" style="display:none">
			<?php
				//echo "<img src=".plugins_url( 'images/loading.gif' , __FILE__)." />";
			?>
		</div>	
		</li>
		</ul>
		</form>
		</div>
		<?php
		$upload_dir = wp_upload_dir();
		$target = $upload_dir['basedir'].'/media-uploads/';
		$dir = new DirectoryIterator($target);
		foreach($dir as $file){
			$x +=1;
		}
		
		$x = $x-2;
		//echo $x;
		$count = 0;
		if ($handle = opendir($target))
		{
			echo "<b>Uploaded File list</b></br>";
			
			/* This is the correct way to loop over the directory. */
			while (false !== ($entry = readdir($handle))) 
			{
				$count +=1;
				if($entry != ".." && $entry !=".")
				{
					if(count<$x/2)
					{
						echo "<div style =\"float:left; width: 50%;\"> <ul>";
						echo "<li>$entry</li></ul></div>";
					}
					else
					{
						echo "<div style =\"float:right; width: 50%;\"> <ul>";
						echo "<li>$entry</li>";
						echo "</ul></div>";
					}
				}
			}
			die();
		}
		?>
		<?php	
	}
	function reArrayFiles(&$file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

		return $file_ary;
	}

	if (isset($_FILES['photo']))
	{
		$fileall = reArrayFiles($_FILES['photo']);
		foreach($fileall as $file){
			$mime = array('image/gif' => 'image/gif',
							'image/jpeg' => 'image/jpeg',
							'image/png' => 'image/png',
							'application/x-shockwave-flash' => 'application/x-shockwave-flash',
							'image/psd' => 'image/psd',
							'image/bmp' => 'image/bmp',
							'image/tiff' => 'image/tiff',
							'image/tiff' => 'image/tiff',
							'image/jp2' => 'image/jp2',
							'image/iff' => 'image/iff',
							'image/vnd.wap.wbmp' => 'image/vnd.wap.wbmp',
							'image/xbm' => 'image/xbm',
							'image/vnd.microsoft.icon' => 'image/vnd.microsoft.icon');
			if(!array_search(strtolower($file["type"]), $mime))
			{
				print_r("Not an image format");
			}
		}
		
		pk_submit($fileall);
		return;
	}
	
	function pk_submit($fileall)
	{
			global $wpdb;
			//echo "<pre>"; print_r($fileall); echo "<pre>";
			$tablename = $wpdb-> prefix . "iod_pk_media_stored";
			$upload_dir = wp_upload_dir();
			$target = $upload_dir['basedir'].'/media-uploads/';
			//$target = $upload_dir['basedir'].'/user_uploads/'.$current_user -> user_nicename.'/';
			//echo "Folder is ".$target;
			$store_target=$upload_dir['baseurl'].'/media-uploads/';
			
 			//echo "Dir name = ".dirname(__FILE__) ." is <br>";
 			//$target = $target. basename($_FILES['photo']['name']); 
			//$store_target = $target;
			//$store_target = $store_target. basename($_FILES['photo']['name']); 
			//Writes the information to the database 
			if(!empty($fileall) && is_array($fileall))
			{
				$sql = "INSERT INTO `$tablename`(content,image_name) VALUES ";
				foreach($fileall as $imageFiles)
				{
					$sql .= "('".$store_target.$imageFiles["name"]."','".$imageFiles["name"]."'),";
				}
				$sql = substr_replace($sql, "", -1);
				include_once(ABSPATH . 'wp-admin/includes/upgrade.php');
				dbDelta($sql);
			}
			
			//echo "Folder is ".$target;

			//Writes the photo to the server 
			$temp_target=$target;
			//echo "<pre>";
			//print_r($fileall);
			//echo "</pre>";
			//echo $target;
			foreach($fileall as $imageFiles)
			{
				$target=$temp_target;
				$target=$target. basename($imageFiles['name']);
				//echo $target;
				if(move_uploaded_file($imageFiles['tmp_name'], $target)) 
				{
					//return false;
					//Tells you if its all ok 
					echo" ";
					//echo "The file ". basename("<br>". $_FILES['photo']['name']). " has been uploaded, and your information has been added to the directory"; 
				} 
				else 
				{ 
					//return false;
					// Gives and error if its not 
					echo "Upload failed";
					//echo "<br> Sorry, there was a problem uploading your file."; 
				}
			}
	}