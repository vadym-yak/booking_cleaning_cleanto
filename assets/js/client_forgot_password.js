/*Reset Password*/
jQuery(document).on('click','#reset_pass',function(){
	
	jQuery('.ct-loading-main').show();
    jQuery('.add_show_error_class').each(function(){
        jQuery(this).trigger('keyup');
    });
    var front_url=fronturlObj.front_url;    var site_url=siteurlObj.site_url;
    var email=jQuery('#rp_user_email').val();
    var dataString={email:email,action:"forget_password"};
    if(jQuery('#forget_pass').valid()){
        jQuery.ajax({
            type:"POST",
            url:front_url+"firststep.php",
            data:dataString,
            success:function(response){
				jQuery('.ct-loading-main').hide();
                if(response=='not'){
                    jQuery('.forget_pass_incorrect').css('display','block');
                    jQuery('.forget_pass_incorrect').css('color','red');
                    jQuery('.forget_pass_incorrect').html(errorobj_invalid_email_id_please_register_first);
                }
                else{
                    jQuery('.forget_pass_correct').css('display','block');
                    jQuery('.forget_pass_correct').css('color','green');
                    jQuery('.forget_pass_correct').html(errorobj_your_password_send_successfully_at_your_registered_email_id);
					
					jQuery('#reset_pass').unbind('click');
					jQuery('#reset_pass').css({"pointer-events": "none", "cursor": "default"});
					setTimeout(function() { window.location.href = site_url;  },5000);
					event.preventDefault();					
                }
				
				
            },
        });
    }
});


/* validation for reset_new_password.php */
jQuery(document).ready(function()  {
    jQuery('#reset_new_passwd').submit(function(event){
        event.preventDefault();
        event.stopImmediatePropagation();
    });
    jQuery.validator.addMethod("noSpace", function(value, element) {
        return value.indexOf(" ") < 0 && value != "";
    }, "No space allowed");
    jQuery("#reset_new_passwd").validate({
        rules: {
            n_password: {
                required: true,
                minlength: 8,
                maxlength: 10,
                noSpace: true

            },
            rn_password: {
                required: true,
                minlength: 8,
                maxlength: 10,
                noSpace: true
            }
        },
        messages:{
            n_password: {              required : errorobj_please_enter_new_password,                   minlength: errorobj_password_at_least_have_8_characters,                   maxlength: errorobj_password_must_be_only_10_characters           },           rn_password: {               required: errorobj_please_enter_retype_new_password,                   minlength: errorobj_password_at_least_have_8_characters,                   maxlength: errorobj_password_must_be_only_10_characters           },
        }
    });
});

jQuery(document).on('click','#rp_user_email',function(){
    jQuery('.forget_pass_incorrect').hide();
});
jQuery(document).on('click','#rn_password',function(){
    jQuery('.mismatch_password').hide();
});
jQuery(document).on('click','#n_password',function(){
    jQuery('.mismatch_password').hide();
});
jQuery(document).on('click','#password',function(){
    jQuery('.succ_password').hide();
});
jQuery(document).on('click','#email',function(){
    jQuery('.succ_password').hide();
});

/*Reset New Password*/
jQuery(document).on('click','#reset_new_password',function(){
	jQuery('.ct-loading-main').show();
    var front_url=fronturlObj.front_url;	 var site_url=siteurlObj.site_url;
    var new_reset_pass=jQuery('#n_password').val();
    var retype_new_reset_pass=jQuery('#rn_password').val();
    var dataString={retype_new_reset_pass:retype_new_reset_pass,action:"reset_new_password"};
    if(jQuery('#reset_new_passwd').valid()){
        if(new_reset_pass == retype_new_reset_pass){
            jQuery.ajax({
                type:"POST",
                url:front_url+"firststep.php",
                data:dataString,
                success:function(response){
					jQuery('.ct-loading-main').hide();
                    if(response=='password reset successfully'){
					    jQuery('.forget_pass_correct').css('display','block');
                        jQuery('.forget_pass_correct').addClass('txt-success');
                        jQuery('.forget_pass_correct').html(errorobj_your_password_reset_successfully_please_login);
						jQuery('#reset_new_password').unbind('click');
						jQuery('#reset_new_password').css({"pointer-events": "none", "cursor": "default"});
						setTimeout(function() { window.location.href = site_url;  },5000);
						event.preventDefault();
				
                    }
                },
            });
        }else{
			jQuery('.ct-loading-main').hide();
            jQuery('.mismatch_password').css('display','block');
            jQuery('.mismatch_password').addClass('txt-danger');
            jQuery('.mismatch_password').html(errorobj_new_password_and_retype_new_password_mismatch);
        }
    }
});