<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(E_ALL);
class Api_model extends CI_Model
{
    
    public function __construct(){
		$this->otherdb = $this->load->database('otherdb', TRUE);		
	}	

	public function getStudentDataByChallanNo($challanno){
		return $this->otherdb->select('regno,std_name,challanno,transaction_id,fee_amount,duedate,status')
					->from('std_fee_challans')
					->where('challanno',$challanno)        			
					->get()    			
        			->result();
	}

	public function updateStudentDataByChallanNo($challanno,$transaction_id){
		$data = array(			
			'status' => 'paid',
			'transaction_id' => $transaction_id
		);

		$this->otherdb->where('challanno',$challanno)->update('std_fee_challans', $data);
        
        return $this->otherdb->affected_rows();
	}

}