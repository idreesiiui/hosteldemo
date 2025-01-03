<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Blacklist_model extends CI_Model
{
    
    public function __construct(){

		$this->otherdb = $this->load->database('otherdb', TRUE);
		
	}	
    
    function getUserRoles()
    {
        return $this->db->select('ROLEID, ROLE')
			        ->where('ROLEID !=', 1)
			        ->get('TBL_ROLES')
			        ->result();
    }
    
	function mail_exists($email)
	{
		$query = $this->db->where('EMAIL',$email)->get('TBL_USERS');

		return ($query->num_rows() > 0) ? true : false;
	}
    
    
    function addNewBlacklist($blacklistInfo)
    {        
        $this->otherdb->insert('TBL_BLACKLIST', $blacklistInfo);   
            
        return $this->otherdb->insert_id();
    }
	
	function BlacklistId_exists($allotid)
	{
		$query = $this->otherdb->where('ALLOTMENT_ID',$allotid)->get('TBL_BLACKLIST');

		return ($query->num_rows() > 0) ? true : false;
	}
    
   
    function getBlacklistInfo($gender)
    {
        return $this->otherdb->where('GENDER',$gender)->get('TBL_BLACKLIST')->result();
    }
	
	
    function GetBlacklistInfoByUser($AllotID, $gender)
    {
        return $this->otherdb->select('REGNO, ALLOTMENT_ID')
			        ->where('GENDER', $gender)
			        ->where('BLACKLIST_ID', $AllotID)
			        ->get('TBL_BLACKLIST')
			        ->result();
    }
	
	function geAllotSeat($gender, $AllotID)
    {
        return $this->otherdb->select('TBL_ALLOTMENTHISTORY.*,TBL_HOSTEL.HOSTEL_NO,TBL_HOSTEL.HOSTELDESC,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE,TBL_SEAT.SEAT,TBL_SEAT.SEATID')
        ->from('TBL_ALLOTMENTHISTORY')
		->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENTHISTORY.SEATID','INNER')
		->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENTHISTORY.HOSTELID','INNER')
		->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENTHISTORY.ROOMID','INNER')
		->where('TBL_ALLOTMENTHISTORY.GENDER',$gender)
		->where('TBL_ALLOTMENTHISTORY.ALLOTMENTHISTORY_ID',$AllotID)
        ->get()
        ->result();
    }
	
	function getEmail($gender, $regno, $emailid)
    {
        $result = $this->otherdb->select('email')        
								->where('regno',$regno)
								->where('gender',$gender)
								->order_by('userId','desc')
								->limit('1')
						        ->get('TBL_USERS')		
								->result();
		
		if(empty($result))
		{
			$result = $this->otherdb->select('email')
									->where('userId',$emailid)
									->where('gender',$gender)
									->order_by('userId','desc')
									->limit('1')
									->get('TBL_USERS')
									->result();  
		}
        
        return $result;
    }
	
	function GetGenderById($userId)
    {
		return $this->otherdb->select('GENDER')
					->where('userId',$userId)
					->get('TBL_USERS')
					->result();
    }
	
	function GetAllotId($regno)
    {
        $result = $this->otherdb->select('ALLOTMENT_ID,GENDER')
						        ->where('REGNO',$regno)
						        ->get('TBL_ALLOTMENT')
						        ->result();
		
		if(empty($result))
		{
			$result = $this->otherdb->select('REALLOTMENT_ID,GENDER')
									->where('REGNO',$regno)
									->get('TBL_REALLOTMENT')
									->result();
		}

		if(empty($result))
		{
			$result = $this->otherdb->select('ID,GENDER')
									->where('REGNO',$regno)
									->get('TBL_ALLOTREALLOT')
									->result();
		}       

        return $result;
    }
	
	
	function GetSeatId($allotid)
    {
        return $this->otherdb->select('SEATID')
			        ->where('ALLOTMENT_ID',$allotid)
			        ->get('TBL_ALLOTMENT')
			        ->result();
    }
	
	function UpdateBlacklist($blacklistInfo, $AllotID)
    {
		$this->otherdb->where('BLACKLIST_ID',$AllotID)->update('tbl_blacklist', $blacklistInfo);
        
        return $this->otherdb->affected_rows();
    }    
    
    function UpdateSeatId($seatId,$seatInfo)
    {
		$this->otherdb->where('SEATID',$seatId)->update('TBL_SEAT', $seatInfo);
        
        return $this->otherdb->affected_rows();
    }    
    
    function deleteAllot($allotid)
    {
		$this->otherdb->where('ALLOTMENT_ID', $allotid)->delete('TBL_ALLOTMENT');
        
        $result = $this->otherdb->affected_rows();

		if(empty($result))
		{
			$this->otherdb->where('REALLOTMENT_ID', $allotid)->delete('TBL_REALLOTMENT');
	        
	        return $this->otherdb->affected_rows();

		} else {

			return $result;
		}
    }
	
	function VerifyUserRecordById($regno, $gender)
    {

		$result =  $this->otherdb->where('REGNO', $regno)
						->where('GENDER', $gender)
						->get('TBL_ALLOTMENT')
						->result();

		if(empty($result))
		{
			$result = $this->otherdb->where('GENDER', $gender)
									->where('REGNO', $regno)
									->get('TBL_REALLOTMENT')
									->result();
		}

		if(empty($result))
		{
			$result = $this->otherdb->where('GENDER', $gender)
									->where('REGNO', $regno)
									->get('TBL_ALLOTREALLOT')
									->result();
		}
	   
	   if(empty($result))
	   {
	   		if($gender == 'Male'){
	   			$gender = 'M';
	   		}else{
	   			$gender = 'F';
	   		}
			$result = $this->db->where('REGNO', $regno)
							->where('GENDER', $gender)
							->get('TBL_HSTUDENTS')
							->result();	 
		 
	   }		
		
		return $result;
		
    }
	

    function DelFromBlacklist($gender,$regno)
    {
		$this->otherdb->where('REGNO', $regno)
						->where('GENDER', $gender)
						->delete('TBL_BLACKLIST');
        
        return $this->otherdb->affected_rows();
    }
} 