<!--------------------------------------
NAVBAR
--------------------------------------->

<!-- End Navbar -->
    
<!-- Main -->
<div class="d-md-flex h-md-100 align-items-center">
	<div class="col-md-6 p-0 bg-success h-md-100">
		<div class="text-white d-md-flex align-items-center h-100 p-5 text-center justify-content-center">
			<div class="logoarea pt-5 pb-5">
				<p>
					<img class="rounded-circle" width=100 height=100 src="<?php echo base_url();?>/assets/frontend/img/usis/iiui-logo.png"></img>
				</p>
				<h3 class="mb-4 font-weight-dark">Hostel Automation system</h3>
			</div>
		</div>
	</div>
	<div class="col-md-6 p-0 bg-white h-md-100 loginarea">
		<div class="d-md-flex align-items-center h-md-100 p-3 justify-content-center">
			<form class="border rounded p-3">
				<h4 class="mb-4 text-success text-center">Forgot Password</h4>
				<div class="form-group">
					<input type="email" class="form-control" name="email" id="email"  placeholder="Email" required="">
				</div>
				<button type="submit" class="btn btn-success btn-round btn-block shadow-sm">Reset</button>
				<small class="d-block mt-4 text-center"><a class="text-cyan" href="<?php echo base_url();?>login">Sign in ?</a></small>
			</form>
		</div>
	</div>
</div>
<!-- End Main -->
