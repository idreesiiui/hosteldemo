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
class Regbox extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
		$this->load->model('login_model');
		$this->load->model('Semester_model');
		$this->load->model('Signup_model');
	 }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
		
		
		//
		//$data['country'] = $this->Signup_model->getcountry();
		//$data['faculty'] = $this->Signup_model->getfaculty();
		//$data['department'] = $this->Signup_model->getdepartment();
		$data['semestercode'] = $this->Semester_model->getsemestercode();
		$semestercode = $data['semestercode'];
		
		if($semestercode[0]->IS_ACTIVE == 1)
		{
        	$this->load->view('regbox', $data, NULL);
		} else
		{  
			redirect('pageNotFound');
		}
    }
	
	public function feedback()
    {
		
		
        
		$this->form_validation->set_rules('feedbackName','Name','trim|required|xss_clean');
		$this->form_validation->set_rules('feedbackCNIC','CNIC','trim|required|xss_clean');
        $this->form_validation->set_rules('feedbackEmail','Email','trim|required|valid_email|xss_clean');
		
		if($this->form_validation->run() == FALSE)
        {
            redirect('/main');
        } else
		{
			$name = $this->input->post('feedbackName');
			$type = $this->input->post('type');
			$CNIC = $this->input->post('feedbackCNIC');
			$email = $this->input->post('feedbackEmail');
			$message = $this->input->post('feedbackMessage');
			
			$emailtype = 'Reset Email';
						
					$gender = 'Male';
			$sendemail = $this->login_model->getsendemail($gender, $emailtype); 
				/* Mail function starts */
					 require 'PHPMailer/src/Exception.php';
					 require 'PHPMailer/src/PHPMailer.php';
					 require 'PHPMailer/src/SMTP.php';
					 require "PHPMailer/src/OAuth.php";
					 require "PHPMailer/src/POP3.php";
	
					   $mail = new PHPMailer\PHPMailer\PHPMailer();
				   
						$mail->isSMTP(); 
						$mail->Host = 'smtp-relay.gmail.com';    
						$mail->SMTPAuth = true;                            
						$mail->Username = $sendemail[0]->EMAIL;            
						$mail->Password = $sendemail[0]->PASSWORD;
						$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
						$mail->Port = 587;  
				
					
					$bodyContent = '<h3>Message From User.</h3><br>';
					$bodyContent .= '<p style="font-size:14px">Name:'.$name .'</p><br>';
					$bodyContent .= '<p style="font-size:14px">CNIC / Reg. No:'.$CNIC .'</p><br>';
					$bodyContent .= '<p style="font-size:14px">Email:'.$email .'</p><br>';
					$bodyContent .= '<p style="font-size:14px">'.$message.'</p>
					<br/>
					<h3>Best Regards</h3>
					<h4">Hostels (IIUI)</h4>
					<br/>
					<br/>
					<div style="font-size:smaller;background-color: #3c763d;color: #fff;">This communication contains information that is for the exclusive use of the intended recipient(s). If you are not the intended recipient, disclosure, copying, distribution or other use of, or taking of any action in reliance upon, this communication or the information in it is prohibited and may be unlawful. If you have received this communication in error please notify the sender by return email, delete it from your system and destroy any copies.</div>
					';
				   
					$mail->setFrom('hostel@iiu.edu.com', 'Admin Hostel IIUI');
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
						$this->session->set_flashdata('error', $msg);
					} else {
						echo $msg = 'Message has been sent.';
						$this->session->set_flashdata('success', $msg);
					}
					if($type == 'female')
						redirect('/femalePage');
					elseif($type == 'male')
						redirect('/malePage');
					else
						redirect('/main');
					/* Mail function End */
				}
	}

	public function tutorials()
    {
		
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/include/footer');
		$this->load->view('frontend/videoPage',Null, NULL);
			
	}
	public function stepguideFP()
    {
		
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/include/footer');
		$this->load->view('frontend/stepguideFP',Null, NULL);
			
	}

	public function stepguideNA()
    {
		
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/include/footer');
		$this->load->view('frontend/stepguideNA',Null, NULL);
			
	}

	public function stepguideA()
    {
		
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/include/footer');
		$this->load->view('frontend/stepguideA',Null, NULL);
			
	}

	public function stepguideR()
    {
		
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/include/footer');
		$this->load->view('frontend/stepguideR',Null, NULL);
			
	}
	
	public function malemain()
    {
		
		$data['semestercode'] = $this->Semester_model->getsemestercodeMale();
		$semestercode = $data['semestercode'];
		$data['campus'] = 'Boys';
        //$this->load->view('malemain', $data, NULL);
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/include/footer');
		$this->load->view('frontend/malePage',$data, NULL);
			
	}

	public function maleCE()
    {
		
		$data['semestercode'] = $this->Semester_model->getsemestercodeMale();
		$semestercode = $data['semestercode'];
		$data['campus'] = 'Boys';
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/include/footer');
		$this->load->view('frontend/maleCE',$data, NULL);
			
	}

	public function maleGI()
    {
		
		$data['semestercode'] = $this->Semester_model->getsemestercodeMale();
		$semestercode = $data['semestercode'];
		$data['campus'] = 'Boys';
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/include/footer');
		$this->load->view('frontend/maleGI',$data, NULL);
			
	}

	public function maleCU()
    {
		
		$data['semestercode'] = $this->Semester_model->getsemestercodeMale();
		$semestercode = $data['semestercode'];
		$data['campus'] = 'Boys';
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/include/footer');
		$this->load->view('frontend/maleCU',$data, NULL);
			
	}

	public function maleLists()
    {
		
		$data['semestercode'] = $this->Semester_model->getsemestercodeMale();
		$semestercode = $data['semestercode'];
		$data['campus'] = 'Boys';
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/include/footer');
		$this->load->view('frontend/maleLists',$data, NULL);
			
	}

	public function maleNotifications()
    {
		
		$data['semestercode'] = $this->Semester_model->getsemestercodeMale();
		$data['maleNotification'] = $this->Semester_model->getMaleNotification();
		$semestercode = $data['semestercode'];
		$data['campus'] = 'Boys';
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/include/footer');
		$this->load->view('frontend/maleNotifications',$data, NULL);
			
	}
	
	public function maleForms()
    {
		
		$data['semestercode'] = $this->Semester_model->getsemestercodeMale();
		$semestercode = $data['semestercode'];
		$data['campus'] = 'Boys';
		$this->load->view('frontend/include/header');
		$this->load->view('frontend/include/footer');
		$this->load->view('frontend/maleForms',$data, NULL);
			
	}

	public function malecampus()
    {
		
		$semestercode = $this->Semester_model->getsemestercodeMale();
		$data['semestercode'] = $semestercode;
		if(!empty($semestercode[0]->IS_ACTIVE) && $semestercode[0]->IS_ACTIVE == 1 && $semestercode[0]->GENDER == 'Male')
		{
			
        	$this->load->view('maleregbox', $data, NULL);	
		}
		else
		{
			$data['campus'] = 'Boys';
			$this->load->view('regbox', $data, NULL);
		}
	}
	
	public function Mseatchange()
    {
		
		$semestercode = $this->Semester_model->getsemestercodeSeatMale();
		$data['semestercode'] = $semestercode;
		
		if(!empty($semestercode) && $semestercode[0]->SEATCHANGESTATUS == 1 && $semestercode[0]->GENDER == 'Male')
		{
        	$this->load->view('maleseatchange', $data, NULL);
		}
		else
		{
			$data['campus'] = 'Boys';
			$this->load->view('seatregbox', $data, NULL);
		}
	}
	
	public function femalecampus()
    {
		
		$semestercode = $this->Semester_model->getsemestercodeFemale();
		$data['semestercode'] = $semestercode;
		
		if(!empty($semestercode[0]->IS_ACTIVE) && $semestercode[0]->IS_ACTIVE == 1 && $semestercode[0]->GENDER == 'Female' && $semestercode[0]->APPSTATUS == 1)
		{
        	$this->load->view('femaleregbox', $data, NULL);
		}
		else if(!empty($semestercode[0]->IS_ACTIVE) && $semestercode[0]->IS_ACTIVE == 1 && $semestercode[0]->GENDER == 'Female' && $semestercode[0]->APPSTATUS == 2)
		{
        	$this->load->view('freallot', $data, NULL);
		}
		else
		{
			$data['campus'] = 'Girls';
			$this->load->view('regbox', $data, NULL);
		}
	}
		
	function getmalestudentdetails($regno = NULL)
	{	
		
		/*$gender = 'Male';
		$appstatus = $this->Signup_model->getsemesterStatus($gender);
		$applicationstatus = $appstatus->APPSTATUS;
		if($applicationstatus == 2)
		  {
			$this->session->set_flashdata('error', 'Sorry! Hostel Application is Closed Now');
            
			redirect('malePage');  
		  }*/
		  
		if(!empty($regno))
		{
		    $regno = base64_decode($regno);
		} else
		{
		     $regno = $this->input->post('regno');
		}
		if($regno != TRUE)
        {	
			$this->session->set_flashdata('error', 'Registration Number can not be empty!');
            
			redirect('malePage');
        } else
        {

			//var_dump($regno); exit();
			
			//$regno = trim($this->input->post('regno'));
			$programe = $this->input->post('programe');
			
			
			
			$stregexist = $this->Signup_model->checkreg($regno);
			
			$gender = ($stregexist[0]->GENDER);
	
			//$streg = $this->Signup_model->checkstdreg($regno);
		
				
			if($stregexist != true)
			{
				$this->session->set_flashdata('error', 'Invalid Registration Number!');
				redirect('malePage');
			}
			if($gender == 'M')
			{
				$gender = 'Male';
				$streg = $this->Signup_model->checkMstdreg($regno,$gender);
			}
			elseif($gender == 'F')
			{
				$gender = 'Female';
				$streg = $this->Signup_model->checkFstdreg($regno,$gender);
			}
			
		
			if($streg == true)
			{
				$trackerid = $streg[0]->STUDENTID;
				
				$this->session->set_flashdata('success', 'Hostel Application form already submitted against this registration Number with tracker Id ('.$trackerid.') please contact Hostel Admin');
				redirect('malePage');
			}
			
			$malestudent = $this->Signup_model->getstudentgenderbyMale($regno);
				
			if($malestudent != TRUE)
			{
				$this->session->set_flashdata('error', 'Male Students are Eligible to apply only!');
				redirect('malePage');
			}
				
			$batchcode = $this->Signup_model->getbatchcode($regno);

			// $ptitle = explode(" ", $batchcode[0]->PROGRAME);

			// if($ptitle[0] == 'Master'){
			// 	$progamm = 'MBA';
			// } else if($ptitle[0] == 'Bachelor'){
			// 	$progamm = 'BBA';
			// }

			// $progamm = $ptitle[0];	
			
			$protitle = $batchcode[0]->PROTITTLE;

			$findbatch = explode("/",$regno);			

			$btch = $findbatch[sizeof($findbatch) - 1];

			$batch = str_replace(' ', '', ($batchcode[0]->BATCHNAME) ?? $btch);
			

			$nationality = $batchcode[0]->NATIONALITY; 

			$country = $batchcode[0]->COUNTRY;
			
			$seminfo = $this->Signup_model->getsemestercode($gender);
			
			$semdetail = explode(',', $seminfo[0]->BATCHNAME);	

				//echo $protitle;	

//var_dump($semdetail); exit();
				
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
				$phd1 = ltrim($semdetail[16], $semdetail[16][0]);
				$phd2 = ltrim($semdetail[17], $semdetail[17][0]);
				$phd3 = ltrim($semdetail[18], $semdetail[18][0]);
				$phd4 = ltrim($semdetail[19], $semdetail[19][0]);
				$phd5 = ltrim($semdetail[20], $semdetail[20][0]);
				$phd6 = ltrim($semdetail[21], $semdetail[21][0]);
				
			}

				//echo $protitle;	

				//var_dump($semdetail);

				// var_dump($batch);

				//  echo "</br>==========bs==============</br>";

				//  echo $bs1 . '==' . $bs2. '==' . $bs3. '==' . $bs4. '==' . $bs5. '==' . $bs6. '==' . $bs7. '==' . $bs8;	
				// echo "</br>==========bs==============</br>";

				// echo "</br>===========ma=============</br>";

				// echo $ma1 . '==' . $ma2. '==' . $ma3. '==' . $ma4;	
				// echo "</br>===========ma=============</br>";

				// echo "</br>===========ms=============</br>";

				// echo $ms1 . '==' . $ms2. '==' . $ms3. '==' . $ms4;	
				// echo "</br>===========ms=============</br>";

				// echo "</br>===========phd=============</br>";

				// echo $phd1 . '==' . $phd2. '==' . $phd3. '==' . $phd4. '==' . $phd5. '==' . $phd6;	
				// echo "</br>============phd============</br>";

				//  var_dump(strpos($batch, $phd6));

				//  echo "</br>============phd============</br>";
				// var_dump($semdetail);

				// exit();
				
			if (($protitle == 'BS' || $protitle == 'LLB' || $protitle == 'BA') && (strpos($batch, $bs1) !== false || strpos($batch, $bs2) !== false || strpos($batch, $bs3) !== false  || strpos($batch, $bs4) !== false || strpos($batch, $bs5) !== false || strpos($batch, $bs6) !== false || strpos($batch, $bs7) !== false  || strpos($batch, $bs8) !== false )) 
			{
				$countbs = substr_count($seminfo[0]->BATCHNAME, 'B');

				//var_dump($semdetail);

				///exit();
				
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
						
						$semcode = strtoupper($seminfo[0]->SEMCODE);
						
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
								$data['err_message'] = 'Sorry! you can not apply for Hostel seat, due to Courses Credit hrs  requirnment. Minimum Credit hrs requirment is: <b>'.$courseba.'</b>. Contact department Cordinator for course joining before applying.......';
							}
									 
						}
								
								
								/* Check for Course Registration and Joining End*/
								
								
						$this->load->view('frontend/include/header');
						$this->load->view('frontend/include/footer');
						$this->load->view('frontend/appformmale',$data, NULL);
														
					}
					else
					{  
						
						$this->session->set_flashdata('error', 'Sorry! No New Hostel Allotment Registration Open');

						redirect('malePage');
					}
				}
				else
				{  
					$this->session->set_flashdata('error', 'Sorry! No New Hostel Allotment Registration Open');

					redirect('malePage');
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
							
						$semcode = strtoupper($seminfo[0]->SEMCODE);
							
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
							$data['studTotalCredit'] = $studTotalCredit; 
							$data['TotalCredit'] = $coursema;
								 
							if($studTotalCredit < $coursema)
							{ 
								$data['err_message'] = 'Sorry! you can not apply for Hostel seat, due to Courses Credit hrs  requirnment. Minimum Credit hrs requirment is: <b>'.$coursema.'</b>. Contact department Cordinator for course joining before applying..';
							}
								 
						}						
								/* Check for Course Registration and Joining End*/
							
							$this->load->view('frontend/include/header');
							$this->load->view('frontend/include/footer');
							$this->load->view('frontend/appformmale',$data, NULL);
					} else
					{  
						$this->session->set_flashdata('error', 'Sorry! No New Hostel Allotment Registration Open');
						redirect('malePage');
					}
				} else
					
				{  
					$this->session->set_flashdata('error', 'Sorry! No New Hostel Allotment Registration Open');
					redirect('malePage');
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
						
						$semcode = strtoupper($seminfo[0]->SEMCODE);
						
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
							
							$data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursems;
										 
						 	if($studTotalCredit < $coursems)
						 	{ 
								$data['err_message'] = 'Sorry! you can not apply for Hostel seat, due to Courses Credit hrs  requirnment. Minimum Credit hrs requirment is: <b>'.$coursems.'</b>. Contact department Cordinator for course joining before applying...';
							}
										 
						}
								
								
								/* Check for Course Registration and Joining End*/
									
						$this->load->view('frontend/include/header');
						$this->load->view('frontend/include/footer');
						$this->load->view('frontend/appformmale',$data, NULL);
					}
					else
					{  
					
						$this->session->set_flashdata('error', 'Sorry! No New Hostel Allotment Registration Open');
						redirect('malePage');
					}
				}
				else
				{  
					$this->session->set_flashdata('error', 'Sorry! No New Hostel Allotment Registration Open');
				
					redirect('malePage');
				}
								   
			}
				
			elseif(($protitle == 'PHD' || $protitle == 'PhD') && ((strpos($batch, $phd1) !== false || strpos($batch, $phd2) !== false || strpos($batch, $phd3) !== false || strpos($batch, $phd4) !== false || strpos($batch, $phd5) !== false || strpos($batch, $phd6) !== false)))
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
						
						$semcode = strtoupper($seminfo[0]->SEMCODE);
						
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
								$data['err_message'] = 'Sorry! you can not apply for Hostel seat, due to Courses Credit hrs  requirnment. Minimum Credit hrs requirment is: <b>'.$coursephd.'</b>. Contact department Cordinator for course joining before applying....';
							}
						 
					   	}
									
									
									/* Check for Course Registration and Joining End*/
									
						$this->load->view('frontend/include/header');
						$this->load->view('frontend/include/footer');
						$this->load->view('frontend/appformmale',$data, NULL);
					}
					else
					{  
									  
						$this->session->set_flashdata('error', 'Sorry! you do not meet the criteria. please check above mention criteria1');
						
						redirect('malePage');
					}
				}
				else
			   	{  
				  $this->session->set_flashdata('error', 'Sorry! you do not meet the criteria. please check above mention criteria2');
					redirect('malePage');
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
						
					$seminfo = $this->Signup_model->getsemestercode($gender);
					
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
							$data['err_message'] = 'Sorry! you can not apply for Hostel seat, due to Courses Credit hrs  requirnment. Minimum Credit hrs requirment for BS: <b>'.$coursebs.'</b>, MS:<b>'.$coursems.'.</b> Contact department Cordinator for course joining before applying.....';
						}
										 
					}
									
									
									/* Check for Course Registration and Joining End*/
								
					$this->load->view('frontend/include/header');
					$this->load->view('frontend/include/footer');
					$this->load->view('frontend/appformmale',$data, NULL);
				}
				else
				{  
					$this->session->set_flashdata('error', 'Sorry! you do not meet the criteria. please check above mention criteria3');

					redirect('malePage');
				}
			}
			else
		   	{  
		      	$this->session->set_flashdata('error', 'Sorry! you do not meet the criteria. please check above mention criteria4');

				redirect('malePage');
		   	}			
		}
    }
	// function getmalestudentdetails()
	// {	
		
	// 	/*$gender = 'Male';
	// 	$appstatus = $this->Signup_model->getsemesterStatus($gender);
	// 	$applicationstatus = $appstatus->APPSTATUS;
	// 	if($applicationstatus == 2)
	// 	  {
	// 		$this->session->set_flashdata('error', 'Sorry! Hostel Application is Closed Now');
            
	// 		redirect('malePage');  
	// 	  }*/
	// 	if($this->input->post('regno') != TRUE)
 //        {	
	// 		$this->session->set_flashdata('error', 'Registration Number can not be empty!');
            
	// 		redirect('malePage');
 //        }
 //        else
 //        {
	// 		$regno = trim($this->input->post('regno'));
	// 		$programe = $this->input->post('programe');
			
	// 		
			
	// 		$stregexist = $this->Signup_model->checkreg($regno);
			
	// 		$gender = $stregexist[0]->GENDER;
	
	// 	//$streg = $this->Signup_model->checkstdreg($regno);
		
				
	// 			if($stregexist != true)
	// 		{
	// 			$this->session->set_flashdata('error', 'Invalid Registration Number!');
	// 			redirect('malePage');
	// 		}
	// 		if($gender == 'M')
	// 		{
	// 			$gender = 'Male';
	// 			$streg = $this->Signup_model->checkMstdreg($regno,$gender);
	// 		}
	// 		elseif($gender == 'F')
	// 		{
	// 			$gender = 'Female';
	// 			$streg = $this->Signup_model->checkFstdreg($regno,$gender);
	// 		}
			
		
	// 		if($streg == true)
	// 		{
	// 			$trackerid = $streg[0]->STUDENTID;
				
	// 			$this->session->set_flashdata('success', 'Hostel Application form already submitted against this registration Number with tracker Id ('.$trackerid.') please contact Hostel Admin');
	// 			redirect('malePage');
	// 		}
			
	// 			$malestudent = $this->Signup_model->getstudentgenderbyMale($regno);
				
	// 			if($malestudent != TRUE)
	// 			{
	// 				$this->session->set_flashdata('error', 'Male Students are Eligible to apply only!');
	// 			redirect('malePage');
	// 			}
				
	// 			$batchcode = $this->Signup_model->getbatchcode($regno);
				
	// 			$protitle = $batchcode[0]->PROTITTLE; $batch = str_replace(' ', '', $batchcode[0]->BATCHNAME); $nationality = $batchcode[0]->NATIONALITY; $country = $batchcode[0]->COUNTRY;
				
	// 			$seminfo = $this->Signup_model->getsemestercode($gender);
				
	// 			$semdetail = explode(',', $seminfo[0]->BATCHNAME);				
				
	// 			if(strpos($protitle, 'BS') !== false || strpos($protitle, 'LLB') !== false || strpos($protitle, 'BA') !== false || strpos($protitle, 'MA') !== false || strpos($protitle, 'MSC') !== false || strpos($protitle, 'MS') !== false || strpos($protitle, 'PHD') !== false )
	// 			{
	// 			$bs1 = ltrim($semdetail[0], $semdetail[0][0]);
	// 			$bs2 = ltrim($semdetail[1], $semdetail[1][0]);
	// 			$bs3 = ltrim($semdetail[2], $semdetail[2][0]);
	// 			$bs4 = ltrim($semdetail[3], $semdetail[3][0]);
	// 			$bs5 = ltrim($semdetail[4], $semdetail[4][0]);
	// 			$bs6 = ltrim($semdetail[5], $semdetail[5][0]);
	// 			$bs7 = ltrim($semdetail[6], $semdetail[6][0]);
	// 			$bs8 = ltrim($semdetail[7], $semdetail[7][0]); 
	// 			$ma1 = substr($semdetail[8], 2);
	// 			$ma2 = substr($semdetail[9], 2);
	// 			$ma3 = substr($semdetail[10], 2);
	// 			$ma4 = substr($semdetail[11], 2);
	// 			$ms1 = ltrim($semdetail[12], $semdetail[12][0]);
	// 			$ms2 = ltrim($semdetail[13], $semdetail[13][0]);
	// 			$ms3 = ltrim($semdetail[14], $semdetail[14][0]);
	// 			$ms4 = ltrim($semdetail[15], $semdetail[15][0]);
	// 			$phd1 = ltrim($semdetail[16], $semdetail[16][0]);
	// 			$phd2 = ltrim($semdetail[17], $semdetail[17][0]);
	// 			$phd3 = ltrim($semdetail[18], $semdetail[18][0]);
	// 			$phd4 = ltrim($semdetail[19], $semdetail[19][0]);
	// 			$phd5 = ltrim($semdetail[20], $semdetail[20][0]);
	// 			$phd6 = ltrim($semdetail[21], $semdetail[21][0]);
				
	// 			}
				
	// 			if (($protitle == 'BS' || $protitle == 'LLB' || $protitle == 'BA') && (strpos($batch, $bs1) !== false || strpos($batch, $bs2) !== false || strpos($batch, $bs3) !== false  || strpos($batch, $bs4) !== false || strpos($batch, $bs5) !== false || strpos($batch, $bs6) !== false || strpos($batch, $bs7) !== false  || strpos($batch, $bs8) !== false )) 
	// 			{
	// 			    $countbs = substr_count($seminfo[0]->BATCHNAME, 'B');
				
	// 				if($countbs > 0)
	// 				  {
					
	// 					$data['StudentInfo'] = $this->Signup_model->getstudent($regno);
				
	// 					$data['semestercode'] = $this->Signup_model->getsemestercode($gender);
						
	// 					$data['studentpic'] = $this->Signup_model->getstudentpic($regno);
						
	// 					$semestercode = $data['semestercode'];
						
	// 						if($semestercode[0]->IS_ACTIVE == 1)
	// 						{
	// 							/* Check for Course Registration and Joining Start*/
								
	// 							$seminfo = $this->Signup_model->getsemestercode($gender);
								
	// 							$semcode = strtoupper($seminfo[0]->SEMCODE);
								
	// 							$courseInfo = $this->Signup_model->getCourseInfo($gender, $semcode);
								
	// 							foreach($courseInfo as $info)
	// 									{
	// 										$coursestatus  = $info->STATUS;
	// 										$coursestype  = $info->TYPE;
	// 										$courseba  = $info->BSPAK;
	// 										$coursesemcode  = $info->SEMCODE;										
	// 									}
										
	// 							if($coursestype == 'Allotment' && $coursestatus == 1)
	// 							   {
	// 								 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
									 
	// 								 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $courseba;
									 
	// 								 if($studTotalCredit < $courseba)
	// 								 	{ 
	// 										$data['err_message'] = 'Sorry! you can not apply for Hostel seat, due to Courses Credit hrs  requirnment. Minimum Credit hrs requirment is: <b>'.$courseba.'</b>. Contact department Cordinator for course joining before applying.';
	// 									}
									 
	// 							   }
								
								
	// 							/* Check for Course Registration and Joining End*/
								
								
	// 							$this->load->view('frontend/include/header');
	// 							$this->load->view('frontend/include/footer');
	// 							$this->load->view('frontend/appformmale',$data, NULL);
														
	// 						}
	// 						else
	// 						   {  
	// 								$this->session->set_flashdata('error', 'Sorry! No New Hostel Allotment Registration Open');
	// 								redirect('malePage');
	// 						   }
	// 			        }
	// 					else
	// 					   {  
	// 							$this->session->set_flashdata('error', 'Sorry! No New Hostel Allotment Registration Open');
	// 							redirect('malePage');
	// 					   }
						   
	// 	          }
		
		
					
	// 		elseif (($protitle == 'MA' || $protitle == 'MSC') && (strpos($batch, $ma1) !== false || strpos($batch, $ma2) !== false || strpos($batch, $ma3) !== false || strpos($batch, $ma4) !== false)) 
	// 			{ 
	// 				$countMa = substr_count($seminfo[0]->BATCHNAME, 'MA');
				
	// 				if($countMa > 0)
	// 				  {
						
	// 					$data['StudentInfo'] = $this->Signup_model->getstudent($regno);
				
	// 					$data['semestercode'] = $this->Signup_model->getsemestercode($gender);
						
	// 					$data['studentpic'] = $this->Signup_model->getstudentpic($regno);
						
	// 					$semestercode = $data['semestercode'];
						
	// 					if($semestercode[0]->IS_ACTIVE == 1)
	// 					{
							
	// 						/* Check for Course Registration and Joining Start*/
								
	// 							$seminfo = $this->Signup_model->getsemestercode($gender);
								
	// 							$semcode = strtoupper($seminfo[0]->SEMCODE);
								
	// 							$courseInfo = $this->Signup_model->getCourseInfo($gender, $semcode);
								
	// 							foreach($courseInfo as $info)
	// 									{
	// 										$coursestatus  = $info->STATUS;
	// 										$coursestype  = $info->TYPE;
	// 										$coursema  = $info->MAPAK;
	// 										$coursesemcode  = $info->SEMCODE;										
	// 									}
										
	// 							if($coursestype == 'Allotment' && $coursestatus == 1)
	// 							   {
	// 								 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
	// 								 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursema;
									 
	// 								 if($studTotalCredit < $coursema)
	// 								 	{ 
	// 										$data['err_message'] = 'Sorry! you can not apply for Hostel seat, due to Courses Credit hrs  requirnment. Minimum Credit hrs requirment is: <b>'.$coursema.'</b>. Contact department Cordinator for course joining before applying.';
	// 									}
									 
	// 							   }
								
								
	// 							/* Check for Course Registration and Joining End*/
							
	// 						$this->load->view('frontend/include/header');
	// 						$this->load->view('frontend/include/footer');
	// 						$this->load->view('frontend/appformmale',$data, NULL);
	// 					}
	// 					else
	// 					   {  
	// 							$this->session->set_flashdata('error', 'Sorry! No New Hostel Allotment Registration Open');
	// 							redirect('malePage');
	// 					   }
	// 				  }
	// 				  else
	// 					   {  
	// 							$this->session->set_flashdata('error', 'Sorry! No New Hostel Allotment Registration Open');
	// 							redirect('malePage');
	// 					   }
	// 			 }
					
	// 				elseif(($protitle == 'MS' || $protitle == 'LLM') && (strpos($batch, $ms1) !== false || strpos($batch, $ms2) !== false || strpos($batch, $ms3) !== false || strpos($batch, $ms4) !== false))
					
	// 				{
	// 					$countMs = substr_count($seminfo[0]->BATCHNAME, 'M');
				
	// 					if($countMs > 0)
	// 					  { 
						
	// 							$data['StudentInfo'] = $this->Signup_model->getstudent($regno);
				
	// 							$data['semestercode'] = $this->Signup_model->getsemestercode($gender);
						
	// 							$data['studentpic'] = $this->Signup_model->getstudentpic($regno);
								
	// 							$semestercode = $data['semestercode'];
								
	// 							if($semestercode[0]->IS_ACTIVE == 1)
	// 							{
	// 								/* Check for Course Registration and Joining Start*/
								
	// 							$seminfo = $this->Signup_model->getsemestercode($gender);
								
	// 							$semcode = strtoupper($seminfo[0]->SEMCODE);
								
	// 							$courseInfo = $this->Signup_model->getCourseInfo($gender, $semcode);
								
	// 							foreach($courseInfo as $info)
	// 									{
	// 										$coursestatus  = $info->STATUS;
	// 										$coursestype  = $info->TYPE;
	// 										$coursems  = $info->MSPAK;
	// 										$coursesemcode  = $info->SEMCODE;										
	// 									}
										
	// 							if($coursestype == 'Allotment' && $coursestatus == 1)
	// 							   {
	// 								 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
	// 								 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursems;
									 
	// 								 if($studTotalCredit < $coursems)
	// 								 	{ 
	// 										$data['err_message'] = 'Sorry! you can not apply for Hostel seat, due to Courses Credit hrs  requirnment. Minimum Credit hrs requirment is: <b>'.$coursems.'</b>. Contact department Cordinator for course joining before applying.';
	// 									}
									 
	// 							   }
								
								
	// 							/* Check for Course Registration and Joining End*/
									
	// 								$this->load->view('frontend/include/header');
	// 								$this->load->view('frontend/include/footer');
	// 								$this->load->view('frontend/appformmale',$data, NULL);
	// 							}
	// 							else
	// 							   {  
	// 									$this->session->set_flashdata('error', 'Sorry! No New Hostel Allotment Registration Open');
	// 									redirect('malePage');
	// 							   }
	// 					  }
	// 					  else
	// 							   {  
	// 									$this->session->set_flashdata('error', 'Sorry! No New Hostel Allotment Registration Open');
	// 									redirect('malePage');
	// 							   }
								   
	// 				}
				
	// 			elseif(($protitle == 'PHD' || $protitle == 'PhD') && ((strpos($batch, $phd1) !== false || strpos($batch, $phd2) !== false || strpos($batch, $phd3) !== false || strpos($batch, $phd4) !== false || strpos($batch, $phd5) !== false || strpos($batch, $phd6) !== false)))
	// 				{ 
						
	// 					$countP = substr_count($seminfo[0]->BATCHNAME, 'P');
					
	// 					if($countP > 0)
	// 					  { 
							
	// 						$data['StudentInfo'] = $this->Signup_model->getstudent($regno);
					
	// 						$data['semestercode'] = $this->Signup_model->getsemestercode($gender);
							
	// 						$data['studentpic'] = $this->Signup_model->getstudentpic($regno);
							
	// 						$semestercode = $data['semestercode'];
							
	// 						if($semestercode[0]->IS_ACTIVE == 1)
	// 						{
	// 							/* Check for Course Registration and Joining Start*/
								
	// 							$seminfo = $this->Signup_model->getsemestercode($gender);
								
	// 							$semcode = strtoupper($seminfo[0]->SEMCODE);
								
	// 							$courseInfo = $this->Signup_model->getCourseInfo($gender, $semcode);
								
	// 							foreach($courseInfo as $info)
	// 									{
	// 										$coursestatus  = $info->STATUS;
	// 										$coursestype  = $info->TYPE;
	// 										$coursephd  = $info->PHDPAK;
	// 										$coursesemcode  = $info->SEMCODE;										
	// 									}
										
	// 							if($coursestype == 'Allotment' && $coursestatus == 1)
	// 							   {
	// 								 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
	// 								 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursephd;
									 
	// 								 if($studTotalCredit < $coursephd)
	// 								 	{ 
	// 										$data['err_message'] = 'Sorry! you can not apply for Hostel seat, due to Courses Credit hrs  requirnment. Minimum Credit hrs requirment is: <b>'.$coursephd.'</b>. Contact department Cordinator for course joining before applying.';
	// 									}
									 
	// 							   }
								
								
	// 							/* Check for Course Registration and Joining End*/
								
	// 							$this->load->view('frontend/include/header');
	// 							$this->load->view('frontend/include/footer');
	// 							$this->load->view('frontend/appformmale',$data, NULL);
	// 						}
	// 						else
	// 						   {  
	// 							  $this->session->set_flashdata('error', 'Sorry! you do not meet the criteria. please check above mention criteria');
	// 								redirect('malePage');
	// 						   }
	// 				  }
	// 					  else
	// 						   {  
	// 							  $this->session->set_flashdata('error', 'Sorry! you do not meet the criteria. please check above mention criteria');
	// 								redirect('malePage');
	// 						   }
	// 				}
	// 				elseif($nationality != 'Pakistani') //|| $country != 'Pakistan' && $country != '')
					
	// 				{ 
	// 					$data['StudentInfo'] = $this->Signup_model->getstudent($regno);
				
	// 					$data['semestercode'] = $this->Signup_model->getsemestercode($gender);
						
	// 					$data['studentpic'] = $this->Signup_model->getstudentpic($regno);
						
	// 					$semestercode = $data['semestercode'];
						
	// 					if($semestercode[0]->IS_ACTIVE == 1)
	// 					{
							
	// 						/* Check for Course Registration and Joining Start*/
								
	// 							$seminfo = $this->Signup_model->getsemestercode($gender);
								
	// 							$semcode = strtoupper($seminfo[0]->SEMCODE);
								
	// 							$courseInfo = $this->Signup_model->getCourseInfo($gender, $semcode);
								
	// 							foreach($courseInfo as $info)
	// 									{
	// 										$coursestatus  = $info->STATUS;
	// 										$coursestype  = $info->TYPE;
	// 										$coursebs  = $info->BSFOREIGNER;
	// 										$coursema  = $info->MAFOREIGNER;
	// 										$coursems  = $info->MSFOREIGNER;
	// 										$coursephd  = $info->PHDFOREIGNER;
	// 										$coursesemcode  = $info->SEMCODE;										
	// 									}
										
	// 							if($coursestype == 'Allotment' && $coursestatus == 1)
	// 							   {
	// 								 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
	// 								 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursebs;
									 
	// 								 if($studTotalCredit < $coursebs && ($studTotalCredit < $coursema) && ($studTotalCredit < $coursems) && $studTotalCredit < $coursephd)
	// 								 	{ 
	// 										$data['err_message'] = 'Sorry! you can not apply for Hostel seat, due to Courses Credit hrs  requirnment. Minimum Credit hrs requirment for BS: <b>'.$coursebs.'</b>, MS:<b>'.$coursems.'.</b> Contact department Cordinator for course joining before applying.';
	// 									}
									 
	// 							   }
								
								
	// 							/* Check for Course Registration and Joining End*/
							
	// 						$this->load->view('frontend/include/header');
	// 						$this->load->view('frontend/include/footer');
	// 						$this->load->view('frontend/appformmale',$data, NULL);
	// 					}
	// 					else
	// 					   {  
	// 					      $this->session->set_flashdata('error', 'Sorry! you do not meet the criteria. please check above mention criteria');
	// 							redirect('malePage');
	// 					   }
	// 			    }
	// 				else
	// 					   {  
	// 					      $this->session->set_flashdata('error', 'Sorry! you do not meet the criteria. please check above mention criteria');
	// 							redirect('malePage');
	// 					   }
		
	// 	}
 //    }
	
	// function getmalestudentdetails()
	// {	
		
	// 	/*$gender = 'Male';
	// 	$appstatus = $this->Signup_model->getsemesterStatus($gender);
	// 	$applicationstatus = $appstatus->APPSTATUS;
	// 	if($applicationstatus == 2)
	// 	  {
	// 		$this->session->set_flashdata('error', 'Sorry! Hostel Application is Closed Now');
            
	// 		redirect('malePage');  
	// 	  }*/
	// 	if($this->input->post('regno') != TRUE)
 //        {	
	// 		$this->session->set_flashdata('error', 'Registration Number can not be empty!');
            
	// 		redirect('malePage');
 //        }
 //        else
 //        {
	// 		$regno = trim($this->input->post('regno'));
	// 		$programe = $this->input->post('programe');
			
	// 		
			
	// 		$stregexist = $this->Signup_model->checkreg($regno);
			
	// 		$gender = $stregexist[0]->GENDER;
	
	// 	//$streg = $this->Signup_model->checkstdreg($regno);
		
				
	// 			if($stregexist != true)
	// 		{
	// 			$this->session->set_flashdata('error', 'Invalid Registration Number!');
	// 			redirect('malePage');
	// 		}
	// 		if($gender == 'M')
	// 		{
	// 			$gender = 'Male';
	// 			$streg = $this->Signup_model->checkMstdreg($regno,$gender);
	// 		}
	// 		elseif($gender == 'F')
	// 		{
	// 			$gender = 'Female';
	// 			$streg = $this->Signup_model->checkFstdreg($regno,$gender);
	// 		}
			
		
	// 		if($streg == true)
	// 		{
	// 			$trackerid = $streg[0]->STUDENTID;
				
	// 			$this->session->set_flashdata('success', 'Hostel Application form already submitted against this registration Number with tracker Id ('.$trackerid.') please contact Hostel Admin');
	// 			redirect('malePage');
	// 		}
			
	// 			$malestudent = $this->Signup_model->getstudentgenderbyMale($regno);
				
	// 			if($malestudent != TRUE)
	// 			{
	// 				$this->session->set_flashdata('error', 'Male Students are Eligible to apply only!');
	// 			redirect('malePage');
	// 			}
				
	// 			$batchcode = $this->Signup_model->getbatchcode($regno);
				
	// 			$protitle = $batchcode[0]->PROTITTLE; $batch = str_replace(' ', '', $batchcode[0]->BATCHNAME); $nationality = $batchcode[0]->NATIONALITY; $country = $batchcode[0]->COUNTRY;
				
	// 			$seminfo = $this->Signup_model->getsemestercode($gender);
				
	// 			$semdetail = explode(',', $seminfo[0]->BATCHNAME);				
				
	// 			if(strpos($protitle, 'BS') !== false || strpos($protitle, 'LLB') !== false || strpos($protitle, 'BA') !== false || strpos($protitle, 'MA') !== false || strpos($protitle, 'MSC') !== false || strpos($protitle, 'MS') !== false || strpos($protitle, 'PHD') !== false )
	// 			{
	// 			$bs1 = ltrim($semdetail[0], $semdetail[0][0]);
	// 			$bs2 = ltrim($semdetail[1], $semdetail[1][0]);
	// 			$bs3 = ltrim($semdetail[2], $semdetail[2][0]);
	// 			$bs4 = ltrim($semdetail[3], $semdetail[3][0]);
	// 			$bs5 = ltrim($semdetail[4], $semdetail[4][0]);
	// 			$bs6 = ltrim($semdetail[5], $semdetail[5][0]);
	// 			$bs7 = ltrim($semdetail[6], $semdetail[6][0]);
	// 			$bs8 = ltrim($semdetail[7], $semdetail[7][0]); 
	// 			$ma1 = substr($semdetail[8], 2);
	// 			$ma2 = substr($semdetail[9], 2);
	// 			$ma3 = substr($semdetail[10], 2);
	// 			$ma4 = substr($semdetail[11], 2);
	// 			$ms1 = ltrim($semdetail[12], $semdetail[12][0]);
	// 			$ms2 = ltrim($semdetail[13], $semdetail[13][0]);
	// 			$ms3 = ltrim($semdetail[14], $semdetail[14][0]);
	// 			$ms4 = ltrim($semdetail[15], $semdetail[15][0]);
	// 			$phd1 = ltrim($semdetail[16], $semdetail[16][0]);
	// 			$phd2 = ltrim($semdetail[17], $semdetail[17][0]);
	// 			$phd3 = ltrim($semdetail[18], $semdetail[18][0]);
	// 			$phd4 = ltrim($semdetail[19], $semdetail[19][0]);
	// 			$phd5 = ltrim($semdetail[20], $semdetail[20][0]);
	// 			$phd6 = ltrim($semdetail[21], $semdetail[21][0]);
				
	// 			}
				
	// 			if (($protitle == 'BS' || $protitle == 'LLB' || $protitle == 'BA') && (strpos($batch, $bs1) !== false || strpos($batch, $bs2) !== false || strpos($batch, $bs3) !== false  || strpos($batch, $bs4) !== false || strpos($batch, $bs5) !== false || strpos($batch, $bs6) !== false || strpos($batch, $bs7) !== false  || strpos($batch, $bs8) !== false )) 
	// 			{
	// 			    $countbs = substr_count($seminfo[0]->BATCHNAME, 'B');
				
	// 				if($countbs > 0)
	// 				  {
					
	// 					$data['StudentInfo'] = $this->Signup_model->getstudent($regno);
				
	// 					$data['semestercode'] = $this->Signup_model->getsemestercode($gender);
						
	// 					$data['studentpic'] = $this->Signup_model->getstudentpic($regno);
						
	// 					$semestercode = $data['semestercode'];
						
	// 						if($semestercode[0]->IS_ACTIVE == 1)
	// 						{
	// 							/* Check for Course Registration and Joining Start*/
								
	// 							$seminfo = $this->Signup_model->getsemestercode($gender);
								
	// 							$semcode = strtoupper($seminfo[0]->SEMCODE);
								
	// 							$courseInfo = $this->Signup_model->getCourseInfo($gender, $semcode);
								
	// 							foreach($courseInfo as $info)
	// 									{
	// 										$coursestatus  = $info->STATUS;
	// 										$coursestype  = $info->TYPE;
	// 										$courseba  = $info->BSPAK;
	// 										$coursesemcode  = $info->SEMCODE;										
	// 									}
										
	// 							if($coursestype == 'Allotment' && $coursestatus == 1)
	// 							   {
	// 								 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
									 
	// 								 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $courseba;
									 
	// 								 if($studTotalCredit < $courseba)
	// 								 	{ 
	// 										$data['err_message'] = 'Sorry! you can not apply for Hostel seat, due to Courses Credit hrs  requirnment. Minimum Credit hrs requirment is: <b>'.$courseba.'</b>. Contact department Cordinator for course joining before applying.';
	// 									}
									 
	// 							   }
								
								
	// 							/* Check for Course Registration and Joining End*/
								
								
	// 							$this->load->view('frontend/include/header');
	// 							$this->load->view('frontend/include/footer');
	// 							$this->load->view('frontend/appformmale',$data, NULL);
														
	// 						}
	// 						else
	// 						   {  
	// 								$this->session->set_flashdata('error', 'Sorry! No New Hostel Allotment Registration Open');
	// 								redirect('malePage');
	// 						   }
	// 			        }
	// 					else
	// 					   {  
	// 							$this->session->set_flashdata('error', 'Sorry! No New Hostel Allotment Registration Open');
	// 							redirect('malePage');
	// 					   }
						   
	// 	          }
		
		
					
	// 		elseif (($protitle == 'MA' || $protitle == 'MSC') && (strpos($batch, $ma1) !== false || strpos($batch, $ma2) !== false || strpos($batch, $ma3) !== false || strpos($batch, $ma4) !== false)) 
	// 			{ 
	// 				$countMa = substr_count($seminfo[0]->BATCHNAME, 'MA');
				
	// 				if($countMa > 0)
	// 				  {
						
	// 					$data['StudentInfo'] = $this->Signup_model->getstudent($regno);
				
	// 					$data['semestercode'] = $this->Signup_model->getsemestercode($gender);
						
	// 					$data['studentpic'] = $this->Signup_model->getstudentpic($regno);
						
	// 					$semestercode = $data['semestercode'];
						
	// 					if($semestercode[0]->IS_ACTIVE == 1)
	// 					{
							
	// 						/* Check for Course Registration and Joining Start*/
								
	// 							$seminfo = $this->Signup_model->getsemestercode($gender);
								
	// 							$semcode = strtoupper($seminfo[0]->SEMCODE);
								
	// 							$courseInfo = $this->Signup_model->getCourseInfo($gender, $semcode);
								
	// 							foreach($courseInfo as $info)
	// 									{
	// 										$coursestatus  = $info->STATUS;
	// 										$coursestype  = $info->TYPE;
	// 										$coursema  = $info->MAPAK;
	// 										$coursesemcode  = $info->SEMCODE;										
	// 									}
										
	// 							if($coursestype == 'Allotment' && $coursestatus == 1)
	// 							   {
	// 								 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
	// 								 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursema;
									 
	// 								 if($studTotalCredit < $coursema)
	// 								 	{ 
	// 										$data['err_message'] = 'Sorry! you can not apply for Hostel seat, due to Courses Credit hrs  requirnment. Minimum Credit hrs requirment is: <b>'.$coursema.'</b>. Contact department Cordinator for course joining before applying.';
	// 									}
									 
	// 							   }
								
								
	// 							/* Check for Course Registration and Joining End*/
							
	// 						$this->load->view('frontend/include/header');
	// 						$this->load->view('frontend/include/footer');
	// 						$this->load->view('frontend/appformmale',$data, NULL);
	// 					}
	// 					else
	// 					   {  
	// 							$this->session->set_flashdata('error', 'Sorry! No New Hostel Allotment Registration Open');
	// 							redirect('malePage');
	// 					   }
	// 				  }
	// 				  else
	// 					   {  
	// 							$this->session->set_flashdata('error', 'Sorry! No New Hostel Allotment Registration Open');
	// 							redirect('malePage');
	// 					   }
	// 			 }
					
	// 				elseif(($protitle == 'MS' || $protitle == 'LLM') && (strpos($batch, $ms1) !== false || strpos($batch, $ms2) !== false || strpos($batch, $ms3) !== false || strpos($batch, $ms4) !== false))
					
	// 				{
	// 					$countMs = substr_count($seminfo[0]->BATCHNAME, 'M');
				
	// 					if($countMs > 0)
	// 					  { 
						
	// 							$data['StudentInfo'] = $this->Signup_model->getstudent($regno);
				
	// 							$data['semestercode'] = $this->Signup_model->getsemestercode($gender);
						
	// 							$data['studentpic'] = $this->Signup_model->getstudentpic($regno);
								
	// 							$semestercode = $data['semestercode'];
								
	// 							if($semestercode[0]->IS_ACTIVE == 1)
	// 							{
	// 								/* Check for Course Registration and Joining Start*/
								
	// 							$seminfo = $this->Signup_model->getsemestercode($gender);
								
	// 							$semcode = strtoupper($seminfo[0]->SEMCODE);
								
	// 							$courseInfo = $this->Signup_model->getCourseInfo($gender, $semcode);
								
	// 							foreach($courseInfo as $info)
	// 									{
	// 										$coursestatus  = $info->STATUS;
	// 										$coursestype  = $info->TYPE;
	// 										$coursems  = $info->MSPAK;
	// 										$coursesemcode  = $info->SEMCODE;										
	// 									}
										
	// 							if($coursestype == 'Allotment' && $coursestatus == 1)
	// 							   {
	// 								 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
	// 								 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursems;
									 
	// 								 if($studTotalCredit < $coursems)
	// 								 	{ 
	// 										$data['err_message'] = 'Sorry! you can not apply for Hostel seat, due to Courses Credit hrs  requirnment. Minimum Credit hrs requirment is: <b>'.$coursems.'</b>. Contact department Cordinator for course joining before applying.';
	// 									}
									 
	// 							   }
								
								
	// 							/* Check for Course Registration and Joining End*/
									
	// 								$this->load->view('frontend/include/header');
	// 								$this->load->view('frontend/include/footer');
	// 								$this->load->view('frontend/appformmale',$data, NULL);
	// 							}
	// 							else
	// 							   {  
	// 									$this->session->set_flashdata('error', 'Sorry! No New Hostel Allotment Registration Open');
	// 									redirect('malePage');
	// 							   }
	// 					  }
	// 					  else
	// 							   {  
	// 									$this->session->set_flashdata('error', 'Sorry! No New Hostel Allotment Registration Open');
	// 									redirect('malePage');
	// 							   }
								   
	// 				}
				
	// 			elseif(($protitle == 'PHD' || $protitle == 'PhD') && ((strpos($batch, $phd1) !== false || strpos($batch, $phd2) !== false || strpos($batch, $phd3) !== false || strpos($batch, $phd4) !== false || strpos($batch, $phd5) !== false || strpos($batch, $phd6) !== false)))
	// 				{ 
						
	// 					$countP = substr_count($seminfo[0]->BATCHNAME, 'P');
					
	// 					if($countP > 0)
	// 					  { 
							
	// 						$data['StudentInfo'] = $this->Signup_model->getstudent($regno);
					
	// 						$data['semestercode'] = $this->Signup_model->getsemestercode($gender);
							
	// 						$data['studentpic'] = $this->Signup_model->getstudentpic($regno);
							
	// 						$semestercode = $data['semestercode'];
							
	// 						if($semestercode[0]->IS_ACTIVE == 1)
	// 						{
	// 							/* Check for Course Registration and Joining Start*/
								
	// 							$seminfo = $this->Signup_model->getsemestercode($gender);
								
	// 							$semcode = strtoupper($seminfo[0]->SEMCODE);
								
	// 							$courseInfo = $this->Signup_model->getCourseInfo($gender, $semcode);
								
	// 							foreach($courseInfo as $info)
	// 									{
	// 										$coursestatus  = $info->STATUS;
	// 										$coursestype  = $info->TYPE;
	// 										$coursephd  = $info->PHDPAK;
	// 										$coursesemcode  = $info->SEMCODE;										
	// 									}
										
	// 							if($coursestype == 'Allotment' && $coursestatus == 1)
	// 							   {
	// 								 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
	// 								 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursephd;
									 
	// 								 if($studTotalCredit < $coursephd)
	// 								 	{ 
	// 										$data['err_message'] = 'Sorry! you can not apply for Hostel seat, due to Courses Credit hrs  requirnment. Minimum Credit hrs requirment is: <b>'.$coursephd.'</b>. Contact department Cordinator for course joining before applying.';
	// 									}
									 
	// 							   }
								
								
	// 							/* Check for Course Registration and Joining End*/
								
	// 							$this->load->view('frontend/include/header');
	// 							$this->load->view('frontend/include/footer');
	// 							$this->load->view('frontend/appformmale',$data, NULL);
	// 						}
	// 						else
	// 						   {  
	// 							  $this->session->set_flashdata('error', 'Sorry! you do not meet the criteria. please check above mention criteria');
	// 								redirect('malePage');
	// 						   }
	// 				  }
	// 					  else
	// 						   {  
	// 							  $this->session->set_flashdata('error', 'Sorry! you do not meet the criteria. please check above mention criteria');
	// 								redirect('malePage');
	// 						   }
	// 				}
	// 				elseif($nationality != 'Pakistani') //|| $country != 'Pakistan' && $country != '')
					
	// 				{ 
	// 					$data['StudentInfo'] = $this->Signup_model->getstudent($regno);
				
	// 					$data['semestercode'] = $this->Signup_model->getsemestercode($gender);
						
	// 					$data['studentpic'] = $this->Signup_model->getstudentpic($regno);
						
	// 					$semestercode = $data['semestercode'];
						
	// 					if($semestercode[0]->IS_ACTIVE == 1)
	// 					{
							
	// 						/* Check for Course Registration and Joining Start*/
								
	// 							$seminfo = $this->Signup_model->getsemestercode($gender);
								
	// 							$semcode = strtoupper($seminfo[0]->SEMCODE);
								
	// 							$courseInfo = $this->Signup_model->getCourseInfo($gender, $semcode);
								
	// 							foreach($courseInfo as $info)
	// 									{
	// 										$coursestatus  = $info->STATUS;
	// 										$coursestype  = $info->TYPE;
	// 										$coursebs  = $info->BSFOREIGNER;
	// 										$coursema  = $info->MAFOREIGNER;
	// 										$coursems  = $info->MSFOREIGNER;
	// 										$coursephd  = $info->PHDFOREIGNER;
	// 										$coursesemcode  = $info->SEMCODE;										
	// 									}
										
	// 							if($coursestype == 'Allotment' && $coursestatus == 1)
	// 							   {
	// 								 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
	// 								 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursebs;
									 
	// 								 if($studTotalCredit < $coursebs && ($studTotalCredit < $coursema) && ($studTotalCredit < $coursems) && $studTotalCredit < $coursephd)
	// 								 	{ 
	// 										$data['err_message'] = 'Sorry! you can not apply for Hostel seat, due to Courses Credit hrs  requirnment. Minimum Credit hrs requirment for BS: <b>'.$coursebs.'</b>, MS:<b>'.$coursems.'.</b> Contact department Cordinator for course joining before applying.';
	// 									}
									 
	// 							   }
								
								
	// 							/* Check for Course Registration and Joining End*/
							
	// 						$this->load->view('frontend/include/header');
	// 						$this->load->view('frontend/include/footer');
	// 						$this->load->view('frontend/appformmale',$data, NULL);
	// 					}
	// 					else
	// 					   {  
	// 					      $this->session->set_flashdata('error', 'Sorry! you do not meet the criteria. please check above mention criteria');
	// 							redirect('malePage');
	// 					   }
	// 			    }
	// 				else
	// 					   {  
	// 					      $this->session->set_flashdata('error', 'Sorry! you do not meet the criteria. please check above mention criteria');
	// 							redirect('malePage');
	// 					   }
		
	// 	}
 //    }

