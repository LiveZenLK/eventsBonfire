<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Drone_master_model extends BF_Model {

	protected $table_name	= "drone_master";
	protected $key			= "id";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";

	protected $log_user 	= FALSE;

	protected $set_created	= false;
	protected $set_modified = false;

	/*
		Customize the operations of the model without recreating the insert, update,
		etc methods by adding the method names to act as callbacks here.
	 */
	protected $before_insert 	= array();
	protected $after_insert 	= array();
	protected $before_update 	= array();
	protected $after_update 	= array();
	protected $before_find 		= array();
	protected $after_find 		= array();
	protected $before_delete 	= array();
	protected $after_delete 	= array();

	/*
		For performance reasons, you may require your model to NOT return the
		id of the last inserted row as it is a bit of a slow method. This is
		primarily helpful when running big loops over data.
	 */
	protected $return_insert_id 	= TRUE;

	// The default type of element data is returned as.
	protected $return_type 			= "object";

	// Items that are always removed from data arrays prior to
	// any inserts or updates.
	protected $protected_attributes = array();

	/*
		You may need to move certain rules (like required) into the
		$insert_validation_rules array and out of the standard validation array.
		That way it is only required during inserts, not updates which may only
		be updating a portion of the data.
	 */
	protected $validation_rules 		= array(
		array(
			"field"		=> "drone_master_setType",
			"label"		=> "Set Type",
			"rules"		=> "required|unique[bf_drone_master.setType,bf_drone_master.id]|max_length[50]"
		),
		array(
			"field"		=> "drone_master_djiphantom",
			"label"		=> "djiphantom",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_master_djiphantom_Val",
			"label"		=> "djiphantom Val",
			"rules"		=> "max_length[200]"
		),
		array(
			"field"		=> "drone_master_zenmuseh_gimbal",
			"label"		=> "zenmuseh gimbal",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_master_zenmuseh_gimbal_val",
			"label"		=> "zenmuseh gimbal val",
			"rules"		=> "max_length[200]"
		),
		array(
			"field"		=> "drone_master_geprohero",
			"label"		=> "geprohero",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_master_geprohero_val",
			"label"		=> "geprohero val",
			"rules"		=> "max_length[200]"
		),
		array(
			"field"		=> "drone_master_propellers",
			"label"		=> "propellers",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_master_propellers_val",
			"label"		=> "propellers val",
			"rules"		=> "max_length[200]"
		),
		array(
			"field"		=> "drone_master_phantom_batteries",
			"label"		=> "phantom batteries",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_master_phantom_batteries_val",
			"label"		=> "phantom batteries val",
			"rules"		=> "max_length[200]"
		),
		array(
			"field"		=> "drone_master_phantom_chargers",
			"label"		=> "phantom chargers",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_master_phantom_chargers_val",
			"label"		=> "phantom chargers val",
			"rules"		=> "max_length[200]"
		),
		array(
			"field"		=> "drone_master_propellor_protection",
			"label"		=> "propellor protection",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_master_propellor_protection_val",
			"label"		=> "propellor protection val",
			"rules"		=> "max_length[200]"
		),
		array(
			"field"		=> "drone_master_screwdriver_set",
			"label"		=> "screwdriver set",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_master_screwdriver_set_val",
			"label"		=> "screwdriver set val",
			"rules"		=> "max_length[200]"
		),
		array(
			"field"		=> "drone_master_single_screwdriver",
			"label"		=> "single screwdriver",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_master_single_screwdriver_val",
			"label"		=> "single screwdriver val",
			"rules"		=> "max_length[200]"
		),
		array(
			"field"		=> "drone_master_remote_control",
			"label"		=> "remote control",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_master_remote_control_val",
			"label"		=> "Remote Control",
			"rules"		=> "max_length[200]"
		),
		
		array(
			"field"		=> "drone_master_fpv_monitor",
			"label"		=> "FPV Monitor",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_master_fpv_monitor_val",
			"label"		=> "FPV Monitor Text",
			"rules"		=> "max_length[200]"
		),
		
		array(
			"field"		=> "drone_master_antennas_fpv_monitor",
			"label"		=> "Antennas for FPV Monitor",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_master_antennas_fpv_monitor_val",
			"label"		=> "Antennas for FPV Monitor Text",
			"rules"		=> "max_length[200]"
		),
		
		array(
			"field"		=> "drone_master_batteries_fpv_monitor",
			"label"		=> "Betteries for FPV Monitor",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_master_batteries_fpv_monitor_val",
			"label"		=> "Betteries for FPV Monitor Text",
			"rules"		=> "max_length[200]"
		),
		
		
		array(
			"field"		=> "drone_master_charger_fpv_monitor",
			"label"		=> "Charger for FPV Monitor",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_master_charger_fpv_monitor_val",
			"label"		=> "Charger for FPV Monitor Text",
			"rules"		=> "max_length[200]"
		),
		
		array(
			"field"		=> "drone_master_sun_shades_fpv_monitor",
			"label"		=> "Sun Shades FPV Monitor",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_master_sun_shades_fpv_monitor_val",
			"label"		=> "Sun Shades FPV Monitor Text",
			"rules"		=> "max_length[200]"
		),
		
		array(
			"field"		=> "drone_master_console_fpv_monitor",
			"label"		=> "Console for FPV Monitor",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_master_console_fpv_monitor_val",
			"label"		=> "Console for FPV Monitor Text",
			"rules"		=> "max_length[200]"
		),
		
		array(
			"field"		=> "drone_master_micro_sd_cards",
			"label"		=> "Micro SD Cards",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_master_micro_sd_cards_val",
			"label"		=> "Micro SD Cards Text",
			"rules"		=> "max_length[200]"
		),
		
		array(
			"field"		=> "drone_master_hardcase",
			"label"		=> "Hardcase",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_master_hardcase_val",
			"label"		=> "Hardcase Text",
			"rules"		=> "max_length[200]"
		),
		
		array(
			"field"		=> "drone_master_spare_screws",
			"label"		=> "Spare Screws",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_master_spare_screws_val",
			"label"		=> "Spare Screws Text",
			"rules"		=> "max_length[200]"
		),
	);
	protected $insert_validation_rules 	= array();
	protected $skip_validation 			= FALSE;

	//-----------------------------------------------------------------------------------------------

	public function count_all()
	{
		//$this->db->where($this->table_name);
		return $this->db->count_all_results($this->table_name);
	}

}


