<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Muhammad Idrees 
 * @version : 2.0
 * @since : 17 November 2022
 */
class api extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
    }

    //http://usis.iiu.edu.pk:64453/api/HostelStudentPicture/iiuihostelstudentpicture/MTA5LUZBL01TVFMvRjIx

    function HostelStudentPicture($privateKey,$regno)
    {
    	if($privateKey === 'iiuihostelstudentpicture')
        {
            
            $picture = $this->db->select('STUDENTPICTURELR.STUDPIC, STUDENTPICTURELR.REGNO, TBL_HSTUDENTS.STUDENTNAME, TBL_HSTUDENTS.CNIC')
                            ->from('TBL_HSTUDENTS')
                    		->join('STUDENTPICTURELR', 'STUDENTPICTURELR.REGNO = TBL_HSTUDENTS.REGNO','INNER')
                    		->where('TBL_HSTUDENTS.REGNO', base64_decode($regno))
                            ->get()
                            ->result_array();

            if(count($picture[0]) < 1){
                echo "There is no picuture against this student";
            }else{            
                
                echo base64_encode($picture[0]['STUDPIC']);
            }        
        
    	}else{
    		echo 'You are not authorised to get data';
    	}
    }


    function TestHostelStudentPicture()
    {
          $regno = '151-FU/MSCR/F22';
            
            $picture = $this->db->select('STUDENTPICTURELR.STUDPIC, STUDENTPICTURELR.REGNO, TBL_HSTUDENTS.STUDENTNAME, TBL_HSTUDENTS.CNIC')
                            ->from('TBL_HSTUDENTS')
                            ->join('STUDENTPICTURELR', 'STUDENTPICTURELR.REGNO = TBL_HSTUDENTS.REGNO','INNER')
                            ->where('TBL_HSTUDENTS.REGNO', $regno)
                            ->get()
                            ->result_array();

            if(count($picture[0]) < 1){
                echo "There is no picuture against this student";
            }else{            
                
                echo base64_encode($picture[0]['STUDPIC']);
            }      
        
        
    }


    public function getAuthenticate(){ 

   // echo "Muhammad Idrees Testing and recroding"; exit(); 

        
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://stag.iiu.edu.pk/web/session/authenticate',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS =>'{
                "jsonrpc": "2.0",
                "params": {
                    "db": "UAT_1",
                    "login": "hostel_api",
                    "password": "123456789"
                }
            }',
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Cookie: session_id=6abbfde4193ea6b0d34d94b4caa0c69bb5d0d661'
              ),
            ));
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($curl);

            curl_close($curl);

            var_dump($response);


    }   
    
    public function getStudentsFromCMS(){

            //$this->getAuthenticate();

        //echo "get studenst from cms testing and recording"; exit();

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://stag.iiu.edu.pk/inquiry_hostlite/',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
            "jsonrpc": "2.0"
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Cookie: session_id=6abbfde4193ea6b0d34d94b4caa0c69bb5d0d661'
          ),
        ));

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($curl);

        curl_close($curl);
        var_dump($response);



    }




}

?>