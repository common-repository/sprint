<style>
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
<div class="wrap">
  <h2>Plugin Settings
  </h2>
  <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="POST" >
    <table class="form-table">  
      <tbody>
      <tr>
        <th><label for="plugin_name">Plugin Name</label></th>
        <td> <input type="text" name="plugin_name" id="plugin_name" type="text" class="regular-text code" value="<?php if (isset($settingAtrs->pluginName)) { print_r($settingAtrs->pluginName); } ?>" required></td>
      </tr>
      <tr style="display:none">
        <th>
          <label for="customer_code">Secure Key</label>
        </th>
        <td> 
          <input type="text" name="secure_key" id="secure_key" type="text" class="regular-text code"  value="032DEAEA3E1D4CF1AD7DE1FDFA437689" required>
        </td>
      </tr>
      <tr>
        <th>
          <label for="customer_code">Customer Code</label>
        </th>
        <td> 
          <input type="text" name="customer_code" id="customer_code" type="text" class="regular-text code"  value="<?php if (isset($settingAtrs->customerCode)) { print_r($settingAtrs->customerCode); } ?>" required>
        </td>
      </tr>
      <tr>
        <th><label for="service_code">Service Code</label></th>
        <td>
          <select class="regular-text code" id="service_code" name="service_code" required>
            <option value="null">Select</option>
            <?php
              foreach($services as $service) {
                $name = $service["name"];
                $code = $service["code"];
                if(isset($settingAtrs->serviceCode) && $settingAtrs->serviceCode == $code) {
                  echo '<option value="'.$code.'" selected>'.$name.'('.$code.')</option>';  
                } else { 
                  echo '<option value="'.$code.'">'.$name.'('.$code.')</option>';  
                }
              }
            ?>
          </select> 
        </td>
      </tr>
      <tr>
        <th>
          <label for="service_code">Default Source Country</label>
        </th>
        <td>
          <select id="source_country"  name="source_country" class="regular-text code" required>
            <option value="">Select</option>
            <?php foreach($country as $key=>$value) { 
              if(isset($settingAtrs->sourceCountry) && $settingAtrs->sourceCountry == $key) { ?>
                <option value="<?php echo $key;?>" selected>
                  <?php echo $value; ?>
                </option>
              <?php } else{ ?>
                <option value="<?php echo $key;?>"><?php echo $value; ?></option>
              <?php } 
            } ?>
          </select> 
        </td>
      </tr>
      <tr>
        <th>
          <label for="pickup_address"> Pickup Address </label>
        </th>
        <td>
          <input type="text" id="pickup_address" name="pickup_address" type="text" class="regular-text code"  value="<?php if(isset($settingAtrs->pickup_address)) { print_r($settingAtrs->pickup_address); } ?>" required>
        </td> 
      </tr>
      <tr>
        <th> <label for="pickup_city"> Pickup City </label> </th>
        <td>
          <input type="text" id="pickup_city" name="pickup_city" type="text" class="regular-text code"  value="<?php if(isset($settingAtrs->pickup_city)) {  print_r($settingAtrs->pickup_city); } ?>" required> 
        </td>
      </tr>
        
      <tr>
        <th> <label for="pickup_state"> Pickup State </label> </th>
        <td>
          <input type="text" id="pickup_state" name="pickup_state" type="text" class="regular-text code"  value="<?php if(isset($settingAtrs->pickup_state)) { print_r($settingAtrs->pickup_state); }?>" required> 
        </td>
      </tr>
      
      <tr>
        <th> <label for="pickup_zipcode"> Pickup Zipcode </label> </th>
        <td>
          <input type="text" name="pickup_zipcode" id="pickup_zipcode" type="text" class="regular-text code"  value="<?php if(isset($settingAtrs->pickup_zipcode)) { print_r($settingAtrs->pickup_zipcode); }?>"  > 
        </td>
      </tr>
      <tr>
        <th><label for="get_status_link">Tracking Endpoint</label></th>
        <td> 
          <input type="text" name="get_status_link" id="get_status_link" type="text"  value="<?php echo get_home_url(); ?>/wp-json/sprint/v1/waybill_update" class="regular-text code" readonly>
        </td>
      </tr> 
    </tbody>
  </table>
 
  <input type="hidden" name="action" value="erp_sprint_setting">
  <input type="submit" class="button" value="Update Setting" id="settingsubmit" name="settingsubmit"> 
  </form>
</div>

<div style="display:none !important;"   class="modal">
  <!-- Modal content -->
  <div class="modal-content">
   
    <div class="sprint_waybill_detail_content padding_modal" style="text-align:center;color:black;">
        <p style="font-size: 20px;" id="message"></p> 
          <p><a href="#" id="erp_sprint_close">Close</a><p> 
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