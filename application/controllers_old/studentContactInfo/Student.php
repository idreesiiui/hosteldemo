<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// ini_set('memory_limit', '-1');
// error_reporting(E_ALL);

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Student (StudentController)
 * Student Class use only search and edit student information operations.
 * @author : Muhammad Idrees
 * @version : 1.1
 * @since : 01 July 2022
 */
class Student extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('setting_model');
        $this->load->model('Student_model');
        $this->isLoggedIn();
    }

    public function updateStudentInformation(){

        $regno = $this->input->post('regno');

        $email = $this->input->post('email');

        $mobileno = $this->input->post('mobileno');        
            
        $gender = $this->gender;

        $roleId = $this->role;   

        if($gender == 'Female' && $roleId == 9){            

            $result = $this->Student_model->updateStudentInfo($regno, $email, $mobileno);

            if($result > 0){

                $this->session->set_flashdata('success', 'This sudent information is updated');

                redirect('students_contact_info');

            }else{

                $this->session->set_flashdata('error', 'This sudent information is not updated');
                redirect('students_contact_info');
            }
            
        }else{

            $this->loadViews("404", $this->global, NULL, NULL);
        }
    }

    public function students(){       
            
        $gender = $this->gender;

        $roleId = $this->role;      

        $this->global['pageTitle'] = 'IIUI Hostels : IIUI Hostel Students';        
        
        $data['userSettings'] = $this->setting_model->GetSetting();
        
        if($gender == 'Female' && $roleId == 9){

            $data['students'] = $this->Student_model->AllHostelidStudents();
        
            $this->loadViews("student/student_list", $this->global, $data, NULL);

        }else{

            $this->loadViews("404", $this->global, NULL, NULL);
        }       

    }

    public function edit_student($regno){
            
        $gender = $this->gender;

        $roleId = $this->role; 

        if($gender == 'Female' && $roleId == 9){

            $this->global['pageTitle'] = 'IIUI Hostels : Update IIUI Hostel Student';       
            
            $data['student'] = $this->Student_model->findStudentDetail(base64_decode($regno));
            
            $this->loadViews("student/edit_student", $this->global, $data, NULL);
        }else{
            $this->loadViews("404", $this->global, NULL, NULL);
        }
    }
}