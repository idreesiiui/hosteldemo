<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// ini_set('memory_limit', '-1');
// error_reporting(E_ALL);
/**
 * Class : Login (LoginController)
 * Login class to control to authenticate user credentials and starts user's session.
 * @author : Muhammad Idrees 
 * @version : 2.0
 * @since : 17 November 2022
 */
class Femalereg extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
	protected $gender = 'Female';
		
    public function __construct()
    {
        parent::__construct();
		$this->load->model('login_model');
		$this->load->model('Signup_model');
		$this->load->library('session');	
		$this->load->model('Semester_model');
		
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
		$data['semestercode'] = $this->Semester_model->getsemestercode($gender);
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
	
	public function femaleRC()
    {
		
		$data['semestercode'] = $this->Semester_model->getsemestercodeMale();
		$semestercode = $data['semestercode'];
		$data['campus'] = 'Girls';
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/include/footer');
		$this->load->view('frontend/femaleRC',$data, NULL);
			
	}

	public function femaleCU()
    {
		
		$data['semestercode'] = $this->Semester_model->getsemestercodeMale();
		$semestercode = $data['semestercode'];
		$data['campus'] = 'Girls';
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/include/footer');
		$this->load->view('frontend/femaleCU',$data, NULL);
			
	}

	public function femaleLists()
    {
		
		$data['semestercode'] = $this->Semester_model->getsemestercodeFemale();
		$data['femalelistInfo'] = $this->Semester_model->getFemaleList();
		$semestercode = $data['semestercode'];
		$data['campus'] = 'Girls';
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/include/footer');
		$this->load->view('frontend/femaleLists',$data, NULL);
			
	}

	public function femaleNotifications()
    {
		
		$data['semestercode'] = $this->Semester_model->getsemestercodeFemale();
		$data['femaleNotificationInfo'] = $this->Semester_model->getFemaleNotfication();
		$semestercode = $data['semestercode'];
		$data['campus'] = 'Girls';
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/include/footer');
		$this->load->view('frontend/femaleNotifications',$data, NULL);
			
	}

    public function femaleForms()
    {
		
		$data['semestercode'] = $this->Semester_model->getsemestercodeMale();
		$semestercode = $data['semestercode'];
		$data['campus'] = 'Girls';
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/include/footer');
		$this->load->view('frontend/femaleForms',$data, NULL);
			
	}

	public function femaleMFDR()
    {
		
		$data['semestercode'] = $this->Semester_model->getsemestercodeMale();
		$semestercode = $data['semestercode'];
		$data['campus'] = 'Girls';
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/include/footer');
		$this->load->view('frontend/femaleMFDR',$data, NULL);
			
	}
	public function femalemain()
    {
		
		$semestercode = $this->Semester_model->getsemestercodeFemale();
		$data['semestercode'] = $semestercode;
		$data['campus'] = 'Girls';
        //$this->load->view('malemain', $data, NULL);
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/include/footer');
		$this->load->view('frontend/femalePage',$data, NULL);
			
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
    
function appformfemale($regno = NULL)
	{
		
	   if($this->input->post('regno') != TRUE)
        {	
			$this->session->set_flashdata('error', 'Registration Number can not be empty!');
            
			redirect('femalePage');
        }
        else
        {
			$regno = ltrim($this->input->post('regno'));
			$programe = $this->input->post('programe');
			
			
			
			$stregexist = $this->Signup_model->checkreg($regno);
			
			$gender = $stregexist[0]->GENDER;
	
		//$streg = $this->Signup_model->checkstdreg($regno);

			$isInBlackList = $this->Signup_model->CheckBlacklist($regno);

			if($isInBlackList == true)
			{
				$this->session->set_flashdata('error', 'Sorry! You are not allowed to apply for hostel');
				redirect('femalePage');
			}
		
				
			if($stregexist != true)
			{
				$this->session->set_flashdata('error', 'Invalid Registration Number!');
				redirect('femalePage');
			}
			if($gender == 'F')
			{
				$gender = 'Female';
				$streg = $this->Signup_model->checkFstdreg($regno,$gender);
			}
			elseif($gender == 'M')
			{
				$gender = 'Male';
				$streg = $this->Signup_model->checkMstdreg($regno,$gender);
			}
			
		    $applystatus = $streg[0]->APPLYSTATUS;

			if($streg == true && $applystatus == 1)
			{
				$trackerid = $streg[0]->STUDENTID;
				
				$this->session->set_flashdata('success', 'Hostel Application form already submitted against this registration Number with tracker Id ('.$trackerid.') please contact Hostel Admin');
				redirect('femalePage');
			}
			
				$femalestudent = $this->Signup_model->getstudentgender($regno);
				
				if($femalestudent != TRUE)
				{
					$this->session->set_flashdata('error', 'Female Students are Eligible to apply only!');
				redirect('femalePage');
				}
				
				$batchcode = $this->Signup_model->getbatchcode($regno);
				
				$protitle = $batchcode[0]->PROTITTLE;

				//echo $protitle; exit(); 

				$batch = str_replace(' ', '', $batchcode[0]->BATCHNAME); 

				$nationality = $batchcode[0]->NATIONALITY; 

				$country = $batchcode[0]->COUNTRY;
				
				$seminfo = $this->Signup_model->getsemestercode($gender);
				
				$semdetail = explode(',', $seminfo[0]->BATCHNAME);				
				
				if(strpos($protitle, 'BS') !== false || strpos($protitle, 'LLB') !== false || strpos($protitle, 'BA') !== false || strpos($protitle, 'MA') !== false || strpos($protitle, 'MSC') !== false || strpos($protitle, 'MS') !== false || strpos($protitle, 'PHD') !== false )
				{
				$bs1 = ltrim($semdetail[0], $semdetail[0][0]);
				$bs2 = ltrim($semdetail[1], $semdetail[1][0]);
				$bs3 = ltrim($semdetail[2], $semdetail[2][0]);
				$bs4 = ltrim($semdetail[3], $semdetail[3][0]);
				$bs5 = ltrim($semdetail[4], $semdetail[4][0]);
				$bs6 = ltrim($semdetail[5], $semdetail[5][0]);
				$bs7 = ltrim($semdetail[6], $semdetail[6][0]);
				$bs8 = ltrim($semdetail[7], $semdetail[7][0]); 
				$ma1 = substr($semdetail[8], 2);
				$ma2 = substr($semdetail[9], 2);
				$ma3 = substr($semdetail[10], 2);
				$ma4 = substr($semdetail[11], 2);
				$ms1 = ltrim($semdetail[12], $semdetail[12][0]);
				$ms2 = ltrim($semdetail[13], $semdetail[13][0]);
				$ms3 = ltrim($semdetail[14], $semdetail[14][0]);
				$ms4 = ltrim($semdetail[15], $semdetail[15][0]);
				}
			
				if (($protitle == 'BSC' || $protitle == 'BS' || $protitle == 'LLB' || $protitle == 'BA') && (strpos($batch, $bs1) !== false || strpos($batch, $bs2) !== false || strpos($batch, $bs3) !== false  || strpos($batch, $bs4) !== false || strpos($batch, $bs5) !== false || strpos($batch, $bs6) !== false || strpos($batch, $bs7) !== false  || strpos($batch, $bs8) !== false )) 
				{	
				    $countbs = substr_count($seminfo[0]->BATCHNAME, 'B');
				
					if($countbs > 0)
					  {
					
						$data['StudentInfo'] = $this->Signup_model->getstudent($regno);
				
						$data['semestercode'] = $this->Signup_model->getsemestercode($gender);
						
						$data['studentpic'] = $this->Signup_model->getstudentpic($regno);
						
						$semestercode = $data['semestercode'];
						
							if($semestercode[0]->IS_ACTIVE == 1)
							{
								/* Check for Course Registration and Joining Start*/
								
								$seminfo = $this->Signup_model->getsemestercode($gender);
								
								$semcode = strtoupper($seminfo[0]->SEMESTEROPENREG);
								
								$courseInfo = $this->Signup_model->getCourseInfo($gender, $semcode);
								
								
								foreach($courseInfo as $info)
										{
											$coursestatus  = $info->STATUS;
											$coursestype  = $info->TYPE;
											$courseba  = $info->BSPAK;
											$coursesemcode  = $info->SEMCODE;										
										}
										
								if($coursestype == 'Allotment' && $coursestatus == 1)
								   {
									 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
									 
									 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $courseba;
									 
									 if($studTotalCredit < $courseba)
									 	{ 
											$data['err_message'] = 'Sorry! you can not apply for Hostel seat, due to Courses Credit hrs  requirnment. Minimum Credit Hrs requirment is: <b>'.$courseba.'</b>. Contact department Cordinator for course joining before applying..';
										}
									 
								   }
								
								
								/* Check for Course Registration and Joining End*/
								
								
								$this->load->view('frontend/include/header');
								$this->load->view('frontend/include/footer');
								$this->load->view('frontend/appformfemale',$data, NULL);
														
							}
							else
							   {  
									$this->session->set_flashdata('error', 'Sorry! No New Hostel Allotment Registration Open');
									redirect('femalePage');
							   }
				        }
						else
						   {  
								$this->session->set_flashdata('error', 'Sorry! No New Hostel Allotment Registration Open');
								redirect('femalePage');
						   }
						   
		          }
		
		
					
			elseif (($protitle == 'MA' || $protitle == 'MSC') && (strpos($batch, $ma1) !== false || strpos($batch, $ma2) !== false || strpos($batch, $ma3) !== false || strpos($batch, $ma4) !== false)) 
				{
					$countMa = substr_count($seminfo[0]->BATCHNAME, 'MA');
				
					if($countMa > 0)
					  {
						
						$data['StudentInfo'] = $this->Signup_model->getstudent($regno);
				
						$data['semestercode'] = $this->Signup_model->getsemestercode($gender);
						
						$data['studentpic'] = $this->Signup_model->getstudentpic($regno);
						
						$semestercode = $data['semestercode'];
						
						if($semestercode[0]->IS_ACTIVE == 1)
						{
							
							/* Check for Course Registration and Joining Start*/
								
								$seminfo = $this->Signup_model->getsemestercode($gender);
								
								$semcode = strtoupper($seminfo[0]->SEMESTEROPENREG);
								
								$courseInfo = $this->Signup_model->getCourseInfo($gender, $semcode);
								
								foreach($courseInfo as $info)
										{
											$coursestatus  = $info->STATUS;
											$coursestype  = $info->TYPE;
											$coursema  = $info->MAPAK;
											$coursesemcode  = $info->SEMCODE;										
										}
										
								if($coursestype == 'Allotment' && $coursestatus == 1)
								   {
									 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
									 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursema;
									 
									 if($studTotalCredit < $coursema)
									 	{ 
											$data['err_message'] = 'Sorry! You can nott apply for Hostel seat, due to Courses Credit Hours  requirnment. Minimum Credit Hrs requirment is: <b>'.$coursema.'</b>. Contact department Cordinator for course joining before applying...';
										}
									 
								   }
								
								
								/* Check for Course Registration and Joining End*/
							
							$this->load->view('frontend/include/header');
							$this->load->view('frontend/include/footer');
							$this->load->view('frontend/appformfemale',$data, NULL);
						}
						else
						   {  
								$this->session->set_flashdata('error', 'Sorry! No New Hostel Allotment Registration Open');
								redirect('femalePage');
						   }
					  }
					  else
						   {  
								$this->session->set_flashdata('error', 'Sorry! No New Hostel Allotment Registration Open');
								redirect('femalePage');
						   }
				 }
					
					elseif(($protitle == 'MS' || $protitle == 'LLM') && (strpos($batch, $ms1) !== false || strpos($batch, $ms2) !== false || strpos($batch, $ms3) !== false || strpos($batch, $ms4) !== false))
					
					{
						$countMs = substr_count($seminfo[0]->BATCHNAME, 'M');
				
						if($countMs > 0)
						  { 
						
								$data['StudentInfo'] = $this->Signup_model->getstudent($regno);
				
								$data['semestercode'] = $this->Signup_model->getsemestercode($gender);
						
								$data['studentpic'] = $this->Signup_model->getstudentpic($regno);
								
								$semestercode = $data['semestercode'];
								
								if($semestercode[0]->IS_ACTIVE == 1)
								{
									/* Check for Course Registration and Joining Start*/
								
								$seminfo = $this->Signup_model->getsemestercode($gender);
								
								$semcode = strtoupper($seminfo[0]->SEMESTEROPENREG);
								
								$courseInfo = $this->Signup_model->getCourseInfo($gender, $semcode);
								
								foreach($courseInfo as $info)
										{
											$coursestatus  = $info->STATUS;
											$coursestype  = $info->TYPE;
											$coursems  = $info->MSPAK;
											$coursesemcode  = $info->SEMCODE;										
										}
										
								if($coursestype == 'Allotment' && $coursestatus == 1)
							   {
								 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
								 $data['studTotalCredit'] = $studTotalCredit; 
								 $data['TotalCredit'] = $coursems;
								 
								 	if($studTotalCredit < $coursems)
								 	{ 
										$data['err_message'] = 'Sorry! you can not apply for Hostel seat, due to Courses Credit hrs  requirnment. Minimum Credit hrours requirment is: <b>'.$coursema.'</b>. Contact department Cordinator for course joining before applying.';
									}								 
							   }
								
								
								/* Check for Course Registration and Joining End*/
									
									$this->load->view('frontend/include/header');
									$this->load->view('frontend/include/footer');
									$this->load->view('frontend/appformfemale',$data, NULL);
								}
								else
								   {  
										$this->session->set_flashdata('error', 'Sorry! No New Hostel Allotment Registration Open');
										redirect('femalePage');
								   }
						  }
						  else
								   {  
										$this->session->set_flashdata('error', 'Sorry! No New Hostel Allotment Registration Open');
										redirect('femalePage');
								   }
								   
					}
				
				elseif($protitle == 'PHD')
					{ 
						
						$countP = substr_count($seminfo[0]->BATCHNAME, 'P');
					
						if($countP > 0)
						  { 
							
							$data['StudentInfo'] = $this->Signup_model->getstudent($regno);
					
							$data['semestercode'] = $this->Signup_model->getsemestercode($gender);
							
							$data['studentpic'] = $this->Signup_model->getstudentpic($regno);
							
							$semestercode = $data['semestercode'];
							
							if($semestercode[0]->IS_ACTIVE == 1)
							{
								/* Check for Course Registration and Joining Start*/
								
								$seminfo = $this->Signup_model->getsemestercode($gender);
								
								$semcode = strtoupper($seminfo[0]->SEMESTEROPENREG);
								
								$courseInfo = $this->Signup_model->getCourseInfo($gender, $semcode);
								
								foreach($courseInfo as $info)
										{
											$coursestatus  = $info->STATUS;
											$coursestype  = $info->TYPE;
											$coursephd  = $info->PHDPAK;
											$coursesemcode  = $info->SEMCODE;										
										}
										
								if($coursestype == 'Allotment' && $coursestatus == 1)
								   {
									 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
									 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursephd;
									 
									 if($studTotalCredit < $coursephd)
									 	{ 
											$data['err_message'] = 'Sorry! you can not apply for Hostel seat, due to Courses Credit hours  requirnment. Minimum Credit hrs requirment is: <b>'.$coursephd.'</b>. Contact department Cordinator for course joining before applying....';
										}
									 
								   }
								
								
								/* Check for Course Registration and Joining End*/
								
								$this->load->view('frontend/include/header');
								$this->load->view('frontend/include/footer');
								$this->load->view('frontend/appformfemale',$data, NULL);
							}
							else
							   {  
								  $this->session->set_flashdata('error', 'Sorry! you do not meet the criteria. please check above mention criteria.');
									redirect('femalePage');
							   }
					  }
						  else
							   {  
								  $this->session->set_flashdata('error', 'Sorry! you do not meet the criteria. please check above mention criteria..');
									redirect('femalePage');
							   }
					}
					elseif($nationality != 'Pakistani') //|| $country != 'Pakistan' && $country != '')
					
					{ 
						$data['StudentInfo'] = $this->Signup_model->getstudent($regno);
				
						$data['semestercode'] = $this->Signup_model->getsemestercode($gender);
						
						$data['studentpic'] = $this->Signup_model->getstudentpic($regno);
						
						$semestercode = $data['semestercode'];
						
						if($semestercode[0]->IS_ACTIVE == 1)
						{
							
							/* Check for Course Registration and Joining Start*/
								
								/*$seminfo = $this->Signup_model->getsemestercode($gender);
								
								$semcode = strtoupper($seminfo[0]->SEMCODE);
								
								$courseInfo = $this->Signup_model->getCourseInfo($gender, $semcode);
								
								foreach($courseInfo as $info)
										{
											$coursestatus  = $info->STATUS;
											$coursestype  = $info->TYPE;
											$coursebs  = $info->BSFOREIGNER;
											$coursema  = $info->MAFOREIGNER;
											$coursems  = $info->MSFOREIGNER;
											$coursephd  = $info->PHDFOREIGNER;
											$coursesemcode  = $info->SEMCODE;										
										}
										
								if($coursestype == 'Allotment' && $coursestatus == 1)
								   {
									 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
									 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursebs;
									 
									 if($studTotalCredit < $coursebs && ($studTotalCredit < $coursema) && ($studTotalCredit < $coursems) && $studTotalCredit < $coursephd)
									 	{ 
											$data['err_message'] = 'Sorry! you can not apply for Hostel seat, due to Courses Credit hrs  requirnment. Minimum Credit hrs requirment for BS: <b>'.$coursebs.'</b>, MS:<b>'.$coursems.'.</b> Contact department Cordinator for course joining before applying.';
										}
									 
								   }*/
								
								
								/* Check for Course Registration and Joining End*/
							
							$this->load->view('frontend/include/header');
							$this->load->view('frontend/include/footer');
							$this->load->view('frontend/appformfemale',$data, NULL);
						}
						else
						   {  
						      $this->session->set_flashdata('error', 'Sorry! you do not meet the criteria. please check above mention criteria...');
								redirect('femalePage');
						   }
				    }
					else
						   {  
						      $this->session->set_flashdata('error', 'Sorry! you do not meet the criteria. please check above mention criteria....');
								redirect('femalePage');
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
		
	
	function AddSignup()
    {     
            
			$this->load->helper('date_helper');
            
            $this->form_validation->set_rules('name','Full Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|max_length[128]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
			$this->form_validation->set_rules('regno','regno','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('city','city','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('dept','dept','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('faculty','faculty','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('programe','programe','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('fname','fname','trim|required|max_length[128]|xss_clean');
  			$this->form_validation->set_rules('fnumber','fnumber','required|min_length[11]|xss_clean');
			$this->form_validation->set_rules('dob','dob','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('nationality','nationality','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('cnic','cnic','trim|required|min_length[4]|xss_clean');
			$this->form_validation->set_rules('emargancycnic','visitor CNIC','trim|required|max_length[13]|xss_clean');
			$this->form_validation->set_rules('cgpa','cgpa','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('paddress','paddress','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('district','district','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('province','province','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('emargancyname','emargancyname','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('emargancynumber','emargancynumber','required|min_length[11]|xss_clean');
			$this->form_validation->set_rules('emergancyrelation','emergancyrelation','required|xss_clean');
            $this->form_validation->set_rules('snumber','snumber','required|min_length[11]|xss_clean');
           
            if($this->form_validation->run() == FALSE)
            {
                $regno = $this->input->post('regno');
				
				$this->session->set_flashdata('error', 'Please fill all required fields');
				
				$this->appformfemale($regno);
            }
			$studTotalCredit = $this->input->post('studTotalCredit');
			
			$TotalCredit = $this->input->post('TotalCredit');
				
			if($studTotalCredit < $TotalCredit)
            {
                $regno = $this->input->post('regno');
				
				$data['err_message'] = 'Sorry! You can not apply for Hostel seat, due to Courses Credit hrs  requirnment. Minimum Credit Hrours requirment is: <b>'.$coursema.'</b>. Contact department Cordinator for course joining before applying.';
				
				$this->appformfemale($regno);
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
                $gender = 'Female';
                $regno = $this->input->post('regno');
				$dept = $this->input->post('dept');
                $faculty = $this->input->post('faculty');
				$programe = $this->input->post('programe');
				$batchname = $this->input->post('batchname');
				$ptittle = $this->input->post('protittle');
                $fname = $this->input->post('fname');
				$fnumber = $this->input->post('fnumber');
                $foccupation = $this->input->post('foccupation');
				$dob = $this->input->post('dob');
                $nationality = $this->input->post('nationality');
				$cnic = str_replace('-', '', $this->input->post('cnic'));
				$vcnic = str_replace('-', '', $this->input->post('vcnic'));
                $paddress = $this->input->post('paddress');
				$caddress = $this->input->post('caddress');
				$district = $this->input->post('district');
                $province = $this->input->post('province');
				$city = $this->input->post('city');
				$cgpa = $this->input->post('cgpa');
				$emargancyname = $this->input->post('emargancyname');
                $emargancynumber = str_replace('-', '', $this->input->post('emargancynumber'));
				$emargancycnic = str_replace('-', '', $this->input->post('emargancycnic'));
				$emergancyrelation = $this->input->post('emergancyrelation');
				$snumber = str_replace('-', '', $this->input->post('snumber'));
               // $refname = $this->input->post('refname');
				$hostelregdate = $this->input->post('hostelregdate');
				//$refcontact = $this->input->post('refcontact');
               // $refname2 = $this->input->post('refname2');
			//	$refcontact2 = $this->input->post('refcontact2');
				$createDtm = $dateTime;
				
				
				
				$stverfy = $this->Signup_model->StregverifyByadmin($regno);
				
				if($stverfy == true)
				{
					$this->session->set_flashdata('success', 'Wow! Hostel seat already alloted. Do reallotment process from IIUI Hostel student portal');
					redirect('femalePage');
				}
				
				$stverfy = $this->Signup_model->CheckBlacklist($regno);
				
				if($stverfy == true)
				{
					$this->session->set_flashdata('error', 'You are not eligiable to apply due to black list student.');
					redirect('femalePage');
				}
				
				$stregexit = $this->Signup_model->student_exists($regno);
				
				$StudTrackerId = $this->Signup_model->GetTrackerIdByRegno($regno);
				
				if($stregexit == true)
			    {
					$studId = $StudTrackerId[0]->STUDENTID;
					
					$this->session->set_flashdata('success', 'Application already submitted succesfully against given Reg No. & Your Tracker Id: ('.$studId.')');
					
					redirect('femalePage');
			    }
				
				$emailexit = $this->Signup_model->email_exists($email, $gender);
				
						if($emailexit == true)
							{
								$this->session->set_flashdata('error', 'Sorry! Email already registered please enter different email');
								
								redirect('femaleapp/'.base64_encode($regno));
								
							}
			else
			{
			
				// function get_coordinates1($city, $province)
				// {
				// $address = urlencode($city.','.$province);
				// 	$url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false&region=Pakistan&key=AIzaSyDMrxISr31s5L_It3zSLNugBCdDqRkTsus";
					
				// 	$ch = curl_init();
				// 	curl_setopt($ch, CURLOPT_URL, $url);
				// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				// 	curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
				// 	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				// 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				// 	$response = curl_exec($ch);
				// 	curl_close($ch);
				// 	$response_a = json_decode($response);
				// 	$status = $response_a->status;
				
				// 	if ( $status == 'ZERO_RESULTS' )
				// 	{
				// 		return FALSE;
				// 	}
				// 	else
				// 	{
				// 		$return = array('lat' => $response_a->results[0]->geometry->location->lat, 'long' => $long = $response_a->results[0]->geometry->location->lng);
				// 		return $return;
				// 	}
				// }
				
				// function get_coordinates2($city, $province)
				// {
				// $address = urlencode($city.','.$province);
				// 	$url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false&region=Pakistan&key=AIzaSyDMrxISr31s5L_It3zSLNugBCdDqRkTsus";
					
				// 	$ch = curl_init();
				// 	curl_setopt($ch, CURLOPT_URL, $url);
				// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				// 	curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
				// 	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				// 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				// 	$response = curl_exec($ch);
				// 	curl_close($ch);
				// 	$response_a = json_decode($response);
				// 	$status = $response_a->status;
				
				// 	if ( $status == 'ZERO_RESULTS' )
				// 	{
				// 		return FALSE;
				// 	}
				// 	else
				// 	{
				// 		$return = array('lat' => $response_a->results[0]->geometry->location->lat, 'long' => $long = $response_a->results[0]->geometry->location->lng);
				// 		return $return;
				// 	}
				// }
				
				
				// function GetDrivingDistance($lat1, $lat2, $long1, $long2)
				// {
				// 	$url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving&language=pl-PL&key=AIzaSyDMrxISr31s5L_It3zSLNugBCdDqRkTsus";
				// 	$ch = curl_init();
				// 	curl_setopt($ch, CURLOPT_URL, $url);
				// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				// 	curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
				// 	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				// 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				// 	$response = curl_exec($ch);
				// 	curl_close($ch);
				// 	$response_a = json_decode($response, true);
				// 	$dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
				// 	$time = $response_a['rows'][0]['elements'][0]['duration']['text'];
				
				// 	return array('distance' => $dist, 'time' => $time);
				// }

				// $coordinates1 = get_coordinates1('ISLAMABAD', 'INTERNATIONAL ISLAMIC UNIVERSITY', 'ISLAMABAD');
				// $coordinates2 = get_coordinates2($city, $province);
				// //print_r($coordinates2);exit();
				// if ( !$coordinates1 || !$coordinates2 )
				// {
				// 	$this->session->set_flashdata('error', 'please Enter correct City, District and Province.');
				// 	 $this->appformfemale($regno);
					
				// }
				// else
				// {
				// 	$dist = GetDrivingDistance($coordinates1['lat'], $coordinates2['lat'], $coordinates1['long'], $coordinates2['long']);
				// 	//echo 'Distance: <b>'.$dist['distance'];
				// $distance = $dist['distance'];
				// $distance = substr($distance, 0, -2);
				
				// if(isset($distance[5])){
				//     $distance = $distance[0].$distance[3].$distance[4].$distance[5].$distance[6];
				// }
								
				// $distance = round(str_replace(',', '.', $distance));
				
				// $value = $this->Signup_model->GetSignupSetting();
				// $value = intval($value[0]->DISTANCE);
				// $distance = (int) filter_var($distance, FILTER_SANITIZE_NUMBER_INT);


				$distance = $this->Signup_model->checkDistance($paddress, $district, $city);
			
				if ($distance == false && $nationality == 'Pakistani')
				
				{ 
					 $this->session->set_flashdata('error', 'Oops! you are not eligiable to apply due to distance parameter..');
					 redirect('femalePage');
				}
				else {
					
					$emailexit = $this->Signup_model->email_exists($email, $gender);
				
						if($emailexit == true)
							{
								$this->session->set_flashdata('error', 'Sorry! Email already registered please enter different email .');
							    
								$this->session->set_flashdata('regno',$regno);
								
								redirect('femaleapp');
								
								
							}
								
				
                $studentInfo = array('STUDENTEMAIL'=>$email, 'SEMESTERCODE'=>$hostelregdate,'STADMISSION'=>$admsession,'DISTANCE'=>$distance, 'STUDENTPASSWORD'=>$password, 'STUDENTNAME'=>$name,'CGPA'=>$cgpa, 'CITY'=>$city, 'GENDER'=> $gender,'REGNO'=>$regno,'DEPARTMENTNAME'=>$dept,'FACULTY'=>$faculty,'PROGRAME'=>$programe, 'BATCHNAME'=>$batchname,'FATHERNAME'=>$fname,'FATHERNUMBER'=>$fnumber,'FATHEROCCUPATION'=>$foccupation,'STUDENTDOB'=>$dob,'NATIONALITY'=>$nationality,'CNIC'=>$cnic,'PERMANENT'=>$paddress,'CADDRESS'=>$caddress,'DISTRICT'=>$district,'PROVINCE'=>$province,'EPERSONNAME'=>$emargancyname,'EPERSONNUMBER'=>$emargancynumber,'VCNIC'=>$emargancycnic,'RELATION'=>$emergancyrelation,'STUDENTNUMBER'=>$snumber, 'CREATEDDTM'=>$createDtm,'STATUS'=>0,'PROTITTLE'=>$ptittle);
                			
                
				
                $result = $this->Signup_model->InsertSignup($studentInfo);
				
				$Id = $this->Signup_model->getLastInserted();
				 foreach($Id->result_array() AS $row) 
				 {
                   $tokennumber = $row['ID'];
				 }
				 
				$emailtype = 'New Application';
			
				$sendemail = $this->login_model->getsendemail($gender, $emailtype);
				
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
					$mail->Port = 587;                                  // TCP port to connect to
				
				$mail->setFrom($sendemail[0]->EMAIL, 'Admin Hostel IIUI');
				$mail->addReplyTo('no-reply@iiu.edu.pk', 'Admin Hostel IIUI');
				$mail->addAddress($email);   // Add a recipient
				//$mail->addCC('cc@example.com');
				//$mail->addBCC('bcc@example.com');
				
				$mail->isHTML(true);  // Set email format to HTML
				
				$bodyContent = '<h4>IIUI Hostel Application Succesfully Received.</h4><h3>Regno: ('.$regno.').</h3>';
				$bodyContent .= '<p>Your application for hostel in International Islamic University has been received and your tracker ID is: <b>'.$tokennumber.'</b> Your Email address '.$email.' and password is <b>'.$password.'</b> Keep this email with you for login to IIUI Hostel Portal <b> http://usis.iiu.edu.pk:64453/login</b>. Once your application is confirmed by Provost Office than you can login with this credentials.'.'</p>
				<br/>
				<h3>Best Regards</h3>
				<h4">Hostel Admin</h4>
				<p>http://www.iiu.edu.pk</p><br/>
				<span style="font-size:smaller;background-color: #44C553;color: #fff;">This communication contains information that is for the exclusive use of the intended recipient(s). If you are not the intended recipient, disclosure, copying, distribution or other use of, or taking of any action in reliance upon, this communication or the information in it is prohibited and may be unlawful. If you have received this communication in error please notify the sender by return email, delete it from your system and destroy any copies.</span>
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
		   //}
		}
                
				if($result > 0 || $mail->send())
                {
                    $this->session->set_flashdata('success', 'Hostel application has been submitted Sucessfully. Please check your email for details and your tracker Id is '.'('.$tokennumber.')');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Hostel Application failed due to wrong information or you are not eligible to apply yet.');
                }
                
                redirect('femalePage');
            }
         }
		 
		 function femaleapp($regno = NULL){
						
						$regno = base64_decode($regno);
						
						$gender = 'Female';
						
						$this->session->set_flashdata('error', 'Sorry! Email already registered please enter different email .');
						
						
						
						$data['StudentInfo'] = $this->Signup_model->getstudent($regno);
				
						$data['semestercode'] = $this->Signup_model->getsemestercode($gender);
						
						$data['studentpic'] = $this->Signup_model->getstudentpic($regno);
						
						$semestercode = $data['semestercode'];
						
						if($semestercode[0]->IS_ACTIVE == 1)
						{
							$this->load->view('frontend/include/header');
							$this->load->view('frontend/include/footer');
							$this->load->view('frontend/appformfemale',$data, NULL);
													
						}
						else
						   {  
								redirect('femalePage');
						   }
						   
		 }
		 
    }


?>