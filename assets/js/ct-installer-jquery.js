
jQuery(document).ready(function () {
    jQuery('[data-toggle="tooltip"]').tooltip({'placement': 'right'});
});
jQuery(document).ready(function(){

	jQuery('.term_condition').click(function(){
		 $(".show_terms_condition").slideToggle();
	});
	
	jQuery('.installer_t_c_submit').click(function(){
	var rVal = jQuery("input[name='optradio']:checked"). val();
		jQuery.ajax({
			type : 'post',
			data : {'t_c_check' : 1,'installer_mode':rVal},
			url : obj_installer.ajax_url+'installer_ajax.php',
			success : function(res){
				jQuery('.text_changed').html(res);
			}
		});
	});
		
	jQuery(document).on('click','.server_config_btn',function(){
		 jQuery('#overall_errors').hide();
				  var sys=[];
				  
				  jQuery('.sys_info').each(function(){
				   sys.push(jQuery(this).text());
				  }); 
				  var count = 0;
				  var chk = 0;
				  var msg = "";
				  
				  jQuery('.sys_info').each(function(){
					if(jQuery.trim(sys[count]) == "Passed" && jQuery.trim(jQuery(this).text()) == "Passed"){
					}
					else{
						msg = msg+jQuery(this).attr('data-msg')+"<br/>";
						chk = 1; 
					 } 
					count++;
				  });   
				  
				  if(chk == 0){
				   jQuery.ajax({
					type : 'post',
					data : {'server_config_next' : 1},
					url : obj_installer.ajax_url+'installer_ajax.php',
					success : function(res){
					 jQuery('.text_changed').html(res);
					 jQuery('.database_check_next').hide();
					 jQuery('#loading-test').hide();
					}
				   });
				  }
				  else{
				   jQuery('#overall_errors').html(msg);
				   jQuery('#overall_errors').show();
				  }
		
	});
	
	/* DATABASE CONNECTION */
	jQuery(document).on('click','.database_check_con',function(){
		
		jQuery('#ct_db_form').validate();

		jQuery("#ct_db_hostname").rules("add",
		{
			required: true,
			messages: {required: "Required Field Enter Your Hosting Name"}
		});
		jQuery("#ct_db_dbname").rules("add",
		{
			required: true,
			messages: {required: "Required Field Enter Your Database Name"}
		});
		jQuery("#ct_db_username").rules("add",
		{
			required: true,
			messages: {required: "Required Field Enter Your Database Username"}
		});
		jQuery("#ct_db_envatocode").rules("add",
		{
			required: true,
			messages: {required: "Required Field Enter Your Envato Parchase Code"}
		});
		if (!jQuery('#ct_db_form').valid()) {
			return false;
		}
		else{
			jQuery('.connection_error').hide();
			jQuery('.database_check_next').hide();
			jQuery('.database_check_con').hide();
			jQuery('#loading-test').show();
			var host,dbname,uname,passwords,code;
			host = jQuery.trim(jQuery('.db_host').val());
			dbname = jQuery.trim(jQuery('.db_name').val());
			uname = jQuery.trim(jQuery('.db_username').val());
			passwords = jQuery.trim(jQuery('.db_password').val());
			code = jQuery.trim(jQuery('.envato_code').val());
			console.log(obj_installer);
			jQuery.ajax({
				type : 'post',
				data : {
					'host' : host,
					'dbname' :  dbname,
					'uname' : uname,
					'password' : passwords,
					'code' : code,
					'db_check_next' : 1
					},
				url : obj_installer.ajax_url+'installer_ajax.php',
				success : function(res){
					jQuery('.connection_error').html(res);
					jQuery('.connection_error').show();
					if(res.indexOf("<div class='alert alert-success text-center'>Your product purchase code verified now!</div>") > -1){
						jQuery('.database_check_next').show();
						jQuery('.database_check_con').hide();
						jQuery('#loading-test').hide();
					}
					else{ jQuery('.database_check_con').show();jQuery('#loading-test').hide(); }
				}
			});
			
		}
		
	});
	jQuery(document).on('click','.database_check_next',function(){
		jQuery.ajax({
			type : 'post',
			data : {
				'getadminlogin' : 1
				},
			url : obj_installer.ajax_url+'installer_ajax.php',
			success : function(res){
				jQuery('.text_changed').html(res);
			}
		});
	});
	jQuery(document).on('click','.admin_credential_next',function(){
		jQuery('#ct_admin_detail_form').validate();

		jQuery("#ct_admin_email").rules("add",
		{
			required: true,
			messages: {required: "Please Set Your Username"}
		});
		jQuery("#ct_admin_password").rules("add",
		{
			required: true,
			minlength : 8,
			maxlength : 15,
			messages: {required: "Please Set Your Password",minlength: "Password Must be atleast 8 Chacaters Long",maxlength: "Password Must Not Exceed 15 Characters"}
		});
		if (!jQuery('#ct_admin_detail_form').valid()) {
			return false;
		}
		jQuery.ajax({
			type : 'post',
			data : {
				'admin_email' : jQuery('.admin_email').val(),
				'admin_password' : jQuery('.admin_password').val(),
				'add_admin' : 1,
			},
			url : obj_installer.ajax_url+'installer_ajax.php',
			success : function(res){
				
				jQuery.ajax({
					type : 'post',
					data : {
						'add_sample_data' : 1
					},
					url : obj_installer.ajax_url+'dummy_ajax.php',
					success : function(ressampledata){
						//jQuery('.text_changed').html(res);
					}
				});
				
				
				jQuery('.text_changed').html(res);
			}
		});
	});
	jQuery(document).on('click','.ready_to_install_next',function(){
		jQuery.ajax({
			type : 'post',
			data : {
				'ready_to_install_btn' : 1
			},
			url : obj_installer.ajax_url+'installer_ajax.php',
			success : function(res){
				jQuery('.text_changed').html(res);
			}
		});
	});
	
});

