<html>
<head>
<style>
body {
  margin: 0px;
  
}

.std_name {
	color: darkgreen;
	text-transform: uppercase;
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
	position:absolute; 
	color:#000000; 
	font:bold 10pt Arial;
	margin-top: 43px;
    margin-left: 243px;
}
.name{
	position:absolute; 
	color:#000000; 
	font:bold 10pt Arial; 
	margin-top: 45pt;
    margin-left: 12px;
}
.fname{
	position:absolute; 
	color:#000000; 
	font:normal 10pt Arial; 
	margin-top: 59pt;
    margin-left: 12px;
}
.reg{
	position:absolute; 
	color:#000000; 
	font:normal 10pt Arial; 
	margin-top: 73pt;
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
	position:absolute; 
	font:bold 10pt Arial;
	margin-top: 191px;
    margin-left:206px;
    float:right;
}
.room{
	position:absolute; 
	color:#000000; 
	font:normal 10pt Arial; 
	margin-top: 87pt;
    margin-left: 12px;
}
.hostelbg{
	position:absolute; color:#3390FF; font:bold 18pt Arial; margin-top: 120px;
    margin-left: 105px;opacity: 0.4; 
}
.issue{
	position:absolute; 
	color:#000000; 
	font:normal 10pt Arial; 
	margin-top: 101pt;
    margin-left: 12px;
}
.valid{
	position:absolute; 
	color:#000000; 
	font:bold 10pt Arial; 
	margin-top: 115pt;
    margin-left: 12px;
}
.remarks{
	position:absolute; 
	color:#1b461c; 
	font:normal 10pt 'Time New Roman'; 
	margin-top: 129pt;
    margin-left: 12px;
}
.email{
	position:absolute; 
	color: #1b461c;
	font:bold 10pt 'Time New Roman'; 
	margin-top: 143pt;
    margin-left: 12px;
}
.barcode{
	position:absolute; 
	color:#000000; 
	font:bold 10pt Arial; 
	margin-top: 20px;
    margin-left: 0px; 
    font-size:10px;
}
.instruction{
	position:absolute; 
	color:#000000; 
	font:bold 11pt Italic; 
	margin-top: 70px;
    margin-left: 12px;
    font-family: 'Arial';
}
.emailback{
	position:absolute; 
	color:#000000; 
	font:bold 9pt Italic; 
	margin-top: 35px;
    margin-left: 12px;
}
.cond{
	position:absolute; 
	color:#000000; 
	font:bold 6pt Italic; 
	margin-top: 90px;
    margin-left: 12px;
}

.femaleCard {
	position:absolute; 
	color:#000000; 
	font-weight:bold;
	font-size: 7pt; 
	margin-top: 90px;
    margin-left: 12px;
    font-family: 'Arial';
}

