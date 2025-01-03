<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Reallot_model extends CI_Model
{

	public function __construct(){

		$this->otherdb = $this->load->database('otherdb', TRUE);
		
	}


    function getcountry()
    {
        return $this->otherdb->get('TBL_COUNTRY')->result();
    }

	function getfaculty()
    {
		return $this->otherdb->get('TBL_FACULTY')->result();        
    }

	function getdepartment($facultyId)
    {
		return $this->otherdb->where('FACULTY_ID', $facultyId)->get('TBL_DEPARTMENT')->result();        
    }
	
	function getstudent($regno)
    {
		return $this->otherdb->where('REGNO', $regno)->get('TBL_ALLOTMENT')->result();        
    }
	
	function getstudentAcadInfo($regno)
    {
		return $this->db->where('REGNO', $regno)->get('TBL_HSTUDENTS')->result();        
    }
	
	function getstudentpic($regno)
    {
		return $this->db->where('REGNO', $regno)->get('STUDENTPICTURELR')->result();        
    }
	
	function getstudentgender($regno)
    {
		return $this->otherdb->where('REGNO', $regno)
					->where('GENDER', 'Female')
					->get('TBL_ALLOTMENT')
					->result();        
    }
	
	function GetAppId() 
	{
		return $this->otherdb->select('MAX(STUDENTID) as ID')->get('TBL_APPLICATION')->result();  
		      
 	}
    
    /**
     * This function is used to get the user roles information
     * @return object : This is result of the query
     */
	function getsemesterbyId($SMcode)
	{
		return $this->otherdb->where("SMcode" , $SMcode)->get("TBL_SEMESTER")->row();
			
	}
	/**
     * This function is used to get the semescode information
     * @return array row : This is result of the query row
     */
	function getsemestercode()
    {

		return $this->otherdb->where('IS_ACTIVE','1')->get('TBL_SEMESTER')->result();
	}
		
	function checkreg($regno)
	{
		return $this->otherdb->where('REGNO', $regno)->get('TBL_ALLOTMENT')->num_rows();
			
	}
		
	function checkprograme($programe)
    {
		return $this->otherdb->where('PROGRAME', $programe)->get('TBL_SEMESTER')->result();        
		
	}
		
	function checkstdreg($regno)
    {
		return $this->otherdb->where('REGNO', $regno)
					->where('IS_SUBMIT', 1)
					->get('TBL_ALLOTMENT')
					->result();
		
	}
	
	/**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
	function getsemesterbyStatus()
	{
		return $this->db->where('IS_ACTIVE','1')->get("tbl_semester")->num_rows();
			
	}
    
    
    /**
     * This function is used to add new semester to system
     * @return number $insert_id : This is last inserted id
     */
    function InsertAllotUser($userInfo)
    {
       $this->otherdb->insert('TBL_USERS', $userInfo);
	  
       return $this->otherdb->insert_id();
    }
	
	function UpdatetAllotUser($regno, $AllotInfo)
    {
		$this->otherdb->where('REGNO',$regno)->update('TBL_ALLOTMENT', $AllotInfo);
        
        return $this->otherdb->affected_rows();
    }
	
	function InsertNewVisitorInfo($visitorInfo)
    {
       $this->otherdb->insert('TBL_NEWVISITOR', $visitorInfo);
	  
      	return $this->otherdb->insert_id();
    }
	
	function InsertSignupForm($studentInfo)
    {
       $this->otherdb->insert('TBL_FEDBAKFORM', $studentInfo);
        
       return $this->otherdb->insert_id();
    }
	
	function getLastInserted() 
	{  
		return $this->otherdb->query('SELECT MAX(STUDENTID) as ID FROM TBL_APPLICATION')->result();
				
 	}
    
    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function GetSignupSetting()
    {
		return $this->otherdb->get('TBL_SETTINGS')->result();
    }
	
	 function GetTrackerId($name,$fname,$dob)
    {
		return $this->otherdb->select('STUDENTID')
					->where('STUDENTNAME', $name)
					->where('FATHERNAME', $fname)
					->where('STUDENTDOB', $dob)
					->get('TBL_APPLICATION')
					->result();
    }
		
	function student_exists($regno)
	{
		$row = $this->otherdb->where('REGNO',$regno)
					->where('IS_SUBMIT',1)
					->get('TBL_ALLOTMENT')
					->num_rows();

		return ($row > 0) ? true : false;
	}
	
	function reg_exists($name,$fname,$dob)
	{
		$row = $this->otherdb->where('STUDENTNAME',$name)
					->where('FATHERNAME',$fname)
					->where('STUDENTDOB',$dob)
					->get('TBL_APPLICATION')
					->num_rows();

		return ($row > 0) ? true : false;
		
	}
    
}