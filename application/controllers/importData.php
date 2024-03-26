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
        $this->load->library('excel');

        $this->otherdb = $this->load->database('otherdb', TRUE); 

    }


    public function import_cms_data(){

       $path = 'uploads/cms_data/pic_data/info_data_1.xlsx';
       
       $object = PHPExcel_IOFactory::load($path);

       foreach($object->getWorksheetIterator() as $worksheet)
       {
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();
        $count = 0;
        for($row=2; $row<=$highestRow; $row++)
        {
         $regno = $worksheet->getCellByColumnAndRow(0, $row)->getValue();         
         $PROGRAME = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
         // $univ_email = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
         // $mobile = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
         // $department = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
         // $dob = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
         // $disablity = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
         // $district = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
         // $gender = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
         // $nationality = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
         // $p_address = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
         // $email = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
         // $phone = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
         // $c_address = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
         // $father_name = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
         // $cnic = $worksheet->getCellByColumnAndRow(23, $row)->getValue();

         $ptitle = explode(" ", $PROGRAME);

            if($ptitle[0] == 'Master'){
                $progamm = 'MBA';
            } else if($ptitle[0] == 'Bachelor'){
                $progamm = 'BBA';
            }

            $progamm = $ptitle[0];  


         $data = array(
         'REGNO'  => $regno,
         'PROTITTLE'   => $progamm,
         //'univ_email'    => $univ_email,
        // 'mobile'  => $mobile,
         // 'department'   => substr($department, 14),
          //'country'   => $country,
          //'dob'   => date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($dob)),
         // 'disablity'   => $disablity,
         // 'district'   => $district,
          //'gender'   => $gender,
          //'nationality'   => $nationality,
         // 'p_address'   => $p_address,
          //'c_address'   => $c_address,
          //'email'   => $email,
          //'phone'   => $phone,
          //'father_name'   => $father_name,
          //'cnic'   => $cnic,
         );
          // var_dump($data);
          // exit();

         $where = array('REGNO'  => $regno);

        $alreadyexist = $this->importdata_model->find('students',$where);
        var_dump($alreadyexist);

           echo($count);
           if($alreadyexist === 1){
           var_dump($alreadyexist);
        // exit();
        
           $count++;


               $result = $this->importdata_model->updateData($where,'students',$data);
               echo 'Data Imported successfully';
              echo($regno);
              var_dump($result);
              // exit();
            }
        }
       }

      /// 
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