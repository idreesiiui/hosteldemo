<html>
<head>
<style>
body {
  margin: 0px;
  
}
.underline{
	text-decoration:underline;
}
.logoiiu {
	height:30pt;
	width:30pt;
	position:absolute;
	margin: 4px 3px;	
}
.header{
    position:absolute; color:#000000; font:bold 10pt Arial;margin-top: 4px;
    margin-left: 50px;
}
.tittle{
	position:absolute; color:#000000; font:bold italic 9pt Arial;margin-top: 22px;
    margin-left: 105px;
}
.idcard{
	position:absolute; color:#000000; font:bold 10pt Arial; text-decoration:underline;margin-top: 43px;
    margin-left: 243px;
}
.name{
	position:absolute; color:#000000; font:bold 10pt Arial; margin-top: 50px;
    margin-left: 12px;
}
.fname{
	position:absolute; color:#000000; font:bold 10pt Arial; margin-top: 65px;
    margin-left: 12px;
}
.reg{
	position:absolute; color:#000000; font:bold 10pt Arial; margin-top: 81px;
    margin-left: 12px;
}
.pic{
	position:absolute; color:#000000; font:bold 10pt Arial; margin-top: 89px;
    margin-left: 75px; float:right;
}
.signaturemale{
	position:absolute; font:bold 10pt Arial; margin-top: 144px;
    margin-left: 217px;float:right;
}
.signaturefmale{
	position:absolute; font:bold 10pt Arial; margin-top: 124px;
    margin-left: 217px;float:right;
}
.signatureprovost{
	position:absolute; font:bold 10pt Arial; margin-top: 175px;
    margin-left:206px;float:right;
}
.room{
	position:absolute; color:#000000; font:bold 10pt Arial; margin-top: 98px;
    margin-left: 12px;
}
.hostelbg{
	position:absolute; color:#3390FF; font:bold 18pt Arial; margin-top: 120px;
    margin-left: 105px;opacity: 0.4; 
}
.issue{
	position:absolute; color:#000000; font:bold 10pt Arial; margin-top: 116px;
    margin-left: 12px;
}
.valid{
	position:absolute; color:#000000; font:bold 10pt Arial; margin-top: 134px;
    margin-left: 12px;
}
.remarks{
	position:absolute; color:#000000; font:bold 10pt Arial; margin-top: 153px;
    margin-left: 12px;
}
.email{
	position:absolute; color:#000000; font:bold 10pt Arial; margin-top: 170px;
    margin-left: 12px;
}
.barcode{
	position:absolute; color:#000000; font:bold 10pt Arial; margin-top: 30px;
    margin-left: 12px; font-size:10px;
}
.instruction{
	position:absolute; color:#000000; font:bold 11pt Italic; margin-top: 70px;
    margin-left: 12px;
}
.emailback{
	position:absolute; color:#000000; font:bold 9pt Italic; margin-top: 57px;
    margin-left: 12px;
}
.cond{
	position:absolute; color:#000000; font:bold 6pt Italic; margin-top: 90px;
    margin-left: 12px;
}

@media print
{    
    .no-print, .no-print *
    {
        display: none !important;
		
    }
	
}

</style>
</head>
<body>
<button onclick="myFunction()" class="no-print" style=" 
border: 1px solid black;padding: 8px 15px;text-align: center;text-decoration: none;font-size: 16px;margin: 4px 2px;cursor: pointer;     position: absolute;
    right: 13em;"><img src="<?php echo base_url() ?>/assets/images/print.png" width=30 height=30 style="position: relative; top: 1px;left: -8px;margin-bottom: -7px;" >Print</button>