function getmalestudentSeatInter()
	{
		if($this->input->post('regno') != TRUE)
        {	$this->session->set_flashdata('error', 'Registration Number can not be empty!');
            redirect('regbox/Mseatchange');
        }
        else
        {
	    $regno = $this->input->post('regno');
		$programe = $this->input->post('programe');
		
		
		
		$stregexit = $this->Signup_model->checkmalereg($regno);
		
		$streg = $this->Signup_model->checkmalestdreg($regno);
			
				if($stregexit != true)
			{
				$this->session->set_flashdata('error', 'Invalid Registration Number!');
				redirect('regbox/Mseatchange');
			}
			
			$semster = $this->Signup_model->getsemestercodeseatchange();
			$semcode = $semster[0]->SEMCODE;
			$streg = $this->Signup_model->checkstdseatExist($regno,$semcode);
			//print_r($streg);exit();
			if($streg == true)
			{
				$trackerId = $streg[0]->MCHANGE_ID;
				$this->session->set_flashdata('success', 'Hostel Application form already submitted against this registration Number and your tracker Id ('.$trackerId.')');
				redirect('regbox/Mseatchange');
			}
			/*$batchname = $this->input->post('regn');
			$batch = substr($this->input->post('regn'), -2);
			$sereg = substr($regno,-2);
			if ($sereg > $batch)
			{
				$this->session->set_flashdata('error', 'Only '.$batchname.' and before Students are eligible to apply.');
				redirect('regbox/Mseatchange');
			}
			$breg = substr($regno, -3); //for getting BATCH YEAR LIKE (F16)
			$bregl = substr($breg, 1);
			//$bareg = substr($breg, 0, 1);  // Only getting F (First letter)
			$bnamefirst = substr($batchname, 0, 1); // for spring current semester stoping like (16)
			$bnamelast = substr($batchname, -2);
			$bname = $bnamefirst.$bnamelast;
			
			if($breg != $bname )
			{
				if($bnamelast <= $bregl)
				{
				$this->session->set_flashdata('error', 'Only '.$batchname.' and before Students are eligible to apply.');
				redirect('regbox/Mseatchange');
				}
			}
			$acadprog = $this->Signup_model->getstudent($regno);
			$acadprograme = $acadprog[0]->ACADPROGLEVEL;
			
			if ($acadprograme != $programe)
			{
				if($acadprograme != 'MSC')
				{
				$this->session->set_flashdata('error', 'Only '.$programe.' Students are eligible to apply.');
				redirect('regbox/Mseatchange');
				}
			}*/
				
				
				
				$data['StudentInfo'] = $this->Signup_model->getstudent($regno);
				
				$data['semestercode'] = $this->Semester_model->getsemestercodeSeatMale();
				
				$semestercode = $data['semestercode'];
				
				if($semestercode[0]->SEATCHANGESTATUS == 1)
				{
					$this->load->view('maleseatsignup', $data, NULL);
				}
				else
				   {  
						redirect('regbox/Mseatchange');
				   }
		
	}
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
		$this->form_validation->set_rules('regno','regno','trim|required|max_length[128]|xss_clean');
		$this->form_validation->set_rules('city','city','trim|required|max_length[128]|xss_clean');
		$this->form_validation->set_rules('dept','dept','trim|required|max_length[128]|xss_clean');
		//$this->form_validation->set_rules('faculty','faculty','trim|required|max_length[128]|xss_clean');
		$this->form_validation->set_rules('programe','programe','trim|required|max_length[128]|xss_clean');
		$this->form_validation->set_rules('fname','fname','trim|required|max_length[128]|xss_clean');
  		$this->form_validation->set_rules('fnumber','fnumber','required|min_length[11]|xss_clean');
		$this->form_validation->set_rules('dob','dob','trim|required|max_length[128]|xss_clean');
		$this->form_validation->set_rules('nationality','nationality','trim|required|max_length[128]|xss_clean');
		$this->form_validation->set_rules('cnic','cnic','trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('emargancycnic','visitor CNIC','trim|required|max_length[13]|xss_clean');
		//$this->form_validation->set_rules('cgpa','cgpa','trim|required|max_length[128]|xss_clean');
		$this->form_validation->set_rules('paddress','paddress','trim|required|max_length[128]|xss_clean');
		$this->form_validation->set_rules('district','district','trim|required|max_length[128]|xss_clean');
		$this->form_validation->set_rules('province','province','trim|required|max_length[128]|xss_clean');
		$this->form_validation->set_rules('emargancyname','emargancyname','trim|required|max_length[128]|xss_clean');
		$this->form_validation->set_rules('emargancynumber','emargancynumber','required|min_length[11]|xss_clean');
		$this->form_validation->set_rules('emergancyrelation','emergancyrelation','required|xss_clean');
        $this->form_validation->set_rules('snumber','snumber','required|min_length[11]|xss_clean');

        //var_dump($this->form_validation->run()); exit();

           
        if($this->form_validation->run() == FALSE)
        {
            $regno = $this->input->post('regno');
        var_dump(validation_errors()); exit();
				
			$this->session->set_flashdata('error', 'Please fill all required fields and update your Student Profile in Student Info (Al-Jamia) from Admission Section.');
			$encoderegno = base64_encode($regno);
			redirect('appformmale/'.$encoderegno);
				
        }
			$studTotalCredit = $this->input->post('studTotalCredit');
			
			$TotalCredit = $this->input->post('TotalCredit');
				
		if($studTotalCredit < $TotalCredit)
        {
            $regno = $this->input->post('regno');
				
			$data['err_message'] = 'Sorry! you can not apply for Hostel seat, due to Courses Credit hrs  requirnment. Minimum Credit hrs requirment is: <b>'.$coursema.'</b>. Contact department Cordinator for course joining before applying......';				
				
			$this->appformmale($regno);
        } 
        else
        {
				//pre('xx');
			date_default_timezone_set('Asia/Karachi');
		    $dateTime = date('Y-m-d H:i:s');
				
            $name = ucwords(strtolower($this->input->post('name')));
			$admissiondate = $this->input->post('admissiondate');
			$admsession = $this->input->post('admsession');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $gender = 'Male';
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
			//$street = $this->input->post('district');
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
			
			
			
			$stverfy = $this->Signup_model->MaleStregverifyByadmin($regno);
			
			if($stverfy == true)
			{
				$this->session->set_flashdata('success', 'Wow! Hostel seat already alloted. Do reallotment process from IIUI Hostel student portal');
				redirect('malePage');
			}
			
			$stverfy = $this->Signup_model->CheckBlacklist($regno);
			
			if($stverfy == true)
			{
				$this->session->set_flashdata('error', 'You are not eligiable to apply due to black list student.');
				redirect('malePage');
			}
			
			$stregexit = $this->Signup_model->student_maleexists($regno);
			
			$StudTrackerId = $this->Signup_model->GetTrackerIdByMaleRegno($regno);
			
			if($stregexit == true)
		    {
				$studId = $StudTrackerId[0]->STUDENTID;
				
				$this->session->set_flashdata('success', 'Application already submitted succesfully against given Reg No. & Your Tracker Id: ('.$studId.')');
				
				redirect('malePage');
		    }
			
			$emailexit = $this->Signup_model->email_exists($email, $gender);
			
			if($emailexit == true)
			{
				$this->session->set_flashdata('error', 'Sorry! Email already registered please enter different email');
				redirect('malePage');
				//redirect('maleapp/'.base64_encode($regno));
				
			} else
			{	
				
				// $coordinates1 = $this->get_coordinates1('ISLAMABAD', 'INTERNATIONAL ISLAMIC UNIVERSITY, ISLAMABAD');
				// $coordinates2 = $this->get_coordinates2($city, $province);
				// if ( !$coordinates1 || !$coordinates2 )
				// {
				// 	$this->session->set_flashdata('error', 'please Enter correct City, District and Province.');
				// 	redirect('malePage');
				// 	//$this->appformfemale($regno);
					
				// }
				// else
				// {
				// 	$dist = $this->GetDrivingDistance($coordinates1['lat'], $coordinates2['lat'], $coordinates1['long'], $coordinates2['long']);
				// 	//echo 'Distance: <b>'.$dist['distance'];
				// 	$distance = $dist['distance'];
				// 	$distance = substr($distance, 0, -2);
				
				// 	if(isset($distance[5]))
				// 	{
				// 	    $distance = $distance[0].$distance[3].$distance[4].$distance[5].$distance[6];
				// 	}
								
				// 	$distance = round(str_replace(',', '.', $distance));
					
				// 	$value = $this->Signup_model->GetSignupSetting();
				// 	$value = intval($value[0]->DISTANCE);
				// 	$distance = (int) filter_var($distance, FILTER_SANITIZE_NUMBER_INT);


				


					$distance = $this->Signup_model->checkDistance($paddress, $district, $city);
					
					if ($distance == false && $nationality == 'Pakistani')
					{ 
						 $this->session->set_flashdata('error', 'Oops! you are not eligiable to apply due to distance parameter..');
						 redirect('malePage');
					} else 
					{
					
						$emailexit = $this->Signup_model->email_exists($email, $gender);
					
						if($emailexit == true)
						{
							$this->session->set_flashdata('error', 'Sorry! Email already registered please enter different email .');
						    
							$this->session->set_flashdata('regno',$regno);
							
							redirect('maleapp');					
							
						}
								
				
		                $studentInfo = array(
		                	'STUDENTEMAIL' => $email, 
		                	'SEMESTERCODE' => $hostelregdate,
		                	'STADMISSION' => $admsession,
		                	'DISTANCE' => $distance, 
		                	'STUDENTPASSWORD' => $password, 
		                	'STUDENTNAME' => $name,
		                	'CGPA' => $cgpa, 
		                	'CITY' => $city, 
		                	'GENDER' =>  $gender,
		                	'REGNO' => $regno,
		                	'DEPARTMENTNAME' => $dept,
		                	'FACULTY' => $faculty,
		                	'PROGRAME' => $programe, 
		                	'BATCHNAME' => $batchname,
		                	'FATHERNAME' => $fname,
		                	'FATHERNUMBER' => $fnumber,
		                	'FATHEROCCUPATION' => $foccupation,
		                	'STUDENTDOB' => $dob,
		                	'NATIONALITY' => $nationality,
		                	'CNIC' => $cnic,
		                	'PERMANENT' => $paddress,
		                	'CADDRESS' => $caddress,
		                	'DISTRICT' => $district,
		                	'PROVINCE' => $province,
		                	'EPERSONNAME' => $emargancyname,
		                	'EPERSONNUMBER' => $emargancynumber,
		                	'VCNIC' => $emargancycnic,
		                	'RELATION' => $emergancyrelation,
		                	'STUDENTNUMBER' => $snumber, 
		                	'CREATEDDTM' => $createDtm,
		                	'STATUS' => 0, 
		                	'EMAILSTATUS' => 1, 
		                	'PROTITTLE' => $ptittle);

		                	
		                $result = $this->Signup_model->InsertSignupMale($studentInfo);
						
						$Id = $this->Signup_model->getLastInsertedMale();
						 
						foreach($Id->result_array() AS $row) 
						{
		                   $tokennumber = $row['ID'];
						}
				 
						$emailtype = 'New Application';
				
						$sendemail = $this->login_model->getsendemail($gender, $emailtype);
					
						/* Mail function starts */
				
						// require 'PHPMailer/src/Exception.php';
		                // require 'PHPMailer/src/PHPMailer.php';
		                // require 'PHPMailer/src/SMTP.php';
		                // require "PHPMailer/src/OAuth.php";
		                // require "PHPMailer/src/POP3.php";

	                	// $mail = new PHPMailer\PHPMailer\PHPMailer();
	               
	                  	// //$mail->SMTPDebug;
						// $mail->isSMTP(); 
	                    // $mail->Host = 'smtp-relay.gmail.com';    
	                    // $mail->SMTPAuth = true;                            
	                    // $mail->Username = $sendemail[0]->EMAIL;            
	                    // $mail->Password = $sendemail[0]->PASSWORD;
						// $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
						// $mail->Port = 587;                                  // TCP port to connect to
					
						// $mail->setFrom($sendemail[0]->EMAIL, 'Admin Hostel IIUI');
						// $mail->addReplyTo('no-reply@iiu.edu.pk', 'Admin Hostel IIUI');
						// $mail->addAddress($email);   // Add a recipient
						// //$mail->addCC('cc@example.com');
						// //$mail->addBCC('bcc@example.com');
					
						// $mail->isHTML(true);  // Set email format to HTML
						
						// $bodyContent = '<h4>IIUI Hostel Application Succesfully Received.</h4><h3>Regno: ('.$regno.').</h3>';
						// $bodyContent .= '<p>Your application for hostel in International Islamic University has been received and your tracker ID is: <b>'.$tokennumber.'</b> Your Email address '.$email.' and password is <b>'.$password.'</b> Keep this email with you for login to IIUI Hostel Portal <b> http://usis.iiu.edu.pk:64453/login</b>. Once your application is confirmed by Provost Office than you can login with this credentials.'.'</p>
						// <br/>
						// <h3>Best Regards</h3>
						// <h4">Hostel Admin</h4>
						// <p>http://www.iiu.edu.pk</p><br/>
						// <span style="font-size:smaller;background-color: #44C553;color: #fff;">This communication contains information that is for the exclusive use of the intended recipient(s). If you are not the intended recipient, disclosure, copying, distribution or other use of, or taking of any action in reliance upon, this communication or the information in it is prohibited and may be unlawful. If you have received this communication in error please notify the sender by return email, delete it from your system and destroy any copies.</span>
						// ';
					
						// $mail->Subject = 'Email from IIUI Hostel Admin';
						// $mail->Body    = $bodyContent;
					
						// if(!$mail->send())
						// {
						// 	echo 'Message could not be sent.';
						// 	echo 'Mailer Error: ' . $mail->ErrorInfo;
						// } else 
						// {
						// 	echo 'Message has been sent';
						// }
					/* Mail function End */				
			 		}
		   		//}
			}
                
			//if($result > 0 || $mail->send())
			if($result > 0)
            {
                $this->session->set_flashdata('success', 'Hostel application has been submitted Sucessfully. Please check your email for details and your tracker Id is '.'('.$tokennumber.')');
            } else
            {
                $this->session->set_flashdata('error', 'Hostel Application failed due to wrong information or you are not eligible to apply yet...');
            }
                
                redirect('malePage');
        }
    }
		 
	function maleapp($regno = NULL)
	{
						
		$regno = base64_decode($regno);
		
		$gender = 'Male';
		
		$this->session->set_flashdata('error', 'Sorry! Email already registered please enter different email .');
		
		
		
		$data['StudentInfo'] = $this->Signup_model->getstudent($regno);

		$data['semestercode'] = $this->Signup_model->getsemestercode($gender);
		
		$data['studentpic'] = $this->Signup_model->getstudentpic($regno);
		
		$semestercode = $data['semestercode'];
		
		if($semestercode[0]->IS_ACTIVE == 1)
		{
			$this->load->view('frontend/include/header');
			$this->load->view('frontend/include/footer');
			$this->load->view('frontend/appformmale',$data, NULL);
									
		} else
		{  
			redirect('malePage');
		}
						   
	}


	public function GetDrivingDistance($lat1, $lat2, $long1, $long2)
	{
		$url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving&language=pl-PL&key=AIzaSyDMrxISr31s5L_It3zSLNugBCdDqRkTsus";
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


	public function get_coordinates1($city, $province)
	{
		$address = urlencode($city.','.$province);
		$url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false&region=Pakistan&key=AIzaSyDMrxISr31s5L_It3zSLNugBCdDqRkTsus";
		
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

	public function get_coordinates2($city, $province)
	{
		$address = urlencode($city.','.$province);
		$url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false&region=Pakistan&key=AIzaSyDMrxISr31s5L_It3zSLNugBCdDqRkTsus";
		
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
}


?>