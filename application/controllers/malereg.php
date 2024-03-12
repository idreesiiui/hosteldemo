<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Login (LoginController)
 * Login class to control to authenticate user credentials and starts user's session.
 * @author : Muhammad Idrees 
 * @version : 2.0
 * @since : 17 November 2022
 */
class Malereg extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
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
		$faculty_id = $this->input->post('faculty');
		
		$department = $this->Signup_model->getdepartment($faculty_id);
		echo json_encode($department);
		
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
		
		
		
		$stregexist = $this->Signup_model->checkreg($regno);
		
		//$streg = $this->Signup_model->checkstdreg($regno);
		
				
				if($stregexist != true)
			{
				$this->session->set_flashdata('error', 'Invalid Registration Number!');
				redirect('regbox/femalecampus');
			}
			
			$streg = $this->Signup_model->checkstdreg($regno);
		
			if($streg == true)
			{
				$this->session->set_flashdata('error', 'Hostel Application form already submitted against this registration Number please contact Hostel Admin');
				redirect('regbox/femalecampus');
			}
			$batchname = $this->input->post('regn');
			$batch = substr($this->input->post('regn'), -2);
			$sereg = substr($regno,-2);
			if ($sereg > $batch)
			{
				$this->session->set_flashdata('error', 'Only '.$batchname.' Students are eligible to apply.');
				redirect('regbox/femalecampus');
			}
				$femalestudent = $this->Signup_model->getstudentgender($regno);
				
				if($femalestudent != TRUE)
				{
					$this->session->set_flashdata('error', 'Female Students are Eligible to apply only!');
				redirect('regbox/femalecampus');
				}
				
				$data['StudentInfo'] = $this->Signup_model->getstudent($regno);
				
				$data['semestercode'] = $this->Signup_model->getsemestercode();
				
				//$data['studentpic'] = $this->Signup_model->getstudentpic($regno);
				
				$semestercode = $data['semestercode'];
				
				if($semestercode[0]->IS_ACTIVE == 1)
				{
					$this->load->view('fsignup', $data, NULL);
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
	
	function addfeedback()
    {
		 
			$this->load->helper('date_helper');
            
            $this->form_validation->set_rules('name','Full Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|max_length[128]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
			$this->form_validation->set_rules('regno','regno','trim|required|max_length[128]|xss_clean');
			
			$this->form_validation->set_rules('nic','nic','trim|required|min_length[4]|xss_clean');
			
			$this->form_validation->set_rules('paddress','paddress','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('district','district','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('province','province','trim|required|max_length[128]|xss_clean');
			
            $this->form_validation->set_rules('snumber','snumber','required|min_length[11]|xss_clean');
         
			
            if($this->form_validation->run() == FALSE)
            {
               $this->session->set_flashdata('error', 'Please enter valid mobile number and CNIC number');
				 
				redirect('signup/getstudentform');
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
                $fname = $this->input->post('fname');
				$caddress = $this->input->post('caddress');
                $cnic = $this->input->post('nic');
                $paddress = $this->input->post('paddress');
				$street = $this->input->post('district');
                $province = $this->input->post('province');
				$city = $this->input->post('city');
				$fbackform = $this->input->post('fbackform');
				$degname= $this->input->post('degname');
				$snumber = $this->input->post('snumber');
                $hostelregdate = $this->input->post('hostelregdate');
				$createDtm = $dateTime;
			
			    
				
				$stregexit = $this->Signup_model->reg_exists($regno);
				
				if($stregexit == true)
					{
						$this->session->set_flashdata('error', 'your Registration number already existed in Database. Please enter registration number as mentioned on student card on pervious given form');
						redirect('signup/getstudentform');
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
					 redirect('signup/getstudentform');
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
					 $this->session->set_flashdata('error', 'Hostel Application failed you are not eligiable to apply');
					 redirect('signup/getstudentform');
				}
				else {
				
                $studentInfo = array('STUDENTEMAIL'=>$email, 'SEMESTERCODE'=>$hostelregdate,'DISTANCE'=>$distance,'FEEDBACKFORM'=>$fbackform, 'STUDENTPASSWORD'=>$password, 'STUDENTNAME'=>$name,'DEGREENAME'=>$degname, 'CITY'=>$city, 'GENDER'=> $gender,'REGNO'=>$regno,'DEPARTMENTNAME'=>$dept,'FACULTY'=>$faculty,'PROGRAME'=>$programe,'FATHERNAME'=>$fname,'CNIC'=>$cnic,'PERMANENT'=>$paddress,'DISTRICT'=>$street,'PROVINCE'=>$province,'CADDRESS'=>$caddress,'STUDENTNUMBER'=>$snumber, 'CREATEDDTM'=>$createDtm);
                
				//}
				
                
				
                $result = $this->Signup_model->InsertSignupForm($studentInfo);
				
				$this->session->set_flashdata('success', 'Hostel Application feed back sucessfully submited please contact to Hostel Administration');
			    
				redirect('signup/getstudentform');
			 }
		   }
		}
			
	 }
			
			
}
	
	
	function AddSignup()
    {     
            
			$this->load->helper('date_helper');
            
            $this->form_validation->set_rules('name','Full Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|max_length[128]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
			$this->form_validation->set_rules('regno','regno','trim|required|max_length[128]|xss_clean');
			
			$this->form_validation->set_rules('nic','nic','trim|required|min_length[4]|xss_clean');
			
			$this->form_validation->set_rules('paddress','paddress','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('district','district','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('province','province','trim|required|max_length[128]|xss_clean');
			
            $this->form_validation->set_rules('snumber','snumber','required|min_length[11]|xss_clean');
			
            if($this->form_validation->run() == FALSE)
            {
                //$this->index();
				$this->session->set_flashdata('error', 'Please enter valid mobile number and CNIC number');
				redirect('regbox');
            }
            else
            {
				
				date_default_timezone_set('Asia/Karachi');
			    $dateTime = date('Y-m-d H:i:s');
				
                $name = ucwords(strtolower($this->input->post('name')));
				$admissiondate = $this->input->post('admissiondate');
				$admsession = $this->input->post('admsession');
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $gender = $this->input->post('gender');
                $regno = $this->input->post('regno');
				$dept = $this->input->post('dept');
                $faculty = $this->input->post('faculty');
				$programe = $this->input->post('programe');
                $fname = $this->input->post('fname');
				$fnumber = $this->input->post('fnumber');
                $foccupation = $this->input->post('foccupation');
				$dob = $this->input->post('dob');
                $nationality = $this->input->post('nationality');
				$cnic = $this->input->post('nic');
                $paddress = $this->input->post('paddress');
				$street = $this->input->post('district');
                $province = $this->input->post('province');
				$city = $this->input->post('city');
				$cgpa = $this->input->post('cgpa');
				$emargancyname = $this->input->post('emargancyname');
                $emargancynumber = $this->input->post('emargancynumber');
				$snumber = $this->input->post('snumber');
                $refname = $this->input->post('refname');
				$hostelregdate = $this->input->post('hostelregdate');
				$refcontact = $this->input->post('refcontact');
                $refname2 = $this->input->post('refname2');
				$refcontact2 = $this->input->post('refcontact2');
				$createDtm = $dateTime;
				
				
				
				$stregexit = $this->Signup_model->student_exists($regno);
				
				if($stregexit == true)
			{
				$this->session->set_flashdata('error', 'Student already exist in Database!');
				redirect('regbox');
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
					 redirect('regbox');
					
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
					 $this->session->set_flashdata('error', 'Hostel Application failed you are not eligiable to apply');
					 redirect('regbox');
				}
				else {
								
				$programetittle = substr($programe, 0, 3);
				$programetittle = trim($programetittle);
				switch($programetittle){
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
				
                $studentInfo = array('STUDENTEMAIL'=>$email, 'SEMESTERCODE'=>$hostelregdate,'STADMISSION'=>$admsession,'DISTANCE'=>$distance, 'STUDENTPASSWORD'=>$password, 'STUDENTNAME'=>$name,'CGPA'=>$cgpa, 'CITY'=>$city, 'GENDER'=> $gender,'REGNO'=>$regno,'DEPARTMENTNAME'=>$dept,'FACULTY'=>$faculty,'PROGRAME'=>$programe,'FATHERNAME'=>$fname,'FATHERNUMBER'=>$fnumber,'FATHEROCCUPATION'=>$foccupation,'STUDENTDOB'=>$dob,'NATIONALITY'=>$nationality,'CNIC'=>$cnic,'PERMANENT'=>$paddress,'DISTRICT'=>$street,'PROVINCE'=>$province,'EPERSONNAME'=>$emargancyname,'EPERSONNUMBER'=>$emargancynumber,'STUDENTNUMBER'=>$snumber,'REF1NAME'=>$refname,'REF1NUMBER'=>$refcontact,'REF2NAME'=>$refname2, 'REF2NUMBER'=>$refcontact2, 'CREATEDDTM'=>$createDtm,'STATUS'=>0,'PROTITTLE'=>$ptittle);
                
				//}
				
                
				
                $result = $this->Signup_model->InsertSignup($studentInfo);
				
				$Id = $this->Signup_model->getLastInserted();
				 foreach($Id->result_array() AS $row) 
				 {
                   $tokennumber = $row['ID'];
				 }
				
				
				/* Mail function starts */
				
				require 'PHPMailer/PHPMailerAutoload.php';

				$mail = new PHPMailer;
				
				$mail->isSMTP();                                   // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                            // Enable SMTP authentication
				$mail->Username = 'hostel@iiu.edu.pk';             // SMTP username
				$mail->Password = 'islamabad12'; // SMTP password
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
                    $this->session->set_flashdata('success', 'Hostel application has been submitted Sucessfully. Please check your email for details and <br>your tracker Id is '.$tokennumber);
                }
                else
                {
                    $this->session->set_flashdata('error', 'Hostel Application failed due to wrong information or you are not eligible to apply yet.');
                }
                
                redirect('regbox');
            }
         }
    }


?>