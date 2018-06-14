<?php 
include(dirname(__FILE__).'/header-staff.php');
include(dirname(dirname(__FILE__)) ."/objects/class_payments.php");
/* include(dirname(dirname(__FILE__)) ."/objects/class_staff_commision.php"); */
include(dirname(dirname(__FILE__)) ."/admin/user_session_check.php");
/* include(dirname(__FILE__).'/admin/user_session_check.php'); */
include(dirname(dirname(__FILE__))."/objects/class_adminprofile.php");
include(dirname(dirname(__FILE__))."/objects/class_staff_commision.php");
include(dirname(dirname(__FILE__))."/objects/class_order_client_info.php");
include(dirname(dirname(__FILE__))."/objects/class_services.php");



$con = new cleanto_db();
$conn = $con->connect();
$objpayment = new cleanto_payments();
$objpayment->conn = $conn;

/* $staffpayment=new cleanto_staff_commision();
$staffpayment->conn=$conn; */


include(dirname(dirname(__FILE__)) . "/objects/class_dayweek_avail.php");
include(dirname(dirname(__FILE__)) . "/objects/class_offbreaks.php");
include(dirname(dirname(__FILE__))."/objects/class_offtimes.php");

if ( is_file(dirname(dirname(__FILE__)).'/extension/GoogleCalendar/google-api-php-client/src/Google_Client.php')) 
{
	require_once dirname(dirname(__FILE__)).'/extension/GoogleCalendar/google-api-php-client/src/Google_Client.php';
}
include(dirname(dirname(__FILE__))."/objects/class_gc_hook.php");

$gc_hook = new cleanto_gcHook();
$gc_hook->conn = $conn;

/* $staffpayment=new cleanto_staff_commision();
$staffpayment->conn=$conn; */
$obj_offtime = new cleanto_offtimes();
$obj_offtime->conn = $conn;

$objdayweek_avail = new cleanto_dayweek_avail();
$objdayweek_avail->conn = $conn;

$objoffbreaks = new cleanto_offbreaks();
$objoffbreaks->conn = $conn;

$objservices = new cleanto_services();
$objservices->conn = $conn;


/* general setting object */
$general=new cleanto_general();
$general->conn=$conn;
$settings = new cleanto_setting();
$settings->conn = $conn;
$symbol_position=$settings->get_option('ct_currency_symbol_position');
$decimal=$settings->get_option('ct_price_format_decimal_places');	

$objadmin = new cleanto_adminprofile();
$objadmin->conn=$conn;

$order_client_info = new cleanto_order_client_info();
$order_client_info->conn=$conn;

$staff_commision = new cleanto_staff_commision();
$staff_commision->conn=$conn;


$getdateformat=$settings->get_option('ct_date_picker_date_format');
$time_format = $settings->get_option('ct_time_format');
$timess = "";
if($time_format == "24"){
	$timess = "H:i";
}
else {
	$timess = "h:i A";
}

$staff_id = $_SESSION['staffid'];
?>
<div class="cta-panel-default" id="ct-staff-dashboard">
    <div class="staff-dashboard ct-left-menu col-md-3 col-sm-3 col-xs-12 col-lg-3">
        <ul class="nav nav-tab nav-stacked" id="cta-staff-nav">
			
            <li class="active"><a href="#my-schedule" class="my-schedule" data-toggle="pill"><i class="fa fa-clock-o fa-2x"></i><br /><?php echo $label_language_values['schedule'];?></a></li>
            <li><a href="#my-wallet" class="my-wallet" data-toggle="pill"><i class="fa fa-money fa-2x"></i><br /> <?php echo $label_language_values['payment'];?> </a></li>
            <li><a href="#my-bookings" class="my-bookings" data-toggle="pill"><i class="fa fa-television fa-2x"></i><br /> <?php echo $label_language_values['bookings'];?> </a></li>
            <?php 
			if($gc_hook->gc_purchase_status() == 'exist'){
				echo $gc_hook->gc_setting_menu_hook();
			}
			?>
			<li><a href="#my-profile" class="my-profile" data-toggle="pill"><i class="fa fa-user fa-2x"></i><br /> <?php echo $label_language_values['profile'];?> </a></li>
            <li><a id="logout" href="javascript:void(0)"><i class="fa fa-power-off fa-2x"></i><br /><span><?php echo $label_language_values['logout'];?></span></a></li>
        </ul>
    </div>
    <div class="panel-body">
		<div class="tab-content staff-right-content col-md-9 col-sm-9 col-lg-9 col-xs-12">
			<div class="tab-pane fade in active" id="my-schedule">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h1 class="panel-title text-left"><?php echo $label_language_values['schedule'];?></h1>
					</div>
					<div class="panel-body mt-30">
						<ul class="nav nav-tabs nav-justified ct-staff-right-menu">
							<li class="active"><a href="#member-details" data-toggle="tab"><?php echo $label_language_values['view_slots_by'];?></a></li>
							<li><a href="#member-availabilty" class="availability" data-toggle="tab"><?php echo $label_language_values['availabilty'];?></a></li>
							<li><a href="#member-addbreaks" data-toggle="tab"><?php echo $label_language_values['add_breaks'];?></a></li>
							<li><a href="#member-offtime" data-toggle="tab" class="myoff_timeslink"><?php echo $label_language_values['off_time'];?></a></li>
							<li><a href="#member-offdays" data-toggle="tab"><?php echo $label_language_values['off_days'];?></a></li>
						</ul>
<div class="tab-pane active"> <!-- first staff nmember -->
	<div class="container-fluid tab-content ct-staff-right-details">
		<div class="tab-pane col-lg-12 col-md-12 col-sm-12 col-xs-12 active" id="member-details">
						<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
							<table class="ct-staff-common-table">
								<tbody>
								<tr>
									<td><label for="phone-number"><?php echo $label_language_values['schedule_type'];?></label></td>
									<td>
										<label for="schedule-type1">
											<?php
					$staff_id = $_SESSION['staffid'];
                    $option = $objdayweek_avail->get_schedule_type_according_provider($staff_id);
											?>
											<input class='weekly_monthly_slots' data-toggle="toggle" data-size="small" type='checkbox' id="schedule-type1" <?php if ($option[7] == "monthly"){ ?> checked <?php } ?> data-on="<?php echo $label_language_values['monthly'];?>" data-off="<?php echo $label_language_values['weekly'];?>" data-onstyle='info' data-offstyle='warning' />
										 </label>
									</td>
								</tr>
								<tr>
