<html>
<head>
<style>
html,
body {
       height: auto;
       width:auto;
       color:#000000 !important;    
}

.card_bg_pic {
       position: absolute; 
       top: 0.0pt;
       left: 0.0pt;
       width: 247.5pt;
       height: 157.5pt; 
}
.card_bg_pic img {
       width: 330px;
       height: 211px;
       border: 0;
}

.uni_name {
       position: absolute;
       top: 4pt;
       left: 37pt; 
       color: #000000;
       font: bold 10pt Arial;
}

.provost_office {
       position:absolute;
       top:20pt;
       left:65pt; 
       color:#000000;
       font:bold italic 9pt Arial;
}

.card_id {
       position:absolute;
       top:40pt;
       left:185pt; 
       text-decoration:underline;
       font:bold italic 9pt Arial;
       color:#000000;
}

.card_field_title {
       color:#000000;
       position:absolute;
       font:bold italic 9pt Arial;
}

.std_name{
       top: 40pt;
       left: 10pt;
}

.std_father_name {
       top:52pt;
       left:8pt;
}

.card_field_value {
       position:absolute;
       font:bold italic 9pt Arial;
}
.std_name_value {       
       top:40pt;
       left:40pt
}

.std_father_name_value {
       top:52pt;
       left:74pt
}

.std_reg_no {
      top:65pt;
      left:8pt; 
}

.std_reg_value {
       top: 65pt;
       left: 50pt;
}

.std_hostel_seat {
       top: 77pt;
       left: 8pt;
}

.std_hostel_seat_value {       
       top:77pt;
       left:87pt
}

.hostel_no {
       font:bold 25pt Arial;
       color:#3390FF;
       position:absolute;
       top:85pt;
       left:35pt;
       opacity: 0.4;
}

.std_img_wrapper {
       position: absolute; 
       top:60pt;
       left:184.5pt; 
       width:58.5pt;
       height:58.5pt; 
}

.std_img {
       margin-left: 0%;
       margin-top: 0%;
       width: 70px;
       height: 70px;
}

.no_img {
       padding: 1px; 
       border:1px solid #021a40;
}
.provost_sig_wrap {
       position: absolute; 
       top: 95pt;
       left: 168.5pt; 
       width: 58.5pt;
       height: 58.5pt;
}
.provost_sig_wrap img {
       width: 90px;
       height: 45px;
}
.provost_signature {
       position:absolute;
       top:125pt;
       left:175pt; 
       font:bold 8pt Arial;
}
.issueDate {
       top:88pt;
       left:8pt;
}
.issueDateValue {
       top:88pt;
       left:59pt;
}
.validDate {
       top:101pt;
       left:7pt
}
.validDateValue {
       top:101pt;
       left:53pt;
       text-decoration: underline;
       color:red;
       font-weight:bold;
}
.cardRemarks {
       top: 117pt;
       left: 6pt;
}
.cardRemarksValue {
       top:117pt;
       left:70pt;
}
.std_cnic {
       top:130pt;
       left:6pt;
}
.std_cnic_value {
      top:130pt;
      left:40pt; 
}
.machinecode {
       position:absolute;
       top:250px;
       left:0px; 
       color:#000000; 
       font-size:10px; 
       font-weight:bold;
}
.std_email {
       top:200pt;
       left:9pt;
       font-size:10px;
}
.instruction {
       top:210pt;
       left:9pt;
       font-size:12pt;
}
.instruction_list {
       top:230pt;
       left:9pt;
       font-size:6pt;
}
</style>

