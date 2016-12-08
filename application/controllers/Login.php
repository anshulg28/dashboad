<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Login
 * @property Login_Model $login_model
 * @property Users_Model $users_model
*/

class Login extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
        $this->load->model('users_model');
	}
	public function index()
	{
        $data = array();
        $data['globalStyle'] = $this->dataformatinghtml_library->getGlobalStyleHtml($data);
        $data['globalJs'] = $this->dataformatinghtml_library->getGlobalJsHtml($data);
        $data['headerView'] = $this->dataformatinghtml_library->getHeaderHtml($data);

        if(isSessionVariableSet($this->isUserSession) === true)
        {
            redirect(base_url().'home');
        }
        else
        {
            $this->load->view('LoginView', $data);
        }
	}
    public function checkUser($responseType = RESPONSE_RETURN)
    {
        $post = $this->input->post();
        $userResult='';
        $isPinUsed = 0;
        $userNameCheck = '';

        if(isset($post['userName']) && $post['userName'] != '' && isset($post['password']) && $post['password'] != '')
        {
            $userNameCheck = $this->login_model->checkUsername($post['userName']);
            $userResult = $this->login_model->checkUser($post['userName'],md5($post['password']));
        }
        else
        {
            $data['status'] = false;
            $data['errorMsg'] = 'Invalid Login Method!';
            /*$loginPin = '';

            if(!isset($post['loginPin1']))
            {
                $post['loginPin1'] = '0';
            }
            if(!isset($post['loginPin2']))
            {
                $post['loginPin2'] = '0';
            }
            if(!isset($post['loginPin3']))
            {
                $post['loginPin3'] = '0';
            }
            if(!isset($post['loginPin4']))
            {
                $post['loginPin4'] = '0';
            }
            $loginPin .= $post['loginPin1'] . $post['loginPin2'] . $post['loginPin3'] . $post['loginPin4'];
            $isPinUsed = 1;
            $userResult = $this->login_model->checkUserByPin(md5($loginPin));*/
        }
        if($userNameCheck['status'] === true)
        {
            if($userResult['status'] === true && $userResult['userId'] != 0)
            {
                if($userResult['ifActive'] == NOT_ACTIVE)
                {
                    $data['errorMsg'] = 'User Account is Disabled!';
                    $data['status'] = false;
                }
                else
                {
                    if($userResult['userType'] == '4' && $userResult['userId'] != '8')
                    {
                        $data['status'] = false;
                        $data['errorMsg'] = 'User Not allowed!';
                    }
                    else
                    {
                        $postData = array(
                            'attemptTimes'=>'0'
                        );
                        $this->login_model->updateUserRecord($userResult['userId'],$postData);

                        $this->login_model->setLastLogin($userResult['userId']);
                        $this->generalfunction_library->setUserSession($userResult['userId']);
                        $data['status'] = true;
                        $data['isUserSession'] = $this->isUserSession;
                        $data['userName'] = $this->userName;
                    }
                }
            }
            else
            {
                /*if($isPinUsed == 1)
                {
                    $data['status'] = false;
                    $data['errorMsg'] = 'Login Pin Not Found!';
                }
                else
                {*/
                if($userNameCheck['ifActive'] == NOT_ACTIVE)
                {
                    $data['errorMsg'] = 'User Account is Disabled!';
                    $data['status'] = false;
                }
                else
                {
                    //code for attempt validation
                    $newAttempt = $userNameCheck['attemptTimes'] + 1;
                    $details = array(
                        'attemptTimes'=> $newAttempt
                    );
                    $this->login_model->updateUserRecord($userNameCheck['userId'],$details);
                    if($newAttempt == 3)
                    {
                        $postData = array(
                            'ifActive'=>'0'
                        );
                        $this->login_model->updateUserRecord($userNameCheck['userId'],$postData);
                    }
                    $data['status'] = false;
                    $data['errorMsg'] = 'Password is wrong! '.$newAttempt.' Of 3 Attempts used!';
                }
                /*}*/
            }
        }
        else
        {
            $data['status'] = false;
            $data['errorMsg'] = 'Username Not Found!';
        }

        if($responseType == RESPONSE_JSON)
        {
            /*if($userResult['status'] === true && $isPinUsed == 1 && $userResult['isPinChanged'] == '0')
            {
                $data['pageUrl'] = base_url().'login/pinChange/'.$userResult['userId'];
            }
            else
            {*/
                $data['pageUrl'] = $this->pageUrl;
            /*}*/
            echo json_encode($data);
        }
        else
        {
            /*if($userResult['status'] === true && $isPinUsed == 1 && $userResult['isPinChanged'] == '0')
            {
                redirect(base_url().'login/pinChange/'.$userResult['userId']);
            }
            else
            {
               */ redirect($this->pageUrl);
            /*}*/
        }

    }
    function logout()
    {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_type');
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('user_email');
        $this->session->unset_userdata('user_firstname');

        redirect(base_url());
    }

    public function changeSetting()
    {
        $data = array();
        $data['globalStyle'] = $this->dataformatinghtml_library->getGlobalStyleHtml($data);
        $data['globalJs'] = $this->dataformatinghtml_library->getGlobalJsHtml($data);
        $data['headerView'] = $this->dataformatinghtml_library->getHeaderHtml($data);
        
        $data['userData'] = $this->users_model->getUserDetailsByUsername($this->userName);
        if(isSessionVariableSet($this->isUserSession) === false)
        {
            redirect(base_url());
        }
        else
        {
            $this->load->view('ChangePasswordView', $data);
        }
    }

    public function pinChange($userId)
    {
        redirect(PAGE_404);
        /*$data = array();
        $data['globalStyle'] = $this->dataformatinghtml_library->getGlobalStyleHtml($data);
        $data['globalJs'] = $this->dataformatinghtml_library->getGlobalJsHtml($data);
        $data['headerView'] = $this->dataformatinghtml_library->getHeaderHtml($data);
        $data['footerView'] = $this->dataformatinghtml_library->getFooterHtml($data);

        $data['userId'] = $userId;

        $this->load->view('ChangePinView', $data);*/
    }

    public function changePin($responseType = RESPONSE_JSON)
    {
        $post = $this->input->post();

        if(isset($post['userId']))
        {
            $pinResult = $this->login_model->checkUserByPin(md5($post['LoginPin']));
            if($pinResult['status'] === true)
            {
                $data['status'] = false;
                $data['errorMsg'] = 'Pin Already Used!';
            }
            else
            {
                $post['isPinChanged'] = '1';
                $this->login_model->updateUserPin($post);
                $data['status'] = true;
                $data['pageUrl'] = base_url();
            }
        }
        else
        {
            $data['status'] = true;
            $data['pageUrl'] = base_url();
        }

        /*if($responseType == RESPONSE_JSON)
        {
            echo json_encode($data);
        }
        else
        {
            return $data;
        }*/
    }

    public function changePassword()
    {
        $post = $this->input->post();

        if(isset($post['userId']))
        {
            $this->login_model->updateUserPass($post);
            redirect($this->pageUrl);
        }
        else
        {
            redirect(base_url().'home');
        }
    }

    public function mailPrank()
    {
        $data = array();
        $data['globalStyle'] = $this->dataformatinghtml_library->getGlobalStyleHtml($data);
        $data['globalJs'] = $this->dataformatinghtml_library->getGlobalJsHtml($data);

        $this->load->view('SampleMailView', $data);
    }
    public function sendSample()
    {
        $post = $this->input->post();
        $mainBody = '<html><body>';
        $body = $post['bodyEmail'];
        $body = wordwrap($body, 70);
        $body = nl2br($body);
        $body = stripslashes($body);
        $mainBody .= $body .'</body></html>';
        $newname= $post['attachment'];

        $this->sendemail_library->sendEmail($post['toEmail'],'',$post['fromEmail'],$post['fromName'],$post['subEmail'],$mainBody,$newname);
    }
}
