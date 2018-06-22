<?php 

ob_start();
session_start();
include (dirname(dirname(__FILE__)) . '/header.php');
include (dirname(dirname(__FILE__)) . '/objects/class_connection.php');
include (dirname(dirname(__FILE__)) . '/objects/class_users.php');
include (dirname(dirname(__FILE__)) . '/objects/class_order_client_info.php');
include (dirname(dirname(__FILE__)) . '/objects/class_setting.php');
include (dirname(dirname(__FILE__)) . '/objects/class_coupon.php');
include (dirname(dirname(__FILE__)) . '/objects/class_booking.php');
include (dirname(dirname(__FILE__)) . '/objects/class_frequently_discount.php');
include (dirname(dirname(__FILE__)) . '/objects/class_payments.php');
include (dirname(dirname(__FILE__)) . '/objects/class_services.php');
include (dirname(dirname(__FILE__)) . '/objects/class.phpmailer.php');
include (dirname(dirname(__FILE__)) . '/objects/class_general.php');
include (dirname(dirname(__FILE__)) . "/objects/class_dayweek_avail.php");
include (dirname(dirname(__FILE__)) . '/objects/class_front_first_step.php');

$mail = new cleanto_phpmailer();
$mail_a = new cleanto_phpmailer();
$database = new cleanto_db();
$conn = $database->connect();
$database->conn = $conn;
$first_step = new cleanto_first_step();
$first_step->conn = $conn;
$general = new cleanto_general();
$general->conn = $conn;
$user = new cleanto_users();
$order_client_info = new cleanto_order_client_info();
$settings = new cleanto_setting();
$coupon = new cleanto_coupon();
$booking = new cleanto_booking();
$frequently_discount = new cleanto_frequently_discount();
$payment = new cleanto_payments();
$service = new cleanto_services();
$frequently_discount->conn = $conn;
$user->conn = $conn;
$order_client_info->conn = $conn;
$settings->conn = $conn;
$coupon->conn = $conn;
$booking->conn = $conn;
$payment->conn = $conn;
$service->conn = $conn;
$appointment_auto_confirm = $settings->get_option('ct_appointment_auto_confirm_status');
$last_order_id = $booking->last_booking_id();
$symbol_position = $settings->get_option('ct_currency_symbol_position');
$decimal = $settings->get_option('ct_price_format_decimal_places');
$company_email = $settings->get_option('ct_company_email');
$company_name = $settings->get_option('ct_company_name');
$timeavailability = new cleanto_dayweek_avail();
$timeavailability->conn = $conn;
$taxamount = ""; /* add item in to cart */


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


$mail->SMTPSecure = $settings->get_option('ct_smtp_encryption');
$mail->SMTPAuth = $mail_SMTPAuth;

$duration = isset($_POST['units_duration']) ? $_POST['units_duration'] : "0";

