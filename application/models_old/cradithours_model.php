<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class CraditHours_model extends CI_Model
{
    

    public function __construct(){

        $this->otherdb = $this->load->database('otherdb', TRUE);
        
    }

    
    /**
     * This function used to check the login credentials of the user
     * @param string $email : This is email of the user
     * @param string $password : This is encrypted password of the user
     */
    function getAllSemsters()
    {
        $this->db->select('distinct(SEMCODE)');
        $this->db->where('SEMCODE !=', 'B/F (T)');
        $this->db->where('SEMCODE !=', 'B/F (F.A)');
        $this->db->where('SEMCODE !=', 'B/F (R.A)');
        $this->db->where('SEMCODE !=', 'SEM_EX');
        $this->db->order_by('SEMCODE','ASC');

        return $this->db->get('TBL_STUDSEMCOURSE')->result_array(); 
    }

    function getTotalCraditHours($regno,$semcode){
        $this->db->select_sum('CREDITHRS');
        $this->db->where('REGNO', $regno);
        $this->db->where('SEMCODE', $semcode);
        $result = $this->db->get('TBL_STUDSEMCOURSE')->row(); 
         
        return $result->CREDITHRS; 
    }

    function getStudentCreditHours($regno,$semcode){
        $this->db->select('*');
        $this->db->where('REGNO', $regno);
        $this->db->where('SEMCODE', $semcode);
        return $this->db->get('TBL_STUDSEMCOURSE')->result_array(); 
    }

}