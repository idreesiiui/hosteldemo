<!--------------------------------------
NAVBAR
--------------------------------------->
<nav class="p-0 topnav navbar navbar-expand-lg navbar-dark bg-success fixed-top">
<div class="container">
	<a class="navbar-brand" href="<?php echo base_url();?>"><img class="rounded-circle" width=80 height=80 src="<?php echo base_url();?>/assets/frontend/img/usis/iiui-logo.png"></img><strong> IIUI</strong> Hostels</a>
	<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarNavDropdown-1" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse m-2" id="navbarNavDropdown-1">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active"><a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a></li>
			<li class="nav-item"><a class="nav-link" href="#">Features</a></li>
			<li class="nav-item"><a class="nav-link" href="#">Pricing</a></li>
			<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="https://wowthemes.net" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Services</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				<a class="dropdown-item" href="#">Design</a><a class="dropdown-item" href="#">Development</a><a class="dropdown-item" href="#">Marketing</a>
			</div>
			</li>
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
<div class="jumbotron jumbotron-lg jumbotron-fluid mb-3 bg-success position-relative  main-header" style="background-image: url('<?php echo base_url();?>/assets/frontend/img/usis/bgpics.png'); ">
	<div class="container text-white h-100 tofront">
		<div class="row align-items-center justify-content-center text-center mt-5">
			<div class="col-md-10">
				<h1 class="display-3">Welcome to IIUI Hostel Student Portal</h1>
                <h5 class="font-weight-light">It has always been utmost desire of the Hostel Management</h5> 
                <h5 class="font-weight-light">to facilitate and help out the boarders while staying in the University Hostels.</h5>
				<div class="row justify-content-center mt-5">
					<div class="col-lg-3">
						<a class="btn btn-warning shadow shadow-lg btn-lg d-block mb-2 btn-round" href="<?php echo base_url();?>regbox/signupmale"> <!--data-toggle="modal" data-target="#modal_newsletter">-->
						<i class="fas fa-male mr-1"></i> Male Hostel
						</a>
					</div>
					<div class="col-lg-3">
						<a target="_blank" class="btn btn-info shadow-lg btn-lg d-block mb-2 btn-round" href="https://github.com/wowthemesnet/Anchor-Bootstrap-UI-Kit/fork">
						<i class="fas fa-female mr-1"></i> Female Hostel </a>
					</div>
					<div class="col-lg-3">
						<a target="_blank" class="btn btn-danger shadow-lg btn-lg d-block mb-2 btn-round" href="<?php echo base_url();?>login">
						<i class="fas fa-user"></i> Login</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Header -->
<!--------------------------------------
MAIN
--------------------------------------->

<!-- cards -->
<div class=" row card-deck card-pricing text-center m-5">
	<div class="col-md-4 border shadow-sm aos-init aos-animate mb-2 " data-aos="fade-up">
		<div class="card-header bg-success text-white border-0 pt-4 pb-4">
			<i class="fas fa-building fa-2x"></i>
			<h3 class="my-0 font-weight-bold mb-2">Hostels</h3>
			<h4 class="font-weight-bold">15</h4>
		</div>
		<div class="card-body">
			<ul class="list-unstyled mt-3 mb-4">
				<li>8 Male Hostels</li>
				<li>7 Female Hostels</li>
			</ul>
		</div>
	</div>
    <div class="col-md-4 border shadow-sm aos-init aos-animate mb-2 " data-aos="fade-up">
		<div class="card-header bg-success text-white border-0 pt-4 pb-4">
			<i class="fas fa-building fa-2x"></i>
			<h3 class="my-0 font-weight-bold text-white mb-2">Rooms</h3>
			<h4 class="font-weight-bold">2000+</h4>
		</div>
		<div class="card-body">
			<ul class="list-unstyled mt-3 mb-4">
				<li>Includes Cubical Rooms </li>
				<li>Two and Three Seater Rooms</li>
			</ul>
		</div>
	</div>
    <div class="col-md-4 border shadow-sm aos-init aos-animate mb-2" data-aos="fade-up">
		<div class="card-header bg-success text-white border-0 pt-4 pb-4">
			<i class="fas fa-users fa-2x"></i>
			<h3 class="my-0 font-weight-bold mb-2">Students</h3>
			<h4 class="font-weight-bold">5000+</h4>
		</div>
		<div class="card-body">
			<ul class="list-unstyled mt-3 mb-4">
				<li>More than 3000 male students</li>
				<li>More than 2500 female students</li>
			</ul>
		</div>
	</div>