if (isset($_POST['add_to_cart']))
	{
	$json_array = array();
	$json_array['method_name'] = $_POST['method_name'];
	$frequently_discount->id = $_POST['frequently_discount_id'];
	$is_hourly = $_SESSION['service_is_hourly'];
	$allow_30  = $_SESSION['service_allow_30'];
	$service_price = $_SESSION['service_price'];
	$freq_dis_data = $frequently_discount->readone();
	$method_name_without_space = '';
	if ($_POST['type'] == 'method_units')
	{
		$method_name_without_space = 'mt_unit' . $_POST['units_id'];
	}
	else
		if ($_POST['type'] == 'addon')
		{
			$method_name_without_space = 'ad_unit' . $_POST['units_id'];
		} /* remove and add item in to cart when multiple qty option is Y for addons */
		if ($_POST['s_m_qty'] == - 1)
		{
			if (isset($_SESSION['ct_cart']['method']))
			{
				$cntss = 1;
				$idss = - 1;
				$_SESSION['ct_cart']['method'] = array_values($_SESSION['ct_cart']['method']);
				for ($i = 0; $i < (count($_SESSION['ct_cart']['method'])); $i++)
				{
					$method_name = "";
					$method_name = array_search($method_name_without_space, $_SESSION['ct_cart']['method'][$i]);
				
					if ($_SESSION['ct_cart']['method'][$i]['method_type'] == $method_name_without_space)
					{
						$idss = $i;
					}
				  	else
					{
						$cntss = $cntss + 1;
					}
				}
			if ($idss != - 1)
				{
				unset($_SESSION['ct_cart']["method"][$idss]);
				$_SESSION['ct_cart']['method'] = array_values($_SESSION['ct_cart']['method']); /**calculation start**/
				$c_rates = 0;
				for ($i = 0; $i < (count($_SESSION['ct_cart']['method'])); $i++)
				{
					$c_rates = ($c_rates + $_SESSION['ct_cart']['method'][$i]['s_m_rate'] * $_SESSION['ct_cart']['method'][$i]['s_m_hour']);
				}

				$frequently_discount->id = $_POST['frequently_discount_id'];
				$freq_dis_data = $frequently_discount->readone();
				if ($freq_dis_data)
				{
					if ($freq_dis_data['d_type'] == 'F')
					{
						$freqdis_amount = $freq_dis_data['rates'];
					}
				  	else
					if ($freq_dis_data['d_type'] == 'P')
					{
						$p_value = $freq_dis_data['rates'] / 100;
						$freqdis_amount = $c_rates * $p_value;
					}
					else
					{
					}
				}
			  	else
				{
					$freqdis_amount = 0;
				}

				$total = ($is_hourly==0) ? ($c_rates + $service_price) : $c_rates;
				$_SESSION['freq_dis_amount'] = $freqdis_amount;
				$final_subtotal = $total - $_SESSION['freq_dis_amount'];
				if ($settings->get_option('ct_tax_vat_status') == 'Y')
					{
					if ($settings->get_option('ct_tax_vat_type') == 'F')
						{
						$flatvalue = $settings->get_option('ct_tax_vat_value');
						$taxamount = $flatvalue;
						}
					elseif ($settings->get_option('ct_tax_vat_type') == 'P')
						{
						$percent = $settings->get_option('ct_tax_vat_value');
						$percentage_value = $percent / 100;
						$taxamount = $percentage_value * $final_subtotal;
						}
					}
				  else
					{
					$taxamount = 0;
					}

				if ($settings->get_option('ct_partial_deposit_status') == 'Y')
					{
					$grand_total = $final_subtotal + $taxamount;
					if ($settings->get_option('ct_partial_type') == 'F')
						{
						$p_deposite_amount = $settings->get_option('ct_partial_deposit_amount');
						$partial_amount = $p_deposite_amount;
						$remain_amount = $grand_total - $partial_amount;
						}
					elseif ($settings->get_option('ct_partial_type') == 'P')
						{
						$p_deposite_amount = $settings->get_option('ct_partial_deposit_amount');
						$percentages = $p_deposite_amount / 100;
						$partial_amount = $grand_total * $percentages;
						$remain_amount = $grand_total - $partial_amount;
						}
					  else
						{
						$partial_amount = 0; 
						$remain_amount = 0; 
						}
					}
				  else
					{
					$partial_amount = 0;
					$remain_amount = 0;
					}

				$json_array['partial_amount'] = $general->ct_price_format($partial_amount, $symbol_position, $decimal);
				$json_array['remain_amount'] = $general->ct_price_format($remain_amount, $symbol_position, $decimal);
				$json_array['frequent_discount'] = '- ' . $general->ct_price_format($_SESSION['freq_dis_amount'], $symbol_position, $decimal);
				$json_array['cart_tax'] = $general->ct_price_format($taxamount, $symbol_position, $decimal);
				$json_array['total_amount'] = $general->ct_price_format(($final_subtotal + $taxamount) , $symbol_position, $decimal);
				$json_array['cart_sub_total'] = $general->ct_price_format($total, $symbol_position, $decimal);
				$json_array['method_name_without_space'] = $method_name_without_space;
				if (count($_SESSION['ct_cart']["method"]) == 0)
					{
					$json_array['status'] = 'empty calculation';
					}
				  else
					{
					$json_array['status'] = 'delete particuler';
					}
				$cartss_counter = '';
				$cartss_statuss = 'unit_not_added';
				
				for($iq=0;$iq<sizeof($_SESSION['ct_cart']['method']);$iq++){
					$check_for_service_addons_availabilities = $booking->check_for_service_addons_availabilities($_SESSION['ct_cart']['method'][$iq]['service_id']);
					
					$check_for_service_units_availabilities = $booking->check_for_service_units_availabilities($_SESSION['ct_cart']['method'][$iq]['service_id'],$_SESSION['ct_cart']['method'][$iq]['method_id']);
					if($check_for_service_addons_availabilities == 0 && $check_for_service_units_availabilities > 0){
						$cartss_counter = 'only_units_exists';
					}elseif($check_for_service_addons_availabilities > 0 && $check_for_service_units_availabilities == 0){
						$cartss_counter = 'only_addons_exists';
					}elseif($check_for_service_addons_availabilities > 0 && $check_for_service_units_availabilities > 0){
						$cartss_counter = 'units_and_addons_both_exists';
						if($_SESSION['ct_cart']['method'][$iq]['type'] == 'method_units'){
							$cartss_statuss = 'unit_added';
						}
					}
				}
				$json_array['unit_require'] = $cartss_statuss;
				$json_array['unit_status'] = $cartss_counter;
				echo json_encode($json_array); /**calculation end**/
				}
			else
				{
				$cartitems = array(
					"service_id" => $_POST['service_id'],
					"method_id" => $_POST['method_id'],
					"units_id" => $_POST['units_id'],
					"s_m_qty" => '1',
					"s_m_rate" => $_POST['s_m_rate'],
					"s_m_hour" => isset($_POST['s_m_hour']) ? $_POST['s_m_hour'] : 1,
					"method_name" => $_POST['method_name'],
					"type" => $_POST['type'],
					"method_type" => $method_name_without_space
				);
				array_push($_SESSION['ct_cart']['method'], $cartitems);
				$json_array['method_name_without_space'] = $method_name_without_space; /* calculation start */
				$_SESSION['ct_cart']['method'] = array_values($_SESSION['ct_cart']['method']);
				$c_rates = 0;
				for ($i = 0; $i < (count($_SESSION['ct_cart']['method'])); $i++)
					{
					$c_rates = ($c_rates + $_SESSION['ct_cart']['method'][$i]['s_m_rate'] * $_SESSION['ct_cart']['method'][$i]['s_m_hour']);
					}

				$frequently_discount->id = $_POST['frequently_discount_id'];
				$freq_dis_data = $frequently_discount->readone();
				if ($freq_dis_data)
					{
					if ($freq_dis_data['d_type'] == 'F')
						{
						$freqdis_amount = $freq_dis_data['rates'];
						}
					  else
					if ($freq_dis_data['d_type'] == 'P')
						{
						$p_value = $freq_dis_data['rates'] / 100;
						$freqdis_amount = $c_rates * $p_value;
						}
					  else
						{
						}
					}
				  else
					{
					$freqdis_amount = 0;
					}

				$total = ($is_hourly==0) ? ($c_rates + $service_price) : $c_rates;
				$_SESSION['freq_dis_amount'] = $freqdis_amount;
				$final_subtotal = $total - $_SESSION['freq_dis_amount'];
				if ($settings->get_option('ct_tax_vat_status') == 'Y')
					{
					if ($settings->get_option('ct_tax_vat_type') == 'F')
						{
						$flatvalue = $settings->get_option('ct_tax_vat_value');
						$taxamount = $flatvalue;
						}
					  else
					if ($settings->get_option('ct_tax_vat_type') == 'P')
						{
						$percent = $settings->get_option('ct_tax_vat_value');
						$percentage_value = $percent / 100;
						$taxamount = $percentage_value * $final_subtotal;
						}
					}
				  else
					{
					$taxamount = 0;
					}

				if ($settings->get_option('ct_partial_deposit_status') == 'Y')
					{
					$grand_total = $final_subtotal + $taxamount;
					if ($settings->get_option('ct_partial_type') == 'F')
						{
						$p_deposite_amount = $settings->get_option('ct_partial_deposit_amount');
						$partial_amount = $p_deposite_amount;
						$remain_amount = $grand_total - $partial_amount;
						}
					elseif ($settings->get_option('ct_partial_type') == 'P')
						{
						$p_deposite_amount = $settings->get_option('ct_partial_deposit_amount');
						$percentages = $p_deposite_amount / 100;
						$partial_amount = $grand_total * $percentages;
						$remain_amount = $grand_total - $partial_amount;
						}
					  else
						{
						$partial_amount = 0; 
						$remain_amount = 0; 
						}
					}
				  else
					{
					$partial_amount = 0;
					$remain_amount = 0;
					}

				$json_array['partial_amount'] = $general->ct_price_format($partial_amount, $symbol_position, $decimal);
				$json_array['remain_amount'] = $general->ct_price_format($remain_amount, $symbol_position, $decimal);
				$json_array['frequent_discount'] = '- ' . $general->ct_price_format($_SESSION['freq_dis_amount'], $symbol_position, $decimal);
				$json_array['cart_tax'] = $general->ct_price_format($taxamount, $symbol_position, $decimal);
				$json_array['total_amount'] = $general->ct_price_format(($final_subtotal + $taxamount) , $symbol_position, $decimal);
				$json_array['cart_sub_total'] = $general->ct_price_format($total, $symbol_position, $decimal); /* calculation end */
				$json_array['s_m_html'] = '<li class="update_qty_of_s_m_' . $method_name_without_space . '" data-service_id="' . $_POST['service_id'] . '" data-method_id="' . $_POST['method_id'] . '" data-units_id="' . $_POST['units_id'] . '"><i data-units_id="' . $_POST['units_id'] . '"data-mnamee="' . $method_name_without_space . '" class="fa fa-times remove_item_from_cart cart_method_name" ></i><div class="ct-item ofh " ><span class="cart_method_name">' . $_POST['method_name'] . '</span> <span class="cart_qty"></span></div><div class="ct-price ofh cart_price">' . $general->ct_price_format_without_symbol($_POST['s_m_rate'] * (isset($_POST['s_m_hour']) ? $_POST['s_m_hour'] : 1), $decimal) . '</div></li>';
				$cartss_counter = '';
				$cartss_statuss = 'unit_not_added';
				for($iq=0;$iq<sizeof($_SESSION['ct_cart']['method']);$iq++){
					$check_for_service_addons_availabilities = $booking->check_for_service_addons_availabilities($_SESSION['ct_cart']['method'][$iq]['service_id']);
					
					$check_for_service_units_availabilities = $booking->check_for_service_units_availabilities($_SESSION['ct_cart']['method'][$iq]['service_id']);
					
					if($check_for_service_addons_availabilities == 0 && $check_for_service_units_availabilities > 0){
						$cartss_counter = 'only_units_exists';
					}elseif($check_for_service_addons_availabilities > 0 && $check_for_service_units_availabilities == 0){
						$cartss_counter = 'only_addons_exists';
					}elseif($check_for_service_addons_availabilities > 0 && $check_for_service_units_availabilities > 0){
						$cartss_counter = 'units_and_addons_both_exists';
						if($_SESSION['ct_cart']['method'][$iq]['type'] == 'method_units'){
							$cartss_statuss = 'unit_added';
						}
					}
				}
				$json_array['unit_require'] = $cartss_statuss;
				$json_array['unit_status'] = $cartss_counter;
				$json_array['status'] = 'insert';
				
				echo json_encode($json_array);
				}
			}
		} /* for delete item into cart */
	  else
	if ($_POST['s_m_qty'] == 0)
		{
		if (isset($_SESSION['ct_cart']['method']))
			{
			$cntss = 1;
			$idss = - 1;
			$_SESSION['ct_cart']['method'] = array_values($_SESSION['ct_cart']['method']);
			for ($i = 0; $i < (count($_SESSION['ct_cart']['method'])); $i++)
				{
				$method_name = "";
				$method_name = array_search($method_name_without_space, $_SESSION['ct_cart']['method'][$i]);
				
				if ($_SESSION['ct_cart']['method'][$i]['method_type'] == $method_name_without_space)
					{
					$idss = $i;
					}
				  else
					{
					$cntss = $cntss + 1;
					}
				}

			if ($idss != - 1)
				{
				unset($_SESSION['ct_cart']["method"][$idss]);
				$_SESSION['ct_cart']['method'] = array_values($_SESSION['ct_cart']['method']); /**calculation start**/
				$c_rates = 0;
				for ($i = 0; $i < (count($_SESSION['ct_cart']['method'])); $i++)
					{
					$c_rates = ($c_rates + $_SESSION['ct_cart']['method'][$i]['s_m_rate'] * $_SESSION['ct_cart']['method'][$i]['s_m_hour']);
					}

				$frequently_discount->id = $_POST['frequently_discount_id'];
				$freq_dis_data = $frequently_discount->readone();
				if ($freq_dis_data)
					{
					if ($freq_dis_data['d_type'] == 'F')
						{
						$freqdis_amount = $freq_dis_data['rates'];
						}
					  else
					if ($freq_dis_data['d_type'] == 'P')
						{
						$p_value = $freq_dis_data['rates'] / 100;
						$freqdis_amount = $c_rates * $p_value;
						}
					  else
						{
						}
					}
				  else
					{
					$freqdis_amount = 0;
					}

				$total = ($is_hourly==0) ? ($c_rates + $service_price) : $c_rates;
				$_SESSION['freq_dis_amount'] = $freqdis_amount;
				$final_subtotal = $total - $_SESSION['freq_dis_amount'];
				if ($settings->get_option('ct_tax_vat_status') == 'Y')
					{
					if ($settings->get_option('ct_tax_vat_type') == 'F')
						{
						$flatvalue = $settings->get_option('ct_tax_vat_value');
						$taxamount = $flatvalue;
						}
					elseif ($settings->get_option('ct_tax_vat_type') == 'P')
						{
						$percent = $settings->get_option('ct_tax_vat_value');
						$percentage_value = $percent / 100;
						$taxamount = $percentage_value * $final_subtotal;
						}
					}
				  else
					{
					$taxamount = 0;
					}

				if ($settings->get_option('ct_partial_deposit_status') == 'Y')
					{
					$grand_total = $final_subtotal + $taxamount;
					if ($settings->get_option('ct_partial_type') == 'F')
						{
						$p_deposite_amount = $settings->get_option('ct_partial_deposit_amount');
						$partial_amount = $p_deposite_amount;
						$remain_amount = $grand_total - $partial_amount;
						}
					elseif ($settings->get_option('ct_partial_type') == 'P')
						{
						$p_deposite_amount = $settings->get_option('ct_partial_deposit_amount');
						$percentages = $p_deposite_amount / 100;
						$partial_amount = $grand_total * $percentages;
						$remain_amount = $grand_total - $partial_amount;
						}
					  else
						{
						$partial_amount = 0; 
						$remain_amount = 0; 
						}
					}
				  else
					{
					$partial_amount = 0;
					$remain_amount = 0;
					}

				$json_array['partial_amount'] = $general->ct_price_format($partial_amount, $symbol_position, $decimal);
				$json_array['remain_amount'] = $general->ct_price_format($remain_amount, $symbol_position, $decimal);
				$json_array['frequent_discount'] = '- ' . $general->ct_price_format($_SESSION['freq_dis_amount'], $symbol_position, $decimal);
				$json_array['cart_tax'] = $general->ct_price_format($taxamount, $symbol_position, $decimal);
				$json_array['total_amount'] = $general->ct_price_format(($final_subtotal + $taxamount) , $symbol_position, $decimal);
				$json_array['cart_sub_total'] = $general->ct_price_format($total, $symbol_position, $decimal);
				$json_array['method_name_without_space'] = $method_name_without_space;
				if (count($_SESSION['ct_cart']["method"]) == 0)
					{
					$json_array['status'] = 'empty calculation';
					}
				  else
					{
					$json_array['status'] = 'delete particuler';
					}
				/**$cartss_counter = '';
				$cartss_statuss = 'unit_not_added';
				for($iq=0;$iq<sizeof($_SESSION['ct_cart']['method']);$iq++){
					$check_for_service_addons_availabilities = $booking->check_for_service_addons_availabilities($_SESSION['ct_cart']['method'][$iq]['service_id']);
					
					$check_for_service_units_availabilities = $booking->check_for_service_units_availabilities($_SESSION['ct_cart']['method'][$iq]['service_id'],$_SESSION['ct_cart']['method'][$iq]['method_id']);
					if($check_for_service_addons_availabilities == 0 && $check_for_service_units_availabilities > 0){
						$cartss_counter = 'only_units_exists';
					}elseif($check_for_service_addons_availabilities > 0 && $check_for_service_units_availabilities == 0){
						$cartss_counter = 'only_addons_exists';
					}elseif($check_for_service_addons_availabilities > 0 && $check_for_service_units_availabilities > 0){
						$cartss_counter = 'units_and_addons_both_exists';
						if($_SESSION['ct_cart']['method'][$iq]['type'] == 'method_units'){
							$cartss_statuss = 'unit_added';
						}
					}
				}
				$json_array['unit_require'] = $cartss_statuss;
				$json_array['unit_status'] = $cartss_counter;
				echo json_encode($json_array); calculation end**/
				}
				$cartss_counter = '';
				$cartss_statuss = 'unit_not_added';
				for($iq=0;$iq<sizeof($_SESSION['ct_cart']['method']);$iq++){
					$check_for_service_addons_availabilities = $booking->check_for_service_addons_availabilities($_SESSION['ct_cart']['method'][$iq]['service_id']);
					
					$check_for_service_units_availabilities = $booking->check_for_service_units_availabilities($_SESSION['ct_cart']['method'][$iq]['service_id'],$_SESSION['ct_cart']['method'][$iq]['method_id']);
					if($check_for_service_addons_availabilities == 0 && $check_for_service_units_availabilities > 0){
						$cartss_counter = 'only_units_exists';
					}elseif($check_for_service_addons_availabilities > 0 && $check_for_service_units_availabilities == 0){
						$cartss_counter = 'only_addons_exists';
					}elseif($check_for_service_addons_availabilities > 0 && $check_for_service_units_availabilities > 0){
						$cartss_counter = 'units_and_addons_both_exists';
						if($_SESSION['ct_cart']['method'][$iq]['type'] == 'method_units'){
							$cartss_statuss = 'unit_added';
						}
					}
				}
				$json_array['unit_require'] = $cartss_statuss;
				$json_array['unit_status'] = $cartss_counter;
				echo json_encode($json_array); /**calculation end**/
			}
		}
	else
		{ /* for first time add item into cart when cart is empty */
		if (isset($_SESSION['ct_cart']["method"]) && count($_SESSION['ct_cart']["method"]) == 0)
			{
			$s_m_hour = isset($_POST['s_m_hour']) ? $_POST['s_m_hour'] : 1;
			$cartitems = array(
				"service_id" => $_POST['service_id'],
				"method_id" => $_POST['method_id'],
				"units_id" => $_POST['units_id'],
				"s_m_qty" => $_POST['s_m_qty'],
				"s_m_rate" => $_POST['s_m_rate'],
				"s_m_hour" => $s_m_hour,
				"method_name" => $_POST['method_name'],
				"type" => $_POST['type'],
				's_m_duration' => $_SESSION['service_is_hourly'] ? $s_m_hour : $duration,
				"method_type" => $method_name_without_space
			);

			array_push($_SESSION['ct_cart']["method"], $cartitems);
			$json_array['service_id'] = $_POST['service_id'];
			$json_array['method_id'] = $_POST['method_id'];
			$json_array['units_id'] = $_POST['units_id'];
			$json_array['s_m_qty'] = $_POST['s_m_qty'];
			$json_array['s_m_rate'] = $_POST['s_m_rate']; /**calculation start**/
			$json_array['s_m_hour'] = isset($_POST['s_m_hour']) ? $_POST['s_m_hour'] : 1;
			$json_array['s_m_duration'] = $_SESSION['service_is_hourly'] ? $s_m_hour : $duration;

			if ($freq_dis_data)
				{
				if ($freq_dis_data['d_type'] == 'F')
					{
					$freqdis_amount = $freq_dis_data['rates'];
					}
				  else
				if ($freq_dis_data['d_type'] == 'P')
					{
					$p_value = $freq_dis_data['rates'] / 100;
					$freqdis_amount = $_POST['s_m_rate'] * $p_value;
					}
				  else
					{
					}
				}
			  else
				{
				$freqdis_amount = 0;
				}

			$total = $_POST['s_m_rate'] * (isset($_POST['s_m_hour']) ? $_POST['s_m_hour'] : 1);
			if ($is_hourly==0) 
				$total += $service_price;
			$_SESSION['freq_dis_amount'] = $freqdis_amount;
			$final_subtotal = $total - $_SESSION['freq_dis_amount'];
			if ($settings->get_option('ct_tax_vat_status') == 'Y')
				{
				if ($settings->get_option('ct_tax_vat_type') == 'F')
					{
					$flatvalue = $settings->get_option('ct_tax_vat_value');
					$taxamount = $flatvalue;
					}
				elseif ($settings->get_option('ct_tax_vat_type') == 'P')
					{
					$percent = $settings->get_option('ct_tax_vat_value');
					$percentage_value = $percent / 100;
					$taxamount = $percentage_value * $final_subtotal;
					}
				}
			  else
				{
				$taxamount = 0;
				}

			if ($settings->get_option('ct_partial_deposit_status') == 'Y')
				{
				$grand_total = $final_subtotal + $taxamount;
				if ($settings->get_option('ct_partial_type') == 'F')
					{
					$p_deposite_amount = $settings->get_option('ct_partial_deposit_amount');
					$partial_amount = $p_deposite_amount;
					$remain_amount = $grand_total - $partial_amount;
					}
				elseif ($settings->get_option('ct_partial_type') == 'P')
					{
					$p_deposite_amount = $settings->get_option('ct_partial_deposit_amount');
					$percentages = $p_deposite_amount / 100;
					$partial_amount = $grand_total * $percentages;
					$remain_amount = $grand_total - $partial_amount;
					}
				  else
					{
					$partial_amount = 0; 
					$remain_amount = 0; 
					}
				}
			  else
				{
				$partial_amount = 0;
				$remain_amount = 0;
				}

			$json_array['partial_amount'] = $general->ct_price_format($partial_amount, $symbol_position, $decimal);
			$json_array['remain_amount'] = $general->ct_price_format($remain_amount, $symbol_position, $decimal);
			$json_array['frequent_discount'] = '- ' . $general->ct_price_format($_SESSION['freq_dis_amount'], $symbol_position, $decimal);
			$json_array['cart_tax'] = $general->ct_price_format($taxamount, $symbol_position, $decimal);
			$json_array['total_amount'] = $general->ct_price_format(($final_subtotal + $taxamount) , $symbol_position, $decimal);
			$json_array['cart_sub_total'] = $general->ct_price_format($total, $symbol_position, $decimal); /**calculation end**/
			$json_array['method_name'] = $_POST['method_name'];
			$json_array['method_name_without_space'] = $method_name_without_space;
			$json_array['s_m_html'] = '<li class="update_qty_of_s_m_' . $method_name_without_space . '" data-service_id="' . $_POST['service_id'] . '" data-method_id="' . $_POST['method_id'] . '" data-units_id="' . $_POST['units_id'] . '" data-mnamee="' . $_POST['method_name'] . '"><i data-units_id="' . $_POST['units_id'] . '"data-mnamee="' . $method_name_without_space . '" class="fa fa-times remove_item_from_cart cart_method_name" ></i><div class="ct-item ofh"><span class="cart_method_name">' . $_POST['method_name'] . '</span> - <span class="cart_qty">' . $_POST['s_m_qty'] . '</span></div><div class="ct-price ofh cart_price">' . $general->ct_price_format_without_symbol($_POST['s_m_rate'], $decimal) . '</div></li>';
			$json_array['status'] = 'firstinsert';
			$cartss_counter = '';
			$cartss_statuss = 'unit_not_added';
				for($iq=0;$iq<sizeof($_SESSION['ct_cart']['method']);$iq++){
					$check_for_service_addons_availabilities = $booking->check_for_service_addons_availabilities($_SESSION['ct_cart']['method'][$iq]['service_id']);
					
					$check_for_service_units_availabilities = $booking->check_for_service_units_availabilities($_SESSION['ct_cart']['method'][$iq]['service_id'],$_SESSION['ct_cart']['method'][$iq]['method_id']);
					if($check_for_service_addons_availabilities == 0 && $check_for_service_units_availabilities > 0){
						$cartss_counter = 'only_units_exists';
					}elseif($check_for_service_addons_availabilities > 0 && $check_for_service_units_availabilities == 0){
						$cartss_counter = 'only_addons_exists';
					}elseif($check_for_service_addons_availabilities > 0 && $check_for_service_units_availabilities > 0){
						$cartss_counter = 'units_and_addons_both_exists';
						if($_SESSION['ct_cart']['method'][$iq]['type'] == 'method_units'){
							$cartss_statuss = 'unit_added';
						}
					}
				}
				$json_array['unit_require'] = $cartss_statuss;
				$json_array['unit_status'] = $cartss_counter;
			echo json_encode($json_array);
			}
		else
			{
			$cnt = 1;
			$id = - 1;
			$_SESSION['ct_cart']['method'] = array_values($_SESSION['ct_cart']['method']);
			
			for ($i = 0; $i < (count($_SESSION['ct_cart']['method'])); $i++)
				{
				$method_name = "";
				$method_name = array_search($method_name_without_space, $_SESSION['ct_cart']['method'][$i]);
				
				if ($_SESSION['ct_cart']['method'][$i]['method_type'] == $method_name_without_space)
					{
					$id = $i;
					}
				  else
					{
					$cnt = $cnt + 1;
					}
				} /* for update existing item into cart */
			if ($id != - 1)
				{
				$_SESSION['ct_cart']["method"][$id]['service_id'] = $_POST['service_id'];
				$_SESSION['ct_cart']["method"][$id]['method_id'] = $_POST['method_id'];
				$_SESSION['ct_cart']["method"][$id]['units_id'] = $_POST['units_id'];
				$_SESSION['ct_cart']["method"][$id]['s_m_qty'] = $_POST['s_m_qty'];
				$_SESSION['ct_cart']["method"][$id]['s_m_rate'] = $_POST['s_m_rate'];
				$_SESSION['ct_cart']["method"][$id]['s_m_hour'] = isset($_POST['s_m_hour']) ? $_POST['s_m_hour'] : 1;
				$_SESSION['ct_cart']["method"][$id]['s_m_duration'] = $_SESSION['service_is_hourly'] ? (isset($_POST['s_m_hour']) ? $_POST['s_m_hour'] : 0) : $duration;
				$_SESSION['ct_cart']["method"][$id]['method_name'] = $_POST['method_name'];
				$_SESSION['ct_cart']["method"][$id]['type'] = $_POST['type'];
				$json_array['service_id'] = $_POST['service_id'];
				$json_array['method_id'] = $_POST['method_id'];
				$json_array['units_id'] = $_POST['units_id'];
				$json_array['s_m_qty'] = $_POST['s_m_qty'];
				$json_array['s_m_rate'] = $_POST['s_m_rate'];
				$json_array['s_m_hour'] = isset($_POST['s_m_hour']) ? $_POST['s_m_hour'] : 1;
				$json_array['method_name'] = $_POST['method_name'];
				$json_array['method_name_without_space'] = $method_name_without_space; /* calculation start */
				$_SESSION['ct_cart']['method'] = array_values($_SESSION['ct_cart']['method']);
				$c_rates = 0;
				$durations = 0;
				for ($i = 0; $i < (count($_SESSION['ct_cart']['method'])); $i++)
				{
					$c_rates = ($c_rates + $_SESSION['ct_cart']['method'][$i]['s_m_rate'] * $_SESSION['ct_cart']['method'][$i]['s_m_hour']);
					$durations += isset($_SESSION['ct_cart']['method'][$i]['s_m_duration']) ? $_SESSION['ct_cart']['method'][$i]['s_m_duration'] : 0;
				}
				$json_array['s_m_duration'] = $durations;
				$frequently_discount->id = $_POST['frequently_discount_id'];
				$freq_dis_data = $frequently_discount->readone();
				if ($freq_dis_data)
					{
					if ($freq_dis_data['d_type'] == 'F')
						{
						$freqdis_amount = $freq_dis_data['rates'];
						}
					  else
					if ($freq_dis_data['d_type'] == 'P')
						{
						$p_value = $freq_dis_data['rates'] / 100;
						$freqdis_amount = $c_rates * $p_value;
						}
					  else
						{
						}
					}
				  else
					{
					$freqdis_amount = 0;
					}

				$total = ($is_hourly==0) ? ($c_rates + $service_price) : $c_rates;
				$_SESSION['freq_dis_amount'] = $freqdis_amount;
				$final_subtotal = $total - $_SESSION['freq_dis_amount'];
				if ($settings->get_option('ct_tax_vat_status') == 'Y')
					{
					if ($settings->get_option('ct_tax_vat_type') == 'F')
						{
						$flatvalue = $settings->get_option('ct_tax_vat_value');
						$taxamount = $flatvalue;
						}
					elseif ($settings->get_option('ct_tax_vat_type') == 'P')
						{
						$percent = $settings->get_option('ct_tax_vat_value');
						$percentage_value = $percent / 100;
						$taxamount = $percentage_value * $final_subtotal;
						}
					}
				  else
					{
					$taxamount = 0;
					}

				if ($settings->get_option('ct_partial_deposit_status') == 'Y')
					{
					$grand_total = $final_subtotal + $taxamount;
					if ($settings->get_option('ct_partial_type') == 'F')
						{
						$p_deposite_amount = $settings->get_option('ct_partial_deposit_amount');
						$partial_amount = $p_deposite_amount;
						$remain_amount = $grand_total - $partial_amount;
						}
					elseif ($settings->get_option('ct_partial_type') == 'P')
						{
						$p_deposite_amount = $settings->get_option('ct_partial_deposit_amount');
						$percentages = $p_deposite_amount / 100;
						$partial_amount = $grand_total * $percentages;
						$remain_amount = $grand_total - $partial_amount;
						}
					  else
						{
						$partial_amount = 0; 
						$remain_amount = 0; 
						}
					}
				  else
					{
					$partial_amount = 0;
					$remain_amount = 0;
					}

				$json_array['partial_amount'] = $general->ct_price_format($partial_amount, $symbol_position, $decimal);
				$json_array['remain_amount'] = $general->ct_price_format($remain_amount, $symbol_position, $decimal);
				$json_array['frequent_discount'] = '- ' . $general->ct_price_format($_SESSION['freq_dis_amount'], $symbol_position, $decimal);
				$json_array['cart_tax'] = $general->ct_price_format($taxamount, $symbol_position, $decimal);
				$json_array['total_amount'] = $general->ct_price_format(($final_subtotal + $taxamount) , $symbol_position, $decimal);
				$json_array['cart_sub_total'] = $general->ct_price_format($total, $symbol_position, $decimal); /* calculation end */
				$json_array['s_m_html'] = '<div class="ct-item ofh"><i data-units_id="' . $_POST['units_id'] . '"data-mnamee="' . $method_name_without_space . '" class="fa fa-times remove_item_from_cart cart_method_name"></i><span class="cart_method_name">' . $_POST['method_name'] . '</span> - <span class="cart_qty">' . $_POST['s_m_qty'] . '</span></div><div class="ct-price ofh cart_price">' . $general->ct_price_format_without_symbol($_POST['s_m_rate'] * (isset($_POST['s_m_hour']) ? $_POST['s_m_hour'] : 1), $decimal) . '</div>';
				$json_array['status'] = 'update';
				$cartss_counter = '';
				$cartss_statuss = 'unit_not_added';
				for($iq=0;$iq<sizeof($_SESSION['ct_cart']['method']);$iq++){
					$check_for_service_addons_availabilities = $booking->check_for_service_addons_availabilities($_SESSION['ct_cart']['method'][$iq]['service_id']);
					
					$check_for_service_units_availabilities = $booking->check_for_service_units_availabilities($_SESSION['ct_cart']['method'][$iq]['service_id'],$_SESSION['ct_cart']['method'][$iq]['method_id']);
					if($check_for_service_addons_availabilities == 0 && $check_for_service_units_availabilities > 0){
						$cartss_counter = 'only_units_exists';
					}elseif($check_for_service_addons_availabilities > 0 && $check_for_service_units_availabilities == 0){
						$cartss_counter = 'only_addons_exists';
					}elseif($check_for_service_addons_availabilities > 0 && $check_for_service_units_availabilities > 0){
						$cartss_counter = 'units_and_addons_both_exists';
						if($_SESSION['ct_cart']['method'][$iq]['type'] == 'method_units'){
							$cartss_statuss = 'unit_added';
						}
					}
				}
				$json_array['unit_require'] = $cartss_statuss;
				$json_array['unit_status'] = $cartss_counter;
				echo json_encode($json_array);
				} /* for insert new items into cart */
		  	else
				{
				$cartitems = array(
					"service_id" => $_POST['service_id'],
					"method_id" => $_POST['method_id'],
					"units_id" => $_POST['units_id'],
					"s_m_qty" => $_POST['s_m_qty'],
					"s_m_rate" => $_POST['s_m_rate'],
					"s_m_hour" => isset($_POST['s_m_hour']) ? $_POST['s_m_hour'] : 1,
					"s_m_duration" => $_SESSION['service_is_hourly'] ? (isset($_POST['s_m_hour']) ? $_POST['s_m_hour'] : 0) : $duration,
					"method_name" => $_POST['method_name'],
					"type" => $_POST['type'],
					"method_type" => $method_name_without_space
				);
				array_push($_SESSION['ct_cart']['method'], $cartitems);
				$json_array['service_id'] = $_POST['service_id'];
				$json_array['method_id'] = $_POST['method_id'];
				$json_array['units_id'] = $_POST['units_id'];
				$json_array['s_m_qty'] = $_POST['s_m_qty'];
				$json_array['s_m_rate'] = $_POST['s_m_rate'];
				$json_array['s_m_hour'] = isset($_POST['s_m_hour']) ? $_POST['s_m_hour'] : 1;
				$json_array['method_name'] = $_POST['method_name'];
				$json_array['method_name_without_space'] = $method_name_without_space; /* calculation start */
				$_SESSION['ct_cart']['method'] = array_values($_SESSION['ct_cart']['method']);
				$c_rates = 0;
				$durations = 0;
				for ($i = 0; $i < (count($_SESSION['ct_cart']['method'])); $i++)
					{
					$c_rates = ($c_rates + $_SESSION['ct_cart']['method'][$i]['s_m_rate'] * $_SESSION['ct_cart']['method'][$i]['s_m_hour']);
					$durations += isset($_SESSION['ct_cart']['method'][$i]['s_m_duration']) ? $_SESSION['ct_cart']['method'][$i]['s_m_duration'] : 0;
					}
				$json_array['s_m_duration'] = $durations;
				$frequently_discount->id = $_POST['frequently_discount_id'];
				$freq_dis_data = $frequently_discount->readone();
				if ($freq_dis_data)
					{
					if ($freq_dis_data['d_type'] == 'F')
						{
						$freqdis_amount = $freq_dis_data['rates'];
						}
					  else
					if ($freq_dis_data['d_type'] == 'P')
						{
						$p_value = $freq_dis_data['rates'] / 100;
						$freqdis_amount = $c_rates * $p_value;
						}
					  else
						{
						}
					}
				  else
					{
					$freqdis_amount = 0;
					}

				$total = ($is_hourly==0) ? ($c_rates + $service_price) : $c_rates;
				$_SESSION['freq_dis_amount'] = $freqdis_amount;
				$final_subtotal = $total - $_SESSION['freq_dis_amount'];
				if ($settings->get_option('ct_tax_vat_status') == 'Y')
					{
					if ($settings->get_option('ct_tax_vat_type') == 'F')
						{
						$flatvalue = $settings->get_option('ct_tax_vat_value');
						$taxamount = $flatvalue;
						}
					  else
					if ($settings->get_option('ct_tax_vat_type') == 'P')
						{
						$percent = $settings->get_option('ct_tax_vat_value');
						$percentage_value = $percent / 100;
						$taxamount = $percentage_value * $final_subtotal;
						}
					}
				  else
					{
					$taxamount = 0;
					}

				if ($settings->get_option('ct_partial_deposit_status') == 'Y')
					{
					$grand_total = $final_subtotal + $taxamount;
					if ($settings->get_option('ct_partial_type') == 'F')
						{
						$p_deposite_amount = $settings->get_option('ct_partial_deposit_amount');
						$partial_amount = $p_deposite_amount;
						$remain_amount = $grand_total - $partial_amount;
						}
					elseif ($settings->get_option('ct_partial_type') == 'P')
						{
						$p_deposite_amount = $settings->get_option('ct_partial_deposit_amount');
						$percentages = $p_deposite_amount / 100;
						$partial_amount = $grand_total * $percentages;
						$remain_amount = $grand_total - $partial_amount;
						}
					  else
						{
						$partial_amount = 0; 
						$remain_amount = 0; 
						}
					}
				  else
					{
					$partial_amount = 0;
					$remain_amount = 0;
					}

				$json_array['partial_amount'] = $general->ct_price_format($partial_amount, $symbol_position, $decimal);
				$json_array['remain_amount'] = $general->ct_price_format($remain_amount, $symbol_position, $decimal);
				$json_array['frequent_discount'] = '- ' . $general->ct_price_format($_SESSION['freq_dis_amount'], $symbol_position, $decimal);
				$json_array['cart_tax'] = $general->ct_price_format($taxamount, $symbol_position, $decimal);
				$json_array['total_amount'] = $general->ct_price_format(($final_subtotal + $taxamount) , $symbol_position, $decimal);
				$json_array['cart_sub_total'] = $general->ct_price_format($total, $symbol_position, $decimal); /* calculation end */
				$json_array['s_m_html'] = '<li class="update_qty_of_s_m_' . $method_name_without_space . '" data-service_id="' . $_POST['service_id'] . '" data-method_id="' . $_POST['method_id'] . '" data-units_id="' . $_POST['units_id'] . '"><i data-units_id="' . $_POST['units_id'] . '"data-mnamee="' . $method_name_without_space . '" class="fa fa-times remove_item_from_cart cart_method_name" ></i><div class="ct-item ofh" ><span class="cart_method_name">' . $_POST['method_name'] . '</span> - <span class="cart_qty">' . $_POST['s_m_qty'] . '</span></div><div class="ct-price ofh cart_price">' . $general->ct_price_format_without_symbol($_POST['s_m_rate'] * (isset($_POST['s_m_hour']) ? $_POST['s_m_hour'] : 1), $decimal) . '</div></li>';
				$cartss_counter = '';
				$cartss_statuss = 'unit_not_added';
				for($iq=0;$iq<sizeof($_SESSION['ct_cart']['method']);$iq++){
					
					$check_for_service_addons_availabilities = $booking->check_for_service_addons_availabilities($_SESSION['ct_cart']['method'][$iq]['service_id']);
					
					$check_for_service_units_availabilities = $booking->check_for_service_units_availabilities($_SESSION['ct_cart']['method'][$iq]['service_id'],$_SESSION['ct_cart']['method'][$iq]['method_id']);
					if($check_for_service_addons_availabilities == 0 && $check_for_service_units_availabilities > 0){
						$cartss_counter = 'only_units_exists';
					}elseif($check_for_service_addons_availabilities > 0 && $check_for_service_units_availabilities == 0){
						$cartss_counter = 'only_addons_exists';
					}elseif($check_for_service_addons_availabilities > 0 && $check_for_service_units_availabilities > 0){
						$cartss_counter = 'units_and_addons_both_exists';
						if($_SESSION['ct_cart']['method'][$iq]['type'] == 'method_units'){
							$cartss_statuss = 'unit_added';
						}
					}
				}
				$json_array['unit_require'] = $cartss_statuss;
				$json_array['unit_status'] = $cartss_counter;
				$json_array['status'] = 'insert';
				echo json_encode($json_array);
				}
			}
		}
	} /* code for apply coupon */
