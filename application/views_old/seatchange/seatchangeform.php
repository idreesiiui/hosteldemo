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
<?php if(!empty($oraclepic[0]->STUDPIC)){ 

					$blobimg = $oraclepic[0]->STUDPIC;
					?>
                  <?php echo '<img src ="data:image/jpeg;base64,'.base64_encode($blobimg).'" style="margin-left: 630px; margin-top: 50px; position:fixed;" width=80 height=80 border=0/>';?>
                 
                 <?php } else {?>
                 		<img src="<?php echo base_url()?>uploads/image/noimg.png" id="pic1" src="#" alt="your image" class="img-thumb" width="80" height="80">
                        <?php }?>
</small>

<h4 class="header2">PROVOST OFFICE BOYS HOSTELS</h4>

<small class="idno" style="text-decoration:underline">ID NO.<?php echo $studInfo['FORMID']; ?></small>

<h4 class="header3">APPLICATION FOR CHANGE HOSTEL SEAT</h4>

<div class="space">
<p><b>Name </b><span class="studinfo" style="background-color:#E4E4E4"><?php echo $studInfo['STUDENTNAME']; ?></span></p>

<p><b>Reg No. </b><span class="studinfo" style="background-color:#E4E4E4"><?php echo $studInfo['REGNO']; ?></span></p>

<p><b>Semester Code. </b><span class="studinfo" style="background-color:#E4E4E4"><?php echo $studInfo['SEMCODE']; ?></span></p>

<p><b>Applied At. </b><span class="studinfo" style="background-color:#E4E4E4"><?php echo $studInfo['CREATEDDTM']; ?> </span></p>

<table style="border:0.5px solid;width:100%;">
	<tr>	<th style="border:0.5px solid">Seat Info</th>
		<th style="border:0.5px solid">Hostel No</th>
		<th style="border:0.5px solid">Room No</th>
		<th style="border:0.5px solid">Seat</th>
        
	</tr>
	<tr>
		<td style="border:0.5px solid; text-align:center" height="20">Existing</td>
		<td style="border:0.5px solid; text-align:center" height="20"><?php echo $studInfo['currenthostelname'].'('.$studInfo['CHOSTEL'].')'; ?></td>
		<td style="border:0.5px solid; text-align:center" height="20"><?php echo $studInfo['CROOM']; ?></td>
        	<td style="border:0.5px solid; text-align:center"height="20"><?php echo $studInfo['CSEAT']; ?></td>
	</tr>
	<tr>
		<td style="border:0.5px solid; text-align:center" height="20">Applied</td>
		<td style="border:0.5px solid; text-align:center" height="20"><?php echo $studInfo['hostel_desc']; ?></td>
		<td style="border:0.5px solid; text-align:center" height="20"><?php echo $studInfo['room_desc']; ?></td>
        	<td style="border:0.5px solid; text-align:center"height="20"><?php echo $studInfo['SEAT1']; ?></td>
	</tr>
	
</table>


<p>Fee Submitted Amount: <?php echo '_____________________'?> Challan No. <?php echo '________________'?> Dated: <?php echo '_________'?></p>
<br>
<p>Signature ___________________________</p>
<p>Student Name <b style="text-decoration:underline"><?php echo $studInfo['STUDENTNAME']; ?></b></p>

<br>
<br>
<b style="margin-left:0px">Checked by Mess Cleark</b><br>
<small style="margin-left:0px; font-style:italic">Signed & Stamped</small>
<span style="margin-left:0px"><?php echo '__________________________'?></span>



<b style="margin-left:500px">Provost Office</b><br>
<small style="margin-left:500px; font-style:italic">Signed & Stamped</small>
<span style="margin-left:500px"><?php echo '__________________________'?></span>
</div>