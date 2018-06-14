<?php 

include(dirname(dirname(__FILE__))."/objects/class_gc_hook.php");

$gc_hook = new cleanto_gcHook();
$gc_hook->conn = $conn;

if($settings->get_option('ct_smtp_authetication') == 'true'){
	$mail_SMTPAuth = '1';
	if($settings->get_option('ct_smtp_hostname') == "smtp.gmail.com"){
		$mail_SMTPAuth = 'Yes';
	}
	
}else{
	$mail_SMTPAuth = '0';
	if($settings->get_option('ct_smtp_hostname') == "smtp.gmail.com"){
		$mail_SMTPAuth = 'No';
	}
}

$mail = new cleanto_phpmailer();
$mail->Host = $settings->get_option('ct_smtp_hostname');
$mail->Username = $settings->get_option('ct_smtp_username');
$mail->Password = $settings->get_option('ct_smtp_password');
$mail->Port = $settings->get_option('ct_smtp_port');
$mail->SMTPSecure = $settings->get_option('ct_smtp_encryption');
$mail->SMTPAuth = $mail_SMTPAuth;

$mail_a = new cleanto_phpmailer();
$mail_a->Host = $settings->get_option('ct_smtp_hostname');
$mail_a->Username = $settings->get_option('ct_smtp_username');
$mail_a->Password = $settings->get_option('ct_smtp_password');
$mail_a->Port = $settings->get_option('ct_smtp_port');
$mail_a->SMTPSecure = $settings->get_option('ct_smtp_encryption');
$mail->SMTPAuth = $mail_SMTPAuth;


/*NEXMO SMS GATEWAY VARIABLES*/

$nexmo_admin->ct_nexmo_api_key = $settings->get_option('ct_nexmo_api_key');
$nexmo_admin->ct_nexmo_api_secret = $settings->get_option('ct_nexmo_api_secret');
$nexmo_admin->ct_nexmo_from = $settings->get_option('ct_nexmo_from');

$nexmo_client->ct_nexmo_api_key = $settings->get_option('ct_nexmo_api_key');
$nexmo_client->ct_nexmo_api_secret = $settings->get_option('ct_nexmo_api_secret');
$nexmo_client->ct_nexmo_from = $settings->get_option('ct_nexmo_from');

/*SMS GATEWAY VARIABLES*/
$plivo_sender_number = $settings->get_option('ct_sms_plivo_sender_number');
$twilio_sender_number = $settings->get_option('ct_sms_twilio_sender_number');


/* textlocal gateway variables */
$textlocal_username =$settings->get_option('ct_sms_textlocal_account_username');
$textlocal_hash_id = $settings->get_option('ct_sms_textlocal_account_hash_id');


/*NEED VARIABLE FOR EMAIL*/
$company_city = $settings->get_option('ct_company_city');
$company_state = $settings->get_option('ct_company_state');
$company_zip = $settings->get_option('ct_company_zip_code');
$company_country = $settings->get_option('ct_company_country');
$company_phone = strlen($settings->get_option('ct_company_phone')) < 6 ? "" : $settings->get_option('ct_company_phone');
$company_address = $settings->get_option('ct_company_address'); 

/*** complete checkout code ***/

/*  set admin name */
$get_admin_name_result = $objadminprofile->readone_adminname();
$get_admin_name = $get_admin_name_result[3];
if($get_admin_name == ""){
	$get_admin_name = "Admin";
}
$admin_email = $settings->get_option('ct_admin_optional_email');
/* set admin name */
/* set business logo and logo alt */
 if($settings->get_option('ct_company_logo') != null && $settings->get_option('ct_company_logo') != ""){
	$business_logo= SITE_URL.'assets/images/services/'.$settings->get_option('ct_company_logo');
	$business_logo_alt= $settings->get_option('ct_company_name');
}else{
	$business_logo= '';
	$business_logo_alt= $settings->get_option('ct_company_name');
}
/* set business logo and logo alt */

$client_phone = "";
if(isset($_SESSION['recurrence_booking_status']) && $_SESSION['recurrence_booking_status'] != ''){
	$recurrence_booking_status = $_SESSION['recurrence_booking_status'];
}else{
	$recurrence_booking_status = '';
}

if(isset($_SESSION['recurrence_booking_type']) && $_SESSION['recurrence_booking_type'] != ''){
	$recurrence_booking_type = $_SESSION['recurrence_booking_type'];
}else{
	$recurrence_booking_type = '';
}

if(isset($_SESSION['recurrence_end_date']) && $_SESSION['recurrence_end_date'] != ''){
	$recurrence_end_date = $_SESSION['recurrence_end_date'];
}else{
	$recurrence_end_date = '';
}

