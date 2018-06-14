/* tooltipster jquery */
jQuery(document).ready(function() {
	jQuery('.ct-tooltip').tooltipster({
		animation: 'grow',
		delay: 20,
		theme: 'tooltipster-shadow',
		trigger: 'hover'
	});
	jQuery('.ct-tooltipss').tooltipster({
		animation: 'grow',
		delay: 20,
		theme: 'tooltipster-shadow',
		trigger: 'hover'
	});
	jQuery('.ct-tooltip-services').tooltipster({
		animation: 'grow',
		side: 'bottom',
		interactive : 'true',
		theme: 'tooltipster-shadow',
		trigger: 'hover',
		delayTouch : 300,
		maxWidth:400,
		functionPosition: function(instance, helper, position){
			position.coord.top -= 70;
			return position;
		},
		contentAsHTML : 'true'
	});
});

var ct_postalcode_status_check = 'N';
var guest_user_status ='off';
/* scroll to next step */
jQuery(document).ready(function(){
	jQuery('.ct-service').on('click',function(){
		jQuery('html, body').stop().animate({
			'scrollTop': jQuery('.ct-scroll-meth-unit').offset().top - 30
		}, 800, 'swing', function () {});
	});
});

jQuery(document).ready(function () {
    jQuery('body').niceScroll();
    jQuery('.common-data-dropdown').niceScroll();
    jQuery('.ct-services-dropdown').niceScroll();

    var frequently_discount_id=jQuery("input[name=frequently_discount_radio]:checked").data('id');
    var frequently_discount_name=jQuery("input[name=frequently_discount_radio]:checked").data('name');
    if(frequently_discount_id == 0){
        jQuery('.f_dis_img').hide();
    }else{
        jQuery('.f_dis_img').show();
        jQuery(".f_discount_name").text(frequently_discount_name);
    }
});

jQuery(document).ready(function () {
	jQuery('.ct-loading-main').hide();
    var subheader_status=subheaderObj.subheader_status;
    if(subheader_status == 'Y'){
        jQuery('.ct-sub').show();
    }else{
        jQuery('.ct-sub').hide();
        jQuery('.ct-sub-complete-booking').html('<br>');
    }
	if(ct_postalcode_status_check == 'Y'){
		jQuery('.ct_remove_id').attr('id','');
		jQuery(document).on('click','.ct_remove_id',function(){
			jQuery('#ct_postal_code').focus();
			jQuery('#ct_postal_code').keyup();
		});
	}
	jQuery('.ct-loading-main').hide();
	jQuery('.remove_guest_user_preferred_email').hide();
    jQuery('.show_methods_after_service_selection').hide();
    jQuery('.freq_discount_display').hide();
    jQuery('.hide_allsss_addons').hide();
    jQuery('.partial_amount_hide_on_load').hide();
    jQuery('.hide_right_side_box').hide();
    jQuery('.client_logout').hide();
    jQuery('.postal_code_error').show();
    jQuery('.postal_code_error').html(errorobj_please_enter_postal_code);
    jQuery('.hideservice_name').hide();
    jQuery('.hidedatetime_value').hide();
    jQuery('.s_m_units_design_1').hide();
    jQuery('.s_m_units_design_2').hide();
    jQuery('.s_m_units_design_3').hide();
    jQuery('.s_m_units_design_4').hide();
    jQuery('.s_m_units_design_5').hide();

});

/* dropdown services list */
/* services dropdown show hide list */
jQuery(document).on("click",".service-is",function() {
    jQuery(".ct-services-dropdown").toggle( "blind", {direction: "vertical"}, 300 );
});

jQuery(document).on("click",".select_service",function() {
    jQuery("#ct_selected_service").html(jQuery(this).html());
    jQuery(".ct-services-dropdown").hide( "blind", {direction: "vertical"}, 300 );
});

/* select hours based service */
jQuery(document).on("click",".ct-duration-btn",function() {
    jQuery('.ct-duration-btn').each(function(){
        jQuery(this).removeClass('duration-box-selected');
    });
    jQuery(this).addClass('duration-box-selected');
});


/* for show how many addon counting when checked */
jQuery(document).ready(function(){
    jQuery('input[type="checkbox"]').click(function(){
        if(jQuery('.addon-checkbox').is(':checked')) {
            jQuery('.common-selection-main.addon-select').show();
        }
        else{
            jQuery('.common-selection-main.addon-select').hide();
        }
    });
});


/* addons */
jQuery(document).on("click",".ct-addon-btn",function() {
    var curr_methodname = jQuery(this).data('method_name');
    jQuery('.ct-addon-btn').each(function(){
        if(jQuery(this).data('method_name') == curr_methodname){
            jQuery(this).removeClass('ct-addon-selected');
        }
    });
    jQuery(this).addClass('ct-addon-selected');
});



/* user contact no. */
jQuery(document).ready(function() {
   /* jQuery("#ct-user-phone").mask("(999) 999-9999");  */
	var site_url=siteurlObj.site_url;
	var country_alpha_code = countrycodeObj.alphacode;
	var allowed_country_alpha_code = countrycodeObj.allowed;
	var array = allowed_country_alpha_code.split(',');
	var phone_visi = phone_status.statuss;
	if(phone_visi == "on"){
		if(allowed_country_alpha_code != ""){
			jQuery("#ct-user-phone").intlTelInput({
				onlyCountries: array,
				autoPlaceholder: "off",
				utilsScript: site_url+"assets/js/utils.js"
			});
			jQuery(".selected-flag .iti-flag").addClass(country_alpha_code);
			jQuery(".selected-flag").attr("title",countrycodeObj.countrytitle);
		}
		else
		{
			jQuery("#ct-user-phone").intlTelInput({
				autoPlaceholder: "off",
				utilsScript: site_url+"assets/js/utils.js"
			});
			jQuery(".selected-flag .iti-flag").addClass(country_alpha_code);
			jQuery(".selected-flag").attr("title",countrycodeObj.countrytitle);
		}
	}
});

/* see more instructions in service popup */
jQuery(document).ready(function() {
    jQuery(".show-more-toggler").click(function() {
        jQuery(".bullet-more").toggle( "blind", {direction: "vertical"}, 500);
        jQuery(".show-more-toggler:after").addClass('rotate');
    });
});

jQuery(document).ready(function () {
	jQuery('.panel-collapse').on('show.bs.collapse', function () {
		jQuery(this).siblings('.panel-heading').addClass('active');
	});

	jQuery('.panel-collapse').on('hide.bs.collapse', function () {
		jQuery(this).siblings('.panel-heading').removeClass('active');
	});
});

/************* Code by developer side --- ****************/

jQuery(document).on('keyup keydown blur','.add_show_error_class',function(event){
	/* jQuery('.ct-loading-main').hide(); */
    var id = jQuery(this).attr('id');
    var Number = /(?:\(?\+\d{2}\)?\s*)?\d+(?:[ -]*\d+)*$/;
    if(jQuery(this).hasClass('error')){
        jQuery( this ).removeClass('error');
        jQuery( "#"+id ).parent().removeClass('error');
        jQuery( this ).addClass('show-error');

        jQuery( "#"+id ).parent().addClass('show-error');
        if(jQuery('#ct-user-phone').val() != ''){
            if(!jQuery('#ct-user-phone').val().match(Number)){
                jQuery( '.intl-tel-input' ).parent().addClass('show-error');
            }
        }
    }else{
        jQuery( this ).removeClass('error');
        jQuery( "#"+id ).parent().removeClass('error');
        jQuery( this ).removeClass('show-error');
        jQuery( "#"+id ).parent().removeClass('show-error');
        if(jQuery('#ct-user-phone').val() != ''){
            if(jQuery('#ct-user-phone').val().match(Number)){
                jQuery( '.intl-tel-input' ).parent().removeClass('show-error');
            }
        }
    }
});

jQuery(document).on('keyup keydown blur','.add_show_error_class_for_login',function(event){
    var id = jQuery(this).attr('id');
    if(jQuery(this).hasClass('error')){
        jQuery( this ).removeClass('error');
        jQuery( "#"+id ).parent().removeClass('error');
        jQuery( this ).addClass('show-error');
        jQuery( "#"+id ).parent().addClass('show-error');
    }else{
        jQuery( this ).removeClass('error');
        jQuery( "#"+id ).parent().removeClass('error');
        jQuery( this ).removeClass('show-error');
        jQuery( "#"+id ).parent().removeClass('show-error');
    }
});

var clicked = false;
jQuery(document).ready(function () {
	jQuery(document).on('change','#recurrence-booking',function () {
		var recurrence_booking = jQuery('#recurrence-booking').prop("checked");
		if(recurrence_booking == true){
			jQuery('.recurrence_type_dropdown').show();
			jQuery('.recurrence_type_dropdown').show();
		} else{
			jQuery('.recurrence_type_dropdown').hide();
			jQuery('.recurrence_type_dropdown').hide();
		}
	});
});
jQuery(document).on('click','#complete_bookings',function(e){
	jQuery('.ct-loading-main').show();
	jQuery('.ct_all_booking_errors').css('display','none');
	var recurrence_booking = jQuery('#recurrence-booking').prop("checked");
	if(recurrence_booking == true){
        var recurrence_booking_1 ='Y';
    } else {
		var recurrence_booking_1='N';
    }
	var recurrence_booking_type = jQuery('.ct_recurrence_type').val();
	var recurrence_end_date = jQuery('.ct_recurrence_end_date').val();
	
    var site_url=siteurlObj.site_url;
    var ajax_url=ajaxurlObj.ajax_url;
	
    var front_url=fronturlObj.front_url;
    var existing_username = jQuery("#ct-user-name").val();
    var existing_password = jQuery("#ct-user-pass").val();
    var password = jQuery("#ct-preffered-pass").val();
    var firstname = jQuery("#ct-first-name").val();
    var lastname = jQuery("#ct-last-name").val();
    var email = jQuery("#ct-email").val();
	
    var phone = jQuery("#ct-user-phone").val();
	
	/***newly added start***/
    var user_address = jQuery("#ct-street-address").val();
    var user_zipcode = jQuery("#ct-zip-code").val();
    var user_city = jQuery("#ct-city").val();
    var user_state = jQuery("#ct-state").val();
	if(appoint_details.status == "on")
	{
		if(check_addresss.status="on"){ var address = jQuery("#app-street-address").val(); }
	  else { var address = jQuery("#ct-street-address").val(); }
	  
	  if(check_zip_code.status="on"){ var zipcode = jQuery("#app-zip-code").val(); }
	  else { var zipcode = jQuery("#ct-zip-code").val(); }
	  
	  if(check_city.status="on"){ var city = jQuery("#app-city").val(); }
	  else { var city = jQuery("#ct-city").val(); }
	  
	  if(check_state.status="on"){ var state = jQuery("#app-state").val(); }
	  else { var state = jQuery("#ct-state").val(); }
	}
	else {
		var address = jQuery("#ct-street-address").val();
		var zipcode = jQuery("#ct-zip-code").val();
		var city = jQuery("#ct-city").val();
		var state = jQuery("#ct-state").val();
	}
	
	
	/***newly added end***/
	
    var notes = jQuery("#ct-notes").val();
    var payment_method = 'pay at venue';
	
	/** new **/
    var staff_id = jQuery('.provider_disable:checked').data('staff_id');
	var v_c_status = jQuery(".vc_status").prop("checked");
    if(v_c_status == undefined){
		var vc_status = '-';
	}else{
		if(v_c_status == true){ var vc_status = 'Y'; }else{ var vc_status = 'N'; }
	}
	var prkng_status = jQuery(".p_status").prop("checked");
    if(prkng_status == undefined){
		var p_status = '-';
	}else{
		if(prkng_status == true){ var p_status = 'Y'; }else{ var p_status = 'N'; }
	}
    
	var con_status = jQuery("#contact_status").val();
	if(con_status == 'Other'){
		var contact_status = jQuery("#other_contact_status").val();
	}
	else if(con_status == undefined){
		var contact_status = '';
	}
	else{
		var contact_status = jQuery("#contact_status").val();
	}

    var booking_date_text = jQuery(".cart_date").text();
    var booking_date = jQuery(".cart_date").data('date_val');
    var booking_time = jQuery(".cart_time").data('time_val');
    var booking_time_text = jQuery(".cart_time").text();
    var booking_date_time = booking_date+' '+booking_time;
    var currency_symbol = jQuery(this).data('currency_symbol');
    var cart_sub_total=jQuery('.cart_sub_total').text();
    var cart_total=jQuery('.cart_total').text();
    var cart_discount=jQuery('.cart_discount').text().substring(2);
    var cart_tax=jQuery('.cart_tax').text();
    var amount = cart_sub_total.replace(currency_symbol, '');
    var discount = cart_discount.replace(currency_symbol, '');
    var taxes = cart_tax.replace(currency_symbol, '');
    var net_amount = cart_total.replace(currency_symbol, '');
    var cart_counting = jQuery("#total_cart_count").val();
    var f_discount_name = jQuery(".f_discount_name").text();
    if(jQuery.trim(f_discount_name) == 'Once'){
        var frequently_discount = 'O';
    }else if(jQuery.trim(f_discount_name) == 'Weekly'){
        var frequently_discount = 'W';
    }else if(jQuery.trim(f_discount_name) == 'Bi-Weekly'){
        var frequently_discount = 'B';
    }else if(jQuery.trim(f_discount_name) == 'Monthly'){
        var frequently_discount = 'M';
    }
    var coupon_code=jQuery('#coupon_val').val();
	
	var no_units_in_cart_err= jQuery('#no_units_in_cart_err').val();
	var no_units_in_cart_err_count= jQuery('#no_units_in_cart_err_count').val();
	
	var cc_card_num = jQuery('.cc-number').val();
	var cc_exp_month = jQuery('.cc-exp-month').val();
	var cc_exp_year = jQuery('.cc-exp-year').val();
	var cc_card_code = jQuery('.cc-cvc').val();
	
    dataString={existing_username:existing_username,existing_password:existing_password,password:password,firstname:firstname,lastname:lastname,email:email,phone:phone,user_address:user_address,user_zipcode:user_zipcode,user_city:user_city,user_state:user_state,address:address,zipcode:zipcode,city:city,state:state,notes:notes,vc_status:vc_status,p_status:p_status,contact_status:contact_status,payment_method:payment_method,staff_id:staff_id,amount:amount,discount:discount,taxes:taxes,net_amount:net_amount,booking_date_time:booking_date_time,frequently_discount:frequently_discount,coupon_code:coupon_code,cc_card_num:cc_card_num,cc_exp_month:cc_exp_month,cc_exp_year:cc_exp_year,cc_card_code:cc_card_code,guest_user_status:guest_user_status,recurrence_booking:recurrence_booking_1,recurrence_booking_type:recurrence_booking_type,recurrence_end_date:recurrence_end_date,action:"complete_booking"};

    if(jQuery('#user_details_form').valid()){
		if(jQuery("input[name='service-radio']:checked").val() != 'on' && jQuery("#ct-service-0").val() != 'off' && cart_counting == 1){
			clicked=false;
			jQuery('.ct-loading-main').hide();
			jQuery('.ct_all_booking_errors').css('display','block');
			jQuery('.ct_all_booking_errors').css('color','red');
			jQuery('.ct_all_booking_errors').html(errorobj_please_select_a_service);
        }else if(jQuery('.ser_name_for_error').text() == 'Cleaning Service' && cart_counting == 1){
			clicked=false;
			jQuery('.ct-loading-main').hide();
			jQuery('.ct_all_booking_errors').css('display','block');
			jQuery('.ct_all_booking_errors').css('color','red');
			jQuery('.ct_all_booking_errors').html(errorobj_please_select_a_service);
        }else if(jQuery('#ct_selected_servic_method .service-method-name').text() == 'Service Usage Methods' && cart_counting == 1){
			clicked=false;
			jQuery('.ct-loading-main').hide();
			jQuery('.ct_all_booking_errors').css('display','block');
			jQuery('.ct_all_booking_errors').css('color','red');
			jQuery('.ct_all_booking_errors').html(errorobj_please_select_method);
		}else if(cart_counting == 1){
			clicked=false;
			jQuery('.ct-loading-main').hide();
            jQuery('.ct_all_booking_errors').css('display','block');
			jQuery('.ct_all_booking_errors').css('color','red');
			jQuery('.ct_all_booking_errors').html(errorobj_please_select_units_or_addons);
        }else if(booking_date_text == '' && booking_time_text == ''){
			clicked=false;
			jQuery('.ct-loading-main').hide();
            jQuery('.ct_all_booking_errors').css('display','block');
			jQuery('.ct_all_booking_errors').css('color','red');
			jQuery('.ct_all_booking_errors').html(errorobj_please_select_appointment_date);
        }else if(no_units_in_cart_err == 'units_and_addons_both_exists' && no_units_in_cart_err_count == 'unit_not_added'){
			clicked=false;
			jQuery('.ct-loading-main').hide();
			jQuery('.ct_all_booking_errors').css('display','block');
			jQuery('.ct_all_booking_errors').css('color','red');
			jQuery('.ct_all_booking_errors').html(errorobj_please_select_atleast_one_unit);
		}else if(jQuery('#check_login_click').val() == 'not' && jQuery('#existing-user').prop("checked") == true){
			clicked=false;
			jQuery('.ct-loading-main').hide();
			jQuery('.ct_all_booking_errors').css('display','block');
			jQuery('.ct_all_booking_errors').css('color','red');
			jQuery('.ct_all_booking_errors').html(errorobj_please_login_to_complete_booking);
		}else{
			if(clicked===false){
				clicked=true;
				jQuery('.ct-loading-main').show();
				jQuery.ajax({
					type:"POST",
					url:front_url+"manual_booking_checkout.php",
					data:dataString,
					success:function(response){						
						if(jQuery.trim(response) == 'ok'){
							location.reload();
						}
					}
				});
				
			}else{
				e.preventDefault();
			}
        }
    }else{
		jQuery('.ct-loading-main').hide();
		clicked=false;
	}
	
    jQuery('.add_show_error_class').each(function(){
        jQuery(this).trigger('keyup');
    });
	
});

