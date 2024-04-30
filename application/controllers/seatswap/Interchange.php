<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Muhammad Idrees 
 * @version : 2.0
 * @since : 17 November 2022
 */
class Interchange extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
		$this->load->model('interchange_model');
		$this->load->model('seat_model');
        $this->load->model('room_model');
		$this->load->model('report_model');
		$this->load->model('allotment_model');
		$this->load->model('reallotment_model');
		$this->load->model('Semester_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
		
            $userId = $this->vendorId;
			
			$gender = $this->common_model->GetGenderById($userId);
			
			$gender = $gender[0]->GENDER;
				
			$data['hosteldetail'] = $this->interchange_model->getHostelInfo($gender);
			
			//$data['stpic'] = $this->allotment_model->getStudentPic($gender);
			
            $this->global['pageTitle'] = 'IIUI Hostels : Add New Allotment';

            $this->loadViews("seatswap/interchange", $this->global, $data, NULL);
    }
    
    /**
     * This function is used to load the user list
     */
    function viewAllotmentDetail()
    {
        $userId = $this->vendorId;
			
		$gender = $this->common_model->GetGenderById($userId);
			
		$gender = $gender[0]->GENDER;   
		
		$data['viewallotments'] = $this->allotment_model->viewallotmentInfo($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Allotment Details';
		
		$this->loadViews("allotment/viewallotment", $this->global, $data, NULL);
        
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
			
			$gender = $this->common_model->GetGenderById($userId);
			
			$gender = $gender[0]->GENDER;
				
			$data['hosteldetail'] = $this->allotment_model->getHostelInfo($gender);
			
			//$data['stpic'] = $this->allotment_model->getStudentPic($gender);
			
            $this->global['pageTitle'] = 'IIUI Hostels : Add New Allotment';

            $this->loadViews("allotment/addNewallotment", $this->global, $data, NULL);
    }
	
	function GetHostelInfoByHNO()
    {
        	$hostelId = $this->input->post('hostelno');
			
			$result = $this->interchange_model->gethostelNameById($hostelId);
		 
		    echo json_encode($result);   
    }
	
	function GetRoomInfoByHNO()
    {
        	$userId = $this->vendorId;
			
			$gender = $this->common_model->GetGenderById($userId);
			
			$gender = $gender[0]->GENDER;
			
			$studregno = $this->session->userdata('studregno');
		
		    if(!empty($studregno))
		   {
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
		   }
			$hostelId = $this->input->post('hostelno');
			
			$result = $this->interchange_model->getRoomInfo($hostelId, $gender);
		 
		    echo json_encode($result);   
    }
	
	function getRoomInfobyId()
    {
        	$userId = $this->vendorId;
			
			$gender = $this->common_model->GetGenderById($userId);
			
			$gender = $gender[0]->GENDER;
			
			$roomId = $this->input->post('roomno');
			
			$hostelId = $this->input->post('hostelno');
			
			$result = $this->interchange_model->getRoomInfobyId($hostelId, $roomId, $gender);
		 
		    echo json_encode($result);   
    }
	
	function VerifyUserRecord()
    {
        	$regno = $this->input->post('regno');
			
			//$userId = $this->vendorId;
			
			//$genders = $this->interchange_model->GetGenderById($userId);
			
			//$gender = $genders[0]->GENDER;
			
			$gender = $this->session->userdata('gender');
			
			$record = $this->interchange_model->VerifyUserRecordById($regno, $gender);
		if(!empty($record))
		{
			$hostelid = $record[0]->HOSTELID;
			
			$roomid = $record[0]->ROOMID;
			
			$seatid = $record[0]->SEATID;
			
			$regno = $record[0]->REGNO;
			
			$gender = $record[0]->GENDER;
			
			$result = $this->interchange_model->GetAllUserInfo($regno, $gender, $hostelid, $roomid, $seatid);
		}
		else
		{
			$result = 'false';
		}
			//$results = $result[0]->REGNO;
		  
		  //print_r($result);
		  //$val = base64_encode($result);
		    //echo json_encode($val);
			echo json_encode($result);   
    }
	
	function GetSeatByRIdHId()
    {
        	$hostelId = $this->input->post('hostelno');
			
			$roomId = $this->input->post('roomno');
			
			$userId = $this->vendorId;
			
			$gender = $this->common_model->GetGenderById($userId);
			
			$gender = $gender[0]->GENDER;
			
			$studregno = $this->session->userdata('studregno');
		
		    if(!empty($studregno))
		   {
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
		   }
			
			$result = $this->interchange_model->GetSeatByRIdHId($hostelId, $roomId, $gender);
		   // print_r($result);
		    echo json_encode($result);   
    }
	
	function GetESeatByRIdHId()
    {
        	$hostelId = $this->input->post('hostelno');
			
			$roomId = $this->input->post('roomno');
			
			$userId = $this->vendorId;
			
			$gender = $this->common_model->GetGenderById($userId);
			
			$gender = $gender[0]->GENDER;
			
			$result = $this->allotment_model->GetESeatByRIdHId($hostelId, $roomId, $gender);
		   // print_r($result);
		    echo json_encode($result);   
    }
	
    
    /**
     * This function is used to add new user to the system
     */
    function addNewallotment()
    {
       
            $this->form_validation->set_rules('regno','Registration No','required|max_length[128]');
          
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $regno = $this->input->post('regno');
				$studentname = $this->input->post('studentname');
				$vhostelno = $this->input->post('vhostelno');
				$vhostelname = $this->input->post('vhostelname');
				$vroomno = $this->input->post('vroomno');
				$vroomtype = $this->input->post('vroomtype');
				$vseat = $this->input->post('vseat');
				$swapregno = $this->input->post('swapregno');
				$gender = $this->input->post('gender');
				$key = strtoupper($this->input->post('key'));

				if (!empty($swapregno))
				{
					$firstregno = $this->interchange_model->GetFirstregnoSeatInfo($regno, $gender);
					//print_r($firstregno);exit();
					foreach($firstregno as $fregno)
					{
						$firstallotid = $fregno->ID;
						$firststatus = $fregno->SEATSTATUS;
						$firstswapregno = $fregno->REGNO;
						$firstname = $fregno->STUDENTNAME;
						$firststudentph = $fregno->STUDENTPHONE;
						$firstfather = $fregno->FATHERNAME;
						$firstaddress = $fregno->ADDRESS;
						$firstgender = $fregno->GENDER;
						$firstseatid = $fregno->SEATID;
						$firstroomid = $fregno->ROOMID;
						$firsthostelid = $fregno->HOSTELID;
						$firstallot = $fregno->ALLOTED;
						$firstallottype = $fregno->ALLOTTYPE;
						$firstallotdate = $fregno->ALLOTEDDATE;
						$firstexpiry = $fregno->EXPIRYDATE;
						$firstarrivaldate = $fregno->ARRIVALDATE;
						$firstfeeamount = $fregno->FEEAMOUNT;
						$firstdepodate = $fregno->DEPOSITDATE;
						$firstrecepno = $fregno->RECEIPTNO;
						$firstdoorkey = $fregno->DOORKEYSALLOTED;
						$firstcup = $fregno->CUPBOARDKEYSALLOTED;
						$firstmessdueclear = $fregno->MESSDUESCLEAR;
						$firstvacantdate = $fregno->VACCANTDATE;
						$firststatus = $fregno->STATUS;
						$firstrdues = $fregno->RDUES;
						$firstsemcode = $fregno->SEMCODE;
						$firstguestregno = $fregno->GUESTREGNO;
						$firstquota = $fregno->QUOTA_TYPE;
						$firsttype = $fregno->TYPE;
						$firstpicpath = $fregno->PICPATH;
						$firstpicname = $fregno->PICNAME;
						$firstfeepath = $fregno->FEEPATH;
						$firstfeepic = $fregno->FEEPIC;
						$firstissubmit = $fregno->IS_SUBMIT;
						$firstadminverify = $fregno->ADMIN_VERIFY;
						$firstemailid = $fregno->EMAILID;
						$firstcaddress = $fregno->CADDRESS;
						$firstcountry = $fregno->COUNTRY;
						$firstnationality = $fregno->NATIONALITY;
						$firstprotittle = $fregno->PROTITTLE;
						$firstdistrict = $fregno->DISTRICT;
						$firstprovince = $fregno->PROVINCE;
						$firstcnic = $fregno->CNIC;
						$firstdepartment = $fregno->DEPARTNAME;
						$firstfaculty = $fregno->FACULTY;
						$firstprograme = $fregno->PROGRAME;
						$firstbatchname = $fregno->BATCHNAME;
						$firstremarks = $fregno->REMARKS;
						$firstupdatedtm = $fregno->updatedDtm;	
					}
					
					$secondregno = $this->interchange_model->GetSecondregnoSeatInfo($swapregno, $gender);
					
					foreach($secondregno as $sregno)
					{
						$secondallotid = $sregno->ID;
						$secondstatus = $sregno->SEATSTATUS;
						$secondswapregno = $sregno->REGNO;
						$secondname = $sregno->STUDENTNAME;
						$secondstudentph = $sregno->STUDENTPHONE;
						$secondfather = $sregno->FATHERNAME;
						$secondaddress = $sregno->ADDRESS;
						$secondgender = $sregno->GENDER;
						$secondseatid = $sregno->SEATID;
						$secondroomid = $sregno->ROOMID;
						$secondhostelid = $sregno->HOSTELID;
						$secondallot = $sregno->ALLOTED;
						$secondallottype = $sregno->ALLOTTYPE;
						$secondallotdate = $sregno->ALLOTEDDATE;
						$secondexpiry = $sregno->EXPIRYDATE;
						$secondarrivaldate = $sregno->ARRIVALDATE;
						$secondfeeamount = $sregno->FEEAMOUNT;
						$seconddepodate = $sregno->DEPOSITDATE;
						$secondrecepno = $sregno->RECEIPTNO;
						$seconddoorkey = $sregno->DOORKEYSALLOTED;
						$secondcup = $sregno->CUPBOARDKEYSALLOTED;
						$secondmessdueclear = $sregno->MESSDUESCLEAR;
						$secondvacantdate = $sregno->VACCANTDATE;
						$secondstatus = $sregno->STATUS;
						$secondrdues = $sregno->RDUES;
						$secondsemcode = $sregno->SEMCODE;
						$secondguestregno = $sregno->GUESTREGNO;
						$secondquota = $sregno->QUOTA_TYPE;
						$secondtype = $sregno->TYPE;
						$secondpicpath = $sregno->PICPATH;
						$secondpicname = $sregno->PICNAME;
						$secondfeepath = $sregno->FEEPATH;
						$secondfeepic = $sregno->FEEPIC;
						$secondissubmit = $sregno->IS_SUBMIT;
						$secondadminverify = $sregno->ADMIN_VERIFY;
						$secondemailid = $sregno->EMAILID;
						$secondcaddress = $sregno->CADDRESS;
						$secondcountry = $sregno->COUNTRY;
						$secondnationality = $sregno->NATIONALITY;
						$secondprotittle = $sregno->PROTITTLE;
						$seconddistrict = $sregno->DISTRICT;
						$secondprovince = $sregno->PROVINCE;
						$secondcnic = $sregno->CNIC;
						$seconddepartment = $sregno->DEPARTNAME;
						$secondfaculty = $sregno->FACULTY;
						$secondprograme = $sregno->PROGRAME;
						$secondbatchname = $sregno->BATCHNAME;
						$secondremarks = $sregno->REMARKS;
						$secondupdatedtm = $sregno->updatedDtm;	
					}
					
					$firstuserinfo = array(
						'REGNO'=>$firstswapregno,
						'STUDENTNAME'=>$firstname,
						'HOSTELID'=>$firsthostelid,
						'ROOMID'=>$firstroomid,
						'SEATID'=>$firstseatid, 
						'GENDER'=> $gender, 
						'ALLOTREALLOTID'=>$firstallotid, 
						'SWAPWITH'=> $swapregno, 
						'INTERDATE'=>date('Y-m-d')
					);
					
					$secondregno = $this->interchange_model->InsertFirstregnoInfo($firstuserinfo);
						
										
					$InsertHisfirstregno = array(
						'SEATSTATUS'=>$firststatus, 
						'REGNO'=>$firstswapregno, 
						'STUDENTNAME'=>$firstname, 
						'STUDENTPHONE'=>$firststudentph, 
						'FATHERNAME'=>$firstfather, 
						'ADDRESS'=>$firstaddress, 
						'GENDER'=>$firstgender,
						'SEATID'=>$secondseatid, 
						'ROOMID'=>$secondroomid, 
						'HOSTELID'=>$secondhostelid, 
						'ALLOTED'=>$firstallot, 
						'ALLOTTYPE'=>'Swap', 
						'ALLOTEDDATE'=>$firstallotdate, 
						'EXPIRYDATE'=>$firstexpiry, 
						'ARRIVALDATE'=>$firstarrivaldate, 
						'FEEAMOUNT'=>$firstfeeamount, 
						'DEPOSITDATE'=>$firstdepodate, 
						'RECEIPTNO'=> $firstrecepno, 
						'ALLOTED'=>$firstallot, 
						'DOORKEYSALLOTED'=>$firstdoorkey, 
						'CUPBOARDKEYSALLOTED'=>$firstcup, 
						'MESSDUESCLEAR'=>$firstmessdueclear, 
						'VACCANTDATE'=>$firstvacantdate, 
						'STATUS'=>$firststatus, 
						'RDUES'=>$firstrdues, 
						'SEMCODE'=>strtoupper($firstsemcode), 
						'GUESTREGNO'=>$firstguestregno, 
						'QUOTA_TYPE'=>$firstquota, 
						'TYPE'=>$firsttype, 
						'PICPATH'=>$firstpicpath, 
						'PICNAME'=>$firstpicname, 
						'FEEPATH'=>$firstfeepath, 
						'FEEPIC'=>$firstfeepic, 
						'IS_SUBMIT'=>$firstissubmit, 
						'ADMIN_VERIFY'=>$firstadminverify, 
						'EMAILID'=>$firstemailid, 
						'CADDRESS'=>$firstcaddress, 
						'COUNTRY'=>$firstcountry, 
						'NATIONALITY'=>$firstnationality, 
						'PROTITTLE'=>$firstprotittle, 
						'DISTRICT'=>$firstdistrict, 
						'PROVINCE'=>$firstprovince, 
						'CNIC'=>$firstcnic, 
						'DEPARTNAME'=>$firstdepartment, 
						'FACULTY'=>$firstfaculty,
						'PROGRAME'=>$firstprograme, 
						'BATCHNAME'=>$firstbatchname, 
						'REMARKS'=>$firstremarks, 
						'updatedDtm'=>date('Y-m-d H:m:i')
					);
					
					$UpdateFirstregno = $this->interchange_model->InsertHisFirstregnoInfo($InsertHisfirstregno);
					
					$keyinfo = array(
						'REGNO'=>$firstswapregno,
						'KEY'=>$key,
						'GENDER'=>$firstgender,
						'SEMCODE'=>strtoupper($firstsemcode),
						'TYPE'=>'swap');
					
					$transferInfo = $this->interchange_model->InsertKeyInfo($keyinfo);
					
					
					$secondregno = array(
							'REGNO'=>$secondswapregno,
							'STUDENTNAME'=>$secondname,
							'HOSTELID'=>$secondhostelid,
							'ROOMID'=>$secondroomid,
							'SEATID'=>$secondseatid, 
							'GENDER'=> $gender, 
							'ALLOTREALLOTID'=>$secondallotid, 
							'SWAPWITH'=> $regno, 
							'INTERDATE'=>date('Y-m-d')
						);
					
					$secondregno = $this->interchange_model->InsertSecondtregnoInfo($secondregno);
					
					
					$InsertHisSecondregno = array(
						'SEATSTATUS'=>$secondstatus, 
						'REGNO'=>$secondswapregno, 
						'STUDENTNAME'=>$secondname, 
						'STUDENTPHONE'=>$secondstudentph, 
						'FATHERNAME'=>$secondfather, 
						'ADDRESS'=>$secondaddress, 
						'GENDER'=>$secondgender,
						'SEATID'=>$firstseatid, 
						'ROOMID'=>$firstroomid, 
						'HOSTELID'=>$firsthostelid, 
						'ALLOTED'=>$secondallot, 
						'ALLOTTYPE'=>'Swap', 
						'ALLOTEDDATE'=>$secondallotdate, 
						'EXPIRYDATE'=>$secondexpiry, 
						'ARRIVALDATE'=>$secondarrivaldate, 
						'FEEAMOUNT'=>$secondfeeamount, 
						'DEPOSITDATE'=>$seconddepodate, 
						'RECEIPTNO'=> $secondrecepno, 
						'ALLOTED'=>$secondallot, 
						'DOORKEYSALLOTED'=>$seconddoorkey, 
						'CUPBOARDKEYSALLOTED'=>$secondcup, 
						'MESSDUESCLEAR'=>$secondmessdueclear, 
						'VACCANTDATE'=>$secondvacantdate, 
						'STATUS'=>$secondstatus, 
						'RDUES'=>$secondrdues, 
						'SEMCODE'=>strtoupper($secondsemcode), 
						'GUESTREGNO'=>$secondguestregno, 
						'QUOTA_TYPE'=>$secondquota, 
						'TYPE'=>$secondtype, 
						'PICPATH'=>$secondpicpath, 
						'PICNAME'=>$secondpicname, 
						'FEEPATH'=>$secondfeepath, 
						'FEEPIC'=>$secondfeepic, 
						'IS_SUBMIT'=>$secondissubmit, 
						'ADMIN_VERIFY'=>$secondadminverify, 
						'EMAILID'=>$secondemailid, 
						'CADDRESS'=>$secondcaddress, 
						'COUNTRY'=>$secondcountry, 
						'NATIONALITY'=>$secondnationality, 
						'PROTITTLE'=>$secondprotittle, 
						'DISTRICT'=>$seconddistrict, 
						'PROVINCE'=>$secondprovince, 
						'CNIC'=>$secondcnic, 
						'DEPARTNAME'=>$seconddepartment, 
						'FACULTY'=>$secondfaculty, 
						'PROGRAME'=>$secondprograme, 
						'BATCHNAME'=>$secondbatchname, 
						'REMARKS'=>$secondremarks, 
						'updatedDtm'=>date('Y-m-d H:m:i'));
					
					$UpdateSecondregno = $this->interchange_model->InsertHisSecondregnoInfo($InsertHisSecondregno);
					
					$keyinfo = array(
						'REGNO'=>$secondswapregno,
						'KEY'=>$key,
						'GENDER'=>$secondgender,
						'SEMCODE'=>strtoupper($secondsemcode),
						'TYPE'=>'swap');
					
					$transferInfo = $this->interchange_model->InsertKeyInfo($keyinfo);
					
					$secondregno = array(
						'HOSTELID'=>$secondhostelid,
						'ROOMID'=>$secondroomid,
						'SEATID'=>$secondseatid
						);
					
					$UpdateFirstregno = $this->interchange_model->UpdateReAlotFirstregnoInfo($secondregno,$regno,$firstallotid);
					
					$UpdateAllotFirstregno = $this->interchange_model->UpdateAlotFirstregnoInfo($secondregno,$regno,$firstallotid);
					
					$firstregno = array(
						'HOSTELID'=>$firsthostelid,
						'ROOMID'=>$firstroomid,
						'SEATID'=>$firstseatid
					);
					
					$result = $this->interchange_model->UpdateReAlotSecondregnoInfo($firstregno,$swapregno,$secondallotid);
					
					$result = $this->interchange_model->UpdateAlotSecondregnoInfo($firstregno,$swapregno,$secondallotid);
					
					
				}
				elseif (!empty($vroomno) && !empty($vseat))
				{
					$OldseatInfo = $this->interchange_model->GetOldSeatInfo($regno,$gender);
					//print_r($OldseatInfo);
					foreach($OldseatInfo as $oregno)
					{
						$allotid = $oregno->ALLOTMENTHISTORY_ID;
						$status = $oregno->SEATSTATUS;
						$regno = $oregno->REGNO;
						$studentname = $oregno->STUDENTNAME;
						$studentph = $oregno->STUDENTPHONE;
						$father = $oregno->FATHERNAME;
						$address = $oregno->ADDRESS;
						$gender = $oregno->GENDER;
						$oldhostelid = $oregno->HOSTELID;
						$oldroomid = $oregno->ROOMID;
						$oldseatid = $oregno->SEATID;
						$allot = $oregno->ALLOTED;
						$allottype = $oregno->ALLOTTYPE;
						$allotdate = $oregno->ALLOTEDDATE;
						$expiry = $oregno->EXPIRYDATE;
						$arrivaldate = $oregno->ARRIVALDATE;
						$feeamount = $oregno->FEEAMOUNT;
						$depodate = $oregno->DEPOSITDATE;
						$recepno = $oregno->RECEIPTNO;
						$doorkey = $oregno->DOORKEYSALLOTED;
						$cup = $oregno->CUPBOARDKEYSALLOTED;
						$messdueclear = $oregno->MESSDUESCLEAR;
						$vacantdate = $oregno->VACCANTDATE;
						$status = $oregno->STATUS;
						$rdues = $oregno->RDUES;
						$semcode = $oregno->SEMCODE;
						$guestregno = $oregno->GUESTREGNO;
						$quota = $oregno->QUOTA_TYPE;
						$type = $oregno->TYPE;
						$picpath = $oregno->PICPATH;
						$picname = $oregno->PICNAME;
						$feepath = $oregno->FEEPATH;
						$feepic = $oregno->FEEPIC;
						$issubmit = $oregno->IS_SUBMIT;
						$adminverify = $oregno->ADMIN_VERIFY;
						$emailid = $oregno->EMAILID;
						$caddress = $oregno->CADDRESS;
						$country = $oregno->COUNTRY;
						$nationality = $oregno->NATIONALITY;
						$protittle = $oregno->PROTITTLE;
						$district = $oregno->DISTRICT;
						$province = $oregno->PROVINCE;
						$cnic = $oregno->CNIC;
						$department = $oregno->DEPARTNAME;
						$faculty = $oregno->FACULTY;
						$programe = $oregno->PROGRAME;
						$batchname = $oregno->BATCHNAME;
						$remarks = $oregno->REMARKS;
						$updatedtm = $oregno->updatedDtm;	
					}
					
					$LastAllotHis = $this->interchange_model->GetLastAllotmentHisId($regno, $gender);
					
					$AllotHis = $LastAllotHis[0]->ALLOTMENTHISTORY_ID;
					
					$transferseatInfo = array(
						'REGNO'=>$regno,
						'STUDENTNAME'=>$studentname,
						'HOSTELID'=>$oldhostelid,
						'ROOMID'=>$oldroomid,
						'SEATID'=>$oldseatid,
						'NEWHOSTELID'=>$vhostelno,
						'NEWROOMID'=>$vroomno,
						'NEWSEATID'=>$vseat,
						'GENDER'=>$gender,
						'TRANSFERDATE'=>date('Y-m-d')
					);
					
					$transferInfo = $this->interchange_model->InsertTransferInfo($transferseatInfo);
					
					$seminfo = $this->report_model->GetActiveSem($gender);
					
					$semcode = $seminfo[0]->SEMCODE;
					
					$keyinfo = array(
						'REGNO'=>$regno,
						'KEY'=>$key,
						'GENDER'=>$gender,
						'SEMCODE'=>strtoupper($semcode),
						'TYPE'=>'change');
					
					$transferInfo = $this->interchange_model->InsertKeyInfo($keyinfo);
					
					$updateseatInfo = array('HOSTELID'=>$vhostelno,'ROOMID'=>$vroomno,'SEATID'=>$vseat);
					
					$InsertHisInfo = array(
						'SEATSTATUS'=>$status, 
						'REGNO'=>$regno, 
						'STUDENTNAME'=>$studentname, 
						'STUDENTPHONE'=>$studentph, 
						'FATHERNAME'=>$father, 
						'ADDRESS'=>$address, 
						'GENDER'=>$gender,'SEATID'=>$vseat, 
						'ROOMID'=>$vroomno, 
						'HOSTELID'=>$vhostelno, 
						'ALLOTED'=>$allot, 
						'ALLOTTYPE'=>'Transfer', 
						'ALLOTEDDATE'=>$allotdate, 
						'EXPIRYDATE'=>$expiry, 
						'ARRIVALDATE'=>$arrivaldate, 
						'FEEAMOUNT'=>$feeamount, 
						'DEPOSITDATE'=>$depodate, 
						'RECEIPTNO'=> $recepno, 
						'ALLOTED'=>$allot, 
						'DOORKEYSALLOTED'=>$doorkey, 
						'CUPBOARDKEYSALLOTED'=>$cup, 
						'MESSDUESCLEAR'=>$messdueclear, 
						'VACCANTDATE'=>$vacantdate, 
						'STATUS'=>$status, 
						'RDUES'=>$rdues, 
						'SEMCODE'=>strtoupper($semcode), 
						'GUESTREGNO'=>$guestregno, 
						'QUOTA_TYPE'=>$quota, 
						'TYPE'=>$type, 
						'PICPATH'=>$picpath, 
						'PICNAME'=>$picname, 
						'FEEPATH'=>$feepath, 
						'FEEPIC'=>$feepic, 
						'IS_SUBMIT'=>$issubmit, 
						'ADMIN_VERIFY'=>$adminverify, 
						'EMAILID'=>$emailid, 
						'CADDRESS'=>$caddress, 
						'COUNTRY'=>$country, 
						'NATIONALITY'=>$nationality, 
						'PROTITTLE'=>$protittle, 
						'DISTRICT'=>$district, 
						'PROVINCE'=>$province, 
						'CNIC'=>$cnic, 
						'DEPARTNAME'=>$department, 
						'FACULTY'=>$faculty, 
						'PROGRAME'=>$programe, 
						'BATCHNAME'=>$batchname, 
						'REMARKS'=>$remarks, 
						'updatedDtm'=>date('Y-m-d H:m:i'));
					
					$result = $this->interchange_model->InsertHisInfo($InsertHisInfo);
					
					$result = $this->interchange_model->UpdateVSeatReallot($regno,$gender,$AllotHis,$updateseatInfo);

					$updateseat = array('OCCUPIED'=>0);
					
					$result = $this->interchange_model->UpdatedSeatStatus($oldseatid,$gender,$updateseat);
					
					$updatenewseat = array('OCCUPIED'=>1);
					
					$result = $this->interchange_model->UpdatedNewSeatStatus($vseat,$gender,$updatenewseat);
				
					if($result > 0)
					
					{
						$this->session->set_flashdata('success', 'Seat Shifting to Vacant Seat successfully done');
					}
					else
					{
						$this->session->set_flashdata('error', 'Seat Shifting to Vacant Seat Fail ! Try again');
					}
					
					redirect('seatswap/interchange');

					
					}
				
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Seat Interchange Process successfully done');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Seat Interchange Process Fail ! Try again');
                }
                
                redirect('seatswap/interchange');
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
                redirect('allotment/Allotment/viewAllotmentDetail');
            }
			
			$userId = $this->vendorId;
			
			$gender = $this->common_model->GetGenderById($userId);
			
			$gender = $gender[0]->GENDER;
			
			$data['hosteldetail'] = $this->allotment_model->getAllHostelInfo($gender);
			
            $hostelno = $this->allotment_model->getAllotmentInfobyId($AllotID, $gender);
			
			$hostelid = $hostelno[0]->HOSTELID;
			
			$roomid = $hostelno[0]->ROOMID;
			
			$regno = $hostelno[0]->REGNO;
           
		    $data['roomdetail'] = $this->allotment_model->getAllRoomInfo($hostelid, $gender);
			
			$data['seatdetail'] = $this->allotment_model->getAllSeatInfo($roomid, $gender);
			
			$data['stPerInfo'] = $this->allotment_model->VerifyUserRecordById($regno, $gender);
		   
		    $data['allotInfo'] = $this->allotment_model->getAllotmentInfobyId($AllotID, $gender);
           
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
            
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
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
				$phone = $this->input->post('phone');
				$dob = $this->input->post('dob');
				$dname = $this->input->post('dname');
				$program = $this->input->post('program');
				$faculty = $this->input->post('faculty');
				$nationality = $this->input->post('nationality');
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
				$oldhostel = $this->input->post('oldhostel');
				$oldroom = $this->input->post('oldroom');
				$oldseat = $this->input->post('oldseat');
				$allotmentid = $this->input->post('allotmentid');
				$appstatus = $this->input->post('appstatus');
				
				$doorkey = ''; $drawer = ''; $cupboardkey = ''; $matress = ''; $chair = ''; $table = '';
				
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
				
				if($hostelno != $oldhostel || $roomno != $oldroom || $seatavilabel != $oldseat)
				
				{
					$updateseatstatus = array('OCCUPIED'=>0);
					
		$result = $this->allotment_model->UpdatedSeatStatus($updateseatstatus,$oldhostel,$oldroom,$oldseat);
				}
				
            $allotmentInfo = array('SEATSTATUS'=>$status, 'GENDER'=>$gender,'STUDENTNAME'=>$studentname, 'QUOTA_TYPE'=>$seatoccupy, 'REGNO'=>$regno, 'SEATID'=>$seatavilabel, 'ROOMID'=>$roomno, 'HOSTELID'=> $hostelno, 'ALLOTEDDATE'=> $alloteddate, 'ALLOTED'=>$alloted, 'EXPIRYDATE'=>$expdate, 'ARRIVALDATE'=>$arrdate, 'ADDRESS'=>$address, 'FEEAMOUNT'=>$feeamount, 'DEPOSITDATE'=> $depodate, 'RECEIPTNO'=> $recpno, 'DOORKEYSALLOTED'=>$doorkey, 'CUPBOARDKEYSALLOTED'=>$cupboardkey, 'RDUES'=>$rdues, 'STATUS'=>$allotstatus, 'SEMCODE'=>$semcode, 'GENDER'=>$gender, 'STUDENTPHONE'=>$phone, 'ADMIN_VERIFY'=>$appstatus, 'updatedDtm'=>date('d-m-Y H:i:s'));
                
                
                $result = $this->allotment_model->editAllotment($allotmentInfo, $allotmentid);
                
				$studentemail = $this->allotment_model->getstudentemail($gender,$studentname);
			
				if ($studentemail[0]->EMAIL != NULL)
				{
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
			  $bodyContent .= '<p style="font-size:14px">Kindly visit on <b> http://usis.iiu.edu.pk:64453/login</b> <strong>to download your Allotment Slip</strong>.<br><strong>Note: </strong>Login with same email ('.$studentemail[0]->EMAIL.') and password as you had provided at time of registration. If you forget your password than reset your password.<br><br>If you have any query regarding login and Allotment slip. Email us at:<strong> hostel@iiu.edu.pk</strong>. We will reply you as soon as possible. </p>
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
                    $this->session->set_flashdata('success', 'Seat Allotment Updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Seat Allotment Updation failed');
                }
                
                redirect('allotment/Allotment/viewAllotmentDetail');
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
	
	 function getseatbyRoomId()
    {	 
		 $roomid = $this->input->post('newroomno');
		 $hostelno = $this->input->post('hostelno');
		 
		 $result = $this->interchange_model->getroombySeatId($roomid,$hostelno);
		 
		 echo json_encode($result);
		 
    }
	
	public function Fseatchange()
    {
		//$userId = $this->vendorId;
			
		//$gender = $this->common_model->GetGenderById($userId);
		
		//$gender = $gender[0]->GENDER;
		
		$studregno = $this->session->userdata('studregno');
		
		$genders = $this->reallotment_model->GetstudInfoByRegNoId($studregno);
		
		$gender = $genders[0]->GENDER;	
		
		
		$semestercode = $this->Semester_model->getsemestercodeSeatFeMale($gender);
		
		if(empty($semestercode[0]->SEATCHANGESTATUS) && $semestercode[0]->SEATCHANGESTATUS != 1)
		  {
			  echo '<i style="color:red;font-size:20px;font-family:calibri ;">Sorry! Hostel Seat Change/Interchange Application yet open or close for this semester. Please Contact Provost Hostel Office. </i><br><br> You will be redirect to previous page shortly !';
							
							
			header("refresh:10;url=http://usis.iiu.edu.pk:64453/dashboard");
							 
							//exit to prevent the rest of the script from executing
							exit;
		  }
	
		if($semestercode[0]->SEATCHANGESTATUS == 1 && $semestercode[0]->GENDER == 'Female')
		{
        	/*$userId = $this->vendorId;
			
			$gender = $this->allotment_model->GetGenderById($userId);
			
			$gender = $gender[0]->GENDER;   
			
			$emailId = $this->vendorId;*/
			
			$studregno = $this->session->userdata('studregno');
			
			$hostel = $this->interchange_model->getStudentRecordsbyRegno($studregno);
			
			$hostelid = $hostel[0]->HOSTELID;
			
			$reg = $this->interchange_model->getStudentRecordsbyRegno($studregno);
			
			$regno = $reg[0]->REGNO; $semcode = $reg[0]->SEMCODE;
			
			$recordExist = $this->interchange_model->StudentAppforchangInter($regno,$semcode);
			
			if(!empty($recordExist[0]->REGNO))
			{
								
				echo '<i style="color:red;font-size:20px;font-family:calibri ;">Wow! request for Seat Change/Inerchange Already Submitted Successfully for more info contact Hostel Admin.</i><br><br> You will be redirect to previous page shortly !';
			header( "refresh:3;url=http://usis.iiu.edu.pk:64453/dashboard" );
			 
			//exit to prevent the rest of the script from executing
			exit;
								  }
			
			$data['RoomInfo'] = $this->interchange_model->getAllRoomInfo($hostelid, $gender);
			
			$data['StudentInfo'] = $this->interchange_model->getStudentRecordsbyRegno($studregno);
			
			$data['semestercode'] = $this->Semester_model->getsemestercodeSeatFeMale($gender);
			
			$this->global['pageTitle'] = 'IIUI Hostels : Seat Change /Interchange';
        
            $this->loadViews("seatchange/addnew", $this->global, $data, NULL);
		}
		else
		{
			if($semestercode[0]->SEATCHANGESTATUS == 1 && $semestercode[0]->GENDER == 'Male')
		       {
				  
					$studregno = $this->session->userdata('studregno');
					
					$hostel = $this->interchange_model->getStudentRecordsbyRegno($studregno);
					
					$hostelid = $hostel[0]->HOSTELID;
					
					$reg = $this->interchange_model->getStudentRecordsbyRegno($studregno);
					
					$regno = $reg[0]->REGNO; $semcode = $reg[0]->SEMCODE;
					
					$recordExist = $this->interchange_model->StudentChangeMExisted($regno,$semcode);


					$stuAlreadExist = $this->interchange_model->StudentChangeRecordExisted($regno,$semcode);

					//var_dump($stuAlreadExist); 

					//get p_hostel name

					$where = array(
						'HOSTEL_NO'=>$stuAlreadExist[0]['CHOSTEL'],
						'GENDER' => 'Male'
					);

					$pre_hname = $this->common_model->getWhere('*','tbl_hostel',$where);

					$pre_hname[0]['HOSTELDESC'];

					

					//get n_hostel name

					$where = array(
						'HOSTELID'=>$stuAlreadExist[0]['HOSTEL1'],
						'GENDER' => 'Male'
					);

					$new_hname = $this->common_model->getWhere('*','tbl_hostel',$where);

					$new_hname[0]['HOSTELDESC'];



// ---------------------------------------------------------

					//get p_room number
					//get n_room number


					$where = array(
						'ROOMDESC'=>$stuAlreadExist[0]['CROOM'],
						'GENDER' => 'Male'
					);

					$pre_room = $this->common_model->getWhere('*','tbl_room',$where);

					

					//var_dump($pre_room[0]['ROOMDESC']);

					

					//get n_hostel name

					$where = array(
						'ROOMID'=>$stuAlreadExist[0]['ROOM1'],
						'GENDER' => 'Male'
					);

					$new_room = $this->common_model->getWhere('*','tbl_room',$where);

					$new_room[0]['ROOMDESC'];

// ---------------------------------------------------------

					$where = array(
						'SEATID'=>$stuAlreadExist[0]['CSEAT'],
						'GENDER' => 'Male'
					);

					$pre_seat = $this->common_model->getWhere('*','tbl_seat',$where);

					

					//var_dump($pre_seat[0]['SEAT']);

					

					//get n_hostel name

					$where = array(
						'SEATID'=>$stuAlreadExist[0]['SEAT1'],
						'GENDER' => 'Male'
					);

					$new_seat = $this->common_model->getWhere('*','tbl_seat',$where);

					$new_seat[0]['SEATDESC'];



					//get p_seat name
					//var_dump($new_seat[0]['SEAT']); exit();


					
					//get n_seat name



					//var_dump($stuAlreadExist[0]['MCHANGE_ID']); exit();



					
					if($recordExist == TRUE)
					{

						$stdinfo = array(
							'FORMID'=>$stuAlreadExist[0]['MCHANGE_ID'], 
							'REGNO'=>$stuAlreadExist[0]['REGNO'], 
							'SEMCODE'=>$stuAlreadExist[0]['SEMCODE'],
							'STUDENTNAME'=>$stuAlreadExist[0]['STUDENTNAME'], 
							'CHOSTEL'=>$stuAlreadExist[0]['CHOSTEL'], 
							'chostelname'=>$pre_hname[0]['HOSTELDESC'], 
							'currenthostelname'=>$pre_hname[0]['HOSTELDESC'], 
							'CROOM'=>$stuAlreadExist[0]['CROOM'], 
							'CSEAT'=>$stuAlreadExist[0]['CSEAT'], 
							'HOSTEL1'=>$stuAlreadExist[0]['HOSTEL1'], 
							'hostel_desc'=>$new_hname[0]['HOSTELDESC'], 
							'room_desc'=>$new_room[0]['ROOMDESC'], 
							'GENDER'=>$stuAlreadExist[0]['GENDER'], 
							'SEAT1'=>$new_seat[0]['SEAT'], 
							'CREATEDDTM'=>$stuAlreadExist[0]['CREATEDDTM']
						);


						$this->load->library('pdf');

					 	$data['oraclepic'] = $this->common_model->PictureOracle($stuAlreadExist[0]['REGNO']);


					 	//var_dump($data['oraclepic']);
						//var_dump($stdinfo); exit();
					
						$data['studInfo'] = $stdinfo;
					
						//$data['studTotalCredit'] = $studTotalCredit;
						
						//$this->pdf->load_view('reallotment/renewalform', $data);
						$this->pdf->load_view('seatchange/seatchangeform', $data);
				  
					    $this->pdf->render();
						
					    $data['Attachment'] = FALSE;
						
					    //$this->pdf->stream("seat_change_form.pdf", $data);
					    $this->pdf->stream("reallotment/ReAllotment/renewal.pdf", $data);


						//echo '<i style="color:green;font-size:20px;font-family:calibri ;">Wow! request for Seat Change Already Submitted Successfully for more info contact Hostel Admin.</i><br><br> You will be redirect to previous page shortly !';
						//header( "refresh:10;url=http://usis.iiu.edu.pk:64453/dashboard" );
			 
			//exit to prevent the rest of the script from executing
			exit;
								  }
			
			$data['RoomInfo'] = $this->interchange_model->getAllRoomInfo($hostelid, $gender);
			
			$data['HostelInfo'] = $this->interchange_model->getAllHostelInfo($gender);
			
			$data['StudentInfo'] = $this->interchange_model->getStudentRecordsbyRegno($studregno);
			
			$data['semestercode'] = $this->Semester_model->getsemestercodeSeatFeMale($gender);
			
			$this->global['pageTitle'] = 'IIUI Hostels : Seat Change /Interchange';
        
            $this->loadViews("seatchange/addnewMale", $this->global, $data, NULL);
			   }
		}
	}
	function addNewapp()
    {
       $this->form_validation->set_rules('regno','Registration No','required|max_length[128]');
          
        if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
			else
			{
				$regno = $this->input->post('regno');
				$semcode = trim($this->input->post('semcode'));
				$gender = $this->input->post('gender');
				$name = $this->input->post('name');
				$swapname = $this->input->post('swapname');
				$chostel_no = $this->input->post('chostel');
				$chostelname = $this->input->post('chostelname');
				$currenthostelname = $this->input->post('currenthostelname');
				$croomdesc = $this->input->post('croomno');
				$cseat = $this->input->post('cseat');
				$newhostel_no = $this->input->post('newhostelno');
				$newroomdesc = $this->input->post('newroomno');
				$newseat = $this->input->post('newseat');
				$swapregno = $this->input->post('swapregno');
				$swaphostel_no = $this->input->post('swaphostelno');
				$hostel_desc = $this->input->post('hostel_desc');
				$swaproomdesc = $this->input->post('swaproomno');
				$swapseat = $this->input->post('swapseat');
				date_default_timezone_set('Asia/Karachi');
				$dateTime = date('Y-m-d H:i:s');
				
				if($newhostel_no != '' && $newroomdesc != '' && $newseat != '' && $swapregno == '' && $swapseat == '')
				{
				  	if($gender == 'Female')
					  {
					    $studInfoExist = $this->interchange_model->StudentChangeExisted($regno,$semcode);
					  }
					 elseif($gender == 'Male')
					  {
					    $studInfoExist = $this->interchange_model->StudentChangeMExisted($regno,$semcode);
					  } 
					if($studInfoExist == TRUE)
					{
					$this->session->set_flashdata('success', 'Wow! you had already submitted Change request');
                redirect('seatswap/Interchange/Fseatchange');
					}
					else
					{
						$NewStudChangeInfo = array(
							'REGNO'=>$regno, 
							'SEMCODE'=>$semcode,
							'STUDENTNAME'=>$name, 
							'CHOSTEL'=>$chostel_no, 
							'CROOM'=>$croomdesc, 
							'CSEAT'=>$cseat, 
							'HOSTEL1'=>$newhostel_no, 
							'ROOM1'=>$newroomdesc, 
							'GENDER'=>$gender, 
							'SEAT1'=>$newseat, 
							'CREATEDDTM'=>$dateTime
						);

						$studChangeInserteds = $this->interchange_model->InsertStudentChangeRec($NewStudChangeInfo, $gender);

					$result = $this->interchange_model->getRoomInfobyId($newhostel_no, $newroomdesc, $gender);

					

					$where = array('SEATID' => $newseat);

					$seat_detail = $this->common_model->getWhere('*','tbl_seat',$where);

					//var_dump($seat_detail); exit();

						$stdinfo = array(
							'FORMID'=>$studChangeInserteds, 
							'REGNO'=>$regno, 
							'SEMCODE'=>$semcode,
							'STUDENTNAME'=>$name, 
							'CHOSTEL'=>$chostel_no, 
							'chostelname'=>$chostelname, 
							'currenthostelname'=>$currenthostelname, 
							'CROOM'=>$croomdesc, 
							'CSEAT'=>$cseat, 
							'HOSTEL1'=>$newhostel_no, 
							'hostel_desc'=>$hostel_desc, 
							'room_desc'=>$result[0]->ROOMDESC, 
							'GENDER'=>$gender, 
							'SEAT1'=>$seat_detail[0]['SEAT'], 
							'CREATEDDTM'=>$dateTime
						);

						//var_dump($stdinfo); exit();
						
						

						$seatInfo = array(
							'CAPTUREBY' => $regno
						);

						//$this->seat_model->editSeat($seatInfo,$newseat);

						
					if(TRUE)
					 {

					 	$this->load->library('pdf');

					 	$data['oraclepic'] = $this->common_model->PictureOracle($regno);
					
						$data['studInfo'] = $stdinfo;
					
						//$data['studTotalCredit'] = $studTotalCredit;
						
						//$this->pdf->load_view('reallotment/renewalform', $data);
						$this->pdf->load_view('seatchange/seatchangeform', $data);
				  
					    $this->pdf->render();
						
					    $data['Attachment'] = FALSE;
						
					    //$this->pdf->stream("seat_change_form.pdf", $data);
					    $this->pdf->stream("reallotment/ReAllotment/renewal.pdf", $data);

						  
						//echo '<i style="color:green;font-size:20px;font-family:calibri; padding: 20px;background-color: #f44336;color: white;opacity: 1;transition: opacity 0.6s;margin-bottom: 15px;background-color: #4CAF50;">Wow! request for Seat Change Submitted Successfully.</i><br><br> You will be redirect to previous page shortly !';
    					//header( "refresh:10;url=http://usis.iiu.edu.pk:64453/dashboard" );
					}
					else
					{
						  
						$this->session->set_flashdata('error', 'Fail! please try again');
                		redirect('seatswap/Interchange/Fseatchange');
					       
					    }
					}
				}
			
				/*else
								 {
									$this->session->set_flashdata('error', 'Oops! Select one option Seat Change or Swap/Interchange');
								redirect('seatswap/Interchange/Fseatchange'); 
							     }*/
					
				
				elseif($swapregno != '' && $swaphostel_no != '' && $swaproomdesc != '' && $swapseat != '' && $newseat == '')
							{
							    $studSwapInfoExist = $this->interchange_model->StudentSwapExisted($regno,$semcode);
								if($studSwapInfoExist == TRUE)
									{
									$this->session->set_flashdata('success', 'Wow! you had already submitted Seat Swap request');
								redirect('seatswap/Interchange/Fseatchange');
									}
								else 
									{
										$NewStudSwapInfo = array(
											'REGNO'=>$regno,
											'SWAPREGNO'=>$swapregno, 
											'SEMCODE'=>$semcode,
											'STUDENTNAME'=>$name,
											'SWAPNAME'=>$swapname, 
											'CHOSTEL'=>$chostel_no, 
											'CROOM'=>$croomdesc, 
											'CSEAT'=>$cseat, 
											'HOSTEL1'=>$swaphostel_no, 
											'ROOM1'=>$swaproomdesc, 
											'GENDER'=>$gender, 
											'SEAT1'=>$swapseat, 
											'CREATEDDTM'=>$dateTime
										);
						
						$studSwapInserteds = $this->interchange_model->InsertStudentSwapRec($NewStudSwapInfo);
						
								if($studSwapInserteds == TRUE)
								  {
									
							echo '<i style="color:green;font-size:20px;font-family:calibri; padding: 20px;background-color: #f44336;color: white;opacity: 1;transition: opacity 0.6s;margin-bottom: 15px;background-color: #4CAF50;">Wow! request for Seat Swap Submitted Successfully.</i><br><br> You will be redirect to previous page shortly !';
			header( "refresh:10;url=http://usis.iiu.edu.pk:64453/dashboard" );
			 
			//exit to prevent the rest of the script from executing
			exit;
								  }
								  else
								   {
									  
									$this->session->set_flashdata('error', 'Fail! please try again');
							redirect('seatswap/Interchange/Fseatchange');
									   
									}
										
										
									}
								
							
							}
				
			}
			
			
	}
	
}

?>