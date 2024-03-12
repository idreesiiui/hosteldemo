<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', '-1');
error_reporting(E_ALL);
/**
 * Class : Login (LoginController)
 * Login class to control to authenticate user credentials and starts user's session.
 * @author : Muhammad Idrees 
 * @version : 2.0
 * @since : 17 November 2022
 */
class importData extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('importdata_model');

        $this->otherdb = $this->load->database('otherdb', TRUE); 

    }

    /**
     * Index Page for this controller.
     */    
	  
	public function import_data(){

        $students = $this->importdata_model->hostelStudentsHaveEmail();       
        
        $count = 0;

        foreach ($students as $student) {

            $isEmailExist = $this->importdata_model->isEmailExist($student['REGNO']);

            if($isEmailExist <= 0 ){                

                $insertStudentInfo = array(
                    'student_name' => $student['STUDENTNAME'],
                    'regno' => $student['REGNO'],
                    'gender' => $student['GENDER'],
                    'cnic' => $student['CNIC'],
                    'student_email' => $student['STUDENTEMAIL']
                );

                $userAdded = $this->importdata_model->addNewUser($insertStudentInfo);
                
                // echo "INSERT INTO student_contact_info(student_name, regno, gender, cnic, student_email) VALUES ('".$student['STUDENTNAME']."','".$student['REGNO']."','".$student['GENDER']."','".$student['CNIC']."','".$student['STUDENTEMAIL']."')";

                // echo ";<br>";


                if($userAdded){
                      $count++;
                }else{
                    exit();
                }
            }
        }
        echo "Total Updated records are ". $count;
	}
}
?>