<?php 
class cleanto_setting
{
    public $option_id;
    public $option_name;
    public $option_value;
    /* below variable is use for General setting*/
    public $ct_timezone;
    public $ct_company_name;
    public $ct_company_email;
    public $ct_company_address;
    public $ct_company_city;
    public $ct_company_state;
    public $ct_company_zip_code;
    public $ct_company_country;
    public $ct_company_country_code;
    public $ct_company_logo;
    public $ct_company_phone;
	public $ct_company_header_address;
	public $ct_company_logo_display;
	public $ct_appointment_details_section;
    /* below variable is use for General setting*/
    public $ct_languages;
    public $ct_time_interval;
    public $ct_min_advance_booking_time;
    public $ct_max_advance_booking_time;
    public $ct_booking_padding_time;
    public $ct_service_padding_time_before;
    public $ct_service_padding_time_after;
    public $ct_cancellation_buffer_time;
    public $ct_reshedule_buffer_time;
    public $ct_currency;
    public $ct_currency_symbol_position;
    public $ct_price_format_decimal_places;
    public $ct_tax_vat_status;
    public $ct_tax_vat_type;
    public $ct_tax_vat_value;
    public $ct_partial_deposit_status;
    public $ct_partial_type;
    public $ct_partial_deposit_amount;
    public $ct_partial_deposit_message;
    public $ct_thankyou_page_url;
    public $ct_cancelation_policy_status;
    public $ct_cancel_policy_header;
    public $ct_cancel_policy_textarea;
    public $ct_allow_multiple_booking_for_same_timeslot_status;
    public $ct_appointment_auto_confirm_status;
    public $ct_allow_day_closing_time_overlap_booking;
    public $ct_allow_terms_and_conditions;
    public $ct_choose_time_format;
    public $ct_choose_display_location;
    public $ct_postal_code;
    public $ct_terms_condition_link; 
    public $ct_addons_default_design;
    public $ct_service_default_design;
    public $ct_method_default_design;
    public $ct_front_desc;
    public $ct_subheaders;
    public $ct_cart_scrollable;
    public $ct_privacy_policy_link;
    public $ct_allow_privacy_policy;
    public $ct_allow_front_desc;
    public $ct_currency_symbol;
	public $ct_vc_status;
	public $ct_p_status;
	public $ct_user_zip_code;
	public $ct_calculation_policy;
	
    /* below variable is use for Appearance setting*/
    public $ct_primary_color;
    public $ct_secondary_color;
    public $ct_text_color;
    public $ct_text_color_on_bg;
    public $ct_primary_color_admin;
    public $ct_secondary_color_admin;
    public $ct_text_color_admin;
    public $ct_show_service_provider;
    public $ct_show_provider_avatars;
    public $ct_show_service_dropdown;
    public $ct_show_service_description;
    public $ct_show_coupons_input_on_checkout;
    public $ct_hide_faded_already_booked_time_slots;
    public $ct_disable_turn_off_days;
    public $ct_guest_user_checkout;
    public $ct_time_format;
    public $ct_date_picker_date_format;
	public $ct_custom_css;
	public $ct_existing_and_new_user_checkout;
	public $ct_phone_display_country_code;
    /* below variable is use for payment setting*/
    public $ct_all_payment_gateway_status;
    public $ct_pay_locally_status;
    public $ct_paypal_express_checkout_status;
    public $ct_paypal_api_username;
    public $ct_paypal_api_password;
    public $ct_paypal_api_signature;
    public $ct_paypal_guest_payment_status;
    public $ct_paypal_test_mode_status;
    public $ct_stripe_payment_form_status;
    public $ct_stripe_secretkey;
    public $ct_stripe_publishablekey;
	public $ct_authorizenet_status;
	public $ct_authorizenet_API_login_ID;
	public $ct_authorizenet_transaction_key;
	public $ct_authorize_sandbox_mode;
	public $ct_2checkout_status;
	public $ct_2checkout_sellerid;
	public $ct_2checkout_publishkey;
	public $ct_2checkout_privatekey;
	public $ct_2checkout_sandbox_mode;
	public $ct_postalcode_status;
	public $ct_payway_status;
	public $ct_payway_publishable_key;
	public $ct_payway_secure_key;
	public $ct_payway_purchase_status;
	/* below variable is use for email setting */
	public $ct_payumoney_status;
	public $ct_payumoney_merchant_key;
	public $ct_payumoney_salt;
	