elseif (isset($_POST['coupon_check']))
	{
	$jsonn_array = array();
	$_SESSION['ct_cart']['method'] = array_values($_SESSION['ct_cart']['method']);
	$c_rates = 0;
	for ($i = 0; $i < (count($_SESSION['ct_cart']['method'])); $i++)
		{
		$c_rates = ($c_rates + $_SESSION['ct_cart']['method'][$i]['s_m_rate'] * $_SESSION['ct_cart']['method'][$i]['s_m_hour']);
		}

	$frequently_discount->id = $_POST['frequently_discount_id'];
	$freq_dis_data = $frequently_discount->readone();
	if ($freq_dis_data)
		{
		if ($freq_dis_data['d_type'] == 'F')
			{
			$freqdis_amount = $freq_dis_data['rates'];
			}
		  else
		if ($freq_dis_data['d_type'] == 'P')
			{
			$p_value = $freq_dis_data['rates'] / 100;
			$freqdis_amount = $c_rates * $p_value;
			}
		  else
			{
			}
		}
	  else
		{
		$freqdis_amount = 0;
		}

	$totals = $c_rates;
	$_SESSION['freq_dis_amount'] = $freqdis_amount;
	$allover_totals = $totals - $_SESSION['freq_dis_amount'];
	if ($_POST['coupon_code'] != '')
		{
		$coupon->coupon_code = $_POST['coupon_code'];
		$result = $coupon->checkcode();
		if ($result)
			{
			$coupon_exp_date = strtotime($result['coupon_expiry']);
			$today = date("Y-m-d");
			$curr_date = strtotime($today);
			if ($result['coupon_used'] < $result['coupon_limit'] && $curr_date <= $coupon_exp_date)
				{
				if ($result['coupon_type'] == 'F')
					{
					$discount_values = $result['coupon_value'];
					}
				  else
				if ($result['coupon_type'] == 'P')
					{
					$percent = $result['coupon_value'];
					$percentage_value = $percent / 100;
					$discount_values = $percentage_value * $allover_totals;
					}

				$final_subtotal = $allover_totals - $discount_values;
				if ($settings->get_option('ct_tax_vat_status') == 'Y')
					{
					if ($settings->get_option('ct_tax_vat_type') == 'F')
						{
						$flatvalue = $settings->get_option('ct_tax_vat_value');
						$taxamount = $flatvalue;
						}
					  else
					if ($settings->get_option('ct_tax_vat_type') == 'P')
						{
						$percent = $settings->get_option('ct_tax_vat_value');
						$percentage_value = $percent / 100;
						$taxamount = $percentage_value * $final_subtotal;
						}
					}
				  else
					{
					$taxamount = 0;
					}

				if ($settings->get_option('ct_partial_deposit_status') == 'Y')
					{
					$grand_total = $final_subtotal + $taxamount;
					if ($settings->get_option('ct_partial_type') == 'F')
						{
						$p_deposite_amount = $settings->get_option('ct_partial_deposit_amount');
						$partial_amount = $p_deposite_amount;
						$remain_amount = $grand_total - $partial_amount;
						}
					elseif ($settings->get_option('ct_partial_type') == 'P')
						{
						$p_deposite_amount = $settings->get_option('ct_partial_deposit_amount');
						$percentages = $p_deposite_amount / 100;
						$partial_amount = $grand_total * $percentages;
						$remain_amount = $grand_total - $partial_amount;
						}
					  else
						{
						$partial_amount = 0; 
						$remain_amount = 0; 
						}
					}
				  else
					{
					$partial_amount = 0;
					$remain_amount = 0;
					}

				$jsonn_array['partial_amount'] = $general->ct_price_format($partial_amount, $symbol_position, $decimal);
				$jsonn_array['remain_amount'] = $general->ct_price_format($remain_amount, $symbol_position, $decimal);
				$jsonn_array['discount_status'] = "available";
				$jsonn_array['cart_discount'] = $general->ct_price_format($discount_values, $symbol_position, $decimal);
				$jsonn_array['cart_tax'] = $general->ct_price_format($taxamount, $symbol_position, $decimal);
				$jsonn_array['frequent_discount'] = '- ' . $general->ct_price_format($_SESSION['freq_dis_amount'], $symbol_position, $decimal);
				$jsonn_array['total_amount'] = $general->ct_price_format(($final_subtotal + $taxamount) , $symbol_position, $decimal);
				$jsonn_array['cart_sub_total'] = $general->ct_price_format($totals, $symbol_position, $decimal);
				echo json_encode($jsonn_array);
				}
			  else
				{
				$jsonn_array['discount_status'] = "not";
				echo json_encode($jsonn_array);
				}
			}
		  else
			{
			$jsonn_array['discount_status'] = "wrongcode";
			echo json_encode($jsonn_array);
			}
		}
	} /* Below code is use for reverse coupon */
