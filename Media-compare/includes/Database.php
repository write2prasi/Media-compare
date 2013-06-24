<?php
/*
*	Database class contains all the table creation scripts.
*	Create a new database iom_pk_media_analysis.
*	Create 3 new tables iom_pk_media_storage, iom_pk_media_rank, iom_pk_media_rate

	
*/
class Database {
	
//	$main_table = "iod_pk_media_stored";
// Create / Update the custom table


	function iod_pk_media_stored_create_table() {
	global $wpdb;
	$tablename = $wpdb-> prefix . "iod_pk_media_stored";
	$sql = "CREATE TABLE IF NOT EXISTS `$tablename` (
					  `image_id` int(100) NOT NULL AUTO_INCREMENT,
  					`content` varchar(500) NOT NULL,
					`image_name` varchar(100) NOT NULL,
  					`time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  					PRIMARY KEY (`image_id`)
					);";
	include_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	}

	function iod_pk_media_rank_create_table() {
	global $wpdb;
	$tablename = $wpdb-> prefix . "iod_pk_media_rank";
	$sql = "CREATE TABLE IF NOT EXISTS `$tablename` (
					    `rank_id` int(100) NOT NULL AUTO_INCREMENT,
 						`image_id1` int(100) NOT NULL,
  						`image_id2` int(100) NOT NULL,
						`question_id` int(100) NOT NULL,
  						`min_value` float DEFAULT NULL,
  						`max_value` float NOT NULL,
  						`time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  						PRIMARY KEY (`rank_id`)
					);";
	include_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	}
	
	function iod_pk_media_rate_create_table() {
	global $wpdb;
	$tablename = $wpdb-> prefix . "iod_pk_media_rate";
	$sql = "CREATE TABLE IF NOT EXISTS `$tablename` (
					    `rate_id` int(100) NOT NULL AUTO_INCREMENT,
  						`image_id` int(100) NOT NULL,
						`question_id` int(100) NOT NULL,
  						`min_value` float DEFAULT NULL,
  						`max_value` float NOT NULL,
  						`time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  						PRIMARY KEY (`rate_id`)
					);";
	include_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	}

	function iod_pk_media_settings_create_table() {
	global $wpdb;
	$tablename = $wpdb-> prefix . "iod_pk_media_settings";
	$sql = "CREATE TABLE IF NOT EXISTS `$tablename` (
					    `image_val` int(5) NOT NULL,
						`slider_val` int(5) NOT NULL,
						`no_of_sliders` int(5) NOT NULL,
  						`time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
					);";
	include_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	}
	
	function iod_pk_media_questions_create_table() {
	global $wpdb;
	$tablename = $wpdb-> prefix . "iod_pk_media_questions";
	$sql = "CREATE TABLE IF NOT EXISTS `$tablename` (
					    `question_id` int(100) NOT NULL AUTO_INCREMENT,
 						`question_name` varchar(500) NOT NULL,
						`left_label` varchar(500) NOT NULL,
						`right_label` varchar(500) NOT NULL,
						`center_label` varchar(500) NOT NULL,
  						`time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  						PRIMARY KEY (`question_id`)
					);";
	include_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	}
	
	function iod_pk_init_tables()
{
	Database::iod_pk_media_stored_create_table();
	Database::iod_pk_media_settings_create_table();
	Database::iod_pk_media_questions_create_table();
}
	
	}
	/* EOF*/