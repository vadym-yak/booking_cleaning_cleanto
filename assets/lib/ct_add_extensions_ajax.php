<?php
if (extension_loaded('zip')) {
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
	
	/* download zip */
	if(isset($_POST['action']) && $_POST['action'] == "add_extension")
	{
		$server_path = str_rot13("uggc://fxlzbbaynof.pbz/pyrnagb/rkgrafvbaf");
		$aV = $_POST['installed_version'];
		$version_file_name = $_POST['extension'].'-'.$_POST['update_version'];
		if (( ($aV != '' || $aV == '') && $aV < $_POST['update_version'] && (!file_exists(dirname(dirname(dirname(__FILE__))).'/extension/'.$version_file_name.'.zip') || !is_dir(dirname(dirname(dirname(__FILE__))).'/extension/'.$_POST['extension']))) || ($aV == $_POST['update_version'] && (!file_exists(dirname(dirname(dirname(__FILE__))).'/extension/'.$version_file_name.'.zip') || !is_dir(dirname(dirname(dirname(__FILE__))).'/extension/'.$_POST['extension']))))
		{
			$updated = false;
			/* Download The File If We Do Not Have It */
			if ( !is_file(dirname(dirname(dirname(__FILE__))).'/extension/'.$version_file_name.'.zip' )) 
			{
				$newUpdate = $settings->url_get_contents($server_path.'/'.$version_file_name.'.zip');
				if ( !is_dir( dirname(dirname(dirname(__FILE__))).'/extension/' ) ){ 
					mkdir ( dirname(dirname(dirname(__FILE__))).'/extension/' );
				}
				$dlHandler = fopen(dirname(dirname(dirname(__FILE__))).'/extension/'.$version_file_name.'.zip', 'w');
				if ( !fwrite($dlHandler, $newUpdate) ) { exit(); }
				fclose($dlHandler);
				unset($newUpdate);
			}
			/* Open The File And Do Stuff */
			$zipHandle = zip_open(dirname(dirname(dirname(__FILE__))).'/extension/'.$version_file_name.'.zip');
			while ($aF = zip_read($zipHandle) )
			{
				$thisFileName = zip_entry_name($aF);
				$thisFileDir = dirname($thisFileName);
			   
				/* Continue if its not a file */
				if ( substr($thisFileName,-1,1) == '/extension/'){ continue; }
				
				/* Make the directory if we need to... */
				if ( !is_dir ( dirname(dirname(dirname(__FILE__))).'/extension/'.$thisFileDir ) ) {
					 mkdir ( dirname(dirname(dirname(__FILE__))).'/extension/'.$thisFileDir );
				}
			   
				/* Overwrite the file */
				if ( !is_dir(dirname(dirname(dirname(__FILE__))).'/extension/'.$thisFileName) ) 
				{
					$contents = zip_entry_read($aF, zip_entry_filesize($aF));
					$updateThis = '';
					
					$updateThis = fopen(dirname(dirname(dirname(__FILE__))).'/extension/'.$thisFileName, 'w');
					fwrite($updateThis, $contents);
					fclose($updateThis);
					unset($contents);
				}
				$updated = true;
			}
			if($updated){
				$settings->set_option($_POST['purchase_option'],'Y');
				$settings->set_option($_POST['version_option'],$_POST['update_version']);
			}
		}
	}
	if(isset($_POST['action']) && $_POST['action'] == "activate_extensions_zip")
	{
		$server_path = str_rot13("uggc://fxlzbbaynof.pbz/pyrnagb/rkgrafvbaf");
		$aV = $_POST['installed_version'];
		$version_file_name = $_POST['extension'].'-'.$_POST['update_version'];
		if (( ($aV != '' || $aV == '') && $aV < $_POST['update_version'] && (!file_exists(dirname(dirname(dirname(__FILE__))).'/extension/'.$version_file_name.'.zip') || !is_dir(dirname(dirname(dirname(__FILE__))).'/extension/'.$_POST['extension']))) || ($aV == $_POST['update_version'] && (!file_exists(dirname(dirname(dirname(__FILE__))).'/extension/'.$version_file_name.'.zip') || !is_dir(dirname(dirname(dirname(__FILE__))).'/extension/'.$_POST['extension']))))
		{
			$updated = false;
			/* Download The File If We Do Not Have It */
			if ( !is_file(dirname(dirname(dirname(__FILE__))).'/extension/'.$version_file_name.'.zip' )) 
			{
				$newUpdate = $settings->url_get_contents($server_path.'/'.$version_file_name.'.zip');
				if ( !is_dir( dirname(dirname(dirname(__FILE__))).'/extension/' ) ){ 
					mkdir ( dirname(dirname(dirname(__FILE__))).'/extension/' );
				}
				$dlHandler = fopen(dirname(dirname(dirname(__FILE__))).'/extension/'.$version_file_name.'.zip', 'w');
				if ( !fwrite($dlHandler, $newUpdate) ) { exit(); }
				fclose($dlHandler);
				unset($newUpdate);
			}
			/* Open The File And Do Stuff */
			$zipHandle = zip_open(dirname(dirname(dirname(__FILE__))).'/extension/'.$version_file_name.'.zip');
			while ($aF = zip_read($zipHandle) )
			{
				$thisFileName = zip_entry_name($aF);
				$thisFileDir = dirname($thisFileName);
			   
				/* Continue if its not a file */
				if ( substr($thisFileName,-1,1) == '/extension/'){ continue; }
				
				/* Make the directory if we need to... */
				if ( !is_dir ( dirname(dirname(dirname(__FILE__))).'/extension/'.$thisFileDir ) ) {
					 mkdir ( dirname(dirname(dirname(__FILE__))).'/extension/'.$thisFileDir );
				}
			   
				/* Overwrite the file */
				if ( !is_dir(dirname(dirname(dirname(__FILE__))).'/extension/'.$thisFileName) ) 
				{
					$contents = zip_entry_read($aF, zip_entry_filesize($aF));
					$updateThis = '';
					
					$updateThis = fopen(dirname(dirname(dirname(__FILE__))).'/extension/'.$thisFileName, 'w');
					fwrite($updateThis, $contents);
					fclose($updateThis);
					unset($contents);
				}
				$updated = true;
			}
			if($updated){
				$settings->set_option($_POST['purchase_option'],'Y');
				$settings->set_option($_POST['version_option'],$_POST['update_version']);
			}
		}
	}
	if(isset($_POST['action']) && $_POST['action'] == "activate_extension") {
		$settings->set_option($_POST['purchase_option'],'Y');
		$settings->set_option($_POST['version_option'],$_POST['update_version']);
	}
	if(isset($_POST['action']) && $_POST['action'] == "verify_purchase_code") {
		$settings->chk_epc($settings,$conn);
	}
}else{
    echo "Not installed - ZipArchive is required for importing content. Please contact your server administrator and ask them to enable it.";
}
?>