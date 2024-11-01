<?php 
/**
* @package demo-plugin
*/
namespace Sprint\Ajax;
use \Sprint\Api\Callback\ERP_SPRINT_Service;
use \Sprint\Api\Callback\ERP_SPRINT_Order_Api;
use \Sprint\Api\Callback\ERP_SPRINT_Country;
use \Sprint\Api\Callback\ERP_SPRINT_Calculate_Tariff;
use \Sprint\Api\Callback\ERP_SPRINT_Create_Manual_Waybill;
use \Sprint\Api\Callback\ERP_SPRINT_Pickup_Service;

class ERP_SPRINT_Ajax_Service {
  private function erp_sprint_get_setting() {
    global $wpdb;
    return $wpdb->get_row("SELECT * FROM wp_logixgridsetting WHERE ID = '".ERP_SPRINT_ID."'");
  }

  private function erp_sprint_get_setting_array() {
    global $wpdb;
    return $wpdb->get_row( "SELECT * FROM wp_logixgridsetting WHERE ID =  '".ERP_SPRINT_ID."'" ,ARRAY_A );
  }

  public function erp_sprint_register() {
    add_action('wp_ajax_erp_sprint_getChildWaybill',
                array(
                  $this, 
                  'erp_sprint_getChildWaybill' 
                )
              );

    add_action('wp_ajax_erp_sprint_create_orders',
                  array(
                    $this,
                    'erp_sprint_create_orders'
                  )
              );

    add_action('wp_ajax_erp_sprint_get_state_name',
                  array(
                    $this,
                    'erp_sprint_get_state_name'
                  )
              );

    add_action('wp_ajax_erp_sprint_get_city_name',
                array(
                  $this,
                  'erp_sprint_get_city_name'
                )
              );

    add_action('wp_ajax_erp_sprint_get_calculate_tariff', 
                array(
                  $this,
                  'erp_sprint_get_calculate_tariff'
                )
              );

    add_action('wp_ajax_erp_sprint_create_manual_waybill', 
                array(
                  $this,
                  'erp_sprint_create_manual_waybill'
                )
              );

    add_action('wp_ajax_erp_sprint_get_pickup_request',
                array(
                  $this,
                  'erp_sprint_get_pickup_request'
                )
              );

    add_action('wp_ajax_erp_sprint_setting', 
                  array(
                    $this,
                    'erp_sprint_setting'
                  )
              );
    add_action('wp_ajax_erp_sprint_vendor', 
                  array(
                    $this,
                    'erp_sprint_vendor'
                  )
              );

    add_action( 'rest_api_init', function () {
      register_rest_route( 'sprint/v1/', '/waybill_update', array(
        'methods' => 'GET, POST',
        'callback' => array($this,'erp_sprint_update_waybill'),
      ));
    });
  }
 
  public function erp_sprint_update_waybill($req) {
    if (!isset($req['waybillNumber'])) {
      return array('result' => 'Error', 'messageType'=>'waybillNumber is missing');
    }
    if (!isset($req['status'])) {
      return array('result' => 'Error', 'messageType'=>'status is missing');
    }
    $waybillNumber = $req['waybillNumber'];
    $status = $req['status'];
    global $wpdb;
    $data = $this->erp_sprint_get_setting_array();
    $logixgrid_setting = $wpdb->get_row("SELECT * FROM wp_logixgridwaybillSecureKey WHERE waybill_number = '". $waybillNumber ."' and secure_key = '".$data['secureKey']."'", ARRAY_A );
    if (count($logixgrid_setting) > 0) {
      $id = $logixgrid_setting['ID'];
      $waybill_status = $logixgrid_setting['waybill_status'];
      $get_status = unserialize($waybill_status);
      $status = serialize(array($status));
      $result = $wpdb->update( 'wp_logixgridwaybillSecureKey', array( 'waybill_status' => $status ),array('ID' => $id));
      $data = array('result' => 'Success', 'messageType'=>'Status is updated successfully');
    } else {
      $data = array('result' => 'Error', 'messageType'=>'Waybill doesn\'t not exits');
    }
    return $data;
  }

