<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends CI_Model
{

	public function __construct(){

		$this->otherdb = $this->load->database('otherdb', TRUE);
		
	}
    
    function StudenListingCount($searchText = '')
    {
        $this->db->select('STUDENTNAME, REGNO, PROGRAME, DISTANCE, CGPA, STATUS, CREATEDDTM');
        $this->db->from('TBL_HOSTEL');
        //$this->db->join('TBL_ROLES', 'TBL_ROLES.ROLEID = TBL_USERS.ROLEID','left');
        if(!empty($searchText)) {
            $likeCriteria = "(TBL_HOSTEL.STUDENTNAME  LIKE '%".$searchText."%'
                            OR  TBL_HOSTEL.REGNO  LIKE '%".$searchText."%'
                            OR  TBL_HOSTEL.PROGRAME  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        //$this->db->where('TBL_USERS.ISDELETED', 0);
        //$this->db->where('TBL_USERS.ROLEID !=', 1);
        $query = $this->db->get();
        
        return count($query->result());
    }
    
    
    function StudentListing($searchText = '', $page, $segment, $programe, $semester)
    {
        //$this->db->select('STUDENTNAME, REGNO, PROGRAME, DISTANCE, CGPA, STATUS, CREATEDDTM');
		$this->db->select('*');
        $this->db->from('TBL_HOSTEL');
        //$this->db->join('TBL_ROLES', 'TBL_ROLES.ROLEID = TBL_USERS.ROLEID','left');
        if(!empty($searchText)) {
            $likeCriteria = "(TBL_HOSTEL.STUDENTNAME  LIKE '%".$searchText."%'
                            OR  TBL_HOSTEL.REGNO  LIKE '%".$searchText."%'
                            OR  TBL_HOSTEL.PROGRAME  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        //$this->db->where('TBL_USERS.ISDELETED', 0);
        //$this->db->where('TBL_USERS.ROLEID !=', 1);
		$this->db->where('PROTITTLE', $programe);
        $this->db->where('SEMESTERCODE LIKE',"%".$semester."%");
		$this->db->order_by('CREATEDDTM ASC');
        $this->db->limit($page, $segment);
        return $this->db->get()->result();        
    }
    
	function viewAllotinfo($gender, $hostelid, $roomid)
    {
		if($hostelid != NULL && $roomid != NULL)
		{
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_ALLOTMENT.*,TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_ROOM.FLOOR, TBL_SEAT.SEAT, TBL_SEAT.OCCUPIED');
        $otherdb->from('TBL_ALLOTMENT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER');
		$otherdb->where('TBL_ALLOTMENT.GENDER',$gender);
		$otherdb->where('TBL_ALLOTMENT.HOSTELID',$hostelid);
		$otherdb->where('TBL_ALLOTMENT.ROOMID',$roomid);
		
        $query =  $otherdb->get();
        
        return $query->result();
		
	    }
		else
			{
				$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_ALLOTMENT.*,TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_ROOM.FLOOR, TBL_SEAT.SEAT, TBL_SEAT.OCCUPIED');
        $otherdb->from('TBL_ALLOTMENT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER');
		$otherdb->where('TBL_ALLOTMENT.GENDER',$gender);
		$otherdb->where('TBL_ALLOTMENT.HOSTELID',$hostelid);
		//$otherdb->where('TBL_ALLOTMENT.ROOMID',$roomid);
		
        return  $otherdb->get()->result();
        
			}
    }
	
    /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
    function userinfo($userId)
    {
		return $this->otherdb->where('userId', $userId)->get('tbl_users')->result();
    }
	
	function Feestatus($regno,$semcode)
    {
		return $this->otherdb->where('REGNO', $regno)
					->where('SEMCODE', $semcode)
					->order_by('FEE_ID', 'DESC')
					->get('tbl_feestatus')
					->result();
    }
	
	function getalldefaulter($gender, $semcode)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('REGNO,STUDENTNAME,SEATID,ROOMID,HOSTELID');
        $otherdb->from('tbl_allotreallot');
		$otherdb->where('GENDER', $gender);
		$otherdb->where('SEMCODE', $semcode);
        $query = $otherdb->get();
        $result = $query->result();        
        return $result;
    }
	
	function CheckPictureOracle($regno)
    {
        $this->db->select('REGNO');
        $this->db->from('STUDENTPICTURELR');
		$this->db->where('REGNO', $regno);
		$query =  $this->db->get();
        
        return $result = $query->result();
		
    }		
	
	
	function getBatch($regno)
    {
        $this->db->select('BATCHNAME, REGNO, BATCHCODE');
        $this->db->from('TBL_HSTUDENTS');
		$this->db->where('TBL_HSTUDENTS.REGNO', $regno);
		$query =  $this->db->get();
        
        return $query->result();
    }
	
	function updatreallotstatus($updatereallot,$regno,$gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('REGNO',$regno);
		$otherdb->where('GENDER',$gender);
        $otherdb->update('tbl_allotreallot', $updatereallot);
        
        return $otherdb->affected_rows();
    }
	
	function UpdatEmailInfo($userInfo, $userId)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('userId',$userId);
        $otherdb->update('tbl_users', $userInfo);
        
        return $otherdb->affected_rows();
    }
	
	function SeatChangeRecord($gender,$semester,$hostel)
    {
		if($gender =='Male')
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('tbl_seatchangemale.MCHANGE_ID,tbl_seatchangemale.REGNO,tbl_seatchangemale.STUDENTNAME,tbl_seatchangemale.CHOSTEL,tbl_hostel.HOSTEL_NO AS HOSTEL1,tbl_seatchangemale.CROOM,tbl_seatchangemale.CSEAT,tbl_seatchangemale.ROOM1 AS NROOM,tbl_seatchangemale.SEAT1 AS NSEAT,tbl_seatchangemale.SEMCODE,tbl_seatchangemale.GENDER,tbl_seatchangemale.STATUS,tbl_seatchangemale.CREATEDDTM,TBL_ROOM.ROOMDESC AS ROOM1,TBL_SEAT.SEAT AS SEAT1');
			$otherdb->from('tbl_seatchangemale');
			$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = tbl_seatchangemale.HOSTEL1','INNER');
			$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = tbl_seatchangemale.ROOM1','INNER');
		    $otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = tbl_seatchangemale.SEAT1','INNER');
			$otherdb->where('tbl_seatchangemale.GENDER', $gender);
			$otherdb->where('tbl_seatchangemale.SEMCODE', $semester);
			if(!empty($hostel)){
				$otherdb->where('tbl_seatchangemale.CHOSTEL', $hostel);
			}
			$otherdb->order_by('tbl_seatchangemale.CREATEDDTM', 'ASC');
			$query = $otherdb->get();
			$result = $query->result();        
			return $result;
		}
		elseif($gender == 'Female')
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('tbl_appseatchangefmale.FCHANGE_ID,tbl_appseatchangefmale.REGNO,tbl_appseatchangefmale.STUDENTNAME,tbl_appseatchangefmale.CHOSTEL,tbl_appseatchangefmale.HOSTEL1,tbl_appseatchangefmale.CROOM,tbl_appseatchangefmale.CSEAT,tbl_appseatchangefmale.ROOM1 AS NROOM,tbl_appseatchangefmale.SEAT1 AS NSEAT,tbl_appseatchangefmale.SEMCODE,tbl_appseatchangefmale.GENDER,tbl_appseatchangefmale.STATUS,tbl_appseatchangefmale.CREATEDDTM,TBL_ROOM.ROOMDESC AS ROOM1,TBL_SEAT.SEAT AS SEAT1');
			$otherdb->from('tbl_appseatchangefmale');
			$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = tbl_appseatchangefmale.ROOM1','INNER');
		    $otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = tbl_appseatchangefmale.SEAT1','INNER');
			$otherdb->where('tbl_appseatchangefmale.GENDER', $gender);
			$otherdb->where('tbl_appseatchangefmale.SEMCODE', $semester);
			$otherdb->where('tbl_appseatchangefmale.CHOSTEL', $hostel);
			$otherdb->order_by('tbl_appseatchangefmale.CREATEDDTM', 'ASC');
			$query = $otherdb->get();
			$result = $query->result();        
			return $result;

		}
    }
	
	function SeatInterChangeRecord($gender,$semester)
    {
		if($gender =='Male')
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('*');
			$otherdb->from('tbl_seatchangemale');//tbl_seatchangemale
			$otherdb->where('GENDER', $gender);
			$otherdb->where('SEMCODE', $semester);
			$otherdb->order_by('CREATEDDTM', 'ASC');
			$query = $otherdb->get();
			$result = $query->result();        
			return $result;
		}
		elseif($gender == 'Female')
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('tbl_appseatswapfmale.*');
			$otherdb->from('tbl_appseatswapfmale');
			$otherdb->where('GENDER =', $gender);
			$otherdb->where('SEMCODE', $semester);
			$otherdb->order_by('CREATEDDTM', 'ASC');
			$query = $otherdb->get();
			$result = $query->result();        
			return $result;

		}
    }
		
	function CheckStudInfo($gender,$studregno)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('REGNO');
        $otherdb->from('tbl_reallotment');
		$otherdb->where('REGNO', $studregno);
		$otherdb->where('GENDER', $gender);
        $query = $otherdb->get();
        
		$result = $query->result();        
        return $result;
    }
	
	function fee_exists($regno)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('FEEPIC');
        $otherdb->from('tbl_reallotment');
		$otherdb->where('REGNO', $regno);
        $query = $otherdb->get();
        
		$result = $query->result();        
        return $result;
    }
	
	function reallot_exists($regno)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('REGNO');
        $otherdb->from('tbl_reallotment');
		$otherdb->where('REGNO', $regno);
        $query = $otherdb->get();
        
		$result = $query->result();        
        return $result;
    }
	
	function GetAllHistory($gender,$studregno)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
        $otherdb->from('TBL_ALLOTREALLOT');
		$otherdb->where('REGNO', $studregno);
		$otherdb->where('GENDER', $gender);
		$otherdb->order_by('ID', 'DESC');
        $otherdb->limit('1');
		$query = $otherdb->get();
        
		$result = $query->result();
		
		if(empty($result))
		  {
			    $otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('*');
				$otherdb->from('TBL_REALLOTMENT');
				$otherdb->where('REGNO', $studregno);
				$otherdb->where('GENDER', $gender);
				$query = $otherdb->get();
				
				$result = $query->result();
				if(empty($result))
		         {
					$otherdb = $this->load->database('otherdb', TRUE);
					$otherdb->select('*');
					$otherdb->from('TBL_ALLOTMENT');
					$otherdb->where('REGNO', $studregno);
					$otherdb->where('GENDER', $gender);
					$query = $otherdb->get();
					
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
		   return $result;
    }
	
	function Loginuserinfo($genderId)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('gender,name');
        $otherdb->from('tbl_users');
		$otherdb->where('userId', $genderId);
        $query = $otherdb->get();
        $result = $query->result();        
        return $result;
    }
    
    function getroombyHostelId($hostelid)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
		$otherdb->from('TBL_ROOM');
		$otherdb->where('HOSTELID', $hostelid);
		$otherdb->order_by("ROOMDESC","ASC");
        $query = $otherdb->get();
		return $query->result();
       
    }
	
	function getdeptbyfacId($facid)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
		$otherdb->from('TBL_DEPARTMENT');
		$otherdb->where('FACULTY_ID', $facid);
        $query = $otherdb->get();
		return $query->result();
       
    }
	
    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewUser($userInfo)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->insert('tbl_users', $userInfo);
        
        return $otherdb->insert_id();
       
    }
	
	 function GetAllHostel($gender)
    {	
        
		$otherdb = $this->load->database('otherdb', TRUE);	
		$otherdb->select('*');
        $otherdb->from('TBL_HOSTEL');
		$otherdb->where('GENDER', $gender);
        $query = $otherdb->get();
        $result = $query->result();
		        
        return $result;

    }
	
	 function getallotslip($gender)
    {	
        
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_ALLOTMENT.ALLOTMENT_ID,TBL_ALLOTMENT.REGNO,TBL_ALLOTMENT.STUDENTNAME,TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_ROOM.FLOOR, TBL_ALLOTMENT.ADDRESS, TBL_ALLOTMENT.CADDRESS, TBL_SEAT.SEAT, TBL_SEAT.OCCUPIED, TBL_USERS.email, TBL_USERS.mobile, TBL_ALLOTMENT.COUNTRY, TBL_ALLOTMENT.PROVINCE');
        $otherdb->from('TBL_ALLOTMENT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER');
		$otherdb->join('TBL_USERS', 'TBL_USERS.userId = TBL_ALLOTMENT.EMAILID','INNER');
		$otherdb->where('TBL_ALLOTMENT.GENDER',$gender);
		//$otherdb->where('TBL_ALLOTMENT.IS_SUBMIT',1);
		//$otherdb->where('TBL_ALLOTMENT.ADMIN_VERIFY',1);
		//$otherdb->where('TBL_SEAT.OCCUPIED',1);
		//$otherdb->order_by('TBL_HOSTEL.HOSTEL_NO');
		$otherdb->get();
        
        $query1 =  $otherdb->last_query();
		
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_REALLOTMENT.REALLOTMENT_ID,TBL_REALLOTMENT.REGNO,TBL_REALLOTMENT.STUDENTNAME,TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_ROOM.FLOOR, TBL_REALLOTMENT.ADDRESS, TBL_REALLOTMENT.CADDRESS, TBL_SEAT.SEAT, TBL_SEAT.OCCUPIED, TBL_USERS.email,TBL_USERS.mobile, TBL_REALLOTMENT.COUNTRY, TBL_REALLOTMENT.PROVINCE');
        $otherdb->from('TBL_REALLOTMENT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_REALLOTMENT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_REALLOTMENT.ROOMID','INNER');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_REALLOTMENT.SEATID','INNER');
		$otherdb->join('TBL_USERS', 'TBL_USERS.userId = TBL_REALLOTMENT.EMAILID','INNER');
		$otherdb->where('TBL_REALLOTMENT.GENDER',$gender);
		//$otherdb->where('TBL_REALLOTMENT.IS_SUBMIT',1);
		//$otherdb->where('TBL_REALLOTMENT.ADMIN_VERIFY',1);
		//$otherdb->where('TBL_SEAT.OCCUPIED',1);
		$otherdb->order_by('HOSTEL_NO','ASC');
		$otherdb->order_by('ROOMDESC','ASC');
		$otherdb->get();
		
		$query2 =  $otherdb->last_query();
		
	    $query = $otherdb->query($query1." UNION ".$query2);
		
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
	
	function getHostelInfo($hostelno)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('HOSTELId',$hostelno);
		$otherdb->select('HOSTELDESC');
        $otherdb->from('TBL_HOSTEL');
		
        $query =  $otherdb->get();
		
        return $query->row();
    }
	
	function getlastsemester($gender)
    {	
        
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('distinct(SEMCODE), TBL_SEMESTER.*');
        $otherdb->from('TBL_SEMESTER');
		$otherdb->where('GENDER',$gender);
		$otherdb->order_by('SMCODE','desc');
		$otherdb->limit('1');
        $query =  $otherdb->get();
        
        return $query->result();


    }
	
