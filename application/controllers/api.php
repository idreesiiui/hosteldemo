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




}

?>