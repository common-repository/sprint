<?php
/**
* @package demo-plugin
*/
namespace Sprint\Base;
class ERP_SPRINT_Deactive_Plugin {
  public static function erp_sprint_deactivate() { 
    global $wpdb; 
    $table_name = 'hello';
    $sql = "DELETE FROM `wp_logixgridsetting` WHERE `wp_logixgridsetting`.`ID` = '".ERP_SPRINT_ID."'";
    $wpdb->query($sql);
  }
}