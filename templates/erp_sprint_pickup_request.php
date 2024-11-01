<style>
table {
  border-collapse: collapse;
  width: 100%;
}

.table100-head {
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

.tabs {
  width:100%;
  height:auto;
  margin:0 auto;
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

button#doaction , button {
  background: cornflowerblue;
  border: 0px;
  font-size: 15px;
  padding: 10px 10px;
  border-radius: 4px;
  color: white;
  outline: none;
  cursor: pointer;
  margin: 0 0 19px 0;
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

.waybill_detail_content {
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

.waybill_detail_content label {
  width: 100% !important;
  display: block;
  font-size: 15px;
  margin-bottom: 10px;
  color: black;
}

.waybill_detail_content label strong {
  width: 180px !important;
  display: inline-block;
}

.waybill_staus_remark h4 {
  font-size: 16px;
  margin-bottom: 5px;
  margin-top: 5px;
}

.waybill_staus_remark {
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

.waybill_staus_remark li:last-child {
  border: 0px solid !important;
}

.waybill_detail_heading {
    border-bottom: 2px solid;
}

.waybill_detail_content p {
  text-align:center;
}

.form-col-50 {
  width: 49%;
  float: left;
  padding-left: 6px;
}

.form-col-50 .form_fields {
  width: 90%;
  margin: 0 auto;
  margin-bottom: 3%;
}

.form-col-50 .regular-text , .form-col-33 .regular-text {
  width: 100%;
  margin: 0 auto;
}

.form-col-50 .form_fields label , .form-col-33 label {
  margin-bottom: 5px;
}

.alignleft {
  text-align: left !important;
  float: unset;
}

.pickup_request_form_content_inner ul {
  color: black;
}
.form-col-100 {
  width:100% !important;
  margin:0 auto;
}

.form-col-33 {
  width: 32% !important;
  float: left;
  padding-left: 8px;
}

.pick-form-dates {
    margin-bottom: 20px;
}

textarea#pickupaddress {
  width: 99%;
}

.hide-section {
  display:none;
}
.tabs-list {
    list-style: none;
    margin: 0px 17px 15px 0;
    padding: 0px;
    width: 100%;
    float: left;
    background: #514f50;
    color: white;
}
.tabs-list li{
    width:150px;
    float:right;
    margin:0px;
    margin-right:2px;
    padding:10px 5px;
    text-align: center;
    outline:none;
    border-radius:3px;
}
.tabs-list li:hover{
    cursor:pointer;
}
.tabs-list li a{
    text-decoration: none;
    color:white;
    outline:none;
    font-size: 17px;  
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
.tabs-list h2 {
    margin: 0 0 11px 0px;
    padding-left: 20PX;
    padding-top: 9px;
    color:white;
}
</style> 
<?php if (empty($settingAtrs)) { ?>
  <div style="display:block !important;"   class="modal">
    <div class="modal-content">
      <div class="waybill_detail_heading padding_modal">
        <h3>Plugin Notice</h3>
        <div style="clear:both">
        </div>
      </div>
      <div class="waybill_detail_content padding_modal" style="text-align:center;color:black;">
        <p style="font-size: 20px;">Kindly configure the plugin setting.</p>
        <p><a href="admin.php?page=settings-page"><button>Config. Setting</button></a><p>
      </div>
    </div>
  </div>
<?php } else { ?><div class="wrap">
  <div class="alignleft actions bulkactions  "> 
    <h2>Pickup Request</h2>
    <button  id="sprint_createpickup">Create Pickup Request</button>
  </br>
  <div class="table100">
    <table id="table_id_assigned">
      <thead>
        <tr class="table100-head">
          <th class="column">Wp-order Number</th>
          <th class="column no-sort" data-orderable="">Order Date</th>
          <th class="column no-sort" data-orderable="">City</th>
          <th class="column no-sort" data-orderable="">Waybill Number</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach($waybillchecks as $waybillcheck) {

            $waybill_number = $waybillcheck->waybill_number; 
            $waybill_ID = $waybillcheck->ID;  
            $orderID = $waybillcheck->wp_order_ID;
            $order =  new WC_Order($orderID); 
            $order_data = $order->get_data();
            $date = $order_data['date_created'];

            $address = get_post_meta( $orderID, '_billing_address_1', true ).' , '.get_post_meta( $orderID, '_billing_address_2', true ).' , '.get_post_meta( $orderID, '_billing_phone', true );
            $state = get_post_meta( $orderID, '_billing_state', true );
            $city = get_post_meta($orderID, '_billing_city', true ); 
        ?>
        <tr>
          <td class="column2" id="<?php echo $waybill_number; ?>">
            <input class="pr_checkbox" data-address="<?php echo $settingAtrs->pickup_address; ?>" data-state="<?php echo strtoupper($settingAtrs->pickup_state); ?>" data-zipcode="<?php echo $settingAtrs->pickup_zipcode; ?>" data-city="<?php echo $settingAtrs->pickup_city; ?>" id="pr-select<?php echo $waybill_number; ?>" value="<?php echo $waybill_number; ?>" type="checkbox" >
            <?php echo $orderID; ?>
          </td>
          <td class="column">
            <?php  if ($date != '') {
              echo $date->date('d-m-Y'); } ?></td>
          <td class="column">
            <?php echo get_post_meta( $waybillcheck->wp_order_ID, '_billing_city', true ); ?>
          </td>
          <td class="column">
            <?php echo $waybillcheck->waybill_number; ?>
          </td>
        </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
  </div>

  <div id="pickuprequestmainform"  class="modal">
    <div class="modal-content">
      <div class="waybill_detail_heading padding_modal"><h3>Pickup Request Form</h3> 
        <span class="close" id="closemodalpickup">&times;</span> 
        <div style="clear:both">
        </div>
      </div>
      <div class="waybill_detail_content padding_modal" id="pickup_request_form_content_main">
        <div class="pickup_request_form_content_inner">
          <div class="pick-form-dates form-col-100">
            <div class="form_fields  form-col-33">
              <label>Pickup Date</label>
              <input type="date" id="pickupdate" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" class="regular-text code">
            </div> 
            <div class="form_fields form-col-33">
              <label>Ready Time</label>
              <input type="time" id="readytime" class="regular-text code">
            </div> 
            <div class="form_fields form-col-33">
              <label>Latest Time Available</label>
              <input type="time" id="latesttimeAvailable" class="regular-text code">
            </div>
            <div style="clear:both;"></div>
          </div>
          <div class="pick-form-dates form-col-100">
            <div class="form_fields form-col-100" style="padding-left:8px;">
              <label>Pickup Address</label>
              <textarea id="pickupaddress" class="regular-text code" rows="5" cols="50"></textarea>
            </div>
          </div>
          <div class="pick-form-dates form-col-100">
            <div class="form_fields hide-section">
              <input type="text" id="pickupcountry" class="regular-text code" value="Egypt">
            </div>
            <div class="form_fields form-col-33">
              <label>Pickup State</label>
              <input   type="text" id="pickupstate" class="regular-text code">
            </div>
            <div class="form_fields form-col-33">
              <label>Pickup City</label>
              <input  type="text" id="pickupcity" class="regular-text code">
            </div>
            <div class="form_fields form-col-33">
              <label>Pickup ZipCode</label>
              <input type="text" id="pickupzipcode" class="regular-text code">
            </div>
            <div style="clear:both;"></div>
          </div> 
          <div class="pick-form-dates form-col-100">
            <div class="form_fields form-col-50">
                <label>Waybill Numbers</label>
                <input type="text" id="Waybillnumbers" class="regular-text code" readonly>
            </div>
               
            <div class="form_fields form-col-50">
                <label>Special Instruction</label>
                <input type="text" id="specialinstruction" class="regular-text code">
            </div>
            <div style="clear:both;"></div>
          </div>
          <div class="pickup-right-form form-col-50 hide-section">
            <div class="form_fields">
              <input type="text" id="clientcode" value="<?php print_r($settingAtrs->customerCode); ?>" class="regular-text code">
            </div>

            <div class="form_fields">
              <label>Pickup Type</label>
              <select id="pickuptype" class="regular-text code">
                <option value="null">Select</option>
                <option value="Reverse Logistics">Reverse Logistics</option>
                <option value="Standard Logistics">Standard Logistics</option>
              </select>
            </div>
          </div>
          <div style="clear:both;"></div>
        </div>
      </div>
      <div class="waybill_detail_footer padding_modal">
        <button id="sprint_creatingpickuprequesting" 
          class="button">Submit Pickup Request</button> 
        <button id="pickuprequestingclose" class="button" style="display:none">Close</button></div>
    </div>
  </div></div>
<?php
  }
?> 
<script>
jQuery(document).ready( function () {
  jQuery('#table_id , #table_id_assigned').DataTable({
    "lengthChange": true,
    'aaSorting': [[0, 'desc']]
  });

  //jQuery("#wpfooter").hide();
});
</script>


