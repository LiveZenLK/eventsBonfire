<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class issueset extends Admin_Controller
{

	//--------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Issue_UMTS_Mobile.Issueset.View');
		$this->load->model('issue_umts_mobile_model', null, true);
		$this->lang->load('issue_umts_mobile');
		
			Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
			Assets::add_js('jquery-ui-1.8.13.min.js');
		Template::set_block('sub_nav', 'issueset/_sub_nav');

		Assets::add_module_js('issue_umts_mobile', 'issue_umts_mobile.js');
		Assets::add_module_css('issue_umts_mobile', 'table.css');
	}

	//--------------------------------------------------------------------


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
					$result = $this->issue_umts_mobile_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('issue_umts_mobile_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('issue_umts_mobile_delete_failure') . $this->issue_umts_mobile_model->error, 'error');
				}
			}
		}
		
		 //---------------------------- Search items -----------------------------------
		if (isset($_POST['search'])) 
		 {
			
			if ($_POST['searchType'] == 'name') 
			 {
				$query = '
				select bf_issue_umts_mobile.*
				from bf_issue_umts_mobile inner join bf_customers
				on bf_issue_umts_mobile.parentCustomer = bf_customers.id
				where bf_customers.name like "%' . $_POST['searchString'] . '%" and bf_issue_umts_mobile.`status`="Issue";
				';
				$results = $this -> db -> query($query);
				$records = $results -> result();
			 } 
			else if ($_POST['searchType'] == 'serialno') 
			 {
				$query = '
				select bf_issue_umts_mobile.*
				from bf_issue_umts_mobile inner join bf_umts_stick
				on bf_issue_umts_mobile.parentMobile = bf_umts_stick.id
				where bf_umts_stick.serialNumber like "%' . $_POST['searchString'] . '%" and bf_issue_umts_mobile.`status`="Issue";
				';
				$results = $this -> db -> query($query);
				$records = $results -> result();
			 } 
			
			else if ($_POST['searchType'] == 'imeino') 
			 {
				$query = '
				select bf_issue_umts_mobile.*
				from bf_issue_umts_mobile inner join bf_umts_stick
				on bf_issue_umts_mobile.parentMobile = bf_umts_stick.id
				where bf_umts_stick.imeiNumber like "%' . $_POST['searchString'] . '%" and bf_issue_umts_mobile.`status`="Issue";
				';
				$results = $this -> db -> query($query);
				$records = $results -> result();
			 } 
			
			else 
			 {
				$records = $this -> issue_umts_mobile_model -> find_all_by("status", "Issue");
			 }
		 } 
       //---------------------------- Search items -----------------------------------
			else
			{
				$records = $this->issue_umts_mobile_model->find_all_by("status","Issue");
			}
                
                $userlist = array ();
                $mobileList = array();
                $simList = array();
                $users = $this->user_model->find_all();
                $mobiles=$this->load->model('umts_stick/umts_stick_model')->find_all();
                $sims=$this->load->model('umts_sim/umts_sim_model')->find_all();
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
			$config['base_url'] = site_url(SITE_AREA . "/issueset/issue_umts_mobile/index/");
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
			Template::set('index_url', site_url(SITE_AREA . '/issueset/issue_umts_mobile/index/') . '/');
					
      //======================================= Pagination =============================================== 
				 
				 
				Template::set('customers', $customersList);	 
                Template::set('userslist', $userlist);
                Template::set('mobilelist', $mobileList);
                Template::set('simlist', $simList);
				Template::set('toolbar_title', 'Manage Issue UMTS Mobile');
				Template::render();
	}

	//--------------------------------------------------------------------


	public function create()
	{
		$this->auth->restrict('Issue_UMTS_Mobile.Issueset.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_issue_umts_mobile())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('issue_umts_mobile_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'issue_umts_mobile');

				Template::set_message(lang('issue_umts_mobile_create_success'), 'success');
				redirect(SITE_AREA .'/issueset/issue_umts_mobile');
			}
			else
			{
				Template::set_message(lang('issue_umts_mobile_create_failure') . $this->issue_umts_mobile_model->error, 'error');
			}
		}
			Assets::add_module_js('issue_umts_mobile', 'issue_umts_mobile.js');
            $customerList = $this->issue_umts_mobile_model->customerList();
            $mobileList = $this->issue_umts_mobile_model->mobileList();
            $simList = $this->issue_umts_mobile_model->simList();
            $adminList = $this->issue_umts_mobile_model->adminList();
            Template::set('customers', $customerList->result());
            Template::set('mobiles', $mobileList->result());
            Template::set('sims', $simList->result());
            Template::set('admins', $adminList->result());
			Template::set('toolbar_title', lang('issue_umts_mobile_create') . ' Issue UMTS Mobile');
			Template::render();
	}

	//--------------------------------------------------------------------


	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('issue_umts_mobile_invalid_id'), 'error');
			redirect(SITE_AREA .'/issueset/issue_umts_mobile');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Issue_UMTS_Mobile.Issueset.Edit');

			if ($this->save_issue_umts_mobile('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('issue_umts_mobile_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'issue_umts_mobile');

				Template::set_message(lang('issue_umts_mobile_edit_success'), 'success');
                                redirect(SITE_AREA .'/issueset/issue_umts_mobile');
			}
			else
			{
				Template::set_message(lang('issue_umts_mobile_edit_failure') . $this->issue_umts_mobile_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Issue_UMTS_Mobile.Issueset.Delete');

			if ($this->issue_umts_mobile_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('issue_umts_mobile_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'issue_umts_mobile');

				Template::set_message(lang('issue_umts_mobile_delete_success'), 'success');

				redirect(SITE_AREA .'/issueset/issue_umts_mobile');
			}
			else
			{
				Template::set_message(lang('issue_umts_mobile_delete_failure') . $this->issue_umts_mobile_model->error, 'error');
			}
		}
		Template::set('issue_umts_mobile', $this->issue_umts_mobile_model->find($id));
                
                $customers ="SELECT bf_customers.id,bf_customers.name 
                from bf_customers,bf_issue_umts_mobile 
                where bf_customers.id=bf_issue_umts_mobile.parentCustomer
                and bf_issue_umts_mobile.id=?";
                
                $admin = "SELECT * FROM bf_users WHERE role_id = ?";
                
                $mobiles="select distinct bf_umts_stick.id,bf_umts_stick.articleDescription,imeiNumber
                from bf_umts_stick left join bf_issue_umts_mobile
                on
                bf_umts_stick.id = bf_issue_umts_mobile.parentMobile
                where
                bf_umts_stick.id not in(select parentMobile from bf_issue_umts_mobile where parentMobile not in(select parentMobile from bf_issue_umts_mobile where id=?) and status='issue')
                and
                bf_umts_stick.id not in(select bf_umts_stick.id from bf_umts_stick where bf_umts_stick.deleted=1)
                ";
                
                $sims="select distinct bf_umts_sim.id,bf_umts_sim.simCardName,bf_umts_sim.telephoneNumber
                from bf_umts_sim left join bf_issue_umts_mobile
                on
                bf_umts_sim.id = bf_issue_umts_mobile.parentSim
                where
                bf_umts_sim.id not in(select parentSim from bf_issue_umts_mobile where parentSim not in(select parentSim from bf_issue_umts_mobile where id=?) and status='issue')
                and
                bf_umts_sim.id not in(select bf_umts_sim.id from bf_umts_sim where bf_umts_sim.deleted=1)
                ";
                
                $adminList = $this->db->query($admin, array(8));
                $CustomerList = $this->db->query($customers, array($id));
                $mobileLists= $this->db->query($mobiles, array($id));
                $simLists= $this->db->query($sims, array($id));
                Template::set('admins', $adminList->result());
                Template::set('cutomers', $CustomerList->result());
                Template::set('mobiles', $mobileLists->result());
                Template::set('sims', $simLists->result());
		Template::set('toolbar_title', lang('issue_umts_mobile_edit') .' Issue UMTS Mobile');
		Template::render();
	}

	//--------------------------------------------------------------------

	
	private function save_issue_umts_mobile($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['parentCustomer']        = $this->input->post('issue_umts_mobile_parentCustomer');
		$data['parentMobile']        = $this->input->post('issue_umts_mobile_parentMobile');
		$data['parentSim']        = $this->input->post('issue_umts_mobile_parentSim');
		$data['status']        = $this->input->post('issue_umts_mobile_status');
		$data['charger']        = null;
		$data['usbCable']        = null;
		$data['issueDate']        = $this->input->post('issue_umts_mobile_issueDate') ? $this->input->post('issue_umts_mobile_issueDate') : '0000-00-00';
		$data['returnDate']        = $this->input->post('issue_umts_mobile_returnDate') ? $this->input->post('issue_umts_mobile_returnDate') : '0000-00-00';
		$data['parentAdmin']        = $this->input->post('issue_umts_mobile_parentAdmin');

		if ($type == 'insert')
		{
			$id = $this->issue_umts_mobile_model->insert($data);

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
			$return = $this->issue_umts_mobile_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------

        function view_detail()
		{
             $id = $this->uri->segment(5);
			 
			    $customers ="SELECT bf_customers.id,bf_customers.name 
                from bf_customers,bf_issue_umts_mobile
                where bf_customers.id=bf_issue_umts_mobile.parentCustomer
                and bf_issue_umts_mobile.id=?";
                
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
				
				
				$stickarray = array ();
				$sticks = $this->load->model('umts_stick/umts_stick_model')->find_all();
                if($sticks)
                {
	                foreach ($sticks as $stick)
	                {
	                    $stickarray[$stick->id]=$stick;
	                }
				}
				
				
				$umtssimarray = array ();
				$umtssims = $this->load->model('umts_sim/umts_sim_model')->find_all();
                foreach ($umtssims as $umtssim)
                {
                    $umtssimarray[$umtssim->id]=$umtssim;
                }
				
				$CustomerList = $this->db->query($customers, array($id));
                Template::set('cutomers', $CustomerList->result());
				$adminList = $this->db->query($admin, array(8));
				
                Template::set('admins', $adminList->result());
                Template::set('mobiles', $stickarray);
                Template::set('sims', $umtssimarray);
                Template::set('userslist', $userlist);
                Template::set('issue_umts_mobile', $this->issue_umts_mobile_model->find($id));
				Template::set('toolbar_title', ' Issue UMTS Mobile');
                Template::render();
				
		}
    // ==============================================================================================
    
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
					$result = $this->issue_umts_mobile_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('issue_umts_mobile_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('issue_umts_mobile_delete_failure') . $this->issue_umts_mobile_model->error, 'error');
				}
			}
		}
		
		//---------------------------- Search items -----------------------------------
		if (isset($_POST['search'])) 
		 {
			
			if ($_POST['searchType'] == 'name') 
			 {
				$query = '
				select bf_issue_umts_mobile.*
				from bf_issue_umts_mobile inner join bf_customers
				on bf_issue_umts_mobile.parentCustomer = bf_customers.id
				where bf_customers.name like "%' . $_POST['searchString'] . '%" and bf_issue_umts_mobile.`status`="Return";
				';
				$results = $this -> db -> query($query);
				$records = $results -> result();
			 } 
			else if ($_POST['searchType'] == 'serialno') 
			 {
				$query = '
				select bf_issue_umts_mobile.*
				from bf_issue_umts_mobile inner join bf_umts_stick
				on bf_issue_umts_mobile.parentMobile = bf_umts_stick.id
				where bf_umts_stick.serialNumber like "%' . $_POST['searchString'] . '%" and bf_issue_umts_mobile.`status`="Return";
				';
				$results = $this -> db -> query($query);
				$records = $results -> result();
			 } 
			
			else if ($_POST['searchType'] == 'imeino') 
			 {
				$query = '
				select bf_issue_umts_mobile.*
				from bf_issue_umts_mobile inner join bf_umts_stick
				on bf_issue_umts_mobile.parentMobile = bf_umts_stick.id
				where bf_umts_stick.imeiNumber like "%' . $_POST['searchString'] . '%" and bf_issue_umts_mobile.`status`="Return";
				';
				$results = $this -> db -> query($query);
				$records = $results -> result();
			 } 
			
			else 
			 {
				$records = $this -> issue_umts_mobile_model -> find_all_by("status", "Return");
			 }
		 } 
       //---------------------------- Search items -------------------------------------
		else
		{
				$records = $this->issue_umts_mobile_model->find_all_by("status","Return");
		}
		

                
                $userlist = array ();
                $mobileList = array();
                $simList = array();
                $users = $this->user_model->find_all();
                $mobiles=$this->load->model('umts_stick/umts_stick_model')->find_all();
                $sims=$this->load->model('umts_sim/umts_sim_model')->find_all();
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
			$this -> pager['base_url'] = site_url(SITE_AREA . "/issueset/issue_umts_mobile/returnsets/");
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
			Template::set('index_url', site_url(SITE_AREA . '/issueset/issue_umts_mobile/returnsets/') . '/');
					
      //======================================= Pagination =============================================== 
				 
				Template::set('customers', $customersList);	 
                Template::set('userslist', $userlist);
                Template::set('mobilelist', $mobileList);
                Template::set('simlist', $simList);
				Template::set('toolbar_title', 'Return UMTS Mobile');
				Template::render();
	}    

}