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

    /**
     * Index Page for this controller.
     */  

    public function import_cms_data(){ 

       $path = 'uploads/cms_data/pic_data/degree_duration_data.xlsx';
       
       $object = PHPExcel_IOFactory::load($path);

       foreach($object->getWorksheetIterator() as $worksheet)
       {
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();
        $count = 0;
        for($row=2; $row<=$highestRow; $row++)
        {
         //$picture = $worksheet->getCellByColumnAndRow(2, $row)->getValue();         
         $regno = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
         //$name = $worksheet->getCellByColumnAndRow(1, $row)->getValue();         
        // $PROGRAME = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
       //  $current_semester = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
        // $nationality = $worksheet->getCellByColumnAndRow(2, $row)->getValue();         
        // $country = $worksheet->getCellByColumnAndRow(4, $row)->getValue(); 
         //$city = $worksheet->getCellByColumnAndRow(5, $row)->getValue(); 



         // $name = $worksheet->getCellByColumnAndRow(1, $row)->getValue();         
          $DEGREEDURATION = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
          $STADMISSION = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
         // $dob = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
         // $disablity = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
         // $gender = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
          //$nationality = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
         // $p_address = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
         // $email = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
         // $phone = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
        //  $c_address = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
        // $father_name = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
         // $cnic = $worksheet->getCellByColumnAndRow(23, $row)->getValue();

         // $district = $worksheet->getCellByColumnAndRow(12, $row)->getValue();

         //  $univ_distance = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
         // $univ_email = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
         // // $mobile = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
         //  $department = $worksheet->getCellByColumnAndRow(6, $row)->getValue();

         // $ptitle = explode(" ", $PROGRAME);

         //    if($ptitle[0] == 'Master'){
         //        $progamm = 'MBA';
         //    } else if($ptitle[0] == 'Bachelor'){
         //        $progamm = 'BBA';
         //    }

         //    $progamm = $ptitle[0];  


         $data = array(
         'REGNO'  => $regno,
         //'picture'   => $picture,
         // 'STUDENTNAME'   => $name,
         // 'PROGRAME'   => $PROGRAME,
        // 'PROTITTLE'   => $progamm,
        //  'current_semester'    => $current_semester,
        //  'CITY'    => $city,
          'DEGREEDURATION'    => $DEGREEDURATION,
        //  'STADMISSION'    => $STADMISSION,
        // 'COUNTRY'   => $country,
          'STADMISSION'   => date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($STADMISSION)),
         // 'STUDENTDOB'   => date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($dob)),
         // 'disablity'   => $disablity,
        //  'GENDER'   => $gender,
       //   'NATIONALITY'   => $nationality,
       //   'PERMANENT'   => $p_address,
       //   'PREADD'   => $c_address,
       //   'email'   => $email,
       //   'phone'   => $phone,
       //   'FATHERNAME'   => $father_name,
         // 'CNIC'   => $cnic,


         // 'univ_distance'  => $univ_distance,
         // 'univ_email'    => $univ_email,
         // 'DEPARTMENTNAME'   => substr($department, 14),
         // 'DISTRICT'   => $district,
         );
       // var_dump($data);
       //  exit();

         $where = array(
            'REGNO'  => $regno,
           // 'GENDER' => null
        );

        $alreadyexist = $this->importdata_model->find('students',$where);
       // var_dump($alreadyexist);

           if($alreadyexist == 1){
           echo($count);
           // var_dump($alreadyexist);
           //  exit();


        
           $count++;


               $result = $this->importdata_model->updateData($where,'students',$data);
               //$result = $this->importdata_model->insertData('students',$data);
               echo 'Data Updated successfully';
              echo($regno);
              var_dump($result);
             // exit();
            }
        }
        }
    }
 
	  
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