</div>

<!-- End Cards-->

<div id="carouselExampleIndicators" class="mb-3 carousel slide carousel-fade" data-ride="carousel">
	<ol class="carousel-indicators">
		<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
	</ol>
	<div class="carousel-inner shadow-sm rounded">
		<div class="carousel-item active">
			<img class="d-block w-100" src="<?php echo base_url();?>/assets/frontend/img/usis/bgpics2.png" alt="First slide">
			<div class="carousel-caption d-none d-md-block">
				<!--<h5>Mountains, Nature Collection</h5>-->
			</div>
		</div>
		<div class="carousel-item">
			<img class="d-block w-100 " src="<?php echo base_url();?>/assets/frontend/img/usis/bgpics3.jpg" alt="Second slide">
			<div class="carousel-caption d-none d-md-block">
				<!--<h5>Freedom, Sea Collection</h5>-->
			</div>
		</div>
		<div class="carousel-item">
			<img class="d-block w-100" src="<?php echo base_url();?>/assets/frontend/img/usis/bgpics4.png" alt="Third slide">
			<div class="carousel-caption d-none d-md-block">
				<!--<h5>Living the Dream, Lost Island</h5>-->
			</div>
		</div>
	</div>
</div>

<div class="aos-init aos-animate" data-aos="fade-up">
	<div class="card-header bg-success text-white text-center border-0 m-3 pt-3 pb-3">
		<h3 class="my-0 font-weight-normal">Facilities</h3>
	</div>
	<div class="row m-4">
		<div class="col-md-2 mb-2">
			<div class="media">
				<div class="iconbox iconsmall rounded-circle text-success mr-4">
					<i class="fas fa-utensils"></i>
				</div>
				<div class="media-body">
					<p class="text-muted">
						<h5 style="line-height:.5">Mess</h5>
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-3 mb-2">
			<div class="media">
				<div class="iconbox iconsmall rounded-circle text-success mr-4">
					<i class="fas fa-futbol"></i>
				</div>
				<div class="media-body">
					<p class="text-muted">
						<h5 style="line-height:.5">Play Grounds</h5>
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-2 mb-2">
			<div class="media">
				<div class="iconbox iconsmall rounded-circle text-success mr-4">
					<i class="fas fa-wifi"></i>
				</div>
				<div class="media-body">
					<p class="text-muted">
						<h5 style="line-height:.5">Internet</h5>
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-2 mb-2">
			<div class="media">
				<div class="iconbox iconsmall rounded-circle text-success mr-4">
					<i class="fas fa-plug"></i>
				</div>
				<div class="media-body">
					<p class="text-muted">
						<h5 style="line-height:.5">Electricity</h5>
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-3 mb-2">
			<div class="media">
				<div class="iconbox iconsmall rounded-circle text-success mr-4">
					<i class="fas fa-mosque"></i>
				</div>
				<div class="media-body">
					<p class="text-muted">
						<h5 style="line-height:.5">Prayer Hall</h5>
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-2 mb-2">
			<div class="media">
				<div class="iconbox iconsmall rounded-circle text-success mr-4">
					<i class="fas fa-medkit"></i>
				</div>
				<div class="media-body">
					<p class="text-muted">
						<h5 style="line-height:.5">First Aid</h5>
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-3 mb-2">
			<div class="media">
				<div class="iconbox iconsmall rounded-circle text-success mr-4">
					<i class="fas fa-user-md"></i>
				</div>
				<div class="media-body">
					<p class="text-muted">
						<h5 style="line-height:.5">Medical Checkup</h5>
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-2 mb-2">
			<div class="media">
				<div class="iconbox iconsmall rounded-circle text-success mr-4">
					<i class="fas fa-burn"></i>
				</div>
				<div class="media-body">
					<p class="text-muted">
						<h5 style="line-height:.5">Gas</h5>
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-2 mb-2">
			<div class="media">
				<div class="iconbox iconsmall rounded-circle text-success mr-4">
					<i class="fas fa-shower"></i>
				</div>
				<div class="media-body">
					<p class="text-muted">
						<h5 style="line-height:.5">Water</h5>
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-3 mb-2">
			<div class="media">
				<div class="iconbox iconsmall rounded-circle text-success mr-4">
					<i class="fas fa-ambulance"></i>
				</div>
				<div class="media-body">
					<p class="text-muted">
						<h5 style="line-height:.5">Ambulance Service</h6>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="bg-light p-4 aos-init aos-animate" data-aos="fade-up">
	<h3 class="my-0 font-weight-bold text-success text-center">Contact Us</h3>
	<form class="m-4">
	<div class="row form-group">
		<div class="col-md-4 mb-4">
			<input type="text" class="form-control" id="feedbackName" placeholder="Full Name">
		</div>
		<div class="col-md-4 mb-2">
			<input type="text" class="form-control" id="feedbackCNIC" placeholder="CNIC / Reg. No.">
		</div>
		<div class="col-md-4 mb-2">
			<input type="text" class="form-control" id="feedbackEmail" placeholder="Email">
		</div>
	</div>
	<div class="form-group">
		<textarea class="form-control" id="feedbackTextarea" placeholder="Your Message Here ...." rows="6"></textarea>
	</div>
	<button type="submit" class="btn btn-success btn-round">Submit</button>
	</form>
