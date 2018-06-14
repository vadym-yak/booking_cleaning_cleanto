<?php
	session_start();
	include(dirname(dirname(dirname(__FILE__))).'/objects/class_connection.php');
	include(dirname(dirname(dirname(__FILE__))).'/objects/class_booking.php');
	include_once(dirname(dirname(dirname(__FILE__))).'/header.php');	
	include(dirname(dirname(dirname(__FILE__))).'/objects/class_services.php');
	include(dirname(dirname(dirname(__FILE__))).'/objects/class_users.php');
	include(dirname(dirname(dirname(__FILE__))).'/objects/class_setting.php');
	include(dirname(dirname(dirname(__FILE__))).'/objects/class.phpmailer.php');
	include(dirname(dirname(dirname(__FILE__))).'/objects/class_front_first_step.php');
	include(dirname(dirname(dirname(__FILE__)))."/objects/class_adminprofile.php");
	include(dirname(dirname(dirname(__FILE__))).'/objects/class_userdetails.php');
	include(dirname(dirname(dirname(__FILE__))).'/objects/class_email_template.php');
	include(dirname(dirname(dirname(__FILE__)))."/objects/class_dashboard.php");
	include(dirname(dirname(dirname(__FILE__))).'/objects/class_general.php');

	$con = new cleanto_db();
	$conn = $con->connect();
		
	$first_step=new cleanto_first_step();
	$first_step->conn=$conn;

	$bookings=new cleanto_booking();
	$bookings->conn=$conn;

	$booking=new cleanto_booking();
	$booking->conn=$conn;

	$service=new cleanto_services();
	$service->conn=$conn;

	$setting=new cleanto_setting();
	$setting->conn=$conn;

	$user=new cleanto_users();
	$user->conn=$conn;

	$objadminprofile = new cleanto_adminprofile();
	$objadminprofile->conn = $conn;

	$objuserdetails = new cleanto_userdetails();
	$objuserdetails->conn=$conn;

	$emailtemplate=new cleanto_email_template();
	$emailtemplate->conn=$conn;

	$objdashboard = new cleanto_dashboard();
	$objdashboard->conn = $conn;

	$general=new cleanto_general();
	$general->conn=$conn;
	

