<?php
/**
* @package sprint
*/
/*
Plugin Name: Sprint
Description: Boost your deliveries results with Sprint
Enjoy working with a great logistics partner who is looking after your growth. Sprint aims to empower the e-commerce entrepreneurs to grow their businesses through providing reliable, affordable and technological logistics solutions that fit their different business models. Aiming to simplify the e-commerce business cycle for both merchants and customers, Sprint provides a wide range of last mile delivery solutions and services such as Door-to-Door Delivery, Warehousing and Fulfillment, Pick Up Stations, Pick, Choose and Return Services; can all be customized to cater to the merchant’s specific business model.
Plugin URI: http://help.logixerp.com 
Since : 1.0.0
Author: logixgrid
Author URI: https://logixgrid.com/
Package: Sprint
Version: 3.6
Text Domain: Sprint-for-wooCommerce
Requires at least: 1.0
Requires PHP: 7.0 
License: GPLv2
*/
if (!defined('ABSPATH')) { die('You can\'t access this file.'); }
if (!defined('WPINC')) { die('You can\'t access this file.'); }
if (!function_exists('add_action')) {
  die('You can\'t access this file.');
}
if (file_exists(dirname(__FILE__).'/vendor/autoload.php')) {
  require_once dirname(__FILE__).'/vendor/autoload.php';
}
define('ERP_SPRINT_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('ERP_SPRINT_PLUGIN_URL', plugin_dir_url(__FILE__));
define('ERP_SPRINT_PLUGIN_NAME', plugin_basename(__FILE__)); 
define('ERP_SPRINT_ID', '5');
define('ERP_SPRINT_API_URL', 'https://api.logixplatform.com');
define('ERP_SPRINT_SHORT_KEY', 'SPRINT');
define('ERP_SPRINT_SAVE_COUNTER', 'https://console-dot-logixecomapps.uc.r.appspot.com/save_counter.php');
define('ERP_SPRINT_ERROR_COUNTER', 'https://console-dot-logixecomapps.uc.r.appspot.com/save_errors.php');

if (!function_exists('erp_sprint_update_status')) {
  function erp_sprint_update_status(WP_REST_Request $request) {
    $parameters = $request->get_json_params();
    $status_list = array(
      'atorigin'        => __('wc-at-origin'),
      'shipmentreceived'     => __('wc-shipment-received'), 
      'atwarehouse'           => __('wc-at-warehouse'),      
      'intransit'           => __('wc-in-transit'),
      'outfordelivery'        => __('wc-out-for-delivery'),     
      'delivered'     => __('wc-delivered'), 
      'rto'           => __('wc-rto'),      
      'rto-delivered'           => __('wc-rto-delivered'), 
      'undelivered'        => __('wc-undelivered'),     
      'refund'     => __('wc-refund'), 
      'refundmade'           => __('wc-refund-made'),      
      're-schedule'           => __('wc-re-schedule'),
      'schedulefordispatch'        => __('wc-schedule-for-dispatch'),     
      'deliveryschedule'     => __('wc-delivery-schedule'), 
      'partial-delivered'           => __('wc-partial-delivered') 
    );
    global $wpdb;
    $response = array();
    $parameters = $request->get_json_params();
    $updatedDate = date("Y/m/d h:i:a");
    $auth = $parameters['auth'];
    $i =0;
    if($auth == 'logixerp')
      {
        $waybilldetails = $parameters['waybilldetail'];
        foreach($waybilldetails as $waybilldetail)
        { 
          $i++;
          if (empty($waybilldetail['waybillnumber']) || empty($waybilldetail['status'])) {
            $error['message'] = 'Index #'.$i.' waybillnumber or status filed empty';
            return $error;
          } else {
            $waybillnumber = $waybilldetail['waybillnumber'];
            $status = $waybilldetail['status'];
            $statuslower = strtolower($status);
            echo $strstatus = str_replace(' ', '', $statuslower);
            echo $wp_status = $status_list[$strstatus];
            $remark = $waybilldetail['remark'];
            if($remark) { $remark_status = $remark; }
            else { $remark_status = $status; }
            $settingAtrs =  $wpdb->get_row("SELECT * FROM wp_logixgridsetting WHERE ID = '".ERP_SPRINT_ID."'");
            $waybilltable = "SELECT * FROM wp_logixgridwaybillSecureKey WHERE waybill_number ='$waybillnumber' and secure_key = '". $settingAtrs->secureKey."' ";
            $waybillcheck = $wpdb->get_row($waybilltable);
            $waybilltable_status = unserialize($waybillcheck->waybill_status);
            array_push($waybilltable_status,$status);
            $waybilltable_remark = unserialize($waybillcheck->waybill_remark);
            array_push($waybilltable_remark,$remark_status);
            $main_status= serialize($waybilltable_status);
            $main_remark= serialize($waybilltable_remark);
            $order = new WC_Order($waybillcheck->wp_order_ID);
            $order->update_status($wp_status);
            include('../admin/partials/config.php');
            $updateQuery = $wpdb->update( 'wp_logixgridwaybillSecureKey', 
                    array(
                      'waybill_status' => $main_status,
                      'waybill_remark' => $main_remark, 
                      'waybill_updated' =>$updatedDate
                    ), 
                    array('waybill_number' => $waybillnumber, 'secure_key' => $settingAtrs->secureKey  ),
                    array('%s','%s','%s'), 
                    array( '%s','%s' ) 
                  );
                        
            if( $updateQuery === false)
            {
              
              $error[$i] = 'waybillnumber #'.$waybilldetail['waybillnumber'].' status updated failed';
              //return $error;
            }
            else
            {
              $error[$i] = 'waybillnumber #'.$waybilldetail['waybillnumber'].' status updated successfully';
              //return $error;
            }
          }
        }
         
      }
      else
      {
        $error['message'] = 'Authentication Failed';
        $error['status'] = '401';
      }
      array_push($response ,$error);
    return array($response );
  }
}
add_action('rest_api_init', function() {   
    register_rest_route('wp/v2/rae', '/post/setStatus', [
    'methods' => 'POST',
    'callback' => 'erp_sprint_update_status',
  ]);
});

if (class_exists('Sprint\\ERP_SPRINT_Init')) {
  Sprint\ERP_SPRINT_Init::erp_sprint_register_services();
}

if (!function_exists('erp_sprint_activate_pluging')) {
  function erp_sprint_activate_pluging() {
    Sprint\Base\ERP_SPRINT_Activate_Plugin::erp_sprint_activate();
    Sprint\Base\ERP_SPRINT_Activate_Plugin::erp_sprint_logix_setting_table();
    Sprint\Base\ERP_SPRINT_Activate_Plugin::erp_sprint_waybill_table(); 
    Sprint\Base\ERP_SPRINT_Activate_Plugin::erp_sprint_waybill_table_alert_table();
    Sprint\Base\ERP_SPRINT_Activate_Plugin::erp_sprint_vendor_table();
  }
  register_activation_hook(__FILE__, 'erp_sprint_activate_pluging');
}

if (!function_exists('erp_sprint_deactive_plugin')) {
  function erp_sprint_deactive_plugin() {
    Sprint\Base\ERP_SPRINT_Deactive_Plugin::erp_sprint_deactivate();
  }
  register_deactivation_hook( __FILE__, 'erp_sprint_deactive_plugin');
}


add_filter( 'manage_edit-shop_order_columns', 'waybill_column_function' );
function waybill_column_function($columns){
    $new_columns = (is_array($columns)) ? $columns : array();

    //edit this for you column(s)
    $new_columns['sprint_waybill'] = 'Waybill Number';
    $new_columns['waybill_status'] = 'Waybill Status';
    $new_columns['waybill_print'] = 'Waybill Print';
    return $new_columns;
}

add_filter( "manage_edit-shop_order_sortable_columns", 'waybill_column_sort_function' );
function waybill_column_sort_function( $columns ) {
    $custom = array(
        'sprint_waybill'    => 'sprint_waybill',
        'waybill_status'    => 'waybill_status',
    );
    return wp_parse_args( $custom, $columns );
}

add_filter( "bulk_actions-edit-shop_order", 'waybill_bulk_action_function' );
function waybill_bulk_action_function($actions){
    $new_actions = (is_array($actions)) ? $actions : array();

    //edit this for you actions(s)
    $new_actions['create_waybill'] = 'Create Waybill';
    return $new_actions;
}

add_filter( 'handle_bulk_actions-edit-shop_order', 'waybill_handle_bulk_action_function', 10, 3 ); 
function waybill_handle_bulk_action_function( $redirect_to, $action, $post_ids ){
$changed = 0;
$report_action = "";
	if ( 'create_waybill' === $action ){
    	global $wpdb;
   		$logixgrid_setting = $wpdb->get_row("SELECT * FROM wp_logixgridsetting WHERE ID = '".ERP_SPRINT_ID."'");
    	if($logixgrid_setting){
       		$newArr = array();
       		foreach ( $post_ids as $id ) {
           		$waybill_list = $wpdb->get_results( "SELECT * FROM wp_logixgridwaybillSecureKey where secure_key = '".$logixgrid_setting->secureKey."' and is_parent  != '2' AND wp_order_ID = '".$id."'");
				//if(count($waybill_list) == 0){
            		$newArr[] = $id;
        //   		}
			}
                	
			if(count($newArr) > 0)
			{
               	$changed = count($newArr);
               	$report_action = 'create_waybill';
                    
            	$idList = implode(',',$newArr);
            	$_REQUEST['orderdetails'][] = $idList;
				
				
				$services = \Sprint\Api\Callback\ERP_SPRINT_Service::erp_sprint_get_service($logixgrid_setting);
				
				$serviceCode = $services[0]["code"];
				foreach($services as $service) {
					if(isset($logixgrid_setting->serviceCode) && $logixgrid_setting->serviceCode == $service["code"]) {
						$serviceCode = $service["code"];
						break;
					}
				}
				$_REQUEST['orderdetails'][] = $serviceCode;
				
				$_REQUEST['orderdetails'][] = $logixgrid_setting->customerCode;
            	do_action('wp_ajax_erp_sprint_create_orders');
            }
        }
    }
        
	
		$redirect_to = add_query_arg(
			array(
				'post_type'   => "shop_order",
				'bulk_action' => $report_action,
				'changed'     => $changed,
				'ids'         => join( ',', $post_ids ),
			),
			$redirect_to
		);
	
    echo $redirect_to;
	return esc_url_raw( $redirect_to );
}

add_action( 'admin_notices', 'waybill_admin_notices');
function waybill_admin_notices(){
	$number         = isset( $_REQUEST['changed'] ) ? absint( $_REQUEST['changed'] ) : 0; // WPCS: input var ok, CSRF ok.
	$bulk_action    = wc_clean( wp_unslash( $_REQUEST['bulk_action'] ) ); // WPCS: input var ok, CSRF ok.
    if ( 'create_waybill' === $bulk_action ){
        $message = sprintf( _n( 'Created waybill for %d order.', 'Created waybill for %d orders.', $number, 'woocommerce' ), number_format_i18n( $number ) );
		echo '<div class="updated"><p>' . esc_html( $message ) . '</p></div>';
    }
}

add_action( 'manage_shop_order_posts_custom_column', 'waybill_value_function', 2 );
function waybill_value_function($column){
	global $wpdb;
    global $post;
    $postID = $post->ID;
    $logixgrid_setting = $wpdb->get_row("SELECT * FROM wp_logixgridsetting WHERE ID = '".ERP_SPRINT_ID."'");
    if($logixgrid_setting)
	{
		$waybill_list = $wpdb->get_results( "SELECT * FROM wp_logixgridwaybillSecureKey where secure_key = '".$logixgrid_setting->secureKey."' and is_parent  != '2' AND wp_order_ID = '".$postID."'");
    	if(count($waybill_list) > 0)
		{
    		if ( $column == 'sprint_waybill' ) {
				echo $waybill_list[0]->waybill_number;
	        }
			
            else if ( $column == 'waybill_status' ) {
				
            	$waybill_status = $waybill_list[0]->waybill_status;
                $get_status = unserialize($waybill_status);
                $status = end($get_status);
				echo $status;
	        }
            else if ( $column == 'waybill_print' ) {
                echo "<a target='_blank' href=".$waybill_list[0]->waybill_file_name.">Waybill Print</a>";
	        }
         }
    }
}