<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', '-1');
error_reporting(E_ALL);
/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Muhammad Idrees 
 * @version : 2.0
 * @since : 17 November 2022
 */
class Test extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
		$this->load->model('allotment_model');
		$this->load->model('reallotment_model');
        $this->load->model('report_model');
        $this->load->model('clearance_model');
        $this->load->model('seat_model');
        $this->load->model('room_model');
        $this->load->model('allotmenthistory_model');
        $this->load->model('test_model');
        $this->load->model('blacklist_model');
        $this->load->model('Semester_model');
        $this->load->model('feechallan_model');
        $this->load->model('common_model');
    }

    //get All Vacant Seat

    function getAllVacantSeats(){
        //get all reallotment sets

        //get all allotment seats $select,$table,$where
        //$tbl_allotment = $this->common_model->getAll('tbl_reallotment');
        $tbl_allotment = $this->common_model->getAll('tbl_allotment');
        //check these seats status

        foreach($tbl_allotment as $std){

        $where = array('SEATID' => $std['SEATID']);

        $seatStatus = $this->common_model->getWhere('*','tbl_seat',$where);

            if($seatStatus[0]['OCCUPIED'] == '0'){
               // var_dump($seatStatus);
        $where = array('ROOMID' => $seatStatus[0]['ROOMID']);
        $roomStatus = $this->common_model->getWhere('*','tbl_room',$where);

        $where = array('HOSTELID' => $seatStatus[0]['HOSTELID']);
        $hotelStatus = $this->common_model->getWhere('*','tbl_hostel',$where);

        echo "Hostel:" .$hotelStatus[0]['HOSTELDESC']."Room No:".$roomStatus[0]['ROOMDESC'];
        echo "Seat : ".$seatStatus[0]['SEAT'];
        echo "<br>";
            }
        }
        
    }        
}

?>