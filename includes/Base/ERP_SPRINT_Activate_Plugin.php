<?php
/**
* @package demo-plugin
*/
// namespace Sprint\WooCommerce\Activeate;
namespace Sprint\Base;
class ERP_SPRINT_Activate_Plugin { 
  public static function erp_sprint_logix_setting_table() {      
    global $wpdb;
    $db_tb_name = 'wp_logixgridsetting';
    $charset_collate = $wpdb->get_charset_collate();
    if($wpdb->get_var( "show tables like '$db_tb_name'" ) != $db_tb_name) {
      $sql = "CREATE TABLE $db_tb_name ( 
        `ID` INT(255) NOT NULL AUTO_INCREMENT , 
        `secureKey` VARCHAR(255) NOT NULL , 
        `accessKey` VARCHAR(255) NOT NULL , 
        `customerCode` VARCHAR(255) NOT NULL ,
        `serviceCode` VARCHAR(255) NOT NULL ,
        `sourceCountry` VARCHAR(255) NOT NULL ,
        `pluginName` VARCHAR(255) NOT NULL ,
        `pickup_address` VARCHAR(255) NOT NULL,
        `pickup_state` VARCHAR(255) NOT NULL,
        `pickup_city` VARCHAR(255) NOT NULL,
        `pickup_zipcode` VARCHAR(255) NOT NULL,
        PRIMARY KEY (`ID`)) $charset_collate;";
      require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
      dbDelta( $sql );
    }
    // add_option( 'test_db_version', $test_db_version );
  }

  public static function erp_sprint_vendor_table() {      
    global $wpdb;
    $db_tb_name = 'wp_logixgridvendor';
    $charset_collate = $wpdb->get_charset_collate();
    if($wpdb->get_var( "show tables like '$db_tb_name'" ) != $db_tb_name) {
      $sql = "CREATE TABLE $db_tb_name ( 
        `ID` INT(255) NOT NULL AUTO_INCREMENT , 
        `code` VARCHAR(255) NOT NULL , 
        `name` VARCHAR(255) NOT NULL , 
        `address` VARCHAR(255) NOT NULL ,
        `country` VARCHAR(255) NOT NULL ,
        `state` VARCHAR(255) NOT NULL ,
        `city` VARCHAR(255) NOT NULL ,
        `pincode` VARCHAR(255) NOT NULL,
        `phone_number` VARCHAR(255) NOT NULL,
        PRIMARY KEY (`ID`)) $charset_collate;";
      require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
      dbDelta($sql);
    }
    // add_option( 'test_db_version', $test_db_version );
  }


  public static function erp_sprint_waybill_table() {
    global $wpdb;
    $db_table_name =  'wp_logixgridwaybillSecureKey';
    $charset_collate = $wpdb->get_charset_collate();
    if($wpdb->get_var("show tables like '$db_table_name'") != $db_table_name) {
      $sql = "CREATE TABLE $db_table_name ( 
      `ID` INT(255) NOT NULL AUTO_INCREMENT , 
      `wp_order_ID` VARCHAR(255) NOT NULL , 
      `waybill_number` VARCHAR(255) NOT NULL , 
      `waybill_file_name` VARCHAR(255) NOT NULL , 
      `waybill_status` VARCHAR(255) NOT NULL ,
      `waybill_remark` VARCHAR(255) NOT NULL , 
      `waybill_created` VARCHAR(255) NOT NULL ,
      `waybill_updated` VARCHAR(255) NOT NULL ,
      `service_name` VARCHAR(255) NOT NULL , 
      `pickup_number` VARCHAR(255) NOT NULL , 
      `secure_key` VARCHAR(255) NULL  , 
      PRIMARY KEY (`ID`)) $charset_collate;";
      require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
      dbDelta($sql);
    }
    // add_option( 'test_db_version', $test_db_version );
  }
   public static function erp_sprint_waybill_table_alert_table() {
    global $wpdb;
    $table_name = 'wp_logixgridwaybillSecureKey';
    // $waybilltable = "SELECT * FROM wp_logixgridwaybillSecureKey limit 1";
    // $waybillcheck = $wpdb->get_row($waybilltable);
      $waybilltable_status = 
      $charset_collate = $wpdb->get_charset_collate();
      $sql = 'ALTER TABLE `wp_logixgridwaybillSecureKey` ADD `is_parent` INT NOT NULL DEFAULT "0" AFTER `secure_key`'; 
      try {
        $wpdb->query($sql);
      } catch (Exception $e) {
        //here
      }

      $sql  = 'ALTER TABLE `wp_logixgridwaybillSecureKey` ADD `parent_waybill` VARCHAR(255) NOT NULL AFTER `secure_key`';
      try {
        $wpdb->query($sql);
      } catch (Exception $e) {
        // here
      }

  }
	public static function erp_sprint_activate() {
		global $wpdb;
    $table_name = 'hello';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
      name tinytext NOT NULL,
      text text NOT NULL,
      url varchar(55) DEFAULT '' NOT NULL,
      PRIMARY KEY  (id)
    ) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
	}
}

