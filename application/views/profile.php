<?php
/*$userId = $userInfo[0]->USERID;
$name = $userInfo[0]->NAME;
$email = $userInfo[0]->EMAIL;
$mobile = $userInfo[0]->MOBILE;
$gender = $userInfo[0]->GENDER;
$roleId = $userInfo[0]->ROLEID;
$role = $userInfo[0]->ROLE;*/

$userId = $userInfo[0]->USERID;
$name = $this->session->userdata('name');
$email = $userInfo[0]->EMAIL;
$cnic = $userInfo[0]->CNIC;
$mobile = $userInfo[0]->MOBILE;
$gender = $this->session->userdata('gender');
$roleId = $this->session->userdata('role');
$role = $this->session->userdata('roleText');
$studregno = $this->session->userdata('studregno');
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user-circle"></i> My Profile
        <small>View or modify information</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-4">
              <!-- general form elements -->
			  <?php 
			  $this->load->model('login_model');
			  $CI =& get_instance();
			  $studpics = $CI->login_model->StudPic($studregno);
			  if(!empty($studpics)){
			  $studpic = $studpics[0]->STUDPIC;
			  }
			  ?>

                <div class="box box-success">
                    <div class="box-body box-profile">
                    <?php
					if(empty($studpic)) 
			  		{ ?>
                        <img class="img-responsive img-circle center"  width=150 height=150 src="<?php echo base_url(); ?>assets/dist/img/avatar_<?php echo $gender; ?>.png" alt="User profile picture" style="display: block;
  margin-left: auto;margin-right: auto; border:2px solid green">
					  <?php 
                      } 
                      else{
						  echo '<img src ="data:image/jpeg;base64,'.base64_encode($studpic).'" class="img-responsive img-circle center"  width=150 height=150 alt="User Image" style="display: block;
  margin-left: auto;margin-right: auto; border:2px solid green"/>';
                      }
                      ?>
                        <?php 
						if ($roleId== 4){	
						?>
                        <h3 class="profile-username text-center"><?= $name ?></h3>
                        <h5 class="profile-username text-center"><?= $role ?></h5>
                        <h5 class="profile-username text-center"><?= $studregno ?></h5>
						<?php
						}
						else{	
						?>
                         <h2 class="profile-username text-center"><?= $name ?></h2>
						 <h5 class="profile-username text-center"><?= $role ?></h5>
                         <br>
                         <?php
						 }
						?>
                         <div class="box-footer">
                             <b>CNIC :</b>
                             <a class="pull-right"><?= $cnic ?></a>
                         </div>
                         <div class="box-footer">	
                             <b>Email :</b>
                             <a class="pull-right"><?= $email ?></a>
                         </div>
                         <div class="box-footer">
                             <b>Mobile :</b>
                             <a class="pull-right"><?= $mobile ?></a>
                         </div>
                        
                    </div>
                </div>

            </div>

            <div class="col-md-4">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="<?= ($active == "details")? "active" : "" ?>"><a href="#details" data-toggle="tab">Details</a></li>
                        <li class="<?= ($active == "changepass")? "active" : "" ?>"><a href="#changepass" data-toggle="tab">Change Password</a></li>                        
                    </ul>
                    <div class="tab-content">
                        <div class="<?= ($active == "details")? "active" : "" ?> tab-pane" id="details">
                            <form action="<?php echo base_url() ?>profileUpdate" method="post" id="editUser" role="form">
                                <?php $this->load->helper('form'); ?>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">                                
                                            <div class="form-group">
                                                <label for="cnic">CNIC / Passport</label>
                                                <input type="text" class="form-control required"  id="cnic" name="cnic" value="<?php echo set_value('cnic', $cnic); ?>" maxlength="128" />
                                                <input type="hidden" value="<?php echo $userId; ?>" name="userId" id="userId" />    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="mobile">Mobile Number</label>
                                                <input type="text" class="form-control required" id="mobile" name="mobile" placeholder="<?php echo $mobile; ?>" value="<?php echo set_value('mobile', $mobile); ?>" maxlength="11">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control required" id="email" name="email" placeholder="<?php echo $email; ?>" value="<?php echo set_value('email', $email); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <input type="submit" class="btn btn-primary" value="Submit" />
                                    <input type="reset" class="btn btn-default" value="Reset" />
                                </div><hr>
                            </form>
                        </div>
                        <div class="<?= ($active == "changepass")? "active" : "" ?> tab-pane" id="changepass">
                            <form role="form" action="<?php echo base_url() ?>changePassword" method="post" id="editUser">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="inputPassword1">Old Password</label>
                                                <input type="password" class="form-control" id="inputOldPassword" placeholder="Old password" name="oldPassword" maxlength="20" required>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="inputPassword1">New Password</label>
                                                <input type="password" class="form-control" id="inputPassword1" placeholder="New password" name="newPassword" maxlength="20" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="inputPassword2">Confirm New Password</label>
                                                <input type="password" class="form-control" id="inputPassword2" placeholder="Confirm new password" name="cNewPassword" maxlength="20" required>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->
            
                                <div class="box-footer">
                                    <input type="submit" class="btn btn-primary" value="Submit" />
                                    <input type="reset" class="btn btn-default" value="Reset" />
                                </div>
                            </form>
                        </div>                        
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>

                <?php  
                    $noMatch = $this->session->flashdata('nomatch');
                    if($noMatch)
                    {
                ?>
                <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('nomatch'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>    
    </section>
</div>

<script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>