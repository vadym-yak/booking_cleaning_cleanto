<?php 

class cleanto_dummy{
	public $ct_timezone;
	public $s_title;
    public $s_description;
    public $s_color;
    public $s_image;
    public $s_status;
    public $s_position;
    public $conn;
    public $services="ct_services";
	
	public $sm_service_id;
	public $sm_method_title;
	public $sm_status;
    public $services_method="ct_services_method";
	
	public $smu_service_id;
	public $smu_methods_id;
	public $smu_units_title;
	public $smu_base_price;
	public $smu_maxlimit;
	public $smu_status;
    public $service_methods_units="ct_service_methods_units";
	
	public $smur_units_id;
	public $smur_units;
	public $smur_rules;
	public $smur_rates;
    public $services_methods_units_rate="ct_services_methods_units_rate";
	
	public $smd_service_methods_id;
	public $smd_design;
    public $service_methods_design="ct_service_methods_design";
	
	public $sa_service_id;
	public $sa_addon_service_name;
	public $sa_base_price;
	public $sa_maxqty;
	public $sa_image;
	public $sa_multipleqty;
	public $sa_status;
	public $sa_predefine_image;
	public $sa_predefine_image_title = "";
    public $services_addon="ct_services_addon";
	
	public $asr_addon_service_id;
	public $asr_unit;
	public $asr_rules;
	public $asr_rate;
    public $addon_service_rate="ct_addon_service_rate";
	
	public $wda_week_id;
	public $wda_weekday_id;
	public $wda_day_start_time;
	public $wda_day_end_time;
	public $wda_off_days;
    public $week_days_available="ct_week_days_available";
    
	public $od_lastmodify;
	public $od_off_date;
	public $off_days="ct_off_days";
	
	public $u_user_pwd;
	public $u_first_name;
	public $u_last_name;
	public $u_user_email;
	public $u_phone;
	public $u_address;
	public $u_zip;
	public $u_city;
	public $u_state;
	public $u_notes;
	public $u_vc_status;
	public $u_p_status;
	public $u_status;
	public $u_usertype;
	public $u_contact_status;
	public $users="ct_users";
	
	public $b_order_id;
	public $b_client_id;
	public $b_order_date;
	public $b_booking_date_time;
	public $b_service_id;
	public $b_method_id;
	public $b_method_unit_id;
	public $b_method_unit_qty;
	public $b_method_unit_qty_rate;
	public $b_booking_status;
	public $b_lastmodify;
	public $b_read_status;
	public $bookings="ct_bookings";
	
	public $ba_order_id;
	public $ba_service_id;
	public $ba_addons_service_id;
	public $ba_addons_service_qty;
	public $ba_addons_service_rate;
	public $booking_addons="ct_booking_addons";
	
	public $p_order_id;
	public $p_payment_method;
	public $p_transaction_id;
	public $p_amount;
	public $p_discount;
	public $p_taxes;
	public $p_partial_amount;
	public $p_payment_date;
	public $p_lastmodify;
	public $p_net_amount;
	public $p_frequently_discount;
	public $p_frequently_discount_amount;
	public $payments="ct_payments";
	
	public $oci_order_id;
	public $oci_client_name;
	public $oci_client_email;
	public $oci_client_phone;
	public $oci_client_personal_info;
	public $order_client_info="ct_order_client_info";
	
	public $fd_d_type;
	public $fd_rates;
	public $fd_label;
	public $fd_id;
	public $frequently_discount="ct_frequently_discount";
	
	public $ct_remove_data_array;
	
	public $tablename="ct_services";
	public $table_name_sa="ct_services_addon";
	public $table_name_sm="ct_services_method";
	public $table_name_smu="ct_service_methods_units";
	public $table_name_smur="ct_services_methods_units_rate";
	public $table_name_smd="ct_service_methods_design";
	public $table_name_sar="ct_addon_service_rate";
	
