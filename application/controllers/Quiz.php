<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Users
 * @property Users_Model $users_model
 * @property Maintenance_Model $maintenance_model
 * @property Locations_Model $locations_model
 * @property Login_Model $login_model
 * @property  Mugclub_Model $mugclub_model
*/

class Quiz extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('maintenance_model');
		$this->load->model('locations_model');
        $this->load->model('login_model');
        $this->load->model('mugclub_model');
        ini_set('memory_limit', "256M");
        ini_set('upload_max_filesize', "50M");
	}
	public function index()
	{
        $data = array();
        if(isSessionVariableSet($this->isUserSession) === false)
        {
            redirect(base_url());
        }

        if(isSessionVariableSet($this->userId))
        {
            $rols = $this->login_model->getUserRoles($this->userId);
            $data['userModules'] = explode(',',$rols['modulesAssigned']);

        }

        $data['globalStyle'] = $this->dataformatinghtml_library->getGlobalStyleHtml($data);
        $data['globalJs'] = $this->dataformatinghtml_library->getGlobalJsHtml($data);
        $data['headerView'] = $this->dataformatinghtml_library->getHeaderHtml($data);
        $data['footerView'] = $this->dataformatinghtml_library->getFooterHtml($data);
        $this->load->view('maintenance/MainView', $data);
	}

}
