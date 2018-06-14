<?php

include(dirname(dirname(dirname(__FILE__)))."/objects/class_connection.php");
include(dirname(dirname(dirname(__FILE__)))."/objects/class_dashboard.php");
include(dirname(dirname(dirname(__FILE__)))."/header.php");
include(dirname(dirname(dirname(__FILE__)))."/objects/class_setting.php");
include(dirname(dirname(dirname(__FILE__))).'/objects/class_booking.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class_general.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class.phpmailer.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class_adminprofile.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class_front_first_step.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/plivo.php');
include(dirname(dirname(dirname(__FILE__))).'/objects/class_email_template.php');
include(dirname(dirname(dirname(__FILE__))).'/assets/twilio/Services/Twilio.php');
include(dirname(dirname(dirname(__FILE__)))."/objects/class_nexmo.php");
if ( is_file(dirname(dirname(dirname(__FILE__))).'/extension/GoogleCalendar/google-api-php-client/src/Google_Client.php')) 
{
	require_once dirname(dirname(dirname(__FILE__))).'/extension/GoogleCalendar/google-api-php-client/src/Google_Client.php';
}
include(dirname(dirname(dirname(__FILE__)))."/objects/class_gc_hook.php");

$con = new cleanto_db();
$conn = $con->connect();

$nexmo_admin = new cleanto_ct_nexmo();
$nexmo_client = new cleanto_ct_nexmo();

$first_step=new cleanto_first_step();
$first_step->conn=$conn;

$objdashboard = new cleanto_dashboard();
$objdashboard->conn = $conn;

$gc_hook = new cleanto_gcHook();
$gc_hook->conn = $conn;

$objadminprofile = new cleanto_adminprofile();
$objadminprofile->conn = $conn;

$objadmin = new cleanto_adminprofile();
$objadmin->conn = $conn;

$setting = new cleanto_setting();
$setting->conn = $conn;


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

/*NEXMO SMS GATEWAY VARIABLES*/

$nexmo_admin->ct_nexmo_api_key = $setting->get_option('ct_nexmo_api_key');
$nexmo_admin->ct_nexmo_api_secret = $setting->get_option('ct_nexmo_api_secret');
$nexmo_admin->ct_nexmo_from = $setting->get_option('ct_nexmo_from');

$nexmo_client->ct_nexmo_api_key = $setting->get_option('ct_nexmo_api_key');
$nexmo_client->ct_nexmo_api_secret = $setting->get_option('ct_nexmo_api_secret');
$nexmo_client->ct_nexmo_from = $setting->get_option('ct_nexmo_from');

$general=new cleanto_general();
$general->conn=$conn;

$symbol_position=$setting->get_option('ct_currency_symbol_position');
$decimal=$setting->get_option('ct_price_format_decimal_places');

$emailtemplate=new cleanto_email_template();
$emailtemplate->conn=$conn;

$getcurrency_symbol_position=$setting->get_option('ct_currency_symbol_position');
$getdateformate = $setting->get_option('ct_date_picker_date_format');
$time_format = $setting->get_option('ct_time_format');

$booking = new cleanto_booking();
$booking->conn = $conn;
$lang = $setting->get_option("ct_language");
$label_language_values = array();
$language_label_arr = $setting->get_all_labelsbyid($lang);


/*SMS GATEWAY VARIABLES*/
$plivo_sender_number = $setting->get_option('ct_sms_plivo_sender_number');
$twilio_sender_number = $setting->get_option('ct_sms_twilio_sender_number');

/* textlocal gateway variables */
$textlocal_username =$setting->get_option('ct_sms_textlocal_account_username');
$textlocal_hash_id = $setting->get_option('ct_sms_textlocal_account_hash_id');

/*NEED VARIABLE FOR EMAIL*/
$company_city = $setting->get_option('ct_company_city'); $company_state = $setting->get_option('ct_company_state'); $company_zip = $setting->get_option('ct_company_zip_code'); $company_country = $setting->get_option('ct_company_country'); 
$company_phone = strlen($setting->get_option('ct_company_phone')) < 6 ? "" : $setting->get_option('ct_company_phone');
$company_email = $setting->get_option('ct_company_email');$company_address = $setting->get_option('ct_company_address'); 

/*CHECK FOR VC AND PARKING STATUS*/
$global_vc_status = $setting->get_option('ct_vc_status');
$global_p_status = $setting->get_option('ct_p_status');
$admin_phone_twilio = $setting->get_option('ct_sms_twilio_admin_phone_number');
$admin_phone_plivo = $setting->get_option('ct_sms_plivo_admin_phone_number');
/*CHECK FOR VC AND PARKING STATUS END*/

/*  set admin name */
$get_admin_name_result = $objadminprofile->readone_adminname();
$get_admin_name = $get_admin_name_result[3];
if($get_admin_name == ""){
	$get_admin_name = "Admin";
}
$admin_email = $setting->get_option('ct_admin_optional_email');
/* set admin name */
/* set business logo and logo alt */
 if($setting->get_option('ct_company_logo') != null && $setting->get_option('ct_company_logo') != ""){
	$business_logo= SITE_URL.'assets/images/services/'.$setting->get_option('ct_company_logo');
	$business_logo_alt= $setting->get_option('ct_company_name');
}else{
	$business_logo= '';
	$business_logo_alt= $setting->get_option('ct_company_name');
}
/* set business logo and logo alt */
		