.card_title_field {
   color: #03311f; 
   font-family: 'Time New Roman'; 
   font-size: 10pt; 
   font-weight: bold;     
}
.card_field_value {   
   font-family: 'Arial';       
   font-size: 10pt;
   font-weight: bold;
   color:#000000; 
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
	
	
foreach($viewcardsInfo as $viewcard )
{

	if(!empty($viewcard['id']) && !empty($viewcard['pic']) && $viewcard['pic'] != null && $cardpic!= ''){
?>

<div>


<span class="header">International Islamic University, Islamabad</span>
<div class="tittle">Office of Provost (<?php echo $viewcard['gender'] ?>) </div>



<?php

$name = $viewcard['name'];

$nameLenght = strlen($name);
if($nameLenght >= '20' && $nameLenght <= '31'){
       $fontSize = '10pt';
}else if($nameLenght >= '32' && $nameLenght <= '33'){
       $fontSize = '9.5pt';
}else if($nameLenght >= '34' && $nameLenght <= '35'){
       $fontSize = '9pt';
}else if($nameLenght >= '36' && $nameLenght <= '37'){
       $fontSize = '8.5pt';
}else if($nameLenght >= '38' && $nameLenght <= '40'){      
      $fontSize = '7.5pt'; 
} ?>



<div class="name card_title_field">Name:    <?php echo '<b class="card_field_value" style="font-size: '. $fontSize.'; text-transform: uppercase; font-weight: bold;">'.$viewcard['name'].'</b>'?></div>
<input type="hidden" name="name" value="<?php echo strlen($name); ?>">
<?php

//$fname = str_replace("Muhammad","M",$viewcard['fathername']);
//$fname = str_replace("Mohammad","M",$fname);
//$fname = str_replace("Khan","K",$fname);
//$fname = str_replace("Hafiz","H",$fname);
//$fname = str_replace("Hussain","H",$fname);
//$fname = str_replace("Sardar","S",$fname);

$fname = $viewcard['fathername'];

$nameLenght = strlen($fname);
if($nameLenght < '17'){
	$fontSize = '10pt';
}else if($nameLenght >= '17' && $nameLenght <= '19'){
       $fname = str_replace("Muhammad","M",$fname);
       $fname = str_replace("Mohammad","M",$fname);
       $fontSize = '10pt';
}else if($nameLenght >= '20' && $nameLenght <= '21'){
       $fname = str_replace("Muhammad","M",$fname);
       $fname = str_replace("Mohammad","M",$fname);
       $fname = str_replace("muhammad","M",$fname);
       $fname = str_replace("mohammad","M",$fname);
       if(strlen($fname) <= '19'){
         $fontSize = '10pt';
       }else{
         $fontSize = '9pt';     
       }       
}else if($nameLenght >= '22' && $nameLenght <= '23'){
       $fname = str_replace("Muhammad","M",$fname);
       $fname = str_replace("Mohammad","M",$fname);
       $fname = str_replace("muhammad","M",$fname);
       $fname = str_replace("mohammad","M",$fname);
       if(strlen($fname) <= '19'){
         	$fontSize = '10pt';
       }else{
         	$fontSize = '8.8pt';     
       }
}else if($nameLenght >= '24' && $nameLenght <= '25'){
       $fname = str_replace("Muhammad","M",$fname);
       $fname = str_replace("Mohammad","M",$fname);
       $fname = str_replace("muhammad","M",$fname);
       $fname = str_replace("mohammad","M",$fname);
       if(strlen($fname) <= '19'){
         	$fontSize = '10pt';
       }else{
       		$fname = str_replace("Sardar","S",$fname);
       		$fname = str_replace("sardar","S",$fname);
         	$fontSize = '8.2pt';
       }
}else if($nameLenght >= '26' && $nameLenght <= '27'){
       $fname = str_replace("Muhammad","M",$fname);
       $fname = str_replace("Mohammad","M",$fname);
       $fname = str_replace("muhammad","M",$fname);
       $fname = str_replace("mohammad","M",$fname);
       
       if(strlen($fname) <= '19'){
         	$fontSize = '10pt';
       }else{
       		$fname = str_replace("Sardar","S",$fname);
       		$fname = str_replace("sardar","S",$fname);
          	$fontSize = '8.2pt';
       }
}else if($nameLenght >= '28' && $nameLenght <= '29'){
       $fname = str_replace("Muhammad","M",$fname);
       $fname = str_replace("Mohammad","M",$fname);
       $fname = str_replace("muhammad","M",$fname);
       $fname = str_replace("mohammad","M",$fname);
       if(strlen($fname) <= '19'){
         	$fontSize = '10pt';
       }else{
       		$fname = str_replace("Sardar","S",$fname);
       		$fname = str_replace("sardar","S",$fname);
         	$fontSize = '8.2pt';
       }
}else if($nameLenght >= '30' && $nameLenght <= '31'){
       $fname = str_replace("Muhammad","M",$fname);
       $fname = str_replace("Mohammad","M",$fname);
       $fname = str_replace("muhammad","M",$fname);
       $fname = str_replace("mohammad","M",$fname);
       if(strlen($fname) <= '19'){
         	$fontSize = '10pt';
       }else{
       		$fname = str_replace("Sardar","S",$fname);
       		$fname = str_replace("sardar","S",$fname);
         	$fontSize = '8.2pt';
       }
}else if($nameLenght >= '32' && $nameLenght <= '33'){
       $fname = str_replace("Muhammad","M",$fname);
       $fname = str_replace("Mohammad","M",$fname);
       $fname = str_replace("muhammad","M",$fname);
       $fname = str_replace("mohammad","M",$fname);       
       if(strlen($fname) <= '19'){
         $fontSize = '10pt';
       }else{
       		$fname = str_replace("Sardar","S",$fname);
       		$fname = str_replace("sardar","S",$fname);
         	$fontSize = '8.2pt';
       }
}else if($nameLenght >= '34' && $nameLenght <= '35'){
       $fname = str_replace("Muhammad","M",$fname);
       $fname = str_replace("Mohammad","M",$fname);
       $fname = str_replace("muhammad","M",$fname);
       $fname = str_replace("mohammad","M",$fname);
       if(strlen($fname) <= '19'){
         $fontSize = '10pt';
       }else{
       		$fname = str_replace("Sardar","S",$fname);
       		$fname = str_replace("sardar","S",$fname);
         	$fontSize = '8.1pt';
       }
}else if($nameLenght >= '36' && $nameLenght <= '37'){
       $fname = str_replace("Muhammad","M",$fname);
       $fname = str_replace("Mohammad","M",$fname);
       $fname = str_replace("muhammad","M",$fname);
       $fname = str_replace("mohammad","M",$fname);
       if(strlen($fname) <= '19'){
         $fontSize = '10pt';
       }else{
       		$fname = str_replace("Sardar","S",$fname);
       		$fname = str_replace("sardar","S",$fname);
         	$fontSize = '8.0pt';
       }
}

 ?>

<div class="fname card_title_field" >Father's Name: <span class="card_field_value" style="font-size: <?= $fontSize; ?>"><?php echo $fname; ?></span></div>

<input type="hidden" name="father_name" value="<?php echo strlen($fname); ?>">
<div class="pic">

<?php if(!empty($viewcard['id']) && !empty($viewcard['pic']) && $viewcard['pic'] != null && $cardpic!= ''){ 
	$blobimg = $viewcard['pic'];
					?>
    <?php echo '<img src ="data:image/jpeg;base64,'.base64_encode($blobimg).'" style="margin-left: 240%;margin-top: -7px;" width=75 height=75 border=0/>';?>
                 
 <?php } else {?>
    <img src="<?php echo base_url()?>uploads/image/noimg.png" id="pic1" src="#" alt="your image" class="img-thumb" width="75" height="75" style="margin-left: 230%; margin-top: 0%;padding:1px; border:1px solid #021a40;">
                        <?php }?>
</div>


<div class = "signaturefmale">
	<img src="<?php echo base_url()?>uploads/image/fsignature.png"  src="#" alt="your image" style="position: relative; top:22pt;left:8pt;" class="img-thumb" width="100" height="45" >
</div>


<div class = "signatureprovost" >Signature Provost</div>


<div  class="room card_title_field" >Room-Seat/Hostel:<span class="card_field_value"> <?php echo $viewcard['roomdesc'].'-'.$viewcard['seat'].'/'.$viewcard['hostelno']; ?></span></div>


<div class="hostelbg">Hostel <?php echo $viewcard['hostelno']?></div>


<div class="issue card_title_field">Issued On: <span class="card_field_value"><?php echo date("d-m-Y",strtotime($viewcard['issuedate'])); ?></span></div>
	
<div class="valid card_title_field">Valid Upto: 
<?php 
if($viewcard['card_expiry_date'] == null){


$CI =& get_instance();
	
$expiration_date = $CI->card_model->getExpirationDate(base64_encode($viewcard['regno']));
?>

<?php echo '<b class="card_field_value" style="color:red; font-weight: bold;">'.date("d-m-Y",strtotime($expiration_date)).'</b>'?>

<?php }else{ ?>
		
	<?php echo '<b class="card_field_value" style="color:red; font-weight: bold;">'.date("d-m-Y",strtotime($viewcard['card_expiry_date'])).'</b>'?>

<?php } ?>		

	</div>



<div class="remarks card_title_field"><b>Card Remarks: </b><span class="card_field_value" style="font-family: Arial;"> 
<?php 
	echo $viewcard['card_remarks'] ?? 'Allotted'; 
?>
</span>
</div>




<div class="email card_title_field">CNIC: <?php echo '<span class="card_field_value" style="color: #000; font-family: Arial; ">'.str_replace('-','', $viewcard['cnic']).'</span>'?></div>





<div class="reg card_title_field">Reg No: <span class="card_field_value"><?php echo $viewcard['regno']; ?></span></div>


<img src="<?php echo base_url() ?>/uploads/image/female_hostel_card_bg.jpg" width=330 height=211 border=0> 


</div>
<div>

<div class="barcode"><?php echo str_replace(' ', '', '~1%'.$viewcard['name'].'^'.$viewcard['regno'].'?')?></div>

<div class="emailback"><?php echo '<b class="underline">'.strtolower($viewcard['email']).'</b>'?></div>

<div class="instruction">Instructions:</div>
<div class="femaleCard">1. Hostel card will be collected by the respected ( ALW's / ARHT's )<br> authorities at the end of every semester and will be returned<br> after renewal.<br>2. If student intends to renew her hostel accommodation,<br>she may apply for seat renewal according to schedule displayed on<br>notice boards in the start of every semester.
<br>
3. Improper use of hostel card may result in cancellation of <br>your seat or imposing fine. <br>4. In case of lost of hostel card please contact Female Provost office<br>urgently. Duplicate card will be issued on payment of Rs 600/-
</div>

<a target="_blank" href="<?php echo base_url(). 'card/Cards/edit_card/'.base64_encode($viewcard['regno']);?>" class="no-print"> Edit Card</a> 

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