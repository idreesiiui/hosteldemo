<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(E_ALL);
class Allotmenthistory_model extends CI_Model
{
    
    /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */

    public function __construct(){

		$this->otherdb = $this->load->database('otherdb', TRUE);
		
	}


	public function getAllotmentStudentData($type, $semster, $gender){
		return $this->otherdb->where('GENDER',$gender)
					->where('ALLOTTYPE',$type)
					->where('SEMCODE',$semster)
					->where('ADMIN_VERIFY','1')
					->get('tbl_allotmenthistory')
					->result();
	}

	public function getAllotmentTotalStudentData($semster,$gender){
		return $this->otherdb->where('GENDER',$gender)
					->where('ALLOTTYPE','Allotment')
					->where('SEMCODE',$semster)
					->where('ADMIN_VERIFY','1')
					->get('tbl_allotmenthistory')
					->num_rows();
	}


	public function getReallotmentTotalStudentData($semster,$gender){
		return $this->otherdb->where('GENDER',$gender)
					->where('ALLOTTYPE','ReAlloted')
					->where('SEMCODE',$semster)
					->where('ADMIN_VERIFY','1')
					->get('tbl_allotmenthistory')
					->num_rows();
	}

	
   	function getHostelInfo($gender)
    {
        return $this->otherdb->where('GENDER',$gender)->get('TBL_HOSTEL')->result();
    }
	
	function CheckEmailExist($email)
	{		
		$rows = $this->otherdb->where('email',$email)->get('TBL_USERS')->num_rows();

		return ($rows > 0) ? true : false;
	}
    
	function mail_exists($email)
	{
		$rows = $this->db->where('EMAIL',$email)->get('TBL_USERS')->num_rows();

		return ($rows > 0) ? true : false;
	}
	
	function Updatepassword($updatepassword, $emailid)
    {
        
		$this->otherdb->where('userId',$emailid)->update('TBL_USERS', $updatepassword);
        
        return $this->otherdb->affected_rows();
    }
	
	function GenrateCancelList($gender)
	{
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('ADMIN_VERIFY');
        $otherdb->from('TBL_ALLOTMENTHISTORY');
		$otherdb->where('GENDER',$gender);
		$otherdb->where('ADMIN_VERIFY',2);
        $query =  $otherdb->get();
        
        return $query->result();
	}
	
	function GenrateDefaulterList($gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('*');
        $otherdb->from('TBL_ALLOTMENTHISTORY');
		$otherdb->where('GENDER',$gender);
		$otherdb->where('ADMIN_VERIFY',2);
        $query =  $otherdb->get();
        
        return $query->result();
    }
	
	function GetseatagainstDefault($gender,$AllotID)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('*');
        $otherdb->from('TBL_DEFAULT');
		$otherdb->where('GENDER',$gender);
		$otherdb->where('ALLOTMENTHISTORY_ID',$AllotID);
        $query =  $otherdb->get();
        
