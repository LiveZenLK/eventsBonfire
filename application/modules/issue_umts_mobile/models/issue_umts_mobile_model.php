<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Issue_umts_mobile_model extends BF_Model {

	protected $table_name	= "issue_umts_mobile";
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
			"field"		=> "issue_umts_mobile_parentCustomer",
			"label"		=> "Customer Name",
			"rules"		=> "required|max_length[300]"
		),
		array(
			"field"		=> "issue_umts_mobile_parentMobile",
			"label"		=> "Mobile",
			"rules"		=> "max_length[300]"
		),
		array(
			"field"		=> "issue_umts_mobile_parentSim",
			"label"		=> "Sim",
			"rules"		=> "max_length[300]"
		),
		array(
			"field"		=> "issue_umts_mobile_status",
			"label"		=> "Status",
			"rules"		=> "required|max_length[20]"
		),
		
		array(
			"field"		=> "issue_umts_mobile_charger",
			"label"		=> "Charger",
			"rules"		=> "max_length[20]"
		),
		array(
			"field"		=> "issue_umts_mobile_usbCable",
			"label"		=> "USB Cable",
			"rules"		=> "max_length[20]"
		),
		array(
			"field"		=> "issue_umts_mobile_issueDate",
			"label"		=> "Issue Date",
			"rules"		=> "required|max_length[50]"
		),
		array(
			"field"		=> "issue_umts_mobile_returnDate",
			"label"		=> "Return Date",
			"rules"		=> "max_length[50]"
		),
		array(
			"field"		=> "issue_umts_mobile_parentAdmin",
			"label"		=> "Issued By",
			"rules"		=> "max_length[300]"
		),
	);
	protected $insert_validation_rules 	= array();
	protected $skip_validation 			= FALSE;

	//--------------------------------------------------------------------

        function customerList()
        {
            $sql = "SELECT distinct bf_customers.id,bf_customers.name 
                FROM bf_customers 
                LEFT JOIN  bf_issue_umts_mobile  ON bf_customers.id = bf_issue_umts_mobile.parentCustomer 
                WHERE 
                bf_customers.id NOT IN (select parentCustomer from bf_issue_umts_mobile where status = 'Issue')
                and
                bf_customers.id NOT IN(select bf_customers.id from bf_customers where bf_customers.deleted=1)";
                $myList = $this->db->query($sql);
                return $myList;
         
        }
        
        
        function mobileList()
        {
                $mobile="SELECT distinct bf_umts_stick.id,bf_umts_stick.articleDescription,imeiNumber 
                FROM bf_umts_stick
                LEFT JOIN  bf_issue_umts_mobile  ON bf_umts_stick.id = bf_issue_umts_mobile.parentMobile 
                WHERE 
                bf_umts_stick.id NOT IN (select parentMobile from bf_issue_umts_mobile where status = 'Issue')
                and
                bf_umts_stick.id NOT IN (select bf_umts_stick.id from bf_umts_stick where bf_umts_stick.deleted=1)";
                $mobilelist = $this->db->query($mobile);
                return $mobilelist;
        }
        
        
        
        function simList()
        {
            $sim="SELECT distinct bf_umts_sim.id,bf_umts_sim.simCardName,bf_umts_sim.telephoneNumber
            FROM bf_umts_sim 
            LEFT JOIN  bf_issue_umts_mobile  ON bf_umts_sim.id = bf_issue_umts_mobile.parentSim
            WHERE 
            bf_umts_sim.id NOT IN (select parentSim from bf_issue_umts_mobile where status = 'Issue')
            and
             bf_umts_sim.id NOT IN(select bf_umts_sim.id from bf_umts_sim where bf_umts_sim.deleted=1)";
            $simlist = $this->db->query($sim);
             return $simlist;
        }
        
        function adminList()
        {
            $admin = "SELECT * FROM bf_users WHERE role_id = ?";
            $adminList = $this->db->query($admin, array(8));
            return $adminList;
        }
        
        
}
