<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * managesim controller
 */
class managesim extends Admin_Controller
{

	//--------------------------------------------------------------------


	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('SIM_Info.Managesim.View');
		$this->load->model('sim_info_model', null, true);
		$this->lang->load('sim_info');
		
		Template::set_block('sub_nav', 'managesim/_sub_nav');

		Assets::add_module_js('sim_info', 'sim_info.js');
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
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
					$result = $this->sim_info_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('sim_info_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('sim_info_delete_failure') . $this->sim_info_model->error, 'error');
				}
			}
		}

		$records = "SELECT * FROM bf_sim_info WHERE bf_sim_info.id NOT IN(select bf_sim_info.id from bf_sim_info where bf_sim_info.deleted=1)";
		$List = $this->db->query($records);
		//$records = $this->sim_info_model->find_all();
		Template::set('records', $List->result());
		Template::set('toolbar_title', 'Manage SIM Info');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a SIM Info object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('SIM_Info.Managesim.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_sim_info())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('sim_info_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'sim_info');

				Template::set_message(lang('sim_info_create_success'), 'success');
				redirect(SITE_AREA .'/managesim/sim_info');
			}
			else
			{
				Template::set_message(lang('sim_info_create_failure') . $this->sim_info_model->error, 'error');
			}
		}
		Assets::add_module_js('sim_info', 'sim_info.js');

		Template::set('toolbar_title', lang('sim_info_create') . ' SIM Info');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of SIM Info data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('sim_info_invalid_id'), 'error');
			redirect(SITE_AREA .'/managesim/sim_info');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('SIM_Info.Managesim.Edit');

			if ($this->save_sim_info('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('sim_info_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'sim_info');

				Template::set_message(lang('sim_info_edit_success'), 'success');
                                redirect(SITE_AREA .'/managesim/sim_info');
			}
			else
			{
				Template::set_message(lang('sim_info_edit_failure') . $this->sim_info_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('SIM_Info.Managesim.Delete');

			if ($this->sim_info_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('sim_info_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'sim_info');

				Template::set_message(lang('sim_info_delete_success'), 'success');

				redirect(SITE_AREA .'/managesim/sim_info');
			}
			else
			{
				Template::set_message(lang('sim_info_delete_failure') . $this->sim_info_model->error, 'error');
			}
		}
		Template::set('sim_info', $this->sim_info_model->find($id));
		Template::set('toolbar_title', lang('sim_info_edit') .' SIM Info');
		Template::render();
	}

	//--------------------------------------------------------------------

	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/**
	 * Summary
	 *
	 * @param String $type Either "insert" or "update"
	 * @param Int	 $id	The ID of the record to update, ignored on inserts
	 *
	 * @return Mixed    An INT id for successful inserts, TRUE for successful updates, else FALSE
	 */
	private function save_sim_info($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['simCardName']        = $this->input->post('sim_info_simCardName');
		$data['puk']        = $this->input->post('sim_info_puk');
		$data['pin']        = $this->input->post('sim_info_pin');
		$data['simCardNumber']        = $this->input->post('sim_info_simCardNumber');
		$data['telephoneNumber']        = $this->input->post('sim_info_telephoneNumber');
		$data['balance']        = $this->input->post('sim_info_balance');
		$data['comment']        = $this->input->post('sim_info_comment');
		$data['deleted']	=	0; 
		if ($type == 'insert')
		{
			$id = $this->sim_info_model->insert($data);

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
			$return = $this->sim_info_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}