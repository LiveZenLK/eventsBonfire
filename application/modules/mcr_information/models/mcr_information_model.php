<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mcr_information_model extends BF_Model {

	protected $table_name	= "mcr_information";
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
			"field"		=> "mcr_information_parentCustomer",
			"label"		=> "Select Customer",
			"rules"		=> "required|max_length[100]"
		),
		array(
			"field"		=> "mcr_information_parentMcr",
			"label"		=> "Issued By",
			"rules"		=> "required|max_length[200]"
		),
		array(
			"field"		=> "mcr_information_issueDate",
			"label"		=> "Issue Date",
			"rules"		=> "required|max_length[50]"
		),
		array(
			"field"		=> "mcr_information_status",
			"label"		=> "Status",
			"rules"		=> "required|max_length[50]"
		),
		array(
			"field"		=> "mcr_information_receivedBy",
			"label"		=> "Received By",
			"rules"		=> "max_length[200]"
		),
		array(
			"field"		=> "mcr_information_returnDate",
			"label"		=> "Return Date",
			"rules"		=> "max_length[50]"
		),
		array(
			"field"		=> "mcr_information_type",
			"label"		=> "Set Type",
			"rules"		=> "max_length[50]"
		),
   //------------------------------------------------------------------------------------------------------
            // these fields are created manually.....
           
            
            array(
			"field"		=> "mcr_information_panasonic_HCV700",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
            
            array(
			"field"		=> "mcr_information_V700",
			"label"		=> "",
			"rules"		=> "max_length[200]"
		),
            array(
			"field"		=> "mcr_information_microphone_rode",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
            array(
			"field"		=> "mcr_information_macbook13",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
            array(
			"field"		=> "mcr_information_mac13",
			"label"		=> "",
			"rules"		=> "max_length[200]"
		),
            array(
			"field"		=> "mcr_information_panasonic_HCV727",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
            array(
			"field"		=> "mcr_information_V727",
			"label"		=> "",
			"rules"		=> "max_length[200]"
		),
            array(
			"field"		=> "mcr_information_extension_cable",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
            array(
			"field"		=> "mcr_information_macbook15",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
            array(
			"field"		=> "mcr_information_camera_checkbox1",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
            array(
			"field"		=> "mcr_information_camera_value1",
			"label"		=> "",
			"rules"		=> "max_length[200]"
		),
            array(
			"field"		=> "mcr_information_audio_checkbox1",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
            array(
			"field"		=> "mcr_information_audio_value1",
			"label"		=> "",
			"rules"		=> "max_length[200]"
		),
            array(
			"field"		=> "mcr_information_recorder_sony_PMW50",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
            
            array(
			"field"		=> "mcr_information_camera_checkbox2",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
            array(
			"field"		=> "mcr_information_camera_value2",
			"label"		=> "",
			"rules"		=> "max_length[200]"
		),
            array(
			"field"		=> "mcr_information_audio_checkbox2",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
            array(
			"field"		=> "mcr_information_audio_value2",
			"label"		=> "",
			"rules"		=> "max_length[200]"
		),
            array(
			"field"		=> "mcr_information_aja_interface",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
            
             array(
			"field"		=> "mcr_information_camera_checkbox3",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
             array(
			"field"		=> "mcr_information_camera_value3",
			"label"		=> "",
			"rules"		=> "max_length[200]"
		),
             array(
			"field"		=> "mcr_information_sxs_card_reader",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
             array(
			"field"		=> "mcr_information_liveu",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
             array(
			"field"		=> "mcr_information_thunderbold_SSD_cable",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
             array(
			"field"		=> "mcr_information_SD_card_amount",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
             array(
			"field"		=> "mcr_information_sccard_amount",
			"label"		=> "",
			"rules"		=> "max_length[200]"
		),
             array(
			"field"		=> "mcr_information_minicaster",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
             array(
			"field"		=> "mcr_information_mac_charger",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
             array(
			"field"		=> "mcr_information_mini_sd_card",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
             array(
			"field"		=> "mcr_information_mini_sd_card_amount",
			"label"		=> "",
			"rules"		=> "max_length[200]"
		),
             array(
			"field"		=> "mcr_information_newsspotter",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
             array(
			"field"		=> "mcr_information_peripherals_checkbox1",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
             array(
			"field"		=> "mcr_information_peripherals_value1",
			"label"		=> "",
			"rules"		=> "max_length[200]"
		),
             array(
			"field"		=> "mcr_information_sd_card_adaptor",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
             array(
			"field"		=> "mcr_information_BGAN_explorer",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
             array(
			"field"		=> "mcr_information_peripherals_checkbox2",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
             array(
			"field"		=> "mcr_information_peripherals_value2",
			"label"		=> "",
			"rules"		=> "max_length[200]"
		),
             array(
			"field"		=> "mcr_information_battery_700_small",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
            
            array(
			"field"		=> "mcr_information_battery_700_small_amount",
			"label"		=> "",
			"rules"		=> "max_length[200]"
		),
            
            array(
			"field"		=> "mcr_information_cullmann_magnesit",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
            
            
            array(
			"field"		=> "mcr_information_walkie_talkie",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
            array(
			"field"		=> "mcr_information_battery_700_big",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
            array(
			"field"		=> "mcr_information_battery_700_big_amount",
			"label"		=> "",
			"rules"		=> "max_length[200]"
		),
            array(
			"field"		=> "mcr_information_cullmann_nanomax",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
            array(
			"field"		=> "mcr_information_first_aid_kit",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
            array(
			"field"		=> "mcr_information_battery_727VWVBT190",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
            array(
			"field"		=> "mcr_information_battery_727VWVBT190_amount",
			"label"		=> "",
			"rules"		=> "max_length[200]"
		),
            array(
			"field"		=> "mcr_information_tripods_checkbox1",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
            array(
			"field"		=> "mcr_information_backpack",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
            array(
			"field"		=> "mcr_information_battery_727VWVBT380",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
            array(
			"field"		=> "mcr_information_battery_727VWVBT380_amount",
			"label"		=> "",
			"rules"		=> "max_length[200]"
		),
            array(
			"field"		=> "mcr_information_tripods_checkbox2",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
            
            
            
             array(
			"field"		=> "mcr_information_tripods_value2",
			"label"		=> "",
			"rules"		=> "max_length[200]"
		),
             array(
			"field"		=> "mcr_information_miscellaneous_checkbox1",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
             array(
			"field"		=> "mcr_information_miscellaneous_value1",
			"label"		=> "",
			"rules"		=> "max_length[200]"
		),
             array(
			"field"		=> "mcr_information_battery_handycam",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
             array(
			"field"		=> "mcr_information_battery_handycam_amount",
			"label"		=> "",
			"rules"		=> "max_length[200]"
		),
             array(
			"field"		=> "mcr_information_tripods_checkbox3",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
             array(
			"field"		=> "mcr_information_tripods_value3",
			"label"		=> "",
			"rules"		=> "max_length[200]"
		),
             array(
			"field"		=> "mcr_information_miscellaneous_checkbox2",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
             array(
			"field"		=> "mcr_information_miscellaneous_value2",
			"label"		=> "",
			"rules"		=> "max_length[200]"
		),
             array(
			"field"		=> "mcr_information_charger_patona",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
             array(
			"field"		=> "mcr_information_tripods_checkbox4",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
             array(
			"field"		=> "mcr_information_tripods_value4",
			"label"		=> "",
			"rules"		=> "max_length[200]"
		),
             array(
			"field"		=> "mcr_information_miscellaneous_checkbox3",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
             array(
			"field"		=> "mcr_information_miscellaneous_value3",
			"label"		=> "",
			"rules"		=> "max_length[200]"
		),
             array(
			"field"		=> "mcr_information_charger_panasonic_VSK0781SND3BMT",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
             array(
			"field"		=> "mcr_information_tripods_checkbox5",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
            
            
            
             array(
			"field"		=> "mcr_information_tripods_value5",
			"label"		=> "",
			"rules"		=> "max_length[200]"
		),
             array(
			"field"		=> "mcr_information_miscellaneous_checkbox4",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
             array(
			"field"		=> "mcr_information_miscellaneous_value4",
			"label"		=> "",
			"rules"		=> "max_length[200]"
		),
             array(
			"field"		=> "mcr_information_Battery_small_panasonic",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
             array(
			"field"		=> "mcr_information_batterysmallpanasonic",
			"label"		=> "",
			"rules"		=> "max_length[200]"
		),
            
            array(
			"field"		=> "mcr_information_one_cam_charger_panasonic",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
            array(
			"field"		=> "mcr_information_onecamchargerpanasonic",
			"label"		=> "",
			"rules"		=> "max_length[200]"
		),
            array(
			"field"		=> "mcr_information_one_battery_small_panasonic",
			"label"		=> "",
			"rules"		=> "max_length[10]"
		),
            array(
			"field"		=> "mcr_information_onebatterysmallpanasonic",
			"label"		=> "",
			"rules"		=> "max_length[200]"
		),
		
		array(
			"field"		=> "mcr_information_job",
			"label"		=> "Job",
			"rules"		=> "max_length[200]"
		),
            
	);
	protected $insert_validation_rules 	= array();
	protected $skip_validation 			= FALSE;

	//--------------------------------------------------------------------

        
        public function getCustomer($searchString)
        {
         $query = "select bf_users.username,bf_mcr_information.*
                   from bf_mcr_information,bf_users
                   where
                   bf_mcr_information.status='Issue'
                   and
                   bf_users.id=bf_mcr_information.parentCustomer
                   and
                   bf_users.username like '%ra%' "; 
         
                   $cutomers = $this->db->query($query);
		   return $cutomers->result();
        }
}