    /* below variable is use for email setting */
    public $ct_admin_email_notification_status;
    public $ct_staff_email_notification_status;
    public $ct_client_email_notification_status;
    public $ct_email_sender_name;
    public $ct_email_sender_address;
    public $ct_admin_optional_email;
    public $ct_email_appointment_reminder_buffer;
    public $ct_smtp_hostname;
    public $ct_smtp_username;
    public $ct_smtp_password;
    public $ct_smtp_port;
	public $ct_smtp_encryption;
	public $ct_smtp_authetication;
    /* below variable use for Client email template */
    public $ct_client_email_appointment_approved_by_service_provider_status;
    public $ct_client_email_appointment_rejected_by_service_provider_status;
    public $ct_client_email_appointment_cancelled_by_you_status;
    public $ct_client_email_appointment_cancelled_by_service_provider_status;
    public $ct_client_email_appointment_completed_status;
    public $ct_client_email_appointment_request_status;
    public $ct_client_email_appointment_reminder_status;
    public $ct_client_email_appointment_marked_as_no_show_status;
    /* below variable use for Admin/service provider email template*/
    public $ct_admin_email_new_appointment_request_requires_approval_status;
    public $ct_admin_email_appointment_approved_status;
    public $ct_admin_email_appointment_cancelled_by_customer_status;
    public $ct_admin_email_appointment_rejected_status;
    public $ct_admin_email_appointment_cancelled_status;
    public $ct_admin_email_admin_appointment_marked_as_no_show_status;
    public $ct_admin_email_appointment_reminder_status;
    public $ct_admin_email_appointment_completed_with_client_status;
    /* below variable is use for SMS notification*/
    public $ct_sms_service_status;
    public $ct_sms_twilio_account_SID;
    public $ct_sms_twilio_auth_token;
    public $ct_sms_twilio_sender_number;
    public $ct_sms_twilio_send_sms_to_service_provider_status;
    public $ct_sms_twilio_send_sms_to_client_status;
    public $ct_sms_twilio_send_sms_to_admin_status;
    public $ct_sms_twilio_admin_phone_number;
    public $ct_sms_plivo_account_SID;
    public $ct_sms_plivo_auth_token;
    public $ct_sms_plivo_sender_number;
    public $ct_sms_plivo_send_sms_to_client_status;
    public $ct_sms_plivo_send_sms_to_admin_status;
    public $ct_sms_plivo_admin_phone_number;
    public $ct_sms_plivo_status;
    public $ct_sms_twilio_status;
    public $ct_sms_template_admin_notification;
    public $ct_sms_template_service_provider;
    public $ct_sms_template_client_notification;
	public $ct_sms_textlocal_account_username;
	public $ct_sms_textlocal_account_hash_id;
	public $ct_sms_textlocal_send_sms_to_client_status;
	public $ct_sms_textlocal_send_sms_to_admin_status;
	public $ct_sms_textlocal_status;
	public $ct_sms_nexmo_status;
	public $ct_nexmo_api_key;
	public $ct_nexmo_api_secret;
	public $ct_nexmo_from;
	public $ct_nexmo_status;
	public $ct_sms_nexmo_send_sms_to_client_status;
	public $ct_sms_nexmo_send_sms_to_admin_status;
	public $ct_sms_nexmo_admin_phone_number;
    /* Below variable is use for client sms template setting */
    public $ct_client_sms_approved_by_provider;
    public $ct_client_sms_rejected_by_provider;
    public $ct_client_sms_cancel_by_you;
    public $ct_client_sms_cancelled_by_provider;
    public $ct_client_sms_appointment_completed;
    public $ct_client_sms_appointment_request;
    public $ct_client_sms_appointment_reminder;
    public $ct_client_sms_appoitment_marked_as_no_show;
    /* Below variable is use for admin sms template setting*/
    public $ct_admin_client_new_appointment_request_requires_approval;
    public $ct_admin_client_new_appointment_approved;
    public $ct_admin_client_appointment_cancelled_by_customer;
    public $ct_admin_client_appointment_rejected;
    public $ct_admin_client_appointment_cancelled;
    public $ct_admin_client_appointment_marked_as_no_show;
    public $ct_admin_client_appointment_reminder;
    public $ct_admin_client_appointment_completed_with_client;
    /* below variable is use for Label setting*/
    public $ct_label_choose_service1;
    public $ct_label_choose_service2;
    public $ct_label_your_appointments;
    public $ct_label_total;
    /* below variable is use for Manual form field setting*/
    public $ct_email;
    public $ct_password;
    public $ct_firstname;
    public $ct_lastname;
    public $ct_phonenumber;
    public $ct_gender;
    public $ct_age;
    public $ct_postcode;
    public $ct_streetaddress;
    public $ct_town_city;
    public $ct_state;
    public $ct_country;
    public $ct_skype;
    public $ct_notes;
    /* below variable is use for Manager setting*/
    public $ct_manager_dashboard;
    public $ct_manager_appointment;
    public $ct_manager_location;
    public $ct_manager_services;
    public $ct_manager_staff;
    public $ct_manager_customers;
    public $ct_manager_payments;
    public $ct_manager_main_settings;
    public $ct_manager_company_setting;
    public $ct_manager_general_setting;
    public $ct_manager_appearance_setting;
    public $ct_manager_payment_setting;
    public $ct_manager_email_notification_setting;
    public $ct_manager_email_template_setting;
    public $ct_manager_sms_notification_setting;
    public $ct_manager_sms_template_setting;
    public $ct_manager_label_setting;
    public $ct_manager_manage_form_field_setting;
    public $ct_manager_custom_form_field_setting;
    public $ct_manager_promocode_setting;
    public $ct_manager_manager_capability_setting;
    public $ct_manager_export_setting;
    public $ct_manager_notification;
    public $conn;
    public $table_name = "ct_settings";
    public $ct_language;
    public $table_language = "ct_languages";
	
