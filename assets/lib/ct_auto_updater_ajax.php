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

	/* path where the updated files are saved */
	$server_path = str_rot13("uggc://fxlzbbaynof.pbz/pyrnagb/");
 
	 /* download zip */
	if(isset($_POST['action']) && $_POST['action'] == "auto_updater")
	{
		$getVersions = $settings->ext_get_contents('http://skymoonlabs.com/cleanto/versioncheck.php?'.time());
		if ($getVersions != '')
		{
			/* If we managed to access that file, then lets break up those release versions into an array. */
			echo '<p>CURRENT VERSION: '.$settings->get_option('ct_version').'</p>';
			echo '<p>Reading Current Releases List</p>';
			$versionList = explode("n", $getVersions);    
			foreach ($versionList as $aV)
			{
				if ( $aV > $settings->get_option('ct_version')) 
				{
					echo '<p>New Update Found: v'.$aV.'</p>';
					$found = true;
					/* Download The File If We Do Not Have It */
					if ( !is_file(dirname(dirname(dirname(__FILE__))).'/ct-updates/ct-'.$aV.'.zip' )) 
					{
						echo '<p>Downloading New Update</p>';
						$newUpdate = $settings->url_get_contents($server_path.'ct-updates/ct-'.$aV.'.zip');
						if ( !is_dir( dirname(dirname(dirname(__FILE__))).'/ct-updates/' ) ) 
							mkdir ( dirname(dirname(dirname(__FILE__))).'/ct-updates/' );
						
						$dlHandler = fopen(dirname(dirname(dirname(__FILE__))).'/ct-updates/ct-'.$aV.'.zip', 'w');
						if ( !fwrite($dlHandler, $newUpdate) ) { echo '<p>Could not save new update. Operation aborted.</p>'; exit(); }
						fclose($dlHandler);
						echo '<p>Update Downloaded And Saved</p>';
						unset($newUpdate);
					}
					else 
					{ 
						echo '<p>Update already downloaded.</p>';
					}
					
					
						/* Open The File And Do Stuff */
						$zipHandle = zip_open(dirname(dirname(dirname(__FILE__))).'/ct-updates/ct-'.$aV.'.zip');
						while ($aF = zip_read($zipHandle) )
						{
							$thisFileName = zip_entry_name($aF);
							$thisFileDir = dirname($thisFileName);
						   
							/* Continue if its not a file */
							if ( substr($thisFileName,-1,1) == '/') continue;
						   
			
							/* Make the directory if we need to... */
							if ( !is_dir ( dirname(dirname(dirname(__FILE__))).'/'.$thisFileDir ) )
							{
								 mkdir ( dirname(dirname(dirname(__FILE__))).'/'.$thisFileDir );
							}
						   
							/* Overwrite the file */
							if ( !is_dir(dirname(dirname(dirname(__FILE__))).'/'.$thisFileName) ) 
							{
								$contents = zip_entry_read($aF, zip_entry_filesize($aF));
								$updateThis = '';
							   
								/* If we need to run commands, then do it. */
								if ( $thisFileName == 'upgrade.php' )
								{
									$upgradeExec = fopen ('upgrade.php','w');
									fwrite($upgradeExec, $contents);
									fclose($upgradeExec);
									include ('upgrade.php');
									unlink('upgrade.php');
								}
								else
								{
									$updateThis = fopen(dirname(dirname(dirname(__FILE__))).'/'.$thisFileName, 'w');
									fwrite($updateThis, $contents);
									fclose($updateThis);
									unset($contents);
								}
							}
						}
						$updated = TRUE;
				}
			}
			if ($updated == true)
			{
				echo '<p class="success">&raquo; Cleanto Updated to v'.$aV.'</p>';
			}
			else if ($found != true) { echo '<p>&raquo; No update is available.</p>'; }
		}
		else{
			echo '<p>Could not find latest realeases.</p>';
		}
	}
}else{
    echo "Not installed - ZipArchive is required for importing content. Please contact your server administrator and ask them to enable it.";
}
?>