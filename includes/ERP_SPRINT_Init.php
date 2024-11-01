<?php
/**
* @package demo-plugin
*/
namespace Sprint;
final class ERP_SPRINT_Init{
  public static function erp_sprint_get_services() {
    return [
        Menu\ERP_SPRINT_Admin::class,
        Base\ERP_SPRINT_Enqueue::class,
        Base\ERP_SPRINT_Setting_Link::class,
        Ajax\ERP_SPRINT_Ajax_Service::class,  
    ];
  }

  public static function erp_sprint_register_services() { 
    foreach(self::erp_sprint_get_services() as $class) { 
      $service = self::erp_sprint_instantiate($class);
      if (method_exists($service, 'erp_sprint_register')) {
        $service->erp_sprint_register();
      }
    }
  }

  private static function erp_sprint_instantiate($class) {
    $service = new $class();
    return $service;
  }
}