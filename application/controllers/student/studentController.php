<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// ini_set('memory_limit', '-1');
// error_reporting(E_ALL);

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Muhammad Idrees 
 * @version : 2.0
 * @since : 28 March 2024
 */
class studentController extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();        
		$this->load->model('common_model');
		$this->load->helper(array('form', 'url'));
        $this->isLoggedIn();   
    }

    public function searchStdInfo(){
    	$this->global['pageTitle'] = 'IIUI Hostels : Search Student Information';

    	//echo $this->gender;
        
        $this->loadViews("student/find_std_info", $this->global, $data, NULL);
    }

    public function getStdInfo(){
    	$this->global['pageTitle'] = 'IIUI Hostels : Student Detail';

    	$regno = $this->input->post('regno');

    	$where = array('REGNO' => $regno, 'GENDER' => $this->gender);

    	$data['student_detail'] = $this->common_model->getWhere('*','students',$where);
    	//echo $this->gender;

    	//var_dump($data);


        
        $this->loadViews("student/std_detail", $this->global, $data, NULL);
    }

    public function storeStdInfo(){
    	$this->global['pageTitle'] = 'IIUI Hostels : Search Student Information';

    	$data = $this->input->post();
    	$REGNO = $this->input->post('REGNO');
    	$where = array('REGNO' => $REGNO);
    	$studentAlreadyExist = $this->common_model->find('students',$where);

    	//check student by reg no if exist then

    	//$picture = $this->upload->data();

    	//var_dump($_FILES['picture']);

    //	var_dump( $this->input->post('picture') ); 

    	


    	$errors=array();
	    $allowed_ext= array('jpg','jpeg','png','gif');
	    $file_name =$_FILES['picture']['name'];
	 //   $file_name =$_FILES['picture']['tmp_name'];
	    $file_ext = strtolower( end(explode('.',$file_name)));


	    $file_size=$_FILES['picture']['size'];
	    $file_tmp= $_FILES['picture']['tmp_name'];
	   // echo $file_tmp;echo "<br>";

	    $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
	    $picture_data = file_get_contents($file_tmp);
	    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($picture_data);
	   // echo "Base64 is ".$base64;

	    $data['picture'] = $base64;

	    //var_dump( $data);

	     


    	if($studentAlreadyExist >= 1){    		

    		$result = $this->common_model->updateData($where,'students',$data);    		

		}else{			

			$result = $this->common_model->insertData('students',$data);
		}

		if($result > 0){

    		$this->session->set_flashdata('success', 'Student record updated successfully');
		}else{

    		$this->session->set_flashdata('error', 'Try again later!..');
		}
		redirect('search_std_info');       
        
    }
    
     
}

?>