  public function erp_sprint_vendor() {
    global $wpdb;
    if (!isset($_REQUEST['code']) || $_REQUEST['code'] == '') {
     echo json_encode(array('result' => 'Error', 'messageType'=>'Please enter code')); 
     die();
    }
    $vendor_code = sanitize_text_field(wp_unslash($_REQUEST['code']));
    $vendor_data = $wpdb->get_row("SELECT * FROM wp_logixgridvendor WHERE code =  '".$vendor_code ."'",ARRAY_A); 

    if (count($vendor_data) > 0 ) {
     echo json_encode(array('result' => 'Error', 'messageType'=>'Code is already exits')); die();
    }

    if (!isset($_REQUEST['name']) || $_REQUEST['name'] == '') {
     echo json_encode(array('result' => 'Error', 'messageType'=>'Please enter name')); die();
    }

    if (!isset($_REQUEST['phone_number']) || $_REQUEST['phone_number'] == '') {
     echo json_encode(array('result' => 'Error', 'messageType'=>'Please enter phone number')); die();
    }

    if (!isset($_REQUEST['address']) || $_REQUEST['address'] == '') {
     echo json_encode(array('result' => 'Error', 'messageType'=>'Please enter address')); die();
    }

    if (!isset($_REQUEST['country']) || $_REQUEST['country'] == '') {
     echo json_encode(array('result' => 'Error', 'messageType'=>'Please enter Country ')); die();
    }

    if (!isset($_REQUEST['state']) || $_REQUEST['state'] == '') {
     echo json_encode(array('result' => 'Error', 'messageType'=>'Please enter State ')); die();
    }

    if (!isset($_REQUEST['city']) || $_REQUEST['city'] == '') {
     echo json_encode(array('result' => 'Error', 'messageType'=>'Please enter City  ')); die();
    }

    if (!isset($_REQUEST['pincode']) || $_REQUEST['pincode'] == '') {
     echo json_encode(array('result' => 'Error', 'messageType'=>'Please enter code')); die();
    }  

    global $wpdb;
    
    $accessKey = 'logixerp';
    $code = sanitize_text_field(wp_unslash($_REQUEST['code']));
    $name  = sanitize_text_field(wp_unslash($_REQUEST['name']));
    $phone_number  = sanitize_text_field(wp_unslash($_REQUEST['phone_number']));
    $address  = sanitize_text_field(wp_unslash($_REQUEST['address']));
    $country = sanitize_text_field(wp_unslash($_REQUEST['country']));
    $state = sanitize_text_field(wp_unslash($_REQUEST['state']));
    $city = sanitize_text_field(wp_unslash($_REQUEST['city']));
    $pincode = sanitize_text_field(wp_unslash($_REQUEST['pincode'])); 
    $wpdb->insert(
                'wp_logixgridvendor',
                array(
                  'code' => $code ,
                  'name' => $name,
                  'phone_number'=> $phone_number,
                  'address' => $address,
                  'country' => $country,
                  'state' => $state,
                  'city' => $city,
                  'pincode' => $pincode 
                ),
                array('%s','%s','%s','%s')
            );
    $meta_id = $wpdb->insert_id;
    if($meta_id) {
      echo json_encode(array('result' => 'Success', 'messageType'=>'Add Successfully'));
    } else {
      echo json_encode(array('result' => 'Error', 'messageType'=>'Please Try Again'));
    }
    die;
  }

  public function erp_sprint_getChildWaybill(){
    global $wpdb;
    $data = sanitize_text_field(wp_unslash($_REQUEST['waybill']));
    $orderlists = $wpdb->get_results("SELECT * FROM wp_logixgridwaybillSecureKey where   parent_waybill ='".$data."'");
    echo json_encode($orderlists);
    die; 
  }

