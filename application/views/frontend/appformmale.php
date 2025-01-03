<div class="container register">
    <div class="row">
         <div class="col-md-4 register-left">
         		
                <img class="rounded-circle" width=100 height=100 src="<?php echo base_url();?>/assets/frontend/img/usis/iiui-logo.png">
                <h3>Welcome</h3>
                <h6>Online Application for Hostel Registration</h6>
                <small class="btn btnRegister d-block mt-2 text-center"><a class="text-white" href="<?php echo base_url();?>malePage">Back to Home Screen</a></small>
			    <div class="bg-light text-danger border shadow rounded p-1 mt-5 mb-5 instruction">
                    <h4 class="font-weight-dark text-center">Instructions</h4>
                    <ul class="text-left">
                        <li>Please review your information before submission.</li>
                        <li>Don't use someone else Email, CNIC / Passport or Contact No.</li>
                        <li>Enter City, District & Province correctly.</li>
                        <li>Enter Present Address & Permanent Address as on CNIC.</li>
                        <li>Any misleading information would lead to cancelation of registeration. </li>
                        <li>Any information if found incorrect, Update from Admission Office. </li>
                    </ul>
                </div>
          </div>
        <div class="col-md-8 register-right">
     
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row register-heading">
                            <h5 class="ml-3 mr-5 mt-5" style="text-decoration:underline;">Hostel Registeration for Semseter <strong> <?php echo strtoupper($semestercode[0]->SEMCODE)?> </strong></h5>
                           <?php 
                            if(!empty($StudentInfo) && isset($StudentInfo)){ 
                            $blobimg = $StudentInfo[0]->picture;

                            // Decode the Base64 string, getting the binary data of the image
                            $imageData = base64_decode($blobimg);

                           $image_name = str_replace("/", "", $StudentInfo[0]->REGNO);

                            // Specify the path where you want to save the image
                            $filePath = 'assets/student_pics/'.$image_name.'.png';

                            // Write the binary data to the file
                            if(!empty($StudentInfo[0]->picture)){
                            $resutl = file_put_contents($filePath, $imageData);
                            }
                            ?>
                            <img class="std_img" alt="student picture" src ="assets/student_pics/<?= $image_name ?>.png"/>
                         
                            <?php } else {?>
                                <img src="<?php echo base_url();?>/assets/frontend/img/usis/avatar_female.png" alt="Avatar" class="mt-1 ml-5 avatar">
                            <?php }?>
                        </div>
                        <div class="col-md-11" style="float:right; top: 40px;">
								<?php
                                    $this->load->helper('form');
                                    $error = $this->session->flashdata('error');
                                    if($error || $err_message)
                                    {
                                ?>
                                <div class="alert alert-danger alert-dismissable instruction">
                                    <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>-->
                                    <?php echo $this->session->flashdata('error'); ?> 
                                    <?php echo $err_message; ?>                   
                                </div>
                                <?php } ?>
                                <?php  
                                    $success = $this->session->flashdata('success');
                                    if($success)
                                    {
                                ?>
                                <div class="alert alert-success alert-dismissable" style="width: 450px; margin-left:300px">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <?php echo $this->session->flashdata('success'); ?>
                                </div>
                                <?php } ?>        
                         </div> 
                  <form role="form" class="row register-form " id="signup" action="<?php echo base_url()?>appformmalesignup" method="post">           
                  	<h5>Student Information</h5>
                    <div class="row border mb-3">
                            <div class="col-md-6 form-group">
                                <label for="exampleFormControlSelect2">Reg. No.</label>
                                <input type="text" class="form-control required" id="regno" placeholder="123-FBAS/BSSE/S10" name="regno" maxlength="128" value="<?php echo $StudentInfo[0]->REGNO ?>" readonly>
                                <input type="hidden" class="form-control required" id="protittle" name="protittle" maxlength="128" value="<?php echo $StudentInfo[0]->PROTITTLE ?>" readonly>
                                <input type="hidden" class="form-control required" id="semcode" name="semcode" value=" <?php echo $semestercode[0]->SEMCODE;?> " >
                                 <input type="hidden" class="form-control required" id="hostelregdate" name="hostelregdate" value=" <?php echo $semestercode[0]->SEMCODE;?> " >
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="exampleFormControlSelect2">Full Name</label>
                                <input type="text" class="form-control required" id="name" name="name" maxlength="128" readonly value="<?php echo $StudentInfo[0]->STUDENTNAME ?>">
                                <input type="hidden" class="form-control required" id="dept" name="dept" maxlength="128" readonly value="<?php echo $StudentInfo[0]->DEPARTMENTNAME ?>">   
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="exampleFormControlSelect2">Father Name</label>
                                <input type="text" class="form-control required" id="fname" name="fname" readonly value="<?php echo $StudentInfo[0]->FATHERNAME ?>">
                                <input type="hidden" class="form-control required" id="faculty" name="faculty" maxlength="128" readonly value="<?php echo $StudentInfo[0]->FACULTY ?? ''; ?>">
                                <input type="hidden" class="form-control required" id="programe" name="programe" maxlength="128" readonly value="<?php echo $StudentInfo[0]->PROGRAME ?>">
                                <input type="hidden" class="form-control required" id="batchname" name="batchname" maxlength="128" readonly value="<?php echo $StudentInfo[0]->BATCHNAME ?>">
                			</div>
                            <!--<div class="col-md-6 form-group">-->
                                <!--<label for="exampleFormControlSelect2">CGPA</label>-->
                                <input type="hidden" class="form-control required" id="cgpa" name="cgpa" maxlength="12" value="<?php echo number_format($StudentInfo[0]->CGPA, 1, '.', '') ?>" readonly>
                            <!--</div>-->
                             <!--<div class="col-md-6 form-group">
                                <label for="dept">Department</label>-->
                                <input type="hidden" class="form-control required" id="dept" name="dept" maxlength="128" readonly value="<?php echo $StudentInfo[0]->DEPARTMENTNAME ?>">
                            <!--</div>-->
                            
                            <div class="col-md-6 form-group">
                                <label for="exampleFormControlSelect2">Country</label>
                                <?php 
									if(empty($StudentInfo[0]->COUNTRY))
									{
									?>
                                <input type="text" class="form-control required" name="country"  required autofocus value="">
                            	<?php 
								 	}
								  	else{
								?>
                                  <input type="text" class="form-control required" name="country" readonly required autofocus value="<?php echo $StudentInfo[0]->COUNTRY ?>">
                            	<?php }  ?>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="exampleFormControlSelect2">Nationality</label>
                                <input type="hidden" class="form-control required" id="ptittle" name="ptittle" readonly value="<?php echo $StudentInfo[0]->PROTITTLE ?>">
                                 <?php 
									if(empty($StudentInfo[0]->NATIONALITY))
									{
									?>
                                 <select class="form-control" name="nationality"  required autofocus>
                                    <option class="hidden"  selected disabled>Select Nationality</option>
                                    <option value="Pakistani">Pakistani</option>
                                    <option value="Overseas Pakistani">Overseas Pakistani</option>
                                    <option value="Foreigner">Foreigner</option>
                                </select>
                                 <?php 
								 	}
								  	else{
								?>
                                  <input type="text" class="form-control required" id="nationality" name="nationality" readonly value="<?php echo $StudentInfo[0]->NATIONALITY ?>">
                                  <?php }  ?>
                            </div>
                           
                            <!--<div class="col-md-6 form-group">
                                <label for="programe">Programme</label>-->
                                <input type="hidden" class="form-control required" id="programe" name="programe" maxlength="125" readonly value="<?php echo $StudentInfo[0]->PROGRAME ?>">
                                <input type="hidden" class="form-control required" id="protittle" name="protittle" maxlength="125" readonly value="<?php echo $StudentInfo[0]->PROTITTLE ?>">  
                            <!--</div>-->
                            <!--<div class="col-md-6 form-group">
                                <label for="role">Faculty</label>-->
                                <input type="hidden" class="form-control required" id="faculty" name="faculty" maxlength="128" readonly value="<?php echo $StudentInfo[0]->FACULTY ?>"> 
                           <!-- </div>-->
                           
                            <?php 
									if(empty($StudentInfo[0]->STUDENTDOB))
									{
									?>
                              <div class="col-md-6 form-group">
                                <label for="exampleFormControlSelect2">DOB</label>
                                
                                 <input type="date" class="form-control required" id="dob" name="dob" maxlength="128" value="">
								</div>
								<?php 
								 	}
								  	else{
								?>
                                   <input type="hidden" class="form-control required" readonly id="dob" name="dob" maxlength="128" value="<?php echo $StudentInfo[0]->STUDENTDOB ?>">
								 
								<?php }  ?>
                           
                            
                                <?php 
									if(empty($StudentInfo[0]->CNIC))
									{
									?>
                               <div class="col-md-6 form-group">
                                    <label for="exampleFormControlSelect2">CNIC/ Passport <small style="font-size:10px; color:red;" > CNIC without dashes</small></label>
                                 <input type="text" class="form-control required" id="cnic" name="cnic" maxlength="15" value="">
                               </div>
								<?php 
								 	}
								  	else{
								?>
                                <input type="hidden" class="form-control required" readonly id="cnic" name="cnic" maxlength="15" value="<?php echo $StudentInfo[0]->CNIC ?>">
                            <?php }  ?>
                            <div class="col-md-6 form-group">
                                <label for="fcellNo">Father Cell No.</label>
                                <input type="number" class="form-control required" id="fnumber" name="fnumber" maxlength="11" required>
                            </div>
                           
                                 <?php 
									if(empty($StudentInfo[0]->PERMANENT))
									{
									?>
                               <div class="col-md-6 form-group">
                                <label for="snumber">Permanent Address</label>
                                 <textarea type="text" class="form-control required" id="paddress"  name="paddress" rows="1"></textarea>
                                 </div>
                           		<?php 
								 	}
								  	else{
								?>
                                 <input type="hidden" class="form-control required" readonly id="paddress"  name="paddress" value="<?php echo $StudentInfo[0]->PERMANENT?>">
                           		<?php }  ?>
                            
                            
                                <?php 
									if(empty($StudentInfo[0]->PREADD))
									{
									?>
                               <div class="col-md-6 form-group">
                                <label for="exampleFormControlSelect2">Present Address</label>
                                 <textarea type="text" class="form-control required" id="caddress"  name="caddress" rows="1"></textarea>
                                 </div>
                           		<?php 
								 	}
								  	else{
								?>
                                 <input type="hidden" class="form-control required" readonly id="caddress"  name="caddress" value="<?php echo $StudentInfo[0]->PREADD?>">
                           		<?php }  ?>
                            
                            <div class="col-md-6 form-group">
                                <label for="exampleFormControlSelect2">Contact No.</label>
                                <input type="number" class="form-control required" id="snumber" required name="snumber" maxlength="11" value="<?php //echo $StudentInfo[0]->STUDENTNUMBER ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="exampleFormControlSelect2">District</label><small style="color:red; font-size:10px"> Enter your Home Country district name.</small>
                                <input type="text" class="form-control required" id="district"  name="district" maxlength="128" value=" <?php echo $StudentInfo[0]->DISTRICT?>">
                                <input type="hidden" class="form-control required" id="stadmission"  name="stadmission" maxlength="128" value=" <?php echo $StudentInfo[0]->STADMISSION?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="exampleFormControlSelect2">City</label><small style="color:red; font-size:10px"> Enter your Home Country city name.</small>
                                <input type="text" class="form-control required" id="city"  name="city" maxlength="128" value=" <?php if($StudentInfo[0]->CITY != 'Same') echo $StudentInfo[0]->CITY  ?>" required>
                                <input type="hidden" class="form-control required" id="status"  name="status" maxlength="128" value="0">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="exampleFormControlSelect2">Province</label>
                                <select class="form-control required" id="province" name="province">
                                 <?php 
									if($StudentInfo[0]->NATIONALITY == 'Pakistani')
									{
									?>
                                    <option class="hidden"  selected disabled>Select Province</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                                    <option value="Sindh">Sindh</option>
                                    <option value="Balochistan">Balochistan</option>
                                    <option value="Islamabad">Islamabad</option>
                                    <option value="Federally Administered Tribal Areas">Federally Administered Tribal Areas</option>
                                    <option value="Gilgit-Baltistan">Gilgit-Baltistan</option>
                                    <option value="Azad Jammu & Kashmir" >Azad Jammu & Kashmir</option>
                                    <?php
									} 
									?>
                                    <?php 
									if($StudentInfo[0]->NATIONALITY != 'Pakistani')
									{
									?>
                                    
                                    <option value="Foreginer" >Foreginer</option>
                                    <option value="Overseas Pakistani">Overseas Pakistani</option>
									<?php
									} 
									?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="exampleFormControlSelect2">Student Email<small style="font-size:10px; color:red;" > For Hostel student web portal</small></label>
                                <input type="email" class="form-control required email" id="email"  name="email" maxlength="128">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="exampleFormControlSelect2">Confirm Email<small style="font-size:10px; color:red;" > For Hostel student web portal</small></label>
                                <input type="email" class="form-control required email" id="cemail" name="cemail" required autofocus maxlength="128">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="password">Password<small style="font-size:10px; color:red;" > For Hostel student web portal</small></label>
                                <input type="password" class="form-control required" name="password" id="password" required autofocus />
                            </div>
                            <hr class="style1">
							<br>
                            <div class="col-md-6 form-group">
                                <label for="exampleFormControlSelect2">Confirm Password</label>
                                <input type="password" class="form-control required" name="cpassword" id="cpassword"  required autofocus />
                            </div>
					</div>
                    <h5>Emergency Contact Information</h5>
                    <div class="row border mt-2 ">
                            <div class="col-md-6 form-group">
                                <label for="emargancyname">Name</label>
                                <input type="text" class="form-control required" id="emargancyname"  name="emargancyname">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="emargancynumber">Cell No</label>
                                <input type="number" class="form-control required" id="emargancynumber"  name="emargancynumber" maxlength="13">
                            </div>
							<div class="col-md-6 form-group">
                                <label for="emargancynumber">CNIC</label>
                                <input type="number" class="form-control required" id="emargancycnic"  name="emargancycnic" maxlength="13">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="exampleFormControlSelect2">Relation</label>
                                <select class="form-control required" id="emergancyrelation" name="emergancyrelation">
                                    <option class="hidden"  selected disabled>Select Relation</option>
                                    <option value="Mother">Mother</option>
                                    <option value="Brother">Brother</option>
                                    <option value="Sister">Sister</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                      <?php if($studTotalCredit > $TotalCredit || empty($err_message)) 
					  		{   
					  ?>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btnRegister text-white" value="submit">Submit</button> 
                                    <button type="reset" class="ml-1 btn btn-white border" value="reset">Reset</button>	
                              <input type="hidden" class="form-control required"  name="studTotalCredit" maxlength="2" value="<?php echo $TotalCredit?>">
                                   <input type="hidden" class="form-control required"  name="TotalCredit" maxlength="2" value="<?php echo $TotalCredit?>">
                                </div>
                            </div>
                        <?php 
						  }
						 ?>                
                 	 </form>
					</div>
                   </div>
                </div>
            </div>
    
          </div>
       </div>
	<script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/signup.js" type="text/javascript"></script>