<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Student Info Management<small>Update Student Contact Information</small>
        </h1> 
    </section>

    <?php //print_r($student); ?>
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">

                <!-- general form elements -->               
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title" style="text-decoration:underline">Students Details</h3> 
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" id="update_student" action="<?php echo base_url() ?>update_student" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="roomdesc">Student Name</label>
                                        <input value="<?php echo $student[0]['STUDENTNAME']; ?>" type="text" class="form-control required" id="studentname" name="studentname" maxlength="120" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="roomdesc">Reg No#</label>
                                        <input value="<?php echo $student[0]['REGNO']; ?>"  type="text" class="form-control required" id="regno" name="regno" maxlength="120" readonly> 
                                    </div>
                                </div>
                                
                                
                                
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="occupy">Gender</label>
                                        <input value="<?php echo $student[0]['GENDER']; ?>" type="text" class="form-control required" id="gender" name="gender" maxlength="120" readonly> 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="hostel">Room Number</label>
                                        <input value="<?php echo $student[0]['ROOMDESC']; ?>" type="text" class="form-control required" id="roomname" name="roomname" maxlength="50" readonly> </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="hostel">Hostel No</label>
                                        <input value="<?php echo $student[0]['HOSTEL_NO']; ?>" type="text" class="form-control required" id="hostelno" name="hostelno" maxlength="10" readonly value=""> </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="seatno">Seat</label>
                                        <input value="<?php echo $student[0]['SEAT']; ?>" type="text" class="form-control required" id="seatno" name="seatno" maxlength="10" readonly value=""> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="seatno">Email.</label>
                                        <input value="<?php echo $student[0]['email']; ?>" type="text" class="form-control required" id="email" name="email" maxlength="50"> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="seatno">Mobile No.</label>
                                        <input value="<?php echo $student[0]['STUDENTPHONE']; ?>" type="text" class="form-control required" id="mobileno" name="mobileno" maxlength="20"> 
                                    </div>
                                </div>
                            </div>
                            <!-- Seat detail div end (div row end) -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit"/>
                            <input type="button" class="btn btn-default" value="Back" onclick="location.href='<?php echo base_url() ?>students'" /> </div>
                    </form>
                </div>
            </div>
            
        </div>
    </section>
</div>
<script src="<?php echo base_url(); ?>assets/js/stuentContactInfo.js" type="text/javascript"></script>