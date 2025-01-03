<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Fee Challan Search
        <small>View</small>
      </h1>
    </section>
    <section class="content">
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
                    <div class="col-md-8">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Fee Challan List</h3>
                    
                    
                    <form class="form-horizontal" id="seatsearchList" name="validateform" method="post" action="<?php echo base_url() ?>feechallan/feechallan/viewFeeDetailbyId" >
          <div class="box-body">
             <div class="row">
                <div class="form-group">
                  <label style="width:80px" for="text" class="col-sm-2 control-label">Reg No.</label>

                  <div class="col-sm-2">
                     <input type="text" class="form-control required" id="regno"  name="regno" maxlength="120" value="<?php echo $viewStudInfo[0]->REGNO ?>" readonly>
                  </div>
                 <label style="width:80px" for="text" class="col-sm-2 control-label">Semester</label>

                  <div class="col-sm-2">
                     <?php if(!empty($viewSemInfo)) {?>
                     <select name="semester" id="semester" class="form-control">
                     <?php foreach($viewSemInfo as $seminfo) {?>
                     <option value="<?php $sem = substr(strtoupper($seminfo->SEMCODE),0,3);if($sem == 'SPR')
					 {
						 echo 'SPR-'.substr($seminfo->SEMCODE,-4);
					 }
					 elseif($sem == 'FAL')
					 {
						 echo strtoupper($seminfo->SEMCODE);
					 }
					 elseif($sem == 'SUM')
					 {
						 echo 'SUM-'.substr($seminfo->SEMCODE,-4);
					 }?>"><?php $sem = substr(strtoupper($seminfo->SEMCODE),0,3);
					 if($sem == 'SPR')
					 {
						 echo 'SPR-'.substr($seminfo->SEMCODE,-4);
					 }
					 elseif($sem == 'FAL')
					 {
						 echo strtoupper($seminfo->SEMCODE);
					 }
					 elseif($sem == 'SUM')
					 {
						 echo 'SUM-'.substr($seminfo->SEMCODE,-4);
					 }
					 ?></option>
                     <?php } ?>
                     </select>
                     <?php }?>
                  </div>
                <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Genrate Fee"/>
                <input type="reset" class="btn btn-secondary" value="Reset"/>
                </div>
             </div>
             </form>
              </div><!-- /.box -->
              </div>
              <div class="box box-primary">
              <div class="box-header">
                    <!--<h3 class="box-title">Fee Challan Hostel and Roomwise</h3>-->
              </div>
              			 <form class="form-horizontal" id="seatsearchList" name="validateform" method="post" action="<?php echo base_url() ?>feechallan/feechallan/viewFeeDetailbyHostelWise" style="display:none" >
              <div class="box-body">
                <div class="form-group">
                  <label style="width:100px" for="text" class="col-sm-2 control-label">Hostel No.</label>
					<div class="col-sm-2">
                    <?php if(!empty($viewHostelInfo)) {?>
                     <select name="hostelno" id="hostelno" class="form-control required">
                     <option value="">Select Hostel</option>
                     <?php foreach($viewHostelInfo as $hostelinfo) {?>
                     <option value="<?php echo $hostelinfo->HOSTELID?>"><?php echo $hostelinfo->HOSTEL_NO?></option>
                     <?php } ?>
                     </select>
                     <?php }?>
                  </div>
                   <div class="form-group">
                  
                  <label style="width:100px" for="text" class="col-sm-2 control-label">Room No.</label>
					<div class="col-sm-2">
                   
                     <select name="roomno" id="roomno" class="form-control required">
                     <option value="">Select Hostel First</option>
                     </select>
                  
                  </div>
                   <label style="width:80px" for="text" class="col-sm-2 control-label">Semester</label>

                  <div class="col-sm-2">
                     <?php if(!empty($viewSemInfo)) {?>
                     <select name="semester" id="semester" class="form-control required">
                     <option value="">Select Batch</option>
                     <?php foreach($viewSemInfo as $seminfo) {?>
                     <option value="<?php  if($sem == 'SPR')
					 {
						 echo 'SPR-'.substr($seminfo->SEMCODE,-4);
					 }
					 elseif($sem == 'FAL')
					 {
						 echo strtoupper($seminfo->SEMCODE);
					 }
					 elseif($sem == 'SUM')
					 {
						 echo 'SUM-'.substr($seminfo->SEMCODE,-4);
					 }?>"><?php $sem = substr(strtoupper($seminfo->SEMCODE),0,3);
					 if($sem == 'SPR')
					 {
						 echo 'SPR-'.substr($seminfo->SEMCODE,-4);
					 }
					 elseif($sem == 'FAL')
					 {
						 echo strtoupper($seminfo->SEMCODE);
					 }
					 elseif($sem == 'SUM')
					 {
						 echo 'SUM-'.substr($seminfo->SEMCODE,-4);
					 }
					 ?></option>
                     <?php } ?>
                     </select>
                     <?php }?>
                  </div>
                  
                <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit"/>
                <input type="reset" class="btn btn-secondary" value="Reset"/>
                </div>
             </form>
              </div>
            </div>
        </div>
    </section>
</div>

<script src="<?php echo base_url(); ?>assets/js/seat-setting.js" type="text/javascript"></script>

