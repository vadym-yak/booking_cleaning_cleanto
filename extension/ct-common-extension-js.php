<script>
function payment_save_settings_js(dataString) {
	<?php
	if(sizeof($purchase_check)>0){
		foreach($purchase_check as $key=>$val){
			if($val == 'Y'){
				echo $payment_hook->payment_settings_save_js_hook($key);
			}
		}
	}
	?>
	return dataString;
}
function payment_currency_check_js() {
	<?php
	if(sizeof($purchase_check)>0){
		foreach($purchase_check as $key=>$val){
			if($val == 'Y'){
				echo $payment_hook->payment_currency_check_js_hook($key);
			}
		}
	}
	?>
}
function payment_validation_js() {
	<?php
	if(sizeof($purchase_check)>0){
		foreach($purchase_check as $key=>$val){
			if($val == 'Y'){
				echo $payment_hook->payment_validation_js_hook($key);
			}
		}
	}
	?>
}
</script>