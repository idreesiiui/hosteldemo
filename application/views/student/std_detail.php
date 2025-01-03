<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Student Information
        <small>Add / Edit Student Information</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Student Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="seat" action="<?php echo base_url('update_std_info') ?>" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="hostel">Name:</label>
                                        <input class="form-control required" type="text" name="STUDENTNAME" value="<?= $student_detail[0]['STUDENTNAME'] ?? ''; ?>">                                        
                                    </div>
                                  </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label for="roomtype">Registration No:</label>
                                    <input class="form-control required" type="text" name="REGNO" value="<?= $student_detail[0]['REGNO'] ?? ''; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        
                                        <label for="hostel">Father Name:</label>
                                        <input class="form-control required" type="text" name="FATHERNAME" value="<?= $student_detail[0]['FATHERNAME'] ?? ''; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="occupy">Gender: <? $gender = $student_detail[0]['GENDER']; ?></label>
                                        <select class="form-control required" id="GENDER" name="GENDER" >
                                            <option <?php echo($gender == '')?'selected':''; ?> value="">Please select gender</option>
                                            <option <?php echo($gender == 'Male')?'selected':''; ?>  value="Male">Male</option>
                                            <option <?php echo($gender == 'Female')?'selected':''; ?> value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="occupy">Mobile Number:</label>
                                        <input class="form-control required" type="text" name="phone" value="<?= $student_detail[0]['phone'] ?? ''; ?>">
                                        
                                    </div>
                                  </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label for="roomtype">Students Date of Birth:</label>
                                    <input class="form-control required" type="text" name="STUDENTDOB" value="<?= $student_detail[0]['STUDENTDOB'] ?? ''; ?>">                                        
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="seatdesc">CNIC:</label>
                                        <input class="form-control required" type="text" name="CNIC" value="<?= $student_detail[0]['CNIC'] ?? ''; ?>" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="hostel">University Email:</label>
                                        <input class="form-control required" type="text" name="univ_email" value="<?= $student_detail[0]['univ_email'] ?? ''; ?>">                                       
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="hostel">Resident Address:</label>
                                        <input class="form-control required" type="text" name="PREADD" value="<?= $student_detail[0]['PREADD'] ?? ''; ?>">
                                    </div>
                                  </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label for="roomtype">Permanent Address:</label>
                                    <input class="form-control required" type="text" name="PERMANENT" value="<?= $student_detail[0]['PERMANENT'] ?? ''; ?>">            
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="seatdesc">District:</label>
                                        <input class="form-control required" type="text" name="DISTRICT" value="<?= $student_detail[0]['DISTRICT'] ?? ''; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">                                       

                                        <label for="seatdesc">City:</label>
                                        <input class="form-control" type="text" name="CITY" value="<?= $student_detail[0]['CITY'] ?? ''; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="hostel">Province/State:</label>
                                        <input class="form-control" type="text" name="province" value="<?= $student_detail[0]['province'] ?? ''; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="occupy">Country:</label>
                                        <input class="form-control required" type="text" name="COUNTRY" value="<?= $student_detail[0]['COUNTRY'] ?? ''; ?>">
                                        
                                    </div>
                                  </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label for="roomtype">Nationality:</label>
                                    <input class="form-control required" type="text" name="NATIONALITY" value="<?= $student_detail[0]['NATIONALITY'] ?? ''; ?>">          
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="seatdesc">Current Semester:</label>
                                        <input class="form-control required" type="text" name="current_semester" value="<?= $student_detail[0]['current_semester'] ?? ''; ?>" placeholder="Spring 2024 - IIU">
                                    </div>
                                </div>

                            </div>
                            
                            <div class="row">
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="occupy">Programm:</label>
                                        <input class="form-control required" type="text" name="PROGRAME" value="<?= $student_detail[0]['PROGRAME'] ?? ''; ?>" placeholder="... 2024 (Spring-Morning) - IIU">
                                    </div>
                                  </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">               
                                        <label for="occupy">Profile Title: <?php $PROTITTLE = $student_detail[0]['PROTITTLE']; 
                                            //var_dump($PROTITTLE);
                                        ?></label>
                                        <select class="form-control required" id="PROTITTLE" name="PROTITTLE" >
                                            <option <?php echo($PROTITTLE == '')?'selected':''; ?> value="">Please select Profile Title</option>
                                            <option <?php echo ($PROTITTLE == 'BS')?'selected':''; ?>  value="BS">BS</option>
                                            <option <?php echo($PROTITTLE == 'BSC')?'selected':''; ?> value="BSC">BSC</option>
                                            <option <?php echo($PROTITTLE == 'MS')?'selected':''; ?> value="MS">MS</option>
                                            <option <?php echo($PROTITTLE == 'PHD')?'selected':''; ?> value="PHD">PHD</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label for="roomtype">email:</label>
                                    <input class="form-control required" type="text" name="email" value="<?= $student_detail[0]['email'] ?? ''; ?>">                                        
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="occupy">Admission Date:</label>
                                        <input class="form-control" type="text" name="STADMISSION" value="<?= $student_detail[0]['STADMISSION'] ?? ''; ?>">
                                    </div>
                                </div>
                            </div>
                            <?php if($student_detail[0]['picture'] == null || empty($student_detail[0]['picture'])){ ?>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="occupy">Upload Student Picture:</label>
                                        <input class="form-control required" type="file" name="picture" accept="image/png, image/jpeg, image/jpg">
                                        
                                    </div>
                                </div>                                
                            </div>
                            <?php } else { 

                                $blobimg = $student_detail[0]['picture'];

                            // Decode the Base64 string, getting the binary data of the image
                            $imageData = base64_decode($blobimg);

                           $image_name = str_replace("/", "", $student_detail[0]['REGNO']);

                           

                            // Specify the path where you want to save the image
                            $filePath = 'assets/student_pics/'.$image_name.'.png';

                            // Write the binary data to the file
                            if(!empty($student_detail[0]['picture'])){
                            $resutl = file_put_contents($filePath, $imageData);
                            }
                            ?> 
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="occupy">Student Picture: </label>
                                        <input class="form-control required" type="hidden" name="picture" value="<?= $student_detail[0]['picture'] ?? ''; ?>">
                                        <img class="std_img" alt="student picture" src ="assets/student_pics/<?= $image_name ?>.png"/>
                                    </div>
                                </div>                                
                            </div>

                            <?php } ?>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
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
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>    
    </section>
    
</div>
<script src="<?php echo base_url(); ?>assets/js/seat.js" type="text/javascript"></script>