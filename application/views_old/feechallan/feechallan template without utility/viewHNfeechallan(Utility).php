<?php date_default_timezone_set('Asia/Karachi');
if(!empty($viewfeeInfo))
{
?>
<html>
<style>
.button {
  background-color: #4CAF50; /* Green */
  color: white;
  cursor: pointer;
  border: 1px solid green;
  color: white;
  padding: 9px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  -webkit-transition-duration: 0.4s; /* Safari */
  transition-duration: 0.4s;
}
@media print{@page {size: landscape}}

</style>
<body dir=LTR bgcolor="#ffffff">
<!-- Created by Oracle Reports  -->
 <a id="printpagebutton" class="button" style="float:right; margin-top: 1em;" type="button"  onclick="printpage()"/><i class="fa fa-print"></i> Print</a>
<style>#f1{font:bold 11pt Arial;color:#000000}</style>
<img style="width:50px; height:45px; position:absolute;top:1pt;left:25pt" src="<?php echo base_url(); ?>assets/dist/img/feechallan/logo.jpg">
<img style="width:50px; height:45px; position:absolute;top:1pt;left:242pt" src="<?php echo base_url(); ?>assets/dist/img/feechallan/logo.jpg">
<img style="width:50px; height:45px; position:absolute;top:1pt;left:458pt" src="<?php echo base_url(); ?>assets/dist/img/feechallan/logo.jpg">
<img style="width:50px; height:45px; position:absolute;top:1pt;left:675pt" src="<?php echo base_url(); ?>assets/dist/img/feechallan/logo.jpg">
<span style="position:absolute;top:4pt;left:67pt" id=f1>International Islamic University, </span>
<span style="position:absolute;top:4pt;left:283pt" id=f1>International Islamic University, </span>
<span style="position:absolute;top:4pt;left:498pt" id=f1>International Islamic University, </span>
<span style="position:absolute;top:4pt;left:715pt" id=f1>International Islamic University, </span>
<style>#f2{font:bold 11pt Arial;text-decoration:underline;color:#000000}</style>
<span style="position:absolute;top:18pt;left:101pt" id=f2>Islamabad</span>
<span style="position:absolute;top:18pt;left:317pt" id=f2>Islamabad</span>
<span style="position:absolute;top:18pt;left:533pt" id=f2>Islamabad</span>
<span style="position:absolute;top:18pt;left:750pt" id=f2>Islamabad</span>

<div style="position:absolute;top:0.0pt;left:22.5pt;width:289.5;height:296;padding-top:427.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"><table></table></div>
<div style="position:absolute;top:49.5pt;left:27.0pt;width:271.5;height:19.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#ffffff;"><table></table></div>
<style>#f3{font:12pt Arial;color:#000000}</style>
<span style="position:absolute;top:37pt;left:80pt" id=f3><img src="<?php echo base_url(); ?>assets/dist/img/feechallan/<?php echo $BankInfo[0]->LOGONAME?>" style="width:130px; height:35px"><?php //echo $BankInfo[0]->BANKNAME?></span>
<style>#f4{font:9pt Arial;text-decoration:underline;color:#000000}</style>
<span style="position:absolute;top:67pt;left:27pt" id=f4>For Credit of Collection A/C#</span>
<div style="position:absolute;top:67.5pt;left:144.0pt;width:121.5;height:13.5;padding-top:5.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#ffffff;"></div>
<style>#f5{font:bold 8pt Arial;color:#000000}</style>
<span style="position:absolute;top:67pt;left:153pt" id=f5><?php echo $BankInfo[0]->BANKACCOUNTNO?></span>
<style>#f6{font:8pt Arial;color:#000000}</style>
<span style="position:absolute;top:94pt;left:76pt" id=f6><?php echo $viewfeeInfo[0]->CHALLANNO?></span>
<style>#f7{font:bold 8pt Arial;color:#000000}</style>
<span style="position:absolute;top:94pt;left:31pt" id=f7>ChallanNo:</span>
<style>#f1a81a85{color:#000000;}</style>
<div style="position:absolute;top:82pt;left:85pt" id=f7>Semster:<span id=f1a81a85><?php echo $viewfeeInfo[0]->CURRENTSEMESTER?></span></div>
<style>#f8{font:italic 8pt Arial;color:#000000}</style>
<span style="position:absolute;top:94pt;left:184pt" id=f8><?php echo $viewfeeInfo[0]->FEETYPE?></span>
<style>#f9{font:bold 9pt Arial;text-decoration:underline;color:#000000}</style> 
<span style="position:absolute;top:107pt;left:180pt" id=f9><?php echo date("d-m-Y",strtotime($viewfeeInfo[0]->CHALLANDUEDATE))?></span>
<span style="position:absolute;top:107pt;left:139pt" id=f7>DueDate:</span>
<span style="position:absolute;top:107pt;left:36pt" id=f7>Issue Date</span>
<span style="position:absolute;top:107pt;left:81pt" id=f6><?php echo date("d-m-Y",strtotime($viewfeeInfo[0]->created_at))?></span>
<span style="position:absolute;top:120pt;left:36pt" id=f7>RegNo:</span>
<style>#f10{font:8pt Arial;text-decoration:underline;color:#000000}</style>
<span style="position:absolute;top:120pt;left:67pt" id=f10><?php echo $viewfeeInfo[0]->REGNO?></span>
<span style="position:absolute;top:135pt;left:36pt" id=f7>Name:</span>
<span style="position:absolute;top:135pt;left:62pt" id=f4><?php echo $viewfeeInfo[0]->STUDENTNAME?></span>
<span style="position:absolute;top:148pt;left:36pt" id=f7>Father Name:</span>
<style>#f11{font:8pt Arial;text-decoration:underline;color:#000000}</style>
<span style="position:absolute;top:148pt;left:90pt" id=f11><?php echo $viewfeeInfo[0]->FATHERNAME?></span>
<span style="position:absolute;top:162pt;left:36pt" id=f7>Faculty:</span>
<span style="position:absolute;top:162pt;left:67pt" id=f11><?php echo $viewfeeInfo[0]->FACULTY?></span>
<span style="position:absolute;top:175pt;left:36pt" id=f7>Department:</span>
<span style="position:absolute;top:175pt;left:90pt" id=f11><?php echo $viewfeeInfo[0]->DEPARTNAME?></span>
<span style="position:absolute;top:189pt;left:36pt" id=f7>Program:</span>
<span style="position:absolute;top:189pt;left:76pt" id=f11><?php echo $viewfeeInfo[0]->PROGRAME?></span>
<span style="position:absolute;top:202pt;left:36pt" id=f7>Batch:</span>
<span style="position:absolute;top:202pt;left:63pt" id=f11> <?php echo $viewfeeInfo[0]->BATCHNAME?></span>
<!--<span style="position:absolute;top:220pt;left:40pt" id=f7>Code</span>
<span style="position:absolute;top:220pt;left:76pt" id=f7>Courses To Be Studied</span>
<span style="position:absolute;top:220pt;left:215pt" id=f7>C.H</span>-->
<div style="position:absolute;top:238.5pt;left:36.0pt;width:259.1;height:55.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div>
<style>#f12{font:bold 10pt Arial;color:#000000}</style>
<span style="position:absolute;top:239pt;left:40pt" id=f12>Particulars</span>
<span style="position:absolute;top:239pt;left:188pt" id=f12>Amount</span>
<div style="position:absolute;top:238.5pt;left:179.5pt;width:2.8;height:19.5;padding-top:11.8;font:0pt Arial;border-width:0 0 0 1.4; border-style:solid;border-color:#000000;"></div>
<div style="position:absolute;top:252.0pt;left:36.0pt;width:259.1;height:19.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div>
<div style="position:absolute;top:263.0pt;left:36.0pt;width:259.1;height:4.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div>

<?php if($viewfeeInfo[0]->FINEAMOUNT != 0) {?>
<div style="position:absolute;top:277pt;left:36.0pt;width:259.1;height:19.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div> <?php } ?>

<span style="position:absolute;top:252pt;left:40pt" id=f6><?php if(isset($viefeeChallandesc[0]->FEEDESC)) echo $viefeeChallandesc[0]->FEEDESC?></span>
<span style="position:absolute;top:252pt;left:208pt" id=f6><?php if(isset($viefeeChallandesc[0]->FEEAMOUNT)) echo $viefeeChallandesc[0]->FEEAMOUNT?></span>
<span style="position:absolute;top:265pt;left:40pt" id=f6><?php  if(isset($viefeeChallandesc[1]->FEEDESC)) echo $viefeeChallandesc[1]->FEEDESC?></span>
<span style="position:absolute;top:265pt;left:212pt" id=f6><?php if(isset($viefeeChallandesc[1]->FEEAMOUNT)) echo $viefeeChallandesc[1]->FEEAMOUNT?></span>
<span style="position:absolute;top:278pt;left:40pt" id=f6><?php  if(isset($viefeeChallandesc[2]->FEEDESC)) echo $viefeeChallandesc[2]->FEEDESC?></span>
<span style="position:absolute;top:278pt;left:212pt" id=f6><?php if(isset($viefeeChallandesc[2]->FEEAMOUNT)) echo $viefeeChallandesc[2]->FEEAMOUNT?></span>
<div style="position:absolute;top:240.0pt;left:179.5pt;width:2.8;height:57.5;padding-top:11.8;font:0pt Arial;border-width:0 0 0 1.4; border-style:solid;border-color:#000000;"></div>
<?php if($viewfeeInfo[0]->FINEAMOUNT != 0) {?>
<span style="position:absolute;top:292pt;left:40pt" id=f6><?php  if(isset($viewfeeInfo[0]->FINEAMOUNT)) echo 'Fine Amount'?></span>
<span style="position:absolute;top:292pt;left:214pt" id=f6><?php if(isset($viewfeeInfo[0]->FINEAMOUNT)) echo $viewfeeInfo[0]->FINEAMOUNT?></span>
<div style="position:absolute;top:252.0pt;left:179.5pt;width:2.8;height:55.5;padding-top:11.8;font:0pt Arial;border-width:0 0 0 1.4; border-style:solid;border-color:#000000;"></div>
<?php } ?>
<span style="position:absolute;top:302pt;left:204pt" id=f12><?php if(isset($viefeeChallandesc[0]->FEEAMOUNT) && isset($viefeeChallandesc[1]->FEEAMOUNT)) $total = $viefeeChallandesc[0]->FEEAMOUNT+$viefeeChallandesc[1]->FEEAMOUNT+$viefeeChallandesc[2]->FEEAMOUNT+$viewfeeInfo[0]->FINEAMOUNT; echo $total;?></span>
<span style="position:absolute;top:302pt;left:103pt" id=f12>Total Amount:</span>
<div style="position:absolute;top:350.0pt;left:247.5pt;width:265.5;height:2.8;padding-top:-4.8;font:0pt Arial;border-width:1.4 0 0 0; border-style:solid;border-color:#000000;"></div>
<style>#f13{font:10pt Arial;color:#000000}</style>
<span style="position:absolute;top:351pt;left:162pt" id=f13>Cashier(Bank)</span>
<span style="position:absolute;top:351pt;left:31pt" id=f13>Officer (FeeSection)</span>
<span style="position:absolute;top:420pt;left:85pt" id=f12>Bank Copy</span>
<div style="position:absolute;top:0.0pt;left:238.5pt;width:289.5;height:296;padding-top:427.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div>
<div style="position:absolute;top:49.5pt;left:243.0pt;width:271.5;height:19.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#ffffff;"></div>
<span style="position:absolute;top:35pt;left:300pt" id=f3><img src="<?php echo base_url(); ?>assets/dist/img/feechallan/<?php echo $BankInfo[0]->LOGONAME?>" style="width:130px; height:35px"><?php //echo $BankInfo[0]->BANKNAME?></span>
<span style="position:absolute;top:67pt;left:243pt" id=f4>For Credit of Collection A/C#</span>
<div style="position:absolute;top:67.5pt;left:360.0pt;width:121.5;height:13.5;padding-top:5.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#ffffff;"></div>
<span style="position:absolute;top:67pt;left:369pt" id=f5><?php echo $BankInfo[0]->BANKACCOUNTNO?></span>
<style>#f1a81a301{color:#000000;}</style>
<div style="position:absolute;top:81pt;left:301pt" id=f7>Semster:<span id=f1a81a301><?php echo $viewfeeInfo[0]->CURRENTSEMESTER?></span></div>
<span style="position:absolute;top:94pt;left:292pt" id=f6><?php echo $viewfeeInfo[0]->CHALLANNO?></span>
<span style="position:absolute;top:94pt;left:247pt" id=f7>ChallanNo:</span>
<span style="position:absolute;top:94pt;left:400pt" id=f8><?php echo $viewfeeInfo[0]->FEETYPE?></span>
<span style="position:absolute;top:108pt;left:396pt" id=f9><?php echo date("d-m-Y",strtotime($viewfeeInfo[0]->CHALLANDUEDATE))?></span>
<span style="position:absolute;top:108pt;left:350pt" id=f7>DueDate:</span>
<span style="position:absolute;top:108pt;left:252pt" id=f7>Issue Date</span>
<span style="position:absolute;top:108pt;left:297pt" id=f6><?php echo date("d-m-Y",strtotime($viewfeeInfo[0]->created_at))?></span>
<span style="position:absolute;top:121pt;left:252pt" id=f7>RegNo:</span>
<span style="position:absolute;top:121pt;left:283pt" id=f10><?php echo $viewfeeInfo[0]->REGNO?></span>
<span style="position:absolute;top:135pt;left:252pt" id=f7>Name:</span>
<span style="position:absolute;top:135pt;left:278pt" id=f4><?php echo $viewfeeInfo[0]->STUDENTNAME?></span>
<span style="position:absolute;top:148pt;left:252pt" id=f7>Father Name:</span>
<span style="position:absolute;top:148pt;left:306pt" id=f11><?php echo $viewfeeInfo[0]->FATHERNAME?></span>
<span style="position:absolute;top:162pt;left:252pt" id=f7>Faculty:</span>
<span style="position:absolute;top:162pt;left:283pt" id=f11><?php echo $viewfeeInfo[0]->FACULTY?></span>
<span style="position:absolute;top:175pt;left:252pt" id=f7>Department:</span>
<span style="position:absolute;top:175pt;left:306pt" id=f11><?php echo $viewfeeInfo[0]->DEPARTNAME?></span>
<span style="position:absolute;top:189pt;left:252pt" id=f7>Program:</span>
<span style="position:absolute;top:189pt;left:292pt" id=f11><?php echo $viewfeeInfo[0]->PROGRAME?></span>
<span style="position:absolute;top:202pt;left:252pt" id=f7>Batch:</span>
<span style="position:absolute;top:202pt;left:279pt" id=f11> <?php echo $viewfeeInfo[0]->BATCHNAME?></span>
<!--<span style="position:absolute;top:220pt;left:256pt" id=f7>Code</span>
<span style="position:absolute;top:220pt;left:292pt" id=f7>Courses To Be Studied</span>
<span style="position:absolute;top:220pt;left:431pt" id=f7>C.H</span>-->
<div style="position:absolute;top:238.5pt;left:252.0pt;width:259.1;height:19.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div>
<span style="position:absolute;top:239pt;left:256pt" id=f12>Particulars</span>
<span style="position:absolute;top:239pt;left:404pt" id=f12>Amount</span>
<div style="position:absolute;top:239.0pt;left:395.5pt;width:2.8;height:57.5;padding-top:11.8;font:0pt Arial;border-width:0 0 0 1.4; border-style:solid;border-color:#000000;"></div>
<div style="position:absolute;top:252.0pt;left:252.0pt;width:259.1;height:19.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div>
<div style="position:absolute;top:277.0pt;left:252.0pt;width:259.1;height:4.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div>

<?php if($viewfeeInfo[0]->FINEAMOUNT != 0) {?>
<div style="position:absolute;top:290.0pt;left:252.0pt;width:259.1;height:1.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div> <?php } ?>
<span style="position:absolute;top:252pt;left:256pt" id=f6><?php if(isset($viefeeChallandesc[0]->FEEDESC)) echo $viefeeChallandesc[0]->FEEDESC?></span>
<span style="position:absolute;top:252pt;left:424pt" id=f6><?php if(isset($viefeeChallandesc[0]->FEEAMOUNT)) echo $viefeeChallandesc[0]->FEEAMOUNT?></span>
<span style="position:absolute;top:265pt;left:256pt" id=f6><?php if(isset($viefeeChallandesc[1]->FEEDESC)) echo $viefeeChallandesc[1]->FEEDESC?></span>
<span style="position:absolute;top:265pt;left:428pt" id=f6><?php if(isset($viefeeChallandesc[1]->FEEAMOUNT)) echo $viefeeChallandesc[1]->FEEAMOUNT?></span>
<span style="position:absolute;top:280pt;left:256pt" id=f6><?php if(isset($viefeeChallandesc[2]->FEEDESC)) echo $viefeeChallandesc[2]->FEEDESC?></span>
<span style="position:absolute;top:280pt;left:428pt" id=f6><?php if(isset($viefeeChallandesc[2]->FEEAMOUNT)) echo $viefeeChallandesc[2]->FEEAMOUNT?></span>
<?php if($viewfeeInfo[0]->FINEAMOUNT != 0) {?>
<span style="position:absolute;top:292pt;left:256pt" id=f6><?php if(isset($viewfeeInfo[0]->FINEAMOUNT)) echo 'Fine Amount'?></span>
<span style="position:absolute;top:292pt;left:430pt" id=f6><?php if(isset($viewfeeInfo[0]->FINEAMOUNT)) echo $viewfeeInfo[0]->FINEAMOUNT?></span>
<div style="position:absolute;top:265.0pt;left:395.5pt;width:2.8;height:37.5;padding-top:11.8;font:0pt Arial;border-width:0 0 0 1.4; border-style:solid;border-color:#000000;"></div> <?php } ?>
<span style="position:absolute;top:302pt;left:420pt" id=f12><?php if(isset($viefeeChallandesc[0]->FEEAMOUNT))$total = $viefeeChallandesc[0]->FEEAMOUNT+$viefeeChallandesc[1]->FEEAMOUNT+$viefeeChallandesc[2]->FEEAMOUNT+$viewfeeInfo[0]->FINEAMOUNT; echo $total?></span>
<span style="position:absolute;top:302pt;left:325pt" id=f12>Total Amount:</span>
<div style="position:absolute;top:350.0pt;left:31.5pt;width:265.5;height:2.8;padding-top:-4.8;font:0pt Arial;border-width:1.4 0 0 0; border-style:solid;border-color:#000000;"></div>
<span style="position:absolute;top:351pt;left:378pt" id=f13>Cashier(Bank)</span>
<span style="position:absolute;top:351pt;left:247pt" id=f13>Officer(FeeSection)</span>
<span style="position:absolute;top:420pt;left:297pt" id=f12>Account Copy</span>
<div style="position:absolute;top:0.0pt;left:454.5pt;width:289.5;height:290;padding-top:433.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div>
<div style="position:absolute;top:49.5pt;left:459.0pt;width:271.5;height:19.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#ffffff;"></div>
<span style="position:absolute;top:35pt;left:515pt" id=f3><img src="<?php echo base_url(); ?>assets/dist/img/feechallan/<?php echo $BankInfo[0]->LOGONAME?>" style="width:130px; height:35px"><?php //echo $BankInfo[0]->BANKNAME?></span>
<span style="position:absolute;top:67pt;left:459pt" id=f4>For Credit of Collection A/C#</span>
<div style="position:absolute;top:67.5pt;left:576.0pt;width:121.5;height:13.5;padding-top:5.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#ffffff;"></div>
<span style="position:absolute;top:67pt;left:585pt" id=f5><?php echo $BankInfo[0]->BANKACCOUNTNO?></span>
<style>#f1a81a517{color:#000000;}</style>
<div style="position:absolute;top:81pt;left:517pt" id=f7>Semster:<span id=f1a81a517><?php echo $viewfeeInfo[0]->CURRENTSEMESTER?></span></div>
<span style="position:absolute;top:94pt;left:508pt" id=f6><?php echo $viewfeeInfo[0]->CHALLANNO?></span>
<span style="position:absolute;top:94pt;left:463pt" id=f7>ChallanNo:</span>
<span style="position:absolute;top:94pt;left:616pt" id=f8><?php echo $viewfeeInfo[0]->FEETYPE?></span>
<span style="position:absolute;top:108pt;left:612pt" id=f9><?php echo date("d-m-Y",strtotime($viewfeeInfo[0]->CHALLANDUEDATE))?></span>
<span style="position:absolute;top:108pt;left:571pt" id=f7>DueDate:</span>
<span style="position:absolute;top:108pt;left:463pt" id=f7>Issue Date</span>
<span style="position:absolute;top:108pt;left:513pt" id=f6><?php echo date("d-m-Y",strtotime($viewfeeInfo[0]->created_at))?></span>
<span style="position:absolute;top:121pt;left:468pt" id=f7>RegNo:</span>
<span style="position:absolute;top:121pt;left:499pt" id=f10><?php echo $viewfeeInfo[0]->REGNO?></span>
<span style="position:absolute;top:135pt;left:468pt" id=f7>Name:</span>
<span style="position:absolute;top:135pt;left:494pt" id=f4><?php echo $viewfeeInfo[0]->STUDENTNAME?></span>
<span style="position:absolute;top:148pt;left:468pt" id=f7>Father Name:</span>
<span style="position:absolute;top:148pt;left:522pt" id=f11><?php echo $viewfeeInfo[0]->FATHERNAME?></span>
<span style="position:absolute;top:162pt;left:468pt" id=f7>Faculty:</span>
<span style="position:absolute;top:162pt;left:499pt" id=f11><?php echo $viewfeeInfo[0]->FACULTY?></span>
<span style="position:absolute;top:175pt;left:468pt" id=f7>Department:</span>
<span style="position:absolute;top:175pt;left:522pt" id=f11><?php echo $viewfeeInfo[0]->DEPARTNAME?></span>
<span style="position:absolute;top:189pt;left:468pt" id=f7>Program:</span>
<span style="position:absolute;top:189pt;left:508pt" id=f11><?php echo $viewfeeInfo[0]->PROGRAME?></span>
<span style="position:absolute;top:202pt;left:468pt" id=f7>Batch:</span>
<span style="position:absolute;top:202pt;left:495pt" id=f11><?php echo $viewfeeInfo[0]->BATCHNAME?></span>
<!--<span style="position:absolute;top:220pt;left:472pt" id=f7>Code</span>
<span style="position:absolute;top:220pt;left:508pt" id=f7>Courses To Be Studied</span>
<span style="position:absolute;top:220pt;left:647pt" id=f7>C.H</span>-->
<div style="position:absolute;top:238.5pt;left:468.0pt;width:259.1;height:19.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div>
<span style="position:absolute;top:239pt;left:472pt" id=f12>Particulars</span>
<span style="position:absolute;top:239pt;left:620pt" id=f12>Amount</span>
<div style="position:absolute;top:238.5pt;left:611.5pt;width:2.8;height:55.0;padding-top:11.8;font:0pt Arial;border-width:0 0 0 1.4; border-style:solid;border-color:#000000;"></div>
<div style="position:absolute;top:252.0pt;left:468.0pt;width:259.1;height:19.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div>
<div style="position:absolute;top:263.0pt;left:468.0pt;width:259.1;height:19.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div>
<?php if($viewfeeInfo[0]->FINEAMOUNT != 0) {?>
<div style="position:absolute;top:288.0pt;left:468.0pt;width:259.1;height:1.0;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div><?php } ?>
<span style="position:absolute;top:252pt;left:472pt" id=f6><?php if(isset($viefeeChallandesc[0]->FEEDESC)) echo $viefeeChallandesc[0]->FEEDESC?></span>
<span style="position:absolute;top:252pt;left:640pt" id=f6><?php if(isset($viefeeChallandesc[0]->FEEAMOUNT)) echo $viefeeChallandesc[0]->FEEAMOUNT?></span>
<span style="position:absolute;top:265pt;left:472pt" id=f6><?php if(isset($viefeeChallandesc[1]->FEEDESC)) echo $viefeeChallandesc[1]->FEEDESC?></span>
<span style="position:absolute;top:265pt;left:644pt" id=f6><?php if(isset($viefeeChallandesc[1]->FEEAMOUNT)) echo $viefeeChallandesc[1]->FEEAMOUNT?></span>
<span style="position:absolute;top:278pt;left:472pt" id=f6><?php if(isset($viefeeChallandesc[2]->FEEDESC)) echo $viefeeChallandesc[2]->FEEDESC?></span>
<span style="position:absolute;top:278pt;left:644pt" id=f6><?php if(isset($viefeeChallandesc[2]->FEEAMOUNT)) echo $viefeeChallandesc[2]->FEEAMOUNT?></span>
<?php if($viewfeeInfo[0]->FINEAMOUNT != 0) {?>
<span style="position:absolute;top:290pt;left:472pt" id=f6><?php if(isset($viewfeeInfo[0]->FINEAMOUNT)) echo 'Fine Amount'?></span>
<span style="position:absolute;top:290pt;left:646pt" id=f6><?php if(isset($viewfeeInfo[0]->FINEAMOUNT)) echo $viewfeeInfo[0]->FINEAMOUNT?></span>
<div style="position:absolute;top:252.0pt;left:611.5pt;width:2.8;height:52.5;padding-top:11.8;font:0pt Arial;border-width:0 0 0 1.4; border-style:solid;border-color:#000000;"></div><?php } ?>
<span style="position:absolute;top:302pt;left:636pt" id=f12><?php $total = $viefeeChallandesc[0]->FEEAMOUNT+$viefeeChallandesc[1]->FEEAMOUNT+$viefeeChallandesc[2]->FEEAMOUNT+$viewfeeInfo[0]->FINEAMOUNT; echo $total?></span>
<span style="position:absolute;top:302pt;left:535pt" id=f12>Total Amount:</span>
<div style="position:absolute;top:351.0pt;left:463.5pt;width:265.5;height:2.8;padding-top:-4.8;font:0pt Arial;border-width:1.4 0 0 0; border-style:solid;border-color:#000000;"></div>
<span style="position:absolute;top:351pt;left:594pt" id=f13>Cashier(Bank)</span>
<span style="position:absolute;top:351pt;left:463pt" id=f13>Officer(FeeSection)</span>
<span style="position:absolute;top:420pt;left:508pt" id=f12>Academics Copy</span>
<div style="position:absolute;top:0.0pt;left:670.5pt;width:289.5;height:290;padding-top:433.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div>
<div style="position:absolute;top:49.5pt;left:675.0pt;width:271.5;height:19.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#ffffff;"></div>
<span style="position:absolute;top:35pt;left:725pt" id=f3><img src="<?php echo base_url(); ?>assets/dist/img/feechallan/<?php echo $BankInfo[0]->LOGONAME?>" style="width:130px; height:35px"><?php //echo $BankInfo[0]->BANKNAME?></span>
<span style="position:absolute;top:67pt;left:675pt" id=f4>For Credit of Collection A/C#</span>
<div style="position:absolute;top:67.5pt;left:792.0pt;width:121.5;height:13.5;padding-top:5.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#ffffff;"></div>
<span style="position:absolute;top:67pt;left:801pt" id=f5><?php echo $BankInfo[0]->BANKACCOUNTNO?></span>
<style>#f1a81a733{color:#000000;}</style>
<div style="position:absolute;top:81pt;left:733pt" id=f7>Semster:<span id=f1a81a733><?php echo $viewfeeInfo[0]->CURRENTSEMESTER?></span></div>
<span style="position:absolute;top:94pt;left:724pt" id=f6><?php echo $viewfeeInfo[0]->CHALLANNO?></span>
<span style="position:absolute;top:94pt;left:679pt" id=f7>ChallanNo:</span>
<span style="position:absolute;top:94pt;left:828pt" id=f8><?php echo $viewfeeInfo[0]->FEETYPE?></span>
<span style="position:absolute;top:108pt;left:828pt" id=f9><?php echo date("d-m-Y",strtotime($viewfeeInfo[0]->CHALLANDUEDATE))?></span>
<span style="position:absolute;top:108pt;left:787pt" id=f7>DueDate:</span>
<span style="position:absolute;top:108pt;left:679pt" id=f7>Issue Date</span>
<span style="position:absolute;top:108pt;left:729pt" id=f6><?php echo date("d-m-Y",strtotime($viewfeeInfo[0]->created_at))?></span>
<span style="position:absolute;top:121pt;left:684pt" id=f7>RegNo:</span>
<span style="position:absolute;top:121pt;left:715pt" id=f10><?php echo $viewfeeInfo[0]->REGNO?></span>
<span style="position:absolute;top:135pt;left:684pt" id=f7>Name:</span>
<span style="position:absolute;top:135pt;left:710pt" id=f4><?php echo $viewfeeInfo[0]->STUDENTNAME?></span>
<span style="position:absolute;top:148pt;left:684pt" id=f7>Father Name:</span>
<span style="position:absolute;top:148pt;left:738pt" id=f11><?php echo $viewfeeInfo[0]->FATHERNAME?></span>
<span style="position:absolute;top:162pt;left:684pt" id=f7>Faculty:</span>
<span style="position:absolute;top:162pt;left:715pt" id=f11><?php echo $viewfeeInfo[0]->FACULTY?></span>
<span style="position:absolute;top:175pt;left:684pt" id=f7>Department:</span>
<span style="position:absolute;top:175pt;left:738pt" id=f11><?php echo $viewfeeInfo[0]->DEPARTNAME?></span>
<span style="position:absolute;top:189pt;left:684pt" id=f7>Program:</span>
<span style="position:absolute;top:189pt;left:724pt" id=f11><?php echo $viewfeeInfo[0]->PROGRAME?></span>
<span style="position:absolute;top:202pt;left:684pt" id=f7>Batch:</span>
<span style="position:absolute;top:202pt;left:711pt" id=f11> <?php echo $viewfeeInfo[0]->BATCHNAME?></span>
<!--<span style="position:absolute;top:220pt;left:688pt" id=f7>Code</span>
<span style="position:absolute;top:220pt;left:724pt" id=f7>Courses To Be Studied</span>
<span style="position:absolute;top:220pt;left:863pt" id=f7>C.H</span>-->
<div style="position:absolute;top:238.5pt;left:684.0pt;width:259.1;height:19.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div>
<span style="position:absolute;top:239pt;left:688pt" id=f12>Particulars</span>
<span style="position:absolute;top:239pt;left:836pt" id=f12>Amount</span>
<div style="position:absolute;top:238.5pt;left:827.5pt;width:2.8;height:55.0;padding-top:11.8;font:0pt Arial;border-width:0 0 0 1.4; border-style:solid;border-color:#000000;"></div>
<div style="position:absolute;top:252.0pt;left:684.0pt;width:259.1;height:19.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div>
<div style="position:absolute;top:263.0pt;left:684.0pt;width:259.1;height:19.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div>
<?php if($viewfeeInfo[0]->FINEAMOUNT != 0) {?>
<div style="position:absolute;top:288.0pt;left:684.0pt;width:259.1;height:1.0;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div><?php } ?>
<span style="position:absolute;top:252pt;left:688pt" id=f6><?php echo $viefeeChallandesc[0]->FEEDESC?></span>
<span style="position:absolute;top:252pt;left:856pt" id=f6><?php echo $viefeeChallandesc[0]->FEEAMOUNT?></span>
<span style="position:absolute;top:265pt;left:688pt" id=f6><?php echo $viefeeChallandesc[1]->FEEDESC?></span>
<span style="position:absolute;top:265pt;left:861pt" id=f6><?php echo $viefeeChallandesc[1]->FEEAMOUNT?></span>
<span style="position:absolute;top:278pt;left:688pt" id=f6><?php echo $viefeeChallandesc[2]->FEEDESC?></span>
<span style="position:absolute;top:278pt;left:861pt" id=f6><?php echo $viefeeChallandesc[2]->FEEAMOUNT?></span>
<?php if($viewfeeInfo[0]->FINEAMOUNT != 0) {?>
<span style="position:absolute;top:290pt;left:688pt" id=f6><?php echo 'Fine Amount'?></span>
<span style="position:absolute;top:290pt;left:862pt" id=f6><?php echo $viewfeeInfo[0]->FINEAMOUNT?></span>
<div style="position:absolute;top:252.0pt;left:827.5pt;width:2.8;height:52.5;padding-top:11.8;font:0pt Arial;border-width:0 0 0 1.4; border-style:solid;border-color:#000000;"></div> <?php } ?>
<span style="position:absolute;top:302pt;left:852pt" id=f12><?php $total = $viefeeChallandesc[0]->FEEAMOUNT+$viefeeChallandesc[1]->FEEAMOUNT+$viefeeChallandesc[2]->FEEAMOUNT+$viewfeeInfo[0]->FINEAMOUNT; echo $total?></span>
<span style="position:absolute;top:302pt;left:755pt" id=f12>Total Amount:</span>
<div style="position:absolute;top:351.0pt;left:679.0pt;width:265.5;height:2.8;padding-top:-4.8;font:0pt Arial;border-width:1.4 0 0 0; border-style:solid;border-color:#000000;"></div>
<span style="position:absolute;top:351pt;left:679pt" id=f13>Officer(FeeSection)</span>
<span style="position:absolute;top:351pt;left:810pt" id=f13>Cashier(Bank)</span>
<span style="position:absolute;top:420pt;left:747pt" id=f12>Student Copy</span>
<style>#f14{font:bold italic 7pt Times New Roman;color:#000000; margin-left:-13px; margin-top:140px}</style>
<span style="position:absolute;top:430pt;left:35pt" id=f14>IIUI-Hostel&nbsp;</span>
<span style="position:absolute;top:430pt;left:67pt" id=f14>&nbsp;&nbsp;(Auto Generated)</span>
<span style="position:absolute;top:430pt;left:253pt" id=f14>IIUI-Hostel&nbsp;</span>
<span style="position:absolute;top:430pt;left:285pt" id=f14>&nbsp;&nbsp;(Auto Generated)</span>
<span style="position:absolute;top:430pt;left:470pt" id=f14>IIUI-Hostel&nbsp;</span>
<span style="position:absolute;top:430pt;left:502pt" id=f14>&nbsp;&nbsp;(Auto Generated)</span>
<span style="position:absolute;top:430pt;left:685pt" id=f14>IIUI-Hostel&nbsp;</span>
<span style="position:absolute;top:430pt;left:717pt" id=f14>&nbsp;&nbsp;(Auto Generated)</span>
<style>#f15{font:7pt Arial;color:#000000; margin-left:-15px; margin-top:140px}</style>
<span style="position:absolute;top:430pt;left:156pt" id=f15><?php echo date("j F, Y, g:i a");?></span>
<span style="position:absolute;top:430pt;left:121pt" id=f14>Printed On</span>
<span style="position:absolute;top:430pt;left:374pt" id=f15><?php echo date("j F, Y, g:i a");?></span>
<span style="position:absolute;top:430pt;left:340pt" id=f14>Printed On</span>
<span style="position:absolute;top:430pt;left:590pt" id=f15><?php echo date("j F, Y, g:i a");?></span>
<span style="position:absolute;top:430pt;left:556pt" id=f14>Printed On</span>
<span style="position:absolute;top:430pt;left:805pt" id=f15><?php echo date("j F, Y, g:i a");?></span>
<span style="position:absolute;top:430pt;left:771pt" id=f14>Printed On</span>

<?php
}
else
{
echo '<i style="color:red;font-size:20px;font-family:calibri ;">You have an issue in Fee Challan Please Contact Provost Office for Fee Challan.</i><br><br> You will be redirect to previous page shortly !';


header( "refresh:4;url=http://usis.iiu.edu.pk:64453/feechallan/Feechallan/viewfeeDetail" );
 
//exit to prevent the rest of the script from executing
exit;
}
?>

        <script src="<?php echo base_url(); ?>assets/challanassets/print.js"></script>
</body>
</html>