<td><span class="login_user_id" id="login_user_id" data-id="<?php echo $_SESSION['staffid']; ?>"></td>
								</tr>
								</tbody>
							</table>
						</div>
					
					
					</div>
<div class="tab-pane member-availabilty myloadedslots" id="member-availabilty">
	<?php
	$staff_id = $_SESSION['staffid'];
    $option = $objdayweek_avail->get_schedule_type_according_provider($staff_id);
	$weeks = $objdayweek_avail->get_dataof_week();
	
	$weekname = array($label_language_values['first'],$label_language_values['second'],$label_language_values['third'],$label_language_values['fourth'],$label_language_values['fifth']);
					
	$weeknameid = array($label_language_values['first_week'], $label_language_values['second_week'], $label_language_values['third_week'], $label_language_values['fourth_week'], $label_language_values['fifth_week']);
	if($option[7]=='monthly'){
		$minweek=1;
		$maxweek=5;
	}elseif($option[7]=='weekly'){
		$minweek=1;
		$maxweek=1;
	}else{
		$minweek=1;
		$maxweek=1;
	}
	
	$time_interval = 30;
	?>
	<form id="" method="POST">
		<div class="panel panel-default">
			<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 ct-weeks-schedule-menu">
				<ul class="nav nav-pills nav-stacked">
					<?php
					if($minweek==1 && $maxweek==5){
						for($i=$minweek;$i<=$maxweek;$i++){
							?>
							<li class="<?php if($i==1){ echo "active";}?>"><a href="#<?php echo $weeknameid[$i-1];?>" data-toggle="tab"><?php echo $weeknameid[$i-1];?> </a></li>
						<?php
						}
					}else{ $i=1;?>
						<li class="<?php if($i==1){ echo "active";}?>"><a href="#<?php echo $weeknameid[$i-1];?>" data-toggle="tab"><?php echo $label_language_values['this_week'];?></a></li>
					<?php
					}
					?>
				</ul>
			</div>
			<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12">
				<hr id="vr"/>
<div class="tab-content">
<span class="prove_schedule_type" style="visibility: hidden;"><?php echo $option[7]; ?></span>
<?php

for ($i = $minweek; $i <= $maxweek; $i++) {
	?>
	<div class="tab-pane <?php if($i==1 ){ echo "active";}?>" id="<?php echo $weeknameid[$i - 1];?>">
		<div class="panel panel-default">
			<div class="panel-body">
				<?php if($minweek==1 && $maxweek==1){ ?>
					<h4 class="ct-right-header"><?php echo $label_language_values['this_week_time_scheduling'];?></h4>
				<?php
				}else{
					?>
					<h4 class="ct-right-header"><?php echo $weekname[$i-1];?><?php echo " ".$label_language_values['week_time_scheduling'];?></h4>
				<?php }?>
				<ul class="list-unstyled" id="ct-staff-timing">
					<?php
					
$staff_id = $_SESSION['staffid'];
					for ($j = 1; $j <= 7; $j++) {
						$objdayweek_avail->week_id = $i;
						$objdayweek_avail->weekday_id = $j;
						$getvalue = $objdayweek_avail->get_time_slots($staff_id);
						$daystart_time = $getvalue[4];
						$dayend_time = $getvalue[5];
						$offdayst = $getvalue[6];
						?>
						<li class="active">
						<span
							class="col-sm-3 col-md-3 col-lg-3 col-xs-12 ct-day-name"><?php echo  $label_language_values[strtolower($objdayweek_avail->get_daynamebyid($j))]; ?></span>
					<span class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
						<label class="cta-col2" for="ct-monFirst<?php echo $i; ?><?php echo $j; ?>_<?php echo $getvalue[0]; ?>">
							   
							<input class='chkdaynew' data-toggle="toggle" data-size="small" type='checkbox' id="ct-monFirst<?php echo $i; ?><?php echo $j; ?>_<?php echo $getvalue[0]; ?>" <?php if ($getvalue[6] == 'Y' || $getvalue[6] == '') { echo ""; } else { echo "checked"; } ?> data-on="<?php echo $label_language_values['o_n'];?>" data-off="<?php echo $label_language_values['off'];?>" data-onstyle='primary' data-offstyle='default' />
						
						</label>
					</span>
					<span
						class="col-sm-7 col-md-7 col-lg-7 col-xs-12 ct-staff-time-schedule">
						<div class="pull-right">
							<select class="selectpicker starttimenew" data-aid="<?php echo $i;?>_<?php echo $j;?>" id="starttimenews_<?php echo $i;?>_<?php echo $j;?>" data-size="10"
									style="display: none;">
								<?php
								$min = 0;
								$t = 1;
								while ($min < 1440) {
									if ($min == 1440) {
										$timeValue = date('G:i', mktime(0, $min - 1, 0, 1, 1, 2015));
									} else {
										$timeValue = date('G:i', mktime(0, $min, 0, 1, 1, 2015));
									}
									$timetoprint = date('G:i', mktime(0, $min, 0, 1, 1, 2014)); ?>
									<option <?php
									if ($getvalue[4] == date("H:i:s", strtotime($timeValue))) {
										$t= 10;
										echo "selected";
									}
									if($t==1) {
										if ("10:00:00" == date("H:i:s", strtotime($timeValue))) {
											echo "selected";
										}
									}
									?> value="<?php echo date("H:i:s", strtotime($timeValue)); ?>">
										<?php
										if ($time_format == 24) {
											echo date("H:i", strtotime($timetoprint));
										} else {
											echo date("h:i A", strtotime($timetoprint));
										}
										?>
									</option>
									<?php
									$min = $min + $time_interval;
								}
								?>
							</select>
							<span class="ct-staff-hours-to"> <?php echo $label_language_values['to'];?> </span>
							<select class="selectpicker endtimenew" data-aid="<?php echo $i;?>_<?php echo $j;?>" data-size="10" id="endtimenews_<?php echo $i;?>_<?php echo $j;?>"
									style="display: none;">
								<?php
								$min = 0;
								$t = 1;
								while ($min < 1440) {
									if ($min == 1440) {
										$timeValue = date('G:i', mktime(0, $min - 1, 0, 1, 1, 2015));
									} else {
										$timeValue = date('G:i', mktime(0, $min, 0, 1, 1, 2015));
									}
									$timetoprint = date('G:i', mktime(0, $min, 0, 1, 1, 2014)); ?>
									<option <?php
									if ($getvalue[5] == date("H:i:s", strtotime($timeValue))) {
										$t = 10;
										echo "selected";
									}
									if($t==1) {
										if ("20:00:00" == date("H:i:s", strtotime($timeValue))) {
											echo "selected";
										}
									}
									?>
										value="<?php echo date("H:i:s", strtotime($timeValue)); ?>">
										<?php
										if ($time_format == 24) {
											echo date("H:i", strtotime($timetoprint));
										} else {
											echo date("h:i A", strtotime($timetoprint));
										}
										?>
									</option>
									<?php
									$min = $min + $time_interval;
								}
								?>
							</select>
						</div>
			</span>
						</li>
					<?php }
					?>
				</ul>
			</div>
		</div>
	</div>
<?php
}
?>
</div>
			</div>
		</div>
		<table class="ct-staff-common-table">
			<tbody>
			<tr>
				<td></td>
				<td>
					<a id="" value="" name="update_schedule"
					   class="btn btn-success ct-btn-width btnupdatenewtimeslots_monthly"
					   type="submit"><?php echo $label_language_values['save_availability'];?>
					</a>
				</td>
			</tr>
			</tbody>
		</table>
	</form>
