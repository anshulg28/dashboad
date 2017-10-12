<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Users
 * @property Users_Model $users_model
 * @property Maintenance_Model $maintenance_model
 * @property Locations_Model $locations_model
*/

class Maintenance extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('maintenance_model');
		$this->load->model('locations_model');
	}
	public function index()
	{
        $data = array();
        if(isSessionVariableSet($this->isUserSession) === false)
        {
            redirect(base_url());
        }

        $data['globalStyle'] = $this->dataformatinghtml_library->getGlobalStyleHtml($data);
        $data['globalJs'] = $this->dataformatinghtml_library->getGlobalJsHtml($data);
        $data['headerView'] = $this->dataformatinghtml_library->getHeaderHtml($data);

        $this->load->view('maintenance/MainView', $data);
	}

	public function logbook()
    {
        $data = array();
        if(isSessionVariableSet($this->isUserSession) === false)
        {
            redirect(base_url());
        }

        $data['workAreas'] = $this->maintenance_model->getAllWorkAreas();
        $data['workTypes'] = $this->maintenance_model->getAllWorkTypes();
        $data['taprooms'] = $this->locations_model->getAllActiveLocations();

        $logId = $this->maintenance_model->getLastLogId();
        if(!isset($logId) && !myIsArray($logId))
        {
            $data['logId'] = 1;
        }
        else
        {
            $data['logId'] = ((int)$logId['complaintId'] + 1);
        }

        $data['globalStyle'] = $this->dataformatinghtml_library->getGlobalStyleHtml($data);
        $data['globalJs'] = $this->dataformatinghtml_library->getGlobalJsHtml($data);
        $data['headerView'] = $this->dataformatinghtml_library->getHeaderHtml($data);

        $this->load->view('maintenance/LogBookView', $data);
    }

    public function saveComplaint()
    {
        if(isSessionVariableSet($this->isUserSession) === false)
        {
            redirect(base_url());
        }

        $post = $this->input->post();

        $post['loggedBy'] = $this->userId;
        $post['loggedDT'] = date('Y-m-d H:i:s');
        $post['status'] = LOG_STATUS_OPEN;
        $post['lastUpdateDT'] = date('Y-m-d H:i:s');

        $this->maintenance_model->saveComplaintRecord($post);

        redirect(base_url().'maintenance');

    }

    public function actionLog()
    {
        $data = array();
        if(isSessionVariableSet($this->isUserSession) === false)
        {
            redirect(base_url());
        }

        $data['openComplaints'] = $this->maintenance_model->getOpenComplaints();
        $data['progressComplaints'] = $this->maintenance_model->getProgressComplaints();
        $data['closeComplaints'] = $this->maintenance_model->getCloseComplaints();

        $data['globalStyle'] = $this->dataformatinghtml_library->getGlobalStyleHtml($data);
        $data['globalJs'] = $this->dataformatinghtml_library->getGlobalJsHtml($data);
        $data['headerView'] = $this->dataformatinghtml_library->getHeaderHtml($data);
        $data['footerView'] = $this->dataformatinghtml_library->getFooterHtml($data);

        $this->load->view('maintenance/ActionLogView', $data);
    }

    public function getComplaintInfo($compId)
    {
        $data = array();

        echo json_encode($data);
    }

}