	public function __construct() {
		$this->ct_timezone = "America/Los_Angeles";
	}
	public function add_service(){
		$query="insert into `".$this->services."` (`id`,`title`,`description`,`color`,`image`,`status`,`position`) values(NULL,'".$this->s_title."','".$this->s_description."','".$this->s_color."','".$this->s_image."','".$this->s_status."','".$this->s_position."')";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_insert_id($this->conn);
		return $value;
	}
	
	public function add_services_method(){
		$query="insert into `".$this->services_method."` (`id`,`service_id`,`method_title`,`status`,`position`) values(NULL,'".$this->sm_service_id."','".$this->sm_method_title."','".$this->sm_status."','0')";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_insert_id($this->conn);
		return $value;
	}
	
	public function add_services_method_unit(){
		$query="insert into `".$this->service_methods_units."` (`id`,`services_id`,`methods_id`,`units_title`,`base_price`,`maxlimit`,`status`, `position`,`limit_title`) values(NULL,'".$this->smu_service_id."','".$this->smu_methods_id."','".$this->smu_units_title."','".$this->smu_base_price."','".$this->smu_maxlimit."','".$this->smu_status."', '0','')";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_insert_id($this->conn);
		return $value;
	}
	
	public function add_services_methods_units_rate(){
		$query="insert into `".$this->services_methods_units_rate."` (`id`,`units_id`,`units`,`rules`,`rates`) values(NULL,'".$this->smur_units_id."','".$this->smur_units."','".$this->smur_rules."','".$this->smur_rates."')";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_insert_id($this->conn);
		return $value;
	}
	
	public function add_service_methods_design(){
		$query="insert into `".$this->service_methods_design."` (`id`,`service_methods_id`,`design`) values(NULL,'".$this->smd_service_methods_id."','".$this->smd_design."')";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_insert_id($this->conn);
		return $value;
	}
	
	public function add_services_addon(){
		$query="insert into `".$this->services_addon."` (`id`,`service_id`,`addon_service_name`,`base_price`,`maxqty`,`image`,`multipleqty`,`status`,`position`,`predefine_image`,`predefine_image_title`) values(NULL,'".$this->sa_service_id."','".$this->sa_addon_service_name."','".$this->sa_base_price."','".$this->sa_maxqty."','".$this->sa_image."','".$this->sa_multipleqty."','".$this->sa_status."','0','".$this->sa_predefine_image."','".$this->sa_predefine_image_title."')";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_insert_id($this->conn);
		return $value;
	}
	
	public function add_addon_service_rate(){
		$query="insert into `".$this->addon_service_rate."` (`id`,`addon_service_id`,`unit`,`rules`,`rate`) values(NULL,'".$this->asr_addon_service_id."','".$this->asr_unit."','".$this->asr_rules."','".$this->asr_rate."')";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_insert_id($this->conn);
		return $value;
	}
	
	public function add_week_days_available(){
		$query="insert into `".$this->week_days_available."` (`id`,`provider_id`,`week_id`,`weekday_id`,`day_start_time`,`day_end_time`,`off_day`,`provider_schedule_type`) values(NULL,'1','".$this->wda_week_id."','".$this->wda_weekday_id."','".$this->wda_day_start_time."','".$this->wda_day_end_time."','".$this->wda_off_days."','weekly')";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_insert_id($this->conn);
		return $value;
	}
	
	public function add_off_days(){
		$query="insert into `".$this->off_days."` (`id`,`user_id`,`off_date`,`lastmodify`,`status`) values(NULL,'1','".$this->od_off_date."','".$this->od_lastmodify."','0')";
		$result=mysqli_query($this->conn,$query);		
		$value=mysqli_insert_id($this->conn);
		return $value;
	}
	
	public function add_users(){
		$query="insert into `".$this->users."` (`id`,`user_email`,`user_pwd`,`first_name`,`last_name`,`phone`,`zip`,`address`,`city`,`state`,`notes`,`vc_status`,`p_status`,`contact_status`,`status`,`usertype`) values(NULL,'".$this->u_user_email."','".$this->u_user_pwd."','".$this->u_first_name."','".$this->u_last_name."','".$this->u_phone."','".$this->u_zip."','".$this->u_address."','".$this->u_city."','".$this->u_state."','".$this->u_notes."','".$this->u_vc_status."','".$this->u_p_status."','".$this->u_contact_status."','".$this->u_status."','".$this->u_usertype."')";
		$result=mysqli_query($this->conn,$query);	
		$value=mysqli_insert_id($this->conn);
		return $value;
	}
	
