<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(E_ALL);
class Allotment_model extends CI_Model
{
    
    public function __construct(){

		$this->otherdb = $this->load->database('otherdb', TRUE);
		
	}	

   	function getHostelInfo($gender)
    {
		
        return $this->otherdb->where('GENDER',$gender)
        			->order_by('HOSTEL_NO','asc')
        			->get('TBL_HOSTEL')
        			->result();
    }


    function viewallotmentInfoByRegNo($regno,$gender)
    {

    	$this->otherdb->select('TBL_ALLOTMENT.*,TBL_SEAT.SEAT,TBL_HOSTEL.HOSTEL_NO,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE')
		    ->from('TBL_ALLOTMENT')
			->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER')
			->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER')
			->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER');		

		if(!empty($regno)){
			$this->otherdb->where('TBL_ALLOTMENT.REGNO',$regno);			
		}

		if(!empty($gender)){
			$this->otherdb->where('TBL_ALLOTMENT.GENDER',$gender);			
		}

	    return $this->otherdb->get()->result();
	
	}
	
	function getSemesterInfo($gender)
    {
		
		return $this->otherdb->where('GENDER',$gender)
					//->where('IS_ACTIVE','1')					
					->limit('1')
					->order_by('SMCODE', 'DESC')					
			        ->get('TBL_SEMESTER')
			        ->row();
    }
	
	function CheckEmailExist($email)
	{
		
		$row = $this->otherdb->where('email',$email)->get('TBL_USERS')->num_rows();

		return ($row > 0) ? true : false;
	}
	
    
	function mail_exists($email)
	{
		$query = $this->db->where('EMAIL',$email)->get('TBL_USERS');		

		return ($query->num_rows() > 0) ? true : false;
	}
	
	function Updatepassword($updatepassword, $emailid)
    {
        
		$this->otherdb->where('userId',$emailid)->update('TBL_USERS', $updatepassword);
        
        return $this->otherdb->affected_rows();
    }
	
	function GenrateCancelList($gender)
	{
		
        return $this->otherdb->select('ADMIN_VERIFY')
        			->where('GENDER',$gender)
        			->where('ADMIN_VERIFY',2)
        			->get('TBL_ALLOTMENT')
        			->result();
	}
	
	function GenrateDefaulterList($gender)
    {
		
        return $this->otherdb->where('GENDER',$gender)
			        ->where('ADMIN_VERIFY',2)
			        ->get('TBL_ALLOTMENT')
			        ->result();
        
    }	
	
	
	function GetseatagainstDefault($gender,$AllotID)
    {
		
        return $this->otherdb->where('GENDER',$gender)
						        ->where('ALLOTMENT_ID',$AllotID)
						        ->get('TBL_DEFAULT')
						        ->result();        
    }