elseif (isset($_POST['coupon_reversed']))
	{
	$jsonnn_array = array();
	$frequently_discount->id = $_POST['frequently_discount_id'];
	$freq_dis_data = $frequently_discount->readone();
	$coupon->coupon_code = $_POST['coupon_reverse'];
	$result = $coupon->checkcode();
	if ($result['coupon_used'] >= 0)
		{
		$_SESSION['ct_cart']['method'] = array_values($_SESSION['ct_cart']['method']);
		$c_rates = 0;
		for ($i = 0; $i < (count($_SESSION['ct_cart']['method'])); $i++)
			{
			$c_rates = ($c_rates + $_SESSION['ct_cart']['method'][$i]['s_m_rate'] * $_SESSION['ct_cart']['method'][$i]['s_m_hour']);
			}

		if ($freq_dis_data)
			{
			if ($freq_dis_data['d_type'] == 'F')
				{
				$freqdis_amount = $freq_dis_data['rates'];
				}
			  else
			if ($freq_dis_data['d_type'] == 'P')
				{
				$p_value = $freq_dis_data['rates'] / 100;
				$freqdis_amount = $c_rates * $p_value;
				}
			  else
				{
				}
			}
		  else
			{
			$freqdis_amount = 0;
			}

		$totals = $c_rates;
		$_SESSION['freq_dis_amount'] = $freqdis_amount;
		$total = $totals;
		$final_subtotal = $total - $_SESSION['freq_dis_amount'];
		if ($settings->get_option('ct_tax_vat_status') == 'Y')
			{
			if ($settings->get_option('ct_tax_vat_type') == 'F')
				{
				$flatvalue = $settings->get_option('ct_tax_vat_value');
				$taxamount = $flatvalue;
				}
			elseif ($settings->get_option('ct_tax_vat_type') == 'P')
				{
				$percent = $settings->get_option('ct_tax_vat_value');
				$percentage_value = $percent / 100;
				$taxamount = $percentage_value * $final_subtotal;
				}
			}
		  else
			{
			$taxamount = 0;
			}

		if ($settings->get_option('ct_partial_deposit_status') == 'Y')
			{
			$grand_total = $final_subtotal + $taxamount;
			if ($settings->get_option('ct_partial_type') == 'F')
				{
				$p_deposite_amount = $settings->get_option('ct_partial_deposit_amount');
				$partial_amount = $p_deposite_amount;
				$remain_amount = $grand_total - $partial_amount;
				}
			elseif ($settings->get_option('ct_partial_type') == 'P')
				{
				$p_deposite_amount = $settings->get_option('ct_partial_deposit_amount');
				$percentages = $p_deposite_amount / 100;
				$partial_amount = $grand_total * $percentages;
				$remain_amount = $grand_total - $partial_amount;
				}
			  else
				{
				$partial_amount = 0; 
				$remain_amount = 0; 
				}
			}
		  else
			{
			$partial_amount = 0;
			$remain_amount = 0;
			}

		$jsonnn_array['cart_tax'] = $general->ct_price_format($taxamount, $symbol_position, $decimal);
		$jsonnn_array['partial_amount'] = $general->ct_price_format($partial_amount, $symbol_position, $decimal);
		$jsonnn_array['remain_amount'] = $general->ct_price_format($remain_amount, $symbol_position, $decimal);
		$jsonnn_array['total_amount'] = $general->ct_price_format(($final_subtotal + $taxamount) , $symbol_position, $decimal);
		$jsonnn_array['frequent_discount'] = '- ' . $general->ct_price_format($_SESSION['freq_dis_amount'], $symbol_position, $decimal);
		$jsonnn_array['cart_sub_total'] = $general->ct_price_format($totals, $symbol_position, $decimal);
		$jsonnn_array['status'] = 'reversed';
		echo json_encode($jsonnn_array);
		}
	} 
