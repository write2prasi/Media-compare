<?php
/*
*	Creates an interface for the admin to add images to the server
*	change the settings to decide single or multiple slider
*	decide on where the images would be displayed

	
*/

add_action('admin_menu', 'iom_pk_add_admin_menus');
add_action('user_menu', 'iom_pk_add_admin_menus');
add_action('wp_enqueue_scripts', 'pk_load_fileuploader_script');
add_shortcode( 'hello', array('nmFileUploader', 'renderUserArea'));

include_once('Compare.php');
include_once('Rate.php');
include_once('FileUploader.php');
include_once('Settings.php');
include_once('Set.php');


function iom_pk_add_admin_menus(){
		global $iom_pk_admin_mediacompare;
		$iom_pk_admin_mediacompare = add_menu_page('Media Compare', __('Media Compare',iom_pk_NAME),
				'administrator', __FILE__, 'iom_pk_main_admin_page');
		add_submenu_page(__FILE__, 'Upload Image', __('Upload Image',iom_pk_NAME), 'manage_options',
				__FILE__.'datasources','iom_pk_upload_admin_page');
		add_submenu_page(__FILE__, 'Rank Image', __('Rank Image',iom_pk_NAME), 'manage_options',
				__FILE__.'RankImage','iom_pk_Rank_Image_admin_page');				
		add_submenu_page(__FILE__, 'Rate Image', __('Rate Image',iom_pk_NAME), 'manage_options',
				__FILE__.'RateImage','iom_pk_Rate_Image_admin_page');
		add_submenu_page(__FILE__, 'Download Results', __('Download Results',iom_pk_NAME), 'manage_options',
				__FILE__.'apikeys','iom_pk_settings_admin_page');
		add_submenu_page(__FILE__, 'Settings', __('Settings',iom_pk_NAME), 'manage_options',
				__FILE__.'set','iom_pk_set_admin_page');
	}

	/**
	 * Displays top level Media Compare Page
	 */
	function iom_pk_main_admin_page(){
		?>
		<div class="wrap">
			
		<?php
			echo "<h2><b> Impression Of Media </b></h2><br/><br/>";
			echo " <b> DESCRIPTION </b> <br/>The plugin allows you to upload images and rate the images 
			individually or in pairs. The images can be rated within the range 0 and 1.
			The results are stored and can be downloaded in CSV format. <br/>The images can be rated in a point system i.e. give a single value between 0 to 1 or in a range say between 0.4 to 0.6 <br/>
			<br/> The choice of point or range rating is given to the researcher. The researcher can give labels to the ratings saying \"how funny\" or \"how happy\". These inputs are collected in the settings tab. ";
			//$upload_dir = wp_upload_dir();
			//print_r($upload_dir);
		?>
		</div>
		<?php
	}
	
		
	

	
	/* EOF*/