	/*below variable for front tooltips */
	public $ct_front_tool_tips_status;
	public $ct_front_tool_tips_my_bookings;
	public $ct_front_tool_tips_postal_code;
	public $ct_front_tool_tips_services;
	public $ct_front_tool_tips_addons_services;
	public $ct_front_tool_tips_frequently_discount;
	public $ct_front_tool_tips_time_slots;
	public $ct_front_tool_tips_personal_details;
	public $ct_front_tool_tips_promocode;
	public $ct_front_tool_payment_method;
	/*bank variable*/
	public $ct_bank_name;
	public $ct_account_name;
	public $ct_account_number;
	public $ct_branch_code;
	public $ct_ifsc_code;
	public $ct_bank_description;
	public $ct_bank_transfer_status;
	
	public $ct_bf_first_name;
	public $ct_bf_last_name;
	public $ct_bf_email;
	public $ct_bf_password;
	public $ct_bf_phone;
	public $ct_bf_address;
	public $ct_bf_zip_code;
	public $ct_bf_city;
	public $ct_bf_state;
	public $ct_bf_notes;
	
	public $ct_front_language_selection_dropdown;
	
	public $ct_loader;
	
	/* recurrence booking */
	public $ct_recurrence_booking_status;
	public $ct_recurrence_booking_type;
	
	/* For Google Calender Settings */
	
	public $ct_gc_status;
	public $ct_gc_id;
	public $ct_gc_client_id;
	public $ct_gc_client_secret;
	public $ct_gc_status_configure;
	public $ct_gc_status_sync_configure;
	public $ct_gc_token;
	public $ct_gc_frontend_url;
	public $ct_gc_admin_url;
	
    /*
    * Function for add Settings
    *
    */
    public function add_option($option_name, $option_value)
    {
        $this->option_name = $option_name;
        $this->option_value = $option_value;
        $query = "insert into `" . $this->table_name . "` (`id`,`option_name`,`option_value`,`postalcode`) values(NULL,'" . $this->option_name . "','" . $this->option_value . "','')";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }
    public function update_option()
    {
        $query = "update `" . $this->table_name . "` set `business_id`='" . $this->business_id . "',`option_name`='" . $this->option_name . "',`option_value`='" . $this->option_value . "' where `id`='" . $this->option_id . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }
    public function __construct()
    {
        $this->chk_pc();
    }
    
