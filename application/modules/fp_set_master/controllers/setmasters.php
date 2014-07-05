<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class setmasters extends Admin_Controller
{

	//--------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('FP_Set_Master.Setmasters.View');
		$this->load->model('fp_set_master_model', null, true);
		$this->lang->load('fp_set_master');
		
		Template::set_block('sub_nav', 'setmasters/_sub_nav');

		Assets::add_module_js('fp_set_master', 'fp_set_master.js');
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
					$result = $this->fp_set_master_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('fp_set_master_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('fp_set_master_delete_failure') . $this->fp_set_master_model->error, 'error');
				}
			}
		}

		//$records = $this->fp_set_master_model->find_all();
		$records = "select * from bf_fp_set_master LIMIT ".$this->limit." OFFSET ".$offset."";
		$List = $this->db->query($records);
		Template::set('records', $List->result());
		
		
		$this->load->library('pagination');
		$total_users = $this->fp_set_master_model->count_all();
		$config['base_url'] = site_url(SITE_AREA ."/setmasters/fp_set_master/index/");
		$config['total_rows'] = $total_users;
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = 5;	
		$this->pagination->initialize($config);
		Template::set('index_url', site_url(SITE_AREA .'/setmasters/fp_set_master/index/') .'/');
		
		Template::set('toolbar_title', 'Manage FP Set Master');
		Template::render();
	}

	//--------------------------------------------------------------------

	public function create()
	{
		$this->auth->restrict('FP_Set_Master.Setmasters.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_fp_set_master())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('fp_set_master_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'fp_set_master');

				Template::set_message(lang('fp_set_master_create_success'), 'success');
				redirect(SITE_AREA .'/setmasters/fp_set_master');
			}
			else
			{
				Template::set_message(lang('fp_set_master_create_failure') . $this->fp_set_master_model->error, 'error');
			}
		}
		Assets::add_module_js('fp_set_master', 'fp_set_master.js');

		Template::set('toolbar_title', lang('fp_set_master_create') . ' FP Set Master');
		Template::render();
	}

	//--------------------------------------------------------------------


	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('fp_set_master_invalid_id'), 'error');
			redirect(SITE_AREA .'/setmasters/fp_set_master');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('FP_Set_Master.Setmasters.Edit');

			if ($this->save_fp_set_master('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('fp_set_master_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'fp_set_master');

				Template::set_message(lang('fp_set_master_edit_success'), 'success');
				redirect(SITE_AREA .'/setmasters/fp_set_master');
			}
			else
			{
				Template::set_message(lang('fp_set_master_edit_failure') . $this->fp_set_master_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('FP_Set_Master.Setmasters.Delete');

			if ($this->fp_set_master_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('fp_set_master_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'fp_set_master');

				Template::set_message(lang('fp_set_master_delete_success'), 'success');

				redirect(SITE_AREA .'/setmasters/fp_set_master');
			}
			else
			{
				Template::set_message(lang('fp_set_master_delete_failure') . $this->fp_set_master_model->error, 'error');
			}
		}
		Template::set('fp_set_master', $this->fp_set_master_model->find($id));
		Template::set('toolbar_title', lang('fp_set_master_edit') .' FP Set Master');
		Template::render();
	}

	//--------------------------------------------------------------------

	private function save_fp_set_master($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['setType']        = $this->input->post('fp_set_master_setType');
		$data['panasonic_HCV700']        = $this->input->post('fp_set_master_panasonic_HCV700');
		$data['V700']        = $this->input->post('fp_set_master_V700');
		$data['microphone_rode']        = $this->input->post('fp_set_master_microphone_rode');

		 		$data['macbook13']               = $this->input->post('fp_set_master_macbook13');
                $data['mac13']                   = $this->input->post('fp_set_master_mac13');
                $data['panasonic_HCV727']        = $this->input->post('fp_set_master_panasonic_HCV727');
                $data['V727']                    = $this->input->post('fp_set_master_V727');
                $data['extension_cable']         = $this->input->post('fp_set_master_extension_cable');
                $data['macbook15']               = $this->input->post('fp_set_master_macbook15');
                $data['camera_checkbox1']        = $this->input->post('fp_set_master_camera_checkbox1'); 
                $data['camera_value1']           = $this->input->post('fp_set_master_camera_value1');
                $data['audio_checkbox1']         = $this->input->post('fp_set_master_audio_checkbox1');
                $data['audio_value1']            = $this->input->post('fp_set_master_audio_value1');
                $data['recorder_sony_PMW50']     = $this->input->post('fp_set_master_recorder_sony_PMW50');
                $data['camera_checkbox2']        = $this->input->post('fp_set_master_camera_checkbox2');
                $data['camera_value2']           = $this->input->post('fp_set_master_camera_value2');
                $data['audio_checkbox2']         = $this->input->post('fp_set_master_audio_checkbox2');
                $data['audio_value2']            = $this->input->post('fp_set_master_audio_value2');
                $data['aja_interface']           = $this->input->post('fp_set_master_aja_interface');
                $data['camera_checkbox3']        = $this->input->post('fp_set_master_camera_checkbox3');
                $data['camera_value3']           = $this->input->post('fp_set_master_camera_value3');
                $data['sxs_card_reader']         = $this->input->post('fp_set_master_sxs_card_reader');
                $data['liveu']                   = $this->input->post('fp_set_master_liveu');
                $data['thunderbold_SSD_cable']   = $this->input->post('fp_set_master_thunderbold_SSD_cable');
                $data['SD_card_amount']          = $this->input->post('fp_set_master_SD_card_amount');
                $data['sccard_amount']           = $this->input->post('fp_set_master_sccard_amount');
                $data['minicaster']              = $this->input->post('fp_set_master_minicaster');
                $data['mac_charger']             = $this->input->post('fp_set_master_mac_charger');
                $data['mini_sd_card']            = $this->input->post('fp_set_master_mini_sd_card');
                $data['mini_sd_card_amount']     = $this->input->post('fp_set_master_mini_sd_card_amount');
                $data['newsspotter']             = $this->input->post('fp_set_master_newsspotter');
                $data['peripherals_checkbox1']   = $this->input->post('fp_set_master_peripherals_checkbox1');
                $data['peripherals_value1']      = $this->input->post('fp_set_master_peripherals_value1');
                $data['sd_card_adaptor']         = $this->input->post('fp_set_master_sd_card_adaptor');
                $data['BGAN_explorer']           = $this->input->post('fp_set_master_BGAN_explorer');
                $data['peripherals_checkbox2']   = $this->input->post('fp_set_master_peripherals_checkbox2');
                $data['peripherals_value2']      = $this->input->post('fp_set_master_peripherals_value2');
                $data['battery_700_small']       = $this->input->post('fp_set_master_battery_700_small');
                $data['battery_700_small_amount']= $this->input->post('fp_set_master_battery_700_small_amount');
                $data['cullmann_magnesit']       = $this->input->post('fp_set_master_cullmann_magnesit');
                $data['walkie_talkie']           = $this->input->post('fp_set_master_walkie_talkie');
                $data['battery_700_big']         = $this->input->post('fp_set_master_battery_700_big');
                $data['battery_700_big_amount']  = $this->input->post('fp_set_master_battery_700_big_amount');
                $data['cullmann_nanomax']        = $this->input->post('fp_set_master_cullmann_nanomax');
                $data['first_aid_kit']           = $this->input->post('fp_set_master_first_aid_kit');
                $data['battery_727VWVBT190']     = $this->input->post('fp_set_master_battery_727VWVBT190');
                $data['battery_727VWVBT190_amount'] = $this->input->post('fp_set_master_battery_727VWVBT190_amount');
                $data['tripods_checkbox1']       = $this->input->post('fp_set_master_tripods_checkbox1');
                $data['backpack']                = $this->input->post('fp_set_master_backpack');
                $data['battery_727VWVBT380']     = $this->input->post('fp_set_master_battery_727VWVBT380');
                $data['battery_727VWVBT380_amount'] = $this->input->post('fp_set_master_battery_727VWVBT380_amount');
                $data['tripods_checkbox2']          = $this->input->post('fp_set_master_tripods_checkbox2');
                $data['tripods_value2']             = $this->input->post('fp_set_master_tripods_value2');
                $data['miscellaneous_checkbox1']     = $this->input->post('fp_set_master_miscellaneous_checkbox1');
                $data['miscellaneous_value1']       = $this->input->post('fp_set_master_miscellaneous_value1');
                $data['battery_handycam']           = $this->input->post('fp_set_master_battery_handycam');
                $data['battery_handycam_amount']    = $this->input->post('fp_set_master_battery_handycam_amount');
                $data['tripods_checkbox3']          = $this->input->post('fp_set_master_tripods_checkbox3');
                $data['tripods_value3']             = $this->input->post('fp_set_master_tripods_value3');
                $data['miscellaneous_checkbox2']    = $this->input->post('fp_set_master_miscellaneous_checkbox2');
                $data['miscellaneous_value2']       = $this->input->post('fp_set_master_miscellaneous_value2');
                $data['charger_patona']             = $this->input->post('fp_set_master_charger_patona');
                $data['tripods_checkbox4']          = $this->input->post('fp_set_master_tripods_checkbox4');
                $data['tripods_value4']             = $this->input->post('fp_set_master_tripods_value4');
                $data['miscellaneous_checkbox3']    = $this->input->post('fp_set_master_miscellaneous_checkbox3');
                $data['miscellaneous_value3']       = $this->input->post('fp_set_master_miscellaneous_value3');
                $data['charger_panasonic_VSK0781SND3BMT']  = $this->input->post('fp_set_master_charger_panasonic_VSK0781SND3BMT');
                $data['tripods_checkbox5']          = $this->input->post('fp_set_master_tripods_checkbox5');
                $data['tripods_value5']             = $this->input->post('fp_set_master_tripods_value5');
                $data['miscellaneous_checkbox4']    = $this->input->post('fp_set_master_miscellaneous_checkbox4');
                $data['miscellaneous_value4']       = $this->input->post('fp_set_master_miscellaneous_value4');
                $data['Battery_small_panasonic']    = $this->input->post('fp_set_master_Battery_small_panasonic');
                $data['batterysmallpanasonic']      = $this->input->post('fp_set_master_batterysmallpanasonic');
                $data['one_cam_charger_panasonic']  = $this->input->post('fp_set_master_one_cam_charger_panasonic');
                $data['onecamchargerpanasonic']     = $this->input->post('fp_set_master_onecamchargerpanasonic');
                $data['one_battery_small_panasonic']= $this->input->post('fp_set_master_one_battery_small_panasonic');
                $data['onebatterysmallpanasonic']   = $this->input->post('fp_set_master_onebatterysmallpanasonic');
		if ($type == 'insert')
		{
			$id = $this->fp_set_master_model->insert($data);

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
			$return = $this->fp_set_master_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------------------------------------
	
	
		function loadFpSet()
		{
			$id = $_GET['fpsetId'];
			$fpSet = $this->load->model('fp_set_master_model')->find($id);
			echo json_encode($fpSet);			
		}	
	//---------------------------------------------------------------------------------------------------

}