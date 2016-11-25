<?php

/**
 * Class Mailers_Model
 * @property Mydatafetch_library $mydatafetch_library
 * @property Generalfunction_library $generalfunction_library
 */
class Mailers_Model extends CI_Model
{
	function __construct()
	{
		parent::__construct();

        $this->load->library('mydatafetch_library');
	}

    public function getAllTemplatesByType($mailType)
    {
        $query = "SELECT mailSubject, mailBody, mailType "
            ."FROM mailtemplates "
            ."where mailType = ".$mailType;

        $result = $this->db->query($query)->result_array();

        $data['mailData'] = $result;
        if(myIsArray($result))
        {
            $data['status'] = true;
        }
        else
        {
            $data['status'] = false;
        }

        return $data;
    }
    public function getAllPressEmails()
    {
        $query = "SELECT * "
            ."FROM pressmailmaster ";

        $result = $this->db->query($query)->result_array();

        $data['mailData'] = $result;
        if(myIsArray($result))
        {
            $data['status'] = true;
        }
        else
        {
            $data['status'] = false;
        }

        return $data;
    }
    public function getPressInfoByMail($email)
    {
        $query = "SELECT pressName "
            ."FROM pressmailmaster "
            ."WHERE pressEmail = '".$email."'";

        $result = $this->db->query($query)->row_array();

        $data = $result;

        return $data;
    }

    public function setMailSend($mugId,$mailType)
    {
        if($mailType == BIRTHDAY_MAIL)
        {
            $details['birthdayMailStatus'] = 1;
        }
        else
        {
            $details['mailStatus'] = 1;
        }
        $details['mailDate'] = date('Y-m-d');

        $this->db->where('mugId', $mugId);
        $this->db->update('mugmaster', $details);
        return true;
    }
    
    public function saveMailTemplate($post)
    {
        $this->db->insert('mailtemplates', $post);
        return true;
    }

}