	public function add_bookings(){
		$query="insert into `".$this->bookings."` (`id`,`order_id`,`client_id`,`order_date`,`booking_date_time`,`service_id`,`method_id`,`method_unit_id`,`method_unit_qty`,`method_unit_qty_rate`,`booking_status`,`reject_reason`,`reminder_status`,`lastmodify`,`read_status`,`staff_ids`, `gc_event_id`,`gc_staff_event_id`) values(NULL,'".$this->b_order_id."','".$this->b_client_id."','".$this->b_order_date."','".$this->b_booking_date_time."','".$this->b_service_id."','".$this->b_method_id."','".$this->b_method_unit_id."','".$this->b_method_unit_qty."','".$this->b_method_unit_qty_rate."','".$this->b_booking_status."','','0','".$this->b_lastmodify."','".$this->b_read_status."','','','')";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_insert_id($this->conn);	
		return $value;
	}
	
	public function add_booking_addons(){
		$query="insert into `".$this->booking_addons."` (`id`,`order_id`,`service_id`,`addons_service_id`,`addons_service_qty`,`addons_service_rate`) values(NULL,'".$this->ba_order_id."','".$this->ba_service_id."','".$this->ba_addons_service_id."','".$this->ba_addons_service_qty."','".$this->ba_addons_service_rate."')";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_insert_id($this->conn);	
		return $value;
	}
	
	public function add_payments(){
		$query="insert into `".$this->payments."` (`id`,`order_id`,`payment_method`,`transaction_id`,`amount`,`discount`,`taxes`,`partial_amount`,`payment_date`,`net_amount`,`lastmodify`,`frequently_discount`,`frequently_discount_amount`,`recurrence_status`,`payment_status`) values(NULL,'".$this->p_order_id."','".$this->p_payment_method."','".$this->p_transaction_id."','".$this->p_amount."','".$this->p_discount."','".$this->p_taxes."','".$this->p_partial_amount."','".$this->p_payment_date."','".$this->p_net_amount."','".$this->p_lastmodify."','".$this->p_frequently_discount."','".$this->p_frequently_discount_amount."','N','Pending')";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_insert_id($this->conn);
		return $value;
	}
	
	public function add_order_client_info(){
		$query="insert into `".$this->order_client_info."` (`id`,`order_id`,`client_name`,`client_email`,`client_phone`,`client_personal_info`) values(NULL,'".$this->oci_order_id."','".$this->oci_client_name."','".$this->oci_client_email."','".$this->oci_client_phone."','".$this->oci_client_personal_info."')";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_insert_id($this->conn);
		return $value;

	}
	
