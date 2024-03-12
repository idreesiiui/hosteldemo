<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Seat (SeatController)
 * Seat Class to control all Seat related operations.
 * @author : Muhammad Idrees 
 * @version : 2.0
 * @since : 17 November 2022
 */
class Seat extends BaseController
{    
    public function __construct()
    {
        parent::__construct();
		$this->load->model('seat_model');
        $this->load->model('room_model');
		$this->load->model('allotment_model');
        $this->isLoggedIn();   
    }    
    
    public function index()
    {
		
        $this->global['pageTitle'] = 'IIUI Hostels : Dashboard';
        
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }    
    
    function viewSeatDetail()
    {      
        $gender = $this->gender;
    
        $data['HostelRecords'] = $this->seat_model->getHostelInfo($gender);
		
		$data['RoomRecords'] = $this->seat_model->RoomInfo();

        $data['seattypes'] = $this->seat_model->seatTypes();
        
        $this->global['pageTitle'] = 'IIUI Hostels : View Seat Details';
        
        $this->loadViews("seat/view", $this->global, $data, NULL);
        
    }
	
	function viewvacantSeatByHostel()
    {	
		$gender = $this->gender;
		
		$data['HostelRecords'] = $this->seat_model->GetAllHostel($gender);
        
        $this->global['pageTitle'] = 'IIUI Hostels : View Seat Details By Hostel';
        
        $this->loadViews("seat/viewhostel", $this->global, $data, NULL);
        
    }
	
	function viewvacantSeat()
    {
		    
		$hsotel = $this->uri->segment('4');
		
		if(isset($hsotel) && !empty($hsotel))
		{
			$hostelno = $this->uri->segment('4');
		}
		else
		{
			$hostelno = $this->input->post('hostelno');
		}
		
		$gender = $this->gender;
		
		$data['vacantseat'] = $this->seat_model->viewvacantSeat($gender,$hostelno);
        
        $this->global['pageTitle'] = 'IIUI Hostels : View Seat Details';
        
        $this->loadViews("seat/viewvacantseat", $this->global, $data, NULL);
       
    }
	
	function viewSeatdetailinfo()
    {      
        
		$hostelno = $this->input->post('hostelno');
		
		$roomid = $this->input->post('roomno');
		
		$occupystatus = $this->input->post('occupy');

        $seatType = $this->input->post('seatType');        
		
		$gender = $this->gender;

		//echo $hostelno.",".$roomid.",".$occupystatus.",".$gender.",".$seatType;
		 
        $data['seatRecords'] = $this->seat_model->getSeatInfo($hostelno,$roomid,$occupystatus,$gender,$seatType);
        
        $this->global['pageTitle'] = 'IIUI Hostels : View Seat Info Details';
        
        $this->loadViews("seat/viewseat", $this->global, $data, NULL);
        
    }

    function addNew()
    {        
        		
		$gender = $this->gender;
		
		$data['hosteldetail'] = $this->seat_model->getHostelInfo($gender);
		
		$data['roomdetail'] = $this->room_model->getRoomInfo($gender);
		
        $this->global['pageTitle'] = 'IIUI Hostels : Add New Seat';

        $this->loadViews("seat/addNewseat", $this->global, $data, NULL, NULL);
        
    }    
    
