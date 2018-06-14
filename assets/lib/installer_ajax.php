<?php 

session_start();
include(dirname(dirname(dirname(__FILE__)))."/header.php");
include(dirname(dirname(dirname(__FILE__)))."/class_configure.php");
include(dirname(dirname(dirname(__FILE__)))."/config.php");
$configure = new cleanto_configure();
?>
<script>
jQuery(document).ready(function() {
	jQuery('.cti-tooltip-link').tooltipster({
		animation: 'grow',
		delay: 20,
		theme: 'tooltipster-shadow',
		trigger: 'hover'
	});
});
</script>
<?php 
if(isset($_POST['t_c_check']) && $_POST['t_c_check'] == '1'){
$_SESSION['installer_mode'] = $_POST['installer_mode'];
?>
	<div id="sidebar" class="col-md-4 col-sm-4 col-lg-4 np">
		<div class="cti-progress">
			<ul class="left-menu">
				<li>1. Start</li>
				<li class="active completed">2. Server Requirements</li>
				<li>3. Database Information & Licence</li>
				<li>4. Admin Information</li>
				<li>5. Completed</li>
			</ul>
		</div>
	</div>
	<div id="cti-content" class="col-md-8 col-sm-8 col-lg-8">
		<div class="cti-progress-bar">Step <b>2</b> out of 5 - Server Requirements</div>
		<table class="cti-table" width="99%" cellspacing="2" cellpadding="0" border="0">
		<thead>
            <tr>
                <th> &nbsp; </th>
                <th> Server </th>
                <th> Current </th>
                <th> Status </th>
            </tr>
        </thead>
			<tbody>
				<tr class="active">
				<td>PHP Version</td>
				<td>5.3+</td>
				<td><span class="<?php echo (phpversion() >= '5.3') ? 'text-success' : 'text-danger'; ?>"><strong><?php echo phpversion(); ?></strong></span></td>
			
				<td><span data-msg="Please update PHP version" class="sys_info <?php echo (phpversion() >= '5.3') ? 'text-success' : 'text-danger'; ?>  strong"><i class="fa <?php echo (phpversion() >= '5.3') ? 'fa-check-circle text-success' : 'fa-ban text-danger'; ?>"></i> <?php echo (phpversion() >= '5.3') ? 'Passed' : 'Failed'; ?></span></td>
            </tr>
			<tr class="active">
				<td>Session Auto Start</td>
				<td>Off</td>
				<td>
					<span class="<?php echo (!ini_get('session_auto_start')) ? 'text-success' : 'text-danger'; ?>"><strong><?php echo (ini_get('session_auto_start')) ? 'On' : 'Off'; ?></strong>
					</span>
				</td>
			
				<td><span data-msg="Please disable session auto start " class="sys_info <?php echo (!ini_get('session_auto_start')) ? 'text-success' : 'text-danger'; ?> strong"><i class="fa <?php echo (!ini_get('session_auto_start')) ? 'fa-check-circle text-success' : 'fa-ban text-danger'; ?>"></i> <?php echo (!ini_get('session_auto_start')) ? 'Passed' : 'Failed'; ?></span></td>
            </tr>
			<tr class="active">
				<td>MySQLi </td>
				<td>On</td>
				<td>
					<span class="<?php echo extension_loaded('mysqli') ? 'text-success' : 'text-danger'; ?>"><strong><?php echo extension_loaded('mysqli') ? 'On' : 'Off'; ?></strong></span>
				</td>
			
				<td><span data-msg="Please enable MySQLi " class="sys_info <?php echo extension_loaded('mysqli') ? 'text-success' : 'text-danger'; ?> strong"><i class="fa <?php echo extension_loaded('mysqli') ? 'fa-check-circle text-success' : 'fa-ban text-danger'; ?>"></i> <?php echo extension_loaded('mysqli') ? 'Passed' : 'Failed'; ?></span></td>
            </tr>
			<tr class="active">
				<td>Zip </td>
				<td>On</td>
				<td>
					<span class="<?php echo extension_loaded('zip') ? 'text-success' : 'text-danger'; ?>"><strong><?php echo extension_loaded('zip') ? 'On' : 'Off'; ?></strong></span>
				</td>
			
				<td><span data-msg="Please enable Zip" class="sys_info <?php echo extension_loaded('zip') ? 'text-success' : 'text-danger'; ?> strong"><i class="fa <?php echo extension_loaded('zip') ? 'fa-check-circle text-success' : 'fa-ban text-danger'; ?>"></i> <?php echo extension_loaded('zip') ? 'Passed' : 'Failed'; ?></span></td>
            </tr>
			<tr class="active">
				<td>GD </td>
				<td>On</td>
				<td>
					<span class="<?php echo extension_loaded('gd') ? 'text-success' : 'text-danger'; ?>"><strong><?php echo extension_loaded('gd') ? 'On' : 'Off'; ?></strong></span>
				</td>
			
				<td><span data-msg="Please enable GD " class="sys_info <?php echo extension_loaded('gd') ? 'text-success' : 'text-danger'; ?> strong"><i class="fa <?php echo extension_loaded('gd') ? 'fa-check-circle text-success' : 'fa-ban text-danger'; ?>"></i> <?php echo extension_loaded('gd') ? 'Passed' : 'Failed'; ?></span></td>
            </tr>
			<tr class="active">
				<td>CURL</td>
				<td>Enable</td>
				<td>
					<span class="<?php echo (extension_loaded('curl') == 'true') ? 'text-success' : 'text-danger'; ?>"><strong><?php echo (extension_loaded('curl') == 'true')  ? 'Enable' : 'Disable'; ?></strong></span>
				</td>
			
				<td><span data-msg="Please enable CURL "  class="sys_info <?php echo (extension_loaded('curl') == 'true') ? 'text-success' : 'text-danger'; ?> strong"><i class="fa <?php echo (extension_loaded('curl') == 'true') ? 'fa-check-circle text-success' : 'fa-ban text-danger'; ?>"></i> <?php echo (extension_loaded('curl') == 'true') ? 'Passed' : 'Failed'; ?></span></td>
            </tr>
			<tr class="active">
				<td>config.php </td>
				<td>Writable</td>
				<td>
					<span class="<?php echo is_writable('./../../config.php') ? 'text-success' : 'text-danger'; ?>"><strong><?php echo is_writable('./../../config.php') ? 'Writable' : 'Unwritable'; ?></strong></span>
				</td>
			
				<td><span data-msg="Please make config.php writable"  class="sys_info <?php echo is_writable('./../../config.php') ? 'text-success' : 'text-danger'; ?> strong"><i class="fa <?php echo is_writable('./../../config.php') ? 'fa-check-circle text-success' : 'fa-ban text-danger'; ?>"></i> <?php echo is_writable('./../../config.php') ? 'Passed' : 'Failed'; ?></span></td>
            </tr>
			
			</tbody>
		</table>
		<?php 
if(((phpversion() >= '5.3') == false) || ((!ini_get('session_auto_start')) == false) || (extension_loaded('mysqli') == false) || (extension_loaded('zip') == false) || (extension_loaded('gd') == false) || ((extension_loaded('curl')) == false) || (is_writable('./../../config.php') == false)){
	?>
			<div class="cti-info">You can not proceed if your server and PHP settings not fulfilling the minimum requirements. </div>
			<?php
}
		?>	
		<!-- <a href="index.html" class="btn btn-primary">Back</a> -->
		<a href="javascript:void(0)" class="btn btn-success server_config_btn">Next <i class="fa  fa-angle-double-right"></i></a>
		<br><br>
		<div class='alert alert-danger text-left' id="overall_errors" style="display:none;">
		Sorry please accept term and condition
		</div>
	</div>
	<?php 
}
elseif(isset($_POST['server_config_next']) && $_POST['server_config_next']){
	?>
	<div id="sidebar" class="col-md-4 col-sm-4 col-lg-4 np">
		<div class="cti-progress">
			<ul class="left-menu">
				<li>1. Start</li>
				<li>2. Server Requirements</li>
				<li class="active completed">3. Database Information & Licence</li>
				<li>4. Admin Information</li>
				<li>5. Completed</li>
			</ul>
		</div>
	</div>
	<div id="cti-content" class="col-md-8 col-sm-8 col-lg-8">
		<div class="cti-progress-bar">Step <b>3</b> out of 5 - Database Information & Licence</div>
			<form class="form-horizontal" id="ct_db_form">
				<div class="form-group">
					<label for="" class="control-label col-xs-3">Database Host</label>
					<div class="col-xs-5">
						<input type="text" class="form-control db_host" name="ct_db_hostname" id="ct_db_hostname" ><a class="cti-tooltip-link" tabindex="-1" href="javascript:void(0)" data-toggle="tooltip" title="Database host with port e.g 127.0.0.1:3306 or in most cases its 'localhost'"><i class="fa fa-info-circle"></i></a>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="control-label col-xs-3">Database Name</label>
					<div class="col-xs-5">
						<input type="text" class="form-control db_name" name="ct_db_dbname" id="ct_db_dbname" >
					</div>
				</div>
				<div class="form-group">
					<label for="" class="control-label col-xs-3">Database Username</label>
					<div class="col-xs-5">
						<input type="text" class="form-control db_username" name="ct_db_username" id="ct_db_username" >
					</div>
				</div>
				<div class="form-group">
					<label for="" class="control-label col-xs-3">Database Password</label>
					<div class="col-xs-5">
						<input type="password" class="form-control db_password" name="ct_db_password" id="ct_db_password" >
					</div>
				</div>
				<div id="purchase-code-verification stop_this" class="purchase_code_text">
					<div class="form-group">
						<label for="" class="control-label col-xs-3">Purchase Code</label>
						<div class="col-xs-5">
							<input type="text" class="form-control envato_code" name="ct_db_envatocode" id="ct_db_envatocode" >
							
							<div class="cti-info"> You can get your Envato item purchase code from 
							<a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Can-I-Find-my-Purchase-Code-" target="_BLANK" style="text-decoration:underline;">Here</a>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-offset-3 col-xs-10">
						<a href="javascript:void(0)" class="btn btn-info database_check_con">Test Connection</a>
						<img id="loading-test" src="<?php echo BASE_URL;?>/assets/images/preloader_installer.gif"/>
					</div>
				</div>
				<div class="connection_error" style="display:none;"></div>
			</form>
			<!-- purchase code input show after testing connection is successfull -->
			
			<a href="javascript:void(0)" class="btn btn-success database_check_next">Next <i class="fa  fa-angle-double-right"></i></a>
	</div>
	<?php 
}
elseif(isset($_POST['db_check_next']) && $_POST['db_check_next'] == "1"){
	
	$database_host=	$_POST['host'];
	$database_name=	$_POST['dbname'];
	$database_username=	$_POST['uname'];
	$database_password=	$_POST['password'];  
	$envato_code=$_POST['code'];  
  
	$conn= @new mysqli($database_host,$database_username,$database_password,$database_name);
	if($conn->connect_error)
	{
		ob_clean();ob_start();
		echo "<div class='alert alert-danger text-center'>Connection failed: " . $conn->connect_error . "</div>";
	}
	else
	{
		$configure->conn = $conn;
		$configure->dh = $database_host;
		$configure->du = $database_username;
		$configure->dp = $database_password;
		$configure->dn = $database_name;
		$configure->pc = $envato_code;
		$configure->q0();
		session_destroy();
	}
}
elseif(isset($_POST['getadminlogin']) && $_POST['getadminlogin'] == "1"){
	
	
	
	
	
	?>
	<div id="sidebar" class="col-md-4 col-sm-4 col-lg-4 np">
		<div class="cti-progress">
			<ul class="left-menu">
				<li>1. Start</li>
				<li>2. Server Requirements</li>
				<li>3. Database Information & Licence</li>
				<li class="active completed">4. Admin Information</li>
				<li>5. Completed</li>
			</ul>
		</div>
	</div>
	<div id="cti-content" class="col-md-8 col-sm-8 col-lg-8">
		<div class="cti-progress-bar">Step <b>4</b> out of 5 - Admin Information</div>
		<h4>Configure admin login credentials</h4>
		<form class="form-horizontal" id="ct_admin_detail_form">
			<div class="form-group">
				<label for="" class="control-label col-xs-2">Email</label>
				<div class="col-xs-5">
					<input type="email" class="form-control admin_email" id="ct_admin_email" name="ct_admin_email"	 placeholder="Email"><a  tabindex="-1"  class="cti-tooltip-link" href="javascript:void(0)" data-toggle="tooltip" title="Please Set Your Username"><i class="fa fa-info-circle"></i></a>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-xs-2">Password</label>
				<div class="col-xs-5">
					<input type="password" class="form-control admin_password" id="ct_admin_password" name="ct_admin_password" placeholder="Password"><a  tabindex="-1" class="cti-tooltip-link" href="javascript:void(0)" data-toggle="tooltip" title="Please Set Your Password"><i class="fa fa-info-circle"></i></a>
				</div>
			</div>
			<a href="javascript:void(0)" class="btn btn-success admin_credential_next">Next <i class="fa  fa-angle-double-right"></i></a>
		</form>
	</div>
	<?php 
}
elseif(isset($_POST['add_admin']) && $_POST['add_admin'] == "1"){
	$cvars = new cleanto_myvariable();
	$host = trim($cvars->hostnames);
	$un = trim($cvars->username);
	$ps = trim($cvars->passwords); 
	$db = trim($cvars->database);
	$con = new mysqli($host, $un, $ps, $db);
	if($con->connect_error)
	{
	}
	else{
		$configure->conn = $con;
		$configure->email = $_POST['admin_email'];
		$configure->password = $_POST['admin_password'];
		$configure->q26();
		$returned_inserted_id = $configure->q23();
		$insertedadminid = $returned_inserted_id;
		$configure->q23();
		$_SESSION['adminid'] = $insertedadminid;
		$_SESSION['useremail'] = $_POST['admin_email'];
		$_SESSION['ct_admin_password']= $_POST['admin_password'];
		?>
		<div id="sidebar" class="col-md-4 col-sm-4 col-lg-4 np">
		<div class="cti-progress">
			<ul class="left-menu">
				<li>1. Start</li>
				<li>2. Server Requirements</li>
				<li>3. Database Information & Licence</li>
				<li>4. Admin Information</li>
				<li class="active completed">5. Completed</li>
			</ul>
		</div>
	</div>
	<div id="cti-content" class="col-md-8 col-sm-8 col-lg-8">
		<div class="cti-progress-bar">Step <b>5</b> out of 5 - Completed</div>
		<h4 class="text-success"> Woot..! Cleanto is installed and license is activated successfully !!</h4>
		<div class="cti-info"><b>Administrator's account has been successfully created.</b></div>
		<div class="cti-info">You can access Cleanto admin from <a href="admin/" target="_BLANK">here</a> and start configuring your new appointment tool.
			<div class="cti-info">You can view booking from <a href="index.php" target="_BLANK">here</a>.
				<br />
				<br />
				<div class="cti-info"><b>Login Credentials are: </b><br />
					Email : <b><?php echo $_SESSION['useremail'];?></b><br />
					Password : <b><?php echo $_SESSION['ct_admin_password'];?></b>
				</div>
				
				<div class="cti-info">
					Getting Started : <a href="https://skymoonlabs.ticksy.com/articles/" target="_BLANK">Articles</a> <br />
					Video Tutorials : <a href="https://youtu.be/NLDuwmmxT9Y?list=PL31cBaqxDRtp-wu7GJ5PaTYmBu4b4vIAz" target="_BLANK">Videos</a>
				</div>
			</div>
		</div>	
	</div>
		<?php
	}
}
?>