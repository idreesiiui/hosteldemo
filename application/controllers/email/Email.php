<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Muhammad Idrees 
 * @version : 2.0
 * @since : 17 November 2022
 */
class Email extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
		$this->load->model('reallotment_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
		
        /* Mail function starts */
		
				 require 'PHPMailer/src/Exception.php';
                 require 'PHPMailer/src/PHPMailer.php';
                 require 'PHPMailer/src/SMTP.php';
                  require "PHPMailer/src/OAuth.php";
                  require "PHPMailer/src/POP3.php";
		
				 $mail = new PHPMailer\PHPMailer\PHPMailer();
               
                    $mail->isSMTP(); 
                    $mail->Host ='smtp.gmail.com';    
                    $mail->SMTPAuth = true;                            
                    $mail->Username = 'hac@iiu.edu.pk';            
                    $mail->Password = 'islamabad12';   
			
				
				$bodyContent = '<h3>This is test Email form HAC.</h3><br><h3>
Congratulations! your HAC EMAIL for IIUI Hostel Female Campus Done Successfully.</h3>';
			  $bodyContent .= '<p style="font-size:14px">Kindly visit on <b> http://usis.iiu.edu.pk:64453/login</b> <strong>to download your Allotment Slip</strong>.<br><strong>Note: </strong>Login with same email ( '.'Hello'.' ) and password <b>'.str_replace(' ','',strtolower('he')).'</b>.Please reset your password after first login to avoid any porblem.  If you forget your password than reset your password on login page (forgot password link).<br><br>If you have any query regarding login and Allotment slip. Email us at:<strong> hostel@iiu.edu.pk</strong>. We will reply you as soon as possible. </p>
				<br/>
				<h3>Best Regards</h3>
				<h4">Provost Office</h4>
				<p>Female Campus</p><br/><br/>
				<div style="font-size:smaller;background-color: #3c763d;color: #fff;">This communication contains information that is for the exclusive use of the intended recipient(s). If you are not the intended recipient, disclosure, copying, distribution or other use of, or taking of any action in reliance upon, this communication or the information in it is prohibited and may be unlawful. If you have received this communication in error please notify the sender by return email, delete it from your system and destroy any copies.</div>
				';
		       
				$mail->setFrom('hac@iiu.edu.pk', 'HAC Hostel IIUI');
				$mail->addReplyTo('no-reply@iiu.edu.pk', 'HAC Hostel IIUI');
				$mail->addAddress('hostel@iiu.edu.com');   // Add a recipient
				$mail->addCC('haroon.mushtaq@makkays.com');
				$mail->addBCC('junaid.azhar@iiu.edu.pk');
				
				$mail->isHTML(true);  // Set email format to HTML
				
				$mail->Subject = 'Email from IIUI Hostel HAC';
				$mail->Body    = $bodyContent;
		
				if(!$mail->send()) {
					
					$msg = 'Mailer Error: ' . $mail->ErrorInfo;
					$msg = 'Message could not be sent.';
				} else {
					echo $msg = 'Message has been sent';
				}
				
				/* Mail function End */
    }
    
   
}

?>