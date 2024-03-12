<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Muhammad Idrees 
 * @version : 2.0
 * @since : 17 November 2022
 */
class Visitor extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
		$this->load->model('visitor_model');
		$this->load->model('seat_model');
        $this->load->model('room_model');
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
    function viewVisitorDetail()
    {	
			
		$gender = $this->gender; 
		
        $allotattachExisted = $this->visitor_model->viewCattachmentallotmentExist($gender);
		
		if($allotattachExisted == FALSE)  
		{
			$this->global['pageTitle'] = 'IIUI Hostels : View Visitors Details';
		
			$this->loadViews("visitor/view", $this->global, $data, NULL);
        
		} 
		else
		{
			$data['hostel'] = $this->visitor_model->HostelInfo($gender);
			
			$this->global['pageTitle'] = 'IIUI Hostels : View Visitors Details';
			
			$this->loadViews("visitor/view", $this->global, $data, NULL);
		}
    }
	
	function viewVisitorDetailbyId()
    {
        $gender = $this->gender;
		 
		$regno = $this->input->post('regno');
		   
		$data['viewallotments'] = $this->visitor_model->VisitorById($regno,$gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Visitors Details';
		
		$this->loadViews("visitor/viewvisitor", $this->global, $data, NULL);
        
    }
	
	
	function viewVisitorDetailbyHostel()
    {
        $gender = $this->gender;
		 
		$hostel = $this->input->post('hostelno');
		 
		$roomno = $this->input->post('roomno');
		 
		$data['viewallotments'] = $this->visitor_model->ViewVisitorByHostel($hostel, $gender, $roomno);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Visitors Details';
		
		$this->loadViews("visitor/viewvisitorbyHostel", $this->global, $data, NULL);
        
    }
	
	function viewHostelVisitor($hostel = NULL)
    {
         $gender = $this->gender;
		   
		 $data['viewallotments'] = $this->visitor_model->VisitorByHostel($hostel,$gender);
		
		 $this->global['pageTitle'] = 'IIUI Hostels : View Visitors Details';
		
		 $this->loadViews("visitor/viewvisitorbyHostel", $this->global, $data, NULL);
        
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
	
	 function addNewHostel()
    {
			$gender = $this->gender;
			
			$reg = $this->uri->segment('4');
			
			$regno = base64_decode($reg);
			
			$visitno = $this->visitor_model->GetVisitNo($regno);
			
			$data['visitno'] = $visitno;
			
			$result = $this->visitor_model->VerifyUserRecordById($regno, $gender);
			
		   if($result == NULL)
		    
			 { 
			 	$result = $this->visitor_model->VerifyUserRecordByguestId($regno); 
			 }
			
			$data['studentdetail'] = $result;
			
			$data['visitorinfo'] = $this->visitor_model->VisitorInfo($regno, $gender);
			$a = $this->visitor_model->VerifyUserRecordById($regno, $gender);
			
			$data['studentinfo'] = $this->visitor_model->VerifyUserRecordById($regno, $gender);
			
            $this->global['pageTitle'] = 'IIUI Hostels : Add New Visitors';

            $this->loadViews("visitor/addNewvisitor", $this->global, $data, NULL);
    }

    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
			$reg = $this->uri->segment('4');
			
			$regno = json_decode( base64_decode($reg));
			
			$visitno = $this->visitor_model->GetVisitNo($regno);
			//print_r($visitno);
			//exit();
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
		    
			 { $result = $this->visitor_model->VerifyUserRecordByguestId($regno); }
		    
			echo json_encode($result);   
    }
	
	function GetroomitemByRegno()
    {
        	$regno = $this->input->post('regno');
	
			$result = $this->clearance_model->GetroomitemByRegno($regno);
		    
			echo json_encode($result);   
    }
    
    /**
     * This function is used to add new user to the system
     */
    function addNewVisitor()
    {
       
            
            
			$this->form_validation->set_rules('hostelno','Hostel No','trim|required|max_length[10]|xss_clean|numeric');
			$this->form_validation->set_rules('roomno','Room No','trim|required|max_length[30]|xss_clean|numeric');
			$this->form_validation->set_rules('seatno','Seat No','trim|required|max_length[30]|xss_clean');
            $this->form_validation->set_rules('roomtype','Room Type','trim|required|xss_clean|max_length[128]');
            $this->form_validation->set_rules('regno','Registration No','required|max_length[128]');
			$this->form_validation->set_rules('studentname','Student Name','required|max_length[128]');
			$this->form_validation->set_rules('visitname','Visitor Name','required|max_length[128]');
			
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            { 
                $regno = $this->input->post('regno');
				$studentname = $this->input->post('studentname');
				$gender = $this->input->post('gender');
				$roomname = $this->input->post('roomname');
				$hostelno = $this->input->post('hostelno');
				$hostelname = $this->input->post('hostelname');
				$roomno = $this->input->post('roomno');
				$seatno = $this->input->post('seatno');
				$vno = $this->input->post('vno');
				$visitname = $this->input->post('visitname');
				$relation = $this->input->post('relation');
				echo $cnic = $this->input->post('cnic');
			    $number = $this->input->post('number');
				$visitname2 = $this->input->post('visitname2');
				$relation2 = $this->input->post('relation2');
				$cnic2 = $this->input->post('cnic2');
			    $number2 = $this->input->post('number2');
				$remark = $this->input->post('remark');
				$address = $this->input->post('address');
				$allottype = $this->input->post('allottype');
			
                
				$Visitorexisted = $this->visitor_model->visitor_exists_against_Regno($regno, $cnic);
				
				if($Visitorexisted == true)
					{ 
						
						$visitorInfo = array('REGNO'=>$regno,'STUDENTNAME'=>$studentname,'HOSTELID'=>$hostelno,'SEATID'=>$seatno, 'ROOMID'=>$roomno, 'VISTOR_NO'=>$vno, 'VNAME'=>$visitname,'RELATION'=>$relation, 'VNICNO'=>$cnic, 'CONTACTNO'=>$number, 'VNAME2'=>$visitname2,'RELATION2'=>$relation2, 'VNICNO2'=>$cnic2, 'CONTACTNO2'=>$number2, 'GENDER'=> $gender, 'VREMARKS'=> $remark , 'VADDRESS'=> $address);
						
						$result = $this->visitor_model->UpdateVisitors($visitorInfo, $regno);
						
						$updateaddress = array('ADDRESS'=>$address);
						
						$result = $this->visitor_model->UpdateVisitorsaddress($regno, $allottype, $updateaddress);
						
						$this->session->set_flashdata('success', 'This Visitor Records Updated Successfully.');
						
						redirect('visitor/Visitor/addNewHostel/'.base64_encode($regno));
					}
					
		else
			{
                
            $visitorInfo = array('REGNO'=>$regno,'STUDENTNAME'=>$studentname,'HOSTELID'=>$hostelno,'SEATID'=>$seatno, 'ROOMID'=>$roomno, 'VISTOR_NO'=>$vno, 'VNAME'=>$visitname,'RELATION'=>$relation, 'VNICNO'=>$cnic, 'CONTACTNO'=>$number, 'VNAME2'=>$visitname2,'RELATION2'=>$relation2, 'VNICNO2'=>$cnic2, 'CONTACTNO2'=>$number2, 'GENDER'=> $gender, 'VREMARKS'=> $remark , 'VADDRESS'=> $address);
                
             
				$result = $this->visitor_model->addNewVisitor($visitorInfo);
				
				$updateaddress = array('ADDRESS'=>$address);
						
				$result = $this->visitor_model->UpdateVisitorsaddress($regno, $allottype, $updateaddress);
               
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Visitor created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Visitor creation failed');
                }
                
                    $regno = json_decode( base64_decode($regno));
						
				    redirect('visitor/Visitor/addNewHostel/'.$regno);
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
                redirect('visitor/Visitor/view');
            }
			
			//$data['seatdetail'] = $this->attachment_model->getAllSeatInfo();
			
            $data['visitorInfo'] = $this->visitor_model->getVisitorInfobyId($AllotID);
            
            $this->global['pageTitle'] = 'IIUI Hostels : View Visitors Deatail';
            
            $this->loadViews("visitor/editOld", $this->global, $data, NULL);
        
    }
    
     /**
     * This function is used to edit the Allotment information
     */
	 function EditVisitors()
    {
       
            
			
            $visitid = $this->input->post('visitid');
			
			 
			$this->form_validation->set_rules('hostelno','Hostel No','trim|required|max_length[10]|xss_clean|numeric');
			$this->form_validation->set_rules('hostelname','Hostel Name','trim|required|max_length[30]|xss_clean');
			$this->form_validation->set_rules('roomno','Room No','trim|required|max_length[30]|xss_clean|numeric');
			$this->form_validation->set_rules('seatno','Seat No','trim|required|max_length[30]|xss_clean|numeric');
            $this->form_validation->set_rules('roomname','Room Name','trim|required|xss_clean|max_length[128]');
            $this->form_validation->set_rules('regno','Registration No','required|max_length[128]');
			$this->form_validation->set_rules('studentname','Student Name','required|max_length[128]');
			$this->form_validation->set_rules('visitname','Visitor Name','required|max_length[128]');
            
            
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
				$visitname = $this->input->post('visitname');
				$relation = $this->input->post('relation');
				$cnic = $this->input->post('cnic');
			    $number = $this->input->post('number');
				$visitname2 = $this->input->post('visitname2');
				$relation2 = $this->input->post('relation2');
				$cnic2 = $this->input->post('cnic2');
			    $number2 = $this->input->post('number2');
				$remark = $this->input->post('remark');
                
                
             $visitorInfo = array('REGNO'=>$regno,'STUDENTNAME'=>$studentname,'HOSTELID'=>$hostelno,'SEATID'=>$seatno, 'ROOMID'=>$roomno, 'VISTOR_NO'=>$vno, 'VNAME'=>$visitname,'RELATION'=>$relation, 'VNICNO'=>$cnic, 'CONTACTNO'=>$number, 'VNAME2'=>$visitname2,'RELATION2'=>$relation2, 'VNICNO2'=>$cnic2, 'CONTACTNO2'=>$number2, 'GENDER'=> $gender, 'VREMARKS'=> $remark);
                
				
				
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