if(isset($_SESSION['ct_details']) && $_SESSION['ct_details']!=''){

    $current_time = date('Y-m-d H:i:s');
    $coupon->coupon_code=$_SESSION['ct_details']['coupon_code'];
    $result=$coupon->checkcode();

    if($result){
        $coupon->inc=$result['coupon_used']+1;
        $coupon_exp_date=strtotime($result['coupon_expiry']);
		$today = date("Y-m-d"); 
        $curr_date=strtotime($today);

        if($result['coupon_used']<$result['coupon_limit'] && $curr_date<=$coupon_exp_date ){
            $coupon->update_coupon_limit();
        }
    }

    $freq_discount = '';
    if(isset($_SESSION['ct_details']['frequently_discount'])){
        $freq_discount = $_SESSION['ct_details']['frequently_discount'];
    }

    $zipcode='';
    if(isset($_SESSION['ct_details']['zipcode'])){
        $zipcode=$_SESSION['ct_details']['zipcode'];
    }
    $address='';
    if(isset($_SESSION['ct_details']['address'])){
        $address=$_SESSION['ct_details']['address'];
    }
    $city='';
    if(isset($_SESSION['ct_details']['city'])){
        $city=ucwords($_SESSION['ct_details']['city']);
    }

    $state='';
    if(isset($_SESSION['ct_details']['state'])){
        $state=ucwords($_SESSION['ct_details']['state']);
    }

    $notes='';
    if(isset($_SESSION['ct_details']['notes'])){
        $notes=$_SESSION['ct_details']['notes'];
    }

    $vc_status='';
    if(isset($_SESSION['ct_details']['vc_status'])){
        $vc_status=$_SESSION['ct_details']['vc_status'];
    }
	
	$staff_id='';
    if(isset($_SESSION['ct_details']['staff_id'])){
       $staff_id = $_SESSION['ct_details']['staff_id'];
    }
	
    $p_status='';
    if(isset($_SESSION['ct_details']['p_status'])){
        $p_status=$_SESSION['ct_details']['p_status'];
    }

    $contact_status='';
    if(isset($_SESSION['ct_details']['contact_status'])){
        $contact_status=mysqli_real_escape_string($conn,$_SESSION['ct_details']['contact_status']);
    }
	
	$contact_status_email=$_SESSION['ct_details']['contact_status'];

    if($last_order_id=='0' || $last_order_id==null){
        $orderid = 1000;
    }else{
        $orderid = $last_order_id+1;
    }
    $booking_date_time = date("Y-m-d H:i:s", strtotime($_SESSION['ct_details']['booking_date_time']));

    if( !function_exists( 'array_column' ) )
    {
        function array_column( array $input, $column_key, $index_key = null ) {
            $result = array();
            foreach( $input as $k => $v )
                $result[ $index_key ? $v[ $index_key ] : $k ] = $v[ $column_key ];
            return $result;
        }
    }


    $key = in_array('method_units', array_column($_SESSION['ct_cart']['method'], 'type'));
	
	$user->existing_username=$_SESSION['ct_details']['existing_username'];
	$user->existing_password=$_SESSION['ct_details']['existing_password'];
	$existing_login=$user->check_login();
	/** check and add booking for existing customer **/
	if($existing_login){
		$user->user_id=$existing_login[0];
		$user->user_pwd=$existing_login[2];
		$user->first_name=ucwords($_SESSION['ct_details']['firstname']);
		$user->last_name=ucwords($_SESSION['ct_details']['lastname']);
		$user->user_email=$existing_login[1];
		$user->phone=$_SESSION['ct_details']['phone'];
		$client_phone = $_SESSION['ct_details']['phone'];
		$user->address=$_SESSION['ct_details']['user_address'];
		$user->zip=$_SESSION['ct_details']['user_zipcode'];
		$user->city=ucwords($_SESSION['ct_details']['user_city']);
		$user->state=ucwords($_SESSION['ct_details']['user_state']);
		$user->notes=mysqli_real_escape_string($conn,$_SESSION['ct_details']['notes']);
		$user->vc_status=$_SESSION['ct_details']['vc_status'];
		$user->p_status=$_SESSION['ct_details']['p_status'];
		$user->status='E';
		$user->usertype=serialize(array('client'));
		$user->contact_status=mysqli_real_escape_string($conn,$_SESSION['ct_details']['contact_status']);
		$update_user=$user->update_user();
		if($update_user){
			if($recurrence_booking_status == 'Y' && $settings->get_option('ct_recurrence_booking_status') == 'Y') {
				if($recurrence_booking_type == 'daily'){
					$cust_now = strtotime($booking_date_time);
					$cust_your_date = strtotime($recurrence_end_date.' 23:59');
					$cust_datediff = $cust_your_date - $cust_now;
					$total_days = abs(floor($cust_datediff / (60 * 60 * 24)))+1;
					
					$recurr_booking_date_time = $booking_date_time;
					
					for($j=1;$j<=$total_days;$j++) {
						if(strtotime($recurr_booking_date_time) <= strtotime($recurrence_end_date.' 23:59')){
							if($j == '1') {
								$recurr_booking_date_time = $booking_date_time;
								$start_date = $booking_date_time;  
								$dates = strtotime($start_date);
								for($i=0;$i<(count($_SESSION['ct_cart']['method']));$i++){
									if($key == ''){
										/* insert into bookings table */
										$booking->order_id=$orderid;
										$booking->client_id=$existing_login[0];
										$booking->order_date=$current_time;
										$booking->booking_date_time=$recurr_booking_date_time;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->method_id='';
										$booking->method_unit_id='';
										$booking->method_unit_qty='';
										$booking->method_unit_qty_rate='';
										if($appointment_auto_confirm=="Y"){
											$booking->booking_status='C';
										}else{
											$booking->booking_status='A';
										}
										$booking->lastmodify=$current_time;
										$booking->read_status='U';
										$booking->staff_id= $staff_id;
										$add_booking=$booking->add_booking();
										/* insert into addons bookings table */
										$booking->order_id=$orderid;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										$add_booking=$booking->add_addons_booking();
									}else{
										if($_SESSION['ct_cart']['method'][$i]['type'] == 'method_units'){
											
											$booking->order_id=$orderid;
											$booking->client_id=$existing_login[0];
											$booking->order_date=$current_time;
											$booking->booking_date_time=$recurr_booking_date_time;
											$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
											$booking->method_id=$_SESSION['ct_cart']['method'][$i]['method_id'];
											$booking->method_unit_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
											$booking->method_unit_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
											$booking->method_unit_qty_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
											if($appointment_auto_confirm=="Y"){
												$booking->booking_status='C';
											}else{
												$booking->booking_status='A';
											}
											$booking->lastmodify=$current_time;
											$booking->read_status='U';
											$booking->staff_id= $staff_id;
											$add_booking=$booking->add_booking();
										}else if($_SESSION['ct_cart']['method'][$i]['type'] == 'addon'){
											
											$booking->order_id=$orderid;
											$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
											$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
											$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
											$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
											$add_booking=$booking->add_addons_booking();
										}
									}
								}
						
								$payment->order_id =$orderid;
								$payment->payment_method=ucwords('pay at venue');
								$payment->transaction_id= '';
								$payment->amount=$_SESSION['ct_details']['amount'];
								$payment->discount=$_SESSION['ct_details']['coupon_discount'];
								$payment->taxes=$_SESSION['ct_details']['taxes'];
								$payment->partial_amount=$_SESSION['ct_details']['partial_amount'];
								$payment->payment_date=$current_time;
								$payment->lastmodify=$current_time;
								$payment->net_amount=$_SESSION['ct_details']['net_amount'];
								$payment->frequently_discount = $freq_discount;
								$payment->frequently_discount_amount = $_SESSION['freq_dis_amount'];
								$payment->recurrence_status = 'Y';
								$payment->payment_status = 'Pending';
								$add_payment=$payment->add_payments();
								
								$order_client_info->order_id=$orderid;
								$order_client_info->client_name=ucwords($_SESSION['ct_details']['firstname']).' '.ucwords($_SESSION['ct_details']['lastname']);
								$order_client_info->client_email=$_SESSION['ct_details']['email'];
								$order_client_info->client_phone=$_SESSION['ct_details']['phone'];
								$client_phone = $_SESSION['ct_details']['phone'];
								$order_client_info->client_personal_info=base64_encode(serialize(array('zip'=>$zipcode,'address'=>$address,'city'=>$city,'state'=>$state,'notes'=>$notes,'vc_status'=>$vc_status,'p_status'=>$p_status,'contact_status'=>$contact_status)));
								$add_guest_user=$order_client_info->add_order_client();
								$date = strtotime("+$j days", $dates);
								$recurr_booking_date_time =  date('Y-m-d H:i:s', $date);
								$orderid++;
							} else {
								$start_date = $booking_date_time;  
								$dates = strtotime($start_date);
						
								for($i=0;$i<(count($_SESSION['ct_cart']['method']));$i++){
									if($key == ''){
										/* insert into bookings table */
										$booking->order_id=$orderid;
										$booking->client_id=$existing_login[0];
										$booking->order_date=$current_time;
										$booking->booking_date_time=$recurr_booking_date_time;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->method_id='';
										$booking->method_unit_id='';
										$booking->method_unit_qty='';
										$booking->method_unit_qty_rate='';
										if($appointment_auto_confirm=="Y"){
											$booking->booking_status='C';
										}else{
											$booking->booking_status='A';
										}
										$booking->lastmodify=$current_time;
										$booking->read_status='U';
										$booking->staff_id= $staff_id;
										$add_booking=$booking->add_booking();
										/* insert into addons bookings table */
										$booking->order_id=$orderid;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										$add_booking=$booking->add_addons_booking();
									}else{
										if($_SESSION['ct_cart']['method'][$i]['type'] == 'method_units'){
											$booking->order_id=$orderid;
											$booking->client_id=$existing_login[0];
											$booking->order_date=$current_time;
											$booking->booking_date_time=$recurr_booking_date_time;
											$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
											$booking->method_id=$_SESSION['ct_cart']['method'][$i]['method_id'];
											$booking->method_unit_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
											$booking->method_unit_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
											$booking->method_unit_qty_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
											if($appointment_auto_confirm=="Y"){
												$booking->booking_status='C';
											}else{
												$booking->booking_status='A';
											}
											$booking->lastmodify=$current_time;
											$booking->read_status='U';
											$booking->staff_id= $staff_id;
											$add_booking=$booking->add_booking();
										}else if($_SESSION['ct_cart']['method'][$i]['type'] == 'addon'){
											$booking->order_id=$orderid;
											$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
											$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
											$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
											$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
											$add_booking=$booking->add_addons_booking();
										}
									}
								}
						
								$payment->order_id =$orderid;
								$payment->payment_method=ucwords('pay at venue');
								$payment->transaction_id= '';
								$payment->amount=$_SESSION['ct_details']['amount'];
								$payment->discount=$_SESSION['ct_details']['coupon_discount'];
								$payment->taxes=$_SESSION['ct_details']['taxes'];
								$payment->partial_amount=$_SESSION['ct_details']['partial_amount'];
								$payment->payment_date=$current_time;
								$payment->lastmodify=$current_time;
								$payment->net_amount=$_SESSION['ct_details']['net_amount'];
								$payment->frequently_discount = $freq_discount;
								$payment->frequently_discount_amount = $_SESSION['freq_dis_amount'];
								$payment->recurrence_status = 'Y';
								$payment->payment_status = 'Pending';
								$add_payment=$payment->add_payments();
							}
							
							$order_client_info->order_id=$orderid;
							$order_client_info->client_name=ucwords($_SESSION['ct_details']['firstname']).' '.ucwords($_SESSION['ct_details']['lastname']);
							$order_client_info->client_email=$_SESSION['ct_details']['email'];
							$order_client_info->client_phone=$_SESSION['ct_details']['phone'];
							$client_phone = $_SESSION['ct_details']['phone'];
							$order_client_info->client_personal_info=base64_encode(serialize(array('zip'=>$zipcode,'address'=>$address,'city'=>$city,'state'=>$state,'notes'=>$notes,'vc_status'=>$vc_status,'p_status'=>$p_status,'contact_status'=>$contact_status)));
							$add_guest_user=$order_client_info->add_order_client();
							$date = strtotime("+$j days", $dates);
							$recurr_booking_date_time =  date('Y-m-d H:i:s', $date);
							$orderid++;
						}
					}
				}
				else if($recurrence_booking_type == 'weekly'){
					$cust_now = strtotime($booking_date_time);
					$cust_your_date = strtotime($recurrence_end_date.' 23:59');
					$cust_datediff = $cust_your_date - $cust_now;
					$total_days = abs(floor($cust_datediff / (60 * 60 * 24)))+1;
					$total_weeks = ceil($total_days / 7);
					
					$recurr_booking_date_time = $booking_date_time;
					for($j=1;$j<=$total_weeks;$j++) {
						if(strtotime($recurr_booking_date_time) <= strtotime($recurrence_end_date.' 23:59')){
							if($j == '1') {
								$recurr_booking_date_time = $booking_date_time;
								$start_date = $booking_date_time;  
								$dates = strtotime($start_date);
								for($i=0;$i<(count($_SESSION['ct_cart']['method']));$i++){
									if($key == ''){
										/* insert into bookings table */
										$booking->order_id=$orderid;
										$booking->client_id=$existing_login[0];
										$booking->order_date=$current_time;
										$booking->booking_date_time=$recurr_booking_date_time;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->method_id='';
										$booking->method_unit_id='';
										$booking->method_unit_qty='';
										$booking->method_unit_qty_rate='';
										if($appointment_auto_confirm=="Y"){
											$booking->booking_status='C';
										}else{
											$booking->booking_status='A';
										}
										$booking->lastmodify=$current_time;
										$booking->read_status='U';
										$booking->staff_id= $staff_id;
										$add_booking=$booking->add_booking();
										/* insert into addons bookings table */
										$booking->order_id=$orderid;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										$add_booking=$booking->add_addons_booking();
									}else{
										if($_SESSION['ct_cart']['method'][$i]['type'] == 'method_units'){
											$booking->order_id=$orderid;
											$booking->client_id=$existing_login[0];
											$booking->order_date=$current_time;
											$booking->booking_date_time=$recurr_booking_date_time;
											$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
											$booking->method_id=$_SESSION['ct_cart']['method'][$i]['method_id'];
											$booking->method_unit_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
											$booking->method_unit_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
											$booking->method_unit_qty_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
											if($appointment_auto_confirm=="Y"){
												$booking->booking_status='C';
											}else{
												$booking->booking_status='A';
											}
											$booking->lastmodify=$current_time;
											$booking->read_status='U';
											$booking->staff_id= $staff_id;
											$add_booking=$booking->add_booking();
										}else if($_SESSION['ct_cart']['method'][$i]['type'] == 'addon'){
											$booking->order_id=$orderid;
											$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
											$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
											$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
											$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
											$add_booking=$booking->add_addons_booking();
										}
									}
								}
				
								$payment->order_id =$orderid;
								$payment->payment_method=ucwords('pay at venue');
								$payment->transaction_id= '';
								$payment->amount=$_SESSION['ct_details']['amount'];
								$payment->discount=$_SESSION['ct_details']['coupon_discount'];
								$payment->taxes=$_SESSION['ct_details']['taxes'];
								$payment->partial_amount=$_SESSION['ct_details']['partial_amount'];
								$payment->payment_date=$current_time;
								$payment->lastmodify=$current_time;
								$payment->net_amount=$_SESSION['ct_details']['net_amount'];
								$payment->frequently_discount = $freq_discount;
								$payment->frequently_discount_amount = $_SESSION['freq_dis_amount'];
								$payment->recurrence_status = 'Y';
								$payment->payment_status = 'Pending';
								$add_payment=$payment->add_payments();

								$order_client_info->order_id=$orderid;
								$order_client_info->client_name=ucwords($_SESSION['ct_details']['firstname']).' '.ucwords($_SESSION['ct_details']['lastname']);
								$order_client_info->client_email=$_SESSION['ct_details']['email'];
								$order_client_info->client_phone=$_SESSION['ct_details']['phone'];
								$client_phone = $_SESSION['ct_details']['phone'];
								$order_client_info->client_personal_info=base64_encode(serialize(array('zip'=>$zipcode,'address'=>$address,'city'=>$city,'state'=>$state,'notes'=>$notes,'vc_status'=>$vc_status,'p_status'=>$p_status,'contact_status'=>$contact_status)));
								$add_guest_user=$order_client_info->add_order_client();
								$date = strtotime("+$j week", $dates);
								$recurr_booking_date_time =  date('Y-m-d H:i:s', $date);
								$orderid++;
							} else {
								$start_date = $booking_date_time;  
								$dates = strtotime($start_date);
				
								for($i=0;$i<(count($_SESSION['ct_cart']['method']));$i++){
									if($key == ''){
										/* insert into bookings table */
										$booking->order_id=$orderid;
										$booking->client_id=$existing_login[0];
										$booking->order_date=$current_time;
										$booking->booking_date_time=$recurr_booking_date_time;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->method_id='';
										$booking->method_unit_id='';
										$booking->method_unit_qty='';
										$booking->method_unit_qty_rate='';
										if($appointment_auto_confirm=="Y"){
											$booking->booking_status='C';
										}else{
											$booking->booking_status='A';
										}
										$booking->lastmodify=$current_time;
										$booking->read_status='U';
										$booking->staff_id= $staff_id;
										$add_booking=$booking->add_booking();
										/* insert into addons bookings table */
										$booking->order_id=$orderid;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										$add_booking=$booking->add_addons_booking();
									}else{
										if($_SESSION['ct_cart']['method'][$i]['type'] == 'method_units'){
											$booking->order_id=$orderid;
											$booking->client_id=$existing_login[0];
											$booking->order_date=$current_time;
											$booking->booking_date_time=$recurr_booking_date_time;
											$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
											$booking->method_id=$_SESSION['ct_cart']['method'][$i]['method_id'];
											$booking->method_unit_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
											$booking->method_unit_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
											$booking->method_unit_qty_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
											if($appointment_auto_confirm=="Y"){
												$booking->booking_status='C';
											}else{
												$booking->booking_status='A';
											}
											$booking->lastmodify=$current_time;
											$booking->read_status='U';
											$booking->staff_id= $staff_id;
											$add_booking=$booking->add_booking();
										}else if($_SESSION['ct_cart']['method'][$i]['type'] == 'addon'){
											
											$booking->order_id=$orderid;
											$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
											$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
											$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
											$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
											$add_booking=$booking->add_addons_booking();
										}
									}	
								}
				
								$payment->order_id =$orderid;
								$payment->payment_method=ucwords('pay at venue');
								$payment->transaction_id= '';
								$payment->amount=$_SESSION['ct_details']['amount'];
								$payment->discount=$_SESSION['ct_details']['coupon_discount'];
								$payment->taxes=$_SESSION['ct_details']['taxes'];
								$payment->partial_amount=$_SESSION['ct_details']['partial_amount'];
								$payment->payment_date=$current_time;
								$payment->lastmodify=$current_time;
								$payment->net_amount=$_SESSION['ct_details']['net_amount'];
								$payment->frequently_discount = $freq_discount;
								$payment->frequently_discount_amount = $_SESSION['freq_dis_amount'];
								$payment->recurrence_status = 'Y';
								$payment->payment_status = 'Pending';
								$add_payment=$payment->add_payments();
							}
							
							$order_client_info->order_id=$orderid;
							$order_client_info->client_name=ucwords($_SESSION['ct_details']['firstname']).' '.ucwords($_SESSION['ct_details']['lastname']);
							$order_client_info->client_email=$_SESSION['ct_details']['email'];
							$order_client_info->client_phone=$_SESSION['ct_details']['phone'];
							$client_phone = $_SESSION['ct_details']['phone'];
							$order_client_info->client_personal_info=base64_encode(serialize(array('zip'=>$zipcode,'address'=>$address,'city'=>$city,'state'=>$state,'notes'=>$notes,'vc_status'=>$vc_status,'p_status'=>$p_status,'contact_status'=>$contact_status)));
							$add_guest_user=$order_client_info->add_order_client();
							$date = strtotime("+$j week", $dates);
							$recurr_booking_date_time =  date('Y-m-d H:i:s', $date);
							$orderid++;
						}
					}
				}
				else if($recurrence_booking_type == 'monthly'){
					$ts1 = strtotime($booking_date_time);
					$ts2 = strtotime($recurrence_end_date.' 23:59');
					$year1 = date('Y', $ts1);
					$year2 = date('Y', $ts2);
					$month1 = date('m', $ts1);
					$month2 = date('m', $ts2);
					$total_months = (($year2 - $year1) * 12) + ($month2 - $month1)+1;
					
					$recurr_booking_date_time = $booking_date_time;
					for($j=1;$j<=$total_months;$j++) {
						if(strtotime($recurr_booking_date_time) <= strtotime($recurrence_end_date.' 23:59')){
							if($j == '1') {
								$recurr_booking_date_time = $booking_date_time;
								$start_date = $booking_date_time;  
								$dates = strtotime($start_date);
								for($i=0;$i<(count($_SESSION['ct_cart']['method']));$i++){
									if($key == ''){
										/* insert into bookings table */
										$booking->order_id=$orderid;
										$booking->client_id=$existing_login[0];
										$booking->order_date=$current_time;
										$booking->booking_date_time=$recurr_booking_date_time;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->method_id='';
										$booking->method_unit_id='';
										$booking->method_unit_qty='';
										$booking->method_unit_qty_rate='';
										if($appointment_auto_confirm=="Y"){
											$booking->booking_status='C';
										}else{
											$booking->booking_status='A';
										}
										$booking->lastmodify=$current_time;
										$booking->read_status='U';
										$booking->staff_id= $staff_id;
										$add_booking=$booking->add_booking();
										/* insert into addons bookings table */
										$booking->order_id=$orderid;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										$add_booking=$booking->add_addons_booking();
									}else{
										if($_SESSION['ct_cart']['method'][$i]['type'] == 'method_units'){
											$booking->order_id=$orderid;
											$booking->client_id=$existing_login[0];
											$booking->order_date=$current_time;
											$booking->booking_date_time=$recurr_booking_date_time;
											$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
											$booking->method_id=$_SESSION['ct_cart']['method'][$i]['method_id'];
											$booking->method_unit_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
											$booking->method_unit_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
											$booking->method_unit_qty_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
											if($appointment_auto_confirm=="Y"){
												$booking->booking_status='C';
											}else{
												$booking->booking_status='A';
											}
											$booking->lastmodify=$current_time;
											$booking->read_status='U';
											$booking->staff_id= $staff_id;
											$add_booking=$booking->add_booking();
										}else if($_SESSION['ct_cart']['method'][$i]['type'] == 'addon'){
											$booking->order_id=$orderid;
											$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
											$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
											$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
											$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
											$add_booking=$booking->add_addons_booking();
										}
									}
								}
							
								$payment->order_id =$orderid;
								$payment->payment_method=ucwords('pay at venue');
								$payment->transaction_id= '';
								$payment->amount=$_SESSION['ct_details']['amount'];
								$payment->discount=$_SESSION['ct_details']['coupon_discount'];
								$payment->taxes=$_SESSION['ct_details']['taxes'];
								$payment->partial_amount=$_SESSION['ct_details']['partial_amount'];
								$payment->payment_date=$current_time;
								$payment->lastmodify=$current_time;
								$payment->net_amount=$_SESSION['ct_details']['net_amount'];
								$payment->frequently_discount = $freq_discount;
								$payment->frequently_discount_amount = $_SESSION['freq_dis_amount'];
								$payment->recurrence_status = 'Y';
								$payment->payment_status = 'Pending';
								$add_payment=$payment->add_payments();
							
								$order_client_info->order_id=$orderid;
								$order_client_info->client_name=ucwords($_SESSION['ct_details']['firstname']).' '.ucwords($_SESSION['ct_details']['lastname']);
								$order_client_info->client_email=$_SESSION['ct_details']['email'];
								$order_client_info->client_phone=$_SESSION['ct_details']['phone'];
								$client_phone = $_SESSION['ct_details']['phone'];
								$order_client_info->client_personal_info=base64_encode(serialize(array('zip'=>$zipcode,'address'=>$address,'city'=>$city,'state'=>$state,'notes'=>$notes,'vc_status'=>$vc_status,'p_status'=>$p_status,'contact_status'=>$contact_status)));
								$add_guest_user=$order_client_info->add_order_client();
								$date = strtotime("+$j month", $dates);
								$recurr_booking_date_time =  date('Y-m-d H:i:s', $date);
								$orderid++;
							} else {
								$start_date = $booking_date_time;  
								$dates = strtotime($start_date);
							
								for($i=0;$i<(count($_SESSION['ct_cart']['method']));$i++){
									if($key == ''){
										/* insert into bookings table */
										$booking->order_id=$orderid;
										$booking->client_id=$existing_login[0];
										$booking->order_date=$current_time;
										$booking->booking_date_time=$recurr_booking_date_time;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->method_id='';
										$booking->method_unit_id='';
										$booking->method_unit_qty='';
										$booking->method_unit_qty_rate='';
										if($appointment_auto_confirm=="Y"){
											$booking->booking_status='C';
										}else{
											$booking->booking_status='A';
										}
										$booking->lastmodify=$current_time;
										$booking->read_status='U';
										$booking->staff_id= $staff_id;
										$add_booking=$booking->add_booking();
										/* insert into addons bookings table */
										$booking->order_id=$orderid;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										$add_booking=$booking->add_addons_booking();
									}else{
										if($_SESSION['ct_cart']['method'][$i]['type'] == 'method_units'){
											$booking->order_id=$orderid;
											$booking->client_id=$existing_login[0];
											$booking->order_date=$current_time;
											$booking->booking_date_time=$recurr_booking_date_time;
											$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
											$booking->method_id=$_SESSION['ct_cart']['method'][$i]['method_id'];
											$booking->method_unit_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
											$booking->method_unit_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
											$booking->method_unit_qty_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
											if($appointment_auto_confirm=="Y"){
												$booking->booking_status='C';
											}else{
												$booking->booking_status='A';
											}
											$booking->lastmodify=$current_time;
											$booking->read_status='U';
											$booking->staff_id= $staff_id;
											$add_booking=$booking->add_booking();
										}else if($_SESSION['ct_cart']['method'][$i]['type'] == 'addon'){
											$booking->order_id=$orderid;
											$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
											$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
											$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
											$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
											$add_booking=$booking->add_addons_booking();
										}
									}
								}
							
								$payment->order_id =$orderid;
								$payment->payment_method=ucwords('pay at venue');
								$payment->transaction_id= '';
								$payment->amount=$_SESSION['ct_details']['amount'];
								$payment->discount=$_SESSION['ct_details']['coupon_discount'];
								$payment->taxes=$_SESSION['ct_details']['taxes'];
								$payment->partial_amount=$_SESSION['ct_details']['partial_amount'];
								$payment->payment_date=$current_time;
								$payment->lastmodify=$current_time;
								$payment->net_amount=$_SESSION['ct_details']['net_amount'];
								$payment->frequently_discount = $freq_discount;
								$payment->frequently_discount_amount = $_SESSION['freq_dis_amount'];
								$payment->recurrence_status = 'Y';
								$payment->payment_status = 'Pending';
								$add_payment=$payment->add_payments();
							}
							
							$order_client_info->order_id=$orderid;
							$order_client_info->client_name=ucwords($_SESSION['ct_details']['firstname']).' '.ucwords($_SESSION['ct_details']['lastname']);
							$order_client_info->client_email=$_SESSION['ct_details']['email'];
							$order_client_info->client_phone=$_SESSION['ct_details']['phone'];
							$client_phone = $_SESSION['ct_details']['phone'];
							$order_client_info->client_personal_info=base64_encode(serialize(array('zip'=>$zipcode,'address'=>$address,'city'=>$city,'state'=>$state,'notes'=>$notes,'vc_status'=>$vc_status,'p_status'=>$p_status,'contact_status'=>$contact_status)));
							$add_guest_user=$order_client_info->add_order_client();
							$date = strtotime("+$j month", $dates);
							$recurr_booking_date_time =  date('Y-m-d H:i:s', $date);
							$orderid++;
						}
					}
				}
				else if($recurrence_booking_type == 'biweekly'){
					$cust_now = strtotime($booking_date_time);
					$cust_your_date = strtotime($recurrence_end_date.' 23:59');
					$cust_datediff = $cust_your_date - $cust_now;
					$total_days = abs(floor($cust_datediff / (60 * 60 * 24)))+1;
					
					$recurr_booking_date_time = $booking_date_time;
					for($j=1;$j<=$total_days;$j++) {
						if(strtotime($recurr_booking_date_time) <= strtotime($recurrence_end_date.' 23:59')){
							if($j == '1') {
								$recurr_booking_date_time = $booking_date_time;
								$start_date = $booking_date_time;  
								$dates = strtotime($start_date);
								for($i=0;$i<(count($_SESSION['ct_cart']['method']));$i++){
									if($key == ''){
										/* insert into bookings table */
										$booking->order_id=$orderid;
										$booking->client_id=$existing_login[0];
										$booking->order_date=$current_time;
										$booking->booking_date_time=$recurr_booking_date_time;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->method_id='';
										$booking->method_unit_id='';
										$booking->method_unit_qty='';
										$booking->method_unit_qty_rate='';
										if($appointment_auto_confirm=="Y"){
											$booking->booking_status='C';
										}else{
											$booking->booking_status='A';
										}
										$booking->lastmodify=$current_time;
										$booking->read_status='U';
										$booking->staff_id= $staff_id;
										$add_booking=$booking->add_booking();
										/* insert into addons bookings table */
										$booking->order_id=$orderid;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										$add_booking=$booking->add_addons_booking();
									}else{
										if($_SESSION['ct_cart']['method'][$i]['type'] == 'method_units'){
											$booking->order_id=$orderid;
											$booking->client_id=$existing_login[0];
											$booking->order_date=$current_time;
											$booking->booking_date_time=$recurr_booking_date_time;
											$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
											$booking->method_id=$_SESSION['ct_cart']['method'][$i]['method_id'];
											$booking->method_unit_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
											$booking->method_unit_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
											$booking->method_unit_qty_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
											if($appointment_auto_confirm=="Y"){
												$booking->booking_status='C';
											}else{
												$booking->booking_status='A';
											}
											$booking->lastmodify=$current_time;
											$booking->read_status='U';
											$booking->staff_id= $staff_id;
											$add_booking=$booking->add_booking();
										}else if($_SESSION['ct_cart']['method'][$i]['type'] == 'addon'){
											$booking->order_id=$orderid;
											$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
											$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
											$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
											$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
											$add_booking=$booking->add_addons_booking();
										}
									}
								}
								
								$payment->order_id =$orderid;
								$payment->payment_method=ucwords('pay at venue');
								$payment->transaction_id= '';
								$payment->amount=$_SESSION['ct_details']['amount'];
								$payment->discount=$_SESSION['ct_details']['coupon_discount'];
								$payment->taxes=$_SESSION['ct_details']['taxes'];
								$payment->partial_amount=$_SESSION['ct_details']['partial_amount'];
								$payment->payment_date=$current_time;
								$payment->lastmodify=$current_time;
								$payment->net_amount=$_SESSION['ct_details']['net_amount'];
								$payment->frequently_discount = $freq_discount;
								$payment->frequently_discount_amount = $_SESSION['freq_dis_amount'];
								$payment->recurrence_status = 'Y';
								$payment->payment_status = 'Pending';
								$add_payment=$payment->add_payments();
								
								$order_client_info->order_id=$orderid;
								$order_client_info->client_name=ucwords($_SESSION['ct_details']['firstname']).' '.ucwords($_SESSION['ct_details']['lastname']);
								$order_client_info->client_email=$_SESSION['ct_details']['email'];
								$order_client_info->client_phone=$_SESSION['ct_details']['phone'];
								$client_phone = $_SESSION['ct_details']['phone'];
								$order_client_info->client_personal_info=base64_encode(serialize(array('zip'=>$zipcode,'address'=>$address,'city'=>$city,'state'=>$state,'notes'=>$notes,'vc_status'=>$vc_status,'p_status'=>$p_status,'contact_status'=>$contact_status)));
								$add_guest_user=$order_client_info->add_order_client();
							} else {
								$start_date = $booking_date_time;  
								$dates = strtotime($start_date);
						
								for($i=0;$i<(count($_SESSION['ct_cart']['method']));$i++){
									if($key == ''){
										/* insert into bookings table */
										$booking->order_id=$orderid;
										$booking->client_id=$existing_login[0];
										$booking->order_date=$current_time;
										$booking->booking_date_time=$recurr_booking_date_time;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->method_id='';
										$booking->method_unit_id='';
										$booking->method_unit_qty='';
										$booking->method_unit_qty_rate='';
										if($appointment_auto_confirm=="Y"){
											$booking->booking_status='C';
										}else{
											$booking->booking_status='A';
										}
										$booking->lastmodify=$current_time;
										$booking->read_status='U';
										$booking->staff_id= $staff_id;
										$add_booking=$booking->add_booking();
										/* insert into addons bookings table */
										$booking->order_id=$orderid;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										$add_booking=$booking->add_addons_booking();
									}else{
										if($_SESSION['ct_cart']['method'][$i]['type'] == 'method_units'){
											$booking->order_id=$orderid;
											$booking->client_id=$existing_login[0];
											$booking->order_date=$current_time;
											$booking->booking_date_time=$recurr_booking_date_time;
											$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
											$booking->method_id=$_SESSION['ct_cart']['method'][$i]['method_id'];
											$booking->method_unit_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
											$booking->method_unit_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
											$booking->method_unit_qty_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
											if($appointment_auto_confirm=="Y"){
												$booking->booking_status='C';
											}else{
												$booking->booking_status='A';
											}
											$booking->lastmodify=$current_time;
											$booking->read_status='U';
											$booking->staff_id= $staff_id;
											$add_booking=$booking->add_booking();
										}else if($_SESSION['ct_cart']['method'][$i]['type'] == 'addon'){
											$booking->order_id=$orderid;
											$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
											$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
											$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
											$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
											$add_booking=$booking->add_addons_booking();
										}
									}
								}
				
								$payment->order_id =$orderid;
								$payment->payment_method=ucwords('pay at venue');
								$payment->transaction_id= '';
								$payment->amount=$_SESSION['ct_details']['amount'];
								$payment->discount=$_SESSION['ct_details']['coupon_discount'];
								$payment->taxes=$_SESSION['ct_details']['taxes'];
								$payment->partial_amount=$_SESSION['ct_details']['partial_amount'];
								$payment->payment_date=$current_time;
								$payment->lastmodify=$current_time;
								$payment->net_amount=$_SESSION['ct_details']['net_amount'];
								$payment->frequently_discount = $freq_discount;
								$payment->frequently_discount_amount = $_SESSION['freq_dis_amount'];
								$payment->recurrence_status = 'Y';
								$payment->payment_status = 'Pending';
								$add_payment=$payment->add_payments();
							}
							
							$order_client_info->order_id=$orderid;
							$order_client_info->client_name=ucwords($_SESSION['ct_details']['firstname']).' '.ucwords($_SESSION['ct_details']['lastname']);
							$order_client_info->client_email=$_SESSION['ct_details']['email'];
							$order_client_info->client_phone=$_SESSION['ct_details']['phone'];
							$client_phone = $_SESSION['ct_details']['phone'];
							$order_client_info->client_personal_info=base64_encode(serialize(array('zip'=>$zipcode,'address'=>$address,'city'=>$city,'state'=>$state,'notes'=>$notes,'vc_status'=>$vc_status,'p_status'=>$p_status,'contact_status'=>$contact_status)));
							$add_guest_user=$order_client_info->add_order_client();
							$j += 2;
							$date = strtotime("$j days", $dates);
							$recurr_booking_date_time =  date('Y-m-d H:i:s', $date);
							$orderid++;
						}
					}
				}
				else if($recurrence_booking_type == 'bimonthly'){
					$cust_now = strtotime($booking_date_time);
					$cust_your_date = strtotime($recurrence_end_date.' 23:59');
					$cust_datediff = $cust_your_date - $cust_now;
					$total_days = abs(floor($cust_datediff / (60 * 60 * 24)))+1;
					
					$recurr_booking_date_time = $booking_date_time;
					for($j=1;$j<=$total_days;$j++) {
						if(strtotime($recurr_booking_date_time) <= strtotime($recurrence_end_date.' 23:59')){
							if($j == '1') {
								$recurr_booking_date_time = $booking_date_time;
								$start_date = $booking_date_time;  
								$dates = strtotime($start_date);
								for($i=0;$i<(count($_SESSION['ct_cart']['method']));$i++){
									if($key == ''){
										/* insert into bookings table */
										$booking->order_id=$orderid;
										$booking->client_id=$existing_login[0];
										$booking->order_date=$current_time;
										$booking->booking_date_time=$recurr_booking_date_time;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->method_id='';
										$booking->method_unit_id='';
										$booking->method_unit_qty='';
										$booking->method_unit_qty_rate='';
										if($appointment_auto_confirm=="Y"){
											$booking->booking_status='C';
										}else{
											$booking->booking_status='A';
										}
										$booking->lastmodify=$current_time;
										$booking->read_status='U';
										$booking->staff_id= $staff_id;
										$add_booking=$booking->add_booking();
										/* insert into addons bookings table */
										$booking->order_id=$orderid;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										$add_booking=$booking->add_addons_booking();
									}else{
										if($_SESSION['ct_cart']['method'][$i]['type'] == 'method_units'){
											$booking->order_id=$orderid;
											$booking->client_id=$existing_login[0];
											$booking->order_date=$current_time;
											$booking->booking_date_time=$recurr_booking_date_time;
											$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
											$booking->method_id=$_SESSION['ct_cart']['method'][$i]['method_id'];
											$booking->method_unit_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
											$booking->method_unit_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
											$booking->method_unit_qty_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
											if($appointment_auto_confirm=="Y"){
												$booking->booking_status='C';
											}else{
												$booking->booking_status='A';
											}
											$booking->lastmodify=$current_time;
											$booking->read_status='U';
											$booking->staff_id= $staff_id;
											$add_booking=$booking->add_booking();
										}else if($_SESSION['ct_cart']['method'][$i]['type'] == 'addon'){
											$booking->order_id=$orderid;
											$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
											$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
											$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
											$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
											$add_booking=$booking->add_addons_booking();
										}
									}
								}
								
								$payment->order_id =$orderid;
								$payment->payment_method=ucwords('pay at venue');
								$payment->transaction_id= '';
								$payment->amount=$_SESSION['ct_details']['amount'];
								$payment->discount=$_SESSION['ct_details']['coupon_discount'];
								$payment->taxes=$_SESSION['ct_details']['taxes'];
								$payment->partial_amount=$_SESSION['ct_details']['partial_amount'];
								$payment->payment_date=$current_time;
								$payment->lastmodify=$current_time;
								$payment->net_amount=$_SESSION['ct_details']['net_amount'];
								$payment->frequently_discount = $freq_discount;
								$payment->frequently_discount_amount = $_SESSION['freq_dis_amount'];
								$payment->recurrence_status = 'Y';
								$payment->payment_status = 'Pending';
								$add_payment=$payment->add_payments();
								
								$order_client_info->order_id=$orderid;
								$order_client_info->client_name=ucwords($_SESSION['ct_details']['firstname']).' '.ucwords($_SESSION['ct_details']['lastname']);
								$order_client_info->client_email=$_SESSION['ct_details']['email'];
								$order_client_info->client_phone=$_SESSION['ct_details']['phone'];
								$client_phone = $_SESSION['ct_details']['phone'];
								$order_client_info->client_personal_info=base64_encode(serialize(array('zip'=>$zipcode,'address'=>$address,'city'=>$city,'state'=>$state,'notes'=>$notes,'vc_status'=>$vc_status,'p_status'=>$p_status,'contact_status'=>$contact_status)));
								$add_guest_user=$order_client_info->add_order_client();
							} else {
								$start_date = $booking_date_time;  
								$dates = strtotime($start_date);
							
								for($i=0;$i<(count($_SESSION['ct_cart']['method']));$i++){
									if($key == ''){
										/* insert into bookings table */
										$booking->order_id=$orderid;
										$booking->client_id=$existing_login[0];
										$booking->order_date=$current_time;
										$booking->booking_date_time=$recurr_booking_date_time;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->method_id='';
										$booking->method_unit_id='';
										$booking->method_unit_qty='';
										$booking->method_unit_qty_rate='';
										if($appointment_auto_confirm=="Y"){
											$booking->booking_status='C';
										}else{
											$booking->booking_status='A';
										}
										$booking->lastmodify=$current_time;
										$booking->read_status='U';
										$booking->staff_id= $staff_id;
										$add_booking=$booking->add_booking();
										/* insert into addons bookings table */
										$booking->order_id=$orderid;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										$add_booking=$booking->add_addons_booking();
									}else{
										if($_SESSION['ct_cart']['method'][$i]['type'] == 'method_units'){
											$booking->order_id=$orderid;
											$booking->client_id=$existing_login[0];
											$booking->order_date=$current_time;
											$booking->booking_date_time=$recurr_booking_date_time;
											$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
											$booking->method_id=$_SESSION['ct_cart']['method'][$i]['method_id'];
											$booking->method_unit_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
											$booking->method_unit_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
											$booking->method_unit_qty_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
											if($appointment_auto_confirm=="Y"){
												$booking->booking_status='C';
											}else{
												$booking->booking_status='A';
											}
											$booking->lastmodify=$current_time;
											$booking->read_status='U';
											$booking->staff_id= $staff_id;
											$add_booking=$booking->add_booking();
										}else if($_SESSION['ct_cart']['method'][$i]['type'] == 'addon'){
											$booking->order_id=$orderid;
											$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
											$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
											$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
											$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
											$add_booking=$booking->add_addons_booking();
										}
									}
								}
					
								$payment->order_id =$orderid;
								$payment->payment_method=ucwords('pay at venue');
								$payment->transaction_id= '';
								$payment->amount=$_SESSION['ct_details']['amount'];
								$payment->discount=$_SESSION['ct_details']['coupon_discount'];
								$payment->taxes=$_SESSION['ct_details']['taxes'];
								$payment->partial_amount=$_SESSION['ct_details']['partial_amount'];
								$payment->payment_date=$current_time;
								$payment->lastmodify=$current_time;
								$payment->net_amount=$_SESSION['ct_details']['net_amount'];
								$payment->frequently_discount = $freq_discount;
								$payment->frequently_discount_amount = $_SESSION['freq_dis_amount'];
								$payment->recurrence_status = 'Y';
								$payment->payment_status = 'Pending';
								$add_payment=$payment->add_payments();
							}
							
							$order_client_info->order_id=$orderid;
							$order_client_info->client_name=ucwords($_SESSION['ct_details']['firstname']).' '.ucwords($_SESSION['ct_details']['lastname']);
							$order_client_info->client_email=$_SESSION['ct_details']['email'];
							$order_client_info->client_phone=$_SESSION['ct_details']['phone'];
							$client_phone = $_SESSION['ct_details']['phone'];
							$order_client_info->client_personal_info=base64_encode(serialize(array('zip'=>$zipcode,'address'=>$address,'city'=>$city,'state'=>$state,'notes'=>$notes,'vc_status'=>$vc_status,'p_status'=>$p_status,'contact_status'=>$contact_status)));
							$add_guest_user=$order_client_info->add_order_client();
							$j += 15;
							$date = strtotime("$j days", $dates);
							$recurr_booking_date_time =  date('Y-m-d H:i:s', $date);
							$orderid++;
						}
					}
				}
				else if($recurrence_booking_type == 'fortnightly'){
					$cust_now = strtotime($booking_date_time);
					$cust_your_date = strtotime($recurrence_end_date.' 23:59');
					$cust_datediff = $cust_your_date - $cust_now;
					$total_days = abs(floor($cust_datediff / (60 * 60 * 24)))+1;
					$total_weeks = ceil($total_days / 7);
					
					$recurr_booking_date_time = $booking_date_time;
					
					for($j=1;$j<=$total_weeks;$j++) {
						if(strtotime($recurr_booking_date_time) <= strtotime($recurrence_end_date.' 23:59')){
							if($j == '1') {
								$recurr_booking_date_time = $booking_date_time;
								$start_date = $booking_date_time;  
								$dates = strtotime($start_date);
								for($i=0;$i<(count($_SESSION['ct_cart']['method']));$i++){
									if($key == ''){
										/* insert into bookings table */
										$booking->order_id=$orderid;
										$booking->client_id=$existing_login[0];
										$booking->order_date=$current_time;
										$booking->booking_date_time=$recurr_booking_date_time;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->method_id='';
										$booking->method_unit_id='';
										$booking->method_unit_qty='';
										$booking->method_unit_qty_rate='';
										if($appointment_auto_confirm=="Y"){
											$booking->booking_status='C';
										}else{
											$booking->booking_status='A';
										}
										$booking->lastmodify=$current_time;
										$booking->read_status='U';
										$booking->staff_id= $staff_id;
										$add_booking=$booking->add_booking();
										/* insert into addons bookings table */
										$booking->order_id=$orderid;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										$add_booking=$booking->add_addons_booking();
									}else{
										if($_SESSION['ct_cart']['method'][$i]['type'] == 'method_units'){
											$booking->order_id=$orderid;
											$booking->client_id=$existing_login[0];
											$booking->order_date=$current_time;
											$booking->booking_date_time=$recurr_booking_date_time;
											$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
											$booking->method_id=$_SESSION['ct_cart']['method'][$i]['method_id'];
											$booking->method_unit_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
											$booking->method_unit_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
											$booking->method_unit_qty_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
											if($appointment_auto_confirm=="Y"){
												$booking->booking_status='C';
											}else{
												$booking->booking_status='A';
											}
											$booking->lastmodify=$current_time;
											$booking->read_status='U';
											$booking->staff_id= $staff_id;
											$add_booking=$booking->add_booking();
										}else if($_SESSION['ct_cart']['method'][$i]['type'] == 'addon'){
											$booking->order_id=$orderid;
											$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
											$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
											$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
											$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
											$add_booking=$booking->add_addons_booking();
										}
									}
								}
								
								$payment->order_id =$orderid;
								$payment->payment_method=ucwords('pay at venue');
								$payment->transaction_id= '';
								$payment->amount=$_SESSION['ct_details']['amount'];
								$payment->discount=$_SESSION['ct_details']['coupon_discount'];
								$payment->taxes=$_SESSION['ct_details']['taxes'];
								$payment->partial_amount=$_SESSION['ct_details']['partial_amount'];
								$payment->payment_date=$current_time;
								$payment->lastmodify=$current_time;
								$payment->net_amount=$_SESSION['ct_details']['net_amount'];
								$payment->frequently_discount = $freq_discount;
								$payment->frequently_discount_amount = $_SESSION['freq_dis_amount'];
								$payment->recurrence_status = 'Y';
								$payment->payment_status = 'Pending';
								$add_payment=$payment->add_payments();
								
								$order_client_info->order_id=$orderid;
								$order_client_info->client_name=ucwords($_SESSION['ct_details']['firstname']).' '.ucwords($_SESSION['ct_details']['lastname']);
								$order_client_info->client_email=$_SESSION['ct_details']['email'];
								$order_client_info->client_phone=$_SESSION['ct_details']['phone'];
								$client_phone = $_SESSION['ct_details']['phone'];
								$order_client_info->client_personal_info=base64_encode(serialize(array('zip'=>$zipcode,'address'=>$address,'city'=>$city,'state'=>$state,'notes'=>$notes,'vc_status'=>$vc_status,'p_status'=>$p_status,'contact_status'=>$contact_status)));
								$add_guest_user=$order_client_info->add_order_client();
							} else {
								$start_date = $booking_date_time;  
								$dates = strtotime($start_date);
							
								for($i=0;$i<(count($_SESSION['ct_cart']['method']));$i++){
									if($key == ''){
										/* insert into bookings table */
										$booking->order_id=$orderid;
										$booking->client_id=$existing_login[0];
										$booking->order_date=$current_time;
										$booking->booking_date_time=$recurr_booking_date_time;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->method_id='';
										$booking->method_unit_id='';
										$booking->method_unit_qty='';
										$booking->method_unit_qty_rate='';
										if($appointment_auto_confirm=="Y"){
											$booking->booking_status='C';
										}else{
											$booking->booking_status='A';
										}
										$booking->lastmodify=$current_time;
										$booking->read_status='U';
										$booking->staff_id= $staff_id;
										$add_booking=$booking->add_booking();
										/* insert into addons bookings table */
										$booking->order_id=$orderid;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										$add_booking=$booking->add_addons_booking();
									}else{
										if($_SESSION['ct_cart']['method'][$i]['type'] == 'method_units'){
											$booking->order_id=$orderid;
											$booking->client_id=$existing_login[0];
											$booking->order_date=$current_time;
											$booking->booking_date_time=$recurr_booking_date_time;
											$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
											$booking->method_id=$_SESSION['ct_cart']['method'][$i]['method_id'];
											$booking->method_unit_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
											$booking->method_unit_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
											$booking->method_unit_qty_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
											if($appointment_auto_confirm=="Y"){
												$booking->booking_status='C';
											}else{
												$booking->booking_status='A';
											}
											$booking->lastmodify=$current_time;
											$booking->read_status='U';
											$booking->staff_id= $staff_id;
											$add_booking=$booking->add_booking();
										}else if($_SESSION['ct_cart']['method'][$i]['type'] == 'addon'){
											$booking->order_id=$orderid;
											$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
											$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
											$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
											$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
											$add_booking=$booking->add_addons_booking();
										}
									}
								}
						
								$payment->order_id =$orderid;
								$payment->payment_method=ucwords('pay at venue');
								$payment->transaction_id= '';
								$payment->amount=$_SESSION['ct_details']['amount'];
								$payment->discount=$_SESSION['ct_details']['coupon_discount'];
								$payment->taxes=$_SESSION['ct_details']['taxes'];
								$payment->partial_amount=$_SESSION['ct_details']['partial_amount'];
								$payment->payment_date=$current_time;
								$payment->lastmodify=$current_time;
								$payment->net_amount=$_SESSION['ct_details']['net_amount'];
								$payment->frequently_discount = $freq_discount;
								$payment->frequently_discount_amount = $_SESSION['freq_dis_amount'];
								$payment->recurrence_status = 'Y';
								$payment->payment_status = 'Pending';
								$add_payment=$payment->add_payments();
							}
							
							$order_client_info->order_id=$orderid;
							$order_client_info->client_name=ucwords($_SESSION['ct_details']['firstname']).' '.ucwords($_SESSION['ct_details']['lastname']);
							$order_client_info->client_email=$_SESSION['ct_details']['email'];
							$order_client_info->client_phone=$_SESSION['ct_details']['phone'];
							$client_phone = $_SESSION['ct_details']['phone'];
							$order_client_info->client_personal_info=base64_encode(serialize(array('zip'=>$zipcode,'address'=>$address,'city'=>$city,'state'=>$state,'notes'=>$notes,'vc_status'=>$vc_status,'p_status'=>$p_status,'contact_status'=>$contact_status)));
							$add_guest_user=$order_client_info->add_order_client();
							$j += 1;
							$date = strtotime("$j week", $dates);
							$recurr_booking_date_time =  date('Y-m-d H:i:s', $date);
							$orderid++;
						}
					}
				}
			} else {
				for($i=0;$i<(count($_SESSION['ct_cart']['method']));$i++){
					if($key == ''){
						/*insert into bookings table */
						$booking->order_id=$orderid;
						$booking->client_id=$existing_login[0];
						$booking->order_date=$current_time;
						$booking->booking_date_time=$booking_date_time;
						$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
						$booking->method_id='';
						$booking->method_unit_id='';
						$booking->method_unit_qty='';
						$booking->method_unit_qty_rate='';
						if($appointment_auto_confirm=="Y"){
							$booking->booking_status='C';
						}else{
							$booking->booking_status='A';
						}
						$booking->lastmodify=$current_time;
						$booking->read_status='U';
						$booking->staff_id= $staff_id;
						$add_booking=$booking->add_booking();
						/*insert into addons booking table */
						$booking->order_id=$orderid;
						$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
						$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
						$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
						$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
						$add_booking=$booking->add_addons_booking();
					}else{
						if($_SESSION['ct_cart']['method'][$i]['type'] == 'method_units'){
							$booking->order_id=$orderid;
							$booking->client_id=$existing_login[0];
							$booking->order_date=$current_time;
							$booking->booking_date_time=$booking_date_time;
							$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
							$booking->method_id=$_SESSION['ct_cart']['method'][$i]['method_id'];
							$booking->method_unit_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
							$booking->method_unit_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
							$booking->method_unit_qty_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
							if($appointment_auto_confirm=="Y"){
								$booking->booking_status='C';
							}else{
								$booking->booking_status='A';
							}
							$booking->lastmodify=$current_time;
							$booking->read_status='U';
							$booking->staff_id= $staff_id;
							$add_booking=$booking->add_booking();
						}else if($_SESSION['ct_cart']['method'][$i]['type'] == 'addon'){
							$booking->order_id=$orderid;
							$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
							$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
							$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
							$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
							$add_booking=$booking->add_addons_booking();
						}
					}
				}
				
				$payment->order_id =$orderid;
				$payment->payment_method=ucwords('pay at venue');
				if(isset($_POST['transaction_id'])){
					$payment->transaction_id= $_POST['transaction_id'];
				} else {
					$payment->transaction_id='';
				}
				$payment->amount=$_SESSION['ct_details']['amount'];
				$payment->discount=$_SESSION['ct_details']['coupon_discount'];
				$payment->taxes=$_SESSION['ct_details']['taxes'];
				$payment->partial_amount=$_SESSION['ct_details']['partial_amount'];
				$payment->payment_date=$current_time;
				$payment->lastmodify=$current_time;
				$payment->net_amount=$_SESSION['ct_details']['net_amount'];
				$payment->frequently_discount = $freq_discount;
				$payment->frequently_discount_amount = $_SESSION['freq_dis_amount'];
				$payment->recurrence_status = 'N';
				$payment->payment_status = 'Pending';
				$add_payment=$payment->add_payments();
				
				$order_client_info->order_id=$orderid;
				$order_client_info->client_name=ucwords($_SESSION['ct_details']['firstname']).' '.ucwords($_SESSION['ct_details']['lastname']);
				$order_client_info->client_email=$existing_login[1];
				$order_client_info->client_phone=$_SESSION['ct_details']['phone'];
				$order_client_info->client_personal_info=base64_encode(serialize(array('zip'=>$zipcode,'address'=>$address,'city'=>$city,'state'=>$state,'notes'=>$notes,'vc_status'=>$vc_status,'p_status'=>$p_status,'contact_status'=>$contact_status)));
				$add_existing_user=$order_client_info->add_order_client();
			}
		}
	}
	else{
		/** check and add booking for new customer **/
		$user->user_pwd=md5($_SESSION['ct_details']['password']);
		$user->first_name=ucwords($_SESSION['ct_details']['firstname']);
		$user->last_name=ucwords($_SESSION['ct_details']['lastname']);
		$user->user_email=$_SESSION['ct_details']['email'];
		$user->phone=$_SESSION['ct_details']['phone'];
		$client_phone = $_SESSION['ct_details']['phone'];
		$user->address=$_SESSION['ct_details']['user_address'];
		$user->zip=$_SESSION['ct_details']['user_zipcode'];
		$user->city=ucwords($_SESSION['ct_details']['user_city']);
		$user->state=ucwords($_SESSION['ct_details']['user_state']);
		$user->notes=mysqli_real_escape_string($conn,$_SESSION['ct_details']['notes']);
		$user->vc_status=$_SESSION['ct_details']['vc_status'];
		$user->p_status=$_SESSION['ct_details']['p_status'];
		$user->status='E';
		$user->usertype=serialize(array('client'));
		$user->contact_status=mysqli_real_escape_string($conn,$_SESSION['ct_details']['contact_status']);
		$add_user=$user->add_user();

		$inserted_user = $conn->insert_id;
		if($recurrence_booking_status == 'Y' && $settings->get_option('ct_recurrence_booking_status') == 'Y') {
			if($recurrence_booking_type == 'daily'){
				$cust_now = strtotime($booking_date_time);
				$cust_your_date = strtotime($recurrence_end_date.' 23:59');
				$cust_datediff = $cust_your_date - $cust_now;
				$total_days = abs(floor($cust_datediff / (60 * 60 * 24)))+1;
				
				$recurr_booking_date_time = $booking_date_time;
				
				for($j=1;$j<=$total_days;$j++) {
					if(strtotime($recurr_booking_date_time) <= strtotime($recurrence_end_date.' 23:59')){
						if($j == '1') {
							$recurr_booking_date_time = $booking_date_time;
							$start_date = $booking_date_time;  
							$dates = strtotime($start_date);
							for($i=0;$i<(count($_SESSION['ct_cart']['method']));$i++){
								if($key == ''){
									/* insert into bookings table */
									$booking->order_id=$orderid;
									$booking->client_id=$add_user;
									$booking->order_date=$current_time;
									$booking->booking_date_time=$recurr_booking_date_time;
									$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
									$booking->method_id='';
									$booking->method_unit_id='';
									$booking->method_unit_qty='';
									$booking->method_unit_qty_rate='';
									if($appointment_auto_confirm=="Y"){
										$booking->booking_status='C';
									}else{
										$booking->booking_status='A';
									}
									$booking->lastmodify=$current_time;
									$booking->read_status='U';
									$booking->staff_id= $staff_id;
									$add_booking=$booking->add_booking();
									/* insert into addons bookings table */
									$booking->order_id=$orderid;
									$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
									$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
									$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
									$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
									$add_booking=$booking->add_addons_booking();
								}else{
									if($_SESSION['ct_cart']['method'][$i]['type'] == 'method_units'){
										$booking->order_id=$orderid;
										$booking->client_id=$add_user;
										$booking->order_date=$current_time;
										$booking->booking_date_time=$recurr_booking_date_time;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->method_id=$_SESSION['ct_cart']['method'][$i]['method_id'];
										$booking->method_unit_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->method_unit_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->method_unit_qty_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										if($appointment_auto_confirm=="Y"){
											$booking->booking_status='C';
										}else{
											$booking->booking_status='A';
										}
										$booking->lastmodify=$current_time;
										$booking->read_status='U';
										$booking->staff_id= $staff_id;
										$add_booking=$booking->add_booking();
									}else if($_SESSION['ct_cart']['method'][$i]['type'] == 'addon'){
										$booking->order_id=$orderid;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										$add_booking=$booking->add_addons_booking();
									}
								}
							}
						
							$payment->order_id =$orderid;
							$payment->payment_method=ucwords('pay at venue');
							$payment->transaction_id= '';
							$payment->amount=$_SESSION['ct_details']['amount'];
							$payment->discount=$_SESSION['ct_details']['coupon_discount'];
							$payment->taxes=$_SESSION['ct_details']['taxes'];
							$payment->partial_amount=$_SESSION['ct_details']['partial_amount'];
							$payment->payment_date=$current_time;
							$payment->lastmodify=$current_time;
							$payment->net_amount=$_SESSION['ct_details']['net_amount'];
							$payment->frequently_discount = $freq_discount;
							$payment->frequently_discount_amount = $_SESSION['freq_dis_amount'];
							$payment->recurrence_status = 'Y';
							$payment->payment_status = 'Pending';
							$add_payment=$payment->add_payments();
							
							$order_client_info->order_id=$orderid;
							$order_client_info->client_name=ucwords($_SESSION['ct_details']['firstname']).' '.ucwords($_SESSION['ct_details']['lastname']);
							$order_client_info->client_email=$_SESSION['ct_details']['email'];
							$order_client_info->client_phone=$_SESSION['ct_details']['phone'];
							$client_phone = $_SESSION['ct_details']['phone'];
							$order_client_info->client_personal_info=base64_encode(serialize(array('zip'=>$zipcode,'address'=>$address,'city'=>$city,'state'=>$state,'notes'=>$notes,'vc_status'=>$vc_status,'p_status'=>$p_status,'contact_status'=>$contact_status)));
							$add_guest_user=$order_client_info->add_order_client();
							$date = strtotime("+$j days", $dates);
							$recurr_booking_date_time =  date('Y-m-d H:i:s', $date);
							$orderid++;
						} else {
							$start_date = $booking_date_time;  
							$dates = strtotime($start_date);
				
							for($i=0;$i<(count($_SESSION['ct_cart']['method']));$i++){
								if($key == ''){
									/* insert into bookings table */
									$booking->order_id=$orderid;
									$booking->client_id=$add_user;
									$booking->order_date=$current_time;
									$booking->booking_date_time=$recurr_booking_date_time;
									$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
									$booking->method_id='';
									$booking->method_unit_id='';
									$booking->method_unit_qty='';
									$booking->method_unit_qty_rate='';
									if($appointment_auto_confirm=="Y"){
										$booking->booking_status='C';
									}else{
										$booking->booking_status='A';
									}
									$booking->lastmodify=$current_time;
									$booking->read_status='U';
									$booking->staff_id= $staff_id;
									$add_booking=$booking->add_booking();
									/* insert into addons bookings table */
									$booking->order_id=$orderid;
									$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
									$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
									$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
									$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
									$add_booking=$booking->add_addons_booking();
								}else{
									if($_SESSION['ct_cart']['method'][$i]['type'] == 'method_units'){
										$booking->order_id=$orderid;
										$booking->client_id=$add_user;
										$booking->order_date=$current_time;
										$booking->booking_date_time=$recurr_booking_date_time;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->method_id=$_SESSION['ct_cart']['method'][$i]['method_id'];
										$booking->method_unit_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->method_unit_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->method_unit_qty_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										if($appointment_auto_confirm=="Y"){
											$booking->booking_status='C';
										}else{
											$booking->booking_status='A';
										}
										$booking->lastmodify=$current_time;
										$booking->read_status='U';
										$booking->staff_id= $staff_id;
										$add_booking=$booking->add_booking();
									}else if($_SESSION['ct_cart']['method'][$i]['type'] == 'addon'){
										$booking->order_id=$orderid;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										$add_booking=$booking->add_addons_booking();
									}
								}
							}
							
							$payment->order_id =$orderid;
							$payment->payment_method=ucwords('pay at venue');
							$payment->transaction_id= '';
							$payment->amount=$_SESSION['ct_details']['amount'];
							$payment->discount=$_SESSION['ct_details']['coupon_discount'];
							$payment->taxes=$_SESSION['ct_details']['taxes'];
							$payment->partial_amount=$_SESSION['ct_details']['partial_amount'];
							$payment->payment_date=$current_time;
							$payment->lastmodify=$current_time;
							$payment->net_amount=$_SESSION['ct_details']['net_amount'];
							$payment->frequently_discount = $freq_discount;
							$payment->frequently_discount_amount = $_SESSION['freq_dis_amount'];
							$payment->recurrence_status = 'Y';
							$payment->payment_status = 'Pending';
							$add_payment=$payment->add_payments();
						} 
						
						$order_client_info->order_id=$orderid;
						$order_client_info->client_name=ucwords($_SESSION['ct_details']['firstname']).' '.ucwords($_SESSION['ct_details']['lastname']);
						$order_client_info->client_email=$_SESSION['ct_details']['email'];
						$order_client_info->client_phone=$_SESSION['ct_details']['phone'];
						$client_phone = $_SESSION['ct_details']['phone'];
						$order_client_info->client_personal_info=base64_encode(serialize(array('zip'=>$zipcode,'address'=>$address,'city'=>$city,'state'=>$state,'notes'=>$notes,'vc_status'=>$vc_status,'p_status'=>$p_status,'contact_status'=>$contact_status)));
						$add_guest_user=$order_client_info->add_order_client();
						$date = strtotime("+$j days", $dates);
						$recurr_booking_date_time =  date('Y-m-d H:i:s', $date);
						$orderid++;
					}
				}

			}
			else if($recurrence_booking_type == 'weekly'){
				$cust_now = strtotime($booking_date_time);
				$cust_your_date = strtotime($recurrence_end_date.' 23:59');
				$cust_datediff = $cust_your_date - $cust_now;
				$total_days = abs(floor($cust_datediff / (60 * 60 * 24)))+1;
				$total_weeks = ceil($total_days / 7);
			
				$recurr_booking_date_time = $booking_date_time;
				for($j=1;$j<=$total_weeks;$j++) {
					if(strtotime($recurr_booking_date_time) <= strtotime($recurrence_end_date.' 23:59')){
						if($j == '1') {
							$recurr_booking_date_time = $booking_date_time;
							$start_date = $booking_date_time;  
							$dates = strtotime($start_date);
							for($i=0;$i<(count($_SESSION['ct_cart']['method']));$i++){
								if($key == ''){
									/* insert into bookings table */
									$booking->order_id=$orderid;
									$booking->client_id=$add_user;
									$booking->order_date=$current_time;
									$booking->booking_date_time=$recurr_booking_date_time;
									$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
									$booking->method_id='';
									$booking->method_unit_id='';
									$booking->method_unit_qty='';
									$booking->method_unit_qty_rate='';
									if($appointment_auto_confirm=="Y"){
										$booking->booking_status='C';
									}else{
										$booking->booking_status='A';
									}
									$booking->lastmodify=$current_time;
									$booking->read_status='U';
									$booking->staff_id= $staff_id;
									$add_booking=$booking->add_booking();
									/* insert into addons bookings table */
									$booking->order_id=$orderid;
									$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
									$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
									$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
									$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
									$add_booking=$booking->add_addons_booking();
								} else {
									if($_SESSION['ct_cart']['method'][$i]['type'] == 'method_units'){
										$booking->order_id=$orderid;
										$booking->client_id=$add_user;
										$booking->order_date=$current_time;
										$booking->booking_date_time=$recurr_booking_date_time;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->method_id=$_SESSION['ct_cart']['method'][$i]['method_id'];
										$booking->method_unit_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->method_unit_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->method_unit_qty_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										if($appointment_auto_confirm=="Y"){
											$booking->booking_status='C';
										}else{
											$booking->booking_status='A';
										}
										$booking->lastmodify=$current_time;
										$booking->read_status='U';
										$booking->staff_id= $staff_id;
										$add_booking=$booking->add_booking();
									} else if($_SESSION['ct_cart']['method'][$i]['type'] == 'addon'){
										$booking->order_id=$orderid;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										$add_booking=$booking->add_addons_booking();
									}
								}
							}
						
							$payment->order_id =$orderid;
							$payment->payment_method=ucwords('pay at venue');
							$payment->transaction_id= '';
							$payment->amount=$_SESSION['ct_details']['amount'];
							$payment->discount=$_SESSION['ct_details']['coupon_discount'];
							$payment->taxes=$_SESSION['ct_details']['taxes'];
							$payment->partial_amount=$_SESSION['ct_details']['partial_amount'];
							$payment->payment_date=$current_time;
							$payment->lastmodify=$current_time;
							$payment->net_amount=$_SESSION['ct_details']['net_amount'];
							$payment->frequently_discount = $freq_discount;
							$payment->frequently_discount_amount = $_SESSION['freq_dis_amount'];
							$payment->recurrence_status = 'Y';
							$payment->payment_status = 'Pending';
							$add_payment=$payment->add_payments();
							
							$order_client_info->order_id=$orderid;
							$order_client_info->client_name=ucwords($_SESSION['ct_details']['firstname']).' '.ucwords($_SESSION['ct_details']['lastname']);
							$order_client_info->client_email=$_SESSION['ct_details']['email'];
							$order_client_info->client_phone=$_SESSION['ct_details']['phone'];
							$client_phone = $_SESSION['ct_details']['phone'];
							$order_client_info->client_personal_info=base64_encode(serialize(array('zip'=>$zipcode,'address'=>$address,'city'=>$city,'state'=>$state,'notes'=>$notes,'vc_status'=>$vc_status,'p_status'=>$p_status,'contact_status'=>$contact_status)));
							$add_guest_user=$order_client_info->add_order_client();
							$date = strtotime("+$j week", $dates);
							$recurr_booking_date_time =  date('Y-m-d H:i:s', $date);
							$orderid++;
						} else {
							$start_date = $booking_date_time;  
							$dates = strtotime($start_date);
							for($i=0;$i<(count($_SESSION['ct_cart']['method']));$i++){
								if($key == ''){
									/* insert into bookings table */
									$booking->order_id=$orderid;
									$booking->client_id=$add_user;
									$booking->order_date=$current_time;
									$booking->booking_date_time=$recurr_booking_date_time;
									$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
									$booking->method_id='';
									$booking->method_unit_id='';
									$booking->method_unit_qty='';
									$booking->method_unit_qty_rate='';
									if($appointment_auto_confirm=="Y"){
										$booking->booking_status='C';
									}else{
										$booking->booking_status='A';
									}
									$booking->lastmodify=$current_time;
									$booking->read_status='U';
									$booking->staff_id= $staff_id;
									$add_booking=$booking->add_booking();
									/* insert into addons bookings table */
									$booking->order_id=$orderid;
									$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
									$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
									$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
									$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
									$add_booking=$booking->add_addons_booking();
								} else {
									if($_SESSION['ct_cart']['method'][$i]['type'] == 'method_units'){
										$booking->order_id=$orderid;
										$booking->client_id=$add_user;
										$booking->order_date=$current_time;
										$booking->booking_date_time=$recurr_booking_date_time;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->method_id=$_SESSION['ct_cart']['method'][$i]['method_id'];
										$booking->method_unit_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->method_unit_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->method_unit_qty_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										if($appointment_auto_confirm=="Y"){
											$booking->booking_status='C';
										}else{
											$booking->booking_status='A';
										}
										$booking->lastmodify=$current_time;
										$booking->read_status='U';
										$booking->staff_id= $staff_id;
										$add_booking=$booking->add_booking();
									} else if($_SESSION['ct_cart']['method'][$i]['type'] == 'addon'){
										$booking->order_id=$orderid;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										$add_booking=$booking->add_addons_booking();
									}
								}
							}
							
							$payment->order_id =$orderid;
							$payment->payment_method=ucwords('pay at venue');
							$payment->transaction_id= '';
							$payment->amount=$_SESSION['ct_details']['amount'];
							$payment->discount=$_SESSION['ct_details']['coupon_discount'];
							$payment->taxes=$_SESSION['ct_details']['taxes'];
							$payment->partial_amount=$_SESSION['ct_details']['partial_amount'];
							$payment->payment_date=$current_time;
							$payment->lastmodify=$current_time;
							$payment->net_amount=$_SESSION['ct_details']['net_amount'];
							$payment->frequently_discount = $freq_discount;
							$payment->frequently_discount_amount = $_SESSION['freq_dis_amount'];
							$payment->recurrence_status = 'Y';
							$payment->payment_status = 'Pending';
							$add_payment=$payment->add_payments();
						} 
				
						$order_client_info->order_id=$orderid;
						$order_client_info->client_name=ucwords($_SESSION['ct_details']['firstname']).' '.ucwords($_SESSION['ct_details']['lastname']);
						$order_client_info->client_email=$_SESSION['ct_details']['email'];
						$order_client_info->client_phone=$_SESSION['ct_details']['phone'];
						$client_phone = $_SESSION['ct_details']['phone'];
						$order_client_info->client_personal_info=base64_encode(serialize(array('zip'=>$zipcode,'address'=>$address,'city'=>$city,'state'=>$state,'notes'=>$notes,'vc_status'=>$vc_status,'p_status'=>$p_status,'contact_status'=>$contact_status)));
						$add_guest_user=$order_client_info->add_order_client();
						$date = strtotime("+$j week", $dates);
						$recurr_booking_date_time =  date('Y-m-d H:i:s', $date);
						$orderid++;
					}
				}
			}
			else if($recurrence_booking_type == 'monthly'){
				$ts1 = strtotime($booking_date_time);
				$ts2 = strtotime($recurrence_end_date.' 23:59');
				$year1 = date('Y', $ts1);
				$year2 = date('Y', $ts2);
				$month1 = date('m', $ts1);
				$month2 = date('m', $ts2);
				$total_months = (($year2 - $year1) * 12) + ($month2 - $month1)+1;
			
				$recurr_booking_date_time = $booking_date_time;
				for($j=1;$j<=$total_months;$j++) {
					if(strtotime($recurr_booking_date_time) <= strtotime($recurrence_end_date.' 23:59')){
						if($j == '1') {
							$recurr_booking_date_time = $booking_date_time;
							$start_date = $booking_date_time;  
							$dates = strtotime($start_date);
							for($i=0;$i<(count($_SESSION['ct_cart']['method']));$i++){
								if($key == ''){
									/* insert into bookings table */
									$booking->order_id=$orderid;
									$booking->client_id=$add_user;
									$booking->order_date=$current_time;
									$booking->booking_date_time=$recurr_booking_date_time;
									$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
									$booking->method_id='';
									$booking->method_unit_id='';
									$booking->method_unit_qty='';
									$booking->method_unit_qty_rate='';
									if($appointment_auto_confirm=="Y"){
										$booking->booking_status='C';
									}else{
										$booking->booking_status='A';
									}
									$booking->lastmodify=$current_time;
									$booking->read_status='U';
									$booking->staff_id= $staff_id;
									$add_booking=$booking->add_booking();
									/* insert into addons bookings table */
									$booking->order_id=$orderid;
									$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
									$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
									$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
									$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
									$add_booking=$booking->add_addons_booking();
								} else {
									if($_SESSION['ct_cart']['method'][$i]['type'] == 'method_units'){
										$booking->order_id=$orderid;
										$booking->client_id=$add_user;
										$booking->order_date=$current_time;
										$booking->booking_date_time=$recurr_booking_date_time;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->method_id=$_SESSION['ct_cart']['method'][$i]['method_id'];
										$booking->method_unit_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->method_unit_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->method_unit_qty_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										if($appointment_auto_confirm=="Y"){
											$booking->booking_status='C';
										}else{
											$booking->booking_status='A';
										}
										$booking->lastmodify=$current_time;
										$booking->read_status='U';
										$booking->staff_id= $staff_id;
										$add_booking=$booking->add_booking();
									} else if($_SESSION['ct_cart']['method'][$i]['type'] == 'addon'){
										$booking->order_id=$orderid;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										$add_booking=$booking->add_addons_booking();
									}
								}
							}

							$payment->order_id =$orderid;
							$payment->payment_method=ucwords('pay at venue');
							$payment->transaction_id= '';
							$payment->amount=$_SESSION['ct_details']['amount'];
							$payment->discount=$_SESSION['ct_details']['coupon_discount'];
							$payment->taxes=$_SESSION['ct_details']['taxes'];
							$payment->partial_amount=$_SESSION['ct_details']['partial_amount'];
							$payment->payment_date=$current_time;
							$payment->lastmodify=$current_time;
							$payment->net_amount=$_SESSION['ct_details']['net_amount'];
							$payment->frequently_discount = $freq_discount;
							$payment->frequently_discount_amount = $_SESSION['freq_dis_amount'];
							$payment->recurrence_status = 'Y';
							$payment->payment_status = 'Pending';
							$add_payment=$payment->add_payments();
						
							$order_client_info->order_id=$orderid;
							$order_client_info->client_name=ucwords($_SESSION['ct_details']['firstname']).' '.ucwords($_SESSION['ct_details']['lastname']);
							$order_client_info->client_email=$_SESSION['ct_details']['email'];
							$order_client_info->client_phone=$_SESSION['ct_details']['phone'];
							$client_phone = $_SESSION['ct_details']['phone'];
							$order_client_info->client_personal_info=base64_encode(serialize(array('zip'=>$zipcode,'address'=>$address,'city'=>$city,'state'=>$state,'notes'=>$notes,'vc_status'=>$vc_status,'p_status'=>$p_status,'contact_status'=>$contact_status)));
							$add_guest_user=$order_client_info->add_order_client();
							$date = strtotime("+$j month", $dates);
							$recurr_booking_date_time =  date('Y-m-d H:i:s', $date);
							$orderid++;
						} else {
							$start_date = $booking_date_time;  
							$dates = strtotime($start_date);
							for($i=0;$i<(count($_SESSION['ct_cart']['method']));$i++){
								if($key == ''){
								/* insert into bookings table */
									$booking->order_id=$orderid;
									$booking->client_id=$add_user;
									$booking->order_date=$current_time;
									$booking->booking_date_time=$recurr_booking_date_time;
									$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
									$booking->method_id='';
									$booking->method_unit_id='';
									$booking->method_unit_qty='';
									$booking->method_unit_qty_rate='';
									if($appointment_auto_confirm=="Y"){
										$booking->booking_status='C';
									}else{
										$booking->booking_status='A';
									}
									$booking->lastmodify=$current_time;
									$booking->read_status='U';
									$booking->staff_id= $staff_id;
									$add_booking=$booking->add_booking();
									/* insert into addons bookings table */
									$booking->order_id=$orderid;
									$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
									$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
									$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
									$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
									$add_booking=$booking->add_addons_booking();
								} else {
									if($_SESSION['ct_cart']['method'][$i]['type'] == 'method_units'){
										$booking->order_id=$orderid;
										$booking->client_id=$add_user;
										$booking->order_date=$current_time;
										$booking->booking_date_time=$recurr_booking_date_time;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->method_id=$_SESSION['ct_cart']['method'][$i]['method_id'];
										$booking->method_unit_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->method_unit_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->method_unit_qty_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										if($appointment_auto_confirm=="Y"){
											$booking->booking_status='C';
										}else{
											$booking->booking_status='A';
										}
										$booking->lastmodify=$current_time;
										$booking->read_status='U';
										$booking->staff_id= $staff_id;
										$add_booking=$booking->add_booking();
									} else if($_SESSION['ct_cart']['method'][$i]['type'] == 'addon'){
										$booking->order_id=$orderid;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										$add_booking=$booking->add_addons_booking();
									}
								}
							}
			
							$payment->order_id =$orderid;
							$payment->payment_method=ucwords('pay at venue');
							$payment->transaction_id= '';
							$payment->amount=$_SESSION['ct_details']['amount'];
							$payment->discount=$_SESSION['ct_details']['coupon_discount'];
							$payment->taxes=$_SESSION['ct_details']['taxes'];
							$payment->partial_amount=$_SESSION['ct_details']['partial_amount'];
							$payment->payment_date=$current_time;
							$payment->lastmodify=$current_time;
							$payment->net_amount=$_SESSION['ct_details']['net_amount'];
							$payment->frequently_discount = $freq_discount;
							$payment->frequently_discount_amount = $_SESSION['freq_dis_amount'];
							$payment->recurrence_status = 'Y';
							$payment->payment_status = 'Pending';
							$add_payment=$payment->add_payments();
						} 

						$order_client_info->order_id=$orderid;
						$order_client_info->client_name=ucwords($_SESSION['ct_details']['firstname']).' '.ucwords($_SESSION['ct_details']['lastname']);
						$order_client_info->client_email=$_SESSION['ct_details']['email'];
						$order_client_info->client_phone=$_SESSION['ct_details']['phone'];
						$client_phone = $_SESSION['ct_details']['phone'];
						$order_client_info->client_personal_info=base64_encode(serialize(array('zip'=>$zipcode,'address'=>$address,'city'=>$city,'state'=>$state,'notes'=>$notes,'vc_status'=>$vc_status,'p_status'=>$p_status,'contact_status'=>$contact_status)));
						$add_guest_user=$order_client_info->add_order_client();
						$date = strtotime("+$j month", $dates);
						$recurr_booking_date_time =  date('Y-m-d H:i:s', $date);
						$orderid++;
					}
				}
			}
			else if($recurrence_booking_type == 'biweekly'){
				$cust_now = strtotime($booking_date_time);
				$cust_your_date = strtotime($recurrence_end_date.' 23:59');
				$cust_datediff = $cust_your_date - $cust_now;
				$total_days = abs(floor($cust_datediff / (60 * 60 * 24)))+1;
				
				$recurr_booking_date_time = $booking_date_time;
				for($j=1;$j<=$total_days;$j++) {
					if(strtotime($recurr_booking_date_time) <= strtotime($recurrence_end_date.' 23:59')){
						if($j == '1') {
							$recurr_booking_date_time = $booking_date_time;
							$start_date = $booking_date_time;  
							$dates = strtotime($start_date);
							for($i=0;$i<(count($_SESSION['ct_cart']['method']));$i++){
								if($key == ''){
									/* insert into bookings table */
									$booking->order_id=$orderid;
									$booking->client_id=$add_user;
									$booking->order_date=$current_time;
									$booking->booking_date_time=$recurr_booking_date_time;
									$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
									$booking->method_id='';
									$booking->method_unit_id='';
									$booking->method_unit_qty='';
									$booking->method_unit_qty_rate='';
									if($appointment_auto_confirm=="Y"){
										$booking->booking_status='C';
									}else{
										$booking->booking_status='A';
									}
									$booking->lastmodify=$current_time;
									$booking->read_status='U';
									$booking->staff_id= $staff_id;
									$add_booking=$booking->add_booking();
									/* insert into addons bookings table */
									$booking->order_id=$orderid;
									$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
									$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
									$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
									$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
									$add_booking=$booking->add_addons_booking();
								} else {
									if($_SESSION['ct_cart']['method'][$i]['type'] == 'method_units'){
										$booking->order_id=$orderid;
										$booking->client_id=$add_user;
										$booking->order_date=$current_time;
										$booking->booking_date_time=$recurr_booking_date_time;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->method_id=$_SESSION['ct_cart']['method'][$i]['method_id'];
										$booking->method_unit_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->method_unit_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->method_unit_qty_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										if($appointment_auto_confirm=="Y"){
											$booking->booking_status='C';
										}else{
											$booking->booking_status='A';
										}
										$booking->lastmodify=$current_time;
										$booking->read_status='U';
										$booking->staff_id= $staff_id;
										$add_booking=$booking->add_booking();
									} else if($_SESSION['ct_cart']['method'][$i]['type'] == 'addon'){
										$booking->order_id=$orderid;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										$add_booking=$booking->add_addons_booking();
									}
								}
							}
	
							$payment->order_id =$orderid;
							$payment->payment_method=ucwords('pay at venue');
							$payment->transaction_id= '';
							$payment->amount=$_SESSION['ct_details']['amount'];
							$payment->discount=$_SESSION['ct_details']['coupon_discount'];
							$payment->taxes=$_SESSION['ct_details']['taxes'];
							$payment->partial_amount=$_SESSION['ct_details']['partial_amount'];
							$payment->payment_date=$current_time;
							$payment->lastmodify=$current_time;
							$payment->net_amount=$_SESSION['ct_details']['net_amount'];
							$payment->frequently_discount = $freq_discount;
							$payment->frequently_discount_amount = $_SESSION['freq_dis_amount'];
							$payment->recurrence_status = 'Y';
							$payment->payment_status = 'Pending';
							$add_payment=$payment->add_payments();
				
							$order_client_info->order_id=$orderid;
							$order_client_info->client_name=ucwords($_SESSION['ct_details']['firstname']).' '.ucwords($_SESSION['ct_details']['lastname']);
							$order_client_info->client_email=$_SESSION['ct_details']['email'];
							$order_client_info->client_phone=$_SESSION['ct_details']['phone'];
							$client_phone = $_SESSION['ct_details']['phone'];
							$order_client_info->client_personal_info=base64_encode(serialize(array('zip'=>$zipcode,'address'=>$address,'city'=>$city,'state'=>$state,'notes'=>$notes,'vc_status'=>$vc_status,'p_status'=>$p_status,'contact_status'=>$contact_status)));
							$add_guest_user=$order_client_info->add_order_client();
						} else {
							$start_date = $booking_date_time;  
							$dates = strtotime($start_date);
							for($i=0;$i<(count($_SESSION['ct_cart']['method']));$i++){
								if($key == ''){
									/* insert into bookings table */
									$booking->order_id=$orderid;
									$booking->client_id=$add_user;
									$booking->order_date=$current_time;
									$booking->booking_date_time=$recurr_booking_date_time;
									$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
									$booking->method_id='';
									$booking->method_unit_id='';
									$booking->method_unit_qty='';
									$booking->method_unit_qty_rate='';
									if($appointment_auto_confirm=="Y"){
										$booking->booking_status='C';
									}else{
										$booking->booking_status='A';
									}
									$booking->lastmodify=$current_time;
									$booking->read_status='U';
									$booking->staff_id= $staff_id;
									$add_booking=$booking->add_booking();
									/* insert into addons bookings table */
									$booking->order_id=$orderid;
									$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
									$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
									$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
									$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
									$add_booking=$booking->add_addons_booking();
								} else {
									if($_SESSION['ct_cart']['method'][$i]['type'] == 'method_units'){
										$booking->order_id=$orderid;
										$booking->client_id=$add_user;
										$booking->order_date=$current_time;
										$booking->booking_date_time=$recurr_booking_date_time;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->method_id=$_SESSION['ct_cart']['method'][$i]['method_id'];
										$booking->method_unit_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->method_unit_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->method_unit_qty_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										if($appointment_auto_confirm=="Y"){
											$booking->booking_status='C';
										}else{
											$booking->booking_status='A';
										}
										$booking->lastmodify=$current_time;
										$booking->read_status='U';
										$booking->staff_id= $staff_id;
										$add_booking=$booking->add_booking();
									} else if($_SESSION['ct_cart']['method'][$i]['type'] == 'addon'){
										$booking->order_id=$orderid;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										$add_booking=$booking->add_addons_booking();
									}
								}
							}
		
							$payment->order_id =$orderid;
							$payment->payment_method=ucwords('pay at venue');
							$payment->transaction_id= '';
							$payment->amount=$_SESSION['ct_details']['amount'];
							$payment->discount=$_SESSION['ct_details']['coupon_discount'];
							$payment->taxes=$_SESSION['ct_details']['taxes'];
							$payment->partial_amount=$_SESSION['ct_details']['partial_amount'];
							$payment->payment_date=$current_time;
							$payment->lastmodify=$current_time;
							$payment->net_amount=$_SESSION['ct_details']['net_amount'];
							$payment->frequently_discount = $freq_discount;
							$payment->frequently_discount_amount = $_SESSION['freq_dis_amount'];
							$payment->recurrence_status = 'Y';
							$payment->payment_status = 'Pending';
							$add_payment=$payment->add_payments();
						} 
						
						$order_client_info->order_id=$orderid;
						$order_client_info->client_name=ucwords($_SESSION['ct_details']['firstname']).' '.ucwords($_SESSION['ct_details']['lastname']);
						$order_client_info->client_email=$_SESSION['ct_details']['email'];
						$order_client_info->client_phone=$_SESSION['ct_details']['phone'];
						$client_phone = $_SESSION['ct_details']['phone'];
						$order_client_info->client_personal_info=base64_encode(serialize(array('zip'=>$zipcode,'address'=>$address,'city'=>$city,'state'=>$state,'notes'=>$notes,'vc_status'=>$vc_status,'p_status'=>$p_status,'contact_status'=>$contact_status)));
						$add_guest_user=$order_client_info->add_order_client();
						$j+=2;
						$date = strtotime("$j days", $dates);
						$recurr_booking_date_time =  date('Y-m-d H:i:s', $date);
						$orderid++;
					}
				}
			}
			else if($recurrence_booking_type == 'bimonthly'){
				$cust_now = strtotime($booking_date_time);
				$cust_your_date = strtotime($recurrence_end_date.' 23:59');
				$cust_datediff = $cust_your_date - $cust_now;
				$total_days = abs(floor($cust_datediff / (60 * 60 * 24)))+1;
				
				$recurr_booking_date_time = $booking_date_time;
				for($j=1;$j<=$total_days;$j++) {
					if(strtotime($recurr_booking_date_time) <= strtotime($recurrence_end_date.' 23:59')){
						if($j == '1') {
							$recurr_booking_date_time = $booking_date_time;
							$start_date = $booking_date_time;  
							$dates = strtotime($start_date);
							for($i=0;$i<(count($_SESSION['ct_cart']['method']));$i++){
								if($key == ''){
									/* insert into bookings table */
									$booking->order_id=$orderid;
									$booking->client_id=$add_user;
									$booking->order_date=$current_time;
									$booking->booking_date_time=$recurr_booking_date_time;
									$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
									$booking->method_id='';
									$booking->method_unit_id='';
									$booking->method_unit_qty='';
									$booking->method_unit_qty_rate='';
									if($appointment_auto_confirm=="Y"){
										$booking->booking_status='C';
									}else{
										$booking->booking_status='A';
									}
									$booking->lastmodify=$current_time;
									$booking->read_status='U';
									$booking->staff_id= $staff_id;
									$add_booking=$booking->add_booking();
									/* insert into addons bookings table */
									$booking->order_id=$orderid;
									$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
									$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
									$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
									$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
									$add_booking=$booking->add_addons_booking();
								} else {
									if($_SESSION['ct_cart']['method'][$i]['type'] == 'method_units'){
										$booking->order_id=$orderid;
										$booking->client_id=$add_user;
										$booking->order_date=$current_time;
										$booking->booking_date_time=$recurr_booking_date_time;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->method_id=$_SESSION['ct_cart']['method'][$i]['method_id'];
										$booking->method_unit_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->method_unit_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->method_unit_qty_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										if($appointment_auto_confirm=="Y"){
											$booking->booking_status='C';
										}else{
											$booking->booking_status='A';
										}
										$booking->lastmodify=$current_time;
										$booking->read_status='U';
										$booking->staff_id= $staff_id;
										$add_booking=$booking->add_booking();
									} else if($_SESSION['ct_cart']['method'][$i]['type'] == 'addon'){
										$booking->order_id=$orderid;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										$add_booking=$booking->add_addons_booking();
									}
								}
							}
							
							$payment->order_id =$orderid;
							$payment->payment_method=ucwords('pay at venue');
							$payment->transaction_id= '';
							$payment->amount=$_SESSION['ct_details']['amount'];
							$payment->discount=$_SESSION['ct_details']['coupon_discount'];
							$payment->taxes=$_SESSION['ct_details']['taxes'];
							$payment->partial_amount=$_SESSION['ct_details']['partial_amount'];
							$payment->payment_date=$current_time;
							$payment->lastmodify=$current_time;
							$payment->net_amount=$_SESSION['ct_details']['net_amount'];
							$payment->frequently_discount = $freq_discount;
							$payment->frequently_discount_amount = $_SESSION['freq_dis_amount'];
							$payment->recurrence_status = 'Y';
							$payment->payment_status = 'Pending';
							$add_payment=$payment->add_payments();
							
							$order_client_info->order_id=$orderid;
							$order_client_info->client_name=ucwords($_SESSION['ct_details']['firstname']).' '.ucwords($_SESSION['ct_details']['lastname']);
							$order_client_info->client_email=$_SESSION['ct_details']['email'];
							$order_client_info->client_phone=$_SESSION['ct_details']['phone'];
							$client_phone = $_SESSION['ct_details']['phone'];
							$order_client_info->client_personal_info=base64_encode(serialize(array('zip'=>$zipcode,'address'=>$address,'city'=>$city,'state'=>$state,'notes'=>$notes,'vc_status'=>$vc_status,'p_status'=>$p_status,'contact_status'=>$contact_status)));
							$add_guest_user=$order_client_info->add_order_client();
						} else {
							$start_date = $booking_date_time;  
							$dates = strtotime($start_date);
							for($i=0;$i<(count($_SESSION['ct_cart']['method']));$i++){
								if($key == ''){
									/* insert into bookings table */
									$booking->order_id=$orderid;
									$booking->client_id=$add_user;
									$booking->order_date=$current_time;
									$booking->booking_date_time=$recurr_booking_date_time;
									$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
									$booking->method_id='';
									$booking->method_unit_id='';
									$booking->method_unit_qty='';
									$booking->method_unit_qty_rate='';
									if($appointment_auto_confirm=="Y"){
										$booking->booking_status='C';
									}else{
										$booking->booking_status='A';
									}
									$booking->lastmodify=$current_time;
									$booking->read_status='U';
									$booking->staff_id= $staff_id;
									$add_booking=$booking->add_booking();
									/* insert into addons bookings table */
									$booking->order_id=$orderid;
									$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
									$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
									$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
									$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
									$add_booking=$booking->add_addons_booking();
								} else {
									if($_SESSION['ct_cart']['method'][$i]['type'] == 'method_units'){
										$booking->order_id=$orderid;
										$booking->client_id=$add_user;
										$booking->order_date=$current_time;
										$booking->booking_date_time=$recurr_booking_date_time;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->method_id=$_SESSION['ct_cart']['method'][$i]['method_id'];
										$booking->method_unit_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->method_unit_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->method_unit_qty_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										if($appointment_auto_confirm=="Y"){
											$booking->booking_status='C';
										}else{
											$booking->booking_status='A';
										}
										$booking->lastmodify=$current_time;
										$booking->read_status='U';
										$booking->staff_id= $staff_id;
										$add_booking=$booking->add_booking();
									} else if($_SESSION['ct_cart']['method'][$i]['type'] == 'addon'){
										$booking->order_id=$orderid;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										$add_booking=$booking->add_addons_booking();
									}
								}
							}
		
							$payment->order_id =$orderid;
							$payment->payment_method=ucwords('pay at venue');
							$payment->transaction_id= '';
							$payment->amount=$_SESSION['ct_details']['amount'];
							$payment->discount=$_SESSION['ct_details']['coupon_discount'];
							$payment->taxes=$_SESSION['ct_details']['taxes'];
							$payment->partial_amount=$_SESSION['ct_details']['partial_amount'];
							$payment->payment_date=$current_time;
							$payment->lastmodify=$current_time;
							$payment->net_amount=$_SESSION['ct_details']['net_amount'];
							$payment->frequently_discount = $freq_discount;
							$payment->frequently_discount_amount = $_SESSION['freq_dis_amount'];
							$payment->recurrence_status = 'Y';
							$payment->payment_status = 'Pending';
							$add_payment=$payment->add_payments();
						}
						
						$order_client_info->order_id=$orderid;
						$order_client_info->client_name=ucwords($_SESSION['ct_details']['firstname']).' '.ucwords($_SESSION['ct_details']['lastname']);
						$order_client_info->client_email=$_SESSION['ct_details']['email'];
						$order_client_info->client_phone=$_SESSION['ct_details']['phone'];
						$client_phone = $_SESSION['ct_details']['phone'];
						$order_client_info->client_personal_info=base64_encode(serialize(array('zip'=>$zipcode,'address'=>$address,'city'=>$city,'state'=>$state,'notes'=>$notes,'vc_status'=>$vc_status,'p_status'=>$p_status,'contact_status'=>$contact_status)));
						$add_guest_user=$order_client_info->add_order_client();
						$j+=15;
						$date = strtotime("$j days", $dates);
						$recurr_booking_date_time =  date('Y-m-d H:i:s', $date);
						$orderid++;
					}
				}
			}
			else if($recurrence_booking_type == 'fortnightly'){
				$cust_now = strtotime($booking_date_time);
				$cust_your_date = strtotime($recurrence_end_date.' 23:59');
				$cust_datediff = $cust_your_date - $cust_now;
				$total_days = abs(floor($cust_datediff / (60 * 60 * 24)))+1;
				$total_weeks = ceil($total_days / 7);
				
				$recurr_booking_date_time = $booking_date_time;
				
				for($j=1;$j<=$total_weeks;$j++) {
					if(strtotime($recurr_booking_date_time) <= strtotime($recurrence_end_date.' 23:59')){
						if($j == '1') {
							$recurr_booking_date_time = $booking_date_time;
							$start_date = $booking_date_time;  
							$dates = strtotime($start_date);
							for($i=0;$i<(count($_SESSION['ct_cart']['method']));$i++){
								if($key == ''){
									/* insert into bookings table */
									$booking->order_id=$orderid;
									$booking->client_id=$add_user;
									$booking->order_date=$current_time;
									$booking->booking_date_time=$recurr_booking_date_time;
									$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
									$booking->method_id='';
									$booking->method_unit_id='';
									$booking->method_unit_qty='';
									$booking->method_unit_qty_rate='';
									if($appointment_auto_confirm=="Y"){
										$booking->booking_status='C';
									}else{
										$booking->booking_status='A';
									}
									$booking->lastmodify=$current_time;
									$booking->read_status='U';
									$booking->staff_id= $staff_id;
									$add_booking=$booking->add_booking();
									/* insert into addons bookings table */
									$booking->order_id=$orderid;
									$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
									$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
									$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
									$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
									$add_booking=$booking->add_addons_booking();
								} else {
									if($_SESSION['ct_cart']['method'][$i]['type'] == 'method_units'){
										$booking->order_id=$orderid;
										$booking->client_id=$add_user;
										$booking->order_date=$current_time;
										$booking->booking_date_time=$recurr_booking_date_time;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->method_id=$_SESSION['ct_cart']['method'][$i]['method_id'];
										$booking->method_unit_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->method_unit_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->method_unit_qty_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										if($appointment_auto_confirm=="Y"){
											$booking->booking_status='C';
										}else{
											$booking->booking_status='A';
										}
										$booking->lastmodify=$current_time;
										$booking->read_status='U';
										$booking->staff_id= $staff_id;
										$add_booking=$booking->add_booking();
									} else if($_SESSION['ct_cart']['method'][$i]['type'] == 'addon'){
										$booking->order_id=$orderid;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										$add_booking=$booking->add_addons_booking();
									}
								}
							}

							$payment->order_id =$orderid;
							$payment->payment_method=ucwords('pay at venue');
							$payment->transaction_id= '';
							$payment->amount=$_SESSION['ct_details']['amount'];
							$payment->discount=$_SESSION['ct_details']['coupon_discount'];
							$payment->taxes=$_SESSION['ct_details']['taxes'];
							$payment->partial_amount=$_SESSION['ct_details']['partial_amount'];
							$payment->payment_date=$current_time;
							$payment->lastmodify=$current_time;
							$payment->net_amount=$_SESSION['ct_details']['net_amount'];
							$payment->frequently_discount = $freq_discount;
							$payment->frequently_discount_amount = $_SESSION['freq_dis_amount'];
							$payment->recurrence_status = 'Y';
							$payment->payment_status = 'Pending';
							$add_payment=$payment->add_payments();

							$order_client_info->order_id=$orderid;
							$order_client_info->client_name=ucwords($_SESSION['ct_details']['firstname']).' '.ucwords($_SESSION['ct_details']['lastname']);
							$order_client_info->client_email=$_SESSION['ct_details']['email'];
							$order_client_info->client_phone=$_SESSION['ct_details']['phone'];
							$client_phone = $_SESSION['ct_details']['phone'];
							$order_client_info->client_personal_info=base64_encode(serialize(array('zip'=>$zipcode,'address'=>$address,'city'=>$city,'state'=>$state,'notes'=>$notes,'vc_status'=>$vc_status,'p_status'=>$p_status,'contact_status'=>$contact_status)));
							$add_guest_user=$order_client_info->add_order_client();
						} else {
							$start_date = $booking_date_time;  
							$dates = strtotime($start_date);
							for($i=0;$i<(count($_SESSION['ct_cart']['method']));$i++){
								if($key == ''){
									/* insert into bookings table */
									$booking->order_id=$orderid;
									$booking->client_id=$add_user;
									$booking->order_date=$current_time;
									$booking->booking_date_time=$recurr_booking_date_time;
									$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
									$booking->method_id='';
									$booking->method_unit_id='';
									$booking->method_unit_qty='';
									$booking->method_unit_qty_rate='';
									if($appointment_auto_confirm=="Y"){
										$booking->booking_status='C';
									}else{
										$booking->booking_status='A';
									}
									$booking->lastmodify=$current_time;
									$booking->read_status='U';
									$booking->staff_id= $staff_id;
									$add_booking=$booking->add_booking();
									/* insert into addons bookings table */
									$booking->order_id=$orderid;
									$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
									$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
									$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
									$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
									$add_booking=$booking->add_addons_booking();
								} else {
									if($_SESSION['ct_cart']['method'][$i]['type'] == 'method_units'){
										$booking->order_id=$orderid;
										$booking->client_id=$add_user;
										$booking->order_date=$current_time;
										$booking->booking_date_time=$recurr_booking_date_time;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->method_id=$_SESSION['ct_cart']['method'][$i]['method_id'];
										$booking->method_unit_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->method_unit_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->method_unit_qty_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										if($appointment_auto_confirm=="Y"){
											$booking->booking_status='C';
										}else{
											$booking->booking_status='A';
										}
										$booking->lastmodify=$current_time;
										$booking->read_status='U';
										$booking->staff_id= $staff_id;
										$add_booking=$booking->add_booking();
									} else if($_SESSION['ct_cart']['method'][$i]['type'] == 'addon'){
										$booking->order_id=$orderid;
										$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
										$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
										$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
										$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
										$add_booking=$booking->add_addons_booking();
									}
								}
							}
							
							$payment->order_id =$orderid;
							$payment->payment_method=ucwords('pay at venue');
							$payment->transaction_id= '';
							$payment->amount=$_SESSION['ct_details']['amount'];
							$payment->discount=$_SESSION['ct_details']['coupon_discount'];
							$payment->taxes=$_SESSION['ct_details']['taxes'];
							$payment->partial_amount=$_SESSION['ct_details']['partial_amount'];
							$payment->payment_date=$current_time;
							$payment->lastmodify=$current_time;
							$payment->net_amount=$_SESSION['ct_details']['net_amount'];
							$payment->frequently_discount = $freq_discount;
							$payment->frequently_discount_amount = $_SESSION['freq_dis_amount'];
							$payment->recurrence_status = 'Y';
							$payment->payment_status = 'Pending';
							$add_payment=$payment->add_payments();
						}
						
						$order_client_info->order_id=$orderid;
						$order_client_info->client_name=ucwords($_SESSION['ct_details']['firstname']).' '.ucwords($_SESSION['ct_details']['lastname']);
						$order_client_info->client_email=$_SESSION['ct_details']['email'];
						$order_client_info->client_phone=$_SESSION['ct_details']['phone'];
						$client_phone = $_SESSION['ct_details']['phone'];
						$order_client_info->client_personal_info=base64_encode(serialize(array('zip'=>$zipcode,'address'=>$address,'city'=>$city,'state'=>$state,'notes'=>$notes,'vc_status'=>$vc_status,'p_status'=>$p_status,'contact_status'=>$contact_status)));
						$add_guest_user=$order_client_info->add_order_client();
						
						$j+=1;
						$date = strtotime("$j week", $dates);
						$recurr_booking_date_time =  date('Y-m-d H:i:s', $date);
						$orderid++;
					}
				}
			}
		}
		else {
			for($i=0;$i<(count($_SESSION['ct_cart']['method']));$i++){
				if($key == ''){
					/* insert into bookings table */
					$booking->order_id=$orderid;
					$booking->client_id=$add_user;
					$booking->order_date=$current_time;
					$booking->booking_date_time=$booking_date_time;
					$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
					$booking->method_id='';
					$booking->method_unit_id='';
					$booking->method_unit_qty='';
					$booking->method_unit_qty_rate='';
					if($appointment_auto_confirm=="Y"){
						$booking->booking_status='C';
					}else{
						$booking->booking_status='A';
					}
					$booking->lastmodify=$current_time;
					$booking->read_status='U';
					$booking->staff_id= $staff_id;
					$add_booking=$booking->add_booking();
					/* insert into addon bookings table */
					$booking->order_id=$orderid;
					$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
					$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
					$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
					$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
					$add_booking=$booking->add_addons_booking();
				}else{
					if($_SESSION['ct_cart']['method'][$i]['type'] == 'method_units'){
						$booking->order_id=$orderid;
						$booking->client_id=$add_user;
						$booking->order_date=$current_time;
						$booking->booking_date_time=$booking_date_time;
						$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
						$booking->method_id=$_SESSION['ct_cart']['method'][$i]['method_id'];
						$booking->method_unit_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
						$booking->method_unit_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
						$booking->method_unit_qty_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
						if($appointment_auto_confirm=="Y"){
							$booking->booking_status='C';
						}else{
							$booking->booking_status='A';
						}
						$booking->lastmodify=$current_time;
						$booking->read_status='U';
						$booking->staff_id= $staff_id;
						$add_booking=$booking->add_booking();
					}else if($_SESSION['ct_cart']['method'][$i]['type'] == 'addon'){
						$booking->order_id=$orderid;
						$booking->service_id=$_SESSION['ct_cart']['method'][$i]['service_id'];
						$booking->addons_service_id=$_SESSION['ct_cart']['method'][$i]['units_id'];
						$booking->addons_service_qty=$_SESSION['ct_cart']['method'][$i]['s_m_qty'];
						$booking->addons_service_rate=$_SESSION['ct_cart']['method'][$i]['s_m_rate'];
						$add_booking=$booking->add_addons_booking();
					}
				}
			}
			$payment->order_id =$orderid;
			$payment->payment_method=ucwords('pay at venue');
			if(isset($_POST['transaction_id'])){
				$payment->transaction_id= $_POST['transaction_id'];
			} else {
				$payment->transaction_id='';
			}
			$payment->amount=$_SESSION['ct_details']['amount'];
			$payment->discount=$_SESSION['ct_details']['coupon_discount'];
			$payment->taxes=$_SESSION['ct_details']['taxes'];
			$payment->partial_amount=$_SESSION['ct_details']['partial_amount'];
			$payment->payment_date=$current_time;
			$payment->lastmodify=$current_time;
			$payment->net_amount=$_SESSION['ct_details']['net_amount'];
			$payment->frequently_discount = $freq_discount;
			$payment->frequently_discount_amount = $_SESSION['freq_dis_amount'];
			$payment->recurrence_status = 'N';
			$payment->payment_status = 'Pending';
			$add_payment=$payment->add_payments();
			
			$order_client_info->order_id=$orderid;
			$order_client_info->client_name=ucwords($_SESSION['ct_details']['firstname']).' '.ucwords($_SESSION['ct_details']['lastname']);
			$order_client_info->client_email=$_SESSION['ct_details']['email'];
			$order_client_info->client_phone=$_SESSION['ct_details']['phone'];
			$order_client_info->client_personal_info=base64_encode(serialize(array('zip'=>$zipcode,'address'=>$address,'city'=>$city,'state'=>$state,'notes'=>$notes,'vc_status'=>$vc_status,'p_status'=>$p_status,'contact_status'=>$contact_status)));
			$add_new_user=$order_client_info->add_order_client();
		}
	}

	/* Add Booking in Google Calender */
	
	if($gc_hook->gc_purchase_status() == 'exist'){
		echo $gc_hook->gc_add_booking_ajax_hook();
		echo $gc_hook->gc_add_staff_booking_ajax_hook();
	}
	
	/* End Add Booking in Google Calender */
	
    /*** Email Code Start ***/
    $admin_infoo = $order_client_info->readone_for_email();
    for($i=0;$i<(count($_SESSION['ct_cart']['method']));$i++){
        $service->id = $_SESSION['ct_cart']['method'][$i]['service_id'];
        $service_name = $service->get_service_name_for_mail();
        /* methods */
        $units = "None";
        $methodname="None";
        $hh = $booking->get_methods_ofbookings($orderid);
        $count_methods = mysqli_num_rows($hh);
        $hh1 = $booking->get_methods_ofbookings($orderid);

        if($count_methods > 0){
            while($jj = mysqli_fetch_array($hh1)){
                if($units == "None"){
                    $units = $jj['units_title']."-".$jj['qtys'];
                }
                else
                {
                    $units = $units.",".$jj['units_title']."-".$jj['qtys'];
                }
                $methodname = $jj['method_title'];
            }
        }
		
		/* ADDONS */
        $addons = "None";
        $hh = $booking->get_addons_ofbookings($orderid);
        while($jj = mysqli_fetch_array($hh)){
            if($addons == "None"){
                $addons = $jj['addon_service_name']."-".$jj['addons_service_qty'];
            }
            else
            {
                $addons = $addons.",".$jj['addon_service_name']."-".$jj['addons_service_qty'];
            }
        }
    }
	if($company_name == ""){
		$company_name = $settings->get_option('ct_company_name');
	}
	$setting_date_format = $settings->get_option('ct_date_picker_date_format');
	$setting_time_format = $settings->get_option('ct_choose_time_format');
	$booking_date = date($setting_date_format, strtotime($_SESSION['ct_details']['booking_date_time']));
	if($setting_time_format == 12){
		$booking_time = date("h:i A", strtotime($_SESSION['ct_details']['booking_date_time']));
	}
	else{
		$booking_time = date("H:i", strtotime($_SESSION['ct_details']['booking_date_time']));
	}
	$price = $general->ct_price_format($_SESSION['ct_details']['net_amount'],$symbol_position,$decimal);
	$c_address = $_SESSION['ct_details']['address'];
	$client_city = $_SESSION['ct_details']['city'];
	$client_state = $_SESSION['ct_details']['state'];
	$client_zip = $_SESSION['ct_details']['zipcode'];
	
    $client_email = $_SESSION['ct_details']['email'];
	if(isset($_SESSION['ct_details']['email']) &&  $_SESSION['ct_details']['email']==''){		$client_email = $_SESSION['ct_details']['existing_username'];	}

    $subject = ucwords($service_name)." on ".$booking_date;
	if($admin_email == ""){
		$admin_email = $admin_infoo['email'];
    }
  
    if($vc_status == "Y"){
        $vc_status_v = "Yes";
    }
    else if($vc_status == "N"){
        $vc_status_v = "No";
    }
    else{
        $vc_status_v = "N/A";
    }
    if($p_status == "Y"){
        $p_status_v = "Yes";
    }
    elseif($p_status == "N"){
        $p_status_v = "No";
    }
    else{
        $p_status_v = "N/A";
    }
    if($_SESSION['ct_details']['email'] != ""){
        $cemail = $_SESSION['ct_details']['email'];
    }
    elseif($_SESSION['ct_details']['existing_username'] != ""){
        $cemail = $_SESSION['ct_details']['existing_username'];
    }

    if($appointment_auto_confirm=="Y"){
		$email_template->email_template_type = 'C';
	}else{
		$email_template->email_template_type = 'A';
	}
    /* $email_template->email_template_type = 'A'; */ 
    $clientemailtemplate = $email_template->readone_client_email_template();

    if($clientemailtemplate['email_message'] != ''){
        $clienttemplate = base64_decode($clientemailtemplate['email_message']);
    }else{
        $clienttemplate = base64_decode($clientemailtemplate['default_message']);
    }

    if($appointment_auto_confirm=="Y"){
		$email_template->email_template_type = 'C';
	}else{
		$email_template->email_template_type = 'A';
	}
    $adminemailtemplate = $email_template->readone_admin_email_template();
    if($adminemailtemplate['email_message'] != ''){
        $admintemplate = base64_decode($adminemailtemplate['email_message']);
    }else{
        $admintemplate = base64_decode($adminemailtemplate['default_message']);
    }
	$client_phone_info="";
	$client_phone_no="";
	$client_phone_length="";
	$client_first_name="";
	$client_last_name="";
	$client_fname="";
	$client_lname="";
	$email_notes="";
	$client_notes="";



	$client_phone_no = $_SESSION['ct_details']['phone'];
	$client_phone_length = strlen($client_phone_no);
			
	if($client_phone_length > 6){
		$client_phone_info = $client_phone_no;
	}else{
		$client_phone_info = "N/A";
	}
	
	$client_first_name = ucwords(stripslashes($_SESSION['ct_details']['firstname']));
	$client_last_name =	ucwords(stripslashes($_SESSION['ct_details']['lastname']));
	
	if($client_first_name=="" && $client_last_name==""){
		$client_fname = "User";
		$client_lname = "";
		$client_name = $client_fname.' '.$client_lname;
	}elseif($client_first_name!="" && $client_last_name!=""){
		$client_fname = $client_first_name;
		$client_lname = $client_last_name;
		$client_name = $client_fname.' '.$client_lname;
	}elseif($client_first_name!=""){
		$client_fname = $client_first_name;
		$client_lname = "";
		$client_name = $client_fname.' '.$client_lname;
	}elseif($client_last_name!=""){
		$client_fname = "";
		$client_lname = $client_last_name;
		$client_name = $client_fname.' '.$client_lname;
	}
	$client_notes = stripslashes($notes);	
	if($client_notes==""){
		$client_notes = "N/A";
	}	
	
	$contact_status_cont = $contact_status_email;	
	if($contact_status_cont==""){
		$contact_status_cont = "N/A";
	}	
	

    $searcharray = array('{{service_name}}','{{booking_date}}','{{business_logo}}','{{business_logo_alt}}','{{client_name}}','{{methodname}}','{{units}}','{{addons}}','{{firstname}}','{{lastname}}','{{client_email}}','{{phone}}','{{payment_method}}','{{vaccum_cleaner_status}}','{{parking_status}}','{{notes}}','{{contact_status}}','{{admin_name}}','{{price}}','{{address}}','{{app_remain_time}}','{{reject_status}}','{{company_name}}','{{booking_time}}','{{client_city}}','{{client_state}}','{{client_zip}}','{{company_city}}','{{company_state}}','{{company_zip}}','{{company_country}}','{{company_phone}}','{{company_email}}','{{company_address}}','{{admin_name}}');

	$replacearray = array($service_name, $booking_date , $business_logo, $business_logo_alt, stripslashes($client_name), $methodname, $units, $addons,$client_fname ,$client_lname , $cemail,$client_phone_info, ucwords($_SESSION['ct_details']['payment_method']), $vc_status_v, $p_status_v,$client_notes, $contact_status_cont,$get_admin_name,$price,stripslashes($c_address),'','',$company_name,$booking_time,stripslashes($client_city),stripslashes($client_state),$client_zip,stripslashes($company_city),stripslashes($company_state),$company_zip,$company_country,$company_phone,$company_email,stripslashes($company_address),stripslashes($get_admin_name));

    if($settings->get_option('ct_client_email_notification_status') == 'Y' && $clientemailtemplate['email_template_status'] == 'E'){
       $client_email_body = str_replace($searcharray,$replacearray,$clienttemplate);
        if($settings->get_option('ct_smtp_hostname') != '' && $settings->get_option('ct_email_sender_name') != '' && $settings->get_option('ct_email_sender_address') != '' && $settings->get_option('ct_smtp_username') != '' && $settings->get_option('ct_smtp_password') != '' && $settings->get_option('ct_smtp_port') != ''){
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
    if($settings->get_option('ct_admin_email_notification_status') == 'Y' && $adminemailtemplate['email_template_status'] == 'E'){							
        $admin_email_body = str_replace($searcharray,$replacearray,$admintemplate);
        if($settings->get_option('ct_smtp_hostname') != '' && $settings->get_option('ct_email_sender_name') != '' && $settings->get_option('ct_email_sender_address') != '' && $settings->get_option('ct_smtp_username') != '' && $settings->get_option('ct_smtp_password') != '' && $settings->get_option('ct_smtp_port') != ''){
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
        $mail_a->Subject = $subject;
        $mail_a->Body = $admin_email_body;
        $mail_a->send();

    }

    /*** Email Code End ***/
	 /*SMS SENDING CODE*/
    /*GET APPROVED SMS TEMPLATE*/
	/* TEXTLOCAL CODE */
	if($settings->get_option('ct_sms_textlocal_status') == "Y")
	{
		if($settings->get_option('ct_sms_textlocal_send_sms_to_client_status') == "Y"){
			$template = $objdashboard->gettemplate_sms("A",'C');
			$phone = $client_phone;				
			if($template[4] == "E") {
				if($template[2] == ""){
					$message = base64_decode($template[3]);
				}
				else{
					$message = base64_decode($template[2]);
				}
			}
			$message = str_replace($searcharray,$replacearray,$message);
			$data = "username=".$textlocal_username."&hash=".$textlocal_hash_id."&message=".$message."&numbers=".$phone."&test=0";
			$ch = curl_init('http://api.textlocal.in/send/?');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			curl_close($ch);
		}
		if($settings->get_option('ct_sms_textlocal_send_sms_to_admin_status') == "Y"){
			$template = $objdashboard->gettemplate_sms("A",'A');
			$phone = $settings->get_option('ct_sms_textlocal_admin_phone');;				
			if($template[4] == "E") {
				if($template[2] == ""){
					$message = base64_decode($template[3]);
				}
				else{
					$message = base64_decode($template[2]);
				}
			}
			$message = str_replace($searcharray,$replacearray,$message);
			$data = "username=".$textlocal_username."&hash=".$textlocal_hash_id."&message=".$message."&numbers=".$phone."&test=0";
			$ch = curl_init('http://api.textlocal.in/send/?');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			curl_close($ch);
		}
	}
    /*PLIVO CODE*/
	if($settings->get_option('ct_sms_plivo_status')=="Y"){
	   
	   if($settings->get_option('ct_sms_plivo_send_sms_to_client_status') == "Y"){
			$auth_id = $settings->get_option('ct_sms_plivo_account_SID');
			$auth_token = $settings->get_option('ct_sms_plivo_auth_token');
			$p_client = new Plivo\RestAPI($auth_id, $auth_token, '', '');

			$template = $objdashboard->gettemplate_sms("A",'C');
			$phone = $client_phone;
			if($template[4] == "E"){
				if($template[2] == ""){
					$message = base64_decode($template[3]);
				}
				else{
					$message = base64_decode($template[2]);
				}
				$client_sms_body = str_replace($searcharray,$replacearray,$message);
				/* MESSAGE SENDING CODE THROUGH PLIVO */
				$params = array(
					'src' => $plivo_sender_number,
					'dst' => $phone,
					'text' => $client_sms_body,
					'method' => 'POST'
				);
				$response = $p_client->send_message($params);
				echo $response;
				/* MESSAGE SENDING CODE ENDED HERE*/
			}
		}
		if($settings->get_option('ct_sms_plivo_send_sms_to_admin_status') == "Y"){
			$auth_id = $settings->get_option('ct_sms_plivo_account_SID');
			$auth_token = $settings->get_option('ct_sms_plivo_auth_token');
			$p_admin = new Plivo\RestAPI($auth_id, $auth_token, '', '');
			$admin_phone = $settings->get_option('ct_sms_plivo_admin_phone_number');
			$template = $objdashboard->gettemplate_sms("A",'A');
			
			if($template[4] == "E") {
				if($template[2] == ""){
					$message = base64_decode($template[3]);
				}
				else{
					$message = base64_decode($template[2]);
				}
				$client_sms_body = str_replace($searcharray,$replacearray,$message);
				$params = array(
					'src' => $plivo_sender_number,
					'dst' => $admin_phone,
					'text' => $client_sms_body,
					'method' => 'POST'
				);
				$response = $p_admin->send_message($params);
				echo $response;
				/* MESSAGE SENDING CODE ENDED HERE*/
			}
		}
	}
	if($settings->get_option('ct_sms_twilio_status') == "Y"){
		if($settings->get_option('ct_sms_twilio_send_sms_to_client_status') == "Y"){
			$AccountSid = $settings->get_option('ct_sms_twilio_account_SID');
			$AuthToken =  $settings->get_option('ct_sms_twilio_auth_token'); 
			$twilliosms_client = new Services_Twilio($AccountSid, $AuthToken);

			$template = $objdashboard->gettemplate_sms("A",'C');
			$phone = $client_phone;
			if($template[4] == "E") {
				if($template[2] == ""){
					$message = base64_decode($template[3]);
				}
				else{
					$message = base64_decode($template[2]);
				}
				$client_sms_body = str_replace($searcharray,$replacearray,$message);
				/*TWILIO CODE*/
				$message = $twilliosms_client->account->messages->create(array(
					"From" => $twilio_sender_number,
					"To" => $phone,
					"Body" => $client_sms_body));
			}
		}
		if($settings->get_option('ct_sms_twilio_send_sms_to_admin_status') == "Y"){
			$AccountSid = $settings->get_option('ct_sms_twilio_account_SID');
			$AuthToken =  $settings->get_option('ct_sms_twilio_auth_token'); 
			$twilliosms_admin = new Services_Twilio($AccountSid, $AuthToken);
			$admin_phone = $settings->get_option('ct_sms_twilio_admin_phone_number');
			$template = $objdashboard->gettemplate_sms("A",'A');
			if($template[4] == "E") {
				if($template[2] == ""){
					$message = base64_decode($template[3]);
				}
				else{
					$message = base64_decode($template[2]);
				}
				$client_sms_body = str_replace($searcharray,$replacearray,$message);
				/*TWILIO CODE*/
				$message = $twilliosms_admin->account->messages->create(array(
					"From" => $twilio_sender_number,
					"To" => $admin_phone,
					"Body" => $client_sms_body));
			}
		}
	}
	if($settings->get_option('ct_nexmo_status') == "Y"){
		if($settings->get_option('ct_sms_nexmo_send_sms_to_client_status') == "Y"){
			$template = $objdashboard->gettemplate_sms("A",'C');
			$phone = $client_phone;				
			if($template[4] == "E") {
				if($template[2] == ""){
					$message = base64_decode($template[3]);
				}
				else{
					$message = base64_decode($template[2]);
				}
				$ct_nexmo_text = str_replace($searcharray,$replacearray,$message);
				$res=$nexmo_client->send_nexmo_sms($phone,$ct_nexmo_text);
			}
			
		}
		if($settings->get_option('ct_sms_nexmo_send_sms_to_admin_status') == "Y"){
			$template = $objdashboard->gettemplate_sms("A",'A');
			$phone = $settings->get_option('ct_sms_nexmo_admin_phone_number');				
			if($template[4] == "E") {
				if($template[2] == ""){
					$message = base64_decode($template[3]);
				}
				else{
					$message = base64_decode($template[2]);
				}
				$ct_nexmo_text = str_replace($searcharray,$replacearray,$message);
				$res=$nexmo_admin->send_nexmo_sms($phone,$ct_nexmo_text);
			}
			
		}
	}
    /*SMS SENDING CODE END*/
   @ob_clean();
   ob_start();
   echo 'ok';
}
?>