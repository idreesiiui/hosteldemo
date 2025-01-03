<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
error_reporting(E_ALL);

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
        $this->load->model('api_model');
        $this->load->model('allotment_model');
        $this->load->model('reAllotment_model');
    }

    public function sendsms(){

        $mob = '923335507643';
        $gender = 'Male';
        $hostelno = '';
        $roomno = '';

        //$allotment_students = $this->allotment_model->viewallotmentInfo($gender,$hostelno,$roomno);
        $reallotment_students = $this->reAllotment_model->viewreallotmentInfo($gender,$hostelno,$roomno);
       // echo count($reallotment_students);
       // $result = $this->sendSmsApi($mob);
       // echo json_encode($result);


       
        foreach($reallotment_students as $student){

            $number = str_replace("-","",$student->STUDENTPHONE);

            if (substr($number, 0, 1) === '0' || substr($number, 0, 1) === '3') {
                $mobile = '92' . substr($number, 1);
            } else {
                $mobile = $number;
            }
            echo $mobile;
            $result = $this->sendSmsApi($mobile);
            echo json_encode($result);
            echo "<br>";
        }


    }

    public function sendSmsApi($mob){

        $curl = curl_init();

        // Set the URL and parameters
        $url = "http://api.bizsms.pk/api-send-branded-sms.aspx";
        $params = [
            'username' => urlencode('iiu@bizsms.pk'),
            'pass' => urlencode('wjQc%EueX9'),
            'text' => urlencode('All Boarder students are advised to collect their belongings from their current rooms. Their Hostel Seats will be relocated. Schedule is already emailed'),
            'masking' => urlencode('IIUI'),
            'destinationnum' => urlencode($mob),
            'language' => urlencode('English')
        ];

        // Build query string from the parameters
        $queryString = http_build_query($params);

        // Append the query string to the URL
        $requestUrl = $url . '?' . $queryString;

        // Set cURL options
        curl_setopt($curl, CURLOPT_URL, $requestUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Execute the request and get the response
        $response = curl_exec($curl);

        // Check for errors
        if ($response === false) {
            $error = curl_error($curl);
            echo "cURL Error: $error";
        } else {
            echo "Response: $response";
        }

        // Close the cURL session
        curl_close($curl);

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
          $regno = '551-CS/BCS/99';
            
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

    public function validate_key($api_key) {
        // Replace 'your_api_key' with your actual API key
        $valid_api_key = 'IIUIStudentsDataByChallanNoToHBLIIUIBranch';
        return $api_key === $valid_api_key;
    }

    public function validate_challan($challanno) {
        return isset($challanno) && !empty($challanno) && strlen($challanno) <= 12;
    }

    public function validate_transection_id($transaction_id) {
        return !empty($transaction_id) && strlen($transaction_id) <= 19;
    }

    public function studentDataByChallanNo($key,$challanno,$status = 'getdata',$transaction_id = null){
        
        if($this->validate_key($key) && $this->validate_challan($challanno) && $status == 'getdata') {
            
            $result = $this->api_model->getStudentDataByChallanNo($challanno);

            $data = [
                "message" => "Data retrieved successfully",
                "data" => $result
            ];

            echo json_encode($data);
            
        } else if($this->validate_key($key) && $this->validate_challan($challanno) && $this->validate_transection_id($transaction_id) && $status == 'paid'){

            $result = $this->api_model->updateStudentDataByChallanNo($challanno,$transaction_id);

            $data = [
                "message" => "Challan Updated successfully",
                "Challan_No" => $challanno,
                "Transaction_ID" => $transaction_id,
                "is_updated" => $result
            ];

            echo json_encode($data);

        } else {

            $response = [
                "error" => [
                    "code" => "401",
                    "message" => "Unauthorized. Please provide valid credentials to access the data."
                ]
            ];

            http_response_code(401);
            echo json_encode($response);
                
        }
    }
}

?>