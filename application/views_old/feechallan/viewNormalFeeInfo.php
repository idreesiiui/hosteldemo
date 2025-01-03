<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View Hostel Due Fee Structure Management
        <small>View</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                 <a style="float:left !important" class="btn btn-default" href="<?php echo base_url(); ?>feechallan/Feechallan/viewhostelduesfeestructure">Back</a>
                  <a class="btn btn-primary" href="<?php echo base_url(); ?>feechallan/Feechallan/Feestucture">Add New</a>
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
                    <h3 class="box-title">View Hostel Fee Structure List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
              <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Nationality</th>
                      <th>Programe</th>
                      <th>Batch Name</th>
                      <th>Fees Desc</th>
                      <th>Fee Assign Structure</th>
                      <th>Fee Amount</th>
                      <th>Fee Type</th>
                      <th>Creadted Date</th>
                      <th>Updated Date</th>
                      <th>Actions</th>
                    </tr>
              </thead>
                    <?php 
                    if(!empty($viewFeeInfo))
                    {
						$sno = 1;
                        foreach($viewFeeInfo as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $sno ?></td>
                      <td><?php echo $record->NATIONALITY ?></td>
                      <td><?php echo $record->PROTITTLE ?></td>
                      <td><?php echo $record->BATCHNAME ?></td>
                      <td><?php echo $record->FEEDESC ?></td>
                      <td><?php echo $record->FEESTRUCSEM ?></td>
                      <td><?php echo $record->FEEAMOUNT ?></td>
                      <td><?php echo $record->FEETYPE ?></td>
                      <td><?php echo $record->created_at ?></td>
                      <td><?php echo $record->updated_at ?></td>
                      <td>
                          <a href="<?php echo base_url().'feechallan/Feechallan/EditNornalFeeStructure/'.$record->id ?>"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;</a>
                      <!--    <a href="#" data-allotid="<?php //echo $record->id; ?>" class="deleteAllotment"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;</a>-->
                      </td>
                    </tr>
                    <?php
					$sno++;
                        }
                    }
					else
						 echo '<h4 style="color: red; text-align: center">No Record exist in database!</h4>';
                    ?>
                  </table>
                  
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