	public function update_frequently_discount(){
		$query="update `".$this->frequently_discount."` set `d_type`='".$this->fd_d_type."',`rates`='".$this->fd_rates."',`labels`='".$this->fd_label."' where `id`='".$this->fd_id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	public function add_settings(){
		
		$qryupdate_sample_data = "update `ct_settings` set `option_value` = 'Y' where `option_name`='ct_sample_data_status'";        
		$qryupdate_remove_sample_data = "update `ct_settings` set `option_value` = '".$this->ct_remove_data_array."' where `option_name`='ct_remove_data_array'";
		
		$check_for_tax_vat_value_query = "SELECT * FROM `ct_settings` WHERE `option_name` = 'ct_tax_vat_value' and `option_value`<>''";
		$check_for_tax_vat_value = mysqli_query($this->conn, $check_for_tax_vat_value_query);
		$vat_value_check = mysqli_fetch_row($check_for_tax_vat_value);
		
		$check_for_tax_vat_type_query = "SELECT * FROM `ct_settings` WHERE `option_name` = 'ct_tax_vat_type' and `option_value`<>''";
		$check_for_tax_vat_type = mysqli_query($this->conn, $check_for_tax_vat_type_query);
		$vat_type_check = mysqli_fetch_row($check_for_tax_vat_type);
		
		if($vat_value_check[2] == '' || $vat_type_check == ''){
			$qryupdate_tax_vat_status = "update `ct_settings` set `option_value` = 'Y' where `option_name`='ct_tax_vat_status'";
			$qryupdate_tax_vat_value = "update `ct_settings` set `option_value` = '10' where `option_name`='ct_tax_vat_value'";
			$qryupdate_tax_vat_type = "update `ct_settings` set `option_value` = 'F' where `option_name`='ct_tax_vat_type'";
			mysqli_query($this->conn,$qryupdate_tax_vat_status);
			mysqli_query($this->conn,$qryupdate_tax_vat_value);
			mysqli_query($this->conn,$qryupdate_tax_vat_type);
		}
		
		mysqli_query($this->conn,$qryupdate_sample_data);  
		mysqli_query($this->conn,$qryupdate_remove_sample_data);
	}
	
	 public function get_all_bookings_byserviceid($id){
        $query="select `order_id`, `gc_event_id`, `gc_staff_event_id`, `staff_ids` from `".$this->bookings."` where `service_id` = '".$id."' GROUP BY `id`, `order_id`, `client_id`, `order_date`, `booking_date_time`, `service_id`, `method_id`, `method_unit_id`, `method_unit_qty`, `method_unit_qty_rate`, `booking_status`, `reject_reason`, `reminder_status`, `lastmodify`, `read_status`, `staff_ids`, `gc_event_id`, `gc_staff_event_id`";
        $result=mysqli_query($this->conn,$query);
        return $result;
    }
	
        /*function to get all addons if exist with the service id*/
        public function get_exist_addons_by_serviceid($id){
            $query="select `ct_services_addon`.* from `ct_services`,`ct_services_addon` where `ct_services`.`id` = `ct_services_addon`.`service_id` and `ct_services`.`id` = $id";
            $result=mysqli_query($this->conn,$query);
            return $result;
        }

		/*function to get all addons_rate if exist with the addon id*/
        public function get_exist_addons_rate_by_addonid($id){
			$query = "SELECT * FROM `ct_addon_service_rate` where `addon_service_id` = $id";
            $result=mysqli_query($this->conn,$query);
            return $result;
        }
		
		
		/*function to get all methods if exist with the service id*/
        public function get_exist_methods_by_serviceid($id){
            $query="select `ct_services_method`.* from `ct_services`,`ct_services_method` where `ct_services`.`id` = `ct_services_method`.`service_id` and `ct_services`.`id` = $id";
            $result=mysqli_query($this->conn,$query);
            return $result;
        }
		
		/*function to get all methods_unit if exist with the service id*/
        public function get_exist_methods_units_by_methodid($id){
			$query = "SELECT * FROM `ct_service_methods_units` where `methods_id` = $id";
            $result=mysqli_query($this->conn,$query);
            return $result;
        }
		
		/*function to get all methods_unit if exist with the service id*/
        public function get_exist_methods_units_rate_by_unitid($id){
			$query = "SELECT * FROM `ct_services_methods_units_rate` WHERE `units_id`=$id";
            $result=mysqli_query($this->conn,$query);
            return $result;
        }
		
		
		/* DELETE QUERY */
		/* delete all addons with the particular service	 */
		public function delete_addons_of_service($addonid){
			$query="delete from `".$this->table_name_sa."` where `id`=$addonid";
			mysqli_query($this->conn,$query);
		}
		/* delete the rate of the addons */
		public function delete_addons_rate($addon_rate_id){
			$query="delete from `".$this->table_name_sar."` where `id`=$addon_rate_id";
			mysqli_query($this->conn,$query);
		}
		
		/* delete all method unit rate */
		public function delete_service_method_unit_rate($method_unit_rate_id){
			$query="delete from `".$this->table_name_smur."` where `id`=$method_unit_rate_id";
			mysqli_query($this->conn,$query);
		}
		
		/* delete all method unit*/
		public function delete_method_unit($method_unit){
			$query="delete from `".$this->table_name_smu."` where `id`=$method_unit";
			mysqli_query($this->conn,$query);
		}
		
		/* delete all method*/
		public function delete_method($methodid){
			$query="delete from `".$this->table_name_sm."` where `id`=$methodid";
			mysqli_query($this->conn,$query);
			
			$query="delete from `".$this->table_name_smd."` where `service_methods_id`=$methodid";
			mysqli_query($this->conn,$query);
			
		}
		
		/*Function for Delete service*/
		public function delete_service($id){
			$query="delete from `".$this->tablename."` where `id`=$id";
			$result=mysqli_query($this->conn,$query);
			return $result;
		}
		
	public function delete_all(){
        $qryy = "update `ct_settings` set `option_value` = 'N' where `option_name`='ct_sample_data_status'";
        mysqli_query($this->conn,$qryy);

        $q2 = "select `option_value` from `ct_settings` where `option_name` = 'ct_remove_data_array'";
        $reslt=mysqli_query($this->conn,$q2);
        $val = mysqli_fetch_array($reslt);
        $id = explode(',',$val[0]);

        /* delete dummy services */
		for($i=0;$i<=3;$i++){		
			
			$addons = $this->get_exist_addons_by_serviceid($id[$i]);
			$methods = $this->get_exist_methods_by_serviceid($id[$i]);
			while($r = mysqli_fetch_array($addons)){
				$addons_rates = $this->get_exist_addons_rate_by_addonid($r['id']);
				while($t = mysqli_fetch_array($addons_rates))
				{
					/* DELETE ADDONS RATE*/
					$this->delete_addons_rate($t['id']);
				}
				/* DELETE ADDONS*/
				$this->delete_addons_of_service($r['id']);
			}
			while($r = mysqli_fetch_array($methods)){
				$methods_units = $this->get_exist_methods_units_by_methodid($r['id']);
				while($t = mysqli_fetch_array($methods_units))
				{
					$methods_units_rate = $this->get_exist_methods_units_rate_by_unitid($t['id']);
					while($mur = mysqli_fetch_array($methods_units_rate))
					{
						/* Service method unit rate delete */
						$this->delete_service_method_unit_rate($mur['id']);
					}
					/* Service method unit delete */
					$this->delete_method_unit($t['id']);
				}	   
				/* Service method delete */
				$this->delete_method($r['id']);
			}
	
			$this->delete_service($id[$i]);
	
			/* get all bookings with above service id */
			$booking_with_service_id = $this->get_all_bookings_byserviceid($id[$i]);
			while($bsi = mysqli_fetch_array($booking_with_service_id)){
				$query13="delete from `ct_bookings` where `order_id` = ".$bsi['order_id'];
				$query14="delete from `ct_booking_addons` where `order_id` = ".$bsi['order_id'];
				$query15="delete from `ct_payments` where `order_id` = ".$bsi['order_id'];
				$query16="delete from `ct_order_client_info` where `order_id` = ".$bsi['order_id'];
				mysqli_query($this->conn,$query13);
				mysqli_query($this->conn,$query14);
				mysqli_query($this->conn,$query15);
				mysqli_query($this->conn,$query16);
			}
		}
        
		/* Delete the sample data user johndoe@example.com */
		$delete_user_sample = "delete from `ct_users` where `user_email` = 'johndoe@example.com'";
		mysqli_query($this->conn,$delete_user_sample);


       /* delete offday */
        $query11="delete from `ct_off_days` where `id` = ".$id[4];
        $query12="delete from `ct_users` where `id` = ".$id[5];
        mysqli_query($this->conn,$query11);
        mysqli_query($this->conn,$query12);

        $qry = "update `ct_settings` set `option_value` = '' where `option_name`='ct_remove_data_array'";
        mysqli_query($this->conn,$qry);
    }
}
?>