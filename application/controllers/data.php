<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Muhammad Idrees 
 * @version : 2.0
 * @since : 17 November 2022
 */
class Data extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
		$this->load->model('data_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {     	
				
		$this->global['pageTitle'] = 'IIUI Hostel : Dashboard';
		
        $this->loadViews("dashboard", $this->global , $data, NULL);
    }
	
	/**
     * This function used to Update CNIC IN ALLOTMENT
     */
	
	public function updateCNICAllotment()
    {
     	$userId = $this->vendorId;	
			
		$gender = $this->gender;
		
		$allotments = $this->data_model->getallalottmentCNICEmpty($gender);
		
		foreach($allotments as $allotment)
		{
			$regno = $allotment->REGNO;
			 
			$getcnic = $this->data_model->StudentOracle($regno);
			 
			foreach($getcnic as $cnic)
			{
				$allotmentcnic = $cnic->CNIC;
				 
				$allotmentregno = $cnic->REGNO;
				 				 
				if($allotmentcnic != '')
				{			 
				    $userInfo = array('CNIC'=>$allotmentcnic);
				 
				    $updatedAllotCNIC = $this->data_model->UpdateAllotCNIC($regno,$userInfo);
				}
				  
			 }
			 
		 }
		 
		
		//exit(); 
		
		
		
				
		//$this->global['pageTitle'] = 'IIUI Hostel : Dashboard';
		
        //$this->loadViews("dashboard", $this->global , $data, NULL);
    }
	
	/**
     * This function used to Update CNIC IN ALLOTMENT
     */
	
	public function updateCNICREAllotment()
    {
     	$userId = $this->vendorId;	
			
		$gender = $this->gender;
		
		$allotments = $this->data_model->getreallalottmentCNICEmpty($gender);
		
		foreach($allotments as $allotment)
		{
			$regno = $allotment->REGNO;
			 
			$getcnic = $this->data_model->StudentOracle($regno);
			 
			foreach($getcnic as $cnic)
			{
				$allotmentcnic = $cnic->CNIC;
				 
				$allotmentregno = $cnic->REGNO;
				 
				$allotmentnationality = $cnic->NATIONALITY;
				 
				if($allotmentcnic != '')
				{			 
				    $userInfo = array('CNIC'=>$allotmentcnic);
				 
				    $updatedAllotCNIC = $this->data_model->UpdateREAllotCNIC($regno,$userInfo);
				}
				   
			}
			 
		}
		 
		
		exit(); 
		
		
		
				
		//$this->global['pageTitle'] = 'IIUI Hostel : Dashboard';
		
       // $this->loadViews("dashboard", $this->global , $data, NULL);
    }
    
    /**
     * This function is used to UPDATE NATIONALITY IN REALLOTMENT TABLE FROM ORACLE DB
     */
    function updatereallotmentnationality()
    {
        $userId = $this->vendorId;
			
		$gender = $this->gender;			
		
		 	$allotments = $this->data_model->getreallalottmentNationalityEmpty($gender);
		
		 	foreach($allotments as $allotment)
		 	{
				$regno = $allotment->REGNO;
			 
			 	$getcnic = $this->data_model->StudentOracle($regno);
			 
			foreach($getcnic as $cnic)
			{
				 
				$allotmentregno = $cnic->REGNO;
				 
				$allotmentnationality = $cnic->NATIONALITY;
				
				if($allotmentnationality != '')
				{
					$userInfo = array('NATIONALITY'=>$allotmentnationality);
				 
				   $updatedAllotCNIC = $this->data_model->UpdateREAllotNationality($regno,$userInfo);
							 
				}
       	    }
        }
    }
	
	/**
     * This function is used to UPDATE NATIONALITY IN ALLOTMENT TABLE FROM ORACLE DB
     */
    function updateallotmentnationality()
    {
        $userId = $this->vendorId;
			
		$gender = $this->gender;
			
		
		$allotments = $this->data_model->getallalottmentNationalityEmpty($gender);
		
		foreach($allotments as $allotment)
		{
			$regno = $allotment->REGNO;
			 
			$getcnic = $this->data_model->StudentOracle($regno);
			 
			foreach($getcnic as $cnic)
			{
				 
				$allotmentregno = $cnic->REGNO;
				 
				$allotmentnationality = $cnic->NATIONALITY;
				
				if($allotmentnationality != '')
				{
					$userInfo = array('NATIONALITY'=>$allotmentnationality);
				 
				    $updatedAllotCNIC = $this->data_model->UpdateAllotNationality($regno,$userInfo);
							 
				}
       	    }
        }
    }

    /**
     * This function is used to UPDATE District IN REALLOTMENT TABLE FROM ORACLE DB
     */
    function updatereallotmentdistrict()
    {
        $userId = $this->vendorId;
			
		$gender = $this->gender;			
		
		$allotments = $this->data_model->getreallalottmentDistrictEmpty($gender);
		
		foreach($allotments as $allotment)
		{
			$regno = $allotment->REGNO;
			 
			$getcnic = $this->data_model->StudentOracle($regno);
			 
			foreach($getcnic as $cnic)
			{
				 
				$allotmentregno = $cnic->REGNO;
				 
				$reallotmentdistrict = $cnic->DISTRICT;
				
				if($reallotmentdistrict != '')
				{
					$userInfo = array('NATIONALITY'=>$reallotmentdistrict);
				 
				    $updatedAllotCNIC = $this->data_model->UpdateREAllotDistrict($regno,$userInfo);
							 
				}
       	     }
         }
    }
	
	/**
     * This function is used to UPDATE District IN ALLOTMENT TABLE FROM ORACLE DB
     */
    function updateallotmentdistrict()
    {
        $userId = $this->vendorId;
			
		$gender = $this->gender;
			
		
		$allotments = $this->data_model->getallalottmentDistrictEmpty($gender);
		
		foreach($allotments as $allotment)
		{
			$regno = $allotment->REGNO;
			 
			$getcnic = $this->data_model->StudentOracle($regno);
			 
			foreach($getcnic as $cnic)
			{
							 
				$allotmentregno = $cnic->REGNO;
				 
				$allotmentdistrict = $cnic->DISTRICT;

				if($allotmentdistrict != '')
				{
					$userInfo = array('NATIONALITY'=>$allotmentdistrict);
						 
					$updatedAllotCNIC = $this->data_model->UpdateAllotDistrict($regno,$userInfo);
									 
				}
       	    }
        }
    }  
   
}

?>