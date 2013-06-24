<?php
	/*
		Plugin Name: Impression of Media
		Plugin URI: http://acopi.wp.horizon.ac.uk
		Description: Plugin to upload digital content and compare and analyze them.
		Author: Praseeda Kalkur
		Version: 0.1
		Author URI: http://iodc.cloudapp.net
	*/

/*  Copyright (C) 2013  Horizon Digital Economy Research Institute, Praseeda Kalkur
	
	    This program is free software: you can redistribute it and/or modify
	    it under the terms of the GNU Affero General Public License as
	    published by the Free Software Foundation, either version 3 of the
	    License, or (at your option) any later version.
	
	    This program is distributed in the hope that it will be useful,
	    but WITHOUT ANY WARRANTY; without even the implied warranty of
	    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	    GNU Affero General Public License for more details.
	
	    You should have received a copy of the GNU Affero General Public License
	    along with this program.  If not, see <http://www.gnu.org/licenses/>.
	*/

	//include() or require() any necessary files
	include_once('includes/Database.php');
	include_once('includes/admin_interface.php');

// Tie into WordPress Hooks and any functions that should run on load. 

	add_action('init','Database::iod_pk_init_tables');
	add_action('init', 'iom_pk_load_plugin_script');
	add_action('init', 'iom_pk_plugin_style');

	/**
	 * Sets up common variables and required files
	 */
	
	iom_pk_setup();
	
	function iom_pk_plugin_style() {
		//wp_register_style('list_stylesheet', plugins_url('includes/list1.css', __FILE__));
		//wp_enqueue_style( 'list_stylesheet');
	
		wp_register_style('fileuploader_stylesheet', plugins_url('css/jquery-ui.css', __FILE__));
		wp_enqueue_style( 'fileuploader_stylesheet');
		
		wp_register_style('plugin_fileuploader_stylesheet', plugins_url('nm_fileuploader_style.css', __FILE__));
		wp_enqueue_style( 'plugin_fileuploader_stylesheet'); 

		wp_register_style('plugin_slider', plugins_url('css/slider.css', __FILE__));
		wp_enqueue_style( 'plugin_slider');
}

	function iom_pk_load_plugin_script() {
		wp_register_script( 'jquery', plugins_url('js/jquery-1.4.4.min.js', __FILE__));
		wp_enqueue_script("jquery");
		
		wp_register_script( 'settings_js', plugins_url('js/setting.js', __FILE__));
		wp_enqueue_script("settings_js");
	
		wp_register_script( 'fileuploader_custom_script', plugins_url('js/fileuploader_custom.js', __FILE__), 
	 					array('uploadify_script'));
		wp_enqueue_script('fileuploader_custom_script');
	 
		wp_register_style( 'file-upload-style', plugins_url('css/styles.css', __FILE__) );
		wp_enqueue_style('file-upload-style');
	}
	
	function iom_pk_setup(){		
				
		// Define the plugin name
	if ( !defined( 'IOM_PK_NAME' ) )
		define( 'IOM_PK_NAME', 'Impression Of Media' );
		
		// Define the IOM blog id -- idea courtesy of Buddypress
	if ( !defined( 'IOM_PK_ROOT_BLOG' ) ) {
		if( !is_multisite() ) {
			$_id = 1;
		}else if ( !defined( 'IOM_PK_ENABLE_MULTIBLOG' ) ) {
			$current_site = get_current_site();
			$_id = $current_site->blog_id;
		} else {
			$_id = get_current_blog_id();
		}
		define( 'IOM_PK_ROOT_BLOG', $_id );
	}
		
		// Path and URL
	if ( !defined( 'IOM_PK_PLUGIN_DIR' ) )
		define( 'IOM_PK_PLUGIN_DIR', WP_PLUGIN_DIR . '/media-compare' );
		
	if ( !defined( 'IOM_PK_PLUGIN_URL' ) )
		define( 'IOM_PK_PLUGIN_URL', plugins_url( 'media-compare' ) );
		
	iom_pk_blogusers_checkVersion(3);
		
		//load_plugin_textdomain('blogusers',false,'blogusers/languages');
		
		//require_once( HN_BU_PLUGIN_DIR . '/includes/hn_bu_utilitiesloader.php'     );
		//require_once( HN_BU_PLUGIN_DIR . '/controllers/hn_bu_controllers-loader.php'     );
		//require_once( HN_BU_PLUGIN_DIR . '/views/hn_bu_views-loader.php'     );
		//require_once( HN_BU_PLUGIN_DIR . '/admin/hn_bu_admin-loader.php'     );
	}
	
	/**
	 * Plugin activation. This creates the initial multisite tables.
	 */
	function iom_pk_blogusers_activate() {
		// Ensure that ABSPATH was defined
		if ( !defined( 'ABSPATH' ) ) exit;
		
		//$hn_bu_db = new HN_BU_Database();
		//$hn_bu_db->hn_bu_createTables();		

	}
	
	/**
	 * Plugin deactivation. Currently this does nothing, 
	 * but in the future should clean up the plugin database tables and files.
	 */
	function iom_pk_blogusers_deactivate() {
		wp_clear_scheduled_hook( 'hn_bu_cron_hook' );
	}
	
		/**
	 * Exits the plugin if the WP version is lower than $minver 
	 * @param $minver is the minimum version of Wordpress supported
	 */
	function iom_pk_blogusers_checkVersion($minver){
		global $wp_version;
		$exit_msg="IOM_PK_NAME requires Wordpress version ".$wp_version.' or newer.';
		if(version_compare($wp_version, $minver,"<")){
			exit($exit_msg);
		}
	}

	
/*EOF*/
