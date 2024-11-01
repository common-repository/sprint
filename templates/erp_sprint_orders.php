<style>
table {
  border-collapse: collapse;
  width: 100%;
}
.table100-head
{
  background:white;
}
td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}
tr:nth-child(even) {
  background-color: #dddddd;
}
.tabs{
    width:100%;
    height:auto;
    margin:0 auto;
}
/* tab list item */
.tabs .tabs-list {
    list-style: none;
    margin: 0px;
    padding: 0px;
    width: 100%;
    float: left;
    background: #514f50;
    color: white;
}
.tabs .tabs-list li{
    width:150px;
    float:right;
    margin:0px;
    margin-right:2px;
    padding:10px 5px;
    text-align: center;
    outline:none;
    border-radius:3px;
}
.tabs .tabs-list li:hover{
    cursor:pointer;
}
.tabs .tabs-list li a{
    text-decoration: none;
    color:white;
    outline:none;
    font-size: 17px;  
}
/* Tab content section */
.tabs .tab{
    display:none;
    width:100%;
    border-radius:3px;
    padding-top:10px; 
    color:darkslategray;
    clear:both;
}
.tabs .tab h3{
    border-bottom:3px solid cornflowerblue;
    letter-spacing:1px;
    font-weight:normal;
    padding:5px;
}
.tabs .tab p{
    line-height:20px;
    letter-spacing: 1px;
}
/* When active state */
.active{
    display:block !important;
}
.tabs .tabs-list li.active{
    
}
.active a{
    color:cornflowerblue !important;
}
.float-right {
    float: right;
}
.no_tab_label
{
  width: 300px !important;
  float: left !important;
  text-align: left !important;
  cursor: unset;
}
.tabs-list h2 {
    margin: 0px;
    padding-left: 20PX;
    padding-top: 9px;
    color:white;
}
.pagination {
  display: inline-block;
}
.dataTables_paginate  .paginate_button {
  color: black !important;
  float: left;
  padding: 8px 16px !important;
  text-decoration: none !important;
  transition: background-color .3s !important;
  border: 0px solid #ddd !important;
}
#table_id_paginate a.current , #table_id_assigned_paginate a.current  {
  background: #514f50 !important;
  color: white !important;
  border: 0px solid #4CAF50 !important;
}
.dataTables_wrapper #table_id_paginate .paginate_button.current, 
.dataTables_wrapper #table_id_paginate .paginate_button.current:hover,
.dataTables_wrapper #table_id_assigned_paginate .paginate_button.current, 
.dataTables_wrapper #table_id_assigned_paginate .paginate_button.current:hover
{
  color: white !important;
}
.dataTable thead tr {
    background: #514f50 !important;
    color: white;
}
button#sprint_doaction , button {
    background: cornflowerblue;
    border: 0px;
    font-size: 15px;
    padding: 10px 10px;
    border-radius: 4px;
    color: white;
    outline: none;
    cursor: pointer;
}
.dataTables_filter {
    display: block !important;
}
.dataTables_paginate  .paginate_button:hover:not(.current) {background-color: #ddd !important;}
/* media query */
@media screen and (max-width:360px){
    .tabs{
        margin:0;
        width:96%;
    }
    .tabs .tabs-list li{
        width:80px;
    }
}
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 123333; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}
/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  border: 1px solid #888;
  width: 700px;
}
.sprint_waybill_detail_content {
    color: white;
}
/* The Close Button */
.close {
  color: black;
  float: right;
  font-size: 28px;
  font-weight: bold;
}
.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
.waybill_detail_heading h3 {
    width: 50%;
    float: left;
    margin: 0;
}
.padding_modal
{
  padding: 20px;
  padding-top: 15px;
}
.sprint_waybill_detail_content label {
    width: 100% !important;
    display: block;
    font-size: 15px;
    margin-bottom: 10px;
    color: black;
}
.sprint_waybill_detail_content label strong {
    width: 180px !important;
    display: inline-block;
}
.waybill_staus_remark h4 {
    font-size: 16px;
    margin-bottom: 5px;
    margin-top: 5px;
}
.waybill_staus_remark
{
  color: black;
}
.half_div {
    width: 49%;
    float: left;
}
.waybill_staus_remark ul {
    margin-top: 0px;
}
.waybill_staus_remark li {
    border-bottom: 1px solid;
    padding-left: 5px;
}
.waybill_staus_remark ul {
    margin-top: 0px;
    border: 1px solid;
}
.waybill_staus_remark li:last-child
{
  border: 0px solid !important;
}
.waybill_detail_heading {
    border-bottom: 2px solid;
}
.sprint_waybill_detail_content p
{
  text-align:center;
}
ul#sprint_service_code_add li span {
    display: inline !important;
    padding-left: 21px;
}
ul#sprint_service_code_add .regular-text {
    width: 46%;
    margin: 0px !important;
    height: 30px !important;
    vertical-align: unset !important;
}
ul#sprint_service_code_add {
    font-size: 15px;
}
#sprint_service_code_add {
    color: black;
}
.order_id_div_pop_up {
    padding-left: 21px;
    margin-bottom: 12px;
}
.order_id_div_pop_up label {
    width: 46%;
    display: inline;
    margin-right: 21px;
}
.order_id_div_pop_up input {
    width: 76% !important;
}
</style>
<div class="wrap">
  <?php foreach($vendor_list as $value) {?>
    <?php print_r ($value->code); ?>
  <?php } ?>

