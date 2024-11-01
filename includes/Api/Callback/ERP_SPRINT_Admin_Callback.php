<?php 
/**
* @package demo-plugin
*/
namespace Sprint\Api\Callback;
use \Sprint\Api\Callback\ERP_SPRINT_Service;
use \Sprint\Api\Callback\ERP_SPRINT_Country;
// Menu and sub Menu
class ERP_SPRINT_Admin_Callback {
  public $logixgrid_setting;
  public function __construct() {
    global $wpdb; 
    $this->logixgrid_setting = $wpdb->get_row("SELECT * FROM wp_logixgridsetting WHERE ID = '".ERP_SPRINT_ID."'"); 
  }

  public function erp_sprint_setting() {
    
    $settingAtrs = $this->logixgrid_setting;
    $country = ERP_SPRINT_Country::erp_sprint_country_list();
    $services = ERP_SPRINT_Service::erp_sprint_get_service($settingAtrs);
    require_once(ERP_SPRINT_PLUGIN_PATH.'templates/erp_sprint_setting.php');
  }
  
  public function erp_sprint_pickup_request() {
    $settingAtrs = $this->logixgrid_setting;
    if (!empty($settingAtrs)) {
      global $wpdb;
      $waybill_list = $wpdb->get_results( "SELECT * FROM wp_logixgridwaybillSecureKey where pickup_number='' and secure_key = '".$settingAtrs->secureKey."'");
      $waybillchecks = array_reverse($waybill_list);
    }
    require_once(ERP_SPRINT_PLUGIN_PATH.'templates/erp_sprint_pickup_request.php');
  }

  public function erp_sprint_vendor() {
    $settingAtrs = $this->logixgrid_setting;
    $services = ERP_SPRINT_Service::erp_sprint_get_service($settingAtrs);
    global $wpdb;
    $vendor_list = $wpdb->get_results( "SELECT * FROM wp_logixgridvendor");
    $vendor_list = array_reverse($vendor_list);
    $country = ERP_SPRINT_Country::erp_sprint_country_list();
    require_once( ERP_SPRINT_PLUGIN_PATH.'templates/erp_sprint_vendor.php');
  }

  public function erp_sprint_create_waybill() {
    $settingAtrs = $this->logixgrid_setting;
    $country = ERP_SPRINT_Country::erp_sprint_country_list();
    $services = ERP_SPRINT_Service::erp_sprint_get_service($settingAtrs);
    $RespStates  = ERP_SPRINT_Country::erp_sprint_get_states($settingAtrs); 
    require_once( ERP_SPRINT_PLUGIN_PATH.'templates/erp_sprint_create_waybill.php');
  }

  public function erp_sprint_calculate_tariff () {
    $settingAtrs = $this->logixgrid_setting;
    $country = ERP_SPRINT_Country::erp_sprint_country_list();
    $services = ERP_SPRINT_Service::erp_sprint_get_service($settingAtrs);
    $RespStates  = ERP_SPRINT_Country::erp_sprint_get_states($settingAtrs); 
    require_once( ERP_SPRINT_PLUGIN_PATH.'templates/erp_sprint_calculate_tariff.php');
  }

  public function erp_sprint_orders() {
    $settingAtrs = $this->logixgrid_setting;
    if (!empty($settingAtrs)) {
      $services = ERP_SPRINT_Service::erp_sprint_get_service($settingAtrs);
      global $wpdb;
      $orderlists = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_type = 'shop_order'");
      $statuses = wc_get_order_statuses();
      $waybill_list = $wpdb->get_results( "SELECT * FROM wp_logixgridwaybillSecureKey where secure_key = '".$settingAtrs->secureKey."' and is_parent  != '2' ");
      $waybillchecks = array_reverse($waybill_list);
      $vendor_list = $wpdb->get_results( "SELECT * FROM wp_logixgridvendor");
      $vendor_list = array_reverse($vendor_list);
    }  
    require_once( ERP_SPRINT_PLUGIN_PATH.'templates/erp_sprint_orders.php');
  }

}