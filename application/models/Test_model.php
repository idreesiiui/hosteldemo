<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Test_model extends CI_Model
{
    public function __construct(){

        $this->otherdb = $this->load->database('otherdb', TRUE);
        
    }


     function isSeatAccupied($id){
        $query = $this->otherdb->where('SEATID', $id)
                                ->where('OCCUPIED', '0')
                                ->get('tbl_seat');

        if($query->num_rows() >= 1){
            return true;
        } else {
            return false;
        }

    }

    function updateSeatStatus($id){
        $data = array(
            //'NATIONALITY' => 'Thai'
            'OCCUPIED' => '1'
        );

        $this->otherdb->where('SEATID',$id)->update('tbl_seat', $data);

        return $this->otherdb->affected_rows();
    }



    public function doesThisStudentDefaulter($regno){

        $query = $this->otherdb->select('SEATID')->where('REGNO',$regno)->get('tbl_allotreallot')->result();
        
       // $row = $query->num_rows();

        if($query){
            return $query;
        }else{

            $query = $this->otherdb->select('SEATID')->where('REGNO',$regno)->get('tbl_reallotment')->result();
        
            //$row = $query->num_rows();

            if($query){
                return $query;
            }else{
                
                return false;
            }
        }
    }

    public function checkBoarderStd($regno){
        //alltoment
        //realltoment
        //attachment
        //allotreallot
        $query = $this->otherdb->where('REGNO',$regno)->get('tbl_clearance');
        $row = $query->num_rows();

        if($row >= 1){
            return true;
        }else{
            return false;
          // $query = $this->otherdb->where('REGNO',$regno)->get('tbl_allotreallot');
          // $row = $query->num_rows();
          //   if($row >= 1){
          //       return true;
          //   }else{
          //       $query = $this->otherdb->where('ATTACHREGNO',$regno)->get('tbl_attachment');
          //     $row = $query->num_rows();
          //       if($row >= 1){
          //           return true;
          //       }else{

          //           $query = $this->otherdb->where('REGNO',$regno)->get('tbl_reallotment');
          //             $row = $query->num_rows();
          //               if($row >= 1){
          //                   return true;
          //               }else{
                            
          //                   return false;
          //               }                    

          //       }


          //   }
        }

    }

    function findClearStudent($std){
        $query = $this->otherdb->where('REGNO',$std)->get('tbl_clearance');
        $row = $query->num_rows(); 

        return ($row >= 1) ? true : false;
    }


    function checkDistance($PERMANENT, $DISTRICT, $CITY){
        $query = $this->otherdb->where('district',$DISTRICT) 
                        ->or_where('city_name',$CITY)                   
                        ->get('tbl_restricted_areas');
        $row = $query->num_rows();      


        $search = 'Rawalpindi';
        $RawalpindiFound  = preg_match("/{$search}/i", $PERMANENT);

        $search = 'Islamabad';
        $IslamabadFound  = preg_match("/{$search}/i", $PERMANENT);

        $search = 'Rwp';
        $RwpFound  = preg_match("/{$search}/i", $PERMANENT);

        $search = 'Ibd';
        $IbdFound  = preg_match("/{$search}/i", $PERMANENT);             



        if( $row >= 1 ||$RawalpindiFound || $IslamabadFound || $RwpFound || $IbdFound){
            return 'not elligible';
        } else {
            return 'elligible';
        }
    }

    function getAllHostelisted(){
        return $this->db->select('*')
                    ->where('NATIONALITY','Pakistani')
                    ->where('PROVINCE','Punjab')
                    ->where('PROTITTLE','BS')
                    ->where('DEPARTMENTNAME','Computer Science')
                    ->get('TBL_HSTUDENTS')
                    //->limit('10')
                    ->result();
    }

    function getAllCubicalSeats($hostelid){
        return $this->otherdb->where('HOSTELID',$hostelid) 
                    ->where('GENDER','Male')
                   // ->where('SEAT !=','SB')
                    //->where('SEAT','S')
                    ->where('SEAT','SA')
                    ->where('OCCUPIED','1')
                    ->get('tbl_seat')
                    ->result();
    }

    function get_SA_Occupied($SEATID){
        return $this->otherdb->where('ROOMID',$SEATID)
                    ->where('OCCUPIED','0')
                    ->where('SEAT','SA')
                    ->where('GENDER','Male')
                    ->get('tbl_seat')
                    ->result();
    }

    function get_SB_Occupied($SEATID){
        return $this->otherdb->where('ROOMID',$SEATID)
                    ->where('OCCUPIED','0')
                    ->where('SEAT','SB')
                    ->where('GENDER','Male')
                    ->get('tbl_seat')
                    ->result();
    }

    function get_S_Occupied($roomID){
        return $this->otherdb->where('ROOMID',$roomID)
                    ->where('OCCUPIED','1')
                    ->where('SEAT','S')
                    ->where('GENDER','Male')
                    ->get('tbl_seat')
                    ->result();
    }



     function getAllAccpiedSeats(){
        return $this->otherdb->select('TBL_SEAT.*, TBL_HOSTEL.HOSTEL_NO AS HOSTEL_NO, TBL_HOSTEL.HOSTELDESC AS HOSTELDESC, TBL_ROOM.ROOMDESC AS ROOMDESC')
                        ->from('TBL_SEAT')
                        ->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_SEAT.HOSTELID','INNER')
                        ->join('TBL_ROOM', 'TBL_ROOM.ROOMID = TBL_SEAT.ROOMID','INNER')
                        ->where('TBL_SEAT.OCCUPIED','1')
                        ->where('TBL_SEAT.GENDER','Female')
                        ->get()
                        ->result();
    }


    function getDistintAllotmentHistoryRegno(){
        return $this->otherdb->select('distinct(REGNO)')                    
                    ->get('TBL_ALLOTMENTHISTORY')
                    ->result();
    }

    function getSemCode($regno){
        return $this->otherdb->select('SEMCODE')
                    ->where('REGNO',$regno)
                    ->limit('1')
                    ->get('TBL_ALLOTMENTHISTORY')
                    ->row();
    }

    function updateBatchCode($reg,$batchcde){

        $data = array(
            //'NATIONALITY' => 'Thai'
            'HOSTELBATCH' => $batchcde
        );

        $this->otherdb->where('REGNO',$reg)->update('TBL_ALLOTMENTHISTORY', $data);

        return $this->otherdb->affected_rows();

    }

    function updateHistoryTable(){

        $data = array(
            //'NATIONALITY' => 'Thai'
            'COUNTRY' => 'Pakistan'
        );

        $this->otherdb
        ->where('COUNTRY','')
        ->where('NATIONALITY','Pakistani')
        ->or_where('COUNTRY',null)
        ->update('TBL_ALLOTMENTHISTORY', $data);
        
        return $this->otherdb->affected_rows();

    }

    function getAllUsers(){
        return $this->otherdb->select('SEATID')
                        ->where('gender','Female')
                        ->get('tbl_users')
                        ->result();
    }

    function getAllSeats(){
        return $this->otherdb->select('SEATID')->get('TBL_REALLOTMENT')->result();
    }

    function isAllotedorRealloted($id){

        $result = $this->otherdb->select('SEATID')
                        ->where('SEATID',$id)
                        ->get('TBL_REALLOTMENT')
                        ->result();
        if(!empty($result)){
            return $result;
        }else{
          $result = $this->otherdb->select('SEATID')
                        ->where('SEATID',$id)
                        ->get('TBL_ALLOTMENT')
                        ->result();
            if(!empty($result)){
                return $result;
            } else{
                return 'notaccupeid';
            }
        }

    }

   


    function isRegNoExist($regNo){

        $otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('*');
        $otherdb->from('TBL_ALLOTMENT');
        $otherdb->where('REGNO',$regNo);
        $query = $otherdb->get();

        $result = $query->result_array();

        // echo $regNo;

        // var_dump($result);

        // exit();

        if(empty($result)){
            $otherdb = $this->load->database('otherdb', TRUE);
            $otherdb->select('*');
            $otherdb->from('TBL_ALLOTREALLOT');
            $otherdb->where('REGNO',$regNo);
            $query = $otherdb->get();

            $result = $query->result_array();
        }

        if(empty($result)){
            $otherdb = $this->load->database('otherdb', TRUE);
            $otherdb->select('*');
            $otherdb->from('TBL_REALLOTMENT');
            $otherdb->where('REGNO',$regNo);
            $query = $otherdb->get();

            $result = $query->result_array();
        }

        return $result;

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