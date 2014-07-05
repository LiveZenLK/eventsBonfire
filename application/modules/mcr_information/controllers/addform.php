<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class addform extends Admin_Controller
{

	//----------------------------------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('MCR_Information.Addform.View');
		$this->load->model('mcr_information_model', null, true);
		$this->lang->load('mcr_information');
		
			Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
			Assets::add_js('jquery-ui-1.8.13.min.js');
		Template::set_block('sub_nav', 'addform/_sub_nav');

		Assets::add_module_js('mcr_information', 'mcr_information.js');
		 Assets::add_module_css('mcr_information', 'searchbar.css');
	}

	//-------------------------------------------------------------------------------------------------


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
					$result = $this->mcr_information_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('mcr_information_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('mcr_information_delete_failure') . $this->mcr_information_model->error, 'error');
				}
			}
		}

      //======================================= Search items ===============================================
		if (isset($_POST['search'])) 
		 {
			if ($_POST['searchType'] == 'job') 
			 {
				$like_job = "%" . $_POST['searchString'] . "%";
				$this -> mcr_information_model -> where("job like ", $like_job);
				$this->mcr_information_model->where("status","Issue");
				$records = $this -> mcr_information_model -> find_all();
			 } 
			elseif ($_POST['searchType'] == 'name') 
			 {
				$query = '
				select bf_mcr_information.*
				from bf_mcr_information inner join bf_add_customer
				on bf_mcr_information.parentCustomer = bf_add_customer.id
				where bf_add_customer.name like "%' . $_POST['searchString'] . '%" and bf_mcr_information.`status`="Issue";
				';
				$results = $this -> db -> query($query);
				$records = $results -> result();
			 } 
			else 
			 {
				$records = $this -> mcr_information_model -> find_all_by("status", "Issue");
			 }
		 } 
      //======================================= Search items ===============================================
		 else
			{
				$records = $this->mcr_information_model->find_all_by("status","Issue");
			}

                $userlist = array ();
                
                $users = $this->user_model->find_all();
                
                foreach ($users as $user)
                {
                    $userlist[$user->id]=$user;
                }
				
				
				$customerlist = array ();
                $customers = $this->load->model('add_customer/add_customer_model')->select('id, name')->find_all();
                foreach ($customers as $customer)
                {
                    $customerlist[$customer->id]=$customer;
                }
				
      //======================================= Pagination ===============================================
				
			$this -> load -> library('pagination');
			$total_users = count($records);
			$config['base_url'] = site_url(SITE_AREA . "/addform/mcr_information/index/");
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
			Template::set('index_url', site_url(SITE_AREA . '/addform/drone_information/index/') . '/');
					
      //======================================= Pagination ===============================================
				
		Template::set('customers', $customerlist);
        Template::set('userslist', $userlist);
		Template::set('toolbar_title', 'Manage MCR Information');
		Template::render();
	}

	//-------------------------------------------------------------------------------------------

	public function create()
	{
		$this->auth->restrict('MCR_Information.Addform.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_mcr_information())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('mcr_information_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'mcr_information');

				Template::set_message(lang('mcr_information_create_success'), 'success');
				redirect(SITE_AREA .'/addform/mcr_information');
			}
			else
			{
				Template::set_message(lang('mcr_information_create_failure') . $this->mcr_information_model->error, 'error');
			}
		}
		
		$fplists = $this->load->model('fp_set_master/fp_set_master_model')->select('id, setType')->find_all();
		$fpArray = array();
		if($fplists)
			{
		foreach ($fplists as $fplist)
		{
			$fpArray[$fplist->id] = $fplist;
		}
			}
		template::set('fpsets',$fpArray);
		
		
		
		Assets::add_module_js('mcr_information', 'mcr_information.js');
                $sql1 = "SELECT * FROM bf_users WHERE role_id = ?";
                
                $sql ="SELECT distinct bf_add_customer.id,bf_add_customer.name 
                FROM bf_add_customer LEFT JOIN  bf_mcr_information  ON 
                bf_add_customer.id = bf_mcr_information.parentCustomer 
                WHERE 
                bf_add_customer.id NOT IN (select parentCustomer from bf_mcr_information where status = 'issue')
                and
                bf_add_customer.id NOT IN(select bf_add_customer.id from bf_add_customer where bf_add_customer.deleted=1)";
               
			    $mcrList = $this->db->query($sql1, array(7)); 
                $myList = $this->db->query($sql); 
                Template::set('users', $myList->result());
                Template::set('mcrs', $mcrList->result());
		Template::set('toolbar_title', lang('mcr_information_create') . ' MCR Information');
		Template::render();
	}

	//-------------------------------------------------------------------------------------------


	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('mcr_information_invalid_id'), 'error');
			redirect(SITE_AREA .'/addform/mcr_information');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('MCR_Information.Addform.Edit');

			if ($this->save_mcr_information('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('mcr_information_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'mcr_information');

				Template::set_message(lang('mcr_information_edit_success'), 'success');
                                redirect(SITE_AREA .'/addform/mcr_information');
			}
			else
			{
				Template::set_message(lang('mcr_information_edit_failure') . $this->mcr_information_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('MCR_Information.Addform.Delete');

			if ($this->mcr_information_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('mcr_information_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'mcr_information');

				Template::set_message(lang('mcr_information_delete_success'), 'success');

				redirect(SITE_AREA .'/addform/mcr_information');
			}
			else
			{
				Template::set_message(lang('mcr_information_delete_failure') . $this->mcr_information_model->error, 'error');
			}
		}

		$fplists = $this->load->model('fp_set_master/fp_set_master_model')->select('id, setType')->find_all();
		$fpArray = array();
		foreach ($fplists as $fplist)
		{
			$fpArray[$fplist->id] = $fplist;
		}
		
		template::set('fpsets',$fpArray);

		Template::set('mcr_information', $this->mcr_information_model->find($id));
                $sql1 = "SELECT * FROM bf_users WHERE role_id = ?";
                $sql ="SELECT bf_add_customer.id,bf_add_customer.name from bf_add_customer,bf_mcr_information where bf_add_customer.id=bf_mcr_information.parentCustomer and bf_mcr_information.id=?";
                $mcrList = $this->db->query($sql1, array(7)); 
                $myList = $this->db->query($sql, array($id)); 
                Template::set('users', $myList->result());
                Template::set('mcrs', $mcrList->result());
		Template::set('toolbar_title', lang('mcr_information_edit') .' MCR Information');
		Template::render();
	}

	//---------------------------------------------------------------------------------------------------

	
	private function save_mcr_information($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['parentCustomer']         = $this->input->post('mcr_information_parentCustomer');
		$data['parentMcr']              = $this->input->post('mcr_information_parentMcr');
		$data['issueDate']              = $this->input->post('mcr_information_issueDate') ? $this->input->post('mcr_information_issueDate') : '0000-00-00';
		$data['status']                 = $this->input->post('mcr_information_status');
		$data['receivedBy']             = $this->input->post('mcr_information_receivedBy');
		$data['returnDate']             = $this->input->post('mcr_information_returnDate') ? $this->input->post('mcr_information_returnDate') : '0000-00-00';
		$data['type']                   = $this->input->post('mcr_information_type');

                // Manually created fields starts from here....
                
                $data['panasonic_HCV700']        = $this->input->post('mcr_information_panasonic_HCV700');
                $data['V700']                    = $this->input->post('mcr_information_V700');
                $data['microphone_rode']         = $this->input->post('mcr_information_microphone_rode');
                $data['macbook13']               = $this->input->post('mcr_information_macbook13');
                $data['mac13']                   = $this->input->post('mcr_information_mac13');
                $data['panasonic_HCV727']        = $this->input->post('mcr_information_panasonic_HCV727');
                $data['V727']                    = $this->input->post('mcr_information_V727');
                $data['extension_cable']         = $this->input->post('mcr_information_extension_cable');
                $data['macbook15']               = $this->input->post('mcr_information_macbook15');
                $data['camera_checkbox1']        = $this->input->post('mcr_information_camera_checkbox1'); 
                $data['camera_value1']           = $this->input->post('mcr_information_camera_value1');
                $data['audio_checkbox1']         = $this->input->post('mcr_information_audio_checkbox1');
                $data['audio_value1']            = $this->input->post('mcr_information_audio_value1');
                $data['recorder_sony_PMW50']     = $this->input->post('mcr_information_recorder_sony_PMW50');
                $data['camera_checkbox2']        = $this->input->post('mcr_information_camera_checkbox2');
                $data['camera_value2']           = $this->input->post('mcr_information_camera_value2');
                $data['audio_checkbox2']         = $this->input->post('mcr_information_audio_checkbox2');
                $data['audio_value2']            = $this->input->post('mcr_information_audio_value2');
                $data['aja_interface']           = $this->input->post('mcr_information_aja_interface');
                $data['camera_checkbox3']        = $this->input->post('mcr_information_camera_checkbox3');
                $data['camera_value3']           = $this->input->post('mcr_information_camera_value3');
                $data['sxs_card_reader']         = $this->input->post('mcr_information_sxs_card_reader');
                $data['liveu']                   = $this->input->post('mcr_information_liveu');
                $data['thunderbold_SSD_cable']   = $this->input->post('mcr_information_thunderbold_SSD_cable');
                $data['SD_card_amount']          = $this->input->post('mcr_information_SD_card_amount');
                $data['sccard_amount']           = $this->input->post('mcr_information_sccard_amount');
                $data['minicaster']              = $this->input->post('mcr_information_minicaster');
                $data['mac_charger']             = $this->input->post('mcr_information_mac_charger');
                $data['mini_sd_card']            = $this->input->post('mcr_information_mini_sd_card');
                $data['mini_sd_card_amount']     = $this->input->post('mcr_information_mini_sd_card_amount');
                $data['newsspotter']             = $this->input->post('mcr_information_newsspotter');
                $data['peripherals_checkbox1']   = $this->input->post('mcr_information_peripherals_checkbox1');
                $data['peripherals_value1']      = $this->input->post('mcr_information_peripherals_value1');
                $data['sd_card_adaptor']         = $this->input->post('mcr_information_sd_card_adaptor');
                $data['BGAN_explorer']           = $this->input->post('mcr_information_BGAN_explorer');
                $data['peripherals_checkbox2']   = $this->input->post('mcr_information_peripherals_checkbox2');
                $data['peripherals_value2']      = $this->input->post('mcr_information_peripherals_value2');
                $data['battery_700_small']       = $this->input->post('mcr_information_battery_700_small');
                $data['battery_700_small_amount']= $this->input->post('mcr_information_battery_700_small_amount');
                $data['cullmann_magnesit']       = $this->input->post('mcr_information_cullmann_magnesit');
                $data['walkie_talkie']           = $this->input->post('mcr_information_walkie_talkie');
                $data['battery_700_big']         = $this->input->post('mcr_information_battery_700_big');
                $data['battery_700_big_amount']  = $this->input->post('mcr_information_battery_700_big_amount');
                $data['cullmann_nanomax']        = $this->input->post('mcr_information_cullmann_nanomax');
                $data['first_aid_kit']           = $this->input->post('mcr_information_first_aid_kit');
                $data['battery_727VWVBT190']     = $this->input->post('mcr_information_battery_727VWVBT190');
                $data['battery_727VWVBT190_amount'] = $this->input->post('mcr_information_battery_727VWVBT190_amount');
                $data['tripods_checkbox1']       = $this->input->post('mcr_information_tripods_checkbox1');
                $data['backpack']                = $this->input->post('mcr_information_backpack');
                $data['battery_727VWVBT380']     = $this->input->post('mcr_information_battery_727VWVBT380');
                $data['battery_727VWVBT380_amount'] = $this->input->post('mcr_information_battery_727VWVBT380_amount');
                $data['tripods_checkbox2']          = $this->input->post('mcr_information_tripods_checkbox2');
                $data['tripods_value2']             = $this->input->post('mcr_information_tripods_value2');
                $data['miscellaneous_checkbox1']     = $this->input->post('mcr_information_miscellaneous_checkbox1');
                $data['miscellaneous_value1']       = $this->input->post('mcr_information_miscellaneous_value1');
                $data['battery_handycam']           = $this->input->post('mcr_information_battery_handycam');
                $data['battery_handycam_amount']    = $this->input->post('mcr_information_battery_handycam_amount');
                $data['tripods_checkbox3']          = $this->input->post('mcr_information_tripods_checkbox3');
                $data['tripods_value3']             = $this->input->post('mcr_information_tripods_value3');
                $data['miscellaneous_checkbox2']    = $this->input->post('mcr_information_miscellaneous_checkbox2');
                $data['miscellaneous_value2']       = $this->input->post('mcr_information_miscellaneous_value2');
                $data['charger_patona']             = $this->input->post('mcr_information_charger_patona');
                $data['tripods_checkbox4']          = $this->input->post('mcr_information_tripods_checkbox4');
                $data['tripods_value4']             = $this->input->post('mcr_information_tripods_value4');
                $data['miscellaneous_checkbox3']    = $this->input->post('mcr_information_miscellaneous_checkbox3');
                $data['miscellaneous_value3']       = $this->input->post('mcr_information_miscellaneous_value3');
                $data['charger_panasonic_VSK0781SND3BMT']  = $this->input->post('mcr_information_charger_panasonic_VSK0781SND3BMT');
                $data['tripods_checkbox5']          = $this->input->post('mcr_information_tripods_checkbox5');
                $data['tripods_value5']             = $this->input->post('mcr_information_tripods_value5');
                $data['miscellaneous_checkbox4']    = $this->input->post('mcr_information_miscellaneous_checkbox4');
                $data['miscellaneous_value4']       = $this->input->post('mcr_information_miscellaneous_value4');
                $data['Battery_small_panasonic']    = $this->input->post('mcr_information_Battery_small_panasonic');
                $data['batterysmallpanasonic']      = $this->input->post('mcr_information_batterysmallpanasonic');
                $data['one_cam_charger_panasonic']  = $this->input->post('mcr_information_one_cam_charger_panasonic');
                $data['onecamchargerpanasonic']     = $this->input->post('mcr_information_onecamchargerpanasonic');
                $data['one_battery_small_panasonic']= $this->input->post('mcr_information_one_battery_small_panasonic');
                $data['onebatterysmallpanasonic']   = $this->input->post('mcr_information_onebatterysmallpanasonic');
				$data['job']   = $this->input->post('mcr_information_job');
                
                
                if ($type == 'insert')
		{
			$id = $this->mcr_information_model->insert($data);

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
			$return = $this->mcr_information_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


        function mcr_detail()
        {
        	
            $id = $this->uri->segment(5);
                
				$fpsetarr = array();
				$fpsetlists = $this->load->model('fp_set_master/fp_set_master_model')->select('id,setType')->find_all();
				 foreach($fpsetlists as $fplist)
				 {
				 	$fpsetarr[$fplist->id] = $fplist;
				 }			
				 		
                $userlist = array ();
                $users = $this->user_model->find_all();
                foreach ($users as $user)
                {
                    $userlist[$user->id]=$user;
                }
				
				
				$customerlist = array ();
                $customers = $this->load->model('add_customer/add_customer_model')->select('id, name')->find_all();
                foreach ($customers as $customer)
                {
                    $customerlist[$customer->id]=$customer;
                }
				
		        Template::set('customers', $customerlist);
				Template::set('fpsets', $fpsetarr);
                Template::set('userslist', $userlist);
				$mcr_informations = $this->mcr_information_model->find($id);
                Template::set('mcr_information', $this->mcr_information_model->find($id));
				Template::set('toolbar_title',' MCR Information');
                Template::render();
				
        }
      //===============================================================================================
        
         function return_sets($offset = 0)
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
						$result = $this->mcr_information_model->delete($pid);
					}
	
					if ($result)
					{
						Template::set_message(count($checked) .' '. lang('mcr_information_delete_success'), 'success');
					}
					else
					{
						Template::set_message(lang('mcr_information_delete_failure') . $this->mcr_information_model->error, 'error');
					}
				}
			}
	      	
		
	  //----------------------------- Search items------------------------
		if (isset($_POST['search'])) 
		 {
			if ($_POST['searchType'] == 'job') 
			 {
				$like_job = "%" . $_POST['searchString'] . "%";
				$this -> mcr_information_model -> where("job like ", $like_job);
				$this->mcr_information_model->where("status","Return");
				$records = $this -> mcr_information_model -> find_all();
			 } 
			elseif ($_POST['searchType'] == 'name') 
			 {
				$query = '
				select bf_mcr_information.*
				from bf_mcr_information inner join bf_add_customer
				on bf_mcr_information.parentCustomer = bf_add_customer.id
				where bf_add_customer.name like "%' . $_POST['searchString'] . '%" and bf_mcr_information.`status`="Return";
				';
				$results = $this -> db -> query($query);
				$records = $results -> result();
			 } 
			else 
			 {
				$records = $this -> mcr_information_model -> find_all_by("status", "Return");
			 }
		 } 
      //--------------------------- Search items ----------------------------------
		else 
			{		
        	   $records = $this->mcr_information_model->find_all_by("status","Return");
			}
                $userlist = array ();
                $users = $this->user_model->find_all();
                foreach ($users as $user)
                {
                    $userlist[$user->id]=$user;
                }
				
				$customerlist = array ();
                $customers = $this->load->model('add_customer/add_customer_model')->select('id, name')->find_all();
                foreach ($customers as $customer)
                {
                    $customerlist[$customer->id]=$customer;
                }
	 //======================================= Pagination ===============================================
				
			$this -> load -> library('pagination');
			$total_users = count($records);
			$this -> pager['base_url'] = site_url(SITE_AREA . "/addform/mcr_information/return_sets/");
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
			Template::set('index_url', site_url(SITE_AREA . '/addform/drone_information/return_sets/') . '/');
					
      //======================================= Pagination ===============================================			
		        Template::set('customers', $customerlist);
                Template::set('userslist', $userlist);
				Template::set('toolbar_title', 'Manage MCR Information');
				Template::render();
      }
      
     //-----------------------------------------------------------------------------------------------------
      
      public function searchCustomer()
        {
            $searchString  = $_GET['searchString'];
            $customers = $this->mcr_information_model->getCustomer($searchString);
            echo json_encode($customers);
        }
		
    //------------------------------------------------------------------------------------------------------
   
}