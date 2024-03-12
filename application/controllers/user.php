<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// ini_set('memory_limit', '-1');
// error_reporting(E_ALL);

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Muhammad Idrees 
 * @version : 2.0
 * @since : 17 November 2022
 */
class User extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {

     	$userId = $this->vendorId;

        $gender = $this->gender;		
		
		$data['totalapplication'] = $this->user_model->totalapplication($gender);
		
		$data['verifyapplication'] = $this->user_model->verifyapplication($gender);
		
		$data['pendingapplication'] = $this->user_model->pendingapplication($gender);
		
		$data['cancelapplication'] = $this->user_model->cancelapplication($gender);
		
		$data['totalhostel'] = $this->user_model->totalhostel($gender);
		
		$data['totalroom'] = $this->user_model->totalroom($gender);
		
		$data['totalseat'] = $this->user_model->totalseat($gender);
		
		$data['totalvseat'] = $this->user_model->totalvseat($gender);
		
		$data['totaloseat'] = $this->user_model->totaloccupiedseat($gender);
		
		$data['totalitem'] = $this->user_model->totalitem($gender);
		
		$data['totalallotment'] = $this->user_model->totallotment($gender);
		
		$data['verifyallotment'] = $this->user_model->verifyallotment($gender);
		
		$data['pendingallotment'] = $this->user_model->pendingallotment($gender);
		
		$data['cancelallotment'] = $this->user_model->cancelallotment($gender);
		
		$data['totalreallotment'] = $this->user_model->totreallotment($gender);
		
		$data['verifyreallotment'] = $this->user_model->verifyreallotment($gender);
		
		$data['pendingreallotment'] = $this->user_model->pendingreallotment($gender);
		
		$data['cancelreallotment'] = $this->user_model->cancelreallotment($gender);
		
		$data['totaldefault'] = $this->user_model->totaldefault($gender);
		
		$data['totalclearance'] = $this->user_model->totalclearance($gender);
		
		$data['totalblacklist'] = $this->user_model->totalblacklist($gender);
				
		$this->global['pageTitle'] = 'IIUI Hostel : Dashboard';
		
