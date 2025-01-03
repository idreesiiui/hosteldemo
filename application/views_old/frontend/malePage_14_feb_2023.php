<!--------------------------------------
NAVBAR
--------------------------------------->
<nav class="p-0 topnav navbar navbar-expand-lg navbar-dark bg-success fixed-top">
<div class="container">
	<a class="navbar-brand" href="<?php echo base_url();?>"><img class="rounded-circle" width=70 height=70 src="<?php echo base_url();?>/assets/frontend/img/usis/iiui-logo.png"></img><strong> IIUI</strong> Hostels</a>
	<button class="mr-2 navbar-toggler collapsed border" type="button" data-toggle="collapse" data-target="#navbarNavDropdown-1" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse m-2" id="navbarNavDropdown-1">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active"><a class="nav-link" href="<?php echo base_url();?>">Home <span class="sr-only">(current)</span></a></li>
			   <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#"  id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Related Links <!-- <small class="blink text-dark"style="font-size:14px">(New)</small> --></a>
			 <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				        <a class="dropdown-item" href="maleCE">Code of Conduct / Ethics</a>
                <a class="dropdown-item" href="maleGI">Guidelines / Instructions</a>
                <a class="dropdown-item" href="maleCU">Contact Us</a>
            </div>
            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#"  id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Circulars <small class="blink text-dark"style="font-size:12px">(New)</small></a>
			 <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				        <a class="dropdown-item" href="maleLists">List</a>
                <a class="dropdown-item" href="<?php echo base_url();?>maleNotifications">Notifications</a>
                <a class="dropdown-item" href="<?php echo base_url();?>maleForms">Forms</a>
            </div>
            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">How to Apply</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="<?php echo base_url();?>stepguideNA">Step Guide (New Application)</a>
            <a class="dropdown-item" href="<?php echo base_url();?>stepguideA">Step Guide (New Allotment)</a>
            <a class="dropdown-item" href="<?php echo base_url();?>stepguideR">Step Guide (Renewal)</a>
            <a class="dropdown-item" href="<?php echo base_url();?>stepguideFP">Step Guide (Forget Password)</a>
            <a class="dropdown-item" href="<?php echo base_url();?>tutorials">Videos</a>
        </div></li>
            <!-- <li class="nav-item"><a class="nav-link" href="http://usis.iiu.edu.pk:64453/mess/login">Mess</a></li> -->
        </ul>
		<ul class="navbar-nav">
			<li class="nav-item"><a class="nav-link" href="<?php echo base_url();?>login"><i class="fas fa-user"></i> Login</a></li>
		</ul>
	</div>
</div>
</nav>
<!-- End Navbar -->
    
    
    
<!--------------------------------------
HEADER
--------------------------------------->
<div class="jumbotron jumbotron-md jumbotron-fluid mb-3 bg-light" style="background-image: url('<?php echo base_url();?>/assets/frontend/img/usis/headermale.png');background-size:cover; height: 500px;">
	<div class="container text-dark h-100 tofront">
		<div class="row align-items-center justify-content-center text-center text-white mt-5">
			<div class="col-md-10">
				<!-- <h1 class="display-3">Welcome to IIUI <?php //echo $campus; ?> Hostel</h1> -->
            </div>
		</div>
	</div>
</div>
<!-- End Header -->
<!--------------------------------------
MAIN
--------------------------------------->
<div class="m-3 p-3 bg-white">
  <h2 class="bg-white text-success font-weight-bold text-center">Welcome to IIUI <?php echo $campus; ?> Hostels</h2>