	function GetseatInfos($gender,$AllotID,$hostelid,$roomid,$seatid)
    {
		
        return $this->otherdb->where('GENDER',$gender)
        			->where('ALLOTMENT_ID',$AllotID)
        			->where('HOSTELID',$hostelid)
        			->where('ROOMID',$roomid)
        			->where('SEATID',$seatid)
        			->get('TBL_ALLOTMENT')
        			->result();
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
	
    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
	function addHisAllotment($hisallotmentInfo)
    {
  
        $this->otherdb->insert('TBL_ALLOTMENTHISTORY', $hisallotmentInfo);
    
        return $this->otherdb->insert_id();
    }
	
	function CreateNewUser($studentusercreate)
    {
        
		$this->otherdb->trans_start();
		
        $this->otherdb->insert('TBL_USERS', $studentusercreate);
    
        $this->otherdb->trans_complete();
		
		return $this->otherdb->select('userId')
					->ORDER_BY('userId DESC LIMIT 1')
					->get('TBL_USERS')
					->result();
        
    }
	 
    function addNewAllotment($allotmentInfo)
    {
        
        $this->otherdb->insert('TBL_ALLOTMENT', $allotmentInfo);
    
        return $this->otherdb->insert_id();
    }
	
	function addNewAllotmentKey($randKeyInfo)
    {        
		
        $this->otherdb->insert('TBL_KEY', $randKeyInfo);
    
        return $this->otherdb->insert_id();
    }
	
	function InsertAllotInfoToDefault($defaultInfo)
    {
         
		
		//$this->otherdb->trans_start();
	
       	$this->otherdb->insert('TBL_DEFAULT', $defaultInfo);
    
        return $this->otherdb->insert_id();
    }
	
	function InsertAllotInfoToAllotment($defaultInfo)
    {
         
		
		//$this->otherdb->trans_start();
	
        $this->otherdb->insert('TBL_ALLOTMENT', $defaultInfo);
    
        return $this->otherdb->insert_id();
    }
	
	function addNewItems($itemInfo)
    {
        //$this->db->trans_start();
		// the TRUE paramater tells CI that you'd like to return the database object.	
		 
		
        $this->otherdb->insert('TBL_ROOMITEM', $itemInfo);
    
        return $this->otherdb->insert_id();
    }
	
	function seat_exists_against_Regno($regno)
	{
		
		$query = $this->otherdb->where('REGNO',$regno)->get('TBL_ALLOTMENT');

		return ($query->num_rows() > 0) ? true : false;
	}
    
    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */

     function viewallotmentInfo($gender,$hostelno,$roomno)
    {

    	$this->otherdb->select('TBL_ALLOTMENT.*,TBL_SEAT.SEAT,TBL_SEAT.OCCUPIED,TBL_HOSTEL.HOSTEL_NO,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE')
		    ->from('TBL_ALLOTMENT')
			->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER')
			->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER')
			->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER');

		if(!empty($gender)){
			$this->otherdb->where('TBL_ALLOTMENT.GENDER',$gender);			
		}

		if(!empty($hostelno)){			
			$this->otherdb->where('TBL_HOSTEL.HOSTELID',$hostelno);
		}

		if(!empty($roomno)){

			$this->otherdb->where('TBL_ROOM.ROOMID',$roomno);
		}

	    return $this->otherdb->get()->result();
	
	}



 //    function viewallotmentInfo($gender,$hostelno,$roomno)
 //    {
	// 	if(!empty($gender) && empty($hostelno) && empty($roomno))
	// 	{
		
	//         $this->otherdb->select('TBL_ALLOTMENT.*,TBL_SEAT.SEAT,TBL_HOSTEL.HOSTEL_NO,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE');
	//         $this->otherdb->from('TBL_ALLOTMENT');
	// 		$this->otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER');
	// 		$this->otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER');
	// 		$this->otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER');
	// 		$this->otherdb->where('TBL_ALLOTMENT.GENDER',$gender);

	//         return $this->otherdb->get()->result();	        
		
	//     }
		
	// 	elseif(!empty($gender) && !empty($hostelno) && !empty($roomno))
	// 	{
		
	//         $this->otherdb->select('TBL_ALLOTMENT.*,TBL_SEAT.SEAT,TBL_HOSTEL.HOSTEL_NO,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE');
	//         $this->otherdb->from('TBL_ALLOTMENT');
	// 		$this->otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER');
	// 		$this->otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER');
	// 		$this->otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER');
	// 		$this->otherdb->where('TBL_ALLOTMENT.GENDER',$gender);
	// 		$this->otherdb->where('TBL_HOSTEL.HOSTELID',$hostelno);
	// 		$this->otherdb->where('TBL_ROOM.ROOMID',$roomno);

	//         return $this->otherdb->get()->result();
	        
	//     }
	// 	elseif (!empty($gender) && !empty($hostelno) && empty($roomno))	{
		
	//         $this->otherdb->select('TBL_ALLOTMENT.*,TBL_SEAT.SEAT,TBL_HOSTEL.HOSTEL_NO,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE');
	//         $this->otherdb->from('TBL_ALLOTMENT');
	// 		$this->otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER');
	// 		$this->otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER');
	// 		$this->otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER');
	// 		$this->otherdb->where('TBL_ALLOTMENT.GENDER',$gender);
	// 		$this->otherdb->where('TBL_HOSTEL.HOSTELID',$hostelno);

	//         return $this->otherdb->get()->result();
	        
	//     }
	
	// }
	
	function getAllHostelInfo($gender)
    {
		
        return $this->otherdb->where('GENDER',$gender)
			        ->order_by('HOSTEL_NO','asc')
			        ->get('TBL_HOSTEL')
			        ->result();        
    }
	
	function getAllRoomInfo($hostelid, $gender)
    {
		
        return $this->otherdb->select('ROOMID,ROOMDESC')
        			->where('HOSTELID',$hostelid)
        			->where('GENDER',$gender)
        			->order_by('ROOMDESC','asc')
        			->get('TBL_ROOM')
        			->result();        
        
    }
	
	function getAllSeatInfo($roomid, $gender)
    {
		
        return $this->otherdb->select('SEATID,SEAT')
        			->where('ROOMID',$roomid)
        			->where('GENDER',$gender)
        			->get('TBL_SEAT')
        			->result();
        
    }
	
	function gethostelNameById($hostelId)
    {
		
        return $this->otherdb->where('HOSTELID',$hostelId)->get('TBL_HOSTEL')->result();
        
    }
	
	function GetSumFeechallanInfo($regno)
    {
		
        return $this->otherdb->select_sum('FEEAMOUNT')
        			->select('CHALLANNO')
        			->where('REGNO',$regno)
        			->group_by('ID', 'asc')
        			->limit('3')
        			->get('paychallandetail')
        			->result();
		//$this->otherdb->where('FEECODE','17');
        
    }
	
	function GetFeechallanInfo($regno)
    {
		
        return $this->otherdb->select_sum('FEEAMOUNT')
        			->where('REGNO',$regno)
        			->order_by('ID', 'Desc')
        			->limit('2')
        			->get('paychallandetail')
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
	
	function getAllotmentInfobyId($AllotID, $gender)
    {
		
        return $this->otherdb->select('TBL_ALLOTMENT.*,TBL_HOSTEL.HOSTEL_NO,TBL_HOSTEL.HOSTELDESC,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE,TBL_SEAT.SEATID,TBL_SEAT.SEAT')
			        ->from('TBL_ALLOTMENT')
					->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER')
					->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER')
					->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER')
					->where('TBL_ALLOTMENT.GENDER', $gender)
					->where('TBL_ALLOTMENT.ALLOTMENT_ID', $AllotID)
					->get()
					->result();
        
    }
	
	function getAllotmentEmail($emailsId, $gender, $sname)
    {
		
		$result = $this->otherdb->select('email,userId')
						->where('TBL_USERS.userId', $emailsId)
						->where('TBL_USERS.gender', $gender)
						->get('TBL_USERS')
						->result(); 
		
		if(empty($result))
	   	{
		 
	        return $this->otherdb->select('TBL_APPLICATION.STUDENTEMAIL AS email')	        
						->where('TBL_APPLICATION.STUDENTNAME', $sname)
						->where('TBL_APPLICATION.GENDER', $gender)
						->get('TBL_APPLICATION')
						->result();	 
		
	   	} else {
			return $result;
		}		
        
    }
	
	function getkeyInfo($regno, $gender)
    {
		
		return $this->otherdb->where('GENDER',$gender)
					->where('REGNO',$regno)
					->get('TBL_KEY')
					->result();	
        
    }
	
	function getRoomInfo($hostelId, $gender)
    {
		
		return $this->otherdb->select('TBL_ROOM.*,TBL_HOSTEL.GENDER,TBL_HOSTEL.HOSTEL_NO')
			        ->from('TBL_ROOM')
					->where('TBL_HOSTEL.HOSTELID',$hostelId)
					->where('TBL_HOSTEL.GENDER',$gender)
					->join('TBL_HOSTEL', 'TBL_ROOM.HOSTELID = TBL_HOSTEL.HOSTELID','INNER')
					->order_by('ROOMDESC','ASC')		
			        ->get()
			        ->result();
    }
	
	function GetSeatByRIdHId($hostelId, $roomId, $gender)
    {
		
        
		return $this->otherdb->select('TBL_SEAT.*')
			        ->from('TBL_SEAT')
					->where('TBL_HOSTEL.HOSTELID',$hostelId)
					->where('TBL_ROOM.ROOMID',$roomId)
					->where('TBL_SEAT.GENDER',$gender)
					->where('TBL_SEAT.OCCUPIED',0)
					->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_SEAT.HOSTELID','INNER')
					->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_SEAT.ROOMID','INNER')		
			        ->get()
			        ->result();	
        
    }
	
	function GetESeatByRIdHId($hostelId, $roomId, $gender)
    {		
        
		return $this->otherdb->select('TBL_SEAT.*')
			        ->from('TBL_SEAT')
					->where('TBL_HOSTEL.HOSTELID',$hostelId)
					->where('TBL_ROOM.ROOMID',$roomId)
					->where('TBL_SEAT.GENDER',$gender)
					->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_SEAT.HOSTELID','INNER')
					->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_SEAT.ROOMID','INNER')
					->get()
					->result();	
        
    }
	
	function GetRoomIdByHno($hostelno, $roomno, $gender)
    {
		
		return $this->otherdb->select('ROOMID')
					->where('HOSTELID',$hostelno)
					->where('ROOMDESC',$roomno)
					->where('GENDER',$gender)
					->get('TBL_ROOM')
					->result();
    }
	
	function GetAllotVerifyById($allotmentid)
    {
		
		return $this->otherdb->select('ADMIN_VERIFY')
					->where('ALLOTMENT_ID',$allotmentid)
					->get('TBL_ALLOTMENT')
					->result();	
        
    }
	
	function GetGenderById($userId)
    {
		
		return $this->otherdb->select('GENDER')
					->where('userId',$userId)
					->get('TBL_USERS')
					->result();		
        
    }
	
	function getRoomInfobyId($hostelId, $roomId, $gender)
    {
		
        return $this->otherdb->where('ROOMID',$roomId)
			        ->where('HOSTELID',$hostelId)
			        ->where('GENDER',$gender)
			        ->get('TBL_ROOM')
			        ->result();
        
    }
	
	function GetAllotEmailIds($emailid)
    {
		
        $this->otherdb->select('count(EMAILID) as EMAILID')
				        ->from('tbl_allotment')
				        ->where('EMAILID',$emailid);

        return $this->otherdb->get()->result();
        
    }
	
	function GetExistEmail($emailid)
    {
		
        return $this->otherdb->where('userId',$emailid)->get('tbl_users')->result();
        
    }
	
	function Getemailinfo($email)
    {
		
        return $this->otherdb->where('email',$email)->get('tbl_users')->result();
        
    }
	
	function GetAllotFromAllotHis($allotmentid)
    {
		
        $this->otherdb->select('ALLOTMENTHISTORY_ID')
				        ->from('tbl_allotmenthistory')
						->where('ALLOTMENTHISTORY_ID',$allotmentid);

        return $this->otherdb->get()->result();
        
    }
    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function editAllotment($allotmentInfo, $allotmentid)
    {
        
		$this->otherdb->where('ALLOTMENT_ID',$allotmentid)->update('TBL_ALLOTMENT', $allotmentInfo);
        
        return $this->otherdb->affected_rows();
    }
	
	function editAllotmentHis($updateHInfo, $allotmentid)
    {
        
		$this->otherdb->where('ALLOTMENTHISTORY_ID',$allotmentid)
					->update('TBL_ALLOTMENTHISTORY', $updateHInfo);
        
        return $this->otherdb->affected_rows();
    }
	
	function UpdatestudMail($Updatestudentemail, $emailid)
    {
        
		$this->otherdb->where('userId',$emailid)->update('tbl_users', $Updatestudentemail);
        
        return $this->otherdb->affected_rows();
    }
	
	function VerifyUserRecordExisted($regno, $gender)    
	{
        
		$rows = $this->otherdb->where('REGNO', $regno)
					->where('GENDER', $gender)
					->get('TBL_ALLOTMENT')
					->num_rows();

		return ($rows > 0) ? true : false;
     
    }
	
	function VerifyUserRecordExistedReallot($regno, $gender)    
	{
        
		$rows = $this->otherdb->where('REGNO', $regno)
							->where('GENDER', $gender)
							->get('TBL_REALLOTMENT')
							->num_rows();

		return ($rows > 0) ? true : false;
     
    }
	
	function VerifyUserRecordExistedBlacklist($regno, $gender)
	{
        
		$rows = $this->otherdb->where('REGNO', $regno)
								->where('GENDER', $gender)
								->get('TBL_BLACKLIST')
								->num_rows();

		return ($rows > 0) ? true : false;
     
    }
	
	function VerifyUserRecordExistedAllotReallot($regno, $gender)
	{
        
		$rows = $this->otherdb->where('REGNO', $regno)
								->where('GENDER', $gender)
								->get('TBL_ALLOTREALLOT')
								->num_rows();

		return ($rows > 0) ? true : false;
     
    }
	
	function UpdateseatInfo($updateseatstatus, $seatavilabel)
    {
        
		$this->otherdb->where('SEATID',$seatavilabel)->update('TBL_SEAT', $updateseatstatus);
        
        return $this->otherdb->affected_rows();
    }
    
    function UpdatedSeatStatus($updateseatstatus,$oldhostel,$oldroom,$oldseat)
    {
        
		$this->otherdb->where('HOSTELID',$oldhostel)
						->where('ROOMID',$oldroom)
						->where('SEATID',$oldseat)
				        ->update('TBL_SEAT', $updateseatstatus);
        
        return $this->otherdb->affected_rows();
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
	
    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteAllotment($allotmentid)
    {
        
		$this->otherdb->where('ALLOTMENT_ID', $allotmentid)->delete('TBL_ALLOTMENT');
        
        return $this->otherdb->affected_rows();
    }
	
	function DelAllDefault($gender,$allotid,$adminverify)
    {
        
		$this->otherdb->where('GENDER', $gender)
						->where('ALLOTMENT_ID', $allotid)
						->where('ADMIN_VERIFY', $adminverify)
				        ->delete('TBL_ALLOTMENT');
        
        return $this->otherdb->affected_rows();
    }
	
	function DelFromDefault($gender,$allotid)
    {
        
		$this->otherdb->where('GENDER', $gender)
						->where('ALLOTMENT_ID', $allotid)
						->delete('TBL_DEFAULT');
        
        return $this->otherdb->affected_rows();
    }
	
	function getroombyHostelId($hostelid)
    {
        
		return $this->otherdb->select('ROOMID')
					->where('HOSTELID', $hostelid)
					->get('TBL_ROOM')
					->result();
       
    }

	function VerifyUserRecordById($regno, $gender)
    {    	
        if($gender == 'Male')
		{
			
			$result1 = $this->otherdb->where('REGNO', $regno)
							->where('GENDER', $gender)
							->get('TBL_MALEAPPLICATION')
							->result();
			
			$result2 = $this->db->where('REGNO', $regno)
								->where('GENDER', 'M')
								->get('TBL_HSTUDENTS')
								->result(); 
	
			return array_merge($result1,$result2);			
		}
		
		elseif($gender == 'Female')
		{
			
			$result1 = $this->otherdb->where('REGNO', $regno)
							->where('GENDER', $gender)
							->get('TBL_APPLICATION')
							->result();			
				  
		    $result2 = $this->db->where('REGNO', $regno)
						    ->where('GENDER', 'F')
						    ->get('TBL_HSTUDENTS')
						    ->result();	      
			
			return array_merge($result1,$result2); 			
			  
		}
	    
    }
    
    function getstudentemail($gender,$emailid)
    {
		
        $this->otherdb->select('TBL_USERS.EMAIL,TBL_ALLOTMENT.STUDENTNAME,TBL_USERS.PASSWORD')
				        ->from('TBL_ALLOTMENT')
						->join('TBL_USERS', 'TBL_USERS.userId = TBL_ALLOTMENT.EMAILID','INNER')
						->where('TBL_ALLOTMENT.GENDER',$gender)
						->where('TBL_USERS.userId',$emailid)
						->where('TBL_ALLOTMENT.ADMIN_VERIFY',1);

        return $this->otherdb->get()->result();
        
    }
    
	
}


  