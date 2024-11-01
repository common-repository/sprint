<?php 
/**
* @package demo-plugin
*/ 
namespace Sprint\Api\Callback;
class ERP_SPRINT_Service {
  public static function erp_sprint_get_service($settingAtrs, $cusmCode = null) {
    $check = false;
    if (is_string($settingAtrs)) {
       $urls = ERP_SPRINT_API_URL."/webservice/v2/ActiveServices?secureKey=".$settingAtrs."&customerCode=".$cusmCode; 
      $check = true;
    } else {
      $cusmCode = $settingAtrs->customerCode;
      $sKey = $settingAtrs->secureKey;
      $aKey = $settingAtrs->accessKey;
      $urls = ERP_SPRINT_API_URL."/webservice/v2/ActiveServices?secureKey=".$sKey."&customerCode=".$cusmCode;
    }
    $args = array( 'headers' => array( ), 'timeout' => 500000 );
    try {
      $result = wp_remote_get($urls, $args);
      $body = json_decode($result['body'],true);
      if ($check) {
        return $body;
      } else {
        if ($body['messageType'] =='Success') {
          return $body['services'];
        } else {
          return array();
        }
      }
    } catch ( Exception $ex ) {
      return  array();
    }
  }
}