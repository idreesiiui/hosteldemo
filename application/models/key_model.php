<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class key_model extends CI_Model
{    

    public function __construct(){

		$this->otherdb = $this->load->database('otherdb', TRUE);
		
	}

	public function list_all($gender, $regno){

		return $this->otherdb->where('GENDER', $gender)
					->where('REGNO', $regno)
					->get('tbl_key')
					->result();

	}

	public function getKey($id){

		return $this->otherdb->where('ID',$id)->get('tbl_key')->result();
	}

	public function update_key($id, $key){
		
		$data = array(
			'KEY' => $key
		);

		$this->otherdb->where('ID',$id)->update('tbl_key', $data);

		return $this->otherdb->affected_rows();
	}

	public function getContactInfo($gender, $regno){
		$gender = ($gender == 'Male') ? 'M' : 'F';
		return $this->otherdb->where('regno', $regno)
							->where('gender', $gender)
							->get('student_contact_info')
							->result();

	}

	public function getContactInfoFromTblHstd($gender, $regno){
		$gender = ($gender == 'Male') ? 'M' : 'F';
		return $this->db->where('REGNO', $regno)
						->where('GENDER', $gender)
						->get('TBL_HSTUDENTS')
						->result();
	}

	public function createStdInfo($data){
		
		$this->otherdb->insert('student_contact_info', $data);
        
        return $this->otherdb->insert_id();
	}
}