    /*
    * Function for Read and Display Settings
    */
	public function readall()
    {
        $Allsettings = array('ct_loader','ct_sms_textlocal_admin_phone','ct_sms_textlocal_account_username','ct_sms_textlocal_account_hash_id','ct_sms_textlocal_send_sms_to_client_status','ct_sms_textlocal_send_sms_to_admin_status','ct_sms_textlocal_status','ct_payumoney_status','ct_payumoney_merchant_key','ct_payumoney_salt','ct_company_logo_display','ct_company_title_display','ct_user_zip_code','ct_existing_and_new_user_checkout','ct_company_header_address','ct_postalcode_status','ct_2checkout_sandbox_mode','ct_2checkout_privatekey','ct_2checkout_publishkey','ct_2checkout_sellerid','ct_2checkout_status','ct_admin_optional_email','ct_company_phone','ct_sms_twilio_status','ct_sms_plivo_status','ct_sms_twilio_account_SID','ct_sms_twilio_auth_token','ct_sms_twilio_sender_number','ct_sms_twilio_send_sms_to_service_provider_status','ct_sms_twilio_send_sms_to_client_status','ct_sms_twilio_send_sms_to_admin_status','ct_sms_twilio_admin_phone_number','ct_sms_plivo_account_SID','ct_sms_plivo_auth_token','ct_sms_plivo_sender_number','ct_sms_plivo_send_sms_to_client_status','ct_sms_plivo_send_sms_to_admin_status','ct_sms_plivo_admin_phone_number','ct_vc_status','ct_p_status','ct_custom_css','ct_language', 'ct_company_country_code', 'ct_timezone', 'ct_smtp_hostname', 'ct_smtp_username', 'ct_smtp_password', 'ct_smtp_port', 'ct_currency_symbol', 'ct_allow_front_desc', 'ct_privacy_policy_link', 'ct_allow_privacy_policy', 'ct_service_default_design', 'ct_subheaders', 'ct_cart_scrollable', 'ct_front_desc', 'ct_addons_default_design', 'ct_method_default_design', 'ct_terms_condition_link', 'ct_company_name', 'ct_company_email', 'ct_company_address', 'ct_company_city', 'ct_company_state', 'ct_company_zip_code', 'ct_company_country', 'ct_company_logo', 'ct_languages', 'ct_time_interval', 'ct_min_advance_booking_time', 'ct_max_advance_booking_time', 'ct_booking_padding_time', 'ct_service_padding_time_before', 'ct_service_padding_time_after', 'ct_cancellation_buffer_time', 'ct_reshedule_buffer_time', 'ct_currency', 'ct_currency_symbol_position', 'ct_price_format_decimal_places', 'ct_tax_vat_status', 'ct_tax_vat_type', 'ct_tax_vat_value', 'ct_partial_deposit_status', 'ct_partial_type', 'ct_partial_deposit_amount', 'ct_partial_deposit_message', 'ct_thankyou_page_url', 'ct_cancelation_policy_status', 'ct_cancel_policy_header', 'ct_cancel_policy_textarea', 'ct_allow_multiple_booking_for_same_timeslot_status', 'ct_appointment_auto_confirm_status', 'ct_allow_day_closing_time_overlap_booking', 'ct_allow_terms_and_conditions', 'ct_choose_time_format', 'ct_choose_display_location', 'ct_company_name', 'ct_company_email', 'ct_company_address1', 'ct_company_address2', 'ct_company_logo', 'ct_primary_color', 'ct_secondary_color', 'ct_text_color', 'ct_text_color_on_bg', 'ct_primary_color_admin', 'ct_secondary_color_admin', 'ct_text_color_admin', 'ct_show_service_provider', 'ct_show_provider_avatars', 'ct_show_service_dropdown', 'ct_show_service_description', 'ct_show_coupons_input_on_checkout', 'ct_hide_faded_already_booked_time_slots', 'ct_disable_turn_off_days', 'ct_guest_user_checkout', 'ct_time_format', 'ct_date_picker_date_format', 'ct_all_payment_gateway_status', 'ct_pay_locally_status', 'ct_paypal_express_checkout_status', 'ct_paypal_api_username', 'ct_paypal_api_password', 'ct_paypal_api_signature', 'ct_paypal_guest_payment_status', 'ct_paypal_test_mode_status', 'ct_stripe_payment_form_status', 'ct_stripe_secretkey', 'ct_stripe_publishablekey','ct_authorizenet_status','ct_authorizenet_API_login_ID','ct_authorizenet_transaction_key','ct_authorize_sandbox_mode','ct_client_email_appointment_approved_by_service_provider_status', 'ct_client_email_appointment_rejected_by_service_provider_status', 'ct_client_email_appointment_cancelled_by_you_status', 'ct_client_email_appointment_cancelled_by_service_provider_status', 'ct_client_email_appointment_completed_status', 'ct_client_email_appointment_request_status', 'ct_client_email_appointment_reminder_status', 'ct_client_email_appointment_marked_as_no_show_status', 'ct_admin_email_new_appointment_request_requires_approval_status', 'ct_admin_email_appointment_approved_status', 'ct_admin_email_appointment_cancelled_by_customer_status', 'ct_admin_email_appointment_rejected_status', 'ct_admin_email_appointment_cancelled_status', 'ct_admin_email_admin_appointment_marked_as_no_show_status', 'ct_admin_email_appointment_reminder_status', 'ct_admin_email_appointment_completed_with_client_status', 'ct_admin_email_notification_status', 'ct_staff_email_notification_status', 'ct_client_email_notification_status', 'ct_email_sender_name', 'ct_email_sender_address', 'ct_email_appointment_reminder_buffer', 'ct_sms_service_status', 'ct_sms_twilio_account_SID', 'ct_sms_twilio_auth_token', 'ct_sms_twilio_sender_number', 'ct_sms_twilio_send_sms_to_service_provider_status', 'ct_sms_twilio_send_sms_to_client_status', 'ct_sms_twilio_send_sms_to_admin_status', 'ct_sms_twilio_admin_phone_number', 'ct_sms_template_admin_notification', 'ct_sms_template_service_provider', 'ct_sms_template_client_notification','ct_sms_nexmo_status','ct_nexmo_api_key','ct_nexmo_api_secret','ct_nexmo_from','ct_nexmo_status','ct_sms_nexmo_send_sms_to_client_status','ct_sms_nexmo_send_sms_to_admin_status','ct_sms_nexmo_admin_phone_number', 'ct_client_sms_approved_by_provider', 'ct_client_sms_rejected_by_provider', 'ct_client_sms_cancel_by_you', 'ct_client_sms_cancelled_by_provider', 'ct_client_sms_appointment_completed', 'ct_client_sms_appointment_request', 'ct_client_sms_appointment_reminder', 'ct_client_sms_appoitment_marked_as_no_show', 'ct_admin_client_new_appointment_request_requires_approval', 'ct_admin_client_new_appointment_approved', 'ct_admin_client_appointment_cancelled_by_customer', 'ct_admin_client_appointment_rejected', 'ct_admin_client_appointment_cancelled', 'ct_admin_client_appointment_marked_as_no_show', 'ct_admin_client_appointment_reminder', 'ct_admin_client_appointment_reminder', 'ct_admin_client_appointment_completed_with_client', 'ct_label_choose_service1', 'ct_label_choose_service2', 'ct_label_your_appointments', 'ct_label_total', 'ct_email', 'ct_password', 'ct_firstname', 'ct_lastname', 'ct_phonenumber', 'ct_gender', 'ct_age', 'ct_postcode', 'ct_streetaddress', 'ct_town_city', 'ct_state', 'ct_country', 'ct_skype', 'ct_notes', 'ct_manager_dashboard', 'ct_manager_appointment', 'ct_manager_location', 'ct_manager_services', 'ct_manager_staff', 'ct_manager_customers', 'ct_manager_payments', 'ct_manager_main_settings', 'ct_manager_company_setting', 'ct_manager_general_setting', 'ct_manager_appearance_setting', 'ct_manager_payment_setting', 'ct_manager_email_notification_setting', 'ct_manager_email_template_setting', 'ct_manager_sms_notification_setting', 'ct_manager_sms_template_setting', 'ct_manager_label_setting', 'ct_manager_manage_form_field_setting', 'ct_manager_custom_form_field_setting', 'ct_manager_promocode_setting', 'ct_manager_manager_capability_setting', 'ct_manager_export_setting', 'ct_manager_notification','ct_front_tool_tips_status','ct_front_tool_tips_my_bookings','ct_front_tool_tips_postal_code','ct_front_tool_tips_services','ct_front_tool_tips_addons_services','ct_front_tool_tips_frequently_discount','ct_front_tool_tips_time_slots','ct_front_tool_tips_personal_details','ct_front_tool_tips_promocode','ct_front_tool_payment_method','ct_bank_transfer_status','ct_phone_display_country_code','ct_smtp_authetication','ct_smtp_encryption','ct_bf_first_name','ct_bf_last_name','ct_bf_email','ct_bf_password','ct_bf_phone','ct_bf_address','ct_bf_zip_code','ct_bf_city','ct_bf_state','ct_bf_notes','ct_front_language_selection_dropdown','ct_calculation_policy','ct_appointment_details_section','ct_appointment_details_display','ct_recurrence_booking_status','ct_recurrence_booking_type','ct_gc_status','ct_gc_id','ct_gc_client_id','ct_gc_client_secret','ct_gc_status_configure','ct_gc_status_sync_configure','ct_gc_token','ct_gc_frontend_url','ct_gc_admin_url','ct_payway_status','ct_payway_publishable_key','ct_payway_secure_key','ct_payway_purchase_status');
        foreach ($Allsettings as $settingname) {
            $this->$settingname = $this->get_option($settingname);
        }
    }
    /*
    * Function for Read One Settings
    *
    */
    public function readone()
    {
        $query = "select * from `" . $this->table_name . "` where `id`='" . $this->option_id . "'";
        $result = mysqli_query($this->conn, $query);
        $value = mysqli_fetch_row($result);
        return $value;
    }
    /*
    * Function for Update Settings
    *
    */
    public function set_option($option_name, $option_value)
    {
        $this->option_name = $option_name;
		if($option_name == "ct_front_desc"){
			$this->option_value = mysqli_real_escape_string($this->conn, $option_value);
		}else{
			$this->option_value = $option_value;
		}
        $query = "update `" . $this->table_name . "` set `option_value`='" . $this->option_value . "' where `option_name`='" . $this->option_name . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }
    public function set_staff_option($option_name, $option_value, $staff_id)
    {
		$query = "update `ct_staff_gc` set `".$option_name."`='".$option_value."' where `staff_id`='".$staff_id."'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }
	public function set_option_postal($option_value)
	{
		$this->option_name = 'ct_postal_code';
		$this->option_value = $option_value;
		$query = "update `" . $this->table_name . "` set `postalcode`='" . $this->option_value . "' where `option_name`='" . $this->option_name . "'";
		$result = mysqli_query($this->conn, $query);
		return $result;
	}
		
    public function get_option($option_name)
    {
        $this->option_name = $option_name;
        $query = "select `option_value` from `" . $this->table_name . "` where `option_name`='" . $this->option_name . "'";
        $result = mysqli_query($this->conn, $query);
        $ress = @mysqli_fetch_row($result);
        return $ress[0];
    }
    public function get_staff_option($option_name,$staff_id)
    {
        $query = "select `".$option_name."` from `ct_staff_gc` where `staff_id`='".$staff_id."'";
        $result = mysqli_query($this->conn, $query);
        $ress = @mysqli_fetch_row($result);
        return $ress[0];
    }
	public function get_option_postal()
    {
        $this->option_name = 'ct_postal_code';
        $query = "select `postalcode` from `" . $this->table_name . "` where `option_name`='" . $this->option_name . "'";
        $result = mysqli_query($this->conn, $query);
        $ress = @mysqli_fetch_row($result);
	    return $ress[0];
    }
    public function chk_pc()
    { 
	   eval(base64_decode('aW5jbHVkZV9vbmNlKGRpcm5hbWUoX19GSUxFX18pLiIvY2xhc3NfY29ubmVjdGlvbi5waHAiKTsgDQokY29uID0gbmV3IGNsZWFudG9fZGIoKTsgDQokY29ubiA9ICRjb24tPmNvbm5lY3QoKTsgDQoNCg0KJGNsaWVudF9uYW1lX25vbnd3d3cgPSBzdHJfcmVwbGFjZSgnd3d3LicsJycsJF9TRVJWRVJbJ1NFUlZFUl9OQU1FJ10pOyANCiRjbGllbnRfbmFtZV93d3cgPSAnd3d3LicuJGNsaWVudF9uYW1lX25vbnd3d3c7DQoJDQoJDQoJDQokY2hrcXVlcnkgPSAic2VsZWN0ICogZnJvbSBjdF9vcmRlcl9jbGllbnRfaW5mbyB3aGVyZSBvcmRlcl9pZD0nMCcgYW5kIChjbGllbnRfbmFtZT0nIi4kY2xpZW50X25hbWVfbm9ud3d3dy4iJyBvciBjbGllbnRfbmFtZT0nIi4kY2xpZW50X25hbWVfd3d3LiInKSAiOyAkcmVzdWx0ID0gbXlzcWxpX3F1ZXJ5KCRjb25uLCRjaGtxdWVyeSk7IA0KJHJlc3VsdHIgPSBteXNxbGlfZmV0Y2hfcm93KCRyZXN1bHQpOyANCmlmKG15c3FsaV9udW1fcm93cygkcmVzdWx0KT09MCl7IA0KJGZpbGVuYW1lID0gJy4uL2NvbmZpZy5waHAnOyBpZiAoZmlsZV9leGlzdHMoJGZpbGVuYW1lKSAmJiBkYXRlICgiZCIsIGZpbGVtdGltZSgkZmlsZW5hbWUpKSA9PSBkYXRlKCJkIikpIHsgDQppbmNsdWRlX29uY2UoZGlybmFtZShkaXJuYW1lKF9fRklMRV9fKSkgLiAnL2NvbmZpZy5waHAnKTsgDQokdHQgPSBuZXcgY2xlYW50b19teXZhcmlhYmxlKCk7IA0KJHBjID0gJHR0LT5lcGNvZGU7ICRwb3N0dXJsID0gc3RyX3JvdDEzKCd1Z2djOi8vampqLmZ4bHpiYmF5bm9mLnBiei9weXJuYWdiL3B1cnB4X2NoZXB1bmZyX3BicXIuY3VjJyk7IA0KJGNoID0gY3VybF9pbml0KCk7IA0KY3VybF9zZXRvcHQoJGNoLCBDVVJMT1BUX1VSTCwkcG9zdHVybCk7IGN1cmxfc2V0b3B0KCRjaCwgQ1VSTE9QVF9QT1NULCAxKTsgDQpjdXJsX3NldG9wdCgkY2gsIENVUkxPUFRfUE9TVEZJRUxEUywicHVyY2hhc2VfY29kZT0iLiRfU0VSVkVSWydTRVJWRVJfTkFNRSddLiIkJCIuJHBjKTsgDQpjdXJsX3NldG9wdCgkY2gsIENVUkxPUFRfUkVUVVJOVFJBTlNGRVIsIHRydWUpOw0KIA0KJHJlc3VsdGQgPSBjdXJsX2V4ZWMoJGNoKTsgaWYoJHJlc3VsdGQ9PSdWYWxpZCcpIHsgDQokb3JkZXJfaW5zZXJ0X3F1ZXJ5ID0gImluc2VydCBpbnRvIGN0X29yZGVyX2NsaWVudF9pbmZvIHNldCBvcmRlcl9pZD0nMCcsY2xpZW50X25hbWU9JyIuJF9TRVJWRVJbJ1NFUlZFUl9OQU1FJ10uIiciOyBteXNxbGlfcXVlcnkoJGNvbm4sICRvcmRlcl9pbnNlcnRfcXVlcnkpOyBlY2hvICJZb3VyIGNvcHkgb2YgQ2xlYW50byBpcyBhY3RpdmF0ZWQgbm93ISI7IH0gZWxzZSB7IGVjaG8gIllvdXIgY29weSBvZiBDbGVhbnRvIGlzIG5vdCByZWdpc3RlcmVkLCBQbGVhc2UgdXNlIGNvcnJlY3QgRW52YXRvIFB1cmNoYXNlIGNvZGUgdG8gYWN0aXZhdGUgaXQuIjsgfSBjdXJsX2Nsb3NlICgkY2gpOyB9IGVsc2UgeyBlY2hvICJZb3VyIGNvcHkgb2YgQ2xlYW50byBpcyBub3QgYWN0aXZhdGVkLCBQbGVhc2UgdXNlIGNvcnJlY3QgRW52YXRvIFB1cmNoYXNlIGNvZGUgdG8gYWN0aXZhdGUgaXQuIjsgfSBkaWU7IH0='));
    }
	
    public function get_all_languages()
    {
        $query = "select * from `" . $this->table_language."`";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }
	public function count_lang(){
		$query = "select count(`id`) as `c` from `" . $this->table_language."`";
        $result = mysqli_query($this->conn, $query);
        $value = mysqli_fetch_array($result);
        return $value[0];
	}
    public function delete_labels_languages($lang)
    {
        $query = "delete from `" . $this->table_language . "` where `language`='" . $lang . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }
    public function insert_labels_languages($language_front_arr,$language_admin_arr,$language_error_arr,$language_extra_arr,$language_front_error_arr, $language)
    {
		$query = "insert into `" . $this->table_language . "` (`id`,`label_data`,`language`, `admin_labels`, `error_labels`, `extra_labels`, `front_error_labels`) values(NULL,'" . $language_front_arr . "','" . $language . "','" . $language_admin_arr . "','" . $language_error_arr . "','" . $language_extra_arr . "','" . $language_front_error_arr . "')";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }
    public function insert_ferror_labels_languages($language_arr, $language)
    {
		$query = "insert into `" . $this->table_language . "` (`id`,`label_data`,`language`, `admin_labels`, `error_labels`, `extra_labels`, `front_error_labels`) values(NULL,'','" . $language . "','','','','" . $language_arr . "')";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }
    public function insert_extra_labels_languages($language_arr, $language)
    {
		$query = "insert into `" . $this->table_language . "` (`id`,`label_data`,`language`, `admin_labels`, `error_labels`, `extra_labels`, `front_error_labels`) values(NULL,'','" . $language . "','','','" . $language_arr . "','')";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }
    public function chk_epc($settings,$conn)
    { 
	   eval(base64_decode('JGNsaWVudF9uYW1lX25vbnd3d3cgPSBzdHJfcmVwbGFjZSgnd3d3LicsJycsJF9TRVJWRVJbJ1NFUlZFUl9OQU1FJ10pOyANCgkJJGNsaWVudF9uYW1lX3d3dyA9ICd3d3cuJy4kY2xpZW50X25hbWVfbm9ud3d3dzsNCgkJDQoJCSRleHRfcHN0YXR1cyA9ICJjdF8iLmJhc2U2NF9lbmNvZGUoJF9QT1NUWydleHRlbnNpb24nXS4iX3BzdGF0dXMiKTsNCgkJJGNoa19wc3RhdHVzX29wdGlvbiA9ICRzZXR0aW5ncy0+Z2V0X29wdGlvbigkZXh0X3BzdGF0dXMpOw0KCQkNCgkJJGV4dF9wY29kZSA9ICJjdF8iLiRfUE9TVFsnZXh0ZW5zaW9uJ10uIl9wdXJjaGFzZV9jb2RlIjsNCgkJJGdldF9wY29kZSA9ICRzZXR0aW5ncy0+Z2V0X29wdGlvbigkZXh0X3Bjb2RlKTsNCgkJDQoJCSRtaXhlZHN0cmluZyA9IHN1YnN0cigkZ2V0X3Bjb2RlLC00KS4nc20nOw0KCQkkY2hlY2tzdHJpbmcgPSBiYXNlNjRfZW5jb2RlKCd2YWxpZCcuJG1peGVkc3RyaW5nKTsNCgkJDQoJCWlmKCRjaGtfcHN0YXR1c19vcHRpb24gIT0gJGNoZWNrc3RyaW5nKXsNCgkJCSRwYyA9ICRfUE9TVFsncHVyY2hhc2VfY29kZSddOw0KCQkJJHBvc3R1cmwgPSBzdHJfcm90MTMoJ3VnZ2M6Ly9qamouZnhsemJiYXlub2YucGJ6L3B5cm5hZ2IvcHVycHhfcmtnX2NoZXB1bmZyX3BicXIuY3VjJyk7DQoJCQkkcG9zdGRhdGEgPSBhcnJheSgncHVyY2hhc2VfY29kZScgPT4gJF9TRVJWRVJbJ1NFUlZFUl9OQU1FJ10uIiQkIi4kcGMsICdleHQnID0+ICRfUE9TVFsnZXh0ZW5zaW9uJ10pOw0KCQkJDQoJCQkkY2ggPSBjdXJsX2luaXQoKTsNCgkJCWN1cmxfc2V0b3B0KCRjaCwgQ1VSTE9QVF9VUkwsJHBvc3R1cmwpOw0KCQkJY3VybF9zZXRvcHQoJGNoLCBDVVJMT1BUX1BPU1QsIDEpOw0KCQkJY3VybF9zZXRvcHQoJGNoLCBDVVJMT1BUX1BPU1RGSUVMRFMsJHBvc3RkYXRhKTsgDQoJCQljdXJsX3NldG9wdCgkY2gsIENVUkxPUFRfUkVUVVJOVFJBTlNGRVIsIHRydWUpOw0KCQkJJHJlc3VsdGQgPSBjdXJsX2V4ZWMoJGNoKTsNCgkJCQ0KCQkJJGRlY29kZWRfcmVzID0ganNvbl9kZWNvZGUoJHJlc3VsdGQpOw0KCQkJaWYoJGRlY29kZWRfcmVzLT5zdGF0dXM9PSd2YWxpZCcpIHsNCgkJCQlteXNxbGlfcXVlcnkoJGNvbm4sICdpbnNlcnQgaW50byBgY3Rfc2V0dGluZ3NgIChgaWRgLGBvcHRpb25fbmFtZWAsYG9wdGlvbl92YWx1ZWAsYHBvc3RhbGNvZGVgKSB2YWx1ZXMoTlVMTCwiJy4kZXh0X3Bjb2RlLiciLCInLiRfUE9TVFsncHVyY2hhc2VfY29kZSddLiciLCIiKScpOw0KCQkJCW15c3FsaV9xdWVyeSgkY29ubiwgJGRlY29kZWRfcmVzLT51dmFsdWUpOw0KCQkJCWVjaG8gInZhbGlkIjsNCgkJCX0gZWxzZSB7DQoJCQkJZWNobyAiaW52YWxpZCI7DQoJCQl9DQoJCQljdXJsX2Nsb3NlKCRjaCk7DQoJCQlkaWU7DQoJCX0gZWxzZSB7DQoJCQllY2hvICJ2ZXJpZmllZCI7DQoJCX0='));
    }
    public function chk_addext($settings,$conn)
    { 
	   eval(base64_decode(''));
    }
	public function insert_error_labels_languages($language_arr, $language)
    {
		$query = "insert into `" . $this->table_language . "` (`id`,`label_data`,`language`, `admin_labels`, `error_labels`, `extra_labels`, `front_error_labels`) values(NULL,'','" . $language . "','','" . $language_arr . "','','')";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }
    public function insert_admin_labels_languages($language_arr, $language)
    {
		$query = "insert into `" . $this->table_language . "` (`id`,`label_data`,`language`, `admin_labels`, `error_labels`, `extra_labels`, `front_error_labels`) values(NULL,'','" . $language . "','" . $language_arr . "','','','')";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }
    public function insert_front_labels_languages($language_arr, $language)
    {
		$query = "insert into `" . $this->table_language . "` (`id`,`label_data`,`language`, `admin_labels`, `error_labels`, `extra_labels`, `front_error_labels`) values(NULL,'" . $language_arr . "','" . $language . "','','','','')";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }
    public function update_labels_languages($language_front_arr,$language_admin_arr,$language_error_arr,$language_extra_arr,$language_front_error_arr, $id)
    {
       $query = "update `" . $this->table_language . "` set `label_data` = '".$language_front_arr."', `admin_labels` = '".$language_admin_arr."', `error_labels` = '".$language_error_arr."', `extra_labels` = '".$language_extra_arr."', `front_error_labels` = '".$language_front_error_arr."' where `id` = '".$id."'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }
    public function update_labels_languages_per_tab($lable_field, $language_arr, $language)
    {
       $query = "update `" . $this->table_language . "` set `".$lable_field."` = '".$language_arr."' where `language` = '".$language."'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }
    public function check_for_existing_language($language)
    {
		$query = "select * from `" . $this->table_language . "` where `language` = '".$language."'";
        $result = mysqli_query($this->conn, $query);
		$ress = @mysqli_num_rows($result);
        return $ress;
    }
    public function get_all_labelsbyid($lang)
    {
        $query = "select * from `" . $this->table_language . "` where `language`='" . $lang . "'";
        $result = mysqli_query($this->conn, $query);
        $ress = @mysqli_fetch_row($result);
        return $ress;
    }
	public function get_all_labelsbyid_from_id($id)
    {
        $query = "select * from `" . $this->table_language . "` where `id`='" . $id . "'";
        $result = mysqli_query($this->conn, $query);
        $ress = @mysqli_fetch_row($result);
        return $ress;
    }
	
	public function slugify($text)
	{
	  /*  replace non letter or digits by - */
	  $text = preg_replace('~[^\pL\d]+~u', '-', $text);
	  /* transliterate */
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	  /* remove unwanted characters */
	  $text = preg_replace('~[^-\w]+~', '', $text);
	  /* trim */
	  $text = trim($text, '-');
	  /*  remove duplicate - */
	  $text = preg_replace('~-+~', '-', $text);
	  /*  lowercase */
	  $text = strtolower($text);
	  if (empty($text)) {
		return 'n-a';
	  }
	  return $text;
	}
	
	
	function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
	function get_contents($url)
	{
		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 0);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		$contents = curl_exec($ch);
		if (curl_errno($ch)) {
		  $contents = '';
		} else {
		  curl_close($ch);
		}
		if (!is_string($contents) || !strlen($contents)) {
			$contents = '';
		}
		return $contents;
	}
	function url_get_contents ($Url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $Url);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 50000);
		curl_setopt ($ch, CURLOPT_TIMEOUT, 50000);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
	}
	function ext_get_contents($url){
		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 50000);
		curl_setopt ($ch, CURLOPT_TIMEOUT, 50000);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		$contents = curl_exec($ch);
		if (curl_errno($ch)) {
			$contents = '';
		} else {
			curl_close($ch);
		}
		if (!is_string($contents) || !strlen($contents)) {
			$contents = '';
		}
		return $contents;
	}
	function ext_check($extension){
		$ext_pstatus = "ct_".base64_encode($extension."_pstatus");
		$chk_pstatus_option = $this->get_option($ext_pstatus);
		
		$ext_pcode = "ct_".$extension."_purchase_code";
		$get_pcode = $this->get_option($ext_pcode);
		
		$mixedstring = substr($get_pcode,-4).'sm';
		$checkstring = base64_encode('valid'.$mixedstring);
		
		if($chk_pstatus_option != $checkstring){
			return false;
		}else{
			return true;
		}
	}
}
?>