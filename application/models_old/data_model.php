<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Data_model extends CI_Model
{


    public function __construct(){

        $this->otherdb = $this->load->database('otherdb', TRUE);
        
    }
    
    /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
    function getallalottmentCNICEmpty($gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
        $otherdb->from('TBL_ALLOTMENT');
		$otherdb->where('GENDER', $gender);
		$otherdb->where('CNIC', '');
        $query = $otherdb->get();
        
        return $query->result();
    }
	
	function getreallalottmentNationalityEmpty($gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
        $otherdb->from('TBL_REALLOTMENT');
		$otherdb->where('GENDER', $gender);
		$otherdb->where('NATIONALITY', '');
        $query = $otherdb->get();
        
        return $query->result();
    }
	
	function getallalottmentNationalityEmpty($gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
        $otherdb->from('TBL_ALLOTMENT');
		$otherdb->where('GENDER', $gender);
		$otherdb->where('NATIONALITY', '');
        $query = $otherdb->get();
        
        return $query->result();
    }
	
	 function getreallalottmentCNICEmpty($gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
        $otherdb->from('TBL_REALLOTMENT');
		$otherdb->where('GENDER', $gender);
		$otherdb->where('CNIC', '');
        $query = $otherdb->get();
        
        return $query->result();
    }
	
	function getreallalottmentDistrictEmpty($gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
        $otherdb->from('TBL_REALLOTMENT');
		$otherdb->where('GENDER', $gender);
		$otherdb->where('DISTRICT', '');
        $query = $otherdb->get();
        
        return $query->result();
    }
	
	function getallalottmentDistrictEmpty($gender)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('*');
        $otherdb->from('TBL_ALLOTMENT');
		$otherdb->where('GENDER', $gender);
		$otherdb->where('DISTRICT', '');
        $query = $otherdb->get();
        
        return $query->result();
    }
	
	function StudentOracle($regno)
    {
        $this->db->select('*');
        $this->db->from('TBL_HSTUDENTS');
		$this->db->where('REGNO', $regno);
		$query =  $this->db->get();
        
        return $query->result();
    }
    
		function mail_exists($email)
	{
		$otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('EMAIL',$email);
		$query = $otherdb->get('TBL_USERS');
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
    
    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewUser($userInfo)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		
        $otherdb->trans_start();
		
		
        $query = $otherdb->insert('TBL_USERS', $userInfo);
    
        $insert_id = $otherdb->insert_id();
        
        $otherdb->trans_complete();
        
        return $query;
    }
    
    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getUserInfo($userId)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->select('USERID, NAME, EMAIL, MOBILE, GENDER, ROLEID');
        $otherdb->from('TBL_USERS');
        $otherdb->where('ISDELETED', 0);
		$otherdb->where('ROLEID !=', 1);
        $otherdb->where('USERID', $userId);
        $query = $otherdb->get();
        
        return $query->result();
    }
    
    
    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function UpdateAllotCNIC($regno,$userInfo)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('REGNO', $regno);
        $otherdb->update('TBL_ALLOTMENT', $userInfo);
        
        return $otherdb->affected_rows();
    }
	
	 function UpdateREAllotCNIC($regno,$userInfo)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('REGNO', $regno);
        $otherdb->update('TBL_REALLOTMENT', $userInfo);
        
        return $otherdb->affected_rows();
    }
	
	 function UpdateAllotNationality($regno,$userInfo)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('REGNO', $regno);
        $otherdb->update('TBL_ALLOTMENT', $userInfo);
        
        return $otherdb->affected_rows();
    }
	
	function UpdateREAllotNationality($regno,$userInfo)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('REGNO', $regno);
        $otherdb->update('TBL_REALLOTMENT', $userInfo);
        
        return $otherdb->affected_rows();
    }
    
     function UpdateREAllotDistrict($regno,$userInfo)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('REGNO', $regno);
        $otherdb->update('TBL_REALLOTMENT', $userInfo);
        
        return $otherdb->affected_rows();
    }
	
	function UpdateAllotDistrict($regno,$userInfo)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('REGNO', $regno);
        $otherdb->update('TBL_ALLOTMENT', $userInfo);
        
        return $otherdb->affected_rows();
    }
    
    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser($userId, $userInfo)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
		$otherdb->where('USERID', $userId);
        $otherdb->update('TBL_USERS', $userInfo);
        
        return $otherdb->affected_rows();
    }
	
	
	function verifyapplication($gender)
    {
      $otherdb = $this->load->database('otherdb', TRUE);
	  $otherdb->where('STATUS',1);
	  $otherdb->where('GENDER',$gender);
	  $query = $otherdb->query("SELECT COUNT(*) as COUNT_ROWS FROM TBL_APPLICATION WHERE STATUS = '1' AND GENDER ="."'".$gender."'");
      return $query->result();
        
    }
	
	function totalapplication($gender)
    {
      $otherdb = $this->load->database('otherdb', TRUE);
	  $query = $otherdb->query("SELECT COUNT(*) as COUNT_ROWS FROM TBL_APPLICATION WHERE GENDER ="."'".$gender."'");
      return $query->result();
        
    }
	
	function pendingapplication($gender)
    {
      $otherdb = $this->load->database('otherdb', TRUE);

	  $query = $otherdb->query("SELECT COUNT(*) as COUNT_ROWS FROM TBL_APPLICATION WHERE STATUS = '0' AND GENDER ="."'".$gender."'");
      return $query->result();
        
    }
	
	function cancelapplication($gender)
    {
      $otherdb = $this->load->database('otherdb', TRUE);
	
	  $query = $otherdb->query("SELECT COUNT(*) as COUNT_ROWS FROM TBL_APPLICATION WHERE STATUS = '2' AND GENDER ="."'".$gender."'");
      return $query->result();
        
    }
	
	function totalhostel($gender)
    {
      $otherdb = $this->load->database('otherdb', TRUE);
	
	  $query = $otherdb->query("SELECT COUNT(*) as COUNT_ROWS FROM TBL_HOSTEL WHERE GENDER ="."'".$gender."'");
      return $query->result();
        
    }
	
	function totalroom($gender)
    {
      $otherdb = $this->load->database('otherdb', TRUE);
	
	  $query = $otherdb->query("SELECT COUNT(*) as COUNT_ROWS FROM TBL_ROOM WHERE GENDER ="."'".$gender."'");
      return $query->result();
        
    }
	
	function totalseat($gender)
    {
      $otherdb = $this->load->database('otherdb', TRUE);
	
	  $query = $otherdb->query("SELECT COUNT(*) as COUNT_ROWS FROM TBL_SEAT WHERE GENDER ="."'".$gender."'");
      return $query->result();
        
    }
	
	function totalitem($gender)
    {
      $otherdb = $this->load->database('otherdb', TRUE);
	
	  $query = $otherdb->query("SELECT COUNT(*) as COUNT_ROWS FROM TBL_ROOMITEM WHERE GENDER ="."'".$gender."'");
      return $query->result();
        
    }
	
	function totallotment($gender)
    {
      $otherdb = $this->load->database('otherdb', TRUE);
	
	  $query = $otherdb->query("SELECT COUNT(*) as COUNT_ROWS FROM TBL_ALLOTMENT WHERE GENDER ="."'".$gender."'");
      return $query->result();
        
    }
	
	function verifyallotment($gender)
    {
      $otherdb = $this->load->database('otherdb', TRUE);
	
	  $query = $otherdb->query("SELECT COUNT(*) as COUNT_ROWS FROM TBL_ALLOTMENT WHERE ADMIN_VERIFY  = '1' AND GENDER ="."'".$gender."'");
      return $query->result();
        
    }
	
	function pendingallotment($gender)
    {
      $otherdb = $this->load->database('otherdb', TRUE);
	
	  $query = $otherdb->query("SELECT COUNT(*) as COUNT_ROWS FROM TBL_ALLOTMENT WHERE ADMIN_VERIFY  = '0' AND GENDER ="."'".$gender."'");
      return $query->result();
        
    }
	
	function cancelallotment($gender)
    {
      $otherdb = $this->load->database('otherdb', TRUE);
	
	  $query = $otherdb->query("SELECT COUNT(*) as COUNT_ROWS FROM TBL_ALLOTMENT WHERE ADMIN_VERIFY  = '2' AND GENDER ="."'".$gender."'");
      return $query->result();
        
    }
	
	function totreallotment($gender)
    {
      $otherdb = $this->load->database('otherdb', TRUE);
	
	  $query = $otherdb->query("SELECT COUNT(*) as COUNT_ROWS FROM TBL_REALLOTMENT WHERE GENDER ="."'".$gender."'");
      return $query->result();
        
    }
	
	function verifyreallotment($gender)
    {
      $otherdb = $this->load->database('otherdb', TRUE);
	
	  $query = $otherdb->query("SELECT COUNT(*) as COUNT_ROWS FROM TBL_REALLOTMENT WHERE ADMIN_VERIFY  = '1' AND GENDER ="."'".$gender."'");
      return $query->result();
        
    }
	
	function pendingreallotment($gender)
    {
      $otherdb = $this->load->database('otherdb', TRUE);
	
	  $query = $otherdb->query("SELECT COUNT(*) as COUNT_ROWS FROM TBL_REALLOTMENT WHERE ADMIN_VERIFY  = '0' AND GENDER ="."'".$gender."'");
      return $query->result();
        
    }
	
	function cancelreallotment($gender)
    {
      $otherdb = $this->load->database('otherdb', TRUE);
	
	  $query = $otherdb->query("SELECT COUNT(*) as COUNT_ROWS FROM TBL_REALLOTMENT WHERE ADMIN_VERIFY  = '2' AND GENDER ="."'".$gender."'");
      return $query->result();
        
    }
	
	function totalstudent($gender)
    {
      $otherdb = $this->load->database('otherdb', TRUE);
	
	  $query = $otherdb->query(" SELECT ( SELECT COUNT(*) FROM TBL_ALLOTMENT WHERE GENDER = '$gender' ) AS count1, ( SELECT COUNT(*) FROM TBL_REALLOTMENT  WHERE GENDER = '$gender') AS count2 FROM dual");
	  $result = $query->result();
	  return $result;
        
    }
	
	function totaldefault($gender)
    {
      $otherdb = $this->load->database('otherdb', TRUE);
	
	  $query = $otherdb->query("SELECT COUNT(*) as COUNT_ROWS FROM TBL_ALLOTREALLOT WHERE GENDER ="."'".$gender."'");
      return $query->result();
        
    }
	
	function totalclearance($gender)
    {
      $otherdb = $this->load->database('otherdb', TRUE);
	
	  $query = $otherdb->query("SELECT COUNT(*) as COUNT_ROWS FROM TBL_CLEARANCE WHERE GENDER ="."'".$gender."'");
      return $query->result();
        
    }
	
	function totalblacklist($gender)
    {
      $otherdb = $this->load->database('otherdb', TRUE);
	
	  $query = $otherdb->query("SELECT COUNT(*) as COUNT_ROWS FROM TBL_BLACKLIST WHERE GENDER ="."'".$gender."'");
      return $query->result();
        
    }
	
	
}

  