  public function erp_sprint_setting() {
    $secureKey = sanitize_text_field(wp_unslash($_REQUEST['secure_key'])); 
    $services = ERP_SPRINT_Service::erp_sprint_get_service($secureKey,sanitize_text_field(wp_unslash($_REQUEST['customer_code'])));
    
    if ($services['messageType'] != 'Success') { 
      echo json_encode(array('error' => 'Error', 'messageType'=>'Your Secure Key and Customer Code is not correct. Please try again'));
    } else {
      global $wpdb;
      $accessKey = 'logixerp';
      $customerCode = sanitize_text_field(wp_unslash($_REQUEST['customer_code']));
      $serviceCode  = sanitize_text_field(wp_unslash($_REQUEST['service_code']));
      $sourceCountry  = sanitize_text_field(wp_unslash($_REQUEST['source_country']));
      $pluginName  = sanitize_text_field(wp_unslash($_REQUEST['plugin_name']));
      $pickup_address = sanitize_text_field(wp_unslash($_REQUEST['pickup_address']));
      $pickup_city = sanitize_text_field(wp_unslash($_REQUEST['pickup_city']));
      $pickup_state = sanitize_text_field(wp_unslash($_REQUEST['pickup_state']));
      $pickup_zipcode = sanitize_text_field(wp_unslash($_REQUEST['pickup_zipcode']));
      $settingAtrs = $this->erp_sprint_get_setting_array();
      if (!empty($settingAtrs)) { 
        $updateQuery = $wpdb->update( 
                          'wp_logixgridsetting', 
                          array(
                            'pickup_address' => $pickup_address,
                            'pickup_city' => $pickup_city , 
                            'pickup_state'=> $pickup_state , 
                            'secureKey' => $secureKey, 
                            'accessKey' => $accessKey, 
                            'customerCode' => $customerCode, 
                            'serviceCode' => $serviceCode, 
                            'sourceCountry' => $sourceCountry,
                            'pluginName' => $pluginName,
                            'pickup_zipcode' => $pickup_zipcode
                          ), 
                          array( 'ID' => ERP_SPRINT_ID)
                        ); 
        if( $updateQuery === false) {
          echo json_encode(array('result' => 'Error', 'messageType'=>'Please Try Again'));
        } else {
          echo json_encode(array('result' => 'Success', 'messageType'=>'Update Successfully'));
        }
      } else {
 
        $wpdb->insert(
                    'wp_logixgridsetting',
                    array(
                      'ID' => ERP_SPRINT_ID,
                      'pickup_address' => $pickup_address ,
                      'pickup_city' => $pickup_city,
                      'pickup_state'=> $pickup_state,
                      'secureKey' => $secureKey,
                      'accessKey' => $accessKey,
                      'customerCode' => $customerCode,
                      'serviceCode' => $serviceCode,
                      'sourceCountry' => $sourceCountry,
                      'pluginName' => $pluginName,
                      'pickup_zipcode' => $pickup_zipcode
                    ),
                    array('%s','%s','%s','%s')
                );
        $meta_id = $wpdb->insert_id;
        if($meta_id) {
          echo json_encode(array('result' => 'Success', 'messageType'=>'Update Successfully'));
        } else {
          echo json_encode(array('result' => 'Error', 'messageType'=>'Please Try Again'));
        }
      }
    }
    exit;
  }

