jQuery(document).ready(function(){
	jQuery('.myall_lang_label').hide();
	jQuery('.label_setting').hide();
});
var check_update_if_btn = '0';
var multipleqty_for_addon = "N";
/* ADMIN PHONE PROFILE DEFAULT COUNTRY */
jQuery(document).ready(function() {
    var site_url=site_ur.site_url;
	var country_alpha_code = countrycodeObj.alphacode;
	var allowed_country_alpha_code = countrycodeObj.allowed;
	var array = allowed_country_alpha_code.split(',');
	if(allowed_country_alpha_code != ""){
		jQuery("#adminphone").intlTelInput({
			onlyCountries: array,
			autoPlaceholder: "off",
			utilsScript: site_url+"assets/js/utils.js"
		});
		jQuery(".selected-flag .iti-flag").addClass(country_alpha_code);
		jQuery(".selected-flag").attr("title",countrycodeObj.countrytitle);
	}
	else
	{
		jQuery("#adminphone").intlTelInput({
			autoPlaceholder: "off",
			utilsScript: site_url+"assets/js/utils.js"
		});
		jQuery(".selected-flag .iti-flag").addClass(country_alpha_code);
		jQuery(".selected-flag").attr("title",countrycodeObj.countrytitle);
	}
});
/* USER PHONE PROFILE DEFAULT COUNTRY */
jQuery(document).ready(function() {
    var site_url=site_ur.site_url;	
	var country_alpha_code = countrycodeObj.alphacode;
	var allowed_country_alpha_code = countrycodeObj.allowed;
	var array = allowed_country_alpha_code.split(',');
	if(allowed_country_alpha_code != ""){
		jQuery("#userphone").intlTelInput({
			onlyCountries: array,
			autoPlaceholder: "off",
			utilsScript: site_url+"assets/js/utils.js"
		});
		jQuery(".selected-flag .iti-flag").addClass(country_alpha_code);
		jQuery(".selected-flag").attr("title",countrycodeObj.countrytitle);
	}
	else
	{
		jQuery("#userphone").intlTelInput({
			autoPlaceholder: "off",
			utilsScript: site_url+"assets/js/utils.js"
		});
		jQuery(".selected-flag .iti-flag").addClass(country_alpha_code);
		jQuery(".selected-flag").attr("title",countrycodeObj.countrytitle);
	}
});

/*  the back to top button  */
jQuery(document).ready(function () {
	jQuery('body').prepend('<a href="javascript:void(0)" class="cta-back-to-top"></a>');
	var amountScrolled = 300;
	jQuery(window).scroll(function() {
		if ( jQuery(window).scrollTop() > amountScrolled ) {
			jQuery('a.cta-back-to-top').fadeIn('slow');
		} else {
			jQuery('a.cta-back-to-top').fadeOut('slow');
		}
	});
	jQuery('a.cta-back-to-top, a.cta-simple-back-to-top').click(function() {
		jQuery('html, body').animate({
			scrollTop: 0
		}, 500);
		return false;
	});	
});	


/*  service addons list selection  */
jQuery(document).on("click",".insert_id",function() {
    jQuery(".cta-addons-dropdown").toggle( "blind", {direction: "vertical"}, 1000 );
});
jQuery(document).on("click",".update_id",function() {
    var id = jQuery(this).data('id');
    jQuery(".display_update_"+id).toggle( "blind", {direction: "vertical"}, 1000 );
});
jQuery(document).on("click",".select_addons",function() {
    var imagename = jQuery(this).data('name');
    var p_i_name = jQuery(this).data('p_i_name');
    var id = jQuery(this).data('id');
    jQuery("#addonid_"+id).html(jQuery(this).html());
    jQuery("#addonid_"+id).attr("data-name",imagename);
	jQuery("#addonid_"+id).attr("data-p_i_name",p_i_name);
	jQuery(".display_update_"+id).hide( "blind", {direction: "vertical"}, 500 );
});

jQuery(document).on("click",".select_addons_insert",function() {
    var imagename = jQuery(this).data('name');
    var p_i_name = jQuery(this).data('p_i_name');
    jQuery("#cta_selected_addon").html(jQuery(this).html());
    jQuery("#cta_selected_addon").attr("data-name",imagename);
    jQuery("#cta_selected_addon").attr("data-p_i_name",p_i_name);
    jQuery("#cta_selected_addon").attr("data-p_i_name",p_i_name);
    jQuery(".display_insert").hide( "blind", {direction: "vertical"}, 500 );
});

/*  All custom scrollbar  */
jQuery(document).ready(function () {
    jQuery('#ct-partial-depost_error').hide();
    jQuery('#import_error').hide();
    jQuery('#export_error').hide();
    jQuery('.show_all_labels').hide();
    var nice = jQuery("body").niceScroll();
	var nice_left_navs = jQuery(".ct-left-menu").niceScroll();
    var nice_right_details = jQuery(".ct-setting-details").niceScroll();
});

/* ****************************** */
/* ****  header jquery  ********* */
/* custom form fields min and max length */

jQuery(document).ready(function() {
	jQuery('.ct-addition-btn').on('click', function() {
		var inputclass = jQuery(this).data('info');
		jQuery('.'+inputclass).val(parseInt(jQuery('.'+inputclass).val(), 10) + 1);
	});
	jQuery('.ct-subtraction-btn').on('click', function() {
		var inputclass = jQuery(this).data('info');
		if(parseInt(jQuery('.'+inputclass).val(), 10) - 1 <= 0){
			jQuery('.'+inputclass).val(0);
		}
		else {
			jQuery('.'+inputclass).val( parseInt(jQuery('.'+inputclass).val(), 10) - 1);
		}		
	});
});

/*  scroll to active class service, location, setting  */
jQuery(document).ready(function () {
    jQuery('.sot-company-details, .sot-general-setting, .sot-appearance-setting, .sot-payment-setting, .sot-email-setting, .sot-email-template, .sot-sms-reminder, .sot-sms-template, .sot-frequently-discount, .sot-promocode, .sot-labels, .sot-form-fields').on('click', function (e) {
		jQuery('html, body').stop().animate({
            'scrollTop': jQuery('.ct-setting-details').offset().top - 115
        }, 500, 'swing', function () {
        });
    });
});
jQuery(document).ready(function(){
	jQuery('#ct-add-new-service').on('click',function (e) {
		jQuery('html, body').stop().animate({
		'scrollTop': jQuery('.new-service-scroll, .new-addon-scroll').offset().top - 115
		}, 2000, 'swing', function () {});
	});
});

/*  menu auto hide in mobile when open a menu  */
jQuery(document).on('click', '.navbar-collapse.in', function (e) {
    if (jQuery(e.target).is('a')) {
        jQuery(this).collapse('hide');
    }
});


/*  manage form fields min max counting  */
jQuery(function () {
    jQuery('.add').on('click', function () {
        var $qty = $(this).closest('.ct-min-max').find('.qty');
        var currentVal = parseInt($qty.val());
        if (!isNaN(currentVal)) {
            $qty.val(currentVal + 1);
        }
    });
    jQuery('.minus').on('click', function () {
        var $qty = $(this).closest('.ct-min-max').find('.qty');
        var currentVal = parseInt($qty.val());
        if (!isNaN(currentVal) && currentVal > 0) {
            $qty.val(currentVal - 1);
        }
    });
});



/*  hide delete appointment in modal window  */
jQuery(document).on('click', '#ct-close-del-appointment', function () {
    jQuery('.popover').fadeOut();
});
/*  customer phone number in popup  */
jQuery(document).ready(function () {
    var site_url_ajax=site_ur.site_url;
    jQuery("#cus-phone-number").intlTelInput({
        utilsScript: site_url_ajax+ "assets/js/utils.js"
    });
});


/*  reject appointment reason popover  */
jQuery(document).ready(function () {
    jQuery('#ct-reject-appointment').popover({
        html: true,
        content: function () {
            return jQuery('#popover-reject-appointment').html();
        }
    });
});
/*  hide add new service popover  */
jQuery(document).on('click', '#ct-close-reject-appointment', function () {
    jQuery('.popover').fadeOut();
});


jQuery(document).on('click', '#ct-close-popover-delete-staff', function () {
    jQuery('.popover').fadeOut();
});


/* ****************************** */

jQuery(document).ready(function () {
    jQuery(".fc-day-grid-event").click(function () {
        jQuery("#booking-details-calendar").css('display', 'block');
    });

});

jQuery(document).ready(function () {
    var ajaxurl = ajax_url;
    var time_format_values=times.time_format_values;
    if(time_format_values==24){
        var tymfrmt='H:mm';
    }else{
        var tymfrmt='h:mm a';
    }
	/* SET LANGUAGE TRANSLATE*/
	var set_language = language_new.selected_language;	
	var today_nn = titles.selected_today;
	var month_nn = titles.selected_month;
	var week_nn = titles.selected_week;
	var day_nn = titles.selected_day;
	/* SET LANGUAGE TRANSLATE*/
    var d = new Date();
    var month = d.getMonth() + 1;
    var day = d.getDate();
    var curdate = d.getFullYear() + '/' +
        (month < 10 ? '0' : '') + month + '/' +
        (day < 10 ? '0' : '') + day;
    jQuery('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
	
		defaultView: ct_calendar_defaultView,
        buttonText: {today: today_nn, month: month_nn, agendaWeek: week_nn, agendaDay: day_nn},
        defaultDate: curdate,
        lang: set_language,
        refetch: false,
        firstDay: ct_calendar_firstDay,
        eventLimit: 6, /*  allow "more" link when too many events  */
        disableDragging: true,

        eventRender: function (event, element) {


            var event_st = event.event_status;

            if (event_st == 'C') {
                element.find('.fc-title').hide();
                element.find('.fc-time').hide();
                element.find('.fc-title').before(
                    jQuery("<i class='fa fa-check txt-success' title='Confirmed'></i>")
                );

                element.find('.fc-title').after(
                    jQuery("<div><i class='fa fa-clock-o'></i>" + event.start.format(tymfrmt) + "</div><div>" + event.title + "</div><div><hr id='hr' /></div><div>" + event.client_name + "</div><div>" + event.client_phone + "</div><div>" + event.client_email + "</div>")
                );


            }
            if (event_st == 'R') {
                element.find('.fc-title').hide();
                element.find('.fc-time').hide();
                element.find('.fc-title').before(
                    jQuery("<i class='fa fa-ban txt-danger' title='"+errorobj_rejected+"'></i>"));
                

                element.find('.fc-title').after(
                    jQuery("<div><i class='fa fa-clock-o'></i>" + event.start.format(tymfrmt) + "</div><div>" + event.title + "</div> <div><hr id='hr' /></div><div>" + event.client_name + "</div><div>" + event.client_phone + "</div><div>" + event.client_email + "</div>")
                );

            }

            if (event_st == 'CC') {
                element.find('.fc-title').hide();
                element.find('.fc-time').hide();

                element.find('.fc-title').before(
                    jQuery("<i class='fa fa-times txt-primary' title='"+errorobj_cancelled_by_client+"'></i>"));
               
                element.find('.fc-title').after(
                    jQuery("<div><i class='fa fa-clock-o'></i>" + event.start.format(tymfrmt) + "</div><div>" + event.title + "</div> <div><hr id='hr' /></div><div>" + event.client_name + "</div><div>" + event.client_phone + "</div><div>" + event.client_email + "</div>")
                );

            }
            if (event_st == 'A' || event_st == '') {
                element.find('.fc-title').hide();
                element.find('.fc-time').hide();

                element.find('.fc-title').before(
                    jQuery("<i class='fa fa-info-circle txt-warning' title='"+errorobj_pending+"'></i>"));
                


                element.find('.fc-title').after(
                    jQuery("<div><i class='fa fa-clock-o'></i>" + event.start.format(tymfrmt) + "</div><div>" + event.title + "</div> <div><hr id='hr' /></div><div>" + event.client_name + "</div><div>" + event.client_phone + "</div><div>" + event.client_email + "</div>")
                );

            }
            if (event_st == 'CS') {
                element.find('.fc-title').hide();
                element.find('.fc-time').hide();

                element.find('.fc-title').before(
                    jQuery("<i class='fa fa-times-circle-o txt-info' title='"+errorobj_calcelled_by_client+"'></i>"));
               

                element.find('.fc-title').after(
                    jQuery("<div><i class='fa fa-clock-o'></i>" + event.start.format(tymfrmt) + "</div><div>" + event.title + "</div> <div><hr id='hr' /></div><div>" + event.client_name + "</div><div>" + event.client_phone + "</div><div>" + event.client_email + "</div>")
                );

            }

            if (event_st == 'CO') {
                element.find('.fc-title').hide();
                element.find('.fc-time').hide();

                element.find('.fc-title').before(
                    jQuery("<i class='fa fa-thumbs-o-up txt-success' title='"+errorobj_appointment_completed+"'></i>"));
                

                element.find('.fc-title').after(
                    jQuery("<div><i class='fa fa-clock-o'></i>" + event.start.format(tymfrmt) + "</div><div>" + event.title + "</div> <div><hr id='hr' /></div><div>" + event.client_name + "</div><div>" + event.client_phone + "</div><div>" + event.client_email + "</div>")
                );

            }

            if (event_st == 'MN') {
                element.find('.fc-title').hide();
                element.find('.fc-time').hide();

                element.find('.fc-title').before(
                    jQuery("<i class='fa fa-thumbs-o-down txt-danger' title='"+errorobj_appointment_marked_as_no_show+"'></i> "));
                

                element.find('.fc-title').after(
                    jQuery("<div><i class='fa fa-clock-o'></i>" + event.start.format(tymfrmt) + "</div><div>" + event.title + "</div> <div><hr id='hr' /></div><div>" + event.client_name + "</div><div>" + event.client_phone + "</div><div>" + event.client_email + "</div>")
                );

            }

            if (event_st == 'RS') {
                element.find('.fc-title').hide();
                element.find('.fc-time').hide();

                element.find('.fc-title').before(
                    jQuery("<i class='fa fa-pencil-square-o txt-info' title='"+errorobj_rescheduled+"'></i>"));
                
                element.find('.fc-title').after(
                    jQuery("<div><i class='fa fa-clock-o'></i>" + event.start.format(tymfrmt) + "</div><div>" + event.title + "</div> <div><hr id='hr' /></div><div>" + event.client_name + "</div><div>" + event.client_phone + "</div>")
                );

            }

            element.css('background', event.color_tag);
            element.css('border-color', event.color_tag);

            element.attr('href', 'javascript:void(0);');
            element.click(function () {
                var ajaxurl = calObj.ajax_url;
                jQuery("#reject_reason_txt").val('');

                var appointment_id = event.id;
                var getdata = {

                    appointment_id: appointment_id

                };

                jQuery.ajax({

                    type: 'post',

                    url: ajaxurl + "calendar_appointment_details.php",

                    data: getdata,

                    dataType: 'html',

                    success: function (response) {

                        var app_details = jQuery.parseJSON(response);

                        jQuery('#booking-details-calendar').modal();
						jQuery(".service-html").html(app_details.service_title);
                        jQuery(".method-html").html(app_details.method_title);
                        jQuery(".units-html").html(app_details.unit_title);
                        jQuery(".addons-html").html(app_details.addons_title);

                        if (app_details.booking_status == "Active") {
                            jQuery('.myconfirmclass').show();
                            jQuery('.confirm_btn_appt').show();
                            jQuery('.reject_btn_appt').show();
                            jQuery('.myrejectclass').show();
                            /** jQuery(".ct-booking-status").html("<i class='fa fa-info-circle txt-warning' title='Pending'><em>"+errorobj_pending+"</em></i>");*/
                            jQuery(".ct-booking-status").html("<em>"+errorobj_active+"</em>");

                        }
                        else if (app_details.booking_status == "Confirm") {

                            jQuery(".ct-booking-status").html('<i class="fa fa-check txt-success" title="Confirmed"><em>'+errorobj_confirmed+'</em></i>');
                            jQuery('.myconfirmclass').hide();
                            jQuery('.confirm_btn_appt').hide();
                            jQuery('.reject_btn_appt').hide();
                            jQuery('.myrejectclass').hide();

                        }
                        else if (app_details.booking_status == "Reject") {

                            jQuery('.myrejectclass').hide();
                            jQuery(".ct-booking-status").html('<i class="fa fa-ban txt-danger" title="Rejected"><em>'+errorobj_rejected+'</em></i>');
                            jQuery('.reject_btn_appt').hide();
                            jQuery('.confirm_btn_appt').hide();
                            jQuery('.myconfirmclass').hide();

                        }
                        else if (app_details.booking_status == "Rescheduled") {
                            jQuery(".ct-booking-status").html("<i class='fa fa-pencil-square-o txt-info' title='Rescheduled'><em>"+errorobj_rescheduled+"</em></i>");
                            jQuery('.myconfirmclass').show();
                            jQuery('.confirm_btn_appt').show();
                            jQuery('.reject_btn_appt').show();
                            jQuery('.myrejectclass').show();
                        } else if (app_details.booking_status == "Cancel By Client") {
                            jQuery(".ct-booking-status").html("<i class='fa fa-times txt-primary' title='Cancelled by client'><em>"+errorobj_cancel_by_client+"</em></i>");
							 jQuery('.myconfirmclass').hide();
                            jQuery('.confirm_btn_appt').hide();
                            jQuery('.reject_btn_appt').hide();
                            jQuery('.myrejectclass').hide();
                        } else if (app_details.booking_status == "Cancel By Service Provider") {
                            jQuery(".ct-booking-status").html("<i class='fa fa-times-circle-o txt-info' title='Cancelled by service provider'><em>"+errorobj_cancelled_by_service_provider+"</em></i>");
                        } else if (app_details.booking_status == "Completed") {

                        } else {
                            jQuery(".ct-booking-status").html("<i class='fa fa-thumbs-o-down txt-danger' title='Appointment marked as no show'><em>"+errorobj_appointment_marked_as_no_show+"</em></i>");
                        }
                        jQuery(".price").html(app_details.booking_price);
                        jQuery(".duration").html(app_details.service_duration);
						
						if(app_details.client_name == ""){
							jQuery(".client_name").parent('li').hide();
						}else{
							jQuery(".client_name").parent('li').show();
							jQuery(".client_name").html(app_details.client_name);
						}
						/* jQuery(".client_name").html(app_details.client_name); */
						jQuery(".client_display").attr("value", app_details.client_name);
						
                        jQuery(".client_email").html(app_details.client_email);

                        jQuery(".client_email_dis").attr("value", app_details.client_email);
                        
						if(app_details.client_phone == ""){
							jQuery(".client_phone").parent('li').hide();
						}else{
							jQuery(".client_phone").parent('li').show();
							jQuery(".client_phone").html(app_details.client_phone);
						}
						
						if(app_details.client_address == ""){
							jQuery(".client_address").parent('li').hide();
                        }else{
							jQuery(".client_address").parent('li').show();
							jQuery(".client_address").html(app_details.client_address);
						}
						
						
						jQuery(".client_phone_dis").attr("value", app_details.client_phone);
                        jQuery(".client_phone_dis").intlTelInput("setNumber", app_details.client_phone);
                        jQuery(".starttime").html(app_details.appointment_starttime);
                        jQuery('.start_time_ser option:selected').text(app_details.appointment_start_time);
                        jQuery(".start_time").html(app_details.appointment_start_time);
                        jQuery('.update_cal_events').attr("data-id", app_details.id);
                        jQuery('.book_rejct').attr("data-bkid", app_details.id);

                        jQuery('.confirm_book').attr("data-id", app_details.id);

                        jQuery('#ct-reject-appointment-cal-popup').attr("data-id", app_details.id);
                        jQuery('.reject_bookings').attr("data-id", app_details.id);
                        jQuery('.reject_rea_appt').attr("id", 'reason_reject' + app_details.id);
			
                        jQuery('.book_cancel').attr("data-id", app_details.id);
                        jQuery('.book_cancel').attr("data-bkid", app_details.id);
                        jQuery('.reason_dis_cancel').attr("id", 'reason_delete' + app_details.id);
                        jQuery('.delete_bookings').attr("data-id", app_details.id);
						jQuery('.delete_bookings').attr("data-gc_event", app_details.gc_event_id);
                        jQuery('.reject_bookings').attr("data-gc_event", app_details.gc_event_id);
						jQuery('.delete_bookings').attr("data-gc_staff_event", app_details.gc_staff_event_id);
                        jQuery('.reject_bookings').attr("data-gc_staff_event", app_details.gc_staff_event_id);
						jQuery('.delete_bookings').attr("data-pid", app_details.staff_ids);
                        jQuery('.reject_bookings').attr("data-pid", app_details.staff_ids);
                        if(app_details.past == "yes"){
                            jQuery('.myconfirmclass').hide();
                            jQuery('.confirm_btn_appt').hide();
                            jQuery('.reject_btn_appt').hide();
                            jQuery('.myrejectclass').hide();
                        }
                        if(app_details.client_notes == ""){
                            jQuery(".notes").parent('li').hide();
                        }
                        else
                        {
							jQuery(".notes").parent('li').show();
                            jQuery(".notes").html(app_details.client_notes);
                        }
						
						if(app_details.global_vc_status == 'Y' && app_details.vaccum_cleaner != " : -")
						{
							jQuery(".client_vc_status").html(app_details.vaccum_cleaner);
						}
						else{
							jQuery('.pop_vc_status').hide();
						}
						if(app_details.global_p_status == 'Y' && app_details.parking != " : -")
						{
							jQuery(".client_parking").html(app_details.parking);
						}
						else{
							jQuery('.pop_p_status').hide();
						}
                        jQuery(".client_vc_status").html(app_details.vaccum_cleaner);
                        jQuery(".client_parking").html(app_details.parking + app_details.p_type);
                        jQuery(".client_residence").html(app_details.residence_type);
                        jQuery(".client_level").html(app_details.how_level);
                        
                        jQuery(".client_payment").html(app_details.payment_type);
						
                        jQuery(".contact_status").html(app_details.contact_status);
                        jQuery('.ct-confirm-appointment').attr("data-id", app_details.id);
						jQuery('.staff_list').html(app_details.staff);
                    }
                });

            });


        },

        /*  calendar day click show manual booking  */

        dayClick: function (date, jsEvent, view) {
			var selected_datetime = new Date(date);
			var selected_date = selected_datetime.getDate();
			var selected_month = selected_datetime.getMonth() + 1;
			var selected_year = selected_datetime.getFullYear();
			var selected_date_with_format = selected_year+"-"+selected_month+"-"+selected_date;
			
			var current_datetime = new Date();
			var current_date = current_datetime.getDate();
			var current_month = current_datetime.getMonth() + 1;
			var current_year = current_datetime.getFullYear();
			var current_date_with_format = current_year + "-" + current_month + "-" + current_date;
			
			if (new Date(selected_date_with_format).getTime() < new Date(current_date_with_format).getTime()) {
				jQuery('.mainheader_message_fail').show();
                jQuery('.mainheader_message_inner_fail').css('display', 'inline');
                jQuery('#ct_sucess_message_fail').text(errorobj_you_cannot_book_on_past_date);
                jQuery('.mainheader_message_fail').fadeOut(10000);
			}else{
				jQuery('#add-new-booking').modal();
			}
        },

        events: ajaxurl + 'calendar_upcomming_appointments.php'
    });
});

/*  show edit booking modal on booking details modal  */
jQuery('#edit-booking-details').click(function () {
    jQuery('#booking-details-calendar').hide("blind", {direction: "vertical"}, .15);
    jQuery('#edit-booking-details-view').modal();
});


jQuery(document).ready(function () {
    jQuery('#ct-reject-appointment-cal-popup').popover({
        html: true,
        content: function () {
            var id = jQuery(this).data('bkid');
            return jQuery('#popover-reject-appointment-cal-popup' + id).html();
        }
    });
});
/*  hide reject appointment reason popover  */
jQuery(document).on('click', '#ct-close-reject-appointment-cal-popup', function () {
    jQuery('.popover').fadeOut();
});

/*  delete appointment in modal window  */
jQuery(document).ready(function () {
    jQuery('#ct-delete-appointment-cal-popup').popover({
        html: true,
        content: function () {
            return jQuery('#popover-delete-appointment-cal-popup').html();
        }
    });
});
/*  hide delete appointment in modal window  */
jQuery(document).on('click', '#ct-close-del-appointment-cal-popup', function () {
    jQuery('.popover').fadeOut();
});
/* ************************************* */
jQuery(document).ready(function () {
    jQuery('#edit-ct-reject-appointment').popover({
        html: true,
        content: function () {
            return jQuery('#edit-popover-reject-appointment').html();
        }
    });
});
/*  hide reject appointment reason popover  */
jQuery(document).on('click', '#edit-ct-close-reject-appointment', function () {
    jQuery('.popover').fadeOut();
});

/*  delete appointment in modal window  */
jQuery(document).ready(function () {
    jQuery('#edit-ct-delete-appointment').popover({
        html: true,
        content: function () {
            return jQuery('#edit-popover-delete-appointment').html();
        }
    });
});
/*  hide delete appointment in modal window  */
jQuery(document).on('click', '#edit-ct-close-del-appointment', function () {
    jQuery('.popover').fadeOut();
});


/* ****************************** */
/* ****  STAFF JQUERY     *********** */
/*  add new staff button and popover  */
jQuery(document).ready(function () {
    jQuery('#ct-add-new-staff').popover({
        html: true,
        content: function () {
            return jQuery('#popover-content-wrapper').html();
        }
    });
});

/* ********************** */
/*  delete staff member popover  */
jQuery(document).ajaxComplete(function () {
    jQuery('#ct-delete-staff-member').popover({
        html: true,
        content: function () {
            return jQuery('#popover-delete-member').html();
        }
    });
});
/*  hide delete staff popover  */
jQuery(document).on('click', '#ct-close-popover-delete-staff', function () {
    jQuery('.popover').fadeOut();
});


jQuery(function () {
    jQuery( "#sortable-services, #sortable-services-units" ).sortable({ handle: '.fa-th-list' });
});

/*  phone number  */
jQuery(document).ajaxComplete(function(){
	var site_url=site_ur.site_url;
	jQuery("#phone-number").intlTelInput({
		autoPlaceholder: "off",
		utilsScript: site_url+"assets/js/utils.js"
	});
});
jQuery(document).ready(function () {
    var site_url=site_ur.site_url;
	var allowed_country_alpha_code = countrycodeObj.allowed;
	var array = allowed_country_alpha_code.split(',');
   
	if(allowed_country_alpha_code != ""){
		jQuery("#company_country_code").intlTelInput({
			numberType: "polite",
			onlyCountries: array,
			autoPlaceholder: "off",
			utilsScript: site_url+"assets/js/utils.js"
		});
		/*jQuery(".selected-flag .iti-flag").addClass(country_alpha_code);
		jQuery(".selected-flag").attr("title",countrycodeObj.countrytitle);*/
	}
	else
	{
		jQuery("#company_country_code").intlTelInput({
			numberType: "polite",
			autoPlaceholder: "off",
			utilsScript: site_url+"assets/js/utils.js"
		});
		/*jQuery(".selected-flag .iti-flag").addClass(country_alpha_code);
		jQuery(".selected-flag").attr("title",countrycodeObj.countrytitle);*/
	}
	if(allowed_country_alpha_code != ""){
		jQuery("#phone-number").intlTelInput({
			onlyCountries: array,
			autoPlaceholder: "off",
			utilsScript: site_url+"assets/js/utils.js"
		});
		/*jQuery(".selected-flag .iti-flag").addClass(country_alpha_code);
		jQuery(".selected-flag").attr("title",countrycodeObj.countrytitle);*/
	}
	else
	{
		jQuery("#phone-number").intlTelInput({
			autoPlaceholder: "off",
			utilsScript: site_url+"assets/js/utils.js"
		});
		/* jQuery(".selected-flag .iti-flag").addClass(country_alpha_code);
		jQuery(".selected-flag").attr("title",countrycodeObj.countrytitle); */
	}
});
jQuery(document).on('focusin','#company_country_code',function(){
	jQuery(this).blur();	
});

/*  Display Country Code on click flag on phone */
jQuery(document).on('click','.country',function() {
    var country_code=jQuery(this).data("dial-code");
    jQuery("#company_country_code").val('+'+country_code);
    var num_code=jQuery(this).data("dial-code");
    var alpha_code=jQuery(this).data("country-code");
    jQuery(".numbercode").text('+'+num_code);
    jQuery(".alphacode").text(alpha_code);
	jQuery('.company_country_code_value').text('+'+num_code);
});


/*  hide delete staff popover  */
jQuery(document).on('click', '#ct-close-popover-delete-breaks', function () {
    jQuery('.popover').fadeOut();
});

/*  for staff off time  */
jQuery(function () {
    function cb(start, end) {
        jQuery('#offtime-daterange span').html(start.format('MM/DD/YYYY h:mm A') + ' - ' + end.format('MM/DD/YYYY h:mm A'));
    }

    cb(moment().subtract(29, 'days'), moment());

    jQuery('#offtime-daterange').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
            format: 'MM/DD/YYYY h:mm A'
        }
    }, cb);
});
jQuery(document).bind('ready ajaxComplete', function () {
    jQuery('#ct-staff-member-offtime-list, #ct-staff-service-details-list').DataTable();
});


/* *************************************** */
/* ***      Services page **************** */

/*  add new category button and popover  */
jQuery(document).ready(function () {
    jQuery('#ct-add-new-category').popover({
        html: true,
        content: function () {
            return jQuery('#popover-content-wrapper').html();
        }
    });
});


/*  hide delete service popover  */
jQuery(document).on('click', '#ct-close-popover-delete-service', function () {
    jQuery('.popover').fadeOut();
});

/*  delete service addon popover  */
jQuery(document).ready(function () {
    jQuery('#ct-delete-service-addon').popover({
        html: true,
        content: function () {
            return jQuery('#popover-delete-service-addon').html();
        }
    });
});
/*  hide delete service addon popover  */
jQuery(document).on('click', '#ct-close-popover-delete-service-addon', function () {
    jQuery('.popover').fadeOut();
});

/*  delete service unit popover  */
jQuery(document).ready(function () {
    jQuery('#ct-delete-service-unit').popover({
        html: true,
        content: function () {
            return jQuery('#popover-delete-service-unit').html();
        }
    });
});
/*  hide delete service unit popover  */
jQuery(document).on('click', '#ct-close-popover-delete-service-unit', function () {
    jQuery('.popover').fadeOut();
});


/*  add new service 1  */

jQuery(document).on('click', '#ct-add-new-service', function () {
    jQuery('.ct-add-new-service').fadeIn();
});

/*  add new clean price calculation method 2  */

jQuery(document).on('click', '#ct-add-new-price-method', function () {
    jQuery('.ct-add-new-price-method').fadeIn();
});
/*  add new clean price calculation method 2  */

jQuery(document).on('click', '#ct-add-new-price-unit', function () {
    jQuery('.ct-add-new-price-unit').fadeIn();
});



/*  for add breaks in staff   */
jQuery(document).ready(function () {
    jQuery("#ct-add-staff-breaks").click(function () {
        jQuery("#ct-add-break-ul").append("");
    });
});


jQuery(function () {
    jQuery("#sortable-services, #sortable-services-units").sortable({handle: '.fa-th-list'});
    jQuery("#sortable-service-list").sortable();
});

/*  color tag for service */
jQuery(document).ready(function () {

    jQuery('.demo').each(function () {
        jQuery(this).minicolors({
            control: jQuery(this).attr('data-control') || 'hue',
            defaultValue: jQuery(this).attr('data-defaultValue') || '',
            format: jQuery(this).attr('data-format') || 'hex',
            keywords: jQuery(this).attr('data-keywords') || '',
            inline: jQuery(this).attr('data-inline') === 'true',
            letterCase: jQuery(this).attr('data-letterCase') || 'lowercase',
            opacity: jQuery(this).attr('data-opacity'),
            position: jQuery(this).attr('data-position') || 'bottom left',
            change: function (value, opacity) {
                if (!value) return;
                if (opacity) value += ', ' + opacity;
                if (typeof console === 'object') {
                    console.log(value);
                }
            },
            theme: 'bootstrap'
        });

    });

});
/*  add new price row  */
jQuery(document).on('click', '#add-price-row-btn', function () {
    jQuery('#ct-add-price-row').fadeIn();
});

/*  services toggle details  */
jQuery(document).on('change', '.ct-show-hide-checkbox', function () {
    var toggle_id = jQuery(this).attr('id');
    jQuery('.detail_' + toggle_id).toggle("blind", {direction: "vertical"}, 1000);
});



jQuery(function () {
    jQuery('.selectpicker').selectpicker({
        container: 'body'
    });

    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
        jQuery('.selectpicker').selectpicker('mobile');
    }
});
jQuery(document).bind('ready ajaxComplete', function () {
    jQuery('.selectpicker').selectpicker({
        container: 'body'
    });
});
jQuery(document).ready(function () {
    jQuery('.ct-show-hide-checkbox').change(function () {
        var toggle_id = jQuery(this).attr('id');
        jQuery('.mycollapse_' + toggle_id).toggle("blind", {direction: "vertical"}, 1000);
    });
});


/*  for add breaks in staff   */
jQuery(document).ready(function () {
    jQuery("#ct-add-staff-breaks").click(function () {
        jQuery("#ct-add-break-ul").append('<li>' + jQuery('.ct-add-new-break-li').html() + '</li>');
	});
});

/* ******************************** */
/* *****   settings > General settings  ************ */
/*  for toggle medium enable disable collapse  */
/*  */
jQuery(document).ready(function () {
	jQuery('.cta-toggle-checkbox').change(function () {
		var toggle_id = jQuery(this).attr('id');
		if(toggle_id == "patial-deposit"){}else{
			jQuery('.mycollapse_' + toggle_id).toggle("blind", {direction: "vertical"}, 1000);            
		}
	});
});

/*  for toggle medium enable disable collapse  */
jQuery(document).ready(function () {   
	 jQuery('.cta-toggle-checkbox').change(function () {     
		 var toggle_id = jQuery(this).attr('id');		    
		 if(toggle_id == "patial-deposit"){        
			 if(jQuery(this).prop('checked')==true){     
				 if(payment_status == "off"){             
					jQuery('#ct-partial-depost_error').show();  
					jQuery(this).attr("checked",false);
				    jQuery(this).parent().prop('className','toggle btn btn-danger btn-sm off');
				 }else{                  
					jQuery('.mycollapse_' + toggle_id).toggle("blind", {direction: "vertical"}, 1000);
				 }            
			 }else{               
				 jQuery('#ct-partial-depost_error').hide();     
				 jQuery('.mycollapse_' + toggle_id).fadeOut();   
			 }      
		 }   
	 });
 });

jQuery(document).ready(function () {
    jQuery('input[type="radio"]').click(function () {
        if (jQuery(this).attr("value") == "Percentage") {
            jQuery(".ct-tax-percent").show();
        }
        if (jQuery(this).attr("value") == "Flat-Fee") {
            jQuery(".ct-tax-percent").hide();
        }

    });
});
jQuery(document).ready(function () {
    jQuery('[data-toggle="tooltip"]').tooltip({'placement': 'right'});

});

/* *****   settings > Appearance settings  ************ */
jQuery(document).ready(function () {
    jQuery('ct-primary-color').minicolors();
});

/* *****   settings > discount coupons  ************ */
jQuery(document).ready(function () {
    jQuery('.delete-promocode').popover({
        html: true,
        content: function () {
            var id = jQuery(this).data('id');
            return jQuery('#popover-delete-promocode' + id).html();
        }
    });
});
/*  hide delete promocode popover  */
jQuery(document).on('click', '#ct-close-popover-delete-promocode', function () {
    jQuery('.popover').fadeOut();
});

jQuery(document).on('click', '.ct-edit-coupon', function () {
    jQuery('.ct-update-promocode').css('display', 'block');
});

jQuery(document).on('click', '.add_promocode', function () {
    jQuery('.ct-update-promocode').css('display', 'none');
})

