<?php
$service_array = array("method" => array());
$_SESSION['ct_cart'] = $service_array;
$_SESSION['freq_dis_amount'] = '';
$_SESSION['ct_details'] = '';

include(dirname(__FILE__) . "/objects/class_services.php");
include(dirname(__FILE__) . "/objects/class_users.php");
include(dirname(__FILE__) . '/objects/class_frequently_discount.php');
include(dirname(__FILE__) . '/objects/class_service_methods_design.php');

/* NAME */
$objservice = new cleanto_services();
$objservice->conn = $conn;
$user = new cleanto_users();
$user->conn = $conn;
$settings = new cleanto_setting();
$settings->conn = $conn;
$frequently_discount = new cleanto_frequently_discount();
$frequently_discount->conn = $conn;
$objservice_method_design = new cleanto_service_methods_design();
$objservice_method_design->conn = $conn;
?>
	<script src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js" type="text/javascript"></script>
    <script src="<?php echo BASE_URL; ?>/assets/js/ct-manual-booking-jquery.js" type="text/javascript"></script>
	
	<script src="<?php echo BASE_URL; ?>/assets/js/tooltipster.bundle.min.js" type="text/javascript"></script>
	<?php
	$ct_cart_scrollable_position = 'relative !important';
	
    echo "<style>
	/* primary color */
		.cleanto{
			color: " . $settings->get_option('ct_text_color') . " !important;
		}
		.cleanto .ct-link.ct-mybookings{
			color:" . $settings->get_option('ct_text_color_on_bg') . " !important;
			background:" . $settings->get_option('ct_secondary_color') . " !important;
		}
		.cleanto .ct-link.ct-mybookings:hover{
			color:" . $settings->get_option('ct_text_color_on_bg') . " !important;
			background:" . $settings->get_option('ct_primary_color') . " !important;
		}
		.cleanto .ct-main-left .ct-list-header .ct-logged-in-user a.ct-link,
		.cleanto .ct-complete-booking-main .ct-link,
		.cleanto .ct-discount-coupons a.ct-apply-coupon.ct-link{
			color: " . $settings->get_option('ct_primary_color') . " !important;
		}
		.cleanto .ct-link:hover,
		.cleanto .ct-main-left .ct-list-header .ct-logged-in-user a.ct-link:hover,
		.cleanto .ct-complete-booking-main .ct-link:hover,
		.cleanto .ct-discount-coupons a.ct-apply-coupon.ct-link:hover{
			color: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		.cleanto a,
		.cleanto .ct-link,
		.cleanto .ct-addon-count .ct-btn-group .ct-btn-text{
			color: " . $settings->get_option('ct_text_color') . " !important;
		}
		.cleanto a.ct-back-to-top i.icon-arrow-up,
		.cleanto .calendar-wrapper .calendar-header a.next-date:hover .icon-arrow-right:before,
		.cleanto .calendar-wrapper .calendar-header a.previous-date:hover .icon-arrow-left:before{
			color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
		}
		.cleanto .calendar-body .ct-week:hover a span,
		.cleanto .ct-extra-services-list ul.addon-service-list li .ct-addon-ser:hover .addon-price{
			color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
		}
		.cleanto #ct-type-2 .service-selection-main .ct-services-dropdown .ct-service-list:hover,
		.cleanto #ct-type-method .ct-services-method-dropdown .ct-service-method-list:hover,
		.cleanto .common-selection-main .common-data-dropdown .data-list:hover{
			color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
			background:" . $settings->get_option('ct_primary_color') . " !important;
		}
		.cleanto .selected-is:hover,
		.cleanto #ct-type-2 .service-is:hover,
		.cleanto #ct-type-method .service-method-is:hover{
			border-color:" . $settings->get_option('ct_primary_color') . " !important;
		}
		.cleanto .ct-extra-services-list ul.addon-service-list li .ct-addon-ser:hover span:before{
			border-top-color:" . $settings->get_option('ct_primary_color') . " !important;
		}
		
		.cleanto .calendar-wrapper .calendar-header a.next-date:hover,
		.cleanto .calendar-wrapper .calendar-header a.previous-date:hover,
		.cleanto .calendar-body .ct-week:hover{
			background:" . $settings->get_option('ct_secondary_color') . " !important;
		}
		.cleanto .calendar-body .ct-show-time .time-slot-container ul li.time-slot{
			background:" . $settings->get_option('ct_primary_color') . " !important;
		}
		.cleanto .calendar-body .dates .ct-week.by_default_today_selected.active_today span,
		.cleanto .calendar-body .ct-show-time .time-slot-container ul li.time-slot,
		.cleanto .calendar-body .dates .ct-week.active span {
			color:" . $settings->get_option('ct_text_color_on_bg') . " !important;
		}
		.cleanto .calendar-header a.previous-date,
		.cleanto .calendar-header a.next-date{
			color:" . $settings->get_option('ct_text_color_on_bg') . " !important;
		}
		
		.cleanto .ct-custom-checkbox  ul.ct-checkbox-list label:hover span,
		.cleanto .ct-custom-radio ul.ct-radio-list label:hover span{
			border:1px solid " . $settings->get_option('ct_secondary_color') . " !important;
		}
		#ct-login .ct-main-forget-password .ct-info-btn,
		.cleanto button,
		.cleanto #ct-front-forget-password .ct-front-forget-password .ct-info-btn,	
		.cleanto .ct-button{
			color:" . $settings->get_option('ct_text_color_on_bg') . " !important;
			background:" . $settings->get_option('ct_primary_color') . " !important;
			border: 2px solid " . $settings->get_option('ct_primary_color') . " !important;
		}
		.cleanto .ct-display-coupon-code .ct-coupon-value{
			color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
			background:" . $settings->get_option('ct_secondary_color') . " !important;
		}
		/* for front date legends */
		.cleanto .calendar-body .ct-show-time .time-slot-container .ct-slot-legends .ct-available-new {
			background: " . $settings->get_option('ct_primary_color') . " !important;
		}
		.cleanto .calendar-body .ct-show-time .time-slot-container .ct-slot-legends .ct-selected-new{
			background: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		/* seconday color */
		.nicescroll-cursors{
			background-color: " . $settings->get_option('ct_secondary_color') . " !important;
		}
				
	    .cleanto .calendar-body .dates .ct-week.active,
	    .cleanto .calendar-body .ct-show-time.shown{
	    	background: " . $settings->get_option('ct_secondary_color') . " !important;
	    }
	/* background color all css  HOVER */
		
		.cleanto .ct-selected,
		.cleanto .ct-selected-data,
		.cleanto .ct-provider-list ul.provders-list li input[type='radio']:checked + lable span,
		.cleanto .ct-list-services ul.services-list li input[type='radio']:checked + lable span,
		.cleanto .ct-extra-services-list ul.addon-service-list li input[type='checkbox']:checked label span,
		.cleanto .ct-discount-list ul.ct-discount-often li input[type='radio']:checked + .ct-btn-discount,
		.cleanto #ct-tslots .ct-date-time-main .time-slot-selection-main .time-slot.ct-selected,
		.cleanto .ct-button:hover,
		.cleanto-login .ct-main-forget-password .ct-info-btn:hover,
		.cleanto #ct-front-forget-password .ct-front-forget-password .ct-info-btn:hover,
		.cleanto  input[type='submit']:hover,
		.cleanto  input[type='reset']:hover,
		.cleanto  input[type='button']:hover,
		.cleanto  button:hover{
			color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
			background: " . $settings->get_option('ct_secondary_color') . " !important;
			border-color: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		.cleanto .ct-step-heading{
			color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
			background: " . $settings->get_option('ct_secondary_color') . " !important;
			border-color: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		.cleanto #ct-price-scroll{
			border-color: " . $settings->get_option('ct_primary_color') . " !important;
			box-shadow: 0px 0px 1px " . $settings->get_option('ct_primary_color') . " !important;
			position: ".$ct_cart_scrollable_position.";
		}
		
		.cleanto .ct-cart-wrapper .ct-cart-label-total-amount,
		.cleanto .ct-cart-wrapper .ct-cart-total-amount{
			color: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		
		.cleanto .ct-list-services ul.services-list li input[type='radio']:checked + .ct-service ,
		.cleanto .ct-provider-list ul.provders-list li input[type='radio']:checked + .ct-provider ,
		.cleanto .ct-extra-services-list ul.addon-service-list li input[type='checkbox']:checked + .ct-addon-ser {
			border-color: " . $settings->get_option('ct_secondary_color') . " !important;
			box-shadow: 0 0 10px 1px " . $settings->get_option('ct_secondary_color') . " !important;
		}
		.cleanto .ct-extra-services-list ul.addon-service-list li input[type='checkbox']:checked + .ct-addon-ser span:before{
			border-top-color: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		.cleanto .ct-extra-services-list ul.addon-service-list li input[type='checkbox']:checked + .ct-addon-ser .addon-price{
			color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
		}
		
		
		.cleanto .border-c:hover,
		.cleanto .ct-list-services ul.services-list li .ct-service:hover,
		.cleanto .ct-list-services ul.addon-service-list li .ct-addon-ser:hover,
		.cleanto #ct-meth-unit-type-2.ct-meth-unit-count .bedroom-box .ct-bedroom-btn:hover,
		.cleanto #ct-meth-unit-type-2.ct-meth-unit-count .bathroom-box .ct-bathroom-btn:hover,
		.cleanto #ct-duration-main.ct-service-duration .ct-duration-list .duration-box .ct-duration-btn:hover,
		.cleanto .ct-extra-services-list .ct-addon-extra-count .ct-common-addon-list .ct-addon-box .ct-addon-btn:hover,
		.cleanto .ct-discount-list ul.ct-discount-often li .ct-btn-discount:hover,
		.cleanto .ct-custom-radio ul.ct-radio-list label:hover span,
		.cleanto .ct-custom-checkbox  ul.ct-checkbox-list label:hover span{
			border-color: " . $settings->get_option('ct_primary_color') . " !important;
			
		}
		
		
		.cleanto .ct-custom-checkbox  ul.ct-checkbox-list input[type='checkbox']:checked + label span{
			border: 1px solid " . $settings->get_option('ct_secondary_color') . " !important;
			background: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		.cleanto .ct-custom-radio ul.ct-radio-list input[type='radio']:checked + label span{
			border:5px solid " . $settings->get_option('ct_secondary_color') . " !important;
		}
		.cleanto #ct-meth-unit-type-2.ct-meth-unit-count .bedroom-box .ct-bedroom-btn.ct-bed-selected,
		.cleanto #ct-meth-unit-type-2.ct-meth-unit-count .bathroom-box .ct-bathroom-btn.ct-bath-selected,
		.cleanto #ct-duration-main.ct-service-duration .ct-duration-list .duration-box .ct-duration-btn.duration-box-selected,
		.cleanto .ct-extra-services-list .ct-addon-extra-count .ct-common-addon-list .ct-addon-box .ct-addon-selected{
			background: " . $settings->get_option('ct_secondary_color') . " !important;
			color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
			border-color: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		
		.cleanto .ct-button.ct-btn-abs,
		.cleanto .calendar-header,
		.cleanto .panel-login .panel-heading .col-xs-6,
		.cleanto a.ct-back-to-top {
			background-color: " . $settings->get_option('ct_primary_color') . " !important;
		}
		.cleanto a.ct-back-to-top:hover,
		.cleanto .weekdays{
			background-color: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		
		.cleanto .calendar-body .dates .ct-week.by_default_today_selected{
			background-color: " . $settings->get_option('ct_primary_color') . " !important;
		}
		.cleanto .calendar-body .dates .ct-week.by_default_today_selected a span{
			color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
		}
		
		.cleanto .calendar-body .dates .ct-week.selected_date.active{
			background-color: " . $settings->get_option('ct_secondary_color') . " !important;
			border-bottom: thin solid " . $settings->get_option('ct_secondary_color') . " !important;
		}
		.cleanto .calendar-body .ct-show-time .time-slot-container ul li.time-slot:hover,
		.cleanto .calendar-body .ct-show-time .time-slot-container ul li.time-slot.ct-booked,
		.cleanto .calendar-body .ct-show-time.shown{
			background-color: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		
		
		.cleanto #ct-meth-unit-type-2.ct-meth-unit-count .bedroom-box .ct-bedroom-btn.ct-bed-selected,
		.cleanto #ct-meth-unit-type-2.ct-meth-unit-count .bathroom-box .ct-bathroom-btn.ct-bath-selected,
		.cleanto #ct-duration-main.ct-service-duration .ct-duration-list .duration-box .ct-duration-btn.duration-box-selected,
		.cleanto .ct-extra-services-list .ct-addon-extra-count .ct-common-addon-list .ct-addon-box .ct-addon-selected{
			/* background: " . $settings->get_option('ct_secondary_color') . " !important; */
		}
		
		
		
		/* hover inputs */
		.cleanto input[type='text']:hover,
		.cleanto input[type='password']:hover,
		.cleanto input[type='email']:hover,
		.cleanto input[type='url']:hover,
		.cleanto input[type='tel']:hover,
		.cleanto input[type='number']:hover,
		.cleanto input[type='range']:hover,
		.cleanto input[type='date']:hover,
		.cleanto textarea:hover,
		.cleanto select:hover,
		.cleanto input[type='search']:hover,
		.cleanto input[type='submit']:hover,
		.cleanto input[type='button']:hover{
			border-color: " . $settings->get_option('ct_primary_color') . " !important;
		}
		
		/* Focus inputs */
		.cleanto input[type='text']:focus,
		.cleanto input[type='password']:focus,
		.cleanto input[type='email']:focus,
		.cleanto input[type='url']:focus,
		.cleanto input[type='tel']:focus,
		.cleanto input[type='number']:focus,
		.cleanto input[type='range']:focus,
		.cleanto input[type='date']:focus,
		.cleanto textarea:focus,
		.cleanto select:focus,
		.cleanto input[type='search']:focus,
		.cleanto input[type='submit']:focus,
		.cleanto input[type='button']:focus{
			border-color: " . $settings->get_option('ct_secondary_color') . " !important;
			/* box-shadow: 0 0 0 1.5px " . $settings->get_option('ct_secondary_color') . " inset !important; */
		}
		.cleanto .ct-tooltip-link {color: " . $settings->get_option('ct_secondary_color') . " !important;}
	    /* for custom css option */
		".$settings->get_option('ct_custom_css')."
		
		.cleanto .ct_method_tab-slider--nav .ct_method_tab-slider-tabs {
		  background: " . $settings->get_option('ct_primary_color') . " !important;
		}
		.cleanto .ct_method_tab-slider--nav .ct_method_tab-slider-tabs:after {
		  background: " . $settings->get_option('ct_secondary_color') . " !important;
		}
		.cleanto .ct_method_tab-slider--nav .ct_method_tab-slider-trigger {
		  color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
		}
		.cleanto .ct_method_tab-slider--nav .ct_method_tab-slider-trigger.active {
		  color: " . $settings->get_option('ct_text_color_on_bg') . " !important;
		}
	</style>";
    ?>
    <script>
        jQuery(document).ready(function () {
            var $sidebar = jQuery("#ct-price-scroll"),
                $window = jQuery(window),
                offset = $sidebar.offset(),
                topPadding = 250;
            fulloffset = jQuery("#ct").offset();

            $window.scroll(function () {
                var color = jQuery('#color_box').val();
                jQuery("#ct-price-scroll").css({'box-shadow': '0px 0px 1px ' + color + '', 'position': 'absolute'});
            });
        });
    </script>
    <script type="text/javascript">
        function myFunction() {
            var input = document.getElementById('coupon_val')
            var div = document.getElementById('display_code');
            div.innerHTML = input.value;
        }
    </script>
	
<div class="ct-wrapper cleanto mb" id="ct"> <!-- main wrapper -->
    <div class="ct-main-wrapper">
	    <div class="container">
		    <!-- left side main booking form -->
			<div class="ct-main-left ct-sm-12 ct-md-12 ct-xs-12 mt-10 br-5 np">
                 <div class="panel-group" id="accordion">
					<div class="panel panel-default">
						<div class="panel-heading active">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#ct-services-mb"><?php echo $label_language_values['choose_service']; ?></a>
							</h4>
						</div>
						<div id="ct-services-mb" class="panel-collapse collapse in">
							<div class="panel-body">
								<div class="ct-list-services ct-common-box">
									<div class="ct-list-header"></div>
								</div>
							
								<div class="ct-list-services ct-common-box fl hide_allsss">
									
									<input id="total_cart_count" type="hidden" name="total_cart_count" value='1'/>
									<!-- area based select cleaning -->
									<?php
									if ($settings->get_option('ct_service_default_design') == 1) {
										?>
										<!-- 1.box style services selection radio selection -->
										<ul class="services-list">
											<?php
											$services_data = $objservice->readall_for_frontend_services();
											if (mysqli_num_rows($services_data) > 0) {
												while ($s_arr = mysqli_fetch_array($services_data)) {
													?>
													<li 
													<?php if($settings->get_option('ct_company_service_desc_status') != "" &&  $settings->get_option('ct_company_service_desc_status') == "Y"){ ?>
													
													
													title='<?php echo $s_arr['description'];?>' class="ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 remove_service_class ser_details ct-tooltip-services tooltipstered"
													<?php } else {
														echo "class='ct-sm-6 ct-md-4 ct-lg-3 ct-xs-12 remove_service_class ser_details'";										
													}  ?>
														data-servicetitle="<?php echo $s_arr['title']; ?>"
														data-id="<?php echo $s_arr['id']; ?>">
														<input type="radio" name="service-radio"
															   id="ct-service-<?php echo $s_arr['id']; ?>"
															   class="make_service_disable"/>
														<label class="ct-service border-c" for="ct-service-<?php echo $s_arr['id']; ?>">
															<?php
															if ($s_arr['image'] == '') {
																$s_image = 'default_service.png';
															} else {
																$s_image = $s_arr['image'];
															}
															?>
															<div class="ct-service-img"><img class="ct-image"
																	src="<?php echo SITE_URL; ?>assets/images/services/<?php echo $s_image; ?>"/>
															</div>

														</label>
														
														<div class="service-name fl ta-c"><?php echo $s_arr['title']; ?></div>
													</li>
												<?php
												} ?>
										   <?php  } else {
												?>
												<li class="ct-sm-12 ct-md-12 ct-xs-12 ct-no-service-box"><?php echo $label_language_values['please_configure_first_cleaning_services_and_settings_in_admin_panel']; ?>
												</li>
											<?php
											}
											?>
										</ul>
										<!--  1 end box style service selection -->
										<?php
										if (mysqli_num_rows($services_data) === 1){
											$ser_arry = mysqli_fetch_array($services_data)
											?>
											<script>
											/** Make Service Selected **/
											jQuery(document).ready(function() {
												jQuery('.ser_details').trigger('click');
											});
											</script>
											<?php
										}
									} else {
										?>
										<input type="radio" style="display:none;" name="service-radio" id="ct-service-0" value='off' class="make_service_disable"/>
										<!-- 2. sevice dropdown selection -->
									<?php
										$services_data = $objservice->readall_for_frontend_services();
										if (mysqli_num_rows($services_data) > 0) {
											?>
											<label class="service_not_selected_error_d2" id="service_not_selected_error_d2"><?php echo $label_language_values['please_select_service']; ?></label>
											<div class="services-list-dropdown fl" id="ct-type-2">
											<div class="service-selection-main">
												<div class="service-is" title="<?php echo $label_language_values['choose_your_service'];?>">
													<div class="ct-service-list" id="ct_selected_service">
														<i class="icon-settings service-image icons"></i>

														<h3 class="service-name ser_name_for_error"><?php echo $label_language_values['cleaning_service']; ?></h3>
													</div>
												</div>
												<div class="ct-services-dropdown remove_service_data"> <?php
													while ($s_arr = mysqli_fetch_array($services_data)) { ?>
														<div class="ct-service-list select_service remove_service_class ser_details"
															 data-servicetitle="<?php echo $s_arr['title']; ?>"
															 data-id="<?php echo $s_arr['id']; ?>">
															<?php
															if ($s_arr['image'] == '') {
																$s_image = 'default_service.png';
															} else {
																$s_image = $s_arr['image'];
															}
															?>
															<img class="service-image"
																 src="<?php echo SITE_URL; ?>assets/images/services/<?php echo $s_image; ?>"
																 title="<?php echo $label_language_values['service_image']; ?>"/>

															<h3 class="service-name"><?php echo $s_arr['title']; ?></h3>
														</div>
													<?php }
												?></div>
											</div> </div><?php
											if (mysqli_num_rows($services_data) === 1){
													$st_arry = mysqli_fetch_array($services_data)
													?>
													<script>
													/** Make Service Selected **/
													jQuery(document).ready(function() {
														jQuery('.select_service').trigger('click');
													});
													</script>
													<?php
												}
										} else {
											?>
											<div class="ct-sm-12 ct-md-12 ct-xs-12 ct-no-service-box"><?php echo $label_language_values['please_configure_first_cleaning_services_and_settings_in_admin_panel']; ?></div>
										<?php
										}
										?>
									<!-- 2. end service dropdown selection -->
									<?php
									}
									?>
									<div class="ct-scroll-meth-unit"></div>	
									<label class="method_not_selected_error show_methods_after_service_selection" id="method_not_selected_error"><?php echo $label_language_values['please_select_method']; ?></label>

									<div class="services-method-list-dropdown fl show_methods_after_service_selection show_single_service_method" id="ct-type-method">
										<div class="service-method-selection-main">
											<div class="ct-services-method-dropdown s_method_names">
											</div>
										</div>
									</div>
									<label class="empty_cart_error" id="empty_cart_error"></label>
									<label class="no_units_in_cart_error" id="no_units_in_cart_error"></label>
									<input type='hidden' id="no_units_in_cart_err" value=''>
									<input type='hidden' id="no_units_in_cart_err_count" value=''>
									<!-- hrs selected  -->
									<div class="ct-service-duration ct-md-12 ct-sm-12 s_m_units_design_1" id="ct-duration-main">
										<div class="ct-inner-box border-c">

											<div class="fl ct-md-12 mt-5 mb-15 np duration_hrs">
											</div>
											<!-- end duration hrs  -->
										</div>
									</div>
									<!-- 1. bedroom and bathroom counting dropdown -->
									<div class="ct-meth-unit-count ct-md-12 ct-sm-12 np ct-hidden fl s_m_units_design_2"
										 id="ct-meth-unit-type-1">
										<div class="ct-inner-box border-c ser_design_2_units">

										</div>
									</div>
									<!-- 1.end dropdown list bathroom bedroom -->
									<!-- 2. boxed bathroom bedroom  -->
									<div class="ct-meth-unit-count ct-md-12 ct-sm-12 np s_m_units_design_3" id="ct-meth-unit-type-2">
										<div class="ct-inner-box border-c ser_design_3_units">

										</div>
									</div>
									<!-- 2. end boxed bathroom bedroom -->

									<div class="ct-meth-unit-count ct-md-12 ct-sm-12 s_m_units_design_4" id="ct-meth-unit-type-3">
										<div class="ct-inner-box border-c ">
											<div class="fl ct-bedrooms ct-btn-group ct-md-12 mt-5 mb-15 np">
												<div class="ct-inner-box border-c ser_design_4_units">

												</div>
											</div>
										</div>
									</div>


								</div>
								<!-- end service list -->


								<!-- Module third area based -->
								<div class="ct-list-services ct-common-box s_m_units_design_5 ser_design_5_units">

								</div>
								<!-- end area based -->
								<!-- end module third area based -->

								<div class="ct-extra-services-list ct-common-box add_on_lists hide_allsss_addons">

								</div>


								<!-- how often discount -->
								<?php $d_data = $frequently_discount->readall_front();
								$fd_data = $frequently_discount->readall_freq_dis_for_display_in_scrollbar();
								$freq_dis_title = mysqli_fetch_array($fd_data);
								if (mysqli_num_rows($d_data) > 0) {
									?>
									<div class="ct-discount-list ct-common-box">
										<div class="ct-list-header">
											<h3 class="header3"><?php echo $label_language_values['how_often_would_you_like_us_provide_service']; ?>
											 <?php if($settings->get_option("ct_front_tool_tips_status")=='on' && $settings->get_option("ct_front_tool_tips_frequently_discount")!=''){?>
											<a class="ct-tooltip" href="#" data-toggle="tooltip" title="<?php echo $settings->get_option("ct_front_tool_tips_frequently_discount");?>"><i class="fa fa-info-circle fa-lg"></i></a>	
											<?php } ?>
											</h3>
											
											<p class="ct-sub"><?php echo $label_language_values['recurring_discounts_apply_from_the_second_cleaning_onward']; ?></p>
											<label class="freq_disc_empty_cart_error error" style="color:red"></label>
										</div>

										<ul class="ct-discount-often">
											<?php
											while ($f_discount = mysqli_fetch_array($d_data)) {
												?>
												<li class="ct-sm-6 ct-md-3 ct-xs-12 mb-10">
													<div class="discount-text f-l"><span
															class="discount-price"><?php if ($f_discount['labels'] != '') { ?> <?php echo ucwords($f_discount['labels']); } ?></span>
													</div>
													
													<input type="radio" name="frequently_discount_radio" <?php if (ucwords($freq_dis_title['discount_typename']) == 'Once') {
														echo 'checked';
													} else if (ucwords($freq_dis_title['discount_typename']) == 'Weekly') {
														echo 'checked';
													} else if (ucwords($freq_dis_title['discount_typename']) == 'Bi-Weekly') {
														echo 'checked';
													} else if (ucwords($freq_dis_title['discount_typename']) == 'Monthly') {
														echo 'checked';
													} ?> data-id='<?php echo $f_discount['id']; ?>' class="cart_frequently_discount"
														   id="discount-often-<?php echo $f_discount['id']; ?>"
														   data-name="<?php echo ucwords($label_language_values[strtolower(str_replace("-","_",$f_discount['discount_typename']))]); ?> "/>
													<label class="ct-btn-discount border-c"
														   for="discount-often-<?php echo $f_discount['id']; ?>">
														<span
															class="float-left"><?php echo ucwords($label_language_values[strtolower(str_replace("-","_",$f_discount['discount_typename']))]); ?></span>
														<span class="ct-discount-check float-right"></span>
													</label>
												</li>
											<?php
											}
											?>
										</ul>
									</div><!-- how often discount end -->
								<?php
								} else {
									?>
									<input type="radio" name="frequently_discount_radio" checked data-id='0' class="cart_frequently_discount" id="discount-often-0" data-name="" style="display:none;"/>
								<?php
								}
								?>
								
								<div class="ct-provider-list ct-common-box">
									<div class="ct-list-header">
									<h3 class="header3 show_select_staff_title" style="display:none;"><?php echo $label_language_values['please_select_provider'];;?></h3>
										<ul class="provders-list">

										</ul>
									</div>
								</div>
								
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#ct-calendar-date-mb"><?php echo $label_language_values['when_would_you_like_us_to_come']; ?></a>
							</h4>
						</div>
						<div id="ct-calendar-date-mb" class="panel-collapse collapse">
							<div class="panel-body">
								<!-- date time selection -->
								<div class="ct-date-time-main ct-common-box hide_allsss">
									<div class="ct-md-12 ct-sm-12 ct-xs-12 ct-datetime-select-main">
										<div class="ct-datetime-select">
											<label class="date_time_error" id="date_time_error_id" for="complete_bookings"></label>

											<div class="calendar-wrapper cal_info">

											</div>
											<!-- end calendar-wrapper -->
										</div>
									</div>
								</div>
								<!-- date and time slots end  -->
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#ct-personal-info-mb"><?php echo $label_language_values['your_personal_details']; ?></a>
							</h4>
						</div>
						<div id="ct-personal-info-mb" class="panel-collapse collapse">
							<div class="panel-body">
								<!-- personal details -->
								<div class="ct-user-info-main ct-common-box existing_user_details hide_allsss">
									<div class="ct-list-header">
										<!--<div class="client_logout">-->
										<div class="ct-logged-in-user client_logout">
											<p class="welcome_msg_after_login pull-left"><?php echo $label_language_values['you_are_logged_in_as']; ?> <span class='fname'></span> <span class='lname'></span></p>
											<a href="javascript:void(0)" class="ct-link ml-10" id="ct_change_customer" title="Change Customer<?php //echo $label_language_values['log_out']; ?>">Change Customer<?php //echo $label_language_values['log_out']; ?></a>
										</div>
										<!--</div>-->
									</div>
									<div class="ct-main-details">
										<div class="ct-login-exist" id="ct-login">
											<div class="ct-custom-radio">
												<ul class="ct-radio-list hide_radio_btn_after_login">
													<?php
													if($settings->get_option('ct_existing_and_new_user_checkout') == 'on' && $settings->get_option('ct_guest_user_checkout') == 'on'){
													?>
													<li class="ct-exiting-user ct-md-4 ct-sm-6 ct-xs-12">
														<input id="existing-user" type="radio" class="input-radio existing-user user-selection" name="user-selection" value="Existing User"/>
														<label for="existing-user" class=""><span></span><?php echo $label_language_values['existing_user']; ?></label>
													</li>
													<li class="ct-new-user ct-md-4 ct-sm-6 ct-xs-12">
														<input id="new-user" type="radio" checked="checked" class="input-radio new-user user-selection" name="user-selection" value="New-User"/>
														<label for="new-user" class=""><span></span><?php echo $label_language_values['new_user']; ?>
														</label>
													</li>
													<li class="ct-guest-user ct-md-4 ct-sm-6 ct-xs-12">
														<input id="guest-user" type="radio" class="input-radio guest-user user-selection" name="user-selection" value="Guest-User"/>
														<label for="guest-user" class=""><span></span><?php echo $label_language_values['guest_user']; ?></label>
													</li>
													<?php
													}else if($settings->get_option('ct_existing_and_new_user_checkout') == 'off' && $settings->get_option('ct_guest_user_checkout') == 'on'){
													?>
													<li class="ct-guest-user ct-md-4 ct-sm-6 ct-xs-12" style='display:none;'>
														<input id="guest-user" type="radio" class="input-radio guest-user user-selection" checked="checked"  name="user-selection" value="Guest-User"/>
														<label for="guest-user" class=""><span></span><?php echo $label_language_values['guest_user']; ?></label>
													</li>						
													<?php
													}else if($settings->get_option('ct_existing_and_new_user_checkout') == 'on' && $settings->get_option('ct_guest_user_checkout') == 'off'){
													?>
													<li class="ct-exiting-user ct-md-4 ct-sm-6 ct-xs-12">
														<input id="existing-user" type="radio" class="input-radio existing-user user-selection" name="user-selection" value="Existing User"/>
														<label for="existing-user" class=""><span></span><?php echo $label_language_values['existing_user']; ?></label>
													</li>
													<li class="ct-new-user ct-md-4 ct-sm-6 ct-xs-12">
														<input id="new-user" type="radio" checked="checked" class="input-radio new-user user-selection" name="user-selection" value="New-User"/>
														<label for="new-user" class=""><span></span><?php echo $label_language_values['new_user']; ?>
														</label>
													</li>
													<?php
													}
													?>
												</ul>
											</div>

											<div class="ct-login-existing ct-hidden">
												<form id="user_login_form" class="" method="POST">
													<div class="ct-md-7 ct-sm-8 ct-xs-12 ct-form-row hide_login_email">
														<label for="ct-user-name">Select existing user</label>
														<select id="ct_mb_existing_login_dropdown" class="selectpicker" data-size="10" style="display: none;" data-live-search="true">
															<option value="0">Please select</option>
															<?php
															$all_existing_users = $user->readall();
															while($data = mysqli_fetch_array($all_existing_users)){
																echo '<option value="'.$data['id'].'">'.$data['first_name'].' '.$data['last_name'].'</option>';
															}
															?>
														</select>
													
														
													</div>
													
												</form>
											</div>
										</div>  
										
										<input type="hidden" id="ct-user-name" value="" />
										<input type="hidden" id="ct-user-pass" value="" />
										
										<input type="hidden" id="color_box" data-id="<?php echo $settings->get_option('ct_secondary_color'); ?>" value="<?php echo $settings->get_option('ct_secondary_color'); ?>"/>

										<form id="user_details_form" class="" method="post">
											<div class="ct-new-user-details remove_preferred_password_and_preferred_email">
												<div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row">
													<label for="ct-email"><?php echo $label_language_values['preferred_email']; ?></label>
													<input type="text" name="ct_email" id="ct-email" class="add_show_error_class error" placeholder="<?php echo $label_language_values['your_valid_email_address']; ?>"/>
												</div>
												<div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row">
													<label for="ct-preffered-pass"><?php echo $label_language_values['preferred_password']; ?></label>
													<input type="password" name="ct_preffered_pass" id="ct-preffered-pass" class="add_show_error_class error" placeholder="<?php echo $label_language_values['password']; ?>"/>
												</div>
											</div>
											<div class="ct-peronal-details">
												<div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row remove_guest_user_preferred_email">
													<label for="ct-email-guest"><?php echo $label_language_values['preferred_email']; ?>
													</label>
													<input type="text" name="ct_email_guest" class="add_show_error_class error" id="ct-email-guest" placeholder="<?php echo $label_language_values['your_valid_email_address'];?>"/>
												</div>
												<?php $fn_check = explode(",",$settings->get_option("ct_bf_first_name"));if($fn_check[0] == 'on'){ ?>
												<div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row">
													<label for="ct-first-name"><?php echo $label_language_values['first_name']; ?></label>
													<input type="text" name="ct_first_name" class="add_show_error_class error" id="ct-first-name" placeholder="<?php echo $label_language_values['your_first_name']; ?>"/>
												</div>
												<?php } else {
													?>
													<input type="hidden" name="ct_first_name" id="ct-first-name" class="add_show_error_class error" value=""/>
													<?php 
												} ?>
												<?php $ln_check = explode(",",$settings->get_option("ct_bf_last_name"));if($ln_check[0] == 'on'){ ?>
												<div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row">
													<label for="ct-last-pass"><?php echo $label_language_values['last_name']; ?></label>
													<input type="text" class="add_show_error_class error" name="ct_last_name" id="ct-last-name" placeholder="<?php echo $label_language_values['your_last_name']; ?>"/>
												</div>
												<?php } else {
													?>
													<input type="hidden" name="ct_last_name" id="ct-last-name" class="add_show_error_class error" value=""/>
													<?php 
												} ?>
												<?php $phone_check = explode(",",$settings->get_option("ct_bf_phone")); if($phone_check[0] == 'on'){ ?>
												<div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row">
													<label for="ct-user-phone"><?php echo $label_language_values['phone']; ?></label>
													<input type="tel" value="" id="ct-user-phone" class="add_show_error_class error" name="ct_user_phone"/>
												</div>
												<?php } else {
													?>
													<input type="hidden" name="ct_user_phone" id="ct-user-phone" class="add_show_error_class error" value=""/>
													<?php 
												} ?>
												<?php $address_check = explode(",",$settings->get_option("ct_bf_address"));if($address_check[0] == 'on'){ ?>
												<div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row">
													<label for="ct-street-address"><?php echo $label_language_values['street_address']; ?></label>
													<input type="text" name="ct_street_address" id="ct-street-address" class="add_show_error_class error" placeholder="<?php echo $label_language_values['street_address_placeholder']; ?>"/>
												</div>
												<?php } else {
													?>
													<input type="hidden" name="ct_street_address" id="ct-street-address" class="add_show_error_class error" value=""/>
													<?php 
												} ?>
												<?php $zip_check = explode(",",$settings->get_option("ct_bf_zip_code"));if($zip_check[0] == 'on'){ ?>
												<div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row remove_zip_code_class">
													<label for="ct-zip-code"><?php echo $label_language_values['zip_code']; ?></label>
													<input type="text" name="ct_zip_code" id="ct-zip-code" class="add_show_error_class error" placeholder="<?php echo $label_language_values['zip_code_placeholder']; ?>"/>
												</div>
												<?php } else {
													?>
													<input type="hidden" name="ct_zip_code" id="ct-zip-code" class="add_show_error_class error" value=""/>
													<?php 
												} ?>
												<?php $city_check = explode(",",$settings->get_option("ct_bf_city")); if($city_check[0] == 'on'){ ?>
												<div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row remove_city_class">
													<label for="ct-city"><?php echo $label_language_values['city']; ?></label>
													<input type="text" name="ct_city" id="ct-city" class="add_show_error_class error" placeholder="<?php echo $label_language_values['city_placeholder']; ?>"/>
												</div>
												<?php } else {
													?>
													<input type="hidden" name="ct_city" id="ct-city" class="add_show_error_class error" value=""/>
													<?php 
												} ?>
												<?php $state_check = explode(",",$settings->get_option("ct_bf_state")); if($state_check[0] == 'on'){ ?>
												<div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row remove_state_class">
													<label for="ct-state"><?php echo $label_language_values['state']; ?></label>
													<input type="text" name="ct_state" id="ct-state" class="add_show_error_class error" placeholder="<?php echo $label_language_values['state_placeholder']; ?>"/>
												</div>
												<?php } else {
													?>
													<input type="hidden" name="ct_state" id="ct-state" class="add_show_error_class error" value=""/>
													<?php 
												} ?>
												<?php $notes_check = explode(",",$settings->get_option("ct_bf_notes")); if($notes_check[0] == 'on'){ ?>
												<div class="ct-md-12 ct-xs-12 ct-form-row">
													<label for="ct-notes"><?php echo $label_language_values['special_requests_notes']; ?></label>
													<textarea id="ct-notes" class="add_show_error_class error" rows="10"></textarea>
												</div>
												<?php } else {
													?>
													<input type="hidden" id="ct-notes" class="add_show_error_class error" value=""/>
													<?php 
												} ?>
												

												<?php 
												if($settings->get_option('ct_vc_status')=="Y"){
													?>
												<div class="ct-custom-radio ct-options-new ct-md-6 ct-sm-6 ct-xs-12 mb-15">
													<label><?php echo $label_language_values['do_you_have_a_vaccum_cleaner']; ?></label>
													<ul class="ct-radio-list">
														<li>
															<input id="vaccum-yes" type="radio" checked="checked" class="input-radio vc_status" name="vacuum-cleaner" value="Vacuum-Yes"/>
															<label for="vaccum-yes"><span></span><?php echo $label_language_values['yes']; ?></label>
														</li>
														<li>
															<input id="vaccum-no" type="radio" class="input-radio vc_status" name="vacuum-cleaner" value="Vacuum-No"/>
															<label for="vaccum-no"><span></span><?php echo $label_language_values['no']; ?></label>
														</li>
													</ul>
												</div>
												<?php }?>
												<?php 
												if($settings->get_option('ct_p_status')=="Y"){
													?>
												<div class="ct-custom-radio ct-options-new ct-md-6 ct-sm-6 ct-xs-12 mb-10">
													<label><?php echo $label_language_values['do_you_have_parking']; ?></label>
													<ul class="ct-radio-list">
														<li>
															<input id="parking-yes" type="radio" checked="checked" class="input-radio p_status" name="parking" value="Parking-Yes"/>
															<label for="parking-yes"><span></span><?php echo $label_language_values['yes']; ?></label>
														</li>
														<li>
															<input id="parking-no" type="radio" class="input-radio p_status"
																   name="parking" value="Parking-No"/>
															<label for="parking-no"><span></span><?php echo $label_language_values['no']; ?></label>
														</li>

													</ul>
												</div>
												<?php }?>
												<?php if($settings->get_option('ct_company_willwe_getin_status') != "" &&  $settings->get_option('ct_company_willwe_getin_status') == "Y"){?>
												<div class="ct-options-new ct-md-12 ct-xs-12 mb-10 ct-form-row">
													<label><?php echo $label_language_values['how_will_we_get_in']; ?></label>

													<div class="ct-option-select">
														<select class="ct-option-select" id="contact_status">
															<option value="I'll be at home"><?php echo $label_language_values['i_will_be_at_home']; ?></option>
															<option value="Please call me"><?php echo $label_language_values['please_call_me']; ?></option>
															<option value="The key is with the doorman"><?php echo $label_language_values['the_key_is_with_the_doorman']; ?></option>
															<option value="Other"><?php echo $label_language_values['other']; ?></option>
														</select>
													</div>
													<div class="ct-option-others ct-md-12 pt-10 np ct-xs-12 ct-hidden">
														<input type="text" name="other_contact_status" class="add_show_error_class error" id="other_contact_status" placeholder="<?php echo $label_language_values['enter_your_other_option']; ?>"/>
													</div>
												</div>
												<?php } ?>
												<?php 
												if( $settings->get_option('ct_appointment_details_display') == 'on' && ($address_check[0] == 'on' || $zip_check[0] == 'on' || $city_check[0] == 'on' || $state_check[0] == 'on'))
												{ ?>					  
												<div class="ct-md-12 ct-xs-12 ct-form-row np">
													<h3 class="header3 pull-left"><?php echo $label_language_values['appointment_details']; ?></h3>
													<div class="pull-left ml-10 mt-5">
													<div class="ct-custom-checkbox">
														<ul class="ct-checkbox-list">
															<li>
																<input type="checkbox" id="retype_status" /> 
																<label for="retype_status" class="">
																	(<?php echo $label_language_values['same_as_above']; ?>) &nbsp;<span></span>
																</label>
															</li>
														</ul>
													</div>
													</div>
													<div class="cb"></div>
													
													
													
													<?php 
													if($address_check[0] == 'on')
													{ ?>
														<div class="ct-md-12 ct-xs-12 ct-form-row">
															<label for="app-notes"><?php echo $label_language_values['appointment_address']; ?></label>
															<input type="text" id="app-street-address" name="app_street_address" class="add_show_error_class error" placeholder="<?php echo $label_language_values['street_address_placeholder']; ?>">
														</div><?php  
													} else {
													?>
													<input type="hidden" name="app_street_address" id="app-street-address" class="add_show_error_class error" value=""/>
													<?php } ?>
													
													<?php 
													if($zip_check[0] == 'on')
													{ ?>
													<div class="ct-md-4 ct-sm-4 ct-xs-12 ct-form-row">
														<label for="app-zip-code"><?php echo $label_language_values['appointment_zip']; ?></label>
														<input type="text" name="app_zip_code" id="app-zip-code" class="add_show_error_class error" placeholder="<?php echo $label_language_values['zip_code_placeholder']; ?>"/>
													</div><?php  
													} else {
													?>
													<input type="hidden" name="app_zip_code" id="app-zip-code" class="add_show_error_class error" value=""/>
													<?php 
													} ?>
													
													<?php  
													if($city_check[0] == 'on')
													{ ?>
														<div class="ct-md-4 ct-sm-4 ct-xs-12 ct-form-row">
															<label for="app-city"><?php echo $label_language_values['appointment_city']; ?></label>
															<input type="text" name="app_city" id="app-city" class="add_show_error_class error" placeholder="<?php echo $label_language_values['city_placeholder']; ?>"/>
														</div><?php 
													} else {
													?>
													<input type="hidden" name="app_city" id="app-city" class="add_show_error_class error" value=""/>
													<?php 
													} ?>
												
													<?php 
													if($state_check[0] == 'on')
													{ ?>										  

													<div class="ct-md-4 ct-sm-4 ct-xs-12 ct-form-row">
														<label for="app-state"><?php echo $label_language_values['appointment_state']; ?></label>
														<input type="text" name="app_state" id="app-state" class="add_show_error_class error" placeholder="<?php echo $label_language_values['state_placeholder']; ?>"/>
													</div><?php
													} else {
													?>
													<input type="hidden" name="app_state" id="app-state" class="add_show_error_class error" value=""/>
													<?php 
												} ?>
													
												</div><?php
											} ?>	
											</div>
									</div>
									<!-- main details end -->
								</div>
								<!-- end personal details -->
								<!-- payment details -->

								<div class="ct-payment-main ct-common-box hide_allsss">
									<!-- Promocodes -->
									<?php
									if ($settings->get_option('ct_show_coupons_input_on_checkout') == 'on') {
										?>
										<div class="ct-discount-coupons ct-md-12">
											<div class="ct-form-rown">
												<div class="ct-coupon-input ct-md-6 ct-sm-12 ct-xs-12 mt-10 mb-15 np">
													<input id="coupon_val" type="text" name="coupon_apply"
														   class="ct-coupon-input-text hide_coupon_textbox"
														   placeholder="<?php echo $label_language_values['have_a_promocode']; ?>" maxlength="22" onchange="myFunction()"/>
													<a href="javascript:void(0);" class="ct-apply-coupon ct-link hide_coupon_textbox"
													   name="apply-coupon" id="apply_coupon"><?php echo $label_language_values['apply']; ?></a>
														  <?php if($settings->get_option("ct_front_tool_tips_status")=='on' && $settings->get_option("ct_front_tool_tips_promocode")!=''){?>
														<a class="ct-tooltip" href="#" data-toggle="tooltip" title="<?php echo $settings->get_option("ct_front_tool_tips_promocode");?>"><i class="fa fa-info-circle fa-lg"></i></a>	
														<?php } ?>
													<label class="ct-error ofh coupon_invalid_error"></label>
													<!-- display coupon -->
													<div class="ct-display-coupon-code">
														<div class="ct-form-rown">
															<div class="ct-column ct-md-7 ct-xs-12 ofh">
																<label><?php echo $label_language_values['applied_promocode']; ?></label>
															</div>
															<div class="ct-coupon-value-main ct-md-5 ct-xs-12">
																<span class="ct-coupon-value border-2" id="display_code"></span>
																<img id="ct-remove-applied-coupon"
																	 src="<?php echo SITE_URL; ?>/assets/images/ct-close.png"
																	 class="reverse_coupon" title="<?php echo $label_language_values['remove_applied_coupon']; ?>"/>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									<?php
									}
									?>
											<div class="ct-list-header ct-hidden">
												<h3 class="header3"><?php echo $label_language_values['preferred_payment_method']; ?>
												  <?php if($settings->get_option("ct_front_tool_tips_status")=='on' && $settings->get_option("ct_front_tool_payment_method")!=''){?>
												<a class="ct-tooltip" href="#" data-toggle="tooltip" title="<?php echo $settings->get_option("ct_front_tool_payment_method");?>"><i class="fa fa-info-circle fa-lg"></i></a>	
												<?php } ?>
												</h3>
												
											</div>
									   
										<div class="ct-main-payments fl ct-hidden">
											<div class="payments-container f-l" id="ct-payments">
												<label class="ct-error-msg"><?php echo $label_language_values['please_select_one_payment_method']; ?></label>
												<label class="ct-error-msg ct-paypal-error" id="paypal_error"></label>

												<div class="ct-custom-radio ct-payment-methods f-l">
													<ul class="ct-radio-list ct-all-pay-methods">
														<?php  if ($settings->get_option('ct_pay_locally_status') == 'on') { ?>
														<li class="ct-md-3 ct-sm-6 ct-xs-12" id="pay-at-venue">
															<input type="radio" name="payment-methods" value="pay at venue" class="input-radio payment_gateway" id="pay-cash"  checked="checked"/>
															<label for="pay-cash" class="locally-radio"><span></span><?php echo $label_language_values['pay_locally']; ?></label>
														</li>
														
														<?php } ?>	
														
														<!-- bank transfer -->
														<?php  if ($settings->get_option('ct_bank_transfer_status') == 'Y' && ($settings->get_option('ct_bank_name') != '' || $settings->get_option('ct_account_name') != ''  || $settings->get_option('ct_account_number') != '' || $settings->get_option('ct_branch_code') != '' || $settings->get_option('ct_ifsc_code') != '' || $settings->get_option('ct_bank_description') != '')) { ?>
														<li class="ct-md-3 ct-sm-6 ct-xs-12" id="ct-bank-transer">
															<input type="radio" name="payment-methods" value="bank transfer" class="input-radio bank_transfer payment_gateway" id="bank-transer"  />
															<label for="bank-transer" class="locally-radio"><span></span><?php echo $label_language_values['bank_transfer']; ?></label>
														</li>
														<?php }?>
												
														<?php
														if ($settings->get_option('ct_paypal_express_checkout_status') == 'on') {
															?>
														   
															<li class="ct-md-3 ct-sm-6 ct-xs-12" id="pay-at-venue">
																<input type="radio" name="payment-methods" value="paypal"
																	   class="input-radio payment_gateway" id="pay-paypal" checked="checked" />
																<label for="pay-paypal"  class="locally-radio"><span></span><?php echo $label_language_values['paypal']; ?><img src="<?php echo SITE_URL; ?>/assets/images/cards/paypal.png" class="ct-paypal-image" alt="PayPal"></label>
															</li>
														<?php
														} ?>
														
														<?php
														if ($settings->get_option('ct_payumoney_status') == 'Y') {
															?>
														   
															<li class="ct-md-3 ct-sm-6 ct-xs-12" id="pay-at-venue">
																<input type="radio" name="payment-methods" value="payumoney"
																	   class="input-radio payment_gateway" id="payumoney" checked="checked" />
																<label for="payumoney"  class="locally-radio"><span></span> <?php echo $label_language_values['payumoney']; ?><!--<img src="<?php //echo SITE_URL; ?>/assets/images/cards/paypal.png" class="ct-paypal-image" alt="PayPal">--></label>
															</li>
														<?php
														} ?>
														 <?php if($settings->get_option('ct_authorizenet_status') == 'on' && $settings->get_option('ct_stripe_payment_form_status') != 'on' && $settings->get_option('ct_2checkout_status') != 'Y'){  ?>
														<!-- new added -->
														<li class="ct-md-3 ct-sm-6 ct-xs-12" id="card-payment">
															<input type="radio" name="payment-methods" value="card-payment" class="input-radio payment_gateway cccard" id="pay-card" checked="checked"/>
															<label for="pay-card" class="card-radio"><span></span><?php echo $label_language_values['card_payment']; ?></label>
														</li>
														<?php  }  ?>
														<?php if ($settings->get_option('ct_authorizenet_status') != 'on' && $settings->get_option('ct_stripe_payment_form_status') == 'on' && $settings->get_option('ct_2checkout_status') != 'Y'){  ?>
														<!-- new added -->
														<li class="ct-md-3 ct-sm-6 ct-xs-12" id="card-payment">
															<input type="radio" name="payment-methods" value="stripe-payment" class="input-radio payment_gateway cccard" id="pay-card" checked="checked"/>
															<label for="pay-card" class="card-radio"><span></span><?php echo $label_language_values['card_payment']; ?></label>
														</li>
														<?php  }  ?>
														<?php if ($settings->get_option('ct_authorizenet_status') != 'on' && $settings->get_option('ct_stripe_payment_form_status') != 'on' && $settings->get_option('ct_2checkout_status') == 'Y'){  ?>
														<!-- new added -->
														<li class="ct-md-3 ct-sm-6 ct-xs-12" id="card-payment">
															<input type="radio" name="payment-methods" value="2checkout-payment" class="input-radio payment_gateway cccard" id="pay-card" checked="checked"/>
															<label for="pay-card" class="card-radio"><span></span><?php echo $label_language_values['card_payment']; ?></label>
														</li>
														<?php  } ?>
													  </ul>
												</div>
											</div>
										</div>
								  
								</div>
								<!-- end payment detials -->
								
								<!-- conditions and complete booking details -->
								<div class="ct-complete-booking-main ct-sm-12 ct-md-12 mb-30 ct-xs-12 hide_allsss">

									<div class="ct-list-header ct-hidden">
										<p class="ct-sub-complete-booking"></p>
									</div>
									
									<?php if($settings->get_option('ct_recurrence_booking_status')== 'Y'){ ?>
										<div class="bi-terms-agree ct-md-12">
											<div class="ct-custom-checkbox">
												<ul class="ct-checkbox-list">
													<li>
														<input type="checkbox" name="recurrence-booking" class="input-radio"
															   id="recurrence-booking"/>
														<label for="recurrence-booking" class="">
															<span></span>
															<?php echo $label_language_values['Recurrence_booking']; ?>
														</label>
													</li>
												</ul>  
											</div>
										</div>
										<div class="recurrence_type_dropdown" style="display:none;">
											<h4 class="header4 rtype"></h4>
											<div class="ct_recurrence_type_dropdown_1"></div>
											<div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row">
												<label><?php echo $label_language_values['Recurrence_Type']; ?></label>
												<select class="ct_recurrence_type_dropdown ct_recurrence_type">
													<option class="ct_recurrence_type_dropdown_option" value="daily"><?php echo $label_language_values['Daily']; ?><i class="fa fa-angle-down"></i></option>
													<option value="weekly"><?php echo $label_language_values['weekly']; ?></option>
													<option value="monthly"><?php echo $label_language_values['monthly']; ?></option>
													<option value="biweekly"><?php echo $label_language_values['bi_weekly']; ?></option>
													<option value="bimonthly"><?php echo $label_language_values['Bi_Monthly']; ?></option>
													<option value="fortnightly"><?php echo $label_language_values['Fortnightly']; ?></option>
												</select>
											</div>
											<div class="ct-md-6 ct-sm-6 ct-xs-12 ct-form-row">
												<label><?php echo $label_language_values['end_date']; ?>:</label>
												<input type="text" value="<?php echo date('Y-m-d'); ?>" readonly class="datepicker form-control ct_recurrence_end_date" />
											</div>
										</div>
									<?php } ?>
									<label class="ct_all_booking_errors ct-md-12 mt-30" style="display: none;"></label>
									<div class="ta-center fl">
										<a href="javascript:void(0)" type='submit' data-currency_symbol="<?php echo $settings->get_option('ct_currency_symbol'); ?>" id='complete_bookings' class="ct-button ct-btn-big ct_remove_id"><?php echo $label_language_values['complete_booking'];?></a>
									</div>
								</div>

								</form>								
							</div>
						</div>
					</div><!-- end according toggle -->
					
					<!-- start booking details -->
					<div class="ct-main-right ct-sm-8 ct-md-6 ct-xs-12 mt-30 mb-30 br-5 hide_allsss">
						<div class="fl">
							<div class="main-inner-container border-c ct-price-scroll" id="ct-price-scroll">
								<div class="ct-step-heading"><h3 class="header3"><?php echo $label_language_values['booking_summary']; ?></h3></div>
								<div class="ct-cart-wrapper f-l" id="">
									<div class="ct-summary hideservice_name">
										<div class="ct-image">
											<img src="<?php echo SITE_URL; ?>/assets/images/icon-service.png" alt="">
										</div>
										<p class="ct-text sel-service"></p>
									</div>
									<div class="ct-summary hidedatetime_value">
										<div class="ct-image">
											<img src="<?php echo SITE_URL; ?>/assets/images/icon-calendar.png" alt="">
										</div>
										<p class="ct-text sel-datetime"><span class='cart_date' data-date_val=""></span><span class="space_between_date_time"> @ </span><span class='cart_time' data-time_val=""></span></p>
									</div>
									<div class="ct-summary">
										<div class="ct-image f_dis_img">
											<img src="<?php echo SITE_URL; ?>/assets/images/icon-frequency.png" alt="">
										</div>
										<p class="ct-text sel-datetime f_discount_name"></p>
									</div>
									<div class="ct-form-rown ct-addons-list-main">
										<div class="step_heading f-l"><h6 class="header6 ct-item-list"><?php echo $label_language_values['your_cart_items']; ?></h6>
										</div>
										<div class="cart-items-main f-l">
											<label class="cart_empty_msg"><?php echo $label_language_values['your_cart_is_empty']; ?></label>
											<ul class="ct-addon-items-list cart_item_listing">

											</ul>
										</div>
									</div>
									<div class="ct-form-rown">
										<div class="ct-cart-label-common ofh"><?php echo $label_language_values['sub_total']; ?></div>
										<div class="ct-cart-amount-common ofh">
											<span class="ct-sub-total cart_sub_total"></span>
										</div>
									</div>
									<?php
									$count_f_dis = $frequently_discount->readall_front();
									if (mysqli_num_rows($count_f_dis) > 0) {
										?>
										<div class="ct-form-rown freq_discount_display">
											<div class="ct-cart-label-common ofh"><?php echo ucwords(strtolower($label_language_values['frequently_discount'])); ?></div>
											<div class="ct-cart-amount-common ofh">
												<span class="ct-frequently-discount frequent_discount"></span>
											</div>
										</div>
									<?php
									}
									?>
									<?php
									if ($settings->get_option('ct_show_coupons_input_on_checkout') == 'on') {
										?>
										<div class="ct-form-rown coupon_display">
											<div class="ct-cart-label-common ofh"><?php echo $label_language_values['coupon_discount']; ?></div>
											<div class="ct-cart-amount-common ofh">
												<span class="ct-coupon-discount cart_discount"></span>
											</div>
										</div>
									<?php
									}
									?>
									<?php
									if ($settings->get_option('ct_tax_vat_status') == 'Y') {
										?>
										<div class="ct-form-rown">
											<div class="ct-cart-label-common ofh"><?php echo $label_language_values['tax']; ?></div>
											<div class="ct-cart-amount-common ofh">
												<span class="ct-tax-amount cart_tax"></span>
											</div>
										</div>
									<?php
									}
									?>
									<div class="ct-clear"></div>
									<div id="ct-line"></div>
									<div class="ct-form-rown">
										<div class="ct-cart-label-total-amount ofh"><?php echo $label_language_values['total']; ?></div>
										<div class="ct-cart-total-amount ofh">
											<span class="ct-total-amount cart_total"></span>
										</div>
									</div>

									<div class="ct-clear"></div>
									<!-- discount coupons -->
								</div>
								<!-- cart wrapper end here -->


							</div>
						</div>
					</div><!-- booking details -->
				</div>
				
                
            </div>
            <!-- left side end -->
        </div>
        <!-- end container -->
    </div>
</div>
<script>
	
    var baseurlObj = {'base_url': '<?php echo BASE_URL;?>'};
    var siteurlObj = {'site_url': '<?php echo SITE_URL;?>'};
    var ajaxurlObj = {'ajax_url': '<?php echo AJAX_URL;?>'};
    var fronturlObj = {'front_url': '<?php echo FRONT_URL;?>'};
    var termsconditionObj = {'terms_condition': '<?php echo $settings->get_option('ct_allow_terms_and_conditions');?>'};
    var privacypolicyObj = {'privacy_policy': '<?php echo $settings->get_option('ct_allow_privacy_policy');?>'};
    <?php
    
	if($settings->get_option('ct_thankyou_page_url') == ''){
        $thankyou_page_url = SITE_URL.'front/thankyou.php';
    }else{
        $thankyou_page_url = $settings->get_option('ct_thankyou_page_url');
    }
	$phone = explode(",",$settings->get_option('ct_bf_phone'));
	$check_password = explode(",",$settings->get_option('ct_bf_password'));
	$check_fn = explode(",",$settings->get_option('ct_bf_first_name'));
	$check_ln = explode(",",$settings->get_option('ct_bf_last_name'));
	$check_addresss = explode(",",$settings->get_option('ct_bf_address'));
	$check_zip_code = explode(",",$settings->get_option('ct_bf_zip_code'));
	$check_city = explode(",",$settings->get_option('ct_bf_city'));
	$check_state = explode(",",$settings->get_option('ct_bf_state'));
	$check_notes = explode(",",$settings->get_option('ct_bf_notes'));
	 
    ?>
	var thankyoupageObj = {'thankyou_page': '<?php echo $thankyou_page_url;?>'};
    
	var phone_status = {'statuss' : '<?php echo $phone[0];?>','required' : '<?php echo $phone[1];?>','min' : '<?php echo $phone[2];?>','max' : '<?php echo $phone[3];?>'};  
	
    var check_password = {'statuss' : '<?php echo $check_password[0];?>','required' : '<?php echo $check_password[1];?>','min' : '<?php echo $check_password[2];?>','max' : '<?php echo $check_password[3];?>'};
    
	var check_fn = {'statuss' : '<?php echo $check_fn[0];?>','required' : '<?php echo $check_fn[1];?>','min' : '<?php echo $check_fn[2];?>','max' : '<?php echo $check_fn[3];?>'};
    
	var check_ln = {'statuss' : '<?php echo $check_ln[0];?>','required' : '<?php echo $check_ln[1];?>','min' : '<?php echo $check_ln[2];?>','max' : '<?php echo $check_ln[3];?>'};
    
	var check_addresss = {'statuss' : '<?php echo $check_addresss[0];?>','required' : '<?php echo $check_addresss[1];?>','min' : '<?php echo $check_addresss[2];?>','max' : '<?php echo $check_addresss[3];?>'};
    
	var check_zip_code = {'statuss' : '<?php echo $check_zip_code[0];?>','required' : '<?php echo $check_zip_code[1];?>','min' : '<?php echo $check_zip_code[2];?>','max' : '<?php echo $check_zip_code[3];?>'};
    
	var check_city = {'statuss' : '<?php echo $check_city[0];?>','required' : '<?php echo $check_city[1];?>','min' : '<?php echo $check_city[2];?>','max' : '<?php echo $check_city[3];?>'};
    
	var check_state = {'statuss' : '<?php echo $check_state[0];?>','required' : '<?php echo $check_state[1];?>','min' : '<?php echo $check_state[2];?>','max' : '<?php echo $check_state[3];?>'};
	
	var check_notes = {'statuss' : '<?php echo $check_notes[0];?>','required' : '<?php echo $check_notes[1];?>','min' : '<?php echo $check_notes[2];?>','max' : '<?php echo $check_notes[3];?>'}; 
    <?php
	$nacode = explode(',',$settings->get_option("ct_company_country_code"));
	$allowed = $settings->get_option("ct_phone_display_country_code");
	?>
	var countrycodeObj = {'numbercode': '<?php echo $nacode[0];?>', 'alphacode': '<?php echo $nacode[1];?>', 'countrytitle': '<?php echo $nacode[2];?>', 'allowed': '<?php echo $allowed;?>'};
 
    var subheaderObj = {'subheader_status': '<?php echo $settings->get_option('ct_subheaders');?>'};
    
	var appoint_details = {'status':'<?php echo $settings->get_option('ct_appointment_details_display');?>'};
</script>
</body>
</html>