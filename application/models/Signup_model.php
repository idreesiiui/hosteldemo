<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Signup_model extends CI_Model
{
    /**
     * This function is used to get the semester listing
     * @return array $result : This is result
     */
    public function __construct(){

		$this->otherdb = $this->load->database('otherdb', TRUE);
		
	}
    function getCourseInfo($gender, $semcode)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
        $otherdb->from('tbl_coursesetting');
		$otherdb->where('GENDER', $gender);
		$otherdb->where('SEMCODE', $semcode);
        $query = $otherdb->get();
        $result = $query->result();

        //echo $gender.','. $semcode;
       // exit();

       // var_dump($result); exit();        
        
		return $result;
    }
	
	function getStudentCourseInfo($regno, $semcode)
    { 
		if (strpos($semcode, '-') !== false) {
			$this->db->select_sum('CREDITHRS');
			$this->db->where('REGNO', $regno);
			$this->db->where('SEMCODE', $semcode);
			$result = $this->db->get('TBL_STUDSEMCOURSE')->row(); 
			 
			return $result->CREDITHRS;                      
        }
		else{
			  $semcode = strtoupper(str_replace(' ', '-', $semcode));
			    $this->db->select_sum('CREDITHRS');
				$this->db->where('REGNO', $regno);
				$this->db->where('SEMCODE', $semcode);
				$result = $this->db->get('TBL_STUDSEMCOURSE')->row(); 
				
				return $result->CREDITHRS; 
		}
    }
	
	function getStudentitem($regno, $semcode)
    { 
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
		$otherdb->from('tbl_student_item');
		$otherdb->where('REGNO', $regno);
		$otherdb->where('SEMCODE', $semcode);
		$query = $otherdb->get();
        $result = $query->row();        
        
		return $result;                      
        
    }
	
	function getStudentCourseNameInfo($regno, $semcode)
    { 
		if (strpos($semcode, '-') !== false) {
			$this->db->select('count(*) as COURSENAME');
			$this->db->from('TBL_STUDSEMCOURSE');
			$this->db->where('REGNO', $regno);
			$this->db->where('SEMCODE', $semcode);
			$query = $this->db->get();
			
			$result = $query->result();
			return $result;
		}
		else{
			    $semcode = strtoupper(str_replace(' ', '-', $semcode));
			    $this->db->select('count(*) as COURSENAME');
				$this->db->from('TBL_STUDSEMCOURSE');
				$this->db->where('REGNO', $regno);
				$this->db->where('SEMCODE', $semcode);
				$query = $this->db->get();
				
				$result = $query->result();
				return $result;

		}
        
    }
	
	function getcountry()
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
        $otherdb->from('TBL_COUNTRY');
        $query = $otherdb->get();
        $result = $query->result();        
        
		return $result;
    }
	function getfaculty()
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
        $otherdb->from('TBL_FACULTY');
        $query = $otherdb->get();
        $result = $query->result();        
        return $result;
    }
	function getdepartment($facultyId)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
        $otherdb->from('TBL_DEPARTMENT');
		$otherdb->where('FACULTY_ID', $facultyId);
        $query = $otherdb->get();
        $result = $query->result();        
        return $result;
    }
	
	
	function getstudent($regno)
    {
		$this->db->select('*');
        $this->db->from('TBL_HSTUDENTS');
		$this->db->where('REGNO', $regno);
        $query = $this->db->get();
        $result = $query->result();
        if(empty($result)){
                $otherdb = $this->load->database('otherdb', TRUE);
                $otherdb->select('*');
                $otherdb->from('students');
                //$otherdb->where('IS_ACTIVE', 1);
                $otherdb->where('REGNO', $regno);               
                $query = $otherdb->get();
                $result = $query->result();            
        }         
        return $result;
    }
	
	function getstudentpic($regno)
    {
		$this->db->select('*');
        $this->db->from('STUDENTPICTURELR');
		$this->db->where('REGNO', $regno);
        $query = $this->db->get();
        $result = $query->result();
        if(empty($result)){
                $otherdb = $this->load->database('otherdb', TRUE);
                $otherdb->select('*');
                $otherdb->from('students');
                //$otherdb->where('IS_ACTIVE', 1);
                $otherdb->where('REGNO', $regno);                
                $query = $otherdb->get();
                $result = $query->result();            
        }         
        return $result;
    }
	
	function getstudentgender($regno)
    {
		$this->db->select('*');
        $this->db->from('TBL_HSTUDENTS');
		$this->db->where('REGNO', $regno);
		$this->db->where('GENDER', 'F');
        $query = $this->db->get();
        $result = $query->result(); 
        if(empty($result)){
                $otherdb = $this->load->database('otherdb', TRUE);
                $otherdb->select('*');
                $otherdb->from('students');
                $otherdb->where('GENDER', 'Female');
                $otherdb->where('REGNO', $regno);                
                $query = $otherdb->get();
                $result = $query->result();            
        }         
        return $result;     
        
    }
	
	function getstudentgenderbyMale($regno)
    {
		$this->db->select('*');
        $this->db->from('TBL_HSTUDENTS');
		$this->db->where('REGNO', $regno);
		$this->db->where('GENDER', 'M');
        $query = $this->db->get();
        $result = $query->result(); 
        if(empty($result)){
            $otherdb = $this->load->database('otherdb', TRUE);
            $otherdb->select('*');
            $otherdb->from('students');
            //$otherdb->where('IS_ACTIVE', 1);
            $otherdb->where('GENDER', 'Male');
            $query = $otherdb->get();
            $result = $query->result();
            
        }        
        return $result;
    }
	
	function GetAppId() 
	{ // $query = $this->db->query('SELECT MAX(FFOARMID) FROM TBL_FEDBAKFORM');
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('MAX(STUDENTID) as ID');
        $otherdb->from('TBL_APPLICATION');
		//$otherdb->orderby('TBL_APPLICATION');
        $query = $otherdb->get();
        $result = $query->result();  
		      
        return $result;
		
 	}
    
    /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
	 function getsemesterbyId($SMcode)
	    {
			$otherdb = $this->load->database('otherdb', TRUE);
			return $otherdb->where("SMcode" , $SMcode)->get("TBL_SEMESTER")->row();
			
		}
	/**
     * This function is used to get the semescode information
     * @return array row : This is result of the query row
     */
	function getsemestercode($gender)
    {
		return $this->otherdb->where('IS_ACTIVE', 1)
					->where('GENDER', $gender)
					->get('TBL_SEMESTER')
					->result();
	}

	function getsemestercodeseatchange()
	    {
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('*');
			$otherdb->from('TBL_SEMESTER');
			$otherdb->where('SEATCHANGESTATUS', 1);
			$otherdb->where('GENDER', 'Male');
			$otherdb->order_by('SMCODE', 'DESC');
			$query = $otherdb->get();
			$result = $query->result();        
			
			return $result;
			
		}	
	
	function getsemestercodeMale()
	    {
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('*');
			$otherdb->from('TBL_SEMESTER');
			$otherdb->where('IS_ACTIVE', 1);
			$otherdb->where('GENDER', 'Male');
			$query = $otherdb->get();
			$result = $query->result();        
			
			return $result;
			
		}

		function checkstdreg($regno)
	    {
			$this->db->select('REGNO,GENDER');
			$this->db->from('TBL_HSTUDENTS');
			$this->db->where('REGNO', $regno);
			$query = $this->db->get();
			$result = $query->result();

			if(empty($result)){

				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('*');
				$otherdb->from('students');
				//$otherdb->where('IS_ACTIVE', 1);
				//$otherdb->where('gender', 'Male');
				$otherdb->where('REGNO', $regno);
				$query = $otherdb->get();
				$result = $query->result();
			
			}        
			//var_dump($result); exit();
			return $result;
			
		}
		
		function checkreg($regno)
	    {
			$this->db->select('REGNO,GENDER');
			$this->db->from('TBL_HSTUDENTS');
			$this->db->where('REGNO', $regno);
			$query = $this->db->get();
			$result = $query->result();

			if(empty($result)){

				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('*');
				$otherdb->from('students');
				//$otherdb->where('IS_ACTIVE', 1);
				//$otherdb->where('gender', 'Male');
				$otherdb->where('REGNO', $regno);
				$query = $otherdb->get();
				$result = $query->result();
			
			}        
			//var_dump($result); exit();
			return $result;
			
		}
		
		function checkmalereg($regno)
	    {
			$this->db->select('*');
			$this->db->from('TBL_HSTUDENTS');
			$this->db->where('REGNO', $regno);
			$this->db->where('GENDER', 'M');
			$query = $this->db->get();
			$result = $query->num_rows();        
			return $result;
			
		}
		
		function checkmalestdreg($regno)
	    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('REGNO,STUDENTID');
        $otherdb->from('TBL_MALEAPPLICATION');
		$otherdb->where('REGNO', $regno);
		$otherdb->where('GENDER', 'Male');
        $query = $otherdb->get();
        $result = $query->num_rows();        
        
		return $result;
			
		}
		
		function sttrackid($regno)
	    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('REGNO,STUDENTID');
        $otherdb->from('TBL_MALEAPPLICATION');
		$otherdb->where('REGNO', $regno);
		$otherdb->where('GENDER', 'Male');
        $query = $otherdb->get();
        $result = $query->result();         
        
		return $result;
			
		}
		
		function checkprograme($programe)
	    {
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('*');
			$otherdb->from('TBL_SEMESTER');
			$otherdb->where('PROGRAME', $programe);
			$query = $otherdb->get();
			$result = $query->result();        
			
			return $result;
				
		}
		
		function checkstdseatExist($regno,$semcode)
	    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
        $otherdb->from('TBL_SEATCHANGEMALE');
		$otherdb->where('REGNO', $regno);
		$otherdb->where('SEMCODE', $semcode);
        $query = $otherdb->get();
        $result = $query->result();        
        
		return $result;
			
		}
		
		function checkFstdreg($regno,$gender)
	    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
        $otherdb->from('TBL_APPLICATION');
		$otherdb->where('REGNO', $regno);
		$otherdb->where('GENDER', $gender);
		
        $query = $otherdb->get();
        $result = $query->result();        
        
		return $result;
			
		}
		
		function checkMstdreg($regno,$gender)
	    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
        $otherdb->from('TBL_MALEAPPLICATION');
		$otherdb->where('REGNO', $regno);
		
        $query = $otherdb->get();
        $result = $query->result();        
        
		return $result;
			
		}
		
		function getbatchcode($regno)
		{
			$result = $this->db->select('BATCHNAME,PROTITTLE,NATIONALITY,COUNTRY')
							->where('REGNO', $regno)
							->get('TBL_HSTUDENTS')
							->result();  

			if(empty($result)){
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('PROTITTLE,PROGRAME AS BATCHNAME,NATIONALITY,COUNTRY');
				$otherdb->from('students');
				//$otherdb->where('IS_ACTIVE', 1);
				$otherdb->where('REGNO', $regno);				
				$query = $otherdb->get();
				$result = $query->result();
			}      
			return $result;
		}
	
	/**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
	 function getsemesterbyStatus()
	    {
			$otherdb = $this->load->database('otherdb', TRUE);
			return $this->db->where("is_Active" , 1)->get("system.tbl_semester")->num_rows();
			
		}
    
    
    /**
     * This function is used to add new semester to system
     * @return number $insert_id : This is last inserted id
     */
    function InsertSignup($studentInfo)
    {
       $otherdb = $this->load->database('otherdb', TRUE); 
       $query = $otherdb->insert('TBL_APPLICATION', $studentInfo);
	  
       return $query;
    }
	 function InsertSeatInfoMale($studentInfo)
    {
       $otherdb = $this->load->database('otherdb', TRUE); 
       $query = $otherdb->insert('TBL_SEATCHANGEMALE', $studentInfo);
	  
       return $query;
    }
	 function InsertSignupMale($studentInfo)
    {
       $otherdb = $this->load->database('otherdb', TRUE); 
       $query = $otherdb->insert('TBL_MALEAPPLICATION', $studentInfo);
	  
       return $query;
    }
	function InsertNewVisitorInfo($visitorInfo)
    {
       $otherdb = $this->load->database('otherdb', TRUE); 
       $query = $otherdb->insert('TBL_NEWVISITOR', $visitorInfo);
	  
       return $query;
    }
	
	function InsertSignupForm($studentInfo)
    {
       $otherdb = $this->load->database('otherdb', TRUE); 
       $query = $otherdb->insert('TBL_FEDBAKFORM', $studentInfo);
        
        return $query;
    }
	
	function getLastInserted() 
	{  
		$otherdb = $this->load->database('otherdb', TRUE);
		$query = $otherdb->query('SELECT MAX(STUDENTID) as ID FROM TBL_APPLICATION');
		return $query;
		
 	}
	
	function getLastSeatInserted() 
	{  
		$otherdb = $this->load->database('otherdb', TRUE);
		$query = $otherdb->query('SELECT MAX(MCHANGE_ID) as ID FROM TBL_SEATCHANGEMALE');
		return $query->result();
		
		
 	}
	
	function getLastInsertedmale() 
	{  
		$otherdb = $this->load->database('otherdb', TRUE);
		$query = $otherdb->query('SELECT MAX(STUDENTID) as ID FROM TBL_MALEAPPLICATION');
		return $query;
		
 	}
    
    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function GetSignupSetting()
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
        $otherdb->from('TBL_SETTINGS');
        $query = $otherdb->get();
        
        return $query->result();
    }
	
	 function GetTrackerId($name,$fname,$dob)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('STUDENTID');
        $otherdb->from('TBL_APPLICATION');
        $otherdb->where('STUDENTNAME', $name);
		$otherdb->where('FATHERNAME', $fname);
		$otherdb->where('STUDENTDOB', $dob);

        $query = $otherdb->get();
        
        return $query->result();
    }
	
	function GetTrackerIdByRegno($regno)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('STUDENTID');
        $otherdb->from('TBL_APPLICATION');
        $otherdb->where('REGNO', $regno);

        $query = $otherdb->get();
        
        return $query->result();
    }
	
	function GetTrackerIdByMaleRegno($regno)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('STUDENTID');
        $otherdb->from('TBL_MALEAPPLICATION');
        $otherdb->where('REGNO', $regno);

        $query = $otherdb->get();
        
        return $query->result();
    }
	
    function student_exists($regno)
	{
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('REGNO',$regno);
		$otherdb->where('STATUS',0);
		$query = $otherdb->get('TBL_APPLICATION');
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function student_maleexists($regno)
	{
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('REGNO',$regno);
		$otherdb->where('STATUS',0);
		$query = $otherdb->get('TBL_MALEAPPLICATION');
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}

	function checkDistance($PERMANENT, $DISTRICT, $CITY){
        $query = $this->otherdb->where('district',$DISTRICT) 
                        ->or_where('city_name',$CITY)                   
                        ->get('tbl_restricted_areas');
        $row = $query->num_rows();      


        $search = 'Rawalpindi';
        $RawalpindiFound  = preg_match("/{$search}/i", $PERMANENT);

        $search = 'Islamabad';
        $IslamabadFound  = preg_match("/{$search}/i", $PERMANENT);

        $search = 'Rwp';
        $RwpFound  = preg_match("/{$search}/i", $PERMANENT);

        $search = 'Ibd';
        $IbdFound  = preg_match("/{$search}/i", $PERMANENT);             



        if( $row >= 1 ||$RawalpindiFound || $IslamabadFound || $RwpFound || $IbdFound){
            return false;
        } else {
            return true;
        }
    }
	
	function email_exists($email, $gender)
	{
		if($gender == 'Female')
		     {
			    $otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->like('STUDENTEMAIL',$email);
				$otherdb->where('GENDER',$gender);
				$query = $otherdb->get('TBL_APPLICATION');
				if ($query->num_rows() > 0){
					return true;
				}
				else{
					  return false;
		            }
		
		      }
	     elseif($gender == 'Male')
		     {
			    $otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->like('STUDENTEMAIL',$email);
				$otherdb->where('GENDER',$gender);
				$query = $otherdb->get('TBL_MALEAPPLICATION');
				if ($query->num_rows() > 0){
					return true;
				}
				else{
					  return false;
		            }
		
		      }
		   else
		       {
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->like('email',$email);
				$otherdb->where('GENDER',$gender);
				$query = $otherdb->get('TBL_USERS');
					if ($query->num_rows() > 0){
						return true;
					}
					else{
						  return false;
					    }
			    }
	}
	
	function getsendemail($gender, $emailtype)
	    {
		$otherdb = $this->load->database('otherdb', TRUE);	
		$otherdb->select('*');
        $otherdb->from('tbl_email');
		$query = $otherdb->order_by('ID', 'ASC');
		$query = $otherdb->WHERE('GENDER', $gender);
		$query = $otherdb->WHERE('TYPE', $emailtype);
        $query = $otherdb->get();
		
        $result = $query->result();        
        return $result;
			
		}
	
	 function student_Seatexists($regno, $semcode)
	{
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('REGNO',$regno);
		$otherdb->where('STATUS',1);
		$otherdb->where('SEMCODE',$semcode);
		$query = $otherdb->get('TBL_SEATCHANGEMALE');
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function StregverifyByadmin($regno)
	{
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('REGNO',$regno);
		$otherdb->where('STATUS',1);
		$query = $otherdb->get('TBL_APPLICATION');
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function MaleStregverifyByadmin($regno)
	{
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('REGNO',$regno);
		$otherdb->where('STATUS',1);
		$query = $otherdb->get('TBL_MALEAPPLICATION');
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function CheckBlacklist($regno)
	{
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('REGNO',$regno);
		$otherdb->where('BSTATUS',1);
		$query = $otherdb->get('TBL_BLACKLIST');
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function reg_exists($name,$fname,$dob)
	{
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('STUDENTNAME',$name);
		$otherdb->where('FATHERNAME',$fname);
		$otherdb->where('STUDENTDOB',$dob);

		$query = $otherdb->get('TBL_APPLICATION');
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
    
}