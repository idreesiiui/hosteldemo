<html><head>
    
    <style>
    	.error{
    		color:red;
    		font-weight: normal;
    	}


#content{
    position:absolute;
    z-index:1;
	;
}

#bg-text
{
    color:lightgrey;
    font-size:120px;
    transform:rotate(300deg);
    -webkit-transform:rotate(300deg);
	margin-top:-40%;
	margin-left:20%;
}
    </style>
  </head><body class="login-page">
    <div class="signup-box" style="margin-top: 0px;">
      <div class="login-logo">
      <img src="<?php //echo base_url(); ?>assets/images/Iiui-logo.jpg" style="width:100%;" height="120">
       <!--<a href="#"><b>IIUI Hostel </b><br>Managment System</a>-->
      </div><!-- /.login-logo -->
      <h3 style="margin-left:20%; margin-top:0px">PROVISIONALLY ALLOTED Till <b><?php $date = strtotime("+5 day");
echo date('d M, Y', $date);?></b> </h3>
       <h4 class="login-box-msg" style="text-align:center; margin-left:150px" align="center"><?php echo '<strong style="text-decoration:underline">'.$allotslip[0]->GENDER?> Hostel Allotment for <?php echo '<strong>'.'Semester '.'</strong>'.'<strong style="text-decoration:underline">'.$allotslip[0]->SEMCODE.'</strong>'?> </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
       <?php if(!empty($allotslip) && !empty($oraclepic)){ 
					$blobimg = $oraclepic[0]->STUDPIC;
					?>
                  <?php echo '<img src ="data:image/jpeg;base64,'.base64_encode($blobimg).'" id="pic1" src="#" alt="your image" class="img-thumb" width=105 height=105 border=1/>';?>
                 
                 <?php } else {?>
                 		<img src="<?php //echo base_url()?>uploads/image/noimg.png" id="pic1" src="#" alt="your image" class="img-thumb" width="110" height="90">
                        <?php }?>
       </h4>
     <br>  
   
<div class="box-body table-responsive no-padding">
  <table class="table table-hover" >
                            <tr><th align="center"  width="100">Reg No</th><td align="center" width="150" style="text-decoration:underline;"><?php echo $allotslip[0]->REGNO?></td>
                             <th align="right" >Student Name</th><td align="center" style="text-decoration:underline;" width="80"><?php echo $allotslip[0]->STUDENTNAME?></td></tr>
                             <tr> <th align="right">  </th><td align="right">  </td></tr> <tr> <th align="right"></th><td align="right">  </td></tr>
                           <tr><th align="center">Programe</th><td align="center" style="text-decoration:underline;"><?php echo $acad[0]->PROGRAME?></td>
                             <th align="center">Faculty</th><td align="center" style="text-decoration:underline;"width="150"><?php echo $acad[0]->FACULTY?></td></tr>
<div align="center" style=" margin-top:50px;">
<p align="center"><b style="font-size:17px; text-decoration:underline;">Seat Allotment Details </b></p>
</div>
</table>
</div>

<div class="box-body table-responsive no-padding">
                 
                     
                    <?php
                    if(!empty($allotslip))
                    {
						
                    ?>
                    
                  <table class="table table-hover" border="2" cellspacing="0" cellpadding="2" width="100%">
                            <tr><th align="center">Hostel No</th><td align="center"><?php echo $allotslip[0]->HOSTEL_NO?></td></tr>
                             <tr><th align="center">Hostel Name</th><td align="center"><?php echo $allotslip[0]->HOSTELDESC?></td></tr>
                           <tr><th align="center">Room No</th><td align="center"><?php echo $allotslip[0]->ROOMDESC?></td></tr>
                             <tr><th align="center">Seat</th><td align="center"><?php echo $allotslip[0]->SEAT?></td></tr>
                    <?php
                     
					}
                  else{ 
					echo '<h4 style="color: red; text-align: center">No verified Record exists !</h4>';} ?>
                  </table>
				  
                </div>
                <?php 
	  		$bat = explode('-',$allotslip[0]->SEMCODE);
			$batch = $bat[0];
			if($batch == 'FALL')
			{
			  $today =  date("l", mktime(0, 0, 0, 1, 31, 0));
			  $tdate = date('d/m');
			  if($tdate > date('31/01'))
			  {
	  ?>
                  <div id="background">
  <p id="bg-text"><?php
				  echo 'Expired';?></p>
	</div>
                  <?php
				  
			  }
			  elseif($batch == 'Spring')
			  {
				  $today =  date("l", mktime(0, 0, 0, 1, 31, 0));
			   $tdate = date('d/m');
			  if($tdate > date('31/06'))
			  {
	  ?>
                  <div id="background">
  				  <p id="bg-text">
				  <?php
				  echo 'Expired';?></p></div>
				  <?php 
			  }
			}
		}
	  ?>
<br>
<p align="right" style="margin-top:100px"><b>Signature of the Applicanat </p><br>
<p align="justify"></b>This Hostel Allotment slip is issued provisionally and valid till <b><?php $date = strtotime("+5 day");
echo date('d M, Y', $date);/*'30 March, 2018'*/?></b>.
</p>
<p align="justify"><b>Allotment Slip printed at <?php  echo date("d-m-Y H:i:s"); ?> through IIUI Hostel Web application auto genrated, does not rquired signature from Hostel Authority.</p>
</b></b>
        
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

   
  </body></html>
 <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    
    <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js" type="text/javascript"></script>
  <?php //exit();?>