        $this->loadViews("dashboard", $this->global , $data, NULL);
    }

    function studentRecord(){

        $this->global['pageTitle'] = 'IIUI Hostel : Student Eniter Record';

        $this->loadViews("student/std_entir_record", $this->global , $data, NULL);

    }

    function getStudentInfoByRegNo(){
        $this->global['pageTitle'] = 'IIUI Hostel : Student Eniter Record';
        $regno = $this->input->post('regno');

        $data['allotment_history'] = $this->user_model->getAllomentHistoryInfo($regno);
        $data['getKeyInfo'] = $this->user_model->getKeyInfo($regno);


        $this->loadViews("student/std_entir_record", $this->global , $data, NULL);

    }
    
    /**
     * This function is used to load the user list
     */
    function userListing()
    {
        if($this->isTicketter() == FALSE)
        {
            $this->loadThis();
        }
        else
        {		
			
			$userId = $this->vendorId;
				
			$gender = $this->gender; 
		
            $searchText = $this->input->post('searchText');
			
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->userListingCount($searchText, $gender);

			$returns = $this->paginationCompress ( "userListing/", $count, 20 );
            
            $data['userRecords'] = $this->user_model->userListing($searchText, $returns["page"], $returns["segment"], $gender);
            
            $this->global['pageTitle'] = 'IIUI Hostels : User Listing';
            
            $this->loadViews("users", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        if($this->isTicketter() == FALSE)
        {
            $this->loadThis();
        }
        else
        {
            
            $data['roles'] = $this->user_model->getUserRoles();
            
            $this->global['pageTitle'] = 'IIUI Hostels : Add New User';

            $this->loadViews("addNew", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to check whether email already exist or not
     */
    function checkEmailExists()
    {
        $userId = $this->input->post("userId");
        $email = $this->input->post("email");

        if(empty($userId)){
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }

        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }
    
    /**
     * This function is used to add new user to the system
     */
    function addNewUser()
    {
        if($this->isTicketter() == FALSE)
        {
            $this->loadThis();
        } else  {            
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|max_length[128]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
			 $this->form_validation->set_rules('cnic','CNIC','trim|required|max_length[13]');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[11]|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            } else {

                $name = ucwords(strtolower($this->input->post('fname')));
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->input->post('mobile');
				$regno = $this->input->post('regno');
				$cnic = $this->input->post('cnic');
                
				$userId = $this->vendorId;
				
				$exitsemail = $this->user_model->verifyexistEmail($email);
				$existCNIC = $this->user_model->verifyexistCNIC($cnic);
				$existregno = $this->user_model->verifyexistregno($regno);
				
				if($exitsemail == true || $existCNIC == true || $existregno == true )
				{
						
					$this->session->set_flashdata('error', 'Email, CNIC OR REGNO already exist');
					redirect ('addNew');
				} else {
				
				    $gender = $this->gender;
				
                    $userInfo = array(
                                    'email'=>strtolower($email), 
                                    'password'=>getHashedPassword($password), 
                                    'roleId'=>$roleId, 
                                    'name'=> $name, 
                                    'regno'=> $regno, 
                                    'cnic'=> $cnic,
                                    'mobile'=>$mobile,
                                    'gender'=>$gender, 
                                    'createdBy'=>$this->vendorId, 
                                    'createdDtm'=>date('Y-m-d H:i:s')
                                );
                
                    
                    $result = $this->user_model->addNewUser($userInfo);
		        }
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New User created successfully');
                } else {
                    $this->session->set_flashdata('error', 'User creation failed');
                }
                
                redirect('userListing');
            }
        }
    }

    
    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($userId = NULL)
    {
        if($this->isTicketter() == FALSE || $userId == 1)
        {
            $this->loadThis();
        }
        else
        {
            
			if($userId == NULL)
            {
				
                redirect('userListing');
            }
            
            $data['roles'] = $this->user_model->getUserRoles();
            $data['userInfo'] = $this->user_model->getUserInfo($userId);
            
            $this->global['pageTitle'] = 'IIUI Hostels : Edit User';
           // echo $userId;exit();
            $this->loadViews("editOld", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function editUser()
    {
        if($this->isTicketter() == FALSE)
        {
            $this->loadThis();
        } else {            
            
            $userId = $this->input->post('userId');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|max_length[128]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('cnic','CNIC','trim|max_length[13]');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[11]|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($userId);
            } else {

                $name = ucwords(strtolower($this->input->post('fname')));
                $email = strtolower($this->input->post('email'));
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->input->post('mobile');
				$uId = $this->input->post('userId');
				$gender = $this->input->post('gender');
				$cnic = str_replace('-','',$this->input->post('cnic'));
				$regno = $this->input->post('regno');
                				
				$exitsemail = $this->user_model->existEmail($email, $userId);
				$existCNIC = $this->user_model->existCNIC($cnic, $userId);
				$existregno = $this->user_model->existRegno($regno, $userId);
				
				if($exitsemail == true || $existCNIC == true || $existregno == true )
				{
						
					$this->session->set_flashdata('error', 'Email, CNIC or Regno already exist');
					$this->editOld($userId);
				} else {
                
                    if(empty($password))
                    {
					
    				    $userId = $uId;		
    			
    				    $userInfo = array(
                            'email'=>strtolower($email), 
                            'roleId'=>$roleId, 
                            'name'=>$name, 
                            'regno'=> $regno,
                            'cnic'=>$cnic, 
                            'mobile'=>$mobile, 
                            'gender'=>$gender, 
                            'updatedBy'=>$this->vendorId, 
                            'updatedDtm'=>date('Y-m-d H:i:s')
                        );

					   $result = $this->user_model->editUser($userInfo, $userId);
					
			        } else {
                   		
                        $userInfo = array(
                            'email'=>strtolower($email), 
                            'password'=>getHashedPassword($password), 
                            'roleId'=>$roleId, 
                            'regno'=> $regno,
                            'cnic'=>$cnic,
                            'name'=>ucwords($name), 
                            'mobile'=>$mobile, 
                            'gender'=>$gender, 
                            'updatedBy'=>$this->vendorId, 
                            'updatedDtm'=>date('Y-m-d H:i:s')
                        );
						
					   $result = $this->user_model->editUser($userInfo, $userId, $roleId);
                	
				    }
                
					if($result == true)
					{
						$this->session->set_flashdata('success', 'User updated successfully');
						redirect('userListing');
					} else {
						$this->session->set_flashdata('error', 'User updation failed');
						$this->editOld($userId);
					}
		        } 
            }
        }
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $userId = $this->input->post('userId');
            $userInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->user_model->deleteUser($userId, $userInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
    /**
     * This function is used to load the change password screen
     */
    function loadChangePass()
    {
        $this->global['pageTitle'] = 'IIUI Hostels : Change Password';
        
        $this->loadViews("changePassword", $this->global, NULL, NULL);
    }
    
    
    /**
     * This function is used to change the password of the user
     */
    function changePassword()
    {        
        
        $this->form_validation->set_rules('oldPassword','Old password','required|max_length[20]');
        $this->form_validation->set_rules('newPassword','New password','required|max_length[20]');
        $this->form_validation->set_rules('cNewPassword','Confirm new password','required|matches[newPassword]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->profile();
        }
        else
        {
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');
            
            $resultPas = $this->user_model->matchOldPassword($this->vendorId, $oldPassword);
            
            if(empty($resultPas))
            {
                $this->session->set_flashdata('nomatch', 'Your old password not correct');
                redirect('profile');
            }
            else
            {
                $usersData = array('password'=>getHashedPassword($newPassword), 'updatedBy'=>$this->vendorId,
                                'updatedDtm'=>date('Y-m-d H:i:s'));
                
                $result = $this->user_model->changePassword($this->vendorId, $usersData);
                
                if($result > 0) { $this->session->set_flashdata('success', 'Password updation successful'); }
                else { $this->session->set_flashdata('error', 'Password updation failed'); }
                
                redirect('profile');
            }
        }
    }
	
	/**
     * This function is used to show users profile
     */
    function profile($active = "details")
    {
	   //$data["userInfo"] = $this->user_model->getUserInfoWithRole($this->vendorId);
	  //print_r($this->session->userdata); exit();
	   $regno = $this->vendorId;
	   if (strpos($regno, '/') !== false) {
           $data["userInfo"] = $this->user_model->getUserInfoWithRole($regno);
		}
	   else{
		     $data["userInfo"] = $this->user_model->getSysUserInfoWithRole($regno);
	   }
       $data["active"] = $active;
       $this->global['pageTitle'] = $active == "details" ? 'IIUI Hostels : My Profile' : 'IIUI Hostels : Change Password';
       $this->loadViews("profile", $this->global, $data, NULL);
    }

    /**
     * This function is used to update the user details
     * @param text $active : This is flag to set the active tab
     */
    function profileUpdate($active = "details")
    {
        
            
        $this->form_validation->set_rules('cnic','CNIC','trim|required|max_length[128]');
        $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]|callback_emailExists');        
        
        if($this->form_validation->run() == FALSE)
        {
            $this->profile($active);
        }
        else
        {
			$cnic = str_replace('-','', strtoupper($this->security->xss_clean($this->input->post('cnic'))));
			$mobile = $this->security->xss_clean($this->input->post('mobile'));
			$email = strtolower($this->security->xss_clean($this->input->post('email')));
				
			if(!$this->user_model->existEmail($email, $this->vendorId) && !$this->user_model->existCNIC($cnic, $this->vendorId))
			{
				
				
				$userInfo = array('cnic'=>$cnic, 'email'=>$email, 'mobile'=>$mobile, 'updatedBy'=>$this->name, 'updatedDtm'=>date('Y-m-d H:i:s'));
				
				$result = $this->user_model->editUser($userInfo, $userId);
				
				if($result == true)
				{
					//$this->session->set_userdata('name', $name);
					$this->session->set_userdata('cnic', $cnic);
					$this->session->set_flashdata('success', 'Profile updated successfully');
				}
				else
				{
					$this->session->set_flashdata('error', 'Profile updation failed');
				}
	
				redirect('profile');
			}
			else
			{
				if($this->user_model->existEmail($email, $this->vendorId))
			 	{
                    $msg = 'Email already exist';
					$this->session->set_flashdata('error', $msg);
				}
				
			    if($this->user_model->existCNIC($cnic, $this->vendorId))
			 	{
                    $msg = 'CNIC already exist';
					$this->session->set_flashdata('error', $msg);
				}
				redirect('profile');
			}
        }
    }

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'IIUI Hostels : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}

?>