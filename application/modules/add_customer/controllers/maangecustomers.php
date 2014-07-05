<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class maangecustomers extends Admin_Controller
{

	//--------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Add_Customer.Maangecustomers.View');
		$this->load->model('add_customer_model', null, true);
		$this->lang->load('add_customer');
		
		Template::set_block('sub_nav', 'maangecustomers/_sub_nav');

		Assets::add_module_js('add_customer', 'add_customer.js');
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
					$result = $this->add_customer_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('add_customer_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('add_customer_delete_failure') . $this->add_customer_model->error, 'error');
				}
			}
		}
		
		//===========================Pagination===============================================================
		
			$records = "SELECT * FROM bf_add_customer WHERE bf_add_customer.id NOT IN(select bf_add_customer.id from bf_add_customer where bf_add_customer.deleted=1) LIMIT ".$this->limit." OFFSET ".$offset."";
			$List = $this->db->query($records);
			Template::set('records', $List->result());
		
			$this->load->library('pagination');
	
			$total_users = $this->add_customer_model->count_all();
			$config['base_url'] = site_url(SITE_AREA ."/maangecustomers/add_customer/index/");
			$config['total_rows'] = $total_users;
			$config['per_page'] = $this->limit;
			$config['uri_segment']	= 5;
	
			$this->pagination->initialize($config);
			Template::set('index_url', site_url(SITE_AREA .'/maangecustomers/add_customer/index/') .'/');
		
			Template::set('toolbar_title', 'Manage Add Customer');
			Template::render();
	}

		//--------------------------------------------------------------------

	public function create()
	{
		$this->auth->restrict('Add_Customer.Maangecustomers.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_add_customer())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('add_customer_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'add_customer');

				Template::set_message(lang('add_customer_create_success'), 'success');
				redirect(SITE_AREA .'/maangecustomers/add_customer');
			}
			else
			{
				Template::set_message(lang('add_customer_create_failure') . $this->add_customer_model->error, 'error');
			}
		}
		Assets::add_module_js('add_customer', 'add_customer.js');

		Template::set('toolbar_title', lang('add_customer_create') . ' Add Customer');
		Template::render();
	}

	//--------------------------------------------------------------------

	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('add_customer_invalid_id'), 'error');
			redirect(SITE_AREA .'/maangecustomers/add_customer');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Add_Customer.Maangecustomers.Edit');

			if ($this->save_add_customer('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('add_customer_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'add_customer');

				Template::set_message(lang('add_customer_edit_success'), 'success');
				redirect(SITE_AREA .'/maangecustomers/add_customer');
			}
			else
			{
				Template::set_message(lang('add_customer_edit_failure') . $this->add_customer_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Add_Customer.Maangecustomers.Delete');

			if ($this->add_customer_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('add_customer_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'add_customer');

				Template::set_message(lang('add_customer_delete_success'), 'success');

				redirect(SITE_AREA .'/maangecustomers/add_customer');
			}
			else
			{
				Template::set_message(lang('add_customer_delete_failure') . $this->add_customer_model->error, 'error');
			}
		}
		Template::set('add_customer', $this->add_customer_model->find($id));
		Template::set('toolbar_title', lang('add_customer_edit') .' Add Customer');
		Template::render();
	}

	//--------------------------------------------------------------------
	
	private function save_add_customer($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		
		$data = array();
		$data['name']        = $this->input->post('add_customer_name');
		$data['customfield']        = $this->input->post('add_customer_customfield');

		if ($type == 'insert')
		{
			$id = $this->add_customer_model->insert($data);

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
			$return = $this->add_customer_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}