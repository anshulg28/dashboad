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
        $query = "SELECT pmm.id, pmm.publication, pmm.pressName, pmm.pressEmail, pmm.pressMailType,"
                ." ptm.catName"
                ." FROM pressmailmaster pmm"
                ." LEFT JOIN presstypemaster ptm ON ptm.id = pmm.pressMailType";

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
    function fetchPressCats()
    {
        $query = "SELECT GROUP_CONCAT(pmm.pressEmail) as 'emails', ptm.catName
                    FROM pressmailmaster pmm
                    LEFT JOIN presstypemaster ptm ON ptm.id = pmm.pressMailType
                    GROUP BY ptm.id";
        $result = $this->db->query($query)->result_array();

        return $result;
    }
    public function getPressMailTypes()
    {
        $query = "SELECT * FROM presstypemaster";

        $result = $this->db->query($query)->result_array();

        return $result;
    }
    public function getPressMailById($pressId)
    {
        $query = "SELECT * FROM pressmailmaster 
                  WHERE id = ".$pressId;

        $result = $this->db->query($query)->row_array();

        return $result;
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

    public function saveMailType($post)
    {
        $this->db->insert('presstypemaster', $post);
        return true;
    }
    public function savePressEmail($post)
    {
        $this->db->insert('pressmailmaster', $post);
        return true;
    }
    public function deletePressEmail($pressId)
    {
        $this->db->where('id', $pressId);
        $this->db->delete('pressmailmaster');
        return true;
    }
    public function updatePressEmail($details,$pressId)
    {
        $this->db->where('id', $pressId);
        $this->db->update('pressmailmaster',$details);
        return true;
    }
}
