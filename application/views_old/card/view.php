<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Hostel Cards Search
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
                    <h3 class="box-title">Hostel Cards List</h3>
                    
                    
                    <form class="form-horizontal" id="seatsearchList" name="validateform" method="post" action="<?php echo base_url() ?>card/Cards/viewCardDetailbyId" >
              <div class="box-body">
                <div class="form-group">
                  <label style="width:80px" for="text" class="col-sm-2 control-label">Reg No.</label>

                  <div class="col-sm-2">
                     <input type="text" class="form-control required" id="regno"  name="regno" maxlength="120">
                  </div>
                <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit"/>
                <input type="reset" class="btn btn-secondary" value="Reset"/>
                </div>
             </form>
              </div><!-- /.box -->
              </div>
              <div class="box box-primary">
              <div class="box-header">
                    <h3 class="box-title">Print Card Hostel and Roomwise</h3>
              </div>
              			 <form class="form-horizontal" id="seatsearchList" name="validateform" method="post" action="<?php echo base_url() ?>card/Cards/printCardHostelWise" >
              <div class="box-body">
              <div class="row">
                <div class="form-group">
                   <label style="width:100px" for="text" class="col-sm-2 control-label">Key</label>
                  <input type="hidden" class="form-control required" id="semcode"  name="semcode" maxlength="120" value="<?php echo $seminfo[0]->SEMCODE?>" readonly>
					<div class="col-sm-2">
                    <?php if(!empty($viewHostelInfo)) {?>
                     <select name="key" id="key" class="form-control required">
                     <option value="">Select Key</option>
                     <?php foreach($keyinfo as $key) {?>
                     <option value="<?php echo $key->KEY?>"><?php echo $key->KEY?></option>
                     <?php } ?>
                     </select>
                     <?php }?>
                  </div>
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
                   <label style="width:100px" for="text" class="col-sm-5 control-label">Type</label>
					<div class="col-sm-3">
                    <?php if(!empty($type)) {?>
                     <select name="type" id="type" class="form-control">
                     <option value="">Select Allotment type</option>
                     <?php foreach($type as $typeinfo) {?>
                     <option value="<?php echo $typeinfo->TYPE?>"><?php echo $typeinfo->TYPE?></option>
                     <?php } ?>
                     </select>
                     <?php }?>
                  </div>
                  </div>
                  
                   <div class="form-group">
                  
                  <label style="width:100px" for="text" class="col-sm-2 control-label">Room No.</label>
					<div class="col-sm-2">
                   
                     <select name="roomno" id="roomno" class="form-control required">
                     <option value="">Select Hostel First</option>
                     </select>
                  
                  </div>
                  
                <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit" name="card"/>
                <input type="submit" class="btn btn-primary" style="background-color:#367fa9 !important" value="Card List Print" name="card"/>
                </div>
             </form>
              </div>
              
            </div>
        </div>
    </section>
</div>

<script src="<?php echo base_url(); ?>assets/js/seat-setting.js" type="text/javascript"></script>

