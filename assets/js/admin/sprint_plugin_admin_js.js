function erp_sprint_get_selected() {
  var getValue = [];
  var checkedValues = jQuery('.sprint_order_checkbox:checkbox:checked').map(function() {
    getValue.push(jQuery(this).val());
  }).get();
  return getValue;
}

function myFunction() {
  return Math.floor((Math.random() * 999999999) + 1);
}

var final_html = ' <div> <div style="float:left;width:10%;">Waybill</div> <div style="float:left;width:40%;">[waybill]</div> <div style="float:left;width:15%;">Package URL</div> <div style="float:left;width:35%;"> <a  href="[label]" target="_blank"> Pakage URL </a> </div> </div>';

function parent_waybill(waybill) {
  var childWaybill = { 
    'action' : 'erp_sprint_getChildWaybill',
    'waybill': waybill
  };
  jQuery.ajax({
    url: ajaxurl,
    data: childWaybill,
    success: function(data) {
      var html = '';
      var data = JSON.parse(data);
      for (i = 0; i < data.length; i++) {
        console.log(data)
        html += final_html;
        html = html.replace("[waybill]", data[i]["waybill_number"]);
        html = html.replace("[label]",   data[i]["waybill_file_name"]);     
      }
      jQuery(".sprint_waybill_detail_content").html(html);
      jQuery('#now').show();
    }
  });
}