    function addNewseat()
    {     
     	$this->form_validation->set_rules('hostelno','Hostel No','trim|required|max_length[10]|xss_clean|numeric');
        $this->form_validation->set_rules('seatdesc','Room desc','trim|required|xss_clean|max_length[128]');
        $this->form_validation->set_rules('roomno','Room No','required|max_length[20]');
        $this->form_validation->set_rules('seatoccupy','Seat cap','trim|required|max_length[20]|numeric');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->addNew();
        }
        else
        {
			$userId = $this->vendorId;
			$gender = $this->gender;
            $hostelno = $this->input->post('hostelno');
            $seatdesc = ucwords(strtolower($this->input->post('seatdesc')));
            $roomtype = $this->input->post('roomno');
            $seatoccupy = $this->input->post('seatoccupy');
			$seat = $this->input->post('seat');
           
			$Seatexisted = $this->seat_model->seat_exists_against_Hostelid_Roomid($hostelno,$roomtype,$seat,$gender);
			
			if($Seatexisted == true)
			{
				$this->session->set_flashdata('error', 'This seat name already existed against selected Hostel and Roomtype in Database.');
				redirect('seat/seat/addNew');
			}				
			else
			{
        
				$userId = $this->vendorId;
		
				$gender = $this->gender;
		
        		$seatInfo = array(
        			'HOSTELID'=>$hostelno, 
        			'SEATDESC'=>$seatdesc, 
        			'ROOMID'=>$roomtype, 
        			'GENDER'=>$gender, 
        			'OCCUPIED'=> $seatoccupy, 
        			'SEAT'=> $seat);
                        
            	$result = $this->seat_model->addNewSeat($seatInfo);            
			}

            if($result > 0)
            {
                $this->session->set_flashdata('success', 'New Seat created successfully');
            }
            else
            {
                $this->session->set_flashdata('error', 'Seat creation failed');
            }
            
            redirect('seat/seat/addNew');
        }        
    }

    
    function editOld($SEATID = NULL)
    {      
        
        if($SEATID == null)
        {
            redirect('seat/seat/viewSeatDetail');
        }		
			
		$gender = $this->gender;
		
		$data['hosteldetail'] = $this->seat_model->getHostelInfo($gender);
		
		$data['seatstatus'] = $this->seat_model->getseatstatus($SEATID, $gender);
		
        $data['seatInfo'] = $this->seat_model->getSeatInfobyId($SEATID, $gender);
        
        $this->global['pageTitle'] = 'IIUI Hostels : Edit Seat';
        
        $this->loadViews("seat/editOld", $this->global, $data, NULL);
        
    }
    
    function editSeat()
    {   
      	$this->form_validation->set_rules('hostelno','hostelno','trim|required|max_length[10]|xss_clean|numeric');
        $this->form_validation->set_rules('roomno','roomno','trim|required|xss_clean|max_length[128]');
        $this->form_validation->set_rules('seatdesc','seatdesc','required|max_length[20]');
        $this->form_validation->set_rules('seatoccupy','seatoccupy','trim|required|max_length[20]|numeric');
      
        if($this->form_validation->run() == FALSE)
        {
            $this->addNew();
        }
        else
        {
            $hostelno = $this->input->post('hostelno');
			$roomtype = $this->input->post('roomno');
            $roomdesc = ucwords(strtolower($this->input->post('roomdesc')));
            $seatdesc = $this->input->post('seatdesc');
            $seatoccupy = $this->input->post('seatoccupy');
            $seatId = $this->input->post('seatId');
		    $seat = $this->input->post('seat');			
		
			$userId = $this->vendorId;
			
			$gender = $this->gender;
			
			$seatInfo = array(
				'HOSTELID'=>$hostelno, 
				'SEATDESC'=>$seatdesc, 
				'ROOMID'=>$roomtype, 
				'GENDER'=>$gender, 
				'OCCUPIED'=> $seatoccupy, 
				'SEAT'=>$seat, 
				'updated_by'=>$userId);
            
             $result = $this->seat_model->editSeat($seatInfo,$seatId);
		
		
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'Seat Updated successfully');
				
            }
            else
            {
                $this->session->set_flashdata('error', 'Seat Updation failed');
            }
            
            redirect('seat/seat/editOld/'.$seatId);
        }        
    }

    function deleteseat()
    {
       $seatid = $this->input->post('seatid');
	   
	   $seatInfo = $this->seat_model->SeatAlloted($seatid);
	   
	   if($seatInfo->REGNO == '')
        {
            $seatid = $this->input->post('seatid');
            
            $result = $this->seat_model->deleteseat($seatid);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
		else { echo(json_encode(array('status'=>FALSE))); }
    }
	
	function getroombyHostelId()
    {	 
		 $hostelid = $this->input->post('hostelno');
		 
		 $result = $this->seat_model->getroombyHostelId($hostelid);
		 
		 echo json_encode($result);		 
    }
	
	function Updatevacantseatstatus()
    {	 
		 $status = $this->input->post('status');
		 $hostelno = $this->input->post('hostelno');
		if(empty($status))
		{
			 $this->session->set_flashdata('error', 'Select atleast One option to Update');
			 redirect('seat/seat/viewvacantSeat');
		}
		foreach ($status as $ustatus)
		{
			$value = 1; 
		   $occupy = array('OCCUPIED'=>$value);
		   
		   $result = $this->seat_model->Updatevacantseatstatus($ustatus,$occupy);
		 
		}
		if($result == TRUE)
        {
            $this->session->set_flashdata('success', 'Seat Updated successfully');
			
        }
        else
        {
            $this->session->set_flashdata('error', 'Seat Updation failed');
        }
        
        redirect('seat/seat/viewvacantSeat/'.$hostelno);
    }    

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'IIUI Hostels : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}
?>