elseif (isset($_POST['get_staff_sess']))
	{
		$_SESSION['staff_id_cal'] = $_POST['staff_id'];
	}		
	
	/* below code for frequently_discount */
elseif (isset($_POST['frequently_discount_check']))
	{
	$json_array = array();
	$c_rates = 0;
	for ($i = 0; $i < (count($_SESSION['ct_cart']['method'])); $i++)
		{
		$c_rates = ($c_rates + $_SESSION['ct_cart']['method'][$i]['s_m_rate'] * $_SESSION['ct_cart']['method'][$i]['s_m_hour']);
		}

	$frequently_discount->id = $_POST['frequently_discount_id'];
	$freq_dis_data = $frequently_discount->readone();
	if ($freq_dis_data)
		{
		if ($freq_dis_data['d_type'] == 'F')
			{
			$freqdis_amount = $freq_dis_data['rates'];
			}
		  else
		if ($freq_dis_data['d_type'] == 'P')
			{
			$p_value = $freq_dis_data['rates'] / 100;
			$freqdis_amount = $c_rates * $p_value;
			}
		  else
			{
			}
		}
	  else
		{
		$freqdis_amount = 0;
		}

	$total = ($is_hourly==0) ? ($c_rates + $service_price) : $c_rates;
	$_SESSION['freq_dis_amount'] = $freqdis_amount;
	$final_subtotal = $total - $_SESSION['freq_dis_amount'];
	if ($settings->get_option('ct_tax_vat_status') == 'Y' && $total != '' && $total != 0)
		{
		if ($settings->get_option('ct_tax_vat_type') == 'F')
			{
			$flatvalue = $settings->get_option('ct_tax_vat_value');
			$taxamount = $flatvalue;
			}
		elseif ($settings->get_option('ct_tax_vat_type') == 'P')
			{
			$percent = $settings->get_option('ct_tax_vat_value');
			$percentage_value = $percent / 100;
			$taxamount = $percentage_value * $final_subtotal;
			}
		}
	  else
		{
		$taxamount = 0;
		}

	if ($settings->get_option('ct_partial_deposit_status') == 'Y')
		{
		$grand_total = $final_subtotal + $taxamount;
		if ($settings->get_option('ct_partial_type') == 'F')
			{
			$p_deposite_amount = $settings->get_option('ct_partial_deposit_amount');
			$partial_amount = $p_deposite_amount;
			$remain_amount = $grand_total - $partial_amount;
			}
		elseif ($settings->get_option('ct_partial_type') == 'P')
			{
			$p_deposite_amount = $settings->get_option('ct_partial_deposit_amount');
			$percentages = $p_deposite_amount / 100;
			$partial_amount = $grand_total * $percentages;
			$remain_amount = $grand_total - $partial_amount;
			}
		  else
			{
			$partial_amount = 0; 
			$remain_amount = 0; 
			}
		}
	  else
		{
		$partial_amount = 0;
		$remain_amount = 0;
		}

	$json_array['partial_amount'] = $general->ct_price_format($partial_amount, $symbol_position, $decimal);
	$json_array['remain_amount'] = $general->ct_price_format($remain_amount, $symbol_position, $decimal);
	$json_array['cart_tax'] = $general->ct_price_format($taxamount, $symbol_position, $decimal);
	$json_array['total_amount'] = $general->ct_price_format(($final_subtotal + $taxamount) , $symbol_position, $decimal);
	$json_array['frequent_discount'] = '- ' . $general->ct_price_format($_SESSION['freq_dis_amount'], $symbol_position, $decimal);
	$json_array['cart_sub_total'] = $general->ct_price_format($total, $symbol_position, $decimal);
	echo json_encode($json_array);
	}
