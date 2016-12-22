<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Home
 * @property generalfunction_library $generalfunction_library
 * @property locations_model $locations_model
 * @property dashboard_model $dashboard_model
 * @property login_model $login_model
 */

class Home extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('locations_model');
        $this->load->model('dashboard_model');
        $this->load->model('login_model');
    }

    public function index()
	{
/*        if(!isset($this->currentLocation) || isSessionVariableSet($this->currentLocation) === false)
        {
            if($this->userType != GUEST_USER)
            {
                redirect(base_url().'location-select');
            }
        }*/


		$data = array();
		$data['globalStyle'] = $this->dataformatinghtml_library->getGlobalStyleHtml($data);
		$data['globalJs'] = $this->dataformatinghtml_library->getGlobalJsHtml($data);
		$data['headerView'] = $this->dataformatinghtml_library->getHeaderHtml($data);
        if(isSessionVariableSet($this->isUserSession) === true)
        {
            $data['title'] = 'Home :: Doolally';
        }
        else
        {
            $data['title'] = 'Login :: Doolally';
        }
		$this->load->view('HomeView', $data);
	}

    public function main()
    {
        $data = array();
        if(isSessionVariableSet($this->isUserSession) === false)
        {
            redirect(base_url());
        }
        $data['globalStyle'] = $this->dataformatinghtml_library->getGlobalStyleHtml($data);
        $data['globalJs'] = $this->dataformatinghtml_library->getGlobalJsHtml($data);
        $data['headerView'] = $this->dataformatinghtml_library->getHeaderHtml($data);

        $this->load->view('MainView', $data);
    }
    public function getLocation()
    {
        if(isSessionVariableSet($this->isUserSession) === false)
        {
            redirect(base_url());
        }
        $data = array();
        if(isset($this->session->page_url))
        {
            $data['pageUrl']= $this->session->page_url;
            $this->session->unset_userdata('page_url');
        }

        $data['locData'] = $this->locations_model->getAllLocations();
        $data['globalStyle'] = $this->dataformatinghtml_library->getGlobalStyleHtml($data);
        $data['globalJs'] = $this->dataformatinghtml_library->getGlobalJsHtml($data);
        $data['headerView'] = $this->dataformatinghtml_library->getHeaderHtml($data);

        $this->load->view('LocSelectView', $data);
    }

    public function setLocation()
    {
        $post = $this->input->post();
        if(isSessionVariableSet($this->isUserSession) === false)
        {
            redirect(base_url());
        }

        $this->generalfunction_library->setSessionVariable("currentLocation",$post['currentLoc']);
        if(isset($post['pageUrl']))
        {
            redirect($post['pageUrl']);
        }
        else
        {
            redirect(base_url());
        }

    }
    public function eventFetch($eventId, $evenHash)
    {
        if(isSessionVariableSet($this->isUserSession) === false)
        {
            redirect(base_url());
        }
        if(hash_compare(encrypt_data($eventId),$evenHash))
        {
            $data = array();

            /*if($this->session->userdata('osType') == 'android')
            {*/
            $data['globalStyle'] = $this->dataformatinghtml_library->getGlobalStyleHtml($data);
            $data['globalJs'] = $this->dataformatinghtml_library->getGlobalJsHtml($data);
            $data['headerView'] = $this->dataformatinghtml_library->getHeaderHtml($data);
            $decodedS = explode('-',$eventId);
            $eventId = $decodedS[count($decodedS)-1];
            $events = $this->dashboard_model->getEventById($eventId);
            if(isset($events) && myIsMultiArray($events))
            {
                foreach($events as $key => $row)
                {
                    $loc = $this->locations_model->getLocationDetailsById($row['eventPlace']);
                    $row['locData'] = $loc['locData'];
                    $data['eventDetails'][$key]['eventData'] = $row;
                    $data['eventDetails'][$key]['eventAtt'] = $this->dashboard_model->getEventAttById($row['eventId']);
                }
            }

            $this->load->view('EventViewer', $data);
        }
        else
        {
            redirect(PAGE_404);
        }

        //echo json_encode($aboutView);
    }

    function sendOtp()
    {
        $data = array();
        $ipGot = $_SERVER['REMOTE_ADDR'];
        $Mobnum = '';
        if(isset($this->config->item('login_ip_mob_map')[$ipGot]))
        {
            $Mobnum = $this->config->item('login_ip_mob_map')[$ipGot];

            $userCheck = $this->login_model->checkUserByMob($Mobnum);

            if($userCheck['status'] == true)
            {
                if($userCheck['ifActive'] == NOT_ACTIVE)
                {
                    $data['status'] = false;
                    $data['errorMsg'] = 'User is Disabled!';
                }
                else
                {
                    //code for attempt validation
                    if($userCheck == 3)
                    {
                        $postData = array(
                            'ifActive'=>'0'
                        );
                        $this->login_model->updateUserRecord($userCheck['userId'],$postData);
                        $data['status'] = false;
                        $data['errorMsg'] = 'User is Disabled!';
                    }
                    else
                    {
                        $newAttempt = $userCheck['attemptTimes'] + 1;
                        $details = array(
                            'attemptTimes'=> $newAttempt
                        );
                        $this->login_model->updateUserRecord($userCheck['userId'],$details);

                        $newOtp = mt_rand(10000,999999);

                        $details = array(
                            'userOtp'=> $newOtp
                        );
                        $this->login_model->updateUserRecord($userCheck['userId'],$details);

                        $numbers = array('91'.$Mobnum);

                        $postDetails = array(
                            'apiKey' => TEXTLOCAL_API,
                            'numbers' => implode(',', $numbers),
                            'sender'=> urlencode('DOLALY'),
                            'message' => rawurlencode($newOtp.' is Your OTP for login')
                        );
                        $smsStatus = $this->curl_library->sendCouponSMS($postDetails);
                        if($smsStatus['status'] == 'failure')
                        {
                            $data['status'] = false;
                            $details = array(
                                'attemptTimes'=> $userCheck['attemptTimes']
                            );
                            $this->login_model->updateUserRecord($userCheck['userId'],$details);
                            if(isset($smsStatus['warnings']))
                            {
                                $data['errorMsg'] = $smsStatus['warnings'][0]['message'];
                            }
                            else
                            {
                                $data['errorMsg'] = $smsStatus['errors'][0]['message'];
                            }
                        }
                        else
                        {
                            $data['mobNum'] = $Mobnum;
                            $data['status'] = true;
                        }
                    }
                }
            }
            else
            {
                $data['status'] = false;
                $data['errorMsg'] = 'User Not Found!';
            }

        }
        else
        {
            $data['status'] = false;
            $data['errorMsg'] = 'Invalid Server Request!';
        }

        echo json_encode($data);
    }

    function getNewOtp()
    {

    }
}
