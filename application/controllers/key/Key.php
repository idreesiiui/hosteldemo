<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', '-1');
error_reporting(E_ALL);
/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Muhammad Idrees
 * @version : 2.0
 * @since : 16 November 2022
 */
class Key extends BaseController
{    
    public function __construct()
    {
        parent::__construct();
		$this->load->model('key_model');		
        $this->isLoggedIn();   
    }

    public function keylisting(){

        
        $data['list_keys'] = '';
        
        $this->global['pageTitle'] = 'IIUI Hostels : Key Lisiting';
        
        $this->loadViews("key/list_keys", $this->global, $data, NULL);

    }

    function getAllKeys(){

        $regno = $this->input->post('regno');

        $gender = $this->gender;

        $data['list_keys'] = $this->key_model->list_all($gender, $regno);

        $this->global['pageTitle'] = 'IIUI Hostels : Key Lisiting';
        
        $this->loadViews("key/list_keys", $this->global, $data, NULL);

    }

    public function edit_key($id){
        
        $data['key_data'] = $this->key_model->getKey($id);

        $this->global['pageTitle'] = 'IIUI Hostels : Edit Student Key';
        
        $this->loadViews("key/edit_key", $this->global, $data, NULL);

    }

    public function update_key(){

        $id = $this->input->post('id');

        $key = $this->input->post('key');

        $result = $this->key_model->update_key($id, $key);

        if($result)
        {
            $this->session->set_flashdata('success', 'Key updated successfully');

            return redirect('key/key/edit_key/'.$id);
        }
        else
        {
            $this->session->set_flashdata('error', 'Key updation failed');

            return redirect('key/key/edit_key/'.$id);
        }
        
    }

    public function studentContactInfo(){        

        $data['student_contact_info'] = '';
        
        $this->global['pageTitle'] = 'IIUI Hostels : Update Student Contact Info';
        
        $this->loadViews("key/student_contact_info", $this->global, $data, NULL);
    }

    public function get_student_contact_info(){

        $regno = $this->input->post('regno');

        $gender = $this->gender;

        $data['from_student_contact_info'] = $this->key_model->getContactInfo($gender, $regno);

        $data['from_tbl_hstd'] = $this->key_model->getContactInfoFromTblHstd($gender, $regno);

        $this->global['pageTitle'] = 'IIUI Hostels : Student Contact Info';
        
        $this->loadViews("key/student_contact_info", $this->global, $data, Null);
    }

    public function insert_contact_info($regno){

        $regno = base64_decode($regno);

        $gender = $this->gender;

        $data['from_tbl_hstd'] = $this->key_model->getContactInfoFromTblHstd($gender, $regno);

        $this->global['pageTitle'] = 'IIUI Hostels : Student Contact Info';
        
        $this->loadViews("key/insert_contact_info", $this->global, $data, Null);

    }

    public function insert_student_constact_info(){

        $student_name = $this->input->post('student_name');
        $regno = $this->input->post('regno');
        $gender = $this->input->post('gender');
        $cnic = $this->input->post('cnic');
        $student_email = $this->input->post('student_email');

        $gender = ($gender == 'Male') ? 'M' : 'F';

        $std_data = array (
            'student_name' => $student_name,
            'regno' => $regno,
            'gender' => $gender,
            'cnic' => $cnic,
            'student_email' => $student_email,
        );

        if($this->key_model->createStdInfo($std_data))
        {
            $this->session->set_flashdata('success', 'Email updated successfully');

        } else {

            $this->session->set_flashdata('error', 'Email updation failed');            
        }

        return redirect('key/key/insert_contact_info/'.base64_encode($regno));
    }
}