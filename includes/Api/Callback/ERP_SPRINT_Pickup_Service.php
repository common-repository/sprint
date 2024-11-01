<?php
/**
* @package demo-plugin
*/
namespace Sprint\Api\Callback;

class ERP_SPRINT_Pickup_Service {
  public function erp_sprint_create_pickup(
                    $rt,
                    $lat,
                    $pco,
                    $ps,
                    $pci,
                    $pa,
                    $pz,
                    $pd,
                    $cc,
                    $wn,
                    $pt,
                    $spe) {
    global $wpdb;
    $settingAtrs = $wpdb->get_row( "SELECT * FROM wp_logixgridsetting WHERE ID = '".ERP_SPRINT_ID."'");
    $data_post = 'readyTime='.$rt.'&latestTimeAvailable='.$lat.'&pickupCity='.$pci.'&pickupAddress='.$pa.'&pickupCountry='.$pco.'&pickupState='.$ps.'&pickupPincode='.$pz.'&pickupDate='.$pd.'&clientCode='.$cc.'&wayBillNumbers='.$wn.'&specialInstruction='.$spe.'&pickupType='.$pt;

    $data = array(
              'readyTime' => $rt,
              'latestTimeAvailable' => $lat,
              'pickupCity' => $pci,
              'pickupAddress' => $pa,
              'pickupCountry' => $pco,
              'pickupState' => $ps,
              'pickupPincode' => $pp,
              'pickupDate' => $pd,
              'clientCode' => $cc,
              'wayBillNumbers'=> $wn,
              'specialInstruction' =>$spe,
              'pickupType' => $pt,
            ); 
    $url = ERP_SPRINT_API_URL."/webservice/v2/CreatePickupRequest?secureKey=".$settingAtrs->secureKey;
   

    $form_data = "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"readyTime\"\r\n\r\n$rt\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"latestTimeAvailable\"\r\n\r\n$lat\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"pickupCity\"\r\n\r\n$pci\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"pickupAddress\"\r\n\r\n$pa\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"pickupCountry\"\r\n\r\n$pco\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"pickupState\"\r\n\r\n$ps\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"pickupPincode\"\r\n\r\n$pp\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"pickupDate\"\r\n\r\n$pd\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"clientCode\"\r\n\r\n$cc\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"wayBillNumbers\"\r\n\r\n$wn\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"specialInstruction\"\r\n\r\n$spe\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"pickupType\"\r\n\r\n$pt\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--";
    $result = wp_remote_post(
                $url, 
                array(
                  'method' => 'POST',
                  'timeout' => 500000,
                  'headers' => array(
                    'Content-Type' => 'multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW'
                  ),
                  'body' => $form_data
                )
              );
    return $result['body'];
  } 
  public function erp_sprint_update_pickup_number_db($billnumber,$resp) {
    global $wpdb;
    $settingAtrs = $wpdb->get_row("SELECT * FROM wp_logixgridsetting WHERE ID = '".ERP_SPRINT_ID."'");
    $respons = array();
    $pickupres = json_decode($resp, true);
    if($pickupres['messageType'] == 'Error') {
      $output = 'Waybill Number #'.$billnumber.' : '.$pickupres['message'];
    } else {
      $pickupNumber = explode(".",$pickupres['message']);
      include('config.php');
      $updateQuery = $wpdb->update( 
                      'wp_logixgridwaybillSecureKey', 
                      array( 
                        'pickup_number' => $pickupNumber[1]
                      ), 
                      array( 
                        'waybill_number' => $billnumber, 
                        'secure_key' =>  $settingAtrs->secureKey
                      )
                    );
      if($updateQuery === false) {
        $output = 'Waybill Number #'.$billnumber.': Not Created, Please try agin later';
      } else {
        $output = 'Waybill Number #'.$billnumber.': '. $pickupres['message'];
      }
    }
    array_push($respons,$output);
    $html = '';
    foreach($respons as $resp) {
      $html .= '<ul><li>'.$resp.'</li></ul>';
    }
    return $html;
  }
}