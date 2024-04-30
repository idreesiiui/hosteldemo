<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{
    

    public function __construct(){

		$this->otherdb = $this->load->database('otherdb', TRUE);
		
	}

	
    /**
     * This function used to check the login credentials of the user
     * @param string $email : This is email of the user
     * @param string $password : This is encrypted password of the user
     */
    function loginMe($user, $password)
    {
        $user = $this->otherdb->select('BaseTbl.userId, BaseTbl.password, BaseTbl.name, BaseTbl.regno, BaseTbl.GENDER, BaseTbl.cnic, BaseTbl.roleId, Roles.role')
			        ->from('tbl_users as BaseTbl')
			        ->join('tbl_roles as Roles','Roles.roleId = BaseTbl.roleId')
			        ->or_where('BaseTbl.email', $user)
					->or_where('BaseTbl.regno', $user)
			        ->where('BaseTbl.isDeleted', 0)
			        ->get()        
			        ->result();
        
        if(!empty($user)){
            if(verifyHashedPassword($password, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
	
	/**
     * This function used to check the login credentials of the user
     * @param string $email : This is email of the user
     * @param string $password : This is encrypted password of the user
     */
    function checkUser($user)
    {
        return $this->otherdb->select('BaseTbl.userId, BaseTbl.password, BaseTbl.name, BaseTbl.regno, BaseTbl.GENDER, BaseTbl.roleId, Roles.role')
			        ->from('tbl_users as BaseTbl')
			        ->join('tbl_roles as Roles','Roles.roleId = BaseTbl.roleId')
			        ->or_where('BaseTbl.email', $user)
					->or_where('BaseTbl.regno', $user)
			        ->where('BaseTbl.isDeleted', 0)
			        ->get()        
			        ->result();
    }
	
	function SISUserInfo($user)
    {
		$result = $this->db->select('REGNO, CNIC, STUDENTNAME, GENDER')
					->where('TBL_HSTUDENTS.REGNO', $user)
					->get('TBL_HSTUDENTS')
					->result();
		if(empty($result)){
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('*');
				$otherdb->from('students');
				//$otherdb->where('IS_ACTIVE', 1);
				$otherdb->where('REGNO', $user);				
				$query = $otherdb->get();
				$result = $query->result();
			}      
		//var_dump($result); exit();
			return $result; 
    }
	
	function Sisregno($user)
    {
        $result = $this->db->select('REGNO, CNIC, STUDENTNAME')
			        ->where('TBL_HSTUDENTS.REGNO', $user)
			        ->get('TBL_HSTUDENTS')
			        ->num_rows();



		if(empty($result)){
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('*');
				$otherdb->from('students');
				//$otherdb->where('IS_ACTIVE', 1);
				$otherdb->where('REGNO', $user);				
				$query = $otherdb->get();
				$result = $query->num_rows();
			}      
		
		//var_dump($user); exit();
        
       return ($result > 0) ? true : false;
    }
	
	function SisCnic($cnic)
    {       
        
       $result = $this->db->select('REGNO, CNIC, STUDENTNAME')
				        ->where('TBL_HSTUDENTS.CNIC', str_replace('-','', $cnic))
				        ->get('TBL_HSTUDENTS')
				        ->num_rows();
        
       if(empty($result)){
				$otherdb = $this->load->database('otherdb', TRUE);
				$otherdb->select('*');
				$otherdb->from('students');
				//$otherdb->where('IS_ACTIVE', 1);
				$otherdb->where('CNIC', $cnic);				
				$query = $otherdb->get();
				$result = $query->num_rows();
			}      
		
		//var_dump($user); exit();
        
       return ($result > 0) ? true : false;
    }
	
	 /**
     * This function used to check the login credentials of the user based on CNIC
     * @param string $CNIC : This is CNIC of the user
     * @param string $password : This is encrypted password of the user
     */
    function loginCNIC($cnic)
    {
		$cnic = str_replace('-','',$cnic);

		$sql = "Select REPLACE(CNIC, '-','') as CNIC,REGNO,GENDER FROM tbl_users
		 where REPLACE(CNIC, '-','') = '".$cnic."'";

		$user = $this->otherdb->query($sql)->result();

		if(empty($user))
		{
			$sql = "Select REPLACE(CNIC, '-','') as CNIC,REGNO,GENDER FROM tbl_application
			 where REPLACE(CNIC, '-','') = '".$cnic."'";

			$user = $this->otherdb->query($sql)->result();
		}

		if(empty($user))
		{
			$sql = "Select REPLACE(CNIC, '-','') as CNIC,REGNO,GENDER FROM tbl_maleapplication
				 where REPLACE(CNIC, '-','') = '".$cnic."'";

			$user = $this->otherdb->query($sql)->result();
		}


		if(empty($user))
		{
			$sql = "Select REPLACE(CNIC, '-','') as CNIC,REGNO,GENDER FROM tbl_allotment
						 where REPLACE(CNIC, '-','') = '".$cnic."'";

			$user = $this->otherdb->query($sql)->result();
		}


		if(empty($user))
		{
			$sql = "Select REPLACE(CNIC, '-','') as CNIC,REGNO,GENDER FROM tbl_reallotment
							 where REPLACE(CNIC, '-','') = '".$cnic."'";

			$user = $this->otherdb->query($sql)->result();
		}

		if(empty($user))
		{
			$sql = "Select REPLACE(CNIC, '-','') as CNIC,REGNO,GENDER FROM tbl_allotreallot
								 where REPLACE(CNIC, '-','') = '".$cnic."'";

			$user = $this->otherdb->query($sql)->result();
		}

		return $user;
			
    }
	
	function checkstudsregno($studregno)
    {
        $row = $this->db->select('REGNO, CNIC')
			        ->where('TBL_HSTUDENTS.REGNO', $studregno)
			        ->get('TBL_HSTUDENTS')
			        ->num_rows();
        
       return ($row > 0) ? true : false;
    }
	
	function getstudname($studregno)
    {
        return $this->db->select('REGNO, STUDENTNAME, CNIC')
			        ->where('TBL_HSTUDENTS.REGNO', $studregno)
			        ->get('TBL_HSTUDENTS')
			        ->result();       
    }
	
	function checkstudregno($studregno)
    {
        $row = $this->db->select('REGNO, CNIC, STUDENTNAME')
			        ->where('TBL_HSTUDENTS.REGNO', $studregno)
			        ->get('TBL_HSTUDENTS')
			        ->num_rows();
        
       return ($row > 0) ? true : false;
    }
	
	function checkstudexist($emailid, $gender)
    {

		$row = $this->otherdb->select('REGNO')
					->where('EMAILID', $emailid)
					->where('GENDER', $gender)
					->get('tbl_allotreallot')
					->num_rows();

		return ($row > 0) ? true : false;
		
    }
	
	function checkstudexistUser($emailid, $gender)
    {

		$row = $this->otherdb->select('regno')
					->where('userId', $emailid)
					->where('gender', $gender)
					->get('tbl_users')
					->num_rows();

		return ($row > 0) ? true : false;	   
		
    }

    /**
     * This function used to check email exists or not
     * @param {string} $email : This is users email id
     * @return {boolean} $result : TRUE/FALSE
     */
    function checkEmailExist($email)
    {
		$row = $this->otherdb->select('userId, gender')
					->where('email', $email)
					->where('isDeleted', 0)
					->get('tbl_users')
					->num_rows();

        return ($row > 0) ? true : false;
    }
	
	function checkEmailinfo($email)
    {
		return $this->otherdb->where('email', $email)->get('tbl_users')->result();
    }
	
	function checkRegnoExisttbl($regno)
    {
		$row = $this->otherdb->select('REGNO')
					->where('REGNO', $regno)
					->get('tbl_allotment')
					->num_rows();

        if (empty($row)){
            $row = $this->otherdb->select('REGNO')
					->where('REGNO', $regno)
					->get('tbl_reallotment')
					->num_rows();
        }

        if (empty($row)){
            $row = $this->otherdb->select('REGNO')
					->where('REGNO', $regno)
					->get('tbl_allotreallot')
					->num_rows();
        }

        if (empty($row)){
            $row = $this->otherdb->select('STUDENTEMAIL')
					->where('REGNO', $regno)
					->get('tbl_application')
					->num_rows();
        }

        if (empty($row)){
            $row = $this->otherdb->select('STUDENTEMAIL')
					->where('REGNO', $regno)
					->get('tbl_maleapplication')
					->num_rows();
        }

        return ($row > 0) ? true : false;				
		
    }
	
	function semcode($gender)
    {
		return $this->otherdb->select('distinct(SEMCODE) as SEMCODE')
					->where('GENDER', $gender)
					->where('IS_ACTIVE', '1')
					// ->order_by('SMCODE', 'desc')
					// ->limit('1')
					->get('tbl_semester')
					->row();
	}
	
	function FeeInfo($studregno, $gender, $csemcode)
    { 
		$feetypes = $this->otherdb->select('FEETYPE')
								->where('REGNO', $studregno)
								->where('GENDER', $gender)
								->where('FEETYPE', 'HOSTEL FEE')
								->get('paychallan')
								->row();

		$feetype = $feetypes->FEETYPE;
		
		if($feetype == 'HOSTEL FEE')
		{
			return $this->otherdb->where('REGNO', $studregno)
						->where('GENDER', $gender)
						->where('CURRENTSEMESTER', $csemcode)
						->where('FEETYPE', 'HOSTEL FEE')
						->order_by('ID', 'desc')
						->limit('1')
						->get('paychallan')	
						->result();
			
		} else if($feetype == 'NEW HOSTEL FEE') {			

			return $this->otherdb->where('REGNO', $studregno)
						->where('GENDER', $gender)
						->where('CURRENTSEMESTER', $csemcode)
						->where('FEETYPE', 'NEW HOSTEL FEE')
						->order_by('ID', 'desc')
						->limit('1')
						->get('paychallan')	
						->result();
		  
		}
		
	}

    function GetStudInfo($regno)
    {
		$result = $this->otherdb->where('REGNO', $regno)->get('tbl_application')->result();

        if (empty($result))
		{
			return $this->otherdb->where('REGNO', $regno)->get('tbl_maleapplication')->result();
        } 
		
        return $result;
        
    }

	function updateuser($data, $emailid)
    {
		$this->otherdb->where('userId', $emailid)->update('tbl_users', $data);

        return $this->otherdb->affected_rows();
    }

    /**
     * This function used to insert reset password data
     * @param {array} $data : This is reset password data
     * @return {boolean} $result : TRUE/FALSE
     */
    function resetPasswordUser($data, $email)
    {
		$this->otherdb->where('email', $email)->update('tbl_users', $data);

        return $this->otherdb->affected_rows();
    }
	
	function resetEmailUsers($data, $userid)
    {
		$this->otherdb->where('userId', $userid)->update('tbl_users', $data);

        return $this->otherdb->affected_rows();
    }

    /**
     * This function is used to get customer information by email-id for forget password email
     * @param string $email : Email id of customer
     * @return object $result : Information of customer
     */
    function getCustomerInfoByEmail($email)
    {
		return $this->otherdb->select('userId, email, name')
							->where('isDeleted', 0)
							->where('email', $email)
							->get('tbl_users')
							->result();
    }
	
	function GetEmailinfo($regno)
    {
		$result = $this->otherdb->select('tbl_allotment.REGNO,EMAILID,email,userId')
						->from('tbl_allotment')
						->join('tbl_users','tbl_users.userId = tbl_allotment.EMAILID')
						->where('tbl_allotment.REGNO', $regno)
						->get()
						->result();
		
		if(empty($result))
		{
			$result = $this->otherdb->select('tbl_reallotment.REGNO,EMAILID,email,userId')
							->from('tbl_reallotment')
							->join('tbl_users','tbl_users.userId = tbl_reallotment.EMAILID')
							->where('tbl_reallotment.REGNO', $regno)
							->get()
							->result();

		}

		if(empty($result))
		{
			$result = $this->otherdb->select('tbl_allotreallot.REGNO,EMAILID,email,userId')
							->from('tbl_allotreallot')
							->join('tbl_users','tbl_users.userId = tbl_allotreallot.EMAILID')
							->where('tbl_allotreallot.REGNO', $regno)
							->get()
							->result();

		}

		if(empty($result))
		{			

			$result = $otherdb->where('REGNO', $regno)->get('tbl_application')->result();

		}

		if(empty($result))
		{			

			$result = $otherdb->where('REGNO', $regno)->get('tbl_maleapplication')->result();

		}

		return $result;
    }

    /**
     * This function used to check correct activation deatails for forget password.
     * @param string $email : Email id of user
     * @param string $activation_id : This is activation string
     */
    function checkActivationDetails($email, $activation_id)
    {
		return $this->otherdb->select('id')
					->where('email', $email)
					->where('activation_id', $activation_id)
					->get('tbl_reset_password')
					->num_rows();
         
    }

    // This function used to create new password by reset link
    function createPasswordUser($email, $password)
    {
		$this->otherdb->where('email', $email)
						->where('isDeleted', 0)
						->update('tbl_users', array('password'=>getHashedPassword($password)));

        $this->otherdb->delete('tbl_reset_password', array('email'=>$email));

        return $this->otherdb->affected_rows();
    }
	
	function getsendemail($gender, $emailtype)
	{
		//return $this->otherdb->where('GENDER', $gender)
			//		->where('TYPE', $emailtype)
			//		->order_by('ID', 'ASC')
			//		->get('tbl_email')
			//		->result();
	}
		
	function GetGenderById($userId)
    {
		return $this->otherdb->select('GENDER')
						->where('userId',$userId)
						->get('TBL_USERS')
						->result();
    }
	
	function StudPic($studregno)
    {
        return $this->db->select('STUDPIC')
			        ->where('REGNO', $studregno)
			        ->get('STUDENTPICTURELR')
			        ->result();
    }
}

?>