        return $query->result();
    }
	function GetseatInfos($gender,$AllotID,$hostelid,$roomid,$seatid)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('*');
        $otherdb->from('TBL_ALLOTMENTHISTORY');
		$otherdb->where('GENDER',$gender);
		$otherdb->where('ALLOTMENTHISTORY_ID',$AllotID);
		$otherdb->where('HOSTELID',$hostelid);
		$otherdb->where('ROOMID',$roomid);
		$otherdb->where('SEATID',$seatid);
        $query =  $otherdb->get();
        
        return $query->result();
    }
	
	function getAllSemester($gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('*');
        $otherdb->from('TBL_SEMESTER');
		$otherdb->where('GENDER',$gender);
		//$otherdb->orderby('STARTREGDATE');
		$otherdb->order_by("SMSTARTDATE", "desc");
        $query =  $otherdb->get();
        
        return $query->result();
    }
	
	
	
    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
	  function addHisAllotment($hisallotmentInfo)
    {
        //$this->db->trans_start();
		// the TRUE paramater tells CI that you'd like to return the database object.
		
		$otherdb = $this->load->database('otherdb', TRUE); 
		
        $otherdb->insert('TBL_ALLOTMENTHISTORY', $hisallotmentInfo);
    
               
        return $otherdb->insert_id();
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
	
	 
    function addNewAllotment($allotmentInfo)
    {
        //$this->db->trans_start();
		// the TRUE paramater tells CI that you'd like to return the database object.
		
		$otherdb = $this->load->database('otherdb', TRUE); 
		
        $otherdb->insert('TBL_ALLOTMENTHISTORY', $allotmentInfo);
    
        return $otherdb->insert_id();
    }
	
	function InsertAllotInfoToDefault($defaultInfo)
    {
        $otherdb = $this->load->database('otherdb', TRUE); 
		
		$otherdb->trans_start();
	
        $otherdb->insert('TBL_DEFAULT', $defaultInfo);    
        
        return $otherdb->insert_id();
    }
	
	function InsertAllotInfoToAllotment($defaultInfo)
    {
        $otherdb = $this->load->database('otherdb', TRUE); 
		
		$otherdb->trans_start();
	
        $otherdb->insert('TBL_ALLOTMENTHISTORY', $defaultInfo);
    
        return $otherdb->insert_id();
    }
	
	function addNewItems($itemInfo)
    {
        //$this->db->trans_start();
		// the TRUE paramater tells CI that you'd like to return the database object.
		
		$otherdb = $this->load->database('otherdb', TRUE); 
		
        $otherdb->insert('TBL_ROOMITEM', $itemInfo);    
        
        return $otherdb->insert_id();
    }
	
	function seat_exists_against_Regno($regno)
	{
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('REGNO',$regno);
		$query = $otherdb->get('TBL_ALLOTMENTHISTORY');
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
    function viewallotmentInfo($gender,$hostelno,$roomno,$semester)
    {
		if(!empty($gender) && empty($hostelno) && empty($roomno) && !empty($semester))
		{
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_ALLOTMENTHISTORY.*,TBL_SEAT.SEAT,TBL_HOSTEL.HOSTEL_NO,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE');
        $otherdb->from('TBL_ALLOTMENTHISTORY');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENTHISTORY.SEATID','INNER');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENTHISTORY.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENTHISTORY.ROOMID','INNER');
		$otherdb->where('TBL_ALLOTMENTHISTORY.GENDER',$gender);
		$otherdb->where('TBL_ALLOTMENTHISTORY.SEMCODE',$semester);
        $query =  $otherdb->get();
        
        return $query->result();
		
	    }
		
		elseif(!empty($gender) && empty($hostelno) && empty($roomno) && !empty($semester))
		{
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_ALLOTMENTHISTORY.*,TBL_SEAT.SEAT,TBL_HOSTEL.HOSTEL_NO,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE');
        $otherdb->from('TBL_ALLOTMENTHISTORY');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENTHISTORY.SEATID','INNER');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENTHISTORY.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENTHISTORY.ROOMID','INNER');
		$otherdb->where('TBL_ALLOTMENTHISTORY.GENDER',$gender);
		$otherdb->where('TBL_HOSTEL.HOSTELID',$hostelno);
		$otherdb->where('TBL_ROOM.ROOMID',$roomno);
		$otherdb->where('TBL_ALLOTMENTHISTORY.SEMCODE',$semester);
        $query =  $otherdb->get();
        
        return $query->result();
		
	    }
		
		if(!empty($gender) && empty($hostelno) && empty($roomno))
		{
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_ALLOTMENTHISTORY.*,TBL_SEAT.SEAT,TBL_HOSTEL.HOSTEL_NO,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE');
        $otherdb->from('TBL_ALLOTMENTHISTORY');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENTHISTORY.SEATID','INNER');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENTHISTORY.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENTHISTORY.ROOMID','INNER');
		$otherdb->where('TBL_ALLOTMENTHISTORY.GENDER',$gender);
		$otherdb->where('TBL_ALLOTMENTHISTORY.SEMCODE',$semester);
        $query =  $otherdb->get();
        
        return $query->result();
		
	    }
		
		elseif(!empty($gender) && !empty($hostelno) && !empty($roomno))
		{
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_ALLOTMENTHISTORY.*,TBL_SEAT.SEAT,TBL_HOSTEL.HOSTEL_NO,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE');
        $otherdb->from('TBL_ALLOTMENTHISTORY');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENTHISTORY.SEATID','INNER');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENTHISTORY.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENTHISTORY.ROOMID','INNER');
		$otherdb->where('TBL_ALLOTMENTHISTORY.GENDER',$gender);
		$otherdb->where('TBL_HOSTEL.HOSTELID',$hostelno);
		$otherdb->where('TBL_ROOM.ROOMID',$roomno);
		$otherdb->where('TBL_ALLOTMENTHISTORY.SEMCODE',$semester);
        $query =  $otherdb->get();        
        
        return $query->result();
		
	    }
	elseif (!empty($gender) && !empty($hostelno) && empty($roomno))
	
		{
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_ALLOTMENTHISTORY.*,TBL_SEAT.SEAT,TBL_HOSTEL.HOSTEL_NO,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE');
        $otherdb->from('TBL_ALLOTMENTHISTORY');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENTHISTORY.SEATID','INNER');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENTHISTORY.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENTHISTORY.ROOMID','INNER');
		$otherdb->where('TBL_ALLOTMENTHISTORY.GENDER',$gender);
		$otherdb->where('TBL_HOSTEL.HOSTELID',$hostelno);
		$otherdb->where('TBL_ALLOTMENTHISTORY.SEMCODE',$semester);
        $query =  $otherdb->get();
                
        return $query->result();
		
	    }
	
}
	
	function getAllHostelInfo($gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('*');
        $otherdb->from('TBL_HOSTEL');
		$otherdb->where('GENDER',$gender);
        $query =  $otherdb->get();
        
        return $query->result();
    }
	
	function getAllRoomInfo($hostelid, $gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('ROOMID,ROOMDESC');
        $otherdb->from('TBL_ROOM');
		$otherdb->where('HOSTELID',$hostelid);
		$otherdb->where('GENDER',$gender);
		$otherdb->order_by('ROOMDESC','ASC');
        $query =  $otherdb->get();
        
        return $query->result();
    }
	
	function getAllSeatInfo($roomid, $gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('SEATID,SEAT');
        $otherdb->from('TBL_SEAT');
		$otherdb->where('ROOMID',$roomid);
		$otherdb->where('GENDER',$gender);
		
        $query =  $otherdb->get();
        
        return $query->result();
    }
	
	function gethostelNameById($hostelId)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('*');
        $otherdb->from('TBL_HOSTEL');
	    $otherdb->where('HOSTELID',$hostelId);
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
	
	function getAllotmentInfobyId($AllotID, $gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('TBL_ALLOTMENTHISTORY.ALLOTMENTHISTORY_ID', $AllotID);
		$otherdb->where('TBL_ALLOTMENTHISTORY.GENDER', $gender);
        $otherdb->select('TBL_ALLOTMENTHISTORY.*,TBL_HOSTEL.HOSTEL_NO,TBL_HOSTEL.HOSTELDESC,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE,TBL_SEAT.SEATID,TBL_SEAT.SEAT');
        $otherdb->from('TBL_ALLOTMENTHISTORY');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENTHISTORY.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENTHISTORY.ROOMID','INNER');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENTHISTORY.SEATID','INNER');
		$query =  $otherdb->get();
        
        return $query->result();
    }
	
	function getAllotmentInfobyRegno($regno, $gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('REGNO', $regno);
		$otherdb->where('GENDER', $gender);
        $otherdb->select('ALLOTMENTHISTORY_ID');
        $otherdb->from('TBL_ALLOTMENTHISTORY');
		$otherdb->ORDER_BY('ALLOTMENTHISTORY_ID','ASC');
		$otherdb->limit('1');
		$query =  $otherdb->get();
        
        return $query->result();
    }
	
	function getAllotmentEmail($emailsId, $gender, $sname)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('TBL_USERS.userId', $emailsId);
		$otherdb->where('TBL_USERS.gender', $gender);
        $otherdb->select('email,userId');
        $otherdb->from('TBL_USERS');
		$query =  $otherdb->get();
        
		$result =  $query->result();
		
		 if(empty($result))
	   {
		 $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('TBL_APPLICATION.STUDENTNAME', $sname);
		$otherdb->where('TBL_APPLICATION.GENDER', $gender);
        $otherdb->select('TBL_APPLICATION.STUDENTEMAIL AS email');
        $otherdb->from('TBL_APPLICATION');
		$query =  $otherdb->get();
		 
		 return $result =  $query->result();
	   }
	   else
		  {
			return $result;
		  }
		
        
    }
	
	function getRoomInfo($hostelId, $gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('TBL_HOSTEL.HOSTELID',$hostelId);
		$otherdb->where('TBL_HOSTEL.GENDER',$gender);
		$otherdb->select('TBL_ROOM.*,TBL_HOSTEL.GENDER,TBL_HOSTEL.HOSTEL_NO');
        $otherdb->from('TBL_ROOM');
		$otherdb->join('TBL_HOSTEL', 'TBL_ROOM.HOSTELID = TBL_HOSTEL.HOSTELID','INNER');
		$otherdb->order_by('ROOMDESC','ASC');
		
        $query =  $otherdb->get();
		
        return $query->result();
    }
	
	function GetSeatByRIdHId($hostelId, $roomId, $gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        
		$otherdb->where('TBL_HOSTEL.HOSTELID',$hostelId);
		$otherdb->where('TBL_ROOM.ROOMID',$roomId);
		$otherdb->where('TBL_SEAT.GENDER',$gender);
		$otherdb->where('TBL_SEAT.OCCUPIED',0);
		$otherdb->select('TBL_SEAT.*');
        $otherdb->from('TBL_SEAT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_SEAT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_SEAT.ROOMID','INNER');
		
        $query =  $otherdb->get();
		
        return $query->result();
    }
	
	function GetESeatByRIdHId($hostelId, $roomId, $gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        
		$otherdb->where('TBL_HOSTEL.HOSTELID',$hostelId);
		$otherdb->where('TBL_ROOM.ROOMID',$roomId);
		$otherdb->where('TBL_SEAT.GENDER',$gender);
		$otherdb->select('TBL_SEAT.*');
        $otherdb->from('TBL_SEAT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_SEAT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_SEAT.ROOMID','INNER');
		
        $query =  $otherdb->get();
		
        return $query->result();
    }
	
	function GetRoomIdByHno($hostelno, $roomno, $gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('HOSTELID',$hostelno);
		$otherdb->where('ROOMDESC',$roomno);
		$otherdb->where('GENDER',$gender);
		$otherdb->select('ROOMID');
        $otherdb->from('TBL_ROOM');
		
        $query =  $otherdb->get();
		
        return $query->result();
    }
	
	function GetAllotVerifyById($allotmentid)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('ALLOTMENTHISTORY_ID',$allotmentid);
		$otherdb->select('ADMIN_VERIFY');
        $otherdb->from('TBL_ALLOTMENTHISTORY');
		
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
	
	function getRoomInfobyId($hostelId, $roomId, $gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('ROOMID',$roomId);
		$otherdb->where('HOSTELID',$hostelId);
		$otherdb->where('GENDER',$gender);
        $otherdb->select('*');
        $otherdb->from('TBL_ROOM');
        $query =  $otherdb->get();
        
        return $query->result();
    }
	
	function GetAllotEmailIds($emailid)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('EMAILID',$emailid);
        $otherdb->select('count(EMAILID) as EMAILID');
        $otherdb->from('TBL_ALLOTMENTHISTORY');
        $query =  $otherdb->get();
        
        return $query->result();
    }
	
	function GetExistEmail($emailid)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('userId',$emailid);
        $otherdb->select('*');
        $otherdb->from('tbl_users');
        $query =  $otherdb->get();
        
        return $query->result();
    }
	
	function GetAllotFromAllotHis($allotmentid)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('ALLOTMENTHISTORY_ID',$allotmentid);
        $otherdb->select('ALLOTMENTHISTORY_ID');
        $otherdb->from('TBL_ALLOTMENTHISTORY');
        $query =  $otherdb->get();
        
        return $query->result();
    }
    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function editAllotment($allotmentInfo, $allotmentid)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('ALLOTMENTHISTORY_ID',$allotmentid);
        $otherdb->update('TBL_ALLOTMENTHISTORY', $allotmentInfo);
        
        return $otherdb->affected_rows();
    }
	
	function editAllotmentHis($updateHInfo, $allotmentid)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('ALLOTMENTHISTORY_ID',$allotmentid);
        $otherdb->update('TBL_ALLOTMENTHISTORY', $updateHInfo);
        
        return $otherdb->affected_rows();
    }
	
	 function UpdatestudMail($Updatestudentemail, $userid)
    
	{
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('userId',$userid);
        $otherdb->update('tbl_users', $Updatestudentemail);
        
        return $otherdb->affected_rows();
    }
	
	function UpdateseatInfo($updateseatstatus, $seatavilabel)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('SEATID',$seatavilabel);
        $otherdb->update('TBL_SEAT', $updateseatstatus);
        
        return $otherdb->affected_rows();
    }
    
    function UpdatedSeatStatus($updateseatstatus,$oldhostel,$oldroom,$oldseat)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('HOSTELID',$oldhostel);
		$otherdb->where('ROOMID',$oldroom);
		$otherdb->where('SEATID',$oldseat);
        $otherdb->update('TBL_SEAT', $updateseatstatus);
        
        return $otherdb->affected_rows();
    }
	
	
	function UpdatedSeatDeafult($updateseat, $hostelid, $roomid, $seatid, $gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('HOSTELID',$hostelid);
		$otherdb->where('ROOMID',$roomid);
		$otherdb->where('SEATID',$seatid);
		$otherdb->where('GENDER',$gender);
        $otherdb->update('TBL_SEAT',$updateseat);
        
        return $otherdb->affected_rows();
    }    
	
	function DelAllDefault($gender,$allotid,$adminverify)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('GENDER', $gender);
		$otherdb->where('ALLOTMENTHISTORY_ID', $allotid);
		$otherdb->where('ADMIN_VERIFY', $adminverify);
        $otherdb->delete('TBL_ALLOTMENTHISTORY');
        
        return $otherdb->affected_rows();
    }
	
	function DelFromDefault($gender,$allotid)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('GENDER', $gender);
		$otherdb->where('ALLOTMENTHISTORY_ID', $allotid);
        $otherdb->delete('TBL_DEFAULT');
        
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

	function VerifyUserRecordById($regno, $gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('REGNO', $regno);
		$otherdb->where('GENDER', $gender);
		$otherdb->select('*');
        $otherdb->from('TBL_APPLICATION');
		$query =  $otherdb->get();
		
        $result =  $query->result();
	   
	   if(empty($result))
	   {
		 $this->db->select('*');
         $this->db->from('TBL_HSTUDENTS');
		 $this->db->where('REGNO', $regno);
         $query = $this->db->get();
		 
		 return $result =  $query->result();
	   }
	   else
		  {
			return $result;
		  }
    }
    
     function getstudentemail($gender,$emailid)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_USERS.EMAIL,TBL_ALLOTMENTHISTORY.STUDENTNAME,TBL_USERS.PASSWORD');
        $otherdb->from('TBL_ALLOTMENTHISTORY');
		$otherdb->join('TBL_USERS', 'TBL_USERS.userId = TBL_ALLOTMENTHISTORY.EMAILID','INNER');
		$otherdb->where('TBL_ALLOTMENTHISTORY.GENDER',$gender);
		$otherdb->where('TBL_USERS.userId',$emailid);
		$otherdb->where('TBL_ALLOTMENTHISTORY.ADMIN_VERIFY',1);
        $query =  $otherdb->get();
        
        return $query->result();
    }
    
	
}


  