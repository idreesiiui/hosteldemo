<?php date_default_timezone_set('Asia/Karachi');
if(!empty($viewfeeInfo))
{
?>
<html>
<body dir=LTR bgcolor="#ffffff">
<!-- Created by Oracle Reports  -->

<style>#f1{font:bold 12pt Arial;color:#000000}</style>
<span style="position:absolute;top:4pt;left:38pt" id=f1>International Islamic University, </span>
<span style="position:absolute;top:4pt;left:250pt" id=f1>International Islamic University, </span>
<span style="position:absolute;top:4pt;left:470pt" id=f1>International Islamic University, </span>
<span style="position:absolute;top:4pt;left:686pt" id=f1>International Islamic University, </span>
<style>#f2{font:bold 12pt Arial;text-decoration:underline;color:#000000}</style>
<span style="position:absolute;top:18pt;left:101pt" id=f2>Islamabad</span>
<span style="position:absolute;top:18pt;left:317pt" id=f2>Islamabad</span>
<span style="position:absolute;top:18pt;left:533pt" id=f2>Islamabad</span>
<span style="position:absolute;top:18pt;left:744pt" id=f2>Islamabad</span>

<div style="position:absolute;top:0.0pt;left:22.5pt;width:289.5;height:290;padding-top:427.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"><table></table></div>
<div style="position:absolute;top:49.5pt;left:27.0pt;width:271.5;height:19.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#ffffff;"><table></table></div>
<style>#f3{font:12pt Arial;color:#000000}</style>
<span style="position:absolute;top:49pt;left:64pt" id=f3><?php echo $viewfeeInfo[0]->BANKNAME?></span>
<style>#f4{font:9pt Arial;text-decoration:underline;color:#000000}</style>
<span style="position:absolute;top:67pt;left:27pt" id=f4>For Credit of Collection A/C#</span>
<div style="position:absolute;top:67.5pt;left:144.0pt;width:121.5;height:13.5;padding-top:5.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#ffffff;"></div>
<style>#f5{font:8pt Arial;color:#000000}</style>
<span style="position:absolute;top:67pt;left:153pt" id=f5><?php echo $viewfeeInfo[0]->BANKACCNO?></span>
<style>#f6{font:8pt Arial;color:#000000}</style>
<span style="position:absolute;top:90pt;left:76pt" id=f6><?php echo $viewfeeInfo[0]->CHALLANNO?></span>
<style>#f7{font:bold 8pt Arial;color:#000000}</style>
<span style="position:absolute;top:90pt;left:31pt" id=f7>ChallanNo:</span>
<style>#f1a81a85{color:#000000;}</style>
<div style="position:absolute;top:81pt;left:85pt" id=f7>Semster:<span id=f1a81a85><?php echo $viewfeeInfo[0]->SEMCODE?></span></div>
<style>#f8{font:italic 8pt Arial;color:#000000}</style>
<span style="position:absolute;top:90pt;left:184pt" id=f8>New</span>
<style>#f9{font:bold 9pt Arial;text-decoration:underline;color:#000000}</style>
<span style="position:absolute;top:103pt;left:180pt" id=f9><?php echo $viewfeeInfo[0]->CHALLANDUEDATE?></span>
<span style="position:absolute;top:103pt;left:139pt" id=f7>DueDate:</span>
<span style="position:absolute;top:103pt;left:31pt" id=f7>Issue Date</span>
<span style="position:absolute;top:103pt;left:81pt" id=f7><?php echo $viewfeeInfo[0]->CHALLANDATE?></span>
<span style="position:absolute;top:117pt;left:31pt" id=f7>RegNo:</span>
<style>#f10{font:8pt Arial;text-decoration:underline;color:#000000}</style>
<span style="position:absolute;top:117pt;left:67pt" id=f10><?php echo $viewfeeInfo[0]->REGNO?></span>
<span style="position:absolute;top:135pt;left:36pt" id=f7>Name:</span>
<span style="position:absolute;top:135pt;left:62pt" id=f4><?php echo $viewfeeInfo[0]->STUDENTNAME?></span>
<span style="position:absolute;top:148pt;left:36pt" id=f7>Father Name:</span>
<style>#f11{font:8pt Arial;text-decoration:underline;color:#000000}</style>
<span style="position:absolute;top:148pt;left:90pt" id=f11><?php echo $viewfeeInfo[0]->FATHERNAME?></span>
<span style="position:absolute;top:162pt;left:36pt" id=f7>Faculty:</span>
<span style="position:absolute;top:162pt;left:67pt" id=f11><?php echo $viewfeeInfo[0]->FACULTY?></span>
<span style="position:absolute;top:175pt;left:36pt" id=f7>Department:</span>
<span style="position:absolute;top:175pt;left:90pt" id=f11><?php echo $viewfeeInfo[0]->DEPNAME?></span>
<span style="position:absolute;top:189pt;left:36pt" id=f7>Program:</span>
<span style="position:absolute;top:189pt;left:76pt" id=f11><?php echo $viewfeeInfo[0]->PROGRAME?></span>
<span style="position:absolute;top:202pt;left:36pt" id=f7>Batch:</span>
<span style="position:absolute;top:202pt;left:63pt" id=f11>BS in <?php echo $viewfeeInfo[0]->DEPNAME." ".$viewfeeInfo[0]->BATCHNAME?></span>
<span style="position:absolute;top:220pt;left:40pt" id=f7>Code</span>
<span style="position:absolute;top:220pt;left:76pt" id=f7>Courses To Be Studied</span>
<span style="position:absolute;top:220pt;left:215pt" id=f7>C.H</span>
<div style="position:absolute;top:238.5pt;left:36.0pt;width:259.1;height:19.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div>
<style>#f12{font:bold 10pt Arial;color:#000000}</style>
<span style="position:absolute;top:238pt;left:40pt" id=f12>Particulars</span>
<span style="position:absolute;top:238pt;left:188pt" id=f12>Amount</span>
<div style="position:absolute;top:238.5pt;left:179.5pt;width:2.8;height:19.5;padding-top:11.8;font:0pt Arial;border-width:0 0 0 1.4; border-style:solid;border-color:#000000;"></div>
<div style="position:absolute;top:252.0pt;left:36.0pt;width:259.1;height:19.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div>

<span style="position:absolute;top:252pt;left:40pt" id=f6><?php if(isset($viewfeeInfo[1]->FEEDESC)) echo $viewfeeInfo[1]->FEEDESC?></span>
<span style="position:absolute;top:252pt;left:202pt" id=f6><?php if(isset($viewfeeInfo[1]->FEEAMNT)) echo $viewfeeInfo[1]->FEEAMNT?></span>
<span style="position:absolute;top:265pt;left:40pt" id=f6><?php  if(isset($viewfeeInfo[0]->FEEDESC)) echo $viewfeeInfo[0]->FEEDESC?></span>
<span style="position:absolute;top:265pt;left:200pt" id=f6><?php if(isset($viewfeeInfo[0]->FEEAMNT)) echo $viewfeeInfo[0]->FEEAMNT?></span>
<div style="position:absolute;top:252.0pt;left:179.5pt;width:2.8;height:19.5;padding-top:11.8;font:0pt Arial;border-width:0 0 0 1.4; border-style:solid;border-color:#000000;"></div>
<span style="position:absolute;top:277pt;left:200pt" id=f12><?php if(isset($viewfeeInfo[0]->FEEAMNT) && isset($viewfeeInfo[1]->FEEAMNT)) $total = $viewfeeInfo[0]->FEEAMNT+$viewfeeInfo[1]->FEEAMNT; echo $total;?></span>
<span style="position:absolute;top:277pt;left:103pt" id=f12>Total Amount:</span>
<div style="position:absolute;top:301.0pt;left:31.5pt;width:265.5;height:2.8;padding-top:-4.8;font:0pt Arial;border-width:1.4 0 0 0; border-style:solid;border-color:#000000;"></div>
<style>#f13{font:10pt Arial;color:#000000}</style>
<span style="position:absolute;top:301pt;left:162pt" id=f13>Cashier(Bank)</span>
<span style="position:absolute;top:301pt;left:31pt" id=f13>Officer (FeeSection)</span>
<span style="position:absolute;top:346pt;left:85pt" id=f12>Bank Copy</span>
<div style="position:absolute;top:0.0pt;left:238.5pt;width:289.5;height:290;padding-top:427.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div>
<div style="position:absolute;top:49.5pt;left:243.0pt;width:271.5;height:19.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#ffffff;"></div>
<span style="position:absolute;top:49pt;left:280pt" id=f3><?php echo $viewfeeInfo[0]->BANKNAME?></span>
<span style="position:absolute;top:67pt;left:243pt" id=f4>For Credit of Collection A/C#</span>
<div style="position:absolute;top:67.5pt;left:360.0pt;width:121.5;height:13.5;padding-top:5.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#ffffff;"></div>
<span style="position:absolute;top:67pt;left:369pt" id=f5><?php echo $viewfeeInfo[0]->BANKACCNO?></span>
<style>#f1a81a301{color:#000000;}</style>
<div style="position:absolute;top:81pt;left:301pt" id=f7>Semster:<span id=f1a81a301><?php echo $viewfeeInfo[0]->SEMCODE?></span></div>
<span style="position:absolute;top:94pt;left:292pt" id=f6><?php echo $viewfeeInfo[0]->CHALLANNO?></span>
<span style="position:absolute;top:94pt;left:247pt" id=f7>ChallanNo:</span>
<span style="position:absolute;top:94pt;left:400pt" id=f8>New</span>
<span style="position:absolute;top:108pt;left:396pt" id=f9><?php echo $viewfeeInfo[0]->CHALLANDUEDATE?></span>
<span style="position:absolute;top:108pt;left:350pt" id=f7>DueDate:</span>
<span style="position:absolute;top:108pt;left:252pt" id=f7>Issue Date</span>
<span style="position:absolute;top:108pt;left:297pt" id=f7><?php echo $viewfeeInfo[0]->CHALLANDATE?></span>
<span style="position:absolute;top:121pt;left:252pt" id=f7>RegNo:</span>
<span style="position:absolute;top:121pt;left:283pt" id=f10><?php echo $viewfeeInfo[0]->REGNO?></span>
<span style="position:absolute;top:135pt;left:252pt" id=f7>Name:</span>
<span style="position:absolute;top:135pt;left:278pt" id=f4><?php echo $viewfeeInfo[0]->STUDENTNAME?></span>
<span style="position:absolute;top:148pt;left:252pt" id=f7>Father Name:</span>
<span style="position:absolute;top:148pt;left:306pt" id=f11><?php echo $viewfeeInfo[0]->FATHERNAME?></span>
<span style="position:absolute;top:162pt;left:252pt" id=f7>Faculty:</span>
<span style="position:absolute;top:162pt;left:283pt" id=f11><?php echo $viewfeeInfo[0]->FACULTY?></span>
<span style="position:absolute;top:175pt;left:252pt" id=f7>Department:</span>
<span style="position:absolute;top:175pt;left:306pt" id=f11><?php echo $viewfeeInfo[0]->DEPNAME?></span>
<span style="position:absolute;top:189pt;left:252pt" id=f7>Program:</span>
<span style="position:absolute;top:189pt;left:292pt" id=f11><?php echo $viewfeeInfo[0]->PROGRAME?></span>
<span style="position:absolute;top:202pt;left:252pt" id=f7>Batch:</span>
<span style="position:absolute;top:202pt;left:279pt" id=f11>BS in <?php echo $viewfeeInfo[0]->DEPNAME." ".$viewfeeInfo[0]->BATCHNAME?></span>
<span style="position:absolute;top:220pt;left:256pt" id=f7>Code</span>
<span style="position:absolute;top:220pt;left:292pt" id=f7>Courses To Be Studied</span>
<span style="position:absolute;top:220pt;left:431pt" id=f7>C.H</span>
<div style="position:absolute;top:238.5pt;left:252.0pt;width:259.1;height:19.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div>
<span style="position:absolute;top:238pt;left:256pt" id=f12>Particulars</span>
<span style="position:absolute;top:238pt;left:404pt" id=f12>Amount</span>
<div style="position:absolute;top:238.5pt;left:395.5pt;width:2.8;height:19.5;padding-top:11.8;font:0pt Arial;border-width:0 0 0 1.4; border-style:solid;border-color:#000000;"></div>
<div style="position:absolute;top:252.0pt;left:252.0pt;width:259.1;height:19.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div>
<span style="position:absolute;top:252pt;left:256pt" id=f6><?php if(isset($viewfeeInfo[1]->FEEDESC)) echo $viewfeeInfo[1]->FEEDESC?></span>
<span style="position:absolute;top:252pt;left:420pt" id=f6><?php if(isset($viewfeeInfo[1]->FEEAMNT)) echo $viewfeeInfo[1]->FEEAMNT?></span>
<span style="position:absolute;top:265pt;left:256pt" id=f6><?php if(isset($viewfeeInfo[0]->FEEDESC)) echo $viewfeeInfo[0]->FEEDESC?></span>
<span style="position:absolute;top:265pt;left:420pt" id=f6><?php if(isset($viewfeeInfo[0]->FEEAMNT)) echo $viewfeeInfo[0]->FEEAMNT?></span>
<div style="position:absolute;top:252.0pt;left:395.5pt;width:2.8;height:19.5;padding-top:11.8;font:0pt Arial;border-width:0 0 0 1.4; border-style:solid;border-color:#000000;"></div>
<span style="position:absolute;top:277pt;left:418pt" id=f12><?php if(isset($viewfeeInfo[0]->FEEAMNT))$total = $viewfeeInfo[0]->FEEAMNT+$viewfeeInfo[1]->FEEAMNT; echo $total?></span>
<span style="position:absolute;top:277pt;left:325pt" id=f12>Total Amount:</span>
<div style="position:absolute;top:301.0pt;left:31.5pt;width:265.5;height:2.8;padding-top:-4.8;font:0pt Arial;border-width:1.4 0 0 0; border-style:solid;border-color:#000000;"></div>
<span style="position:absolute;top:301pt;left:378pt" id=f13>Cashier(Bank)</span>
<span style="position:absolute;top:301pt;left:247pt" id=f13>Officer(FeeSection)</span>
<span style="position:absolute;top:346pt;left:297pt" id=f12>Account Copy</span>
<div style="position:absolute;top:0.0pt;left:454.5pt;width:289.5;height:290;padding-top:433.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div>
<div style="position:absolute;top:49.5pt;left:459.0pt;width:271.5;height:19.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#ffffff;"></div>
<span style="position:absolute;top:49pt;left:496pt" id=f3><?php echo $viewfeeInfo[0]->BANKNAME?></span>
<span style="position:absolute;top:67pt;left:459pt" id=f4>For Credit of Collection A/C#</span>
<div style="position:absolute;top:67.5pt;left:576.0pt;width:121.5;height:13.5;padding-top:5.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#ffffff;"></div>
<span style="position:absolute;top:67pt;left:585pt" id=f5><?php echo $viewfeeInfo[0]->BANKACCNO?></span>
<style>#f1a81a517{color:#000000;}</style>
<div style="position:absolute;top:81pt;left:517pt" id=f7>Semster:<span id=f1a81a517><?php echo $viewfeeInfo[0]->SEMCODE?></span></div>
<span style="position:absolute;top:94pt;left:508pt" id=f6><?php echo $viewfeeInfo[0]->CHALLANNO?></span>
<span style="position:absolute;top:94pt;left:463pt" id=f7>ChallanNo:</span>
<span style="position:absolute;top:94pt;left:616pt" id=f8>New</span>
<span style="position:absolute;top:108pt;left:612pt" id=f9><?php echo $viewfeeInfo[0]->CHALLANDUEDATE?></span>
<span style="position:absolute;top:108pt;left:571pt" id=f7>DueDate:</span>
<span style="position:absolute;top:108pt;left:463pt" id=f7>Issue Date</span>
<span style="position:absolute;top:108pt;left:513pt" id=f7><?php echo $viewfeeInfo[0]->CHALLANDATE?></span>
<span style="position:absolute;top:121pt;left:468pt" id=f7>RegNo:</span>
<span style="position:absolute;top:121pt;left:499pt" id=f10><?php echo $viewfeeInfo[0]->REGNO?></span>
<span style="position:absolute;top:135pt;left:468pt" id=f7>Name:</span>
<span style="position:absolute;top:135pt;left:494pt" id=f4><?php echo $viewfeeInfo[0]->STUDENTNAME?></span>
<span style="position:absolute;top:148pt;left:468pt" id=f7>Father Name:</span>
<span style="position:absolute;top:148pt;left:522pt" id=f11><?php echo $viewfeeInfo[0]->FATHERNAME?></span>
<span style="position:absolute;top:162pt;left:468pt" id=f7>Faculty:</span>
<span style="position:absolute;top:162pt;left:499pt" id=f11><?php echo $viewfeeInfo[0]->FACULTY?></span>
<span style="position:absolute;top:175pt;left:468pt" id=f7>Department:</span>
<span style="position:absolute;top:175pt;left:522pt" id=f11><?php echo $viewfeeInfo[0]->DEPNAME?></span>
<span style="position:absolute;top:189pt;left:468pt" id=f7>Program:</span>
<span style="position:absolute;top:189pt;left:508pt" id=f11><?php echo $viewfeeInfo[0]->PROGRAME?></span>
<span style="position:absolute;top:202pt;left:468pt" id=f7>Batch:</span>
<span style="position:absolute;top:202pt;left:495pt" id=f11><?php echo $viewfeeInfo[0]->PROTITTLE?> in <?php echo $viewfeeInfo[0]->DEPNAME." ".$viewfeeInfo[0]->BATCHNAME?></span>
<span style="position:absolute;top:220pt;left:472pt" id=f7>Code</span>
<span style="position:absolute;top:220pt;left:508pt" id=f7>Courses To Be Studied</span>
<span style="position:absolute;top:220pt;left:647pt" id=f7>C.H</span>
<div style="position:absolute;top:238.5pt;left:468.0pt;width:259.1;height:19.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div>
<span style="position:absolute;top:238pt;left:472pt" id=f12>Particulars</span>
<span style="position:absolute;top:238pt;left:620pt" id=f12>Amount</span>
<div style="position:absolute;top:238.5pt;left:611.5pt;width:2.8;height:19.5;padding-top:11.8;font:0pt Arial;border-width:0 0 0 1.4; border-style:solid;border-color:#000000;"></div>
<div style="position:absolute;top:252.0pt;left:468.0pt;width:259.1;height:19.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div>
<span style="position:absolute;top:252pt;left:472pt" id=f6><?php if(isset($viewfeeInfo[1]->FEEDESC)) echo $viewfeeInfo[1]->FEEDESC?></span>
<span style="position:absolute;top:252pt;left:636pt" id=f6><?php if(isset($viewfeeInfo[1]->FEEAMNT)) echo $viewfeeInfo[1]->FEEAMNT?></span>
<span style="position:absolute;top:265pt;left:472pt" id=f6><?php if(isset($viewfeeInfo[0]->FEEDESC)) echo $viewfeeInfo[0]->FEEDESC?></span>
<span style="position:absolute;top:265pt;left:635pt" id=f6><?php if(isset($viewfeeInfo[0]->FEEAMNT)) echo $viewfeeInfo[0]->FEEAMNT?></span>
<div style="position:absolute;top:252.0pt;left:611.5pt;width:2.8;height:19.5;padding-top:11.8;font:0pt Arial;border-width:0 0 0 1.4; border-style:solid;border-color:#000000;"></div>
<span style="position:absolute;top:277pt;left:634pt" id=f12><?php $total = $viewfeeInfo[0]->FEEAMNT+$viewfeeInfo[1]->FEEAMNT; echo $total?></span>
<span style="position:absolute;top:277pt;left:535pt" id=f12>Total Amount:</span>
<div style="position:absolute;top:301.0pt;left:463.5pt;width:265.5;height:2.8;padding-top:-4.8;font:0pt Arial;border-width:1.4 0 0 0; border-style:solid;border-color:#000000;"></div>
<span style="position:absolute;top:301pt;left:594pt" id=f13>Cashier(Bank)</span>
<span style="position:absolute;top:301pt;left:463pt" id=f13>Officer(FeeSection)</span>
<span style="position:absolute;top:351pt;left:508pt" id=f12>Academics Copy</span>
<div style="position:absolute;top:0.0pt;left:670.5pt;width:289.5;height:290;padding-top:433.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div>
<div style="position:absolute;top:49.5pt;left:675.0pt;width:271.5;height:19.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#ffffff;"></div>
<span style="position:absolute;top:49pt;left:712pt" id=f3><?php echo $viewfeeInfo[0]->BANKNAME?></span>
<span style="position:absolute;top:67pt;left:675pt" id=f4>For Credit of Collection A/C#</span>
<div style="position:absolute;top:67.5pt;left:792.0pt;width:121.5;height:13.5;padding-top:5.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#ffffff;"></div>
<span style="position:absolute;top:67pt;left:801pt" id=f5><?php echo $viewfeeInfo[0]->BANKACCNO?></span>
<style>#f1a81a733{color:#000000;}</style>
<div style="position:absolute;top:81pt;left:733pt" id=f7>Semster:<span id=f1a81a733><?php echo $viewfeeInfo[0]->SEMCODE?></span></div>
<span style="position:absolute;top:94pt;left:724pt" id=f6><?php echo $viewfeeInfo[0]->CHALLANNO?></span>
<span style="position:absolute;top:94pt;left:679pt" id=f7>ChallanNo:</span>
<span style="position:absolute;top:94pt;left:828pt" id=f8>New</span>
<span style="position:absolute;top:108pt;left:828pt" id=f9><?php echo $viewfeeInfo[0]->CHALLANDUEDATE?></span>
<span style="position:absolute;top:108pt;left:787pt" id=f7>DueDate:</span>
<span style="position:absolute;top:108pt;left:679pt" id=f7>Issue Date</span>
<span style="position:absolute;top:108pt;left:729pt" id=f7><?php echo $viewfeeInfo[0]->CHALLANDATE?></span>
<span style="position:absolute;top:121pt;left:684pt" id=f7>RegNo:</span>
<span style="position:absolute;top:121pt;left:715pt" id=f10><?php echo $viewfeeInfo[0]->REGNO?></span>
<span style="position:absolute;top:135pt;left:684pt" id=f7>Name:</span>
<span style="position:absolute;top:135pt;left:710pt" id=f4><?php echo $viewfeeInfo[0]->STUDENTNAME?></span>
<span style="position:absolute;top:148pt;left:684pt" id=f7>Father Name:</span>
<span style="position:absolute;top:148pt;left:738pt" id=f11><?php echo $viewfeeInfo[0]->FATHERNAME?></span>
<span style="position:absolute;top:162pt;left:684pt" id=f7>Faculty:</span>
<span style="position:absolute;top:162pt;left:715pt" id=f11><?php echo $viewfeeInfo[0]->FACULTY?></span>
<span style="position:absolute;top:175pt;left:684pt" id=f7>Department:</span>
<span style="position:absolute;top:175pt;left:738pt" id=f11><?php echo $viewfeeInfo[0]->DEPNAME?></span>
<span style="position:absolute;top:189pt;left:684pt" id=f7>Program:</span>
<span style="position:absolute;top:189pt;left:724pt" id=f11><?php echo $viewfeeInfo[0]->PROGRAME?></span>
<span style="position:absolute;top:202pt;left:684pt" id=f7>Batch:</span>
<span style="position:absolute;top:202pt;left:711pt" id=f11>BS in <?php echo $viewfeeInfo[0]->DEPNAME." ".$viewfeeInfo[0]->BATCHNAME?></span>
<span style="position:absolute;top:220pt;left:688pt" id=f7>Code</span>
<span style="position:absolute;top:220pt;left:724pt" id=f7>Courses To Be Studied</span>
<span style="position:absolute;top:220pt;left:863pt" id=f7>C.H</span>
<div style="position:absolute;top:238.5pt;left:684.0pt;width:259.1;height:19.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div>
<span style="position:absolute;top:238pt;left:688pt" id=f12>Particulars</span>
<span style="position:absolute;top:238pt;left:836pt" id=f12>Amount</span>
<div style="position:absolute;top:238.5pt;left:827.5pt;width:2.8;height:19.5;padding-top:11.8;font:0pt Arial;border-width:0 0 0 1.4; border-style:solid;border-color:#000000;"></div>
<div style="position:absolute;top:252.0pt;left:684.0pt;width:259.1;height:19.5;padding-top:11.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#000000;"></div>
<span style="position:absolute;top:252pt;left:688pt" id=f6><?php echo $viewfeeInfo[1]->FEEDESC?></span>
<span style="position:absolute;top:252pt;left:851pt" id=f6><?php echo $viewfeeInfo[1]->FEEAMNT?></span>
<span style="position:absolute;top:265pt;left:688pt" id=f6><?php echo $viewfeeInfo[0]->FEEDESC?></span>
<span style="position:absolute;top:265pt;left:850pt" id=f6><?php echo $viewfeeInfo[0]->FEEAMNT?></span>
<div style="position:absolute;top:252.0pt;left:827.5pt;width:2.8;height:19.5;padding-top:11.8;font:0pt Arial;border-width:0 0 0 1.4; border-style:solid;border-color:#000000;"></div>
<span style="position:absolute;top:277pt;left:848pt" id=f12><?php $total = $viewfeeInfo[0]->FEEAMNT+$viewfeeInfo[1]->FEEAMNT; echo $total?></span>
<span style="position:absolute;top:277pt;left:755pt" id=f12>Total Amount:</span>
<div style="position:absolute;top:301.0pt;left:563.5pt;width:265.5;height:2.8;padding-top:-4.8;font:0pt Arial;border-width:1.4 0 0 0; border-style:solid;border-color:#000000;"></div>
<span style="position:absolute;top:301pt;left:679pt" id=f13>Officer(FeeSection)</span>
<span style="position:absolute;top:301pt;left:810pt" id=f13>Cashier(Bank)</span>
<span style="position:absolute;top:351pt;left:747pt" id=f12>Student Copy</span>
<style>#f14{font:bold italic 7pt Times New Roman;color:#000000; margin-left:-13px}</style>
<span style="position:absolute;top:430pt;left:40pt" id=f14>IIUI-Hostel&nbsp;</span>
<span style="position:absolute;top:430pt;left:72pt" id=f14>&nbsp;&nbsp;(Auto Generated)</span>
<span style="position:absolute;top:430pt;left:261pt" id=f14>IIUI-Hostel&nbsp;</span>
<span style="position:absolute;top:430pt;left:292pt" id=f14>&nbsp;&nbsp;(Auto Generated)</span>
<span style="position:absolute;top:430pt;left:477pt" id=f14>IIUI-Hostel&nbsp;</span>
<span style="position:absolute;top:430pt;left:508pt" id=f14>&nbsp;&nbsp;(Auto Generated)</span>
<span style="position:absolute;top:430pt;left:693pt" id=f14>IIUI-Hostel&nbsp;</span>
<span style="position:absolute;top:430pt;left:724pt" id=f14>&nbsp;&nbsp;(Auto Generated)</span>
<style>#f15{font:7pt Arial;color:#000000; margin-left:-15px}</style>
<span style="position:absolute;top:430pt;left:162pt" id=f15><?php echo date("j F, Y, g:i a");?></span>
<span style="position:absolute;top:430pt;left:126pt" id=f14>Printed On</span>
<span style="position:absolute;top:430pt;left:382pt" id=f15><?php echo date("j F, Y, g:i a");?></span>
<span style="position:absolute;top:430pt;left:346pt" id=f14>Printed On</span>
<span style="position:absolute;top:430pt;left:598pt" id=f15><?php echo date("j F, Y, g:i a");?></span>
<span style="position:absolute;top:430pt;left:562pt" id=f14>Printed On</span>
<span style="position:absolute;top:430pt;left:814pt" id=f15><?php echo date("j F, Y, g:i a");?></span>
<span style="position:absolute;top:430pt;left:778pt" id=f14>Printed On</span>

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

</body>
</html>