jQuery(document).on('change','#ct_mb_existing_login_dropdown',function(){
	jQuery('.ct-loading-main').show();
	jQuery('.add_show_error_class_for_login').each(function(){
        jQuery(this).trigger('keyup');
    });
    jQuery('.add_show_error_class').each(function(){
        var id = jQuery(this).attr('id');
        jQuery( this ).removeClass('error');
        jQuery( "#"+id ).parent().removeClass('error');
        jQuery( this ).removeClass('show-error');
        jQuery( "#"+id ).parent().removeClass('show-error');
        jQuery( '.intl-tel-input' ).parent().removeClass('show-error');
    });
    var site_url=siteurlObj.site_url;
    var ajax_url=ajaxurlObj.ajax_url;
    var existing_userid = jQuery(this).val();
	if(existing_userid != 0){
		var dataString={existing_userid:existing_userid,action:"get_existing_user_data"};
		jQuery.ajax({
			type:"POST",
			url:ajax_url+"manual_booking_frontajax.php",
			data:dataString,
			success:function(response){
				jQuery('.ct-loading-main').hide();
				jQuery('#check_login_click').val('clicked');
				var userdata=jQuery.parseJSON(response);
				
				jQuery('.client_logout').css('display','block');
				jQuery('.client_logout').show();
				jQuery(".fname").text(userdata.firstname);
				jQuery(".lname").text(userdata.lastname);

				jQuery('.hide_login_btn').hide();
				jQuery('.hide_radio_btn_after_login').hide();
				jQuery('.hide_email').hide();
				jQuery('.hide_login_email').hide();
				jQuery('.hide_password').hide();
				jQuery('.ct-peronal-details').show();
				jQuery('.login_unsuccessfull').hide();
				
				jQuery("#ct-user-name").val(userdata.email);
				jQuery("#ct-user-pass").val(userdata.password);
				
				jQuery("#ct-first-name").val(userdata.firstname);
				jQuery("#ct-last-name").val(userdata.lastname);
				jQuery("#ct-user-phone").intlTelInput("setNumber", userdata.phone);
				
				if(check_addresss.statuss=="on"){ jQuery("#ct-street-address").val(userdata.address); }
				  
				if(check_zip_code.statuss=="on"){  jQuery("#ct-zip-code").val(userdata.zip); }
				  
				if(check_city.statuss=="on"){  jQuery("#ct-city").val(userdata.city); }
				  
				if(check_state.statuss=="on"){  jQuery("#ct-state").val(userdata.state); }
				
				jQuery("#ct-notes").val(userdata.notes);
				if(userdata.vc_status == 'N'){
					jQuery("#vaccum-no").attr('checked', true);
				}else{
					jQuery("#vaccum-yes").attr('checked', true);
				}
				if(userdata.p_status == 'N'){
					jQuery("#parking-no").attr('checked', true);
				}else{
					jQuery("#parking-yes").attr('checked', true);
				}
				var con_staatus = userdata.contact_status;
				if(con_staatus == "I'll be at home" || con_staatus == 'Please call me' || con_staatus == 'The key is with the doorman'){
					jQuery("#contact_status").val(userdata.contact_status);
				}else{
					jQuery("#contact_status").val('Other');
					jQuery(".ct-option-others").show();
					jQuery("#other_contact_status").val(userdata.contact_status);
				}
			}
		});
	}else{
		jQuery('.ct-loading-main').hide();
	}
});

