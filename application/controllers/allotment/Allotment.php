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
class Allotment extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
		$this->load->model('allotment_model');
		$this->load->model('seat_model');
        $this->load->model('room_model');
        $this->load->model('importdata_model');
        $this->load->model('clearance_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
		
        $this->global['pageTitle'] = 'IIUI Hostels : Dashboard';
        
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }
    
    /**
     * This function is used to load the user list
     */
    function viewAllotmentDetail()
    {
		$hostelno = $this->uri->segment(4); 

		$roomno = $this->uri->segment(5);
		
		if(!empty($hostelno))
		
		{
			$hostelno = $this->uri->segment(4);
			
			$roomno = $this->uri->segment(5);
		}
		else 
		{
		
		$hostelno = $this->input->post('hostelno');
			
		$roomno = $this->input->post('roomno');
		
		}

		//echo $hostelno . '====' . $roomno;
        $userId = $this->vendorId;
			
		$gender = $this->gender;   
		
		$data['viewallotments'] = $this->allotment_model->viewallotmentInfo($gender,$hostelno,$roomno);
		
		$data['roomno'] = $roomno; 

		$data['hostelno'] = $hostelno;
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Allotment Details';
		
		$this->loadViews("allotment/viewallotment", $this->global, $data, NULL);
        
    }


    function updateKey($regno){

    	$gender = $this->gender;

    	$regno = base64_decode($regno);

    	$data['oraclepic'] = $this->common_model->PictureOracle($regno);

    	$data['userInfo'] = $this->allotment_model->viewallotmentInfoByRegNo($regno, $gender);

    	$this->global['pageTitle'] = 'IIUI Hostels : Update Hostel Key and Allotment History';
		
		$this->loadViews("allotment/update_allotment_key", $this->global, $data, NULL);
    }

    function UpdateKeyAndAllotmentHistory(){

		$gender = $this->gender;

		$regno = $this->input->post('regno');

		$key = $this->input->post('key');

		$semcode = $this->input->post('semcode');

		//exit();

		$student_data = $this->allotment_model->viewallotmentInfoByRegNo($regno,$gender);

		$hisallotmentInfo =  array(
			'SEATSTATUS' => $student_data[0]->SEATSTATUS, 
			'GENDER' => $gender,
			'STUDENTNAME' => $student_data[0]->STUDENTNAME, 
			'QUOTA_TYPE' => $student_data[0]->QUOTA_TYPE, 
			'REGNO' => $student_data[0]->REGNO, 
			'SEATID' => $student_data[0]->SEATID, 
			'ROOMID' => $student_data[0]->ROOMID, 
			'HOSTELID' =>  $student_data[0]->HOSTELID, 
			'ALLOTTYPE' =>  'Allotment', 
			'ALLOTEDDATE' =>  $student_data[0]->ALLOTEDDATE, 
			'ALLOTED' => $student_data[0]->ALLOTED, 
			'EXPIRYDATE' => $student_data[0]->EXPIRYDATE, 
			'ARRIVALDATE' => $student_data[0]->ARRIVALDATE, 
			'ADDRESS' => $student_data[0]->ADDRESS, 
			'FEEAMOUNT' => $student_data[0]->FEEAMOUNT, 
			'DEPOSITDATE' =>  $student_data[0]->DEPOSITDATE, 
			'RECEIPTNO' =>  $student_data[0]->RECEIPTNO, 
			'DOORKEYSALLOTED' => $student_data[0]->DOORKEYSALLOTED, 
			'CUPBOARDKEYSALLOTED' => $student_data[0]->CUPBOARDKEYSALLOTED, 
			'RDUES' => $student_data[0]->RDUES, 
			'STATUS' => $student_data[0]->STATUS, 
			'SEMCODE' => $student_data[0]->SEMCODE, 
			'STUDENTPHONE' => $student_data[0]->STUDENTPHONE, 
			'PICNAME' => $student_data[0]->PICNAME, 
			'PICPATH' => $student_data[0]->PICPATH, 
			'FEEPATH' => $student_data[0]->FEEPATH,
			'FEEPIC' => $student_data[0]->FEEPIC, 
			'FATHERNAME' => $student_data[0]->FATHERNAME, 
			'CADDRESS' => $student_data[0]->CADDRESS, 
			'NATIONALITY' => $student_data[0]->NATIONALITY, 
			'COUNTRY' => $student_data[0]->COUNTRY, 
			'PROTITTLE' => $student_data[0]->PROTITTLE, 
			'DISTRICT' => $student_data[0]->DISTRICT, 
			'PROVINCE' => $student_data[0]->PROVINCE, 
			'DEPARTNAME' => $student_data[0]->DEPARTNAME, 
			'FACULTY' => $student_data[0]->FACULTY, 
			'PROGRAME' => $student_data[0]->PROGRAME, 
			'BATCHNAME' => $student_data[0]->BATCHNAME, 
			'HOSTELBATCH' => $student_data[0]->HOSTELBATCH, 
			'cnic' => $student_data[0]->CNIC, 
			'EMAILID' => $student_data[0]->EMAILID, 
			'IS_SUBMIT' => $student_data[0]->IS_SUBMIT, 
			'ADMIN_VERIFY' => $student_data[0]->ADMIN_VERIFY, 
			'updatedDtm' => date('Y-m-d'));

		$alotHistId = $this->allotment_model->addHisAllotment($hisallotmentInfo);

		if(empty($alotHistId) || $alotHistId < 1 || $alotHistId == null ){

			$this->session->set_flashdata('error', 'Allotment History is not updated.');
			    
			redirect('allotment/Allotment/updateKey/'.base64_encode($regno));
		}

		$randKeyInfo = array(
					'REGNO'=>$regno, 
					'KEY'=>$key, 
					'TYPE'=>'Allotment', 
					'GENDER'=> $gender, 
					'SEMCODE'=> $semcode);

		$keyInfo = $this->allotment_model->addNewAllotmentKey($randKeyInfo);

		if(empty($keyInfo) || $keyInfo < 1 || $keyInfo == null ){

			$this->session->set_flashdata('error', 'Allotment Key is not updated.');
			    
			redirect('allotment/Allotment/updateKey/'.base64_encode($regno));
		}

		$this->session->set_flashdata('success', 'Allotment Key and History updated successfully.');
			    
		redirect('allotment/Allotment/updateKey/'.base64_encode($regno));

	}
	
	function view()
    {
        $userId = $this->vendorId;
			
		$gender = $this->gender;   
		
		$data['HostelRecords'] = $this->allotment_model->getAllHostelInfo($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Allotment Details';
		
		$this->loadViews("allotment/view", $this->global, $data, NULL);
        
    }
	
	function viewSeatdetailinfo()
    {
		
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
			$hostelno = $this->input->post('hostelno');
			
			$roomno = $this->input->post('roomno');
			
			$occupystatus = $this->input->post('occupy');
			
			if($hostelno != "" && $roomno != "" && $occupystatus != "")
			{
			 
            	$data['seatRecords'] = $this->seat_model->getSeatInfo($hostelno,$roomno,$occupystatus);
			}
			else
			{
			 
            	$data['seatRecords'] = $this->seat_model->getSeatInfoByHostelroom($hostelno,$roomno);
			}
            
            $this->global['pageTitle'] = 'IIUI Hostels : View Seat Info Details';
            
            $this->loadViews("seat/viewseat", $this->global, $data, NULL);
        }
    }


    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        	$userId = $this->vendorId;
			
			$gender = $this->gender;
			
			$data['hosteldetail'] = $this->allotment_model->getHostelInfo($gender);
			
			$data['semInfo'] = $this->allotment_model->getSemesterInfo($gender);
			
			$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
			// Output: 54esmdr0qf
			$data['key'] = strtoupper(substr(str_shuffle($permitted_chars), 0, 10));
			
			//$data['stpic'] = $this->allotment_model->getStudentPic($gender);
			
            $this->global['pageTitle'] = 'IIUI Hostels : Add New Allotment';

            $this->loadViews("allotment/addNewallotment", $this->global, $data, NULL);
    }
	
	 function GenrateDefaulterList()
    {
        	$userId = $this->vendorId;
			
			$gender = $this->gender;
			
			$record = $this->allotment_model->GenrateCancelList($gender);
			
			if(!empty($record))
			{
				$default = $this->allotment_model->GenrateDefaulterList($gender);
				
				foreach($default as $record)
				{
					$allotid = $record->ALLOTMENT_ID; $seatstatus = $record->SEATSTATUS; $regno = $record->REGNO; $studentname = $record->STUDENTNAME; $studentphone = $record->STUDENTPHONE; $address = $record->ADDRESS; $gender = $record->GENDER; $seatid = $record->SEATID; $roomid = $record->ROOMID;$hostelid = $record->HOSTELID; $alloted = $record->ALLOTED; $allottype = $record->ALLOTTYPE; $allotdate = $record->ALLOTEDDATE; $expirydate = $record->EXPIRYDATE; $arrivaldate = $record->ARRIVALDATE; $feeamount = $record->FEEAMOUNT; $depotdate = $record->DEPOSITDATE; $recepitno = $record->RECEIPTNO; $doorkeyallot = $record->DOORKEYSALLOTED; $cupkeyallot = $record->CUPBOARDKEYSALLOTED; $messdueclear = $record->MESSDUESCLEAR; $vacantdate = $record->VACCANTDATE; $status = $record->STATUS; $rdues = $record->RDUES; $semcode = $record->SEMCODE; $guestregno = $record->GUESTREGNO; $quotatype = $record->QUOTA_TYPE; $type = $record->TYPE; $picpath = $record->PICPATH; $picname = $record->PICNAME; $feepath = $record->FEEPATH; $feepic = $record->FEEPIC; $issubmit = $record->IS_SUBMIT; $adminverify = $record->ADMIN_VERIFY; $updatedtm = $record->updatedDtm;
					
					$defaultInfo = array('ALLOTMENT_ID'=>$allotid, 'SEATSTATUS'=>$seatstatus, 'REGNO'=>$regno, 'STUDENTNAME'=>$studentname,'STUDENTPHONE'=>$studentphone, 'ADDRESS'=>$address, 'GENDER'=>$gender, 'SEATID'=>$seatid,'ROOMID'=>$roomid, 'HOSTELID'=>$hostelid, 'ALLOTED'=>$alloted, 'ALLOTTYPE'=>$allottype,'ALLOTEDDATE'=>$allotdate, 'EXPIRYDATE'=>$expirydate, 'ARRIVALDATE'=>$arrivaldate, 'FEEAMOUNT'=>$feeamount,'DEPOSITDATE'=>$depotdate, 'RECEIPTNO'=>$recepitno, 'DOORKEYSALLOTED'=>$doorkeyallot, 'CUPBOARDKEYSALLOTED'=>$cupkeyallot,'MESSDUESCLEAR'=>$messdueclear, 'VACCANTDATE'=>$vacantdate, 'STATUS'=>$status, 'RDUES'=>$rdues,'SEMCODE'=>$semcode, 'SEMCODE'=>$semcode, 'GUESTREGNO'=>$guestregno, 'QUOTA_TYPE'=>$quotatype,'TYPE'=>$type, 'PICPATH'=>$picpath, 'PICNAME'=>$picname, 'FEEPATH'=>$feepath,'FEEPIC'=>$feepic, 'IS_SUBMIT'=>$issubmit, 'ADMIN_VERIFY'=>$adminverify, 'updatedDtm'=>date('Y-m-d'));
					
					
					$default = $this->allotment_model->InsertAllotInfoToDefault($defaultInfo);
					
					$updateseat = array('OCCUPIED'=>0);
					
					$result = $this->allotment_model->UpdatedSeatDeafult($updateseat, $hostelid, $roomid, $seatid, $gender);
					
					$result = $this->allotment_model->DelAllDefault($gender,$allotid,$adminverify);

				}
				
				$data['viewalldefault'] = $this->allotment_model->ViewAllDefault($gender);
			
				$this->global['pageTitle'] = 'IIUI Hostels : View Allotment';
	
				$this->loadViews("allotment/viewdefaulter", $this->global, $data, NULL);
			}
			else
			{
				$this->session->set_flashdata('error', 'Currently No Allotment Existed in Cancel State.');
			    
				redirect('allotment/Allotment/viewAllotmentDetail');
			}
		
    }
	
	function ViewDefaulter()
    {
        	$userId = $this->vendorId;
			
			$gender = $this->gender;
			
			$data['viewalldefault'] = $this->allotment_model->ViewAllDefault($gender);
			
		    $this->global['pageTitle'] = 'IIUI Hostels : View Allotment';
	
			$this->loadViews("allotment/viewdefaulter", $this->global, $data, NULL);
    }
	
	function GetHostelInfoByHNO()
    {
        	$hostelId = $this->input->post('hostelno');
			
			$result = $this->allotment_model->gethostelNameById($hostelId);
		 
		    echo json_encode($result);   
    }
	
	function GetFeechallanInfo()
    {
        	$regno = $this->input->post('regno');
			
			$result = $this->allotment_model->GetSumFeechallanInfo($regno);
		 
		    echo json_encode($result);   
    }
	
	function GetRoomInfoByHNO()
    {
        	$userId = $this->vendorId;
			
			$gender = $this->gender;
			
			$hostelId = $this->input->post('hostelno');
			
			$result = $this->allotment_model->getRoomInfo($hostelId, $gender);
		 
		    echo json_encode($result);   
    }
	
	function getRoomInfobyId()
    {
        	$userId = $this->vendorId;
			
			$gender = $this->gender;
			
			$roomId = $this->input->post('roomno');
			
			$hostelId = $this->input->post('hostelno');
			
			$result = $this->allotment_model->getRoomInfobyId($hostelId, $roomId, $gender);
		 
		    echo json_encode($result);   
    }
	
	function VerifyUserRecord()
    {
        	$regno = $this->input->post('regno');
			
			$userId = $this->vendorId;
			
			$gender = $this->gender;

			//echo $gender;

			//exit();
			
			$result1 = $this->allotment_model->VerifyUserRecordExisted($regno, $gender);
			$result2 = $this->allotment_model->VerifyUserRecordExistedReallot($regno, $gender);
			$result3 = $this->allotment_model->VerifyUserRecordExistedBlacklist($regno, $gender);
			$result4 = $this->allotment_model->VerifyUserRecordExistedAllotReallot($regno, $gender);
			
			if($result1 != 0)
			{
				$result = 1;
			}
			elseif($result2 != 0 )
			{
				$result = 2;
			}
			elseif($result3 != 0)
			{
				$result = 3;
			}
			elseif($result4 != 0)
			{
				$result = 4;
			}
			else
			{
			  $result = $this->allotment_model->VerifyUserRecordById($regno, $gender);
			}
		   // print_r($result);
		    echo json_encode($result);   
    }
	
	function GetSeatByRIdHId()
    {
        	$hostelId = $this->input->post('hostelno');
			
			$roomId = $this->input->post('roomno');
			
			$userId = $this->vendorId;
			
			$gender = $this->gender;
			
			$result = $this->allotment_model->GetSeatByRIdHId($hostelId, $roomId, $gender);
		   // print_r($result);
		    echo json_encode($result);   
    }
	
	function GetESeatByRIdHId()
    {
        	$hostelId = $this->input->post('hostelno');
			
			$roomId = $this->input->post('roomno');
			
			$userId = $this->vendorId;
			
			$gender = $this->gender;
			
			$result = $this->allotment_model->GetESeatByRIdHId($hostelId, $roomId, $gender);
		   // print_r($result);
		    echo json_encode($result);   
    }
	
    
    /**
     * This function is used to add new user to the system
     */
    function addNewallotment()
    {

        $this->form_validation->set_rules('seatavilabel','Seat Avilabel','trim|required|xss_clean|max_length[128]');
		$this->form_validation->set_rules('hostelno','Hostel No','trim|required|max_length[10]|xss_clean|numeric');
		$this->form_validation->set_rules('hostelname','Hostel Name','trim|required|max_length[128]|xss_clean');
		$this->form_validation->set_rules('roomno','Room No','trim|required|max_length[128]|xss_clean|numeric');
        $this->form_validation->set_rules('roomname','Room Name','trim|required|xss_clean|max_length[128]');
        $this->form_validation->set_rules('regno','Registration No','required|max_length[128]');
		$this->form_validation->set_rules('studentname','Student Name','required|max_length[128]');
		$this->form_validation->set_rules('fname','Father Name','required|max_length[128]');
		$this->form_validation->set_rules('hbatch','Hostel Batch Name','required|max_length[128]');
		$this->form_validation->set_rules('expdate','Exp Date','required|max_length[128]');
		$this->form_validation->set_rules('alloteddate','Alloted Date','required|max_length[128]');

        if($this->form_validation->run() == FALSE)
        {
            $this->addNew();
        }
        else
        {
            $email = trim($this->input->post('email'));
			$status = $this->input->post('status');
			$seatoccupy = $this->input->post('seatoccupy');
			$hostelno = $this->input->post('hostelno');
			$hostelname = $this->input->post('hostelname');
			$roomno = $this->input->post('roomno');
			$roomname = $this->input->post('roomname');
			$seatavilabel = $this->input->post('seatavilabel');
			$regno = $this->input->post('regno');
			$studentname = $this->input->post('studentname');
			$fname = $this->input->post('fname');
			$fatherProfession = $this->input->post('fatherProfession');
			$address = $this->input->post('address');
			$preadd = $this->input->post('preadd');
			$phone = $this->input->post('phone');
			$dob = $this->input->post('dob');
			$dname = $this->input->post('dname');
			$program = $this->input->post('program');
			$faculty = $this->input->post('faculty');
			$cnic = $this->input->post('cnic');
			$nationality = $this->input->post('nationality');
			$country = $this->input->post('country');
			$protittle = $this->input->post('protittle');
			$district = $this->input->post('district');
			$province = $this->input->post('province');
			$semcode = $this->input->post('semcode');
			$alloted = $this->input->post('alloted');
			$expdate = $this->input->post('expdate');
			$arrdate = $this->input->post('arrdate');
			$depodate = $this->input->post('depodate');
			$feeamount = $this->input->post('feeamount');
			$alloteddate = $this->input->post('alloteddate');
			$recpno = $this->input->post('recpno');
			$rdues = $this->input->post('rdues');
			$rtype = $this->input->post('rtype');
			$allotstatus = $this->input->post('allotstatus');
			$key = strtoupper($this->input->post('key'));
			$remarks = $this->input->post('remarks');
			$gender = $this->input->post('gend');
			$programe = $this->input->post('programe');
			$batchname = $this->input->post('batchname');
			$hbatch = $this->input->post('hbatch');
			$picname = '';
			$picpath = '';
			$feepath = '';
			$feepic = '';
			$issubmit = 1;
			$adminverify = 1;
			
			if ($gender == 'M')
			{
				$gender = 'Male';
			} elseif($gender == 'F')
			{
				$gender = 'Female';
			}

			$doorkey = 1; 
			$drawer = ''; 
			$cupboardkey = ''; 
			$matress = ''; 
			$chair = ''; 
			$table = '';
			
			foreach ($_POST['allotitem'] as $itemnames)
			{
				if($itemnames == 'Door')
				{$doorkey = 1;}
				else if($itemnames == 'Cupboard')
				{$cupboardkey = 1;} 
				else if($itemnames == 'Drawer')
				{$drawer = 1;} 
				else if($itemnames == 'Matress')
				{$matress = 1;} 
				else if($itemnames == 'Chair')
				{$chair = 1;} 
				else if($itemnames == 'Table')
				{$table = 1;}    
			}
            
			$Seatexisted = $this->allotment_model->seat_exists_against_Regno($regno);
			
			if($Seatexisted == true)
			{
				$this->session->set_flashdata('error', 'This seat already Alloted against selected Registration Number in Database.');
				redirect('allotment/Allotment/addNew');
			} else 	{	
	            
				$studemailsId = $this->allotment_model->CheckEmailExist($email);

				if($studemailsId == 0)
				{
					$studentusercreate = array(
						'REGNO'=>$regno, 
						'EMAIL'=>$email, 
						'GENDER'=>$gender, 
						'MOBILE'=>$phone,
						'NAME'=>$studentname,
						'PASSWORD'=>getHashedPassword(str_replace(' ','',strtolower($studentname))),'ROLEID'=>4, 
						'createdDtm'=>date('Y-m-d H:i:s'), 
						'createdBy'=>$this->vendorId);

						$emailids = $this->allotment_model->CreateNewUser($studentusercreate);
				        $emailid =  $emailids[0]->userId; 
						
				} else 
				{
	                $emailids = $this->allotment_model->Getemailinfo($email);
				    $emailid =  $emailids[0]->userId;
					
	            }	
			
	            $allotmentInfo = array(
	            	'SEATSTATUS' => $status, 
	            	'GENDER' => $gender,
	            	'STUDENTNAME' => $studentname, 
	            	'QUOTA_TYPE' => $seatoccupy, 
	            	'REGNO' => $regno, 
	            	'SEATID' => $seatavilabel, 
	            	'ROOMID' => $roomno, 
	            	'HOSTELID' =>  $hostelno, 
	            	'ALLOTTYPE' =>  'Allotment', 
	            	'ALLOTEDDATE' =>  $alloteddate, 
	            	'ALLOTED' => $alloted, 
	            	'EXPIRYDATE' => $expdate, 
	            	'ARRIVALDATE' => $arrdate, 
	            	'ADDRESS' => $address, 
	            	'FEEAMOUNT' => $feeamount, 
	            	'DEPOSITDATE' =>  $depodate, 
	            	'RECEIPTNO' =>  $recpno, 
	            	'DOORKEYSALLOTED' => $doorkey, 
	            	'CUPBOARDKEYSALLOTED' => $cupboardkey, 
	            	'RDUES' => $rdues, 
	            	'STATUS' => $allotstatus, 
	            	'SEMCODE' => $semcode, 
	            	'GENDER' => $gender, 
	            	'STUDENTPHONE' => $phone, 
	            	'PICNAME' => $picname, 
	            	'PICPATH' => $picpath, 
	            	'FEEPATH' => $feepath,
	            	'FEEPIC' => $feepic, 
	            	'FATHERNAME' => $fname,
					'FATHEROCCUPATION' => $fatherProfession,  
	            	'CADDRESS' => $preadd, 
	            	'ADDRESS' => $address, 
	            	'NATIONALITY' => $nationality,
	            	'COUNTRY' => $country, 
	            	'PROTITTLE' => $protittle, 
	            	'DISTRICT' => $district, 
	            	'PROVINCE' => $province, 
	            	'DEPARTNAME' => $dname, 
	            	'FACULTY' => $faculty, 
	            	'REMARKS' => $remarks, 
	            	'PROGRAME' => $programe, 
	            	'BATCHNAME' => $batchname, 
	            	'HOSTELBATCH' => $hbatch, 
	            	'cnic' => $cnic, 
	            	'EMAILID' => $emailid, 
	            	'IS_SUBMIT' => $issubmit, 
	            	'ADMIN_VERIFY' => $adminverify, 
	            	'updatedDtm' => date('Y-m-d'));
		
				$hisallotmentInfo =  array(
					'SEATSTATUS' => $status, 
					'GENDER' => $gender,
					'STUDENTNAME' => $studentname, 
					'QUOTA_TYPE' => $seatoccupy, 
					'REGNO' => $regno, 
					'SEATID' => $seatavilabel, 
					'ROOMID' => $roomno, 
					'HOSTELID' =>  $hostelno, 
					'ALLOTTYPE' =>  'Allotment', 
					'ALLOTEDDATE' =>  $alloteddate, 
					'ALLOTED' => $alloted, 
					'EXPIRYDATE' => $expdate, 
					'ARRIVALDATE' => $arrdate, 
					'ADDRESS' => $address, 
					'FEEAMOUNT' => $feeamount, 
					'DEPOSITDATE' =>  $depodate, 
					'RECEIPTNO' =>  $recpno, 
					'DOORKEYSALLOTED' => $doorkey, 
					'CUPBOARDKEYSALLOTED' => $cupboardkey, 
					'RDUES' => $rdues, 
					'STATUS' => $allotstatus, 
					'SEMCODE' => $semcode, 
					'GENDER' => $gender, 
					'STUDENTPHONE' => $phone, 
					'PICNAME' => $picname, 
					'PICPATH' => $picpath, 
					'FEEPATH' => $feepath,
					'FEEPIC' => $feepic, 
					'FATHERNAME' => $fname,
					'FATHEROCCUPATION' => $fatherProfession, 
					'CADDRESS' => $preadd, 
					'ADDRESS' => $address, 
					'NATIONALITY' => $nationality, 
					'COUNTRY' => $country, 
					'PROTITTLE' => $protittle, 
					'DISTRICT' => $district, 
					'PROVINCE' => $province, 
					'DEPARTNAME' => $dname, 
					'FACULTY' => $faculty, 
					'PROGRAME' => $programe, 
					'BATCHNAME' => $batchname, 
					'HOSTELBATCH' => $hbatch, 
					'cnic' => $cnic, 
					'EMAILID' => $emailid, 
					'IS_SUBMIT' => $issubmit, 
					'ADMIN_VERIFY' => $adminverify, 
					'updatedDtm' => date('Y-m-d'));
			
				$itemInfo = array(
					'REGNO'=>$regno,
					'DOORKEYSALLOTED'=>$doorkey,
					'CUPBOARDKEYSALLOTED'=>$cupboardkey,
					'DRAWKEYS'=>$drawer,
					'MATRESS'=>$matress,
					'CHAIR'=>$chair,
					'TABLES'=> $table,
					'GENDER'=> $gender);
			
				$randKeyInfo = array(
					'REGNO'=>$regno, 
					'KEY'=>$key, 
					'TYPE'=>'Allotment', 
					'GENDER'=> $gender, 
					'SEMCODE'=> $semcode);



				$insertStudentInfo = array(
                    'student_name' => $studentname,
                    'regno' => $regno,
                    'gender' => $gender,
                    'cnic' => $cnic,
                    'student_email' => $email
                );

                $userEmailAdded = $this->importdata_model->addNewUser($insertStudentInfo);
			
				$updateseatstatus = array('OCCUPIED'=>'1');

				$search = 'phd';
				if(preg_match("/{$search}/i", $regno) && $gender == 'Male') {
				    $seatAloted = $this->clearance_model->UpdatedRoomStatus($updateseatstatus,$roomno);	
				}else{
			    
			    $seatAloted = $this->allotment_model->UpdateseatInfo($updateseatstatus,$seatavilabel);

			    	//Get Room ID, Hostel ID using seat id

				    $room_detail = $this->seat_model->gerRoomBySeatID($seatavilabel);

				    $hostelID = $room_detail[0]->HOSTELID;
				    $roomID = $room_detail[0]->ROOMID;

				    $roomSeats = $this->clearance_model->getRoomStatus($hostelID,$roomID);
					//var_dump($roomSeats); exit();

					foreach($roomSeats as $seat){
						if($seat->SEATDESC == 'Cubical' && $seat->GENDER == 'Male' && $seat->SEAT == 'S' && $seat->OCCUPIED == '0'){

						$result = $this->allotment_model->UpdateseatInfo($updateseatstatus,$seat->SEATID);	

						}
					}
				}

			    if($seatAloted < 1)
	            {
	                $this->session->set_flashdata('error', 'Unable to update seat status');
	                redirect('allotment/Allotment/addNew');
	            }
                               
                $allotment = $this->allotment_model->addNewAllotment($allotmentInfo);

                if($allotment < 1)
	            {
	                $this->session->set_flashdata('error', 'Unable to allot any seat');
	                redirect('allotment/Allotment/addNew');
	            }
				
				$item = $this->allotment_model->addNewItems($itemInfo);

				if($item < 1)
	            {
	                $this->session->set_flashdata('error', 'Unable to allot any room items');
	                redirect('allotment/Allotment/addNew');
	            }

				$keyInfo = $this->allotment_model->addNewAllotmentKey($randKeyInfo);

	            if($keyInfo < 1)
	            {
	                $this->session->set_flashdata('error', 'Unable to allotment key');
	                redirect('allotment/Allotment/addNew');
	            }				
                
				$alotHistId = $this->allotment_model->addHisAllotment($hisallotmentInfo);

				if($alotHistId < 1)
	            {
	                $this->session->set_flashdata('error', 'Unable to add allotment history');
	                redirect('allotment/Allotment/addNew');
	            }			
		    
			}
            if($seatAloted > 0 && $allotment > 0 && $item > 0 && $keyInfo > 0 && $alotHistId > 0)
            {
                $this->session->set_flashdata('success', 'New Seat Alloted successfully');
            } else {
                $this->session->set_flashdata('error', 'Seat Allotment failed');
            }
            
            redirect('allotment/Allotment/addNew');
        }
    }
    
	function reverallotment($AllotID = NULL)
    {
        
            if($AllotID == null)
            {
                redirect('allotment/Allotment/ViewDefaulter');
            }
			
			$userId = $this->vendorId;
			
			$gender = $this->gender;
			
			$record = $this->allotment_model->GetseatagainstDefault($gender,$AllotID);
			
			
					$allotid = $record[0]->ALLOTMENT_ID; $seatstatus = $record[0]->SEATSTATUS; $regno = $record[0]->REGNO; $studentname = $record[0]->STUDENTNAME; $studentphone = $record[0]->STUDENTPHONE; $address = $record[0]->ADDRESS; $gender = $record[0]->GENDER; $seatid = $record[0]->SEATID; $roomid = $record[0]->ROOMID;$hostelid = $record[0]->HOSTELID; $alloted = $record[0]->ALLOTED; $allottype = $record[0]->ALLOTTYPE; $allotdate = $record[0]->ALLOTEDDATE; $expirydate = $record[0]->EXPIRYDATE; $arrivaldate = $record[0]->ARRIVALDATE; $feeamount = $record[0]->FEEAMOUNT; $depotdate = $record[0]->DEPOSITDATE; $recepitno = $record[0]->RECEIPTNO; $doorkeyallot = $record[0]->DOORKEYSALLOTED; $cupkeyallot = $record[0]->CUPBOARDKEYSALLOTED; $messdueclear = $record[0]->MESSDUESCLEAR; $vacantdate = $record[0]->VACCANTDATE; $status = $record[0]->STATUS; $rdues = $record[0]->RDUES; $semcode = $record[0]->SEMCODE; $guestregno = $record[0]->GUESTREGNO; $quotatype = $record[0]->QUOTA_TYPE; $type = $record[0]->TYPE; $picpath = $record[0]->PICPATH; $picname = $record[0]->PICNAME; $feepath = $record[0]->FEEPATH; $feepic = $record[0]->FEEPIC; $issubmit = $record[0]->IS_SUBMIT; $adminverify = $record[0]->ADMIN_VERIFY; $updatedtm = $record[0]->updatedDtm;
			
			
			$seatrecord = $this->allotment_model->GetseatInfos($gender,$AllotID,$hostelid,$roomid,$seatid);
			
			if($seatrecord != NULL)
			{
			   $this->session->set_flashdata('error', 'Seat already alloted to other Student. Please vacant seat first');
                
                redirect('allotment/Allotment/ViewDefaulter');
			}
			else
			{
			
					$defaultInfo = array('ALLOTMENT_ID'=>$allotid, 'SEATSTATUS'=>$seatstatus, 'REGNO'=>$regno, 'STUDENTNAME'=>$studentname,'STUDENTPHONE'=>$studentphone, 'ADDRESS'=>$address, 'GENDER'=>$gender, 'SEATID'=>$seatid,'ROOMID'=>$roomid, 'HOSTELID'=>$hostelid, 'ALLOTED'=>$alloted, 'ALLOTTYPE'=>$allottype,'ALLOTEDDATE'=>$allotdate, 'EXPIRYDATE'=>$expirydate, 'ARRIVALDATE'=>$arrivaldate, 'FEEAMOUNT'=>$feeamount,'DEPOSITDATE'=>$depotdate, 'RECEIPTNO'=>$recepitno, 'DOORKEYSALLOTED'=>$doorkeyallot, 'CUPBOARDKEYSALLOTED'=>$cupkeyallot,'MESSDUESCLEAR'=>$messdueclear, 'VACCANTDATE'=>$vacantdate, 'STATUS'=>$status, 'RDUES'=>$rdues,'SEMCODE'=>$semcode, 'SEMCODE'=>$semcode, 'GUESTREGNO'=>$guestregno, 'QUOTA_TYPE'=>$quotatype,'TYPE'=>$type, 'PICPATH'=>$picpath, 'PICNAME'=>$picname, 'FEEPATH'=>$feepath,'FEEPIC'=>$feepic, 'IS_SUBMIT'=>$issubmit, 'ADMIN_VERIFY'=>$adminverify, 'updatedDtm'=>date('Y-m-d'));
					
					$default = $this->allotment_model->InsertAllotInfoToAllotment($defaultInfo);
					
					$updateseat = array('OCCUPIED'=>1);
					
		$result = $this->allotment_model->UpdatedSeatDeafult($updateseat, $hostelid, $roomid, $seatid, $gender);
					
					$result = $this->allotment_model->DelFromDefault($gender,$allotid);

			}
			
			 $this->session->set_flashdata('success', 'Student Seat Reverted Succesfully');
                
             redirect('allotment/Allotment/ViewDefaulter');

	}
    
    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($AllotID = NULL)
    {
        
        if($AllotID == null)
        {
            redirect('allotment/Allotment/viewAllotmentDetail');
        }
		
		$userId = $this->vendorId;
		
		$gender = $this->gender;
		
		$data['hosteldetail'] = $this->allotment_model->getAllHostelInfo($gender);
		
        $allotment = $this->allotment_model->getAllotmentInfobyId($AllotID, $gender);
		
		$hostelid = $allotment[0]->HOSTELID;
		
		$roomid = $allotment[0]->ROOMID;
		
		$regno = $allotment[0]->REGNO;
       
	    $data['roomdetail'] = $this->allotment_model->getAllRoomInfo($hostelid, $gender);
		
		$data['seatdetail'] = $this->allotment_model->getAllSeatInfo($roomid, $gender);
		
		$data['stPerInfo'] = $this->allotment_model->VerifyUserRecordById($regno, $gender);
		
		$data['oraclepic'] = $this->common_model->PictureOracle($regno);
		
	   	$sname = $allotment[0]->STUDENTNAME; 

	   	$fname = $allotment[0]->FATHERNAME; 

	   	$emailsId = $allotment[0]->EMAILID; 

		$data['key'] = $this->allotment_model->getkeyInfo($regno, $gender);
	    
		$data['allotInfo'] = $allotment;
		
		$data['allotemail'] = $this->allotment_model->getAllotmentEmail($emailsId, $gender, $sname);
		
		$data['hostelno'] = $this->uri->segment(5); 

		$data['roomno'] = $this->uri->segment(6); 
       
        $this->global['pageTitle'] = 'IIUI Hostels : Edit Allotment';
        
        $this->loadViews("allotment/editOld", $this->global, $data, NULL);
        
    }
    
     /**
     * This function is used to edit the Allotment information
     */
	function editallotment()
    {   
            
        $this->form_validation->set_rules('seatavilabel','Seat Avilabel','trim|required|xss_clean|max_length[128]');
		$this->form_validation->set_rules('hostelno','Hostel No','trim|required|max_length[10]|xss_clean|numeric');
		$this->form_validation->set_rules('hostelname','Hostel Name','trim|required|max_length[128]|xss_clean');
		$this->form_validation->set_rules('roomno','Room No','trim|required|max_length[128]|xss_clean|numeric');
        $this->form_validation->set_rules('roomname','Room Name','trim|required|xss_clean|max_length[128]');
        $this->form_validation->set_rules('regno','Registration No','required|max_length[128]');
		$this->form_validation->set_rules('studentname','Student Name','required|max_length[128]');
		$this->form_validation->set_rules('fname','Father Name','required|max_length[128]');
		$this->form_validation->set_rules('expdate','Exp Date','required|max_length[128]');
		$this->form_validation->set_rules('alloteddate','Alloted Date','required|max_length[128]');
            
        $allotmentid = $this->input->post('allotmentid');

        if($this->form_validation->run() == FALSE)
        {
            $this->editOld($allotmentid);
        } else {
            $status = $this->input->post('status');
			$seatoccupy = $this->input->post('seatoccupy');
			$regno = $this->input->post('regno');
			$studentname = $this->input->post('studentname');
			$fname = $this->input->post('fname');
			$address = $this->input->post('address');
			$caddress = $this->input->post('caddress');
			$phone = $this->input->post('phone');
			$dob = $this->input->post('dob');
			$dname = $this->input->post('dname');
			$program = $this->input->post('program');
			$faculty = $this->input->post('faculty');
			$cnic = $this->input->post('cnic');
			$district = $this->input->post('district');
			$protittle = $this->input->post('protittle');
			$country = $this->input->post('country');
			$nationality = $this->input->post('nationality');
			$semcode = $this->input->post('semcode');
			$alloted = $this->input->post('alloted');
			$expdate = $this->input->post('expdate');
			$arrdate = $this->input->post('arrdate');
			$depodate = $this->input->post('depodate');
			$feeamount = $this->input->post('feeamount');
			$alloteddate = $this->input->post('alloteddate');
			$allotmentid = $this->input->post('allotmentid');
			$recpno = $this->input->post('recpno');
			$rdues = $this->input->post('rdues');
			$rtype = $this->input->post('rtype');
			$allotstatus = $this->input->post('allotstatus');
			$gender = $this->input->post('gend');
			$appstatus = $this->input->post('appstatus');
			$emailid = $this->input->post('emailid');
			$email = $this->input->post('email');
			$hostelno = $this->input->post('oldhostel');
			$roomno = $this->input->post('oldroom');
			$seatavilabel = $this->input->post('seatavilabel');
			$upstatus = $this->input->post('upstatus');
			$hbatch = $this->input->post('hbatch');
				
			$doorkey = 0; 
			$drawer = ''; 
			$cupboardkey = ''; 
			$matress = ''; 
			$chair = ''; 
			$table = '';
				
			if($gender == 'F')
			{
				$gender = 'Female';
			}
			if($gender == 'M')
			{
				$gender = 'Male';
			}
				
			foreach ($_POST['allotitem'] as $itemnames)
			{ 
				if($itemnames == 'Door')
				{$doorkey = 1;}
				else if($itemnames == 'Cupboard')
				{$cupboardkey = 1;} 
				else if($itemnames == 'Drawer')
				{$drawer = 1;} 
				else if($itemnames == 'Matress')
				{$matress = 1;} 
				else if($itemnames == 'Chair')
				{$chair = 1;} 
				else if($itemnames == 'Table')
				{$table = 1;}    
			}

			$studemailsId = $this->allotment_model->GetAllotEmailIds($emailid);

			if($studemailsId[0]->EMAILID > 1)
			{
				$studentusercreate = array(
				 	'EMAIL'=>$email, 
				 	'GENDER'=>$gender,
				 	'NAME'=>$studentname,
				 	'PASSWORD'=>getHashedPassword(str_replace(' ','',strtolower($studentname))),
				 	'ROLEID'=>4
				 );
				$emailid = $this->allotment_model->CreateNewUser($studentusercreate);
		        $emailid =  $emailid[0]->userId; 
			}
					//exit();
			if(empty($emailid))
			{
				 $studentusercreate = array(
				 	'EMAIL'=>$email, 
				 	'GENDER'=>$gender,
				 	'NAME'=>$studentname,
				 	'PASSWORD'=>getHashedPassword(str_replace(' ','',strtolower($studentname))),
				 	'ROLEID'=>4, 
				 	'createdBy'=>$this->vendorId, 
				 	'createdDtm'=>date('Y-m-d H:i:s')
				 );
				 
				 $emailid = $this->allotment_model->CreateNewUser($studentusercreate);
				 $emailid =  $emailid[0]->userId;
			}
			
			else
			{
				  
				$studemailId = $this->allotment_model->GetExistEmail($emailid);
				 
				$studemail = $studemailId[0]->email; 

				$userid = $studemailId[0]->userId; 
				
				$Updatestudentemail = array(
					'EMAIL'=>$email,
					'name'=>$studentname,
					'mobile'=>$phone
				);
				 
				$this->allotment_model->UpdatestudMail($Updatestudentemail, $emailid);
			}	
				
            $allotmentInfo = array(
            		'SEATID'=>$seatavilabel,
            		'SEATSTATUS'=>$status,
            		'IS_SUBMIT'=>$upstatus, 
            		'GENDER'=>$gender,
            		'STUDENTNAME'=>$studentname,
            		'FATHERNAME'=>$fname, 
            		'QUOTA_TYPE'=>$seatoccupy, 
            		'REGNO'=>$regno, 
            		'ALLOTEDDATE'=> $alloteddate, 
            		'ALLOTED'=>$alloted, 
            		'EXPIRYDATE'=>$expdate, 
            		'ARRIVALDATE'=>$arrdate, 
            		'ADDRESS'=>$address, 
            		'FEEAMOUNT'=>$feeamount, 
            		'DEPOSITDATE'=> $depodate, 
            		'RECEIPTNO'=> $recpno, 
            		'DOORKEYSALLOTED'=>$doorkey, 
            		'CUPBOARDKEYSALLOTED'=>$cupboardkey, 
            		'RDUES'=>$rdues, 
            		'STATUS'=>$allotstatus, 
            		'SEMCODE'=>$semcode, 
            		'GENDER'=>$gender, 
            		'STUDENTPHONE'=>$phone, 
            		'ADMIN_VERIFY'=>$appstatus,
            		'ALLOTTYPE'=>'Alloted', 
            		'EMAILID'=>$emailid,
            		'FACULTY'=>$faculty, 
            		'HOSTELBATCH'=>$hbatch, 
            		'DEPARTNAME'=>$dname,
            		'DISTRICT'=>$district, 
            		'CNIC'=>$cnic,
            		'COUNTRY'=>$country, 
            		'PROTITTLE'=>$protittle, 
            		'CADDRESS'=>$caddress, 
            		'updatedDtm'=>date('d-m-Y H:i:s')
            	);
                
                
                $result = $this->allotment_model->editAllotment($allotmentInfo, $allotmentid);
                
				$studentemail = $this->allotment_model->getstudentemail($gender,$emailid);
				
				$record = $this->allotment_model->GetAllotVerifyById($allotmentid);
				
				$historyexist = $this->allotment_model->GetAllotFromAllotHis($allotmentid);
				
				if(!empty($historyexist[0]->ALLOTMENTHISTORY_ID))
				{
					$updateHInfo = array('EMAILID'=>$emailid);
					
					$this->allotment_model->editAllotmentHis($updateHInfo, $allotmentid);
				}
				
				$allotmentInfo = array('name'=>$studentname, 'email'=>$email,'GENDER'=>$gender);
				
				$record = $record[0]->ADMIN_VERIFY;
			
				if ($studentemail[0]->EMAIL != NULL && $record == 1)
				{ 
					$updatepassword = array('PASSWORD'=>getHashedPassword(str_replace(' ','',strtolower($studentname))));
				
				$this->allotment_model->Updatepassword($updatepassword, $emailid);
					
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
			
				
				$bodyContent = '<h3>Dear Applicant.</h3><br><h3>
Link for Allotment Slip.</h3>';
			  $bodyContent .= '<p style="font-size:14px">Kindly visit on <b> http://usis.iiu.edu.pk:64453/login</b> <strong>to download your Allotment Slip</strong>.<br><strong>Note: </strong>Login with same email ( '.$studentemail[0]->EMAIL.' ) and password ( <b>'.str_replace(' ','',strtolower($studentemail[0]->STUDENTNAME)).'</b> ).Please reset your password after first login to avoid any porblem.  If you forget your password than reset your password on login page (forgot password link).<br><br>If you have any query regarding login and Allotment slip. Email us at:<strong> hostel@iiu.edu.pk</strong>. We will reply you as soon as possible. </p>
				<br/>
				<h3>Best Regards</h3>
				<h4">Provost Office</h4>
				<br/><br/>
				<div style="font-size:smaller;background-color: #3c763d;color: #fff;">This communication contains information that is for the exclusive use of the intended recipient(s). If you are not the intended recipient, disclosure, copying, distribution or other use of, or taking of any action in reliance upon, this communication or the information in it is prohibited and may be unlawful. If you have received this communication in error please notify the sender by return email, delete it from your system and destroy any copies.</div>
				';
		       
				$mail->setFrom('hostel@iiu.edu.pk', 'Admin Hostel IIUI');
				$mail->addReplyTo('no-reply@iiu.edu.pk', 'Admin Hostel IIUI');
				$mail->addAddress($studentemail[0]->EMAIL);   // Add a recipient
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
            if($msg == 'Message has been sent')
            {
                $this->session->set_flashdata('success', 'Seat Allotment Updated successfully. Updated Email and password sent to student by Email');
            }
            else
            {
                $this->session->set_flashdata('success', 'Seat Allotment Updated successfully but Email already sent to student');
            }
                
                redirect('allotment/Allotment/viewAllotmentDetail/'.$hostelno.'/'.$roomno);
            }
        }
    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteallotment()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $allotmentid = $this->input->post('allotmentid');
			
            $result = $this->allotment_model->deleteAllotment($allotmentid);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
	
	 function getroombyHostelId()
    {	 
		 $hostelid = $this->input->post('hostelno');
		 
		 $result = $this->seat_model->getroombyHostelId($hostelid);
		 
		 echo json_encode($result);
		 
    }

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'IIUI Hostels : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}

?>