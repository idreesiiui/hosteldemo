<style>
.header{
font-family:Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, sans-serif;
 margin-left:80px;
 font-size:20px;
  line-height:5px;	
}
.header2{	
 font-family:Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, sans-serif;
 margin-left:230px;	
 line-height:5px;
}
.idno{
 margin-left:0px;
 line-height:0px;
}
.pic{
 margin-left:600px;
 line-height:0px;
}
.header3{
 margin-left:220px;
 line-height:3px;
 font-size:15px; 	
}
.studinfo{
	text-decoration:underline;
}
.space{
	line-height:20px;
}
.pos{
	font-size:14px;
}
</style>
<h3 class="header">INTERNATIONAL ISLAMIC UNIVERSITY ISLAMABAD</h3>

<small class="pic">
<?php if(!empty($studInfo[0]->REGNO)){ 

					$blobimg = $oraclepic[0]->STUDPIC;
					?>
                  <?php echo '<img src ="data:image/jpeg;base64,'.base64_encode($blobimg).'" style="margin-left: 630px; margin-top: 50px; position:fixed;" width=80 height=80 border=0/>';?>
                 
                 <?php } else {?>
                 		<img src="<?php echo base_url()?>uploads/image/noimg.png" id="pic1" src="#" alt="your image" class="img-thumb" width="80" height="80">
                        <?php }?>
</small>

<h4 class="header2">PROVOST OFFICE <?php if($studInfo[0]->GENDER == 'Male') echo 'BOYS'; else echo 'GIRLS'?> HOSTELS</h4>

<small class="idno" style="text-decoration:underline">ID NO.<?php echo '<b>'.$RenewalId[0]->REALLOTMENT_ID.'</b>'?></small>

<h4 class="header3">HOSTEL SEAT RENEWAL FORM <small style="text-decoration:underline"><?php echo strtoupper($semcode)?></small></h4>

<p class="space">
<b>Name </b><span class="studinfo" style="background-color:#E4E4E4"><?php echo $studInfo[0]->STUDENTNAME?></span>

<b>Reg No. </b><span class="studinfo" style="background-color:#E4E4E4"><?php echo $studInfo[0]->REGNO?></span>

<b>Valid Contact No. </b><span class="studinfo" style="background-color:#E4E4E4"><?php if(strlen($studInfo[0]->mobile) > 9)echo $studInfo[0]->mobile; else echo '________________'?></span>
</p>
<p>
<b>Valid Email </b><span class="studinfo" style="background-color:#E4E4E4; font-size:9px" ><?php echo $studInfo[0]->EMAIL?></span>
<b>Room Details. Occuped Room No. </b><span class="studinfo" style="background-color:#E4E4E4"><?php echo $studInfo[0]->ROOMDESC?></span>
<b>Seat </b><span class="studinfo" style="background-color:#E4E4E4"><?php echo $studInfo[0]->SEAT?></span>
<b>Hostel No. </b><span class="studinfo" style="background-color:#E4E4E4"><?php echo $studInfo[0]->HOSTEL_NO?></span>
</p>
<P>
<b class="space">Emergency Contact </b><span class="studinfo"><?php echo '____________________________________________________________________________________'?></span>
</P>
<h4 class="studinfo">Courses Registration Detail</h4>
<p>
<b>Degree Level: </b><span class="studinfo" style="background-color:#E4E4E4"><?php echo $studInfo[0]->PROTITTLE?></span>
<b>NO. of Courses </b><span class="studinfo" style="background-color:#E4E4E4"><?php if(!empty($coursename[0]->COURSENAME)) echo $coursename[0]->COURSENAME; else echo '________'?></span>
<b>No. of Credit Hours </b><span class="studinfo" style="background-color:#E4E4E4"><?php if(!empty($studTotalCredit)) echo $studTotalCredit; else echo '________'?></span>
</p>
<span style="margin-left:550px"><?php echo '__________________'?></span>
<b style="margin-left:550px">Signature of Student</b>
<hr>

