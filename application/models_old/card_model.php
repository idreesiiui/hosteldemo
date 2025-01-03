<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Card_model extends CI_Model
{
    
	public function __construct(){

		$this->otherdb = $this->load->database('otherdb', TRUE);
		
	}	
	
	
    function HostelCardsDetailId($regno, $gender)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_ALLOTMENT.*,TBL_ALLOTMENT.STUDENTNAME AS NAME, TBL_ALLOTMENT.ALLOTMENT_ID AS ID, TBL_ALLOTMENT.ALLOTEDDATE AS ISSUEDATE, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_SEAT.SEAT');
        $otherdb->from('TBL_ALLOTMENT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER');
		$otherdb->where('TBL_ALLOTMENT.REGNO', $regno);
		$otherdb->where('TBL_ALLOTMENT.GENDER', $gender);
        $query = $otherdb->get();
		
		if(!empty($query->num_rows))
		{
        	return $query->result();
		}
		elseif(empty($query->num_rows))
		 {
			 
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('TBL_REALLOTMENT.*,TBL_REALLOTMENT.STUDENTNAME AS NAME, TBL_REALLOTMENT.REALLOTMENT_ID AS ID, TBL_REALLOTMENT.ALLOTEDDATE AS ISSUEDATE, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_SEAT.SEAT');
			$otherdb->from('TBL_REALLOTMENT');
			$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_REALLOTMENT.HOSTELID','INNER');
			$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_REALLOTMENT.ROOMID','INNER');
			$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_REALLOTMENT.SEATID','INNER');
			$otherdb->where('TBL_REALLOTMENT.REGNO', $regno);
			$otherdb->where('TBL_REALLOTMENT.GENDER', $gender);
			$query = $otherdb->get();
			
			if(!empty($query->num_rows))
				{
					return $query->result();
				}
		else
		{
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('TBL_ATTACHMENT.*,TBL_ATTACHMENT.ATTACHMENT_ID AS ID, TBL_ATTACHMENT.ATTACHDATE AS ISSUEDATE, TBL_ATTACHMENT.ATTACHREGNO AS REGNO, TBL_ATTACHMENT.ATTACHNAME AS NAME,TBL_ATTACHMENT.ATACHSTATUS AS ALLOTTYPE, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMID, TBL_ROOM.ROOMDESC, TBL_SEAT.SEAT');
        	$otherdb->from('TBL_ATTACHMENT');
			$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ATTACHMENT.HOSTELID','INNER');
			$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ATTACHMENT.ROOMID','INNER');
			$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ATTACHMENT.SEATID','INNER');
			$otherdb->where('TBL_ATTACHMENT.ATTACHREGNO', $regno);
			$otherdb->where('TBL_ATTACHMENT.GENDER', $gender);
        	$query = $otherdb->get();
			
			return $query->result();
			
	       }
	   }
	}
	
	function CardsinfoByHostelAllotment($key, $hostelno, $roomno, $semcode, $gender, $type)
    {
	    if($hostelno == ''){
			return $this->otherdb->select('TBL_ALLOTMENT.REGNO, TBL_ALLOTMENT.STUDENTNAME AS NAME, TBL_ALLOTMENT.GENDER, TBL_ALLOTMENT.FATHERNAME, TBL_ALLOTMENT.ALLOTMENT_ID AS ID, TBL_ALLOTMENT.ALLOTEDDATE AS ISSUEDATE, TBL_ALLOTMENT.EXPIRYDATE, TBL_ALLOTMENT.EMAILID, TBL_ALLOTMENT.ALLOTTYPE, TBL_ALLOTMENT.card_expiry_date, TBL_ALLOTMENT.card_remarks, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_SEAT.SEAT')
					->from('TBL_ALLOTMENT')
					->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER')
					->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER')
					->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER')
					->join('TBL_KEY', 'TBL_KEY.REGNO = TBL_ALLOTMENT.REGNO','INNER')
					->like('TBL_KEY.KEY', $key)
					->where('TBL_KEY.TYPE', $type)
					->where('TBL_ALLOTMENT.SEMCODE', $semcode)
					->where('TBL_ALLOTMENT.GENDER', $gender)
					->where('TBL_ALLOTMENT.ADMIN_VERIFY', 1)
					->order_by('ROOMDESC', 'asc')
					->get()			
					->result();

		} elseif($hostelno != '')
		{
			return $this->otherdb->select('TBL_ALLOTMENT.REGNO, TBL_ALLOTMENT.STUDENTNAME AS NAME, TBL_ALLOTMENT.GENDER, TBL_ALLOTMENT.FATHERNAME, TBL_ALLOTMENT.ALLOTMENT_ID AS ID, TBL_ALLOTMENT.ALLOTEDDATE AS ISSUEDATE, TBL_ALLOTMENT.EXPIRYDATE, TBL_ALLOTMENT.EMAILID, TBL_ALLOTMENT.ALLOTTYPE, TBL_ALLOTMENT.card_expiry_date, TBL_ALLOTMENT.card_remarks, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_SEAT.SEAT')
						->from('TBL_ALLOTMENT')
						->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER')
						->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER')
						->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER')
						->join('TBL_KEY', 'TBL_KEY.REGNO = TBL_ALLOTMENT.REGNO','INNER')
						->like('TBL_KEY.KEY', $key)
						->where('TBL_KEY.TYPE', $type)
						->where('TBL_ALLOTMENT.SEMCODE', $semcode)
						->where('TBL_ALLOTMENT.HOSTELID', $hostelno)
						->where('TBL_ALLOTMENT.GENDER', $gender)
						->where('TBL_ALLOTMENT.ADMIN_VERIFY', 1)
						->order_by('ROOMDESC', 'asc')
						->get()			
						->result();	  
		}
	}
	
	function CardsinfoByHostelReAllotment($key, $hostelno, $roomno, $semcode, $gender, $type)
    {
			return $this->otherdb->select('TBL_REALLOTMENT.REGNO, TBL_REALLOTMENT.STUDENTNAME AS NAME, TBL_REALLOTMENT.GENDER, TBL_REALLOTMENT.FATHERNAME, TBL_REALLOTMENT.REALLOTMENT_ID AS ID, TBL_REALLOTMENT.ALLOTEDDATE AS ISSUEDATE,TBL_REALLOTMENT.EXPIRYDATE, TBL_REALLOTMENT.card_expiry_date, TBL_REALLOTMENT.card_remarks, TBL_REALLOTMENT.EMAILID, TBL_REALLOTMENT.ALLOTTYPE, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_SEAT.SEAT')
						->from('TBL_REALLOTMENT')
						->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_REALLOTMENT.HOSTELID','INNER')
						->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_REALLOTMENT.ROOMID','INNER')
						->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_REALLOTMENT.SEATID','INNER')
						->join('TBL_KEY', 'TBL_KEY.REGNO = TBL_REALLOTMENT.REGNO','INNER')
						->like('TBL_KEY.KEY', $key)
						->where('TBL_KEY.TYPE', $type)
						->where('TBL_REALLOTMENT.SEMCODE', $semcode)
						->where('TBL_REALLOTMENT.HOSTELID', $hostelno)
						->where('TBL_REALLOTMENT.GENDER', $gender)
						->where('TBL_REALLOTMENT.ADMIN_VERIFY', 1)
						->order_by('ROOMDESC', 'asc')
						->get()			
						->result();	
	}
	
	function CardsDetailByHostelReAllotment($key, $hostelno, $roomno, $semcode, $gender, $type)
    {
	        $otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('TBL_ALLOTMENT.REGNO, TBL_ALLOTMENT.STUDENTNAME AS NAME, TBL_ALLOTMENT.GENDER, TBL_ALLOTMENT.FATHERNAME, TBL_ALLOTMENT.ALLOTMENT_ID AS ID, TBL_ALLOTMENT.ALLOTEDDATE AS ISSUEDATE, TBL_ALLOTMENT.EXPIRYDATE, TBL_ALLOTMENT.EMAILID, TBL_ALLOTMENT.ALLOTTYPE, TBL_ALLOTMENT.card_expiry_date, TBL_ALLOTMENT.card_remarks, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_SEAT.SEAT');
			$otherdb->from('TBL_ALLOTMENT');
			$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER');
			$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER');
			$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER');
			$otherdb->join('TBL_KEY', 'TBL_KEY.REGNO = TBL_ALLOTMENT.REGNO','INNER');
			$otherdb->like('TBL_KEY.KEY', $key);
			$otherdb->where('TBL_KEY.TYPE', $type);
			$otherdb->where('TBL_ALLOTMENT.SEMCODE', $semcode);
			$otherdb->where('TBL_ALLOTMENT.HOSTELID', $hostelno);
			$otherdb->like('TBL_ALLOTMENT.ROOMID', $roomno);
			$otherdb->where('TBL_ALLOTMENT.GENDER', $gender);
			$otherdb->where('TBL_ALLOTMENT.ADMIN_VERIFY', 1);
			$query = $otherdb->get();
			
			$query1 = $otherdb->last_query();
			
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('TBL_REALLOTMENT.REGNO, TBL_REALLOTMENT.STUDENTNAME AS NAME, TBL_REALLOTMENT.GENDER, TBL_REALLOTMENT.FATHERNAME, TBL_REALLOTMENT.REALLOTMENT_ID AS ID, TBL_REALLOTMENT.ALLOTEDDATE AS ISSUEDATE,TBL_REALLOTMENT.EXPIRYDATE, TBL_REALLOTMENT.EMAILID, TBL_REALLOTMENT.ALLOTTYPE, TBL_REALLOTMENT.card_expiry_date, TBL_REALLOTMENT.card_remarks, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_SEAT.SEAT');
			$otherdb->from('TBL_REALLOTMENT');
			$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_REALLOTMENT.HOSTELID','INNER');
			$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_REALLOTMENT.ROOMID','INNER');
			$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_REALLOTMENT.SEATID','INNER');
			$otherdb->join('TBL_KEY', 'TBL_KEY.REGNO = TBL_REALLOTMENT.REGNO','INNER');
			$otherdb->like('TBL_KEY.KEY', $key);
			$otherdb->where('TBL_KEY.TYPE', $type);
			$otherdb->where('TBL_REALLOTMENT.SEMCODE', $semcode);
			$otherdb->where('TBL_REALLOTMENT.HOSTELID', $hostelno);
			$otherdb->where('TBL_REALLOTMENT.ROOMID', $roomno);
			$otherdb->where('TBL_REALLOTMENT.GENDER', $gender);
			$otherdb->where('TBL_REALLOTMENT.ADMIN_VERIFY', 1);
			$otherdb->order_by('ROOMDESC', 'asc');
			
			$otherdb->get(); 
			$query2 =  $otherdb->last_query();
			$query = $otherdb->query($query1." UNION ".$query2);
			
			return $result = $query->result();	
	}
	
	function CardsDetailByHostel($key, $hostelno, $semcode, $gender)
    {
	        $otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('TBL_ALLOTMENT.REGNO, TBL_ALLOTMENT.STUDENTNAME AS NAME, TBL_ALLOTMENT.GENDER, TBL_ALLOTMENT.FATHERNAME, TBL_ALLOTMENT.ALLOTMENT_ID AS ID, TBL_ALLOTMENT.ALLOTEDDATE AS ISSUEDATE, TBL_ALLOTMENT.EXPIRYDATE,TBL_ALLOTMENT.EMAILID, TBL_ALLOTMENT.ALLOTTYPE, TBL_ALLOTMENT.card_expiry_date, TBL_ALLOTMENT.card_remarks, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_SEAT.SEAT');
			$otherdb->from('TBL_ALLOTMENT');
			$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER');
			$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER');
			$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER');
			$otherdb->join('TBL_KEY', 'TBL_KEY.REGNO = TBL_ALLOTMENT.REGNO','INNER');
			$otherdb->like('TBL_KEY.KEY', $key);
			$otherdb->where('TBL_ALLOTMENT.SEMCODE', $semcode);
			$otherdb->where('TBL_ALLOTMENT.HOSTELID', $hostelno);
			$otherdb->where('TBL_ALLOTMENT.GENDER', $gender);
			$otherdb->where('TBL_ALLOTMENT.ADMIN_VERIFY', 1);
			$query = $otherdb->get();
			
			$query1 = $otherdb->last_query();
			
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('TBL_REALLOTMENT.REGNO, TBL_REALLOTMENT.STUDENTNAME AS NAME, TBL_REALLOTMENT.GENDER, TBL_REALLOTMENT.FATHERNAME, TBL_REALLOTMENT.REALLOTMENT_ID AS ID, TBL_REALLOTMENT.ALLOTEDDATE AS ISSUEDATE,TBL_REALLOTMENT.EXPIRYDATE,TBL_REALLOTMENT.EMAILID, TBL_REALLOTMENT.ALLOTTYPE, TBL_REALLOTMENT.card_expiry_date, TBL_REALLOTMENT.card_remarks, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_SEAT.SEAT');
			$otherdb->from('TBL_REALLOTMENT');
			$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_REALLOTMENT.HOSTELID','INNER');
			$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_REALLOTMENT.ROOMID','INNER');
			$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_REALLOTMENT.SEATID','INNER');
			$otherdb->join('TBL_KEY', 'TBL_KEY.REGNO = TBL_REALLOTMENT.REGNO','INNER');
			$otherdb->like('TBL_KEY.KEY', $key);
			$otherdb->where('TBL_REALLOTMENT.SEMCODE', $semcode);
			$otherdb->where('TBL_REALLOTMENT.HOSTELID', $hostelno);
			$otherdb->where('TBL_REALLOTMENT.GENDER', $gender);
			$otherdb->where('TBL_REALLOTMENT.ADMIN_VERIFY', 1);
			$otherdb->order_by('ROOMDESC', 'asc');
			$otherdb->get();
			 
			$query2 =  $otherdb->last_query();
			$query = $otherdb->query($query1." UNION ".$query2);
			
			return $result = $query->result();	
	}
	
	function CardsDetailByKey($key, $semcode, $gender)
    {
	        $otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('TBL_ALLOTMENT.REGNO, TBL_ALLOTMENT.STUDENTNAME AS NAME, TBL_ALLOTMENT.GENDER, TBL_ALLOTMENT.FATHERNAME, TBL_ALLOTMENT.ALLOTMENT_ID AS ID, TBL_ALLOTMENT.ALLOTEDDATE AS ISSUEDATE, TBL_ALLOTMENT.EXPIRYDATE, TBL_ALLOTMENT.EMAILID, TBL_ALLOTMENT.ALLOTTYPE, TBL_ALLOTMENT.card_expiry_date, TBL_ALLOTMENT.card_remarks, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_SEAT.SEAT');
			$otherdb->from('TBL_ALLOTMENT');
			$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER');
			$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER');
			$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER');
			$otherdb->join('TBL_KEY', 'TBL_KEY.REGNO = TBL_ALLOTMENT.REGNO','INNER');
			$otherdb->like('TBL_KEY.KEY', $key);
			$otherdb->where('TBL_ALLOTMENT.SEMCODE', $semcode);
			$otherdb->where('TBL_ALLOTMENT.GENDER', $gender);
		    $otherdb->where('TBL_ALLOTMENT.ADMIN_VERIFY', 1);
			$query = $otherdb->get();
			
			$query1 = $otherdb->last_query();
			
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('TBL_REALLOTMENT.REGNO, TBL_REALLOTMENT.STUDENTNAME AS NAME, TBL_REALLOTMENT.GENDER, TBL_REALLOTMENT.FATHERNAME, TBL_REALLOTMENT.REALLOTMENT_ID AS ID, TBL_REALLOTMENT.ALLOTEDDATE AS ISSUEDATE,TBL_REALLOTMENT.EXPIRYDATE,TBL_REALLOTMENT.EMAILID, TBL_REALLOTMENT.ALLOTTYPE, TBL_REALLOTMENT.card_expiry_date, TBL_REALLOTMENT.card_remarks, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_SEAT.SEAT');
			$otherdb->from('TBL_REALLOTMENT');
			$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_REALLOTMENT.HOSTELID','INNER');
			$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_REALLOTMENT.ROOMID','INNER');
			$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_REALLOTMENT.SEATID','INNER');
			$otherdb->join('TBL_KEY', 'TBL_KEY.REGNO = TBL_REALLOTMENT.REGNO','INNER');
			$otherdb->like('TBL_KEY.KEY', $key);
			$otherdb->where('TBL_REALLOTMENT.SEMCODE', $semcode);
			$otherdb->where('TBL_REALLOTMENT.GENDER', $gender);
			$otherdb->where('TBL_REALLOTMENT.ADMIN_VERIFY', 1);
			$otherdb->order_by('HOSTEL_NO', 'asc');
			$otherdb->order_by('ROOMDESC', 'asc');
	
			$otherdb->get(); 
			$query2 =  $otherdb->last_query();
			$query = $otherdb->query($query1." UNION ".$query2);
			
			return $result = $query->result();	
	}
	
	function CardsDetailIdByHostelRoom($hostelno,$roomno)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_ALLOTMENT.*,TBL_ALLOTMENT.STUDENTNAME AS NAME, TBL_ALLOTMENT.ALLOTMENT_ID AS ID, TBL_ALLOTMENT.ALLOTEDDATE AS ISSUEDATE, TBL_HOSTEL.HOSTEL_NO, TBL_ALLOTMENT.card_expiry_date, TBL_ALLOTMENT.card_remarks, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_SEAT.SEAT');
        $otherdb->from('TBL_ALLOTMENT');
		$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER');
		$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER');
		$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER');
		$otherdb->where('TBL_ALLOTMENT.HOSTELID', $hostelno);
		$otherdb->where('TBL_ALLOTMENT.ROOMID', $roomno);
        $query = $otherdb->get();
		
		if(!empty($query->num_rows))
		{
        	return $query->result();
		}
		else
		{
			/*$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('TBL_ATTACHMENT.*,TBL_ATTACHMENT.ATTACHMENT_ID AS ID, TBL_ATTACHMENT.RADATE AS ISSUEDATE, TBL_ATTACHMENT.GUESTREGNO AS REGNO, TBL_ATTACHMENT.GUESTNAME AS NAME, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMID, TBL_SEAT.SEAT');
        	$otherdb->from('TBL_ATTACHMENT');
			$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ATTACHMENT.HOSTELID','INNER');
			$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ATTACHMENT.ROOMID','INNER');
			$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ATTACHMENT.SEATID','INNER');
			$otherdb->where('TBL_ALLOTMENT.HOSTELID', $hostelno);
		    $otherdb->where('TBL_ALLOTMENT.ROOMID', $roomno);
        	$query = $otherdb->get();*/
			
			$otherdb = $this->load->database('otherdb', TRUE);
			$otherdb->select('TBL_REALLOTMENT.*,TBL_REALLOTMENT.STUDENTNAME AS NAME, TBL_REALLOTMENT.REALLOTMENT_ID AS ID, TBL_REALLOTMENT.ALLOTEDDATE AS ISSUEDATE, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_SEAT.SEAT');
			$otherdb->from('TBL_REALLOTMENT');
			$otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_REALLOTMENT.HOSTELID','INNER');
			$otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_REALLOTMENT.ROOMID','INNER');
			$otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_REALLOTMENT.SEATID','INNER');
			//$otherdb->limit(500);
			$otherdb->where('TBL_REALLOTMENT.HOSTELID', $hostelno);
			//$otherdb->where('TBL_REALLOTMENT.ROOMID', $roomno);
			$query = $otherdb->get();
			
			return $query->result();
			
	    }
		return $query->result();
	}
	
	function GetEmail($emailid)
    {
		return $this->otherdb->select('EMAIL')
					->where('userId',$emailid)
					->get('TBL_USERS')
					->result();
    }
	
	function GetGenderById($userId)
    {
		return $this->otherdb->select('GENDER')
					->where('userId',$userId)
					->get('TBL_USERS')
					->result();
    }
	
	function HostelCardsDetailById($CardID)
    {
		
		return $this->otherdb->where('HCARDNO', $CardID)->get('TBL_HOSTELCARD')->result();			
	    
	}
	
	function Gettype($gender)
    {
		return $this->otherdb->select('distinct(TYPE)')
					->where('GENDER', $gender)
					->group_by('TYPE')
					->get('tbl_key')
					->result();
    }
	
	function GetActiveSem($gender)
    {
		return $this->otherdb->select('distinct(SEMCODE)')
					->where('GENDER', $gender)
					//->where('IS_ACTIVE','1')
					 ->group_by('SEMCODE')
					 ->order_by('SMCODE','DESC')
					 ->limit('1')
			        ->get('TBL_SEMESTER')
			        ->result();
    }
	
	function GetKey($gender)
    {
			return $this->otherdb->distinct('KEY')
						->select('KEY')
						->where('GENDER', $gender)
						->get('tbl_key')
						->result();
	}
	
	function HostelDetail($gender)
    {
		return $this->otherdb->where('GENDER', $gender)
					->get('TBL_HOSTEL')
					->result();
	}
	
	function getemailinfo($emailid, $gender)
  	{
		return $this->otherdb->select('email')
					->where('GENDER', $gender)
					->where('userId', $emailid)
					->get('tbl_users')
					->result();
  	}
	 
	function emailinfoByRegno($regno, $gender)
    {
		return $this->otherdb->select('email')
					->where('GENDER', $gender)
					->where('regno', $regno)
					->get('tbl_users')
					->result();
	}
	
    function viewClearanceInfo()
    {
        $query = $this->otherdb->select('TBL_ATTACHMENT.*,TBL_SEAT.SEAT')
			        ->from('TBL_ATTACHMENT')
					->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ATTACHMENT.SEATID','INNER')
			        ->get();
        
		if(!empty($query->num_rows()))
		{
        	return $query->result();
		}
		else
		{
			return $this->otherdb->select('TBL_ALLOTMENT.*, TBL_ALLOTMENT.REGNO AS GUESTREGNO, TBL_SEAT.SEAT')
						->from('TBL_ALLOTMENT')
						->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ATTACHMENT.SEATID','INNER')
						->get()
			        	->result();
		}
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
	
	function getVisitorInfobyId($AllotID)
    {
        return $this->otherdb->select('TBL_VISITORS.*, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMDESC, TBL_SEAT.SEAT')
			        ->from('TBL_VISITORS')
					->where('VISITORID',$AllotID)
					->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTEL_NO = TBL_VISITORS.HOSTELID','INNER')
					->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_VISITORS.ROOMID','INNER')
					->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_VISITORS.SEATID','INNER')
			        ->get()
			        ->result();
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
		return $this->otherdb->select('TBL_ROOM.ROOMID, TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.HOSTELID AS RHOSTELID, TBL_ROOM.ROOMDESC, TBL_ROOM.ROOMTYPE, TBL_ROOM.SCAPACITY, TBL_ROOM.FLOOR, TBL_ROOM.BEDS, TBL_ROOM.CHAIRS, TBL_ROOM.TABLES, TBL_ROOM.CUPBOARDS, TBL_ROOM.TUBELIGHTS, TBL_ROOM.FANS, TBL_ROOM.OTHERITEMS')
					->from('TBL_ROOM')
					->where('ROOMID',$ROOMID)
					->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ROOM.HOSTELID','INNER')
					->get()
					->result();
    }   
	

    function VisitorEdit($visitorInfo, $visitid)
    {
		$this->otherdb->where('VISITORID',$visitid)->update('TBL_VISITORS', $visitorInfo);
        
        return $this->otherdb->affected_rows();
    }
    
    function UpdatedSeatStatus($updateseatstatus,$seatavilabel)
    {
		$this->otherdb->where('SEATID',$seatavilabel)->update('TBL_SEAT', $updateseatstatus);
        
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
   
	
	function getroombyHostelId($hostelid)
    {
		return $this->otherdb->select('ROOMID')
					->where('HOSTELID', $hostelid)
					->get('TBL_ROOM')
					->result();
       
    }
	
	function GetVisitNo($regno)
    {
		$query = $this->otherdb->select('VISTOR_NO')
					->where('REGNO', $regno)
					->get('TBL_VISITORS');

		return $query->num_rows();
       
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


    function getfnameoradb($regno)
    {
        return $this->db->select('FATHERNAME')
			        ->where('REGNO', $regno)
			        ->get('TBL_HSTUDENTS')
			        ->result();

    }
    
   
    function GetroomitemByRegno($regno)
    {
	
		return $this->otherdb->where('REGNO', $regno)
					->ORDER_BY('ITEM_ID','DESC')
					->get('TBL_ROOMITEM')
					->result();
	
    }
	
	
	function VerifyUserRecordById($regno)
    {
		return $this->otherdb->select('TBL_ALLOTMENT.*,TBL_ALLOTMENT.STUDENTNAME AS NAME,TBL_HOSTEL.HOSTELDESC,TBL_ROOM.ROOMDESC')
					->from('TBL_ALLOTMENT')
					->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTEL_NO = TBL_ALLOTMENT.HOSTELID','INNER')
					->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER')
					->where('REGNO', $regno)
			        ->get()		
					->result();
	
    }
	
	function VerifyUserRecordByguestId($regno)
    {
		return $this->otherdb->select('TBL_ATTACHMENT.*,TBL_ATTACHMENT.GUESTREGNO AS REGNO,TBL_ATTACHMENT.GUESTNAME AS NAME,TBL_HOSTEL.HOSTELDESC,TBL_ROOM.ROOMDESC')
					->from('TBL_ATTACHMENT')
					->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTEL_NO = TBL_ATTACHMENT.HOSTELID','INNER')
					->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ATTACHMENT.ROOMID','INNER')
					->where('GUESTREGNO', $regno)
			        ->get()		
					->result();
	
    }

    public function getExpirationDate($regno)
    {
        
        $regno = base64_decode($regno);

        $result = $this->db->where('TBL_HSTUDENTS.REGNO', $regno)
        					->get('TBL_HSTUDENTS')        
         					->result_array();

        $batchcode = $result[0]['BATCHCODE'];
        $ACADPROGCODE = $result[0]['ACADPROGCODE'];
        $YEAROFADM = $result[0]['STADMISSION'];

        $degree_duration = $this->db->where('ACADPROGCODE', $ACADPROGCODE)
					        ->get('TBL_ACADPROG')
					        ->result_array();
       
        $DEGREEDURATION = $degree_duration[0]['DEGREEDURATION']; 

        if($result[0]['ACADPROGLEVEL'] == 'BS'){
        	$DEGREEDURATION = 48;
        }

        // if($result[0]['ACADPROGLEVEL'] == 'BS' && $result[0]['PROG_NAME'] == 'BS Islamic Studies (Usuluddin)' && $result[0]['NATIONALITY'] != 'Pakistani'){
        // 	$DEGREEDURATION = 66;
        // }else if($result[0]['ACADPROGLEVEL'] == 'BS' && $result[0]['PROG_NAME'] == 'BS Islamic Studies (Usuluddin)' && $result[0]['NATIONALITY'] == 'Pakistani'){
        // 	$DEGREEDURATION = 60;
        // } 


        // if($result[0]['ACADPROGLEVEL'] == 'BS' && $result[0]['PROG_NAME'] == 'BS English Language & Literature' && $result[0]['NATIONALITY'] != 'Pakistani'){
        // 	$DEGREEDURATION = 66;
        // }else if($result[0]['ACADPROGLEVEL'] == 'BS' && $result[0]['PROG_NAME'] == 'BS English Language & Literature' && $result[0]['NATIONALITY'] == 'Pakistani'){
        // 	$DEGREEDURATION = 60;
        // } 


        // if($result[0]['ACADPROGLEVEL'] == 'BS' && $result[0]['PROG_NAME'] == 'BS Translation & Interpretation' && $result[0]['NATIONALITY'] != 'Pakistani'){
        // 	$DEGREEDURATION = 66;
        // }else if($result[0]['ACADPROGLEVEL'] == 'BS' && $result[0]['PROG_NAME'] == 'BS Translation & Interpretation' && $result[0]['NATIONALITY'] == 'Pakistani'){
        // 	$DEGREEDURATION = 60;
        // } 


        
        if($result[0]['ACADPROGLEVEL'] == 'PHD'){
        	$DEGREEDURATION = 36;
        }




        if($result[0]['ACADPROGLEVEL'] == 'BA'){
        	$DEGREEDURATION = 24;
        }

        // if($result[0]['ACADPROGLEVEL'] == 'BS' && $result[0]['PROG_NAME'] == 'BS Arabic' && $result[0]['NATIONALITY'] != 'Pakistani'){
        // 	$DEGREEDURATION = 66;
        // }else if($result[0]['ACADPROGLEVEL'] == 'BS' && $result[0]['PROG_NAME'] == 'BS Arabic' && $result[0]['NATIONALITY'] == 'Pakistani'){
        // 	$DEGREEDURATION = 60;
        // } 

        if($result[0]['ACADPROGLEVEL'] == 'MS' || $result[0]['ACADPROGLEVEL'] == 'MSC' || $result[0]['ACADPROGLEVEL'] == 'MA'){
        	$DEGREEDURATION = 24;
        }

        if($result[0]['ACADPROGLEVEL'] == 'LLB' && ($result[0]['PROG_NAME'] == 'LLB (5 Years)' || $result[0]['PROG_NAME'] == 'LLB (Hons) Shariah & Law')){
        	$DEGREEDURATION = 60;
        }

        $time_input = strtotime($YEAROFADM);

        
        $year = substr(explode('/', $regno)[2],1);
		
		$semster = explode('/', $regno)[2][0];

		$decad = date('Y');

		$dec = $decad[0].$decad[1];		

        if($semster == 'S'){

        	$time_input = '1-FEB-'.$dec.$year;

        }else if($semster == 'F'){

        	$time_input = '1-SEP-'.$dec . $year;
        }     

        $time_input = strtotime($time_input);


        $expiryYear = date('Y', strtotime('+'.$DEGREEDURATION.' months',$time_input));
        $expiryMonth = date('m', strtotime('+'.$DEGREEDURATION.' months',$time_input));
        $expirydate = date('d-m-Y', strtotime('+'.$DEGREEDURATION.' months',$time_input));
      
       
       if($expiryMonth >= '08' && $expiryMonth <= '12'){

       	 $expiryDate = "31st August $expiryYear";

       }else{

       	 $expiryDate =  "31st January $expiryYear";

       }
      
       return date('d-m-Y', strtotime($expiryDate));
    }

    public function findHostelStudentByRegNo($regno){

    	$result = $this->otherdb->where('REGNO',$regno)
    	->get('TBL_ALLOTMENT')
    	->result();

    	if(empty($result)){

    		$result = $this->otherdb->where('REGNO',$regno)->get('TBL_REALLOTMENT')->result();
    	}

    	return $result;
    }

    public function updateKey($regno, $semcode, $type, $gender, $key){
    	$this->otherdb->where('REGNO',$regno)
    					->where('GENDER',$gender)
    					->where('TYPE',$type)
    					->where('SEMCODE',$semcode)
    					->delete('TBL_KEY');
    	$data = array(
    		'REGNO' => $regno,
    		'KEY' => $key,
    		'TYPE' => $type,
    		'GENDER' => $gender,
    		'SEMCODE' => $semcode
    				);

    	$this->otherdb->insert('TBL_KEY', $data);

    	return $this->otherdb->insert_id();
    	
    }

    public function UpdatestudentCardExpiryDate($regno, $gender, $date, $card_remarks, $type)
    {

    	$data = ['card_expiry_date' => $date, 'card_remarks' => $card_remarks];    	

    		$this->otherdb->where('REGNO',$regno)
				    	->where('GENDER',$gender)
				    	->update('tbl_reallotment', $data);
        
       	$updated = $this->otherdb->affected_rows();

       	if(empty($updated)){
       		$this->otherdb->where('REGNO',$regno)
			       		->where('GENDER',$gender)
			       		->update('tbl_allotment', $data);
        
       		$updated = $this->otherdb->affected_rows();

       	}

       	return $updated;

    }
}


  