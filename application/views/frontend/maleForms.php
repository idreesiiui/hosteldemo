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
			<li class="nav-item"><a class="nav-link" href="<?php echo base_url();?>">Home <span class="sr-only">(current)</span></a></li>
			   <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#"  id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Related Links <!-- <small class="blink text-dark"style="font-size:14px">(New)</small> --></a>
			 <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				<a class="dropdown-item" href="maleCE">Code of Conduct / Ethics</a>
                <a class="dropdown-item" href="maleGI">Guidelines / Instructions</a>
                <a class="dropdown-item" href="maleCU">Contact Us</a>
            </div>
            <li class="nav-item active dropdown"><a class="nav-link dropdown-toggle" href="#"  id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Circulars <small class="blink text-dark"style="font-size:12px">(New)</small></a>
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
            <li class="nav-item"><a class="nav-link" href="http://usis.iiu.edu.pk:64453/mess/login">Mess</a>
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
				<h1 class="display-3">Forms <?php echo $campus; ?> Hostel</h1>
            </div>
		</div>
	</div>
</div>
<!-- End Header -->
<!--------------------------------------
MAIN
--------------------------------------->
<div class="bg-white m-3">
<h2 class="bg-white text-success font-weight-bold text-center">Forms</h2>
<!-- table -->
<table class="table border" style="text-align: center;">
<thead class="bg-success text-white">
<tr>
	<th scope="col"> #      </th>
	<th scope="col"> Brief Description	</th>
	<th scope="col"> Details	</th>
</tr>
</thead>
<tbody>
<tr>
	<th scope="row"> 1	</th>
	<td> Hostel Application Form </td>
	<td><a href="<?php echo base_url();?>uploads/notifications/male/forms/Hostel_Application_Form_240815.pdf" target="_blank" rel="noopener noreferrer"><img src="<?php echo base_url();?>assets/frontend/img/usis/download.png" width=100 height=30 border="0" alt="Download"></a></td>
</tr>
<tr>
	<th scope="row"> 2	</th>
	<td> Seat Renewal Form </td>
	<td><a href="<?php echo base_url();?>uploads/notifications/male/forms/Seat-Renewal-Form-1122020.pdf" target="_blank" rel="noopener noreferrer"><img src="<?php echo base_url();?>assets/frontend/img/usis/download.png" width=100 height=30 border="0" alt="Download"></a></td>
</tr>
<tr>
	<th scope="row"> 3	</th>
	<td> Seat Change Form </td>
	<td><a href="<?php echo base_url();?>uploads/notifications/male/forms/Seat_change_performa_201015.pdf" target="_blank" rel="noopener noreferrer"><img src="<?php echo base_url();?>assets/frontend/img/usis/download.png" width=100 height=30 border="0" alt="Download"></a></td>
</tr>
<tr>
	<th scope="row"> 4	</th>
	<td> Seat Interchange Form </td>
	<td><a href="<?php echo base_url();?>uploads/notifications/male/forms/Seat_interchange_performa_201015.pdf" target="_blank" rel="noopener noreferrer"><img src="<?php echo base_url();?>assets/frontend/img/usis/download.png" width=100 height=30 border="0" alt="Download"></a></td>
</tr>
<tr>
	<th scope="row"> 5	</th>
	<td> Clearence Form </td>
	<td><a href="<?php echo base_url();?>uploads/notifications/male/forms/Hostel_Clearance_Form_200117.pdf" target="_blank" rel="noopener noreferrer"><img src="<?php echo base_url();?>assets/frontend/img/usis/download.png" width=100 height=30 border="0" alt="Download"></a></td>
</tr>
<tr>
	<th scope="row"> 6	</th>
	<td> Mess Membership Form </td>
	<td><a href="<?php echo base_url();?>uploads/notifications/male/forms/mess-membership-form-141118.pdf" target="_blank" rel="noopener noreferrer"><img src="<?php echo base_url();?>assets/frontend/img/usis/download.png" width=100 height=30 border="0" alt="Download"></a></td>
</tr>
<tr>
	<th scope="row"> 7	</th>
	<td> Refundable Security Form </td>
	<td><a href="<?php echo base_url();?>uploads/notifications/male/forms/refundable-security-form-200117.pdf" target="_blank" rel="noopener noreferrer"><img src="<?php echo base_url();?>assets/frontend/img/usis/download.png" width=100 height=30 border="0" alt="Download"></a></td>
</tr>
<tr>
	<th scope="row"> 8	</th>
	<td> Hostel Complaint Form </td>
	<td><a href="<?php echo base_url();?>uploads/notifications/male/forms/complaint-form-160919.pdf" target="_blank" rel="noopener noreferrer"><img src="<?php echo base_url();?>assets/frontend/img/usis/download.png" width=100 height=30 border="0" alt="Download"></a></td>
</tr>
<tr>
	<th scope="row"> 9	</th>
	<td> NOC Form </td>
	<td><a href="<?php echo base_url();?>uploads/notifications/male/forms/NOC-form-200117.pdf" target="_blank" rel="noopener noreferrer"><img src="<?php echo base_url();?>assets/frontend/img/usis/download.png" width=100 height=30 border="0" alt="Download"></a></td>
</tr>
</tbody>
</table>
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
				<!-- <li><a class="text-gray" href="#"><i class="fa fa-question-circle text-success"></i> FAQs</a></li> -->
				<li><a class="text-gray" href="maleCU"><i class="fa fa-envelope text-success"></i> Contact Us</a></li>
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