if ($language_label_arr[1] != "" || $language_label_arr[3] != "" || $language_label_arr[4] != "" || $language_label_arr[5] != "")
{
	$default_language_arr = $setting->get_all_labelsbyid("en");
	if($language_label_arr[1] != ''){
		$label_decode_front = base64_decode($language_label_arr[1]);
	}else{
		$label_decode_front = base64_decode($default_language_arr[1]);
	}
	if($language_label_arr[3] != ''){
		$label_decode_admin = base64_decode($language_label_arr[3]);
	}else{
		$label_decode_admin = base64_decode($default_language_arr[3]);
	}
	if($language_label_arr[4] != ''){
		$label_decode_error = base64_decode($language_label_arr[4]);
	}else{
		$label_decode_error = base64_decode($default_language_arr[4]);
	}
	if($language_label_arr[5] != ''){
		$label_decode_extra = base64_decode($language_label_arr[5]);
	}else{
		$label_decode_extra = base64_decode($default_language_arr[5]);
	}
	
	$label_decode_front_unserial = unserialize($label_decode_front);
	$label_decode_admin_unserial = unserialize($label_decode_admin);
	$label_decode_error_unserial = unserialize($label_decode_error);
	$label_decode_extra_unserial = unserialize($label_decode_extra);
    
	$label_language_arr = array_merge($label_decode_front_unserial,$label_decode_admin_unserial,$label_decode_error_unserial,$label_decode_extra_unserial);
	
	foreach($label_language_arr as $key => $value){
		$label_language_values[$key] = urldecode($value);
	}
}
else
{
    $default_language_arr = $setting->get_all_labelsbyid("en");
    
	$label_decode_front = base64_decode($default_language_arr[1]);
	$label_decode_admin = base64_decode($default_language_arr[3]);
	$label_decode_error = base64_decode($default_language_arr[4]);
	$label_decode_extra = base64_decode($default_language_arr[5]);	
	
	$label_decode_front_unserial = unserialize($label_decode_front);
	$label_decode_admin_unserial = unserialize($label_decode_admin);
	$label_decode_error_unserial = unserialize($label_decode_error);
	$label_decode_extra_unserial = unserialize($label_decode_extra);
    
	$label_language_arr = array_merge($label_decode_front_unserial,$label_decode_admin_unserial,$label_decode_error_unserial,$label_decode_extra_unserial);
	
	foreach($label_language_arr as $key => $value){
		$label_language_values[$key] = urldecode($value);
	}
}
/*new file include*/
include(dirname(dirname(dirname(__FILE__))).'/assets/lib/date_translate_array.php');
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
if(isset($_POST['getcleintdetailwith_updatereadstatus'])){
	/*new file include*/
	include(dirname(dirname(dirname(__FILE__))).'/assets/lib/date_translate_array.php');
    $orderdetail = $objdashboard->getclientorder($_POST['orderid']);
    $objdashboard->update_read_status($_POST['orderid']);
    ?>
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-md vertical-align-center">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close closesss" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><?php echo $label_language_values['booking_details'];?></h4>
                </div>
                <div class="modal-body mb-20">
                    <ul class="list-unstyled ct-cal-booking-details mypopupul">
                        <li>
                            <label style="width: 120px; margin-right: 0;"><?php echo $label_language_values['booking_status'];?> : </label>
                            <div class="ct-booking-status">
                                <?php
                                if($orderdetail[6]=='A')
                                {
                                    $booking_stats=$label_language_values['active'];
                                }
                                elseif($orderdetail[6]=='C')
                                {
                                    $booking_stats='<i class="fa fa-check txt-success">'.$label_language_values['confirmed'].'</i>';
                                }
                                elseif($orderdetail[6]=='R')
                                {
                                    $booking_stats='<i class="fa fa-ban txt-danger">'.$label_language_values['rejected'].'</i>';
                                }
                                elseif($orderdetail[6]=='RS')
                                {
                                    $booking_stats='<i class="fa fa-pencil-square-o txt-info">'.$label_language_values['rescheduled'].'</i>';
                                }
                                elseif($orderdetail[6]=='CC')
                                {
                                    $booking_stats='<i class="fa fa-times txt-primary">'.$label_language_values['cancelled_by_client'].'</i>';
                                }
                                elseif($orderdetail[6]=='CS')
                                {
                                    $booking_stats='<i class="fa fa-times-circle-o txt-info">'.$label_language_values['cancelled_by_service_provider'].'</i>';
                                }
                                elseif($orderdetail[6]=='CO')
                                {
                                    $booking_stats='<i class="fa fa-thumbs-o-up txt-success">'.$label_language_values['appointment_completed'].'</i>';
                                }
                                else
                                {
                                    $booking_stats='<i class="fa fa-thumbs-o-down txt-danger">'.$label_language_values['appointment_marked_as_no_show'].'</i>';
                                }
                                echo $booking_stats;
                                ?>
                            </div>
                        </li>
                        <li class="ct-second-child">
                            <span><i class="fa fa-calendar"></i><?php echo str_replace($english_date_array,$selected_lang_label,date($getdateformate, strtotime($orderdetail[0])));?>  <i class="fa fa-clock-o ml-10 mr-1"></i>
							<?php
								if($time_format == 12){
								?>
								<?php echo date("h:i A", strtotime($orderdetail[0]));?></span>
								<?php
								}else{
								?>
								<?php echo date("H:i", strtotime($orderdetail[0]));?></span>
								<?php
								}
								?>
                            </span>
                        </li>

                        <li>
                            <label><?php echo $label_language_values['service'];?></label>
                            <span class="service-html span-scroll">: <?php echo $orderdetail[1];?></span>
                        </li>


                        <?php
                        /* metrhods */
                        $units = $label_language_values['none'];
                        $methodname=$label_language_values['none'];
                        $hh = $booking->get_methods_ofbookings($orderdetail[4]);
                        $count_methods = mysqli_num_rows($hh);
                        $hh1 = $booking->get_methods_ofbookings($orderdetail[4]);

                        if($count_methods > 0){
                            while($jj = mysqli_fetch_array($hh1)){
                                if($units == $label_language_values['none']){
                                    $units = $jj['units_title']."-".$jj['qtys'];
                                }
                                else
                                {
                                    $units = $units.",".$jj['units_title']."-".$jj['qtys'];
                                }
                                $methodname = $jj['method_title'];
                            }
                        }

                        $addons = $label_language_values['none'];
                        $hh = $booking->get_addons_ofbookings($orderdetail[4]);
                        while($jj = mysqli_fetch_array($hh)){
                            if($addons == $label_language_values['none']){
                                $addons = $jj['addon_service_name']."-".$jj['addons_service_qty'];
                            }
                            else
                            {
                                $addons = $addons.",".$jj['addon_service_name']."-".$jj['addons_service_qty'];
                            }
                        }

                        ?>
                        <li>
                            <label><?php echo $label_language_values['methods'];?></label>
                            <span class="calendar_providername span-scroll">: <?php echo $methodname;?></span>
                        </li>
                        <li>
                            <label><?php echo $label_language_values['units'];?></label>
                            <span class="calendar_providername span-scroll">: <?php echo $units;?></span>
                        </li>
                        <li>
                            <label><?php echo $label_language_values['addons'];?></label>
                            <span class="calendar_providername span-scroll">: <?php echo $addons;?></span>
                        </li>

                        <li>
                            <label><?php echo $label_language_values['price'];?></label>
                            <span class="span-scroll">: <?php echo $general->ct_price_format($orderdetail[2],$symbol_position,$decimal);
                               ?> </span>
                        </li>

                        <li><h6 class="ct-customer-details-hr"><?php echo $label_language_values['customer'];?></h6>
                        </li>
                        <?php
                        if($orderdetail[4]==0)
                        {
                            $gc  = $objdashboard->getguestclient($orderdetail[4]);
                            ?>
                            <li>
                                <label><?php echo $label_language_values['name'];?></label>
                                <span class="client_name span-scroll">: <?php echo $gc[2];?></span>
                            </li>
                            <li>
                                <label><?php echo $label_language_values['email'];?></label>
                                <span class="client_email span-scroll">: <?php echo $gc[3];?></span>
                            </li>
                            <li>
                                <label><?php echo $label_language_values['phone'];?></label>
                                <span class="client_phone span-scroll">: <?php echo $gc[4];?></span>
                            </li>
                            <li>
                                <label><?php echo $label_language_values['payment'];?></label>
                                <span class="client_payment span-scroll">: <?php echo $orderdetail[6];?></span>
                            </li>
                            <?php
							$temppp= unserialize(base64_decode($gc[5]));
							$temp = str_replace('\\','',$temppp);
							$vc_status = $temp['vc_status'];
                               if($vc_status == 'N'){
                                $final_vc_status = $label_language_values['no'];
                            }
                            elseif($vc_status == 'Y'){
								$final_vc_status = $label_language_values['yes'];
                            }else{
                                $final_vc_status = "-";
                            }
                            $p_status = $temp['p_status'];
                            if($p_status == 'N'){
                                $final_p_status = $label_language_values['no'];
                            }
                            elseif($p_status == 'Y'){
								$final_p_status = $label_language_values['yes'];
                            }else{
                                $final_p_status = "-";
                            }
                            ?>

                            <?php 
							if($global_vc_status == 'Y' && $final_vc_status != '-'){
								?>
								<li>
                                <label><?php echo $label_language_values['vaccum_cleaner'];?></label>
                                <span class="client_vc_status span-scroll">: <?php echo $final_vc_status;?></span>
								</li>
								<?php 
							}
							if($global_p_status == 'Y'  && $final_p_status != "-"){
								?>
								<li>
                                <label><?php echo $label_language_values['parking'];?></label>
                                <span class="client_parking span-scroll">: <?php echo $final_p_status;?></span>
								</li>
								<?php 
							}
							?>

                            <?php
                                if($temp['notes']!=""){
                                    ?>
                                    <li>
                                        <label><?php echo $label_language_values['notes'];?></label>
                                        <span class="notes span-scroll">: <?php echo $temp['notes'];?></span>
                                    </li>
                                <?php
                                }
								if($setting->get_option("ct_company_willwe_getin_status") == "Y") { ?>
                            <li>
                                <label><?php echo $label_language_values['contact_status'];?></label>
                                <span class="notes span-scroll">: <?php echo $temp['contact_status'];?></span>
                            </li>
							<?php 
							}
                        }
                        else
                        {
                            $c  = $objdashboard->getguestclient($orderdetail[4]);
							$client_name = explode(" ",$c[2]);
							$cnamess = array_filter($client_name);
							$ccnames = array_values($cnamess);
							if(sizeof($ccnames)>0){
								$client_first_name =  $ccnames[0]; 
								if(isset($ccnames[1])){
									$client_last_name =  $ccnames[1]; 
								}else{
									$client_last_name =  ''; 
								}
							}else{
								$client_first_name =  ''; 
								$client_last_name =  ''; 
							}
							?>
							<?php if($client_first_name !="" || $client_last_name !=""){ ?>
                            <li>
                                <label><?php echo $label_language_values['name'];?></label>
								
                                <span class="client_name span-scroll">: <?php if($client_first_name !=""){ echo $client_first_name ." " ; }  if($client_last_name !=""){ echo $client_last_name ; } ?></span>
                            </li>
							<?php } ?>
							<li>
                                <label><?php echo $label_language_values['email'];?></label>
                                <span class="client_email span-scroll">: <?php echo $c[3];?></span>
                            </li>
							
						<?php
							$fetch_phone =  strlen($c[4]);
							if($fetch_phone >= 6){
						?>
                            <li>
                                <label><?php echo $label_language_values['phone'];?></label>
                                <span class="client_phone span-scroll">: <?php echo $c[4];?></span>
                            </li>
							<?php } ?>
							 <li>
                                <label><?php echo $label_language_values['payment'];?></label>
                                <span class="client_payment span-scroll">: <?php echo $orderdetail[5];?></span>
                            </li>
                            <?php
							$temppp= unserialize(base64_decode($c[5]));
							$temp = str_replace('\\','',$temppp);
                            $vc_status = $temp['vc_status'];
							
                            if($vc_status == 'N'){
                                $final_vc_status = $label_language_values['no'];
                            }
                            elseif($vc_status == 'Y'){
								$final_vc_status = $label_language_values['yes'];
                            }else{
                                $final_vc_status = "-";
                            }
                            $p_status = $temp['p_status'];
                            if($p_status == 'N'){
                                $final_p_status = $label_language_values['no'];
                            }
                            elseif($p_status == 'Y'){
								$final_p_status = $label_language_values['yes'];
                            }else{
                                $final_p_status = "-";
                            }
                            ?>
				<?php if($temp['address']!="" || $temp['city']!="" || $temp['zip']!="" || $temp['state']!=""  ){ ?>			
							<li>
                                <label><?php echo $label_language_values['address'];?></label>
                                <span class="client_address span-scroll">: 
										<?php if($temp['address']!=""){ echo $temp['address'].", " ; } ?> <?php if($temp['city']!=""){ echo $temp['city'].", " ; } ?> <?php if($temp['zip']!=""){ echo $temp['zip'].", " ; } ?><?php if($temp['state']!=""){ echo $temp['state'] ; } ?>
								</span>	
                            </li>
							
				<?php } ?>		
                            <?php 
							if($global_vc_status == 'Y'&& $final_vc_status != '-'){
								?>
                            <li>
                                <label><?php echo $label_language_values['vaccum_cleaner'];?></label>
                                <span class="client_vc_status span-scroll">: <?php echo $final_vc_status;?></span>
                            </li>
							
							<?php }?>
							
							<?php 
							if($global_vc_status == 'Y' && $final_p_status != '-'){
								?>
                            <li>
                                <label><?php echo $label_language_values['parking'];?></label>
                                <span class="client_parking span-scroll">: <?php echo $final_p_status;?></span>
                            </li>
							<?php }?>
                            <?php
                            if($temp['notes']!=""){
                                ?>
                                <li>
                                    <label><?php echo $label_language_values['notes'];?></label>
                                    <span class="notes span-scroll">: <?php echo $temp['notes'];?></span>
                                </li>
                            <?php
                            }
							if($setting->get_option("ct_company_willwe_getin_status") == "Y") { ?>
                            <li>
                                <label><?php echo $label_language_values['contact_status'];?></label>

                                <span class="notes span-scroll">: <?php echo $temp['contact_status'];?></span>
                            </li>
                        <?php
							}
                        }
                        ?>
						<hr>
						<li>
							<label class="assign-app-staff"><?php echo $label_language_values['assign_appointment_to_staff'];?></label>
							<span class="span-scroll-staff">
								<?php
								$get_staff_services = $objadmin->readall_staff_booking();
								$booking->order_id = $_POST['orderid'];
								$get_staff_assignid = explode(",",$booking->fetch_staff_of_booking());
								
								$staff_html = "";
								$staff_html .= "<select id='staff_select' class='selectpicker col-md-10' data-live-search='true' multiple data-actions-box='true' data-orderid='".$_POST['orderid']."'>";
								
								$booking->booking_date_time = $orderdetail[0];
								$staff_status = $booking->booked_staff_status();
								$staff_status_arr = explode(",",$staff_status);
								
								foreach($get_staff_services as $staff_details)
								{
									$i = "no";
									$staffname = $staff_details['fullname'];
									$staffid = $staff_details['id'];
									$s_s = "";
									if(in_array($staffid,$staff_status_arr)){
										$s_s = "fa fa-calendar-check-o";
									}
									if(in_array($staffid,$get_staff_assignid)){
										$i = "yes";
									}
									if($i == "yes")
									{
										$staff_html .= "<option selected='selected' data-icon='".$s_s." booking-staff-assigned' value='$staffid'>$staffname</option>";
									}
									else{
										$staff_html .= "<option data-icon='".$s_s." booking-staff-assigned' value='$staffid'>$staffname</option>";
									}
								}

								$staff_html .= "</select><a data-orderid='".$_POST['orderid']."' class='save_staff_booking edit_staff btn btn-info'><i class='remove_add_fafa_class fa fa-pencil-square-o'></i></a>";
								echo $staff_html;
								?>
							</span>
						</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <div class="cta-col12 ct-footer-popup-btn text-center">
						<div class="fln-mrat-dib ">
                        <?php
                        $booking_day = date("Y-m-d", strtotime($orderdetail[0]));
                        $past_day = "no";
                        $current_day = date("Y-m-d"); 

                        if ($current_day > $booking_day)
                        {
                            $past_day = "yes";
                        }
                        else
                        {
                            $past_day = "no";
                        }
                        if($orderdetail[6]=='C' || $orderdetail[6]=='R' || $orderdetail[6]=='CC' || $past_day == "yes"){

                        }
                        else{?>
							
								<span class="col-xs-4 np ct-w-32">
									<a data-id="<?php echo $_POST['orderid'];?>" class="btn btn-link ct-small-btn ct-confirm-appointment" title="<?php echo $label_language_values['confirm_appointment'];?>"><i class="fa fa-thumbs-up fa-2x"></i><br /><?php echo $label_language_values['confirm'];?></a>
								</span>
								<span class="col-xs-4 np ct-w-32">
									<a data-id="<?php echo $_POST['orderid'];?>" id="ct-reject-appointment-cal-popup" class="btn btn-link ct-small-btn book_rejectss" rel="popover" data-placement='top' title="<?php echo $label_language_values['reject_reason'];?>"><i class="fa fa-thumbs-o-down fa-2x"></i><br /><?php echo $label_language_values['reject'];?></a>

									<div id="popover-reject-appointment-cal-popupss<?php echo $_POST['orderid'];?>" style="display: none;">
										<div class="arrow"></div>
										<table class="form-horizontal" cellspacing="0">
											<tbody>
											<tr>
												<td><textarea class="form-control" id="reason_reject<?php echo $_POST['orderid'];?>" name="" placeholder="<?php echo $label_language_values['appointment_reject_reason'];?>" required="required" ></textarea></td>
											</tr>
											<tr>
												<td>
													<button data-id="<?php echo $_POST['orderid'];?>" id="" value="Delete" class="btn btn-danger btn-sm reject_bookings" type="submit"><?php echo $label_language_values['reject'];?></button>
													<button id="ct-close-reject-appointment-cal-popup" class="btn btn-default btn-sm" href="javascript:void(0)"><?php echo $label_language_values['cancel'];?></button>
												</td>
											</tr>
											</tbody>
										</table>
									</div><!-- end pop up -->
								</span>
						   <?php  }
							?>

							<span class="col-xs-4 np ct-w-32">
								<a data-id="<?php echo $_POST['orderid'];?>" id="ct-delete-appointment-cal-popup" class="ct-delete-appointment-cal-popup btn btn-link ct-small-btn booking_deletess" rel="popover" data-placement='top' title="<?php echo $label_language_values['delete_this_appointment'];?>"><i class="fa fa-trash-o fa-2x"></i><br /> <?php echo $label_language_values['delete'];?></a>
							</span>
							<div id="popover-delete-appointment-cal-popupss<?php echo $_POST['orderid'];?>" style="display: none;">
								<div class="arrow"></div>
								<table class="form-horizontal" cellspacing="0">
									<tbody>
									<tr>
										<td>
											<button id="" data-id="<?php echo $_POST['orderid'];?>" value="Delete" class="btn btn-danger btn-sm mybtndelete_booking" type="submit"><?php echo $label_language_values['delete'];?></button>
											<button id="ct-close-del-appointment-cal-popup" class="btn btn-default btn-sm" href="javascript:void(0)"><?php echo $label_language_values['cancel'];?></button>
										</td>
									</tr>
									</tbody>
								</table>
							</div>
							<!-- end pop up -->
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
elseif(isset($_POST['confirm_booking'])){
    $id = $_POST['id']; /*here id ==order id*/
    $orderdetail = $objdashboard->getclientorder($id);
    $lastmodify = date('Y-m-d H:i:s');
    /* Update Confirm status in bookings */
    $objdashboard->confirm_bookings($id,$lastmodify);

    $clientdetail = $objdashboard->clientemailsender($id);

    /*$booking_date = date("Y-m-d H:i", strtotime($clientdetail['booking_date_time']));*/
	$admin_company_name = $setting->get_option('ct_company_name');
	$setting_date_format = $setting->get_option('ct_date_picker_date_format');
	$setting_time_format = $setting->get_option('ct_choose_time_format');
	$booking_date = date($setting_date_format, strtotime($clientdetail['booking_date_time']));
	if($setting_time_format == 12){
		$booking_time = date("h:i A", strtotime($clientdetail['booking_date_time']));
	}
	else{
		$booking_time = date("H:i",strtotime($clientdetail['booking_date_time']));
	}
    $company_name = $setting->get_option('ct_email_sender_name');
    $company_email = $setting->get_option('ct_email_sender_address');
    $service_name = $clientdetail['title'];
    if($admin_email == ""){
		$admin_email = $clientdetail['email'];	
	}
    /* $admin_name = $clientdetail['fullname']; */
    
    $price=$general->ct_price_format($orderdetail[2],$symbol_position,$decimal);

    /* methods */
    $units = $label_language_values['none'];
    $methodname=$label_language_values['none'];
    $hh = $booking->get_methods_ofbookings($orderdetail[4]);
    $count_methods = mysqli_num_rows($hh);
    $hh1 = $booking->get_methods_ofbookings($orderdetail[4]);

    if($count_methods > 0){
        while($jj = mysqli_fetch_array($hh1)){
            if($units == $label_language_values['none']){
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
    $addons =  $label_language_values['none'];
    $hh = $booking->get_addons_ofbookings($orderdetail[4]);
    while($jj = mysqli_fetch_array($hh)){
        if($addons ==  $label_language_values['none']){
            $addons = $jj['addon_service_name']."-".$jj['addons_service_qty'];
        }
        else
        {
            $addons = $addons.",".$jj['addon_service_name']."-".$jj['addons_service_qty'];
        }
    }


    /* if this is guest user than */
    if($orderdetail[4]==0)
    {
        $gc  = $objdashboard->getguestclient($orderdetail[4]);
        $temppp= unserialize(base64_decode($gc[5]));
        $temp = str_replace('\\','',$temppp);
        $vc_status = $temp['vc_status'];
        if($vc_status == 'N'){
            $final_vc_status =  $label_language_values['no'];
        }
        elseif($vc_status == 'Y'){
            $final_vc_status =  $label_language_values['yes'];
        }else{
            $final_vc_status = "N/A";
        }
        $p_status = $temp['p_status'];
        if($p_status == 'N'){
            $final_p_status =  $label_language_values['no'];
        }
        elseif($p_status == 'Y'){
            $final_p_status =  $label_language_values['yes'];
        }else{
            $final_p_status = "N/A";
        }

        $client_name=$gc[2];
        $client_email=$gc[3];
		
        /* $client_phone=$gc[4]; */
        $phone_length = strlen($gc[4]);
			
			if($phone_length > 6){
				$client_phone = $gc[4];
			}else{
				$client_phone = "N/A";
			}
			
		
		$firstname=$client_name;
        $lastname='';
        $booking_status=$orderdetail[6];
        $final_vc_status;
        $final_p_status;
        $payment_status=$orderdetail[5];
        $client_address=$temp['address'];
        $client_notes=$temp['notes'];
        $client_status=$temp['contact_status'];				
		$client_city = $temp['city'];		$client_state = $temp['state'];		$client_zip	= $temp['zip'];
    }
    else
        /*Registered user */
    {
        $c  = $objdashboard->getguestclient($orderdetail[4]);
        $temppp= unserialize(base64_decode($c[5]));
        $temp = str_replace('\\','',$temppp);
        $vc_status = $temp['vc_status'];
        if($vc_status == 'N'){
            $final_vc_status =  $label_language_values['no'];
        }
        elseif($vc_status == 'Y'){
            $final_vc_status =  $label_language_values['yes'];
        }else{
            $final_vc_status = "N/A";
        }
        $p_status = $temp['p_status'];
        if($p_status == 'N'){
            $final_p_status =  $label_language_values['no'];
        }
        elseif($p_status == 'Y'){
            $final_p_status =  $label_language_values['yes'];
        }else{
            $final_p_status = "N/A";
        }
        $client_name=$c[2];
        $client_email=$c[3];
        /* $client_phone=$c[4]; */
		
		 $phone_length = strlen($c[4]);
			
			if($phone_length > 6){
				$client_phone = $c[4];
			}else{
				$client_phone = "N/A";
			}
			
			
			
			$client_name_value="";
			$client_first_name="";
			$client_last_name="";
			
			$client_name_value= explode(" ",$client_name);
			$client_first_name = $client_name_value[0];
			$client_last_name =	$client_name_value[1];
	
					if($client_first_name=="" && $client_last_name==""){
						$firstname = "User";
						$lastname = "";
						$client_name = $firstname.' '.$lastname;
					}elseif($client_first_name!="" && $client_last_name!=""){
						$firstname = $client_first_name;
						$lastname = $client_last_name;
						$client_name = $firstname.' '.$lastname;
					}elseif($client_first_name!=""){
						$firstname = $client_first_name;
						$lastname = "";
						$client_name = $firstname.' '.$lastname;
					}elseif($client_last_name!=""){
						$firstname = "";
						$lastname = $client_last_name;
						$client_name = $firstname.' '.$lastname;
					}
	
			$client_notes = $temp['notes'];	
					if($client_notes==""){
						$client_notes = "N/A";
					}		
			
			$client_status = $temp['contact_status'];	
					if($client_status==""){
						$client_status = "N/A";
					}	
			
		
	/* 	$firstname=$client_name;
        $lastname=''; */
		
		
        $payment_status=$orderdetail[5];
        $final_vc_status;
        $final_p_status;
        $client_address=$temp['address'];
        /* $client_notes=$temp['notes']; */
        /* $client_status=$temp['contact_status']; */
		$client_city = $temp['city'];
		$client_state = $temp['state'];	
		$client_zip	= $temp['zip'];
    }
   $searcharray = array('{{service_name}}','{{booking_date}}','{{business_logo}}','{{business_logo_alt}}','{{client_name}}','{{methodname}}','{{units}}','{{addons}}','{{client_email}}','{{phone}}','{{payment_method}}','{{vaccum_cleaner_status}}','{{parking_status}}','{{notes}}','{{contact_status}}','{{address}}','{{price}}','{{admin_name}}','{{firstname}}','{{lastname}}','{{app_remain_time}}','{{reject_status}}','{{company_name}}','{{booking_time}}','{{client_city}}','{{client_state}}','{{client_zip}}','{{company_city}}','{{company_state}}','{{company_zip}}','{{company_country}}','{{company_phone}}','{{company_email}}','{{company_address}}','{{admin_name}}');
		
	$replacearray = array($service_name, $booking_date , $business_logo, $business_logo_alt, $client_name,$methodname, $units, $addons,$client_email, $client_phone, $payment_status, $final_vc_status, $final_p_status, $client_notes, $client_status,$client_address,$price,$get_admin_name,$firstname,$lastname,'','',$admin_company_name,$booking_time,$client_city,$client_state,$client_zip,$company_city,$company_state,$company_zip,$company_country,$company_phone,$company_email,$company_address,$get_admin_name);
		
    $emailtemplate->email_subject="Appointment Approved";
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
    /*** Email Code End ***/

    /*** Email Code Start ***/
    $emailtemplate->email_subject="Appointment Approved";
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
   
	$staff_ids = $booking->get_staff_ids_from_bookings($id);
	if($staff_ids != ''){
		$staff_idss = explode('',$staff_ids);
		if(sizeof($staff_idss) > 0){
			foreach($staff_idss as $sid){
				$staffdetails = $booking->get_staff_detail_for_email($sid);
				$staff_name = $staffdetails['fullname'];
				$staff_email = $staffdetails['email'];		
						
				$staff_searcharray = array('{{service_name}}','{{booking_date}}','{{business_logo}}','{{business_logo_alt}}','{{client_name}}','{{methodname}}','{{units}}','{{addons}}','{{client_email}}','{{phone}}','{{payment_method}}','{{vaccum_cleaner_status}}','{{parking_status}}','{{notes}}','{{contact_status}}','{{address}}','{{price}}','{{admin_name}}','{{firstname}}','{{lastname}}','{{app_remain_time}}','{{reject_status}}','{{company_name}}','{{booking_time}}','{{client_city}}','{{client_state}}','{{client_zip}}','{{company_city}}','{{company_state}}','{{company_zip}}','{{company_country}}','{{company_phone}}','{{company_email}}','{{company_address}}','{{admin_name}}','{{staff_name}}','{{staff_email}}');
					
				$staff_replacearray = array($service_name, $booking_date , $business_logo, $business_logo_alt, $client_name,$methodname, $units, $addons,$client_email, $client_phone, $payment_status, $final_vc_status, $final_p_status, $client_notes, $client_status,$client_address,$price,$get_admin_name,$firstname,$lastname,'','',$admin_company_name,$booking_time,$client_city,$client_state,$client_zip,$company_city,$company_state,$company_zip,$company_country,$company_phone,$company_email,$company_address,$get_admin_name,$staff_name,$staff_email);
				
				
				$emailtemplate->email_subject="Appointment Approved";
				$emailtemplate->user_type="S";
				$staffemailtemplate=$emailtemplate->readone_client_email_template_body();
				
				if($staffemailtemplate[2] != ''){
					$stafftemplate = base64_decode($staffemailtemplate[2]);
				}else{
					$stafftemplate = base64_decode($staffemailtemplate[3]);
				}
				$subject=$staffemailtemplate[1];
			   
				if($setting->get_option('ct_staff_email_notification_status') == 'Y' && $staffemailtemplate[4]=='E' ){
					$client_email_body = str_replace($staff_searcharray,$staff_replacearray,$stafftemplate);
					if($setting->get_option('ct_smtp_hostname') != '' && $setting->get_option('ct_email_sender_name') != '' && $setting->get_option('ct_email_sender_address') != '' && $setting->get_option('ct_smtp_username') != '' && $setting->get_option('ct_smtp_password') != '' && $setting->get_option('ct_smtp_port') != ''){
						$mail_s->IsSMTP();
					}else{
						$mail_s->IsMail();
					}
					$mail_s->SMTPDebug  = 0;
					$mail_s->IsHTML(true);
					$mail_s->From = $company_email;
					$mail_s->FromName = $company_name;
					$mail_s->Sender = $company_email;
					$mail_s->AddAddress($client_email, $client_name);
					$mail_s->Subject = $subject;
					$mail_s->Body = $client_email_body;
					$mail_s->send();
				}
			}
		}
	}

    /*SMS SENDING CODE*/
    /*GET APPROVED SMS TEMPLATE*/
	/* TEXTLOCAL CODE */
	if($setting->get_option('ct_sms_textlocal_status') == "Y")
	{
		if($setting->get_option('ct_sms_textlocal_send_sms_to_client_status') == "Y"){
			$template = $objdashboard->gettemplate_sms("C",'C');
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
		if($setting->get_option('ct_sms_textlocal_send_sms_to_admin_status') == "Y"){
			$template = $objdashboard->gettemplate_sms("C",'A');
			$phone = $setting->get_option('ct_sms_textlocal_admin_phone');				
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
        if($setting->get_option('ct_sms_plivo_status')=="Y"){
           
		   if($setting->get_option('ct_sms_plivo_send_sms_to_client_status') == "Y"){
                $auth_id = $setting->get_option('ct_sms_plivo_account_SID');
				$auth_token = $setting->get_option('ct_sms_plivo_auth_token');
				$p_client = new Plivo\RestAPI($auth_id, $auth_token, '', '');
				$template = $objdashboard->gettemplate_sms("C",'C');
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
                    /* MESSAGE SENDING CODE ENDED HERE*/
                }
            }
            if($setting->get_option('ct_sms_plivo_send_sms_to_admin_status') == "Y"){
                $auth_id = $setting->get_option('ct_sms_plivo_account_SID');
				$auth_token = $setting->get_option('ct_sms_plivo_auth_token');
				$p_admin = new Plivo\RestAPI($auth_id, $auth_token, '', '');
				$template = $objdashboard->gettemplate_sms("C",'A');
                $phone = $admin_phone_plivo;
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
                        'dst' => $phone,
                        'text' => $client_sms_body,
                        'method' => 'POST'
                    );
					$response = $p_admin->send_message($params);
                    /* MESSAGE SENDING CODE ENDED HERE*/
                }
            }
        }
        if($setting->get_option('ct_sms_twilio_status') == "Y"){
            if($setting->get_option('ct_sms_twilio_send_sms_to_client_status') == "Y"){
				$AccountSid = $setting->get_option('ct_sms_twilio_account_SID');
				$AuthToken =  $setting->get_option('ct_sms_twilio_auth_token'); 
				$twilliosms_client = new Services_Twilio($AccountSid, $AuthToken);

				$template = $objdashboard->gettemplate_sms("C",'C');
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
            if($setting->get_option('ct_sms_twilio_send_sms_to_admin_status') == "Y"){
				$AccountSid = $setting->get_option('ct_sms_twilio_account_SID');
				$AuthToken =  $setting->get_option('ct_sms_twilio_auth_token'); 
				$twilliosms_admin = new Services_Twilio($AccountSid, $AuthToken);

				$template = $objdashboard->gettemplate_sms("C",'A');
                $phone = $admin_phone_twilio;
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
                        "To" => $phone,
                        "Body" => $client_sms_body));
                }
            }
        }
		if($setting->get_option('ct_nexmo_status') == "Y"){
			if($setting->get_option('ct_sms_nexmo_send_sms_to_client_status') == "Y"){
				$template = $objdashboard->gettemplate_sms("C",'C');
				$phone = $client_phone;				
				if($template[4] == "E") {
					if($template[2] == ""){
						$message = base64_decode($template[3]);
					}
					else{
						$message = base64_decode($template[2]);
					}
				}
				$ct_nexmo_text = str_replace($searcharray,$replacearray,$message);
				$res=$nexmo_client->send_nexmo_sms($phone,$ct_nexmo_text);
			}
			if($setting->get_option('ct_sms_nexmo_send_sms_to_admin_status') == "Y"){
				$template = $objdashboard->gettemplate_sms("C",'A');
				$phone = $setting->get_option('ct_sms_nexmo_admin_phone_number');				
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
}
elseif(isset($_POST['confirm_booking_cal'])){
    $id = $_POST['id']; /*here id ==order id*/
    $orderdetail = $objdashboard->getclientorder($id);
    $lastmodify = date('Y-m-d H:i:s');
    /* Update Confirm status in bookings */
    $objdashboard->confirm_bookings($id,$lastmodify);

    $clientdetail = $objdashboard->clientemailsender($id);
	
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
   
    $price=$general->ct_price_format($orderdetail[2],$symbol_position,$decimal);

    /* methods */
    $units =  $label_language_values['none'];
    $methodname=$label_language_values['none'];
    $hh = $booking->get_methods_ofbookings($orderdetail[4]);
    $count_methods = mysqli_num_rows($hh);
    $hh1 = $booking->get_methods_ofbookings($orderdetail[4]);

    if($count_methods > 0){
        while($jj = mysqli_fetch_array($hh1)){
            if($units == $label_language_values['none']){
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
    $addons = $label_language_values['none'];
    $hh = $booking->get_addons_ofbookings($orderdetail[4]);
    while($jj = mysqli_fetch_array($hh)){
        if($addons == $label_language_values['none']){
            $addons = $jj['addon_service_name']."-".$jj['addons_service_qty'];
        }
        else
        {
            $addons = $addons.",".$jj['addon_service_name']."-".$jj['addons_service_qty'];
        }
    }


    /*if this is guest user than */
    if($orderdetail[4]==0)
    {
        $gc  = $objdashboard->getguestclient($orderdetail[4]);
        $temppp= unserialize(base64_decode($gc[5]));
        $temp = str_replace('\\','',$temppp);
        $vc_status = $temp['vc_status'];
        if($vc_status == 'N'){
            $final_vc_status = $label_language_values['no'];
        }
        elseif($vc_status == 'Y'){
            $final_vc_status = $label_language_values['yes'];
        }else{
            $final_vc_status = "N/A";
        }
        $p_status = $temp['p_status'];
        if($p_status == 'N'){
            $final_p_status = $label_language_values['no'];
        }
        elseif($p_status == 'Y'){
            $final_p_status = $label_language_values['yes'];
        }else{
            $final_p_status = "N/A";
        }

        $client_name=$gc[2];
        $client_email=$gc[3];
        /* $client_phone=$gc[4]; */
		
		
		$phone_length = strlen($gc[4]);
			
			if($phone_length > 6){
				$client_phone = $gc[4];
			}else{
				$client_phone = "N/A";
			}
			
        $firstname=$client_name;
        $lastname='';
        $booking_status=$orderdetail[6];
        $final_vc_status;
        $final_p_status;
        $payment_status=$orderdetail[5];
        $client_address=$temp['address'];
        $client_notes=$temp['notes'];
        $client_status=$temp['contact_status'];		$client_city = $temp['city'];		$client_state = $temp['state'];		$client_zip	= $temp['zip'];
    }
    else
        /*Registered user */
    {
        $c  = $objdashboard->getguestclient($orderdetail[4]);
        $temppp= unserialize(base64_decode($c[5]));
        $temp = str_replace('\\','',$temppp);
        $vc_status = $temp['vc_status'];
        if($vc_status == 'N'){
            $final_vc_status = $label_language_values['no'];
        }
        elseif($vc_status == 'Y'){
            $final_vc_status = $label_language_values['yes'];
        }else{
            $final_vc_status = "N/A";
        }
        $p_status = $temp['p_status'];
        if($p_status == 'N'){
            $final_p_status = $label_language_values['no'];
        }
        elseif($p_status == 'Y'){
            $final_p_status = $label_language_values['yes'];
        }else{
            $final_p_status = "N/A";
        }
        $client_name=$c[2];
       /*  $firstname=$client_name;
        $lastname=''; */
        $client_email=$c[3];
        /* $client_phone=$c[4]; */
		
		$phone_length = strlen($c[4]);
			
			if($phone_length > 6){
				$client_phone = $c[4];
			}else{
				$client_phone = "N/A";
			}
			
			
			$client_name_value="";
			$client_first_name="";
			$client_last_name="";
			
			$client_name_value= explode(" ",$client_name);
			$client_first_name = $client_name_value[0];
			$client_last_name =	$client_name_value[1];
	
					if($client_first_name=="" && $client_last_name==""){
						$firstname = "User";
						$lastname = "";
						$client_name = $firstname.' '.$lastname;
					}elseif($client_first_name!="" && $client_last_name!=""){
						$firstname = $client_first_name;
						$lastname = $client_last_name;
						$client_name = $firstname.' '.$lastname;
					}elseif($client_first_name!=""){
						$firstname = $client_first_name;
						$lastname = "";
						$client_name = $firstname.' '.$lastname;
					}elseif($client_last_name!=""){
						$firstname = "";
						$lastname = $client_last_name;
						$client_name = $firstname.' '.$lastname;
					}
	
			$client_notes = $temp['notes'];	
					if($client_notes==""){
						$client_notes = "N/A";
					}		
			
			$client_status = $temp['contact_status'];	
					if($client_status==""){
						$client_status = "N/A";
					}	
			
			
			
			
        $payment_status=$orderdetail[5];
        $final_vc_status;
        $final_p_status;
        $client_address=$temp['address'];
       /*  $client_notes=$temp['notes']; */
       /*  $client_status=$temp['contact_status']; */		
		$client_city = $temp['city'];		
		$client_state = $temp['state'];		
		$client_zip	= $temp['zip'];
    }
    $searcharray = array('{{service_name}}','{{booking_date}}','{{business_logo}}','{{business_logo_alt}}','{{client_name}}','{{methodname}}','{{units}}','{{addons}}','{{client_email}}','{{phone}}','{{payment_method}}','{{vaccum_cleaner_status}}','{{parking_status}}','{{notes}}','{{contact_status}}','{{address}}','{{price}}','{{admin_name}}','{{firstname}}','{{lastname}}','{{app_remain_time}}','{{reject_status}}','{{company_name}}','{{booking_time}}','{{client_city}}','{{client_state}}','{{client_zip}}','{{company_city}}','{{company_state}}','{{company_zip}}','{{company_country}}','{{company_phone}}','{{company_email}}','{{company_address}}','{{admin_name}}');

    $replacearray = array($service_name, $booking_date , $business_logo, $business_logo_alt, $client_name,$methodname, $units, $addons,$client_email, $client_phone, $payment_status, $final_vc_status, $final_p_status, $client_notes, $client_status,$client_address,$price,$get_admin_name,$firstname,$lastname,'','',$admin_company_name,$booking_time,$client_city,$client_state,$client_zip,$company_city,$company_state,$company_zip,$company_country,$company_phone,$company_email,$company_address,$get_admin_name);

    $emailtemplate->email_subject="Appointment Approved";
    $emailtemplate->user_type="C";
    $clientemailtemplate=$emailtemplate->readone_client_email_template_body();

    if($clientemailtemplate[2] != ''){
        $clienttemplate = base64_decode($clientemailtemplate[2]);
    }else{
        $clienttemplate = base64_decode($clientemailtemplate[3]);
    }
    $subject=$clientemailtemplate[1];
    /*$clienttemplate=$emailtemplate->readone_client_email_template_body();*/
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
	
    /*** Email Code End ***/

    /*** Email Code Start ***/
    $emailtemplate->email_subject="Appointment Approved";
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
	$staff_ids = $booking->get_staff_ids_from_bookings($id);
	if($staff_ids != ''){
		$staff_idss = explode('',$staff_ids);
		if(sizeof($staff_idss) > 0){
			foreach($staff_idss as $sid){
				$staffdetails = $booking->get_staff_detail_for_email($sid);
				$staff_name = $staffdetails['fullname'];
				$staff_email = $staffdetails['email'];		
						
				$staff_searcharray = array('{{service_name}}','{{booking_date}}','{{business_logo}}','{{business_logo_alt}}','{{client_name}}','{{methodname}}','{{units}}','{{addons}}','{{client_email}}','{{phone}}','{{payment_method}}','{{vaccum_cleaner_status}}','{{parking_status}}','{{notes}}','{{contact_status}}','{{address}}','{{price}}','{{admin_name}}','{{firstname}}','{{lastname}}','{{app_remain_time}}','{{reject_status}}','{{company_name}}','{{booking_time}}','{{client_city}}','{{client_state}}','{{client_zip}}','{{company_city}}','{{company_state}}','{{company_zip}}','{{company_country}}','{{company_phone}}','{{company_email}}','{{company_address}}','{{admin_name}}','{{staff_name}}','{{staff_email}}');
					
				$staff_replacearray = array($service_name, $booking_date , $business_logo, $business_logo_alt, $client_name,$methodname, $units, $addons,$client_email, $client_phone, $payment_status, $final_vc_status, $final_p_status, $client_notes, $client_status,$client_address,$price,$get_admin_name,$firstname,$lastname,'','',$admin_company_name,$booking_time,$client_city,$client_state,$client_zip,$company_city,$company_state,$company_zip,$company_country,$company_phone,$company_email,$company_address,$get_admin_name,$staff_name,$staff_email);
				
				
				$emailtemplate->email_subject="Appointment Approved";
				$emailtemplate->user_type="S";
				$staffemailtemplate=$emailtemplate->readone_client_email_template_body();
				
				if($staffemailtemplate[2] != ''){
					$stafftemplate = base64_decode($staffemailtemplate[2]);
				}else{
					$stafftemplate = base64_decode($staffemailtemplate[3]);
				}
				$subject=$staffemailtemplate[1];
			   
				if($setting->get_option('ct_staff_email_notification_status') == 'Y' && $staffemailtemplate[4]=='E' ){
					$client_email_body = str_replace($staff_searcharray,$staff_replacearray,$stafftemplate);
					if($setting->get_option('ct_smtp_hostname') != '' && $setting->get_option('ct_email_sender_name') != '' && $setting->get_option('ct_email_sender_address') != '' && $setting->get_option('ct_smtp_username') != '' && $setting->get_option('ct_smtp_password') != '' && $setting->get_option('ct_smtp_port') != ''){
						$mail_s->IsSMTP();
					}else{
						$mail_s->IsMail();
					}
					$mail_s->SMTPDebug  = 0;
					$mail_s->IsHTML(true);
					$mail_s->From = $company_email;
					$mail_s->FromName = $company_name;
					$mail_s->Sender = $company_email;
					$mail_s->AddAddress($client_email, $client_name);
					$mail_s->Subject = $subject;
					$mail_s->Body = $client_email_body;
					$mail_s->send();
				}
			}
		}
	}
    /*** Email Code End ***/

    /*SMS SENDING CODE*/
    /*GET APPROVED SMS TEMPLATE*/
	/* TEXTLOCAL CODE */
	if($setting->get_option('ct_sms_textlocal_status') == "Y")
	{
		if($setting->get_option('ct_sms_textlocal_send_sms_to_client_status') == "Y"){
			$template = $objdashboard->gettemplate_sms("C",'C');
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
		if($setting->get_option('ct_sms_textlocal_send_sms_to_admin_status') == "Y"){
			$template = $objdashboard->gettemplate_sms("C",'A');
			$phone = $setting->get_option('ct_sms_textlocal_admin_phone');				
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
    if($setting->get_option('ct_sms_plivo_status')=="Y"){
        if($setting->get_option('ct_sms_plivo_send_sms_to_client_status') == "Y"){
            $auth_id = $setting->get_option('ct_sms_plivo_account_SID');
			$auth_token = $setting->get_option('ct_sms_plivo_auth_token');
			$p_client = new Plivo\RestAPI($auth_id, $auth_token, '', '');

			$template = $objdashboard->gettemplate_sms("C",'C');
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
                print_r($params);
                $response = $p_client->send_message($params);
                /* MESSAGE SENDING CODE ENDED HERE*/
            }
        }
        if($setting->get_option('ct_sms_plivo_send_sms_to_admin_status') == "Y"){
            $auth_id = $setting->get_option('ct_sms_plivo_account_SID');
			$auth_token = $setting->get_option('ct_sms_plivo_auth_token');
			$p_admin = new Plivo\RestAPI($auth_id, $auth_token, '', '');

			$template = $objdashboard->gettemplate_sms("C",'A');
            $phone = $admin_phone_plivo;
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
                    'dst' => $phone,
                    'text' => $client_sms_body,
                    'method' => 'POST'
                );
                $response = $p_admin->send_message($params);
                /* MESSAGE SENDING CODE ENDED HERE*/
            }
        }
    }
    if($setting->get_option('ct_sms_twilio_status') == "Y"){
        if($setting->get_option('ct_sms_twilio_send_sms_to_client_status') == "Y"){
			$AccountSid = $setting->get_option('ct_sms_twilio_account_SID');
			$AuthToken =  $setting->get_option('ct_sms_twilio_auth_token'); 
			$twilliosms_client = new Services_Twilio($AccountSid, $AuthToken);

			$template = $objdashboard->gettemplate_sms("C",'C');
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
        if($setting->get_option('ct_sms_twilio_send_sms_to_admin_status') == "Y"){
			$AccountSid = $setting->get_option('ct_sms_twilio_account_SID');
			$AuthToken =  $setting->get_option('ct_sms_twilio_auth_token'); 
			$twilliosms_admin = new Services_Twilio($AccountSid, $AuthToken);

			$template = $objdashboard->gettemplate_sms("C",'A');
            $phone = $admin_phone_twilio;
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
                    "To" => $phone,
                    "Body" => $client_sms_body));
            }
        }
    }
	if($setting->get_option('ct_nexmo_status') == "Y"){
		if($setting->get_option('ct_sms_nexmo_send_sms_to_client_status') == "Y"){
			$template = $objdashboard->gettemplate_sms("C",'C');
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
		if($setting->get_option('ct_sms_nexmo_send_sms_to_admin_status') == "Y"){
			$template = $objdashboard->gettemplate_sms("C",'A');
			$phone = $setting->get_option('ct_sms_nexmo_admin_phone_number');				
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

}

elseif(isset($_POST['getallnotification'])){
	
    $books = $objdashboard->getallbookings_notify();
    while($b = mysqli_fetch_array($books))
	{
		if($b['read_status'] =='U')
			$col = "#f8f8f8";
		else
			$col = "#fff";
		?>
		<li id="rec-noti-1" class="notificationli" data-orderid="<?php echo $b['order_id'];?>" style="background-color: <?php echo $col;?>" data-toggle="modal" data-target="#booking-details-dashboard">
			<div class="list-inner">
				<?php
				if($b['client_id']==0)
				{
					$gc  = $objdashboard->getguestclient($b['order_id']);
					?>
					<?php
					if($b['booking_status']=='A')
					{
						$booking_stats='<span class="ct-label bg-info br-2">'.$label_language_values['active'].'</span>';
					}
					elseif($b['booking_status']=='C')
					{
						$booking_stats='<span class="ct-label bg-success br-2">'.$label_language_values['confirmed'].'</span>';
					}
					elseif($b['booking_status']=='R')
					{
						$booking_stats='<span class="ct-label bg-danger br-2">'.$label_language_values['rejected'].'</span>';
					}
					elseif($b['booking_status']=='RS')
					{
						$booking_stats='<span class="ct-label bg-primary br-2">'.$label_language_values['rescheduled'].'</span>';
					}
					elseif($b['booking_status']=='CC')
					{
						$booking_stats='<span class="ct-label bg-warning br-2">'.$label_language_values['cancelled_by_client'].'</span>';
					}
					elseif($b['booking_status']=='CS')
					{

						$booking_stats='<span class="ct-label bg-danger br-2">'.$label_language_values['cancelled_by_service_provider'].'</span>';
					}
					elseif($b['booking_status']=='CO')
					{
						$booking_stats='<span class="ct-label bg-success br-2">'.$label_language_values['completed'].'</span>';
					}
					else
					{
						$booking_stats='<span class="ct-label bg-default br-2">'.$label_language_values['mark_as_no_show'].'</span>';
					}
					?>
					<span class="booking-text"><?php echo $booking_stats;?> <?php echo $gc[2]." ".$label_language_values['for_a']." ".$b['title']." ".$label_language_values['on']." ".str_replace($english_date_array,$selected_lang_label,date($getdateformate, strtotime($b['booking_date_time'])));?> @ <?php
					if($time_format == 12){
					?>
					<?php echo date("h:i A", strtotime($b['booking_date_time']));?></span>
					<?php
					}else{
					?>
					<?php echo date("H:i", strtotime($b['booking_date_time']));?></span>
					<?php
					}
					?></span>
					<span class="booking-time">
							<?php
							echo time_elapsed_string($b['lastmodify']);
							?>
							</span>
				<?php
				}
				else
				{
					$c  = $objdashboard->getclient($b['client_id']);
					?>
					<?php
					if($b['booking_status']=='A')
					{
						$booking_stats='<span class="ct-label bg-info br-2">'.$label_language_values['active'].'</span>';
					}
					elseif($b['booking_status']=='C')
					{
						$booking_stats='<span class="ct-label bg-success br-2">'.$label_language_values['confirmed'].'</span>';
					}
					elseif($b['booking_status']=='R')
					{
						$booking_stats='<span class="ct-label bg-danger br-2">'.$label_language_values['rejected'].'</span>';
					}
					elseif($b['booking_status']=='RS')
					{
						$booking_stats='<span class="ct-label bg-primary br-2">'.$label_language_values['rescheduled'].'</span>';
					}
					elseif($b['booking_status']=='CC')
					{
						$booking_stats='<span class="ct-label bg-warning br-2">'.$label_language_values['cancelled_by_client'].'</span>';
					}
					elseif($b['booking_status']=='CS')
					{

						$booking_stats='<span class="ct-label bg-danger br-2">'.$label_language_values['cancelled_by_service_provider'].'</span>';
					}
					elseif($b['booking_status']=='CO')
					{
						$booking_stats='<span class="ct-label bg-success br-2">'.$label_language_values['completed'].'</span>';
					}
					else
					{
						$booking_stats='<span class="ct-label bg-default br-2">'.$label_language_values['mark_as_no_show'].'</span>';
					}
					?>
					<span class="booking-text"><?php echo $booking_stats;?> <?php echo $c[1]." ".$label_language_values['for_a']." ";?>  <?php echo $b['title']." ".$label_language_values['on']." ";?><?php echo str_replace($english_date_array,$selected_lang_label,date($getdateformate, strtotime($b['booking_date_time'])));?> @ <?php
					if($time_format == 12){
					?>
					<?php echo date("h:i A", strtotime($b['booking_date_time']));?></span>
					<?php
					}else{
					?>
					<?php echo date("H:i", strtotime($b['booking_date_time']));?></span>
					<?php
					}
					?></span>
					<span class="booking-time">
							<?php
							echo time_elapsed_string($b['lastmodify']);
							?>
							</span>
				<?php
				}
				?>
			</div>
		</li>
	<?php
	}
}
elseif(isset($_POST['reject_booking'])){
    $id = $_POST['order_id'];
    $reason = $_POST['reject_reason_book'];
	$gc_event_id = $_POST['gc_event_id'];
    $lastmodify = date('Y-m-d H:i:s');
    $objdashboard->reject_bookings($id,$reason,$lastmodify);

	$orderdetail = $objdashboard->getclientorder($id);
    $clientdetail = $objdashboard->clientemailsender($id);

	$pid = $_POST['pid'];
	$gc_staff_event_id = $_POST['gc_staff_event_id'];
	
	if($gc_hook->gc_purchase_status() == 'exist'){
		echo $gc_hook->gc_cancel_reject_booking_hook();
	}
	
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
	/* $admin_name = $clientdetail['fullname']; */
	
	$price=$general->ct_price_format($orderdetail[2],$symbol_position,$decimal);
        
		/* methods */
		$units = $label_language_values['none'];
		$methodname=$label_language_values['none'];
		$hh = $booking->get_methods_ofbookings($orderdetail[4]);
		$count_methods = mysqli_num_rows($hh);
		$hh1 = $booking->get_methods_ofbookings($orderdetail[4]);

		if($count_methods > 0){
			while($jj = mysqli_fetch_array($hh1)){
				if($units == $label_language_values['none']){
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
		$addons = $label_language_values['none'];
		$hh = $booking->get_addons_ofbookings($orderdetail[4]);
		while($jj = mysqli_fetch_array($hh)){
			if($addons == $label_language_values['none']){
				$addons = $jj['addon_service_name']."-".$jj['addons_service_qty'];
			}
			else
			{
				$addons = $addons.",".$jj['addon_service_name']."-".$jj['addons_service_qty'];
			}
		}
																	
		/*if this is guest user than */									
			if($orderdetail[4]==0)
			{
				$gc  = $objdashboard->getguestclient($orderdetail[4]);
				$temppp= unserialize(base64_decode($gc[5]));
				$temp = str_replace('\\','',$temppp);
				$vc_status = $temp['vc_status'];
				if($vc_status == 'N'){
					$final_vc_status = $label_language_values['no'];
				}
				elseif($vc_status == 'Y'){
					$final_vc_status = $label_language_values['yes'];
				}else{
					$final_vc_status = "N/A";
				}
				$p_status = $temp['p_status'];
				if($p_status == 'N'){
					$final_p_status = $label_language_values['no'];
				}
				elseif($p_status == 'Y'){
					$final_p_status = $label_language_values['yes'];
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
				$client_city = $temp['city'];				$client_state = $temp['state'];				$client_zip	= $temp['zip'];
			}
			else
			/*Registered user */
			{
				$c  = $objdashboard->getguestclient($orderdetail[4]);
				
				$temppp= unserialize(base64_decode($c[5]));
				$temp = str_replace('\\','',$temppp);
				$vc_status = $temp['vc_status'];
				if($vc_status == 'N'){
					$final_vc_status = $label_language_values['no'];
				}
				elseif($vc_status == 'Y'){
					$final_vc_status = $label_language_values['yes'];
				}else{
					$final_vc_status = "N/A";
				}
				$p_status = $temp['p_status'];
				if($p_status == 'N'){
					$final_p_status = $label_language_values['no'];
				}
				elseif($p_status == 'Y'){
					$final_p_status = $label_language_values['yes'];
				}else{
					$final_p_status = "N/A";
				}
				/* $client_name=$c[2];
				$firstname=$client_name;
				$lastname=''; */
				$client_email=$c[3];
				
				/* $client_phone=$c[4]; */
				$phone_length = strlen($c[4]);
			
			if($phone_length > 6){
				$client_phone = $c[4];
			}else{
				$client_phone = "N/A";
			}
			
			
			
			
			
			$client_name_value="";
			$client_first_name="";
			$client_last_name="";
						
			/*$client_name_value= explode(" ",$client_name);
			$client_first_name = $client_name_value[0];
			$client_last_name =	$client_name_value[1];*/
			
			$client_namess= explode(" ",$client_name);
			$cnamess = array_filter($client_namess);
			$ccnames = array_values($cnamess);
			if(sizeof($ccnames)>0){
				$client_first_name =  $ccnames[0]; 
				if(isset($ccnames[1])){
					$client_last_name =  $ccnames[1]; 
				}else{
					$client_last_name =  ''; 
				}
			}else{
				$client_first_name =  ''; 
				$client_last_name =  ''; 
			}
					if($client_first_name=="" && $client_last_name==""){
						$firstname = "User";
						$lastname = "";
						$client_name = $firstname.' '.$lastname;
					}elseif($client_first_name!="" && $client_last_name!=""){
						$firstname = $client_first_name;
						$lastname = $client_last_name;
						$client_name = $firstname.' '.$lastname;
					}elseif($client_first_name!=""){
						$firstname = $client_first_name;
						$lastname = "";
						$client_name = $firstname.' '.$lastname;
					}elseif($client_last_name!=""){
						$firstname = "";
						$lastname = $client_last_name;
						$client_name = $firstname.' '.$lastname;
					}
	
			$client_notes = $temp['notes'];	
					if($client_notes==""){
						$client_notes = "N/A";
					}		
			
			$client_status = $temp['contact_status'];	
					if($client_status==""){
						$client_status = "N/A";
					}	
					
				$payment_status=$orderdetail[5];
				$final_vc_status;
				$final_p_status;
				$client_address=$temp['address'];
			/* 	$client_notes=$temp['notes']; */
				/* $client_status=$temp['contact_status'];	 */
				$client_city = $temp['city'];
				$client_state = $temp['state'];		
				$client_zip	= $temp['zip'];
		}					
		$searcharray = array('{{service_name}}','{{booking_date}}','{{business_logo}}','{{business_logo_alt}}','{{client_name}}','{{methodname}}','{{units}}','{{addons}}','{{client_email}}','{{phone}}','{{payment_method}}','{{vaccum_cleaner_status}}','{{parking_status}}','{{notes}}','{{contact_status}}','{{address}}','{{price}}','{{admin_name}}','{{firstname}}','{{lastname}}','{{app_remain_time}}','{{reject_status}}','{{company_name}}','{{booking_time}}','{{client_city}}','{{client_state}}','{{client_zip}}','{{company_city}}','{{company_state}}','{{company_zip}}','{{company_country}}','{{company_phone}}','{{company_email}}','{{company_address}}','{{admin_name}}'); 
		
		$replacearray = array($service_name, $booking_date , $business_logo, $business_logo_alt, $client_name,$methodname, $units, $addons,$client_email, $client_phone, $payment_status, $final_vc_status, $final_p_status, $client_notes, $client_status,$client_address,$price,$get_admin_name,$firstname,$lastname,'',$reason,$admin_company_name,$booking_time,$client_city,$client_state,$client_zip,$company_city,$company_state,$company_zip,$company_country,$company_phone,$company_email,$company_address,$get_admin_name);
		/* Client Email Template */
		$emailtemplate->email_subject="Appointment Rejected";
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
   /* Admin Email template */
		$emailtemplate->email_subject="Appointment Rejected";
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
	
	$staff_ids = $booking->get_staff_ids_from_bookings($id);
	if($staff_ids != ''){
		$staff_idss = explode('',$staff_ids);
		if(sizeof($staff_idss) > 0){
			foreach($staff_idss as $sid){
				$staffdetails = $booking->get_staff_detail_for_email($sid);
				$staff_name = $staffdetails['fullname'];
				$staff_email = $staffdetails['email'];		
						
				$staff_searcharray = array('{{service_name}}','{{booking_date}}','{{business_logo}}','{{business_logo_alt}}','{{client_name}}','{{methodname}}','{{units}}','{{addons}}','{{client_email}}','{{phone}}','{{payment_method}}','{{vaccum_cleaner_status}}','{{parking_status}}','{{notes}}','{{contact_status}}','{{address}}','{{price}}','{{admin_name}}','{{firstname}}','{{lastname}}','{{app_remain_time}}','{{reject_status}}','{{company_name}}','{{booking_time}}','{{client_city}}','{{client_state}}','{{client_zip}}','{{company_city}}','{{company_state}}','{{company_zip}}','{{company_country}}','{{company_phone}}','{{company_email}}','{{company_address}}','{{admin_name}}','{{staff_name}}','{{staff_email}}');
					
				$staff_replacearray = array($service_name, $booking_date , $business_logo, $business_logo_alt, $client_name,$methodname, $units, $addons,$client_email, $client_phone, $payment_status, $final_vc_status, $final_p_status, $client_notes, $client_status,$client_address,$price,$get_admin_name,$firstname,$lastname,'','',$admin_company_name,$booking_time,$client_city,$client_state,$client_zip,$company_city,$company_state,$company_zip,$company_country,$company_phone,$company_email,$company_address,$get_admin_name,$staff_name,$staff_email);
				
				
				$emailtemplate->email_subject="Appointment Rejected";
				$emailtemplate->user_type="S";
				$staffemailtemplate=$emailtemplate->readone_client_email_template_body();
				
				if($staffemailtemplate[2] != ''){
					$stafftemplate = base64_decode($staffemailtemplate[2]);
				}else{
					$stafftemplate = base64_decode($staffemailtemplate[3]);
				}
				$subject=$staffemailtemplate[1];
			   
				if($setting->get_option('ct_staff_email_notification_status') == 'Y' && $staffemailtemplate[4]=='E' ){
					$client_email_body = str_replace($staff_searcharray,$staff_replacearray,$stafftemplate);
					if($setting->get_option('ct_smtp_hostname') != '' && $setting->get_option('ct_email_sender_name') != '' && $setting->get_option('ct_email_sender_address') != '' && $setting->get_option('ct_smtp_username') != '' && $setting->get_option('ct_smtp_password') != '' && $setting->get_option('ct_smtp_port') != ''){
						$mail_s->IsSMTP();
					}else{
						$mail_s->IsMail();
					}
					$mail_s->SMTPDebug  = 0;
					$mail_s->IsHTML(true);
					$mail_s->From = $company_email;
					$mail_s->FromName = $company_name;
					$mail_s->Sender = $company_email;
					$mail_s->AddAddress($client_email, $client_name);
					$mail_s->Subject = $subject;
					$mail_s->Body = $client_email_body;
					$mail_s->send();
				}
			}
		}
	}

    /*** Email Code End ***/
    /*SMS SENDING CODE*/
    /*GET APPROVED SMS TEMPLATE*/
	/* TEXTLOCAL CODE */
	if($setting->get_option('ct_sms_textlocal_status') == "Y")
	{
		if($setting->get_option('ct_sms_textlocal_send_sms_to_client_status') == "Y"){
			$template = $objdashboard->gettemplate_sms("R",'C');
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
		if($setting->get_option('ct_sms_textlocal_send_sms_to_admin_status') == "Y"){
			$template = $objdashboard->gettemplate_sms("R",'A');
			$phone = $setting->get_option('ct_sms_textlocal_admin_phone');				
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
    if($setting->get_option('ct_sms_plivo_status')=="Y"){
        if($setting->get_option('ct_sms_plivo_send_sms_to_client_status') == "Y"){
            $auth_id = $setting->get_option('ct_sms_plivo_account_SID');
			$auth_token = $setting->get_option('ct_sms_plivo_auth_token');
			$p_client = new Plivo\RestAPI($auth_id, $auth_token, '', '');

			$template = $objdashboard->gettemplate_sms("R",'C');
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
                /* MESSAGE SENDING CODE ENDED HERE*/
            }
        }
        if($setting->get_option('ct_sms_plivo_send_sms_to_admin_status') == "Y"){
            $auth_id = $setting->get_option('ct_sms_plivo_account_SID');
			$auth_token = $setting->get_option('ct_sms_plivo_auth_token');
			$p_admin = new Plivo\RestAPI($auth_id, $auth_token, '', '');

			$template = $objdashboard->gettemplate_sms("R",'A');
            $phone = $admin_phone_plivo;
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
                    'dst' => $phone,
                    'text' => $client_sms_body,
                    'method' => 'POST'
                );
                $response = $p_admin->send_message($params);
                /* MESSAGE SENDING CODE ENDED HERE*/
            }
        }
    }
    if($setting->get_option('ct_sms_twilio_status') == "Y"){
        if($setting->get_option('ct_sms_twilio_send_sms_to_client_status') == "Y"){
			$AccountSid = $setting->get_option('ct_sms_twilio_account_SID');
			$AuthToken =  $setting->get_option('ct_sms_twilio_auth_token'); 
			$twilliosms_client = new Services_Twilio($AccountSid, $AuthToken);

			$template = $objdashboard->gettemplate_sms("R",'C');
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
        if($setting->get_option('ct_sms_twilio_send_sms_to_admin_status') == "Y"){
			$AccountSid = $setting->get_option('ct_sms_twilio_account_SID');
			$AuthToken =  $setting->get_option('ct_sms_twilio_auth_token'); 
			$twilliosms_admin = new Services_Twilio($AccountSid, $AuthToken);
			$phone = $admin_phone_twilio;
			$template = $objdashboard->gettemplate_sms("R",'A');
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
                    "To" => $phone,
                    "Body" => $client_sms_body));
            }
        }
    }
	if($setting->get_option('ct_nexmo_status') == "Y"){
		if($setting->get_option('ct_sms_nexmo_send_sms_to_client_status') == "Y"){
			$template = $objdashboard->gettemplate_sms("R",'C');
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
		if($setting->get_option('ct_sms_nexmo_send_sms_to_admin_status') == "Y"){
			$template = $objdashboard->gettemplate_sms("R",'A');
			$phone = $setting->get_option('ct_sms_nexmo_admin_phone_number');				
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
} 
elseif(isset($_POST['delete_booking'])){
    $id = $_POST['id'];
	$pid = $_POST['pid'];
	$gc_event_id = $_POST['gc_event_id'];
	$gc_staff_event_id = $_POST['gc_staff_event_id'];
	
	if($gc_hook->gc_purchase_status() == 'exist'){
		echo $gc_hook->gc_cancel_reject_booking_hook();
	}
    $objdashboard->delete_booking($id);
}
?>