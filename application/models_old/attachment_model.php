<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Attachment_model extends CI_Model
{
    
    public function __construct(){

		$this->otherdb = $this->load->database('otherdb', TRUE);
		
	}

	    
    /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
    function getUserRoles()
    {
        $this->db->select('ROLEID, ROLE');
        $this->db->from('TBL_ROLES');
        $this->db->where('ROLEID !=', 1);
        $query = $this->db->get();
        
        return $query->result();
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
    function addNewAttachment($attachInfo)
    {
        //$this->db->trans_start();
		// the TRUE paramater tells CI that you'd like to return the database object.
		
		$otherdb = $this->load->database('otherdb', TRUE); 
		
        $otherdb->insert('TBL_ATTACHMENT', $attachInfo);
    
       // $insert_id = $this->db->insert_id();
        
       // $this->db->trans_complete();
        
        return $otherdb->insert_id();
    }
	
	function attach_exists_against_Regno($regno, $attachregno)
	{
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('HOSTREGNO',$regno);
		$otherdb->where('ATTACHREGNO',$attachregno);
		$query = $otherdb->get('TBL_ATTACHMENT');
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	
	function guestexisted($attachregno)
	{
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('ATTACHREGNO', $attachregno);
		$query = $otherdb->get('TBL_ATTACHMENT');
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
    function viewattachmentInfo()
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_ATTACHMENT.HOSTREGNO, TBL_ATTACHMENT.STUDENTNAME, TBL_ATTACHMENT.ATTACHREGNO, TBL_ATTACHMENT.ATTACHNAME, TBL_ATTACHMENT.ATTACHDATE, TBL_ATTACHMENT.EXPIRYDATE, TBL_ATTACHMENT.ATTACHDATE, TBL_ATTACHMENT.SEMCODE, TBL_ATTACHMENT.ATTACHKEY, TBL_ATTACHMENT.REMARKS, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_SEAT.SEAT');
        $otherdb->from('TBL_ATTACHMENT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ATTACHMENT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ATTACHMENT.ROOMID','INNER');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ATTACHMENT.SEATID','INNER');
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
	
	function getAttachmentInfobyId($AllotID)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('ATTACHMENT_ID',$AllotID);
        $otherdb->select('TBL_ATTACHMENT.*,TBL_HOSTEL.HOSTELDESC,TBL_ROOM.ROOMDESC,TBL_SEAT.SEAT');
        $otherdb->from('TBL_ATTACHMENT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTEL_NO = TBL_ATTACHMENT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ATTACHMENT.ROOMID','INNER');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ATTACHMENT.SEATID','INNER');
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
    
    function editReAllotment($allotmentInfo, $regno)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('REGNO',$regno);
        $otherdb->update('TBL_ALLOTMENT', $allotmentInfo);
        
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
	
	function getAllseminfo($gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
		$otherdb->from('TBL_SEMESTER');
		$otherdb->where('GENDER', $gender);
		$otherdb->order_by('SMCODE', 'DESC');
		$otherdb->limit(1);
        $query = $otherdb->get();
		return $query->result();
       
    }


    /**
     * This function is used to match users password for change password
     * @param number $userId : This is user id
     */
   function VerfiyGuestRegno($attachregno, $gender)
    {
       
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_ALLOTMENT.ALLOTMENT_ID,TBL_ALLOTMENT.REGNO,TBL_ALLOTMENT.STUDENTNAME,TBL_HOSTEL.HOSTELID,TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMID, TBL_ROOM.ROOMDESC, TBL_ROOM.ROOMTYPE, TBL_SEAT.SEATID, TBL_SEAT.SEAT, TBL_SEAT.OCCUPIED, TBL_USERS.email, TBL_USERS.mobile, TBL_ALLOTMENT.COUNTRY, TBL_ALLOTMENT.PROVINCE');
        $otherdb->from('TBL_ALLOTMENT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER');
		$otherdb->join('TBL_USERS', 'TBL_USERS.userId = TBL_ALLOTMENT.EMAILID','INNER');
		$otherdb->where('TBL_ALLOTMENT.GENDER',$gender);
		$otherdb->where('TBL_ALLOTMENT.REGNO',$attachregno);
		//$otherdb->where('TBL_ALLOTMENT.IS_SUBMIT',1);
		$otherdb->where('TBL_ALLOTMENT.ADMIN_VERIFY',1);
		$otherdb->where('TBL_SEAT.OCCUPIED',1);
		//$otherdb->order_by('TBL_HOSTEL.HOSTEL_NO');
		$otherdb->get();
        
        $query1 =  $otherdb->last_query();
		
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_REALLOTMENT.REALLOTMENT_ID,TBL_REALLOTMENT.REGNO,TBL_REALLOTMENT.STUDENTNAME,TBL_HOSTEL.HOSTELID,TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMID, TBL_ROOM.ROOMDESC, TBL_ROOM.ROOMTYPE, TBL_SEAT.SEATID, TBL_SEAT.SEAT, TBL_SEAT.OCCUPIED, TBL_USERS.email,TBL_USERS.mobile, TBL_REALLOTMENT.COUNTRY, TBL_REALLOTMENT.PROVINCE');
        $otherdb->from('TBL_REALLOTMENT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_REALLOTMENT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_REALLOTMENT.ROOMID','INNER');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_REALLOTMENT.SEATID','INNER');
		$otherdb->join('TBL_USERS', 'TBL_USERS.userId = TBL_REALLOTMENT.EMAILID','INNER');
		$otherdb->where('TBL_REALLOTMENT.GENDER',$gender);
		$otherdb->where('TBL_REALLOTMENT.REGNO',$attachregno);
		//$otherdb->where('TBL_REALLOTMENT.IS_SUBMIT',1);
		$otherdb->where('TBL_REALLOTMENT.ADMIN_VERIFY',1);
		$otherdb->where('TBL_SEAT.OCCUPIED',1);
		$otherdb->order_by('HOSTEL_NO','ASC');
		$otherdb->order_by('ROOMDESC','ASC');
		$otherdb->get();
		
		$query2 =  $otherdb->last_query();
		
	    $query = $otherdb->query($query1." UNION ".$query2);
		
		return $query->result();
	
    }
    
    /**
     * This function is used to GET hostel room by reg no
     * @param number $reg : This is user id
     * @param array $userInfo : This is user updation info
     */
    
	function VerifyUserRecordById($regno, $gender)
    {
       
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_ALLOTMENT.ALLOTMENT_ID,TBL_ALLOTMENT.REGNO,TBL_ALLOTMENT.STUDENTNAME, TBL_ALLOTMENT.EXPIRYDATE,  TBL_HOSTEL.HOSTELID,TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMID, TBL_ROOM.ROOMDESC, TBL_ROOM.ROOMTYPE, TBL_SEAT.SEATID, TBL_SEAT.SEAT, TBL_SEAT.OCCUPIED, TBL_USERS.email, TBL_USERS.mobile, TBL_ALLOTMENT.COUNTRY, TBL_ALLOTMENT.PROVINCE');
        $otherdb->from('TBL_ALLOTMENT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER');
		$otherdb->join('TBL_USERS', 'TBL_USERS.userId = TBL_ALLOTMENT.EMAILID','INNER');
		$otherdb->where('TBL_ALLOTMENT.GENDER',$gender);
		$otherdb->where('TBL_ALLOTMENT.REGNO',$regno);
		//$otherdb->where('TBL_ALLOTMENT.IS_SUBMIT',1);
		//$otherdb->where('TBL_ALLOTMENT.ADMIN_VERIFY',1);
		$otherdb->where('TBL_SEAT.OCCUPIED',1);
		//$otherdb->order_by('TBL_HOSTEL.HOSTEL_NO');
		$otherdb->get();
        
        $query1 =  $otherdb->last_query();
		
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_REALLOTMENT.REALLOTMENT_ID,TBL_REALLOTMENT.REGNO,TBL_REALLOTMENT.STUDENTNAME, TBL_REALLOTMENT.EXPIRYDATE, TBL_HOSTEL.HOSTELID,TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMID, TBL_ROOM.ROOMDESC, TBL_ROOM.ROOMTYPE, TBL_SEAT.SEATID, TBL_SEAT.SEAT, TBL_SEAT.OCCUPIED, TBL_USERS.email,TBL_USERS.mobile, TBL_REALLOTMENT.COUNTRY, TBL_REALLOTMENT.PROVINCE');
        $otherdb->from('TBL_REALLOTMENT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_REALLOTMENT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_REALLOTMENT.ROOMID','INNER');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_REALLOTMENT.SEATID','INNER');
		$otherdb->join('TBL_USERS', 'TBL_USERS.userId = TBL_REALLOTMENT.EMAILID','INNER');
		$otherdb->where('TBL_REALLOTMENT.GENDER',$gender);
		$otherdb->where('TBL_REALLOTMENT.REGNO',$regno);
		//$otherdb->where('TBL_REALLOTMENT.IS_SUBMIT',1);
		//$otherdb->where('TBL_REALLOTMENT.ADMIN_VERIFY',1);
		$otherdb->where('TBL_SEAT.OCCUPIED',1);
		$otherdb->order_by('HOSTEL_NO','ASC');
		$otherdb->order_by('ROOMDESC','ASC');
		$otherdb->get();
		
		$query2 =  $otherdb->last_query();
		
	    $query = $otherdb->query($query1." UNION ".$query2);
		
		return $query->result();
	
    }
	
	function GetAttachiRecord($attachregno)
	 {
		$this->db->select('STUDENTNAME, CNIC');
        $this->db->from('TBL_HSTUDENTS');
		$this->db->where('REGNO', $attachregno);
		$query =  $this->db->get();
        
        return $query->result();
	 }
	 
	  /**
     * This function is used to check whether email id is already exist or not
     * @param {string} $email : This is email id
     * @param {number} $userId : This is user id
     * @return {mixed} $result : This is searched result
     */
    function CheckEmailExist($email)
	{
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('email',$email);
		$query = $otherdb->get('TBL_USERS');
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function CreateNewUser($studentusercreate)
    {
        
		// the TRUE paramater tells CI that you'd like to return the database object.
		
		$otherdb = $this->load->database('otherdb', TRUE); 
		
		$otherdb->trans_start();
		
        $query = $otherdb->insert('TBL_USERS', $studentusercreate);
    
        $otherdb->trans_complete();
		
		$insert_id = $otherdb->insert_id();
        
        //return $insert_id;
		
		$otherdb->select('userId');
        $otherdb->from('TBL_USERS');
		$otherdb->ORDER_BY('userId DESC LIMIT 1');
        $query =  $otherdb->get();
        
        return $query->result();
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
	
}


  