  public function erp_sprint_get_pickup_request() {
    $pickupServiceObj = new ERP_SPRINT_Pickup_Service();
    $readytime = sanitize_text_field(wp_unslash($_REQUEST['readytime'].':00')); 
    $latesttimeAvailable = sanitize_text_field(wp_unslash($_REQUEST['latesttimeAvailable'].':00'));
    $pickupcountry = sanitize_text_field(wp_unslash($_REQUEST['pickupcountry']));
    $pickupstate = sanitize_text_field(wp_unslash($_REQUEST['pickupstate']));
    $pickupcity = sanitize_text_field(wp_unslash($_REQUEST['pickupcity']));
    $pickupaddress = sanitize_text_field(wp_unslash($_REQUEST['pickupaddress']));
    $pickupzipcode = sanitize_text_field(wp_unslash($_REQUEST['pickupzipcode']));
    $pickupdate = sanitize_text_field(wp_unslash($_REQUEST['pickupdate']));
    $clientcode = sanitize_text_field(wp_unslash($_REQUEST['clientcode']));
    $Waybillnumbers = sanitize_text_field(wp_unslash($_REQUEST['Waybillnumbers']));
    $pickuptype = sanitize_text_field(wp_unslash($_REQUEST['pickuptype']));
    $specialinstruction = sanitize_text_field(wp_unslash($_REQUEST['specialinstruction']));
    $waybill_lists = explode(',', $Waybillnumbers);

    foreach($waybill_lists as $waybill_list) { 
      $apiRes = $pickupServiceObj->erp_sprint_create_pickup($readytime,$latesttimeAvailable,$pickupcountry,$pickupstate,$pickupcity,$pickupaddress,$pickupzipcode,$pickupdate,$clientcode,$waybill_list,$pickuptype,$specialinstruction);
      $pickupDB = $pickupServiceObj->erp_sprint_update_pickup_number_db($waybill_list,$apiRes );
      $pickupDB =  str_replace("<ul>",  "", $pickupDB);
      $pickupDB =  str_replace("</ul>", "", $pickupDB);
      $pickupDB =  str_replace("</li>", "", $pickupDB);
      $pickupDB =  str_replace("<li>",  "", $pickupDB);
      echo esc_html($pickupDB);
    }
    exit;
  }

  private function erp_sprint_is_float($floatString , $is_empty = true) {
    if ($is_empty == false &&  $floatString == '') {
      return true;
    }
    return (bool)preg_match('/(^\d+\.\d+$|^\d+$)/',$floatString);
  }

