<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Clearance (Clearance Controller)
 * Clearance Class to control all Clearance related operations.
 * @author : Muhammad Idrees Khan
 * @version : 2.0
 * @since : 12 November 2022
 */
class Clearance extends BaseController
{
   	public function __construct()
    {
        parent::__construct();
		$this->load->model('clearance_model');
		$this->load->model('seat_model');
        $this->load->model('room_model');
		$this->load->model('allotment_model');
		$this->load->model('report_model');
        $this->isLoggedIn();   
    }    
    
    public function index()
    {		
        $this->global['pageTitle'] = 'IIUI Hostels : Dashboard';
        
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }
	
	function viewclearance()
    {
		$gender = $this->gender;
		
		$data['HostelRecords'] = $this->allotment_model->getAllHostelInfo($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Clearance ';
		
		$this->loadViews("clearance/view", $this->global, $data, NULL);
	}
    
    function viewClearanceDetail()
    {          
		$this->form_validation->set_rules('hostelno','Hostel No','trim|required|max_length[10]|xss_clean');            
            
        if($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', 'Select Hostel First');
            
			redirect('clearance/Clearance/viewclearance');
        }
        else
        {
			$gender = $this->gender;
			
			$hostelno = $this->input->post('hostelno');
				
			$roomno = $this->input->post('roomno');
			
			$userinfo = $this->clearance_model->GetHostelIDRoomID($gender, $hostelno, $roomno);
			
			$hostelid = $userinfo[0]->HOSTELID; 
			
			if($roomno){

			   $roomid = $userinfo[0]->ROOMDESC;
			}
			else
			{
				$roomid = '';
			}

			$data['viewallotments'] = $this->clearance_model->viewClearanceInfo($gender, $hostelid, $roomid);
			
			$this->global['pageTitle'] = 'IIUI Hostels : View Clearance Details';
			
			$this->loadViews("clearance/viewclearance", $this->global, $data, NULL);
		}        
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

    function addNew()
    {
        	$data['seatdetail'] = $this->clearance_model->getAllSeatInfo();
				
            $this->global['pageTitle'] = 'IIUI Hostels : Add New Clearance';

            $this->loadViews("clearance/addNewclearance", $this->global, $data, NULL);
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
		
		$gender = $this->gender;
		
		$result = $this->clearance_model->VerifyUserRecordById($regno,$gender);
		
	  	if(empty($result))	    
		{
			$blacklist = $this->clearance_model->VerifyfromBlacklist($regno);
			
			if(!empty($blacklist))
		   	{
			  $result = $this->clearance_model->VerifyUserRecordByHistory($regno,$gender); 
		   	}
		}
	    
		echo json_encode($result);   
    }
	
	function GetroomitemByRegno()
    {
        	$regno = $this->input->post('regno');

			echo json_encode($regno);exit();

			$result = $this->clearance_model->GetroomitemByRegno($regno);
		    
			echo json_encode($result);   
    }    
    
    function addNewClearance()
    {       
		$this->form_validation->set_rules('hostelno','Hostel No','trim|required|max_length[10]|xss_clean');
		$this->form_validation->set_rules('hostelname','Hostel Name','trim|required|max_length[128]|xss_clean');
		$this->form_validation->set_rules('roomno','Room No','trim|required|max_length[30]|xss_clean|numeric');
		$this->form_validation->set_rules('seat','Seat No','trim|required|max_length[30]|xss_clean');
        $this->form_validation->set_rules('regno','Registration No','required|max_length[128]');
		$this->form_validation->set_rules('studentname','Student Name','required|max_length[128]');
		$this->form_validation->set_rules('leavedate','Leaving Date','required|max_length[128]');
		$this->form_validation->set_rules('cleardate','Clearance Date','required|max_length[128]');        
        
        if($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', 'Student Clearance failed');

			redirect('clearance/Clearance/addNew');
        }
        else
        {
            $regno = $this->input->post('regno');
			$studentname = $this->input->post('studentname');
			$gender = $this->input->post('gender');
			$hostelid = $this->input->post('hostelid');
			$roomname = $this->input->post('roomname');
			$roomid = $this->input->post('roomid');
			$hostelno = $this->input->post('hostelno');
			$hostelname = $this->input->post('hostelname');
			$roomno = $this->input->post('roomno');
			$seat = $this->input->post('seat');
			$seatid = $this->input->post('seatid');
			$seq = $this->input->post('seq');
			$type = $this->input->post('type');
			$quotatype = $this->input->post('quotatype');
			$semcode = $this->input->post('semcode');
			$leavedate = $this->input->post('leavedate');
			$cleardate = $this->input->post('cleardate');
			$fineamount = $this->input->post('fine');
		    $allotdate = $this->input->post('allotdate');
			$roomitem = $this->input->post('roomitem');
		    $doorkey = $this->input->post('doorkey');
			$cupkey = $this->input->post('cupkey');
			$drawkey = $this->input->post('drawkey');
			$matress = $this->input->post('matress');
			$chair = $this->input->post('chair');
			$table = $this->input->post('table');
			$messdues = $this->input->post('messdues');
			$arriers = $this->input->post('arriers');
			$cstatus = $this->input->post('cstatus');
			$expdate = $this->input->post('expdate');
			$quotatype = $this->input->post('quotatype');
			$semtype = $this->input->post('semtype');
			$STUDENTPHONE = $this->input->post('STUDENTPHONE');
		
			$existedclear = $this->clearance_model->ExistedClearance($regno,$semcode,$gender);
			
		if($existedclear == 'true')
		{
		
		   $this->session->set_flashdata('error', 'Student Clearance already Exited agianst this Regno & Semester');
			redirect('clearance/Clearance/addNew');
		}
		   
        $InsertClearanceInfo = array(
        	'CLR_TYPE' => $type,
        	'CLR_DATE' => $cleardate,
            'LEAVE_DATE' => $leavedate,
            'FINEAMOUNT' => $fineamount,
            'REGNO' => $regno,
            'STUDENTNAME' => $studentname,
			'STUDENTPHONE' => $STUDENTPHONE,
            'HOSTELID' => $hostelid,
            'HOSTELDESC' => $hostelname,
            'SEAT' => $seat, 
            'ROOMID' => $roomno, 
            'CUPBOARDKEYS' => $cupkey, 
            'MATRESS' => $matress, 
            'DRAWKEYS' => $drawkey,
            'CHAIR' => $chair, 
            'DOORKEYS' => $doorkey, 
            'TABLES' => $table, 
            'GENDER' =>  $gender, 
            'ARRIERS' => $arriers,
            'MESSDUES' => $messdues,
            'CSTATUS' => $cstatus,
            'ROOMITEM' => $roomitem,
            'SEATSTATUS' => $quotatype,
            'SEMCODE' => $semcode,
            'ALLOTEDDATE' => $allotdate,
            'EXPIRYDATE' => $expdate,
            'SEMTYPE' => $semtype);            
            
            $result = $this->clearance_model->InsertClearance($InsertClearanceInfo);
			
			$regnoexist = $this->clearance_model->CheckRegnoInAllotReallot($regno,$hostelid,$roomid,$seatid);

			$checkregno = $regnoexist[0]->REGNO;
			
			//if($regno == $checkregno)
			//{			
				$updateseatstatus = array('OCCUPIED'=>0);

				$search = 'phd';
				if(preg_match("/{$search}/i", $regno) && $gender == 'Male') {
				    $result = $this->clearance_model->UpdatedRoomStatus($updateseatstatus,$roomid);	
				}else{
				
				$result = $this->clearance_model->UpdatedSeatStatus($updateseatstatus,$seatid,$roomid);	

				$roomSeats = $this->clearance_model->getRoomStatus($hostelid,$roomid);
					//var_dump($roomSeats); exit();

					foreach($roomSeats as $seat){
						if($seat->SEATDESC == 'Cubical' && $seat->GENDER == 'Male' && $seat->SEAT == 'S' && $seat->OCCUPIED == '1'){

						$result = $this->clearance_model->UpdatedSeatStatus($updateseatstatus,$seat->SEATID,$roomid);	

						}
					}
				}		
			//}
			
			$blacklist = $this->clearance_model->VerifyfromBlacklist($regno);
			
			if(!empty($blacklist))
			{
				$updateblackstatus = array('BSTATUS'=>0);
				
				$updateblack = $this->clearance_model->UpdatedBlacklist($regno, $updateblackstatus);
			}
			
			$result = $this->clearance_model->DeleteRecordfromAllot($regno);
			$result = $this->clearance_model->DeleteRecordfromReAllot($regno);
			$result = $this->clearance_model->DeleteRecordfromdefault($regno);
			$result = $this->clearance_model->DeleteRecordfromAllotReallot($regno);
			$findStudentInHistory = $this->clearance_model->findStudentInHistory($regno);
				
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'Student Clearance Done successfully');
            }
            else
            {
            	if($findStudentInHistory > 0) {
                	$this->session->set_flashdata('success', 'Student Clearance Done successfully');
            	}
                $this->session->set_flashdata('error', 'Student Clearance failed');
            }
            
            redirect('clearance/Clearance/viewClearanceDetail');
        }		
    }    

