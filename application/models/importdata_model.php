<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Importdata_model extends CI_Model
{   
    public function __construct(){

        $this->otherdb = $this->load->database('otherdb', TRUE);        
    }

    function find($table,$where){
        $query = $this->otherdb->where( $where )->get($table);
        return $query->num_rows();
    }

    function updateData($where,$table,$data)
    {
        $this->otherdb->where( $where )->update( $table , $data);

        return $this->otherdb->affected_rows();  
    }


    function insertData($table,$data)
    {
        $this->otherdb->insert( $table, $data );
        return $this->otherdb->insert_id();  
    }

    function hostelStudentsHaveEmail(){


        $query = "SELECT * 
                  FROM TBL_HSTUDENTS 
                  WHERE STUDENTEMAIL IS NOT NULL 
                  AND STUDENTNAME NOT LIKE '%Deferment%' 
                  AND STUDENTNAME NOT LIKE '%Defarmant%' 
                  AND STUDENTNAME NOT LIKE '%Transfer%' 
                  AND STUDENTNAME NOT LIKE '%Cacelled%' 
                  AND STUDENTNAME NOT LIKE '%cancelled%' 
                  AND STUDENTNAME NOT LIKE '%Cancelled%' 
                  AND STUDENTNAME NOT LIKE '%Cancell%' 
                  AND STUDENTNAME NOT LIKE '%Cancalled%' 
                  AND STUDENTNAME NOT LIKE '%Degree Complete%' 
                  AND STUDENTNAME NOT LIKE '%expulsion%' 
                  AND STUDENTNAME NOT LIKE '%Expulsion%' 
                  AND STUDENTNAME NOT LIKE '%cancell%'
                  AND STUDENTNAME NOT LIKE '%Canelled%'
                  AND STUDENTEMAIL NOT LIKE '%Cancelled%'  
                  AND STUDENTNAME NOT LIKE '%Canceled%'";

        return $this->db->query($query)->result_array();
    }

    function isEmailExist($REGNO){

        $query = $this->otherdb->where('regno',$REGNO)->get('student_contact_info');

        return $query->num_rows();
    }

    function addNewUser($userInfo)
    {

        $this->otherdb->insert('student_contact_info', $userInfo);
    
        return $this->otherdb->insert_id();        
        
    }
	
}
?>  