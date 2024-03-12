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
      <li class="nav-item "><a class="nav-link" href="<?php echo base_url();?>">Home <span class="sr-only">(current)</span></a></li>
      <li class="nav-item"><a class="nav-link" href="<?php echo base_url();?>malePage">Boys Hostel</a></li>
      <li class="nav-item"><a class="nav-link" href="<?php echo base_url();?>femalePage">Girls Hostel</a></li>
      <li class="nav-item active dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">How to Apply</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="<?php echo base_url();?>stepguideNA">Step Guide (New Application)</a>
            <a class="dropdown-item" href="<?php echo base_url();?>stepguideA">Step Guide (New Allotment)</a>
            <a class="dropdown-item" href="<?php echo base_url();?>stepguideR">Step Guide (Renewal)</a>
            <a class="dropdown-item" href="<?php echo base_url();?>stepguideFP">Step Guide (Forget Password)</a>
            <a class="dropdown-item" href="<?php echo base_url();?>tutorials">Videos</a>
        </div></li>
      <li class="nav-item"><a class="nav-link" href="#contactus">Contact Us</a></li>
      
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
<div class="jumbotron jumbotron-md jumbotron-fluid mb-3 bg-light" style="background-image: url('<?php echo base_url();?>/assets/frontend/img/usis/headermale.png');background-size:cover;">
	<div class="container text-dark h-100 tofront">
		<div class="row align-items-center justify-content-center text-center text-white mt-5">
			<div class="col-md-10">
				<h1 class="display-3">Step Guide Renewal</h1>
            </div>
		</div>
	</div>
</div>
<!-- End Header -->
<!--------------------------------------
MAIN
--------------------------------------->