</head>
<body>
       <div class="content-wrapper">
              <span class="card_bg_pic">
                     <img src="<?php echo base_url() ?>/uploads/image/bgpic-23.jpeg" >
              </span>

              <span class="uni_name">International Islamic University, Islamabad</span>

              <span class="provost_office">Office of the Provost (<?php echo $viewcardsInfo[0]->GENDER; ?>)</span>

              <span class="card_id">ID:
                     <?php 
                     if(empty($attachi)){
                            echo $viewcardsInfo[0]->ID; 
                     }
                     else 
                     {
                            echo $viewcardsInfo[0]->ID.'('.$attachi.')';
                     }
                     ?>                     
              </span>

              <span class="card_field_title std_name">Name</span>
              <span class="card_field_value std_name_value">
                     <?php echo $viewcardsInfo[0]->NAME?>
              </span>

              <span class="card_field_title std_father_name">Father's Name</span>
              <span class="card_field_value std_father_name_value">
                     <?php echo $fname[0]->FATHERNAME; ?>              
              </span>

              <style>#f3{font:italic 9pt Arial;font-weight:bolder}</style>

              <span class="card_field_title std_reg_no">Reg No</span>
              <span class="card_field_value std_reg_value">
                     <?php echo $viewcardsInfo[0]->REGNO; ?>       
              </span>

              <span class="hostel_no">Hostel 
                     <?php echo $viewcardsInfo[0]->HOSTEL_NO; ?>
              </span>

              <span class="card_field_title std_hostel_seat">Room-Seat/Hostel</span>
              <span class="card_field_value std_hostel_seat_value">
                     <?php 
                     if(!empty($attachi)){
                     echo $viewcardsInfo[0]->ROOMDESC.'-'.$attachi.$viewcardsInfo[0]->SEAT.'/'.$viewcardsInfo[0]->HOSTEL_NO; 
                     }else{

                     echo $viewcardsInfo[0]->ROOMDESC.'-'.$viewcardsInfo[0]->SEAT.'/'.$viewcardsInfo[0]->HOSTEL_NO; 
                     }
                     ?>
              </span>

              <span class="std_img_wrapper">

                     <?php if(!empty($viewcardsInfo[0]->ID) && !empty($oraclepic)){ 

                     $blobimg = $oraclepic[0]->STUDPIC; 
                     



                    // $blobimg = $StudentInfo[0]->picture;

                            // Decode the Base64 string, getting the binary data of the image
                            $imageData = base64_decode($blobimg);

                           $image_name = str_replace("/", "", $StudentInfo[0]->REGNO);

                            // Specify the path where you want to save the image
                            $filePath = 'assets/student_pics/'.$image_name.'.png';

                            // Write the binary data to the file

                            $resutl = file_put_contents($filePath, $imageData);
                            
                            ?>
                            <img class="std_img" alt="student picture" src ="assets/student_pics/<?= $image_name ?>.png"/>






                    



                            <!-- <img class="std_img" alt="student picture" src ="data:image/jpeg;base64,<?php //echo base64_encode($blobimg); ?>"/> -->

                     <?php } else {?>
       	             <img class="std_img no_img" alt="student picture" src="<?php echo base_url()?>uploads/image/noimg.png">
                     <?php }?> 
              </span>

              <span class="provost_sig_wrap">
                     <img src="<?php echo base_url()?>uploads/image/signature.png"  alt="Provost Signature">
              </span>

              <span class="provost_signature">Signature Provost</span>


              <span class="card_field_title issueDate">Issued On</span>
              <span class="card_field_value issueDateValue">
                     <?php echo date("d-m-Y",strtotime($viewcardsInfo[0]->ISSUEDATE)); ?>
              </span>

              <span class="card_field_title validDate">Valid Upto</span>
              <span class="card_field_value validDateValue">

              <?php echo date("d-m-Y",strtotime($viewcardsInfo[0]->EXPIRYDATE)); ?>

              </span>


              <span class="card_field_title cardRemarks">Card Remarks</span>

              <span class="card_field_value cardRemarksValue">
                     <?php echo $viewcardsInfo[0]->ALLOTTYPE; ?>
              </span>


              <span class="card_field_title std_cnic">CNIC </span>
              <span class="card_field_title std_cnic_value">
                     <?php echo $oraclepic[0]->CNIC; ?>
              </span>


              <span style="position:absolute;top:250px;left:0px; color:#000000; font-size:10px; font-weight:bold;"><?php echo str_replace(' ', '', '~1%'.$viewcardsInfo[0]->STUDENTNAME.'^'.$viewcardsInfo[0]->REGNO.'?')?></span>

              <span class="card_field_title std_email"><?php echo $emailinfo[0]->email; ?></span>


              <span class="card_field_title instruction">Instructions:</span>

              <span class="card_field_title instruction_list">Boarder's seat shall be liable for cancellation on absenting himself without leave<br> approval from Vice President (Academics).<br><br>
              Card (along with Hostel Clearance Form) must be submitted in Provost Office <br>while leaving the hostel.In case of Overstay Rs 100-per day will be charged.<br> In case of losing card, duplicate will be issued on payment of Rs 500.<br><br>
              After Expiry of Validity date if student intends to extend his hostel accomodation,<br> he will have to apply for seat renewal according schedule displayed on <br>notice boards in the start of every new semester.
              </span>
       </div>
</body>
</html>