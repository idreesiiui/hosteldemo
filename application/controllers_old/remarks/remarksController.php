<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', '-1');
error_reporting(E_ALL);


/**
 * Class : Reports (ReportsController)
 * Reports Class to control all user related operations.
 * @author : Muhammad Idrees 
 * @version : 2.0
 * @since : 17 November 2022
 */
class remarksController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('remarks_model');
        $this->load->model('card_model');			
        $this->isLoggedIn();   
    }

    public function addRemarks(){        

    	$this->global['pageTitle'] = 'IIUI Hostels : Find Student to Add Remakrs';
        

    	//$gender = $this->gender;

    	//$data['oraclepic'] = $this->common_model->PictureOracle($regno);

    	//$data['student'] = $this->card_model->findHostelStudentByRegNo($regno);

    	$this->loadViews("remarks/addRemarks", $this->global, null, NULL);
    }

    public function submitRemarks(){

        $regno = $this->input->post('regno');

        $gender = $this->gender;

        $this->global['pageTitle'] = 'IIUI Hostels : Add Remakrs';
    
    	$data['oraclepic'] = $this->common_model->PictureOracle($regno);

       $haveRemarks = $this->remarks_model->findRemarks($regno);

        if(!empty($haveRemarks)){
            $data['student'] = $haveRemarks;
        }else{            
            $data['student'] = $this->remarks_model->HostelCardsDetailId($regno, $gender);
        }

        $this->loadViews("remarks/submitRemarks", $this->global, $data, NULL);
    }

    public function storeRemarks(){       

        $remarksData = array(
            'REGNO' => $this->input->post('REGNO'),
            'NAME' => $this->input->post('NAME'),
            'HOSTELDESC' => $this->input->post('HOSTELDESC'),
            'HOSTEL_NO' => $this->input->post('HOSTEL_NO'),
            'ROOMDESC' => $this->input->post('ROOMDESC'),
            'SEAT' => $this->input->post('SEAT'),
            'REMARKS' => trim($this->input->post('REMARKS')),
            'GENDER' => $this->gender,
            'REMARKED_BY' => $this->vendorId,
            'CREATED_AT' => date('Y-m-d H:i:s')
        );        

        $remarksId = $this->remarks_model->updateStudentRemarks($remarksData);        

        if($remarksId > 0){
            $this->session->set_flashdata('success', 'Remarks has been addes for this student'); 
            return redirect('add-remarks');
        } else {
            $this->session->set_flashdata('error', 'Try agian later ....!'); 
            return redirect('add-remarks');
        }      
    }
}