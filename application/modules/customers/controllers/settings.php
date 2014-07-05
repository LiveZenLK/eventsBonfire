<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * settings controller
 */
class settings extends Admin_Controller
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

		$this->auth->restrict('Customers.Settings.View');
		$this->load->model('customers_model', null, true);
		$this->lang->load('customers');
		
		Template::set_block('sub_nav', 'settings/_sub_nav');

		Assets::add_module_js('customers', 'customers.js');
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
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
					$result = $this->customers_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('customers_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('customers_delete_failure') . $this->customers_model->error, 'error');
				}
			}
		}

		$records = "SELECT * FROM bf_customers WHERE bf_customers.id NOT IN(select bf_customers.id from bf_customers where bf_customers.deleted=1) LIMIT ".$this->limit." OFFSET ".$offset."";
		$List = $this->db->query($records);
		Template::set('records', $List->result());
		$List = $this->db->query($records);
		Template::set('records', $List->result());
		
		// ====================== Pagination =====================================================
		
		$this->load->library('pagination');
	
			$total_users = $this->customers_model->count_all();
			$config['base_url'] = site_url(SITE_AREA ."/settings/customers/index/");
			$config['total_rows'] = $total_users;
			$config['per_page'] = $this->limit;
			$config['uri_segment']	= 5;
	
			$this->pagination->initialize($config);
			Template::set('index_url', site_url(SITE_AREA .'/settings/customers/index/') .'/');
		
		// ====================== Pagination =====================================================
		
		Template::set('toolbar_title', 'Manage Customers');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Customers object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Customers.Settings.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_customers())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('customers_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'customers');

				Template::set_message(lang('customers_create_success'), 'success');
				redirect(SITE_AREA .'/settings/customers');
			}
			else
			{
				Template::set_message(lang('customers_create_failure') . $this->customers_model->error, 'error');
			}
		}
		Assets::add_module_js('customers', 'customers.js');

		Template::set('toolbar_title', lang('customers_create') . ' Customers');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Customers data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('customers_invalid_id'), 'error');
			redirect(SITE_AREA .'/settings/customers');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Customers.Settings.Edit');

			if ($this->save_customers('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('customers_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'customers');

				Template::set_message(lang('customers_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('customers_edit_failure') . $this->customers_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Customers.Settings.Delete');

			if ($this->customers_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('customers_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'customers');

				Template::set_message(lang('customers_delete_success'), 'success');

				redirect(SITE_AREA .'/settings/customers');
			}
			else
			{
				Template::set_message(lang('customers_delete_failure') . $this->customers_model->error, 'error');
			}
		}
		Template::set('customers', $this->customers_model->find($id));
		Template::set('toolbar_title', lang('customers_edit') .' Customers');
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
	private function save_customers($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['name']        = $this->input->post('customers_name');
		$data['customfield']        = $this->input->post('customers_customfield');
		$data['deleted']        = 0;

		if ($type == 'insert')
		{
			$id = $this->customers_model->insert($data);

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
			$return = $this->customers_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}