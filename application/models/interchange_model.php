<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Interchange_model extends CI_Model
{
    

    public function __construct(){

		$this->otherdb = $this->load->database('otherdb', TRUE);
		
	}

	
    /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
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
	
	function StudentSwapExisted($regno,$semcode)
	{
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('REGNO',$regno);
		$otherdb->where('SEMCODE',$semcode);
		$query = $otherdb->get('tbl_appseatswapfmale');
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function StudentAppforchangInter($regno,$semcode)
	{
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('REGNO');
        $otherdb->from('tbl_appseatswapfmale');
		$otherdb->where('REGNO',$regno);
		$otherdb->where('SEMCODE',$semcode);
		$query =  $otherdb->get();
        
		if ($query->num_rows() > 0)
		{
        	return $query->result();
		}
		else{
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('REGNO');
      	    $otherdb->from('tbl_appseatchangefmale');
			$otherdb->where('REGNO',$regno);
		    $otherdb->where('SEMCODE',$semcode);
		    $query = $otherdb->get();
        	
			return $query->result();
		}
	}
	
	function StudentChangeExisted($regno,$semcode)
	{
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('REGNO',$regno);
		$otherdb->where('SEMCODE',$semcode);
		$query = $otherdb->get('tbl_appseatchangefmale');
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function StudentChangeMExisted($regno,$semcode)
	{
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('REGNO',$regno);
		$otherdb->where('SEMCODE',$semcode);
		$query = $otherdb->get('tbl_seatchangemale');
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}

	function StudentChangeRecordExisted($regno,$semcode)
	{
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('REGNO',$regno);
		$otherdb->where('SEMCODE',$semcode);
		return $otherdb->get('tbl_seatchangemale')->result_array();
		// if ($query->num_rows() > 0){
		// 	return true;
		// }
		// else{
		// 	return false;
		// }
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
    
	 function getStudentPic()
    {
		
        $this->db->select('TBL_HSTUDENTS.*,STUDENTPICTURELR.STUDPIC');
        $this->db->from('TBL_HSTUDENTS');
		$this->db->join('STUDENTPICTURELR', 'STUDENTPICTURELR.REGNO = TBL_HSTUDENTS.REGNO','INNER');
		$this->db->where('TBL_HSTUDENTS.REGNO','7376-FMS/MBA/F16');
		$query =  $this->db->get();
        
        return $query->result();
    }
	
    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
	  function addfirstAllotment($reallotmentInfo)
    {
        //$this->db->trans_start();
		// the TRUE paramater tells CI that you'd like to return the database object.
		
		$otherdb = $this->load->database('otherdb', TRUE); 
		
        $query = $otherdb->insert('TBL_REALLOTMENT', $reallotmentInfo);
    
       // $insert_id = $this->db->insert_id();
        
       // $this->db->trans_complete();
        
        return $query;
    }
	
	function InsertStudentChangeRec($NewStudChangeInfo, $gender)
    {
        if($gender == 'Female')
       {
			$this->db->trans_start();
			// the TRUE paramater tells CI that you'd like to return the database object.
			
			$otherdb = $this->load->database('otherdb', TRUE); 
			
			$query = $otherdb->insert('tbl_appseatchangefmale', $NewStudChangeInfo);
			
			$insert_id = $otherdb->insert_id();
			
			$otherdb->trans_complete();
			
			return $query;
	   }
	   elseif($gender == 'Male')
       {
			$this->db->trans_start();
			// the TRUE paramater tells CI that you'd like to return the database object.
			
			$otherdb = $this->load->database('otherdb', TRUE); 
			
			$query = $otherdb->insert('tbl_seatchangemale', $NewStudChangeInfo);
			
			$insert_id = $otherdb->insert_id();
			
			$otherdb->trans_complete();
			
			return $query;
	   }
    }
	
	function InsertStudentSwapRec($NewStudSwapInfo)
    {
        $this->db->trans_start();
		// the TRUE paramater tells CI that you'd like to return the database object.
		
		$otherdb = $this->load->database('otherdb', TRUE); 
		
        $query = $otherdb->insert('tbl_appseatswapfmale', $NewStudSwapInfo);
		
	    $insert_id = $otherdb->insert_id();
        
        $otherdb->trans_complete();
        
        return $query;
    }
	
	function InsertKeyInfo($keyinfo)
    {
        //$this->db->trans_start();
		// the TRUE paramater tells CI that you'd like to return the database object.
		
		$otherdb = $this->load->database('otherdb', TRUE); 
		
        $query = $otherdb->insert('tbl_key', $keyinfo);
		
	    $insert_id = $otherdb->insert_id();
        
        $otherdb->trans_complete();
        
        return $query;
    }
	 
   function InsertTransferInfo($transferseatInfo)
    {
        //$this->db->trans_start();
		// the TRUE paramater tells CI that you'd like to return the database object.
		
		$otherdb = $this->load->database('otherdb', TRUE); 
		
        $query = $otherdb->insert('TBL_TRANSFER', $transferseatInfo);
		
	    $insert_id = $otherdb->insert_id();
        
        $otherdb->trans_complete();
        
        return $query;
    }
	
	function InsertSecondtregnoInfo($secondregno)
    {
        //$this->db->trans_start();
		// the TRUE paramater tells CI that you'd like to return the database object.
		
		$otherdb = $this->load->database('otherdb', TRUE); 
		
        $query = $otherdb->insert('TBL_INTERCHANGE', $secondregno);
		
	    $insert_id = $otherdb->insert_id();
        
        $otherdb->trans_complete();
        
        return $query;
    }
	
	function InsertFirstregnoInfo($firstuserinfo)
	{
		$otherdb = $this->load->database('otherdb', TRUE); 
		
        $query = $otherdb->insert('TBL_INTERCHANGE', $firstuserinfo);
		
	    $insert_id = $otherdb->insert_id();
        
        $otherdb->trans_complete();
        
        return $query;
	}
	
	function GetFirstregnoSeatInfo($regno, $gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('*, TBL_ALLOTMENTHISTORY.ALLOTMENTHISTORY_ID AS ID');
        $otherdb->from('TBL_ALLOTMENTHISTORY');
		$otherdb->where('GENDER',$gender);
		$otherdb->where('REGNO',$regno);
       
	    $query =  $otherdb->get();
		
		$result = $query->result();
		
		if(empty($result))
		  {
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('TBL_ALLOTMENT.*, TBL_ALLOTMENT.ALLOTMENT_ID AS ID');
			$otherdb->from('TBL_ALLOTMENT');
			$otherdb->where('GENDER',$gender);
			$otherdb->where('REGNO',$regno);
		   
			$query =  $otherdb->get();
			
			$result = $query->result();
			if(empty($result))
			  {
				    $otherdb = $this->load->database('otherdb', TRUE);
					$otherdb->select('TBL_REALLOTMENT.*, TBL_REALLOTMENT.REALLOTMENT_ID AS ID');
					$otherdb->from('TBL_REALLOTMENT');
					$otherdb->where('GENDER',$gender);
					$otherdb->where('REGNO',$regno);
				   
					$query =  $otherdb->get();
					
					$result = $query->result();
					return $result;  
			  }
			else{
			      return $result; 
			    }
		  }
		else{
			   return $result; 
			 }
    }
	
	function GetSecondregnoSeatInfo($swapregno, $gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_ALLOTMENTHISTORY.*, TBL_ALLOTMENTHISTORY.ALLOTMENTHISTORY_ID AS ID');
        $otherdb->from('TBL_ALLOTMENTHISTORY');
		$otherdb->where('GENDER',$gender);
		$otherdb->where('REGNO',$regno);
       
	    $query =  $otherdb->get();
		
		$result = $query->result();
		
		if(empty($result))
		  {
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('TBL_ALLOTMENT.*, TBL_ALLOTMENT.ALLOTMENT_ID AS ID');
			$otherdb->from('TBL_ALLOTMENT');
			$otherdb->where('GENDER',$gender);
			$otherdb->where('REGNO',$swapregno);
		   
			$query =  $otherdb->get();
			
			$result = $query->result();
			if(empty($result))
			  {
				    $otherdb = $this->load->database('otherdb', TRUE);
					$otherdb->select('TBL_REALLOTMENT.*, TBL_REALLOTMENT.REALLOTMENT_ID AS ID');
					$otherdb->from('TBL_REALLOTMENT');
					$otherdb->where('GENDER',$gender);
					$otherdb->where('REGNO',$swapregno);
				   
					$query =  $otherdb->get();
					
					$result = $query->result();
					return $result;  
			  }
			else{
			      return $result; 
			    }
		  }
		else{
			   return $result; 
			 }
		
		
    }
	
	function GetOldSeatInfo($regno, $gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('*');
        $otherdb->from('TBL_ALLOTMENTHISTORY');
		$otherdb->where('GENDER',$gender);
		$otherdb->where('REGNO',$regno);
       
	    $query =  $otherdb->get();
        if($query->num_rows() > 0)
		{
          return $query->result();
		}
		elseif($query->num_rows() == 0)
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('TBL_ALLOTMENT.*, ALLOTMENT_ID AS ALLOTMENTHISTORY_ID,STUDENTNAME,REGNO,HOSTELID,ROOMID,SEATID,GENDER');
			$otherdb->from('TBL_ALLOTMENT');
			$otherdb->where('GENDER',$gender);
			$otherdb->where('REGNO',$regno);
		   
			$query =  $otherdb->get();
			 if($query->num_rows() > 0)
				{
				  return $query->result();
				}
			elseif($query->num_rows() == 0)
				  {
					    $otherdb = $this->load->database('otherdb', TRUE);
						$otherdb->select('TBL_REALLOTMENT.*, REALLOTMENT_ID AS ALLOTMENTHISTORY_ID,STUDENTNAME,REGNO,HOSTELID,ROOMID,SEATID,GENDER');
						$otherdb->from('TBL_REALLOTMENT');
						$otherdb->where('GENDER',$gender);
						$otherdb->where('REGNO',$regno);
					   
						$query =  $otherdb->get();
						return $query->result();
				  }
		}
    }
	
	 function InsertHisFirstregnoInfo($InsertHisfirstregno)
    {
        $otherdb = $this->load->database('otherdb', TRUE); 
		
        $query = $otherdb->insert('TBL_ALLOTMENTHISTORY', $InsertHisfirstregno);
		
	    $insert_id = $otherdb->insert_id();
        
        $otherdb->trans_complete();
        
        return $query;
		
	}
	
	 function InsertHisSecondregnoInfo($InsertHisSecondregno)
    {
        $otherdb = $this->load->database('otherdb', TRUE); 
		
        $query = $otherdb->insert('TBL_ALLOTMENTHISTORY', $InsertHisSecondregno);
		
	    $insert_id = $otherdb->insert_id();
        
        $otherdb->trans_complete();
        
        return $query;
		
	}
	
	function UpdateReAlotFirstregnoInfo($secondregno,$regno,$firstallotid)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('regno',$regno);
		//$otherdb->where('REALLOTMENT_ID',$firstallotid);
        $otherdb->update('TBL_REALLOTMENT', $secondregno);
        
        return $otherdb->affected_rows();
    }
	function UpdateAlotFirstregnoInfo($secondregno,$regno,$firstallotid)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('regno',$regno);
		//$otherdb->where('REALLOTMENT_ID',$firstallotid);
        $otherdb->update('TBL_ALLOTMENT', $secondregno);
        
        return $otherdb->affected_rows();
    }
	
	function UpdateSecondregnoInfo($firstregno,$swapregno,$secondallotid)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('regno',$swapregno);
		$otherdb->where('ALLOTMENTHISTORY_ID',$secondallotid);
        $otherdb->update('TBL_ALLOTMENTHISTORY', $firstregno);
        
        return $otherdb->affected_rows();
    }
	
	function UpdateReAlotSecondregnoInfo($firstregno,$swapregno,$secondallotid)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('regno',$swapregno);
		//$otherdb->where('REALLOTMENT_ID',$secondallotid);
        $otherdb->update('TBL_REALLOTMENT', $firstregno);
        
        return $otherdb->affected_rows();
    }
	
	function UpdateAlotSecondregnoInfo($firstregno,$swapregno,$secondallotid)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('regno',$swapregno);
		//$otherdb->where('REALLOTMENT_ID',$secondallotid);
        $otherdb->update('TBL_ALLOTMENT', $firstregno);
        
        return $otherdb->affected_rows();
    }
	
	function InsertHisInfo($InsertHisInfo)
    {
        $otherdb = $this->load->database('otherdb', TRUE); 
		
        $query = $otherdb->insert('TBL_ALLOTMENTHISTORY', $InsertHisInfo);
		
	    $insert_id = $otherdb->insert_id();
        
        $otherdb->trans_complete();
        
        return $query;
		
    }
	
	function UpdateVSeatReallot($regno,$gender,$AllotHis,$updateseatInfo)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('regno',$regno);
		$otherdb->where('GENDER',$gender);
		//$otherdb->where('REALLOTMENT_ID',$AllotHis);
        $otherdb->update('TBL_REALLOTMENT', $updateseatInfo);
		
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('regno',$regno);
		$otherdb->where('GENDER',$gender);
		//$otherdb->where('ALLOTMENT_ID',$AllotHis);
        $otherdb->update('TBL_ALLOTMENT', $updateseatInfo);
        
        return $otherdb->affected_rows();
    }
	
	function GetLastAllotmentHisId($regno,$gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('ALLOTMENTHISTORY_ID, REGNO');
        $otherdb->from('TBL_ALLOTMENTHISTORY');
		$otherdb->where('GENDER',$gender);
		$otherdb->where('REGNO',$regno);
		$otherdb->order_by('ALLOTMENTHISTORY_ID','DESC');
		$otherdb->limit(1);
        $query =  $otherdb->get();
        
        return $query->result();
    }
    
    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function viewallotmentInfo($gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_ALLOTMENTHISTORY.*,TBL_SEAT.SEAT,TBL_HOSTEL.HOSTEL_NO,TBL_ROOM.ROOMDESC');
        $otherdb->from('TBL_ALLOTMENTHISTORY');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENTHISTORY.SEATID','INNER');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENTHISTORY.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENTHISTORY.ROOMID','INNER');
		$otherdb->where('TBL_ALLOTMENTHISTORY.GENDER',$gender);
        $query =  $otherdb->get();
        
        return $query->result();
    }
	
	function getStudentRecordsbyRegno($studregno)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_ALLOTMENTHISTORY.*,TBL_SEAT.SEAT,TBL_HOSTEL.HOSTEL_NO,TBL_HOSTEL.HOSTELDESC,TBL_ROOM.ROOMDESC');
        $otherdb->from('TBL_ALLOTMENTHISTORY');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENTHISTORY.SEATID','INNER');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENTHISTORY.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENTHISTORY.ROOMID','INNER');
		$otherdb->where('TBL_ALLOTMENTHISTORY.REGNO',$studregno);
		$otherdb->order_by('TBL_ALLOTMENTHISTORY.ALLOTMENTHISTORY_ID','DESC');
		$otherdb->limit('1');
        $query =  $otherdb->get();
        
        return $query->result();
    }
	
	 function getStudentRecords($emailId)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_ALLOTMENTHISTORY.*,TBL_SEAT.SEAT,TBL_HOSTEL.HOSTEL_NO,TBL_HOSTEL.HOSTELDESC,TBL_ROOM.ROOMDESC');
        $otherdb->from('TBL_ALLOTMENTHISTORY');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENTHISTORY.SEATID','INNER');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENTHISTORY.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENTHISTORY.ROOMID','INNER');
		$otherdb->where('TBL_ALLOTMENTHISTORY.EMAILID',$emailId);
		$otherdb->order_by('TBL_ALLOTMENTHISTORY.ALLOTMENTHISTORY_ID','DESC');
		$otherdb->limit('1');
        $query =  $otherdb->get();
        
        return $query->result();
    }
	
	function getAllHostelInfo($gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('*');
        $otherdb->from('TBL_HOSTEL');
		$otherdb->where('GENDER',$gender);
		$otherdb->order_by('HOSTEL_NO','ASC');
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
	
	function getroombySeatId($roomid,$hostelno)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('SEATID,SEAT');
        $otherdb->from('TBL_SEAT');
		$otherdb->where('ROOMID',$roomid);
		$otherdb->where('HOSTELID',$hostelno);
		$otherdb->where('OCCUPIED',0);
		
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
	
	function getRoomInfo($hostelId, $gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('TBL_HOSTEL.HOSTELID',$hostelId);
		//$otherdb->where('TBL_HOSTEL.HOSTELID !=',13);
		//$otherdb->where('TBL_HOSTEL.HOSTELID !=',16);
		$otherdb->where('TBL_ROOM.ROOMTYPE !=','TUTOR ROOM');
		$otherdb->where('TBL_ROOM.ROOMTYPE !=','WASHROOM');
		$otherdb->where('TBL_ROOM.ROOMTYPE !=','DOOR');
		$otherdb->where('TBL_ROOM.ROOMTYPE !=','NO NUMBER');
		$otherdb->where('TBL_ROOM.ROOMTYPE !=','AD OFFICE');
		$otherdb->where('TBL_ROOM.ROOMTYPE !=','office');
		$otherdb->where('TBL_ROOM.ROOMTYPE !=','ST (Office');
		$otherdb->where('TBL_ROOM.ROOMTYPE !=','STARES');
		$otherdb->where('TBL_ROOM.ROOMTYPE !=','KITCHEN');
		//$otherdb->where('TBL_ROOM.CAPTUREBY',null);
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
		//$otherdb->where('TBL_HOSTEL.HOSTELID !=',13);
		//$otherdb->where('TBL_HOSTEL.HOSTELID !=',16);
		//$otherdb->where('TBL_SEAT.SEATDESC !=','Cubical');
		$otherdb->where('TBL_ROOM.ROOMID',$roomId);
		$otherdb->where('TBL_SEAT.GENDER',$gender);
		$otherdb->where('TBL_SEAT.OCCUPIED',0);
		//$otherdb->where('TBL_SEAT.CAPTUREBY',null);
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
	
	function GetAllUserInfo($regno, $gender, $hostelid, $roomid, $seatid)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        
		$otherdb->select('TBL_ALLOTMENT.*,TBL_HOSTEL.HOSTEL_NO,TBL_HOSTEL.HOSTELDESC,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE,TBL_SEAT.SEAT');
        $otherdb->from('TBL_ALLOTMENT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER');
		$otherdb->where('TBL_HOSTEL.HOSTELID',$hostelid);
		$otherdb->where('TBL_ROOM.ROOMID',$roomid);
		$otherdb->where('TBL_SEAT.SEATID',$seatid);
		$otherdb->where('TBL_ALLOTMENT.GENDER',$gender);
		$otherdb->where('TBL_ALLOTMENT.REGNO',$regno);
		$otherdb->ORDER_BY('TBL_ALLOTMENT.ALLOTMENT_ID','ASC');
		$otherdb->LIMIT('1');
		
        $query =  $otherdb->get();
		$result =  $query->result();
		
		if(empty($result))
		{
			$otherdb->select('TBL_REALLOTMENT.*,TBL_HOSTEL.HOSTEL_NO,TBL_HOSTEL.HOSTELDESC,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE,TBL_SEAT.SEAT');
			$otherdb->from('TBL_REALLOTMENT');
			$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_REALLOTMENT.HOSTELID','INNER');
			$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_REALLOTMENT.ROOMID','INNER');
			$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_REALLOTMENT.SEATID','INNER');
			$otherdb->where('TBL_HOSTEL.HOSTELID',$hostelid);
			$otherdb->where('TBL_ROOM.ROOMID',$roomid);
			$otherdb->where('TBL_SEAT.SEATID',$seatid);
			$otherdb->where('TBL_REALLOTMENT.GENDER',$gender);
			$otherdb->where('TBL_REALLOTMENT.REGNO',$regno);
			$otherdb->ORDER_BY('TBL_REALLOTMENT.REALLOTMENT_ID','ASC');
			$otherdb->LIMIT('1');
		    $query =  $otherdb->get();
			
			$result = $query->result();
			 
			 return $result ;
		}
		else
		
        return $result ;
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
    
    function UpdatedSeatStatus($oldseatid,$gender,$updateseat)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('SEATID',$oldseatid);
		$otherdb->where('GENDER',$gender);
        $otherdb->update('TBL_SEAT', $updateseat);
        
        return $otherdb->affected_rows();
    }
	
	function UpdatedNewSeatStatus($vseat,$gender,$updatenewseat)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('SEATID',$vseat);
		$otherdb->where('GENDER',$gender);
        $otherdb->update('TBL_SEAT', $updatenewseat);
        
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
        $otherdb->from('TBL_ALLOTMENT');
		$query =  $otherdb->get();
		$result =  $query->result();
		
	if(empty($result))
		{
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('REGNO', $regno);
		$otherdb->where('GENDER', $gender);
		$otherdb->select('*');
        $otherdb->from('TBL_REALLOTMENT');
		$query =  $otherdb->get();
		
		return $result =  $query->result();
		
		}
    else  
		
        return $result;
		
	   
    }
    
     function getstudentemail($gender,$studentname)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_USERS.EMAIL,STUDENTNAME,TBL_USERS.PASSWORD');
        $otherdb->from('TBL_ALLOTMENTHISTORY');
		$otherdb->join('TBL_USERS', 'TBL_USERS.NAME = TBL_ALLOTMENTHISTORY.STUDENTNAME','INNER');
		$otherdb->where('TBL_ALLOTMENTHISTORY.GENDER',$gender);
		$otherdb->where('TBL_ALLOTMENTHISTORY.STUDENTNAME',$studentname);
		$otherdb->where('TBL_ALLOTMENTHISTORY.ADMIN_VERIFY',1);
        $query =  $otherdb->get();
        
        return $query->result();
    }
    
	
}


  