<p>In case of Excemption in Hostel Dues only</p>

<?php if($studInfo[0]->GENDER == 'Male'){ ?>

<small>He is being sponsored by <?php echo '________________________________________________________________________________'?></small>
<?php }else{ ?>

<small>She is being sponsored by <?php echo '________________________________________________________________________________'?></small>
<?php	} ?>
<small style="font-size:12px">(mention the name of agency)</small>
<br><br>
<small class="studinfo">Sign & Stamp</small>

<?php if($studInfo[0]->GENDER == 'Male'){ ?>
<small class="studinfo" style="margin-left:270px">Sign & Stamp</small><br>
<?php } ?>

<small style="font-size:12px">Asst. Director/Dy.Director (Fee Section)<?php echo '_________________________'?></small>

<?php if($studInfo[0]->GENDER == 'Male'){ ?>
<small style="font-size:12px"> Addl. Director (Academics)<?php echo '_______________________'?></small>
<?php } ?>

<hr>
<?php if($studInfo[0]->GENDER == 'Male'){ ?>

<p>It is Verfied that MESS Bill Cleared & student is actually residing on his hostel seat.</p>
<?php }else{ ?>
<p>It is Verfied that this student is actually residing on her hostel seat.</p>

<?php } ?>

<br><br>
<small class="studinfo"><?php echo '_________________________'?></small>
<small class="studinfo" style="margin-left:274px"><?php echo '____________________'?></small><br>

<?php if($studInfo[0]->GENDER == 'Male'){ ?>

<small style="font-size:16px">Hostel Clerk (Sign & Stamp)<span style="margin-left:270px">R.H.T (Sign & Stamp)</span></small>
<?php } else { ?>

<small style="font-size:16px">Hostel Clerk (Sign & Stamp)<span style="margin-left:270px">ALWs (Sign & Stamp)</span></small>
<?php } ?>

<hr>
<p>All terms and conditions contained in the hostel admission form already signed by the student shall remain enforced.</p>
<hr>
<h4 class="studinfo" style=" line-height:3px">For Office Use only</h4>
<table style="border:0.5px solid;width:100%;">
	<tr>
		<th style="border:0.5px solid">Room No.-Seat</th>
		<th style="border:0.5px solid">Type of Room</th>
		<th style="border:0.5px solid">Hostel Block</th>
        <th style="border:0.5px solid">Remarks</th>
	</tr>
	<tr>
		<td style="border:0.5px solid; text-align:center" height="20"><?php echo $studInfo[0]->ROOMDESC.'-'.$studInfo[0]->SEAT?></td>
		<td style="border:0.5px solid; text-align:center" height="20"><?php echo $studInfo[0]->ROOMTYPE?></td>
		<td style="border:0.5px solid; text-align:center" height="20"><?php echo $studInfo[0]->HOSTEL_NO?></td>
        <td style="border:0.5px solid; text-align:center"height="20">Renewal <?php echo $semcode?></td>
	</tr>
</table>
<br>
<small style="margin-left:440px;">(INSTRUCTIONS/GUIDLINES OVERLEAF)</small>


