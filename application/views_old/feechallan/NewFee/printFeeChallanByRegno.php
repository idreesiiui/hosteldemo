<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Fee Challan</title>	
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
 

<style>

.logo1-iiui{
	width: 35px;
    height: 35px;
    margin-top: -44px;
    position: absolute;
    margin-left: -3px;
}

.container {
	width: 100%;
	margin: 0 auto;
	font-family: 'Open Sans', sans-serif;
	clear:both;
	/*text-align:center;*/
}

.print-button button {
	padding: 10px;
	float: right;
	background-color: #ddd;
	border: 1px solid #ccc;
	border-radius: 2px;
	cursor: pointer;
	margin-left: 5px;
}

.right {
	float: right;
}

.bold {
	font-weight: bold;
}

.underline {
	text-decoration: underline;
}

.container .single-column {
	width: 205px !important;
	border: 1px dotted #ccc;
	display: inline-block;
	margin: 0 10px;
	padding: 5px;
	text-align: left;
	font-size: 10px;
	line-height: 12px;
	vertical-align: top;
}

.bank-title {
	text-align: center;
	font-weight: bold;
	font-size: 16px;
}

.dues-challan, .security-challan {
	text-align: center;
}

.security-challan {
	page-break-before: always;
}

.fee-distribution-table {
	width: 100%;
	border-spacing: 0;
	padding: 2px 2px 0 2px;
}
.fee-distribution-table {
	border: 1px solid #ccc;
}
.fee-distribution-table td {
	border-bottom: 1px solid #ccc;
}

.border-left {
	border-left: 1px solid #ccc;
	text-align: center;
}

.copy-owner {
	margin-top: 90px; 
	text-align: center; 
	width: 250px;
	margin-left:-25px;
}
.copy-owner .copy, .copy-owner .bank-title {
	font-weight: bold;
	font-size: 14px;
}

@media print {
	@page { size: landscape; }
}

.right-align {
	text-align: right;
}

table thead th {
	border-bottom: 1px solid #ccc;
}

.print-and-download-container button {
  padding: 10px;
  float: right;
  background-color: #ddd;
  border: 1px solid #ccc;
  border-radius: 2px;
  cursor: pointer;
  margin-left: 5px;
}

.header-image {
	width: 40%;
}

.bank-logo-container {
	text-align: center;
}

.bank-logo-container img {
	height: 30px;
	/*margin-top: -10px;*/
}

.fixed-width {
	width: 70px;
}

.bank-instructions-title {
	margin: 20px 0 0;
}

.bank-instructions-list {
	margin: 0;
	padding: 0 15px 0;
	font-size: 10px;
	line-height: 15px;
}

.total-amount {
	text-align: right;
}

.account-number {
	text-align: center;
}
.overseas-cls tr, .overseas-cls td{
	padding-top: 0px !important;
	padding-bottom: 0px !important;
	margin-top: 0px !important;
	margin-bottom: 0px !important;
}

div {
  float: left;
 
}
@media print {
  #printPageButton {
    display: none;
  }
}