  public function erp_sprint_create_manual_waybill() {
    $settingAtrs = $this->erp_sprint_get_setting();
    $basicDetails = array();
    $basicDetails[0] = sanitize_text_field(wp_unslash($_REQUEST['service']));
    $basicDetails[1] = sanitize_text_field(wp_unslash($_REQUEST['invoice_value']));
    $basicDetails[2] = sanitize_text_field(wp_unslash($_REQUEST['invoice_number']));
    $basicDetails[3] = sanitize_text_field(wp_unslash($_REQUEST['reference_number']));

    if (!$this->erp_sprint_is_float(sanitize_text_field(wp_unslash($_REQUEST['cod_amount'])), false)) {
      echo json_encode(array('status'=> 'Error', 'message'=> 'COD amount should be numaric.'));
      exit;
    }
    $basicDetails[4] = sanitize_text_field(wp_unslash($_REQUEST['cod_amount']));
    $basicDetails[5] = 
    sanitize_text_field(wp_unslash($_REQUEST['description']));

    if (!$this->erp_sprint_is_float(sanitize_text_field(wp_unslash($_REQUEST['refund_amount'])), false)) {
      echo json_encode(array('status'=> 'Error', 'message'=> 'Refund_amount amount should be numaric.'));
      exit;
    }

    $basicDetails[6] = sanitize_text_field(wp_unslash($_REQUEST['refund_amount']));
    $basicDetails[7] = sanitize_text_field(wp_unslash($_REQUEST['reverse_logixtics_activity']));
    
    $shipperDetails = array();
    $shipperDetails[0] = sanitize_text_field(wp_unslash($_REQUEST['scompanyname']));
    $shipperDetails[1] = sanitize_text_field(wp_unslash($_REQUEST['scontactperson']));
    $shipperDetails[2] = sanitize_text_field(wp_unslash($_REQUEST['saddress']));
    $shipperDetails[3] = sanitize_text_field(wp_unslash($_REQUEST['sareaname']));
    $shipperDetails[4] = sanitize_text_field(wp_unslash($_REQUEST['sphone']));
    $shipperDetails[5] = sanitize_text_field(wp_unslash($_REQUEST['semail']));
    $shipperDetails[6] = sanitize_text_field(wp_unslash($_REQUEST['scountry']));
    $shipperDetails[7] = sanitize_text_field(wp_unslash($_REQUEST['sstate']));
    $shipperDetails[8] = sanitize_text_field(wp_unslash($_REQUEST['scity']));
    $shipperDetails[9] = sanitize_text_field(wp_unslash($_REQUEST['spincode']));
    
    $consigneeDetails = array();
    $consigneeDetails[0]  =  sanitize_text_field(wp_unslash($_REQUEST['ccompanyname']));
    $consigneeDetails[1]  =  sanitize_text_field(wp_unslash($_REQUEST['ccontactperson']));
    $consigneeDetails[2]  =  sanitize_text_field(wp_unslash($_REQUEST['caddress']));
    $consigneeDetails[3]  =  sanitize_text_field(wp_unslash($_REQUEST['careaname']));
    $consigneeDetails[4]  =  sanitize_text_field(wp_unslash($_REQUEST['cphone']));
    $consigneeDetails[5]  =  sanitize_text_field(wp_unslash($_REQUEST['cemail']));
    $consigneeDetails[6]  =  sanitize_text_field(wp_unslash($_REQUEST['ccountry']));
    $consigneeDetails[7]  =  sanitize_text_field(wp_unslash($_REQUEST['cstate']));
    $consigneeDetails[8]  =  sanitize_text_field(wp_unslash($_REQUEST['ccity']));
    $consigneeDetails[9]  =  sanitize_text_field(wp_unslash($_REQUEST['cpincode']));
    $consigneeDetails[10] =  sanitize_text_field(wp_unslash($_REQUEST['cod_payment_mode']));
    $packageDetails = array(); 
    /* 
      @parmeter $_REQUEST['packageDetails'] is an array
      To implement sanitize this request, We have use foreach loop
      key and values are sanitize and wp_unslash
    */ 
    foreach ($_REQUEST['packageDetails'] as $package_key => $package_value ) {
      foreach ($package_value as $key => $value) {
        $packageDetails[sanitize_text_field(wp_unslash($package_key))][sanitize_text_field(wp_unslash($key))] = sanitize_text_field(wp_unslash($value));
        if ($key != 6 && !$this->erp_sprint_is_float(sanitize_text_field(wp_unslash($packageDetails[$package_key][$key])))) {
          echo json_encode(array('status'=> 'Error', 'message'=> 'Package Details should be numaric (Quantity, Length, Width, Height, Actual Weight, Charged Weight).'));
          exit;
        }
      }
    } 
    $createManual = new ERP_SPRINT_Create_Manual_Waybill();
    $createManual = $createManual->erp_sprint_create_manual_waybill(
                      $settingAtrs,
                      $basicDetails,
                      $shipperDetails,
                      $consigneeDetails,
                      $packageDetails
                    ); 
    echo json_encode($createManual);
    exit;
  }

