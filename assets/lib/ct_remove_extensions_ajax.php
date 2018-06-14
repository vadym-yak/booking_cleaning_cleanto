<?php
if(isset($_POST['action']) && $_POST['action'] == "uninstall_extension") {
	include(dirname(dirname(dirname(__FILE__))). '/objects/class_setting.php'); 
	include(dirname(dirname(dirname(__FILE__))). "/objects/class_connection.php");
	$cvars = new cleanto_myvariable();
	$host = trim($cvars->hostnames);
	$un = trim($cvars->username);
	$ps = trim($cvars->passwords); 
	$db = trim($cvars->database);

	$con = new cleanto_db();
	$conn = $con->connect();

	$settings = new cleanto_setting();
	$settings->conn = $conn;
	
	function delete_files($target) {
		if(is_dir($target)){
			$files = glob( $target . '*', GLOB_MARK );

			foreach( $files as $file )
			{
				delete_files( $file );      
			}
			rmdir( $target );
		} elseif(is_file($target)) {
			unlink( $target );  
		}
	}
	
	$ext_arr = glob(dirname(dirname(dirname(__FILE__))).'/extension/*');
	
	foreach($ext_arr as $ext){
		if('extension/'.$_POST['extension'] == $ext){
			delete_files($ext."/");
		}else if(strpos($ext, $_POST['extension']) !== false && strpos($ext, '.zip') !== false){
			unlink($ext);
		}
	}
	$settings->set_option($_POST['purchase_option'],'N');
	$settings->set_option($_POST['version_option'],'');
}
if(isset($_POST['action']) && $_POST['action'] == "deactivate_extension") {
	include(dirname(dirname(dirname(__FILE__))). '/objects/class_setting.php'); 
	include(dirname(dirname(dirname(__FILE__))). "/objects/class_connection.php");
	$cvars = new cleanto_myvariable();
	$host = trim($cvars->hostnames);
	$un = trim($cvars->username);
	$ps = trim($cvars->passwords); 
	$db = trim($cvars->database);

	$con = new cleanto_db();
	$conn = $con->connect();

	$settings = new cleanto_setting();
	$settings->conn = $conn;
	
	$settings->set_option($_POST['purchase_option'],'N');
	$settings->set_option($_POST['version_option'],'');
}