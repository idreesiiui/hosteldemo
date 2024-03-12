<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Student Cradit Hour (studentCraditHour)
 * User Class to control all cradit Hours related operations.
 * @author : Muhammad Idrees
 * @version : 1.1
 * @since : 23 October 2022
 */
class studentCraditHour extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('cradithours_model');
        $this->isLoggedIn();   
    }

    public function index(){

        $this->global['pageTitle'] = 'IIUI Hostels : IIUI Hostel Student Cradit Hours';

        $data['semester'] = $this->cradithours_model->getAllSemsters();
        
        $this->loadViews("studentcradithour/studentCraditHours", $this->global, $data, NULL);
    }

    public function listCraditHours(){

        $this->global['pageTitle'] = 'IIUI Hostels : IIUI Hostel Student Cradit Hours';

        $regno = $this->input->post('regno');

        $semester = $this->input->post('semester');

        $data['studentCraditHours'] = $this->cradithours_model->getStudentCreditHours(trim($regno),$semester);
        
        $data['studentTotalCraditHours'] = $this->cradithours_model->getTotalCraditHours(trim($regno),$semester);

        $this->loadViews("studentcradithour/listCraditHours", $this->global, $data, NULL);


    }

}