    function editOld($AllotID = NULL)
    {        
        if($AllotID == null)
        {
            redirect('clearance/clearance/viewClearanceDetail');
        }
		
        $data['attachInfo'] = $this->attachment_model->getAttachmentInfobyId($AllotID);
        
        $this->global['pageTitle'] = 'IIUI Hostels : View Attachment Deatail';
        
        $this->loadViews("attachment/editOld", $this->global, $data, NULL);
        
    }    
    
	function editClearance()
    {		
        $clearid = $this->input->post('clearid');
		 
		$this->form_validation->set_rules('fine','fine','trim|required|max_length[30]|xss_clean|numeric');          
        
        if($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', 'Edit Clearance Updation failed');
			
			redirect('clearance/Clearance/viewstudentclearance/'.$clearid);
        }
        else
        {
            $clearid = $this->input->post('clearid');
			
			$fine = $this->input->post('fine');
			
			$leavedate = $this->input->post('leavedate');
			
			$cleardate = $this->input->post('cleardate');
			
            $clearInfo = array('FINEAMOUNT'=>$fine,'LEAVE_DATE'=>$leavedate, 'CLR_DATE'=>$cleardate);
			
			$result = $this->clearance_model->editClearInfo($clearInfo, $clearid);
	
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'Clearance Updated successfully');
            }
            else
            {
                $this->session->set_flashdata('error', 'Clearance Updation failed');
            }
            