<?php  if (empty($settingAtrs)) { ?>
<div style="display:block !important;"   class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="waybill_detail_heading padding_modal"><h3>Plugin Notice</h3><div style="clear:both"></div></div>
    <div class="sprint_waybill_detail_content padding_modal" style="text-align:center;color:black;">
        <p style="font-size: 20px;">Kindly configure the plugin setting.</p>
        <p><a href="admin.php?page=erp-sprint-setting"><button >Config. Setting</button></a><p>
    </div>
  </div>
</div>
<?php } else {   ?>
  <h2></h2>
  <div class="tabs">
    <ul class="tabs-list">
      <h2 class="no_tab_label">Logix</h2>
      <li class="float-right"> <a href="#tab1">Assigned Order</a></li>
      <li class="float-right active"> <a href="#tab2">New Order</a></li> 
    </ul> 
    <div id="tab1" class="tab">
      <div class="table100">
        <table id="table_id_assigned">
          <thead>
            <tr class="table100-head">
              <th class="column2">Order Number</th>
              <th class="column2 no-sort" data-orderable="">
              Waybill Number
              </th>
              <th class="column2 no-sort">COD Amount</th>
              <th class="">Receiver</th> 
              <th class="column1">Consignee State</th>
              <th class="column1">Consignee City</th>
              <th class="column1">Consignee Phone</th>
              <th class="column1">Consignor Code</th>
              <th class="column3"> Waybill Date</th>
              <th class="column4">Last Updated Status</th>
              <th class="column4">Last Updated Remarks</th>
              <th class="column4">Service</th>
              <th class="column4">Pickup Number</th>
              <th class="column3">Waybill Label</th>
              <th class="column4">Tracking</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach($waybillchecks as $waybillcheck) {
                $waybill_status = $waybillcheck->waybill_status;
                $get_status = unserialize($waybill_status);
                $status = end($get_status);
                $waybill_remarks = $waybillcheck->waybill_remark;
                $get_remarks = unserialize($waybill_remarks);
                $remarks = end($get_remarks);
                $pickup = $waybillcheck->pickup_number;
                if($pickup) { $pickupnumber = $pickup; } else { $pickupnumber = 'Pickup request not generated'; }
                ?>
                <tr>
                  <td class="column2"><?php echo $waybillcheck->wp_order_ID; ?></td>
                  <td class="column2"> <?php
                    if ($waybillcheck->is_parent == "1"  ) { ?> 
                      <a href="#" onclick="parent_waybill('<?php echo $waybillcheck->waybill_number; ?>')">
                        <?php echo $waybillcheck->waybill_number; ?> 
                      </a> 
                    <?php } else { echo $waybillcheck->waybill_number; } ?> 
                  </td>
                  <td><?php echo get_post_meta( $waybillcheck->wp_order_ID, '_order_total', true ); ?></td>
                  <td><?php echo get_post_meta( $waybillcheck->wp_order_ID, '_billing_first_name', true ); ?></td>
                  <td><?php echo get_post_meta( $waybillcheck->wp_order_ID, '_billing_state', true ); ?></td>
                  <td><?php echo get_post_meta( $waybillcheck->wp_order_ID, '_billing_city', true ); ?></td>
                  <td><?php echo get_post_meta( $waybillcheck->wp_order_ID, '_billing_phone', true ); ?></td>
                  <td> <?php $service_customer = explode('~',  $waybillcheck->service_name); if (isset($service_customer[1])) { print_r($service_customer[1]); } else { print_r($settingAtrs->customerCode); } ?> </td>
                  <td class="column3"><?php echo $waybillcheck->waybill_created; ?></td>
                  <td class="column4"><?php echo $status; ?></td>
                  <td class="column4"><?php echo $remarks; ?></td>
                  <td class="column2"><?php echo $service_customer[0]; ?></td>
                  <td class="column2"><?php echo $pickupnumber;  ?></td>
                  <td class="column3"><a target='_blank' href="<?php echo $waybillcheck->waybill_file_name; ?>">Waybill Print</a></td>
                  <td class="column4"><a id="<?php echo $waybillcheck->ID; ?>" class="sprint_view_history" href="javascript:void(0)">View Tracking</a></td>
                </tr>
                <?php
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div id="tab2" class="tab active">
      <div class="tablenav top">
        <div class="alignleft actions bulkactions">
            <button  id="sprint_doaction" class="" >Create Waybill</button>
        </div>
      </div>
      <br>
      <div class="table100">
        <table id="table_id">
          <thead>
            <tr class="table100-head">
              <th class="column1">Wp-order Number</th>
              <th class="">Customer Name</th> 
              <th class="column1">COD Amount</th>
              <th class="column1">Consignee State</th>
              <th class="column1">Consignee City</th>
              <th class="column1">Consignee Phone</th>
              <th class="column1">Consignor Code</th>
              <th class="column3">Order Date</th>
              <th class="column4">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              foreach ( $orderlists as $orderlist )
              { 
                $waybillcheck = $wpdb->get_row( "SELECT * FROM wp_logixgridwaybillSecureKey WHERE wp_order_ID = $orderlist->ID"); 
                //print_r($waybillcheck);
                if(empty($waybillcheck))
                {
                  $status = $orderlist->post_status;
                
            ?>
              <tr>
                <td class="column1">
                  <input class="sprint_order_checkbox" id="cb-select<?php echo $orderlist->ID; ?>" value="<?php echo $orderlist->ID; ?>" type="checkbox" >
                  <?php echo $orderlist->ID; ?>
                </td>
                <td><?php echo get_post_meta( $orderlist->ID, '_billing_first_name', true ); ?></td>
                <td><?php echo get_post_meta( $orderlist->ID, '_order_total', true ); ?></td>
                <td><?php echo get_post_meta( $orderlist->ID, '_billing_state', true ); ?></td>
                <td><?php echo get_post_meta( $orderlist->ID, '_billing_city', true ); ?></td>
                <td><?php echo get_post_meta( $orderlist->ID, '_billing_phone', true ); ?></td>
                <td><?php print_r($settingAtrs->customerCode); ?></td>
                <td class="column3"><?php echo $orderlist->post_modified; ?></td>
                <td class="column4"><?php echo $status; ?></td>
              </tr>
            <?php } 
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  
  <div style="display:none !important;" id="now"   class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="waybill_detail_heading padding_modal">
      <h3>Child Waybill</h3>
      <span class="close" id="closemodalload">&times;</span> <div style="clear:both"></div> 
    </div>
    <div class="sprint_waybill_detail_content padding_modal" 
      style="color:black;min-height: 158px;">

    </div>
  </div>
</div>

  <div id="sprint_myModal" class="modal">
  <!-- Modal content -->
    <div class="modal-content">
      <div class="waybill_detail_heading padding_modal"><h3>Tracking Details</h3> <span class="close" id="sprint_closemodal">&times;</span> <div style="clear:both"></div></div>
      <div class="sprint_waybill_detail_content padding_modal" id="sprint_waybill_detail_content_main">
          <div class="sprint_waybill_detail_content_inner">
          </div>
          <p><img src="<?php echo ERP_SPRINT_PLUGIN_URL; ?>assets/image/loading.gif">
          </p>
      </div>
    </div>
  </div>

  <div class="modal" id="sprint_loading_div_img">
    <div class="modal-content">  
      <div class="waybill_detail_heading padding_modal"><h3>Waybills</h3> <span class="close" id="sprint_closemodalload">&times;</span> <div style="clear:both"></div></div> 
      <div style=" display:none" id="single_waybill"> <input type="radio" class="type_waybill" name="waybilltype" value="single" checked="checked" style="">   
      
    </div>
    
    <div class="sprint_waybill_detail_content padding_modal">
      <form id="from_data">
        <ul id="sprint_service_code_add">
          <li id="previous">
              <div class="order_id_div_pop_up">
                <label>Wp-order Number</label> 
                <input id="sprint_order_numbers_20" 
                  placeholder="Order Number" 
                  class="regular-text code" 
                  type="text" readonly>
              </div>
              <br>
              <select id="sprint_service_20" class="regular-text code service_name">
                <option value="null">Select Service</option>
                <?php 
                  foreach($services as $service) {
                    $name = $service["name"];
                    $code = $service["code"];
                    if($settingAtrs->serviceCode == $code) {
                      echo '<option value="'.$code.'" selected>'.$name.'('.$code.')</option>';  
                    } else { 
                      echo '<option value="'.$code.'">'.$name.'('.$code.')</option>'; 
                    }
                  }
                  ?>
              </select>
              </span>
              <span><input id="sprint_customercode_20" placeholder="Consigner Address" value="<?php print_r($settingAtrs->customerCode); ?>" class="regular-text code customer_code" type="text"></span>
          </li>
          <li id="next_display" style="display: none">
            <div style="background-color: lightblue; width: 100%; height: 110px; overflow: scroll;">
              <table>
                <thead>
                  <tr>
                    <th> Vendor Code </th>
                    <th> Package </th>
                    <th> </th>
                  </tr>
                </thead>
                <tbody id="tbody_data"> 
                  <tr id="row_1">
                    <td> <select    class="vendor_code"> </select>  </td>
                    <td> <input type="text"  class="package"> </td>
                    <td> <a href="javascript:void(0);" onclick="deleterow('row_1')"> Delete</a> </td>
                  </tr>
                </tbody> 
              </table>
              <a href="javascript:void(0);" style="float: right;" id="add_more">Add More</a>
            </div>
          </li>
        </ul>
      </form>
      <div class="orderdetail">
        <button id="next" class="multiple" style="display : none">Next</button>
        <button id="back" class="multiple" style="display : none">back</button>
        <button id="sprint_gets_code_waybill" class="single">Get Waybill Number</button>
        <button id="sprint_gets_code_waybillclose" style="display : none;">Close</button>
      </div>
    </div>  
  </div>  
</div>
<?php } ?></div> 

<script type="text/javascript">
  var vendor = '';
  vendor += '<option value=""> Select</option>';
  <?php foreach($vendor_list as $value) {?>
    vendor += '<option value="<?php echo $value->code;?>">   <?php echo $value->code; ?> </option>';
  <?php } ?>
  jQuery(".vendor_code").html(vendor);
  function deleterow(id) {
    jQuery("#row_"+id).remove();
  } 

  function getRandomIntInclusive(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min;
  }

  jQuery(document).ready(function() {
    jQuery(".type_waybill").click(function(){
      var value =  jQuery(this).val();
      if (value == 'single') {
        jQuery("#sprint_gets_code_waybill").show();
        jQuery("#next").hide();
      } else {
        jQuery("#sprint_gets_code_waybill").hide();
        jQuery("#next").show();
      }
    });
    
    jQuery("#add_more").click(function() {
      var ran = getRandomIntInclusive(1000,9999999);

      var data = '<tr id="row_'+ran+'"> <td> <select class="vendor_code"> "'+vendor+'" </select> </td> <td> <input type="text" class="package"> </td> <td> <a href = "javascript:void(0);" onclick = "deleterow(\'row_'+ran+'\')"> Delete </a> </td> </tr>';
      jQuery("#tbody_data").append(data);
    });

    jQuery("#next").click(function() {
      jQuery("#next").hide();
      jQuery("#sprint_gets_code_waybill, #back").show();
      jQuery("#next_display").show();
      jQuery("#previous").hide(); 
    });

    jQuery("#back").click(function() {
      jQuery("#previous, #next").show();
      jQuery("#sprint_gets_code_waybill, #back, #next_display").hide();
    });

    jQuery('#table_id, #table_id_assigned').DataTable({
      "lengthChange" : true,
      "aaSorting" : [[0, 'desc']]
    });

    jQuery(".tabs-list li a").click(function(e){
      e.preventDefault();
    });

    jQuery(".tabs-list li").click(function(){
      var tabid = jQuery(this).find("a").attr("href");
      jQuery(".tabs-list li,.tabs div.tab").removeClass("active");
      jQuery(".tab").hide();
      jQuery(tabid).show();
      jQuery(this).addClass("active");
    });

  });

  jQuery(document).ready(function(){
      var data = {
          'action': 'my_action3',
          'whatever': 1234
      };
      jQuery.ajax({
          url: ajaxurl,
          data: data,
          success: function(data) {
              //alert('orderpage');
          },
          error: function(xhr, error){
            console.debug(error);
          }
      }); 
  });
</script>