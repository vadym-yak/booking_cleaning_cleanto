<script>
function payment_process_js(payment_method,thankyou_page_setting_value,dataString,front_url) {
	<?php
	if(sizeof($purchase_check)>0){
		foreach($purchase_check as $key=>$val){
			if($val == 'Y'){
				echo $payment_hook->payment_process_js_hook($key);
			}
		}
	}
	?>
}
</script>