</div>
	<div class="tab-pane member-addbreaks" id="member-addbreaks">
	<div class="panel panel-default">
		<div class="panel-body">
			<?php
			$breaks_weekname = array($label_language_values['first'],$label_language_values['second'],$label_language_values['third'],$label_language_values['fourth'],$label_language_values['fifth']);
			
			$breaks_weeknameid = array($label_language_values['first_week'], $label_language_values['second_week'], $label_language_values['third_week'], $label_language_values['fourth_week'], $label_language_values['fifth_week']);
			if($option[7]=='monthly'){
				$minweek=1;
				$maxweek=5;
			}elseif($option[7]=='weekly'){
				$minweek=1;
				$maxweek=1;
			}else{
				$minweek=1;
				$maxweek=1;
			}
			?>
			<!-- Start here -->
			<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 ct-weeks-breaks-menu">
				<ul class="nav nav-pills nav-stacked">
					<?php
					if($minweek==1 && $maxweek==5){
						for($i=$minweek;$i<=$maxweek;$i++){
							?>
							<li class="<?php if($i==1){ echo "active";}?>"><a href="#<?php echo $breaks_weeknameid[$i-1]."_br";?>" data-toggle="tab"><?php echo $breaks_weeknameid[$i-1];?> </a></li>
						<?php
						}
					}else{
						$i=1;
						?>
						<li class="<?php if($i==1){ echo "active";}?>"><a href="#<?php echo $breaks_weeknameid[$i-1]."_br";?>" data-toggle="tab"><?php echo $label_language_values['this_week'];?></a></li>
					<?php
					}
					?>
				</ul>
			</div>
			<div class="col-sm-9 col-md-9 col-lg-9 col-xs-12 ct-weeks-breaks-details">
				<div class="tab-content">
					<?php
					$breaks_weekname = array($label_language_values['first'],$label_language_values['second'],$label_language_values['third'],$label_language_values['fourth'],$label_language_values['fifth']);
					
					$breaks_weeknameid = array($label_language_values['first_week'], $label_language_values['second_week'], $label_language_values['third_week'], $label_language_values['fourth_week'], $label_language_values['fifth_week']);
					?>
					<?php
					for($i=$minweek;$i<=$maxweek;$i++)
					{
						?>
						<div class="tab-pane <?php if($i==1){ echo "active";}?>" id="<?php echo $breaks_weeknameid[$i-1]."_br";?>">
							<div class="panel panel-default">
								<div class="panel-body">
									<?php if($minweek==1 && $maxweek==1){ ?>
										<h4 class="ct-right-header"><?php echo $label_language_values['this_week_breaks'];?> </h4>
									<?php }else{ ?>
										<h4 class="ct-right-header"><?php echo $breaks_weekname[$i-1];?><?php echo $label_language_values['week_breaks'];?> </h4>
									<?php } ?>
									<ul class="list-unstyled" id="ct-staff-breaks">
										<?php
										$staff_id = $_SESSION['staffid'];
										for ($j = 1; $j <= 7; $j++) {
											$break_weekday = $j;
											$objdayweek_avail->week_id=$i;
											$objdayweek_avail->weekday_id=$j;
											$getdatafrom_week_days = $objdayweek_avail->getdata_byweekid($staff_id);
											?>
											<li class="active">
												<span class="col-sm-3 col-md-3 col-lg-3 col-xs-12 ct-day-name"><?php echo  $label_language_values[strtolower($objdayweek_avail->get_daynamebyid($j))]; ?></span>
												<?php
												if($getdatafrom_week_days[0] == 'Y' || $getdatafrom_week_days[0] == '')
												{
													?>
													<span class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
												<a class="btn btn-small btn-default ct-small-br-btn disabled"><?php echo $label_language_values['closed'];?></a>
											</span>
												<?php
												}
												else
												{?>
													<span class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
	<a id="ct-add-staff-breaks" data-staff_id="<?php echo $_SESSION['staffid']; ?>" data-weekid="<?php echo $i;?>" data-weekday="<?php echo $j;?>"
	   class="btn btn-small btn-success ct-small-br-btn myct-add-staff-breaks" data-id="<?php echo $i;?>_<?php echo $j;?>"><?php echo $label_language_values['add_break'];?></a>
											</span>
												<?php   }
												?>
												<span
													class="col-sm-7 col-md-7 col-lg-7 col-xs-12 ct-staff-breaks-schedule">
												<ul class="list-unstyled" id="ct-add-break-ul<?php echo $i;?>_<?php echo $j;?>">
													<?php
													$staff_id = $_SESSION['staffid'];
													$objoffbreaks->week_id = $i;
													$objoffbreaks->weekday_id = $j;
													$jc = $objoffbreaks->getdataby_week_day_id($staff_id);
													while($rrr = mysqli_fetch_array($jc)){
														?>
														<li>
															<select class="selectpicker selectpickerstart" id="start_break_<?php echo $rrr['id'];?>_<?php echo $rrr['week_id'];?>_<?php echo $rrr['weekday_id'];?>" data-id="<?php echo $rrr['id'];?>" data-weekid="<?php echo $rrr['week_id'];?>" data-weekday="<?php echo $rrr['weekday_id'];?>" data-size="10"
																	style="">
																<?php
																$min = 0;
																while ($min < 1440) {
																	if ($min == 1440) {
																		$timeValue = date('G:i', mktime(0, $min - 1, 0, 1, 1, 2015));
																	} else {
																		$timeValue = date('G:i', mktime(0, $min, 0, 1, 1, 2015));
																	}
																	$timetoprint = date('G:i', mktime(0, $min, 0, 1, 1, 2014)); ?>
																	<option <?php if ($rrr['break_start'] == date("H:i:s", strtotime($timeValue))) {
																		echo "selected";
																	} ?>
																		value="<?php echo date("H:i:s", strtotime($timeValue)); ?>">
																		<?php
																		if ($time_format == 24) {
																			echo date("H:i", strtotime($timetoprint));
																		} else {
																			echo date("h:i A", strtotime($timetoprint));
																		}
																		?>
																	</option>
																	<?php
																	$min = $min + $time_interval;
																}
																?>
															</select>
															<span class="ct-staff-hours-to"> <?php echo $label_language_values['to'];?> </span>
															<select class="selectpicker selectpickerend" data-id="<?php echo $rrr['id'];?>" data-weekid="<?php echo $rrr['week_id'];?>" data-weekday="<?php echo $rrr['weekday_id'];?>" data-size="10"
																	style="display: none;">
																<?php
																$min = 0;
																while ($min < 1440) {
																	if ($min == 1440) {
																		$timeValue = date('G:i', mktime(0, $min - 1, 0, 1, 1, 2015));
																	} else {
																		$timeValue = date('G:i', mktime(0, $min, 0, 1, 1, 2015));
																	}
																	$timetoprint = date('G:i', mktime(0, $min, 0, 1, 1, 2014)); ?>
																	<option <?php if ($rrr['break_end'] == date("H:i:s", strtotime($timeValue))) {
																		echo "selected";
																	} ?>
																		value="<?php echo date("H:i:s", strtotime($timeValue)); ?>">
																		<?php
																		if ($time_format == 24) {
																			echo date("H:i", strtotime($timetoprint));
																		} else {
																			echo date("h:i A", strtotime($timetoprint));
																		}
																		?>
																	</option>
																	<?php
																	$min = $min + $time_interval;
																}
																?>
															</select>
															<button id="ct-delete-staff-break<?php echo $rrr['id'];?>_<?php echo $i;?>_<?php echo $j;?>" data-wiwdibi='<?php echo $rrr['id'];?>_<?php echo $i;?>_<?php echo $j;?>' data-break_id="<?php echo $rrr['id'];?>" class="pull-right btn btn-circle btn-default delete_break" rel="popover" data-placement='left' title="<?php echo $label_language_values['are_you_sure'];?>?"> <i class="fa fa-trash"></i></button>
															<div id="popover-delete-breaks<?php echo $rrr['id'];?>_<?php echo $i;?>_<?php echo $j;?>" style="display: none;">
																<div class="arrow"></div>
																<table class="form-horizontal" cellspacing="0">
																	<tbody>
																	<tr>
																		<td>
																			<button id="" value="Delete" data-break_id='<?php echo  $rrr['id'];?>' class="btn btn-danger mybtndelete_breaks" type="submit"><?php echo $label_language_values['yes'];?></button>
																			<button id="ct-close-popover-delete-breaks" class="btn btn-default close_popup" href="javascript:void(0)"><?php echo $label_language_values['cancel'];?></button>
																		</td>
																	</tr>
																	</tbody>
																</table>
															</div>
														</li>
													<?php  }
													?>
												</ul>
											</li>
										<?php }
										?>
									</ul>
								</div>
							</div>
						</div>
					<?php
					}
					?>
				</div>
				<!-- end tab content main right -->
			</div> <!-- End Here -->
		</div>
	</div>