<p class="text-center">It has always been utmost desire of the Hostel Management to facilitate and help out the boarders while staying in the University Hostels.</p>
</div>
<!-- Card Overlay -->
<div class="row m-2 bg-white">
    <div class="pt-5 pb-5 col-md-3  card bg-cyan overlay overlay-white text-white  border-white" > <div class="d-flex align-items-center text-center">
            <div class="card-body">
                <h3 class="card-title">New Application</h3>
                <p class="card-text ">
                     Registration for Hostel Seat.
                </p>
                <?php 
					if(!empty($semestercode[0]->IS_ACTIVE) && $semestercode[0]->IS_ACTIVE == 1 && $semestercode[0]->GENDER == 'Male')
					{
				 ?>
			    <button class="btn btn-white btn-round" data-toggle="modal" data-target="#newappopenModal">
                <i class="fas fa-hand-pointer"></i> Click Here
                </button>	
				<?php
                	}
					else
					{
				?>
                <button class="btn btn-white btn-round" data-toggle="modal" data-target="#newappcloseModal">
                <i class="fas fa-hand-pointer"></i> Click Here
                </button>
				<?php
					}
				 ?>
            </div>
        </div>
    </div>
    
  <!-- New Application closed Modal -->
  <div class="modal fade" id="newappcloseModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title"><img src="<?php echo base_url() ?>/assets/frontend/img/usis/iiui-logo.png" width=60; height=60 />
          Online Application for Hostel Registration
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <h5 align="center"> Registration for <?php echo $campus; ?> Hostel IIUI closed</h5>
          <h4 style="color: #F30;" class="blink" align="center">Registration Closed</h4>
          <p style="color:red">For more information and latest update please visit at <a href="http://www.iiu.edu.pk/?page_id=17088">Click here</a> </p>
          <div class="col-md-4">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable" style="width: 480px; margin-left:-20px">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php }else{ ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable" style="width: 485px; margin-left:-20px">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php }} ?>
                
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
       
		   <?php $this->load->helper('form'); ?>
            <div class="row">
                <div class="col-md-12">
                    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                </div>
            </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <a href="<?php echo base_url() ?>login"><button class="btn btn-success">New Student Login</button></a>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  
  <!-- New Application open Modal -->
  <div class="modal fade" id="newappopenModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title"><img src="<?php echo base_url() ?>/assets/frontend/img/usis/iiui-logo.png" width=60; height=60 />
          Online Application for Hostel Registration
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
				<?php
                  if(!empty($semestercode) && isset($semestercode))
                    {		          
                        $startdate = $semestercode[0]->STARTREGDATE;
                        $starttime = $semestercode[0]->STARTREGTIME;
                        $enddate = $semestercode[0]->CLOSEREGDATE;
                        $endtime = $semestercode[0]->ENDREGTIME;
                        $startDay = date('l', strtotime($startdate));
                        $regstartdate = date("jS F, Y", strtotime($startdate));
                        $regstarttime  = date("g:i a", strtotime($starttime));
                        $endday = date('l', strtotime($enddate));
                        $regenddate = date("jS F, Y", strtotime($enddate));
                        $regendtime  = date("g:i a", strtotime($endtime));
    
                    }
               ?>
			  <p class="bg-success text-white text-center">Boys Hostel</p>              
              <h6> Registration for <?php echo "<b>(".$semestercode[0]->PROGRAME.") ".$semestercode[0]->SEMESTEROPENREG."</b>".' and before'; ?></h6>
              <div style="display:none"><span style="color:grey; font-size:12px; margin-left:-190px">(First Come Fisrt Serve Basis)</span></div>
              <h3 style="color: #388F3A;" class="blink" align="center">Registration Open</h3>
              <span style="color:red">Registration open on <?php echo $startDay.','.$regstartdate.' at '.$regstarttime.' and will be closed on '.$endday.' '.$regenddate.' at '.$regendtime?>. For more Information <a href="<?php echo base_url() ?>/maleNotifications" target="_blank">Click here</a> </span>
              <h5>Eligibility Criteria for Hostel Seat</h5>
              <h5 style="font-size:12px;"> New Seat Application for <strong>(BS/LLB/MBA)</strong> Programes from <strong> <?php 
			      if(isset($semestercode)){
				  $bname = $semestercode[0]->BATCHNAME;
				  $first = explode (",", $bname);
				
				  if (strpos($first[0], 'B') !== false) {
    		      	  if($first[0][1] == 'F')
					    {
							echo 'FALL-20'.substr($first[0], -2);
						}
					  elseif($first[0][1] == 'S')
					    {
							echo 'SPRING-20'.substr($first[0], -2);
						}
				   }					
				?> and before</strong></h5>
                <h5 style="font-size:12px;"> New Seat Application for <strong>(M.A/MSC)</strong> Programes from <strong> <?php 
			    
				  $bname = $semestercode[0]->BATCHNAME;
				  $first = explode (",", $bname);
				
				  if (strpos($first[8][0].$first[8][1], 'MA') !== false) {
    		      	  if($first[8][2] == 'F')
					    {
							echo 'FALL-20'.substr($first[8], -2);
						}
					  elseif($first[8][2] == 'S')
					    {
							echo 'SPRING-20'.substr($first[8], -2);
						}
				   }					
				?> and before</strong></h5>
              <h5 style="font-size:12px;"> New Seat Application for <strong>(MS/MPHILL/LLM)</strong> Programes from <strong>      
			  <?php 
			      $bname = $semestercode[0]->BATCHNAME;
				  
				  $first = explode (",", $bname); 
				  if (strpos($first[12], 'M') !== false) {
					 
    		      	  if($first[12][1] == 'F')
					    {
							echo 'FALL-20'.substr($first[12], -2);
						}
						elseif($first[12][1] == 'S')
					    {
							echo 'SPRING-20'.substr($first[12], -2);
						}
				   }
				}
				?> and before</strong></h5>
              <h5 style="font-size:12px;"> New Seat Application for <strong>(PHD)</strong> Programes from <strong>Current Semester and before</strong></h5>
              <h5 style="font-size:12px;"> New Seat Application for <strong>(All Overseas Student)</strong> Programes from <strong> Current Semester and before</strong></h5>
            
              <div class="col-md-4">
                    <?php
                        $this->load->helper('form');
                        $error = $this->session->flashdata('error');
                        if($error)
                        {
                    ?>
                    <div class="alert alert-danger alert-dismissable" style="width: 480px; margin-left:-20px">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('error'); ?>                    
                    </div>
                    <?php }else{ ?>
                    <?php  
                        $success = $this->session->flashdata('success');
                        if($success)
                        {
                    ?>
                    <div class="alert alert-success alert-dismissable" style="width: 485px; margin-left:-20px">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                    <?php }} ?>
                    
                    
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                        </div>
                    </div>
                </div>
           
           <?php $this->load->helper('form'); ?>
            <div class="row">
                <div class="col-md-12">
                    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                </div>
            </div>
          <form role="form" action="<?php echo base_url() ?>appformmale" method="post" id="regbox">
          <div class="row">
                <div class="col-md-6">                                
                    <div class="form-group" style="width:350px">
                    <span style="color:red; font-size:13px" id="msg"></span>
                        <label for="regno">Student Reg No#.</label>
                        <input type="text" required class="form-control required" id="regno" placeholder="123-FBAS/MSSE/S10" name="regno" maxlength="128" style="width:60%">
                    	<input type="hidden" name="programe" value="<?php echo $semestercode[0]->PROGRAME?>">
                        <input type="hidden" class="form-control required" id="semesterdate" value="<?php echo $semestercode[0]->SEMCODE?>" name="regn" maxlength="128">
                      </div>
                    
                </div>
                <div class="col-md-6" style="color: darkgrey;width: 200px;height: 100px;float: right;">e.g 123-FBAS/MSSE/F09 <br/>(Reg No# Case Sensitive)<br/>
                Please Enter Registrarion number as per Student Card</div>
                </div><hr>
                	<input type="submit" class="btn btn-success" value="Submit" />
                    <input type="reset" class="btn btn-default" value="Reset" />
                
        </form>
       </div>
        
      </div>
    </div>
  </div>

    <div class="pt-5 pb-5 col-md-3  card bg-purple overlay overlay-white text-white  border-white" > <div class="d-flex align-items-center text-center">
            <div class="card-body">
                <h3 class="card-title">Renewal</h3>
                <p class="card-text">
                     Apply for Seat Renewal.
                </p>
                <?php 
					if(!empty($semestercode[0]->IS_ACTIVE) && $semestercode[0]->IS_ACTIVE == 1 && $semestercode[0]->GENDER == 'Male')
					{
				 ?>
			    <a href="<?php echo base_url() ?>login" class="btn btn-white btn-round">
                <i class="fas fa-hand-pointer"></i> Click Here
                </a>	
				<?php
                	}
					else
					{
				?>
                <button class="btn btn-white btn-round" data-toggle="modal" data-target="#renewcloseModal">
                <i class="fas fa-hand-pointer"></i> Click Here
                </button>
				<?php
					}
				 ?>
                
            </div>
        </div>
    </div>
    
     <!-- Renewal close Modal -->
  <div class="modal fade" id="renewcloseModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title"><img src="<?php echo base_url() ?>/assets/frontend/img/usis/iiui-logo.png" width=60; height=60 />
          Renewal of Hostel Seat
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <h5 align="center"> Renewal for <?php echo $campus; ?> Hostel IIUI closed</h5>
          <h4 style="color: #F30;" class="blink" align="center">Renewal Closed</h4>
          <p>For more information and latest update please visit <a href="http://www.iiu.edu.pk/?page_id=17088">here</a> </p>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <a href="<?php echo base_url() ?>login"><button class="btn btn-success">New Student Login</button></a>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  
    <div class="pt-5 pb-5 col-md-3  card bg-info overlay overlay-white text-white  border-white" > <div class="d-flex align-items-center text-center">
            <div class="card-body">
                <h3 class="card-title">Seat Change</h3>
                <p class="card-text">
                     Apply for seat change / Interchange.
                </p>
                <?php 
				if(!empty($semestercode) && $semestercode[0]->SEATCHANGESTATUS == 1 && $semestercode[0]->GENDER == 'Male')
				{
				 ?>
			    <a href="<?php echo base_url() ?>login" class="btn btn-white btn-round">
                <i class="fas fa-hand-pointer"></i> Click Here
                </a>	
				<?php
                	}
					else
					{
				?>
                <button class="btn btn-white btn-round" data-toggle="modal" data-target="#schangecloseModal">
                <i class="fas fa-hand-pointer"></i> Click Here
                </button>
				<?php
					}
				 ?>
            </div>
        </div>
    </div>
    
     <!-- Seat change close Modal -->
  <div class="modal fade" id="schangecloseModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title"><img src="<?php echo base_url() ?>/assets/frontend/img/usis/iiui-logo.png" width=60; height=60 />
           Change / Interchange of  Hostel Seat
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <h5 align="center"> Seat change / Interchange for <?php echo $campus; ?> Hostel IIUI closed</h5>
          <h4 style="color: #F30;" class="blink" align="center">Seat Change / Interchange Closed</h4>
          <p>For more information and latest update please visit <a href="http://www.iiu.edu.pk/?page_id=17088">here</a> </p>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <a href="<?php echo base_url() ?>login"><button class="btn btn-success">New Student Login</button></a>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  
    <div class="pt-5 pb-5 col-md-3  card bg-danger overlay overlay-white text-white border-white"> <div class="d-flex align-items-center text-center">
            <div class="card-body">
                <h3 class="card-title">MESS</h3>
                <p class="card-text">
                     Register Yourself for Mess.
                </p>
                <a href="#" class="btn btn-white btn-round btn-disable">
                <i class="fas fa-hand-pointer"></i> Click Here
                </a>
            </div>
        </div>
    </div>
  </div> 

<!-- End Cards-->

<!--<div class="aos-init aos-animate bg-white" data-aos="fade-up">
	<div class="card-header bg-success text-white text-center border-0 m-3 pt-3 pb-3">
		<h3 class="my-0 font-weight-normal"><i class="fas fa-file-download"></i> Download Fee Challan</h3>
	</div>
	<div class="row m-4">
	    <div class="col-md-3 mb-2">
			<div class="media">
				<div class="iconbox iconmedium rounded-circle text-success mr-4">
					<i class="fas fa-print"></i>
				</div>
				<div class="media-body">
					<p class="text-muted">
						<h3>Fee Challan</h3>
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-3 mb-2">
			<div class="media">
				<div class="iconbox iconmedium rounded-circle text-success mr-4">
					<i class="fas fa-print"></i>
				</div>
				<div class="media-body">
					<p class="text-muted">
						<h3>Fee Challan</h3>
					</p>
				</div>
			</div>
		</div>
        <div class="col-md-3 mb-2">
			<div class="media">
				<div class="iconbox iconmedium rounded-circle text-success mr-4">
					<i class="fas fa-print"></i>
				</div>
				<div class="media-body">
					<p class="text-muted">
						<h3>Fee Challan</h3>
					</p>
				</div>
			</div>
		</div>
        <div class="col-md-3 mb-2">
			<div class="media">
				<div class="iconbox iconmedium rounded-circle text-success mr-4">
					<i class="fas fa-print"></i>
				</div>
				<div class="media-body">
					<p class="text-muted">
						<h3>Fee Challan</h3>
					</p>
				</div>
			</div>
		</div>
	</div>-->
<!--<div class="bg-light p-4 aos-init aos-animate" id="contactus" data-aos="fade-up">
	<h3 class="my-0 font-weight-bold text-success text-center">Contact Us</h3>
    <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable" id="successmsg" style="width: 480px; margin-left:-20px">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php }else{ ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable" id="errormsg" style="width: 485px; margin-left:-20px">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php }} ?>
	<form role="form" action="<?php echo base_url() ?>feedback" method="post" id="contactform" class="m-4">
	<div class="row form-group">
		<div class="col-md-4 mb-4">
			<input type="text" class="form-control" name="feedbackName" required  placeholder="Full Name">
            <input type="hidden" class="form-control" name="type" required  value="male">
		</div>
		<div class="col-md-4 mb-4">
			<input type="text" class="form-control" name="feedbackCNIC" required placeholder="CNIC / Reg. No.">
		</div>
		<div class="col-md-4 mb-4">
			<input type="email" class="form-control" name="feedbackEmail"  required placeholder="Email">
		</div>
	</div>
	<div class="form-group">
		<textarea class="form-control" name="feedbackMessage" placeholder="Your Message Here ...." rows="6"></textarea>
	</div>
	<button type="submit" class="btn btn-success btn-round">Submit</button>
	</form>
