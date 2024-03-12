<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Login (LoginController)
 * Login class to control to authenticate user credentials and starts user's session.
 * @author : Muhammad Idrees 
 * @version : 2.0
 * @since : 17 November 2022
 */
class Login extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('user_model');
		$this->load->model('feechallan_model');
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $this->isLoggedIn();
    }
    
    /**
     * This function used to check the user is logged in or not
     */
    function isLoggedIn()
    {
		$isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
			$this->load->view('frontend/include/header');
            $this->load->view('frontend/login');
			$this->load->view('frontend/include/footer');
        }
        else
        {
            redirect('/dashboard');
        }
    }
	
	function systemsignin()
    {
		$isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
			$this->load->view('frontend/include/header');
            $this->load->view('frontend/loginsystem');
			$this->load->view('frontend/include/footer');
        }
        else
        {
            redirect('/dashboard');
        }
    }
	
	
	
	function studentaddNewUser()
    {
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|max_length[128]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->forgotemail();
            }
            else
            {
                $name = ucwords(strtolower($this->input->post('fname')));
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->input->post('mobile');
                $gender = $this->input->post('gender');
				$regno = $this->input->post('regno');
				
                $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'roleId'=>$roleId,'regno'=>$regno, 'name'=> $name,
                                    'mobile'=>$mobile,'gender'=>$gender, 'createdBy'=>$roleId, 'createdDtm'=>date('Y-m-d H:i:s'));
                
                
                $result = $this->user_model->addNewUser($userInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New User created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User creation failed');
                }
                
                redirect('login');
            }
    }
	
	public function GetRegno()
    {
        
        $this->form_validation->set_rules('regno', 'Regno', 'required|max_length[128]|xss_clean|trim');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->forgotemail();
        }
        else
        {
            $regno = $this->input->post('regno');
            
            $result = $this->login_model->checkRegnoExisttbl($regno);
			
			if($result == '1')
			  {
				 
				 $result = $this->login_model->GetEmailinfo($regno);
				 
				 if(!empty($result[0]->STUDENTEMAIL))
				   {
					   $email = $result[0]->STUDENTEMAIL;
					   $result = $this->login_model->getCustomerInfoByEmail($email);
				   }
				 
				 if(!empty($result))
				   {
					   if(!empty($email))
					      {
							  $data['emailinfo'] = $this->login_model->getCustomerInfoByEmail($email);
					          $data['regnoinfo'] = $regno;
						  }
						  else
						      {
								   $data['emailinfo'] =  $this->login_model->GetEmailinfo($regno);
								   $data['regnoinfo'] = '';
							  }
					   $this->load->view('useremailinfo', $data);
				   }
				   else
				   {
					    $data['userinfo'] = $this->login_model->GetStudInfo($regno);
               
                		$this->load->view('studentsignup', $data);
					
				   }
			  }
			  else{
			            
				     $this->session->set_flashdata('error', 'Invalid Regno');
               
                	 $this->load->view('forgotemail'); 
				   
			      }
		}
	}
    
    
    /**
     * This function used to logged in user
     */
    public function loginMe()
    {
        
        $this->form_validation->set_rules('user', 'Email/Regno/CNIC', 'required|max_length[128]|xss_clean|trim');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
			$user = $this->input->post('user');
            $cnic = str_replace('-','',$this->input->post('password'));
			$studregno = $this->input->post('user');
			
			$sisregno = $this->login_model->Sisregno($user);
			
			$Sisresult = $this->login_model->SISUserInfo($user);
			
			$SIScnic = str_replace('-','', $Sisresult[0]->CNIC);
			
			if($sisregno == false)
			{
				$this->session->set_flashdata('error', 'Invalid Regno. Enter Regno as per University ID Card');
                
                redirect('/login');
			}
			if(trim($SIScnic) != trim($cnic))
			{
				$this->session->set_flashdata('error', 'Invalid CNIC. Enter CNIC as per University Record OR Update your CNIC from Admission Section');
                
                redirect('/login');
			  }
			  if($sisregno > 0)
			    {
					$result = $this->login_model->SISUserInfo($user);
					
					foreach ($result as $key => $res)
                          {
                    		 $gender = $res->GENDER;
							 if($gender == 'M')
							    {
									$gender = 'Male';
									$userId = $result[0]->REGNO;
								}
							elseif($gender = 'F')
							    {
									$gender = 'Female';
									$userId = $result[0]->REGNO;
								}
							 $roleId = 4;
							 $role = 'Student'; 
							 $name = $res->STUDENTNAME;
							 $studregno = $res->REGNO;
							
						  }
					
				}
				
		 $semcode = $this->login_model->semcode($gender);
		 
		 $csemcode = $semcode->SEMCODE;

         //echo $csemcode;


         //exit();
		 
		 $feetype = $this->feechallan_model->CheckFeeInfo($studregno, $gender, $csemcode);

         //var_dump($feetype);
	
		if(!empty($feetype))
		{
			$feestatus = $feetype->feetype;
		} else {
			$feestatus = 'NEW HOSTEL FEE';
		}
            $sessionArray = array(
                        'userId'=>$userId,                    
                        'role'=>$roleId,
                        'roleText'=>$role,
                        'gender'=>$gender,
                        'name'=>$name,
    					'cnic'=>$cnic,
    					'regno'=>$studregno,
    					'studregno'=>$studregno,
    					'feestatus'=>$feestatus,
                        'isLoggedIn' => TRUE
                    );
                            
            $this->session->set_userdata($sessionArray);
    		//pre($sessionArray);
            //exit();
            redirect('/dashboard');
        }
           
    }
	
	    /**
     * This function used to logged in System user
     */
    public function systemlogins()
    {
        
        $this->form_validation->set_rules('user', 'Email/Regno/CNIC', 'required|max_length[128]|xss_clean|trim');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
			$user = $this->input->post('user');
            $password = $this->input->post('password');
			$studregno = $this->input->post('user');
            $result = $this->login_model->checkUser($user);
			
			/*if(empty($result))
			{
				//$cnicinfo = $this->login_model->loginCNIC($user);
				//$user = $cnicinfo[0]->REGNO; $studregno = $cnicinfo[0]->REGNO;  $stdcnic = $cnicinfo[0]->CNIC;
				$result = $this->login_model->loginMe($user, $password);
			}*/
			
			$result = $this->login_model->loginMe($user, $password);
            // print_r($cnicinfo);
//			exit();
            if(count($result) > 0)
            {
                foreach ($result as $key => $res)
                {
                    $emailid = $res->userId; $gender = $res->GENDER; $roleId = $res->roleId; $name = $res->name;
					//$studregno = $res->regno;
					
					/*if($roleId == 4)
					   {
						  $regnoinfo = $this->login_model->checkstudsregno($studregno);*/
						  
						 /* if($regnoinfo > 0)
						    {
								$regnoinfo = $this->login_model->getstudname($studregno);
								
								$studentname = $regnoinfo[0]->STUDENTNAME;
								
								$data = array('name'=>$studentname);
								
								//$this->login_model->updateuser($data, $emailid);
							}*/
						  
						  /*$studregnoinfo = $this->login_model->checkstudregno($studregno);
						  
						  if($studregnoinfo == 0)
						    {
								  $this->session->set_flashdata('error', 'Invalid Regno. Enter Regno as per University ID Card');
                
                					redirect('/login');
							}*/
					 //  }
					 				
					//$studtype = $this->login_model->checkstudexist($emailid, $gender);
					/*pre($studtype);exit();
					if($studtype == 0)
					  {*/
						 //$studtype = $this->login_model->checkstudexistUser($emailid, $gender);
						 
						/* $feetype = $this->login_model->FeeInfo($studregno, $gender);
						
						 if(!empty($feetype))
						   {
						    $feestatus = $feetype[0]->FEETYPE;
						   }
						 else{
							  $feestatus = 'HOSTEL FEE';
						 }*/
					 // }
					
					 
					$sessionArray = array('userId'=>$res->userId,                    
                                            'role'=>$res->roleId,
                                            'roleText'=>$res->role,
                                            'gender'=>$res->GENDER,
                                            'name'=>$res->name,
											//'cnic'=>$res->cnic,
											//'studtype'=>$studtype,
											//'regno'=>$res->regno,
											//'studregno'=>$studregno,
											//'feestatus'=>$feestatus,
                                            'isLoggedIn' => TRUE
                                    );
                 //print_r($sessionArray);
                 //exit();             
                    $this->session->set_userdata($sessionArray);
                    
                    redirect('/dashboard');
                }
            }
            else
            {
                $this->session->set_flashdata('error', 'Invalid User or password ');
                
                redirect('/SystemSignIn');
            }
        }
    }

    /**
     * This function used to load forgot password view
     */
    public function forgotPassword()
    {
		$this->load->view('frontend/include/header');
        $this->load->view('frontend/forgotPassword');
		$this->load->view('frontend/include/footer');
    }
	
    public function forgetemail()
    {
        $this->load->view('frontend/include/header');
        $this->load->view('frontend/forgotEmail');
        $this->load->view('frontend/include/footer');
    }

    public function updatemail($data)
    {
        $this->load->view('frontend/include/header');
        $this->load->view('frontend/updateEmail',$data);
        $this->load->view('frontend/include/footer');
    }

    public function checkRegno()
    {
        
        $this->form_validation->set_rules('regno', 'Regno', 'required|max_length[128]|xss_clean|trim');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->forgetemail();
        }
        else
        {
            $regno = $this->input->post('regno');
            
            $result = $this->login_model->checkRegnoExisttbl($regno);
            
            if($result == '1')
              {
                 
                 $result = $this->login_model->GetEmailinfo($regno);
                 
                 if(!empty($result[0]->STUDENTEMAIL))
                   {
                       $email = $result[0]->STUDENTEMAIL;
                       $result = $this->login_model->getCustomerInfoByEmail($email);
                   }
                 
                 if(!empty($result))
                   {
                   
                    if(strpos($email, '_abc') !== true)
                          {
                              $data['emailinfo'] =  $this->login_model->GetEmailinfo($regno);
                              $data['regnoinfo'] = $regno;
                            //print_r($data);
                            //exit;
                               $this->updatemail($data);
                          }
                          else
                              {
                                   $this->session->set_flashdata('error', 'Enter email as on IIUI Hostel Card');

                                $this->forgotPassword();
                              }
                              
                             
                      
                   }
                   else
                   {
                        
               
                        
                        $data['userinfo'] = $this->login_model->GetStudInfo($regno);
                        $gender =$data['userinfo'];
                        
                        $this->session->set_flashdata('error', 'Sorry you are not registered with us. <br>Please Email us at hostel.'.strtolower( $gender[0]->GENDER).'@iiu.edu.pk');

                        $this->forgetemail();
                    
                   }
              }
              else{
                        
                     $this->session->set_flashdata('error', 'Invalid Regno');
               
                     $this->forgetemail(); 
                   
                  }
        }
    }

    function emailupdateStudent()
    {
            
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|max_length[128]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->forgetemail();
            }
            else
            {
                
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $regno = $this->input->post('regno');
                
                $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password));
                
                
                $result = $this->user_model->updateStudemails($userInfo, $regno);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Email and password Updated successfully');
                    redirect('login');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Email and password Updation failed');
                    $this->forgetemail();
                }
                
                
            }
    }

	public function forgotemail()
    {
        $this->load->view('forgotemail');
    }
	
	public function videoreallotment()
    {
        $this->load->view('videoreallot');
    }
    
    /**
     * This function used to generate reset password request link
     */
    function resetPasswordUser()
    {
        
        
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean');
                
        if($this->form_validation->run() == FALSE)
        {
            $this->forgotPassword();
        }
        else 
        {
            $email = $this->input->post('email');
            //pre($email);exit();
            if($this->login_model->checkEmailExist($email))
            { 
                $userinfo = $this->login_model->checkEmailinfo($email);
			
				$gender = $userinfo[0]->gender;
			
				/*$encoded_email = urlencode($email);
                
                $this->load->helper('string');
                $data['email'] = $email;
                $data['activation_id'] = random_string('alnum',15);
                $data['createdDtm'] = date('Y-m-d H:i:s');
                $data['agent'] = getBrowserAgent();
                $data['client_ip'] = $this->input->ip_address();*/
				
				function random_password( $length = 6 ) {
    //$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$chars = "0123456789";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
				}
				$password = random_password(8);
				
                $data = array('password'=>getHashedPassword($password));
				
                $save = $this->login_model->resetPasswordUser($data, $email);
				
				$emailtype = 'Reset Email';
					
				
				$sendemail = $this->login_model->getsendemail($gender, $emailtype);                
           
				if($save)
				{
				
                /* Mail function starts */
				 require 'PHPMailer/src/Exception.php';
                 require 'PHPMailer/src/PHPMailer.php';
                 require 'PHPMailer/src/SMTP.php';
                 require "PHPMailer/src/OAuth.php";
                 require "PHPMailer/src/POP3.php";

                    $mail = new PHPMailer\PHPMailer\PHPMailer();
               
                  //$mail->SMTPDebug;
					$mail->isSMTP(); 
                    $mail->Host = 'smtp-relay.gmail.com';    
                    $mail->SMTPAuth = true;                            
                    $mail->Username = $sendemail[0]->EMAIL;            
                    $mail->Password = $sendemail[0]->PASSWORD;
					$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
					$mail->Port = 587;                                     // TCP port to connect to
			
				$mail->setFrom($sendemail[0]->EMAIL, 'Admin Hostel IIUI');
				$mail->addReplyTo('no-reply@iiu.edu.pk', 'Admin Hostel IIUI');
				$mail->addAddress($email);   // Add a recipient
				//$mail->addCC('cc@example.com');
				
				//$mail->addBCC('bcc@example.com');
				
				$mail->isHTML(true);  // Set email format to HTML
				
				$bodyContent = '<h3>Password Reset Succesfully.</h3><br>';
			  $bodyContent .= '<p style="font-size:14px">Request for Password Reset Succesfully done.<br><strong>Note: </strong>Login with this email (<b>'.$email.'</b>) and your new password is <b>'.$password.'</b> for IIUI Hostels web portal. Kindly visit on <b> http://usis.iiu.edu.pk:64453/login</b> for login to account. Reset your password after login immediately to avoid any issue.<br><br>If you have any query regarding login Email us at:<strong>'. $sendemail[0]->EMAIL.'</strong>. We will reply you as soon as possible. </p>
				<br/>
				<h3>Best Regards</h3>
				<h4">Provost Hostels (IIUI)</h4>
				<br/>
				<br/>
				<div style="font-size:smaller;background-color: #3c763d;color: #fff;">This communication contains information that is for the exclusive use of the intended recipient(s). If you are not the intended recipient, disclosure, copying, distribution or other use of, or taking of any action in reliance upon, this communication or the information in it is prohibited and may be unlawful. If you have received this communication in error please notify the sender by return email, delete it from your system and destroy any copies.</div>
				';
		       
			   $mail->Subject = 'Email from IIUI Hostel Provost Reset Password';
				$mail->Body    = $bodyContent;
				
		
				if(!$mail->send()) {
					
					$msg = 'Mailer Error: ' . $mail->ErrorInfo;
					$msg = 'Message could not be sent.';
					
				} else {
					echo  $mail->ErrorInfo;//$msg = 'Message has been sent';
				}
				
				/* Mail function End */
				}
				else
				     $msg = 'Password does not reset due to server error try again!';
            }
            else
            {
                $msg =  "This email is not registered with us. Please Contact IIUI Hostel admin";
            }
			
			 if($msg == 'Message has been sent')
                {
                    $msg = 'Password reset successfully <br> Check! your Email for new password';
					$this->session->set_flashdata('success', $msg);
					
					redirect('/login');
                }
                else
                {
                    $msg = 'Password reset successfully <br> Check! your Email for new password';
					$this->session->set_flashdata('success', $msg);
					
					redirect('/login');
                }

             redirect('/login/forgotPassword');
        }
    }
	
	function resetEmailUser()
    {
        
        
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('regno','Regno','trim|required|xss_clean');
                
        if($this->form_validation->run() == FALSE)
        {
            $this->forgotemail();
        }
        else 
        {
           $email = $this->input->post('email');
		   $regno = $this->input->post('regno');
		   $userid = $this->input->post('userid');
		   $result = $this->login_model->checkEmailExist($email);
            
            if( $result == 0)
            {
                $data = array('email'=>$email, 'regno'=>$regno);
                $save = $this->login_model->resetEmailUsers($data, $userid);                
				if($save)
				{
				
                /* Mail function starts */
				 require 'PHPMailer/src/Exception.php';
                 require 'PHPMailer/src/PHPMailer.php';
                 require 'PHPMailer/src/SMTP.php';
                  require "PHPMailer/src/OAuth.php";
                  require "PHPMailer/src/POP3.php";

                   $mail = new PHPMailer\PHPMailer\PHPMailer();
               
                    $mail->isSMTP(); 
                    $mail->Host ='smtp.gmail.com';    
                    $mail->SMTPAuth = true;                            
                    $mail->Username = 'hostel@iiu.edu.pk';            
                    //$mail->Password = 'hostel@123'; 
                    $mail->Password = 'islamabad12'; 
			
				
				$bodyContent = '<h3>Email Reset Succesfully.</h3><br>';
			  $bodyContent .= '<p style="font-size:14px">Request for Email Reset Succesfully done.<br><strong>Note: </strong>Login with this email (<b>'.$email.'</b>) and your password is same as you kept, for IIUI Hostels web portal. Kindly visit on <b> http://usis.iiu.edu.pk:64453/login</b> for login to account. Reset your password after login immediately to avoid any issue.<br><br>If you have any query regarding login Email us at:<strong> hostel@iiu.edu.pk</strong>. We will reply you as soon as possible. </p>
				<br/>
				<h3>Best Regards</h3>
				<h4">Hostels (IIUI)</h4>
				<br/>
				<br/>
				<div style="font-size:smaller;background-color: #3c763d;color: #fff;">This communication contains information that is for the exclusive use of the intended recipient(s). If you are not the intended recipient, disclosure, copying, distribution or other use of, or taking of any action in reliance upon, this communication or the information in it is prohibited and may be unlawful. If you have received this communication in error please notify the sender by return email, delete it from your system and destroy any copies.</div>
				';
		       
				$mail->setFrom('hostel@iiu.edu.pk', 'Admin Hostel IIUI');
				$mail->addReplyTo('no-reply@iiu.edu.pk', 'Admin Hostel IIUI');
				$mail->addAddress($email);   // Add a recipient
				//$mail->addCC('hostel@iiu.edu.pk');
				//$mail->addBCC('bcc@example.com');
				
				$mail->isHTML(true);  // Set email format to HTML
				
				$mail->Subject = 'Email from IIUI Hostel Admin';
				$mail->Body    = $bodyContent;
		
				if(!$mail->send()) {
					
					$msg = 'Mailer Error: ' . $mail->ErrorInfo;
					$msg = 'Message could not be sent.';
				} else {
					echo $msg = 'Message has been sent';
				}
				
				/* Mail function End */
				}
				else
				     $msg = 'Error! password not reset. try again later';
            }
            else
            {
                $msg =  "This email is already registered with us.";
            }
			
			 if($msg == 'Message has been sent')
                {
                    $this->session->set_flashdata('success', 'Email reset successfully Check! your Email');
                }
                else
                {
                    $this->session->set_flashdata('error', $msg);
                }

            redirect('/login');
        }
    }

    // This function used to reset the password 
    function resetPasswordConfirmUser($activation_id, $email)
    {
        // Get email and activation code from URL values at index 3-4
        $email = urldecode($email);
        
        // Check activation id in database
        $is_correct = $this->login_model->checkActivationDetails($email, $activation_id);
        
        $data['email'] = $email;
        $data['activation_code'] = $activation_id;
        
        if ($is_correct == 1)
        {
            $this->load->view('newPassword', $data);
        }
        else
        {
            redirect('/login');
        }
    }
    
    // This function used to create new password
    function createPasswordUser()
    {
        $status = '';
        $message = '';
        $email = $this->input->post("email");
        $activation_id = $this->input->post("activation_code");        
        
        $this->form_validation->set_rules('password','Password','required|max_length[20]');
        $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->resetPasswordConfirmUser($activation_id, urlencode($email));
        }
        else
        {
            $password = $this->input->post('password');
            $cpassword = $this->input->post('cpassword');
            
            // Check activation id in database
            $is_correct = $this->login_model->checkActivationDetails($email, $activation_id);
            
            if($is_correct == 1)
            {                
                $this->login_model->createPasswordUser($email, $password);
                
                $status = 'success';
                $message = 'Password changed successfully';
            }
            else
            {
                $status = 'error';
                $message = 'Password changed failed';
            }
            
            setFlashData($status, $message);

            redirect("/login");
        }
    }


}

?>