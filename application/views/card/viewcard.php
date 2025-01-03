
<html>
<head>
<style>
.pagebreak { page-break-after: auto; }
 html, body {
        height: auto;
		width:auto;
		color:#000000FFF !important;    
    }

    .card_title_field {
       color: #03311f; 
       font-family: 'Time New Roman'; 
       font-size: 10pt; 
       font-weight: bold;
       left: 8pt;
       position: absolute;
    }
    .card_field_value {
       position:absolute;
       font-family: 'Arial';       
       font-size: 10pt;
       font-weight: bold;
       color:#000000; 
    }

    .instruction_list span{
       margin-bottom: 3px;
    }
	
</style>

</head>
<body>
<div class="content-wrapper">
<div style="position: absolute; top:0pt;left:1pt;">

</div>

<span style="position: absolute; top:0.0pt;left:0.0pt; width:247.5pt;height:157.5pt; "><img src="<?php echo base_url() ?>/uploads/image/female_hostel_card_bg.jpg" width=330 height=211 border="0"> </span>

<span style="position:absolute;top:4pt;left:37pt; color:#000000;font:bold 10pt Arial;">International Islamic University, Islamabad</span>
<span style="position:absolute;top:20pt;left:65pt; color:#000000;font:bold 10pt Arial">Office of the Provost (<?php echo $viewcardsInfo[0]->GENDER ?>)</span>


<style>#f1{font:bold 6pt Verdana;color:#000000;}</style>

<?php

//var_dump($viewcardsInfo); exit();

$name = $viewcardsInfo[0]->NAME;

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
}  ?>

<span class="card_title_field" style="top:45pt;">Name: </span>
<span class="card_field_value" style="font-weight: bold; top:45pt;left:44pt; text-transform: uppercase; font-size: <?= $fontSize; ?>"><?php echo $name?></span>
<input type="hidden" name="name" value="<?php echo strlen($name); ?>">
<?php

//$fname = str_replace("Muhammad","M",$fname[0]->FATHERNAME);
//$fname = str_replace("Mohammad","M",$fname);
//$fname = str_replace("Khan","K",$fname);
//$fname = str_replace("Hafiz","H",$fname);
//$fname = str_replace("Hussain","H",$fname);
//$fname = str_replace("Sardar","S",$fname);

$fname = $viewcardsInfo[0]->FATHERNAME;

$nameLenght = strlen($fname);