<!-- Card Overlay -->
<div class="row m-2 bg-white">

    <div class="pt-3 pb-3 col-md-12  card overlay overlay-white text-white border-white"> 
    	<div class="d-flex align-items-center text-center">
            <div class="card-body text-dark">
                <h4 class="card-title ">Step 1: Renewal</h4>
                <p class="card-text">
                     Visit <b class="text-danger">https://iiu.edu.pk/hostel</b> For Hostel Automation System Main Page.
                </p>
                  <img src="<?php echo base_url();?>uploads/screenshots/NewApplication/1.newApplication.png"/>
             </div>
        </div>
    </div>

    <div class="pt-3 pb-3 col-md-12  card overlay overlay-white text-white border-white"> 
    	<div class="d-flex align-items-center text-center">
            <div class="card-body text-dark">
                <h4 class="card-title ">Step 2: Renewal</h4>
                <p class="card-text">
                     Click on relevant Hostel (Male or Female) to further proceed.
                </p>
                  <img src="<?php echo base_url();?>uploads/screenshots/NewApplication/2.newApplication.png"/>
             </div>
        </div>
    </div>

    <div class="pt-3 pb-3 col-md-12  card overlay overlay-white text-white border-white"> 
    	<div class="d-flex align-items-center text-center">
            <div class="card-body text-dark">
                <h4 class="card-title ">Step 3: Guide Renewal</h4>
                <p class="card-text">
                     On Campus Page  (Male or Female)  Click on <b class="text-danger">Renewal</b> Section.
                </p>
                  <img src="<?php echo base_url();?>uploads/screenshots/Reallotment/0.Reallotment.png"/>
             </div>
        </div>
    </div>

    <div class="pt-3 pb-3 col-md-12  card overlay overlay-white text-white border-white"> 
    	<div class="d-flex align-items-center text-center">
            <div class="card-body text-dark">
                <h4 class="card-title ">Step 4: Rellotment</h4>
                <p class="card-text">
                    Enter Your <b class="text-danger">Reg. No. As per university card and click on Submitt button</b> to further Proceed.
                </p>
                  <img src="<?php echo base_url();?>uploads/screenshots/Reallotment/1.Reallotment.png"/>
             </div>
        </div>
    </div>

    <div class="pt-3 pb-3 col-md-12  card overlay overlay-white text-white border-white"> 
    	<div class="d-flex align-items-center text-center">
            <div class="card-body text-dark">
                <h4 class="card-title ">Step 5: Renewal</h4>
                <p class="card-text">
                  After Login in Click on <b class="text-danger">Fee Challan Link</b> to view Challan .
                </p>
                  <img src="<?php echo base_url();?>uploads/screenshots/Reallotment/2.Reallotment.png"/>
             </div>
        </div>
    </div>

    <div class="pt-3 pb-3 col-md-12  card overlay overlay-white text-white border-white"> 
    	<div class="d-flex align-items-center text-center">
            <div class="card-body text-dark">
                <h4 class="card-title ">Step 6: Renewal</h4>
                <p class="card-text">
                    Take <b class="text-danger"> Print </b> of challan and submit fee in the bank.
                </p>
                  <img src="<?php echo base_url();?>uploads/screenshots/Reallotment/3.Reallotment.png"/>
             </div>
        </div>
    </div>

    <div class="pt-3 pb-3 col-md-12  card overlay overlay-white text-white border-white"> 
      <div class="d-flex align-items-center text-center">
            <div class="card-body text-dark">
                <h4 class="card-title ">Step 7: Renewal</h4>
                <p class="card-text">
                    After Fee submission Click on <b class="text-danger">Apply For Renewal Link</b> to enter challan details and apply for renewal.
                </p>
                  <img src="<?php echo base_url();?>uploads/screenshots/Reallotment/44.Reallotment.png"/>
             </div>
        </div>
    </div>

    <div class="pt-3 pb-3 col-md-12  card overlay overlay-white text-white border-white"> 
      <div class="d-flex align-items-center text-center">
            <div class="card-body text-dark">
                <h4 class="card-title ">Step 8: Renewal</h4>
                <p class="card-text">
                     Enter feel challan Details <b class="text-danger"> Challan Amount and Number </b> and click on <b class="text-danger"> Apply </b> to further proceed.
                </p>
                  <img src="<?php echo base_url();?>uploads/screenshots/Reallotment/4.Reallotment.png"/>
             </div>
        </div>
    </div>

    <div class="pt-3 pb-3 col-md-12  card overlay overlay-white text-white border-white"> 
      <div class="d-flex align-items-center text-center">
            <div class="card-body text-dark">
                <h4 class="card-title ">Step 9: Renewal</h4>
                <p class="card-text">
                   Once Renewal application is submitted successfully. An alert will be displayed.
                </p>
                  <img src="<?php echo base_url();?>uploads/screenshots/Reallotment/5.Reallotment.png"/>
             </div>
        </div>
    </div>

    <div class="pt-3 pb-3 col-md-12  card overlay overlay-white text-white border-white"> 
    	<div class="d-flex align-items-center text-center">
            <div class="card-body text-dark">
                <h4 class="card-title ">Step 10: Renewal</h4>
                <p class="card-text">
                     You will recieve an <b class="text-danger">Email</b> about renewal application confirmation.
                </p>
                  <img src="<?php echo base_url();?>uploads/screenshots/Reallotment/6.Reallotment.png"/>
             </div>
        </div>
    </div>

    <div class="pt-3 pb-3 col-md-12  card overlay overlay-white text-white border-white"> 
      <div class="d-flex align-items-center text-center">
            <div class="card-body text-dark">
                <h4 class="card-title ">Step 11: Renewal</h4>
                <p class="card-text">
                    After Online Renwal Application Click on <b class="text-danger">Renewal Form Link</b> to download or print Renewal Form .
                </p>
                  <img src="<?php echo base_url();?>uploads/screenshots/Reallotment/77.Reallotment.png"/>
             </div>
        </div>
    </div>

    <div class="pt-3 pb-3 col-md-12  card overlay overlay-white text-white border-white"> 
    	<div class="d-flex align-items-center text-center">
            <div class="card-body text-dark">
                <h4 class="card-title ">Step 12: Renewal</h4>
                <p class="card-text">
                    You will view <b class="text-danger"> Renewal form</b> <br>Take Print and submitt it with other required doucments to provost office.
                </p>
                  <img src="<?php echo base_url();?>uploads/screenshots/Reallotment/7.Reallotment.png"/>
             </div>
        </div>
    </div>
    
  </div> 

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
      <h4 class="mb-1 text-white">Hostel (Male)</h4>
            <hr class="footer-menu mb-3">
      <ul class="list-unstyled text-small text-success">
        <li><p class="text-gray"><i class="fa fa-building text-success"></i> Male Hostel</p></li>
        <li><p class="text-gray"><i class="fas fa-phone-square text-success"></i> +92-51-9019586</p></li>
        <li><p class="text-gray"><i class="fas fa-envelope text-success"></i> hostel.male@iiu.edu.pk</p></li>
      </ul>
    </div>
    <div class="col-md-3">
      <h4 class="mb-1 text-white">Hostel (Female)</h4>
            <hr class="footer-menu mb-3">
      <ul class="list-unstyled text-small">
        <li><p class="text-gray"><i class="fa fa-building text-success"></i> Female Hostel</p></li>
        <li><p class="text-gray"><i class="fas fa-phone-square text-success"></i> +92-51-9019879</p></li>
        <li><p class="text-gray"><i class="fas fa-envelope text-success"></i> hostel.female@iiu.edu.pk</p></li>
      </ul>
    </div>
    <div class="col-md-3">
      <h4 class="mb-1 text-white ">Queries</h4>
            <hr class="footer-menu mb-3">
      <ul class="list-unstyled text-small">
        <li><a class="text-gray" href="#"><i class="fa fa-question-circle text-success"></i> FAQs</a></li>
        <li><a class="text-gray" href="#"><i class="fa fa-envelope text-success"></i> Contact Us</a></li>
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