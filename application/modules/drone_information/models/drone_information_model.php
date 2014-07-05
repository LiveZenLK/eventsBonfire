<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Drone_information_model extends BF_Model {

	protected $table_name	= "drone_information";
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
			"field"		=> "drone_information_drone_customer",
			"label"		=> "Customer",
			"rules"		=> "required|max_length[10]"
		),
		array(
			"field"		=> "drone_information_issueDate",
			"label"		=> "Issue Date",
			"rules"		=> "required|max_length[50]"
		),
		array(
			"field"		=> "drone_information_returnDate",
			"label"		=> "Return Date",
			"rules"		=> "max_length[50]"
		),
		array(
			"field"		=> "drone_information_issueBy",
			"label"		=> "Issue By",
			"rules"		=> "required|max_length[10]"
		),
		array(
			"field"		=> "drone_information_receivedBy",
			"label"		=> "Received By",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_information_status",
			"label"		=> "Status",
			"rules"		=> "required|max_length[10]"
		),
		array(
			"field"		=> "drone_information_drone_set_type",
			"label"		=> "Set Type",
			"rules"		=> "required|max_length[50]"
		),
		array(
			"field"		=> "drone_information_djiphantom",
			"label"		=> "DJI Phantom",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_information_djiphantom_Val",
			"label"		=> "DJI Phantom Text",
			"rules"		=> "max_length[200]"
		),
		array(
			"field"		=> "drone_information_zenmuseh_gimbal",
			"label"		=> "Zenmuse Gimbal",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_information_zenmuseh_gimbal_val",
			"label"		=> "Zenmuse Gimbal Text",
			"rules"		=> "max_length[200]"
		),
		array(
			"field"		=> "drone_information_geprohero",
			"label"		=> "Gepro Hero Silver",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_information_geprohero_val",
			"label"		=> "Gepro Hero Silver Text",
			"rules"		=> "max_length[200]"
		),
		array(
			"field"		=> "drone_information_propellers",
			"label"		=> "Sets propellers",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_information_propellers_val",
			"label"		=> "Sets propellers Text",
			"rules"		=> "max_length[200]"
		),
		array(
			"field"		=> "drone_information_phantom_batteries",
			"label"		=> "Phantom Batteries",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_information_phantom_batteries_val",
			"label"		=> "Phantom Batteries Text",
			"rules"		=> "max_length[200]"
		),
		array(
			"field"		=> "drone_information_phantom_chargers",
			"label"		=> "Phantom Chargers",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_information_phantom_chargers_val",
			"label"		=> "Phantom Chargers Text",
			"rules"		=> "max_length[200]"
		),
		array(
			"field"		=> "drone_information_propellor_protection",
			"label"		=> "Propellor Protection",
			"rules"		=> "max_length[10]"
		),
		
		// ===========================Custom Fields===============================================
		array(
			"field"		=> "drone_information_propellor_protection_val",
			"label"		=> "Propellor Protection Text",
			"rules"		=> "max_length[200]"
		),
		
		array(
			"field"		=> "drone_information_screwdriver_set",
			"label"		=> "Screwdriver Set",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_information_screwdriver_set_val",
			"label"		=> "Screwdriver Set Text",
			"rules"		=> "max_length[200]"
		),
		
		
		array(
			"field"		=> "drone_information_single_screwdriver",
			"label"		=> "Single Screwdriver Set",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_information_single_screwdriver_val",
			"label"		=> "Single Screwdriver Set Text",
			"rules"		=> "max_length[200]"
		),
		
		
		array(
			"field"		=> "drone_information_remote_control",
			"label"		=> "Remote Control",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_information_remote_control_val",
			"label"		=> "Remote Control",
			"rules"		=> "max_length[200]"
		),
		
		array(
			"field"		=> "drone_information_fpv_monitor",
			"label"		=> "FPV Monitor",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_information_fpv_monitor_val",
			"label"		=> "FPV Monitor Text",
			"rules"		=> "max_length[200]"
		),
		
		array(
			"field"		=> "drone_information_antennas_fpv_monitor",
			"label"		=> "Antennas for FPV Monitor",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_information_antennas_fpv_monitor_val",
			"label"		=> "Antennas for FPV Monitor Text",
			"rules"		=> "max_length[200]"
		),
		
		array(
			"field"		=> "drone_information_batteries_fpv_monitor",
			"label"		=> "Betteries for FPV Monitor",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_information_batteries_fpv_monitor_val",
			"label"		=> "Betteries for FPV Monitor Text",
			"rules"		=> "max_length[200]"
		),
		
		
		array(
			"field"		=> "drone_information_charger_fpv_monitor",
			"label"		=> "Charger for FPV Monitor",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_information_charger_fpv_monitor_val",
			"label"		=> "Charger for FPV Monitor Text",
			"rules"		=> "max_length[200]"
		),
		
		array(
			"field"		=> "drone_information_sun_shades_fpv_monitor",
			"label"		=> "Sun Shades FPV Monitor",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_information_sun_shades_fpv_monitor_val",
			"label"		=> "Sun Shades FPV Monitor Text",
			"rules"		=> "max_length[200]"
		),
		
		array(
			"field"		=> "drone_information_console_fpv_monitor",
			"label"		=> "Console for FPV Monitor",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_information_console_fpv_monitor_val",
			"label"		=> "Console for FPV Monitor Text",
			"rules"		=> "max_length[200]"
		),
		
		array(
			"field"		=> "drone_information_micro_sd_cards",
			"label"		=> "Micro SD Cards",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_information_micro_sd_cards_val",
			"label"		=> "Micro SD Cards Text",
			"rules"		=> "max_length[200]"
		),
		
		array(
			"field"		=> "drone_information_hardcase",
			"label"		=> "Hardcase",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_information_hardcase_val",
			"label"		=> "Hardcase Text",
			"rules"		=> "max_length[200]"
		),
		
		array(
			"field"		=> "drone_information_spare_screws",
			"label"		=> "Spare Screws",
			"rules"		=> "max_length[10]"
		),
		array(
			"field"		=> "drone_information_spare_screws_val",
			"label"		=> "Spare Screws Text",
			"rules"		=> "max_length[200]"
		),
		
		array(
			"field"		=> "drone_information_job",
			"label"		=> "Job",
			"rules"		=> "max_length[200]"
		),
	);
	protected $insert_validation_rules 	= array();
	protected $skip_validation 			= FALSE;

	//--------------------------------------------------------------------
	public function count_all()
		{
			//$this->db->where($this->table_name);
			return $this->db->count_all_results($this->table_name);
		}
	

}
