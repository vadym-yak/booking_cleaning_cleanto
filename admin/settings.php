<?php
include(dirname(__FILE__).'/header.php');
include_once(dirname(dirname(__FILE__)).'/header.php');
include(dirname(dirname(__FILE__))."/objects/class_frequently_discount.php");
include(dirname(dirname(__FILE__))."/objects/class_sms_template.php");
include(dirname(dirname(__FILE__))."/objects/class_email_template.php");
include(dirname(__FILE__).'/user_session_check.php');
include(dirname(dirname(__FILE__))."/objects/class_promo_code.php");
include(dirname(dirname(__FILE__))."/objects/class_adminprofile.php");
if ( is_file(dirname(dirname(__FILE__)).'/extension/GoogleCalendar/google-api-php-client/src/Google_Client.php')) 
{
	require_once dirname(dirname(__FILE__)).'/extension/GoogleCalendar/google-api-php-client/src/Google_Client.php';
}
include(dirname(dirname(__FILE__))."/objects/class_gc_hook.php");
$manage_form_errors_message = 
array(
"min_ff_ps"=> "Minimum characters message for Password",
"max_ff_ps"=> "Maximum characters message for Password",
"req_ff_fn"=> "Required message for First Name",
"min_ff_fn"=> "Minimum characters message for First Name",
"max_ff_fn"=> "Maximum characters message for First Name",
"req_ff_ln"=> "Required message for Last Name",
"min_ff_ln"=> "Minimum characters message for Last Name",
"max_ff_ln"=> "Maximum characters message for Last Name",
"req_ff_ph"=> "Required message for Phone",
"min_ff_ph"=> "Minimum characters message for Phone",
"max_ff_ph"=> "Maximum characters message for Phone",
"req_ff_sa"=> "Required message for Street Address",
"min_ff_sa"=> "Minimum characters message for Street Address",
"max_ff_sa"=> "Maximum characters message for Street Address",
"req_ff_zp"=> "Required message for Zip Code",
"min_ff_zp"=> "Minimum characters message for Zip Code",
"max_ff_zp"=> "Maximum characters message for Zip Code",
"req_ff_ct"=> "Required message for City",
"min_ff_ct"=> "Minimum characters message for City",
"max_ff_ct"=> "Maximum characters message for City",
"req_ff_st"=> "Required message for State",
"min_ff_st"=> "Minimum characters message for State",
"max_ff_st"=> "Maximum characters message for State",
"req_ff_srn"=> "Required message for Notes",
"min_ff_srn"=>"Minimum characters message for Notes",
"max_ff_srn"=>"Maximum characters message for Notes");
$language_names = array(
"en"=> urlencode("English (United States)"),
"ary"=> urlencode("العربية المغربية"),
"ar"=> urlencode("العربية"),
"az"=> urlencode("Azərbaycan dili"),
"azb"=> urlencode("گؤنئی آذربایجان"),
"bg_BG"=> urlencode("Български"),
"bn_BD"=> urlencode("বাংলা"),
"bs_BA"=> urlencode("Bosanski"),
"ca"=> urlencode("Català"),
"ceb"=> urlencode("Cebuano"),
"cs_CZ"=> urlencode("Čeština‎"),
"cy"=> urlencode("Cymraeg"),
"da_DK"=> urlencode("Dansk"),
"de_CH_informal"=> urlencode("Deutsch (Schweiz, Du)"),
"de_DE_formal"=> urlencode("Deutsch (Sie)"),
"de_DE"=> urlencode("Deutsch"),
"de_CH"=> urlencode("Deutsch (Schweiz)"),
"el"=> urlencode("Ελληνικά"),
"en_CA"=> urlencode("English (Canada)"),
"en_GB"=> urlencode("English (UK)"),
"en_NZ"=> urlencode("English (New Zealand)"),
"en_ZA"=> urlencode("English (South Africa)"),
"en_AU"=> urlencode("English (Australia)"),
"eo"=> urlencode("Esperanto"),
"es_ES"=> urlencode("Español"),
"et"=> urlencode("Eesti"),
"eu"=> urlencode("Euskara"),
"fa_IR"=> urlencode("فارسی"),
"fi"=> urlencode("Suomi"),
"fr_FR"=> urlencode("Français"),
"gd"=> urlencode("Gàidhlig"),
"gl_ES"=> urlencode("Galego"),
"gu"=> urlencode("ગુજરાતી"),
"haz"=> urlencode("هزاره گی"),
"hi_IN"=> urlencode("हिन्दी"),
"hr"=> urlencode("Hrvatski"),
"hu_HU"=> urlencode("Magyar"),
"hy"=> urlencode("Հայերեն"),
"id_ID"=> urlencode("Bahasa Indonesia"),
"is_IS"=> urlencode("Íslenska"),
"it_IT"=> urlencode("Italiano"),
"ja"=> urlencode("日本語"),
"ka_GE"=> urlencode("ქართული"),
"ko_KR"=> urlencode("한국어"),
"lt_LT"=> urlencode("Lietuvių kalba"),
"lv"=> urlencode("Latviešu valoda"),
"mk_MK"=> urlencode("Македонски јазик"),
"mr"=> urlencode("मराठी"),
"ms_MY"=> urlencode("Bahasa Melayu"),
"my_MM"=> urlencode("ဗမာစာ"),
"nb_NO"=> urlencode("Norsk bokmål"),
"nl_NL"=> urlencode("Nederlands"),
"nl_NL_formal"=> urlencode("Nederlands (Formeel)"),
"nn_NO"=> urlencode("Norsk nynorsk"),
"oci"=> urlencode("Occitan"),
"pl_PL"=> urlencode("Polski"),
"pt_PT"=> urlencode("Português"),
"pt_BR"=> urlencode("Português do Brasil"),
"ro_RO"=> urlencode("Română"),
"ru_RU"=> urlencode("Русский"),
"sk_SK"=> urlencode("Slovenčina"),
"sl_SI"=> urlencode("Slovenščina"),
"sq"=> urlencode("Shqip"),
"sr_RS"=> urlencode("Српски језик"),
"sv_SE"=> urlencode("Svenska"),
"szl"=> urlencode("Ślōnskŏ gŏdka"),
"th"=> urlencode("ไทย"),
"tl"=> urlencode("Tagalog"),
"tr_TR"=> urlencode("Türkçe"),
"ug_CN"=> urlencode("Uyƣurqə"),
"uk"=> urlencode("Українська"),
"vi"=> urlencode("Tiếng Việt"),
"zh_TW"=> urlencode("繁體中文"),
"zh_HK"=> urlencode("香港中文版"),
"zh_CN"=> urlencode("简体中文"),
);
?>
<div class="ct-alert-msg-show-main mainheader_message_fail_appearance_setting">
	<div class="ct-all-alert-messags alert alert-danger mainheader_message_inner_fail_appearance_setting">
		<!-- <a href="#" class="close" data-dismiss="alert">&times;</a> -->
		<strong><?php echo $label_language_values['failed'];?></strong> <span id="ct_sucess_message_fail_appearance_setting"></span>
	</div>
</div>
<?php
$database=new cleanto_db();
$conn=$database->connect();
$database->conn=$conn;
$promo = new cleanto_promo_code();
$promo->conn = $conn;

$objfrequently = new cleanto_frequently_discount();
$objfrequently->conn = $conn;

$sms_template = new cleanto_sms_template();
$sms_template->conn=$conn;
$setting->readAll();

$email_template = new cleanto_email_template();
$email_template->conn = $conn;

$admin_profile = new cleanto_adminprofile();
$admin_profile->conn = $conn;

$gc_hook = new cleanto_gcHook();
$gc_hook->conn = $conn;

$admin_profile->id = $_SESSION['adminid'];
$admin_get_email = $admin_profile->readone();

$admin_optional_email = $setting->get_option('ct_admin_optional_email');
if($admin_optional_email == ""){
	$admin_optional_email = $admin_get_email[2];
}

if($setting->get_option('ct_paypal_express_checkout_status') == 'on' || $setting->get_option('ct_stripe_payment_form_status') == 'on' || $setting->get_option('ct_authorizenet_status') == 'on' || $setting->get_option('ct_2checkout_status') == 'Y'  || $setting->get_option('ct_payumoney_status') == 'Y'){
	$payment_status = "on";
}
else if(sizeof($purchase_check)>0){
	$payment_status = "off";
	$check_pay = 'N';
	foreach($purchase_check as $key=>$val){
		if($val == 'Y'){
			if($payment_hook->payment_partial_deposit_toggle_condition_hook($key) == true && $check_pay == 'N'){
				$payment_status = "on";
				$check_pay = 'Y';
			}
		}
	}
}
else {
	$payment_status = "off";
}

/* Add Appearance Settings */	
$upload1=$upload2='';	
if(isset($_POST['appreance'])){

if(isset($_FILES['ct_frontend_gif_loader_file'])){
	$gif_mixno=time();
	$gif_ext = pathinfo($_FILES['ct_frontend_gif_loader_file']['name'], PATHINFO_EXTENSION);
	$gif_img_type1=array('jpg','jpeg','png','gif');	
	$gif_destination=dirname(dirname(__FILE__))."/assets/images/gif-loader/".$gif_mixno.".".$gif_ext."";
	$gif_lg_image_type=pathinfo($gif_destination,PATHINFO_EXTENSION);
	if(in_array($gif_lg_image_type,$gif_img_type1)){
		move_uploaded_file($_FILES['ct_frontend_gif_loader_file']['tmp_name'],$gif_destination);
		$upload1='1';
		$ct_frontend_gif_imagename=$gif_mixno.".".$gif_ext."";
	}else{
		$message="Invalid Image Type";
		$ct_frontend_gif_imagename='';
	}
}

if(isset($_FILES['loginimg'])){
	$mixno=rand(1,1000);
	$ext = pathinfo($_FILES['loginimg']['name'], PATHINFO_EXTENSION);
	$img_type1=array('jpg','jpeg','png','gif');	
	$destination=dirname(dirname(__FILE__))."/assets/images/backgrounds/"."lg_".$mixno.".".$ext."";
	$lg_image_type=pathinfo($destination,PATHINFO_EXTENSION);
		if(in_array($lg_image_type,$img_type1)){
			move_uploaded_file($_FILES['loginimg']['tmp_name'],$destination);
			$upload1='1';
			$loginimagename="lg_".$mixno.".".$ext."";
		}else{
				$message="Invalid Image Type";
				$loginimagename='';
		}
}

if(isset($_FILES['frontimage'])){
	$frmixno=rand(1001,9999);
	$frext = pathinfo($_FILES['frontimage']['name'], PATHINFO_EXTENSION);
	$img_type2=array('jpg','jpeg','png','gif');
	$destination2=dirname(dirname(__FILE__))."/assets/images/backgrounds/"."fr_".$frmixno.".".$frext."";
	$fr_image_type=pathinfo($destination2,PATHINFO_EXTENSION);
	if(in_array($fr_image_type,$img_type2)){
		move_uploaded_file($_FILES['frontimage']['tmp_name'],$destination2);
		$upload2='1';
		$frontimagename="fr_".$frmixno.".".$frext."";
	}else{
		$message="Invalid Image Type";
		$frontimagename='';
	}
}

if(isset($_FILES['faviconimage'])){
	$favmixno=rand(1001,9999);
	$favext = pathinfo($_FILES['faviconimage']['name'], PATHINFO_EXTENSION);
	$img_type3=array('jpg','jpeg','png','gif');
	$destination3=dirname(dirname(__FILE__))."/assets/images/backgrounds/"."fr_".$favmixno.".".$favext."";
	$favicon_image_type=pathinfo($destination3,PATHINFO_EXTENSION);
	if(in_array($favicon_image_type,$img_type3)){
		move_uploaded_file($_FILES['faviconimage']['tmp_name'],$destination3);
		$upload2='1';
		$favimagename="fr_".$favmixno.".".$favext."";
	}else{
		$message="Invalid Image Type";
		$favimagename='';
	}
}

if(!isset($_POST['selected_country_code_display'])){
	$phone_country_code  = "";
}
else {
	$phone_country_code =implode(",",$_POST['selected_country_code_display']);
}

/*$phone_country_code =implode(",",$_POST['selected_country_code_display']);*/
$selected_frontend_fonts_display = $_POST['selected_frontend_fonts_display'];
$ct_calendar_defaultView = $_POST['ct_calendar_defaultView'];
$ct_calendar_firstDay = $_POST['ct_calendar_firstDay'];
$slotstatus=(isset($_POST["fadded_slots"]) && $_POST["fadded_slots"]=='on') ? 'on':'off';
$doffdaystatus=(isset($_POST["d_off_days"]) && $_POST["d_off_days"]=='on') ? 'on':'off';
$gucstatus=(isset($_POST["guc_check"]) && $_POST["guc_check"]=='on') ? 'on':'off';
$eu_nu_status=(isset($_POST["eu_nu_check"]) && $_POST["eu_nu_check"]=='on') ? 'on':'off';
$ct_cart_scrollable_status=(isset($_POST['ct_cart_scrollable']) && $_POST['ct_cart_scrollable']=='on') ? 'Y':'N';
$array1=array('ct_primary_color','ct_secondary_color','ct_text_color','ct_text_color_on_bg','ct_primary_color_admin','ct_secondary_color_admin','ct_text_color_admin','ct_hide_faded_already_booked_time_slots','ct_guest_user_checkout','ct_time_format','ct_date_picker_date_format','ct_custom_css','ct_front_image','ct_login_image','ct_favicon_image','ct_existing_and_new_user_checkout','ct_cart_scrollable','ct_phone_display_country_code','ct_frontend_fonts','ct_loader','ct_custom_gif_loader','ct_custom_css_loader','ct_calendar_defaultView','ct_calendar_firstDay', 'ct_disable_turn_off_days');	 

$array2=array($_POST['ct_primary_color'],$_POST['ct_secondary_color'],$_POST['ct_text_color'],$_POST['ct_text_color_on_bg'],$_POST['ct_primary_color_admin'],$_POST['ct_secondary_color_admin'],$_POST['ct_text_color_admin'],$slotstatus,$gucstatus,$_POST['ct_time_format'],$_POST['ct_date_picker_date_format'],$_POST['cust_css'],$frontimagename,$loginimagename,$favimagename,$eu_nu_status,$ct_cart_scrollable_status,$phone_country_code,$selected_frontend_fonts_display,$_POST['ct_loader_option'],$ct_frontend_gif_imagename,$_POST['ct_custom_css_loader'],$ct_calendar_defaultView,$ct_calendar_firstDay,$doffdaystatus);

	//$doffdaystatus -> index:24

	if($gucstatus=='off' && $eu_nu_status=='off'){
		
	}else{
		for($i=0;$i<sizeof($array1);$i++){
			if($i == 12){
				if($array2[12] != ""){
					$add3=$setting->set_option($array1[$i],$array2[$i]);
				}
			}elseif($i == 13){
				if($array2[13] != ""){
					$add3=$setting->set_option($array1[$i],$array2[$i]);
				}
			}elseif($i == 14){
				if($array2[14] != ""){
					$add3=$setting->set_option($array1[$i],$array2[$i]);
				}
			}elseif($i == 20){
				if($array2[20] != ""){
					$add3=$setting->set_option($array1[$i],$array2[$i]);
				}
			}else{
				$add3=$setting->set_option($array1[$i],$array2[$i]);
			}
	    }
		header("location:".SITE_URL."admin/settings.php");
	}
	exit();	
}		
/* save email templates */
for($kk = 1;$kk<=18;$kk++){
	if(isset($_POST['template'.$kk])){
		$id = $_POST['hdntemplate'.$kk];
		$email_template->id = $id;
		$email_template->email_message = base64_encode($_POST['email_message'.$kk]);
		$email_template->update_email_template();
		header("Location:settings.php");
		exit();
	}
}	

if(isset($_POST['btn_submit_frontend_labels']))
{
	$update_labels = $_POST['ct_selected_lang_labels'];
	$language_front = array();
	foreach($_POST as $key => $value){
		if(is_numeric(strpos($key,'ctfrontlabelct'))){
			$language_front[str_replace('ctfrontlabelct','',$key)]=urlencode($value);
		}
	}
	$language_front_arr = base64_encode(serialize($language_front));
	
	if( $setting->check_for_existing_language($update_labels) > 0 ){
		$setting->update_labels_languages_per_tab('label_data', $language_front_arr, $update_labels);
	}else{
		
		$setting->insert_front_labels_languages($language_front_arr, $update_labels);
	}
	header('Location: '.SITE_URL."admin/settings.php");
	exit;
}
if(isset($_POST['btn_submit_admin_labels']))
{
	$update_labels = $_POST['ct_selected_lang_labels'];
	$language_admin = array();
	foreach($_POST as $key => $value){
		if(is_numeric(strpos($key,'ctadminlabelct'))){
			$language_admin[str_replace('ctadminlabelct','',$key)]=urlencode($value);
		}
	}
	$language_admin_arr = base64_encode(serialize($language_admin));
	if( $setting->check_for_existing_language($update_labels) > 0 ){
		$setting->update_labels_languages_per_tab('admin_labels', $language_admin_arr, $update_labels);
	}else{
		$setting->insert_admin_labels_languages($language_admin_arr, $update_labels);
	}
	header('Location: '.SITE_URL."admin/settings.php");
	exit;
}
if(isset($_POST['btn_submit_error_labels']))
{
	$update_labels = $_POST['ct_selected_lang_labels'];
	$language_error = array();
	foreach($_POST as $key => $value){
		if(is_numeric(strpos($key,'cterrorlabelct'))){
			$language_error[str_replace('cterrorlabelct','',$key)]=urlencode($value);
		}
	}
	$language_error_arr = base64_encode(serialize($language_error));
	if( $setting->check_for_existing_language($update_labels) > 0 ){
		$setting->update_labels_languages_per_tab('error_labels', $language_error_arr, $update_labels);
	}else{
		$setting->insert_error_labels_languages($language_error_arr, $update_labels);
	}
	header('Location: '.SITE_URL."admin/settings.php");
	exit;
}
if(isset($_POST['btn_submit_extra_labels']))
{
	$update_labels = $_POST['ct_selected_lang_labels'];
	$language_extra = array();
	foreach($_POST as $key => $value){
		if(is_numeric(strpos($key,'ctextralabelct'))){
			$language_extra[str_replace('ctextralabelct','',$key)]=urlencode($value);
		}
	}
	$language_extra_arr = base64_encode(serialize($language_extra));
	if( $setting->check_for_existing_language($update_labels) > 0 ){
		$setting->update_labels_languages_per_tab('extra_labels', $language_extra_arr, $update_labels);
	}else{
		$setting->insert_extra_labels_languages($language_extra_arr, $update_labels);
	}
	header('Location: '.SITE_URL."admin/settings.php");
	exit;
}
if(isset($_POST['btn_submit_ferror_labels']))
{
	$update_labels = $_POST['ct_selected_lang_labels'];
	$language_front_error = array();
	foreach($_POST as $key => $value){
		if(is_numeric(strpos($key,'ctfr_errorlabelct'))){
			$language_front_error[str_replace('ctfr_errorlabelct','',$key)]=urlencode($value);
		}
	}
	$language_front_error_arr = base64_encode(serialize($language_front_error));
	if( $setting->check_for_existing_language($update_labels) > 0 ){
		$setting->update_labels_languages_per_tab('front_error_labels', $language_front_error_arr, $update_labels);
	}else{
		$setting->insert_ferror_labels_languages($language_front_error_arr, $update_labels);
	}
	header('Location: '.SITE_URL."admin/settings.php");
	exit;
}
?>
<script>
    var payment_status = '<?php echo $payment_status;?>';
