<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// ini_set('memory_limit', '-1');
// error_reporting(E_ALL);
/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Muhammad Idrees
 * @version : 2.0
 * @since : 16 November 2022
 */
class Cards extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
		$this->load->model('card_model');
		$this->load->model('seat_model');
        $this->load->model('room_model');
		$this->load->model('allotment_model');
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

    public function edit_card($regno){

    	$regno = base64_decode($regno);

    	$this->global['pageTitle'] = 'IIUI Hostels : Update Hostel Card Expiry Date';

    	$gender = $this->gender;

    	$data['oraclepic'] = $this->common_model->PictureOracle($regno);

    	$data['student'] = $this->card_model->findHostelStudentByRegNo($regno);

    	$this->loadViews("card/edit_student_card", $this->global, $data, NULL);
    	
    }

    public function UpdatestudentCardExpiryDate(){
    	
    	$regno = trim($this->input->post('regno'));
    	$gender = trim($this->input->post('gender'));
    	$key = trim($this->input->post('key'));
    	$type = trim($this->input->post('type'));
    	$semcode = trim($this->input->post('semcode'));
    	
    	$card_expiry_date = $this->input->post('card_expiry_date');
    	$card_remarks = $this->input->post('card_remarks');    	

    	$result = $this->card_model->UpdatestudentCardExpiryDate($regno, $gender, $card_expiry_date, $card_remarks, $type);

    	//$updateKey = $this->card_model->updateKey($regno, $gender, $key, $semcode, $type);

    	if($result > 0 ){

    		$this->session->set_flashdata('success', 'Updated successfully');
    	}else{
    		$this->session->set_flashdata('error', 'Failed..!');

    	}

    	redirect('card/Cards/edit_card/'.base64_encode($regno));

    }
    
    /**
     * This function is used to load the user list
     */
    function viewCardsDetail()
    {
      	$userId = $this->vendorId;	
			
		$gender = $this->gender;
		
		$data['viewHostelInfo'] = $this->card_model->HostelDetail($gender);
		
		$data['keyinfo'] = $this->card_model->GetKey($gender);
		
		$data['seminfo'] = $this->card_model->GetActiveSem($gender);
		
		$data['type'] = $this->card_model->Gettype($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Cards Details';
		
		$this->loadViews("card/view", $this->global, $data, NULL);
        
    }
	
	 function viewCardDetailbyId()
    {
         $userId = $this->vendorId;	

		 $gender = $this->gender;
		 
		 $regno = $this->input->post('regno');

		 
		 $data['viewcardsInfo'] = $this->card_model->HostelCardsDetailId($regno, $gender);
		//  var_dump($data['viewcardsInfo']);
		 // var_dump($gender);
		 // exit();
		 
		 $data['oraclepic'] = $this->common_model->PictureOracle($regno);
				
		 $this->global['pageTitle'] = 'IIUI Hostels : Hostel Cards';
				
		 $this->loadViews("card/addNewcard", $this->global, $data, NULL);

		
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
			$reg = $this->uri->segment('4');
			
			$regno = json_decode( base64_decode($reg));
			
			$visitno = $this->visitor_model->GetVisitNo($regno);
			
			$data['visitno'] = $visitno;
			
			$result = $this->visitor_model->VerifyUserRecordById($regno);
			
		   	if($result == NULL)
		    { 
			 	$result = $this->visitor_model->VerifyUserRecordByguestId($regno); 
			}
			
			$data['studentdetail'] = $result;
			
            $this->global['pageTitle'] = 'IIUI Hostels : Add New Visitors';

            $this->loadViews("visitor/addNewvisitor", $this->global, $data, NULL);
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

		$result = $this->visitor_model->VerifyUserRecordById($regno);
		
	    if($result == NULL)	    
		{ 
			$result = $this->visitor_model->VerifyUserRecordByguestId($regno); 
		}
	    
		echo json_encode($result);   
    }
	
	function GetroomitemByRegno()
    {
    	$regno = $this->input->post('regno');

		$result = $this->clearance_model->GetroomitemByRegno($regno);
	    
		echo json_encode($result);   
    }    
  
    function printCard()
    {
        $userId = $this->vendorId;	
			
		$gender = $this->gender;
		
		$regno = $this->input->post('regno');
			
		$userinfo = $this->card_model->HostelCardsDetailId($regno, $gender);
		
		$emailid = $userinfo[0]->EMAILID;
		
		if($emailid)
		{
			$data['emailinfo'] = $this->card_model->getemailinfo($emailid, $gender);
		}
		else
		{
			$data['emailinfo'] = $this->card_model->emailinfoByRegno($regno, $gender);

			$data['attachi'] = 'T';
		}
     
		$data['fname'] = $this->card_model->getfnameoradb($regno);
		
		$data['viewcardsInfo'] = $this->card_model->HostelCardsDetailId($regno, $gender);
		
		$data['oraclepic'] = $this->common_model->PictureOracle($regno);

		//var_dump($regno);
		//var_dump($data['oraclepic']);


		//exit();

		if($gender == 'Female'){

			$data['expiration_date'] = $this->card_model->getExpirationDate(base64_encode($regno));
			$this->load->view("card/viewcard", $data);	
		}else if($gender == 'Male'){
			$this->load->view("card/viewMaleStudentCard", $data);	
		}

			        
    }
		
	function printCardHostelWise()
    {
        $userId = $this->vendorId;		
			
		$gender = $this->gender;
		
		$hostelno = $this->input->post('hostelno');
		
		$roomno = $this->input->post('roomno');
		
		$key = $this->input->post('key');
		
		$semcode = $this->input->post('semcode');
		
		$type = $this->input->post('type');
		
		$cardstatus = $this->input->post('card');
		
				
		if($hostelno != '' && $type != '' && $key != '' )
	    {
	    	//print_r($key);

		//exit();
		    if($type == 'Allotment')
		    {
				  $hostelinfo = $this->card_model->CardsinfoByHostelAllotment($key, $hostelno, $roomno, $semcode, $gender, 'Allotment');
			} elseif($type == 'change') {
				  $hostelinfo = $this->card_model->CardsDetailByHostelReAllotment($key, $hostelno, $roomno, $semcode, $gender,'change');
			} elseif( $type == 'ReAllotment') {
				  $hostelinfo = $this->card_model->CardsinfoByHostelReAllotment($key, $hostelno, $roomno, $semcode, $gender,'ReAllotment');
			}
		    
	    } elseif($hostelno != '' && $roomno != '' && $key != '' ) {

			$hostelinfo = $this->card_model->CardsDetailByHostelReAllotment($key, $hostelno, $roomno, $semcode, $gender,'change');

	   	} elseif($hostelno != '' && $roomno == '' && $key != '' ) {

	      	$hostelinfo = $this->card_model->CardsDetailByHostel($key, $hostelno, $semcode, $gender);

	   	} elseif($hostelno == '' && $roomno == '' && $key != '' ) {

	      	$hostelinfo = $this->card_model->CardsDetailByKey($key, $semcode, $gender);
	   	}
							
		$valregno = array();

		$valpic = array();

		if(!empty($hostelinfo))	
		{
			foreach($hostelinfo as $key => $info) {

				$regno = $info->REGNO; 
				$hostelno = $info->HOSTEL_NO; 
				$hosteldesc = $info->HOSTELDESC; 
				$roomdesc = $info->ROOMDESC; 
				$seat = $info->SEAT; 
				$expdate = $info->EXPIRYDATE; 
				$fathername = $info->FATHERNAME; 
				$gender = $info->GENDER; 
				$id = $info->ID; 
				$name = $info->NAME; 
				$allottype = $info->ALLOTTYPE; 
				$emailid = $info->EMAILID;					  
				$issuedate = $info->ISSUEDATE; 
				$name = $info->NAME;
				$card_expiry_date = $info->card_expiry_date;
				$card_remarks = $info->card_remarks;
			  
			  	$viewcardsPic = $this->common_model->PictureOracle($regno);
			  	$viewemail = $this->card_model->GetEmail($emailid);
					  
					   
				foreach($viewcardsPic as $cardinfo)
				{
					$newArray[$key]['id']= $id;
					$newArray[$key]['regno']= $regno;
					$newArray[$key]['name']= $name;
					$newArray[$key]['gender']= $gender;
					$newArray[$key]['pic']= $cardinfo->STUDPIC;
					$newArray[$key]['cnic']= $cardinfo->CNIC;
					$newArray[$key]['fathername']= $fathername;
					$newArray[$key]['hostelno']= $hostelno;
					$newArray[$key]['hosteldesc']= $hosteldesc;
					$newArray[$key]['roomdesc']= $roomdesc;
					$newArray[$key]['seat']= $seat;
					$newArray[$key]['issuedate']= $issuedate;
					$newArray[$key]['allottype']= $allottype;
					$newArray[$key]['expdate']= $expdate;
					$newArray[$key]['card_expiry_date']= $card_expiry_date;
					$newArray[$key]['card_remarks']= $card_remarks;
					$newArray[$key]['email']= $viewemail[0]->EMAIL;
				}					 
			}
				
			$data['viewcardsInfo'] = $newArray;

			$data['cardpic'] = $valpic;
			
			if($key == 0){
			       
				$this->session->set_flashdata('error', 'No Record Found');

				redirect('card/Cards/viewCardsDetail');	
			}
			
			if($cardstatus == 'Submit')		
			{
				$_SESSION['message'] = 'Total No. of Card.('.$key.')\r\n'.'Note: If Number of card is less than total Number of card its mean pictures is not uploaded by Admission section & those cards will be skip by the system. Print out by Regno wise.';
				echo '<script type="text/javascript">alert("' . $_SESSION['message'] . '");</script>';

				if($gender == 'Female'){
					$this->load->view("card/viewcardbulk", $data);
				}else if($gender == 'Male'){
					$this->load->view("card/viewMaleStuentBulkCards", $data);
				}				
				
			}
			elseif($cardstatus == 'Card List Print')
			{
				$this->global['pageTitle'] = 'IIUI Hostels : View Card List Details';
				
				$this->loadViews("card/viewcardlist", $this->global, $data, NULL);
					
			}
		        
		}
		else
		{
			       
			$this->session->set_flashdata('error', 'No Record Found');

			redirect('card/Cards/viewCardsDetail');	
		}
	}
   

    
    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($CardID = NULL)
    {
        
            if($CardID == null)
            {
                redirect('card/Cards/view');
            }
			
            $data['viewcardsInfo'] = $this->card_model->HostelCardsDetailById($CardID);
            
            $this->global['pageTitle'] = 'IIUI Hostels : View Visitors Deatail';
            
            $this->loadViews("card/editOld", $this->global, $data, NULL);
        
    }
    
     /**
     * This function is used to edit the Allotment information
     */
	function EditVisitors()
    {   
			
            $visitid = $this->input->post('visitid');
			
			$this->form_validation->set_rules('visitname','Visitor Name','required|max_length[128]');
			$this->form_validation->set_rules('relation','Relation','required|max_length[128]');
            $this->form_validation->set_rules('regno','Registration No','required|max_length[128]');
			$this->form_validation->set_rules('studentname','Student name','required|max_length[128]');
			$this->form_validation->set_rules('cnic','Visitors CNIC','required|max_length[128]');
			$this->form_validation->set_rules('address','Visitor Address','required|max_length[128]');
            
            
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('error', 'Visitors Updation failed');
				
				redirect('visitor/Visitor/editOld/'.$visitid);
            }
            else
            {
                $visitid = $this->input->post('visitid');
				$regno = $this->input->post('regno');
				$studentname = $this->input->post('studentname');
				$gender = $this->input->post('gender');
				$roomname = $this->input->post('roomname');
				$hostelno = $this->input->post('hostelno');
				$hostelname = $this->input->post('hostelname');
				$roomno = $this->input->post('roomno');
				$seatno = $this->input->post('seatno');
				$vno = $this->input->post('vno');
				$vdate = $this->input->post('vdate');
				$visitname = $this->input->post('visitname');
				$relation = $this->input->post('relation');
				$cnic = $this->input->post('cnic');
			    $address = $this->input->post('address');
				$remark = $this->input->post('remark');
                
                
             $visitorInfo = array('REGNO'=>$regno,'STUDENTNAME'=>$studentname,'HOSTELID'=>$hostelno,'SEATID'=>$seatno, 'ROOMID'=>$roomno, 'VISTOR_NO'=>$vno, 'VISITDATE'=>$vdate, 'VNAME'=>$visitname,'RELATION'=>$relation, 'VNICNO'=>$cnic, 'VADDRESS'=>$address, 'GENDER'=> $gender, 'VREMARKS'=> $remark);
                
				
				
                $result = $this->visitor_model->VisitorEdit($visitorInfo,$visitid);
		
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Vistors Details Updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Vistors Details Updation failed');
                }
                
                redirect('visitor/Visitor/editOld/'.$visitid);
				
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