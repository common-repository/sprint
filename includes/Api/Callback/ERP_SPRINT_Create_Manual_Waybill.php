<?php 
/**
* @package demo-plugin
*/ 
namespace Sprint\Api\Callback;
class ERP_SPRINT_Create_Manual_Waybill {
  public function erp_sprint_create_manual_waybill(
                                $settingAtrs,
                                $basicDetails,
                                $shipperDetails,
                                $consigneeDetails,
                                $packageDetails
                              ) 
  {
    $packageitems = array();
    $packagecount = array();
    $weight = array();
    foreach($packageDetails as $packageDetail) {
      if($packageDetail[0] == '' || $packageDetail[1] == '' || $packageDetail[2] == '' || $packageDetail[3] == '' || $packageDetail[4] == '' || $packageDetail[5] == '' || $packageDetail[6] == '' ) {
        $packageitems['error'] = 'Index #'.$packageDetail[7].". Please fill all the package details."; 
        break;
      } else {
        $packagrlist['barCode'] = ' ';
        $packagrlist['packageCount'] = $packageDetail[0];
        $packagrlist['length'] = $packageDetail[1];
        $packagrlist['width'] = $packageDetail[2];
        $packagrlist['height'] = $packageDetail[3];
        $packagrlist['weight'] = $packageDetail[4];
        $packagrlist['chargedWeight'] = $packageDetail[5];
        $packagrlist['selectedPackageTypeCode'] = $packageDetail[6];
        array_push($packagecount,$packageDetail[0]);
        array_push($weight,$packageDetail[5]);
        array_push($packageitems,$packagrlist);
      }
    }

    if (array_key_exists("error",$packageitems)) {
      $output['message'] = $packageitems['error'];
      $output['status'] = 'error';
      echo json_encode($output);
      exit(0);
    } else {
      $numberofpackages = array_sum($packagecount);
      $chargedweight = array_sum($weight);
      $WayBillDetails=  Array (
        'waybillRequestData' => 
        Array (
          'FromOU' => '',
          'DeliveryDate' => '',
          'WaybillNumber' => '',
          'CustomerCode' => $settingAtrs->customerCode,
          'CustomerName' => $shipperDetails[1],
          'CustomerAddress' => $shipperDetails[0].', '.$shipperDetails[2].', '.$shipperDetails[3],
          'CustomerCity' => $shipperDetails[8],
          'CustomerCountry' => $shipperDetails[6],
          'CustomerPhone' => $shipperDetails[4],
          'CustomerState' => $shipperDetails[7],
          'CustomerPincode' => $shipperDetails[9],
          'ConsigneeCode' => '00000',
          'ConsigneeName' => $consigneeDetails[1],
          'ConsigneePhone' => $consigneeDetails[4],
          'ConsigneeAddress' => $consigneeDetails[0].', '.$consigneeDetails[2].', '.$consigneeDetails[3],
          'ConsigneeCountry' => $consigneeDetails[6],
          'ConsigneeState' => $consigneeDetails[7],
          'ConsigneeCity' => $consigneeDetails[8],
          'ConsigneePincode' => $consigneeDetails[9],
          'ConsigneeWhat3Words' => 'word.exact.replace',
          'StartLocation' => '',
          'EndLocation' => '',
          'ClientCode' => $settingAtrs->customerCode,
          'NumberOfPackages' => $numberofpackages,
          'ActualWeight' => $chargedweight,
          'ChargedWeight' => $chargedweight,
          'CargoValue' => '',
          'ReferenceNumber' =>  $basicDetails[3],
          'InvoiceNumber' =>  $basicDetails[2],
          'PaymentMode' => 'PAID',
          'ServiceCode' =>  $basicDetails[0],
          'WeightUnitType' => 'KILOGRAM',
          'Description' =>  $basicDetails[5],
          'COD' =>  $basicDetails[4],
          'CODPaymentMode' => '',
          'reverseLogisticRefundAmount' =>  $basicDetails[6],
          'CODPaymentMode' =>  $consigneeDetails[10],
          'reverseLogisticActivity' =>  $basicDetails[7],
          'skipCityStateValidation' =>  "true",
          'PackageDetails' => Array (
            'packageJsonString' => $packageitems
          ),
        ),
      ); 
      $data_post= wp_json_encode($WayBillDetails);
      $url = ERP_SPRINT_API_URL.'/webservice/v2/CreateWaybill?secureKey='.$settingAtrs->secureKey;  
      $response = wp_remote_post(
                  $url,
                  array(
                    'body'    =>  $data_post,
                    'timeout' => 500000,
                    'headers' => array(
                      'Content-Type' => 'application/json',
                      'AccessKey'=> $settingAtrs->accessKey
                    )
                  )
                );
      $result = $response['body']; 
      $data_resp= json_decode($result);

      $insert_data = $this->erp_sprint_insert_db_waybill(
                                  $result,
                                  0,
                                  $basicDetails[0],
                                  $settingAtrs->customerCode,
                                  0,
                                  $settingAtrs->secureKey
                                ); 

      $save_data = array(
        "created_date" => date('Y-m-d'),
        "platform" => "wordpress",
        "shop" => $_SERVER['HTTP_HOST'] ,
        "shop_url" => $_SERVER['HTTP_HOST'] ,
        "short_key" => ERP_SPRINT_SHORT_KEY,
      );

      if($data_resp->messageType == 'Success') {
        $url = ERP_SPRINT_SAVE_COUNTER;
        $output['message']= $data_resp->message;
        $output['status'] = 'Success';
      } else {
        $url = ERP_SPRINT_ERROR_COUNTER;
        $output['message']= $data_resp->message;
        $output['status'] = 'Error';
      }

      $json_data = wp_json_encode($save_data);
       
      $response = wp_remote_post(
                  $url, 
                  array(
                    'body'    =>  $json_data,
                    'timeout' => 500000,
                    'headers' => array(
                      'Content-Type' => 'application/json' 
                    )
                  )
                );
       
      return $output;
    }
  }

  public function erp_sprint_insert_db_waybill($response, $orderID, $scode, $cusCode, $print_message = 1, $secureKey) {
    $respons = array();
    $response_data = json_decode($response);
    $array_status = array($response_data->status);
    $array_remark = array('Data received successfully');
    if($response_data->messageType == 'Error') {
      $output = 'Order #'.$orderID.' : '.$response_data->message;
    } else {
      $cretedDate = date("Y/m/d h:i:a");
      global $wpdb;
      include('config.php'); 
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
           'secure_key' => $secureKey
        ));
      $meta_id = $wpdb->insert_id;
      if($meta_id) {
        $output = 'Order #'.$orderID.': WayBill Created Successfully';
      } else {
        $output = 'Order #'.$orderID.': Not Created, Please try agin later';
      }
    }
    array_push($respons,$output);
  }
}