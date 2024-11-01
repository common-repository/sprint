<?php
/**
* @package demo-plugin
*/
namespace Sprint\Api\Callback;
class ERP_SPRINT_Order_Api {

  public function erp_sprint_child_waybill($settingAtrs, $array_data) {
    $data_post = json_encode($array_data);
    $wp_data_post = wp_json_encode($array_data);
    $url = ERP_SPRINT_API_URL.'/webservice/v2/CreateWaybill?secureKey='.$settingAtrs->secureKey;
    $response = wp_remote_post(
                  $url,
                  array(
                    'body'    =>  $wp_data_post,
                    'timeout' => 500000,
                    'headers' => array(
                      'Content-Type' => 'application/json',
                      'AccessKey'=> $settingAtrs->accessKey
                    )
                  )
                );
    $result = $response['body'];
    $data = json_decode($result);
    $save_data = array(
      "created_date" => date('Y-m-d'),
      "platform" => "wordpress",
      "shop" => $_SERVER['HTTP_HOST'],
      "shop_url" => $_SERVER['HTTP_HOST'],
      "short_key" => ERP_SPRINT_SHORT_KEY,
    );

    if ($data->messageType == 'Success') {
      $url = ERP_SPRINT_SAVE_COUNTER;
    } else {
      $url = ERP_SPRINT_ERROR_COUNTER;
      $errors = json_encode($data->message);
      $errors =  str_replace('"',"'",$errors);
      $save_data["errors"] = $errors;
    }
 
    $wp_data_post = wp_json_encode($save_data);
    //-----------
    wp_remote_post(
                  $url, 
                  array(
                    'body'    => $wp_data_post,
                    'timeout' => 500000,
                    'headers' => array(
                    'Content-Type' => 'application/json'
                    )
                  )
                ); 
    return $result; 
  }

