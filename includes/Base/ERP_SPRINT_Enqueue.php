<?php
/**
* @package demo-plugin
*/ 
namespace Sprint\Base;
class ERP_SPRINT_Enqueue {
  public function erp_sprint_register() {
    add_action(
        'admin_enqueue_scripts', 
        array($this, 'erp_sprint_enqueue')
    );

    add_action(
        'admin_enqueue_scripts', 
        array($this, 'erp_sprint_admin_script')
    );
  }

  public function erp_sprint_enqueue() {
    wp_enqueue_style( 'mypluginstyle', ERP_SPRINT_PLUGIN_URL.'assets/css/admin/jquery.dataTables.css');
    wp_enqueue_script( 'mypluginstyle', ERP_SPRINT_PLUGIN_URL.'assets/js/admin/jquery.dataTables.js');
  }

  public function erp_sprint_admin_script() {
    wp_enqueue_script( 'sprint', ERP_SPRINT_PLUGIN_URL.'assets/js/admin/sprint_plugin_admin_js.js');
  }

}
