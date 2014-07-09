<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class managemobile extends Admin_Controller
{

	//--------------------------------------------------------------------


	
	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Mobile.Managemobile.View');
		$this->load->model('mobile_model', null, true);
		$this->lang->load('mobile');
		
		Template::set_block('sub_nav', 'managemobile/_sub_nav');

		Assets::add_module_js('mobile', 'mobile.js');
		Assets::add_module_css('mobile', 'table.css');
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
					$result = $this->mobile_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('mobile_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('mobile_delete_failure') . $this->mobile_model->error, 'error');
				}
			}
		}


		if (isset($_POST['search'])) 
			{
				if ($_POST['searchType'] == 'imei') 
					{
						$like_mobile = "%" . $_POST['searchString'] . "%";
						$this -> mobile_model -> where("imeiNumber like ", $like_mobile);
						$this -> mobile_model -> where("deleted", 0);
						$records = $this -> mobile_model -> find_all();
					} 
				else 
					{
						$records = $this -> mobile_model -> find_all_by("deleted", 0);
					}
			} 
		else 
			{
				$records = $this -> mobile_model -> find_all_by("deleted", 0);
			}

		$this->load->library('pagination');
		$total_users = count($records);
		$config['base_url'] = site_url(SITE_AREA ."/managemobile/mobile/index/");
		$config['total_rows'] = $total_users;
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = 5;	
		$this->pagination->initialize($config);
		
		if ($records) 
		{
			Template::set('records', array_splice($records, $offset, $this -> limit));
		} 
		else 
		{
			Template::set('records', $records);
		} 
			
			
		Template::set('index_url', site_url(SITE_AREA .'/managemobile/mobile/index/') .'/');
		Template::set('toolbar_title', 'Manage Mobile');
		Template::render();
	}

	//--------------------------------------------------------------------

	public function create()
	{
		$this->auth->restrict('Mobile.Managemobile.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_mobile())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('mobile_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'mobile');

				Template::set_message(lang('mobile_create_success'), 'success');
				redirect(SITE_AREA .'/managemobile/mobile');
			}
			else
			{
				Template::set_message(lang('mobile_create_failure') . $this->mobile_model->error, 'error');
			}
		}
		Assets::add_module_js('mobile', 'mobile.js');
		Template::set('toolbar_title', lang('mobile_create') . ' Mobile');
		Template::render();
	}

	//--------------------------------------------------------------------


	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('mobile_invalid_id'), 'error');
			redirect(SITE_AREA .'/managemobile/mobile');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Mobile.Managemobile.Edit');

			if ($this->save_mobile('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('mobile_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'mobile');

				Template::set_message(lang('mobile_edit_success'), 'success');
                                redirect(SITE_AREA .'/managemobile/mobile');
			}
			else
			{
				Template::set_message(lang('mobile_edit_failure') . $this->mobile_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Mobile.Managemobile.Delete');

			if ($this->mobile_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('mobile_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'mobile');

				Template::set_message(lang('mobile_delete_success'), 'success');

				redirect(SITE_AREA .'/managemobile/mobile');
			}
			else
			{
				Template::set_message(lang('mobile_delete_failure') . $this->mobile_model->error, 'error');
			}
		}
		Template::set('mobile', $this->mobile_model->find($id));
		Template::set('toolbar_title', lang('mobile_edit') .' Mobile');
		Template::render();
	}

	//--------------------------------------------------------------------

	private function save_mobile($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['articleDescription']        = $this->input->post('mobile_articleDescription');
		$data['serialNumber']        = $this->input->post('mobile_serialNumber');
		$data['imeiNumber']        = $this->input->post('mobile_imeiNumber');
		$data['inventoryNumber']        = $this->input->post('mobile_inventoryNumber');
		$data['customField']        = $this->input->post('mobile_customField');
		$data['deleted']	=	0; 

		if ($type == 'insert')
		{
			$id = $this->mobile_model->insert($data);

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
			$return = $this->mobile_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}