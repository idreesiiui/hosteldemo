<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Student_model extends CI_Model
{
    public function __construct(){

        $this->otherdb = $this->load->database('otherdb', TRUE);
        
    }

	function updateStudentInfo($regno, $email, $mobileno){

		$otherdb = $this->load->database('otherdb', TRUE);

        $userdata = array(

            'email' =>  $email,
            'mobile' =>  $mobileno

        );

        $otherdb->where('regno',$regno);
        $otherdb->update('tbl_users', $userdata);

        $userUpdate = $otherdb->affected_rows();

        
        $reAlotmentData = array(

            'STUDENTPHONE' =>  $mobileno

        );

        $otherdb->where('REGNO',$regno);
        $otherdb->update('tbl_reallotment', $reAlotmentData);

        $reallotmentUpdate = $otherdb->affected_rows();

       

        
        $allotmentData = array(

            'EmailAdd' =>  $email,
            'STUDENTPHONE' =>  $mobileno

        );

        $otherdb->where('REGNO',$regno);
        $otherdb->update('tbl_allotment', $allotmentData);

        $allotmentUpdate = $otherdb->affected_rows();

        
        $alotmentHistoryData = array(

            'STUDENTPHONE' =>  $mobileno

        );

        $otherdb->where('REGNO',$regno);
        $otherdb->update(' tbl_allotmenthistory', $alotmentHistoryData);

        $allotmenthistoryUpdate = $otherdb->affected_rows();

        
        $allotreallotData = array(

            'STUDENTPHONE' =>  $mobileno

        );

        $otherdb->where('REGNO',$regno);
        $otherdb->update(' tbl_allotreallot', $allotreallotData);

        $allotreallotUpdate = $otherdb->affected_rows();

        $total = abs($allotreallotUpdate) + abs($allotmenthistoryUpdate) + abs($allotmentUpdate) + abs($reallotmentUpdate) + abs($userUpdate);

        return abs($total); 
        
	}

    function findStudentDetail($regNo){
         $otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_ALLOTMENT.ALLOTMENT_ID,TBL_ALLOTMENT.REGNO,TBL_ALLOTMENT.STUDENTNAME,TBL_HOSTEL.HOSTELID,TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMID, TBL_ROOM.ROOMDESC, TBL_ROOM.ROOMTYPE, TBL_SEAT.SEATID, TBL_SEAT.SEAT, TBL_SEAT.OCCUPIED, TBL_USERS.email, TBL_USERS.mobile, TBL_ALLOTMENT.COUNTRY, TBL_ALLOTMENT.PROVINCE, TBL_ALLOTMENT.GENDER, TBL_ALLOTMENT.STUDENTPHONE');
        $otherdb->from('TBL_ALLOTMENT');
        $otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER');
        $otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER');
        $otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER');
        $otherdb->join('TBL_USERS', 'TBL_USERS.userId = TBL_ALLOTMENT.EMAILID','INNER');
        $otherdb->where('TBL_ALLOTMENT.GENDER','Female');
        $otherdb->where('TBL_ALLOTMENT.REGNO',$regNo);
        $otherdb->where('TBL_ALLOTMENT.ADMIN_VERIFY',1);
        $otherdb->where('TBL_SEAT.OCCUPIED',1);
        //$otherdb->order_by('TBL_HOSTEL.HOSTEL_NO');
        $query = $otherdb->get();

        $result = $query->result_array();
        
       if(empty($result)){
        
            $otherdb = $this->load->database('otherdb', TRUE);
            $otherdb->select('TBL_REALLOTMENT.REALLOTMENT_ID,TBL_REALLOTMENT.REGNO,TBL_REALLOTMENT.STUDENTNAME,TBL_HOSTEL.HOSTELID,TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMID, TBL_ROOM.ROOMDESC, TBL_ROOM.ROOMTYPE, TBL_SEAT.SEATID, TBL_SEAT.SEAT, TBL_SEAT.OCCUPIED, TBL_USERS.email,TBL_USERS.mobile, TBL_REALLOTMENT.COUNTRY, TBL_REALLOTMENT.PROVINCE, TBL_REALLOTMENT.GENDER, TBL_REALLOTMENT.STUDENTPHONE');
            $otherdb->from('TBL_REALLOTMENT');
            $otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_REALLOTMENT.HOSTELID','INNER');
            $otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_REALLOTMENT.ROOMID','INNER');
            $otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_REALLOTMENT.SEATID','INNER');
            $otherdb->join('TBL_USERS', 'TBL_USERS.userId = TBL_REALLOTMENT.EMAILID','INNER');
            $otherdb->where('TBL_REALLOTMENT.GENDER','Female');
            $otherdb->where('TBL_REALLOTMENT.REGNO',$regNo);
            $otherdb->where('TBL_REALLOTMENT.ADMIN_VERIFY',1);
            $otherdb->where('TBL_SEAT.OCCUPIED',1);
            $otherdb->order_by('HOSTEL_NO','ASC');
            $otherdb->order_by('ROOMDESC','ASC');
            $query = $otherdb->get();      
            
            $result = $query->result_array();
        }
        
        return $result;
    }

    public function AllHostelidStudents(){
        $otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_ALLOTMENT.ALLOTMENT_ID,TBL_ALLOTMENT.REGNO,TBL_ALLOTMENT.STUDENTNAME,TBL_HOSTEL.HOSTELID,TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMID, TBL_ROOM.ROOMDESC, TBL_ROOM.ROOMTYPE, TBL_SEAT.SEATID, TBL_SEAT.SEAT, TBL_SEAT.OCCUPIED, TBL_USERS.email, TBL_USERS.mobile, TBL_ALLOTMENT.COUNTRY, TBL_ALLOTMENT.PROVINCE');
        $otherdb->from('TBL_ALLOTMENT');
        $otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ALLOTMENT.HOSTELID','INNER');
        $otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_ALLOTMENT.ROOMID','INNER');
        $otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_ALLOTMENT.SEATID','INNER');
        $otherdb->join('TBL_USERS', 'TBL_USERS.userId = TBL_ALLOTMENT.EMAILID','INNER');
        $otherdb->where('TBL_ALLOTMENT.GENDER','Female');
        //$otherdb->where('TBL_ALLOTMENT.IS_SUBMIT',1);
        $otherdb->where('TBL_ALLOTMENT.ADMIN_VERIFY',1);
        $otherdb->where('TBL_SEAT.OCCUPIED',1);
        //$otherdb->order_by('TBL_HOSTEL.HOSTEL_NO');
        $otherdb->get();
        
        $query1 =  $otherdb->last_query();
        
        $otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('TBL_REALLOTMENT.REALLOTMENT_ID,TBL_REALLOTMENT.REGNO,TBL_REALLOTMENT.STUDENTNAME,TBL_HOSTEL.HOSTELID,TBL_HOSTEL.HOSTEL_NO, TBL_HOSTEL.HOSTELDESC, TBL_ROOM.ROOMID, TBL_ROOM.ROOMDESC, TBL_ROOM.ROOMTYPE, TBL_SEAT.SEATID, TBL_SEAT.SEAT, TBL_SEAT.OCCUPIED, TBL_USERS.email,TBL_USERS.mobile, TBL_REALLOTMENT.COUNTRY, TBL_REALLOTMENT.PROVINCE');
        $otherdb->from('TBL_REALLOTMENT');
        $otherdb->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_REALLOTMENT.HOSTELID','INNER');
        $otherdb->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_REALLOTMENT.ROOMID','INNER');
        $otherdb->join('TBL_SEAT', 'TBL_SEAT.SEATID = TBL_REALLOTMENT.SEATID','INNER');
        $otherdb->join('TBL_USERS', 'TBL_USERS.userId = TBL_REALLOTMENT.EMAILID','INNER');
        $otherdb->where('TBL_REALLOTMENT.GENDER','Female');
        //$otherdb->where('TBL_REALLOTMENT.IS_SUBMIT',1);
        $otherdb->where('TBL_REALLOTMENT.ADMIN_VERIFY',1);
        $otherdb->where('TBL_SEAT.OCCUPIED',1);
        $otherdb->order_by('HOSTEL_NO','ASC');
        $otherdb->order_by('ROOMDESC','ASC');
        $otherdb->get();
        
        $query2 =  $otherdb->last_query();
        
        $query = $otherdb->query($query1." UNION ".$query2);
        
        return $query->result();
    }

}