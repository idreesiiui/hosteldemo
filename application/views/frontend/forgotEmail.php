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
                <div class="instruction bg-white text-danger border shadow rounded p-1">
					<h4 class="font-weight-dark text-center">Instructions</h4>
					<ul class="text-left">
                    	<li>Enter your Reg . No. (As per University Card)</li>
                        <li>If you have a dummy emial address then please update it.</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6 p-0 bg-white h-md-100 loginarea">
		<div class="d-md-flex align-items-center h-md-100 p-4 justify-content-center" >
			<form action="<?php echo base_url();?>login/checkRegno" method="post" id="forgotemailForm" class="border rounded p-4"
             style="min-width: 50%;">
				<h4 class="mb-4 text-success text-center">Forgot Email</h4>
				<?php
				    $this->load->helper('form');
				    $error = $this->session->flashdata('error');
				    if($error)
				    {
		    	?>
			    	<div class="form-group alert alert-danger" style="background-color: #F2DEDE; border:#EBCCD1;color:#A94442" role="alert">
					    <i class="fas fa-exclamation-triangle"></i><button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span class="text-white" aria-hidden="true">&nbsp;×</span>
					    </button>
					    <?php echo $error;?>
					</div>
			    <?php }
				    $success = $this->session->flashdata('success');
				    if($success)
				    {
			    ?>
			        <div class="form-group alert alert-danger" role="alert">
			            <i class="fas fa-check-circle"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&nbsp;×</button>
			            <?php echo $success;?>                    
			        </div>
		    	<?php } ?>
				<div class="form-group">
					<input type="text" class="form-control" name="regno" id="regno"  placeholder="Reg. No. as per University Card" required="">
				</div>
				<button type="submit" class="btn btn-success btn-round btn-block shadow-sm">Submit</button>
				<small class="d-block mt-4 text-center"><a class="text-cyan" href="<?php echo base_url();?>login">Sign in ?</a></small>
				<small class="d-block mt-2 text-center"><a class="text-cyan" href="<?php echo base_url();?>">Back to Home Screen</a></small>
			 </form>
		</div>
	</div>
</div>
<!-- End Main -->