function getsemester($gender)
    {	
        
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('distinct(SEMCODE), TBL_SEMESTER.*');
        $otherdb->from('TBL_SEMESTER');
		$otherdb->where('GENDER',$gender);
		$otherdb->order_by('SMCODE','desc');
        $query =  $otherdb->get();
        
        return $query->result();


    }
	function gethosteldetail($gender)
    {	
        
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('*');
        $otherdb->from('TBL_HOSTEL');
		$otherdb->where('GENDER',$gender);
        $query =  $otherdb->get();
        
        return $query->result();


    }
	

	
	function getallotslipbyId($gender,$ALLOTMENT_ID)
    {	
        
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_ALLOTMENT.*, TBL_ALLOTMENT.ALLOTMENT_ID AS ID, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_ROOM.FLOOR, TBL_SEAT.SEAT, TBL_SEAT.OCCUPIED');
        $otherdb->from('TBL_ALLOTMENT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER');
		$otherdb->where('TBL_ALLOTMENT.GENDER',$gender);
		$otherdb->where('TBL_ALLOTMENT.IS_SUBMIT',1);
		$otherdb->where('TBL_ALLOTMENT.ADMIN_VERIFY',1);
		$otherdb->where('TBL_ALLOTMENT.ALLOTMENT_ID',$ALLOTMENT_ID);
		//$otherdb->order_by('TBL_HOSTEL.HOSTEL_NO');
        $query =  $otherdb->get();
		
		$result = $query->result();
        if(empty($result))
		{
			 $otherdb->select('TBL_REALLOTMENT.*, TBL_REALLOTMENT.REALLOTMENT_ID AS ID, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_ROOM.FLOOR, TBL_SEAT.SEAT, TBL_SEAT.OCCUPIED');
        $otherdb->from('TBL_REALLOTMENT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_REALLOTMENT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_REALLOTMENT.ROOMID','INNER');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_REALLOTMENT.SEATID','INNER');
		$otherdb->where('TBL_REALLOTMENT.GENDER',$gender);
		$otherdb->where('TBL_REALLOTMENT.IS_SUBMIT',1);
		$otherdb->where('TBL_REALLOTMENT.ADMIN_VERIFY',1);
		$otherdb->where('TBL_REALLOTMENT.REALLOTMENT_ID',$ALLOTMENT_ID);
        $query =  $otherdb->get();
		
		return $query->result();
		 
		}
		else
		{
          return $result;
		}
    }
	
	function getallotslipbyEmailId($gender,$emailid)
    {	
        
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_REALLOTMENT.REALLOTMENT_ID,TBL_REALLOTMENT.GENDER,TBL_REALLOTMENT.SEMCODE,TBL_REALLOTMENT.REGNO,TBL_REALLOTMENT.STUDENTNAME,TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_ROOM.FLOOR, TBL_SEAT.SEAT, TBL_SEAT.OCCUPIED');
        $otherdb->from('TBL_REALLOTMENT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_REALLOTMENT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_REALLOTMENT.ROOMID','INNER');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_REALLOTMENT.SEATID','INNER');
		$otherdb->where('TBL_REALLOTMENT.GENDER',$gender);
		$otherdb->where('TBL_REALLOTMENT.IS_SUBMIT',1);
		$otherdb->where('TBL_REALLOTMENT.ADMIN_VERIFY',1);
		$otherdb->where('TBL_REALLOTMENT.EMAILID',$emailid);
		$otherdb->order_by('TBL_REALLOTMENT.REALLOTMENT_ID', 'DESC');
		
        $query =  $otherdb->get();
		
		$query = $query->result();
		if(!empty($query))
		{
			return $query;
		}
		
		elseif(empty($query))
		{
			$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_ALLOTMENT.ALLOTMENT_ID,TBL_ALLOTMENT.GENDER,TBL_ALLOTMENT.SEMCODE,TBL_ALLOTMENT.REGNO,TBL_ALLOTMENT.STUDENTNAME,TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_ROOM.FLOOR, TBL_SEAT.SEAT, TBL_SEAT.OCCUPIED');
        $otherdb->from('TBL_ALLOTMENT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER');
		$otherdb->where('TBL_ALLOTMENT.GENDER',$gender);
		$otherdb->where('TBL_ALLOTMENT.IS_SUBMIT',1);
		$otherdb->where('TBL_ALLOTMENT.ADMIN_VERIFY',1);
		$otherdb->where('TBL_ALLOTMENT.EMAILID',$emailid);
		$otherdb->order_by('TBL_ALLOTMENT.ALLOTMENT_ID', 'DESC');
		
        $query =  $otherdb->get();
		
		$query = $query->result();

		}
		if(!empty($query))
		{
			return $query->result();
		}
		elseif(empty($query))
		{
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_ALLOTREALLOT.ID,TBL_ALLOTREALLOT.GENDER,TBL_ALLOTREALLOT.SEMCODE,TBL_ALLOTREALLOT.REGNO,TBL_ALLOTREALLOT.STUDENTNAME,TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_ROOM.FLOOR, TBL_SEAT.SEAT, TBL_SEAT.OCCUPIED');
        $otherdb->from('TBL_ALLOTREALLOT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTREALLOT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTREALLOT.ROOMID','INNER');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTREALLOT.SEATID','INNER');
		$otherdb->where('TBL_ALLOTREALLOT.GENDER',$gender);
		$otherdb->where('TBL_ALLOTREALLOT.IS_SUBMIT',1);
		$otherdb->where('TBL_ALLOTREALLOT.ADMIN_VERIFY',1);
		$otherdb->where('TBL_ALLOTREALLOT.EMAILID',$emailid);
		$otherdb->order_by('TBL_ALLOTREALLOT.ID', 'DESC');
		$otherdb->limit(1);
		
        $query =  $otherdb->get();
        
        return $query->result();
		}

    }
	
	function acadprograme($regno)
    {
  
		$this->db->select('PROGRAME,FACULTY');
        $this->db->from('TBL_HSTUDENTS');
		$this->db->where('REGNO',$regno);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
	
	function getstudInfo($gender, $hostelno, $semester)
    {
  		if($hostelno == 'All' && $semester == 'All')
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('TBL_ALLOTMENTHISTORY.*,TBL_SEAT.SEAT,TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE');
			$otherdb->from('TBL_ALLOTMENTHISTORY');
			$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENTHISTORY.SEATID','INNER');
			$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENTHISTORY.HOSTELID','INNER');
			$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENTHISTORY.ROOMID','INNER');
			$otherdb->where('TBL_ALLOTMENTHISTORY.GENDER',$gender);
			$otherdb->group_by('TBL_ALLOTMENTHISTORY.REGNO');
			$otherdb->order_by('TBL_ALLOTMENTHISTORY.ALLOTMENTHISTORY_ID', 'DESC');
			$query =  $otherdb->get();
			
			return $query->result();
		}
		elseif($hostelno != 'All' && $semester != 'All')
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('TBL_ALLOTMENTHISTORY.*,TBL_SEAT.SEAT,TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE');
			$otherdb->from('TBL_ALLOTMENTHISTORY');
			$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENTHISTORY.SEATID','INNER');
			$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENTHISTORY.HOSTELID','INNER');
			$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENTHISTORY.ROOMID','INNER');
			$otherdb->where('TBL_ALLOTMENTHISTORY.GENDER',$gender);
			$otherdb->where('TBL_ALLOTMENTHISTORY.HOSTELID',$hostelno);
			$otherdb->where('TBL_ALLOTMENTHISTORY.SEMCODE',$semester);
			$otherdb->group_by('TBL_ALLOTMENTHISTORY.REGNO');
			$otherdb->order_by('TBL_ALLOTMENTHISTORY.ALLOTMENTHISTORY_ID', 'DESC');
			$query =  $otherdb->get();
			
			return $query->result();
		}
		elseif($hostelno != 'All' && $semester == 'All')
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('TBL_ALLOTMENTHISTORY.*,TBL_SEAT.SEAT,TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE');
			$otherdb->from('TBL_ALLOTMENTHISTORY');
			$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENTHISTORY.SEATID','INNER');
			$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENTHISTORY.HOSTELID','INNER');
			$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENTHISTORY.ROOMID','INNER');
			$otherdb->where('TBL_ALLOTMENTHISTORY.GENDER',$gender);
			$otherdb->where('TBL_ALLOTMENTHISTORY.HOSTELID',$hostelno);
			$otherdb->group_by('TBL_ALLOTMENTHISTORY.REGNO');
			$otherdb->order_by('TBL_ALLOTMENTHISTORY.ALLOTMENTHISTORY_ID', 'DESC');
			$query =  $otherdb->get();
			
			return $query->result();
		}
		elseif($hostelno == 'All' && $semester != 'All')
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('TBL_ALLOTMENTHISTORY.*,TBL_SEAT.SEAT,TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE');
			$otherdb->from('TBL_ALLOTMENTHISTORY');
			$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENTHISTORY.SEATID','INNER');
			$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENTHISTORY.HOSTELID','INNER');
			$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENTHISTORY.ROOMID','INNER');
			$otherdb->where('TBL_ALLOTMENTHISTORY.GENDER',$gender);
			$otherdb->where('TBL_ALLOTMENTHISTORY.SEMCODE',$semester);
			$otherdb->group_by('TBL_ALLOTMENTHISTORY.REGNO');
			$otherdb->order_by('TBL_ALLOTMENTHISTORY.ALLOTMENTHISTORY_ID', 'DESC');
			$query =  $otherdb->get();
			
			return $query->result();
		}
	}
	
	function getallaot($gender, $hostelno, $semester)
    {
  		if($hostelno == 'All' && $semester == 'All')
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('TBL_ALLOTREALLOT.*,TBL_SEAT.SEAT,TBL_HOSTEL.HOSTEL_NO,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE');
			$otherdb->from('TBL_ALLOTREALLOT');
			$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTREALLOT.SEATID','INNER');
			$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTREALLOT.HOSTELID','INNER');
			$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTREALLOT.ROOMID','INNER');
			$otherdb->where('TBL_ALLOTREALLOT.GENDER',$gender);
			$query =  $otherdb->get();
			
			return $query->result();
		}
		// elseif($hostelno == 'All' && $semester != 'All')
		// {
		// 	$otherdb = $this->load->database('otherdb', TRUE);
		// 	$otherdb->select('TBL_ALLOTREALLOT.*,TBL_SEAT.SEAT,TBL_HOSTEL.HOSTEL_NO,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE');
		// 	$otherdb->from('TBL_ALLOTREALLOT');
		// 	$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTREALLOT.SEATID','INNER');
		// 	$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTREALLOT.HOSTELID','INNER');
		// 	$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTREALLOT.ROOMID','INNER');
		// 	$otherdb->where('TBL_ALLOTREALLOT.GENDER',$gender);
		// 	$otherdb->where('TBL_ALLOTREALLOT.SEMCODE',$semester);
		// 	$query =  $otherdb->get();
			
		// 	return $query->result();
		// }
		
		elseif($hostelno == 'All' && $semester != 'All')
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('TBL_ALLOTREALLOT.*,TBL_SEAT.SEAT,TBL_HOSTEL.HOSTEL_NO,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE');
			$otherdb->from('TBL_ALLOTREALLOT');
			$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTREALLOT.SEATID','INNER');
			$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTREALLOT.HOSTELID','INNER');
			$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTREALLOT.ROOMID','INNER');
			$otherdb->where('TBL_ALLOTREALLOT.GENDER',$gender);
			$otherdb->where('TBL_ALLOTREALLOT.SEMCODE',$semester);
			//$otherdb->where('TBL_ALLOTREALLOT.HOSTELID',$hostelno);
			$query =  $otherdb->get();
			
			return $query->result();
		}
		
		elseif($hostelno != 'All' && $semester != 'All')
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('TBL_ALLOTREALLOT.*,TBL_SEAT.SEAT,TBL_HOSTEL.HOSTEL_NO,TBL_ROOM.ROOMDESC,TBL_ROOM.ROOMTYPE');
			$otherdb->from('TBL_ALLOTREALLOT');
			$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTREALLOT.SEATID','INNER');
			$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTREALLOT.HOSTELID','INNER');
			$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTREALLOT.ROOMID','INNER');
			$otherdb->where('TBL_ALLOTREALLOT.GENDER',$gender);
			$otherdb->where('TBL_ALLOTREALLOT.SEMCODE',$semester);
			$otherdb->where('TBL_ALLOTREALLOT.HOSTELID',$hostelno);
			$query =  $otherdb->get();

			//echo $otherdb->last_query();
			
			return $query->result();
		}
    }
	
	function cancelseat($updateseat,$seatid,$gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('SEATID',$seatid);
		$otherdb->where('GENDER',$gender);
        $otherdb->update('tbl_seat', $updateseat);
        
        return $otherdb->affected_rows();
    }
	
	function cancelstudinfo($gender, $semcode)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('GENDER',$gender);
		$otherdb->where('SEMCODE',$semcode);
		$otherdb->where('ADMIN_VERIFY',0);
		$otherdb->select('*');
        $otherdb->from('tbl_allotreallot');
		
        $query =  $otherdb->get();
		
        return $query->result();
    }
    
    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getStudentInfo($programe, $semester, $gender)
    {	
        if($gender == 'Female')
		{
			if($programe == 'Bachelor')
			{
				$otherdb = $this->load->database('otherdb', TRUE);	
				$otherdb->select('*');
				$otherdb->from('TBL_APPLICATION');
				$query = $otherdb->where('PROTITTLE NOT LIKE', 'MS');
				$query = $otherdb->where('PROTITTLE NOT LIKE', 'LLM');
				$query = $otherdb->where('PROTITTLE NOT LIKE', 'MS/MPHILL');
				$query = $otherdb->where('PROTITTLE NOT LIKE', 'PhD');
				$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
				$query = $otherdb->where('GENDER', $gender);
				$otherdb->group_by('REGNO');
				$query = $otherdb->ORDER_BY('CREATEDDTM ASC');
				$query = $otherdb->ORDER_BY('DISTANCE ASC');
				$query = $otherdb->get();
				$result = $query->result();
						
				return $result;
			}
			elseif($programe == 'MS/MPHILL')
			{
				$otherdb = $this->load->database('otherdb', TRUE);	
				$otherdb->select('*');
				$otherdb->from('TBL_APPLICATION');
				$query = $otherdb->where('PROTITTLE !=', 'BS');
				$query = $otherdb->where('PROTITTLE !=', 'MSC');
				$query = $otherdb->where('PROTITTLE !=', 'MA');
				$query = $otherdb->where('PROTITTLE !=', 'Bachelor');
				$query = $otherdb->where('PROTITTLE !=', 'LLB');
				$query = $otherdb->where('PROTITTLE !=', 'P%');
				$query = $otherdb->where('PROTITTLE !=', 'PhD');
				$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
				$query = $otherdb->where('GENDER', $gender);
				$otherdb->group_by('REGNO');
				$query = $otherdb->ORDER_BY('CREATEDDTM ASC');
				$query = $otherdb->ORDER_BY('DISTANCE ASC');
				$query = $otherdb->get();
				$result = $query->result();
						
				return $result;
			}
			
			elseif($programe == 'PhD' || $programe == 'PHD')
			{
				$otherdb = $this->load->database('otherdb', TRUE);	
				$otherdb->select('*');
				$otherdb->from('TBL_APPLICATION');
				$otherdb->where('PROTITTLE', 'PhD');
				$otherdb->where('PROTITTLE LIKE',"%".'P'."%");
				$otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
				$otherdb->where('GENDER', $gender);
				$otherdb->group_by('REGNO');
				$otherdb->ORDER_BY('CREATEDDTM ASC');
				$otherdb->ORDER_BY('DISTANCE ASC');
				
				$query = $otherdb->get();
				$result = $query->result();
						
				return $result;
			}
		}
		elseif($gender == 'Male')
		{
			if($programe == 'Bachelor'|| $programe == 'BS')
			{
						$otherdb = $this->load->database('otherdb', TRUE);	
						$otherdb->select('*');
						$otherdb->from('TBL_MALEAPPLICATION');
						$otherdb->where("(PROTITTLE LIKE '%".'BS'."%' OR PROTITTLE LIKE '%".'MSC'."%' OR PROTITTLE LIKE '%".'LLB'."%' OR PROTITTLE LIKE '%".'MA'."%')", NULL, FALSE);
						$otherdb->where('GENDER', $gender);
						$otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
						$otherdb->ORDER_BY('CREATEDDTM ASC');
						$otherdb->ORDER_BY('DISTANCE ASC');
						$otherdb->group_by('REGNO');
						
						$query = $otherdb->get();
						$result = $query->result();
								
						return $result;
			}
			elseif($programe == 'MS/MPHILL' || $programe == 'MS')
					{
						
						$otherdb = $this->load->database('otherdb', TRUE);	
						$otherdb->select('*');
						$otherdb->from('TBL_MALEAPPLICATION');
						$otherdb->or_where('PROTITTLE', 'MS');
						$otherdb->or_where('PROTITTLE', 'LLM');
						$otherdb->where('GENDER', $gender);
						$otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
						$otherdb->ORDER_BY('CREATEDDTM ASC');
						$otherdb->ORDER_BY('DISTANCE ASC');
						$otherdb->group_by('REGNO');
						
						$query = $otherdb->get();
						$result = $query->result();
								
						return $result;
					}
			elseif($programe == 'PhD' || $programe == 'PHD')
					{
						$otherdb = $this->load->database('otherdb', TRUE);	
						$otherdb->select('*');
						$otherdb->from('TBL_MALEAPPLICATION');
						$otherdb->where('PROTITTLE LIKE',"%".'P'."%");
						$otherdb->where('PROTITTLE', 'PhD');
						$otherdb->where('GENDER', $gender);
						$otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
						$otherdb->ORDER_BY('CREATEDDTM ASC');
						$otherdb->ORDER_BY('DISTANCE ASC');
						$otherdb->group_by('REGNO');
						
						$query = $otherdb->get();
						$result = $query->result();
								
						return $result;
					}
		 }

    }
	
	function getStudentInfoAll($semester,$gender,$appstatus)
    {	
		if($gender == 'Female')
        {
			return $this->otherdb->where('SEMESTERCODE LIKE',"%".$semester."%")
							->where('GENDER', $gender)
							->ORDER_BY('CREATEDDTM ASC')
							->ORDER_BY('DISTANCE ASC')
							->group_by('REGNO')
							->get('TBL_APPLICATION')
							->result();					
			
	   } elseif($gender == 'Female' && $appstatus == 2)
       {
			return $this->otherdb->where('SEMCODE LIKE',"%".$semester."%")
						->where('GENDER', $gender)
						->ORDER_BY('UPDATEDDTM ASC')
						->get('TBL_REALLOTMENT')
						->result();					
			 
	   } elseif ($gender == 'Male')
	   {
			return $this->otherdb->where('SEMESTERCODE LIKE',"%".$semester."%")
						->where('GENDER', $gender)
						->ORDER_BY('CREATEDDTM ASC')
						->get('TBL_MALEAPPLICATION')
						->result();
			
	   }

    }
	
	function getStudentInfoAllByDate($semester,$gender,$fromdate,$todate,$status)
    {	
		if($gender == 'Female')
        {
			$otherdb = $this->load->database('otherdb', TRUE);	
			$otherdb->select('*');
			$otherdb->from('TBL_APPLICATION');
			$otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
			$otherdb->where('GENDER', $gender);
			$otherdb->where('ADMINUPDATESTATUSDATE >=', $fromdate);
			$otherdb->where('ADMINUPDATESTATUSDATE <=', $todate);
			$otherdb->where('STATUS', $status);
			$otherdb->ORDER_BY('CREATEDDTM ASC');
			
			$query = $otherdb->get();
			$result = $query->result();
					
			return $result;
	   }
	   elseif ($gender == 'Male')
	   {
		    $otherdb = $this->load->database('otherdb', TRUE);	
			$otherdb->select('*');
			$otherdb->from('TBL_MALEAPPLICATION');
			$otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
			$otherdb->where('GENDER', $gender);
			$otherdb->where('ADMINUPDATESTATUSDATE >=', $fromdate);
			$otherdb->where('ADMINUPDATESTATUSDATE <=', $todate);
			$otherdb->where('STATUS', $status);
			$otherdb->ORDER_BY('CREATEDDTM ASC');
			
			$query = $otherdb->get();
			$result = $query->result();
					
			return $result;
	   }

    }
	
	function getAllotStudentRegno($gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('REGNO');
        $otherdb->from('TBL_ALLOTMENT');
		$otherdb->where('GENDER',$gender);
        $query =  $otherdb->get();
			
	    return $query->result();
    }
	
	function getAllotStudentDetails($regno, $gender)
    {
  
		$this->db->select('*');
        $this->db->from('TBL_HSTUDENTS');
		$this->db->where('REGNO',$regno);
		$this->db->where('GENDER',$gender);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
	
	function getcnicsis($regno)
    {
		$this->db->select('NIDPASSNO as CNIC, NATIONALITY');
        $this->db->from('TBL_STUDENT');
		$this->db->where('REGNO',$regno);
        $query = $this->db->get();
        $result = $query->row();        
        return $result;
    }

    public function getAllNationalites($gender){
    	$otherdb = $this->load->database('otherdb', TRUE);
    	$otherdb->select('distinct(NATIONALITY)');
        $otherdb->from('tbl_allotmenthistory');
		$otherdb->where('GENDER',$gender);
		$otherdb->order_by('NATIONALITY','ASC');
        $query =  $otherdb->get();
        $result = $query->result();        
        return $result;
    }

    public function getCountry($nationality){
    	$otherdb = $this->load->database('otherdb', TRUE);
    	$otherdb->select('ALLOTMENTHISTORY_ID,COUNTRY,NATIONALITY');
        $otherdb->from('tbl_allotmenthistory');
        $otherdb->where('NATIONALITY',$nationality);		
        $query = $otherdb->get();
        return $query->result();
    }

    public function updateStdNationality($id,$nationality){

    	$otherdb = $this->load->database('otherdb', TRUE);
    	$data = array('NATIONALITY' => $nationality);

		$otherdb->where('ALLOTMENTHISTORY_ID',$id);
        $otherdb->update('tbl_allotmenthistory',$data);
        
       	return $otherdb->affected_rows();

        //var_dump($data); exit();

    }


	
	function getBorderListAll($semester,$gender,$hostel,$faculty,$dept, $nationality, $programe,$ALLOTTYPE)
    {				
		$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('TBL_ALLOTMENT.HOSTELID, TBL_ALLOTMENT.CNIC, TBL_ALLOTMENT.STUDENTNAME,TBL_ALLOTMENT.STUDENTPHONE,TBL_ALLOTMENT.FATHEROCCUPATION,TBL_ALLOTMENT.ADDRESS, TBL_ALLOTMENT.CADDRESS, TBL_ALLOTMENT.FATHERPHONE,TBL_ALLOTMENT.REGNO, TBL_ALLOTMENT.FACULTY, TBL_ALLOTMENT.PROTITTLE, TBL_ALLOTMENT.DEPARTNAME, TBL_ALLOTMENT.EXT,TBL_ALLOTMENT.ALLOTTYPE, TBL_ALLOTMENT.COUNTRY, TBL_ALLOTMENT.PROVINCE, TBL_ALLOTMENT.NATIONALITY, TBL_ALLOTMENT.ADMIN_VERIFY, TBL_USERS.*,TBL_HOSTEL.*,TBL_ROOM.*,TBL_SEAT.*');
			$otherdb->from('TBL_ALLOTMENT');
			$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER');
			$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER');
			$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER');
			$otherdb->join('TBL_USERS', 'TBL_USERS.userId = TBL_ALLOTMENT.EMAILID','INNER');

			$query = $otherdb->where('SEMCODE',$semester);	

			$query = $otherdb->where('TBL_ALLOTMENT.GENDER', $gender);

			if($nationality != 'All'){
				$query = $otherdb->where('TBL_ALLOTMENT.NATIONALITY', $nationality);
			}
			if($ALLOTTYPE == 'Allotment'){				
				$query = $otherdb->where('TBL_ALLOTMENT.ALLOTTYPE', 'Allotment');
				$query = $otherdb->or_where('TBL_ALLOTMENT.ALLOTTYPE', 'Alloted');
			}
			if($hostel != 'All'){
				$query = $otherdb->where('TBL_ALLOTMENT.HOSTELID', $hostel);
			}
			if($faculty != 'All'){
				$query = $otherdb->where('TBL_ALLOTMENT.FACULTY', trim($faculty," "));
			}
			if($dept != 'All'){
				$query = $otherdb->where('TBL_ALLOTMENT.DEPARTNAME',trim($dept," "));
			}

			if($programe != 'All'){

				if($programe == 'BS' || $programe == 'MSC'){
					$query = $otherdb->or_where_in('TBL_ALLOTMENT.PROTITTLE', "'BS','MSC','LLB','MA','LLB','Bachelor','BA'");
				} elseif($programe == 'MS/MPHILL' || $programe == 'MS'){
					$query = $otherdb->or_where_in('TBL_ALLOTMENT.PROTITTLE', "'MS/MPHILL','MS'");					
				} else {
					$query = $otherdb->where('TBL_ALLOTMENT.PROTITTLE LIKE', 'PHD');
				}
			}

			$query = $otherdb->get();
			
			$query1 = $otherdb->last_query();		
			
			
			$otherdb->select('TBL_REALLOTMENT.HOSTELID, TBL_REALLOTMENT.CNIC, TBL_REALLOTMENT.STUDENTNAME,TBL_REALLOTMENT.STUDENTPHONE,TBL_REALLOTMENT.FATHEROCCUPATION,TBL_REALLOTMENT.ADDRESS, TBL_REALLOTMENT.CADDRESS, TBL_REALLOTMENT.FATHERPHONE,TBL_REALLOTMENT.REGNO, TBL_REALLOTMENT.FACULTY,  TBL_REALLOTMENT.PROTITTLE, TBL_REALLOTMENT.DEPARTNAME, TBL_REALLOTMENT.EXT, TBL_REALLOTMENT.ALLOTTYPE, TBL_REALLOTMENT.PROVINCE, TBL_REALLOTMENT.NATIONALITY, TBL_REALLOTMENT.COUNTRY, TBL_REALLOTMENT.ADMIN_VERIFY,TBL_USERS.*, TBL_HOSTEL.*,TBL_ROOM.*,TBL_SEAT.*');
			$otherdb->from('TBL_REALLOTMENT');
			$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_REALLOTMENT.HOSTELID','INNER');
			$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_REALLOTMENT.ROOMID','INNER');
			$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_REALLOTMENT.SEATID','INNER');
			$otherdb->join('TBL_USERS', 'TBL_USERS.userId = TBL_REALLOTMENT.EMAILID','INNER');
			$query = $otherdb->where('SEMCODE',$semester);

			$query = $otherdb->where('TBL_REALLOTMENT.GENDER', $gender);

			if($nationality != 'All'){
				$query = $otherdb->where('TBL_REALLOTMENT.NATIONALITY', $nationality);
			}
			if($ALLOTTYPE == 'REALLOTMENT'){				
				$query = $otherdb->where('TBL_REALLOTMENT.ALLOTTYPE', 'REALLOTMENT');
				$query = $otherdb->or_where('TBL_REALLOTMENT.ALLOTTYPE', 'ReAlloted');
			}
			if($hostel != 'All'){
				$query = $otherdb->where('TBL_REALLOTMENT.HOSTELID', $hostel);
			}
			if($faculty != 'All'){
				$query = $otherdb->where('TBL_REALLOTMENT.FACULTY', trim($faculty," "));
			}
			if($dept != 'All'){
				$query = $otherdb->where('TBL_REALLOTMENT.DEPARTNAME',trim($dept," "));
			}

			if($programe != 'All'){

				if($programe == 'BS' || $programe == 'MSC'){
					$query = $otherdb->or_where_in('TBL_REALLOTMENT.PROTITTLE', "'BS','MSC','LLB','MA','LLB','Bachelor','BA'");					
				} elseif($programe == 'MS/MPHILL' || $programe == 'MS'){
					$query = $otherdb->or_where_in('TBL_REALLOTMENT.PROTITTLE', "'MS/MPHILL','MS'");					
				} else { 
					$query = $otherdb->where('TBL_REALLOTMENT.PROTITTLE LIKE', 'PHD');
				}

			}

			$otherdb->get(); 
			$query2 =  $otherdb->last_query();

			

			if($ALLOTTYPE == 'Allotment'){
				$query = $otherdb->query($query1);
				return $query->result();
				//echo ($query1); exit();
			} else if($ALLOTTYPE == 'REALLOTMENT'){
				$query = $otherdb->query($query2);
				return $query->result();
			}else{
				$query = $otherdb->query($query1." UNION ".$query2);
				return $query->result();
			}
			
    }

	
	function getStudentInfoByDate($programe, $semester,$gender,$fromdate,$todate,$status)
    {	
        if($gender == 'Female')
		{
			$otherdb = $this->load->database('otherdb', TRUE);	
			$otherdb->select('*');
			$otherdb->from('TBL_APPLICATION');
			$query = $otherdb->where('PROTITTLE', $programe);
			$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
			$query = $otherdb->where('GENDER', $gender);
			$query = $otherdb->where('ADMINUPDATESTATUSDATE >=', $fromdate);
			$query = $otherdb->where('ADMINUPDATESTATUSDATE <=', $todate);
			$query = $otherdb->where('STATUS', $status);
			$query = $otherdb->ORDER_BY('CREATEDDTM ASC');
			$query = $otherdb->ORDER_BY('DISTANCE ASC');
			$query = $otherdb->get();
			$result = $query->result();
					
			return $result;
		}
		elseif($gender == 'Male')
		
		{
			$otherdb = $this->load->database('otherdb', TRUE);	
			$otherdb->select('*');
			$otherdb->from('TBL_MALEAPPLICATION');
			$query = $otherdb->where('PROTITTLE', $programe);
			$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
			$query = $otherdb->where('GENDER', $gender);
			$query = $otherdb->ORDER_BY('CREATEDDTM ASC');
			$query = $otherdb->ORDER_BY('DISTANCE ASC');
			$query = $otherdb->get();
			$result = $query->result();
					
			return $result;
		}

    }

	
	function getStudentPrint($programe, $semester)
    {	
		$otherdb = $this->load->database('otherdb', TRUE);	
		$otherdb->select('*');
        $otherdb->from('TBL_APPLICATION');
		$otherdb->where('PROTITTLE', $programe);
		$otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
		$otherdb->where('STATUS', 1);
		$otherdb->where('GENDER', 'Female');
		$otherdb->ORDER_BY('CREATEDDTM ASC');
		$otherdb->DISTINCT('REGNO');
		
        $query = $otherdb->get();
        $result = $query->result();
		        
        return $result;
    }
	
	function getStudentPrintAll($programe, $semester, $gender)
    {	if($programe != 'All' && $gender == 'Female')
	  {
		if($programe == 'Bachelor' || $programe == 'BS')
			{
				$otherdb = $this->load->database('otherdb', TRUE);	
				$otherdb->select('*');
				$otherdb->from('TBL_APPLICATION');
				$otherdb->where('PROTITTLE NOT LIKE', 'MS');
				$otherdb->where('PROTITTLE NOT LIKE', 'LLM');
				$otherdb->where('PROTITTLE NOT LIKE', 'MS/MPHILL');
				$otherdb->where('PROTITTLE NOT LIKE', 'PhD');
				$otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
				$otherdb->where('GENDER', $gender);
				$otherdb->where('STATUS', 1);
				$otherdb->group_by('REGNO');
				$otherdb->ORDER_BY('CREATEDDTM ASC');
				$otherdb->ORDER_BY('DISTANCE ASC');
				$query = $otherdb->get();
				$result = $query->result();
						
				return $result;
			}
			elseif($programe == 'MS/MPHILL' || $programe == 'MS')
			{
				$otherdb = $this->load->database('otherdb', TRUE);	
				$otherdb->select('*');
				$otherdb->from('TBL_APPLICATION');
				$query = $otherdb->where('PROTITTLE !=', 'BS');
				$query = $otherdb->where('PROTITTLE !=', 'MSC');
				$query = $otherdb->where('PROTITTLE !=', 'MA');
				$query = $otherdb->where('PROTITTLE !=', 'Bachelor');
				$query = $otherdb->where('PROTITTLE !=', 'LLB');
				$query = $otherdb->where('PROTITTLE !=', 'P%');
				$query = $otherdb->where('PROTITTLE !=', 'PhD');
				$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
				$query = $otherdb->where('GENDER', $gender);
				$otherdb->where('STATUS', 1);
				$otherdb->group_by('REGNO');
				$query = $otherdb->ORDER_BY('CREATEDDTM ASC');
				$query = $otherdb->ORDER_BY('DISTANCE ASC');
				$query = $otherdb->get();
				$result = $query->result();
						
				return $result;
			}
			
			elseif($programe == 'PhD' || $programe == 'PHD')
			{
				$otherdb = $this->load->database('otherdb', TRUE);	
				$otherdb->select('*');
				$otherdb->from('TBL_APPLICATION');
				$otherdb->where('PROTITTLE', 'PhD');
				$otherdb->where('PROTITTLE LIKE',"%".'P'."%");
				$otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
				$otherdb->where('GENDER', $gender);
				$otherdb->where('STATUS', 1);
				$otherdb->group_by('REGNO');
				$otherdb->ORDER_BY('CREATEDDTM ASC');
				$otherdb->ORDER_BY('DISTANCE ASC');
				
				$query = $otherdb->get();
				$result = $query->result();
						
				return $result;
			}
	  }
	  elseif($programe == 'All' && $gender == 'Female')
	  {
		$otherdb = $this->load->database('otherdb', TRUE);	
		$otherdb->select('*');
        $otherdb->from('TBL_APPLICATION');
		$otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
		$otherdb->where('STATUS', 1);
		$otherdb->where('GENDER', $gender);
		$otherdb->group_by('REGNO');
		$otherdb->ORDER_BY('CREATEDDTM ASC');
		
        $query = $otherdb->get();
        $result = $query->result();
		        
        return $result;
	  }
	  
	  elseif($programe != 'All' && $gender == 'Male')
	  {
		if($programe == 'Bachelor' || $programe == 'BS')
			{
				$otherdb = $this->load->database('otherdb', TRUE);	
				$otherdb->select('*');
				$otherdb->from('TBL_MALEAPPLICATION');
				$otherdb->where('PROTITTLE NOT LIKE', 'MS');
				$otherdb->where('PROTITTLE NOT LIKE', 'LLM');
				$otherdb->where('PROTITTLE NOT LIKE', 'MS/MPHILL');
				$otherdb->where('PROTITTLE NOT LIKE', 'PhD');
				$otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
				$otherdb->where('GENDER', $gender);
				$otherdb->where('STATUS', 1);
				$otherdb->group_by('REGNO');
				$otherdb->ORDER_BY('CREATEDDTM ASC');
				$otherdb->ORDER_BY('DISTANCE ASC');
				$query = $otherdb->get();
				$result = $query->result();
						
				return $result;
			}
			elseif($programe == 'MS/MPHILL' || $programe == 'MS')
			{
				$otherdb = $this->load->database('otherdb', TRUE);	
				$otherdb->select('*');
				$otherdb->from('TBL_MALEAPPLICATION');
				$query = $otherdb->where('PROTITTLE !=', 'BS');
				$query = $otherdb->where('PROTITTLE !=', 'MSC');
				$query = $otherdb->where('PROTITTLE !=', 'MA');
				$query = $otherdb->where('PROTITTLE !=', 'Bachelor');
				$query = $otherdb->where('PROTITTLE !=', 'LLB');
				$query = $otherdb->where('PROTITTLE !=', 'P%');
				$query = $otherdb->where('PROTITTLE !=', 'PhD');
				$query = $otherdb->where('SEMESTERCODE LIKE',"%".trim($semester)."%");
				$query = $otherdb->where('GENDER', $gender);
				$otherdb->where('STATUS', 1);
				$otherdb->group_by('REGNO');
				$query = $otherdb->ORDER_BY('CREATEDDTM ASC');
				$query = $otherdb->ORDER_BY('DISTANCE ASC');
				$query = $otherdb->get();
				$result = $query->result();
						
				return $result;
			}
			
			elseif($programe == 'PhD' || $programe == 'PHD')
			{
				$otherdb = $this->load->database('otherdb', TRUE);	
				$otherdb->select('*');
				$otherdb->from('TBL_MALEAPPLICATION');
				$otherdb->where('PROTITTLE', 'PhD');
				$otherdb->where('PROTITTLE LIKE',"%".'P'."%");
				$otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
				$otherdb->where('GENDER', $gender);
				$otherdb->where('STATUS', 1);
				$otherdb->group_by('REGNO');
				$otherdb->ORDER_BY('CREATEDDTM ASC');
				$otherdb->ORDER_BY('DISTANCE ASC');
				
				$query = $otherdb->get();
				$result = $query->result();
						
				return $result;
			}
	  }
	  elseif($programe == 'All' && $gender == 'Male')
	  {
		$otherdb = $this->load->database('otherdb', TRUE);	
		$otherdb->select('*');
        $otherdb->from('TBL_MALEAPPLICATION');
		$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
		$query = $otherdb->where('STATUS', 1);
		$query = $otherdb->where('GENDER', $gender);
		$query = $otherdb->ORDER_BY('CREATEDDTM ASC');
		$otherdb->group_by('REGNO');
		
        $query = $otherdb->get();
        $result = $query->result();
		        
        return $result;
	  }
	  
    }
	
	
    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function VerifyUserRecord($userId, $gender)
    {
        if($gender == 'Female')
		{
			return $this->otherdb->where('STUDENTID', $userId)
						->where('GENDER', $gender)
						->get('TBL_APPLICATION')
						->result();					
			
	    }
	 elseif($gender == 'Male')
	     {
			return $this->otherdb->where('STUDENTID', $userId)
						->where('GENDER', $gender)
						->get('TBL_MALEAPPLICATION')
						->result();
	     }
	 
    }
	
	function Verifyappicantemail($gender)
    {
        if($gender == 'Female')
		{
			$otherdb = $this->load->database('otherdb', TRUE);	
			$otherdb->select('STUDENTEMAIL,STUDENTID,GENDER');
			$otherdb->from('TBL_APPLICATION');
			$query = $otherdb->where('STATUS', 1);
			$query = $otherdb->where('GENDER', $gender);
			$query = $otherdb->get();
			
			$result = $query->result();
					
			return $result;
		}
		elseif($gender == 'Male')
		
		{
			$otherdb = $this->load->database('otherdb', TRUE);	
			$otherdb->select('STUDENTEMAIL,STUDENTID,GENDER');
			$otherdb->from('TBL_MALEAPPLICATION');
			$query = $otherdb->where('STATUS', 1);
			$query = $otherdb->where('GENDER', $gender);
			$query = $otherdb->get();
			
			$result = $query->result();
					
			return $result;
		}
    }
	
	function VerifyappicantemailByDate($gender,$fromdate,$todate,$status)
    {
        if($gender == 'Female')
		{
			$otherdb = $this->load->database('otherdb', TRUE);	
			$otherdb->select('STUDENTEMAIL,STUDENTID,GENDER,STUDENTNAME');
			$otherdb->from('TBL_APPLICATION');
			$query = $otherdb->where('GENDER', $gender);
			$query = $otherdb->where('ADMINUPDATESTATUSDATE >=', $fromdate);
			$query = $otherdb->where('ADMINUPDATESTATUSDATE <=', $todate);
			$query = $otherdb->where('STATUS', $status);
			$query = $otherdb->get();
			
			$result = $query->result();
					
			return $result;
		}
		elseif($gender == 'Male')
		
		{
			$otherdb = $this->load->database('otherdb', TRUE);	
			$otherdb->select('STUDENTEMAIL,STUDENTID,GENDER,STUDENTNAME');
			$otherdb->from('TBL_MALEAPPLICATION');
			$query = $otherdb->where('GENDER', $gender);
			$query = $otherdb->where('ADMINUPDATESTATUSDATE >=', $fromdate);
			$query = $otherdb->where('ADMINUPDATESTATUSDATE <=', $todate);
			$query = $otherdb->where('STATUS', $status);
			$query = $otherdb->get();
			
			$result = $query->result();
					
			return $result;
		}
    }
	
	function GetEmailByRegno($regno, $gender)
    {
		if($gender == 'Female')
		{
			return $this->otherdb->select('EMAILID')
						->where('REGNO', $regno)
						->where('GENDER', $gender)
						->ORDER_BY('EMAILID', 'DESC')
						->LIMIT('1')
						->get('TBL_ALLOTMENTHISTORY')			
						->result();			
			
		}
		
    }
	
	function VerifychangeEmailById($userId, $gender)
    {
		if($gender == 'Female')
		{
			return $this->otherdb->select('email')
						->where('userId', $userId)
						->where('GENDER', $gender)
						->get('tbl_users')			
						->result();
			
		}
		
    }
	
	function VerifyappicantemailById($studentId, $gender)
    {
		if($gender == 'Female')
		{
			return $this->otherdb->select('STUDENTEMAIL,STUDENTID')
						->where('STATUS', 1)
						->where('STUDENTID', $studentId)
						->where('GENDER', $gender)
						->get('TBL_APPLICATION')			
						->result();					
			
		}
		elseif($gender == 'Male')
		{
			
			return $this->otherdb->select('STUDENTEMAIL,STUDENTID')
						->where('STATUS', 1)
						->where('STUDENTID', $studentId)
						->where('GENDER', $gender)
						->get('TBL_MALEAPPLICATION')			
						->result();
					
		}
    }
	
	function Rejectappicantemail($gender)
    {
		if($gender == 'Female')
		{			
			return $this->otherdb->select('STUDENTEMAIL')			
						->where('STATUS', 2)
						->where('STATUS', $gender)
						->get('TBL_APPLICATION')			
						->result();					
			
		}
		elseif ($gender == 'Male')
		{
			return $this->otherdb->select('STUDENTEMAIL')			
						->where('STATUS', 2)
						->where('STATUS', $gender)
						->get('TBL_MALEAPPLICATION')			
						->result();					
			
		}

    }
	
	function VerifyUserStatus($userId)
    {		
		return $this->otherdb->where('USERID', $userId)->get('TBL_USERS')->result();        
    }
    
	function GetActiveSem($gender)
    {	
		return $this->otherdb->select('distinct(SEMCODE)')
					->where('GENDER', $gender)
					//->where('IS_ACTIVE','1')
					->order_by('SMCODE','DESC')
					->limit('1')
			        ->get('TBL_SEMESTER')        
					->result();		        
        
    }
    
    
    
    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function updateseat($seatid, $seatInfo)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('SEATID',$seatid);
        $otherdb->update('TBL_SEAT',$seatInfo);
        
        return $otherdb->affected_rows();
    }

	 function UpdateFeeInfo($UploadInfo,$reallotId)
    {
            $otherdb = $this->load->database('otherdb', TRUE);
			$query = $otherdb->where('REALLOTMENT_ID', $reallotId);
			$otherdb->update('TBL_REALLOTMENT', $UploadInfo);
			
			return $otherdb->affected_rows();
    }
	
	function UpdateFeeStatusInfo($UploadInfo,$feeId)
    {
            $otherdb = $this->load->database('otherdb', TRUE);
			$query = $otherdb->where('FEE_ID', $feeId);
			$otherdb->update('TBL_FEESTATUS', $UploadInfo);
			
			return $otherdb->affected_rows();
    }
 
    
    function UpdatestudentStatus($userInfo, $studentId, $gender)
    {
		if($gender == 'Female')
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$query = $otherdb->where('STUDENTID', $studentId);
			$query = $otherdb->where('GENDER', $gender);
			$otherdb->update('TBL_APPLICATION', $userInfo);
			
			return $otherdb->affected_rows();
			
		}
		elseif($gender == 'Male')
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$query = $otherdb->where('STUDENTID', $studentId);
			$query = $otherdb->where('GENDER', $gender);
			$otherdb->update('TBL_MALEAPPLICATION', $userInfo);
			
			return $otherdb->affected_rows();
		}
    }
	
	function UpdateSeatChanges($userupdate,$sid,$gender)
    {
			$otherdb = $this->load->database('otherdb', TRUE);
			$query = $otherdb->where('FCHANGE_ID', $sid);
			$query = $otherdb->where('GENDER', $gender);
			$otherdb->update('TBL_APPSEATCHANGEFMALE', $userupdate);
			
			return $otherdb->affected_rows();
			
    }
	
	function UpdateSeatInterChanges($userupdate,$sid,$gender)
    {
			$otherdb = $this->load->database('otherdb', TRUE);
			$query = $otherdb->where('FSWAP_ID', $sid);
			$query = $otherdb->where('GENDER', $gender);
			$otherdb->update('TBL_APPSEATSWAPFMALE', $userupdate);
			
			return $otherdb->affected_rows();
			
    }
	
	function UpdateStatus($userupdate,$sid,$gender)
    {
		if($gender == 'Female')
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$query = $otherdb->where('STUDENTID', $sid);
			$query = $otherdb->where('GENDER', $gender);
			$otherdb->update('TBL_APPLICATION', $userupdate);
			
			return $otherdb->affected_rows();
			
		}
		elseif($gender == 'Male')
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$query = $otherdb->where('STUDENTID', $sid);
			$query = $otherdb->where('GENDER', $gender);
			$otherdb->update('TBL_MALEAPPLICATION', $userupdate);
			
			return $otherdb->affected_rows();
		}
    }
	
	function UpdateUserExt($userext,$regno,$gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		$query = $otherdb->where('REGNO', $regno);
		$query = $otherdb->where('GENDER', $gender);
		$otherdb->update('TBL_REALLOTMENT', $userext);
		
		$result = $otherdb->affected_rows();
		if($result == 0)
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$query = $otherdb->where('REGNO', $regno);
			$query = $otherdb->where('GENDER', $gender);
			$otherdb->update('TBL_ALLOTMENT', $userext);
			
			return $otherdb->affected_rows();
		}
		else{
			  return $result;
		}
	}
	
	function getallstudentInfo($gender,$regno,$stname)
    {
		$this->db->select('REGNO,STUDENTNAME,FATHERNAME,STUDENTDOB,CNIC,FACULTY,DEPARTMENTNAME,PROTITTLE,NATIONALITY, PERMANENT, PREADD, STUDENTNUMBER');
        $this->db->from('TBL_HSTUDENTS');
		//$this->db->where('GENDER',$gender);
		$this->db->where('REGNO LIKE', $regno.'%');
		$this->db->where('STUDENTNAME LIKE', $stname.'%');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    function getallstudentcourseInfo($gender,$regno,$semcode)
    {
		$this->db->select('SUM(CREDITHRS) as CREDITHRS');
        $this->db->from('TBL_STUDSEMCOURSE');
		//$this->db->where('GENDER',$gender);
		$this->db->where('REGNO LIKE', $regno.'%');
		$this->db->where('SEMCODE LIKE', $semcode.'%');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
	
	function ProgrameListing()
    {
        $this->db->distinct('PROGRAME');
		$this->db->select('PROGRAME,PROTITTLE');
        $this->db->from('TBL_HOSTEL');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
	
	/** Count number of applied students and all status 
	of cuurnet semester registration **/
	
	function verifyapplication($semester, $programe, $gender)
    {
	   if($gender == 'Female')
	   {
			$otherdb = $this->load->database('otherdb', TRUE);	
			$otherdb->select('count(*) as verify');
			$otherdb->from('TBL_APPLICATION');
			$query = $otherdb->where('PROTITTLE', $programe);
			$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
			$query = $otherdb->where('STATUS', '1');
			$query = $otherdb->where('GENDER', $gender);
			$query = $otherdb->get();
		   
			$result = $query->result();
					
			return $result;
	   }
	   elseif($gender == 'Male')
		{ 
			if($programe == 'Bachelor' || $programe == 'BS')
			{
					
						$otherdb = $this->load->database('otherdb', TRUE);	
						$otherdb->select('count(*) as verify');
						$otherdb->from('TBL_MALEAPPLICATION');
						$query = $otherdb->where("(PROTITTLE LIKE '%".'BS'."%' OR PROTITTLE LIKE '%".'MSC'."%' OR PROTITTLE LIKE '%".'LLB'."%' OR PROTITTLE LIKE '%".'MA'."%')", NULL, FALSE);
						$query = $otherdb->where('GENDER', $gender);
						$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
						$query = $otherdb->where('STATUS', '1');
						$query = $otherdb->ORDER_BY('CREATEDDTM ASC');
						$query = $otherdb->ORDER_BY('DISTANCE ASC');
						$query = $otherdb->get();
						$result = $query->result();
								
						return $result;
			}
			elseif($programe == 'MS/MPHILL')
					{
						$otherdb = $this->load->database('otherdb', TRUE);	
						$otherdb->select('count(*) as verify');
						$otherdb->from('TBL_MALEAPPLICATION');
						$query = $otherdb->where('PROTITTLE', 'MS');
						$query = $otherdb->where('GENDER', $gender);
						$query = $otherdb->where('STATUS', '1');
						$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
						$query = $otherdb->ORDER_BY('CREATEDDTM ASC');
						$query = $otherdb->ORDER_BY('DISTANCE ASC');
						$query = $otherdb->get();
						$result = $query->result();
								
						return $result;
					}
			elseif($programe == 'PhD')
					{
						$otherdb = $this->load->database('otherdb', TRUE);	
						$otherdb->select('count(*) as verify');
						$otherdb->from('TBL_MALEAPPLICATION');
						$query = $otherdb->where('PROTITTLE', 'PHD');
						$query = $otherdb->where('GENDER', $gender);
						$query = $otherdb->where('STATUS', '1');
						$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
						$query = $otherdb->ORDER_BY('CREATEDDTM ASC');
						$query = $otherdb->ORDER_BY('DISTANCE ASC');
						$query = $otherdb->get();
						$result = $query->result();
								
						return $result;
					}
		 }

    }
	
	function totalapplication($semester, $programe, $gender)
    {
	    if($gender == 'Female')
		{
			$otherdb = $this->load->database('otherdb', TRUE);	
			$otherdb->select('count(*) as total');
			$otherdb->from('TBL_APPLICATION');
			$query = $otherdb->where('PROTITTLE', $programe);
			$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
			$query = $otherdb->where('GENDER', $gender);
			$query = $otherdb->get();
		   
			$result = $query->result();
					
			return $result;
		}
		elseif($gender == 'Male')
		{ 
			if($programe == 'Bachelor' || $programe == 'BS')
			{
						$otherdb = $this->load->database('otherdb', TRUE);	
						$otherdb->select('count(*) as total');
						$otherdb->from('TBL_MALEAPPLICATION');
						$query = $otherdb->where("(PROTITTLE LIKE '%".'BS'."%' OR PROTITTLE LIKE '%".'MSC'."%' OR PROTITTLE LIKE '%".'LLB'."%' OR PROTITTLE LIKE '%".'MA'."%')", NULL, FALSE);
						$query = $otherdb->where('GENDER', $gender);
						$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
						$query = $otherdb->ORDER_BY('CREATEDDTM ASC');
						$query = $otherdb->ORDER_BY('DISTANCE ASC');
						$query = $otherdb->get();
						$result = $query->result();
								
						return $result;
			}
			elseif($programe == 'MS/MPHILL')
					{
						$otherdb = $this->load->database('otherdb', TRUE);	
						$otherdb->select('count(*) as total');
						$otherdb->from('TBL_MALEAPPLICATION');
						$query = $otherdb->where('PROTITTLE', 'MS');
						$query = $otherdb->where('GENDER', $gender);
						$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
						$query = $otherdb->ORDER_BY('CREATEDDTM ASC');
						$query = $otherdb->ORDER_BY('DISTANCE ASC');
						$query = $otherdb->get();
						$result = $query->result();
								
						return $result;
					}
			elseif($programe == 'PhD')
					{
						$otherdb = $this->load->database('otherdb', TRUE);	
						$otherdb->select('count(*) as total');
						$otherdb->from('TBL_MALEAPPLICATION');
						$query = $otherdb->where('PROTITTLE', 'PHD');
						$query = $otherdb->where('GENDER', $gender);
						$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
						$query = $otherdb->ORDER_BY('CREATEDDTM ASC');
						$query = $otherdb->ORDER_BY('DISTANCE ASC');
						$query = $otherdb->get();
						$result = $query->result();
								
						return $result;
					}
		 }

		
    }
	
	function pendingapplication($semester, $programe, $gender)
    {
		if($gender == 'Female')
		{
			$otherdb = $this->load->database('otherdb', TRUE);	
			$otherdb->select('count(*) as pending');
			$otherdb->from('TBL_APPLICATION');
			$query = $otherdb->where('PROTITTLE', $programe);
			$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
			$query = $otherdb->where('STATUS', '0');
			$query = $otherdb->where('GENDER', $gender);
			$query = $otherdb->get();
		   
			$result = $query->result();
					
			return $result;
		}
		elseif($gender == 'Male')
		{ 
			if($programe == 'Bachelor' || $programe == 'BS')
			{
					
						$otherdb = $this->load->database('otherdb', TRUE);	
						$otherdb->select('count(*) as pending');
						$otherdb->from('TBL_MALEAPPLICATION');
						$query = $otherdb->where("(PROTITTLE LIKE '%".'BS'."%' OR PROTITTLE LIKE '%".'MSC'."%' OR PROTITTLE LIKE '%".'LLB'."%' OR PROTITTLE LIKE '%".'MA'."%')", NULL, FALSE);
						$query = $otherdb->where('GENDER', $gender);
						$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
						$query = $otherdb->where('STATUS', '0');
						$query = $otherdb->ORDER_BY('CREATEDDTM ASC');
						$query = $otherdb->ORDER_BY('DISTANCE ASC');
						$query = $otherdb->get();
						$result = $query->result();
								
						return $result;
			}
			elseif($programe == 'MS/MPHILL')
					{
						$otherdb = $this->load->database('otherdb', TRUE);	
						$otherdb->select('count(*) as pending');
						$otherdb->from('TBL_MALEAPPLICATION');
						$query = $otherdb->where('PROTITTLE', 'MS');
						$query = $otherdb->where('GENDER', $gender);
						$query = $otherdb->where('STATUS', '0');
						$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
						$query = $otherdb->ORDER_BY('CREATEDDTM ASC');
						$query = $otherdb->ORDER_BY('DISTANCE ASC');
						$query = $otherdb->get();
						$result = $query->result();
								
						return $result;
					}
			elseif($programe == 'PhD')
					{
						$otherdb = $this->load->database('otherdb', TRUE);	
						$otherdb->select('count(*) as pending');
						$otherdb->from('TBL_MALEAPPLICATION');
						$query = $otherdb->where('PROTITTLE', 'PHD');
						$query = $otherdb->where('GENDER', $gender);
						$query = $otherdb->where('STATUS', '0');
						$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
						$query = $otherdb->ORDER_BY('CREATEDDTM ASC');
						$query = $otherdb->ORDER_BY('DISTANCE ASC');
						$query = $otherdb->get();
						$result = $query->result();
								
						return $result;
					}
		 }

    }
	
	function cancelapplication($semester, $programe, $gender)
    { 
	    if($gender == 'Female')
		{
			$otherdb = $this->load->database('otherdb', TRUE);	
			$otherdb->select('count(*) as cancel');
			$otherdb->from('TBL_APPLICATION');
			$query = $otherdb->where('PROTITTLE', $programe);
			$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
			$query = $otherdb->where('STATUS', '2');
			$query = $otherdb->where('GENDER', $gender);
			$query = $otherdb->get();
		   
			$result = $query->result();
					
			return $result;
		}
		elseif($gender == 'Male')
		{ 
			if($programe == 'Bachelor' || $programe == 'BS')
			{
					
						$otherdb = $this->load->database('otherdb', TRUE);	
						$otherdb->select('count(*) as cancel');
						$otherdb->from('TBL_MALEAPPLICATION');
						$query = $otherdb->where("(PROTITTLE LIKE '%".'BS'."%' OR PROTITTLE LIKE '%".'MSC'."%' OR PROTITTLE LIKE '%".'LLB'."%' OR PROTITTLE LIKE '%".'MA'."%')", NULL, FALSE);
						$query = $otherdb->where('GENDER', $gender);
						$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
						$query = $otherdb->where('STATUS', '2');
						$query = $otherdb->ORDER_BY('CREATEDDTM ASC');
						$query = $otherdb->ORDER_BY('DISTANCE ASC');
						$query = $otherdb->get();
						$result = $query->result();
								
						return $result;
			}
			elseif($programe == 'MS/MPHILL')
					{
						$otherdb = $this->load->database('otherdb', TRUE);	
						$otherdb->select('count(*) as cancel');
						$otherdb->from('TBL_MALEAPPLICATION');
						$query = $otherdb->where('PROTITTLE', 'MS');
						$query = $otherdb->where('GENDER', $gender);
						$query = $otherdb->where('STATUS', '2');
						$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
						$query = $otherdb->ORDER_BY('CREATEDDTM ASC');
						$query = $otherdb->ORDER_BY('DISTANCE ASC');
						$query = $otherdb->get();
						$result = $query->result();
								
						return $result;
					}
			elseif($programe == 'PhD')
					{
						$otherdb = $this->load->database('otherdb', TRUE);	
						$otherdb->select('count(*) as cancel');
						$otherdb->from('TBL_MALEAPPLICATION');
						$query = $otherdb->where('PROTITTLE', 'PHD');
						$query = $otherdb->where('GENDER', $gender);
						$query = $otherdb->where('STATUS', '2');
						$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
						$query = $otherdb->ORDER_BY('CREATEDDTM ASC');
						$query = $otherdb->ORDER_BY('DISTANCE ASC');
						$query = $otherdb->get();
						$result = $query->result();
								
						return $result;
					}
		 }

    }
	function verifyapplicationAll($semester, $gender,$appstatus)
    {
	    if($gender == 'Female' && $appstatus == 1)
		{
			$otherdb = $this->load->database('otherdb', TRUE);	
			$otherdb->select('count(*) as verify');
			$otherdb->from('TBL_APPLICATION');
			$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
			$query = $otherdb->where('STATUS', '1');
			$query = $otherdb->where('GENDER', $gender);
			$query = $otherdb->get();
		   
			$result = $query->result();
					
			return $result;
		}
		elseif($gender == 'Female' && $appstatus == 2)
        {
			$otherdb = $this->load->database('otherdb', TRUE);	
			$otherdb->select('*');
			$otherdb->from('TBL_REALLOTMENT');
			$query = $otherdb->where('SEMCODE LIKE',"%".$semester."%");
			$query = $otherdb->where('GENDER', $gender);
			$query = $otherdb->ORDER_BY('UPDATEDDTM ASC');
			$query = $otherdb->get();
			$result = $query->result();
					
			return $result;
	   }
		elseif ($gender == 'Male')
		{
			$otherdb = $this->load->database('otherdb', TRUE);	
			$otherdb->select('count(*) as verify');
			$otherdb->from('TBL_MALEAPPLICATION');
			$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
			$query = $otherdb->where('STATUS', '1');
			$query = $otherdb->where('GENDER', $gender);
			$query = $otherdb->get();
		   
			$result = $query->result();
					
			return $result;
		}
    }
	
	function totalapplicationAll($semester, $gender,$appstatus)
    {
		if($gender == 'Female' && $appstatus == 1)
		{
			$otherdb = $this->load->database('otherdb', TRUE);	
			$otherdb->select('count(*) as total');
			$otherdb->from('TBL_APPLICATION');
			$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
			$query = $otherdb->where('GENDER', $gender);
			$query = $otherdb->get();
		   
			$result = $query->result();
					
			return $result;
		}
		elseif($gender == 'Female' && $appstatus == 2)
        {
			$otherdb = $this->load->database('otherdb', TRUE);	
			$otherdb->select('*');
			$otherdb->from('TBL_REALLOTMENT');
			$query = $otherdb->where('SEMCODE LIKE',"%".$semester."%");
			$query = $otherdb->where('GENDER', $gender);
			$query = $otherdb->ORDER_BY('UPDATEDDTM ASC');
			$query = $otherdb->get();
			$result = $query->result();
					
			return $result;
	   }
		elseif($gender == 'Male')
		{
			$otherdb = $this->load->database('otherdb', TRUE);	
			$otherdb->select('count(*) as total');
			$otherdb->from('TBL_MALEAPPLICATION');
			$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
			$query = $otherdb->where('GENDER', $gender);
			$query = $otherdb->get();
		   
			$result = $query->result();
					
			return $result;
		}
    }
	
	function pendingapplicationAll($semester, $gender,$appstatus)
    {
	    if($gender == 'Female' && $appstatus == 1)
		{
			$otherdb = $this->load->database('otherdb', TRUE);	
			$otherdb->select('count(*) as pending');
			$otherdb->from('TBL_APPLICATION');
			$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
			$query = $otherdb->where('STATUS', '0');
			$query = $otherdb->where('GENDER', $gender);
			$query = $otherdb->get();
		   
			$result = $query->result();
					
			return $result;
		}
		elseif($gender == 'Female' && $appstatus == 2)
        {
			$otherdb = $this->load->database('otherdb', TRUE);	
			$otherdb->select('*');
			$otherdb->from('TBL_REALLOTMENT');
			$query = $otherdb->where('SEMCODE LIKE',"%".$semester."%");
			$query = $otherdb->where('GENDER', $gender);
			$query = $otherdb->ORDER_BY('UPDATEDDTM ASC');
			$query = $otherdb->get();
			$result = $query->result();
					
			return $result;
	   }
		elseif($gender == 'Male')
		{
		    $otherdb = $this->load->database('otherdb', TRUE);	
			$otherdb->select('count(*) as pending');
			$otherdb->from('TBL_MALEAPPLICATION');
			$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
			$query = $otherdb->where('STATUS', '0');
			$query = $otherdb->where('GENDER', $gender);
			$query = $otherdb->get();
		   
			$result = $query->result();
					
			return $result;	
		}
        
    }
	
	function cancelapplicationAll($semester, $gender, $appstatus)
    { 
	   if($gender == 'Female' && $appstatus == 1)
	   {
			$otherdb = $this->load->database('otherdb', TRUE);	
			$otherdb->select('count(*) as cancel');
			$otherdb->from('TBL_APPLICATION');
			$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
			$query = $otherdb->where('STATUS', '2');
			$query = $otherdb->where('GENDER', $gender);
			$query = $otherdb->get();
		   
			$result = $query->result();
					
			return $result;
	   }
	   elseif($gender == 'Female' && $appstatus == 2)
        {
			$otherdb = $this->load->database('otherdb', TRUE);	
			$otherdb->select('*');
			$otherdb->from('TBL_REALLOTMENT');
			$query = $otherdb->where('SEMCODE LIKE',"%".$semester."%");
			$query = $otherdb->where('GENDER', $gender);
			$query = $otherdb->ORDER_BY('UPDATEDDTM ASC');
			$query = $otherdb->get();
			$result = $query->result();
					
			return $result;
	   }
	   elseif($gender == 'Male')
	   {
		   $otherdb = $this->load->database('otherdb', TRUE);	
			$otherdb->select('count(*) as cancel');
			$otherdb->from('TBL_MALEAPPLICATION');
			$query = $otherdb->where('SEMESTERCODE LIKE',"%".$semester."%");
			$query = $otherdb->where('STATUS', '2');
			$query = $otherdb->where('GENDER', $gender);
			$query = $otherdb->get();
		   
			$result = $query->result();
					
			return $result;
	   }
    }
	
	function getfaculty()
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
        $otherdb->from('TBL_FACULTY');
        $query = $otherdb->get();
        $result = $query->result();        
        return $result;
    }
	
	function getfacname($faculty)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
        $otherdb->from('TBL_FACULTY');
		$query = $otherdb->where('FACULTY_ID', $faculty);
        $query = $otherdb->get();
        $result = $query->result();        
        return $result;
    }
	
	function getallsemester($gender)
	    {
		$otherdb = $this->load->database('otherdb', TRUE);	
		$otherdb->select('DISTINCT(SEMCODE)');
        $otherdb->from('TBL_SEMESTER');
		$query = $otherdb->order_by('SMCODE', 'DESC');
		$query = $otherdb->where('GENDER', $gender);
        $query = $otherdb->get();
        $result = $query->result();        
        return $result;
			
		}
		
	function getstudentemester($gender, $semester)
	    {
		$otherdb = $this->load->database('otherdb', TRUE);	
		$otherdb->select('SEMESTEROPENREG');
        $otherdb->from('TBL_SEMESTER');
		$query = $otherdb->order_by('SMCODE', 'DESC');
		$query = $otherdb->where('GENDER', $gender);
		$query = $otherdb->like('SEMCODE', trim($semester));
        $query = $otherdb->get();
        $result = $query->result();        
        return $result;
			
		}
		
	function getsendemail($gender, $emailtype)
	    {
		$otherdb = $this->load->database('otherdb', TRUE);	
		$otherdb->select('*');
        $otherdb->from('tbl_email');
		$query = $otherdb->order_by('ID', 'ASC');
		$query = $otherdb->where('GENDER', $gender);
		$query = $otherdb->where('TYPE', $emailtype);
        $query = $otherdb->get();
		
        $result = $query->result();        
        return $result;
			
		}
		
	function checkemail($email)
	{
		return $this->otherdb->select('userId, email')
					->where('email', $email)
					->get('tbl_users')
					->result();
			
	}
		
	function GetuserInfo($id, $gender)
    {
		if($gender == 'Female')
		{
			return $this->otherdb->where('STUDENTID', $id)
						->where('GENDER', $gender)
						->get('TBL_APPLICATION')
						->result();
		}
		elseif($gender == 'Male')
		{
			return $this->otherdb->where('STUDENTID', $id)
						->where('GENDER', $gender)
						->get('TBL_MALEAPPLICATION')
						->result();
		}
    }

	function searchAllBoarderStudents($gender,$regno,$stname){

		$otherdb = $this->load->database('otherdb', TRUE);

		$result = $this->otherdb->select('TBL_ALLOTMENT.REGNO, 
		TBL_ALLOTMENT.STUDENTNAME, 
		TBL_ALLOTMENT.STUDENTPHONE,
		TBL_ALLOTMENT.FATHERNAME AS FATHERNAME, 
		TBL_ALLOTMENT.ALLOTEDDATE AS DATE, 
		TBL_ALLOTMENT.ALLOTTYPE AS TYPE, 
		TBL_ALLOTMENT.REMARKS AS REMARKS, 
		TBL_HOSTEL.HOSTEL_NO, 
		TBL_HOSTEL.HOSTELDESC, 
		TBL_ROOM.ROOMDESC, 
		TBL_SEAT.SEAT, 
		SEMCODE, 
		TBL_ALLOTMENT.REMARKS');
		$otherdb->from('TBL_ALLOTMENT');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER');
		$otherdb->where('TBL_ALLOTMENT.GENDER', $gender);
		$otherdb->like('TBL_ALLOTMENT.REGNO', $regno, 'both');
		$otherdb->like('TBL_ALLOTMENT.STUDENTNAME', $stname, 'both');
		$query = $otherdb->get();
		$query1 = $query->result();


		$otherdb->select('TBL_REALLOTMENT.REGNO, 
			TBL_REALLOTMENT.STUDENTNAME,
			TBL_REALLOTMENT.STUDENTPHONE,  
			TBL_REALLOTMENT.ALLOTEDDATE AS DATE, 
			TBL_REALLOTMENT.FATHERNAME AS FATHERNAME, 
			TBL_REALLOTMENT.REMARKS AS REMARKS, 
			TBL_HOSTEL.HOSTEL_NO, 
			TBL_HOSTEL.HOSTELDESC, 
			TBL_ROOM.ROOMDESC, 
			TBL_SEAT.SEAT, 
			TBL_REALLOTMENT.ALLOTTYPE AS TYPE, 
			SEMCODE, 
			TBL_REALLOTMENT.REMARKS');
			$otherdb->from('TBL_REALLOTMENT');
			$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_REALLOTMENT.SEATID','INNER');
			$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_REALLOTMENT.HOSTELID','INNER');
			$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_REALLOTMENT.ROOMID','INNER');
			$otherdb->where('TBL_REALLOTMENT.GENDER', $gender);
			$otherdb->like('TBL_REALLOTMENT.REGNO', $regno, 'both');
			$otherdb->like('TBL_REALLOTMENT.STUDENTNAME', $stname, 'both');
			$query = $otherdb->get();
			$query2 = $query->result();		
		
		$result = array_merge($query1, $query2);

		//var_dump($result); exit();
		
		return $result;

	}
	
	function getallstudentsearch($gender,$regno,$stname)
	{
		$result = $this->otherdb->select('TBL_ALLOTMENT.REGNO, 
		TBL_ALLOTMENT.STUDENTNAME, 
		TBL_ALLOTMENT.STUDENTPHONE,
		TBL_ALLOTMENT.FATHERNAME AS FATHERNAME, 
		TBL_ALLOTMENT.ALLOTEDDATE AS DATE, 
		TBL_ALLOTMENT.ALLOTTYPE AS TYPE, 
		TBL_ALLOTMENT.REMARKS AS REMARKS, 
		TBL_HOSTEL.HOSTEL_NO as HOSTELNO, 
		TBL_HOSTEL.HOSTELDESC as HOSTELNAME, 
		TBL_ROOM.ROOMDESC AS ROOMNO, 
		TBL_SEAT.SEAT, 
		SEMCODE, 
		TBL_ALLOTMENT.REMARKS')
			        ->from('TBL_ALLOTMENT')
					->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER')
					->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER')
					->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER')
					->where('TBL_ALLOTMENT.GENDER', $gender)
					->where('TBL_ALLOTMENT.REGNO', $regno)
					->or_where('TBL_ALLOTMENT.STUDENTNAME', $stname)
					->get()
					->result();
		
		if(!empty($result))
		  {
			  
			  return $result;
		  }
       
	    elseif(empty($result))
	      {
			$otherdb = $this->load->database('otherdb', TRUE);	
			$otherdb->select('TBL_REALLOTMENT.REGNO, 
			TBL_REALLOTMENT.STUDENTNAME,
			TBL_REALLOTMENT.STUDENTPHONE,  
			TBL_REALLOTMENT.ALLOTEDDATE AS DATE, 
			TBL_REALLOTMENT.FATHERNAME AS FATHERNAME, 
			TBL_REALLOTMENT.REMARKS AS REMARKS, 
			TBL_HOSTEL.HOSTEL_NO as HOSTELNO, 
			TBL_HOSTEL.HOSTELDESC as HOSTELNAME, 
			TBL_ROOM.ROOMDESC AS ROOMNO, TBL_SEAT.SEAT, 
			TBL_REALLOTMENT.ALLOTTYPE AS TYPE, SEMCODE, 
			TBL_REALLOTMENT.REMARKS');
			$otherdb->from('TBL_REALLOTMENT');
			$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_REALLOTMENT.SEATID','INNER');
			$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_REALLOTMENT.HOSTELID','INNER');
			$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_REALLOTMENT.ROOMID','INNER');
			$otherdb->where('TBL_REALLOTMENT.GENDER', $gender);
			$otherdb->where('TBL_REALLOTMENT.REGNO', $regno);
			$otherdb->or_where('TBL_REALLOTMENT.STUDENTNAME', $stname);
			$query = $otherdb->get();
			
			$result = $query->result();
			
			if(!empty($result))
		    {
			    return $result;
		    }       
	        elseif(empty($result))
			{
				$otherdb = $this->load->database('otherdb', TRUE);
				//$otherdb->select("'Clearance' as TYPE", false);
				$otherdb->select('TBL_CLEARANCE.REGNO, 
				TBL_CLEARANCE.STUDENTNAME, 
				TBL_HOSTEL.HOSTEL_NO AS HOSTELNO, 
				TBL_CLEARANCE.HOSTELDESC AS HOSTELNAME, 
				TBL_CLEARANCE.ROOMID AS ROOMNO, TBL_CLEARANCE.SEAT, 
				TBL_CLEARANCE.CLR_DATE AS DATE, TBL_CLEARANCE.SEMCODE');
				$otherdb->from('TBL_CLEARANCE');
				$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_CLEARANCE.HOSTELID','INNER');
				$query = $otherdb->where('TBL_CLEARANCE.GENDER', $gender);
				$query = $otherdb->where('TBL_CLEARANCE.REGNO', $regno);
				if(!empty($stname))
				{
				  $query = $otherdb->where('TBL_CLEARANCE.STUDENTNAME', $stname);
				}
				$query = $otherdb->get();
				
				$result = $query->result();
				
				if(!empty($result))
				{
					return $result;
				}
				elseif(empty($result))
				{
				    $otherdb = $this->load->database('otherdb', TRUE);
					$otherdb->select("'Clearance' as TYPE", false);
					$otherdb->select('REGNO, STUDENTNAME');
					$otherdb->from('TBL_BLACKLIST');
					$query = $otherdb->where('GENDER', $gender);
					$query = $otherdb->where('REGNO', $regno);
					if(!empty($stname))
					{
						$query = $otherdb->where('STUDENTNAME', $stname);
					}
					$query = $otherdb->get();
						
					$result = $query->result();
							
					if(!empty($result))
					{
						$blackregno = $result[0]->REGNO;
						$otherdb = $this->load->database('otherdb', TRUE);
						$otherdb->select("'Black List' as TYPE", false);
						$otherdb->select('TBL_ALLOTMENTHISTORY.REGNO, 
						TBL_ALLOTMENTHISTORY.STUDENTNAME, 
						TBL_ALLOTMENTHISTORY.FATHERNAME AS FATHERNAME, 
						TBL_ALLOTMENTHISTORY.ALLOTEDDATE AS DATE, 
						TBL_HOSTEL.HOSTEL_NO as HOSTELNO, 
						TBL_HOSTEL.HOSTELDESC as HOSTELNAME, 						
						TBL_ROOM.ROOMDESC AS ROOMNO, 
						TBL_SEAT.SEAT, 
						SEMCODE, 
						TBL_ALLOTMENTHISTORY.REMARKS');
						$otherdb->from('TBL_ALLOTMENTHISTORY');
						$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENTHISTORY.SEATID','INNER');
						$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENTHISTORY.HOSTELID','INNER');
						$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENTHISTORY.ROOMID','INNER');
						$otherdb->where('TBL_ALLOTMENTHISTORY.GENDER', $gender);
						$otherdb->where('TBL_ALLOTMENTHISTORY.REGNO', $blackregno);
						$otherdb->order_by('ALLOTMENTHISTORY_ID', 'desc');
						$otherdb->limit('1');
									$query = $otherdb->get();
									
									$result = $query->result();
								return $result;
							  }
					 
				 elseif(empty($result))
					  {
						$otherdb = $this->load->database('otherdb', TRUE);
						$otherdb->select("'Defaulter' as TYPE", false);
						$otherdb->select('TBL_ALLOTREALLOT.REGNO, TBL_ALLOTREALLOT.STUDENTNAME, TBL_ALLOTREALLOT.FATHERNAME AS FATHERNAME, TBL_ALLOTREALLOT.ALLOTEDDATE AS DATE, TBL_HOSTEL.HOSTEL_NO as HOSTELNO, TBL_HOSTEL.HOSTELDESC as HOSTELNAME, TBL_ROOM.ROOMDESC AS ROOMNO, TBL_SEAT.SEAT, SEMCODE, TBL_ALLOTREALLOT.REMARKS');
			$otherdb->from('TBL_ALLOTREALLOT');
			$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTREALLOT.SEATID','INNER');
			$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTREALLOT.HOSTELID','INNER');
			$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTREALLOT.ROOMID','INNER');
			$otherdb->where('TBL_ALLOTREALLOT.GENDER', $gender);
			$otherdb->where('TBL_ALLOTREALLOT.REGNO', $regno);
			$otherdb->or_where('TBL_ALLOTREALLOT.STUDENTNAME', $stname);
						$query = $otherdb->get();
						
						$result = $query->result();
						       
							   if(!empty($result))
								  {
									return $result;
								  }
								  
								elseif(empty($result))
								  {
									$otherdb = $this->load->database('otherdb', TRUE);
									$otherdb->select("'History' as TYPE", false);
									$otherdb->select('TBL_ALLOTMENTHISTORY.REGNO, TBL_ALLOTMENTHISTORY.STUDENTNAME, TBL_ALLOTMENTHISTORY.FATHERNAME AS FATHERNAME, TBL_ALLOTMENTHISTORY.ALLOTEDDATE AS DATE, TBL_HOSTEL.HOSTEL_NO as HOSTELNO, TBL_HOSTEL.HOSTELDESC as HOSTELNAME, TBL_ROOM.ROOMDESC AS ROOMNO, TBL_SEAT.SEAT, SEMCODE');
						$otherdb->from('TBL_ALLOTMENTHISTORY');
						$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENTHISTORY.SEATID','INNER');
						$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENTHISTORY.HOSTELID','INNER');
						$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENTHISTORY.ROOMID','INNER');
						$otherdb->where('TBL_ALLOTMENTHISTORY.GENDER', $gender);
						$otherdb->where('TBL_ALLOTMENTHISTORY.REGNO', $regno);
						$otherdb->or_where('TBL_ALLOTMENTHISTORY.STUDENTNAME', $stname);
						$otherdb->order_by('ALLOTMENTHISTORY_ID', 'asc');
									$query = $otherdb->get();
									
									$result = $query->result();
									
									return $result; 
						}
					}
						
			    }				   
			}			   
		}
	}
	   
   function gethistoryInfo($gender,$regno,$stname)
	 {
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('TBL_ALLOTMENTHISTORY.REGNO, TBL_ALLOTMENTHISTORY.STUDENTNAME, TBL_ALLOTMENTHISTORY.ALLOTEDDATE AS DATE, TBL_ALLOTMENTHISTORY.ALLOTTYPE AS TYPE, TBL_HOSTEL.HOSTEL_NO as HOSTELNO, TBL_HOSTEL.HOSTELDESC as HOSTELNAME, TBL_ROOM.ROOMDESC AS ROOMNO, TBL_SEAT.SEAT, TBL_ALLOTMENTHISTORY.SEMCODE, TBL_ALLOTMENTHISTORY.HOSTELBATCH');
        $otherdb->from('TBL_ALLOTMENTHISTORY');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENTHISTORY.SEATID','INNER');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENTHISTORY.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENTHISTORY.ROOMID','INNER');
		$otherdb->where('TBL_ALLOTMENTHISTORY.GENDER', $gender);
		$otherdb->where('TBL_ALLOTMENTHISTORY.REGNO', $regno);
        $query = $otherdb->get();
		$query1 = $query->result();
		
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('TBL_CLEARANCE.REGNO, TBL_CLEARANCE.STUDENTNAME, TBL_CLEARANCE.CLR_DATE AS DATE, TBL_CLEARANCE.SEMTYPE AS TYPE, TBL_HOSTEL.HOSTEL_NO as HOSTELNO, TBL_CLEARANCE.HOSTELDESC as HOSTELNAME, TBL_CLEARANCE.ROOMID AS ROOMNO, TBL_CLEARANCE.SEAT, TBL_CLEARANCE.SEMCODE, TBL_CLEARANCE.HOSTELBATCH');
        $otherdb->from('TBL_CLEARANCE');
        $otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_CLEARANCE.HOSTELID','INNER');
		$otherdb->where('TBL_CLEARANCE.GENDER', $gender);
		$otherdb->where('TBL_CLEARANCE.REGNO', $regno);
        $query = $otherdb->get();
		$query2 = $query->result();
		
		
		$result = array_merge($query1, $query2);
		
		return $result;
	 }

     function getStudentCreditHours($regno, $currentSemester){

     	$this->db->select_sum('CREDITHRS');
        $this->db->from('TBL_STUDSEMCOURSE');
 		$this->db->where('TBL_STUDSEMCOURSE.REGNO', $regno);
 		$this->db->where('TBL_STUDSEMCOURSE.SEMCODE', $currentSemester);
 		$query =  $this->db->get();
         
         return $query->result();

     }

      function GetHistoryBatch($studregno)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('tbl_allotmenthistory.regno', $studregno);
		$otherdb->where('tbl_allotmenthistory.allottype like', 'A%');
		$otherdb->select('tbl_allotmenthistory.regno, tbl_allotmenthistory.semcode, tbl_allotmenthistory.hostelbatch');
		$otherdb->from('tbl_allotmenthistory');
		$otherdb->order_by('tbl_allotmenthistory.ALLOTMENTHISTORY_ID', 'asc');
		$otherdb->limit('1');
        $query = $otherdb->get();
		
		return $query->row();
       
    }
	
	function GetAllregnoInfo($currentsemcode, $gender)
    {
		return $this->otherdb->where('tbl_allotreallot.gender', $gender)
					->where('tbl_allotreallot.semcode', $currentsemcode)
					->where('tbl_allotreallot.HOSTELBATCH', null)
			       	->get('tbl_allotreallot')
					->result();
    }
	
	function UpdateHostelBatch($upregno, $updatehostelbatch, $currentsemcode)
    {
		$this->otherdb->where('REGNO',$upregno)
						->where('SEMCODE',$currentsemcode)
						->where('HOSTELBATCH',null)
        				->update('tbl_allotreallot', $updatehostelbatch);
        
        return $this->otherdb->affected_rows();
    }

    function insertIntoAlotmentHistory($histroyData){

        $this->otherdb->insert('tbl_allotmenthistory', $histroyData);

        return $this->otherdb->insert_id();   		 
    }

	 function CurrentSemester($gender)
    {
		return $this->otherdb->select('distinct(SEMCODE) as semcode')
					->where('GENDER', $gender)
					//->limit('1')
					//->order_by('SMCODE', 'DESC')
					->where('IS_ACTIVE', '1')
		        	->get('TBL_SEMESTER')			
					->row();
	}
	
}

