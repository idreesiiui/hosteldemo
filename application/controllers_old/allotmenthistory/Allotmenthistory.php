<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Allotmenthistory (AllotmentHistoryController)
 * Allotmenthistory Class to control all allotment history related operations.
 * @author : Muhammad Idrees 
 * @version : 2.0
 * @since : 17 November 2022
 */
class Allotmenthistory extends BaseController
{    
    public function __construct()
    {
        parent::__construct();
		$this->load->model('allotmenthistory_model');
		$this->load->model('seat_model');
        $this->load->model('room_model');
        $this->isLoggedIn();   
    }    
   
    public function index()
    {
		
        $this->global['pageTitle'] = 'IIUI Hostels : Dashboard';
        
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }
    
   
    function viewAllotmentDetail()
    {
		$hostelno = $this->uri->segment(4); 
		$roomno = $this->uri->segment(5);
		
		if(!empty($hostelno))
		
		{
			$hostelno = $this->uri->segment(4);
			
			$roomno = $this->uri->segment(5);
			
			$semester = $this->input->post('semester');
			
		}
		else 
		{
			$semester = $this->input->post('semester');
		
			$hostelno = $this->input->post('hostelno');
			
			$roomno = $this->input->post('roomno');
		
		}
					
			$gender = $this->gender;  
		
			$data['viewallotments'] = $this->allotmenthistory_model->viewallotmentInfo($gender,$hostelno,$roomno,$semester);
		
			$data['roomno'] = $roomno; 
		
			$data['hostelno'] = $hostelno;
		
			$this->global['pageTitle'] = 'IIUI Hostels : View Allotment Details';
		
			$this->loadViews("allotmenthistory/viewallotment", $this->global, $data, NULL);
        
    }
	