</style>



 
</head>
<body>
<?php for($i=0; $i<=3; $i++){?>
  <div class="container" id="fee-challan-container" style="height: 600px; max-height: 600px !important; display: contents;">
  	<div class="dues-challan">
  		
		    <div class="single-column">
		    	<div>
                     <h3 style="text-align:center; margin-left:32px">International Islamic Univeristy Islamabad</h3>
		    		<img class="logo1-iiui" src="<?php echo base_url(); ?>assets/dist/img/feechallan/logo.jpg" class="header-image" alt="IIUI">   
                 </div>
		    	<div class="bank-logo-container">
				
						<img src="<?php echo base_url(); ?>assets/dist/img/feechallan/<?php echo $BankInfo->LOGONAME?>" alt="<?php echo $BankInfo->BANKNAME?>"><br><br>
                        <?php
						     if($BankInfo->BANKNAME == 'HABIB BANK LIMITED'){
								 $bank = 'HBL Bank';
							 }
							 else{
								 $bank = 'Allied Bank';
							 }
					    ?>
					<span class="bold" style="margin-left: 3px;"><?php echo $bank?> Account#:&nbsp;&nbsp;&nbsp;<?php echo $BankInfo->BANKACCOUNTNO?></span>
		    	</div>
		    
				<table class="detail-table ">
					<tbody>
						<tr>
							<td class="bold fixed-width">Challan#:</td>
							<td>
    							<?php echo $FeeInfo->challanno; ?>
							</td>
                        </tr>
                      
                        <tr>
							<td class="bold fixed-width">Smester:</td>
							<td>
								<?php echo $FeeInfo->current_semester; ?>
							</td>
						</tr>
                        <tr>
							<td class="bold">Due Date:</td>
							<td class="underline bold"><?php echo date("d-m-Y", strtotime($FeeInfo->duedate)) ?></td>
                        </tr>
                        <tr>
							<td class="bold">Issued Date:</td>
							<td><?php echo date("d-m-Y", strtotime($FeeInfo->issuedate)) ?></td>
						</tr>
                        <tr>
							<td class="bold">Fee Type:</td>
							<td>
                                <?php 
                            	       $feestructureid = $FeeInfo->fee_structure_id; 
								 	   $CI =& get_instance();
									   $CI->load->model('feechallan_model');
									   $feestruct = $CI->feechallan_model->getfeestructtype($feestructureid);
									   $feetype = $feestruct->structure_type;
									   echo $feestruct->structure_type;
							    ?>
                            </td>
						</tr>
						<tr>
							<td class="bold">Regno:</td>
							<td>
    							 <?php 
								 	   $regno = $FeeInfo->regno; 
								 	   $CI =& get_instance();
									   $CI->load->model('feechallan_model');
									   $studinfo = $CI->feechallan_model->getFeestudInfoAljamia($regno);
								
									   echo $studinfo->REGNO;
								 ?>
							</td>
                        </tr>      
						<tr>
							<td class="bold">Student Name: </td>
							<td><?php echo $studinfo->STUDENTNAME; ?></td>
						</tr>
						<tr>
							<td class="bold">Father Name: </td>
							<td><?php echo $studinfo->FATHERNAME; ?></td>
						</tr>
                        <tr>
							<td class="bold">CNIC/Passport No: </td>
							<td><?php echo $studinfo->CNIC; ?></td>
						</tr>
                        <tr>
							<td class="bold">Nationality: </td>
							<td><?php echo $studinfo->NATIONALITY; ?></td>
						</tr> 
						<tr>
							<td class="bold">Program:</td>
							<td><?php echo $studinfo->PROGRAME; ?></td>
						</tr>				
						
						
					</tbody>
				</table>
				<table class="fee-distribution-table">
					<thead>
						<tr>
							<th>Particulars (Head Code)</th>
							<th class="border-left">Amount</th>
						</tr>
					</thead>
					
					<tbody>
                      <?php
					   		   $feestructureid = $FeeInfo->fee_structure_id; 
							   $CI =& get_instance();
							   $CI->load->model('feechallan_model');
							   $feehead = $CI->feechallan_model->NewFeeStructureHeadListById($feestructureid);
							   $amount = 0;
							   foreach($feehead as $head){ 
					
							       if($head->head_code != 107 && $head->head_code != 108 && $head->head_code != 109){
					  ?>
						<tr>
                        <?php
						if($head->head_code != 107 && $head->head_code != 108 && $head->head_code != 109){ 
						?>
							<td><?php echo $head->head_name.' ('.$head->head_code.')'?> </td>
                        <?php
						}
						?>
							<td class="border-left right-align">
							   <?php 
							   	if($head->head_code == 100) 
								{ 
								   $feeamount = $FeeInfo->month*$head->amount;
								    $modifyamount = $FeeInfo->modify;
								   echo $feeamount-$modifyamount;
								} else if($head->head_code == 101 && ($FeeInfo->installment == 1 || $FeeInfo->installment == 2)){
									$feeamount = ($head->amount)/2;
									echo $feeamount;
								}else 	{
									$feeamount = $head->amount; 
									echo $feeamount;
								}
							   ?>
                            </td>
						</tr>
                        <?php 
						       $amount = $amount+$feeamount;
							   //echo $feeamount.'<br>'; 
							   }
							}
							//echo $amount;
						$allotfee = $amount;
						?>
                        <?php
						if($FeeInfo->extension != 0){
								   
								   if($FeeInfo->extension == '2nd Extension Fee'){
								   ?>
                                    <tr>
                                        <td><?php echo '2nd Extension Fee (108)'?> </td>
                                        <td class="border-left right-align"><?php $feeamount = 1000*$FeeInfo->month; echo $feeamount;?></td>
                                    </tr>
								   <?php	   
								   }
								   elseif($FeeInfo->extension == '3rd Extension Fee'){
								   ?>
                                    <tr>
                                        <td><?php echo '3rd Extension Fee (109)'?> </td>
                                        <td class="border-left right-align"><?php $feeamount = 2000*$FeeInfo->month; echo $feeamount;?></td>
                                    </tr>
								   <?php	   
								   }
								   elseif($FeeInfo->extension == '4th Extension Fee'){
								   ?>
                                    <tr>
                                        <td><?php echo '4th Extension Fee (110)'?> </td>
                                        <td class="border-left right-align"><?php $feeamount = 2000*$FeeInfo->month; echo $feeamount;?></td>
                                    </tr>
								   <?php	   
								   }
								   elseif($FeeInfo->extension == '5th Extension Fee'){
								   ?>
									<tr>
                                        <td><?php echo '5th Extension Fee (111)'?> </td>
                                        <td class="border-left right-align"><?php $feeamount = 2000*$FeeInfo->month; echo $feeamount;?></td>
                                    </tr>
                                   <?php   
								   }
								   elseif($FeeInfo->extension == '6th Extension Fee'){
								   ?>
                                   <tr>
                                        <td><?php echo '6th Extension Fee (112)'?> </td>
                                        <td class="border-left right-align"><?php $feeamount = 2000*$FeeInfo->month; echo $feeamount;?></td>
                                    </tr>
                                    <?php  
								   }
								   elseif($FeeInfo->extension == '7th Extension Fee'){
								   ?>
                                   <tr>
                                        <td><?php echo '7th Extension Fee (113)'?> </td>
                                        <td class="border-left right-align"><?php $feeamount = 2000*$FeeInfo->month; echo $feeamount;?></td>
                                    </tr>
                                   <?php   
								   }
								   elseif($FeeInfo->extension == '8th Extension Fee'){
								   ?>
                                   <tr>
                                        <td><?php echo '8th Extension Fee (114)'?> </td>
                                        <td class="border-left right-align"><?php $feeamount = 2000*$FeeInfo->month; echo $feeamount;?></td>
                                    </tr>
                                   <?php   
								   }
								   elseif($FeeInfo->extension == '9th Extension Fee'){
								   ?>
                                   <tr>
                                        <td><?php echo '9th Extension Fee (115)'?> </td>
                                        <td class="border-left right-align"><?php $feeamount = 2000*$FeeInfo->month; echo $feeamount;?></td>
                                    </tr>
                                   <?php   
								   }
								   elseif($FeeInfo->extension == '10th Extension Fee'){
								   ?>
                                   <tr>
                                        <td><?php echo '10th Extension Fee (116)'?> </td>
                                        <td class="border-left right-align"><?php $feeamount = 2000*$FeeInfo->month; echo $feeamount;?></td>
                                    </tr>
                                   <?php
								      
								   }
								  
							   }
							   if($FeeInfo->extension == 0 || $FeeInfo->extension == '1st Extension Fee'){
							      //$amount = $amount-50;
								  
							   }
							   elseif( $FeeInfo->extension > 0){
								    
								     $amount = $amount+$feeamount;
							   }
							  
						?>
                        <?php
						
						    $fineamount = 0;
							if($FeeInfo->finestatus == 0){
								$duedate = $FeeInfo->duedate;
								$cdate = date('Y-m-d');
								if($cdate > $duedate)
								{
									$noofdays = (strtotime($cdate) - strtotime($duedate))/60/60/24;
									$fineamount = 100*$noofdays;
									if($FeeInfo->finestatus == 0){
									   $id = $FeeInfo->id;
									   $fineinfo = array('fineamount'=>$fineamount);
									   $CI =& get_instance();
									   $CI->load->model('feechallan_model');
									   $feehead = $CI->feechallan_model->updateNewfine($fineinfo, $id);
									}
								}
							if($fineamount != 0){ 
						?>
                        <tr>
							<td><?php echo 'Fine Amount' ?> </td>
							<td class="border-left right-align"><?php echo $fineamount; ?></td>
						</tr>
                        <?php
						         $amount = $amount+$fineamount;
								 $allotfee = $fineamount+$allotfee;
							   }
							}
						?>
						<tr>
						    <td class="bold total-amount">Total Amount</td>
							<td class="border-left right-align">
                                <span class="bold">
                                      <?php 
									        if($feetype == 'Allotment'){
												echo $allotfee;
											}
											else{
											     echo $amount-$modifyamount;
											}
									?>
                                </span>
                            </td>
						</tr>
					
					</tbody>
                </table>
               
				<div class="bank-instructions">
					<h4 class="bank-instructions-title">Instructions</h5>
					<ol class="bank-instructions-list">
                        <li>Fee can be paid in any branch of <?php echo $bank?> all over Pakistan.</li>
                        <li>Paid Fee Slip must be attached with Hostel Allotment/Renewal form. </li>                        
					</ol>
				</div>
				<div class="copy-owner">
    				<span class="copy">
						<?php 
							if($i == 0){
								echo 'Student Copy';
							}
							elseif($i == 1){
								echo 'Provost Office Copy';
							}
							elseif($i == 2){
								echo 'Accounts Copy';
							}
							elseif($i == 3){
								echo 'Bank Copy';
							}
						?>
                    </span>
				</div>
			</div> <!-- Ending single-column --> 
	
	</div> <!-- Ending dues challan --> 
  </div> <!-- Ending container --> 

 <?php }?>
