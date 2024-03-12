
<!--------------------------------------
NAVBAR
--------------------------------------->

<!-- End Navbar -->
    
<!-- Main -->
<div class="d-md-flex h-md-100 align-items-center">
	<div class="col-md-6 p-0 bg-success h-md-100">
		<div class="text-white d-md-flex align-items-center h-100 p-5 text-center justify-content-center">
			<div class="logoarea pt-5 pb-3">
				<p>
					<img class="rounded-circle" width=100 height=100 src="<?php echo base_url();?>/assets/frontend/img/usis/iiui-logo.png"></img>
				</p>
				<h3 class="mb-4 font-weight-normal">Hostel Automation system</h3>
				<div class="instruction bg-white text-danger border shadow rounded p-1">
					<h4 class="font-weight-dark text-center">Instructions</h4>
					<ul class="text-left">
                    	<li>Enter CNIC without dashes</li>
                        <!--<li class="list-unstyled font-weight-bold text-center">OR</li>-->
                        <li>Enter Email as per Hostel Card</li>
                        <li>Enter Registrarion number as per Student Card<br>
						(Reg No# Case Sensitive) e.g 123-FBAS/MSSE/F09</li>
                        <li>Newly Alloted Student check Email for username / password </li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6 p-0 bg-white h-md-100 loginarea">
		<div class="d-md-flex align-items-center h-md-100 p-4 justify-content-center">
			<form action="<?php echo base_url();?>/loginMe" method="post" id="signupForm" class="border is-valid rounded p-4">
				<h3 class="mb-4 text-success text-center">Sign In</h3>
				<div class="form-group">
                	<input type="email" class="form-control" id="email"  name="email" placeholder="Email / Reg. No  / CNIC" required="">
				</div>
				<div class="form-group">
                	<input type="password" class="form-control" id="password" name="password" placeholder="Password" maxlength="12" required="">
				</div>
                <input type="submit" class="btn btn-success btn-round btn-block shadow-sm" value="Sign in" />
                <small class="d-block mt-4 text-center"><a class="text-cyan" href="<?php echo base_url();?>login/forgotPassword">Forgot your password?</a></small>
			</form>
		</div>
	</div>
</div>
<!-- End Main -->