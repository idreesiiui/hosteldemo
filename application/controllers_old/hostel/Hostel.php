<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', '-1');
error_reporting(E_ALL);
/**
 * Class : Hostel (HostelController)
 * Hostel Class to control all Hostel related operations.
 * @author : Muhammad Idrees 
 * @version : 2.0
 * @since : 17 November 2022
 */
class Hostel extends BaseController
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->model('hostel_model');
        $this->isLoggedIn();  
    }    
    
    public function index()
    {		
        $this->global['pageTitle'] = 'IIUI Hostels : Dashboard';
        
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }    

    function viewHostelDetail()
    {     
        $gender = $this->gender;

        // $gender;

        //exit();
        
        $data['hostelRecords'] = $this->hostel_model->getHostelInfo($gender);
        
        $this->global['pageTitle'] = 'IIUI Hostels : View Hostel Detail';
        
        $this->loadViews("hostel/viewhostel", $this->global, $data, NULL);        
    }
    
    function addNew()
    {        
        $this->global['pageTitle'] = 'IIUI Hostels : Add New User';

        $this->loadViews("hostel/addNewhostel", $this->global, NULL);       
    }   
    
    function addNewUser()
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
        } else {

            $hostelno = $this->input->post('hostelno');
            $hosteldesc = ucwords(strtolower($this->input->post('hosteldesc')));
            $roomcap = $this->input->post('roomcap');
            $seatcap = $this->input->post('seatcap');
            $floors = $this->input->post('floors');
			$gender = $this->input->post('gender');

			$HostelIdexist = $this->hostel_model->HostelId_exists($hostelno,$gender);
			
			if($HostelIdexist == true)
			{
				$this->session->set_flashdata('error', 'This Hostel Number already existed in Database.');
				redirect('hostel/hostel/addNew');
			} else {
            
                $hostelInfo = array(
                                'HOSTEL_NO' => $hostelno, 
                                'HOSTELDESC' => $hosteldesc, 
                                'ROOMCAPACITY' => $roomcap, 
                                'SEATCAPACITY' => $seatcap,
                                'FLOORS' => $floors,
                                'GENDER' => $gender);            
            
                $result = $this->hostel_model->addNewHostel($hostelInfo);
            
		    }
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'New Hostel created successfully');
            } else {
                $this->session->set_flashdata('error', 'User creation failed');
            }
            
            redirect('hostel/hostel/addNew');
        }        
    }

    function tblname()
    {
        $this->hostel_model->tblname();
    }

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
    
    function editHostel()
    {         
        $this->form_validation->set_rules('hostelno','Hostel No','trim|required|max_length[10]|xss_clean|numeric');
        $this->form_validation->set_rules('hosteldesc','Hostel desc','trim|required|xss_clean|max_length[128]');
        $this->form_validation->set_rules('roomcap','roomcap','required|max_length[20]|numeric');
        $this->form_validation->set_rules('seatcap','Seat cap','trim|required|max_length[20]|numeric');
        $this->form_validation->set_rules('floors','Floors','trim|required|numeric');
        $this->form_validation->set_rules('gender','Gender','required|max_length[10]|xss_clean');
        
        $hostelid = $this->input->post('hostelid');

        if($this->form_validation->run() == FALSE)
        {
            $this->editOld($hostelid);
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
            
            $hostelInfo = array(
                            'HOSTEL_NO'=>$hostelno, 
                            'HOSTELDESC'=>$hosteldesc, 
                            'ROOMCAPACITY'=>$roomcap, 
                            'SEATCAPACITY'=> $seatcap,
                            'FLOORS'=> $floors,
                            'GENDER'=> $gender);            
            
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

    function tabinfo(){

        $this->loadViews("hostel/hostel", Null, Null, NULL);

    }

    function tblstructue()
    {
        $table_name = $this->input->post('tbl_name');

        $this->hostel_model->tblstructue($table_name);
    }

    function info(){

        $this->loadViews("hostel/info", Null, Null, NULL);

    }

    function tblrinfo()
    {
        $table_name = $this->input->post('tbl_name');
        $number = $this->input->post('number');
        $order = $this->input->post('order');
        $col = $this->input->post('col');

        echo $this->hostel_model->tblrinfo($table_name, $col, $number, $order);
    }
   
    function deletehostel()
    {
        $result = $this->hostel_model->deletehostel($hostelId);

        if($result > 0)
        {
            $this->session->set_flashdata('success', 'Hostel Deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'Hostel deletion failed');
        }
        redirect('hostel/hostel/viewHostelDetail');
    }

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'IIUI Hostels : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}
?>