<?php if(!empty($viewcardsInfo)) {
	
	//echo count($viewcardsInfo);exit();
	
foreach($viewcardsInfo as $viewcard )
{
?>

<div>

<!--<img src="<?php //echo base_url() ?>/uploads/image/iiui.png" class="logoiiu">-->
<span class="header">International Islamic University, Islamabad</span>
<div class="tittle">Office of <?php echo $viewcard['gender'] ?> Provost</div>
<div class="idcard">ID:<?php echo $viewcard['id'] ?></div>
<div class="name">Name <?php echo '<b class="underline">'.$viewcard['name'].'</b>'?></div>
<div class="fname">Father's Name <?php echo '<b class="underline">'.$viewcard['fathername'].'</b>'?></div>
<div class="pic">
<?php if(!empty($viewcard['id']) && !empty($viewcard['pic'])){ 
	if(!empty($viewcard['id']) && !empty($viewcard['pic']) && $viewcard['pic'] != null && $cardpic!= ''){
					$blobimg = $viewcard['pic'];
					?>
                  <?php echo '<img src ="data:image/jpeg;base64,'.base64_encode($blobimg).'" style="margin-left: 218%;margin-top: 0%;" width=75 height=75 border=0/>';?>
                 
                 <?php } else {?>
                 		<img src="<?php echo base_url()?>uploads/image/noimg.png" id="pic1" src="#" alt="your image" class="img-thumb" width="75" height="75" style="margin-left: 218%; margin-top: 0%;padding:1px; border:1px solid #021a40;">
                        <?php }?>
</div>
<?php if($viewcard['gender'] == 'Male') {?>
<div class ="signaturemale">
<img src="<?php echo base_url()?>uploads/image/signature.png"  src="#" alt="your image" class="img-thumb" width="100" height="55" >
</div>
<?php }?>
<?php if($viewcard['gender'] == 'Female') {?>
<div class = "signaturefmale">
<img src="<?php echo base_url()?>uploads/image/fsignature.png"  src="#" alt="your image" style="position: relative; top:13pt;left:8pt;" class="img-thumb" width="100" height="45" >
</div>
<?php }?>
<div class = "signatureprovost" >Signature Provost</div>
<div  class = "room" >Room-Seat/Hostel <?php echo '<b class="underline">'.$viewcard['roomdesc'].'-'.$viewcard['seat'].'/'.$viewcard['hostelno'].'</b>'?></div>
<div class="hostelbg">Hostel <?php echo $viewcard['hostelno']?></div>
<div class="issue">Issued On <?php echo '<b class="underline">'.date("d-m-Y",strtotime($viewcard['issuedate'])).'</b>'?></div>
<div class="valid">Valid Upto 
<?php if($viewcard['gender'] == 'Male') {?>
	<?php echo '<b class="underline" style="color:red">'.date("d-m-Y",strtotime($viewcard['expdate'])).'</b>'?>
<?php } elseif ($viewcard['gender'] == 'Female') { 

	$CI =& get_instance();
					   $expiration_date = $CI->card_model->getExpirationDate($viewcard['regno']);;
					   //echo $keyinfo[0]->KEY; 



	?>
	<input type="hidden" name="gender" value="<?php echo $expiration_date; ?>">

	<?php echo '<b class="underline" style="color:red">'.date("d-m-Y",strtotime($expiration_date)).'</b>'?>

<?php } ?>		

	</div>
<div class="remarks">Card Remarks <?php echo '<b class="underline">'.$viewcard['allottype'].'</b>'?></div>
<div class="email">CNIC. <?php echo '<b class="underline">'.str_replace('-','', $viewcard['cnic']).'</b>'?></div>
<div class="reg">Reg No. <?php echo '<b class="underline">'.$viewcard['regno'].'</b>'?></div>
<?php if($viewcard['gender'] == 'Male') {?>
<img src="<?php echo base_url() ?>/uploads/image/bgpic-23.jpeg" width=330 height=211 border=0> 
<?php
}
elseif ($viewcard['gender'] == 'Female') { ?>
	<img src="<?php echo base_url() ?>/uploads/image/bgpic-23.jpeg" width=330 height=211 border=0> 
<?php 
}
?>

<!-- First Side End Div -->
</div>
<div>

<div class="barcode"><?php echo str_replace(' ', '', '~1%'.$viewcard['name'].'^'.$viewcard['regno'].'?')?></div>
<div class="emailback"><?php echo '<b class="underline">'.strtolower($viewcard['email']).'</b>'?></div>
<div class="instruction">Instructions</div>
<?php if($viewcard['gender'] == 'Male') {?>
<div class="cond">Boarder's seat shall be liable for cancellation on absenting himself without leave<br> approval from Vice President (Academics).<br><br>
Card (along with Hostel Clearance Form) must be submitted in Provost Office <br>while leaving the hostel.In case of Overstay Rs 100-per day will be charged.<br> In case of losing card, duplicate will be issued on payment of Rs 500.<br><br>
After Expiry of Validity date if student intends to extend his hostel accomodation,<br> he will have to apply for seat renewal according schedule displayed on notice boards<br> in the start of every new semester.
</div>
<?php } elseif($viewcard['gender'] == 'Female') { ?>
<div class="cond">Boarder's seat shall be liable for cancellation on absenting herself without leave<br> approval from Provost (F.H).<br><br>
Card (along with Hostel Clearance Form) must be submitted in Provost Office <br>while leaving the hostel.In case of Overstay Rs 200-per day will be charged.<br> In case of losing card, duplicate will be issued on payment of Rs 500.<br><br>
After Expiry of Validity date if student intends to extend her hostel accomodation,<br> she may apply for seat renewal according schedule displayed on notice boards<br> in the start of every new semester.
</div>
<?php 
     }
?>

<img src="<?php echo base_url() ?>/uploads/image/backpic.jpg" width=330 height=210 border=0">
</div>

<?php 
}
}
}
?>
</body>
<script>
function myFunction() {
    window.print();
}
</script>
</html>