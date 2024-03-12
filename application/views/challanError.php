<div class="content-wrapper">    
    <section class="content-header">
      <h1>
        404
        <small>This Fee challan is not found with us</small>
      </h1>
    </section>
    <div class="col-md-12">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('warning');
                    if($error || $challaninfo)
                    {
                ?>
                <div class="alert alert-warning alert-dismissible" style="font-size:large">
                <i class="icon fa fa-warning"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('warning'); ?>
                    <?php if($challaninfo && $challaninfo == 'Wait%20for%20hostel%20fee%20challan.%20Soon%20it%20will%20be%20generated.'){

                       // var_dump($challaninfo);
							
							echo 'Wait for hostel fee challan. Soon it will be generated..';
					      }
						  else{
							 
							echo 'Hostel Seat ReNewal Process not started. Wait for some time and come back again..'; 
						  }
					?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('error');
                    if($success)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <i class="icon fa fa-warning"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-center">
            <?php 
			   if(empty($challaninfo))
				 {
			?>
                <img src="<?php echo base_url() ?>assets/images/error.jpg" alt="Page Not Found Image" />
                 <?php 
				 }
			?>
            </div>
        </div>
    </section>
</div>