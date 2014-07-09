<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class issueset extends Admin_Controller
{

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Issue_Mobile.Issueset.View');
		$this->load->model('issue_mobile_model', null, true);
		$this->lang->load('issue_mobile');
		
			Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
			Assets::add_js('jquery-ui-1.8.13.min.js');
			Assets::add_js('select2.min.js');
		Template::set_block('sub_nav', 'issueset/_sub_nav');

		Assets::add_module_js('issue_mobile', 'issue_mobile.js');
		Assets::add_module_css('issue_mobile', 'table.css');
	}

   //================================================================================================

	public function index($offset = 0)
	{

		// Deleting anything?
		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$result = FALSE;
				foreach ($checked as $pid)
				{
					$result = $this->issue_mobile_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('issue_mobile_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('issue_mobile_delete_failure') . $this->issue_mobile_model->error, 'error');
				}
			}
		}

	 //---------------------------- Search items -----------------------------------
		if (isset($_POST['search'])) 
		 {
			
			if ($_POST['searchType'] == 'name') 
			 {
				$query = '
				select bf_issue_mobile.*
				from bf_issue_mobile inner join bf_customers
				on bf_issue_mobile.parentCustomer = bf_customers.id
				where bf_customers.name like "%' . $_POST['searchString'] . '%" and bf_issue_mobile.`status`="Issue";
				';
				$results = $this -> db -> query($query);
				$records = $results -> result();
			 } 
			else if ($_POST['searchType'] == 'serialno') 
			 {
				$query = '
				select bf_issue_mobile.*
				from bf_issue_mobile inner join bf_mobile
				on bf_issue_mobile.parentMobile = bf_mobile.id
				where bf_mobile.serialNumber like "%' . $_POST['searchString'] . '%" and bf_issue_mobile.`status`="Issue";
				';
				$results = $this -> db -> query($query);
				$records = $results -> result();
			 } 
			
			else if ($_POST['searchType'] == 'imeino') 
			 {
			 	
				$query = '
				select bf_issue_mobile.*
				from bf_issue_mobile inner join bf_mobile
				on bf_issue_mobile.parentMobile = bf_mobile.id
				where bf_mobile.imeiNumber like "%' . $_POST['searchString'] . '%" and bf_issue_mobile.`status`="Issue";
				';
				$results = $this -> db -> query($query);
				$records = $results -> result();
			 } 
			else if ($_POST['searchType'] == 'phoneno') 
			 {
				$query = '
				select bf_issue_mobile.*
				from bf_issue_mobile inner join bf_sim_info
				on bf_issue_mobile.parentSim = bf_sim_info.id
				where bf_sim_info.telephoneNumber like "%' . $_POST['searchString'] . '%" and bf_issue_mobile.status="Issue";';
				$results = $this -> db -> query($query);
				$records = $results -> result();
			 } 
			
			else 
			 {
				$records = $this -> issue_mobile_model -> find_all_by("status", "Issue");
			 }
		 } 
       //---------------------------- Search items -----------------------------------
			else 
				{
					$records = $this->issue_mobile_model->find_all_by("status","Issue");
				}

                $userlist = array ();
                $mobileList = array();
                $simList = array();
                $users = $this->user_model->find_all();
                $mobiles=$this->load->model('mobile/mobile_model')->find_all();
                $sims=$this->load->model('sim_info/sim_info_model')->find_all();
				$customers = $this->load->model('customers/customers_model')->find_all();
					$customersList = array();
					 if($customers)
					  {
					 	foreach($customers as $customer):
						$customersList[$customer->id] = $customer;
					    endforeach;
					  }
					
					
	                foreach ($users as $user)
	                {
	                    $userlist[$user->id]=$user;
	                }
					
				
					if($mobiles)
					 {
	                foreach ($mobiles as $mobile)
		                {
		                    $mobileList[$mobile->id]=$mobile;
		                }
					 }
				
					if($sims)
					{
		                foreach ($sims as $sim)
		                 {
		                    $simList[$sim->id]=$sim;
		                 }
					}
					
					
		 //======================================= Pagination =============================================
				
			$this -> load -> library('pagination');
			$total_users = count($records);
			$config['base_url'] = site_url(SITE_AREA . "/issueset/issue_mobile/index/");
			$config['total_rows'] = $total_users;
			$config['per_page'] = $this -> limit;
			$config['uri_segment'] = 5;
			$this -> pagination -> initialize($config);
	
			if($records)
			{
			Template::set('records', array_splice($records, $offset, $this -> limit));
			}
			else {
			Template::set('records',$records);
			}
			Template::set('index_url', site_url(SITE_AREA . '/issueset/issue_mobile/index/') . '/');
					
      //======================================= Pagination ===============================================
					
					
				Template::set('customers', $customersList);	
                Template::set('userslist', $userlist);
                Template::set('mobilelist', $mobileList);
                Template::set('simlist', $simList);
				Template::set('toolbar_title', 'Manage Issue Mobile');
				Template::render();
	}

	//--------------------------------------------------------------------


	public function create()
	{
		$this->auth->restrict('Issue_Mobile.Issueset.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_issue_mobile())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('issue_mobile_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'issue_mobile');

				Template::set_message(lang('issue_mobile_create_success'), 'success');
				redirect(SITE_AREA .'/issueset/issue_mobile');
			}
			else
			{
				Template::set_message(lang('issue_mobile_create_failure') . $this->issue_mobile_model->error, 'error');
			}
		}
		Assets::add_module_js('issue_mobile', 'issue_mobile.js');
               
			   
			    $sql = "SELECT distinct bf_customers.id,bf_customers.name 
                FROM bf_customers 
                LEFT JOIN  bf_issue_mobile  ON bf_customers.id = bf_issue_mobile.parentCustomer 
                WHERE 
                bf_customers.id NOT IN (select parentCustomer from bf_issue_mobile where status = 'Issue')
                and
                bf_customers.id NOT IN(select bf_customers.id from bf_customers where bf_customers.deleted=1)";
                
                
                $admin = "SELECT * FROM bf_users WHERE role_id = ?";
                
                
                $mobile="SELECT distinct bf_mobile.id,bf_mobile.articleDescription,imeiNumber 
                FROM bf_mobile 
                LEFT JOIN  bf_issue_mobile  ON bf_mobile.id = bf_issue_mobile.parentMobile 
                WHERE 
                bf_mobile.id NOT IN (select parentMobile from bf_issue_mobile where status = 'Issue')
                and
                bf_mobile.id NOT IN(select bf_mobile.id from bf_mobile where bf_mobile.deleted=1)";
				
                $sim="SELECT distinct bf_sim_info.id,bf_sim_info.simCardName,bf_sim_info.telephoneNumber
                FROM bf_sim_info 
                LEFT JOIN  bf_issue_mobile  ON bf_sim_info.id = bf_issue_mobile.parentSim
                WHERE 
                bf_sim_info.id NOT IN (select parentSim from bf_issue_mobile where status = 'Issue')
                and
                bf_sim_info.id NOT IN (select bf_sim_info.id from bf_sim_info where bf_sim_info.deleted=1)";
                
                $myList = $this->db->query($sql);
                $adminList = $this->db->query($admin, array(8));
                $mobileList = $this->db->query($mobile);
                $simList = $this->db->query($sim);
                Template::set('users', $myList->result());
                Template::set('admins', $adminList->result());
                Template::set('mobiles', $mobileList->result());
                Template::set('sims', $simList->result());
				Template::set('toolbar_title', lang('issue_mobile_create') . ' Issue Mobile');
				Template::render();
	}

	//--------------------------------------------------------------------

	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('issue_mobile_invalid_id'), 'error');
			redirect(SITE_AREA .'/issueset/issue_mobile');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Issue_Mobile.Issueset.Edit');

			if ($this->save_issue_mobile('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('issue_mobile_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'issue_mobile');

				Template::set_message(lang('issue_mobile_edit_success'), 'success');
                                redirect(SITE_AREA .'/issueset/issue_mobile');
			}
			else
			{
				Template::set_message(lang('issue_mobile_edit_failure') . $this->issue_mobile_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Issue_Mobile.Issueset.Delete');

			if ($this->issue_mobile_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('issue_mobile_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'issue_mobile');

				Template::set_message(lang('issue_mobile_delete_success'), 'success');

				redirect(SITE_AREA .'/issueset/issue_mobile');
			}
			else
			{
				Template::set_message(lang('issue_mobile_delete_failure') . $this->issue_mobile_model->error, 'error');
			}
		}
                //$sql1 = "SELECT * FROM bf_users WHERE role_id = ?";
                $customers ="SELECT bf_customers.id,bf_customers.name 
                from bf_customers,bf_issue_mobile 
                where bf_customers.id=bf_issue_mobile.parentCustomer
                and bf_issue_mobile.id=? ";
                
				
                $mobiles="select distinct bf_mobile.id,bf_mobile.articleDescription,imeiNumber
                from bf_mobile left join bf_issue_mobile
                on
                bf_mobile.id = bf_issue_mobile.parentMobile
                where
                bf_mobile.id not in(select parentMobile from bf_issue_mobile where parentMobile not in(select parentMobile from bf_issue_mobile where id=? and status='issue'))
                and
                bf_mobile.id NOT IN(select bf_mobile.id from bf_mobile where bf_mobile.deleted=1)";
                
				
                $sims="select distinct bf_sim_info.id,bf_sim_info.simCardName,bf_sim_info.telephoneNumber
                from bf_sim_info left join bf_issue_mobile
                on
                bf_sim_info.id = bf_issue_mobile.parentSim
                where
                bf_sim_info.id not in(select parentSim from bf_issue_mobile where parentSim not in(select parentSim from bf_issue_mobile where id=?) and status='issue')
                 and
                bf_sim_info.id NOT IN (select bf_sim_info.id from bf_sim_info where bf_sim_info.deleted=1)";
                
                
                $admin = "SELECT * FROM bf_users WHERE role_id = ?";
                
                $CustomerList = $this->db->query($customers, array($id));
                $mobileLists= $this->db->query($mobiles, array($id));
                $simLists= $this->db->query($sims, array($id));
                $adminList = $this->db->query($admin, array(8));
                Template::set('admins', $adminList->result());
                Template::set('cutomers', $CustomerList->result());
                Template::set('mobiles', $mobileLists->result());
                Template::set('sims', $simLists->result());
				Template::set('issue_mobile', $this->issue_mobile_model->find($id));
				Template::set('toolbar_title', lang('issue_mobile_edit') .' Issue Mobile');
				Template::render();
	}

	//--------------------------------------------------------------------

	private function save_issue_mobile($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['parentCustomer']        = $this->input->post('issue_mobile_parentCustomer');
		$data['parentMobile']        = $this->input->post('issue_mobile_parentMobile');
		$data['parentSim']        = $this->input->post('issue_mobile_parentSim');
		$data['status']        = $this->input->post('issue_mobile_status');
		$data['charger']        = $this->input->post('issue_mobile_charger');
		$data['usbCable']        = $this->input->post('issue_mobile_usbCable');
		$data['issueDate']        = $this->input->post('issue_mobile_issueDate') ? $this->input->post('issue_mobile_issueDate') : '0000-00-00';
		$data['returnDate']        = $this->input->post('issue_mobile_returnDate') ? $this->input->post('issue_mobile_returnDate') : '0000-00-00';
		$data['issueBy']        = $this->current_user->id;

		if ($type == 'insert')
		{
			$id = $this->issue_mobile_model->insert($data);

			if (is_numeric($id))
			{
				$return = $id;
			}
			else
			{
				$return = FALSE;
			}
		}
		elseif ($type == 'update')
		{
			$return = $this->issue_mobile_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------------------------------
	
	
		function view_detail()
		{
             $id = $this->uri->segment(5);
			 
			    $customers ="SELECT bf_customers.id,bf_customers.name 
                from bf_customers,bf_issue_mobile 
                where bf_customers.id=bf_issue_mobile.parentCustomer
                and bf_issue_mobile.id=? ";
                
                $admin = "SELECT * FROM bf_users WHERE role_id = ?";
                
				
			    $userlist = array ();
                $users = $this->user_model->find_all();
                if($users)
				{
	                foreach ($users as $user)
	                {
	                    $userlist[$user->id]=$user;
	                }
				}
				
				
				$mobilearray = array ();
				$mobiles = $this->load->model('mobile/mobile_model')->find_all();
                if($mobiles)
                {
	                foreach ($mobiles as $mobile)
	                {
	                    $mobilearray[$mobile->id]=$mobile;
	                }
				}
				
				
				$simarray = array ();
				$sims = $this->load->model('sim_info/sim_info_model')->find_all();
                foreach ($sims as $sim)
                {
                    $simarray[$sim->id]=$sim;
                }
				
				$CustomerList = $this->db->query($customers, array($id));
                Template::set('cutomers', $CustomerList->result());
				$adminList = $this->db->query($admin, array(8));
				
                Template::set('admins', $adminList->result());
                Template::set('mobiles', $mobilearray);
                Template::set('sims', $simarray);
                Template::set('userslist', $userlist);
                Template::set('issue_mobile', $this->issue_mobile_model->find($id));
                $list = $this->issue_mobile_model->find($id);
				Template::set('toolbar_title', ' Issue Mobile');
                Template::render();
				
		}
    // ====================================================================================================
    
    public function returnsets($offset = 0)
	{
		// Deleting anything?
		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$result = FALSE;
				foreach ($checked as $pid)
				{
					$result = $this->issue_mobile_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('issue_mobile_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('issue_mobile_delete_failure') . $this->issue_mobile_model->error, 'error');
				}
			}
		}
		
	//-----------------Search----------------------------
		if (isset($_POST['search'])) 
		 {
			
			if ($_POST['searchType'] == 'name') 
			 {
				$query = '
				select bf_issue_mobile.*
				from bf_issue_mobile inner join bf_customers
				on bf_issue_mobile.parentCustomer = bf_customers.id
				where bf_customers.name like "%' . $_POST['searchString'] . '%" and bf_issue_mobile.`status`="Return";
				';
				$results = $this -> db -> query($query);
				$records = $results -> result();
			 } 
			else if ($_POST['searchType'] == 'serialno') 
			 {
				$query = '
				select bf_issue_mobile.*
				from bf_issue_mobile inner join bf_mobile
				on bf_issue_mobile.parentMobile = bf_mobile.id
				where bf_mobile.serialNumber like "%' . $_POST['searchString'] . '%" and bf_issue_mobile.`status`="Return";
				';
				$results = $this -> db -> query($query);
				$records = $results -> result();
			 } 
			
			else if ($_POST['searchType'] == 'imeino') 
			 {
				$query = '
				select bf_issue_mobile.*
				from bf_issue_mobile inner join bf_mobile
				on bf_issue_mobile.parentMobile = bf_mobile.id
				where bf_mobile.imeiNumber like "%' . $_POST['searchString'] . '%" and bf_issue_mobile.`status`="Return";
				';
				$results = $this -> db -> query($query);
				$records = $results -> result();
			 } 
			
			else if ($_POST['searchType'] == 'phoneno') 
			 {
				$query = '
				select bf_issue_mobile.*
				from bf_issue_mobile inner join bf_sim_info
				on bf_issue_mobile.parentSim = bf_sim_info.id
				where bf_sim_info.telephoneNumber like "%' . $_POST['searchString'] . '%" and bf_issue_mobile.status="Issue";';
				$results = $this -> db -> query($query);
				$records = $results -> result();
			 } 

			else 
			 {
				$records = $this -> issue_mobile_model -> find_all_by("status", "Return");
			 }
		 } 
	//----------------------------------Search----------------------------------------------
			else 
			{
				$records = $this->issue_mobile_model->find_all_by("status","Return");
			}
                
                $userlist = array ();
                $mobileList = array();
                $simList = array();
                $users = $this->user_model->find_all();
                $mobiles=$this->load->model('mobile/mobile_model')->find_all();
                $sims=$this->load->model('sim_info/sim_info_model')->find_all();
				$customers = $this->load->model('customers/customers_model')->find_all();
					$customersList = array();
					 if($customers)
					  {
					 	foreach($customers as $customer):
						$customersList[$customer->id] = $customer;
					    endforeach;
					  }
					
					
	                foreach ($users as $user)
	                {
	                    $userlist[$user->id]=$user;
	                }
					
				
					if($mobiles)
					 {
	                foreach ($mobiles as $mobile)
		                {
		                    $mobileList[$mobile->id]=$mobile;
		                }
					 }
				
					if($sims)
					{
		                foreach ($sims as $sim)
		                 {
		                    $simList[$sim->id]=$sim;
		                 }
					}
		//======================================= Pagination =============================================
				
			$this -> load -> library('pagination');
			$total_users = count($records);
			$this -> pager['base_url'] = site_url(SITE_AREA . "/issueset/issue_mobile/returnsets/");
			$this -> pager['total_rows'] = $total_users;
			$this -> pager['per_page'] = $this -> limit;
			$this -> pager['uri_segment'] = 5;
			$this -> pagination -> initialize($this -> pager);
	
			if($records)
			{
			Template::set('records', array_splice($records, $offset, $this -> limit));
			}
			else {
			Template::set('records',$records);
			}
			Template::set('index_url', site_url(SITE_AREA . '/issueset/issue_mobile/returnsets/') . '/');
					
      //======================================= Pagination ===============================================
					
				Template::set('customers', $customersList);	
                Template::set('userslist', $userlist);
                Template::set('mobilelist', $mobileList);
                Template::set('simlist', $simList);
				Template::set('toolbar_title', 'Return Mobile');
				Template::render();
	}
  // =====================================================================================================   
  
}