            redirect('clearance/Clearance/viewstudentclearance/'.$clearid);
        }
    }
 
	
	function getroombyHostelId()
    {	 
		 $hostelid = $this->input->post('hostelno');
		 
		 $result = $this->seat_model->getroombyHostelId($hostelid);
		 
		 echo json_encode($result);
		 
    }
	
	function studentclearslip($ALLOTMENT_ID  = NULL)
    {
		if($ALLOTMENT_ID == NULL)
        {
            redirect('clearance/Clearance/viewClearanceDetail');
        }			
		
		$gender = $this->gender;
		
		$allotslip = $this->clearance_model->viewClearanceInfobyId($gender, $ALLOTMENT_ID);

		$regno = $allotslip[0]->REGNO;			
		
		$data['viewclearance'] = $this->clearance_model->viewClearanceInfobyId($gender, $ALLOTMENT_ID);
	    
	    $this->load->library('pdf');	    
	  
		$data['acad'] = $this->report_model->acadprograme($regno);

		$data['oraclepic'] = $this->common_model->PictureOracle($regno);
		  
		  $data['allotslip'] = $this->clearance_model->viewClearanceInfobyId($gender, $ALLOTMENT_ID);
		  $html = $this->load->view('reports/clearanceslip', $data, true);
		  print_r($html);
		  exit();
		  /// Rest of code is still pending for pdf genrate i will fix when got solution for php 7.1 have error 5.6 php work fine
		  $this->pdf->load_html($html);
		  
		  $this->pdf->render();
		  $data['Attachment'] = FALSE;
		  $this->pdf->stream("report/reports/AlotSlip.pdf", $data);
    }
	
	function viewstudentclearance($ALLOTMENT_ID  = NULL)
    {
        if($ALLOTMENT_ID == NULL)
        {
            redirect('clearance/Clearance/viewClearanceDetail');
        }        
        
        $gender = $this->gender;
        
        $allotslip = $this->clearance_model->viewClearanceInfobyId($gender, $ALLOTMENT_ID);
        
        $regno = $allotslip[0]->REGNO;
                    
        $data['oraclepic'] = $this->common_model->PictureOracle($regno);
        
        $data['viewclearance'] = $this->clearance_model->viewClearanceInfobyId($gender, $ALLOTMENT_ID);
        
        $this->global['pageTitle'] = 'IIUI Hostels : Clearance';
    
        $this->loadViews("clearance/editOld", $this->global, $data, NULL);
			
	}

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'IIUI Hostels : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}

?>