<h3 class="header" style="text-decoration:underline; line-height:4px">INSTRUCTIONS/GUIDLINES TO BE FOLLOWED</h3>
<h4 class="studinfo" style="line-height:1px">First Step</h4>
<ul class="pos">
  <li>Open the link www.iiu.edu.pk/hostel</li>
  <li>Click on the <?php echo $studInfo[0]->GENDER?> Hostel and then on Hostel Seat Renewal to open sign in Window.</li>
  <li>Enter User Name (i.e. CNIC/ Email/ Registration No./ Passport No.). In case you have forgotten your password, click on “Forget Password” link (See video tutorials available link <b>http://usis.iiu.edu.pk:64453/tutorials/</b>)</li>
  <li>After Log In , Print Hostel Fee Challan </li>
  <li>Pay the Fee in the designated Bank. </li>
  <li>Enter fee Challan details (Payment Date, Amount, Bank Name etc.), then click submit button. “Task Completed” Window will appear. Now print your Renewal Form by clicking print Renewal Form button</li>
</ul>
<h4 class="studinfo" style="line-height:1px">Second Step</h4>
<ul style="margin-left:3px" class="pos"><b>Attached following Documents with printed Forms:</b>
	<li>Original Hostel Card</li>
    <li>Original paid Hostel Challan</li>
</ul>
<h4 class="studinfo" style="line-height:1px">Third Step</h4>
<ul class="pos">
	<li>Please ensure that the required documents are attached.</li>
    <li>Attached documents are to be marked on below check list.</li>
    <li>Duly filled form is to be submitted to concerned hostel clerk.</li>
    <li>Forms are strictly to be submitted in-person, no proxy submission shall be accepted.</li>
    <li>Receipt is to be collected from concerned hostel clerk after valid submission.</li>
    <li>Hostel card is to be collected by returning receipt to concerned clerk after specified time.</li>
</ul>
<h4 class="studinfo" style="line-height0px; margin-left:200px; text-decoration:underline">IMPORTANT ATTACHMENTS</h4>
<p class="pos">Before subitting the renewal form, please tick mark following check list to ensure that the requisite/demanded documents are attached. Incomplete form shall not be entertained.</p>
<h4 class="studinfo" style="line-height:1px; margin-left:250px; text-decoration:underline">CHECK LIST</h4>
<table style="border:0.5px solid;width:100%;" class="pos">
	<tr>
		<th style="border:0.5px solid">S.No.</th>
		<th style="border:0.5px solid">Requirements</th>
		<th style="border:0.5px solid">Tick Mark</th>
	</tr>
	<tr>
		<td style="border:0.5px solid; text-align:center;" height="20">1</td>
		<td style="border:0.5px solid; text-align:center;" height="20">Original Hostel Card</td>
		<td style="border:0.5px solid; text-align:center;" height="20"></td>
	</tr>
    <tr>
		<td style="border:0.5px solid; text-align:center;" height="20">2</td>
		<td style="border:0.5px solid; text-align:center;" height="20">Renewal Form</td>
		<td style="border:0.5px solid; text-align:center;" height="20"></td>
	</tr>
    <tr>
		<td style="border:0.5px solid; text-align:center;" height="20">3</td>
		<td style="border:0.5px solid; text-align:center;" height="20">Original paid Hostel Challan</td>
		<td style="border:0.5px solid; text-align:center;" height="20"></td>
	</tr>
</table>
<br>
<small class="pic">
<?php if(!empty($studInfo[0]->REGNO)){ 

					$blobimg = $oraclepic[0]->STUDPIC;
					?>
                  <?php echo '<img src ="data:image/jpeg;base64,'.base64_encode($blobimg).'" style="margin-left: 650px; position:fixed; 
margin-top: 800px;" width=80 height=80 border=0/>';?>
                 
                 <?php } else {?>
                 		<img src="<?php echo base_url()?>uploads/image/noimg.png" id="pic1" src="#" alt="your image" class="img-thumb" width="80" height="80">
                        <?php }?>
</small>
<span style="margin-left:550px"><?php echo '__________________'?></span>
<b style="margin-left:550px">Signature of Student</b>
<hr>

<h4 class="studinfo" style="line-height:4px; margin-left:270px; text-decoration:underline; font-size:13px">RECEIPT</h4>

<p>Form Received by <?php echo '_____________________'?> Date <?php echo '________________'?> Time <?php echo '_________'?></p>
<p> Student Name <?php echo '<b class="studinfo" style="background-color:#E4E4E4">'.$studInfo[0]->STUDENTNAME.'</b>'?> Hostel No. <?php echo '<b class="studinfo" style="background-color:#E4E4E4">'.$studInfo[0]->HOSTEL_NO.'</b>'?>&nbsp;
ROOM No. <?php echo '<b class="studinfo" style="background-color:#E4E4E4">'.$studInfo[0]->ROOMDESC.'</b>'?> seat <?php echo '<b class="studinfo" style="background-color:#E4E4E4">'.$studInfo[0]->SEAT.'</b>'?></p>
<P>Registration No. <?php echo '<b class="studinfo" style="background-color:#E4E4E4">'.$studInfo[0]->REGNO.'</b>'?> Signature & Stamp <?php echo '__________________'; ?> Semester: <b style="text-decoration:underline; background-color:#E4E4E4""><?php echo strtoupper($semcode)?></b> </P>
<small>*** This receipt will be valid only till the issuanace of hostel card and must be returned to hostel clerk at the time of collection of Hostel Card.</small>


<!--<p style="page-break-after: always;">&nbsp;</p>-->

<small style="margin-left:440px;">(INSTRUCTIONS/GUIDLINES OVERLEAF)</small>


<h3 class="header" style="line-height:4px">INTERNATIONAL ISLAMIC UNVERSITY ISLAMABAD</h3>
<h4 class="studinfo" style="line-height:1px; margin-left:30%">PROVOST OFFICE <?php echo strtoupper($studInfo[0]->GENDER)?> HOSTELS</h4>
<h4 class="studinfo" style="margin-left:10%">DECLARATION FOR USAGE OF ADDITIONAL ELECTRICITY APPLIANCES</h4>
<p>I am using / not using following additional appliances in my Room No. <b><?php echo $studInfo[0]->ROOMDESC?></b> Hostel No. <b><?php echo $studInfo[0]->HOSTEL_NO?></b> for which i am liable to pay additional charges if any to University as per IIU Rules and Regulations:</p>
<table style="border:0.5px solid;width:100%;" class="pos">
	<tr>
		<th style="border:0.5px solid">S.No.</th>
		<th style="border:0.5px solid">Name of Appliances</th>
		<th style="border:0.5px solid">Yes</th>
        <th style="border:0.5px solid">No</th>
	</tr>
	<tr>
		<td style="border:0.5px solid; text-align:center;" height="20">1</td>
		<td style="border:0.5px solid; text-align:center;" height="20">Refrigerator</td>
		<td style="border:0.5px solid; text-align:center;" height="20"><?php if($studitem->REFRIGERATOR == 'Yes') echo 'Yes'?></td>
        <td style="border:0.5px solid; text-align:center;" height="20"><?php if($studitem->REFRIGERATOR == 'No') echo 'No'?></td>
	</tr>
    <tr>
		<td style="border:0.5px solid; text-align:center;" height="20">2</td>
		<td style="border:0.5px solid; text-align:center;" height="20">Iron</td>
		<td style="border:0.5px solid; text-align:center;" height="20"><?php if($studitem->IRON == 'Yes') echo 'Yes'?></td>
        <td style="border:0.5px solid; text-align:center;" height="20"><?php if($studitem->IRON == 'No') echo 'No'?></td>
	</tr>
    <tr>
		<td style="border:0.5px solid; text-align:center;" height="20">3</td>
		<td style="border:0.5px solid; text-align:center;" height="20">Electrical Cooking Pot</td>
		<td style="border:0.5px solid; text-align:center;" height="20"><?php if($studitem->ELECTRICPOT == 'Yes') echo 'Yes'?></td>
        <td style="border:0.5px solid; text-align:center;" height="20"><?php if($studitem->ELECTRICPOT == 'No') echo 'No'?></td>
	</tr>
    <tr>
		<td style="border:0.5px solid; text-align:center;" height="20">4</td>
		<td style="border:0.5px solid; text-align:center;" height="20">Room Cooler</td>
		<td style="border:0.5px solid; text-align:center;" height="20"><?php if($studitem->ROOMCOOLER == 'Yes') echo 'Yes'?></td>
        <td style="border:0.5px solid; text-align:center;" height="20"><?php if($studitem->ROOMCOOLER == 'No') echo 'No'?></td>
	</tr>
    <tr>
		<td style="border:0.5px solid; text-align:center;" height="20">5</td>
		<td style="border:0.5px solid; text-align:center;" height="20">Air Conditioner (if Allowed)</td>
		<td style="border:0.5px solid; text-align:center;" height="20"><?php if($studitem->AIRCONDITION == 'Yes') echo 'Yes'?></td>
        <td style="border:0.5px solid; text-align:center;" height="20"><?php if($studitem->AIRCONDITION == 'No') echo 'No'?></td>
	</tr>
     <tr>
		<td style="border:0.5px solid; text-align:center;" height="20">6</td>
		<td style="border:0.5px solid; text-align:center;" height="20">Electric Heater</td>
		<td style="border:0.5px solid; text-align:center;" height="20"><?php if($studitem->EHEATER == 'Yes') echo 'Yes'?></td>
        <td style="border:0.5px solid; text-align:center;" height="20"><?php if($studitem->EHEATER == 'No') echo 'No'?></td>
	</tr>
     <tr>
		<td style="border:0.5px solid; text-align:center;" height="20">7</td>
		<td style="border:0.5px solid; text-align:center;" height="20">Oven</td>
		<td style="border:0.5px solid; text-align:center;" height="20"><?php if($studitem->OVEN == 'Yes') echo 'Yes'?></td>
        <td style="border:0.5px solid; text-align:center;" height="20"><?php if($studitem->OVEN == 'No') echo 'No'?></td>
	</tr>
	</tr>
     <tr>
		<td style="border:0.5px solid; text-align:center;" height="20">8</td>
		<td style="border:0.5px solid; text-align:center;" height="20">Washing Machine</td>
		<td style="border:0.5px solid; text-align:center;" height="20"><?php if($studitem->WASHINGM =='Yes') echo 'Yes'?></td>
        <td style="border:0.5px solid; text-align:center;" height="20"><?php if($studitem->WASHINGM == 'No') echo 'No'?></td>
	</tr>
	</tr>
     <tr>
		<td style="border:0.5px solid; text-align:center;" height="20">9</td>
		<td style="border:0.5px solid; text-align:center;" height="20">Electric Kettel</td>
		<td style="border:0.5px solid; text-align:center;" height="20"><?php if($studitem->EKETTLE == 'Yes') echo 'Yes'?></td>
        <td style="border:0.5px solid; text-align:center;" height="20"><?php if($studitem->EKETTLE == 'No') echo 'No'?></td>
	</tr>
</table>
<br><br>
<p>Signature ___________________________</p>
<p>Student Name <b style="text-decoration:underline"><?php echo $studInfo[0]->STUDENTNAME?></b></p>
<p>Regno <b style="text-decoration:underline"><?php echo $studInfo[0]->REGNO?></b></p>
<p>Room/seat No. <b style="text-decoration:underline"><?php echo $studInfo[0]->ROOMDESC.'/'.$studInfo[0]->SEAT?></b></p>
<p>Hostel No <b style="text-decoration:underline"><?php echo $studInfo[0]->HOSTEL_NO?></b></p>
<br><br>
<span style="margin-left:0px"><?php echo '________________'?></span><br>
<b style="margin-left:0px">Checked by ARHT</b><br>
<small style="margin-left:0px; font-style:italic">Signed & Stamped</small>
<span style="margin-left:500px"><?php echo '__________________________'?></span>
<?php if($studInfo[0]->GENDER == 'Male'){ ?>

	<b style="margin-left:500px">Verified & Confirmed by RHT</b>
<?php } else { ?>

	<b style="margin-left:500px">Verified & Confirmed by ALW</b>
<?php } ?>

<small style="margin-left:540px; font-style:italic">Signed & Stamped</small>