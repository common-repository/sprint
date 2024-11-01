<?php 
/**
* @package demo-plugin
*/
namespace Sprint\Menu;
use \Sprint\Api\ERP_SPRINT_Settings_Api;
use \Sprint\Api\Callback\ERP_SPRINT_Admin_Callback;
/**
* 
*/
class ERP_SPRINT_Admin
{
  protected $settings;
  public $pages = array();
  public $sub_pages = array();
  public $callback;

  public function __construct() {

    $this->settings = new ERP_SPRINT_Settings_Api();
    $this->callback = new ERP_SPRINT_Admin_Callback();
  }

  public function erp_sprint_register() { 
    // add_action( 'admin_menu',array($this,'add_admin_pages') );
    $this->erp_sprint_set_pages();
    $this->erp_sprint_set_sub_page();
    $this->settings->erp_sprint_add_pages($this->pages)->erp_sprint_with_sub_pages('Orders')->erp_sprint_add_sub_page($this->sub_pages)->erp_sprint_register();
  } 

  public function erp_sprint_set_pages() {
    global $wpdb;
    $settingAtrs = $wpdb->get_row( "SELECT * FROM wp_logixgridsetting WHERE ID =  '".ERP_SPRINT_ID."'" , ARRAY_A );  
    if (is_array($settingAtrs) && isset($settingAtrs['pluginName']) && $settingAtrs['pluginName'] != '') {
      $pluginName = $settingAtrs['pluginName'];
    } else {
      $pluginName = 'Sprint Plugin';
    }

    $this->pages = array(
        array(
          'page_title' => $pluginName, 
          'menu_title' => $pluginName, 
          'capability' => 'manage_options', 
          'menu_slug' => 'erp-sprint', 
          'callback' => array($this->callback,'erp_sprint_orders'), 
          'icon_url' => 'dashicons-editor-justify', 
          'position' => 110
        ),
      );
  }
  public function erp_sprint_set_sub_page() {
    $admin_page = $this->pages[0];
    $this->sub_pages = array(
      array(
          'parent_slug' => $admin_page['menu_slug'],
          'page_title' => 'Calculate Tariff',
          'menu_title' => 'Calculate Tariff',
          'capability' => 'manage_options',
          'menu_slug' => 'erp-sprint-calculate-tariff',
          'callback' => array($this->callback, 'erp_sprint_calculate_tariff'),
      ),
      array(
          'parent_slug' => $admin_page['menu_slug'],
          'page_title' => 'Create Waybill',
          'menu_title' => 'Create Waybill',
          'capability' => 'manage_options',
          'menu_slug' => 'erp-sprint-create-waybill',
          'callback' => array($this->callback, 'erp_sprint_create_waybill'),
      ),
      array(
          'parent_slug' => $admin_page['menu_slug'],
          'page_title' => 'Pickup Request',
          'menu_title' => 'Pickup Request',
          'capability' => 'manage_options',
          'menu_slug' => 'erp-sprint-pickup-request',
          'callback' => array($this->callback, 'erp_sprint_pickup_request'),
      ),
      array(
          'parent_slug' => $admin_page['menu_slug'],
          'page_title' => 'Vendor',
          'menu_title' => 'Vendor',
          'capability' => 'manage_options',
          'menu_slug' => 'erp-sprint-vendor',
          'callback' => array($this->callback, 'erp_sprint_vendor'),
      ),
      array(
          'parent_slug' => $admin_page['menu_slug'],
          'page_title' => 'Setting',
          'menu_title' => 'Setting',
          'capability' => 'manage_options',
          'menu_slug' => 'erp-sprint-setting',
          'callback' => array($this->callback, 'erp_sprint_setting'),
      )
    );
  }
}