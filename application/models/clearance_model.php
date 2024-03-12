<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Clearance_model extends CI_Model
{
    public function __construct(){

		$this->otherdb = $this->load->database('otherdb', TRUE);	
	}

	function mail_exists($email)
	{
		$query = $this->db->where('EMAIL',$email)->get('TBL_USERS');

		return ($query->num_rows() > 0) ? true : false;
	}
    
    function CheckRegnoInAllotReallot($regno,$hostelid,$roomid,$seatid)
	{
	    $result = $this->otherdb->select('REGNO')
					    ->where('HOSTELID',$hostelid)
					    ->where('ROOMID',$roomid)
					    ->where('SEATID',$seatid)
					    ->get('tbl_allotment')
					    ->result();

		if(empty($result)){

			$result = $this->otherdb->select('REGNO')
							->where('HOSTELID',$hostelid)
							->where('ROOMID',$roomid)
							->where('SEATID',$seatid)
							->get('tbl_reallotment')
							->result();
		}

		if(empty($result)){
			$result = $this->otherdb->select('REGNO')
							->where('HOSTELID',$hostelid)
							->where('ROOMID',$roomid)
							->where('SEATID',$seatid)
							->get('tbl_allotreallot')
							->result();
		}

		if(empty($result)){
			$result = $this->otherdb->select('REGNO')
							->where('HOSTELID',$hostelid)
							->where('ROOMID',$roomid)
							->where('SEATID',$seatid)
							->get('tbl_allotmenthistory')
							->result();
		}

		return $result;
	}
	 
    function addNewAttachment($attachInfo)
    {
        $this->otherdb->insert('TBL_ATTACHMENT', $attachInfo);
    
        return $this->otherdb->insert_id();
    }
	
	function ExistedClearance($regno,$semcode,$gender)    
	{
		$query = $this->otherdb->where('REGNO', $regno)
						->where('GENDER', $gender)
						->where('SEMCODE', $semcode)
						->get('TBL_CLEARANCE');

		return ($query->num_rows() > 0) ? true : false;
    }
    
    
    function viewClearanceInfo($gender, $hostelid, $roomid)
    {		
		$this->otherdb->select('TBL_CLEARANCE.*,TBL_HOSTEL.HOSTEL_NO')
						->from('TBL_CLEARANCE')
						->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_CLEARANCE.HOSTELID','INNER');

		if(!empty($gender)){
			$this->otherdb->where('TBL_CLEARANCE.GENDER',$gender);
		}

		if(!empty($hostelid)){
			$this->otherdb->where('TBL_CLEARANCE.HOSTELID',$hostelid);
		}

		if(!empty($roomid)){
			$this->otherdb->where('TBL_CLEARANCE.ROOMID',$roomid);
		}

		return $this->otherdb->get()->result();		
    }
	
	function viewClearanceInfobyId($gender, $ALLOTMENT_ID)
    {
        return $this->otherdb->select('TBL_CLEARANCE.*,TBL_HOSTEL.HOSTEL_NO')
			        ->from('TBL_CLEARANCE')
			        ->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_CLEARANCE.HOSTELID','INNER')
					->where('TBL_CLEARANCE.CLR_NO',$ALLOTMENT_ID)
					->where('TBL_CLEARANCE.GENDER',$gender)
			        ->get()
			        ->result();
    }	
	
	function getAllSeatInfo()
    {
        return $this->otherdb->select('TBL_ROOM.ROOMID, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_ROOM.ROOMTYPE, TBL_SEAT.SEATDESC, TBL_SEAT.OCCUPIED, TBL_SEAT.SEATID, TBL_SEAT.SEAT, TBL_HOSTEL.HOSTELID AS HID')
			        ->from('TBL_SEAT')
					->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_SEAT.HOSTELID','INNER')
					->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_SEAT.ROOMID','INNER')
					->where('TBL_SEAT.OCCUPIED',0)
			        ->get()
			        ->result();
    }
	
	function GetHostelIDRoomID($gender, $hostelno, $roomno)
    {		
		$this->otherdb->select('TBL_ROOM.ROOMDESC,TBL_HOSTEL.HOSTEL_NO,TBL_HOSTEL.HOSTELID')
					->from('TBL_ROOM')
					->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ROOM.HOSTELID','INNER');
				
		if(!empty($roomno)){

			$this->otherdb->where('TBL_ROOM.ROOMID', $roomno);
		}

		if(!empty($hostelno)){

			$this->otherdb->where('TBL_HOSTEL.HOSTELID', $hostelno);
		}

		if(!empty($gender)){

			$this->otherdb->where('TBL_ROOM.GENDER', $gender);
		}
	
		return $this->otherdb->get()->result();		  
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
	
	function getAttachmentInfobyId($AllotID)
    {
		return $this->otherdb->select('TBL_ATTACHMENT.*, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_SEAT.SEAT')
			        ->from('TBL_ATTACHMENT')
					->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTEL_NO = TBL_ATTACHMENT.HOSTELID','INNER')
					->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ATTACHMENT.ROOMID','INNER')
					->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ATTACHMENT.SEATID','INNER')
			        ->where('ATTACHMENT_ID',$AllotID)
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
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('ROOMID',$ROOMID);
        $otherdb->select('TBL_ROOM.ROOMID, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.HOSTELID AS RHOSTELID, TBL_ROOM.ROOMDESC, TBL_ROOM.ROOMTYPE, TBL_ROOM.SCAPACITY, TBL_ROOM.FLOOR, TBL_ROOM.BEDS, TBL_ROOM.CHAIRS, TBL_ROOM.TABLES, TBL_ROOM.CUPBOARDS, TBL_ROOM.TUBELIGHTS, TBL_ROOM.FANS, TBL_ROOM.OTHERITEMS');
        $otherdb->from('TBL_ROOM');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ROOM.HOSTELID','INNER');
        $query =  $otherdb->get();
        
        return $query->result();
    }
    
	function InsertClearance($data)
    {
		$this->otherdb->insert('TBL_CLEARANCE', $data);
        
        return $this->otherdb->insert_id();
    }

    function editClearInfo($clearInfo, $clearid)
    {
		$this->otherdb->where('CLR_NO', $clearid)->update('TBL_CLEARANCE', $clearInfo);
        
        return $this->otherdb->affected_rows();
    }

    function UpdatedRoomStatus($data,$roomid){
    	
    	$this->otherdb->where('ROOMID',$roomid)->update('TBL_SEAT', $data);
        
        return $this->otherdb->affected_rows();
    }
    
    function UpdatedSeatStatus($data,$seatid,$roomid)
    {
		$this->otherdb->where('SEATID',$seatid)
						->where('ROOMID',$roomid)
						->update('TBL_SEAT', $data);
        
        return $this->otherdb->affected_rows();
    }
	
	function UpdatedBlacklist($regno, $data)
    {
		$this->otherdb->where('REGNO',$regno)->update('TBL_BLACKLIST', $data);
        
        return $this->otherdb->affected_rows();
    }
	
	function UpdatedSeatAlloted($data,$id)
    {
		$this->otherdb->where('SEATID',$id)->update('TBL_SEAT', $data);
        
        return $this->otherdb->affected_rows();
    }
	
	function UpdatedSeatAllotedNew($data,$id)
    {
		$this->otherdb->where('SEATID',$id)->update('TBL_SEAT', $data);
        
        return $this->otherdb->affected_rows();
    }    
    
    function DeleteRecordfromAllot($regno)
    {
		$this->otherdb->where('REGNO', $regno)->delete('TBL_ALLOTMENT');
        
        return $this->otherdb->affected_rows();
    }

	function DeleteRecordfromReAllot($regno)
    {
		$this->otherdb->where('REGNO', $regno)->delete('TBL_REALLOTMENT');
        
        return $this->otherdb->affected_rows();
    }
	
	function DeleteRecordfromdefault($regno)
    {
		$this->otherdb->where('REGNO', $regno)->delete('TBL_DEFAULT');
        
        return $this->otherdb->affected_rows();
    }
	
	function DeleteRecordfromAllotReallot($regno)
    {
		$this->otherdb->where('REGNO', $regno)->delete('TBL_ALLOTREALLOT');
        
        return $this->otherdb->affected_rows();
    }

    function getRoomStatus($hostelID, $roomID){
    	return $this->otherdb->where('HOSTELID', $hostelID)
					->where('ROOMID', $roomID)
					->get('TBL_SEAT')
					->result();
    }

    function findStudentInHistory($regno){
		return $this->otherdb->where('REGNO', $regno)
					->get('tbl_allotmenthistory')
					->result();
    }
	
	function getroombyHostelId($hostelid)
    {
		return $this->otherdb->select('ROOMID')
					->where('HOSTELID', $hostelid)
					->get('TBL_ROOM')
					->result();
    }
	
	function seatexisted($id)
    {
		return $this->otherdb->select('SEATID')
					->where('SEATID', $id)
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
    
    function GetroomitemByRegno($regno)
    {	
		return $this->otherdb->ORDER_BY('ITEM_ID','DESC')
					->where('REGNO', $regno)
					->get('TBL_ROOMITEM')
					->result();
    }
	
	function VerifyfromBlacklist($regno)
    {	
		return $this->otherdb->where('REGNO', $regno)
					->where('BSTATUS', 1)
					->get('TBL_BLACKLIST')
					->result();	
    }
	
	function VerifyUserRecordByHistory($regno,$gender)
    {
		return $this->otherdb->select('TBL_ALLOTMENTHISTORY.*,TBL_ALLOTMENTHISTORY.GENDER AS GEN,TBL_ROOMITEM.*,TBL_HOSTEL.HOSTELDESC,TBL_HOSTEL.HOSTEL_NO AS HOSTEL,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE,TBL_SEAT.SEAT')
					->from('TBL_ALLOTMENTHISTORY')
					->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENTHISTORY.HOSTELID','INNER')
					->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENTHISTORY.ROOMID','INNER')
					->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENTHISTORY.SEATID','INNER')
					->join('TBL_ROOMITEM', 'TBL_ROOMITEM.REGNO = TBL_ALLOTMENTHISTORY.REGNO','INNER')
					->where('TBL_ALLOTMENTHISTORY.REGNO', $regno)
					->where('TBL_ALLOTMENTHISTORY.GENDER', $gender)
			        ->get()
					->result();
	}
	
	
	function VerifyUserRecordById($regno,$gender)
    {
		$result = $this->otherdb->select('TBL_ALLOTMENT.*,TBL_ALLOTMENT.GENDER AS GEN,TBL_ROOMITEM.*,TBL_HOSTEL.HOSTELDESC,TBL_HOSTEL.HOSTEL_NO AS HOSTEL,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE,TBL_SEAT.SEAT')
						->from('TBL_ALLOTMENT')
						->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER')
						->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER')
						->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER')
						->join('TBL_ROOMITEM', 'TBL_ROOMITEM.REGNO = TBL_ALLOTMENT.REGNO','INNER')
						->where('TBL_ALLOTMENT.REGNO', $regno)
						->where('TBL_ALLOTMENT.GENDER', $gender)
				        ->get()
						->result();		

		if(empty($result)){

			$result = $this->otherdb->select('TBL_REALLOTMENT.*,TBL_REALLOTMENT.GENDER AS GEN,TBL_ROOMITEM.*,TBL_HOSTEL.HOSTELDESC,TBL_HOSTEL.HOSTEL_NO AS HOSTEL,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE,TBL_SEAT.SEAT, TBL_REALLOTMENT.REALLOTMENT_ID AS ALLOTMENT_ID')
							->from('TBL_REALLOTMENT')
							->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_REALLOTMENT.HOSTELID','INNER')
							->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_REALLOTMENT.ROOMID','INNER')
							->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_REALLOTMENT.SEATID','INNER')
							->join('TBL_ROOMITEM', 'TBL_ROOMITEM.REGNO = TBL_REALLOTMENT.REGNO','INNER')
							->where('TBL_REALLOTMENT.REGNO', $regno)
							->where('TBL_REALLOTMENT.GENDER', $gender)
					        ->get()
							->result();
		}

		if(empty($result)){

			$result = $this->otherdb->select('TBL_DEFAULT.*,TBL_HOSTEL.HOSTEL_NO,TBL_DEFAULT.GENDER AS GEN,TBL_HOSTEL.HOSTEL_NO AS HOSTEL,TBL_HOSTEL.HOSTELDESC,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE,TBL_SEAT.SEAT')
							->from('TBL_DEFAULT')
							->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_DEFAULT.SEATID','INNER')
							->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_DEFAULT.HOSTELID','INNER')
							->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_DEFAULT.ROOMID','INNER')
							->where('TBL_DEFAULT.REGNO', $regno)
							->where('TBL_DEFAULT.GENDER',$gender)
							->get()
							->result();
		}

		if(empty($result)){

			$result = $this->otherdb->select('TBL_ALLOTREALLOT.*,TBL_HOSTEL.HOSTEL_NO,TBL_ALLOTREALLOT.GENDER AS GEN,TBL_HOSTEL.HOSTEL_NO AS HOSTEL,TBL_HOSTEL.HOSTELDESC,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE,TBL_SEAT.SEAT')
							->from('TBL_ALLOTREALLOT')
							->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTREALLOT.SEATID','INNER')
							->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTREALLOT.HOSTELID','INNER')
							->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTREALLOT.ROOMID','INNER')
							->where('TBL_ALLOTREALLOT.REGNO', $regno)
							->where('TBL_ALLOTREALLOT.GENDER',$gender)
							->get()
							->result();
		}

		if(empty($result)){
			$result = $this->otherdb->select('tbl_allotmenthistory.*,TBL_HOSTEL.HOSTEL_NO,tbl_allotmenthistory.GENDER AS GEN,TBL_HOSTEL.HOSTEL_NO AS HOSTEL,TBL_HOSTEL.HOSTELDESC,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE,TBL_SEAT.SEAT')
							->from('tbl_allotmenthistory')
							->join('TBL_SEAT', 'TBL_SEAT.SEATID = tbl_allotmenthistory.SEATID','INNER')
							->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = tbl_allotmenthistory.HOSTELID','INNER')
							->join('TBL_ROOM', 'TBL_ROOM.ROOMID = tbl_allotmenthistory.ROOMID','INNER')
							->where('tbl_allotmenthistory.REGNO', $regno)
							->where('tbl_allotmenthistory.GENDER',$gender)
							->order_by('tbl_allotmenthistory.ALLOTMENTHISTORY_ID', 'DESC')
							->limit(1)
							->get()
							->result();
		}
		
		return $result;
    }
	
	function VerifyUserRecordByguestId($regno,$gender)
    { 
		return $this->otherdb->select('TBL_ATTACHMENT.*,TBL_ROOMITEM.*,TBL_HOSTEL.HOSTELDESC,TBL_HOSTEL.HOSTEL_NO,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE,TBL_SEAT.SEAT')
					->from('TBL_ATTACHMENT')
					->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ATTACHMENT.HOSTELID','INNER')
					->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ATTACHMENT.ROOMID','INNER')
					->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER')
					->join('TBL_ROOMITEM', 'TBL_ROOMITEM.REGNO = TBL_ALLOTMENT.REGNO','INNER')
					->where('TBL_ATTACHMENT.GUESTREGNO', $regno)
					->where('TBL_ATTACHMENT.GENDER', $gender)
			        ->get()
					->result();
    }
} 