if($nameLenght >= '17' && $nameLenght <= '19'){
       //$fname = str_replace("Muhammad","M",$fname);
       //$fname = str_replace("Mohammad","M",$fname);
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
         $fontSize = '9pt';     
       }
}else if($nameLenght >= '24' && $nameLenght <= '25'){
       $fname = str_replace("Muhammad","M",$fname);
       $fname = str_replace("Mohammad","M",$fname);
       $fname = str_replace("muhammad","M",$fname);
       $fname = str_replace("mohammad","M",$fname);
       if(strlen($fname) <= '19'){
         $fontSize = '10pt';
       }else{
         $fontSize = '8.2pt';
       }
}else if($nameLenght >= '26' && $nameLenght <= '27'){
       $fname = str_replace("Muhammad","M",$fname);
       $fname = str_replace("Mohammad","M",$fname);
       $fname = str_replace("muhammad","M",$fname);
       $fname = str_replace("mohammad","M",$fname);
       $fname = str_replace("Sardar","S",$fname);
       $fname = str_replace("sardar","S",$fname);
       if(strlen($fname) <= '19'){
         $fontSize = '10pt';
       }else{
              $fontSize = '8.2pt';
       }
}else if($nameLenght >= '28' && $nameLenght <= '29'){
       $fname = str_replace("Muhammad","M",$fname);
       $fname = str_replace("Mohammad","M",$fname);
       $fname = str_replace("muhammad","M",$fname);
       $fname = str_replace("mohammad","M",$fname);
       $fname = str_replace("Sardar","S",$fname);
       $fname = str_replace("sardar","S",$fname);
       if(strlen($fname) <= '19'){
         $fontSize = '10pt';
       }else{
         $fontSize = '8.2pt';
       }
}else if($nameLenght >= '30' && $nameLenght <= '31'){
       $fname = str_replace("Sardar","S",$fname);
       $fname = str_replace("sardar","S",$fname);
       $fname = str_replace("Muhammad","M",$fname);
       $fname = str_replace("Mohammad","M",$fname);
       $fname = str_replace("muhammad","M",$fname);
       $fname = str_replace("mohammad","M",$fname);
       if(strlen($fname) <= '19'){
         $fontSize = '10pt';
       }else{
         $fontSize = '8.2pt';
       }
}else if($nameLenght >= '32' && $nameLenght <= '33'){
       $fname = str_replace("Muhammad","M",$fname);
       $fname = str_replace("Mohammad","M",$fname);
       $fname = str_replace("muhammad","M",$fname);
       $fname = str_replace("mohammad","M",$fname);
       $fname = str_replace("Sardar","S",$fname);
       $fname = str_replace("sardar","S",$fname);
       if(strlen($fname) <= '19'){
         $fontSize = '10pt';
       }else{
         $fontSize = '8.2pt';
       }
}else if($nameLenght >= '34' && $nameLenght <= '35'){
       $fname = str_replace("Muhammad","M",$fname);
       $fname = str_replace("Mohammad","M",$fname);
       $fname = str_replace("muhammad","M",$fname);
       $fname = str_replace("mohammad","M",$fname);
       $fname = str_replace("Sardar","S",$fname);
       $fname = str_replace("sardar","S",$fname);
       if(strlen($fname) <= '19'){
         $fontSize = '10pt';
       }else{
         $fontSize = '8.1pt';
       }
}else if($nameLenght >= '36' && $nameLenght <= '37'){
       $fname = str_replace("Muhammad","M",$fname);
       $fname = str_replace("Mohammad","M",$fname);
       $fname = str_replace("muhammad","M",$fname);
       $fname = str_replace("mohammad","M",$fname);
       $fname = str_replace("Sardar","S",$fname);
       $fname = str_replace("sardar","S",$fname);
       if(strlen($fname) <= '19'){
         $fontSize = '10pt';
       }else{
         $fontSize = '8.0pt';
       }
}


 ?>


<span class="card_title_field" style="top:59pt;">Father's Name:    </span>
<span class="card_field_value" style="top:59pt;left:80pt; font-size: <?= $fontSize; ?>"><?= $fname; ?></span>

<input type="hidden" name="father_name_length" value="<?php echo strlen($fname); ?>">
<input type="hidden" name="father_name" value="<?php echo $fname[0]->FATHERNAME; ?>">

<span class="card_title_field" style="top:73pt;">Reg No:</span>
<span class="card_field_value" style="top:73pt;left:48pt;"><?php echo $viewcardsInfo[0]->REGNO?></span>


<span class="card_title_field" style="top:87pt;">Room-Seat/Hostel:</span>
<span class="card_field_value" style="top:60pt;left:184.5pt; width:58.5pt;height:58.5pt; ">
<?php if(!empty($viewcardsInfo[0]->ID) && !empty($oraclepic)){ 

	$blobimg = $oraclepic[0]->STUDPIC;

   // var_dump($blobimg);
   


    $blobimg = $oraclepic[0]->STUDPIC;
                     $STD_PIC = $oraclepic[0]->STD_PIC; 

                    // var_dump($blobimg); exit(); 

                    $imageData = base64_decode($blobimg);

                           $image_name = str_replace("/", "", $viewcardsInfo[0]->REGNO);
                     //var_dump($image_name);

                            // Specify the path where you want to save the image
                            $filePath = 'assets/student_pics/'.trim($image_name).'.png';

                            // Write the binary data to the file

                            if(!empty($oraclepic[0]->STUDPIC)){

                                   file_put_contents($filePath, $imageData);
                            }

                           if(empty($STD_PIC)){
                            
                            ?>
                            <img width=70 height=70 border=0 style="margin-left: 18%;margin-top: 7px;" alt="student picture" src ="http://usis.iiu.edu.pk:64453/hostel/assets/student_pics/<?= $image_name ?>.png"/>
                     <?php } else { ?>

                            <?php echo '<img src ="data:image/jpeg;base64,'.base64_encode($blobimg).'" style="margin-left: 18%;margin-top: 7px;" width=70 height=70 border=0/>';?> 


                 
<?php }} else {?>

<img src="<?php echo base_url()?>uploads/image/noimg.png" id="pic1" src="#" alt="Provost Signature" class="img-thumb" width="70" height="70" style="padding:1px; border:1px solid #021a40;" >
 <?php }?> </span>