</script>
<div class="panel cta-panel-default" id="ct-settings">
    <div class="ct-settings ct-left-menu col-md-3 col-sm-3 col-xs-12 col-lg-3">
        <ul class="nav nav-tab nav-stacked" id="cta-settings-nav">
            <li class="active"><a href="#company-details" class="sot-company-details" data-toggle="pill"><i class="fa fa-building-o fa-2x"></i><br /><?php echo $label_language_values['company'];?></a></li>
            <li><a href="#general-setting" class="sot-general-setting" data-toggle="pill"><i class="fa fa-cog fa-2x"></i><br /><?php echo $label_language_values['general'];?></a></li>
            <li><a href="#appearance-setting" class="sot-appearance-setting" data-toggle="pill"><i class="fa fa-tachometer fa-2x"></i><br /><?php echo $label_language_values['appearance'];?></a></li>
            <li><a href="#payment-setting" class="sot-payment-setting" data-toggle="pill"><i class="fa fa-money fa-2x"></i><br /><?php echo $label_language_values['payments_setting'];?></a></li>
            <li><a href="#email-setting" class="sot-email-setting" data-toggle="pill"><i class="fa fa-paper-plane fa-2x"></i><br /><?php echo $label_language_values['email_notification'];?></a></li>
			<li><a href="#email-template" class="sot-email-template" data-toggle="pill"><i class="fa fa-envelope fa-2x"></i><br /><?php echo $label_language_values['email_template'];?></a></li>
			<li><a href="#sms-reminder" class="sot-sms-reminder" data-toggle="pill"><i class="fa fa-mobile fa-2x"></i><br /><?php echo $label_language_values['sms_notification'];?></a></li>
			<li><a href="#sms-template" class="sot-sms-template" data-toggle="pill"><i class="fa fa-comments fa-2x"></i><br /><?php echo $label_language_values['sms_template'];?></a></li>
            <li><a href="#frequently-discount" class="sot-frequently-discount" data-toggle="pill"><i class="fa fa-tag fa-2x"></i><br /><?php echo $label_language_values['frequently_discount_setting_tabs'];?></a></li>
            <li><a href="#promocode" class="sot-promocode" data-toggle="pill"><i class="fa fa-tags fa-2x"></i><br /><?php echo $label_language_values['promocode'];?></a></li>
            <li><a href="#labels" class="sot-labels" data-toggle="pill"><i class="fa fa-language fa-2x"></i><br /><?php echo $label_language_values['labels'];?></a></li>
			
			<li><a href="#front_tooltips" class="sot-labels" data-toggle="pill"><i class="fa fa-language fa-2x"></i><br /><?php echo $label_language_values['front_tool_tips'];?></a></li>
			<li><a href="#manageable-form-fields" class="sot-form-fields" data-toggle="pill"><i class="fa fa-list fa-2x"></i><br /><?php echo $label_language_values['manageable_form_fields'];?></a></li>
			<li><a href="#recurrence-booking" class="sot-form-fields" data-toggle="pill"><i class="fa fa-repeat fa-2x"></i><br /><?php echo $label_language_values['Recurrence_booking'];?></a></li>
			<li><a href="#seo-ga" class="sot-form-fields" data-toggle="pill"><i class="fa fa-line-chart fa-2x"></i><br /><?php echo $label_language_values['SEO'];?></a></li>
			<?php 
			if($gc_hook->gc_purchase_status() == 'exist'){
				echo $gc_hook->gc_setting_menu_hook();
			}
			?>
        </ul>
    </div>
    <div class="panel-body">
		<div class="ct-setting-details tab-content col-md-9 col-sm-9 col-lg-9 col-xs-12">
            <div class="company-details tab-pane fade in active" id="company-details">
                <form id="business_setting_form" method="post" type="" class="ct-company-details" >
                    <div class="panel panel-default">
                        <div class="panel-heading cta-top-right">
                            <h1 class="panel-title"><?php echo $label_language_values['company_info_settings'];?></h1>
                            <span class="pull-right cta-setting-fix-btn"> <a id="company_setting" name="" class="btn btn-success" ><?php echo $label_language_values['save_setting'];?></a></span>
                        </div>
                        <div class="panel-body pt-50 plr-10">
                            <table class="form-inline ct-common-table">
                                <tbody>
								
                                <tr>
                                    <td><label><?php echo $label_language_values['select_language_to_display'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <select name="ct_setted_language" id="display_language_user"   class="selectpicker" data-size="10" data-live-search="true" data-live-search-placeholder="<?php echo $label_language_values['search'];?>"  style="display: none;">
                                                <option value=""><?php echo $label_language_values['set_language'];?></option>
                                                <option value="en" <?php echo ($setting->get_option("ct_language")=="en" ? "selected" : "");?>>English (United States)</option>
												<option value="ary" <?php echo ($setting->get_option("ct_language")=="ary" ? "selected" : "");?>>العربية المغربية</option>
												<option value="ar" <?php echo ($setting->get_option("ct_language")=="ar" ? "selected" : "");?>>العربية</option>
                                                <option value="az" <?php echo ($setting->get_option("ct_language")=="az" ? "selected" : "");?>>Azərbaycan dili</option>
												<option value="azb" <?php echo ($setting->get_option("ct_language")=="azb" ? "selected" : "");?>>گؤنئی آذربایجان</option>
                                                <option value="bg_BG" <?php echo ($setting->get_option("ct_language")=="bg_BG" ? "selected" : "");?>>Български</option>
                                                <option value="bn_BD" <?php echo ($setting->get_option("ct_language")=="bn_BD" ? "selected" : "");?>>বাংলা</option>
                                                <option value="bs_BA" <?php echo ($setting->get_option("ct_language")=="bs_BA" ? "selected" : "");?>>Bosanski</option>
                                                <option value="ca" <?php echo ($setting->get_option("ct_language")=="ca" ? "selected" : "");?>>Català</option>
                                                <option value="ceb" <?php echo ($setting->get_option("ct_language")=="ceb" ? "selected" : "");?>>Cebuano</option>
                                                <option value="cs_CZ" <?php echo ($setting->get_option("ct_language")=="cs_CZ" ? "selected" : "");?>>Čeština‎</option>
                                                <option value="cy" <?php echo ($setting->get_option("ct_language")=="cy" ? "selected" : "");?>>Cymraeg</option>
                                                <option value="da_DK" <?php echo ($setting->get_option("ct_language")=="da_DK" ? "selected" : "");?>>Dansk</option>
                                                <option value="de_CH_informal" <?php echo ($setting->get_option("ct_language")=="de_CH_informal" ? "selected" : "");?>>Deutsch (Schweiz, Du)</option>
                                                <option value="de_DE_formal" <?php echo ($setting->get_option("ct_language")=="de_DE_formal" ? "selected" : "");?>>Deutsch (Sie)</option>
                                                <option value="de_DE" <?php echo ($setting->get_option("ct_language")=="de_DE" ? "selected" : "");?>>Deutsch</option>
                                                <option value="de_CH" <?php echo ($setting->get_option("ct_language")=="de_CH" ? "selected" : "");?>>Deutsch (Schweiz)</option>
                                                <option value="el" <?php echo ($setting->get_option("ct_language")=="el" ? "selected" : "");?>>Ελληνικά</option>
                                                <option value="en_CA" <?php echo ($setting->get_option("ct_language")=="en_CA" ? "selected" : "");?>>English (Canada)</option>
                                                <option value="en_GB" <?php echo ($setting->get_option("ct_language")=="en_GB" ? "selected" : "");?>>English (UK)</option>
                                                <option value="en_NZ" <?php echo ($setting->get_option("ct_language")=="en_NZ" ? "selected" : "");?>>English (New Zealand)</option>
                                                <option value="en_ZA" <?php echo ($setting->get_option("ct_language")=="en_ZA" ? "selected" : "");?>>English (South Africa)</option>
                                                <option value="en_AU" <?php echo ($setting->get_option("ct_language")=="en_AU" ? "selected" : "");?>>English (Australia)</option>
                                                <option value="eo" <?php echo ($setting->get_option("ct_language")=="eo" ? "selected" : "");?>>Esperanto</option>
                                                <option value="es_ES" <?php echo ($setting->get_option("ct_language")=="es_ES" ? "selected" : "");?>>Español</option>
                                                <option value="et" <?php echo ($setting->get_option("ct_language")=="et" ? "selected" : "");?>>Eesti</option>
                                                <option value="eu" <?php echo ($setting->get_option("ct_language")=="eu" ? "selected" : "");?>>Euskara</option>
												<option value="fa_IR" <?php echo ($setting->get_option("ct_language")=="fa_IR" ? "selected" : "");?>>فارسی</option>
                                                <option value="fi" <?php echo ($setting->get_option("ct_language")=="fi" ? "selected" : "");?>>Suomi</option>
                                                <option value="fr_FR" <?php echo ($setting->get_option("ct_language")=="fr_FR" ? "selected" : "");?>>Français</option>
                                                <option value="gd" <?php echo ($setting->get_option("ct_language")=="gd" ? "selected" : "");?>>Gàidhlig</option>
                                                <option value="gl_ES" <?php echo ($setting->get_option("ct_language")=="gl_ES" ? "selected" : "");?>>Galego</option>
                                                <option value="gu" <?php echo ($setting->get_option("ct_language")=="gu" ? "selected" : "");?>>ગુજરાતી</option>
												<option value="haz" <?php echo ($setting->get_option("ct_language")=="haz" ? "selected" : "");?>>هزاره گی</option>
                                                <option value="hi_IN" <?php echo ($setting->get_option("ct_language")=="hi_IN" ? "selected" : "");?>>हिन्दी</option>
                                                <option value="hr" <?php echo ($setting->get_option("ct_language")=="hr" ? "selected" : "");?>>Hrvatski</option>
                                                <option value="hu_HU" <?php echo ($setting->get_option("ct_language")=="hu_HU" ? "selected" : "");?>>Magyar</option>
                                                <option value="hy" <?php echo ($setting->get_option("ct_language")=="hy" ? "selected" : "");?>>Հայերեն</option>
                                                <option value="id_ID" <?php echo ($setting->get_option("ct_language")=="id_ID" ? "selected" : "");?>>Bahasa Indonesia</option>
                                                <option value="is_IS" <?php echo ($setting->get_option("ct_language")=="is_IS" ? "selected" : "");?>>Íslenska</option>
                                                <option value="it_IT" <?php echo ($setting->get_option("ct_language")=="it_IT" ? "selected" : "");?>>Italiano</option>
                                                <option value="ja" <?php echo ($setting->get_option("ct_language")=="ja" ? "selected" : "");?>>日本語</option>
                                                <option value="ka_GE" <?php echo ($setting->get_option("ct_language")=="ka_GE" ? "selected" : "");?>>ქართული</option>
                                                <option value="ko_KR" <?php echo ($setting->get_option("ct_language")=="ko_KR" ? "selected" : "");?>>한국어</option>
                                                <option value="lt_LT" <?php echo ($setting->get_option("ct_language")=="lt_LT" ? "selected" : "");?>>Lietuvių kalba</option>
                                                <option value="lv" <?php echo ($setting->get_option("ct_language")=="lv" ? "selected" : "");?>>Latviešu valoda</option>
                                                <option value="mk_MK" <?php echo ($setting->get_option("ct_language")=="mk_MK" ? "selected" : "");?>>Македонски јазик</option>
                                                <option value="mr" <?php echo ($setting->get_option("ct_language")=="mr" ? "selected" : "");?>>मराठी</option>
                                                <option value="ms_MY" <?php echo ($setting->get_option("ct_language")=="ms_MY" ? "selected" : "");?>>Bahasa Melayu</option>
                                                <option value="my_MM" <?php echo ($setting->get_option("ct_language")=="my_MM" ? "selected" : "");?>>ဗမာစာ</option>
                                                <option value="nb_NO" <?php echo ($setting->get_option("ct_language")=="nb_NO" ? "selected" : "");?>>Norsk bokmål</option>
                                                <option value="nl_NL" <?php echo ($setting->get_option("ct_language")=="nl_NL" ? "selected" : "");?>>Nederlands</option>
                                                <option value="nl_NL_formal" <?php echo ($setting->get_option("ct_language")=="nl_NL_formal" ? "selected" : "");?>>Nederlands (Formeel)</option>
                                                <option value="nn_NO" <?php echo ($setting->get_option("ct_language")=="nn_NO" ? "selected" : "");?>>Norsk nynorsk</option>
                                                <option value="oci" <?php echo ($setting->get_option("ct_language")=="oci" ? "selected" : "");?>>Occitan</option>
                                                <option value="pl_PL" <?php echo ($setting->get_option("ct_language")=="pl_PL" ? "selected" : "");?>>Polski</option>
                                                <option value="pt_PT" <?php echo ($setting->get_option("ct_language")=="pt_PT" ? "selected" : "");?>>Português</option>
                                                <option value="pt_BR" <?php echo ($setting->get_option("ct_language")=="pt_BR" ? "selected" : "");?>>Português do Brasil</option>
                                                <option value="ro_RO" <?php echo ($setting->get_option("ct_language")=="ro_RO" ? "selected" : "");?>>Română</option>
                                                <option value="ru_RU" <?php echo ($setting->get_option("ct_language")=="ru_RU" ? "selected" : "");?>>Русский</option>
                                                <option value="sk_SK" <?php echo ($setting->get_option("ct_language")=="sk_SK" ? "selected" : "");?>>Slovenčina</option>
                                                <option value="sl_SI" <?php echo ($setting->get_option("ct_language")=="sl_SI" ? "selected" : "");?>>Slovenščina</option>
                                                <option value="sq" <?php echo ($setting->get_option("ct_language")=="sq" ? "selected" : "");?>>Shqip</option>
                                                <option value="sr_RS" <?php echo ($setting->get_option("ct_language")=="sr_RS" ? "selected" : "");?>>Српски језик</option>
                                                <option value="sv_SE" <?php echo ($setting->get_option("ct_language")=="sv_SE" ? "selected" : "");?>>Svenska</option>
                                                <option value="szl" <?php echo ($setting->get_option("ct_language")=="szl" ? "selected" : "");?>>Ślōnskŏ gŏdka</option>
                                                <option value="th" <?php echo ($setting->get_option("ct_language")=="th" ? "selected" : "");?>>ไทย</option>
                                                <option value="tl" <?php echo ($setting->get_option("ct_language")=="tl" ? "selected" : "");?>>Tagalog</option>
                                                <option value="tr_TR" <?php echo ($setting->get_option("ct_language")=="tr_TR" ? "selected" : "");?>>Türkçe</option>
                                                <option value="ug_CN" <?php echo ($setting->get_option("ct_language")=="ug_CN" ? "selected" : "");?>>Uyƣurqə</option>
                                                <option value="uk" <?php echo ($setting->get_option("ct_language")=="uk" ? "selected" : "");?>>Українська</option>
                                                <option value="vi" <?php echo ($setting->get_option("ct_language")=="vi" ? "selected" : "");?>>Tiếng Việt</option>
                                                <option value="zh_TW" <?php echo ($setting->get_option("ct_language")=="zh_TW" ? "selected" : "");?>>繁體中文</option>
                                                <option value="zh_HK" <?php echo ($setting->get_option("ct_language")=="zh_HK" ? "selected" : "");?>>香港中文版</option>
                                                <option value="zh_CN" <?php echo ($setting->get_option("ct_language")=="zh_CN" ? "selected" : "");?>>简体中文</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td><label><?php echo $label_language_values['timezone'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <select class="selectpicker" id="time-zone" data-live-search="true" data-live-search-placeholder="<?php echo $label_language_values['search'];?>" data-size="10" style="display: none;">
                                                <option <?php if($setting->get_option('ct_timezone')=='Pacific/Midway'){ echo "selected";}?> value="Pacific/Midway">(GMT-11:00) Midway Island, Samoa</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='America/Adak'){ echo "selected";}?> value="America/Adak">(GMT-10:00) Hawaii-Aleutian</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Etc/GMT+10'){ echo "selected";}?> value="Etc/GMT+10">(GMT-10:00) Hawaii</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Pacific/Marquesas'){ echo "selected";}?> value="Pacific/Marquesas">(GMT-09:30) Marquesas Islands</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Pacific/Gambier'){ echo "selected";}?> value="Pacific/Gambier">(GMT-09:00) Gambier Islands</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='America/Anchorage'){ echo "selected";}?> value="America/Anchorage">(GMT-09:00) Alaska</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='America/Ensenada'){ echo "selected";}?> value="America/Ensenada">(GMT-08:00) Tijuana, Baja California</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Etc/GMT+8'){ echo "selected";}?> value="Etc/GMT+8">(GMT-08:00) Pitcairn Islands</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='America/Los_Angeles'){ echo "selected";}?> value="America/Los_Angeles">(GMT-08:00) Pacific Time (US &amp; Canada)</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='America/Denver'){ echo "selected";}?> value="America/Denver">(GMT-07:00) Mountain Time (US &amp; Canada)</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='America/Chihuahua'){ echo "selected";}?> value="America/Chihuahua">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='America/Dawson_Creek'){ echo "selected";}?> value="America/Dawson_Creek">(GMT-07:00) Arizona</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='America/Belize'){ echo "selected";}?> value="America/Belize">(GMT-06:00) Saskatchewan, Central America</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='America/Cancun'){ echo "selected";}?> value="America/Cancun">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Chile/EasterIsland'){ echo "selected";}?> value="Chile/EasterIsland">(GMT-06:00) Easter Island</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='America/Chicago'){ echo "selected";}?> value="America/Chicago">(GMT-06:00) Central Time (US &amp; Canada)</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='America/New_York'){ echo "selected";}?> value="America/New_York">(GMT-05:00) Eastern Time (US &amp; Canada)</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='America/Havana'){ echo "selected";}?> value="America/Havana">(GMT-05:00) Cuba</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='America/Bogota'){ echo "selected";}?> value="America/Bogota">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='America/Caracas'){ echo "selected";}?> value="America/Caracas">(GMT-04:30) Caracas</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='America/Santiago'){ echo "selected";}?> value="America/Santiago">(GMT-04:00) Santiago</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='America/La_Paz'){ echo "selected";}?> value="America/La_Paz">(GMT-04:00) La Paz</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Atlantic/Stanley'){ echo "selected";}?> value="Atlantic/Stanley">(GMT-04:00) Faukland Islands</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='America/Campo_Grande'){ echo "selected";}?> value="America/Campo_Grande">(GMT-04:00) Brazil</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='America/Goose_Bay'){ echo "selected";}?> value="America/Goose_Bay">(GMT-04:00) Atlantic Time (Goose Bay)</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='America/Glace_Bay'){ echo "selected";}?> value="America/Glace_Bay">(GMT-04:00) Atlantic Time (Canada)</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='America/St_Johns'){ echo "selected";}?> value="America/St_Johns">(GMT-03:30) Newfoundland</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='America/Araguaina'){ echo "selected";}?> value="America/Araguaina">(GMT-03:00) UTC-3</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='America/Montevideo'){ echo "selected";}?> value="America/Montevideo">(GMT-03:00) Montevideo</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='America/Miquelon'){ echo "selected";}?> value="America/Miquelon">(GMT-03:00) Miquelon, St. Pierre</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='America/Godthab'){ echo "selected";}?> value="America/Godthab">(GMT-03:00) Greenland</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='America/Argentina/Buenos_Aires'){ echo "selected";}?> value="America/Argentina/Buenos_Aires">(GMT-03:00) Buenos Aires</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='America/Sao_Paulo'){ echo "selected";}?> value="America/Sao_Paulo">(GMT-03:00) Brasilia</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='America/Noronha'){ echo "selected";}?> value="America/Noronha">(GMT-02:00) Mid-Atlantic</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Atlantic/Cape_Verde'){ echo "selected";}?> value="Atlantic/Cape_Verde">(GMT-01:00) Cape Verde Is.</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Atlantic/Azores'){ echo "selected";}?> value="Atlantic/Azores">(GMT-01:00) Azores</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Europe/Belfast'){ echo "selected";}?> value="Europe/Belfast">(GMT) Greenwich Mean Time : Belfast</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Europe/Dublin'){ echo "selected";}?> value="Europe/Dublin">(GMT) Greenwich Mean Time : Dublin</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Europe/Lisbon'){ echo "selected";}?> value="Europe/Lisbon">(GMT) Greenwich Mean Time : Lisbon</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Europe/London'){ echo "selected";}?> value="Europe/London">(GMT) Greenwich Mean Time : London</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Africa/Abidjan'){ echo "selected";}?> value="Africa/Abidjan">(GMT) Monrovia, Reykjavik</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Europe/Amsterdam'){ echo "selected";}?> value="Europe/Amsterdam">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Europe/Belgrade'){ echo "selected";}?> value="Europe/Belgrade">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Europe/Brussels'){ echo "selected";}?> value="Europe/Brussels">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Africa/Algiers'){ echo "selected";}?> value="Africa/Algiers">(GMT+01:00) West Central Africa</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Africa/Windhoek'){ echo "selected";}?> value="Africa/Windhoek">(GMT+01:00) Windhoek</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Asia/Beirut'){ echo "selected";}?> value="Asia/Beirut">(GMT+02:00) Beirut</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Africa/Cairo'){ echo "selected";}?> value="Africa/Cairo">(GMT+02:00) Cairo</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Asia/Gaza'){ echo "selected";}?> value="Asia/Gaza">(GMT+02:00) Gaza</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Africa/Blantyre'){ echo "selected";}?> value="Africa/Blantyre">(GMT+02:00) Harare, Pretoria</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Asia/Jerusalem'){ echo "selected";}?> value="Asia/Jerusalem">(GMT+02:00) Jerusalem</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Europe/Minsk'){ echo "selected";}?> value="Europe/Minsk">(GMT+02:00) Minsk</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Asia/Damascus'){ echo "selected";}?> value="Asia/Damascus">(GMT+02:00) Syria</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Europe/Moscow'){ echo "selected";}?> value="Europe/Moscow">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Africa/Addis_Ababa'){ echo "selected";}?> value="Africa/Addis_Ababa">(GMT+03:00) Nairobi</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Asia/Tehran'){ echo "selected";}?> value="Asia/Tehran">(GMT+03:30) Tehran</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Asia/Dubai'){ echo "selected";}?> value="Asia/Dubai">(GMT+04:00) Abu Dhabi, Muscat</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Asia/Yerevan'){ echo "selected";}?> value="Asia/Yerevan">(GMT+04:00) Yerevan</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Asia/Kabul'){ echo "selected";}?> value="Asia/Kabul">(GMT+04:30) Kabul</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Asia/Yekaterinburg'){ echo "selected";}?> value="Asia/Yekaterinburg">(GMT+05:00) Ekaterinburg</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Asia/Tashkent'){ echo "selected";}?> value="Asia/Tashkent">(GMT+05:00) Tashkent</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Asia/Kolkata'){ echo "selected";}?> value="Asia/Kolkata">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Asia/Katmandu'){ echo "selected";}?> value="Asia/Katmandu">(GMT+05:45) Kathmandu</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Asia/Dhaka'){ echo "selected";}?> value="Asia/Dhaka">(GMT+06:00) Astana, Dhaka</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Asia/Novosibirsk'){ echo "selected";}?> value="Asia/Novosibirsk">(GMT+06:00) Novosibirsk</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Asia/Rangoon'){ echo "selected";}?> value="Asia/Rangoon">(GMT+06:30) Yangon (Rangoon)</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Asia/Bangkok'){ echo "selected";}?> value="Asia/Bangkok">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Asia/Krasnoyarsk'){ echo "selected";}?> value="Asia/Krasnoyarsk">(GMT+07:00) Krasnoyarsk</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Asia/Hong_Kong'){ echo "selected";}?> value="Asia/Hong_Kong">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Asia/Irkutsk'){ echo "selected";}?> value="Asia/Irkutsk">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Australia/Perth'){ echo "selected";}?> value="Australia/Perth">(GMT+08:00) Perth</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Australia/Eucla'){ echo "selected";}?> value="Australia/Eucla">(GMT+08:45) Eucla</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Asia/Tokyo'){ echo "selected";}?> value="Asia/Tokyo">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Asia/Seoul'){ echo "selected";}?> value="Asia/Seoul">(GMT+09:00) Seoul</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Asia/Yakutsk'){ echo "selected";}?> value="Asia/Yakutsk">(GMT+09:00) Yakutsk</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Australia/Adelaide'){ echo "selected";}?> value="Australia/Adelaide">(GMT+09:30) Adelaide</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Australia/Darwin'){ echo "selected";}?> value="Australia/Darwin">(GMT+09:30) Darwin</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Australia/Brisbane'){ echo "selected";}?> value="Australia/Brisbane">(GMT+10:00) Brisbane</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Australia/Hobart'){ echo "selected";}?> value="Australia/Hobart">(GMT+10:00) Hobart</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Asia/Vladivostok'){ echo "selected";}?> value="Asia/Vladivostok">(GMT+10:00) Vladivostok</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Australia/Lord_Howe'){ echo "selected";}?> value="Australia/Lord_Howe">(GMT+10:30) Lord Howe Island</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Etc/GMT-11'){ echo "selected";}?> value="Etc/GMT-11">(GMT+11:00) Solomon Is., New Caledonia</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Asia/Magadan'){ echo "selected";}?> value="Asia/Magadan">(GMT+11:00) Magadan</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Pacific/Norfolk'){ echo "selected";}?> value="Pacific/Norfolk">(GMT+11:30) Norfolk Island</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Asia/Anadyr'){ echo "selected";}?> value="Asia/Anadyr">(GMT+12:00) Anadyr, Kamchatka</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Pacific/Auckland'){ echo "selected";}?> value="Pacific/Auckland">(GMT+12:00) Auckland, Wellington</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Etc/GMT-12'){ echo "selected";}?> value="Etc/GMT-12">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Pacific/Chatham'){ echo "selected";}?> value="Pacific/Chatham">(GMT+12:45) Chatham Islands</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Pacific/Tongatapu'){ echo "selected";}?> value="Pacific/Tongatapu">(GMT+13:00) Nuku'alofa</option>
                                                <option <?php if($setting->get_option('ct_timezone')=='Pacific/Kiritimati'){ echo "selected";}?> value="Pacific/Kiritimati">(GMT+14:00) Kiritimati</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['companyname'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" id="company_name" class="form-control" size="35" name="ct_company_name" value="<?php echo $setting->get_option('ct_company_name');?>" placeholder="<?php echo $label_language_values['company_name'];?>" />
											<a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['company_name_is_used_for_invoice_purpose'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                        </div>
                                        
                                    </td>
                                </tr>
                                <tr>
								    <td><label><?php echo $label_language_values['company_email'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="company_email" size="35" name="ct_company_email" value="<?php echo $setting->get_option('ct_company_email');?>" placeholder="<?php echo $label_language_values['company_email'];?>" />
                                        </div>
                                    </td>
                                </tr>
								<tr>
                                    <td><?php echo $label_language_values['default_country_code'];?></td>
                                    <td>
                                        <div class="form-group">
                                            <div class="cta-country-code-flag" id="country_phone_code_div">
                                                <?php $country_codes = explode(',',$setting->get_option("ct_company_country_code"));?>
                                                <input type="tel" id="company_country_code" class="form-control cta-col6" value="<?php echo $country_codes[0];?>" name="ct_company_country_code" />
                                                <label class="numbercode hide"><?php echo $country_codes[0];?></label>
                                                <label class="alphacode hide"><?php echo $country_codes[1];?></label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
								<tr>
                                    <td><label><?php echo $label_language_values['company_phone'];?></label></td>
                                    <td>
										<div class="input-group">
												<span class="input-group-addon"><span class="company_country_code_value"><?php echo $country_codes[0];?></span></span>
												<input type="text" class="form-control" id="company_phone" name="ct_company_phone" value="<?php echo str_replace($country_codes[0],'',$setting->get_option('ct_company_phone'));?>" placeholder="<?php echo $label_language_values['company_phone'];?>" />
											</div>
											<label for="company_phone" generated="true" class="error"></label>
										
                                    </td>
                                </tr>
								
								
                                <tr>
                                    <td><label><?php echo $label_language_values['company_address'];?></label></td>

                                    <td><div class="form-group">
                                            <div class="cta-col12"><textarea id="company_address" name="ct_company_address" class="form-control" cols="44"><?php echo $setting->get_option('ct_company_address');?></textarea></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><div class="form-group">
                                            <div class="cta-col6 ct-w-50">
                                                <input type="text" class="form-control" id="company_city" name="ct_company_city" value="<?php echo $setting->get_option('ct_company_city');?>" placeholder="<?php echo $label_language_values['city'];?>" />
                                            </div>
                                            <div class="cta-col6 ct-w-50 float-right">
                                                <input type="text" class="form-control" id="company_state" name="ct_company_state" value="<?php echo $setting->get_option('ct_company_state');?>" placeholder="<?php echo $label_language_values['state'];?>" />
                                            </div>
                                        </div>
                                    </td>
                                </tr>
								<tr>
                                    <td></td>
                                    <td>
                                        <div class="form-group">
                                            <div class="cta-col6 ct-w-50">
                                                <input type="text" class="form-control" id="company_zip" name="ct_company_zip" value="<?php echo $setting->get_option('ct_company_zip_code');?>" placeholder="<?php echo $label_language_values['zip'];?>" />
                                            </div>
                                            <div class="cta-col6 ct-w-50 float-right">
                                                <input type="text" class="form-control" id="company_country" name="ct_company_country" value="<?php echo $setting->get_option('ct_company_country');?>" placeholder="<?php echo $label_language_values['country'];?>" />
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['company_logo'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <div class="ct-company-logo-uploader">
                                                <?php
                                                if($setting->get_option('ct_company_logo')==''){
                                                    $imagepath=SITE_URL."assets/images/company-logo.png";
                                                }else{
                                                    $imagepath=SITE_URL."assets/images/services/".$setting->get_option('ct_company_logo');

                                                }?>
                                                <img id="ctsisalonlogo" src="<?php echo $imagepath;?>" class="ct-company-logo br-5">
                                                <?php
                                                if($setting->get_option('ct_company_logo')==''){
                                                    ?>
                                                    <label for="ct-upload-imagectsi" class="ct-company-logo-icon-label set_cam_icon">
                                                        <i class="ct-camera-icon-common br-100 fa fa-camera"></i>
                                                        <i class="pull-left fa fa-plus-circle fa-2x"></i>
                                                    </label>
                                                <?php
                                                }
                                                ?>
                                                <input data-us="ctsi" class="hide ct-upload-images" type="file" name="" id="ct-upload-imagectsi"/>
                                                <label for="ct-upload-imagectsi" class="ct-company-logo-icon-label set_newcam_icon">
                                                    <i class="ct-camera-icon-common br-100 fa fa-camera"></i>
                                                    <i class="pull-left fa fa-plus-circle fa-2x"></i>
                                                </label>
                                                <?php
                                                if($setting->get_option('ct_company_logo')!==''){
                                                    ?>
                                                    <a id="ct-remove-company-logo-new" class="pull-left br-100 btn-danger bt-remove-company-logo btn-xs del_set_popup" rel="popover" data-placement='left' title="<?php echo $label_language_values['remove_image'];?>?"> <i class="fa fa-trash" title="<?php echo $label_language_values['remove_company_logo'];?>"></i></a>
                                                <?php
                                                }
                                                ?>
                                                <a id="ct-remove-company-logo-new" class="pull-left br-100 btn-danger bt-remove-company-logo btn-xs del_btn" rel="popover" data-placement='left' title="<?php echo $label_language_values['remove_image'];?>?"> <i class="fa fa-trash" title="<?php echo $label_language_values['remove_company_logo'];?>"></i></a>
                                                <div id="popover-ct-remove-company-logo-new" style="display: none;">
                                                    <div class="arrow"></div>
                                                    <table class="form-horizontal" cellspacing="0">
                                                        <tbody>
                                                        <tr>
                                                            <td>
                                                                <a id="ct-close-popover-salon-logo" value="Delete" class="btn btn-danger btn-sm delete_com_logo" data-comp_id="<?php echo $setting->ct_company_logo;?>" type="submit"><?php echo $label_language_values['yes'];?></a>
                                                                <a href="javascript:void(0)" id="ct-close-popover-salon-logoctsi" class="btn btn-default btn-sm" href="javascript:void(0)"><?php echo $label_language_values['cancel'];?></a>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <label class="error_image"></label>
                                                <div class="ct-salon-logo-popup-view">

                                                    <div id="ct-image-upload-popupctsi" class="ct-image-upload-popup modal fade" tabindex="-1" role="dialog">
                                                        <div class="vertical-alignment-helper">
                                                            <div class="modal-dialog modal-md vertical-align-center">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <div class="col-md-12 col-xs-12">

                                                                            <a data-us="ctsi" class="btn btn-success ct_upload_img3"  data-imageinputid="ct-upload-imagectsi"><?php echo $label_language_values['crop_and_save'];?></a>
                                                                            
                                                                            <button type="button" class="btn btn-default hidemodal" data-dismiss="modal" aria-hidden="true"><?php echo $label_language_values['cancel'];?></button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <img id="ct-preview-imgctsi" class="ct-preview-img" name="image" />
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <div class="col-md-12 np">
                                                                            <div class="col-md-4 col-xs-12">
                                                                                <label class="pull-left"><?php echo $label_language_values['file_size'];?></label> <input type="text" class="form-control" id="ctsifilesize" name="filesize" />
                                                                            </div>
                                                                            <div class="col-md-4 col-xs-12">
                                                                                <label class="pull-left">H</label> <input type="text" class="form-control" id="ctsih" name="h" />
                                                                            </div>
                                                                            <div class="col-md-4 col-xs-12">
                                                                                <label class="pull-left">W</label> <input type="text" class="form-control" id="ctsiw" name="w" />
                                                                            </div>
                                                                            <input type="hidden" id="ctsix1" name="x1" />
                                                                            <input type="hidden" id="ctsiy1" name="y1" />
                                                                            <input type="hidden" id="ctsix2" name="x2" />
                                                                            <input type="hidden" id="ctsiy2" name="y2" />
                                                                            <input type="hidden" id="ctsiid" name="id" value="1" />
                                                                            <input type="hidden" name="ctimage" id="ctsictimage" />
                                                                            <input type="hidden" id="ctsictimagename" name="ctimagename" value="<?php echo $setting->ct_company_logo;?>" />
                                                                            <input type="hidden" id="ctsinewname" value="company_" />
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['company_logo_is_used_for_invoice_purpose'];?>."><i class="fa fa-info-circle fa-lg"></i></a>
                                    </td>
                                </tr><?php /*
									<tr>
										<td><label><?php echo $label_language_values['show_company_address_in_header'];?></label></td>
										<td>
											<div class="form-group">
												<label class="ctoggle-postal-code"  for="Show_comapny_address_header">
													<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if($setting->get_option('ct_company_header_address') == "Y") { echo "checked"; } ?>  id="Show_comapny_address" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
												</label>
											</div>
										</td>
									</tr>
									<tr>
										<td><label><?php echo $label_language_values['show_company_logo'];?></label></td>
										<td>
											<div class="form-group">
												<label class="ctoggle-postal-code"  for="show_company_logo_header">
													<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if($setting->get_option('ct_company_logo_display') == "Y") { echo "checked"; } ?>  id="show_company_logo" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
												</label>
											</div>
										</td>
									</tr>
								
									<tr>
										<td><label><?php echo $label_language_values['show_description'];?></label></td>
										<td>
											<div class="form-group">
												<label class="ctoggle-postal-code"  for="show_company_logo_header">
													<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if($setting->get_option('ct_company_service_desc_status') == "Y") { echo "checked"; } ?>  id="show_desc_front" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
												</label>
											</div>
										</td>
									</tr>
									<tr>
										<td><label><?php echo $label_language_values['show_how_will_we_get_in'];?></label></td>
										<td>
											<div class="form-group">
												<label class="ctoggle-postal-code"  for="show_company_logo_header">
													<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if($setting->get_option('ct_company_willwe_getin_status') == "Y") { echo "checked"; } ?>  id="show_how_willwe_getin_front" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
												</label>
											</div>
										</td>
									</tr> */ ?>
								</tbody>

                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td>
                                        <a id="company_setting" name="" class="btn btn-success" ><?php echo $label_language_values['save_setting'];?></a>
									</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
            <!-- file upload preview -->


            <div class="tab-pane fade in" id="general-setting">
                <form id="general_setting_form" method="post" type="" class="ct-general-setting" >
                    <div class="panel panel-default">
                        <div class="panel-heading cta-top-right">
                            <h1 class="panel-title"><?php echo $label_language_values['general_settings'];?></h1>
                            <span class="pull-right cta-setting-fix-btn"> <a id="general_setting" name="" class="btn btn-success" ><?php echo $label_language_values['save_setting'];?></a></span>
                        </div>
                        <div class="panel-body pt-50 plr-10">
                            <table class="form-inline ct-common-table" >
                                <tbody>
								<tr>
                                    <td><label><?php echo $label_language_values['postal_codes'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label class="ctoggle-postal-code" for="postal-code">
                                                    <input class="cta-toggle-checkbox" data-toggle="toggle" data-size="small" type='checkbox' <?php if($setting->ct_postalcode_status=='Y'){echo 'checked';}?> id="postalcode" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
													
												 <a class="ct-tooltip-link" href="javascript:void(0)" data-toggle="tooltip" title="<?php echo $label_language_values['postal_codes_ed'];?>"><i class="fa fa-info-circle fa-lg"></i></a>	
                                                </label>
                                                <div class="hide-div mycollapse_postalcode pt-15" <?php if($setting->ct_postalcode_status=='Y'){echo 'style="display:block;"';}?>>
                                                    <textarea class="form-control" name="ct_postal_code" id="ct_postal_code" row="4" cols="40"><?php echo $setting->get_option_postal();?></textarea> 
													
													<a class="ct-tooltip-link" href="javascript:void(0)" data-toggle="tooltip" title="<?php echo $label_language_values['postal_codes_info'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </td>
                                </tr>
                                <tr>
                                    <td><label> <?php echo $label_language_values['time_interval'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <select name="ct_time_interval" id="time_interval" class="selectpicker" data-size="5" style="display: none;">
                                                <option  value="10" <?php if($setting->ct_time_interval=='10'){echo 'selected';} ?>>10 <?php echo $label_language_values['minutes'];?></option>
                                                <option  value="15" <?php if($setting->ct_time_interval=='15'){echo 'selected';} ?>>15 <?php echo $label_language_values['minutes'];?></option>
                                                <option  value="20" <?php if($setting->ct_time_interval=='20'){echo 'selected';} ?>>20 <?php echo $label_language_values['minutes'];?></option>
                                                <option  value="30" <?php if($setting->ct_time_interval=='30'){echo 'selected';} ?>>30 <?php echo $label_language_values['minutes'];?></option>
                                                <option  value="45" <?php if($setting->ct_time_interval=='45'){echo 'selected';} ?>>45 <?php echo $label_language_values['minutes'];?></option>
                                                <option  value="60" <?php if($setting->ct_time_interval=='60'){echo 'selected';} ?>>1 <?php echo $label_language_values['hours'];?></option>
                                                <option  value="90" <?php if($setting->ct_time_interval=='90'){echo 'selected';} ?>>1.5 <?php echo $label_language_values['hours'];?></option>
                                                <option  value="120" <?php if($setting->ct_time_interval=='120'){echo 'selected';} ?>>2 <?php echo $label_language_values['hours'];?></option>
                                                <option  value="150" <?php if($setting->ct_time_interval=='150'){echo 'selected';} ?>>2.5 <?php echo $label_language_values['hours'];?></option>
                                                <option  value="180" <?php if($setting->ct_time_interval=='180'){echo 'selected';} ?>>3 <?php echo $label_language_values['hours'];?></option>
                                            </select>
                                        </div>
                                        <a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['time_interval_is_helpful_to_show_time_difference_between_availability_time_slots'];?>."><i class="fa fa-info-circle fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label> <?php echo $label_language_values['minimum_advance_booking_time'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <select name="ct_min_advance_booking_time" id="ct_min_advance_booking_time" class="selectpicker" data-size="5" style="display: none;">
                                                <option value=""><?php echo $label_language_values['minimum_advance_booking_time'];?></option>
                                                <option  value="10" <?php if($setting->ct_min_advance_booking_time=='10'){echo 'selected';} ?>>10 <?php echo $label_language_values['minutes'];?></option>
                                                <option  value="20" <?php if($setting->ct_min_advance_booking_time=='20'){echo 'selected';} ?>>20 <?php echo $label_language_values['minutes'];?></option>
                                                <option  value="30" <?php if($setting->ct_min_advance_booking_time=='30'){echo 'selected';} ?>>30 <?php echo $label_language_values['minutes'];?></option>
                                                <option  value="40" <?php if($setting->ct_min_advance_booking_time=='40'){echo 'selected';} ?>>40 <?php echo $label_language_values['minutes'];?></option>
                                                <option  value="60" <?php if($setting->ct_min_advance_booking_time=='60'){echo 'selected';} ?>>1 <?php echo $label_language_values['hours'];?></option>
                                                <option  value="120" <?php if($setting->ct_min_advance_booking_time=='120'){echo 'selected';} ?>>2 <?php echo $label_language_values['hours'];?></option>
                                                <option  value="180" <?php if($setting->ct_min_advance_booking_time=='180'){echo 'selected';} ?>>3 <?php echo $label_language_values['hours'];?></option>
                                                <option  value="240" <?php if($setting->ct_min_advance_booking_time=='240'){echo 'selected';} ?>>4 <?php echo $label_language_values['hours'];?></option>
                                                <option  value="300" <?php if($setting->ct_min_advance_booking_time=='300'){echo 'selected';} ?>>5 <?php echo $label_language_values['hours'];?></option>
                                                <option  value="360" <?php if($setting->ct_min_advance_booking_time=='360'){echo 'selected';} ?>>6 <?php echo $label_language_values['hours'];?></option>
                                                <option  value="420" <?php if($setting->ct_min_advance_booking_time=='420'){echo 'selected';} ?>>7 <?php echo $label_language_values['hours'];?></option>
                                                <option  value="480" <?php if($setting->ct_min_advance_booking_time=='480'){echo 'selected';} ?>>8 <?php echo $label_language_values['hours'];?></option>
                                                <option  value="720" <?php if($setting->ct_min_advance_booking_time=='720'){echo 'selected';} ?>>12 <?php echo $label_language_values['hours'];?></option>
												
												<option  value="1440" <?php if($setting->ct_min_advance_booking_time=='1440'){echo 'selected';} ?>>24 <?php echo $label_language_values['hours'];?></option>
												
												<option  value="1440" <?php if($setting->ct_min_advance_booking_time=='1440'){echo 'selected';} ?>>1 <?php echo str_replace("s","",$label_language_values['days']);?></option>
												
												<option  value="2880" <?php if($setting->ct_min_advance_booking_time=='2880'){echo 'selected';} ?>>2 <?php echo $label_language_values['days'];?></option>
												
												<option  value="4320" <?php if($setting->ct_min_advance_booking_time=='4320'){echo 'selected';} ?>>3 <?php echo $label_language_values['days'];?></option>
												<option  value="5760" <?php if($setting->ct_min_advance_booking_time=='5760'){echo 'selected';} ?>>4 <?php echo $label_language_values['days'];?></option>
												<option  value="7200" <?php if($setting->ct_min_advance_booking_time=='7200'){echo 'selected';} ?>>5 <?php echo $label_language_values['days'];?></option>
												<option  value="8640" <?php if($setting->ct_min_advance_booking_time=='8640'){echo 'selected';} ?>>6 <?php echo $label_language_values['days'];?></option>
												
                                                <option value="10080" <?php if($setting->ct_min_advance_booking_time=='10080'){echo 'selected';} ?>>7 <?php echo $label_language_values['days'];?></option>
                                            </select>
                                        </div>
                                        <a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['minimum_advance_booking_time_restrict_client_to_book_last_minute_booking_so_that_you_should_have_sufficient_time_before_appointment'];?>."><i class="fa fa-info-circle fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['maximum_advance_booking_time'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <select name="ct_max_advance_booking_time" id="ct_max_advance_booking_time"  class="selectpicker" data-size="5" style="display: none;">
                                                <option value="" <?php if($setting->ct_max_advance_booking_time==''){echo 'selected';} ?>><?php echo $label_language_values['maximum_advance_booking_time'];?></option>
                                                <option value="1" <?php if($setting->ct_max_advance_booking_time=='1'){echo 'selected';} ?>>1 <?php echo $label_language_values['months'];?></option>
                                                <option value="2" <?php if($setting->ct_max_advance_booking_time=='2'){echo 'selected';} ?>>2 <?php echo $label_language_values['months'];?></option>
                                                <option value="3" <?php if($setting->ct_max_advance_booking_time=='3'){echo 'selected';} ?>>3 <?php echo $label_language_values['months'];?></option>
                                                <option value="4" <?php if($setting->ct_max_advance_booking_time=='4'){echo 'selected';} ?>>4 <?php echo $label_language_values['months'];?></option>
                                                <option value="5" <?php if($setting->ct_max_advance_booking_time=='5'){echo 'selected';} ?>>5 <?php echo $label_language_values['months'];?></option>
                                                <option value="6" <?php if($setting->ct_max_advance_booking_time=='6'){echo 'selected';} ?>>6 <?php echo $label_language_values['months'];?></option>
                                                <option value="12" <?php if($setting->ct_max_advance_booking_time=='12'){echo 'selected';} ?>>1 <?php echo $label_language_values['year'];?></option>
                                                <option  value="24" <?php if($setting->ct_max_advance_booking_time=='24'){echo 'selected';} ?>>2 <?php echo $label_language_values['year'];?></option>
                                                <option  value="36" <?php if($setting->ct_max_advance_booking_time=='36'){echo 'selected';} ?>>3 <?php echo $label_language_values['year'];?></option>
                                                <option value="48" <?php if($setting->ct_max_advance_booking_time=='48'){echo 'selected';} ?>>4 <?php echo $label_language_values['year'];?></option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['cancellation_buffer_time'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <select name="ct_cancellation_buffer_time" id="ct_cancellation_buffer_time" class="selectpicker" data-size="5" style="display: none;">
                                                <option value=""><?php echo $label_language_values['cancellation_buffer_time'];?></option>
                                                <option  value="60" <?php if($setting->ct_cancellation_buffer_time=='60'){echo 'selected';} ?> >1 <?php echo $label_language_values['hours'];?></option>
                                                <option value="120" <?php if($setting->ct_cancellation_buffer_time=='120'){echo 'selected';} ?> >2 <?php echo $label_language_values['hours'];?></option>
                                                <option value="180" <?php if($setting->ct_cancellation_buffer_time=='180'){echo 'selected';} ?> >3 <?php echo $label_language_values['hours'];?></option>
                                                <option value="240" <?php if($setting->ct_cancellation_buffer_time=='240'){echo 'selected';} ?> >4 <?php echo $label_language_values['hours'];?></option>
                                                <option value="300" <?php if($setting->ct_cancellation_buffer_time=='300'){echo 'selected';} ?> >5 <?php echo $label_language_values['hours'];?></option>
                                                <option value="360" <?php if($setting->ct_cancellation_buffer_time=='360'){echo 'selected';} ?>>6 <?php echo $label_language_values['hours'];?></option>
                                                <option value="420" <?php if($setting->ct_cancellation_buffer_time=='420'){echo 'selected';} ?>>7 <?php echo $label_language_values['hours'];?></option>
                                                <option value="480" <?php if($setting->ct_cancellation_buffer_time=='480'){echo 'selected';} ?>>8 <?php echo $label_language_values['hours'];?></option>
                                                <option value="540" <?php if($setting->ct_cancellation_buffer_time=='540'){echo 'selected';} ?>>9 <?php echo $label_language_values['hours'];?></option>
                                                <option value="600" <?php if($setting->ct_cancellation_buffer_time=='600'){echo 'selected';} ?>>10 <?php echo $label_language_values['hours'];?></option>
                                                <option value="660" <?php if($setting->ct_cancellation_buffer_time=='660'){echo 'selected';} ?>>11 <?php echo $label_language_values['hours'];?></option>
                                                <option value="720" <?php if($setting->ct_cancellation_buffer_time=='720'){echo 'selected';} ?>>12 <?php echo $label_language_values['hours'];?></option>
                                                <option value="1440" <?php if($setting->ct_cancellation_buffer_time=='1440'){echo 'selected';} ?>>24 <?php echo $label_language_values['hours'];?></option>
                                                <option value="2880" <?php if($setting->ct_cancellation_buffer_time=='2880'){echo 'selected';} ?>>48 <?php echo $label_language_values['hours'];?></option>
                                                <option value="4320" <?php if($setting->ct_cancellation_buffer_time=='4320'){echo 'selected';} ?>>72 <?php echo $label_language_values['hours'];?></option>
                                                <option value="5760" <?php if($setting->ct_cancellation_buffer_time=='5760'){echo 'selected';} ?>>96 <?php echo $label_language_values['hours'];?></option>
											 </select>
                                        </div>
                                        <a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['cancellation_buffer_helps_service_providers_to_avoid_last_minute_cancellation_by_their_clients'];?>."><i class="fa fa-info-circle fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['reshedule_buffer_time'];?> </label></td>
                                    <td>
                                        <div class="form-group">
                                            <select class="selectpicker" name="ct_reshedule_buffer_time" id="ct_reshedule_buffer_time" data-size="5"  style="display: none;">
                                                <option value=""><?php echo $label_language_values['reshedule_buffer_time'];?></option>
                                                <option value="60" <?php if($setting->ct_reshedule_buffer_time=='60'){echo 'selected';} ?> >1 <?php echo $label_language_values['hours'];?></option>
                                                <option value="120" <?php if($setting->ct_reshedule_buffer_time=='120'){echo 'selected';} ?> >2 <?php echo $label_language_values['hours'];?></option>
                                                <option  value="180" <?php if($setting->ct_reshedule_buffer_time=='180'){echo 'selected';} ?> >3 <?php echo $label_language_values['hours'];?></option>
                                                <option value="240" <?php if($setting->ct_reshedule_buffer_time=='240'){echo 'selected';} ?> >4 <?php echo $label_language_values['hours'];?></option>
                                                <option value="300" <?php if($setting->ct_reshedule_buffer_time=='300'){echo 'selected';} ?> >5 <?php echo $label_language_values['hours'];?></option>
                                                <option value="360" <?php if($setting->ct_reshedule_buffer_time=='360'){echo 'selected';} ?> >6 <?php echo $label_language_values['hours'];?></option>
                                                <option value="420" <?php if($setting->ct_reshedule_buffer_time=='420'){echo 'selected';} ?> >7 <?php echo $label_language_values['hours'];?></option>
                                                <option value="480" <?php if($setting->ct_reshedule_buffer_time=='480'){echo 'selected';} ?> >8 <?php echo $label_language_values['hours'];?></option>
                                                <option value="540" <?php if($setting->ct_reshedule_buffer_time=='540'){echo 'selected';} ?> >9 <?php echo $label_language_values['hours'];?></option>
                                                <option value="600" <?php if($setting->ct_reshedule_buffer_time=='600'){echo 'selected';} ?> >10 <?php echo $label_language_values['hours'];?></option>
                                                <option value="660" <?php if($setting->ct_reshedule_buffer_time=='660'){echo 'selected';} ?> >11 <?php echo $label_language_values['hours'];?></option>
                                                <option value="720" <?php if($setting->ct_reshedule_buffer_time=='720'){echo 'selected';} ?> >12 <?php echo $label_language_values['hours'];?></option>
                                            </select>
                                        </div>
                                        <!-- <a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="Lorem ipsem"><i class="fa fa-info-circle fa-lg"></i></a> -->
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['currency'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <select name="ct_currency" class="selectpicker form-control" data-live-search="true" id="ct_currency" data-size="5" data-live-search-placeholder="<?php echo $label_language_values['search'];?>" data-actions-box="true" >
                                                <option value=""><?php echo"-- Select Currency --";?></option>
                                                <option value="ALL" <?php if($setting->ct_currency =='ALL' ){ echo ' selected '; }?>>Lek <?php echo "Albania Lek";?></option>

                                                <option value="AED" <?php if($setting->ct_currency =='AED' ){ echo ' selected '; }?>>د.إ <?php echo "UAE Dirham";?></option>

                                                <option value="AFN" <?php if($setting->ct_currency =='AFN' ){ echo ' selected '; }?>>؋ <?php echo "Afghanistan Afghani";?></option>
                                                <option value="ARS" <?php if($setting->ct_currency =='ARS' ){ echo ' selected '; }?>>$ <?php echo "Argentina Peso";?></option>


                                                <option value="ANG" <?php if($setting->ct_currency =='ANG' ){ echo ' selected '; }?>>NAƒ <?php echo "Neth Antilles Guilder";?></option>

                                                <option value="AWG" <?php if($setting->ct_currency =='AWG' ){ echo ' selected '; }?>>ƒ <?php echo "Aruba Guilder";?></option>
                                                <option value="AUD" <?php if($setting->ct_currency =='AUD' ){ echo ' selected '; }?>>$ <?php echo "Australia Dollar";?></option>
                                                <option value="AZN" <?php if($setting->ct_currency =='AZN' ){ echo ' selected '; }?>>ман <?php echo "Azerbaijan Manat";?></option>
                                                <option value="BSD" <?php if($setting->ct_currency =='BSD' ){ echo ' selected '; }?>>$ <?php echo "Bahamas Dollar";?></option>
                                                <option value="BBD" <?php if($setting->ct_currency =='BBD' ){ echo ' selected '; }?>>$ <?php echo "Barbados Dollar";?></option>
                                                <option value="BYR" <?php if($setting->ct_currency =='BYR' ){ echo ' selected '; }?>>p <?php echo "Belarus Ruble";?></option>
                                                <option value="BZD" <?php if($setting->ct_currency =='BZD' ){ echo ' selected '; }?>>BZ$ <?php echo "Belize Dollar";?></option>
                                                <option value="BMD" <?php if($setting->ct_currency =='BMD' ){ echo ' selected '; }?>>$ <?php echo "Bermuda Dollar";?></option>
                                                <option value="BOB" <?php if($setting->ct_currency =='BOB' ){ echo ' selected '; }?>>$b <?php echo "Bolivia	Boliviano";?></option>
                                                <option value="BAM" <?php if($setting->ct_currency =='BAM' ){ echo ' selected '; }?>>KM <?php echo "Bosnia and Herzegovina Convertible Marka";?></option>
                                                <option value="BWP" <?php if($setting->ct_currency =='BWP' ){ echo ' selected '; }?>>P <?php echo "Botswana Pula";?></option>
                                                <option value="BGN" <?php if($setting->ct_currency =='BGN' ){ echo ' selected '; }?>>лв <?php echo "Bulgaria Lev";?></option>
                                                <option value="BRL" <?php if($setting->ct_currency =='BRL' ){ echo ' selected '; }?>>R$ <?php echo "Brazil Real";?></option>
                                                <option value="BND" <?php if($setting->ct_currency =='BND' ){ echo ' selected '; }?>>$ <?php echo "Brunei Darussalam Dollar";?></option>

                                                <option value="BDT" <?php if($setting->ct_currency =='BDT' ){ echo ' selected '; }?>>Tk <?php echo "Bangladesh Taka";?></option>
                                                <option value="BIF" <?php if($setting->ct_currency =='BIF' ){ echo ' selected '; }?>>FBu <?php echo "Burundi Franc";?></option>

                                                <option value="CHF" <?php if($setting->ct_currency =='CHF' ){ echo ' selected '; }?>>CHF<?php echo "Swiss Franc";?></option>


                                                <option value="KHR" <?php if($setting->ct_currency =='KHR' ){ echo ' selected '; }?>>៛  <?php echo "Cambodia Riel";?></option>
                                                <option value="KMF" <?php if($setting->ct_currency =='KMF' ){ echo ' selected '; }?>>KMF <?php echo "Comoros Franc";?></option>

                                                <option value="CAD" <?php if($setting->ct_currency =='CAD' ){ echo ' selected '; }?>>$ <?php echo "Canada Dollar";?></option>
                                                <option value="KYD" <?php if($setting->ct_currency =='KYD' ){ echo ' selected '; }?>>$ <?php echo "Cayman Dollar";?></option>

                                                <option value="CLP" <?php if($setting->ct_currency =='CLP' ){ echo ' selected '; }?>>$ <?php echo "Chile Peso";?></option>
                                                <option value="CYN" <?php if($setting->ct_currency =='CYN' ){ echo ' selected '; }?>>¥ <?php echo "China Yuan Renminbi";?></option>

                                                <option value="CVE" <?php if($setting->ct_currency =='CVE' ){ echo ' selected '; }?>>Esc <?php echo "Cape Verde Escudo";?></option>

                                                <option value="COP" <?php if($setting->ct_currency =='COP' ){ echo ' selected '; }?>>$ <?php echo "Colombia Peso";?></option>
                                                <option value="CRC" <?php if($setting->ct_currency =='CRC' ){ echo ' selected '; }?>>₡ <?php echo "Costa Rica Colon";?></option>
                                                <option value="HRK" <?php if($setting->ct_currency =='HRK' ){ echo ' selected '; }?>>kn <?php echo "Croatia	Kuna";?></option>
                                                <option value="CUP" <?php if($setting->ct_currency =='CUP' ){ echo ' selected '; }?>>₱ <?php echo "Cuba Peso";?></option>
                                                <option value="CZK" <?php if($setting->ct_currency =='CZK' ){ echo ' selected '; }?>>Kč <?php echo "Czech Republic Koruna";?></option>
                                                <option value="DKK" <?php if($setting->ct_currency =='DKK' ){ echo ' selected '; }?>>kr <?php echo "Denmark	Krone";?></option>
                                                <option value="DOP" <?php if($setting->ct_currency =='DOP' ){ echo ' selected '; }?>>RD$ <?php echo "Dominican Republic Peso";?></option>

                                                <option value="DJF" <?php if($setting->ct_currency =='DJF' ){ echo ' selected '; }?>>Fdj <?php echo "Djibouti Franc";?></option>
                                                <option value="DZD" <?php if($setting->ct_currency =='DZD' ){ echo ' selected '; }?>>دج <?php echo "Algerian Dinar";?></option>


                                                <option value="XCD" <?php if($setting->ct_currency =='XCD' ){ echo ' selected '; }?>>$  <?php echo "East Caribbean Dollar";?></option>
                                                <option value="EGP" <?php if($setting->ct_currency =='EGP' ){ echo ' selected '; }?>>£ <?php echo "Egypt Pound";?></option>

                                                <option value="ETB" <?php if($setting->ct_currency =='ETB' ){ echo ' selected '; }?>>Br <?php echo "Ethiopian Birr";?></option>

                                                <option value="SVC" <?php if($setting->ct_currency =='SVC' ){ echo ' selected '; }?>>$  <?php echo "El Salvador Colon";?></option>
                                                <option value="EEK" <?php if($setting->ct_currency =='EEK' ){ echo ' selected '; }?>>kr <?php echo "Estonia Kroon";?></option>
                                                <option value="EUR" <?php if($setting->ct_currency =='EUR' ){ echo ' selected '; }?>>€  <?php echo "Euro Member Euro";?></option>
                                                <option value="FKP" <?php if($setting->ct_currency =='FKP' ){ echo ' selected '; }?>>£ <?php echo "Falkland Islands Pound";?></option>
                                                <option value="FJD" <?php if($setting->ct_currency =='FJD' ){ echo ' selected '; }?>>$  <?php echo "Fiji Dollar";?></option>

                                                <option value="GHC" <?php if($setting->ct_currency =='GHC' ){ echo ' selected '; }?>>¢ <?php echo "Ghana Cedis";?></option>
                                                <option value="GIP" <?php if($setting->ct_currency =='GIP' ){ echo ' selected '; }?>>£ <?php echo "Gibraltar Pound";?></option>

                                                <option value="GMD" <?php if($setting->ct_currency =='GMD' ){ echo ' selected '; }?>>D <?php echo "Gambian Dalasi";?></option>
                                                <option value="GNF" <?php if($setting->ct_currency =='GNF' ){ echo ' selected '; }?>>FG <?php echo "Guinea Franc";?></option>

                                                <option value="GTQ" <?php if($setting->ct_currency =='GTQ' ){ echo ' selected '; }?>>Q <?php echo "Guatemala Quetzal";?></option>
                                                <option value="GGP" <?php if($setting->ct_currency =='GGP' ){ echo ' selected '; }?>>£ <?php echo "Guernsey Pound";?></option>
                                                <option value="GYD" <?php if($setting->ct_currency =='GYD' ){ echo ' selected '; }?>>$ <?php echo "Guyana Dollar";?></option>

                                                <option value="HNL" <?php if($setting->ct_currency =='HNL' ){ echo ' selected '; }?>>L <?php echo "Honduras Lempira";?></option>
                                                <option value="HKD" <?php if($setting->ct_currency =='HKD' ){ echo ' selected '; }?>>$ <?php echo "Hong Kong Dollar";?></option>

                                                <option value="HRK" <?php if($setting->ct_currency =='HRK' ){ echo ' selected '; }?>>kn <?php echo "Croatian Kuna";?></option>
                                                <option value="HTG" <?php if($setting->ct_currency =='HTG' ){ echo ' selected '; }?>>G <?php echo "Haitian Gourde";?></option>


                                                <option value="HUF" <?php if($setting->ct_currency =='HUF' ){ echo ' selected '; }?>>Ft <?php echo "Hungary	Forint";?></option>
                                                <option value="ISK" <?php if($setting->ct_currency =='ISK' ){ echo ' selected '; }?>>kr <?php echo "Iceland	Krona";?></option>
                                                <option value="INR" <?php if($setting->ct_currency =='INR' ){ echo ' selected '; }?>>Rs <?php echo "India Rupee";?></option>
                                                <option value="IDR" <?php if($setting->ct_currency =='IDR' ){ echo ' selected '; }?>>Rp <?php echo "Indonesia Rupiah";?></option>
                                                <option value="IRR" <?php if($setting->ct_currency =='IRR' ){ echo ' selected '; }?>>﷼ <?php echo "Iran Rial";?></option>
                                                <option value="IMP" <?php if($setting->ct_currency =='IMP' ){ echo ' selected '; }?>>£ <?php echo "Isle of Man Pound";?></option>
                                                <option value="ILS" <?php if($setting->ct_currency =='ILS' ){ echo ' selected '; }?>>₪ <?php echo "Israel Shekel";?></option>
                                                <option value="JMD" <?php if($setting->ct_currency =='JMD' ){ echo ' selected '; }?>>J$ <?php echo "Jamaica Dollar";?></option>
                                                <option value="JPY" <?php if($setting->ct_currency =='JPY' ){ echo ' selected '; }?>>¥ <?php echo "Japan Yen";?></option>
                                                <option value="JEP" <?php if($setting->ct_currency =='JEP' ){ echo ' selected '; }?>>£ <?php echo "Jersey Pound";?></option>
                                                <option value="KZT" <?php if($setting->ct_currency =='KZT' ){ echo ' selected '; }?>>лв <?php echo "Kazakhstan Tenge";?></option>
                                                <option value="KPW" <?php if($setting->ct_currency =='KPW' ){ echo ' selected '; }?>>₩ <?php echo "Korea(North) Won";?></option>
                                                <option value="KRW" <?php if($setting->ct_currency =='KRW' ){ echo ' selected '; }?>>₩ <?php echo "Korea(South) Won";?></option>
                                                <option value="KGS" <?php if($setting->ct_currency =='KGS' ){ echo ' selected '; }?>>лв <?php echo "Kyrgyzstan Som";?></option>

                                                <option value="KES" <?php if($setting->ct_currency =='KES' ){ echo ' selected '; }?>>KSh <?php echo "Kenyan Shilling";?></option>


                                                <option value="LAK" <?php if($setting->ct_currency =='LAK' ){ echo ' selected '; }?>>₭ <?php echo "Laos	Kip";?></option>
                                                <option value="LVL" <?php if($setting->ct_currency =='LVL' ){ echo ' selected '; }?>>Ls <?php echo "Latvia Lat";?></option>
                                                <option value="LBP" <?php if($setting->ct_currency =='LBP' ){ echo ' selected '; }?>>£ <?php echo "Lebanon Pound";?></option>
                                                <option value="LRD" <?php if($setting->ct_currency =='LRD' ){ echo ' selected '; }?>>$ <?php echo "Liberia Dollar";?></option>
                                                <option value="LTL" <?php if($setting->ct_currency =='LTL' ){ echo ' selected '; }?>>Lt <?php echo "Lithuania Litas";?></option>
                                                <option value="MKD" <?php if($setting->ct_currency =='MKD' ){ echo ' selected '; }?>>ден <?php echo "Macedonia Denar";?>	</option>
                                                <option value="MYR" <?php if($setting->ct_currency =='MYR' ){ echo ' selected '; }?>>RM <?php echo "Malaysia Ringgit";?></option>
                                                <option value="MUR" <?php if($setting->ct_currency =='MUR' ){ echo ' selected '; }?>>₨ <?php echo "Mauritius Rupee";?></option>
                                                <option value="MXN" <?php if($setting->ct_currency =='MXN' ){ echo ' selected '; }?>>$ <?php echo "Mexico Peso";?></option>
                                                <option value="MNT" <?php if($setting->ct_currency =='MNT' ){ echo ' selected '; }?>>₮ <?php echo "Mongolia Tughrik";?></option>
                                                <option value="MZN" <?php if($setting->ct_currency =='MZN' ){ echo ' selected '; }?>>MT <?php echo "Mozambique Metical";?></option>

                                                <option value="MAD" <?php if($setting->ct_currency =='MAD' ){ echo ' selected '; }?>>د.م. <?php echo "Moroccan Dirham";?></option>
                                                <option value="MDL" <?php if($setting->ct_currency =='MDL' ){ echo ' selected '; }?>>MDL <?php echo "Moldovan Leu";?></option>
                                                <option value="MOP" <?php if($setting->ct_currency =='MOP' ){ echo ' selected '; }?>>$ <?php echo "Macau Pataca";?></option>
                                                <option value="MRO" <?php if($setting->ct_currency =='MRO' ){ echo ' selected '; }?>>UM <?php echo "Mauritania Ougulya";?></option>
                                                <option value="MVR" <?php if($setting->ct_currency =='MVR' ){ echo ' selected '; }?>>Rf <?php echo "Maldives Rufiyaa";?></option>
                                                <option value="PGK" <?php if($setting->ct_currency =='PGK' ){ echo ' selected '; }?>>K <?php echo "Papua New Guinea Kina";?></option>



                                                <option value="NAD" <?php if($setting->ct_currency =='NAD' ){ echo ' selected '; }?>>$ <?php echo "Namibia Dollar";?></option>
                                                <option value="NPR" <?php if($setting->ct_currency =='NPR' ){ echo ' selected '; }?>>₨ <?php echo "Nepal Rupee";?></option>
                                                <option value="ANG" <?php if($setting->ct_currency =='ANG' ){ echo ' selected '; }?>>ƒ <?php echo "Netherlands Antilles Guilder";?></option>
                                                <option value="NZD" <?php if($setting->ct_currency =='NZD' ){ echo ' selected '; }?>>$ <?php echo "New Zealand Dollar";?></option>
                                                <option value="NIO" <?php if($setting->ct_currency =='NIO' ){ echo ' selected '; }?>>C$ <?php echo "Nicaragua Cordoba";?></option>
                                                <option value="NGN" <?php if($setting->ct_currency =='NGN' ){ echo ' selected '; }?>>₦ <?php echo "Nigeria Naira";?></option>
                                                <option value="NOK" <?php if($setting->ct_currency =='NOK' ){ echo ' selected '; }?>>kr <?php echo "Norway Krone";?></option>
                                                <option value="OMR" <?php if($setting->ct_currency =='OMR' ){ echo ' selected '; }?>>﷼ <?php echo "Oman Rial";?></option>
                                                <option value="MWK" <?php if($setting->ct_currency =='MWK' ){ echo ' selected '; }?>>MK <?php echo "Malawi Kwacha";?></option>



                                                <option value="PKR" <?php if($setting->ct_currency =='PKR' ){ echo ' selected '; }?>>₨ <?php echo "Pakistan Rupee";?></option>
                                                <option value="PAB" <?php if($setting->ct_currency =='PAB' ){ echo ' selected '; }?>>B/ <?php echo "Panama Balboa";?></option>
                                                <option value="PYG" <?php if($setting->ct_currency =='PYG' ){ echo ' selected '; }?>>Gs <?php echo "Paraguay Guarani";?></option>
                                                <option value="PEN" <?php if($setting->ct_currency =='PEN' ){ echo ' selected '; }?>>S/ <?php echo "Peru Nuevo Sol";?></option>
                                                <option value="PHP" <?php if($setting->ct_currency =='PHP' ){ echo ' selected '; }?>>₱ <?php echo "Philippines Peso";?></option>
                                                <option value="PLN" <?php if($setting->ct_currency =='PLN' ){ echo ' selected '; }?>>zł <?php echo "Poland Zloty";?></option>
                                                <option value="QAR" <?php if($setting->ct_currency =='QAR' ){ echo ' selected '; }?>>﷼ <?php echo "Qatar Riyal";?></option>
                                                <option value="RON" <?php if($setting->ct_currency =='RON' ){ echo ' selected '; }?>>lei <?php echo "Romania New Leu";?></option>
                                                <option value="RUB" <?php if($setting->ct_currency =='RUB' ){ echo ' selected '; }?>>руб <?php echo "Russia Ruble";?></option>
                                                <option value="SHP" <?php if($setting->ct_currency =='SHP' ){ echo ' selected '; }?>>£ <?php echo "Saint Helena Pound";?></option>
                                                <option value="SAR" <?php if($setting->ct_currency =='SAR' ){ echo ' selected '; }?>>﷼ <?php echo "Saudi Arabia	Riyal";?></option>
                                                <option value="RSD" <?php if($setting->ct_currency =='RSD' ){ echo ' selected '; }?>>Дин <?php echo "Serbia Dinar";?></option>
                                                <option value="SCR" <?php if($setting->ct_currency =='SCR' ){ echo ' selected '; }?>>₨ <?php echo "Seychelles Rupee";?></option>
                                                <option value="SGD" <?php if($setting->ct_currency =='SGD' ){ echo ' selected '; }?>>$ <?php echo "Singapore	Dollar";?></option>
                                                <option value="SBD" <?php if($setting->ct_currency =='SBD' ){ echo ' selected '; }?>>$ <?php echo "Solomon Islands Dollar";?></option>
                                                <option value="SOS" <?php if($setting->ct_currency =='SOS' ){ echo ' selected '; }?>>S <?php echo "Somalia Shilling";?></option>

                                                <option value="SLL" <?php if($setting->ct_currency =='SLL' ){ echo ' selected '; }?>>Le <?php echo "Sierra Leone Leone";?></option>
                                                <option value="STD" <?php if($setting->ct_currency =='STD' ){ echo ' selected '; }?>>Db <?php echo "Sao Tome Dobra";?></option>
                                                <option value="SZL" <?php if($setting->ct_currency =='SZL' ){ echo ' selected '; }?>>SZL <?php echo "Swaziland Lilageni";?></option>

                                                <option value="ZAR" <?php if($setting->ct_currency =='ZAR' ){ echo ' selected '; }?>>R <?php echo "South Africa Rand";?></option>
                                                <option value="LKR" <?php if($setting->ct_currency =='LKR' ){ echo ' selected '; }?>>₨ <?php echo "Sri Lanka Rupee";?></option>
                                                <option value="SEK" <?php if($setting->ct_currency =='SEK' ){ echo ' selected '; }?>>kr <?php echo "Sweden Krona";?></option>
                                                <option value="CHF" <?php if($setting->ct_currency =='CHF' ){ echo ' selected '; }?>>CHF <?php echo "Switzerland Franc";?> </option>
                                                <option value="SRD" <?php if($setting->ct_currency =='SRD' ){ echo ' selected '; }?>>$ <?php echo "Suriname Dollar";?></option>
                                                <option value="SYP" <?php if($setting->ct_currency =='SYP' ){ echo ' selected '; }?>>£ <?php echo "Syria	Pound";?></option>

                                                <option value="TWD" <?php if($setting->ct_currency =='TWD' ){ echo ' selected '; }?>>NT <?php echo "Taiwan New Dollar";?></option>
                                                <option value="THB" <?php if($setting->ct_currency =='THB' ){ echo ' selected '; }?>>฿ <?php echo "Thailand Baht";?></option>

                                                <option value="TOP" <?php if($setting->ct_currency =='TOP' ){ echo ' selected '; }?>>T$ <?php echo "Tonga Pa'ang";?></option>
                                                <option value="TZS" <?php if($setting->ct_currency =='TZS' ){ echo ' selected '; }?>>x <?php echo "Tanzanian Shilling";?></option>


                                                <option value="TTD" <?php if($setting->ct_currency =='TTD' ){ echo ' selected '; }?>>TTD <?php echo "Trinidad and Tobago Dollar";?></option>
                                                <option value="TRY" <?php if($setting->ct_currency =='TRY' ){ echo ' selected '; }?>>₤ <?php echo "Turkey Lira";?></option>
                                                <option value="TVD" <?php if($setting->ct_currency =='TVD' ){ echo ' selected '; }?>>$ <?php echo "Tuvalu Dollar";?></option>
                                                <option value="UAH" <?php if($setting->ct_currency =='UAH' ){ echo ' selected '; }?>>₴ <?php echo "Ukraine Hryvna";?></option>

                                                <option value="UGX" <?php if($setting->ct_currency =='UGX' ){ echo ' selected '; }?>>USh <?php echo "Ugandan Shilling";?></option>

                                                <option value="GBP" <?php if($setting->ct_currency =='GBP' ){ echo ' selected '; }?>>£ <?php echo "United Kingdom Pound";?></option>
                                                <option value="USD" <?php if($setting->ct_currency =='USD' ){ echo ' selected '; }?>>$ <?php echo "United States	Dollar";?></option>
                                                <option value="UYU" <?php if($setting->ct_currency =='UYU' ){ echo ' selected '; }?>>$U <?php echo "Uruguay Peso";?></option>
                                                <option value="UZS" <?php if($setting->ct_currency =='UZS' ){ echo ' selected '; }?>>лв <?php echo "Uzbekistan Som";?></option>
                                                <option value="VEF" <?php if($setting->ct_currency =='VEF' ){ echo ' selected '; }?>>Bs <?php echo "Venezuela Bolivar Fuerte";?></option>
                                                <option value="VND" <?php if($setting->ct_currency =='VND' ){ echo ' selected '; }?>>₫ <?php echo "Viet Nam Dong";?></option>

                                                <option value="VUV" <?php if($setting->ct_currency =='VUV' ){ echo ' selected '; }?>>Vt <?php echo "Vanuatu Vatu";?></option>

                                                <option value="XAF" <?php if($setting->ct_currency =='XAF' ){ echo ' selected '; }?>>BEAC <?php echo "CFA Franc (BEAC)";?></option>
                                                <option value="XOF" <?php if($setting->ct_currency =='XOF' ){ echo ' selected '; }?>>BCEAO <?php echo "CFA Franc (BCEAO)";?></option>
                                                <option value="XPF" <?php if($setting->ct_currency =='XPF' ){ echo ' selected '; }?>>F <?php echo "Pacific Franc";?></option>

                                                <option value="YER" <?php if($setting->ct_currency =='YER' ){ echo ' selected '; }?>>﷼ <?php echo "Yemen	Rial";?></option>

                                                <option value="WST" <?php if($setting->ct_currency =='WST' ){ echo ' selected '; }?>>WS$ <?php echo "Samoa Tala";?></option>


                                                <option value="ZAR" <?php if($setting->ct_currency =='ZAR' ){ echo ' selected '; }?>>R <?php echo "South African Rand";?></option>
                                                <option value="ZWD" <?php if($setting->ct_currency =='ZWD' ){ echo ' selected '; }?>>Z$ <?php echo "Zimbabwe Dollar";?></option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['price_format_decimal_places'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <select class="selectpicker" id="ct_price_format_decimal_places" name="ct_price_format_decimal_places" data-size="10"  style="display: none;">
                                                <option value="0" <?php if($setting->ct_price_format_decimal_places=='0'){echo 'selected';} ?>>0 (e.g.$100)</option>
                                                <option value="1" <?php if($setting->ct_price_format_decimal_places=='1'){echo 'selected';} ?>>1 (e.g.$100.0)</option>
                                                <option value="2" <?php if($setting->ct_price_format_decimal_places=='2'){echo 'selected';} ?>>2 (e.g.$100.00)</option>
                                                <option value="3" <?php if($setting->ct_price_format_decimal_places=='3'){echo 'selected';} ?>>3 (e.g.$100.000)</option>
                                                <option value="4" <?php if($setting->ct_price_format_decimal_places=='4'){echo 'selected';} ?>>4 (e.g.$100.0000)</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['currency_symbol_position'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <select name="ct_currency_symbol_position" id="ct_currency_symbol_position" class="selectpicker" style="display: none;">
                                                <option value="$100" <?php if($setting->ct_currency_symbol_position=='$100'){echo 'selected';} ?>><?php echo $label_language_values['before_e_g_100'];?></option>
                                                <option value="100$" <?php if($setting->ct_currency_symbol_position=='100$'){echo 'selected';} ?>><?php echo $label_language_values['after_e_g_100'];?></option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['tax_vat'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label class="ctoggle-tax-vat" for="tax-vat">
												<input class="cta-toggle-checkbox" data-toggle="toggle" data-size="small" type='checkbox' <?php if($setting->ct_tax_vat_status=='Y'){echo 'checked';}?> id="tax-vat" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
											</label>
                                            <div class="hide-div mycollapse_tax-vat" <?php if($setting->ct_tax_vat_status=='Y'){echo 'style="display:block;"';}?>>
                                                <div class="ct-custom-radio">
                                                    <ul class="ct-radio-list">
                                                        <li>
                                                            <input type="radio" id="tax-vat-percentage" class="cta-radio tax_vat_radio" name="tax-vat-radio" <?php if($setting->ct_tax_vat_type=='P'){echo 'checked';}?> value="P" />
                                                            <label for="tax-vat-percentage"><span></span> <?php echo $label_language_values['percentage'];?> </label>
                                                        </li>
                                                        <li>
                                                            <input type="radio" id="tax-vat-flatfree" class="ct_radio tax_vat_radio" name="tax-vat-radio" <?php if($setting->ct_tax_vat_type=='F'){ echo 'checked';}?> value="F" />
                                                            <label for="tax-vat-flatfree"><span></span><?php echo $label_language_values['flat_fee'];?></label>
                                                        </li>
                                                        <li class="ct-tax-vat-input-container">
                                                            <input type="text" class="form-control" name="ct_tax_vat_value" id="ct_tax_vat_value" value="<?php echo ($setting->ct_tax_vat_value); ?>" size="3" maxlength="5" />
                                                            <i class="ct-tax-percent <?php if($setting->ct_tax_vat_type=='P'){echo 'fa fa-percent';}?>"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['partial_deposit'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label class="ctoggle-patial-deposit" for="patial-deposit">
												<input class="cta-toggle-checkbox" data-toggle="toggle" data-size="small" type='checkbox' <?php if($setting->ct_partial_deposit_status=='Y'){echo 'checked';}?> id="patial-deposit" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                            </label>
                                            <a class="ct-tooltip-link pr-t0" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['partial_payment_option_will_help_you_to_charge_partial_payment_of_total_amount_from_client_and_remaining_you_can_collect_locally'];?>."><i class="fa fa-info-circle fa-lg"></i></a>
                                            <div <?php if($setting->ct_partial_deposit_status=='Y'){echo 'style="display:block;"';}?> class="hide-div mycollapse_patial-deposit">
                                                <div class="ct-custom-radio">
                                                    <ul class="ct-radio-list">
                                                        <li class="ct-partial-li-width">
                                                            <input type="radio" id="partial-percentage" class="cta-radio partial_radio" checked="checked"  name="partial-radio" <?php if($setting->ct_partial_type=='P'){echo 'checked';}?> value="P" />
                                                            <label for="partial-percentage"><span></span> <?php echo $label_language_values['percentage'];?> </label>
                                                        </li>
                                                        <li class="ct-partial-li-width">
                                                            <input type="radio" id="partial-flatfree" class="ct_radio partial_radio" name="partial-radio" <?php if($setting->ct_partial_type=='F'){ echo 'checked';}?> value="F" />
                                                            <label for="partial-flatfree"><span></span><?php echo $label_language_values['flat_fee'];?></label>
                                                        </li>
                                                        <li class="ct-tax-vat-input-container">
															<span class="ct-tax-vat-input-container">
																<label class="pull-left mr-10"><?php echo $label_language_values['partial_deposit_amount'];?></label>
																<span class="ct-partial-input-per"><input type="text" class="form-control" id="ct_partial_deposit_amount" name="cta-partial-deposit" value="<?php echo ($setting->ct_partial_deposit_amount)?>" size="3" maxlength="3" /> <i class="ct-partial-deposit-percent <?php if($setting->ct_partial_type=='P'){echo 'fa fa-percent';}?>"></i></span>
															</span><br/>
                                                        </li>
                                                        <li>
                                                            <label><?php echo $label_language_values['partial_deposit_message'];?></label>

                                                            <textarea class="form-control" id="ct_partial_deposit_message" row="4" cols="40"><?php echo ($setting->ct_partial_deposit_message)?></textarea>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <span id="ct-partial-depost_error" style="color:red;"><?php echo $label_language_values['please_enable_payment_gateway'];?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>'<?php echo $label_language_values['thankyou_page_url'];?>'</label></td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" id="ct_thankyou_page_url" class="form-control" size="50" name="ct_thankyou_page_url" value="<?php echo ($setting->ct_thankyou_page_url)?>" placeholder="<?php echo $label_language_values['custom_thankyou_page_url'];?>" /><br />
                                            <i><?php echo $label_language_values['default_url_is'];?> : <?php if($setting->ct_thankyou_page_url == ''){ echo SITE_URL.'front/thankyou.php'; }else{ echo ($setting->ct_thankyou_page_url); } ?></i>
                                        </div>
                                    </td>
                                    </td>
                                </tr>
                                <tr><td><hr /></td><td><hr /></td></tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['cancellation_policy'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label class="ctoggle-cancel-policy" for="cancel-policy">
												<input class="cta-toggle-checkbox" data-toggle="toggle" data-size="small" type='checkbox' name="ct_cancelation_policy_status" <?php if ($setting->ct_cancelation_policy_status == 'Y') { echo 'checked'; } ?> id="cancel-policy" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
											  </label>

                                            <div <?php if ($setting->ct_cancelation_policy_status == 'Y') {
                                                echo 'style="display:block;"';
                                            } ?> class="hide-div mycollapse_cancel-policy">
                                                <div class="ct-custom-radio">
                                                    <ul class="ct-radio-list np mb-15">
                                                        <li class="w100">
                                                            <label><?php echo $label_language_values['cancellation_policy_header'];?></label>
                                                            <input type="text" class="w100 form-control" id="ct_cancel_policy_header" name="ct_cancel_policy_header" value="<?php echo($setting->ct_cancel_policy_header) ?>"/>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <label><?php echo $label_language_values['cancellation_policy_textarea'];?></label>
                                               <textarea class="form-control w100" id="ct_cancel_policy_textarea" name="ct_cancel_policy_textarea" row="4" cols="40"><?php echo($setting->ct_cancel_policy_textarea) ?></textarea>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr><td><hr /></td><td><hr /></td>

                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['allow_multiple_booking_for_same_timeslot'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label class="ctoggle-multiple-booking-same-time" for="multiple-booking-same-time">
												<input class="cta-toggle-checkbox" data-toggle="toggle" data-size="small" type='checkbox' name="ct_allow_multiple_booking_for_same_timeslot_status" <?php if($setting->ct_allow_multiple_booking_for_same_timeslot_status=='Y'){ echo 'checked';} ?> id="multiple-booking-same-time" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
											 </label>
                                        </div>
                                        <a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['allow_multiple_appointment_booking_at_same_time_slot_will_allow_you_to_show_availability_time_slot_even_you_have_booking_already_for_that_time'];?>."><i class="fa fa-info-circle fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['appointment_auto_confirm'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label class="ctoggle-appointment-auto-confirm" for="appointment-auto-confirm">
												<input data-toggle="toggle" data-size="small" type='checkbox' name="ct_appointment_auto_confirm_status" <?php if($setting->ct_appointment_auto_confirm_status=='Y'){echo 'checked';}?> id="appointment-auto-confirm" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
											</label>
                                        </div>
                                        <a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['with_Enable_of_this_feature_Appointment_request_from_clients_will_be_auto_confirmed'];?>."><i class="fa fa-info-circle fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['terms_and_condition'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label class="ctoggle-allow-dc-terms-condition" for="allow-dc-terms-condition">
												<input class="cta-toggle-checkbox" data-toggle="toggle" data-size="small" type='checkbox' name="ct_allow_terms_and_conditions" <?php if($setting->ct_allow_terms_and_conditions=='Y'){echo 'checked';}?> id="allow-dc-terms-condition" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
											 </label>
											<a class="ct-tooltip-link" href="javascript:void(0)" data-toggle="tooltip" title="<?php echo $label_language_values['terms_and_condition'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                            <div <?php if($setting->ct_allow_terms_and_conditions=='Y'){echo 'style="display:block;"';}?> class="hide-div mycollapse_allow-dc-terms-condition">
                                                <div class="ct-custom-radio">
                                                    <ul class="ct-radio-list">
                                                        <li>
                                                            <label><?php echo $label_language_values['terms_and_condition_link'];?></label>
                                                            <input type="text" class="form-control" size="50" id="ct_terms_condition_header" name="ct_terms_condition_header" value="<?php echo ($setting->ct_terms_condition_link);?>"></textarea>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                          
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['privacy_policy'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label class="ctoggle-allow-dc-privacy_policy" for="allow-dc-privacy_policy">
												<input class="cta-toggle-checkbox" data-toggle="toggle" data-size="small" type='checkbox' name="allow-dc-privacy_policy" <?php if($setting->ct_allow_privacy_policy=='Y'){echo 'checked';}?> id="allow-dc-privacy_policy" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
											</label>
											<a class="ct-tooltip-link" href="javascript:void(0)" data-toggle="tooltip" title="<?php echo $label_language_values['privacy_policy'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                            <div <?php if($setting->ct_allow_privacy_policy=='Y'){echo 'style="display:block;"';}?> class="hide-div mycollapse_allow-dc-privacy_policy">
                                                <div class="ct-custom-radio">
                                                    <ul class="ct-radio-list">
                                                        <li class="ct-privacy-policy-li-width">
                                                            <label><?php echo $label_language_values['privacy_policy'];?></label>
                                                            <input type="text" class="form-control" size="50" id="ct_privacy_policy_link" name="ct_privacy_policy_link" value="<?php echo ($setting->ct_privacy_policy_link);?>"></textarea>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td><label><?php echo $label_language_values['default_design_for_methods_with_multiple_units'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <select name="ct_method_default_design" id="ct_method_default_design" class="selectpicker" style="display: none;">
                                                <option value="2" <?php if($setting->ct_method_default_design=='2'){echo 'selected';} ?>><?php echo $label_language_values['dropdown_design'];?></option>
                                                <option value="3" <?php if($setting->ct_method_default_design=='3'){echo 'selected';} ?>><?php echo $label_language_values['blocks_as_button_design'];?></option>
                                                <option value="4" <?php if($setting->ct_method_default_design=='4'){echo 'selected';} ?>><?php echo $label_language_values['qty_control_design'];?></option>
                                            </select>

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['default_design_for_addons'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <select name="ct_addons_default_design" id="ct_addons_default_design" class="selectpicker" style="display: none;">
                                                <option value="1" <?php if($setting->ct_addons_default_design=='1'){echo 'selected';} ?>><?php echo $label_language_values['qty_control_design'];?></option>
                                                <option value="2" <?php if($setting->ct_addons_default_design=='2'){echo 'selected';} ?>><?php echo $label_language_values['blocks_as_button_design'];?></option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['default_design_for_services'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <select name="ct_service_default_design" id="ct_service_default_design" class="selectpicker" style="display: none;">
                                                <option value="1" <?php if($setting->ct_service_default_design=='1'){echo 'selected';} ?>><?php echo $label_language_values['big_images_radio'];?></option>
                                                <option value="2" <?php if($setting->ct_service_default_design=='2'){echo 'selected';} ?>><?php echo $label_language_values['dropdown_design'];?></option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
								<tr>
                                    <td><label><?php echo $label_language_values['change_calculation_policyy'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <select name="ct_service_default_design" id="ct_price_calculation_method" class="selectpicker" style="display: none;">
                                                <option value="M" <?php if($setting->get_option("ct_calculation_policy")=='M'){echo 'selected';} ?>><?php echo $label_language_values['multiply'];?></option>
                                                <option value="E" <?php if($setting->get_option("ct_calculation_policy")=='E'){echo 'selected';} ?>><?php echo $label_language_values['equal'];?></option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['right_side_description'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label class="ctoggle-ct_allow_front_desc" for="ct_allow_front_desc">
												<input class="cta-toggle-checkbox" data-toggle="toggle" data-size="small" type='checkbox' name="ct_allow_front_desc" <?php if($setting->ct_allow_front_desc=='Y'){echo 'checked';}?> id="ct_allow_front_desc" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
											</label>
											<a class="ct-tooltip-link" href="javascript:void(0)" data-toggle="tooltip" title="<?php echo $label_language_values['write_html_code_for_the_right_side_panel'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                           
                                        </div>
                                        <div <?php if($setting->ct_allow_front_desc=='Y'){echo 'style="display:block;"';}?> class="hide-div mycollapse_ct_allow_front_desc">
                                            <textarea class="form-control" id="ct_front_desc" row="12" cols="80"><?php echo ($setting->get_option('ct_front_desc'));?></textarea>
                                        </div>
                                    </td>
                                </tr>
                                <?php /*<tr>
                                    <td><label><?php echo $label_language_values['display_sub_headers_below_headers'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label class="ctoggle-ct_subheaders" for="ct_subheaders">
												<input data-toggle="toggle" data-size="small" type='checkbox' name="ct_subheaders" <?php if($setting->ct_subheaders=='Y'){echo 'checked';}?> id="ct_subheaders" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
											</label>
                                        </div>
                                        <a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['do_you_want_to_show_subheaders_below_the_headers'];?>."><i class="fa fa-info-circle fa-lg"></i></a>
                                    </td>
                                </tr>
								<tr>
                                    <td><label><?php echo $label_language_values['vaccum_cleaner_frontend_option_display_status'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label class="ctoggle-ct_vc_status" for="ct_vc_status">
												<input data-toggle="toggle" data-size="small" type='checkbox' name="ct_vc_status" <?php if($setting->ct_vc_status=='Y'){echo 'checked';}?> id="ct_vc_status" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
											</label>
                                        </div>
                                    </td>
                                </tr>
								<tr>
                                    <td><label><?php echo $label_language_values['parking_availability_frontend_option_display_status'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label class="ctoggle-ct_p_status" for="ct_p_status">
												<input data-toggle="toggle" data-size="small" type='checkbox' name="ct_p_status" <?php if($setting->ct_p_status=='Y'){echo 'checked';}?> id="ct_p_status" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
											</label>
                                        </div>
                                    </td>
                                </tr>
								*/ ?>
								<?php /*
								<tr>
                                    <td><label><?php echo $label_language_values['user_zip_code'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label class="ctoggle-ct_user_zip_code" for="ct_user_zip_code">
												<input data-toggle="toggle" data-width="73" data-size="small" type='checkbox' name="ct_user_zip_code" <?php if($setting->ct_user_zip_code=='Y'){echo 'checked';}?> id="ct_user_zip_code" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
											</label>
                                        </div>
                                    </td>
                                </tr>
								<?php */?>
                                </tbody>

                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td>
                                        <a id="general_setting" name="" class="btn btn-success" ><?php echo $label_language_values['save_setting'];?></a>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade in" id="appearance-setting">
				<form id="loginpageimage" method="post" enctype="multipart/form-data" class="ct-appearance-settings">
                
                    <div class="panel panel-default">
                        <div class="panel-heading cta-top-right">
                            <h1 class="panel-title"><?php echo $label_language_values['appearance_settings'];?></h1>
                            <span class="pull-right cta-setting-fix-btn"><button id="appearance_settings" type="submit" name="appreance" class="btn btn-success appearance_settings_btn_check"><?php echo $label_language_values['save_setting'];?></button></span>
                        </div>
                        <div class="panel-body pt-50 plr-10">
						    <table class="form-inline ct-common-table" >
								
                                <tbody>
								<tr>
                                    <td><label><?php echo $label_language_values['color_scheme'];?></label></td>
                                    <td>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb-15 npl">
                                            <label><?php echo $label_language_values['primary_color'];?></label>
                                            <input type="text" name="ct_primary_color" id="ct-primary-color" class="form-control demo primary_color" data-control="saturation" value="<?php echo ($setting->ct_primary_color)?>" />
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb-15">
                                            <label><?php echo $label_language_values['secondary_color'];?></label>
                                            <input type="text" name="ct_secondary_color" id="ct-secondary-color" class="form-control demo secondary_color" data-control="saturation" value="<?php echo ($setting->ct_secondary_color)?>" />
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb-15">
                                            <label><?php echo $label_language_values['text_color'];?></label>
                                            <input type="text" name="ct_text_color" id="ct-text-color" class="form-control demo text_color" data-control="saturation" value="<?php echo ($setting->ct_text_color)?>" />
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb-15">
                                            <label><?php echo $label_language_values['text_color_on_bg'];?></label>
                                            <input type="text" name="ct_text_color_on_bg" id="ct-text-color-bg" class="form-control demo text_color_bg" data-control="saturation" value="<?php echo ($setting->ct_text_color_on_bg)?>" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label> <?php echo $label_language_values['admin_area_color_scheme'];?></label></td>
                                    <td>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 npl mb-15">
                                            <label><?php echo $label_language_values['primary_color'];?></label>
                                            <input type="text" name="ct_primary_color_admin" id="ct-primary-color-admin" class="form-control demo ct_primary_color_admin" data-control="saturation" value="<?php echo ($setting->ct_primary_color_admin)?>" />
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb-15">
                                            <label><?php echo $label_language_values['secondary_color'];?></label>
                                            <input type="text" name="ct_secondary_color_admin" id="ct-secondary-color-admin" class="form-control demo secondary_color_admin" data-control="saturation" value="<?php echo ($setting->ct_secondary_color_admin)?>" />
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb-15">
                                            <label><?php echo $label_language_values['text_color'];?></label>
                                            <input type="text" name="ct_text_color_admin" id="ct-text-color-admin" class="form-control demo text_color_admin" data-control="saturation" value="<?php echo ($setting->ct_text_color_admin)?>" />
                                        </div>
                                        <!-- <div class="col-lg-12 col-md-12 col-xs-12 mb-15">   
                                                    <input type="text" name="ct_admin_area_color_scheme" id="ct-primary-color" class="form-control demo admin_area_color" data-control="saturation" value="<?php /* echo ($setting->ct_admin_area_color_scheme) */ ?>" />
                                                </div>	-->
												<div class="col-lg-3 col-md-3 col-sm-6 mb-15"> 
												</div>
										<div class="col-lg-3 col-md-3 col-sm-6 mb-15">
											<p class="btn" style="color:#31b0d5;" name="reset_color" id="reset_color"><?php echo $label_language_values['Reset_Color'];?></p>
										 </div>
                                    </td>
                                </tr>
                                <!--<tr>
                                <td><label>Front background image</label></td>
                                <td>
                                <div class="form-group">
                                </div>
                                <a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="It will manage Front background image."><i class="fa fa-info-circle fa-lg"></i></a>
                                </td>
                                </tr>
								<tr>
                                <td><label>Login background image</label></td>
                                <td>
                                <div class="form-group">
								
                                </div>
                                <a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="It will manage login background image."><i class="fa fa-info-circle fa-lg"></i></a>
                                </td>
                                </tr>-->
                                <?php /*<tr>
                                    <td><label><?php echo $label_language_values['show_coupons_input_on_checkout'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label for="show-coupons-input-oc">
												<input data-toggle="toggle" data-size="small" name="coupon_checkout" type='checkbox' <?php if($setting->ct_show_coupons_input_on_checkout=='on'){echo 'checked';}?> name="ct_show_service_description" id="show-coupons-input-oc" data-on="<?php echo $label_language_values['o_n'];?>"  data-off="<?php echo $label_language_values['off'];?>" data-onstyle='primary' data-offstyle='default' />
											</label>
                                        </div>
                                        <a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['you_can_show_hide_coupon_input_on_checkout_form'];?>."><i class="fa fa-info-circle fa-lg"></i></a>
                                    </td>
                                </tr> */?>
                                <tr>
                                    <td><label><?php echo $label_language_values['hide_faded_already_booked_time_slots'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label for="hide-booked-slot">
												<input data-toggle="toggle" data-size="small" name="fadded_slots" type='checkbox' <?php if($setting->ct_hide_faded_already_booked_time_slots=='on'){echo 'checked';}?> id="hide-booked-slot" data-on="<?php echo $label_language_values['o_n'];?>"  data-off="<?php echo $label_language_values['off'];?>" data-onstyle='primary' data-offstyle='default' />
											</label>
                                        </div>
                                        <a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="With this you can hide the already booked slots just to hide your bookings from your Competitors."><i class="fa fa-info-circle fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Disable turn off days.</label></td>
                                    <td>
                                        <div class="form-group">
                                            <label for="disable-off-days">
												<input data-toggle="toggle" data-size="small" name="d_off_days" type='checkbox' <?php if($setting->ct_disable_turn_off_days=='on'){echo 'checked';}?> id="disable-off-days" data-on="<?php echo $label_language_values['o_n'];?>"  data-off="<?php echo $label_language_values['off'];?>" data-onstyle='primary' data-offstyle='default' />
											</label>
                                        </div>
                                        <a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="With this you can disabled turned off days for customers"><i class="fa fa-info-circle fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['guest_user_checkout'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label for="guest-user-checkout">
												<input data-toggle="toggle" name="guc_check" data-size="small" type='checkbox' <?php if($setting->ct_guest_user_checkout=='on'){echo 'checked';}?> name="" id="guest-user-checkout" data-on="<?php echo $label_language_values['o_n'];?>"  data-off="<?php echo $label_language_values['off'];?>" data-onstyle='primary' data-offstyle='default' />
											</label>
                                        </div>
                                        <a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['with_this_feature_you_can_allow_a_visitor_to_book_appointment_without_registration'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['existing_and_new_user_checkout'];?> </label></td>
                                    <td>
                                        <div class="form-group">
                                            <label for="existing-and-new-user-checkout">
												<input data-toggle="toggle" name="eu_nu_check" data-size="small" type='checkbox' <?php if($setting->ct_existing_and_new_user_checkout=='on'){echo 'checked';}?> id="existing-and-new-user-checkout" data-on="<?php echo $label_language_values['o_n'];?>"  data-off="<?php echo $label_language_values['off'];?>" data-onstyle='primary' data-offstyle='default' />
											</label>
                                        </div>
                                        <a class="ct-tooltip-link" href="javascript:void(0)" data-toggle="tooltip" title="<?php echo $label_language_values['it_will_allow_option_for_user_to_get_booking_with_new_user_or_existing_user'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['time_format'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <select class="selectpicker" id="ct_time_format" data-size="5" name="ct_time_format" style="display: none;width:auto">
                                                <option value="12" <?php if($setting->ct_time_format=='12'){echo 'selected';} ?>>12 <?php echo $label_language_values['hours'];?></option>
                                                <option value="24" <?php if($setting->ct_time_format=='24'){echo 'selected';} ?>>24 <?php echo $label_language_values['hours'];?></option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
								<tr>
                                    <td><label><?php echo $label_language_values['scrollable_cart'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <label for="ct_cart_scrollable">
												<input data-toggle="toggle" name="ct_cart_scrollable" data-size="small" type='checkbox' <?php if($setting->ct_cart_scrollable=='Y'){echo 'checked';}?> id="ct_cart_scrollable" data-on="<?php echo $label_language_values['o_n'];?>"  data-off="<?php echo $label_language_values['off'];?>" data-onstyle='primary' data-offstyle='default' />
											</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['date_picker_date_format'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <select name="ct_date_picker_date_format" id="date_format_datepicker" class="selectpicker form-control" data-size="5" data-live-search="true" data-live-search-placeholder="<?php echo $label_language_values['search'];?>" data-actions-box="true" >
                                                <option value="d-m-Y" <?php if($setting->ct_date_picker_date_format=='d-m-Y'){echo 'selected';} ?>>dd-mm-yyyy (eg. <?php echo date('d-m-Y');?>)</option>
                                                <option value="j-m-Y" <?php if($setting->ct_date_picker_date_format=='j-m-Y'){echo 'selected';} ?>>d-mm-yyyy (eg. <?php echo date('j-n-Y');?>)</option>
                                                <option value="d-M-Y" <?php if($setting->ct_date_picker_date_format=='d-M-Y'){echo 'selected';} ?>>dd-m-yyyy (eg. <?php echo date('d-M-Y');?>)</option>
                                                <option value="d-F-Y" <?php if($setting->ct_date_picker_date_format=='d-F-Y'){echo 'selected';} ?>>dd-m-yyyy (eg. <?php echo date('d-F-Y');?>)</option>
                                                <option value="j-M-Y" <?php if($setting->ct_date_picker_date_format=='j-M-Y'){echo 'selected';} ?>>d-m-yyyy (eg. <?php echo date('j-M-Y');?>)</option>
                                                <option value="j-F-Y" <?php if($setting->ct_date_picker_date_format=='j-F-Y'){echo 'selected';} ?>>dd-m-yyyy (eg. <?php echo date('j-F-Y');?>)</option>

                                                <!-- With Slashes -->
                                                <option value="d/m/Y" <?php if($setting->ct_date_picker_date_format=='d/m/Y'){echo 'selected';} ?>>dd/mm/yyyy (eg. <?php echo date('d/m/Y');?>)</option>
                                                <option value="j/m/Y" <?php if($setting->ct_date_picker_date_format=='j/m/Y'){echo 'selected';} ?>>d/mm/yyyy (eg. <?php echo date('j/m/Y');?>)</option>
                                                <option value="d/M/Y" <?php if($setting->ct_date_picker_date_format=='d/M/Y'){echo 'selected';} ?>>dd/m/yyyy (eg. <?php echo date('d/M/Y');?>)</option>
                                                <option value="d/F/Y" <?php if($setting->ct_date_picker_date_format=='d/F/Y'){echo 'selected';} ?>>dd/M/yyyy (eg. <?php echo date('d/F/Y');?>)</option>
                                                <option value="j/M/Y" <?php if($setting->ct_date_picker_date_format=='j/M/Y'){echo 'selected';} ?>>d/m/yyyy (eg. <?php echo date('j/M/Y');?>)</option>
                                                <option value="j/F/Y" <?php if($setting->ct_date_picker_date_format=='j/F/Y'){echo 'selected';} ?>>d/M/yyyy (eg. <?php echo date('j/F/Y');?>)</option>

                                                <!-- Month Day Year Suffled -->
                                                <option value="m-d-Y"  <?php if($setting->ct_date_picker_date_format=='m-d-Y'){echo 'selected';} ?> >mm-dd-yyyy (eg. <?php echo date('m-d-Y');?>)</option>
                                                <option value="m-j-Y" <?php if($setting->ct_date_picker_date_format=='m-j-Y'){echo 'selected';} ?> >mm-d-yyyy (eg. <?php echo date('m-j-Y');?>)</option>
                                                <option value="M-d-Y" <?php if($setting->ct_date_picker_date_format=='M-d-Y'){echo 'selected';} ?>>m-dd-yyyy (eg. <?php echo date('M-d-Y');?>)</option>
                                                <option value="F-d-Y" <?php if($setting->ct_date_picker_date_format=='F-d-Y'){echo 'selected';} ?>>m-dd-yyyy (eg. <?php echo date('F-d-Y');?>)</option>
                                                <option value="M-j-Y" <?php if($setting->ct_date_picker_date_format=='M-j-Y'){echo 'selected';} ?>>m-d-yyyy (eg. <?php echo date('M-j-Y');?>)</option>
                                                <option value="F-j-Y" <?php if($setting->ct_date_picker_date_format=='F-j-Y'){echo 'selected';} ?>>m-dd-yyyy (eg. <?php echo date('F-j-Y');?>)</option>
                                                <!-- With Slashes -->
                                                <option value="m/d/Y" <?php if($setting->ct_date_picker_date_format=='m/d/Y'){echo 'selected';} ?>>mm/dd/yyyy (eg. <?php echo date('m/d/Y');?>)</option>
                                                <option value="m/j/Y" <?php if($setting->ct_date_picker_date_format=='m/j/Y'){echo 'selected';} ?>>mm/d/yyyy (eg. <?php echo date('m/j/Y');?>)</option>
                                                <option value="M/d/Y" <?php if($setting->ct_date_picker_date_format=='M/d/Y'){echo 'selected';} ?>>m/dd/yyyy (eg. <?php echo date('M/d/Y');?>)</option>
                                                <option value="F/d/Y" <?php if($setting->ct_date_picker_date_format=='F/d/Y'){echo 'selected';} ?>>m/dd/yyyy (eg. <?php echo date('F/d/Y');?>)</option>
                                                <option value="M/j/Y" <?php if($setting->ct_date_picker_date_format=='M/j/Y'){echo 'selected';} ?>>m/d/yyyy (eg. <?php echo date('M/j/Y');?>)</option>
                                                <option value="F/j/Y" <?php if($setting->ct_date_picker_date_format=='F/j/Y'){echo 'selected';} ?>>m/dd/yyyy (eg. <?php echo date('F/j/Y');?>)</option>

                                                <option value="j M,Y" <?php if($setting->ct_date_picker_date_format=='j M,Y'){echo 'selected';} ?>>dd m,yyyy (eg. <?php echo date('j M,Y');?>)</option>
                                                <option value="M j, Y" <?php if($setting->ct_date_picker_date_format=='M j, Y'){echo 'selected';} ?>>m dd,yyyy (eg. <?php echo date('M j, Y');?>)</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
								<tr>
								 <td><?php echo $label_language_values['default_country_code'];?></td>
								 <?php  
						$arrs = explode(",",$setting->get_option("ct_phone_display_country_code"));
						$country_code_alpha_array = array
  (
	array("af","Afghanistan (&#8235;افغانستان&#8236;&lrm;)","+93"),array("al","Albania (Shqipëri)","+355  "),array("dz","Algeria (&#8235;الجزائر&#8236;&lrm;)","+213"),array("as","American Samoa","+1684 "),array("ad","Andorra","+376"),array("ao","Angola","+244"),array("ai","Anguilla","+1264"),array("ag","Antigua and Barbuda","+1268"),array("ar","Argentina","+54"),array("am","Armenia (Հայաստան)","+374"), array("aw","Aruba","+297"), array("au","Australia","+61"),array("at","Austria (Österreich)","+43"),array("az","Azerbaijan (Azərbaycan)","+994"),array("bs","Bahamas","+1242"),array("bh","Bahrain (&#8235;البحرين&#8236;&lrm;)","+973"),array("ct","Bangladesh (বাংলাদেশ)","+880"),array("bb","Barbados","+1246"), array("by","Belarus (Беларусь)","+375"),array("be","Belgium (België)","+32"),array("bz","Belize","+501"),array("bj","Benin (Bénin)","+229"),array("bm","Bermuda","+1441"),array("bt","Bhutan (འབྲུག)  ","+975"),array("bo","Bolivia","+591"),array("ba","Bosnia and Herzegovina (Босна и Херцеговина)","+387"),array("bw","Botswana","+267"),array("br","Brazil (Brasil)","+55"),array("io","British Indian Ocean Territory","+246"),array("vg","British Virgin Islands","+1284"),array("bn","Brunei","+673"),array("bg","Bulgaria (България)","+359"),array("bf","Burkina Faso","+226"),array("bi","Burundi (Uburundi)","+257"),array("kh","Cambodia (កម្ពុជា)","+855 "), array("cm","Cameroon (Cameroun)","+237"),array("ca","Canada","+1"),array("cv","Cape Verde (Kabu Verdi)","+238 "),array("bq","Caribbean Netherlands","+599 "), array("ky","Cayman Islands","+1345"), array("cf","Central African Republic (République centrafricaine)","+236"),array("td","Chad (Tchad)","+23"),array("cl","Chile","+56"),array("cn","China (中国)","+86"),array("cx","Christmas Island","+61"),array("cc","Cocos (Keeling) Islands","+61"),array("co","Colombia","+57"),array("km","Comoros (&#8235;جزر القمر&#8236;&lrm;)","+269"),array("cd","Congo (DRC) (Jamhuri ya Kidemokrasia ya Kongo)","+243"),array("cg","Congo (Republic) (Congo-Brazzaville)","+242"),array("ck","Cook Islands","+682"),array("cr","Costa Rica","+506"),array("ci","Côte d’Ivoire","+225"),array("hr","Croatia (Hrvatska)","+385"),array("cu","Cuba","+53"),array("cw","Curaçao","+599"),array("cy","Cyprus (Κύπρος)","+357"),array("cz","Czech Republic (Česká republika)","+420"),array("dk","Denmark (Danmark)","+45"),array("dj","Djibouti","+253"),array("dm","Dominica","+1767"),array("do","Dominican Republic (República Dominicana)","+1"),array("ec","Ecuador","+593"),array("eg","Egypt (&#8235;مصر&#8236;&lrm;)","+20 "),array("sv","El Salvador","+503"),array("gq","Equatorial Guinea (Guinea Ecuatorial)","+240"),array("er","Eritrea","+291"),array("ee","Estonia (Eesti)","+372"),array("et","Ethiopia","+251"),array("fk","Falkland Islands (Islas Malvinas)","+500"),array("fo","Faroe Islands (Føroyar)","+298"),array("fj","Fiji","+679"),array("fi","Finland (Suomi)","+358"),array("fr","France","+33"),array("gf","French Guiana (Guyane française)","+594"),array("pf","French Polynesia (Polynésie française)","+689"),array("ga","Gabon","+241"), array("gm","Gambia","+220"),array("ge","Georgia (საქართველო)","+995"),array("de","Germany (Deutschland)","+49"),array("gh","Ghana (Gaana)","+233"),array("gi","Gibraltar","+350"),array("gr","Greece (Ελλάδα)","+30"),array("gl","Greenland (Kalaallit Nunaat)","+299"),array("gd","Grenada","+1473"), array("gp","Guadeloupe","+590"),array("gu","Guam","+1671"),array("gt","Guatemala","+502"),array("gg","Guernsey","+44"),array("gn","Guinea (Guinée)","+224"),array("gw","Guinea-Bissau (Guiné Bissau)","+245"),array("gy","Guyana","+592"),array("ht","Haiti","+509"),array("hn","Honduras","+504"),array("hk","Hong Kong (香港)","+852"),array("hu","Hungary (Magyarország)","+36"),array("is","Iceland (Ísland)","+354"),array("in","India (भारत)","+91"),array("id","Indonesia","+62"),array("ir","Iran (&#8235;ایران&#8236;&lrm;)","+98"),array("iq","Iraq (&#8235;العراق&#8236;&lrm;)","+964"),array("ie","Ireland","+353"),array("im","Isle of Man","+44"),array("il","Israel (&#8235;ישראל&#8236;&lrm;)","+972"),array("it","Italy (Italia)","+39"),array("jm","Jamaica","+1876"),array("jp","Japan (日本)","+81"),array("je","Jersey","+44"),array("jo","Jordan (&#8235;الأردن&#8236;&lrm;)","+962"),array("kz","Kazakhstan (Казахстан)","+7"),array("ke","Kenya","+254"),array("ki","Kiribati","+686"),array("kw","Kuwait (&#8235;الكويت&#8236;&lrm;)","+965"),array("kg","Kyrgyzstan (Кыргызстан)","+996"),array("la","Laos (ລາວ)","+856"),array("lv","Latvia (Latvija)","+371"),array("lb","Lebanon (&#8235;لبنان&#8236;&lrm;)","+961"),array("ls","Lesotho","+266"),array("lr","Liberia","+231"),array("ly","Libya (&#8235;ليبيا&#8236;&lrm;)","+218"),array("li","Liechtenstein","+423"),array("lt","Lithuania (Lietuva)","+370"),array("lu","Luxembourg","+352"),array("mo","Macau (澳門)","+853"),array("mk","Macedonia (FYROM) (Македонија)","+389"),array("mg","Madagascar (Madagasikara)","+261"),array("mw","Malawi","+265"),array("my","Malaysia","+60"),array("mv","Maldives","+960"),array("ml","Mali","+223"), array("mt","Malta","+356"),array("mh","Marshall Islands","+692"),array("mq","Martinique","+596"),array("mr","Mauritania (&#8235;موريتانيا&#8236;&lrm;)","+222"),array("mu","Mauritius (Moris)","+230"),array("yt","Mayotte","+262"),array("mx","Mexico (México)","+52"),array("fm","Micronesia","+691"),array("md","Moldova (Republica Moldova)","+373"),array("mc","Monaco","+377"),array("mn","Mongolia (Монгол)","+976"),array("me","Montenegro (Crna Gora)","+382"),array("ms","Montserrat","+1664"),array("ma","Morocco (&#8235;المغرب&#8236;&lrm;)","+212"),array("mz","Mozambique (Moçambique)","+258"),array("mm","Myanmar (Burma) (မြန်မာ)","+95"),array("na","Namibia (Namibië)","+264"),array("nr","Nauru","+674"),array("np","Nepal (नेपाल)","+977"),array("nl","Netherlands (Nederland)","+31"),array("nc","New Caledonia (Nouvelle-Calédonie)","+687"),array("nz","New Zealand","+64"),array("ni","Nicaragua","+505"),array("ne","Niger (Nijar)","+227"),array("ng","Nigeria","+234"),array("nu","Niue","+683"),array("nf","Norfolk Island","+672"),array("kp","North Korea (조선 민주주의 인민 공화국)","+850"),array("mp","Northern Mariana Islands","+1670"),array("no","Norway (Norge)","+47"),array("om","Oman (&#8235;عُمان&#8236;&lrm;)","+968"),array("pk","Pakistan (&#8235;پاکستان&#8236;&lrm;)","+92"),array("pw","Palau","+680"),array("ps","Palestine (&#8235;فلسطين&#8236;&lrm;)","+970"),array("pa","Panama (Panamá)","+507"),array("pg","Papua New Guinea","+675"),array("py","Paraguay","+595"),array("pe","Peru (Perú)","+51"),array("ph","Philippines","+63"),array("pl","Poland (Polska)","+48"),array("pt","Portugal","+351"),array("pr","Puerto Rico","+1"),array("qa","Qatar (&#8235;قطر&#8236;&lrm;)","+974"),array("re","Réunion (La Réunion)","+262"),array("ro","Romania (România)","+40"),array("ru","Russia (Россия)","+7"),array("rw","Rwanda","+250"),array("bl","Saint Barthélemy (Saint-Barthélemy)","+590"),array("sh","Saint Helena","+290"), array("kn","Saint Kitts and Nevis","+1869"),array("lc","Saint Lucia","+1758"), array("mf","Saint Martin (Saint-Martin (partie française))","+590"),array("pm","Saint Pierre and Miquelon (Saint-Pierre-et-Miquelon)","+508"), array("vc","Saint Vincent and the Grenadines","+1784"),array("ws","Samoa","+685"),array("sm","San Marino","+378"),array("st","São Tomé and Príncipe (São Tomé e Príncipe)","+239"),array("sa","Saudi Arabia (&#8235;المملكة العربية السعودية&#8236;&lrm;)","+966"),array("sn","Senegal (Sénégal)","+221"),array("rs","Serbia (Србија)","+381"),array("sc","Seychelles","+248"),array("sl","Sierra Leone","+232"),array("sg","Singapore","+65"),array("sx","Sint Maarten","+1721"),array("sk","Slovakia (Slovensko)","+421"),array("si","Slovenia (Slovenija)","+386"),array("sb","Solomon Islands","+677"),array("so","Somalia (Soomaaliya)","+252"),array("za","South Africa","+27"),array("kr","South Korea (대한민국)","+82"),array("ss","South Sudan (&#8235;جنوب السودان&#8236;&lrm;)","+211"),array("es","Spain (España)","+34"),array("lk","Sri Lanka (ශ්&zwj;රී ලංකාව)","+94"),array("sd","Sudan (&#8235;السودان&#8236;&lrm;)","+249"),array("sr","Suriname","+597"),array("sj","Svalbard and Jan Mayen","+47"),array("sz","Swaziland","+268"),array("se","Sweden (Sverige)","+46"),array("ch","Switzerland (Schweiz)","+41"),array("sy","Syria (&#8235;سوريا&#8236;&lrm;)","+963"),array("tw","Taiwan (台灣)","+886"),array("tj","Tajikistan","+992"),array("tz","Tanzania","+255"),array("th","Thailand (ไทย)","+66"),array("tl","Timor-Leste","+670"),array("tg","Togo","+228"),array("tk","Tokelau","+690"),array("to","Tonga","+676"),array("tt","Trinidad and Tobago","+1868"),array("tn","Tunisia (&#8235;تونس&#8236;&lrm;)","+216"),array("tr","Turkey (Türkiye)","+90"),array("tm","Turkmenistan","+993"),array("tc","Turks and Caicos Islands","+1649"),array("tv","Tuvalu","+688"),array("vi","U.S. Virgin Islands","+1340"),array("ug","Uganda","+256"),array("ua","Ukraine (Україна)","+380"),array("ae","United Arab Emirates (&#8235;الإمارات العربية المتحدة&#8236;&lrm;)","+971"),array("gb","United Kingdom","+44"),array("us","United States","+1"),array("uy","Uruguay","+598"),array("uz","Uzbekistan (Oʻzbekiston)","+998"),array("vu","Vanuatu","+678"),array("va","Vatican City (Città del Vaticano)","+39"),array("ve","Venezuela","+58"),array("vn","Vietnam (Việt Nam)","+84"),array("wf","Wallis and Futuna","+681"),array("eh","Western Sahara (&#8235;الصحراء الغربية&#8236;&lrm;)","+212"),array("ye","Yemen (&#8235;اليمن&#8236;&lrm;)","+967"),array("zm","Zambia","+260"),array("zw","Zimbabwe","+263"),array("ax","Åland Islands","+358")); ?>
								 <td>
								 <select name="selected_country_code_display[]" multiple class="selectpicker" data-size="10" data-live-search="true" data-live-search-placeholder="search">
									
								 <?php 
										for($i=0;$i<count($country_code_alpha_array);$i++){
											?>
											<option <?php if(in_array($country_code_alpha_array[$i][0],$arrs)){ echo "selected"; }?> data-subtext="<?php echo $country_code_alpha_array[$i][1]; ?> - <?php echo $country_code_alpha_array[$i][2]?>" value="<?php echo $country_code_alpha_array[$i][0];?>"><?php echo $country_code_alpha_array[$i][0]?></option>
											<?php 
										}
									?>
								</select>
								 
								 </td>
								</tr>
								
								<tr>
								 <td><?php echo $label_language_values['frontend_fonts'];?></td>
								 <?php
								 include 'font_array.php';
								 $ct_frontend_fonts_val = $setting->get_option("ct_frontend_fonts");
								 ?>
								 <td>
								 <select name="selected_frontend_fonts_display" class="selectpicker" data-size="10" data-live-search="true" data-live-search-placeholder="search">
									
								 <?php 
										foreach($customfonts as $customfont){
											?>
											<option style="font-family:<?php echo $customfont; ?>" <?php if($customfont == $ct_frontend_fonts_val){ echo "selected"; }?> value="<?php echo $customfont;?>"><?php echo $customfont; ?></option>
											<?php 
										}
									?>
								</select>
								 
								 </td>
								</tr>
                                <tr>
                                    <td><label><?php echo $label_language_values['custom_css'];?></label></td>
                                    <td>
                                        <div class="form-group col-xs-12 np">
                                            <textarea class="form-control" style="width: 100%; min-height: 150px;" name="cust_css" id="ct_custom_css"><?php echo $setting->get_option("ct_custom_css");?></textarea>
                                        </div>
                                    </td>
                                </tr>
								<tr>
                                    <td><label><?php echo $label_language_values['login_page'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
												<span class="btn btn-default btn-file mt-15"><input type="file" id="login_page" name="loginimg" /></span>
												<a id="loginbg" class="mt-15 btn btn-info"><i class="fa fa-edit"></i><?php echo $label_language_values['restore_default'];?></a><br>
												<span class="fileinput-filename"><?php echo $label_language_values['recommended_image_type_jpg_jpeg_png_gif'];?></span>
											</div>
                                        </div>
                                    </td>
                                </tr>
								<tr>
                                    <td><label><?php echo $label_language_values['front_page'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
												<span class="btn btn-default btn-file mt-15"><input type="file" id="front_page" name="frontimage" /></span>
												<a id="frontbg"  class="mt-15 btn btn-info"><i class="fa fa-edit"></i><?php echo $label_language_values['restore_default'];?></a><br>
												<span class="fileinput-filename"><?php echo $label_language_values['recommended_image_type_jpg_jpeg_png_gif'];?></span>
											</div>
                                        </div>
                                    </td>
                                </tr>
								<tr>
                                    <td><label><?php echo $label_language_values['favicon_image'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
												<span class="btn btn-default btn-file mt-15"><input type="file" id="favicon_page" name="faviconimage" /></span>
												<br>
												<span class="fileinput-filename"><?php echo $label_language_values['recommended_image_type_jpg_jpeg_png_gif'];?></span>
											</div>
                                        </div>
                                    </td>
                                </tr>
								<tr>
									<td><?php echo $label_language_values['Loader'];?></td>
									<td>
									<div class="ct-custom-radio">
										<ul class="ct-radio-list">
											<label class="radio-inline"><input type="radio" name="ct_loader_option" id="ct_cssloader" <?php if($setting->get_option("ct_loader")== 'css'){echo 'checked'; } ?> value="css"><?php echo $label_language_values['CSS_Loader'];?></label>
											
											<label class="radio-inline"><input type="radio" name="ct_loader_option" id="ct_gifloader" <?php if($setting->get_option("ct_loader")== 'gif'){echo 'checked'; } ?> value="gif"><?php echo $label_language_values['GIF_Loader'];?></label>
											
											<label class="radio-inline"><input type="radio" name="ct_loader_option" id="ct_defaultloader" <?php if($setting->get_option("ct_loader")== 'default'){echo 'checked'; } ?>  value="default"><?php echo $label_language_values['Default_Loader'];?></label>
										</ul>
									</div>
									</td>
								</tr>
								<tr class="ct_GIF_Loader_div">
									<td><?php echo $label_language_values['GIF_Loader'];?></td>
									<td>
										<div class="form-group">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
												<span class="btn btn-default btn-file mt-15"><input type="file" class="ct_frontend_gif_loader_file" name="ct_frontend_gif_loader_file" /></span>
												&nbsp;
												<img id="ct_upload_gif_loader_preview" <?php if($setting->get_option("ct_custom_gif_loader") == ''){ echo 'style="display:none;"'; } ?> class="mt-15" height="40px" width="40px" <?php if($setting->get_option("ct_custom_gif_loader") != ''){ echo 'src="'.SITE_URL.'/assets/images/gif-loader/'.$setting->get_option("ct_custom_gif_loader").'"'; } ?> />
												<br>
												<span class="fileinput-filename"><?php echo $label_language_values['recommended_image_type_jpg_jpeg_png_gif'];?></span>
											</div>
                                        </div>
									</td>
								</tr>
								<tr class="ct_CSS_Loader_div">
									<td><?php echo $label_language_values['CSS_Loader'];?></td>
									<td>
										 <div class="form-group col-xs-12 np">
											<div class="col-md-7 np">
												<textarea class="form-control" style="width: 100%; min-height: 150px;" name="ct_custom_css_loader" id="ct_custom_css_loader"><?php echo $setting->get_option("ct_custom_css_loader");?></textarea>
											</div>
											<div class="col-md-4 ct_custom_css_loader_preview_overlay">
												<?php echo $setting->get_option("ct_custom_css_loader"); ?>
											</div>
                                        </div>
									</td>
								</tr>
								<tr class="ct_calendar_defaultView">
									<td><?php echo $label_language_values['Calendar_Default_View'];?></td>
									<td>
										 <div class="form-group col-xs-12 np">
											<div class="col-md-7 np">
												<select name="ct_calendar_defaultView" class="selectpicker">
													<option <?php if($setting->get_option("ct_calendar_defaultView") == 'month'){ echo "selected"; } ?> value="month">Month</option>
													<option <?php if($setting->get_option("ct_calendar_defaultView") == 'agendaWeek'){ echo "selected"; } ?> value="agendaWeek">Week</option>
													<option <?php if($setting->get_option("ct_calendar_defaultView") == 'agendaDay'){ echo "selected"; } ?> value="agendaDay">Day</option>
												</select>
											</div>
                                        </div>
									</td>
								</tr>
								<tr class="ct_calendar_firstDay">
									<td><?php echo $label_language_values['Calendar_Fisrt_Day'];?></td>
									<td>
										 <div class="form-group col-xs-12 np">
											<div class="col-md-7 np">
												<select name="ct_calendar_firstDay" class="selectpicker">
													<option <?php if($setting->get_option("ct_calendar_firstDay") == '0'){ echo "selected"; } ?> value="0">Sunday</option>
													<option <?php if($setting->get_option("ct_calendar_firstDay") == '1'){ echo "selected"; } ?> value="1">Monday</option>
												</select>
											</div>
                                        </div>
									</td>
								</tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td>
										<button id="appreance" value="Save Member" class="btn btn-success appearance_settings_btn_check" type="submit" name="appreance"><?php echo $label_language_values['save_setting'];?></button>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade in" id="payment-setting">
                <form id="payment_getway_form" method="post" type="" class="ct-payment-settings" >
                    <div class="panel panel-default">
                        <div class="panel-heading cta-top-right">
                            <h1 class="panel-title"><?php echo $label_language_values['payment_gateways'];?></h1>
                            <span class="pull-right cta-setting-fix-btn"><a id="payment_setting" name="save-payment-gateways-setting" class="btn btn-success ct-btn-width" ><?php echo $label_language_values['save_setting'];?></a></span>
                        </div>
                        <div class="panel-body pt-50 pt plr-10">
                            <div id="accordion" class="panel-group">
                                <div class="panel panel-default ct-all-payments-main">
                                    <!-- <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <span><?php /* echo $label_language_values['all_payment_gateways']; */?></span>
                                            <div class="ct-enable-disable-right pull-right">
                                                <label class="ct-toggle-medium" for="all-payment-gateways">
                                                    <input class="ct-toggle-medium-input" <?php /* if($setting->ct_all_payment_gateway_status=='on'){echo 'checked';} */ ?> type="checkbox" name="" id="all-payment-gateways" />
													<span class="ct-toggle-medium-label" data-enable="<?php /* echo $label_language_values['enable']; */ ?>" data-disable="<?php /* echo $label_language_values['disable']; */ ?>"></span>
													<span class="ct-toggle-medium-handle"></span
												</label>
													</div>
												  </h4>
											  </div> -->

                                    <!-- <div <?php /* if($setting->ct_all_payment_gateway_status=='on'){echo 'style="display:block;"';} */ ?> id="collapseOne" class="panel-collapse collapse mycollapse_all-payment-gateways"> -->
                                    <div style="display:block;" id="collapseOne" class="panel-collapse collapse mycollapse_all-payment-gateways">
                                        <div class="panel-body p-10">

                                            <div class="alert alert-danger payment_warning" style="display:none;">
                                                <a href="#" class="payment_warning_close close" >&times;</a>
                                                <strong>Warning! </strong><p id="payment_warning" style="display: inline;" class=""></p>
                                            </div>
                                            <div id="accordion" class="panel-group">
                                                <div class="panel panel-default ct-payment-methods">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <span><?php echo $label_language_values['pay_locally'];?></span>
                                                            <div class="ct-enable-disable-right ct-pay-locally pull-right">
                                                                <label class="ctoggle-pay-locally" for="pay-locally">
																	<input class='cta-toggle-checkbox payment_choice' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if($setting->ct_pay_locally_status=='on'){echo 'checked';}?> id="pay-locally" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
																
                                                                </label>
                                                            </div>

                                                        </h4>
                                                    </div>
                                                </div>

                                                <div class="panel panel-default ct-payment-methods">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <span><?php echo $label_language_values['paypal_express_checkout'];?><img class="cta-paypal-img-payments" src="<?php echo SITE_URL; ?>/assets/images/paypal.png" /></span>
                                                            <div class="ct-enable-disable-right pull-right">
                                                                <label class="ctoggle-paypal-checkout" for="paypal-checkout">
																	<input class='cta-toggle-checkbox payment_choice' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if($setting->ct_paypal_express_checkout_status=='on'){echo 'checked';}?> id="paypal-checkout" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
																
                                                                </label>
                                                            </div>

                                                        </h4>
                                                    </div>
                                                    <div <?php if($setting->ct_paypal_express_checkout_status=='on'){echo 'style="display:block"';}?> id="collapseOne" class="panel-collapse collapse mycollapse_paypal-checkout">
                                                        <div class="panel-body p-10">
                                                            <table class="form-inline ct-common-table">
                                                                <tbody>
                                                                <tr>
                                                                    <td><label><?php echo $label_language_values['api_username'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group ct-lgf">
                                                                            <input type="text" class="form-control" id="ct_paypal_api_username" value="<?php echo ($setting->ct_paypal_api_username)?>" name="ct-paypal-api-username" size="50" />
																			<a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['paypal_api_username_can_get_easily_from_developer_paypal_com_account'];?>"><i class="fa fa-info-circle fa-lg lgf"></i></a>
                                                                        </div>
                                                                        
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label><?php echo $label_language_values['api_password'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group ct-lgf">
                                                                            <input type="password" class="form-control" id="ct_paypal_api_password" value="<?php echo ($setting->ct_paypal_api_password)?>" name="ct-paypal-api-password" size="50" />
																			<a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['paypal_api_password_can_get_easily_from_developer_paypal_com_account'];?>"><i class="fa fa-info-circle fa-lg lgf"></i></a>
                                                                        </div>
                                                                        
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label><?php echo $label_language_values['signature'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group ct-lgf">
                                                                            <input type="text" class="form-control" id="ct_paypal_api_signature" value="<?php echo ($setting->ct_paypal_api_signature)?>"  name="ct-paypal-api-signature" size="50" />
																			<a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['paypal_api_signature_can_get_easily_from_developer_paypal_com_account'];?>"><i class="fa fa-info-circle fa-lg lgf"></i></a>
                                                                        </div>
                                                                        
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label><?php echo $label_language_values['paypal_guest_payment'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <label class="ctoggle-paypal-guest-payment" for="paypal-guest-payment">
																				<input data-toggle="toggle" data-size="small" type='checkbox' <?php if($setting->ct_paypal_guest_payment_status=='on'){echo 'checked';}?> name="" id="paypal-guest-payment" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
																			
                                                                            </label>
                                                                        </div>
                                                                        <a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['let_user_pay_through_credit_card_without_having_paypal_account'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label><?php echo $label_language_values['test_mode'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <label class="ctoggle-paypal-test-mode" for="paypal-test-mode">
																				<input data-toggle="toggle" data-size="small" type='checkbox' <?php if($setting->ct_paypal_test_mode_status=='on'){echo 'checked';}?> name="" id="paypal-test-mode" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
																			
                                                                            </label>
                                                                        </div>
                                                                        <a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['you_can_enable_paypal_test_mode_for_sandbox_account_testing'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="panel panel-default ct-payment-methods">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <span><?php echo $label_language_values['authorize_net'];?> <?php echo $label_language_values['payment_form'];?></span><img class="cta-authorize-img-payments" src="<?php echo SITE_URL; ?>/assets/images/authorize-net.png" />
                                                            <div class="ct-enable-disable-right pull-right">
                                                                <label class="ctoggle-authorizedotnet-payment-checkout" for="authorizedotnet-payment-checkout">
																	<input class='cta-toggle-checkbox payment_choice' data-toggle="toggle" data-size="small" type='checkbox' <?php if($setting->ct_authorizenet_status=='on'){echo 'checked';} ?> name="" id="authorizedotnet-payment-checkout" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
																	
                                                                </label>
                                                            </div>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseOne" <?php if($setting->ct_authorizenet_status=='on'){echo 'style="display:block"';} ?> class="panel-collapse collapse mycollapse_authorizedotnet-payment-checkout">
                                                        <div class="panel-body p-10">
                                                            <table class="form-inline ct-common-table">
                                                                <tbody>
                                                                <tr>
                                                                    <td><label><?php echo $label_language_values['api_login_id'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="ct-authorizenet-API-login-ID" value="<?php echo ($setting->ct_authorizenet_API_login_ID);?>" name="ct-authorizenet-API-login-ID" size="50" />
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label><?php echo $label_language_values['transaction_key'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="ct-authorize-transaction-key" name="ct-authorize-transaction-key" value="<?php echo ($setting->ct_authorizenet_transaction_key);?>" size="50" />
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label><?php echo $label_language_values['sandbox_mode'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <label class="ctoggle-authorize-sandbox-mode" for="authorize-sandbox-mode">
																				<input data-toggle="toggle" data-size="small" type='checkbox' id="authorize-sandbox-mode" <?php if($setting->ct_authorize_sandbox_mode=='on'){echo 'checked';}?> data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
																			</label>
                                                                        </div>
                                                                        <a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['you_can_enable_authorize_net_test_mode_for_sandbox_account_testing'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                                                    </td>
                                                                </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="panel panel-default ct-payment-methods">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <span><?php echo $label_language_values['stripe'];?> <?php echo $label_language_values['payment_form'];?></span><img class="cta-authorize-img-payments" src="<?php echo SITE_URL; ?>/assets/images/stripe.jpg" />
                                                            <div class="ct-enable-disable-right pull-right">
                                                                <label class="ctoggle-stripe-payment-checkout" for="stripe-payment-checkout">
																	<input class="cta-toggle-checkbox payment_choice" data-toggle="toggle" data-size="small" type='checkbox' <?php if($setting->ct_stripe_payment_form_status=='on'){echo 'checked';} ?> name="" id="stripe-payment-checkout" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
																
                                                                </label>
                                                            </div>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseOne" <?php if($setting->ct_stripe_payment_form_status=='on'){echo 'style="display:block"';} ?> class="panel-collapse collapse mycollapse_stripe-payment-checkout">
                                                        <div class="panel-body p-10">
                                                            <table class="form-inline ct-common-table">
                                                                <tbody>
                                                                <tr>
                                                                    <td><label><?php echo $label_language_values['secret_key'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="ct_stripe_secretkey" value="<?php echo ($setting->ct_stripe_secretkey) ?>" name="ct-stripe-secretKey" size="50" />
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label><?php echo $label_language_values['publishable_key'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="password" class="form-control" id="ct_stripe_publishablekey" value="<?php echo ($setting->ct_stripe_publishablekey) ?>" name="ct-paypal-stripe- publishableKey" size="50" />
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
												<!--2checkout payment gateway start-->
												<div class="panel panel-default ct-payment-methods">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <span><?php echo $label_language_values['checkout_title'];?> <?php echo $label_language_values['payment_form'];?></span><img class="cta-authorize-img-payments" src="<?php echo SITE_URL; ?>/assets/images/2checkout.png" />
                                                            <div class="ct-enable-disable-right pull-right">
                                                                <label class="ctoggle-twocheckout-payment-checkout" for="twocheckout-payment-checkout">
																	<input class="cta-toggle-checkbox payment_choice" data-toggle="toggle" data-size="small" type='checkbox' <?php if($setting->ct_2checkout_status=='Y'){echo 'checked';} ?> name="" id="twocheckout-payment-checkout" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
																
                                                                </label>
                                                            </div>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseOne" <?php if($setting->ct_2checkout_status=='Y'){echo 'style="display:block"';} ?> class="panel-collapse collapse mycollapse_twocheckout-payment-checkout">
                                                        <div class="panel-body p-10">
                                                            <table class="form-inline ct-common-table">
                                                                <tbody>
                                                                <tr>
                                                                    <td><label><?php echo $label_language_values['publishable_key'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="ct_2checkout_publishkey" value="<?php echo $setting->ct_2checkout_publishkey; ?>" name="ct_2checkout_publishkey" size="50" />
                                                                        </div>
                                                                    </td>
                                                                </tr>
																<tr>
                                                                    <td><label><?php echo $label_language_values['private_key'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="ct_2checkout_privatekey" value="<?php echo $setting->ct_2checkout_privatekey; ?>" name="ct_2checkout_privatekey" size="50" />
                                                                        </div>
                                                                    </td>
                                                                </tr>
																<tr>
                                                                    <td><label><?php echo $label_language_values['seller_id'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="ct_2checkout_sellerid" value="<?php echo $setting->ct_2checkout_sellerid; ?>" name="ct_2checkout_sellerid" size="50" />
                                                                        </div>
                                                                    </td>
                                                                </tr>
																<tr>
                                                                    <td><label><?php echo $label_language_values['test_mode'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <label class="ctoggle-2checkout-test-mode" for="ct_2checkout_sandbox_mode">
																				<input data-toggle="toggle" data-size="small" type='checkbox' <?php if($setting->ct_2checkout_sandbox_mode=='Y'){echo 'checked';}?> name="" id="ct_2checkout_sandbox_mode" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
																			
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
												<!--2checkout payment gateway end-->
												
												<!-- New Added -->
												<div class="panel panel-default ct-payment-methods">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <span><?php echo $label_language_values['payumoney'];?></span><img class="cta-authorize-img-payments" src="<?php echo SITE_URL; ?>/assets/images/payumoney.jpg" />
                                                            <div class="ct-enable-disable-right pull-right">
                                                                <label class="ctoggle-payumoney-payment-checkout" for="payu-money">
																	<input class="cta-toggle-checkbox payment_choice" data-toggle="toggle" data-size="small" type='checkbox' <?php if($setting->ct_payumoney_status=='Y'){echo 'checked';} ?> name="" id="payu-money" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
                                                                </label>
                                                            </div>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseOne" <?php if($setting->ct_payumoney_status=='Y'){echo 'style="display:block"';} ?> class="panel-collapse collapse mycollapse_payu-money">
                                                        <div class="panel-body p-10">
                                                            <table class="form-inline ct-common-table">
                                                                <tbody>
                                                                <tr>
                                                                    <td><label><?php echo $label_language_values['merchant_key'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="ct_payumoney_merchant_key" value="<?php echo $setting->ct_payumoney_merchant_key; ?>" name="ct_payumoney_merchant_key" size="50" />
                                                                        </div>
                                                                    </td>
                                                                </tr>
																<tr>
                                                                    <td><label><?php echo $label_language_values['salt_key'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="ct_payumoney_salt" value="<?php echo $setting->ct_payumoney_salt; ?>" name="ct_payumoney_salt" size="50" />
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
												<!-- bank trasfer new -->
												<div class="panel panel-default ct-payment-methods">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <span><?php echo $label_language_values['bank_transfer'];?></span><div class="payment-icon"><i class="fa fa-money" aria-hidden="true"></i></div>
															<div class="ct-enable-disable-right pull-right">
                                                                <label class="ctoggle-bank-transfer-payment-checkout" for="bank-transfer-payment-checkout">
																	<input class="cta-toggle-checkbox" data-toggle="toggle" data-size="small" type='checkbox' <?php if($setting->ct_bank_transfer_status=='Y'){echo 'checked';} ?> name="" id="bank-transfer-payment-checkout" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
																
                                                                </label>
                                                            </div>
                                                        </h4>
														
                                                    </div>
													
													
                                                    <div id="collapseOne" <?php if($setting->ct_bank_transfer_status=='Y'){echo 'style="display:block"';} ?> class="panel-collapse collapse mycollapse_bank-transfer-payment-checkout" >
                                                        <div class="panel-body p-10">
                                                            <table class="form-inline ct-common-table">
                                                                <tbody>
																
																<tr>
                                                                    <td><label><?php echo $label_language_values['bank_name'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="ct_bank_name" value="<?php echo  $setting->get_option('ct_bank_name');?>" name="" size="50" />
                                                                           
                                                                        </div>
                                                                    </td>
                                                                </tr>
																
                                                                <tr>
                                                                    <td><label><?php echo $label_language_values['account_name'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="ct_account_name" value="<?php echo  $setting->get_option('ct_account_name');?>" name="" size="50" />
                                                                        </div>
                                                                    </td>
                                                                </tr>
																<tr>
                                                                    <td><label><?php echo $label_language_values['account_number'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="ct_account_number" value="<?php echo  $setting->get_option('ct_account_number');?>" name="" size="50" />
                                                                        </div>
                                                                    </td>
                                                                </tr>
																<tr>
                                                                    <td><label><?php echo $label_language_values['branch_code'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="ct_branch_code" value="<?php echo  $setting->get_option('ct_branch_code');?>" name="" size="10" />
                                                                        </div>
                                                                    </td>
                                                                </tr>
																<tr>
                                                                    <td><label><?php echo $label_language_values['ifsc_code'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="ct_ifsc_code" value="<?php echo  $setting->get_option('ct_ifsc_code');?>" name="" size="30" />
                                                                        </div>
                                                                    </td>
                                                                </tr>
																<tr>
                                                                    <td><label><?php echo $label_language_values['bank_description'];?></label></td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <textarea class="form-control"  id="ct_bank_description" value="" cols="48" rows="3"><?php echo  $setting->get_option('ct_bank_description');?></textarea>
                                                                        </div>
                                                                    </td>
                                                                </tr>
																
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
												<!-- new bank transfer end -->
												<!-- Payment start -->
												<?php 
												if(sizeof($purchase_check)>0){
													foreach($purchase_check as $key=>$val){
														if($val == 'Y'){
															echo $payment_hook->payment_setting_hook($key);
														}
													}
												}
												?>
												<!-- Payment end -->
												<!-- End -->
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <a id="payment_setting" name="save-payment-gateways-setting" class="btn btn-success ct-btn-width mt-20 ml-10" ><?php echo $label_language_values['save_setting'];?></a>

                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="tab-pane fade in" id="email-setting">
                <form method="post" type="" class="ct-email-settings" >
                    <div class="panel panel-default">
                        <div class="panel-heading cta-top-right">
                            <h1 class="panel-title"><?php echo $label_language_values['email_settings'];?></h1>
                            <span class="pull-right cta-setting-fix-btn"> <a id="email_setting" name="" class="btn btn-success"><?php echo $label_language_values['save_setting'];?></a></span>
                        </div>
                        <div class="panel-body pt-50 plr-10">

                            <div class="panel-body">
                                <table class="form-inline ct-common-table" >
                                    <tbody>
                                    <tr>
                                        <td><label><?php echo $label_language_values['admin_email_notifications'];?></label></td>
                                        <td>
                                            <div class="form-group">
                                                <label class="ctoggle-admin-email-notification" for="admin-email-notification">
													<input data-toggle="toggle" data-size="small" type='checkbox' <?php if($setting->ct_admin_email_notification_status=='Y'){echo 'checked';}?> name="" id="admin-email-notification" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
													
                                                </label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label><?php echo $label_language_values['client_email_notifications'];?></label></td>
                                        <td>
                                            <div class="form-group">
                                                <label class="ctoggle-client-email-notification" for="client-email-notification">
													<input data-toggle="toggle" data-size="small" type='checkbox' <?php if($setting->ct_client_email_notification_status=='Y'){echo 'checked';}?> name="" id="client-email-notification" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
													
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
									<tr>
                                        <td><label><?php echo $label_language_values['staff_email_notification'];?></label></td>
                                        <td>
                                            <div class="form-group">
                                                <label class="ctoggle-client-email-notification" for="client-email-notification">
													<input data-toggle="toggle" data-size="small" type='checkbox' <?php if($setting->ct_staff_email_notification_status=='Y'){echo 'checked';}?> name="" id="staff-email-notification" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
													
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
									
									<tr>
                                        <td><label><?php echo $label_language_values['administrator_email'];?></label></td>
                                        <td>
                                            <div class="form-group">
                                                <input type="" value="<?php  echo $admin_optional_email;?>" class="form-control w-300" name="admin_optional_email" id="admin_optional_email" placeholder="admin@example.com" />
                                            </div>
                                        </td>
                                    </tr>
									<tr><td class="np"><hr /></td><td class="np"><hr /></td></tr>
                                    <tr>
                                        <td><label><?php echo $label_language_values['sender_name'];?></label></td>
                                        <td>
                                            <div class="form-group">
                                                <input type="" value="<?php echo htmlentities($setting->ct_email_sender_name);?>" class="form-control w-300" name="" id="sender_name" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label><?php echo $label_language_values['sender_email_address_cleanto_admin_email'];?></label></td>
                                        <td>
                                            <div class="form-group">
                                                <input type="" value="<?php echo ($setting->ct_email_sender_address)?>" class="form-control w-300" name="ct_email_sender_address" id="sender_email" placeholder="admin@example.com" />
                                            </div>
                                        </td>
                                    </tr>
									<tr><td class="np"><hr /></td><td class="np"><hr /></td></tr>
                                   
                                    <tr>
                                        <td><label>SMTP <?php echo $label_language_values['hostname'];?></label></td>
                                        <td>
                                            <div class="form-group">
                                                <input type="" value="<?php echo ($setting->ct_smtp_hostname);?>" class="form-control w-300" name="" id="ct_smtp_hostname" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>SMTP <?php echo $label_language_values['username'];?></label></td>
                                        <td>
                                            <div class="form-group">
                                                <input type="" value="<?php echo ($setting->ct_smtp_username)?>" class="form-control w-300" name="" id="ct_smtp_username" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>SMTP <?php echo $label_language_values['password'];?></label></td>
                                        <td>
                                            <div class="form-group">
                                                <input type="" value="<?php echo ($setting->ct_smtp_password)?>" class="form-control w-300" name="" id="ct_smtp_password" />
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><label>SMTP <?php echo $label_language_values['port'];?></label></td>
                                        <td>
                                            <div class="form-group">
                                                <input type="" value="<?php echo ($setting->ct_smtp_port)?>" class="form-control w-300" name="" id="ct_smtp_port" />
                                            </div>
                                        </td>
                                    </tr>
									<tr>
                                        <td><label><?php echo $label_language_values['encryption_type'];?></label></td>
                                        <td>
                                            <div class="form-group">
                                                <select name="ct_email_appointment_encryption" id="encryption_val" class="selectpicker" data-size="5" style="display: none;">
                                                    <option <?php if($setting->ct_smtp_encryption==''){echo "selected";}?> value=""><?php echo $label_language_values['plain'];?></option>
													<option <?php if($setting->ct_smtp_encryption=='tls'){echo "selected";}?> value="tls">TLS</option>
													<option <?php if($setting->ct_smtp_encryption=='ssl'){echo "selected";}?> value="ssl">SSL</option>
                                                </select>
                                            </div>											
                                        </td>
                                    </tr>
									<tr>
                                        <td><label>SMTP <?php echo $label_language_values['authetication'];?></label></td>
                                        <td>
                                            <div class="form-group">
                                                <select name="ct_email_appointment_authentication" id="authentication_val" class="selectpicker" data-size="5" style="display: none;">
													<option <?php if($setting->ct_smtp_authetication=='false'){echo "selected";}?> value="false"><?php echo $label_language_values['false'];?></option>
													<option <?php if($setting->ct_smtp_authetication=='true'){echo "selected";}?> value="true"><?php echo $label_language_values['true'];?></option>
                                                </select>
                                            </div>											
                                        </td>
                                    </tr>
									<tr><td class="np"><hr /></td><td class="np"><hr /></td></tr>
									
									<tr>
                                        <td><label><?php echo $label_language_values['appointment_reminder_buffer'];?></label></td>
                                        <td>
                                            <div class="form-group">
                                                <select name="ct_email_appointment_reminder_buffer" id="appointment_reminder" class="selectpicker" data-size="5" style="display: none;">
                                                    <option value=""><?php echo $label_language_values['set_email_reminder_buffer'];?></option>
                                                    <option value="60" <?php if($setting->ct_email_appointment_reminder_buffer=='60'){echo 'selected';} ?> >1 <?php echo $label_language_values['hours'];?></option>
                                                    <option value="120"  <?php if($setting->ct_email_appointment_reminder_buffer=='120'){echo 'selected';} ?> >2 <?php echo $label_language_values['hours'];?></option>
                                                    <option value="180"  <?php if($setting->ct_email_appointment_reminder_buffer=='180'){echo 'selected';} ?> >3 <?php echo $label_language_values['hours'];?></option>
                                                    <option value="240"  <?php if($setting->ct_email_appointment_reminder_buffer=='240'){echo 'selected';} ?> >4 <?php echo $label_language_values['hours'];?></option>
                                                    <option value="300"  <?php if($setting->ct_email_appointment_reminder_buffer=='300'){echo 'selected';} ?> >5 <?php echo $label_language_values['hours'];?></option>
                                                    <option value="360"  <?php if($setting->ct_email_appointment_reminder_buffer=='360'){echo 'selected';} ?> >6 <?php echo $label_language_values['hours'];?></option>
                                                    <option value="420" <?php if($setting->ct_email_appointment_reminder_buffer=='420'){echo 'selected';} ?> >7 <?php echo $label_language_values['hours'];?></option>
                                                    <option value="480" <?php if($setting->ct_email_appointment_reminder_buffer=='480'){echo 'selected';} ?> >8 <?php echo $label_language_values['hours'];?></option>
                                                    <option value="1440" <?php if($setting->ct_email_appointment_reminder_buffer=='1440'){echo 'selected';} ?> >1 <?php echo $label_language_values['days'];?></option>
                                                </select>
                                            </div>
											<div class="ct-reminder-buffer">
												 Note: You can set the following file as a cron job on your server to make the 'appointment reminder notification' working.<br />	
												<b>Cronjob file:</b>&nbsp;<?php echo ROOT_PATH; ?>assets/lib/email_reminder_ajax.php
											</div>
                                        </td>
                                    </tr>
									

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <a id="email_setting" name="" class="btn btn-success"><?php echo $label_language_values['save_setting'];?></a>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>


                            </div>

                        </div>
                    </div>
                </form>
            </div>

			<div class="tab-pane fade in" id="email-template">
					<div class="ct-email-template-panel panel panel-default wf-100">
						<div class="panel-heading">
							<h1 class="panel-title"><?php echo $label_language_values['email_template_settings'];?></h1>
						</div>
						<!-- Client email templates -->
						<ul class="nav nav-tabs nav-justified">
							<li class="active"><a data-toggle="tab" href="#client-email-template"><?php echo $label_language_values['client_email_templates'];?></a></li>
							<li><a data-toggle="tab" href="#admin-email-template"><?php echo $label_language_values['admin_email_template'];?></a></li>
							<li><a data-toggle="tab" href="#staff-email-template"><?php echo $label_language_values['staff_email_template'];?></a></li>
						</ul>
						<div class="tab-content">
							<div id="client-email-template" class="tab-pane fade in active">
								<h3><?php echo $label_language_values['client_email_templates'];?></h3>
								<div id="accordion" class="panel-group">
									<ul class="nav nav-tab nav-stacked">
										<?php
										$readall_client_email_template = $email_template->readall_client_email_template();
										$ti = 1;
										while($readall_client = mysqli_fetch_array($readall_client_email_template)){
											?>
											<li class="panel panel-default ct-client-email-temp-panel" >
											<div class="panel-heading br-2">
												<h4 class="panel-title">
													<div class="cta-col11">
														<div class="pull-left">
															<div class="ct-yes-no-email-right pull-left">
																<label class="ct-toggle" for="email-client<?php echo $readall_client['id']; ?>">			
																    <input class='cta-toggle-checkbox save_client_email_template_status' <?php if($readall_client['email_template_status'] =='E'){ ?> checked <?php } ?> data-toggle="toggle" data-size="small" type='checkbox' data-id="<?php echo $readall_client['id']; ?>" id="email-client<?php echo $readall_client['id']; ?>"  data-on="<?php echo $label_language_values['o_n'];?>" data-off="<?php echo $label_language_values['off'];?>" data-onstyle='primary' data-offstyle='default' />
																	
																</label>
															</div>
														</div>	
														<span class="ct-template-name"><?php echo $label_language_values[strtolower(str_replace(" ","_",$readall_client['email_subject']))]; ?></span>
													</div>
													<div class="pull-right cta-col1">
														<div class="pull-right">
															<div class="ct-show-hide pull-right">
																<input type="checkbox" name="ct-show-hide" class="ct-show-hide-checkbox ct_open_close_email_template" id="ce<?php echo $readall_client['id']; ?>" data-id="<?php echo $readall_client['id']; ?>">
																<label class="ct-show-hide-label" for="ce<?php echo $readall_client['id']; ?>"></label>
															</div>
														</div>
													</div>
													
												</h4>
											</div>
											<div id="detail_email_templates_<?php echo $readall_client['id']; ?>" class="panel-collapse collapse email_content detail_ce<?php echo $readall_client['id']; ?>">
												<div class="panel-body p-10">
													<div class="ct-email-temp-collapse-div col-md-12 col-lg-12 col-xs-12 np">
														<form id="" method="post" type="" class="slide-toggle email_template_form" >
															<div class="col-md-8 col-sm-8 col-xs-12">
																<textarea class="form-control" name="email_message<?php echo $ti;?>" id="email_message_<?php echo $readall_client['id']; ?>" cols="50" rows="20" placeholder="Add here your message"><?php if($readall_client['email_message'] != ''){ echo base64_decode($readall_client['email_message']); }else{ echo base64_decode($readall_client['default_message']); } ?></textarea>
																
																<input type="submit"  class="btn btn-success ct-btn-width pull-left cb ml-15 mt-20" name="template<?php echo $ti;?>" value="Save Template">
																<input type="hidden" name="hdntemplate<?php echo $ti;?>" value="<?php echo $readall_client['id']; ?>">
															
																<a id="default_email_contents" name="" data-id="<?php echo $readall_client['id']; ?>" class="btn btn-primary ct-btn-width cb ml-15 mt-20" type="submit"><?php echo $label_language_values['default_template'];?></a>
															</div>
															<div class="col-md-4 col-sm-4 col-xs-12">
																<div class="ct-email-content-tags">
                                                                    <b><?php echo $label_language_values['tags'];?></b><br>
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{booking_date}}">{{<?php echo $label_language_values['booking_date'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{booking_time}}">{{<?php echo $label_language_values['booking_time'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{service_name}}">{{<?php echo $label_language_values['service_name'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{client_name}}">{{<?php echo $label_language_values['client_name'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{methodname}}">{{<?php echo $label_language_values['methodname'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{units}}">{{<?php echo $label_language_values['units'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{addons}}">{{<?php echo $label_language_values['addons'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{firstname}}">{{<?php echo $label_language_values['firstname'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{lastname}}">{{<?php echo $label_language_values['lastname'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{client_email}}">{{<?php echo $label_language_values['client_email'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{phone}}">{{<?php echo $label_language_values['client__phone'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{payment_method}}">{{<?php echo $label_language_values['payment_method'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{vaccum_cleaner_status}}">{{<?php echo $label_language_values['vaccum_cleaner_status'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{parking_status}}">{{<?php echo $label_language_values['parking_status'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{notes}}">{{<?php echo $label_language_values['notes'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{contact_status}}">{{<?php echo $label_language_values['contact_status'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{price}}">{{<?php echo $label_language_values['price'];?>}}</a><br />
																	
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{address}}">{{<?php echo $label_language_values['client__address'];?>}}</a><br />
																	
																	<a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{client_city}}">{{<?php echo $label_language_values['client__city'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{client_state}}">{{<?php echo $label_language_values['client__state'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{client_zip}}">{{<?php echo $label_language_values['client__zip'];?>}}</a><br />
																	
																	
																	
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{app_remain_time}}">{{<?php echo $label_language_values['app_remain_time'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{reject_status}}">{{<?php echo $label_language_values['reject_status'];?>}}</a><br />
																	
																	<a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{business_logo}}">{{<?php echo $label_language_values['business_logo'];?>}}</a><br />
                                                                    <?php /* <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{business_logo_alt}}">{{<?php echo $label_language_values['business_logo_alt'];?>}}</a><br /> */ ?>
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{admin_name}}">{{<?php echo $label_language_values['admin_name'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{company_name}}">{{<?php echo $label_language_values['company__name'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{company_address}}">{{<?php echo $label_language_values['company__address'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{company_city}}">{{<?php echo $label_language_values['company__city'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{company_state}}">{{<?php echo $label_language_values['company__state'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{company_zip}}">{{<?php echo $label_language_values['company__zip'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{company_country}}">{{<?php echo $label_language_values['company__country'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{company_phone}}">{{<?php echo $label_language_values['company__phone'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_client['id']; ?>" class="tags email_short_tags" data-value="{{company_email}}">{{<?php echo $label_language_values['company__email'];?>}}</a><br />																</div>		 
															</div>
															<?php /*
															<a id="save_email_template" name="" data-id="<?php echo $readall_client['id']; ?>" class="btn btn-success ct-btn-width pull-left cb ml-15 mt-20" type="submit"><?php echo $label_language_values['save_template'];?></a>
															*/
															?>
															
															
															<?php $ti++;?>
															
                                                        </form>
													</div>
												</div>
											</div>
										</li>
										<?php
										}
										?>
									</ul>
								</div>
							</div>
							<div id="admin-email-template" class="tab-pane fade">
								<h3><?php echo $label_language_values['admin_email_template'];?></h3>
								<div id="accordion" class="panel-group">
									<ul class="nav nav-tab nav-stacked">
										<?php
										$readall_admin_email_template = $email_template->readall_admin_email_template();
										while($readall_admin = mysqli_fetch_array($readall_admin_email_template)){
										?>
											<li class="panel panel-default ct-admin-email-temp-panel" >
											<div class="panel-heading br-2">
												<h4 class="panel-title">
													<div class="cta-col11">
														<div class="pull-left">
															<div class="ct-yes-no-email-right pull-left">
																<label class="ct-toggle" for="email-admin<?php echo $readall_admin['id']; ?>">
																		
																		<input class='cta-toggle-checkbox save_admin_email_template_status' <?php if($readall_admin['email_template_status'] =='E'){ ?> checked <?php } ?> data-toggle="toggle" data-size="small" type='checkbox' data-id="<?php echo $readall_admin['id']; ?>" id="email-admin<?php echo $readall_admin['id']; ?>"  data-on="<?php echo $label_language_values['o_n'];?>" data-off="<?php echo $label_language_values['off'];?>" data-onstyle='primary' data-offstyle='default' />
																		
																</label>
															</div>
														</div>	
														<span class="ct-template-name"><?php echo $label_language_values[strtolower(str_replace(" ","_",$readall_admin['email_subject']))]; ?></span>
													</div>
													<div class="pull-right cta-col1">
														<div class="pull-right">
															<div class="ct-show-hide pull-right">
																<input type="checkbox" name="ct-show-hide" class="ct-show-hide-checkbox ct_open_close_email_template" id="ae<?php echo $readall_admin['id']; ?>" data-id="<?php echo $readall_admin['id']; ?>">
																<label class="ct-show-hide-label" for="ae<?php echo $readall_admin['id']; ?>"></label>
															</div>
														</div>
													</div>
													
												</h4>
											</div>
											<div id="detail_email_templates_<?php echo $readall_admin['id']; ?>" class="panel-collapse collapse email_content detail_ae<?php echo $readall_admin['id']; ?>">
												<div class="panel-body p-10">
													<div class="ct-email-temp-collapse-div col-md-12 col-lg-12 col-xs-12 np">
														<form id="" method="post" type="" class="slide-toggle email_template_form" >
															<div class="col-md-8 col-sm-8 col-xs-12">
																<textarea class="form-control" name="email_message<?php echo $ti;?>"  id="email_message_<?php echo $readall_admin['id']; ?>" cols="50" rows="20" placeholder="Add here your message"><?php if($readall_admin['email_message'] != ''){ echo base64_decode($readall_admin['email_message']); }else{ echo base64_decode($readall_admin['default_message']); } ?></textarea>
																
																<input type="submit"  class="btn btn-success ct-btn-width pull-left cb ml-15 mt-20" name="template<?php echo $ti;?>" value="Save Template">
															
																<input type="hidden" name="hdntemplate<?php echo $ti;?>" value="<?php echo $readall_admin['id']; ?>">
																
																<a id="default_email_contents" name="" data-id="<?php echo $readall_admin['id']; ?>" class="btn btn-primary ct-btn-width cb ml-15 mt-20" type="submit"><?php echo $label_language_values['default_template'];?></a>
															</div>
															<div class="col-md-4 col-sm-4 col-xs-12">
																<div class="ct-email-content-tags">
                                                                    <b><?php echo $label_language_values['tags'];?></b><br>
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{booking_date}}">{{<?php echo $label_language_values['booking_date'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{booking_time}}">{{<?php echo $label_language_values['booking_time'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{service_name}}">{{<?php echo $label_language_values['service_name'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{client_name}}">{{<?php echo $label_language_values['client_name'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{methodname}}">{{<?php echo $label_language_values['methodname'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{units}}">{{<?php echo $label_language_values['units'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{addons}}">{{<?php echo $label_language_values['addons'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{firstname}}">{{<?php echo $label_language_values['firstname'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{lastname}}">{{<?php echo $label_language_values['lastname'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{client_email}}">{{<?php echo $label_language_values['client_email'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{phone}}">{{<?php echo $label_language_values['client__phone'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{payment_method}}">{{<?php echo $label_language_values['payment_method'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{vaccum_cleaner_status}}">{{<?php echo $label_language_values['vaccum_cleaner_status'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{parking_status}}">{{<?php echo $label_language_values['parking_status'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{notes}}">{{<?php echo $label_language_values['notes'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{contact_status}}">{{<?php echo $label_language_values['contact_status'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{price}}">{{<?php echo $label_language_values['price'];?>}}</a><br />
																	
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{address}}">{{<?php echo $label_language_values['client__address'];?>}}</a><br />
																	
																	<a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{client_city}}">{{<?php echo $label_language_values['client__city'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{client_state}}">{{<?php echo $label_language_values['client__state'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{client_zip}}">{{<?php echo $label_language_values['client__zip'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{app_remain_time}}">{{<?php echo $label_language_values['app_remain_time'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{reject_status}}">{{<?php echo $label_language_values['reject_status'];?>}}</a><br />
																	
																	<a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{business_logo}}">{{<?php echo $label_language_values['business_logo'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{admin_name}}">{{<?php echo $label_language_values['admin_name'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{company_name}}">{{<?php echo $label_language_values['company__name'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{company_address}}">{{<?php echo $label_language_values['company__address'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{company_city}}">{{<?php echo $label_language_values['company__city'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{company_state}}">{{<?php echo $label_language_values['company__state'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{company_zip}}">{{<?php echo $label_language_values['company__zip'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{company_country}}">{{<?php echo $label_language_values['company__country'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{company_phone}}">{{<?php echo $label_language_values['company__phone'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_admin['id']; ?>" class="tags email_short_tags" data-value="{{company_email}}">{{<?php echo $label_language_values['company__email'];?>}}</a><br />
																</div>
															</div>
															
                                                            <?php /*
														<a id="save_email_template" name="" data-id="<?php echo $readall_admin['id']; ?>" class="btn btn-success ct-btn-width pull-left cb ml-15 mt-20" type="submit"><?php echo $label_language_values['save_template'];?></a>
															*/
															?>
															
															
															<?php $ti++;?>	
															
														</form>	
													</div>
												</div>
											</div>
										</li>
										<?php
										}
										?>
									</ul>
								</div>
							</div>
							<div id="staff-email-template" class="tab-pane fade">
								<h3><?php echo $label_language_values['staff_email_template'];?></h3>
								<div id="accordion" class="panel-group">
									<ul class="nav nav-tab nav-stacked">
										<?php
										$readall_staff_email_template = $email_template->readall_staff_email_template();
										
										while($readall_staff = mysqli_fetch_array($readall_staff_email_template)){
										?>
											<li class="panel panel-default ct-staff-email-temp-panel" >
											<div class="panel-heading br-2">
												<h4 class="panel-title">
													<div class="cta-col11">
														<div class="pull-left">
															<div class="ct-yes-no-email-right pull-left">
																<label class="ct-toggle" for="email-staff<?php echo $readall_staff['id']; ?>">
																		
																		<input class='cta-toggle-checkbox save_staff_email_template_status' <?php if($readall_staff['email_template_status'] =='E'){ ?> checked <?php } ?> data-toggle="toggle" data-size="small" type='checkbox' data-id="<?php echo $readall_staff['id']; ?>" id="email-staff<?php echo $readall_staff['id']; ?>"  data-on="<?php echo $label_language_values['o_n'];?>" data-off="<?php echo $label_language_values['off'];?>" data-onstyle='primary' data-offstyle='default' />
																		
																</label>
															</div>
														</div>	
														<span class="ct-template-name"><?php echo $label_language_values[strtolower(str_replace(" ","_",$readall_staff['email_subject']))]; ?></span>
													</div>
													<div class="pull-right cta-col1">
														<div class="pull-right">
															<div class="ct-show-hide pull-right">
																<input type="checkbox" name="ct-show-hide" class="ct-show-hide-checkbox ct_open_close_email_template" id="ae<?php echo $readall_staff['id']; ?>" data-id="<?php echo $readall_staff['id']; ?>">
																<label class="ct-show-hide-label" for="ae<?php echo $readall_staff['id']; ?>"></label>
															</div>
														</div>
													</div>
													
												</h4>
											</div>
											<div id="detail_email_templates_<?php echo $readall_staff['id']; ?>" class="panel-collapse collapse email_content detail_ae<?php echo $readall_staff['id']; ?>">
												<div class="panel-body p-10">
													<div class="ct-email-temp-collapse-div col-md-12 col-lg-12 col-xs-12 np">
														<form id="" method="post" type="" class="slide-toggle email_template_form" >
															<div class="col-md-8 col-sm-8 col-xs-12">
																<textarea class="form-control" name="email_message<?php echo $ti;?>"  id="email_message_<?php echo $readall_staff['id']; ?>" cols="50" rows="20" placeholder="Add here your message"><?php if($readall_staff['email_message'] != ''){ echo base64_decode($readall_staff['email_message']); }else{ echo base64_decode($readall_staff['default_message']); } ?></textarea>
																
																<input type="submit"  class="btn btn-success ct-btn-width pull-left cb ml-15 mt-20" name="template<?php echo $ti;?>" value="Save Template">
															
																<input type="hidden" name="hdntemplate<?php echo $ti;?>" value="<?php echo $readall_staff['id']; ?>">
																<a id="default_email_contents" name="" data-id="<?php echo $readall_staff['id']; ?>" class="btn btn-primary ct-btn-width cb ml-15 mt-20" type="submit"><?php echo $label_language_values['default_template'];?></a>
															</div>
															<div class="col-md-4 col-sm-4 col-xs-12">
																<div class="ct-email-content-tags">
                                                                    <b><?php echo $label_language_values['tags'];?></b><br>
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{booking_date}}">{{<?php echo $label_language_values['booking_date'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{booking_time}}">{{<?php echo $label_language_values['booking_time'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{service_name}}">{{<?php echo $label_language_values['service_name'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{client_name}}">{{<?php echo $label_language_values['client_name'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{methodname}}">{{<?php echo $label_language_values['methodname'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{units}}">{{<?php echo $label_language_values['units'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{addons}}">{{<?php echo $label_language_values['addons'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{firstname}}">{{<?php echo $label_language_values['firstname'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{lastname}}">{{<?php echo $label_language_values['lastname'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{client_email}}">{{<?php echo $label_language_values['client_email'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{phone}}">{{<?php echo $label_language_values['client__phone'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{payment_method}}">{{<?php echo $label_language_values['payment_method'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{vaccum_cleaner_status}}">{{<?php echo $label_language_values['vaccum_cleaner_status'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{parking_status}}">{{<?php echo $label_language_values['parking_status'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{notes}}">{{<?php echo $label_language_values['notes'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{contact_status}}">{{<?php echo $label_language_values['contact_status'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{price}}">{{<?php echo $label_language_values['price'];?>}}</a><br />
																	
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{address}}">{{<?php echo $label_language_values['client__address'];?>}}</a><br />
																	
																	<a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{client_city}}">{{<?php echo $label_language_values['client__city'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{client_state}}">{{<?php echo $label_language_values['client__state'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{client_zip}}">{{<?php echo $label_language_values['client__zip'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{app_remain_time}}">{{<?php echo $label_language_values['app_remain_time'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{reject_status}}">{{<?php echo $label_language_values['reject_status'];?>}}</a><br />
																	
																	<a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{business_logo}}">{{<?php echo $label_language_values['business_logo'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{admin_name}}">{{<?php echo $label_language_values['admin_name'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{company_name}}">{{<?php echo $label_language_values['company__name'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{company_address}}">{{<?php echo $label_language_values['company__address'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{company_city}}">{{<?php echo $label_language_values['company__city'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{company_state}}">{{<?php echo $label_language_values['company__state'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{company_zip}}">{{<?php echo $label_language_values['company__zip'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{company_country}}">{{<?php echo $label_language_values['company__country'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{company_phone}}">{{<?php echo $label_language_values['company__phone'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $readall_staff['id']; ?>" class="tags email_short_tags" data-value="{{company_email}}">{{<?php echo $label_language_values['company__email'];?>}}</a><br />
																</div>
															</div>
															
                                                            
                                                            <?php /*
														<a id="save_email_template" name="" data-id="<?php echo $readall_staff['id']; ?>" class="btn btn-success ct-btn-width pull-left cb ml-15 mt-20" type="submit"><?php echo $label_language_values['save_template'];?></a>
															*/
															?>
															
															
															<?php $ti++;?>
															
														</form>	
													</div>
												</div>
											</div>
										</li>
										<?php
										}
										?>
									</ul>
								</div>
							</div>
						</div>
							
					</div>
				</div>

				<div class="tab-pane fade in" id="sms-reminder">
					<form id="sms_setting_form" method="post" type="" class="ct-sms-reminder" >
						<div class="panel panel-default ">
							<div class="panel-heading cta-top-right">
								<h1 class="panel-title"><?php echo $label_language_values['sms_reminder'];?></h1>
								<span class="pull-right cta-setting-fix-btn"> <a class="btn btn-success" id="btnsave_sms_service"><?php echo $label_language_values['save_sms_settings'];?></a></span>
							</div>
							<div class="panel-body plr-10 pt-50">
								<div id="accordion" class="panel-group">
									<div class="panel panel-default ct-all-sms-gateway-main">
										
										<div id="collapseOne" style="display: block;" class="panel-collapse collapse mycollapse_sms-service-ena-dis ct-sms-reminder-input pb-p">
											<div class="panel-body p-10">
												<div id="accordion" class="panel-group">
													<div class="panel panel-default ct-sms-gateway">
														<div class="panel-heading">
															<h4 class="panel-title">
																<span><?php echo $label_language_values['twilio_sms_gateway'];?></span><img class="cta-sms-gateway-img" src="<?php echo SITE_URL; ?>/assets/images/twilio-logo.png" />
																<div class="ct-enable-disable-right pull-right">
																	<label class="ctoggle-sms-noti-twilio" for="sms-noti-twilio">
																		<input class='cta-toggle-checkbox' data-toggle="toggle"  <?php if($setting->ct_sms_twilio_status == "Y"){echo "checked";}else{echo "";}?>  data-size="small" type='checkbox' name="" id="sms-noti-twilio" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
																	</label>
																</div>
															</h4>
														</div>
														<div <?php if($setting->ct_sms_twilio_status == "Y"){?> style="display:block;" <?php }?>  id="collapseOne" class="panel-collapse collapse mycollapse_sms-noti-twilio">
															<div class="panel-body p-10"> 
																<table class="form-inline table ct-common-table table-hover table-bordered table-striped" >
																		<tr><th colspan="3"><?php echo $label_language_values['twilio_account_settings'];?></th></tr>
																		<tbody>
																			<tr>
																				<td><label><?php echo $label_language_values['account_sid'];?></label></td>
																				<td colspan="2">
																					<div class="form-group ct-lgf">
																						<input type="text" id="mytwilio_account_sid" class="form-control" value="<?php echo $setting->ct_sms_twilio_account_SID;?>" name="mytwilio_account_sid" size="70" />
																					</div>	
																					<a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['available_from_within_your_twilio_account'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
																					<label for="mytwilio_account_sid" generated="true" class="error" style="display: none;"></label>
																				</td>
																			</tr>
																			<tr>
																				<td><label><?php echo $label_language_values['auth_token'];?></label></td>
																				<td colspan="2">
																					<div class="form-group ct-lgf">
																						<input type="password" id="mytwilio_auth_token" class="form-control" value="<?php echo $setting->ct_sms_twilio_auth_token;?>" name="mytwilio_auth_token" size="70" />
																					</div>	
																					<a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['available_from_within_your_twilio_account'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
																					<label for="mytwilio_auth_token" generated="true" class="error"></label>
																				</td>
																			</tr>
																			<tr>
																				<td><label><?php echo $label_language_values['twilio_sender_number'];?></label></td>
																				<td colspan="2">
																					<div class="form-group ct-lgf">
																						<input type="text" id="mytwilio_sender_number" class="form-control" value="<?php echo $setting->ct_sms_twilio_sender_number;?>" name="mytwilio_sender_number" size="70" />
																					</div>	
																					<a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['must_be_a_valid_number_associated_with_your_twilio_account'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
																					<label for="mytwilio_sender_number" generated="true" class="error"></label>
																				</td>
																			</tr>
																			<tr>
																				<td id="hr"></td><td id="hr"></td><td id="hr"></td>
																			</tr>
																		</tbody>
																		<tbody>
																		<th colspan="3"><?php echo $label_language_values['twilio_sms_settings'];?></th>
																			<tr>
																				<td><label><?php echo $label_language_values['send_sms_to_client'];?></label></td>
																				<td colspan="2">
																					<div class="form-group">
																						<label class="ctoggle-ct-sms-reminder-client-status" for="ct-sms-reminder-client-status">
																							<input data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if($setting->ct_sms_twilio_send_sms_to_client_status){echo "checked";}else{echo "";}?> id="ct-sms-reminder-client-status" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
																						</label>
																					</div>	
																					<a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['enable_or_disable_send_sms_to_client_for_appointment_booking_info'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
																				</td>
																			</tr>
																			<tr>
																				<td><label><?php echo $label_language_values['send_sms_to_admin'];?></label></td>
																				<td colspan="2">
																					<div class="form-group">
																						<label class="ctoggle-ct-sms-reminder-admin-status" for="ct-sms-reminder-admin-status">
																							<input data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if($setting->ct_sms_twilio_send_sms_to_admin_status){echo "checked";}else{echo "";}?> id="ct-sms-reminder-admin-status" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
																						</label>
																					</div>	
																					<a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['enable_or_disable_send_sms_to_client_for_appointment_booking_info'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
																				</td>
																			</tr>
																			<tr>
																				<td><label><?php echo $label_language_values['admin_phone_number']; ?></label></td>
																				<td colspan="2">
																					<div class="input-group">
																						<span class="input-group-addon"><span class="company_country_code_value_twilio"><?php echo $country_codes[0];?></span></span>
																						<input type="text" class="form-control" value="<?php echo str_replace($country_codes[0],'',$setting->get_option('ct_sms_twilio_admin_phone_number'));?>" name="myadmin_phone_number" id="myadmin_phone_number" />
																					</div>
																				</td>
																			</tr>
																			<tr>
																				<td id="hr"></td><td id="hr"></td><td id="hr"></td>
																			</tr>
																		</tbody>
																		
																	</table>
															</div>
														</div>
													</div>
													<div class="panel panel-default ct-sms-gateway">
														<div class="panel-heading">
															<h4 class="panel-title">
																<span><?php echo $label_language_values['plivo_sms_gateway'];?></span><img class="cta-sms-gateway-img" src="<?php echo SITE_URL; ?>/assets/images/plivo-logo.png" />
																<div class="ct-enable-disable-right pull-right">
																	<label class="ctoggle-sms-noti-plivo" for="sms-noti-plivo">
																		<input class='cta-toggle-checkbox' data-toggle="toggle" <?php if($setting->ct_sms_plivo_status == "Y"){echo "checked";}else{echo "";}?>  data-size="small" type='checkbox' name="" id="sms-noti-plivo" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
																	</label>
																</div>

															</h4>
														</div>
														<div id="collapseOne" <?php if($setting->ct_sms_plivo_status == "Y"){?> style="display:block;" <?php }?>   class="panel-collapse collapse mycollapse_sms-noti-plivo">
															<div class="panel-body p-10"> 
																<div class="table-responsive"> 
																	<table class="form-inline table ct-common-table table-hover table-bordered table-striped" >
																		<tr><th colspan="3"><?php echo $label_language_values['plivo_account_settings'];?></th></tr>
																		<tbody>
																			<tr>
																				<td><label><?php echo $label_language_values['account_sid'];?></label></td>
																				<td colspan="2">
																					<div class="form-group ct-lgf">
																						<input type="text" id="myplivo_account_sid" class="form-control" value="<?php echo $setting->ct_sms_plivo_account_SID;?>" name="myplivo_account_sid" size="70" />
																					</div>	
																					 <a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['available_from_within_your_plivo_account'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
																					<label for="myplivo_account_sid" generated="true" class="error" style="display: none;"></label>
																				</td>
																			</tr>
																			<tr>
																				<td><label><?php echo $label_language_values['auth_token'];?></label></td>
																				<td colspan="2">
																					<div class="form-group ct-lgf">
																						<input type="password" id="myplivo_auth_token" class="form-control" value="<?php echo $setting->ct_sms_plivo_auth_token;?>" name="myplivo_auth_token" size="70" />
																					</div>	
																					 <a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['available_from_within_your_plivo_account'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
																					<label for="myplivo_auth_token" generated="true" class="error"></label>
																				</td>
																			</tr>
																			<tr>
																				<td><label><?php echo $label_language_values['plivo_sender_number'];?></label></td>
																				<td colspan="2">
																					<div class="form-group ct-lgf">
																						<input type="text" id="myplivo_sender_number" class="form-control" value="<?php echo $setting->ct_sms_plivo_sender_number;?>" name="myplivo_sender_number" size="70" />
																					</div>	
																					 <a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['must_be_a_valid_number_associated_with_your_plivo_account'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
																					<label for="myplivo_sender_number" generated="true" class="error"></label>
																				</td>
																			</tr>
																			<tr>
																				<td id="hr"></td><td id="hr"></td><td id="hr"></td>
																			</tr>
																		</tbody>
																		
																		<tbody>
																		
																		<th colspan="3"><?php echo $label_language_values['plivo_sms_settings'];?></th>
																			<tr>
																				<td><label><?php echo $label_language_values['send_sms_to_client'];?></label></td>
																				<td colspan="2">
																					<div class="form-group">
																						<label class="ctoggle-ct-sms-reminder-client-status-plivo" for="ct-sms-reminder-client-status-plivo">
																							<input data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if($setting->ct_sms_plivo_send_sms_to_client_status == "Y"){echo "checked";}else{echo "";}?> id="ct-sms-reminder-client-status-plivo" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
																						</label>
																					</div>	
																					 <a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['enable_or_disable_send_sms_to_client_for_appointment_booking_info'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
																				</td>
																			</tr>
																			<tr>
																				<td><label><?php echo $label_language_values['send_sms_to_admin'];?></label></td>
																				<td colspan="2">
																					<div class="form-group">
																						<label class="ctoggle-ct-sms-reminder-admin-status-plivo" for="ct-sms-reminder-admin-status-plivo">
																							<input data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if($setting->ct_sms_plivo_send_sms_to_admin_status == "Y"){echo "checked";}else{echo "";}?> id="ct-sms-reminder-admin-status-plivo" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
																						</label>
																					</div>	
																					 <a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['enable_or_disable_send_sms_to_admin_for_appointment_booking_info'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
																				</td>
																			</tr>
																			<tr>
																			<td><label><?php echo $label_language_values['admin_phone_number']; ?></label></td>
																				<td colspan="2">
																					<div class="input-group">
																						<span class="input-group-addon"><span class="company_country_code_value_plivo"><?php echo $country_codes[0];?></span></span>
																						<input type="text" class="form-control" value="<?php echo str_replace($country_codes[0],'',$setting->get_option('ct_sms_plivo_admin_phone_number'));?>" name="myadmin_phone_number_plivo" id="myadmin_phone_number_plivo" />
																					</div>
																				</td>
																				
																			</tr>
																			<tr>
																				<td id="hr"></td><td id="hr"></td><td id="hr"></td>
																			</tr>
																		</tbody>
																	</table>
																</div>	
																
															</div>
														</div>
													</div>
													
													<!-- Nexmo Settings -->
													<div class="panel panel-default ct-sms-gateway">
														<div class="panel-heading">
															<h4 class="panel-title">
																<span><?php echo $label_language_values['nexmo_sms_gateway'];?></span><img class="cta-sms-gateway-img" src="<?php echo SITE_URL; ?>/assets/images/nexmo_logo.png" />
																<div class="ct-enable-disable-right pull-right">
																	<label class="ctoggle-sms-noti-plivo" for="sms-noti-nexmo">
																		<input class='cta-toggle-checkbox' data-toggle="toggle" <?php if($setting->ct_sms_nexmo_status == "Y"){echo "checked";}else{echo "";}?>  data-size="small" type='checkbox' name="" id="sms-noti-nexmo" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
																	</label>
																</div>

															</h4>
														</div>
														<div id="collapseOne" <?php if($setting->ct_sms_nexmo_status == "Y"){?> style="display:block;" <?php }?>   class="panel-collapse collapse mycollapse_sms-noti-nexmo">
															<div class="panel-body p-10"> 
																<div class="table-responsive"> 
																	<table class="form-inline table ct-common-table table-hover table-bordered table-striped" >
																		<tr><th colspan="3"><?php echo $label_language_values['nexmo_sms_setting'];?></th></tr>
																		<tbody>
																			<tr>
																				<td><label><?php echo $label_language_values['nexmo_api_key'];?></label></td>
																				<td colspan="2">
																					<div class="form-group ct-lgf">
																						<input type="text" id="ct_nexmo_api_key" class="form-control" value="<?php echo $setting->ct_nexmo_api_key;?>" name="ct_nexmo_api_key" size="70" />
																					</div>	
																					<label for="myplivo_account_sid" generated="true" class="error" style="display: none;"></label>
																				</td>
																			</tr>
																			<tr>
																				<td><label><?php echo $label_language_values['nexmo_api_secret'];?></label></td>
																				<td colspan="2">
																					<div class="form-group ct-lgf">
																						<input type="password" id="ct_nexmo_api_secret" class="form-control" value="<?php echo $setting->ct_nexmo_api_secret;?>" name="ct_nexmo_api_secret" size="70" />
																					</div>	
																					 <a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['available_from_within_your_plivo_account'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
																					<label for="myplivo_auth_token" generated="true" class="error"></label>
																				</td>
																			</tr>
																			<tr>
																				<td><label><?php echo $label_language_values['nexmo_from'];?></label></td>
																				<td colspan="2">
																					<div class="form-group ct-lgf">
																						<input type="text" id="ct_nexmo_from" class="form-control" value="<?php echo $setting->ct_nexmo_from;?>" name="ct_nexmo_from" size="70" />
																					</div>	
																					<label for="myplivo_sender_number" generated="true" class="error"></label>
																				</td>
																			</tr>
																			<tr>
																				<td id="hr"></td><td id="hr"></td><td id="hr"></td>
																			</tr>
																		</tbody>
																		
																		<tbody>
																		
																		
																			<tr>
																				<td><label><?php echo $label_language_values['nexmo_status'];?></label></td>
																				<td colspan="2">
																					<div class="form-group">
																						<label class="ctoggle-ct-sms-reminder-client-status-plivo" for="ct_nexmo_status">
																							<input data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if($setting->ct_nexmo_status == "Y"){echo "checked";}else{echo "";}?> id="ct_nexmo_status" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
																						</label>
																					</div>	
																					 <a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['enable_or_disable_send_sms_to_client_for_appointment_booking_info'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
																				</td>
																			</tr>
																			<tr>
																				<td><label><?php echo $label_language_values['nexmo_send_sms_to_client_status'];?></label></td>
																				<td colspan="2">
																					<div class="form-group">
																						<label class="ctoggle-ct-sms-reminder-admin-status-plivo" for="ct_sms_nexmo_send_sms_to_client_status">
																							<input data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if($setting->ct_sms_nexmo_send_sms_to_client_status == "Y"){echo "checked";}else{echo "";}?> id="ct_sms_nexmo_send_sms_to_client_status" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
																						</label>
																					</div>	
																				</td>
																			</tr>
																			<tr>
																			<td><label><?php echo $label_language_values['nexmo_send_sms_to_admin_status'];?></label></td>
																				<td colspan="2">
																					<div class="form-group">
																						<label class="ctoggle-ct-sms-reminder-admin-status-plivo" for="ct_sms_nexmo_send_sms_to_admin_status">
																						<input data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if($setting->ct_sms_nexmo_send_sms_to_admin_status == "Y"){echo "checked";}else{echo "";}?> id="ct_sms_nexmo_send_sms_to_admin_status" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
																						</label>
																					</div>
																				</td>
																				
																			</tr>
																			<tr>
																				<td><label><?php echo $label_language_values['nexmo_admin_phone_number'];?></label></td>
																				<td colspan="2">
																					<div class="form-group ct-lgf">
																					<div class="input-group">
																						<span class="input-group-addon"><span class="company_country_code_value_plivo"><?php echo $country_codes[0];?></span></span>
																						<input type="text" id="ct_sms_nexmo_admin_phone_number" class="form-control" value="<?php echo $setting->ct_sms_nexmo_admin_phone_number;?>" name="ct_sms_nexmo_admin_phone_number" size="70" />
																					</div>
																					</div>
																					
																					
																				</td>
																					
																					<label for="ct_sms_nexmo_admin_phone_number" generated="true" class="error"></label>
																				</td>
																			</tr>
																			<tr>
																				<td id="hr"></td><td id="hr"></td><td id="hr"></td>
																			</tr>
																		</tbody>
																	</table>
																</div>	
																
															</div>
														</div>
													</div>
													<div class="panel panel-default ct-sms-gateway">
															<div class="panel-heading">
																<h4 class="panel-title"><span><?php echo $label_language_values['textlocal_sms_gateway'];?></span><img class="cta-sms-gateway-img" src="<?php echo SITE_URL; ?>/assets/images/textlocal-logo.png" />
																	<div class="ct-enable-disable-right pull-right">
																		<label class="ctoggle-sms-noti-plivo" for="sms-noti-textlocal">
																			<input class='cta-toggle-checkbox' data-toggle="toggle"  <?php if($setting->ct_sms_textlocal_status == "Y"){echo "checked";}else{echo "";}?>  data-size="small" type='checkbox' name="" id="sms-noti-textlocal" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
																		</label>
																	</div>
																</h4>
															</div>
															<div <?php if($setting->ct_sms_textlocal_status == "Y"){?> style="display:block;" <?php }?>  id="collapseOne" class="panel-collapse collapse mycollapse_sms-noti-textlocal">
																<div class="panel-body p-10">
																	<table class="form-inline table ct-common-table table-hover table-bordered table-striped">
																		<tr><th colspan="3"><?php echo $label_language_values['textlocal_account_settings'];?></th></tr>
																		<tbody>
																			<tr>
																				<td><label><?php echo $label_language_values['account_username'];?></label></td>
																				<td colspan="2">
																					<div class="form-group ct-lgf">
																						<input type="text" id="mytextlocal_username" class="form-control" value="<?php echo $setting->ct_sms_textlocal_account_username;?>" name="mytextlocal_username" size="70" />
																					</div>
																					<a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['email_id_registered_with_you_textlocal'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
																					<label for="mytextlocal_username" generated="true" class="error" style="display: none;"></label>
																				</td>
																			</tr>
																			<tr>
																				<td><label><?php echo $label_language_values['account_hash_id'];?></label></td>
																				<td colspan="2">
																					<div class="form-group ct-lgf">
																						<input type="password" id="mytextlocal_account_hash_id" class="form-control" value="<?php echo $setting->ct_sms_textlocal_account_hash_id;?>" name="mytextlocal_account_hash_id" size="70" />
																					</div>
																					<a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['hash_id_provided_by_textlocal'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
																					<label for="mytextlocal_account_hash_id" generated="true" class="error"></label>
																				</td>
																			</tr>
																			<tr>
																				<td id="hr"/>
																				<td id="hr"/>
																				<td id="hr"/>
																			</tr>
																		</tbody>
																		<tbody>
																			<th colspan="3"><?php echo $label_language_values['textlocal_sms_settings'];?></th>
																			<tr>
																				<td><label><?php echo $label_language_values['send_sms_to_client'];?></label></td>
																				<td colspan="2">
																					<div class="form-group">
																						<label class="ctoggle-ct-sms-reminder-client-status" for="ct-sms-reminder-client-status">
																							<input data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if($setting->get_option('ct_sms_textlocal_send_sms_to_client_status') == "Y"){echo "checked";}else{echo "";}?> id="ct-textlocal-sms-reminder-client-status" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
																						</label>
																					</div>
																					<a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['enable_or_disable_send_sms_to_client_for_appointment_booking_info'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
																				</td>
																			</tr>
																			<tr>
																				<td><label><?php echo $label_language_values['send_sms_to_admin'];?></label></td>
																				<td colspan="2">
																					<div class="form-group">
																						<label class="ctoggle-ct-sms-reminder-admin-status" for="ct-sms-reminder-admin-status">
																							<input data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if($setting->get_option('ct_sms_textlocal_send_sms_to_admin_status') == "Y"){echo "checked";}else{echo "";}?> id="ct-textlocal-sms-reminder-admin-status" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
																						</label>
																					</div>
																					<a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['enable_or_disable_send_sms_to_admin_for_appointment_booking_info'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
																				</td>
																			</tr>
																			<tr>
																				<td id="hr"/>
																				<td id="hr"/>
																				<td id="hr"/>
																			</tr>
																			<tr>
																				<td><label><?php echo $label_language_values['admin_phone_number'];?></label></td>
																				<td colspan="2">
																					<div class="form-group ct-lgf">
																						<div class="input-group">
																							<span class="input-group-addon"><span class="company_country_code_value_plivo"><?php echo $country_codes[0];?></span></span>
																							<input type="text" id="ct_sms_textlocal_admin_phone" class="form-control" value="<?php echo $setting->ct_sms_textlocal_admin_phone;?>" name="ct_sms_textlocal_admin_phone" size="70" />
																						</div>
																					</div>
																					<label for="ct_sms_textlocal_admin_phone" generated="true" class="error"></label>
																				</td>
																			</tr>
																			<tr>
																				<td id="hr"/>
																				<td id="hr"/>
																				<td id="hr"/>
																			</tr>
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
												</div>
												<a id="btnsave_sms_service" name="" class="btn btn-success mt-20 ml-10" ><?php echo $label_language_values['save_sms_settings'];?></a>
											</div><!-- panel body end -->
										</div>
											
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
				
				<div class="tab-pane fade in" id="sms-template">
					<div class="ct-sms-template-panel panel panel-default wf-100">
						<div class="panel-heading">
							<h1 class="panel-title"><?php echo $label_language_values['sms_template_settings'];?></h1>
						</div>
						<!-- Client email templates -->
						<ul class="nav nav-tabs nav-justified">
							<li class="active"><a data-toggle="tab" href="#client-sms-template"><?php echo $label_language_values['client_sms_templates'];?></a></li>
							<li><a data-toggle="tab" href="#admin-sms-template"><?php echo $label_language_values['admin_sms_template'];?></a></li>
							
						</ul>
						<div class="tab-content">
							<div id="client-sms-template" class="tab-pane fade in active">
								<h3><?php echo $label_language_values['client_sms_templates'];?></h3>
								<div id="accordion" class="panel-group">
									<ul class="nav nav-tab nav-stacked">
                                        <?php
                                            $readall_client_sms_template=$sms_template->readall_client_sms_template();
                                        while($client_template = @mysqli_fetch_array($readall_client_sms_template))
                                        {
                                            ?>
                                            <li class="panel panel-default ct-client-sms-panel" >
                                                <div class="panel-heading br-2">
                                                    <h4 class="panel-title">
                                                        <div class="cta-col11">
                                                            <div class="pull-left">
                                                                <div class="ct-yes-no-sms-right pull-left">
                                                                    <label for="sms-client<?php echo $client_template['id'];?>">
																		<input class="save_client_sms_template_status" data-toggle="toggle" data-size="small" type='checkbox' <?php if($client_template['sms_template_status']=='E'){echo "checked";} else { echo ""; } ?> data-id="<?php echo $client_template['id'];?>" id="sms-client<?php echo $client_template['id'];?>" data-on="<?php echo $label_language_values['o_n'];?>"  data-off="<?php echo $label_language_values['off'];?>" data-onstyle='primary' data-offstyle='default' />
																		
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <span class="ct-template-name"><?php echo $label_language_values[strtolower(str_replace(" ","_",$client_template['sms_subject']))]; ?></span>
                                                        </div>
                                                        <div class="pull-right cta-col1">
                                                            <div class="pull-right">
                                                                <div class="ct-show-hide pull-right">
                                                                    <input type="checkbox" name="ct-show-hide" 
																	class="ct-show-hide-checkbox ct_show_hide_checkbox" id="cm<?php echo $client_template['id'];?>" data-id="<?php echo $client_template['id']; ?>"><!--Added Serivce Id-->
                                                                    <label class="ct-show-hide-label" for="cm<?php echo $client_template['id'];?>"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </h4>
                                                </div>
                                                <div id="detail_sms_template_<?php echo $client_template['id'];?>" class="panel-collapse collapse sms_content detail_cm<?php echo $client_template['id'];?> sms_template_detail"  >
                                                    <div class="panel-body p-10">
                                                        <div class="ct-sms-temp-collapse-div col-md-12 col-lg-12 col-xs-12 np">
                                                            <form id="sms_template_form_<?php echo $client_template['id'];?>" method="post" type="" class="slide-toggle" >
                                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                                    <textarea class="form-control" name="sms_message" id="sms_message_<?php echo $client_template['id'];?>" cols="50" rows="20" placeholder="Add here your message for sms"><?php if($client_template['sms_message'] != ''){ echo base64_decode($client_template['sms_message']); }else{ echo base64_decode($client_template['default_message']); } ?></textarea>
																	
																	<a id="save_sms_template" name="" data-id="<?php echo $client_template['id'];?>" class="btn btn-success ct-btn-width pull-left cb ml-15 mt-20" type="submit"><?php echo $label_language_values['save_template'];?></a>
																	<a id="default_sms_contents" name="" data-id="<?php echo $client_template['id'];?>" class="btn btn-primary ct-btn-width cb ml-15 mt-20" type="submit"><?php echo $label_language_values['default_template'];?></a>
                                                                </div>
                                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                                    <div class="ct-sms-content-tags">
                                                                        <b><?php echo $label_language_values['tags'];?></b><br>
                                                                   <!--  <a href="javascript:void(0);" data-id="<?php /* echo $client_template['id']; */ ?>" class="tags sms_short_tags" data-value="{{booking_date}}">{{<?php /* echo $label_language_values['booking_date']; */ ?>}}</a><br /> -->
																	<a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{booking_date}}">{{<?php echo $label_language_values['booking_date'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{booking_time}}">{{<?php echo $label_language_values['booking_time'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{service_name}}">{{<?php echo $label_language_values['service_name'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{client_name}}">{{<?php echo $label_language_values['client_name'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{methodname}}">{{<?php echo $label_language_values['methodname'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{units}}">{{<?php echo $label_language_values['units'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{addons}}">{{<?php echo $label_language_values['addons'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{firstname}}">{{<?php echo $label_language_values['firstname'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{lastname}}">{{<?php echo $label_language_values['lastname'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{client_email}}">{{<?php echo $label_language_values['client_email'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{phone}}">{{<?php echo $label_language_values['client__phone'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{payment_method}}">{{<?php echo $label_language_values['payment_method'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{vaccum_cleaner_status}}">{{<?php echo $label_language_values['vaccum_cleaner_status'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{parking_status}}">{{<?php echo $label_language_values['parking_status'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{notes}}">{{<?php echo $label_language_values['notes'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{contact_status}}">{{<?php echo $label_language_values['contact_status'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{price}}">{{<?php echo $label_language_values['price'];?>}}</a><br />
																	
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{address}}">{{<?php echo $label_language_values['client__address'];?>}}</a><br />
																	
																	<a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{client_city}}">{{<?php echo $label_language_values['client__city'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{client_state}}">{{<?php echo $label_language_values['client__state'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{client_zip}}">{{<?php echo $label_language_values['client__zip'];?>}}</a><br />
																	
																	
																	
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{app_remain_time}}">{{<?php echo $label_language_values['app_remain_time'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{reject_status}}">{{<?php echo $label_language_values['reject_status'];?>}}</a><br />
																	
																	<a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{business_logo}}">{{<?php echo $label_language_values['business_logo'];?>}}</a><br />
                                                                    <?php /* <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{business_logo_alt}}">{{<?php echo $label_language_values['business_logo_alt'];?>}}</a><br /> */ ?>
                                                                    <a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{admin_name}}">{{<?php echo $label_language_values['admin_name'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_name}}">{{<?php echo $label_language_values['company__name'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_address}}">{{<?php echo $label_language_values['company__address'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_city}}">{{<?php echo $label_language_values['company__city'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_state}}">{{<?php echo $label_language_values['company__state'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_zip}}">{{<?php echo $label_language_values['company__zip'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_country}}">{{<?php echo $label_language_values['company__country'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_phone}}">{{<?php echo $label_language_values['company__phone'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $client_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_email}}">{{<?php echo $label_language_values['company__email'];?>}}</a><br />
                                                                    </div>
                                                                </div>
                                                                
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php
                                        }
                                        ?>
									</ul>
								</div>
							</div>
							<div id="admin-sms-template" class="tab-pane fade">
								<h3><?php echo $label_language_values['admin_sms_template'];?></h3>
								<div id="accordion" class="panel-group">
									<ul class="nav nav-tab nav-stacked">
                                            <?php
                                            $readall_admin_sms_template=$sms_template->readall_admin_sms_template();
                                            while($admin_template = @mysqli_fetch_array($readall_admin_sms_template))
                                            {
                                                ?>
                                                <li class="panel panel-default ct-admin-sms-temp-panel" >
                                                    <div class="panel-heading br-2">
                                                        <h4 class="panel-title">
                                                            <div class="cta-col11">
                                                                <div class="pull-left">
                                                                    <div class="ct-yes-no-sms-right pull-left">
                                                                        <label for="sms-admin<?php echo $admin_template['id'];?>">
																			<input class='save_admin_sms_template_status' data-toggle="toggle" data-size="small" type='checkbox' data-id="<?php echo $admin_template['id'];?>" type="checkbox" name="" <?php if($admin_template['sms_template_status']=='E'){echo "checked";}else{echo "";}?> id="sms-admin<?php echo $admin_template['id'];?>" data-on="<?php echo $label_language_values['o_n'];?>"  data-off="<?php echo $label_language_values['off'];?>" data-onstyle='primary' data-offstyle='default' />
																			
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <span class="ct-template-name"><?php echo $label_language_values[strtolower(str_replace(" ","_",$admin_template['sms_subject']))]; ?></span>
                                                            </div>
                                                            <div class="pull-right cta-col1">
                                                                <div class="pull-right">
                                                                    <div class="ct-show-hide pull-right">
                                                                        <input type="checkbox" name="ct-show-hide" class="ct-show-hide-checkbox ct_show_hide_checkbox" id="as<?php echo $admin_template['id'];?>" data-id="<?php echo $admin_template['id']; ?>">
                                                                        <label class="ct-show-hide-label" for="as<?php echo $admin_template['id'];?>"></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </h4>
                                                    </div>
                                                    <div id="detail_sms_template_<?php echo $admin_template['id'];?>" class="panel-collapse collapse sms_content detail_as<?php echo $admin_template['id'];?> sms_template_detail_admin">
                                                        <div class="panel-body p-10">
                                                            <div class="ct-sms-temp-collapse-div col-md-12 col-lg-12 col-xs-12 np">
                                                                <form id="sms_template_form_<?php echo $admin_template['id'];?>" method="post" type="" class="slide-toggle" >
                                                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                                                        <textarea class="form-control" name="sms_message" id="sms_message_<?php echo $admin_template['id'];?>" cols="50" rows="20" placeholder="Add here your message"><?php if($admin_template['sms_message'] != ''){ echo base64_decode($admin_template['sms_message']); }else{ echo base64_decode($admin_template['default_message']); } ?></textarea>
																		<a id="save_sms_template" name="" data-id="<?php echo $admin_template['id'];?>" class="btn btn-success ct-btn-width pull-left cb ml-15 mt-20" type="submit"><?php echo $label_language_values['save_template'];?></a>
																		<a id="default_sms_contents" name="" data-id="<?php echo $admin_template['id'];?>" class="btn btn-primary ct-btn-width pull-left cb ml-15 mt-20" type="submit"><?php echo $label_language_values['default_template'];?></a>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                                                        <div class="ct-sms-content-tags">
                                                                            <b><?php echo $label_language_values['tags'];?></b><br>
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{booking_date}}">{{<?php echo $label_language_values['booking_date'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{booking_date}}">{{<?php echo $label_language_values['booking_date'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{booking_time}}">{{<?php echo $label_language_values['booking_time'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{service_name}}">{{<?php echo $label_language_values['service_name'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{client_name}}">{{<?php echo $label_language_values['client_name'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{methodname}}">{{<?php echo $label_language_values['methodname'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{units}}">{{<?php echo $label_language_values['units'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{addons}}">{{<?php echo $label_language_values['addons'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{firstname}}">{{<?php echo $label_language_values['firstname'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{lastname}}">{{<?php echo $label_language_values['lastname'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{client_email}}">{{<?php echo $label_language_values['client_email'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{phone}}">{{<?php echo $label_language_values['client__phone'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{payment_method}}">{{<?php echo $label_language_values['payment_method'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{vaccum_cleaner_status}}">{{<?php echo $label_language_values['vaccum_cleaner_status'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{parking_status}}">{{<?php echo $label_language_values['parking_status'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{notes}}">{{<?php echo $label_language_values['notes'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{contact_status}}">{{<?php echo $label_language_values['contact_status'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{price}}">{{<?php echo $label_language_values['price'];?>}}</a><br />
																	
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{address}}">{{<?php echo $label_language_values['client__address'];?>}}</a><br />
																	
																	<a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{client_city}}">{{<?php echo $label_language_values['client__city'];?>}}</a><br />
																	
																	<a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{client_state}}">{{<?php echo $label_language_values['client__state'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{client_zip}}">{{<?php echo $label_language_values['client__zip'];?>}}</a><br />
																	
																	
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{app_remain_time}}">{{<?php echo $label_language_values['app_remain_time'];?>}}</a><br />
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{reject_status}}">{{<?php echo $label_language_values['reject_status'];?>}}</a><br />
																	
																	<a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{business_logo}}">{{<?php echo $label_language_values['business_logo'];?>}}</a><br />
                                                                    <?php /* <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{business_logo_alt}}">{{<?php echo $label_language_values['business_logo_alt'];?>}}</a><br /> */ ?>
                                                                    <a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{admin_name}}">{{<?php echo $label_language_values['admin_name'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_name}}">{{<?php echo $label_language_values['company__name'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_address}}">{{<?php echo $label_language_values['company__address'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_city}}">{{<?php echo $label_language_values['company__city'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_state}}">{{<?php echo $label_language_values['company__state'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_zip}}">{{<?php echo $label_language_values['company__zip'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_country}}">{{<?php echo $label_language_values['company__country'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_phone}}">{{<?php echo $label_language_values['company__phone'];?>}}</a><br />
																	<a href="javascript:void(0);" data-id="<?php echo $admin_template['id']; ?>" class="tags sms_short_tags" data-value="{{company_email}}">{{<?php echo $label_language_values['company__email'];?>}}</a><br />
                                                                        </div>
                                                                    </div>
                                                                   
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php
                                            }
                                            ?>

									</ul>

								</div>
							</div>
							
						</div>
					</div>
				</div>
			
			<!-- Frequantly Discount Start -->
            <div class="tab-pane fade in" id="frequently-discount">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 class="panel-title"><?php echo $label_language_values['frequently_discount_header'];?></h1>

                    </div>
                    <div class="panel-body pt-50 plr-10">

                        <div class="col-sm-12 col-lg-12 col-xs-12">
                            <div class="tab-content ct-settings-frequently-discount-details">
                                <div class="tab-pane active col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div id="accordion" class="panel-group">
                                        <ul class="nav nav-tab nav-stacked" id="sortable-frequently-discount" > 	<!-- frequently-discount-services -->
                                            <?php
                                            $getalldis = $objfrequently->readall();
                                            while($getdata = @mysqli_fetch_array($getalldis)){
                                                ?>
                                                <li class="panel panel-default ct-frequently-discount-panel" >
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <div class="cta-col8">
                                                                <span class="ct-frequently-discount-panel-title-name"><?php echo $label_language_values[strtolower(str_replace("-","_",$getdata['discount_typename']))];?></span>
                                                            </div>
                                                            <div class="pull-right cta-col4">
                                                                <div class="cta-col4">
                                                                    <label class="ctoggle-frequently-discount" for="sevice-endis-<?php echo $getdata['id'];?>">
																		<input class="myfrequentlydiscount_status" data-toggle="toggle" data-size="small" type='checkbox' data-id="<?php echo $getdata['id'];?>" <?php if($getdata['status']=='E'){ echo "checked";}else{ echo ""; }?> id="sevice-endis-<?php echo $getdata['id'];?>" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
																	
                                                                    </label>
                                                                </div>
                                                                <div class="pull-right">

                                                                    <div class="ct-show-hide pull-right">
                                                                        <input type="checkbox" name="ct-show-hide" class="ct-show-hide-checkbox" id="spss<?php echo $getdata['id'];?>" ><!--Added Serivce Id-->
                                                                        <label class="ct-show-hide-label" for="spss<?php echo $getdata['id'];?>"></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </h4>
                                                    </div>
                                                    <div id="detailspss<?php echo $getdata['id'];?>" class="frequently-discount_detail panel-collapse collapse fdd_details">
                                                        <div class="panel-body p-10">
                                                            <div class="ct-frequently-discount-collapse-div col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                                                <form id="freq_discount_form<?php echo $getdata['id'];?>" method="post" type="" class="slide-toggle" >
                                                                    <table class="form-inline ct-common-table ct-create-frequently-discount-table">
                                                                        <tbody>

                                                                        <tr>
                                                                            <td><?php echo $label_language_values['frequently_discount_label'];?></td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text" class="form-control txtfreqlabel<?php echo $getdata['id'];?>" id="txtfreqlabel<?php echo $getdata['id'];?>" name="txtfreqlabelname<?php echo $getdata['id'];?>" value="<?php echo $getdata['labels'];?>" placeholder="<?php echo $label_language_values['save_12_5'];?>" /><br />
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><?php echo $label_language_values['frequently_discount_type'];?></td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <select name="" id="txtfreqtype<?php echo $getdata['id'];?>" class="selectpicker " data-size="3"  style="display: none;">
                                                                                        <option value="P" <?php if($getdata['d_type'] == 'P'){ echo "selected" ; }?>><?php echo $label_language_values['percentage'];?></option>
                                                                                        <option value="F" <?php if($getdata['d_type'] == 'F'){ echo "selected" ; }?>><?php echo $label_language_values['flat'];?></option>
                                                                                    </select>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><?php echo $label_language_values['frequently_discount_value'];?></td>
                                                                            <td>
                                                                                <div class="form-group">
                                                                                    <input type="text" class="form-control txtfreqvalue<?php echo $getdata['id'];?>" name="txtfreqvaluename<?php echo $getdata['id'];?>" id="txtfreqvalueid<?php echo $getdata['id'];?>" value="<?php echo $getdata['rates'];?>" placeholder="<?php echo $label_language_values['value'];?>" /><br />
                                                                                </div>
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
																			<td></td>
                                                                            <td><a data-id="<?php echo $getdata['id'];?>" name="" id="" class="btn btn-success ct-btn-width btnupdatefrequently_discount" ><?php echo $label_language_values['update'];?></a></td>
                                                                        </tr>

                                                                        </tbody>
                                                                    </table>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Frequantly Discount End -->
            <div class="tab-pane fade in" id="promocode">
               <!-- <form id="form_promo_code" method="post" type="" class="ct-promocode" >-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h1 class="panel-title"><?php echo $label_language_values['promocode_header'];?></h1>
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="promocode-list-li active"><a data-toggle="tab" href="#promocode-list"><?php echo $label_language_values['promocodes'];?></a></li>
                            <li class="add_promocode"><a data-toggle="tab" href="#add-new-promocode"><?php echo $label_language_values['add_new'];?></a></li>
                            <li id="update-promocode" class="ct-update-promocode-li hide-div"><a data-toggle="tab" class="ct-update-promocode" href="#"><?php echo $label_language_values['update_promocode'];?></a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="promocode-list" class="tab-pane fade in active edit_form_for_coupon">
                                <h3><?php echo $label_language_values['promocodes_list'];?></h3>
                                <div class="table-responsive">
                                    <table id="ct-promocode-list" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th><?php echo $label_language_values['coupon'];?> #</th>
                                            <th><?php echo $label_language_values['coupon_code'];?></th>
                                            <th><?php echo $label_language_values['coupon_type'];?></th>
                                            <th><?php echo $label_language_values['coupon_limit'];?></th>
                                            <th><?php echo $label_language_values['coupon_used'];?></th>
                                            <th><?php echo $label_language_values['coupon_value'];?></th>
                                            <th><?php echo $label_language_values['expiry_date'];?></th>
                                            <th><?php echo $label_language_values['actions'];?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $allpromocode = $promo->readall();
                                        $cp = 1;
                                        while($row = @mysqli_fetch_array($allpromocode)) {
                                            if($row['coupon_type']=='P')
                                            {
                                                $coupon_type="Percentage";
                                            } else {
                                                $coupon_type="Flat";
                                            }
                                            ?>
                                            <tr id="coupondata_row<?php echo $row['id']; ?>">
                                                <td><?php echo $cp; ?></td>
                                                <td><?php echo $row['coupon_code']; ?></td>
                                                <td><?php echo $coupon_type; ?></td>
                                                <td><?php echo $row['coupon_limit']; ?></td>
                                                <td><?php echo $row['coupon_used']; ?></td>
                                                <td><?php echo $row['coupon_value']; ?></td>
                                                <td><?php echo str_replace($english_date_array,$selected_lang_label,date($getdateformat,strtotime($row['coupon_expiry']))); ?></td>
                                                <td>
                                                    <a href="#update-promocode-form<?php echo $row['id']; ?>"
                                                       data-id="<?php echo $row['id']; ?>"
                                                       data-toggle="tab"
                                                       class="btn-circle btn-info btn-xs ct-edit-coupon"
                                                       title="<?php echo $label_language_values['edit_coupon_code'];?>">
                                                        <i class="fa fa-pencil-square-o"></i>
                                                    </a>

                                                    <a id="ct-delete-promocode"
                                                       data-toggle="popover"
                                                       class="pull-right btn-circle btn-danger btn-xs delete-promocode"
                                                       data-id="<?php echo $row['id']; ?>"
                                                       rel="popover"
                                                       data-placement="left"
                                                       title="<?php echo $label_language_values['delete_promocode'];?>">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                    <div id="popover-delete-promocode<?php echo $row['id']; ?>" style="display: none;">
                                                        <div class="arrow"></div>
                                                        <table class="form-horizontal" cellspacing="0">
                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    <a id="promodata_delete" data-id="<?php echo $row['id'];?>" value="Delete" class="btn btn-danger mybtndeletepromocode" ><?php echo $label_language_values['yes'];?></a>
                                                                    <a id="ct-close-popover-delete-promocode" class="btn btn-default" ><?php echo $label_language_values['cancel'];?></a>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                            $cp++; }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="add-new-promocode" class="tab-pane fade">
                                <h3><?php echo $label_language_values['add_new_promocode'];?></h3>
                               <!-- <form id="" method="post" type="" class="ct-promocode" >-->
							    <form id="form_promo_code" method="post" type="" class="ct-promocode" >
                                    <div class="table-responsive">
                                        <table class="form-inline ct-common-table">
                                            <tbody>
                                            <tr>
                                                <td><?php echo $label_language_values['coupon_code'];?></td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="coupon_code" name="coupon_code" value="" placeholder="<?php echo $label_language_values['coupon_code'];?>" /><br />
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $label_language_values['coupon_type'];?></td>
                                                <td>
                                                    <div class="form-group">
                                                        <select name="coupon_type" id="coupon_type" class="selectpicker" data-size="3"  style="display: none;">
                                                            <option value="P"><?php echo $label_language_values['percentage'];?></option>
                                                            <option value="F"><?php echo $label_language_values['flat'];?></option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $label_language_values['value'];?></td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="coupon_value" id="coupon_value" value="" placeholder="<?php echo $label_language_values['value'];?>" />
														<a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['coupon_value_would_be_consider_as_percentage_in_percentage_mode_and_in_flat_mode_it_will_be_consider_as_amount_no_need_to_add_percentage_sign_it_will_auto_added'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                                    </div>
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $label_language_values['limit'];?></td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="coupon_limit" id="coupon_limit" value="" placeholder="<?php echo $label_language_values['coupon_limit'];?>" />
														<a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['coupon_code_will_work_for_such_limit'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                                    </div>
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?php echo $label_language_values['expiry_date'];?></td>
                                                <td>
                                                    <div class="form-group input-group">
                                                        <input class="form-control exp_cp_date" name="coupon_expiry_date" id="expiry_date" data-date-format="yyyy/mm/dd" data-provide="datepicker"  readonly="readonly" />
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
										
                                                    </div>
													<label for="expiry_date" style="display:none" generated="true" class="error"></label>
													<a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['coupon_code_will_work_for_such_date'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                                    
                                                </td>
                                            </tr>

                                           
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <a id="promo_code" name="promo_code" class="btn btn-success mt-20" ><?php echo $label_language_values['create'];?></a>
                                                </td>
                                            </tr>
                                            
                                            </tbody>

                                        </table>
                                    </div>
                                </form>
                            </div>
                            <?php
                            $readcp=$promo->readall();
                            while($rowcp = @mysqli_fetch_array($readcp)){
                                ?>
                                <div id="update-promocode-form<?php echo $rowcp['id'];?>" class="tab-pane fade update-promocode-new">
                                    <h3><?php echo $label_language_values['update_promocode'];?></h3>
                                    <form id="update_promo_formss<?php echo $rowcp['id'];?>" method="post" type="" class="" >
                                        <div class="table-responsive">
                                            <table class="form-inline ct-common-table">
                                                <tbody>
                                                <tr>
                                                    <td><?php echo $label_language_values['coupon_code'];?></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="hidden" class="form-control" id="recordid" value="<?php echo $rowcp['coupon_code']; ?>">
                                                            <input type="text" class="form-control" id="edit_coupon_code<?php echo $rowcp['id'];?>" name="coupon_code<?php echo $rowcp['id'];?>" value="<?php echo $rowcp[1]; ?>" placeholder="<?php echo $label_language_values['coupon_code'];?>" /><br />
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo $label_language_values['coupon_type'];?></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select name="coupon_type" id="edit_coupon_type<?php echo $rowcp['id'];?>" class="selectpicker" data-size="3"  style="display: none;">
                                                                <option value="P" <?php if($rowcp['coupon_type']=='P') {echo "selected";} ?>><?php echo $label_language_values['percentage'];?></option>
                                                                <option value="F"<?php if($rowcp['coupon_type']=='F') {echo "selected";} ?>><?php echo $label_language_values['flat'];?></option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td><?php echo $label_language_values['value'];?></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="edit_value<?php echo $rowcp['id'];?>" name="valuessd<?php echo $rowcp['id'];?>" value="<?php echo $rowcp['coupon_value']; ?>" placeholder="<?php echo $label_language_values['value'];?>" /><br />
                                                        </div>
                                                        <a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['coupon_value_would_be_consider_as_percentage_in_percentage_mode_and_in_flat_mode_it_will_be_consider_as_amount_no_need_to_add_percentage_sign_it_will_auto_added'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo $label_language_values['limit'];?></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" id="edit_limit<?php echo $rowcp['id'];?>" class="form-control" name="limit<?php echo $rowcp['id'];?>" value="<?php echo $rowcp['coupon_limit']; ?>" placeholder="<?php echo $label_language_values['coupon_limit'];?>" /><br />
                                                        </div>
                                                        <a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['coupon_code_will_work_for_such_limit'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><?php echo $label_language_values['expiry_date'];?></td>
                                                    <td>
                                                        <div class="form-group input-group">
                                                            <input class="form-control exp_cp_date" id="edit_expiry_date<?php echo $rowcp['id'];?>" value="<?php echo $rowcp['coupon_expiry']; ?>" data-date-format="yyyy/mm/dd"
                                                                   data-provide="datepicker" readonly="readonly" />
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                        </div>
                                                        <a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['coupon_code_will_work_for_such_date'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <a data-id="<?php echo $rowcp['id'];?>" id="edit_form_data" name="edit_form" class="btn btn-success mybtnupdatepromocode" type="submit"><?php echo $label_language_values['update'];?></a>
                                                    </td>
                                                </tr>
                                                </tbody>

                                            </table>
                                        </div>
                                    </form>

                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                <!--</form>-->
            </div>
            <!-- LABELS -->
            <div class="tab-pane fade in" id="labels">
                <!--<form id="ct-labels-settings" method="post" type="" class="ct-labels-settings" >-->
                    <div class="panel panel-default">
                       <div class="panel-heading cta-top-right">
                            <h1 class="panel-title"><?php echo $label_language_values['labels_settings'];?></h1>
                        </div>
                        <div class="panel-body pt-50 plr-10">
                            <table class="form-inline ct-common-table" >
                                <tbody>

                                <tr>
                                    <td><label><?php echo $label_language_values['select_language_to_change_label'];?></label></td>
                                    <td>
                                        <div class="form-group">
                                            <select name="ct_update_labels" id="update_labels" class="selectpicker" data-size="10" data-live-search="true" data-live-search-placeholder="<?php echo $label_language_values['search'];?>" style="display: none;">
                                                <option value="none"><?php echo $label_language_values['select_language_for_update'];?></option>
                                                <option value="en">English (United States)</option>
												<option value="ary" lang="ar">العربية المغربية</option>
												<option value="ar" lang="ar">العربية</option>
                                                <option value="az">Azərbaycan dili</option>
												<option value="azb" lang="az">گؤنئی آذربایجان</option>
                                                <option value="bg_BG">Български</option>
                                                <option value="bn_BD">বাংলা</option>
                                                <option value="bs_BA">Bosanski</option>
                                                <option value="ca">Català</option>
                                                <option value="ceb">Cebuano</option>
                                                <option value="cs_CZ">Čeština‎</option>
                                                <option value="cy">Cymraeg</option>
                                                <option value="da_DK">Dansk</option>
                                                <option value="de_CH_informal">Deutsch (Schweiz, Du)</option>
                                                <option value="de_DE_formal">Deutsch (Sie)</option>
                                                <option value="de_DE">Deutsch</option>
                                                <option value="de_CH">Deutsch (Schweiz)</option>
                                                <option value="el">Ελληνικά</option>
                                                <option value="en_CA">English (Canada)</option>
                                                <option value="en_GB">English (UK)</option>
                                                <option value="en_NZ">English (New Zealand)</option>
                                                <option value="en_ZA">English (South Africa)</option>
                                                <option value="en_AU">English (Australia)</option>
                                                <option value="eo">Esperanto</option>
                                                <option value="es_ES">Español</option>
                                                <option value="et">Eesti</option>
                                                <option value="eu">Euskara</option>
												<option value="fa_IR" lang="fa">فارسی</option>
                                                <option value="fi">Suomi</option>
                                                <option value="fr_FR">Français</option>
                                                <option value="gd">Gàidhlig</option>
                                                <option value="gl_ES">Galego</option>
                                                <option value="gu">ગુજરાતી</option>
												<option value="haz" lang="haz">هزاره گی</option>
                                                <option value="hi_IN">हिन्दी</option>
                                                <option value="hr">Hrvatski</option>
                                                <option value="hu_HU">Magyar</option>
                                                <option value="hy">Հայերեն</option>
                                                <option value="id_ID">Bahasa Indonesia</option>
                                                <option value="is_IS">Íslenska</option>
                                                <option value="it_IT">Italiano</option>
                                                <option value="ja">日本語</option>
                                                <option value="ka_GE">ქართული</option>
                                                <option value="ko_KR">한국어</option>
                                                <option value="lt_LT">Lietuvių kalba</option>
                                                <option value="lv">Latviešu valoda</option>
                                                <option value="mk_MK">Македонски јазик</option>
                                                <option value="mr">मराठी</option>
                                                <option value="ms_MY">Bahasa Melayu</option>
                                                <option value="my_MM">ဗမာစာ</option>
                                                <option value="nb_NO">Norsk bokmål</option>
                                                <option value="nl_NL">Nederlands</option>
                                                <option value="nl_NL_formal">Nederlands (Formeel)</option>
                                                <option value="nn_NO">Norsk nynorsk</option>
                                                <option value="oci">Occitan</option>
                                                <option value="pl_PL">Polski</option>
                                                <option value="pt_PT">Português</option>
                                                <option value="pt_BR">Português do Brasil</option>
                                                <option value="ro_RO">Română</option>
                                                <option value="ru_RU">Русский</option>
                                                <option value="sk_SK">Slovenčina</option>
                                                <option value="sl_SI">Slovenščina</option>
                                                <option value="sq">Shqip</option>
                                                <option value="sr_RS" >Српски језик</option>
                                                <option value="sv_SE">Svenska</option>
                                                <option value="szl">Ślōnskŏ gŏdka</option>
                                                <option value="th">ไทย</option>
                                                <option value="tl">Tagalog</option>
                                                <option value="tr_TR">Türkçe</option>
                                                <option value="ug_CN">Uyƣurqə</option>
                                                <option value="uk">Українська</option>
                                                <option value="vi">Tiếng Việt</option>
                                                <option value="zh_TW">繁體中文</option>
                                                <option value="zh_HK">香港中文版</option>
                                                <option value="zh_CN">简体中文</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <?php /* <table class="form-inline ct-common-table show_all_labels" >
                                <ul class="nav nav-tab nav-stacked ct-labels-lang-ul pl-15 pr-15 myall_lang_label">
									
								</ul>	
                            </table> */ ?>
                            <div class="myall_lang_label">
                            </div>
                            <table class="form-inline ct-common-table" >
                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                <!--</form>-->
            </div>
            <!-- LABELS -->
			 <!-- Front Tool Tips Start -->

            <div class="tab-pane fade in" id="front_tooltips">
                <form id="ct-fronttooltips-settings" method="post" type="" class="ct-labels-settings" >
                    <div class="panel panel-default">
                        <div class="panel-heading cta-top-right">
                            <h1 class="panel-title"><?php echo $label_language_values['front_tool_tips'];?></h1>
                            <span class="pull-right cta-setting-fix-btn"> <a class="btn btn-success front_tooltips_setting" type="submit"><?php echo $label_language_values['save_setting'];?></a></span>
                        </div>
                        <div class="panel-body pt-50 plr-10">
                           
                           <div class="panel panel-default ct-payment-methods">
								<div class="panel-heading">
									<h4 class="panel-title">
										<span><?php echo $label_language_values['front_tool_tips_lower'];?></span>
										<div class="ct-enable-disable-right pull-right">
											<label class="ctoggle-twocheckout-payment-checkout" for="front-tooltips">
												<input class="cta-toggle-checkbox" data-toggle="toggle" data-size="small" type='checkbox' <?php if($setting->ct_front_tool_tips_status=='on'){echo 'checked';} ?> name="" id="front-tooltips" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
											
											</label>
										</div>
									</h4>
								</div>
								<div id="collapseOne" <?php if($setting->ct_front_tool_tips_status=='on'){echo 'style="display:block"';} ?> class="panel-collapse collapse mycollapse_front-tooltips">
									<div class="panel-body p-10">
										<table class="form-inline ct-common-table">
											<tbody>
											<tr>
												<td><label><?php echo $label_language_values['tool_tip_my_bookings'];?></label></td>
												<td>
													<div class="form-group">
														<input type="text" class="form-control" id="ct_front_tool_tips_my_bookings" value="<?php echo $setting->ct_front_tool_tips_my_bookings; ?>" name="ct_front_tool_tips_my_bookings" size="50" />
													</div>
												</td>
											</tr>
											<tr>
												<td><label><?php echo $label_language_values['tool_tip_postal_code'];?></label></td>
												<td>
													<div class="form-group">
														<input type="text" class="form-control" id="ct_front_tool_tips_postal_code" value="<?php echo $setting->ct_front_tool_tips_postal_code; ?>" name="ct_front_tool_tips_postal_code" size="50" />
													</div>
												</td>
											</tr>
											<tr>
												<td><label><?php echo $label_language_values['tool_tip_services'];?></label></td>
												<td>
													<div class="form-group">
														<input type="text" class="form-control" id="ct_front_tool_tips_services" value="<?php echo $setting->ct_front_tool_tips_services; ?>" name="ct_front_tool_tips_services" size="50" />
													</div>
												</td>
											</tr>
											<tr>
												<td><label><?php echo $label_language_values['tool_tip_extra_service'];?></label></td>
												<td>
													<div class="form-group">
														<input type="text" class="form-control" id="ct_front_tool_tips_addons_services" value="<?php echo $setting->ct_front_tool_tips_addons_services; ?>" name="ct_front_tool_tips_addons_services" size="50" />
													</div>
												</td>
											</tr>
											<tr>
												<td><label><?php echo $label_language_values['tool_tip_frequently_discount'];?></label></td>
												<td>
													<div class="form-group">
														<input type="text" class="form-control" id="ct_front_tool_tips_frequently_discount" value="<?php echo $setting->ct_front_tool_tips_frequently_discount; ?>" name="ct_front_tool_tips_frequently_discount" size="50" />
													</div>
												</td>
											</tr>
											<tr>
												<td><label><?php echo $label_language_values['tool_tip_when_would_you_like_us_to_come'];?></label></td>
												<td>
													<div class="form-group">
														<input type="text" class="form-control" id="ct_front_tool_tips_time_slots" value="<?php echo $setting->ct_front_tool_tips_time_slots; ?>" name="ct_front_tool_tips_time_slots" size="50" />
													</div>
												</td>
											</tr>
											<tr>
												<td><label><?php echo $label_language_values['tool_tip_your_personal_details'];?></label></td>
												<td>
													<div class="form-group">
														<input type="text" class="form-control" id="ct_front_tool_tips_personal_details" value="<?php echo $setting->ct_front_tool_tips_personal_details; ?>" name="ct_front_tool_tips_personal_details" size="50" />
													</div>
												</td>
											</tr>
											<tr>
												<td><label><?php echo $label_language_values['tool_tip_have_a_promocode'];?></label></td>
												<td>
													<div class="form-group">
														<input type="text" class="form-control" id="ct_front_tool_tips_promocode" value="<?php echo $setting->ct_front_tool_tips_promocode; ?>" name="ct_front_tool_tips_promocode" size="50" />
													</div>
												</td>
											</tr>
											<tr>
												<td><label><?php echo $label_language_values['tool_tip_preferred_payment_method'];?></label></td>
												<td>
													<div class="form-group">
														<input type="text" class="form-control" id="ct_front_tool_payment_method" value="<?php echo $setting->ct_front_tool_payment_method; ?>" name="ct_front_tool_payment_method" size="50" />
													</div>
												</td>
											</tr>
											</tbody>
										</table>
									</div>
								</div>
                            </div>
                            <table class="form-inline ct-common-table" >
                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td>
                                        <a href="javascript:void(0);" name="" class="btn btn-success front_tooltips_setting" type="submit"><?php echo $label_language_values['save_setting'];?></a>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </form>
            </div>			
			<!-- Front Tool Tips END-->
			<!-- manageable form fields -->
			<div class="tab-pane fade in" id="manageable-form-fields">
                <form id="ct-manageable-form-field-settings" method="post" type="" class="ct-labels-settings" >
                    <div class="panel panel-default">
                        <div class="panel-heading cta-top-right">
                            <h1 class="panel-title"><?php echo $label_language_values['manageable_form_fields_front_booking_form'];?></h1>
                            <span class="pull-right cta-setting-fix-btn"> <a class="btn btn-success save_manage_form_fields" type="submit"><?php echo $label_language_values['save_setting'];?></a></span>
                        </div>
                        <div class="panel-body pt-50 plr-10">
							<div class="table-responsive">
								<table class="table table-hover table-bordered table-striped">
									<thead>
									<tr>
									  <th><strong><?php echo $label_language_values['field_name'];?></strong></th>
									  <th><strong><?php echo $label_language_values['enable_disable'];?></strong></th>
									  <th><strong><?php echo $label_language_values['required'];?></strong></th>
									  <th><strong><?php echo $label_language_values['min_length'];?></strong></th>
									  <th><strong><?php echo $label_language_values['max_length'];?></strong></th>
									</tr>
									</thead>
									<tbody>
										<tr>
											<td><label><?php echo $label_language_values['show_company_logo'];?></label></td>
											<td>
												<div class="form-group nm">
													<label class="ctoggle-postal-code"  for="show_company_logo_header">
														<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if($setting->get_option('ct_company_logo_display') == "Y") { echo "checked"; } ?>  id="show_company_logo" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
													</label>
												</div>
											</td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td><label>Show_company_title<?php //echo $label_language_values['Show_company_title'];?></label></td>
											<td>
												<div class="form-group nm">
													<label class="ctoggle-postal-code"  for="show_company_title_header">
														<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if($setting->get_option('ct_company_title_display') == "Y") { echo "checked"; } ?>  id="show_company_title" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
													</label>
												</div>
											</td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td><label><?php echo $label_language_values['show_company_address_in_header'];?></label></td>
											<td>
												<div class="form-group nm">
													<label class="ctoggle-postal-code"  for="Show_comapny_address_header">
														<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if($setting->get_option('ct_company_header_address') == "Y") { echo "checked"; } ?>  id="Show_comapny_address" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
													</label>
												</div>
											</td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td><?php echo $label_language_values['front_language_flags_list']; ?></td>
											<td>
												<div class="form-group nm">
													<label class="ctoggle-large"  for="front_lang_dd">
														<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if($setting->get_option('ct_front_language_selection_dropdown') == "Y") { echo "checked"; } ?>  id="front_lang_dd" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
													</label>
												</div>
											</td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td><label><?php echo $label_language_values['show_description'];?></label></td>
											<td>
												<div class="form-group nm">
													<label class="ctoggle-postal-code"  for="show_company_logo_header">
														<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if($setting->get_option('ct_company_service_desc_status') == "Y") { echo "checked"; } ?>  id="show_desc_front" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
													</label>
												</div>
											</td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td><label><?php echo $label_language_values['display_sub_headers_below_headers'];?></label></td>
											<td>
												<div class="form-group nm">
													<label class="ctoggle-ct_subheaders" for="ct_subheaders">
														<input data-toggle="toggle" data-size="small" type='checkbox' name="ct_subheaders" <?php if($setting->ct_subheaders=='Y'){echo 'checked';}?> id="ct_subheaders" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
													</label>
												</div>
											</td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td><label><?php echo $label_language_values['appointment_details_section'];?></label></td>
											<td>
												<div class="form-group">
													<label class="ctoggle-ct_subheaders" for="hide-appoint-details">
														<input data-toggle="toggle" data-size="small" name="appoint_details" type='checkbox' <?php if($setting->ct_appointment_details_display=='on'){echo 'checked';}?> id="hide_appoint_details" data-on="<?php echo $label_language_values['enable'];?>"  data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
													</label>
												</div>
												<?php /*
												<a class="ct-tooltip-link" href="#" data-toggle="tooltip" title="<?php echo $label_language_values['if_you_are_having_booking_system_which_need_the_booking_address_then_please_make_this_field_enable_or_else_it_will_not_able_to_take_the_booking_address_and_display_blank_address_in_the_booking'];?>"><i class="fa fa-info-circle fa-lg"></i></a>
												*/ ?>
											</td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td><?php echo $label_language_values['preferred_email'];?></td>
           <td><?php echo $label_language_values['enabled'];?></td>
           <td><?php echo $label_language_values['required'];?></td>
           <td></td>
           <td></td>
          </tr>
          <tr>
           <td><?php echo $label_language_values['preferred_password'];?></td>
           <td><?php echo $label_language_values['enabled'];?></td>
           <td><?php echo $label_language_values['required'];?></td>
											<td>
												<div class="input-group spinner">
													<div class="input-group-btn-horizontal">
														<button class="btn ct-subtraction-btn btn-default input-group-addon" data-info="pass_min" type="button"><i class="fa fa-minus nm"></i></button>
															<input type="text" class="form-control pass_min v_c" data-names="pass" name="pass_min" value="3">
														<button class="btn ct-addition-btn btn-default input-group-addon" data-info="pass_min" type="button"><i class="fa fa-plus nm"></i></button>
													</div>
												</div>
											</td>
											<td>
												<div class="input-group spinner">
													<div class="input-group-btn-horizontal">
														<button class="btn ct-subtraction-btn btn-default input-group-addon" data-info="pass_max" type="button"><i class="fa fa-minus nm"></i></button>
															<input type="text" class="form-control pass_max v_c_pass" value="8" name="pass_max">
														<button class="btn ct-addition-btn btn-default input-group-addon" data-info="pass_max" type="button"><i class="fa fa-plus nm"></i></button>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td><?php echo $label_language_values['first_name'];?><?php $check = explode(",",$setting->get_option('ct_bf_first_name')); ?></td>
											<td>
												<div class="form-group nm">
													<label class="ctoggle-large"  for="ct_bf_first_name_1">
														<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if( $check[0] == "on") { echo "checked"; } ?>  id="ct_bf_first_name_1" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
													</label>
												</div>
											</td>
											<td>
												<div class="form-group nm">
													<label class="ctoggle-large"  for="ct_bf_first_name_2">
														<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php  if( $check[1] == "Y") { echo "checked"; } ?>  id="ct_bf_first_name_2" data-on="<?php echo "True";?>" data-off="<?php echo "False";?>" data-onstyle='primary' data-offstyle='default' />
													</label>
												</div>
											</td>
											<td>
												<div class="input-group spinner">
													<div class="input-group-btn-horizontal">
														<button class="btn ct-subtraction-btn btn-default input-group-addon" data-info="fname_min" type="button"><i class="fa fa-minus nm"></i></button>
															<input type="text" class="form-control fname_min v_c" data-names="fname" name="fname_min" value="<?php echo $check[2]; ?>">
														<button class="btn ct-addition-btn btn-default input-group-addon" data-info="fname_min" type="button"><i class="fa fa-plus nm"></i></button>
													</div>
												</div>
											</td>
											<td>
												<div class="input-group spinner">
													<div class="input-group-btn-horizontal">
														<button class="btn ct-subtraction-btn btn-default input-group-addon" data-info="fname_max" type="button"><i class="fa fa-minus nm"></i></button>
															<input type="text" class="form-control fname_max v_c_fname" value="<?php echo $check[3]; ?>" name="fname_max">
														<button class="btn ct-addition-btn btn-default input-group-addon" data-info="fname_max" type="button"><i class="fa fa-plus nm"></i></button>
													</div>
												</div>
											</td>
										</tr>
										<tr>
										<td><?php echo $label_language_values['last_name']; ?><?php $check = explode(",",$setting->get_option('ct_bf_last_name')); ?></td>
										<td>
											<div class="form-group nm">
												<label class="ctoggle-large"  for="cff_last_name_1">
													<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if( $check[0] == "on") { echo "checked"; } ?>  id="cff_last_name_1" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
												</label>
											</div>
										</td>
										<td>
											<div class="form-group nm">
												<label class="ctoggle-large"  for="cff_last_name_2">
													<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if( $check[1] == "Y") { echo "checked"; } ?>  id="cff_last_name_2" data-on="<?php echo "True";?>" data-off="<?php echo "False";?>" data-onstyle='primary' data-offstyle='default' />
												</label>
											</div>
										</td>
										<td>
											<div class="input-group spinner">
												<div class="input-group-btn-horizontal">
													<button class="btn ct-subtraction-btn btn-default input-group-addon" data-info="lname_min" type="button"><i class="fa fa-minus nm"></i></button>
														<input type="text" class="form-control lname_min v_c" data-names="lname" name="lname_min" value="<?php echo $check[2]; ?>">
													<button class="btn ct-addition-btn btn-default input-group-addon" data-info="lname_min" type="button"><i class="fa fa-plus nm"></i></button>
												</div>
											</div>
										</td>
										<td>
											<div class="input-group spinner">
												<div class="input-group-btn-horizontal">
													<button class="btn ct-subtraction-btn btn-default input-group-addon" data-info="lname_max" type="button"><i class="fa fa-minus nm"></i></button>
														<input type="text" class="form-control lname_max v_c_lname" value="<?php echo $check[3]; ?>" name="lname_max">
													<button class="btn ct-addition-btn btn-default input-group-addon" data-info="lname_max" type="button"><i class="fa fa-plus nm"></i></button>
												</div>
											</div>
										</td>
										</tr>

										<tr>
											<td><?php echo $label_language_values['phone'];?><?php $check = explode(",",$setting->get_option('ct_bf_phone')); ?></td>
											<td>
												<div class="form-group nm">
													<label class="ctoggle-large"  for="cff_phone_1">
														<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if( $check[0] == "on") { echo "checked"; } ?>   id="cff_phone_1" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
													</label>
												</div>
											</td>
											<td>
												<div class="form-group nm">
													<label class="ctoggle-large"  for="cff_phone_2">
														<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if( $check[1] == "Y") { echo "checked"; } ?>   id="cff_phone_2" data-on="<?php echo "True";?>" data-off="<?php echo "False";?>" data-onstyle='primary' data-offstyle='default' />
													</label>
												</div>
											</td>
											<td>
												<div class="input-group spinner">
													<div class="input-group-btn-horizontal">
														<button class="btn ct-subtraction-btn btn-default input-group-addon" data-info="phone_min" type="button"><i class="fa fa-minus nm"></i></button>
															<input type="text" class="form-control phone_min v_c" data-names="phone" name="phone_min" value="<?php echo $check[2];?>">
														<button class="btn ct-addition-btn btn-default input-group-addon" data-info="phone_min" type="button"><i class="fa fa-plus nm"></i></button>
													</div>
												</div>
											</td>
											<td>
												<div class="input-group spinner">
													<div class="input-group-btn-horizontal">
														<button class="btn ct-subtraction-btn btn-default input-group-addon" data-info="phone_max" type="button"><i class="fa fa-minus nm"></i></button>
															<input type="text" class="form-control phone_max v_c_phone" value="<?php echo $check[3]; ?>" name="phone_max">
														<button class="btn ct-addition-btn btn-default input-group-addon" data-info="phone_max" type="button"><i class="fa fa-plus nm"></i></button>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td><?php echo $label_language_values['street_address'];?><?php $check = explode(",",$setting->get_option('ct_bf_address'));?></td>
											<td>
												<div class="form-group nm">
													<label class="ctoggle-large"  for="cff_street_address_1">
														<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if( $check[0] == "on") { echo "checked"; } ?>   id="cff_street_address_1" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
													</label>
												</div>
											</td>
											<td>
												<div class="form-group nm">
													<label class="ctoggle-large"  for="cff_street_address_2">
														<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if( $check[1] == "Y") { echo "checked"; } ?>   id="cff_street_address_2" data-on="<?php echo "True";?>" data-off="<?php echo "False";?>" data-onstyle='primary' data-offstyle='default' />
													</label>
												</div>
											</td>
											<td>
												<div class="input-group spinner">
													<div class="input-group-btn-horizontal">
														<button class="btn ct-subtraction-btn btn-default input-group-addon" data-info="street_address_min" type="button"><i class="fa fa-minus nm"></i></button>
															<input type="text" class="form-control street_address_min" name="street_address_min v_c" data-names="street_address" value="<?php echo $check[2]; ?>">
														<button class="btn ct-addition-btn btn-default input-group-addon" data-info="street_address_min" type="button"><i class="fa fa-plus nm"></i></button>
													</div>
												</div>
											</td>
											<td>
												<div class="input-group spinner">
													<div class="input-group-btn-horizontal">
														<button class="btn ct-subtraction-btn btn-default input-group-addon" data-info="street_address_max" type="button"><i class="fa fa-minus nm"></i></button>
															<input type="text" class="form-control street_address_max v_c_street_address" value="<?php echo $check[3];?>" name="street_address_max">
														<button class="btn ct-addition-btn btn-default input-group-addon" data-info="street_address_max" type="button"><i class="fa fa-plus nm"></i></button>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td><?php echo $label_language_values['zip_code'];?><?php $check = explode(",",$setting->get_option('ct_bf_zip_code')); ?></td>
											<td>
												<div class="form-group nm">
													<label class="ctoggle-large"  for="cff_zip_code_1">
														<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if( $check[0] == "on") { echo "checked"; } ?>   id="cff_zip_code_1" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
													</label>
												</div>
											</td>
											<td>
												<div class="form-group nm">
													<label class="ctoggle-large"  for="cff_zip_code_2">
														<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if( $check[1] == "Y") { echo "checked"; } ?>   id="cff_zip_code_2" data-on="<?php echo "True";?>" data-off="<?php echo "False";?>" data-onstyle='primary' data-offstyle='default' />
													</label>
												</div>
											</td>
											<td>
												<div class="input-group spinner">
													<div class="input-group-btn-horizontal">
														<button class="btn ct-subtraction-btn btn-default input-group-addon" data-info="zip_code_min" type="button"><i class="fa fa-minus nm"></i></button>
															<input type="text" class="form-control zip_code_min" name="zip_code_min v_c" data-names="zip" value="<?php echo $check[2]; ?>">
														<button class="btn ct-addition-btn btn-default input-group-addon" data-info="zip_code_min" type="button"><i class="fa fa-plus nm"></i></button>
													</div>
												</div>
											</td>
											<td>
												<div class="input-group spinner">
													<div class="input-group-btn-horizontal">
														<button class="btn ct-subtraction-btn btn-default input-group-addon" data-info="zip_code_max" type="button"><i class="fa fa-minus nm"></i></button>
															<input type="text" class="form-control zip_code_max v_c_zip" value="<?php echo $check[3]; ?>" name="zip_code_max">
														<button class="btn ct-addition-btn btn-default input-group-addon" data-info="zip_code_max" type="button"><i class="fa fa-plus nm"></i></button>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td><?php echo $label_language_values['city'];?><?php $check = explode(",",$setting->get_option('ct_bf_city')); ?></td>
											<td>
												<div class="form-group nm">
													<label class="ctoggle-large"  for="cff_city_1">
														<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if( $check[0] == "on") { echo "checked"; } ?>   id="cff_city_1" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
													</label>
												</div>
											</td>
											<td>
												<div class="form-group nm">
													<label class="ctoggle-large"  for="cff_city_2">
														<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if( $check[1] == "Y") { echo "checked"; } ?>   id="cff_city_2" data-on="<?php echo "True";?>" data-off="<?php echo "False";?>" data-onstyle='primary' data-offstyle='default' />
													</label>
												</div>
											</td>
											<td>
												<div class="input-group spinner">
													<div class="input-group-btn-horizontal">
														<button class="btn ct-subtraction-btn btn-default input-group-addon" data-info="city_min" type="button"><i class="fa fa-minus nm"></i></button>
															<input type="text" class="form-control city_min v_c" data-names="city" name="city_min" value="<?php echo $check[2]; ?>">
														<button class="btn ct-addition-btn btn-default input-group-addon" data-info="city_min" type="button"><i class="fa fa-plus nm"></i></button>
													</div>
												</div>
											</td>
											<td>
												<div class="input-group spinner">
													<div class="input-group-btn-horizontal">
														<button class="btn ct-subtraction-btn btn-default input-group-addon" data-info="city_max" type="button"><i class="fa fa-minus nm"></i></button>
															<input type="text" class="form-control city_max v_c_city" value="<?php echo $check[3]; ?>" name="city_max">
														<button class="btn ct-addition-btn btn-default input-group-addon" data-info="city_max" type="button"><i class="fa fa-plus nm"></i></button>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td><?php echo $label_language_values['state'];?><?php $check = explode(",",$setting->get_option('ct_bf_state')); ?></td>
											<td>
												<div class="form-group nm">
													<label class="ctoggle-large"  for="cff_state_1">
														<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if( $check[0] == "on") { echo "checked"; } ?>   id="cff_state_1" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
													</label>
												</div>
											</td>
											<td>
												<div class="form-group nm">
													<label class="ctoggle-large"  for="cff_state_2">
														<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if( $check[1] == "Y") { echo "checked"; } ?>   id="cff_state_2" data-on="<?php echo "True";?>" data-off="<?php echo "False";?>" data-onstyle='primary' data-offstyle='default' />
													</label>
												</div>
											</td>
											<td>
												<div class="input-group spinner">
													<div class="input-group-btn-horizontal">
														<button class="btn ct-subtraction-btn btn-default input-group-addon" data-info="state_min" type="button"><i class="fa fa-minus nm"></i></button>
															<input type="text" class="form-control state_min v_c" data-names="state" name="state_min" value="<?php echo $check[2]; ?>">
														<button class="btn ct-addition-btn btn-default input-group-addon" data-info="state_min" type="button"><i class="fa fa-plus nm"></i></button>
													</div>
												</div>
											</td>
											<td>
												<div class="input-group spinner">
													<div class="input-group-btn-horizontal">
														<button class="btn ct-subtraction-btn btn-default input-group-addon" data-info="state_max" type="button"><i class="fa fa-minus nm"></i></button>
															<input type="text" class="form-control state_max v_c_state" value="<?php echo $check[3]; ?>" name="state_max">
														<button class="btn ct-addition-btn btn-default input-group-addon" data-info="state_max" type="button"><i class="fa fa-plus nm"></i></button>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td><?php echo $label_language_values['special_requests_notes'];?><?php $check = explode(",",$setting->get_option('ct_bf_notes')); ?></td>
											<td>
												<div class="form-group nm">
													<label class="ctoggle-large"  for="cff_notes_1">
														<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if( $check[0] == "on") { echo "checked"; } ?>   id="cff_notes_1" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
													</label>
												</div>
											</td>
											<td>
												<div class="form-group nm">
													<label class="ctoggle-large"  for="cff_notes_2">
														<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if( $check[1] == "Y") { echo "checked"; } ?>  id="cff_notes_2" data-on="<?php echo "True";?>" data-off="<?php echo "False";?>" data-onstyle='primary' data-offstyle='default' />
													</label>
												</div>
											</td>
											<td>
												<div class="input-group spinner">
													<div class="input-group-btn-horizontal">
														<button class="btn ct-subtraction-btn btn-default input-group-addon" data-info="notes_min" type="button"><i class="fa fa-minus nm"></i></button>
															<input type="text" class="form-control notes_min" name="notes_min v_c" data-names="notes" value="<?php echo $check[2]; ?>">
														<button class="btn ct-addition-btn btn-default input-group-addon" data-info="notes_min" type="button"><i class="fa fa-plus nm"></i></button>
													</div>
												</div>
											</td>
											<td>
												<div class="input-group spinner">
													<div class="input-group-btn-horizontal">
														<button class="btn ct-subtraction-btn btn-default input-group-addon" data-info="notes_max" type="button"><i class="fa fa-minus nm"></i></button>
															<input type="text" class="form-control notes_max v_c_notes" value="<?php echo $check[3]; ?>" name="notes_max">
														<button class="btn ct-addition-btn btn-default input-group-addon" data-info="notes_max" type="button"><i class="fa fa-plus nm"></i></button>
													</div>
												</div>
											</td>
										</tr>

										<tr>
											<td><?php echo $label_language_values['vaccume_cleaner'];?></td>
											<td>
												<div class="form-group nm">
													<label class="ctoggle-large"  for="ct_vc_status">
														<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if($setting->get_option('ct_vc_status') == "Y") { echo "checked"; } ?>  id="ct_vc_status" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
													</label>
												</div>
											</td>
											<td></td>
											<td></td>
											<td></td>
										</tr>

										<tr>
											<td>Do you have pets?<?php //echo $label_language_values['parking'];?></td>
											<td>
												<div class="form-group nm">
													<label class="ctoggle-large"  for="ct_p_status">
														<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if($setting->get_option('ct_p_status') == "Y") { echo "checked"; } ?>  id="ct_p_status" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
													</label>
												</div>
											</td>
											<td></td>
											<td></td>
											<td></td>
										</tr>

										<tr>
											<td><label><?php echo $label_language_values['show_how_will_we_get_in'];?></label></td>
											<td>
												<div class="form-group nm">
													<label class="ctoggle-postal-code"  for="show_company_logo_header">
														<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if($setting->get_option('ct_company_willwe_getin_status') == "Y") { echo "checked"; } ?>  id="show_how_willwe_getin_front" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
													</label>
												</div>
											</td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td><label><?php echo $label_language_values['show_coupons_input_on_checkout'];?></label></td>
											<td>
												<div class="form-group nm">
													<label  class="ctoggle-postal-code" for="show-coupons-input-oc">
														
														<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" name="" type='checkbox' <?php if($setting->ct_show_coupons_input_on_checkout=='on'){echo 'checked';}?> id="show-coupons-input-oc" data-on="<?php echo $label_language_values['enable'];?>"  data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
													</label>
												</div>
											</td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										
									</tbody>		
								</table>
							</div>	
							<table class="form-inline ct-common-table" >
                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td>
                                        <a href="javascript:void(0);" name="" class="btn btn-success save_manage_form_fields" type="submit"><?php echo $label_language_values['save_setting'];?></a>
                                    </td>
                                </tr>
                                </tfoot>
							</table>	
							<ul class="nav nav-tab nav-stacked ct-labels-error-ul pl-15 pr-15">
								<?php 
								$alllang = $setting->get_all_languages();
								while($all = mysqli_fetch_array($alllang))
								{
									$language_label_arr = $setting->get_all_labelsbyid($all[2]);
									if($language_label_arr[6] != ''){
										$label_decode_form_field = base64_decode($language_label_arr[6]);

										$label_decode_form_field_unserial = unserialize($label_decode_form_field);
										?>
										<li class="panel panel-default ct-labels-error-listing">							
											<div class="panel-heading">
												<h4 class="panel-title">
													<div class="cta-col8"><span><?php echo urldecode($language_names[$all[2]]);?></span></div>
													<div class="ct-show-hide pull-right">
														<input type="checkbox" name="ct-show-hide" class="ct-show-hide-checkbox" id="myid<?php echo $all['id'];?>" ><!--Added Serivce Id-->
														<label class="ct-show-hide-label" for="myid<?php echo $all['id'];?>"></label>
													</div>
												</h4>
											</div>
											<div id="details_myid<?php echo $all['id'];?>"  class="panel-collapse collapse mycollapse_ct-manageable-errors">
												<div class="panel-body p-10">
													<table class="form-inline ct-common-table">
														<tbody>
														<?php 
														foreach ($label_decode_form_field_unserial as $key => $value) {
															/*$final_value = str_replace('_', ' ', $key);*/
															?>
															<tr>
															<td><label class="englabel_<?php echo $key;?>"><?php echo $manage_form_errors_message[$key];?></label></td>
															<td>
																<div class="form-group">
																	<input type="text" size="50" value="<?php echo urldecode($value);?>"  data-id="<?php echo $key;?>" class="form-control langlabel_front_error_<?php echo $all['id'];?>" name="ctextralabelct<?php echo $key;?>"/>
																</div>
															</td>
															</tr>
														<?php } ?>
															<tr>
																<td></td>
																<td>
																	<a href="javascript:void(0);" name="" class="btn btn-success save_front_form_error_labels" data-id="<?php echo $all['id'];?>" type="submit"><?php echo $label_language_values['save_setting'];?></a>
																</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</li>
										<?php 
										/* UPDATE ALL CODE WITH NEW URLENCODE PATTERN */
										foreach($label_decode_extra_unserial as $key => $value){
											$label_decode_form_field_unserial[$key] = urldecode($value);
										}
									}
								}
								?>
							</ul>
						</div>
					</div>	
				</form>
			</div>	
			<div class="tab-pane fade in" id="recurrence-booking">
                <form id="ct-recurrence-settings" method="post" type="" class="ct-labels-settings" >
                    <div class="panel panel-default">
                        <div class="panel-heading cta-top-right">
                            <h1 class="panel-title"><?php echo $label_language_values['Recurrence_booking'];?></h1>
                            <span class="pull-right cta-setting-fix-btn"> <a class="btn btn-success save_recurrence_booking" type="submit"><?php echo $label_language_values['save_setting'];?></a></span>
                        </div>
                        <div class="panel-body pt-50 plr-10">
							<div class="table-responsive">
								<table class="form-inline ct-common-table">
									
									<tbody>
										<tr>
											<td><label><?php echo $label_language_values['Recurrence_booking'];?></label></td>
											<td>
												<div class="form-group">
													<label class="ctoggle-postal-code"  for="show_company_logo_header">
														<input class='cta-toggle-checkbox' data-toggle="toggle" data-size="small" type='checkbox' name="" <?php if($setting->get_option('ct_recurrence_booking_status') == "Y") { echo "checked"; } ?>  id="ct_recurrence_booking_status" data-on="<?php echo $label_language_values['enable'];?>" data-off="<?php echo $label_language_values['disable'];?>" data-onstyle='success' data-offstyle='danger' />
													</label>
												</div>
											</td>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<td></td>
											<td>
												<a id="save_recurrence_booking" name="" class="btn btn-success save_recurrence_booking" ><?php echo $label_language_values['save_setting'];?></a>
											</td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="tab-pane fade in" id="seo-ga">
                <form id="ct-seo-ga-settings" method="post" type="" class="ct-labels-settings" >
                    <div class="panel panel-default">
                        <div class="panel-heading cta-top-right">
                            <h1 class="panel-title"><?php echo $label_language_values['SEO_Settings'];?></h1>
                            <span class="pull-right cta-setting-fix-btn"> <a class="btn btn-success save_seo_ga" type="submit"><?php echo $label_language_values['save_setting'];?></a></span>
                        </div>
                        <div class="panel-body pt-50 plr-10">
							<div class="table-responsive">
								<table class="form-inline ct-common-table">
									<tbody>
										<tr>
											<td><?php echo $label_language_values['Google_Analytics_Code'];?></td>
											<td>
												<div class="form-group">
													<input type="text" size="50" class="form-control" id="ct_google_analytics_code" name="ct_google_analytics_code" value="<?php echo $setting->get_option('ct_google_analytics_code');?>" placeholder="e.g. XX-XXXXXXXXX-X" />
												</div>

											</td>
										</tr>
										<tr>
											<td><?php echo $label_language_values['Page_Meta_Tag'];?></td>
											<td>
												<div class="form-group">
													<input type="text" size="50" class="form-control" id="ct_page_meta_tag" name="ct_page_meta_tag" value="<?php echo $setting->get_option('ct_page_title');?>" placeholder="<?php echo $label_language_values['Page_Meta_Tag'];?>" />
												</div>

											</td>
										</tr>
										<tr>
											<td><?php echo $label_language_values['Meta_Description'];?></td>
											<td>
												<div class="form-group">
													<textarea cols="48" class="form-control" id="ct_seo_meta_description" name="ct_seo_meta_description" placeholder="<?php echo $label_language_values['Meta_Description'];?>"><?php echo $setting->get_option('ct_seo_meta_description');?></textarea>
												</div>

											</td>
										</tr>
										<tr>
											<td><?php echo $label_language_values['Page_Meta_Tag'];?></td>
											<td>
												<div class="form-group">
													<input type="text" size="50" class="form-control" id="ct_seo_og_title" name="ct_seo_og_title" value="<?php echo $setting->get_option('ct_seo_og_title');?>" placeholder="<?php echo $label_language_values['og_tag_title'];?>" />
												</div>

											</td>
										</tr>
										<tr>
											<td><?php echo $label_language_values['og_tag_type'];?></td>
											<td>
												<div class="form-group">
													<input type="text" size="50" class="form-control" id="ct_seo_og_type" name="ct_seo_og_type" value="<?php echo $setting->get_option('ct_seo_og_type');?>" placeholder="<?php echo $label_language_values['og_tag_type'];?>" />
												</div>

											</td>
										</tr>
										<tr>
											<td><?php echo $label_language_values['og_tag_url'];?></td>
											<td>
												<div class="form-group">
													<input type="text" size="50" class="form-control" id="ct_seo_og_url" name="ct_seo_og_url" value="<?php echo $setting->get_option('ct_seo_og_url');?>" placeholder="<?php echo $label_language_values['og_tag_url'];?>" />
												</div>

											</td>
										</tr>
										<tr>
											<td><label><?php echo $label_language_values['og_tag_image'];?></label></td>
											<td>
												<div class="form-group">
													<div class="fileinput fileinput-new" data-provides="fileinput">
														<span class="btn btn-default btn-file mt-15"><input type="file" id="ct_seo_og_image" name="ct_seo_og_image" /></span>
														<br>
														<span class="fileinput-filename"><?php echo $label_language_values['recommended_image_type_jpg_jpeg_png_gif'];?></span>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<td></td>
											<td>
												<a id="save_seo_ga" name="" class="btn btn-success save_seo_ga" ><?php echo $label_language_values['save_setting'];?></a>
											</td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</form>					
			</div>
			<?php 
			if($gc_hook->gc_purchase_status() == 'exist'){
				echo $gc_hook->gc_settings_menu_content_hook();
			}
			?>
        </div>
    </div>
</div>

<script>
	var settingObj = {'ajax_url':'<?php echo AJAX_URL;?>'};
    var ajax_url = '<?php echo AJAX_URL;?>';
    var ajaxObj = {'ajax_url':'<?php echo AJAX_URL;?>'};
    var servObj={'site_url':'<?php echo SITE_URL.'assets/images/business/';?>'};
    var imgObj={'img_url':'<?php echo SITE_URL.'assets/images/';?>'};
</script>
<?php 
if($gc_hook->gc_purchase_status() == 'exist'){
	echo $gc_hook->gc_settings_save_js_hook();
}
if($gc_hook->gc_purchase_status() == 'exist'){
	echo $gc_hook->gc_setting_configure_js_hook();
}
if($gc_hook->gc_purchase_status() == 'exist'){
	echo $gc_hook->gc_setting_disconnect_js_hook();
}
if($gc_hook->gc_purchase_status() == 'exist'){
	echo $gc_hook->gc_setting_verify_js_hook();
}
include(dirname(__FILE__).'/footer.php');
?>