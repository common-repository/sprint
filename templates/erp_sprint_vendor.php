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
.padding_modal{
  padding: 20px;
  padding-top: 15px;
} 

.loading_img {
  text-align: center;
}
</style>
<div class="wrap" id ="table">

  <div id="tab1" class="tab">
    <h2> Vendor</h2>
      <div class="alignleft actions bulkactions">
            <button   class="create_vendor" style="margin:0 0 10px 0px">Create Vendor</button>
        </div>
      <div class="table100">
        <table id="table_id_assigned">
          <thead>
            <tr class="table100-head">
              <th class="column2 no-sort" data-orderable="">Code</th>
              <th class="column2 no-sort">Name</th>
              <th class="">Address</th> 
              <th class="column1">Country</th>
              <th class="column1">State</th>
              <th class="column1">City</th>
              <th class="column1">Pincode</th>
              <th class="column3">Phone Number</th>
              
            </tr>
          </thead>
          <tbody>
            <?php foreach($vendor_list as $key => $value) { ?>
            <tr> 
              <th> <?php echo $value->code; ?> </th>
              <th> <?php echo $value->name; ?> </th>
              <th> <?php echo $value->address; ?> </th>
              <th> <?php echo $value->country; ?> </th>
              <th> <?php echo $value->state; ?> </th>
              <th> <?php echo $value->city; ?> </th>
              <th> <?php echo $value->pincode; ?> </th>
              <th> <?php echo $value->phone_number; ?> </th>
           
            </tr>
          <?php } ?>
          </tbody>
        </table>
    </div>
  </div>
</div>

<div class="wrap create_waybill_from"  style="display:none">
  <h2>Add Vendor
  </h2>
  <form action="<?php echo esc_url(admin_url( 'admin-post.php' ) ); ?>" method="POST" >
    <table class="form-table">  
      <tbody>
      <tr>
        <th><label for="plugin_name">Vendor Code</label></th>
        <td> <input type="text" name="code" id="code" type="text" class="regular-text code" required></td>
      </tr>
      <tr>
        <th> <label for="customer_code">Name</label> </th>
        <td> 
          <input type="text" name="name" id="name" type="text" class="regular-text code" required>
        </td>
      </tr>

      <tr>
        <th> <label for="customer_code">Phone Number</label> </th>
        <td> 
          <input type="text" name="phone_number" id="phone_number" type="text" class="regular-text code" required>
        </td>
      </tr>
      <tr>
        <th>
          <label for="customer_code"> address </label>
        </th>
        <td> 
          <input type="text" name="address" id="address" type="text" class="regular-text code">
        </td>
      </tr>
      <tr>
        <th><label for="service_code">Country</label></th>
        <td>
          <select class="regular-text code sprint_get_state_from_country" name="country" id="source_country" data-state="source_state" >
            <option value="null">Select</option>
            <?php foreach($country as $key=>$value) {   ?>
                <option value="<?php echo $key;?>">
                  <?php echo $value; ?>
                </option>
            <?php   
            } ?>
<!-- 
          <input type="text" name="count_ry" id="c_ountry" type="text" class="regular-text code"> -->
        </td>
      </tr>
      <tr>
        <th>
          <label for="service_code">State</label>
        </th>
        <td>
           <select class="regular-text code sprint_getcity" name="state"  messg='Source State'  city-id="source_city" country-id="source_country" id="source_state" >
            <option value="null">Select</option> 
          </select>
          <!-- <input type="text" name="stat_e" id="st_ate" type="text" class="regular-text code"> -->
        </td>
      </tr>
      <tr>
        <th>
          <label for="pickup_address"> City </label>
        </th>
        <td>
          <select class="regular-text code" id="source_city" name="city">  <option value="null">Select</option>  </select> 
          <!-- <input type="text" id="city" name="ci_ty" type="text" class="regular-text code"> -->
        </td> 
      </tr>
      <tr>
        <th> <label for="pickup_city"> Pincode </label> </th>
        <td>
          <input type="text" id="pincode" name="pincode" type="text" class="regular-text code"   > 
        </td>
      </tr> 
    </tbody>
  </table>
 
  <input type="hidden" name="action" value="erp_sprint_vendor">
    <a href="javascript:void()" id="erp_sprint_done" style="margin: 0 24px  0 0"> Back </a>
    <input type="submit" class="button" value="Add Vendor" id="settingsubmitVendor" name="settingsubmitVendor"> 
  </form>
</div>

<div style="display:none !important;"   class="modal">
  <!-- Modal content -->
  <div class="modal-content">
   
    <div class="sprint_waybill_detail_content padding_modal" style="text-align:center;color:black;">
        <p style="font-size: 20px;" id="message"></p> 
        <p><a href="#" id="erp_sprint_close">Close</a><p> 
        <p><a href="#" id="erp_sprint_done">Close</a><p> 
    </div>
  </div>
</div>

<div class="modal" id="sprint_loading_div_img">
  <div class="modal-content">                    
    <div class="calculate_tariff_img padding_modal">
      <p class="loading_img" style="color:black; font-size:20px;">
      <img src="<?php echo ERP_SPRINT_PLUGIN_URL; ?>assets/image/loading.gif"></p>
      <p class="loading_content" style="color:white; font-size:20px;">   
      </p>
    </div>  
  </div>
</div>

<script>
  jQuery(document).ready(function() {
    jQuery(".create_vendor").click(function() {
      jQuery("#table").hide();
      jQuery(".create_waybill_from").show();
    });
    jQuery("")
  })
  </script>