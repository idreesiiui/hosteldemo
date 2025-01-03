<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Room_model extends CI_Model
{  

    public function __construct(){

        $this->otherdb = $this->load->database('otherdb', TRUE);
        
    }

    function addNewRoom($roomInfo)
    {       
        $this->otherdb->insert('TBL_ROOM', $roomInfo);
    
        return $this->otherdb->insert_id();        
    }
    
    function room_exists_against_hostelId($hostelno,$roomdesc)
    {
        
        $rows = $this->otherdb->where('HOSTELID',$hostelno)
                              ->where('ROOMDESC',$roomdesc)
                              ->get('TBL_ROOM')
                              ->num_rows();
        return ($rows > 0) ? true : false;
    }   
   
    
    function getRoomInfo($gender)
    {        
        return $this->otherdb->select(
                           'TBL_ROOM.ROOMID, 
                            TBL_HOSTEL.HOSTEL_NO, 
                            TBL_HOSTEL.HOSTELDESC, 
                            TBL_ROOM.HOSTELID AS RHOSTELID, 
                            TBL_ROOM.ROOMDESC, 
                            TBL_ROOM.ROOMTYPE, 
                            TBL_ROOM.SCAPACITY, 
                            TBL_ROOM.FLOOR, 
                            TBL_ROOM.BEDS, 
                            TBL_ROOM.CHAIRS, 
                            TBL_ROOM.TABLES, 
                            TBL_ROOM.CUPBOARDS, 
                            TBL_ROOM.TUBELIGHTS, 
                            TBL_ROOM.FANS, 
                            TBL_ROOM.OTHERITEMS')
                            ->from('TBL_ROOM')
                            ->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ROOM.HOSTELID','INNER')
                            ->order_by('ROOMDESC','ASC')
                            ->where('TBL_ROOM.GENDER',$gender)
                            ->get()
                            ->result();
    }
    
    function getRoomInfobyId($ROOMID)
    {      
        return $this->otherdb->select(
                        'TBL_ROOM.ROOMID, 
                         TBL_HOSTEL.HOSTEL_NO, 
                         TBL_HOSTEL.HOSTELID, 
                         TBL_HOSTEL.HOSTELDESC, 
                         TBL_ROOM.HOSTELID AS RHOSTELID, 
                         TBL_ROOM.ROOMDESC, 
                         TBL_ROOM.ROOMTYPE, 
                         TBL_ROOM.SCAPACITY, 
                         TBL_ROOM.FLOOR, 
                         TBL_ROOM.BEDS, 
                         TBL_ROOM.CHAIRS, 
                         TBL_ROOM.TABLES, 
                         TBL_ROOM.CUPBOARDS, 
                         TBL_ROOM.TUBELIGHTS, 
                         TBL_ROOM.FANS, 
                         TBL_ROOM.OTHERITEMS')
                    ->from('TBL_ROOM')
                    ->where('ROOMID',$ROOMID)
                    ->join('TBL_HOSTEL', 'TBL_HOSTEL.HOSTELID = TBL_ROOM.HOSTELID','INNER')
                    ->get()
                    ->result();
    }
    
    function editroom($roomInfo, $roomid)
    {
        $this->otherdb->where('ROOMID',$roomid)->update('TBL_ROOM', $roomInfo);        
        
        return $this->otherdb->affected_rows();
    }  
    
    
    function deleteroom($roomId)
    {
        $this->otherdb->where('ROOMID', $roomId)->delete('TBL_ROOM');
        
        return $this->otherdb->affected_rows();
    }

    function GetGenderById($userId)
    {
        return $this->otherdb->select('GENDER')
                    ->where('userId',$userId)
                    ->get('TBL_USERS')
                    ->result();
    }

    function getHostelInfo($gender)
    {  
        return $this->otherdb->where('GENDER',$gender)->get('TBL_HOSTEL')->result();
    }
} 
?>