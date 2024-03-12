<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Blacklist (BlackList Controller)
 * Blacklist Class to control all Blacklist User related operations.
 * @author : Muhammad Idrees
 * @version : 2.0
 * @since : 12 November 2022
 */
class Blacklist extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('blacklist_model');
		$this->load->model('reallotment_model');
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


    function blacklistdetail()
    {   

        $gender = $this->gender;
        
        $data['blacklistRecords'] = $this->blacklist_model->getBlacklistInfo($gender);
        
        $this->global['pageTitle'] = 'IIUI Hostels : View Hostel Detail';
        
        $this->loadViews("blacklist/viewblacklist", $this->global, $data, NULL);
        
    }
	
	function blackliststatus($AllotID = NULL, $bstatus = NULL)
    {
		
        $gender = $this->gender;
			
		$blacklistInfo = array('BSTATUS'=>$bstatus);
		
		$this->blacklist_model->UpdateBlacklist($blacklistInfo, $AllotID);
        
        $data['blacklistRecords'] = $this->blacklist_model->getBlacklistInfo($gender);
        
        $this->global['pageTitle'] = 'IIUI Hostels : View Hostel Detail';
        
        $this->loadViews("blacklist/viewblacklist", $this->global, $data, NULL);
        
    }

    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        
        $this->global['pageTitle'] = 'IIUI Hostels : Add New User';

        $this->loadViews("blacklist/addNewblacklist", $this->global, NULL);
       
    }
    
    /**
     * This function is used to add new user to the system
     */
    function addNewUser()
    {
        
        $this->form_validation->set_rules('regno','Reg No','trim|required|max_length[100]|xss_clean');
        $this->form_validation->set_rules('sname','Student Name','trim|required|xss_clean|max_length[128]');
        $this->form_validation->set_rules('fname','Father Name','required|max_length[120]');
        $this->form_validation->set_rules('cnic','CNIC NO','trim|required|max_length[20]');
        $this->form_validation->set_rules('status','Status','trim|required|numeric');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', 'Validation is not running properly.');
            redirect('blacklist/blacklist/addNew');
        } else {
            $regno = $this->input->post('regno');
            $cnic = $this->input->post('cnic');
            $status = $this->input->post('status');
			$sname = $this->input->post('sname');
            $gender = $this->input->post('gender');			
			
			$allotid = $this->blacklist_model->GetAllotId($regno);

            // var_dump($allotid);
            // die();
			
			$allotmentid = $allotid[0]->ALLOTMENT_ID;
			if($allotmentid == NULL)
			{
				$allotmentid = $allotid[0]->REALLOTMENT_ID;
			}

            if($allotmentid == NULL)
            {
                $allotmentid = $allotid[0]->ID;
            }
			
			//$gender = $allotid[0]->GENDER;

            if($gender == 'M'){
                $gender = 'Male';
            } else if ($gender == 'F'){
                $gender = 'Female';
            }else{
                $gender = $allotid[0]->GENDER;
            }
			
			$HostelIdexist = $this->blacklist_model->BlacklistId_exists($allotmentid);
			
			if($HostelIdexist == true)
			{
				$this->session->set_flashdata('error', 'This Student Name already existed in Black List.');
				redirect('blacklist/blacklist/addNew');
			} else {

			    $seatId = $this->blacklist_model->GetSeatId($allotmentid);

                if($seatId > 0){                    
			
    			    $seatId = $seatId[0]->SEATID;
    			
    			    $seatInfo = array('OCCUPIED'=>0);
    			
    			    $seatId = $this->blacklist_model->UpdateSeatId($seatId,$seatInfo);

                    $result = $this->blacklist_model->deleteAllot($allotmentid);			
                }


            
                $blacklistInfo = array(
                    'GENDER'=>$gender,
                    'REGNO'=>$regno, 
                    'STUDENTNAME'=>$sname,
                    'BSTATUS'=>$status, 
                    'BCNIC'=>$cnic, 
                    'ALLOTMENT_ID'=>$allotmentid, 
                    'BDATE'=> date('Y-m-d')
                );    

                //var_dump($blacklistInfo);
               // die();            

                $result = $this->blacklist_model->addNewBlacklist($blacklistInfo);		
			    
            }
           
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'Student Record inserted in Black List successfully');
            } else {
                $this->session->set_flashdata('error', 'Student Record insertion failed');
            }
            
            redirect('blacklist/blacklist/blacklistdetail');
        }
    }

    
    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($HOSTELID = NULL)
    {        
        
        if($HOSTELID == null)
        {
            redirect('hostel/hostel/viewHostelDetail');
        }
        
        $data['hostelInfo'] = $this->hostel_model->getHostelInfobyId($HOSTELID);
        
        $this->global['pageTitle'] = 'IIUI Hostels : Edit User';
        
        $this->loadViews("hostel/editOld", $this->global, $data, NULL);        
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function editHostel()
    {         
        $this->form_validation->set_rules('hostelno','Hostel No','trim|required|max_length[10]|xss_clean|numeric');
        $this->form_validation->set_rules('hosteldesc','Hostel desc','trim|required|xss_clean|max_length[128]');
        $this->form_validation->set_rules('roomcap','roomcap','required|max_length[20]|numeric');
        $this->form_validation->set_rules('seatcap','Seat cap','trim|required|max_length[20]|numeric');
        $this->form_validation->set_rules('floors','Floors','trim|required|numeric');
        $this->form_validation->set_rules('gender','Gender','required|max_length[10]|xss_clean');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->addNew();
        }
        else
        {
            $hostelid = $this->input->post('hostelid');
			$hostelno = $this->input->post('hostelno');
            $hosteldesc = ucwords(strtolower($this->input->post('hosteldesc')));
            $roomcap = $this->input->post('roomcap');
            $seatcap = $this->input->post('seatcap');
            $floors = $this->input->post('floors');
			$gender = $this->input->post('gender');
            
            $hostelInfo = array('HOSTEL_NO'=>$hostelno, 'HOSTELDESC'=>$hosteldesc, 'ROOMCAPACITY'=>$roomcap, 'SEATCAPACITY'=> $seatcap,'FLOORS'=> $floors,'GENDER'=> $gender);
            
            
            $result = $this->hostel_model->editHostel($hostelInfo,$hostelid);
            
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'New Hostel created successfully');
            }
            else
            {
                $this->session->set_flashdata('error', 'User creation failed');
            }
            
            redirect('hostel/hostel/viewHostelDetail');
        }        
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deletehostel()
    {
        
        $hostelId = $this->input->post('hostelId');
        
        $result = $this->hostel_model->deletehostel($hostelId);
        
        if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
        else { echo(json_encode(array('status'=>FALSE))); }
        
    }
	
    function VerifyUserRecord()
    {
    	$regno = $this->input->post('regno');
		
		$gender = $this->gender;
		
		$result = $this->blacklist_model->VerifyUserRecordById($regno, $gender);
	   
	    echo json_encode($result);   
    }
    
    function revertBlackListAllallot($AllotID = NULL)
    {	
			
		$gender = $this->gender;
		
		$blacklistinfo = $this->blacklist_model->GetBlacklistInfoByUser($AllotID, $gender);
		
		$regno = $blacklistinfo[0]->REGNO; $AllotID = $blacklistinfo[0]->ALLOTMENT_ID;
			
		$data['seatinfo'] = $this->blacklist_model->geAllotSeat($gender, $AllotID);
		
		$info = $this->blacklist_model->geAllotSeat($gender, $AllotID);
		
		$emailid = $info[0]->EMAILID; $regno = $info[0]->REGNO; 
		
		$data['email'] = $this->blacklist_model->getEmail($gender, $regno, $emailid);
		
        $data['oraclepic'] = $this->common_model->PictureOracle($regno);
		
		$data['id'] = $AllotID; 

        $data['type'] = 'blacklist';
		
		$semester = $this->common_model->GetActiveSemester($gender);
		
		$history = $this->reallotment_model->GetHistorydate($regno, $gender);
	
		$semcod = $semester[0]->SEMCODE; 
		
		$expdate = $semester[0]->SMENDDATE; 
		
		$stdate = $semester[0]->STARTREGDATE;
		
		$arrdate = $history[0]->ALLOTEDDATE;
	
		$data['semcode'] = $semcod; 

        $data['expdate'] = $expdate; 

        $data['stdate'] = $stdate;  

        $data['arrdate'] = $arrdate;
		
		$data['hosteldetail'] = $this->reallotment_model->getHostelInfo($gender);
		
        $this->global['pageTitle'] = 'IIUI Hostels : Add Default Details';

        $this->loadViews("reallotment/addnewrevertallot", $this->global, $data, NULL);
    }

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'IIUI Hostels : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}

?>