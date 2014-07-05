<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class setmasters extends Admin_Controller
{

	//--------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Drone_Master.Setmasters.View');
		$this->load->model('drone_master_model', null, true);
		$this->lang->load('drone_master');
		
		Template::set_block('sub_nav', 'setmasters/_sub_nav');

		Assets::add_module_js('drone_master', 'drone_master.js');
		Assets::add_module_css('drone_master', 'style.css');
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
					$result = $this->drone_master_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('drone_master_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('drone_master_delete_failure') . $this->drone_master_model->error, 'error');
				}
			}
		}

			//$records = $this->drone_master_model->limit($this->limit, $offset);
			$records = "select * from bf_drone_master LIMIT ".$this->limit." OFFSET ".$offset."";
			$List = $this->db->query($records);
			Template::set('records', $List->result());
					
			$this->load->library('pagination');
				
			$total_users = $this->drone_master_model->count_all();
			$config['base_url'] = site_url(SITE_AREA ."/setmasters/drone_master/index/");
			$config['total_rows'] = $total_users;
			$config['per_page'] = $this->limit;
			$config['uri_segment'] = 5;	
			$this->pagination->initialize($config);
			Template::set('index_url', site_url(SITE_AREA .'/setmasters/drone_master/index/') .'/');
		
			Template::set('toolbar_title', 'Manage Drone Master');
			Template::render();
	}

	//--------------------------------------------------------------------

	public function create()
	{
		$this->auth->restrict('Drone_Master.Setmasters.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_drone_master())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('drone_master_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'drone_master');

				Template::set_message(lang('drone_master_create_success'), 'success');
				redirect(SITE_AREA .'/setmasters/drone_master');
			}
			else
			{
				Template::set_message(lang('drone_master_create_failure') . $this->drone_master_model->error, 'error');
			}
		}
		Assets::add_module_js('drone_master', 'drone_master.js');

		Template::set('toolbar_title', lang('drone_master_create') . ' Drone Master');
		Template::render();
	}

	//--------------------------------------------------------------------


	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('drone_master_invalid_id'), 'error');
			redirect(SITE_AREA .'/setmasters/drone_master');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Drone_Master.Setmasters.Edit');

			if ($this->save_drone_master('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('drone_master_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'drone_master');

				Template::set_message(lang('drone_master_edit_success'), 'success');
				redirect(SITE_AREA .'/setmasters/drone_master');
			}
			else
			{
				Template::set_message(lang('drone_master_edit_failure') . $this->drone_master_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Drone_Master.Setmasters.Delete');

			if ($this->drone_master_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('drone_master_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'drone_master');

				Template::set_message(lang('drone_master_delete_success'), 'success');

				redirect(SITE_AREA .'/setmasters/drone_master');
			}
			else
			{
				Template::set_message(lang('drone_master_delete_failure') . $this->drone_master_model->error, 'error');
			}
		}
		Template::set('drone_master', $this->drone_master_model->find($id));
		Template::set('toolbar_title', lang('drone_master_edit') .' Drone Master');
		Template::render();
	}

	//--------------------------------------------------------------------

	private function save_drone_master($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['setType']        = $this->input->post('drone_master_setType');
		$data['djiphantom']        = $this->input->post('drone_master_djiphantom');
		$data['djiphantom_Val']        = $this->input->post('drone_master_djiphantom_Val');
		$data['zenmuseh_gimbal']        = $this->input->post('drone_master_zenmuseh_gimbal');
		$data['zenmuseh_gimbal_val']        = $this->input->post('drone_master_zenmuseh_gimbal_val');
		$data['geprohero']        = $this->input->post('drone_master_geprohero');
		$data['geprohero_val']        = $this->input->post('drone_master_geprohero_val');
		$data['propellers']        = $this->input->post('drone_master_propellers');
		$data['propellers_val']        = $this->input->post('drone_master_propellers_val');
		$data['phantom_batteries']        = $this->input->post('drone_master_phantom_batteries');
		$data['phantom_batteries_val']        = $this->input->post('drone_master_phantom_batteries_val');
		$data['phantom_chargers']        = $this->input->post('drone_master_phantom_chargers');
		$data['phantom_chargers_val']        = $this->input->post('drone_master_phantom_chargers_val');
		$data['propellor_protection']        = $this->input->post('drone_master_propellor_protection');
		$data['propellor_protection_val']        = $this->input->post('drone_master_propellor_protection_val');
		$data['screwdriver_set']        = $this->input->post('drone_master_screwdriver_set');
		$data['screwdriver_set_val']        = $this->input->post('drone_master_screwdriver_set_val');
		$data['single_screwdriver']        = $this->input->post('drone_master_single_screwdriver');
		$data['single_screwdriver_val']        = $this->input->post('drone_master_single_screwdriver_val');
		$data['remote_control']        = $this->input->post('drone_master_remote_control');


		$data['remote_control_val']        = $this->input->post('drone_master_remote_control_val');
		
		$data['fpv_monitor']        = $this->input->post('drone_master_fpv_monitor');
		$data['fpv_monitor_val']        = $this->input->post('drone_master_fpv_monitor_val');
		$data['antennas_fpv_monitor']        = $this->input->post('drone_master_antennas_fpv_monitor');
		$data['antennas_fpv_monitor_val']        = $this->input->post('drone_master_antennas_fpv_monitor_val');
		$data['batteries_fpv_monitor']        = $this->input->post('drone_master_batteries_fpv_monitor');
		$data['batteries_fpv_monitor_val']        = $this->input->post('drone_master_batteries_fpv_monitor_val');
		
		$data['charger_fpv_monitor']        = $this->input->post('drone_master_charger_fpv_monitor');
		$data['charger_fpv_monitor_val']        = $this->input->post('drone_master_charger_fpv_monitor_val');
		$data['sun_shades_fpv_monitor']        = $this->input->post('drone_master_sun_shades_fpv_monitor');
		$data['sun_shades_fpv_monitor_val']        = $this->input->post('drone_master_sun_shades_fpv_monitor_val');
		$data['console_fpv_monitor']        = $this->input->post('drone_master_console_fpv_monitor');
		$data['console_fpv_monitor_val']        = $this->input->post('drone_master_console_fpv_monitor_val');

		$data['micro_sd_cards']        = $this->input->post('drone_master_micro_sd_cards');
		$data['micro_sd_cards_val']        = $this->input->post('drone_master_micro_sd_cards_val');
		$data['hardcase']        = $this->input->post('drone_master_hardcase');
		$data['hardcase_val']        = $this->input->post('drone_master_hardcase_val');
		$data['spare_screws']        = $this->input->post('drone_master_spare_screws');
		$data['spare_screws_val']        = $this->input->post('drone_master_spare_screws_val');
		if ($type == 'insert')
		{
			$id = $this->drone_master_model->insert($data);

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
			$return = $this->drone_master_model->update($id, $data);
		}

		return $return;
	}

	//-------------------------------------------------------------------------------------------------
		function loadDrone()
		{
			$id = $_GET['droneid'];
			$droneSet = $this->load->model('drone_master_model')->find($id);
			echo json_encode($droneSet);			
		}	
	//-------------------------------------------------------------------------------------------------

}