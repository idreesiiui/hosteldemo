<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Muhammad Idrees 
 * @version : 2.0
 * @since : 17 November 2022
 */
class Settings extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
		$this->load->model('setting_model');
		$this->load->model('reallotment_model');
		$this->load->model('Semester_model');
		$this->load->model('report_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'IIUI Hostels : IIUI Hostel Settings';	
		
		
		$data['userSettings'] = $this->setting_model->GetSetting();
        
        $this->loadViews("setting/getsetting", $this->global, $data, NULL);
    }
	
	 public function allotbatch()
    {
		$userId = $this->vendorId;
			
		$gender = $this->common_model->GetGenderById($userId);
			
		$gender = $gender[0]->GENDER;
		
		
		
		$userinfo = $this->setting_model->Getallotuserinfo($gender);
		
		foreach($userinfo as $info)
		  {
			  $regno = $info->REGNO;
			  
			  $allotbatch = $this->setting_model->Getbatch($regno);
			  $bname = $allotbatch[0]->BATCHNAME;
			  $programe = $allotbatch[0]->PROGRAME;
			  $userinfo = array('BATCHNAME'=>$bname, 'PROGRAME'=>$programe);
				   
				   $this->setting_model->UpdateAllots($userinfo, $regno);
		  }
      
    }
	
	 public function reallotbatch()
    {
		$userId = $this->vendorId;
			
		$gender = $this->common_model->GetGenderById($userId);
			
		$gender = $gender[0]->GENDER;
		
		
		
		$userinfo = $this->setting_model->Getreallotuserinfo($gender);
		
		foreach($userinfo as $info)
		  {
			  $regno = $info->REGNO;
			  
			  $allotbatch = $this->setting_model->Getbatch($regno);
			  $bname = $allotbatch[0]->BATCHNAME;
			  $programe = $allotbatch[0]->PROGRAME;
			  $userinfo = array('BATCHNAME'=>$bname, 'PROGRAME'=>$programe);
				   
				   $this->setting_model->UpdateREAllots($userinfo, $regno);
		  }
      
    }
	
	 public function allotreallotbatch()
    {
		$userId = $this->vendorId;
			
		$gender = $this->common_model->GetGenderById($userId);
			
		$gender = $gender[0]->GENDER;
		
		
		
		$userinfo = $this->setting_model->Getallotreallotuserinfo($gender);
		
		foreach($userinfo as $info)
		  {
			  $regno = $info->REGNO;
			  
			  $allotbatch = $this->setting_model->Getbatch($regno);
			  $bname = $allotbatch[0]->BATCHNAME;
			  $programe = $allotbatch[0]->PROGRAME;
			  $userinfo = array('BATCHNAME'=>$bname, 'PROGRAME'=>$programe);
				   
				   $this->setting_model->Updateallotreallot($userinfo, $regno);
		  }
      
    }
	
	public function InsertKeyReallot()
    {
		$userId = $this->vendorId;
			
		$gender = $this->common_model->GetGenderById($userId);
			
		$gender = $gender[0]->GENDER;
		
		
		
		$userinfo = $this->setting_model->GetReallotVerify($gender);
		
		foreach($userinfo as $info)
		  {
			  $regno = $info->REGNO; $semcode = $info->SEMCODE;
			  
			  
			  $userinfo = array('REGNO'=>$regno, 'KEY'=>'RLT2110', 'TYPE'=>'ReAllotment', 'GENDER'=>$gender, 'SEMCODE'=>$semcode);
				   
				   $this->setting_model->InsertKey($userinfo);
		  }
      
    }
	
	public function settingview()
     {		
		$this->global['pageTitle'] = 'IIUI Hostels : IIUI Hostel Settings';
		
		
		
		$data['userSettings'] = $this->setting_model->GetSetting();
        
        $this->loadViews("setting/settingview", $this->global, $data, NULL);
     }
	
	public function addsettingExt()
    {
        $userId = $this->vendorId;
			
		$gender = $this->common_model->GetGenderById($userId);
			
		$gender = $gender[0]->GENDER;
		
		$data['exts'] = $this->setting_model->GetExt($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : Ext Settings';
		
		$data['gender'] = $gender;
        
        $this->loadViews("setting/addNewext", $this->global, $data, NULL);
    }
	
	public function settingExt($id)
    {
        $userId = $this->vendorId;
			
		$gender = $this->common_model->GetGenderById($userId);
			
		$gender = $gender[0]->GENDER;
		
		$data['ext'] = $this->setting_model->GetExtbyId($gender, $id);
		
		$this->global['pageTitle'] = 'IIUI Hostels : Ext Settings';
		
		$data['gender'] = $gender;
        
        $this->loadViews("setting/editNewext", $this->global, $data, NULL);
    }
	
	public function viewExt()
    {
        $userId = $this->vendorId;
			
		$gender = $this->common_model->GetGenderById($userId);
			
		$gender = $gender[0]->GENDER;
		
		$data['ext'] = $this->setting_model->GetExt($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : Ext Settings';
		
		$data['gender'] = $gender;
        
        $this->loadViews("setting/viewext", $this->global, $data, NULL);
    }
	
	public function GetdegreeByStdType()
    {
        $userId = $this->vendorId;
			
		$gender = $this->common_model->GetGenderById($userId);
			
		$gender = $gender[0]->GENDER;
		
		$studenttype = $this->input->post('studenttype');
		
		$result = $this->setting_model->GetdegreeByStdType($gender, $studenttype);
        
        echo json_encode($result);
    }
    
	public function Getdegreeduration()
    {
        $userId = $this->vendorId;
			
		$gender = $this->common_model->GetGenderById($userId);
			
		$gender = $gender[0]->GENDER;
		
		$programe = $this->input->post('programe');
		
		$studenttype = $this->input->post('studenttype');
		
		$result = $this->setting_model->Getdegreeduration($gender, $programe, $studenttype);
        
        echo json_encode($result);
    }
	
    /**
     * This function is used to load the user list
     */
    function userListing()
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
            
            $count = $this->user_model->userListingCount($searchText);

			$returns = $this->paginationCompress ( "userListing/", $count, 5 );
            
            $data['userRecords'] = $this->user_model->userListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'IIUI Hostels : User Listing';
            
            $this->loadViews("users", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function InsertSetting()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            //
            //$data['roles'] = $this->user_model->getUserRoles();
            
            $this->global['pageTitle'] = 'IIUI Hostels : Add New Hostel Settings';

            $this->loadViews("setting/addNew", $this->global, NULL);
        }
    }
	
	function addExt()
    {
		    
            
            $this->form_validation->set_rules('noofyear','noofyear','trim|required|numeric');
			$this->form_validation->set_rules('studenttype','studenttype','trim|required');
			$this->form_validation->set_rules('1stext','1stext','trim|required');
			$this->form_validation->set_rules('2ndext','2ndext','trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
				$this->settingExt();
			}
			else{
                $studenttype = $this->input->post('studenttype');
				$programe    = $this->input->post('programe');
				$noofyear    = $this->input->post('noofyear');
				$firstext    = ucfirst($this->input->post('1stext'));
				$secondext   = ucfirst($this->input->post('2ndext'));
				$extid       = $this->input->post('extid');
				
				$userId = $this->vendorId;
				$gender = $this->common_model->GetGenderById($userId);	
				$gender = $gender[0]->GENDER;
				
			    $extExist = $this->setting_model->Ext_exist($gender, $studenttype, $programe);
			
				if(empty($extExist) && $extExist == false)
				{
				$extInfo = array('studenttype'=>$studenttype,'degreetittle'=>$programe, 'noofyear'=>$noofyear, 'gender'=>$gender, '1stext'=>$firstext, '2ndext'=>$secondext, 'updated_at'=>date("Y-m-d"));
				
				$this->setting_model->InsertExt($extInfo);
				
				$this->viewExt();
            
				}
				else{
					$this->session->set_flashdata('error', 'Extension already exist. please update or delte record first');
					redirect('setting/settings/viewExt');
					
				}
				
			}
	    }
		
		function UpdateExt()
    	{	
			
            
            $this->form_validation->set_rules('noofyear','noofyear','trim|required|numeric');
			$this->form_validation->set_rules('studenttype','studenttype','trim|required');
			$this->form_validation->set_rules('1stext','1stext','trim|required');
			$this->form_validation->set_rules('2ndext','2ndext','trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
				$this->settingExt();
			}
			else{
                $studenttype = $this->input->post('studenttype');
				$programe    = $this->input->post('programe');
				$noofyear    = $this->input->post('noofyear');
				$firstext    = ucfirst($this->input->post('1stext'));
				$secondext   = ucfirst($this->input->post('2ndext'));
				$extid       = $this->input->post('extid');
				
				$userId = $this->vendorId;
				$gender = $this->common_model->GetGenderById($userId);	
				$gender = $gender[0]->GENDER;
				
				 $extExist = $this->setting_model->Ext_exist($gender, $studenttype, $programe);
			
				if(!empty($extExist) && $extExist == true)
				{	
					$extInfo = array('studenttype'=>$studenttype, 'degreetittle'=>$programe, 'noofyear'=>$noofyear, 'gender'=>$gender, '1stext'=>$firstext, '2ndext'=>$secondext, 'updated_at'=>date("Y-m-d"));
				   
				   $this->setting_model->UpdateExt($extInfo, $extid);
				   
				   $this->viewExt();
				}
				else{
					$this->session->set_flashdata('error', 'Extension already exist. please update or delte record first');
					redirect('setting/settings/viewExt');
					
				}
			}
		}
    
    /**
     * This function is used to add new user to the system
     */
    function addNewSetting()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            
            
            $this->form_validation->set_rules('distance','distance','trim|required|numeric');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->InsertSetting();
            }
            else
            {
				$distance = $this->input->post('distance');
				
				
				 
                $distanceexit = $this->setting_model->distance_exists();
				if($distanceexit == true)
                {
                    $this->session->set_flashdata('error', 'Distance already exist Please Update distance');
					redirect('setting/settings/InsertSetting');
				}
				else
				{
                
                $userInfo = array('DISTANCE'=>$distance);
                
				
			    $result = $this->setting_model->InsertSetting($userInfo);
				
				}
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Setting created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Setting creation failed');
                }
                
                redirect('setting/settings/');
            }
        }
    }

    
    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editsetting($SETTINGID = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($SETTINGID == null)
            {
                redirect('setting/settings/');
            }
			
            
			
            $data['settingInfo'] = $this->setting_model->getSettingInfo($SETTINGID);
            
            $this->global['pageTitle'] = 'IIUI Hostels : Edit Setting';
            
            $this->loadViews("setting/edit", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function edit()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {   
			
            
            
            $distance = $this->input->post('distance');
			
			$SETTINGID = $this->input->post('settingid');
            
            $this->form_validation->set_rules('distance','distance','trim|required|numeric');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editsetting($SETTINGID);
            }
            else
            {
				
				
                $userInfo = array('DISTANCE'=>$distance);
                
                $result = $this->setting_model->editSET($userInfo, $SETTINGID);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Setting updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Setting updation failed');
                }
                
                redirect('setting/settings/');
            }
        }
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteext()
    {
       
            $userId = $this->input->post('userId');
            
            $result = $this->setting_model->deleteext($userId);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        
    } 
	
	public function migtoallotreallot()
    {
        $userId = $this->vendorId;
			
		$gender = $this->common_model->GetGenderById($userId);
			
		$gender = $gender[0]->GENDER;
		
		$allallotment = $this->setting_model->GetSeminfo($gender);
		
		if(empty($allallotment[0]->SEMCODE))
		{
			$this->session->set_flashdata('error', 'No Data in Allotment');
			redirect('setting/settings/'); 
		}
		
		$semcode = $allallotment[0]->SEMCODE; 
		
		$migrate = $this->setting_model->Getmigrate($gender, $semcode);
		
		if(empty($migrate[0]->SEMCODE))
		{
			$allallotments = $this->setting_model->GetAllallotment($gender);
				
			//$reallallotments = $this->setting_model->GetREAllallotment($gender);
		   
		   foreach($allallotments as $record)
		   {
		   		
				$allotid = $seatstatus = $record->SEATSTATUS;
				$regno = $record->REGNO; 
				$studentname = $record->STUDENTNAME; 
				$studentphone = $record->STUDENTPHONE; 
				$fathername = $record->FATHERNAME; 
				$address = $record->ADDRESS; 
				$gender = $record->GENDER; 
				$seatid = $record->SEATID; 
				$roomid = $record->ROOMID;
				$hostelid = $record->HOSTELID; 
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
				$guestregno = $record->GUESTREGNO; 
				$quotatype = $record->QUOTA_TYPE; 
				$type = $record->TYPE; 
				$picpath = $record->PICPATH; 
				$picname = $record->PICNAME; 
				$feepath = $record->FEEPATH; 
				$feepic = $record->FEEPIC; 
				$issubmit = $record->IS_SUBMIT; 
				$adminverify = $record->ADMIN_VERIFY; 
				$emailid = $record->EMAILID; 
				$caddress = $record->CADDRESS; 
				$country = $record->COUNTRY; 
				$nationality = $record->NATIONALITY; 
				$batchname = $record->BATCHNAME; 
				$programe = $record->PROGRAME; 
				$protittle = $record->PROTITTLE; 
				$district = $record->DISTRICT; 
				$province = $record->PROVINCE; 
				$cnic = $record->CNIC; 
				$departname = $record->DEPARTNAME; 
				$faculty = $record->FACULTY; 
				$ext = $record->EXT; 
				$remarks = $record->REMARKS; 
				$updatedtm = $record->updatedDtm;

				$studentinfo = $this->report_model->GetHistoryBatch($regno);
			
				$userInfo = array(
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
					'ALLOTTYPE' => $allottype,
					'ALLOTEDDATE' => $allotdate, 
					'EXPIRYDATE' => $expirydate, 
					'ARRIVALDATE' => $arrivaldate, 
					'FEEAMOUNT' => $feeamount,
					'DEPOSITDATE' => $depotdate, 
					'RECEIPTNO' => $recepitno, 
					'DOORKEYSALLOTED' => $doorkeyallot, 
					'CUPBOARDKEYSALLOTED' => $cupkeyallot,
					'MESSDUESCLEAR' => $messdueclear, 
					'VACCANTDATE' => $vacantdate, 
					'STATUS' => $status, 
					'RDUES' => $rdues,
					'SEMCODE' => ($adminverify == 2) ? 'FALL-2023':$semcode, 
					'GUESTREGNO' => $guestregno, 
					'QUOTA_TYPE' => $quotatype,
					'TYPE' => $type, 
					'PICPATH' => $picpath, 
					'PICNAME' => $picname, 
					'FEEPATH' => $feepath,
					'FEEPIC' => $feepic, 
					'IS_SUBMIT' => 0, 
					'ADMIN_VERIFY' => 0, 
					'EMAILID' => $emailid, 
					'CADDRESS' => $caddress, 
					'COUNTRY' => $country, 
					'NATIONALITY' => $nationality, 
					'BATCHNAME' => $batchname,
					'HOSTELBATCH' => $studentinfo->semcode,
					'PROGRAME' => $programe, 
					'PROTITTLE' => $protittle, 
					'DISTRICT' => $district, 
					'PROVINCE' => $province, 
					'CNIC' => $cnic, 
					'DEPARTNAME' => $departname, 
					'FACULTY' => $faculty, 
					'EXT' => $ext, 
					'REMARKS' => $remarks, 
					'FEESTATUS' => 1, 
					'updatedDtm' => date('Y-m-d')
				);
					
				$default = $this->setting_model->InsertAllotReallot($userInfo);
					
				$userInfo = array('regno'=>$regno);
				
				/** Update Regno of student in user table **/
				
				    //$this->setting_model->UpdateUserInfo($userInfo, $emailid);
				$this->setting_model->DeleteAllRecordAllot($gender,$regno);
					
			}

			$seminfo = $this->setting_model->GetSeminfo($gender);

			$semestercode = $seminfo[0]->SEMCODE;

			$semInfo = array(
				'SEMCODE' => $semestercode, 
				'GENDER' => $gender, 
				'ALLOTTYPE' => 'Allotment', 
				'CREATED_DATE' => date('Y-m-d')
			);
				
			$insertmigrate = $this->setting_model->Insertmigrate($semInfo);
			
		}
				
		if(!empty($migrate[0]->SEMCODE) && isset($migrate[0]->SEMCODE)){
		      	$this->session->set_flashdata('error', 'All Allotment Data already Shifted to AllotReallot for Current Semester');
					redirect('setting/settings/');
		}
		        
        			
					
		$this->session->set_flashdata('success', 'All Allotment Data Shifted to AllotReallot for Current Semester');
		redirect('setting/settings/');
    }
	
	public function migrationofReallot()
    {
        $userId = $this->vendorId;
			
		$gender = $this->common_model->GetGenderById($userId);
			
		$gender = $gender[0]->GENDER;
		
		$reallallotment = $this->setting_model->GetSeminfo($gender);
		
		if(empty($reallallotment[0]->SEMCODE))
		  {
			 $this->session->set_flashdata('error', 'No Data in RE-Allotment');
			 redirect('setting/settings/'); 
		  }
		
		$semcode = $reallallotment[0]->SEMCODE; 
		
		$migrate = $this->setting_model->GetReallotmigrate($gender, $semcode);
		
		if(empty($migrate[0]->SEMCODE)){
				
				$reallallotments = $this->setting_model->GetREAllallotment($gender);
		   
		   foreach($reallallotments as $record)
		   			{
						$allotid = $seatstatus = $record->SEATSTATUS; 
						$regno = $record->REGNO; 
						$studentname = $record->STUDENTNAME; 
						$studentphone = $record->STUDENTPHONE; 
						$fathername = $record->FATHERNAME; 
						$address = $record->ADDRESS; 
						$gender = $record->GENDER; 
						$seatid = $record->SEATID; 
						$roomid = $record->ROOMID;
						$hostelid = $record->HOSTELID; 
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
						$guestregno = $record->GUESTREGNO; 
						$quotatype = $record->QUOTA_TYPE; 
						$type = $record->TYPE; 
						$picpath = $record->PICPATH; 
						$picname = $record->PICNAME; 
						$feepath = $record->FEEPATH; 
						$feepic = $record->FEEPIC; 
						$issubmit = $record->IS_SUBMIT; 
						$adminverify = $record->ADMIN_VERIFY; 
						$emailid = $record->EMAILID; 
						$caddress = $record->CADDRESS; 
						$country = $record->COUNTRY; 
						$nationality = $record->NATIONALITY; 
						$batchname = $record->BATCHNAME; 
						$programe = $record->PROGRAME; 
						$protittle = $record->PROTITTLE; 
						$district = $record->DISTRICT; 
						$province = $record->PROVINCE; 
						$cnic = $record->CNIC; 
						$departname = $record->DEPARTNAME; 
						$faculty = $record->FACULTY; 
						$ext = $record->EXT; 
						$updatedtm = $record->UPDATEDDTM;

						$studentinfo = $this->report_model->GetHistoryBatch($regno);
					
					$userInfo = array(
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
									'ALLOTTYPE' => $allottype,
									'ALLOTEDDATE' => $allotdate, 
									'EXPIRYDATE' => $expirydate, 
									'ARRIVALDATE' => $arrivaldate, 
									'FEEAMOUNT' => $feeamount,
									'DEPOSITDATE' => $depotdate, 
									'RECEIPTNO' => $recepitno, 
									'DOORKEYSALLOTED' => $doorkeyallot, 
									'CUPBOARDKEYSALLOTED' => $cupkeyallot,
									'MESSDUESCLEAR' => $messdueclear, 
									'VACCANTDATE' => $vacantdate, 
									'STATUS' => $status, 
									'RDUES' => $rdues,
									//'SEMCODE' => $semcode, 
									'SEMCODE' => ($adminverify == 2) ? 'FALL-2023':$semcode, 
									'GUESTREGNO' => $guestregno, 
									'QUOTA_TYPE' => $quotatype,
									'TYPE' => $type, 
									'PICPATH' => $picpath, 
									'PICNAME' => $picname, 
									'FEEPATH' => $feepath,
									'FEEPIC' => $feepic, 
									'IS_SUBMIT' => 0, 
									'ADMIN_VERIFY' => 0, 
									'EMAILID' => $emailid, 
									'CADDRESS' => $caddress, 
									'COUNTRY' => $country, 
									'NATIONALITY' => $nationality, 
									'BATCHNAME' => $batchname,
									'HOSTELBATCH' => $studentinfo->semcode, 
									'PROGRAME' => $programe, 
									'PROTITTLE' => $protittle, 
									'DISTRICT' => $district, 
									'PROVINCE' => $province, 
									'CNIC' => $cnic, 
									'DEPARTNAME' => $departname, 
									'FACULTY' => $faculty, 
									'EXT' => $ext, 
									'FEESTATUS' => 1, 
									'updatedDtm' => date('Y-m-d'));
					
					//$default = $this->reallotment_model->InsertReAllotment($userInfo);

					$default = $this->setting_model->InsertAllotReallot($userInfo);
					$this->setting_model->DeleteAllRecordReallot($gender,$regno);
					$userInfo = array('regno'=>$regno);
				
				/** Update Regno of student in user table **/
				
					//$this->setting_model->UpdateUserInfo($userInfo, $emailid);
					}
					$seminfo = $this->setting_model->GetSeminfo($gender);
					
					$semestercode = $seminfo[0]->SEMCODE;
				
				$semInfo = array('SEMCODE'=>$semestercode, 'GENDER'=>$gender, 'ALLOTTYPE'=>'ReAllotment', 'CREATED_DATE'=>date('Y-m-d'));
				
				$insertmigrate = $this->setting_model->InserReAllottmigrate($semInfo);
				
		}
		if(!empty($migrate[0]->SEMCODE) && isset($migrate[0]->SEMCODE)){
		      	$this->session->set_flashdata('error', 'All RE-Allotment Data already Shifted to AllotReallot for Current Semester');
					redirect('setting/settings/');
		}
		        	
        			
					$this->session->set_flashdata('success', 'All RE-Allotment Data Shifted to AllotReallot for Current Semester');
					redirect('setting/settings/');
    }
	
	public function updatebatchinfo()
    {
        $userId = $this->vendorId;
			
		$gender = $this->common_model->GetGenderById($userId);
			
		$gender = $gender[0]->GENDER;
			
		$reginfos = $this->setting_model->Getreginfo($gender);
		
		foreach($reginfos as $reginfo)
		    {
				$regno = $reginfo->REGNO;
				
				$batch = $this->setting_model->Getbatch($regno);
				
				if($batch)
				{
					$batchInfo = array('BATCHNAME'=>$batch[0]->BATCHNAME);
					
					$this->setting_model->Updatebatchname($batchInfo, $regno, $gender);
				}
			}
			
			echo $this->session->set_flashdata('success', 'Updation of batchname done succesfully');
		
	}

	public function createHistory(){

		$userId = $this->vendorId;
			
		$gender = $this->common_model->GetGenderById($userId);
			
		$gender = $gender[0]->GENDER;


		$CurrentSemester = $this->report_model->CurrentSemester($gender)->semcode;

		// echo $gender;
		// // get all user
		// $currentsemcode = 'FALL-2022';
		
		$regnoinfos = $this->report_model->GetAllregnoInfo($CurrentSemester, $gender);


	 //   	var_dump($regnoinfos);		

		// exit();

		if(!empty($regnoinfos))
		{
		   	$count = 0;

			foreach($regnoinfos as $regnoinfo)
			{
	
				 $studregno = $regnoinfo->REGNO;

				$studentinfo = $this->report_model->GetHistoryBatch($studregno);

					// var_dump($studentinfo);
					// exit();
					
				if(empty($studentinfo)){
							
					//$upregno = $studentinfo->regno;
					//$upsemcode = $studentinfo->semcode;



					$createHostelHisotryData = array(

						   	'SEATSTATUS' => $regnoinfo->SEATSTATUS,
						    'REGNO' => $regnoinfo->REGNO,
						    'STUDENTNAME' => $regnoinfo->STUDENTNAME,
						    'STUDENTPHONE' => $regnoinfo->STUDENTPHONE,
						    'FATHERNAME' => $regnoinfo->FATHERNAME,
						    'FATHERPHONE' => $regnoinfo->FATHERPHONE,
						    'FATHEROCCUPATION' => $regnoinfo->FATHEROCCUPATION,
						    'ADDRESS' => $regnoinfo->ADDRESS,
						    'GENDER' => $regnoinfo->GENDER,
						    'SEATID' => $regnoinfo->SEATID,
						    'ROOMID' => $regnoinfo->ROOMID,
						    'HOSTELID' => $regnoinfo->HOSTELID,
						    'ALLOTED' => $regnoinfo->ALLOTED,
						    'ALLOTTYPE' => $regnoinfo->ALLOTTYPE,
						    'ALLOTEDDATE' => $regnoinfo->ALLOTEDDATE,
						    'EXPIRYDATE' => $regnoinfo->EXPIRYDATE,
						    'ARRIVALDATE' => $regnoinfo->ARRIVALDATE,
						    'FEEAMOUNT' => $regnoinfo->FEEAMOUNT,
						    'DEPOSITDATE' => $regnoinfo->DEPOSITDATE,
						    'RECEIPTNO' => $regnoinfo->RECEIPTNO,
						    'DOORKEYSALLOTED' => $regnoinfo->DOORKEYSALLOTED,
						    'CUPBOARDKEYSALLOTED' => $regnoinfo->CUPBOARDKEYSALLOTED,
						    'MESSDUESCLEAR' => $regnoinfo->MESSDUESCLEAR,
						    'VACCANTDATE' => $regnoinfo->VACCANTDATE,
						    'STATUS' => $regnoinfo->STATUS,
						    'RDUES' => $regnoinfo->RDUES,
						    'SEMCODE' => $regnoinfo->SEMCODE,
						    'GUESTREGNO' => $regnoinfo->GUESTREGNO,
						    'QUOTA_TYPE' => $regnoinfo->QUOTA_TYPE,
						    'TYPE' => $regnoinfo->TYPE,
						    'PICPATH' => $regnoinfo->PICPATH,
						    'PICNAME' => $regnoinfo->PICNAME,
						    'FEEPATH' => $regnoinfo->FEEPATH,
						    'FEEPIC' => $regnoinfo->FEEPIC,
						    'IS_SUBMIT' => $regnoinfo->IS_SUBMIT,
						    'ADMIN_VERIFY' => $regnoinfo->ADMIN_VERIFY,
						    'EMAILID' => $regnoinfo->EMAILID,
						    'CADDRESS' => $regnoinfo->CADDRESS,
						    'COUNTRY' => $regnoinfo->COUNTRY,
						    'NATIONALITY' => $regnoinfo->NATIONALITY,
						    'PROTITTLE' => $regnoinfo->PROTITTLE,
						    'PROGRAME' => $regnoinfo->PROGRAME,
						    'BATCHNAME' => $regnoinfo->BATCHNAME,
						    'HOSTELBATCH' => 'SUM-2022',
						    'DISTRICT' => $regnoinfo->DISTRICT,
						    'PROVINCE' => $regnoinfo->PROVINCE,
						    'CNIC' => $regnoinfo->CNIC,
						    'DEPARTNAME' => $regnoinfo->DEPARTNAME,
						    'FACULTY' => $regnoinfo->FACULTY,
						    'EXT' => $regnoinfo->EXT,
						    'REMARKS' => $regnoinfo->REMARKS,
						   // 'FEESTATUS' => $regnoinfo->FEESTATUS,
						    'updatedDtm' => $regnoinfo->UPDATEDDTM

			      	);

		

			  //     	var_dump($createHostelHisotryData);
					// exit();
				

					// if($this->report_model->insertIntoAlotmentHistory($createHostelHisotryData)){

					// 	echo "<br>";
					// 	echo $count.' Insert History date of '.$regnoinfo->REGNO.' for '.$gender.' in semester'.$currentsemcode;
					// 	echo "<br>";
						
					// }else{
					// 	echo $count;
					// 	echo "<br>";
					// 	echo 'Insertion Failed'.$regnoinfo->REGNO;
					// 	echo "<br>";

					// }
					
				}
				
				$count++;
			}
		}
	}


	function hostelbatchupdate(){
		
		// $currentsemcode = 'FALL-2022';
		// $gender = 'Male';


		$userId = $this->vendorId;
			
		$gender = $this->common_model->GetGenderById($userId);
			
		$gender = $gender[0]->GENDER;


		$CurrentSemester = $this->report_model->CurrentSemester($gender)->semcode;

		// var_dump($CurrentSemester);
		// echo "test"; exit();

		//echo "updateing hostel batches";
		$regnoinfos = $this->report_model->GetAllregnoInfo($CurrentSemester, $gender);
		// var_dump($regnoinfos);
		// exit();

		//$studregno = '638-FA/BSTI/S18';

		//$studentinfo = $this->report_model->GetHistoryBatch($studregno);

		if(!empty($regnoinfos)){
					   $count = 0;
						foreach($regnoinfos as $regnoinfo){
							
								$studregno = $regnoinfo->REGNO;
								
								$studentinfo = $this->report_model->GetHistoryBatch($studregno);
								
								if(!empty($studentinfo)){
										
									$upregno = $studentinfo->regno;
									$upsemcode = $studentinfo->semcode;
									$hostelbatch = $studentinfo->hostelbatch;
								
								$updatehostelbatch = array('HOSTELBATCH' => $hostelbatch);
		// var_dump($upregno);
		// var_dump($updatehostelbatch);
		// exit();
								
								$result = $this->report_model->UpdateHostelBatch($upregno, $updatehostelbatch, $CurrentSemester);
								
								$count++;
								
								}
								
								if($result > 0){
									  echo $count.'Updated Hostel batch for '.$gender.' in semester'.$CurrentSemester;
								  }
								  else{
									    echo 'Updation Failed';
								  }
								
						}
		}
	}

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'IIUI Hostels : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }
	
	/**
     * This function used to load the view of credit Setting
     */
    public function viewCredit()
    {
        		
		
		
		
		
		$userId = $this->vendorId;
			
		$gender = $this->common_model->GetGenderById($userId);
			
		$gender = $gender[0]->GENDER;
		
		$data['CreditSettings'] = $this->setting_model->GetCreditSettings($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : IIUI Hostel Settings';
        
        $this->loadViews("setting/credithour/view", $this->global, $data, NULL);
    }
	
	public function addNewCredit()
    {   		
		
		$userId = $this->vendorId;
			
		$gender = $this->common_model->GetGenderById($userId);
			
		$gender = $gender[0]->GENDER;
			
		$data['semestercode'] = $this->setting_model->getsemestercode($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : IIUI Hostel Settings';
        
        $this->loadViews("setting/credithour/addNew", $this->global, $data, NULL);
    }
	
	public function addNewCreditInfo()
    {
     
		if($this->isTicketter() == FALSE)
        {
            $this->loadThis();
        }
        else
        {            
            
            $this->form_validation->set_rules('semcode','Semcode','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('status','Status','trim|required|numeric|xss_clean|max_length[1]');
            $this->form_validation->set_rules('bscredit','BS Credit Hours','trim|required|numeric|xss_clean|less_than[13]');
			$this->form_validation->set_rules('macredit','MA Credit Hours','trim|required|numeric|xss_clean|max_length[1]');
			$this->form_validation->set_rules('mscredit','MS Credit Hours','trim|required|numeric|xss_clean|max_length[1]');
			$this->form_validation->set_rules('phdcredit','PHD Credit Hours','trim|required|numeric|xss_clean|max_length[1]');
			$this->form_validation->set_rules('bscreditfor','BS Credit Hours Foreginer','trim|required|numeric|xss_clean|less_than[13]');
			$this->form_validation->set_rules('macreditfor','MA Credit Hours Foreginer','trim|required|numeric|xss_clean|max_length[1]');
			$this->form_validation->set_rules('mscreditfor','MS Credit Hours Foreginer','trim|required|numeric|xss_clean|max_length[1]');
			$this->form_validation->set_rules('phdcreditfor','PHD Credit Hours Foreginer','trim|required|numeric|xss_clean|max_length[1]');
			$this->form_validation->set_rules('type','Type','trim|required|xss_clean|max_length[120]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNewCredit();
            }
            else
            {
                $bscredit = $this->input->post('bscredit');
                $macredit = $this->input->post('macredit');
                $mscredit = $this->input->post('mscredit');
				$phdcredit = $this->input->post('phdcredit');
				$bscreditfor = $this->input->post('bscreditfor');
                $macreditfor = $this->input->post('macreditfor');
                $mscreditfor = $this->input->post('mscreditfor');
				$phdcreditfor = $this->input->post('phdcreditfor');
				$semcode = $this->input->post('semcode');
                $status = $this->input->post('status');
				$type = $this->input->post('type');
				$mba1 = $this->input->post('mba1credit');
				$mba3 = $this->input->post('mba3credit');
				$mba1f = $this->input->post('mba1creditfor');
				$mba3f = $this->input->post('mba3creditfor');
							
		
				
				
				$userId = $this->vendorId;
					
				$gender = $this->common_model->GetGenderById($userId);
					
				$gender = $gender[0]->GENDER;
				
				$creditinfo = $this->setting_model->IfExisted($gender, $semcode);
				
				if($creditinfo == true)
				{
					$this->session->set_flashdata('error', 'This Credit Settings already exist');
						
					redirect ('addnewCredit');
				}
				else
				{
					$creditInfo = array('BSPAK'=>$bscredit, 'MAPAK'=>$macredit, 'MBA_1'=>$mba1, 'MBA3'=>$mba3, 'MBA_1_FOREIGNER'=>$mba1f, 'MBA3_FOREIGNER'=>$mba3f, 'MSPAK'=>$mscredit, 'PHDPAK'=> $phdcredit, 'BSFOREIGNER'=> $bscreditfor, 'MAFOREIGNER'=> $macreditfor,'MSFOREIGNER'=>$mscreditfor, 'PHDFOREIGNER'=>$phdcreditfor, 'SEMCODE'=>$semcode, 'STATUS'=>$status, 'createdBy'=>$this->vendorId, 'GENDER'=>$gender, 'TYPE'=>$type, 'CREATED_AT'=>date('Y-m-d H:i:s'), 'UPDATED_AT'=>date('Y-m-d H:i:s'));
                
                    $this->setting_model->AddcreditInfo($creditInfo);
					
					redirect ('credithour');
				}
				
			}
		}
    }
	
	/**
     * This function used to load the view of credit Setting
     */
    public function editCredit($id)
    {
        
		 if($id == null)
            {
                redirect('credithour');
            }		
		
		
		
		$userId = $this->vendorId;
			
		$gender = $this->common_model->GetGenderById($userId);
			
		$gender = $gender[0]->GENDER;
		
		$data['CreditSettings'] = $this->setting_model->GetCreditSettingsById($gender, $id);
		
		$data['semesters'] = $this->Semester_model->semesterListing($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : IIUI Hostel Settings';
        
        $this->loadViews("setting/credithour/editOld", $this->global, $data, NULL);
    }
	
	/**
     * This function used to load the view of credit Setting
     */
    public function editcardInfo()
    {
     
		if($this->isTicketter() == FALSE)
        {
            $this->loadThis();
        }
        else
        {
            $id = $this->input->post('id');
			
			
            
            $this->form_validation->set_rules('id','ID','trim|required|numeric|max_length[128]|xss_clean');
			$this->form_validation->set_rules('semcode','Semcode','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('status','Status','trim|required|numeric|xss_clean|max_length[1]');
            $this->form_validation->set_rules('bscredit','BS Credit Hours','trim|required|numeric|xss_clean|max_length[10]');
			$this->form_validation->set_rules('macredit','MA Credit Hours','trim|required|numeric|xss_clean|max_length[1]');
			$this->form_validation->set_rules('mscredit','MS Credit Hours','trim|required|numeric|xss_clean|max_length[1]');
			$this->form_validation->set_rules('phdcredit','PHD Credit Hours','trim|required|numeric|xss_clean|max_length[1]');
			$this->form_validation->set_rules('bscreditfor','BS Credit Hours Foreginer','trim|required|numeric|xss_clean|max_length[10]');
			$this->form_validation->set_rules('macreditfor','MA Credit Hours Foreginer','trim|required|numeric|xss_clean|max_length[1]');
			$this->form_validation->set_rules('mscreditfor','MS Credit Hours Foreginer','trim|required|numeric|xss_clean|max_length[1]');
			$this->form_validation->set_rules('phdcreditfor','PHD Credit Hours Foreginer','trim|required|numeric|xss_clean|max_length[1]');
			$this->form_validation->set_rules('type','Type','trim|required|xss_clean|max_length[120]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editcredit($id);
            }
            else
            {
                $id = $this->input->post('id');
				$bscredit = $this->input->post('bscredit');
                $macredit = $this->input->post('macredit');
				$mba1credit = $this->input->post('mba1credit');
				$mba3credit = $this->input->post('mba3credit');
                $mscredit = $this->input->post('mscredit');
				$phdcredit = $this->input->post('phdcredit');
				$bscreditfor = $this->input->post('bscreditfor');
                $macreditfor = $this->input->post('macreditfor');
				$mba1creditfor = $this->input->post('mba1creditfor');
				$mba3creditfor = $this->input->post('mba3creditfor');
                $mscreditfor = $this->input->post('mscreditfor');
				$phdcreditfor = $this->input->post('phdcreditfor');
				$semcode = $this->input->post('semcode');
                $status = $this->input->post('status');
				$type = $this->input->post('type');
		
				
				
				$userId = $this->vendorId;
					
				$gender = $this->common_model->GetGenderById($userId);
					
				$gender = $gender[0]->GENDER;
				
				
					$creditInfo = array('BSPAK'=>$bscredit, 'MAPAK'=>$macredit, 'MBA_1'=>$mba1credit, 'MBA3'=>$mba3credit, 'MSPAK'=>$mscredit, 'PHDPAK'=> $phdcredit, 'BSFOREIGNER'=> $bscreditfor, 'MAFOREIGNER'=> $macreditfor,'MBA_1_FOREIGNER'=>$mba1creditfor, 'MBA3_FOREIGNER'=>$mba3creditfor, 'MSFOREIGNER'=>$mscreditfor, 'PHDFOREIGNER'=>$phdcreditfor, 'SEMCODE'=>$semcode, 'STATUS'=>$status, 'createdBy'=>$this->vendorId, 'GENDER'=>$gender, 'TYPE'=>$type, 'CREATED_AT'=>date('Y-m-d H:i:s'), 'UPDATED_AT'=>date('Y-m-d H:i:s'));
                
                    
					$result = $this->setting_model->EditcreditInfo($creditInfo, $id);
					
					if($result > 0)
					{
						$this->session->set_flashdata('success', 'Updated Successfully');
				    	
						redirect('credithour'); 
					}
					else{
						  $this->session->set_flashdata('error', 'Updation Failed. try! again');
				    	  
						  $this->editcredit($userId);
					}
				
			}
		}
    }
	
	public function contentUpload()
     {		
		$this->global['pageTitle'] = 'IIUI Hostels : IIUI Hostel Website Content';
		
		$userId = $this->vendorId;
			
		$gender = $this->common_model->GetGenderById($userId);
			
		$gender = $gender[0]->GENDER;
		
		$data['webcontents'] = $this->setting_model->getWebsiteContent($gender);
        
        $this->loadViews("website/view", $this->global, $data, NULL);
     }
	 
	 public function contentAdd()
     {		
		$this->global['pageTitle'] = 'IIUI Hostels : IIUI Hostel Website Content';
        
        $this->loadViews("website/addNew", $this->global, NULL, NULL);
     }
	 
	 public function addNewContent()
     {	 
	 	if($this->input->post('desc') && $_FILES["image"]['name'] && $this->input->post('type'))
		{
			$userId = $this->vendorId;
			$gender = $this->common_model->GetGenderById($userId);
			$gender = $gender[0]->GENDER;
			$type = $this->input->post('type');
			$desc = $this->input->post('desc');
			$pubdate = $this->input->post('pubdate');
			$image = $type.'-'.date('dmyh');
			$status = 1;
			
			if($type == 'Notification' && $gender == 'Male'){
				$path = 'uploads/notifications/female/notifications/';
			}
			elseif($type == 'List' && $gender == 'Male'){
				$path = 'uploads/notifications/male/list/';
			}
			elseif($type == 'Notification' && $gender == 'Female'){
				$path = 'uploads/notifications/female/notifications/';
			}
			elseif($type == 'List' && $gender == 'Female'){
				$path = 'uploads/notifications/female/list/';
			}
			
			$config = array(
			'upload_path' => $path,
			'allowed_types' => "gif|jpg|png|jpeg|JPEG|JPG|PNG|GIF|pdf",
			'overwrite' => TRUE,
			'max_size' => "2048",
			'max_height' => "1200",
			'max_width' => "1500",
			'file_name' => $image
			);
			$this->load->library('upload', $config); 
			
			if($this->upload->do_upload('image'))
			{	
				$InsertWebContent = array('type'=>$type,'upload_desc'=>$desc,'pubdate'=>$pubdate,'path'=>$path.$image,'gender'=>$gender,'status'=>$status,'created_by'=>$userId);
				$result = $this->setting_model->InsertWebContent($InsertWebContent);
				if($result == true){
					$this->session->set_flashdata('success', 'Web Content Uploaded Succesfully');
					redirect('setting/Settings/contentAdd');
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Max File Size to upload 2MB');
				redirect('setting/Settings/contentAdd');
			}
		}
		else{
			    $this->session->set_flashdata('error', 'The Uploaded file does not supported. Convert your file https://image.online-convert.com/convert/pdf-to-jpg');
				redirect('setting/Settings/contentAdd');
		}
	
     }
	 
	 public function contentEdit($id)
     {				
		$data['content'] = $this->setting_model->getWebsiteContentById($id);
		
		$this->global['pageTitle'] = 'IIUI Hostels : IIUI Hostel Website Content';
        
        $this->loadViews("website/edit", $this->global, $data, NULL);
     }
	 
	 public function UpdateWebContent()
     {				
		if($this->input->post('desc') && $this->input->post('type'))
		{
			$userId = $this->vendorId;
			$gender = $this->common_model->GetGenderById($userId);
			$gender = $gender[0]->GENDER;
			$id = $this->input->post('id');
			$type = $this->input->post('type');
			$desc = $this->input->post('desc');
			$pubdate = $this->input->post('pubdate');
			$image = $type.'-'.date('dmyh');
			$status = $this->input->post('status');
			
			if($type == 'Notification' && $gender == 'Male'){
				$path = 'uploads/notifications/female/notifications/';
			}
			elseif($type == 'List' && $gender == 'Male'){
				$path = 'uploads/notifications/male/list/';
			}
			elseif($type == 'Notification' && $gender == 'Female'){
				$path = 'uploads/notifications/female/notifications/';
			}
			elseif($type == 'List' && $gender == 'Female'){
				$path = 'uploads/notifications/female/list/';
			}
			
			$config = array(
			'upload_path' => $path,
			'allowed_types' => "gif|jpg|png|jpeg|JPEG|JPG|PNG|GIF|pdf",
			'overwrite' => TRUE,
			'max_size' => "2048",
			'max_height' => "800",
			'max_width' => "1500",
			'file_name' => $image
			);
			$this->load->library('upload', $config); 
			
			if($this->upload->do_upload('image') && $_FILES["image"]['name'] != '')
			{	
				$InsertWebContent = array('type'=>$type,'upload_desc'=>$desc,'pubdate'=>$pubdate,'path'=>$path.$image,'gender'=>$gender,'status'=>$status,'modify_by'=>$userId);
				$result = $this->setting_model->UpdateWebContent($InsertWebContent, $id);
				if($result == true){
					$this->session->set_flashdata('success', 'Web Content Updated Succesfully');
					redirect('setting/Settings/contentUpload');
				}
			}
			elseif($_FILES["image"]['name'] == '')
			{
				$InsertWebContent = array('type'=>$type,'upload_desc'=>$desc,'pubdate'=>$pubdate,'gender'=>$gender,'status'=>$status,'modify_by'=>$userId);
				$result = $this->setting_model->UpdateWebContent($InsertWebContent, $id);
				if($result == true){
					$this->session->set_flashdata('success', 'Web Content Updated Succesfully');
					redirect('setting/Settings/contentUpload');
				}
			}
			else
			{	
				$this->session->set_flashdata('error', 'Max File Size to upload 2Mb');
				redirect('setting/Settings/contentEdit/'.$id);
			}
		}
     }
	 
	 function deleteWeb()
    {
       
            $webId = $this->input->post('webId');
            
            $result = $this->setting_model->deleteweb($webId);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        
    }    
}

?>