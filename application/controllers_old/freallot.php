<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Login (LoginController)
 * Login class to control to authenticate user credentials and starts user's session.
 * @author : Muhammad Idrees 
 * @version : 2.0
 * @since : 17 November 2022
 */
class Freallot extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
		$this->load->model('reallot_model');
		$this->load->model('Semester_model');
		$this->load->model('Signup_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
		$regno = $this->input->get('regno');
		if(isset($regno) && $regno!= '')
		{ 
		
		$data['StudentInfo'] = $this->Signup_model->getstudent($regno);
		//$data['faculty'] = $this->Signup_model->getfaculty();
		//$data['department'] = $this->Signup_model->getdepartment();
		$data['semestercode'] = $this->Semester_model->getsemestercode();
		$semestercode = $data['semestercode'];
		
		if($semestercode[0]->IS_ACTIVE == 1 && $semestercode[0]->GENDER == 'Male')
		{
        	$this->load->view('malesignup', $data, NULL);
		}
		else if($semestercode[0]->IS_ACTIVE == 1 && $semestercode[0]->GENDER == 'Female')
		{
        	$this->load->view('femalesignup', $data, NULL);
		}
		else
		   {  
		   		redirect('pageNotFound');
		   }
	}
	else
		{ redirect('regbox'); }
	
    }
	
	public function girlstudentform()
    {

		
		
		
	
		$data['semestercode'] = $this->Semester_model->getsemestercodeFemale();
		
		$data['StudentInfo'] = $this->Signup_model->GetAppId();
		
		$data['country'] = $this->Signup_model->getcountry();
		
		$data['faculty'] = $this->Signup_model->getfaculty();
		
		$semestercode = $data['semestercode'];
		
		if($semestercode[0]->IS_ACTIVE == 1)
		{
			$this->load->view('girlsnewenroll', $data, NULL);
		}
		else
		   {  
		   		redirect('main');
		   }
    }
	
	function getdepartment()
	{
		$facultyname = $this->input->post('faculty');
		
		$department = $this->Signup_model->getdepartment($facultyname);
		echo json_encode($department);
		
	}
	
	function VerifyUserRecord()
	{
			
        	
			$regno = $this->input->post('regno');
	
			$regno = $this->reallot_model->getstudent($regno);
			
			$regno = $regno[0]->REGNO;
			
			$result = $this->reallot_model->getstudentAcadInfo($regno);
		   
		    echo json_encode($result);   
    
	}
	
	public function reallotbyAdmin()
    {
	
		$this->load->view('freallotformbyAdmin', $data, NULL);
		
    }
    
	function getstudentdetails()
	{
		if($this->input->post('regno') != TRUE)
        {	$this->session->set_flashdata('error', 'Registration Number can not be empty!');
            redirect('regbox/femalecampus');
        }
        else
        {
	    $regno = $this->input->post('regno');
		$programe = $this->input->post('programe');
		
		$stregexist = $this->reallot_model->checkreg($regno);
		
		//$streg = $this->Signup_model->checkstdreg($regno);
		
				
				if($stregexist != true)
			{
				$this->session->set_flashdata('error', 'Invalid Registration Number!');
				redirect('regbox/femalecampus');
			}
			
			$streg = $this->reallot_model->checkstdreg($regno);
		
			if($streg == true)
			{
				$this->session->set_flashdata('success', 'Hostel Seat Re-Allotment already submitted against this registration Number please contact Hostel Admin for more Info!');
				redirect('regbox/femalecampus');
			}
			
				$femalestudent = $this->reallot_model->getstudentgender($regno);
				
				if($femalestudent != TRUE)
				{
					$this->session->set_flashdata('error', 'Female Students are Eligible to apply only!');
				redirect('regbox/femalecampus');
				}
				
				/*$fstudentcgpa = $this->reallot_model->getstudentAcadInfo($regno);
				
				$fstudentcgpa = number_format($fstudentcgpa[0]->CGPA, 1);
				
				if($fstudentcgpa <= 2.5)
				{
					$this->session->set_flashdata('error', 'Your CGPA is below than Crateria !');
				redirect('regbox/femalecampus');
				}*/
				
				$data['StudentInfo'] = $this->reallot_model->getstudent($regno);				
				$data['semestercode'] = $this->reallot_model->getsemestercode();
				
				$data['Studentacad'] = $this->reallot_model->getstudentAcadInfo($regno);
				
				//$data['studentpic'] = $this->Signup_model->getstudentpic($regno);
				
				$semestercode = $data['semestercode'];
				
				if($semestercode[0]->IS_ACTIVE == 1)
				{
					$this->load->view('freallotform', $data, NULL);
				}
				else
				   {  
						redirect('regbox/femalecampus');
				   }
		
	}
}
	
	
	
    /**
     * This function used to check the user is logged in or not
     */
    function isLoggedIn()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $this->load->view('login');
        }
        else
        {
            redirect('pageNotFound');
        }
    }
	
	function addNewreg()
    {
		 
			$this->load->helper('date_helper');
            
          $this->form_validation->set_rules('name','Full Name','trim|required|max_length[128]|xss_clean');
          $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|max_length[128]');
          $this->form_validation->set_rules('password','Password','required|max_length[20]');
          $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
          $this->form_validation->set_rules('gender','gender','trim|required|max_length[128]|xss_clean');
		  $this->form_validation->set_rules('formno','formno','trim|required|max_length[128]|xss_clean');
		  $this->form_validation->set_rules('dept','dept','trim|required|max_length[128]|xss_clean');
	      $this->form_validation->set_rules('faculty','faculty','trim|required|max_length[128]|xss_clean');
		  $this->form_validation->set_rules('programe','programe','trim|required|max_length[128]|xss_clean');
		  $this->form_validation->set_rules('fname','fname','trim|required|max_length[128]|xss_clean');
		  $this->form_validation->set_rules('fnumber','fnumber','required|min_length[11]|xss_clean');
		  $this->form_validation->set_rules('dob','dob','trim|required|max_length[128]|xss_clean');
		  $this->form_validation->set_rules('country','country','trim|required|max_length[128]|xss_clean');
		  $this->form_validation->set_rules('cnic','cnic','trim|required|min_length[4]|xss_clean');
		  $this->form_validation->set_rules('cgpa','cgpa','trim|required|max_length[128]|xss_clean');
		  $this->form_validation->set_rules('paddress','paddress','trim|required|max_length[128]|xss_clean');
		  $this->form_validation->set_rules('district','district','trim|required|max_length[128]|xss_clean');
		  $this->form_validation->set_rules('province','province','trim|required|max_length[128]|xss_clean');
		  $this->form_validation->set_rules('emargancyname','emargancyname','trim|required|max_length[128]|xss_clean');
		  $this->form_validation->set_rules('emargancynumber','emargancynumber','required|min_length[11]|xss_clean');
          $this->form_validation->set_rules('snumber','snumber','required|min_length[11]|xss_clean');

			
            if($this->form_validation->run() == FALSE)
            {
                //$this->index();
				$this->session->set_flashdata('error', 'Please fill all required fields');
				redirect('femalereg/girlstudentform');
            }
			
			else
            {
				
				date_default_timezone_set('Asia/Karachi');
			    $dateTime = date('Y-m-d H:i:s');
				
                $name = ucwords(strtolower($this->input->post('name')));
				$admissiondate = $this->input->post('admissiondate');
				$admsession = $this->input->post('admsession');
				$formno = $this->input->post('formno');
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $gender = $this->input->post('gender');
				$dept = $this->input->post('dept');
                $faculty = $this->input->post('faculty');
				$programe = $this->input->post('programe');
				$degtitle = $this->input->post('degtitle');
                $fname = $this->input->post('fname');
				$fnumber = $this->input->post('fnumber');
                $foccupation = $this->input->post('foccupation');
				$dob = $this->input->post('dob');
                $nationality = $this->input->post('country');
				$cnic = $this->input->post('cnic');
                $paddress = $this->input->post('paddress');
				$street = $this->input->post('district');
                $province = $this->input->post('province');
				$city = $this->input->post('city');
				$paddress = $this->input->post('paddress');
				$cgpa = $this->input->post('cgpa');
				$emargancyname = $this->input->post('emargancyname');
                $emargancynumber = $this->input->post('emargancynumber');
				$snumber = $this->input->post('snumber');
                $hostelregdate = $this->input->post('hostelregdate');
				//$cnicperson1 = $this->input->post('cnicperson1');
				//$cnicno1 = $this->input->post('cnicno1');
				//$cnicperson2 = $this->input->post('cnicperson2');
				//$cnicno2 = $this->input->post('cnicno2');
				$createDtm = $dateTime;
			
			    
				
				$stregexit = $this->Signup_model->reg_exists($name,$fname,$dob);
				
				if($stregexit == true)
					{
						$trackerId = $this->Signup_model->GetTrackerId($name,$fname,$dob);
						
						$this->session->set_flashdata('success', 'your Application form already Submitted and your tracker Id is :'.'('.$trackerId[0]->STUDENTID.')'.'already sent by email.');
						redirect('regbox/femalecampus');
					}
					
				else
			{
                
				function get_coordinates($city, $street, $province)
				{
					$address = urlencode($city.','.$street.','.$province);
					$url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=Pakistan";
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
					$response = curl_exec($ch);
					curl_close($ch);
					$response_a = json_decode($response);
					$status = $response_a->status;
				
					if ( $status == 'ZERO_RESULTS' )
					{
						return FALSE;
					}
					else
					{
						$return = array('lat' => $response_a->results[0]->geometry->location->lat, 'long' => $long = $response_a->results[0]->geometry->location->lng);
						return $return;
					}
				}
				
				
				function GetDrivingDistance($lat1, $lat2, $long1, $long2)
				{
					$url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving&language=pl-PL";
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
					$response = curl_exec($ch);
					curl_close($ch);
					$response_a = json_decode($response, true);
					$dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
					$time = $response_a['rows'][0]['elements'][0]['duration']['text'];
				
					return array('distance' => $dist, 'time' => $time);
				}

				
				
				
				$coordinates1 = get_coordinates('ISLAMABAD', 'INTERNATIONAL ISLAMIC UNIVERSITY', 'ISLAMABAD');
				$coordinates2 = get_coordinates($city, $street, $province);
				if ( !$coordinates1 || !$coordinates2 )
				{
					$this->session->set_flashdata('error', 'please Enter correct City, District and Province.');
					 redirect('femalereg/girlstudentform');
				}
				else
				{
					$dist = GetDrivingDistance($coordinates1['lat'], $coordinates2['lat'], $coordinates1['long'], $coordinates2['long']);
					//echo 'Distance: <b>'.$dist['distance'];
				$distance = $dist['distance'];
				$distance = substr($distance, 0, -2);
				$distance = str_replace(',', '.', $distance);
				
				$value = $this->Signup_model->GetSignupSetting();
				$value = intval($value[0]->DISTANCE);
				
				if ($distance <= $value)
				
				{
					 $this->session->set_flashdata('error', 'Oops! you are not eligiable to apply due to distance parameter');
					 redirect('regbox/femalecampus');
				}
				else {
				
				/*$this->load->library('upload');
                    
				if (!empty($_FILES['pic1']['name']) && isset($_FILES['pic1']['name']))
				{
				
				// Specify configuration for File 1
					$config['upload_path'] = 'uploads/profilepic/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size'] = '2048000';
					$config['max_width']  = '3000';
					$config['max_height']  = '2000';	  

					// Initialize config for File 1
					$this->upload->initialize($config);
					
					// Upload file 1
					if ($this->upload->do_upload('pic1'))
					{
						$data = $this->upload->data();
					}
					else
					{
						$error =  $this->upload->display_errors();
						$this->session->set_flashdata('error', $error);
						redirect('femalereg/girlstudentform');
					}
					
					$picname = $_FILES['pic1']['name'];
					
					$picpath = $config['upload_path'];
				}*/
				$programetittle = substr($programe, 0, 3);
				$programetittle = trim($programetittle);
				switch($programetittle)
				{
				case "MS":
					$ptittle = 'MS/MPHILL';
					break;
				
				case "LLM":
					$ptittle = 'MS/MPHILL';
					break;	
					
				case "PhD":
					$ptittle = 'PhD';
					break;
					
				default:
					$ptittle = 'Bachelor';
					break;
				}
				$this->load->library('upload');
                    
				/*if (!empty($_FILES['vcnic1']['name']) && isset($_FILES['vcnic1']['name']) && !empty($_FILES['vcnic2']['name']) && isset($_FILES['vcnic2']['name']) && !empty($_FILES['vcnic3']['name']) && isset($_FILES['vcnic3']['name']) && !empty($_FILES['vcnic4']['name']) && isset($_FILES['vcnic4']['name']))
				{
				
				// Specify configuration for File 1
					$config['upload_path'] = 'uploads/visitorcnic/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size'] = '2048000';
					$config['max_width']  = '3000';
					$config['max_height']  = '2000';	  

					// Initialize config for File 1
					$this->upload->initialize($config);
					
					// Upload file 1
					if ($this->upload->do_upload('vcnic1')&&$this->upload->do_upload('vcnic2')&&$this->upload->do_upload('vcnic3')&&$this->upload->do_upload('vcnic4'))
					{
						$data = $this->upload->data();
					}
					else
					{
						$error =  $this->upload->display_errors();
						$this->session->set_flashdata('error', $error);
						redirect('femalereg/girlstudentform');
					}
					
					$vcnic1 = $_FILES['vcnic1']['name'];
					
					$vcnicpath1 = $config['upload_path'];
					
					$vcnic2 = $_FILES['vcnic2']['name'];
					
					$vcnicpath2 = $config['upload_path'];
					
					$vcnic3 = $_FILES['vcnic3']['name'];
					
					$vcnicpath3 = $config['upload_path'];
					
					$vcnic4 = $_FILES['vcnic4']['name'];
					
					$vcnicpath4 = $config['upload_path'];
				}
				$cnicperson1 = $this->input->post('cnicperson1');
				$cnicno1 = $this->input->post('cnicno1');
				$cnicperson2 = $this->input->post('cnicperson2');
				$cnicno2 = $this->input->post('cnicno2');
				 
				 $visitorInfo = array('REGNO'=>$formno, 'STUDENTNAME'=>$name,'CNICPERSON1'=>$cnicperson1,'CNICNO1'=>$cnicno1,'CNICPERSON2'=>$cnicperson2, 'CNICNO2'=>$cnicno2, 'VCNIC1'=> $vcnic1, 'VCNICPATH1'=> $vcnicpath1,   'VCNIC2'=> $vcnic2, 'VCNICPATH2'=> $vcnicpath2,'VCNIC3'=> $vcnic3, 'VCNICPATH3'=> $vcnicpath3,  'VCNIC4'=> $vcnic4, 'VCNICPATH4'=> $vcnicpath4);
				
				$result = $this->Signup_model->InsertNewVisitorInfo($visitorInfo);
				*/
                $studentInfo = array('STUDENTEMAIL'=>$email, 'SEMESTERCODE'=>$hostelregdate,'STADMISSION'=>$admsession,'DISTANCE'=>$distance, 'STUDENTPASSWORD'=>$password,'STUDENTNAME'=>$name,'CGPA'=>$cgpa, 'CITY'=>$city, 'GENDER'=> $gender,'REGNO'=>$formno,'DEPARTMENTNAME'=>$dept,'FACULTY'=>$faculty,'PROGRAME'=>$degtitle,'FATHERNAME'=>$fname,'FATHERNUMBER'=>$fnumber,'FATHEROCCUPATION'=>$foccupation,'STUDENTDOB'=>$dob,'NATIONALITY'=>$nationality,'CNIC'=>$cnic,'PERMANENT'=>$paddress,'DISTRICT'=>$street,'PROVINCE'=>$province,'EPERSONNAME'=>$emargancyname,'EPERSONNUMBER'=>$emargancynumber,'STUDENTNUMBER'=>$snumber, 'CREATEDDTM'=>$createDtm,'STATUS'=>0,'PROTITTLE'=>$ptittle,'CARDPICNAME'=> $picname, 'CARDPICPATH'=> $picpath);
				
                $result = $this->Signup_model->InsertSignup($studentInfo);
				
				$Id = $this->Signup_model->getLastInserted();
				 foreach($Id->result_array() AS $row) 
				 {
                   echo $tokennumber = $row['ID'];
				 }
			
				
				/* Mail function starts */
				
				require 'PHPMailer/PHPMailerAutoload.php';

				$mail = new PHPMailer;
				
				$mail->isSMTP();                                   // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                            // Enable SMTP authentication
				$mail->Username = 'hostel@iiu.edu.pk';             // SMTP username
				$mail->Password = 'islamabad12'; // SMTP password
				//$mail->Password = 'hostel123'; // SMTP password
				$mail->SMTPSecure = 'ssl';                         // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 465;                                 // TCP port to connect to
				
				$mail->setFrom('hostel@iiu.edu.pk', 'Admin Hostel IIUI');
				$mail->addReplyTo('no-reply@iiu.edu.pk', 'Admin Hostel IIUI');
				$mail->addAddress($email);   // Add a recipient
				//$mail->addCC('cc@example.com');
				//$mail->addBCC('bcc@example.com');
				
				$mail->isHTML(true);  // Set email format to HTML
				
				$bodyContent = '<h3>IIUI Hostel Application Succesfully Received.</h3>';
				$bodyContent .= '<p>Your application for hostel in International Islamic University has been received and your tracker ID is: <b>'.$tokennumber.'</b></p>
				<br/>
				<h3>Best Regards</h3>
				<h4">Hostel Admin</h4>
				<p>http://www.iiu.edu.pk</p><br/>
				<span style="font-size:smaller;background-color: #3c763d;color: #fff;">This communication contains information that is for the exclusive use of the intended recipient(s). If you are not the intended recipient, disclosure, copying, distribution or other use of, or taking of any action in reliance upon, this communication or the information in it is prohibited and may be unlawful. If you have received this communication in error please notify the sender by return email, delete it from your system and destroy any copies.</span>
				';
				
				$mail->Subject = 'Email from IIUI Hostel Admin';
				$mail->Body    = $bodyContent;
				
				if(!$mail->send()) {
					echo 'Message could not be sent.';
					echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					echo 'Message has been sent';
				}
				/* Mail function End */
				
			 }
		   }
		}
                if($result > 0 || $mail->send())
                {
                    $this->session->set_flashdata('success', 'Hostel application has been submitted Sucessfully. Please check your email for details and your tracker Id is '.'('.$tokennumber.')');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Hostel Application failed due to wrong information or you are not eligible to apply yet.');
                }
                
                redirect('regbox/femalecampus');
						
			
	 }
			
			
}
	
	
	function AddSignup()
    {     
            
			$this->load->helper('date_helper');
            
            $this->form_validation->set_rules('name','Full Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|max_length[128]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
            $this->form_validation->set_rules('gender','gender','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('regno','regno','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('dept','dept','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('faculty','faculty','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('programe','programe','trim|required|max_length[128]|xss_clean');
			
            if($this->form_validation->run() == FALSE)
            {
                //$this->index();
				$this->session->set_flashdata('error', 'Please fill all required fields');
				redirect('regbox/femalecampus');
            }
            else
            {
				
				date_default_timezone_set('Asia/Karachi');
			    $dateTime = date('Y-m-d H:i:s');
				
                $name = ucwords(strtolower($this->input->post('name')));
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $gender = $this->input->post('gender');
                $regno = $this->input->post('regno');
				$dept = $this->input->post('dept');
                $faculty = $this->input->post('faculty');
				$programe = $this->input->post('programe');
                $createDtm = $dateTime;
				
				$this->load->library('upload');
                    
				if (!empty($_FILES['feeslip']['name']) && isset($_FILES['feeslip']['name']))
				{
				
				// Specify configuration for File 1
					$config['image_library'] = 'gd2';
					$config['upload_path'] = 'uploads/feeslip/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size'] = '32000';
					$config['max_width']  = '4500';
					$config['max_height']  = '4500';
						  

					// Initialize config for File 1
					$this->upload->initialize($config);
					
					$this->load->library('image_lib', $config);

				    $image = $this->image_lib->resize();
					
					// Upload file 1
					if ($this->upload->do_upload('feeslip'))
					{
						
					
						$data = $this->upload->data();
						
					}
					else
					{
						$error =  $this->upload->display_errors();
						$this->session->set_flashdata('error', $error);
						redirect('regbox/femalecampus');
					}
					
					$feeslip = $_FILES['feeslip']['name'];
					
					$feeslippath = $config['upload_path'];
				}
				
				$stverfy = $this->reallot_model->student_exists($regno);
				
				if($stverfy == true)
				{
					$this->session->set_flashdata('success', 'Wow! Re-Allotment Already done . Visit IIUI Online Hostel student portal for more Info !');
					redirect('regbox/femalecampus');
				}
			else
			{
				
				 $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'roleId'=>4, 'name'=> $name,'gender'=>$gender, 'createdDtm'=>$createDtm);
				 
                $result = $this->reallot_model->InsertAllotUser($userInfo);
				
				
                $AllotInfo = array('FEEPIC'=> $feeslip,'IS_SUBMIT'=> 1, 'FEEPATH'=> $feeslippath);
				
				$result = $this->reallot_model->UpdatetAllotUser($regno, $AllotInfo);
				
				/* Mail function starts */
				
				require 'PHPMailer/PHPMailerAutoload.php';

				$mail = new PHPMailer;
				
				$mail->isSMTP();                                   // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                            // Enable SMTP authentication
				$mail->Username = 'hostel@iiu.edu.pk';             // SMTP username
				$mail->Password = 'islamabad12'; // SMTP password
				//$mail->Password = 'hostel123'; // SMTP password
				$mail->SMTPSecure = 'ssl';                         // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 465;                                 // TCP port to connect to
				
				$mail->setFrom('hostel@iiu.edu.pk', 'Admin Hostel IIUI');
				$mail->addReplyTo('no-reply@iiu.edu.pk', 'Admin Hostel IIUI');
				$mail->addAddress($email);   // Add a recipient
				//$mail->addCC('cc@example.com');
				//$mail->addBCC('bcc@example.com');
				
				$mail->isHTML(true);  // Set email format to HTML
				
				$bodyContent = '<h3>IIUI Re Allotment Hostel Application Received Succesfully.</h3>';
				$bodyContent .= '<p>Your Re-Allotment application for hostel in International Islamic University has been received. Submit your Student Permission Form and Fee slip to the warden of your concern hostel block for verification till 29th September 2017.<br/><br/>Non submission of said documents till above mentioned date will lead to cancellation of seat.</p>
				<br/>
				<h3>Regards</h3>
				<h4"><b>Provost<br>Girls Hostels</b><br/></h4>
				<br/>
				<span style="font-size:smaller;background-color: #3c763d;color: #fff;">This communication contains information that is for the exclusive use of the intended recipient(s). If you are not the intended recipient, disclosure, copying, distribution or other use of, or taking of any action in reliance upon, this communication or the information in it is prohibited and may be unlawful. If you have received this communication in error please notify the sender by return email, delete it from your system and destroy any copies.</span>
				';
				
				$mail->Subject = 'Email from IIUI Hostel Admin';
				$mail->Body    = $bodyContent;
				
				if(!$mail->send()) {
					echo 'Message could not be sent.';
					echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					echo 'Message has been sent';
				}
				/* Mail function End */
				
			 }
		  }
		
                if($result > 0 || $mail->send())
                {
                    $this->session->set_flashdata('success', 'Hostel application has been submitted Sucessfully. Please check your email for details ');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Hostel Application failed due to wrong information or you are not eligible to apply yet.');
                }
                
                redirect('regbox/femalecampus');
        
       }
  }
?>