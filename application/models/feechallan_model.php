<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Feechallan_model extends CI_Model
{

	public function __construct(){

		$this->otherdb = $this->load->database('otherdb', TRUE);
		
	}
   
    function HostelFeeDetailId($regno,$semester)
    {
        return $this->db->select('PAYCHALLANDETAIL.*,TBL_HSTUDENTS.*,FEECODES.FEEDESC,PAYCHALLAN.*')
			        ->from('PAYCHALLANDETAIL')		
					->join('FEECODES', 'FEECODES.FEECODE = PAYCHALLANDETAIL.FEECODE','INNER')
					->join('TBL_HSTUDENTS', 'TBL_HSTUDENTS.REGNO = PAYCHALLANDETAIL.REGNO','INNER')
					->join('PAYCHALLAN', 'PAYCHALLAN.CHALLANNO = PAYCHALLANDETAIL.CHALLANNO','INNER')
					->where('PAYCHALLANDETAIL.REGNO', $regno)
					->where("(PAYCHALLANDETAIL.FEECODE = '17' OR PAYCHALLANDETAIL.FEECODE = '101' )",NULL, FALSE)
					->where('PAYCHALLANDETAIL.SEMCODE', $semester)
					->get()
					->result();
	}
	
	function HostelFeeDetailByHR($semester)
    {
        return $this->db->select('PAYCHALLAN.*,FEECODES.*,STUDENT.*')
			        ->from('PAYCHALLANDETAIL')
					->join('PAYCHALLAN', 'PAYCHALLAN.REGNO = PAYCHALLANDETAIL.REGNO','INNER')
					->join('STUDENT', 'STUDENT.REGNO = PAYCHALLANDETAIL.REGNO','INNER')
					->join('FEECODES', 'FEECODES.FEECODE = PAYCHALLANDETAIL.FEECODE','INNER')
					->where('STUDENT.BATCHCODE', 'FSSPSYPSPSY3912')
					->where('PAYCHALLAN.SEMCODE', $semester)
			        ->get()
					->result();
		
	}
	
	function Getuserinfo($gender,$studregno)
    {
		if($gender == 'Female')
		{
			return $this->otherdb->where('REGNO',$studregno)
						->where('GENDER',$gender)
						->get('tbl_application')
						->result();
		}
		elseif($gender == 'Male')
		{
			return $this->otherdb->where('REGNO',$studregno)
						->where('GENDER',$gender)
						->get('tbl_maleapplication')
						->result();
		}
    }
	
	function GetuserRenewalinfo($gender,$studregno)
    {		
		$result = $this->otherdb->where('REGNO',$studregno)
						->where('GENDER',$gender)
						->get('tbl_allotreallot')
						->result();
		
		if(empty($result))
		{
			return $this->otherdb->where('REGNO',$studregno)
						->where('GENDER',$gender)
						->get('tbl_reallotment')
						->result();
		}
	   return $result;
	}
	
	function GetGenderById($userId)
    {
		return $this->otherdb->select('GENDER,userId,email')
					->where('userId',$userId)
					->get('TBL_USERS')
					->result();
    }
	
	function HostelCardsDetailById($CardID)
    {		
		return $this->otherdb->where('HCARDNO', $CardID)->get('TBL_HOSTELCARD')->result();
	}
	
	function StudentInfo($gender,$userId)
    {
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('REGNO');
        	$otherdb->from('TBL_ALLOTREALLOT');
			$otherdb->where('GENDER', $gender);
			$otherdb->where('EMAILID', $userId);
			$otherdb->order_by('TBL_ALLOTREALLOT.ID', 'DESC');
			$otherdb->limit(1);
        	$query = $otherdb->get();
			
			$result =  $query->result();
			
			if(empty($result))
			{
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('REGNO');
				$otherdb->from('TBL_REALLOTMENT');
				$otherdb->where('GENDER', $gender);
				$otherdb->where('EMAILID', $userId);
				$otherdb->order_by('TBL_REALLOTMENT.REALLOTMENT_ID', 'DESC');
				$otherdb->limit(1);
				$query = $otherdb->get();
				$result =  $query->result();
				
				if(empty($result))
			      {
					$otherdb = $this->load->database('otherdb', TRUE);
					$otherdb->select('REGNO');
					$otherdb->from('TBL_ALLOTMENT');
					$otherdb->where('GENDER', $gender);
					$otherdb->where('EMAILID', $userId);
					$otherdb->order_by('TBL_ALLOTMENT.ALLOTMENT_ID', 'DESC');
					$otherdb->limit(1);
					$query = $otherdb->get();
					$result =  $query->result();
					
					return $result;
			      }
				
				return $result;
			}
			else
			{
				return $result;
			}
	}
	
	function feetype()
    {
		return $this->otherdb->where('FEETYPE', 'Hostel Normal Fee')
					->get('FEECODES')
					->result();
	}
	
	function getuserinforegno($regno, $gender)
    {
		return $this->otherdb->where('REGNO', $regno)
					->where('GENDER', $gender)
					->get('TBL_ALLOTREALLOT')
					->result();
	}
	
	function getNewuserinforegno($regno, $gender)
    {
		if($gender == 'Female')
	    {
			return $this->otherdb->where('REGNO', $regno)
						->where('GENDER', $gender)
						->get('TBL_APPLICATION')
						->result();
		}
		elseif($gender == 'Male')
	    {
			return $this->otherdb->where('REGNO', $regno)
						->where('GENDER', $gender)
						->get('TBL_MALEAPPLICATION')
						->result();
		}
	}
	
	function CheckNewuserinforegno($regno, $gender)
    {
		if($gender == 'Female')
	    {
			return $this->otherdb->where('REGNO', $regno)
						->where('GENDER', $gender)
						->where('STATUS', 0)
						->get('TBL_APPLICATION')
						->result();
		}
		elseif($gender == 'Male')
	    {
			return $this->otherdb->where('REGNO', $regno)
						->where('GENDER', $gender)
						->where('STATUS', 0)
						->get('TBL_MALEAPPLICATION')
						->result();
		}
	}
	
	function feetypeSecurity()
    {
		return $this->otherdb->where('FEETYPE', 'Hostel Security')->get('FEECODES')->result();
	}
	
	function HostelDetail($gender)
    {
		return $this->otherdb->where('GENDER', $gender)->get('TBL_HOSTEL')->result();
	}
	
	function SemesterDetail($gender)
    {
		return $this->otherdb->select('distinct(SEMCODE)')
					->where('GENDER', $gender)
					//->order_by('SMCODE', 'DESC')
					->get('TBL_SEMESTER')
					->result();
	}

	function ProgramDetail()
    {
		return $this->otherdb->select('distinct(PROTITTLE)')
					->where('PROTITTLE !=', '')
					->order_by('PROTITTLE', 'DESC')
					->get('TBL_ALLOTMENTHISTORY')
					->result();
	}

	function StructureTypeDetail()
    {
		return $this->otherdb->get('TBL_FEESTRUCTURETYPE')->result();
	}
	
	function ActiveSemesterDetail($gender)
    {
    	return $this->otherdb->where('GENDER', $gender)
			    	->where('REALLOTSTATUS', 1)
			    	->get('TBL_SEMESTER')
			    	->result();
	}
	
    function viewClearanceInfo()
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_ATTACHMENT.*,TBL_SEAT.SEAT');
        $otherdb->from('TBL_ATTACHMENT');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ATTACHMENT.SEATID','INNER');
        $query =  $otherdb->get();
        
		if(!empty($query->num_rows))
		{
        	return $query->result();
		}
		else
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('TBL_ALLOTMENT.*, TBL_ALLOTMENT.REGNO AS GUESTREGNO, TBL_SEAT.SEAT');
			$otherdb->from('TBL_ALLOTMENT');
			$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ATTACHMENT.SEATID','INNER');
			$query =  $otherdb->get();
        
		    return $query->result();
		}
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
    
	  
	function InsertFee($reallotFeeInfo)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$query = $otherdb->insert('hostelfeestructure', $reallotFeeInfo);
        
        return TRUE;
      }
	  
    function VisitorEdit($visitorInfo, $visitid)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('VISITORID',$visitid);
        $otherdb->update('TBL_VISITORS', $visitorInfo);
        
        return TRUE;
    }
	
	function updatefine($feeID, $regno, $fineinfo)
    {
		$this->otherdb->where('REGNO',$regno)
					->where('ID',$feeID)
					->update('paychallan', $fineinfo);
        
        return $this->otherdb->affected_rows();
    }
	
	function UpdateExtFeeInfo($gender, $studreg, $updateExtFeeInfo)
    {
		$this->otherdb->where('REGNO',$studreg)
					->where('gender',$gender)
					->update('paychallan', $updateExtFeeInfo);
        
        return $this->otherdb->affected_rows();
    }
    
    function UpdatedSeatStatus($data,$id)
    {
		$this->otherdb->where('SEATID',$id)->update('TBL_SEAT', $data);
        
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
	
	function deleteFeedesc($feeids)
    {
		$this->otherdb->where('ID', $feeids)->delete('paychallandetail');
        
        return $this->otherdb->affected_rows();
    }
	
	function getroombyHostelId($hostelid)
    {
		return $this->otherdb->select('ROOMID')
					->where('HOSTELID', $hostelid)
					->get('TBL_ROOM')
					->result();
    }
	
	function GetHostelGenratedFeeSem($gender)
    {
		return $this->otherdb->select('distinct(CURRENTSEMESTER)')
					->where('GENDER', $gender)
					->where('FEETYPE', 'HOSTEL FEE')
					->or_where('FEETYPE', 'NEW HOSTEL FEE')
					->group_by('CURRENTSEMESTER')
			        ->get('paychallan')
					->result();
    }

	function GetChallanSester($gender)
    {
		return $this->otherdb->select('distinct(current_semester)')
					->where('GENDER', $gender)
					->group_by('current_semester')
					->get('tbl_newpaychallan')
					->result();
    }

    function getFeeType($gender)
    {
		return $this->otherdb->select('distinct(feetype)')
					->where('GENDER', $gender)
					->get('tbl_newpaychallan')
					->result();
    }

    function getFeeChallanStatus($gender)
    {
		return $this->otherdb->select('distinct(publish)')
					->where('GENDER', $gender)
					->group_by('publish')
					->get('tbl_newpaychallan')
					->result();
    }

    function getChallanNationality($gender){
		return $this->otherdb->select('distinct(nationality)')
					->where('GENDER', $gender)
					->get('tbl_newpaychallan')
					->result();
    }

    function ViewHostelFeeChallans($gender, $semester, $feetype, $ispublished, $nationality){
    	$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
		$otherdb->from('tbl_newpaychallan');
		$otherdb->where('GENDER', $gender);
		if(isset($semester) && !empty($semester)){
			$otherdb->where('current_semester', $semester);
		}
		if(isset($feetype) && !empty($feetype)){
			$otherdb->where('feetype', $feetype);
		}

		if(isset($nationality) && !empty($nationality)){
			$otherdb->where('nationality', $nationality);
		}

		if(isset($ispublished) && !empty($ispublished)){

			$publish  = ($ispublished == 'Published')?'1':'0'; 

			$otherdb->where('publish', $publish);
		}
		
        $query = $otherdb->get();
       
		return $query->result();
    }
	
	function GetHostelGenratedBatch($gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('distinct(BATCHNAME)');
		$otherdb->from('paychallan');
		$otherdb->where('GENDER', $gender);
		$otherdb->where('FEETYPE', 'HOSTEL FEE');
		$otherdb->group_by('BATCHNAME', 'DESC');
        $query = $otherdb->get();
		return $query->result();
       
    }
	
	function GetNewHostelGenratedSFeeSem($gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('distinct(CURRENTSEMESTER)');
		$otherdb->from('paychallan');
		$otherdb->where('GENDER', $gender);
		$otherdb->where('FEETYPE', 'NEW HOSTEL FEE');
		$otherdb->group_by('CURRENTSEMESTER', 'DESC');
        $query = $otherdb->get();
		return $query->result();
       
    }
	
	function GetNewHostelGenratedSBatch($gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('distinct(BATCHNAME)');
		$otherdb->from('paychallan');
		$otherdb->where('GENDER', $gender);
		$otherdb->where('FEETYPE', 'NEW HOSTEL FEE');
		$otherdb->group_by('BATCHNAME', 'DESC');
        $query = $otherdb->get();
		return $query->result();
       
    }
	
	function GetHostelGenratedSFeeSem($gender)
    {
		return $this->otherdb->select('distinct(CURRENTSEMESTER)')
					->where('GENDER', $gender)
					->where('FEETYPE', 'HOSTEL SECURITY')
					->group_by('CURRENTSEMESTER', 'DESC')
			        ->get('paychallan')
					->result();
    }
	
	function GetHostelGenratedSBatch($gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('distinct(BATCHNAME)');
		$otherdb->from('paychallan');
		$otherdb->where('GENDER', $gender);
		$otherdb->where('FEETYPE', 'HOSTEL SECURITY');
		$otherdb->group_by('BATCHNAME', 'DESC');
        $query = $otherdb->get();
		return $query->result();
       
    }
	
	function ViewNornalHostelFeeGenrated($gender, $csem, $batchname)
    {
        if(!empty($csem) && !empty($batchname))
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('paychallan.*, tbl_allotreallot.STUDENTNAME, tbl_allotreallot.FATHERNAME, tbl_allotreallot.FACULTY, tbl_allotreallot.DEPARTNAME, tbl_allotreallot.PROGRAME');
			$otherdb->from('paychallan');
			$otherdb->join('tbl_allotreallot', 'paychallan.REGNO = tbl_allotreallot.REGNO','INNER');
			$otherdb->where('paychallan.CURRENTSEMESTER', $csem);
			//$otherdb->where('tbl_allotreallot.SEMCODE', $csem);
			$otherdb->where('paychallan.BATCHNAME', $batchname);
			$otherdb->where('paychallan.GENDER', $gender);
			$otherdb->where('paychallan.FEETYPE', 'HOSTEL FEE');
			$otherdb->group_by('tbl_allotreallot.REGNO', 'DESC');
			$query1 = $otherdb->get();
			$query1 = $otherdb->last_query();
			
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('paychallan.*, tbl_reallotment.STUDENTNAME, tbl_reallotment.FATHERNAME, tbl_reallotment.FACULTY, tbl_reallotment.DEPARTNAME, tbl_reallotment.PROGRAME');
			$otherdb->from('paychallan');
			$otherdb->join('tbl_reallotment', 'paychallan.REGNO = tbl_reallotment.REGNO','INNER');
			$otherdb->where('paychallan.CURRENTSEMESTER', $csem);
			//$otherdb->where('tbl_allotreallot.SEMCODE', $csem);
			$otherdb->where('paychallan.BATCHNAME', $batchname);
			$otherdb->where('paychallan.GENDER', $gender);
			$otherdb->where('paychallan.FEETYPE', 'HOSTEL FEE');
			$otherdb->group_by('tbl_reallotment.REGNO', 'DESC');
			$query2 = $otherdb->get();
			$query2 = $otherdb->last_query();
			
			$query = $otherdb->query($query1." UNION ".$query2);
			return $query->result();
		}
		elseif(empty($batchname))
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('paychallan.*, tbl_allotreallot.STUDENTNAME, tbl_allotreallot.FATHERNAME, tbl_allotreallot.FACULTY, tbl_allotreallot.DEPARTNAME, tbl_allotreallot.PROGRAME');
			$otherdb->from('paychallan');
			$otherdb->join('tbl_allotreallot', 'paychallan.REGNO = tbl_allotreallot.REGNO','INNER');
			$otherdb->where('paychallan.CURRENTSEMESTER', $csem);
			$otherdb->where('paychallan.GENDER', $gender);
			//$otherdb->where('tbl_allotreallot.SEMCODE', $csem);
			$otherdb->where('paychallan.FEETYPE', 'HOSTEL FEE');
			$otherdb->group_by('tbl_allotreallot.REGNO', 'DESC');
			$query1 = $otherdb->get();
			$query1 = $otherdb->last_query();
			
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('paychallan.*, tbl_reallotment.STUDENTNAME, tbl_reallotment.FATHERNAME, tbl_reallotment.FACULTY, tbl_reallotment.DEPARTNAME, tbl_reallotment.PROGRAME');
			$otherdb->from('paychallan');
			$otherdb->join('tbl_reallotment', 'paychallan.REGNO = tbl_reallotment.REGNO','INNER');
			$otherdb->where('paychallan.CURRENTSEMESTER', $csem);
			//$otherdb->where('tbl_allotreallot.SEMCODE', $csem);
			$otherdb->where('paychallan.GENDER', $gender);
			$otherdb->where('paychallan.FEETYPE', 'HOSTEL FEE');
			$otherdb->group_by('tbl_reallotment.REGNO', 'DESC');
			$query2 = $otherdb->get();
			$query2 = $otherdb->last_query();
			
			$query = $otherdb->query($query1." UNION ".$query2);
			
						
			return $query->result();
		}
		
       
    }
	
	function ViewNewHostelFeeGenrated($gender, $csem, $batchname)
    {
	  if($gender == 'Female')
	     {	
			if(!empty($csem) && !empty($batchname))
			  {
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('paychallan.*, tbl_application.STUDENTNAME, tbl_application.FATHERNAME, tbl_application.FACULTY, tbl_application.DEPARTMENTNAME, tbl_application.PROGRAME, tbl_application.STUDENTID');
				$otherdb->from('paychallan');
				$otherdb->join('tbl_application', 'paychallan.REGNO = tbl_application.REGNO','INNER');
				$otherdb->where('paychallan.CURRENTSEMESTER', $csem);
				$otherdb->where('paychallan.BATCHNAME', $batchname);
				$otherdb->where('paychallan.GENDER', $gender);
				$otherdb->where('paychallan.FEETYPE', 'NEW HOSTEL FEE');
				$otherdb->where('tbl_application.STATUS', '1');
				//$otherdb->group_by('paychallanBATCHNAME', 'DESC');
				$query = $otherdb->get();
				
				return $query->result();
			}
			elseif(empty($batchname))
			{
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('paychallan.*, tbl_application.STUDENTNAME, tbl_application.FATHERNAME, tbl_application.FACULTY, tbl_application.DEPARTMENTNAME, tbl_application.PROGRAME, tbl_application.STUDENTID');
				$otherdb->from('paychallan');
				$otherdb->join('tbl_application', 'paychallan.REGNO = tbl_application.REGNO','INNER');
				$otherdb->where('paychallan.CURRENTSEMESTER', $csem);
				$otherdb->where('paychallan.GENDER', $gender);
				$otherdb->where('paychallan.FEETYPE', 'NEW HOSTEL FEE');
				$otherdb->where('tbl_application.STATUS', '1');
				$query = $otherdb->get();
				
				return $query->result();
			   }
		 }
		elseif($gender == 'Male')
	     {	
			if(!empty($csem) && !empty($batchname))
			  {
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('paychallan.*, tbl_maleapplication.STUDENTNAME, tbl_maleapplication.FATHERNAME, tbl_maleapplication.FACULTY, tbl_maleapplication.DEPARTMENTNAME, tbl_maleapplication.PROGRAME, tbl_MALEapplication.STUDENTID');
				$otherdb->from('paychallan');
				$otherdb->join('tbl_maleapplication', 'paychallan.REGNO = tbl_maleapplication.REGNO','INNER');
				$otherdb->where('paychallan.CURRENTSEMESTER', $csem);
				$otherdb->where('paychallan.BATCHNAME', $batchname);
				$otherdb->where('paychallan.GENDER', $gender);
				$otherdb->where('paychallan.FEETYPE', 'NEW HOSTEL FEE');
				$otherdb->where('tbl_maleapplication.STATUS', '1');
				//$otherdb->group_by('paychallanBATCHNAME', 'DESC');
				$query = $otherdb->get();
				
				return $query->result();
			}
			elseif(empty($batchname))
			{
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('paychallan.*, tbl_maleapplication.STUDENTNAME, tbl_maleapplication.FATHERNAME, tbl_maleapplication.FACULTY, tbl_maleapplication.DEPARTMENTNAME, tbl_maleapplication.PROGRAME, tbl_MALEapplication.STUDENTID');
				$otherdb->from('paychallan');
				$otherdb->join('tbl_maleapplication', 'paychallan.REGNO = tbl_maleapplication.REGNO','INNER');
				$otherdb->where('paychallan.CURRENTSEMESTER', $csem);
				$otherdb->where('paychallan.GENDER', $gender);
				$otherdb->where('paychallan.FEETYPE', 'NEW HOSTEL FEE');
				$otherdb->where('tbl_maleapplication.STATUS', '1');
				$query = $otherdb->get();
				
				return $query->result();
			   }
		 }
       
    }
	
	function ViewSecurityHostelFeeGenrated($gender, $csem, $batchname)
    {
	  if($gender == 'Female')
	     {	
			if(!empty($csem) && !empty($batchname))
			  {
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('paychallan.*, tbl_application.STUDENTNAME, tbl_application.FATHERNAME, tbl_application.FACULTY, tbl_application.DEPARTMENTNAME, tbl_application.PROGRAME');
				$otherdb->from('paychallan');
				$otherdb->join('tbl_application', 'paychallan.REGNO = tbl_application.REGNO','INNER');
				$otherdb->where('paychallan.CURRENTSEMESTER', $csem);
				$otherdb->where('paychallan.BATCHNAME', $batchname);
				$otherdb->where('paychallan.GENDER', $gender);
				$otherdb->where('paychallan.FEETYPE', 'HOSTEL SECURITY');
				$otherdb->where('tbl_application.STATUS', '1');
				//$otherdb->group_by('paychallanBATCHNAME', 'DESC');
				$query = $otherdb->get();
				
				return $query->result();
			}
			elseif(empty($batchname))
			{
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('paychallan.*, tbl_application.STUDENTNAME, tbl_application.FATHERNAME, tbl_application.FACULTY, tbl_application.DEPARTMENTNAME, tbl_application.PROGRAME');
				$otherdb->from('paychallan');
				$otherdb->join('tbl_application', 'paychallan.REGNO = tbl_application.REGNO','INNER');
				$otherdb->where('paychallan.CURRENTSEMESTER', $csem);
				$otherdb->where('paychallan.GENDER', $gender);
				$otherdb->where('paychallan.FEETYPE', 'HOSTEL SECURITY');
				$otherdb->where('tbl_application.STATUS', '1');
				$query = $otherdb->get();
				
				return $query->result();
			   }
		 }
		elseif($gender == 'Male')
	     {	
			if(!empty($csem) && !empty($batchname))
			  {
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('paychallan.*, tbl_maleapplication.STUDENTNAME, tbl_maleapplication.FATHERNAME, tbl_maleapplication.FACULTY, tbl_maleapplication.DEPARTMENTNAME, tbl_maleapplication.PROGRAME');
				$otherdb->from('paychallan');
				$otherdb->join('tbl_maleapplication', 'paychallan.REGNO = tbl_maleapplication.REGNO','INNER');
				$otherdb->where('paychallan.CURRENTSEMESTER', $csem);
				$otherdb->where('paychallan.BATCHNAME', $batchname);
				$otherdb->where('paychallan.GENDER', $gender);
				$otherdb->where('paychallan.FEETYPE', 'HOSTEL SECURITY');
				$otherdb->where('tbl_maleapplication.STATUS', '1');
				//$otherdb->group_by('paychallanBATCHNAME', 'DESC');
				$query = $otherdb->get();
				
				return $query->result();
			}
			elseif(empty($batchname))
			{
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('paychallan.*, tbl_maleapplication.STUDENTNAME, tbl_maleapplication.FATHERNAME, tbl_maleapplication.FACULTY, tbl_maleapplication.DEPARTMENTNAME, tbl_maleapplication.PROGRAME');
				$otherdb->from('paychallan');
				$otherdb->join('tbl_maleapplication', 'paychallan.REGNO = tbl_maleapplication.REGNO','INNER');
				$otherdb->where('paychallan.CURRENTSEMESTER', $csem);
				$otherdb->where('paychallan.GENDER', $gender);
				$otherdb->where('paychallan.FEETYPE', 'HOSTEL SECURITY');
				$otherdb->where('tbl_maleapplication.STATUS', '1');
				$query = $otherdb->get();
				
				return $query->result();
			   }
		 }
       
    }
	
	
	function GetChallanInfoByRegno($gender, $regno, $semcode)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
		$otherdb->from('paychallan');
		$otherdb->where('GENDER', $gender);
		$otherdb->where('FEETYPE', 'HOSTEL FEE');
		$otherdb->where('REGNO', $regno);
		$otherdb->where('CURRENTSEMESTER', $semcode);
		$otherdb->where('STATUS', 1);
        $query = $otherdb->get();
		
		$result = $query->result();
		
		if(empty($result))
		   {
			    $otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('*');
				$otherdb->from('paychallan');
				$otherdb->where('GENDER', $gender);
				$otherdb->where('FEETYPE', 'NEW HOSTEL FEE');
				$otherdb->where('REGNO', $regno);
				$otherdb->where('CURRENTSEMESTER', $semcode);
				$otherdb->where('STATUS', 1);
				$query = $otherdb->get();
				
				$result = $query->result();
				
				if(empty($result))
				   {
					    $otherdb = $this->load->database('otherdb', TRUE);
						$otherdb->select('*');
						$otherdb->from('paychallan');
						$otherdb->where('GENDER', $gender);
						$otherdb->where('FEETYPE', 'HOSTEL SECURITY');
						$otherdb->where('REGNO', $regno);
						$otherdb->where('CURRENTSEMESTER', $semcode);
						$otherdb->where('STATUS', 1);
						$query = $otherdb->get();
						
						$result = $query->result();
				   }
		   }
		   
		   return $result;
       
    }
	
	function GetChallanstatusByRegno($gender,$regno, $semcode)
    {
		return $this->otherdb->where('gender', $gender)
					->where('regno', $regno)
					->where('current_semester', $semcode)
					->where('publish', 1)
			        ->get('tbl_newpaychallan')		
					->result();
    }


       function getChallanNumberAndAmount($id,$feestructureid,$feetype){
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('challanno');
		$otherdb->from('tbl_newpaychallan');
		$otherdb->where('id', $id);		
        $query = $otherdb->get();
		
		$result = $query->result_array();		

		$result['challanno'] = $result[0]['challanno'];

		$feeheads = $this->feechallan_model->NewFeeStructureHeadListById($feestructureid);

		$FeeInfo = $this->feechallan_model->printFeeChallanByRegno($id);

		$amount = 0;
		
		$feeamount = 0;
		$TotalFeeAmount = 0;

		$TotalAmount = 0;

	      foreach($feeheads as $head){ 
	    
	            if($head->head_code != 107 && $head->head_code != 108 && $head->head_code != 109){
	                    if($head->head_code == 100) 
	                    { 
	                       $feeamount = $FeeInfo->month*$head->amount;
	                        $modifyamount = $FeeInfo->modify;	                        
	                        $TotalFeeAmount += $feeamount-$modifyamount;

	                    } 
	                    else 
	                    {	                        
	                        $feeamount = $head->amount;  
	                         $TotalFeeAmount += $head->amount;
	                        
	                    }
	                

	            }
	        }

	        $TotalAmount += $TotalFeeAmount;

	        $extensionCharges = 0;	        

	      if($FeeInfo->extension != 0){	      	

		     if($FeeInfo->extension == '2nd Extension Fee'){
		     	$feeamount = 1000*$FeeInfo->month;
		     }else{
		     	$feeamount = 2000*$FeeInfo->month;
		     }
	      }


	      if($FeeInfo->extension == 0 || $FeeInfo->extension == '1st Extension Fee'){
				//$amount = $amount-50;
								  
		   }
		   elseif( $FeeInfo->extension > 0){
			    
			     $extensionCharges = $amount+$feeamount;
		   }

		$allotfee = $amount;

		    $fineamount = 0;
			if($FeeInfo->finestatus == 0){
				$duedate = $FeeInfo->duedate;
				$cdate = date('Y-m-d');
					if($cdate > $duedate)
						 {
							$noofdays = (strtotime($cdate) - strtotime($duedate))/60/60/24;
							$fineamount = 100*$noofdays;
							if($FeeInfo->finestatus == 0){
							   $id = $FeeInfo->id;
							   $fineinfo = array('fineamount'=>$fineamount);
							   
							   $feehead = $this->feechallan_model->updateNewfine($fineinfo, $id);
							}
					}
					if($fineamount != 0){ 
						$amount = $amount + $fineamount;
						$allotfee = $fineamount + $allotfee;
						}
					}

		if($feetype == 'Allotment'){
			$amount = $allotfee;
		}
		else{
		    $amount = $amount-$modifyamount;
		}



		//$result['amount'] = $amount + $feeamount;
		$result['amount'] = $TotalAmount + $fineamount + $extensionCharges;

		return $result;
	}
	
	function AssignNewFeeStructure($gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('distinct(FEESTRUCSEM)');
		$otherdb->from('hostelfeestructure');
		$otherdb->where('GENDER', $gender);
		$otherdb->where('FEETYPE', 'NEW HOSTEL FEE');
		$otherdb->order_by('id', 'DESC');
        $query = $otherdb->get();
		return $query->result();
       
    }
	
	function AssignSecurityFeeStructure($gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('distinct(FEESTRUCSEM)');
		$otherdb->from('hostelfeestructure');
		$otherdb->where('GENDER', $gender);
		$otherdb->where('FEETYPE', 'HOSTEL SECURITY');
		$otherdb->order_by('id', 'DESC');
        $query = $otherdb->get();
		return $query->result();
       
    }
	
	function AssignFeeStructure($gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('distinct(FEESTRUCSEM)');
		$otherdb->from('hostelfeestructure');
		$otherdb->where('GENDER', $gender);
		$otherdb->where('FEETYPE', 'HOSTEL FEE');
		$otherdb->order_by('id', 'DESC');
        $query = $otherdb->get();
		return $query->result();
       
    }
	
	function AssignFeetyoeStructure($gender)
    {
		return $this->otherdb->select('hostelfeestructure.FEECODE, FEECODES.FEEDESC')
					->from('hostelfeestructure')
					->join('FEECODES', 'FEECODES.FEECODE = hostelfeestructure.FEECODE','INNER')
					->where('hostelfeestructure.GENDER', $gender)
					->where('hostelfeestructure.FEETYPE', 'HOSTEL FEE')
					->group_by('hostelfeestructure.FEECODE', 'ASC')
			        ->get()
					->result();
       
    }
	
	function AssignSecurityFeeTypeStructure($gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('hostelfeestructure.FEECODE, FEECODES.FEEDESC');
		$otherdb->from('hostelfeestructure');
		$otherdb->join('FEECODES', 'FEECODES.FEECODE = hostelfeestructure.FEECODE','INNER');
		$otherdb->where('hostelfeestructure.GENDER', $gender);
		$otherdb->where('hostelfeestructure.FEETYPE', 'HOSTEL SECURITY');
		$otherdb->group_by('hostelfeestructure.FEECODE', 'ASC');
        $query = $otherdb->get();
		return $query->result();
       
    }
	
	function AssignNEWHOSTELFeeTypeStructure($gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('hostelfeestructure.FEECODE, FEECODES.FEEDESC');
		$otherdb->from('hostelfeestructure');
		$otherdb->join('FEECODES', 'FEECODES.FEECODE = hostelfeestructure.FEECODE','INNER');
		$otherdb->where('hostelfeestructure.GENDER', $gender);
		$otherdb->where('hostelfeestructure.FEETYPE', 'NEW HOSTEL FEE');
		$otherdb->group_by('hostelfeestructure.FEECODE', 'ASC');
        $query = $otherdb->get();
		return $query->result();
       
    }
	
	function GetFeesInfo($gender, $feesem, $feedesc, $feetype)
    {
        if($feedesc == '')
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('hostelfeestructure.*, FEECODES.FEEDESC');
			$otherdb->from('hostelfeestructure');
			$otherdb->join('FEECODES', 'FEECODES.FEECODE = hostelfeestructure.FEECODE','INNER');
			$otherdb->where('hostelfeestructure.GENDER', $gender);
			$otherdb->where('hostelfeestructure.FEESTRUCSEM', $feesem);
			$otherdb->where('hostelfeestructure.FEETYPE', $feetype);
			$query = $otherdb->get();
			return $query->result();
		}
		elseif($feesem == '')
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('hostelfeestructure.*, FEECODES.FEEDESC');
			$otherdb->from('hostelfeestructure');
			$otherdb->join('FEECODES', 'FEECODES.FEECODE = hostelfeestructure.FEECODE','INNER');
			$otherdb->where('hostelfeestructure.GENDER', $gender);
			$otherdb->where('hostelfeestructure.FEECODE', $feedesc);
			$otherdb->where('hostelfeestructure.FEETYPE', $feetype);
			$query = $otherdb->get();
			return $query->result();
		}
		
		elseif($feesem != '' && $feedesc != '')
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('hostelfeestructure.*, FEECODES.FEEDESC');
			$otherdb->from('hostelfeestructure');
			$otherdb->join('FEECODES', 'FEECODES.FEECODE = hostelfeestructure.FEECODE','INNER');
			$otherdb->where('hostelfeestructure.GENDER', $gender);
			$otherdb->where('hostelfeestructure.FEESTRUCSEM', $feesem);
			$otherdb->where('hostelfeestructure.FEECODE', $feedesc);
			$otherdb->where('hostelfeestructure.FEETYPE', $feetype);
			//$otherdb->group_by('hostelfeestructure.FEECODE', 'ASC');
			$query = $otherdb->get();
			return $query->result();
		}
       
    }
	
	function getfeedetail($regno, $challanno, $feeID)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select_sum('FEEAMOUNT');
		$otherdb->from('paychallandetail');
		$otherdb->where('REGNO', $regno);
		$otherdb->where('CHALLANNO', $challanno);
		$otherdb->where('PAYCHALLANID', $feeID);
		$otherdb->where('FEECODE', 17);
        $query = $otherdb->get();
		
		return $query->result();
       
    }
	
	function getsecurity($regno, $gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('FEEAMOUNT, FEETYPE, ID');
		$otherdb->from('paychallandetail');
		$otherdb->where('REGNO', $regno);
		$otherdb->where('GENDER', $gender);
		$otherdb->where('FEETYPE', 'HOSTEL SECURITY');
		$otherdb->order_by('id', 'desc');
		$otherdb->limit('1');
        $query = $otherdb->get();
		
		return $query->result();
       
    }
	
	function EditSecurityFeeChallan($feeID, $gender)
    {
		if($gender =='Female')
        {
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('paychallan.ID, paychallan.REGNO, paychallan.STATUS, paychallan.BATCHNAME,paychallan.CHALLANNO, paychallan.CURRENTSEMESTER, paychallan.FINEAMOUNT, tbl_application.STUDENTNAME');
			$otherdb->from('paychallan');
			$otherdb->join('tbl_application', 'paychallan.REGNO = tbl_application.REGNO','INNER');
			$otherdb->where('paychallan.GENDER', $gender);
			$otherdb->where('paychallan.ID', $feeID);
			$otherdb->where('tbl_application.STATUS', '1');
			$query = $otherdb->get();
			
			return $query->result();
		}
		elseif($gender =='Male')
        {
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('paychallan.ID, paychallan.REGNO, paychallan.STATUS, paychallan.BATCHNAME,paychallan.CHALLANNO, paychallan.CURRENTSEMESTER, paychallan.FINEAMOUNT, tbl_maleapplication.STUDENTNAME');
			$otherdb->from('paychallan');
			$otherdb->join('tbl_maleapplication', 'paychallan.REGNO = tbl_maleapplication.REGNO','INNER');
			$otherdb->where('paychallan.GENDER', $gender);
			$otherdb->where('paychallan.ID', $feeID);
			$otherdb->where('tbl_maleapplication.STATUS', '1');
			$query = $otherdb->get();
			
			return $query->result();
		}
       
    }
	
	function EditNornalFeeChallandetail($feeID, $challanno, $gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
		$otherdb->from('paychallandetail');
		$otherdb->where('GENDER', $gender);
		$otherdb->where('PAYCHALLANID', $feeID);
		$otherdb->where('FEECODE', 102);
		$otherdb->where('CHALLANNO', $challanno);
        $query = $otherdb->get();
		
		return $query->result();
       
    }
	
	function EditNornalFeeChallan($feeID, $gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('paychallan.ID, paychallan.REGNO, paychallan.STATUS, paychallan.BATCHNAME,paychallan.CHALLANNO, paychallan.CURRENTSEMESTER, paychallan.FEESTRUCSEM, paychallan.FINEAMOUNT, paychallan.GENDER, paychallan.NATIONALITY, tbl_allotreallot.STUDENTNAME');
		$otherdb->from('paychallan');
		$otherdb->join('tbl_allotreallot', 'paychallan.REGNO = tbl_allotreallot.REGNO','INNER');
		$otherdb->where('paychallan.GENDER', $gender);
		$otherdb->where('paychallan.ID', $feeID);
        $query = $otherdb->get();
		$query1 = $otherdb->last_query();
		
		 $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('paychallan.ID, paychallan.REGNO, paychallan.STATUS, paychallan.BATCHNAME,paychallan.CHALLANNO, paychallan.CURRENTSEMESTER, paychallan.FEESTRUCSEM, paychallan.FINEAMOUNT, paychallan.GENDER, paychallan.NATIONALITY, tbl_reallotment.STUDENTNAME');
		$otherdb->from('paychallan');
		$otherdb->join('tbl_reallotment', 'paychallan.REGNO = tbl_reallotment.REGNO','INNER');
		$otherdb->where('paychallan.GENDER', $gender);
		$otherdb->where('paychallan.ID', $feeID);
        $query = $otherdb->get();
		$query2 = $otherdb->last_query();
			
		$query = $otherdb->query($query1." UNION ".$query2);
		
		return $query->result();
       
    }
		
	function EditNornalFeeStructure($feeID, $gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('hostelfeestructure.*, FEECODES.FEEDESC');
		$otherdb->from('hostelfeestructure');
		$otherdb->join('FEECODES', 'FEECODES.FEECODE = hostelfeestructure.FEECODE','INNER');
		$otherdb->where('hostelfeestructure.GENDER', $gender);
		$otherdb->where('hostelfeestructure.id', $feeID);
        $query = $otherdb->get();
		
		return $query->result();
       
    }
	
	function CheckFeeChallanExist($nationality,$programelevel, $batchnames,$feestructure,$feetype, $feecode, $feeamount, $gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
		$otherdb->from('hostelfeestructure');
		$otherdb->where('NATIONALITY', $nationality);
		$otherdb->where('PROTITTLE', $programelevel);
		$otherdb->where('BATCHNAME', $batchnames);
		$otherdb->where('FEESTRUCSEM', $feestructure);
		$otherdb->where('FEECODE', $feecode);
		$otherdb->where('FEEAMOUNT', $feeamount);
		$otherdb->where('GENDER', $gender);
		$otherdb->where('FEETYPE', $feetype);
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
	
	function GetExtInfo($studreg, $gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('REGNO');
		$otherdb->from('TBL_ALLOTREALLOT');
		$otherdb->where('REGNO', $studreg);
		$otherdb->where('GENDER', $gender);
		$otherdb->where('EXT >', 0);
        $query = $otherdb->get();
		
		if($query->num_rows() > 0)
			{
				return TRUE;
			}
		else 
			{
				return FALSE;
			}
       
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


    /**
     * This function is used to match users password for change password
     * @param number $userId : This is user id
     */
    function getfnameoradb($regno)
    {
        $this->db->select('FATHERNAME, CNIC');
        $this->db->where('REGNO', $regno);        
        $query = $this->db->get('TBL_HSTUDENTS');
        
        return $query->result();

    }
	
	 function getuserbatchname($regno)
    {
        $this->db->select('*');
        $this->db->where('REGNO', $regno);         
        $query = $this->db->get('TBL_HSTUDENTS');
        
        return $query->result();

    }
    
    /**
     * This function is used to GET hostel room by reg no
     * @param number $reg : This is user id
     * @param array $userInfo : This is user updation info
     */
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
	
	
	function VerifyUserRecordById($regno)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('TBL_ALLOTMENT.*,TBL_ALLOTMENT.STUDENTNAME AS NAME,TBL_HOSTEL.HOSTELDESC,TBL_ROOM.ROOMDESC');
		$otherdb->from('TBL_ALLOTMENT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTEL_NO = TBL_ALLOTMENT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER');
		$otherdb->where('REGNO', $regno);
        $query = $otherdb->get();
		
		return $query->result();
	
    }
	
	function VerifyUserRecordByguestId($regno)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('TBL_ATTACHMENT.*,TBL_ATTACHMENT.GUESTREGNO AS REGNO,TBL_ATTACHMENT.GUESTNAME AS NAME,TBL_HOSTEL.HOSTELDESC,TBL_ROOM.ROOMDESC');
		$otherdb->from('TBL_ATTACHMENT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTEL_NO = TBL_ATTACHMENT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ATTACHMENT.ROOMID','INNER');
		$otherdb->where('GUESTREGNO', $regno);
        $query = $otherdb->get();
		
		return $query->result();
	
    }
	
	function Getprograme($programelevel, $nationality, $gender)
    {
        if($programelevel == 'BS')
	 	 {
		   if($nationality == 'Pakistani')
		      {
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('DISTINCT(BATCHNAME)');
				$otherdb->from('tbl_allotreallot');		
				$otherdb->where('GENDER', $gender);
				$otherdb->where('NATIONALITY', $nationality);
				$otherdb->where('FEESTATUS', 1);
				$where = "(PROTITTLE = 'BS' OR PROTITTLE = 'LLB' OR PROTITTLE = 'MA' OR PROTITTLE = 'MSC' OR PROTITTLE = 'Bachelor')";
				$otherdb->where($where);
				$query = $otherdb->get();
				
				return $query->result();
			  }
			else
		      {
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('DISTINCT(BATCHNAME)');
				$otherdb->from('tbl_allotreallot');		
				$otherdb->where('GENDER', $gender);
				$otherdb->where('FEESTATUS', 1);
				$where = "(PROTITTLE = 'BS' OR PROTITTLE = 'LLB' OR PROTITTLE = 'MA' OR PROTITTLE = 'MSC' OR PROTITTLE = 'Bachelor')";
				$otherdb->where($where);
				$otherdb->where('NATIONALITY !=', 'Pakistani');
				$query = $otherdb->get();
				
				return $query->result();
			  }
		 }
		 elseif($programelevel == 'MS')
		  {
			   if($nationality == 'Pakistani')
		      {
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('DISTINCT(BATCHNAME)');
				$otherdb->from('tbl_allotreallot');		
				$otherdb->where('GENDER', $gender);
				$otherdb->where('FEESTATUS', 1);
				$where = "(PROTITTLE = 'MS' OR PROTITTLE = 'MS/MPHILL' OR PROTITTLE = 'LLM')";
				$otherdb->where($where);
				$otherdb->where('NATIONALITY', $nationality);
				$query = $otherdb->get();
				
				return $query->result();
			  }
			  else
			  {
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('DISTINCT(BATCHNAME)');
				$otherdb->from('tbl_allotreallot');		
				$otherdb->where('GENDER', $gender);
				$otherdb->where('FEESTATUS', 1);
				$where = "(PROTITTLE = 'MS' OR PROTITTLE = 'MS/MPHILL' OR PROTITTLE = 'LLM')";
				$otherdb->where($where);
				$otherdb->where('NATIONALITY !=', 'Pakistani');
				$query = $otherdb->get();
				
				return $query->result();
			  }
		 }
		 elseif($programelevel == 'PHD')
		  {
			  if($nationality == 'Pakistani')
		      {
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('DISTINCT(BATCHNAME)');
				$otherdb->from('tbl_allotreallot');		
				$otherdb->where('GENDER', $gender);
				$otherdb->where('FEESTATUS', 1);
				$otherdb->where('PROTITTLE', $programelevel);
				$otherdb->where('NATIONALITY', $nationality);
				$query = $otherdb->get();
				
				return $query->result();
			  }
			  else
			  {
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('DISTINCT(BATCHNAME)');
				$otherdb->from('tbl_allotreallot');		
				$otherdb->where('GENDER', $gender);
				$otherdb->where('FEESTATUS', 1);
				$otherdb->where('PROTITTLE', $programelevel);
				$otherdb->where('NATIONALITY !=', 'Pakistani');
				$query = $otherdb->get();
				
				return $query->result();
			  }
		 }
		
	}
	
	function GetUniqueFeecodeNewStud($programechallan, $gender, $nationality, $assignfeestruc)
    {       
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('distinct(hostelfeestructure.FEECODE), hostelfeestructure.FEEAMOUNT, FEECODES.FEEDESC');
			$otherdb->from('hostelfeestructure');
			$otherdb->join('FEECODES', 'FEECODES.FEECODE = hostelfeestructure.FEECODE','INNER');
			$otherdb->where('hostelfeestructure.GENDER', $gender);
			$otherdb->where('hostelfeestructure.PROTITTLE', $programechallan);
			$otherdb->where('hostelfeestructure.NATIONALITY', $nationality);
			$otherdb->where('hostelfeestructure.FEETYPE', 'NEW HOSTEL FEE');
			$otherdb->where('hostelfeestructure.FEESTRUCSEM', $assignfeestruc);
			$otherdb->group_by('hostelfeestructure.id', 'DESC');
			$otherdb->limit('3');
			//$otherdb->group_by('hostelfeestructure.FEECODE');
			
			$query = $otherdb->get();
			return $query->result();
	}
	
	function GetUniqueFeecodeSecurity($programechallan, $gender, $nationality, $assignfeestruc)
    {       
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('hostelfeestructure.FEECODE, hostelfeestructure.FEEAMOUNT, FEECODES.FEEDESC');
			$otherdb->from('hostelfeestructure');
			$otherdb->join('FEECODES', 'FEECODES.FEECODE = hostelfeestructure.FEECODE','INNER');
			$otherdb->where('hostelfeestructure.GENDER', $gender);
			$otherdb->where('hostelfeestructure.PROTITTLE', $programechallan);
			$otherdb->where('hostelfeestructure.NATIONALITY', $nationality);
			$otherdb->where('hostelfeestructure.FEETYPE', 'HOSTEL SECURITY');
			$otherdb->where('hostelfeestructure.FEESTRUCSEM', $assignfeestruc);
			$otherdb->group_by('hostelfeestructure.FEECODE', 'DESC');
			$query = $otherdb->get();
			return $query->result();
	}
	
	
	function GetUniqueFeecode($programechallan, $gender, $nationality, $assignfeestruc)
    {
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('hostelfeestructure.FEECODE, hostelfeestructure.FEEAMOUNT, FEECODES.FEEDESC');
			$otherdb->from('hostelfeestructure');
			$otherdb->join('FEECODES', 'FEECODES.FEECODE = hostelfeestructure.FEECODE','INNER');
			$otherdb->where('hostelfeestructure.GENDER', $gender);
			$otherdb->where('hostelfeestructure.PROTITTLE', $programechallan);
			$otherdb->where('hostelfeestructure.NATIONALITY', $nationality);
			$otherdb->where('hostelfeestructure.FEESTRUCSEM', $assignfeestruc);
			$otherdb->where('hostelfeestructure.FEETYPE', 'HOSTEL FEE');
			$otherdb->group_by('hostelfeestructure.FEEAMOUNT', 'ASC');
			$query = $otherdb->get();
			return $query->result();
	}
	
	function GetfeestrucInfo($gender)
    {
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('DISTINCT(FEESTRUCSEM)');
			$otherdb->from('hostelfeestructure');
			$otherdb->where('GENDER', $gender);
			$otherdb->where('FEETYPE', 'HOSTEL FEE');
			$otherdb->group_by('FEESTRUCSEM', 'DESC');
			$query = $otherdb->get();
			return $query->result();
	}
	
	function GetNewfeestrucInfo($gender)
    {
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('DISTINCT(FEESTRUCSEM)');
			$otherdb->from('hostelfeestructure');
			$otherdb->where('GENDER', $gender);
			$otherdb->where('FEETYPE', 'NEW HOSTEL FEE');
			$otherdb->group_by('FEESTRUCSEM', 'DESC');
			$query = $otherdb->get();
			return $query->result();
	}
	
	function RegnoExistPaychallan($gender, $regnos, $csemester,$feetypes)
    {
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('REGNO');
			$otherdb->from('paychallan');
			$otherdb->where('GENDER', $gender);
			$otherdb->where('REGNO', $regnos);
			$otherdb->like('CURRENTSEMESTER', $csemester);
			$otherdb->where('FEETYPE', $feetypes);
			$query = $otherdb->get();
			$result = $query->result();
			if(empty($result)){
				
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('REGNO');
				$otherdb->from('tbl_allotreallot');
				$otherdb->where('GENDER', $gender);
				$otherdb->where('REGNO', $regnos);
				$query = $otherdb->get();
				$result = $query->result();
				return $result;
			}
			return $result;
	}
	
	function GetSecurityfeestrucInfo($gender)
    {
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('DISTINCT(FEESTRUCSEM)');
			$otherdb->from('hostelfeestructure');
			$otherdb->where('GENDER', $gender);
			$otherdb->where('FEETYPE', 'HOSTEL SECURITY');
			$otherdb->group_by('FEESTRUCSEM', 'DESC');
			$query = $otherdb->get();
			return $query->result();
	}
	
	function GetCSemInfo($gender)
    {
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('DISTINCT(SEMCODE)');
			$otherdb->from('tbl_semester');
			$otherdb->where('GENDER', $gender);
			$otherdb->group_by('SMCODE', 'DESC');
			$otherdb->order_by('SMCODE', 'DESC');
			$query = $otherdb->get();
			return $query->result();
	}
	
	function GetNormalFeeInfo($gender, $nationality, $programechallan, $assignfeestruc, $feetype)
    {
			if($programechallan == 'BS')
			{
						
						$otherdb = $this->load->database('otherdb', TRUE);
						$otherdb->select('distinct(BATCHNAME)');
						$otherdb->from('hostelfeestructure');
						$otherdb->where('GENDER', $gender);
						$otherdb->where('PROTITTLE', $programechallan);
						$otherdb->where('NATIONALITY', $nationality);
						$otherdb->where('FEESTRUCSEM', $assignfeestruc);
						$otherdb->where('FEETYPE', $feetype);
						$otherdb->group_by('hostelfeestructure.BATCHNAME', 'DESC');
						$query = $otherdb->get();
						
						return $query->result();
					}
					elseif($programechallan == 'MS')
					{
						$otherdb = $this->load->database('otherdb', TRUE);
						$otherdb->select('distinct(BATCHNAME)');
						$otherdb->from('hostelfeestructure');
						$otherdb->where('GENDER', $gender);
						$otherdb->where('PROTITTLE', $programechallan);
						$otherdb->where('NATIONALITY', $nationality);
						$otherdb->where('FEESTRUCSEM', $assignfeestruc);
						$otherdb->where('FEETYPE', $feetype);
						$otherdb->group_by('hostelfeestructure.BATCHNAME');
						$query = $otherdb->get();
						
						return $query->result();
					}
					elseif($programechallan == 'PHD')
					{
						$otherdb = $this->load->database('otherdb', TRUE);
						$otherdb->select('distinct(BATCHNAME)');
						$otherdb->from('hostelfeestructure');
						$otherdb->where('GENDER', $gender);
						$otherdb->where('PROTITTLE', $programechallan);
						$otherdb->where('NATIONALITY', $nationality);
						$otherdb->where('FEESTRUCSEM', $assignfeestruc);
						$otherdb->where('FEETYPE', $feetype);
						$otherdb->group_by('hostelfeestructure.BATCHNAME', 'DESC');
						$query = $otherdb->get();
						
						return $query->result();
					}
			
	}
	
	function GetNormalFeeNation($gender, $nationality, $programechallan, $assignfeestruc, $feetype)
    {
			if($programechallan == 'BS')
			{
						
						$otherdb = $this->load->database('otherdb', TRUE);
						$otherdb->select('distinct(BATCHNAME)');
						$otherdb->from('hostelfeestructure');
						$otherdb->where('GENDER', $gender);
						$otherdb->where('PROTITTLE', $programechallan);
						$otherdb->where('NATIONALITY !=', 'Pakistani');
						$otherdb->where('FEESTRUCSEM', $assignfeestruc);
						$otherdb->where('FEETYPE', $feetype);
						$otherdb->group_by('hostelfeestructure.BATCHNAME', 'DESC');
						$query = $otherdb->get();
						
						return $query->result();
					}
					elseif($programechallan == 'MS')
					{
						$otherdb = $this->load->database('otherdb', TRUE);
						$otherdb->select('distinct(BATCHNAME)');
						$otherdb->from('hostelfeestructure');
						$otherdb->where('GENDER', $gender);
						$otherdb->where('PROTITTLE', $programechallan);
						$otherdb->where('NATIONALITY !=', 'Pakistani');
						$otherdb->where('FEESTRUCSEM', $assignfeestruc);
						$otherdb->where('FEETYPE', $feetype);
						$otherdb->group_by('hostelfeestructure.BATCHNAME', 'DESC');
						$query = $otherdb->get();
						
						return $query->result();
					}
					elseif($programechallan == 'PHD')
					{
						$otherdb = $this->load->database('otherdb', TRUE);
						$otherdb->select('distinct(BATCHNAME)');
						$otherdb->from('hostelfeestructure');
						$otherdb->where('GENDER', $gender);
						$otherdb->where('PROTITTLE', $programechallan);
						$otherdb->where('NATIONALITY !=', 'Pakistani');
						$otherdb->where('FEESTRUCSEM', $assignfeestruc);
						$otherdb->where('FEETYPE', $feetype);
						$otherdb->group_by('hostelfeestructure.BATCHNAME', 'DESC');
						$query = $otherdb->get();
						
						return $query->result();
					}
			
	}
	
	
		function GetSecurityStudInfo($gender, $nationality, $programechallan, $batch, $semcode)
    {
		if($gender == 'Female')
	 	 {	
			if($programechallan == 'BS')
			 {
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('REGNO, STUDENTNAME, BATCHNAME');
				$otherdb->from('tbl_application');		
				$otherdb->where('GENDER', $gender);
				$where = "(PROTITTLE = 'BS' OR PROTITTLE = 'LLB' OR PROTITTLE = 'MA' OR PROTITTLE = 'MSC' OR PROTITTLE = 'Bachelor')";
				$otherdb->where($where);
				if($nationality == 'Pakistani')
				  {
				    $otherdb->where('NATIONALITY', $nationality);
				  }
				elseif($nationality != 'Pakistani')
					    {
				          $otherdb->where('NATIONALITY NOT LIKE', 'Pakistani');
				  		}
				$otherdb->like('BATCHNAME', $batch);
				$otherdb->like('SEMESTERCODE', $semcode);
				$otherdb->where('tbl_application.STATUS', '1');
				$query = $otherdb->get();
				
				return $query->result();
			 }
			 elseif($programechallan == 'MS')
			  {
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('REGNO, STUDENTNAME, BATCHNAME');
				$otherdb->from('tbl_application');		
				$otherdb->where('GENDER', $gender);
				$where = "(PROTITTLE = 'MS' OR PROTITTLE = 'MS/MPHILL' OR PROTITTLE = 'LLM')";
				$otherdb->where($where);
				if($nationality == 'Pakistani')
				  {
				    $otherdb->where('NATIONALITY', $nationality);
				  }
				elseif($nationality != 'Pakistani')
					    {
				          $otherdb->where('NATIONALITY NOT LIKE', 'Pakistani');
				  		}
				$otherdb->like('BATCHNAME', $batch);
				$otherdb->like('SEMESTERCODE', $semcode);
				$otherdb->where('tbl_application.STATUS', '1');
				$query = $otherdb->get();
				
				return $query->result();
			 }
			 elseif($programechallan == 'PHD')
			  {
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('REGNO, STUDENTNAME, BATCHNAME');
				$otherdb->from('tbl_application');		
				$otherdb->where('GENDER', $gender);
				$otherdb->like('PROTITTLE', $programechallan);
				if($nationality == 'Pakistani')
				  {
				    $otherdb->where('NATIONALITY', $nationality);
				  }
				elseif($nationality != 'Pakistani')
					    {
				          $otherdb->where('NATIONALITY NOT LIKE', 'Pakistani');
				  		}
				$otherdb->like('BATCHNAME', $batch);
				$otherdb->like('SEMESTERCODE', $semcode);
				$otherdb->where('tbl_application.STATUS', '1');
				$query = $otherdb->get();
				
				return $query->result();
			 }
		 }
	elseif($gender == 'Male')
	 	 {	
			if($programechallan == 'BS')
			 {
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('REGNO, STUDENTNAME, BATCHNAME');
				$otherdb->from('tbl_maleapplication');		
				$otherdb->where('GENDER', $gender);
				$where = "(PROTITTLE = 'BS' OR PROTITTLE = 'LLB' OR PROTITTLE = 'MA' OR PROTITTLE = 'MSC' OR PROTITTLE = 'Bachelor')";
				$otherdb->where($where);
				if($nationality == 'Pakistani')
				  {
				    $otherdb->where('NATIONALITY', $nationality);
				  }
				elseif($nationality != 'Pakistani')
					    {
				          $otherdb->where('NATIONALITY NOT LIKE', 'Pakistani');
				  		}
				$otherdb->like('BATCHNAME', $batch);
				$otherdb->like('SEMESTERCODE', $semcode);
				$otherdb->where('tbl_maleapplication.STATUS', '1');
				$query = $otherdb->get();
				
				return $query->result();
			 }
			 elseif($programechallan == 'MS')
			  {
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('REGNO, STUDENTNAME, BATCHNAME');
				$otherdb->from('tbl_maleapplication');		
				$otherdb->where('GENDER', $gender);
				$where = "(PROTITTLE = 'MS' OR PROTITTLE = 'MS/MPHILL' OR PROTITTLE = 'LLM')";
				$otherdb->where($where);
				if($nationality == 'Pakistani')
				  {
				    $otherdb->where('NATIONALITY', $nationality);
				  }
				elseif($nationality != 'Pakistani')
					    {
				          $otherdb->where('NATIONALITY NOT LIKE', 'Pakistani');
				  		}
				$otherdb->like('BATCHNAME', $batch);
				$otherdb->like('SEMESTERCODE', $semcode);
				$otherdb->where('tbl_maleapplication.STATUS', '1');
				$query = $otherdb->get();
				
				return $query->result();
			 }
			 elseif($programechallan == 'PHD')
			  {
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('REGNO, STUDENTNAME, BATCHNAME');
				$otherdb->from('tbl_maleapplication');		
				$otherdb->where('GENDER', $gender);
				$otherdb->like('PROTITTLE', $programechallan);
				if($nationality == 'Pakistani')
				  {
				    $otherdb->where('NATIONALITY', $nationality);
				  }
				elseif($nationality != 'Pakistani')
					    {
				          $otherdb->where('NATIONALITY NOT LIKE', 'Pakistani');
				  		}
				$otherdb->like('BATCHNAME', $batch);
				$otherdb->like('SEMESTERCODE', $semcode);
				$otherdb->where('tbl_maleapplication.STATUS', '1');
				$query = $otherdb->get();
				
				return $query->result();
			 }
		 }
		
	}
	
	
	function GetStudInfo($gender, $nationality, $programechallan, $batch, $semcode)
    {
        if($programechallan == 'BS')
	 	 {
			 if($nationality == 'Pakistani')
			    {
					$otherdb = $this->load->database('otherdb', TRUE);
					$otherdb->select('REGNO, STUDENTNAME, BATCHNAME');
					$otherdb->from('tbl_allotreallot');		
					$otherdb->where('GENDER', $gender);
					$where = "(PROTITTLE = 'BS' OR PROTITTLE = 'LLB' OR PROTITTLE = 'MA' OR PROTITTLE = 'MSC' OR PROTITTLE = 'Bachelor')";
					$otherdb->where($where);
					$otherdb->where('NATIONALITY', $nationality);
					$otherdb->where('BATCHNAME', $batch);
					$otherdb->where('SEMCODE', $semcode);
					$otherdb->where('FEESTATUS', '1');  // get last semester student not defaulter if defaulter commit condit
					$query = $otherdb->get();
					
					return $query->result();
				}
			elseif($nationality != 'Pakistani')
			    {
					$otherdb = $this->load->database('otherdb', TRUE);
					$otherdb->select('REGNO, STUDENTNAME, BATCHNAME');
					$otherdb->from('tbl_allotreallot');		
					$otherdb->where('GENDER', $gender);
					$where = "(PROTITTLE = 'BS' OR PROTITTLE = 'LLB' OR PROTITTLE = 'MA' OR PROTITTLE = 'MSC' OR PROTITTLE = 'Bachelor')";
					$otherdb->where($where);
					$otherdb->where('NATIONALITY !=', 'Pakistani');
					$otherdb->where('BATCHNAME', $batch);
					$otherdb->where('SEMCODE', $semcode);
					$otherdb->where('FEESTATUS', '1');  // get last semester student not defaulter if defaulter commit condit
					$query = $otherdb->get();
					
					return $query->result();
				}
		 }
		 elseif($programechallan == 'MS')
		  {
			  if($nationality == 'Pakistani')
			  {
					$otherdb = $this->load->database('otherdb', TRUE);
					$otherdb->select('REGNO, STUDENTNAME, BATCHNAME');
					$otherdb->from('tbl_allotreallot');		
					$otherdb->where('GENDER', $gender);
					$where = "(PROTITTLE = 'MS' OR PROTITTLE = 'MS/MPHILL' OR PROTITTLE = 'LLM')";
					$otherdb->where($where);
					$otherdb->where('NATIONALITY', $nationality);
					$otherdb->where('BATCHNAME', $batch);
					$otherdb->where('SEMCODE', $semcode);
					$otherdb->where('FEESTATUS', '1');
					$query = $otherdb->get();
					
					return $query->result();
		     }
		     elseif($nationality != 'Pakistani')
			    {
					$otherdb = $this->load->database('otherdb', TRUE);
					$otherdb->select('REGNO, STUDENTNAME, BATCHNAME');
					$otherdb->from('tbl_allotreallot');		
					$otherdb->where('GENDER', $gender);
					$where = "(PROTITTLE = 'MS' OR PROTITTLE = 'MS/MPHILL' OR PROTITTLE = 'LLM')";
					$otherdb->where($where);
					$otherdb->where('NATIONALITY !=', 'Pakistani');
					$otherdb->where('BATCHNAME', $batch);
					$otherdb->where('SEMCODE', $semcode);
					$otherdb->where('FEESTATUS', '1');
					
					$query = $otherdb->get();
					
					return $query->result();
				}
		 }
		 elseif($programechallan == 'PHD')
		  {
				if($nationality == 'Pakistani')	
				  {
					$otherdb = $this->load->database('otherdb', TRUE);
					$otherdb->select('REGNO, STUDENTNAME, BATCHNAME');
					$otherdb->from('tbl_allotreallot');		
					$otherdb->where('GENDER', $gender);
					$otherdb->where('PROTITTLE', $programechallan);
					$otherdb->where('NATIONALITY', $nationality);
					$otherdb->where('BATCHNAME', $batch);
					$otherdb->where('SEMCODE', $semcode);
					$otherdb->where('FEESTATUS', '1');
					$query = $otherdb->get();
	
					return $query->result();
				  }
				elseif($nationality != 'Pakistani') 
				  {
					$otherdb = $this->load->database('otherdb', TRUE);
					$otherdb->select('REGNO, STUDENTNAME, BATCHNAME');
					$otherdb->from('tbl_allotreallot');		
					$otherdb->where('GENDER', $gender);
					$otherdb->where('PROTITTLE', $programechallan);
					$otherdb->where('NATIONALITY !=', 'Pakistani');
					$otherdb->where('BATCHNAME', $batch);
					$otherdb->where('SEMCODE', $semcode);
					$otherdb->where('FEESTATUS', '1');
					$query = $otherdb->get();
					
					return $query->result();
				  }
				 
		 }
		
	}
	
	function GetLastChallanno()
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('DISTINCT(CHALLANNO)');
		$otherdb->from('paychallan');
		$otherdb->order_by('CHALLANNO', 'DESC');
		$otherdb->limit('1');
		$query = $otherdb->get();
		
		return $query->result();
	}
	
	function NewGetLastChallanno()
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('DISTINCT(CHALLANNO) as challanno');
		$otherdb->from('tbl_newpaychallan');
		$otherdb->order_by('challanno', 'DESC');
		$otherdb->limit('1');
		$query = $otherdb->get();
		
		return $query->row();
	}
	
	function GetSecurityFeecodes($gender, $nationality, $programe, $batch, $assignfee)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('DISTINCT(FEECODE), FEEAMOUNT');
		$otherdb->from('hostelfeestructure');
		$otherdb->where('GENDER', $gender);
		$otherdb->where('NATIONALITY', $nationality);
		$otherdb->where('PROTITTLE', $programe);
		$otherdb->where('BATCHNAME', $batch);
		$otherdb->where('FEESTRUCSEM', $assignfee);
		$otherdb->where('FEETYPE', 'HOSTEL SECURITY');
		$otherdb->group_by('FEECODE', 'DESC');
		$query = $otherdb->get();
		
		return $query->result();
	}
	
	function GetFeecodes($gender, $nationality, $programe, $batch, $assignfee)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('DISTINCT(FEECODE), FEEAMOUNT');
		$otherdb->from('hostelfeestructure');
		$otherdb->where('GENDER', $gender);
		$otherdb->where('NATIONALITY', $nationality);
		$otherdb->where('PROTITTLE', $programe);
		$otherdb->where('BATCHNAME', $batch);
		$otherdb->where('FEESTRUCSEM', $assignfee);
		$otherdb->where('FEETYPE', 'HOSTEL FEE');
		$otherdb->group_by('FEECODE', 'DESC');
		$query = $otherdb->get();
		
		return $query->result();
	}
	
	function GetNewFeecodes($gender, $nationality, $programe, $batch, $assignfee)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('DISTINCT(FEECODE), FEEAMOUNT');
		$otherdb->from('hostelfeestructure');
		$otherdb->where('GENDER', $gender);
		$otherdb->where('NATIONALITY', $nationality);
		$otherdb->where('PROTITTLE', $programe);
		$otherdb->where('BATCHNAME', $batch);
		$otherdb->where('FEESTRUCSEM', $assignfee);
		$otherdb->where('FEETYPE', 'NEW HOSTEL FEE');
		$otherdb->group_by('FEECODE', 'DESC');
		$query = $otherdb->get();
		
		return $query->result();
	}
	
	function GetFeedesc($codefee)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('FEECODE, FEEDESC');
		$otherdb->from('feecodes');
		$otherdb->where('FEECODE', $codefee);
		$otherdb->group_by('FEECODE', 'DESC');
		$query = $otherdb->get();
		
		return $query->result();
	}
	
	function GetNewRegInfo($gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('SEMCODE');
		$otherdb->from('tbl_semester');
		$otherdb->where('GENDER', $gender);
		$otherdb->order_by('SMCODE', 'DESC');
		$otherdb->limit('1');
		$query = $otherdb->get();
		
		return $query->result();
	}
	
	function ViewBankInfo($gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
		$otherdb->from('bankdetail');
		$otherdb->where('GENDER', $gender);
		$otherdb->where('FEETYPE', 'HOSTEL FEE');
		$query = $otherdb->get();
		
		return $query->row();
	}
	
	function ViewBankSecInfo($gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
		$otherdb->from('bankdetail');
		$otherdb->where('GENDER', $gender);
		$otherdb->where('FEETYPE', 'HOSTEL SECURITY');
		$query = $otherdb->get();
		
		return $query->result();
	}
	
	function countfee($challanno, $csem)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('COUNT(*) as csum');
		$otherdb->from('paychallandetail');
		$otherdb->where('CURRENTSEMESTER', $csem);
		$otherdb->where('CHALLANNO', $challanno);
		$query = $otherdb->get();
		
		return $query->row();
	}
	
	function InsertHUserFee($HNorUFeeInfo)
      {
        $otherdb = $this->load->database('otherdb', TRUE);
		
		$otherdb->trans_start();
		
		$otherdb->insert('paychallandetail', $HNorUFeeInfo);
        
		$insert_id = $otherdb->insert_id();
        
        $otherdb->trans_complete();
        
        return $insert_id;
      }
	
	
	function InsertNorFeeInforegno($NorFeeDetailInforegno)
      {
        $otherdb = $this->load->database('otherdb', TRUE);
		
		$otherdb->trans_start();
		
		$otherdb->insert('paychallan', $NorFeeDetailInforegno);
        
		$insert_id = $otherdb->insert_id();
        
        $otherdb->trans_complete();
        
        return $insert_id;
      }
	  
	 function InsertNewFeeInforegno($NewFeeDetailInforegno)
      {
        $otherdb = $this->load->database('otherdb', TRUE);
		
		$otherdb->trans_start();
		
		$otherdb->insert('paychallan', $NewFeeDetailInforegno);
        
		$insert_id = $otherdb->insert_id();
        
        $otherdb->trans_complete();
        
        return $insert_id;
      }
	
	function InsertNorFeeInfo($NorFeeInfo)
      {
        $otherdb = $this->load->database('otherdb', TRUE);
		
		$otherdb->trans_start();
		
		$otherdb->insert('paychallan', $NorFeeInfo);
        
		$insert_id = $otherdb->insert_id();
        
        $otherdb->trans_complete();
        
        return $insert_id;
      }
	  
	  function InsertFeedescRegno($HNorFeeDetailRegno)
      {
        $otherdb = $this->load->database('otherdb', TRUE);
		$query = $otherdb->insert('paychallandetail', $HNorFeeDetailRegno);
        
        return TRUE;
      }
	
	function InsertFeedesc($HNorFeeExtInfo)
      {
        $otherdb = $this->load->database('otherdb', TRUE);
		$query = $otherdb->insert('paychallandetail', $HNorFeeExtInfo);
        
        return TRUE;
      }
	  
	function InsertNorFeeDetailInfo($NorFeeDetailInfo)
      {
        $otherdb = $this->load->database('otherdb', TRUE);
		$query = $otherdb->insert('paychallandetail', $NorFeeDetailInfo);
        
        return TRUE;
      }
	 function UpdateUserRegno($gender,$userId, $uinfo)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('userId',$userId);
		$otherdb->where('GENDER',$gender);
        $otherdb->update('tbl_users', $uinfo);
        
        return TRUE;
    }
	
	function UpdateFeedesc($HNorFeeExtInfo, $feedid)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('ID',$feedid);
        $otherdb->update('paychallandetail', $HNorFeeExtInfo);
        
        return TRUE;
    }
	
	function UpdateFeeNation($HNorFeeNation, $feeID)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('ID',$feeID);
        $otherdb->update('paychallan', $HNorFeeNation);
        
        return TRUE;
    }
	
	function UpdateUserFee($HNorUFeeInfo, $feeID, $csem, $regno, $challanno, $gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('PAYCHALLANID',$feeID);
		$otherdb->where('CURRENTSEMESTER',$csem);
		$otherdb->where('REGNO',$regno);
		$otherdb->where('CHALLANNO',$challanno);
		$otherdb->where('GENDER',$gender);
		$otherdb->where('FEECODE',17);
        $otherdb->update('paychallandetail', $HNorUFeeInfo);
        
        return TRUE;
    }
	
	function UpdateCovidSprFee($HNorUFeeInfo, $feeID, $csem, $regno, $challanno, $gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('PAYCHALLANID',$feeID);
		$otherdb->where('CURRENTSEMESTER',$csem);
		$otherdb->where('REGNO',$regno);
		$otherdb->where('CHALLANNO',$challanno);
		$otherdb->where('GENDER',$gender);
		$otherdb->where('FEECODE',103);
        $otherdb->update('paychallandetail', $HNorUFeeInfo);
        
        return TRUE;
    }
	
	function UpdateCovidSummerFee($HNorUFeeInfo, $feeID, $csem, $regno, $challanno, $gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('PAYCHALLANID',$feeID);
		$otherdb->where('CURRENTSEMESTER',$csem);
		$otherdb->where('REGNO',$regno);
		$otherdb->where('CHALLANNO',$challanno);
		$otherdb->where('GENDER',$gender);
		$otherdb->where('FEECODE',121);
        $otherdb->update('paychallandetail', $HNorUFeeInfo);
        
        return TRUE;
    }
	  
	  function UpdateNorFeeStructure($HNorFeeStruc, $feeid)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('id',$feeid);
        $otherdb->update('hostelfeestructure', $HNorFeeStruc);
        
        return TRUE;
    }
	
	function UpdateSecurityFeeStructure($HSecFeeStruc, $feeid)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('id',$feeid);
        $otherdb->update('hostelfeestructure', $HSecFeeStruc);
        
        return TRUE;
    }
	
	function UpdateNewFeeStructure($HSecFeeStruc, $feeid)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('id',$feeid);
        $otherdb->update('hostelfeestructure', $HSecFeeStruc);
        
        return TRUE;
    }
	
	function UpdateNorFeeChallan($HNorFeeInfo, $challanid)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('id',$challanid);
        $otherdb->update('paychallan', $HNorFeeInfo);
        
        return TRUE;
    }
	
	function UpdateSecurityFeeChallan($SecFeeInfo, $secid)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('ID',$secid);
        $otherdb->update('paychallandetail', $SecFeeInfo);
        
        return TRUE;
    }
	
	function UpdatePayFeeChallan($updatedfee, $challanid)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('PAYCHALLANID', $challanid);
		$otherdb->where('FEEDESC', 'Hostel User Charges');
        $otherdb->update('paychallandetail', $updatedfee);
        
        return TRUE;
    }
	
	function NorFeechallanExistregno($gender, $csemester, $assignfeestruc, $nationality, $protittle, $bname, $feetype, $duedate, $regno)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
		$otherdb->from('paychallan');
		$otherdb->where('GENDER', $gender);
		$otherdb->where('CURRENTSEMESTER', $csemester);
		$otherdb->where('FEESTRUCSEM', $assignfeestruc);
		$otherdb->where('NATIONALITY', $nationality);
		$otherdb->where('PROTITTLE', $protittle);
		$otherdb->where('FEETYPE', $feetype);
		$otherdb->where('BATCHNAME', $bname);
		$otherdb->where('REGNO', $regno);
		$query = $otherdb->get();
		
		return $query->result();
	}
	
	function NewFeechallanExistregno($gender, $csemester, $assignfeestruc, $nationality, $protittle, $bname, $feetype, $duedate, $regno)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
		$otherdb->from('paychallan');
		$otherdb->where('GENDER', $gender);
		$otherdb->where('CURRENTSEMESTER', $csemester);
		$otherdb->where('FEESTRUCSEM', $assignfeestruc);
		$otherdb->where('NATIONALITY', $nationality);
		$otherdb->where('PROTITTLE', $protittle);
		$otherdb->where('FEETYPE', $feetype);
		$otherdb->where('BATCHNAME', $bname);
		$otherdb->where('REGNO', $regno);
		$query = $otherdb->get();
		
		return $query->result();
	}
	
	function NorFeechallanExist($gender, $csemester, $assignfeestruc, $nationality, $programechallan, $feetype)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
		$otherdb->from('paychallan');
		$otherdb->where('GENDER', $gender);
		$otherdb->where('CURRENTSEMESTER', $csemester);
		$otherdb->where('FEESTRUCSEM', $assignfeestruc);
		$otherdb->where('NATIONALITY', $nationality);
		$otherdb->where('PROTITTLE', $programechallan);
		$otherdb->where('FEETYPE', $feetype);
		$query = $otherdb->get();
		
		return $query->result();
	}
	
	function ViewNornalFeeChallanDetail($feeID, $gender)
    {
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('paychallan.*, tbl_allotreallot.STUDENTNAME, tbl_allotreallot.FATHERNAME, tbl_allotreallot.FACULTY, tbl_allotreallot.DEPARTNAME, tbl_allotreallot.PROGRAME');
			$otherdb->from('paychallan');
			$otherdb->join('tbl_allotreallot', 'paychallan.REGNO = tbl_allotreallot.REGNO','INNER');
			$otherdb->where('paychallan.ID', $feeID);
			$otherdb->where('paychallan.GENDER', $gender);
			$query = $otherdb->get();
			$query1 = $otherdb->last_query();
			
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('paychallan.*, tbl_reallotment.STUDENTNAME, tbl_reallotment.FATHERNAME, tbl_reallotment.FACULTY, tbl_reallotment.DEPARTNAME, tbl_reallotment.PROGRAME');
			$otherdb->from('paychallan');
			$otherdb->join('tbl_reallotment', 'paychallan.REGNO = tbl_reallotment.REGNO','INNER');
			$otherdb->where('paychallan.ID', $feeID);
			$otherdb->where('paychallan.GENDER', $gender);
			$query = $otherdb->get();
			$query2 = $otherdb->last_query();
			
			$query = $otherdb->query($query1." UNION ".$query2);
			
			return $query->result();
		}
		
	function ViewNornalFeeChallanDesc($regno, $paychllanid, $gender)
    {
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('*');
			$otherdb->from('paychallandetail');
			$otherdb->where('REGNO', $regno);
			$otherdb->where('GENDER', $gender);
			$otherdb->where('PAYCHALLANID', $paychllanid);
			$otherdb->order_by('FEECODE', 'asc');
			$query = $otherdb->get();
			
			return $query->result();
	}
	
	function ViewNornalFeeChallanDescExten($regno, $paychllanid, $gender)
    {
		return $this->otherdb->where('REGNO', $regno)
					->where('GENDER', $gender)
					->where('PAYCHALLANID', $paychllanid)
					->where('FEECODE', 102)
					->order_by('FEECODE', 'asc')
					->get('paychallandetail')
					->result();
	}
	
	function ViewExtFeeChallan($regno, $paychllanid, $gender)
    {
		$query = $this->otherdb->where('REGNO', $regno)
						->where('GENDER', $gender)
						->where('PAYCHALLANID', $paychllanid)
						->where('FEECODE', 102)
						->order_by('FEECODE', 'asc')
						->get('paychallandetail');
			
		return $query->num_rows();
	}
	
	function ViewSecFeeChallanDesc($regno, $gender)
    {
		return $this->otherdb->where('REGNO', $regno)
					->where('GENDER', $gender)
					->where('FEETYPE', 'HOSTEL SECURITY')
					->order_by('id', 'desc')
					->limit('1')
					->get('paychallandetail')
					->result();
	}
	
	function ViewSecFine($regno, $gender)
    {
		return $this->otherdb->where('REGNO', $regno)
					->where('GENDER', $gender)
					->where('FEETYPE', 'HOSTEL SECURITY')
					->get('paychallan')
					->result();
	}
	
	function ViewSecurityFeeChallanDetail($feeID, $gender)
    {
		if($gender == 'Female')
	    {
		
					$otherdb = $this->load->database('otherdb', TRUE);
					$otherdb->select('paychallan.*, tbl_application.STUDENTNAME, tbl_application.FATHERNAME, tbl_application.FACULTY, tbl_application.DEPARTMENTNAME, tbl_application.PROGRAME');
					$otherdb->from('paychallan');
					$otherdb->join('tbl_application', 'paychallan.REGNO = tbl_application.REGNO','INNER');
					$otherdb->where('paychallan.ID', $feeID);
					$otherdb->where('paychallan.GENDER', $gender);
					$otherdb->where('tbl_application.STATUS', '1');
					$query = $otherdb->get();
					
					return $query->result();
		}
		if($gender == 'Male')
	    {
		
					$otherdb = $this->load->database('otherdb', TRUE);
					$otherdb->select('paychallan.*, tbl_maleapplication.STUDENTNAME, tbl_maleapplication.FATHERNAME, tbl_maleapplication.FACULTY, tbl_maleapplication.DEPARTMENTNAME, tbl_maleapplication.PROGRAME');
					$otherdb->from('paychallan');
					$otherdb->join('tbl_maleapplication', 'paychallan.REGNO = tbl_maleapplication.REGNO','INNER');
					$otherdb->where('paychallan.ID', $feeID);
					$otherdb->where('paychallan.GENDER', $gender);
					$otherdb->where('tbl_maleapplication.STATUS', '1');
					$query = $otherdb->get();
					
					return $query->result();
		}
		
	}
	
	function Getsecurityprograme($programelevel, $nationality, $gender, $semcode)
    {
	   if($gender == 'Female')
	    {		
		  if($programelevel == 'BS')
			 {
			   if($nationality == 'Pakistani')
				  {
					$otherdb = $this->load->database('otherdb', TRUE);
					$otherdb->select('distinct(BATCHNAME)');
					$otherdb->from('tbl_application');		
					$otherdb->where('GENDER', $gender);
					$otherdb->where('STATUS', 1);
					$otherdb->where('NATIONALITY', $nationality);
					$otherdb->where('BATCHNAME != ', '0');
					$where = "(PROTITTLE = 'BS' OR PROTITTLE = 'LLB' OR PROTITTLE = 'MA' OR PROTITTLE = 'MSC' OR PROTITTLE = 'Bachelor')";
					$otherdb->where($where);
					$otherdb->like('SEMESTERCODE', $semcode);
					$otherdb->group_by('BATCHNAME');
					$query = $otherdb->get();
					
					return $query->result();
				  }
				else
				  {
					$otherdb = $this->load->database('otherdb', TRUE);
					$otherdb->select('DISTINCT(BATCHNAME)');
					$otherdb->from('tbl_application');		
					$otherdb->where('GENDER', $gender);
					$otherdb->where('STATUS', 1);
					$otherdb->where('NATIONALITY !=', 'Pakistani');
					$otherdb->where('BATCHNAME != ', '0');
					$where = "(PROTITTLE = 'BS' OR PROTITTLE = 'LLB' OR PROTITTLE = 'MA' OR PROTITTLE = 'MSC' OR PROTITTLE = 'Bachelor')";
					$otherdb->where($where);
					$otherdb->like('SEMESTERCODE', $semcode);
					$query = $otherdb->get();
					
					return $query->result();
				  }
			 }
			 elseif($programelevel == 'MS')
			  {
				   if($nationality == 'Pakistani')
				  {
					$otherdb = $this->load->database('otherdb', TRUE);
					$otherdb->select('DISTINCT(BATCHNAME)');
					$otherdb->from('tbl_application');		
					$otherdb->where('GENDER', $gender);
					$otherdb->where('STATUS', 1);
					$otherdb->where('BATCHNAME != ', '0');
					$where = "(PROTITTLE = 'MS' OR PROTITTLE = 'MS/MPHILL' OR PROTITTLE = 'LLM')";
					$otherdb->where($where);
					$otherdb->where('NATIONALITY', $nationality);
					$otherdb->like('SEMESTERCODE', $semcode);
					$query = $otherdb->get();
					
					return $query->result();
				  }
				  else
				  {
					$otherdb = $this->load->database('otherdb', TRUE);
					$otherdb->select('DISTINCT(BATCHNAME)');
					$otherdb->from('tbl_application');		
					$otherdb->where('GENDER', $gender);
					$otherdb->where('STATUS', 1);
					$otherdb->where('BATCHNAME != ', '0');
					$where = "(PROTITTLE = 'MS' OR PROTITTLE = 'MS/MPHILL' OR PROTITTLE = 'LLM')";
					$otherdb->where($where);
					$otherdb->where('NATIONALITY !=', 'Pakistani');
					$otherdb->like('SEMESTERCODE', $semcode);
					$query = $otherdb->get();
					
					return $query->result();
				  }
			 }
			 elseif($programelevel == 'PHD')
			  {
				  if($nationality == 'Pakistani')
				  {
					$otherdb = $this->load->database('otherdb', TRUE);
					$otherdb->select('DISTINCT(BATCHNAME)');
					$otherdb->from('tbl_application');		
					$otherdb->where('GENDER', $gender);
					$otherdb->where('STATUS', 1);
					$otherdb->where('BATCHNAME != ', '0');
					$otherdb->like('PROTITTLE', $programelevel);
					$otherdb->where('NATIONALITY', $nationality);
					$otherdb->like('SEMESTERCODE', $semcode);
					$query = $otherdb->get();
					
					return $query->result();
				  }
				  else
				  {
					$otherdb = $this->load->database('otherdb', TRUE);
					$otherdb->select('DISTINCT(BATCHNAME)');
					$otherdb->from('tbl_application');		
					$otherdb->where('GENDER', $gender);
					$otherdb->where('STATUS', 1);
					$otherdb->where('BATCHNAME != ', '0');
					$otherdb->where('PROTITTLE', $programelevel);
					$otherdb->where('NATIONALITY !=', 'Pakistani');
					$otherdb->like('SEMESTERCODE', $semcode);
					$query = $otherdb->get();
					
					return $query->result();
				  }
			 }
		}
	 elseif($gender == 'Male')
	    {		
		  if($programelevel == 'BS')
			 {
			   if($nationality == 'Pakistani')
				  {
					$otherdb = $this->load->database('otherdb', TRUE);
					$otherdb->select('DISTINCT(BATCHNAME)');
					$otherdb->from('tbl_maleapplication');		
					$otherdb->where('GENDER', $gender);
					$otherdb->where('STATUS', 1);
					$otherdb->where('NATIONALITY', $nationality);
					$otherdb->where('BATCHNAME != ', '0');
					$where = "(PROTITTLE = 'BS' OR PROTITTLE = 'LLB' OR PROTITTLE = 'MA' OR PROTITTLE = 'MSC' OR PROTITTLE = 'Bachelor')";
					$otherdb->where($where);
					$otherdb->like('SEMESTERCODE', $semcode);
					$query = $otherdb->get();
					
					return $query->result();
				  }
				else
				  {
					$otherdb = $this->load->database('otherdb', TRUE);
					$otherdb->select('DISTINCT(BATCHNAME)');
					$otherdb->from('tbl_maleapplication');		
					$otherdb->where('GENDER', $gender);
					$otherdb->where('STATUS', 1);
					$otherdb->where('NATIONALITY !=', 'Pakistani');
					$otherdb->where('BATCHNAME != ', '0');
					$where = "(PROTITTLE = 'BS' OR PROTITTLE = 'LLB' OR PROTITTLE = 'MA' OR PROTITTLE = 'MSC' OR PROTITTLE = 'Bachelor')";
					$otherdb->where($where);
					$otherdb->like('SEMESTERCODE', $semcode);
					$query = $otherdb->get();
					
					return $query->result();
				  }
			 }
			 elseif($programelevel == 'MS')
			  {
				   if($nationality == 'Pakistani')
				  {
					$otherdb = $this->load->database('otherdb', TRUE);
					$otherdb->select('DISTINCT(BATCHNAME)');
					$otherdb->from('tbl_maleapplication');		
					$otherdb->where('GENDER', $gender);
					$otherdb->where('STATUS', 1);
					$otherdb->where('BATCHNAME != ', '0');
					$where = "(PROTITTLE = 'MS' OR PROTITTLE = 'MS/MPHILL')";
					$otherdb->where($where);
					$otherdb->where('NATIONALITY', $nationality);
					$otherdb->like('SEMESTERCODE', $semcode);
					$query = $otherdb->get();
					
					return $query->result();
				  }
				  else
				  {
					$otherdb = $this->load->database('otherdb', TRUE);
					$otherdb->select('DISTINCT(BATCHNAME)');
					$otherdb->from('tbl_maleapplication');		
					$otherdb->where('GENDER', $gender);
					$otherdb->where('STATUS', 1);
					$otherdb->where('BATCHNAME != ', '0');
					$where = "(PROTITTLE = 'MS' OR PROTITTLE = 'MS/MPHILL' OR PROTITTLE = 'LLM')";
					$otherdb->where($where);
					$otherdb->where('NATIONALITY !=', 'Pakistani');
					$otherdb->like('SEMESTERCODE', $semcode);
					$query = $otherdb->get();
					
					return $query->result();
				  }
			 }
			 elseif($programelevel == 'PHD')
			  {
				  if($nationality == 'Pakistani')
				  {
					$otherdb = $this->load->database('otherdb', TRUE);
					$otherdb->select('DISTINCT(BATCHNAME)');
					$otherdb->from('tbl_maleapplication');		
					$otherdb->where('GENDER', $gender);
					$otherdb->where('STATUS', 1);
					$otherdb->where('BATCHNAME != ', '0');
					$otherdb->where('PROTITTLE', $programelevel);
					$otherdb->where('NATIONALITY', $nationality);
					$otherdb->like('SEMESTERCODE', $semcode);
					$query = $otherdb->get();
					
					return $query->result();
				  }
				  else
				  {
					$otherdb = $this->load->database('otherdb', TRUE);
					$otherdb->select('DISTINCT(BATCHNAME)');
					$otherdb->from('tbl_maleapplication');		
					$otherdb->where('GENDER', $gender);
					$otherdb->where('STATUS', 1);
					$otherdb->where('BATCHNAME != ', '0');
					$otherdb->where('PROTITTLE', $programelevel);
					$otherdb->where('NATIONALITY !=', 'Pakistani');
					$otherdb->like('SEMESTERCODE', $semcode);
					$query = $otherdb->get();
					
					return $query->result();
				  }
			 }
		}
		
	}
	
	function NewExistFeeStructure($structuretype, $nationality, $program, $feestructuresemester, $gender)
    {
		return $this->otherdb->select('id')
					->where('structure_type', $structuretype)
					->where('nationality', $nationality)
					->where('program', $program)
					->where('fee_structure_semester', $feestructuresemester)
					->where('gender', $gender)
					->order_by('id', 'desc')
					->get('tbl_newfeestructure')
					->row();
	}
	 
	function NewExistFeeStructurebyId($structuretype, $nationality, $program, $feestructuresemester, $gender, $id)
    {
		return $this->otherdb->select('id')->where('structure_type', $structuretype)
					->where('nationality', $nationality)
					->where('program', $program)
					->where('fee_structure_semester', $feestructuresemester)
					->where('gender', $gender)
					->where('id !=', $id)
					->order_by('id', 'desc')
					->get('tbl_newfeestructure')
					->row();
	}
	
	function storeNewFeeStructure($data)
    {
		$this->otherdb->insert('tbl_newfeestructure', $data);
        
        return $this->otherdb->insert_id();
     }
	 
	function NewFeeStructureList($gender)
    {
		return $this->otherdb->where('gender', $gender)
					->where('status', 1)
					->order_by('id', 'asc')
					->get('tbl_newfeestructure')
					->result();
	}
	 
	 function NewEditFeeStructureInfo($id)
     {
		return $this->otherdb->where('id', $id)
					->order_by('id', 'desc')
					->get('tbl_newfeestructure')
					->row();
	 }
	 
	 function NewupdateFeeStructure($data, $id)
     {
		$this->otherdb->where('id',$id)->update('tbl_newfeestructure', $data);
        
        return $this->otherdb->affected_rows();
     }
	 
	 function NewFeeStructureHeadList($gender)
     {
		return $this->otherdb->select('tbl_feestructurehead.*, tbl_newfeestructure.fee_structure_semester, tbl_newfeestructure.structure_type, tbl_newfeestructure.nationality, tbl_newfeestructure.program, tbl_users.name')
					->from('tbl_feestructurehead')
					->where('tbl_feestructurehead.gender', $gender)
					->join('tbl_newfeestructure', 'tbl_newfeestructure.id = tbl_feestructurehead.new_fee_structure_id','inner')
					->join('tbl_users', 'tbl_users.userId = tbl_feestructurehead.createdBy','inner')
					->order_by('tbl_feestructurehead.id', 'asc')
					->get()
					->result();
	 }
	 
	function NewExistFeeStructureHead($fee_structure_semester, $headname, $headcode, $amount, $status, $gender)
    {
		return $this->otherdb->select('id')
					->where('new_fee_structure_id', $fee_structure_semester)
					->where('head_name', $headname)
					->where('head_code', $headcode)
					->where('amount', $amount)
					->where('status', $status)
					->where('gender', $gender)
					->order_by('id', 'desc')
					->get('tbl_feestructurehead')
					->row();
	}
	 
	 function NewExistFeeStructureHeadbyId($fee_structure_semester, $headname, $headcode, $amount, $status, $gender, $id)
     {
		return $this->otherdb->select('id')
					->where('new_fee_structure_id', $fee_structure_semester)
					->where('head_name', $headname)
					->where('head_code', $headcode)
					->where('amount', $amount)
					->where('status', $status)
					->where('gender', $gender)
					->where('id !=', $id)
					->order_by('id', 'desc')
					->get('tbl_feestructurehead')
					->row();
	 }
	 
	 function storeNewFeeStructureHead($data)
     {
		$this->otherdb->insert('tbl_feestructurehead', $data);
        
        return $this->otherdb->insert_id();
     }
	 
	 function NewEditHeadFeeStructureInfo($id)
     {
		return $this->otherdb->where('id', $id)
					->order_by('id', 'desc')
					->get('tbl_feestructurehead')
					->row();
	 }
	 
	 function NewupdateFeeStructureHead($data, $id)
     {
		$this->otherdb->where('id',$id)->update('tbl_feestructurehead', $data);
        
        return $this->otherdb->affected_rows();
     }
	 
	function CurrentSemester($gender)
    {
		return $this->otherdb->select('distinct(SEMCODE) as semcode')
					->where('GENDER', $gender)
					//->where('IS_ACTIVE','1')
					 ->limit('1')
					 ->order_by('SMCODE', 'DESC')
			    	->get('TBL_SEMESTER')
					->row();
	}
	
	function getChallanInfo($currentsem, $gender)
    {
		return $this->otherdb->where('gender', $gender)
					->where('fee_challan_csem', $currentsem)
					->get('tbl_feechallan_status')
					->result();
    }
	
	function GetFeestructureInfo($id)
    {
		return $this->otherdb->where('id', $id)
					->where('status', 1)
					->get('tbl_newfeestructure')
					->row();
    }
	
	function GetsingleregnoInfo($currentsemcode, $gender, $regno, $structsemcode)
    {
		$result = $this->otherdb->select('regno, hostelbatch')
						->where('gender', $gender)
						->where('semcode', $currentsemcode)
						->where('hostelbatch', $structsemcode)
						->where('regno', $regno)
				        ->get('tbl_allotreallot')
						->result();
		
		if(empty($result)){

			return $this->otherdb->select('regno, semcode as hostelbatch')
						->where('regno', $regno)
						->where('allottype like', 'A%')
						->order_by('ALLOTMENTHISTORY_ID', 'desc')
						->limit('1')
						->get('tbl_allotmenthistory')
						->result();
		}
		
		return $result;
       
    }
	
	function GetAllregnoInfo($currentsemcode, $gender, $structsemcode)
    {
		return $this->otherdb->select('regno, hostelbatch')
					->where('gender', $gender)
					->where('semcode', $currentsemcode)
					->where('hostelbatch', $structsemcode)
			        ->get('tbl_allotreallot')
					->result();
    }
	
	function GetstudinfoAljamia($regno)
    {
		$result = $this->db->select('REGNO, NATIONALITY, PROTITTLE')
						->where('REGNO', $regno)
						->get('TBL_HSTUDENTS')
						->row();

		if(empty($result)){
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('*');
				$otherdb->from('students');
				//$otherdb->where('IS_ACTIVE', 1);
				$otherdb->where('REGNO', $regno);				
				$query = $otherdb->get();
				$result = $query->result();
			}      
		//var_dump($result); exit();
			return $result;  		
	}
	
	function GetHistoryBatch($studregno, $structsemcode)
    {
		return $this->otherdb->select('tbl_allotmenthistory.regno')
					->where('tbl_allotmenthistory.regno', $studregno)
					->where('tbl_allotmenthistory.semcode', $structsemcode)
					->where('tbl_allotmenthistory.allottype like', 'A%')
					->order_by('tbl_allotmenthistory.ALLOTMENTHISTORY_ID', 'desc')
					->limit('1')
			        ->get('tbl_allotmenthistory')
					->row();
    }
	
	function InsertNewFeeChallan($data)
    {
		$this->otherdb->insert('tbl_newpaychallan', $data);

		return $this->otherdb->insert_id();
    }	
	  
	function StoreFeeChallanStatusInfo($data)
    {
        $this->otherdb->insert('tbl_feechallan_status', $data);

        return $this->otherdb->insert_id();
    }
	
	function CheckFeestatus($gender, $structsemcode, $feestructureid)
    {
		return $this->otherdb->select('total_challan')
					->where('gender', $gender)
					->where('fee_challan_csem', $structsemcode)
					->where('new_fee_structure_id', $feestructureid)
					->order_by('id', 'desc')
					->limit('1')
			        ->get('tbl_feechallan_status')
					->row();
    }
	
	function CheckFeestatusRegnowise($studpostregno, $gender, $csem, $feestructureid)
    {
		return $this->otherdb->select('regno')
					->where('gender', $gender)
					->where('regno', $studpostregno)
					->where('current_semester', $csem)
					->where('fee_structure_id', $feestructureid)
					->order_by('id', 'desc')
					->limit('1')
			        ->get('tbl_newpaychallan')
					->row();
    }
	
	function NeweditFeeChallan($id)
    {
		return $this->otherdb->where('id', $id)->get('tbl_feechallan_status')->row();
    }
	
	function NeweditFeeChallanByRegno($id)
    {
		return $this->otherdb->where('id', $id)->get('tbl_newpaychallan')->row();
       
    }
	
	function printFeeChallanByRegno($id)
    {
		return $this->otherdb->where('id', $id)->get('tbl_newpaychallan')->row();
    }
	
	function printAllotmentFeeChallanByRegno($studregno, $feetype, $semcode)
    {
		return $this->otherdb->where('regno', $studregno)
					->where('feetype', $feetype)
					->where('current_semester', $semcode)
					->where('publish', 1)
			        ->get('tbl_newpaychallan')
					->row();
    }
	
	function CheckFeeInfo($studregno, $gender, $csemcode)
    {
		return $this->otherdb->where('regno', $studregno)
					->where('current_semester', $csemcode)
					->where('gender', $gender)
					->where('publish', '1')
			        ->get('tbl_newpaychallan')
					->row();
    }
	
	function updateFeeInfo($NewEditFeeInfo, $id)
    {
		$this->otherdb->where('id',$id)->update('tbl_feechallan_status', $NewEditFeeInfo);
        
        return $this->otherdb->affected_rows();
    }
	
	function updateNewfine($fineinfo, $id)
    {
		$this->otherdb->where('id',$id)->update('tbl_newpaychallan', $fineinfo);
        
        return $this->otherdb->affected_rows();
    }
	
	function updateExistRegFeeInfo($NewEditFeeInfo, $feestructureid, $feenationality, $csem)
    {
		$this->otherdb->where('fee_structure_id', $feestructureid)
						->where('nationality',$feenationality)
						->where('current_semester', $csem)
						->where('extension is NULL')
				        ->update('tbl_newpaychallan', $NewEditFeeInfo);
        
        return $this->otherdb->affected_rows();
    }
	
	function NewviewFeeChallan($type, $feestructureid, $csem, $feenationality)
    {
		return $this->otherdb->where('nationality',$feenationality)
					->where('current_semester', $csem)
					->where('feetype', $type)
					->where('fee_structure_id', $feestructureid)
			        ->get('tbl_newpaychallan')
					->result();
    }
	
	function allfeechallan($csem, $gender)
    {
		return $this->otherdb->where('gender',$gender)
					->where('current_semester', $csem)
					->get('tbl_newpaychallan')
					->result();
    }
	
	function allReAllotmentfeechallan($csem, $gender, $regno)
    {
		$this->otherdb->where('gender',$gender)->where('feetype', 'HOSTEL RENEWAL FEE');

		if($regno != ''){
			$this->otherdb->where('regno', $regno);
		}

		if($csem != ''){
			$this->otherdb->where('current_semester', $csem);
		}	

		return $this->otherdb->get('tbl_newpaychallan')->result();
    }
	
	function allAllotmentfeechallan($csem, $gender)
    {
		return $this->otherdb->where('gender',$gender)
					->where('current_semester', $csem)
					->where('feetype', 'HOSTEL FEE')
					->get('tbl_newpaychallan')
					->result();       
    }
	
	function updateFeeInfobyRegno($data, $id)
    {
		$this->otherdb->where('id',$id)->update('tbl_newpaychallan', $data);
        
        return $this->otherdb->affected_rows();
    }
	
	function UpdatedNewFeeChallanStatus($data, $id)
    {
		$this->otherdb->where('id',$id)->update('tbl_feechallan_status', $data);
        
        return $this->otherdb->affected_rows();
    }
	
	function insertsecuritychallan($challaninfo)
    {
        $this->otherdb->insert('tbl_hostel_security', $challaninfo);
        
        return $this->otherdb->insert_id();
    }
	
	function GetStudAllotmentregnoInfo($studpostregno, $gender)
    {
        if($gender == 'Male'){
			$result = $this->otherdb->select('tbl_maleapplication.REGNO as regno')
						->where('tbl_maleapplication.REGNO', $studpostregno)
						->where('tbl_maleapplication.GENDER', $gender)
						->where('tbl_maleapplication.STATUS', 1)
						->get('tbl_maleapplication')
						->result();
		}
		elseif($gender == 'Female'){
			$result = $this->otherdb->select('tbl_application.regno as regno')
						->where('tbl_application.REGNO', $studpostregno)
						->where('tbl_application.GENDER', $gender)
						->where('tbl_application.STATUS', 1)
						->get('tbl_application')
						->result();
		}
		// var_dump($gender);
		// var_dump($studpostregno);
		// var_dump($result); exit();
      return $result; 
    }
	
	function CheckFeestatusRegno($regno, $gender, $csem, $feestructureid)
    {
		return $this->otherdb->select('regno')
					->where('regno', $regno)
					->where('gender', $gender)
					->where('current_semester', $csem)
					->where('fee_structure_id', $feestructureid)
					->order_by('id', 'desc')
					->limit('1')
			        ->get('tbl_newpaychallan')
					->row();
			       
    }
	
	function ExistFeeChallanStatus($feestructureid, $gender, $currentsemcode)
    {
		return $this->otherdb->select('id, total_challan')
					->where('new_fee_structure_id', $feestructureid)
					->where('gender', $gender)
					->where('fee_challan_csem', $currentsemcode)
					->order_by('id', 'desc')
					->limit('1')
			        ->get('tbl_feechallan_status')
					->row();
       
    }
	
	function securitychallanexist($regno, $semcode)
    {
		return $this->otherdb->select('regno,challanno,semcode')
					->where('regno', $regno)
					->where('semcode', $semcode)
					->order_by('id', 'desc')
					->limit('1')
			        ->get('tbl_hostel_security')		
					->row();
    }
	
	function getfeestructtype($feestructureid)
    {
		return $this->otherdb->select('structure_type')
					->where('id', $feestructureid)
					->get('tbl_newfeestructure')
					->row();
    }
	
	function getFeestudInfoAljamia($regno)
    {
		$result = $this->db->select('REGNO, STUDENTNAME, FATHERNAME, PROGRAME, CNIC, NATIONALITY')
					->where('REGNO', $regno)
					->get('TBL_HSTUDENTS')
					->row();	

		if(empty($result)){
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('*');
				$otherdb->from('students');
				//$otherdb->where('IS_ACTIVE', 1);
				$otherdb->where('REGNO', $regno);				
				$query = $otherdb->get();
				$result = $query->row();
			}      
		//var_dump($result); exit();
			return $result;	
	}
	
	function NewFeeStructureHeadListById($feestructureid)
    {
		return $this->otherdb->where('new_fee_structure_id', $feestructureid)
					->order_by('id', 'asc')
					->get('tbl_feestructurehead')
					->result();
	}
	 
	function GetAllAllotmentregnoInfo($gender, $startdate, $enddate)
    {
        if($gender == 'Male'){
			return $this->otherdb->select('tbl_maleapplication.REGNO as regno')
						->from('tbl_maleapplication')
						->where('tbl_maleapplication.GENDER', $gender)
						->where('tbl_maleapplication.STATUS', 1)
						->where('tbl_maleapplication.ADMINUPDATESTATUSDATE >=', $startdate)
						->where('tbl_maleapplication.ADMINUPDATESTATUSDATE <=', $enddate)
						->get()
						->result();
		}
		elseif($gender == 'Female'){
			
			return $this->otherdb->select('tbl_application.regno as regno')
						->where('tbl_application.GENDER', $gender)
						->where('tbl_application.STATUS', 1)
						->where('tbl_application.ADMINUPDATESTATUSDATE >=', $startdate)
						->where('tbl_application.ADMINUPDATESTATUSDATE <=', $enddate)
						->get('tbl_application')
						->result();
		}
       
    }
	
	function GetGenderByRegno($studregno)
    {
        $result = $this->db->select('REGNO, GENDER')
			        ->where('REGNO', $studregno)
			        ->get('TBL_HSTUDENTS')
			        ->row();

		if(empty($result)){
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('*');
				$otherdb->from('students');
				//$otherdb->where('IS_ACTIVE', 1);
				$otherdb->where('REGNO', $studregno);				
				$query = $otherdb->get();
				$result = $query->row();
			}      
		//var_dump($result); exit();
			return $result;
    }
}  