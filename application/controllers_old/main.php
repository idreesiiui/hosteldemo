<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Login (LoginController)
 * Login class to control to authenticate user credentials and starts user's session.
 * @author : Muhammad Idrees 
 * @version : 2.0
 * @since : 17 November 2022
 */
class Main extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Signup_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
		
		$this->load->view('frontend/include/header');
        $this->load->view('frontend/mainPage', NULL, NULL);
		$this->load->view('frontend/include/footer');
		
    }
	
	function getdepartment()
	{
		
	    $faculty_id = $this->input->post('faculty',true);
		
		$department = $this->Signup_model->getdepartment($faculty_id);
		echo json_encode($department);
		
	}
    
	function getstudentdetails()
	{
		
	    $regno = $this->input->post('regno',true);
		
		$student = $this->Signup_model->getstudent($regno);
		echo json_encode($student);
		
	}
	function getregdetails()
	{
		
	    $regno = $this->input->post('regno',true);
		
		$student = $this->Signup_model->getstudent($regno);
		if($student[0]->REGNO == $regno)
		{
			$this->index();
		}
		exit();
				$mailexit = $this->user_model->mail_exists($email);
				if($mailexit == true)
                {
                    $this->session->set_flashdata('error', 'Email already exist');
					redirect('addNew');
				}
				else
			    {
				  $result = $this->user_model->addNewUser($userInfo);
			    }
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New User created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User creation failed');
                }
                
                redirect('addNew');
		
		
		$this->index();
		//echo json_encode($student);
		
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
	
	
	function addNewSignup()
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
			$this->form_validation->set_rules('fname','fname','trim|required|max_length[128]|xss_clean');
			//$this->form_validation->set_rules('fnumber','fnumber','required|min_length[10]|xss_clean');
			//$this->form_validation->set_rules('foccupation','foccupation','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('dob','dob','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('nationality','nationality','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('nic','nic','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('cgpa','cgpa','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('paddress','paddress','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('district','district','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('province','province','trim|required|max_length[128]|xss_clean');
			//$this->form_validation->set_rules('emargancyname','emargancyname','trim|required|max_length[128]|xss_clean');
			//$this->form_validation->set_rules('emargancynumber','emargancynumber','required|min_length[10]|xss_clean');
            $this->form_validation->set_rules('snumber','snumber','required|min_length[10]|xss_clean');
            //$this->form_validation->set_rules('refname','refname','trim|required|max_length[128]|xss_clean');
			//$this->form_validation->set_rules('refcontact','refcontact','required|min_length[10]|xss_clean');
			//$this->form_validation->set_rules('refname2','refname2','trim|required|max_length[128]|xss_clean');
			//$this->form_validation->set_rules('refcontact2','refcontact2','required|min_length[10]|xss_clean');
			
            if($this->form_validation->run() == FALSE)
            {
                $this->index();
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
					echo 'please Enter correct City, District and Province.';
				}
				else
				{
					$dist = GetDrivingDistance($coordinates1['lat'], $coordinates2['lat'], $coordinates1['long'], $coordinates2['long']);
					//echo 'Distance: <b>'.$dist['distance'];
				$distance = $dist['distance'];
				
				/*
				
				$value = $this->Signup_model->GetSignupSetting();
				
				$distance = explode(',',$distance);
				$value = $value[0]->DISTANCE;
				echo $value."<br>".$distance[0];
				if ($distance[0] <= $value)
				
				{
					echo "condition ture ";exit();
					 $this->session->set_flashdata('error', 'Hostel Application failed you are not eligiable to apply');
					 redirect('signup');
				}
				else {
				echo "condition false ";exit();*/
								
				$programetittle = substr($programe, 0, 3);
				if($programetittle == 'MS')
				$ptittle = 'MS/MPHILL';
				elseif($programetittle == 'LLM')
				$ptittle = 'MS/MPHILL';
				elseif($programetittle == 'PhD')
				$ptittle = 'PhD';
				else
				$ptittle = 'Bachelor';
				
                $studentInfo = array('STUDENTEMAIL'=>$email, 'SEMESTERCODE'=>$hostelregdate,'STADMISSION'=>$admsession,'DISTANCE'=>$distance, 'STUDENTPASSWORD'=>$password, 'STUDENTNAME'=>$name,'CGPA'=>$cgpa, 'CITY'=>$city, 'GENDER'=> $gender,'REGNO'=>$regno,'DEPARTMENTNAME'=>$dept,'FACULTY'=>$faculty,'PROGRAME'=>$programe,'FATHERNAME'=>$fname,'FATHERNUMBER'=>$fnumber,'FATHEROCCUPATION'=>$foccupation,'STUDENTDOB'=>$dob,'NATIONALITY'=>$nationality,'CNIC'=>$cnic,'PERMANENT'=>$paddress,'DISTRICT'=>$street,'PROVINCE'=>$province,'EPERSONNAME'=>$emargancyname,'EPERSONNUMBER'=>$emargancynumber,'STUDENTNUMBER'=>$snumber,'REF1NAME'=>$refname,'REF1NUMBER'=>$refcontact,'REF2NAME'=>$refname2, 'REF2NUMBER'=>$refcontact2, 'CREATEDDTM'=>$createDtm,'STATUS'=>0,'PROTITTLE'=>$ptittle);
                
				//}
				
                
				
                $result = $this->Signup_model->InsertSignup($studentInfo);
			 }
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Hostel Application Submitted Sucessfully please check your email');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Hostel Application failed due to wrong information or you are not eligible to apply yet.');
                }
                
                redirect('signup');
            }
         }
    }


?>