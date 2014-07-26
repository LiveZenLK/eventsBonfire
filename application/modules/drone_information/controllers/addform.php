<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class addform extends Admin_Controller {

	//--------------------------------------------------------------------

	public function __construct() {
		parent::__construct();

		$this -> auth -> restrict('Drone_Information.Addform.View');
		$this -> load -> model('drone_information_model', null, true);
		$this -> lang -> load('drone_information');

		Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
		Assets::add_js('jquery-ui-1.8.13.min.js');
		Template::set_block('sub_nav', 'addform/_sub_nav');
		Assets::add_js('select2.min.js');

		Assets::add_module_js('drone_information', 'drone_information.js');
		Assets::add_module_css('drone_information', 'style.css');
	}

	//--------------------------------------------------------------------

	
	public function index($offset = 0) {
		
		
		// Deleting anything?
		
		if (isset($_POST['delete'])) 
			{
				$checked = $this -> input -> post('checked');
	
				if (is_array($checked) && count($checked)) 
				{
					$result = FALSE;
					foreach ($checked as $pid) {
						$result = $this -> drone_information_model -> delete($pid);
					}
	
					if ($result) {
						Template::set_message(count($checked) . ' ' . lang('drone_information_delete_success'), 'success');
					} else {
						Template::set_message(lang('drone_information_delete_failure') . $this -> drone_information_model -> error, 'error');
					}
				}
			}

		if (isset($_POST['search'])) 
			{
				if ($_POST['searchType'] == 'job') 
					{
						$like_job = "%" . $_POST['searchString'] . "%";
						$this -> drone_information_model -> where("job like ", $like_job);
						$this -> drone_information_model -> where("status", "Issue");
						$records = $this -> drone_information_model -> find_all();
					} 
				elseif ($_POST['searchType'] == 'name') 
					{
						$query = '
						select bf_drone_information.*
						from bf_drone_information inner join bf_add_customer
						on bf_drone_information.drone_customer = bf_add_customer.id
						where bf_add_customer.name like "%' . $_POST['searchString'] . '%" and bf_drone_information.`status`="Issue";
						';
						$results = $this -> db -> query($query);
						$records = $results -> result();
					} 
				else 
					{
						$records = $this -> drone_information_model -> find_all_by("status", "Issue");
					}
			} 
		else 
			{
				$records = $this -> drone_information_model -> find_all_by("status", "Issue");
			}
		
		
		$userlist = array();
		$users = $this -> user_model -> find_all();
		foreach ($users as $user) {
			$userlist[$user -> id] = $user;
		}
		$customerlist = array();
		$customers = $this -> load -> model('add_customer/add_customer_model') -> select('id, name') -> find_all();
		foreach ($customers as $customer) {
			$customerlist[$customer -> id] = $customer;
		}


		// Pagination
		$this -> load -> library('pagination');
		$total_users = count($records);
		$config['base_url'] = site_url(SITE_AREA . "/addform/drone_information/index/");
		$config['total_rows'] = $total_users;
		$config['per_page'] = $this -> limit;
		$config['uri_segment'] = 5;
		$this -> pagination -> initialize($config);

		Template::set('userslist', $userlist);
		Template::set('customers', $customerlist);
		if ($records) 
			{
				Template::set('records', array_splice($records, $offset, $this -> limit));
			} 
		else 
			{
				Template::set('records', $records);
			}
			
		Template::set('index_url', site_url(SITE_AREA . '/addform/drone_information/index/') . '/');
		Template::set('toolbar_title', 'Manage Drone Information');
		Template::render();
	}

	//--------------------------------------------------------------------

	public function create() {
		$this -> auth -> restrict('Drone_Information.Addform.Create');

		if (isset($_POST['save'])) 
			{
				if ($insert_id = $this -> save_drone_information()) 
				   {
					log_activity($this -> current_user -> id, lang('drone_information_act_create_record') . ': ' . $insert_id . ' : ' . $this -> input -> ip_address(), 'drone_information');
					Template::set_message(lang('drone_information_create_success'), 'success');
					redirect(SITE_AREA . '/addform/drone_information');
				   } 
			   
			    else 
				   {
					Template::set_message(lang('drone_information_create_failure') . $this -> drone_information_model -> error, 'error');
				   }
			}
		Assets::add_module_js('drone_information', 'drone_information.js');

		$dronelists = $this -> load -> model('drone_master/drone_master_model') -> select('id, setType') -> find_all();
		
		$dronelistArray = array();
		if ($dronelists) {
			foreach ($dronelists as $dronelist) {
				$dronelistArray[$dronelist -> id] = $dronelist;
			}
		}
		
		template::set('droneset', $dronelistArray);
		$sql1 = "SELECT * FROM bf_users WHERE role_id = ?";
		$sql = "SELECT distinct bf_add_customer.id,bf_add_customer.name FROM bf_add_customer LEFT JOIN  bf_drone_information  ON bf_add_customer.id = 
				bf_drone_information.drone_customer 
				WHERE 
				bf_add_customer.id NOT IN (select drone_customer from bf_drone_information where status = 'Issue')
				and
				bf_add_customer.id NOT IN(select bf_add_customer.id from bf_add_customer where bf_add_customer.deleted=1)";
		$mcrList = $this -> db -> query($sql1, array(7));
		$myList = $this -> db -> query($sql);
		Template::set('customers', $myList -> result());
		Template::set('mcrs', $mcrList -> result());
		Template::set('toolbar_title', lang('drone_information_create') . ' Drone Information');
		Template::render();
	}

	//--------------------------------------------------------------------

	public function edit() {
		$id = $this -> uri -> segment(5);

		if (empty($id)) {
			Template::set_message(lang('drone_information_invalid_id'), 'error');
			redirect(SITE_AREA . '/addform/drone_information');
		}

		if (isset($_POST['save'])) {
			$this -> auth -> restrict('Drone_Information.Addform.Edit');

			if ($this -> save_drone_information('update', $id)) {
				// Log the activity
				log_activity($this -> current_user -> id, lang('drone_information_act_edit_record') . ': ' . $id . ' : ' . $this -> input -> ip_address(), 'drone_information');

				Template::set_message(lang('drone_information_edit_success'), 'success');
				redirect(SITE_AREA . '/addform/drone_information');
			} else {
				Template::set_message(lang('drone_information_edit_failure') . $this -> drone_information_model -> error, 'error');
			}
		} else if (isset($_POST['delete'])) {
			$this -> auth -> restrict('Drone_Information.Addform.Delete');

			if ($this -> drone_information_model -> delete($id)) {
				// Log the activity
				log_activity($this -> current_user -> id, lang('drone_information_act_delete_record') . ': ' . $id . ' : ' . $this -> input -> ip_address(), 'drone_information');

				Template::set_message(lang('drone_information_delete_success'), 'success');

				redirect(SITE_AREA . '/addform/drone_information');
			} else {
				Template::set_message(lang('drone_information_delete_failure') . $this -> drone_information_model -> error, 'error');
			}
		}

		$dronelists = $this -> load -> model('drone_master/drone_master_model') -> select('id, setType') -> find_all();
		$dronelistArray = array();
		foreach ($dronelists as $dronelist) {
			$dronelistArray[$dronelist -> id] = $dronelist;
		}

		template::set('droneset', $dronelistArray);
		$sql1 = "SELECT * FROM bf_users WHERE role_id = ?";
		$sql = "SELECT bf_add_customer.id,bf_add_customer.name from bf_add_customer,bf_drone_information where bf_add_customer.id=bf_drone_information.drone_customer and bf_drone_information.id=?";
		$mcrList = $this -> db -> query($sql1, array(7));
		$myList = $this -> db -> query($sql, array($id));
		Template::set('users', $myList -> result());
		Template::set('mcrs', $mcrList -> result());
		Template::set('drone_information', $this -> drone_information_model -> find($id));
		Template::set('toolbar_title', lang('drone_information_edit') . ' Drone Information');
		Template::render();
	}

	//--------------------------------------------------------------------

	private function save_drone_information($type = 'insert', $id = 0) {
		if ($type == 'update') {
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want

		$data = array();
		$data['drone_customer'] = $this -> input -> post('drone_information_drone_customer');
		$data['issueDate'] = $this -> input -> post('drone_information_issueDate') ? $this -> input -> post('drone_information_issueDate') : '0000-00-00';
		$data['returnDate'] = $this -> input -> post('drone_information_returnDate') ? $this -> input -> post('drone_information_returnDate') : '0000-00-00';
		$data['issueBy'] = $this -> input -> post('drone_information_issueBy');
		$data['receivedBy'] = $this -> input -> post('drone_information_receivedBy');
		$data['status'] = $this -> input -> post('drone_information_status');
		$data['drone_set_type'] = $this -> input -> post('drone_information_drone_set_type');
		$data['djiphantom'] = $this -> input -> post('drone_information_djiphantom');
		$data['djiphantom_Val'] = $this -> input -> post('drone_information_djiphantom_Val');
		$data['zenmuseh_gimbal'] = $this -> input -> post('drone_information_zenmuseh_gimbal');
		$data['zenmuseh_gimbal_val'] = $this -> input -> post('drone_information_zenmuseh_gimbal_val');
		$data['geprohero'] = $this -> input -> post('drone_information_geprohero');
		$data['geprohero_val'] = $this -> input -> post('drone_information_geprohero_val');
		$data['propellers'] = $this -> input -> post('drone_information_propellers');
		$data['propellers_val'] = $this -> input -> post('drone_information_propellers_val');
		$data['phantom_batteries'] = $this -> input -> post('drone_information_phantom_batteries');
		$data['phantom_batteries_val'] = $this -> input -> post('drone_information_phantom_batteries_val');
		$data['phantom_chargers'] = $this -> input -> post('drone_information_phantom_chargers');
		$data['phantom_chargers_val'] = $this -> input -> post('drone_information_phantom_chargers_val');
		$data['propellor_protection'] = $this -> input -> post('drone_information_propellor_protection');

		//===================================Custom Fields====================================================

		$data['propellor_protection_val'] = $this -> input -> post('drone_information_propellor_protection_val');

		$data['screwdriver_set'] = $this -> input -> post('drone_information_screwdriver_set');
		$data['screwdriver_set_val'] = $this -> input -> post('drone_information_screwdriver_set_val');
		$data['single_screwdriver'] = $this -> input -> post('drone_information_single_screwdriver');
		$data['single_screwdriver_val'] = $this -> input -> post('drone_information_single_screwdriver_val');
		$data['remote_control'] = $this -> input -> post('drone_information_remote_control');
		$data['remote_control_val'] = $this -> input -> post('drone_information_remote_control_val');

		$data['fpv_monitor'] = $this -> input -> post('drone_information_fpv_monitor');
		$data['fpv_monitor_val'] = $this -> input -> post('drone_information_fpv_monitor_val');
		$data['antennas_fpv_monitor'] = $this -> input -> post('drone_information_antennas_fpv_monitor');
		$data['antennas_fpv_monitor_val'] = $this -> input -> post('drone_information_antennas_fpv_monitor_val');
		$data['batteries_fpv_monitor'] = $this -> input -> post('drone_information_batteries_fpv_monitor');
		$data['batteries_fpv_monitor_val'] = $this -> input -> post('drone_information_batteries_fpv_monitor_val');

		$data['charger_fpv_monitor'] = $this -> input -> post('drone_information_charger_fpv_monitor');
		$data['charger_fpv_monitor_val'] = $this -> input -> post('drone_information_charger_fpv_monitor_val');
		$data['sun_shades_fpv_monitor'] = $this -> input -> post('drone_information_sun_shades_fpv_monitor');
		$data['sun_shades_fpv_monitor_val'] = $this -> input -> post('drone_information_sun_shades_fpv_monitor_val');
		$data['console_fpv_monitor'] = $this -> input -> post('drone_information_console_fpv_monitor');
		$data['console_fpv_monitor_val'] = $this -> input -> post('drone_information_console_fpv_monitor_val');

		$data['micro_sd_cards'] = $this -> input -> post('drone_information_micro_sd_cards');
		$data['micro_sd_cards_val'] = $this -> input -> post('drone_information_micro_sd_cards_val');
		$data['hardcase'] = $this -> input -> post('drone_information_hardcase');
		$data['hardcase_val'] = $this -> input -> post('drone_information_hardcase_val');
		$data['spare_screws'] = $this -> input -> post('drone_information_spare_screws');
		$data['spare_screws_val'] = $this -> input -> post('drone_information_spare_screws_val');
		$data['job'] = $this -> input -> post('drone_information_job');

		if ($type == 'insert') {
			$id = $this -> drone_information_model -> insert($data);

			if (is_numeric($id)) 
			{
				$return = $id;
			} 
			else 
			{
				$return = FALSE;
			}
		} elseif ($type == 'update') {
			$return = $this -> drone_information_model -> update($id, $data);
		}

		return $return;
	}

	//---------------------------------------------------------------------------------------------

	function return_sets($offset = 0) {

		// Deleting anything?
		if (isset($_POST['delete'])) {
			$checked = $this -> input -> post('checked');

			if (is_array($checked) && count($checked)) {
				$result = FALSE;
				foreach ($checked as $pid) {
					$result = $this -> drone_information_model -> delete($pid);
				}

				if ($result) {
					Template::set_message(count($checked) . ' ' . lang('drone_information_delete_success'), 'success');
				} else {
					Template::set_message(lang('drone_information_delete_failure') . $this -> drone_information_model -> error, 'error');
				}
			}
		}

		//------------------------- search-----------------------------------------
		if (isset($_POST['search'])) {
			if ($_POST['searchType'] == 'job') {
				$like_job = "%" . $_POST['searchString'] . "%";
				$this -> drone_information_model -> where("job like ", $like_job);
				$this -> drone_information_model -> where("status", "Return");
				$records = $this -> drone_information_model -> find_all();
			} else if ($_POST['searchType'] == 'name') {
				$query = '
				select bf_drone_information.*
				from bf_drone_information inner join bf_add_customer
				on bf_drone_information.drone_customer = bf_add_customer.id
				where bf_add_customer.name like "%' . $_POST['searchString'] . '%" and bf_drone_information.`status`="Return";
				';
				$results = $this -> db -> query($query);
				$records = $results -> result();
			} else {
				$records = $this -> drone_information_model -> find_all_by("status", "Return");
			}
		} else {
			$records = $this -> drone_information_model -> find_all_by("status", "Return");
		}

		$this -> load -> library('pagination');
		$total_users = count($records);
		$this -> pager['base_url'] = site_url(SITE_AREA . "/addform/drone_information/return_sets/");
		$this -> pager['total_rows'] = $total_users;
		$this -> pager['per_page'] = $this -> limit;
		$this -> pager['uri_segment'] = 5;
		$this -> pagination -> initialize($this -> pager);

		$userlist = array();
		$users = $this -> user_model -> find_all();
		foreach ($users as $user) {
			$userlist[$user -> id] = $user;
		}
		$customerlist = array();
		$customers = $this -> load -> model('add_customer/add_customer_model') -> select('id, name') -> find_all();
		foreach ($customers as $customer) {
			$customerlist[$customer -> id] = $customer;
		}

		Template::set('customers', $customerlist);
		Template::set('userslist', $userlist);

		if ($records) {
			Template::set('records', array_splice($records, $offset, $this -> limit));
		} else {
			Template::set('records', $records);
		}
		Template::set('index_url', site_url(SITE_AREA . '/addform/drone_information/return_sets/') . '/');

		Template::set('toolbar_title', 'Manage Drone Information');
		Template::render();
	}

	//----------------------------------------------------------------------------------------------

	function drone_detail() {
		$id = $this -> uri -> segment(5);

		$dronesetarr = array();
		$dronelists = $this -> load -> model('drone_master/drone_master_model') -> select('id,setType') -> find_all();
		foreach ($dronelists as $dronelist) {
			$dronesetarr[$dronelist -> id] = $dronelist;
		}

		$userlist = array();
		$users = $this -> user_model -> find_all();
		foreach ($users as $user) {
			$userlist[$user -> id] = $user;
		}

		$customerlist = array();
		$customers = $this -> load -> model('add_customer/add_customer_model') -> select('id, name') -> find_all();
		foreach ($customers as $customer) {
			$customerlist[$customer -> id] = $customer;
		}

		Template::set('customers', $customerlist);
		Template::set('drones', $dronesetarr);
		Template::set('userslist', $userlist);
		Template::set('drone_information', $this -> drone_information_model -> find($id));
		Template::set('toolbar_title', ' Drone Information');
		Template::render();
	}

	//-------------------------------------------------------------------------------------------------
	function loadDrone() {
		$id = $_GET['droneid'];
		$droneSet = $this -> load -> model('drone_master/drone_master_model') -> find($id);
		echo json_encode($droneSet);
	}

}
