<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Room (RoomController)
 * Room Class to control all Room related operations.
 * @author : Muhammad Idrees 
 * @version : 2.0
 * @since : 17 November 2022
 */
class Room extends BaseController
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->model('room_model');
        $this->load->model('allotment_model');
        $this->isLoggedIn();   
    }    
    
    public function index()
    {		
        $this->global['pageTitle'] = 'IIUI Hostels : Dashboard';
        
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }    
    
    function viewRoomDetail()
    {    
		$gender = $this->gender;
		
        $data['roomRecords'] = $this->room_model->getRoomInfo($gender);
        
        $this->global['pageTitle'] = 'IIUI Hostels : View Room Details';
        
        $this->loadViews("room/viewroom", $this->global, $data, NULL);        
    }
    
    function addNew()
    { 
		$gender = $this->gender;
				
		$data['hosteldetail'] = $this->room_model->getHostelInfo($gender);
		
        $this->global['pageTitle'] = 'IIUI Hostels : Add New Room';

        $this->loadViews("room/addNewroom", $this->global, $data, NULL, NULL);
        
    }    
    
    function addNewroom()
    {         
        $this->form_validation->set_rules('hostelno','Hostel No','trim|required|max_length[10]|xss_clean|numeric');
        $this->form_validation->set_rules('roomdesc','Room desc','trim|required|xss_clean|max_length[128]');
        $this->form_validation->set_rules('roomtype','Room type','required|max_length[20]');
        $this->form_validation->set_rules('seatcap','Seat cap','trim|required|max_length[20]|numeric');       
        
        if($this->form_validation->run() == FALSE)
        {
            $this->addNew();
        } 
        else 
        {
            $hostelno = $this->input->post('hostelno');
            $roomdesc = ucwords(strtolower($this->input->post('roomdesc')));
            $roomtype = $this->input->post('roomtype');
            $seatcap = $this->input->post('seatcap');
            $floors = $this->input->post('floors');
			$bed = $this->input->post('bed');
			$chair = $this->input->post('chair');
			$tables = $this->input->post('tables');
			$cupboards = $this->input->post('cupboards');
			$tubelight = $this->input->post('tubelight');
			$fan = $this->input->post('fan');
			$otheritem = $this->input->post('otheritem');
			
			$Roomexisted = $this->room_model->room_exists_against_hostelId($hostelno,$roomdesc);
			
			if($Roomexisted == true)
			{
				$this->session->set_flashdata('error', 'This Room name already existed against selected Hostel in Database.');
				redirect('room/room/addNew');
			} 
            else 
            {
        		$gender = $this->gender;
			
                $roomInfo = array(
                            'HOSTELID' => $hostelno, 
                            'ROOMDESC' => $roomdesc, 
                            'ROOMTYPE' => $roomtype, 
                            'SCAPACITY'=> $seatcap,
                            'FLOOR' => $floors, 
                            'BEDS' => $bed, 
                            'CHAIRS' => $chair, 
                            'TABLES' => $tables, 
                            'CUPBOARDS' => $cupboards, 
                            'TUBELIGHTS' => $tubelight, 
                            'FANS' => $fan, 
                            'OTHERITEMS' => $otheritem, 
                            'GENDER' => $gender );            
            
                $result = $this->room_model->addNewRoom($roomInfo);
            
		    }
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'New Room created successfully');
            } else {
                $this->session->set_flashdata('error', 'Room creation failed');
            }
            
            redirect('room/room/addNew');
        }        
    }
    
    function editOld($ROOMID = NULL)
    {        
        
        if($ROOMID == null)
        {
            redirect('room/room/viewRoomDetail');
        }

		$gender = $this->gender;
		
        $data['hosteldetail'] = $this->room_model->getHostelInfo($gender);
		
        $data['roomInfo'] = $this->room_model->getRoomInfobyId($ROOMID);
        
        $this->global['pageTitle'] = 'IIUI Hostels : Edit Room';
        
        $this->loadViews("room/editOld", $this->global, $data, NULL);
        
    }    
    
    function editRoom()
    {


        
        $this->form_validation->set_rules('hostelno','Hostel No','trim|required|max_length[10]|xss_clean|numeric');
        $this->form_validation->set_rules('roomdesc','Room desc','trim|required|xss_clean|max_length[128]');
        $this->form_validation->set_rules('roomtype','Room type','required|max_length[20]');
        $this->form_validation->set_rules('seatcap','Seat cap','trim|required|max_length[20]|numeric');
        $this->form_validation->set_rules('floors','Floors','trim|required|numeric');
        $this->form_validation->set_rules('bed','Bed','required|max_length[10]|xss_clean|numeric');
		$this->form_validation->set_rules('chair','Chair','trim|required|numeric');
        $this->form_validation->set_rules('tables','Tables','required|max_length[10]|numeric');
		$this->form_validation->set_rules('cupboards','Cupboards','trim|required|numeric');
        $this->form_validation->set_rules('tubelight','Tubelight','required|max_length[10]|numeric');
		$this->form_validation->set_rules('fan','Fan','trim|required|numeric');
        $this->form_validation->set_rules('otheritem','Otheritem','required|max_length[10]|numeric');

        $roomid = $this->input->post('roomid');


        
        if($this->form_validation->run() == FALSE)
        {
            $this->editOld($roomid);
        } else {

            $hostelno = $this->input->post('hostelno');
			$roomid = $this->input->post('roomid');
			$hostelid = $this->input->post('hostelid');
            $roomdesc = ucwords(strtolower($this->input->post('roomdesc')));
            $roomtype = $this->input->post('roomtype');
            $seatcap = $this->input->post('seatcap');
            $floors = $this->input->post('floors');
			$bed = $this->input->post('bed');
			$chair = $this->input->post('chair');
			$tables = $this->input->post('tables');
			$cupboards = $this->input->post('cupboards');
			$tubelight = $this->input->post('tubelight');
			$fan = $this->input->post('fan');
			$otheritem = $this->input->post('otheritem');
            $CAPTUREBY = $this->input->post('CAPTUREBY');

			
			$Roomexisted = $this->room_model->room_exists_against_hostelId($hostelno,$roomdesc);
			
           // var_dump($Roomexisted);
          //  var_dump($CAPTUREBY);
        //exit();
			if($Roomexisted == false)
			{
				$this->session->set_flashdata('error', 'This Room name already existed against selected Hostel in Database.');
				redirect('room/room/editOld');
			} else {
            
		        $gender = $this->gender;
            
                $roomInfo = array(
                    'HOSTELID' => $hostelno, 
                    'ROOMDESC' => $roomdesc, 
                    'ROOMTYPE' => $roomtype, 
                    'SCAPACITY' => $seatcap,
                    'FLOOR' => $floors, 
                    'BEDS' => $bed, 
                    'CHAIRS' => $chair, 
                    'TABLES' => $tables, 
                    'CUPBOARDS' => $cupboards, 
                    'TUBELIGHTS' => $tubelight, 
                    'FANS' => $fan, 
                    'OTHERITEMS' => $otheritem, 
                    'GENDER' => $gender, 
                   // 'CAPTUREBY' => $CAPTUREBY 
                );

                //var_dump($roomInfo); exit();
            
                $result = $this->room_model->editroom($roomInfo,$roomid);
            
		    }
            
            if($result  = TRUE)
            {
                $this->session->set_flashdata('success', 'Room Updated successfully');
            } else {
                $this->session->set_flashdata('error', 'Room Updation failed');
            }
            
            redirect('room/room/viewRoomDetail');
        }        
    }

    function deleteroom($roomId)
    {
        $result = $this->room_model->deleteroom($roomId);
        
        if($result > 0)
        {
            $this->session->set_flashdata('success', 'Hostel Room Deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'Hostel Room deletion failed');
        }
        redirect('room/room/viewRoomDetail');
        
    }   

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'IIUI Hostels : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}
?>