<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View Hostel Due Fee Challan Management
        <small>View</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                 <a style="float:left !important" class="btn btn-default" href="<?php echo base_url(); ?>feechallan/Feechallan/addnorFeeschallan">Back</a>
                  
                    <div class="col-md-6">
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
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">View Hostel Normal Fee Challan List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <form role="form" id="addUser" action="<?php echo base_url() ?>feechallan/Feechallan/InsertFeeChallan" method="post" role="form">
              <table id="example1" class="table table-bordered table-striped">
              <thead>
                    <tr>
                      <th>S.No</th>
                      <th>RegNo</th>
                      <th>Student Name</th>
                      <th>Batch Name</th>
                      <th>Nationality</th>
                      <th>Programe</th>
                      <th>Current Semester</th>
                      <th>Assign Fee Structure</th>
                      <th>Challan Due Date</th>
                      <!-- <th>Updated Date</th>
                      <th>Actions</th>-->
                    </tr>
              </thead>
                    <?php 
                    if(!empty($reginfos))
                    {
						$sno = 1; 
                        foreach($reginfos as $key=>$reginfo)
                        {
							if($reginfo != 'null' && $studnameinfo[$key]!= 'null' && $bnameinfo[$key]!= 'null')
							{
                    ?>
                    <tr>
                      <td><?php echo $sno ?></td>
                      <td><?php echo $reginfos[$key] ?></td>
                      <td><?php echo $studnameinfo[$key] ?></td>
                      <td><?php echo $bnameinfo[$key] ?></td>
                      <td><?php echo $nationality ?></td>
                      <td><?php echo $programe ?></td>
                      <td><?php echo $csem ?></td>
                      <td><?php echo $assignfee ?></td>
                      <td><?php echo $duedate ?></td>
                      
                      <!-- Hidden Table value to post data -->
                      <input type="hidden" class="form-control" readonly value="<?php echo $reginfos[$key] ?>" id="regno" name="regno[]" required>
                      <input type="hidden" class="form-control" readonly value="<?php echo $studnameinfo[$key] ?>" id="studname" name="studname[]" required>
                      <input type="hidden" class="form-control" readonly value="<?php echo $bnameinfo[$key] ?>" id="batch" name="batch[]" required>
                      <input type="hidden" class="form-control" readonly value="<?php echo $nationality ?>" id="nationality" name="nationality[]" required>
                      <input type="hidden" class="form-control" readonly value="<?php echo $programe ?>" id="programe" name="programe[]" required>
                      <input type="hidden" class="form-control" readonly value="<?php echo $csem ?>" id="csemester" name="csemester[]" required>
                      <input type="hidden" class="form-control" readonly value="<?php echo $assignfee ?>" id="assignfee" name="assignfee[]" required>
                      <input type="hidden" class="form-control" readonly value="<?php echo $duedate ?>" id="duedate" name="duedate[]" required>
                      <!--<td><?php //echo $record->updated_at ?></td>-->
                      
                    </tr>
                    <?php
					$sno++;
							}
                        }
						
                    }
					else
						 echo '<h4 style="color: red; text-align: center">No Record exist in database!</h4>';
                    ?>
                  </table>
                  <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                            <a class="btn btn-primary" style="background-color:#3C8DBC; float:right" href="<?php echo base_url(); ?>feechallan/Feechallan/addnorFeeschallan">Back</a>
                        </div>
                    </form>
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
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