<button type="button" id="printPageButton" Onclick="window.print();return false;" />Print </button>

<!-- For Security Fee Challan -->

<?php
	  if($feestruct->structure_type == 'Allotment'){
?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
		  for($i=0; $i<=3; $i++){
?>
	   <div class="container" id="fee-challan-container" style="height: 600px; max-height: 600px !important; display: contents;">
  	<div class="dues-challan">
  		
		    <div class="single-column">
		    	<div>
                     <h3 style="text-align:center; margin-left:32px">International Islamic Univeristy Islamabad</h3>
		    		<img class="logo1-iiui" src="<?php echo base_url(); ?>assets/dist/img/feechallan/logo.jpg" class="header-image" alt="IIUI">   
                 </div>
		    	<div class="bank-logo-container">
				
						<img src="<?php echo base_url(); ?>assets/dist/img/feechallan/<?php echo $BankInfo->LOGONAME?>" alt="<?php echo $BankInfo->BANKNAME?>"><br><br>
                        <?php
						     if($BankInfo->BANKNAME == 'HABIB BANK LIMITED'){
								 $bank = 'HBL Bank';
							 }
							 else{
								 $bank = 'Allied Bank';
							 }
					    ?>
					<span class="bold" style="margin-left: 3px;"><?php echo $bank?> Account#:&nbsp;&nbsp;&nbsp;
					<?php
					      if($BankInfo->BANKNAME == 'HABIB BANK LIMITED'){
								 echo '5000-79040032-03';
							 }
							 else{
								 echo '0020000143260150';
							 }
					?>
                    </span>
		    	</div>
		    
				<table class="detail-table ">
					<tbody>
						<tr>
							<td class="bold fixed-width">Challan#:</td>
							<td>
    							<?php 
								 	   $CI =& get_instance();
									   $CI->load->model('feechallan_model');
									   $challanno = $CI->feechallan_model->NewGetLastChallanno();
									   						
										if(empty($challanno))
										  {
											  $lastchallanno = (int)'200000042842';
										  }
										else{	 
											   $semcode = $FeeInfo->current_semester;
											   
											   $secchallan = $CI->feechallan_model->securitychallanexist($regno, $semcode);
											   
											   if(empty($secchallan)){
											   
											      $lastchallanno = $otp = mt_rand(10000000, 99999999);
												  $studinfo = $CI->feechallan_model->getFeestudInfoAljamia($regno);
												  $regno = $studinfo->REGNO;
												  $challaninfo = array(
												  	'regno'=>$regno, 
												  	'semcode'=>$semcode, 
												  	'issuedate'=>$FeeInfo->issuedate, 
												  	'duedate'=>$FeeInfo->duedate, 
												  	'challanno'=>$lastchallanno, 
												  	'head_name'=>'Hostel Security', 
												  	'head_code'=>'2100');
												  $CI->feechallan_model->insertsecuritychallan($challaninfo);
											   }
											   else{
												   $lastchallanno = $secchallan->challanno;
											   }
										  }
								        echo $lastchallanno; 
							    ?>
							</td>
                        </tr>
                        <tr>
							<td class="bold fixed-width">Smester:</td>
							<td>
								<?php echo $FeeInfo->current_semester; ?>
							</td>
						</tr>
                        <tr>
							<td class="bold">Due Date:</td>
							<td class="underline bold"><?php echo date("d-m-Y", strtotime($FeeInfo->duedate)) ?></td>
                        </tr>
                        <tr>
							<td class="bold">Issued Date:</td>
							<td><?php echo date("d-m-Y", strtotime($FeeInfo->issuedate)) ?></td>
						</tr>
                        <tr>
							<td class="bold">Fee Type:</td>
							<td>
                                <?php 
                            	       $feestructureid = $FeeInfo->fee_structure_id; 
								 	   $CI =& get_instance();
									   $CI->load->model('feechallan_model');
									   $feestruct = $CI->feechallan_model->getfeestructtype($feestructureid);
									   
									   echo $feestruct->structure_type;
							    ?>
                            </td>
						</tr>
						<tr>
							<td class="bold">Regno:</td>
							<td>
    							 <?php 
								 	   $regno = $FeeInfo->regno; 
								 	   $CI =& get_instance();
									   $CI->load->model('feechallan_model');
									   $studinfo = $CI->feechallan_model->getFeestudInfoAljamia($regno);
								
									   echo $studinfo->REGNO;
								 ?>
							</td>
                        </tr>      
						<tr>
							<td class="bold">Student Name: </td>
							<td><?php echo $studinfo->STUDENTNAME; ?></td>
						</tr>
						<tr>
							<td class="bold">Father Name: </td>
							<td><?php echo $studinfo->FATHERNAME; ?></td>
						</tr>
                        <tr>
							<td class="bold">CNIC/Passport No: </td>
							<td><?php echo $studinfo->CNIC; ?></td>
						</tr>
                        <tr>
							<td class="bold">Nationality: </td>
							<td><?php echo $studinfo->NATIONALITY; ?></td>
						</tr> 
						<tr>
							<td class="bold">Program:</td>
							<td><?php echo $studinfo->PROGRAME; ?></td>
						</tr>				
						
						
					</tbody>
				</table>
				<table class="fee-distribution-table">
					<thead>
						<tr>
							<th>Particulars (Head Code)</th>
							<th class="border-left">Amount</th>
						</tr>
					</thead>
					
					<tbody>
                     
						<tr>
							<td>Hostel Security </td>
							<td class="border-left right-align">7000</td>
						</tr>
                        
                       
						<tr>
						    <td class="bold total-amount">Total Amount</td>
							<td class="border-left right-align">
                                <span class="bold">
                                      <?php echo '7000'?>
                                </span>
                            </td>
						</tr>
					</tbody>
                </table>
				<div class="bank-instructions">
					<h4 class="bank-instructions-title">Instructions</h5>
					<ol class="bank-instructions-list">
                        <li>Fee can be paid in any branch of <?php echo $bank?> all over Pakistan.</li>
                        <li>Paid Fee Slip must be attached with Hostel Allotment/Renewal form. </li>                        
					</ol>
				</div>
				<div class="copy-owner">
    				<span class="copy">
						<?php 
							if($i == 0){
								echo 'Student Copy';
							}
							elseif($i == 1){
								echo 'Provost Office Copy';
							}
							elseif($i == 2){
								echo 'Accounts Copy';
							}
							elseif($i == 3){
								echo 'Bank Copy';
							}
						?>
                    </span>
				</div>
			</div> <!-- Ending single-column --> 
	
	</div> <!-- Ending dues challan --> 
  </div> <!-- Ending container --> 
<?php
		  }
      }
?>
<!-- Security Fee Challan End -->
</body>
</html>