</div>
<div class="tab-pane member-offtime" id="member-offtime">
<div class="panel panel-default">
<div class="panel-body">
	<div class="ct-member-offtime-inner">
		<h3><?php echo $label_language_values['add_your_off_times'];?></h3>
		<div class="col-md-6 col-sm-7 col-xs-12 col-lg-6 mb-10">
			<label><?php echo $label_language_values['add_new_off_time'];?></label>
			<div id="offtime-daterange" class="form-control">
				<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
				<span></span> <i class="fa fa-caret-down"></i>
			</div>
		</div>
		<div class="col-md-2 col-sm-2 col-xs-12 col-lg-2">
			<a href="javascript:void(0)" id="add_break" class="form-group btn btn-info mt-20" name=""><?php echo $label_language_values['add_break'];?> </a>
		</div>
	</div>
											<div class="ct-staff-member-offtime-list-main mytablefor_offtimes cb col-md-12 col-xs-12">
												<?php echo $label_language_values['your_added_off_times'];?>
												<div class="table-responsive">
													<table id="ct-staff-member-offtime-list"
														   class="ct-staff-member-offtime-lists table table-striped table-bordered dt-responsive nowrap myadded_offtimes"
														   cellspacing="0" width="100%">
														<thead>
														<tr>
															<th>#</th>
															<th><?php echo $label_language_values['start_date'];?></th>
															<th><?php echo $label_language_values['start_time'];?></th>
															<th><?php echo $label_language_values['end_date'];?></th>
															<th><?php echo $label_language_values['end_time'];?></th>
															<th><?php echo $label_language_values['action'];?></th>
														</tr>
														</thead>
														<tbody class="mytbodyfor_offtimes">
														<?php
																								$staff_id = $_SESSION['staffid'];
														$res = $obj_offtime->get_all_offtimes($staff_id);
														$i=1;
														while($r = mysqli_fetch_array($res))
														{
															$st = $r['start_date_time'];
															$stt = explode(" ", $st);
															$sdates = $stt[0];
															$stime = $stt[1];
															$et = $r['end_date_time'];
															$ett = explode(" ", $et);
															$edates = $ett[0];
															$etime = $ett[1];
															?>
															<tr id="myofftime_<?php echo $r['id']?>">
																<td><?php echo $i++;?></td>
																<td><?php echo 
											str_replace($english_date_array,$selected_lang_label,date($getdateformat,strtotime($sdates))); ?></td>
																<?php
																if($time_format == 12){
																	?>
																	<td><?php echo date("h:i A",strtotime($stime));?></td>
																<?php
																}else{
																	?>
																	<td><?php echo date("H:i",strtotime($stime));?></td>
																<?php
																}
																?>
																<td><?php echo 
											str_replace($english_date_array,$selected_lang_label,date($getdateformat,strtotime($edates))); ?></td>
																<?php
																if($time_format == 12){
																	?>
																	<td><?php echo date("h:i A",strtotime($etime));?></td>
																<?php
																}else{
																	?>
																	<td><?php echo date("H:i",strtotime($etime));?></td>
																<?php
																}
																?>
																<td><a data-id="<?php echo $r['id'];?>" class='btn btn-danger ct_delete_provider left-margin'><span
																			class='glyphicon glyphicon-remove'></span></a></td>
															</tr>
														<?php
														}
														?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
		
									<div class="tab-pane member-offdays" id="member-offdays">
									<div class="panel panel-default">
										<?php
										$offday->user_id=$_SESSION['staffid'];
										$displaydate=$offday->select_date();
										$arr_all_off_day=array();
										while($readdate=mysqli_fetch_array($displaydate))
										{
											$arr_all_off_day[]=$readdate['off_date'];
										}
										$year_arr = array(date('Y'),date('Y')+1);
										$month_num=date('n');
										if(isset($_GET['y']) && in_array($_GET['y'],$year_arr)) {
											$year = $_GET['y'];
										} else {
											$year=date('Y');
										}
										$nextYear = date('Y')+1;
										$date=date('d');
										$month=array(ucfirst(strtolower($label_language_values['january'])),
				ucfirst(strtolower($label_language_values['february'])),
				ucfirst(strtolower($label_language_values['march'])),
				ucfirst(strtolower($label_language_values['april'])),
				ucfirst(strtolower($label_language_values['may'])),
				ucfirst(strtolower($label_language_values['june'])),
				ucfirst(strtolower($label_language_values['july'])),
				ucfirst(strtolower($label_language_values['august'])),
				ucfirst(strtolower($label_language_values['september'])),
				ucfirst(strtolower($label_language_values['october'])),
				ucfirst(strtolower($label_language_values['november'])),
				ucfirst(strtolower($label_language_values['december'])));
										echo '<table class="offdaystable">';
									   
										echo '<tr>';
										for ($reihe=1; $reihe<=12; $reihe++) { /* 4 */
											$this_month=($reihe-1)*0+$reihe; /*write 0 instead of 12*/
	$current_year = date('Y');
$currnt_month = date('m');
if(($currnt_month < $this_month) || ($currnt_month == $this_month)){
		$year = $current_year;
}else{
	 $year = $current_year + 1;
}												
											$erster=date('w',mktime(0,0,0,$this_month,1,$year));
											$insgesamt=date('t',mktime(0,0,0,$this_month,1,$year));
											if($erster==0) $erster=7;
											echo '<td class="ct-calendar-box col-lg-4 col-md-4 col-sm-6 col-xs-12 pull-left">';
											echo '<table align="center" class="table table-bordered table-striped monthtable">';?>
											<tbody class="ta-c">
											<div class="ct-schedule-month-name pull-right">
												<div class="pull-left">
													<div class="ct-custom-checkbox">
														<ul class="ct-checkbox-list">
															<li>
																<input style="margin:0px;" type="checkbox"  class="fullmonthoff all" data-prov_id="<?php echo $_SESSION['staffid']; ?>" id="<?php echo $year.'-'.$this_month;?>" <?php  $offday->off_year_month=$year.'-'.$this_month;
																if($offday->check_full_month_off()==true) { echo " checked "; }  ?> />
																<label for="<?php echo $year.'-'.$this_month;?>"><span></span>
															<?php echo $month[$reihe-1]." ".$year;?>
																</label>
															</li>
														</ul>
													</div>
												</div>
											</div>
											</tbody>
											<?php
											echo '<tr><td><b>'.$label_language_values['mon'].'</b></td><td><b>'.$label_language_values['tue'].'</b></td>';
											echo '<td><b>'.$label_language_values['wed'].'</b></td><td><b>'.$label_language_values['thu'].'</b></td>';
											echo '<td><b>'.$label_language_values['fri'].'</b></td><td class="sat"><b>'.$label_language_values['sat'].'</b></td>';
											echo '<td class="sun"><b>'.$label_language_values['sun'].'</b></td></tr>';
											echo '<tr class="dateline selmonth_'.$year.'-'.$this_month.'"><br>';
											$i=1;
											while ($i<$erster) {
												echo '<td> </td>';
												$i++;
											}
											$i=1;
											while ($i<=$insgesamt) {
												$rest=($i+$erster-1)%7;
												$cal_cur_date =  $year."-".sprintf('%02d', $this_month)."-".sprintf('%02d', $i);
												if (($i==$date) && ($this_month==$month_num)) {
													if(isset($arr_all_off_day)  && in_array($cal_cur_date, $arr_all_off_day)) {
														echo '<td  id="'.$year.'-'.$this_month.'-'.$i.'" data-prov_id="'.$_SESSION['staffid'].'" class="selectedDate RR offsingledate"  align=center >';
													} else {
														echo '<td  id="'.$year.'-'.$this_month.'-'.$i.'" data-prov_id="'.$_SESSION['staffid'].'"  class="date_single RR offsingledate"  align=center>';
													}
												} else {
													if(isset($arr_all_off_day)  &&  in_array($cal_cur_date, $arr_all_off_day)) {
														echo '<td  id="'.$year.'-'.$this_month.'-'.$i.'"  data-prov_id="'.$_SESSION['staffid'].'"  class="selectedDate RR offsingledate highlight"  align=center>';
													} else {
														echo '<td  id="'.$year.'-'.$this_month.'-'.$i.'" data-prov_id="'.$_SESSION['staffid'].'" class="date_single RR offsingledate"  align=center>';
													}
												}
												if (($i==$date) && ($this_month==$month_num)) {
													echo '<span style="color:#000;font-weight: bold;font-size: 15px;">'.$i.'</span>';
												}	else if ($rest==6) {
													echo '<span   style="color:#0000cc;">'.$i.'</span>';
												} else if ($rest==0) {
													echo '<span  style="color:#cc0000;">'.$i.'</span>';
												} else {
													echo $i;
												}
												echo "</td>\n";
												if ($rest==0) echo "</tr>\n<tr class='dateline selmonth_".$year."-".$this_month."'>\n";
												$i++;
											}
											echo '</tr>';
											echo '</tbody>';
											echo '</table>';
											echo '</td>';
										}
										echo '</tr>';
										/*  } */
										echo '</table>';
										?>
									</div>
								</div>
	</div>