  public function erp_sprint_order_info($settingAtrs, $oid, $scode, $cc) {
    $order = wc_get_order($oid);
    $items = $order->get_items();
    $description = ''; 
    foreach ($items as $item_id => $item) {
      $product = wc_get_product($item->get_product_id());
      $description.= 'Product SKU: ' . $product->get_sku().', ';
      $description.= 'Product name: ' . $item->get_name().', ';
      $description.= 'Product quantity: ' . $item->get_quantity().' | ';
    }
    $name = get_post_meta( $oid, '_billing_first_name', true ).' '.get_post_meta( $oid, '_billing_last_name', true );
    $address = get_post_meta( $oid, '_billing_address_1', true ).' , '.get_post_meta( $oid, '_billing_address_2', true );
    $country = get_post_meta( $oid, '_billing_country', true );
    $state = get_post_meta( $oid, '_billing_state', true );
    // $state_array = array(
    //           "JHR" => "Johor",
    //           "KDH" => "Kedah",
    //           "KTN" => "Kelantan",
    //           "MLK" => "Melaka",
    //           "NSN" => "Negeri Sembilan",
    //           "PHG" => "Pahang",
    //           "PRK" => "Perak",
    //           "PLS" => "Perlis",
    //           "PNG" => "Pulau Pinang",
    //           "SBH" => "Sabah",
    //           "SWK" => "Sarawak",
    //           "SGR" => "Selangor",
    //           "TRG" => "Terengganu",
    //           "KUL" => "W.P. Kuala Lumpur",
    //           "LBN" => "W.P. Labuan",
    //           "PJY" => "W.P. Putrajaya"
    //       );
    // $state = $state_array[$state];
    // $state = 'HR';
    $city = get_post_meta( $oid, '_billing_city', true );
    $pincode = get_post_meta( $oid, '_billing_postcode', true );
    $phone = get_post_meta( $oid, '_billing_phone', true );
    $pincode = get_post_meta( $oid, '_billing_postcode', true );
    $packageCount = count($items);
    $totalamount = get_post_meta( $oid, '_order_total', true );
    $paymentmethod = get_post_meta( $oid, '_payment_method', true );
    $array_data = Array (
                    'waybillRequestData' => Array(
                      'FromOU' => $state,
                      'WaybillNumber' => '',
                      'DeliveryDate' =>  '',
                      'CustomerCode' => $cc,
                      'ConsigneeCode' => '00000',
                      'ConsigneeAddress' => $address,
                      'ConsigneeCountry' => $country,
                      'ConsigneeState' => $state,
                      'ConsigneeCity' => $city,
                      'ConsigneePincode' => $pincode,
                      'ConsigneeName' => $name,
                      'ConsigneePhone' => $phone,
                      'ClientCode' => $settingAtrs->customerCode,
                      'NumberOfPackages' => 1,
                      'ActualWeight' => '0',
                      'ChargedWeight' => '1',
                      'CargoValue' => '',
                      'ReferenceNumber' => $oid,
                      'InvoiceNumber' => '',
                      'PaymentMode' => 'TBB' ,
                      'ServiceCode' => $scode,
                      'reverseLogisticActivity' => '',
                      'reverseLogisticRefundAmount' => '',
                      'WeightUnitType' => 'KILOGRAM',
                      'Description' => $description,
                      'COD' => '',
                      'CODPaymentMode' => '',
                      'DutyPaidBy' => 'Receiver',
                      'packageDetails' => '',
                      'CreateWaybillWithoutStock' =>'false',
                      'skipCityStateValidation' =>  "true"
                    )
                  );

    if ($paymentmethod == 'cod') { 
      $array_data['waybillRequestData']['CODPaymentMode'] = 'Cash';
      $array_data['waybillRequestData']['COD'] = $totalamount;
      // $array_data['waybillRequestData']['PaymentMode'] = 'Cash';
    }
    // print_r($array_data); die;
    $data_post = json_encode($array_data);
    
    $wp_data_post = wp_json_encode($array_data);
     
    $url = ERP_SPRINT_API_URL.'/webservice/v2/CreateWaybill?secureKey='.$settingAtrs->secureKey;
     
    $response = wp_remote_post(
                  $url, 
                  array(
                    'body'    =>  $wp_data_post,
                    'timeout' => 500000,
                    'headers' => array(
                      'Content-Type' => 'application/json',
                      'AccessKey'=> $settingAtrs->accessKey
                    )
                  )
                );
    $result = $response['body'];
    $data = json_decode($result);
    $save_data = array(
      "created_date" => date('Y-m-d'),
      "platform" => "wordpress",
      "shop" => $_SERVER['HTTP_HOST'] ,
      "shop_url" => $_SERVER['HTTP_HOST'] ,
      "short_key" => ERP_SPRINT_SHORT_KEY,
    );
    if ($data->messageType == 'Success') {
      $url = ERP_SPRINT_SAVE_COUNTER;
    } else {
      $url = ERP_SPRINT_ERROR_COUNTER;
      $errors = json_encode($data->message);
      $errors =  str_replace('"',"'",$errors);
      $save_data["errors"] = $errors;
    }
     //-----------
    wp_remote_post(
                  $url, 
                  array(
                    'body'    => wp_json_encode($save_data),
                    'timeout' => 500000,
                    'headers' => array(
                      'Content-Type' => 'application/json' 
                    )
                  )
                );
    return array('result' => $result, 'data' => $array_data);
  }

  public function erp_sprint_insert_db_waybill(
                $response,
                $orderID,
                $scode,
                $cusCode,
                $parent_waybill = 0,
                $parent_waybill_number = 0) {
    global $wpdb;
    $settingAtrs = $wpdb->get_row("SELECT * FROM wp_logixgridsetting WHERE ID = '".ERP_SPRINT_ID."'");
    $respons = array();
    $response_data = json_decode($response);
    $array_status = array($response_data->status);
    $array_remark = array('Data received successfully');
    if($response_data->messageType == 'Error') {
      $output = 'Order #'.$orderID.' : '.$response_data->message;
    } else {
      $cretedDate = date("Y/m/d h:i:a");
      global $wpdb; 
      $wpdb->insert(
        'wp_logixgridwaybillSecureKey',
        array(
          'wp_order_ID' => $orderID,
          'waybill_number' => $response_data->waybillNumber,
          'waybill_file_name' => $response_data->labelURL,
          'waybill_status' => serialize($array_status),
          'waybill_remark' => serialize($array_remark),
          'waybill_created' => $cretedDate,
          'service_name'    => $scode.'~'.$cusCode,
          'secure_key' => $settingAtrs->secureKey,
          'is_parent' => $parent_waybill,
          'parent_waybill' => $parent_waybill_number,
        ));
      $meta_id = $wpdb->insert_id;
      if($meta_id) {
        $output = 'Order #'.$orderID.': WayBill Created Successfully';
      } else{
        $output = 'Order #'.$orderID.': Not Created, Please try agin later';
      }
    }
    array_push($respons,$output);
    return $respons;
  } 
}