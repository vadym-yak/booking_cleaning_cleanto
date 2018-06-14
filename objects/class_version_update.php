<?php 

class cleanto_version_update{

	/* 
    Open a connect to the database.
    Make sure this is called on every page that needs to use the database.
	 */
    public $version="3.3";
    public $conn;

	public function update1_1()
	{

        /* insert new table */
		$languages = "CREATE TABLE IF NOT EXISTS `ct_languages` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `label_data` longtext NOT NULL,
					  `language` varchar(5) NOT NULL,
					  PRIMARY KEY (`id`)
					 ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
        mysqli_query($this->conn,$languages);

        /* Insert new options in settings */
        $add_options = "INSERT INTO `ct_settings` (`id`, `option_name`, `option_value`,`postalcode`) VALUES (NULL, 'ct_company_country_code', '+1,us,United States: +1','');";
         mysqli_query($this->conn,$add_options);

		/* Update the oprion in settings*/
		/* $add_options = "UPDATE ct_settings SET option_value = '+1,us,United States: +1' WHERE option_name = 'ct_company_country_code';";
        mysqli_query($this->conn,$add_options);
		*/
        $add_options = "INSERT INTO `ct_settings` (`id`, `option_name`, `option_value`, `postalcode`) VALUES (NULL, 'ct_language', 'en','');";
        mysqli_query($this->conn,$add_options);

        /* alter table add new field in addons */
        $add_options = "ALTER TABLE `ct_services_addon` ADD `predefine_image` TEXT NOT NULL";
        mysqli_query($this->conn,$add_options);

		 $add_options = "INSERT INTO `ct_settings` (`id`, `option_name`, `option_value`, `postalcode`) VALUES (NULL, 'ct_custom_css', '','');";
        mysqli_query($this->conn,$add_options);


		$this->insert_option('ct_authorizenet_status','');
		$this->insert_option('ct_authorizenet_API_login_ID','');
		$this->insert_option('ct_authorizenet_transaction_key','');
		$this->insert_option('ct_authorize_sandbox_mode','');

        $errors = array(
            "Atleast one payment method should be enable"=>"atleast_one_payment_method_should_be_enable",
            "Appointment booking confirm"=>"appointment_booking_confirm",
            "Appointment booking rejected"=>"appointment_booking_rejected",
            "Boooking Cancelled"=>"booking_cancel",
            "Appointment marked as no show"=>"appointment_marked_as_no_show",
            "Appointment Reschedules successfully"=>"appointment_reschedules_successfully",
            "Booking Deleted"=>"booking_deleted",
            "Break End Time should be greater than Start time"=>"break_end_time_should_be_greater_than_start_time",
            "Cancel by client"=>"cancel_by_client",
            "Cancelled by service provider"=>"cancelled_by_service_provider",
            "Confirmed"=>"confirmed",
            "Design set successfully"=>"design_set_successfully",
            "End break time updated"=>"end_break_time_updated",
            "Enter alphabets only"=>"enter_alphabets_only",
            "Enter only alphabets"=>"enter_only_alphabets",
            "Enter only Alphabets/Numbers"=>"enter_only_alphabets_numbers",
            "Enter only Digits"=>"enter_only_digits",
            "Enter valid Url"=>"enter_valid_url",
            "Enter only numeric"=>"enter_only_numeric",
            "Enter proper country code"=>"enter_proper_country_code",
            "Frequently discount status updated"=>"frequently_discount_status_updated",
            "Frequently discount updated"=>"frequently_discount_updated",
            "Manage addons service"=>"manage_addons_service",
            "Maximum file upload size 2 MB"=>"maximum_file_upload_size_2_mb",
            "Method deleted successfully"=>"method_deleted_successfully",
            "Method inserted successfully"=>"method_inserted_successfully",
            "Minimum file upload size 10 KB"=>"minimum_file_upload_size_10_kb",
            "Off time added successfully"=>"off_time_added_successfully",
            "Only jpeg, png and gif images Allowed"=>"only_jpeg_png_and_gif_images_allowed",
            "Password must be 8 character long"=>"password_must_be_8_character_long",
            "Password should not exist more then 20 characters"=>"password_should_not_exist_more_then_20_characters",
            "Pending"=>"pending",
            "Please assign base price for unit"=>"please_assign_base_price_for_unit",
            "Please assign price"=>"please_assign_price",
            "Please assign quantity"=>"please_assign_qty",
            "Please enter API Password"=>"please_enter_api_password",
            "Please enter API Username"=>"please_enter_api_username",
            "Please enter Color Code"=>"please_enter_color_code",
            "Please enter country"=>"please_enter_country",
            "Please enter coupon limit"=>"please_enter_coupon_limit",
            "Please enter coupon value"=>"please_enter_coupon_value",
            "Please enter coupon code"=>"please_enter_coupon_code",
            "Please enter email"=>"please_enter_email",
            "Please enter Fullname"=>"please_enter_fullname",
            "Please enter maxLimit"=>"please_enter_maxlimit",
            "Please enter method title"=>"please_enter_method_title",
            "Please enter name"=>"please_enter_name",
            "Please enter only numeric"=>"please_enter_only_numeric",
            "Please enter proper base price"=>"please_enter_proper_base_price",
            "Please enter proper name"=>"please_enter_proper_name",
            "Please enter proper title"=>"please_enter_proper_title",
            "Please enter publishable key"=>"please_enter_publishable_key",
            "Please enter secret key"=>"please_enter_secret_key",
            "Please enter service Title"=>"please_enter_service_title",
            "Please enter signature"=>"please_enter_signature",
            "Please enter some quantity"=>"please_enter_some_qty",
            "Please enter title"=>"please_enter_title",
            "Please enter unit title"=>"please_enter_unit_title",
            "Please enter valid country code"=>"please_enter_valid_country_code",
            "Please enter valid service title"=>"please_enter_valid_service_title",
            "Please enter valid price"=>"please_enter_valid_price",
            "Please enter zipcode"=>"please_enter_zipcode",
            "Please enter state"=>"please_enter_state",
            "Please retype correct password"=>"please_retype_correct_password",
            "Please select porper time slots"=>"please_select_porper_time_slots",
            "Please select time between day availability time"=>"please_select_time_between_day_availability_time",
            "Please enter valid value for discount"=>"please_enter_valid_value_for_discount",
            "Please enter confirm password"=>"please_enter_confirm_password",
            "Please enter new password"=>"please_enter_new_password",
            "Please enter old password"=>"please_enter_old_password",
            "Please enter only numeric"=>"please_enter_only_numeric",
            "Please enter valid number"=>"please_enter_valid_number",
            "Please enter valid number with country code"=>"please_enter_valid_number_with_country_code",
            "Please select end time greater than start time"=>"please_select_end_time_greater_than_start_time",
            "Please select end time less than start time"=>"please_select_end_time_less_than_start_time",
            "Please select a crop region and then press upload"=>"please_select_a_crop_region_and_then_press_upload",
            "Please select a valid image file jpg and png are allowed"=>"please_select_a_valid_image_file_jpg_and_png_are_allowed",
            "Profile updated successfully"=>"profile_updated_successfully",
            "Quantity rule deleted"=>"qty_rule_deleted",
            "Record deleted successfully"=>"record_deleted_successfully",
            "Record updated successfully"=>"record_updated_successfully",
            "Rejected"=>"rejected",
            "Rescheduled"=>"rescheduled",
            "Schedule updated to Monthly"=>"schedule_updated_to_monthly",
            "Schedule updated to Weekly"=>"schedule_updated_to_weekly",
            "Sorry method already exist"=>"sorry_method_already_exist",
            "Sorry no notification"=>"sorry_no_notification",
            "Sorry promocode already exist"=>"sorry_promocode_already_exist",
            "Sorry unit already exist"=>"sorry_unit_already_exist",
            "Sorry we are not available"=>"sorry_we_are_not_available",
            "Start break time updated"=>"start_break_time_updated",
            "Status updated"=>"status_updated",
            "Time slots updated successfully"=>"time_slots_updated_successfully",
            "Unit inserted successfully"=>"unit_inserted_successfully",
            "Units status updated"=>"units_status_updated",
            "Updated appearance aettings"=>"updated_appearance_settings",
            "Updated company details"=>"updated_company_details",
            "Updated E-mail settings"=>"updated_email_settings",
            "Updated general settings"=>"updated_general_settings",
            "Updated payments settings"=>"updated_payments_settings",
            "Old password incorrect"=>"your_old_password_incorrect",
            "Please enter minimum 5 chars"=>"please_enter_minimum_5_chars",
            "Please enter maximum 10 chars"=>"please_enter_maximum_10_chars",
            "Please enter postal code" => 'please_enter_postal_code',
            "Please select a service" => 'please_select_a_service',
            "Please select units or addons" => 'please_select_units_or_addons',
            "Please select appointment date" => 'please_select_appointment_date',
            "Please accept terms and conditions" => 'please_accept_terms_and_conditions',
            "Incorrect email address or password" => 'incorrect_email_address_or_password',
            "Please enter valid email address" => 'please_enter_valid_email_address',
            "Please enter email address" => 'please_enter_email_address',
            "Please enter password" => 'please_enter_password',
            "Please enter minimum 8 characters" => 'please_enter_minimum_8_characters',
            "Please enter maximum 15 characters" => 'please_enter_maximum_15_characters',
            "Please enter first name" => 'please_enter_first_name',
            "Please enter only alphabets" => 'please_enter_only_alphabets',
            "Please enter minimum 2 characters" => 'please_enter_minimum_2_characters',
            "Please enter last name" => 'please_enter_last_name',
            "Email already exists" => 'email_already_exists',
            "Please enter phone number" => 'please_enter_phone_number',
            "Please enter only numerics" => 'please_enter_only_numerics',
            "Please enter minimum 10 digits" => 'please_enter_minimum_10_digits',
            "Please enter maximum 14 digits" => 'please_enter_maximum_14_digits',
            "Please enter address" => 'please_enter_address',
            "Please enter zip code" => 'please_enter_zip_code',
            "Please enter proper zip code" => 'please_enter_proper_zip_code',
            "Please enter minimum 5 digits" => 'please_enter_minimum_5_digits',
            "Please enter maximum 7 digits" => 'please_enter_maximum_7_digits',
            "Please enter city" => 'please_enter_city',
            "Please enter proper city" => 'please_enter_proper_city',
            "Please enter maximum 48 characters" => 'please_enter_maximum_48_characters',
            "Please enter state" => 'please_enter_state',
            "Please enter proper state" => 'please_enter_proper_state',
            "Please enter contact status" => 'please_enter_contact_status',
            "Please enter maximum 100 characters" => 'please_enter_maximum_100_characters',
            "Your cart is empty please add cleaning services" => 'your_cart_is_empty_please_add_cleaning_services',
            "Please enter Coupon code" => 'please_enter_coupon_code',
            "Coupon expired" => 'coupon_expired',
            "Invalid coupon" => 'invalid_coupon',
            "Our service not available at your location" => 'our_service_not_available_at_your_location',
            "Please enter proper postal code" => 'please_enter_proper_postal_code',
            "Invalid Email ID please register first" => 'invalid_email_id_please_register_first',
            "Your password send successfully at your registered Email ID" => 'your_password_send_successfully_at_your_registered_email_id',
            "Your password reset successfully please login" => 'your_password_reset_successfully_please_login',
            "New password and retype new password mismatch" => 'new_password_and_retype_new_password_mismatch',
            "New"=>'new',
            "for a"=>"for_a",
            "on"=>"on",
            "Your reset password link expired"=>'your_reset_password_link_expired',
            "Front display language changed"=>'front_display_language_changed',
            "Updated front display language and update labels"=>'updated_front_display_language_and_update_labels',
            "Please enter only 7 chars maximum"=>'please_enter_only_7_chars_maximum',
            "Please enter maximum 20 characters"=>'please_enter_maximum_20_chars',
            "Record Inserted Successfully"=>'record_inserted_successfully',
        );

        $admin_labels = array("API Password" => 'api_password',
            "API Username" => 'api_username',
            "APPEARANCE" => 'appearance',
            "Action" => 'action',
            "Actions" => 'actions',
            "Add Break" => 'add_break',
            "Add Breaks" => 'add_breaks',
            "Add Cleaning Service" => 'add_cleaning_service',
            "Add Method" => 'add_method',
            "Add New" => 'add_new',
            "Add Sample Data" => 'add_sample_data',
            "Add Unit" => 'add_unit',
            "Add Your Off Times" => 'add_your_off_times',
            "Add new off time" => 'add_new_off_time',
            "Add-ons" => 'add_ons',
            "AddOns Bookings" => 'addons_bookings',
            "Addon-Service Front View" => 'addon_service_front_view',
            "Addons" => 'addons',
            "Address" => 'address',
            "Admin Email Notifications" => 'admin_email_notifications',
            "All Payment Gateways" => 'all_payment_gateways',
            "All Services" => 'all_services',
            "Allow multiple booking for same timeslot" => 'allow_multiple_booking_for_same_timeslot',
            "Amount" => 'amount',
            "App. Date" => 'app_date',
            "Appearance Settings" => 'appearance_settings',
            "Appointment Completed" => 'appointment_completed',
            "Appointment Details" => 'appointment_details',
            "Appointment Marked As No Show" => 'appointment_marked_as_no_show',
            "Mark As No Show"=>'mark_as_no_show',
            "Appointment Reminder Buffer" => 'appointment_reminder_buffer',
            "Appointment auto confirm" => 'appointment_auto_confirm',
            "Appointments" => 'appointments',
            "Admin Area Color Scheme"=>'admin_area_color_scheme',
            "Thank you page"=>'thankyou_page_url',
            "Addon Title"=>'addon_title',
            "Availabilty" => 'availabilty',
            "Background color" => 'background_color',
            "Behaviour on click of button" => 'behaviour_on_click_of_button',
            "Book Now" => 'book_now',
            "Booking Date & Time" => 'booking_date_and_time',
            "Booking Details" => 'booking_details',
            "Booking Information" => 'booking_information',
            "Booking Serve Date" => 'booking_serve_date',
            "Booking Status" => 'booking_status',
            "Booking notifications" => 'booking_notifications',
            "Bookings" => 'bookings',
            "Button Position" => 'button_position',
            "Button Text" => 'button_text',
            "COMPANY" => 'company',
            "Cannot Cancel Now" => 'cannot_cancel_now',
            "Cannot Reschedule Now" => 'cannot_reschedule_now',
            "Cancel" => 'cancel',
            "Cancellation Buffer Time" => 'cancellation_buffer_time',
            "Cancelled by client" => 'cancelled_by_client',
            "Cancelled by service provider" => 'cancelled_by_service_provider',
            "Change password" => 'change_password',
            "City" => 'city',
            "Cleaning Service" => 'cleaning_service',
            "Client" => 'client',
            "Client Email Notifications" => 'client_email_notifications',
            "Client Name" => 'client_name',
            "Color Scheme" => 'color_scheme',
            "Color Tag" => 'color_tag',
            "Company Address" => 'company_address',
            "Company Email" => 'company_email',
            "Company Logo" => 'company_logo',
            "Company Name" => 'company_name',
            "Company Settings " => 'company_settings',
            "Completed" => 'completed',
            "Confirm" => 'confirm',
            "Confirmed" => 'confirmed',
            "Contact Status" => 'contact_status',
            "Country" => 'country',
            "Country Code (phone)" => 'country_code_phone',
            "Coupon" => 'coupon',
            "Coupon Code" => 'coupon_code',
            "Coupon Limit" => 'coupon_limit',
            "Coupon Type" => 'coupon_type',
            "Coupon Used" => 'coupon_used',
            "Coupon Value" => 'coupon_value',
            "Create Addon Service" => 'create_addon_service',
            "Crop & Save" => 'crop_and_save',
            "Currency" => 'currency',
            "Currency symbol position" => 'currency_symbol_position',
            "Customer" => 'customer',
            "Customer Information" => 'customer_information',
            "Customers" => 'customers',
            "Date & Time" => 'date_and_time',
            "Date-Picker Date Format" => 'date_picker_date_format',
            "Default Design For Addons" => 'default_design_for_addons',
            "Default Design For Methods With Multiple units" => 'default_design_for_methods_with_multiple_units',
            "Default Design For Services" => 'default_design_for_services',
            "Default Setting" => 'default_setting',
            "Delete" => 'delete',
            "Description" => 'description',
            "Discount" => 'discount',
            "Download Invoice" => 'download_invoice',
            "EMAIL NOTIFICATION" => 'email_notification',
            "Email" => 'email',
            "Email Settings" => 'email_settings',
            "Embed Code" => 'embed_code',
            "Enter your email and we will send you instructions on resetting your password." => 'enter_your_email_and_we_will_send_you_instructions_on_resetting_your_password',
            "Expiry Date" => 'expiry_date',
            "Export" => 'export',
            "Export Your Details" => 'export_your_details',
            "FREQUENTLY DISCOUNT" => 'frequently_discount',
            "Frequently Discount" => 'frequently_discount_header',
            "Field is required" => 'field_is_required',
            "File size" => 'file_size',
            "Flat Fee" => 'flat_fee',
            "Flat"=>'flat',
            "Forget Password" => 'forget_password',
            "Freq-Discount" => 'freq_discount',
            "Frequently Discount Label" => 'frequently_discount_label',
            "Frequently Discount Type" => 'frequently_discount_type',
            "Frequently Discount Value" => 'frequently_discount_value',
            "Front Service Box View" => 'front_service_box_view',
            "Front Service Dropdown View" => 'front_service_dropdown_view',
            "Front View Options" => 'front_view_options',
            "Full name" => 'full_name',
            "GENERAL" => 'general',
            "General Settings" => 'general_settings',
            "Get embed code to show booking widget on your website" => 'get_embed_code_to_show_booking_widget_on_your_website',
            "Get the Embeded Code" => 'get_the_embeded_code',
            "Guest Customers" => 'guest_customers',
            "Guest user checkout" => 'guest_user_checkout',
            "Hide faded already booked time slots" => 'hide_faded_already_booked_time_slots',
            "Hostname" => 'hostname',
            "LABELS" => 'labels',
            "Legends" => 'legends',
            "Login" => 'login',
            "Maximum advance booking time" => 'maximum_advance_booking_time',
            "Method" => 'method',
            "Method Name"=>'method_name',
            "Method Title" => 'method_title',
            "Method Unit Quantity" => 'method_unit_quantity',
            "Method Unit Quantity Rate" => 'method_unit_quantity_rate',
            "Method Unit Title" => 'method_unit_title',
            "Method Units Front View " => 'method_units_front_view',
            "Methods" => 'methods',
            "Methods Booking" => 'methods_booking',
            "Methods Bookings" => 'methods_bookings',
            "Minimum advance booking time" => 'minimum_advance_booking_time',
            "More" => 'more',
            "More Details" => 'more_details',
            "My Appointments" => 'my_appointments',
            "Name" => 'name',
            "Net Total" => 'net_total',
            "New Password" => 'new_password',
            "Notes" => 'notes',
            "Off Days" => 'off_days',
            "Off Time" => 'off_time',
            "Old Password" => 'old_password',
            "Online booking Button Style" => 'online_booking_button_style',
            "Open widget in a new page" => 'open_widget_in_a_new_page',
            "Order" => 'order',
            "Order Date" => 'order_date',
            "Order Time" => 'order_time',
            "PAYMENT" => 'payments_setting',
            "PROMOCODE" => 'promocode',
            "Promocode" => 'promocode_header',
            "Padding Time Before" => 'padding_time_before',
            "Parking" => 'parking',
            "Partial Amount" => 'partial_amount',
            "Partial Deposit" => 'partial_deposit',
            "Partial Deposit Amount" => 'partial_deposit_amount',
            "Partial Deposit Message" => 'partial_deposit_message',
            "Password" => 'password',
            "Pay locally" => 'pay_locally',
            "Payment" => 'payment',
            "Payment Date" => 'payment_date',
            "Payment Gateways" => 'payment_gateways',
            "Payment Method" => 'payment_method',
            "Payments" => 'payments',
            "Payments History Details" => 'payments_history_details',
            "Paypal Express Checkout" => 'paypal_express_checkout',
            "Paypal guest payment" => 'paypal_guest_payment',
            "Pending" => 'pending',
            "Percentage" => 'percentage',
            "Personal Information" => 'personal_information',
            "Phone" => 'phone',
            "Please Copy above code and paste in your website." => 'please_copy_above_code_and_paste_in_your_website',
            "Please Enable Payment Gateway" => 'please_enable_payment_gateway',
            "Please Set Below Values" => 'please_set_below_values',
            "Port" => 'port',
            "Postal Codes" => 'postal_codes',
            "Price" => 'price',
            "Price calculation method" => 'price_calculation_method',
            "Price format decimal Places" => 'price_format_decimal_places',
            "Pricing" => 'pricing',
            "Primary Color" => 'primary_color',
            "Privacy Policy" => 'privacy_policy',
            "Profile" => 'profile',
            "Promocodes" => 'promocodes',
            "Promocodes list" => 'promocodes_list',
            "Registered Customers" => 'registered_customers',
            "Registered Customers Bookings" => 'registered_customers_bookings',
            "Reject" => 'reject',
            "Rejected" => 'rejected',
            "Remember Me" => 'remember_me',
            "Remove Sample Data" => 'remove_sample_data',
            "Reschedule" => 'reschedule',
            "Rescheduled" => 'rescheduled',
            "Reset" => 'reset',
            "Reset Password" => 'reset_password',
            "Reshedule Buffer Time" => 'reshedule_buffer_time',
            "Retype New Password" => 'retype_new_password',
            "Right Side Description" => 'right_side_description',
            "Save" => 'save',
            "Save Availability" => 'save_availability',
            "Save Setting" => 'save_setting',
            "Save Labels Setting"=>'save_labels_setting',
            "Schedule" => 'schedule',
            "Schedule Type" => 'schedule_type',
            "Secondary color" => 'secondary_color',
            "Select Language for update" => 'select_language_for_update',
            "Select language to change label" => 'select_language_to_change_label',
            "Select language to display" => 'select_language_to_display',
            "Display Sub_Headers Below Headers"=>'display_sub_headers_below_headers',
            "Select payment option export details" => 'select_payment_option_export_details',
            "Send Mail" => 'send_mail',
            "Sender Email Address (Cleanto Admin Email)" => 'sender_email_address_cleanto_admin_email',
            "Sender Name" => 'sender_name',
            "Service" => 'service',
            "Service Add-ons Front Block View" => 'service_add_ons_front_block_view',
            "Service Add-ons Front Increase/Decrease View" => 'service_add_ons_front_increase_decrease_view',
            "Service Description" => 'service_description',
            "Service Front View" => 'service_front_view',
            "Service Image" => 'service_image',
            "Service Methods" => 'service_methods',
            "Service Padding Time After" => 'service_padding_time_after',
            "Padding Time After"=>'padding_time_after',
            "Service Padding Time Before" => 'service_padding_time_before',
            "Service Quantity" => 'service_quantity',
            "Service Rate" => 'service_rate',
            "Service Title" => 'service_title',
            "ServiceAddOns Name" => 'serviceaddons_name',
            "Services" => 'services',
            "Services Information" => 'services_information',
            "Set Email Reminder Buffer" => 'set_email_reminder_buffer',
            "Set Language" => 'set_language',
            "Settings" => 'settings',
            "Show All Bookings" => 'show_all_bookings',
            "Show button on given embeded position" => 'show_button_on_given_embeded_position',
            "Show coupons input on checkout" => 'show_coupons_input_on_checkout',
            "Show on a button click" => 'show_on_a_button_click',
            "Show on page load" => 'show_on_page_load',
            "Signature" => 'signature',
            "Sorry Wrong Email Or Password" => 'sorry_wrong_email_or_password',
            "Start Date" => 'start_date',
            "State" => 'state',
            "Status" => 'status',
            "Submit" => 'submit',
            "Tax" => 'tax',
            "Test Mode" => 'test_mode',
            "Text color" => 'text_color',
            "Text Color on bg"=>'text_color_on_bg',
            "Terms & Condition Link"=>'terms_and_condition_link',
            "This Week Breaks" => 'this_week_breaks',
            "This Week Time Scheduling" => 'this_week_time_scheduling',
            "Time Format" => 'time_format',
            "Time Interval" => 'time_interval',
            "TimeZone" => 'timezone',
            "Units" => 'units',
            "Unit Name"=>'unit_name',
            "Units Of Methods" => 'units_of_methods',
            "Update" => 'update',
            "Update Appointment" => 'update_appointment',
            "Update Promocode" => 'update_promocode',
            "Username" => 'username',
            "Vaccum-Cleaner" => 'vaccum_cleaner',
            "View Slots By?" => 'view_slots_by',
            "Week" => 'week',
            "Week Breaks" => 'week_breaks',
            "Week Time Scheduling" => 'week_time_scheduling',
            "Widget Loading style" => 'widget_loading_style',
            "Yes" => 'yes',
            "Zip" => 'zip',
            "logout" => 'logout',
            "to" => 'to',
            "Add New Promocode" => 'add_new_promocode',
            "Create" => 'create',
            "End Date" => 'end_date',
            "End Time" => 'end_time',
            "Expiry Date" => 'expiry_date',
            "Labels Settings" => 'labels_settings',
            "Limit" => 'limit',
            "Max Limit"=>"max_limit",
            "Start Time" => 'start_time',
            "Value" => 'value',
            "Active"=>'active');

        $front_labels = array("My Bookings" => 'my_bookings',
            "Your Postal Code" => 'your_postal_code',
            "Where would you like us to provide service?" => 'where_would_you_like_us_to_provide_service',
            "Choose service" => 'choose_service',
            "How often would you like us provide service?" => 'how_often_would_you_like_us_provide_service',
            "When would you like us to come?" => 'when_would_you_like_us_to_come',
            "TODAY" => 'today',
            "Your Personal Details" => 'your_personal_details',
            "Existing User" => 'existing_user',
            "New User" => 'new_user',
            "Preferred Email" => 'preferred_email',
            "Preferred Password" => 'preferred_password',
            "Your valid email address" => 'your_valid_email_address',
            "Password" => 'password',
            "First Name" => 'first_name',
            "Your First Name" => 'your_first_name',
            "Last Name" => 'last_name',
            "Your Last Name " => 'your_last_name',
            "Phone" => 'phone',
            "Street Address" => 'street_address',
            "Cleaning Service" => 'cleaning_service',
            "Please Select Method" => 'please_select_method',
            "Zip Code" => 'zip_code',
            "City" => 'city',
            "State" => 'state',
            "Special requests ( Notes )" => 'special_requests_notes',
            "Do you have a vacuum cleaner?" => 'do_you_have_a_vaccum_cleaner',
            "Yes" => 'yes',
            "No" => 'no',
            "Preferred Payment Method" => 'preferred_payment_method',
            "Please select one payment method" => 'please_select_one_payment_method',
            "Pay Locally" => 'pay_locally',
            "Partial Deposit" => 'partial_deposit',
            "Remaining Amount" => 'remaining_amount',
            "Please read our terms and conditions carefully" => 'please_read_our_terms_and_conditions_carefully',
            "Do you have parking?" => 'do_you_have_parking',
            "How will we get in?" => 'how_will_we_get_in',
            "I'll be at home" => 'i_will_be_at_home',
            "Please call me" => 'please_call_me',
            "Recurring discounts apply from the second cleaning onward." => 'recurring_discounts_apply_from_the_second_cleaning_onward',
            "Please provide your address and contact details" => 'please_provide_your_address_and_contact_details',
            "You are logged in as" => 'you_are_logged_in_as',
            "The key is with the doorman" => 'the_key_is_with_the_doorman',
            "Other" => 'other',
            "Have a promocode?" => 'have_a_promocode',
            "Apply" => 'apply',
            "Applied Promocode" => 'applied_promocode',
            "Complete Booking" => 'complete_booking',
            "CANCELLATION POLICY" => 'cancellation_policy',
            "Cancellation Policy Header"=>"cancellation_policy_header",
            "Cancellation Policy Textarea"=>"cancellation_policy_textarea",
            "Free cancellation before redemption" => 'free_cancellation_before_redemption',
            "Show More" => 'show_more',
            "Please Select Service" => 'please_select_service',
            "Choose your service and property size" => 'choose_your_service_and_property_size',
            "Please configure first Cleaning Services and settings in admin panel" => 'please_configure_first_cleaning_services_and_settings_in_admin_panel',
            "I have read and accepted the " => 'i_have_read_and_accepted_the',
            "Terms & Conditions" => 'terms_conditions',
            "Terms & Conditions" => 'terms_and_condition',
            "and" => 'and',
            'Updated labels'=>'updated_labels',

            "Privacy Policy" => 'privacy_policy',
            "Please Fill all the Company Informations and add some Services and Addons"=>'please_fill_all_the_company_informations_and_add_some_services_and_addons',
            "Booking Summary" => 'booking_summary',
            "Your Email" => 'your_email',
            "Enter Email to Login" => 'enter_email_to_login',
            "Your Password" => 'your_password',
            "Enter your Password" => 'enter_your_password',
            "Forget Password?" => 'forget_password',
            "Reset Password" => 'reset_password',
            "Enter your email and we'll send you instructions on resetting your password." => 'enter_your_email_and_we_send_you_instructions_on_resetting_your_password',
            "Registered Email" => 'registered_email',
            "Send Mail" => 'send_mail',
            "Back to Login" => 'back_to_login',
            "Your" => 'your',
            "Your clean items" => 'your_clean_items',
            "Your cart is empty" => 'your_cart_is_empty',
            "Sub TotalTax" => 'sub_totaltax',
            "Sub Total"=>"sub_total",
            "No data available in table"=>'no_data_available_in_table',
            "Total" => 'total',
            "Or"=>'or',
            "Select addon image"=>"select_addon_image",
            "Inside Fridge"=>'inside_fridge',
            "Inside Oven"=>"inside_oven",
            "Inside Windows"=>"inside_windows",
            "Carpet Cleaning"=>"carpet_cleaning",
            "Green Cleaning"=>"green_cleaning",
            "Pets Care"=>"pets_care",
            "Tiles Cleaning"=>"tiles_cleaning",
            "Wall Cleaning"=>"wall_cleaning",
            "Laundry"=>"laundry",
            "Basement Cleaning"=>"basement_cleaning",
            "Basic Price"=>'basic_price',
            "Max Qty"=>'max_qty',
            "Multiple Qty"=>'multiple_qty',
            "Base Price"=>'base_price',
            "Unit Pricing"=>'unit_pricing',
            "Method is booked"=>'method_is_booked',
            "Service Addons price rules"=>'service_addons_price_rules',
            "Service Unit Front DropDown View"=>'service_unit_front_dropdown_view',
            "Service Unit Front Block View"=>'service_unit_front_block_view',
            "Service Unit Front Increase/Decrease View"=>'service_unit_front_increase_decrease_view',
            "Are You Sure"=>'are_you_sure',
            "Service Unit price rules"=>'service_unit_price_rules',
            "Close"=>'close',
            "Closed"=>'closed',
            "Service Addons"=>'service_addons',
            "Service Enable"=>'service_enable',
            "Service Disable"=>'service_disable',
            "Method Enable"=>'method_enable',
            "Off Time Deleted"=>'off_time_deleted',
            "Error in Delete of Off Time"=>"error_in_delete_of_off_time",
            "Method Disable"=>'method_disable',
            "Extra Services" => 'extra_services',
            "For initial cleaning only. Contact us to apply to recurrings." => 'for_initial_cleaning_only_contact_us_to_apply_to_recurrings',
            "Number of" => 'number_of',
            "Extra Services Not Available" => 'extra_services_not_available',
            "Available"=>"available",
            "Selected"=>"selected",
            "Not Available"=>"not_available",
            "None"=>'none',
            "None of time slot available Please check another dates"=>"none_of_time_slot_available_please_check_another_dates",
            "Availability is not configured from admin side"=>"availability_is_not_configured_from_admin_side",
            "How many Intensive" => 'how_many_intensive',
            "No Intensive" => 'no_intensive',
            "Frequently Discount" => 'frequently_discount',
            "Coupon Discount" => 'coupon_discount',
            "How many" => 'how_many',
            "Enter your Other option" => 'enter_your_other_option',
            "Log Out" => 'log_out',
            "Your Added Off Times"=>'your_added_off_times',
            "Log In" => 'log_in',
            "Custom Css"=>'custom_css',
            "Success"=>'success',
            "Failure"=>'failure',
            "You can only use valid zipcode"=>'you_can_only_use_valid_zipcode',
            "Minutes"=>"minutes",
            "Hours"=>'hours',
            "Days"=>"days",
            "Months"=>"months",
            "Year"=>"year",
            "Default url is"=>"default_url_is",
            "Card payment"=>"card_payment",
            "Card details"=>"card_details",
            "Card number"=>"card_number",
            "Invalid card number"=>"invalid_card_number",
            "Expiry"=>"expiry",
            "Button Preview"=>"button_preview",
            "Thankyou"=>"thankyou",
            "Thankyou! for booking appointment"=>"thankyou_for_booking_appointment",
            "You will be notified by email with details of appointment"=>"you_will_be_notified_by_email_with_details_of_appointment",
			"Please enter firstname"=>"please_enter_firstname",
			"Please enter lastname"=>"please_enter_lastname",
			"Choose Your Service"=>"choose_your_service",
			"Choose Your"=>"choose_your");

        $language = array();


        foreach ($front_labels as $key => $value) {
            $language[$value] = $key;
        }
        foreach ($errors as $key => $value) {
            $language[$value] = $key;
        }
        foreach ($admin_labels as $key => $value) {
            $language[$value] = $key;
        }
        foreach ($admin_labels as $key => $value) {
            $language[$value] = $key;
        }

        $languagearr = base64_encode(serialize($language));

        $insert_default_lang = "insert into `ct_languages` (`id`,`label_data`,`language`) values(NULL,'" . $languagearr . "','en')";
        mysqli_query($this->conn, $insert_default_lang);
    }
    public function update1_2()
	{

		/*  new version update */
		$remove_fk_constraints_ct_services_addon = "ALTER TABLE `ct_services_addon`
DROP FOREIGN KEY `services_addon_ibfk_1`;";
		$remove_fk_constraints_ct_services_addon_rate = "ALTER TABLE `ct_addon_service_rate`
DROP FOREIGN KEY `addon_service_rate_ibfk_1`;";
		$remove_fk_constraints_ct_services_method = "ALTER TABLE `ct_services_method`
DROP FOREIGN KEY `services_method_ibfk_1`;";
		$remove_fk_constraints_ct_service_methods_units = "ALTER TABLE `ct_service_methods_units`
DROP FOREIGN KEY `service_methods_units_ibfk_1`;";
		$remove_fk_constraints_ct_service_methods_units_2 = "ALTER TABLE `ct_service_methods_units`
DROP FOREIGN KEY `service_methods_units_ibfk_2`;";
		$remove_fk_constraints_ct_services_methods_units_rate = "ALTER TABLE `ct_services_methods_units_rate`
DROP FOREIGN KEY `services_methods_units_rate_ibfk_1`;";
		$remove_fk_constraints_ct_service_methods_design = "ALTER TABLE `ct_service_methods_design`
DROP FOREIGN KEY `service_methods_design_ibfk_1`;";
		mysqli_query($this->conn,$remove_fk_constraints_ct_services_addon);
        mysqli_query($this->conn,$remove_fk_constraints_ct_services_addon_rate);
		mysqli_query($this->conn,$remove_fk_constraints_ct_services_method);
		mysqli_query($this->conn,$remove_fk_constraints_ct_service_methods_units);
        mysqli_query($this->conn,$remove_fk_constraints_ct_service_methods_units_2);
        mysqli_query($this->conn,$remove_fk_constraints_ct_services_methods_units_rate);
        mysqli_query($this->conn,$remove_fk_constraints_ct_service_methods_design);
		
		/* Update the oprion in settings */
		 $add_options = "UPDATE `ct_settings` SET `option_value` = '+1,us,United States: +1' WHERE `option_name` = 'ct_company_country_code';";
        mysqli_query($this->conn,$add_options);
		
		
		 /* alter table add new field in addons */
        $add_options = "ALTER TABLE `ct_services_addon` ADD `predefine_image_title` TEXT NOT NULL";
        mysqli_query($this->conn,$add_options);

        $errors = array(
            "Atleast one payment method should be enable"=>"atleast_one_payment_method_should_be_enable",
            "Appointment booking confirm"=>"appointment_booking_confirm",
            "Appointment booking rejected"=>"appointment_booking_rejected",
            "Boooking Cancelled"=>"booking_cancel",
            "Appointment marked as no show"=>"appointment_marked_as_no_show",
            "Appointment Reschedules successfully"=>"appointment_reschedules_successfully",
            "Booking Deleted"=>"booking_deleted",
            "Break End Time should be greater than Start time"=>"break_end_time_should_be_greater_than_start_time",
            "Cancel by client"=>"cancel_by_client",
            "Cancelled by service provider"=>"cancelled_by_service_provider",
            "Confirmed"=>"confirmed",
            "Design set successfully"=>"design_set_successfully",
            "End break time updated"=>"end_break_time_updated",
            "Enter alphabets only"=>"enter_alphabets_only",
            "Enter only alphabets"=>"enter_only_alphabets",
            "Enter only Alphabets/Numbers"=>"enter_only_alphabets_numbers",
            "Enter only Digits"=>"enter_only_digits",
            "Enter valid Url"=>"enter_valid_url",
            "Enter only numeric"=>"enter_only_numeric",
            "Enter proper country code"=>"enter_proper_country_code",
            "Frequently discount status updated"=>"frequently_discount_status_updated",
            "Frequently discount updated"=>"frequently_discount_updated",
            "Manage addons service"=>"manage_addons_service",
            "Maximum file upload size 2 MB"=>"maximum_file_upload_size_2_mb",
            "Method deleted successfully"=>"method_deleted_successfully",
            "Method inserted successfully"=>"method_inserted_successfully",
            "Minimum file upload size 10 KB"=>"minimum_file_upload_size_10_kb",
            "Off time added successfully"=>"off_time_added_successfully",
            "Only jpeg, png and gif images Allowed"=>"only_jpeg_png_and_gif_images_allowed",
            "Password must be 8 character long"=>"password_must_be_8_character_long",
            "Password should not exist more then 20 characters"=>"password_should_not_exist_more_then_20_characters",
            "Pending"=>"pending",
            "Please assign base price for unit"=>"please_assign_base_price_for_unit",
            "Please assign price"=>"please_assign_price",
            "Please assign quantity"=>"please_assign_qty",
            "Please enter API Password"=>"please_enter_api_password",
            "Please enter API Username"=>"please_enter_api_username",
            "Please enter Color Code"=>"please_enter_color_code",
            "Please enter country"=>"please_enter_country",
            "Please enter coupon limit"=>"please_enter_coupon_limit",
            "Please enter coupon value"=>"please_enter_coupon_value",
            "Please enter coupon code"=>"please_enter_coupon_code",
            "Please enter email"=>"please_enter_email",
            "Please enter Fullname"=>"please_enter_fullname",
            "Please enter maxLimit"=>"please_enter_maxlimit",
            "Please enter method title"=>"please_enter_method_title",
            "Please enter name"=>"please_enter_name",
            "Please enter only numeric"=>"please_enter_only_numeric",
            "Please enter proper base price"=>"please_enter_proper_base_price",
            "Please enter proper name"=>"please_enter_proper_name",
            "Please enter proper title"=>"please_enter_proper_title",
            "Please enter publishable key"=>"please_enter_publishable_key",
            "Please enter secret key"=>"please_enter_secret_key",
            "Please enter service Title"=>"please_enter_service_title",
            "Please enter signature"=>"please_enter_signature",
            "Please enter some quantity"=>"please_enter_some_qty",
            "Please enter title"=>"please_enter_title",
            "Please enter unit title"=>"please_enter_unit_title",
            "Please enter valid country code"=>"please_enter_valid_country_code",
            "Please enter valid service title"=>"please_enter_valid_service_title",
            "Please enter valid price"=>"please_enter_valid_price",
            "Please enter zipcode"=>"please_enter_zipcode",
            "Please enter state"=>"please_enter_state",
            "Please retype correct password"=>"please_retype_correct_password",
            "Please select porper time slots"=>"please_select_porper_time_slots",
            "Please select time between day availability time"=>"please_select_time_between_day_availability_time",
            "Please valid value for discount"=>"please_valid_value_for_discount",
            "Please enter confirm password"=>"please_enter_confirm_password",
            "Please enter new password"=>"please_enter_new_password",
            "Please enter old password"=>"please_enter_old_password",
            "Please enter only numeric"=>"please_enter_only_numeric",
            "Please enter valid number"=>"please_enter_valid_number",
            "Please enter valid number with country code"=>"please_enter_valid_number_with_country_code",
            "Please select end time greater than start time"=>"please_select_end_time_greater_than_start_time",
            "Please select end time less than start time"=>"please_select_end_time_less_than_start_time",
            "Please select a crop region and then press upload"=>"please_select_a_crop_region_and_then_press_upload",
            "Please select a valid image file jpg and png are allowed"=>"please_select_a_valid_image_file_jpg_and_png_are_allowed",
            "Profile updated successfully"=>"profile_updated_successfully",
            "Quantity rule deleted"=>"qty_rule_deleted",
            "Record deleted successfully"=>"record_deleted_successfully",
            "Record updated successfully"=>"record_updated_successfully",
            "Rejected"=>"rejected",
            "Rescheduled"=>"rescheduled",
            "Schedule updated to Monthly"=>"schedule_updated_to_monthly",
            "Schedule updated to Weekly"=>"schedule_updated_to_weekly",
            "Sorry method already exist"=>"sorry_method_already_exist",
            "Sorry no notification"=>"sorry_no_notification",
            "Sorry promocode already exist"=>"sorry_promocode_already_exist",
            "Sorry unit already exist"=>"sorry_unit_already_exist",
            "Sorry we are not available"=>"sorry_we_are_not_available",
            "Start break time updated"=>"start_break_time_updated",
            "Status updated"=>"status_updated",
            "Time slots updated successfully"=>"time_slots_updated_successfully",
            "Unit inserted successfully"=>"unit_inserted_successfully",
            "Units status updated"=>"units_status_updated",
            "Updated appearance aettings"=>"updated_appearance_settings",
            "Updated company details"=>"updated_company_details",
            "Updated E-mail settings"=>"updated_email_settings",
            "Updated general settings"=>"updated_general_settings",
            "Updated payments settings"=>"updated_payments_settings",
            "Old password incorrect"=>"your_old_password_incorrect",
            "Please enter minimum 5 chars"=>"please_enter_minimum_5_chars",
            "Please enter maximum 10 chars"=>"please_enter_maximum_10_chars",
            "Please enter postal code" => 'please_enter_postal_code',

            "Please select a service" => 'please_select_a_service',
            "Please select units or addons" => 'please_select_units_or_addons',
            "Please select units and addons" => 'please_select_units_and_addons',
            "Please select appointment date" => 'please_select_appointment_date',
            "Please accept terms and conditions" => 'please_accept_terms_and_conditions',
            "Incorrect email address or password" => 'incorrect_email_address_or_password',
            "Please enter valid email address" => 'please_enter_valid_email_address',
            "Please enter email address" => 'please_enter_email_address',
            "Please enter password" => 'please_enter_password',
            "Please enter minimum 8 characters" => 'please_enter_minimum_8_characters',
            "Please enter maximum 15 characters" => 'please_enter_maximum_15_characters',
            "Please enter first name" => 'please_enter_first_name',
            "Please enter only alphabets" => 'please_enter_only_alphabets',
            "Please enter minimum 2 characters" => 'please_enter_minimum_2_characters',
            "Please enter last name" => 'please_enter_last_name',
            "Email already exists" => 'email_already_exists',
            "Please enter phone number" => 'please_enter_phone_number',
            "Please enter only numerics" => 'please_enter_only_numerics',
            "Please enter minimum 10 digits" => 'please_enter_minimum_10_digits',
            "Please enter maximum 14 digits" => 'please_enter_maximum_14_digits',
            "Please enter address" => 'please_enter_address',
            "Please enter zip code" => 'please_enter_zip_code',
            "Please enter proper zip code" => 'please_enter_proper_zip_code',
            "Please enter minimum 5 digits" => 'please_enter_minimum_5_digits',
            "Please enter maximum 7 digits" => 'please_enter_maximum_7_digits',
            "Please enter city" => 'please_enter_city',
            "Please enter proper city" => 'please_enter_proper_city',
            "Please enter maximum 48 characters" => 'please_enter_maximum_48_characters',
            "Please enter state" => 'please_enter_state',
            "Please enter proper state" => 'please_enter_proper_state',
            "Please enter contact status" => 'please_enter_contact_status',
            "Please enter maximum 100 characters" => 'please_enter_maximum_100_characters',
            "Your cart is empty please add cleaning services" => 'your_cart_is_empty_please_add_cleaning_services',
            "Please enter Coupon code" => 'please_enter_coupon_code',
            "Coupon expired" => 'coupon_expired',
            "Invalid coupon" => 'invalid_coupon',
            "Our service not available at your location" => 'our_service_not_available_at_your_location',
            "Please enter proper postal code" => 'please_enter_proper_postal_code',
            "Invalid Email ID please register first" => 'invalid_email_id_please_register_first',
            "Your password send successfully at your registered Email ID" => 'your_password_send_successfully_at_your_registered_email_id',
            "Your password reset successfully please login" => 'your_password_reset_successfully_please_login',
            "New password and retype new password mismatch" => 'new_password_and_retype_new_password_mismatch',
            "New"=>'new',
            "for a"=>"for_a",
            "on"=>"on",
            "Your reset password link expired"=>'your_reset_password_link_expired',
            "Front display language changed"=>'front_display_language_changed',
            "Updated front display language and update labels"=>'updated_front_display_language_and_update_labels',
            "Please enter only 7 chars maximum"=>'please_enter_only_7_chars_maximum',
            "Please enter maximum 20 characters"=>'please_enter_maximum_20_chars',
            "Record Inserted Successfully"=>'record_inserted_successfully',
        );

        $admin_labels = array(
            "Frontend Labels"=>"frontend_labels",
            "Admin Labels"=>"admin_labels",
            "Errors"=>"errors",
            "Extra Labels"=>"extra_labels",
            "API Password" => 'api_password',
            "API Username" => 'api_username',
            "APPEARANCE" => 'appearance',
            "Action" => 'action',
            "Actions" => 'actions',
            "Add Break" => 'add_break',
            "Add Breaks" => 'add_breaks',
            "Add Cleaning Service" => 'add_cleaning_service',
            "Add Method" => 'add_method',
            "Add New" => 'add_new',
            "Add Sample Data" => 'add_sample_data',
            "Add Unit" => 'add_unit',
            "Add Your Off Times" => 'add_your_off_times',
            "Add new off time" => 'add_new_off_time',
            "Add-ons" => 'add_ons',
            "AddOns Bookings" => 'addons_bookings',
            "Addon-Service Front View" => 'addon_service_front_view',
            "Addons" => 'addons',
            "Address" => 'address',
            "Admin Email Notifications" => 'admin_email_notifications',
            "All Payment Gateways" => 'all_payment_gateways',
            "All Services" => 'all_services',
            "Allow Multiple Booking For Same Timeslot" => 'allow_multiple_booking_for_same_timeslot',
            "Amount" => 'amount',
            "App. Date" => 'app_date',
            "Appearance Settings" => 'appearance_settings',
            "Appointment Completed" => 'appointment_completed',
            "Appointment Details" => 'appointment_details',
            "Appointment Marked As No Show" => 'appointment_marked_as_no_show',
            "Mark As No Show"=>'mark_as_no_show',
            "Appointment Reminder Buffer" => 'appointment_reminder_buffer',
            "Appointment auto confirm" => 'appointment_auto_confirm',
            "Appointments" => 'appointments',
            "Admin Area Color Scheme"=>'admin_area_color_scheme',
            "Thankyou Page URL"=>'thankyou_page_url',
            "Addon Title"=>'addon_title',
            "Availabilty" => 'availabilty',
            "Background color" => 'background_color',
            "Behaviour on click of button" => 'behaviour_on_click_of_button',
            "Book Now" => 'book_now',
            "Booking Date & Time" => 'booking_date_and_time',
            "Booking Details" => 'booking_details',
            "Booking Information" => 'booking_information',
            "Booking Serve Date" => 'booking_serve_date',
            "Booking Status" => 'booking_status',
            "Booking notifications" => 'booking_notifications',
            "Bookings" => 'bookings',
            "Button Position" => 'button_position',
            "Button Text" => 'button_text',
            "COMPANY" => 'company',
            "Cannot Cancel Now" => 'cannot_cancel_now',
            "Cannot Reschedule Now" => 'cannot_reschedule_now',
            "Cancel" => 'cancel',
            "Cancellation Buffer Time" => 'cancellation_buffer_time',
            "Cancelled by client" => 'cancelled_by_client',
            "Cancelled by service provider" => 'cancelled_by_service_provider',
            "Change password" => 'change_password',
            "City" => 'city',
            "Cleaning Service" => 'cleaning_service',
            "Client" => 'client',
            "Client Email Notifications" => 'client_email_notifications',
            "Client Name" => 'client_name',
            "Color Scheme" => 'color_scheme',
            "Color Tag" => 'color_tag',
            "Address" => 'company_address',
            "Email" => 'company_email',
            "Company Logo" => 'company_logo',
            "Business Name" => 'company_name',
            "Business Info Settings " => 'company_settings',
            "Completed" => 'completed',
            "Confirm" => 'confirm',
            "Confirmed" => 'confirmed',
            "Contact Status" => 'contact_status',
            "Country" => 'country',
            "Country Code (phone)" => 'country_code_phone',
            "Coupon" => 'coupon',
            "Coupon Code" => 'coupon_code',
            "Coupon Limit" => 'coupon_limit',
            "Coupon Type" => 'coupon_type',
            "Coupon Used" => 'coupon_used',
            "Coupon Value" => 'coupon_value',
            "Create Addon Service" => 'create_addon_service',
            "Crop & Save" => 'crop_and_save',
            "Currency" => 'currency',
            "Currency Symbol Position" => 'currency_symbol_position',
            "Customer" => 'customer',
            "Customer Information" => 'customer_information',
            "Customers" => 'customers',
            "Date & Time" => 'date_and_time',
            "Date-Picker Date Format" => 'date_picker_date_format',
            "Default Design For Addons" => 'default_design_for_addons',
            "Default Design For Methods With Multiple units" => 'default_design_for_methods_with_multiple_units',
            "Default Design For Services" => 'default_design_for_services',
            "Default Setting" => 'default_setting',
            "Delete" => 'delete',
            "Description" => 'description',
            "Discount" => 'discount',
            "Download Invoice" => 'download_invoice',
            "EMAIL NOTIFICATION" => 'email_notification',
            "Email" => 'email',
            "Email Settings" => 'email_settings',
            "Embed Code" => 'embed_code',
            "Enter your email and we will send you instructions on resetting your password." => 'enter_your_email_and_we_will_send_you_instructions_on_resetting_your_password',
            "Expiry Date" => 'expiry_date',
            "Export" => 'export',
            "Export Your Details" => 'export_your_details',
            "FREQUENTLY DISCOUNT" => 'frequently_discount',
            "Frequently Discount" => 'frequently_discount_header',
            "Field is required" => 'field_is_required',
            "File size" => 'file_size',
            "Flat Fee" => 'flat_fee',
            "Flat"=>'flat',
            "Forget Password" => 'forget_password',
            "Freq-Discount" => 'freq_discount',
            "Frequently Discount Label" => 'frequently_discount_label',
            "Frequently Discount Type" => 'frequently_discount_type',
            "Frequently Discount Value" => 'frequently_discount_value',
            "Front Service Box View" => 'front_service_box_view',
            "Front Service Dropdown View" => 'front_service_dropdown_view',
            "Front View Options" => 'front_view_options',
            "Full name" => 'full_name',
            "GENERAL" => 'general',
            "General Settings" => 'general_settings',
            "Get embed code to show booking widget on your website" => 'get_embed_code_to_show_booking_widget_on_your_website',
            "Get the Embeded Code" => 'get_the_embeded_code',
            "Guest Customers" => 'guest_customers',
            "Guest user checkout" => 'guest_user_checkout',
            "Hide faded already booked time slots" => 'hide_faded_already_booked_time_slots',
            "Hostname" => 'hostname',
            "LABELS" => 'labels',
            "Legends" => 'legends',
            "Login" => 'login',
            "Maximum advance booking time" => 'maximum_advance_booking_time',
            "Method" => 'method',
            "Method Name"=>'method_name',
            "Method Title" => 'method_title',
            "Method Unit Quantity" => 'method_unit_quantity',
            "Method Unit Quantity Rate" => 'method_unit_quantity_rate',
            "Method Unit Title" => 'method_unit_title',
            "Method Units Front View " => 'method_units_front_view',
            "Methods" => 'methods',
            "Methods Booking" => 'methods_booking',
            "Methods Bookings" => 'methods_bookings',
            "Minimum advance booking time" => 'minimum_advance_booking_time',
            "More" => 'more',
            "More Details" => 'more_details',
            "My Appointments" => 'my_appointments',
            "Name" => 'name',
            "Net Total" => 'net_total',
            "New Password" => 'new_password',
            "Notes" => 'notes',
            "Off Days" => 'off_days',
            "Off Time" => 'off_time',
            "Old Password" => 'old_password',
            "Online booking Button Style" => 'online_booking_button_style',
            "Open widget in a new page" => 'open_widget_in_a_new_page',
            "Order" => 'order',
            "Order Date" => 'order_date',
            "Order Time" => 'order_time',
            "PAYMENT" => 'payments_setting',
            "PROMOCODE" => 'promocode',
            "Promocode" => 'promocode_header',
            "Padding Time Before" => 'padding_time_before',
            "Parking" => 'parking',
            "Partial Amount" => 'partial_amount',
            "Partial Deposit" => 'partial_deposit',
            "Partial Deposit Amount" => 'partial_deposit_amount',
            "Partial Deposit Message" => 'partial_deposit_message',
            "Password" => 'password',
            "Pay locally" => 'pay_locally',
            "Payment" => 'payment',
            "Payment Date" => 'payment_date',
            "Payment Gateways" => 'payment_gateways',
            "Payment Method" => 'payment_method',
            "Payments" => 'payments',
            "Payments History Details" => 'payments_history_details',
            "Paypal Express Checkout" => 'paypal_express_checkout',
            "Paypal guest payment" => 'paypal_guest_payment',
            "Pending" => 'pending',
            "Percentage" => 'percentage',
            "Personal Information" => 'personal_information',
            "Phone" => 'phone',
            "Please Copy above code and paste in your website." => 'please_copy_above_code_and_paste_in_your_website',
            "Please Enable Payment Gateway" => 'please_enable_payment_gateway',
            "Please Set Below Values" => 'please_set_below_values',
            "Port" => 'port',
            "Postal Codes" => 'postal_codes',
            "Price" => 'price',
            "Price calculation method" => 'price_calculation_method',
            "Price format" => 'price_format_decimal_places',
            "Pricing" => 'pricing',
            "Primary Color" => 'primary_color',
            "Privacy Policy Link" => 'privacy_policy',
            "Profile" => 'profile',
            "Promocodes" => 'promocodes',
            "Promocodes list" => 'promocodes_list',
            "Registered Customers" => 'registered_customers',
            "Registered Customers Bookings" => 'registered_customers_bookings',
            "Reject" => 'reject',
            "Rejected" => 'rejected',
            "Remember Me" => 'remember_me',
            "Remove Sample Data" => 'remove_sample_data',
            "Reschedule" => 'reschedule',
            "Rescheduled" => 'rescheduled',
            "Reset" => 'reset',
            "Reset Password" => 'reset_password',
            "Reshedule Buffer Time" => 'reshedule_buffer_time',
            "Retype New Password" => 'retype_new_password',
            "Booking Page Rightside Description" => 'right_side_description',
            "Save" => 'save',
            "Save Availability" => 'save_availability',
            "Save Setting" => 'save_setting',
            "Save Labels Setting"=>'save_labels_setting',
            "Schedule" => 'schedule',
            "Schedule Type" => 'schedule_type',
            "Secondary color" => 'secondary_color',
            "Select Language for update" => 'select_language_for_update',
            "Select language to change label" => 'select_language_to_change_label',
            "Language" => 'select_language_to_display',
            "Sub Headings on Booking page "=>'display_sub_headers_below_headers',
            "Select payment option export details" => 'select_payment_option_export_details',
            "Send Mail" => 'send_mail',
            "Sender Email" => 'sender_email_address_cleanto_admin_email',
            "Sender Name" => 'sender_name',
            "Service" => 'service',
            "Service Add-ons Front Block View" => 'service_add_ons_front_block_view',
            "Service Add-ons Front Increase/Decrease View" => 'service_add_ons_front_increase_decrease_view',
            "Service Description" => 'service_description',
            "Service Front View" => 'service_front_view',
            "Service Image" => 'service_image',
            "Service Methods" => 'service_methods',
            "Service Padding Time After" => 'service_padding_time_after',
            "Padding Time After"=>'padding_time_after',
            "Service Padding Time Before" => 'service_padding_time_before',
            "Service Quantity" => 'service_quantity',
            "Service Rate" => 'service_rate',
            "Service Title" => 'service_title',
            "ServiceAddOns Name" => 'serviceaddons_name',
            "Services" => 'services',
            "Services Information" => 'services_information',
            "Set Email Reminder Buffer" => 'set_email_reminder_buffer',
            "Set Language" => 'set_language',
            "Settings" => 'settings',
            "Show All Bookings" => 'show_all_bookings',
            "Show button on given embeded position" => 'show_button_on_given_embeded_position',
            "Show coupons input on checkout" => 'show_coupons_input_on_checkout',
            "Show on a button click" => 'show_on_a_button_click',
            "Show on page load" => 'show_on_page_load',
            "Signature" => 'signature',
            "Sorry Wrong Email Or Password" => 'sorry_wrong_email_or_password',
            "Start Date" => 'start_date',
            "State" => 'state',
            "Status" => 'status',
            "Submit" => 'submit',
            "Tax" => 'tax',
            "Test Mode" => 'test_mode',
            "Text color" => 'text_color',
            "Text Color on bg"=>'text_color_on_bg',
            "Terms & Condition Link"=>'terms_and_condition_link',
            "This Week Breaks" => 'this_week_breaks',
            "This Week Time Scheduling" => 'this_week_time_scheduling',
            "Time Format" => 'time_format',
            "Time Interval" => 'time_interval',
            "TimeZone" => 'timezone',
            "Units" => 'units',
            "Unit Name"=>'unit_name',
            "Units Of Methods" => 'units_of_methods',
            "Update" => 'update',
            "Update Appointment" => 'update_appointment',
            "Update Promocode" => 'update_promocode',
            "Username" => 'username',
            "Vaccum-Cleaner" => 'vaccum_cleaner',
            "View Slots By?" => 'view_slots_by',
            "Week" => 'week',
            "Week Breaks" => 'week_breaks',
            "Week Time Scheduling" => 'week_time_scheduling',
            "Widget Loading style" => 'widget_loading_style',
            "Yes" => 'yes',
            "Zip" => 'zip',
            "logout" => 'logout',
            "to" => 'to',
            "Add New Promocode" => 'add_new_promocode',
            "Create" => 'create',
            "End Date" => 'end_date',
            "End Time" => 'end_time',
            "Expiry Date" => 'expiry_date',
            "Labels Settings" => 'labels_settings',
            "Limit" => 'limit',
            "Max Limit"=>"max_limit",
            "Start Time" => 'start_time',
            "Value" => 'value',
            "Active"=>'active',
            "Appointment Reject Reason"=>"appointment_reject_reason",
            "Search"=>"search",
            "Custom Thankyou Page Url"=>"custom_thankyou_page_url",
            "Coupon Limit"=>"coupon_limit",
            "Price Per unit"=>"price_per_unit",
            "Confirm Appointment"=>"confirm_appointment",
            "Reject Reason"=>"reject_reason",
            "Delete this appointment"=>"delete_this_appointment",
            "Close Notifications"=>"close_notifications",
            "Booking Cancel reason"=>"booking_cancel_reason",
            "Service color badge"=>"service_color_badge",
            "Manage price calculation methods"=>"manage_price_calculation_methods",
            "Manage addons of this service"=>"manage_addons_of_this_service",
            "Service is booked"=>"service_is_booked",
            "Delete this service"=>"delete_this_service",
            "Delete Service"=>"delete_service",
            "Remove Image"=>"remove_image",
            "Remove service image"=>"remove_service_image",
            "Company name is used for invoice purpose"=>"company_name_is_used_for_invoice_purpose",
            "Remove Company Logo"=>"remove_company_logo",
            "Time interval is helpful to show time difference between availability time slots"=>"time_interval_is_helpful_to_show_time_difference_between_availability_time_slots",
            "Minimum advance booking time restrict client to book last minute booking, so that you should have sufficient time before appointment"=>"minimum_advance_booking_time_restrict_client_to_book_last_minute_booking_so_that_you_should_have_sufficient_time_before_appointment",
            "Cancellation buffer helps service providers to avoid last minute cancellation by their clients"=>"cancellation_buffer_helps_service_providers_to_avoid_last_minute_cancellation_by_their_clients",
            "Partial payment option will help you to charge partial payment of total amount from client and remaining you can collect locally"=>"partial_payment_option_will_help_you_to_charge_partial_payment_of_total_amount_from_client_and_remaining_you_can_collect_locally",
            "Allow multiple appointment booking at same time slot, will allow you to show availability time slot even you have booking already for that time"=>"allow_multiple_appointment_booking_at_same_time_slot_will_allow_you_to_show_availability_time_slot_even_you_have_booking_already_for_that_time",
            "With Enable of this feature, Appointment request from clients will be auto confirmed"=>"with_Enable_of_this_feature_Appointment_request_from_clients_will_be_auto_confirmed",
            "Write HTML code for the right side panel"=>"write_html_code_for_the_right_side_panel",
            "Do you want to show subheaders below the headers"=>"do_you_want_to_show_subheaders_below_the_headers",
            "You can show/hide coupon input on checkout form"=>"you_can_show_hide_coupon_input_on_checkout_form",
            "With this feature you can allow a visitor to book appointment without registration"=>"with_this_feature_you_can_allow_a_visitor_to_book_appointment_without_registration",
            "Paypal API username can get easily from developer.paypal.com account"=>"paypal_api_username_can_get_easily_from_developer_paypal_com_account",
            "Paypal API password can get easily from developer.paypal.com account"=>"paypal_api_password_can_get_easily_from_developer_paypal_com_account",
            "Paypal API Signature can get easily from developer.paypal.com account"=>"paypal_api_signature_can_get_easily_from_developer_paypal_com_account",
            "Let user pay through credit card without having Paypal account"=>"let_user_pay_through_credit_card_without_having_paypal_account",
            "You can enable Paypal test mode for sandbox account testing"=>"you_can_enable_paypal_test_mode_for_sandbox_account_testing",
            "You can enable Authorize.Net test mode for sandbox account testing"=>"you_can_enable_authorize_net_test_mode_for_sandbox_account_testing",
            "Edit coupon code"=>"edit_coupon_code",
            "Delete Promocode?"=>"delete_promocode",
            "Coupon code will work for such limit"=>"coupon_code_will_work_for_such_limit",
            "Coupon code will work for such date"=>"coupon_code_will_work_for_such_date",
            "Coupon Value would be consider as percentage in percentage mode and in flat mode it will be consider as amount.No need to add percentage sign it will auto added."=>"coupon_value_would_be_consider_as_percentage_in_percentage_mode_and_in_flat_mode_it_will_be_consider_as_amount_no_need_to_add_percentage_sign_it_will_auto_added",
            "Unit is Booked"=>"unit_is_booked",
            "Delete this service unit?"=>"delete_this_service_unit",
            "Delete Service Unit"=>"delete_service_unit",
            "Manage Unit Price"=>"manage_unit_price",
            "Extra Service Title"=>"extra_service_title",
            "Addon is Booked"=>"addon_is_booked",
            "Delete this addon service?"=>"delete_this_addon_service",
            "Choose your addon image"=>"choose_your_addon_image",
            "Addon Image"=>"addon_image");

        $front_labels = array("My Bookings" => 'my_bookings',
            "Your Postal Code" => 'your_postal_code',
            "Where would you like us to provide service?" => 'where_would_you_like_us_to_provide_service',
            "Choose service" => 'choose_service',
            "How often would you like us provide service?" => 'how_often_would_you_like_us_provide_service',
            "When would you like us to come?" => 'when_would_you_like_us_to_come',
            "TODAY" => 'today',
            "Your Personal Details" => 'your_personal_details',
            "Existing User" => 'existing_user',
            "New User" => 'new_user',
            "Preferred Email" => 'preferred_email',
            "Preferred Password" => 'preferred_password',
            "Your valid email address" => 'your_valid_email_address',
            "Password" => 'password',
            "First Name" => 'first_name',
            "Your First Name" => 'your_first_name',
            "Last Name" => 'last_name',
            "Your Last Name " => 'your_last_name',
            "Phone" => 'phone',
            "Street Address" => 'street_address',
            "Cleaning Service" => 'cleaning_service',
            "Please Select Method" => 'please_select_method',
            "Zip Code" => 'zip_code',
            "City" => 'city',
            "State" => 'state',
            "Special requests ( Notes )" => 'special_requests_notes',
            "Do you have a vacuum cleaner?" => 'do_you_have_a_vaccum_cleaner',
            "Yes" => 'yes',
            "No" => 'no',
            "Preferred Payment Method" => 'preferred_payment_method',
            "Please select one payment method" => 'please_select_one_payment_method',
            "Pay Locally" => 'pay_locally',
            "Partial Deposit" => 'partial_deposit',
            "Remaining Amount" => 'remaining_amount',
            "Please read our terms and conditions carefully" => 'please_read_our_terms_and_conditions_carefully',
            "Do you have parking?" => 'do_you_have_parking',
            "How will we get in?" => 'how_will_we_get_in',
            "I'll be at home" => 'i_will_be_at_home',
            "Please call me" => 'please_call_me',
            "Recurring discounts apply from the second cleaning onward." => 'recurring_discounts_apply_from_the_second_cleaning_onward',
            "Please provide your address and contact details" => 'please_provide_your_address_and_contact_details',
            "You are logged in as" => 'you_are_logged_in_as',
            "The key is with the doorman" => 'the_key_is_with_the_doorman',
            "Other" => 'other',
            "Have a promocode?" => 'have_a_promocode',
            "Apply" => 'apply',
            "Applied Promocode" => 'applied_promocode',
            "Complete Booking" => 'complete_booking',
            "Cancellation Policy" => 'cancellation_policy',
            "Cancellation Policy Header"=>"cancellation_policy_header",
            "Cancellation Policy Textarea"=>"cancellation_policy_textarea",
            "Free cancellation before redemption" => 'free_cancellation_before_redemption',
            "Show More" => 'show_more',
            "Please Select Service" => 'please_select_service',
            "Choose your service and property size" => 'choose_your_service_and_property_size',
            "Choose Your Service"=>"choose_your_service",
            "Please configure first Cleaning Services and settings in admin panel" => 'please_configure_first_cleaning_services_and_settings_in_admin_panel',
            "I have read and accepted the " => 'i_have_read_and_accepted_the',
            "Terms & Conditions" => 'terms_and_condition',
            "and" => 'and',
            'Updated labels'=>'updated_labels',

            "Privacy Policy" => 'privacy_policy',
            "Please Fill all the Company Informations and add some Services and Addons."=>'please_fill_all_the_company_informations_and_add_some_services_and_addons',
            "Booking Summary" => 'booking_summary',
            "Your Email" => 'your_email',
            "Enter Email to Login" => 'enter_email_to_login',
            "Your Password" => 'your_password',
            "Enter your Password" => 'enter_your_password',
            "Forget Password?" => 'forget_password',
            "Reset Password" => 'reset_password',
            "Enter your email and we'll send you instructions on resetting your password." => 'enter_your_email_and_we_send_you_instructions_on_resetting_your_password',
            "Registered Email" => 'registered_email',
            "Send Mail" => 'send_mail',
            "Back to Login" => 'back_to_login',
            "Your" => 'your',
            "Your clean items" => 'your_clean_items',
            "Your cart is empty" => 'your_cart_is_empty',
            "Sub TotalTax" => 'sub_totaltax',
            "Sub Total"=>"sub_total",
            "No data available in table"=>'no_data_available_in_table',
            "Total" => 'total',
            "Or"=>'or',
            "Select addon image"=>"select_addon_image",
            "Inside Fridge"=>'inside_fridge',
            "Inside Oven"=>"inside_oven",
            "Inside Windows"=>"inside_windows",
            "Carpet Cleaning"=>"carpet_cleaning",
            "Green Cleaning"=>"green_cleaning",
            "Pets Care"=>"pets_care",
            "Tiles Cleaning"=>"tiles_cleaning",
            "Wall Cleaning"=>"wall_cleaning",
            "Laundry"=>"laundry",
            "Basement Cleaning"=>"basement_cleaning",
            "Basic Price"=>'basic_price',
            "Max Qty"=>'max_qty',
            "Multiple Qty"=>'multiple_qty',
            "Base Price"=>'base_price',
            "Unit Pricing"=>'unit_pricing',
            "Method is booked"=>'method_is_booked',
            "Service Addons price rules"=>'service_addons_price_rules',
            "Service Unit Front DropDown View"=>'service_unit_front_dropdown_view',
            "Service Unit Front Block View"=>'service_unit_front_block_view',
            "Service Unit Front Increase/Decrease View"=>'service_unit_front_increase_decrease_view',
            "Are You Sure"=>'are_you_sure',
            "Service Unit price rules"=>'service_unit_price_rules',
            "Close"=>'close',
            "Closed"=>'closed',
            "Service Addons"=>'service_addons',
            "Service Enable"=>'service_enable',
            "Service Disable"=>'service_disable',
            "Method Enable"=>'method_enable',
            "Off Time Deleted"=>'off_time_deleted',
            "Error in Delete of Off Time"=>"error_in_delete_of_off_time",
            "Method Disable"=>'method_disable',
            "Extra Services" => 'extra_services',
            "For initial cleaning only. Contact us to apply to recurrings." => 'for_initial_cleaning_only_contact_us_to_apply_to_recurrings',
            "Number of" => 'number_of',
            "Extra Services Not Available" => 'extra_services_not_available',
            "Available"=>"available",
            "Selected"=>"selected",
            "Not Available"=>"not_available",
            "None"=>'none',
            "None of time slot available Please check another dates"=>"none_of_time_slot_available_please_check_another_dates",
            "Availability is not configured from admin side"=>"availability_is_not_configured_from_admin_side",
            "How many Intensive" => 'how_many_intensive',
            "No Intensive" => 'no_intensive',
            "Frequently Discount" => 'frequently_discount',
            "Coupon Discount" => 'coupon_discount',
            "How many" => 'how_many',
            "Enter your Other option" => 'enter_your_other_option',
            "Log Out" => 'log_out',
            "Your Added Off Times"=>'your_added_off_times',
            "Log In" => 'log_in',
            "Custom Css"=>'custom_css',
            "Success"=>'success',
            "Failure"=>'failure',
            "You can only use valid zipcode"=>'you_can_only_use_valid_zipcode',
            "Minutes"=>"minutes",
            "Hours"=>'hours',
            "Days"=>"days",
            "Months"=>"months",
            "Year"=>"year",
            "Default url is"=>"default_url_is",
            "Card payment"=>"card_payment",
            "Card details"=>"card_details",
            "Card number"=>"card_number",
            "Invalid card number"=>"invalid_card_number",
            "Expiry"=>"expiry",
            "Button Preview"=>"button_preview",
            "Thankyou"=>"thankyou",
            "Thankyou! for booking appointment"=>"thankyou_for_booking_appointment",
            "You will be notified by email with details of appointment"=>"you_will_be_notified_by_email_with_details_of_appointment",
            "Please enter firstname"=>"please_enter_firstname",
            "Please enter lastname"=>"please_enter_lastname",
            "Remove applied coupon"=>"remove_applied_coupon");

        $extra_labels = array(
            "Please enter minimum 3 Characters"=>"please_enter_minimum_3_chars",
            "INVOICE"=>"invoice",
            "INVOICE TO"=>"invoice_to",
            "Invoice Date"=>"invoice_date",
            "CASH"=>"cash",
            "Service Name"=>"service_name",
            "Qty"=>"qty",
            "Booked On"=>"booked_on");
		
		$language_error = array();
		$language_front = array();
		$language_admin = array();
		$language_extra = array();
		
        foreach ($front_labels as $key => $value) {
            $language_front[$value] = $key;
        }
        foreach ($errors as $key => $value) {
            $language_error[$value] = $key;
        }
        foreach ($admin_labels as $key => $value) {
            $language_admin[$value] = $key;
        }
		foreach ($extra_labels as $key => $value) {
            $language_extra[$value] = $key;
        }
		
		$language_front_arr = base64_encode(serialize($language_front));
		$language_admin_arr = base64_encode(serialize($language_admin));
		$language_error_arr = base64_encode(serialize($language_error));
		$language_extra_arr = base64_encode(serialize($language_extra));
				
        $languagearr = $language_front_arr."###".$language_admin_arr."###".$language_error_arr."###".$language_extra_arr;
		
        $delete_default_lang = "TRUNCATE TABLE  `ct_languages`;";
        mysqli_query($this->conn, $delete_default_lang);
		
        $insert_default_lang = "insert into `ct_languages` (`id`,`label_data`,`language`) values(NULL,'" . $languagearr . "','en')";
        mysqli_query($this->conn, $insert_default_lang);
    }
    public function insert_option($option,$value){
        $add_options = "INSERT INTO `ct_settings` (`id`, `option_name`, `option_value`,`postalcode`) VALUES (NULL, '".$option."', '".$value."','');";
        mysqli_query($this->conn,$add_options);
    }
    public function update1_3()
    {
	    $this->insert_option('ct_vc_status','Y');
        $this->insert_option('ct_p_status','Y');	
        $this->insert_option('ct_sms_plivo_account_SID', '');
        $this->insert_option('ct_sms_plivo_auth_token', '');
        $this->insert_option('ct_sms_plivo_sender_number', '');
        $this->insert_option('ct_sms_plivo_send_sms_to_service_provider_status', 'N');
        $this->insert_option('ct_sms_plivo_send_sms_to_client_status', 'N');
        $this->insert_option('ct_sms_plivo_send_sms_to_admin_status', 'N');
        $this->insert_option('ct_sms_plivo_admin_phone_number', '');
        $this->insert_option('ct_sms_twilio_status', 'N');
        $this->insert_option('ct_sms_plivo_status', 'N');
        $this->insert_option('ct_company_phone', '');
		$this->insert_option('ct_admin_optional_email', '');
        $sms_template = "CREATE TABLE IF NOT EXISTS `ct_sms_templates` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `sms_subject` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
		  `sms_message` text COLLATE utf8_unicode_ci NOT NULL,
		  `default_message` text COLLATE utf8_unicode_ci NOT NULL,
		  `sms_template_status` enum('E','D') COLLATE utf8_unicode_ci NOT NULL,
		  `sms_template_type` enum('A','C','R','CC','RS','RM') COLLATE utf8_unicode_ci NOT NULL COMMENT 'A=active, C=confirm, R=Reject, CC=Cancel by Client, RS=Reschedule, RM=Reminder',
		  `user_type` enum('A','C') COLLATE utf8_unicode_ci NOT NULL COMMENT 'A=Admin,C=client',
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;";
		mysqli_query($this->conn,$sms_template);
		
		$sms_template_insert = "INSERT INTO `ct_sms_templates` (`id`, `sms_subject`, `sms_message`, `default_message`, `sms_template_status`, `sms_template_type`, `user_type`) VALUES
(1, 'Appointment Request', '', 'RGVhciB7e2NsaWVudF9uYW1lfX0sCllvdSBoYXZlIGFuIGFwcG9pbnRtZW50IG9uIHt7Ym9va2luZ19kYXRlfX0gZm9yIHt7c2VydmljZV9uYW1lfX0=', 'E', 'A', 'C'),
(2, 'New Appointment Request Requires Approval', '', 'RGVhciB7e2FkbWluX25hbWV9fSwKWW91IGhhdmUgYW4gYXBwb2ludG1lbnQgb24ge3tib29raW5nX2RhdGV9fSBmb3Ige3tzZXJ2aWNlX25hbWV9fQ==', 'E', 'A', 'A'),
(3, 'Appointment Approved', '', 'RGVhciB7e2NsaWVudF9uYW1lfX0sDQpZb3VyIGFwcG9pbnRtZW50IG9uIHt7Ym9va2luZ19kYXRlfX0gZm9yIHt7c2VydmljZV9uYW1lfX0gaGFzIGJlZW4gY29uZmlybWVkLg', 'E', 'C', 'C'),
(4, 'Appointment Approved', '', 'RGVhciB7e2FkbWluX25hbWV9fSwNCllvdXIgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gb24ge3tib29raW5nX2RhdGV9fSBmb3Ige3tzZXJ2aWNlX25hbWV9fSBoYXMgYmVlbiBjb25maXJtZWQu', 'E', 'C', 'A'),
(5, 'Appointment Rejected', '', 'RGVhciB7e2NsaWVudF9uYW1lfX0sDQpZb3VyIGFwcG9pbnRtZW50IG9uIHt7Ym9va2luZ19kYXRlfX0gZm9yIHt7c2VydmljZV9uYW1lfX0gaGFzIGJlZW4gcmVqZWN0ZWQu', 'E', 'R', 'C'),
(6, 'Appointment Rejected', '', 'RGVhciB7e2FkbWluX25hbWV9fSwNCllvdXIgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gb24ge3tib29raW5nX2RhdGV9fSBmb3Ige3tzZXJ2aWNlX25hbWV9fSBoYXMgYmVlbiByZWplY3RlZC4=', 'E', 'R', 'A'),
(7, 'Appointment Cancelled by you', '', 'RGVhciB7e2NsaWVudF9uYW1lfX0sDQpZb3VyIGFwcG9pbnRtZW50IG9uIHt7Ym9va2luZ19kYXRlfX0gZm9yIHt7c2VydmljZV9uYW1lfX0gaGFzIGJlZW4gY2FuY2VsbGVkLg==', 'E', 'CC', 'C'),
(8, 'Appointment Cancelled By Customer', '', 'RGVhciB7e2FkbWluX25hbWV9fSwNCllvdXIgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gb24ge3tib29raW5nX2RhdGV9fSBmb3Ige3tzZXJ2aWNlX25hbWV9fSBoYXMgYmVlbiBjYW5jZWxsZWQu', 'E', 'CC', 'A'),
(9, 'Appointment Rescheduled by you', '', 'RGVhciB7e2NsaWVudF9uYW1lfX0sDQpZb3VyIGFwcG9pbnRtZW50IG9uIHt7Ym9va2luZ19kYXRlfX0gZm9yIHt7c2VydmljZV9uYW1lfX0gaGFzIGJlZW4gcmVzY2hlZHVsZWQu', 'E', 'RS', 'C'),
(10, 'Appointment Rescheduled By Customer', '', 'RGVhciB7e2FkbWluX25hbWV9fSwNCllvdXIgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gb24ge3tib29raW5nX2RhdGV9fSBmb3Ige3tzZXJ2aWNlX25hbWV9fSBoYXMgYmVlbiByZXNjaGVkdWxlZC4=', 'E', 'RS', 'A'),
(11, 'Client Appointment Reminder', '', 'RGVhciB7e2NsaWVudF9uYW1lfX0sCllvdXIgYXBwb2ludG1lbnQgd2l0aCB7e2FkbWluX25hbWV9fSBpcyBzY2hlZHVsZWQgaW4ge3thcHBfcmVtYWluX3RpbWV9fSBob3Vycy4=', 'E', 'RM', 'C'),
(12, 'Admin Appointment Reminder', '', 'RGVhciB7e2FkbWluX25hbWV9fSwKWW91ciBhcHBvaW50bWVudCB3aXRoIHt7Y2xpZW50X25hbWV9fSBpcyBzY2hlZHVsZWQgaW4ge3thcHBfcmVtYWluX3RpbWV9fSBob3Vycy4=', 'E', 'RM', 'A');";
		mysqli_query($this->conn,$sms_template_insert);
		
		$email_template = "CREATE TABLE IF NOT EXISTS `ct_email_templates` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `email_subject` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
		  `email_message` text COLLATE utf8_unicode_ci NOT NULL,
		  `default_message` text COLLATE utf8_unicode_ci NOT NULL,
		  `email_template_status` enum('E','D') COLLATE utf8_unicode_ci NOT NULL,
		  `email_template_type` enum('A','C','R','CC','RS','RM') COLLATE utf8_unicode_ci NOT NULL COMMENT 'A=active, C=confirm, R=Reject, CC=Cancel by Client, RS=Reschedule, RM=Reminder',
		  `user_type` enum('A','C') COLLATE utf8_unicode_ci NOT NULL COMMENT 'A=Admin,C=client',
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;";
		mysqli_query($this->conn,$email_template);
		
		$email_template_insert = "INSERT INTO `ct_email_templates` (`id`, `email_subject`, `email_message`, `default_message`, `email_template_status`, `email_template_type`, `user_type`) VALUES
(1, 'Appointment Request', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7Y2xpZW50X25hbWV9fSw8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5Zb3UndmUgc2V0IGEgbmV3IGFwcG9pbnRtZW50IHdpdGggZm9sbG93aW5nIGRldGFpbHM6PC9wPgkJCQkJCQkNCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9ImZsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3BhZGRpbmc6IDEwcHggMHB4OyI+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5XaGVuOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Ym9va2luZ19kYXRlfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkZvcjogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3NlcnZpY2VfbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5NZXRob2RzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e21ldGhvZG5hbWV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+VW5pdHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7dW5pdHN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+QWRkLW9ucyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3thZGRvbnN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UHJpY2UgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cHJpY2V9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJDQoJCQkJCQkJCQkNCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk5hbWUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Zmlyc3RuYW1lfX0ge3tsYXN0bmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5FbWFpbCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjbGllbnRfZW1haWx9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGhvbmUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cGhvbmV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGF5bWVudCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXltZW50X21ldGhvZH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5WYWNjdW0gQ2xlYW5lciA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t2YWNjdW1fY2xlYW5lcl9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGFya2luZyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXJraW5nX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGRyZXNzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZHJlc3N9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Tm90ZXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bm90ZXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Q29udGFjdCBTdGF0dXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Y29udGFjdF9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTVweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7Ym9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7Ij4NCgkJCQkJCQkJCTxwIHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bGluZS1oZWlnaHQ6IDIycHg7bWFyZ2luOiAxMHB4IDBweCAxNXB4O2Zsb2F0OiBsZWZ0OyI+WW91ciBhcHBvaW50bWVudCBpcyB0ZW50YXRpdmUgYW5kIHlvdSB3aWxsIGJlIG5vdGlmaWVkIGFzIHdlIHdpbGwgY29uZmlybSB0aGlzIGJvb2tpbmcuPC9wPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTBweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7dGV4dC1hbGlnbjogY2VudGVyOyI+DQoJCQkJCQkJCQk8aDUgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTNweDttYXJnaW46IDBweCAwcHggNXB4OyI+VGhhbmsgeW91PC9oNT4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJPC9kaXY+DQoJCQkJCQk8L3RkPgkJCQkJDQoJCQkJCTwvdHI+CQkJCQ0KCQkJCTwvdGJvZHk+DQoJCQk8L3RhYmxlPgkNCgkJPC9kaXY+DQoJPC9kaXY+CQ0KPC9ib2R5Pg0KPC9odG1sPg==', 'E', 'A', 'C'),
(2, 'New Appointment Request Requires Approval', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7YWRtaW5fbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5Zb3UndmUgbmV3IGFwcG9pbnRtZW50IHdpdGgge3tjbGllbnRfbmFtZX19IHdpdGggZm9sbG93aW5nIGRldGFpbHM6PC9wPgkJCQkJCQkNCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9ImZsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3BhZGRpbmc6IDEwcHggMHB4OyI+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5XaGVuOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Ym9va2luZ19kYXRlfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkZvcjogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3NlcnZpY2VfbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5NZXRob2RzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e21ldGhvZG5hbWV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+VW5pdHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7dW5pdHN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+QWRkLW9ucyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3thZGRvbnN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UHJpY2UgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cHJpY2V9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJDQoJCQkJCQkJCQkNCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk5hbWUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Zmlyc3RuYW1lfX0ge3tsYXN0bmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5FbWFpbCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjbGllbnRfZW1haWx9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGhvbmUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cGhvbmV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGF5bWVudCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXltZW50X21ldGhvZH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5WYWNjdW0gQ2xlYW5lciA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t2YWNjdW1fY2xlYW5lcl9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGFya2luZyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXJraW5nX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGRyZXNzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZHJlc3N9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Tm90ZXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bm90ZXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Q29udGFjdCBTdGF0dXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Y29udGFjdF9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTVweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7Ym9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7Ij4NCgkJCQkJCQkJCTxwIHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bGluZS1oZWlnaHQ6IDIycHg7bWFyZ2luOiAxMHB4IDBweCAxNXB4O2Zsb2F0OiBsZWZ0OyI+VGhpcyBhcHBvaW50bWVudCBpcyBpbiBwZW5kaW5nLjwvcD4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9InBhZGRpbmc6IDEwcHggMHB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3RleHQtYWxpZ246IGNlbnRlcjsiPg0KCQkJCQkJCQkJPGg1IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDEzcHg7bWFyZ2luOiAwcHggMHB4IDVweDsiPlRoYW5rIHlvdTwvaDU+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4JCQkJCQ0KCQkJCQk8L3RyPgkJCQkNCgkJCQk8L3Rib2R5Pg0KCQkJPC90YWJsZT4JDQoJCTwvZGl2Pg0KCTwvZGl2PgkNCjwvYm9keT4NCjwvaHRtbD4=', 'E', 'A', 'A'),
(3, 'Appointment Approved', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7Y2xpZW50X25hbWV9fSw8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5Zb3VyIGFwcG9pbnRtZW50IHdpdGggZm9sbG93aW5nIGRldGFpbHM6PC9wPgkJCQkJCQkNCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9ImZsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3BhZGRpbmc6IDEwcHggMHB4OyI+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5XaGVuOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Ym9va2luZ19kYXRlfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkZvcjogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3NlcnZpY2VfbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5NZXRob2RzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e21ldGhvZG5hbWV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+VW5pdHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7dW5pdHN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+QWRkLW9ucyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3thZGRvbnN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UHJpY2UgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cHJpY2V9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJDQoJCQkJCQkJCQkNCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk5hbWUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Zmlyc3RuYW1lfX0ge3tsYXN0bmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5FbWFpbCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjbGllbnRfZW1haWx9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGhvbmUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cGhvbmV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGF5bWVudCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXltZW50X21ldGhvZH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5WYWNjdW0gQ2xlYW5lciA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t2YWNjdW1fY2xlYW5lcl9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGFya2luZyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXJraW5nX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGRyZXNzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZHJlc3N9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Tm90ZXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bm90ZXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Q29udGFjdCBTdGF0dXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Y29udGFjdF9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTVweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7Ym9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7Ij4NCgkJCQkJCQkJCTxwIHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bGluZS1oZWlnaHQ6IDIycHg7bWFyZ2luOiAxMHB4IDBweCAxNXB4O2Zsb2F0OiBsZWZ0OyI+aGFzIGJlZW4gY29uZmlybWVkLjwvcD4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9InBhZGRpbmc6IDEwcHggMHB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3RleHQtYWxpZ246IGNlbnRlcjsiPg0KCQkJCQkJCQkJPGg1IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDEzcHg7bWFyZ2luOiAwcHggMHB4IDVweDsiPlRoYW5rIHlvdTwvaDU+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4JCQkJCQ0KCQkJCQk8L3RyPgkJCQkNCgkJCQk8L3Rib2R5Pg0KCQkJPC90YWJsZT4JDQoJCTwvZGl2Pg0KCTwvZGl2PgkNCjwvYm9keT4NCjwvaHRtbD4=', 'E', 'C', 'C'),
(4, 'Appointment Approved', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7YWRtaW5fbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5UaGUgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gd2l0aCBmb2xsb3dpbmcgZGV0YWlsczo8L3A+CQkJCQkJCQ0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0iZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7cGFkZGluZzogMTBweCAwcHg7Ij4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPldoZW46IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tib29raW5nX2RhdGV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Rm9yOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7c2VydmljZV9uYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk1ldGhvZHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bWV0aG9kbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Vbml0cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t1bml0c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGQtb25zIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZG9uc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QcmljZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twcmljZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQkNCgkJCQkJCQkJCQ0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+TmFtZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tmaXJzdG5hbWV9fSB7e2xhc3RuYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkVtYWlsIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2NsaWVudF9lbWFpbH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QaG9uZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twaG9uZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXltZW50IDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3BheW1lbnRfbWV0aG9kfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlZhY2N1bSBDbGVhbmVyIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3ZhY2N1bV9jbGVhbmVyX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXJraW5nIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3Bhcmtpbmdfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkFkZHJlc3MgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7YWRkcmVzc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Ob3RlcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tub3Rlc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Db250YWN0IFN0YXR1cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjb250YWN0X3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxNXB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjsiPg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDtsaW5lLWhlaWdodDogMjJweDttYXJnaW46IDEwcHggMHB4IDE1cHg7ZmxvYXQ6IGxlZnQ7Ij5oYXMgYmVlbiBjb25maXJtZWQuPC9wPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTBweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7dGV4dC1hbGlnbjogY2VudGVyOyI+DQoJCQkJCQkJCQk8aDUgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTNweDttYXJnaW46IDBweCAwcHggNXB4OyI+VGhhbmsgeW91PC9oNT4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJPC9kaXY+DQoJCQkJCQk8L3RkPgkJCQkJDQoJCQkJCTwvdHI+CQkJCQ0KCQkJCTwvdGJvZHk+DQoJCQk8L3RhYmxlPgkNCgkJPC9kaXY+DQoJPC9kaXY+CQ0KPC9ib2R5Pg0KPC9odG1sPg==', 'E', 'C', 'A'),
(5, 'Appointment Rejected', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7Y2xpZW50X25hbWV9fSw8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5Zb3VyIGFwcG9pbnRtZW50IHdpdGggZm9sbG93aW5nIGRldGFpbHM6PC9wPgkJCQkJCQkNCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9ImZsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3BhZGRpbmc6IDEwcHggMHB4OyI+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5XaGVuOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Ym9va2luZ19kYXRlfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkZvcjogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3NlcnZpY2VfbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5NZXRob2RzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e21ldGhvZG5hbWV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+VW5pdHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7dW5pdHN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+QWRkLW9ucyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3thZGRvbnN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UHJpY2UgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cHJpY2V9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJDQoJCQkJCQkJCQkNCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk5hbWUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Zmlyc3RuYW1lfX0ge3tsYXN0bmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5FbWFpbCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjbGllbnRfZW1haWx9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGhvbmUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cGhvbmV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGF5bWVudCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXltZW50X21ldGhvZH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5WYWNjdW0gQ2xlYW5lciA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t2YWNjdW1fY2xlYW5lcl9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGFya2luZyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXJraW5nX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGRyZXNzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZHJlc3N9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Tm90ZXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bm90ZXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Q29udGFjdCBTdGF0dXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Y29udGFjdF9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTVweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7Ym9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7Ij4NCgkJCQkJCQkJCTxwIHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bGluZS1oZWlnaHQ6IDIycHg7bWFyZ2luOiAxMHB4IDBweCAxNXB4O2Zsb2F0OiBsZWZ0OyI+aGFzIGJlZW4gcmVqZWN0ZWQuPC9wPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTBweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7dGV4dC1hbGlnbjogY2VudGVyOyI+DQoJCQkJCQkJCQk8aDUgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTNweDttYXJnaW46IDBweCAwcHggNXB4OyI+VGhhbmsgeW91PC9oNT4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJPC9kaXY+DQoJCQkJCQk8L3RkPgkJCQkJDQoJCQkJCTwvdHI+CQkJCQ0KCQkJCTwvdGJvZHk+DQoJCQk8L3RhYmxlPgkNCgkJPC9kaXY+DQoJPC9kaXY+CQ0KPC9ib2R5Pg0KPC9odG1sPg==', 'E', 'R', 'C'),
(6, 'Appointment Rejected', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7YWRtaW5fbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5UaGUgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gd2l0aCBmb2xsb3dpbmcgZGV0YWlsczo8L3A+CQkJCQkJCQ0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0iZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7cGFkZGluZzogMTBweCAwcHg7Ij4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPldoZW46IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tib29raW5nX2RhdGV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Rm9yOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7c2VydmljZV9uYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk1ldGhvZHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bWV0aG9kbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Vbml0cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t1bml0c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGQtb25zIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZG9uc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QcmljZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twcmljZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQkNCgkJCQkJCQkJCQ0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+TmFtZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tmaXJzdG5hbWV9fSB7e2xhc3RuYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkVtYWlsIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2NsaWVudF9lbWFpbH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QaG9uZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twaG9uZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXltZW50IDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3BheW1lbnRfbWV0aG9kfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlZhY2N1bSBDbGVhbmVyIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3ZhY2N1bV9jbGVhbmVyX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXJraW5nIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3Bhcmtpbmdfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkFkZHJlc3MgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7YWRkcmVzc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Ob3RlcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tub3Rlc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Db250YWN0IFN0YXR1cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjb250YWN0X3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxNXB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjsiPg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDtsaW5lLWhlaWdodDogMjJweDttYXJnaW46IDEwcHggMHB4IDE1cHg7ZmxvYXQ6IGxlZnQ7Ij5oYXMgYmVlbiByZWplY3RlZC48L3A+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxMHB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazt0ZXh0LWFsaWduOiBjZW50ZXI7Ij4NCgkJCQkJCQkJCTxoNSBzdHlsZT0iY29sb3I6ICM2MDYwNjA7Zm9udC1zaXplOiAxM3B4O21hcmdpbjogMHB4IDBweCA1cHg7Ij5UaGFuayB5b3U8L2g1Pg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+CQkJCQkNCgkJCQkJPC90cj4JCQkJDQoJCQkJPC90Ym9keT4NCgkJCTwvdGFibGU+CQ0KCQk8L2Rpdj4NCgk8L2Rpdj4JDQo8L2JvZHk+DQo8L2h0bWw+', 'E', 'R', 'A'),
(7, 'Appointment Cancelled by you', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7Y2xpZW50X25hbWV9fSw8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5Zb3VyIGFwcG9pbnRtZW50IHdpdGggZm9sbG93aW5nIGRldGFpbHM6PC9wPgkJCQkJCQkNCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9ImZsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3BhZGRpbmc6IDEwcHggMHB4OyI+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5XaGVuOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Ym9va2luZ19kYXRlfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkZvcjogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3NlcnZpY2VfbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5NZXRob2RzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e21ldGhvZG5hbWV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+VW5pdHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7dW5pdHN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+QWRkLW9ucyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3thZGRvbnN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UHJpY2UgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cHJpY2V9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJDQoJCQkJCQkJCQkNCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk5hbWUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Zmlyc3RuYW1lfX0ge3tsYXN0bmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5FbWFpbCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjbGllbnRfZW1haWx9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGhvbmUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cGhvbmV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGF5bWVudCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXltZW50X21ldGhvZH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5WYWNjdW0gQ2xlYW5lciA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t2YWNjdW1fY2xlYW5lcl9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGFya2luZyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXJraW5nX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGRyZXNzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZHJlc3N9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Tm90ZXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bm90ZXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Q29udGFjdCBTdGF0dXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Y29udGFjdF9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTVweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7Ym9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7Ij4NCgkJCQkJCQkJCTxwIHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bGluZS1oZWlnaHQ6IDIycHg7bWFyZ2luOiAxMHB4IDBweCAxNXB4O2Zsb2F0OiBsZWZ0OyI+aGFzIGJlZW4gY2FuY2VsbGVkLjwvcD4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9InBhZGRpbmc6IDEwcHggMHB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3RleHQtYWxpZ246IGNlbnRlcjsiPg0KCQkJCQkJCQkJPGg1IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDEzcHg7bWFyZ2luOiAwcHggMHB4IDVweDsiPlRoYW5rIHlvdTwvaDU+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4JCQkJCQ0KCQkJCQk8L3RyPgkJCQkNCgkJCQk8L3Rib2R5Pg0KCQkJPC90YWJsZT4JDQoJCTwvZGl2Pg0KCTwvZGl2PgkNCjwvYm9keT4NCjwvaHRtbD4=', 'E', 'CC', 'C'),
(8, 'Appointment Cancelled By Customer', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7YWRtaW5fbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5UaGUgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gd2l0aCBmb2xsb3dpbmcgZGV0YWlsczo8L3A+CQkJCQkJCQ0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0iZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7cGFkZGluZzogMTBweCAwcHg7Ij4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPldoZW46IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tib29raW5nX2RhdGV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Rm9yOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7c2VydmljZV9uYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk1ldGhvZHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bWV0aG9kbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Vbml0cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t1bml0c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGQtb25zIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZG9uc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QcmljZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twcmljZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQkNCgkJCQkJCQkJCQ0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+TmFtZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tmaXJzdG5hbWV9fSB7e2xhc3RuYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkVtYWlsIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2NsaWVudF9lbWFpbH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QaG9uZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twaG9uZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXltZW50IDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3BheW1lbnRfbWV0aG9kfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlZhY2N1bSBDbGVhbmVyIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3ZhY2N1bV9jbGVhbmVyX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXJraW5nIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3Bhcmtpbmdfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkFkZHJlc3MgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7YWRkcmVzc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Ob3RlcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tub3Rlc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Db250YWN0IFN0YXR1cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjb250YWN0X3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxNXB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjsiPg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDtsaW5lLWhlaWdodDogMjJweDttYXJnaW46IDEwcHggMHB4IDE1cHg7ZmxvYXQ6IGxlZnQ7Ij5oYXMgYmVlbiBjYW5jZWxsZWQuPC9wPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTBweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7dGV4dC1hbGlnbjogY2VudGVyOyI+DQoJCQkJCQkJCQk8aDUgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTNweDttYXJnaW46IDBweCAwcHggNXB4OyI+VGhhbmsgeW91PC9oNT4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJPC9kaXY+DQoJCQkJCQk8L3RkPgkJCQkJDQoJCQkJCTwvdHI+CQkJCQ0KCQkJCTwvdGJvZHk+DQoJCQk8L3RhYmxlPgkNCgkJPC9kaXY+DQoJPC9kaXY+CQ0KPC9ib2R5Pg0KPC9odG1sPg==', 'E', 'CC', 'A'),
(9, 'Appointment Rescheduled by you', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7Y2xpZW50X25hbWV9fSw8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5Zb3VyIGFwcG9pbnRtZW50IHdpdGggZm9sbG93aW5nIGRldGFpbHM6PC9wPgkJCQkJCQkNCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9ImZsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3BhZGRpbmc6IDEwcHggMHB4OyI+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5XaGVuOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Ym9va2luZ19kYXRlfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkZvcjogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3NlcnZpY2VfbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5NZXRob2RzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e21ldGhvZG5hbWV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+VW5pdHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7dW5pdHN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+QWRkLW9ucyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3thZGRvbnN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UHJpY2UgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cHJpY2V9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJDQoJCQkJCQkJCQkNCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk5hbWUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Zmlyc3RuYW1lfX0ge3tsYXN0bmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5FbWFpbCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjbGllbnRfZW1haWx9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGhvbmUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cGhvbmV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGF5bWVudCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXltZW50X21ldGhvZH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5WYWNjdW0gQ2xlYW5lciA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t2YWNjdW1fY2xlYW5lcl9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGFya2luZyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXJraW5nX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGRyZXNzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZHJlc3N9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Tm90ZXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bm90ZXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Q29udGFjdCBTdGF0dXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Y29udGFjdF9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTVweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7Ym9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7Ij4NCgkJCQkJCQkJCTxwIHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bGluZS1oZWlnaHQ6IDIycHg7bWFyZ2luOiAxMHB4IDBweCAxNXB4O2Zsb2F0OiBsZWZ0OyI+aGFzIGJlZW4gcmVzY2hlZHVsZWQuPC9wPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTBweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7dGV4dC1hbGlnbjogY2VudGVyOyI+DQoJCQkJCQkJCQk8aDUgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTNweDttYXJnaW46IDBweCAwcHggNXB4OyI+VGhhbmsgeW91PC9oNT4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJPC9kaXY+DQoJCQkJCQk8L3RkPgkJCQkJDQoJCQkJCTwvdHI+CQkJCQ0KCQkJCTwvdGJvZHk+DQoJCQk8L3RhYmxlPgkNCgkJPC9kaXY+DQoJPC9kaXY+CQ0KPC9ib2R5Pg0KPC9odG1sPg==', 'E', 'RS', 'C'),
(10, 'Appointment Rescheduled By Customer', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7YWRtaW5fbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5UaGUgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gd2l0aCBmb2xsb3dpbmcgZGV0YWlsczo8L3A+CQkJCQkJCQ0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0iZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7cGFkZGluZzogMTBweCAwcHg7Ij4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPldoZW46IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tib29raW5nX2RhdGV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Rm9yOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7c2VydmljZV9uYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk1ldGhvZHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bWV0aG9kbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Vbml0cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t1bml0c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGQtb25zIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZG9uc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QcmljZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twcmljZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQkNCgkJCQkJCQkJCQ0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+TmFtZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tmaXJzdG5hbWV9fSB7e2xhc3RuYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkVtYWlsIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2NsaWVudF9lbWFpbH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QaG9uZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twaG9uZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXltZW50IDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3BheW1lbnRfbWV0aG9kfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlZhY2N1bSBDbGVhbmVyIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3ZhY2N1bV9jbGVhbmVyX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXJraW5nIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3Bhcmtpbmdfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkFkZHJlc3MgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7YWRkcmVzc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Ob3RlcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tub3Rlc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Db250YWN0IFN0YXR1cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjb250YWN0X3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxNXB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjsiPg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDtsaW5lLWhlaWdodDogMjJweDttYXJnaW46IDEwcHggMHB4IDE1cHg7ZmxvYXQ6IGxlZnQ7Ij5oYXMgYmVlbiByZXNjaGVkdWxlZC48L3A+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxMHB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazt0ZXh0LWFsaWduOiBjZW50ZXI7Ij4NCgkJCQkJCQkJCTxoNSBzdHlsZT0iY29sb3I6ICM2MDYwNjA7Zm9udC1zaXplOiAxM3B4O21hcmdpbjogMHB4IDBweCA1cHg7Ij5UaGFuayB5b3U8L2g1Pg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+CQkJCQkNCgkJCQkJPC90cj4JCQkJDQoJCQkJPC90Ym9keT4NCgkJCTwvdGFibGU+CQ0KCQk8L2Rpdj4NCgk8L2Rpdj4JDQo8L2JvZHk+DQo8L2h0bWw+', 'E', 'RS', 'A'),
(11, 'Client Appointment Reminder', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7Y2xpZW50X25hbWV9fSw8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5XZSBqdXN0IHdhbnRlZCB0byByZW1pbmQgeW91IHRoYXQgeW91ciBhcHBvaW50bWVudCB3aXRoIHt7YWRtaW5fbmFtZX19IGlzIHNjaGVkdWxlZCBpbiA8Yj57e2FwcF9yZW1haW5fdGltZX19PC9iPiBob3Vycy48L3A+CQkJCQkJCQ0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0iZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7cGFkZGluZzogMTBweCAwcHg7Ij4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPldoZW46IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tib29raW5nX2RhdGV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Rm9yOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7c2VydmljZV9uYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk1ldGhvZHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bWV0aG9kbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Vbml0cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t1bml0c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGQtb25zIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZG9uc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QcmljZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twcmljZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQkNCgkJCQkJCQkJCQ0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+TmFtZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tmaXJzdG5hbWV9fSB7e2xhc3RuYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkVtYWlsIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2NsaWVudF9lbWFpbH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QaG9uZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twaG9uZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXltZW50IDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3BheW1lbnRfbWV0aG9kfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlZhY2N1bSBDbGVhbmVyIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3ZhY2N1bV9jbGVhbmVyX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXJraW5nIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3Bhcmtpbmdfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkFkZHJlc3MgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7YWRkcmVzc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Ob3RlcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tub3Rlc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Db250YWN0IFN0YXR1cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjb250YWN0X3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxNXB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjsiPg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDtsaW5lLWhlaWdodDogMjJweDttYXJnaW46IDEwcHggMHB4IDE1cHg7ZmxvYXQ6IGxlZnQ7Ij48L3A+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxMHB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazt0ZXh0LWFsaWduOiBjZW50ZXI7Ij4NCgkJCQkJCQkJCTxoNSBzdHlsZT0iY29sb3I6ICM2MDYwNjA7Zm9udC1zaXplOiAxM3B4O21hcmdpbjogMHB4IDBweCA1cHg7Ij5UaGFuayB5b3U8L2g1Pg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+CQkJCQkNCgkJCQkJPC90cj4JCQkJDQoJCQkJPC90Ym9keT4NCgkJCTwvdGFibGU+CQ0KCQk8L2Rpdj4NCgk8L2Rpdj4JDQo8L2JvZHk+DQo8L2h0bWw+', 'E', 'RM', 'C'),
(12, 'Admin Appointment Reminder', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7YWRtaW5fbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5XZSBqdXN0IHdhbnRlZCB0byByZW1pbmQgeW91IHRoYXQgeW91IGhhdmUgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gaXMgc2NoZWR1bGVkIGluIDxiPnt7YXBwX3JlbWFpbl90aW1lfX08L2I+IGhvdXJzLjwvcD4JCQkJCQkJDQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jaztwYWRkaW5nOiAxMHB4IDBweDsiPg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+V2hlbjogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2Jvb2tpbmdfZGF0ZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Gb3I6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tzZXJ2aWNlX25hbWV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+TWV0aG9kcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3ttZXRob2RuYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlVuaXRzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3VuaXRzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkFkZC1vbnMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7YWRkb25zfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlByaWNlIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3ByaWNlfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCQ0KCQkJCQkJCQkJDQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5OYW1lIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2ZpcnN0bmFtZX19IHt7bGFzdG5hbWV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+RW1haWwgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Y2xpZW50X2VtYWlsfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlBob25lIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3Bob25lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlBheW1lbnQgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cGF5bWVudF9tZXRob2R9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+VmFjY3VtIENsZWFuZXIgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7dmFjY3VtX2NsZWFuZXJfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlBhcmtpbmcgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cGFya2luZ19zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+QWRkcmVzcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3thZGRyZXNzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk5vdGVzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e25vdGVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkNvbnRhY3QgU3RhdHVzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2NvbnRhY3Rfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9InBhZGRpbmc6IDE1cHggMHB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2JvcmRlci1ib3R0b206IDFweCBzb2xpZCAjZTZlNmU2OyI+DQoJCQkJCQkJCQk8cCBzdHlsZT0iY29sb3I6ICM2MDYwNjA7Zm9udC1zaXplOiAxNXB4O2xpbmUtaGVpZ2h0OiAyMnB4O21hcmdpbjogMTBweCAwcHggMTVweDtmbG9hdDogbGVmdDsiPjwvcD4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9InBhZGRpbmc6IDEwcHggMHB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3RleHQtYWxpZ246IGNlbnRlcjsiPg0KCQkJCQkJCQkJPGg1IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDEzcHg7bWFyZ2luOiAwcHggMHB4IDVweDsiPlRoYW5rIHlvdTwvaDU+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4JCQkJCQ0KCQkJCQk8L3RyPgkJCQkNCgkJCQk8L3Rib2R5Pg0KCQkJPC90YWJsZT4JDQoJCTwvZGl2Pg0KCTwvZGl2PgkNCjwvYm9keT4NCjwvaHRtbD4=', 'E', 'RM', 'A');";
		mysqli_query($this->conn,$email_template_insert);
		
        $alllang = $this->get_all_languages();
        while($all = mysqli_fetch_array($alllang))
        {
            $language_label_arr = $this->get_all_labelsbyid($all[2]);
            $label_language_arr_first = $language_label_arr[1];
            $label_explode = explode("###",$label_language_arr_first);

            $label_decode_front = base64_decode($label_explode[0]);
            $label_decode_admin = base64_decode($label_explode[1]);
            $label_decode_error = base64_decode($label_explode[2]);
            $label_decode_extra = base64_decode($label_explode[3]);

            $label_decode_front_unserial = unserialize($label_decode_front);
            $label_decode_admin_unserial = unserialize($label_decode_admin);
            $label_decode_error_unserial = unserialize($label_decode_error);
            $label_decode_extra_unserial = unserialize($label_decode_extra);

            /* Add all labels which you want to add in new version from here */
            /* DEMO FOR ADDING LABEL */
			
			$label_decode_admin_unserial['company_settings'] = "Business Info Settings";	
			$label_decode_admin_unserial['select_language_to_display'] = "Language";	
			$label_decode_admin_unserial['company_name'] = "Business Name";
			$label_decode_admin_unserial['company_email'] = "Email";
			$label_decode_admin_unserial['default_country_code'] = "Country Code";
			$label_decode_admin_unserial['company_address'] = "Address";
			$label_decode_admin_unserial['currency_symbol_position'] = "Currency Symbol Position";		
			$label_decode_admin_unserial['price_format_decimal_places'] = "Price Format";		
			$label_decode_admin_unserial['cancellation_policy'] = "Cancellation Policy";
			$label_decode_admin_unserial['allow_multiple_booking_for_same_timeslot'] = "Allow Multiple Booking For Same Timeslot";	
			$label_decode_admin_unserial['privacy_policy'] = "Privacy Policy Link";	
			$label_decode_admin_unserial['right_side_description'] = "Booking Page Rightside Description";	
			$label_decode_admin_unserial['display_sub_headers_below_headers'] = "Sub Headings on Booking page ";	
			$label_decode_admin_unserial['sender_email_address_cleanto_admin_email'] = "Sender Email";
			$label_decode_admin_unserial['admin_profile_address'] = "Address";
			
            $label_decode_front_unserial= $this->array_push_assoc($label_decode_front_unserial, 'eg_799_e_dragram_suite_5a', 'eg. 799 E DRAGRAM SUITE 5A');
            $label_decode_front_unserial= $this->array_push_assoc($label_decode_front_unserial, 'eg_14114', 'eg. 14114');
            $label_decode_front_unserial= $this->array_push_assoc($label_decode_front_unserial, 'eg_tucson', 'eg. TUCSON');
            $label_decode_front_unserial= $this->array_push_assoc($label_decode_front_unserial, 'eg_az', 'eg. AZ');
			$label_decode_front_unserial= $this->array_push_assoc($label_decode_front_unserial, 'choose_your_service', 'Choose Your Service');
			

            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'transaction_id', 'Transaction ID');
			
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'sms_reminder', 'SMS Reminder');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'save_sms_settings', 'Save SMS Settings');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'sms_service', 'SMS Service');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'it_will_send_sms_to_service_provider_and_client_for_appointment_booking', 'It will send sms to service provider and client for appointment booking');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'twilio_account_settings', 'Twilio Account Settings');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'plivo_account_settings', 'Plivo Account Settings');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'account_sid', 'Account SID');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'auth_token', 'Auth Token');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'twilio_sender_number', 'Twilio Sender Number');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'plivo_sender_number', 'Plivo Sender Number');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'twilio_sms_settings', 'Twilio SMS Settings');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'plivo_sms_settings', 'Plivo SMS Settings');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'twilio_sms_gateway', 'Twilio SMS Gateway');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'plivo_sms_gateway', 'Plivo SMS Gateway');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'send_sms_to_client', 'Send SMS To Client');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'send_sms_to_admin', 'Send SMS To Admin');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'admin_phone_number', 'Admin Phone Number');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'available_from_within_your_twilio_account', 'Available from within your Twilio Account.');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'must_be_a_valid_number_associated_with_your_twilio_account', 'Must be a valid number associated with your Twilio account.');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'enable_or_disable_send_sms_to_client_for_appointment_booking_info', 'Enable or Disable, Send SMS to client for appointment booking info.');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'enable_or_disable_send_sms_to_admin_for_appointment_booking_info', 'Enable or Disable, Send SMS to admin for appointment booking info.');
			
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'updated_sms_settings', 'Updated SMS Settings');
            
			$label_decode_error_unserial= $this->array_push_assoc($label_decode_error_unserial, 'please_enter_account_sid', 'Please enter Accout SID');
            $label_decode_error_unserial= $this->array_push_assoc($label_decode_error_unserial, 'please_enter_auth_token', 'Please enter Auth Token');
            $label_decode_error_unserial= $this->array_push_assoc($label_decode_error_unserial, 'please_enter_sender_number', 'Please enter Sender Number');
            $label_decode_error_unserial= $this->array_push_assoc($label_decode_error_unserial, 'please_enter_admin_number', 'Please enter Admin Number');
			
			$label_decode_error_unserial= $this->array_push_assoc($label_decode_error_unserial, 'sorry_service_already_exist', 'Sorry service already exist');
			/*MAINTAINANCE PAGE STRINGS*/
			$label_decode_front_unserial= $this->array_push_assoc($label_decode_front_unserial,'warning','Warning');
			$label_decode_front_unserial= $this->array_push_assoc($label_decode_front_unserial,'try_later','Try Later');
			/*FRONT LABEL*/
			$label_decode_front_unserial= $this->array_push_assoc($label_decode_front_unserial,'choose_your','Choose Your');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'parking_availability_frontend_option_display_status','Parking');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'vaccum_cleaner_frontend_option_display_status','Vaccum Cleaner');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'o_n','On');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'off','Off');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'enable','Enable');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'disable','Disable');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'monthly','Monthly');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'weekly','Weekly');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'email_template','EMAIL TEMPLATE');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'sms_notification','SMS NOTIFICATION');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'sms_template','SMS TEMPLATE');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'email_template_settings','Email Template Settings');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'client_email_templates','Client Email Template');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'client_sms_templates','Client SMS Template');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'admin_email_template','Admin Email Template');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'admin_sms_template','Admin SMS Template');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'tags','Tags');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'booking_date','booking_date');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'service_name','service_name');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'business_logo','business_logo');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'business_logo_alt','business_logo_alt');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'admin_name','admin_name');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'client_name','client_name');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'methodname','method_name');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'firstname','firstname');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'lastname','lastname');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'client_email','client_email');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'vaccum_cleaner_status','vaccum_cleaner_status');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'parking_status','parking_status');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'app_remain_time','app_remain_time');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'reject_status','reject_status');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'save_template','Save Template');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'default_template','Default Template');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'sms_template_settings','SMS Template Settings');
			
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'secret_key','Secret Key');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'publishable_key','Publishable Key');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'payment_form','Payment Form');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'api_login_id','API Login ID');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'transaction_key','Transaction Key');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial,'sandbox_mode','Sandbox Mode');
			
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'available_from_within_your_plivo_account', 'Available from within your Plivo Account.');
            $label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'must_be_a_valid_number_associated_with_your_plivo_account', 'Must be a valid number associated with your Plivo account.');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'whats_new', "What's new?");
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'company_phone', 'Company Phone');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'default_country_code', 'Default Country Code');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'company__name', 'company_name');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'booking_time', 'booking_time');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'company__address','company_address');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'company__zip','company_zip');			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'company__email','company_email');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'company__phone','company_phone');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'company__state','company_state');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'company__country','company_country');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'company__city','company_city');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'client__zip','client_zip');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'client__state','client_state');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'client__city','client_city');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'client__address','client_address');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'client__phone','client_phone');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'administrator_email','Administrator Email');
			$label_decode_admin_unserial= $this->array_push_assoc($label_decode_admin_unserial, 'company_logo_is_used_for_invoice_purpose','Company logo is used for invoice purpose');
			

			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
            $language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
            $language_error_arr = base64_encode(serialize($label_decode_error_unserial));
            $language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));

            $languagearr = $language_front_arr."###".$language_admin_arr."###".$language_error_arr."###".$language_extra_arr;

            $update_default_lang = "UPDATE `ct_languages` SET `label_data` = '".$languagearr."' WHERE `language` = '".$all[2]."'";
            mysqli_query($this->conn, $update_default_lang);
        }
    }
	public function update1_4()
	{
		$this->insert_option('ct_2checkout_sandbox_mode','Y');
		$this->insert_option('ct_2checkout_privatekey','');
		$this->insert_option('ct_2checkout_publishkey','');
		$this->insert_option('ct_2checkout_sellerid','');
		$this->insert_option('ct_2checkout_status','N');
		$this->insert_option('ct_postalcode_status','Y');
		$delete_option_partial = "delete from `ct_settings` where `option_name` = 'ct_partial_deposit_type'";
		$result_delete_option_partial =  mysqli_query($this->conn, $delete_option_partial);
        $alllang = $this->get_all_languages();
        while($all = mysqli_fetch_array($alllang)) {
            $language_label_arr = $this->get_all_labelsbyid($all[2]);
            $label_language_arr_first = $language_label_arr[1];
            $label_explode = explode("###", $label_language_arr_first);

            $label_decode_front = base64_decode($label_explode[0]);
            $label_decode_admin = base64_decode($label_explode[1]);
            $label_decode_error = base64_decode($label_explode[2]);
            $label_decode_extra = base64_decode($label_explode[3]);

            $label_decode_front_unserial = unserialize($label_decode_front);
            $label_decode_admin_unserial = unserialize($label_decode_admin);
            $label_decode_error_unserial = unserialize($label_decode_error);
            $label_decode_extra_unserial = unserialize($label_decode_extra);

            /* Add all labels which you want to add in new version from here */
            /* DEMO FOR ADDING LABEL */
           
            $label_decode_error_unserial['please_enter_api_login_id'] = "Please Enter API Login ID";
            $label_decode_error_unserial['please_enter_transaction_key'] = "Please Enter Transaction Key";
            $label_decode_error_unserial['please_enter_secret_key'] = "Please Enter Secret Key";
            $label_decode_error_unserial['please_enter_publishable_key'] = "Please Enter Publishable Key";
            $label_decode_error_unserial['please_enter_sms_message'] = "Please enter sms message";
            $label_decode_error_unserial['please_enter_email_message'] = "Please enter email message";
            $label_decode_error_unserial['please_enter_some_qty'] = "Please Enter Some Qty";
            $label_decode_error_unserial['please_enter_private_key'] = "Please Enter Private Key";
            $label_decode_error_unserial['please_enter_seller_id'] = "Please Enter Seller ID";
            $label_decode_error_unserial['please_enter_valid_value_for_discount'] = "Please enter valid value for discount";
            
            $label_decode_admin_unserial['private_key'] = "Private Key";
            $label_decode_admin_unserial['seller_id'] = "Seller ID";
			
			$label_decode_admin_unserial["postal_codes_ed"] = "You can Enable or Disable Postal or Zip codes feature as per your country requirements, as some countries like UAE has not postal code.";
			
			$label_decode_admin_unserial["postal_codes_info"] = "You can mention postal codes in two ways:
#1. You can mention full post codes for match like K1A232,L2A334,C3A4C4.
#2. You can use partial postal codes for wild card match entries,e.g. K1A,L2A,C3 ,system will match those starting letters of postal code on front and it will avoid you to write so many postal codes.";
			
			
			$label_decode_front_unserial['your_postal_code'] = "Zip or Postal Code";
			$label_decode_front_unserial["configure_now_new"] = "Configure Now";
			
			 
            $language_front_arr = base64_encode(serialize($label_decode_front_unserial));
            $language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
            $language_error_arr = base64_encode(serialize($label_decode_error_unserial));
            $language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));

            $languagearr = $language_front_arr."###".$language_admin_arr."###".$language_error_arr."###".$language_extra_arr;

            $update_default_lang = "UPDATE `ct_languages` SET `label_data` = '".$languagearr."' WHERE `language` = '".$all[2]."'";
            mysqli_query($this->conn, $update_default_lang);
        }
    }
	
	
	public function update1_5()
	{
		/* $update_label_field = "ALTER TABLE  `ct_languages` CHANGE  `label_data`  `label_data` MEDIUMTEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL"; */
		$update_label_field = "ALTER TABLE `ct_languages` CHANGE `label_data` `label_data` LONGTEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;";
        mysqli_query($this->conn, $update_label_field);
		
		$update_settings_table = "ALTER TABLE  `ct_settings` ADD  `postalcode` MEDIUMTEXT NOT NULL;";
        mysqli_query($this->conn, $update_settings_table);
		
		
		$this->insert_option('ct_front_image', '');
		$this->insert_option('ct_company_logo_display', 'N');
		$this->insert_option('ct_user_zip_code','Y');
		$this->insert_option('ct_login_image', '');
		$this->insert_option('ct_company_header_address', 'Y');
		$this->insert_option('ct_front_tool_tips_status',"");
		$this->insert_option('ct_front_tool_tips_my_bookings',"");
		$this->insert_option('ct_front_tool_tips_postal_code',"");
		$this->insert_option('ct_front_tool_tips_services',"");
		$this->insert_option('ct_front_tool_tips_addons_services',"");
		$this->insert_option('ct_front_tool_tips_frequently_discount',"");
		$this->insert_option('ct_front_tool_tips_time_slots',"");
		$this->insert_option('ct_front_tool_tips_personal_details',"");
		$this->insert_option('ct_front_tool_tips_promocode',"");
		$this->insert_option('ct_front_tool_payment_method',"");
		$this->insert_option('ct_sms_nexmo_status',"");
		$this->insert_option('ct_nexmo_api_key',"");
		$this->insert_option('ct_nexmo_api_secret',"");
		$this->insert_option('ct_nexmo_from',"");
		$this->insert_option('ct_nexmo_status',"");
		$this->insert_option('ct_sms_nexmo_send_sms_to_client_status',"");
		$this->insert_option('ct_sms_nexmo_send_sms_to_admin_status',"");
		$this->insert_option('ct_sms_nexmo_admin_phone_number',"");
		$this->insert_option('ct_existing_and_new_user_checkout',"on");
		$this->insert_option('ct_payumoney_salt',"");
		$this->insert_option('ct_payumoney_merchant_key',"");
		$this->insert_option('ct_payumoney_status',"N");
		$this->insert_option('ct_sms_textlocal_account_username','');
		$this->insert_option('ct_sms_textlocal_account_hash_id','');
		$this->insert_option('ct_sms_textlocal_send_sms_to_client_status','N');
		$this->insert_option('ct_sms_textlocal_send_sms_to_admin_status','N');
		$this->insert_option('ct_sms_textlocal_status','N');
		$this->insert_option('ct_sms_textlocal_admin_phone','');
		
		$check_option_of_cart_scrollable_query = "SELECT * FROM `ct_settings` WHERE `option_name` = 'ct_cart_scrollable'";
		$check_option_of_cart_scrollable = mysqli_query($this->conn, $check_option_of_cart_scrollable_query);
		
		if(mysqli_num_rows($check_option_of_cart_scrollable) == 0){
			$this->insert_option('ct_cart_scrollable',"Y");
		}
		
        mysqli_query($this->conn, $update_label_field);
		$alllang = $this->get_all_languages();
        while($all = mysqli_fetch_array($alllang))
        {
            $language_label_arr = $this->get_all_labelsbyid($all[2]);
            $label_language_arr_first = $language_label_arr[1];
            $label_explode = explode("###",$label_language_arr_first);

            $label_decode_front = base64_decode($label_explode[0]);
            $label_decode_admin = base64_decode($label_explode[1]);
            $label_decode_error = base64_decode($label_explode[2]);
            $label_decode_extra = base64_decode($label_explode[3]);

            $label_decode_front_unserial = unserialize($label_decode_front);
            $label_decode_admin_unserial = unserialize($label_decode_admin);
            $label_decode_error_unserial = unserialize($label_decode_error);
            $label_decode_extra_unserial = unserialize($label_decode_extra);
			
			/* UPDATE ALL CODE WITH NEW URLENCODE PATTERN */
			foreach($label_decode_front_unserial as $key => $value){
				$label_decode_front_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_admin_unserial as $key => $value){
				$label_decode_admin_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_error_unserial as $key => $value){
				$label_decode_error_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_extra_unserial as $key => $value){
				$label_decode_extra_unserial[$key] = urldecode($value);
			}
			
            /* Add all labels which you want to add in new version from here */
            /* DEMO FOR ADDING LABEL */
			
			$label_decode_front_unserial['sun'] = urlencode("Sun");
			$label_decode_front_unserial['mon'] = urlencode("Mon");
			$label_decode_front_unserial['tue'] = urlencode("Tue");
			$label_decode_front_unserial['wed'] = urlencode("Wed");
			$label_decode_front_unserial['thu'] = urlencode("Thu");
			$label_decode_front_unserial['fri'] = urlencode("Fri");
			$label_decode_front_unserial['sat'] = urlencode("Sat");
			$label_decode_front_unserial['su'] = urlencode("Su");
			$label_decode_front_unserial['mo'] = urlencode("Mo");
			$label_decode_front_unserial['tu'] = urlencode("Tu");
			$label_decode_front_unserial['we'] = urlencode("We");
			$label_decode_front_unserial['th'] = urlencode("Th");
			$label_decode_front_unserial['fr'] = urlencode("Fr");
			$label_decode_front_unserial['sa'] = urlencode("Sa");
			$label_decode_front_unserial['none_available'] = urlencode("None Available");
			
			
			$label_decode_front_unserial['january'] = urlencode("JANUARY");
			$label_decode_front_unserial['february'] = urlencode("FEBRUARY");
			$label_decode_front_unserial['march'] = urlencode("MARCH");
			$label_decode_front_unserial['april'] = urlencode("APRIL");
			$label_decode_front_unserial['may'] = urlencode("MAY");
			$label_decode_front_unserial['june'] = urlencode("JUNE");
			$label_decode_front_unserial['july'] = urlencode("JULY");
			$label_decode_front_unserial['august'] = urlencode("AUGUST");
			$label_decode_front_unserial['september']= urlencode("SEPTEMBER");	
			$label_decode_front_unserial['october'] = urlencode("OCTOBER");
			$label_decode_front_unserial['november'] = urlencode("NOVEMBER");
			$label_decode_front_unserial['december'] = urlencode("DECEMBER");
			$label_decode_front_unserial['please_fill_all_the_company_informations_and_add_some_services_and_addons'] = urlencode("Please Fill all the Company Informations and add some Services, Addons and also make check with your time scheduling.");
			
			$label_decode_front_unserial['street_address_placeholder']=urlencode("e.g. Central Ave");
			$label_decode_front_unserial['zip_code_placeholder']=urlencode("e.g. 90001");
			$label_decode_front_unserial['city_placeholder']=urlencode("eg. Los Angeles");			$label_decode_front_unserial['state_placeholder']=urlencode("eg. CA");
			$label_decode_front_unserial['payumoney']=urlencode("PayUmoney");
			
			$label_decode_admin_unserial['merchant_key'] = urlencode("Merchant Key");
			$label_decode_admin_unserial['salt_key'] = urlencode("Salt Key");
			$label_decode_admin_unserial['company_logo_is_used_for_invoice_purpose'] = urlencode("Company Logo get used in email and booking page");
			$label_decode_admin_unserial['first'] = urlencode("First");
			$label_decode_admin_unserial["second"] = urlencode("Second");
			$label_decode_admin_unserial["third"] = urlencode("Third");
			$label_decode_admin_unserial["fourth"] = urlencode("Fourth");
			$label_decode_admin_unserial["fifth"] = urlencode("Fifth");
			$label_decode_admin_unserial["first_week"] = urlencode("First-Week");
			$label_decode_admin_unserial["second_week"] = urlencode("Second-Week");
			$label_decode_admin_unserial["third_week"] = urlencode("Third-Week");
			$label_decode_admin_unserial["fourth_week"] = urlencode("Fourth-Week");
			$label_decode_admin_unserial["fifth_week"] = urlencode("Fifth-Week");
			$label_decode_admin_unserial["this_week"] = urlencode("This Week");
			$label_decode_admin_unserial["calendar_today"] = urlencode("Today");
			$label_decode_admin_unserial["calendar_month"] = urlencode("Month");
			$label_decode_admin_unserial["calendar_week"] = urlencode("Week");
			$label_decode_admin_unserial["calendar_day"] = urlencode("Day");
			$label_decode_admin_unserial["guest_user"]=urlencode("Guest User");
			$label_decode_admin_unserial["existing_and_new_user_checkout"]=urlencode("Existing & new user checkout");
			$label_decode_admin_unserial["it_will_allow_option_for_user_to_get_booking_with_new_user_or_existing_user"]=urlencode("It will allow option for user to get booking with new user or existing user");
			$label_decode_admin_unserial["show_company_logo"]=urlencode("Show company logo");
			

			$label_decode_admin_unserial["restore_default"]=urlencode("Restore Default");
			$label_decode_admin_unserial[
"recommended_image_type_jpg_jpeg_png_gif"]=urlencode("(Recommended image type jpg,jpeg,png,gif)");
									
			$label_decode_admin_unserial["monday"]=urlencode("Monday");
			$label_decode_admin_unserial["tuesday"]=urlencode("Tuesday");
			$label_decode_admin_unserial["wednesday"]=urlencode("Wednesday");			$label_decode_admin_unserial["thursday"]=urlencode("Thursday");
			$label_decode_admin_unserial["friday"]=urlencode("Friday");
			$label_decode_admin_unserial["saturday"]=urlencode("Saturday");
			$label_decode_admin_unserial["sunday"]=urlencode("Sunday");
			
			$label_decode_admin_unserial["off_days_added_successfully"]=urlencode("Off Days added successfully");
			$label_decode_admin_unserial["off_days_deleted_successfully"]=urlencode("Off Days deleted successfully");
			$label_decode_admin_unserial["sorry_not_available"]=urlencode("Sorry Not Available");
			$label_decode_admin_unserial["success"]=urlencode("Sussess!");
			$label_decode_admin_unserial["failed"]=urlencode("Failed!");
			$label_decode_admin_unserial["once"]=urlencode("Once");
			$label_decode_admin_unserial["weekly"]=urlencode("Weekly");
			$label_decode_admin_unserial["bi_weekly"]=urlencode("Bi-Weekly");
			$label_decode_admin_unserial["monthly"]=urlencode("Monthly");
			$label_decode_admin_unserial["none"]=urlencode("None");
			$label_decode_admin_unserial["scrollable_cart"]=urlencode("Scrollable Cart");
			$label_decode_error_unserial["please_enter_account_username"]=urlencode("Please enter account username");
			$label_decode_error_unserial["please_enter_account_hash_id"]=urlencode("Please enter account hash id");
			
			$label_decode_admin_unserial["textlocal_sms_gateway"]=urlencode("Textlocal SMS Gateway");
			$label_decode_admin_unserial["textlocal_sms_settings"]=urlencode("Textlocal SMS Settings");
			$label_decode_admin_unserial["textlocal_account_settings"]=urlencode("Textlocal Account Settings");
			$label_decode_admin_unserial["account_username"]=urlencode("Account Username");
			$label_decode_admin_unserial["account_hash_id"]=urlencode("Account Hash ID");
			$label_decode_admin_unserial["email_id_registered_with_you_textlocal"]=urlencode("Provide your email registered with textlocal");
			$label_decode_admin_unserial["hash_id_provided_by_textlocal"]=urlencode("Hash id provided by textlocal");
			$label_decode_error_unserial["password_must_be_only_10_characters"]=urlencode("Password Must Be Only 10 Characters");
			$label_decode_error_unserial["customer_deleted_successfully"]=urlencode("Customer deleted successfully");
			$label_decode_error_unserial["sorry_no_notification"]=urlencode("Sorry, you have not any upcoming appointment");
			$label_decode_error_unserial["are_you_sure_you_want_to_delete_client"]=urlencode("Are You Sure You Want To Delete Client?");
			$label_decode_error_unserial["password_at_least_have_8_characters"]=urlencode("Password At Least Have 8 Characters");
			$label_decode_error_unserial["please_select_atleast_one_checkout_method"]=urlencode("Please select atleast one checkout method");
			$label_decode_error_unserial["please_enter_retype_new_password"]=urlencode("Please Enter Retype New Password");
			$label_decode_error_unserial["please_select_units_and_addons"]=urlencode("Please select units and addons");
			$label_decode_error_unserial["please_login_to_complete_booking"]=urlencode("Please login to complete booking");
			$label_decode_error_unserial["your_password_send_successfully_at_your_email_id"]=urlencode("Your Password Send Successfully At Your Email ID");
			$label_decode_error_unserial["invalid_email_id_please_register_first"]=urlencode("Invalid Email ID please register first");		
			$label_decode_error_unserial["please_select_expiry_date"]=urlencode("Please select expiry date");		
			$label_decode_error_unserial["please_enter_merchant_key"]=urlencode("Please enter Merchant Key");		
			$label_decode_error_unserial["please_enter_salt_key"]=urlencode("Please enter Salt Key");		
			
			$label_decode_admin_unserial["appointment request"]=urlencode("Appointment Request");
			$label_decode_admin_unserial["frequently_discount_setting_tabs"]=urlencode("FREQUENTLY DISCOUNT");
			$label_decode_admin_unserial["appointment_approved"]=urlencode("Appointment Approved");
			$label_decode_admin_unserial["appointment_rejected"]=urlencode("Appointment Rejected");
			$label_decode_admin_unserial["appointment_cancelled_by_you"]=urlencode("Appointment Cancelled by you");
			$label_decode_admin_unserial["appointment_rescheduled_by_you"]=urlencode("Appointment Rescheduled by you");
			$label_decode_admin_unserial["client_appointment_reminder"]=urlencode("Client Appointment Reminder");
			$label_decode_admin_unserial["new_appointment_request_requires_approval"]=urlencode("New Appointment Request Requires Approval");
			$label_decode_admin_unserial["appointment_cancelled_by_customer"]=urlencode("Appointment Cancelled By Customer");
			$label_decode_admin_unserial["appointment_rescheduled_by_customer"]=urlencode("Appointment Rescheduled By Customer");
			$label_decode_admin_unserial["guest_customers_bookings"]=urlencode("Guest Customers Bookings");
			$label_decode_admin_unserial["0_1"]=urlencode("01");
			$label_decode_admin_unserial["user_zip_code"]=urlencode("Zip Code");
			$label_decode_admin_unserial["delete_this_method"]=urlencode("Delete this method?");
			$label_decode_admin_unserial["1_1"]=urlencode("1.1");
			$label_decode_admin_unserial["1_2"]=urlencode("1.2");
			$label_decode_admin_unserial["0_2"]=urlencode("02");
			$label_decode_admin_unserial["wrong_url"]=urlencode("Wrong URL");
			$label_decode_admin_unserial["free"]=urlencode("Free");
			$label_decode_admin_unserial["o_n"]=urlencode("On");
			$label_decode_admin_unserial["show_company_address_in_header"]=urlencode("Show company address in header");
			$label_decode_admin_unserial["tax_vat"]=urlencode("Tax/Vat");
			$label_decode_admin_unserial["before_e_g_100"]=urlencode("Before(e.g.$100)");
			$label_decode_admin_unserial["after_e_g_100"]=urlencode("After(e.g.100$)");
			$label_decode_admin_unserial["dropdown_design"]=urlencode("DropDown Design");
			$label_decode_admin_unserial["blocks_as_button_design"]=urlencode("Blocks As Button Design");
			$label_decode_admin_unserial["qty_control_design"]=urlencode("Qty Control Design");
			$label_decode_admin_unserial["dropdowns"]=urlencode("DropDowns");
			$label_decode_admin_unserial["big_images_radio"]=urlencode("Big Images Radio");
			$label_decode_admin_unserial["login_page"]=urlencode("Login Page");
			$label_decode_admin_unserial["front_page"]=urlencode("Front Page");
			$label_decode_admin_unserial["choose_file"]=urlencode("Choose File");
			$label_decode_admin_unserial["authorize_net"]=urlencode("Authorize.Net");
			$label_decode_admin_unserial["stripe"]=urlencode("Stripe");
			$label_decode_admin_unserial["checkout_title"]=urlencode("2Checkout");
			$label_decode_admin_unserial["nexmo_sms_gateway"]=urlencode("Nexmo SMS Gateway");
			$label_decode_admin_unserial["nexmo_sms_setting"]=urlencode("Nexmo SMS Setting");
			$label_decode_admin_unserial["nexmo_api_key"]=urlencode("Nexmo API Key");
			$label_decode_admin_unserial["nexmo_api_secret"]=urlencode("Nexmo API Secret");
			$label_decode_admin_unserial["nexmo_from"]=urlencode("Nexmo From");
			$label_decode_admin_unserial["nexmo_status"]=urlencode("Nexmo Status");
			$label_decode_admin_unserial["nexmo_send_sms_to_client_status"]=urlencode("Nexmo Send Sms To Client Status");
			$label_decode_admin_unserial["nexmo_send_sms_to_admin_status"]=urlencode("Nexmo Send Sms To admin Status");
			$label_decode_admin_unserial["nexmo_admin_phone_number"]=urlencode("Nexmo Admin Phone Number");
			$label_decode_admin_unserial["save_12_5"]=urlencode("save 12.5 %");
			$label_decode_admin_unserial["front_tool_tips"]=urlencode("FRONT TOOL TIPS");
			$label_decode_admin_unserial["front_tool_tips_lower"]=urlencode("Front Tool Tips");
			$label_decode_admin_unserial["tool_tip_my_bookings"]=urlencode("My Bookings");
			$label_decode_admin_unserial["tool_tip_postal_code"]=urlencode("Postal Code");
			$label_decode_admin_unserial["tool_tip_services"]=urlencode("Services");
			$label_decode_admin_unserial["tool_tip_extra_service"]=urlencode("Extra service");
			$label_decode_admin_unserial["tool_tip_frequently_discount"]=urlencode("Frequently discount");
			$label_decode_admin_unserial["tool_tip_when_would_you_like_us_to_come"]=urlencode("When would you like us to come?");
			$label_decode_admin_unserial["tool_tip_your_personal_details"]=urlencode("Your Personal Details");
			$label_decode_admin_unserial["tool_tip_have_a_promocode"]=urlencode("Have A Promocode");
			$label_decode_admin_unserial["tool_tip_preferred_payment_method"]=urlencode("Preferred Payment Method");
			$label_decode_admin_unserial["admin_appointment_reminder"]=urlencode("Admin Appointment Reminder");
			$label_decode_front_unserial["pay_locally"] =urlencode("Pay Locally");
			$label_decode_front_unserial["expiry_date_or_csv"] =urlencode("Expiry date or CSV");
			$label_decode_front_unserial["mm_yyyy"] =urlencode("(MM/YYYY)");
			$label_decode_front_unserial["cvc"] =urlencode("CVC");
			$label_decode_front_unserial["paypal"] =urlencode("Paypal");
			$label_decode_front_unserial["service_usage_methods"] =urlencode("Service Usage Methods");
			$label_decode_error_unserial["please_select_atleast_one_unit"] =urlencode("Please select atleast one unit");
			

			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
            $language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
            $language_error_arr = base64_encode(serialize($label_decode_error_unserial));
            $language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));

            $languagearr = $language_front_arr."###".$language_admin_arr."###".$language_error_arr."###".$language_extra_arr;

            $update_default_lang = "UPDATE `ct_languages` SET `label_data` = '".$languagearr."' WHERE `language` = '".$all[2]."'";
            mysqli_query($this->conn, $update_default_lang);
		}
	}
	
	public function update1_6()
	{
		$this->insert_option('ct_payumoney_salt',"");
		$this->insert_option('ct_payumoney_merchant_key',"");
		$this->insert_option('ct_payumoney_status',"N");
		$this->insert_option('ct_sms_textlocal_account_username','');
		$this->insert_option('ct_sms_textlocal_account_hash_id','');
		$this->insert_option('ct_sms_textlocal_send_sms_to_client_status','N');
		$this->insert_option('ct_sms_textlocal_send_sms_to_admin_status','N');
		$this->insert_option('ct_sms_textlocal_status','N');
		$this->insert_option('ct_sms_textlocal_admin_phone','');
		$this->insert_option('ct_company_service_desc_status','N');
		$this->insert_option('ct_company_willwe_getin_status','N');
		$this->insert_option('ct_bank_name','');
		$this->insert_option('ct_account_name','');
		$this->insert_option('ct_account_number','');
		$this->insert_option('ct_branch_code','');
		$this->insert_option('ct_ifsc_code','');
		$this->insert_option('ct_bank_description','');
		$this->insert_option('ct_bank_transfer_status','N');
		$this->insert_option('ct_phone_display_country_code','');
		$this->insert_option('ct_smtp_encryption','');
		$this->insert_option('ct_smtp_authetication','false');
		
		$alllang = $this->get_all_languages();
        while($all = mysqli_fetch_array($alllang))
        {
            $language_label_arr = $this->get_all_labelsbyid($all[2]);
            $label_language_arr_first = $language_label_arr[1];
            $label_explode = explode("###",$label_language_arr_first);

            $label_decode_front = base64_decode($label_explode[0]);
            $label_decode_admin = base64_decode($label_explode[1]);
            $label_decode_error = base64_decode($label_explode[2]);
            $label_decode_extra = base64_decode($label_explode[3]);

            $label_decode_front_unserial = unserialize($label_decode_front);
            $label_decode_admin_unserial = unserialize($label_decode_admin);
            $label_decode_error_unserial = unserialize($label_decode_error);
            $label_decode_extra_unserial = unserialize($label_decode_extra);
			
			/* UPDATE ALL CODE WITH NEW URLENCODE PATTERN */
			foreach($label_decode_front_unserial as $key => $value){
				$label_decode_front_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_admin_unserial as $key => $value){
				$label_decode_admin_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_error_unserial as $key => $value){
				$label_decode_error_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_extra_unserial as $key => $value){
				$label_decode_extra_unserial[$key] = urldecode($value);
			}
			
            /* Add all labels which you want to add in new version from here */
            /* DEMO FOR ADDING LABEL */
			
			$label_decode_front_unserial['payumoney']=urlencode("PayUmoney");
			$label_decode_error_unserial['please_enter_minimum_20_characters']=urlencode("Please Enter Minimum 20 Characters");
			
			$label_decode_admin_unserial['merchant_key'] = urlencode("Merchant Key");
			$label_decode_admin_unserial['salt_key'] = urlencode("Salt Key");
			
			$label_decode_error_unserial["please_enter_account_username"]=urlencode("Please enter account username");
			$label_decode_error_unserial["please_enter_account_hash_id"]=urlencode("Please enter account hash id");
			
			$label_decode_admin_unserial["authetication"]=urlencode("Authentication");
			$label_decode_admin_unserial["encryption_type"]=urlencode("Encryption Type");
			$label_decode_admin_unserial["plain"]=urlencode("Plain");
			$label_decode_admin_unserial["true"]=urlencode("True");
			$label_decode_admin_unserial["false"]=urlencode("False");
			
			
			
			$label_decode_admin_unserial["textlocal_sms_gateway"]=urlencode("Textlocal SMS Gateway");
			$label_decode_admin_unserial["textlocal_sms_settings"]=urlencode("Textlocal SMS Settings");
			$label_decode_admin_unserial["textlocal_account_settings"]=urlencode("Textlocal Account Settings");
			$label_decode_admin_unserial["account_username"]=urlencode("Account Username");
			
			$label_decode_admin_unserial["account_hash_id"]=urlencode("Account Hash ID");
			
			$label_decode_admin_unserial["bank_transfer"]=urlencode("Bank Transfer");
			$label_decode_admin_unserial["bank_name"]=urlencode("Bank Name");
			$label_decode_admin_unserial["account_name"]=urlencode("Account Name");
			$label_decode_admin_unserial["account_number"]=urlencode("Account Number");
			$label_decode_admin_unserial["branch_code"]=urlencode("Branch Code");
			$label_decode_admin_unserial["ifsc_code"]=urlencode("IFSC Code");
			$label_decode_admin_unserial["bank_description"]=urlencode("Bank Description");
			$label_decode_admin_unserial["your_cart_items"]=urlencode("Your Cart Items");
			$label_decode_admin_unserial["show_how_will_we_get_in"]=urlencode("Show How will we get in");
			$label_decode_admin_unserial["bank_details"]=urlencode("Bank Details");
			$label_decode_admin_unserial["show_description"]=urlencode("Show Description");
			$label_decode_admin_unserial["remove_sample_data_message"]=urlencode("You are trying to remove sample data. If you remove sample data your booking related with sample services will be permanently deleted. To proceed please click on 'OK'");
			$label_decode_admin_unserial["ok_remove_sample_data"]=urlencode("Ok");
			$label_decode_admin_unserial["email_id_registered_with_you_textlocal"]=urlencode("Provide your email registered with textlocal");
			$label_decode_admin_unserial["hash_id_provided_by_textlocal"]=urlencode("Hash id provided by textlocal");
			
			
			$label_decode_admin_unserial["jan"]=urlencode("JAN");
			$label_decode_admin_unserial["feb"]=urlencode("FEB");
			$label_decode_admin_unserial["mar"]=urlencode("MAR");
			$label_decode_admin_unserial["apr"]=urlencode("APR");
			$label_decode_admin_unserial["may"]=urlencode("MAY");
			$label_decode_admin_unserial["jun"]=urlencode("JUN");
			$label_decode_admin_unserial["jul"]=urlencode("JUL");
			$label_decode_admin_unserial["aug"]=urlencode("AUG");
			$label_decode_admin_unserial["sep"]=urlencode("SEP");	
			$label_decode_admin_unserial["oct"]=urlencode("OCT");
			$label_decode_admin_unserial["nov"]=urlencode("NOV");
			$label_decode_admin_unserial["dec"]=urlencode("DEC");
			$label_decode_admin_unserial["book_appointment"]=urlencode("Book Appointment");
			
			$label_decode_error_unserial["please_enter_merchant_key"]=urlencode("Please enter Merchant Key");	
$label_decode_error_unserial["minimum_file_upload_size_1_kb"]=urlencode("Minimum file upload size 1 KB");			
			$label_decode_error_unserial["please_enter_salt_key"]=urlencode("Please enter Salt Key");		
			
			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
            $language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
            $language_error_arr = base64_encode(serialize($label_decode_error_unserial));
            $language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));

            $languagearr = $language_front_arr."###".$language_admin_arr."###".$language_error_arr."###".$language_extra_arr;

            $update_default_lang = "UPDATE `ct_languages` SET `label_data` = '".$languagearr."' WHERE `language` = '".$all[2]."'";
            mysqli_query($this->conn, $update_default_lang);
		}
	}
	
	public function update2_0()
	{
		$position_methods = "ALTER TABLE  `ct_services_method` ADD  `position` INT NOT NULL";
		$position_units = "ALTER TABLE  `ct_service_methods_units` ADD  `position` INT NOT NULL";
		$add_staff1 = "ALTER TABLE  `ct_admin_info` ADD  `schedule_type` ENUM(  'M',  'W' ) NOT NULL";
		$add_staff2 = "ALTER TABLE  `ct_admin_info` ADD  `role` VARCHAR( 20 ) NOT NULL ,
ADD  `description` VARCHAR( 320 ) NOT NULL ,
ADD  `enable_booking` ENUM(  'Y',  'N' ) NOT NULL ,
ADD  `service_commission` ENUM(  'F',  'P' ) NOT NULL ,
ADD  `commision_value` DOUBLE NOT NULL";
		$query = "ALTER TABLE  `ct_bookings` ADD  `staff_ids` VARCHAR( 160 ) NOT NULL";
		
		
		$query_admin_role = "Update `ct_admin_info` set `role`='admin' where `id`=1";
		mysqli_query($this->conn,$query_admin_role);
		
		/* newly added in 2.0 */
		$query_staff_payment = "CREATE TABLE `ct_staff_commission` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `order_id` int(11) NOT NULL,
		  `staff_id` int(11) NOT NULL,
		  `amt_payable` double NOT NULL,
		  `advance_paid` double NOT NULL,
		  `net_total` double NOT NULL,
		  `payment_method` varchar(50) NOT NULL,
		  `transaction_id` varchar(100) NOT NULL,
		  `payment_date` date NOT NULL,
		  PRIMARY KEY (`id`)
		)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
		mysqli_query($this->conn,$query_staff_payment);
		/* newly added in 2.0 */
		
		$ct_front_desc_change = "update `ct_settings` set `option_value`='<div class=\"features\">\n	<img class=\"feature-img\" src=\"<?php echo BASE_URL ?>/assets/images/icon21.png\" alt=\"\">\n	<h4 class=\"feature-tittle\">Safety</h4>\n	<p class=\"feature-text\">Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\n</div>\n<div class=\"features\">\n	<img class=\"feature-img\" src=\"<?php echo BASE_URL ?>/assets/images/icon31.png\" alt=\"\">\n	<h4 class=\"feature-tittle\">Best in Quality</h4>\n	<p class=\"feature-text\">Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\n</div>\n<div class=\"features\">\n	<img class=\"feature-img\" src=\"<?php echo BASE_URL ?>/assets/images/icon51.png\" alt=\"\">\n	<h4 class=\"feature-tittle\">Communication</h4>\n	<p class=\"feature-text\">Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\n</div>\n<div class=\"features\">\n	<img class=\"feature-img\" src=\"<?php echo BASE_URL ?>/assets/images/icon17.png\" alt=\"\">\n	<h4 class=\"feature-tittle\">Saves You Time</h4>\n	<p class=\"feature-text\">Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\n</div>\n<div class=\"features\">\n	<img class=\"feature-img\" src=\"<?php echo BASE_URL ?>/assets/images/icon61.png\" alt=\"\">\n	<h4 class=\"feature-tittle\">Card Payment</h4>\n	<p class=\"feature-text\"> Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\n</div>' where `option_name`='ct_front_desc'";
		mysqli_query($this->conn, $ct_front_desc_change);
		mysqli_query($this->conn, $query);
		mysqli_query($this->conn, $add_staff1);
		mysqli_query($this->conn, $add_staff2);
		mysqli_query($this->conn, $position_methods);
		mysqli_query($this->conn, $position_units);
		
		$qq1 = "ALTER TABLE `ct_users` CHANGE `user_pwd` `user_pwd` VARCHAR(40) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';";
		$qq2 = "ALTER TABLE `ct_users` CHANGE `user_email` `user_email` VARCHAR(96) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';";
		$qq3 = "ALTER TABLE `ct_users` CHANGE `first_name` `first_name` VARCHAR(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';";
		$qq4 = "ALTER TABLE `ct_users` CHANGE `last_name` `last_name` VARCHAR(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';";
		$qq5 = "ALTER TABLE `ct_users` CHANGE `phone` `phone` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';";
		$qq6 = "ALTER TABLE `ct_users` CHANGE `zip` `zip` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';";
		$qq7 = "ALTER TABLE `ct_users` CHANGE `address` `address` VARCHAR(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';";
		$qq8 = "ALTER TABLE `ct_users` CHANGE `city` `city` VARCHAR(48) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';";
		$qq9 = "ALTER TABLE `ct_users` CHANGE `state` `state` VARCHAR(48) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';";
		$qq10 = "ALTER TABLE `ct_users` CHANGE `notes` `notes` VARCHAR(800) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';";
		$qq11 = "ALTER TABLE `ct_users` CHANGE `vc_status` `vc_status` ENUM('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'N';";
		$qq12 = "ALTER TABLE `ct_users` CHANGE `p_status` `p_status` ENUM('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'N';";
		$qq13 = "ALTER TABLE `ct_users` CHANGE `contact_status` `contact_status` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';";
		$qq14 = "ALTER TABLE `ct_users` CHANGE `status` `status` ENUM('E','D') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'D';";
		$qq15 = "ALTER TABLE `ct_users` CHANGE `usertype` `usertype` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';";
		
		mysqli_query($this->conn, $qq1);
		mysqli_query($this->conn, $qq2);
		mysqli_query($this->conn, $qq3);
		mysqli_query($this->conn, $qq4);
		mysqli_query($this->conn, $qq5);
		mysqli_query($this->conn, $qq6);
		mysqli_query($this->conn, $qq7);
		mysqli_query($this->conn, $qq8);
		mysqli_query($this->conn, $qq9);
		mysqli_query($this->conn, $qq10);
		mysqli_query($this->conn, $qq11);
		mysqli_query($this->conn, $qq12);
		mysqli_query($this->conn, $qq13);
		mysqli_query($this->conn, $qq14);
		mysqli_query($this->conn, $qq15);
		
		$query_email_template = "ALTER TABLE  `ct_email_templates` CHANGE  `user_type`  `user_type` ENUM(  'A',  'C',  'S' ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT  'A=Admin,C=client,S=Staff' ";
		mysqli_query($this->conn,$query_email_template);
		
		$query = "ALTER TABLE  `ct_admin_info` ADD  `image` VARCHAR( 250 ) NOT NULL";
		mysqli_query($this->conn,$query);
		
		$email_template_insert_staff = "INSERT INTO `ct_email_templates` (`id`, `email_subject`, `email_message`, `default_message`, `email_template_status`, `email_template_type`, `user_type`) VALUES
		(NULL, 'Admin Appointment Reminder', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7YWRtaW5fbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5XZSBqdXN0IHdhbnRlZCB0byByZW1pbmQgeW91IHRoYXQgeW91IGhhdmUgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gaXMgc2NoZWR1bGVkIGluIDxiPnt7YXBwX3JlbWFpbl90aW1lfX08L2I+IGhvdXJzLjwvcD4JCQkJCQkJDQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jaztwYWRkaW5nOiAxMHB4IDBweDsiPg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+V2hlbjogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2Jvb2tpbmdfZGF0ZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Gb3I6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tzZXJ2aWNlX25hbWV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+TWV0aG9kcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3ttZXRob2RuYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlVuaXRzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3VuaXRzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkFkZC1vbnMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7YWRkb25zfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlByaWNlIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3ByaWNlfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCQ0KCQkJCQkJCQkJDQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5OYW1lIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2ZpcnN0bmFtZX19IHt7bGFzdG5hbWV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+RW1haWwgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Y2xpZW50X2VtYWlsfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlBob25lIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3Bob25lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlBheW1lbnQgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cGF5bWVudF9tZXRob2R9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+VmFjY3VtIENsZWFuZXIgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7dmFjY3VtX2NsZWFuZXJfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlBhcmtpbmcgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cGFya2luZ19zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+QWRkcmVzcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3thZGRyZXNzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk5vdGVzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e25vdGVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkNvbnRhY3QgU3RhdHVzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2NvbnRhY3Rfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9InBhZGRpbmc6IDE1cHggMHB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2JvcmRlci1ib3R0b206IDFweCBzb2xpZCAjZTZlNmU2OyI+DQoJCQkJCQkJCQk8cCBzdHlsZT0iY29sb3I6ICM2MDYwNjA7Zm9udC1zaXplOiAxNXB4O2xpbmUtaGVpZ2h0OiAyMnB4O21hcmdpbjogMTBweCAwcHggMTVweDtmbG9hdDogbGVmdDsiPjwvcD4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9InBhZGRpbmc6IDEwcHggMHB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3RleHQtYWxpZ246IGNlbnRlcjsiPg0KCQkJCQkJCQkJPGg1IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDEzcHg7bWFyZ2luOiAwcHggMHB4IDVweDsiPlRoYW5rIHlvdTwvaDU+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4JCQkJCQ0KCQkJCQk8L3RyPgkJCQkNCgkJCQk8L3Rib2R5Pg0KCQkJPC90YWJsZT4JDQoJCTwvZGl2Pg0KCTwvZGl2PgkNCjwvYm9keT4NCjwvaHRtbD4=', 'E', 'RM', 'S'),
		(NULL, 'Appointment Rescheduled By Customer', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7YWRtaW5fbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5UaGUgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gd2l0aCBmb2xsb3dpbmcgZGV0YWlsczo8L3A+CQkJCQkJCQ0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0iZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7cGFkZGluZzogMTBweCAwcHg7Ij4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPldoZW46IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tib29raW5nX2RhdGV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Rm9yOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7c2VydmljZV9uYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk1ldGhvZHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bWV0aG9kbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Vbml0cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t1bml0c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGQtb25zIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZG9uc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QcmljZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twcmljZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQkNCgkJCQkJCQkJCQ0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+TmFtZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tmaXJzdG5hbWV9fSB7e2xhc3RuYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkVtYWlsIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2NsaWVudF9lbWFpbH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QaG9uZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twaG9uZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXltZW50IDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3BheW1lbnRfbWV0aG9kfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlZhY2N1bSBDbGVhbmVyIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3ZhY2N1bV9jbGVhbmVyX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXJraW5nIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3Bhcmtpbmdfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkFkZHJlc3MgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7YWRkcmVzc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Ob3RlcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tub3Rlc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Db250YWN0IFN0YXR1cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjb250YWN0X3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxNXB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjsiPg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDtsaW5lLWhlaWdodDogMjJweDttYXJnaW46IDEwcHggMHB4IDE1cHg7ZmxvYXQ6IGxlZnQ7Ij5oYXMgYmVlbiByZXNjaGVkdWxlZC48L3A+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxMHB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazt0ZXh0LWFsaWduOiBjZW50ZXI7Ij4NCgkJCQkJCQkJCTxoNSBzdHlsZT0iY29sb3I6ICM2MDYwNjA7Zm9udC1zaXplOiAxM3B4O21hcmdpbjogMHB4IDBweCA1cHg7Ij5UaGFuayB5b3U8L2g1Pg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+CQkJCQkNCgkJCQkJPC90cj4JCQkJDQoJCQkJPC90Ym9keT4NCgkJCTwvdGFibGU+CQ0KCQk8L2Rpdj4NCgk8L2Rpdj4JDQo8L2JvZHk+DQo8L2h0bWw+', 'E', 'RS', 'S'),
		(NULL, 'Appointment Cancelled By Customer', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7YWRtaW5fbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5UaGUgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gd2l0aCBmb2xsb3dpbmcgZGV0YWlsczo8L3A+CQkJCQkJCQ0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0iZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7cGFkZGluZzogMTBweCAwcHg7Ij4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPldoZW46IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tib29raW5nX2RhdGV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Rm9yOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7c2VydmljZV9uYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk1ldGhvZHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bWV0aG9kbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Vbml0cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t1bml0c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGQtb25zIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZG9uc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QcmljZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twcmljZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQkNCgkJCQkJCQkJCQ0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+TmFtZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tmaXJzdG5hbWV9fSB7e2xhc3RuYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkVtYWlsIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2NsaWVudF9lbWFpbH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QaG9uZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twaG9uZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXltZW50IDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3BheW1lbnRfbWV0aG9kfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlZhY2N1bSBDbGVhbmVyIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3ZhY2N1bV9jbGVhbmVyX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXJraW5nIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3Bhcmtpbmdfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkFkZHJlc3MgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7YWRkcmVzc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Ob3RlcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tub3Rlc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Db250YWN0IFN0YXR1cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjb250YWN0X3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxNXB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjsiPg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDtsaW5lLWhlaWdodDogMjJweDttYXJnaW46IDEwcHggMHB4IDE1cHg7ZmxvYXQ6IGxlZnQ7Ij5oYXMgYmVlbiBjYW5jZWxsZWQuPC9wPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTBweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7dGV4dC1hbGlnbjogY2VudGVyOyI+DQoJCQkJCQkJCQk8aDUgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTNweDttYXJnaW46IDBweCAwcHggNXB4OyI+VGhhbmsgeW91PC9oNT4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJPC9kaXY+DQoJCQkJCQk8L3RkPgkJCQkJDQoJCQkJCTwvdHI+CQkJCQ0KCQkJCTwvdGJvZHk+DQoJCQk8L3RhYmxlPgkNCgkJPC9kaXY+DQoJPC9kaXY+CQ0KPC9ib2R5Pg0KPC9odG1sPg==', 'E', 'CC', 'S'),
		(NULL, 'Appointment Rejected', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7YWRtaW5fbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5UaGUgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gd2l0aCBmb2xsb3dpbmcgZGV0YWlsczo8L3A+CQkJCQkJCQ0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0iZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7cGFkZGluZzogMTBweCAwcHg7Ij4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPldoZW46IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tib29raW5nX2RhdGV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Rm9yOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7c2VydmljZV9uYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk1ldGhvZHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bWV0aG9kbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Vbml0cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t1bml0c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGQtb25zIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZG9uc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QcmljZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twcmljZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQkNCgkJCQkJCQkJCQ0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+TmFtZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tmaXJzdG5hbWV9fSB7e2xhc3RuYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkVtYWlsIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2NsaWVudF9lbWFpbH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QaG9uZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twaG9uZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXltZW50IDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3BheW1lbnRfbWV0aG9kfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlZhY2N1bSBDbGVhbmVyIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3ZhY2N1bV9jbGVhbmVyX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXJraW5nIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3Bhcmtpbmdfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkFkZHJlc3MgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7YWRkcmVzc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Ob3RlcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tub3Rlc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Db250YWN0IFN0YXR1cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjb250YWN0X3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxNXB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjsiPg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDtsaW5lLWhlaWdodDogMjJweDttYXJnaW46IDEwcHggMHB4IDE1cHg7ZmxvYXQ6IGxlZnQ7Ij5oYXMgYmVlbiByZWplY3RlZC48L3A+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxMHB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazt0ZXh0LWFsaWduOiBjZW50ZXI7Ij4NCgkJCQkJCQkJCTxoNSBzdHlsZT0iY29sb3I6ICM2MDYwNjA7Zm9udC1zaXplOiAxM3B4O21hcmdpbjogMHB4IDBweCA1cHg7Ij5UaGFuayB5b3U8L2g1Pg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+CQkJCQkNCgkJCQkJPC90cj4JCQkJDQoJCQkJPC90Ym9keT4NCgkJCTwvdGFibGU+CQ0KCQk8L2Rpdj4NCgk8L2Rpdj4JDQo8L2JvZHk+DQo8L2h0bWw+', 'E', 'R', 'S'),
		(NULL, 'Appointment Approved', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7YWRtaW5fbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5UaGUgYXBwb2ludG1lbnQgd2l0aCB7e2NsaWVudF9uYW1lfX0gd2l0aCBmb2xsb3dpbmcgZGV0YWlsczo8L3A+CQkJCQkJCQ0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0iZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7cGFkZGluZzogMTBweCAwcHg7Ij4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPldoZW46IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tib29raW5nX2RhdGV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Rm9yOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7c2VydmljZV9uYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk1ldGhvZHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bWV0aG9kbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Vbml0cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t1bml0c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGQtb25zIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZG9uc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QcmljZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twcmljZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQkNCgkJCQkJCQkJCQ0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+TmFtZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tmaXJzdG5hbWV9fSB7e2xhc3RuYW1lfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkVtYWlsIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2NsaWVudF9lbWFpbH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QaG9uZSA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twaG9uZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXltZW50IDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3BheW1lbnRfbWV0aG9kfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPlZhY2N1bSBDbGVhbmVyIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3ZhY2N1bV9jbGVhbmVyX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5QYXJraW5nIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3Bhcmtpbmdfc3RhdHVzfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkFkZHJlc3MgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7YWRkcmVzc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Ob3RlcyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tub3Rlc319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5Db250YWN0IFN0YXR1cyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjb250YWN0X3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJwYWRkaW5nOiAxNXB4IDBweDtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjsiPg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDtsaW5lLWhlaWdodDogMjJweDttYXJnaW46IDEwcHggMHB4IDE1cHg7ZmxvYXQ6IGxlZnQ7Ij5oYXMgYmVlbiBjb25maXJtZWQuPC9wPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTBweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7dGV4dC1hbGlnbjogY2VudGVyOyI+DQoJCQkJCQkJCQk8aDUgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTNweDttYXJnaW46IDBweCAwcHggNXB4OyI+VGhhbmsgeW91PC9oNT4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJPC9kaXY+DQoJCQkJCQk8L3RkPgkJCQkJDQoJCQkJCTwvdHI+CQkJCQ0KCQkJCTwvdGJvZHk+DQoJCQk8L3RhYmxlPgkNCgkJPC9kaXY+DQoJPC9kaXY+CQ0KPC9ib2R5Pg0KPC9odG1sPg==', 'E', 'C', 'S'),
		(NULL, 'New Appointment Assigned', '', 'PGh0bWw+DQo8aGVhZD4NCgk8bWV0YSBuYW1lPSJ2aWV3cG9ydCIgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCBpbml0aWFsLXNjYWxlPTEuMCIvPg0KCTxtZXRhIGh0dHAtZXF1aXY9IkNvbnRlbnQtVHlwZSIgY29udGVudD0idGV4dC9odG1sOyBjaGFyc2V0PVVURi04IiAvPg0KCTx0aXRsZT5TdWJqZWN0OiB7e3NlcnZpY2VfbmFtZX19IG9uIHt7Ym9va2luZ19kYXRlfX08L3RpdGxlPg0KCTxsaW5rIGhyZWY9Imh0dHBzOi8vZm9udHMuZ29vZ2xlYXBpcy5jb20vY3NzP2ZhbWlseT1Nb250c2VycmF0IiByZWw9InN0eWxlc2hlZXQiPg0KPC9oZWFkPg0KPGJvZHk+CQkNCgk8ZGl2IHN0eWxlPSJtYXJnaW46IDA7cGFkZGluZzogMDtmb250LWZhbWlseTogSGVsdmV0aWNhIE5ldWUsIEhlbHZldGljYSwgSGVsdmV0aWNhLCBBcmlhbCwgc2Fucy1zZXJpZjtmb250LXNpemU6IDEwMCU7bGluZS1oZWlnaHQ6IDEuNjtib3gtc2l6aW5nOiBib3JkZXItYm94OyI+CQ0KCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O21heC13aWR0aDogNjAwcHggIWltcG9ydGFudDttYXJnaW46IDAgYXV0byAhaW1wb3J0YW50O2NsZWFyOiBib3RoICFpbXBvcnRhbnQ7Ij4NCgkJCTx0YWJsZSBzdHlsZT0iYm9yZGVyOiAxcHggc29saWQgI2MyYzJjMjt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDttYXJnaW46IDMwcHggMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czogNXB4Oy1tb3otYm9yZGVyLXJhZGl1czogNXB4Oy1vLWJvcmRlci1yYWRpdXM6IDVweDtib3JkZXItcmFkaXVzOiA1cHg7Ij4NCgkJCQk8dGJvZHk+DQoJCQkJCTx0ciBzdHlsZT0iYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7ZGlzcGxheTogYmxvY2s7Ij4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDU5JTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7dGV4dC1hbGlnbjogbGVmdDtmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsiPg0KCQkJCQkJCQl7e2NvbXBhbnlfbmFtZX19PGJyIC8+e3tjb21wYW55X2FkZHJlc3N9fTxiciAvPnt7Y29tcGFueV9jaXR5fX0sIHt7Y29tcGFueV9zdGF0ZX19LCB7e2NvbXBhbnlfemlwfX08YnIgLz57e2NvbXBhbnlfY291bnRyeX19PGJyIC8+e3tjb21wYW55X3Bob25lfX08YnIgLz57e2NvbXBhbnlfZW1haWx9fQ0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4NCgkJCQkJCTx0ZCBzdHlsZT0id2lkdGg6IDQwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJPGRpdiBzdHlsZT0idmVydGljYWwtYWxpZ246IHRvcDtmbG9hdDogbGVmdDtwYWRkaW5nOjE1cHg7d2lkdGg6IDEwMCU7Ym94LXNpemluZzogYm9yZGVyLWJveDstd2Via2l0LWJveC1zaXppbmc6IGJvcmRlci1ib3g7Y2xlYXI6IGxlZnQ7Ij4NCgkJCQkJCQkJPGRpdiBzdHlsZT0id2lkdGg6IDEzMHB4O2hlaWdodDogMTAwJTt2ZXJ0aWNhbC1hbGlnbjogdG9wO21hcmdpbjogMHB4IGF1dG87Ij4NCgkJCQkJCQkJCTxpbWcgc3R5bGU9IndpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0O2Rpc3BsYXk6IGlubGluZS1ibG9jaztoZWlnaHQ6IDEwMCU7IiBzcmM9Int7YnVzaW5lc3NfbG9nb319IiAvPg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQk8L2Rpdj4NCgkJCQkJCTwvdGQ+DQoJCQkJCQkNCgkJCQkJCQ0KCQkJCQk8L3RyPg0KCQkJCQk8dHI+DQoJCQkJCQk8dGQ+DQoJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMjVweCAzMHB4O2JhY2tncm91bmQ6ICNmZmY7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDkwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQk8ZGl2IHN0eWxlPSJib3JkZXItYm90dG9tOiAxcHggc29saWQgI2U2ZTZlNjtmbG9hdDogbGVmdDt3aWR0aDogMTAwJTtkaXNwbGF5OiBibG9jazsiPg0KCQkJCQkJCQkJPGg2IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bWFyZ2luOiAxMHB4IDBweCAxMHB4O2ZvbnQtd2VpZ2h0OiA2MDA7Ij5EZWFyIHt7YWRtaW5fbmFtZX19LCA8L2g2Pg0KCQkJCQkJCQkJPHAgc3R5bGU9ImNvbG9yOiAjNjA2MDYwO2ZvbnQtc2l6ZTogMTVweDttYXJnaW46IDEwcHggMHB4IDE1cHg7Ij5Zb3UndmUgbmV3IGFwcG9pbnRtZW50IHdpdGgge3tjbGllbnRfbmFtZX19IHdpdGggZm9sbG93aW5nIGRldGFpbHM6PC9wPgkJCQkJCQkNCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9ImZsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3BhZGRpbmc6IDEwcHggMHB4OyI+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5XaGVuOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Ym9va2luZ19kYXRlfX08L3NwYW4+DQoJCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPkZvcjogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e3NlcnZpY2VfbmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5NZXRob2RzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e21ldGhvZG5hbWV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+VW5pdHMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7dW5pdHN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+QWRkLW9ucyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3thZGRvbnN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UHJpY2UgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cHJpY2V9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJDQoJCQkJCQkJCQkNCgkJCQkJCQkJCTxkaXYgc3R5bGU9ImRpc3BsYXk6IGlubGluZS1ibG9jazt3aWR0aDogMTAwJTtmbG9hdDogbGVmdDsiPg0KCQkJCQkJCQkJCTxsYWJlbCBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2NvbG9yOiAjOTk5OTk5O3BhZGRpbmctcmlnaHQ6IDVweDttaW4td2lkdGg6IDk1cHg7d2hpdGUtc3BhY2U6IG5vd3JhcDtmbG9hdDogbGVmdDtsaW5lLWhlaWdodDogMjVweDsiPk5hbWUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Zmlyc3RuYW1lfX0ge3tsYXN0bmFtZX19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5FbWFpbCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3tjbGllbnRfZW1haWx9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGhvbmUgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7cGhvbmV9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGF5bWVudCA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXltZW50X21ldGhvZH19PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5WYWNjdW0gQ2xlYW5lciA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3t2YWNjdW1fY2xlYW5lcl9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+UGFya2luZyA6IDwvbGFiZWw+DQoJCQkJCQkJCQkJPHNwYW4gc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtmb250LXdlaWdodDogNDAwO2NvbG9yOiAjNjA2MDYwO2xpbmUtaGVpZ2h0OiAyNXB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiA3NiU7d29yZC13cmFwOiBicmVhay13b3JkO21heC1oZWlnaHQ6IDcwcHg7b3ZlcmZsb3c6IGF1dG87Ij4ge3twYXJraW5nX3N0YXR1c319PC9zcGFuPg0KCQkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCQk8ZGl2IHN0eWxlPSJkaXNwbGF5OiBpbmxpbmUtYmxvY2s7d2lkdGg6IDEwMCU7ZmxvYXQ6IGxlZnQ7Ij4NCgkJCQkJCQkJCQk8bGFiZWwgc3R5bGU9ImZvbnQtc2l6ZTogMTVweDtjb2xvcjogIzk5OTk5OTtwYWRkaW5nLXJpZ2h0OiA1cHg7bWluLXdpZHRoOiA5NXB4O3doaXRlLXNwYWNlOiBub3dyYXA7ZmxvYXQ6IGxlZnQ7bGluZS1oZWlnaHQ6IDI1cHg7Ij5BZGRyZXNzIDogPC9sYWJlbD4NCgkJCQkJCQkJCQk8c3BhbiBzdHlsZT0iZm9udC1zaXplOiAxNXB4O2ZvbnQtd2VpZ2h0OiA0MDA7Y29sb3I6ICM2MDYwNjA7bGluZS1oZWlnaHQ6IDI1cHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDc2JTt3b3JkLXdyYXA6IGJyZWFrLXdvcmQ7bWF4LWhlaWdodDogNzBweDtvdmVyZmxvdzogYXV0bzsiPiB7e2FkZHJlc3N9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Tm90ZXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7bm90ZXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQkJPGRpdiBzdHlsZT0iZGlzcGxheTogaW5saW5lLWJsb2NrO3dpZHRoOiAxMDAlO2Zsb2F0OiBsZWZ0OyI+DQoJCQkJCQkJCQkJPGxhYmVsIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Y29sb3I6ICM5OTk5OTk7cGFkZGluZy1yaWdodDogNXB4O21pbi13aWR0aDogOTVweDt3aGl0ZS1zcGFjZTogbm93cmFwO2Zsb2F0OiBsZWZ0O2xpbmUtaGVpZ2h0OiAyNXB4OyI+Q29udGFjdCBTdGF0dXMgOiA8L2xhYmVsPg0KCQkJCQkJCQkJCTxzcGFuIHN0eWxlPSJmb250LXNpemU6IDE1cHg7Zm9udC13ZWlnaHQ6IDQwMDtjb2xvcjogIzYwNjA2MDtsaW5lLWhlaWdodDogMjVweDtmbG9hdDogbGVmdDt3aWR0aDogNzYlO3dvcmQtd3JhcDogYnJlYWstd29yZDttYXgtaGVpZ2h0OiA3MHB4O292ZXJmbG93OiBhdXRvOyI+IHt7Y29udGFjdF9zdGF0dXN9fTwvc3Bhbj4NCgkJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCQk8L2Rpdj4NCgkJCQkJCQkJPGRpdiBzdHlsZT0icGFkZGluZzogMTVweCAwcHg7ZmxvYXQ6IGxlZnQ7d2lkdGg6IDEwMCU7Ym9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlNmU2ZTY7Ij4NCgkJCQkJCQkJCTxwIHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDE1cHg7bGluZS1oZWlnaHQ6IDIycHg7bWFyZ2luOiAxMHB4IDBweCAxNXB4O2Zsb2F0OiBsZWZ0OyI+VGhpcyBhcHBvaW50bWVudCBpcyBpbiBwZW5kaW5nLjwvcD4NCgkJCQkJCQkJPC9kaXY+DQoJCQkJCQkJCTxkaXYgc3R5bGU9InBhZGRpbmc6IDEwcHggMHB4O2Zsb2F0OiBsZWZ0O3dpZHRoOiAxMDAlO2Rpc3BsYXk6IGJsb2NrO3RleHQtYWxpZ246IGNlbnRlcjsiPg0KCQkJCQkJCQkJPGg1IHN0eWxlPSJjb2xvcjogIzYwNjA2MDtmb250LXNpemU6IDEzcHg7bWFyZ2luOiAwcHggMHB4IDVweDsiPlRoYW5rIHlvdTwvaDU+DQoJCQkJCQkJCTwvZGl2Pg0KCQkJCQkJCTwvZGl2Pg0KCQkJCQkJPC90ZD4JCQkJCQ0KCQkJCQk8L3RyPgkJCQkNCgkJCQk8L3Rib2R5Pg0KCQkJPC90YWJsZT4JDQoJCTwvZGl2Pg0KCTwvZGl2PgkNCjwvYm9keT4NCjwvaHRtbD4=', 'E', 'A', 'S');";
		 mysqli_query($this->conn,$email_template_insert_staff);
		
		
		$this->insert_option('ct_bf_first_name','on,Y,3,15');
		$this->insert_option('ct_bf_last_name','on,Y,3,15');
		$this->insert_option('ct_bf_email','on,Y,5,30');
		$this->insert_option('ct_bf_password','on,Y,8,10');
		$this->insert_option('ct_bf_phone','on,Y,9,12');
		$this->insert_option('ct_bf_address','on,Y,10,40');
		$this->insert_option('ct_bf_zip_code','on,Y,3,7');
		$this->insert_option('ct_bf_city','on,Y,3,15');
		$this->insert_option('ct_bf_state','on,Y,3,15');
		$this->insert_option('ct_bf_notes','on,Y,10,70');
		$this->insert_option('ct_front_language_selection_dropdown','Y');
		$this->insert_option('ct_calculation_policy','M');
		$this->insert_option('ct_staff_email_notification_status','N');
		$this->insert_option('ct_favicon_image','fevicon.png');
		$this->insert_option('ct_frontend_fonts','Raleway');
		
		
		$alllang = $this->get_all_languages();
        while($all = mysqli_fetch_array($alllang))
        {
            $language_label_arr = $this->get_all_labelsbyid($all[2]);
            $label_language_arr_first = $language_label_arr[1];
            $label_explode = explode("###",$label_language_arr_first);

            $label_decode_front = base64_decode($label_explode[0]);
            $label_decode_admin = base64_decode($label_explode[1]);
            $label_decode_error = base64_decode($label_explode[2]);
            $label_decode_extra = base64_decode($label_explode[3]);

            $label_decode_front_unserial = unserialize($label_decode_front);
            $label_decode_admin_unserial = unserialize($label_decode_admin);
            $label_decode_error_unserial = unserialize($label_decode_error);
            $label_decode_extra_unserial = unserialize($label_decode_extra);
			
			/* UPDATE ALL CODE WITH NEW URLENCODE PATTERN */
			foreach($label_decode_front_unserial as $key => $value){
				$label_decode_front_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_admin_unserial as $key => $value){
				$label_decode_admin_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_error_unserial as $key => $value){
				$label_decode_error_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_extra_unserial as $key => $value){
				$label_decode_extra_unserial[$key] = urldecode($value);
			}
			
            /* Add all labels which you want to add in new version from here */
            /* DEMO FOR ADDING LABEL */
			$label_decode_error_unserial["please_enter_below_36_characters"] = urlencode("Please enter below 36 characters");
			
			$label_decode_front_unserial["appointment_zip"] = urlencode("Appointment Zip");
			$label_decode_front_unserial["appointment_city"] = urlencode("Appointment City");
			$label_decode_front_unserial["appointment_state"] = urlencode("Appointment State");
			$label_decode_front_unserial["appointment_address"] = urlencode("Appointment Address");
			
			
			$label_decode_admin_unserial["pay_at_venue"]=urlencode("Pay At Venue");
			$label_decode_admin_unserial["jan"]=urlencode("JAN");
			$label_decode_admin_unserial["new_appointment_assigned"]=urlencode("New Appointment Assigned");
			$label_decode_admin_unserial["client_payments"] = urlencode("Client Payments");
			$label_decode_admin_unserial["staff_payments"] = urlencode("Staff Payments");
			$label_decode_admin_unserial["staff_payments_details"] = urlencode("Staff Payments Details");
			$label_decode_admin_unserial["advance_paid"] = urlencode("Advance Paid");
			$label_decode_admin_unserial["change_calculation_policyy"] = urlencode("Change Calculation Policy");
			$label_decode_admin_unserial["frontend_fonts"] = urlencode("Frontend fonts");
			$label_decode_admin_unserial["favicon_image"] = urlencode("Favicon Image");
			$label_decode_admin_unserial["staff_email_template"] = urlencode("Staff Email Template");
			$label_decode_admin_unserial["staff_details_add_new_and_manage_staff_payments"] = urlencode("Staff Details, Add new and manage staff payments");
			$label_decode_admin_unserial["add_staff"] = urlencode("Add staff");
			$label_decode_admin_unserial["staff_bookings_and_payments"] = urlencode("Staff Bookings & Payments");
			$label_decode_admin_unserial["staff_booking_details_and_payment"] = urlencode("Staff Booking Details and Payment");
			$label_decode_admin_unserial["select_option_to_show_bookings"] = urlencode("Select option to show bookings");
			$label_decode_admin_unserial["select_service"] = urlencode("Select Service");
			$label_decode_admin_unserial["staff_name"] = urlencode("Staff Name");
			$label_decode_admin_unserial["staff_payment"] = urlencode("Staff Payment");
			$label_decode_admin_unserial["add_payment_to_staff_account"] = urlencode("Add Payment to staff account");
			$label_decode_admin_unserial["amount_payable"] = urlencode("Amount Payable");
			$label_decode_admin_unserial["advance_paid"] = urlencode("Advance Paid");
			$label_decode_admin_unserial["save_changes"] = urlencode("Save changes");
			$label_decode_admin_unserial["front_error_labels"] = urlencode("Front Error Labels");			
			$label_decode_admin_unserial["service_commission"]=urlencode("Service Commission");
			$label_decode_admin_unserial["commission_total"]=urlencode("Commission Total");			
			$label_decode_admin_unserial["front_tool_tips"]=urlencode("FRONT TOOL TIPS");
			$label_decode_admin_unserial["staff_email_notification"]=urlencode("Staff Email Notification");
			$label_decode_admin_unserial["change_calculation_policy"]=urlencode("Change Calculation"); 
			$label_decode_admin_unserial["multiply"]=urlencode("Multiply");
			$label_decode_admin_unserial["equal"]=urlencode("Equal");
			$label_decode_admin_unserial["warning"]=urlencode("Warning!");
			$label_decode_admin_unserial["field_name"]=urlencode("Field Name");
			$label_decode_admin_unserial["enable_disable"]=urlencode("Enable/Disable");
			$label_decode_admin_unserial["required"]=urlencode("Required");
			$label_decode_admin_unserial["min_length"]=urlencode("Min Length");
			$label_decode_admin_unserial["max_length"]=urlencode("Max Length");
			$label_decode_admin_unserial["front_language_dropdown"]=urlencode("Front Language Dropdown");
			$label_decode_admin_unserial["enabled"]=urlencode("Enabled");
			$label_decode_admin_unserial["vaccume_cleaner"]=urlencode("Vaccume Cleaner");
			$label_decode_admin_unserial["parking"]=urlencode("Parking");
			$label_decode_admin_unserial["staff_members"]=urlencode("Staff Members");
			$label_decode_admin_unserial["add_new_staff_member"]=urlencode("Add new staff member");
			$label_decode_admin_unserial["role"]=urlencode("Role");
			$label_decode_admin_unserial["staff"]=urlencode("Staff");
			$label_decode_admin_unserial["admin"]=urlencode("Admin");
			$label_decode_admin_unserial["create"]=urlencode("Create");
			$label_decode_admin_unserial["service_details"]=urlencode("Service Details");
			$label_decode_admin_unserial["technical_admin"]=urlencode("Technical Admin");
			$label_decode_admin_unserial["enable_booking"]=urlencode("Enable Booking");
			$label_decode_admin_unserial["service_commission"]=urlencode("Service Commission");
			$label_decode_admin_unserial["percentage"]=urlencode("Percentage");
			$label_decode_admin_unserial["flat_commission"]=urlencode("Flat Commission");
			$label_decode_admin_unserial["save"]=urlencode("Save");
			$label_decode_admin_unserial["staff_details"]=urlencode("STAFF DETAILS");
			$label_decode_admin_unserial["assign_appointment_to_staff"]=urlencode("Assign Appointment to Staff");
			$label_decode_admin_unserial["delete_member"]=urlencode("Delete Member?");
			$label_decode_admin_unserial["manageable_form_fields_front_booking_form"]=urlencode("Manageable Form Fields For Front Booking Form");
			$label_decode_admin_unserial["manageable_form_fields"]=urlencode("Manageable Form Fields");
			
			$label_decode_error_unserial["invalid_values"]=urlencode("Invalid values");
			
			$front_form_error_labels = array(
		"min_ff_ps"=>urlencode("Please enter minimum 8 characters"),
		"max_ff_ps"=>urlencode("Please enter maximum 10 characters"),
		"req_ff_fn"=>urlencode("Please enter first name"),
		"min_ff_fn"=>urlencode("Please enter minimum 3 characters"),
		"max_ff_fn"=>urlencode("Please enter maximum 15 characters"),
		"req_ff_ln"=>urlencode("Please enter last name"),
		"min_ff_ln"=>urlencode("Please enter minimum 3 characters"),
		"max_ff_ln"=>urlencode("Please enter maximum 15 characters"),
		"req_ff_ph"=>urlencode("Please enter phone number"),
		"min_ff_ph"=>urlencode("Please enter minimum 9 characters"),
		"max_ff_ph"=>urlencode("Please enter maximum 12 characters"),
		"req_ff_sa"=>urlencode("Please enter street address"),
		"min_ff_sa"=>urlencode("Please enter minimum 10 characters"),
		"max_ff_sa"=>urlencode("Please enter maximum 40 characters"),
		"req_ff_zp"=>urlencode("Please enter zip code"),
		"min_ff_zp"=>urlencode("Please enter minimum 3 characters"),
		"max_ff_zp"=>urlencode("Please enter maximum 7 characters"),
		"req_ff_ct"=>urlencode("Please enter city"),
		"min_ff_ct"=>urlencode("Please enter minimum 3 characters"),
		"max_ff_ct"=>urlencode("Please enter maximum 15 characters"),
		"req_ff_st"=>urlencode("Please enter state"),
		"min_ff_st"=>urlencode("Please enter minimum 3 characters"),
		"max_ff_st"=>urlencode("Please enter maximum 15 characters"),
		"req_ff_srn"=>urlencode("Please enter notes"),
		"min_ff_srn"=>urlencode("Please enter minimum 10 characters"),
		"max_ff_srn"=>urlencode("Please enter maximum 70 characters"));
			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
            $language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
            $language_error_arr = base64_encode(serialize($label_decode_error_unserial));
            $language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
            $language_form_error_arr = base64_encode(serialize($front_form_error_labels));
			
            $languagearr = $language_front_arr."###".$language_admin_arr."###".$language_error_arr."###".$language_extra_arr."###".$language_form_error_arr;

            $update_default_lang = "UPDATE `ct_languages` SET `label_data` = '".$languagearr."' WHERE `language` = '".$all[2]."'";
            mysqli_query($this->conn, $update_default_lang);
		}
	}
    public function array_push_assoc($array, $key, $value){
        $array[$key] = $value;
        return $array;
    }
    public function get_all_languages()
    {
        $query = "select * from `ct_languages`";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }
    public function get_all_labelsbyid($lang)
    {
        $query = "select * from `ct_languages` where `language`='" . $lang . "'";
        $result = mysqli_query($this->conn, $query);
        $ress = @mysqli_fetch_row($result);
        return $ress;
    }
	public function update2_2()
	{
		$this->insert_option('ct_appointment_details_display','on');
		$alllang = $this->get_all_languages();
        while($all = mysqli_fetch_array($alllang))
        {
            $language_label_arr = $this->get_all_labelsbyid($all[2]);
            $label_language_arr_first = $language_label_arr[1];
            $label_explode = explode("###",$label_language_arr_first);

            $label_decode_front = base64_decode($label_explode[0]);
            $label_decode_admin = base64_decode($label_explode[1]);
            $label_decode_error = base64_decode($label_explode[2]);
            $label_decode_extra = base64_decode($label_explode[3]);
            $label_decode_front_form_error = base64_decode($label_explode[4]);

            $label_decode_front_unserial = unserialize($label_decode_front);
            $label_decode_admin_unserial = unserialize($label_decode_admin);
            $label_decode_error_unserial = unserialize($label_decode_error);
            $label_decode_extra_unserial = unserialize($label_decode_extra);
            $label_decode_front_form_error_unserial = unserialize($label_decode_front_form_error);
			
			/* UPDATE ALL CODE WITH NEW URLENCODE PATTERN */
			foreach($label_decode_front_unserial as $key => $value){
				$label_decode_front_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_admin_unserial as $key => $value){
				$label_decode_admin_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_error_unserial as $key => $value){
				$label_decode_error_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_extra_unserial as $key => $value){
				$label_decode_extra_unserial[$key] = urldecode($value);
			}
			
			foreach($label_decode_front_form_error_unserial as $key => $value){
				$label_decode_front_form_error_unserial[$key] = urldecode($value);
			}
			
			
            /* Add all labels which you want to add in new version from here */
            /* DEMO FOR ADDING LABEL */
			/*$label_decode_admin_unserial["pay_at_venue"]=urlencode("Pay At Venue");*/
			$label_decode_admin_unserial["appointment_details_section"]=urlencode("Appointment Details Section");
$label_decode_admin_unserial["if_you_are_having_booking_system_which_need_the_booking_address_then_please_make_this_field_enable_or_else_it_will_not_able_to_take_the_booking_address_and_display_blank_address_in_the_booking"]=urlencode("If you are having booking system which need the booking address then please make this field enable or else it will not able to take the booking address and display blank address in the booking");
		$label_decode_front_unserial["please_check_for_the_below_missing_information"]=urlencode("Please check for the below missing information.");
		
		$label_decode_front_unserial["same_as_above"]=urlencode("Same As Above");
		$label_decode_admin_unserial["manageable_form_fields_front_booking_form"]=urlencode("Manageable Form Fields For Front Booking Form");
		
		$label_decode_front_unserial["please_provide_company_details_from_the_admin_panel"]=urlencode("Please provide company details from the admin panel.");
		$label_decode_front_unserial["please_add_some_services_methods_units_addons_from_the_admin_panel"]=urlencode("Please add some services, methods, units, addons from the admin panel.");
		$label_decode_front_unserial["please_add_time_scheduling_from_the_admin_panel"]=urlencode("Please add time scheduling from the admin panel.");
		$label_decode_front_unserial["please_complete_configurations_before_you_created_website_embed_code"]=urlencode("Please complete configurations before you created website embed code.");
		
			
			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
            $language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
            $language_error_arr = base64_encode(serialize($label_decode_error_unserial));
            $language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
            $language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
			
            $languagearr = $language_front_arr."###".$language_admin_arr."###".$language_error_arr."###".$language_extra_arr."###".$language_form_error_arr;

            $update_default_lang = "UPDATE `ct_languages` SET `label_data` = '".$languagearr."' WHERE `language` = '".$all[2]."'";
            mysqli_query($this->conn, $update_default_lang);
		}
	}
	
	public function update2_3(){
		$query1 = "ALTER TABLE `ct_payments` CHANGE `lastmodify` `lastmodify` TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;";
		mysqli_query($this->conn,$query1);
		$query2 = "ALTER TABLE `ct_off_days` CHANGE `user_id` `user_id` INT(11) NULL;";
		mysqli_query($this->conn,$query2);
		$query3 = "ALTER TABLE `ct_off_days` CHANGE `status` `status` INT(1) NULL;";
		mysqli_query($this->conn,$query3);
		$query4 = "ALTER TABLE `ct_bookings` CHANGE `staff_ids` `staff_ids` VARCHAR(160) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;";
		mysqli_query($this->conn,$query4);
		$query5 = "ALTER TABLE `ct_payments` CHANGE `lastmodify` `lastmodify` TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;";
		mysqli_query($this->conn,$query5);
		$query6 = "ALTER TABLE `ct_users` CHANGE `vc_status` `vc_status` ENUM('Y','N','-') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'N';";
		mysqli_query($this->conn,$query6);
		$query7 = "ALTER TABLE `ct_users` CHANGE `p_status` `p_status` ENUM('Y','N','-') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'N';";
		mysqli_query($this->conn,$query7);
	}

	public function update2_4()
	{
		$this->insert_option('ct_recurrence_booking_status','N');
		$this->insert_option('ct_loader','default');
		$alllang = $this->get_all_languages();

		$add_paymentsss = "ALTER TABLE  `ct_payments` ADD  `recurrence_status` ENUM(  'Y',  'N' ) NOT NULL ,
		ADD  `payment_status` VARCHAR( 255 ) NOT NULL";
		mysqli_query($this->conn, $add_paymentsss);

        $q1s = "ALTER TABLE `ct_admin_info` ADD  `service_ids` VARCHAR( 255 ) NOT NULL";
		mysqli_query($this->conn, $q1s);

        $q2s = "ALTER TABLE `ct_week_days_available` ADD  `provider_schedule_type` VARCHAR( 30 ) DEFAULT ''";
		mysqli_query($this->conn, $q2s);

        while($all = mysqli_fetch_array($alllang))
        {
            $language_label_arr = $this->get_all_labelsbyid($all[2]);
            $label_language_arr_first = $language_label_arr[1];
            $label_explode = explode("###",$label_language_arr_first);

            $label_decode_front = base64_decode($label_explode[0]);
            $label_decode_admin = base64_decode($label_explode[1]);
            $label_decode_error = base64_decode($label_explode[2]);
            $label_decode_extra = base64_decode($label_explode[3]);
            $label_decode_front_form_error = base64_decode($label_explode[4]);

            $label_decode_front_unserial = unserialize($label_decode_front);
            $label_decode_admin_unserial = unserialize($label_decode_admin);
            $label_decode_error_unserial = unserialize($label_decode_error);
            $label_decode_extra_unserial = unserialize($label_decode_extra);
            $label_decode_front_form_error_unserial = unserialize($label_decode_front_form_error);
			
			/* UPDATE ALL CODE WITH NEW URLENCODE PATTERN */
			foreach($label_decode_front_unserial as $key => $value){
				$label_decode_front_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_admin_unserial as $key => $value){
				$label_decode_admin_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_error_unserial as $key => $value){
				$label_decode_error_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_extra_unserial as $key => $value){
				$label_decode_extra_unserial[$key] = urldecode($value);
			}
			
			foreach($label_decode_front_form_error_unserial as $key => $value){
				$label_decode_front_form_error_unserial[$key] = urldecode($value);
			}
			
			
            /* Add all labels which you want to add in new version from here */
            /* DEMO FOR ADDING LABEL */
			/*$label_decode_admin_unserial["pay_at_venue"]=urlencode("Pay At Venue");*/
			$label_decode_admin_unserial["Recurrence_booking"]=urlencode("Recurrence Booking");
			$label_decode_admin_unserial["Reset_Color"]=urlencode("Reset Color");
			$label_decode_admin_unserial["Loader"]=urlencode("Loader");
			$label_decode_admin_unserial["CSS_Loader"]=urlencode("CSS Loader");
			$label_decode_admin_unserial["GIF_Loader"]=urlencode("GIF Loader");
			$label_decode_admin_unserial["Default_Loader"]=urlencode("Default Loader");
			$label_decode_admin_unserial["Bi_Monthly"]=urlencode("Bi-Monthly");
			$label_decode_admin_unserial["Recurrence_Type"]=urlencode("Recurrence Type");
			$label_decode_admin_unserial["Send_Invoice"]=urlencode("Send Invoice");
			$label_decode_admin_unserial["Recurrence"]=urlencode("Recurrence");
			$label_decode_admin_unserial["Fortnightly"]=urlencode("Fortnightly");
			$label_decode_front_unserial["please_select_provider"]=urlencode("Please select provider");
			$label_decode_front_unserial["Daily"]=urlencode("Daily");
			
			
			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
            $language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
            $language_error_arr = base64_encode(serialize($label_decode_error_unserial));
            $language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
            $language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
			
            $languagearr = $language_front_arr."###".$language_admin_arr."###".$language_error_arr."###".$language_extra_arr."###".$language_form_error_arr;

            $update_default_lang = "UPDATE `ct_languages` SET `label_data` = '".$languagearr."' WHERE `language` = '".$all[2]."'";
            mysqli_query($this->conn, $update_default_lang);
		}
	}
	public function update2_5()
	{
		$this->insert_option('ct_page_title','Cleanto Booking');
		
		$q1s = "ALTER TABLE `ct_languages` ADD `admin_labels` LONGTEXT NOT NULL AFTER `language`, ADD `error_labels` LONGTEXT NOT NULL AFTER `admin_labels`, ADD `extra_labels` LONGTEXT NOT NULL AFTER `error_labels`, ADD `front_error_labels` LONGTEXT NOT NULL AFTER `extra_labels`";
		mysqli_query($this->conn, $q1s);
		
		$alllang = $this->get_all_languages();

        while($all = mysqli_fetch_array($alllang))
        {
            $language_label_arr = $this->get_all_labelsbyid($all[2]);
			
			if($language_label_arr[3] == '' && $language_label_arr[4] == '' && $language_label_arr[5] == '' && $language_label_arr[6] == ''){
				$label_language_arr_first = $language_label_arr[1];
				$label_explode = explode("###",$label_language_arr_first);

				$label_decode_front = base64_decode($label_explode[0]);
				$label_decode_admin = base64_decode($label_explode[1]);
				$label_decode_error = base64_decode($label_explode[2]);
				$label_decode_extra = base64_decode($label_explode[3]);
				$label_decode_front_form_error = base64_decode($label_explode[4]);

				$label_decode_front_unserial = unserialize($label_decode_front);
				$label_decode_admin_unserial = unserialize($label_decode_admin);
				$label_decode_error_unserial = unserialize($label_decode_error);
				$label_decode_extra_unserial = unserialize($label_decode_extra);
				$label_decode_front_form_error_unserial = unserialize($label_decode_front_form_error);
				
				/* UPDATE ALL CODE WITH NEW URLENCODE PATTERN */
				foreach($label_decode_front_unserial as $key => $value){
					$label_decode_front_unserial[$key] = urldecode($value);
				}
				foreach($label_decode_admin_unserial as $key => $value){
					$label_decode_admin_unserial[$key] = urldecode($value);
				}
				foreach($label_decode_error_unserial as $key => $value){
					$label_decode_error_unserial[$key] = urldecode($value);
				}
				foreach($label_decode_extra_unserial as $key => $value){
					$label_decode_extra_unserial[$key] = urldecode($value);
				}
				
				foreach($label_decode_front_form_error_unserial as $key => $value){
					$label_decode_front_form_error_unserial[$key] = urldecode($value);
				}
				
				
				/* Add all labels which you want to add in new version from here */
				/* DEMO FOR ADDING LABEL */
				/*$label_decode_admin_unserial["pay_at_venue"]=urlencode("Pay At Venue");*/
				$label_decode_admin_unserial["page_title"]=urlencode("Page Title");
				
				$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
				$language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
				$language_error_arr = base64_encode(serialize($label_decode_error_unserial));
				$language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
				$language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
				
				$update_default_lang = "UPDATE `ct_languages` set `label_data` = '".$language_front_arr."', `admin_labels` = '".$language_admin_arr."', `error_labels` = '".$language_error_arr."', `extra_labels` = '".$language_extra_arr."', `front_error_labels` = '".$language_form_error_arr."' where `language` = '".$all[2]."'";
				mysqli_query($this->conn, $update_default_lang);
			}else{

				$label_decode_front = base64_decode($language_label_arr[1]);
				$label_decode_admin = base64_decode($language_label_arr[3]);
				$label_decode_error = base64_decode($language_label_arr[4]);
				$label_decode_extra = base64_decode($language_label_arr[5]);
				$label_decode_front_form_error = base64_decode($language_label_arr[6]);
				
				$label_decode_front_unserial = unserialize($label_decode_front);
				$label_decode_admin_unserial = unserialize($label_decode_admin);
				$label_decode_error_unserial = unserialize($label_decode_error);
				$label_decode_extra_unserial = unserialize($label_decode_extra);
				$label_decode_front_form_error_unserial = unserialize($label_decode_front_form_error);
				
				/* UPDATE ALL CODE WITH NEW URLENCODE PATTERN */
				foreach($label_decode_front_unserial as $key => $value){
					$label_decode_front_unserial[$key] = urldecode($value);
				}
				foreach($label_decode_admin_unserial as $key => $value){
					$label_decode_admin_unserial[$key] = urldecode($value);
				}
				foreach($label_decode_error_unserial as $key => $value){
					$label_decode_error_unserial[$key] = urldecode($value);
				}
				foreach($label_decode_extra_unserial as $key => $value){
					$label_decode_extra_unserial[$key] = urldecode($value);
				}
				
				foreach($label_decode_front_form_error_unserial as $key => $value){
					$label_decode_front_form_error_unserial[$key] = urldecode($value);
				}
				
				
				/* Add all labels which you want to add in new version from here */
				/* DEMO FOR ADDING LABEL */
				/*$label_decode_admin_unserial["pay_at_venue"]=urlencode("Pay At Venue");*/
				$label_decode_admin_unserial["page_title"]=urlencode("Page Title");
				
				$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
				$language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
				$language_error_arr = base64_encode(serialize($label_decode_error_unserial));
				$language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
				$language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
				
				$update_default_lang = "UPDATE `ct_languages` set `label_data` = '".$language_front_arr."', `admin_labels` = '".$language_admin_arr."', `error_labels` = '".$language_error_arr."', `extra_labels` = '".$language_extra_arr."', `front_error_labels` = '".$language_form_error_arr."' where `language` = '".$all[2]."'";
				mysqli_query($this->conn, $update_default_lang);
			}
		}
	}
	
	public function update2_6()
	{
		$alllang = $this->get_all_languages();

        while($all = mysqli_fetch_array($alllang))
        {
            $language_label_arr = $this->get_all_labelsbyid($all[2]);
			
			$label_decode_front = base64_decode($language_label_arr[1]);
			$label_decode_admin = base64_decode($language_label_arr[3]);
			$label_decode_error = base64_decode($language_label_arr[4]);
			$label_decode_extra = base64_decode($language_label_arr[5]);
			$label_decode_front_form_error = base64_decode($language_label_arr[6]);
			
			$label_decode_front_unserial = unserialize($label_decode_front);
			$label_decode_admin_unserial = unserialize($label_decode_admin);
			$label_decode_error_unserial = unserialize($label_decode_error);
			$label_decode_extra_unserial = unserialize($label_decode_extra);
			$label_decode_front_form_error_unserial = unserialize($label_decode_front_form_error);
			
			/* UPDATE ALL CODE WITH NEW URLENCODE PATTERN */
			foreach($label_decode_front_unserial as $key => $value){
				$label_decode_front_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_admin_unserial as $key => $value){
				$label_decode_admin_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_error_unserial as $key => $value){
				$label_decode_error_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_extra_unserial as $key => $value){
				$label_decode_extra_unserial[$key] = urldecode($value);
			}
			
			foreach($label_decode_front_form_error_unserial as $key => $value){
				$label_decode_front_form_error_unserial[$key] = urldecode($value);
			}
				
				
			/* Add all labels which you want to add in new version from here */
			/* DEMO FOR ADDING LABEL */
			/*$label_decode_admin_unserial["pay_at_venue"]=urlencode("Pay At Venue");*/
			$label_decode_admin_unserial["company_info_settings"]=urlencode("Company Info Settings");
			$label_decode_admin_unserial["companyname"]=urlencode("Company Name");
			$label_decode_admin_unserial["Quantity"]=urlencode("Quantity");
			
			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
			$language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
			$language_error_arr = base64_encode(serialize($label_decode_error_unserial));
			$language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
			$language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
			
			$update_default_lang = "UPDATE `ct_languages` set `label_data` = '".$language_front_arr."', `admin_labels` = '".$language_admin_arr."', `error_labels` = '".$language_error_arr."', `extra_labels` = '".$language_extra_arr."', `front_error_labels` = '".$language_form_error_arr."' where `language` = '".$all[2]."'";
			mysqli_query($this->conn, $update_default_lang);
		}
	}
	
	public function update2_7()
	{
		$this->insert_option('ct_google_analytics_code','');
		$this->insert_option('ct_seo_meta_description','');
		$this->insert_option('ct_seo_og_title','');
		$this->insert_option('ct_seo_og_type','');
		$this->insert_option('ct_seo_og_url','');
		$this->insert_option('ct_seo_og_image','');
		
		$alllang = $this->get_all_languages();

        while($all = mysqli_fetch_array($alllang))
        {
            $language_label_arr = $this->get_all_labelsbyid($all[2]);
			
			$label_decode_front = base64_decode($language_label_arr[1]);
			$label_decode_admin = base64_decode($language_label_arr[3]);
			$label_decode_error = base64_decode($language_label_arr[4]);
			$label_decode_extra = base64_decode($language_label_arr[5]);
			$label_decode_front_form_error = base64_decode($language_label_arr[6]);
			
			$label_decode_front_unserial = unserialize($label_decode_front);
			$label_decode_admin_unserial = unserialize($label_decode_admin);
			$label_decode_error_unserial = unserialize($label_decode_error);
			$label_decode_extra_unserial = unserialize($label_decode_extra);
			$label_decode_front_form_error_unserial = unserialize($label_decode_front_form_error);
			
			/* UPDATE ALL CODE WITH NEW URLENCODE PATTERN */
			foreach($label_decode_front_unserial as $key => $value){
				$label_decode_front_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_admin_unserial as $key => $value){
				$label_decode_admin_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_error_unserial as $key => $value){
				$label_decode_error_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_extra_unserial as $key => $value){
				$label_decode_extra_unserial[$key] = urldecode($value);
			}
			
			foreach($label_decode_front_form_error_unserial as $key => $value){
				$label_decode_front_form_error_unserial[$key] = urldecode($value);
			}
				
				
			/* Add all labels which you want to add in new version from here */
			/* DEMO FOR ADDING LABEL */
			/*$label_decode_admin_unserial["pay_at_venue"]=urlencode("Pay At Venue");*/
			$label_decode_error_unserial["Invalid_Image_Type"]=urlencode("Invalid_Image_Type");
			$label_decode_error_unserial["seo_settings_updated_successfully"]=urlencode("SEO settings updated successfully");

			$label_decode_admin_unserial["front_language_flags_list"]=urlencode("Front languages flag list");
			$label_decode_admin_unserial["Google_Analytics_Code"]=urlencode("Google Analytics Code");
			$label_decode_admin_unserial["Page_Meta_Tag"]=urlencode("Page/Meta Tag");
			$label_decode_admin_unserial["SEO_Settings"]=urlencode("SEO Settings");
			$label_decode_admin_unserial["Meta_Description"]=urlencode("Meta Description");
			$label_decode_admin_unserial["SEO"]=urlencode("SEO");
			$label_decode_admin_unserial["og_tag_image"]=urlencode("og Tag Image");
			$label_decode_admin_unserial["og_tag_url"]=urlencode("og Tag URL");
			$label_decode_admin_unserial["og_tag_type"]=urlencode("og Tag Type");
			$label_decode_admin_unserial["og_tag_title"]=urlencode("og Tag Title");
			
			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
			$language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
			$language_error_arr = base64_encode(serialize($label_decode_error_unserial));
			$language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
			$language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
			
			$update_default_lang = "UPDATE `ct_languages` set `label_data` = '".$language_front_arr."', `admin_labels` = '".$language_admin_arr."', `error_labels` = '".$language_error_arr."', `extra_labels` = '".$language_extra_arr."', `front_error_labels` = '".$language_form_error_arr."' where `language` = '".$all[2]."'";
			mysqli_query($this->conn, $update_default_lang);
		}
	}
	public function update2_8()
	{
		$this->insert_option('ct_company_title_display','Y');
		$this->insert_option('ct_custom_gif_loader','');
		$this->insert_option('ct_custom_css_loader','');
		
		$query_admin_role = "Update `ct_admin_info` set `role`='admin' where `id`=1";
		mysqli_query($this->conn,$query_admin_role);
		
		$alllang = $this->get_all_languages();

        while($all = mysqli_fetch_array($alllang))
        {
            $language_label_arr = $this->get_all_labelsbyid($all[2]);
			
			$label_decode_front = base64_decode($language_label_arr[1]);
			$label_decode_admin = base64_decode($language_label_arr[3]);
			$label_decode_error = base64_decode($language_label_arr[4]);
			$label_decode_extra = base64_decode($language_label_arr[5]);
			$label_decode_front_form_error = base64_decode($language_label_arr[6]);
			
			$label_decode_front_unserial = unserialize($label_decode_front);
			$label_decode_admin_unserial = unserialize($label_decode_admin);
			$label_decode_error_unserial = unserialize($label_decode_error);
			$label_decode_extra_unserial = unserialize($label_decode_extra);
			$label_decode_front_form_error_unserial = unserialize($label_decode_front_form_error);
			
			/* UPDATE ALL CODE WITH NEW URLENCODE PATTERN */
			foreach($label_decode_front_unserial as $key => $value){
				$label_decode_front_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_admin_unserial as $key => $value){
				$label_decode_admin_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_error_unserial as $key => $value){
				$label_decode_error_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_extra_unserial as $key => $value){
				$label_decode_extra_unserial[$key] = urldecode($value);
			}
			
			foreach($label_decode_front_form_error_unserial as $key => $value){
				$label_decode_front_form_error_unserial[$key] = urldecode($value);
			}
				
				
			/* Add all labels which you want to add in new version from here */
			/* DEMO FOR ADDING LABEL */
			/*$label_decode_admin_unserial["pay_at_venue"]=urlencode("Pay At Venue");*/
			
			$label_decode_admin_unserial["Show_company_title"]=urlencode("Show company title");
			
			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
			$language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
			$language_error_arr = base64_encode(serialize($label_decode_error_unserial));
			$language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
			$language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
			
			$update_default_lang = "UPDATE `ct_languages` set `label_data` = '".$language_front_arr."', `admin_labels` = '".$language_admin_arr."', `error_labels` = '".$language_error_arr."', `extra_labels` = '".$language_extra_arr."', `front_error_labels` = '".$language_form_error_arr."' where `language` = '".$all[2]."'";
			mysqli_query($this->conn, $update_default_lang);
		}
	}
	
	public function update3_0()
	{
		mysqli_query($this->conn, "UPDATE `ct_week_days_available` SET `provider_id` = '1' WHERE `provider_id` = '0';");
		
		$get_time_slots_schedule_type = mysqli_query($this->conn, "SELECT * FROM `ct_settings` WHERE `option_name` = 'ct_time_slots_schedule_type'");
		$ct_time_slots_schedule_type = mysqli_fetch_array($get_time_slots_schedule_type);
		
		if($ct_time_slots_schedule_type['option_value'] == 'monthly'){
			mysqli_query($this->conn,"UPDATE `ct_week_days_available` SET `provider_schedule_type` = 'monthly' WHERE `provider_id` = '1';");
		}else{
			mysqli_query($this->conn,"UPDATE `ct_week_days_available` SET `provider_schedule_type` = 'weekly' WHERE `provider_id` = '1';");
		}		
		
		$this->insert_option('ct_calendar_defaultView','month');
		$this->insert_option('ct_calendar_firstDay','1');
		$alllang = $this->get_all_languages();

        while($all = mysqli_fetch_array($alllang))
        {
            $language_label_arr = $this->get_all_labelsbyid($all[2]);
			
			$label_decode_front = base64_decode($language_label_arr[1]);
			$label_decode_admin = base64_decode($language_label_arr[3]);
			$label_decode_error = base64_decode($language_label_arr[4]);
			$label_decode_extra = base64_decode($language_label_arr[5]);
			$label_decode_front_form_error = base64_decode($language_label_arr[6]);
			
			$label_decode_front_unserial = unserialize($label_decode_front);
			$label_decode_admin_unserial = unserialize($label_decode_admin);
			$label_decode_error_unserial = unserialize($label_decode_error);
			$label_decode_extra_unserial = unserialize($label_decode_extra);
			$label_decode_front_form_error_unserial = unserialize($label_decode_front_form_error);
			
			/* UPDATE ALL CODE WITH NEW URLENCODE PATTERN */
			foreach($label_decode_front_unserial as $key => $value){
				$label_decode_front_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_admin_unserial as $key => $value){
				$label_decode_admin_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_error_unserial as $key => $value){
				$label_decode_error_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_extra_unserial as $key => $value){
				$label_decode_extra_unserial[$key] = urldecode($value);
			}
			
			foreach($label_decode_front_form_error_unserial as $key => $value){
				$label_decode_front_form_error_unserial[$key] = urldecode($value);
			}
				
				
			/* Add all labels which you want to add in new version from here */
			/* DEMO FOR ADDING LABEL */
			/*$label_decode_admin_unserial["pay_at_venue"]=urlencode("Pay At Venue");*/
			
			$label_decode_admin_unserial["Calendar_Fisrt_Day"]=urlencode("Calendar First Day");
			$label_decode_admin_unserial["Calendar_Default_View"]=urlencode("Calendar Default View");
			$label_decode_admin_unserial["Add_Manual_booking"]=urlencode("Add Manual Booking");
			
			$label_decode_error_unserial["you_cannot_book_on_past_date"]=urlencode("You cannot book on past date");
			
			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
			$language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
			$language_error_arr = base64_encode(serialize($label_decode_error_unserial));
			$language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
			$language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
			
			$update_default_lang = "UPDATE `ct_languages` set `label_data` = '".$language_front_arr."', `admin_labels` = '".$language_admin_arr."', `error_labels` = '".$language_error_arr."', `extra_labels` = '".$language_extra_arr."', `front_error_labels` = '".$language_form_error_arr."' where `language` = '".$all[2]."'";
			mysqli_query($this->conn, $update_default_lang);
		}
	}
	public function update3_2()
	{
		$add_options = "ALTER TABLE `ct_bookings` ADD `gc_event_id` VARCHAR(255) NOT NULL AFTER `staff_ids`, ADD `gc_staff_event_id` VARCHAR(255) NOT NULL AFTER `gc_event_id`;";
        mysqli_query($this->conn,$add_options);
		
		$this->insert_option('ct_gc_status','N');
		$this->insert_option('ct_gc_id','');
		$this->insert_option('ct_gc_client_id','');
		$this->insert_option('ct_gc_client_secret','');
		$this->insert_option('ct_gc_status_configure','');
		$this->insert_option('ct_gc_status_sync_configure','');
		$this->insert_option('ct_gc_token','');
		$this->insert_option('ct_gc_purchase_status','N');
		$this->insert_option('ct_gc_frontend_url','');
		$this->insert_option('ct_gc_admin_url','');
		$this->insert_option('ct_gc_version','');
		
		$this->insert_option('ct_payway_purchase_status','N');
		$this->insert_option('ct_payway_status','N');
		$this->insert_option('ct_payway_publishable_key','');
		$this->insert_option('ct_payway_secure_key','');
		$this->insert_option('ct_payway_version','');
		$this->insert_option('ct_payway_merchant_ID','');
		
		$this->insert_option('ct_eway_purchase_status','N');
		$this->insert_option('ct_eway_test_mode_status','N');
		$this->insert_option('ct_eway_api_username','');
		$this->insert_option('ct_eway_api_password','');
		$this->insert_option('ct_eway_status','N');
		$this->insert_option('ct_eway_version','');
		
		$serialized_arr = serialize(array('payway' => array('method' => 'indirect', 'include_path' => '/extension/payway/payway.php', 'option_name' => 'ct_payway_purchase_status'), 'eway' => array('method' => 'direct', 'include_path' => '/extension/eway/eway.php', 'option_name' => 'ct_eway_purchase_status')));
		$this->insert_option('ct_payment_extensions',$serialized_arr);
		
		$alllang = $this->get_all_languages();

        while($all = mysqli_fetch_array($alllang))
        {
            $language_label_arr = $this->get_all_labelsbyid($all[2]);
			
			$label_decode_front = base64_decode($language_label_arr[1]);
			$label_decode_admin = base64_decode($language_label_arr[3]);
			$label_decode_error = base64_decode($language_label_arr[4]);
			$label_decode_extra = base64_decode($language_label_arr[5]);
			$label_decode_front_form_error = base64_decode($language_label_arr[6]);
			
			$label_decode_front_unserial = unserialize($label_decode_front);
			$label_decode_admin_unserial = unserialize($label_decode_admin);
			$label_decode_error_unserial = unserialize($label_decode_error);
			$label_decode_extra_unserial = unserialize($label_decode_extra);
			$label_decode_front_form_error_unserial = unserialize($label_decode_front_form_error);
			
			/* UPDATE ALL CODE WITH NEW URLENCODE PATTERN */
			foreach($label_decode_front_unserial as $key => $value){
				$label_decode_front_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_admin_unserial as $key => $value){
				$label_decode_admin_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_error_unserial as $key => $value){
				$label_decode_error_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_extra_unserial as $key => $value){
				$label_decode_extra_unserial[$key] = urldecode($value);
			}
			
			foreach($label_decode_front_form_error_unserial as $key => $value){
				$label_decode_front_form_error_unserial[$key] = urldecode($value);
			}
				
				
			/* Add all labels which you want to add in new version from here */
			/* DEMO FOR ADDING LABEL */
			/*$label_decode_admin_unserial["pay_at_venue"]=urlencode("Pay At Venue");*/
			$label_decode_admin_unserial["Your_currency_should_be_AUD_to_enable_payway_payment_gateway"]=urlencode("Your currency should be Australia Dollar to enable payway payment gateway");
		    $label_decode_admin_unserial["merchant_ID"]=urlencode("Merchant ID");
		    $label_decode_admin_unserial["secure_key"]=urlencode("Secure Key");
		    $label_decode_admin_unserial["payway"]=urlencode("Payway");
		    $label_decode_admin_unserial["Its_your_Cleanto_Google_Settings_page_url"]=urlencode("Its your Cleanto Google Settings page url");
		    $label_decode_admin_unserial["its_your_Cleanto_booking_form_page_url"]=urlencode("its your Cleanto booking form page url");
		    $label_decode_admin_unserial["You_can_get_your_client_secret_from_your_Google_Calendar_Console"]= urlencode("You can get your client secret from your Google Calendar Console");
		    $label_decode_admin_unserial["You_can_get_your_client_ID_from_your_Google_Calendar_Console"]=urlencode ("You can get your client ID from your Google Calendar Console");
		    $label_decode_admin_unserial[ "Your_Google_calendar_id_where_you_need_to_get_alerts_its_normaly_your_Gmail_ID"]=urlencode("Your  Google calendar id, where you need to get alerts, its normaly your Gmail ID. e.g.johndoe@example.com" );
			$label_decode_admin_unserial["Google_Calender_Settings"]=urlencode("Google Calender Settings");
			$label_decode_admin_unserial["Add_Appointments_To_Google_Calender"]=urlencode("Add Appointments To Google Calender");
			$label_decode_admin_unserial["Google_Calender_Id"]=urlencode("Google Calender ID");
			$label_decode_admin_unserial["Google_Calender_Client_Id"]=urlencode("Google Calender Client ID");
			$label_decode_admin_unserial["Google_Calender_Client_Secret"]=urlencode("Google Calender Client Secret");
			$label_decode_admin_unserial["Google_Calender_Frontend_URL"]=urlencode("Google Calender Frontend URL");
			$label_decode_admin_unserial["Google_Calender_Admin_URL"]=urlencode("Google Calender Admin URL");
			$label_decode_admin_unserial["Google_Calender_Configuration"]=urlencode("Google Calender Configuration");
			$label_decode_admin_unserial["How_it_works"]=urlencode("How it works?");
			$label_decode_admin_unserial["Two_Way_Sync"]=urlencode("Two Way Sync");
			$label_decode_admin_unserial["Verify_Account"]=urlencode("Verify Account");
			$label_decode_admin_unserial["Select_Calendar"]=urlencode("Select Calendar");
			$label_decode_admin_unserial["Disconnect"]=urlencode("Disconnect");
			$label_decode_admin_unserial["eway"]=urlencode("Eway");
			
			$label_decode_error_unserial["please_enter_merchant_ID"]=urlencode("Please enter merchant ID");
			$label_decode_error_unserial["please_enter_secure_key"]=urlencode("Please enter secure key");
			$label_decode_error_unserial["please_enter_google_calender_admin_url"]=urlencode("Please enter google calender admin url");
			$label_decode_error_unserial["please_enter_google_calender_frontend_url"]=urlencode("Please enter google calender frontend url");
			$label_decode_error_unserial["please_enter_google_calender_client_secret"]=urlencode("Please enter google calender client secret");
			$label_decode_error_unserial["please_enter_google_calender_client_ID"]=urlencode("Please enter google calender client ID");
			$label_decode_error_unserial["please_enter_google_calender_ID"]=urlencode("Please enter google calender ID");
			
			$label_decode_front_form_error_unserial["Transaction_failed_please_try_again"]=urlencode("Transaction failed please try again");
			$label_decode_front_form_error_unserial["Please_Enter_valid_card_detail"]=urlencode("Please Enter valid card detail");
			
			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
			$language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
			$language_error_arr = base64_encode(serialize($label_decode_error_unserial));
			$language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
			$language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
			
			$update_default_lang = "UPDATE `ct_languages` set `label_data` = '".$language_front_arr."', `admin_labels` = '".$language_admin_arr."', `error_labels` = '".$language_error_arr."', `extra_labels` = '".$language_extra_arr."', `front_error_labels` = '".$language_form_error_arr."' where `language` = '".$all[2]."'";
			mysqli_query($this->conn, $update_default_lang);
		}
	}
	
	public function update3_3()
	{
		$q1s = "ALTER TABLE `ct_service_methods_units` ADD  `limit_title` VARCHAR( 255 ) NOT NULL";
		mysqli_query($this->conn, $q1s);

		
		$alllang = $this->get_all_languages();

        while($all = mysqli_fetch_array($alllang))
        {
            $language_label_arr = $this->get_all_labelsbyid($all[2]);
			
			$label_decode_front = base64_decode($language_label_arr[1]);
			$label_decode_admin = base64_decode($language_label_arr[3]);
			$label_decode_error = base64_decode($language_label_arr[4]);
			$label_decode_extra = base64_decode($language_label_arr[5]);
			$label_decode_front_form_error = base64_decode($language_label_arr[6]);
			
			$label_decode_front_unserial = unserialize($label_decode_front);
			$label_decode_admin_unserial = unserialize($label_decode_admin);
			$label_decode_error_unserial = unserialize($label_decode_error);
			$label_decode_extra_unserial = unserialize($label_decode_extra);
			$label_decode_front_form_error_unserial = unserialize($label_decode_front_form_error);
			
			/* UPDATE ALL CODE WITH NEW URLENCODE PATTERN */
			foreach($label_decode_front_unserial as $key => $value){
				$label_decode_front_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_admin_unserial as $key => $value){
				$label_decode_admin_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_error_unserial as $key => $value){
				$label_decode_error_unserial[$key] = urldecode($value);
			}
			foreach($label_decode_extra_unserial as $key => $value){
				$label_decode_extra_unserial[$key] = urldecode($value);
			}
			
			foreach($label_decode_front_form_error_unserial as $key => $value){
				$label_decode_front_form_error_unserial[$key] = urldecode($value);
			}
				
				
			/* Add all labels which you want to add in new version from here */
			/* DEMO FOR ADDING LABEL */
			/*$label_decode_admin_unserial["pay_at_venue"]=urlencode("Pay At Venue");*/
			
			$label_decode_admin_unserial["option_title"]=urlencode("Option Title");
			
			$language_front_arr = base64_encode(serialize($label_decode_front_unserial));
			$language_admin_arr = base64_encode(serialize($label_decode_admin_unserial));
			$language_error_arr = base64_encode(serialize($label_decode_error_unserial));
			$language_extra_arr = base64_encode(serialize($label_decode_extra_unserial));
			$language_form_error_arr = base64_encode(serialize($label_decode_front_form_error_unserial));
			
			$update_default_lang = "UPDATE `ct_languages` set `label_data` = '".$language_front_arr."', `admin_labels` = '".$language_admin_arr."', `error_labels` = '".$language_error_arr."', `extra_labels` = '".$language_extra_arr."', `front_error_labels` = '".$language_form_error_arr."' where `language` = '".$all[2]."'";
			mysqli_query($this->conn, $update_default_lang);
		}
	}
}
?>