jQuery(document).ready(function(){
    var front_url=fronturlObj.front_url;
    jQuery.validator.addMethod("pattern_phone", function(value, element) {
        return this.optional(element) || /^[0-9+]*$/.test(value);
    }, "Enter Only Numerics");

    jQuery.validator.addMethod("pattern_zip", function(value, element) {
        return this.optional(element) || /^[a-zA-Z 0-9\-\ ]*$/.test(value);
    }, "Enter Only Alphabets");

    jQuery.validator.addMethod("pattern_name", function(value, element) {
        return this.optional(element) || /^[a-zA-Z ']+$/.test(value);
    }, "Enter Only Alphabets");

    jQuery.validator.addMethod("pattern_city_state", function(value, element) {
        return this.optional(element) || /^[a-zA-Z &]+$/.test(value);
    }, "Enter Only Alphabets");

	var phone_check =phone_status;
	var password_check =check_password;
	var fn_check =check_fn;
	var ln_check =check_ln;
	var address_check =check_addresss;
	var zip_check =check_zip_code;
	var city_check =check_city;
	var state_check =check_state;
	var notes_check =check_notes;
	
	/* validation condition*/
	jQuery("#user_details_form").validate();
	if(appoint_details.status == "on")
	{
		if(check_addresss.statuss=="on" &&  check_addresss.required=="Y"){ 
			jQuery("#app-street-address").rules("add", 
			{ required: true,minlength:check_addresss.min,maxlength:check_addresss.max,
			messages: { required: errorobj_req_sa, minlength:errorobj_min_sa, maxlength:errorobj_max_sa}});
		}
 
		if(check_zip_code.statuss=="on" &&  check_zip_code.required=="Y"){ 
			jQuery("#app-zip-code").rules("add", { required: true,minlength:check_zip_code.min,maxlength:check_zip_code.max, messages: { required: errorobj_req_zc, minlength:errorobj_min_zc, maxlength:errorobj_max_zc}});
		}
 
		if(check_city.statuss=="on" &&  check_city.required=="Y"){ 
			jQuery("#app-city").rules("add", 
			{ required: true,minlength:check_city.min,maxlength:check_city.max,
			messages: { required: errorobj_req_ct, minlength:errorobj_min_ct, maxlength:errorobj_max_ct}});
		}
	 
		if(check_state.statuss=="on" &&  check_state.required=="Y"){ 
			jQuery("#app-state").rules("add", 
			{ required: true,minlength:check_state.min,maxlength:check_state.max,
			messages: { required: errorobj_req_st, minlength:errorobj_min_st, maxlength:errorobj_max_st
			}});
		}
	}
	 
	 if(fn_check.statuss=="on" &&  fn_check.required=="Y"){ 
	  jQuery("#ct-first-name").rules("add", 
	  { required: true,minlength:fn_check.min,maxlength:fn_check.max,
	  messages: { required: errorobj_req_fn, minlength:errorobj_min_fn, maxlength:errorobj_max_fn}});
	 }
   
	 if(ln_check.statuss=="on" &&  ln_check.required=="Y"){ 
	  jQuery("#ct-last-name").rules("add", 
	  { required: true,minlength:ln_check.min,maxlength:ln_check.max,
	  messages: { required: errorobj_req_ln, minlength:errorobj_min_ln, maxlength:errorobj_max_ln}});
	 }
  
	 if(phone_check.statuss=="on" &&  phone_check.required=="Y"){ 
	  jQuery("#ct-user-phone").rules("add", 
	  { required: true,minlength:phone_check.min,maxlength:phone_check.max,
	  messages: { required: errorobj_req_ph, minlength:errorobj_min_ph, maxlength:errorobj_max_ph}});
	 }
 
	 if(address_check.statuss=="on" &&  address_check.required=="Y"){ 
	  jQuery("#ct-street-address").rules("add", 
	  { required: true,minlength:address_check.min,maxlength:address_check.max,
	  messages: { required: errorobj_req_sa, minlength:errorobj_min_sa, maxlength:errorobj_max_sa}});
	 }
 
	 if(zip_check.statuss=="on" &&  zip_check.required=="Y"){ 
	  jQuery("#ct-zip-code").rules("add", 
	  { required: true,minlength:zip_check.min,maxlength:zip_check.max,
	  messages: { required: errorobj_req_zc, minlength:errorobj_min_zc, maxlength:errorobj_max_zc}});
	 }
 
	 if(city_check.statuss=="on" &&  city_check.required=="Y"){ 
	  jQuery("#ct-city").rules("add", 
	  { required: true,minlength:city_check.min,maxlength:city_check.max,
	  messages: { required: errorobj_req_ct, minlength:errorobj_min_ct, maxlength:errorobj_max_ct}});
	 }
	 
	 if(state_check.statuss=="on" &&  state_check.required=="Y"){ 
	  jQuery("#ct-state").rules("add", 
	  { required: true,minlength:state_check.min,maxlength:state_check.max,
	  messages: { required: errorobj_req_st, minlength:errorobj_min_st, maxlength:errorobj_max_st}});
	 }
	 
	 if(notes_check.statuss=="on" &&  notes_check.required=="Y"){ 
	  jQuery("#ct-notes").rules("add", 
	  { required: true,minlength:notes_check.min,maxlength:notes_check.max,
	  messages: { required: errorobj_req_srn, minlength:errorobj_min_srn, maxlength:errorobj_max_srn}});
	 }
	 
	 if(password_check.statuss=="on" &&  password_check.required=="Y"){ 
	  jQuery("#ct-preffered-pass").rules("add", 
	  { required: true,minlength:password_check.min,maxlength:password_check.max,
	  messages: { required: errorobj_please_enter_password, minlength:errorobj_min_ps, maxlength:errorobj_max_ps}});
	  
	  jQuery("#ct-email").rules("add", 
	  { required:true, email:true, remote: {
					url:front_url+"manual_booking_firststep.php",
					type: "POST",
					async:false,
					data: {
						email: function(){ return jQuery("#ct-email").val(); },
						action:"check_user_email"
					}
	  },
	  messages: { required:errorobj_please_enter_email_address,email: errorobj_please_enter_valid_email_address,remote: errorobj_email_already_exists}});
	 }
 /* end validation condition*/

});

jQuery(document).on("change",".existing-user",function() {
    if(jQuery('.existing-user').is(':checked')) {
        jQuery("#ct-email-guest").val('');
		jQuery("#ct-user-name").val('');
        jQuery("#ct-user-pass").val('');
		jQuery("#ct-preffered-name").val('');
        jQuery("#ct-preffered-pass").val('');
        jQuery("#ct-first-name").val('');
        jQuery("#ct-last-name").val('');
        jQuery("#ct-email").val('');
        jQuery("#ct-user-phone").val('');
        jQuery("#ct-street-address").val('');
        jQuery("#ct-zip-code").val('');
        jQuery("#ct-city").val('');
        jQuery("#ct-state").val('');
        jQuery("#ct-notes").val('');
		jQuery('.ct-login-existing').show( "blind", {direction: "vertical"}, 700);
        jQuery('.ct-new-user-details').hide( "blind", {direction: "vertical"}, 300);
        jQuery('.ct-peronal-details').hide( "blind", {direction: "vertical"}, 300);
		guest_user_status ='off';
    }
});
jQuery(document).on("change",".new-user",function() {
    if(jQuery('.new-user').is(':checked')) {
        jQuery("#ct-email-guest").val('');
		jQuery("#ct-user-name").val('');
        jQuery("#ct-user-pass").val('');
		jQuery("#ct-preffered-name").val('');
        jQuery("#ct-preffered-pass").val('');
        jQuery("#ct-first-name").val('');
        jQuery("#ct-last-name").val('');
        jQuery("#ct-email").val('');
        jQuery("#ct-user-phone").val('');
        jQuery("#ct-street-address").val('');
        jQuery("#ct-zip-code").val('');
        jQuery("#ct-city").val('');
        jQuery("#ct-state").val('');
        jQuery("#ct-notes").val('');
		jQuery('.ct-new-user-details').show( "blind", {direction: "vertical"}, 700);
        jQuery('.ct-login-existing').hide( "blind", {direction: "vertical"}, 300);
        jQuery('.ct-peronal-details').show( "blind", {direction: "vertical"}, 300);
		jQuery('.remove_preferred_password_and_preferred_email').show( "blind", {direction: "vertical"}, 300);		
		jQuery('.remove_guest_user_preferred_email').hide( "blind", {direction: "vertical"}, 300);	
		if(jQuery( ".remove_zip_code_class" ).hasClass( "ct-md-6" )){
			jQuery('.remove_zip_code_class').removeClass('ct-md-6');
			jQuery('.remove_zip_code_class').addClass('ct-md-4');
		}
		if(jQuery( ".remove_city_class" ).hasClass( "ct-md-6" )){
			jQuery('.remove_city_class').removeClass('ct-md-6');
			jQuery('.remove_city_class').addClass('ct-md-4');
		}
		if(jQuery( ".remove_state_class" ).hasClass( "ct-md-6" )){
			jQuery('.remove_state_class').removeClass('ct-md-6');
			jQuery('.remove_state_class').addClass('ct-md-4');
		}
		guest_user_status ='off';
    }
});

jQuery(document).on("click","#ct_change_customer",function() {
    var site_url=siteurlObj.site_url;
    var ajax_url=ajaxurlObj.ajax_url;
	jQuery('#check_login_click').val('not');
	jQuery('.client_logout').hide();
	jQuery('.client_logout').css('display','none');
	jQuery("#other_contact_status").hide();
	jQuery('.hide_login_btn').show();
	jQuery('.ct-peronal-details').hide();
	jQuery('.hide_radio_btn_after_login').show();
	jQuery('.hide_email').show();
	jQuery('.hide_login_email').show();
	jQuery('.hide_password').show();
	jQuery("#ct-user-name").val('');
	jQuery("#ct-user-pass").val('');
	jQuery("#ct-preffered-name").val('');
	jQuery("#ct-preffered-pass").val('');
	jQuery("#ct-first-name").val('');
	jQuery("#ct-last-name").val('');
	jQuery("#ct-email").val('');
	jQuery("#ct-user-phone").val('');
	jQuery("#ct-street-address").val('');
	jQuery("#ct-zip-code").val('');
	jQuery("#ct-city").val('');
	jQuery("#ct-state").val('');
	jQuery("#ct-notes").val('');
	jQuery("#vaccum-yes").prop('checked',true);
	jQuery("#parking-yes").prop('checked',true);
	jQuery("#contact_status").val("I'll be at home");
	jQuery("#other_contact_status").val('');
	jQuery("#ct_mb_existing_login_dropdown").val(jQuery("#ct_mb_existing_login_dropdown option:first").val());
	jQuery('#ct_mb_existing_login_dropdown').selectpicker('refresh');
});

/* dropdown services methods list */
/* services methods dropdown show hide list */
jQuery(document).on("click",".service-method-is",function() {
    jQuery(".ct-services-method-dropdown").toggle( "blind", {direction: "vertical"}, 300 );
});

jQuery(document).on("click",".select_service_method",function() {
    jQuery("#ct_selected_servic_method").html(jQuery(this).html());
    jQuery(".ct-services-method-dropdown").hide( "blind", {direction: "vertical"}, 300 );
    jQuery('#ct_selected_servic_method h3').removeClass('s_m_units_design');
});


jQuery(document).on('click','.ser_details',function(){
	jQuery(":input",this).prop('checked',true);
	jQuery('.ct-loading-main').show();
    jQuery('.show_methods_after_service_selection').show();
	jQuery('.ct_method_tab-slider-tabs').removeClass('ct_methods_slide');
    jQuery('.service_not_selected_error_d2').removeAttr('style','');
    jQuery('.service_not_selected_error_d2').html(errorobj_please_select_a_service);
    jQuery('.freq_discount_display').hide();
    jQuery('.add_addon_in_cart_for_multipleqty').data('status','2');
    jQuery('.service_not_selected_error').hide();
    jQuery('.partial_amount_hide_on_load').hide();
    jQuery('.hide_right_side_box').hide();
    jQuery('.freq_disc_empty_cart_error').hide();
    jQuery('.s_m_units_design_1').hide();
	jQuery('.s_m_units_design_2').hide();
    jQuery('.s_m_units_design_3').hide();
    jQuery('.s_m_units_design_4').hide();
    jQuery('.s_m_units_design_5').hide();
    jQuery('.hideservice_name').show();
    jQuery('.show_select_staff_title').show();
    jQuery('.empty_cart_error').hide();
	jQuery('.no_units_in_cart_error').hide();
    jQuery( ".cart_item_listing" ).empty();
    jQuery( ".frequent_discount" ).empty();
    jQuery( ".cart_sub_total" ).empty();
    jQuery( ".cart_empty_msg" ).show();
    jQuery( ".cart_tax" ).empty();
    jQuery( ".cart_total" ).empty();
    jQuery( ".remain_amount" ).empty();
    jQuery( ".partial_amount" ).empty();
    jQuery( ".cart_discount" ).empty();
    var site_url=siteurlObj.site_url;
    var ajax_url=ajaxurlObj.ajax_url;
    var id = jQuery(this).data('id');
    var name = jQuery(this).data('servicetitle');
    jQuery('.sel-service').html(name);

    jQuery('.addon_qty').each(function(){
        jQuery(this).val(0);
        jQuery('.add_minus_button').hide();
    });

    if(jQuery('.ser_name_for_error').text() != 'Cleaning Service' && jQuery('.service-method-name').text() == 'Service Usage Methods'){
        jQuery('.method_not_selected_error').css('display','block');
        jQuery('.method_not_selected_error').css('color','red');
        jQuery('.method_not_selected_error').html("Please Select Method");
    }else if(jQuery("input[name='service-radio']:checked").val() == 'on' && jQuery('.service-method-name').text() == 'Service Usage Methods'){
		jQuery('.method_not_selected_error').css('display','block');
        jQuery('.method_not_selected_error').css('color','red');
        jQuery('.method_not_selected_error').html("Please Select Method");
    }

    /* display all methods of the selected services */
    jQuery.ajax({
        type : 'post',
        data : {
            'service_id' : id,
            'operationgetmethods' : 1
        },
        url : ajax_url+"manual_booking_frontajax.php",
        success : function(res){
			jQuery('.ct-loading-main').hide();
			var methods_data=jQuery.parseJSON(res);
            if(methods_data.status == 'single'){
                jQuery('.services-method-list-dropdown').hide();
                jQuery('.show_single_service_method').html(methods_data.m_html);
                jQuery('.s_m_units_design').trigger('click');
                jQuery('#method_not_selected_error').hide();
				
				jQuery.ajax({
					type : 'post',
					data : {
						'service_id' : id,
						'staff_select_according_service' : 1
					},
					url : ajax_url+"manual_booking_frontajax.php",
					success : function(res){
						var search_session_data=jQuery.parseJSON(res);
						if(search_session_data.found_status == 'found'){
							jQuery('.ct-provider-list').show();
							var search_staff_id = search_session_data.staff_id;
							jQuery.ajax({
								type:"POST",
								url: ajax_url+"manual_booking_frontajax.php",
								data : {
									'staff_search' : search_staff_id,
									'get_search_staff_detail' : 1
								},
								success: function(res){
									jQuery('.provders-list').html(res);
								}
							});
						}else if(search_session_data.found_status == 'not found'){
							jQuery('.ct-provider-list').hide();
						}
					}
				});
            }else{
                jQuery('.show_single_service_method').html(methods_data.m_html);
				jQuery('.ct_method_tab-slider-tabs li:first').trigger('click');
				jQuery.ajax({
					type : 'post',
					data : {
						'service_id' : id,
						'staff_select_according_service' : 1
					},
					url : ajax_url+"manual_booking_frontajax.php",
					success : function(res){
						var search_session_data=jQuery.parseJSON(res);
						if(search_session_data.found_status == 'found'){
							jQuery('.ct-provider-list').show();
							var search_staff_id = search_session_data.staff_id;
							jQuery.ajax({
								type:"POST",
								url: ajax_url+"manual_booking_frontajax.php",
								data : {
									'staff_search' : search_staff_id,
									'get_search_staff_detail' : 1
								},
								success: function(res){
									jQuery('.provders-list').html(res);
								}
							});
                        }else if(search_session_data.found_status == 'not found'){
							jQuery('.ct-provider-list').hide();
						}
					}
				});
            }
        }
    });
	
	
	jQuery(document).on('click','.provider_select',function(){
		var site_url=siteurlObj.site_url;
		var staff_id = jQuery(this).data('id');
		
		jQuery.ajax({
			type : 'post',
			data : {
				'staff_id' : staff_id,
				'get_staff_sess' : 1
			},
			url : site_url+"front/manual_booking_firststep.php",
			success : function(res){
			}
		});
	});
	
    /* display all add-on of the selected services */
    jQuery.ajax({
        type : 'post',
        data : {
            'service_id' : id,
            'get_service_addons' : 1
        },
        url : ajax_url+"manual_booking_frontajax.php",
        success : function(res){
			jQuery('.ct-loading-main').hide();
            if(res=='Extra Services Not Available'){
                jQuery('.hide_allsss_addons').hide();
            }else{
                jQuery('.hide_allsss_addons').show();
                jQuery('.add_on_lists').html(res);
                jQuery('.add_minus_button').hide();
                jQuery('.add_addon_in_cart_for_multipleqty').each(function(){
                    var multiqty_addon_id = jQuery(this).data('id');
                    var value = jQuery(this).prop('checked');
                    if(value == true){
                        jQuery('#ct-addon-'+multiqty_addon_id).attr('checked', false);
                    }
                });
            }
        }
    });
});

jQuery(document).on('click','.addons_servicess_2',function(){
	var id = jQuery(this).data('id');
    jQuery('.add_minus_buttonid'+id).show();
    var m_name = jQuery(this).data('mnamee');
    var value = jQuery(this).prop('checked');

    if(value == false){
        jQuery('.qtyyy_'+m_name).val('1');
        var addon_id = jQuery(this).data('id');
        jQuery('#minus'+addon_id).trigger('click');
    }else if(value == true){
        var addon_id = jQuery(this).data('id');
        jQuery('#add'+addon_id).trigger('click');
    }
});
/* bedroom and bathroom counting for addons */
jQuery(document).on('click','.add',function(){
	jQuery('.freq_disc_empty_cart_error').hide();
    var site_url=siteurlObj.site_url;
    var ajax_url=ajaxurlObj.ajax_url;
    var ids = jQuery(this).data('ids');
    var db_qty = jQuery(this).data('db-qty');
    var service_id = jQuery(this).data('service_id');
    var method_id = jQuery(this).data('method_id');
    var method_name = jQuery(this).data('method_name');
    var units_id=jQuery(this).data('units_id');
    var type=jQuery(this).data('type');
    var m_name = jQuery(this).data('mnamee');

    jQuery('.coupon_display').hide();
    jQuery('.hide_coupon_textbox').show();
    jQuery('.ct-display-coupon-code').hide();
    jQuery('.coupon_invalid_error').hide();
    var frequently_discount_id=jQuery("input[name=frequently_discount_radio]:checked").data('id');
    var qty_val = parseInt(jQuery('.qtyyy_'+m_name).val());
    var qty_vals = qty_val+1;

    if(qty_val < db_qty){
        jQuery('.qtyyy_'+m_name).val(qty_vals);
        var final_qty_val = qty_vals;
        jQuery.ajax({
            type : 'post',
            data : {
                'addon_id' : ids,
                'qty_vals' : final_qty_val,
                's_addon_units_maxlimit_4_ratesss' : 1
            },
            url : ajax_url+"manual_booking_frontajax.php",
            success : function(res){
                jQuery('.data_addon_qtyrate').attr("data-rate",res);
                jQuery.ajax({
                    type : 'post',
                    data : {
                        'method_id' : method_id,
                        'service_id' : service_id,
                        's_m_qty' : final_qty_val,
                        's_m_rate' : res,
                        'method_name' : method_name,
                        'units_id' : units_id,
                        'frequently_discount_id' : frequently_discount_id,
                        'type' : type,
                        'add_to_cart' : 1
                    },
                    url : site_url+"front/manual_booking_firststep.php",
                    success : function(res){
                        jQuery('.freq_discount_display').show();
                        jQuery('.hide_right_side_box').show();
                        jQuery('.partial_amount_hide_on_load').show();
                        jQuery('.empty_cart_error').hide();
                        var cart_session_data=jQuery.parseJSON(res);
						jQuery('#no_units_in_cart_err').val(cart_session_data.unit_status);
						jQuery('#no_units_in_cart_err_count').val(cart_session_data.unit_require);
                        jQuery("#total_cart_count").val('2');
                        jQuery('.coupon_invalid_error').hide();
                        if(cart_session_data.status == 'update'){
                            jQuery( ".cart_empty_msg" ).hide();
                            jQuery('.update_qty_of_s_m_'+cart_session_data.method_name_without_space).html(cart_session_data.s_m_html);
                            jQuery('.update_qty_of_s_m_'+cart_session_data.method_name_without_space).val('data-service_id',service_id);
                            jQuery('.update_qty_of_s_m_'+cart_session_data.method_name_without_space).val('data-method_id',method_id);
                            jQuery('.update_qty_of_s_m_'+cart_session_data.method_name_without_space).val('data-units_id',units_id);
                            jQuery('.partial_amount').html(cart_session_data.partial_amount);
                            jQuery('.remain_amount').html(cart_session_data.remain_amount);
                            jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                            jQuery('.cart_discount').html('- '+cart_session_data.cart_discount);
                            jQuery('.cart_tax').html(cart_session_data.cart_tax);
                            jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                            jQuery('.cart_total').html(cart_session_data.total_amount);
                        }else if(cart_session_data.status == 'insert'){
                            jQuery( ".cart_empty_msg" ).hide();
                            jQuery('.cart_item_listing').append(cart_session_data.s_m_html);
                            jQuery('.partial_amount').html(cart_session_data.partial_amount);
                            jQuery('.remain_amount').html(cart_session_data.remain_amount);
                            jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                            jQuery('.cart_discount').html('- '+cart_session_data.cart_discount);
                            jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                            jQuery('.cart_tax').html(cart_session_data.cart_tax);
                            jQuery('.cart_total').html(cart_session_data.total_amount);
                        }else if(cart_session_data.status == 'firstinsert'){
                            jQuery( ".cart_empty_msg" ).hide();
                            jQuery('.cart_item_listing').append(cart_session_data.s_m_html);
                            jQuery('.partial_amount').html(cart_session_data.partial_amount);
                            jQuery('.remain_amount').html(cart_session_data.remain_amount);
                            jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                            jQuery('.cart_discount').html('- '+cart_session_data.cart_discount);
                            jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                            jQuery('.cart_tax').html(cart_session_data.cart_tax);
                            jQuery('.cart_total').html(cart_session_data.total_amount);
                        }else if(cart_session_data.status == 'empty calculation'){
                            jQuery('.freq_discount_display').hide();
                            jQuery('.partial_amount_hide_on_load').hide();
                            jQuery('.hide_right_side_box').hide();
                            jQuery( ".cart_empty_msg" ).show();
                            jQuery( ".cart_item_listing" ).empty();
                            jQuery( ".cart_sub_total" ).empty();
                            jQuery( ".cart_tax" ).empty();
                            jQuery( ".cart_total" ).empty();
                            jQuery('.frequent_discount').empty();
                            jQuery( ".remain_amount" ).empty();
                            jQuery( ".partial_amount" ).empty();
                            jQuery( ".cart_discount" ).empty();
                        }else if(cart_session_data.status == 'delete particuler'){
                            jQuery( ".cart_empty_msg" ).hide();
                            jQuery( ".update_qty_of_s_m_"+cart_session_data.method_name_without_space).remove();
                            jQuery('.partial_amount').html(cart_session_data.partial_amount);
                            jQuery('.remain_amount').html(cart_session_data.remain_amount);
                            jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                            jQuery('.cart_discount').html('- '+cart_session_data.cart_discount);
                            jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                            jQuery('.cart_tax').html(cart_session_data.cart_tax);
                            jQuery('.cart_total').html(cart_session_data.total_amount);
                        }
                    }
                });
            }
        });
    }else{
		jQuery('.ct-loading-main').hide();
        jQuery('.qtyyy_'+m_name).val(db_qty);
    }



});
jQuery(document).on('click','.minus',function(){
	jQuery('.freq_disc_empty_cart_error').hide();
    var site_url=siteurlObj.site_url;
    var ajax_url=ajaxurlObj.ajax_url;
    var ids = jQuery(this).data('ids');
    var service_id = jQuery(this).data('service_id');
    var method_id = jQuery(this).data('method_id');
    var method_name = jQuery(this).data('method_name');
    var m_name = jQuery(this).data('mnamee');
    var units_id=jQuery(this).data('units_id');

    jQuery('.coupon_display').hide();
    jQuery('.hide_coupon_textbox').show();
    jQuery('.ct-display-coupon-code').hide();
    jQuery('.coupon_invalid_error').hide();
    var type=jQuery(this).data('type');
    var frequently_discount_id=jQuery("input[name=frequently_discount_radio]:checked").data('id');
    var qty_val = parseInt(jQuery('.qtyyy_'+m_name).val());
    var qty_vals = qty_val-1;

    var currentVal = parseInt(jQuery('.qtyyy_'+m_name).val());

    if(currentVal <= 0){
		jQuery('.add_minus_buttonid'+units_id).hide();
        jQuery('.qtyyy_'+m_name).val('0');
        jQuery( ".update_qty_of_s_m_"+m_name).remove();
        jQuery('#ct-addon-'+units_id).attr('checked', false);
    }else if(currentVal > 0){
        jQuery('.qtyyy_'+m_name).val(qty_vals);
        jQuery.ajax({
            type : 'post',
            data : {
                'addon_id' : ids,
                'qty_vals' : qty_vals,
                's_addon_units_maxlimit_4_ratesss' : 1
            },
            url : ajax_url+"manual_booking_frontajax.php",
            success : function(res){
                jQuery('.data_addon_qtyrate').attr("data-rate",res);
                jQuery.ajax({
                    type : 'post',
                    data : {
                        'method_id' : method_id,
                        'service_id' : service_id,
                        's_m_qty' : qty_vals,
                        's_m_rate' : res,
                        'method_name' : method_name,
                        'units_id' : units_id,
                        'type' : type,
                        'frequently_discount_id' : frequently_discount_id,
                        'add_to_cart' : 1
                    },
                    url : site_url+"front/manual_booking_firststep.php",
                    success : function(res){
                        jQuery('.freq_discount_display').show();
                        jQuery('.hide_right_side_box').show();
                        jQuery('.partial_amount_hide_on_load').show();
                        jQuery('.empty_cart_error').hide();
                        jQuery("#total_cart_count").val('2');
                        jQuery('.coupon_invalid_error').hide();
                        var cart_session_data=jQuery.parseJSON(res);
						jQuery('#no_units_in_cart_err').val(cart_session_data.unit_status);
						jQuery('#no_units_in_cart_err_count').val(cart_session_data.unit_require);
                        if(cart_session_data.status == 'update'){
                            jQuery( ".cart_empty_msg" ).hide();
                            jQuery('.update_qty_of_s_m_'+cart_session_data.method_name_without_space).html(cart_session_data.s_m_html);
                            jQuery('.update_qty_of_s_m_'+cart_session_data.method_name_without_space).val('data-service_id',service_id);
                            jQuery('.update_qty_of_s_m_'+cart_session_data.method_name_without_space).val('data-method_id',method_id);
                            jQuery('.update_qty_of_s_m_'+cart_session_data.method_name_without_space).val('data-units_id',units_id);
                            jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                            jQuery('.partial_amount').html(cart_session_data.partial_amount);
                            jQuery('.remain_amount').html(cart_session_data.remain_amount);
                            jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                            jQuery('.cart_discount').html('- '+cart_session_data.cart_discount);
                            jQuery('.cart_tax').html(cart_session_data.cart_tax);
                            jQuery('.cart_total').html(cart_session_data.total_amount);
                        }else if(cart_session_data.status == 'insert'){
                            jQuery( ".cart_empty_msg" ).hide();
                            jQuery('.cart_item_listing').append(cart_session_data.s_m_html);
                            jQuery('.partial_amount').html(cart_session_data.partial_amount);
                            jQuery('.remain_amount').html(cart_session_data.remain_amount);
                            jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                            jQuery('.cart_discount').html('- '+cart_session_data.cart_discount);
                            jQuery('.cart_tax').html(cart_session_data.cart_tax);
                            jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                            jQuery('.cart_total').html(cart_session_data.total_amount);
                        }else if(cart_session_data.status == 'firstinsert'){
                            jQuery( ".cart_empty_msg" ).hide();
                            jQuery('.cart_item_listing').append(cart_session_data.s_m_html);
                            jQuery('.partial_amount').html(cart_session_data.partial_amount);
                            jQuery('.remain_amount').html(cart_session_data.remain_amount);
                            jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                            jQuery('.cart_discount').html('- '+cart_session_data.cart_discount);
                            jQuery('.cart_tax').html(cart_session_data.cart_tax);
                            jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                            jQuery('.cart_total').html(cart_session_data.total_amount);
                        }else if(cart_session_data.status == 'empty calculation'){
                            jQuery('.freq_discount_display').hide();
                            jQuery('.partial_amount_hide_on_load').hide();
                            jQuery('.hide_right_side_box').hide();
                            jQuery('.add_minus_button').hide();
                            jQuery('#ct-addon-'+units_id).attr('checked', false);
                            jQuery( ".cart_empty_msg" ).show();
                            jQuery( ".cart_item_listing" ).empty();
                            jQuery( ".cart_sub_total" ).empty();
                            jQuery( ".cart_tax" ).empty();
                            jQuery( ".frequent_discount" ).empty();
                            jQuery( ".cart_total" ).empty();
                            jQuery( ".remain_amount" ).empty();
                            jQuery( ".partial_amount" ).empty();
                            jQuery( ".cart_discount" ).empty();
                        }else if(cart_session_data.status == 'delete particuler'){
                            jQuery('.add_minus_buttonid'+units_id).hide();
                            jQuery('#ct-addon-'+units_id).attr('checked', false);
                            jQuery( ".cart_empty_msg" ).hide();
                            jQuery( ".update_qty_of_s_m_"+cart_session_data.method_name_without_space).remove();
                            jQuery('.partial_amount').html(cart_session_data.partial_amount);
                            jQuery('.remain_amount').html(cart_session_data.remain_amount);
                            jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                            jQuery('.cart_discount').html('- '+cart_session_data.cart_discount);
                            jQuery('.cart_tax').html(cart_session_data.cart_tax);
                            jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                            jQuery('.cart_total').html(cart_session_data.total_amount);
                        }
                    }
                });
            }
        });
    }
});


jQuery(document).on('click','.addons_servicess',function(){
	 var site_url=siteurlObj.site_url;
    var ajax_url=ajaxurlObj.ajax_url;
    var addon_id = jQuery(this).data('id');
    var status = jQuery(this).data('status');

    /*add to cart values */
    jQuery('.freq_disc_empty_cart_error').hide();
    var site_url=siteurlObj.site_url;
    var ajax_url=ajaxurlObj.ajax_url;
    var service_id=jQuery(this).data('service_id');
    var method_id=jQuery(this).data('method_id');
    var method_name=jQuery(this).data('method_name');
    var type='addon';
    var frequently_discount_id=jQuery("input[name=frequently_discount_radio]:checked").data('id');
    var m_name = jQuery(this).data('mnamee');
    /*end cart value */

    if(parseInt(status) == 2){
        jQuery(this).data('status','1');
        jQuery.ajax({
            type : 'post',
            data : {
                'addon_id' : addon_id,
                'get_service_addons_qtys' : 1
            },
            url : ajax_url+"manual_booking_frontajax.php",
            success : function(res){
                jQuery('.addons_counting').append(res);
            }
        });
    }else{
        jQuery(this).data('status','2');
        jQuery('.remove_addon_intensive'+addon_id).hide();
        jQuery.ajax({
            type : 'post',
            data : {
                'method_id' : method_id,
                'service_id' : service_id,
                's_m_qty' : 0,
                's_m_rate' : 0,
                'method_name' : method_name,
                'units_id' : addon_id,
                'type' : type,
                'frequently_discount_id' : frequently_discount_id,
                'add_to_cart' : 1
            },
            url : site_url+"front/manual_booking_firststep.php",
            success : function(res){
                jQuery('.freq_discount_display').show();
                jQuery('.hide_right_side_box').show();
                jQuery('.partial_amount_hide_on_load').show();
                jQuery('.empty_cart_error').hide();
                jQuery('.coupon_invalid_error').hide();
                jQuery("#total_cart_count").val('2');
				
				var cart_session_data=jQuery.parseJSON(res);
				jQuery('#no_units_in_cart_err').val(cart_session_data.unit_status);
				jQuery('#no_units_in_cart_err_count').val(cart_session_data.unit_require);
                if(cart_session_data.status == 'empty calculation'){
                    jQuery('.partial_amount_hide_on_load').hide();
                    jQuery('.hide_right_side_box').hide();
                    jQuery( ".cart_empty_msg" ).show();
                    jQuery( ".cart_item_listing" ).empty();
                    jQuery( ".cart_sub_total" ).empty();
                    jQuery( ".cart_tax" ).empty();
                    jQuery( ".cart_total" ).empty();
                    jQuery( ".frequent_discount" ).empty();
                    jQuery( ".remain_amount" ).empty();
                    jQuery( ".partial_amount" ).empty();
                    jQuery( ".cart_discount" ).empty();
                }else if(cart_session_data.status == 'delete particuler'){
                    jQuery( ".cart_empty_msg" ).hide();
                    jQuery( ".update_qty_of_s_m_"+m_name).remove();
                    jQuery('.partial_amount').html(cart_session_data.partial_amount);
                    jQuery('.remain_amount').html(cart_session_data.remain_amount);
                    jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                    jQuery('.cart_discount').html('- '+cart_session_data.cart_discount);
                    jQuery('.cart_tax').html(cart_session_data.cart_tax);
                    jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                    jQuery('.cart_total').html(cart_session_data.total_amount);
                }
            }
        });
    }

});


/* new existing user */

/* ct_user_radio_group */

jQuery(document).on("change",".existing-user",function() {
    if(jQuery('.existing-user').is(':checked')) {
        jQuery('.ct-login-existing').show( "blind", {direction: "vertical"}, 700);
        jQuery('.ct-new-user-details').hide( "blind", {direction: "vertical"}, 300);
        jQuery('.ct-peronal-details').hide( "blind", {direction: "vertical"}, 300);
    }
});
jQuery(document).on("change",".new-user",function() {
    if(jQuery('.new-user').is(':checked')) {
        jQuery('.ct-new-user-details').show( "blind", {direction: "vertical"}, 700);
        jQuery('.ct-login-existing').hide( "blind", {direction: "vertical"}, 300);
        jQuery('.ct-peronal-details').show( "blind", {direction: "vertical"}, 300);

    }
});


/*frequently_discount*/

jQuery(document).on('click','.cart_frequently_discount',function(){
	jQuery('.ct-loading-main').show();
    jQuery('.freq_disc_empty_cart_error').hide();
    var discountname = jQuery(this).data('name');
    jQuery('.f_discount_name').html(discountname);

    var site_url=siteurlObj.site_url;
    var ajax_url=ajaxurlObj.ajax_url;
    var frequently_discount_id=jQuery(this).data('id');
    var sub_total_check = jQuery('.cart_sub_total').text();

    if(sub_total_check !=''){
        jQuery.ajax({
            type:"POST",
            url: site_url+"front/manual_booking_firststep.php",
            data : {
                'frequently_discount_id' : frequently_discount_id,
                'frequently_discount_check' : 1
            },
            success: function(res){
				jQuery('.ct-loading-main').hide();
                var cart_session_data=jQuery.parseJSON(res);
                jQuery('.freq_discount_display').show();
                jQuery('.ct-display-coupon-code').hide();
                jQuery('.hide_coupon_textbox').show();
                jQuery('.coupon_display').hide();
                jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                jQuery('.partial_amount').html(cart_session_data.partial_amount);
                jQuery('.remain_amount').html(cart_session_data.remain_amount);
                jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                jQuery('.cart_tax').html(cart_session_data.cart_tax);
                jQuery('.cart_total').html(cart_session_data.total_amount);
            }
        });
    }else{
		jQuery('.ct-loading-main').hide();
        jQuery( ".cart_item_listing" ).empty();
        jQuery( ".cart_sub_total" ).empty();
        jQuery( ".cart_tax" ).empty();
        jQuery( ".frequent_discount" ).empty();
        jQuery( ".cart_total" ).empty();
        jQuery( ".remain_amount" ).empty();
        jQuery( ".partial_amount" ).empty();
        jQuery( ".cart_discount" ).empty();
        jQuery('.freq_disc_empty_cart_error').show();
        jQuery('.freq_disc_empty_cart_error').html(errorobj_your_cart_is_empty_please_add_cleaning_services);
    }
});



jQuery(document).on("click","#contact_status",function() {
    var contact_status = jQuery("#contact_status").val();
    if(contact_status == 'Other'){
        jQuery(".ct-option-others").show();
    }else{
        jQuery(".ct-option-others").hide();
    }
});


/******* Service method - display design according to admin selection ******/
jQuery(document).on('click','.s_m_units_design',function(){
	jQuery('.ct-loading-main').show();
    jQuery('.addons_servicess').each(function(){
        jQuery(this).data('status','2');
        var value = jQuery(this).prop('checked');
        if(value == true){
            jQuery('#ct-addon-'+jQuery(this).data('id')).attr('checked', false);
        }
        jQuery('.remove_addon_intensive'+jQuery(this).data('id')).hide();
    });
    jQuery('.freq_discount_display').hide();
    jQuery( ".cart_empty_msg" ).show();
    jQuery('.partial_amount_hide_on_load').hide();
    jQuery('.hide_right_side_box').hide();
    if(jQuery('.service-method-name').text() != 'Service Usage Methods'){
        jQuery('.method_not_selected_error').attr('style','');
        jQuery('.empty_cart_error').css('display','block');
        jQuery('.empty_cart_error').css('color','red');
        jQuery('.empty_cart_error').html(errorobj_please_select_units_or_addons);
    }
    jQuery('.add_addon_in_cart_for_multipleqty').each(function(){
        var multiqty_addon_id = jQuery(this).data('id');
        var value = jQuery(this).prop('checked');
        if(value == true){
            jQuery('#ct-addon-'+multiqty_addon_id).attr('checked', false);
        }
    });

    jQuery('.addon_qty').each(function(){
        jQuery(this).val(0);
        jQuery('.add_minus_button').hide();
        jQuery('.addons_servicess_2').attr('checked', false);
    });
    jQuery('.freq_disc_empty_cart_error').hide();
    jQuery('.add_addon_in_cart_for_multipleqty').data('status','2');
    var site_url=siteurlObj.site_url;
    var ajax_url=ajaxurlObj.ajax_url;
    var id = jQuery(this).data('id');
    var method_id = jQuery(this).data('id');
    var service_id = jQuery(this).data('service_id');
    jQuery.ajax({
        type : 'post',
        data : {
            'service_methods_id' : id,
            'select_s_m_units_design' : 1
        },
        url : ajax_url+"manual_booking_frontajax.php",
        success : function(response){
			jQuery('.ct-loading-main').hide();
            if(response == 1){
                jQuery( ".cart_item_listing" ).empty();
                jQuery( ".cart_sub_total" ).empty();
                jQuery( ".cart_tax" ).empty();
                jQuery( ".cart_total" ).empty();
                jQuery( ".frequent_discount" ).empty();
                jQuery( ".remain_amount" ).empty();
                jQuery( ".partial_amount" ).empty();
                jQuery( ".cart_discount" ).empty();
                jQuery('.coupon_display').hide();
                jQuery('.s_m_units_design_1').show();
                jQuery('.s_m_units_design_2').hide();
                jQuery('.s_m_units_design_3').hide();
                jQuery('.s_m_units_design_4').hide();
                jQuery('.s_m_units_design_5').hide();
                jQuery.ajax({
                    type : 'post',
                    data : {
                        'method_id' : method_id,
                        'service_id' : service_id,
                        's_m_units_maxlimit' : 1
                    },
                    url : ajax_url+"manual_booking_frontajax.php",
                    success : function(response){
                        jQuery('.duration_hrs').html(response);
                    }
                });
            }else if(response == 2){
                jQuery( ".cart_item_listing" ).empty();
                jQuery( ".cart_sub_total" ).empty();
                jQuery( ".cart_tax" ).empty();
                jQuery( ".cart_total" ).empty();
                jQuery( ".remain_amount" ).empty();
                jQuery( ".frequent_discount" ).empty();
                jQuery( ".partial_amount" ).empty();
                jQuery( ".cart_discount" ).empty();
                jQuery('.coupon_display').hide();
                jQuery('.s_m_units_design_1').hide();
                jQuery('.s_m_units_design_2').show();
                jQuery('.s_m_units_design_3').hide();
                jQuery('.s_m_units_design_4').hide();
                jQuery('.s_m_units_design_5').hide();
                jQuery.ajax({
                    type : 'post',
                    data : {
                        'method_id' : method_id,
                        'service_id' : service_id,
                        's_m_units_maxlimit_2' : 1
                    },
                    url : ajax_url+"manual_booking_frontajax.php",
                    success : function(res){
                        jQuery('.ser_design_2_units').html(res);
                    }
                });
            }else if(response == 3){
                jQuery( ".cart_item_listing" ).empty();
                jQuery( ".cart_sub_total" ).empty();
                jQuery( ".cart_tax" ).empty();
                jQuery( ".cart_total" ).empty();
                jQuery( ".remain_amount" ).empty();
                jQuery( ".partial_amount" ).empty();
                jQuery( ".frequent_discount" ).empty();
                jQuery( ".cart_discount" ).empty();
                jQuery('.coupon_display').hide();
                jQuery('.s_m_units_design_1').hide();
                jQuery('.s_m_units_design_2').hide();
                jQuery('.s_m_units_design_3').show();
                jQuery('.s_m_units_design_4').hide();
                jQuery('.s_m_units_design_5').hide();
                jQuery.ajax({
                    type : 'post',
                    data : {
                        'method_id' : method_id,
                        'service_id' : service_id,
                        's_m_units_maxlimit_3' : 1
                    },
                    url : ajax_url+"manual_booking_frontajax.php",
                    success : function(res){
                        jQuery('.ser_design_3_units').html(res);
                    }
                });
            }else if(response == 4){
                jQuery( ".cart_item_listing" ).empty();
                jQuery( ".cart_sub_total" ).empty();
                jQuery( ".cart_tax" ).empty();
                jQuery( ".cart_total" ).empty();
                jQuery( ".remain_amount" ).empty();
                jQuery( ".frequent_discount" ).empty();
                jQuery( ".partial_amount" ).empty();
                jQuery( ".cart_discount" ).empty();
                jQuery('.coupon_display').hide();
                jQuery('.s_m_units_design_1').hide();
                jQuery('.s_m_units_design_2').hide();
                jQuery('.s_m_units_design_3').hide();
                jQuery('.s_m_units_design_4').show();
                jQuery('.s_m_units_design_5').hide();
                jQuery.ajax({
                    type : 'post',
                    data : {
                        'method_id' : method_id,
                        'service_id' : service_id,
                        's_m_units_maxlimit_4' : 1
                    },
                    url : ajax_url+"manual_booking_frontajax.php",
                    success : function(res){
                        jQuery('.ser_design_4_units').html(res);
                    }
                });
            }else if(response == 5){
                jQuery( ".cart_item_listing" ).empty();
                jQuery( ".cart_sub_total" ).empty();
                jQuery( ".cart_tax" ).empty();
                jQuery( ".cart_total" ).empty();
                jQuery( ".remain_amount" ).empty();
                jQuery( ".frequent_discount" ).empty();
                jQuery( ".partial_amount" ).empty();
                jQuery( ".cart_discount" ).empty();
                jQuery('.coupon_display').hide();
                jQuery('.s_m_units_design_1').hide();
                jQuery('.s_m_units_design_2').hide();
                jQuery('.s_m_units_design_3').hide();
                jQuery('.s_m_units_design_4').hide();
                jQuery('.s_m_units_design_5').show();
                jQuery.ajax({
                    type : 'post',
                    data : {
                        'method_id' : method_id,
                        'service_id' : service_id,
                        's_m_units_maxlimit_5' : 1
                    },
                    url : ajax_url+"manual_booking_frontajax.php",
                    success : function(res){
                        jQuery('.ser_design_5_units').html(res);
                    }
                });
            }
        }
    });
});

/* service checkbox */

jQuery(document).ready(function(){
    jQuery("input[name=service-radio]").click(function() {
        /*  jQuery(".ct-meth-unit-count").show( "blind", {direction: "vertical"}, 700 ); */
    });
});


/* bedrooms dropdown show hide list */
jQuery(document).on("click",".select-bedrooms",function() {
    var unit_id= jQuery(this).data('un_id');
    jQuery(".ct-"+unit_id+"-dropdown").toggle( "blind", {direction: "vertical"}, 300 );
});

/* select on click on bedroom */
jQuery(document).on("click",".select_bedroom",function() {
    var units_id= jQuery(this).data('units_id');
    jQuery('#ct_selected_'+units_id).html(jQuery(this).html());
    jQuery(".ct-"+units_id+"-dropdown").hide( "blind", {direction: "vertical"}, 300 );
});



jQuery(document).on("click",".select-language",function() {
    jQuery(".ct-language-dropdown").toggle( "blind", {direction: "vertical"}, 300 );
});
jQuery(document).on("click",".select_language_view",function() {
	var ajax_url=ajaxurlObj.ajax_url;
    jQuery('#ct_selected_language').html(jQuery(this).html());
    jQuery(".ct-language-dropdown").hide( "blind", {direction: "vertical"}, 300 );
	jQuery.ajax({
		type : 'POST',
		data : {'select_language' : "yes","set_language" : jQuery(this).data("langs")},
		url : ajax_url+"manual_booking_frontajax.php",
		success : function(res){
			location.reload();
		}
	});
});


/* remove item btn-from the cart */
jQuery(document).on("click",".remove_item_from_cart",function() {
	var ajax_url=ajaxurlObj.ajax_url;
	var m_name = jQuery(this).data('mnamee');
	var unit_id = jQuery(this).data('units_id');
	var frequently_discount = jQuery("input[name=frequently_discount_radio]:checked").data('id');
	jQuery.ajax({
		type : 'POST',
		data : {
			'cart_unit_id' : unit_id,
			'frequently_discount_id' : frequently_discount,
			'cart_item_remove' : 1
			},
		url : ajax_url+"manual_booking_frontajax.php",
		success : function(res){
			var cart_session_data=jQuery.parseJSON(res);
			
			jQuery('.select-bedrooms').each( function(){
				if(jQuery(this).data('un_id') == unit_id){
					var dd_default_title = jQuery(this).data('un_title');
					jQuery('#ct_selected_'+unit_id+' .ct-count').html(dd_default_title);
				}
			});
			
			jQuery('.u_'+unit_id+'_btn').removeClass('ct-bed-selected');
			
			jQuery('#ct_area_m_units').val('');
			
			jQuery('.qtyyy_ad_unit'+unit_id).val('0');
			jQuery('.add_minus_buttonid'+unit_id).hide();
			
			jQuery('#qty'+unit_id).val('0');
			
			jQuery('#ct-addon-'+unit_id).data('status','2');
			jQuery('#ct-addon-'+unit_id).prop('checked',false);
			
			if(cart_session_data.status == 'empty calculation'){
				jQuery("#total_cart_count").val('1');
                jQuery('.freq_discount_display').hide();
                jQuery('.partial_amount_hide_on_load').hide();
                jQuery('.hide_right_side_box').hide();
                jQuery( ".cart_empty_msg" ).show();
                jQuery( ".cart_item_listing" ).empty();
                jQuery( ".cart_sub_total" ).empty();
                jQuery( ".cart_tax" ).empty();
                jQuery( ".cart_total" ).empty();
                jQuery( ".remain_amount" ).empty();
                jQuery( ".partial_amount" ).empty();
                jQuery( ".cart_discount" ).empty();
                jQuery('.frequent_discount').empty();
			}else{
				jQuery("#total_cart_count").val('2');
				jQuery( ".cart_empty_msg" ).hide();
				jQuery( ".update_qty_of_s_m_"+m_name).remove();
				jQuery('.partial_amount').html(cart_session_data.partial_amount);
				jQuery('.remain_amount').html(cart_session_data.remain_amount);
				jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
				jQuery('.cart_discount').html('- '+cart_session_data.cart_discount);
				jQuery('.cart_tax').html(cart_session_data.cart_tax);
				jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
				jQuery('.cart_total').html(cart_session_data.total_amount);
			}
		}
	});
   
});


/* bedroom counting */

jQuery(document).on("click",".select_m_u_btn",function() {
   var units_id= jQuery(this).data('units_id');
    jQuery('.u_'+units_id+'_btn').each(function(){
        jQuery(this).removeClass('ct-bed-selected');
    });
    jQuery(this).addClass('ct-bed-selected');
});


/* bedroom and bathroom counting */
jQuery(document).on('click','.addd',function(){
	jQuery('.freq_disc_empty_cart_error').hide();
    var site_url=siteurlObj.site_url;
    var ajax_url=ajaxurlObj.ajax_url;
    var ids = jQuery(this).data('ids');
    var db_qty = jQuery(this).data('db-qty');
    var service_id = jQuery(this).data('service_id');
    var method_id = jQuery(this).data('method_id');
    var method_name = jQuery(this).data('method_name');
    var units_id=jQuery(this).data('units_id');
    var type=jQuery(this).data('type');
    var m_name = jQuery(this).data('mnamee');
    jQuery('.coupon_display').hide();
    jQuery('.hide_coupon_textbox').show();
    jQuery('.ct-display-coupon-code').hide();
    jQuery('.coupon_invalid_error').hide();
    var frequently_discount_id=jQuery("input[name=frequently_discount_radio]:checked").data('id');
    var qty_val = parseInt(jQuery('#qty'+ids).val());
    var qty_vals = qty_val+1;

    if(qty_val < db_qty){
        jQuery('.qty'+ids).val(qty_vals);
        var final_qty_val = qty_vals;
        jQuery.ajax({
            type : 'post',
            data : {
                'method_id' : method_id,
                'service_id' : service_id,
                'units_id' : units_id,
                'qty_vals' : final_qty_val,
                's_m_units_maxlimit_4_ratesss' : 1
            },
            url : ajax_url+"manual_booking_frontajax.php",
            success : function(res){
				jQuery('.data_qtyrate').attr("data-rate",res);
                jQuery.ajax({
                    type : 'post',
                    data : {
                        'method_id' : method_id,
                        'service_id' : service_id,
                        's_m_qty' : final_qty_val,
                        's_m_rate' : res,
                        'method_name' : method_name,
                        'units_id' : units_id,
                        'frequently_discount_id' : frequently_discount_id,
                        'type' : type,
                        'add_to_cart' : 1
                    },
                    url : site_url+"front/manual_booking_firststep.php",
                    success : function(res){
                        jQuery('.freq_discount_display').show();
                        jQuery('.hide_right_side_box').show();
                        jQuery('.partial_amount_hide_on_load').show();
                        jQuery('.empty_cart_error').hide();
						jQuery('.no_units_in_cart_error').hide();
                        jQuery('.coupon_invalid_error').hide();
                        jQuery("#total_cart_count").val('2');
                        var cart_session_data=jQuery.parseJSON(res);
						jQuery('#no_units_in_cart_err').val(cart_session_data.unit_status);
						jQuery('#no_units_in_cart_err_count').val(cart_session_data.unit_require);
                        if(cart_session_data.status == 'update'){
                            jQuery( ".cart_empty_msg" ).hide();
                            jQuery('.update_qty_of_s_m_'+cart_session_data.method_name_without_space).html(cart_session_data.s_m_html);
                            jQuery('.update_qty_of_s_m_'+cart_session_data.method_name_without_space).val('data-service_id',service_id);
                            jQuery('.update_qty_of_s_m_'+cart_session_data.method_name_without_space).val('data-method_id',method_id);
                            jQuery('.update_qty_of_s_m_'+cart_session_data.method_name_without_space).val('data-units_id',units_id);
                            jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                            jQuery('.partial_amount').html(cart_session_data.partial_amount);
                            jQuery('.remain_amount').html(cart_session_data.remain_amount);
                            jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                            jQuery('.cart_discount').html('- '+cart_session_data.cart_discount);
                            jQuery('.cart_tax').html(cart_session_data.cart_tax);
                            jQuery('.cart_total').html(cart_session_data.total_amount);
                        }else if(cart_session_data.status == 'insert'){
                            jQuery( ".cart_empty_msg" ).hide();
                            jQuery('.cart_item_listing').append(cart_session_data.s_m_html);
                            jQuery('.partial_amount').html(cart_session_data.partial_amount);
                            jQuery('.remain_amount').html(cart_session_data.remain_amount);
                            jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                            jQuery('.cart_discount').html('- '+cart_session_data.cart_discount);
                            jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                            jQuery('.cart_tax').html(cart_session_data.cart_tax);
                            jQuery('.cart_total').html(cart_session_data.total_amount);
                        }else if(cart_session_data.status == 'firstinsert'){
                            jQuery( ".cart_empty_msg" ).hide();
                            jQuery('.cart_item_listing').append(cart_session_data.s_m_html);
                            jQuery('.partial_amount').html(cart_session_data.partial_amount);
                            jQuery('.remain_amount').html(cart_session_data.remain_amount);
                            jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                            jQuery('.cart_discount').html('- '+cart_session_data.cart_discount);
                            jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                            jQuery('.cart_tax').html(cart_session_data.cart_tax);
                            jQuery('.cart_total').html(cart_session_data.total_amount);
                        }else if(cart_session_data.status == 'empty calculation'){
                            jQuery('.freq_discount_display').hide();
                            jQuery('.partial_amount_hide_on_load').hide();
                            jQuery('.hide_right_side_box').hide();
                            jQuery( ".cart_empty_msg" ).show();
                            jQuery( ".frequent_discount" ).empty();
                            jQuery( ".cart_item_listing" ).empty();
                            jQuery( ".cart_sub_total" ).empty();
                            jQuery( ".cart_tax" ).empty();
                            jQuery( ".cart_total" ).empty();
                            jQuery( ".remain_amount" ).empty();
                            jQuery( ".partial_amount" ).empty();
                            jQuery( ".cart_discount" ).empty();
                        }else if(cart_session_data.status == 'delete particuler'){
                            jQuery( ".cart_empty_msg" ).hide();
                            jQuery( ".update_qty_of_s_m_"+m_name).remove();
                            jQuery('.partial_amount').html(cart_session_data.partial_amount);
                            jQuery('.remain_amount').html(cart_session_data.remain_amount);
                            jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                            jQuery('.cart_discount').html('- '+cart_session_data.cart_discount);
                            jQuery('.cart_tax').html(cart_session_data.cart_tax);
                            jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                            jQuery('.cart_total').html(cart_session_data.total_amount);
                        }
                    }
                });
            }
        });
    }else{
		jQuery('.ct-loading-main').hide();
        jQuery('.qty'+ids).val(db_qty);
    }

});
jQuery(document).on('click','.minuss',function(){
	jQuery('.freq_disc_empty_cart_error').hide();
    var site_url=siteurlObj.site_url;
    var ajax_url=ajaxurlObj.ajax_url;
    var ids = jQuery(this).data('ids');
    var service_id = jQuery(this).data('service_id');
    var method_id = jQuery(this).data('method_id');
    var method_name = jQuery(this).data('method_name');
    var qty_val = parseInt(jQuery('#qty'+ids).val());
    var qty_vals = qty_val-1;
    var units_id=jQuery(this).data('units_id');
    var type=jQuery(this).data('type');
    var frequently_discount_id=jQuery("input[name=frequently_discount_radio]:checked").data('id');
    jQuery('.coupon_display').hide();
    jQuery('.hide_coupon_textbox').show();
    jQuery('.ct-display-coupon-code').hide();
    jQuery('.coupon_invalid_error').hide();
    var currentVal = parseInt(jQuery('.qty'+ids).val());
    var m_name = jQuery(this).data('mnamee');

    if(currentVal <= 0){
		jQuery('.ct-loading-main').hide();
        jQuery('.qty'+ids).val('0');
        jQuery( ".update_qty_of_s_m_"+m_name).remove();
    }else if(currentVal > 0){
        jQuery('.qty'+ids).val(qty_vals);
        jQuery.ajax({
            type : 'post',
            data : {
                'method_id' : method_id,
                'service_id' : service_id,
                'qty_vals' : qty_vals,
                'units_id' : units_id,
                's_m_units_maxlimit_4_ratesss' : 1
            },
            url : ajax_url+"manual_booking_frontajax.php",
            success : function(res){
                jQuery('.data_qtyrate').attr("data-rate",res);
                jQuery.ajax({
                    type : 'post',
                    data : {
                        'method_id' : method_id,
                        'service_id' : service_id,
                        's_m_qty' : qty_vals,
                        's_m_rate' : res,
                        'method_name' : method_name,
                        'units_id' : units_id,
                        'type' : type,
                        'frequently_discount_id' : frequently_discount_id,
                        'add_to_cart' : 1
                    },
                    url : site_url+"front/manual_booking_firststep.php",
                    success : function(res){
                        jQuery('.freq_discount_display').show();
                        jQuery('.hide_right_side_box').show();
                        jQuery('.partial_amount_hide_on_load').show();
                        jQuery('.empty_cart_error').hide();
						jQuery('.no_units_in_cart_error').hide();
                        jQuery('.coupon_invalid_error').hide();
                        jQuery("#total_cart_count").val('2');
                        var cart_session_data=jQuery.parseJSON(res);
						jQuery('#no_units_in_cart_err').val(cart_session_data.unit_status);
						jQuery('#no_units_in_cart_err_count').val(cart_session_data.unit_require);
                        if(cart_session_data.status == 'update'){
                            jQuery( ".cart_empty_msg" ).hide();
                            jQuery('.update_qty_of_s_m_'+cart_session_data.method_name_without_space).html(cart_session_data.s_m_html);
                            jQuery('.update_qty_of_s_m_'+cart_session_data.method_name_without_space).val('data-service_id',service_id);
                            jQuery('.update_qty_of_s_m_'+cart_session_data.method_name_without_space).val('data-method_id',method_id);
                            jQuery('.update_qty_of_s_m_'+cart_session_data.method_name_without_space).val('data-units_id',units_id);
                            jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                            jQuery('.partial_amount').html(cart_session_data.partial_amount);
                            jQuery('.remain_amount').html(cart_session_data.remain_amount);
                            jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                            jQuery('.cart_discount').html('- '+cart_session_data.cart_discount);
                            jQuery('.cart_tax').html(cart_session_data.cart_tax);
                            jQuery('.cart_total').html(cart_session_data.total_amount);
                        }else if(cart_session_data.status == 'insert'){
                            jQuery( ".cart_empty_msg" ).hide();
                            jQuery('.cart_item_listing').append(cart_session_data.s_m_html);
                            jQuery('.partial_amount').html(cart_session_data.partial_amount);
                            jQuery('.remain_amount').html(cart_session_data.remain_amount);
                            jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                            jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                            jQuery('.cart_discount').html('- '+cart_session_data.cart_discount);
                            jQuery('.cart_tax').html(cart_session_data.cart_tax);
                            jQuery('.cart_total').html(cart_session_data.total_amount);
                        }else if(cart_session_data.status == 'firstinsert'){
                            jQuery( ".cart_empty_msg" ).hide();
                            jQuery('.cart_item_listing').append(cart_session_data.s_m_html);
                            jQuery('.partial_amount').html(cart_session_data.partial_amount);
                            jQuery('.remain_amount').html(cart_session_data.remain_amount);
                            jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                            jQuery('.cart_discount').html('- '+cart_session_data.cart_discount);
                            jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                            jQuery('.cart_tax').html(cart_session_data.cart_tax);
                            jQuery('.cart_total').html(cart_session_data.total_amount);
                        }else if(cart_session_data.status == 'empty calculation'){
                            jQuery('.freq_discount_display').hide();
                            jQuery('.partial_amount_hide_on_load').hide();
                            jQuery('.hide_right_side_box').hide();
                            jQuery( ".cart_empty_msg" ).show();
                            jQuery( ".cart_item_listing" ).empty();
                            jQuery( ".cart_sub_total" ).empty();
                            jQuery( ".frequent_discount" ).empty();
                            jQuery( ".cart_tax" ).empty();
                            jQuery( ".cart_total" ).empty();
                            jQuery( ".remain_amount" ).empty();
                            jQuery( ".partial_amount" ).empty();
                            jQuery( ".cart_discount" ).empty();
                        }else if(cart_session_data.status == 'delete particuler'){
                            jQuery( ".cart_empty_msg" ).hide();
                            jQuery( ".update_qty_of_s_m_"+cart_session_data.method_name_without_space).remove();
                            jQuery('.partial_amount').html(cart_session_data.partial_amount);
                            jQuery('.remain_amount').html(cart_session_data.remain_amount);
                            jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                            jQuery('.cart_discount').html('- '+cart_session_data.cart_discount);
                            jQuery('.cart_tax').html(cart_session_data.cart_tax);
                            jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                            jQuery('.cart_total').html(cart_session_data.total_amount);
                        }
                    }
                });
            }
        });
    }
});

jQuery(document).on('keyup','#ct_area_m_units',function(event){
	jQuery('.freq_disc_empty_cart_error').hide();
    jQuery('.error_of_invalid_area').hide();
    var site_url=siteurlObj.site_url;
    var ajax_url=ajaxurlObj.ajax_url;
    var area_uniit = jQuery( "#ct_area_m_units" ).val();
    var service_id = jQuery(this).data('service_id');
    var method_id = jQuery(this).data('method_id');
    var max_limitts = jQuery(this).data('maxx_limit');
    var method_name = jQuery(this).data('method_name');
    var units_id=jQuery(this).data('units_id');
    var type=jQuery(this).data('type');
    var frequently_discount_id=jQuery("input[name=frequently_discount_radio]:checked").data('id');
    jQuery('.coupon_display').hide();
    jQuery('.hide_coupon_textbox').show();
    jQuery('.ct-display-coupon-code').hide();
    jQuery('.coupon_invalid_error').hide();
    var m_name = jQuery(this).data('mnamee');
    var Number = /^[0-9]+$/;

    if(event.which == 8){
		jQuery(".error_of_invalid_area").hide();
        jQuery(".error_of_max_limitss").hide();
    }
	if(/^[0-9]+$/.test(area_uniit) == false) {
		jQuery(".error_of_invalid_area").show();
        jQuery('.error_of_invalid_area').html('Invalid '+method_name);
    }
    if(area_uniit == ''){
        jQuery.ajax({
            type : 'post',
            data : {
                'method_id' : method_id,
                'service_id' : service_id,
                's_m_qty' : 0,
                's_m_rate' : 0,
                'method_name' : method_name,
                'units_id' : units_id,
                'type' : type,
                'frequently_discount_id' : frequently_discount_id,
                'add_to_cart' : 1
            },
            url : site_url+"front/manual_booking_firststep.php",
            success : function(res){
                jQuery('.freq_discount_display').show();
                jQuery('.hide_right_side_box').show();
                jQuery('.partial_amount_hide_on_load').show();
                jQuery('.empty_cart_error').hide();
				jQuery('.no_units_in_cart_error').hide();
                jQuery('.coupon_invalid_error').hide();
                jQuery("#total_cart_count").val('2');
                var cart_session_data=jQuery.parseJSON(res);
				jQuery('#no_units_in_cart_err').val(cart_session_data.unit_status);
				jQuery('#no_units_in_cart_err_count').val(cart_session_data.unit_require);
                if(cart_session_data.status == 'empty calculation'){
                    jQuery('.freq_discount_display').hide();
                    jQuery('.partial_amount_hide_on_load').hide();
                    jQuery('.hide_right_side_box').hide();
                    jQuery( ".cart_empty_msg" ).show();
                    jQuery( ".cart_item_listing" ).empty();
                    jQuery( ".frequent_discount" ).empty();
                    jQuery( ".cart_sub_total" ).empty();
                    jQuery( ".cart_tax" ).empty();
                    jQuery( ".cart_total" ).empty();
                    jQuery( ".remain_amount" ).empty();
                    jQuery( ".partial_amount" ).empty();
                    jQuery( ".cart_discount" ).empty();
                }else if(cart_session_data.status == 'delete particuler'){
                    jQuery( ".cart_empty_msg" ).hide();
                    jQuery( ".update_qty_of_s_m_"+m_name).remove();
                    jQuery('.partial_amount').html(cart_session_data.partial_amount);
                    jQuery('.remain_amount').html(cart_session_data.remain_amount);
                    jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                    jQuery('.cart_discount').html('- '+cart_session_data.cart_discount);
                    jQuery('.cart_tax').html(cart_session_data.cart_tax);
                    jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                    jQuery('.cart_total').html(cart_session_data.total_amount);
                }
            }
        });
    }else if(area_uniit == 0){
		jQuery(".error_of_invalid_area").show();
        jQuery('.error_of_invalid_area').html('Invalid '+method_name);
    }else if(area_uniit > max_limitts){
		jQuery(".error_of_max_limitss").show();
        jQuery('.error_of_max_limitss').html('Max Limit Reached');
    }else if(area_uniit <= max_limitts){
        if(area_uniit.match(Number)){
            jQuery.ajax({
                type : 'post',
                data : {
                    'method_id' : method_id,
                    'service_id' : service_id,
                    'units_id' : units_id,
                    'qty_vals' : area_uniit,
                    's_m_units_maxlimit_4_ratesss' : 1
                },
                url : ajax_url+"manual_booking_frontajax.php",
                success : function(res){
                    jQuery('.ct_area_m_units_rattee').attr("data-rate",res);
                    jQuery.ajax({
                        type : 'post',
                        data : {
                            'method_id' : method_id,
                            'service_id' : service_id,
                            's_m_qty' : area_uniit,
                            's_m_rate' : res,
                            'method_name' : method_name,
                            'units_id' : units_id,
                            'type' : type,
                            'frequently_discount_id' : frequently_discount_id,
                            'add_to_cart' : 1
                        },
                        url : site_url+"front/manual_booking_firststep.php",
                        success : function(res){
                            jQuery('.freq_discount_display').show();
                            jQuery('.hide_right_side_box').show();
                            jQuery('.partial_amount_hide_on_load').show();
                            jQuery('.empty_cart_error').hide();
							jQuery('.no_units_in_cart_error').hide();
                            jQuery('.coupon_invalid_error').hide();
                            jQuery("#total_cart_count").val('2');
                            var cart_session_data=jQuery.parseJSON(res);
							jQuery('#no_units_in_cart_err').val(cart_session_data.unit_status);
							jQuery('#no_units_in_cart_err_count').val(cart_session_data.unit_require);
                            if(cart_session_data.status == 'update'){
                                jQuery( ".cart_empty_msg" ).hide();
                                jQuery('.update_qty_of_s_m_'+cart_session_data.method_name_without_space).html(cart_session_data.s_m_html);
                                jQuery('.update_qty_of_s_m_'+cart_session_data.method_name_without_space).val('data-service_id',service_id);
                                jQuery('.update_qty_of_s_m_'+cart_session_data.method_name_without_space).val('data-method_id',method_id);
                                jQuery('.update_qty_of_s_m_'+cart_session_data.method_name_without_space).val('data-units_id',units_id);
                                jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                                jQuery('.partial_amount').html(cart_session_data.partial_amount);
                                jQuery('.remain_amount').html(cart_session_data.remain_amount);
                                jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                                jQuery('.cart_discount').html('- '+cart_session_data.cart_discount);
                                jQuery('.cart_tax').html(cart_session_data.cart_tax);
                                jQuery('.cart_total').html(cart_session_data.total_amount);
                            }else if(cart_session_data.status == 'insert'){
                                jQuery( ".cart_empty_msg" ).hide();
                                jQuery('.cart_item_listing').append(cart_session_data.s_m_html);
                                jQuery('.partial_amount').html(cart_session_data.partial_amount);
                                jQuery('.remain_amount').html(cart_session_data.remain_amount);
                                jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                                jQuery('.cart_discount').html('- '+cart_session_data.cart_discount);
                                jQuery('.cart_tax').html(cart_session_data.cart_tax);
                                jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                                jQuery('.cart_total').html(cart_session_data.total_amount);
                            }else if(cart_session_data.status == 'firstinsert'){
                                jQuery( ".cart_empty_msg" ).hide();
                                jQuery('.cart_item_listing').append(cart_session_data.s_m_html);
                                jQuery('.partial_amount').html(cart_session_data.partial_amount);
                                jQuery('.remain_amount').html(cart_session_data.remain_amount);
                                jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                                jQuery('.cart_discount').html('- '+cart_session_data.cart_discount);
                                jQuery('.cart_tax').html(cart_session_data.cart_tax);
                                jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                                jQuery('.cart_total').html(cart_session_data.total_amount);
                            }else if(cart_session_data.status == 'empty calculation'){
                                jQuery('.freq_discount_display').hide();
                                jQuery('.partial_amount_hide_on_load').hide();
                                jQuery('.hide_right_side_box').hide();
                                jQuery( ".cart_empty_msg" ).show();
                                jQuery( ".cart_item_listing" ).empty();
                                jQuery( ".cart_sub_total" ).empty();
                                jQuery( ".frequent_discount" ).empty();
                                jQuery( ".cart_tax" ).empty();
                                jQuery( ".cart_total" ).empty();
                                jQuery( ".remain_amount" ).empty();
                                jQuery( ".partial_amount" ).empty();
                                jQuery( ".cart_discount" ).empty();
                            }else if(cart_session_data.status == 'delete particuler'){
                                jQuery( ".cart_empty_msg" ).hide();
                                jQuery( ".update_qty_of_s_m_"+m_name).remove();
                                jQuery('.partial_amount').html(cart_session_data.partial_amount);
                                jQuery('.remain_amount').html(cart_session_data.remain_amount);
                                jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                                jQuery('.cart_discount').html('- '+cart_session_data.cart_discount);
                                jQuery('.cart_tax').html(cart_session_data.cart_tax);
                                jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                                jQuery('.cart_total').html(cart_session_data.total_amount);
                            }
                        }
                    });
                }
            });
        }else{
			jQuery('.ct-loading-main').hide();
            jQuery(".error_of_invalid_area").show();
            jQuery('.error_of_invalid_area').html('Invalid '+method_name);
        }
    }else{
		jQuery('.ct-loading-main').hide();
        jQuery(".error_of_invalid_area").show();
        jQuery('.error_of_invalid_area').html('Invalid '+method_name);
    }
});

jQuery(document).on('click','.add_item_in_cart',function(){
	jQuery('.freq_disc_empty_cart_error').hide();
    var site_url=siteurlObj.site_url;
    var ajax_url=ajaxurlObj.ajax_url;
    jQuery('.coupon_display').hide();
    jQuery('.hide_coupon_textbox').show();
    jQuery('.ct-display-coupon-code').hide();
    jQuery('.coupon_invalid_error').hide();
    var s_m_qty=jQuery(this).data('duration_value');
    var s_m_rate=jQuery(this).data('rate');
    var service_id=jQuery(this).data('service_id');
    var method_id=jQuery(this).data('method_id');
    var method_name=jQuery(this).data('method_name');
    var units_id=jQuery(this).data('units_id');
    var type=jQuery(this).data('type');
    var frequently_discount_id=jQuery("input[name=frequently_discount_radio]:checked").data('id');
    var m_name = jQuery(this).data('mnamee');

    jQuery.ajax({
        type : 'post',
        data : {
            'method_id' : method_id,
            'service_id' : service_id,
            's_m_qty' : s_m_qty,
            's_m_rate' : s_m_rate,
            'method_name' : method_name,
            'units_id' : units_id,
            'type' : type,
            'frequently_discount_id' : frequently_discount_id,
            'add_to_cart' : 1
        },
        url : site_url+"front/manual_booking_firststep.php",
        success : function(res){
            jQuery('.freq_discount_display').show();
            jQuery('.hide_right_side_box').show();
            jQuery('.partial_amount_hide_on_load').show();
            jQuery('.empty_cart_error').hide();
			jQuery('.no_units_in_cart_error').hide();
            jQuery('.coupon_invalid_error').hide();
            jQuery("#total_cart_count").val('2');
            var cart_session_data=jQuery.parseJSON(res);
			jQuery('#no_units_in_cart_err').val(cart_session_data.unit_status);
			jQuery('#no_units_in_cart_err_count').val(cart_session_data.unit_require);
            if(cart_session_data.status == 'update'){
                jQuery( ".cart_empty_msg" ).hide();
                jQuery('.update_qty_of_s_m_'+cart_session_data.method_name_without_space).html(cart_session_data.s_m_html);
                jQuery('.update_qty_of_s_m_'+cart_session_data.method_name_without_space).val('data-service_id',service_id);
                jQuery('.update_qty_of_s_m_'+cart_session_data.method_name_without_space).val('data-method_id',method_id);
                jQuery('.update_qty_of_s_m_'+cart_session_data.method_name_without_space).val('data-units_id',units_id);

                jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                jQuery('.partial_amount').html(cart_session_data.partial_amount);
                jQuery('.remain_amount').html(cart_session_data.remain_amount);
                jQuery('.cart_tax').html(cart_session_data.cart_tax);
                jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                jQuery('.cart_total').html(cart_session_data.total_amount);
            }else if(cart_session_data.status == 'insert'){
                jQuery( ".cart_empty_msg" ).hide();
                jQuery('.cart_item_listing').append(cart_session_data.s_m_html);
                jQuery('.partial_amount').html(cart_session_data.partial_amount);
                jQuery('.remain_amount').html(cart_session_data.remain_amount);
                jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                jQuery('.cart_tax').html(cart_session_data.cart_tax);
                jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                jQuery('.cart_total').html(cart_session_data.total_amount);
            }else if(cart_session_data.status == 'firstinsert'){
                jQuery( ".cart_empty_msg" ).hide();
                jQuery('.cart_item_listing').append(cart_session_data.s_m_html);
                jQuery('.partial_amount').html(cart_session_data.partial_amount);
                jQuery('.remain_amount').html(cart_session_data.remain_amount);
                jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                jQuery('.cart_tax').html(cart_session_data.cart_tax);
                jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                jQuery('.cart_total').html(cart_session_data.total_amount);
            }else if(cart_session_data.status == 'empty calculation'){
                jQuery('.freq_discount_display').hide();
                jQuery('.partial_amount_hide_on_load').hide();
                jQuery('.hide_right_side_box').hide();
                jQuery( ".cart_empty_msg" ).show();
                jQuery( ".cart_item_listing" ).empty();
                jQuery( ".cart_sub_total" ).empty();
                jQuery( ".cart_tax" ).empty();
                jQuery( ".cart_total" ).empty();
                jQuery( ".remain_amount" ).empty();
                jQuery( ".partial_amount" ).empty();
                jQuery( ".cart_discount" ).empty();
                jQuery('.frequent_discount').empty();
            }else if(cart_session_data.status == 'delete particuler'){
                jQuery( ".cart_empty_msg" ).hide();
                jQuery( ".update_qty_of_s_m_"+m_name).remove();
                jQuery('.partial_amount').html(cart_session_data.partial_amount);
                jQuery('.remain_amount').html(cart_session_data.remain_amount);
                jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                jQuery('.cart_discount').html('- '+cart_session_data.cart_discount);
                jQuery('.cart_tax').html(cart_session_data.cart_tax);
                jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                jQuery('.cart_total').html(cart_session_data.total_amount);
            }
        }
    });
});


/*Coupon Apply*/
jQuery(document).ready(function(){
    jQuery('.ct-display-coupon-code').hide();
    jQuery('.coupon_display').hide();
});
jQuery(document).on('click touchstart','#apply_coupon',function(){
	jQuery('.ct-loading-main').show();
    jQuery('.freq_disc_empty_cart_error').hide();
    var site_url=siteurlObj.site_url;
    var ajax_url=ajaxurlObj.ajax_url;
    var coupon_code=jQuery('#coupon_val').val();
    var subtotal=jQuery('.cart_sub_total').text();

    var frequently_discount_id=jQuery("input[name=frequently_discount_radio]:checked").data('id');
    if(subtotal == ''){
		jQuery('.ct-loading-main').hide();
        jQuery('.coupon_invalid_error').css('display','block');
        jQuery('.coupon_invalid_error').html(errorobj_your_cart_is_empty_please_add_cleaning_services);
    }else{
        if(coupon_code == ''){
			jQuery('.ct-loading-main').hide();
            jQuery('.coupon_invalid_error').css('display','block');
            jQuery('.coupon_invalid_error').html(errorobj_please_enter_coupon_code);
        }else{
            jQuery.ajax({
                type:"POST",
                url: site_url+"front/manual_booking_firststep.php",
                data : {
                    'coupon_code' : coupon_code,
                    'frequently_discount_id' : frequently_discount_id,
                    'coupon_check' : 1
                },
                success: function(res){
					jQuery('.ct-loading-main').hide();
                    var cart_session_data=jQuery.parseJSON(res);
                    if(cart_session_data.discount_status == 'not'){
                        jQuery('.coupon_invalid_error').css('display','block');
                        jQuery('.coupon_invalid_error').html(errorobj_coupon_expired);
                    }
                    else if(cart_session_data.discount_status == 'wrongcode'){
                        jQuery('.coupon_invalid_error').css('display','block');
                        jQuery('.coupon_invalid_error').html(errorobj_invalid_coupon);
                    }else if(cart_session_data.discount_status == 'available'){
                        jQuery('.ct-display-coupon-code').show();
                        jQuery('.freq_discount_display').show();
                        jQuery('.hide_coupon_textbox').hide();
                        jQuery('.coupon_display').show();
                        jQuery('.partial_amount').html(cart_session_data.partial_amount);
                        jQuery('.remain_amount').html(cart_session_data.remain_amount);
                        jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                        jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                        jQuery('.cart_tax').html(cart_session_data.cart_tax);
                        jQuery('.cart_total').html(cart_session_data.total_amount);
                        jQuery('.cart_discount').html('- '+cart_session_data.cart_discount);
                    }
                }
            });
        }
    }
});
jQuery(document).on('click','#coupon_val',function(){
    jQuery('.coupon_invalid_error').hide();
});

/*Reverse Coupon Code*/
jQuery(document).on('click touchstart','.reverse_coupon',function(){
	jQuery('.ct-loading-main').show();
    jQuery('.freq_disc_empty_cart_error').hide();
    var site_url=siteurlObj.site_url;
    var coupon_reverse = jQuery('#display_code').text();
    var frequently_discount_id=jQuery("input[name=frequently_discount_radio]:checked").data('id');
    jQuery.ajax({
        type:"POST",
        url: site_url+"front/manual_booking_firststep.php",
        data : {
            'coupon_reverse' : coupon_reverse,
            'frequently_discount_id' : frequently_discount_id,
            'coupon_reversed' : 1
        },
        success: function(res){
			jQuery('.ct-loading-main').hide();
            var cart_session_data=jQuery.parseJSON(res);
            if(cart_session_data.status == 'reversed'){
                jQuery('.freq_discount_display').show();
                jQuery('.ct-display-coupon-code').hide();
                jQuery('.hide_coupon_textbox').show();
                jQuery('.coupon_display').hide();
                jQuery('.partial_amount').html(cart_session_data.partial_amount);
                jQuery('.remain_amount').html(cart_session_data.remain_amount);
                jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                jQuery('.cart_tax').html(cart_session_data.cart_tax);
                jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                jQuery('.cart_total').html(cart_session_data.total_amount);
            }
        }
    });
});

/*** calendar code start ***/
/* time slots dropdown show hide list */
jQuery(document).on("click",".time-slot-is",function() {
    jQuery(".time-slots-dropdown").show( "blind", {direction: "vertical"}, 700 );
});
jQuery(document).on("click",".time-slot",function() {
    jQuery('.time-slot').each(function(){
        jQuery(this).removeClass('selected-time-slot');
		/*
		 var selectedtime = jQuery('ct-date-selected').data('date');
         var slot_date = jQuery('ct-time-selected').text();
		 if(selectedtime == ct_time_selected && slot_date == ct_date){
		 jQuery(this).addClass('ct-booked');
		 }
		*/
    });
    jQuery(this).addClass('selected-time-slot');
    jQuery(".time-slots-dropdown").hide( "blind", {direction: "vertical"}, 300 );
});

jQuery(document).on('click','.ct-week', function() {
    var valuess = jQuery(this).val();
    var s_date = jQuery(this).data('s_date');
    var c_date = jQuery(this).data('c_date');
    if(s_date >= c_date){
        jQuery('.ct-week').each(function(){
            jQuery(this).removeClass('active');
            jQuery('.ct-show-time').removeClass('shown');
        });
        jQuery(this).addClass('active');
        jQuery('.ct-show-time').addClass('shown');
    }else if(s_date < c_date || valuess == ''){
        jQuery('.time_slot_box').hide();
    }
});
/******************/

jQuery(document).on("click",".selected_date",function() {
	 jQuery('.ct-loading-main').show();
    var site_url=siteurlObj.site_url;
    var ajax_url=ajaxurlObj.ajax_url;
    var selected_dates = jQuery(this).data('selected_dates');
    var s_date = jQuery(this).data('s_date');
    var cur_dates = jQuery(this).data('cur_dates');
    var c_date = jQuery(this).data('c_date');
    var id = jQuery(this).data('id');

    var ct_time_selected = jQuery('.ct-time-selected').text();
    var ct_date = jQuery('#save_selected_date').val();
	
	jQuery.ajax({
        type:"POST",
        url: ajax_url+"calendar_ajax.php",
        data : {
            'selected_dates' : selected_dates,
            'id' : id,
            'cur_dates' : cur_dates,
            'get_slots' : 1
        },
        success: function(res){
			 jQuery('.ct-loading-main').hide();
            jQuery('.time_slot_box').hide();
            jQuery('.display_selected_date_slots_box'+id).html(res);
            jQuery('.display_selected_date_slots_box'+id).show();

            if(ct_time_selected != ''){
                jQuery('.time-slot').each(function(){
                    var selectedtime = jQuery(this).data('ct_time_selected');
                    var slot_date = jQuery(this).data('slot_date');
					
					if(selectedtime == ct_time_selected && slot_date == ct_date){
                        jQuery(this).addClass('ct-booked');
                    }
                });
            }
        }
    });
});
jQuery(document).ready(function() {
    jQuery('.space_between_date_time').hide();
    var site_url=siteurlObj.site_url;
    var ajax_url=ajaxurlObj.ajax_url;
    jQuery.ajax({
        type:"POST",
        url: ajax_url+"calendar_ajax.php",
        data : {
            'get_calendar_on_page_load' : 1
        },
        success: function(res){
            jQuery('.cal_info').html(res);
            var d = new Date();
            var month = d.getMonth()+1;
            var day = d.getDate();
            var output = day + '-' +(month<10 ? '0' : '') + month + '-' +  d.getFullYear();
            var selected_dates = jQuery('.selected_date').data('selected_dates');
            var cur_dates = jQuery('.selected_date').data('cur_dates');
            if(output == cur_dates){
                jQuery('.by_default_today_selected').addClass('active_today');
            }
        }
    });
});
jQuery(document).on("click",".previous_next,.today_btttn",function() {
	 jQuery('.ct-loading-main').show();
	 /*
     jQuery('.cart_date').html('');
     jQuery('.cart_time').html('');
     jQuery('.hidedatetime_value').hide();
     jQuery('.space_between_date_time').hide();
	*/
    var ct_date_selected = jQuery('.ct-date-selected').text();
    var ct_time_selected = jQuery('.ct-time-selected').text();
    var ct_date = jQuery('.ct-date-selected').data('date');

    if(ct_date_selected != ''){
        jQuery('.add_date').attr('data-date',ct_date);
    }

    var site_url=siteurlObj.site_url;
    var ajax_url=ajaxurlObj.ajax_url;
    var month = jQuery(this).data('next_month');
    var year = jQuery(this).data('next_month_year');
    var todaybtn = jQuery(this).data('istoday');
    var today_date = jQuery(this).data('cur_dates');
    jQuery.ajax({
        type:"POST",
        url: ajax_url+"calendar_ajax.php",
        data : {
            'month' : month,
            'year' : year,
            'get_calendar' : 1
        },
        success: function(res){
			jQuery('.ct-loading-main').hide();
            jQuery('.cal_info').html(res);
            if(ct_date_selected != ''){
                jQuery('.add_date').addClass('ct-date-selected');
                jQuery('.add_time').addClass('ct-time-selected');
                jQuery('.add_date').html(ct_date_selected);
                jQuery('.add_date').attr('data-date',ct_date);
                jQuery('.add_time').html(ct_time_selected);
                jQuery('.ct-week').each(function(){
                    var selecteddate = jQuery(this).data('selected_dates');
                    if(selecteddate == ct_date){
                        jQuery('.selected_datess'+ct_date).addClass('active');
                        jQuery('.time-slot').each(function(){
                            var selectedtime = jQuery(this).data('ct_time_selected');
                            if(selectedtime == ct_time_selected && selecteddate == ct_date){
                                jQuery(this).addClass('ct-booked');

                            }
                        });
                    }
                });

            }

            var d = new Date();
            var month = d.getMonth()+1;
            var day = d.getDate();
            var output = day + '-' +(month<10 ? '0' : '') + month + '-' +  d.getFullYear();
            var selected_dates = jQuery('.selected_date').data('selected_dates');
            var cur_dates = jQuery('.selected_date').data('cur_dates');
            if(output == cur_dates){
                jQuery('.by_default_today_selected').addClass('active_today');
            }
            if(todaybtn=='Y'){
                jQuery('.dates .selected_datess'+today_date).trigger('click');
            }
        }
    });
});

jQuery(document).on("click",".time_slotss",function() {
	jQuery('.ct-selected-date-view').removeClass('pulse');
	jQuery('.date_time_error').hide();
    jQuery('.time_slot_box').hide();
    jQuery('.space_between_date_time').show();
    jQuery('.hidedatetime_value').show();
    jQuery('.add_date').addClass('ct-date-selected');
    jQuery('.add_time').addClass('ct-time-selected');

    var slot_date_to_display = jQuery(this).data('slot_date_to_display');
    var slot_date = jQuery(this).data('slot_date');
    var slotdb_date = jQuery(this).data('slotdb_date');
    var slot_time = jQuery(this).data('slot_time');
    var slotdb_time = jQuery(this).data('slotdb_time');
	/* 
    // jQuery('.slot_displayysss'+slot_date).html(slot_time);
    // jQuery('.slot_displayysss'+slot_date).css('font-size','16px');
    // jQuery('.slot_displayysss'+slot_date).css('color','#FFF');
    // jQuery('.selected_datess'+slot_date).css('line-height','29px');
	 */
    var ct_date_selected = jQuery(this).data('ct_date_selected');
    var ct_time_selected = jQuery(this).data('ct_time_selected');
	
	jQuery('.ct-date-selected').attr('data-date',slot_date);
	jQuery('#save_selected_date').val(slot_date);	
    jQuery('.ct-date-selected').html(ct_date_selected);
    jQuery('.ct-time-selected').html(ct_time_selected);
	jQuery('.ct-selected-date-view').addClass('pulse');
    jQuery('.cart_date').html(slot_date_to_display);
    jQuery('.cart_date').attr('data-date_val',slotdb_date);
    jQuery('.cart_time').html(slot_time);
    jQuery('.cart_time').attr('data-time_val',slotdb_time);

});
jQuery(document).on("click",".today_btttn",function() {
    var today_date = jQuery(this).data('cur_dates');
    jQuery('.dates .selected_datess'+today_date).trigger('click');
});


/*** calendar code end ***/
/* Display Country Code on click flag on phone*/
jQuery(document).on('click','.country',function() {
    var country_code=jQuery(this).data("dial-code");
    jQuery("#ct-user-phone").val('+'+country_code);
});

jQuery(document).on('click','.add_addon_in_cart_for_multipleqty',function(){
	jQuery('.freq_disc_empty_cart_error').hide();
    var site_url=siteurlObj.site_url;
    var ajax_url=ajaxurlObj.ajax_url;
    jQuery('.coupon_display').hide();
    jQuery('.hide_coupon_textbox').show();
    jQuery('.ct-display-coupon-code').hide();
    jQuery('.coupon_invalid_error').hide();
    var s_m_qty=jQuery(this).data('duration_value');
    var s_m_rate=jQuery(this).data('rate');
    var service_id=jQuery(this).data('service_id');
    var method_id=jQuery(this).data('method_id');
    var method_name=jQuery(this).data('method_name');
    var units_id=jQuery(this).data('units_id');
    var type=jQuery(this).data('type');
    var frequently_discount_id=jQuery("input[name=frequently_discount_radio]:checked").data('id');
    var m_name = jQuery(this).data('mnamee');
    var status = jQuery(this).data('status');

    if(parseInt(status) == 2){
        jQuery(this).data('status','1');

        jQuery.ajax({
            type : 'post',
            data : {
                'method_id' : method_id,
                'service_id' : service_id,
                's_m_qty' : s_m_qty,
                's_m_rate' : s_m_rate,
                'method_name' : method_name,
                'units_id' : units_id,
                'type' : type,
                'frequently_discount_id' : frequently_discount_id,
                'add_to_cart' : 1
            },
            url : site_url+"front/manual_booking_firststep.php",
            success : function(res){
                jQuery('.freq_discount_display').show();
                jQuery('.hide_right_side_box').show();
                jQuery('.partial_amount_hide_on_load').show();
                jQuery('.empty_cart_error').hide();
                jQuery('.coupon_invalid_error').hide();
                jQuery("#total_cart_count").val('2');
                var cart_session_data=jQuery.parseJSON(res);
				jQuery('#no_units_in_cart_err').val(cart_session_data.unit_status);
				jQuery('#no_units_in_cart_err_count').val(cart_session_data.unit_require);
                if(cart_session_data.status == 'insert'){
                    jQuery( ".cart_empty_msg" ).hide();
                    jQuery('.cart_item_listing').append(cart_session_data.s_m_html);
                    jQuery('.partial_amount').html(cart_session_data.partial_amount);
                    jQuery('.remain_amount').html(cart_session_data.remain_amount);
                    jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                    jQuery('.cart_tax').html(cart_session_data.cart_tax);
                    jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                    jQuery('.cart_total').html(cart_session_data.total_amount);
                }else if(cart_session_data.status == 'empty calculation'){
                    jQuery('.freq_discount_display').show();
                    jQuery('.partial_amount_hide_on_load').hide();
                    jQuery('.hide_right_side_box').hide();
                    jQuery( ".cart_empty_msg" ).show();
                    jQuery( ".cart_item_listing" ).empty();
                    jQuery( ".cart_sub_total" ).empty();
                    jQuery( ".frequent_discount" ).empty();
                    jQuery( ".cart_tax" ).empty();
                    jQuery( ".cart_total" ).empty();
                    jQuery( ".remain_amount" ).empty();
                    jQuery( ".partial_amount" ).empty();
                    jQuery( ".cart_discount" ).empty();
                }else if(cart_session_data.status == 'delete particuler'){
                    jQuery( ".cart_empty_msg" ).hide();
                    jQuery( ".update_qty_of_s_m_"+m_name).remove();
                    jQuery('.partial_amount').html(cart_session_data.partial_amount);
                    jQuery('.remain_amount').html(cart_session_data.remain_amount);
                    jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                    jQuery('.cart_discount').html('- '+cart_session_data.cart_discount);
                    jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                    jQuery('.cart_tax').html(cart_session_data.cart_tax);
                    jQuery('.cart_total').html(cart_session_data.total_amount);
                }
            }
        });
    }else{
        jQuery(this).data('status','2');

        jQuery.ajax({
            type : 'post',
            data : {
                'method_id' : method_id,
                'service_id' : service_id,
                's_m_qty' : s_m_qty,
                's_m_rate' : s_m_rate,
                'method_name' : method_name,
                'units_id' : units_id,
                'type' : type,
                'frequently_discount_id' : frequently_discount_id,
                'add_to_cart' : 1
            },
            url : site_url+"front/manual_booking_firststep.php",
            success : function(res){
                jQuery('.freq_discount_display').show();
                jQuery('.hide_right_side_box').show();
                jQuery('.partial_amount_hide_on_load').show();
                jQuery('.empty_cart_error').hide();
                jQuery('.coupon_invalid_error').hide();
                jQuery("#total_cart_count").val('2');
                var cart_session_data=jQuery.parseJSON(res);
				jQuery('#no_units_in_cart_err').val(cart_session_data.unit_status);
				jQuery('#no_units_in_cart_err_count').val(cart_session_data.unit_require);
                if(cart_session_data.status == 'empty calculation'){
                    jQuery('.partial_amount_hide_on_load').hide();
                    jQuery('.hide_right_side_box').hide();
                    jQuery( ".cart_empty_msg" ).show();
                    jQuery( ".cart_item_listing" ).empty();
                    jQuery( ".cart_sub_total" ).empty();
                    jQuery( ".cart_tax" ).empty();
                    jQuery( ".cart_total" ).empty();
                    jQuery( ".frequent_discount" ).empty();
                    jQuery( ".remain_amount" ).empty();
                    jQuery( ".partial_amount" ).empty();
                    jQuery( ".cart_discount" ).empty();
                }else if(cart_session_data.status == 'delete particuler'){
                    jQuery( ".cart_empty_msg" ).hide();
                    jQuery( ".update_qty_of_s_m_"+m_name).remove();
                    jQuery('.partial_amount').html(cart_session_data.partial_amount);
                    jQuery('.remain_amount').html(cart_session_data.remain_amount);
                    jQuery('.cart_sub_total').html(cart_session_data.cart_sub_total);
                    jQuery('.cart_discount').html('- '+cart_session_data.cart_discount);
                    jQuery('.cart_tax').html(cart_session_data.cart_tax);
                    jQuery('.frequent_discount').html(cart_session_data.frequent_discount);
                    jQuery('.cart_total').html(cart_session_data.total_amount);
                }
            }
        });
    }
});

jQuery(document).ready(function () {
    jQuery('[data-toggle="tooltip"]').tooltip({'placement': 'right'});
});
/**jQuery(document).on('click', '#app_copy_check', function(){
	var ct_zip = jQuery('#ct-zip-code').val();
	var ct_city = jQuery('#ct-city').val();
	var ct_state = jQuery('#ct-state').val();
	var ct_addr = jQuery('#ct-street-address').val();
	
	if(jQuery(this).prop('checked') == true){
		jQuery('#app-zip-code').val(ct_zip);
		jQuery('#app-city').val(ct_city);
		jQuery('#app-state').val(ct_state);
		jQuery('#app-street-address').val(ct_addr);
	}else{
		jQuery('#app-zip-code').val('');
		jQuery('#app-city').val('');
		jQuery('#app-state').val('');
		jQuery('#app-street-address').val('');
	}
});**/
/* same as above details  */
jQuery(document).on("change","#retype_status",function() {
 var user_address = jQuery("#ct-street-address").val();
    var user_zipcode = jQuery("#ct-zip-code").val();
    var user_city = jQuery("#ct-city").val();
    var user_state = jQuery("#ct-state").val();
 if(jQuery('#retype_status').prop('checked')) {
  jQuery("#app-street-address").val(user_address);
  jQuery("#app-zip-code").val(user_zipcode);
     jQuery("#app-city").val(user_city);
  jQuery("#app-state").val(user_state);
 }else{
  jQuery("#app-street-address").val("");
  jQuery("#app-zip-code").val("");
  jQuery("#app-city").val("");
  jQuery("#app-state").val("");
 }
      
});
jQuery(document).ready(function() {
 jQuery( ".ct_recurrence_end_date" ).datepicker({ dateFormat: 'yy-mm-dd' }); 
});


jQuery(document).on('click',".ct_method_tab-slider--nav li,.ct_method_tab-slider--nav li.active", function() {
	if(!jQuery(this).hasClass('ct_method_tab-blank_li')){
		var totallis = 0;	
		var selectedli = 0;
		var currentli = jQuery(this).html();
		var divid = jQuery(this).data('id');
		var maindivid = jQuery(this).data('maindivid');
		jQuery('.ct_method_tab-slider--nav').each(function(){
			var common_id = jQuery(this).data('id');
			if(jQuery('.ct_method_tab-slider--nav_dynamic'+common_id+' li').length == 2){
				jQuery('.ct_method_tab-slider--nav_dynamic'+common_id+' ul').append("<li class='ct_method_tab-slider-trigger ct_method_tab-blank_li'>&nbsp;</li>");
			}else if(jQuery('.ct_method_tab-slider--nav_dynamic'+common_id+' li').length == 1){
				jQuery('.ct_method_tab-slider--nav_dynamic'+common_id+' ul').append("<li class='ct_method_tab-slider-trigger ct_method_tab-blank_li'>&nbsp;</li><li class='ct_method_tab-slider-trigger ct_method_tab-blank_li'>&nbsp;</li>");
			}
		});
		jQuery('.ct_method_tab-slider--nav_dynamic'+maindivid+' li').each(function(){
			if(jQuery(this).html()==currentli){
				selectedli = totallis;
			}
			totallis++;
		});
		var leftpercent = 100/totallis;
		var currentpercent = leftpercent*selectedli;
		jQuery('head').find('style').each(function(){
			var attr = jQuery(this).attr('data-dynmicstyle');
			if (typeof attr !== typeof undefined && attr !== false) {
				jQuery(this).remove();
			}
		});	
		jQuery('<style data-dynmicstyle>.ct_method_tab-slider--nav_dynamic'+maindivid+' .ct_method_tab-slider-tabs.ct_methods_slide:after{width:'+leftpercent+'% !important;left:'+currentpercent+'% !important;}</style>').appendTo('head');		
		jQuery(".ct_method_tab-slider--nav_dynamic"+maindivid+" li").removeClass("active");
		 
		jQuery(".ct_method_tab-slider-trigger_dynamic"+divid).addClass("active");
	}
});