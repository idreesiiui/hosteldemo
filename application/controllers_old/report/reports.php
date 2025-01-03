<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// ini_set('memory_limit', '-1');
// error_reporting(E_ALL);


/**
 * Class : Reports (ReportsController)
 * Reports Class to control all user related operations.
 * @author : Muhammad Idrees 
 * @version : 2.0
 * @since : 17 November 2022
 */
class Reports extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
		$this->load->model('Semester_model');
		$this->load->model('report_model');
		$this->load->model('reallotment_model');
		$this->load->model('allotment_model');
		$this->load->model('hostel_model');
		$this->load->model('allotmenthistory_model');
		$this->load->model('remarks_model');
        $this->isLoggedIn();   
    }    
    
    public function index()
    {
        $this->global['pageTitle'] = 'IIUI Hostels : Dashboard';
        
        $this->loadViews("Reports/getreport", $this->global, NULL , NULL);
    }  

	

    function semsterWiseReport(){

    	$gender = $this->gender;

    	$data['semester'] = $this->Semester_model->semesterListing($gender);

    	$this->global['pageTitle'] = 'IIUI Hostels : Semester Wise Report';
        
        $this->loadViews("Reports/semesterWiseReport", $this->global, $data, NULL);

    } 

    function getHosteliedList(){

    	$this->global['pageTitle'] = 'IIUI Hostels : Semester Wise Report';

    	$allotment_type = $this->input->post('allotment_type');
			
		$semester = $this->input->post('semester');

		$gender = $this->gender;

		$data['studentInfo'] = $this->allotmenthistory_model->getAllotmentStudentData($allotment_type,$semester,$gender);

		$this->loadViews("Reports/semesterWiseStudentsReport", $this->global, $data, NULL);

    } 

    public function getTotalHostelidListSemsterwise(){

    	$this->global['pageTitle'] = 'IIUI Hostels : Semester Wise Report';

    	$semester = $this->input->post('semester');

    	$gender = $this->gender;

    	if($semester == 'all'){

    		$semesters = array('SPR-2023','FALL-2022','SUM-2022','SPR-2022','FALL-2021','SPR-2021','FALL-2020','SPR-2020','FALL-2019','SPR-2019','FALL-2018','FALL-2017','SPR-2018','SPR-2017','FALL-2016','SPR-2016');

    		$allotment = array();
    		$reallotment = array();
    		foreach($semesters as $semester){

	    		$result1 = $this->allotmenthistory_model->getAllotmentTotalStudentData($semester,$gender);
	    		array_push($allotment, $result1);
	    		$result2 = $this->allotmenthistory_model->getReallotmentTotalStudentData($semester,$gender);

	    		array_push($reallotment, $result2);
    		}

    	}else{
    		//$data['studentInfo'] = $this->allotmenthistory_model->getAllotmentStudentData($allotment_type,$semester,$gender);
    	}

    	$data['reallotment'] = $reallotment;
    	$data['allotment'] = $allotment;


    	$this->loadViews("Reports/totalhosteliedreportsemsterwise", $this->global, $data, NULL);
    }
    
    function reportListing()
    { 
		$gender = $this->gender;

		//echo $gender;
		
		$data['semester'] = $this->Semester_model->semesterListing($gender);

		//var_dump($data['semester']);

		//exit();
		
        $this->global['pageTitle'] = 'IIUI Hostels : Report Listing';
        
        $this->loadViews("Reports/view", $this->global, $data, NULL);
    }
	
	function getallStInfo()
    {	           
        $this->global['pageTitle'] = 'IIUI Hostels : Report Students Details';
        
        $this->loadViews("Reports/searchstdetail", $this->global, NULL, NULL);
    }
	
	function viewallallot()
    {
			
        
			$gender = $this->gender;
		
			$data['hostel'] = $this->report_model->GetAllHostel($gender);
			
			$data['semester'] = $this->report_model->getallsemester($gender);
            
            $this->global['pageTitle'] = 'IIUI Hostels : Report Students Details';
            
            $this->loadViews("Reports/searchallotreallot", $this->global, $data, NULL);
        
    }
	
	function searchallstud()
    {
			
        
			 $userId = $this->vendorId;
			
			$gender = $this->common_model->GetGenderById($userId);
				
			$gender = $gender[0]->GENDER;
		
			$data['hostel'] = $this->report_model->GetAllHostel($gender);
			
			$data['semester'] = $this->report_model->getallsemester($gender);
            
            $this->global['pageTitle'] = 'IIUI Hostels : Report Students Details';
            
            $this->loadViews("Reports/searchallstud", $this->global, $data, NULL);
        
    }
	
	function cancelreallot()
    {
	    $userId = $this->vendorId;
			
		$gender = $this->common_model->GetGenderById($userId);
			
		$gender = $gender[0]->GENDER; 
		
		$lastsemester = $this->report_model->getlastsemester($gender);
		
		if($lastsemester)
		{
	  		$semcode = $lastsemester[0]->SEMCODE;
			
			$cancelstud = $this->report_model->cancelstudinfo($gender, $semcode);	
			
			
			foreach($cancelstud as $studinfo)
				   {
						  $seatid = $studinfo->SEATID;
						  
						  $regno = $studinfo->REGNO;
						  
						  $updateseat = array('OCCUPIED'=>0);
						  
						  $this->report_model->cancelseat($updateseat,$seatid,$gender);
						  
						  $updatereallot = array('ADMIN_VERIFY'=>2);
						  
						  $this->report_model->updatreallotstatus($updatereallot,$regno,$gender);
					}
					  
					  redirect('report/reports/viewallallot'); 
					 
		  }
		  else
		  {			
			   redirect('report/reports/viewallallot');
		  }
	}
	
	function searchStudentInfo()
    {
			
        
			 $userId = $this->vendorId;
			
			$gender = $this->common_model->GetGenderById($userId);
				
			$gender = $gender[0]->GENDER;
			
			$semester = $this->input->post('semester');
			
			$hostelno = $this->input->post('hostelno');
			
			$hostelnames = $this->report_model->getHostelInfo($hostelno);
			
			$hostelinfo = $hostelnames->HOSTELDESC;
			
			$hostelname = 'IIUI Hostels : Report Students Profile '.$hostelinfo;
		
			$data['allotinfo'] = $this->report_model->getstudInfo($gender, $hostelno, $semester);
            
            $this->global['pageTitle'] = $hostelname;
            
            $this->loadViews("Reports/viewstudInfo", $this->global, $data, NULL);
        
    }
	
	function allallot()
    {
			
        
			 $userId = $this->vendorId;
			
			$gender = $this->common_model->GetGenderById($userId);
				
			$gender = $gender[0]->GENDER;
			
			$semester = $this->input->post('semester');
			
			$hostelno = $this->input->post('hostelno');
		
			$data['allotinfo'] = $this->report_model->getallaot($gender, $hostelno, $semester);
            
            $this->global['pageTitle'] = 'IIUI Hostels : Report Students Details';
            
            $this->loadViews("Reports/viewallotreallot", $this->global, $data, NULL);
        
    }
	
	function seatchange()
    {
			
        
			$userId = $this->vendorId;
			
			$genders = $this->report_model->userinfo($userId);
			
			$gender = $genders[0]->gender;
			
			$data['records'] =  $this->report_model->SeatChangeRecord($gender);
            
            $this->global['pageTitle'] = 'IIUI Hostels : Report Students Details';
			
			if($gender == 'Male')
			{
              $this->loadViews("Reports/seatchangereq", $this->global, $data, NULL);
			}
			elseif($gender == 'Female')
			{
				$this->loadViews("Reports/seatchangeFemalereq", $this->global, $data, NULL);
			}
			
    }
	
	function Seatchangeinfo()
    {
			
        
			$userId = $this->vendorId;
			
			$genders = $this->report_model->userinfo($userId);
			
			$gender = $genders[0]->gender;
			
			$data['semester'] = $this->report_model->getallsemester($gender);

			$data['hostels'] = $this->hostel_model->getHostelInfo($gender);
			
			 $this->global['pageTitle'] = 'IIUI Hostels : Report Seat Change';
			
			$this->loadViews("Reports/seatinfo", $this->global, $data, NULL);
			
	}
	
	function SeatInterchangeinfo()
    {
			
        
			$userId = $this->vendorId;
			
			$genders = $this->report_model->userinfo($userId);
			
			$gender = $genders[0]->gender;
			
			$data['semester'] = $this->report_model->getallsemester($gender);
			
			 $this->global['pageTitle'] = 'IIUI Hostels : Report Seat Change';
			
			$this->loadViews("Reports/seatinterchang", $this->global, $data, NULL);
			
	}
	
	function seatInterchanges()
    {
			
        
			$userId = $this->vendorId;
			
			$genders = $this->report_model->userinfo($userId);
			
			$gender = $genders[0]->gender;
			
			$semester = $this->input->post('semester');
			
			$data['records'] =  $this->report_model->SeatInterChangeRecord($gender,$semester);
            
            $this->global['pageTitle'] = 'IIUI Hostels : Report Students Details';
			
			if($gender == 'Male')
			{
              $this->loadViews("Reports/seatchangereq", $this->global, $data, NULL);
			}
			elseif($gender == 'Female')
			{
				$this->loadViews("Reports/seatinterchangeFemalereq", $this->global, $data, NULL);
			}
			
    }
	
	function seatchanges()
    {
			
        
			$userId = $this->vendorId;
			
			$genders = $this->report_model->userinfo($userId);
			
			$gender = $genders[0]->gender;

			$hostel = $this->input->post('hostel');
			
			if($gender == 'Female')
			
			{
				$semester = $this->input->post('semester');
				
				$data['records'] =  $this->report_model->SeatChangeRecord($gender,$semester,$hostel);
				
				$this->global['pageTitle'] = 'IIUI Hostels : Report Students Details';
				
				$this->loadViews("Reports/seatchangereq", $this->global, $data, NULL);
			}
			elseif($gender == 'Male')
			
			{
				$semester = $this->input->post('semester');


				
				$data['records'] =  $this->report_model->SeatChangeRecord($gender,$semester,$hostel);
				
				$this->global['pageTitle'] = 'IIUI Hostels : Report Students Details';
				
				$this->loadViews("Reports/seatchangereq", $this->global, $data, NULL);
			}
			
			
    }
	
	function uploadChallane()
    {
			
        
			$userId = $this->vendorId;
			
			$genders = $this->report_model->userinfo($userId);
			
			$gender = $genders[0]->gender; $emailid = $genders[0]->userId;
			
			$studregno = $this->session->userdata('studregno');
			
			$allotment = $this->report_model->GetAllHistory($gender,$studregno);
			
			if(empty($allotment))
			  {
				  echo '<i style="color:green;font-size:20px;font-family:calibri ;">You have uploded challan info succesfully for the current semester.</i><br><br> You will be redirect to previous page shortly !';
			
			
			header( "refresh:3;url=http://usis.iiu.edu.pk:64453/feechallan/feechallan/challanreallot" );
			exit();	
			  }
			
			$regno = $allotment[0]->REGNO;
			
			foreach($allotment as $allot)
			{
				$allots = count($allot->REGNO);
			}
			
			if($allots > 1)
			{
				echo '<i style="color:red;font-size:20px;font-family:calibri ;">Sorry your Email ID is conflict with other student Email Id. Please update your email Id from Provost hostel Office  for more info contact Hostel Admin.</i><br><br> You will be redirect to previous page shortly !';
			
			
			header( "refresh:5;url=http://usis.iiu.edu.pk:64453/dashboard" );
			exit();	
			}
			
			$Reallotverfy = $this->report_model->reallot_exists($regno);
				
					if(!empty($Reallotverfy[0]->REGNO))
				{
					echo '<i style="color:green;font-size:20px;font-family:calibri ;">Congragulation! You Had succesfully Uploaded Fee Slip for this Current Semester.</i><br><br> You will be redirect to previous page shortly !';
			header( "refresh:5;url=http://usis.iiu.edu.pk:64453/dashboard" );
			exit();	
				}
            
			$data['Allotment'] = $this->report_model->GetAllHistory($gender,$studregno);
			
			$seminfo = $this->report_model->GetActiveSem($gender);
			$semcode = $seminfo[0]->SEMCODE;
			$data['feestatus'] = $this->report_model->Feestatus($regno, $semcode);
			
            $this->global['pageTitle'] = 'IIUI Hostels : Report Listing';
            
            $this->loadViews("Reports/uploadfees", $this->global, $data, NULL);
        
    }
	
	function getallstudentInfo()
    {
			
			
			
			$gender = $this->gender;
			
			$regno = $this->input->post('regno');
			
			$stname = ucwords($this->input->post('stname'));
			
			if(empty($regno) && empty($stname))
			
			{
				$this->session->set_flashdata('error',"Fill atleast one Box value");
			    redirect('report/reports/getallStInfo');
			}
			else
			{

			$currentSemester = $this->Semester_model->getCurrentSem();

			$data['currentSemester'] = $currentSemester->SEMCODE;

			$data['CreditHours'] = $this->report_model->getStudentCreditHours($regno,$data['currentSemester']);
			 
			$data['studentInfo'] = $this->report_model->getallstudentInfo($gender,$regno,$stname);
			
			//$data['programe'] = $this->report_model->ProgrameListing();
            
            $this->global['pageTitle'] = 'IIUI Hostels : Report Students Details';
            
            $this->loadViews("Reports/viewstuddetail", $this->global, $data, NULL);
			
			}
    }
	
	function viewAllotinfo()
    {
            $this->load->library('pdf');
			$hostelid = $this->input->post('hostelno');
			$roomid = $this->input->post('roomno');
        
			$userId = $this->vendorId;
			
			$gender = $this->common_model->GetGenderById($userId);
			
			$gender = $gender[0]->GENDER;
			
			$data['allotinfo'] = $this->report_model->viewAllotinfo($gender, $hostelid, $roomid);
			
		    $this->pdf->load_view('viewallotinfo', $data);
		    
			$this->pdf->render();
		   
		    $data['Attachment'] = FALSE;
		   
		    $this->pdf->stream("report/reports/viewallotinfo.allotmentinfo.pdf", $data);
            
            //$this->global['pageTitle'] = 'IIUI Hostels : Allotment Reports ';
            
            //$this->loadViews("Reports/viewallotinfo", $this->global, $data, NULL);
        
    }
	
	function setAllotment()
    {
			
			
			$userId = $this->vendorId;
			
			$gender = $this->common_model->GetGenderById($userId);
			
			$gender = $gender[0]->GENDER;
			
			$data['HostelRecords'] = $this->report_model->GetAllHostel($gender);
            
            $this->global['pageTitle'] = 'IIUI Hostels : Report Listing';
            
            $this->loadViews("Reports/setallot", $this->global, $data, NULL);
        
    }
	
	function getallotslip()
    {
			
			
			$userId = $this->vendorId;
			
			$gender = $this->common_model->GetGenderById($userId);
			
			$gender = $gender[0]->GENDER;
			
			$data['allotslip'] = $this->report_model->getallotslip($gender);
            
            $this->global['pageTitle'] = 'IIUI Hostels : Report Listing';
            
            $this->loadViews("Reports/viewallotslip", $this->global, $data, NULL);
        
    }
	
	function borderlist()
    {
			
			
			$userId = $this->vendorId;
			
			$gender = $this->common_model->GetGenderById($userId);
			
			$gender = $gender[0]->GENDER;
			
			$data['semester'] = $this->report_model->getsemester($gender);
			
			$data['hostel'] = $this->report_model->gethosteldetail($gender);
			
			$data['faculty'] = $this->report_model->getfaculty();
            
            $this->global['pageTitle'] = 'IIUI Hostels : Report Listing';

            $data['nationalities'] = $this->report_model->getAllNationalites($gender);	
            
            $this->loadViews("Reports/borderlist", $this->global, $data, NULL);
        
    }

    function updateStudentNationality(){
    	$stduents = $this->report_model->getCountry('Palestine');
    	$count = 1;
    	foreach($stduents as $stduent){

    		//$updated = $this->report_model->updateStdNationality($stduent->ALLOTMENTHISTORY_ID,'Palestinian');

    		//var_dump($updated);
    		echo "====";
    		echo $count;
    		echo "====";
    		echo $stduent->ALLOTMENTHISTORY_ID;
    		echo "====";
    		echo $stduent->NATIONALITY;
    		echo "====";
    		echo $stduent->COUNTRY;
    		echo "<br>";
    		$count++;
    	}
    }
	
	function getdepartByFaculty()
    {
	     $facid = $this->input->post('facid');
		 
		 $result = $this->report_model->getdeptbyfacId($facid);
		 
		 echo json_encode($result);
        
    }
	
	function studentallot($ALLOTMENT_ID  = NULL)
    {
			 if($ALLOTMENT_ID == NULL)
            {
                redirect('report/reports/getallotslip');
            }

			
			
			$userId = $this->vendorId;
			
			$gender = $this->common_model->GetGenderById($userId);
			
			$gender = $gender[0]->GENDER;
			
			$allotslip = $this->report_model->getallotslipbyId($gender,$ALLOTMENT_ID);
			
			$regno = $allotslip[0]->REGNO;
			
		  $this->load->library('pdf');
		  
		  
		  
		  $picture = $this->common_model->CheckPictureOracle($regno);
		  if($picture)
		  {
		  	$data['oraclepic'] = $this->common_model->PictureOracle($regno);
			  
			  $data['acad'] = $this->report_model->acadprograme($regno);
				
			  $data['allotslip'] = $this->report_model->getallotslipbyId($gender,$ALLOTMENT_ID);
			  
			  $this->pdf->load_view('Reports/stallotslip', $data);
			  
			  $this->pdf->render();
			  $data['Attachment'] = FALSE;
			  $this->pdf->stream("report/reports/AlotSlip.pdf", $data);
		  }
		  else{
			  
			    $data['oraclepic'] = '';
			  
			  $data['acad'] = $this->report_model->acadprograme($regno);
				
			  $data['allotslip'] = $this->report_model->getallotslipbyId($gender,$ALLOTMENT_ID);
			  
			  $this->pdf->load_view('Reports/stallotslip', $data);
			  
			  $this->pdf->render();
			  $data['Attachment'] = FALSE;
			  $this->pdf->stream("report/reports/AlotSlip.pdf", $data);
		  }
        
    }
	
	function studentallotByName()
    {
			

			
			
			$userId = $this->vendorId;
			
			$userInf = $this->report_model->userinfo($userId);
			
			$emailid = $this->vendorId; 
			
			$gender = $userInf[0]->gender;
		
			$allotslip = $this->report_model->getallotslipbyEmailId($gender,$emailid);
			
			if($allotslip == NULL)
			{
				echo '<i style="color:red;font-size:20px;font-family:calibri ;">Your Re-Allotment Slip is not yet Genrated. It is is under verification process. Please check later. For more info contact Hostel Admin.</i><br><br> You will be redirect to previous page shortly !';
			
			
			header( "refresh:5;url=http://usis.iiu.edu.pk:64453/dashboard" );
			exit();	
			
			}
			
		    $regno = $allotslip[0]->REGNO;
			
		  $this->load->library('pdf');
		  
		  
		  $data['acad'] = $this->report_model->acadprograme($regno);

		  $data['oraclepic'] = $this->common_model->PictureOracle($regno);	
		  
		  $data['allotslip'] = $this->report_model->getallotslipbyEmailId($gender,$emailid);
		 
		  $this->pdf->load_view('reports/stallotslipInd', $data);
		  
		  $this->pdf->render();
		  $data['Attachment'] = FALSE;
		  $this->pdf->stream("report/reports/AlotSlip.pdf", $data);
        
    }
	
	
	function getroombyHostelId()
    {	 
		 $hostelid = $this->input->post('hostelno');
		 
		 $result = $this->report_model->getroombyHostelId($hostelid);
		 
		 echo json_encode($result);
		 
    }

	function StudentListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            
     
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->report_model->StudenListingCount($searchText);

			$returns = $this->paginationCompress ( "StudentListing/", $count, 5 );
            
            //$data['userRecords'] = $this->report_model->StudentListing($searchText, $returns["page"], $returns["segment"]);
			
			if ($this->input->post('programe') != ""){
			
			$programe = $this->input->post('programe');
			$semester = $this->input->post('semester');
		 }
		 else
		    {
			  $programe = $protitle;
			  $semester = $semestercode;
			  $semester = substr($semester, -9);
			  		
			}
			
			
			$data['studentInfo'] = $this->report_model->StudentListing($searchText, $returns["page"], $returns["segment"], $programe, $semester);
			//= $this->report_model->getStudentInfo($programe, $semester);
		    
		    $this->global['pageTitle'] = 'IIUI Hostels : Get Hostel Detail list';
        
            $this->loadViews("reports/viewreport", $this->global, $data, NULL);
        }
    }

	
    /**
     * This function is used to load the add new form
     */
    
    
    /**
     * This function is used to add new user to the system
     */
    function addNewUser()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|max_length[128]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $name = ucwords(strtolower($this->input->post('fname')));
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->input->post('mobile');
                
                $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'roleId'=>$roleId, 'name'=> $name,
                                    'mobile'=>$mobile, 'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:sa'));
                
                
                $result = $this->user_model->addNewUser($userInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New User created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User creation failed');
                }
                
                redirect('addNew');
            }
        }
    }

    
    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function verifystudentrecord($userId = NULL)
    {
        
        if($userId == null)
        {
            redirect('report/reports/reportListing');
        }
		
		$gender = $this->gender;
		
		$userinfo = $this->report_model->VerifyUserRecord($userId, $gender);
		
		$data['userInfo'] = $userinfo;
		
		$regno = $userinfo[0]->REGNO;        
		
		$data['userfaculty'] = $this->report_model->getfaculty();
		
		$data['oraclepic'] = $this->common_model->PictureOracle($regno);
        
        $this->global['pageTitle'] = 'HOSTEL : View Reports';
        
	   $this->loadViews("reports/editviewreport", $this->global, $data, NULL);
        
    }
	
	function UpdatestudentStatus()
    {
		$userId = $this->vendorId;
		
		
		 
		$UserRole = $this->report_model->VerifyUserStatus($userId);
        
		$UserRole = $UserRole[0]->roleId;
		
		if($UserRole == 3 || $UserRole == 4 )
        {
            $this->session->set_flashdata('error', "Oops! you don't have permission to change Status");
			redirect('report/reports/verifystudentrecord'.str_replace(' ','/',$studentId));

        }
        else
        {  
			$status = $this->input->post('status');
            $studentId = $this->input->post('studentid');
		    $programe = $this->input->post('protitle');
			$semester = $this->input->post('semestercode');
			$notes = $this->input->post('notes');
			$email = $this->input->post('email');
			$regno = $this->input->post('regno');
			$snumber = $this->input->post('snumber');
			$name = $this->input->post('name');
			$applystatus = $this->input->post('applystatus');
			$cnic = str_replace('-', '', $this->input->post('nic'));
			$password = $this->input->post('password'); 
			
            $userInfo = array('STATUS'=>$status, 'NOTE'=>$notes,'APPLYSTATUS'=>$applystatus, 'NOTE'=>$notes, 'ADMINUPDATESTATUSDATE'=>date('Y-m-d'));
			if($status == " ")
			
			{
				$this->session->set_flashdata('error', 'Erorr please Select Status !');
				redirect('report/reports/verifystudentrecord'.str_replace(' ','/',$studentId));
			}
			else {
            
			
			$userId = $this->vendorId;
			
			$gender = $this->common_model->GetGenderById($userId);

			$gender = $gender[0]->GENDER;
			
            $result = $this->report_model->UpdatestudentStatus($userInfo,$studentId, $gender);
			
		if($status == 1)
		  {	
			$emailexist = $this->report_model->checkemail($email);
			
			if(empty($emailexist))
			   {
				  $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'regno'=>$regno, 'name'=>$name, 'mobile'=>$snumber, 'gender'=>$gender, 'cnic'=>$cnic, 'roleId'=>4, 'createdBy'=>$this->vendorId); 
				  
				  $this->report_model->addNewUser($userInfo);
			   }
			else
			   {
				   $userId = $emailexist[0]->userId;
				   
				   $userInfo = array('email'=>$email, 'updatedBy'=>$this->vendorId, 'mobile'=>$snumber, 'cnic'=>$cnic, 'regno'=>$regno);
				   
				   $this->report_model->UpdatEmailInfo($userInfo, $userId);
				   
			   }
			
			$emailtype = 'New Application';
			
			$sendemail = $this->report_model->getsendemail($gender, $emailtype);
			
			/* Mail function starts */
			
			 require 'PHPMailer/src/Exception.php';
			 require 'PHPMailer/src/PHPMailer.php';
			 require 'PHPMailer/src/SMTP.php';
			 require "PHPMailer/src/OAuth.php";
			 require "PHPMailer/src/POP3.php";

               $mail = new PHPMailer\PHPMailer\PHPMailer();
				
				$mail->isSMTP();
				//$mail->SMTPDebug = 1;                                   // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                            // Enable SMTP authentication
				$mail->Username = $sendemail[0]->EMAIL;             // SMTP username
				$mail->Password = $sendemail[0]->PASSWORD; // SMTP password
				$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 587;                                 // TCP port to connect to
				
				$mail->setFrom($sendemail[0]->EMAIL, 'Admin Hostel IIUI');
				$mail->addReplyTo('no-reply@iiu.edu.pk', 'Admin Hostel IIUI');
				$mail->addAddress($email);   // Add a recipient
				//$mail->addCC('cc@example.com');
				//$mail->addBCC('bcc@example.com');
				
				$mail->isHTML(true);  // Set email format to HTML   
			
			$bodyContent = '<h3>Dear Applicant '.$name.' (RegNo <b>'.$regno.'</b>)</h3><br><h3>
Congratulations! You Application have been Approved for Hostel New Seat Allotment.</h3>';
	        $bodyContent .= '<p>Your Hostel New Seat Allotment has been approved, Tracker Id.<b> '.$studentId.'</b>.
			<br>Your Email <b>'.$email.'</b> and password <b>'.$password.'</b> Keep these credentail with you as these credentail is used to login to hostel portal <b>http://usis.iiu.edu.pk:64453/login</b> kindly login with above mention credential to download fee challan. <br>Note <b>Fee Challan will take some time 24 to 48 hours for processing please be patient.<br> After submission of FEE in Bank submit your document Orignal Fee Challan, course joing form to provost office.</b><br></p>
				<br/>
				<h3>Best Regards</h3>
				<h4">Provost Office</h4>
				<p>IIUI Hostels</p><br/>
				<div style="font-size:smaller;background-color: #3c763d;color: #fff;">This communication contains information that is for the exclusive use of the intended recipient(s). If you are not the intended recipient, disclosure, copying, distribution or other use of, or taking of any action in reliance upon, this communication or the information in it is prohibited and may be unlawful. If you have received this communication in error please notify the sender by return email, delete it from your system and destroy any copies.</div>
				';
		       				
				$mail->Subject = 'Email from IIUI Hostel Admin';
				$mail->Body    = $bodyContent;
		
				if($mail->send()) {
					
					 json_encode($result);
				} else {
					$msg = 'Mailer Error: ' . $mail->ErrorInfo;
					$msg1 = 'Message could not be sent.';
					
				}
		
		 
	/* Mail function End */	
    }
			
            $semester = trim($semester); $programe = trim($programe);
			
            $data['studentInfo'] = $this->report_model->getStudentInfo($programe, $semester, $gender);
			
			$data['totalapplication'] = $this->report_model->totalapplication($semester, $programe, $gender);
		
			$data['verifyapplication'] = $this->report_model->verifyapplication($semester, $programe, $gender);
			
			$data['pendingapplication'] = $this->report_model->pendingapplication($semester, $programe, $gender);
			
			$data['cancelapplication'] = $this->report_model->cancelapplication($semester, $programe, $gender);
			
			$data['studseminfo'] = $this->report_model->getstudentemester($gender, $semester);
		   
		    $this->global['pageTitle'] = 'IIUI Hostels : Get Hostel Application Status Detail list';
        
            $this->loadViews("reports/viewreport", $this->global, $data, NULL);
			
			}
        }
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function editUser()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            
            
            $userId = $this->input->post('userId');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|max_length[128]');
            $this->form_validation->set_rules('password','Password','matches[cpassword]|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($userId);
            }
            else
            {
                $name = ucwords(strtolower($this->input->post('fname')));
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->input->post('mobile');
                
                $userInfo = array();
                
                if(empty($password))
                {
                    $userInfo = array('email'=>$email, 'roleId'=>$roleId, 'name'=>$name,
                                    'mobile'=>$mobile, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:sa'));
                }
                else
                {
                    $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'roleId'=>$roleId,
                        'name'=>ucwords($name), 'mobile'=>$mobile, 'updatedBy'=>$this->vendorId, 
                        'updatedDtm'=>date('Y-m-d H:i:sa'));
                }
                
                $result = $this->user_model->editUser($userInfo, $userId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'User updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');
                }
                
                redirect('userListing');
            }
        }
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function gendefaultlist()
    {
       /* if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else*/
        {
            
			$userId = $this->vendorId;
			
			$gender = $this->common_model->GetGenderById($userId);

			$gender = $gender[0]->GENDER;
			
			$seminfo = $this->report_model->GetActiveSem($gender);
			$semcode = $seminfo[0]->SEMCODE;
			$allallot = $this->report_model->getalldefaulter($gender, $semcode);
			foreach($allallot as $allallotment)
			  {
				  $seatid = $allallotment->SEATID;
				  
				  $regno = $allallotment->REGNO;
				  
				  $seatInfo = array('OCCUPIED'=> '0');
				  
				  $updateseat = $this->report_model->updateseat($seatid, $seatInfo);
				  
				   $updatereallot = array('ADMIN_VERIFY'=>2);
				  
				  $this->report_model->updatreallotstatus($updatereallot,$regno,$gender);
			  }
			            
            $result = $updateseat;
			
           if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }    

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'IIUI Hostels : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }
	
	function getuserlistbydate($programe = NULL, $semestercode = NULL, $fromdate = NULL, $todate = NULL, $status = NULL)
	{	
		    
		
		 
            
            $this->form_validation->set_rules('programe','programe tittle','trim|required|xss_clean');
			$this->form_validation->set_rules('semester','Semester Code','trim|required|xss_clean');
			$this->form_validation->set_rules('fromdate','From date','trim|required|xss_clean');
			$this->form_validation->set_rules('todate','To Date','trim|required|xss_clean');
            $this->form_validation->set_rules('status','Status','trim|required|xss_clean');     
            
            if($this->form_validation->run() == FALSE)
            {
		
				$this->session->set_flashdata('error', 'Select Programe or Semester, Date & Status from list');
				redirect('report/reports/reportListing');
		    }
		 else
		    {
			$userId = $this->vendorId;
			
			$gender = $this->common_model->GetGenderById($userId);

			$gender = $gender[0]->GENDER;
				
			$programe = $this->input->post('programe');
		 	$semester = $this->input->post('semester');
			$semester = substr($semester, -9);
			$fromdate = $this->input->post('fromdate');
			$todate = $this->input->post('todate');
			$status = $this->input->post('status');
			  		
						
			
			
			if($programe == 'All')
			{
			
				$data['studentInfo'] = $this->report_model->getStudentInfoAllByDate($semester,$gender,$fromdate,$todate,$status);
				
				$data['totalapplication'] = $this->report_model->totalapplicationAll($semester, $gender);
			
				$data['verifyapplication'] = $this->report_model->verifyapplicationAll($semester, $gender);
				
				$data['pendingapplication'] = $this->report_model->pendingapplicationAll($semester, $gender);
				
				$data['cancelapplication'] = $this->report_model->cancelapplicationAll($semester, $gender);
				
				$data['programe'] = 'All';$data['fromdate'] = $fromdate; $data['todate'] = $todate; $data['status'] = $status;
				
			$this->global['pageTitle'] = 'IIUI Hostels : Get Hostel Detail list';
        
            $this->loadViews("reports/viewreport", $this->global, $data, NULL);

			}
			else
			{
			    $data['studentInfo'] = $this->report_model->getStudentInfoByDate($programe, $semester, $gender,$fromdate,$todate,$status);
			
				$data['totalapplication'] = $this->report_model->totalapplication($semester, $programe, $gender);
			
				$data['verifyapplication'] = $this->report_model->verifyapplication($semester, $programe, $gender);
				
				$data['pendingapplication'] = $this->report_model->pendingapplication($semester, $programe, $gender);
				
				$data['cancelapplication'] = $this->report_model->cancelapplication($semester, $programe, $gender);
				
				$data['programe'] = '';$data['fromdate'] = $fromdate; $data['todate'] = $todate; $data['status'] = $status;
			
		    $this->global['pageTitle'] = 'IIUI Hostels : Get Hostel Detail list';
        
            $this->loadViews("reports/viewreport", $this->global, $data, NULL);
			
			}
		}
	}
	
	function getuserlist()
	{
		$this->form_validation->set_rules('programe','programe tittle','trim|required|xss_clean');
		$this->form_validation->set_rules('semester','Semester Code','trim|required|xss_clean');
            
        if($this->form_validation->run() == FALSE)
        {		
			
			$this->session->set_flashdata('error', 'Select Programe and Semester from list');
			
	       redirect('report/reports/reportListing');
		} else {

			$programe = $this->input->post('programe');
			$sem = $this->input->post('semester');

			$gender = $this->gender;
				
			$semcode = explode(',',$sem);

			//var_dump($semcode); exit();

			$semester = $semcode[0]; 

			$appstatus = $semcode[1];
			
			if($programe == 'All')
			{
				
				$data['studentInfo'] = $this->report_model->getStudentInfoAll($semester,$gender,$appstatus);

				//echo $semester, $gender,$appstatus; exit();

				//FALL-2023Female2
				
				$data['totalapplication'] = $this->report_model->totalapplicationAll($semester, $gender,$appstatus);

				//var_dump($data['totalapplication']); exit();
			
				$data['verifyapplication'] = $this->report_model->verifyapplicationAll($semester, $gender,$appstatus);
				
				$data['pendingapplication'] = $this->report_model->pendingapplicationAll($semester, $gender,$appstatus);
				
				$data['cancelapplication'] = $this->report_model->cancelapplicationAll($semester, $gender,$appstatus);
				
				$data['programe'] = 'All';
				
				$data['studseminfo'] = $this->report_model->getstudentemester($gender, $semester);
					
				$this->global['pageTitle'] = 'IIUI Hostels : Get Hostel Detail list';
	        
	            $this->loadViews("reports/viewreport", $this->global, $data, NULL);

			}
			else if($programe != '' )
			{
			    $data['studentInfo'] = $this->report_model->getStudentInfo($programe, $semester, $gender);
			
				$data['totalapplication'] = $this->report_model->totalapplication($semester, $programe, $gender);
			
				$data['verifyapplication'] = $this->report_model->verifyapplication($semester, $programe, $gender);
				
				$data['pendingapplication'] = $this->report_model->pendingapplication($semester, $programe, $gender);
				
				$data['cancelapplication'] = $this->report_model->cancelapplication($semester, $programe, $gender);
				
				$data['programe'] = '';
				
				$data['studseminfo'] = $this->report_model->getstudentemester($gender, $semester);
				
			    $this->global['pageTitle'] = 'IIUI Hostels : Get Hostel Detail list';
	        
	            $this->loadViews("reports/viewreport", $this->global, $data, NULL);
				
			}

		}
	}
	
	function getborderlist($hostel = NULL, $programe = NULL, $semester = NULL)
	{	
            
        $this->form_validation->set_rules('programe','programe tittle','trim|required|xss_clean');
		$this->form_validation->set_rules('semester','Semester Code','trim|required|xss_clean');
		$this->form_validation->set_rules('hostel','Hostel','trim|required|xss_clean');
			//$this->form_validation->set_rules('nationality','nationality','trim|required|xss_clean');    
            
        if($this->form_validation->run() == FALSE)
        {
		
			$this->session->set_flashdata('error', 'Select Hostel, Programe and Semester from list');
			redirect('report/reports/borderlist');
		} else
		{
			$userId = $this->vendorId;
			
			$gender = $this->common_model->GetGenderById($userId);

			$gender = $gender[0]->GENDER;
				
			$hostel = $this->input->post('hostel');
			$programe = $this->input->post('programe');
		 	$semester = $this->input->post('semester');
			$nationality = $this->input->post('nationality');
			$faculty = $this->input->post('faculty');
			$dept = $this->input->post('dept');
			if($faculty != 'All')
			{
			   $facname = $this->report_model->getfacname($faculty);	
			
			   $faculty  = $facname[0]->FNAME;
			} else
			{
				$faculty = 'All';
			}
			
			
			
			
			$val = $this->report_model->getBorderListAll($semester,$gender,$hostel,$faculty,$dept, $nationality, $programe);
			
			$batch = array();
			
			foreach($val as $vales)
			{
				$regno = $vales->REGNO;
				
				$batch[] = $this->report_model->getBatch($regno);
			}
			
			//print_r(count($batch));exit();
			$data['batchname'] = $batch;
			
			$data['studentInfo'] = $this->report_model->getBorderListAll($semester,$gender,$hostel,$faculty,$dept, $nationality, $programe);
			
			$this->global['pageTitle'] = 'IIUI Hostels : Get Hostel Border list Detail';
        
            $this->loadViews("reports/viewborderlist", $this->global, $data, $data);
			
		}
	}
	
	
	function UpdateSeatChangeStatus()
    {
			$status = explode(',',$this->input->post('status'));
			
			$upstatus = $status[0];
			
			$sid = $status[1];
			
			$regno = $status[2];
			
			$userId = $this->vendorId;
			
			$gender = $this->common_model->GetGenderById($userId);
			
			$gender = $gender[0]->GENDER;
			
			$userupdate = array('STATUS'=>$upstatus);
		
			$result = $this->report_model->UpdateSeatChanges($userupdate,$sid,$gender);
			
			$result = $this->report_model->GetEmailByRegno($regno, $gender);
			
			$userId = $result[0]->EMAILID;
			
			$Applicantsemails = $this->report_model->VerifychangeEmailById($userId, $gender);
		
			$useremail = $Applicantsemails[0]->email;
			 
		
		/* Mail function starts */
				/* Mail function starts */
				 require 'PHPMailer/src/Exception.php';
                 require 'PHPMailer/src/PHPMailer.php';
                 require 'PHPMailer/src/SMTP.php';
                  require "PHPMailer/src/OAuth.php";
                  require "PHPMailer/src/POP3.php";

                $mail = new PHPMailer\PHPMailer\PHPMailer();
				
				$mail->isSMTP();                                   // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                            // Enable SMTP authentication
				$mail->Username = 'hostel@iiu.edu.pk';             // SMTP username
				$mail->Password = 'islamabad12'; // SMTP password
				$mail->SMTPSecure = 'ssl';                         // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 465;
				//$mail->ClearAllRecipients();
				//$mail->SingleTo = true; 
	
		foreach($Applicantsemails as $record)
		
		{      
			
			$bodyContent = '<h3>Dear Applicant ('.$useremail.' RegNo <b>'.$regno.'</b>)</h3><br><h3>
Congratulations! You Application have been Approved for Hostel Seat Change.</h3>';
	        $bodyContent .= '<p>Your seat change application has been approved, Tracker Id.<b> '.$sid.'</b> kindly get fee challan from fee section and <br> pay charges of Rs 1000 only. Your seat change will be confirm/change after submission of only hard copy<br> of this email and challan in provost office. (Window no. 1).</strong><br><br> Note: <b>Take the print of this Email by (Ctrl+p). </b><br></p>
				<br/>
				<h3>Best Regards</h3>
				<h4">Provost Office</h4>
				<p>Female Campus</p><br/>
				<div style="font-size:smaller;background-color: #3c763d;color: #fff;">This communication contains information that is for the exclusive use of the intended recipient(s). If you are not the intended recipient, disclosure, copying, distribution or other use of, or taking of any action in reliance upon, this communication or the information in it is prohibited and may be unlawful. If you have received this communication in error please notify the sender by return email, delete it from your system and destroy any copies.</div>
				';
		       
				$mail->ClearAllRecipients();
				$mail->setFrom('hostel@iiu.edu.pk', 'Admin Hostel IIUI');
				$mail->addReplyTo('no-reply@iiu.edu.pk', 'Admin Hostel IIUI');
				$mail->addAddress($useremail);   // Add a recipient
				//$mail->addCC();
				//$mail->addBCC('bcc@example.com');
				
				$mail->isHTML(true);  // Set email format to HTML
				
				$mail->Subject = 'Email from IIUI Hostel Admin';
				$mail->Body    = $bodyContent;
		
				if($mail->send()) {
					
					 echo json_encode($result);
				} else {
					$msg = 'Mailer Error: ' . $mail->ErrorInfo;
					$msg = 'Message could not be sent.';
					
				}
		}
		 
		      
    }
	
	function UpdateSeatInterChangeStatus()
    {
			$status = explode(',',$this->input->post('status'));
			
			$upstatus = $status[0];
			
			$sid = $status[1];
			
			$regno = $status[2];
			
			$swapregno = $status[3];
			
			$userId = $this->vendorId;
			
			$gender = $this->common_model->GetGenderById($userId);
			
			$gender = $gender[0]->GENDER;
			
			$userupdate = array('STATUS'=>$upstatus);
		
			$result = $this->report_model->UpdateSeatInterChanges($userupdate,$sid,$gender);
			
			$result = $this->report_model->GetEmailByRegno($regno, $gender);
			
			$userId = $result[0]->EMAILID;
			
			$Applicantsemails = $this->report_model->VerifychangeEmailById($userId, $gender);
		
			$useremail = $Applicantsemails[0]->email;
			 
		
		/* Mail function starts */
				require 'PHPMailer/PHPMailerAutoload.php';

				$mail = new PHPMailer;
				
				$mail->isSMTP();                                   // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                            // Enable SMTP authentication
				$mail->Username = 'hostel@iiu.edu.pk';             // SMTP username
				$mail->Password = 'islamabad12'; // SMTP password
				$mail->SMTPSecure = 'ssl';                         // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 465;
				//$mail->ClearAllRecipients();
				//$mail->SingleTo = true; 
	
		foreach($Applicantsemails as $record)
		
		{      
			
			$bodyContent = '<h3>Dear Applicant ('.$useremail.' RegNo: <b>'.$regno.'</b>)</h3><br><h3>
Congratulations! You Application have been Approved for Hostel Seat InterChange.</h3>';
	        $bodyContent .= '<p>Your seat Interchange application has been approved, Tracker Id.<b> '.$sid.'</b> kindly get fee challan from fee section and pay <br>charges of Rs 500 only. Your seat Interchange will be confirm/change after submission of only hard copy <br> of this email and challan in provost office. (Window no. 1).</strong><br><br>
			<h3> Applicant Email ('.$useremail.' RegNo: <b>'.$regno.'<br> Interchange With Regno: '.$swapregno.'</b>)</h3><br>
			 Note: <b>Take the print of this Email by (Ctrl+p). </b><br>
			</p>
				<br/>
				<h3>Best Regards</h3>
				<h4">Provost Office</h4>
				<p>Female Campus</p><br/>
				<div style="font-size:smaller;background-color: #3c763d;color: #fff;">This communication contains information that is for the exclusive use of the intended recipient(s). If you are not the intended recipient, disclosure, copying, distribution or other use of, or taking of any action in reliance upon, this communication or the information in it is prohibited and may be unlawful. If you have received this communication in error please notify the sender by return email, delete it from your system and destroy any copies.</div>
				';
		       
				$mail->ClearAllRecipients();
				$mail->setFrom('hostel@iiu.edu.pk', 'Admin Hostel IIUI');
				$mail->addReplyTo('no-reply@iiu.edu.pk', 'Admin Hostel IIUI');
				$mail->addAddress($useremail);   // Add a recipient
				//$mail->addCC();
				//$mail->addBCC('bcc@example.com');
				
				$mail->isHTML(true);  // Set email format to HTML
				
				$mail->Subject = 'Email from IIUI Hostel Admin';
				$mail->Body    = $bodyContent;
		
				if($mail->send()) {
					
					 echo json_encode($result);
				} else {
					$msg = 'Mailer Error: ' . $mail->ErrorInfo;
					$msg = 'Message could not be sent.';
					
				}
		}
		 
		      
    }
	
	function UpdateUserStatus()
    {
        	$status = $this->input->post('status');
			
			$upstatus = $status[0];
			
			$sid = substr($status,1);
			
			$userId = $this->vendorId;
			
			$gender = $this->common_model->GetGenderById($userId);
			
			$gender = $gender[0]->GENDER;
			
			$userupdate = array('STATUS'=>$upstatus, 'ADMINUPDATESTATUSDATE'=>date('Y-m-d'));
		
			$result = $this->report_model->UpdateStatus($userupdate,$sid,$gender);
			
			if($upstatus == 1)
		  {	
		  	$userrecords = $this->report_model->GetuserInfo($sid, $gender);
			
			$email = $userrecords[0]->STUDENTEMAIL; $password = $userrecords[0]->STUDENTPASSWORD; $regno = $userrecords[0]->REGNO; $cnic = str_replace('-', '', $userrecords[0]->CNIC);
			
			$name = $userrecords[0]->STUDENTNAME; $snumber = $userrecords[0]->STUDENTNUMBER;
					  
			$emailexist = $this->report_model->checkemail($email);
			
			if(empty($emailexist))
			   {
				  $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'regno'=>$regno, 'name'=>$name, 'mobile'=>$snumber, 'gender'=>$gender, 'cnic'=>$cnic, 'roleId'=>4, 'createdBy'=>$this->vendorId); 
				  
				  $this->report_model->addNewUser($userInfo);
			   }
			else
			   {
				   $userId = $emailexist[0]->userId;
				   
				   $userInfo = array('email'=>$email, 'updatedBy'=>$this->vendorId, 'mobile'=>$snumber, 'cnic'=>$cnic);
				   
				   $this->report_model->UpdatEmailInfo($userInfo, $userId);
				   
			   }
			
			$emailtype = 'New Application';
			
			$sendemail = $this->report_model->getsendemail($gender, $emailtype);
			
			
			/* Mail function starts */
			
			 require 'PHPMailer/src/Exception.php';
			 require 'PHPMailer/src/PHPMailer.php';
			 require 'PHPMailer/src/SMTP.php';
			 require "PHPMailer/src/OAuth.php";
			 require "PHPMailer/src/POP3.php";

               $mail = new PHPMailer\PHPMailer\PHPMailer();
				
				$mail->isSMTP();
				//$mail->SMTPDebug = 1;                                   // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                            // Enable SMTP authentication
				$mail->Username = $sendemail[0]->EMAIL;             // SMTP username
				$mail->Password = $sendemail[0]->PASSWORD; // SMTP password
				$mail->SMTPSecure = 'ssl';                         // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 465;                                 // TCP port to connect to
				
				$mail->setFrom($sendemail[0]->EMAIL, 'Admin Hostel IIUI');
				$mail->addReplyTo('no-reply@iiu.edu.pk', 'Admin Hostel IIUI');
				$mail->addAddress($email);   // Add a recipient
				//$mail->addCC('cc@example.com');
				//$mail->addBCC('bcc@example.com');
				
				$mail->isHTML(true);  // Set email format to HTML   
			
			$bodyContent = '<h3>Dear Applicant '.$name.' (RegNo <b>'.$regno.'</b>)</h3><br>';
	        
			$bodyContent .= '<p>Congratulations! Your Application has been approved for Hostel Seat Allotment via Tracker Id.<b> '.$sid.'</b>. Under Email <b>'.$email.'</b> and password <b>'.$password.'</b><br> Keep these credentials with you as these credentials will be used to login hostel portal <b>http://usis.iiu.edu.pk:64453/login</b> kindly login with above mention credential to download fee challan. <br>Note <b>Fee Challan will take some time 24 to 48 hours for processing please be patient.<br> After submission of FEE in Bank submit your document Orignal Fee Challan, course joing form to provost office.</b><br></p>
				<br/>
				<h3>Best Regards</h3>
				<h4">Provost Office</h4>
				<p>IIUI Hostels</p><br/>
				<div style="font-size:smaller;background-color: #3c763d;color: #fff;">This communication contains information that is for the exclusive use of the intended recipient(s). If you are not the intended recipient, disclosure, copying, distribution or other use of, or taking of any action in reliance upon, this communication or the information in it is prohibited and may be unlawful. If you have received this communication in error please notify the sender by return email, delete it from your system and destroy any copies.</div>
				';
		       				
				$mail->Subject = 'Email from IIUI Hostel Admin';
				$mail->Body    = $bodyContent;
		
				if($mail->send()) {
					
					 json_encode($result);
				} else {
					$msg = 'Mailer Error: ' . $mail->ErrorInfo;
					$msg1 = 'Message could not be sent.';
					
				}
		
		 
	/* Mail function End */	
    }
		 
		    echo json_encode($result);    
    }
	
	function UpdateUserExt()
    {
        	$ext = $this->input->post('ext');
			
			$extstatus = $ext[0];
			
			$regno = substr($ext,1);
			
			$userId = $this->vendorId;
			
			$gender = $this->common_model->GetGenderById($userId);
			
			$gender = $gender[0]->GENDER;
			
			$userext = array('EXT'=>$extstatus);
		
			$result = $this->report_model->UpdateUserExt($userext,$regno,$gender);
			
			
		 
		    echo json_encode($result);    
    }
	
	function printlist($protitle = NULL, $semestercode = NULL)
	{
		 if ($this->input->post('programe') != ""){
			
			$programe = $this->input->post('programe');
			$semester = $this->input->post('semester');
		 
		 }
		 else
		    {
			  $programe = urldecode($protitle.','.$semestercode);
			  $prog = explode(",", $programe);
			  $programe = $prog[0];
			  $semester = $prog[1];
			 
				  if($programe == 'MSMPHILL')
				  {
					  $programe = 'MS/MPHILL';
					  $prog[1];
				  }
				  else
				  {
					$programe = $prog[0];
			  		$semester = $prog[1];
				  } 		
			}
			if($semester == '')
			   {
				   $programe = urldecode($protitle.','.$semestercode);
				   $prog = explode(" ", $programe);
				   $programe = trim($prog[0]);
				   $semester = substr($prog[1], 0, -1);
			   }
			   
			
			
			$userId = $this->vendorId;
			
			$gender = $this->common_model->GetGenderById($userId);
			
			$gender = $gender[0]->GENDER;
		
			$data['studentInfo'] = $this->report_model->getStudentPrintAll($programe, $semester, $gender);
			
			$data['semstudentInfo'] = $this->report_model->getstudentemester($gender, $semester);
			
			$data['programe'] = $programe;
			
		    $this->global['pageTitle'] = 'IIUI Hostels : Approved Applicantion list';
			
            $this->loadViews("printreport", $this->global, $data, NULL);
	}
	
	public function printpdf($protitle = NULL, $semestercode = NULL)
	{
		  $programe = urldecode($protitle.$semestercode);
		  $prog = explode(".", $programe);
		  $programe = $prog[0];
		  $semester = $prog[1];
		  
		  if($programe == 'MSMPHILL')
				  {
					  $programe = 'MS/MPHILL';
					  $prog[1];
				  }
				  else
				  {
					$programe = $prog[0];
			  		$semester = $prog[1];
				  } 
		  $this->load->library('pdf');
		  
		  $userId = $this->vendorId;
		  $gender = $this->common_model->GetGenderById($userId);

		  $gender = $gender[0]->GENDER;

		  $data['studentInfo'] = $this->report_model->getStudentPrintAll($programe, $semester, $gender);
		  $data['semstudentInfo'] = $this->report_model->getstudentemester($gender, $semester);
		  $data['programe'] = $programe;
		  $this->pdf->load_view('reports/printpdf', $data);
		  $this->pdf->render();
		  $data['Attachment'] = FALSE;
		  $this->pdf->stream("report/reports/Meritlist.$programe.pdf", $data);
	}
	
	public function printAllotment($hostelid = NULL, $roomid = NULL)
	{
			$userId = $this->vendorId;
			
			$gender = $this->common_model->GetGenderById($userId);
			
			$gender = $gender[0]->GENDER;
			
		  $this->load->library('pdf');
		  
		  $data['allotinfo'] = $this->report_model->viewAllotinfo($gender, $hostelid, $roomid);
		  $this->pdf->load_view('report/reports/viewallotinfo', $data);
		  $this->pdf->render();
		  $data['Attachment'] = FALSE;
		  $this->pdf->stream("report/reports/viewallotinfo.allotmentinfo.pdf", $data);
	}
	
	function sendemail()
    {
        
		
		$userId = $this->vendorId;
			
		$gender = $this->common_model->GetGenderById($userId);

		$gender = $gender[0]->GENDER;
			
	    $Applicantsemails = $this->report_model->Verifyappicantemail($gender);
		
		/* Mail function starts */
				 require 'PHPMailer/src/Exception.php';
                 require 'PHPMailer/src/PHPMailer.php';
                 require 'PHPMailer/src/SMTP.php';
                  require "PHPMailer/src/OAuth.php";
                  require "PHPMailer/src/POP3.php";

                   $mail = new PHPMailer\PHPMailer\PHPMailer();
				
				$mail->isSMTP();                                   // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                            // Enable SMTP authentication
				$mail->Username = 'hostel@iiu.edu.pk';             // SMTP username
				$mail->Password = 'islamabad12'; // SMTP password
				$mail->SMTPSecure = 'ssl';                         // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 465;
				//$mail->ClearAllRecipients();
				//$mail->SingleTo = true; 
if ($gender == 'Female')
	{	
		foreach($Applicantsemails as $record)
		
		{      
			
			$bodyContent = '<h3>Dear Applicant ('.$record->STUDENTEMAIL.')</h3><br><h3>
Congratulations! You have been selected for Hostel Seat.</h3>';
	        $bodyContent .= '<p>Kindly visit on <b> http://usis.iiu.edu.pk:64453/form/visitordetail.pdf</b> for further details regarding seat allotment. Then submit your documents along with the hard copy of this email in the Provost Office.<br><br><strong>Documents will be verified at Window No.1<br><br>Get your challan form from admin Block room no 11 (Fee Section).</strong><br><br><strong>Submit fee in the bank.</strong><br><br><strong>Submit the form in Provost Office Window No.1 after fulfilling above criteria.</strong><br><br><strong>After completion/ submission of above, there would be one day processing time for seat allotment.</strong><br></p>
				<br/>
				<h3>Best Regards</h3>
				<h4">Provost Office</h4>
				<p>IIUI Hostels</p><br/>
				<div style="font-size:smaller;background-color: #3c763d;color: #fff;">This communication contains information that is for the exclusive use of the intended recipient(s). If you are not the intended recipient, disclosure, copying, distribution or other use of, or taking of any action in reliance upon, this communication or the information in it is prohibited and may be unlawful. If you have received this communication in error please notify the sender by return email, delete it from your system and destroy any copies.</div>
				';
		       
				$mail->ClearAllRecipients();
				$mail->setFrom('hostel@iiu.edu.pk', 'Admin Hostel IIUI');
				$mail->addReplyTo('no-reply@iiu.edu.pk', 'Admin Hostel IIUI');
				$mail->addAddress($record->STUDENTEMAIL);   // Add a recipient
				//$mail->addCC();
				//$mail->addBCC('bcc@example.com');
				
				$mail->isHTML(true);  // Set email format to HTML
				
				$mail->Subject = 'Email from IIUI Hostel Admin';
				$mail->Body    = $bodyContent;
		
				if(!$mail->send()) {
					
					$msg = 'Mailer Error: ' . $mail->ErrorInfo;
					$msg = 'Message could not be sent.';
				} else {
					$msg = 'Message has been sent';
				}
		}
	}
		elseif ($gender == 'Male')
	{		
		foreach($Applicantsemails as $record)
		
		{      
			
			$bodyContent = '<h3>Dear Applicant ('.$record->STUDENTEMAIL.')</h3><br><h3>
Congratulations! You have been selected for Hostel Seat.</h3>';
	    	$bodyContent .= '<p>Kindly visit on <b> http://usis.iiu.edu.pk:64453/form/maleapplication.pdf</b> for further details regarding seat allotment. Then submit your documents along with the hard copy of this email in the Provost Office, Male Hostel Provost Office.<br><br><strong>Documents will be verified at provost Office<br><br>Get your challan form from (Fee Section).</strong><br><br><strong>Submit fee in the bank.</strong><br><br><strong>Submit the form in Provost Office after fulfilling above criteria.</strong><br><br><strong>After completion/ submission of above, documents there would be three day processing time for seat allotment.</strong><br></p></p>
				<br/>
				<h3>Best Regards</h3>
				<h4">Provost Office</h4>
				<p>Male Campus</p><br/>
				<div style="font-size:smaller;background-color: #3c763d;color: #fff;">This communication contains information that is for the exclusive use of the intended recipient(s). If you are not the intended recipient, disclosure, copying, distribution or other use of, or taking of any action in reliance upon, this communication or the information in it is prohibited and may be unlawful. If you have received this communication in error please notify the sender by return email, delete it from your system and destroy any copies.</div>
				';
		       
				$mail->ClearAllRecipients();
				$mail->setFrom('hostel@iiu.edu.pk', 'Admin Hostel IIUI');
				$mail->addReplyTo('no-reply@iiu.edu.pk', 'Admin Hostel IIUI');
				$mail->addAddress($record->STUDENTEMAIL);   // Add a recipient
				//$mail->addCC();
				//$mail->addBCC('bcc@example.com');
				
				$mail->isHTML(true);  // Set email format to HTML
				
				$mail->Subject = 'Email from IIUI Hostel Admin';
				$mail->Body    = $bodyContent;
		
				if(!$mail->send()) {
					
					$msg = 'Mailer Error: ' . $mail->ErrorInfo;
					$msg = 'Message could not be sent.';
				} else {
					$msg = 'Message has been sent';
				}
		
		}	
		  
		  /* Mail function End */

			    
		 }
		 if($msg = 'Message has been sent')
		  {
			  $this->session->set_flashdata('success', 'Email sent successfully to All Applicant.');
			  redirect('report/reports/reportListing');
		  }
		  else
			{
				$this->session->set_flashdata('error', 'Email process sent failed please try again later.');
				redirect('report/reports/reportListing');
	
			}
	  		
      }
	  
	 //Send Emil by Date Start
	 
	 	function sendemailByDate($protitle = NULL, $semestercode = NULL, $fromdate = NULL, $todate = NULL, $status = NULL)
    {
		
		 if ($protitle == "" || $semestercode == "" || $fromdate == "" || $todate == "" || $status == ""){
			
			$this->session->set_flashdata('error', 'Email not sent. Select Programe, Semester, Date and Status from list');
			redirect('report/reports/reportListing');
		 }
	else
	    {
		 
        
		
		$userId = $this->vendorId;
			
		$gender = $this->common_model->GetGenderById($userId);

		$gender = $gender[0]->GENDER;
			
	    $Applicantsemails = $this->report_model->VerifyappicantemailByDate($gender,$fromdate,$todate,$status);
		
		/* Mail function starts */
				 require 'PHPMailer/src/Exception.php';
                 require 'PHPMailer/src/PHPMailer.php';
                 require 'PHPMailer/src/SMTP.php';
                  require "PHPMailer/src/OAuth.php";
                  require "PHPMailer/src/POP3.php";

                   $mail = new PHPMailer\PHPMailer\PHPMailer();
				
				$mail->isSMTP();                                   // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                            // Enable SMTP authentication
				$mail->Username = 'hostel@iiu.edu.pk';             // SMTP username
				$mail->Password = 'islamabad12'; // SMTP password
				$mail->SMTPSecure = 'ssl';                         // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 465;
				//$mail->ClearAllRecipients();
				//$mail->SingleTo = true; 
if ($gender == 'Female')
	{	
		foreach($Applicantsemails as $record)
		
		{      
			
		$bodyContent = '<h3>Dear Applicant (<b>'.$record->STUDENTNAME.'</b>)</h3><br><h3>
Congratulations! You have been selected for Hostel Seat against given email id:<b>'.$record->STUDENTEMAIL.'</b> and system alloted tracker Id: (<b>'.$record->STUDENTID.')</b></h3>';
	    $bodyContent .= '<p>Kindly visit on <b> http://usis.iiu.edu.pk:64453/form/visitordetail.pdf</b> for further details regarding seat allotment. Then submit your documents along with the hard copy of this email in the Provost Office, Female Hostel (Window No. 1).<br><br><strong>Documents will be verified at Window No.1<br><br>Get your challan form from your Hostel Portal.</strong><br><br><strong>Submit fee in the bank.</strong><br><br><strong>Submit the form to hostel warden after fulfilling above criteria.</strong><br><br><strong>After completion/ submission of above, there would be one day processing time for seat allotment.</strong><br></p>
				<br/>
				<h3>Best Regards</h3>
				<h4">Provost Office</h4>
				<p>Female Campus</p><br/>
				<div style="font-size:smaller;background-color: #3c763d;color: #fff;">This communication contains information that is for the exclusive use of the intended recipient(s). If you are not the intended recipient, disclosure, copying, distribution or other use of, or taking of any action in reliance upon, this communication or the information in it is prohibited and may be unlawful. If you have received this communication in error please notify the sender by return email, delete it from your system and destroy any copies.</div>
				';
		       
				$mail->ClearAllRecipients();
				$mail->setFrom('hostel@iiu.edu.pk', 'Admin Hostel IIUI');
				$mail->addReplyTo('no-reply@iiu.edu.pk', 'Admin Hostel IIUI');
				$mail->addAddress($record->STUDENTEMAIL);   // Add a recipient
				//$mail->addCC();
				//$mail->addBCC('bcc@example.com');
				
				$mail->isHTML(true);  // Set email format to HTML
				
				$mail->Subject = 'Email from IIUI Hostel Admin';
				$mail->Body    = $bodyContent;
	
				if(!$mail->send()) {
					
					$msg = 'Mailer Error: ' . $mail->ErrorInfo;
					$msg = 'Message could not be sent.';
				} else {
					$msg = 'Message has been sent';
				}
		}
	}
		elseif ($gender == 'Male')
	{		
		foreach($Applicantsemails as $record)
		
		{      
			
			$bodyContent = '<h3>Dear Applicant (<b>'.$record->STUDENTNAME.'</b>)</h3><br><h3>
Congratulations! You have been selected for Hostel Seat against given email id:<b>'.$record->STUDENTEMAIL.'</b> and system alloted tracker Id: (<b>'.$record->STUDENTID.'</b>)</h3>';
	    	$bodyContent .= '<p>Kindly visit on <b> http://usis.iiu.edu.pk:64453/form/maleapplication.pdf</b> for further details regarding seat allotment. Then submit your documents along with the hard copy of this email in the Provost Office, Male Hostel Provost Office.<br><br><strong>Documents will be verified at provost Office<br><br>Get your challan form from (Fee Section).</strong><br><br><strong>Submit fee in the bank.</strong><br><br><strong>Submit the form in Provost Office after fulfilling above criteria.</strong><br><br><strong>After completion/ submission of above, documents there would be three day processing time for seat allotment.</strong><br></p></p>
				<br/>
				<h3>Best Regards</h3>
				<h4">Provost Office</h4>
				<p>Male Campus</p><br/>
				<div style="font-size:smaller;background-color: #3c763d;color: #fff;">This communication contains information that is for the exclusive use of the intended recipient(s). If you are not the intended recipient, disclosure, copying, distribution or other use of, or taking of any action in reliance upon, this communication or the information in it is prohibited and may be unlawful. If you have received this communication in error please notify the sender by return email, delete it from your system and destroy any copies.</div>
				';
		       
				$mail->ClearAllRecipients();
				$mail->setFrom('hostel@iiu.edu.pk', 'Admin Hostel IIUI');
				$mail->addReplyTo('no-reply@iiu.edu.pk', 'Admin Hostel IIUI');
				$mail->addAddress($record->STUDENTEMAIL);   // Add a recipient
				//$mail->addCC();
				//$mail->addBCC('bcc@example.com');
				
				$mail->isHTML(true);  // Set email format to HTML
				
				$mail->Subject = 'Email from IIUI Hostel Admin';
				$mail->Body    = $bodyContent;
		
				if(!$mail->send()) {
					
					$msg = 'Mailer Error: ' . $mail->ErrorInfo;
					$msg = 'Message could not be sent.';
				} else {
					$msg = 'Message has been sent';
				}
		
		}	
		  
		  /* Mail function End */

			    
		 }
		 if($msg = 'Message has been sent')
		  {
			  $this->session->set_flashdata('success', 'Email sent successfully to All Applicant.');
			  redirect('report/reports/reportListing');
		  }
		  else
			{
				$this->session->set_flashdata('error', 'Email process sent failed please try again later.');
				redirect('report/reports/reportListing');
	
			}
	  		
      }
	 
	  //Send Emil by Date End
	}
	
	function UploadFeeslip()
    {     
	
            
			$this->load->helper('date_helper');
            
            $this->form_validation->set_rules('studname','Full Name','required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('regno','regno','required|xss_clean|max_length[128]');
            $this->form_validation->set_rules('dept','Department','required|max_length[128]');
            $this->form_validation->set_rules('faculty','Faculty','required|max_length[128]');
            $this->form_validation->set_rules('fee','Fees','required|max_length[128]');
			$this->form_validation->set_rules('vno','vno','required|max_length[128]');
			
			/*if (empty($_FILES['feeslip']['name']))
				{
					$this->form_validation->set_rules('feeslip', 'feeslip', 'required');
				}*/
            if($this->form_validation->run() == FALSE)
            {
                //$this->index();
				$this->session->set_flashdata('error', 'Please fill all required fields');
				redirect('report/reports/uploadChallane');
            }
            else
            {
				
				date_default_timezone_set('Asia/Karachi');
			    $dateTime = date('Y-m-d H:i:s');
				
				
                $name = ucwords(strtolower($this->input->post('studname')));
                $regno = $this->input->post('regno');
                $dept = $this->input->post('dept');
                $faculty = $this->input->post('faculty');
                $feeamount = $this->input->post('fee');
				$vno = $this->input->post('vno');
				$reallotId = $this->input->post('reallot');
				$gender = $this->input->post('gender');
				
				/* FEE UPLOAD SLIP CODE Start ***************************---- */
				
				/*
				$this->load->library('upload');
				
				$feeslipverfy = $this->report_model->fee_exists($regno);
				
					if(!empty($feeslipverfy[0]->FEEPIC))
				{
					echo '<i style="color:red;font-size:20px;font-family:calibri ;">Sorry!  Please first uploded fee challane Info for current semester.</i><br><br> You will be redirect to previous page shortly !';
			header( "refresh:5;url=http://usis.iiu.edu.pk:64453/dashboard" );
			exit();	
				}
				    
				if (!empty($_FILES['feeslip']['name']) && isset($_FILES['feeslip']['name']))
				{
				//$this->load->library('image_lib');
				// Specify configuration for File 1
					$config['image_library'] = 'gd2';
					$config['upload_path'] = 'uploads/feeslip/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					//$config['max_size'] = '32000';
					//$config['max_width']  = '4500';
					//$config['max_height']  = '4500';
					//$config['encrypt_name'] = TRUE;
					$new_name = $vno;//.$_FILES["feeslip"]['name'];
					$config['file_name'] = $new_name;	  
					
					// Initialize config for File 1
					$this->upload->initialize($config);
					
					//$this->image_lib->resize($config);
					
					$this->load->library('image_lib', $config);

					// Upload file 1
					if ($this->upload->do_upload('feeslip'))
					{
						
					
						$data = $this->upload->data();
						
					}
					else
					{
						$error =  $this->upload->display_errors();
						$this->session->set_flashdata('error', $error);
						redirect('report/reports/uploadChallane');
					}
						$feename = $_FILES['feeslip']['name'];
						$fee = explode('.',$feename);
						$feeslip = $vno.'.'.$fee[1];
						$feesname = $vno.'_thumb.'.$fee[1];
		                $feeslippath = $config['upload_path'];
						
						
						$config['image_library'] = 'gd2';
						$config['source_image'] = $feeslippath.$feeslip;
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = TRUE;
						$config['width']         = 400;
						$config['height']       = 200;
						
						$this->load->library('image_lib', $config);
						
						$this->image_lib->initialize($config);
						if(!$this->image_lib->resize())
						 {
							$error =  $this->upload->display_errors();
							$this->session->set_flashdata('error', $error);
							redirect('report/reports/uploadChallane');
						 }
						
						unlink( FCPATH . $feeslippath. $feeslip);
						
				}
				
				
			   {
				
				//$UploadInfo = array('RECEIPTNO'=>$vno, 'FEEAMOUNT'=>$feeamount, 'FEEPATH'=>$feeslippath, 'FEEPIC'=>$feeslip,'IS_SUBMIT'=> 1);
				 
                //$result = $this->report_model->UpdateFeeInfo($UploadInfo,$reallotId);
				
				
				{
				$seminfo = $this->report_model->GetActiveSem($gender);
				$semcode = $seminfo[0]->SEMCODE;
				
				$feeinfo = $this->report_model->Feestatus($regno, $semcode);
			
				if(!empty($feeinfo))
				  {
					  $feeId = $feeinfo[0]->FEE_ID;
					  $UploadInfo = array('REGNO'=>$regno,'SEMCODE'=>$semcode,'STATUS'=>1, 'RECEIPTNO'=>$vno, 'FEEAMOUNT'=>$feeamount, 'FEEPATH'=>$feeslippath, 'FEEPIC'=>$feesname,'IS_SUBMIT'=> 1);
					  
					  $result = $this->report_model->UpdateFeeStatusInfo($UploadInfo,$feeId);
					  
					  $this->session->set_flashdata('success', 'Fee Slip has been updated Sucessfully. Please check your email for details. ');
					  
					  redirect('http://usis.iiu.edu.pk:64453/dashboard');
					  
				  }
				
				*/
				
				/* FEE UPLOAD SLIP CODE End ***************************---- */
			{
				$seminfo = $this->report_model->GetActiveSem($gender);
				$semcode = $seminfo[0]->SEMCODE;
				
				$feeslippath = 'upload'; $feesname = 'demo.png';
				
				$feeInfo = array('REGNO'=>$regno,'SEMCODE'=>$semcode,'STATUS'=>1, 'RECEIPTNO'=>$vno, 'FEEAMOUNT'=>$feeamount, 'FEEPATH'=>$feeslippath, 'FEEPIC'=>$feesname,'IS_SUBMIT'=> 1);
		
				$Insertfee = $this->reallotment_model->InsertFeeStatus($feeInfo);
				
				$userId = $this->vendorId;
				
				$user = $this->report_model->userinfo($userId);
			
				$email = $user[0]->email;
				
				/* Mail function starts */
				 require 'PHPMailer/src/Exception.php';
                 require 'PHPMailer/src/PHPMailer.php';
                 require 'PHPMailer/src/SMTP.php';
                  require "PHPMailer/src/OAuth.php";
                  require "PHPMailer/src/POP3.php";

                   $mail = new PHPMailer\PHPMailer\PHPMailer();
				
				$mail->isSMTP();                                   // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                            // Enable SMTP authentication
				$mail->Username = 'hostel@iiu.edu.pk';             // SMTP username
				$mail->Password = 'islamabad12'; // SMTP password
				$mail->SMTPSecure = 'ssl';                         // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 465;                                 // TCP port to connect to
				
				$mail->setFrom('hostel@iiu.edu.pk', 'Admin Hostel IIUI');
				$mail->addReplyTo('no-reply@iiu.edu.pk', 'Admin Hostel IIUI');
				$mail->addAddress($email);   // Add a recipient //$email
				//$mail->addCC('cc@example.com');
				//$mail->addBCC('bcc@example.com');
				
				$mail->isHTML(true);  // Set email format to HTML
				
				$bodyContent = $email.'<h3>IIUI Re-Allotment Hostel Fee slip Info Received Succesfully.</h3>';
				$bodyContent .= '<p>Note: <strong>Please go to Apply Re-Allotment Section and submit the application</strong>.</p><br><p>Your Seat Re-Allotment procedure for IIUI Hostels will be compeleted after verification of your fee deposit slip by Hostel Admin. Soon you will recive confirmantion email of seat Re-Allotment after which you can download Fee Slip.</p>
				<br/>
				<p>Note: <strong>Please go to Apply Re-Allotment Section and submit the application</strong>.</p>
				<br/>
				<h3>Regards</h3>
				<h4"><b>Provost Office</b><br/></h4>
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
		
                if($mail->send())  //$result > 0 ||
                {
                    $this->session->set_flashdata('success', 'Fee Slip has been submitted Sucessfully. Please check your email for details. ');
                }
                else
                {
                    $this->session->set_flashdata('success', 'Record Submitted Succesfully. Please click on below apply button.');
                }
                
                redirect('http://usis.iiu.edu.pk:64453/reallotment/ReAllotment/studentreallotapply');
        
       }
	   
	
	function getallstudentsearch()
    {	
		
		$gender = $this->gender;
		
		$regno = trim($this->input->post('regno'));
		
		$stname = trim(ucwords($this->input->post('stname')));
			
		if(empty($regno) && empty($stname))
		
		{
			$data = '';
			
			$this->global['pageTitle'] = 'IIUI Hostels : Report Students Details';
		    $this->loadViews("Reports/viewstudsearch", $this->global, $data, NULL);
		} else {
			
		 
			$data['studentInfo'] = $this->report_model->getallstudentsearch($gender,$regno,$stname);
			$data['studentHistory'] = $this->report_model->gethistoryInfo($gender,$regno,$stname);            
			$data['remarks'] = $this->remarks_model->findRemarks($regno);            
	        $this->global['pageTitle'] = 'IIUI Hostels : Report Students Details';
	        
	        $this->loadViews("Reports/viewstudsearch", $this->global, $data, NULL);
		
		}
    }

	public function searchBoarderStudents(){
		$gender = $this->gender;
		
		$regno = trim($this->input->post('regno'));
		
		$stname = trim(ucwords($this->input->post('stname')));
			
		if(empty($regno) && empty($stname))
		
		{
			$data = '';
			
			$this->global['pageTitle'] = 'IIUI Hostels : Report Students Details';
		    $this->loadViews("Reports/searchBoarderStd", $this->global, $data, NULL);
		} else {
			
		 
			$data['studentInfo'] = $this->report_model->searchAllBoarderStudents($gender,$regno,$stname);
			           
	        $this->global['pageTitle'] = 'IIUI Hostels : Report Students Details';
	        
	        $this->loadViews("Reports/searchBoarderStd", $this->global, $data, NULL);
		
		}
	}
	
	// This function direct call on browser when first allotment of student is updation required and before updation data must be shifted in ALLOTREALLOT TABLE 
	
	function hostelbatchupdate(){
		
		$currentsemcode = 'FALL-2022';
		$gender = 'Male';
		$regnoinfos = $this->report_model->GetAllregnoInfo($currentsemcode, $gender);
		if(!empty($regnoinfos))
		{
					   $count = 0;
						foreach($regnoinfos as $regnoinfo)
						{
							
								$studregno = $regnoinfo->regno;
								
								$studentinfo = $this->report_model->GetHistoryBatch($studregno);
								
								if(!empty($studentinfo)){
										
										$upregno = $studentinfo->regno;
										$upsemcode = $studentinfo->semcode;
								
								$updatehostelbatch = array('HOSTELBATCH'=>$upsemcode);
								
								$result = $this->report_model->UpdateHostelBatch($upregno, $updatehostelbatch, $currentsemcode);
								
								$count++;
								
								}
								
								
						}
						if($result > 0){
									  echo $count.' Updated Hostel batch for '.$gender.' in semester'.$currentsemcode;
								  }
								  else{
									    echo 'Updation Failed';
								  }
		}
	}
}

?>