<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', '-1');
error_reporting(E_ALL);

class remarks_model extends CI_Model
{
	public function __construct(){

		$this->otherdb = $this->load->database('otherdb', TRUE);
	}

    public function updateStudentRemarks($remarksData){ 

        if($this->findRemarks($remarksData['REGNO'])){
            $REGNO = $remarksData['REGNO'];
            unset($remarksData['REGNO']);
            $this->otherdb->where('REGNO',$REGNO)->update('student_remarks', $remarksData);
            
            return $this->otherdb->affected_rows();

        } else {

            $this->otherdb->insert('student_remarks', $remarksData);

            return $this->otherdb->insert_id();
        } 

        
    }

    public function findRemarks($regno){
        // return $this->otherdb->where('REGNO',$regno)
        // ->get('student_remarks')
        // ->result();

        return $this->otherdb->select('student_remarks.*,tbl_users.name as remarked_by')
					->from('student_remarks')
					->join('tbl_users', 'tbl_users.userid = student_remarks.REMARKED_BY','INNER')
					->where('student_remarks.REGNO', $regno)
			        ->get()		
					->result();
    }


    
    function HostelCardsDetailId($regno, $gender)
    {
		
        $this->otherdb->select('TBL_ALLOTMENT.*,TBL_ALLOTMENT.STUDENTNAME AS NAME, TBL_ALLOTMENT.ALLOTMENT_ID AS ID, TBL_ALLOTMENT.ALLOTEDDATE AS ISSUEDATE, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_SEAT.SEAT');
        $this->otherdb->from('TBL_ALLOTMENT');
		$this->otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER');
		$this->otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER');
		$this->otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER');
		$this->otherdb->where('TBL_ALLOTMENT.REGNO', $regno);
		$this->otherdb->where('TBL_ALLOTMENT.GENDER', $gender);
        $query = $this->otherdb->get();
		
		if(!empty($query->num_rows))
		{
        	return $query->result();
		}
		elseif(empty($query->num_rows))
		{			 
			
			$this->otherdb->select('TBL_REALLOTMENT.*,
            TBL_REALLOTMENT.STUDENTNAME AS NAME, 
            TBL_REALLOTMENT.REALLOTMENT_ID AS ID, 
            TBL_REALLOTMENT.ALLOTEDDATE AS ISSUEDATE, TBL_HOSTEL.HOSTEL_NO, 
            TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_SEAT.SEAT');
			$this->otherdb->from('TBL_REALLOTMENT');
			$this->otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_REALLOTMENT.HOSTELID','INNER');
			$this->otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_REALLOTMENT.ROOMID','INNER');
			$this->otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_REALLOTMENT.SEATID','INNER');
			$this->otherdb->where('TBL_REALLOTMENT.REGNO', $regno);
			$this->otherdb->where('TBL_REALLOTMENT.GENDER', $gender);
			$query = $this->otherdb->get();
			
			if(!empty($query->num_rows))
            {
                return $query->result();
            }
            else
            {			
                $this->otherdb->select('TBL_ATTACHMENT.*,TBL_ATTACHMENT.ATTACHMENT_ID AS ID, TBL_ATTACHMENT.ATTACHDATE AS ISSUEDATE, TBL_ATTACHMENT.ATTACHREGNO AS REGNO, TBL_ATTACHMENT.ATTACHNAME AS NAME,TBL_ATTACHMENT.ATACHSTATUS AS ALLOTTYPE, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMID, TBL_ROOM.ROOMDESC, TBL_SEAT.SEAT');
                $this->otherdb->from('TBL_ATTACHMENT');
                $this->otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ATTACHMENT.HOSTELID','INNER');
                $this->otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ATTACHMENT.ROOMID','INNER');
                $this->otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ATTACHMENT.SEATID','INNER');
                $this->otherdb->where('TBL_ATTACHMENT.ATTACHREGNO', $regno);
                $this->otherdb->where('TBL_ATTACHMENT.GENDER', $gender);
                $query = $this->otherdb->get();
                
                if(!empty($query->num_rows))
                {
                    return $query->result();
                }
                else
                {			
                    $this->otherdb->select('tbl_allotmenthistory.*,
                    tbl_allotmenthistory.STUDENTNAME AS NAME,
                    tbl_allotmenthistory.REGNO AS REGNO,
                    tbl_allotmenthistory.ALLOTTYPE AS ALLOTTYPE,
                    TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, 
                    TBL_ROOM.ROOMID, TBL_ROOM.ROOMDESC, TBL_SEAT.SEAT');
                    $this->otherdb->from('tbl_allotmenthistory');
                    $this->otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = tbl_allotmenthistory.HOSTELID','INNER');
                    $this->otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = tbl_allotmenthistory.ROOMID','INNER');
                    $this->otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = tbl_allotmenthistory.SEATID','INNER');
                    $this->otherdb->where('tbl_allotmenthistory.REGNO', $regno);
                    $this->otherdb->where('tbl_allotmenthistory.GENDER', $gender);
                    $this->otherdb->order_by('ALLOTMENTHISTORY_ID','DESC');
                    $query = $this->otherdb->get();
                    
                    return $query->result();
                    
                }                    
            }
	   }
	}
}