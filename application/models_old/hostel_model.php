<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Hostel_model extends CI_Model
{   
    public function __construct(){

        $this->otherdb = $this->load->database('otherdb', TRUE);        
    }
    
    function getHostelInfo($gender)
    {
        return $this->otherdb->where('GENDER',$gender)->get('TBL_HOSTEL')->result();
    }

    function getUserRoles()
    {
        return $this->db->select('ROLEID, ROLE')
                        ->where('ROLEID !=', 1)
                        ->get('TBL_ROLES')       
                        ->result();
    }
    
	function mail_exists($email)
	{
		$query = $this->db->where('EMAIL',$email)->get('TBL_USERS');		 

		return ($query->num_rows() > 0) ? true : false;
	}   
   
    function addNewHostel($hostelInfo)
    {
        $this->otherdb->insert('TBL_HOSTEL', $hostelInfo);
    
        return $this->otherdb->insert_id();
    }

    function tblname()
    {
        $tables = $this->otherdb->list_tables();

        foreach ($tables as $table)
        {
           echo $table.'<br />';
        }

    }
	
	function HostelId_exists($hostelno,$gender)
	{
		$query = $this->otherdb->where('HOSTEL_NO',$hostelno)
                                ->where('GENDER',$gender)
                                ->get('TBL_HOSTEL');    

        return ($query->num_rows() > 0) ? true : false;
	} 
	
	function GetGenderById($userId)
    {
		return $this->otherdb->select('GENDER')
                    		 ->where('userId',$userId)
                             ->get('TBL_USERS')
                             ->result();
    }

    function tblstructue($table_name)
    {
        $fields = $this->otherdb->list_fields($table_name);
        foreach ($fields as $field)
        {
           echo $field.'<br />';
        }

    }

    function tblrinfo($table_name, $col, $number, $order)
    {
               
        if ($this->otherdb->query('delete from '.$table_name.' order by '. $col.' '. $order.' '. 'limit '. $number))
            {
                    echo "Success!";
            }
            else
            {
                    echo "Query failed!";
            }

    }
	
	function getHostelInfobyId($HOSTELID)
    {
		return $this->otherdb->where('HOSTELID',$HOSTELID)->get('TBL_HOSTEL')->result();
    }    
    
    function editHostel($userInfo, $hostelid)
    {
		$this->otherdb->where('HOSTELID',$hostelid)->update('TBL_HOSTEL', $userInfo);
        
        return $this->otherdb->affected_rows();
    } 

    
    
    function deletehostel($hostelId)
    {
		$this->otherdb->where('HOSTELID', $hostelId)->delete('TBL_HOSTEL');
        
        return $this->otherdb->affected_rows();
    }
}
?>  