</div>
</div>	
</div>	
</div>	
			
            <div class="tab-pane fade" id="my-wallet">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h1 class="panel-title text-left"><?php echo $label_language_values['payment'];?></h1>
					</div>
					<div class="panel-body mt-30">
						<div class="table-responsive get_payment_staff_by_date_append">
							<table id="staff-payments-details" class="display responsive nowrap table table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>#</th>
										<th><?php echo $label_language_values['payment_method'];?></th>
										<th><?php echo $label_language_values['payment_date'];?></th>
										<th><?php echo $label_language_values['amount'];?></th>
										<th><?php echo $label_language_values['advance_paid'];?></th>
										<th><?php echo $label_language_values['net_total'];?></th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$readall_ct_staff_commision = $staff_commision->get_booking_assign($staff_id);
									
									if(mysqli_num_rows($readall_ct_staff_commision) >0){
										$i=1;
										while($row = mysqli_fetch_array($readall_ct_staff_commision)){
											?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?php echo $row['payment_method']; ?></td>
												<td><?php echo str_replace($english_date_array,$selected_lang_label,date($getdateformat,strtotime($row['payment_date'])));?></td>
												<td><?php echo  $general->ct_price_format($row['amt_payable'],$symbol_position,$decimal);?></td>
												<td><?php echo  $general->ct_price_format($row['advance_paid'],$symbol_position,$decimal);?></td>
												<td><?php echo  $general->ct_price_format($row['net_total'],$symbol_position,$decimal);?></td>
											</tr>
											<?php
											$i++;
										}
									}
									?>
								</tbody>
							</table>
						</div>	
					</div>
				</div>
			</div>
			<div class="company-details tab-pane fade" id="my-bookings">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h1 class="panel-title text-left"><?php echo $label_language_values['bookings'];?></h1>
					</div>
			
					<div class="panel-body mt-30">
						<div class="table-responsive">
							<table id="staff-bookings-table" class="display responsive nowrap table table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th><?php echo $label_language_values['service'];?></th>
										<th><?php echo $label_language_values['app_date'];?></th>
										<th><?php echo $label_language_values['customer'];?></th>
										<th><?php echo $label_language_values['email'];?></th>
										<th><?php echo $label_language_values['address'];?></th>
										<th><?php echo $label_language_values['phone'];?></th><th><?php echo $label_language_values['net_total'];?></th>									
									</tr>
								</thead>
								<tbody>
									<?php 
								$staff_service_details=$staff_commision->staff_service_details($staff_id);
								if(sizeof($staff_service_details) > 0){
									foreach($staff_service_details as $arr_staff){
										$get_booking_nettotal = $staff_commision->get_booking_nettotal($staff_id, $arr_staff['order_id']);
										$service_name = $staff_commision->get_service_name($arr_staff['service_id']);
										
										$order_client_info->order_id = $arr_staff['order_id'];
										$order_client_detail = $order_client_info->readone_order_client();
										
										/* print_r($order_client_detail); */
										
										 /* echo $order_client_detail[5];  */
										
										$tem= unserialize(base64_decode($order_client_detail[5]));
										/* $tem = str_replace('\\','',$temppp); */
										if($tem['address']!="" || $tem['city']!="" || $tem['zip']!="" || $tem['state']!=""  ){ 	
											$app_address ="";
											$app_city ="";
											$app_zip ="";
											$app_state ="";
											if($tem['address']!=""){ $app_address = $tem['address']; } 
											if($tem['city']!=""){ $app_city = $tem['city']; } 
											if($tem['zip']!=""){ $app_zip = $tem['zip']; } 
											if($tem['state']!=""){ $app_state = $tem['state'] ; } 

										}
									?>
									<tr>
											<td><?php echo $service_name; ?></td>
											<td><?php echo str_replace($english_date_array,$selected_lang_label,date($getdateformat,strtotime($arr_staff['booking_date_time'])));?> <?php echo date($timess,strtotime($arr_staff['booking_date_time'])); ?></td>
											<td><?php echo $order_client_detail[2]; ?></td>
											<td><?php echo $order_client_detail[3];?></td>
											
											<td><?php echo $app_address.",".$app_city.",".$app_zip.",".$app_state;?></td>
											
											<td><?php echo $order_client_detail[4]; ?></td>
											<td><?php echo $general->ct_price_format($get_booking_nettotal,$symbol_position,$decimal); ?></td>
										</tr>
									<?php 
									}
								}
								?>
								</tbody>
							</table>
						</div>
					</div>
			
				</div>
			</div>
			
			<?php 
			if($gc_hook->gc_purchase_status() == 'exist'){
				echo $gc_hook->gc_staff_settings_menu_content_hook();
			}
			?>
			<div class="company-details tab-pane fade" id="my-profile">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h1 class="panel-title text-left"><?php echo $label_language_values['profile'];?></h1>
					</div>
			
					<div class="panel-body mt-30">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
						<div class="ct-clean-service-image-uploader">
						<?php
							$objadmin->id = $staff_id;
							$staff_read = $objadmin->readone();
						?>
						
						<?php
						if($staff_read['image']==''){
							$imagepath=SITE_URL."assets/images/user.png";
						}else{
							$imagepath=SITE_URL."assets/images/services/".$staff_read['image'];
						}
						?>
						<img data-imagename="" id="pppp<?php echo $staff_id; ?>staffimage" src="<?php echo $imagepath;?>" class="ct-clean-staff-image br-100" height="100" width="100">
						<input data-us="pppp<?php echo $staff_id; ?>" class="hide ct-upload-images" type="file" name="" id="ct-upload-imagepppp<?php echo $staff_id;?>" data-id="<?php echo $staff_id;?>" />
						<?php
						if($staff_read['image']==''){
							?>
							<label for="ct-upload-imagepppp<?php echo $staff_id; ?>" class="ct-clean-staff-img-icon-label old_cam_ser<?php echo $staff_id; ?>">
								<i class="ct-camera-icon-common br-100 fa fa-camera" id="pcls<?php echo $staff_id; ?>camera"></i>
								<i class="pull-left fa fa-plus-circle fa-2x" id="ctsc<?php echo $staff_id; ?>plus"></i>
							</label>
						<?php
						}
						?>
						
						<label for="ct-upload-imagepppp<?php echo $staff_id; ?>" class="ct-clean-staff-img-icon-label new_cam_ser ser_cam_btn<?php echo $staff_id; ?>" id="ct-upload-imagepppp<?php echo $staff_id; ?>" style="display:none;">
							<i class="ct-camera-icon-common br-100 fa fa-camera" id="pppp<?php echo $staff_id; ?>camera"></i>
							<i class="pull-left fa fa-plus-circle fa-2x" id="ctsc<?php echo $staff_id; ?>plus"></i>
						</label>
						<?php
						if( $staff_read['image'] !==''){
							?>
							<a id="ct-remove-staff-imagepppp<?php echo $staff_id; ?>" data-pclsid="<?php echo $staff_id; ?>" data-staff_id="<?php echo $staff_id; ?>" class="delete_staff_image pull-left br-100 btn-danger bt-remove-staff-img btn-xs ser_new_del<?php echo $staff_id; ?>" rel="popover" data-placement='left' title="<?php echo $label_language_values['remove_image'];?>"> <i class="fa fa-trash" title="<?php echo $label_language_values['remove_service_image'];?>"></i></a>
						<?php
						}
						?>
					   <label><b class="error-service error_image" style="color:red;"></b></label>
						<div id="popover-ct-remove-staff-imagepppp<?php echo $staff_id; ?>" style="display: none;">
							<div class="arrow"></div>
							<table class="form-horizontal" cellspacing="0">
								<tbody>
								<tr>
									<td>
										<a href="javascript:void(0)" id="staff_del_images" value="Delete" data-staff_id="<?php echo $staff_id; ?>" class="btn btn-danger btn-sm" type="submit"><?php echo $label_language_values['yes'];?></a>
										<a href="javascript:void(0)" id="ct-close-popover-staff-image" class="btn btn-default btn-sm" href="javascript:void(0)"><?php echo $label_language_values['cancel'];?></a>
									</td>
								</tr>
								</tbody>
							</table>
						</div><!-- end pop up -->
					</div>
					<div id="ct-image-upload-popuppppp<?php echo $staff_id; ?>" class="ct-image-upload-popup modal fade" tabindex="-1" role="dialog">
						<div class="vertical-alignment-helper">
							<div class="modal-dialog modal-md vertical-align-center">
								<div class="modal-content">
									<div class="modal-header">
										<div class="col-md-12 col-xs-12">
											<a data-staff_id="<?php echo $staff_id; ?>" data-us="pppp<?php echo $staff_id; ?>" class="btn btn-success ct_upload_img_staff" data-imageinputid="ct-upload-imagepppp<?php echo $staff_id; ?>" data-id="<?php echo $staff_id; ?>"><?php echo $label_language_values['crop_and_save'];?></a>
											<button type="button" class="btn btn-default hidemodal" data-dismiss="modal" aria-hidden="true"><?php echo $label_language_values['cancel'];?></button>
										</div>
									</div>
									<div class="modal-body">
										<img id="ct-preview-imgpppp<?php echo $staff_id; ?>" style="width: 100%;"  />
									</div>
									<div class="modal-footer">
										<div class="col-md-12 np">
											<div class="col-md-12 np">
												<div class="col-md-4 col-xs-12">
													<label class="pull-left"><?php echo $label_language_values['file_size'];?></label> <input type="text" class="form-control" id="ppppfilesize<?php echo $staff_id; ?>" name="filesize" />
												</div>
												<div class="col-md-4 col-xs-12">
													<label class="pull-left">H</label> <input type="text" class="form-control" id="pppp<?php echo $staff_id; ?>h" name="h" />
												</div>
												<div class="col-md-4 col-xs-12">
													<label class="pull-left">W</label> <input type="text" class="form-control" id="pppp<?php echo $staff_id; ?>w" name="w" />
												</div>
												<!-- hidden crop params -->
												<input type="hidden" id="pppp<?php echo $staff_id; ?>x1" name="x1" />
												<input type="hidden" id="pppp<?php echo $staff_id; ?>y1" name="y1" />
												<input type="hidden" id="pppp<?php echo $staff_id; ?>x2" name="x2" />
												<input type="hidden" id="pppp<?php echo $staff_id; ?>y2" name="y2" />
												<input type="hidden" id="pppp<?php echo $staff_id; ?>id" name="id" value="<?php echo $staff_id; ?>" />
												<input id="ppppctimage<?php echo $staff_id; ?>" type="hidden" name="ctimage" />
												<input type="hidden" id="recordid" value="<?php echo $staff_id; ?>">
												<input type="hidden" id="pppp<?php echo $staff_id; ?>ctimagename" class="ppppimg" name="ctimagename" value="<?php echo $staff_read['image'];?>" />
												<input type="hidden" id="pppp<?php echo $staff_id; ?>newname" value="staff_" />
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
						
						</div>
						
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<form id="staff_update_details">
								<table class="ct-staff-common-table">
									
									<tbody>
									<tr>
										<td><label for="ct-member-name"><?php echo $label_language_values['name'];?> </label></td>
										<td><input type="text" class="form-control" id="ct-member-name" value="<?php echo $staff_read[3]; ?>" name="u_member_name" /></td>
									</tr>
									<tr>
										<td><label for="ct-member-name"><?php echo $label_language_values['email'];?></label></label></td>
										<td><input type="text" class="form-control" id="ct-member-email" readonly value="<?php echo $staff_read[2]; ?>" name="" /></td>
									</tr>
									
									<tr>
										<td><label for="ct-member-desc"><?php echo $label_language_values['description'];?></label></label></td>
										<td><textarea class="form-control" id="ct-member-desc" name="ct-member-desc" ><?php echo $staff_read[11]; ?></textarea></td>
									</tr>
									<tr>
										<td><label for="phone-number"><?php echo $label_language_values['phone'];?> </label></td>
										<td><input type="tel" class="form-control" id="phone-number" name="phone-number" value="<?php echo $staff_read[4]; ?>" /></td>
									</tr>
									
									<tr>
										<td><label for="address"><?php echo $label_language_values['address'];?></label></td>
										<td><div class="form-group">
												<input type="text" class="form-control" name="ct-member-address" id="ct-member-address" placeholder="Member Street Address" value="<?php echo $staff_read[5]; ?>" />
											</div>
										</td>
									<tr>	
										<td></td>
											<td><div class="form-group fl w100">
												<div class="cta-col6 ct-w-50 mb-6">
													<label for="city"><?php echo $label_language_values['city'];?></label>
													<input class="form-control value_city" id="ct-member-city" name="ct-member-city" value="<?php echo $staff_read[6]; ?>" type="text">
												</div>
												<div class="cta-col6 ct-w-50 mb-6 float-right">
													<label for="state"><?php echo $label_language_values['state'];?></label>
													<input class="form-control value_state" id="ct-member-state" name="ct-member-state" type="text" value="<?php echo $staff_read[7]; ?>">
												</div>
											</div>
											<div class="form-group fl w100">
												<div class="cta-col6 ct-w-50 mb-6">
													<label for="zip"><?php echo $label_language_values['zip'];?></label>
													<input class="form-control value_zip" id="ct-member-zip" name="ct-member-zip" type="text" value="<?php echo $staff_read[8]; ?>">
												</div>
												<div class="cta-col6 ct-w-50 mb-6 float-right">
													<label for="country"><?php echo $label_language_values['country'];?></label>
													<input class="form-control value_country" id="ct-member-country" name="ct-member-countrys" type="text" value="<?php echo $staff_read[9]; ?>">
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td><label><?php echo $label_language_values['services'];?></label></td>
										<td>
											<div class="form-group">
												<select class="selectpicker mb-10" id="ct_service_staff" multiple data-size="10" style="display: none;">
													<option value="">Choose Your Service</option>
												<?php
													$getservice = $objservices->getalldata();
												
													while($arr = @mysqli_fetch_array($getservice))
													{
														$get_service_assignid = explode(",", $staff_read[17]);
														if(in_array($arr[0],$get_service_assignid)){
																						
															echo "<option selected='selected' value='".$arr[0]."'>".$arr[1]."</option>";	
														}else{
															echo "<option value='".$arr[0]."'>".$arr[1]."</option>";
														}

													}
												?>
												</select>
											</div>
                                      
										</td>
										
									</tr>
									<tr>
										<td><label for="enable-booking1"><?php echo $label_language_values['enable_booking'];?></label></td>
										<td>
											<label for="enable-booking1">
												<input type="checkbox" id="enable-booking1" data-toggle="toggle" data-size="small" data-on="<?php echo $label_language_values['yes']; ?>" <?php if($staff_read[12] == "Y"){ echo "checked";}?> data-off="<?php echo $label_language_values['no']; ?>" data-onstyle="success" data-offstyle="danger" />
											</label>
										</td>
									</tr>
									<!---<tr>
										<td><label><?php // echo $label_language_values['postal_codes'];?></label></td>
										<td>
											<div class="form-group">
												<textarea class="form-control" name="ct_postal_code" id="ct_postal_code_staff" row="4" cols="40"><?php // echo $staff_read[17];?></textarea> 
											</div>
                                      
										</td>
										
									</tr> -->
									
									
									
									<tr>
										<td></td>
										<td><a id="update_staff_details_staffsection" data-old_schedule_type=""  value="" name="" class="btn btn-success ct-btn-width mt-20" 
										data-id="<?php echo $staff_read[0]; ?>" type="submit"><?php echo $label_language_values['save'];?></a></td>
									</tr>
									</tbody>
									
								</table>
								</form>
							</div>
						</div>
					</div>
			
				</div>
			</div>
			
			
			
		</div>
	
	</div>
</div>
<?php
if($gc_hook->gc_purchase_status() == 'exist'){
	echo $gc_hook->gc_staff_settings_save_js_hook();
}
if($gc_hook->gc_purchase_status() == 'exist'){
	echo $gc_hook->gc_staff_setting_configure_js_hook();
}
if($gc_hook->gc_purchase_status() == 'exist'){
	echo $gc_hook->gc_staff_setting_disconnect_js_hook();
}
if($gc_hook->gc_purchase_status() == 'exist'){
	echo $gc_hook->gc_staff_setting_verify_js_hook();
}

include(dirname(dirname(__FILE__)).'/admin/footer.php');
?>
<script type="text/javascript">
    var ajax_url = '<?php echo AJAX_URL;?>';
    var servObj={'site_url':'<?php echo SITE_URL.'assets/images/business/';?>'};
    var imgObj={'img_url':'<?php echo SITE_URL.'assets/images/';?>'};
</script>