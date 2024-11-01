<?php
/**
* @package demo-plugin
*/
/* Link display in plugin menu setting */
namespace Sprint\Base;

class ERP_SPRINT_Setting_Link {
  protected $plugin;
  public function __construct(){
    $this->plugin = ERP_SPRINT_PLUGIN_NAME;
  }
  
  public function erp_sprint_register(){
    add_filter('plugin_action_links_'.$this->plugin, array($this, 'erp_sprint_setting_link'));
  }

  public function erp_sprint_setting_link($links){
    $setting_link='<a href="admin.php?page=erp-sprint-setting">Settings</a>';
    array_push($links, $setting_link);
    return $links;
  }
}
