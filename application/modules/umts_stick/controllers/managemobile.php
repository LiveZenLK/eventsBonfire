<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * managemobile controller
 */
class managemobile extends Admin_Controller
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

		$this->auth->restrict('UMTS_Stick.Managemobile.View');
		$this->load->model('umts_stick_model', null, true);
		$this->lang->load('umts_stick');
		
		Template::set_block('sub_nav', 'managemobile/_sub_nav');

		Assets::add_module_js('umts_stick', 'umts_stick.js');
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
					$result = $this->umts_stick_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('umts_stick_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('umts_stick_delete_failure') . $this->umts_stick_model->error, 'error');
				}
			}
		}
		
		$records = "SELECT * FROM bf_umts_stick WHERE bf_umts_stick.id NOT IN(select bf_umts_stick.id from bf_umts_stick where bf_umts_stick.deleted=1)";
		$List = $this->db->query($records);
		
		//$records = $this->umts_stick_model->find_all();

		Template::set('records', $List->result());
		Template::set('toolbar_title', 'Manage UMTS Stick');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a UMTS Stick object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('UMTS_Stick.Managemobile.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_umts_stick())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('umts_stick_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'umts_stick');

				Template::set_message(lang('umts_stick_create_success'), 'success');
				redirect(SITE_AREA .'/managemobile/umts_stick');
			}
			else
			{
				Template::set_message(lang('umts_stick_create_failure') . $this->umts_stick_model->error, 'error');
			}
		}
		Assets::add_module_js('umts_stick', 'umts_stick.js');

		Template::set('toolbar_title', lang('umts_stick_create') . ' UMTS Stick');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of UMTS Stick data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('umts_stick_invalid_id'), 'error');
			redirect(SITE_AREA .'/managemobile/umts_stick');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('UMTS_Stick.Managemobile.Edit');

			if ($this->save_umts_stick('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('umts_stick_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'umts_stick');

				Template::set_message(lang('umts_stick_edit_success'), 'success');
                                redirect(SITE_AREA .'/managemobile/umts_stick');
			}
			else
			{
				Template::set_message(lang('umts_stick_edit_failure') . $this->umts_stick_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('UMTS_Stick.Managemobile.Delete');

			if ($this->umts_stick_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('umts_stick_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'umts_stick');

				Template::set_message(lang('umts_stick_delete_success'), 'success');

				redirect(SITE_AREA .'/managemobile/umts_stick');
			}
			else
			{
				Template::set_message(lang('umts_stick_delete_failure') . $this->umts_stick_model->error, 'error');
			}
		}
		Template::set('umts_stick', $this->umts_stick_model->find($id));
		Template::set('toolbar_title', lang('umts_stick_edit') .' UMTS Stick');
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
	private function save_umts_stick($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['articleDescription']        = $this->input->post('umts_stick_articleDescription');
		$data['serialNumber']        = $this->input->post('umts_stick_serialNumber');
		$data['imeiNumber']        = $this->input->post('umts_stick_imeiNumber');
		$data['inventoryNumber']        = $this->input->post('umts_stick_inventoryNumber');
		$data['customField']        = $this->input->post('umts_stick_customField');
		$data['deleted']	=	0; 

		if ($type == 'insert')
		{
			$id = $this->umts_stick_model->insert($data);

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
			$return = $this->umts_stick_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}