</div>-->
<!-- End Main -->
  
<!--------------------------------------
FOOTER
--------------------------------------->
<!-- dark footer -->
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1440 126" style="enable-background:new 0 0 1440 126;" xml:space="preserve">
<path class="bg-dark" d="M685.6,38.8C418.7-11.1,170.2,9.9,0,30v96h1440V30C1252.7,52.2,1010,99.4,685.6,38.8z"></path>
</svg>
<footer class="bg-dark p-3">
<div class="container">
	<div class="row  mb-1">
		<div class="col-md-3">
			<h4 class="mb-1 text-white">Circulars <small class="blink text-warning"style="font-size:12px">(New)</small></h4>
        <hr class="footer-menu mb-3">
			  <ul class="list-unstyled text-small text-success">
				  <li><a class="text-gray" href="maleLists"><i class="fa fa-list text-success"></i> Lists</a></li>
          <li><a class="text-gray" href="maleNotifications"><i class="fa fa-list text-success"></i> Notifications</a></li>
          <li><a class="text-gray" href="maleForms"><i class="fa fa-list text-success"></i> Forms</a></li>
			  </ul>
		</div>
		<div class="col-md-3">
			<h4 class="mb-1 text-white">Boys Hostel</h4>
      <hr class="footer-menu mb-3">
      <ul class="list-unstyled text-small text-success">
        <li><a class="text-gray" href="malePage"><i class="fa fa-building text-success"></i> Boys Hostel</a></li>
        <li><p class="text-gray"><i class="fas fa-phone-square text-success"></i> +92-51-9019586</p></li>
        <li><p class="text-gray"><i class="fas fa-envelope text-success"></i> hostel.male@iiu.edu.pk</p></li>
      </ul>
		</div>
		<div class="col-md-3">
			<h4 class="mb-1 text-white ">Queries</h4>
            <hr class="footer-menu mb-3">
			<ul class="list-unstyled text-small">
				<!-- <li><a class="text-gray" href="#"><i class="fa fa-question-circle text-success"></i> FAQs</a></li> 
				<li><a class="text-gray" href="maleCU"><i class="fa fa-envelope text-success"></i> Contact Us</a></li>-->
			</ul>
		</div>
		<div class="col-md-3">
			<h4 class="mb-1 text-white">Location Map</h4>
            <hr class="footer-menu mb-3">
            <a href="https://www.google.com/maps/place/International+Islamic+University+Islamabad/@33.6592924,73.0242036,16z/data=!4m5!3m4!1s0x38df95906a03cfff:0x2b2f1c1c99b676ce!8m2!3d33.6593237!4d73.023753" target="_blank" rel="noopener noreferrer"><img class="d-block w-100 footer-img" src="<?php echo base_url();?>/assets/frontend/img/usis/locationmap.png" alt="locamap">
            </a>
		</div>
    </div>
	<div class="row bg-dark">
		<div class="col-md-9">			
			<small class="d-block mt-3  text-light"><i class="fas fa-copyright text-success"></i>
			<script>document.write(new Date().getFullYear())</script>
			 IIUI Hostel Automation System. All rights reserved | Powered by <span class="text-success" target="_blank" href="#">IT Center, IIUI</span></small>
		</div>
		<div class="col-md-3">
			<ul class="list-unstyled list-inline pull-right text-small text-success">
				<li class="list-inline-item"><a class="nav-link  text-success" href="https://twitter.com/iiui_official"><i class="fab fa-twitter"></i></a></li>
				<li class="list-inline-item"><a class="nav-link  text-success" href="https://www.facebook.com/iiu.isbpk/"><i class="fab fa-facebook"></i></a></li>
				<li class="list-inline-item"><a class="nav-link  text-success" href="https://www.linkedin.com/company/iiui"><i class="fab fa-linkedin"></i></a></li>
				<li class="list-inline-item"><a class="nav-link  text-success" href="https://iiu.edu.pk"><i class="fa fa-globe"></i></a></li>
			</ul>
		</div>
	</div>
 </div>
</footer>
<!-- End Footer -->
<script>
    $(document).ready(function(){
		var error = "<?php echo $this->session->flashdata('error'); ?>"
		var success = "<?php echo $this->session->flashdata('success'); ?>"		
		if((success && success != 'Message has been sent.' ) || (error && error != 'Message could not be sent.')){
			$("#newappopenModal").modal('show');
		}
		else{
			$("#newappopenModal").modal('hide');
		}
		
    });

</script>