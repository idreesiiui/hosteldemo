<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Semester Management
        <small>Add / Edit User</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter User Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo base_url() ?>semester/Semester/UpdateSemester" method="post" id="editUser" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="smecode">Semester Code</label>
                                        <input type="text" class="form-control required" id="smecode" name="smecode" maxlength="128" value="<?php echo $semester->SEMCODE ?>">
                                        <input type="hidden" class="form-control required" id="semesterId" name="semesterId" maxlength="128" value="<?php echo $semester->SMCODE ?>">
                                        <input type="hidden" class="form-control required" id="gender" name="gender" maxlength="128" value="<?php echo $gender[0]->GENDER?>">
                                    </div>
                                    
                                </div>
                                 <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="smecode">Semester Open for Semester</label>
                                        <input type="text" class="form-control required" id="smeopen" name="smeopen" maxlength="128" value="<?php echo $semester->SEMESTEROPENREG ?>">
                                        
                                  </div>
                               </div>
                            </div>
                         <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="smecode">Programe</label>
                                         <select class="form-control required" id="programe" name="programe">
                                           
                                            <option value="<?php echo $semester->PROGRAME ?>" <?php if($semester->PROGRAME == 'BS') {echo "selected=selected";} ?>>Bachelor</option>
											<option value="<?php echo $semester->PROGRAME ?>"<?php if($semester->PROGRAME == 'MS') {echo "selected=selected";} ?>>MS/MPHILL</option>
                                            <option value="<?php echo $semester->PROGRAME ?>"<?php if($semester->PROGRAME == 'PHD') {echo "selected=selected";} ?>>PHD</option>
                                            <option value="<?php echo $semester->PROGRAME ?>"<?php if($semester->PROGRAME == 'All') {echo "selected=selected";} ?>>All</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">                                
                                       <div class="form-group">
                                        <label for="smecode">Batch for Open Reg</label><b style="color:grey; font-size:10px"> Batch & Programe like BF18, MS18, PF17</b>
                                        <input type="text" class="form-control required" id="batchname" name="batchname" maxlength="300" style="text-transform:uppercase" value="<?php echo $semester->BATCHNAME ?>">
                                        
                                       </div>
                                    </div>
                            </div>
                                 <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="smstartdate">Semester Start Date</label>
                                        <input type="date" class="form-control required" id="smstartdate" name="smstartdate" maxlength="128" value="<?php echo $semester->SMSTARTDATE ?>">
                                      </div>
                                    
                                   </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="smenddate">Semester End Date</label>
                                        <input type="date" class="form-control required" id="smenddate"  name="smenddate" maxlength="128" value="<?php echo $semester->SMENDDATE ?>">
                                    </div>
                                </div>
                               </div>
                               <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="startregdate">Start Reg Date</label>
                                        <input type="date" class="form-control required" id="startregdate"  name="startregdate" maxlength="10" value="<?php echo $semester->STARTREGDATE ?>">
                                    </div>
                                </div>
                                
                                 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="endregdate">End Reg Date</label>
                                        <input type="date" class="form-control required equalTo" id="endregdate" name="endregdate" maxlength="10" value="<?php echo $semester->CLOSEREGDATE ?>">
                                    </div>
                               </div>
                            </div>
                               <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="startregdate">Start Reg Time</label>
                                        <input type="time" class="form-control required" id="startregtime"  name="startregtime" maxlength="10" value="<?php echo $semester->STARTREGTIME ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="endregdate">End Reg Time</label>
                                        <input type="time" class="form-control required" id="endregtime" name="endregtime" maxlength="10" value="<?php echo $semester->ENDREGTIME ?>">
                                    </div>
                                </div>
                              </div>
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control required" id="status" name="status">                                           
                                            <option <?php echo ($semester->IS_ACTIVE == 1)?'Selected':''; ?> value="1">Enable</option>
											<option <?php echo ($semester->IS_ACTIVE == 0)?'Selected':''; ?> value="0">Disable</option>
                                        </select>
                                    </div>
                                </div>
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Registration</label>
                                        <select class="form-control required" id="regstatus" name="regstatus">
                                            <option value="<?php echo $semester->APPSTATUS ?>"><?php if($semester->APPSTATUS == 1) echo 'New Application'; else echo 'Re-Allotment'; ?></option>
                                            <option value="1">New Application</option>
                                            <option value="2">Re-Allotment</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Re-Allotment Status</label>
                                        <select class="form-control required" id="reallot" name="reallot">
                                            <option value="<?php echo $semester->REALLOTSTATUS ?>"><?php if($semester->REALLOTSTATUS == 1) echo 'Open Re-Allotment'; else echo 'Close Re-Allotment'; ?></option>
                                            <option value="1">Open Re-Allotment</option>
                                            <option value="0">Close Re-Allotment</option>
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Seat Change Registration</label>
                                        <select class="form-control required" id="seatchange" name="seatchange">
                                        	<option value="<?php echo $semester->REALLOTSTATUS ?>"><?php if($semester->SEATCHANGESTATUS == 1) echo 'Open Seat Change'; else echo 'Close Seat Change'; ?></option>
                                            <option value="1">Open Seat Change</option>
                                            <option value="0">Close Seat Change</option>
                                        </select>
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

<script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>