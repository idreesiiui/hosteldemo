<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Seat_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */

    public function __construct(){

		$this->otherdb = $this->load->database('otherdb', TRUE);
		
	}

	//need to be check	
	
	function GetGenderById($userId)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('userId',$userId);
		$otherdb->select('GENDER');
        $otherdb->from('TBL_USERS');
		
        $query =  $otherdb->get();
		
        return $query->result();
    }   
  
    //need to be check
    function getUserRoles()
    {
        $this->db->select('ROLEID, ROLE');
        $this->db->from('TBL_ROLES');
        $this->db->where('ROLEID !=', 1);
        $query = $this->db->get();
        
        return $query->result();
    }

    public function getAllSeats($gender){
    	$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('TBL_SEAT.*,TBL_HOSTEL.HOSTEL_NO,TBL_HOSTEL.HOSTELDESC,TBL_ROOM.ROOMDESC');
		$otherdb->from('TBL_SEAT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_SEAT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_SEAT.ROOMID','INNER');
		$otherdb->where('TBL_SEAT.OCCUPIED', 1);
		$otherdb->where_in('TBL_HOSTEL.HOSTELID', array(13,14,15,16,17,18,19,20,21,22,23,24));

		$otherdb->where('TBL_HOSTEL.GENDER', $gender);
		$otherdb->order_by('TBL_ROOM.ROOMDESC', 'asc');
		$query = $otherdb->get();
		
		return $query->result();
    }

    function getseatstatus($SEATID, $gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		
        $otherdb->select('REGNO, STUDENTNAME');
        $otherdb->from('TBL_ALLOTMENT');
		$otherdb->where('SEATID',$SEATID);
		$otherdb->where('GENDER',$gender);
		$otherdb->where('ADMIN_VERIFY !=',2);
        $query =  $otherdb->get();
        
        $result = $query->result();
		
		if(empty($result))
		   {
			    $otherdb->select('REGNO, STUDENTNAME');
				$otherdb->from('TBL_REALLOTMENT');
				$otherdb->where('SEATID',$SEATID);
				$otherdb->where('GENDER',$gender);
				$otherdb->where('ADMIN_VERIFY !=',2);
				$query =  $otherdb->get();
				
				$result = $query->result();
				return $result;
		   }
		 elseif(empty($result))
		   {
			    $otherdb->select('REGNO, STUDENTNAME');
				$otherdb->from('TBL_ALLOTREALLOT');
				$otherdb->where('SEATID',$SEATID);
				$otherdb->where('GENDER',$gender);
				$otherdb->where('ADMIN_VERIFY !=',2);
				$query =  $otherdb->get();
				
				$result = $query->result();
				return $result;
		   }
		 else{
			   return $result;
		 }
    }

    // public function SeatAccupiedByAllotOrRealot($seatId, $hostelID){

    // }


	
	function viewvacantSeat($gender, $hostelno)
    {
        if($hostelno == 'All')
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('TBL_SEAT.*,TBL_HOSTEL.HOSTEL_NO,TBL_HOSTEL.HOSTELDESC,TBL_ROOM.ROOMDESC');
			$otherdb->from('TBL_SEAT');
			$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_SEAT.HOSTELID','INNER');
			$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_SEAT.ROOMID','INNER');
			$otherdb->where('OCCUPIED', 0);
			$otherdb->where('TBL_HOSTEL.GENDER', $gender);
			$otherdb->order_by('TBL_ROOM.ROOMDESC', 'asc');
			$query = $otherdb->get();
			
			return $query->result();
		}
		elseif($hostelno != 'All')
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('TBL_SEAT.*,TBL_HOSTEL.HOSTEL_NO,TBL_HOSTEL.HOSTELDESC,TBL_ROOM.ROOMDESC');
			$otherdb->from('TBL_SEAT');
			$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_SEAT.HOSTELID','INNER');
			$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_SEAT.ROOMID','INNER');
			$otherdb->where('OCCUPIED', 0);
			$otherdb->where('TBL_HOSTEL.GENDER', $gender);
			$otherdb->where('TBL_HOSTEL.HOSTELID', $hostelno);
			$otherdb->order_by('TBL_ROOM.ROOMDESC', 'asc');
			$query = $otherdb->get();
			
			return $query->result();
		}
    }

    //need to be check
    
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
    function addNewSeat($seatInfo)
    {
        //$this->db->trans_start();
		// the TRUE paramater tells CI that you'd like to return the database object.
		
		$otherdb = $this->load->database('otherdb', TRUE); 
		
       	$otherdb->insert('TBL_SEAT', $seatInfo);
    
       	return $otherdb->insert_id();
        
       // $this->db->trans_complete();
        
        //return $query;
    }
	
	function seat_exists_against_Hostelid_Roomid($hostelno,$roomtype,$seat,$gender)
	{
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('SEAT',$seat);
		$otherdb->where('HOSTELID',$hostelno);
		$otherdb->where('ROOMID',$roomtype);
		$otherdb->where('GENDER',$gender);
		$query = $otherdb->get('TBL_SEAT');
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
    function getHostelInfo($gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('*');
        $otherdb->from('TBL_HOSTEL');
		$otherdb->where('GENDER',$gender);
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

    function seatTypes()
    {
		$otherdb = $this->load->database('otherdb', TRUE);        

    	$otherdb->distinct('SEATDESC');
		$otherdb->select('SEATDESC');
       	$otherdb->from('tbl_seat');
       	$query =  $otherdb->get();
        
        return $query->result();
    }


    function gerRoomBySeatID($id)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('ROOMID,HOSTELID');
       	$otherdb->from('tbl_seat');
       	$otherdb->where('SEATID',$id);
       	$query =  $otherdb->get();
        
        return $query->result();
    }
	
	function getSeatInfo($hostelno,$roomid,$occupystatus,$gender,$seatType)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_SEAT.*,TBL_ROOM.ROOMDESC,TBL_HOSTEL.HOSTEL_NO,TBL_HOSTEL.HOSTELDESC');
        $otherdb->from('TBL_SEAT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_SEAT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_SEAT.ROOMID','INNER');

		if(!empty($seatType)){
			$otherdb->where('TBL_SEAT.SEATDESC',$seatType);
		}

		if(!empty($hostelno))
		{
			$otherdb->where('TBL_SEAT.HOSTELID',$hostelno);
		}

		if(!empty($roomid) || $roomid == '0'){
			$otherdb->where('TBL_SEAT.ROOMID',$roomid);
		}

		if(!empty($occupystatus) || $occupystatus == '1' || $occupystatus == '0'){
			$otherdb->where('TBL_SEAT.OCCUPIED',$occupystatus);
		}

		if(!empty($gender)){
			$otherdb->where('TBL_SEAT.GENDER',$gender);
		}

        $query = $otherdb->get();

        //echo $otherdb->last_query();

        //exit();
        
        return $query->result();
    }

    //need to be check
	
	function getSeatInfoByHostelroom($hostelno,$roomno,$gender)
    {
		if(!empty($roomno))
		   {
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('TBL_ROOM.ROOMID,TBL_HOSTEL.HOSTELID, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_ROOM.ROOMTYPE, TBL_SEAT.SEATDESC, TBL_SEAT.OCCUPIED, TBL_SEAT.SEATID, TBL_SEAT.SEAT, TBL_HOSTEL.HOSTELID AS HID');
				$otherdb->from('TBL_SEAT');
				$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_SEAT.HOSTELID','INNER');
				$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_SEAT.ROOMID','INNER');
				$otherdb->where('TBL_SEAT.HOSTELID',$hostelno);
				$otherdb->where('TBL_SEAT.ROOMID',$roomno);
				$otherdb->where('TBL_SEAT.GENDER',$gender);
				
				$query =  $otherdb->get();
				
				return $query->result();
		   }
		else
			{
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('TBL_ROOM.ROOMID, TBL_HOSTEL.HOSTELID, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_ROOM.ROOMTYPE, TBL_SEAT.SEATDESC, TBL_SEAT.OCCUPIED, TBL_SEAT.SEATID, TBL_SEAT.SEAT, TBL_HOSTEL.HOSTELID AS HID');
				$otherdb->from('TBL_SEAT');
				$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_SEAT.HOSTELID','INNER');
				$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_SEAT.ROOMID','INNER');
				$otherdb->where('TBL_SEAT.HOSTELID',$hostelno);
				$otherdb->where('TBL_SEAT.GENDER',$gender);
				
				$query =  $otherdb->get();
				
				return $query->result();
			}
    }
	
	
	
	function getSeatInfobyId($SEATID, $gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		
        $otherdb->select('TBL_SEAT.*,TBL_ROOM.ROOMID, TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE, TBL_HOSTEL.HOSTELDESC, TBL_HOSTEL.HOSTELID');
        $otherdb->from('TBL_SEAT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_SEAT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_SEAT.ROOMID','INNER');
		$otherdb->where('SEATID',$SEATID);
		$otherdb->where('TBL_SEAT.GENDER',$gender);
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

    // need to check
	
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
    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function editSeat($seatInfo,$seatId)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('SEATID',$seatId);
        $otherdb->update('TBL_SEAT', $seatInfo);
        
        return $otherdb->affected_rows();
    }
    
    
    
    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteseat($seatid)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('SEATID', $seatid);
        $otherdb->delete('TBL_SEAT');
        
        return $this->db->affected_rows();
    }
	
	function SeatAlloted($seatid)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('REGNO');
		$otherdb->from('TBL_ALLOTMENT');
		$otherdb->where('SEATID', $seatid);
        $query = $otherdb->get();
		$result = $query->row();
		
		if(empty($result)){
		    $otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('REGNO');
			$otherdb->from('TBL_REALLOTMENT');
			$otherdb->where('SEATID', $seatid);
			$query = $otherdb->get();
			$result = $query->row();
			
			if(empty($result)){
		    $otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('REGNO');
			$otherdb->from('TBL_ALLOTREALLOT');
			$otherdb->where('SEATID', $seatid);
			$otherdb->where('ADMIN_VERIFY', 0);
			$query = $otherdb->get();
			$result = $query->row();
			
		   }
			
		}
        return $result;
    }
	
	function getroombyHostelId($hostelid)
    {
		return $this->otherdb->where('HOSTELID', $hostelid)
					->order_by("ROOMDESC","ASC")
					->get('TBL_ROOM')
					->result();
       
    }
	
	function GetAllHostel($gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
		$otherdb->from('TBL_HOSTEL');
		$otherdb->where('GENDER', $gender);
		$otherdb->order_by("HOSTELID","ASC");
        $query = $otherdb->get();
		return $query->result();
       
    }
	
	function Updatevacantseatstatus($ustatus,$occupy)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('SEATID',$ustatus);
        $otherdb->update('TBL_SEAT', $occupy);
        
        return $otherdb->affected_rows();
       
    }       
    
}

  