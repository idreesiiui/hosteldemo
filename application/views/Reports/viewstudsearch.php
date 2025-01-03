<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Students Search
        <small>Student Search Info</small>
      </h1>
      <div class="col-md-4 pull-right">
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
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Student Search Info List</h3>
                    
                </div><!-- /.box-header -->
                <form class="form-horizontal" id="seatsearchList" name="validateform" method="post" action="<?php echo base_url() ?>report/reports/getallstudentsearch" >
              <div class="box-body">
                <div class="form-group">
                  <label style="width:80px" for="text" class="col-sm-3 control-label">Reg No</label>

                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="regno" name="regno">
                  </div>
                  <label style="width:120px" for="text" class="col-sm-3 control-label" >Student Name</label>

                  <div class="col-sm-3">
                     <input type="text" class="form-control" id="stname" name="stname" style="text-transform: capitalize;">
                  </div>
                   
                <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Search"/>
                <input type="reset" class="btn btn-secondary" value="Reset"/>
                </div>
             </form>
             <?php
                    if(!empty($studentInfo))
                    {
			  ?>
                <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
              <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Reg No</th>
                      <th>Student Name</th>
                      <th>Phone Number</th>
                      <th>Father Name</th>
                      <th>Remarks</th>
                      <th>Hostel No</th>
                      <th>Room No</th>
                      <th>Seats</th>
                      <th>Date</th>
                      <th>Semester</th>
                      <th>Status</th>
                      <th>History</th>
                    </tr>
              </thead>
                    <?php
                    if(!empty($studentInfo))
                    {
						$sno = 1;
                        foreach($studentInfo as $record)
                        {
                    ?>
                    <tr>
                      <td><?= $sno; ?></td>
                      <td><?= ($record->REGNO) ?? '';; ?></td>
                      <td><?= ($record->STUDENTNAME) ?? '';; ?></td>
                      <td><?= ($record->STUDENTPHONE) ?? ''; ?></td>
                      <td><?= ($record->FATHERNAME) ?? '';; ?></td>
                      <td>
                        <?php if(count($remarks) >= 1){ ?>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#remarksModal">Remarks</button>
                      <?php }else{ ?>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#remarksModal">Remarks</button>

                      <?php } ?>
                      </td>
                      <td><?= ($record->HOSTELNO) ?? '';; ?></td>
                      <td><?= ($record->ROOMNO) ?? '';; ?></td>
                      <td><?= ($record->SEAT) ?? '';; ?></td>
                      <td><?= date('d-m-Y', strtotime($record->DATE)); ?></td>
                      <td><?= ($record->SEMCODE) ?? '';; ?></td>
                      <td>
                        <strong
                          <?php 


                          if(!empty($record->TYPE)){
                          if($record->TYPE == 'Black List') {
                            echo 'class="bg-red-active color-palette"'; 
                            }else {
                              echo 'class="bg-green-active color-palette"';
                              }

                            }
                              ?>

                              >
                            <?php

                            if(!empty($record->TYPE)){
                            if($record->TYPE == 'Regular Semester' || $record->TYPE == '') {
                              echo 'Clearance'; 
                            } else {
                              echo ($record->TYPE) ?? ''; 
                              }

                            }

                              ?>
                          </strong>
                        </td>
                      <td>
                       <!-- Button trigger modal -->
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalLong">
  History
</button>





<!-- Modal -->
<div class="modal fade" id="remarksModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title" id="exampleModalLongTitle" style="margin-left:30%">Hostel Allotment History of <strong style="font-size:18px; text-decoration:underline"><?php echo $studentHistory[0]->STUDENTNAME.' ('.$studentHistory[0]->REGNO.')'?></strong> </span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="example1" class="table table-bordered table-striped">
              <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Student Name</th>
                      <th>Student Registrion NO</th>
                      <th>Remarks</th>
                     <!--  <th>Room No</th>
                      <th>Seats</th>
                      <th>Date</th>
                      <th>Semester</th>
                      <th>First Allotment</th>
                      <th>Status</th> -->
                    </tr>
              </thead>
              <?php
                    if(!empty($remarks))
                    {
            $sno = 1;
                        foreach($remarks as $remark)
                        {
                    ?>
                    <tr>
                      <td><?= $sno; ?></td>
                      <td><?= ($remark->NAME) ?? ''; ?></td>
                      <td><?= ($record->REGNO) ?? ''; ?></td>
                      <td><?= ($remark->REMARKS) ?? ''; ?></td>
                     
                      </tr>
                    <?php
          $sno++;
                        }
                    }
          else
             echo '<h4 style="color: red; text-align: center; font-size:12">No Record exist in database Or Invalid Regno, Student Name!</h4>';
                    ?>
                  </table>
                  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
      </div>
    </div>
  </div>
</div> 






<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title" id="exampleModalLongTitle" style="margin-left:30%">Hostel Allotment History of <strong style="font-size:18px; text-decoration:underline"><?= ($studentHistory[0]->STUDENTNAME) ?? ''; ?>(
        <?= ($studentHistory[0]->REGNO) ?? '';?>)</strong> </span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="example1" class="table table-bordered table-striped">
              <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Hostel No</th>
                      <th>Hostel Name</th>
                      <th>Room No</th>
                      <th>Seats</th>
                      <th>Date</th>
                      <th>Semester</th>
                      <th>First Allotment</th>
                      <th>Status</th>
                    </tr>
              </thead>
              <?php
                    if(!empty($studentInfo))
                    {
						$sno = 1;
                        foreach($studentHistory as $record)
                        {
                    ?>
                    <tr>
                      <td><?= $sno; ?></td>
                      <td><?= ($record->HOSTELNO) ?? ''; ?></td>
                      <td><?= ($record->HOSTELNAME) ?? ''; ?></td>
                      <td><?= ($record->ROOMNO) ?? ''; ?></td>
                      <td><?= ($record->SEAT) ?? ''; ?></td>
                      <td><?= date('d-m-Y', strtotime($record->DATE)); ?></td>
                      <td><?= ($record->SEMCODE) ?? ''; ?></td>
                      <td><?= ($record->HOSTELBATCH) ?? ''; ?></td>
                      <td><strong <?php if($record->TYPE == 'Regular Semester' || $record->TYPE == '' || $record->TYPE == 'Summer Semester'){?> class="bg-green-active color-palette" <?php }elseif($record->TYPE == 'REALLOTMENT' || $record->TYPE == 'ReAlloted'){ ?> class="bg-blue-active color-palette" <?php } elseif($record->TYPE == 'ALLOTMENT' || $record->TYPE == 'Allotment') {?> class="bg-yellow-active color-palette" <?php } ?>>
					  <?php if($record->TYPE == 'Regular Semester' || $record->TYPE == '' || $record->TYPE == 'Summer Semester') {echo 'Clearance'; } else echo $record->TYPE ?></strong></td>
                      </tr>
                    <?php
					$sno++;
                        }
                    }
					else
						 echo '<h4 style="color: red; text-align: center; font-size:12">No Record exist in database Or Invalid Regno, Student Name!</h4>';
                    ?>
                  </table>
                  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
      </div>
    </div>
  </div>
</div>                      
                      </td>
                    </tr>
                    <?php
					$sno++;
                        }
                    }
					else
						 echo '<h4 style="color: red; text-align: center; font-size:12">No Record exist in database Or Invalid Regno, Student Name!</h4>';
                    ?>
                  </table>
                  <?php
					}
					
			       ?>
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?= base_url('assets/js/common.js'); ?>" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "userListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
