<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * umts_stick controller
 */
class umts_stick extends Front_Controller
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

		$this->load->library('form_validation');
		$this->load->model('umts_stick_model', null, true);
		$this->lang->load('umts_stick');
		

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

		$records = $this->umts_stick_model->find_all();

		Template::set('records', $records);
		Template::render();
	}

	//--------------------------------------------------------------------



}