<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Muhammad Idrees 
 * @version : 2.0
 * @since : 17 November 2022
 */
class Semester extends BaseController
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Semester_model');
        $this->isLoggedIn();   
    }    
    
    public function index()
    {       
        $this->global['pageTitle'] = 'IIUI Hostel : SEMESTER';
        
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }    
    
    function viewsemesterDetail()
    {   
          
        $data['semesterRecords'] = $this->Semester_model->semesterListing($this->gender);
        
        $this->global['pageTitle'] = 'IIUI Hostel : View Semester Detail';
        
        $this->loadViews("semester/viewsemester", $this->global, $data, NULL);        
    }
    
    function addNew()
    {
        
        $this->global['pageTitle'] = 'IIUI Hostel : Add New Semester';           
        
        $userId = $this->vendorId;
        
        $data['gender'] = $this->Semester_model->getUserInfo($userId);
        
        $gender = $this->gender;            
        
        $data['semesterStatus'] = $this->Semester_model->getsemesterbyStatus($gender);

        $data['semesters'] = $this->Semester_model->getAllSemesterCode();

        $data['current_semester'] = $this->Semester_model->getCurrentSem();
                    
        $this->loadViews("semester/addNew", $this->global, $data, NULL);
        
    }
    
    function addNewSemester()
    {       
            
        $this->form_validation->set_rules('smecode','smecode','trim|required');
        $this->form_validation->set_rules('smeopen','smeopen','trim|required');
        $this->form_validation->set_rules('programe','programe','trim|required');
        $this->form_validation->set_rules('batchname','batchname','trim|required');
        $this->form_validation->set_rules('smstartdate','smstartdate','trim|required');
        $this->form_validation->set_rules('smenddate','smenddate','trim|required');
        $this->form_validation->set_rules('startregdate','startregdate','required');
        $this->form_validation->set_rules('endregdate','endregdate','trim|required');
        $this->form_validation->set_rules('startregtime','startregtime','trim|required');
        $this->form_validation->set_rules('endregtime','endregtime','trim|required');
        $this->form_validation->set_rules('status','status','trim|required');
        $this->form_validation->set_rules('regstatus','regstatus','trim|required');
        $this->form_validation->set_rules('gender','gender','trim|required');
        $this->form_validation->set_rules('reallot','Re-Allot Status','trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->addNew();
        }
        else
        {
            $smecode = ucwords($this->input->post('smecode'));
            $programe = $this->input->post('programe');
            $smeopen = ucwords($this->input->post('smeopen'));
            $batchname = strtoupper($this->input->post('batchname'));
            $smstartdate = $this->input->post('smstartdate');
            $smenddate = $this->input->post('smenddate');
            $startregdate = $this->input->post('startregdate');
            $endregdate = $this->input->post('endregdate');
            $startregtime = $this->input->post('startregtime');
            $endregtime = $this->input->post('endregtime');
            $status = $this->input->post('status');
            $appstatus = $this->input->post('regstatus');
            $gender = $this->input->post('gender');
            $reallot = $this->input->post('reallot');
            $seatchange = $this->input->post('seatchange');
            
            $semesterInfo = array(
                'SEMCODE' => $smecode,
                'SEMESTEROPENREG' => $smeopen,
                'BATCHNAME' => $batchname,
                'PROGRAME' => $programe,
                'SMSTARTDATE' => $smstartdate, 
                'SMENDDATE' => $smenddate,
                'STARTREGTIME' => $startregtime,
                'ENDREGTIME' => $endregtime, 
                'STARTREGDATE' => $startregdate, 
                'GENDER' => $gender, 
                'APPSTATUS' => $appstatus, 
                'CLOSEREGDATE' => $endregdate, 
                'IS_ACTIVE' => $status, 
                'REALLOTSTATUS' => $reallot, 
                'SEATCHANGESTATUS' => $seatchange
            );            
            
            $result = $this->Semester_model->addNewUser($semesterInfo);
            
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'New Semester created successfully');
            }
            else
            {
                $this->session->set_flashdata('error', 'Semester creation failed');
            }
            
            redirect('semester/semester/addNew');
        }        
    }    
    
    function editsemester($SMcode = NULL)
    {        
        if($SMcode == null)
        {
            redirect('semesterListing');
        }
        else
        {            
            
            $userId = $this->vendorId;
        
            $data['gender'] = $this->common_model->GetGenderById($userId);
            
            $data['semester'] = $this->Semester_model->getsemesterbyId($SMcode); 
            
            $gender = $this->gender;
              
            $data['semesterStatus'] = $this->Semester_model->getsemesterbyStatus($gender);
            
            $this->global['pageTitle'] = 'HOSTEL IIUI : Edit Semester';
            
            $this->loadViews("semester/editsemester", $this->global, $data, NULL);
        }
    }    
    
    function UpdateSemester()
    {    
            
        $semesterId = $this->input->post('semesterId');
        
        $this->form_validation->set_rules('smecode','smecode','trim|required');
        $this->form_validation->set_rules('programe','programe','trim|required');
        $this->form_validation->set_rules('smeopen','smeopen','trim|required');
        $this->form_validation->set_rules('batchname','batchname','trim|required');
        $this->form_validation->set_rules('smstartdate','smstartdate','trim|required');
        $this->form_validation->set_rules('smenddate','smenddate','trim|required');
        $this->form_validation->set_rules('startregdate','startregdate','required');
        $this->form_validation->set_rules('endregdate','endregdate','trim|required');
        $this->form_validation->set_rules('startregtime','startregtime','trim|required');
        $this->form_validation->set_rules('endregtime','endregtime','trim|required');
        $this->form_validation->set_rules('status','status','trim|required');
        $this->form_validation->set_rules('gender','gender','trim|required');
        $this->form_validation->set_rules('reallot','Re-Allotment Access','trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->addNew();
        }
        else
        {
            $smecode = ucwords($this->input->post('smecode'));
            $smstartdate = $this->input->post('smstartdate');
            $programe = $this->input->post('programe');
            $smeopen = ucwords($this->input->post('smeopen'));
            $batchname = strtoupper($this->input->post('batchname'));
            $smenddate = $this->input->post('smenddate');
            $startregdate = $this->input->post('startregdate');
            $endregdate = $this->input->post('endregdate');
            $startregtime = $this->input->post('startregtime');
            $endregtime = $this->input->post('endregtime');
            $status = $this->input->post('status');
            $appstatus = $this->input->post('regstatus');
            $gender = $this->input->post('gender');
            $reallot = $this->input->post('reallot');
            $seatchange = $this->input->post('seatchange');
            
            $semesterInfo = array(
                'SEMCODE' => $smecode,
                'SEMESTEROPENREG' => $smeopen,
                'BATCHNAME' => $batchname,
                'PROGRAME' => $programe,
                'SMSTARTDATE' => $smstartdate, 
                'SMENDDATE' => $smenddate, 
                'STARTREGDATE' => $startregdate, 
                'GENDER' => $gender, 
                'APPSTATUS' => $appstatus, 
                'CLOSEREGDATE' =>  $endregdate,
                'STARTREGTIME' => $startregtime,
                'ENDREGTIME' => $endregtime, 
                'REALLOTSTATUS' => $reallot, 
                'IS_ACTIVE' => $status, 
                'SEATCHANGESTATUS' => $seatchange
            );
                        
            $result = $this->Semester_model->editSemester($semesterInfo , $semesterId);
            
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'Semester Updated successfully');              
            }
            else
            {
                $this->session->set_flashdata('error', 'Semester Updatation failed');
            }
            
            redirect('semester/semester/viewsemesterDetail');
        }        
    }    

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'IIUI Hostels : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}

?>