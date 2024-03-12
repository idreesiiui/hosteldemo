<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class common_model extends CI_Model
{
	public function __construct(){

		$this->otherdb = $this->load->database('otherdb', TRUE);
	}

	function GetGenderById($userId)
    {		
		return $this->otherdb->select('GENDER')
					->where('userId',$userId)
					->get('TBL_USERS')
					->result();
    }

    function GetActiveSemester($gender)
    {
		return $this->otherdb->where('GENDER',$gender)
					//->order_by('SMCODE','DESC')
					->where('IS_ACTIVE','1')
					//->limit('1')
        			->get('TBL_SEMESTER')        
         			->result();
    }

    function PictureOracle($regno)
    {
        return $this->db->select('STUDENTPICTURELR.STUDPIC, STUDENTPICTURELR.REGNO, TBL_HSTUDENTS.FATHERNAME, TBL_HSTUDENTS.CNIC, TBL_HSTUDENTS.GENDER')
	        ->from('TBL_HSTUDENTS')
			->join('STUDENTPICTURELR', 'STUDENTPICTURELR.REGNO = TBL_HSTUDENTS.REGNO','INNER')
			->where('TBL_HSTUDENTS.REGNO', $regno)
			->get()        
	        ->result();		
    }

    function CheckPictureOracle($regno)
    {
        return $this->db->select('REGNO')
				        ->where('REGNO', $regno)
				        ->get('STUDENTPICTURELR')
				        ->result();		
    }	

}