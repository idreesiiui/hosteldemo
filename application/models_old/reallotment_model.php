<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class ReAllotment_model extends CI_Model
{

	public function __construct(){

		$this->otherdb = $this->load->database('otherdb', TRUE);
	}

    function getAllHostelInfo($gender)
    {
		return $this->otherdb->where('GENDER',$gender)
							->order_by('HOSTEL_NO', 'asc')
							->get('TBL_HOSTEL')
							->result();
    }
	
	function getPrevHostelInfo($regno)
    {		
        return $this->otherdb->select('SEMCODE')
							->where('REGNO',$regno)
							->where('ALLOTTYPE LIKE', 'A%')
							->order_by('ALLOTMENTHISTORY_ID', 'desc')
							->limit('1')
        					->get('TBL_ALLOTMENTHISTORY')
        					->row();
    }
	
	
	function cancelstudinfo($gender)
    {
		return $this->otherdb->where('GENDER',$gender)
					->where('ADMIN_VERIFY',0)
					->get('tbl_reallotment')
					->result();
    }
	
	function CheckReallotmentDone($regno, $semcode)
    {
		$query = $this->otherdb->select('REGNO')
						->where('regno',$regno)
						->where('SEMCODE',$semcode)
						->get('tbl_reallotment');
		
        return $query->num_rows();
    }
	
	function GetFeeStatus($regno, $semcode)
    {
		return $this->otherdb->where('SEMCODE',$semcode)
							->where('REGNO',$regno)
							->get('TBL_FEESTATUS')
							->result();
    }
	
	function GetEmailId($email,$gender)
	{
		return $this->otherdb->select('userId')
							->where('email',$email)
							->where('gender',$gender)
							->get('TBL_USERS')
							->result();
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
	
	function KeyExist($regno, $key, $gender, $semcode)
	{
		return $this->otherdb->where('REGNO',$regno)
					->where('KEY',$key)
					->where('GENDER',$gender)
					->where('SEMCODE',$semcode)
					->select('ID')
			        ->get('tbl_key')		
			        ->result();
		
	}
    
    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewReAllotment($reallotmentInfo)
    {		 
		
       	$this->otherdb->insert('TBL_REALLOTMENT', $reallotmentInfo);
        
        return $this->otherdb->insert_id();
    }
	
	function seat_exists_against_Regno($regno)
	{
		$query = $this->otherdb->where('REGNO',$regno)->get('TBL_REALLOTMENT');

		if ($query->num_rows() > 0){

			return true;

		} else {

			$query = $this->otherdb->where('REGNO',$regno)->get('TBL_ALLOTMENT');
			
			return ($query->num_rows() > 0) ? true : false;
		}
	}
	
	function BlackList_exists_against_Regno($regno, $gender)
	{
		$query = $this->otherdb->where('regno',$regno)
								->where('gender',$gender)
								->get('TBL_BLACKLIST');

		return ($query->num_rows() > 0) ? true : false;
	}
	
	function Email_exists($email,$emailid,$gender)
	{
		$query = $this->otherdb->where('email',$email)
						->where('userId',$emailid)
						->where('gender',$gender)
						->get('TBL_USERS');

		return ($query->num_rows() > 0) ? true : false;
	}
	
	function Emailid_exists($emailid)
	{
		$query = $this->otherdb->where('userId',$emailid)->get('TBL_USERS');

		return ($query->num_rows() > 0) ? true : false;
	}
	
	function allotment_exists_against_expdate($expdate)
	{
		$query = $this->otherdb->where('EXPIRYDATE',$expdate)->get('TBL_REALLOTMENT');

		return ($query->num_rows() > 0) ? true : false;
	}
	
	function addNewItems($reallotitemInfo)
    {
		
        $this->otherdb->insert('TBL_ROOMITEM', $reallotitemInfo);    
        
        return $this->otherdb->insert_id();
    }
	
	function getReAllotmentInfobyId($AllotID, $gender)
    {
		return $this->otherdb->select('TBL_REALLOTMENT.*,TBL_HOSTEL.HOSTEL_NO,TBL_HOSTEL.HOSTELDESC,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE,TBL_SEAT.SEATID,TBL_SEAT.SEAT')
			        ->from('TBL_REALLOTMENT')
					->where('TBL_REALLOTMENT.REALLOTMENT_ID', $AllotID)
					->where('TBL_REALLOTMENT.GENDER', $gender)        
					->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_REALLOTMENT.HOSTELID','INNER')
					->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_REALLOTMENT.ROOMID','INNER')
					->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_REALLOTMENT.SEATID','INNER')
					->get()
			        ->result();
    }
	
	function getAllRoomInfo($hostelid, $gender)
    {
        return $this->otherdb->select('ROOMID,ROOMDESC')
					->where('HOSTELID',$hostelid)
					->where('GENDER',$gender)
					->order_by('ROOMDESC','ASC')
			        ->get('TBL_ROOM')        
			        ->result();
    }
	
	function GetReallotsemInfo($gender)
    {
        return $this->otherdb->where('REALLOTSTATUS',1)
			        ->where('GENDER',$gender)
			        ->where('IS_ACTIVE','1')
			        ->get('TBL_SEMESTER')
			        ->result();
    }
	
	function GetsemInfo($gender)
    {
        return $this->otherdb->select('SEMCODE')
			        ->where('GENDER',$gender)
			        ->group_by('SEMCODE')
			        ->order_by('SMCODE', 'ASC')
			        ->get('TBL_SEMESTER')
			        ->result();
    }
	
	function Getsemester($gender)
    {
        return $this->otherdb->where('GENDER',$gender)
        			->where('IS_ACTIVE','1')
			        // ->order_by('SMCODE', 'DESC')
			        // ->limit('1')
			        ->get('TBL_SEMESTER')
			        ->row();
    }
	
	function GetstudId()
    {
        return $this->otherdb->select('ALLOTMENTHISTORY_ID')
			        ->order_by('ALLOTMENTHISTORY_ID','desc')
			        ->limit('1')
			        ->get('TBL_ALLOTMENTHISTORY')
			        ->result();
    }
	
	function GetstudEid($emailid)
    {
        return $this->otherdb->where('userId',$emailid)->get('TBL_USERS')->result();
    }
	
	function GetstudInfoReallot($gender,$regno)
    {
        return $this->otherdb->where('REGNO',$regno)
			        ->where('GENDER',$gender)
			        ->get('TBL_REALLOTMENT')
			        ->result();
    }
	
	function GetstudInfoByRegno($regno)
    {
        return $this->otherdb->where('REGNO',$regno)
			        ->order_by('TBL_ALLOTREALLOT.ID','desc')
			        ->limit('1')
			        ->get('TBL_ALLOTREALLOT')
			        ->result();
    }
	
	function GetstudInfoByUId($gender,$userId)
    {
        $result = $this->otherdb->where('EMAILID',$userId)
				        ->where('GENDER',$gender)
				        ->get('TBL_ALLOTREALLOT')
				        ->result();
		
		if(empty($result))
		{
			$result = $this->otherdb->where('EMAILID',$userId)
							->where('GENDER',$gender)
							->get('TBL_REALLOTMENT')
							->result();
        }

        if(empty($result)){

			$result = $this->otherdb->where('EMAILID',$userId)
							->where('GENDER',$gender)
							->get('TBL_ALLOTMENT')
							->result();

		}

		return $result;
		
    }
	
	function GetstudInfoByRegNoId($studregno)
    {
        $result = $this->otherdb->where('REGNO',$studregno)->get('TBL_ALLOTREALLOT')->result();
		
		if(empty($result))
		{
			$result = $this->otherdb->where('REGNO',$studregno)->get('TBL_REALLOTMENT')->result();
		}

		if(empty($result)){

			$result = $this->otherdb->where('REGNO',$studregno)->get('TBL_ALLOTMENT')->result();
		}

		return $result;
		
    }
	
	function GetNewstudInfoByRegNoId($studregno)
    {
		$result = $this->otherdb->WHERE('REGNO', $studregno)->get('TBL_APPLICATION')->result();

	    if(empty($result))
	    {
			$result = $this->otherdb->WHERE('REGNO', $studregno)
							->get('TBL_MALEAPPLICATION')
							->result();
	    }
	    
	   	return $result;
    }
	
	function GetstudInfoByRegId($gender,$studregno)
    {
        $result = $this->otherdb->where('REGNO',$studregno)
				        ->where('GENDER',$gender)
				        ->get('TBL_ALLOTREALLOT')
				        ->result();
		
		if(empty($result))
		{
			$result = $this->otherdb->where('REGNO',$studregno)
							->where('GENDER',$gender)
							->get('TBL_REALLOTMENT')
							->result();
        }

		if(empty($result)){

			$result = $this->otherdb->where('REGNO',$studregno)
							->where('GENDER',$gender)
							->get('TBL_ALLOTMENT')
							->result();
		}

		return $result;
    }
	
	function GetstudReallotInfoByUId($gender,$semcode,$programe)
    {
        return $this->otherdb->where('GENDER',$gender)
			        ->where('SEMNAME',$semcode)
			        ->where('PROTITTLE',$programe)
			        ->get('TBL_REALLOTSETTING')
			        ->result();
    }
	
		
	function GetBatchname($regno)
    {
        return $this->db->select('BATCHNAME')
			        ->where('TBL_HSTUDENTS.REGNO', $regno)
			        ->get('TBL_HSTUDENTS')
			        ->result();
    }
    
    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function viewreallotmentInfo($gender,$hostelno,$roomno)
    {

        $this->otherdb->select('TBL_REALLOTMENT.*,TBL_SEAT.SEAT,TBL_SEAT.OCCUPIED,TBL_HOSTEL.HOSTEL_NO,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE')
    		->from('TBL_REALLOTMENT')
			->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_REALLOTMENT.SEATID','INNER')
			->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_REALLOTMENT.HOSTELID','INNER')
			->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_REALLOTMENT.ROOMID','INNER');

			if(!empty($gender)){
				$this->otherdb->where('TBL_REALLOTMENT.GENDER',$gender);
			}
			if(!empty($hostelno)){
				$this->otherdb->where('TBL_HOSTEL.HOSTELID',$hostelno);
			}
			if(!empty($roomno)){
				$this->otherdb->where('TBL_ROOM.ROOMID',$roomno);
			}

        return $this->otherdb->get()->result();
	
    }

	function getkeyInfo($regno, $gender)
    {
		
		return $this->otherdb->where('REGNO',$regno)
							->where('GENDER',$gender)
							->order_by('ID', 'DESC')
							->get('TBL_KEY')
							->result();
    }
	
	function addNewAllotmentKey($randKeyInfo)
    {
		
        $this->otherdb->insert('TBL_KEY', $randKeyInfo);
    
       return $this->otherdb->insert_id();
    }
	
	function Seatstatus($seatavilabel, $gender, $regno)
    {
        $result = $this->otherdb->select('tbl_seat.OCCUPIED, TBL_ALLOTMENT.ADMIN_VERIFY')
        				->from('TBL_SEAT')
						->join('TBL_ALLOTMENT', 'TBL_ALLOTMENT.SEATID = TBL_SEAT.SEATID','INNER')
						->where('TBL_ALLOTMENT.SEATID', $seatavilabel)
						->where('TBL_ALLOTMENT.REGNO', $regno)
						->where('TBL_SEAT.GENDER',$gender)		
         				->get()
						->result();
		
		if(empty($result))
		{
			return $this->otherdb->select('tbl_seat.OCCUPIED, TBL_REALLOTMENT.ADMIN_VERIFY')
						->from('TBL_SEAT')
						->join('TBL_REALLOTMENT', 'TBL_REALLOTMENT.SEATID = TBL_SEAT.SEATID','INNER')
						->where('TBL_REALLOTMENT.SEATID',$seatavilabel)
						->where('TBL_REALLOTMENT.REGNO',$regno)
						->where('TBL_SEAT.GENDER',$gender)
						->get()
						->result();			
			
		}
        
        return $result;
		    
    }
	
	function SeatExistAvail($seatavilabel)
    {
        return $this->otherdb->select('SEATID,SEAT')
							->where('SEATID',$seatavilabel)		
         					->get('TBL_SEAT')        
         					->row();
    }
	
	function getAllSeatInfo($roomid, $gender)
    {
		
        return $this->otherdb->select('SEATID,SEAT')
							->where('ROOMID',$roomid)
							->where('GENDER',$gender)		
         					->get('TBL_SEAT')        
         					->result();
    }
	
	function getAllSeatInfoById($seatavilabel)
    {
        return $this->otherdb->select('TBL_ROOM.ROOMID, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_ROOM.ROOMTYPE, TBL_SEAT.SEATDESC, TBL_SEAT.OCCUPIED, TBL_SEAT.SEATID, TBL_SEAT.SEAT, TBL_HOSTEL.HOSTELID AS HID')
					        ->from('TBL_SEAT')
							->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_SEAT.HOSTELID','INNER')
							->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_SEAT.ROOMID','INNER')
							->where('TBL_SEAT.OCCUPIED','0')
							->where('TBL_SEAT.SEATID',$seatavilabel)
					        ->get()					        
					        ->result();
    }
	
	function RoomInfo()
    {
        return $this->otherdb->get('TBL_ROOM')->result();
    }
	
	function getSeatInfo($hostelno,$roomno,$occupystatus)
    {
        return $this->otherdb->select('TBL_ROOM.ROOMID, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_ROOM.ROOMTYPE, TBL_SEAT.SEATDESC, TBL_SEAT.OCCUPIED, TBL_SEAT.SEATID, TBL_SEAT.SEAT, TBL_HOSTEL.HOSTELID AS HID')
			        ->from('TBL_SEAT')
					->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_SEAT.HOSTELID','INNER')
					->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_SEAT.ROOMID','INNER')
					->where('TBL_SEAT.HOSTELID',$hostelno)
					->where('TBL_SEAT.ROOMID',$roomno)
					->where('TBL_SEAT.OCCUPIED',$occupystatus)
			        ->get()        
			        ->result();
    }
	
	function getSeatInfoByHostelroom($hostelno,$roomno)
    {
        return $this->otherdb->select('TBL_ROOM.ROOMID, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_ROOM.ROOMTYPE, TBL_SEAT.SEATDESC, TBL_SEAT.OCCUPIED, TBL_SEAT.SEATID, TBL_SEAT.SEAT, TBL_HOSTEL.HOSTELID AS HID')
			        ->from('TBL_SEAT')
					->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_SEAT.HOSTELID','INNER')
					->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_SEAT.ROOMID','INNER')
					->where('TBL_SEAT.HOSTELID',$hostelno)
					->where('TBL_SEAT.ROOMID',$roomno)		
			        ->get()        
			        ->result();
    }
	
	function getRoomInfo()
    {
        return $this->otherdb->select('TBL_ROOM.ROOMID, TBL_HOSTEL.HOSTEL_NO, TBL_ROOM.HOSTELID AS RHOSTELID, TBL_ROOM.ROOMDESC, TBL_ROOM.ROOMTYPE, TBL_ROOM.SCAPACITY, TBL_ROOM.FLOOR, TBL_ROOM.BEDS, TBL_ROOM.CHAIRS, TBL_ROOM.TABLES, TBL_ROOM.CUPBOARDS, TBL_ROOM.TUBELIGHTS, TBL_ROOM.FANS, TBL_ROOM.OTHERITEMS')
			        ->from('TBL_ROOM')
					->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ROOM.HOSTELID','INNER')
			        ->get()
			        ->result();
    }
	
	function getRoomInfobyId($ROOMID)
    {
		return $this->otherdb->select('TBL_ROOM.ROOMID, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.HOSTELID AS RHOSTELID, TBL_ROOM.ROOMDESC, TBL_ROOM.ROOMTYPE, TBL_ROOM.SCAPACITY, TBL_ROOM.FLOOR, TBL_ROOM.BEDS, TBL_ROOM.CHAIRS, TBL_ROOM.TABLES, TBL_ROOM.CUPBOARDS, TBL_ROOM.TUBELIGHTS, TBL_ROOM.FANS, TBL_ROOM.OTHERITEMS')
			        ->from('TBL_ROOM')
					->where('ROOMID',$ROOMID)
					->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ROOM.HOSTELID','INNER')
			        ->get()
			        ->result();
    }
	
	function CreateNewUser($studentusercreate)
   	{

        $this->otherdb->insert('TBL_USERS', $studentusercreate);
				
		return $this->otherdb->select('userId')
					->ORDER_BY('userId DESC LIMIT 1')
					->get('TBL_USERS')
					->result();
    }
	
    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
	 function InsertReAllotment($reallotmentInfo)
	{

		$this->otherdb->insert('TBL_REALLOTMENT', $reallotmentInfo);

		return $this->otherdb->insert_id();
			
	}
		
	function InsertFeeStatus($feeInfo)
	{
			
		$this->otherdb->insert('TBL_FEESTATUS', $feeInfo);

		return $this->otherdb->insert_id();
			
	}
		
	function InsertStudentItems($studentitems)
	{
			
		$this->otherdb->insert('tbl_student_item', $studentitems);
		
		return $this->otherdb->insert_id();		
			
	}
	 
	function InsertHistory($historyInfo)
	{
		$this->otherdb->insert('TBL_ALLOTMENTHISTORY', $historyInfo);
		
		return $this->otherdb->insert_id();			
			
	}
		
	function UpdateAllotmentKey($randKeyInfo, $id)
    {
		$this->otherdb->where('ID',$id)->update('tbl_key', $randKeyInfo);
        
        return $this->otherdb->affected_rows();
    }
		
		function Updatepassword($updatepassword, $emailid)
    {
		$this->otherdb->where('userId',$emailid)->update('TBL_USERS', $updatepassword);
        
        return $this->otherdb->affected_rows();
    }
	
	function updateseat($updateseat,$seatid,$gender)
    {
		$this->otherdb->where('SEATID',$seatid)
						->where('GENDER',$gender)
						->update('tbl_seat', $updateseat);
        
        return $this->otherdb->affected_rows();
    }
	
	function updatreallotstatus($updatereallot,$regno,$gender)
    {
		$this->otherdb->where('REGNO',$regno)
						->where('GENDER',$gender)
        				->update('tbl_reallotment', $updatereallot);
        
        return $this->otherdb->affected_rows();
    }
	
	function UpdatedregnoinUser($updateregno, $emailid)
    {
		$this->otherdb->where('userId',$emailid)->update('TBL_USERS', $updateregno);
        
        return $this->otherdb->affected_rows();
    }
	
	function InsertDefaultInfoToREAllotment($defaultInfo)
    {
	
        $this->otherdb->insert('TBL_REALLOTMENT', $defaultInfo);
    
        return $this->otherdb->insert_id();
    }
	
	function GetAllotVerifyById($reallotmentid)
    {
		return $this->otherdb->select('ADMIN_VERIFY')
					->where('REALLOTMENT_ID',$reallotmentid)
					->get('TBL_REALLOTMENT')
					->result();
    }
	
	function getstudentemail($gender,$studentname)
    {
        return $this->otherdb->select('TBL_USERS.EMAIL,STUDENTNAME,TBL_USERS.PASSWORD')
			        ->from('TBL_REALLOTMENT')
					->join('TBL_USERS', 'TBL_USERS.NAME = TBL_REALLOTMENT.STUDENTNAME','INNER')
					->where('TBL_REALLOTMENT.GENDER',$gender)
					->where('TBL_REALLOTMENT.STUDENTNAME',$studentname)
					->where('TBL_REALLOTMENT.ADMIN_VERIFY',1)
			        ->get()        
			        ->result();
    }
	
	function editreAllotmentHis($data, $id)
    {
		$this->otherdb->where('ALLOTMENTHISTORY_ID',$id)->update('TBL_ALLOTMENTHISTORY', $data);
        
        return $this->otherdb->affected_rows();
    }
	
    function editreAllotment($data, $id)
    {
		$this->otherdb->where('REALLOTMENT_ID',$id)->update('TBL_REALLOTMENT', $data);
        
        return $this->otherdb->affected_rows();
    }
	
	function UpdatereAllotmentEmail($UpdateEmail, $emailid)
    {
		$this->otherdb->where('userId',$emailid)->update('tbl_users', $UpdateEmail);
        
        return $this->otherdb->affected_rows();
    }
    
    function UpdatedSeatStatus($updateseatstatus,$seatid)
    {
		$this->otherdb->where('SEATID',$seatid)->update('TBL_SEAT', $updateseatstatus);
        
        return $this->otherdb->affected_rows();
    }
	
	 function UpdatedSeatAlloted($updateseatstatus,$lastallotedseatid)
    {
		$this->otherdb->where('SEATID',$lastallotedseatid)->update('TBL_SEAT', $updateseatstatus);
        
        return $this->otherdb->affected_rows();
    }
	
	 function UpdatedSeatAllotedNew($updatenewseatstatus,$seatavilabel)
    {
		$this->otherdb->where('SEATID',$seatavilabel)->update('TBL_SEAT', $updatenewseatstatus);
        
        return $this->otherdb->affected_rows();
    }
	
	function DelFromBlacklist($gender,$regno)
    {
		$this->otherdb->where('REGNO', $regno)->where('GENDER', $gender)->delete('TBL_BLACKLIST');
        
        return $this->otherdb->affected_rows();
    }   
    
	
	function DeleteRecordFromAllotReallot($regno)
    {
		$this->otherdb->where('REGNO', $regno)->delete('TBL_ALLOTREALLOT');
        
        return $this->otherdb->affected_rows();
    }
	
	function getroombyHostelId($hostelid)
    {
		return $this->otherdb->select('ROOMID')
					->where('HOSTELID', $hostelid)
			        ->get('TBL_ROOM')
					->result();
       
    }
	
	function seatexisted($lastallotedseatid)
    {
		return $this->otherdb->select('SEATID')
					->where('SEATID', $lastallotedseatid)
			        ->get('TBL_ALLOTMENT')		
					->result();       
    }
	
	function lastseatid()
    {
		return $this->otherdb->select('SEATID')
					->order_by('REALLOTMENT_ID', 'DESC')
					->limit(1)
			        ->get('TBL_REALLOTMENT')
					->result();
       
    }  
	
	function getAllmissemail($regno, $gender)
    {
		if($gender == 'Female')
		{
			return $this->otherdb->where('REGNO', $regno)
						->where('GENDER', $gender)
						->order_by('tbl_application.STUDENTID', 'desc')
						->limit('1')
						->get('tbl_application')
						->result();
			
		}
		elseif($gender == 'Male')
		 {
			return $this->otherdb->where('REGNO', $regno)
						->where('GENDER', $gender)
						->order_by('tbl_maleapplication.STUDENTID', 'desc')
						->limit('1')
						->get('tbl_maleapplication')
						->result();
		 }
    }
	
	function getAllotmentEmail($sname,$regno, $gender)
    {
        $result = $this->otherdb->select('email,userId')
						->where('TBL_USERS.regno', $regno)
						->where('TBL_USERS.gender', $gender)
						->order_by('TBL_USERS.userId', 'desc')
						->limit('1')
						->get('TBL_USERS')
	        			->result();
		if(empty($result))
		{
			return $this->otherdb->select('email,userId')
						->like('TBL_USERS.name', $sname)
						->where('TBL_USERS.gender', $gender)
						->order_by('TBL_USERS.userId', 'desc')
						->limit('1')
						->get('TBL_USERS')				
						->result();
		}

		return $result;
		
    }
	
	function getReallotpicId($AllotID, $gender)
    {		
        return $this->otherdb->select('ALLOTMENTHISTORY_ID,REGNO')
					->where('ALLOTMENTHISTORY_ID', $AllotID)
					->where('GENDER', $gender)
					->order_by('ALLOTMENTHISTORY_ID', 'ASC')
					->limit(1)
					->get('TBL_ALLOTMENTHISTORY')        
			        ->result();
    }
	
	function GetArrivalinfo($regno, $gender)
    {		
        return $this->otherdb->select('ARRIVALDATE')
					->where('REGNO', $regno)
					->where('GENDER', $gender)
					->order_by('ALLOTMENTHISTORY_ID', 'ASC')
					->limit(1)
					->get('TBL_ALLOTMENTHISTORY')        
			        ->result();
    }
	
	function getReallotpic($idhispic, $gender)
    {		
        return $this->otherdb->select('ALLOTMENTHISTORY_ID, ARRIVALDATE')
					->where('REGNO', $idhispic)
					->where('GENDER', $gender)
					->order_by('ALLOTMENTHISTORY_ID', 'ASC')
					->limit(1)
					->get('TBL_ALLOTMENTHISTORY')        
			        ->result();
    }
	
	function GetReallotFee($AllotID, $gender)
    {		
		return $this->otherdb->where('REALLOTMENT_ID', $AllotID)
					->where('GENDER', $gender)
					->get('TBL_REALLOTMENT')        
			        ->result();
    }
    
	function getAllotmentInfobyId($AllotID, $gender)
    {
		return $this->otherdb->select('TBL_REALLOTMENT.*,TBL_HOSTEL.HOSTEL_NO,TBL_HOSTEL.HOSTELDESC,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE,TBL_SEAT.SEATID,TBL_SEAT.SEAT')
					->from('TBL_REALLOTMENT')
					->where('TBL_REALLOTMENT.REALLOTMENT_ID', $AllotID)
					->where('TBL_REALLOTMENT.GENDER', $gender)
					->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_REALLOTMENT.HOSTELID','INNER')
					->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_REALLOTMENT.ROOMID','INNER')
					->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_REALLOTMENT.SEATID','INNER')
					->get()
					->result();
    }
	
	 function VerifyUserRecordExisted($regno, $gender)    
	{
		$query = $this->otherdb->where('REGNO', $regno)
					->where('GENDER', $gender)
					->get('TBL_REALLOTMENT');

		return ($query->num_rows() > 0) ? true : false;     
    }
	
	function VerifyUserRecordBlackList($regno, $gender)
    {
		$query = $this->otherdb->where('REGNO', $regno)
					->where('GENDER', $gender)
					->get('TBL_BLACKLIST');

		return ($query->num_rows() > 0) ? true : false;	 
    }
	
	function getHostelInfo($gender)
    {
		return $this->otherdb->where('GENDER',$gender)->get('TBL_HOSTEL')->result();
    }
	
	function VerifyUserRecordInRenewal($regno, $gender)
    {
		return $this->otherdb->select('REALLOTMENT_ID')
					->where('TBL_REALLOTMENT.REGNO', $regno)
					->where('TBL_REALLOTMENT.GENDER', $gender)
					->order_by('REALLOTMENT_ID','DESC')
					->limit('1')
			        ->get('TBL_REALLOTMENT')		 
					->result();		 
		
	}
    
    
	function VerifyUserRecordById($regno, $gender)
    {
		$result = $this->otherdb->select('TBL_ALLOTMENTHISTORY.*,EMAIL,mobile, TBL_HOSTEL.HOSTEL_NO, TBL_ROOM.ROOMDESC, TBL_ROOM.ROOMTYPE, TBL_SEAT.SEAT')
						->join('TBL_USERS', 'TBL_USERS.USERID = TBL_ALLOTMENTHISTORY.EMAILID','INNER')
						->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENTHISTORY.HOSTELID','INNER')
						->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENTHISTORY.ROOMID','INNER')
						->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENTHISTORY.SEATID','INNER')
				        ->from('TBL_ALLOTMENTHISTORY')
						->where('TBL_ALLOTMENTHISTORY.REGNO', $regno)
						->where('TBL_ALLOTMENTHISTORY.GENDER', $gender)
						->order_by('ALLOTMENTHISTORY_ID','DESC')
						->limit('1')
				        ->get()		 
						->result();
		
		if(empty($result))
		{
			$result = $this->db->select('TBL_HSTUDENTS.*,TBL_HSTUDENTS.DEPNAME AS DEPARTNAME')
								->where('REGNO', $regno)
								->get('TBL_HSTUDENTS')
								->result(); 
			 
		} 

		return $result;			 
    }
	
	function VerifyUserRecordByOracleDb($regno, $gender)
    {
		 return $this->db->where('REGNO', $regno)->get('TBL_HSTUDENTS')->result();	
    }
	
	function GetOldList($gender, $semester)
	{
		return $this->otherdb->query('SELECT distinct `REGNO` FROM `TBL_ALLOTMENTHISTORY` WHERE SEMCODE != '."'".$semester."'".' AND REGNO NOT IN ( SELECT distinct `REGNO` FROM `TBL_REALLOTMENT` )')->result();
	}
	
	function GetDefaulterList($gender,$regno)
    {
		return $this->otherdb->where('GENDER',$gender)
					->where('REGNO',$regno)
			        ->get('TBL_ALLOTMENTHISTORY')        
			        ->result();
    }
	
	function DefaultExist($regno,$semcode, $gender)
    {
		return $this->otherdb->where('GENDER',$gender)
					->where('REGNO',$regno)
					->where('SEMCODE',$semcode)
			        ->get('TBL_DEFAULT')        
			        ->result();
    }
	
	function GetHistorydate($regno, $gender)
    {
        return $this->otherdb->select('ALLOTEDDATE')
					->where('REGNO',$regno)
					->where('GENDER',$gender)
					->order_by('ALLOTMENTHISTORY_ID','ASC')
					->limit('1')
			        ->get('TBL_ALLOTMENTHISTORY')        
			        ->result();
    }

   function existReallotmentHistory($regno, $semcode, $status){



   		$query = $this->otherdb->where('REGNO',$regno)
					->where('SEMCODE',$semcode)
					->where('STATUS',$status)
			        ->get('TBL_ALLOTMENTHISTORY');   	
			        
		return ($query->num_rows() > 0) ? true : false;	 
   }
	
	
	function DelAllDefault($gender,$allotid,$adminverify)
    {
		$this->otherdb->where('GENDER', $gender)
					->where('ALLOTMENTHISTORY_ID', $allotid)
					->where('ADMIN_VERIFY', $adminverify)
			        ->delete('TBL_ALLOTMENTHISTORY');
        
        return $this->otherdb->affected_rows();
    }


	function delDefaultListExist($gender)
    {
		$this->otherdb->where('GENDER', $gender)->delete('TBL_DEFAULT');
        
        return $this->otherdb->affected_rows();
    }
	
	function GetregnobyDefualtId($AllotID, $gender)
    {
		return $this->otherdb->where('GENDER',$gender)
						->where('DEFAULT_ID',$AllotID)
						->get('TBL_DEFAULT')
						->result();
    }	
	
	function GetEmailbyDefualtId($emailid, $gender)
    {
        return $this->otherdb->select('email,name,userId')
					->where('GENDER',$gender)
					->where('userId',$emailid)
			        ->get('TBL_USERS')        
			        ->result();
    }	
	
	function GetSeatExistbyregno($hostelid, $roomid, $seatid)
    {
        $result = $this->otherdb->select('HOSTELID,ROOMID,SEATID,EMAILID')
						->where('HOSTELID',$hostelid)
						->where('ROOMID',$roomid)
						->where('SEATID',$seatid)
				        ->get('TBL_ALLOTMENT')        
				        ->result();

		if(empty($result))
		{
			$result = $this->otherdb->select('HOSTELID,ROOMID,SEATID,EMAILID')
							->where('HOSTELID',$hostelid)
							->where('ROOMID',$roomid)
							->where('SEATID',$seatid)
							->get('TBL_REALLOTMENT')
							->result();				
			return $result;
		}
		return $result;
    }			

	
	function InsertAllotInfoToDefault($defaultInfo)
    {
	
        $this->otherdb->insert('TBL_DEFAULT', $defaultInfo);
    
        return $this->otherdb->insert_id();
        
    }
	
	function DelFromDefault($gender,$defaultid)
    {
		$this->otherdb->where('GENDER', $gender)
						->where('DEFAULT_ID', $defaultid)
        				->delete('TBL_DEFAULT');
        
        return $this->otherdb->affected_rows();
    }
	
	function DelFromAllotReallot($gender,$regno)
    {
		$this->otherdb->where('GENDER', $gender)
						->where('REGNO', $regno)
						->delete('TBL_ALLOTREALLOT');
        
        return $this->otherdb->affected_rows();
    }
	
	function geAllotSeat($gender, $AllotID)
    {
        return $this->otherdb->select('TBL_ALLOTREALLOT.*,TBL_HOSTEL.HOSTEL_NO,TBL_HOSTEL.HOSTELDESC,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE,TBL_SEAT.SEAT,TBL_SEAT.SEATID')
			        ->from('TBL_ALLOTREALLOT')
					->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTREALLOT.SEATID','INNER')
					->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTREALLOT.HOSTELID','INNER')
					->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTREALLOT.ROOMID','INNER')
					->where('TBL_ALLOTREALLOT.GENDER',$gender)
					->where('TBL_ALLOTREALLOT.ID',$AllotID)
			        ->get()        
			        ->result();
    }
	
	function geEmail($gender, $regno, $emailid)
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
	
	function UpdatedSeatDeafult($updateseat, $hostelid, $roomid, $seatid, $gender)
    {
		$this->otherdb->where('HOSTELID',$hostelid)
					->where('ROOMID',$roomid)
					->where('SEATID',$seatid)
					->where('GENDER',$gender)
			        ->update('TBL_SEAT',$updateseat);
        
        return $this->otherdb->affected_rows();
    }


	function ViewAllDefault($gender)
    {
        return $this->otherdb->select('TBL_DEFAULT.*,TBL_HOSTEL.HOSTEL_NO,TBL_HOSTEL.HOSTELDESC,TBL_ROOM.ROOMDESC,TBL_SEAT.SEAT')
			        ->from('TBL_DEFAULT')
					->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_DEFAULT.SEATID','INNER')
					->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_DEFAULT.HOSTELID','INNER')
					->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_DEFAULT.ROOMID','INNER')
					->where('TBL_DEFAULT.GENDER',$gender)
			        ->get()        
			        ->result();
    }
	
	function GetAllallotinfo($hostelid, $roomid, $seatid)
    {
        return $this->otherdb->select('TBL_DEFAULT.*,TBL_HOSTEL.HOSTELID,TBL_HOSTEL.HOSTEL_NO,TBL_HOSTEL.HOSTELDESC,TBL_ROOM.ROOMID,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE,TBL_SEAT.SEAT')
        			->from('TBL_DEFAULT')
					->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_DEFAULT.SEATID','INNER')
					->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_DEFAULT.HOSTELID','INNER')
					->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_DEFAULT.ROOMID','INNER')
					->where('TBL_DEFAULT.HOSTELID',$hostelid)
					->where('TBL_DEFAULT.ROOMID',$roomid)
					->where('TBL_DEFAULT.SEATID',$seatid)
			        ->get()        
			        ->result();
    }
	
	function GetseatInfos($gender,$AllotID,$hostelid,$roomid,$seatid)
    {
		return $this->otherdb->where('GENDER',$gender)
					->where('HOSTELID',$hostelid)
					->where('ROOMID',$roomid)
					->where('SEATID',$seatid)
			        ->get('TBL_REALLOTMENT')        
			        ->result();
    }
	
	function GetseatagainstDefault($gender,$AllotID)
    {
		return $this->otherdb->where('GENDER',$gender)
					->where('DEFAULT_ID',$AllotID)
					->get('TBL_DEFAULT')
					->result();
    }
	
	function GetfathernametDefault($gender,$regno)
    {
        return $this->otherdb->select('FATHERNAME')
					->where('GENDER',$gender)
					->where('REGNO',$regno)
					->order_by('ALLOTMENTHISTORY_ID','desc')
					->limit('1')
			        ->get('TBL_ALLOTMENTHISTORY')        
			        ->result();
    }
	
	function getKey($regno, $semcode)
    {
        return $this->otherdb->select('KEY')
					->where('REGNO',$regno)
					->where('SEMCODE',$semcode)
					->order_by('ID', 'desc')
					->limit('1')
			        ->get('TBL_KEY')
			        ->row();
    }
}


  