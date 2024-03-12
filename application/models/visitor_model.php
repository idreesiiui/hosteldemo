<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Visitor_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    public function __construct(){

		$this->otherdb = $this->load->database('otherdb', TRUE);
		
	}
   
    function VisitorById($regno,$gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_VISITORS.*,TBL_ALLOTMENT.STUDENTNAME AS NAME,TBL_VISITORS.REGNO AS SREGNO,TBL_SEAT.SEAT,TBL_ROOM.*,TBL_HOSTEL.*');
        $otherdb->from('TBL_VISITORS');
		$otherdb->join('TBL_ALLOTMENT', 'TBL_ALLOTMENT.REGNO = TBL_VISITORS.REGNO','INNER');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_VISITORS.SEATID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_VISITORS.ROOMID','INNER');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_VISITORS.HOSTELID','INNER');
		$otherdb->where('TBL_VISITORS.REGNO', $regno);
		$otherdb->where('TBL_VISITORS.GENDER', $gender);
        $query = $otherdb->get();
		
		if(!empty($query->num_rows))
		{
        	return $query->result();
		}
		else
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('*,TBL_REALLOTMENT.STUDENTNAME AS NAME, TBL_REALLOTMENT.REGNO, TBL_VISITORS.*, TBL_ROOM.*,TBL_HOSTEL.*, TBL_SEAT.*');
			$otherdb->from('TBL_REALLOTMENT');
			$otherdb->join('TBL_VISITORS', 'TBL_VISITORS.REGNO = TBL_REALLOTMENT.REGNO','INNER');
			$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_REALLOTMENT.SEATID','INNER');
			$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_REALLOTMENT.ROOMID','INNER');
			$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_REALLOTMENT.HOSTELID','INNER');
			$otherdb->where('TBL_REALLOTMENT.REGNO', $regno);
			$otherdb->where('TBL_REALLOTMENT.GENDER', $gender);
			$query = $otherdb->get();
			//return $query->result();
			if(!empty($query->num_rows))
				{
        		   return $query->result();
				}
			else
			{
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('*, TBL_ATTACHMENT.ATTACHREGNO AS REGNO, TBL_ATTACHMENT.ATTACHNAME AS NAME,TBL_ROOM.*,TBL_HOSTEL.*');
				$otherdb->from('TBL_ATTACHMENT');
				$otherdb->join('TBL_ALLOTMENT', 'TBL_ALLOTMENT.REGNO = TBL_ATTACHMENT.ATTACHREGNO','INNER');
				$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ATTACHMENT.SEATID','INNER');
				$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ATTACHMENT.ROOMID','INNER');
				$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ATTACHMENT.HOSTELID','INNER');
				$otherdb->where('TBL_ATTACHMENT.ATTACHREGNO', $regno);
				$otherdb->where('TBL_ATTACHMENT.GENDER', $gender);
				$query = $otherdb->get();
				
				
				return $query->result();
			}
	    }
	}
		
	function ViewVisitorByHostel($hostel,$gender,$roomno)
	{
		if(empty($roomno))
			{
		        $otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('TBL_ALLOTMENT.STUDENTNAME AS NAME, TBL_ALLOTMENT.REGNO, TBL_ALLOTMENT.FATHERNAME AS FNAME, TBL_ALLOTMENT.GENDER, TBL_ALLOTMENT.ADDRESS, TBL_ROOM.ROOMDESC, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_SEAT.SEAT, TBL_ALLOTMENT.SEATSTATUS, TBL_ALLOTMENT.NATIONALITY');
				$otherdb->from('TBL_ALLOTMENT');
				$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER');
				$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER');
				$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER');
				$otherdb->where('TBL_ALLOTMENT.HOSTELID', $hostel);
			    $otherdb->where('TBL_ALLOTMENT.GENDER', $gender);
				$otherdb->get();
				$query1 =  $otherdb->last_query();
				
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('TBL_REALLOTMENT.STUDENTNAME AS NAME, TBL_REALLOTMENT.REGNO, TBL_REALLOTMENT.FATHERNAME AS FNAME, TBL_REALLOTMENT.GENDER, TBL_REALLOTMENT.ADDRESS, TBL_ROOM.ROOMDESC, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_SEAT.SEAT, TBL_REALLOTMENT.SEATSTATUS, TBL_REALLOTMENT.NATIONALITY');
				$otherdb->from('TBL_REALLOTMENT');
				$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_REALLOTMENT.SEATID','INNER');
				$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_REALLOTMENT.ROOMID','INNER');
				$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_REALLOTMENT.HOSTELID','INNER');
				$otherdb->where('TBL_REALLOTMENT.HOSTELID', $hostel);
			    $otherdb->where('TBL_REALLOTMENT.GENDER', $gender);
				$otherdb->order_by('ROOMDESC,SEAT', 'asc');
				$otherdb->get();
				$query2 =  $otherdb->last_query();
				
				 $query = $otherdb->query($query1." UNION ".$query2);
				
				return $query->result();
			}
	     else
			{
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('TBL_ALLOTMENT.STUDENTNAME AS NAME, TBL_ALLOTMENT.REGNO, TBL_ALLOTMENT.FATHERNAME AS FNAME, TBL_ROOM.ROOMDESC,TBL_HOSTEL.HOSTEL_NO, TBL_SEAT.SEAT');
				$otherdb->from('TBL_ALLOTMENT');
				$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER');
				$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER');
				$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER');
				$otherdb->where('TBL_ALLOTMENT.HOSTELID', $hostel);
				$otherdb->where('TBL_ALLOTMENT.ROOMID', $roomno);
			    $otherdb->where('TBL_ALLOTMENT.GENDER', $gender);
				$otherdb->get();
				$query1 =  $otherdb->last_query();
				
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('TBL_REALLOTMENT.STUDENTNAME AS NAME, TBL_REALLOTMENT.REGNO, TBL_REALLOTMENT.FATHERNAME AS FNAME, TBL_ROOM.ROOMDESC,TBL_HOSTEL.HOSTEL_NO, TBL_SEAT.SEAT');
				$otherdb->from('TBL_REALLOTMENT');
				$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_REALLOTMENT.SEATID','INNER');
				$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_REALLOTMENT.ROOMID','INNER');
				$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_REALLOTMENT.HOSTELID','INNER');
				$otherdb->where('TBL_REALLOTMENT.HOSTELID', $hostel);
				$otherdb->where('TBL_REALLOTMENT.ROOMID', $roomno);
			    $otherdb->where('TBL_REALLOTMENT.GENDER', $gender);
				$otherdb->order_by('ROOMDESC,SEAT', 'asc');
				$otherdb->get();
				$query2 =  $otherdb->last_query();
				
				 $query = $otherdb->query($query1." UNION ".$query2);
				
				return $query->result();
			}
	}
	
	 function VisitorByHostel($hostel,$gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_VISITORS.*,TBL_ALLOTMENT.STUDENTNAME AS NAME,TBL_VISITORS.REGNO AS SREGNO,TBL_SEAT.SEAT,TBL_ROOM.*,TBL_HOSTEL.*');
        $otherdb->from('TBL_VISITORS');
		$otherdb->join('TBL_ALLOTMENT', 'TBL_ALLOTMENT.REGNO = TBL_VISITORS.REGNO','INNER');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_VISITORS.SEATID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_VISITORS.ROOMID','INNER');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_VISITORS.HOSTELID','INNER');
		$otherdb->where('TBL_VISITORS.HOSTELID', $hostel);
		$otherdb->where('TBL_VISITORS.GENDER', $gender);
        $query = $otherdb->get();
		
		if(!empty($query->num_rows))
		{
        	return $query->result();
		}
		else
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('*,TBL_ATTACHMENT.GUESTREGNO AS REGNO, TBL_ATTACHMENT.GUESTNAME AS NAME,TBL_ROOM.*,TBL_HOSTEL.*');
        	$otherdb->from('TBL_ATTACHMENT');
			$otherdb->join('TBL_ALLOTMENT', 'TBL_ALLOTMENT.REGNO = TBL_ATTACHMENT.GUESTREGNO','INNER');
			$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ATTACHMENT.SEATID','INNER');
			$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ATTACHMENT.ROOMID','INNER');
			$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ATTACHMENT.HOSTELID','INNER');
			$otherdb->where('TBL_ATTACHMENT.HOSTELID', $hostel);
			$otherdb->where('TBL_ATTACHMENT.GENDER', $gender);
        	$query = $otherdb->get();
			return $query->result();
			
	    }
	}
    
		function mail_exists($email)
	{
		$this->db->where('EMAIL',$email);
		$query = $this->db->get('TBL_USERS');
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
    
    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewVisitor($visitorInfo)
    {
        //$this->db->trans_start();
		// the TRUE paramater tells CI that you'd like to return the database object.
		
		$otherdb = $this->load->database('otherdb', TRUE); 
		
        $otherdb->insert('TBL_VISITORS', $visitorInfo);
    
       	return $otherdb->insert_id();
        
       // $this->db->trans_complete();
        
        //return $query;
    }
	
	function visitor_exists_against_Regno($regno,$cnic)
	{
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('REGNO',$regno);
		$otherdb->where('VNICNO',$cnic);
		$query = $otherdb->get('TBL_VISITORS');
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	
	function guestexisted($guestregno)
	{
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('REGNO',$guestregno);
		$query = $otherdb->get('TBL_ALLOTMENT');
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
    
    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
   function viewCattachmentallotmentExist($gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('*');
        $otherdb->from('TBL_ATTACHMENT');
		$otherdb->where('GENDER',$gender);
        $query =  $otherdb->get();
        
		if(!empty($query->num_rows))
		{
        	return $query->result();
		}
		else
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('*');
			$otherdb->from('TBL_ALLOTMENT');
			$otherdb->where('GENDER',$gender);
			$query =  $otherdb->get();
        
		    return $query->result();
			
		}
	}
   
    function HostelInfo($gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('*');
        $otherdb->from('TBL_HOSTEL');
		$otherdb->where('GENDER',$gender);
        $query =  $otherdb->get();
       
	    return $query->result();
		
	}    
	
	function GetGenderById($userId)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('userId',$userId);
		$otherdb->select('GENDER');
        $otherdb->from('TBL_USERS');
		
        $query =  $otherdb->get();
		
        return $query->result();
    }
	
	
	function getAllSeatInfo()
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_ROOM.ROOMID, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_ROOM.ROOMTYPE, TBL_SEAT.SEATDESC, TBL_SEAT.OCCUPIED, TBL_SEAT.SEATID, TBL_SEAT.SEAT, TBL_HOSTEL.HOSTELID AS HID');
        $otherdb->from('TBL_SEAT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_SEAT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_SEAT.ROOMID','INNER');
		$otherdb->where('TBL_SEAT.OCCUPIED',0);
        $query =  $otherdb->get();
        
        return $query->result();
    }
	
	function getAllSeatInfoById($seatavilabel)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_ROOM.ROOMID, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_ROOM.ROOMTYPE, TBL_SEAT.SEATDESC, TBL_SEAT.OCCUPIED, TBL_SEAT.SEATID, TBL_SEAT.SEAT, TBL_HOSTEL.HOSTELID AS HID');
        $otherdb->from('TBL_SEAT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_SEAT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_SEAT.ROOMID','INNER');
		$otherdb->where('TBL_SEAT.OCCUPIED','0');
		$otherdb->where('TBL_SEAT.SEATID',$seatavilabel);
        $query =  $otherdb->get();
        
        return $query->result();
    }
	
	function RoomInfo()
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('*');
        $otherdb->from('TBL_ROOM');
        $query =  $otherdb->get();
        
        return $query->result();
    }
	
	function getSeatInfo($hostelno,$roomno,$occupystatus)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_ROOM.ROOMID, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_ROOM.ROOMTYPE, TBL_SEAT.SEATDESC, TBL_SEAT.OCCUPIED, TBL_SEAT.SEATID, TBL_SEAT.SEAT, TBL_HOSTEL.HOSTELID AS HID');
        $otherdb->from('TBL_SEAT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_SEAT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_SEAT.ROOMID','INNER');
		$otherdb->where('TBL_SEAT.HOSTELID',$hostelno);
		$otherdb->where('TBL_SEAT.ROOMID',$roomno);
		$otherdb->where('TBL_SEAT.OCCUPIED',$occupystatus);
        $query =  $otherdb->get();
        
        return $query->result();
    }
	
	function getSeatInfoByHostelroom($hostelno,$roomno)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_ROOM.ROOMID, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_ROOM.ROOMTYPE, TBL_SEAT.SEATDESC, TBL_SEAT.OCCUPIED, TBL_SEAT.SEATID, TBL_SEAT.SEAT, TBL_HOSTEL.HOSTELID AS HID');
        $otherdb->from('TBL_SEAT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_SEAT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_SEAT.ROOMID','INNER');
		$otherdb->where('TBL_SEAT.HOSTELID',$hostelno);
		$otherdb->where('TBL_SEAT.ROOMID',$roomno);
		
        $query =  $otherdb->get();
        
        return $query->result();
    }
	
	function getVisitorInfobyId($AllotID)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('VISITORID',$AllotID);
        $otherdb->select('TBL_VISITORS.*,TBL_HOSTEL.HOSTELDESC,TBL_ROOM.ROOMDESC,TBL_SEAT.SEAT');
        $otherdb->from('TBL_VISITORS');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTEL_NO = TBL_VISITORS.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_VISITORS.ROOMID','INNER');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_VISITORS.SEATID','INNER');
        $query =  $otherdb->get();
        
        return $query->result();
    }
	
	function getRoomInfo()
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_ROOM.ROOMID, TBL_HOSTEL.HOSTEL_NO, TBL_ROOM.HOSTELID AS RHOSTELID, TBL_ROOM.ROOMDESC, TBL_ROOM.ROOMTYPE, TBL_ROOM.SCAPACITY, TBL_ROOM.FLOOR, TBL_ROOM.BEDS, TBL_ROOM.CHAIRS, TBL_ROOM.TABLES, TBL_ROOM.CUPBOARDS, TBL_ROOM.TUBELIGHTS, TBL_ROOM.FANS, TBL_ROOM.OTHERITEMS');
        $otherdb->from('TBL_ROOM');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ROOM.HOSTELID','INNER');
        $query =  $otherdb->get();
        
        return $query->result();
    }
	
	function getRoomInfobyId($ROOMID)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('ROOMID',$ROOMID);
        $otherdb->select('TBL_ROOM.ROOMID, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.HOSTELID AS RHOSTELID, TBL_ROOM.ROOMDESC, TBL_ROOM.ROOMTYPE, TBL_ROOM.SCAPACITY, TBL_ROOM.FLOOR, TBL_ROOM.BEDS, TBL_ROOM.CHAIRS, TBL_ROOM.TABLES, TBL_ROOM.CUPBOARDS, TBL_ROOM.TUBELIGHTS, TBL_ROOM.FANS, TBL_ROOM.OTHERITEMS');
        $otherdb->from('TBL_ROOM');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ROOM.HOSTELID','INNER');
        $query =  $otherdb->get();
        
        return $query->result();
    }    
	
	function UpdateVisitors($visitorInfo, $regno)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('REGNO',$regno);
        $otherdb->update('TBL_VISITORS', $visitorInfo);
        
        return $otherdb->affected_rows();
    }
	
	function UpdateVisitorsaddress($regno, $allottype, $updateaddress)
    {
        if($allottype == 'Allotment')
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->where('REGNO',$regno);
			$otherdb->update('TBL_ALLOTMENT', $updateaddress);
			
			return $otherdb->affected_rows();
		}
		else{
			    $otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->where('REGNO',$regno);
				$otherdb->update('TBL_REALLOTMENT', $updateaddress);
				
				return $otherdb->affected_rows();
		}
    }

	
    function VisitorEdit($visitorInfo, $visitid)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('VISITORID',$visitid);
        $otherdb->update('TBL_VISITORS', $visitorInfo);
        
        return $otherdb->affected_rows();
    }
    
    function UpdatedSeatStatus($updateseatstatus,$seatavilabel)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('SEATID',$seatavilabel);
        $otherdb->update('TBL_SEAT', $updateseatstatus);
        
        return $otherdb->affected_rows();
    }
	
	 function UpdatedSeatAlloted($updateseatstatus,$lastallotedseatid)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('SEATID',$lastallotedseatid);
        $otherdb->update('TBL_SEAT', $updateseatstatus);
        
        return $otherdb->affected_rows();
    }
	
	 function UpdatedSeatAllotedNew($updatenewseatstatus,$seatavilabel)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('SEATID',$seatavilabel);
        $otherdb->update('TBL_SEAT', $updatenewseatstatus);
        
        return $otherdb->affected_rows();
    }   
    
	
	function getroombyHostelId($hostelid)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('ROOMID');
		$otherdb->from('TBL_ROOM');
		$otherdb->where('HOSTELID', $hostelid);
        $query = $otherdb->get();
		return $query->result();
       
    }
	
	function GetVisitNo($regno)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('VISTOR_NO');
		$otherdb->from('TBL_VISITORS');
		$otherdb->where('REGNO', $regno);
        $query = $otherdb->get();
		return $query->num_rows();
       
    }
	
	function seatexisted($lastallotedseatid)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		//$otherdb->select('count(*) AS SEATID');
		$otherdb->select('SEATID');
		$otherdb->from('TBL_ALLOTMENT');
		$otherdb->where('SEATID', $lastallotedseatid);
        $query = $otherdb->get();
		
		return $query->result();
       
    }
	
	function lastseatid()
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('SEATID');
		$otherdb->from('TBL_REALLOTMENT');
		$otherdb->order_by('REALLOTMENT_ID', 'DESC');
		$otherdb->limit(1);
        $query = $otherdb->get();
		
		return $query->result();
       
    }    
    
    function GetroomitemByRegno($regno)
    {
	
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
		$otherdb->from('TBL_ROOMITEM');
		$otherdb->ORDER_BY('ITEM_ID','DESC');
		$otherdb->where('REGNO', $regno);
        $query = $otherdb->get();
		
		return $query->result();
	
    }
	
	
	function VerifyUserRecordById($regno, $gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('TBL_ALLOTMENT.STUDENTNAME AS NAME, TBL_ALLOTMENT.REGNO, TBL_ALLOTMENT.GENDER, TBL_ALLOTMENT.FATHERNAME AS FNAME, TBL_ALLOTMENT.ADDRESS, TBL_ALLOTMENT.ALLOTTYPE, TBL_ROOM.ROOMDESC, TBL_HOSTEL.HOSTELID, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMID, TBL_ROOM.ROOMTYPE, TBL_SEAT.SEATID, TBL_SEAT.SEAT');
		$otherdb->from('TBL_ALLOTMENT');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER');
		$otherdb->where('TBL_ALLOTMENT.REGNO', $regno);
	    $otherdb->where('TBL_ALLOTMENT.GENDER', $gender);
		$otherdb->get();
		$query1 =  $otherdb->last_query();
		
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('TBL_REALLOTMENT.STUDENTNAME AS NAME, TBL_REALLOTMENT.REGNO, TBL_REALLOTMENT.GENDER, TBL_REALLOTMENT.FATHERNAME AS FNAME, TBL_REALLOTMENT.ADDRESS, TBL_REALLOTMENT.ALLOTTYPE, TBL_ROOM.ROOMDESC, TBL_HOSTEL.HOSTELID, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMID, TBL_ROOM.ROOMTYPE, TBL_SEAT.SEATID, TBL_SEAT.SEAT');
		$otherdb->from('TBL_REALLOTMENT');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_REALLOTMENT.SEATID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_REALLOTMENT.ROOMID','INNER');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_REALLOTMENT.HOSTELID','INNER');
		$otherdb->where('TBL_REALLOTMENT.REGNO', $regno);
	    $otherdb->where('TBL_REALLOTMENT.GENDER', $gender);
		$otherdb->order_by('ROOMDESC,SEAT', 'asc');
		$otherdb->get();
		$query2 =  $otherdb->last_query();
		
		 $query = $otherdb->query($query1." UNION ".$query2);
		
		return $query->result();

    }
	
	function VerifyUserRecordByguestId($regno)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('TBL_ATTACHMENT.*,TBL_ATTACHMENT.ATTACHREGNO AS REGNO,TBL_ATTACHMENT.ATTACHNAME AS NAME,TBL_HOSTEL.HOSTELDESC,TBL_ROOM.ROOMDESC');
		$otherdb->from('TBL_ATTACHMENT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTEL_NO = TBL_ATTACHMENT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ATTACHMENT.ROOMID','INNER');
		$otherdb->where('ATTACHREGNO', $regno);
        $query = $otherdb->get();
		
		return $query->result();
	
    }
	
	function VisitorInfo($regno, $gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
		$otherdb->from('tbl_visitors');
		$otherdb->where('REGNO', $regno);
		$otherdb->where('GENDER', $gender);
		$otherdb->order_by('VISITORID', 'desc');
        $query = $otherdb->get();
		
		return $query->result();
	
    }
	
	function StudAppInfo($regno, $gender)
    {
		if($gender == 'Female')
		  {
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('FATHERNUMBER, EPERSONNAME, EPERSONNUMBER');
			$otherdb->from('tbl_application');
			$otherdb->where('REGNO', $regno);
			$query =  $otherdb->get();
			
			return $query->result();
		  }
		  elseif($gender == 'Male')
		  {
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('STUDENTNUMBER AS FATHERNUMBER');
			$otherdb->from('tbl_maleapplication');
			$otherdb->where('REGNO', $regno);
			$query =  $otherdb->get();
			
			return $query->result();
		  }
    }
	
}


  