/* ******************************** */
/* *****   payments  page   ************ */
jQuery(document).ajaxComplete(function () {
	var tab = jQuery('#payments-details-ajax').DataTable();
	tab.destroy();
    jQuery('#payments-details-ajax').DataTable({
        dom: 'lfrtipB',

        buttons: [
            'excelHtml5',
            'pdfHtml5'
        ]
    });
	var tabsp = jQuery('#payments-staffp-details-ajax').DataTable();
	tabsp.destroy();
    jQuery('#payments-staffp-details-ajax').DataTable({
        dom: 'lfrtipB',
        buttons: [
            'excelHtml5',
            'pdfHtml5'
        ]
    });
	var tabsbp = jQuery('#payments-staff-bookingandpymnt-details-ajax').DataTable();
	tabsbp.destroy();
    jQuery('#payments-staff-bookingandpymnt-details-ajax').DataTable({
        dom: 'lfrtipB',
        buttons: [
            'excelHtml5',
            'pdfHtml5'
        ]
    });
});
jQuery(document).on('click', '.mybtngetpaymentdate', function () {
	jQuery('.ct-loading-main').show();
    var startDate = jQuery('#reportrange').data('daterangepicker').startDate.format('YYYY-MM-DD');
    var endDate = jQuery("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD');
	var table = jQuery('#payments-details-ajax').DataTable();
    jQuery.ajax({
        type: 'post',
        data: {getallpaymentbydate: 1, startdate: startDate, enddate: endDate},
        url: ajax_url + "admin_payments_ajax.php",
        success: function (res) {
			jQuery('.mytabledisplaypayment').html(res);
			jQuery('.ct-loading-main').hide();
		}
    });
});

/*  data table for export data with excel, csv, pdf  */
jQuery(document).ready(function () {
    jQuery('#payments-details').DataTable({
        dom: 'lfrtipB',

        buttons: [
            'excelHtml5',
            'pdfHtml5'
        ]
    });
	jQuery('#staff-payments-details').DataTable({
        dom: 'lfrtipB',
		buttons: [
		   {
		   extend: 'excelHtml5',
		   exportOptions: {
			 columns: [ 0, 1, 2 ,3 ,4 ,5 ,6 ]
		   }
		   },
		   {
		   extend: 'pdfHtml5',
		   exportOptions: {
		   columns: [ 0, 1, 2 ,3 ,4 ,5 ,6 ]
		   }
		   },
        ]
    });
});


jQuery(document).ready(function () {
    jQuery('#ct-promocode-list, #staff-payments-adding').DataTable();
    responsive: true
});

/* ******************************** */
/* *****   export page  ************ */

/*  export date range picker  */
jQuery(function () {
    function cb(start, end) {
        jQuery('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    cb(moment().subtract(29, 'days'), moment());

    jQuery('#reportrange').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

});




jQuery(function () {
    function cb(start, end) {
        jQuery('#reportrange-staff-payment span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    cb(moment().subtract(29, 'days'), moment());

    jQuery('#reportrange-staff-payment').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

});

/*  data table for export data with excel, csv, pdf  */

/* booking information information export details */
jQuery(document).ready(function () {
    jQuery('#booking-info-table').DataTable({
        dom: 'lfrtipB',

        buttons: [
           {
			extend: 'copyHtml5',
			exportOptions: {
			columns: [ 0, 1, 2 ,3 ,4 ,5 ,6 ]
			}
			},
			{
			extend: 'csvHtml5',
			exportOptions: {
			  columns: [ 0, 1, 2 ,3 ,4 ,5 ,6 ]
			}
			},
			{
			extend: 'excelHtml5',
			exportOptions: {
			  columns: [ 0, 1, 2 ,3 ,4 ,5 ,6 ]
			}
			},
			{
			extend: 'pdfHtml5',
			exportOptions: {
			columns: [ 0, 1, 2 ,3 ,4 ,5 ,6 ]
			}
			},
        ]
    });
});
/* staff member information export details */
jQuery(document).ready(function () {
    jQuery('#staff-info-table').DataTable({
        dom: 'lfrtipB',

        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});
/* services information export details */
jQuery(document).ready(function () {
    jQuery('#services-info-table').DataTable({
        dom: 'lfrtipB',

        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});
/* category information export details */
jQuery(document).ready(function () {
    jQuery('#category-info-table').DataTable({
        dom: 'lfrtipB',

        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});

/*  registered customers booking details page  */
jQuery(document).ready(function () {
    jQuery('#registered-client-booking-details').DataTable({
        dom: 'frtipB',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});
/*  registered customers listing page  */
jQuery(document).ready(function () {
    jQuery('#registered-client-table').DataTable({
        dom: 'lfrtipB',

        buttons: [
				{
				extend: 'copyHtml5',
				exportOptions: {
				columns: [ 0, 1 ,2 ]
				}
				},
				{
				extend: 'csvHtml5',
				exportOptions: {
				  columns: [ 0, 1 ,2 ]
				}
				},
				{
				extend: 'excelHtml5',
				exportOptions: {
				  columns: [ 0, 1 ,2 ]
				}
				},
				{
				extend: 'pdfHtml5',
				exportOptions: {
				columns: [ 0, 1 ,2 ]
				}
				},
			]
    });
});

/*  guest customers listing page  */
jQuery(document).ready(function () {
    jQuery('#guest-client-table').DataTable({
        dom: 'lfrtipB',

        buttons: [
				 {
			extend: 'copyHtml5',
			exportOptions: {
			columns: [ 0, 1, 2 ]
			}
			},
			{
			extend: 'csvHtml5',
			exportOptions: {
			  columns: [ 0, 1, 2 ]
			}
			},
			{
			extend: 'excelHtml5',
			exportOptions: {
			  columns: [ 0, 1, 2 ]
			}
			},
			{
			extend: 'pdfHtml5',
			exportOptions: {
			columns: [ 0, 1, 2 ]
			}
			},
        ]
    });
});
/*  guest customers booking details page  */
jQuery(document).ready(function () {
    jQuery('#guest-client-booking-details').DataTable({
        dom: 'frtipB',

        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
});

/*  dashboard chart  */
var doughnutData = [
    {
        value: 80,
        color: "#F7464A",
        highlight: "#FF5A5E",
        label: "<b>dsfkljfkdskfd<br />asaklfsdklfsdakl</b>"
    },
    {
        value: 50,
        color: "#46BFBD",
        highlight: "#5AD3D1",
        label: "Green"
    },
    {
        value: 100,
        color: "#FDB45C",
        highlight: "#FFC870",
        label: "Yellow"
    },
    {
        value: 40,
        color: "#949FB1",
        highlight: "#A8B3C5",
        label: "Grey"
    },
    {
        value: 120,
        color: "#4D5360",
        highlight: "#616774",
        label: "Dark Grey"
    }

];

/*  Dashboard today and latest activity popup  */
jQuery(document).on('click', '.ct-today-list', function () {
    jQuery('.modal').css('background', 'rgba(0,0,0,0.1)');

});
jQuery(document).on('click', '.ct-activity-list', function () {
    jQuery('.modal').css('background', 'rgba(0,0,0,0.1)');
});


/*  image upload in services  */
/* convert bytes into friendly format */
function bytesToSize(bytes) {
    var sizes = ['Bytes', 'KB', 'MB'];
    if (bytes == 0) return 'n/a';
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
};

/* check for selected crop region */
function checkForm() {
    if (parseInt(jQuery('#w').val())) return true;
    jQuery('.error').html(errorobj_please_select_a_crop_region_and_then_press_upload).show();
    return false;
};


/* clear info by cropping (onRelease event handler) */
function clearInfo() {
    jQuery('.info #w').val('');
    jQuery('.info #h').val('');
};

function storeCoords(c) {

    jQuery('#X').val(c.x);
    jQuery('#Y').val(c.y);
    jQuery('#W').val(c.w);
    jQuery('#H').val(c.h);


};

/* Create variables (in this scope) to hold the Jcrop API and image size */ 
var jcrop_api, boundx, boundy;



jQuery(document).on('change', '.ct-upload-images', function (e) {
    var uploadsection = jQuery(this).attr('id');
    var ctus = jQuery(this).data('us');
    var oFile = jQuery('#' + uploadsection)[0].files[0];
    jQuery('#' + ctus + 'ctimagename').val(oFile.name);

    /* check for image type (jpg and png are allowed) */
    var rFilter = /^(image\/jpeg|image\/png|image\/gif)$/i;
    if (!rFilter.test(oFile.type)) {
        jQuery('.error_image').addClass('error');
        jQuery('.error_image').html(errorobj_please_select_a_valid_image_file_jpg_and_png_are_allowed).show();
        return;
    }


    /*  check for file size  */
    var file = this.files[0];
    var fileType = file["type"];
    var ValidImageTypes = ["image/jpeg", "image/png", "image/gif"];
    if ($.inArray(fileType, ValidImageTypes) < 0) {
        jQuery('.error_image').addClass('error');
        jQuery('.error_image').html(errorobj_only_jpeg_png_and_gif_images_allowed);
        return;
    }
    var file_size = $(this)[0].files[0].size;
    var maxfilesize = 1048576 * 2;
    /*  Here 2 repersent MB  */
    if (file_size >= maxfilesize) {
        jQuery('.error_image').addClass('error');
        jQuery('.error_image').html(errorobj_maximum_file_upload_size_2_mb);
        return;
    }
    var file_size = $(this)[0].files[0].size;
    var minfilesize = 1048576 * 0.0005; 
	
    /*  Here 5 repersent KB  */
    if (file_size <= minfilesize) {
			jQuery('.error_image').addClass('error');
			jQuery('.error_image').html(errorobj_minimum_file_upload_size_1_kb);
        return;
    }

    /* preview element */
    var oImage = document.getElementById('ct-preview-img' + ctus);

    /* prepare HTML5 FileReader */
    var oReader = new FileReader();
    oReader.onload = function (e) {

        /* e.target.result contains the DataURL which we can use as a source of the image */
        oImage.src = e.target.result;
        oImage.onload = function () { /* onload event handler */

            /* show image popup for image crop */
            jQuery('#ct-image-upload-popup' + ctus).modal();

            /*  display some basic image info */
            var sResultFileSize = bytesToSize(oFile.size);
            jQuery('#' + ctus + 'filesize').val(sResultFileSize);
            jQuery('#' + ctus + 'ctimagetype').val(oFile.type);
            /* jQuery('#filedim').val(oImage.naturalWidth + ' x ' + oImage.naturalHeight); */

            /* destroy Jcrop if it is existed */
            if (typeof jcrop_api != 'undefined') {
                jcrop_api.destroy();
                jcrop_api = null;
                jQuery('#ct-preview-img' + ctus).width(oImage.naturalWidth);
                jQuery('#ct-preview-img' + ctus).height(oImage.naturalHeight);
            }
            jQuery('#ct-preview-img' + ctus).width(oImage.naturalWidth);
            jQuery('#ct-preview-img' + ctus).height(oImage.naturalHeight);
            setTimeout(function () {

                jQuery('#ct-preview-img' + ctus).Jcrop({
                    minSize: [32, 32], /* min crop size */
                    /* onSelect: [0, 0, 150, 180], */
                    setSelect: [1000,1000, 180, 200],
                    /* aspectRatio: 1, */ /* keep aspect ratio 1:1 */
                    bgFade: true, /* use fade effect */
                    bgOpacity: .3, /* fade opacity   */
                    /* maxSize: [200, 200],           */

                    boxWidth: 575,   /* Maximum width you want for your bigger images */
                    boxHeight: 400,
                    /* trueSize : [1000,1500], */
                    /* onSelect: showCoords,   */
                    /* onChange: showCoords,   */

                    onChange: function (e) {
                        jQuery('#' + ctus + 'x1').val(e.x);
                        jQuery('#' + ctus + 'y1').val(e.y);
                        jQuery('#' + ctus + 'x2').val(e.x2);
                        jQuery('#' + ctus + 'y2').val(e.y2);
                        jQuery('#' + ctus + 'w').val(e.w);
                        jQuery('#' + ctus + 'h').val(e.h);
                    },
                    onSelect: function (e) {
                        jQuery('#' + ctus + 'x1').val(e.x);
                        jQuery('#' + ctus + 'y1').val(e.y);
                        jQuery('#' + ctus + 'x2').val(e.x2);
                        jQuery('#' + ctus + 'y2').val(e.y2);
                        jQuery('#' + ctus + 'w').val(e.w);
                        jQuery('#' + ctus + 'h').val(e.h);
                    },
                    onRelease: clearInfo
                }, function () {
                    /* jcrop_api.destroy(); */
                    /* use the Jcrop API to get the real image size */
                    var bounds = this.getBounds();
                    boundx = bounds[0];
                    boundy = bounds[1];

                    /* Store the Jcrop API in the jcrop_api variable */
                    jcrop_api = this;
                });
            }, 500);

        };
    };

    oReader.readAsDataURL(oFile);
});


/*  delete service image popover  */
jQuery(document).ready(function () {
    jQuery('#ct-remove-service-image').popover({
        html: true,
        content: function () {
            return jQuery('#popover-ct-remove-service-image').html();
        }
    });
});
/*  hide delete service image popover  */
jQuery(document).on('click', '#ct-close-popover-service-image', function () {
    jQuery('.popover').fadeOut();
});


/*  delete member image popover  */
jQuery(document).ready(function () {
    jQuery('#ct-remove-member-image').popover({
        html: true,
        content: function () {
            return jQuery('#popover-ct-remove-member-image').html();
        }
    });
});
/*  hide delete member image popover  */
jQuery(document).on('click', '#ct-close-popover-member-image', function () {
    jQuery('.popover').fadeOut();
});

/*  delete customer image popover  */
jQuery(document).ready(function () {
    jQuery('#ct-remove-customer-image').popover({
        html: true,
        content: function () {
            return jQuery('#popover-ct-remove-customer-image').html();
        }
    });
});
/*  hide delete customer image popover  */
jQuery(document).on('click', '#ct-close-popover-customer-image', function () {
    jQuery('.popover').fadeOut();
});

/*  delete new customer image popover  */
jQuery(document).ready(function () {
    jQuery('#ct-remove-new-customer-image').popover({
        html: true,
        content: function () {
            return jQuery('#popover-ct-remove-new-customer-image').html();
        }
    });
});
/*  hide delete new customer image popover  */
jQuery(document).on('click', '#ct-close-popover-new-customer-image', function () {
    jQuery('.popover').fadeOut();
});

/*  delete company logo popover  */
jQuery(document).ready(function () {
    jQuery('#ct-remove-company-logo').popover({
        html: true,
        content: function () {
            return jQuery('#popover-ct-remove-company-logo').html();
        }
    });
});
/*  hide delete company logo popover  */
jQuery(document).on('click', '#ct-close-popover-company-logo', function () {
    jQuery('.popover').fadeOut();
});




jQuery(document).ajaxComplete(function () {
    jQuery('[data-toggle="popover"]').popover({
        placement: 'left',
        html: true,
        content: function () {
            return jQuery(this).next('#popover-delete-service').html();
        }
    });
});

jQuery(document).ready(function () {
    jQuery('[data-toggle="popover"]').popover({
        placement: 'left',
        html: true,
        content: function () {
			jQuery('#ct-close-popover-delete-service').trigger('click');
			return jQuery(this).next('#popover-delete-servicess').html();
        }
    });
});


/* SERVICE PAGE */
/*  FUNRTION FOR SERCVICES */
jQuery(document).ready(function () {
    jQuery("#sortable-services").sortable({
        update: function () {
            var i = 1;
            var pos = [];
            var ids = [];
            jQuery('.mysortlist').each(function () {
                pos.push(i++);
                ids.push(jQuery(this).data('id'));
            });
            jQuery('.ct-loading-main').show();
            jQuery.ajax({
                type: 'post',
                data: {
                    'pos': pos,
                    'ids': ids
                },
                url: ajax_url + "service_ajax.php",
                success: function (res) {
                    jQuery('.ct-loading-main').hide();
                }
            });
        }
    });
});

/*  FUNCTION FOR SERCVICES_methods */
jQuery(document).ready(function () {
    jQuery("#sortable-services-methods").sortable({
        update: function () {
            var i = 1;
            var pos = [];
            var ids = [];
            jQuery('.mysortlist_methods').each(function () {
                pos.push(i++);
                ids.push(jQuery(this).data('id'));
            });
			jQuery('.ct-loading-main').show();
            jQuery.ajax({
                type: 'post',
                data: {
                    'pos': pos,
                    'ids': ids
                },
                url: ajax_url + "service_method_ajax.php",
                success: function (res) {
                    jQuery('.ct-loading-main').hide();
                }
            });
        }
    });
});
/*  FUNCTION FOR SERCVICES_units */
jQuery(document).ready(function () {
    jQuery("#sortable-services-unit").sortable({
        update: function () {
            var i = 1;
            var pos = [];
            var ids = [];
            jQuery('.mysortlist_units').each(function () {
                pos.push(i++);
                ids.push(jQuery(this).data('id'));
            });
			jQuery('.ct-loading-main').show();
            jQuery.ajax({
                type: 'post',
                data: {
                    'pos': pos,
                    'ids': ids
                },
                url: ajax_url + "service_method_units_ajax.php",
                success: function (res) {
                    jQuery('.ct-loading-main').hide();
                }
            });
        }
    });
});




/* DELETE SERVICE
 jQuery(document).on('click', '.service-delete-button', function () {
 jQuery('.ct-loading-main').show();
 jQuery.ajax({
 type: 'post',
 data: {
 'deleteid': jQuery(this).data('serviceid'),
 'imagename': jQuery(this).data('imagename')
 },
 url: ajax_url + "service_ajax.php",
 success: function (res) {
 jQuery('.mainheader_message').show();
 jQuery('.mainheader_message_inner').css('display', 'inline');
 jQuery('#ct_sucess_message').text("Record Deleted Successfully");
 jQuery('.mainheader_message').fadeOut(3000);
 jQuery('.ct-loading-main').hide();
 location.reload();
 }
 });
 }); */

/* DELETE SERVICE  */
jQuery(document).on('click', '.service-delete-button', function () {
    jQuery('.ct-loading-main').show();
    var deleteid=jQuery(this).data('serviceid');
    var imagename=jQuery(this).data('imagename');
    jQuery.ajax({
        type: 'post',
        data: {
            'deleteid':deleteid,
            'imagename':imagename
        },
        url: ajax_url + "service_ajax.php",
        success: function (res) {
            jQuery('.mainheader_message').show();
            jQuery('.mainheader_message_inner').css('display', 'inline');
            jQuery('#ct_sucess_message').text(errorobj_record_deleted_successfully);
            jQuery('.mainheader_message').fadeOut(3000);
            jQuery('.ct-loading-main').hide();
            jQuery('#ct-close-popover-delete-service').trigger("click");

            jQuery('#servicelist'+deleteid).fadeOut('slow');
        }
    });
});

/* UPADTE STATUS OF  SERVICE  */
jQuery(document).on('change', '.myservice_status', function () {

    if (jQuery(this).prop("checked") == true) {
        jQuery('.ct-loading-main').show();
        var id = jQuery(this).data('id');
        jQuery.ajax({
            type: 'post',
            data: {
                id: id,
                changestatus: "E"
            },
            url: ajax_url + "service_ajax.php",
            success: function (res) {
                jQuery('.mainheader_message').show();
                jQuery('.mainheader_message_inner').css('display', 'inline');
                jQuery('#ct_sucess_message').text(res);
                jQuery('.mainheader_message').fadeOut(3000);
                jQuery('.ct-loading-main').hide();
            }
        });
    }
    else {
        jQuery('.ct-loading-main').show();
        var id = jQuery(this).data('id');
        jQuery.ajax({
            type: 'post',
            data: {
                id: id,
                changestatus: "D"
            },
            url: ajax_url + "service_ajax.php",
            success: function (res) {
                jQuery('.mainheader_message').show();
                jQuery('.mainheader_message_inner').css('display', 'inline');
                jQuery('#ct_sucess_message').text(res);
                jQuery('.mainheader_message').fadeOut(3000);
                jQuery('.ct-loading-main').hide();
            }
        });
    }
});

/* UPLOAD SERVCIE IMAGE */
var serviceimagename = "";
jQuery(document).on("click", ".ct_upload_img1", function (e) {
    jQuery('.ct-loading-main').show();
    var img_site_url = servObj.site_url;
    var imgObj_url = imgObj.img_url;
    var imageuss = jQuery(this).data('us');
    var imageids = jQuery(this).data('imageinputid');
    var file_data = jQuery("#" + jQuery(this).data('imageinputid')).prop("files")[0];
    var formdata = new FormData();
    var ctus = jQuery(this).data('us');
    var img_w = jQuery('#' + ctus + 'w').val();
    var img_h = jQuery('#' + ctus + 'h').val();
    var img_x1 = jQuery('#' + ctus + 'x1').val();
    var img_x2 = jQuery('#' + ctus + 'x2').val();
    var img_y1 = jQuery('#' + ctus + 'y1').val();
    var img_y2 = jQuery('#' + ctus + 'y2').val();
    var img_name = jQuery('#' + ctus + 'newname').val();
    var img_id = jQuery('#' + ctus + 'id').val();

    formdata.append("image", file_data);
    formdata.append("w", img_w);
    formdata.append("h", img_h);
    formdata.append("x1", img_x1);
    formdata.append("x2", img_x2);
    formdata.append("y1", img_y1);
    formdata.append("y2", img_y2);
    formdata.append("newname", img_name);
    formdata.append("img_id", img_id);

    jQuery.ajax({
        url: ajax_url + "upload.php",
        type: "POST",
        data: formdata,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            jQuery('.ct-loading-main').hide();
            if (data == "") {
                 jQuery('.error-service').addClass('show');
                jQuery('.hidemodal').trigger('click');
            } else {
                jQuery('#' + ctus + 'ctimagename').val(data);
                jQuery('.hidemodal').trigger('click');
                jQuery('#' + ctus + 'serviceimage').attr('src', imgObj_url + "services/" + data);
                jQuery('.error_image').hide();
                jQuery('#' + ctus + 'serviceimage').attr('data-imagename', data);
                serviceimagename = jQuery('#' + ctus + 'serviceimage').data('imagename');
            }
            jQuery('#'+imageids).val('');
        }
    });
});
/* When Check 'Hourly Service', display Allow 30 min Increments */
jQuery(document).on('change', '.service-is-hourly', function () {
    if (jQuery(this).is(':checked')) {
        jQuery('.tr-allow-30').show();
    } else {
        jQuery('.tr-allow-30').hide();
    }
});

/*  INSERT SERVICE */
jQuery(document).on('click', '.myserviceaddbtn', function () {
    var color = jQuery('.mycolortag').val();
    var title = jQuery('.myservicetitle').val();
    var desc = jQuery('.myservicedesc').val();
    var price = jQuery('.myserviceprice').val();
    var is_hourly = jQuery('.myserviceishourly').is(':checked') ? 1 : 0;
    var allow_30 = (jQuery('.myserviceallow30').is(':checked')&&is_hourly) ? 1 : 0;

    var image =  jQuery('#pcasctimagename').val();

    /*  service edit form validation  */
    jQuery('#addservice_form').validate();

    jQuery("#ct-service-title").rules("add",
        {
            required: true,
            messages: {required: errorobj_please_enter_service_title}
        });
    jQuery("#ct-service-color-tag").rules("add",
        {
            required: true,
            messages: {required: errorobj_please_enter_color_code}
        });


    if (!jQuery('#addservice_form').valid()) {
        return false;
    }
    jQuery('.ct-loading-main').show();
    jQuery.ajax({
        type: 'post',
        data: {
            'color': color,
            'title': title,
            'description': desc,
            'price': price,
            'is_hourly': is_hourly,
            'allow_30': allow_30,
            'image': image,
            'operationadd': 1,
            'status': 'D',
            'position': 0
        },
        url: ajax_url + "service_ajax.php",
        success: function (res) {

            if(parseInt(res) == 1){
                jQuery('.mainheader_message_fail').show();
                jQuery('.mainheader_message_inner_fail').css('display', 'inline');
                jQuery('#ct_sucess_message_fail').text(errorobj_sorry_service_already_exist);
                jQuery('.mainheader_message_fail').fadeOut(3000);
                jQuery('.ct-loading-main').hide();
            }
            else{
                jQuery('.mainheader_message').show();
                jQuery('.mainheader_message_inner').css('display', 'inline');
                jQuery('#ct_sucess_message').text(errorobj_record_inserted_successfully);
                jQuery('.mainheader_message').fadeOut(3000);
                jQuery('.ct-loading-main').hide();
                location.reload();
            }

        }
    });
});

/* EDIT SERVICE */
jQuery(document).on('click', '.edtservicebtn', function () {
    var i = jQuery(this).data('id');
    var color = jQuery('.edtservicecolor' + i).val();
    var title = jQuery('.edtservicetitle' + i).val();
    var desc = jQuery('.edtservicedesc' + i).val();
    var price = jQuery('.edtserviceprice' + i).val();
    var is_hourly = jQuery('.edtserviceishourly' + i).is(':checked') ? 1 : 0;
    var allow_30 = (jQuery('.edtserviceallow30' + i).is(':checked')&&is_hourly) ? 1 : 0;
    var image = jQuery('#pcls' + i + 'ctimagename').val();
    /* service edit form validation */
    jQuery('#editform_service' + i).validate();
    jQuery.validator.addMethod("pattern_title", function(value, element) {
        return this.optional(element) || /^[a-zA-Z '.'_@./#&+-]+$/.test(value);
    }, "Enter Only Alphabets");
    jQuery("#ct-service-title" + i).rules("add",
        {
            required: true,
            messages: {required: errorobj_please_enter_service_title}
        });
    jQuery("#ct-service-color-tag" + i).rules("add",
        {
            required: true,
            messages: {required: errorobj_please_enter_color_code}
        });

    if (!jQuery('#editform_service' + i).valid()) {
        return false;
    }
    jQuery('.ct-loading-main').show();
    jQuery.ajax({
        type: 'post',
        data: {
            'id': i,
            'color': color,
            'title': title,
            'description': desc,
            'price' : price,
            'is_hourly': is_hourly,
            'allow_30': allow_30,
            'image': image,
            'operationedit': 1,
            'status': 'D',
            'position': 0
        },
        url: ajax_url + "service_ajax.php",
        success: function (res) {
            jQuery('.mainheader_message').show();
            jQuery('.mainheader_message_inner').css('display', 'inline');
            jQuery('#ct_sucess_message').text(errorobj_record_updated_successfully);
            jQuery('.mainheader_message').fadeOut(3000);
            jQuery('.ct-loading-main').hide();
            jQuery('#detail_myid'+i).fadeOut();
            /*  jQuery('#detail_myid'+i).css('display','none'); */
            jQuery('#myid'+i).prop('checked',false);
            jQuery('#color_back'+i).css('background-color',color);
            var str_title = title;
            str_title = str_title.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                return letter.toUpperCase();
            });
            jQuery('#title_ser'+i).html(str_title);
            jQuery('#ct-service-title'+i).val(str_title);
            
            jQuery('.ser_del_icon').hide();
            /*  jQuery('.new_cam_ser').hide(); */
            if (image == '' || image == null) {

            } else {
                jQuery('.ct-clean-service-img-icon-label').hide();
                jQuery('.ct-clean-service-img-icon-label').removeClass('show');
                jQuery('.old_cam_ser'+i).hide();
                jQuery('.del_btn_popup'+i).show();
                jQuery('.del_btn_popup'+i).addClass('show');
                jQuery('.new_del_ser').hide();
                jQuery('.new_cam_ser').hide();
            }
            location.reload();
        }
    });
});


/* CHANGE FRONT END VIEW DESIGN OF SERVICES */
jQuery(document).on('click', '.design_radio_btn', function () {
    mydesignid = jQuery(this).val();
    mydivname = "service";
    jQuery.ajax({
        type: 'post',
        data: {
            'designid': mydesignid,
            'divname': mydivname,
            'assigndesign': 1
        },
        url: ajax_url + "service_ajax.php",
        success: function (res) {

        }
    });
});





/* 
 ASSIGN METHOD TO SERVICE PAGE
 SERVICE METHODS PAGE */
/* 
mydesign stands for design id which we assign example design -1,2,3,4
mydivname stands for for which section we want to assign the design
*/
var mydesignid = "";
var mydivname = "";
jQuery('.mybtnsavefordesign').css('display', 'none');


/* CHANGE DESIGN SELECTION FOR DISPLAYING IT IN FRONT END */
jQuery(document).on('click', '.design_radio_btn_units', function () {
    jQuery('.ct-loading-main').show();
    mydesignid = jQuery(this).val();
    mymethodunitsid = jQuery(this).data('methodid');

    jQuery.ajax({
        type: 'post',
        data: {
            'designid': mydesignid,
            'service_method_id': mymethodunitsid,
            'assigndesign': 1
        },
        url: ajax_url + "service_method_units_ajax.php",
        success: function (res) {
            jQuery('.ct-loading-main').hide();
        }
    });
});

/* SET TITLE FOR THE PAGE OF SERVICES METHODS IN BREADCRUMB */
// Set is_hourly, allow_30 to localStorage
jQuery(document).on('click', '.mybtnforassignmethods', function () {
    var id = jQuery(this).data('id');
    var title = jQuery(this).data('name');
    localStorage['serviceid'] = id;
    localStorage['title'] = title;
    localStorage['is_hourly'] = jQuery(this).data('is_hourly');
    localStorage ['allow_30'] = jQuery(this).data('allow_30');
    window.location = "service-manage-calculation-methods.php";
});

/* LOAD ALL METHODS FROM DB IN UL */
jQuery(document).ready(function () {

    var str = window.location.pathname;
    var last = str.substring(str.lastIndexOf("/") + 1, str.length);
    if (last == "service-manage-calculation-methods.php") {
        jQuery('.ct-loading-main').show();
        jQuery('.myservicetitleformethod').html("" + localStorage['title']);
        jQuery('.myhiddenserviceid').val("" + localStorage['serviceid']);
        jQuery.ajax({
            type: 'post',
            data: {
                'service_id': localStorage['serviceid'],
                'getallservicemethod': 1
            },
            url: ajax_url + "service_method_ajax.php",
            success: function (res) {
                jQuery('.myservicemethodload').html(res);
                jQuery('.ct-loading-main').hide();
            }
        });
    }
});

/* DELETE SERVICE METHOD
 jQuery(document).on('click', '.service-methods-delete-button', function () {
 jQuery('.ct-loading-main').show();
 deletedata(jQuery(this).data('servicemethodid'), ajax_url + "service_method_ajax.php");
 jQuery('.ct-loading-main').hide();
 }); */
/* DELETE SERVICE METHOD */
jQuery(document).on('click', '.service-methods-delete-button', function () {
    jQuery('.ct-loading-main').show();
    var deletemethoid=jQuery(this).data('servicemethodid');
    var datastring={deletemethoid:deletemethoid,action:'deletemethod'};
    jQuery.ajax({
        type:'POST',
        url:ajax_url + "service_method_ajax.php",
        data:datastring,
        success:function(response){
			jQuery('.ct-loading-main').hide();
            jQuery('.mainheader_message').show();
            jQuery('.mainheader_message_inner').css('display', 'inline');
            jQuery('#ct_sucess_message').text(errorobj_method_deleted_successfully);
            jQuery('.mainheader_message').fadeOut(3000);
            jQuery('#ct-close-popover-delete-service').trigger("click");
            jQuery('#service_method_'+deletemethoid).fadeOut(1000);
        }
    });
});

/* UPDATE SERVICE METHODS STATUS */
jQuery(document).on('change', '.myservices_methods_status', function () {

	jQuery('.ct-loading-main').show();
	var id = jQuery(this).data('id');
	var statuss = jQuery(this).prop("checked");

	if (statuss == false) {
        jQuery(this).prop("checked","");
		var st = 'D';
    } else {
		jQuery(this).prop("checked");
        var st = 'E';
    }
	jQuery.ajax({
            type: 'post',
            data: {
                id: id,
                changestatus: st
            },
            url: ajax_url + "service_method_ajax.php",
            success: function (res) {
				jQuery('.ct-loading-main').hide();
                jQuery('.mainheader_message').show();
                jQuery('.mainheader_message_inner').css('display', 'inline');
                jQuery('#ct_sucess_message').text(res);
                jQuery('.mainheader_message').fadeOut(3000);
            }
        });
		event.preventDefault(); 
	
});

/* INSERT SERVICE METHODS */
jQuery(document).on('click', '.btnservices_method', function () {
    /* needed service_id,methodname,status */
    var service_id = localStorage['serviceid'];
    var name = jQuery('.mytxtservice_methodname').val();

    /* service edit form validation */
    jQuery('#service_method_addform').validate();

    jQuery("#txtmethodname").rules("add",
        {
            required: true,
            messages: {required: errorobj_please_enter_method_title}
        });

    if (!jQuery('#service_method_addform').valid()) {
        return false;
    }
    jQuery('.ct-loading-main').show();
    jQuery.ajax({
        type: 'post',
        data: {
            'service_id': service_id,
            'name': name,
            'status': 'D',
            'operationinsert': 1
        },
        url: ajax_url + "service_method_ajax.php",
        success: function (res) {
            if(parseInt(res) == 1){
                jQuery('.ct-loading-main').hide();
                jQuery('.mainheader_message_fail').show();
                jQuery('.mainheader_message_inner_fail').css('display', 'inline');
                jQuery('#ct_sucess_message_fail').text(errorobj_sorry_method_already_exist);
                jQuery('.mainheader_message_fail').fadeOut(3000);
            }
            else{
                jQuery('.mainheader_message').show();
                jQuery('.mainheader_message_inner').css('display', 'inline');
                jQuery('#ct_sucess_message').text(errorobj_method_inserted_successfully);
                jQuery('.mainheader_message').fadeOut(3000);
                jQuery('.ct-loading-main').hide();
                location.reload();
            }
        }
    });

});

/* UPDATE SERVICE METHODS DATA */
jQuery(document).on('click', '.btnservices_method_update', function () {
    var i = jQuery(this).data('id');
    var title = jQuery('.mytxtservice_methodname' + i).val();

    /* service edit form validation */
    jQuery('#service_method_editform' + i).validate();

    jQuery("#txtedtmethodname" + i).rules("add",
        {
            required: true,
            messages: {required: errorobj_please_enter_method_title}
        });

    if (!jQuery('#service_method_editform' + i).valid()) {
        return false;
    }
    jQuery('.ct-loading-main').show();
    jQuery.ajax({
        type: 'post',
        data: {
            'id': i,
            'method_title': title,
            'operationedit': 1
        },
        url: ajax_url + "service_method_ajax.php",
        success: function (res) {
            jQuery('.mainheader_message').show();
            jQuery('.mainheader_message_inner').css('display', 'inline');
            jQuery('#ct_sucess_message').text(errorobj_record_updated_successfully);
            jQuery('.mainheader_message').fadeOut(3000);
            jQuery('.ct-loading-main').hide();
            jQuery('#detailmes_sp'+i).fadeOut();
            jQuery('#sp'+i).prop("checked",false);
            var str_title = title;
            str_title = str_title.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                return letter.toUpperCase();
            });
            jQuery('#service_name'+i).html(str_title);
            jQuery('#txtedtmethodname'+i).val(str_title);
        }
    });
});


/* SERVICE METHODS UNITS */

/* service-manage-unit-price-btn */
/* set id and title of method to service-manage-unit-price-code */
jQuery(document).ajaxComplete(function () {
    jQuery(document).on('click', '.mybtnforassignunits', function () {
        var id = jQuery(this).data('id');
        var title = jQuery(this).data('name');
        localStorage['methodid'] = id;
        localStorage['method_title'] = title;
        window.location = "service-manage-unit-price.php";
    });
});


/* SERVICE METHODS UNITS TITLE SET AND LOAD ALL UNITS */
jQuery(document).ready(function ()
 {
    var str = window.location.pathname;
    var last = str.substring(str.lastIndexOf("/") + 1, str.length);
    if (localStorage['title'] == "") {
        window.location.replace(link_url + "services.php");
    }
    if (last == "service-manage-unit-price.php") {
        jQuery('.mydesign-setting-button').hide();
        jQuery('.myservicetitleformethod').html("" + localStorage['title']);
        jQuery('.mydesign-setting-button').hide();
        jQuery('.mymethodtitleforunit').html("" + localStorage['title'] + " - " + localStorage['method_title']);
        jQuery('.mymethodtitleforunitbrcr').html(localStorage['method_title']);
        jQuery('.ct-loading-main').show();

        jQuery.ajax({
            type: 'post',
            data: {
                'service_id': localStorage['serviceid'],
                'method_id': localStorage['methodid'],
                'setfrontdesign': 1
            },
            url: ajax_url + "service_method_units_ajax.php",
            success: function (res) {
                jQuery('.ct-loading-main').hide();
                if(parseInt(res) == 1 || parseInt(res) == 0|| parseInt(res) == 5 ){
                    jQuery('.mydesign-setting-button').remove();
                }
                else
                {
                    jQuery('.mydesign-setting-button').show();
					var final_menu_popup = res.slice(0, -1);
					jQuery('.mymodalbody').html(final_menu_popup);
                }
            }
        });
        jQuery.ajax({
            type: 'post',
            data: {
                'service_id': localStorage['serviceid'],
                'method_id': localStorage['methodid'],
                'service_is_hourly': localStorage['is_hourly'],
                'service_allow_30': localStorage['allow_30'],
                'getservice_method_units': 1
            },
            url: ajax_url + "service_method_units_ajax.php",
            success: function (res) {
                jQuery('.myservice_method_unitload').html(res);
            }
        });
        jQuery.ajax({
            type: 'post',
            data: {
                'service_id': localStorage['serviceid'],
                'method_id': localStorage['methodid'],
                'checkunits_ofservice_methods': 1
            },
            url: ajax_url + "service_method_units_ajax.php",
            success: function (res) {
                 if (res == "0records" || jQuery('.mymodalbody').html() != "") {
					 
                }
                else {
					jQuery('.mydesign-setting-button').show();
                    jQuery('.mymodalbody').html(res);
                }
                jQuery('.ct-loading-main').hide();
            }
        });
    }
});

/* SERVICE METHODS UNITS INSERT NEW */
jQuery(document).on('click', '.mybtnservice_method_unitsave', function () {

    /* service edit form validation */
    jQuery('#service_method_unitaddform').validate();

    jQuery("#txtunitnamess").rules("add",
        {
            required: true,
            messages: {required: errorobj_please_enter_unit_title}
        });
    jQuery("#txtbasepricess").rules("add",
        {
            required: true, pattern_price: true,
            messages: {required: errorobj_please_assign_base_price_for_unit}
        });


    if (!jQuery('#service_method_unitaddform').valid()) {
        return false;
    }
    jQuery('.ct-loading-main').show();
    jQuery.ajax({
        type: 'post',
        data: {
            'service_id': localStorage['serviceid'],
            'method_id': localStorage['methodid'],
            'unit_name': jQuery('.mytxt_service_method_unitname').val(),
            'base_price': jQuery('.mytxt_service_method_unitbaseprice').val(),
            'operationinsert': 1
        },
        url: ajax_url + "service_method_units_ajax.php",
        success: function (res) {
            if(parseInt(res) == 1){
                jQuery('.ct-loading-main').hide();
                jQuery('.mainheader_message_fail').show();
                jQuery('.mainheader_message_inner_fail').css('display', 'inline');
                jQuery('#ct_sucess_message_fail').text(errorobj_sorry_unit_already_exist);
                jQuery('.mainheader_message_fail').fadeOut(3000);
            }
            else{
                jQuery('.mainheader_message').show();
                jQuery('.mainheader_message_inner').css('display', 'inline');
                jQuery('#ct_sucess_message').text(errorobj_unit_inserted_successfully);
                jQuery('.mainheader_message').fadeOut(3000);
                jQuery('.ct-loading-main').hide();
                window.location.reload();
            }
        }
    });
});

/* SERVICE METHODS UNITS DELETE */
jQuery(document).on('click', '.service-methods-units-delete-button', function () {
    /* Delete data is my own function */
	 jQuery('.ct-loading-main').show();
    var id = jQuery(this).data('service_method_unitid');

    jQuery.ajax({
        type: 'post',
        data: {
            'deleteid': id
        },
        url: ajax_url + "service_method_units_ajax.php",
        success: function (res) {
		 jQuery('.ct-loading-main').hide();
            jQuery('.mainheader_message').show();
            jQuery('.mainheader_message_inner').css('display', 'inline');
            jQuery('#ct_sucess_message').text(errorobj_record_deleted_successfully);
            jQuery('.mainheader_message').fadeOut(3000);
            location.reload();
        }
    });

});

/* SERVICE METHODS UNITS UPDATE STATUS */
jQuery(document).on('change', '.myservices_methods_units_status', function (event) {
    if (jQuery(this).prop("checked") == true) {
        jQuery('.ct-loading-main').show();
        var id = jQuery(this).data('id');

        jQuery.ajax({
            type: 'post',
            data: {
                id: id,
                changestatus: "E"
            },
            url: ajax_url + "service_method_units_ajax.php",
            success: function (res) {
                jQuery('.ct-loading-main').hide();
                jQuery('.mainheader_message_inner').css('display','inline');
                jQuery('#ct_sucess_message').html(errorobj_units_status_updated);
                jQuery('.mainheader_message').show();
                jQuery('.mainheader_message').fadeOut(5000);
                location.reload();
            }
        });
		event.preventDefault(); 
    }
    else {
        jQuery('.ct-loading-main').show();
        var id = jQuery(this).data('id');

        jQuery.ajax({
            type: 'post',
            data: {
                id: id,
                changestatus: "D"
            },
            url: ajax_url + "service_method_units_ajax.php",
            success: function (res) {
                jQuery('.ct-loading-main').hide();
                jQuery('.mainheader_message_inner').css('display','inline');
                jQuery('#ct_sucess_message').html(errorobj_units_status_updated);
                jQuery('.mainheader_message').show();
                jQuery('.mainheader_message').fadeOut(5000);
                location.reload();
            }
        });
		event.preventDefault(); 
    }
});

// when click check box to set the unit pricing to hourly or not
jQuery(document).on('change', '.chkunithourly', function () {
    var id = $(this).attr("id").replace('chkunithourly','');
    if($(this).is(":checked")) {
        $(".hours-section" + id).show();
    } else {
        $(".hours-section" + id).hide();
    }
});

/* SERVICE METHODS UNITS UPDATE */
jQuery(document).on('click', '.mybtnservice_method_unitupdate', function () {
    var i = jQuery(this).data('id');
    var units_title = jQuery('.mytxtservice_method_uniteditname' + i).val();
    var base_price = jQuery('.mytxtservice_method_uniteditbase_price' + i).val();
    var maxlimit = jQuery('.mytxt_service_method_editmaxlimit' + i).val();
    var maxlimit_title = jQuery('.mytxt_service_method_editmaxlimit_title' + i).val();

    var hourly_from = jQuery('#hours-from' + i).val();
    var hourly_to = jQuery('#hours-to' + i).val();

    jQuery('#service_method_unit_price' + i).validate();

    jQuery("#txtedtunitname" + i).rules("add",
        {
            required: true,
            messages: {required: errorobj_please_enter_unit_title}
        });
    jQuery("#txtedtunitbaseprice" + i).rules("add",
        {
            required: true, pattern_price: true,
            messages: {required: errorobj_please_assign_base_price_for_unit}
        });
    if (localStorage['is_hourly'] == 1) {
        jQuery("#txtedtunitmaxlimit" + i).rules("add",
            {
                required: true, pattern_onlynumber: true,
                messages: {required: errorobj_please_enter_maxlimit, pattern_onlynumber: errorobj_enter_only_digits}
            });
    }

    if (!jQuery('#service_method_unit_price' + i).valid()) {
        return false;
    }
    jQuery('.ct-loading-main').show();
    jQuery.ajax({
        type: 'post',
        data: {
            'id': i,
            'units_title': units_title,
            'base_price': base_price,
            'maxlimit': maxlimit,
            'maxlimit_title': maxlimit_title,
            'hourly_from' : hourly_from,
            'hourly_to' : hourly_to,
            'operationedit': 1
        },
        url: ajax_url + "service_method_units_ajax.php",
        success: function (res) {
            jQuery('.mainheader_message').show();
            jQuery('.mainheader_message_inner').css('display', 'inline');
            jQuery('#ct_sucess_message').text(errorobj_record_updated_successfully);
            jQuery('.ct-loading-main').hide();
            jQuery('.mainheader_message').fadeOut(3000);
            var str = jQuery('.mytxtservice_method_uniteditname' + i).val();
            str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                return letter.toUpperCase();
            });
            jQuery('#method_unit_name'+i).html(str);
            jQuery('#detailmes_sp'+i).fadeOut();
            jQuery('#sp'+i).prop("checked",false);
            location.reload();
        }
    });
});


/* SERVICE METHODS UNITS RATE DELETE ROW */
jQuery(document).on('click', '.mynewrow_btndelete', function () {
    jQuery(this).closest("li").remove();
});

/* SERVICE METHODS UNITS RATE LOAD ALL QTY RATE  */
jQuery(document).on('click', '.quantity-rules-btn', function () {
    var quantityno = jQuery(this).data('id');
    jQuery('.ct-loading-main').show();
    jQuery.ajax({
        type: 'post',
        data: {
            'unit_id': quantityno,
            'operation_getallqtyprice': 1
        },
        url: ajax_url + "service_method_units_ajax.php",
        success: function (res) {
            jQuery('.myunitspricebyqty' + quantityno).html(res);
        }
    });
    jQuery('.manage-unit-price-container' + quantityno).fadeIn();
    jQuery('.ct-loading-main').hide();
});


jQuery(document).on('click', '.myaddnewatyrule_units', function () {
    var id = jQuery(this).data('id');
    var qty = jQuery('.mynewqty' + id).val();
    var rules = jQuery('.mynewrule' + id).val();
    var price = jQuery('.mynewprice' + id).val();

    /* service edit form validation */
    jQuery('#mynewaddedform_units' + id).validate();
    jQuery("#mynewaddedqty_units" + id).rules("add",
        {
            required: true, pattern_onlynumber: true,
            messages: {required: errorobj_please_enter_some_qty}
        });
    jQuery("#mynewaddedprice_units" + id).rules("add",
        {
            required: true, pattern_price: true,
            messages: {required: errorobj_please_assign_price, pattern_price: errorobj_please_enter_valid_price}
        });


    if (!jQuery('#mynewaddedform_units' + id).valid()) {
        return false;
    }
    jQuery('.ct-loading-main').show();
    jQuery.ajax({
        type: 'post',
        data: {
            'unit_id': id,
            'qty': qty,
            'rules': rules,
            'price': price,
            'operation_insertqtyprice_unit': 1
        },
        url: ajax_url + "service_method_units_ajax.php",
        success: function (res) {
            jQuery.ajax({
                type: 'post',
                data: {
                    'unit_id': id,
                    'operation_getallqtyprice': 1
                },
                url: ajax_url + "service_method_units_ajax.php",
                success: function (ress) {
                    jQuery('.myunitspricebyqty' + id).html(ress);
                }
            });
            jQuery('.manage-unit-price-container' + id).fadeIn();
            jQuery('.ct-loading-main').hide();
        }
    });

});


/* delete the qty price from the selected method */
jQuery(document).on('click', '.myloadedbtndelete_units', function () {
    var delid = jQuery(this).data('id');
    jQuery('.ct-loading-main').show();
    jQuery.ajax({
        type: 'post',
        data: {
            'id': delid,
            'operationdelete_unitprice': 1
        },
        url: ajax_url + "service_method_units_ajax.php",
        success: function (res) {
            jQuery(".myunitqty_price_row" + delid).remove();
            jQuery('.ct-loading-main').hide();
        }
    });
});

/* edit the unit price by click of thumbs up symbol */
jQuery(document).on('click', '.myloadedbtnsave_units', function () {
    var editid = jQuery(this).data('id');
    var qty = jQuery('.myloadedqty_units' + editid).val();
    var rules = jQuery('.myloadedrules_units' + editid).val();
    var price = jQuery('.myloadedprice_units' + editid).val();

    jQuery('#myeditform_units' + editid).validate();
    jQuery("#myeditqty_units" + editid).rules("add",
        {
            required: true, pattern_onlynumber: true,
            messages: {required: errorobj_please_enter_some_qty}
        });
    jQuery("#myeditprice_units" + editid).rules("add",
        {
            required: true, pattern_price: true,
            messages: {required: errorobj_please_assign_price, pattern_price: errorobj_please_enter_valid_price}
        });


    if (!jQuery('#myeditform_units' + editid).valid()) {
        return false;
    }
    jQuery('.ct-loading-main').show();
    jQuery.ajax({
        type: 'post',
        data: {
            'editid': editid,
            'qty': qty,
            'rules': rules,
            'price': price,
            'operation_updateqtyprice_unit': 1
        },
        url: ajax_url + "service_method_units_ajax.php",
        success: function (res) {
            jQuery('.mainheader_message').show();
            jQuery('.mainheader_message_inner').css('display', 'inline');
            jQuery('#ct_sucess_message').text(errorobj_record_updated_successfully);
            jQuery('.mainheader_message').fadeOut(3000);
            jQuery('.ct-loading-main').hide();
        }
    });
});







/* ADDONS SERVICE PAGE */

jQuery(document).ready(function () {
    jQuery('.mymessage_assign_design_addon').hide();
    jQuery('.mymessage_assign_design_service').hide();
});


jQuery(function() {
    jQuery( "#sortable-addons-services" ).sortable({ handle: '.fa-th-list' });
   
});
/* CHANGE THE SORTIN POSITION OF THE ADDONS */
/* SORTABLE FUNRTION FOR SERCVICES */
jQuery(document).ready(function () {
    jQuery("#sortable-addons-services").sortable({
        update: function () {
            var i = 1;
            var pos = [];
            var ids = [];
            jQuery('.mysortlistaddons').each(function () {
                pos.push(i++);
                ids.push(jQuery(this).data('id'));
            });
            jQuery('.ct-loading-main').show();
            jQuery.ajax({
                type: 'post',
                data: {
                    'pos': pos,
                    'ids': ids
                },
                url: ajax_url + "service_addons_ajax.php",
                success: function (res) {
                    jQuery('.ct-loading-main').hide();
                }
            });
        }
    });
});


/* change design of service on radio select assign design to services */
jQuery(document).on('click', '.design_radio_btn_addons', function () {
    mydesignid = jQuery(this).val();
    mydivname = "ct_addons_default_design";
    jQuery.ajax({
        type: 'post',
        data: {
            'designid': mydesignid,
            'divname': mydivname,
            'assigndesign': 1
        },
        url: ajax_url + "setting_ajax.php",
        success: function (res) {
            jQuery('.mainheader_message_addon_design').show();
            jQuery('.mainheader_message_inneraddon_design').css('display', 'inline');
            jQuery('#ct_sucess_message_addon_design').text(errorobj_design_set_successfully);
            jQuery('.mainheader_message_addon_design').fadeOut(3000);
        }
    });
});

/* SET TITLE */
jQuery(document).on('click', '.mybtnforassignaddons', function () {
    var id = jQuery(this).data('id');
    var title = jQuery(this).data('name');
    localStorage['serviceid'] = id;
    localStorage['title'] = title;
    window.location = "service-extra-addons.php";
});

/* SET TITLE FOR UNIT PAGE */
jQuery(document).ready(function () {
    jQuery('.mybtnfrontdesignaddons').hide();
    var str = window.location.pathname;
    var last = str.substring(str.lastIndexOf("/") + 1, str.length);
    if (last == "service-extra-addons.php") {
        jQuery('.myextraservice_addon').html("" + localStorage['title']);
        jQuery('.myextraservice_addontitle').html(errorobj_manage_addons_service);
        jQuery.ajax({
            type: 'post',
            data: {
                'service_id': localStorage['serviceid'],
                'getservice_addons': 1
            },
            url: ajax_url + "service_addons_ajax.php",
            success: function (res) {
                var lastchar = res.substr(res.length - 1);
                if(lastchar == 0){
                    jQuery('.mybtnfrontdesignaddons').hide();
                }
                else{
                    jQuery('.mybtnfrontdesignaddons').show();
                }
                str = res.slice(0, -1);
                jQuery('.myservice_addon_loader').append(str);
            }
        });
    }
});

/* UPDATE UNIT FOR MULTIPLE QTY  */
jQuery(document).on('change', '.txtaddon_multiple', function () {
    if (jQuery(this).prop("checked") == true) {
        multipleqty_for_addon = 'Y';
    }
    else {
        multipleqty_for_addon = 'N';
    }
});


/* Upload Addon Service Image */
/* UPLOAD ADDON SERVICE IMAGE */
jQuery(document).on("click", ".ct_upload_img2", function (e) {
    jQuery('.ct-loading-main').show();
    var imageuss = jQuery(this).data('us');
    var imageids = jQuery(this).data('imageinputid');
    var file_data = jQuery("#" + jQuery(this).data('imageinputid')).prop("files")[0];
    var formdata = new FormData();
    var img_site_url = servObj.site_url;
    var imgObj_url = imgObj.img_url;
    var ctus = jQuery(this).data('us');
    var img_w = jQuery('#' + ctus + 'w').val();
    var img_h = jQuery('#' + ctus + 'h').val();
    var img_x1 = jQuery('#' + ctus + 'x1').val();
    var img_x2 = jQuery('#' + ctus + 'x2').val();
    var img_y1 = jQuery('#' + ctus + 'y1').val();
    var img_y2 = jQuery('#' + ctus + 'y2').val();
    var img_name = jQuery('#' + ctus + 'newname').val();
    var img_id = jQuery('#' + ctus + 'id').val();
    formdata.append("image", file_data);
    formdata.append("w", img_w);
    formdata.append("h", img_h);
    formdata.append("x1", img_x1);
    formdata.append("x2", img_x2);
    formdata.append("y1", img_y1);
    formdata.append("y2", img_y2);
    formdata.append("newname", img_name);
    formdata.append("img_id", img_id);
    jQuery.ajax({
        url: ajax_url + "upload.php",
        type: "POST",
        data: formdata,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            jQuery('.ct-loading-main').hide();
            if (data == "") {
                jQuery('.error-service').addClass('show');
                jQuery('.hidemodal').trigger('click');
            } else {
                jQuery('#' + ctus + 'ctimagename').val(data);
                jQuery('.hidemodal').trigger('click');

                jQuery('#' + ctus + 'addonimage').attr('src', imgObj_url + "services/" + data + "?" + Math.random());
                jQuery('.error_image').hide();
                jQuery('#' + ctus + 'addonimage').attr('data-imagename', data);
            }
            jQuery('#'+imageids).val('');
        }
    });
});

/* INSERT NEW */
jQuery(document).on('click', '.btnaddon_save', function () {
    var addon_service_name = jQuery('.txtaddon_title').val();
    var base_price = jQuery('.txtaddon_baseprice').val();
    var maxqty = jQuery('.txtaddon_maxqty').val();
    var multi = multipleqty_for_addon;

    var image = jQuery('#pcaoctimagename').val();
    var predefineimage = jQuery("#cta_selected_addon").attr('data-name');
	
	var predefine_image_title = jQuery("#cta_selected_addon").attr('data-p_i_name');
    jQuery('#mynewformfor_insertaddons').validate();
    jQuery.validator.addMethod("pattern_title", function(value, element) {
        return this.optional(element) || /^[a-zA-Z '.'_@./#&+-]+$/.test(value);
    }, errorobj_enter_only_alphabets);
    jQuery("#mynewtitlefor_addons").rules("add",
        {
            required: true,
            messages: {required: errorobj_please_enter_title}
        });
    jQuery("#mynewbasepricefor_addons").rules("add",
        {
            required: true, pattern_price: true,
            messages: {required: errorobj_please_assign_price, pattern_price: errorobj_please_enter_valid_price}
        });
    jQuery("#mynewbasemaxqtyfor_addons").rules("add",
        {
            required: true, pattern_onlynumber: true,
            messages: {required: errorobj_please_assign_qty, pattern_price: errorobj_please_enter_valid_price}
        });

    if (!jQuery('#mynewformfor_insertaddons').valid()) {
        return false;
    }
	jQuery('.ct-loading-main').show();
    if(predefineimage == "none"){
        predefineimage = "";
    }
    if(typeof predefineimage === "undefined"){
        predefineimage = "";
    }
	 jQuery.ajax({
        type: 'post',
        data: {
            'service_id': localStorage['serviceid'],
            'addon_service_name': addon_service_name,
            'base_price': base_price,
            'maxqty': maxqty,
            'image': image,
            'predefineimage': predefineimage,
			'predefineimage_title' : predefine_image_title,
            'multipleqty': multi,
            'status': 'D',
            'operationinsert': 1
        },
        url: ajax_url + "service_addons_ajax.php",
        success: function (res) {
            if(jQuery.trim(res) == 1){
                jQuery('.ct-loading-main').hide();
                jQuery('.mainheader_message_fail').show();
                jQuery('.mainheader_message_inner_fail').css('display', 'inline');
                jQuery('#ct_sucess_message_fail').text(errorobj_sorry_unit_already_exist);
                jQuery('.mainheader_message_fail').fadeOut(3000);
            }
            else{
                jQuery('.mainheader_message').show();
                jQuery('.mainheader_message_inner').css('display', 'inline');
                jQuery('#ct_sucess_message').text(errorobj_unit_inserted_successfully);
                jQuery('.mainheader_message').fadeOut(3000);
                jQuery('.ct-loading-main').hide();
                location.reload();
            }
        }
    });
});

/* UPDATE STATUS */
jQuery(document).on('change', '.myservices_addons_status', function () {
    if (jQuery(this).prop("checked") == true) {
        var id = jQuery(this).data('id');
        jQuery('.ct-loading-main').show();
        jQuery.ajax({
            type: 'post',
            data: {
                id: id,
                changestatus: "E"
            },
            url: ajax_url + "service_addons_ajax.php",
            success: function (res) {
                jQuery('.ct-loading-main').hide();
                jQuery('.mainheader_message').show();
                jQuery('.mainheader_message_inner').css('display', 'inline');
                jQuery('#ct_sucess_message').text(errorobj_status_updated);
                jQuery('.mainheader_message').fadeOut(3000);
            }
        });
	}
    else {
        var id = jQuery(this).data('id');
        jQuery('.ct-loading-main').show();
        jQuery.ajax({
            type: 'post',
            data: {
                id: id,
                changestatus: "D"
            },
            url: ajax_url + "service_addons_ajax.php",
            success: function (res) {
                jQuery('.ct-loading-main').hide();
                jQuery('.mainheader_message').show();
                jQuery('.mainheader_message_inner').css('display', 'inline');
                jQuery('#ct_sucess_message').text(errorobj_status_updated);
                jQuery('.mainheader_message').fadeOut(3000);
            }
        });
	}
});

/* DELETE DATA */
jQuery(document).on('click', '.service-addons-delete-button', function () {
    jQuery('.ct-loading-main').show();
	var id = jQuery(this).data('serviceaddonid');
    jQuery.ajax({
        type: 'post',
        data: {
            'deleteid': jQuery(this).data('serviceaddonid'),
            'imagename': jQuery(this).data('imagename')
        },
        url: ajax_url + "service_addons_ajax.php",
        success: function (res) {
		jQuery('.ct-loading-main').hide();
            jQuery('.mainheader_message').show();
            jQuery('.mainheader_message_inner').css('display', 'inline');
            jQuery('#ct_sucess_message').text(errorobj_record_deleted_successfully);
            jQuery('.mainheader_message').fadeOut(3000);
            jQuery('#addons_service_'+id).fadeOut(1000);
        }
    });
});

/* UPDATE DATA */
jQuery(document).on('click', '.btneditaddon_service', function () {
	var edtid = jQuery(this).data('id');
    var image = jQuery('#pcaol' + edtid + 'ctimagename').val();
    var predefineimage = jQuery("#addonid_"+edtid).attr('data-name');
	var predefine_image_title = jQuery("#addonid_"+edtid).attr('data-p_i_name');
    jQuery('#myformedt_addons_' + edtid).validate();
    jQuery.validator.addMethod("pattern_title", function(value, element) {
        return this.optional(element) || /^[a-zA-Z '.'_@./#&+-]+$/.test(value);
    }, "Enter Only Alphabets");
	jQuery("#myedtaddon_title" + edtid).rules("add",
        {
            required: true,
            messages: {required: errorobj_please_enter_title}
        });
    jQuery("#myedtaddon_baseprice" + edtid).rules("add",
        {
            required: true, pattern_price: true,
            messages: {required: errorobj_please_assign_price, pattern_price: errorobj_please_enter_valid_price}
        });
    jQuery("#myedtaddon_maxqty" + edtid).rules("add",
        {
            required: true, pattern_onlynumber: true,
            messages: {required: errorobj_please_assign_qty, pattern_price: errorobj_please_enter_valid_price}
        });
	if (!jQuery('#myformedt_addons_' + edtid).valid()) {
		return false;
    }
	
    var title = jQuery('.txtedtaddon_title' + edtid).val();
    jQuery('.ct-loading-main').show();
	
    if(typeof predefineimage === "undefined"){
        predefineimage = "";
    }

    jQuery.ajax({
        type: 'post',
        data: {
            'id': jQuery(this).data('id'),
            'addon_service_name': jQuery('.txtedtaddon_title' + edtid).val(),
            'base_price': jQuery('.txtedtaddon_baseprice' + edtid).val(),
            'maxqty': jQuery('.txtedtaddon_maxqty' + edtid).val(),
            'image': image,
            'predefineimage': predefineimage,
			'predefineimage_title' : predefine_image_title,
            'operationedit': 1
        },
        url: ajax_url + "service_addons_ajax.php",
        success: function (res) {
            jQuery('.mainheader_message').show();
            jQuery('.mainheader_message_inner').css('display', 'inline');
            jQuery('#ct_sucess_message').text(errorobj_record_updated_successfully);
            jQuery('.ct-loading-main').hide();
            jQuery('.mainheader_message').fadeOut(3000);
            jQuery('#addons_service_name'+edtid).text(title);
            jQuery('#details_sp'+edtid).fadeOut();
            jQuery('#sp'+edtid).prop("checked",false);
            if(image==null || image==''){

            }else{
                jQuery('.cam_btn_addon'+edtid).removeClass('show');
                jQuery('.ser_addons'+edtid).hide();
                jQuery('.del_btn_addon'+edtid).addClass('show');
                jQuery('.addons_del_icon'+edtid).removeClass('show');
                jQuery('.addons_del_icon'+edtid).hide();
                jQuery('.error_image').hide();
            }

        }
    });
});

/* UPDATE MULTIPLE SELCCETION OPTION */
jQuery(document).on('change', '.txtedtaddon_multipleqty', function (event) {
    if (jQuery(this).prop("checked") == true) {
        multipleqty_for_addon_edit = 'Y';
        jQuery('.ct-loading-main').show();
        jQuery.ajax({
            type: 'post',
            data: {
                'id': jQuery(this).data('id'),
                'multipleqty': multipleqty_for_addon_edit,
                'operationedit_multipleqty': 1
            },
            url: ajax_url + "service_addons_ajax.php",
            success: function (res) {
                jQuery('.ct-loading-main').hide();
            }
        });
		event.preventDefault();
    }
    else {
        multipleqty_for_addon_edit = 'N';
        jQuery('.ct-loading-main').show();
        jQuery.ajax({
            type: 'post',
            data: {
                'id': jQuery(this).data('id'),
                'multipleqty': multipleqty_for_addon_edit,
                'operationedit_multipleqty': 1
            },
            url: ajax_url + "service_addons_ajax.php",
            success: function (res) {
                jQuery('.ct-loading-main').hide();
            }
        });
		event.preventDefault();
    }
});

/* CODE FOR QTY RULES FOR ADDONS SERVICES */
/* LOAD ALL RULES OF QTY */
jQuery(document).on('click', '.addon-quantity-rules-btn', function () {
    var quantityno = jQuery(this).data('id');
    jQuery('.ct-loading-main').show();
    jQuery.ajax({
        type: 'post',
        data: {
            'addon_service_id': quantityno,
            'operation_getallqtyprice': 1
        },
        url: ajax_url + "service_addons_ajax.php",
        success: function (res) {
            jQuery('.myaddonspricebyqty' + quantityno).html(res);
        }
    });
    jQuery('.manage-addon-price-container' + quantityno).fadeIn();
    jQuery('.ct-loading-main').hide();
});

/* DELETE THE RULE  */
jQuery(document).on('click', '.mynewrow_btndelete_addon', function () {
    jQuery(this).closest("li").remove();
});

/* DELETE THE RULE  */
jQuery(document).on('click', '.myloadedbtndelete_addons', function () {
    var delid = jQuery(this).data('id');

    jQuery('.ct-loading-main').show();
    jQuery.ajax({
        type: 'post',
        data: {
            'id': delid,
            'operationdelete_addonprice': 1
        },
        url: ajax_url + "service_addons_ajax.php",
        success: function (res) {
            jQuery(".myaddon-qty_price_row" + delid).remove();
            jQuery('.ct-loading-main').hide();
            jQuery('.mainheader_message').show();
            jQuery('.mainheader_message_inner').css('display', 'inline');
            jQuery('#ct_sucess_message').text(errorobj_qty_rule_deleted);
            jQuery('.mainheader_message').fadeOut(3000);
        }
    });
});

/* SAVE QTY RULE BUTTON */
jQuery(document).on('click', '.myloadedbtnsave_addons', function () {
    var editid = jQuery(this).data('id');
    var qty = jQuery('.myloadedqty_addons' + editid).val();
    var rules = jQuery('.myloadedrules_addons' + editid).val();
    var price = jQuery('.myloadedprice_addons' + editid).val();

    /* service edit form validation */
    jQuery('#myedtform_addonunits' + editid).validate();
    jQuery("#myedtqty_addon" + editid).rules("add",
        {
            required: true, pattern_onlynumber: true,
            messages: {required: errorobj_please_enter_some_qty}
        });
    jQuery("#myedtprice_addon" + editid).rules("add",
        {
            required: true, pattern_price: true,
            messages: {required: errorobj_please_assign_price, pattern_price: errorobj_please_enter_valid_price}
        });


    if (!jQuery('#myedtform_addonunits' + editid).valid()) {
        return false;
    }

    jQuery('.ct-loading-main').show();
    jQuery.ajax({
        type: 'post',
        data: {
            'editid': editid,
            'qty': qty,
            'rules': rules,
            'price': price,
            'operation_updateqtyprice_addon': 1
        },
        url: ajax_url + "service_addons_ajax.php",
        success: function (res) {
            jQuery('.mainheader_message').show();
            jQuery('.ct-loading-main').hide();
            jQuery('.mainheader_message_inner').css('display', 'inline');
            jQuery('#ct_success_message').text(errorobj_record_updated_successfully);
            jQuery('.mainheader_message').fadeOut(3000);
        }
    });
});

/* ADD NEW QTY RULE */
jQuery(document).on('click', '.mybtnaddnewqty_addon', function () {
    var id = jQuery(this).data('id');
    var qty = jQuery('.mynewqty_addons' + id).val();
    var rules = jQuery('.mynewrules_addons' + id).val();
    var price = jQuery('.mynewprice_addons' + id).val();

    /* service edit form validation */
    jQuery('#mynewaddedform_addonunits'+id).validate();
    jQuery('#mynewaddedqty_addon'+id).rules("add",
        {
            required: true, pattern_onlynumber: true,
            messages: {required: errorobj_please_enter_some_qty}
        });
    jQuery("#mynewaddedprice_addon"+id).rules("add",
        {
            required: true, pattern_price: true,
            messages: {required: errorobj_please_assign_price, pattern_price: errorobj_please_enter_valid_price}
        });
    if (!jQuery('#mynewaddedform_addonunits'+id).valid()) {
        return false;
    }
    jQuery('.ct-loading-main').show();
    jQuery.ajax({
        type: 'post',
        data: {
            'addon_id': id,
            'qty': qty,
            'rules': rules,
            'price': price,
            'operation_insertqtyprice_addon': 1
        },
        url: ajax_url + "service_addons_ajax.php",
        success: function (ress) {
            jQuery.ajax({
                type: 'post',
                data: {
                    'addon_service_id': id,
                    'operation_getallqtyprice': 1
                },
                url: ajax_url + "service_addons_ajax.php",
                success: function (res) {
                    jQuery('.myaddonspricebyqty' + id).html(res);
                }
            });
            jQuery('.manage-addon-price-container' + id).fadeIn();
            jQuery('.ct-loading-main').hide();

        }
    });
});



/* TIME SLOTS AVAILABILITY TAB */
/* MONTHLY WEEKLY TIME AVAILABILITY */
jQuery(document).on('change', '.weekly_monthly_slots', function () {
    jQuery('.ct-loading-main').show();
	var staff_id = jQuery('.login_user_id').data('id');
    if (jQuery(this).prop("checked") == true) {
        jQuery.ajax({
            type: 'post',
            data: {
                'values': 'monthly',
				'staff_id': staff_id,
                'change_schedule_type': 1
            },
            url: ajax_url + "weekday_ajax.php",
            success: function (res) {
                jQuery('.mainheader_message').show();
                jQuery('.mainheader_message_inner').css('display', 'inline');
                jQuery('#ct_sucess_message').text(errorobj_schedule_updated_to_monthly);
                jQuery('.mainheader_message').fadeOut(3000);
                location.reload();
                jQuery('.ct-loading-main').hide();
            }
        });
    }
    else {
        jQuery.ajax({
            type: 'post',
            data: {
                'values': 'weekly',
				'staff_id': staff_id,
                'change_schedule_type': 1
            },
            url: ajax_url + "weekday_ajax.php",
            success: function (res) {
                jQuery('.mainheader_message').show();
                jQuery('.mainheader_message_inner').css('display', 'inline');
                jQuery('#ct_sucess_message').html(errorobj_schedule_updated_to_weekly);
                jQuery('.mainheader_message').fadeOut(3000, location.reload());
                jQuery('.ct-loading-main').hide();
            }
        });
    }
});

/* UPDATE ALL ENTRY OF THE MONTHLY SCHEDULE */
jQuery(document).on('click', '.btnupdatenewtimeslots_monthly', function () {
	
	
		var values = jQuery('.prove_schedule_type').text();
		if(values==""){
			values="weekly";
		}
		
	jQuery('.ct-loading-main').show();
var staff_id = jQuery('.login_user_id').data('id');
	
    var starttimenew = [];
    var endtimenew = [];
    var chkdaynew = [];

    jQuery('.chkdaynew').each(function () {
        if (jQuery(this).prop("checked") == true) {
            chkdaynew.push('N');
        } else {
            chkdaynew.push('Y');
        }
    });
    jQuery('.starttimenew').each(function () {
        starttimenew.push(jQuery(this).val());
    });
    jQuery('.endtimenew').each(function () {
        endtimenew.push(jQuery(this).val());
    });

    var st = starttimenew.filter(function (v) {
        return v !== ''
    });
    var et = endtimenew.filter(function (v) {
        return v !== ''
    });
    var s = 1;
    for(var i = 0;i<=starttimenew.length;i++){
        if(starttimenew[i] > endtimenew[i]){
            s++;
        }
    }
    if(s>1){
        jQuery('.mainheader_message_fail').show();
        jQuery('.mainheader_message_inner_fail').css('display','inline');
		jQuery('#ct_sucess_message_fail').html(errorobj_please_select_porper_time_slots);
        jQuery('.mainheader_message_fail').fadeOut(5000);
		jQuery('.ct-loading-main').hide();
    }
    else{
        jQuery.ajax({
            type: 'post',
            data: {
                'chkday': chkdaynew,
                'starttime': st,
                'endtime': et,
                'staff_id': staff_id,
                'values': values,
                'operation_insertmonthlyslots': 1
            },
            url: ajax_url + "weekday_ajax.php",
            success: function (res) {
				jQuery('.ct-loading-main').hide();
                jQuery('.mainheader_message').show();
                jQuery('.mainheader_message_inner').css('display', 'inline');
                jQuery('#ct_sucess_message').text(errorobj_time_slots_updated_successfully);
                jQuery('.mainheader_message').fadeOut(3000);
                location.reload();
            }
        });
    }
});




/* TIME SLOTS OFF TIMES TAB */

/* ADD OF TIME */
jQuery(document).on('click', '#add_break', function () {

    jQuery('.ct-loading-main').show();
	 var staff_id = jQuery('.login_user_id').data('id');
    /* startDate.format('YYYY-MM-DD h:mm')==can be used to formate date in js */
    var startdate = jQuery('#offtime-daterange').data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm');
    var enddate = jQuery('#offtime-daterange').data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm');
    var dataString = {
        startdate: startdate,
        enddate: enddate,
        staff_id: staff_id,
        add_offtime: 1
    };
    jQuery.ajax({
        type: 'post',
        url: ajax_url + 'weekday_ajax.php',
        data: dataString,
        success: function (res) {
            jQuery.ajax({
                type: 'post',
                data: {
					staff_id: staff_id,
                    getmy_offtimes: 1
                },
                url: ajax_url + "weekday_ajax.php",
                success: function (res) {
                    jQuery('.mytbodyfor_offtimes').html(res);
                    jQuery('.mainheader_message').show();
                    jQuery('.mainheader_message_inner').css('display', 'inline');
                    jQuery('#ct_sucess_message').text(errorobj_off_time_added_successfully);
                    jQuery('.mainheader_message').fadeOut(3000);
                    jQuery('.ct-loading-main').hide();

                }
            });
        }
    });

});

/* DELETE OFFTIME */
jQuery(document).on('click', '.ct_delete_provider', function () {
    jQuery('.ct-loading-main').show();
    var id = jQuery(this).data('id');

    var dataString = {
        id: id,
        delete_offtime: 1
    };
    jQuery.ajax({
        type: 'post',
        url: ajax_url + 'weekday_ajax.php',
        data: dataString,
        success: function (response) {
            jQuery('#myofftime_' + id).remove();
            jQuery('.mainheader_message').show();
            jQuery('.mainheader_message_inner').css('display', 'inline');
            jQuery('#ct_sucess_message').text(response);
            jQuery('.mainheader_message').fadeOut(3000);
            jQuery('.ct-loading-main').hide();
        }
    });
});


/* TIME SLOTS AND BREAK TAB */
/*  ADD BREAKS IN STAFFS   */
jQuery(document).on('click', '.myct-add-staff-breaks', function () {
    jQuery('.ct-loading-main').show();
    var id = jQuery(this).data('id');
    var staff_id = jQuery(this).data('staff_id');
    var weekid = jQuery(this).data('weekid');
    var weekday = jQuery(this).data('weekday');
    /* insert the record in the table and then after fill in new li */
    jQuery.ajax({
        type: 'post',
        data: {
            weekid: weekid,
            weekday: weekday,
            staff_id: staff_id,
            starttime: '10:00:00',
            endtime: '20:00:00',
            newaddbreak: 1
        },
        url: ajax_url + "weekday_ajax.php",
        success: function (res) {
            jQuery("#ct-add-break-ul" + id).append(res);
            jQuery('.ct-loading-main').hide();
        }
    });
});

jQuery(document).on('change','.selectpickerstart',function(){
    var id = jQuery(this).data('id');
    var weekid = jQuery(this).data('weekid');
    var weekday = jQuery(this).data('weekday');
    var starttime = jQuery(this).val();

    /* update the time in start time */
    jQuery.ajax({
        type : 'post',
        data : {
            id : id,
            weekid : weekid,
            weekday : weekday,
            start_new_time : starttime,
            editstarttime_break : 1
        },
        url : ajax_url+"weekday_ajax.php",
        success  :function(res)
        {		
		if(jQuery.trim(res)=='done'){
            jQuery('.mainheader_message').show();
            jQuery('.mainheader_message_inner').css('display','block');
            jQuery('#ct_sucess_message').html(errorobj_start_break_time_updated);
            jQuery('.mainheader_message').fadeOut(5000);
        }else{
            jQuery('.mainheader_message_fail').show();
            jQuery('.mainheader_message_inner_fail').css('display','block');
            jQuery('#ct_sucess_message_fail').html(errorobj_please_select_time_between_day_availability_time);
            jQuery('.mainheader_message_fail').fadeOut(5000);

        }
        }
    });
});


/* UPDATE THE SELECTED TIME IN THE TABLE OF THE END BREAK TIME */
jQuery(document).on('change','.selectpickerend',function(){
    var id = jQuery(this).data('id');
    var weekid = jQuery(this).data('weekid');
    var weekday = jQuery(this).data('weekday');
    var endtime = jQuery(this).val();

    var brstarttime=jQuery('#start_break_'+id+"_"+weekid+"_"+weekday).val();
    if(endtime < brstarttime){
        jQuery('.mainheader_message_fail').show();
        jQuery('.mainheader_message_inner_fail').css('display','inline');
        jQuery('#ct_sucess_message_fail').html(errorobj_break_end_time_should_be_greater_than_start_time);
        jQuery('.mainheader_message_fail').fadeOut(5000);
    }else{
        /* update the time in end time */
        jQuery.ajax({
            type : 'post',
            data : {
                id : id,
                weekid : weekid,
                weekday : weekday,
                end_new_time : endtime,
                editendtime_break : 1
            },
            url : ajax_url+"weekday_ajax.php",
            success  :function(res)
            {
                if(jQuery.trim(res)=='End Break Time Updated'){
                    jQuery('.mainheader_message').show();
                    jQuery('.mainheader_message_inner').css('display','inline');
                    jQuery('#ct_sucess_message').html(errorobj_end_break_time_updated);
                    jQuery('.mainheader_message').fadeOut(5000);
                }else{
                    jQuery('.mainheader_message_fail').show();
                    jQuery('.mainheader_message_inner_fail').css('display','inline');
                    jQuery('#ct_sucess_message_fail').html(errorobj_please_select_time_between_day_availability_time);
                    jQuery('.mainheader_message_fail').fadeOut(5000);

                }
            }
        });
    }
});

jQuery(document).bind('ready ajaxComplete',function() {
    jQuery('.delete_break').popover({
        html : true,
        content: function() {
            var breakpopup_id=jQuery(this).data('wiwdibi');
            return jQuery('#popover-delete-breaks'+breakpopup_id).html();
        }
    });
});

/* DELETE BREAKS */
jQuery(document).on('click','.mybtndelete_breaks',function(){
	jQuery('.ct-loading-main').show();
    var id = jQuery(this).data('break_id');
    jQuery.ajax({
        type : 'post',
        data : {
            id : id,
            delete_off_breaks : 1
        },
        url : ajax_url+"weekday_ajax.php",
        success : function(res){
			jQuery('.ct-loading-main').hide();
        }
    });
    jQuery(this).closest("li").remove();
});





/* COINFIRM NOTIFICATION AND MAKE IT UPADTE ITS STATUS TO READED */
jQuery(document).on('click', '.notificationli', function () {
    var orderid = jQuery(this).data('orderid');
    jQuery.ajax({
        type: 'post',
        data: {orderid: orderid, getcleintdetailwith_updatereadstatus: 1},
        url: ajax_url + "my_appoint_ajax.php",
        success: function (res) {
            jQuery('.booking-details-index-dashboard').html(res);
            jQuery('#ct-notification-container').hide();
        }
    });
});


/* FULL CALENDAR */
/* FULL CALENDAR CONFIRM */
/* CONFIRM FOR NOTIFICATION */
jQuery(document).on('click', '.ct-confirm-appointment', function (e) {
	if(check_update_if_btn == '0'){
		check_update_if_btn = '1';
		e.preventDefault();
    var data_id = jQuery(this).attr('data-id');
    jQuery.ajax({
        type: "POST",
        data: {
            id: data_id,
            confirm_booking: 1
        },
        url: ajax_url + "my_appoint_ajax.php",
        success: function (response) {
			check_update_if_btn = '0';
            jQuery('.mainheader_message').show();
            jQuery('.mainheader_message_inner').css('display', 'inline');
            jQuery('#ct_sucess_message').text(errorobj_appointment_booking_confirm);
            jQuery('.mainheader_message').fadeOut(3000);
            jQuery('#info_modal_close').trigger('click');
            jQuery('#updateinfo_modal_close').trigger('click');
            jQuery('.closesss').trigger('click');
            location.reload();
        }
    });
	}
});

/* Confirm in calendar */
jQuery(document).on('click', '.ct-confirm-appointment-cal', function (e) {
	if(check_update_if_btn == '0'){
		check_update_if_btn = '1';
		e.preventDefault();
    var data_id = jQuery(this).attr('data-id');
    jQuery.ajax({
        type: "POST",
        data: {
            id: data_id,
            confirm_booking_cal: 1
        },
        url: ajax_url + "my_appoint_ajax.php",
        success: function (response) {
			check_update_if_btn = '0';
            jQuery('.mainheader_message').show();
            jQuery('.mainheader_message_inner').css('display', 'inline');
            jQuery('#ct_sucess_message').text(errorobj_appointment_booking_confirm);
            jQuery('.mainheader_message').fadeOut(3000);
            jQuery('#info_modal_close').trigger('click');
            jQuery('#updateinfo_modal_close').trigger('click');
            jQuery('.closesss').trigger('click');
            location.reload();
        }
    });
	}
});


/* reject appointment of the client */
/* Reject Booking in Dashboard */
jQuery(document).ajaxComplete(function () {
    jQuery('.book_rejectss').popover({
        html: true,
        content: function () {
            var booking_id = jQuery(this).data('id');
            return jQuery('#popover-reject-appointment-cal-popupss' + booking_id).html();
        }
    });
});
/*
jQuery(document).on('click', '.reject_bookings', function () {
    jQuery('.ct-loading-main').hide();
	alert("1");
    var booking_id = jQuery(this).data('id');
    var reject_reason_book = jQuery('#reason_reject' + booking_id).val();

    var dataString = {
        booking_id: booking_id,
        reject_reason_book: reject_reason_book,
        action: 'reject_booking'
    };
    jQuery.ajax({
        type: "POST",
        url: ajax_url + "booking_ajax.php",
        data: dataString,
        success: function (response) {
            if (response == 'booking Rejected') {
                jQuery('.mainheader_message').show();
                jQuery('.mainheader_message_inner').css('display', 'inline');
                jQuery('#ct_sucess_message').text(errorobj_appointment_booking_rejected);
                jQuery('.mainheader_message').fadeOut(3000);
                jQuery('#info_modal_close').trigger('click');
                jQuery('#updateinfo_modal_close').trigger('click');
                jQuery('.ct-loading-main').hide();
				location.reload();
            }
        }
    });
});*/
/* REJECT BOOKINGS */
jQuery(document).on('click', '.reject_bookings', function (e) {
	if(check_update_if_btn == '0'){
		check_update_if_btn = '1';
		e.preventDefault();
    var booking_id = jQuery(this).data('id');
	var reject_reason_book = jQuery('#reason_reject' + booking_id).val();
	var pid = jQuery(this).data('pid');
	var gc_event_id = jQuery(this).data('gc_event');
	var gc_staff_event_id = jQuery(this).data('gc_staff_event');
    var dataString = {
        order_id: booking_id,
		pid: pid,
		gc_event_id: gc_event_id,
		gc_staff_event_id: gc_staff_event_id,
        reject_reason_book: reject_reason_book,
        reject_booking: 1
    };
    jQuery.ajax({
        type: "POST",
        url: ajax_url + "my_appoint_ajax.php",
        data: dataString,
        success: function (response) {
            jQuery('.mainheader_message').show();
            jQuery('.mainheader_message_inner').css('display', 'inline');
            jQuery('#ct_sucess_message').text(errorobj_appointment_booking_rejected);
            jQuery('.mainheader_message').fadeOut(3000);
            jQuery('#info_modal_close').trigger('click');
            jQuery('#updateinfo_modal_close').trigger('click');
            jQuery('.closesss').trigger('click');
            location.reload();
        }
    });
	}
});

/* DELETE BOOKINGS */
jQuery(document).ajaxComplete(function () {
    jQuery('.booking_deletess').popover({
        html: true,
        content: function () {
            var booking_id = jQuery(this).data('id');
            return jQuery('#popover-delete-appointment-cal-popupss' + booking_id).html();
        }
    });
});

jQuery(document).on('click', '.mybtndelete_booking', function () {
    var order = jQuery(this).data('id');
    jQuery.ajax({
        type: "POST",
        data: {
            id: order,
            delete_booking: 1
        },
        url: ajax_url + "my_appoint_ajax.php",
        success: function (response) {
            jQuery('.mainheader_message').show();
            jQuery('.mainheader_message_inner').css('display', 'inline');
            jQuery('#ct_sucess_message').text(errorobj_booking_deleted);
            jQuery('.mainheader_message').fadeOut(3000);
            jQuery('#info_modal_close').trigger('click');
            jQuery('#updateinfo_modal_close').trigger('click');
            jQuery('.closesss').trigger('click');
            location.reload();
        }
    });
});
jQuery(document).on('click', '.delete_bookings', function () {
    var order = jQuery(this).data('id');
	var gc_event_id = jQuery(this).data('gc_event');
	var gc_staff_event_id = jQuery(this).data('gc_staff_event');
	var pid = jQuery(this).data('pid');
    jQuery.ajax({
        type: "POST",
        data: {
            id: order,
			pid: pid,
			gc_event_id: gc_event_id,
			gc_staff_event_id: gc_staff_event_id,
            delete_booking: 1
        },
        url: ajax_url + "my_appoint_ajax.php",
        success: function (response) {
            jQuery('.mainheader_message').show();
            jQuery('.mainheader_message_inner').css('display', 'inline');
            jQuery('#ct_sucess_message').text(errorobj_booking_deleted);
            jQuery('.mainheader_message').fadeOut(3000);
            jQuery('#info_modal_close').trigger('click');
            jQuery('#updateinfo_modal_close').trigger('click');
            jQuery('.closesss').trigger('click');
            location.reload();
        }
    });
});



/* NOTIFICATION CODE */
/* LOAD ALL NOTIFICATION */
jQuery(document).ready(function () {
    jQuery("#ct-notifications").click(function () {
		jQuery('#ct-notification-container').removeAttr('style');
		jQuery.ajax({
            type: 'post',
            data: {
                getallnotification: 1
            },
            url: ajax_url + "my_appoint_ajax.php",
            success: function (res) {
                if(jQuery.trim(res) != ""){
                    jQuery(".myloadednotification").html(res);
                }
                else{
                    jQuery(".myloadednotification").html("<li>"+errorobj_sorry_no_notification+"</li>");
                }

            }
        });
		jQuery(".ct-notifications-inner").addClass("visible");
	});
    jQuery("#ct-close-notifications").click(function () {
        jQuery(".ct-notifications-inner").removeClass("visible");
	});
						
	jQuery( document ).on( 'keydown', function ( e ) {
		if ( e.keyCode === 27 ) {
			 jQuery(".ct-notifications-inner").removeClass("visible");
		}
	});
});

/* GET TOTAL NUMBER OF BOKINGS THROUGH AJAX */
/*
jQuery(document).ready(function () {
    var str = window.location.pathname;
    var last = str.substring(str.lastIndexOf("/") + 1, str.length);
    if (last == "my-appointments.php" || last == "user-profile.php") {
    }
    else
    {
        setInterval(function () {
            jQuery.ajax({
                type: 'post',
                data: {getnotification_total: 1},
                url: ajax_url + "notification_ajax.php",
                success: function (res) {
                    if(jQuery.trim(res) != 0){
						jQuery('.total_notification').html(res);
						jQuery('.total_notification').show();
                    }
                    else
                    {
                        jQuery('.total_notification').hide("");
                    }
                }
            });
        }, 10000);
    }
});
*/



/*  my function for reuse */
/* DELETE FUNCTION TO DELETE THE RECORD */
function deletedata(id, url) {
    jQuery.ajax({
        type: 'post',
        data: {
            'deleteid': id
        },
        url: url,
        success: function (res) {
            jQuery('.mainheader_message').show();
            jQuery('.mainheader_message_inner').css('display', 'inline');
            jQuery('#ct_sucess_message').text(errorobj_record_deleted_successfully);
            jQuery('.mainheader_message').fadeOut(3000);
        }
    });
}

/* FORM VALIDATION METHODS */
jQuery(document).ready(function () {
    jQuery.validator.addMethod("pattern_price", function (value, element) {
        return this.optional(element) || /^[0-9]\d*(\.\d{1,2})?$/.test(value);
    }, errorobj_please_enter_proper_base_price);

    jQuery.validator.addMethod("pattern_phone", function (value, element) {
        return this.optional(element) || /^\+([0-9]){10,14}[0-9]$/.test(value);
    }, errorobj_please_enter_only_numerics);

    jQuery.validator.addMethod("urlss", function (value, element) {
        return this.optional(element) || /^(http:\/\/|https:\/\/|http:\/\/|https:\/\/)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/.test(value);
    }, errorobj_enter_valid_url);


    jQuery.validator.addMethod("pattern_zip", function (value, element) {
        return this.optional(element) || /^[a-zA-Z 0-9\-\ ]*$/.test(value);
    }, errorobj_enter_alphabets_only);

    jQuery.validator.addMethod("pattern_name", function (value, element) {
        return this.optional(element) || /^[a-zA-Z/' ]+$/.test(value);
    }, errorobj_enter_alphabets_only);

    /* USER PROFILE ADMIN */
    jQuery.validator.addMethod("user_profile_pattern_password", function (value, element) {
      return this.optional(element) || /^[a-zA-Z0-9 '.'_!%^*~`@()./#&+-]+$/.test(value);
    }, errorobj_enter_only_alphabets_numbers);

    /*  END USER PROFILE */

    jQuery.validator.addMethod("pattern_title", function(value, element) {
        return this.optional(element) || /^[a-zA-Z '.'_@./#&+-]+$/.test(value);
    }, errorobj_enter_alphabets_only);


    jQuery.validator.addMethod("pattern_company_country_code", function(value, element) {
        return this.optional(element) || /^\+[0-9]{1,4}$/.test(value);
    }, errorobj_enter_proper_country_code);

    jQuery.validator.addMethod("pattern_method_name", function (value, element) {
        return this.optional(element) || /^[a-zA-Z/' ]+$/.test(value);
    }, errorobj_enter_alphabets_only);

    jQuery.validator.addMethod("pattern_onlynumber", function (value, element) {
        return this.optional(element) || /^[0-9]+$/.test(value);
    }, errorobj_enter_only_digits);

    jQuery.validator.addMethod("pattern_city_state", function (value, element) {
        return this.optional(element) || /^[a-zA-Z ]+$/.test(value);
    }, errorobj_enter_alphabets_only);

    jQuery.validator.addMethod("pattern_cp", function (value, element) {
        return this.optional(element) || /^[0-9]*$/.test(value);
    }, errorobj_please_enter_only_numeric);

    /* service add form validation */
    jQuery('#addservice_form').validate({
        rules: {
            txtcolor: {required: true},
            txtservicetitle: {required: true}
        },
        messages: {
            txtcolor: {required: errorobj_please_enter_color_code},
            txtservicetitle: {required: errorobj_please_enter_service_title}
        }
    });

    jQuery('.ct-email-settings').validate({
        rules: {
            admin_optional_email: {email: true},
            ct_email_sender_address: {email: true}
        },
        messages: {
            admin_optional_email: {required: errorobj_please_enter_email},
            ct_email_sender_address: {required: errorobj_please_enter_email}
        }
    });

});


/* ***************Setting Page******************** */
/*  Use For update Company Details  */
jQuery(document).on('click', '#company_setting', function () {
    var time_zone = jQuery('#time-zone').val();
    var sel_language = jQuery('#display_language_user').val();
    var company_name = jQuery('#company_name').val();
    var company_email = jQuery('#company_email').val();
    var company_address = jQuery('#company_address').val();
    var company_city = jQuery('#company_city').val();
    var company_state = jQuery('#company_state').val();
    var company_zipcode = jQuery('#company_zip').val();
    var company_country = jQuery('#company_country').val();
	var company_country_code = jQuery(".numbercode").text()+","+jQuery(".alphacode").text()+","+jQuery(".selected-flag").attr("title");
	var company_logo = jQuery('#ctsictimagename').val();
    var company_phone = jQuery('.company_country_code_value').text()+""+jQuery('#company_phone').val();
	/*
	var company_header = jQuery('#Show_comapny_address').prop("checked");
			if (company_header == true) {
				var company_header_address = 'Y';
			} else {
				var company_header_address = 'N';
			}
			
	var company_service_desc = jQuery('#show_desc_front').prop("checked");
			if (company_service_desc == true) {
				var company_service_desc_status = 'Y';
			} else {
				var company_service_desc_status = 'N';
			}
	var company_willwe_getin = jQuery('#show_how_willwe_getin_front').prop("checked");
			if (company_willwe_getin == true) {
				var company_willwe_getin_status = 'Y';
			} else {
				var company_willwe_getin_status = 'N';
			}
	

	
	var company_logo_status = jQuery('#show_company_logo').prop("checked");
	if (company_logo_status == true) {
		var company_logo_display = 'Y';
	} else {
		var company_logo_display = 'N';
	}*/
	var dataString = {
        time_zone: time_zone,
		sel_language: sel_language,
        company_name: company_name,
        company_email: company_email,
        company_address: company_address,
        company_city: company_city,
        company_state: company_state,
        company_zipcode: company_zipcode,
        company_country: company_country,
        company_country_code: company_country_code,
        company_logo: company_logo,
        company_phone : company_phone,
		/* company_header_address : company_header_address,
		company_service_desc_status : company_service_desc_status,
		company_willwe_getin_status : company_willwe_getin_status,
		company_logo_display : company_logo_display,*/
        action: "update_company_setting"
    };
	if (jQuery('.error_image').is(':visible')) {
		var dataString = {
        time_zone: time_zone,
		sel_language: sel_language,
        company_name: company_name,
        company_email: company_email,
        company_address: company_address,
        company_city: company_city,
        company_state: company_state,
        company_zipcode: company_zipcode,
        company_country: company_country,
        company_country_code: company_country_code,
        company_phone : company_phone,
		company_header_address : company_header_address,
		company_service_desc_status : company_service_desc_status,
		company_willwe_getin_status : company_willwe_getin_status,
		/* company_logo_display : company_logo_display, */
        action: "update_company_setting"
		};
		jQuery('.ct-loading-main').show();
		if (jQuery('#business_setting_form').valid()) {
			jQuery.ajax({
				type: "POST",
				url: ajax_url + "setting_ajax.php",
				data: dataString,
				success: function (response) {
					jQuery('.ct-loading-main').hide();
					if(jQuery.trim(response)=='updated'){
						jQuery('.mainheader_message').show();
						jQuery('.mainheader_message_inner').css('display','inline');
						jQuery('#ct_sucess_message').text(errorobj_updated_company_details);
						jQuery('.mainheader_message').fadeOut(3000);
						if(company_logo==null || company_logo==''){
							location.reload();
						}else{
							jQuery('.set_newcam_icon').removeClass('show');
							jQuery('.set_newcam_icon').hide();
							jQuery('.del_btn').show();
							jQuery('.del_btn').addClass('show');
							jQuery('.del_set_popup').hide();
							location.reload();
						}
					}
				}
			});
		}else{
			jQuery('.ct-loading-main').hide();
		}
	}
	else{	
		jQuery('.ct-loading-main').show();
		if (jQuery('#business_setting_form').valid()) {
			jQuery.ajax({
				type: "POST",
				url: ajax_url + "setting_ajax.php",
				data: dataString,
				success: function (response) {
					jQuery('.ct-loading-main').hide();
					if(jQuery.trim(response)=='updated'){
						jQuery('.mainheader_message').show();
						jQuery('.mainheader_message_inner').css('display','inline');
						jQuery('#ct_sucess_message').text(errorobj_updated_company_details);
						jQuery('.mainheader_message').fadeOut(3000);
						if(company_logo==null || company_logo==''){
							location.reload();
						}else{
							jQuery('.set_newcam_icon').removeClass('show');
							jQuery('.set_newcam_icon').hide();
							jQuery('.del_btn').show();
							jQuery('.del_btn').addClass('show');
							jQuery('.del_set_popup').hide();
							location.reload();
						}
					}
				}
			});
		}else{
			jQuery('.ct-loading-main').hide();
		}
	}
});
jQuery(document).on('click', '#patial-deposit', function () {
    var partialamount_check = jQuery(this).prop('checked');
    if (partialamount_check == true) {
        if(payment_status == "off"){
            jQuery('#ct-partial-depost_error').show();
        }
    }
    else{
        jQuery('#ct-partial-depost_error').hide();
    }

});
/*  Use For update General Setting  */
jQuery(document).on('click', '#general_setting', function () {
	jQuery('.ct-loading-main').show();
    var time_interval = jQuery('#time_interval').val();
    var min_advanced_booking = jQuery('#ct_min_advance_booking_time').val();

    var max_advanced_booking = jQuery('#ct_max_advance_booking_time').val();

    if(max_advanced_booking == ""){

    }
    var booking_padding_time = '';
    var service_padding_time_before = "";
    var service_padding_time_after = "";
	var cancelled_buffer_time = jQuery('#ct_cancellation_buffer_time').val();
	
    var reshedule_buffer_time = jQuery('#ct_reshedule_buffer_time').val();
    var currency = jQuery('#ct_currency').val();
    var currency_symbol_position = jQuery('#ct_currency_symbol_position').val();
    var price_format_decimal_places = jQuery('#ct_price_format_decimal_places').val();
    var ct_postal_code = jQuery('#ct_postal_code').val();

    var tax_vat = jQuery('#tax-vat').prop("checked");
    if (tax_vat == true) {
        var tax_vat_1 = 'Y';
    } else {
        var tax_vat_1 = 'N';
    }

    var postal_code = jQuery('#postalcode').prop("checked");
    if (postal_code == true) {
        var postal_code_1 = 'Y';
    } else {
        var postal_code_1 = 'N';
    }

    var per_flatfree = jQuery('#tax-vat-percentage').prop('checked');
    if (per_flatfree == true) {
        var percent_flatfree = 'P';
    } else {
        var percent_flatfree = 'F';
    }
    /*  Use for Tax/vat  */
    jQuery(document).ready(function () {
        jQuery('.tax_vat_radio').click(function () {
            if (jQuery(this).val() == "P") {
                jQuery(".ct-tax-percent").addClass('fa fa-percent');
            }
            if (jQuery(this).val() == "F") {
                jQuery(".ct-tax-percent").removeClass('fa fa-percent');
            }

        });
    });


    var tax_vat_value = jQuery('#ct_tax_vat_value').val();

    var partial_deposit = jQuery('#patial-deposit').prop("checked");
    if (partial_deposit == true) {
        if(payment_status == "on"){
            var status_partial = 'Y';
        }
        else{
            var status_partial = 'N';
        }
    } else {
        var status_partial = 'N';
    }

    var partial_per_flatfree = jQuery('#partial-percentage').prop('checked');
    if (partial_per_flatfree == true) {
        var partial_percent_flatfree = 'P';
    } else {
        var partial_percent_flatfree = 'F';
    }

    var partial_deposit_amount = jQuery('#ct_partial_deposit_amount').val();
    var partial_deposit_message = jQuery('#ct_partial_deposit_message').val();
    var thanks_url = encodeURIComponent(jQuery('#ct_thankyou_page_url').val());

    var cancel_policy = jQuery('#cancel-policy').prop("checked");
    if (cancel_policy == true) {
        var cancel_policy_status = 'Y';
    } else {
        var cancel_policy_status = 'N';
    }


    jQuery('#general_setting_form').validate({
        rules: {
            ct_thankyou_page_url: {urlss: true},
            ct_terms_condition_header: {urlss: true},
            ct_privacy_policy_link: {urlss: true},
            ct_postal_code : {required : true}
        },
        messages: {
            ct_thankyou_page_url: {urlss: errorobj_enter_valid_url},
            ct_terms_condition_header: {urlss: errorobj_enter_valid_url},
            ct_privacy_policy_link: {urlss: errorobj_enter_valid_url},
            ct_postal_code: {required: errorobj_you_can_only_use_valid_zipcode}
        }
    });


    var cancel_policy_header = jQuery('#ct_cancel_policy_header').val();
    var cancel_policy_textarea = jQuery('#ct_cancel_policy_textarea').val();

	var calculation_policy = jQuery('#ct_price_calculation_method').val();
    var allow_multiple_booking_for_timeslot = jQuery('#multiple-booking-same-time').prop("checked");
    if (allow_multiple_booking_for_timeslot == true) {
        var allow_multiple_booking_for_same_timeslot = 'Y';
    } else {
        var allow_multiple_booking_for_same_timeslot = 'N';
    }

    var appointment_auto_confirm = jQuery('#appointment-auto-confirm').prop("checked");
    if (appointment_auto_confirm == true) {
        var appointment_auto_confirmation = 'Y';
    } else {
        var appointment_auto_confirmation = 'N';
    }

    var time_overlap_booking = jQuery('#allow-dc-overlap-booking').prop("checked");
    if (time_overlap_booking == true) {
        var allow_time_overlap_booking = 'Y';
    } else {
        var allow_time_overlap_booking = 'N';
    }

    var terms_condition = jQuery('#allow-dc-terms-condition').prop("checked");
    if (terms_condition == true) {
        var allow_terms_and_condition = 'Y';
    } else {
        var allow_terms_and_condition = 'N';
    }

    var privacy_policy = jQuery('#allow-dc-privacy_policy').prop("checked");
    if (privacy_policy == true) {
        var allow_privacy_policy = 'Y';
    } else {
        var allow_privacy_policy = 'N';
    }

    var front_desc = jQuery('#ct_allow_front_desc').prop("checked");
    if (front_desc == true) {
        var ct_allow_front_desc = 'Y';
    } else {
        var ct_allow_front_desc = 'N';
    }
	/*
    var ct_subheaders = jQuery('#ct_subheaders').prop("checked");
    if (ct_subheaders == true) {
        var ct_subheaders = 'Y';
    } else {
        var ct_subheaders = 'N';
    }
	
	var ct_vc_status_ch = jQuery('#ct_vc_status').prop("checked");
    if (ct_vc_status_ch == true) {
        var ct_vc_status = 'Y';
    } else {
        var ct_vc_status = 'N';
    }
	
	var ct_p_status_ch = jQuery('#ct_p_status').prop("checked");
    if (ct_p_status_ch == true) {
        var ct_p_status = 'Y';
    } else {
        var ct_p_status = 'N';
    } */
	var ct_user_zip_code_ch = jQuery('#ct_user_zip_code').prop("checked");
    if (ct_user_zip_code_ch == true) {
        var ct_user_zip_code = 'Y';
    } else {
        var ct_user_zip_code = 'N';
    }
	/* 
		var ct_cart_scrollable = jQuery('#ct_cart_scrollable').prop("checked");
		 if (ct_cart_scrollable == true)
		 {
		 var ct_cart_scrollable = 'Y';
		 }
		 else
		 {
		 var ct_cart_scrollable = 'N';
		 }
	 */

    var ct_cart_scrollable = 'Y';
    var ct_addons_default_design = jQuery('#ct_addons_default_design').val();
    var ct_method_default_design = jQuery('#ct_method_default_design').val();
    var ct_service_default_design = jQuery('#ct_service_default_design').val();
	
	
	var ct_terms_condition_link = encodeURIComponent(jQuery('#ct_terms_condition_header').val());
    var ct_privacy_policy_link = encodeURIComponent(jQuery('#ct_privacy_policy_link').val());
    var ct_front_desc = encodeURIComponent(jQuery('#ct_front_desc').val());
    var dataString = {
        time_interval: time_interval,
        ct_allow_privacy_policy: allow_privacy_policy,
        ct_privacy_policy_link: ct_privacy_policy_link,
        ct_addons_default_design : ct_addons_default_design,
        ct_method_default_design : ct_method_default_design,
        ct_service_default_design : ct_service_default_design,
        ct_cart_scrollable : ct_cart_scrollable,
        ct_terms_condition_link : ct_terms_condition_link,
        min_advanced_booking: min_advanced_booking,
        ct_allow_front_desc : ct_allow_front_desc,
        max_advanced_booking: max_advanced_booking,
        booking_padding_time: booking_padding_time,
        service_padding_time_before: service_padding_time_before,
        service_padding_time_after: service_padding_time_after,
        cancelled_buffer_time: cancelled_buffer_time,
        reshedule_buffer_time: reshedule_buffer_time,
        currency: currency,
        currency_symbol_position: currency_symbol_position,
        price_format_decimal_places: price_format_decimal_places,
        tax_vat_1: tax_vat_1,
        postal_code_1: postal_code_1,
        percent_flatfree: percent_flatfree,
        tax_vat_value: tax_vat_value,
        status_partial: status_partial,
        partial_percent_flatfree:partial_percent_flatfree,
        partial_deposit_amount: partial_deposit_amount,
        partial_deposit_message: partial_deposit_message,
        thanks_url: thanks_url,
        cancel_policy_status:cancel_policy_status,
        cancel_policy_header:cancel_policy_header,
        cancel_policy_textarea:cancel_policy_textarea,
        allow_multiple_booking_for_same_timeslot: allow_multiple_booking_for_same_timeslot,
        appointment_auto_confirmation: appointment_auto_confirmation,
        allow_time_overlap_booking: allow_time_overlap_booking,
        allow_terms_and_condition: allow_terms_and_condition,
        ct_postal_code : ct_postal_code,
        ct_front_desc : ct_front_desc,
		ct_calculation_policy : calculation_policy,
		/* ct_subheaders : ct_subheaders,
		ct_vc_status : ct_vc_status,
		ct_p_status : ct_p_status,*/
		ct_user_zip_code : ct_user_zip_code,
        action: "update_general_setting"
    };
    if (jQuery('#general_setting_form').valid()) {
        jQuery.ajax({
            type: "POST",
            url: ajax_url + "setting_ajax.php",
            data: dataString,
            success: function (response) {
                jQuery('.ct-loading-main').hide();
                if(jQuery.trim(response)=='updated'){
                    jQuery('.mainheader_message').show();
                    jQuery('.mainheader_message_inner').css('display','inline');
                    jQuery('#ct_sucess_message').text(errorobj_updated_general_settings);
                    jQuery('.mainheader_message').fadeOut(3000);
                    location.reload();
                }
            }
        });
    }
    else{
        jQuery('.ct-loading-main').hide();
    }
});


/* BELOW CODE IS TO SAVE SMS SETTINGS */
jQuery(document).on('click', '#btnsave_sms_service', function () {
    var sms_status = jQuery('.mysms_service_status').prop("checked");
    if (sms_status == true) {
        var sms_service_status = 'Y';
    } else {
        var sms_service_status = 'N';
    }
    var send_to_client = jQuery('#ct-sms-reminder-client-status').prop("checked");
    if (send_to_client == true) {
        var send_sms_to_client_status = 'Y';
    } else {
        var send_sms_to_client_status = 'N';
    }
    var send_to_admin = jQuery('#ct-sms-reminder-admin-status').prop("checked");
    if (send_to_admin == true) {
        var send_sms_to_admin_status = 'Y';
    } else {
        var send_sms_to_admin_status = 'N';
    }
    /* PLIVO SETTINGS */
    var send_to_client_plivo = jQuery('#ct-sms-reminder-client-status-plivo').prop("checked");
    if (send_to_client_plivo == true) {
        var send_sms_to_client_plivo_status = 'Y';
    } else {
        var send_sms_to_client_plivo_status = 'N';
    }
    var send_to_admin_plivo = jQuery('#ct-sms-reminder-admin-status-plivo').prop("checked");
    if (send_to_client_plivo == true) {
        var send_sms_to_admin_plivo_status = 'Y';
    } else {
        var send_sms_to_admin_plivo_status = 'N';
    }
    /* PLIVO STATUS */
    var plivo_status = jQuery('#sms-noti-plivo').prop("checked");
    if (plivo_status == true) {
        var sms_plivo_status = 'Y';
    } else {
        var sms_plivo_status = 'N';
    }
    /*  TWILIO STATUS */
    var twilio_status = jQuery('#sms-noti-twilio').prop("checked");
    if (twilio_status == true) {
        var sms_twilio_status = 'Y';
    } else {
        var sms_twilio_status = 'N';
    }


    var sms_plivo_account_sid = jQuery('#myplivo_account_sid').val();
    var sms_plivo_auth_token = jQuery('#myplivo_auth_token').val();
    var sms_plivo_sender_number = jQuery('#myplivo_sender_number').val();
    var sms_plivo_admin_phone_number = jQuery('.company_country_code_value_plivo').text()+""+jQuery('#myadmin_phone_number_plivo').val();

    var sms_twilio_account_sid = jQuery('#mytwilio_account_sid').val();
    var sms_twilio_auth_token = jQuery('#mytwilio_auth_token').val();
    var sms_twilio_sender_number = jQuery('#mytwilio_sender_number').val();
    var sms_twilio_admin_phone_number = jQuery('.company_country_code_value_twilio').text()+""+jQuery('#myadmin_phone_number').val();
	
	 /* Nexmo STATUS */
    var nexmo_status = jQuery('#sms-noti-nexmo').prop("checked");
    if (nexmo_status == true) {
        var sms_nexmo_status = 'Y';
    } else {
        var sms_nexmo_status = 'N';
    }
	var sms_nexmo_api_key = jQuery('#ct_nexmo_api_key').val();
    var sms_nexmo_api_secret = jQuery('#ct_nexmo_api_secret').val();
    var sms_nexmo_from = jQuery('#ct_nexmo_from').val();
    var nexmo_statuss = jQuery('#ct_nexmo_status').prop("checked");
    if (nexmo_statuss == true) {
        var sms_nexmo_statuss = 'Y';
    } else {
        var sms_nexmo_statuss = 'N';
    }
	 var nexmo_statu_send_client = jQuery('#ct_sms_nexmo_send_sms_to_client_status').prop("checked");
    if (nexmo_statu_send_client == true) {
        var sms_nexmo_statu_send_client = 'Y';
    } else {
        var sms_nexmo_statu_send_client = 'N';
    }
	 var nexmo_statu_send_admin = jQuery('#ct_sms_nexmo_send_sms_to_admin_status').prop("checked");
    if (nexmo_statu_send_admin == true) {
        var sms_nexmo_statu_send_admin = 'Y';
    } else {
        var sms_nexmo_statu_send_admin = 'N';
    }
	var sms_nexmo_admin_phone = jQuery('#ct_sms_nexmo_admin_phone_number').val();
	/*  TEXTLOCAL STATUS */
    var textlocal_status = jQuery('#sms-noti-textlocal').prop("checked");
    if (textlocal_status == true) {
        var sms_textlocal_status = 'Y';
    } else {
        var sms_textlocal_status = 'N';
    }
	var textlocal_status_send_admin = jQuery('#ct-textlocal-sms-reminder-admin-status').prop("checked");
    if (textlocal_status_send_admin == true) {
        var sms_textlocal_status_send_admin = 'Y';
    } else {
        var sms_textlocal_status_send_admin = 'N';
    }
	var textlocal_status_send_client = jQuery('#ct-textlocal-sms-reminder-client-status').prop("checked");
    if (textlocal_status_send_client == true) {
        var sms_textlocal_status_send_client = 'Y';
    } else {
        var sms_textlocal_status_send_client = 'N';
    }
    var sms_textlocal_username = jQuery('#mytextlocal_username').val();
    var sms_textlocal_hashid = jQuery('#mytextlocal_account_hash_id').val();
    var textlocal_admin_phone = jQuery('#ct_sms_textlocal_admin_phone').val();
	
    jQuery('#sms_setting_form').validate({
        rules: {
            mytwilio_account_sid : {required: true},
            mytwilio_auth_token : {required: true},
            myadmin_phone_number : {required: true},
            myplivo_account_sid : {required: true},
            myplivo_auth_token : {required: true},
            myadmin_phone_number_plivo : {required: true},
			mytextlocal_username : {required : true},
			mytextlocal_account_hash_id : {required : true},
			ct_sms_textlocal_admin_phone : {required : true}
        },
        messages: {
            mytwilio_account_sid : {required: errorobj_please_enter_account_sid},
            mytwilio_auth_token : {required: errorobj_please_enter_auth_token},
            myadmin_phone_number : {required: errorobj_please_enter_admin_number},
            myplivo_account_sid : {required: errorobj_please_enter_account_sid},
            myplivo_auth_token : {required: errorobj_please_enter_auth_token},
            myadmin_phone_number_plivo : {required: errorobj_please_enter_admin_number},
			mytextlocal_username : {required : errorobj_please_enter_account_username},
			mytextlocal_account_hash_id : {required : errorobj_please_enter_account_hash_id},
			ct_sms_textlocal_admin_phone : {required : errorobj_please_enter_admin_number}
        }
    });
	
    jQuery('.ct-loading-main').show();

    if (!jQuery('#sms_setting_form').valid()) {
        jQuery('.ct-loading-main').hide();
        return false;
    }
    var ajax_url = settingObj.ajax_url;
    var dataString = {
        status_sms_service: sms_service_status,
        account_sid: sms_twilio_account_sid,
        auth_token: sms_twilio_auth_token,
        sender_number: sms_twilio_sender_number,
        status_sms_to_client: send_sms_to_client_status,
        status_sms_to_admin: send_sms_to_admin_status,
        admin_phone: sms_twilio_admin_phone_number,
        account_sid_p: sms_plivo_account_sid,
        auth_token_p: sms_plivo_auth_token,
        sender_number_p: sms_plivo_sender_number,
        status_sms_to_client_p: send_sms_to_client_plivo_status,
        status_sms_to_admin_p: send_sms_to_admin_plivo_status,
        admin_phone_p: sms_plivo_admin_phone_number,
        sms_plivo_status: sms_plivo_status,
        sms_twilio_status: sms_twilio_status,
		sms_nexmo_status: sms_nexmo_status,
		sms_nexmo_api_key: sms_nexmo_api_key,
		sms_nexmo_api_secret: sms_nexmo_api_secret,
		sms_nexmo_from: sms_nexmo_from,
		sms_nexmo_statuss: sms_nexmo_statuss,
		sms_nexmo_statu_send_client: sms_nexmo_statu_send_client,
		sms_nexmo_statu_send_admin: sms_nexmo_statu_send_admin,
		sms_nexmo_admin_phone: sms_nexmo_admin_phone,
		sms_textlocal_status : sms_textlocal_status,
		sms_textlocal_status_send_client : sms_textlocal_status_send_client,
		sms_textlocal_status_send_admin : sms_textlocal_status_send_admin,
		sms_textlocal_username : sms_textlocal_username,
		sms_textlocal_hashid : sms_textlocal_hashid,
		textlocal_admin_phone : textlocal_admin_phone,
        action: "sms_reminder"
    };

    jQuery.ajax({
        type: "POST",
        url: ajax_url + "setting_ajax.php",
        data: dataString,
        success: function (response) {
            /*  location.reload(); */
            jQuery('.ct-loading-main').hide();
            if(jQuery.trim(response)=='updated'){
                jQuery('.mainheader_message').show();
                jQuery('.mainheader_message_inner').css('display','inline');
                jQuery('#ct_sucess_message').text(errorobj_updated_sms_settings);
                jQuery('.mainheader_message').fadeOut(3000);
                location.reload();
            }
        }
    });

});
/*  Below code is use for update appearance settings  */
/*
jQuery(document).on('click', '#appearance_setting', function () {
    jQuery('.ct-loading-main').show();
    var ajax_url = settingObj.ajax_url;
    var primary_color = jQuery('.primary_color').val();
    var secondary_color = jQuery('.secondary_color').val();
    var text_color = jQuery('.text_color').val();
    var text_color_bg = jQuery('.text_color_bg').val();
    var ct_primary_color_admin = jQuery('.ct_primary_color_admin').val();
    var secondary_color_admin = jQuery('.secondary_color_admin').val();
    var text_color_admin = jQuery('.text_color_admin').val();
    var show_service_provider = jQuery('#show-service-provider').prop("checked");
	var custom_css = jQuery('#custom_css').val();
    if (show_service_provider == true) {
        var status_show_provider = 'on';
    } else {
        var status_show_provider = 'off';
    }

    var show_provider_avatars = jQuery('#show-provider-avatars').prop("checked");
    if (show_provider_avatars == true) {
        var provider_avatars = 'on';
    } else {
        var provider_avatars = 'off';
    }

    var show_service_dropdown = jQuery('#show-service-dropdown').prop("checked");
    if (show_service_dropdown == true) {
        var service_dropdown = 'on';
    } else {
        var service_dropdown = 'off';
    }

    var show_service_description = jQuery('#show-service-description').prop("checked");
    if (show_service_description == true) {
        var service_discription = 'on';
    } else {
        var service_discription = 'off';
    }

    var show_coupon_checkout = jQuery('#show-coupons-input-oc').prop("checked");
    if (show_coupon_checkout == true) {
        var coupon_checkout = 'on';
    } else {
        var coupon_checkout = 'off';
    }


    var hide_booked_slot = jQuery('#hide-booked-slot').prop("checked");
    if (hide_booked_slot == true) {
        var booked_slot = 'on';
    } else {
        var booked_slot = 'off';
    }

    var guest_user_checkout = jQuery('#guest-user-checkout').prop("checked");
    if (guest_user_checkout == true) {
        var guest_checkout = 'on';
    } else {
        var guest_checkout = 'off';
    }

    var time_format = jQuery('#ct_time_format').val();
    var date_format_datepicker = jQuery('#date_format_datepicker').val();

    var dataString = {
        primary_color: primary_color,
        secondary_color: secondary_color,
        text_color: text_color,
        text_color_bg: text_color_bg,
        ct_primary_color_admin: ct_primary_color_admin,
        secondary_color_admin: secondary_color_admin,
        text_color_admin: text_color_admin,
        status_show_provider: status_show_provider,
        provider_avatars: provider_avatars,
        service_dropdown: service_dropdown,
        service_discription: service_discription,
        coupon_checkout: coupon_checkout,
        booked_slot: booked_slot,
        guest_checkout: guest_checkout,
        time_format:time_format,
        date_format_datepicker: date_format_datepicker,
		custom_css : custom_css,
        action: "appearance_setting"
    };

    jQuery.ajax({
        type: "POST",
        url: ajax_url + "setting_ajax.php",
        data: dataString,
        success: function (response) {
            jQuery('.ct-loading-main').hide();
            if(response=='updated'){
                jQuery('.mainheader_message').show();
                jQuery('.mainheader_message_inner').css('display','inline');
                jQuery('#ct_sucess_message').text(errorobj_updated_appearance_settings);
                jQuery('.mainheader_message').fadeOut(3000);
                location.reload();
            }

        }
    });
});
*/

jQuery(document).on('click', '.payment_warning_close', function () {
	jQuery('.payment_warning').hide('fade');
});

jQuery(document).on('change', '.payment_choice', function () {
	var pay_locally = jQuery('#pay-locally').prop("checked");
	var paypal_checkout = jQuery('#paypal-checkout').prop("checked");
	var authorize_net_enable = jQuery('#authorizedotnet-payment-checkout').prop("checked");
	var stripe_enable = jQuery('#stripe-payment-checkout').prop("checked");
	var twocheckout_enable = jQuery('#twocheckout-payment-checkout').prop("checked");
	var paumoney_enable = jQuery('#payu-money').prop("checked");
	var cur_button_id = jQuery(this).attr('id');
	var ext_payments = '';
	
	jQuery('.payment_choice').each(function(){
		if(jQuery(this).hasClass('ct_ext_payments_list') ==true){
			ext_payments += ' '+jQuery(this).prop("checked");
		}
	});
	
	if(cur_button_id == "paypal-checkout" || cur_button_id == "pay-locally" || cur_button_id == "payu-money"){
		
	}else if(jQuery(this).hasClass('ct_indirect_paymethod')){
		
	}else{
		jQuery('.payment_choice').each(function(){
			var check = jQuery(this).attr('id');
			if(check == "paypal-checkout" || check == "pay-locally" || check == "payu-money" || cur_button_id==check || jQuery(this).hasClass('ct_indirect_paymethod') ==true){
			}else{
				jQuery('#'+check).attr("checked",false);
				jQuery('#'+check).parent().prop('className','toggle btn btn-danger btn-sm off');
				jQuery('.mycollapse_'+check).removeAttr("style");
			}
		});
	}
	if(pay_locally!=true && paypal_checkout!=true && authorize_net_enable!=true && stripe_enable!=true && twocheckout_enable!=true && paumoney_enable!=true && ext_payments.toLowerCase().indexOf("true") <= 0) {
		jQuery('.mainheader_message_fail').show();
		jQuery('.mainheader_message_inner_fail').css('display', 'inline');
		jQuery('#ct_sucess_message_fail').text(errorobj_atleast_one_payment_method_should_be_enable);
		jQuery('.mainheader_message_fail').fadeOut(5000);
		jQuery('.ct-loading-main').hide();
		jQuery('#'+cur_button_id).prop("checked",true) ;
		jQuery('#'+cur_button_id).parent().prop('className','toggle btn btn-success btn-sm on');
		jQuery('.mycollapse_'+cur_button_id).toggle("blind", {direction: "vertical"}, 1000);
	}
});


/*  Below Code is use for update payment setting  */
jQuery(document).on('click', '#payment_setting', function () {
    jQuery('.ct-loading-main').show();
    var ajax_url = settingObj.ajax_url;
    
    var payemnt_gateway_all = 'on';
	
    var pay_locally = jQuery('#pay-locally').prop("checked");

	if (pay_locally == true) {
		var payemnt_locally = 'on';
    } else {
        var payemnt_locally = 'off';
    }

    var paypal_checkout = jQuery('#paypal-checkout').prop("checked");
    if (paypal_checkout == true) {
        var payemnt_paypal = 'on';
    } else {
        var payemnt_paypal = 'off';
    }

    if(payemnt_paypal == 'on'){
        jQuery('#payment_getway_form').validate();

        jQuery('#ct_paypal_api_username').rules("add",
            {required:true,
                messages:{required:errorobj_please_enter_api_username}
            });
        jQuery('#ct_paypal_api_password').rules("add",
            {required:true,
                messages:{required:errorobj_please_enter_api_password}
            });
        jQuery('#ct_paypal_api_signature').rules("add",
            {required:true,
                messages:{required:errorobj_please_enter_signature}
            });
    }

    var username = jQuery('#ct_paypal_api_username').val();

    var password = jQuery('#ct_paypal_api_password').val();

    var signature = jQuery('#ct_paypal_api_signature').val();

    var paypal_guest_payment = jQuery('#paypal-guest-payment').prop("checked");
    if (paypal_guest_payment == true) {
        var payemnt_guest = 'on';
    } else {
        var payemnt_guest = 'off';
    }

    var paypal_test_mode = jQuery('#paypal-test-mode').prop("checked");
    if (paypal_test_mode == true) {
        var test_mode = 'on';
    } else {
        var test_mode = 'off';
    }


    var stripe_payment_checkout = jQuery('#stripe-payment-checkout').prop("checked");
    if (stripe_payment_checkout == true) {
		var stripe_payment = 'on';
    } else {
		var stripe_payment = 'off';
    }
    
    if(stripe_payment=='on'){
        jQuery('#payment_getway_form').validate();

        jQuery('#ct_stripe_secretkey').rules("add",
            {required:true,
                messages:{required:errorobj_please_enter_secret_key}
            });
        jQuery('#ct_stripe_publishablekey').rules("add",
            {required:true,
                messages:{required:errorobj_please_enter_publishable_key}
            });

    }


    var secretkey = jQuery('#ct_stripe_secretkey').val();

    var publishablekey = jQuery('#ct_stripe_publishablekey').val();
   	
	/*  Authorize.net credetnails  */
	
	var authorize_net_enable = jQuery('#authorizedotnet-payment-checkout').prop("checked");
    if (authorize_net_enable == true) {
        var authorize_net_status = 'on';
    } else {
        var authorize_net_status = 'off';
    }
	
	
	
	
	var autorize_login_ID = jQuery('#ct-authorizenet-API-login-ID').val();
	var authorize_transaction_key =  jQuery('#ct-authorize-transaction-key').val();
	if(jQuery('#authorize-sandbox-mode').prop("checked")){
		var authorize_test_mode = 'on';
	}else {
		var authorize_test_mode = 'off';
	}
    if(authorize_net_status=='on'){
        jQuery('#payment_getway_form').validate();

        jQuery('#ct-authorizenet-API-login-ID').rules("add",
            {required:true,
                messages:{required:errorobj_please_enter_api_login_id}
            });
        jQuery('#ct-authorize-transaction-key').rules("add",
            {required:true,
                messages:{required:errorobj_please_enter_transaction_key}
            });
    }
	/*  2 checkout payment method start */
	var twocheckout_payment_checkout = jQuery('#twocheckout-payment-checkout').prop("checked");
    if (twocheckout_payment_checkout == true) {
		var twocheckout_payment = 'Y';
    } else {
		var twocheckout_payment = 'N';
    }
    
	if(twocheckout_payment=='Y'){
        jQuery('#payment_getway_form').validate();

        jQuery('#ct_2checkout_privatekey').rules("add",
            {required:true,
                messages:{required:errorobj_please_enter_private_key}
            });
        jQuery('#ct_2checkout_publishkey').rules("add",
            {required:true,
                messages:{required:errorobj_please_publishable_key}
            });
		jQuery('#ct_2checkout_sellerid').rules("add",
            {required:true,
                messages:{required:errorobj_please_enter_seller_id}
            });
    }
	
    var twocheckout_test_mode = jQuery('#ct_2checkout_sandbox_mode').prop("checked");
    if (twocheckout_test_mode == true) {
        var twocheckout_testmode = 'Y';
    } else {
        var twocheckout_testmode = 'N';
    }

    var twocheckout_privatekey = jQuery('#ct_2checkout_privatekey').val();
    var twocheckout_sellerid = jQuery('#ct_2checkout_sellerid').val();
    var twocheckout_publishkey = jQuery('#ct_2checkout_publishkey').val();
	/*  2 checkout payment method end */
	
	/* Payumoney */
	var payumoney_status_check = jQuery('#payu-money').prop("checked");
    if (payumoney_status_check == true) {
        var payumoney_status = 'Y';
    } else {
        var payumoney_status = 'N';
    }
	var bank_transfer_status = jQuery('#bank-transfer-payment-checkout').prop("checked");
    if (bank_transfer_status == true) {
        var bank_status = 'Y';
    } else {
        var bank_status = 'N';
    }
	
	if(payumoney_status=='Y'){
        jQuery('#payment_getway_form').validate();

        jQuery('#ct_payumoney_merchant_key').rules("add",
            {required:true,
                messages:{required:errorobj_please_enter_merchant_key}
            });
        jQuery('#ct_payumoney_salt').rules("add",
            {required:true,
                messages:{required:errorobj_please_enter_salt_key}
            });
    }
	
	var payumoney_merchantkey = jQuery('#ct_payumoney_merchant_key').val();
    var payumoney_saltkey = jQuery('#ct_payumoney_salt').val();
	/* end */
	
	
	/*bank*/
	var bank_name = jQuery('#ct_bank_name').val();
	var account_name = jQuery('#ct_account_name').val();
	var account_number = jQuery('#ct_account_number').val();
	var branch_code = jQuery('#ct_branch_code').val();
	var ifsc_code = jQuery('#ct_ifsc_code').val();
	var bank_description = jQuery('#ct_bank_description').val();
	/*end*/
	
    var dataString = {
        payemnt_gateway_all: payemnt_gateway_all,
        payemnt_locally: payemnt_locally,
        payemnt_paypal: payemnt_paypal,
        username: username,
        password: password,
        signature: signature,
        payemnt_guest: payemnt_guest,
        test_mode: test_mode,
        stripe_payment: stripe_payment,
        secretkey: secretkey,
        publishablekey: publishablekey,
        action: "payment_setting",
		authorize_net_status:authorize_net_status,
		autorize_login_ID:autorize_login_ID,
		authorize_transaction_key:authorize_transaction_key,
		authorize_test_mode:authorize_test_mode,
		twocheckout_testmode:twocheckout_testmode,
		twocheckout_payment:twocheckout_payment,
		twocheckout_privatekey:twocheckout_privatekey,
		twocheckout_publishkey:twocheckout_publishkey,
		twocheckout_sellerid:twocheckout_sellerid,
		payumoney_status:payumoney_status,
		payumoney_merchantkey:payumoney_merchantkey,
		payumoney_saltkey:payumoney_saltkey,
		/*new add*/
		bank_name:bank_name,
		bank_status:bank_status,
		account_name:account_name,
		account_number:account_number,
		branch_code:branch_code,
		ifsc_code:ifsc_code,
		bank_description:bank_description
    };
	payment_save_settings_js(dataString);
	payment_validation_js();
    if(jQuery('#payment_getway_form').valid()){
        jQuery.ajax({
            type: "POST",
            url: ajax_url + "setting_ajax.php",
            data: dataString,
            success: function (response) {
                jQuery('.ct-loading-main').hide();
                if(jQuery.trim(response)=='updated'){
                    jQuery('.mainheader_message').show();
                    jQuery('.mainheader_message_inner').css('display','inline');
                    jQuery('#ct_sucess_message').text(errorobj_updated_payments_settings);
                    jQuery('.mainheader_message').fadeOut(3000);
					window.location.reload();
                }
            }
        });
    }else{
        jQuery('.ct-loading-main').hide();
    }
});


/*  Below code is use for update email settings  */
jQuery(document).on('click', '#email_setting', function () {
    
	if (jQuery('.ct-email-settings').valid()) {
		jQuery('.ct-loading-main').show();
		var ajax_url = settingObj.ajax_url;
		var status_admin_email = jQuery('#admin-email-notification').prop("checked");
		if (status_admin_email == true) {
			var admin_email = 'Y';
		} else {
			var admin_email = 'N';
		}

	  
		var status_staff_email = jQuery('#staff-email-notification').prop("checked");
		if (status_staff_email == true) {
			var staff_email = 'Y';
		} else {
			var staff_email = 'N';
		}
		
		var status_client_email = jQuery('#client-email-notification').prop("checked");
		if (status_client_email == true) {
			var client_email = 'Y';
		} else {
			var client_email = 'N';
		}

		var sender_name = jQuery('#sender_name').val();
		var sender_email = jQuery('#sender_email').val();
		var admin_optional_email = jQuery('#admin_optional_email').val();
		var appointment_reminder = jQuery('#appointment_reminder').val();

		var hostname = jQuery('#ct_smtp_hostname').val();
		var username = jQuery('#ct_smtp_username').val();
		var password = jQuery('#ct_smtp_password').val();
		var port = jQuery('#ct_smtp_port').val();
		var encryptiontype=jQuery('#encryption_val').val();
		var autheticationtype=jQuery('#authentication_val').val();
		var dataString = {
			admin_email: admin_email,
			staff_email: staff_email,
			client_email: client_email,
			sender_name: sender_name,
			sender_email: sender_email,
			admin_optional_email : admin_optional_email,
			appointment_reminder: appointment_reminder,
			hostname : hostname,
			username : username,
			password : password,
			encryptiontype:encryptiontype,
			autheticationtype:autheticationtype,
			port : port,
			action: "email_setting"
		};
		jQuery.ajax({
			type: "POST",
			url: ajax_url + "setting_ajax.php",
			data: dataString,
			success: function (response) {
				jQuery('.ct-loading-main').hide();
				if(jQuery.trim(response)=='updated'){
					jQuery('.mainheader_message').show();
					jQuery('.mainheader_message_inner').css('display','inline');
					jQuery('#ct_sucess_message').text(errorobj_updated_email_settings);
					jQuery('.mainheader_message').fadeOut(3000);
				}
			}
		});
	}
});

/* Below code is for multi language settings */
/*
jQuery(document).on('click','.label_setting',function(){
    jQuery('.ct-loading-main').show();
    var ajax_url = settingObj.ajax_url;
    var labelvalue_front = {};
    var labelvalue_admin = {};
    var labelvalue_error = {};
    var labelvalue_extra = {};
    jQuery('.langlabel_front').each(function () {
		labelvalue_front[jQuery(this).data('id')] = jQuery(this).val();
    });
	jQuery('.langlabel_admin').each(function () {
        labelvalue_admin[jQuery(this).data('id')] = jQuery(this).val();
    });
	jQuery('.langlabel_error').each(function () {
        labelvalue_error[jQuery(this).data('id')] = jQuery(this).val();
    });
	jQuery('.langlabel_extra').each(function () {
        labelvalue_extra[jQuery(this).data('id')] = jQuery(this).val();
    });
	
	
    var dataString = {
			labels_front: labelvalue_front,
			labels_admin: labelvalue_admin,
			labels_error: labelvalue_error,
			labels_extra: labelvalue_extra,
			update_labels : jQuery('#update_labels').val(),
			change_language : 1
		}
	jQuery.ajax({
		type: "POST",
		url: ajax_url + "setting_ajax.php",
		data: dataString,
		success: function (response) {
			jQuery('.ct-loading-main').hide();
			jQuery('.mainheader_message').show();
			jQuery('.mainheader_message_inner').css('display','inline');
			jQuery('#ct_sucess_message').text(errorobj_updated_front_display_language_and_update_labels);
			jQuery('.mainheader_message').fadeOut(3000);
			window.location.reload();
		}
	});
});
*/
jQuery(document).on('change','#update_labels',function(){
    
    var lang = jQuery(this).val();
	
    if(lang!=""){
        jQuery('.show_all_labels').slideUp();

		jQuery('.ct-loading-main').show();
		jQuery(".error_labels").css("display","none");
		if(lang=="0" || lang=="none"){
			jQuery('.show_all_labels').slideUp();
			jQuery('.myall_lang_label').hide();
			jQuery('.ct-loading-main').hide();
			jQuery('.label_setting').hide();
		}
		else{
			jQuery.ajax({
				type: "POST",
				url: ajax_url + "setting_ajax.php",
				data: {
					get_all_labels : 1,
					oflang : lang
				},
				success: function (response) {
                    console.log(response);
					jQuery('.myall_lang_label').html(response);
					jQuery('.myall_lang_label').show();
					jQuery('.label_setting').show();
					jQuery('.ct-loading-main').hide();
				}
			});
		}
	}
});

/* Below code is use for front tool tips */
jQuery(document).on('click', '.front_tooltips_setting', function () {
    jQuery('.ct-loading-main').show();
    var ajax_url = settingObj.ajax_url;
    var front_tooltips = jQuery('#front-tooltips').prop("checked");
    if (front_tooltips == true) {
        var status_front_tooltips = 'on';
    } else {
        var status_front_tooltips = 'off';
    }

	
	var tooltips_my_booking = jQuery('#ct_front_tool_tips_my_bookings').val();
    var tooltips_postal_code = jQuery('#ct_front_tool_tips_postal_code').val();
	var tooltips_service = jQuery('#ct_front_tool_tips_services').val();
    var tooltips_addons_service = jQuery('#ct_front_tool_tips_addons_services').val();

    var tooltips_frequently_discount = jQuery('#ct_front_tool_tips_frequently_discount').val();
    var tooltips_time_slots = jQuery('#ct_front_tool_tips_time_slots').val();
    var tooltips_personal_details = jQuery('#ct_front_tool_tips_personal_details').val();
    var tooltips_promocode = jQuery('#ct_front_tool_tips_promocode').val();
	var tooltips_payment_method = jQuery('#ct_front_tool_payment_method').val();
    var dataString = {
        status_front_tooltips: status_front_tooltips,
        tooltips_my_booking: tooltips_my_booking,
        tooltips_postal_code: tooltips_postal_code,
        tooltips_service: tooltips_service,
        tooltips_addons_service: tooltips_addons_service,
		tooltips_frequently_discount : tooltips_frequently_discount,
        tooltips_time_slots: tooltips_time_slots,
        tooltips_personal_details : tooltips_personal_details,
        tooltips_promocode : tooltips_promocode,
        tooltips_payment_method : tooltips_payment_method,
        action: "front_tooltips_setting"
    };
    jQuery.ajax({
        type: "POST",
        url: ajax_url + "setting_ajax.php",
        data: dataString,
        success: function (response) {
            jQuery('.ct-loading-main').hide();
            if(jQuery.trim(response)=='updated'){
                jQuery('.mainheader_message').show();
                jQuery('.mainheader_message_inner').css('display','inline');
                jQuery('#ct_sucess_message').text(errorobj_updated_email_settings);
                jQuery('.mainheader_message').fadeOut(3000);
            }
        }

    });
});
/*  Use for Tax/vat  */
jQuery(document).ready(function () {
    jQuery('.tax_vat_radio').click(function () {
        if (jQuery(this).val() == "P") {
            jQuery(".ct-tax-percent").addClass('fa fa-percent');
        }
        if (jQuery(this).val() == "F") {
            jQuery(".ct-tax-percent").removeClass('fa fa-percent');
        }

    });
});

/*  Use for partial deposite */
jQuery(document).ready(function(){

    jQuery('.partial_radio').click(function(){
        if(jQuery(this).val()=="P"){
            jQuery(".ct-partial-deposit-percent").addClass('fa fa-percent');
        }
        if(jQuery(this).val()=="F"){
            jQuery(".ct-partial-deposit-percent").removeClass('fa fa-percent');
        }

    });
});


/*  Below code is use for adding promo code promocode settings */


/* Edit Coupon */
jQuery(document).ready(function () {

    jQuery(document).on('ajaxComplete click','.ct-edit-coupon',function(){
        var promocodeid = jQuery(this).data('id');
        jQuery(".update-promocode-new").each(function () {
            jQuery(this).hide();
        });
        jQuery(".ct-update-promocode-li").addClass('active');
        jQuery(".promocode-list-li").removeClass('active');
        jQuery(".ct-update-promocode-li").show();
        jQuery("#update-promocode-form" + promocodeid).show();
    });
});

jQuery(document).on('click', '.promocode-list-li', function () {
    jQuery(".ct-update-promocode-li").hide();
});


/* hide datep[icker on select date */
jQuery(document).ready(function(){
	var m_jan = month.january;	
var m_feb = month.feb;	
var m_mar = month.mar;	
var m_apr = month.apr;	
var m_may = month.may;	
var m_jun = month.jun;	
var m_jul = month.jul;	
var m_aug = month.aug;	
var m_sep = month.sep;	
var m_oct = month.oct;	
var m_nov = month.nov;	
var m_dec = month.dec;	
var d_sun = days_date.sun;
var d_mon = days_date.mon;
var d_tue = days_date.tue;
var d_wed = days_date.wed;
var d_thu = days_date.thu;
var d_fri = days_date.fri;
var d_sat = days_date.sat;
    jQuery('#expiry_date').datepicker(
	{
		dateFormat: 'yy-mm-dd',
		minDate: 0,
		dayNamesMin: [d_sun,d_mon,d_tue,d_wed,d_thu,d_fri,d_sat],
		monthNames: [m_jan,m_feb,m_mar,m_apr,m_may,m_jun,m_jul,m_aug,m_sep,m_oct,m_nov,m_dec,]
	});
    jQuery('#expiry_date').on('change', function () {
        jQuery('.datepicker').hide();
    });
});

jQuery(document).ready(function(){
	var m_jan = month.january;	
var m_feb = month.feb;	
var m_mar = month.mar;	
var m_apr = month.apr;	
var m_may = month.may;	
var m_jun = month.jun;	
var m_jul = month.jul;	
var m_aug = month.aug;	
var m_sep = month.sep;	
var m_oct = month.oct;	
var m_nov = month.nov;	
var m_dec = month.dec;	
var d_sun = days_date.sun;
var d_mon = days_date.mon;
var d_tue = days_date.tue;
var d_wed = days_date.wed;
var d_thu = days_date.thu;
var d_fri = days_date.fri;
var d_sat = days_date.sat;
    jQuery('.exp_cp_date').datepicker(
	{
		dateFormat: 'yy-mm-dd',
		minDate: 0,
		dayNamesMin: [d_sun,d_mon,d_tue,d_wed,d_thu,d_fri,d_sat],
		monthNames: [m_jan,m_feb,m_mar,m_apr,m_may,m_jun,m_jul,m_aug,m_sep,m_oct,m_nov,m_dec,]
	});
    jQuery('.exp_cp_date').on('change', function () {
        jQuery('.datepicker').hide();
    });
});
/* ADD PROMOCODE */
jQuery(document).on('click', '#promo_code', function () {
    jQuery('.ct-loading-main').show();
    var coupon_code = jQuery('#coupon_code').val();
    var coupon_type = jQuery('#coupon_type').val();
    var value = jQuery('#coupon_value').val();
    var limit = jQuery('#coupon_limit').val();
    var expiry_date = jQuery('#expiry_date').val();

    jQuery('#form_promo_code').validate({
        rules: {
            coupon_code: {required: true},
            coupon_limit: {required: true, pattern_cp: true},
            coupon_value: {required: true, pattern_cp: true},
			coupon_expiry_date: {required: true},
        },
        messages: {
            coupon_code: {
                required: errorobj_please_enter_coupon_code
            },
            coupon_limit: {required: errorobj_please_enter_coupon_limit, pattern_cp: errorobj_please_enter_only_numerics},
            coupon_value: {required: errorobj_please_enter_coupon_value, pattern_cp: errorobj_please_enter_only_numerics},
			coupon_expiry_date: {required: errorobj_please_select_expiry_date},
        }
    });
    if (!jQuery('#form_promo_code').valid()) {
        jQuery('.ct-loading-main').hide();
        return false;
    }
    jQuery('.ct-loading-main').show();
    var datastring = {
        coupon_code: coupon_code,
        coupon_type: coupon_type,
        value: value,
        limit: limit,
        expiry_date: expiry_date,
        action: 'add_promo_code'
    };
    jQuery.ajax({
        type: "POST",
        url: ajax_url + "promo_code_ajax.php",
        data: datastring,
        success: function (response) {
            if(parseInt(response) == 1){
                jQuery('.mainheader_message_fail').show();
                jQuery('.mainheader_message_inner_fail').css('display', 'inline');
                jQuery('#ct_sucess_message_fail').text(errorobj_sorry_promocode_already_exist);
                jQuery('.mainheader_message_fail').fadeOut(3000);
                jQuery('.ct-loading-main').hide();
            }
            else
            {
                jQuery('.ct-loading-main').hide();
                location.reload();
            }

        }
    });

});

/* DELETE PROMOCODE */

jQuery(document).on('click', '.mybtndeletepromocode', function () {
    var recordid = jQuery(this).data("id");
    jQuery('.ct-loading-main').show();
    var datastring = {recordid: recordid, action: 'delete_record'};
    jQuery.ajax({
        type: "POST",
        url: ajax_url + "promo_code_ajax.php",
        data: datastring,
        success: function (response) {
            jQuery('#coupondata_row' + recordid).fadeOut();
            jQuery('.ct-loading-main').hide();
        }
    });

});


/* UPDATE PROMOCODE CODE */
jQuery(document).on('click', '.mybtnupdatepromocode', function () {
    var id = jQuery(this).data('id');
    var edit_coupon_code = jQuery('#edit_coupon_code' + id).val();
    var edit_coupon_type = jQuery('#edit_coupon_type' + id).val();
    var edit_value = jQuery('#edit_value' + id).val();
    var edit_limit = jQuery('#edit_limit' + id).val();
    var edit_expiry_date = jQuery('#edit_expiry_date' + id).val();

    jQuery('#update_promo_formss' + id).validate();

    jQuery("#edit_value" + id).rules("add",
        {
            required: true, 
            messages: {required: errorobj_please_enter_coupon_value}
        });
    jQuery("#edit_coupon_code" + id).rules("add",
        {
            required: true,
            messages: {
                required: errorobj_please_enter_coupon_code
            }
        });

    jQuery("#edit_limit" + id).rules("add",
        {
            required: true,
            messages: {required: errorobj_please_enter_coupon_limit}
        });


    if (!jQuery('#update_promo_formss' + id).valid()) {
        return false;
    }
    jQuery('.ct-loading-main').show();
    var datastring = {
        recordid: id,
        edit_coupon_code: edit_coupon_code,
        edit_coupon_type: edit_coupon_type,
        edit_value: edit_value,
        edit_limit: edit_limit,
        edit_expiry_date: edit_expiry_date,
        action: 'edit_promo_code'
    };

    jQuery.ajax({
        type: "POST",
        url: ajax_url + "promo_code_ajax.php",
        data: datastring,
        success: function (response) {
            jQuery('.ct-loading-main').hide();
            location.reload();
        }
    });
});

/* ***************Export Page********************** */
/*  services Addons information export details */
jQuery(document).bind('ajaxComplete', function () {
    jQuery('#table-service-addons').DataTable({
        retrieve: true,
        dom: 'lfrtipB',

        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
    $.fn.dataTableExt.sErrMode = 'throw';
});


/* LOAD ALL ADDONS */
jQuery(document).on('click', '.service_addons', function () {
    var id = jQuery(this).attr('id');
    var table = $('#table-service-addons').DataTable();
    var dataString = {
        id: id,
        action: "display_ser_addons"
    }

    jQuery('.ct-loading-main').show();
    jQuery.ajax({
        type: "POST",
        url: ajax_url + "export_ajax.php",
        data: dataString,
        success: function (response) {
            table.destroy();

            jQuery('.ct-loading-main').hide();
            jQuery('#display_addons').html(response);
        }

    });
});

/*  services Method information export details */
jQuery(document).bind('ajaxComplete', function () {
    jQuery('#table-service-method').DataTable({
        retrieve: true,
        dom: 'lfrtipB',

        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
    $.fn.dataTableExt.sErrMode = 'throw';
});

/* LOAD ALL METHODS */
jQuery(document).on('click', '.service_methods', function () {
    var id = jQuery(this).attr('id');
    var table = $('#table-service-method').DataTable();
    var dataString = {
        id: id,
        action: "display_ser_method"
    }

    jQuery('.ct-loading-main').show();
    jQuery.ajax({
        type: "POST",
        url: ajax_url + "export_ajax.php",
        data: dataString,
        success: function (response) {
            table.destroy();

            jQuery('.ct-loading-main').hide();
            jQuery('#display_method').html(response);
        }

    });
});

/*  services Method information export details */
jQuery(document).bind('ajaxComplete', function () {
    jQuery('#table-booking-addons').DataTable({
        retrieve: true,
        dom: 'lfrtipB',

        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
    $.fn.dataTableExt.sErrMode = 'throw';
});

/* LOAD BOOKING ADDONS */
jQuery(document).on('click', '.booking_addons', function () {
    var id = jQuery(this).attr('id');
    var table = $('#table-booking-addons').DataTable();
    var dataString = {
        id: id,
        action: "display_booking_addons"
    }

    jQuery('.ct-loading-main').show();
    jQuery.ajax({
        type: "POST",
        url: ajax_url + "export_ajax.php",
        data: dataString,
        success: function (response) {
            table.destroy();

            jQuery('.ct-loading-main').hide();
            jQuery('#display_booking_addons').html(response);
        }

    });
});


/*  services Method information export details */
jQuery(document).bind('ajaxComplete', function () {
    jQuery('#table-booking-method').DataTable({
        retrieve: true,
        dom: 'lfrtipB',

        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
    $.fn.dataTableExt.sErrMode = 'throw';
});

/* LOAD BOOKING METHODS */
jQuery(document).on('click', '.booking_methods', function () {
    var id = jQuery(this).attr('id');
    var table = $('#table-booking-method').DataTable();
    var dataString = {
        id: id,
        action: "display_booking_method"
    }

    jQuery('.ct-loading-main').show();
    jQuery.ajax({
        type: "POST",
        url: ajax_url + "export_ajax.php",
        data: dataString,
        success: function (response) {
            table.destroy();

            jQuery('.ct-loading-main').hide();
            jQuery('#display_booking_method').html(response);
        }

    });
});


/* off day */
jQuery(document).on('click', '.offsingledate', function () {
    jQuery('.ct-loading-main').show();

    var date_id = jQuery(this).attr('id');
    var prov_id = jQuery(this).data('prov_id');
    if (jQuery(this).hasClass('highlight')) {

        jQuery(this).removeClass('highlight');
    } else {
        jQuery(this).addClass('highlight');

    }
    var dataString = {
        date_id: date_id,
        prov_id: prov_id,
        status: 'off_day'
    };

    jQuery.ajax({
        type: "POST",
        url: ajax_url + "weekday_ajax.php",
        data: dataString,
        success: function (res) {
            jQuery('.ct-loading-main').hide();
			jQuery('.mainheader_message').show();
			jQuery('.mainheader_message').css('display', 'block');
			jQuery('#ct_sucess_message').text(res);
			jQuery('.mainheader_message').fadeOut(3000);
        }
    });
});

/* Below code is use for add and delete month off days */
jQuery(document).on('click', '.all', function () {

    jQuery('.ct-loading-main').show();
    var checkmonthdate = jQuery(this).prop("checked");
    if (checkmonthdate == true) {
        var monthcheck = "on";
    } else {
        var monthcheck = "off";
    }

    if (monthcheck == "on") {
        var date_id = jQuery(this).attr('id');
        var provider_id = jQuery(this).data('prov_id');
        var m = jQuery(this).attr('id');
        if (jQuery(this).hasClass('highlight')) {
            jQuery(this).removeClass('highlight');
        } else {
            jQuery(this).addClass('highlight');
        }
        var dataString = {
            date_id: date_id,
            provider_id: provider_id,
            status: 'month_off_day'
        };
        jQuery.ajax({
            type: "POST",
            url: ajax_url + "weekday_ajax.php",
            data: dataString,
            success: function (response) {
                jQuery('.ct-loading-main').hide();
            }
        });
    } else {
        jQuery('.ct-loading-main').show();
        var date_id = jQuery(this).attr('id');
        var provider_id = jQuery(this).data('prov_id');
        var m = jQuery(this).attr('id');
        if (jQuery(this).hasClass('highlight')) {
            jQuery(this).removeClass('highlight');
        } else {
            jQuery(this).addClass('highlight');
        }
        var dataString = {
            date_id: date_id,
            provider_id: provider_id,
            status: 'delete_month_off_day'
        };
        jQuery.ajax({
            type: "POST",
            url: ajax_url + "weekday_ajax.php",
            data: dataString,
            success: function (response) {
                jQuery('.ct-loading-main').hide();
            }
        });
    }
    var yearmonthid = jQuery(this).attr('id');
    var spyear = yearmonthid.split("-");
    var syear = spyear[0];
    var smonth = spyear[1];
    if (jQuery(this).is(":checked")) {
        jQuery('.offsingledate').each(function () {
            var whole = jQuery(this).attr('id');
            var sp = whole.split("-");
            if (syear == sp[0] && smonth == sp[1]) {
                jQuery(this).addClass('highlight');
            }
        });
    } else {
        jQuery('.offsingledate').each(function () {
            var whole = jQuery(this).attr('id');
            var sp = whole.split("-");
            if (syear == sp[0] && smonth == sp[1]) {
                jQuery(this).removeClass('highlight');
            }
        });
    }
});


/* customers page */
/* FOR REGISTERED CUSTOMERS */
/* GET ALL BOOKINGS OF THE CUSTOMER ON CLICK OF THE BOOKING BUTTON */
jQuery(document).bind('ajaxComplete', function () {
    jQuery('#registered-client-booking-details_new').DataTable({
        retrieve: true,
        dom: 'lfrtipB',

        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
    $.fn.dataTableExt.sErrMode = 'throw';
});
jQuery(document).on('click', '.myregistercust_bookings', function () {
    var id = jQuery(this).data('id');
    var table = jQuery('#registered-client-booking-details_new').DataTable();
    var dataString = {
        id: id,
        getclient_bookings_details: 1
    };
    jQuery.ajax({
        type: "POST",
        url: ajax_url + "customer_admin_ajax.php",
        data: dataString,
        success: function (res) {
            table.destroy();
            jQuery('#details_booking_display').html(res);
        }
    });
});

/* FOR GUEST CUSTOMERS */
/* GET ALL BOOKINGS OF THE CUSTOMER ON CLICK OF THE BOOKING BUTTON */
jQuery(document).bind('ajaxComplete', function () {
    jQuery('#guest-client-booking-details_new').DataTable({
        retrieve: true,
        dom: 'frtipB',

        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
    $.fn.dataTableExt.sErrMode = 'throw';
});
jQuery(document).on('click', '.myguestcust_bookings', function () {
    var id = jQuery(this).data('id');
    var email = jQuery(this).data('email');
    var table = jQuery('#guest-client-booking-details_new').DataTable();
    var dataString = {
        orderid: id,
        guest: 1,
        email: email
    };
    jQuery.ajax({
        type: "POST",
        url: ajax_url + "customer_admin_ajax.php",
        data: dataString,
        success: function (res) {
            table.destroy();
            jQuery('#details_booking_display_guest').html(res);
        }
    });
});

/* DELETE THE BOOKINGS OF THE GUEST CUSTOMERS FROM CUSTOMER PAGE */
jQuery(document).on('click', '.mybtndelete_guest_customers_entry', function () {

    jQuery('.ct-loading-main').show();
    var orderid = jQuery(this).data('id');
    jQuery.ajax({
        type: 'post',
        data: {
            delete_guest_bookings: 1,
            orderid: orderid
        },
        url: ajax_url + "customer_admin_ajax.php",
        success: function (res) {
            jQuery('#myguest_' + orderid).remove();
            jQuery('.ct-loading-main').hide();
        }
    });
});


/* SETTINGS PAGE COMPANY VALIDATION */
/*  Validation for setting Business Details  */

jQuery(document).ready(function () {
    
    jQuery.validator.addMethod("pattern_ser_title", function (value, element) {
        return this.optional(element) || /^[a-zA-Z '.'_@./#&+-]+$/.test(value);
    }, "Enter Only Alphabets");
    jQuery('#business_setting_form').validate({

        rules: {
            ct_company_name: {required: true, maxlength : 36},
            ct_company_email: {required: true},
            ct_company_address: {required: true},
            ct_company_city: {required: true},
            ct_company_state: {required: true},
            ct_company_zip: {required: true, minlength: 3, maxlength: 7},
            ct_company_country: {required: true},
            ct_company_country_code: {pattern_company_country_code: true},
            ct_company_phone: {minlength: 10, maxlength: 10,number:true}
        },
        messages: {
            ct_company_name: {required: errorobj_please_enter_name,maxlength :errorobj_please_enter_below_36_characters},
            ct_company_email: errorobj_please_enter_email,
            ct_company_address: errorobj_please_enter_address,
            ct_company_city: errorobj_please_enter_city,
            ct_company_state: errorobj_please_enter_state,
            ct_company_zip: {
                required: errorobj_please_enter_zipcode,
                minlength: errorobj_please_enter_minimum_3_chars,
                maxlength: errorobj_please_enter_only_7_chars_maximum
            },
            ct_company_country: errorobj_please_enter_country,
            ct_company_country_code: {pattern_company_country_code: errorobj_please_enter_valid_country_code},
            ct_company_phone: {required:errorobj_please_enter_phone_number,minlength:errorobj_please_enter_minimum_10_digits,maxlength:errorobj_please_enter_valid_number,number : errorobj_please_enter_only_numerics}
        }
    });
});

/* LOGOUT CODE */
jQuery(document).on('click', '#logout', function () {
    var site_url=site_ur.site_url;
    var user = jQuery(this).data("id");
    jQuery.ajax({
        type: 'post',
        data: {
            logout: 1
        },
        url: ajax_url + "admin_login_ajax.php",
        success: function (res) {

            if(user=="user"){
               window.location=site_url;
            }
            else{
                location.reload();
            }
        }
    });
});

/* Reject Booking in Dashboard */
jQuery(document).ajaxComplete(function () {
    jQuery('.book_rejct').popover({
        html: true,
        content: function () {
            var booking_id = jQuery(this).data('bkid');
            return jQuery('#popover-reject-appointment-cal-popup' + booking_id).html();
        }
    });
});


/* Setting Image Upload */
jQuery(document).on("click", ".ct_upload_img3", function (e) {
    jQuery('.ct-loading-main').show();
    var imageuss = jQuery(this).data('us');
    var imageids = jQuery(this).data('imageinputid');
    var file_data = jQuery("#" + jQuery(this).data('imageinputid')).prop("files")[0];
    /* var ajax_url = settingObj.ajax_url; */
    /*  var img_site_url = setting_Obj.site_url; */
    var img_site_url = servObj.site_url;
    var imgObj_url = imgObj.img_url;
    var formdata = new FormData();
    var ctus = jQuery(this).data('us');
    var img_w = jQuery('#' + ctus + 'w').val();
    var img_h = jQuery('#' + ctus + 'h').val();
    var img_x1 = jQuery('#' + ctus + 'x1').val();
    var img_x2 = jQuery('#' + ctus + 'x2').val();
    var img_y1 = jQuery('#' + ctus + 'y1').val();
    var img_y2 = jQuery('#' + ctus + 'y2').val();
    var img_name = jQuery('#' + ctus + 'newname').val();
    var img_id = jQuery('#' + ctus + 'id').val();
    formdata.append("image", file_data);
    formdata.append("w", img_w);
    formdata.append("h", img_h);
    formdata.append("x1", img_x1);
    formdata.append("x2", img_x2);
    formdata.append("y1", img_y1);
    formdata.append("y2", img_y2);
    formdata.append("newname", img_name);
    formdata.append("img_id", img_id);
    formdata.append("check_for_logo_img", imageids);

    jQuery.ajax({
        url: ajax_url + "upload.php",
        type: "POST",
        data: formdata,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            jQuery('.ct-loading-main').hide();
            jQuery('#' + ctus + 'ctimagename').val(data);
            jQuery('.hidemodal').trigger('click');
            jQuery('#' + ctus + 'salonlogo').attr('src', imgObj_url + "services/" + data);
            jQuery('.error_image').hide();
            jQuery('#'+imageids).val('');
        }
    });
});


/* Change profile admin */
jQuery(document).on('click', '.mybtnadminprofile_save', function () {
	jQuery('.ct-loading-main').show();
    var adminid = jQuery(this).data('id');
    var oldpass = jQuery('#oldpass').val();
    var dboldpass = jQuery('#dboldpass').val();
    var newpass = jQuery('#newpass').val();
	
	 var old_email = jQuery('#inputEmailold').val();
        var new_email = jQuery('#inputEmail').val();

    jQuery('#admin_info_form').validate();
    jQuery("#adminfullname").rules("add",
        {
            required: true,
            messages: {required: errorobj_please_enter_fullname}
        });
    jQuery("#admincity").rules("add",
        {
            required: true,
            messages: {required: errorobj_please_enter_city}
        });
		 if(new_email!=old_email){    
    jQuery(".admin_inputEmail").rules("add",
        {
            required: true, email:true, remote: { url:ajax_url+"staff_ajax.php", type: "POST" },
            messages: {required: errorobj_please_enter_email, email:errorobj_please_enter_valid_email_address, remote:errorobj_email_already_exists }
        });
		 }
    jQuery("#adminstate").rules("add",
        {
            required: true,
            messages: {required: errorobj_please_enter_state}
        });
    jQuery("#admincountry").rules("add",
        {
            required: true,
            messages: {required: errorobj_please_enter_country}
        });
    jQuery("#adminzip").rules("add",
        {
            required: true,minlength : 3,maxlength : 7,
            messages: {required: errorobj_please_enter_zipcode,
			minlength: errorobj_please_enter_minimum_3_chars,
            maxlength: errorobj_please_enter_only_7_chars_maximum}
        });
    jQuery("#adminphone").rules("add",
        {
            required: true, pattern_phone: true, minlength: 12, maxlength: 15,
            messages: {
                required: errorobj_please_enter_phone_number,
                pattern_phone : errorobj_please_enter_valid_number_with_country_code,
                minlength: errorobj_please_enter_valid_number,
                maxlength: errorobj_please_enter_valid_number
            }
        });
    if (jQuery('.ct-change-password').is(':visible')) {
        jQuery("#oldpass").rules("add",
            {
                required: true, user_profile_pattern_password: true,
                messages: {required: errorobj_please_enter_old_password,minlength: errorobj_password_must_be_8_character_long}
            });
        jQuery("#newpass").rules("add",
            {
                required: true, user_profile_pattern_password: true,minlength: 8, maxlength: 20,
                messages: {required: errorobj_please_enter_new_password,minlength: errorobj_password_must_be_8_character_long,maxlength : errorobj_password_should_not_exist_more_then_20_characters}
            });
        jQuery("#retypenewpass").rules("add",
            {
                required: true, user_profile_pattern_password: true,minlength: 8, maxlength: 20,
                messages: {required: errorobj_please_enter_confirm_password,minlength: errorobj_password_must_be_8_character_long,maxlength : errorobj_password_should_not_exist_more_then_20_characters}
            });
    }



    if (!jQuery('#admin_info_form').valid()) {
		jQuery('.ct-loading-main').hide();
        return false;
    }
    jQuery.ajax({
        type: 'post',
        data: {
            'fullname': jQuery('#adminfullname').val(),
			'adminemail': jQuery('#inputEmail').val(),
            'phone': jQuery('#adminphone').val(),
            'address': jQuery('#adminaddress').val(),
            'city': jQuery('#admincity').val(),
            'state': jQuery('#adminstate').val(),
            'zip': jQuery('#adminzip').val(),
            'country': jQuery('#admincountry').val(),
            'dboldpassword' : jQuery('#dboldpass').val(),
            'oldpassword' : jQuery('#oldpass').val(),
            'newpassword' : jQuery('#newpass').val(),
            'retypepassword' : jQuery('#retypenewpass').val(),
            'id': adminid,
            'updatepass': 1
        },
        url: ajax_url + "admin_profile_ajax.php",
        success: function (res) {
		jQuery('.ct-loading-main').hide();
            if(jQuery.trim(res) == "sorry"){
                jQuery('.old_pass_msg').css('display','block');
                jQuery('.old_pass_msg').addClass('error');
                jQuery('.old_pass_msg').html(errorobj_your_old_password_incorrect);
            }
            else if(jQuery.trim(res) == "Please Retype Correct Password..."){
                jQuery('.retype_pass_msg').css('display','block');
                jQuery('.retype_pass_msg').addClass('error');
                jQuery('.retype_pass_msg').html(errorobj_please_retype_correct_password);
            }
            else{
                location.reload();
            }

        }
    });

});
/* Remove new passowrd and retype new password error after correct */
jQuery(document).on('click','.u_rp',function(){
    jQuery('.retype_pass_msg').hide();

});
/* Remove old password error after correct */
jQuery(document).on('click','.u_op',function(){
    jQuery('.old_pass_msg').hide();

});

/* Change profile USER */
jQuery(document).on('click', '.mybtnuserprofile_save', function () {
    var userid = jQuery(this).data('id');
    var oldpass = jQuery('#oldpass').val();
    var dboldpass = jQuery('#dboldpass').val();
	var zip_status_check = jQuery(this).data('zip');
    jQuery('#user_info_form').validate();
    jQuery("#userfirstname").rules("add",
        {
            required: true,
            messages: {required: errorobj_please_enter_firstname}
        });
    if (jQuery('.ct-change-password').is(':visible')) {
        jQuery("#useroldpass").rules("add",
            {
                required: true, user_profile_pattern_password: true,minlength: 8,
                messages: {required: errorobj_please_enter_old_password,minlength: errorobj_password_must_be_8_character_long}
            });
        jQuery("#usernewpasswrd").rules("add",
            {
                required: true, user_profile_pattern_password: true,minlength: 8, maxlength: 20,
                messages: {required: errorobj_please_enter_new_password,minlength: errorobj_password_must_be_8_character_long,maxlength : errorobj_password_should_not_exist_more_then_20_characters}
            });
        jQuery("#userrenewpasswrd").rules("add",
            {
                required: true, user_profile_pattern_password: true,minlength: 8, maxlength: 20,
                messages: {required: errorobj_please_enter_confirm_password,minlength: errorobj_password_must_be_8_character_long,maxlength : errorobj_password_should_not_exist_more_then_20_characters}
            });
    }
    jQuery("#userlastname").rules("add",
        {
            required: true,
            messages: {required: errorobj_please_enter_lastname}
        });

    jQuery("#usercity").rules("add",
        {
            required: true, 
            messages: {required: errorobj_please_enter_city}
        });
    jQuery("#userstate").rules("add",
        {
            required: true, 
            messages: {required: errorobj_please_enter_state}
        });
		if(zip_status_check == 'Y'){
			jQuery("#userzip").rules("add",
			{
				required: true, minlength: 3, maxlength: 7,
				messages: {required: errorobj_please_enter_zipcode,
				minlength: errorobj_please_enter_minimum_3_chars,
				maxlength: errorobj_please_enter_only_7_chars_maximum}
			});
		}
    
    jQuery("#userphone").rules("add",
        {
            required: true, pattern_phone: true, minlength: 12, maxlength: 15,
            messages: {
                required: errorobj_please_enter_phone_number,
                pattern_phone : errorobj_please_enter_valid_number_with_country_code,
                minlength: errorobj_please_enter_valid_number,
                maxlength: errorobj_please_enter_valid_number
            }
        });

    if (!jQuery('#user_info_form').valid()) {
        return false;
    }
	if(zip_status_check == 'Y'){
		var datastring={'firstname': jQuery('#userfirstname').val(),'lastname': jQuery('#userlastname').val(),'phone': jQuery('#userphone').val(),'address': jQuery('#useraddress').val(),  'city': jQuery('#usercity').val(),'state': jQuery('#userstate').val(),'zip': jQuery('#userzip').val(),'dboldpassword' : jQuery('#userdboldpass').val(),'oldpassword' : jQuery('#useroldpass').val(), 'newpassword' : jQuery('#usernewpasswrd').val(),'retypepassword' : jQuery('#userrenewpasswrd').val(),'id': userid,'updatepass': 1};	
	}
	else{
		var datastring={'firstname': jQuery('#userfirstname').val(),'lastname': jQuery('#userlastname').val(),'phone': jQuery('#userphone').val(),'address': jQuery('#useraddress').val(),  'city': jQuery('#usercity').val(),'state': jQuery('#userstate').val(),'dboldpassword' : jQuery('#userdboldpass').val(),'oldpassword' : jQuery('#useroldpass').val(), 'newpassword' : jQuery('#usernewpasswrd').val(),'retypepassword' : jQuery('#userrenewpasswrd').val(),'id': userid,'updatepass': 1};
	}
    jQuery.ajax({
        type: 'post',
        data: datastring,
        url: ajax_url + "user_details_ajax.php",
        success: function (res) {
            if(jQuery.trim(res) == "Your Old Password Incorrect..."){
                jQuery('.old_pass_msg').css('display','block');
                jQuery('.old_pass_msg').addClass('error');
                jQuery('.old_pass_msg').html(errorobj_your_old_password_incorrect+"...");
            }
            else if(jQuery.trim(res) == "Please Retype Correct Password..."){
                jQuery('.retype_pass_msg').css('display','block');
                jQuery('.retype_pass_msg').addClass('error');
                jQuery('.retype_pass_msg').html(errorobj_please_retype_correct_password+"...");
            }
            else{
                jQuery('.mainheader_message').show();
                jQuery('.mainheader_message_inner').css('display','inline');
                jQuery('#ct_sucess_message').html(errorobj_profile_updated_successfully);
                jQuery('.mainheader_message').fadeOut(3000);
                location.reload();
            }
        }
    });
});



/* Service Image delete */
jQuery(document).bind('ready ajaxComplete', function () {
    jQuery('.ser_del_icon').popover({
        html: true,
        content: function () {
            var deletepopup_id = jQuery(this).data('pclsid');
            return jQuery('#popover-ct-remove-service-imagepcls' + deletepopup_id).html();
        }
    });
});
jQuery(document).bind('ready ajaxComplete', function () {
    jQuery('.new_del_ser').popover({
        html: true,
        content: function () {
            var deleteimagepopup_id = jQuery(this).data('pclsid');
            return jQuery('#popover-ct-remove-service-imagepcls' + deleteimagepopup_id).html();
        }
    });
});
jQuery(document).on('click', '.delete_image', function () {
    var service_id = jQuery(this).data('service_id');
    var dataString = {service_id: service_id, action: 'delete_image'};
    var imgObj_url = imgObj.img_url;
    jQuery.ajax({
        type: "POST",
        url: ajax_url + "service_ajax.php",
        data: dataString,
        success: function (response) {
            jQuery('#pcls' + service_id + 'serviceimage').attr('src', imgObj_url + "services/default.png");
            jQuery('.ser_cam_btn' + service_id).addClass('show');
            jQuery('.ser_new_del' + service_id).removeClass('show');
            jQuery('.ser_new_del' + service_id).hide();
            jQuery('.del_btn_popup' + service_id).removeClass('show');
            jQuery('#pcls' + service_id + 'ctimagename').val("");
            jQuery('#ct-close-popover-service-image').trigger('click');
        }
    });
});
jQuery(document).ready(function () {
    jQuery('.new_cam_ser').hide();
    jQuery('.new_del_ser').hide();
});

/* Service Image delete */
jQuery(document).bind('ready ajaxComplete', function () {
    jQuery('.ser_del_icon').popover({
        html: true,
        content: function () {
            var deletepopup_id = jQuery(this).data('pclsid');
            return jQuery('#popover-ct-remove-service-imagepcls' + deletepopup_id).html();
        }
    });
});
jQuery(document).bind('ready ajaxComplete', function () {
    jQuery('.new_del_ser').popover({
        html: true,
        content: function () {
            var deleteimagepopup_id = jQuery(this).data('pclsid');
            return jQuery('#popover-ct-remove-service-imagepcls' + deleteimagepopup_id).html();
        }
    });
});
jQuery(document).on('click', '.delete_image', function () {
    var service_id = jQuery(this).data('service_id');
    var dataString = {service_id: service_id, action: 'delete_image'};
    var imgObj_url = imgObj.img_url;
    jQuery.ajax({
        type: "POST",
        url: ajax_url + "service_ajax.php",
        data: dataString,
        success: function (response) {
            jQuery('#pcls' + service_id + 'serviceimage').attr('src', imgObj_url + "services/default.png");
            jQuery('.ser_cam_btn' + service_id).addClass('show');
            jQuery('.ser_new_del' + service_id).removeClass('show');
            jQuery('.ser_new_del' + service_id).hide();
            jQuery('.del_btn_popup' + service_id).removeClass('show');
            jQuery('.del_btn_popup' + service_id).hide();
            jQuery('#pcls' + service_id + 'ctimagename').val("");
            jQuery('#ct-close-popover-service-image').trigger('click');
        }
    });
});
jQuery(document).ready(function () {
    jQuery('.new_cam_ser').hide();
    jQuery('.new_del_ser').hide();
});

/* Service Addons Image delete */
jQuery(document).bind('ready ajaxComplete', function () {
    jQuery('.addons_del_btn').popover({
        html: true,
        content: function () {
            var deletepopup_id = jQuery(this).data('pcaolid');
            return jQuery('#popover-ct-remove-service-addons-imagepcaol' + deletepopup_id).html();
        }
    });
});
jQuery(document).bind('ready ajaxComplete', function () {
    jQuery('.new_addons_del').popover({
        html: true,
        content: function () {
            var deleteimagepopup_id = jQuery(this).data('pcaolid');
            return jQuery('#popover-ct-remove-service-addons-imagepcaol' + deleteimagepopup_id).html();
        }
    });
});
jQuery(document).on('click', '.delete_image_addons', function () {
    var serviceaddons_id = jQuery(this).data('pcaolid');
    var dataString = {serviceaddons_id: serviceaddons_id, action: 'delete_image_addons'};
    var imgObj_url = imgObj.img_url;
    jQuery.ajax({
        type: "POST",
        url: ajax_url + "service_addons_ajax.php",
        data: dataString,
        success: function (response) {
            jQuery('#pcaol' + serviceaddons_id + 'addonimage').attr('src', imgObj_url + 'services/default.png');
            jQuery('.cam_btn_addon' + serviceaddons_id).addClass('show');
            jQuery('.addons_del_icon' + serviceaddons_id).removeClass('show');
            jQuery('.addons_del_icon' + serviceaddons_id).hide();
            jQuery('.del_btn_addon' + serviceaddons_id).removeClass('show');
            jQuery('#pcaol' + serviceaddons_id + 'ctimagename').val("");
            jQuery('#ct-close-popover-service-image').trigger('click');
        }
    });
});
jQuery(document).bind('ready ajaxComplete', function () {
    jQuery('.addon_ser_cam').hide();
    jQuery('.new_addons_del').hide();
});
jQuery(document).on('click', '#ct-close-popover-salon-logoctsi', function () {
    jQuery('.popover').fadeOut();
});

/* Setting Image delete */
jQuery(document).bind('ready ajaxComplete', function () {
    jQuery('.del_set_popup').popover({
        html: true,
        content: function () {
            return jQuery('#popover-ct-remove-company-logo-new').html();
        }
    });
});
jQuery(document).bind('ready ajaxComplete', function () {
    jQuery('.del_btn').popover({
        html: true,
        content: function () {
			/* var deleteimagepopup_id=jQuery(this).data('pcaolid'); */
            return jQuery('#popover-ct-remove-company-logo-new').html();
        }
    });
});
jQuery(document).on('click', '.delete_com_logo', function () {
    var optionname = jQuery(this).data('comp_id');
    var imgObj_url = imgObj.img_url;
    var dataString = {optionname: optionname, action: 'delete_logo'};
    jQuery.ajax({
        type: "POST",
        url: ajax_url + "setting_ajax.php",
        data: dataString,
        success: function (response) {
            jQuery('#ctsisalonlogo').attr('src', imgObj_url + '/company-logo.png');
            jQuery('.del_btn').hide();
            jQuery('.del_btn').removeClass('show');
            jQuery('#ct-remove-company-logo-new').hide();
            jQuery('#ct-remove-company-logo-new').removeClass('show');
            jQuery('.set_newcam_icon').addClass('show');
            jQuery('#ctsictimagename').val('');
            jQuery('#ct-close-popover-salon-logoctsi').trigger('click');
        }
    });
});
jQuery(document).ready(function () {
    jQuery('.set_newcam_icon').hide();
    jQuery('.del_btn').hide();
});


/*  Service Toggle  */
jQuery(document).on('change', '.ct-show-hide-checkbox', function () {
    var toggle_id = jQuery(this).attr('id');
    /*  uncheck other checkbox  */
    jQuery('.ct-show-hide-checkbox').each(function () {
        if (jQuery(this).attr('id') != toggle_id) {
            jQuery(this).removeAttr("checked");
        }
    });
    /*  Hide service details expect current  */
    jQuery('.service_detail').each(function () {
        if (jQuery(this).attr('id') != toggle_id) {
            jQuery(this).hide("blind", {direction: "vertical"}, 500);
        }
    });
    /*  Show current details and hide other ones  */
    if (jQuery(this).is(':checked')) {
        jQuery('#detail_' + toggle_id).show("blind", {direction: "vertical"}, 1000);
    } else {
        jQuery('#detail_' + toggle_id).hide("blind", {direction: "vertical"}, 500);
    }
	


});

/*  Addon's Toggle  */
jQuery(document).on('change', '.ct-show-hide-checkbox', function () {
    var toggles_id = jQuery(this).attr('id');
    /*  uncheck other checkbox  */
    jQuery('.ct-show-hide-checkbox').each(function () {
        if (jQuery(this).attr('id') != toggles_id) {
            jQuery(this).removeAttr("checked");
        }
    });

    /*  Hide service details expect current  */
    jQuery('.serviceaddon_detail').each(function () {
        if (jQuery(this).attr('id') != toggles_id) {
            jQuery(this).hide("blind", {direction: "vertical"}, 500);
        }
    });
    /*  Show current details and hide other ones  */
    if (jQuery(this).is(':checked')) {
        jQuery('#details_' + toggles_id).show("blind", {direction: "vertical"}, 1000);
    } else {
        jQuery('#details_' + toggles_id).hide("blind", {direction: "vertical"}, 500);
    }
});

/*  Method's Toggle  */
jQuery(document).on('change', '.ct-show-hide-checkbox', function () {
    var toggles_id = jQuery(this).attr('id');
    /*  uncheck other checkbox  */
    jQuery('.ct-show-hide-checkbox').each(function () {
        if (jQuery(this).attr('id') != toggles_id) {
            jQuery(this).removeAttr("checked");
        }
    });

    /*  Hide service details expect current  */
    jQuery('.servicemeth_details').each(function () {
        if (jQuery(this).attr('id') != toggles_id) {
            jQuery(this).hide("blind", {direction: "vertical"}, 500);
        }
    });
    /*  Show current details and hide other ones  */
    if (jQuery(this).is(':checked')) {
        jQuery('#detailmes_' + toggles_id).show("blind", {direction: "vertical"}, 1000);
    } else {
        jQuery('#detailmes_' + toggles_id).hide("blind", {direction: "vertical"}, 500);
    }
});

/*  Language Toggle  */
jQuery(document).on('change', '.ct-show-hide-checkbox', function () {
    var toggles_id = jQuery(this).attr('id');
    
    /*  Hide service details expect current  */
    jQuery('.language_detail').each(function () {
        if (jQuery(this).attr('id') != "detail_"+toggles_id) {
            jQuery(this).hide("blind", {direction: "vertical"}, 500);
		}
    });
	/*  uncheck other checkbox  */
    jQuery('.ct-show-hide-checkbox').each(function () {
        if (jQuery(this).attr('id') != toggles_id) {
            jQuery(this).removeAttr("checked");
        }
    });

    /*  Show current details and hide other ones  */
    if (jQuery(this).is(':checked')) {
        jQuery('#detail_' + toggles_id).show("blind", {direction: "vertical"}, 1000);
    } else {
        jQuery('#detail_' + toggles_id).hide("blind", {direction: "vertical"}, 500);
    }
});


jQuery(document).on('change','.endtimenew',function(){
    var endid=jQuery(this).attr('id');
    var wdid=jQuery(this).data('aid');

    var endval=jQuery(this).val();
    var startval=jQuery('#starttimenews_'+wdid).val();

    if(endval<startval){
        jQuery('.mainheader_message_fail').show();
        jQuery('.mainheader_message_inner_fail').css('display','inline');
        jQuery('#ct_sucess_message_fail').html(errorobj_please_select_end_time_greater_than_start_time);
        jQuery('.mainheader_message_fail').fadeOut(5000);
    }
});

jQuery(document).on('change','.starttimenew',function(){

    var endid=jQuery(this).attr('id');
    var wdid=jQuery(this).data('aid');
    var startval=jQuery('#starttimenew_'+wdid).val();
    var endval=jQuery('#endtimenews_'+wdid).val();


    if(endval>startval){
        jQuery('.mainheader_message_fail').show();
        jQuery('.mainheader_message_inner_fail').css('display','inline');
        jQuery('#ct_sucess_message_fail').html(errorobj_please_select_end_time_less_than_start_time);
        jQuery('.mainheader_message_fail').fadeOut(5000);
    }
});


/* FREQUENTLY DISCOUNT SETTINGS */
/* UPDATE STATUS */
jQuery(document).on('change', '.myfrequentlydiscount_status', function () {

    if (jQuery(this).prop("checked") == true) {
        var id = jQuery(this).data('id');
        jQuery('.ct-loading-main').show();
        jQuery.ajax({
            type: 'post',
            data: {
                id: id,
                changestatus: "E",
                freqdis : 1
            },
            url: ajax_url + "setting_ajax.php",
            success: function (res) {
                jQuery('.ct-loading-main').hide();
                jQuery('.ct-loading-main').hide();
                jQuery('.mainheader_message_inner').css('display','inline');
                jQuery('#ct_sucess_message').html(errorobj_frequently_discount_status_updated);
                jQuery('.mainheader_message').show();
                jQuery('.mainheader_message').fadeOut(5000);
            }
        });
    }
    else {
        var id = jQuery(this).data('id');
        jQuery('.ct-loading-main').show();
        jQuery.ajax({
            type: 'post',
            data: {
                id: id,
                changestatus: "D",
                freqdis : 1
            },
            url: ajax_url + "setting_ajax.php",
            success: function (res) {
                jQuery('.ct-loading-main').hide();
                jQuery('.ct-loading-main').hide();
                jQuery('.mainheader_message_inner').css('display','inline');
                jQuery('#ct_sucess_message').html(errorobj_frequently_discount_status_updated);
                jQuery('.mainheader_message').show();
                jQuery('.mainheader_message').fadeOut(5000);
            }
        });
    }
});


/* Update details */
jQuery(document).on('click','.btnupdatefrequently_discount',function(){
	jQuery('.ct-loading-main').show();
    var id = jQuery(this).data('id');
	var label  = jQuery('.txtfreqlabel'+id).val();
    var types  = jQuery('#txtfreqtype'+id).val();
    var values  = jQuery('.txtfreqvalue'+id).val();

    
	jQuery('#freq_discount_form'+id).validate();
    jQuery("#txtfreqvalueid" + id).rules("add",
        {
            required: true,pattern_price : true,
            messages: {required: errorobj_please_enter_valid_value_for_discount,pattern_price: errorobj_please_enter_valid_value_for_discount}
        });
	jQuery("#txtfreqlabel" + id).rules("add",
        {
            required: true,
            messages: {required: errorobj_please_enter_title}
        });
		
    if (!jQuery('#freq_discount_form'+id).valid()) {
        return false;
    }

    jQuery.ajax({
        type: 'post',
        data: {
            id: id,
            label: label,
            types: types,
            values: values,
            updatefreq: 1
        },
        url: ajax_url + "setting_ajax.php",
        success: function (res) {
            jQuery('.ct-loading-main').hide();
            jQuery('.mainheader_message_inner').css('display','inline');
            jQuery('#ct_sucess_message').html(errorobj_frequently_discount_updated);
            jQuery('.mainheader_message').show();
            jQuery('.mainheader_message').fadeOut(10000);
        }
    });
});

/* frequtently toggle close */
jQuery(document).on('change', '.ct-show-hide-checkbox', function () {
    var toggle_id = jQuery(this).attr('id');
    /*  uncheck other checkbox  */

    jQuery('.ct-show-hide-checkbox').each(function () {
        if (jQuery(this).attr('id') != toggle_id) {
            jQuery(this).removeAttr("checked");
        }
    });
    /*  Hide service details expect current  */
    jQuery('.fdd_details').each(function () {
        if (jQuery(this).attr('id') != toggle_id) {
            jQuery(this).hide("blind", {direction: "vertical"}, 500);
        }
    });
    /*  Show current details and hide other ones  */
    if (jQuery(this).is(':checked')) {
        jQuery('#detail' + toggle_id).show("blind", {direction: "vertical"}, 1000);
    } else {
        jQuery('#detail' + toggle_id).hide("blind", {direction: "vertical"}, 500);
    }
});
/* FREQUENTLY DISCOUNT SETTINGS END */

/*  phone number  */
jQuery(document).bind('ready ajaxComplete',function() {
	var site_url=site_ur.site_url;	
	var country_alpha_code = countrycodeObj.alphacode;
	var allowed_country_alpha_code = countrycodeObj.allowed;
	var array = allowed_country_alpha_code.split(',');
	if(allowed_country_alpha_code != ""){
		jQuery(".phone_number").intlTelInput({
			onlyCountries: array,
			autoPlaceholder: "off",
			utilsScript: site_url+"assets/js/utils.js"
		});
		jQuery(".selected-flag .iti-flag").addClass(country_alpha_code);
		jQuery(".selected-flag").attr("title",countrycodeObj.countrytitle);
	}
	else
	{
		jQuery(".phone_number").intlTelInput({
			autoPlaceholder: "off",
			utilsScript: site_url+"assets/js/utils.js"
		});
		jQuery(".selected-flag .iti-flag").addClass(country_alpha_code);
		jQuery(".selected-flag").attr("title",countrycodeObj.countrytitle);
	}
});


/*  client appointments cancel booking client front  */
/*  cancel booking popover  */
jQuery(document).ready(function(){
    jQuery('.cancel_appointment').popover({
        html : true,
        content: function() {
            var id = jQuery(this).data('id');
            return jQuery('#popover-user-cancel-appointment'+id).html();
        }
    });
});
/*  hide delete service popover  */
jQuery(document).on('click', '#ct-close-user-cancel-appointment', function(){
    jQuery('.popover').fadeOut();
});

/* DELETE THE ORDER FROM BOOKINGS */
jQuery(document).on('click','.mybtncancel_booking_user_details',function(e){
    var order = jQuery(this).data('id');
	var gc_event_id = jQuery(this).data('gc_event');
	var gc_staff_event_id = jQuery(this).data('gc_staff_event');
	var pid = jQuery(this).data('pid');
	var cancel_reson_book = jQuery('#reason_cancel' + order).val();
	if(check_update_if_btn == '0'){
		check_update_if_btn = '1';
		e.preventDefault();
		jQuery.ajax({
			type: "POST",
			data: {
				id: order,
				gc_event_id: gc_event_id,
				gc_staff_event_id: gc_staff_event_id,
				pid: pid,
				cancel_reson_book: cancel_reson_book,
				update_booking_users: 1
			},
			url: ajax_url + "user_details_ajax.php",
			success: function (response) {
				check_update_if_btn = '0';
				jQuery('.mainheader_message').show();
				jQuery('.mainheader_message_inner').css('display', 'inline');
				jQuery('#ct_sucess_message').text(errorobj_booking_cancel);
				jQuery('.mainheader_message').fadeOut(3000);
				jQuery('#info_modal_close').trigger('click');
				jQuery('#updateinfo_modal_close').trigger('click');
				jQuery('.closesss').trigger('click');
				location.reload();
			}
		});
	}
});

/*  user profile  */
jQuery(document).ready(function () {
    jQuery("#btn-change-pass").click(function () {
        jQuery(".ct-change-password").show( "blind", {direction: "vertical"}, 1000 );
        jQuery("#btn-change-pass").hide();
    });
});


jQuery(document).on("change",".exp_cp_date",function() {
    jQuery.ajax({
        type: 'post',
        data: {
            selected_dates: jQuery(this).val(),
			staff_id: jQuery(this).data('staffid'),
            getmytimeslots: 1
        },
        url: ajax_url + "user_details_ajax.php",
        success: function (res) {
            jQuery('.mytime_slots_booking').html(res);
			localStorage.setItem("time1",jQuery('#myuser_reschedule_time').val());
        }
    });
});

/* SET ORDER ID FOR UPDATE */
jQuery(document).on('click','.display_myappointment_data',function(){
    localStorage.setItem('order_id',jQuery(this).data('order_id'));
    var total = jQuery(this).data("total_price");
    jQuery('.booking_total_payment').html('<span class="">'+total+'</span>');
});

jQuery(document).on('change','#myuser_reschedule_time',function(){
    localStorage.setItem('time1',jQuery(this).val());
});
 localStorage.setItem('time1',"");
/* RESCHEDULE FOR USERPROFILE */

jQuery(document).on('click','.my_user_btn_for_reschedule',function(e){
	if(check_update_if_btn == '0'){
	check_update_if_btn = '1';
	e.preventDefault();
    var order = jQuery(this).data('order');
    var notes = jQuery('.my_user_notes_reschedule'+order).val();
    var dates = jQuery('#expiry_date'+order).val();
	var extension_js = jQuery('#extension_js').val();
	if(extension_js == 'true') {
		var gc_event_id = jQuery(this).data('gc_event');
		var gc_staff_event_id = jQuery(this).data('gc_staff_event');
		var pid = jQuery(this).data('pid');
	} else {
		var gc_event_id = '';
		var gc_staff_event_id = '';
		var pid = '';
	}
	var times1 = "";
    if(localStorage.getItem('time1') != ""){
        times1 =  localStorage.getItem('time1');
    }
	if(times1 == ""){
		check_update_if_btn = '0';
		jQuery('.close').trigger('click');
		jQuery('.mainheader_message_fail').show();
		jQuery('.mainheader_message_inner_fail').css('display', 'inline');
		jQuery('#ct_sucess_message_fail').text(errorobj_sorry_we_are_not_available);
		jQuery('.mainheader_message_fail').fadeOut(3000);
	}
	else{
		jQuery.ajax({
			type : 'post',
			data : {
				orderid : order,
				notes : notes,
				dates : dates,
				timess : times1,
				gc_event_id : gc_event_id,
				gc_staff_event_id : gc_staff_event_id,
				pid : pid,
				reschedulebooking : 1
			},
			url : ajax_url+"user_details_ajax.php",
			success : function(res){
				if(parseInt(jQuery.trim(res))==1)
				{
					jQuery('.close').trigger('click');
					jQuery('.mainheader_message').show();
					jQuery('.mainheader_message_inner').css('display', 'inline');
					jQuery('#ct_sucess_message').text(errorobj_appointment_reschedules_successfully);
					jQuery('.mainheader_message').fadeOut(3000);
					location.reload();
				}
				else
				{
					check_update_if_btn = '0';
					jQuery('.close').trigger('click');
					jQuery('.mainheader_message_fail').show();
					jQuery('.mainheader_message_inner_fail').css('display', 'inline');
					jQuery('#ct_sucess_message_fail').text(errorobj_sorry_we_are_not_available);
					jQuery('.mainheader_message_fail').fadeOut(3000);
				}
			}
		});
	}
	}
	
});

jQuery(document).ready(function(){

    jQuery.ajax({
        type : 'post',
        data: {
            check_for_option : 1
        },
        url : ajax_url+"admin_profile_ajax.php",
        success : function(res){
            if(jQuery.trim(res) != ""){
                jQuery('.check_options_left_toset').html(errorobj_please_fill_all_the_company_informations_and_add_some_services_and_addons);
                jQuery('.all_ok').hide();
            }
            else
            {
                jQuery('.necessary_option_check').hide();
                jQuery('.all_ok').show();
            }

        }
    });
});

/*  Add sample data  */
jQuery(document).on('click', '#ct-sample-data', function () {
	jQuery('.ct-loading-main').show();
    jQuery.ajax({
        type : 'post',
        data: { add_sample_data : 1 },
        url : ajax_url+"dummy_ajax.php",
        success : function(res){
            jQuery('.ct-loading-main').hide();
            location.reload();
        }
    });
});

/*  Remove sample data popup */
jQuery(document).on('click', '#ct-remove-sample-data', function () {
    jQuery('#ct-remove-sample-data-popup').modal('show');
});

/*  Remove sample data  */
jQuery(document).on('click', '#ct-remove-sample-data-ok', function () {
    jQuery('.ct-loading-main').show();
    jQuery.ajax({
        type : 'post',
        data: { remove_sample_data : 1 },
        url : ajax_url+"dummy_ajax.php",
        success : function(res){
            jQuery('.ct-loading-main').hide();
            location.reload();
        }
    });
});



jQuery(function(){
    jQuery(".error_postal_code").hide();
});


/*  Display Country Code on click flag on phone */
jQuery(document).on('click','.country',function() {
    var country_code=jQuery(this).data("dial-code");
    jQuery("#adminphone").val('+'+country_code);
});



/* ADMIN SMS TEMPLATE SETTINGS START */
jQuery(document).on('click','#save_sms_template',function() {
    var id = jQuery(this).data('id');
    var sms_message = jQuery('#sms_message_'+id).val();

    jQuery('#sms_template_form_'+id).validate({
        rules: {
            sms_message: {required: true}
        },
        messages: {
            sms_message: {required: errorobj_please_enter_sms_message}
        }
    });
    if (jQuery('#sms_template_form_'+id).valid()) {
        jQuery('.ct-loading-main').show();
        jQuery.ajax({
            type : 'post',
            data: { id : id, sms_messages : sms_message, save_sms_template : 1 },
            url : ajax_url+"sms_template_ajax.php",
            success : function(res){
                jQuery('.ct-loading-main').hide();
                jQuery('#cm'+id).trigger('click');
                jQuery('#as'+id).trigger('click');
            }
        });
    }
});
jQuery(document).on('change','.save_client_sms_template_status',function() {
    
	jQuery('.ct-loading-main').show();
    var ajax_url = settingObj.ajax_url;
    var id = jQuery(this).data('id');
    var client_status = jQuery('#sms-client'+id).prop("checked");
    if (client_status == true) {
        var sms_template_status = 'E';
    } else {
        var sms_template_status = 'D';
    }
	jQuery.ajax({
        type : 'post',
        data: { id : id, sms_template_status : sms_template_status, save_sms_template_status : 1 },
        url : ajax_url+"sms_template_ajax.php",
        success : function(res){
            jQuery('.ct-loading-main').hide();
        }
    });
});
jQuery(document).on('change','.save_admin_sms_template_status',function() {
    jQuery('.ct-loading-main').show();
    var ajax_url = settingObj.ajax_url;
    var id = jQuery(this).data('id');
    var admin_status = jQuery('#sms-admin'+id).prop("checked");
    if (admin_status == true) {
        var sms_template_status = 'E';
    } else {
        var sms_template_status = 'D';
    }
    jQuery.ajax({
        type : 'post',
        data: { id : id, sms_template_status : sms_template_status, save_sms_template_status : 1 },
        url : ajax_url+"sms_template_ajax.php",
        success : function(res){
            jQuery('.ct-loading-main').hide();
        }
    });
});

jQuery(document).on('change', '.ct_show_hide_checkbox', function () {
	var toggle_id = jQuery(this).data('id');
	/*  uncheck other checkbox  */
	jQuery('.ct_show_hide_checkbox').each(function () {
		if (jQuery(this).data('id') != toggle_id) {
			jQuery(this).removeAttr("checked");
		}
	});
	/*  Hide details expect current  */
	jQuery('.sms_content').each(function () {
		if (jQuery(this).attr('id') != "detail_sms_template_"+toggle_id) {
			jQuery(this).hide("blind", {direction: "vertical"}, 500);
		}
	});
	/*  Show current details and hide other ones  */
	if (jQuery(this).is(':checked')) {
		jQuery('.detail_cm' + toggle_id).show("blind", {direction: "vertical"}, 1000);
		jQuery('.detail_as' + toggle_id).show("blind", {direction: "vertical"}, 1000);
	} else {
		jQuery('.detail_cm' + toggle_id).hide("blind", {direction: "vertical"}, 500);
		jQuery('.detail_as' + toggle_id).hide("blind", {direction: "vertical"}, 500);
	}
});
/* ADMIN SMS TEMPLATE SETTINGS END */

/* **** email template code start **** */
jQuery(document).ready(function() {
	jQuery('.email_template_form').validate({
        rules: {
            email_message: {required: true}
        },
        messages: {
            email_message: {required: errorobj_please_enter_email_message}
        }
    });
});
/*
jQuery(document).on('click','#save_email_template',function() {
	var id = jQuery(this).data('id');
    var email_message = jQuery('#email_message_'+id).val();
	if (jQuery('.email_template_form').valid()) {
		jQuery('.ct-loading-main').show();
        jQuery.ajax({
			type : 'post',
			data: { id : id, email_message : email_message, save_email_template : 1 },
			url : ajax_url+"email_template_ajax.php",
			success : function(res){
				jQuery('.ct-loading-main').hide();
				jQuery('#ce'+id).trigger('click');
				jQuery('#ae'+id).trigger('click');
			}
		});
	}
});
*/
jQuery(document).on('change','.save_client_email_template_status',function() {
	jQuery('.ct-loading-main').show();
	var id = jQuery(this).data('id');
	var client_status = jQuery('#email-client'+id).prop("checked");
	if (client_status == true) {
		var email_template_status = 'E';
	} else {
		var email_template_status = 'D';
	}	
	jQuery.ajax({
		type : 'post',
		data: { id : id, email_template_status : email_template_status, save_email_template_status : 1 },
		url : ajax_url+"email_template_ajax.php",
		success : function(res){
			jQuery('.ct-loading-main').hide();
		}
	});
});
jQuery(document).on('change','.save_admin_email_template_status',function() {
	jQuery('.ct-loading-main').show();
	var id = jQuery(this).data('id');
	var admin_status = jQuery('#email-admin'+id).prop("checked");
	if (admin_status == true) {
		var email_template_status = 'E';
	} else {
		var email_template_status = 'D';
	}	
	jQuery.ajax({
		type : 'post',
		data: { id : id, email_template_status : email_template_status, save_email_template_status : 1 },
		url : ajax_url+"email_template_ajax.php",
		success : function(res){
			jQuery('.ct-loading-main').hide();
		}
	});
});
jQuery(document).on('change','.save_staff_email_template_status',function() {
	jQuery('.ct-loading-main').show();
	var id = jQuery(this).data('id');
	var admin_status = jQuery('#email-staff'+id).prop("checked");
	if (admin_status == true) {
		var email_template_status = 'E';
	} else {
		var email_template_status = 'D';
	}	
	jQuery.ajax({
		type : 'post',
		data: { id : id, email_template_status : email_template_status, save_email_template_status : 1 },
		url : ajax_url+"email_template_ajax.php",
		success : function(res){
			jQuery('.ct-loading-main').hide();
		}
	});
});
jQuery(document).on('change', '.ct_open_close_email_template', function () {
	var toggle_id = jQuery(this).data('id');
	
	/*  uncheck other checkbox  */
	jQuery('.ct_open_close_email_template').each(function () {
		if (jQuery(this).data('id') != toggle_id) {
			jQuery(this).removeAttr("checked");
		}
	});
	/*  Hide details expect current  */
	jQuery('.email_content').each(function () {
		if (jQuery(this).attr('id') != "detail_email_templates_"+toggle_id) {
			jQuery(this).hide("blind", {direction: "vertical"}, 500);
		}
	});
	/*  Show current details and hide other ones  */
	if (jQuery(this).is(':checked')) {
		jQuery('.detail_ce' + toggle_id).show("blind", {direction: "vertical"}, 1000);
		jQuery('.detail_ae' + toggle_id).show("blind", {direction: "vertical"}, 1000);
	} else {
		jQuery('.detail_ce' + toggle_id).hide("blind", {direction: "vertical"}, 500);
		jQuery('.detail_ae' + toggle_id).hide("blind", {direction: "vertical"}, 500);
	}
});
/* **** email template code end **** */

/* SAVE EMAIL AND SMS TEMPLATE IN DB */
jQuery(document).on('click','#default_email_contents',function() {
    var id = jQuery(this).data('id');
    jQuery('.ct-loading-main').show();
    jQuery.ajax({
        type : 'post',
        data: { id : id, default_email_content : 1 },
        url : ajax_url+"email_template_ajax.php",
        success : function(res){
            jQuery('.ct-loading-main').hide();
            jQuery("#email_message_"+id).val(res);
        }
    });
});
jQuery(document).on('click','.email_short_tags',function() {
    var id = jQuery(this).data('id');
    var val = jQuery(this).data('value');

    jQuery("#email_message_"+id).each(function(i) {
        if (document.selection) {
            /* For browsers like Internet Explorer */
            this.focus();
            sel = document.selection.createRange();
            sel.text = val;
            this.focus();
        } else if (this.selectionStart || this.selectionStart == '0') {
            /* For browsers like Firefox and Webkit based */
            var startPos = this.selectionStart;
            var endPos = this.selectionEnd;
            var scrollTop = this.scrollTop;
            this.value = this.value.substring(0, startPos) + val + this.value.substring(endPos, this.value.length);
            this.focus();
            this.selectionStart = startPos + val.length;
            this.selectionEnd = startPos + val.length;
            this.scrollTop = scrollTop;
        } else {
            this.value += val;
            this.focus();
        }
    })
});
jQuery(document).on('click','#default_sms_contents',function() {
    var id = jQuery(this).data('id');
    jQuery('.ct-loading-main').show();
    jQuery.ajax({
        type : 'post',
        data: { id : id, default_sms_content : 1 },
        url : ajax_url+"sms_template_ajax.php",
        success : function(res){
            jQuery('.ct-loading-main').hide();
            jQuery("#sms_message_"+id).val(res);
        }
    });
});
jQuery(document).on('click','.sms_short_tags',function() {
    var id = jQuery(this).data('id');
    var val = jQuery(this).data('value');

    jQuery("#sms_message_"+id).each(function(i) {
        if (document.selection) {
            /* For browsers like Internet Explorer */
            this.focus();
            sel = document.selection.createRange();
            sel.text = val;
            this.focus();
        } else if (this.selectionStart || this.selectionStart == '0') {
            /* For browsers like Firefox and Webkit based */
            var startPos = this.selectionStart;
            var endPos = this.selectionEnd;
            var scrollTop = this.scrollTop;
            this.value = this.value.substring(0, startPos) + val + this.value.substring(endPos, this.value.length);
            this.focus();
            this.selectionStart = startPos + val.length;
            this.selectionEnd = startPos + val.length;
            this.scrollTop = scrollTop;
        } else {
            this.value += val;
            this.focus();
        }
    })
});
/* SAVE EMAIL AND SMS TEMPLATE IN DB END */
/* DELETE THE BOOKINGS OF THE REGISTERED CUSTOMERS FROM CUSTOMER PAGE */
jQuery(document).on('click', '.mybtndelete_register_customers_entry', function () {
	jQuery('.ct-loading-main').show();
	var usersid = jQuery(this).data('id');
	jQuery.ajax({
		type: 'post',
		data: {
			delete_registered_bookings: 1,
			usersid: usersid
		},
		url: ajax_url + "customer_admin_ajax.php",
		success: function (res) {
			jQuery('.ct-loading-main').hide();
			jQuery('#ct-close-popover-customerss').trigger("click");
			jQuery('#myregisted_' + usersid).remove();
			jQuery('.mainheader_message').show();
			jQuery('.mainheader_message_inner').css('display', 'inline');
			jQuery('#ct_sucess_message').text(errorobj_customer_deleted_successfully);
			jQuery('.mainheader_message').fadeOut(3000);
			window.location.reload();
		}
	}); 
});
jQuery(document).ready(function () {
    jQuery('[data-toggle="popover"]').popover({
        placement: 'left',
        html: true,
        content: function () {
            return jQuery(this).next('#popover-delete-customerss').html();
        }
    });
});
/*  hide delete service popover  */
jQuery(document).on('click', '#ct-close-popover-customerss', function () {
    jQuery('.popover').fadeOut();
});

jQuery(document).on("click","#loginbg",function(){
	var ajax_url = settingObj.ajax_url;	
	jQuery.ajax({
		type:"POST",
		url: ajax_url +"setting_ajax.php",
		data:{action:"delete_login_image"},
		success:function(){
		
		}
	});
});
jQuery(document).on("click","#frontbg",function(){
	var ajax_url = settingObj.ajax_url;	
	jQuery.ajax({
		type:"POST",
		url: ajax_url +"setting_ajax.php",
		data:{action:"delete_front_imge"},
		success:function(){			
		}
	});
});
jQuery(document).on('click', '.appearance_settings_btn_check', function(e){
	jQuery('.ct-loading-main').show();
	if(jQuery('#existing-and-new-user-checkout').prop("checked") === false && jQuery('#guest-user-checkout').prop("checked") === false){
		jQuery('.ct-loading-main').hide();
		jQuery('.mainheader_message_fail_appearance_setting').show();
		jQuery('.mainheader_message_inner_fail_appearance_setting').css('display', 'block');
		jQuery('#ct_sucess_message_fail_appearance_setting').text(errorobj_please_select_atleast_one_checkout_method);
		jQuery('.mainheader_message_fail_appearance_setting').fadeOut(5000);
		e.preventDefault();
	}
});

/* service form reset */
jQuery(document).on('click','#reset_service_form',function(){
	jQuery("#addservice_form")[0].reset();
	var img_url=imgObj.img_url;
	var color_reset = jQuery('#ct-service-color-tag').val();
	jQuery("#pcasctimagename").attr('value','');
	jQuery("#pcasserviceimage").attr('src',img_url+'default_service.png');
	jQuery('.minicolors-swatch-color').css('background-color',color_reset);
});

/* Service addons reset*/
jQuery(document).on('click','#reset_service_addons',function(){
	jQuery("#mynewformfor_insertaddons")[0].reset();
	 var img_url=imgObj.img_url;
	
	 jQuery("#pcaoctimagename").attr('value','');
	 jQuery("#pcaoaddonimage").attr('src',img_url+'default_service.png');
	
});
jQuery(document).on('click','.save_manage_form_fields',function(){
	jQuery('.ct-loading-main').show();
	var show_coupon_checkout = jQuery('#show-coupons-input-oc').prop("checked");
    if (show_coupon_checkout == true) {
        var coupon_checkout = 'on';
    } else {
        var coupon_checkout = 'off';
    }
	var company_header = jQuery('#Show_comapny_address').prop("checked");
	if (company_header == true) {
		var company_header_address = 'Y';
	} else {
		var company_header_address = 'N';
	}
	var appointment_details = jQuery('#hide_appoint_details').prop("checked");
	if (appointment_details == true) {
		var appointment_details_display = 'on';
	} else {
		var appointment_details_display = 'off';
	}
	var company_logo_status = jQuery('#show_company_logo').prop("checked");
	if (company_logo_status == true) {
		var company_logo_display = 'Y';
	} else {
		var company_logo_display = 'N';
	}
	var company_title_status = jQuery('#show_company_title').prop("checked");
	if (company_title_status == true) {
		var company_title_display = 'Y';
	} else {
		var company_title_display = 'N';
	}
	var company_service_desc = jQuery('#show_desc_front').prop("checked");
	if (company_service_desc == true) {
		var company_service_desc_status = 'Y';
	} else {
		var company_service_desc_status = 'N';
	}
	var company_willwe_getin = jQuery('#show_how_willwe_getin_front').prop("checked");
	if (company_willwe_getin == true) {
		var company_willwe_getin_status = 'Y';
	} else {
		var company_willwe_getin_status = 'N';
	}
	
	var ct_subheaders = jQuery('#ct_subheaders').prop("checked");
    if (ct_subheaders == true) {
        var ct_subheaders = 'Y';
    } else {
        var ct_subheaders = 'N';
    }
	var front_lang_dd = jQuery('#front_lang_dd').prop("checked");
    if (front_lang_dd == true) {
        var front_lang_dd = 'Y';
    } else {
        var front_lang_dd = 'N';
    }
	
	var ct_vc_status_ch = jQuery('#ct_vc_status').prop("checked");
    if (ct_vc_status_ch == true) {
        var ct_vc_status = 'Y';
    } else {
        var ct_vc_status = 'N';
    }
	
	var ct_p_status_ch = jQuery('#ct_p_status').prop("checked");
    if (ct_p_status_ch == true) {
        var ct_p_status = 'Y';
    } else {
        var ct_p_status = 'N';
    }
											 
	/* form fields */
	var preferred_password_min = jQuery('.pass_min').val();
	var preferred_password_max = jQuery('.pass_max').val();
	var ct_bf_first_name_1 = jQuery('#ct_bf_first_name_1').prop("checked");
    if (ct_bf_first_name_1 == true) {
        var ct_bf_first_name_1 = 'on';
    } else {
        var ct_bf_first_name_1 = 'off';
    }
	var ct_bf_first_name_2 = jQuery('#ct_bf_first_name_2').prop("checked");
    if (ct_bf_first_name_2 == true) {
        var ct_bf_first_name_2 = 'Y';
    } else {
        var ct_bf_first_name_2 = 'N';
    }
	var ct_bf_first_name_3 =  jQuery('.fname_min').val();
	var ct_bf_first_name_4 =  jQuery('.fname_max').val();
	
	var ct_bf_last_name_1 = jQuery('#cff_last_name_1').prop("checked");
    if (ct_bf_last_name_1 == true) {
        var ct_bf_last_name_1 = 'on';
    } else {
        var ct_bf_last_name_1 = 'off';
    }
	var ct_bf_last_name_2 = jQuery('#cff_last_name_2').prop("checked");
    if (ct_bf_last_name_2 == true) {
        var ct_bf_last_name_2 = 'Y';
    } else {
        var ct_bf_last_name_2 = 'N';
    }
	var ct_bf_last_name_3 =  jQuery('.lname_min').val();
	var ct_bf_last_name_4 =  jQuery('.lname_max').val();
	
	var ct_bf_phone_1 = jQuery('#cff_phone_1').prop("checked");
    if (ct_bf_phone_1 == true) {
        var ct_bf_phone_1 = 'on';
    } else {
        var ct_bf_phone_1 = 'off';
    }
	var ct_bf_phone_2 = jQuery('#cff_phone_2').prop("checked");
    if (ct_bf_phone_2 == true) {
        var ct_bf_phone_2 = 'Y';
    } else {
        var ct_bf_phone_2 = 'N';
    }
	var ct_bf_phone_3 =  jQuery('.phone_min').val();
	var ct_bf_phone_4 =  jQuery('.phone_max').val();
	
	var ct_bf_address_1 = jQuery('#cff_street_address_1').prop("checked");
    if (ct_bf_address_1 == true) {
        var ct_bf_address_1 = 'on';
    } else {
        var ct_bf_address_1 = 'off';
    }
	var ct_bf_address_2 = jQuery('#cff_street_address_2').prop("checked");
    if (ct_bf_address_2 == true) {
        var ct_bf_address_2 = 'Y';
    } else {
        var ct_bf_address_2 = 'N';
    }
	var ct_bf_address_3 =  jQuery('.street_address_min').val();
	var ct_bf_address_4 =  jQuery('.street_address_max').val();
	
	var ct_bf_zip_1 = jQuery('#cff_zip_code_1').prop("checked");
    if (ct_bf_zip_1 == true) {
        var ct_bf_zip_1 = 'on';
    } else {
        var ct_bf_zip_1 = 'off';
    }
	var ct_bf_zip_2 = jQuery('#cff_zip_code_2').prop("checked");
    if (ct_bf_zip_2 == true) {
        var ct_bf_zip_2 = 'Y';
    } else {
        var ct_bf_zip_2 = 'N';
    }
	var ct_bf_zip_3 =  jQuery('.zip_code_min').val();
	var ct_bf_zip_4 =  jQuery('.zip_code_max').val();
	
	var ct_bf_city_1 = jQuery('#cff_city_1').prop("checked");
    if (ct_bf_city_1 == true) {
        var ct_bf_city_1 = 'on';
    } else {
        var ct_bf_city_1 = 'off';
    }
	var ct_bf_city_2 = jQuery('#cff_city_2').prop("checked");
    if (ct_bf_city_2 == true) {
        var ct_bf_city_2 = 'Y';
    } else {
        var ct_bf_city_2 = 'N';
    }
	var ct_bf_city_3 =  jQuery('.city_min').val();
	var ct_bf_city_4 =  jQuery('.city_max').val();
	/* STATES */
	var ct_bf_state_1 = jQuery('#cff_state_1').prop("checked");
    if (ct_bf_state_1 == true) {
        var ct_bf_state_1 = 'on';
    } else {
        var ct_bf_state_1 = 'off';
    }
	var ct_bf_state_2 = jQuery('#cff_state_2').prop("checked");
    if (ct_bf_state_2 == true) {
        var ct_bf_state_2 = 'Y';
    } else {
        var ct_bf_state_2 = 'N';
    }
	var ct_bf_state_3 =  jQuery('.state_min').val();
	var ct_bf_state_4 =  jQuery('.state_max').val();
	
	/* NOTES */
	var ct_bf_notes_1 = jQuery('#cff_notes_1').prop("checked");
    if (ct_bf_notes_1 == true) {
        var ct_bf_notes_1 = 'on';
    } else {
        var ct_bf_notes_1 = 'off';
    }
	var ct_bf_notes_2 = jQuery('#cff_notes_2').prop("checked");
    if (ct_bf_notes_2 == true) {
        var ct_bf_notes_2 = 'Y';
    } else {
        var ct_bf_notes_2 = 'N';
    }
	var ct_bf_notes_3 =  jQuery('.notes_min').val();
	var ct_bf_notes_4 =  jQuery('.notes_max').val();
	
	
	/* form fields */
	var dataString = {
        coupon_checkout : coupon_checkout,
		company_header_address : company_header_address,
		company_logo_display : company_logo_display,
		company_title_display : company_title_display,
		company_service_desc_status : company_service_desc_status,
		appointment_details_display : appointment_details_display,
		company_willwe_getin_status : company_willwe_getin_status,
		ct_subheaders : ct_subheaders,
		ct_vc_status : ct_vc_status,
		ct_p_status : ct_p_status,
		ct_bf_notes_1 : ct_bf_notes_1,
		ct_bf_notes_2 : ct_bf_notes_2,
		ct_bf_notes_3 : ct_bf_notes_3,
		ct_bf_notes_4 : ct_bf_notes_4,
		ct_bf_first_name_1 : ct_bf_first_name_1,
		ct_bf_first_name_2 : ct_bf_first_name_2,
		ct_bf_first_name_3 : ct_bf_first_name_3,
		ct_bf_first_name_4 : ct_bf_first_name_4,
		ct_bf_last_name_1 : ct_bf_last_name_1,
		ct_bf_last_name_2 : ct_bf_last_name_2,
		ct_bf_last_name_3 : ct_bf_last_name_3,
		ct_bf_last_name_4 : ct_bf_last_name_4,
		ct_bf_phone_1 : ct_bf_phone_1,
		ct_bf_phone_2 : ct_bf_phone_2,
		ct_bf_phone_3 : ct_bf_phone_3,
		ct_bf_phone_4 : ct_bf_phone_4,
		ct_bf_address_1 : ct_bf_address_1,
		ct_bf_address_2 : ct_bf_address_2,
		ct_bf_address_3 : ct_bf_address_3,
		ct_bf_address_4 : ct_bf_address_4,
		ct_bf_zip_1 : ct_bf_zip_1,
		ct_bf_zip_2 : ct_bf_zip_2,
		ct_bf_zip_3 : ct_bf_zip_3,
		ct_bf_zip_4 : ct_bf_zip_4,
		ct_bf_city_1 : ct_bf_city_1,
		ct_bf_city_2 : ct_bf_city_2,
		ct_bf_city_3 : ct_bf_city_3,
		ct_bf_city_4 : ct_bf_city_4,
		ct_bf_state_1 : ct_bf_state_1,
		ct_bf_state_2 : ct_bf_state_2,
		ct_bf_state_3 : ct_bf_state_3,
		ct_bf_state_4 : ct_bf_state_4,
		front_lang_dd : front_lang_dd,
		preferred_password_min : preferred_password_min,
		preferred_password_max : preferred_password_max,
		"manage_form_fields_setting" : "yes"
    };
	var check_status = 0;
	jQuery('.v_c').each(function(){
		var fors = jQuery(this).data('names');
		if(parseInt(jQuery(this).val()) > parseInt(jQuery('.v_c_'+fors).val())){
			jQuery(this).css("border-color","red");
			jQuery('.v_c_'+fors).css("border-color","red");
			check_status = check_status+1;
		}
	});
	if(check_status == 0){
		jQuery.ajax({
			type: "POST",
			url: ajax_url + "setting_ajax.php",
			data: dataString,
			success: function (response) 
			{
				jQuery('.ct-loading-main').hide();
			}
		});
	}
	else{
		jQuery('.mainheader_message_fail').show();
        jQuery('.mainheader_message_inner_fail').css('display','inline');
		jQuery('#ct_sucess_message_fail').html(errorobj_invalid_values);
        jQuery('.mainheader_message_fail').fadeOut(5000);
		jQuery('.ct-loading-main').hide();
	}	
});
jQuery(document).on('click','.save_staff',function(){
	/*
	var email = jQuery('.staff_email').val();
	var name = jQuery('.staff_name').val();
	var role = "staff";
	if(jQuery('#staff_insert').valid()){
	jQuery.ajax({
		type : 'POST',
		data : {'email':email,'name' : name,'role':role,'staff_add' : 'add'},
		url : ajax_url + "staff_ajax.php",
		success : function(res){
			location.reload();
		}
	});
	}*/
	var email = jQuery('.staff_email').val();
	var name = jQuery('.staff_name').val();
	var pass = jQuery('.staff_pass').val();
	var role = "staff";
	if (!jQuery('#staff_insert').valid()) {
		return false;
    }
	if(jQuery('#staff_insert').valid()){
		jQuery.ajax({
			type : 'POST',
			data : {'email':email,'pass' : pass,'name' : name,'role':role,'staff_add' : 'add'},
			url : ajax_url + "staff_ajax.php",
			success : function(res){
				location.reload();
			}
		});
	}
});
/*validation  for staff insert form*/
jQuery(document).ready(function(){
	
	jQuery('#staff_insert').validate({
		rules: {
			staff_email:{
				required: true,
				email:true,
				remote: {
					url:ajax_url+"staff_ajax.php",
					type: "POST"
				}
			},
			staff_name: {
				required:true,
			},
			staff_pass: {
				required:true,
				minlength: 8,
				maxlength: 15
			},
		},
		messages: {
			staff_email:{
			required:errorobj_please_enter_email,email:errorobj_please_enter_valid_email_address,remote:errorobj_email_already_exists 
			},
			staff_name: {
			required: errorobj_please_enter_name,
			},
			staff_pass: {
			required: errorobj_please_enter_password,
			min: errorobj_please_enter_minimum_8_characters,
			max: errorobj_please_enter_maximum_15_characters,
			},
		}
	});
});

jQuery(document).ready(function(){
	jQuery('.staff_1').trigger("click");
});
jQuery(document).on('click','.staff_click',function(){
	jQuery('.ct-loading-main').show();
	var staff_id = jQuery(this).data('id');
	jQuery.ajax({
		type : 'POST',
		data : {'staff_id' : staff_id,'staff_detail' : 'yes'},
		url : ajax_url + "staff_ajax.php",
		success : function(res){
			jQuery('.get_staff_details').html(res);
		}
	});
	jQuery('.ct-loading-main').hide();
});

/* staff availability time */
/* UPDATE ALL ENTRY OF THE MONTHLY SCHEDULE */
jQuery(document).on('click', '.btnupdatenewtimeslots_monthly_staff', function () {
	jQuery('.ct-loading-main').show();
    var starttimenew = [];
    var endtimenew = [];
    var chkdaynew = [];
	var staff_id = jQuery(this).data('id');
    jQuery('.chkdaynew').each(function () {
        if (jQuery(this).prop("checked") == true) {
            chkdaynew.push('N');
        } else {
            chkdaynew.push('Y');
        }
    });
    jQuery('.starttimenew').each(function () {
        starttimenew.push(jQuery(this).val());
    });
    jQuery('.endtimenew').each(function () {
        endtimenew.push(jQuery(this).val());
    });

    var st = starttimenew.filter(function (v) {
        return v !== ''
    });
    var et = endtimenew.filter(function (v) {
        return v !== ''
    });
    var s = 1;
    for(var i = 0;i<=starttimenew.length;i++){
        if(starttimenew[i] > endtimenew[i]){
            s++;
        }
    }
    if(s>1){
        jQuery('.mainheader_message_fail').show();
        jQuery('.mainheader_message_inner_fail').css('display','inline');
		jQuery('#ct_sucess_message_fail').html(errorobj_please_select_porper_time_slots);
        jQuery('.mainheader_message_fail').fadeOut(5000);
		jQuery('.ct-loading-main').hide();
    }
    else{
        jQuery.ajax({
            type: 'post',
            data: {
                'chkday': chkdaynew,
                'starttime': st,
                'endtime': et,
				'staff_id' : staff_id,
                'operation_insertmonthlyslots_staff': 1
            },
            url: ajax_url + "weekday_ajax.php",
            success: function (res) {
				jQuery('.ct-loading-main').hide();
                jQuery('.mainheader_message').show();
                jQuery('.mainheader_message_inner').css('display', 'inline');
                jQuery('#ct_sucess_message').text(errorobj_time_slots_updated_successfully);
                jQuery('.mainheader_message').fadeOut(3000);
                location.reload();
            }
        });
    }
});

/* staff availability time */
jQuery(document).ready(function(){
	if(localStorage['trigger_user'] != ""){
		jQuery('.staff_c_'+localStorage['trigger_user']).trigger("click");
	}
	else{
		jQuery('.staff_1').trigger("click"); 
	}
});
jQuery(document).on('click','.staff_link_clicked',function(){
	localStorage['trigger_user'] = "";
});
/*update staff details*/
jQuery(document).on('click','#update_staff_details',function(){
	if(jQuery('#staff_update_details').valid()){
		jQuery('.ct-loading-main').show();
		var id = jQuery(this).data('id');
		localStorage['trigger_user'] = id;
		var name = jQuery('#ct-member-name').val();
		var email = jQuery('#ct-member-email').val();
		var desc = jQuery('#ct-member-desc').val();
		var phone = jQuery('#phone-number').val();
		var address = jQuery('#ct-member-address').val();
		/** var staff_role = jQuery('#ct-staff-role').val();
		var staff_schedule = jQuery('#schedule-type1').prop("checked");
		if (staff_schedule == true) {
			staff_schedule = "M";
		} else {
			staff_schedule = "W";
		} **/
		
		var staff_booking = jQuery('#enable-booking1').prop("checked");
		if (staff_booking == true) {
			staff_booking = "Y";
		} else {
			staff_booking = "N";
		}
		
		var city = jQuery('#ct-member-city').val();
		var state = jQuery('#ct-member-state').val();
		var zip = jQuery('#ct-member-zip').val();
		var country = jQuery('#ct-member-country').val();
		/** var service_commission_val = jQuery('input[name="ser_comm_check"]:checked').data('type');
		var commission = jQuery('.s_v_'+service_commission_val).val(); **/
		var old_schedule = jQuery(this).data("old_schedule_type");
		var staff_image = jQuery("#pppp"+id+"ctimagename").val();
		
		jQuery.ajax({
			type : 'POST',
			/** data : {'id':id,'name' : name,'email':email,'desc':desc,'phone':phone,'address':address,'staff_role':staff_role,'staff_schedule':staff_schedule,'staff_booking':staff_booking,'city':city,'state':state,'zip':zip,'country':country,'service_commission':service_commission_val,'commission':commission,'staff_update' : 'update',"old_schedule" : old_schedule,"staff_image": staff_image}, **/
			data : {'id':id,'name' : name,'email':email,'desc':desc,'phone':phone,'address':address,'staff_booking':staff_booking,'city':city,'state':state,'zip':zip,'country':country,'staff_update' : 'update',"old_schedule" : old_schedule,"staff_image": staff_image},
			url : ajax_url + "staff_ajax.php",
			success : function(res){
				jQuery('.ct-loading-main').hide();
			location.reload();
			}
		});
	}
});

/*update staff details*/
jQuery(document).on('click','#update_staff_details_staffsection',function(){
	if(jQuery('#staff_update_details').valid()){
		jQuery('.ct-loading-main').show();
		var id = jQuery(this).data('id');
		localStorage['trigger_user'] = id;
		var name = jQuery('#ct-member-name').val();
		var email = jQuery('#ct-member-email').val();
		var desc = jQuery('#ct-member-desc').val();
		var phone = jQuery('#phone-number').val();
		var address = jQuery('#ct-member-address').val();
		var ct_service_staff = jQuery('#ct_service_staff').val();

		/** var staff_role = jQuery('#ct-staff-role').val();
		var staff_schedule = jQuery('#schedule-type1').prop("checked");
		if (staff_schedule == true) {
			staff_schedule = "M";
		} else {
			staff_schedule = "W";
		} **/
		
		var staff_booking = jQuery('#enable-booking1').prop("checked");
		if (staff_booking == true) {
			staff_booking = "Y";
		} else {
			staff_booking = "N";
		}
		
		var city = jQuery('#ct-member-city').val();
		var state = jQuery('#ct-member-state').val();
		var zip = jQuery('#ct-member-zip').val();
		var country = jQuery('#ct-member-country').val();
		/** var service_commission_val = jQuery('input[name="ser_comm_check"]:checked').data('type');
		var commission = jQuery('.s_v_'+service_commission_val).val(); **/
		var old_schedule = jQuery(this).data("old_schedule_type");
		var staff_image = jQuery("#pppp"+id+"ctimagename").val();
		
		jQuery.ajax({
			type : 'POST',
			/** data : {'id':id,'name' : name,'email':email,'desc':desc,'phone':phone,'address':address,'staff_role':staff_role,'staff_schedule':staff_schedule,'staff_booking':staff_booking,'city':city,'state':state,'zip':zip,'country':country,'service_commission':service_commission_val,'commission':commission,'staff_update' : 'update',"old_schedule" : old_schedule,"staff_image": staff_image}, **/
			data : {'id':id,'name' : name,'email':email,'desc':desc,'phone':phone,'address':address,'staff_booking':staff_booking,'city':city,'state':state,'zip':zip,'country':country,'staff_update' : 'update',"old_schedule" : old_schedule,"staff_image": staff_image,"ct_service_staff":ct_service_staff},
			url : ajax_url + "staff_ajax.php",
			success : function(res){
			jQuery('.ct-loading-main').hide();
			location.reload();
			}
		});
	}
});

/*validation  for staff insert form*/
jQuery(document).ajaxComplete(function(){
	jQuery('#staff_update_details').validate({
		rules: {
			u_member_email:{
				required: true,
				email:true,
				remote: {
					url:ajax_url+"staff_ajax.php",
					type: "POST"
				}
			},
			u_member_name: {
				required:true,
			},
		},
		messages: {
			u_member_email:{
				required:errorobj_please_enter_email,
				email:errorobj_please_enter_valid_email_address,
				remote:errorobj_email_already_exists 
			},
			u_member_name: {
				required: errorobj_please_enter_name,
			},
		}
	});  
});
	
/*end validations*/
jQuery(document).on('click','.save_staff_booking',function(){
	var staff_ids = jQuery('#staff_select').val();
	/* if(staff_ids != null){ */
		jQuery(this).addClass('disabled');
		jQuery('.remove_add_fafa_class').removeClass('fa-pencil-square-o');
		jQuery('.remove_add_fafa_class').addClass('fa-refresh fa-spin nm');
		jQuery.ajax({
			type : 'POST',
			data : {'staff_ids' : staff_ids,'assign_staff_booking' : 'yes','order_id' : jQuery(this).data('orderid')},
			url : ajax_url + "staff_ajax.php",
			success : function(res){
				jQuery('.save_staff_booking').removeClass('disabled');
				jQuery('.remove_add_fafa_class').addClass('fa-pencil-square-o');
				jQuery('.remove_add_fafa_class').removeClass('fa-refresh fa-spin nm');
			}
		});
	/* } */
});
jQuery(document).on('click','.staff_delete',function(){
	var id = jQuery(this).data('id');
	jQuery.ajax({
		type :'POST',
		data : {'staff_id' : id,"delete_staff" : 'yes'},
		url : ajax_url + "staff_ajax.php",
		success : function(res){
			location.reload();
		}
	});
});
jQuery(document).on('click','.save_front_form_error_labels',function(){
	 jQuery('.ct-loading-main').show();
    var ajax_url = settingObj.ajax_url;
	var id = jQuery(this).data("id");
    var labelvalue_front_error = {};
	jQuery('.langlabel_front_error_'+id).each(function () {
		labelvalue_front_error[jQuery(this).data('id')] = jQuery(this).val();
    });
	var dataString = {
			id : id,
			labels_front_error: labelvalue_front_error,
			update_labels : jQuery('#update_labels').val(),
			change_language : 1
		}
	jQuery.ajax({
		type: "POST",
		url: ajax_url + "setting_ajax.php",
		data: dataString,
		success: function (response) {
			jQuery('.ct-loading-main').hide();
		}
	});
});

var serviceimagename = "";
jQuery(document).on("click", ".ct_upload_img_staff", function (e) {
    jQuery('.ct-loading-main').show();
   	var img_site_url = servObj.site_url;
    var imgObj_url = imgObj.img_url;
    var imageuss = jQuery(this).data('us');
	var staffid = jQuery(this).data('staff_id');
    var imageids = jQuery(this).data('imageinputid');	
    var file_data = jQuery("#" + jQuery(this).data('imageinputid')).prop("files")[0];
    var formdata = new FormData();
    var ctus = jQuery(this).data('us');
    var img_w = jQuery('#' + ctus + 'w').val();
    var img_h = jQuery('#' + ctus + 'h').val();
    var img_x1 = jQuery('#' + ctus + 'x1').val();
    var img_x2 = jQuery('#' + ctus + 'x2').val();
    var img_y1 = jQuery('#' + ctus + 'y1').val();
    var img_y2 = jQuery('#' + ctus + 'y2').val();
    var img_name = jQuery('#' + ctus + 'newname').val();
    var img_id = jQuery('#' + ctus + 'id').val();
    formdata.append("image", file_data);
    formdata.append("w", img_w);
    formdata.append("h", img_h);
    formdata.append("x1", img_x1);
    formdata.append("x2", img_x2);
    formdata.append("y1", img_y1);
    formdata.append("y2", img_y2);
    formdata.append("newname", img_name);
    formdata.append("img_id", img_id);
    jQuery.ajax({
        url: ajax_url + "upload.php",
        type: "POST",
        data: formdata,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            jQuery('.ct-loading-main').hide();
            if (data == "") {
                 jQuery('.error-service').addClass('show');
                jQuery('.hidemodal').trigger('click');
            } else {
                jQuery('#' + ctus + 'ctimagename').val(data);
                jQuery('.hidemodal').trigger('click');
                jQuery('#' + ctus + 'staffimage').attr('src', imgObj_url + "services/" + data);
				jQuery('#staff_image_'+staffid).attr('src', imgObj_url + "services/" + data);
				jQuery('.small-staff-image'+staffid).attr('src', imgObj_url + "services/" + data);
				
                jQuery('.error_image').hide();
                jQuery('#' + ctus + 'stafafimage').attr('data-imagename', data);
                staffimagename = jQuery('#' + ctus + 'staffimage').data('imagename');
				jQuery('#ser_cam_btn').css("display","block");
				jQuery('#ser_new_del').css("display","none");
            }
            jQuery('#'+imageids).val('');
        }
    });
});

/*  delete staff image popover  */
jQuery(document).bind("ready ajaxComplete", function(){	
	jQuery('.delete_staff_image').popover({
	html : true,
	content: function() {
		var deletestaffimagepopup_id=jQuery(this).data('pclsid');	
		return jQuery('#popover-ct-remove-staff-imagepppp'+deletestaffimagepopup_id).html();
	}
	});
});

jQuery(document).on("click","#ct-close-popover-staff-image",function(){
	jQuery('.popover').fadeOut();
});

/* delete staff image */
jQuery(document).on("click","#staff_del_images",function(){
	var staff_id=jQuery(this).data("staff_id");
	 var imgObj_url = imgObj.img_url;
	var datastring={staff_id:staff_id,action:"delete_staff_image"};
	jQuery.ajax({
		type:"POST",
		url:ajax_url+"staff_ajax.php",
		data:datastring,
		success:function(response){
			jQuery('#staff_image_'+staff_id).attr("src",imgObj_url + "user.png");
			jQuery('#pppp'+staff_id+"staffimage").attr("src",imgObj_url + "user.png");
			jQuery('#pppp'+staff_id+"ctimagename").val("");
			jQuery('.small-staff-image'+staff_id).attr('src', imgObj_url + "user.png");
			jQuery('.ser_cam_btn'+staff_id).css("display","block");
			jQuery('#ct-remove-staff-imagepppp'+staff_id).css("display","none");
			jQuery('.popover').fadeOut();
		}
	});
});

/******************************************************************************************************************/

jQuery(document).on("click",".show_staff_payment_details",function(){
	jQuery('.custm_staff_payment_details').html('<tr><td align="center" colspan="5">Loading...</td></tr>');
	var staff_ids=jQuery(this).data("staff_ids");
	var order_id=jQuery(this).data("order_id");
	var datastring={staff_ids:staff_ids,order_id:order_id,"staff_payment_details":1};
	jQuery.ajax({
		type:"POST",
		url:ajax_url+"staff_commision_ajax.php",
		data:datastring,
		success:function(res){
			jQuery('.custm_staff_payment_details').html(res);
		}
	});
});

jQuery(document).on("keyup",".sp_staff_amount",function(){
	var sid = jQuery(this).data('id');
	var total = parseInt(jQuery(this).val())+parseInt(jQuery('#sp_staff_advance_paid'+sid).val());
	jQuery('#sp_staff_net_total'+sid).val(total);
	jQuery('.sp_staff_net_total'+sid).html(total);
});
jQuery(document).on("keyup",".sp_staff_advance_paid",function(){
	var sid = jQuery(this).data('id');
	var total = parseInt(jQuery(this).val())+parseInt(jQuery('#sp_staff_amount'+sid).val());
	jQuery('#sp_staff_net_total'+sid).val(total);
	jQuery('.sp_staff_net_total'+sid).html(total);
});
jQuery(document).on("click",".save_sp_staff_commision",function(){
	var staff_pymnt_id='';
	var sp_staff_amount='';
	var sp_staff_advance_paid='';
	var sp_staff_net_total='';
	var i=1;
	var j=1;
	var k=1;
	var l=1;
	jQuery('.staff_pymnt_id').each(function(){
		if(i == 1){
			staff_pymnt_id += jQuery(this).val();
		}else{
			staff_pymnt_id += ','+jQuery(this).val();
		}
		i = i + 1;
	});
	jQuery('.sp_staff_amount').each(function(){
		if(j == 1){
			sp_staff_amount += jQuery(this).val();
		}else{
			sp_staff_amount += ','+jQuery(this).val();
		}
		j = j + 1;
	});
	jQuery('.sp_staff_advance_paid').each(function(){
		if(k == 1){
			sp_staff_advance_paid += jQuery(this).val();
		}else{
			sp_staff_advance_paid += ','+jQuery(this).val();
		}
		k = k + 1;
	});
	jQuery('.sp_staff_net_total').each(function(){
		if(l == 1){
			sp_staff_net_total += jQuery(this).val();
		}else{
			sp_staff_net_total += ','+jQuery(this).val();
		}
		l = l + 1;
	});
	var staff_pymnt_orderid = jQuery('.staff_pymnt_orderid').val();
	
	var datastring={staff_pymnt_id:staff_pymnt_id,sp_staff_amount:sp_staff_amount,sp_staff_advance_paid:sp_staff_advance_paid,sp_staff_net_total:sp_staff_net_total,staff_pymnt_orderid:staff_pymnt_orderid,"staff_payment_save":1};
	jQuery.ajax({
		type:"POST",
		url:ajax_url+"staff_commision_ajax.php",
		data:datastring,
		success:function(res){
			jQuery('.close_spc_popup').trigger('click');
		}
	});
});
jQuery(document).on('click', '.get_staff_bookingandpayment_by_dateser', function () {
	jQuery('.ct-loading-main').show();
    var startDate = jQuery('#reportrange').data('daterangepicker').startDate.format('YYYY-MM-DD');
    var endDate = jQuery("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD');
	var service_id = jQuery(".get_serid_for_staff_pymnt option:selected").val();
	var table = jQuery('#payments-staff-bookingandpymnt-details-ajax').DataTable();
	jQuery.ajax({
        type: 'post',
        data: {get_staff_bookingandpayment_by_dateser: 1, startdate: startDate, enddate: endDate, service_id: service_id},
        url: ajax_url + "staff_ajax.php",
        success: function (res) {
			jQuery('.ser_staffpayment_append').html(res);
			jQuery('.ct-loading-main').hide();
		}
    });
});
jQuery(document).on('click', '.get_payment_staff_by_date', function () {
	jQuery('.ct-loading-main').show();
    var startDate = jQuery('#reportrange-staff-payment').data('daterangepicker').startDate.format('YYYY-MM-DD');
    var endDate = jQuery("#reportrange-staff-payment").data('daterangepicker').endDate.format('YYYY-MM-DD');
	var table = jQuery('#payments-staffp-details-ajax').DataTable();
	jQuery.ajax({
        type: 'post',
        data: {get_payment_staff_by_date: 1, startdate: startDate, enddate: endDate},
        url: ajax_url + "staff_ajax.php",
        success: function (res) {
			jQuery('.get_payment_staff_by_date_append').html(res);
			jQuery('.ct-loading-main').hide();
		}
    });
});

jQuery(document).ready(function(){
	jQuery("[data-toggle='toggle']").bootstrapToggle('destroy');
    jQuery("[data-toggle='toggle']").bootstrapToggle();
});
jQuery(document).ajaxComplete(function(){
	jQuery("[data-toggle='toggle']").bootstrapToggle('destroy');                 
    jQuery("[data-toggle='toggle']").bootstrapToggle();
});

/** For Resetting Color-Scheme **/
jQuery(document).ready(function(){
      
		/* for resetting Color Scheme primary color and Admin Area Color Scheme primary color */
		jQuery("[name = ct_primary_color]").on("focus", function() {
            jQuery("[name = ct_primary_color]").val();
        });
		
		 jQuery("[name = ct_primary_color_admin]").on("focus", function() {
            jQuery("[name = ct_primary_color_admin]").val();
        });
		 
		/* for resetting Color Scheme secondary color and Admin Area Color Scheme secondary color*/
		jQuery("[name = ct_secondary_color]").on("focus", function() {
            jQuery("[name = ct_secondary_color]").val();
        });
		
		jQuery("[name = ct_secondary_color_admin]").on("focus", function() {
            jQuery("[name = ct_secondary_color_admin]").val(secondary_color_admin);
        });
		
		/* for resetting Color Scheme text color and Admin Area Color Scheme text color*/
		jQuery("[name = ct_text_color]").on("focus", function() {
            jQuery("[name = ct_text_color]").val();
        });
		
		jQuery("[name = ct_text_color_admin]").on("focus", function() {
            jQuery("[name = ct_text_color_admin]").val(text_color_admin);
        });
		
		/* for resetting Color Scheme Text Color on bg */
		jQuery("[name = ct_text_color_on_bg]").on("focus", function() {
            jQuery("[name = ct_text_color_on_bg]").val();
        });
		
        jQuery("#reset_color").on("click", function(event) {
			
			/* for resetting Color Scheme primary color and Admin Area Color Scheme primary color */
			jQuery('[name = ct_primary_color]').minicolors('value','#3d3d3d');
             jQuery("[name = ct_primary_color]").val("#3d3d3d");  
			 
			 jQuery('[name = ct_primary_color_admin]').minicolors('value','#3d3d3d');
             jQuery("[name = ct_primary_color_admin]").val("#3d3d3d"); 
			
			 
			/* for resetting Color Scheme secondary color and Admin Area Color Scheme secondary color*/
			jQuery('[name = ct_secondary_color_admin]').minicolors('value','#00cded');
             jQuery("[name = ct_secondary_color_admin]").val("#00cded");  
			 
			 jQuery('[name = ct_secondary_color]').minicolors('value','#00cded');
             jQuery("[name = ct_secondary_color]").val("#00cded");  
			 
			/* for resetting Color Scheme text color and Admin Area Color Scheme text color*/
			jQuery('[name = ct_text_color]').minicolors('value','#666666');
             jQuery("[name = ct_text_color]").val("#666666"); 
			 
			jQuery('[name = ct_text_color_admin]').minicolors('value','#ffffff');
             jQuery("[name = ct_text_color_admin]").val("#ffffff");
			 
			/* for resetting Color Scheme Text Color on bg */
			jQuery('[name = ct_text_color_on_bg]').minicolors('value','#ffffff');
             jQuery("[name = ct_text_color_on_bg]").val("#ffffff"); 
        });
});
/* recurrence booking */
jQuery(document).on('click','.save_recurrence_booking',function () {
	jQuery('.ct-loading-main').show();
	var recurrence_booking_status = jQuery('#ct_recurrence_booking_status').prop('checked');
	if(recurrence_booking_status == true) {
		var ct_recurrence_booking_status = 'Y';
	} else {
		var ct_recurrence_booking_status = 'N';
	}
 
	var datastring = {
		'ct_recurrence_booking_status' : ct_recurrence_booking_status,
		'ct_recurrence_booking' : '1'
	};
	jQuery.ajax({
		type: 'post',
		data: datastring,
		url: ajax_url + "setting_ajax.php",
		success: function (res) {
			jQuery('.ct-loading-main').hide();
		}
	});
});
jQuery(document).on('click','.send_inovoice',function () {
	jQuery('.ct-loading-main').show();
	var email = jQuery(this).data('email');
	var name = jQuery(this).data('name');
	var links = jQuery(this).data('link');
	var datastring = {
		'email' : email,
		'name' : name,
		'link' : links,
		'send_email_invoice' : 1,
	}
	jQuery.ajax({
        type: 'post',
        data: datastring,
        url: ajax_url + "setting_ajax.php",
        success: function (res) {
			jQuery('.ct-loading-main').hide();
		}
	});
});
jQuery(document).on('click', '.save_seo_ga', function () {
	jQuery('.ct-loading-main').show();
	jQuery('#ct-seo-ga-settings').submit();
});
jQuery(document).on('submit', '#ct-seo-ga-settings', function (e) {
	e.preventDefault();
	$.ajax({
		url: ajax_url + "setting_ajax.php",
		type: "POST",
		data: new FormData(this), 
		contentType: false,
		cache: false,
		processData:false,
		success: function(res) {
			if(jQuery.trim(res) == 'Invalid Image Type'){
				jQuery('.mainheader_message_fail').show();
                jQuery('.mainheader_message_inner_fail').css('display', 'inline');
                jQuery('#ct_sucess_message_fail').text(errorobj_Invalid_Image_Type);
                jQuery('.mainheader_message_fail').fadeOut(5000);
                jQuery('.ct-loading-main').hide();
            }
            else{
                jQuery('.mainheader_message').show();
                jQuery('.mainheader_message_inner').css('display', 'inline');
                jQuery('#ct_sucess_message').text(errorobj_seo_settings_updated_successfully);
                jQuery('.mainheader_message').fadeOut(5000);
                jQuery('.ct-loading-main').hide();
            }
		}
	});
});

function ct_gif_loader_preview(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			jQuery('#ct_upload_gif_loader_preview').show();
			jQuery('#ct_upload_gif_loader_preview').attr('src', e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
}
jQuery(document).on('change', '.ct_frontend_gif_loader_file', function () {
	ct_gif_loader_preview(this);
});
jQuery(document).on('click', '#ct_gifloader', function () {
	jQuery('.ct_CSS_Loader_div').hide();
	jQuery('.ct_GIF_Loader_div').show();
});
jQuery(document).on('click', '#ct_defaultloader', function () {
	jQuery('.ct_CSS_Loader_div').hide();
	jQuery('.ct_GIF_Loader_div').hide();
});
jQuery(document).on('click', '#ct_cssloader', function () {
	jQuery('.ct_CSS_Loader_div').show();
	jQuery('.ct_GIF_Loader_div').hide();
});
jQuery(document).on('focusout', '#ct_custom_css_loader', function () {
	var t_val = jQuery(this).val();
	if(t_val != ''){
		jQuery('.ct_custom_css_loader_preview_overlay').html(t_val);
		jQuery('.ct_custom_css_loader_preview_overlay').show();
	}else{
		jQuery('.ct_custom_css_loader_preview_overlay').html('');
		jQuery('.ct_custom_css_loader_preview_overlay').hide();
	}
});
jQuery(document).ready( function () {
	if(jQuery("#ct_gifloader").prop("checked")){
		jQuery('.ct_CSS_Loader_div').hide();
		jQuery('.ct_GIF_Loader_div').show();
	}else if(jQuery("#ct_cssloader").prop("checked")){
		jQuery('.ct_CSS_Loader_div').show();
		jQuery('.ct_GIF_Loader_div').hide();
	}else{
		jQuery('.ct_CSS_Loader_div').hide();
		jQuery('.ct_GIF_Loader_div').hide();
	}
	if(jQuery('#ct_custom_css_loader').val() == ''){
		jQuery('.ct_custom_css_loader_preview_overlay').html('');
		jQuery('.ct_custom_css_loader_preview_overlay').hide();
	}
});

/***  auto updater ***/
jQuery(document).on('click','#ct_update_available',function(e){
	jQuery('.ct-loading-main').show();
	e.preventDefault();
	jQuery.ajax({
		type:"POST",
		url: ajax_url +"ct_auto_updater_ajax.php",
		data:{action:"auto_updater"},
		success:function(res){
			if(jQuery.trim(res) == "Not installed - ZipArchive is required for importing content. Please contact your server administrator and ask them to enable it."){
				jQuery('.mainheader_message_fail_upgrade').show();
                jQuery('.mainheader_message_inner_fail_upgrade').css('display', 'inline');
                jQuery('#ct_sucess_message_fail_upgrade').text("Not installed - ZipArchive is required for importing content. Please contact your server administrator and ask them to enable it.");
                jQuery('.mainheader_message_fail_upgrade').fadeOut(20000);
                jQuery('.ct-loading-main').hide();
			}else{
				window.location.reload();
			}
		}
	});
});
/*** auto updater  ***/

/***  Add extensions ***/
jQuery(document).on('click','.ct_add_extensions',function(e){
	jQuery('.ct-loading-main').show();
	e.preventDefault();
	
	var installed_version = jQuery(this).data('installed_version');
	var update_version = jQuery(this).data('update_version');
	var extension = jQuery(this).data('extension');
	var purchase_option = jQuery(this).data('purchase_option');
	var version_option = jQuery(this).data('version_option');
	var redirect_to = jQuery(this).data('redirect_to');
	
	jQuery.ajax({
		type:"POST",
		url: ajax_url +"ct_add_extensions_ajax.php",
		data:{installed_version:installed_version, update_version:update_version, extension:extension, purchase_option:purchase_option, version_option:version_option, action:"add_extension"},
		success:function(res){
			if(jQuery.trim(res) == "Not installed - ZipArchive is required for importing content. Please contact your server administrator and ask them to enable it."){
				jQuery('.mainheader_message_fail_upgrade').show();
				jQuery('.mainheader_message_inner_fail_upgrade').css('display', 'inline');
				jQuery('#ct_sucess_message_fail_upgrade').text("Not installed - ZipArchive is required for importing content. Please contact your server administrator and ask them to enable it.");
				jQuery('.mainheader_message_fail_upgrade').fadeOut(20000);
				jQuery('.ct-loading-main').hide();
			}else{
				if(redirect_to != ''){
					window.location.href = site_ur.site_url+redirect_to;
				}else{
					window.location.reload();
				}
			}
		}
	});
});
jQuery(document).on('click','.ct_activate_extensions',function(e){
	jQuery('.ct-loading-main').show();
	e.preventDefault();
	jQuery('.purchase_code_err_'+extension).css("cssText", "display: none !important;");
	
	var installed_version = jQuery(this).data('installed_version');
	var update_version = jQuery(this).data('update_version');
	var extension = jQuery(this).data('extension');
	var purchase_option = jQuery(this).data('purchase_option');
	var version_option = jQuery(this).data('version_option');
	var redirect_to = jQuery(this).data('redirect_to');
	var purchase_code = jQuery('.verify_purchase_code_value_'+extension).val();
	
	if(purchase_code != ''){
		jQuery.ajax({
			type:"POST",
			url: ajax_url +"ct_add_extensions_ajax.php",
			data:{purchase_code:purchase_code, version_option:version_option, extension:extension, action:"verify_purchase_code"},
			success:function(res){
				if(jQuery.trim(res) == "Not installed - ZipArchive is required for importing content. Please contact your server administrator and ask them to enable it."){
					jQuery('.mainheader_message_fail_upgrade').show();
					jQuery('.mainheader_message_inner_fail_upgrade').css('display', 'inline');
					jQuery('#ct_sucess_message_fail_upgrade').text("Not installed - ZipArchive is required for importing content. Please contact your server administrator and ask them to enable it.");
					jQuery('.mainheader_message_fail_upgrade').fadeOut(20000);
					jQuery('.ct-loading-main').hide();
				}else if(jQuery.trim(res) == 'valid' || jQuery.trim(res) == 'verified'){
					jQuery('.purchase_code_err_'+extension).css("cssText", "display: none !important;");
					jQuery.ajax({
						type:"POST",
						url: ajax_url +"ct_add_extensions_ajax.php",
						data:{installed_version:installed_version, update_version:update_version, extension:extension, purchase_option:purchase_option, version_option:version_option, action:"activate_extension"},
						success:function(res){
							if(redirect_to != ''){
								window.location.href = site_ur.site_url+redirect_to;
							}else{
								window.location.reload();
							}
						}
					});
				}else{
					jQuery('.purchase_code_err_'+extension).css("cssText", "display: block !important;");
					jQuery('.purchase_code_err_'+extension).show();
					jQuery('.purchase_code_err_'+extension).html("Please enter valid purchase code");
					jQuery('.ct-loading-main').hide();
				}
			}
		});
	}else{
		jQuery('.purchase_code_err_'+extension).css("cssText", "display: block !important;");
		jQuery('.purchase_code_err_'+extension).show();
		jQuery('.purchase_code_err_'+extension).html("Please enter purchase code");
		jQuery('.ct-loading-main').hide();
	}
});
jQuery(document).on('click','.ct_activate_extensions_zip',function(e){
	jQuery('.ct-loading-main').show();
	e.preventDefault();
	jQuery('.purchase_code_err_'+extension).css("cssText", "display: none !important;");
	
	var installed_version = jQuery(this).data('installed_version');
	var update_version = jQuery(this).data('update_version');
	var extension = jQuery(this).data('extension');
	var purchase_option = jQuery(this).data('purchase_option');
	var version_option = jQuery(this).data('version_option');
	var redirect_to = jQuery(this).data('redirect_to');
	var purchase_code = jQuery('.verify_purchase_code_value_'+extension).val();
	
	if(purchase_code != ''){
		jQuery.ajax({
			type:"POST",
			url: ajax_url +"ct_add_extensions_ajax.php",
			data:{purchase_code:purchase_code, version_option:version_option, extension:extension, action:"verify_purchase_code"},
			success:function(res){
				if(jQuery.trim(res) == "Not installed - ZipArchive is required for importing content. Please contact your server administrator and ask them to enable it."){
					jQuery('.mainheader_message_fail_upgrade').show();
					jQuery('.mainheader_message_inner_fail_upgrade').css('display', 'inline');
					jQuery('#ct_sucess_message_fail_upgrade').text("Not installed - ZipArchive is required for importing content. Please contact your server administrator and ask them to enable it.");
					jQuery('.mainheader_message_fail_upgrade').fadeOut(20000);
					jQuery('.ct-loading-main').hide();
				}else if(jQuery.trim(res) == 'valid' || jQuery.trim(res) == 'verified'){
					jQuery('.purchase_code_err_'+extension).css("cssText", "display: none !important;");
					jQuery.ajax({
						type:"POST",
						url: ajax_url +"ct_add_extensions_ajax.php",
						data:{installed_version:installed_version, update_version:update_version, extension:extension, purchase_option:purchase_option, version_option:version_option, action:"activate_extensions_zip"},
						success:function(res){
							if(jQuery.trim(res) == "Not installed - ZipArchive is required for importing content. Please contact your server administrator and ask them to enable it."){
								jQuery('.mainheader_message_fail_upgrade').show();
								jQuery('.mainheader_message_inner_fail_upgrade').css('display', 'inline');
								jQuery('#ct_sucess_message_fail_upgrade').text("Not installed - ZipArchive is required for importing content. Please contact your server administrator and ask them to enable it.");
								jQuery('.mainheader_message_fail_upgrade').fadeOut(20000);
								jQuery('.ct-loading-main').hide();
							}else{
								if(redirect_to != ''){
									window.location.href = site_ur.site_url+redirect_to;
								}else{
									window.location.reload();
								}
							}
						}
					});
				}else{
					jQuery('.purchase_code_err_'+extension).css("cssText", "display: block !important;");
					jQuery('.purchase_code_err_'+extension).show();
					jQuery('.purchase_code_err_'+extension).html("Please enter valid purchase code");
					jQuery('.ct-loading-main').hide();
				}
			}
		});
	}else{
		jQuery('.purchase_code_err_'+extension).css("cssText", "display: block !important;");
		jQuery('.purchase_code_err_'+extension).show();
		jQuery('.purchase_code_err_'+extension).html("Please enter purchase code");
		jQuery('.ct-loading-main').hide();
	}
});
/*** Add extensions  ***/
jQuery(document).ready(function(){
	payment_currency_check_js();
});

jQuery(document).on('click','.ct_uninstall_extension',function(e){
	e.preventDefault();
	jQuery('.ct-loading-main').show();
	var installed_version = jQuery(this).data('installed_version');
	var update_version = jQuery(this).data('update_version');
	var extension = jQuery(this).data('extension');
	var purchase_option = jQuery(this).data('purchase_option');
	var version_option = jQuery(this).data('version_option');
	
	jQuery.ajax({
		type:"POST",
		url: ajax_url +"ct_remove_extensions_ajax.php",
		data:{installed_version:installed_version, update_version:update_version, extension:extension, purchase_option:purchase_option, version_option:version_option, action:"uninstall_extension"},
		success:function(res){
			if(jQuery.trim(res) == "Not installed - ZipArchive is required for importing content. Please contact your server administrator and ask them to enable it."){
				jQuery('.mainheader_message_fail_upgrade').show();
                jQuery('.mainheader_message_inner_fail_upgrade').css('display', 'inline');
                jQuery('#ct_sucess_message_fail_upgrade').text("Not installed - ZipArchive is required for importing content. Please contact your server administrator and ask them to enable it.");
                jQuery('.mainheader_message_fail_upgrade').fadeOut(20000);
                jQuery('.ct-loading-main').hide();
			}else{
				window.location.reload();
			}
		}
	});
});
jQuery(document).on('click','.ct_deactivate_extension',function(e){
	e.preventDefault();
	jQuery('.ct-loading-main').show();
	var installed_version = jQuery(this).data('installed_version');
	var update_version = jQuery(this).data('update_version');
	var extension = jQuery(this).data('extension');
	var purchase_option = jQuery(this).data('purchase_option');
	var version_option = jQuery(this).data('version_option');
	
	jQuery.ajax({
		type:"POST",
		url: ajax_url +"ct_remove_extensions_ajax.php",
		data:{installed_version:installed_version, update_version:update_version, extension:extension, purchase_option:purchase_option, version_option:version_option, action:"uninstall_extension"},
		success:function(res){
			if(jQuery.trim(res) == "Not installed - ZipArchive is required for importing content. Please contact your server administrator and ask them to enable it."){
				jQuery('.mainheader_message_fail_upgrade').show();
                jQuery('.mainheader_message_inner_fail_upgrade').css('display', 'inline');
                jQuery('#ct_sucess_message_fail_upgrade').text("Not installed - ZipArchive is required for importing content. Please contact your server administrator and ask them to enable it.");
                jQuery('.mainheader_message_fail_upgrade').fadeOut(20000);
                jQuery('.ct-loading-main').hide();
			}else{
				window.location.reload();
			}
		}
	});
});