</div>

<!-- End Main -->
    
    
<!--------------------------------------
FOOTER
--------------------------------------->

<footer class="bg-white p-3">
<div class="container">
	<div class="row  mb-3">
		<div class="col-md-3">
			<h5 class="mb-4 text-success">Hostel (Male)</h5>
            <hr>
			<ul class="list-unstyled text-small text-success">
				<li ><a class="text-muted" href="#">Cool stuff</a></li>
				<li><a class="text-muted" href="#">Random feature</a></li>
				<li><a class="text-muted" href="#">Team feature</a></li>
				<li><a class="text-muted" href="#">Stuff for developers</a></li>
			</ul>
		</div>
		<div class="col-md-3">
			<h5 class="mb-4 text-success">Hostel (Female)</h5>
            <hr>
			<ul class="list-unstyled text-small">
				<li><a class="text-muted" href="#">Resource</a></li>
				<li><a class="text-muted" href="#">Resource name</a></li>
				<li><a class="text-muted" href="#">Another resource</a></li>
				<li><a class="text-muted" href="#">Final resource</a></li>
			</ul>
		</div>
		<div class="col-md-3">
			<h5 class="mb-4 text-success ">Fee Structure</h5>
            <hr>
			<ul class="list-unstyled text-small">
				<li><a class="text-muted" href="#">Business</a></li>
				<li><a class="text-muted" href="#">Education</a></li>
				<li><a class="text-muted" href="#">Government</a></li>
				<li><a class="text-muted" href="#">Gaming</a></li>
			</ul>
		</div>
		<div class="col-md-3">
			<h5 class="mb-4 text-success">Location Map</h5>
            <hr>
            <a href="https://www.google.com/maps/place/International+Islamic+University+Islamabad/@33.6592924,73.0242036,16z/data=!4m5!3m4!1s0x38df95906a03cfff:0x2b2f1c1c99b676ce!8m2!3d33.6593237!4d73.023753" target="_blank" rel="noopener noreferrer"><img class="d-block w-100 footer-img" src="<?php echo base_url();?>/assets/frontend/img/usis/locationmap.png" alt="locamap">
            </a>
		</div>
    </div>
	<div class="row bg-light border">
		<div class="col-md-9 ">			
			<small class="d-block mt-3  text-muted"><i class="fas fa-copyright text-success"></i>
			<script>document.write(new Date().getFullYear())</script>
			 IIUI Hostel Automation System. All rights reserved | Powerd by <span class="text-success" target="_blank" href="#">IT Center, IIUI</span></small>
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
