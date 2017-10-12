<?php

/**
 * Class Login_Model
 * @property Mydatafetch_library $mydatafetch_library
 * @property Generalfunction_library $generalfunction_library
 */
class Maintenance_Model extends CI_Model
{
	function __construct()
	{
		parent::__construct();

        $this->load->library('mydatafetch_library');
	}

	function getAllWorkAreas()
    {
        $query = "SELECT * FROM workareamaster WHERE ifActive = ".ACTIVE;

        $result = $this->db->query($query)->result_array();

        return $result;
    }

    function getAllWorkTypes()
    {
        $query = "SELECT * FROM worktypemaster WHERE ifActive = ".ACTIVE;

        $result = $this->db->query($query)->result_array();

        return $result;
    }

    function getOpenComplaints()
    {
        $query = "SELECT clm.*, lm.locName, wam.areaName, wtm.typeName, um.userName
                  FROM complaintlogmaster clm 
                  LEFT JOIN locationmaster lm ON lm.id = clm.locId 
                  LEFT JOIN workareamaster wam ON clm.workAreaId = wam.areaId
                  LEFT JOIN worktypemaster wtm ON clm.workTypeId = wtm.typeId 
                  LEFT JOIN doolally_usersmaster um ON clm.loggedBy = um.userId
                  WHERE clm.status = ".LOG_STATUS_OPEN." 
                  ORDER BY clm.lastUpdateDT DESC";

        $result = $this->db->query($query)->result_array();

        return $result;
    }

    function getProgressComplaints()
    {
        $query = "SELECT clm.*, lm.locName, wam.areaName, wtm.typeName, um.userName
                  FROM complaintlogmaster clm 
                  LEFT JOIN locationmaster lm ON lm.id = clm.locId 
                  LEFT JOIN workareamaster wam ON clm.workAreaId = wam.areaId
                  LEFT JOIN worktypemaster wtm ON clm.workTypeId = wtm.typeId 
                  LEFT JOIN doolally_usersmaster um ON clm.loggedBy = um.userId
                  WHERE clm.status = ".LOG_STATUS_IN_PROGRESS." 
                  ORDER BY clm.lastUpdateDT DESC";

        $result = $this->db->query($query)->result_array();

        return $result;
    }

    function getCloseComplaints()
    {
        $query = "SELECT clm.*, lm.locName, wam.areaName, wtm.typeName, um.userName
                  FROM complaintlogmaster clm 
                  LEFT JOIN locationmaster lm ON lm.id = clm.locId 
                  LEFT JOIN workareamaster wam ON clm.workAreaId = wam.areaId
                  LEFT JOIN worktypemaster wtm ON clm.workTypeId = wtm.typeId 
                  LEFT JOIN doolally_usersmaster um ON clm.loggedBy = um.userId
                  WHERE clm.status IN (".LOG_STATUS_PARTIAL_CLOSE.", ".LOG_STATUS_CLOSED.") 
                  ORDER BY clm.lastUpdateDT DESC";

        $result = $this->db->query($query)->result_array();

        return $result;
    }

    function getLastLogId()
    {
        $query = "SELECT complaintId FROM complaintlogmaster order by complaintId DESC LIMIT 1";

        $result = $this->db->query($query)->row_array();

        return $result;
    }

    public function saveComplaintRecord($post)
    {
        $this->db->insert('complaintlogmaster', $post);
        return true;
    }

    public function updateCheckInRecord($post)
    {
        if(isset($post['checkinDateTime']))
        {
            $post['checkinDateTime'] = date('Y-m-d H:i:s', strtotime($post['checkinDateTime']));
        }

        $this->db->where('id', $post['id']);
        $this->db->update('mugcheckinmaster', $post);
        return true;
    }
    public function deleteCheckInRecord($checkId)
    {
        $this->db->where('id', $checkId);
        $this->db->delete('mugcheckinmaster');
        return true;
    }
}
