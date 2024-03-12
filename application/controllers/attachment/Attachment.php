<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Muhammad Idrees 
 * @version : 2.0
 * @since : 17 November 2022
 */
class Attachment extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
		$this->load->model('attachment_model');
		$this->load->model('seat_model');
        $this->load->model('room_model');
		$this->load->model('allotment_model');
        $this->isLoggedIn();   
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
    function viewAttachmentDetail()
    {
        $gender = $this->gender;
        $data['viewattachments'] = '';

        if($gender == 'Male'){
			$data['viewattachments'] = $this->attachment_model->viewattachmentInfo($gender);

        }


		
		$this->global['pageTitle'] = 'IIUI Hostels : View Attachment Details';
		
		$this->loadViews("attachment/viewattachment", $this->global, $data, NULL);
        
    }
	
	function viewSeatdetailinfo()
    {
		
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
			$hostelno = $this->input->post('hostelno');
			
			$roomno = $this->input->post('roomno');
			
			$occupystatus = $this->input->post('occupy');
			
			if($hostelno != "" && $roomno != "" && $occupystatus != "")
			{
			 
            	$data['seatRecords'] = $this->seat_model->getSeatInfo($hostelno,$roomno,$occupystatus);
			}
			else
			{
			 
            	$data['seatRecords'] = $this->seat_model->getSeatInfoByHostelroom($hostelno,$roomno);
			}
            
            $this->global['pageTitle'] = 'IIUI Hostels : View Seat Info Details';
            
            $this->loadViews("seat/viewseat", $this->global, $data, NULL);
        }
    }


    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
		$gender = $this->gender;
		
		$data['seminfo'] = $this->attachment_model->getAllseminfo($gender);	
		
		$this->global['pageTitle'] = 'IIUI Hostels : Add New Seat';

		$this->loadViews("attachment/addNewattachment", $this->global, $data, NULL);
    }
	
	function GetseatInfoById()
    {
        	$seatavilabel = $this->input->post('seatavilabel');
			
			$result = $this->allotment_model->getAllSeatInfoById($seatavilabel);
		 
		    echo json_encode($result);   
    }
	
	function VerifyUserRecord()
    {
        	$gender = $this->gender;   
			
			$regno = $this->input->post('regno');
	
			$result = $this->attachment_model->VerifyUserRecordById($regno, $gender);
			
		   //print_r($result);
		    echo json_encode($result);   
    }
	
	function VerfiyGuestRegno()
    {
			$gender = $this->gender;
		
        	$attachregno = $this->input->post('attachregno');
	
			$result = $this->attachment_model->VerfiyGuestRegno($attachregno, $gender);
			
			if(!empty($result))
			{
		       $result = 0;
			   
			   echo json_encode($result);
			}
			else{
				
				$result = $this->attachment_model->GetAttachiRecord($attachregno);
				
				echo json_encode($result);
				
			}
    }
	
	/**
     * This function is used to check whether email already exist or not
     */
    function checkEmailExists()
    {
        $userId = $this->input->post("userId");
        $email = $this->input->post("email");

        if(empty($userId)){
            $result = $this->attachment_model->checkEmailExists($email);
        } else {
            $result = $this->attachment_model->checkEmailExists($email, $userId);
        }

        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }
    
    /**
     * This function is used to add new user to the system
     */
    function addNewattachment()
    {   
			$this->form_validation->set_rules('hostelid','Hostel No','trim|required|max_length[10]|xss_clean|numeric');
			$this->form_validation->set_rules('hostelname','Hostel Name','trim|required|max_length[30]|xss_clean');
			$this->form_validation->set_rules('roomid','Room No','trim|required|max_length[30]|xss_clean|numeric');
			$this->form_validation->set_rules('seatid','Seat No','trim|required|max_length[30]|xss_clean|numeric');
            $this->form_validation->set_rules('roomtype','Room Type','trim|required|xss_clean|max_length[128]');
            $this->form_validation->set_rules('regno','Registration No','required|max_length[128]');
			$this->form_validation->set_rules('studentname','Student Name','required|max_length[128]');
			$this->form_validation->set_rules('attachregno','Ataachi Regno','required|max_length[128]');
			$this->form_validation->set_rules('attachname','Ataachi Name','required|max_length[128]');
			$this->form_validation->set_rules('email','Ataachi Email','required|max_length[128]');
			$this->form_validation->set_rules('attachimobile','Ataachi Mobile','required|max_length[11]|xss_clean|numeric');
			$this->form_validation->set_rules('expdate','Exp Date','required|max_length[128]');
            
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $regno = $this->input->post('regno');
				$studentname = $this->input->post('studentname');
				$hostelid = $this->input->post('hostelid');
				$roomid = $this->input->post('roomid');
				$seatid = $this->input->post('seatid');
				$attachregno = $this->input->post('attachregno');
				$attachname = $this->input->post('attachname');
				$attachcnic = str_replace("-","", $this->input->post('attachcnic'));
				$email = $this->input->post('email');
				$attachmobile = str_replace("-","",$this->input->post('attachimobile'));
				$semcode = $this->input->post('semcode');
				$expdate = $this->input->post('expdate');
				$depodate = $this->input->post('depodate');
				$attachdate = $this->input->post('attachdate');
				$feeamount = $this->input->post('feeamount');
				$challanno = $this->input->post('challanno');
				$arrier = $this->input->post('arrier');
				$status = $this->input->post('status');
				$key = $this->input->post('key');
				$remarks = $this->input->post('remarks');
				
				$gender = $this->gender;
				
				$studemailsId = $this->attachment_model->CheckEmailExist($email);
				
				if($studemailsId == 1)
				{
				   $this->session->set_flashdata('error', 'This email is already taken by other user, try! some other');
					redirect('attachment/Attachment/addNew');
				}
					
				elseif($studemailsId == 0)
					{
						 $studentusercreate = array(
						 	'REGNO'=>$attachregno, 
						 	'EMAIL'=>$email, 
						 	'GENDER'=>$gender, 
						 	'MOBILE'=>str_replace(' ', '', $attachmobile), 
						 	'NAME'=>$attachname,
						 	'PASSWORD'=>getHashedPassword(str_replace(' ','',strtolower($attachname))),
						 	'ROLEID'=>4, 
						 	'CNIC'=>str_replace(' ', '', $attachcnic), 
						 	'createdDtm'=>date('Y-m-d H:i:s'), 
						 	'createdBy'=>$this->vendorId);
						
						$emailids = $this->attachment_model->CreateNewUser($studentusercreate);
				        
						$emailid =  $emailids[0]->userId; 
						
					}
				
				
				
				
                
				$Attachexisted = $this->attachment_model->attach_exists_against_Regno($regno, $attachregno);
				
				if($Attachexisted == true)
					{
						$this->session->set_flashdata('error', 'This Attachment already existed against selected Registration Number in Database.');
						redirect('attachment/Attachment/addNew');
					}
					
			else
			{
                
            $attachInfo = array(
            	'HOSTREGNO' => $regno,
            	'STUDENTNAME' => $studentname,
            	'HOSTELID' => $hostelid,
            	'ROOMID' => $roomid,
            	'SEATID' => $seatid,
            	'ATTACHREGNO' => $attachregno,
            	'ATTACHNAME' => $attachname,
            	'SEMCODE' => $semcode ,
            	'EXPIRYDATE' => $expdate,
            	'DEPOSITDATE' =>  $depodate,
            	'ATTACHDATE' => $attachdate,
            	'HOSTELDUES' => $feeamount,
            	'RECEIPTNO' =>  $challanno,
            	'ARRIERS' => $arrier,
            	'ATACHSTATUS' => $status,
            	'ATTACHKEY' =>  $key,
            	'REMARKS' =>  $remarks,
            	'GENDER' =>  $gender
            );
                
                
                $guestregexisted = $this->attachment_model->guestexisted($attachregno);
				
				if($guestregexisted == true)
					{
						$this->session->set_flashdata('error', 'This Attachi has already alloted Hostel Seat with other Attachi.');
						redirect('attachment/Attachment/addNew');
					}
				else
				{
				$result = $this->attachment_model->addNewAttachment($attachInfo);
               
			}
			
			    $emailtype = 'New Application';
			
				$sendemail = $this->attachment_model->getsendemail($gender, $emailtype);
				
				/* Mail function starts */
				
				require 'PHPMailer/src/Exception.php';
                require 'PHPMailer/src/PHPMailer.php';
                require 'PHPMailer/src/SMTP.php';
                require "PHPMailer/src/OAuth.php";
                require "PHPMailer/src/POP3.php";

                $mail = new PHPMailer\PHPMailer\PHPMailer();
               
                    $mail->isSMTP(); 
                    $mail->Host = 'smtp-relay.gmail.com';    
                    $mail->SMTPAuth = true;                            
                    $mail->Username = $sendemail[0]->EMAIL;            
                    $mail->Password = $sendemail[0]->PASSWORD;
					$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
					$mail->Port = 587;                                  // TCP port to connect to
				
				$mail->setFrom($sendemail[0]->EMAIL, 'Admin Hostel IIUI');
				$mail->addReplyTo('no-reply@iiu.edu.pk', 'Admin Hostel IIUI');
				$mail->addAddress($email);   // Add a recipient
				//$mail->addCC('cc@example.com');
				//$mail->addBCC('bcc@example.com');
				
				$mail->isHTML(true);  // Set email format to HTML
				
				$bodyContent = '<h4>New User Created in Hostels IIUI. Regno: </h4><h3>('.$attachregno.').</h3>';
				$bodyContent .= '<p>Your New User account for hostel in International Islamic University has been created. Your Email address '.$email.' and password is <b>'.strtolower($attachname).'</b> Keep this email with you for login to IIUI Hostel Portal for Allotment, Reallotment & seat change process. <b> http://usis.iiu.edu.pk:64453/login</b>. More info visit IIUI Hostel web Portal.</p>
				<br/>
				<h3>Best Regards</h3>
				<h4">Hostel Admin</h4>
				<p>http://www.iiu.edu.pk</p><br/>
				<span style="font-size:smaller;background-color: #44C553;color: #fff;">This communication contains information that is for the exclusive use of the intended recipient(s). If you are not the intended recipient, disclosure, copying, distribution or other use of, or taking of any action in reliance upon, this communication or the information in it is prohibited and may be unlawful. If you have received this communication in error please notify the sender by return email, delete it from your system and destroy any copies.</span>
				';
				
				$mail->Subject = 'Email from IIUI Hostel Admin';
				$mail->Body    = $bodyContent;
				
				if(!$mail->send()) {
					echo 'Message could not be sent.';
					echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					echo 'Message has been sent';
				}
				/* Mail function End */
			
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Attachment created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Attachment creation failed');
                }
                
                redirect('attachment/Attachment/viewAttachmentDetail');
       }
			
    }
 }
    

    
    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($AllotID = NULL)
    {
        
            if($AllotID == null)
            {
                redirect('attachment/Attachment/viewreAttachmenttDetail');
            }
			
			//$data['seatdetail'] = $this->attachment_model->getAllSeatInfo();
			
            $data['attachInfo'] = $this->attachment_model->getAttachmentInfobyId($AllotID);
            
            $this->global['pageTitle'] = 'IIUI Hostels : View Attachment Deatail';
            
            $this->loadViews("attachment/editOld", $this->global, $data, NULL);
        
    }
    
     /**
     * This function is used to edit the Allotment information
     */
	 function editReAllotment()
    {
       		
            $reallotmentid = $this->input->post('reallotid');
			 
            $this->form_validation->set_rules('seatavilabel','Seat Avilabel','trim|required|xss_clean|max_length[128]');
			$this->form_validation->set_rules('hostelno','Hostel No','trim|required|max_length[10]|xss_clean|numeric');
			$this->form_validation->set_rules('roomno','Room No','trim|required|max_length[30]|xss_clean|numeric');
            $this->form_validation->set_rules('regno','Registration No','required|max_length[128]');
			$this->form_validation->set_rules('studentname','Studentname','required|max_length[128]');
			$this->form_validation->set_rules('expdate','Exp Date','required|max_length[128]');
			$this->form_validation->set_rules('depodate','Deposit Date','required|max_length[128]');
            
            
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('error', 'ReAllotment Updation failed');
				
				redirect('reallotment/ReAllotment/editOld/'.$reallotmentid);
            }
            else
            {
                $reallotmentid = $this->input->post('reallotid');
				$status = $this->input->post('status');
				$rtype = $this->input->post('rtype');
			    $regno = $this->input->post('regno');
				$seatavilabel = $this->input->post('seatavilabel');
				$roomname = $this->input->post('roomname');
				$hostelno = $this->input->post('hostelno');
				$hostelname = $this->input->post('hostelname');
				$roomno = $this->input->post('roomno');
				$studentname = $this->input->post('studentname');
				$semcode = $this->input->post('semcode');
				$alloted = $this->input->post('alloted');
				$expdate = $this->input->post('expdate');
				$depodate = $this->input->post('depodate');
				$feeamount = $this->input->post('feeamount');
				$recpno = $this->input->post('recpno');
				$rdues = $this->input->post('rdues');
                
                
             $allotmentInfo = array('SEATSTATUS'=>$status,'STUDENTNAME'=>$studentname,'REGNO'=>$regno,'SEATID'=>$seatavilabel, 'ROOMID'=>$roomno, 'HOSTELID'=> $hostelno, 'ALLOTED'=>$alloted, 'EXPIRYDATE'=>$expdate,'FEEAMOUNT'=>$feeamount, 'DEPOSITDATE'=> $depodate, 'RECEIPTNO'=> $recpno,'RDUES'=>$rdues,'SEMCODE'=>$semcode);
                
				$reallotmentInfo = array('SEATSTATUS'=>$status,'R_TYPE'=>$rtype,'STUDENTNAME'=>$studentname,'REGNO'=>$regno,'SEATID'=>$seatavilabel, 'ROOMID'=>$roomno, 'HOSTELID'=> $hostelno, 'ALLOTED'=>$alloted, 'EXPIRYDATE'=>$expdate,'FEEAMOUNT'=>$feeamount, 'DEPDATE'=> $depodate, 'RECEIPTNO'=> $recpno,'RDUES'=>$rdues,'SEMCODE'=>$semcode);
                
				
				$Allotexisted = $this->reallotment_model->allotment_exists_against_expdate($expdate);
				
				if($Allotexisted == true)
					{
						$this->session->set_flashdata('error', 'The Re-Allotment already existed against selected Expiry Date in Database.');
						redirect('reallotment/ReAllotment/editOld/'.$reallotmentid);
					}
				else
					{
						$lastseatid = $this->reallotment_model->lastseatid();
						
						$lastallotedseatid = $lastseatid[0]->SEATID;
						
						$seatexisted = $this->reallotment_model->seatexisted($lastallotedseatid);
						
						$existedseat = $seatexisted[0]->SEATID;
						
						if($seatavilabel != $existedseat)
						{
							$updateseatstatus = array('OCCUPIED'=>0);
							$UpdatedSeat = $this->reallotment_model->UpdatedSeatAlloted($updateseatstatus,$lastallotedseatid);
							$updatenewseatstatus = array('OCCUPIED'=>1);
							$UpdatedSeat = $this->reallotment_model->UpdatedSeatAllotedNew($updatenewseatstatus,$seatavilabel);
							//echo $existedseat." <br>".$lastallotedseatid;
						}
				//exit();
                $result = $this->reallotment_model->editReAllotment($allotmentInfo,$regno);
				
                $this->reallotment_model->InsertReAllotment($reallotmentInfo);
		
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Seat ReAllotment Updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Seat ReAllotment Updation failed');
                }
                
                redirect('reallotment/ReAllotment/editOld/'.$reallotmentid);
				}
            }
        }
   
	function getroombyHostelId()
    {	 
		 $hostelid = $this->input->post('hostelno');
		 
		 $result = $this->seat_model->getroombyHostelId($hostelid);
		 
		 echo json_encode($result);
		 
    }

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'IIUI Hostels : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}

?>