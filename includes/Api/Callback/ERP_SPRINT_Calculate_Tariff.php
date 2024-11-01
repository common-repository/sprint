<?php
/**
* @package demo-plugin
*/
namespace Sprint\Api\Callback;

class ERP_SPRINT_Calculate_Tariff {
  public static function erp_sprint_calculate_tariff(
                                $settingAtrs,
                                $sco,
                                $sst,
                                $sci,
                                $szi,
                                $dco,
                                $dst,
                                $dci,
                                $dzi,
                                $pse,
                                $ppa,
                                $pwe
                            ) {

    $taffic_array = array (
        'calculateTariffRequestData' => 
        array (
          'customerCode' => $settingAtrs->customerCode,
          'sourceCity' => $sci,
          'sourceState' => $sst,
          'sourcePincode' => $szi,
          'sourceCountry' => $sco,
          'destinationCity' => $dci,
          'destinationState' => $dst,
          'destinationPincode' => $dzi,
          'destinationCountry' => $dco,
          'service' => $pse,
          'packages' => $ppa,
          'actualWeight' => $pwe,
          'length' => '',
          'width' => '',
          'height' => '',
        ),
    ); 
    $data_post= wp_json_encode($taffic_array);
    $url = ERP_SPRINT_API_URL.'/webservice/v2/CalculateTariff?secureKey='.$settingAtrs->secureKey;
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
    return $response['body']; 
  }
}