if($setting->get_option('ct_smtp_authetication') == 'true'){
	$mail_SMTPAuth = '1';
	if($setting->get_option('ct_smtp_hostname') == "smtp.gmail.com"){
		$mail_SMTPAuth = 'Yes';
	}
	
}else{
	$mail_SMTPAuth = '0';
	if($setting->get_option('ct_smtp_hostname') == "smtp.gmail.com"){
		$mail_SMTPAuth = 'No';
	}
}

	$mail = new cleanto_phpmailer();
	$mail->Host = $setting->get_option('ct_smtp_hostname');
	$mail->Username = $setting->get_option('ct_smtp_username');
	$mail->Password = $setting->get_option('ct_smtp_password');
	$mail->Port = $setting->get_option('ct_smtp_port');
	$mail->SMTPSecure = $setting->get_option('ct_smtp_encryption');
	$mail->SMTPAuth = $mail_SMTPAuth;

	$mail_a = new cleanto_phpmailer();
	$mail_a->Host = $setting->get_option('ct_smtp_hostname');
	$mail_a->Username = $setting->get_option('ct_smtp_username');
	$mail_a->Password = $setting->get_option('ct_smtp_password');
	$mail_a->Port = $setting->get_option('ct_smtp_port');
	$mail_a->SMTPSecure = $setting->get_option('ct_smtp_encryption');
	$mail_a->SMTPAuth = $mail_SMTPAuth;

	$company_city = $setting->get_option('ct_company_city');
	$company_state = $setting->get_option('ct_company_state');
	$company_zip = $setting->get_option('ct_company_zip_code');
	$company_country = $setting->get_option('ct_company_country');
	$company_phone = strlen($setting->get_option('ct_company_phone')) < 6 ? "" : $setting->get_option('ct_company_phone'); 
	$company_email = $setting->get_option('ct_company_email'); 
	$company_address = $setting->get_option('ct_company_address');

	$date_format=$setting->get_option('ct_date_picker_date_format');
	$time_format = $setting->get_option('ct_time_format');

	$symbol_position=$setting->get_option('ct_currency_symbol_position');
	$decimal=$setting->get_option('ct_price_format_decimal_places');

	$admin_email = $setting->get_option('ct_admin_optional_email');

	if($setting->get_option('ct_company_logo') != null && $setting->get_option('ct_company_logo') != ""){
		$business_logo= SITE_URL.'assets/images/services/'.$setting->get_option('ct_company_logo');
		$business_logo_alt= $setting->get_option('ct_company_name');
	}else{
		$business_logo= '';
		$business_logo_alt= $setting->get_option('ct_company_name');
	}

	$book_details=$bookings->email_reminder();

	while($e_reminder = mysqli_fetch_array($book_details)){
		$bookings->booking_id=$e_reminder['id'];
		$binfo = $bookings->readone();
		$booking_start_datetime=strtotime(date('Y-m-d H:i:s',strtotime($e_reminder['booking_date_time'])));
		$email_reminder_time=$setting->get_option('ct_email_appointment_reminder_buffer');
		$t_zone_value = $setting->get_option('ct_timezone');
		$server_timezone = date_default_timezone_get();
		if(isset($t_zone_value) && $t_zone_value!=''){
			$offset= $first_step->get_timezone_offset($server_timezone,$t_zone_value);
			$timezonediff = $offset/3600;
		}else{
			$timezonediff =0;
		}
		if(is_numeric(strpos($timezonediff,'-'))){
			$timediffmis = str_replace('-','',$timezonediff)*60;
			$currDateTime_withTZ= strtotime("-".$timediffmis." minutes",strtotime(date('Y-m-d H:i:s')));
		}else{
			$timediffmis = str_replace('+','',$timezonediff)*60;
			$currDateTime_withTZ = strtotime("+".$timediffmis." minutes",strtotime(date('Y-m-d H:i:s')));
		}
		$current_times = date('Y-m-d H:i:s',$currDateTime_withTZ);
		$current_time = strtotime($current_times);
		$remain_times=$booking_start_datetime - $current_time;
		$time_in_min=round($remain_times / 60 );
		
		$orderdetail = $objdashboard->getclientorder($binfo[1]);
		$clientdetail = $objdashboard->clientemailsender($binfo[1]);
		
		$admin_company_name = $setting->get_option('ct_company_name');
		$setting_date_format = $setting->get_option('ct_date_picker_date_format');
		$setting_time_format = $setting->get_option('ct_choose_time_format');
		$booking_date = date($setting_date_format, strtotime($clientdetail['booking_date_time']));
		if($setting_time_format == 12){
			$booking_time = date("h:i A", strtotime($clientdetail['booking_date_time']));
		}
		else{
			$booking_time = date("H:i", strtotime($clientdetail['booking_date_time']));
		}
		$company_name = $setting->get_option('ct_email_sender_name');
		$company_email = $setting->get_option('ct_email_sender_address');
		$service_name = $clientdetail['title'];
		
		if($admin_email == ""){
			$admin_email = $clientdetail['email'];	
		}
		
		$get_admin_name_result = $objadminprofile->readone_adminname();
		$get_admin_name = $get_admin_name_result[3];
		if($get_admin_name == ""){
			$get_admin_name = "Admin";
		}
		$price=$general->ct_price_format($orderdetail[2],$symbol_position,$decimal);

		/* methods */
		$units = 'none';
		$methodname='none';
		$hh = $booking->get_methods_ofbookings($orderdetail[4]);
		$count_methods = mysqli_num_rows($hh);
		$hh1 = $booking->get_methods_ofbookings($orderdetail[4]);

		if($count_methods > 0){
			while($jj = mysqli_fetch_array($hh1)){
				if($units == 'none'){
					$units = $jj['units_title']."-".$jj['qtys'];
				}
				else
				{
					$units = $units.",".$jj['units_title']."-".$jj['qtys'];
				}
				$methodname = $jj['method_title'];
			}
		}

		/* Add ons */
		$addons = 'none';
		$hh = $booking->get_addons_ofbookings($orderdetail[4]);
		while($jj = mysqli_fetch_array($hh)){
			if($addons == 'none'){
				$addons = $jj['addon_service_name']."-".$jj['addons_service_qty'];
			}
			else
			{
				$addons = $addons.",".$jj['addon_service_name']."-".$jj['addons_service_qty'];
			}
		}
		
		/* Guest user */
		if($orderdetail[4]==0)
		{
			$gc  = $objdashboard->getguestclient($orderdetail[4]);
			$temppp= unserialize(base64_decode($gc[5]));
			$temp = str_replace('\\','',$temppp);
			$vc_status = $temp['vc_status'];
			if($vc_status == 'N'){
				$final_vc_status = 'no';
			}
			elseif($vc_status == 'Y'){
				$final_vc_status = 'yes';
			}else{
				$final_vc_status = "N/A";
			}
			$p_status = $temp['p_status'];
			if($p_status == 'N'){
				$final_p_status = 'no';
			}
			elseif($p_status == 'Y'){
				$final_p_status = 'yes';
			}else{
				$final_p_status = "N/A";
			}

			$client_name=$gc[2];
			$client_email=$gc[3];
			$client_phone=$gc[4];
			$firstname=$client_name;
			$lastname='';
			$booking_status=$orderdetail[6];
			$final_vc_status;
			$final_p_status;
			$payment_status=$orderdetail[5];
			$client_address=$temp['address'];
			$client_notes=$temp['notes'];
			$client_status=$temp['contact_status'];			
			$client_city = $temp['city'];		
			$client_state = $temp['state'];		
			$client_zip	= $temp['zip'];

		}
		else
			/*Registered user */
		{
			$c  = $objdashboard->getguestclient($orderdetail[4]);

			$temppp= unserialize(base64_decode($c[5]));
			$temp = str_replace('\\','',$temppp);
			$vc_status = $temp['vc_status'];
			if($vc_status == 'N'){
				$final_vc_status = 'no';
			}
			elseif($vc_status == 'Y'){
				$final_vc_status = 'yes';
			}else{
				$final_vc_status = "N/A";
			}
			$p_status = $temp['p_status'];
			if($p_status == 'N'){
				$final_p_status = 'no';
			}
			elseif($p_status == 'Y'){
				$final_p_status = 'yes';
			}else{
				$final_p_status = "N/A";
			}
			$client_name=$c[2];
			$firstname=$client_name;
			$lastname='';
			$client_email=$c[3];
			$client_phone=$c[4];
			$payment_status=$orderdetail[5];
			$final_vc_status;
			$final_p_status;
			$client_address=$temp['address'];
			$client_notes=$temp['notes'];
			$client_status=$temp['contact_status'];			$client_city = $temp['city'];		$client_state = $temp['state'];		$client_zip	= $temp['zip'];
		}
		
		if($email_reminder_time == 60){
			$cust_email_reminder_time = "1";
		}else if($email_reminder_time == 1440){
			$cust_email_reminder_time = "1";
		}else{
			$result= $email_reminder_time /60;
			$value=explode('.',$result);
			$min=$email_reminder_time%60;
			if($min < 10){
				$cust_email_reminder_time = $value[0];
			}
		}
		
		
		$searcharray = array('{{service_name}}','{{booking_date}}','{{business_logo}}','{{business_logo_alt}}','{{client_name}}','{{methodname}}','{{units}}','{{addons}}','{{client_email}}','{{phone}}','{{payment_method}}','{{vaccum_cleaner_status}}','{{parking_status}}','{{notes}}','{{contact_status}}','{{address}}','{{price}}','{{admin_name}}','{{firstname}}','{{lastname}}','{{app_remain_time}}','{{reject_status}}','{{company_name}}','{{booking_time}}','{{client_city}}','{{client_state}}','{{client_zip}}','{{company_city}}','{{company_state}}','{{company_zip}}','{{company_country}}','{{company_phone}}','{{company_email}}','{{company_address}}','{{admin_name}}');

		$replacearray = array($service_name, $booking_date , $business_logo, $business_logo_alt, $client_name,$methodname, $units, $addons,$client_email, $client_phone, $payment_status, $final_vc_status, $final_p_status, $client_notes, $client_status,$client_address,$price,$get_admin_name,$firstname,$lastname,$cust_email_reminder_time,'',$admin_company_name,$booking_time,$client_city,$client_state,$client_zip,$company_city,$company_state,$company_zip,$company_country,$company_phone,$company_email,$company_address,$get_admin_name);
		
		if($email_reminder_time >= $time_in_min && $binfo[12]!=1){
			$bookings->update_reminder_booking($e_reminder['id']);
			/* Client Email Template */
			$emailtemplate->email_subject="Client Appointment Reminder";
			$emailtemplate->user_type="C";
			$clientemailtemplate=$emailtemplate->readone_client_email_template_body();

			if($clientemailtemplate[2] != ''){
				$clienttemplate = base64_decode($clientemailtemplate[2]);
			}else{
				$clienttemplate = base64_decode($clientemailtemplate[3]);
			}
			$subject=$clientemailtemplate[1];

			if($setting->get_option('ct_client_email_notification_status') == 'Y' && $clientemailtemplate[4]=='E' ){
				$client_email_body = str_replace($searcharray,$replacearray,$clienttemplate);

				if($setting->get_option('ct_smtp_hostname') != '' && $setting->get_option('ct_email_sender_name') != '' && $setting->get_option('ct_email_sender_address') != '' && $setting->get_option('ct_smtp_username') != '' && $setting->get_option('ct_smtp_password') != '' && $setting->get_option('ct_smtp_port') != ''){
					$mail->IsSMTP();
				}else{
					$mail->IsMail();
				}
				$mail->SMTPDebug  = 0;
				$mail->IsHTML(true);
				$mail->From = $company_email;
				$mail->FromName = $company_name;
				$mail->Sender = $company_email;
				$mail->AddAddress($client_email, $client_name);
				$mail->Subject = $subject;
				$mail->Body = $client_email_body;
				$mail->send();

			}

			/* Admin Email Template */
			$emailtemplate->email_subject="Admin Appointment Reminder";
			$emailtemplate->user_type="A";
			$adminemailtemplate=$emailtemplate->readone_client_email_template_body();

			if($adminemailtemplate[2] != ''){
				$admintemplate = base64_decode($adminemailtemplate[2]);
			}else{
				$admintemplate = base64_decode($adminemailtemplate[3]);
			}
			$adminsubject=$adminemailtemplate[1];

			if($setting->get_option('ct_admin_email_notification_status')=='Y' && $adminemailtemplate[4]=='E'){
				$admin_email_body = str_replace($searcharray,$replacearray,$admintemplate);

				if($setting->get_option('ct_smtp_hostname') != '' && $setting->get_option('ct_email_sender_name') != '' && $setting->get_option('ct_email_sender_address') != '' && $setting->get_option('ct_smtp_username') != '' && $setting->get_option('ct_smtp_password') != '' && $setting->get_option('ct_smtp_port') != ''){
					$mail_a->IsSMTP();
				}else{
					$mail_a->IsMail();
				}

				$mail_a->SMTPDebug  = 0;
				$mail_a->IsHTML(true);
				$mail_a->From = $company_email;
				$mail_a->FromName = $company_name;
				$mail_a->Sender = $company_email;
				$mail_a->AddAddress($admin_email, $get_admin_name);
				$mail_a->Subject = $adminsubject;
				$mail_a->Body = $admin_email_body;
				$mail_a->send();
			}
		}
	}
?>