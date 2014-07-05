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

		$this->auth->restrict('UMTS_SIM.Managesim.View');
		$this->load->model('umts_sim_model', null, true);
		$this->lang->load('umts_sim');
		
		Template::set_block('sub_nav', 'managesim/_sub_nav');

		Assets::add_module_js('umts_sim', 'umts_sim.js');
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
					$result = $this->umts_sim_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('umts_sim_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('umts_sim_delete_failure') . $this->umts_sim_model->error, 'error');
				}
			}
		}

		$records = "SELECT * FROM bf_umts_sim WHERE bf_umts_sim.id NOT IN(select bf_umts_sim.id from bf_umts_sim where bf_umts_sim.deleted=1)";
		$List = $this->db->query($records);
		
		//Template::set('records', $List->result());
		//$records = $this->umts_sim_model->find_all();

		Template::set('records', $List->result());
		Template::set('toolbar_title', 'Manage UMTS SIM');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a UMTS SIM object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('UMTS_SIM.Managesim.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_umts_sim())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('umts_sim_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'umts_sim');

				Template::set_message(lang('umts_sim_create_success'), 'success');
				redirect(SITE_AREA .'/managesim/umts_sim');
			}
			else
			{
				Template::set_message(lang('umts_sim_create_failure') . $this->umts_sim_model->error, 'error');
			}
		}
		Assets::add_module_js('umts_sim', 'umts_sim.js');

		Template::set('toolbar_title', lang('umts_sim_create') . ' UMTS SIM');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of UMTS SIM data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('umts_sim_invalid_id'), 'error');
			redirect(SITE_AREA .'/managesim/umts_sim');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('UMTS_SIM.Managesim.Edit');

			if ($this->save_umts_sim('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('umts_sim_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'umts_sim');

				Template::set_message(lang('umts_sim_edit_success'), 'success');
                                redirect(SITE_AREA .'/managesim/umts_sim');
			}
			else
			{
				Template::set_message(lang('umts_sim_edit_failure') . $this->umts_sim_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('UMTS_SIM.Managesim.Delete');

			if ($this->umts_sim_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('umts_sim_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'umts_sim');

				Template::set_message(lang('umts_sim_delete_success'), 'success');

				redirect(SITE_AREA .'/managesim/umts_sim');
			}
			else
			{
				Template::set_message(lang('umts_sim_delete_failure') . $this->umts_sim_model->error, 'error');
			}
		}
		Template::set('umts_sim', $this->umts_sim_model->find($id));
		Template::set('toolbar_title', lang('umts_sim_edit') .' UMTS SIM');
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
	private function save_umts_sim($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['simCardName']        = $this->input->post('umts_sim_simCardName');
		$data['puk']        = $this->input->post('umts_sim_puk');
		$data['pin']        = $this->input->post('umts_sim_pin');
		$data['simCardNumber']        = $this->input->post('umts_sim_simCardNumber');
		$data['telephoneNumber']        = $this->input->post('umts_sim_telephoneNumber');
		$data['balance']        = null;
		$data['comment']        = $this->input->post('umts_sim_comment');
		$data['deleted']	=	0; 

		if ($type == 'insert')
		{
			$id = $this->umts_sim_model->insert($data);

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
			$return = $this->umts_sim_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}