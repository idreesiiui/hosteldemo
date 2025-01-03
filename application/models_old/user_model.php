<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function __construct(){

		$this->otherdb = $this->load->database('otherdb', TRUE);
    }

    function getAllomentHistoryInfo($regno){
    	return $this->otherdb->where('REGNO',$regno)->get('tbl_allotmenthistory')->result();
    }

    function getKeyInfo($regno){
    	return $this->otherdb->where('REGNO',$regno)->get('tbl_allotmenthistory')->result();
    }

    function userListingCount($searchText, $gender)
    {
		
        $this->otherdb->select('TBL_USERS.USERID, TBL_USERS.EMAIL, TBL_USERS.REGNO, TBL_USERS.CNIC, TBL_USERS.NAME, TBL_USERS.MOBILE,TBL_USERS.GENDER, TBL_ROLES.ROLE')
        		->from('TBL_USERS')
        		->join('TBL_ROLES', 'TBL_ROLES.ROLEID = TBL_USERS.ROLEID','left');
        if(!empty($searchText)) {
            $likeCriteria = "(TBL_USERS.EMAIL  LIKE '%".trim($searchText)."%'
                            OR  TBL_USERS.NAME  LIKE '%".trim($searchText)."%'
							OR  TBL_USERS.USERID  LIKE '%".trim($searchText)."%'
							OR  TBL_USERS.CNIC  LIKE '%".trim($searchText)."%'
							OR  TBL_USERS.REGNO  LIKE '%".trim($searchText)."%'
							OR  TBL_ROLES.role  LIKE '%".trim($searchText)."%'
                            OR  TBL_USERS.MOBILE  LIKE '%".trim($searchText)."%')";
            $this->otherdb->where($likeCriteria);
        }
        $this->otherdb->where('TBL_USERS.ISDELETED', 0);
        $this->otherdb->where('TBL_USERS.gender', $gender);
		$this->otherdb->where('TBL_USERS.ROLEID !=', 1);

        return $this->otherdb->get()->num_rows();        
         
    }
    
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    
    function userListing($searchText = '', $page, $segment, $gender)
    {
        
		$this->otherdb->select('TBL_USERS.USERID, TBL_USERS.EMAIL, TBL_USERS.REGNO, TBL_USERS.CNIC, TBL_USERS.NAME, TBL_USERS.MOBILE, TBL_USERS.GENDER, TBL_ROLES.ROLE')
				->from('TBL_USERS')
				->join('TBL_ROLES', 'TBL_ROLES.ROLEID = TBL_USERS.ROLEID','left');
        if(!empty($searchText)) {
             $likeCriteria = "(TBL_USERS.EMAIL  LIKE '%".trim($searchText)."%'
                            OR  TBL_USERS.NAME  LIKE '%".trim($searchText)."%'
							OR  TBL_USERS.USERID  LIKE '%".trim($searchText)."%'
							OR  TBL_USERS.CNIC  LIKE '%".trim($searchText)."%'
							OR  TBL_USERS.REGNO  LIKE '%".trim($searchText)."%'
							OR  TBL_ROLES.role  LIKE '%".trim($searchText)."%'
                            OR  TBL_USERS.MOBILE  LIKE '%".trim($searchText)."%')";
            $this->otherdb->where($likeCriteria);
        }
        $this->otherdb->where('TBL_USERS.ISDELETED', 0);
				$this->otherdb->where('TBL_USERS.gender', $gender);
       // $this->otherdb->where('TBL_USERS.ROLEID !=', 1);
        $this->otherdb->where('TBL_USERS.ROLEID !=', 4);
       // $this->otherdb->limit($page, $segment);
        $query = $this->otherdb->get();

       // return $query->last_query();       
        return $query->result();       
         
    }    
	

    function GetRoleById($userId)
    {
		
		return $this->otherdb->select('roleId')
							->where('userId',$userId)
							->get('TBL_USERS')
							->result();
    }
	
    /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
    function getUserRoles()
    {
        
		return $this->otherdb->select('ROLEID, ROLE')
							->where('ROLEID !=', 1)
							->get('TBL_ROLES')
							->result();
    }
    
	function existCNIC($cnic,$userId)
	{
		
		$row = $this->otherdb->where('CNIC',$cnic)
						->where('USERID !=', $userId)
						->where('cnic !=', '')
						->where('isDeleted', 0)
						->get('TBL_USERS');
		
		return ($row->num_rows() > 0) ? true : false;
	}
	
	function existEmail($email,$userId)
	{
		
		$row = $this->otherdb->where('EMAIL',$email)
							->where('USERID !=', $userId)
							->where('isDeleted', 0)
							->get('TBL_USERS');
		
		return ($row->num_rows() > 0) ? true : false;
	}
	
	 
	function existRegno($regno, $userId)
	{		
		$row = $this->otherdb->where('regno',$regno)
							->where('USERID !=', $userId)
							->where('regno !=', '')
							->where('isDeleted', 0)
							->get('TBL_USERS');
		
		return ($row->num_rows() > 0) ? true : false;
	}
	
	function verifyexistCNIC($cnic)
	{
		
		$row = $this->otherdb->where('CNIC',$cnic)
							->where('CNIC !=', '')
							->get('TBL_USERS');
		
		return ($row->num_rows() > 0) ? true : false;
	}
	
	function verifyexistEmail($email)
	{
		
		$row = $this->otherdb->where('EMAIL',$email)->get('TBL_USERS');
		
		return ($row->num_rows() > 0) ? true : false;
	}
	
	function verifyexistregno($regno)
	{
		
		$row = $this->otherdb->where('regno',$regno)
							->where('regno !=', '')
							->get('TBL_USERS');
		
		return ($row->num_rows() > 0) ? true : false;
	}
    
    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewUser($userInfo)
    {

        $this->otherdb->insert('TBL_USERS', $userInfo);
    
        return $this->otherdb->insert_id();        
        
    }
    
    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getUserInfo($userId)
    {
        
		return $this->otherdb->select('USERID, NAME, EMAIL, MOBILE, GENDER, CNIC, ROLEID, REGNO')
								->where('ISDELETED', 0)
								->where('ROLEID !=', 1)
								->where('USERID', $userId)
								->get('TBL_USERS')
								->result();
    }
	
	/**
     * This function used to get user information and role join by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getUserInfoWithRole($regno)
    {
        return $this->otherdb->select('USERID, NAME, CNIC, EMAIL, MOBILE, GENDER, USERS.ROLEID, ROLE, REGNO')
        					->from('TBL_USERS as USERS')
        					->join('TBL_ROLES as ROLES','USERS.roleId = ROLES.roleId')
        					->where('ISDELETED', 0)
        					->where('REGNO', $regno)
        					->get()
        					->result();
    }
	
	function getSysUserInfoWithRole($regno)
    {
        
		return $this->otherdb->select('USERID, NAME, CNIC, EMAIL, MOBILE, GENDER, USERS.ROLEID, ROLE, REGNO')
							->from('TBL_USERS as USERS')
							->join('TBL_ROLES as ROLES','USERS.roleId = ROLES.roleId')
							->where('ISDELETED', 0)
							->where('userId', $regno)
							->get()
							->result();
    }
    
    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function editUser($userInfo, $userId)
    {
        if($roleId != 4){

			$this->otherdb->where('USERID', $userId)->update('TBL_USERS', $userInfo);
        
        	return $this->otherdb->affected_rows();

		}elseif($this->role == 4){
			  
			$this->otherdb->where('REGNO', $userId)->update('TBL_USERS', $userInfo);
        
        	return $this->otherdb->affected_rows();
		}
    }

    function updateStudemails($userInfo, $regno)
    {
        
    	$this->otherdb->where('regno', $regno)->update('TBL_USERS', $userInfo);
        
       	return $this->otherdb->affected_rows();
    }
    
    
    
    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser($userId, $userInfo)
    {
        $this->otherdb->where('USERID', $userId)->update('TBL_USERS', $userInfo);
        
        return $this->otherdb->affected_rows();
    }


    /**
     * This function is used to match users password for change password
     * @param number $userId : This is user id
     */
    function matchOldPassword($userId, $oldPassword)
    {
        
		$user = $this->otherdb->select('userId, password')
							->where('userId', $userId)
							->where('isDeleted', 0)
							->get('tbl_users')
							->result();

        if(!empty($user)){
            if(verifyHashedPassword($oldPassword, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
    
    /**
     * This function is used to change users password
     * @param number $userId : This is user id
     * @param array $userInfo : This is user updation info
     */
     function changePassword($userId, $userInfo)
    {
        
		$this->otherdb->where('userId', $userId)
						->where('isDeleted', 0)
						->update('tbl_users', $userInfo);
        
        return $this->otherdb->affected_rows();
    }
	
	
	/** Count number of applied students and all status 
	of cuurnet semester registration **/
	
	function verifyapplication($gender)
    {   

      if($gender === 'Female'){

      		$row = $this->otherdb->where('STATUS',1)->get('TBL_APPLICATION');

      		return $row->num_rows();

    	}else{

    		$row = $this->otherdb->where('STATUS',1)->get('tbl_maleapplication');

    		return $row->num_rows();

    	} 
        
    }
	
	function totalapplication($gender)
    {   
    	if($gender === 'Female'){

      		$row = $this->otherdb->get('TBL_APPLICATION');

      		return $row->num_rows();

    	}else{

    		$row = $this->otherdb->get('tbl_maleapplication');

    		return $row->num_rows();

    	}        
    }
	
	function pendingapplication($gender)
    {
      if($gender === 'Female'){

      		$row = $this->otherdb->where('STATUS','0')->get('TBL_APPLICATION');

      		return $row->num_rows();

    	}else{

    		$row = $this->otherdb->where('STATUS','0')->get('tbl_maleapplication');

    		return $row->num_rows();

    	} 
        
    }
	
	function cancelapplication($gender)
    {
      if($gender === 'Female'){

      		$row = $this->otherdb->where('STATUS','2')->get('TBL_APPLICATION');

      		return $row->num_rows();

    	}else{

    		$row = $this->otherdb->where('STATUS','2')->get('tbl_maleapplication');

    		return $row->num_rows();

    	} 
        
    }
	
	function totalhostel($gender)
    {      

      $row = $this->otherdb->where('GENDER',$gender)->get('TBL_HOSTEL');

      return $row->num_rows();
        
    }
	
	function totalroom($gender)
  {      

      	$result = $this->otherdb->where('GENDER',$gender)->get('TBL_ROOM');

      	return $result->num_rows();        
  }
	
	function totalseat($gender)
    {
      $result = $this->otherdb->where('GENDER',$gender)->get('TBL_SEAT');

      return $result->num_rows();
        
    }
	
	function totalvseat($gender)
    { 

      $result = $this->otherdb->where('GENDER',$gender)
						    ->where('OCCUPIED','0')
						    ->get('TBL_SEAT');

			return $result->num_rows();     
    }
	
	function totaloccupiedseat($gender)
    {
      return $this->otherdb->where('GENDER',$gender)
						    ->where('OCCUPIED','1')
						    ->get('TBL_SEAT')
						    ->num_rows(); 
        
    }
	
	function totalitem($gender)
    {

      return $this->otherdb->where('GENDER',$gender)->get('TBL_ROOMITEM')->num_rows(); 
        
    }
	
	function totallotment($gender)
    {      

      return $this->otherdb->where('GENDER',$gender)->get('TBL_ALLOTMENT')->num_rows();
        
    }
	
	function verifyallotment($gender)
    {     

      return $this->otherdb->where('GENDER',$gender)
					      ->where('ADMIN_VERIFY','1')
					      ->get('TBL_ALLOTMENT')
					      ->num_rows();
        
    }
	
	function pendingallotment($gender)
    {      

      return $this->otherdb->where('GENDER',$gender)
					      ->where('ADMIN_VERIFY','0')
					      ->get('TBL_ALLOTMENT')
					      ->num_rows();
        
    }
	
	function cancelallotment($gender)
    {
      return $this->otherdb->where('GENDER',$gender)
					      ->where('ADMIN_VERIFY','2')
					      ->get('TBL_ALLOTMENT')
					      ->num_rows();
        
    }
	
	function totreallotment($gender)
    {      

      return $this->otherdb->where('GENDER',$gender)->get('TBL_REALLOTMENT')->num_rows();
        
    }
	
	function verifyreallotment($gender)
    {
      return $this->otherdb->where('GENDER',$gender)
					      ->where('ADMIN_VERIFY','1')
					      ->get('TBL_REALLOTMENT')
					      ->num_rows();
        
    }
	
	function pendingreallotment($gender)
    {

      return $this->otherdb->where('GENDER',$gender)
					      ->where('ADMIN_VERIFY','0')
					      ->get('TBL_REALLOTMENT')
					      ->num_rows();
        
    }
	
	function cancelreallotment($gender)
    {     

      return $this->otherdb->where('GENDER',$gender)
					      ->where('ADMIN_VERIFY','2')
					      ->get('TBL_REALLOTMENT')
					      ->num_rows();
        
    }
	
	function totaldefault($gender)
  { 

      return $this->otherdb->where('GENDER',$gender)->get('TBL_ALLOTREALLOT')->num_rows();
        
  }
	
	function totalclearance($gender)
  {      

      return $this->otherdb->where('GENDER',$gender)->get('TBL_CLEARANCE')->num_rows();
      
  }
	
	function totalblacklist($gender)
    {
      
      return $this->otherdb->where('GENDER',$gender)->get('TBL_BLACKLIST')->num_rows();
        
    }
	
	
}

  