  public function erp_sprint_get_calculate_tariff() {
    $settingAtrs = $this->erp_sprint_get_setting();
    
    if (!$this->erp_sprint_is_float(sanitize_text_field(wp_unslash($_REQUEST['ppackages'])))) {
      echo json_encode(array('messageType' => 'Error', 'message' => 'Package should be numaric')); 
      exit;
    }

    if (!$this->erp_sprint_is_float(sanitize_text_field(wp_unslash($_REQUEST['pweight'])))) {
      echo json_encode(array('messageType' => 'Error', 'message' => 'Package weight should be numaric'));  
      exit;
    }

    $calResp = ERP_SPRINT_Calculate_Tariff::erp_sprint_calculate_tariff(
                $settingAtrs,
                sanitize_text_field(wp_unslash($_REQUEST['scountry'])),
                sanitize_text_field(wp_unslash($_REQUEST['sstate'])),
                sanitize_text_field(wp_unslash($_REQUEST['scity'])),
                sanitize_text_field(wp_unslash($_REQUEST['szip'])),
                sanitize_text_field(wp_unslash($_REQUEST['dcountry'])),
                sanitize_text_field(wp_unslash($_REQUEST['dstate'])),
                sanitize_text_field(wp_unslash($_REQUEST['dcity'])),
                sanitize_text_field(wp_unslash($_REQUEST['dzip'])),
                sanitize_text_field(wp_unslash($_REQUEST['pservices'])),
                sanitize_text_field(wp_unslash($_REQUEST['ppackages'])),
                sanitize_text_field(wp_unslash($_REQUEST['pweight']))
              );

    $main_cal_res = json_decode($calResp);  
    if($main_cal_res->messageType == 'Error') {
      echo json_encode(array('messageType'=> $main_cal_res->messageType, 'message'=> $main_cal_res->message)); 
    } else {
        $total_tax_amount = $main_cal_res->totalAmount + $main_cal_res->taxAmount; 
        echo json_encode(
                array( 
                      'total_tax_amount' => $total_tax_amount, 
                      'totalAmount' => $main_cal_res->totalAmount,
                      'taxAmount' => $main_cal_res->taxAmount,
                      'totalAmount' => $main_cal_res->totalAmount,
                      'messageType' =>'Success'
                    )
              );
    }
    exit;
  }

  public function erp_sprint_get_state_name() {
    $settingAtrs = $this->erp_sprint_get_setting();
    $RespStates = ERP_SPRINT_Country::erp_sprint_get_states($settingAtrs);
     
    $stateCodeCheck = 0;
    if (isset($_REQUEST['statecode'])) {
        $stateCode =  sanitize_text_field(wp_unslash($_REQUEST['statecode']));
        $stateCodeCheck = 1;
    }
    $state_list = array();
    foreach($RespStates as $RespState) {
        $code =  $RespState['code'];
        if ($stateCode == 0 ) {
          $state_list[$RespState['code']] = $RespState['name'];
        }
        if($code == 1 and $code == $stateCode) {
            $city = $RespState['cities'];
            $cityNames = explode(",",$city);
            $citySortNames = sort($cityNames);
            foreach($cityNames as $cityName)
            {
              $state_list[$cityName] = $cityName; 
            }
        } 
    }
    echo json_encode($state_list);
    exit;
  }

  public function erp_sprint_create_orders() { 
    $settingAtrs = $this->erp_sprint_get_setting();
    $erpApiObj = new ERP_SPRINT_Order_Api();
    $orderDetails = array();
   
    foreach ($_REQUEST['orderdetails'] as $value) {
      $orderDetails[] = sanitize_text_field(wp_unslash($value));
    }
    $orderids = $orderDetails[0];
    $serCode = $orderDetails[1];
    $cusCode = $orderDetails[2];
    $orderids_array = explode(",",$orderids);
    $final_result = [];
    foreach($orderids_array as $orderid) {
      $oinfo = $erpApiObj->erp_sprint_order_info($settingAtrs,
                                                  $orderid,
                                                  $serCode,
                                                  $cusCode
                                                ); 
      $final_result[] = $erpApiObj->erp_sprint_insert_db_waybill($oinfo['result'],
                                        $orderid,
                                        $serCode,
                                        $cusCode);
    }
    echo json_encode($final_result); 
    die;
  }

  public function erp_sprint_get_city_name() {
    $settingAtrs = $this->erp_sprint_get_setting();
    $RespStates = ERP_SPRINT_Country::erp_sprint_get_states($settingAtrs);
    $stateCode = sanitize_text_field(wp_unslash($_REQUEST['statecode']));
    $city_data = array();
    foreach($RespStates as $RespState) {
      $code =  $RespState['code'];
      if($code == $stateCode)
      {
        $city = $RespState['cities'];
        $cityNames = explode(",",$city);
        $citySortNames = sort($cityNames);
        foreach($cityNames as $cityName) {
          $city_data[$cityName] = $cityName;
        }
      }
    }
    echo json_encode($city_data);
    exit;
  }
}