<span style="position: absolute; top:14pt;left:168.5pt; width:58.5pt;height:58.5pt; ">
<img src="<?php echo base_url()?>uploads/image/fsignature.png"  src="#" alt="Provost Signature" style="position: absolute; top:101pt;left:8pt;" class="img-thumb" width="90" height="45" >
</span>


<span style="position:absolute;top:146pt;left:175pt; font:bold 8pt Arial;" id=f3>Signature Provost</span>

<span style="font:bold 25pt Arial;color:#3390FF;position:absolute;top:85pt;left:35pt;opacity: 0.4;" id=f4>Hostel <?php echo $viewcardsInfo[0]->HOSTEL_NO?></span>


<span class="card_field_value" style="top:87pt;left:94pt"><?php echo $viewcardsInfo[0]->ROOMDESC.'-'.$attachi.$viewcardsInfo[0]->SEAT.'/'.$viewcardsInfo[0]->HOSTEL_NO?></span>


<span class="card_title_field" style="top:101pt;">Issued On:</span>
<span class="card_field_value" style="top:101pt;left:62pt;"><?php echo date("d-m-Y",strtotime($viewcardsInfo[0]->ISSUEDATE))?></span>
<span class="card_title_field" style="top:115pt;">Valid Upto:</span>


<?php if($viewcardsInfo[0]->card_expiry_date == null){ ?>

<span class="card_field_value" style="font-weight: bold;top:115pt;left:62pt;color:red;" ><?php echo $expiration_date; ?></span>


<?php }else{ ?>

       <span class="card_field_value" style="font-weight: bold;top:115pt;left:62pt; color:red;" ><?php echo date("d-m-Y",strtotime($viewcardsInfo[0]->card_expiry_date)); ?></span>
<?php }  ?>





<span class="card_title_field" style="top:129pt;">Card Remarks:</span>



<span class="card_field_value" style="top:129pt;left:80pt;"><?php 

if(!empty($viewcardsInfo[0]->card_remarks) && $viewcardsInfo[0]->card_remarks != null){
       echo $viewcardsInfo[0]->card_remarks;
}else{

echo 'Allotted'; 
}

?></span>




<span class="card_title_field" style="position:absolute;top:143pt;">CNIC: </span>

<span class="card_field_value" style="top:143pt;left:44pt;"><?php echo $oraclepic[0]->CNIC;?></span>


<span style="position:absolute;top:233px;left:0px; color:#000000; font-size:10px; font-weight:bold;"><?php echo str_replace(' ', '', '~1%'.$viewcardsInfo[0]->STUDENTNAME.'^'.$viewcardsInfo[0]->REGNO.'?')?></span>

<style>#f6{font:bold 6pt 'Arial';color:#000000}</style>
<span style="position:absolute;top:188pt;left:9pt; font-size:10px"><?php echo $emailinfo[0]->email?></span>
<span style="position:absolute;top:210pt;left:9pt; font-weight:bold; font-size: 11pt;" id=f6>Instructions:</span>
<span class="instruction_list" style="position:absolute;top:224pt;left:9pt; font-weight:bold; font-size: 7pt; font-family: 'Arial'; line-height: 11px; " id=f6>
       <span class="second_inst">1. Hostel card will be collected by the respected ( ALW's / ARHT's )<br> authorities at the end of every semester and will be returned <br>after renewal.</span>
       <span class="second_inst"><br>2. If student intends to renew her hostel accommodation,<br>she may apply for seat renewal according to schedule displayed on<br>notice boards in the start of every semester.</span>
       <span class="third_inst"><br>3. Improper use of hostel card may result in cancellation of<br>your seat or imposing fine. </span>
       <span class="fourth_inst"><br>4. In case of lost of hostel card please contact Female Provost office<br> urgently. Duplicate card will be issued on payment of Rs 600/-
       </span>
</span>