	function view()
    {
        $gender = $this->gender;   
		
		$data['HostelRecords'] = $this->allotmenthistory_model->getAllHostelInfo($gender);
		
		$data['SemesterRecords'] = $this->allotmenthistory_model->getAllSemester($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Allotment Details';
		
		$this->loadViews("allotmenthistory/view", $this->global, $data, NULL);
        
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
        	$gender = $this->gender;
				
			$data['hosteldetail'] = $this->allotmenthistory_model->getHostelInfo($gender);
			
			//$data['stpic'] = $this->allotmenthistory_model->getStudentPic($gender);
			
            $this->global['pageTitle'] = 'IIUI Hostels : Add New Allotment';

            $this->loadViews("allotmenthistory/addNewallotment", $this->global, $data, NULL);
    }
	
	 function GenrateDefaulterList()
    {
        	$gender = $this->gender;
			
			$record = $this->allotmenthistory_model->GenrateCancelList($gender);
			
			if(!empty($record))
			{
				$default = $this->allotmenthistory_model->GenrateDefaulterList($gender);
				
				foreach($default as $record)
				{
					$allotid = $record->ALLOTMENT_ID; 
					$seatstatus = $record->SEATSTATUS; 
					$regno = $record->REGNO; 
					$studentname = $record->STUDENTNAME; 
					$studentphone = $record->STUDENTPHONE; 
					$address = $record->ADDRESS; 
					$gender = $record->GENDER; 
					$seatid = $record->SEATID; 
					$roomid = $record->ROOMID;$hostelid = $record->HOSTELID; 
					$alloted = $record->ALLOTED; 
					$allottype = $record->ALLOTTYPE; 
					$allotdate = $record->ALLOTEDDATE; 
					$expirydate = $record->EXPIRYDATE; 
					$arrivaldate = $record->ARRIVALDATE; 
					$feeamount = $record->FEEAMOUNT; 
					$depotdate = $record->DEPOSITDATE; 
					$recepitno = $record->RECEIPTNO; 
					$doorkeyallot = $record->DOORKEYSALLOTED; 
					$cupkeyallot = $record->CUPBOARDKEYSALLOTED; 
					$messdueclear = $record->MESSDUESCLEAR; 
					$vacantdate = $record->VACCANTDATE; 
					$status = $record->STATUS; 
					$rdues = $record->RDUES; 
					$semcode = $record->SEMCODE; 
					$guestregno = $record->GUESTREGNO; 
					$quotatype = $record->QUOTA_TYPE; 
					$type = $record->TYPE; 
					$picpath = $record->PICPATH; 
					$picname = $record->PICNAME; 
					$feepath = $record->FEEPATH; 
					$feepic = $record->FEEPIC; 
					$issubmit = $record->IS_SUBMIT; 
					$adminverify = $record->ADMIN_VERIFY; 
					$updatedtm = $record->updatedDtm;
					
					$defaultInfo = array(
						'ALLOTMENT_ID'=>$allotid, 
						'SEATSTATUS'=>$seatstatus, 
						'REGNO'=>$regno, 
						'STUDENTNAME'=>$studentname,'STUDENTPHONE'=>$studentphone, 
						'ADDRESS'=>$address, 
						'GENDER'=>$gender, 
						'SEATID'=>$seatid,'ROOMID'=>$roomid, 
						'HOSTELID'=>$hostelid, 
						'ALLOTED'=>$alloted, 
						'ALLOTTYPE'=>$allottype,'ALLOTEDDATE'=>$allotdate, 
						'EXPIRYDATE'=>$expirydate, 
						'ARRIVALDATE'=>$arrivaldate, 
						'FEEAMOUNT'=>$feeamount,'DEPOSITDATE'=>$depotdate, 
						'RECEIPTNO'=>$recepitno, 
						'DOORKEYSALLOTED'=>$doorkeyallot, 
						'CUPBOARDKEYSALLOTED'=>$cupkeyallot,'MESSDUESCLEAR'=>$messdueclear, 
						'VACCANTDATE'=>$vacantdate, 
						'STATUS'=>$status, 
						'RDUES'=>$rdues,'SEMCODE'=>$semcode, 
						'SEMCODE'=>$semcode, 
						'GUESTREGNO'=>$guestregno, 
						'QUOTA_TYPE'=>$quotatype,'TYPE'=>$type, 
						'PICPATH'=>$picpath, 
						'PICNAME'=>$picname, 
						'FEEPATH'=>$feepath,'FEEPIC'=>$feepic, 
						'IS_SUBMIT'=>$issubmit, 
						'ADMIN_VERIFY'=>$adminverify, 
						'updatedDtm'=>date('Y-m-d'));
					
					
					$default = $this->allotmenthistory_model->InsertAllotInfoToDefault($defaultInfo);
					
					$updateseat = array('OCCUPIED'=>0);
					
					$result = $this->allotmenthistory_model->UpdatedSeatDeafult($updateseat, $hostelid, $roomid, $seatid, $gender);
					
					$result = $this->allotmenthistory_model->DelAllDefault($gender,$allotid,$adminverify);

				}
				
				$data['viewalldefault'] = $this->allotmenthistory_model->ViewAllDefault($gender);
			
				$this->global['pageTitle'] = 'IIUI Hostels : View Allotment';
	
				$this->loadViews("allotmenthistory/viewdefaulter", $this->global, $data, NULL);
			}
			else
			{
				$this->session->set_flashdata('error', 'Currently No Allotment Existed in Cancel State.');
			    
				redirect('allotmenthistory/allotmenthistory/viewAllotmentDetail');
			}
		
    }
	
	function ViewDefaulter()
    {
        	$gender = $this->gender;
			
			$data['viewalldefault'] = $this->allotmenthistory_model->ViewAllDefault($gender);
			
		    $this->global['pageTitle'] = 'IIUI Hostels : View Allotment';
	
			$this->loadViews("allotmenthistory/viewdefaulter", $this->global, $data, NULL);
    }
	
	function GetHostelInfoByHNO()
    {
        	$hostelId = $this->input->post('hostelno');
			
			$result = $this->allotmenthistory_model->gethostelNameById($hostelId);
		 
		    echo json_encode($result);   
    }
	
	function GetRoomInfoByHNO()
    {
        	$gender = $this->gender;
			
			$hostelId = $this->input->post('hostelno');
			
			$result = $this->allotmenthistory_model->getRoomInfo($hostelId, $gender);
		 
		    echo json_encode($result);   
    }
	
	function getRoomInfobyId()
    {
        	$gender = $this->gender;
			
			$roomId = $this->input->post('roomno');
			
			$hostelId = $this->input->post('hostelno');
			
			$result = $this->allotmenthistory_model->getRoomInfobyId($hostelId, $roomId, $gender);
		 
		    echo json_encode($result);   
    }
	
	function VerifyUserRecord()
    {
        	$regno = $this->input->post('regno');
			
			$gender = $this->gender;
			
			$result = $this->allotmenthistory_model->VerifyUserRecordById($regno, $gender);

		    echo json_encode($result);   
    }
	
	function GetSeatByRIdHId()
    {
        	$hostelId = $this->input->post('hostelno');
			
			$roomId = $this->input->post('roomno');
			
			$gender = $this->gender;
			
			$result = $this->allotmenthistory_model->GetSeatByRIdHId($hostelId, $roomId, $gender);
		   
		    echo json_encode($result);   
    }
	
	function GetESeatByRIdHId()
    {
        	$hostelId = $this->input->post('hostelno');
			
			$roomId = $this->input->post('roomno');
			
			$gender = $this->gender;
			
			$result = $this->allotmenthistory_model->GetESeatByRIdHId($hostelId, $roomId, $gender);
		   
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
			$this->form_validation->set_rules('expdate','Exp Date','required|max_length[128]');
			$this->form_validation->set_rules('alloteddate','Alloted Date','required|max_length[128]');
            
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $email = $this->input->post('email');
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
				$gender = $this->input->post('gend');
				if ($gender == 'M')
				{
					$gender = 'Male';
				}
				elseif($gender == 'F')
				{
					$gender = 'Female';
				}

				$doorkey = ''; 

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
                
				$Seatexisted = $this->allotmenthistory_model->seat_exists_against_Regno($regno);
				
				if($Seatexisted == true)
					{
						$this->session->set_flashdata('error', 'This seat already Alloted against selected Registration Number in Database.');
						redirect('allotmenthistory/allotmenthistory/addNew');
					}
					
				else
			{
				
				//$this->load->library('upload');
                    
				//if (!empty($_FILES['pic1']['name']) && isset($_FILES['pic1']['name']))
				{
				
				// Specify configuration for File 1
					//$config['upload_path'] = 'uploads/profilepic/';
					//$config['allowed_types'] = 'gif|jpg|png|jpeg';
					//$config['max_size'] = '2048000';
					//$config['max_width']  = '3000';
					//$config['max_height']  = '2000';	  

					// Initialize config for File 1
					//$this->upload->initialize($config);
					
					// Upload file 1
					//if ($this->upload->do_upload('pic1'))
					//{
						//$data = $this->upload->data();
					//}
					//else
					//{
						//$error =  $this->upload->display_errors();
						//$this->session->set_flashdata('error', $error);
						//redirect('allotmenthistory/allotmenthistory/addNew');
					//}
					
					//$picname = $_FILES['pic1']['name'];
					
					//$picpath = $config['upload_path'];
				}
                
				$studemailsId = $this->allotmenthistory_model->CheckEmailExist($email);
					if($studemailsId[0]->userId == 0)
					{
						 $studentusercreate = array('EMAIL'=>$email, 'GENDER'=>$gender,'NAME'=>$studentname,'PASSWORD'=>getHashedPassword(str_replace(' ','',strtolower($studentname))),'ROLEID'=>4);
						$emailids = $this->allotmenthistory_model->CreateNewUser($studentusercreate);
				        $emailid =  $emailids[0]->userId; 
					}
					//exit();
			else
                {
                    $this->session->set_flashdata('error', 'Email Already Existed in databse please give some other email');
					redirect('allotmenthistory/allotmenthistory/addNew');
                }
                
                
				
            $allotmentInfo = array('SEATSTATUS'=>$status, 'GENDER'=>$gender,'STUDENTNAME'=>$studentname, 'QUOTA_TYPE'=>$seatoccupy, 'REGNO'=>$regno, 'SEATID'=>$seatavilabel, 'ROOMID'=>$roomno, 'HOSTELID'=> $hostelno, 'ALLOTEDDATE'=> $alloteddate, 'ALLOTED'=>$alloted, 'EXPIRYDATE'=>$expdate, 'ARRIVALDATE'=>$arrdate, 'ADDRESS'=>$address, 'FEEAMOUNT'=>$feeamount, 'DEPOSITDATE'=> $depodate, 'RECEIPTNO'=> $recpno, 'DOORKEYSALLOTED'=>$doorkey, 'CUPBOARDKEYSALLOTED'=>$cupboardkey, 'RDUES'=>$rdues, 'STATUS'=>$allotstatus, 'SEMCODE'=>$semcode, 'GENDER'=>$gender, 'STUDENTPHONE'=>$phone, 'PICNAME'=>$picname, 'PICPATH'=>$picpath, 'FATHERNAME'=>$fname, 'CADDRESS'=>$preadd, 'ADDRESS'=>$address, 'NATIONALITY'=>$nationality,'COUNTRY'=>$country, 'PROTITTLE'=>$protittle, 'DISTRICT'=>$district,  'PROVINCE'=>$province, 'DEPARTNAME'=>$dname, 'FACULTY'=>$faculty, 'cnic'=>$cnic, 'EMAILID'=>$emailid);
			
				$hisallotmentInfo =  array('SEATSTATUS'=>$status, 'GENDER'=>$gender,'STUDENTNAME'=>$studentname, 'QUOTA_TYPE'=>$seatoccupy, 'REGNO'=>$regno, 'SEATID'=>$seatavilabel, 'ROOMID'=>$roomno, 'HOSTELID'=> $hostelno, 'ALLOTEDDATE'=> $alloteddate, 'ALLOTED'=>$alloted, 'EXPIRYDATE'=>$expdate, 'ARRIVALDATE'=>$arrdate, 'ADDRESS'=>$address, 'FEEAMOUNT'=>$feeamount, 'DEPOSITDATE'=> $depodate, 'RECEIPTNO'=> $recpno, 'DOORKEYSALLOTED'=>$doorkey, 'CUPBOARDKEYSALLOTED'=>$cupboardkey, 'RDUES'=>$rdues, 'STATUS'=>$allotstatus, 'SEMCODE'=>$semcode, 'GENDER'=>$gender, 'STUDENTPHONE'=>$phone, 'PICNAME'=>$picname, 'PICPATH'=>$picpath, 'FATHERNAME'=>$fname, 'CADDRESS'=>$preadd, 'ADDRESS'=>$address, 'NATIONALITY'=>$nationality, 'COUNTRY'=>$country, 'PROTITTLE'=>$protittle, 'DISTRICT'=>$district,  'PROVINCE'=>$province, 'DEPARTNAME'=>$dname, 'FACULTY'=>$faculty, 'cnic'=>$cnic, 'EMAILID'=>$emailid);
				
				$itemInfo = array('REGNO'=>$regno,'DOORKEYSALLOTED'=>$doorkey,'CUPBOARDKEYSALLOTED'=>$cupboardkey,'DRAWKEYS'=>$drawer,'MATRESS'=>$matress, 'CHAIR'=>$chair, 'TABLES'=> $table);
                               
                $result = $this->allotmenthistory_model->addNewAllotment($allotmentInfo);
				
				$item = $this->allotmenthistory_model->addNewItems($itemInfo);
                
				$this->allotmenthistory_model->addHisAllotment($hisallotmentInfo);
				
			    $updateseatstatus = array('OCCUPIED'=>$alloted);
			    
			    $result = $this->allotmenthistory_model->UpdateseatInfo($updateseatstatus,$seatavilabel);
			}
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Seat Alloted successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Seat Allotment failed');
                }
                
                redirect('allotmenthistory/allotmenthistory/addNew');
            }
        }
    