elseif (isset($_POST['action']) && $_POST['action'] == 'check_user_email')
	{
	$user->user_email = trim(strip_tags(mysqli_real_escape_string($conn, $_POST['email'])));
	$check_user_mail = $user->check_email();
	if (mysqli_num_rows($check_user_mail) > 0)
		{
		echo json_encode("Email is already exists");
		}
	  else
		{
		echo "true";
		}
	}
elseif (isset($_POST['action']) && $_POST['action'] == 'forget_password')
	{
	$user->user_email = trim(strip_tags(mysqli_real_escape_string($conn, $_POST['email'])));
	$res = $user->forget_password();
	$userid = $res[0];
	if (count($res) >= 1)
		{
		$current_time = date('Y-m-d H:i:s');
		$ency_code = base64_encode(base64_encode($userid + 135) . '#' . strtotime("+60 minutes", strtotime($current_time)));
		$to = $_POST['email'];
		$subject = "Forget Password";
		$from = $company_email;
		$body = '<html>			<head>				<meta name="viewport" content="width=device-width, initial-scale=1.0"/>				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />				<title>Welcome to ' . $company_name . '</title>			</head>			<body>				<div style="margin: 0;padding: 0;font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;font-size: 100%;line-height: 1.6;box-sizing: border-box;">						<div style="display: block !important;max-width: 600px !important;margin: 0 auto !important;clear: both !important;">						<table style="border: 1px solid #c2c2c2;width: 100%;float: left;margin: 30px 0px;-webkit-border-radius: 5px;-moz-border-radius: 5px;-o-border-radius: 5px;border-radius: 5px;">							<tbody>								<tr>									<td>										<div style="padding: 25px 30px;background: #fff;float: left;width: 90%;display: block;">											<div style="border-bottom: 1px solid #e6e6e6;float: left;width: 100%;display: block;">												<h3 style="color: #606060;font-size: 20px;margin: 15px 0px 0px;font-weight: 400;">Hi,</h3><br />												<p style="color: #606060;font-size: 15px;margin: 10px 0px 15px;">Forgot your password - <a href="' . SITE_URL . 'admin/forgot-password.php?code=' . $ency_code . '" >Reset it here</a></p>											</div>											<div style="padding: 15px 0px;float: left;width: 100%;">												<h5 style="color: #606060;font-size: 13px;margin: 10px 0px px;">Regards,</h5> 												<h6 style="color: #606060;font-size: 14px;font-weight: 600;margin: 10px 0px 15px;">' . $company_name . '</h6>											</div>										</div>									</td>								</tr>							</tbody>						</table>					</div>				</div>			</body>			</html>';
		if ($settings->get_option('ct_smtp_hostname') != '' && $settings->get_option('ct_email_sender_name') != '' && $settings->get_option('ct_email_sender_address') != '' && $settings->get_option('ct_smtp_username') != '' && $settings->get_option('ct_smtp_password') != '' && $settings->get_option('ct_smtp_port') != '')
			{
			$mail->IsSMTP();
			$mail->Host = $settings->get_option('ct_smtp_hostname');
			$mail->Username = $settings->get_option('ct_smtp_username');
			$mail->Password = $settings->get_option('ct_smtp_password');
			$mail->Port = $settings->get_option('ct_smtp_port');
			
			}
		  else
			{
			$mail->IsMail();
			
			}

		$mail->SMTPDebug = 1;
		$mail->IsHTML(true);
		$mail->From = $company_email;
		$mail->FromName = $company_name;
		$mail->Sender = $company_email;
		$mail->AddAddress($user->user_email);
		$mail->Subject = $subject;
		$mail->Body = $body;
		$mail->send();
		}
	  else
		{
		echo "not";
		}
	}
elseif (isset($_POST['action']) && $_POST['action'] == 'reset_new_password')
	{
	$user->user_id = $_SESSION['user_id'];
	$user->user_pwd = $_POST['retype_new_reset_pass'];
	$reset_new_pass = $user->update_password();
	if ($reset_new_pass)
		{
		echo "password reset successfully";
		}
	}
elseif (isset($_POST['check_for_option']))
	{
	$check_for_products = "select * from ct_services,ct_services_method,ct_service_methods_units";
	$hh = mysqli_query($conn, $check_for_products);
	$t = $timeavailability->get_timeavailability_check();
	$last = "";
	if ($settings->get_option('ct_company_address') == "" || $settings->get_option('ct_company_city') == "" || $settings->get_option('ct_company_state') == "" || $settings->get_option('ct_company_name') == "" || $settings->get_option('ct_company_email') == "" || $settings->get_option('ct_company_zip_code') == "" || $settings->get_option('ct_company_country') == "" || mysqli_num_rows($hh) == "" || mysqli_num_rows($t) == "")
		{
		$last = "Please complete configurations before you created cleanto website embed code. ";
		}

	if (trim($last) != "")
		{
		echo $last;
		}
	} ?>