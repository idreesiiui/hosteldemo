<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View Hostel Fee Challan Generated
        <small>View</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                 <a style="float:left !important" class="btn btn-default" href="<?php echo base_url(); ?>feechallan/Feechallan/hostelChallans">Back</a>                
                  
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
                    <h3 class="box-title">View Hostel Fee Challans</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
              <table id="feeChallans" class="table table-bordered table-striped">
              <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Regno</th>
                      <!-- <th>Student Name</th>
                      <th>Programe</th> -->
                      <th>Nationality</th>
                      <th>Challan No</th>
                      <th>Semester</th>
                      <th>Principal Amount<small>(Without fine)</small></th>
                      <th>Issue Date</th>
                      <th>Due Date</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
              </thead>
                    <?php 

                    $this->load->model('feechallan_model');
                    $CI =& get_instance();

                    if(!empty($viewHostelFeeChallans))
                    {
						$sno = 1;
                        foreach($viewHostelFeeChallans as $record)
                        {
                    $princepleAmount = $CI->feechallan_model->getPrincepleAmount($record->regno,$record->challanno);
                    ?>
                    <tr>
                      <td><?php echo $sno ?></td>
                      <td><?php echo $record->regno; ?></td>
                      <!-- <td><?php //echo $record->STUDENTNAME ?></td>
                      <td><?php //echo $record->PROTITTLE ?></td> -->
                      <td><?php echo $record->nationality ?></td>
                      <td><?php echo $record->challanno; ?></td>
                      <td><?php echo $record->current_semester ?></td>
                      <td><?php echo $princepleAmount; ?></td>
                      <td><?php echo $record->updated_at ?></td>  
                      <td><?php echo $record->duedate; ?></td>
                      <td><?php if($record->publish == 1) { ?><span class="bg-green-active color-palette"><?php echo 'Published';?></span><?php } 
					  elseif($record->STATUS == 0) { ?><span class="bg-red color-palette"><?php echo 'UnPublished'; }?></span></td>
                       <td>
                          <!-- <a href="<?php //echo base_url().'feechallan/Feechallan/EditNornalFeeChallan/'.$record->id ?>" target="_blank"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;</a> -->
                     <a href="<?php echo base_url().'feechallan/NewFeechallan/printFeeChallanByRegno/'.$record->id ?>" target="_blank"><i class="fa fa-print"></i>&nbsp;&nbsp;&nbsp;</a>
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

         var table = $('#feeChallans').DataTable( {
        lengthChange: false,
        "scrollX": false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
        aLengthMenu: [[50, 25, 100, 150, 500, -1], [50, 25, 100, 150, 500, "All"]]
    } );
         table.buttons().container().appendTo( '#feeChallans_wrapper .col-sm-6:eq(0)' );
    });
</script>