function reverallotment($AllotID = NULL)
    {
        
            if($AllotID == null)
            {
                redirect('allotmenthistory/allotmenthistory/ViewDefaulter');
            }
			
			$gender = $this->gender;
			
			$record = $this->allotmenthistory_model->GetseatagainstDefault($gender,$AllotID);
			
			
					$allotid = $record[0]->ALLOTMENT_ID; $seatstatus = $record[0]->SEATSTATUS; $regno = $record[0]->REGNO; $studentname = $record[0]->STUDENTNAME; $studentphone = $record[0]->STUDENTPHONE; $address = $record[0]->ADDRESS; $gender = $record[0]->GENDER; $seatid = $record[0]->SEATID; $roomid = $record[0]->ROOMID;$hostelid = $record[0]->HOSTELID; $alloted = $record[0]->ALLOTED; $allottype = $record[0]->ALLOTTYPE; $allotdate = $record[0]->ALLOTEDDATE; $expirydate = $record[0]->EXPIRYDATE; $arrivaldate = $record[0]->ARRIVALDATE; $feeamount = $record[0]->FEEAMOUNT; $depotdate = $record[0]->DEPOSITDATE; $recepitno = $record[0]->RECEIPTNO; $doorkeyallot = $record[0]->DOORKEYSALLOTED; $cupkeyallot = $record[0]->CUPBOARDKEYSALLOTED; $messdueclear = $record[0]->MESSDUESCLEAR; $vacantdate = $record[0]->VACCANTDATE; $status = $record[0]->STATUS; $rdues = $record[0]->RDUES; $semcode = $record[0]->SEMCODE; $guestregno = $record[0]->GUESTREGNO; $quotatype = $record[0]->QUOTA_TYPE; $type = $record[0]->TYPE; $picpath = $record[0]->PICPATH; $picname = $record[0]->PICNAME; $feepath = $record[0]->FEEPATH; $feepic = $record[0]->FEEPIC; $issubmit = $record[0]->IS_SUBMIT; $adminverify = $record[0]->ADMIN_VERIFY; $updatedtm = $record[0]->updatedDtm;
			
			
			$seatrecord = $this->allotmenthistory_model->GetseatInfos($gender,$AllotID,$hostelid,$roomid,$seatid);
			
			if($seatrecord != NULL)
			{
			   $this->session->set_flashdata('error', 'Seat already alloted to other Student. Please vacant seat first');
                
                redirect('allotmenthistory/allotmenthistory/ViewDefaulter');
			}
			else
			{
			
					$defaultInfo = array('ALLOTMENT_ID'=>$allotid, 'SEATSTATUS'=>$seatstatus, 'REGNO'=>$regno, 'STUDENTNAME'=>$studentname,'STUDENTPHONE'=>$studentphone, 'ADDRESS'=>$address, 'GENDER'=>$gender, 'SEATID'=>$seatid,'ROOMID'=>$roomid, 'HOSTELID'=>$hostelid, 'ALLOTED'=>$alloted, 'ALLOTTYPE'=>$allottype,'ALLOTEDDATE'=>$allotdate, 'EXPIRYDATE'=>$expirydate, 'ARRIVALDATE'=>$arrivaldate, 'FEEAMOUNT'=>$feeamount,'DEPOSITDATE'=>$depotdate, 'RECEIPTNO'=>$recepitno, 'DOORKEYSALLOTED'=>$doorkeyallot, 'CUPBOARDKEYSALLOTED'=>$cupkeyallot,'MESSDUESCLEAR'=>$messdueclear, 'VACCANTDATE'=>$vacantdate, 'STATUS'=>$status, 'RDUES'=>$rdues,'SEMCODE'=>$semcode, 'SEMCODE'=>$semcode, 'GUESTREGNO'=>$guestregno, 'QUOTA_TYPE'=>$quotatype,'TYPE'=>$type, 'PICPATH'=>$picpath, 'PICNAME'=>$picname, 'FEEPATH'=>$feepath,'FEEPIC'=>$feepic, 'IS_SUBMIT'=>$issubmit, 'ADMIN_VERIFY'=>$adminverify, 'updatedDtm'=>date('Y-m-d'));
					
					$default = $this->allotmenthistory_model->InsertAllotInfoToAllotment($defaultInfo);
					
					$updateseat = array('OCCUPIED'=>1);
					
		$result = $this->allotmenthistory_model->UpdatedSeatDeafult($updateseat, $hostelid, $roomid, $seatid, $gender);
					
					$result = $this->allotmenthistory_model->DelFromDefault($gender,$allotid);

			}
			
			 $this->session->set_flashdata('success', 'Student Seat Reverted Succesfully');
                
             redirect('allotmenthistory/allotmenthistory/ViewDefaulter');

	}
    
    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($AllotID = NULL)
    {
        
            if($AllotID == null)
            {
                redirect('allotmenthistory/allotmenthistory/viewAllotmentDetail');
            }
			
			$gender = $this->gender;
			
			$data['hosteldetail'] = $this->allotmenthistory_model->getAllHostelInfo($gender);
			
            $hostelno = $this->allotmenthistory_model->getAllotmentInfobyId($AllotID, $gender);
			
			$hostelid = $hostelno[0]->HOSTELID;
			
			$roomid = $hostelno[0]->ROOMID;
			
			$regno = $hostelno[0]->REGNO;
           
		    $data['roomdetail'] = $this->allotmenthistory_model->getAllRoomInfo($hostelid, $gender);
			
			$data['seatdetail'] = $this->allotmenthistory_model->getAllSeatInfo($roomid, $gender);
			
			$data['stPerInfo'] = $this->allotmenthistory_model->VerifyUserRecordById($regno, $gender);
			
			$data['oraclepic'] = $this->common_model->PictureOracle($regno);
			
			$name = $this->allotmenthistory_model->getAllotmentInfobyId($AllotID, $gender);
		   
		   	$sname = $name[0]->STUDENTNAME; $fname = $name[0]->FATHERNAME; $emailsId = $name[0]->EMAILID; $regno = $name[0]->REGNO;
		    
			$data['allotInfo'] = $this->allotmenthistory_model->getAllotmentInfobyId($AllotID, $gender);
			
			$data['picInfo'] = $this->allotmenthistory_model->getAllotmentInfobyRegno($regno, $gender);
			
			$data['allotemail'] = $this->allotmenthistory_model->getAllotmentEmail($emailsId, $gender,$sname);
			
			$data['hostelno'] = $this->uri->segment(5); $data['roomno'] = $this->uri->segment(6); 
           
            $this->global['pageTitle'] = 'IIUI Hostels : Edit Allotment';
            
            $this->loadViews("allotmenthistory/editOld", $this->global, $data, NULL);
        
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
            
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
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
				
				$doorkey = ''; $drawer = ''; $cupboardkey = ''; $matress = ''; $chair = ''; $table = '';
				
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
					$studemailsId = $this->allotmenthistory_model->GetAllotEmailIds($emailid);
					if($studemailsId[0]->EMAILID > 1)
					{
						 $studentusercreate = array('EMAIL'=>$email, 'GENDER'=>$gender,'NAME'=>$studentname,'PASSWORD'=>getHashedPassword(str_replace(' ','',strtolower($studentname))),'ROLEID'=>4);
						$emailid = $this->allotmenthistory_model->CreateNewUser($studentusercreate);
				        $emailid =  $emailid[0]->userId; 
					}
					//exit();
			if(empty($emailid))
			{
				 $studentusercreate = array('EMAIL'=>$email, 'GENDER'=>$gender,'NAME'=>$studentname,'PASSWORD'=>getHashedPassword(str_replace(' ','',strtolower($studentname))),'ROLEID'=>4);
				 
				 $emailid = $this->allotmenthistory_model->CreateNewUser($studentusercreate);
				 $emailid =  $emailid[0]->userId;
			}
			
			else
			{
				  
				  $studemailId = $this->allotmenthistory_model->GetExistEmail($emailid);
				 
				  $studemail = $studemailId[0]->email; $userid = $studemailId[0]->userId; 
				
				  $Updatestudentemail = array('EMAIL'=>$email,'name'=>$studentname,'mobile'=>$phone);
				 
				  $this->allotmenthistory_model->UpdatestudMail($Updatestudentemail, $userid);
			}
				
				
            $allotmentInfo = array('SEATID'=>$seatavilabel,'SEATSTATUS'=>$status,'IS_SUBMIT'=>$upstatus, 'GENDER'=>$gender,'STUDENTNAME'=>$studentname,'FATHERNAME'=>$fname, 'QUOTA_TYPE'=>$seatoccupy, 'REGNO'=>$regno, 'ALLOTEDDATE'=> $alloteddate, 'ALLOTED'=>$alloted, 'EXPIRYDATE'=>$expdate, 'ARRIVALDATE'=>$arrdate, 'ADDRESS'=>$address, 'FEEAMOUNT'=>$feeamount, 'DEPOSITDATE'=> $depodate, 'RECEIPTNO'=> $recpno, 'DOORKEYSALLOTED'=>$doorkey, 'CUPBOARDKEYSALLOTED'=>$cupboardkey, 'RDUES'=>$rdues, 'STATUS'=>$allotstatus, 'SEMCODE'=>$semcode, 'GENDER'=>$gender, 'STUDENTPHONE'=>$phone, 'ADMIN_VERIFY'=>$appstatus,'ALLOTTYPE'=>'Alloted', 'EMAILID'=>$emailid,'FACULTY'=>$faculty, 'DEPARTNAME'=>$dname,'DISTRICT'=>$district, 'CNIC'=>$cnic,'COUNTRY'=>$country, 'PROTITTLE'=>$protittle, 'CADDRESS'=>$caddress, 'updatedDtm'=>date('d-m-Y H:i:s'));
                
                
                $result = $this->allotmenthistory_model->editAllotment($allotmentInfo, $allotmentid);
                
				$studentemail = $this->allotmenthistory_model->getstudentemail($gender,$emailid);
				
				$record = $this->allotmenthistory_model->GetAllotVerifyById($allotmentid);
				
				$historyexist = $this->allotmenthistory_model->GetAllotFromAllotHis($allotmentid);
				
				if(!empty($historyexist[0]->ALLOTMENTHISTORY_ID))
				{
					$updateHInfo = array('EMAILID'=>$userid);
					
					$this->allotmenthistory_model->editAllotmentHis($updateHInfo, $allotmentid);
				}
				
				$allotmentInfo = array('name'=>$studentname, 'email'=>$email,'GENDER'=>$gender);
				
				$record = $record[0]->ADMIN_VERIFY;
			
				if ($studentemail[0]->EMAIL != NULL && $record == 1)
				{ 
					$updatepassword = array('PASSWORD'=>getHashedPassword(str_replace(' ','',strtolower($studentname))));
				
				$this->allotmenthistory_model->Updatepassword($updatepassword, $emailid);
					
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
				<p>Female Campus</p><br/><br/>
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
                
                redirect('allotmenthistory/allotmenthistory/viewAllotmentDetail/'.$hostelno.'/'.$roomno);
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