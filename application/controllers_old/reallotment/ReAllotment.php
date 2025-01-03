<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// ini_set('memory_limit', '-1');
// error_reporting(E_ALL);

//$hostelno = $this->uri->segment(4); 
require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Muhammad Idrees 
 * @version : 2.0
 * @since : 17 November 2022
 */
class ReAllotment extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
		$this->load->model('reallotment_model');
		$this->load->model('seat_model');
		$this->load->model('allotment_model');
		$this->load->model('login_model');		
		$this->load->model('Signup_model');
		$this->load->model('feechallan_model');
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

    function updateKey($regno){

    	$gender = $this->gender;

    	$regno = base64_decode($regno);

    	$data['oraclepic'] = $this->common_model->PictureOracle($regno);

    	$data['userInfo'] = $this->reallotment_model->GetstudInfoReallot($gender,$regno);    	

    	$this->global['pageTitle'] = 'IIUI Hostels : Update Hostel Key and Allotment History';
		
		$this->loadViews("reallotment/update_allotment_key", $this->global, $data, NULL);
    }

    function UpdateKeyAndReallotmentHistory(){

    	$gender = $this->gender;

		$regno = $this->input->post('regno');

		$key = $this->input->post('key');

		$semcode = $this->input->post('semcode');

		$student_data = $this->reallotment_model->GetstudInfoReallot($gender,$regno);

		$hisallotmentInfo =  array(
			'SEATSTATUS' => $student_data[0]->SEATSTATUS, 
			'GENDER' => $gender,
			'STUDENTNAME' => $student_data[0]->STUDENTNAME, 
			'QUOTA_TYPE' => $student_data[0]->QUOTA_TYPE, 
			'REGNO' => $student_data[0]->REGNO, 
			'SEATID' => $student_data[0]->SEATID, 
			'ROOMID' => $student_data[0]->ROOMID, 
			'HOSTELID' =>  $student_data[0]->HOSTELID, 
			'ALLOTTYPE' =>  'ReAlloted', 
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

		$historyExist = $this->reallotment_model->existReallotmentHistory($regno, $semcode, $student_data[0]->STATUS);

		if($historyExist == false){			

			$alotHistId = $this->reallotment_model->InsertHistory($hisallotmentInfo);

			if(empty($alotHistId) || $alotHistId < 1 || $alotHistId == null ){

				$this->session->set_flashdata('error', 'Allotment History is not updated.');
				    
				redirect('reallotment/Reallotment/updateKey/'.base64_encode($regno));
			}
		}

		$randKeyInfo = array(
					'REGNO'=>$regno, 
					'KEY'=>$key, 
					'TYPE'=>'ReAllotment', 
					'GENDER'=> $gender, 
					'SEMCODE'=> $semcode);

		$keyInfo = $this->reallotment_model->addNewAllotmentKey($randKeyInfo);

		if(empty($keyInfo) || $keyInfo < 1 || $keyInfo == null ){

			$this->session->set_flashdata('error', 'Allotment Key is not updated.');
			    
			redirect('reallotment/Reallotment/updateKey/'.base64_encode($regno));
		}

		$this->session->set_flashdata('success', 'Allotment Key and History updated successfully.');
			    
		redirect('reallotment/Reallotment/updateKey/'.base64_encode($regno));

    }
	
	function cancelreallot()
    {
			
		$gender = $this->gender; 
	  
	    $cancelstud = $this->reallotment_model->cancelstudinfo($gender);
		
		foreach($cancelstud as $studinfo)
		{
				  
			$seatid = $studinfo->SEATID;

			$regno = $studinfo->REGNO;

			$updateseat = array('OCCUPIED'=>0);

			$this->reallotment_model->updateseat($updateseat,$seatid,$gender);

			$updatereallot = array('ADMIN_VERIFY'=>2);

			$this->reallotment_model->updatreallotstatus($updatereallot,$regno,$gender);

		}			      
						
		redirect('reallotment/ReAllotment/viewreAllotmentDetail/');
	}
    
    /**
     * This function is used to load the user list
     */
	
    function viewreAllotmentDetail()
    {
        $hostelno = $this->uri->segment(4); 
        $roomno = $this->uri->segment(5);
		
		if(!empty($hostelno))
		
		{
			$hostelno = $this->uri->segment(4);
			
			$roomno = $this->uri->segment(5);
			
		} else {
		
		  $hostelno = $this->input->post('hostelno');
			
		  $roomno = $this->input->post('roomno');
		
		}
		
		$gender = $this->gender;  
		
		$data['viewreallotments'] = $this->reallotment_model->viewreallotmentInfo($gender,$hostelno,$roomno);
		
		$data['roomno'] = $roomno; 
		$data['hostelno'] = $hostelno;
		
		foreach($data['viewreallotments'] as $record)
		{
			$record->HISTORYHOSTELBATCH = $this->reallotment_model->getPrevHostelInfo($record->REGNO)->SEMCODE;
			
		}	
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Re Allotment Details';
		
		$this->loadViews("reallotment/viewreallotment", $this->global, $data, NULL);
        
    }
	
	function view()
    {
		
		$data['HostelRecords'] = $this->reallotment_model->getAllHostelInfo($this->gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Allotment Details';
		
		$this->loadViews("reallotment/view", $this->global, $data, NULL);
        
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
        	//$data['seatdetail'] = $this->reallotment_model->getAllSeatInfo();
			
			$userId = $this->vendorId;
			
			
			$gender = $this->gender;
				
			$data['hosteldetail'] = $this->reallotment_model->getHostelInfo($gender);
			
            $this->global['pageTitle'] = 'IIUI Hostels : Add New Seat';

            $this->loadViews("reallotment/addNewreallotment", $this->global, $data, NULL);
    }
	
	function GetseatInfoById()
    {
        	$seatavilabel = $this->input->post('seatavilabel');
			
			$result = $this->allotment_model->getAllSeatInfoById($seatavilabel);
		 
		    echo json_encode($result);   
    }
	
	function VerifyUserRecord()
    {
        	$regno = $this->input->post('regno');
			
			$userId = $this->vendorId;
			
			
			$gender = $this->gender;
			
			$result = $this->reallotment_model->VerifyUserRecordExisted($regno, $gender);
			
			$resultblack = $this->reallotment_model->VerifyUserRecordBlackList($regno, $gender);
			
			if($result != 'true' && $resultblack != 'true')
			{
			
			  $result = $this->reallotment_model->VerifyUserRecordById($regno, $gender);
			}
		   if($result != '')
		   {
		    echo json_encode($result);  
		   }
		   else
		    echo json_encode($resultblack);
    }
    
    /**
     * This function is used to add new user to the system
     */
    function addNewreallotment()
    {       
            
		$this->form_validation->set_rules('hostelno','Hostel No','trim|required|max_length[10]|xss_clean|numeric');
		$this->form_validation->set_rules('hostelname','Hostel Name','trim|required|max_length[60]|xss_clean');
		$this->form_validation->set_rules('roomno','Room No','trim|required|max_length[30]|xss_clean|numeric');
        $this->form_validation->set_rules('roomname','Room Name','trim|required|xss_clean|max_length[128]');
        $this->form_validation->set_rules('regno','Registration No','required|max_length[128]');
		$this->form_validation->set_rules('studentname','Student Name','required|max_length[128]');
		$this->form_validation->set_rules('expdate','Exp Date','required|max_length[128]');
		$this->form_validation->set_rules('arrdate','Arrival Date','required|max_length[128]');
			
        $allotid = $this->input->post('allotid');
            
        if($this->form_validation->run() == FALSE)
        {
           $this->editOld($allotid);
        } else {

            $status = $this->input->post('status');
			$quotatype = $this->input->post('quotatype');
			$hostelid = $this->input->post('hostelno');
			$roomid = $this->input->post('roomno');
			$seatid = $this->input->post('seatavilabel');
			$regno = $this->input->post('regno');
			$studentname = $this->input->post('studentname');
			$fathername = $this->input->post('fname');
			$address = $this->input->post('address');
			$phone = $this->input->post('phone');
			$allotstatus = $this->input->post('allotstatus');
			$deptname = $this->input->post('dname');
			$protittle = $this->input->post('protittle');
			$batchname = $this->input->post('$batchname');
			$programe = $this->input->post('programe');
			$faculty = $this->input->post('faculty');
			$nationality = $this->input->post('nationality');
			$gender = $this->input->post('gend');
			$cnic = $this->input->post('cnic');
			$province = $this->input->post('province');
			$district = $this->input->post('district');
			$country = $this->input->post('country');
			$preadd = $this->input->post('preadd');
			$emailid = $this->input->post('emailid');
			$email = $this->input->post('email');
			$semcode = strtoupper($this->input->post('semcode'));
			$alloted = $this->input->post('alloted');
			$expdate = $this->input->post('expdate');
			$arrdate = $this->input->post('arrdate');
			$depodate = $this->input->post('depodate');
			$feeamount = $this->input->post('feeamount');
			$alloteddate = $this->input->post('alloteddate');
			$recpno = $this->input->post('recpno');
			$rdues = $this->input->post('rdues');
			$remarks = $this->input->post('remarks');
			$key = strtoupper($this->input->post('key'));
			$statustype = $this->input->post('statustype');
			$allotitem = $this->input->post('allotitem');
			$defaultid = $this->input->post('defafultid');
			$allotid = $this->input->post('allotid');
			$id = $this->input->post('id');
			$reverttype = $this->input->post('reverttype');
			$seatavilabel = $this->input->post('seatavilabel');
			$hbatch = $this->input->post('hbatch');

			if(isset($id) && !empty($id))
			{
				$urlid = $id;
			}

            $doorkey = '1';

            $drawer = '1'; 

            $cupboardkey = '1'; 

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
					
			if($gender == 'F')
			{
				$gender = 'Female';
			}
					
			$batchinfo = $this->reallotment_model->GetBatchname($regno);
					
			$batchname = $batchinfo[0]->BATCHNAME;			
					
			$seatalloted = $this->reallotment_model->Seatstatus($seatavilabel, $gender, $regno);

			if(!empty($seatalloted)){				
			
				if($seatalloted[0]->OCCUPIED == 1 && ($seatalloted[0]->ADMIN_VERIFY == 2 || $seatalloted[0]->ADMIN_VERIFY == 1))
				{
					$this->session->set_flashdata('error', 'Seat already alloted to other student.');
					redirect('reallotment/ReAllotment/revertAllallot/'.$id);
				}
			}
				
			$blacklistexisted = $this->reallotment_model->BlackList_exists_against_Regno($regno, $gender);
				
			if($blacklistexisted == true && $reverttype != 'blacklist')
			{
				if(isset($id) && !empty($id))
				{
					$urlid = $id;
								
					$this->session->set_flashdata('error', 'This Studuent is Black List.');
					
					redirect('reallotment/ReAllotment/revertAllallot/'.$urlid);
				} else {

					$this->session->set_flashdata('error', 'This Studuent is Black List.');
					
					redirect('reallotment/ReAllotment/addNew');
				}
					
			}
				
			$Seatexisted = $this->reallotment_model->seat_exists_against_Regno($regno);
				
			if($Seatexisted == true)
			{
				if(isset($id) && !empty($id))
				{
					$urlid = $id;
								
					$this->session->set_flashdata('error', 'This seat already ReAlloted against selected Registration Number in Database.');
					
					redirect('reallotment/ReAllotment/revertAllallot/'.$urlid);
				} else {
					
					$this->session->set_flashdata('error', 'This seat already ReAlloted against selected Registration Number in Database.');
					
					redirect('reallotment/ReAllotment/addNew');
				}
			} else {

				if(!empty($email))
				{
				   $EmailExist = $this->reallotment_model->Email_exists($email,$emailid,$gender);
				}
				else
				{
					$EmailExist = $this->reallotment_model->Emailid_exists($emailid);
				}
			
				if($EmailExist != true)
				{
					if(isset($id) && !empty($id))
					{
						$urlid = $id;
								
						$this->session->set_flashdata('error', 'This Email is not Existed in IIUI Hostel, Please make new User Registration.');
					    redirect('reallotment/ReAllotment/revertAllallot/'.$urlid);
					} else {
					
						$this->session->set_flashdata('error', 'This Email is not Existed in IIUI Hostel, Please make new User Registration.');
					
						redirect('reallotment/ReAllotment/addNew');
					}
				} else {

					if(!empty($email))
					{
				  
						$EmailIds = $this->reallotment_model->GetEmailId($email,$gender);
					
						$emailid = $EmailIds[0]->userId;
				  	}

					$feepath = 'uploads/feeslip/';
		            $reallotmentInfo = array(
		            	'SEATSTATUS'=>$status,
		            	'REGNO'=>$regno,
		            	'STUDENTNAME'=>$studentname,
		            	'STUDENTPHONE'=>$phone,
		            	'FATHERNAME'=>$fathername, 
		            	'ADDRESS'=>$address, 
		            	'GENDER'=> $gender, 
		            	'DOORKEYSALLOTED'=>$doorkey,
		            	'CUPBOARDKEYSALLOTED'=>$cupboardkey, 
		            	'SEATID'=>$seatid, 
		            	'ROOMID'=>$roomid,
		            	'HOSTELID'=>$hostelid, 
		            	'ALLOTED'=>$alloted, 
		            	'ALLOTTYPE'=>$allotstatus,
		            	'ALLOTEDDATE'=>$alloteddate,
		            	'EXPIRYDATE'=>$expdate,
		            	'ARRIVALDATE'=>$arrdate,
		            	'FEEAMOUNT'=>$feeamount, 
		            	'FEEPATH'=>$feepath, 
		            	'FEEPIC'=>'NULL', 
		            	'DEPOSITDATE'=>$depodate,
		            	'RECEIPTNO'=>$recpno,
		            	'STATUS'=>$statustype,
		            	'RDUES'=>$rdues,
		            	'SEMCODE'=>$semcode,
		            	'QUOTA_TYPE'=>$quotatype,
		            	'IS_SUBMIT'=>1,
		            	'ADMIN_VERIFY'=>1, 
		            	'EMAILID'=>$emailid, 
		            	'CADDRESS'=>$preadd,
		            	'COUNTRY'=>$country,
		            	'NATIONALITY'=>$nationality,
		            	'PROTITTLE'=>$protittle,
		            	'PROGRAME'=>$programe,
		            	'BATCHNAME'=>$batchname,
		            	'HOSTELBATCH'=>$hbatch,
		            	'DISTRICT'=>$district,
		            	'PROVINCE'=>$province, 
		            	'CNIC'=>$cnic, 
		            	'DEPARTNAME'=>$deptname,
		            	'FACULTY'=>$faculty,
		            	'REMARKS'=>$remarks,  
		            	'UPDATEDDTM'=>date('d-m-Y H:i:s'));
            
					$reallotitemInfo = array(
						'REGNO'=>$regno,
						'DOORKEYSALLOTED'=>$doorkey,
						'CUPBOARDKEYSALLOTED'=>$cupboardkey,
						'DRAWKEYS'=>$drawer,
						'MATRESS'=>$matress, 
						'CHAIR'=>$chair, 
						'TABLES'=> $table, 
						'GENDER'=> $gender);


					$insertStudentInfo = array(
                    'student_name' => $studentname,
                    'regno' => $regno,
                    'gender' => $gender,
                    'cnic' => $cnic,
                    'student_email' => $email
                );

                $userAdded = $this->importdata_model->addNewUser($insertStudentInfo);



            
					$historyInfo = $reallotmentInfo; 

					$allotmentInfo = $reallotmentInfo;
			
					if($allotstatus == 'REALLOTED' || $allotstatus == 'REALLOTMENT')
					{
					   $result = $this->reallotment_model->addNewReAllotment($reallotmentInfo);
					} else {
						$result = $this->allotment_model->addNewAllotment($allotmentInfo); 
					}
			
					$result = $this->reallotment_model->InsertHistory($historyInfo);
					
					$item = $this->reallotment_model->addNewItems($reallotitemInfo);
					
					$missuser = $this->reallotment_model->getAllmissemail($regno, $gender);
			
					if(!empty($missuser[0]->STUDENTNUMBER))
					{
					    $missmobile = $missuser[0]->STUDENTNUMBER;
					} else {
						$missmobile = $phone;
					}

					$updateregno = array(
						'regno'=>$regno, 
						'mobile'=>$missmobile);
			
					$result = $this->reallotment_model->UpdatedregnoinUser($updateregno, $emailid);
	               
				    $updateseatstatus = array('OCCUPIED'=>'1');

				    $search = 'phd';

					if(preg_match("/{$search}/i", $regno) && $gender == 'Male') {
					    $result = $this->clearance_model->UpdatedRoomStatus($updateseatstatus,$roomid);	
					}else{
				    
				    	$result = $this->reallotment_model->UpdatedSeatStatus($updateseatstatus,$seatid);

				    		//Get Room ID, Hostel ID using seat id

				    $room_detail = $this->seat_model->gerRoomBySeatID($seatid);

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
					
					$randKeyInfo = array(
						'REGNO'=>$regno, 
						'KEY'=>$key, 
						'TYPE'=>'ReAllotment', 
						'GENDER'=> $gender, 
						'SEMCODE'=>strtoupper($semcode)
					);
			
					$this->reallotment_model->addNewAllotmentKey($randKeyInfo);
					
					$results = $this->reallotment_model->DelFromDefault($gender,$defaultid);
					
					$results = $this->reallotment_model->DelFromAllotReallot($gender,$regno);
					
				}
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Re-Allotment Done successfully & student remove from defaulter List');
                } else {
                    $this->session->set_flashdata('error', 'Re-Allotment creation failed');
                }
		
                if($reverttype == 'blacklist')
				{
					$results = $this->reallotment_model->DelFromBlacklist($gender,$regno);
					  
					redirect('blacklist/blacklist/blacklistdetail'); 
				} else {
					   redirect('report/reports/viewallallot');
				}
            }
		}
 	}
		
	
	 function addNewDefaulterreallotment()
    {
       
            $this->load->library('form_validation');
            
			$this->form_validation->set_rules('hostelno','Hostel No','trim|required|max_length[10]|xss_clean|numeric');
			$this->form_validation->set_rules('hostelname','Hostel Name','trim|required|max_length[60]|xss_clean');
			$this->form_validation->set_rules('roomno','Room No','trim|required|max_length[30]|xss_clean|numeric');
            $this->form_validation->set_rules('roomname','Room Name','trim|required|xss_clean|max_length[128]');
            $this->form_validation->set_rules('regno','Registration No','required|max_length[128]');
			$this->form_validation->set_rules('studentname','Student Name','required|max_length[128]');
			$this->form_validation->set_rules('expdate','Exp Date','required|max_length[128]');
			$this->form_validation->set_rules('arrdate','Arrival Date','required|max_length[128]');
			$this->form_validation->set_rules('email','Email','required|max_length[128]');
            $allotid = $this->input->post('allotid');
            
            if($this->form_validation->run() == FALSE)
            {
               $this->session->set_flashdata('error', 'Email is required that registed with IIUI Hostel System.');
			   redirect('reallotment/ReAllotment/reverallotmentdetail/'.$allotid);
            }
            else
            {
                $status = $this->input->post('status');
				$quotatype = $this->input->post('quotatype');
				$hostelid = $this->input->post('hostelno');
				$roomid = $this->input->post('roomno');
				$seatid = $this->input->post('seatavilabel');
				$regno = $this->input->post('regno');
				$studentname = $this->input->post('studentname');
				$fathername = $this->input->post('fname');
				$address = $this->input->post('address');
				$phone = $this->input->post('phone');
				$allotstatus = $this->input->post('allotstatus');
				$deptname = $this->input->post('dname');
				$program = $this->input->post('program');
				$faculty = $this->input->post('faculty');
				$nationality = $this->input->post('nationality');
				$gender = $this->input->post('gender');
				$cnic = $this->input->post('cnic');
				$province = $this->input->post('province');
				$district = $this->input->post('district');
				$country = $this->input->post('country');
				$preadd = $this->input->post('preadd');
				$emailid = $this->input->post('emailid');
				$email = $this->input->post('email');
				$semcode = $this->input->post('semcode');
				$alloted = $this->input->post('alloted');
				$expdate = $this->input->post('expdate');
				$arrdate = $this->input->post('arrdate');
				$depodate = $this->input->post('depodate');
				$feeamount = $this->input->post('feeamount');
				$alloteddate = $this->input->post('alloteddate');
				$recpno = $this->input->post('recpno');
				$rdues = $this->input->post('rdues');
				$statustype = $this->input->post('statustype');
				$allotitem = $this->input->post('allotitem');
				$defaultid = $this->input->post('defafultid');
				$allotid = $this->input->post('allotid');

                $doorkey = '1'; $drawer = ''; $cupboardkey = ''; $matress = ''; $chair = ''; $table = '';
				
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
					
					$blacklistexisted = $this->reallotment_model->BlackList_exists_against_Regno($regno, $gender);
				
				if($blacklistexisted == true)
					{
						$this->session->set_flashdata('error', 'This Studuent is Black List.');
						
						redirect('reallotment/ReAllotment/reverallotmentdetail/'.$allotid);
					}
				
				$Seatexisted = $this->reallotment_model->seat_exists_against_Regno($regno);
				
				if($Seatexisted == true)
					{
						$this->session->set_flashdata('error', 'This seat already Re-Alloted or Alloted against selected Registration Number.');
						
						redirect('reallotment/ReAllotment/reverallotmentdetail/'.$allotid);
					}
					
				else
			{
				
				$EmailExist = $this->reallotment_model->Email_exists($email,$gender);
				if($EmailExist != true)
					{
						$this->session->set_flashdata('error', 'This Email is not Existed in IIUI Hostel, Please make new User Registration.');
						
						redirect('reallotment/ReAllotment/reverallotmentdetail/'.$allotid);
					}
			    else{
					
					$EmailIds = $this->reallotment_model->GetEmailId($email,$gender);
					
					$emailid = $EmailIds[0]->userId;
                
            $reallotmentInfo = array('SEATSTATUS'=>$status,'REGNO'=>$regno,'STUDENTNAME'=>$studentname,'STUDENTPHONE'=>$phone,'FATHERNAME'=>$fathername, 'ADDRESS'=>$address, 'GENDER'=> $gender, 'SEATID'=>$seatid, 'ROOMID'=>$roomid,'HOSTELID'=>$hostelid, 'ALLOTED'=>$alloted, 'ALLOTTYPE'=>$allotstatus,'ALLOTEDDATE'=>$alloteddate,'EXPIRYDATE'=>$expdate,'ARRIVALDATE'=>$arrdate,'FEEAMOUNT'=>$feeamount,'DEPOSITDATE'=>$depodate,'RECEIPTNO'=>$recpno,'STATUS'=>$statustype,'RDUES'=>$rdues,'SEMCODE'=>$semcode,'QUOTA_TYPE'=>$quotatype,'IS_SUBMIT'=>1,'ADMIN_VERIFY'=>1, 'EMAILID'=>$emailid, 'CADDRESS'=>$preadd,'COUNTRY'=>$country,'NATIONALITY'=>$nationality,'PROTITTLE'=>$program,'DISTRICT'=>$district,'PROVINCE'=>$province, 'CNIC'=>$cnic, 'DEPARTNAME'=>$deptname,'FACULTY'=>$faculty);
                
				$reallotitemInfo = array('REGNO'=>$regno,'DOORKEYSALLOTED'=>$doorkey,'CUPBOARDKEYSALLOTED'=>$cupboardkey,'DRAWKEYS'=>$drawer,'MATRESS'=>$matress, 'CHAIR'=>$chair, 'TABLES'=> $table);
                
                $result = $this->reallotment_model->addNewReAllotment($reallotmentInfo);
				
				$item = $this->reallotment_model->addNewItems($reallotitemInfo);
               
			    $updateseatstatus = array('OCCUPIED'=>$alloted);
			    
			    $result = $this->reallotment_model->UpdatedSeatStatus($updateseatstatus,$seatid);
				
				$results = $this->reallotment_model->DelFromDefault($gender,$defaultid);
			}
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Re-Allotment Done successfully & student remove from defaulter List');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Re-Allotment creation failed');
                }
			
                
                redirect('reallotment/ReAllotment/ViewDefaulter');
            }
		}
     }
    

    
    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($AllotID = NULL)
    {
        
            if($AllotID == null)
            {
                redirect('reallotment/ReAllotment/viewreAllotmentDetail');
            }
			
			$userId = $this->vendorId;
			
			
			$gender = $this->gender;
			
			$data['hosteldetail'] = $this->reallotment_model->getAllHostelInfo($gender);
			
            $hostelno = $this->reallotment_model->getReAllotmentInfobyId($AllotID, $gender);
			
			$hostelid = $hostelno[0]->HOSTELID;
			
			$roomid = $hostelno[0]->ROOMID;
			
			$regno = $hostelno[0]->REGNO;
           
		    $data['roomdetail'] = $this->reallotment_model->getAllRoomInfo($hostelid, $gender);
			
			$data['seatdetail'] = $this->reallotment_model->getAllSeatInfo($roomid, $gender);
			
			$data['prehistory'] = $this->reallotment_model->getPrevHostelInfo($regno);
			
			$data['stPerInfo'] = $this->reallotment_model->VerifyUserRecordById($regno, $gender);
			
			$data['stDetailInfo'] = $this->reallotment_model->VerifyUserRecordByOracleDb($regno, $gender);
			
			$name = $this->reallotment_model->getAllotmentInfobyId($AllotID, $gender);
		   
		   	$sname = $name[0]->STUDENTNAME; $regno = $name[0]->REGNO; $emailid = $name[0]->EMAILID; 
		    
			$data['allotInfo'] = $this->reallotment_model->getAllotmentInfobyId($AllotID, $gender);
			
			$data['FeeInfo'] = $this->reallotment_model->GetReallotFee($AllotID, $gender);
			
			$data['arrivaldate'] = $this->reallotment_model->GetArrivalinfo($regno, $gender);
			
			$data['key'] = $this->reallotment_model->getkeyInfo($regno, $gender);
			
			$HisId = $this->reallotment_model->getReallotpicId($AllotID, $gender);
			
			//$idhispic = $HisId[0]->REGNO;
			
			//$data['ReallotPic'] = $this->reallotment_model->getReallotpic($idhispic, $gender);
			
			$allemail = $this->reallotment_model->getAllotmentEmail($sname,$regno, $gender);
			
			if(empty($allemail))
			  {
				  $missuser = $this->reallotment_model->getAllmissemail($regno, $gender);
				  $studname = $missuser[0]->STUDENTNAME; $studemail = $missuser[0]->STUDENTEMAIL; 
				  $studgender = $missuser[0]->GENDER;
				  $studnumber = $missuser[0]->STUDENTNUMBER; $regno = $missuser[0]->REGNO;
				  
				  if(empty($regno))
				    {
						$regno = $hostelno[0]->REGNO;
						
						$missuser = $this->reallotment_model->VerifyUserRecordByOracleDb($regno, $gender);
						
						$studname = $missuser[0]->STUDENTNAME;  
						
						$studnumber = $missuser[0]->STUDENTNUMBER; 
						
						$regno = $missuser[0]->REGNO; $studgender = $gender; $studemail = rand(1000,9999).'_abc@iiu.edu.pk';
						
					}
				  $studentusercreate = array('EMAIL'=>$studemail, 'GENDER'=>$studgender,'NAME'=> $studname,'PASSWORD'=>getHashedPassword(str_replace(' ','',strtolower($studname))),'ROLEID'=>4, 'mobile'=>$studnumber, 'createdBy'=>1, 'regno'=>$regno);
				 
				 $emailid = $this->reallotment_model->CreateNewUser($studentusercreate);
				 $emailid =  $emailid[0]->userId;
				 $data['emailid'] = $emailid;
			  }
			
			$data['oraclepic'] = $this->common_model->PictureOracle($regno);
			
			$data['allotemail'] = $this->reallotment_model->getAllotmentEmail($sname,$regno, $gender);
			
			$data['missemail'] = $this->reallotment_model->getAllmissemail($regno, $gender);
			
			$data['seminfo'] = $this->reallotment_model->GetsemInfo($gender);
			
			$data['Allseminfo'] = $this->reallotment_model->Getsemester($gender);
			
			$data['hostelno'] = $this->uri->segment(5); $data['roomno'] = $this->uri->segment(6); 

			//print_r($data);
			//ext();
           
            $this->global['pageTitle'] = 'IIUI Hostels : Edit Re-Allotment';
            
            $this->loadViews("reallotment/editOld", $this->global, $data, NULL);
        
    }
    /**
     * This function is used to edit the Allotment information
     */

    





	function editreallotment()
    {          
            
        $this->form_validation->set_rules('seatavilabel','Seat Avilabel','trim|required|xss_clean|max_length[128]');
		$this->form_validation->set_rules('hostelno','Hostel No','trim|required|max_length[10]|xss_clean');
		$this->form_validation->set_rules('hostelname','Hostel Name','trim|required|max_length[128]|xss_clean');
		$this->form_validation->set_rules('roomno','Room No','trim|required|max_length[128]|xss_clean|numeric');
        $this->form_validation->set_rules('roomname','Room Name','trim|required|xss_clean|max_length[128]');
        $this->form_validation->set_rules('regno','Registration No','required|max_length[128]');
		$this->form_validation->set_rules('studentname','Student Name','required|max_length[128]');
		$this->form_validation->set_rules('fname','Father Name','required|max_length[128]');
		$this->form_validation->set_rules('expdate','Exp Date','required|max_length[128]');
		$this->form_validation->set_rules('alloteddate','Alloted Date','required|max_length[128]');
            
            
        if($this->form_validation->run() == FALSE)
        {
            $this->addNew();
        } else
        {
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
			$batchname = $this->input->post('batchname');
			$faculty = $this->input->post('faculty');
			$cnic = $this->input->post('cnic');
			$district = $this->input->post('district');
			$nationality = $this->input->post('nationality');
			$province = $this->input->post('province');
			$semcode = $this->input->post('semcode');
			$alloted = $this->input->post('alloted');
			$expdate = $this->input->post('expdate');
			$arrdate = $this->input->post('arrdate');
			$depodate = $this->input->post('depodate');
			$feeamount = $this->input->post('feeamount');
			$alloteddate = $this->input->post('alloteddate');
			$reallotmentid = $this->input->post('reallotmentid');
			$recpno = $this->input->post('recpno');
			$rdues = $this->input->post('rdues');
			$rtype = $this->input->post('rtype');
			$allotstatus = $this->input->post('allotstatus');
			$gender = $this->input->post('gend');
			$appstatus = $this->input->post('appstatus');
			$emailid = $this->input->post('emailid');
			$email = $this->input->post('email');
			$key = strtoupper($this->input->post('key'));
			$remarks = $this->input->post('remarks');
			$hostelno = $this->input->post('hostelno');
			$roomno = $this->input->post('roomno');
			$seatavilabel = $this->input->post('seatavilabel');
			$upstatus = $this->input->post('upstatus');
			$protittle = $this->input->post('protittle');
			$country = $this->input->post('country');
			$preadd = $this->input->post('preadd');
			$hbatch = $this->input->post('hbatch');
			$seatid = $seatavilabel;				
			$doorkey = '1'; 
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
				if($itemnames == 'Door'){
					$doorkey = 1;
				} else if($itemnames == 'Cupboard'){
					$cupboardkey = 1;
				} else if($itemnames == 'Drawer'){
					$drawer = 1;
				} else if($itemnames == 'Matress'){
					$matress = 1;
				} else if($itemnames == 'Chair'){
					$chair = 1;
				} else if($itemnames == 'Table'){
					$table = 1;
				}    
			} 
			$seatalloted = $this->reallotment_model->Seatstatus($seatavilabel, $gender, $regno);

			$seatexistavail = $this->reallotment_model->SeatExistAvail($seatavilabel);

			//var_dump($seatexistavail);			
			
			if(empty($seatexistavail) || $seatexistavail == '')
			{
				$this->session->set_flashdata('error', 'Seat not Exist. Please Create Seat First');

				redirect('reallotment/ReAllotment/editOld/'.$reallotmentid);
			}
			 
			if($seatalloted[0]->OCCUPIED == 1 && ($seatalloted[0]->ADMIN_VERIFY == 2 || $seatalloted[0]->ADMIN_VERIFY == 1) ){

				$this->session->set_flashdata('error', 'Seat already alloted to other student.');

				redirect('reallotment/ReAllotment/editOld/'.$reallotmentid);				
			}
				
			if(empty($emailid))
			{
				 $studentusercreate = array(
				 	'EMAIL'=>$email, 
				 	'GENDER'=>$gender,
				 	'NAME'=>$studentname,
				 	'PASSWORD'=>getHashedPassword(str_replace(' ','',strtolower($studentname))),
				 	'ROLEID'=>4);
				 
				 $emailid = $this->reallotment_model->CreateNewUser($studentusercreate);
				 $emailid =  $emailid[0]->userId;
			} else {
				$existedemailid = $this->reallotment_model->GetEmailId($email,$gender);
				
				if($emailid != $existedemailid[0]->userId)
				{
					$this->session->set_flashdata('error', 'Email with Email id not match. Enter same email id which is in user module or create new email for user.');
					redirect('reallotment/ReAllotment/editOld/'.$reallotmentid);
				}
			}
				
			$UpdateEmail = array('email'=>$email);	
            $reallotmentInfo = array(
            	'HOSTELID' => $hostelno,
            	'ROOMID' => $roomno,
            	'SEATID' => $seatavilabel,
            	'SEATSTATUS' => $status,
            	'IS_SUBMIT' => $upstatus, 
            	'GENDER' => $gender,
            	'STUDENTNAME' => $studentname,
            	'FATHERNAME' => $fname, 
            	'QUOTA_TYPE' => $seatoccupy, 
            	'REGNO' => $regno, 
            	'ALLOTEDDATE' =>  $alloteddate, 
            	'ALLOTED' => $alloted, 
            	'EXPIRYDATE' => $expdate, 
            	'ARRIVALDATE' => $arrdate, 
            	'ADDRESS' => $address, 
            	'FEEAMOUNT' => $feeamount, 
            	'DEPOSITDATE' =>  $depodate, 
            	'RECEIPTNO' =>  $recpno, 
            	'DOORKEYSALLOTED' => $doorkey, 
            	'CUPBOARDKEYSALLOTED' => 1, 
            	'RDUES' => $rdues, 
            	'STATUS' => $allotstatus, 
            	'SEMCODE' => $semcode, 
            	'GENDER' => $gender, 
            	'STUDENTPHONE' => $phone, 
            	'ADMIN_VERIFY' => $appstatus,
            	'ALLOTTYPE' => 'ReAlloted', 
            	'EMAILID' => $emailid,
            	'FACULTY' => $faculty, 
            	'DEPARTNAME' => $dname,
            	'DISTRICT' => $district,
            	'NATIONALITY' => $nationality,
            	'PROVINCE' => $province, 
            	'CNIC' => $cnic,
            	'COUNTRY' => $country,
            	'CADDRESS' => $preadd, 
            	'PROTITTLE' => $protittle, 
            	'CADDRESS' => $caddress, 
            	'BATCHNAME' => $batchname, 
            	'PROGRAME' => $program,
            	'REMARKS' => $remarks,
            	'HOSTELBATCH' => $hbatch, 
            	'updatedDtm' => date('d-m-Y H:i:s'));
               
			$historyInfo = array(
			   	'HOSTELID' => $hostelno,
			   	'ROOMID' => $roomno,
			   	'SEATID' => $seatavilabel,
			   	'SEATSTATUS' => $status,
			   	'IS_SUBMIT' => $upstatus, 
			   	'GENDER' => $gender,
			   	'STUDENTNAME' => $studentname,
			   	'FATHERNAME' => $fname, 
			   	'QUOTA_TYPE' => $seatoccupy, 
			   	'REGNO' => $regno, 
			   	'ALLOTEDDATE' =>  $alloteddate, 
			   	'ALLOTED' => $alloted, 
			   	'EXPIRYDATE' => $expdate, 
			   	'ARRIVALDATE' => $arrdate, 
			   	'ADDRESS' => $address, 
			   	'FEEAMOUNT' => $feeamount, 
			   	'DEPOSITDATE' =>  $depodate, 
			   	'RECEIPTNO' =>  $recpno, 
			   	'DOORKEYSALLOTED' => $doorkey, 
			   	'CUPBOARDKEYSALLOTED' => 1, 
			   	'RDUES' => $rdues, 
			   	'STATUS' => $allotstatus, 
			   	'SEMCODE' => $semcode, 
			   	'GENDER' => $gender, 
			   	'STUDENTPHONE' => $phone, 
			   	'ADMIN_VERIFY' => $appstatus,
			   	'ALLOTTYPE' => 'ReAlloted', 
			   	'EMAILID' => $emailid,
			   	'FACULTY' => $faculty, 
			   	'DEPARTNAME' => $dname,
			   	'DISTRICT' => $district,
			   	'NATIONALITY' => $nationality,
			   	'PROVINCE' => $province, 
			   	'CNIC' => $cnic,
			   	'COUNTRY' => $country,
			   	'CADDRESS' => $preadd, 
			   	'PROTITTLE' => $protittle, 
			   	'CADDRESS' => $caddress, 
			   	'BATCHNAME' => $batchname, 
			   	'PROGRAME' => $program,
			   	'REMARKS' => $remarks, 
			   	'HOSTELBATCH' => $hbatch,
			   	'updatedDtm' => date('d-m-Y H:i:s'));
                
            $result = $this->reallotment_model->editreAllotment($reallotmentInfo, $reallotmentid);
				
			$result = $this->reallotment_model->UpdatereAllotmentEmail($UpdateEmail, $emailid);
				
			$result = $this->reallotment_model->InsertHistory($historyInfo);
            
			$studentemail = $this->reallotment_model->getstudentemail($gender,$studentname);
			
			$record = $this->reallotment_model->GetAllotVerifyById($reallotmentid);
			
			
			

			if($appstatus == 2){

				$updateseat = array('OCCUPIED'=>0);
			
				$result = $this->reallotment_model->updateseat($updateseat,$seatid,$gender);

			}else{
				$updateseat = array('OCCUPIED'=>1);
			
				$result = $this->reallotment_model->updateseat($updateseat,$seatid,$gender);
			}
			
			$updateregno = array('regno'=>$regno);
			
			$result = $this->reallotment_model->UpdatedregnoinUser($updateregno, $emailid);
				
			$randKeyInfo = array(
					'REGNO'=>$regno, 
					'KEY'=>$key, 
					'TYPE'=>'ReAllotment', 
					'GENDER'=> $gender, 
					'SEMCODE'=>strtoupper($semcode)
				);
			
			$keyz = $this->reallotment_model->KeyExist($regno, $key, $gender, $semcode);
			
			$id = $keyz[0]->ID;
			
			if(!empty($keyz[0]->ID))
			{
				 $this->reallotment_model->UpdateAllotmentKey($randKeyInfo, $id); 
			} else {
				$this->reallotment_model->addNewAllotmentKey($randKeyInfo);
			}
				
			$record = $record[0]->ADMIN_VERIFY;
			
			if ($studentemail[0]->EMAIL != NULL && $record == 1)
			{ 
				$updatepassword = array('PASSWORD'=>getHashedPassword(str_replace(' ','',strtolower($studentname))));
				
				$this->reallotment_model->Updatepassword($updatepassword, $emailid);
					
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
                $mail->Password = 'islamabad12';   
			
				
				$bodyContent = '<h3>Dear Applicant.</h3><br><h3>
Congratulations! your Re-Allotment for IIUI Hostel Campus Done Successfully.</h3>';
			  	$bodyContent .= '<p style="font-size:14px">Kindly visit on <b> http://usis.iiu.edu.pk:64453/login</b> <strong>to download your Allotment Slip</strong>.<br><strong>Note: </strong>Login with same email ( '.$studentemail[0]->EMAIL.' ) and password <b>'.str_replace(' ','',strtolower($studentemail[0]->STUDENTNAME)).'</b>.Please reset your password after first login to avoid any porblem.  If you forget your password than reset your password on login page (forgot password link).<br><br>If you have any query regarding login and Allotment slip. Email us at:<strong> hostel@iiu.edu.pk</strong>. We will reply you as soon as possible. </p>
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
            if($msg == 'Message has been sent') {

                $this->session->set_flashdata('success', 'Seat Re-Allotment Updated successfully. Updated Email and password sent to student by Email');
            } else {

                $this->session->set_flashdata('success', 'Seat Re-Allotment Updated successfully but Email already sent to student');
            }
                
        redirect('reallotment/ReAllotment/viewreAllotmentDetail/'.$hostelno.'/'.$roomno);
        }
    }
    
	function getroombyHostelId()
    {	 
		 $hostelid = $this->input->post('hostelno');
		 
		 $result = $this->seat_model->getroombyHostelId($hostelid);
		 
		 echo json_encode($result);
		 
    }
	
	 public function studentreallotapply()
    {
		$userId = $this->vendorId;
			
			
     	$gender = $this->gender;
		
		$studregno = $this->session->userdata('studregno');
		
		$genders = $this->reallotment_model->GetstudInfoByRegNoId($studregno);
		
		$gender = $genders[0]->GENDER;

		//var_dump($studregno);
		
		if($gender == 'M')
		  {
			  $gender = 'Male';
		  }
		elseif($gender == 'F')
		{
			$gender = 'Female';
		}
		//echo $gender;
		$semcode = $this->reallotment_model->GetReallotsemInfo($gender);

		//var_dump($semcode);

		//exit();
		
		if(empty($semcode))
		{
			$data['status'] = 'close';			
			
			$this->global['pageTitle'] = 'IIUI Hostels : Re-Allotment Close1';
			
			$this->loadViews("reallotment/studentreallotclose", $this->global, $data , NULL);
		}
		else
		{
			/*
			$studInfo = $this->reallotment_model->GetstudInfoByUId($gender,$userId);
			$programe = $studInfo[0]->PROTITTLE;  $departname = $studInfo[0]->DEPARTNAME;
			$studReallotInfo = $this->reallotment_model->GetstudReallotInfoByUId($gender,$semcode,$programe);
			$Reallotprog = $studReallotInfo[0]->PROTITTLE;
			$ReallotSemcode = $studReallotInfo[0]->SEMCODE;
			$lastreallotsemcode = substr($studReallotInfo[0]->SEMCODE,-2);
			$laststudreg = substr($studInfo[0]->REGNO,-2);
			$regno = $studInfo[0]->REGNO;
			$studsem = substr($regno,-3);
			*/
			//exit();
			
			//  ---------------------------------CHECK FOR REALLOTMENT Apply ---------------------------------------------------
			
			
/*			if ($programe == 'MS' || $programe == 'MSC'  || $programe == 'MA' || $programe == 'LLM')
			{
			
					if($ReallotSemcode == $studsem || $laststudreg < $lastreallotsemcode)
						{
										
							echo '<i style="color:red;font-size:20px;font-family:calibri ;">Sorry! You are not Eligiable for Hostel Re-Allotment Registration in this semester for more info contact Hostel Admin.</i><br><br> You will be redirect to previous page shortly !';
							
							
							header( "refresh:4;url=http://usis.iiu.edu.pk:64453/dashboard" );
							 
							//exit to prevent the rest of the script from executing
							exit;
						}
			}
			elseif ($programe == 'BS' || $programe == 'LLB' || $programe == 'Bachelor' )
			{
					if($ReallotSemcode == $studsem || $laststudreg < $lastreallotsemcode)
						{
										
							echo '<i style="color:red;font-size:20px;font-family:calibri ;">Sorry! You are not Eligiable for Hostel Re-Allotment Registration in this semester for more info contact Hostel Admin.</i><br><br> You will be redirect to previous page shortly !';
							
							
							header( "refresh:4;url=http://usis.iiu.edu.pk:64453/dashboard" );
							 
							//exit to prevent the rest of the script from executing
							exit;
						}
			}
			elseif ($programe == 'PHD')
			{
					if($ReallotSemcode == $studsem || $laststudreg < $lastreallotsemcode)
						{
										
							echo '<i style="color:red;font-size:20px;font-family:calibri ;">Sorry! You are not Eligiable for Hostel Re-Allotment Registration in this semester for more info contact Hostel Admin.</i><br><br> You will be redirect to previous page shortly !';
							
							
							header( "refresh:4;url=http://usis.iiu.edu.pk:64453/dashboard" );
							 
							//exit to prevent the rest of the script from executing
							exit;
						}
			}*/
			//  ---------------------------------CHECK FOR REALLOTMENT Apply ---------------------------------------------------
		//else
		{
			$studregno = $this->session->userdata('studregno');
			
			$reallotstatus = $semcode[0]->REALLOTSTATUS;
			
			$semcode = $semcode[0]->SEMCODE;
			
			$studInfo = $this->reallotment_model->GetstudInfoByRegId($gender,$studregno);
			
			$programe = $studInfo[0]->PROTITTLE;  $departname = $studInfo[0]->DEPARTNAME; $regno = $studInfo[0]->REGNO; $nationality = $studInfo[0]->NATIONALITY;
			$studsem = substr($regno,-3);
			
			$reallotstudInfo = $this->reallotment_model->GetstudInfoReallot($gender,$regno);
			
			if(isset($reallotstudInfo[0]->SEMCODE) && $semcode == $reallotstudInfo[0]->SEMCODE)
			{
				$this->session->set_flashdata('success', 'ReAllotment done succesfully for current semester. Submit your document to provost Office.');
			
				redirect('feechallan/feechallan/challanreallot');
			}
			
			if(isset($reallotstatus) && $reallotstatus == 0)
			{
				$this->session->set_flashdata('error', 'HOSTEL SEAT RENEWAL is Closed now. For more info Contact Provost Office IIUI.');
			
				redirect('feechallan/feechallan/challanreallot');
			}
			
			
			// Credit Hour Check Start 
					
					$courseInfo = $this->Signup_model->getCourseInfo($gender, $semcode);
								
								foreach($courseInfo as $info)
										{
											$coursestatus  = $info->STATUS;
											$coursestype  = $info->TYPE;
											$coursebap  = $info->BSPAK;
											$coursemap  = $info->MAPAK;
											$coursemsp  = $info->MSPAK;
											$coursephdp  = $info->PHDPAK;
											$coursebaf  = $info->BSFOREIGNER;
											$coursemaf  = $info->MAFOREIGNER;
											$coursemsf  = $info->MSFOREIGNER;
											$coursephdf  = $info->PHDFOREIGNER;
											$coursesemcode  = $info->SEMCODE;										
										}
					
					if($coursestype == 'ReAllotment' && $coursestatus == 1)
					   {
						 if(($programe == 'BS' || $programe == 'LLB' || $programe == 'BA' || $programe == 'Bachelor') && ($nationality == 'Pakistani'))
						   {	
									 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
									
									 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursebap;
									 
									 if($studTotalCredit < $coursebap)
										{ 
											$course = $coursebap;
									        redirect('reallotment/Reallotment/CreditHourcheck/'.$course);
										}
										
						   }
						elseif(($programe == 'BS' || $programe == 'LLB' || $programe == 'BA' || $programe == 'Bachelor') && ($nationality != 'Pakistani'))
						  {
							 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
							
							 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursebaf;
							 
							 if($studTotalCredit < $coursebaf)
								{ 
									$course = $coursebaf;
									redirect('reallotment/Reallotment/CreditHourcheck/'.$course);
								}
								
						  }
						elseif(($programe == 'MA' || $programe == 'MSC') && ($nationality == 'Pakistani'))
						  {
							 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
							
							 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursemap;
							 
							 if($studTotalCredit < $coursemap)
								{ 
									$course = $coursemap;
									redirect('reallotment/Reallotment/CreditHourcheck/'.$course);
								}
								
						  } 
						elseif(($programe == 'MA' || $programe == 'MSC') && ($nationality != 'Pakistani'))
						  {
							 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
							
							 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursemaf;
							 
							 if($studTotalCredit < $coursemaf)
								{ 
									$course = $coursemaf;
									redirect('reallotment/Reallotment/CreditHourcheck/'.$course);
								}
								
						  }    
						 elseif(($programe == 'MS' || $programe == 'LLM' || $programe == 'MS/MPHILL') && ($nationality == 'Pakistani'))
						  {
							 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
							
							 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursemsp;
							
							 if($studTotalCredit < $coursemsp)
								{ 
									$course = $coursemsp;
									redirect('reallotment/Reallotment/CreditHourcheck/'.$course);
								}
								
						  } 
						elseif(($programe == 'MS' || $programe == 'LLM' || $programe == 'MS/MPHILL') && ($nationality != 'Pakistani'))
						  {
							 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
							
							 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursemsf;
							 
							 if($studTotalCredit < $coursemsf)
								{ 
									$course = $coursemsf;
									redirect('reallotment/Reallotment/CreditHourcheck/'.$course);
								}
								
						  }
						elseif(($programe == 'PHD') && ($nationality == 'Pakistani'))
						  {
							 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
							
							 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursephdp;
							 
							 if($studTotalCredit < $coursephdp)
								{ 
									$course = $coursephdp;
									redirect('reallotment/Reallotment/CreditHourcheck/'.$course);
								}
								
						  } 
						elseif(($programe == 'PHD') && ($nationality != 'Pakistani'))
						  {
							 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
							
							 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursephdp;
							 
							 if($studTotalCredit < $coursephdp)
								{ 
									$course = $coursephdp;
									redirect('reallotment/Reallotment/CreditHourcheck/'.$course);
								}
								
						  }
						  
						 
					   }
								
					// Credit Hour Check ENd
			
			/*$allotment = $this->reallotment_model->GetstudInfoByUId($gender,$userId);
			foreach($allotment as $allot)
			{
				$allots = count($allot->REGNO);
			}
			
			if($allots > 1)
			{
				echo '<i style="color:red;font-size:20px;font-family:calibri ;">Sorry your Email ID is conflict with other student Email Id. Please update your email Id from Provost hostel Office  for more info contact Hostel Admin.</i><br><br> You will be redirect to previous page shortly !';
			
			
			header( "refresh:5;url=http://usis.iiu.edu.pk:64453/dashboard" );
			exit();	
			}*/
			
			$data['oraclepic'] = $this->common_model->PictureOracle($regno);
			
		    $data['allotInfo'] = $this->reallotment_model->GetstudInfoByRegId($gender,$studregno);
			
			$data['semInfo'] = $this->reallotment_model->GetReallotsemInfo($gender);
			
			$data['challanstatus'] = $this->feechallan_model->GetChallanstatusByRegno($gender,$regno, $semcode);
			
			$this->global['pageTitle'] = 'IIUI Hostels : Re-Allotment Application';
			
			$this->loadViews("reallotment/studreallotmentapply", $this->global, $data , NULL);
			}
		
		}
		
    }
	
	function ApplyReAllotment()
    {
            $this->load->library('form_validation');
			
			$this->load->helper('date_helper');
            
            $this->form_validation->set_rules('fee','Fees','required|max_length[28]');
			$this->form_validation->set_rules('vno','vno','required|max_length[28]');
		
            if($this->form_validation->run() == FALSE)
            {
				$this->session->set_flashdata('error', 'Please fill all required fields');
				redirect('reallotment/reAllotment/studentreallotapply');
            }
		date_default_timezone_set('Asia/Karachi');
	   
	    $dateTime = date('Y-m-d H:i:s');
		
		$userId = $this->vendorId;
			
			
     	if(!empty($gender[0]->GENDER))
		
		  {
			$gender = $this->gender;
		  }
		
		$studregno = $this->session->userdata('studregno');
		
		$genders = $this->reallotment_model->GetstudInfoByRegNoId($studregno);
			
		$gender = $genders[0]->GENDER;
		
		$semdate = $this->reallotment_model->GetReallotsemInfo($gender);
		
		$ReallotId = $this->reallotment_model->GetstudInfoByRegId($gender,$studregno);
		
		$programe = $this->input->post('programe');
		
		$batchname = $this->input->post('batchname');
		
		$regno = $this->input->post('regno');
		
		$semcode = $this->input->post('semcode');
		
		$feeamount = $this->input->post('fee');
		
		$refrigerator = $this->input->post('refrigerator');
		
		$iron = $this->input->post('iron');
		
		$epot = $this->input->post('epot');
		
		$rcooler = $this->input->post('rcooler');
		
		$aircond = $this->input->post('aircond');
		
		$eheater = $this->input->post('eheater');
		
		$oven = $this->input->post('oven');
		
		$wmachine = $this->input->post('wmachine');
		
		$ekettle = $this->input->post('ekettle');
		
		$fatherph = $this->input->post('fatherph');
		
		$fatherocup = $this->input->post('fatherocup');
		
		$hostelbatch = $this->input->post('hostelbatch');
		
		$vno = $this->input->post('vno');
		if(!empty($ReallotId[0]->EMAILID))
		{
		  $emailid = $ReallotId[0]->EMAILID;
		
		  $studemail = $this->reallotment_model->GetstudEid($emailid);
		}
		$RenewalDone = $this->reallotment_model->CheckReallotmentDone($regno, $semcode);
		
		if($RenewalDone == TRUE)
		{
			$this->session->set_flashdata('success', ' Hostel Seat Renewal done succesfully for current semester. Submit your document to provost Office.');
			
			redirect('feechallan/feechallan/challanreallot');
		}
		
		{
			$seminfo = $this->common_model->GetActiveSemester($gender);
		
			$semcode = $seminfo[0]->SEMCODE;
			
			$feeslippath = 'upload'; 

			$feesname = 'demo.png';
			
			$feeInfo = array(
				'REGNO'=>$regno,
				'SEMCODE'=>$semcode,
				'STATUS'=>1, 
				'RECEIPTNO'=>$vno, 
				'FEEAMOUNT'=>$feeamount, 
				'FEEPATH'=>$feeslippath, 
				'FEEPIC'=>$feesname,
				'IS_SUBMIT'=> 1
			);
		
			$Insertfee = $this->reallotment_model->InsertFeeStatus($feeInfo);
			
			$studentitems = array(
				'REGNO'=>$regno,
				'SEMCODE'=>$semcode,
				'REFRIGERATOR'=>$refrigerator, 
				'IRON'=>$iron, 
				'ELECTRICPOT'=>$epot, 
				'ROOMCOOLER'=>$rcooler, 
				'AIRCONDITION'=>$aircond,
				'EHEATER'=> $eheater, 
				'OVEN'=> $oven, 
				'WASHINGM'=> $wmachine, 
				'EKETTLE'=> $ekettle
			);
		
			$this->reallotment_model->InsertStudentItems($studentitems);
			
			$ReallotId = $this->reallotment_model->GetstudInfoByRegno($regno);
		
			$receiptno = $vno; $feepath = 'NIL'; 
		
			$feepic = 'NIL'; 
		
			$historyInfo = array(
							'SEATSTATUS'=>$ReallotId[0]->SEATSTATUS,
							'REGNO'=>$ReallotId[0]->REGNO, 
							'STUDENTNAME'=>$ReallotId[0]->STUDENTNAME,
							'STUDENTPHONE'=>$ReallotId[0]->STUDENTPHONE,
							'FATHERNAME'=>$ReallotId[0]->FATHERNAME, 
							'ADDRESS'=>$ReallotId[0]->ADDRESS, 
							'GENDER'=>$ReallotId[0]->GENDER, 
							'SEATID'=>$ReallotId[0]->SEATID, 
							'ROOMID'=>$ReallotId[0]->ROOMID, 
							'HOSTELID'=>$ReallotId[0]->HOSTELID, 
							'ALLOTED'=>$ReallotId[0]->ALLOTED, 
							'ALLOTTYPE'=>'REALLOTMENT', 
							'ALLOTEDDATE'=>$ReallotId[0]->ALLOTEDDATE, 
							'EXPIRYDATE'=>$semdate[0]->SMENDDATE, 
							'ARRIVALDATE'=>$semdate[0]->SMSTARTDATE, 
							'FEEAMOUNT'=>$feeamount, 
							'DEPOSITDATE'=>$semdate[0]->SMSTARTDATE, 
							'RECEIPTNO'=>$receiptno, 
							'DOORKEYSALLOTED'=>$ReallotId[0]->DOORKEYSALLOTED, 
							'CUPBOARDKEYSALLOTED'=>$ReallotId[0]->CUPBOARDKEYSALLOTED, 
							'MESSDUESCLEAR'=>$ReallotId[0]->MESSDUESCLEAR, 
							'VACCANTDATE'=>$ReallotId[0]->VACCANTDATE, 
							'STATUS'=>$ReallotId[0]->STATUS,
							'RDUES'=>$ReallotId[0]->RDUES, 
							'SEMCODE'=>$semdate[0]->SEMCODE,
							'GUESTREGNO'=>$ReallotId[0]->GUESTREGNO, 
							'QUOTA_TYPE'=>$ReallotId[0]->QUOTA_TYPE,
							'TYPE'=>$ReallotId[0]->TYPE, 
							'PICPATH'=>$ReallotId[0]->PICPATH,
							'PICNAME'=>$ReallotId[0]->PICNAME, 
							'FEEPATH'=>$feepath, 
							'FEEPIC'=>$feepic,
							'IS_SUBMIT'=>1, 
							'ADMIN_VERIFY'=>0,
							'EMAILID'=>$ReallotId[0]->EMAILID, 
							'CADDRESS'=>$ReallotId[0]->CADDRESS, 
							'PROVINCE'=>$ReallotId[0]->PROVINCE, 
							'NATIONALITY'=>$ReallotId[0]->NATIONALITY, 
							'COUNTRY'=>$ReallotId[0]->COUNTRY,
							'PROTITTLE'=>$ReallotId[0]->PROTITTLE,
							'DISTRICT'=>$ReallotId[0]->DISTRICT, 
							'CNIC'=>$ReallotId[0]->CNIC,
							'DEPARTNAME'=>$ReallotId[0]->DEPARTNAME, 
							'FACULTY'=>$ReallotId[0]->FACULTY, 
							'PROGRAME'=>$programe, 
							'BATCHNAME'=>$batchname, 
							'HOSTELBATCH'=>$hostelbatch, 
							'FATHERPHONE'=> $fatherph, 
							'FATHEROCCUPATION'=> $fatherocup, 
							'EXT'=>$ReallotId[0]->EXT, 
							'updatedDtm'=>date('d-m-Y H:i:s')
						);
		
		$this->reallotment_model->InsertHistory($historyInfo);
		
		$lastreallotId = $this->reallotment_model->GetstudId();
		$lastreallotId = $lastreallotId[0]->ALLOTMENTHISTORY_ID;
		//$lastreallotId = $lastreallotId+1;
		
		 $reallotmentInfo = array(
		 					'REALLOTMENT_ID'=>$lastreallotId,
		 					'SEATSTATUS'=>$ReallotId[0]->SEATSTATUS,
		 					'REGNO'=>$ReallotId[0]->REGNO, 
		 					'STUDENTNAME'=>$ReallotId[0]->STUDENTNAME,
		 					'STUDENTPHONE'=>$ReallotId[0]->STUDENTPHONE,
		 					'FATHERNAME'=>$ReallotId[0]->FATHERNAME, 
		 					'ADDRESS'=>$ReallotId[0]->ADDRESS, 
		 					'GENDER'=>$ReallotId[0]->GENDER, 
		 					'SEATID'=>$ReallotId[0]->SEATID, 
		 					'ROOMID'=>$ReallotId[0]->ROOMID, 
		 					'HOSTELID'=>$ReallotId[0]->HOSTELID, 
		 					'ALLOTED'=>$ReallotId[0]->ALLOTED, 
		 					'ALLOTTYPE'=>'REALLOTMENT', 
		 					'ALLOTEDDATE'=>$ReallotId[0]->ALLOTEDDATE, 
		 					'EXPIRYDATE'=>$semdate[0]->SMENDDATE, 
		 					'ARRIVALDATE'=>$semdate[0]->SMSTARTDATE, 
		 					'FEEAMOUNT'=>$feeamount, 
		 					'DEPOSITDATE'=>$semdate[0]->SMSTARTDATE, 
		 					'RECEIPTNO'=>$receiptno, 
		 					'DOORKEYSALLOTED'=>$ReallotId[0]->DOORKEYSALLOTED, 
		 					'CUPBOARDKEYSALLOTED'=>$ReallotId[0]->CUPBOARDKEYSALLOTED, 
		 					'MESSDUESCLEAR'=>$ReallotId[0]->MESSDUESCLEAR, 
		 					'VACCANTDATE'=>$ReallotId[0]->VACCANTDATE, 
		 					'STATUS'=>$ReallotId[0]->STATUS,
		 					'RDUES'=>$ReallotId[0]->RDUES, 
		 					'SEMCODE'=>$semdate[0]->SEMCODE,
		 					'GUESTREGNO'=>$ReallotId[0]->GUESTREGNO, 
		 					'QUOTA_TYPE'=>$ReallotId[0]->QUOTA_TYPE,
		 					'TYPE'=>$ReallotId[0]->TYPE, 
		 					'PICPATH'=>$ReallotId[0]->PICPATH,
		 					'PICNAME'=>$ReallotId[0]->PICNAME, 
		 					'FEEPATH'=>$feepath, 
		 					'FEEPIC'=>$feepic,
		 					'IS_SUBMIT'=>1, 
		 					'ADMIN_VERIFY'=>0,
		 					'EMAILID'=>$ReallotId[0]->EMAILID, 
		 					'NATIONALITY'=>$ReallotId[0]->NATIONALITY, 
		 					'PROVINCE'=>$ReallotId[0]->PROVINCE, 
		 					'CADDRESS'=>$ReallotId[0]->CADDRESS,
		 					'COUNTRY'=>$ReallotId[0]->COUNTRY,
		 					'PROTITTLE'=>$ReallotId[0]->PROTITTLE,
		 					'DISTRICT'=>$ReallotId[0]->DISTRICT, 
		 					'CNIC'=>$ReallotId[0]->CNIC,
		 					'DEPARTNAME'=>$ReallotId[0]->DEPARTNAME, 
		 					'FACULTY'=>$ReallotId[0]->FACULTY, 
		 					'PROGRAME'=>$programe, 
		 					'BATCHNAME'=>$batchname, 
		 					'HOSTELBATCH'=>$hostelbatch, 
		 					'FATHERPHONE'=> $fatherph, 
		 					'FATHEROCCUPATION'=> $fatherocup, 
		 					'EXT'=>$ReallotId[0]->EXT, 
		 					'updatedDtm'=>date('d-m-Y H:i:s')
		 				);
		
		$Inserted = $this->reallotment_model->InsertReAllotment($reallotmentInfo);
		
		$this->reallotment_model->DeleteRecordFromAllotReallot($regno);
		
		if($Inserted)
		{
			    $emailtype = 'New Application';
			
				$sendemail = $this->login_model->getsendemail($gender, $emailtype);
				 
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
				$mail->addAddress($studemail[0]->email);   // Add a recipient //$studemail[0]->email
				//$mail->addCC('cc@example.com');
				//$mail->addBCC('bcc@example.com');
				
				$mail->isHTML(true);  // Set email format to HTML 
			
				
				$bodyContent = '<h3>Dear Applicant.</h3><br><h3>
Hostel Seat Renewal Application Request for IIUI Hostels Recived Successfully.</h3>';
			  $bodyContent .= '<br>Your Tracker Id <b>('.$lastreallotId.') for Semester ('.$semdate[0]->SEMCODE.')</b><br>'.'<p style="font-size:14px">Kindly Submit your Hostel Paid Fee Challan (Challane Fee Avilabel on your Hostel Portal), Orignal Hostel ID Card & Hostel Seat Renewal Form Download by clicking Renewal Form on your Hostel portal and submit it to Hostel Warden Office before the Closing Date of Renewal of Hostel Seat.<br>Note: <b>Incomplete Renewal process may cancel your seat.</b><br><br>If you have any query regarding Renewal of Hostel Seat IIUI, Email us at:<strong> hostel@iiu.edu.pk</strong>. We will reply you as soon as possible or visit Provost Hostel Office. </p>
				<br/>
				<h3>Best Regards</h3>
				<h4">Provost Office</h4>
				<p>Hostel IIUI</p><br/><br/>
				<div style="font-size:smaller;background-color: #3c763d;color: #fff;">This communication contains information that is for the exclusive use of the intended recipient(s). If you are not the intended recipient, disclosure, copying, distribution or other use of, or taking of any action in reliance upon, this communication or the information in it is prohibited and may be unlawful. If you have received this communication in error please notify the sender by return email, delete it from your system and destroy any copies.</div>
				';
		       
				
				$mail->Subject = 'Email from IIUI Hostel Admin';
				$mail->Body    = $bodyContent;
		
				if(!$mail->send()) {
					
					$msg = 'Mailer Error: ' . $mail->ErrorInfo;
					$msg = 'Message could not be sent.';
				} else {
						 $msg = 1;
				}
				//echo $msg;exit();
				/* Mail function End */
				
				if($msg == 1)
                {
                    $data['msg'] = 1;
					
					$data['success'] = 'Confirmation Email is sent on your registered Email Id. Please follow the Email, for more info contact Hostel Admin.';
			       $this->global['pageTitle'] = 'IIUI Hostels : Re-Allotment Close2';
			
			       $this->loadViews("reallotment/studentreallotclose", $this->global, $data , NULL);
                }
                else
                {
                   $data['warning'] = 'Kindly Submit your Hostel Fee (Challane Fee available on your Hostel Portal), Hostel ID Card and Attested Copy of course Registration/Permission form by the concerned Department Chaiperson/Dean to Hostel Warden Office before the Closing Date of Renewal of Hostel Seat.<br>Note: <b>Incomplete Renewal process may cancel your seat.</b><br><br>If you have any query regarding Re-Allotment of Hostel IIUI, Email us at:<strong> hostel@iiu.edu.pk</strong>. We will reply you as soon as possible or visit Provost Hostel Office.';
			       
				   $this->global['pageTitle'] = 'IIUI Hostels : Re-Allotment Close3';
			
			       $this->loadViews("reallotment/studentreallotclose", $this->global, $data , NULL);
			   }
             
		   }
		}
		
    }
	

    function pageNotFound()
    {	
		$this->global['pageTitle'] = 'IIUI Hostels : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }
	
	function revertAllallot($AllotID = NULL)
    {	
		//$data['seatdetail'] = $this->reallotment_model->getAllSeatInfo();
			
			$userId = $this->vendorId;
			
			
			$gender = $this->gender;
				
			$data['seatinfo'] = $this->reallotment_model->geAllotSeat($gender, $AllotID);
			
			$info = $this->reallotment_model->geAllotSeat($gender, $AllotID);
			
			$emailid = $info[0]->EMAILID; $regno = $info[0]->REGNO;
			
			$data['email'] = $this->reallotment_model->geEmail($gender, $regno, $emailid);
			
			$data['oraclepic'] = $this->common_model->PictureOracle($regno);
			
			$data['id'] = $AllotID;
			
			$semester = $this->common_model->GetActiveSemester($gender);
			
			$history = $this->reallotment_model->GetHistorydate($regno, $gender);
		
			$semcod = $semester[0]->SEMCODE; 
			
			$expdate = $semester[0]->SMENDDATE; 
			
			$stdate = $semester[0]->STARTREGDATE;
			
			$arrdate = $history[0]->ALLOTEDDATE;
		
			$data['semcode'] = $semcod; $data['expdate'] = $expdate; $data['stdate'] = $stdate;  $data['arrdate'] = $arrdate;
			
			$data['hosteldetail'] = $this->reallotment_model->getHostelInfo($gender);
			
            $this->global['pageTitle'] = 'IIUI Hostels : Add Default Details';

            $this->loadViews("reallotment/addnewrevertallot", $this->global, $data, NULL);
    }
	
	function reverallotmentdetail($AllotID = NULL)
    {	
		//$data['seatdetail'] = $this->reallotment_model->getAllSeatInfo();
			
			$userId = $this->vendorId;
			
			
			$gender = $this->gender;
			
			$regnos = $this->reallotment_model->GetregnobyDefualtId($AllotID, $gender);
			
			$regno = $regnos[0]->REGNO; 
			$emailid = $regnos[0]->EMAILID; 
			$hostelid = $regnos[0]->HOSTELID; 
			$roomid = $regnos[0]->ROOMID; 
			$seatid = $regnos[0]->SEATID;
			
			$seatexist = $this->reallotment_model->GetSeatExistbyregno($hostelid, $roomid, $seatid);
			
			$seat = $seatexist[0]->SEATID;
			
			if(empty($seat))
			  {
				  $data['seatInfo'] = $this->reallotment_model->GetAllallotinfo($hostelid, $roomid, $seatid);
			  }
			
			$data['emails'] = $this->reallotment_model->GetEmailbyDefualtId($emailid, $gender);
			
			$data['studentinfo'] = $this->reallotment_model->VerifyUserRecordByOracleDb($regno, $gender);
				
			$data['hosteldetail'] = $this->reallotment_model->getHostelInfo($gender);
			
			$data['defaultInfo'] = $this->reallotment_model->GetregnobyDefualtId($AllotID, $gender);
			
			$data['allotid'] = $AllotID;
			
            $this->global['pageTitle'] = 'IIUI Hostels : Add Default Details';

            $this->loadViews("reallotment/addNewRevertreallotmet", $this->global, $data, NULL);
    }
	
	function reverallotment($AllotID = NULL)
    {
        
        if($AllotID == null)
        {
            redirect('allotment/Allotment/ViewDefaulter');
        }
		
		$userId = $this->vendorId;			
		
		$gender = $this->gender;
		
		$record = $this->reallotment_model->GetseatagainstDefault($gender,$AllotID);

		$regno = $record[0]->REGNO;

		$father = $this->reallotment_model->GetfathernametDefault($gender,$regno);
		
		$defaultid = $record[0]->DEFAULT_ID; 
		$seatstatus = $record[0]->SEATSTATUS; 
		$regno = $record[0]->REGNO; 
		$studentname = $record[0]->STUDENTNAME; 
		$studentphone = $record[0]->STUDENTPHONE; 
		$fathername = $father[0]->FATHERNAME; 
		$address = $record[0]->ADDRESS; 
		$gender = $record[0]->GENDER; 
		$seatid = $record[0]->SEATID; 
		$roomid = $record[0]->ROOMID;
		$hostelid = $record[0]->HOSTELID; 
		$alloted = $record[0]->ALLOTED; 
		$allottype = $record[0]->ALLOTTYPE; 
		$allotdate = $record[0]->ALLOTEDDATE; 
		$expirydate = $record[0]->EXPIRYDATE; 
		$arrivaldate = $record[0]->ARRIVALDATE; 
		$feeamount = $record[0]->FEEAMOUNT; 
		$depotdate = $record[0]->DEPOSITDATE; 
		$recepitno = $record[0]->RECEIPTNO; 
		$doorkeyallot = $record[0]->DOORKEYSALLOTED; 
		$cupkeyallot = $record[0]->CUPBOARDKEYSALLOTED; 
		$messdueclear = $record[0]->MESSDUESCLEAR; 
		$vacantdate = $record[0]->VACCANTDATE; 
		$status = $record[0]->STATUS; 
		$rdues = $record[0]->RDUES; 
		$semcode = $record[0]->SEMCODE; 
		$guestregno = $record[0]->GUESTREGNO; 
		$quotatype = $record[0]->QUOTA_TYPE; 
		$type = $record[0]->TYPE; 
		$picpath = $record[0]->PICPATH; 
		$picname = $record[0]->PICNAME; 
		$feepath = $record[0]->FEEPATH; 
		$feepic = $record[0]->FEEPIC; 
		$issubmit = $record[0]->IS_SUBMIT; 
		$adminverify = $record[0]->ADMIN_VERIFY; 
		$updatedtm = $record[0]->updatedDtm;
		
		
		$seatrecord = $this->reallotment_model->GetseatInfos($gender,$AllotID,$hostelid,$roomid,$seatid);
			
		if($seatrecord != NULL)
		{
			$defaultInfo = array(
				'SEATSTATUS' => $seatstatus, 
				'REGNO' => $regno, 
				'STUDENTNAME' => $studentname,
				'STUDENTPHONE' => $studentphone,
				'FATHERNAME' => $fathername, 
				'ADDRESS' => $address, 
				'GENDER' => $gender, 
				'ALLOTED' => $alloted, 
				'ALLOTTYPE' => 'ReAlloted',
				'ALLOTEDDATE' => $allotdate, 
				'FEEAMOUNT' => $feeamount, 
				'DOORKEYSALLOTED' => $doorkeyallot, 
				'CUPBOARDKEYSALLOTED' => $cupkeyallot,
				'MESSDUESCLEAR' => $messdueclear, 
				'STATUS' => $status, 
				'RDUES' => $rdues, 
				'GUESTREGNO' => $guestregno, 
				'QUOTA_TYPE' => $quotatype,
				'TYPE' => $type, 
				'PICPATH' => $picpath, 
				'PICNAME' => $picname, 
				'FEEPATH' => $feepath,
				'FEEPIC' => $feepic, 
				'IS_SUBMIT' => $issubmit, 
				'ADMIN_VERIFY' => $adminverify, 
				'updatedDtm' => date('Y-m-d'));
			
			$default = $this->reallotment_model->InsertDefaultInfoToREAllotment($defaultInfo);
			
			$this->session->set_flashdata('error', 'Seat already alloted to other Student. Student record transfer to Reallotment');
           
			$result = $this->reallotment_model->DelFromDefault($gender,$defaultid);
		    
        	redirect('reallotment/ReAllotment/ViewDefaulter');
		} else {
			
			$defaultInfo = array(
				'SEATSTATUS' => $seatstatus, 
				'REGNO' => $regno, 
				'STUDENTNAME' => $studentname,
				'STUDENTPHONE' => $studentphone, 
				'FATHERNAME' => $fathername, 
				'ADDRESS' => $address, 
				'GENDER' => $gender, 
				'SEATID' => $seatid,
				'ROOMID' => $roomid, 
				'HOSTELID' => $hostelid, 
				'ALLOTED' => $alloted, 
				'ALLOTTYPE' => 'ReAlloted', 
				'ALLOTEDDATE' => $allotdate, 
				'FEEAMOUNT' => $feeamount, 
				'DOORKEYSALLOTED' => $doorkeyallot, 
				'CUPBOARDKEYSALLOTED' => $cupkeyallot,
				'MESSDUESCLEAR' => $messdueclear, 
				'STATUS' => $status, 
				'RDUES' => $rdues, 
				'GUESTREGNO' => $guestregno, 
				'QUOTA_TYPE' => $quotatype,
				'TYPE' => $type, 
				'PICPATH' => $picpath, 
				'PICNAME' => $picname, 
				'FEEPATH' => $feepath,
				'FEEPIC' => $feepic, 
				'IS_SUBMIT' => $issubmit, 
				'ADMIN_VERIFY' => $adminverify, 
				'updatedDtm' => date('Y-m-d'));
					
			$default = $this->reallotment_model->InsertDefaultInfoToREAllotment($defaultInfo);
					
			$updateseat = array('OCCUPIED'=>1);
					
			$result = $this->reallotment_model->UpdatedSeatDeafult($updateseat, $hostelid, $roomid, $seatid, $gender);
					
			$result = $this->reallotment_model->DelFromDefault($gender,$defaultid);

		}
			
		$this->session->set_flashdata('success', 'Student Seat Reverted Succesfully');
                
        redirect('reallotment/ReAllotment/ViewDefaulter');

	}

	
	function ViewDefaulter()
    {
			
		$data['viewalldefault'] = $this->reallotment_model->ViewAllDefault($this->gender);
			
		$this->global['pageTitle'] = 'IIUI Hostels : View Allotment';
	
		$this->loadViews("reallotment/viewdefaulter", $this->global, $data, NULL);
    }
	
	function GenrateDefaulterList()
    {
		$userId = $this->vendorId;			
			
		$gender = $this->gender;
		
		$semester = $this->common_model->GetActiveSemester($gender);
		
		$semester = $semester[0]->SEMCODE;
		
		$record = $this->reallotment_model->GetOldList($gender,$semester);
		
		if(!empty($record))
			{
				$this->reallotment_model->delDefaultListExist($gender);
				foreach ($record as $rec)
				{
				
				$regno = $rec->REGNO;
				$record = $this->reallotment_model->GetDefaulterList($gender,$regno);
				$semcode = $record[0]->SEMCODE;
				$recordexisted = $this->reallotment_model->DefaultExist($regno,$semcode, $gender);
				if(empty($recordexisted))
				{
					$allotid = $record[0]->ALLOTMENTHISTORY_ID; 
					$seatstatus = $record[0]->SEATSTATUS; 
					$regno = $record[0]->REGNO; 
					$studentname = $record[0]->STUDENTNAME; 
					$studentphone = $record[0]->STUDENTPHONE; 
					$address = $record[0]->ADDRESS; 
					$gender = $record[0]->GENDER; 
					$seatid = $record[0]->SEATID; 
					$roomid = $record[0]->ROOMID;$hostelid = $record[0]->HOSTELID; 
					$alloted = $record[0]->ALLOTED; 
					$allottype = $record[0]->ALLOTTYPE; 
					$allotdate = $record[0]->ALLOTEDDATE; 
					$expirydate = $record[0]->EXPIRYDATE; 
					$arrivaldate = $record[0]->ARRIVALDATE; 
					$feeamount = $record[0]->FEEAMOUNT; 
					$depotdate = $record[0]->DEPOSITDATE; 
					$recepitno = $record[0]->RECEIPTNO; 
					$emailid = $record[0]->EMAILID; 
					$doorkeyallot = $record[0]->DOORKEYSALLOTED; 
					$cupkeyallot = $record[0]->CUPBOARDKEYSALLOTED; 
					$messdueclear = $record[0]->MESSDUESCLEAR; 
					$vacantdate = $record[0]->VACCANTDATE; 
					$status = $record[0]->STATUS; 
					$rdues = $record[0]->RDUES; 
					$semcode = $record[0]->SEMCODE; 
					$guestregno = $record[0]->GUESTREGNO; 
					$quotatype = $record[0]->QUOTA_TYPE; 
					$type = $record[0]->TYPE; 
					$picpath = $record[0]->PICPATH; 
					$picname = $record[0]->PICNAME; 
					$feepath = $record[0]->FEEPATH; 
					$feepic = $record[0]->FEEPIC; 
					$issubmit = $record[0]->IS_SUBMIT; 
					$adminverify = $record[0]->ADMIN_VERIFY; 
					$updatedtm = $record[0]->updatedDtm;
					
					$defaultInfo = array(
						'ALLOTMENT_ID'=>$allotid,
						'SEATSTATUS'=>$seatstatus,
						'REGNO'=>$regno,
						'STUDENTNAME'=>$studentname,
						'STUDENTPHONE'=>$studentphone,
						'ADDRESS'=>$address,
						'GENDER'=>$gender,
						'SEATID'=>$seatid,
						'ROOMID'=>$roomid,
						'HOSTELID'=>$hostelid,
						'ALLOTED'=>$alloted,
						'ALLOTTYPE'=>$allottype,
						'ALLOTEDDATE'=>$allotdate,
						'EXPIRYDATE'=>$expirydate,
						'EMAILID'=>$emailid,
						'ARRIVALDATE'=>$arrivaldate,
						'FEEAMOUNT'=>$feeamount,
						'DEPOSITDATE'=>$depotdate,
						'RECEIPTNO'=>$recepitno,
						'DOORKEYSALLOTED'=>$doorkeyallot,
						'CUPBOARDKEYSALLOTED'=>$cupkeyallot,
						'MESSDUESCLEAR'=>$messdueclear,
						'VACCANTDATE'=>$vacantdate,
						'STATUS'=>$status,
						'RDUES'=>$rdues,
						'SEMCODE'=>$semcode,
						'SEMCODE'=>$semcode,
						'GUESTREGNO'=>$guestregno,
						'QUOTA_TYPE'=>$quotatype,
						'TYPE'=>$type,
						'PICPATH'=>$picpath,
						'PICNAME'=>$picname,
						'FEEPATH'=>$feepath,
						'FEEPIC'=>$feepic,
						'IS_SUBMIT'=>0,
						'ADMIN_VERIFY'=>2,
						'updatedDtm'=>date('Y-m-d'));
					
					
					
						$default = $this->reallotment_model->InsertAllotInfoToDefault($defaultInfo);
						
						$updateseat = array('OCCUPIED'=>0);
						
						$result = $this->reallotment_model->UpdatedSeatDeafult($updateseat, $hostelid, $roomid, $seatid, $gender);
				    }
						//$result = $this->reallotment_model->DelAllDefault($gender,$allotid,$adminverify);
					  
				
											
				}
				        $data['viewalldefault'] = $this->reallotment_model->ViewAllDefault($gender);
			
						$this->global['pageTitle'] = 'IIUI Hostels : View Allotment';
	
						$this->loadViews("reallotment/viewdefaulter", $this->global, $data, NULL);

				        
			}
			else
			{
				$this->session->set_flashdata('error', 'Currently No Re-Allotment Existed in Cancel State.');
			    
				redirect('reallotment/ReAllotment/viewAllotmentDetail');
			}
	}
	
	function CreditHourcheck($course)
     {	
	    
		$data['err_message'] = 'Sorry! you can not apply for Hostel seat, due to Courses Credit hrs  requirnment. Minimum Credit hrs requirment is: <b>'.$course.'</b>. Contact department Cordinator for course joining before applying....';
								
		$this->global['pageTitle'] = 'IIUI Hostels : Credit Hours Requirnmnet';

		$this->loadViews("reallotment/studentcoursereg", $this->global, $data, NULL);
		
		
	 }
	
	function RenewalForm()
    {
		$userId = $this->vendorId;
			
		
		$studregno = $this->session->userdata('studregno');
			
		$genders = $this->reallotment_model->GetstudInfoByRegNoId($studregno);
			
		$gender = $genders[0]->GENDER;
		
		if($gender == 'M')
		  {
			  $gender = 'Male';
		  }
		elseif($gender == 'F')
		{
			$gender = 'Female';
		}
		
		$regno = $this->session->userdata('studregno');
		
		$semcodes = $this->reallotment_model->GetReallotsemInfo($gender);
		
		$semcode = $semcodes[0]->SEMCODE;
		
		if(empty($semcode))
		{
			$data['status'] = 'close';			
			
			$this->global['pageTitle'] = 'IIUI Hostels : Re-Allotment Close4';
			
			$this->loadViews("reallotment/studentreallotclose", $this->global, $data , NULL);
		}
		else
		{
			$studInfo = $this->reallotment_model->VerifyUserRecordById($regno, $gender);
			
			$programe = $studInfo[0]->PROTITTLE;  

			$departname = $studInfo[0]->DEPARTNAME; 

			$regno = $studInfo[0]->REGNO;

			$studsem = substr($regno,-3); 
			
			$studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
			
			$data['studitem'] = $this->Signup_model->getStudentitem($regno, $semcode);
			
			$data['semcode'] = $semcode;
			
			$data['coursename'] = $this->Signup_model->getStudentCourseNameInfo($regno, $semcode);
			
			$data['oraclepic'] = $this->common_model->PictureOracle($regno);
			
			$courseInfo = $this->Signup_model->getCourseInfo($gender, $semcode);
								
								foreach($courseInfo as $info)
										{
											$coursestatus  = $info->STATUS;
											$coursestype  = $info->TYPE;
											$coursebap  = $info->BSPAK;
											$coursemap  = $info->MAPAK;
											$coursemsp  = $info->MSPAK;
											$coursephdp  = $info->PHDPAK;
											$coursebaf  = $info->BSFOREIGNER;
											$coursemaf  = $info->MAFOREIGNER;
											$coursemsf  = $info->MSFOREIGNER;
											$coursephdf  = $info->PHDFOREIGNER;
											$coursesemcode  = $info->SEMCODE;										
										}
										
		    $verifyRenewal = $this->reallotment_model->VerifyUserRecordInRenewal($regno, $gender);
			
			$data['RenewalId'] = $verifyRenewal;
					
			if(empty($verifyRenewal))
			  {
				 redirect('reallotment/reAllotment/studentreallotapply'); 
			  }
			else
				{
					$this->load->library('pdf');
					
					$data['studInfo'] = $studInfo;
				
					$data['studTotalCredit'] = $studTotalCredit;
					
					$this->pdf->load_view('reallotment/renewalform', $data);
			  
				    $this->pdf->render();
					
				    $data['Attachment'] = FALSE;
					
				    $this->pdf->stream("reallotment/ReAllotment/renewal.pdf", $data);
				}
		  }
		
	 }

}

?>