jQuery(document).ready(function() {
  jQuery("#sprint_closemodalload").click(function() {
    jQuery('#sprint_loading_div_img').hide();
  });
  
  jQuery("#closemodalload").click(function (event) {
    jQuery('#now').hide();
  });

  jQuery("#settingsubmitVendor").click(function(event){
     
    event.preventDefault();
    var array_data = jQuery("form").serializeArray();
    array_data['action'] = 'erp_sprint_vendor';
    jQuery('#sprint_loading_div_img').show();

    jQuery.ajax({
      url: ajaxurl,
      data: array_data,
      success: function(data) {
        
        var data = JSON.parse(data);
        jQuery(".modal").show();
        jQuery("#message").html(data['messageType']);
        jQuery('#sprint_loading_div_img').hide();
        if (data['result'] == 'Error') {
          jQuery("#erp_sprint_close").show();
          jQuery("#erp_sprint_done").hide();
          
        } else {
          jQuery("#erp_sprint_close").hide();
          jQuery("#erp_sprint_done").show();
        }
      },
      error: function(xhr, error) {
        console.debug(error);
      }
    });
  });

  jQuery("#settingsubmit").click(function(event){
    event.preventDefault();
    var array_data = jQuery("form").serializeArray();
    array_data['action'] = 'erp_sprint_setting';
    jQuery('#sprint_loading_div_img').show();
    jQuery.ajax({
      url: ajaxurl,
      data: array_data,
      success: function(data) {
        var data = JSON.parse(data);
        jQuery(".modal").show();
        jQuery("#message").html(data['messageType']);
        jQuery('#sprint_loading_div_img').hide();
      },
      error: function(xhr, error) {
        console.debug(error);
      }
    });
  });

  jQuery("#sprint_doaction").click(function(){
    var getd = erp_sprint_get_selected();
    var selectedlength = getd.length;
    if(selectedlength == 0){
      alert('Please select at leat one checkbox');
      return;
    } else if(selectedlength > 10) {
        alert('Please select maximum  10 checkboxs');
        return;
    } else { 
        jQuery('#sprint_loading_div_img').show();

        if (selectedlength == 1) { 
          jQuery("#multiple_waybill").show();
        } else { 
          jQuery("#multiple_waybill").hide();
        }
        var order_lists = getd.toString();
        jQuery('#sprint_order_numbers_20').val(order_lists);
      }
  }); 
  
  jQuery('.sprint_getcity').on('change', function() {
    var cityId = jQuery(this).attr('city-id');
    var country_id = jQuery(this).attr('country-id');
    var stateName = jQuery(this).val();
    var country = jQuery("#"+country_id).val();
    if(stateName == 'null') {
      alert('Please Select '+jQuery(this).attr('messg'));
    } else {
      var pleasewait = '<option value="null">Getting..</option>';
      jQuery('#'+cityId).html(pleasewait);
      var StData = {
        'action' : 'erp_sprint_get_city_name',
        'statecode' : stateName,
        'country' : country,
      };
      jQuery.ajax({
        url: ajaxurl,
        data: StData,
        success: function(data) {
          var data = JSON.parse(data);
          var html_data = '<option value=""> Select</option>';
          for (var key in data) {
            html_data += '<option value="'+key+'">'+data[key]+'</option>';
          } 
          jQuery('#'+cityId).html(html_data);
        },
        error: function(xhr, error) {
          console.debug(error);
          }
      });
    }
  });

  jQuery("#sprint_gets_code_waybill").click(function(){
    var getValues = [];
    var orderid = jQuery('#sprint_order_numbers_20').val();
    var selectservice = jQuery('#sprint_service_20').val();
    var inputcodes = jQuery('#sprint_customercode_20').val();
    console.log(orderid+' , '+selectservice+' , '+inputcodes);
    var data = '';jQuery("form").serialize(); 
    data += '&orderid='+orderid+'&selectservice='+selectservice+'&inputcodes='+inputcodes+'&action=erp_sprint_create_orders';
    if(selectservice == 'null' || inputcodes == '') {
      return alert('Please enter Service Code or Customer Code');
    } else {
      var checked_radios = jQuery('input[name=waybilltype]:checked').val();
      if (checked_radios == 'multiple') {
        var vendor = [];
        var package = [];
        jQuery(".vendor_code").each( function() {
          vendor.push(jQuery(this).val());
        });
        jQuery(".package").each( function() {
          package.push(jQuery(this).val());
        });
      } else {
        jQuery(".type_waybill").each( function() {
          // alert(jQuery(this).val());
        });
      }
      getValues.push(orderid,selectservice,inputcodes);
      jQuery(this).text('Processing....');
      jQuery(this).prop("disabled", true);
      var formData = {
        "action" : "erp_sprint_create_orders",
        "orderdetails" : getValues,
        "vendor" : vendor,
        "package" : package,
        "type" : checked_radios
      };
      jQuery("#choice_waybill").hide();
      jQuery.ajax({
        url: ajaxurl,
        data: formData,
        success:function(data){
          console.log(data);
          var data = JSON.parse(data);
          var html_return = '';
          for (i = 0; i < data.length; i++) { html_return += '<ul> <li>'+ data[i] + "</li> </ul>";}
          jQuery('#sprint_closemodalload, #sprint_gets_code_waybill, #back').hide();
          jQuery('#sprint_gets_code_waybillclose').show();
          jQuery('#sprint_service_code_add').html(html_return);
        },
        error: function(xhr, error) {
          console.debug(error);
        }
      });
    }
  });

  jQuery("#sprint_gets_code_waybillclose").click(function(){
    jQuery('#sprint_loading_div_img').hide();
    jQuery('#sprint_service_code_add').html('');
  });

  jQuery(".sprint_view_history").click(function() {
    jQuery('#sprint_waybill_detail_content_main .sprint_waybill_detail_content_inner').html(' ');
    jQuery('.sprint_waybill_detail_content p').show();
    jQuery('#sprint_myModal').show();
    var wbID = jQuery(this).attr('id');
    var wbData = {
      'action' : 'getHistory',
      'wbid' : wbID
    };
    jQuery.ajax ({
        url: ajaxurl,
        data: wbData,
        success: function(data) {
          jQuery('.sprint_waybill_detail_content p').hide();
          jQuery('#sprint_waybill_detail_content_main .sprint_waybill_detail_content_inner').html(data);
        },
        error:function(xhr, error) {
          //console.debug(error);
        }
    });
  });

  jQuery("#sprint_closemodal").click(function(){
    jQuery('#sprint_myModal').hide();
  });
  jQuery("#erp_sprint_close").click(function(){
    jQuery('.modal').hide();
  });

  jQuery("#erp_sprint_done").click(function(){
    window.location.reload(1);
  });

  jQuery("#closemodals, #sprint_gets_code_waybillclose").click(function(){
    jQuery('#sprint_loading_div_img').hide();
    window.location.reload(1);
  });
  
  jQuery("#pickuprequestingclose").click(function(){
    jQuery('#pickuprequestmainform').hide();
    jQuery('#sprint_loading_div_img').hide();
    window.location.reload(1);
  });

  jQuery(".sprint_get_state_from_country").on('change', function() {
    var country = jQuery(this).val();
    var state_id = jQuery(this).attr('data-state'); 
    var pleasewait = '<option value="null">Getting..</option>' ;
    jQuery('#'+state_id).html(pleasewait);
    if (country != 'null'){
      var StData = {
        'action' : 'erp_sprint_get_state_name',
        'country' : country,
      };
      jQuery.ajax({
        url: ajaxurl,
        data: StData,
        success : function(data) { 
          var data = JSON.parse(data);
          var html_data = '<option value=""> Select</option>';
          for (var key in data) {
            html_data += '<option value="'+key+'">'+data[key]+'</option>';
          } 
          jQuery('#'+state_id).html(html_data);
        }
      });
    }
  });

  jQuery("#sprint_get_calculate").click(function() {
    var scountry = jQuery('#source_country').val();
    var sstate = jQuery('#source_state').val();
    var scity = jQuery('#source_city').val();
    var szip = jQuery('#source_zipcode').val();
    var dcountry = jQuery('#destination_country').val();
    var dstate = jQuery('#destination_state').val();
    var dcity = jQuery('#destination_city').val();
    var dzip = jQuery('#destination_zipcode').val();
    var pservices = jQuery('#package_services').val();
    var ppackages = jQuery('#package_packages').val();
    var pweight = jQuery('#package_weight').val();
    if(scountry == 'null') { alert('Please select source country'); }
    else if(sstate == 'null') { alert('Please select source state'); }
    else if(sstate == 'notfound') { alert('Please contact to admin for states list'); }
    else if(scity == 'null') { alert('Please select source city'); }
    else if(dcountry =='null') { alert('Please select destination country'); }
    else if(dstate == 'null') { alert('Please select destination state'); }
    else if(dstate == 'notfound') { alert('Please contact to admin for states list'); }
    else if(dcity == 'null') { alert('Please select destination city'); }
    else if(pservices =='null') { alert('Please select package service'); }
    else if(ppackages =='') { alert('Please enter number of packages'); }
    else if(pweight =='') { alert('Please enter weight'); }
    else {
      jQuery('#loading_div_img').show();
      var tariffData = {
        'action'    : 'erp_sprint_get_calculate_tariff',
        'scountry'  : scountry,
        'sstate'    : sstate,
        'scity'     : scity,
        'szip'      : szip,
        'dcountry'  : dcountry,
        'dstate'    : dstate,
        'dcity'     : dcity,
        'dzip'      : dzip,
        'pservices' : pservices,
        'ppackages' : ppackages,
        'pweight'   : pweight,
      };
      jQuery.ajax({
          url: ajaxurl,
          data: tariffData,
          success:function(data) {
            jQuery('#loading_div_img .loading_img').hide(); 
            var data = JSON.parse(data);
            if (data['messageType'] =='Error'){
              var html_data = '<div class="calculate_div"><h3 style="font-size: 25px;">' + data['messageType'] + '</h3><p class="error_message">' + data['message'] + '</p></div>';
            } else {
              var html_data = '<div class="calculate_div"><h3 style="font-size: 25px;">Tariff Details</h3> <div class="list_1 lists"><div class="label_name">Amount</div> <div class="label_value">'+data['totalAmount']+'</div></div> <div class="list_2 lists"><div class="label_name">Tax</div> <div class="label_value">'+data['taxAmount']+'</div></div><div class="list_3 lists maintotal"><div class="label_name">Total Amount</div><div class="label_value">'+data['total_tax_amount']+'</div></div></div>';
            } 
            jQuery('#loading_div_img .loading_content').html(html_data);
            jQuery('#closemodals').prop("disabled",false);
          },
          error:function(xhr, error){
            console.debug(error);
          }
      });
    }
  });  
  jQuery("#sprint_addpackageindex").click(function() {
    var i =jQuery(this).attr('id-index');
    i++;
    var indexcontant = '<tr id="'+i+'"><td class="indexidval">'+i+'</td><td><input type="text" class="packtype"></td><td><input type="text" class="packdes"></td><td><input type="text" class="packqua sprint_number"></td><td><input type="text" class="itemqua sprint_number"></td><td><input type="text" id="len_'+i+'" class="length number-float"></td><td><input type="text" id="wid_'+i+'" class="width number-float"></td><td><input id="hei_'+i+'" type="text" class="height number-float"></td><td><input type="text" readonly id="'+i+'"  class="sprint_get_charegeweigh aclwg number-float"></td><td><input readonly  id="'+i+'" type="text" class="sprint_get_charegeweigh chwg number-float"></td><td><a class="sprint_deleteindex" ind-id="'+i+'" href="javascript:void(0);">Delete</a></td></tr>';
    jQuery("#sprint_packagedetailtable tbody").append(indexcontant);
    jQuery(this).attr('id-index',i);
  });

  jQuery('#sprint_packagedetailtable').on('click', '.sprint_get_charegeweigh', function() {
    var idvalue =jQuery(this).attr('id');
    var l =  jQuery('#len_'+idvalue).val();
    var b =  jQuery('#wid_'+idvalue).val();
    var h =  jQuery('#hei_'+idvalue).val();
    var cal1 = (l*b*h)/5000;
    jQuery('tr#'+idvalue+' .sprint_get_charegeweigh').val(cal1);
  });

  jQuery('#sprint_packagedetailtable').on('keyup', '.sprint_get_charegeweigh', function(e) {
    e.preventDefault(); 
    var idvalue =jQuery(this).attr('id');
    var l =  jQuery('#len_'+idvalue).val();
    var b =  jQuery('#wid_'+idvalue).val();
    var h =  jQuery('#hei_'+idvalue).val();
    var cal1 = (l*b*h)/5000;
    jQuery('tr#'+idvalue+' .sprint_get_charegeweigh').val(cal1);     
  });

  jQuery('#sprint_packagedetailtable').on('click', '.sprint_deleteindex', function(e) {
    e.preventDefault();
    var indexvalue =jQuery(this).attr('ind-id');
    jQuery('tr#'+indexvalue).remove();
  });

  jQuery("#sprint_packagedetailtable").on('keypress', '.sprint_number', function(e) {
    if (String.fromCharCode(e.keyCode).match(/[^0-9\.]/g)) return false;
  });

  function erp_sprint_get_package_detial_list() {
    var packageDetails = []; 
    jQuery("#sprint_packagedetailtable tbody tr").each(function() {
      var packtype = jQuery(this).find("td .packtype").val();
      var packqua = jQuery(this).find("td .packqua").val();
      var lengths = jQuery(this).find("td .length").val();
      var width = jQuery(this).find("td .width").val();
      var height = jQuery(this).find("td .height").val();
      var aclwg= jQuery(this).find("td .aclwg").val();
      var chwg = jQuery(this).find("td .chwg").val();
      packageDetails.push(
                          [
                            packqua,
                            lengths,
                            width,
                            height,
                            aclwg,
                            chwg,
                            packtype
                          ]
                        );
    });
    return packageDetails;
  }

  jQuery("#sprint_create_waybill_manual").click(function(){
    var shipperDetails = [];
    var consigneeDetails = [];
    var basicDetails = [];
    var trCount = jQuery('#sprint_packagedetailtable tbody tr').length;
    var service = jQuery('#service').val();
    var invoice_value = jQuery('#invoice_value').val();
    var invoice_number = jQuery('#invoice_number').val();
    var reference_number = jQuery('#reference_number').val();
    var cod_amount = jQuery('#cod_amount').val();
    var description = jQuery('#description').val();
    var refund_amount = jQuery('#refund_amount').val();
    var reverse_logixtics_activity = jQuery('#reverse_logixtics_activity').val();
    basicDetails.push(service, invoice_value, invoice_number, reference_number, cod_amount, 
                      description, refund_amount, reverse_logixtics_activity);
    var scompanyname = jQuery('#scompanyname').val();
    var scontactperson = jQuery('#scontactperson').val();
    var saddress = jQuery('#saddress').val();
    var sareaname = jQuery('#sareaname').val();
    var sphone = jQuery('#sphone').val();
    var semail = jQuery('#semail').val();
    var scountry = jQuery('#scountry').val();
    var sstate = jQuery('#sstate').val();
    var scity = jQuery('#scity').val();
    var spincode = jQuery('#spincode').val();
    shipperDetails.push(scompanyname,scontactperson,saddress,sareaname,sphone,
                        semail,scountry,sstate,scity,spincode);
    var ccompanyname = jQuery('#ccompanyname').val();
    var ccontactperson = jQuery('#ccontactperson').val();
    var caddress = jQuery('#caddress').val();
    var careaname = jQuery('#careaname').val();
    var cphone = jQuery('#cphone').val();
    var cemail = jQuery('#cemail').val();
    var ccountry = jQuery('#ccountry').val();
    var cstate = jQuery('#cstate').val();
    var ccity = jQuery('#ccity').val();
    var cpincode = jQuery('#cpincode').val();
    var cod_payment_mode = jQuery('#cod_payment_mode').val();
    consigneeDetails.push(ccompanyname,ccontactperson,caddress,careaname,cphone,
                          cemail,ccountry,cstate,ccity,cpincode,cod_payment_mode);
    if(service == 'null') { alert('Please select service'); }
    else if(scontactperson == '') { alert('Please enter shipper contact person name'); }
    else if(saddress == '') { alert('Please enter shipper address'); }
    else if(sphone == '') { alert('Please enter shipper phone number'); }
    else if(scountry == 'null') { alert('Please select shipper country'); }
    else if(sstate == 'null') { alert('Please select shipper state'); }
    else if(scity == 'null') { alert('Please select shipper city'); }
    else if(ccontactperson == '') { alert('Please enter consignee contact person name'); }
    else if(caddress == '') { alert('Please enter consignee address'); }
    else if(cphone == '') { alert('Please enter consignee phone number'); }
    else if(ccountry == 'null') { alert('Please select consignee country'); }
    else if(cstate == 'null') { alert('Please select consignee state'); }
    else if(ccity == 'null') { alert('Please select consignee city'); }
    else if(trCount == '0') { alert('Please add atleast one package details'); }
    else {
      jQuery('#loading_div_img').show();
      jQuery('#loading_div_img .loading_img').show();
      jQuery('#loading_div_img .loading_content').html('');
      var packagelistdetail = erp_sprint_get_package_detial_list();
      var waybillData = {
        'action' : 'erp_sprint_create_manual_waybill',
        // 'basicDetail' : basicDetails,
        // 'shipperDetail' : shipperDetails,
        // 'consigneeDetail' : consigneeDetails,
        'packageDetails' : packagelistdetail,
        'service': service,
        'invoice_value' : invoice_value,
        'invoice_number' : invoice_number,
        'reference_number' : reference_number,
        'cod_amount': cod_amount, // validate
        'description' : description,
        'refund_amount': refund_amount, // refund amount
        'reverse_logixtics_activity': reverse_logixtics_activity,
        'scompanyname': scompanyname,
        'scontactperson': scontactperson,
        'saddress': saddress,
        'sareaname': sareaname,
        'sphone': sphone,
        'semail': semail,
        'scountry':scountry,
        'sstate': sstate,
        'scity': scity,
        'spincode': spincode,
        'ccompanyname':ccompanyname,
        'ccontactperson': ccontactperson,
        'caddress': caddress,
        'careaname': careaname,
        'cphone' : cphone,
        'cemail' : cemail,
        'ccountry': ccountry,
        'cstate': cstate,
        'ccity': ccity,
        'cpincode': cpincode,
        'cod_payment_mode': cod_payment_mode
      };
      jQuery.ajax({
        url: ajaxurl,
        data: waybillData,
        success: function(data) {
          var reciveData = JSON.parse(data);
          if(reciveData.status == 'error') {
            jQuery('#closemodalserror').show();
          } else {
            jQuery('#closemodals').show();
          }
          jQuery('#loading_div_img .loading_img').hide();
          jQuery('#loading_div_img .loading_content').html(reciveData.message);
        },
        error: function(xhr, error) {
          console.debug(error);
        }
      });
    }
  });

  function erp_sprint_get_selected_pickup(){
    var getpickupValue = [];
    var checkedValues = jQuery('.pr_checkbox:checkbox:checked').map(function() {
      getpickupValue.push(jQuery(this).val());
    }).get();
    return getpickupValue;
  }

  jQuery("#sprint_createpickup").click(function() {
    var waybillnumbers = erp_sprint_get_selected_pickup();
    var selectedlengthchk = waybillnumbers.length;
    if(selectedlengthchk == 0) {
      alert('Please select at leat one checkbox');
      return;
    } else {
      var add = jQuery('#'+waybillnumbers[0]+' .pr_checkbox').attr('data-address');
      var state = jQuery('#'+waybillnumbers[0]+' .pr_checkbox').attr('data-state');
      var city = jQuery('#'+waybillnumbers[0]+' .pr_checkbox').attr('data-city');
      var zipcode = jQuery('#'+waybillnumbers[0]+' .pr_checkbox').attr('data-zipcode');
      jQuery('#pickupstate').val(state);
      jQuery('#pickupcity').val(city);
      jQuery('#pickupaddress').val(add);
      jQuery('#pickupzipcode').val(zipcode);
      jQuery('#Waybillnumbers').val(waybillnumbers);
      jQuery('#pickuprequestmainform').show();
    }
  });

  jQuery("#sprint_creatingpickuprequesting").click(function(){
    var readytime = jQuery('#readytime').val();
    var latesttimeAvailable = jQuery('#latesttimeAvailable').val();
    var pickupcountry = jQuery('#pickupcountry').val();
    var pickupstate = jQuery('#pickupstate').val();
    var pickupcity = jQuery('#pickupcity').val();
    var pickupaddress = jQuery('#pickupaddress').val();
    var pickupzipcode = jQuery('#pickupzipcode').val();
    var pickupdate = jQuery('#pickupdate').val();
    var clientcode = jQuery('#clientcode').val();
    var Waybillnumbers = jQuery('#Waybillnumbers').val();
    var pickuptype = jQuery('#pickuptype').val();
    var specialinstruction = jQuery('#specialinstruction').val();
    if(readytime == ''){alert('Please enter readytime'); }
    else if(latesttimeAvailable == ''){alert('Please enter latest time available'); }
    else if(pickupstate == 'null'){alert('Please enter pickup state'); }
    else if(pickupstate == 'notfound'){alert('Please contact to admin for states list'); }
    else if(pickupcity == 'null'){alert('Please enter pickup city name'); }
    else if(pickupaddress == ''){alert('Please enter pickup address'); }
    else if(pickupdate == ''){alert('Please enter pickup date'); }
    else if(clientcode == ''){alert('Please enter client code'); }
    else {     
      jQuery('#sprint_creatingpickuprequesting').prop("disabled", true);
      jQuery(this).text('Processing....');
      var pickupData = {
        'action' : 'erp_sprint_get_pickup_request',
        'readytime' : readytime,
        'latesttimeAvailable' : latesttimeAvailable,
        'pickupcountry' : pickupcountry,
        'pickupstate' : pickupstate,
        'pickupcity' : pickupcity,
        'pickupaddress' : pickupaddress,
        'pickupzipcode' : pickupzipcode,
        'pickupdate' : pickupdate,
        'clientcode' : clientcode,
        'Waybillnumbers' : Waybillnumbers,
        'pickuptype' : pickuptype,
        'specialinstruction' : specialinstruction
      };
      jQuery.ajax ({
        url: ajaxurl,
        data: pickupData,
        success: function(data){
          jQuery('#sprint_creatingpickuprequesting').hide();
          jQuery('#closemodalpickup').hide();
          jQuery('.pickup_request_form_content_inner').html('<ul><li>'+data+'</li></ul>');
          jQuery('#pickuprequestingclose').show();
          console.log(data);
        },
        error: function(xhr, error){
          console.debug(error);
        }
      });
    }
  });
});