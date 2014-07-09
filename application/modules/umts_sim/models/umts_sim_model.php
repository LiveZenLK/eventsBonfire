<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Umts_sim_model extends BF_Model {

	protected $table_name	= "umts_sim";
	protected $key			= "id";
	protected $soft_deletes	= true;
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
			"field"		=> "umts_sim_simCardName",
			"label"		=> "SIM Card Name",
			"rules"		=> "required|max_length[200]"
		),
		array(
			"field"		=> "umts_sim_puk",
			"label"		=> "PUK",
			"rules"		=> "required|max_length[100]"
		),
		array(
			"field"		=> "umts_sim_pin",
			"label"		=> "PIN",
			"rules"		=> "required|max_length[100]"
		),
		array(
			"field"		=> "umts_sim_simCardNumber",
			"label"		=> "SIM Card Number",
			"rules"		=> "required|unique[bf_umts_sim.simCardNumber,bf_umts_sim.id]|max_length[200]"
		),
		array(
			"field"		=> "umts_sim_telephoneNumber",
			"label"		=> "Telephone Number",
			"rules"		=> "unique[bf_umts_sim.telephoneNumber,bf_umts_sim.id]|max_length[20]"
		),
		array(
			"field"		=> "umts_sim_balance",
			"label"		=> "Balance",
			"rules"		=> "max_length[11]"
		),
		array(
			"field"		=> "umts_sim_comment",
			"label"		=> "Comment",
			"rules"		=> "max_length[1000]"
		),
	);
	protected $insert_validation_rules 	= array();
	protected $skip_validation 			= FALSE;

	//--------------------------------------------------------------------

	public function count_all()
	{
			$this->db->where($this->table_name . '.deleted', 0);
			return $this->db->count_all_results($this->table_name);
	}//end count_all()	
}
