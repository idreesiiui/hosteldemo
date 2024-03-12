<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>IIUI Hostel Managment System | User Email info</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>IIUI Hostel </b><br>Managment System</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg"><b>Update Email Info</b></p>
        <?php $this->load->helper('form'); ?>
        <div class="row">
            <div class="col-md-12">
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            </div>
        </div>
        <?php
        $this->load->helper('form');
        $error = $this->session->flashdata('error');
        if($error)
        {
            ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo 'Enter different Email. If you want to change'; ?>                    
            </div>
        <?php } ?>
        
        <form action="<?php echo base_url(); ?>login/resetEmailUser" method="post">
         <div class="form-group has-feedback">
            <input type="text" class="form-control" name="regno" value="<?php if(!empty($regnoinfo)) echo $regnoinfo; else echo $emailinfo[0]->REGNO?>" required readonly />
            <input type="hidden" class="form-control" name="userid" value="<?php echo $emailinfo[0]->userId?>" required readonly />
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo strtolower($emailinfo[0]->email)?>" required />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          
          <div class="row">
            <div class="col-xs-8">    
              <!-- <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>  -->                       
            </div><!-- /.col -->
            <div class="col-xs-4">
              <input type="submit" class="btn btn-primary btn-block btn-flat" value="Reset" />
            </div><!-- /.col -->
          </div>
        </form>
		<?php 
		
        if(isset($semesterRecords) && $semesterRecords == 1)
			{?>
<br><a href="#">Forgot Password</a> <a style="float:right;" href="<?php echo base_url() ?>regbox">Sigup New Student</a><br>
			<?php
			} 
			else
			{?><br><a href="<?php echo base_url() ?>login">Have Email and password Login</a> <br><?php } ?>    
					
					
				  </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  </body>
</html>