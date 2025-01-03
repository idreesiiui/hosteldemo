<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// ini_set('memory_limit', '-1');
// error_reporting(E_ALL);

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Muhammad Idrees 
 * @version : 2.0
 * @since : 17 November 2022
 */
class NewFeechallan extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
		$this->load->model('feechallan_model');
		$this->load->model('seat_model');
        $this->load->model('room_model');
		$this->load->model('reallotment_model');
		$this->load->model('report_model');
		$this->load->model('Signup_model');
        $this->isLoggedIn();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
		
        $this->global['pageTitle'] = 'IIUI Hostels : Dashboard';
        
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }
    
    /**
     * This function is used to load the user list
     */

	public function updateChallanAndFee(){
		echo "challan updated";
	}
    function feeStructureListing()
    {		
		$gender = $this->gender;

		$data['Feerecords'] = $this->feechallan_model->NewFeeStructureList($gender);
		$this->global['pageTitle'] = 'IIUI Hostels : New Fee Structure Listing';
		
		$this->loadViews("feechallan/newfee/NewFeeStructureList", $this->global, $data, NULL);
        
    }

    function newFeeStucture()
    {
    	
      	 $gender = $this->gender;


		$data['viewTypeInfo'] = $this->feechallan_model->StructureTypeDetail();

		$data['viewProgInfo'] = $this->feechallan_model->ProgramDetail();
		
		$data['viewSemInfo'] = $this->feechallan_model->SemesterDetail($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel New Fee Structure Details';
		
		$this->loadViews("feechallan/newfee/addNewFeeStructure", $this->global, $data, NULL);

    }
	
	function NeweditFeeStructure($id)
    {
      	$gender = $this->gender;

		$data['viewTypeInfo'] = $this->feechallan_model->StructureTypeDetail();

		$data['viewProgInfo'] = $this->feechallan_model->ProgramDetail();
		
		$data['viewSemInfo'] = $this->feechallan_model->SemesterDetail($gender);
		
		$data['viewfeeInfo'] = $this->feechallan_model->feetype();
		
		$data['FeeStructureInfo'] = $this->feechallan_model->NewEditFeeStructureInfo($id);

		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Edit Fee Structure Details';
		
		$this->loadViews("feechallan/newfee/editNewFeeStructure", $this->global, $data, NULL);
    }
	
	function NewupdateFeeStructure()
    {
	  	$id = $this->input->post('id');
	  
	  	if($this->isTicketter() == FALSE)
        {
            $this->loadThis();
        }
        else
        {            
            
            $this->form_validation->set_rules('structuretype','Fee Structure Type','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('nationality','Nationality','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('program','program','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('feestructuresemester','Fee Structure Semester','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('status','Status','trim|required|max_length[128]|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editFeeStructure($id);
            }
            else
            {	
	
				$gender = $this->gender;
				
				$structuretype = $this->input->post('structuretype');
				
				$nationality = $this->input->post('nationality');
				
				$program = $this->input->post('program');
				
				$feestructuresemester = $this->input->post('feestructuresemester');
				
				$status = $this->input->post('status');
				
				$NewExistFeeStructure = $this->feechallan_model->NewExistFeeStructurebyId($structuretype, $nationality, $program, $feestructuresemester, $gender, $id);
								
				if(isset($NewExistFeeStructure) && !empty($NewExistFeeStructure)){
					$this->session->set_flashdata('error', $feestructuresemester.'('.$nationality.'-'.$program.'-'.$structuretype.')'.' Fee Structure already Existed');
					
					redirect('feechallan/newfeechallan/NeweditFeeStructure/'.$id);
				}
								
				$NewFeeStructureInfo = array(
					'structure_type'=>$structuretype, 
					'nationality'=>$nationality, 
					'program'=>$program, 
					'fee_structure_semester'=>$feestructuresemester, 
					'status'=>$status, 
					'gender'=>$gender, 
					'createdBy'=>$this->vendorId, 
					'updated_at'=>date('Y-m-d H:i:s')
				);
							
				$result = $this->feechallan_model->NewupdateFeeStructure($NewFeeStructureInfo, $id);
				
				if($result > 0)
				{
					$this->session->set_flashdata('success', 'Updated New Fee Structure successfully');
					redirect('feechallan/newfeechallan/feeStructureListing');
				}
				else
				{
					$this->session->set_flashdata('error', 'Updation Fee Structure failed');
					
					redirect('feechallan/newfeechallan/NeweditFeeStructure/'.$id);
				}							    
			}
		}
	}


     /**
     * This function is used to load the user list
     */
    function feeStructureHeadListing()
    {
		$gender = $this->gender;
		
		$data['Feeheads'] = $this->feechallan_model->NewFeeStructureHeadList($gender);
		$this->global['pageTitle'] = 'IIUI Hostels : New Fee Structure Head Listing';
		
		$this->loadViews("feechallan/newfee/NewFeeStructureHeadList", $this->global, $data, NULL);
        
    }

    function newFeeStuctureHead()
    {
      	$gender = $this->gender;

		$data['viewSemInfo'] = $this->feechallan_model->NewFeeStructureList($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Structure Head Details';
		
		$this->loadViews("feechallan/newfee/addNewFeeStructureHead", $this->global, $data, NULL);
        
    }
	
	function storeFeeStructureHead()
    {
	  if($this->isTicketter() == FALSE)
        {
            $this->loadThis();
        }
        else
        {
            
            
            $this->form_validation->set_rules('fee_structure_semester','Fee Structure Semester','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('headname','Head Name','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('headcode','Head Code','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('amount','Amount','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('status','Status','trim|required|max_length[128]|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->newFeeStuctureHead();
            }
            else
            {	
				$gender = $this->gender;

				$fee_structure_semester = $this->input->post('fee_structure_semester');
				$headname = $this->input->post('headname');
				$headcode = $this->input->post('headcode');
				$amount = $this->input->post('amount');
				$status = $this->input->post('status');
				
				$NewExistFeeStructureHead = $this->feechallan_model->NewExistFeeStructureHead($fee_structure_semester, $headname, $headcode, $amount, $status, $gender);
				
				if(isset($NewExistFeeStructureHead) && !empty($NewExistFeeStructureHead))
				{					
					$this->session->set_flashdata('error', 'Fee Structure Head already Existed');
					
					redirect('feechallan/newfeechallan/newFeeStuctureHead');
				}
				
				$NewFeeStructureHeadInfo = array(
					'new_fee_structure_id' => $fee_structure_semester, 
					'head_name' => $headname,
					'head_code' => $headcode, 
					'amount' => $amount, 
					'status' => $status, 
					'gender' => $gender,
					'createdBy' => $this->vendorId,
					'created_at' => date('Y-m-d H:i:s')
				);
							
				$result = $this->feechallan_model->storeNewFeeStructureHead($NewFeeStructureHeadInfo);
				
				if($result > 0)
				{
					$this->session->set_flashdata('success', 'New Fee Structure Head created successfully');
					
					redirect('feechallan/newfeechallan/feeStructureHeadListing');
				}
				else
				{
					$this->session->set_flashdata('error', 'New Fee Structure Head creation failed');
					
					redirect('feechallan/newfeechallan/newFeeStuctureHead');
				}						
			}
		}
	}
	
	function NeweditHeadFeeStructure($id)
    {
		
		$data['FeeStructureHeadInfo'] = $this->feechallan_model->NewEditHeadFeeStructureInfo($id);

		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Edit Head Fee Structure Details';
		
		$this->loadViews("feechallan/newfee/editNewHeadFeeStructure", $this->global, $data, NULL);
    }
	
	function updateFeeStructureHead()
    {
	  $id = $this->input->post('id');
	  
	  if($this->isTicketter() == FALSE)
        {
            $this->loadThis();
        }
        else
        {
            
            
            $this->form_validation->set_rules('headname','Head Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('amount','Amount','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('status','Status','trim|required|max_length[128]|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->NeweditHeadFeeStructure($id);
            }
            else
            {	
				$gender = $this->gender;

				$fee_structure_semester = $this->input->post('fee_structure_semester');
				$headname = $this->input->post('headname');
				$headcode = $this->input->post('headcode');
				$amount = $this->input->post('amount');
				$status = $this->input->post('status');
				
				$NewExistFeeStructureHead = $this->feechallan_model->NewExistFeeStructureHeadbyId($fee_structure_semester, $headname, $headcode, $amount, $status, $gender, $id);
				
				if(isset($NewExistFeeStructureHead) && !empty($NewExistFeeStructureHead)){
					
					$this->session->set_flashdata('error', 'Fee Structure Head already Existed');
					
					redirect('feechallan/newfeechallan/NeweditHeadFeeStructure/'.$id);
				}
				
				$NewFeeStructureHeadInfo = array('head_name'=>$headname, 'amount'=>$amount, 'status'=>$status, 
				                    'gender'=>$gender, 'createdBy'=>$this->vendorId, 'updated_at'=>date('Y-m-d H:i:s'));
							
				$result = $this->feechallan_model->NewupdateFeeStructureHead($NewFeeStructureHeadInfo, $id);
				
				if($result > 0)
				{
					$this->session->set_flashdata('success', 'Updated New Fee Structure Head successfully');
					redirect('feechallan/newfeechallan/feestructureHeadListing');
				}
				else
				{
					$this->session->set_flashdata('error', 'Updation Fee Structure Head failed');
					
					redirect('feechallan/newfeechallan/NeweditHeadFeeStructure/'.$id);
				}				
						
			}
		}
	}
	
	function storeFeeStructure()
    {
	  if($this->isTicketter() == FALSE)
        {
            $this->loadThis();
        }
        else
        {
            
            
            $this->form_validation->set_rules('structuretype','Fee Structure Type','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('nationality','Nationality','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('program','program','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('feestructuresemester','Fee Structure Semester','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('status','Status','trim|required|max_length[128]|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->newFeeStucture();
            }
            else
            {	
	
				$gender = $this->gender;
				
				$structuretype = $this->input->post('structuretype');
				
				$nationality = $this->input->post('nationality');
				
				$program = $this->input->post('program');
				
				$feestructuresemester = $this->input->post('feestructuresemester');
				
				$status = $this->input->post('status');
				
				$NewExistFeeStructure = $this->feechallan_model->NewExistFeeStructure($structuretype, $nationality, $program,$feestructuresemester, $gender);
								
				if(isset($NewExistFeeStructure) && !empty($NewExistFeeStructure)){
					$this->session->set_flashdata('error', $feestructuresemester.'('.$nationality.'-'.$program.'-'.$structuretype.')'.' Fee Structure already Existed');
					
					redirect('feechallan/newfeechallan/newFeeStucture');
				}
				
				$NewFeeStructureInfo = array('structure_type'=>$structuretype, 'nationality'=>$nationality, 'program'=>$program, 							    'fee_structure_semester'=>$feestructuresemester, 'status'=>$status, 'gender'=>$gender, 	        			                                'createdBy'=>$this->vendorId, 'created_at'=>date('Y-m-d H:i:s'));
							
				$result = $this->feechallan_model->storeNewFeeStructure($NewFeeStructureInfo);
				
				if($result > 0)
				{
					$this->session->set_flashdata('success', 'New Fee Structure created successfully');
					
					redirect('feechallan/newfeechallan/feeStructureListing');
				}
				else
				{
					$this->session->set_flashdata('error', 'New Fee Structure creation failed');
					
					redirect('feechallan/newfeechallan/newFeeStucture');
				}						
			}
		}
	}
	
	function newfeechallans()
	{	 	
		$gender = $this->gender;
		
		$csem = $this->feechallan_model->CurrentSemester($gender);
		 
		$currentsem = $csem->semcode;

		//echo $currentsem;
		//exit();
		
		$data['challaninfo'] = $this->feechallan_model->getChallanInfo($currentsem, $gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : Fee Challan';
        
        $this->loadViews("feechallan/newfee/feechallan", $this->global, $data , NULL);
	}
	  
	function addregnowisefeechallan()
    {
      	$gender = $this->gender;
		
		$data['currentsem'] = $this->feechallan_model->CurrentSemester($gender);
		
		$data['seminfo'] = $this->feechallan_model->SemesterDetail($gender);

		$data['viewSemInfo'] = $this->feechallan_model->NewFeeStructureList($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Structure Head Details';
		
		$this->loadViews("feechallan/newfee/addregnofeechallan", $this->global, $data, NULL);        
    }
	 
	function getRegnoFeechallan()
    {
     	$userId = $this->vendorId;

      	$gender = $this->gender;
		
		$csem = $this->input->post('csem');
		
		$feestructureid = $this->input->post('feestructuresemester');
		
		$status = $this->input->post('status');
		
		$publish = $this->input->post('publish');
		
		$month = $this->input->post('month');
		
		$issuedate = date("Y-m-d", strtotime($this->input->post('issuedate')));
				
		$duedate = date("Y-m-d", strtotime($this->input->post('duedate')));	
		
		$studpostregno = $this->input->post('regno');	
		
		$feestructureinfo = $this->feechallan_model->GetFeestructureInfo($feestructureid);
		
		$structsemcode = $feestructureinfo->fee_structure_semester;
		
		$strucFeetype = $feestructureinfo->structure_type;
		
		$strucnationality = $feestructureinfo->nationality;
		
		$strucprogram = $feestructureinfo->program;
		
		$csemchallan_status = $this->feechallan_model->CheckFeestatusRegnowise($studpostregno, $gender, $csem, $feestructureid);		
				
		if($strucFeetype == 'ReAllotment')
		{
			
			if(!empty($csemchallan_status))
			{
			
				$this->session->set_flashdata('error', 'Fee Challan already generated for this current semester. If you want to generate Fee Challan of this Structure try with different Current Semester.');
				redirect('feechallan/newfeechallan/addregnowisefeechallan');
			
		    }
		
			$currentsemcode = $this->feechallan_model->CurrentSemester($gender);
			
			$currentsemcode = $currentsemcode->semcode;
			
			$regnoinfos = $this->feechallan_model->GetsingleregnoInfo($currentsemcode, $gender, $studpostregno, $structsemcode);
			//echo $currentsemcode, $gender, $studpostregno, $structsemcode; exit();
			//FALL-2023
			//Male
			//826-FA/BSTI/F22
			//FALL-2022
			if(!empty($regnoinfos)){

				$count = 0;

				foreach($regnoinfos as $regnoinfo){
							
					$challanno = $this->feechallan_model->NewGetLastChallanno();
						
					if(empty($challanno))
					{
						$lastchallanno = (int)'200000042842';
					}
					else
					{	 
						$lastchallanno = $challanno->challanno+1;
					}
															
					$regno = $regnoinfo->regno;
					
					$studentaljamia = $this->feechallan_model->GetstudinfoAljamia($regno);
					
					$studregno = $studentaljamia->REGNO ?? $studentaljamia[0]->REGNO;
										
					$studnationality = $studentaljamia->NATIONALITY ?? $studentaljamia[0]->NATIONALITY;
										
					$studprogram = $studentaljamia->PROTITTLE ?? $studentaljamia[0]->PROTITTLE;
								
					if($studprogram == 'BS' || $studprogram == 'LLB' || $studprogram == 'MA' || $studprogram == 'MSC' || $studprogram == 'BA'){
						$studprogram = 'BS';	
					}
					elseif($studprogram == 'MS')
					{
						$studprogram = 'MS';
					}
					elseif($studprogram == 'PHD' || $studprogram == 'Ph.D')
					{
						$studprogram = 'PHD';
					}
						
					if($studnationality == 'Pakistani'){
						
						$studnationality = 'Pakistani';
					}
					elseif($studnationality != 'Pakistani'){
						
						$studnationality = 'Foreigner';
					}
								
					if(!empty($studregno) && ($studprogram == $strucprogram) && ($studnationality == $strucnationality) )
					{			
										
						$feeregno = $studregno;						
									 
						$SaveRenewalFeeChallan = array(
							'regno'=>$feeregno, 
							'current_semester'=>$csem, 
							'nationality'=>$studnationality, 
							'fee_structure_id'=>$feestructureid, 
							'challanno'=>$lastchallanno, 
							'fineamount'=>'0', 
							'feetype'=>'HOSTEL RENEWAL FEE', 
							'gender'=>$gender, 
							'duedate'=>$duedate, 
							'issuedate'=>$issuedate, 
							'status'=>'1', 
							'month'=>$month, 
							'publish'=>$publish,
							'created_by'=>$userId, 
							'created_at'=>date('Y-m-d H:m:i')
						);
												  
						$lastpayid = $this->feechallan_model->InsertNewFeeChallan($SaveRenewalFeeChallan);
										
						$count++;
					}								
				}
						
				if(!empty($lastpayid)){
														
					$totalcount = $count+0;
								
					$checkfeestatus = $this->feechallan_model->ExistFeeChallanStatus($feestructureid, $gender, $currentsemcode);
					
					if(empty($checkfeestatus))
					{
							
						$CurrentSem_feechallanInfo = array(
							'fee_gen_csem'=> 1, 
							'publish'=> $publish, 
							'total_challan'=> $totalcount, 
							'new_fee_structure_id'=>$feestructureid, 
							'month'=>$month, 
							'issuedate'=>$issuedate, 
							'duedate'=>$duedate, 
							'gender'=>$gender, 
							'fee_challan_csem'=> $currentsemcode,
							'created_by'=>$userId, 
							'created_at'=>date('Y-m-d H:m:i')
						);
								
						$this->feechallan_model->StoreFeeChallanStatusInfo($CurrentSem_feechallanInfo);
					}
					elseif(!empty($checkfeestatus))
					{
					  	$existchallan = $checkfeestatus->total_challan;
					  	$feestatusid = $checkfeestatus->id;
					  	$totalcount = $totalcount+$existchallan;

					  	$updatedchallan = array(
					  		'total_challan'=> $totalcount,
					  		'created_by'=>$userId,
					  		'updated_at'=>date('Y:m:d H:m:i')
					  	);	

				  		$this->feechallan_model->UpdatedNewFeeChallanStatus($updatedchallan, $feestatusid);
					}
						
				}
						
				$this->session->set_flashdata('success', $count.' Hostel Renewal Fee Challan generated Successfully');
										
				redirect('feechallan/newfeechallan/addregnowisefeechallan');
			}
			else
			{
				$this->session->set_flashdata('error', 'No Regno found in AllottReAllot Module. Please Verify Student Regno');
										
				redirect('feechallan/newfeechallan/addregnowisefeechallan');
			}
		}
		elseif($strucFeetype == 'Allotment')
		{
			   
			if($studpostregno == ''){

				$this->session->set_flashdata('error', 'Enter Valid Regno');
									
				redirect('feechallan/newfeechallan/addregnowisefeechallan');
			}
			else
			{
					   
				$currentsemcode = $this->feechallan_model->CurrentSemester($gender);
							
				$currentsemcode = $currentsemcode->semcode;
							
				$regnoinfos = $this->feechallan_model->GetStudAllotmentregnoInfo($studpostregno, $gender);
							
				if(!empty($regnoinfos))
				{
					$count = 0;
						
					foreach($regnoinfos as $regnoinfo)
					{
									
						$regno = $regnoinfo->regno;

						$csemchallan_status = $this->feechallan_model->CheckFeestatusRegno($regno, $gender, $csem, $feestructureid);	
						
						if(empty($csemchallan_status))
						{
								
							$challanno = $this->feechallan_model->NewGetLastChallanno();
							
							if(empty($challanno))
							{
								$lastchallanno = (int)'200000042842';
							}
							else
							{
								$lastchallanno = $challanno->challanno+1;
							}	
												
							$studentaljamia = $this->feechallan_model->GetstudinfoAljamia($regno);
								
							$studregno = $studentaljamia->REGNO ?? $studentaljamia[0]->REGNO;
										
							$studnationality = $studentaljamia->NATIONALITY ?? $studentaljamia[0]->NATIONALITY;
										
							$studprogram = $studentaljamia->PROTITTLE ?? $studentaljamia[0]->PROTITTLE;
												
							if($studprogram == 'BSC' || $studprogram == 'BS' || $studprogram == 'LLB' || $studprogram == 'MA' || $studprogram == 'MSC' || $studprogram == 'BA')
							{
								$studprogram = 'BS';
												
							}
							elseif($studprogram == 'MS')
							{
								$studprogram = 'MS';
							}
							elseif($studprogram == 'PHD' || $studprogram == 'Ph.D'){
								$studprogram = 'PHD';
							}
											  
							if($studnationality == 'Pakistani')
							{						
								$studnationality = 'Pakistani';
							}
							elseif($studnationality != 'Pakistani')
							{									
								$studnationality = 'Foreigner';
							}
												
												
							if(!empty($studregno) && ($studprogram == $strucprogram) && ($studnationality == $strucnationality) )
							{
																																 
								$SaveRenewalFeeChallan = array(
									'regno'=>$regno, 
									'current_semester'=>$currentsemcode, 
									'nationality'=>$studnationality, 
									'fee_structure_id'=>$feestructureid, 
									'challanno'=>$lastchallanno, 
									'fineamount'=>'0', 
									'feetype'=>'HOSTEL FEE', 
									'gender'=>$gender,
									'duedate'=>$duedate, 
									'issuedate'=>$issuedate, 
									'status'=>'1', 
									'month'=>$month, 
									'publish'=>$publish,
									'created_by'=>$userId, 
									'created_at'=>date('Y-m-d H:m:i')
								);
								$lastpayid = $this->feechallan_model->InsertNewFeeChallan($SaveRenewalFeeChallan);	
										
								$count++;
							}												
						}									
					} //end foreach
								
					if(!empty($lastpayid)){
															
						$totalcount = $count+0;
								
						$checkfeestatus = $this->feechallan_model->ExistFeeChallanStatus($feestructureid, $gender, $currentsemcode);
				
						if(empty($checkfeestatus))
						{
									
							$CurrentSem_feechallanInfo = array(
								'fee_gen_csem'=> 1, 
								'publish'=> $publish, 
								'total_challan'=> $totalcount, 
								'new_fee_structure_id'=>$feestructureid, 
								'month'=>$month, 
								'issuedate'=>$issuedate, 
								'duedate'=>$duedate, 
								'gender'=>$gender, 
								'fee_challan_csem'=> $currentsemcode,
								'created_by'=>$userId, 
								'created_at'=>date('Y-m-d H:m:i')
							);
										
							$this->feechallan_model->StoreFeeChallanStatusInfo($CurrentSem_feechallanInfo);
							
						}
						elseif(!empty($checkfeestatus))
						{
							$existchallan = $checkfeestatus->total_challan;

							$feestatusid = $checkfeestatus->id;

							$totalcount = $totalcount+$existchallan;

							$updatedchallan = array(
								'total_challan'=> $totalcount,
								'created_by'=>$userId,
								'updated_at'=>date('Y:m:d H:m:i')
							);	
							$this->feechallan_model->UpdatedNewFeeChallanStatus($updatedchallan, $feestatusid);						  
						}
						
					}

					if($count > 0)
					{
						$this->session->set_flashdata('success', $count.' Hostel Allotment Fee Challan generated Successfully');
					}
					else
					{
						$this->session->set_flashdata('error', 'New Allotmnt Fee Challan is not genrated. Try again with correct information');	
					}
									
					redirect('feechallan/newfeechallan/addregnowisefeechallan');
								
				}
				else
				{
								
					$this->session->set_flashdata('error', 'New Application does not verified from Provost Office or Challan against provided Regno for semester '.$csem.' already generated');
									
					redirect('feechallan/newfeechallan/addregnowisefeechallan');
								
				}	   
			}
		}
    }
	 
	function addbulkfeechallan()
    {
      	$gender = $this->gender;
		
		$data['currentsem'] = $this->feechallan_model->CurrentSemester($gender);

		$data['viewSemInfo'] = $this->feechallan_model->NewFeeStructureList($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Structure Head Details';
		
		$this->loadViews("feechallan/newfee/addbulkfeechallan", $this->global, $data, NULL);        
    }
	 
	function getBulkFeechallan()
    {
    	$userId = $this->vendorId;

      	$gender = $this->gender;
		
		$csem = $this->input->post('csem');
		
		$feestructureid = $this->input->post('feestructuresemester');
		
		$status = $this->input->post('status');
		
		$publish = $this->input->post('publish');
		
		$month = $this->input->post('month');
		
		$issuedate = date("Y-m-d", strtotime($this->input->post('issuedate')));
				
		$duedate = date("Y-m-d", strtotime($this->input->post('duedate')));	
		
		$startdate = $this->input->post('startdate');
				
		$enddate = $this->input->post('enddate');	
		
		$feestructureinfo = $this->feechallan_model->GetFeestructureInfo($feestructureid);
		
		$structsemcode = $feestructureinfo->fee_structure_semester;
		
		$strucFeetype = $feestructureinfo->structure_type;
		
		$strucnationality = $feestructureinfo->nationality;
		
		$strucprogram = $feestructureinfo->program;
		
		$csemchallan_status = $this->feechallan_model->CheckFeestatus($gender, $csem, $feestructureid);
				
		if($strucFeetype == 'ReAllotment'){
			
			if(!empty($csemchallan_status)){
			
				$this->session->set_flashdata('error', 'Fee Challan already generated for this current semester. If you want to generate Fee Challan of this Structure generate by Regno wise');
				redirect('feechallan/newfeechallan/addbulkfeechallan');
			
		    }
		
			$currentsemcode = $this->feechallan_model->CurrentSemester($gender);
				
			$currentsemcode = $currentsemcode->semcode;
				
			$regnoinfos = $this->feechallan_model->GetAllregnoInfo($currentsemcode, $gender, $structsemcode);

			//echo $currentsemcode, $gender, $structsemcode;  exit();
				
			if(!empty($regnoinfos)){

				$count = 0;

				foreach($regnoinfos as $regnoinfo){
							
					$regno = $regnoinfo->regno;
							
					$hostelbatch = $regnoinfo->hostelbatch;
							
					$studentaljamia = $this->feechallan_model->GetstudinfoAljamia($regno);
							
					$studregno = $studentaljamia->REGNO;
							
					$studnationality = $studentaljamia->NATIONALITY;
							
					$studprogram = $studentaljamia->PROTITTLE;
								
					if($studprogram == 'BS' || $studprogram == 'LLB' || $studprogram == 'MA' || $studprogram == 'MSC' || $studprogram == 'BA'){
						$studprogram = 'BS';	
					} elseif($studprogram == 'MS'){
							     
						$studprogram = 'MS';
					} elseif($studprogram == 'PHD'){
							     
						 $studprogram = 'PHD';
					}
				
					if($studnationality == 'Pakistani'){
						
						$studnationality = 'Pakistani';
					} elseif($studnationality != 'Pakistani'){
						
						$studnationality = 'Foreigner';
					}
								
					if(!empty($studregno) && ($studprogram == $strucprogram) && ($studnationality == $strucnationality) )
					{
								
						$challanno = $this->feechallan_model->NewGetLastChallanno();
						
						if(empty($challanno))
						{
							$lastchallanno = (int)'200000042842';
						} else {	 
							$lastchallanno = $challanno->challanno+1;
						}
										
						$feeregno = $studregno;						
								 
						$SaveRenewalFeeChallan = array(
							'regno'=>$feeregno, 
							'current_semester'=>$currentsemcode, 
							'nationality'=>$studnationality, 
							'fee_structure_id'=>$feestructureid, 
							'challanno'=>$lastchallanno, 
							'fineamount'=>'0', 
							'feetype'=>'HOSTEL RENEWAL FEE', 
							'gender'=>$gender, 
							'duedate'=>$duedate, 
							'issuedate'=>$issuedate, 
							'status'=>'1', 
							'month'=>$month, 
							'publish'=>$publish,
							'created_by'=>$userId, 
							'created_at'=>date('Y-m-d H:m:i')
						);
												  
						$lastpayid = $this->feechallan_model->InsertNewFeeChallan($SaveRenewalFeeChallan);
										
						$count++;
										
									//}
					}
								
				}
						
				if(!empty($lastpayid)){
														
					$totalcount = $count+0;
							
					$checkfeestatus = $this->feechallan_model->ExistFeeChallanStatus($feestructureid, $gender, $currentsemcode);
				
					if(empty($checkfeestatus)){
							
						$CurrentSem_feechallanInfo = array(
							'fee_gen_csem'=> 1, 
							'publish'=> $publish, 
							'total_challan'=> $totalcount, 
							'new_fee_structure_id'=>$feestructureid, 
							'month'=>$month, 
							'issuedate'=>$issuedate, 
							'duedate'=>$duedate, 
							'gender'=>$gender, 
							'fee_challan_csem'=> $currentsemcode,
							'created_by'=>$userId, 
							'created_at'=>date('Y-m-d H:m:i')
						);
							
						$this->feechallan_model->StoreFeeChallanStatusInfo($CurrentSem_feechallanInfo);
							
					}elseif(!empty($checkfeestatus))
					{

						$existchallan = $checkfeestatus->total_challan;
						$feestatusid = $checkfeestatus->id;
						$totalcount = $totalcount+$existchallan;

						$updatedchallan = array(
							'total_challan'=> $totalcount,
							'created_by'=>$userId,
							'updated_at'=>date('Y:m:d H:m:i')
						);	
						$this->feechallan_model->UpdatedNewFeeChallanStatus($updatedchallan, $feestatusid);
					}
				}
						
				$this->session->set_flashdata('success', $count.' Hostel Renewal Fee Challan generated Successfully');
									
				redirect('feechallan/newfeechallan/addbulkfeechallan');
			}
			else
			{				

				$this->session->set_flashdata('error', 'Please Migrate data first. No Regno found in AllottReAllot Module');
									
				redirect('feechallan/newfeechallan/addbulkfeechallan');
			}
		}elseif($strucFeetype == 'Allotment')
		{
			   
			if($startdate == '' || $enddate = '')
			{

				$this->session->set_flashdata('error', 'Start Date and End Date are missing');
										
				redirect('feechallan/newfeechallan/addbulkfeechallan');	
			} else {
					   
			    $startdate = date("Y-m-d", strtotime($this->input->post('startdate')));
				
				$enddate = date("Y-m-d", strtotime($this->input->post('enddate')));	
				
				$currentsemcode = $this->feechallan_model->CurrentSemester($gender);
				
				$currentsemcode = $currentsemcode->semcode;
				
				$regnoinfos = $this->feechallan_model->GetAllAllotmentregnoInfo($gender, $startdate, $enddate);
							
				if(!empty($regnoinfos))
				{

					$count = 0;

					foreach($regnoinfos as $regnoinfo)
					{
						$regno = $regnoinfo->regno;

						$csemchallan_status = $this->feechallan_model->CheckFeestatusRegno($regno, $gender, $csem, $feestructureid);								
						
						if(empty($csemchallan_status))
						{											
							$challanno = $this->feechallan_model->NewGetLastChallanno();

							if(empty($challanno))
						  	{
								$lastchallanno = (int)'200000042842';
						  	} else {	 
								$lastchallanno = $challanno->challanno+1;
							}
													
							$studentaljamia = $this->feechallan_model->GetstudinfoAljamia($regno);
								
							$studregno = $studentaljamia->REGNO;
							
							$studnationality = $studentaljamia->NATIONALITY;
							
							$studprogram = $studentaljamia->PROTITTLE;
							
							if($studprogram == 'BS' || $studprogram == 'LLB' || $studprogram == 'MA' || $studprogram == 'MSC' || $studprogram == 'BA'){

								$studprogram = 'BS';
							
						  	} elseif($studprogram == 'MS'){
													 
								$studprogram = 'MS';
							} elseif($studprogram == 'PHD'){
													 
								$studprogram = 'PHD';
							}

							if($studnationality == 'Pakistani'){
										
								$studnationality = 'Pakistani';
							} elseif($studnationality != 'Pakistani'){
													
								$studnationality = 'Foreigner';
							}
												
							if(!empty($studregno) && ($studprogram == $strucprogram) && ($studnationality == $strucnationality) ){
													
																													 
								$SaveRenewalFeeChallan = array(
									'regno'=>$regno, 
									'current_semester'=>$currentsemcode, 
									'nationality'=>$studnationality, 
									'fee_structure_id'=>$feestructureid, 
									'challanno'=>$lastchallanno, 
									'fineamount'=>'0', 
									'feetype'=>'HOSTEL FEE', 
									'gender'=>$gender, 
									'duedate'=>$duedate, 
									'issuedate'=>$issuedate, 
									'status'=>'1', 
									'month'=>$month, 
									'publish'=>$publish,
									'created_by'=>$userId, 
									'created_at'=>date('Y-m-d H:m:i'));
											  
							        $lastpayid = $this->feechallan_model->InsertNewFeeChallan($SaveRenewalFeeChallan);
									
								$count++;
							}												
						}									
					}
								
					if(!empty($lastpayid))
					{
														
						$totalcount = $count+0;
								
						$checkfeestatus = $this->feechallan_model->ExistFeeChallanStatus($feestructureid, $gender, $currentsemcode);
					
						if(empty($checkfeestatus)){
										
							$CurrentSem_feechallanInfo = array(
								'fee_gen_csem'=> 1, 
								'publish'=> $publish, 
								'total_challan'=> $totalcount, 
								'new_fee_structure_id'=>$feestructureid, 
								'month'=>$month, 
								'issuedate'=>$issuedate, 
								'duedate'=>$duedate, 
								'gender'=>$gender, 
								'fee_challan_csem'=> $currentsemcode,
								'created_by'=>$userId, 
								'created_at'=>date('Y-m-d H:m:i')
							);
											
							$this->feechallan_model->StoreFeeChallanStatusInfo($CurrentSem_feechallanInfo);
								
						} elseif(!empty($checkfeestatus)){
						  	$existchallan = $checkfeestatus->total_challan;
						  	$feestatusid = $checkfeestatus->id;
						  	$totalcount = $totalcount+$existchallan;

							  $updatedchallan = array(
							  	'total_challan'=> $totalcount,
							  	'created_by'=>$userId,
							  	'updated_at'=>date('Y:m:d H:m:i')
							  );	
						  	$this->feechallan_model->UpdatedNewFeeChallanStatus($updatedchallan, $feestatusid);								  
						}
						
					}
								
					$this->session->set_flashdata('success', $count.' Hostel Allotment Fee Challan from date '.$startdate.' to '.$enddate.' generated Successfully');
								echo $count;	
						  	redirect('feechallan/newfeechallan/addbulkfeechallan');
				} else {
								
					$this->session->set_flashdata('error', 'New Application does not verified from Provost Office.');
									
					redirect('feechallan/newfeechallan/addbulkfeechallan');
								
				}
			}
		}
	}
	 
	function NeweditFeeChallan($id)
    {
      	$gender = $this->gender;

		$data['editFeeInfo'] = $this->feechallan_model->NeweditFeeChallan($id);
		
		$this->global['pageTitle'] = 'IIUI Hostels : Edit Hostel Fee Challan Details';
		
		$this->loadViews("feechallan/newfee/NeweditFeeChallan", $this->global, $data, NULL);
        
     }
	 
	 function NeweditFeeChallanByRegno($id)
     {
      	$gender = $this->gender;

		$data['editFeeInfo'] = $this->feechallan_model->NeweditFeeChallanByRegno($id);
		
		$this->global['pageTitle'] = 'IIUI Hostels : Edit Hostel Fee Challan Details';
		
		$this->loadViews("feechallan/newfee/NeweditFeeChallanByRegno", $this->global, $data, NULL);
        
     }

     function createHostelChallanInstallments($id)
     {
     	
      	$gender = $this->gender;

		$data['editFeeInfo'] = $this->feechallan_model->NeweditFeeChallanByRegno($id);
		
		$this->global['pageTitle'] = 'IIUI Hostels : Edit Hostel Fee Challan Details';
		
		$this->loadViews("feechallan/newfee/createHostelChallanInstallment", $this->global, $data, NULL);
        
     }

    function convertChallanInstallment(){     	

     	$id = $this->input->post('id');
	  
	  	if($this->isTicketter() == FALSE)
	    {
	        $this->loadThis();
	    }
	    else
	    {
            
           	$this->form_validation->set_rules('csem','Current Semester','trim|required|max_length[128]|xss_clean');

			$this->form_validation->set_rules('firstInstallmentissuedate','First Installment Issue Date','trim|required|max_length[128]|xss_clean');

            $this->form_validation->set_rules('firstInstallmentduedate','First Installment Due Date','trim|required|max_length[128]|xss_clean');

            $this->form_validation->set_rules('secondInstallmentissuedate','Second Installment Issue Date','trim|required|max_length[128]|xss_clean');

            $this->form_validation->set_rules('secondInstallmentduedate','Second Installment Due Date','trim|required|max_length[128]|xss_clean');
			
            if($this->form_validation->run() == FALSE)
            {
                $this->createHostelChallanInstallments($id);
            }
            else
            {	
	
				$gender = $this->gender;
				
				$firstInstallmentissuedate = $this->input->post('firstInstallmentissuedate');

				$firstInstallmentduedate = $this->input->post('firstInstallmentduedate');

				$secondInstallmentissuedate = $this->input->post('secondInstallmentissuedate');

				$secondInstallmentduedate = $this->input->post('secondInstallmentduedate');	

				$challanDetail = $this->feechallan_model->printFeeChallanByRegno($id);			
				
				$csem = $this->input->post('csem');
				
				$challanno = $this->feechallan_model->GetLastChallanno();
						
				if(empty($challanno))
				{
					$lastchallanno = (int)'200000000001';
				} else {
				   	$lastchallanno = $challanno[0]->CHALLANNO+1;
				}


				if(isset($firstInstallmentduedate) && isset($firstInstallmentissuedate) 
					&& ($challanDetail->installment == null || empty($challanDetail->installment))){  
				
					$updateExistingChalanToInstallment = array(
						'fineamount' => '0', 
						'finestatus' => '0', 
						'installment' => '1', 
						'duedate' => $firstInstallmentduedate, 
						'issuedate' => $firstInstallmentissuedate, 
						'month' => $challanDetail->month/2, 
						'updated_by' => $this->vendorId, 
						'updated_at' => date('Y-m-d H:i:s')
					);


					$result = $this->feechallan_model->updateFeeInfobyRegno($updateExistingChalanToInstallment, $id);

				}

				if(isset($secondInstallmentduedate) && isset($secondInstallmentissuedate) && ($challanDetail->installment == null || empty($challanDetail->installment))){

					$createSecondInstallamnent  = array(

						'regno' => $challanDetail->regno, 
						'current_semester' => $challanDetail->current_semester, 
						'nationality' => $challanDetail->nationality, 
						'fee_structure_id' => $challanDetail->fee_structure_id, 
						'challanno' => $lastchallanno, 
						'modify' => $challanDetail->modify, 
						'fineamount' => '0', 
						'finestatus' => '0', 
						'feetype' => $challanDetail->feetype, 
						'gender' => $challanDetail->gender, 
						'installment' => '2', 
						'duedate' => $secondInstallmentduedate,
						'issuedate' => $secondInstallmentissuedate, 
						'status' => '1', 
						'month' => $challanDetail->month/2, 
						'extension' => $challanDetail->extension, 
						'publish' => '0', 							    
						'created_by' => $this->vendorId, 
						'created_at' => date('Y-m-d H:i:s') 
						
					);		
				
					$result2 = $this->feechallan_model->InsertNewFeeChallan($createSecondInstallamnent);
				
				}

				if($result > 0 && $result2 > 0 )
				{
					$this->session->set_flashdata('success', 'Installment Created successfully');
					
					redirect('feechallan/newfeechallan/newfeechallans');
				} else {
					$this->session->set_flashdata('error', 'New Fee updation failed');
					
					redirect('feechallan/newfeechallan/createHostelChallanInstallments/'.$id);
				}
			}
		}
	}


	function printFeeChallanByRegno($id)
    {
      	$gender = $this->gender;

		$data['FeeInfo'] = $this->feechallan_model->printFeeChallanByRegno($id);
		
		$data['BankInfo'] = $this->feechallan_model->ViewBankInfo($gender);
		
		$this->load->view("feechallan/newfee/printFeeChallanByRegno", $data);
        
    }
	 
	function updateFeeinfo()
    {
	  $id = $this->input->post('id');
	  
	  	if($this->isTicketter() == FALSE)
        {
            $this->loadThis();
        }
        else
        {            
            
            $this->form_validation->set_rules('csem','Current Semester','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('issuedate','Issue Date','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('duedate','Due Date','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('publish','Publish','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('month','Months','trim|required|max_length[128]|xss_clean');
			
            if($this->form_validation->run() == FALSE)
            {
                $this->NeweditFeeChallan($id);
            }
            else
            {	
	
				$gender = $this->gender;
				
				$issuedate = $this->input->post('issuedate');
				
				$duedate = $this->input->post('duedate');
				
				$publish = $this->input->post('publish');
				
				$month = $this->input->post('month');
				
				$csem = $this->input->post('csem');
								
				$feestructureid = $this->input->post('feestructid');
				
				$result = $this->feechallan_model->GetFeestructureInfo($feestructureid);
								
				$feenationality =  $result->nationality;
												
				
				$NewEditFeeInfo = array(
					'issuedate'=>$issuedate, 
					'duedate'=>$duedate, 
					'publish'=>$publish, 							    
					'month'=>$month, 
					'updated_by'=>$this->vendorId, 
					'updated_at'=>date('Y-m-d H:i:s')
				);
							
				$result = $this->feechallan_model->updateFeeInfo($NewEditFeeInfo, $id);
				
				$result = $this->feechallan_model->updateExistRegFeeInfo($NewEditFeeInfo, $feestructureid, $feenationality, $csem);
				
				if($result > 0)
				{
					$this->session->set_flashdata('success', 'New Fee Updated successfully');
					
					redirect('feechallan/newfeechallan/newfeechallans');
				}
				else
				{
					$this->session->set_flashdata('error', 'New Fee updation failed');
					
					redirect('feechallan/newfeechallan/NeweditFeeChallan/'.$id);
				}		
			}
		}
	}
	
	function updateFeeinfobyRegno()
    {
	  $id = $this->input->post('id');
	  
	  if($this->isTicketter() == FALSE)
        {
            $this->loadThis();
        }
        else
        {            
            
            $this->form_validation->set_rules('csem','Current Semester','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('issuedate','Issue Date','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('duedate','Due Date','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('publish','Publish','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('month','Months','trim|required|max_length[128]|xss_clean');
			
            if($this->form_validation->run() == FALSE)
            {
                $this->NeweditFeeChallan($id);
            }
            else
            {	
	
				$gender = $this->gender;
				
				$issuedate = $this->input->post('issuedate');
				
				$duedate = $this->input->post('duedate');
				
				$publish = $this->input->post('publish');
				
				$month = $this->input->post('month');
				
				$csem = $this->input->post('csem');
				
				$fineamount = $this->input->post('fineamount');
				
				$extension = $this->input->post('extension');
				
				$modify = $this->input->post('modify');
				
				$finestatus = $this->feechallan_model->NeweditFeeChallanByRegno($id);
				
				$existedfine = $finestatus->fineamount;
				
				if($existedfine > 0 && $fineamount == 0){
				   $finestatus = 1;
				}
				else
				{
				   $finestatus = 0;
				}
				
				$NewEditFeeInfo = array(
					'issuedate' => $issuedate, 
					'duedate' => $duedate, 
					'publish' => $publish, 							    
					'month' => $month, 
					'fineamount' => $fineamount, 
					'modify' => $modify, 
					'extension' => $extension, 
					'finestatus' => $finestatus, 
					'updated_by' => $this->vendorId, 
					'updated_at' => date('Y-m-d H:i:s')
				);
							
				$result = $this->feechallan_model->updateFeeInfobyRegno($NewEditFeeInfo, $id);
				
							
				if($result > 0)
				{
					$this->session->set_flashdata('success', 'New Fee Updated successfully');
					
					redirect('feechallan/newfeechallan/newfeechallans');
				}
				else
				{
					$this->session->set_flashdata('error', 'New Fee updation failed');
					
					redirect('feechallan/newfeechallan/NeweditFeeChallan/'.$id);
				}		
			}
		}
	}
	
	function NewviewFeeChallan($feestructureid, $csem, $feenationality)
    {
		$allottype = $this->feechallan_model->getfeestructtype($feestructureid);
		
		$allottypeinfo = $allottype->structure_type;
		
		if($allottypeinfo == 'Allotment'){
			$type = 'HOSTEL FEE';
		}
		elseif($allottypeinfo == 'ReAllotment')
		{
			$type = 'HOSTEL RENEWAL FEE';
		}
		
		$data['FeeInfo'] = $this->feechallan_model->NewviewFeeChallan($type, $feestructureid, $csem, $feenationality);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Challan Details';
		
		$this->loadViews("feechallan/newfee/NewviewFeeChallan", $this->global, $data, NULL);
    }
	 
	function allfeechallan()
    {
		$gender = $this->gender;
		
		$csem = $this->feechallan_model->CurrentSemester($gender);
		
		$csem = $csem->semcode;
		
		$data['FeeInfo'] = $this->feechallan_model->allfeechallan($csem, $gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel All Fee Challan Details';
		
		$this->loadViews("feechallan/newfee/allfeechallan", $this->global, $data, NULL);
        
    }
	 
	function allAllotmentfeechallan()
    {
		$gender = $this->gender;
		
		$csem = $this->feechallan_model->CurrentSemester($gender);
		
		$csem = $csem->semcode;
		
		$data['FeeInfo'] = $this->feechallan_model->allAllotmentfeechallan($csem, $gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel All Fee Challan Details';
		
		$this->loadViews("feechallan/newfee/allfeechallan", $this->global, $data, NULL);
        
     }
	 
	function FeeChallanBySem()
    {
		$gender = $this->gender;
		
		$data['semInfo'] = $this->feechallan_model->SemesterDetail($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel All Fee Challan Details';
		
		$this->loadViews("feechallan/newfee/FeeChallanBySem", $this->global, $data, NULL);
        
    }
	 
	function allReAllotmentfeechallan()
    {
		$gender = $this->gender;
		
		$regno = $this->input->post('regno');
		
		$csem = $this->input->post('csem');

		//$csem = $this->feechallan_model->CurrentSemester($gender);
		
		$data['FeeInfo'] = $this->feechallan_model->allReAllotmentfeechallan($csem, $gender, $regno);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel All Fee Challan Details';
		
		$this->loadViews("feechallan/newfee/allfeechallan", $this->global, $data, NULL);
        
    }

/* ----------------------- Old Fee Module -------------------------------------------------------------------------*/	
	function viewFeeChallanByStud()
	{
		$userId = $this->vendorId; 

		$studregno = $this->session->userdata('studregno');
		
		$genders = $this->reallotment_model->GetstudInfoByRegNoId($studregno);
		
		if(empty($genders))
		  {
			 $genders = $this->reallotment_model->GetNewstudInfoByRegNoId($studregno); 
		  }
			
		$gender = $genders[0]->GENDER;
		
		if($gender == 'M')
		  {
			  $gender = 'Male';
		  }
		elseif($gender == 'F')
		{
			$gender = 'Female';
		}
		
		$semcode = $this->reallotment_model->GetReallotsemInfo($gender);
		
		$feestatus = $this->session->userdata('feestatus');
		
		if(empty($semcode) && $feestatus != 'NEW HOSTEL FEE')
		{
			redirect('reallotment/reAllotment/studentreallotapply');
		}
		
		$allotment = $this->reallotment_model->GetNewstudInfoByRegNoId($studregno);
		
		$protitle = $allotment[0]->PROTITTLE; $nationality = $allotment[0]->NATIONALITY;
		
		$reallotmentinfo = $this->report_model->CheckStudInfo($gender,$studregno);

		if($allotment)
		{
			$regno = $allotment[0]->REGNO;
			
			$seminfo = $this->report_model->GetActiveSem($gender);
			
			$semcode = $seminfo[0]->SEMCODE;
			
			$challaninfo = $this->feechallan_model->GetChallanInfoByRegno($gender,$regno, $semcode);

			//var_dump($challaninfo);



		}
		else
		{ 
			$userinfo = $this->feechallan_model->Getuserinfo($gender,$studregno);
			   
			if(empty($userinfo))
			{
				$userinfo = $this->feechallan_model->GetuserRenewalinfo($gender,$studregno);
				   
			}
			  
		   $regno = $userinfo[0]->REGNO;
		   
		   $seminfo = $this->report_model->GetActiveSem($gender);
		
		   $semcode = $seminfo[0]->SEMCODE; 


		   $challaninfo = $this->feechallan_model->GetChallanInfoByRegno($gender,$regno, $semcode);
		}
		
		if(!empty($challaninfo))
	   	{

	   		// echo $gender.','.$regno.','. $semcode;

			// exit();

	      	$feeID = $challaninfo[0]->ID; $feetype = $challaninfo[0]->FEETYPE;
		  
		  	if($feetype == 'HOSTEL FEE')
		    {
			    $userinfo = $this->feechallan_model->ViewNornalFeeChallanDetail($feeID, $gender);
		
			    $paychllanid = $userinfo[0]->ID; $regno = $userinfo[0]->REGNO; $duedate = $userinfo[0]->CHALLANDUEDATE; 
			  	if($gender == 'Male') 
			  	{
				  /* Take this code to student profile to update fine amount */
					$cdate = date('Y-m-d');
					if($cdate > $duedate)
					{
						$noofdays = (strtotime($cdate) - strtotime($duedate))/60/60/24;
						
						$fineamount = 100*$noofdays;
						$fineinfo = array('FINEAMOUNT'=>$fineamount,'CHALLANDUEDATE'=>$cdate);
						$this->feechallan_model->updatefine($feeID, $regno, $fineinfo);
					}
				}
				elseif($gender == 'Female') 
				{
					  
				  /* Take this code to student profile to update fine amount */
					$cdate = date('Y-m-d');
					if($cdate > $duedate)
					{
						$noofdays = (strtotime($cdate) - strtotime($duedate))/60/60/24;
						$fineamount = 100*$noofdays;
						$fineinfo = array('CHALLANDUEDATE'=>$cdate);
						//$fineinfo = array('FINEAMOUNT'=>$fineamount,'CHALLANDUEDATE'=>$cdate);
						$this->feechallan_model->updatefine($feeID, $regno, $fineinfo);
					}
				}
			      
					$courseInfo = $this->Signup_model->getCourseInfo($gender, $semcode);
								
					foreach($courseInfo as $info)
					{
						$coursestatus  = $info->STATUS;
						$coursestype  = $info->TYPE;
						$coursebap  = $info->BSPAK;
						$coursemap  = $info->MAPAK;
						$coursemsp  = $info->MSPAK;
						$coursephdp  = $info->PHDPAK;
						$coursebaf  = $info->BSFOREIGNER;
						$coursemaf  = $info->MAFOREIGNER;
						$coursemsf  = $info->MSFOREIGNER;
						$coursephdf  = $info->PHDFOREIGNER;
						$coursesemcode  = $info->SEMCODE;
					}

					if($coursestype == 'ReAllotment' && $coursestatus == 1)
					{
						if(($protitle == 'BS' || $protitle == 'LLB' || $protitle == 'BA' || $protitle == 'Bachelor') && ($nationality == 'Pakistani'))
						{	
							$studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);									
									
							$data['studTotalCredit'] = $studTotalCredit; 

							$data['TotalCredit'] = $coursebap;
									 
							if($studTotalCredit < $coursebap)
							{ 
								$course = $coursebap;

							    redirect('feechallan/Feechallan/CreditHourcheck/'.$course);
							}
										
						}
						elseif(($protitle == 'BS' || $protitle == 'LLB' || $protitle == 'BA' || $protitle == 'Bachelor') && ($nationality != 'Pakistani'))
						{
							 
							$studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
							
							$data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursebaf;
							 
							if($studTotalCredit < $coursebaf)
							{ 
								$course = $coursebaf;

								redirect('feechallan/Feechallan/CreditHourcheck/'.$course);
							}
								
						}
						elseif(($protitle == 'MA' || $protitle == 'MSC' || $protitle == 'MSc') && ($nationality == 'Pakistani'))
						{
							$studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
							
							$data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursemap;
							 
							if($studTotalCredit < $coursemap)
							{ 
								$course = $coursemap;

								redirect('feechallan/Feechallan/CreditHourcheck/'.$course);
							}
								
						} 
						elseif(($protitle == 'MA' || $protitle == 'MSC' || $protitle == 'MSc') && ($nationality != 'Pakistani'))
						{
							
							$studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
							
							$data['studTotalCredit'] = $studTotalCredit; 

							$data['TotalCredit'] = $coursemaf;
							 
							if($studTotalCredit < $coursemaf)
							{ 
								$course = $coursemaf;

								redirect('feechallan/Feechallan/CreditHourcheck/'.$course);
							}
								
						}    
						elseif(($protitle == 'MS' || $protitle == 'LLM' || $protitle == 'MS/MPHILL') && ($nationality == 'Pakistani'))
						{
							$studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
							
							$data['studTotalCredit'] = $studTotalCredit; 

							$data['TotalCredit'] = $coursemsp;
							 
							if($studTotalCredit < $coursemsp)
							{ 
								$course = $coursemsp;

								redirect('feechallan/Feechallan/CreditHourcheck/'.$course);
							}
								
						} 
						elseif(($protitle == 'MS' || $protitle == 'LLM' || $protitle == 'MS/MPHILL') && ($nationality != 'Pakistani'))
						{
							$studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
							
							$data['studTotalCredit'] = $studTotalCredit; 

							$data['TotalCredit'] = $coursemsf;
							 
							if($studTotalCredit < $coursemsf)
							{ 
								$course = $coursemsf;

								redirect('feechallan/Feechallan/CreditHourcheck/'.$course);
							}
								
						}
						elseif(($protitle == 'PHD') && ($nationality == 'Pakistani'))
						{
							$studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
							
							$data['studTotalCredit'] = $studTotalCredit; 

							$data['TotalCredit'] = $coursephdp;
							 
							if($studTotalCredit < $coursephdp)
							{ 
								$course = $coursephdp;

								redirect('feechallan/Feechallan/CreditHourcheck/'.$course);
							}
								
						} 
						elseif(($protitle == 'PHD') && ($nationality != 'Pakistani'))
						{
							$studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
							
							$data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursephdp;
							 
							if($studTotalCredit < $coursephdp)
							{ 
								$course = $coursephdp;
								redirect('feechallan/Feechallan/CreditHourcheck/'.$course);
							}
								
						}						  
					}								
					
					
					$extExist = $this->feechallan_model->ViewNornalFeeChallanDesc($regno, $paychllanid, $gender);
					
					$ExistExtR = $this->feechallan_model->ViewExtFeeChallan($regno, $paychllanid, $gender);
		
					if($ExistExtR == TRUE) 
					{	
						
						$data['viefeeChallandesc'] = $this->feechallan_model->ViewNornalFeeChallanDesc($regno, $paychllanid, $gender);
							
						$data['viewfeeInfo'] = $this->feechallan_model->ViewNornalFeeChallanDetail($feeID, $gender);
								
						$data['BankInfo'] = $this->feechallan_model->ViewBankInfo($gender);
								
						$this->load->view("feechallan/viewHNExtfeechallan", $data);
					}
					else
					{   
								
						$data['viefeeChallandesc'] = $this->feechallan_model->ViewNornalFeeChallanDesc($regno, $paychllanid, $gender);
							
						$data['viewfeeInfo'] = $this->feechallan_model->ViewNornalFeeChallanDetail($feeID, $gender);
								
						$data['BankInfo'] = $this->feechallan_model->ViewBankInfo($gender);
							
							$this->load->view("feechallan/viewHNfeechallan", $data);
						}
				}
				else
				{
					$userinfo = $this->feechallan_model->ViewSecurityFeeChallanDetail($feeID, $gender);
		
						$paychllanid = $userinfo[0]->ID; $regno = $userinfo[0]->REGNO; $duedate = $userinfo[0]->CHALLANDUEDATE;
						
						/* Take this code to student profile to update fine amount */
						
						/*$cdate = date('Y-m-d');
						if($cdate > $duedate)
						 {
							$noofdays = (strtotime($cdate) - strtotime($duedate))/60/60/24;
							$fineamount = 100*$noofdays;
							$fineinfo = array('FINEAMOUNT'=>$fineamount);
							$this->feechallan_model->updatefine($feeID, $regno, $fineinfo);
						 }*/
						
						/* Take this code to student profile to update fine amount */
						 
						    $data['viefeeChallandesc'] = $this->feechallan_model->ViewNornalFeeChallanDesc($regno, $paychllanid, $gender);
		
							$data['viewfeeInfo'] = $this->feechallan_model->ViewSecurityFeeChallanDetail($feeID, $gender);
							
							$data['BankInfo'] = $this->feechallan_model->ViewBankInfo($gender);
							
							$data['BanksecInfo'] = $this->feechallan_model->ViewBankSecInfo($gender);
							
							$data['secInfo'] = $this->feechallan_model->ViewSecFeeChallanDesc($regno, $gender);
							
							$data['secfineInfo'] = $this->feechallan_model->ViewSecFine($regno, $gender);
									
							$this->load->view("feechallan/viewHNewfeechallan", $data);
						
					}
		   }
		   else
		   {
			   					
				$challaninfo = $this->feechallan_model->GetChallanstatusByRegno($gender,$regno, $semcode);
				
				if($challaninfo)
				{
				   $challaninfo = 'Fee Challan is genrated but not published due to document verification. Verify your document to Provost office to Publish Challan..';
				}
				
				redirect('feechallan/Feechallan/challanNotFound/'.$challaninfo);
		   }
	 }
	
	function viewFeeDetailByStudent()
    {
      	$userId = $this->vendorId;
			
		$gender = $this->gender;
		
		$semcode = $this->reallotment_model->GetReallotsemInfo($gender);
		
		if(empty($semcode))
		  {
			  echo '<i style="color:red;font-size:20px;font-family:calibri ;">Sorry! Hostel Re-Allotment Process not yet open!. Please Contact Provost Hostel Office. </i><br><br> You will be redirect to previous page shortly !';
							
							
							header( "refresh:4;url=http://usis.iiu.edu.pk:64453/dashboard" );
							 
							//exit to prevent the rest of the script from executing
							exit;
		  }
		
		$semcode = $semcode[0]->SEMCODE;
		
/*		
	-----------------------------------------------Check for Eligibility ---------------------------------------
	if(empty($semcode))
		{
						
			echo '<i style="color:red;font-size:20px;font-family:calibri ;">Hostel Re-Allotment Registration not yet open or close for this semester for more info contact Hostel Admin.</i><br><br> You will be redirect to previous page shortly !';
			
			
			header( "refresh:4;url=http://usis.iiu.edu.pk:64453/dashboard" );
			 
			//exit to prevent the rest of the script from executing
			exit;
		}
		else
		{
			$studInfo = $this->reallotment_model->GetstudInfoByUId($gender,$userId);
			$programe = $studInfo[0]->PROTITTLE;
			$studReallotInfo = $this->reallotment_model->GetstudReallotInfoByUId($gender,$semcode,$programe);
			$Reallotprog = $studReallotInfo[0]->PROTITTLE;
			$ReallotSemcode = $studReallotInfo[0]->SEMCODE;
			$lastreallotsemcode = substr($studReallotInfo[0]->SEMCODE,-2);
			$laststudreg = substr($studInfo[0]->REGNO,-2);
			$regno = $studInfo[0]->REGNO;
			$studsem = substr($regno,-3);
			if ($programe == 'MS' || $programe == 'MSC' || $programe == 'MA' || $programe == 'LLM')
			{
					if($ReallotSemcode == $studsem || $laststudreg < $lastreallotsemcode)
						{
										
							echo '<i style="color:red;font-size:20px;font-family:calibri ;">Sorry! You are not Eligiable for Hostel Re-Allotment Registration in this semester for more info contact Hostel Admin.</i><br><br> You will be redirect to previous page shortly !';
							
							
							header( "refresh:4;url=http://usis.iiu.edu.pk:64453/dashboard" );
							 
							//exit to prevent the rest of the script from executing
							exit;
						}
			}
			elseif ($programe == 'BS' || $programe == 'LLB')
			{
					if($ReallotSemcode == $studsem || $laststudreg < $lastreallotsemcode)
						{
										
							echo '<i style="color:red;font-size:20px;font-family:calibri ;">Sorry! You are not Eligiable for Hostel Re-Allotment Registration in this semester for more info contact Hostel Admin.</i><br><br> You will be redirect to previous page shortly !';
							
							
							header( "refresh:4;url=http://usis.iiu.edu.pk:64453/dashboard" );
							 
							//exit to prevent the rest of the script from executing
							exit;
						}
			}
			elseif ($programe == 'PHD')
			{
					if($ReallotSemcode == $studsem || $laststudreg < $lastreallotsemcode)
						{
										
							echo '<i style="color:red;font-size:20px;font-family:calibri ;">Sorry! You are not Eligiable for Hostel Re-Allotment Registration in this semester for more info contact Hostel Admin.</i><br><br> You will be redirect to previous page shortly !';
							
							
							header( "refresh:4;url=http://usis.iiu.edu.pk:64453/dashboard" );
							 
							//exit to prevent the rest of the script from executing
							exit;
						}
			}
		}
		*/
		
		$data['viewStudInfo'] = $this->feechallan_model->StudentInfo($gender,$userId);
		
		$data['viewSemInfo'] = $this->feechallan_model->ActiveSemesterDetail($gender);
		
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/viewfeestudent", $this->global, $data, $data);
        
    }
	
	 function viewFeeDetailbyId()
      {
         $regno = $this->input->post('regno');
		 
		 $semester = $this->input->post('semester');
		
		 if( $semester == NULL)
			{
				echo '<i style="color:red;font-size:20px;font-family:calibri ;">Re-Allotment is Closed Now or not yet Open. For more info contact Hostel Admin.</i><br><br> You will be redirect to previous page shortly !';
			
			
			header( "refresh:5;url=http://usis.iiu.edu.pk:64453/dashboard" );
			exit();	
			
			}
		 
		 $sem = substr($semester,0,1);
		 
		 if($sem == 'S')
		 {
			$semester = 'SPR-'.substr($semester,-4);
		 }
		 
		 $data['viewfeeInfo'] = $this->feechallan_model->HostelFeeDetailId($regno,$semester);
				
		 $this->global['pageTitle'] = 'IIUI Hostels : Hostel Fee Challan';
				
		 $this->load->view("feechallan/viewfeechallan", $data);
	
       }
	 function viewFeeDetailbyHostelWise()
      {
        // $regno = $this->input->post('regno');
		 
		$semester = $this->input->post('semester');
		 
		$data['viewfee'] = $this->feechallan_model->HostelFeeDetailByHR($semester);
		
		$this->global['pageTitle'] = 'IIUI Hostels : Hostel Fee Challan';
				
		$this->load->view("feechallan/viewfeechallanHostelWise", $data);
	
       }
	


    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
			$reg = $this->uri->segment('4');
			
			$regno = json_decode( base64_decode($reg));
			
			$visitno = $this->visitor_model->GetVisitNo($regno);
			//print_r($visitno);
			//exit();
			$data['visitno'] = $visitno;
			
			$result = $this->visitor_model->VerifyUserRecordById($regno);
			
		   if($result == NULL)
		    
			 { 
			 	$result = $this->visitor_model->VerifyUserRecordByguestId($regno); 
			 }
			
			$data['studentdetail'] = $result;
			
            $this->global['pageTitle'] = 'IIUI Hostels : Add New Visitors';

            $this->loadViews("visitor/addNewvisitor", $this->global, $data, NULL);
    }
	
	function GetseatInfoById()
    {
        	$seatavilabel = $this->input->post('seatavilabel');
			
			$result = $this->allotment_model->getAllSeatInfoById($seatavilabel);
		 
		    echo json_encode($result);   
    }
	
	function VerifyUserRecord()
    {
        	$regno = $this->input->post('regno');
	
			$result = $this->visitor_model->VerifyUserRecordById($regno);
			
		   if($result == NULL)
		    
			 { $result = $this->visitor_model->VerifyUserRecordByguestId($regno); }
		    
			echo json_encode($result);   
    }
	
	function GetroomitemByRegno()
    {
        	$regno = $this->input->post('regno');
	
			$result = $this->clearance_model->GetroomitemByRegno($regno);
		    
			echo json_encode($result);   
    }
    
    /**
     * This function is used to add new user to the system
     */
    function printCard()
    {
                $regno = $this->input->post('regno');
					
				$addnewCardInfo = array('PRINT_NO'=>1);
             
				$data['fname'] = $this->card_model->getfnameoradb($regno);
				
				$data['viewcardsInfo'] = $this->card_model->HostelCardsDetailId($regno);
						
				$this->load->view("card/viewcard", $data);
		        
        }
		
	function printCardHostelWise()
    {
                $hostelno = $this->input->post('hostelno');
				
				$roomno = $this->input->post('roomno');
					
				$addnewCardInfo = array('PRINT_NO'=>1);
				
				//$regno = $this->card_model->CardsDetailIdByHostelRoom($hostelno,$roomno);
				
				//$regno = $regno->REGNO;
            
				//$data['fname'] = $this->card_model->getfnameoradb($regno);
				
				$data['viewcardsInfo'] = $this->card_model->CardsDetailIdByHostelRoom($hostelno,$roomno);
						
				$this->load->view("card/viewcardhostelwise", $data);
		        
        }
    

    
    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($CardID = NULL)
    {
        
            if($CardID == null)
            {
                redirect('card/Cards/view');
            }
			
            $data['viewcardsInfo'] = $this->card_model->HostelCardsDetailById($CardID);
            
            $this->global['pageTitle'] = 'IIUI Hostels : View Visitors Deatail';
            
            $this->loadViews("card/editOld", $this->global, $data, NULL);
        
    }
	
	/**
     * This function is used to edit the Allotment information
     */
	 function addNewFeeStructure()
    {      
            
						
			$this->form_validation->set_rules('nationality','Nationality','required|max_length[128]');
			$this->form_validation->set_rules('programelevel','programelevel','required|max_length[128]');
			$this->form_validation->set_rules('feestructure','Fee Structure','required|max_length[128]');
			$this->form_validation->set_rules('feetype','Fee Type','required|max_length[128]');
			$this->form_validation->set_rules('feeamount','Fee Amount','required|max_length[128]');
            
            
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('error', 'Fee Structure Insertion failed');
				
				//redirect('visitor/Visitor/editOld/'.$visitid);
				redirect('feechallan/feechallan/NewFeestructure');
            }
            else
            {
                $nationality = $this->input->post('nationality');
				$programelevel = $this->input->post('programelevel');
				//$batchname = $this->input->post('batchname');
				$feestructure = $this->input->post('feestructure');
				$feecode = $this->input->post('feetype');
				$feetype = 'NEW HOSTEL FEE';
				$feeamount = $this->input->post('feeamount');
				
				$gender = $this->gender;
				
				$ExistFeestr = $this->feechallan_model->CheckFeeChallanExist($nationality,$programelevel, $batchname,$feestructure,$feetype, $feecode, $feeamount, $gender);
				if(!empty($ExistFeestr))
				   {
					   $this->session->set_flashdata('error', 'Fee Structure already Existed');
					
                	redirect('feechallan/feechallan/NewFeestructure');
				   }
				   
				
            foreach ($_POST['batchname'] as $batchnames)
					{
             $reallotFeeInfo = array('NATIONALITY'=>$nationality,'PROTITTLE'=>$programelevel,'BATCHNAME'=>$batchnames,'FEESTRUCSEM'=>$feestructure, 'FEECODE'=>$feecode, 'FEEAMOUNT'=>$feeamount, 'FEETYPE'=>'NEW HOSTEL FEE', 'GENDER'=>$gender,'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d'));
                if(!empty($batchnames))
				       {
                         $result = $this->feechallan_model->InsertFee($reallotFeeInfo);
				      }
					}
					$this->session->set_flashdata('success', 'Fee Structure Insertion Succesfully');
					
                	redirect('feechallan/feechallan/NewFeestructure');
				
            }
        }
	
	/**
     * This function is used to edit the Allotment information
     */
	 function addSecurityStructure()
    {       
            
						
			$this->form_validation->set_rules('nationality','Nationality','required|max_length[128]');
			$this->form_validation->set_rules('programelevel','programelevel','required|max_length[128]');
			$this->form_validation->set_rules('feestructure','Fee Structure','required|max_length[128]');
			$this->form_validation->set_rules('feetype','Fee Type','required|max_length[128]');
			$this->form_validation->set_rules('feeamount','Fee Amount','required|max_length[128]');
            
            
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('error', 'Fee Structure Insertion failed');
				
				//redirect('visitor/Visitor/editOld/'.$visitid);
				redirect('feechallan/feechallan/Feesecurity');
            }
            else
            {
                $nationality = $this->input->post('nationality');
				$programelevel = $this->input->post('programelevel');
				//$batchname = $this->input->post('batchname');
				$feestructure = $this->input->post('feestructure');
				$feecode = $this->input->post('feetype');
				$feetype = 'HOSTEL SECURITY';
				$feeamount = $this->input->post('feeamount');
				
				$gender = $this->gender;
				
				$ExistFeestr = $this->feechallan_model->CheckFeeChallanExist($nationality, $programelevel, $batchname,$feestructure,$feetype, $feecode, $feeamount, $gender);
				if(!empty($ExistFeestr))
				   {
					   $this->session->set_flashdata('error', 'Fee Structure already Existed');
					
                	redirect('feechallan/feechallan/Feesecurity');
				   }
				   
				
            foreach ($_POST['batchname'] as $batchnames)
					{
             $reallotFeeInfo = array('NATIONALITY'=>$nationality,'PROTITTLE'=>$programelevel,'BATCHNAME'=>$batchnames,'FEESTRUCSEM'=>$feestructure, 'FEECODE'=>$feecode, 'FEEAMOUNT'=>$feeamount, 'FEETYPE'=>'HOSTEL SECURITY', 'GENDER'=>$gender,'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d'));
                if(!empty($batchnames))
				       {
                         $result = $this->feechallan_model->InsertFee($reallotFeeInfo);
				      }
					}
					$this->session->set_flashdata('success', 'Fee Structure Insertion Succesfully');
					
                	redirect('feechallan/feechallan/Feesecurity');
				
            }
        }
	
	/**
     * This function is used to edit the Allotment information
     */
	 function addReAllotmentStructure()
    {       
            
						
			$this->form_validation->set_rules('nationality','Nationality','required|max_length[128]');
			$this->form_validation->set_rules('programelevel','programelevel','required|max_length[128]');
			$this->form_validation->set_rules('feestructure','Fee Structure','required|max_length[128]');
			$this->form_validation->set_rules('feetype','Fee Type','required|max_length[128]');
			$this->form_validation->set_rules('feeamount','Fee Amount','required|max_length[128]');
            
            
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('error', 'Fee Structure Insertion failed');
				
				//redirect('visitor/Visitor/editOld/'.$visitid);
				redirect('feechallan/feechallan/Feestucture');
            }
            else
            {
                $nationality = $this->input->post('nationality');
				$programelevel = $this->input->post('programelevel');
				$batchname = $this->input->post('batchname');
				$feestructure = $this->input->post('feestructure');
				$feecode = $this->input->post('feetype');
				$feetype = 'HOSTEL FEE';
				$feeamount = $this->input->post('feeamount');
				
				$gender = $this->gender;;
				
				/*$ExistFeestr = $this->feechallan_model->CheckFeeChallanExist($nationality,$programelevel, $batchname,$feestructure,$feetype, $feecode, $feeamount, $gender);
				
				if(!empty($ExistFeestr))
				   {
					   $this->session->set_flashdata('error', 'Fee Structure already Existed');
					
                	redirect('feechallan/feechallan/Feestucture');
				   }*/
				   
            foreach ($_POST['batchname'] as $key=>$batchnames)
				{  
				    if($programelevel == 'PHD')
					   {		
					      if ((strpos($batchnames, 'Tafseer') !== false) ) 
					        {	
					           $val = true;
							   if($val == true)
							   {
									$string = array($batchnames);
									//$substr = 'Tafseer ';
									//$attachment = "&";
									$substr2 = "Qur";
									$attachment2 = "'";
									//$substr3 = "Ph";
									//$attachment3 = ".";
								
									//$newstring = str_replace($substr, $substr.$attachment, $string);
									
									$new2string = str_replace($substr2, $substr2.$attachment2, $string);
									
									//$batchnames = str_replace($substr3, $substr3.$attachment3, $new2string);
									$batchnames = implode($new2string); 
						       }
							   
					        }
					   }
						//echo $batchnames;
						$ExistFeestr = $this->feechallan_model->CheckFeeChallanExist($nationality,$programelevel, $batchnames,$feestructure,$feetype, $feecode, $feeamount, $gender);
						 //print_r($ExistFeestr);
							if(empty($ExistFeestr))
							  {
				 $reallotFeeInfo = array('NATIONALITY'=>$nationality,'PROTITTLE'=>$programelevel,'BATCHNAME'=>trim($batchnames),'FEESTRUCSEM'=>$feestructure, 'FEECODE'=>$feecode, 'FEEAMOUNT'=>$feeamount, 'FEETYPE'=>'HOSTEL FEE', 'GENDER'=>$gender,'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d'));
					//var_dump($reallotFeeInfo);
					if(!empty($batchnames))
								   {
									 $result = $this->feechallan_model->InsertFee($reallotFeeInfo);
								  }
							  }
						
					}
					//exit();
					$this->session->set_flashdata('success', 'Fee Structure Insertion Succesfully');
					
                	redirect('feechallan/feechallan/Feestucture');
				
            }
        }
		
		function updateNewFeeStructure()
    {
            $feeid = $this->input->post('feeid');
            
						
			$this->form_validation->set_rules('nationality','Nationality','required|max_length[128]');
			$this->form_validation->set_rules('programelevel','programelevel','required|max_length[128]');
			$this->form_validation->set_rules('feestructure','Fee Structure','required|max_length[128]');
			$this->form_validation->set_rules('feetype','Fee Type','required|max_length[128]');
			$this->form_validation->set_rules('feeamount','Fee Amount','required|max_length[128]');
            
            
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('error', 'Fee Structure Updation failed');
				
				//redirect('visitor/Visitor/editOld/'.$visitid);
				redirect('feechallan/feechallan/EditNewFeeStructure/'.$feeid);
            }
            else
            {
                $nationality = $this->input->post('nationality');
				$programelevel = $this->input->post('programelevel');
				$batchname = $this->input->post('batchname');
				$feestructure = $this->input->post('feestructure');
				$feetype = $this->input->post('feetype');
				$feeamount = $this->input->post('feeamount');
				$feeid = $this->input->post('feeid');
				
				$gender = $this->gender;
				
            
             $HSecFeeStruc = array('NATIONALITY'=>$nationality,'PROTITTLE'=>$programelevel,'BATCHNAME'=>$batchname,'FEESTRUCSEM'=>$feestructure, 'FEECODE'=>$feetype, 'FEEAMOUNT'=>$feeamount, 'FEETYPE'=>'NEW HOSTEL FEE', 'GENDER'=>$gender,'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d'));
                if(!empty($batchname))
				       {
                         $result = $this->feechallan_model->UpdateNewFeeStructure($HSecFeeStruc, $feeid);
				      }
					
					$this->session->set_flashdata('success', 'Fee Structure Updation Succesfully');
					
                	redirect('feechallan/Feechallan/EditNornalSecurityFeeStructure/'.$feeid);
				
            }
      }
		
		function updateSecFeeStructure()
    {
       
            
						
			$this->form_validation->set_rules('nationality','Nationality','required|max_length[128]');
			$this->form_validation->set_rules('programelevel','programelevel','required|max_length[128]');
			$this->form_validation->set_rules('feestructure','Fee Structure','required|max_length[128]');
			$this->form_validation->set_rules('feetype','Fee Type','required|max_length[128]');
			$this->form_validation->set_rules('feeamount','Fee Amount','required|max_length[128]');
            
            
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('error', 'Fee Structure Updation failed');
				
				//redirect('visitor/Visitor/editOld/'.$visitid);
				redirect('feechallan/feechallan/viewhostelfeesecurity');
            }
            else
            {
                $nationality = $this->input->post('nationality');
				$programelevel = $this->input->post('programelevel');
				$batchname = $this->input->post('batchname');
				$feestructure = $this->input->post('feestructure');
				$feetype = $this->input->post('feetype');
				$feeamount = $this->input->post('feeamount');
				$feeid = $this->input->post('feeid');
				
				$gender = $this->gender;
				
            
             $HSecFeeStruc = array('NATIONALITY'=>$nationality,'PROTITTLE'=>$programelevel,'BATCHNAME'=>$batchname,'FEESTRUCSEM'=>$feestructure, 'FEECODE'=>$feetype, 'FEEAMOUNT'=>$feeamount, 'FEETYPE'=>'HOSTEL SECURITY', 'GENDER'=>$gender,'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d'));
                if(!empty($batchname))
				       {
                         $result = $this->feechallan_model->UpdateSecurityFeeStructure($HSecFeeStruc, $feeid);
				      }
					
					$this->session->set_flashdata('success', 'Fee Structure Updation Succesfully');
					
                	redirect('feechallan/Feechallan/EditNornalSecurityFeeStructure/'.$feeid);
				
            }
      }
		
	function updateNorFeeStructure()
    {
       
            
						
			$this->form_validation->set_rules('nationality','Nationality','required|max_length[128]');
			$this->form_validation->set_rules('programelevel','programelevel','required|max_length[128]');
			$this->form_validation->set_rules('feestructure','Fee Structure','required|max_length[128]');
			$this->form_validation->set_rules('feetype','Fee Type','required|max_length[128]');
			$this->form_validation->set_rules('feeamount','Fee Amount','required|max_length[128]');
            
            
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('error', 'Fee Structure Updation failed');
				
				//redirect('visitor/Visitor/editOld/'.$visitid);
				redirect('feechallan/feechallan/viewhostelduesfeestructure');
            }
            else
            {
                $nationality = $this->input->post('nationality');
				$programelevel = $this->input->post('programelevel');
				$batchname = $this->input->post('batchname');
				$feestructure = $this->input->post('feestructure');
				$feetype = $this->input->post('feetype');
				$feeamount = $this->input->post('feeamount');
				$feeid = $this->input->post('feeid');
				
				$gender = $this->gender;
				
            
             $HNorFeeStruc = array('NATIONALITY'=>$nationality,'PROTITTLE'=>$programelevel,'BATCHNAME'=>$batchname,'FEESTRUCSEM'=>$feestructure, 'FEECODE'=>$feetype, 'FEEAMOUNT'=>$feeamount, 'FEETYPE'=>'HOSTEL FEE', 'GENDER'=>$gender,'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d'));
                if(!empty($batchname))
				       {
                         $result = $this->feechallan_model->UpdateNorFeeStructure($HNorFeeStruc, $feeid);
				      }
					
					$this->session->set_flashdata('success', 'Fee Structure Updation Succesfully');
					
                	redirect('feechallan/Feechallan/EditNornalFeeStructure/'.$feeid);
				
            }
      }
      
	  	function updateNorFeeChallan()
    {
       
            
						
			$this->form_validation->set_rules('regno','REGNO','required|max_length[128]');
			$this->form_validation->set_rules('usercharges','User Charges','required|max_length[128]');
			$this->form_validation->set_rules('challanno','Challan No','required|max_length[128]');
			$this->form_validation->set_rules('status','Status','required|max_length[128]');
			$this->form_validation->set_rules('fineamount','Fine Amount','required|max_length[128]');
			$this->form_validation->set_rules('feeid','FeeId','required|max_length[128]');
            
            $challanid = $this->input->post('feeid');
			
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('error', 'Fee Structure Updation failed');
				
				redirect('feechallan/Feechallan/EditNornalFeeChallan/'.$challanid);
            }
            else
            {
                $status = $this->input->post('status');
				
				$covidsummer = $this->input->post('covidsummer');
				
				$covidspr = $this->input->post('covidspr');
				
				$gender = $this->gender;
				
				$extfee = $this->input->post('extfee');
				
				$challanno = $this->input->post('challanno');
				
				$feeID = $this->input->post('feeid');
				
				$csem = $this->input->post('csem');
				
				$regno = $this->input->post('regno');
				
				$strucsem = $this->input->post('strucsem');
				
				$nationality = $this->input->post('nationality');
				
				$usercharges = $this->input->post('usercharges');
				
				$HNorUFeeInfo = array('FEEAMOUNT'=>$usercharges);
				
				$HNorFeeNation = array('NATIONALITY'=>$nationality);
				
				$fineamount = $this->input->post('fineamount');
				 
				$this->feechallan_model->UpdateUserFee($HNorUFeeInfo, $feeID, $csem, $regno, $challanno, $gender);
				
				$this->feechallan_model->UpdateFeeNation($HNorFeeNation, $feeID);
				
				$updateHNoFee = $this->feechallan_model->countfee($challanno, $csem);
				
				if($updateHNoFee->csum == 1){
					$HNorUFeeInfo = array('PAYCHALLANID'=>$feeID, 'FEEAMOUNT'=>$usercharges, 'CURRENTSEMESTER'=>$csem, 'REGNO'=>$regno, 'CHALLANNO'=>$challanno, 'GENDER'=>$gender, 'FEESTRUCSEM'=>$strucsem, 'FEECODE'=>17, 'FEEDESC'=>'Hostel User Charges', 'FEETYPE'=>'HOSTEL FEE', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d'));
					$updateHNoFee = $this->feechallan_model->InsertHUserFee($HNorUFeeInfo);
				}
				
				if(!empty($covidspr)){
					$HNorUFeeInfo = array('FEEAMOUNT'=>$covidspr);
				$this->feechallan_model->UpdateCovidSprFee($HNorUFeeInfo, $feeID, $csem, $regno, $challanno, $gender);
				}
				if(!empty($covidsummer)){
					$HNorUFeeInfo = array('FEEAMOUNT'=>$covidsummer);
				$this->feechallan_model->UpdateCovidSummerFee($HNorUFeeInfo, $feeID, $csem, $regno, $challanno, $gender);
				}
				
				if($extfee > 0)
				  {
					  $regno = $this->input->post('regno');
					  $feecode = 102;
					  $feedesc = 'Hostel Extension Fee';
					  $feeamount = $this->input->post('extfee');
					  $feetype = 'Hostel Extension Fee';
					  $strucsem = $this->input->post('strucsem');
					  $challanno = $this->input->post('challanno');
					  $csem = $this->input->post('csem');
					  $gender = $this->input->post('gender');
					  $feeID = $this->input->post('feeid');
					  
					  
					  $checkExt = $this->feechallan_model->EditNornalFeeChallandetail($feeID, $challanno, $gender);
					  
					  $HNorFeeExtInfo = array('REGNO'=>$regno,'FEECODE'=>$feecode, 'FEEDESC'=>$feedesc,'FEEAMOUNT'=>$feeamount, 'FEETYPE'=>$feetype, 'FEESTRUCSEM'=>$strucsem,'CHALLANNO'=>$challanno, 'CURRENTSEMESTER'=>$csem, 'GENDER'=>$gender, 'PAYCHALLANID'=>$feeID, 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d'));
					  
					  if(empty($checkExt))
					    {
							$this->feechallan_model->InsertFeedesc($HNorFeeExtInfo);
						}
					  else{
						    $feedid = $checkExt[0]->ID;
						    $this->feechallan_model->UpdateFeedesc($HNorFeeExtInfo, $feedid);
						  
					  }
					  
					 
				  }
				elseif($extfee == 0)
				  {
					  $checkExt = $this->feechallan_model->EditNornalFeeChallandetail($feeID, $challanno, $gender);
					  
					   if(!empty($checkExt))
					    {
							$feeids = $checkExt[0]->ID;
							$this->feechallan_model->deleteFeedesc($feeids);
						}
				  }
            
                $HNorFeeInfo = array('STATUS'=>$status,'FINEAMOUNT'=>$fineamount, 'updated_at'=>date('Y-m-d'));
               
                    $result = $this->feechallan_model->UpdateNorFeeChallan($HNorFeeInfo, $challanid);
				      
					
					$this->session->set_flashdata('success', 'Hostel Fee Challan Updation Succesfully');
					
                	redirect('feechallan/Feechallan/EditNornalFeeChallan/'.$challanid);
				
            }
        }
		
		function updateSecurityFeeChallan()
    {
       
            
						
			$this->form_validation->set_rules('regno','REGNO','required|max_length[128]');
			//$this->form_validation->set_rules('totalamount','Total Amount','required|max_length[128]');
			//$this->form_validation->set_rules('challanno','Challan No','required|max_length[128]');
			$this->form_validation->set_rules('status','Status','required|max_length[128]');
			$this->form_validation->set_rules('fineamount','Fine Amount','required|max_length[128]');
			$this->form_validation->set_rules('feeid','FeeId','required|max_length[128]');
            
            $challanid = $this->input->post('feeid');
			
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('error', 'Fee Structure Updation failed');
				
				redirect('feechallan/Feechallan/EditSecurityFeeChallan/'.$challanid);
            }
            else
            {
                $status = $this->input->post('status');
				
				$fineamount = $this->input->post('fineamount');
				
				$secamount = $this->input->post('secamount');
				
				$regno = $this->input->post('regno');
				
				$gender = $this->gender;
				
            
                //$HNorFeeInfo = array('STATUS'=>$status,'FINEAMOUNT'=>$fineamount, 'updated_at'=>date('Y-m-d'));
               
                    //$result = $this->feechallan_model->UpdateNorFeeChallan($HNorFeeInfo, $challanid);
					
					$SecFeeInfo = array('FEEAMOUNT'=>$secamount, 'updated_at'=>date('Y-m-d'));
					
					$secuid = $this->feechallan_model->getsecurity($regno, $gender);
					
					$secid = $secuid[0]->ID;
              
                    $result = $this->feechallan_model->UpdateSecurityFeeChallan($SecFeeInfo, $secid);
					
					$this->session->set_flashdata('success', 'Hostel Fee Challan Updation Succesfully');
					
                	redirect('feechallan/Feechallan/EditSecurityFeeChallan/'.$challanid);
				
            }
        }
		
	 function updateNewFeeChallan()
    {
       
            
						
			$this->form_validation->set_rules('regno','REGNO','required|max_length[128]');
			$this->form_validation->set_rules('totalamount','Total Amount','required|max_length[128]');
			$this->form_validation->set_rules('challanno','Challan No','required|max_length[128]');
			$this->form_validation->set_rules('status','Status','required|max_length[128]');
			$this->form_validation->set_rules('fineamount','Fine Amount','required|max_length[128]');
			$this->form_validation->set_rules('feeid','FeeId','required|max_length[128]');
            
            $challanid = $this->input->post('feeid');
			
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('error', 'Fee Structure Updation failed');
				
				redirect('feechallan/Feechallan/EditSecurityFeeChallan/'.$challanid);
            }
            else
            {
                $status = $this->input->post('status');
				
				$fineamount = $this->input->post('fineamount');
				
				$totalamount = $this->input->post('totalamount');
				
				$gender = $this->gender;
				
            
                $HNorFeeInfo = array('STATUS'=>$status,'FINEAMOUNT'=>$fineamount, 'updated_at'=>date('Y-m-d'));
				
				$updatedfee = array('FEEAMOUNT'=>$totalamount);
               
                    $result = $this->feechallan_model->UpdateNorFeeChallan($HNorFeeInfo, $challanid);
					
					$this->feechallan_model->UpdatePayFeeChallan($updatedfee, $challanid);
				      
					
					$this->session->set_flashdata('success', 'Hostel Fee Challan Updation Succesfully');
					
                	redirect('feechallan/Feechallan/EditNewFeeChallan/'.$challanid);
				
            }
        }
	  
     /**
     * This function is used to edit the Allotment information
     */
	 function EditVisitors()
    {
       
            
			
            $visitid = $this->input->post('visitid');
			
			$this->form_validation->set_rules('visitname','Visitor Name','required|max_length[128]');
			$this->form_validation->set_rules('relation','Relation','required|max_length[128]');
            $this->form_validation->set_rules('regno','Registration No','required|max_length[128]');
			$this->form_validation->set_rules('studentname','Student name','required|max_length[128]');
			$this->form_validation->set_rules('cnic','Visitors CNIC','required|max_length[128]');
			$this->form_validation->set_rules('address','Visitor Address','required|max_length[128]');
            
            
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('error', 'Visitors Updation failed');
				
				redirect('visitor/Visitor/editOld/'.$visitid);
            }
            else
            {
                $visitid = $this->input->post('visitid');
				$regno = $this->input->post('regno');
				$studentname = $this->input->post('studentname');
				$gender = $this->input->post('gender');
				$roomname = $this->input->post('roomname');
				$hostelno = $this->input->post('hostelno');
				$hostelname = $this->input->post('hostelname');
				$roomno = $this->input->post('roomno');
				$seatno = $this->input->post('seatno');
				$vno = $this->input->post('vno');
				$vdate = $this->input->post('vdate');
				$visitname = $this->input->post('visitname');
				$relation = $this->input->post('relation');
				$cnic = $this->input->post('cnic');
			    $address = $this->input->post('address');
				$remark = $this->input->post('remark');
                
                
             $visitorInfo = array('REGNO'=>$regno,'STUDENTNAME'=>$studentname,'HOSTELID'=>$hostelno,'SEATID'=>$seatno, 'ROOMID'=>$roomno, 'VISTOR_NO'=>$vno, 'VISITDATE'=>$vdate, 'VNAME'=>$visitname,'RELATION'=>$relation, 'VNICNO'=>$cnic, 'VADDRESS'=>$address, 'GENDER'=> $gender, 'VREMARKS'=> $remark);
                
				
				
                $result = $this->visitor_model->VisitorEdit($visitorInfo,$visitid);
		
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Vistors Details Updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Vistors Details Updation failed');
                }
                
                redirect('visitor/Visitor/editOld/'.$visitid);
				
            }
        }
 
	function getroombyHostelId()
    {	 
		 $hostelid = $this->input->post('hostelno');
		 
		 $result = $this->seat_model->getroombyHostelId($hostelid);
		 
		 echo json_encode($result);
		 
    }
	
	function ViewFeestucture()
    {
      	$gender = $this->gender;
		
		$data['viewSemInfo'] = $this->feechallan_model->SemesterDetail($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/viewstucture", $this->global, $data, NULL);
        
    }
	
	function viewAllFeechallanregno()
    {
      	$gender = $this->gender;
		
		$data['viewSemInfo'] = $this->feechallan_model->SemesterDetail($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/viewAllFeechallanregno", $this->global, $data, NULL);
        
    }
	
	function viewAllFeechallan()
    {
      	$gender = $this->gender;
		
		$data['viewSemInfo'] = $this->feechallan_model->SemesterDetail($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/viewAllFeechallan", $this->global, $data, NULL);
        
    }
	
	function viewhostelduesfeestructure()
    {
      	$gender = $this->gender;
		
		$data['viewFeeInfo'] = $this->feechallan_model->AssignFeeStructure($gender);
		
		$data['viewfeeTypeInfo'] = $this->feechallan_model->AssignFeetyoeStructure($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/viewhostelduesfeestructure", $this->global, $data, NULL);
        
    }
	
	function viewhostelfeesecurity()
    {
      	$gender = $this->gender;
		
		$data['viewFeeInfo'] = $this->feechallan_model->AssignSecurityFeeStructure($gender);
		
		$data['viewfeeTypeInfo'] = $this->feechallan_model->AssignSecurityFeeTypeStructure($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/viewhostelsecurityfeesstructue", $this->global, $data, NULL);
        
    }
	
	function viewhostelNewfeestructure()
    {
      	$gender = $this->gender;
		
		$data['viewFeeInfo'] = $this->feechallan_model->AssignNewFeeStructure($gender);
		
		$data['viewfeeTypeInfo'] = $this->feechallan_model->AssignNEWHOSTELFeeTypeStructure($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/viewhostelNewfeesstructue", $this->global, $data, NULL);
        
    }
	
	function ViewNewFeeStructure()
    {
      	$gender = $this->gender;
		
		$feedesc = $this->input->post('feedesc');
	    
		$feesem = $this->input->post('feesem');
		
		$feetype = 'NEW HOSTEL FEE';
		
		$data['viewFeeInfo'] = $this->feechallan_model->GetFeesInfo($gender, $feesem, $feedesc, $feetype);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/viewNewFeeInfo", $this->global, $data, NULL);
        
    }
	
	function ViewSecurityFeeStructure()
    {
      	$gender = $this->gender;
		
		$feedesc = $this->input->post('feedesc');
	    
		$feesem = $this->input->post('feesem');
		
		$feetype = 'HOSTEL SECURITY';
		
		$data['viewFeeInfo'] = $this->feechallan_model->GetFeesInfo($gender, $feesem, $feedesc, $feetype);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/viewSecurityFeeInfo", $this->global, $data, NULL);
        
    }
	
	function ViewNornalFeeStructure()
    {
      	$gender = $this->gender;
		
		$feedesc = $this->input->post('feedesc');
	    
		$feesem = $this->input->post('feesem');
		
		$feetype = 'HOSTEL FEE';
		
		$data['viewFeeInfo'] = $this->feechallan_model->GetFeesInfo($gender, $feesem, $feedesc, $feetype);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/viewNormalFeeInfo", $this->global, $data, NULL);
        
    }
	
	function EditNornalFeeChallan($feeID = NULL)
    {
      	if($feeID == null)
            {
                redirect('feechallan/Feechallan/viewhostelduesfeechallan');
            }
		$gender = $this->gender;
		
		$user = $this->feechallan_model->EditNornalFeeChallan($feeID, $gender);
		
		$regno = $user[0]->REGNO; $challanno = $user[0]->CHALLANNO;
		
		$data['editfeeInfo'] = $this->feechallan_model->EditNornalFeeChallan($feeID, $gender);
		
		$data['totalamount'] = $this->feechallan_model->getfeedetail($regno, $challanno, $feeID);
		
		$data['editfeedetailInfo'] = $this->feechallan_model->EditNornalFeeChallandetail($feeID, $challanno, $gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		print_r($data['editfeedetailInfo']);
		exit();
		
		$this->loadViews("feechallan/EditNormalFee", $this->global, $data, NULL);
        
    }
	
	function EditSecurityFeeChallan($feeID = NULL)
    {
      	if($feeID == null)
            {
                redirect('feechallan/Feechallan/viewhostelsecurityfeechallan');
            }
		$gender = $this->gender;
		
		$user = $this->feechallan_model->EditSecurityFeeChallan($feeID, $gender);
		
		$regno = $user[0]->REGNO; $challanno = $user[0]->CHALLANNO;
		
		$data['editfeeInfo'] = $this->feechallan_model->EditSecurityFeeChallan($feeID, $gender);
		
		$data['totalamount'] = $this->feechallan_model->getfeedetail($regno, $challanno, $feeID);
		
		$data['securityamount'] = $this->feechallan_model->getsecurity($regno, $gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/EditSecurityFee", $this->global, $data, NULL);
        
    }
	
	function EditNewFeeChallan($feeID = NULL)
    {
      	if($feeID == null)
            {
                redirect('feechallan/Feechallan/viewhostelsecurityfeechallan');
            }
		$gender = $this->gender;
		
		$user = $this->feechallan_model->EditSecurityFeeChallan($feeID, $gender);
		
		$regno = $user[0]->REGNO; $challanno = $user[0]->CHALLANNO;
		
		$data['editfeeInfo'] = $this->feechallan_model->EditSecurityFeeChallan($feeID, $gender);
		
		$data['totalamount'] = $this->feechallan_model->getfeedetail($regno, $challanno, $feeID);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/EditNewFee", $this->global, $data, NULL);
        
    }
	
	function ViewNornalFeeChallan($feeID = NULL)
    {
      	if($feeID == null)
            {
                redirect('feechallan/Feechallan/viewhostelduesfeechallan');
            }
		$gender = $this->gender;
		
		$data['editfeeInfo'] = $this->feechallan_model->EditNornalFeeStructure($feeID, $gender);
		
		$data['viewfeetypeInfo'] = $this->feechallan_model->feetype();
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/EditNormalstucture", $this->global, $data, NULL);
        
    }
	
	function EditNewFeeStructure($feeID = NULL)
    {
      	if($feeID == null)
            {
                redirect('feechallan/Feechallan/viewhostelNewfeestructure');
            }
		$gender = $this->gender;
		
		$data['editfeeInfo'] = $this->feechallan_model->EditNornalFeeStructure($feeID, $gender);
		
		$data['viewfeetypeInfo'] = $this->feechallan_model->feetype();
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/EditNewstucture", $this->global, $data, NULL);
        
    }
	
	function EditNornalSecurityFeeStructure($feeID = NULL)
    {
      	if($feeID == null)
            {
                redirect('feechallan/Feechallan/viewhostelfeesecurity');
            }
		$gender = $this->gender;
		
		$data['editfeeInfo'] = $this->feechallan_model->EditNornalFeeStructure($feeID, $gender);
		
		$data['viewfeetypeInfo'] = $this->feechallan_model->feetype();
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/EditSecuritystucture", $this->global, $data, NULL);
        
    }
	
	function EditNornalFeeStructure($feeID = NULL)
    {
      	if($feeID == null)
            {
                redirect('feechallan/Feechallan/viewhostelduesfeestructure');
            }
		$gender = $this->gender;
		
		$data['editfeeInfo'] = $this->feechallan_model->EditNornalFeeStructure($feeID, $gender);
		
		$data['viewfeetypeInfo'] = $this->feechallan_model->feetype();
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/EditNormalstucture", $this->global, $data, NULL);
        
    }
	
	function Feestucture()
    {
      	$gender = $this->gender;
		
		$data['viewSemInfo'] = $this->feechallan_model->SemesterDetail($gender);
		
		$data['viewfeeInfo'] = $this->feechallan_model->feetype();
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/addNewstucture", $this->global, $data, NULL);
        
    }
	
	function Feesecurity()
    {
      	$gender = $this->gender;
		
		$data['viewSemInfo'] = $this->feechallan_model->SemesterDetail($gender);
		
		$data['viewfeeInfo'] = $this->feechallan_model->feetypeSecurity();
		
		$data['CSemInfo'] = $this->feechallan_model->GetCSemInfo($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/addNewFeesecurity", $this->global, $data, NULL);
        
    }
	
	function NewFeestructure()
    {
      	$gender = $this->gender;
		
		$data['viewSemInfo'] = $this->feechallan_model->SemesterDetail($gender);
		
		$data['viewfeeInfo'] = $this->feechallan_model->feetype();
		
		$data['CSemInfo'] = $this->feechallan_model->GetCSemInfo($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/addNewStudFeestructure", $this->global, $data, NULL);
        
    }
	
	function Getprograme()
    {	 
		$gender = $this->gender;
		
		 $programelevel = $this->input->post('programelevel');
		 
		 $nationality = $this->input->post('nationality');
		 
		 $result = $this->feechallan_model->Getprograme($programelevel, $nationality, $gender);
		 
		 echo json_encode($result);
		 
    }
	
	function viewhostelduesfeechallan()
    {
      	$gender = $this->gender;
		
		$data['viewSemInfo'] = $this->feechallan_model->GetHostelGenratedFeeSem($gender);
		
		$data['viewbatchInfo'] = $this->feechallan_model->GetHostelGenratedBatch($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/viewhostelduesfeechallan", $this->global, $data, NULL);
        
    }
	
	function viewhostelnewfeechallan()
    {
      	$gender = $this->gender;
		
		$data['viewSemInfo'] = $this->feechallan_model->GetNewHostelGenratedSFeeSem($gender);
		
		$data['viewbatchInfo'] = $this->feechallan_model->GetNewHostelGenratedSBatch($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/viewhostelNewfeechallan", $this->global, $data, NULL);
        
    }
	
	function viewhostelsecurityfeechallan()
    {
      	$gender = $this->gender;
		
		$data['viewSemInfo'] = $this->feechallan_model->GetHostelGenratedSFeeSem($gender);
		
		$data['viewbatchInfo'] = $this->feechallan_model->GetHostelGenratedSBatch($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/viewhostelsecurityfeechallan", $this->global, $data, NULL);
        
    }
	
	function ViewNewHostelFeeGenrated()
    {
      	$gender = $this->gender;
		
		$csem = $this->input->post('csem');
		
		$batchname = $this->input->post('batchname');
		
		$data['viewHgenFeeInfo'] = $this->feechallan_model->ViewNewHostelFeeGenrated($gender, $csem, $batchname);
		
		$data['csem'] = $csem;
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel New Fee Details';
		
		$this->loadViews("feechallan/viewhostelNewgennorfeechallan", $this->global, $data, NULL);
        
    }
	
	function ViewSecurityHostelFeeGenrated()
    {
      	$gender = $this->gender;
		
		$csem = $this->input->post('csem');
		
		$batchname = $this->input->post('batchname');
		
		$data['viewHgenFeeInfo'] = $this->feechallan_model->ViewSecurityHostelFeeGenrated($gender, $csem, $batchname);
		
		$data['csem'] = $csem;
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/viewhostelSecuritygennorfeechallan", $this->global, $data, NULL);
        
    }
	
	function ViewNornalHostelFeeGenrated()
    {
      	$gender = $this->gender;
		
		$csem = $this->input->post('csem');
		
		$batchname = $this->input->post('batchname');
		
		$data['viewHgenFeeInfo'] = $this->feechallan_model->ViewNornalHostelFeeGenrated($gender, $csem, $batchname);
		
		$data['csem'] = $csem;
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/viewhostelgennorfeechallan", $this->global, $data, NULL);
        
    }
	
	function ViewNornalFeeChallanDetail($feeID = NULL)
    {
      	if($feeID == null)
            {
                redirect('feechallan/Feechallan/ViewNornalHostelFeeGenrated');
            }
		$gender = $this->gender;
		
		$userinfo = $this->feechallan_model->ViewNornalFeeChallanDetail($feeID, $gender);
		
		$paychllanid = $userinfo[0]->ID; $regno = $userinfo[0]->REGNO; $duedate = $userinfo[0]->CHALLANDUEDATE;
		$data['UserCNIC'] = $this->feechallan_model->getfnameoradb($regno);
		/* Take this code to student profile to update fine amount */
		$cdate = date('Y-m-d');
		if($cdate > $duedate)
		 {
			$noofdays = (strtotime($cdate) - strtotime($duedate))/60/60/24;
			$fineamount = 100*$noofdays;
			if($gender == 'Male' || $gender == 'Female')
			 {
			   $fineinfo = array('FINEAMOUNT'=>$fineamount, 'CHALLANDUEDATE'=>$cdate);
			 }
			/*elseif($gender == 'Female')
			 {
			   $fineinfo = array('CHALLANDUEDATE'=>$cdate);
			 }*/
			$this->feechallan_model->updatefine($feeID, $regno, $fineinfo);
		 }
		
		
		/* Take this code to student profile to update fine amount */
				
		$extExist = $this->feechallan_model->ViewNornalFeeChallanDescExten($regno, $paychllanid, $gender);
		
		$ext = 0;
		
		foreach($extExist as $ext)
		 {
			 $ext = $ext->FEECODE;
		 }
		
		if($ext == 102)
		  {	
		    $data['viefeeChallandesc'] = $this->feechallan_model->ViewNornalFeeChallanDesc($regno, $paychllanid, $gender);
		
			$data['viewfeeInfo'] = $this->feechallan_model->ViewNornalFeeChallanDetail($feeID, $gender);
			
			$data['BankInfo'] = $this->feechallan_model->ViewBankInfo($gender);
			
		    $this->load->view("feechallan/viewHNExtfeechallan", $data);
		  }
		else
		{   
		    
			$data['viefeeChallandesc'] = $this->feechallan_model->ViewNornalFeeChallanDesc($regno, $paychllanid, $gender);
		
			$data['viewfeeInfo'] = $this->feechallan_model->ViewNornalFeeChallanDetail($feeID, $gender);
			
			$data['BankInfo'] = $this->feechallan_model->ViewBankInfo($gender);
		
			$this->load->view("feechallan/viewHNfeechallan", $data);
		}
    }   
	
	function ViewSecurityFeeChallanDetail($feeID = NULL)
    {
      	if($feeID == null)
            {
                redirect('feechallan/Feechallan/viewhostelSecuritygennorfeechallan');
            }
		$gender = $this->gender;
		
		$userinfo = $this->feechallan_model->ViewSecurityFeeChallanDetail($feeID, $gender);
		
		$paychllanid = $userinfo[0]->ID; $regno = $userinfo[0]->REGNO; $duedate = $userinfo[0]->CHALLANDUEDATE;
		
		/* Take this code to student profile to update fine amount */
		/*$cdate = date('Y-m-d');
		if($cdate > $duedate)
		 {
			$noofdays = (strtotime($cdate) - strtotime($duedate))/60/60/24;
			$fineamount = 100*$noofdays;
			$fineinfo = array('FINEAMOUNT'=>$fineamount);
			$this->feechallan_model->updatefine($feeID, $regno, $fineinfo);
		 }*/
		
		
		/* Take this code to student profile to update fine amount */
		
		$data['viefeeChallandesc'] = $this->feechallan_model->ViewNornalFeeChallanDesc($regno, $paychllanid, $gender);
		
		$data['viewfeeInfo'] = $this->feechallan_model->ViewSecurityFeeChallanDetail($feeID, $gender);
		
		$data['BankInfo'] = $this->feechallan_model->ViewBankSecInfo($gender);
				
		$this->load->view("feechallan/viewHSfeechallan", $data);
        
    }
	
	function ViewNewFeeChallanDetail($feeID = NULL)
    {
      	if($feeID == null)
            {
                redirect('feechallan/Feechallan/ViewNewHostelFeeGenrated');
            }
		$gender = $this->gender;
		
		$userinfo = $this->feechallan_model->ViewSecurityFeeChallanDetail($feeID, $gender);
		
		$paychllanid = $userinfo[0]->ID; $regno = $userinfo[0]->REGNO; $duedate = $userinfo[0]->CHALLANDUEDATE;
		
		$data['UserCNIC'] = $this->feechallan_model->getfnameoradb($regno);
		
		/* Take this code to student profile to update fine amount */
		/*$cdate = date('Y-m-d');
		if($cdate > $duedate)
		 {
			$noofdays = (strtotime($cdate) - strtotime($duedate))/60/60/24;
			$fineamount = 100*$noofdays;
			$fineinfo = array('FINEAMOUNT'=>$fineamount);
			$this->feechallan_model->updatefine($feeID, $regno, $fineinfo);
		 }*/
		
		
		/* Take this code to student profile to update fine amount */
		
		$data['viefeeChallandesc'] = $this->feechallan_model->ViewNornalFeeChallanDesc($regno, $paychllanid, $gender);
		
		$data['viewfeeInfo'] = $this->feechallan_model->ViewSecurityFeeChallanDetail($feeID, $gender);
		
		$data['BankInfo'] = $this->feechallan_model->ViewBankInfo($gender);
		
		$data['BanksecInfo'] = $this->feechallan_model->ViewBankSecInfo($gender);
		
		$data['secInfo'] = $this->feechallan_model->ViewSecFeeChallanDesc($regno, $gender);
		
		$data['secfineInfo'] = $this->feechallan_model->ViewSecFine($regno, $gender);
				
		$this->load->view("feechallan/viewHNewfeechallan", $data);
        
    }
	
	function addNewFeeschallanRegno()
    {
      	$gender = $this->gender;
		
		$data['semcode'] = $this->feechallan_model->GetNewRegInfo($gender);
		
		$data['feestrucInfo'] = $this->feechallan_model->GetfeestrucInfo($gender);
		
		$data['CSemInfo'] = $this->feechallan_model->GetCSemInfo($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/addNewFeeschallanregno", $this->global, $data, NULL);
        
    }
	
	function addNewSecurityFeeschallanRegno()
    {
      	$gender = $this->gender;
		
		$data['semcode'] = $this->feechallan_model->GetNewRegInfo($gender);
		
		$data['feestrucInfo'] = $this->feechallan_model->GetfeestrucInfo($gender);
		
		$data['CSemInfo'] = $this->feechallan_model->GetCSemInfo($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/addNewSecurityFeeschallanRegno", $this->global, $data, NULL);
        
    }
	
	function addnorFeeschallanRegno()
    {
      	$gender = $this->gender;
		
		$data['semcode'] = $this->feechallan_model->GetNewRegInfo($gender);
		
		$data['feestrucInfo'] = $this->feechallan_model->GetfeestrucInfo($gender);
		
		$data['CSemInfo'] = $this->feechallan_model->GetCSemInfo($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/addnorFeeschallanregno", $this->global, $data, NULL);
        
    }

	
	function addnorFeeschallan()
    {
      	$gender = $this->gender;
		
		$data['semcode'] = $this->feechallan_model->GetNewRegInfo($gender);
		
		$data['feestrucInfo'] = $this->feechallan_model->GetfeestrucInfo($gender);
		
		$data['CSemInfo'] = $this->feechallan_model->GetCSemInfo($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/addnorFeeschallan", $this->global, $data, NULL);
        
    }
	
	function addNewFeeschallan()
    {		
		$gender = $this->gender;
		
		$data['semcode'] = $this->feechallan_model->GetNewRegInfo($gender);
		
		$data['feestrucInfo'] = $this->feechallan_model->GetNewfeestrucInfo($gender);
		
		$data['CSemInfo'] = $this->feechallan_model->GetCSemInfo($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/addNewFeeschallan", $this->global, $data, NULL);
        
    }

	
	function addsecurityFeeschallan()
    {
      	$gender = $this->gender;
		
		$data['semcode'] = $this->feechallan_model->GetNewRegInfo($gender);
		
		$data['feestrucInfo'] = $this->feechallan_model->GetSecurityfeestrucInfo($gender);
		
		$data['CSemInfo'] = $this->feechallan_model->GetCSemInfo($gender);
		
		$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';
		
		$this->loadViews("feechallan/addsecurityFeeschallan", $this->global, $data, NULL);
        
    }

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'IIUI Hostels : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }
	
	function challanNotFound($challaninfo)
    {
        $data['challaninfo'] = $challaninfo;
		
		$this->global['pageTitle'] = 'IIUI Hostels : 404 - Challan Not Found 1';
        
        $this->loadViews("challanError", $this->global, $data, NULL);
    }
	
	function challanreallot()
    {
        $this->global['pageTitle'] = 'IIUI Hostels : Re-Allotment Done';
        
        $this->loadViews("challanreallot", $this->global, NULL, NULL);
    }
	
	
	function GetUniqueFeecode()
    {	 
		$gender = $this->gender;
		
		 $programechallan = $this->input->post('programechallan');
		 
		 $nationality = $this->input->post('nationality'); 
		 
		 $assignfeestruc = $this->input->post('assignfeestruc');
		 
$result = $this->feechallan_model->GetUniqueFeecode($programechallan, $gender, $nationality, $assignfeestruc);
		 
		 echo json_encode($result);
		 
    }
	
	function GetUniqueFeecodeNewStud()
    {	 
		 $gender = $this->gender;
		 
		 $programechallan = $this->input->post('programechallan');
		 
		 $nationality = $this->input->post('nationality');
		 
		 $assignfeestruc = $this->input->post('assignfeestruc');
		 
		 $result = $this->feechallan_model->GetUniqueFeecodeNewStud($programechallan, $gender, $nationality, $assignfeestruc);
		 
		 echo json_encode($result);
		 
    }
	
	function GetUniqueFeecodeSecurity()
    {	 
		 $gender = $this->gender;
		
		 $programechallan = $this->input->post('programechallan');
		 
		 $nationality = $this->input->post('nationality');
		 
		 $assignfeestruc = $this->input->post('assignfeestruc');
		 
		 $result = $this->feechallan_model->GetUniqueFeecodeSecurity($programechallan, $gender, $nationality, $assignfeestruc);
		 
		 echo json_encode($result);
		 
    }
	
	function SubmitNewFeeChallanregno()
    {	 
		 
						
			$this->form_validation->set_rules('regno','Student Regno','required|max_length[128]');
			$this->form_validation->set_rules('csemester','current semester','required|max_length[128]');
			$this->form_validation->set_rules('assignfeestruc','Assign fee structure','required|max_length[128]');
			$this->form_validation->set_rules('duedate','Due date','required|max_length[128]');
			$this->form_validation->set_rules('processingfee','Hostel Processing Fee','required|numeric|max_length[128]');
			$this->form_validation->set_rules('usercharges','Hostel User charges','required|numeric|max_length[128]');
			$this->form_validation->set_rules('feetype','Fee Type','required|max_length[128]');
            
            
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('error', 'Fee Challan genrate failed');
				
				//redirect('visitor/Visitor/editOld/'.$visitid);
				redirect('feechallan/feechallan/addNewFeeschallanregno');
            }
            else
            {
                $regno = $this->input->post('regno');
				$csemester = $this->input->post('csemester');
				$assignfeestruc = $this->input->post('assignfeestruc');
				$duedate = $this->input->post('duedate');
				$processingfee = $this->input->post('processingfee');
				$utilityfee = $this->input->post('utilityfee');
				$usercharges = $this->input->post('usercharges');
				$feetype = $this->input->post('feetype');
				$reservefee = $this->input->post('reservefee');
							
				$gender = $this->gender;
				
				$batname = $this->feechallan_model->getuserbatchname($regno);
				
				$uinfo = $this->feechallan_model->getNewuserinforegno($regno, $gender);
				
				if($uinfo)
				{
				  $nationality = $uinfo[0]->NATIONALITY; 
				  
				  $protittle = $uinfo[0]->PROTITTLE; 
				  
				  $bname = $uinfo[0]->BATCHNAME;
				}
				else
				{
					$uinfo = $this->feechallan_model->getuserbatchname($regno);
					
					if($uinfo)
					{
					  $nationality = $uinfo[0]->NATIONALITY; 
					  
					  $protittle = $uinfo[0]->PROTITTLE; 
					  
					  $bname = $uinfo[0]->BATCHNAME;
					}
					else
					{
						$this->session->set_flashdata('error', 'Invalid Regno. Enter Regno as per University Student Card.');
				
					    redirect('feechallan/feechallan/addNewFeeschallanregno');
					}
				}
				
				$checkuinfo = $this->feechallan_model->CheckNewuserinforegno($regno, $gender);
				
				if(!empty($checkuinfo))
				
				{
						$this->session->set_flashdata('error', 'First verify Regno from New student List.');
				
					    redirect('feechallan/feechallan/addNewFeeschallanregno');
				}
 				
				$existFeeChhallan = $this->feechallan_model->NewFeechallanExistregno($gender, $csemester, $assignfeestruc, $nationality, $protittle, $bname, $feetype, $duedate, $regno);
				
				if(!empty($existFeeChhallan))
				  {
					  $this->session->set_flashdata('error', 'Selected Fee Challan already Genrated');
				
					  redirect('feechallan/feechallan/addNewFeeschallanregno');
				  }
				  
				  $challanno = $this->feechallan_model->GetLastChallanno();
						
						if(empty($challanno))
						  {
							  $lastchallanno = (int)'200000000001';
						  }
						else{
							 
							   $lastchallanno = $challanno[0]->CHALLANNO+1;
						 }
				
					 
					$NewFeeDetailInforegno = array(
						'REGNO'=>$regno, 
						'BATCHNAME'=>$bname, 
						'NATIONALITY'=>$nationality, 
						'PROTITTLE'=>$protittle, 
						'FEESTRUCSEM'=>$assignfeestruc, 
						'CHALLANNO'=>$lastchallanno, 
						'FINEAMOUNT'=>'0', 
						'FEETYPE'=>'NEW HOSTEL FEE', 
						'CURRENTSEMESTER'=>$csemester, 
						'GENDER'=>$gender, 
						'CHALLANDUEDATE'=>$duedate, 
						'STATUS'=>'1', 
						'updated_at'=>date('Y-m-d'), 
						'created_at'=>date('Y-m-d')
					);
								  
				$lastpayid = $this->feechallan_model->InsertNewFeeInforegno($NewFeeDetailInforegno);
				
				if($lastpayid)
				{
					$HNorFeeDetailRegno = array('REGNO'=>$regno, 'FEECODE'=>'101', 'FEEDESC'=>'Processing Fee', 'FEEAMOUNT'=>$processingfee, 'FEESTRUCSEM'=>$assignfeestruc, 'CHALLANNO'=>$lastchallanno, 'PAYCHALLANID'=>'0',  'PAYCHALLANID'=>$lastpayid,  'FEETYPE'=>'NEW HOSTEL FEE', 'CURRENTSEMESTER'=>$csemester, 'GENDER'=>$gender, 'updated_at'=>date('Y-m-d'), 'created_at'=>date('Y-m-d'));
					
					$this->feechallan_model->InsertFeedescRegno($HNorFeeDetailRegno);
					
					$HNorFeeDetailRegno = array('REGNO'=>$regno, 'FEECODE'=>'17', 'FEEDESC'=>'Hostel User Charges', 'FEEAMOUNT'=>$usercharges, 'FEESTRUCSEM'=>$assignfeestruc, 'CHALLANNO'=>$lastchallanno, 'PAYCHALLANID'=>'0',  'PAYCHALLANID'=>$lastpayid,  'FEETYPE'=>'NEW HOSTEL FEE', 'CURRENTSEMESTER'=>$csemester, 'GENDER'=>$gender, 'updated_at'=>date('Y-m-d'), 'created_at'=>date('Y-m-d'));
					
					$this->feechallan_model->InsertFeedescRegno($HNorFeeDetailRegno);
					
					if(!empty($utilityfee))
					  {
						 $HNorFeeDetailRegno = array('REGNO'=>$regno, 'FEECODE'=>'103', 'FEEDESC'=>'Utility Charges', 'FEEAMOUNT'=>$utilityfee, 'FEESTRUCSEM'=>$assignfeestruc, 'CHALLANNO'=>$lastchallanno, 'PAYCHALLANID'=>'0',  'PAYCHALLANID'=>$lastpayid,  'FEETYPE'=>'NEW HOSTEL FEE', 'CURRENTSEMESTER'=>$csemester, 'GENDER'=>$gender, 'updated_at'=>date('Y-m-d'), 'created_at'=>date('Y-m-d'));
					
					$this->feechallan_model->InsertFeedescRegno($HNorFeeDetailRegno); 
					  }
					  
					  if(!empty($reservefee))
					  {
						 $HNorFeeDetailRegno = array('REGNO'=>$regno, 'FEECODE'=>'103', 'FEEDESC'=>'Hostel Reservation Fee', 'FEEAMOUNT'=>$reservefee, 'FEESTRUCSEM'=>$assignfeestruc, 'CHALLANNO'=>$lastchallanno, 'PAYCHALLANID'=>'0',  'PAYCHALLANID'=>$lastpayid,  'FEETYPE'=>'NEW HOSTEL FEE', 'CURRENTSEMESTER'=>$csemester, 'GENDER'=>$gender, 'updated_at'=>date('Y-m-d'), 'created_at'=>date('Y-m-d'));
					
					$this->feechallan_model->InsertFeedescRegno($HNorFeeDetailRegno); 
					  }
					
					
				}
				
				$this->session->set_flashdata('success',' Fee Challan Genrated Successfully');
					redirect('feechallan/feechallan/addNewFeeschallanRegno');
						
						
			}
		 
      }
	  
	function SubmitNewSecurityFeeChallanregno()
    {	 
		 
						
			$this->form_validation->set_rules('regno','Student Regno','required|max_length[128]');
			$this->form_validation->set_rules('csemester','current semester','required|max_length[128]');
			$this->form_validation->set_rules('assignfeestruc','Assign fee structure','required|max_length[128]');
			$this->form_validation->set_rules('duedate','Due date','required|max_length[128]');
			$this->form_validation->set_rules('securityfee','Hostel Security Fee','required|numeric|max_length[128]');
			$this->form_validation->set_rules('feetype','Fee Type','required|max_length[128]');
            
            
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('error', 'Fee Challan genrate failed');
				
				//redirect('visitor/Visitor/editOld/'.$visitid);
				redirect('feechallan/feechallan/addNewSecurityFeeschallanRegno');
            }
            else
            {
                $regno = $this->input->post('regno');
				$csemester = $this->input->post('csemester');
				$assignfeestruc = $this->input->post('assignfeestruc');
				$duedate = $this->input->post('duedate');
				$securityfee = $this->input->post('securityfee');
				$feetype = $this->input->post('feetype');
							
				$gender = $this->gender;
				
				$batname = $this->feechallan_model->getuserbatchname($regno);
				
				$uinfo = $this->feechallan_model->getNewuserinforegno($regno, $gender);
				
				if($uinfo)
				{
				  $nationality = $uinfo[0]->NATIONALITY; 
				  
				  $protittle = $uinfo[0]->PROTITTLE; 
				  
				  $bname = $uinfo[0]->BATCHNAME;
				}
				else
				{
					$uinfo = $this->feechallan_model->getuserbatchname($regno);
					
					if($uinfo)
					{
					  $nationality = $uinfo[0]->NATIONALITY; 
					  
					  $protittle = $uinfo[0]->PROTITTLE; 
					  
					  $bname = $uinfo[0]->BATCHNAME;
					}
					else
					{
						$this->session->set_flashdata('error', 'Invalid Regno. Enter Regno as per University Student Card.');
				
					    redirect('feechallan/feechallan/addNewSecurityFeeschallanRegno');
					}
				}
				
				$checkuinfo = $this->feechallan_model->CheckNewuserinforegno($regno, $gender);
				
				if(!empty($checkuinfo))
				
				{
						$this->session->set_flashdata('error', 'First verify Regno from New student List.');
				
					    redirect('feechallan/feechallan/addNewSecurityFeeschallanRegno');
				}
 				
				$existFeeChhallan = $this->feechallan_model->NewFeechallanExistregno($gender, $csemester, $assignfeestruc, $nationality, $protittle, $bname, $feetype, $duedate, $regno);
				
				if(!empty($existFeeChhallan))
				  {
					  $this->session->set_flashdata('error', 'Selected Fee Challan already Genrated');
				
					  redirect('feechallan/feechallan/addNewSecurityFeeschallanRegno');
				  }
				  
				  $challanno = $this->feechallan_model->GetLastChallanno();
						
						if(empty($challanno))
						  {
							  $lastchallanno = (int)'200000000001';
						  }
						else{
							 
							   $lastchallanno = $challanno[0]->CHALLANNO+1;
						 }
						  
				$NewFeeDetailInforegno = array('REGNO'=>$regno, 'BATCHNAME'=>$bname, 'NATIONALITY'=>$nationality, 'PROTITTLE'=>$protittle, 'FEESTRUCSEM'=>$assignfeestruc, 'CHALLANNO'=>$lastchallanno, 'FINEAMOUNT'=>'0', 'FEETYPE'=>$feetype, 'CURRENTSEMESTER'=>$csemester, 'GENDER'=>$gender, 'CHALLANDUEDATE'=>$duedate, 'STATUS'=>'1', 'updated_at'=>date('Y-m-d'), 'created_at'=>date('Y-m-d'));
								  
				$lastpayid = $this->feechallan_model->InsertNewFeeInforegno($NewFeeDetailInforegno);
				
				if($lastpayid)
				{ 
					$HNorFeeDetailRegno = array('REGNO'=>$regno, 'FEECODE'=>'10', 'FEEDESC'=>'Hostel Security', 'FEEAMOUNT'=>$securityfee, 'FEESTRUCSEM'=>$assignfeestruc, 'CHALLANNO'=>$lastchallanno,  'PAYCHALLANID'=>$lastpayid,  'FEETYPE'=>$feetype, 'CURRENTSEMESTER'=>$csemester, 'GENDER'=>$gender, 'updated_at'=>date('Y-m-d'), 'created_at'=>date('Y-m-d'));
					
					$this->feechallan_model->InsertFeedescRegno($HNorFeeDetailRegno);
					
				}
				
				$this->session->set_flashdata('success',' Fee Challan Genrated Successfully');
					redirect('feechallan/feechallan/addNewSecurityFeeschallanRegno');
						
						
			}
		 
      }
	
	function SubmitFeeChallanregno()
    {	 
		 
						
			$this->form_validation->set_rules('regno','Student Regno','required|max_length[128]');
			$this->form_validation->set_rules('csemester','current semester','required|max_length[128]');
			$this->form_validation->set_rules('assignfeestruc','Assign fee structure','required|max_length[128]');
			$this->form_validation->set_rules('duedate','Due date','required|max_length[128]');
			$this->form_validation->set_rules('processingfee','Hostel Processing Fee','required|numeric|max_length[128]');
			$this->form_validation->set_rules('usercharges','Hostel User charges','required|numeric|max_length[128]');
			$this->form_validation->set_rules('feetype','Fee Type','required|max_length[128]');
            
            
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('error', 'Fee Challan genrate failed');
				
				//redirect('visitor/Visitor/editOld/'.$visitid);
				redirect('feechallan/feechallan/addnorFeeschallanregno');
            }
            else
            {
                $regno = $this->input->post('regno');
				$csemester = $this->input->post('csemester');
				$assignfeestruc = $this->input->post('assignfeestruc');
				$duedate = $this->input->post('duedate');
				$processingfee = $this->input->post('processingfee');
				$usercharges = $this->input->post('usercharges');
				$feetype = $this->input->post('feetype');
							
				$gender = $this->gender;
				
				$batname = $this->feechallan_model->getuserbatchname($regno);
				
				$uinfo = $this->feechallan_model->getuserinforegno($regno, $gender);
				
				if($uinfo)
				{
				  $nationality = $uinfo[0]->NATIONALITY; $protittle = $uinfo[0]->PROTITTLE; $bname = $uinfo[0]->BATCHNAME;
				}
				else
				{
					$uinfo = $this->feechallan_model->getuserbatchname($regno);
					if($uinfo)
					{
					  $nationality = $uinfo[0]->NATIONALITY; $protittle = $uinfo[0]->PROTITTLE; $bname = $uinfo[0]->BATCHNAME;
					}
					else
					{
						$this->session->set_flashdata('error', 'Invalid Regno. Enter Regno as per University Student Card.');
				
					    redirect('feechallan/feechallan/addnorFeeschallanregno');
					}
				}
 				
				$existFeeChhallan = $this->feechallan_model->NorFeechallanExistregno($gender, $csemester, $assignfeestruc, $nationality, $protittle, $bname, $feetype, $duedate, $regno);
				
				if(!empty($existFeeChhallan))
				  {
					  $this->session->set_flashdata('error', 'Selected Fee Challan already Genrated');
				
					  redirect('feechallan/feechallan/addnorFeeschallanregno');
				  }
				  
				  $challanno = $this->feechallan_model->GetLastChallanno();
						
						if(empty($challanno))
						  {
							  $lastchallanno = (int)'200000000001';
						  }
						else{
							 
							   $lastchallanno = $challanno[0]->CHALLANNO+1;
						 }
				
					 
					$NorFeeDetailInforegno = array('REGNO'=>$regno, 'BATCHNAME'=>$bname, 'NATIONALITY'=>$nationality, 'PROTITTLE'=>$protittle, 'FEESTRUCSEM'=>$assignfeestruc, 'CHALLANNO'=>$lastchallanno, 'FINEAMOUNT'=>'0', 'FEETYPE'=>'HOSTEL FEE', 'CURRENTSEMESTER'=>$csemester, 'GENDER'=>$gender, 'CHALLANDUEDATE'=>$duedate, 'STATUS'=>'1', 'updated_at'=>date('Y-m-d'), 'created_at'=>date('Y-m-d'));
								  
				$lastpayid = $this->feechallan_model->InsertNorFeeInforegno($NorFeeDetailInforegno);
				
				if($lastpayid)
				{
					$HNorFeeDetailRegno = array('REGNO'=>$regno, 'FEECODE'=>'101', 'FEEDESC'=>'Processing Fee', 'FEEAMOUNT'=>$processingfee, 'FEESTRUCSEM'=>$assignfeestruc, 'CHALLANNO'=>$lastchallanno, 'PAYCHALLANID'=>'0',  'PAYCHALLANID'=>$lastpayid,  'FEETYPE'=>'HOSTEL FEE', 'CURRENTSEMESTER'=>$csemester, 'GENDER'=>$gender, 'updated_at'=>date('Y-m-d'), 'created_at'=>date('Y-m-d'));
					
					$this->feechallan_model->InsertFeedescRegno($HNorFeeDetailRegno);
					
					$HNorFeeDetailRegno = array('REGNO'=>$regno, 'FEECODE'=>'17', 'FEEDESC'=>'Hostel User Charges', 'FEEAMOUNT'=>$usercharges, 'FEESTRUCSEM'=>$assignfeestruc, 'CHALLANNO'=>$lastchallanno, 'PAYCHALLANID'=>'0',  'PAYCHALLANID'=>$lastpayid,  'FEETYPE'=>'HOSTEL FEE', 'CURRENTSEMESTER'=>$csemester, 'GENDER'=>$gender, 'updated_at'=>date('Y-m-d'), 'created_at'=>date('Y-m-d'));
					
					$this->feechallan_model->InsertFeedescRegno($HNorFeeDetailRegno);
					
					
				}
				
				$this->session->set_flashdata('success',' Fee Challan Genrated Successfully');
					redirect('feechallan/feechallan/addnorFeeschallanregno');
						
						
			}
		 
      }
	
	function SubmitFeeChallan()
    {	 
		 
						
			$this->form_validation->set_rules('nationality','Nationality','required|max_length[128]');
			$this->form_validation->set_rules('programechallan','programechallan','required|max_length[128]');
			$this->form_validation->set_rules('csemester','Current Semester','required|max_length[128]');
			$this->form_validation->set_rules('semcode','Semester for','required|max_length[128]');
			$this->form_validation->set_rules('duedate','duedate','required|max_length[128]');
			$this->form_validation->set_rules('assignfeestruc','Assign Fee Structure','required|max_length[128]');
            
            
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('error', 'Please fill form correctly');
				
				//redirect('visitor/Visitor/editOld/'.$visitid);
				redirect('feechallan/feechallan/addnorFeeschallan');
            }
            else
            {
                $nationality = $this->input->post('nationality');
				$programechallan = $this->input->post('programechallan');
				$csemester = $this->input->post('csemester');
				$semcode = $this->input->post('semcode');
				$duedate = $this->input->post('duedate');
				$assignfeestruc = $this->input->post('assignfeestruc');
				$feetype = $this->input->post('feetype');
				
				$feetypes = $feetype;
							
				$gender = $this->gender;
				
				/*$existFeeChhallan = $this->feechallan_model->NorFeechallanExist($gender, $csemester, $assignfeestruc, $nationality, $programechallan, $feetype);
				
				if(!empty($existFeeChhallan))
				  {
					  $this->session->set_flashdata('error', 'Selected Fee Challan already Genrated');
				
					  redirect('feechallan/feechallan/addnorFeeschallan');
				  }*/
				  
				if($nationality == 'Pakistani')  
				{
				
				$GetNorFeeBatchInfo = $this->feechallan_model->GetNormalFeeInfo($gender, $nationality, $programechallan, $assignfeestruc, $feetype);
				//print_r($GetNorFeeBatchInfo);
				}
				elseif($nationality == 'Foreigner')
				{
				  $GetNorFeeBatchInfo = $this->feechallan_model->GetNormalFeeNation($gender, $nationality, $programechallan, $assignfeestruc, $feetype); 	
				}
				
				$reginfo = array('null'); $studnameinfo = array('null'); $bnameinfo = array('null');
				
				foreach($GetNorFeeBatchInfo as $batch)
				    {
					    $batch = $batch->BATCHNAME; 
			
						$studinfos = $this->feechallan_model->GetStudInfo($gender, $nationality, $programechallan, $batch, $semcode);
						
						foreach($studinfos as $studinfo)
						{
					       $regnos = $studinfo->REGNO;
						   
						   $checkreg = $this->feechallan_model->RegnoExistPaychallan($gender,$regnos, $csemester,$feetypes);

							if(empty($checkreg[0]->REGNO))
						      {	
									array_push($reginfo, $studinfo->REGNO);
									array_push($studnameinfo, $studinfo->STUDENTNAME);
									array_push($bnameinfo, $studinfo->BATCHNAME);
							  }
						}
												
					 }
					 //exit();
					
				$data['reginfos'] = $reginfo; $data['studnameinfo'] = $studnameinfo; $data['bnameinfo'] = $bnameinfo; $data['nationality'] = $nationality; $data['programe'] = $programechallan; $data['csem'] = $csemester; $data['assignfee'] = $assignfeestruc; $data['duedate'] = $duedate;
				
				$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';

				$this->loadViews("feechallan/normalfeechallan", $this->global, $data, NULL);
						
						
	        }
		 
      }
	  
	  function InsertNewFeeChallan()
    {	     
            $gender = $this->gender;
			
			if(empty($_POST['regno']) && empty($_POST['studname']) && empty($_POST['batch']) && empty($_POST['nationality']) && empty($_POST['programe']) && empty($_POST['csemester']) && empty($_POST['assignfee']) && empty($_POST['duedate']))
            {
                $this->session->set_flashdata('error', 'Fee Challan Insertion failed');
				
				//redirect('visitor/Visitor/editOld/'.$visitid);
				redirect('feechallan/feechallan/addNewFeeschallan');
            }
            else
            {
				$no = '';
				foreach ($_POST['regno'] as $key=>$regnos)
					{
						$studreg = $_POST['regno'][$key];
						$studname = $_POST['studname'][$key];
						$batch = str_replace('�', '', $_POST['batch'][$key]);
						$nationality = $_POST['nationality'][0];
						$programe = $_POST['programe'][0];
						$csemester = $_POST['csemester'][0];
						$assignfee = $_POST['assignfee'][0];
						$duedate = $_POST['duedate'][0];
						
						$challanno = $this->feechallan_model->GetLastChallanno();
						
						if(empty($challanno))
						  {
							  $lastchallanno = (int)'200000000001';
						  }
						else{
							 
							   $lastchallanno = $challanno[0]->CHALLANNO+1;
						 }
						
						 $NorFeeInfo = array('REGNO'=>$studreg, 'BATCHNAME'=>trim($batch), 'NATIONALITY'=>$nationality, 'PROTITTLE'=>$programe, 'FEESTRUCSEM'=>$assignfee, 'FEETYPE'=>'NEW HOSTEL FEE', 'CHALLANNO'=>$lastchallanno, 'FINEAMOUNT'=>'0',  'CURRENTSEMESTER'=>$csemester, 'GENDER'=>$gender, 'CHALLANDUEDATE'=>$duedate, 'STATUS'=> 0, 'updated_at'=>date('Y-m-d'), 'created_at'=>date('Y-m-d'));
								  
						$lastpaychallanid = $this->feechallan_model->InsertNorFeeInfo($NorFeeInfo);
						
						$feecodeInfo = $this->feechallan_model->GetNewFeecodes($gender, $nationality, $programe, $batch, $assignfee);
						foreach($feecodeInfo as $fcode)
						       {
								  $codefee = $fcode->FEECODE;
								  $feeamnt = $fcode->FEEAMOUNT;
								  $feedes =  $this->feechallan_model->GetFeedesc($codefee);
								  $feedesc = $feedes[0]->FEEDESC;
								  
								  $NorFeeDetailInfo = array('REGNO'=>$studreg, 'FEECODE'=>$codefee, 'FEEDESC'=>$feedesc, 'FEETYPE'=>'NEW HOSTEL FEE',  'FEEAMOUNT'=>$feeamnt,  'FEESTRUCSEM'=>$assignfee, 'CHALLANNO'=>$lastchallanno, 'CURRENTSEMESTER'=>$csemester, 'GENDER'=>$gender, 'PAYCHALLANID'=>$lastpaychallanid, 'updated_at'=>date('Y-m-d'), 'created_at'=>date('Y-m-d'));
								  
								  $this->feechallan_model->InsertNorFeeDetailInfo($NorFeeDetailInfo);
								  
							   }
							     
							 $lastchallanno = $lastchallanno+1;   
						$no++;
					}
					
					$this->session->set_flashdata('success', $no.' Fee Challan Genrated Successfully');
					redirect('feechallan/feechallan/addNewFeeschallan');
				
			}
   
   }
	  
	  function InsertSecurityFeeChallan()
    {	     
            $gender = $this->gender;
			
			if(empty($_POST['regno']) && empty($_POST['studname']) && empty($_POST['batch']) && empty($_POST['nationality']) && empty($_POST['programe']) && empty($_POST['csemester']) && empty($_POST['assignfee']) && empty($_POST['duedate']))
            {
                $this->session->set_flashdata('error', 'Fee Challan Insertion failed');
				
				//redirect('visitor/Visitor/editOld/'.$visitid);
				redirect('feechallan/feechallan/addsecurityFeeschallan');
            }
            else
            {
				$no = '';
				foreach ($_POST['regno'] as $key=>$regnos)
					{
						$studreg = $_POST['regno'][$key];
						$studname = $_POST['studname'][$key];
						$batch = str_replace('�', '', $_POST['batch'][$key]);
						$nationality = $_POST['nationality'][0];
						$programe = $_POST['programe'][0];
						$csemester = $_POST['csemester'][0];
						$assignfee = $_POST['assignfee'][0];
						$duedate = $_POST['duedate'][0];
						
						$challanno = $this->feechallan_model->GetLastChallanno();
						
						if(empty($challanno))
						  {
							  $lastchallanno = (int)'200000000001';
						  }
						else{
							 
							   $lastchallanno = $challanno[0]->CHALLANNO+1;
						 }
						
						 $NorFeeInfo = array('REGNO'=>$studreg, 'BATCHNAME'=>trim($batch), 'NATIONALITY'=>$nationality, 'PROTITTLE'=>$programe, 'FEESTRUCSEM'=>$assignfee, 'FEETYPE'=>'HOSTEL SECURITY', 'CHALLANNO'=>$lastchallanno, 'FINEAMOUNT'=>'0',  'CURRENTSEMESTER'=>$csemester, 'GENDER'=>$gender, 'CHALLANDUEDATE'=>$duedate, 'STATUS'=> 0, 'updated_at'=>date('Y-m-d'), 'created_at'=>date('Y-m-d'));
								  
						$lastpaychallanid = $this->feechallan_model->InsertNorFeeInfo($NorFeeInfo);
						
						$feecodeInfo = $this->feechallan_model->GetSecurityFeecodes($gender, $nationality, $programe, $batch, $assignfee);
						foreach($feecodeInfo as $fcode)
						       {
								  $codefee = $fcode->FEECODE;
								  $feeamnt = $fcode->FEEAMOUNT;
								  $feedes =  $this->feechallan_model->GetFeedesc($codefee);
								  $feedesc = $feedes[0]->FEEDESC;
								  
								  $NorFeeDetailInfo = array('REGNO'=>$studreg, 'FEECODE'=>$codefee, 'FEEDESC'=>$feedesc, 'FEETYPE'=>'HOSTEL SECURITY',  'FEEAMOUNT'=>$feeamnt,  'FEESTRUCSEM'=>$assignfee, 'CHALLANNO'=>$lastchallanno, 'CURRENTSEMESTER'=>$csemester, 'GENDER'=>$gender, 'PAYCHALLANID'=>$lastpaychallanid, 'updated_at'=>date('Y-m-d'), 'created_at'=>date('Y-m-d'));
								  
								  $this->feechallan_model->InsertNorFeeDetailInfo($NorFeeDetailInfo);
								  
							   }
							     
							 $lastchallanno = $lastchallanno+1;   
						$no++;
					}
					
					$this->session->set_flashdata('success', $no.' Fee Challan Genrated Successfully');
					redirect('feechallan/feechallan/addsecurityFeeschallan');
				
			}
   
   }
	  
	  
	  function InsertFeeChallan()
    {	     
        $gender = $this->gender;
			
			if(empty($_POST['regno']) && empty($_POST['studname']) && empty($_POST['batch']) && empty($_POST['nationality']) && empty($_POST['programe']) && empty($_POST['csemester']) && empty($_POST['assignfee']) && empty($_POST['duedate']))
            {
                $this->session->set_flashdata('error', 'Fee Challan Insertion failed');
				
				//redirect('visitor/Visitor/editOld/'.$visitid);
				redirect('feechallan/feechallan/addnorFeeschallan');
            }
            else
            {
				$no = '';
				
				foreach ($_POST['regno'] as $key=>$regnos)
					{
						$studreg = $_POST['regno'][$key];
						$studname = $_POST['studname'][$key];
						$batch = str_replace('�', '', $_POST['batch'][$key]);
						$nationality = $_POST['nationality'][0];
						$programe = $_POST['programe'][0];
						$csemester = $_POST['csemester'][0];
						$assignfee = $_POST['assignfee'][0];
						$duedate = $_POST['duedate'][0];
						
						$challanno = $this->feechallan_model->GetLastChallanno();
						
						if(empty($challanno))
						  {
							  $lastchallanno = (int)'200000000001';
						  }
						 else{
							 
							   $lastchallanno = $challanno[0]->CHALLANNO+1;
						 }
						
						 $NorFeeInfo = array('REGNO'=>$studreg, 'BATCHNAME'=>trim($batch), 'NATIONALITY'=>$nationality, 'PROTITTLE'=>$programe, 'FEESTRUCSEM'=>$assignfee, 'FEETYPE'=>'HOSTEL FEE', 'CHALLANNO'=>$lastchallanno, 'FINEAMOUNT'=>'0',  'CURRENTSEMESTER'=>$csemester, 'GENDER'=>$gender, 'CHALLANDUEDATE'=>$duedate, 'STATUS'=> 1, 'updated_at'=>date('Y-m-d'), 'created_at'=>date('Y-m-d'));
								  
						$lastpaychallanid = $this->feechallan_model->InsertNorFeeInfo($NorFeeInfo);
						
						$ExtInfo = $this->feechallan_model->GetExtInfo($studreg, $gender);
						
						if($ExtInfo == TRUE)
						  {
						    $updateExtFeeInfo = array('STATUS'=> 0);
						
						    $this->feechallan_model->UpdateExtFeeInfo($gender, $studreg, $updateExtFeeInfo);
						  }
						
						$feecodeInfo = $this->feechallan_model->GetFeecodes($gender, $nationality, $programe, $batch, $assignfee);
						foreach($feecodeInfo as $fcode)
						       {
								  $codefee = $fcode->FEECODE;
								  $feeamnt = $fcode->FEEAMOUNT;
								  $feedes =  $this->feechallan_model->GetFeedesc($codefee);
								  $feedesc = $feedes[0]->FEEDESC;
								  
								  $NorFeeDetailInfo = array('REGNO'=>$studreg, 'FEECODE'=>$codefee, 'FEEDESC'=>$feedesc, 'FEETYPE'=>'HOSTEL FEE',  'FEEAMOUNT'=>$feeamnt,  'FEESTRUCSEM'=>$assignfee, 'CHALLANNO'=>$lastchallanno, 'CURRENTSEMESTER'=>$csemester, 'GENDER'=>$gender, 'PAYCHALLANID'=>$lastpaychallanid, 'updated_at'=>date('Y-m-d'), 'created_at'=>date('Y-m-d'));
								  
								  $this->feechallan_model->InsertNorFeeDetailInfo($NorFeeDetailInfo);
								  
							   }
							     
							 $lastchallanno = $lastchallanno+1;   
						$no++;
					}
					
					$this->session->set_flashdata('success', $no.' Fee Challan Genrated Successfully');
					redirect('feechallan/feechallan/addnorFeeschallan');
				
			}
   
   }
   
   function SubmitNewFeeChallan()
    {	 
		 
						
			$this->form_validation->set_rules('nationality','Nationality','required|max_length[128]');
			$this->form_validation->set_rules('programechallan','programechallan','required|max_length[128]');
			$this->form_validation->set_rules('csemester','Current Semester','required|max_length[128]');
			$this->form_validation->set_rules('duedate','duedate','required|max_length[128]');
			$this->form_validation->set_rules('assignfeestruc','Assign Fee Structure','required|max_length[128]');
            
            
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('error', 'Fee Challan genrate failed');
				
				//redirect('visitor/Visitor/editOld/'.$visitid);
				redirect('feechallan/feechallan/addNewFeeschallan');
            }
            else
            {
                $nationality = $this->input->post('nationality');
				$programechallan = $this->input->post('programechallan');
				$csemester = $this->input->post('csemester');
				$semcode = $this->input->post('semesterfor');
				$duedate = $this->input->post('duedate');
				$assignfeestruc = $this->input->post('assignfeestruc');
				$feetype = $this->input->post('feetype');
							
				$gender = $this->gender;
				
				/*$existFeeChhallan = $this->feechallan_model->NorFeechallanExist($gender, $csemester, $assignfeestruc, $nationality, $programechallan, $feetype);
				
				if(!empty($existFeeChhallan))
				  {
					  $this->session->set_flashdata('error', 'Selected Fee Challan already Genrated');
				
					  redirect('feechallan/feechallan/addNewFeeschallan');
				  }*/
				
				$GetNorFeeBatchInfo = $this->feechallan_model->GetNormalFeeInfo($gender, $nationality, $programechallan, $assignfeestruc, $feetype);
				
				/*$newstudInfo = $this->feechallan_model->GetNewRegInfo($gender);
				
				$semcode = $newstudInfo[0]->SEMCODE;*/
				
				$reginfo = array('null'); $studnameinfo = array('null'); $bnameinfo = array('null');
				
				foreach($GetNorFeeBatchInfo as $batch)
				    {
						$batch = $batch->BATCHNAME; 
			
						$studinfos = $this->feechallan_model->GetSecurityStudInfo($gender, $nationality, $programechallan, $batch, $semcode);
						foreach($studinfos as $studinfo)
						{
							$feetypes = 'NEW HOSTEL FEE';
							$regnos = $studinfo->REGNO;
							$checkreg = $this->feechallan_model->RegnoExistPaychallan($gender,$regnos, $csemester,$feetypes);
							if(empty($checkreg[0]->REGNO))
							{
								array_push($reginfo, $studinfo->REGNO);
								array_push($studnameinfo, $studinfo->STUDENTNAME);
								array_push($bnameinfo, $studinfo->BATCHNAME);
							}
						}
												
					 }
					//print_r($reginfo);exit();
				$data['reginfos'] = $reginfo; $data['studnameinfo'] = $studnameinfo; $data['bnameinfo'] = $bnameinfo; $data['nationality'] = $nationality; $data['programe'] = $programechallan; $data['csem'] = $csemester; $data['assignfee'] = $assignfeestruc; $data['duedate'] = $duedate;
				
				$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';

				$this->loadViews("feechallan/newfeechallan", $this->global, $data, NULL);
						
						
	        }
		 
      }

   
   	function SubmitSecurityFeeChallan()
    {	 
		 
						
			$this->form_validation->set_rules('nationality','Nationality','required|max_length[128]');
			$this->form_validation->set_rules('programechallan','programechallan','required|max_length[128]');
			$this->form_validation->set_rules('csemester','Current Semester','required|max_length[128]');
			$this->form_validation->set_rules('duedate','duedate','required|max_length[128]');
			$this->form_validation->set_rules('assignfeestruc','Assign Fee Structure','required|max_length[128]');
            
            
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('error', 'Fee Challan genrate failed');
				
				//redirect('visitor/Visitor/editOld/'.$visitid);
				redirect('feechallan/feechallan/addsecurityFeeschallan');
            }
            else
            {
                $nationality = $this->input->post('nationality');
				$programechallan = $this->input->post('programechallan');
				$csemester = $this->input->post('csemester');
				$semcode = $this->input->post('semesterfor');
				$duedate = $this->input->post('duedate');
				$assignfeestruc = $this->input->post('assignfeestruc');
				$feetype = $this->input->post('feetype');
							
				$gender = $this->gender;
				
				/*$existFeeChhallan = $this->feechallan_model->NorFeechallanExist($gender, $csemester, $assignfeestruc, $nationality, $programechallan, $feetype);
				
				if(!empty($existFeeChhallan))
				  {
					  $this->session->set_flashdata('error', 'Selected Fee Challan already Genrated');
				
					  redirect('feechallan/feechallan/addsecurityFeeschallan');
				  }*/
				
				$GetNorFeeBatchInfo = $this->feechallan_model->GetNormalFeeInfo($gender, $nationality, $programechallan, $assignfeestruc, $feetype);
				
				/*$newstudInfo = $this->feechallan_model->GetNewRegInfo($gender);
				
				$semcode = $newstudInfo[0]->SEMCODE;*/
				
				$reginfo = array('null'); $studnameinfo = array('null'); $bnameinfo = array('null');
				
				foreach($GetNorFeeBatchInfo as $batch)
				    {
						$batch = $batch->BATCHNAME; 
			
						$studinfos = $this->feechallan_model->GetSecurityStudInfo($gender, $nationality, $programechallan, $batch, $semcode);
						foreach($studinfos as $studinfo)
						{
							$feetypes = 'HOSTEL SECURITY';
							$regnos = $studinfo->REGNO;
							$checkreg = $this->feechallan_model->RegnoExistPaychallan($gender,$regnos, $csemester,$feetypes);
							if(empty($checkreg[0]->REGNO))
							{
								array_push($reginfo, $studinfo->REGNO);
								array_push($studnameinfo, $studinfo->STUDENTNAME);
								array_push($bnameinfo, $studinfo->BATCHNAME);
							}
						}
						//print_r($studinfos);						
					 }
					//print_r(count($reginfo));
					//exit();
				$data['reginfos'] = $reginfo; $data['studnameinfo'] = $studnameinfo; $data['bnameinfo'] = $bnameinfo; $data['nationality'] = $nationality; $data['programe'] = $programechallan; $data['csem'] = $csemester; $data['assignfee'] = $assignfeestruc; $data['duedate'] = $duedate;
				
				$this->global['pageTitle'] = 'IIUI Hostels : View Hostel Fee Details';

				$this->loadViews("feechallan/securityfeechallan", $this->global, $data, NULL);
						
						
	        }
		 
      }
	  
	function CreditHourcheck($course)
     {	
	    
		$data['err_message'] = 'Sorry! you can not apply for Hostel seat, due to Courses Credit hrs  requirnment. Minimum Credit hrs requirment is: <b>'.$course.'</b>. Contact department Cordinator for course joining before applying.';
								
		$this->global['pageTitle'] = 'IIUI Hostels : Credit Hours Requirnmnet';

		$this->loadViews("reallotment/studentcoursereg", $this->global, $data, NULL);
		
		
	 }

    function Getsecurityprograme()
     {	 
		 $gender = $this->gender;
		
		 $programelevel = $this->input->post('sprogramelevel');
		 
		 $nationality = $this->input->post('snationality');
		 
		 $semcode = $this->input->post('semcode');
		 
		 $result = $this->feechallan_model->Getsecurityprograme($programelevel, $nationality, $gender, $semcode);
		 
		 echo json_encode($result);
		 
    }
	
	 function printAllotmentFeeChallanByRegno($feestatus)
     {
      	if($feestatus == 'NEWHOSTELFEE'){
			
		$feetype = 'HOSTEL FEE';
		
		$userId = $this->vendorId;
		
		$studregno = $this->session->userdata('studregno');
		
		$genders = $this->feechallan_model->GetGenderByRegno($studregno);
		
		if($genders->GENDER == 'M' || $genders->GENDER == 'Male'){
			$gender = 'Male';
		}
		elseif($genders->GENDER == 'F' || $genders->GENDER == 'Female'){
			$gender = 'Female';
		}	
		
		
		$seminfo = $this->report_model->GetActiveSem($gender);
			
	    $semcode = $seminfo[0]->SEMCODE;
		
		$AllotmentChallanexist = $this->feechallan_model->printAllotmentFeeChallanByRegno($studregno, $feetype, $semcode);
		
		if(empty($AllotmentChallanexist)){
			
			 $challaninfo = 'Wait for hostel fee challan. Soon it will be generated...';

			 // echo "test123"; 
			 // exit();

			 redirect('feechallan/NewFeechallan/challanNotFound/'.$challaninfo);
			
		}
			else{
				
				  $data['FeeInfo'] = $this->feechallan_model->printAllotmentFeeChallanByRegno($studregno, $feetype, $semcode);
				
				  $data['BankInfo'] = $this->feechallan_model->ViewBankInfo($gender);
				
				  $this->load->view("feechallan/newfee/printFeeChallanByRegno", $data);
				
			}
		
		}
		elseif($feestatus == 'RENEWALHOSTELFEE'){
			
		$feetype = 'HOSTEL RENEWAL FEE';
		
		$userId = $this->vendorId;
		
		$studregno = $this->session->userdata('studregno');
		
		$genders = $this->feechallan_model->GetGenderByRegno($studregno);
		
		if($genders->GENDER == 'Male' || $genders->GENDER == 'M'){
			$gender = 'Male';
		}
		elseif($genders->GENDER == 'Female' || $genders->GENDER == 'F'){
			$gender = 'Female';
		}
		
		$seminfo = $this->report_model->GetActiveSem($gender);
			
	    $semcode = $seminfo[0]->SEMCODE;
		
		$Reallotstatus = $this->reallotment_model->GetReallotsemInfo($gender);
		
		if(empty($Reallotstatus))
		{
			redirect('reallotment/reAllotment/studentreallotapply');
		}
		
		$AllotmentChallanexist = $this->feechallan_model->printAllotmentFeeChallanByRegno($studregno, $feetype, $semcode);
		
		if(empty($AllotmentChallanexist)){
			
			 $challaninfo = 'Wait for hostel fee challan. Soon it will be generated...';

			 // echo "test"; 

			 // exit();
			 
			 redirect('feechallan/NewFeechallan/challanNotFound/'.$challaninfo);
			
		}
			else{
				
				  //Credit Hour Check

		
		$courseInfo = $this->Signup_model->getCourseInfo($gender, $semcode);
		
		if(empty($courseInfo)){
		// echo $gender;
		// echo "<br>";
		// echo $semcode;
		// exit();
			
			 $challaninfo = 'Hostel Seat ReNewal Process not started. Wait for some time and come back again.';

			 //echo "test"; exit();
			 
			 redirect('feechallan/NewFeechallan/challanNotFound/'.$challaninfo);
			
		}
		
		$regno = $studregno;
		
		$studentaljamia = $this->feechallan_model->GetstudinfoAljamia($regno);
								
								$studregno = $studentaljamia->REGNO;
								
								$nationality = $studentaljamia->NATIONALITY;
								
								$studprogram = $studentaljamia->PROTITTLE;
								
						if($studprogram == 'BS' || $studprogram == 'LLB' || $studprogram == 'MA' || $studprogram == 'MSC' || $studprogram == 'BA'){
							$protitle = 'BS';	
						}
						elseif($studprogram == 'MS'){
									     
										 $protitle = 'MS';
								  }
					    elseif($studprogram == 'PHD'){
									     
										 $protitle = 'PHD';
								  }
								
								foreach($courseInfo as $info)
										{
											$coursestatus  = $info->STATUS;
											$coursestype  = $info->TYPE;
											$coursebap  = $info->BSPAK;
											$coursemap  = $info->MAPAK;
											$coursemsp  = $info->MSPAK;
											$coursephdp  = $info->PHDPAK;
											$coursebaf  = $info->BSFOREIGNER;
											$coursemaf  = $info->MAFOREIGNER;
											$coursemsf  = $info->MSFOREIGNER;
											$coursephdf  = $info->PHDFOREIGNER;
											$coursesemcode  = $info->SEMCODE;										
										}
					
					if($coursestype == 'ReAllotment' && $coursestatus == 1)
					   {
						 if(($protitle == 'BS' || $protitle == 'LLB' || $protitle == 'BA' || $protitle == 'Bachelor') && ($nationality == 'Pakistani'))
						   {	
									 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);									
									
									 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursebap;
									 
									 if($studTotalCredit < $coursebap)
										{ 
											$course = $coursebap;
									        redirect('feechallan/NewFeechallan/CreditHourcheck/'.$course);
										}
										
						   }
						elseif(($protitle == 'BS' || $protitle == 'LLB' || $protitle == 'BA' || $protitle == 'Bachelor') && ($nationality != 'Pakistani'))
						  {
							 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
							
							 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursebaf;
							 
							 if($studTotalCredit < $coursebaf)
								{ 
									$course = $coursebaf;
									redirect('feechallan/NewFeechallan/CreditHourcheck/'.$course);
								}
								
						  }
						elseif(($protitle == 'MA' || $protitle == 'MSC' || $protitle == 'MSc') && ($nationality == 'Pakistani'))
						  {
							 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
							
							 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursemap;
							 
							 if($studTotalCredit < $coursemap)
								{ 
									$course = $coursemap;
									redirect('feechallan/NewFeechallan/CreditHourcheck/'.$course);
								}
								
						  } 
						elseif(($protitle == 'MA' || $protitle == 'MSC' || $protitle == 'MSc') && ($nationality != 'Pakistani'))
						  {
							 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
							
							 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursemaf;
							 
							 if($studTotalCredit < $coursemaf)
								{ 
									$course = $coursemaf;
									redirect('feechallan/NewFeechallan/CreditHourcheck/'.$course);
								}
								
						  }    
						 elseif(($protitle == 'MS' || $protitle == 'LLM' || $protitle == 'MS/MPHILL') && ($nationality == 'Pakistani'))
						  {
							 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
							
							 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursemsp;
							 
							 if($studTotalCredit < $coursemsp)
								{ 
									$course = $coursemsp;
									redirect('feechallan/NewFeechallan/CreditHourcheck/'.$course);
								}
								
						  } 
						elseif(($protitle == 'MS' || $protitle == 'LLM' || $protitle == 'MS/MPHILL') && ($nationality != 'Pakistani'))
						  {
							 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
							
							 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursemsf;
							 
							 if($studTotalCredit < $coursemsf)
								{ 
									$course = $coursemsf;
									redirect('feechallan/NewFeechallan/CreditHourcheck/'.$course);
								}
								
						  }
						elseif(($protitle == 'PHD') && ($nationality == 'Pakistani'))
						  {
							 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
							
							 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursephdp;
							 
							 if($studTotalCredit < $coursephdp)
								{ 
									$course = $coursephdp;
									redirect('feechallan/NewFeechallan/CreditHourcheck/'.$course);
								}
								
						  } 
						elseif(($protitle == 'PHD') && ($nationality != 'Pakistani'))
						  {
							 $studTotalCredit = $this->Signup_model->getStudentCourseInfo($regno, $semcode);
							
							 $data['studTotalCredit'] = $studTotalCredit; $data['TotalCredit'] = $coursephdp;
							 
							 if($studTotalCredit < $coursephdp)
								{ 
									$course = $coursephdp;
									redirect('feechallan/NewFeechallan/CreditHourcheck/'.$course);
								}
								
						  }
						  
						 
					   }
								
					// Credit Hour Check ENd

					   
				
				  $data['FeeInfo'] = $this->feechallan_model->printAllotmentFeeChallanByRegno($studregno, $feetype, $semcode);
				
				  $data['BankInfo'] = $this->feechallan_model->ViewBankInfo($gender);
				
				  $this->load->view("feechallan/newfee/printFeeChallanByRegno", $data);
				
			}
			
		}

		
        
     }

}

?>