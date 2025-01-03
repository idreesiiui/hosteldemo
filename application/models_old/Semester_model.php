<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Semester_model extends CI_Model
{
	public function __construct(){

		$this->otherdb = $this->load->database('otherdb', TRUE);		
	}
	
    function userinfo($userId)
    {
		return $this->otherdb->select('GENDER')
					->where('USERID', $userId)
					->get('TBL_USERS')
					->result();
    }

	function getAllSemesterCode()
    {
        return $this->db->select('SEMCODE')
			        ->like('SEMCODE ', date('Y'))
			        ->or_like('SEMCODE ', date('Y')-1)
			        ->or_like('SEMCODE ', date('Y')-2)
			        ->or_like('SEMCODE ', date('Y')-3)
			        ->or_like('SEMCODE ', date('Y')-4)
			        ->or_like('SEMCODE ', date('Y')-5)
			        ->or_like('SEMCODE ', date('Y')-6)
			        ->or_like('SEMCODE ', date('Y')-7)
			        ->get('SEMESTER')
			        ->result_array();
    }

    function getCurrentSem()
    {
        $maxdates = $this->db->select('MAX(SEMSTARTDATE) as SEMSTARTDATE')
						        ->get('SEMESTER')
						        ->row();

		$maxdate = $maxdates->SEMSTARTDATE;

		return $this->db->where('SEMSTARTDATE', $maxdate)->get('SEMESTER')->row();
    }

    function semesterListing($gender)
    {
		return $this->otherdb->select('SEMCODE, SMCODE, PROGRAME, SMSTARTDATE, SMENDDATE, STARTREGDATE, CLOSEREGDATE, IS_ACTIVE, APPSTATUS, REALLOTSTATUS')
							->where('GENDER', $gender)
							->group_by('SEMCODE')
							->order_by('SMCODE', 'DESC')
							->get('TBL_SEMESTER')
							->result();        
        
    }    
    
	function getsemesterbyId($SMcode)
	{
		return $this->otherdb->where("SMCODE", $SMcode)->get("TBL_SEMESTER")->row();
			
	}
	
	function getsemestercodeSeatMale()
	{
		return $this->otherdb->where('SEATCHANGESTATUS', 1)
					->where('GENDER', 'Male')
					->get('TBL_SEMESTER')
					->result();
	}
		
	function getsemestercodeSeatFeMale($gender)
	{
		return $this->otherdb->where('SEATCHANGESTATUS', 1)
					->where('GENDER', $gender)
					->where('IS_ACTIVE', '1')
					->get('TBL_SEMESTER')
					->result();
	}	
	
	function getsemestercodeMale()
	{
		return $this->otherdb->where('GENDER', 'Male')
					->where('IS_ACTIVE','1')					
					->get('TBL_SEMESTER')
					->result();			
	}

	function getsemestercodeFemale()
	{
		return $this->otherdb->where('IS_ACTIVE', 1)
					->where('GENDER', 'Female')
					->get('TBL_SEMESTER')
					->result();
	}

	function getsemesterbyStatus($usergender)
	{
		$result = $this->otherdb->select('TBL_SEMESTER.*,TBL_USERS.*')
				        ->from('TBL_SEMESTER')
						->join('TBL_USERS', 'TBL_USERS.GENDER = TBL_SEMESTER.GENDER','left')
						->where("IS_ACTIVE" , 1)
						->where("TBL_SEMESTER.GENDER" , $usergender)
				        ->get();        
        return $result->num_rows();
	}  
   
    function addNewUser($semesterInfo)
    {       
       	$this->otherdb->insert('TBL_SEMESTER', $semesterInfo);
        
        return $this->otherdb->insert_id();
    }    
   
    function getUserInfo($userId)
    {
		return $this->otherdb->select('GENDER')
					->where('USERID', $userId)
					->get('TBL_USERS')
					->result();
    }    
    
    function editSemester($semesterInfo, $semesterId)
    {
		$this->otherdb->where('SMCODE', $semesterId)->update('TBL_SEMESTER', $semesterInfo);
        
        return $this->otherdb->affected_rows();
    }
	 
    function deleteSemester($semId)
    {
		$this->otherdb->where('SMCODE', $semId)->delete('TBL_SEMESTER');
        
        return $this->otherdb->affected_rows();
    }
	
	function getFemaleList()
	{
		return $this->otherdb->where('gender', 'Female')
					->where('type', 'List')
					->where('status', 1)
					->order_by('id','DESC')
			        ->get('tbl_upload')
			        ->result();
	}
		
	function getFemaleNotfication()
	{
		return $this->otherdb->where('gender', 'Female')
					->where('type', 'Notification')
					->where('status', 1)
					->order_by('id','DESC')
			        ->get('tbl_upload')
			        ->result();
	}

	function getMaleNotification()
	{
		return $this->otherdb->where('gender', 'Male')
					->where('type', 'Notification')
					->where('status', 1)
					->order_by('id','DESC')
			        ->get('tbl_upload')
			        ->result();
	}
}  