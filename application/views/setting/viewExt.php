<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ext Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>setting/settings/addsettingExt">Add New</a>
                    <div class="col-md-5">
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
                    <h3 class="box-title">Ext List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
              <table id="viewExtList" class="table table-bordered table-striped">
              <thead>
                    <tr>
                       <th>S.No</th>
                      <th>Student Type</th>
                      <th>Degree Tittle</th>
                      <th>NO. Of Year</th>
                      <th>1st Ext</th>
                      <th>2nd Ext</th>
                      <th>Actions</th>
                    </tr>
              </thead>
                     <?php
                    if(!empty($ext))
                    {  $sn = 1;
                        foreach($ext as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $sn ?></td>
                      <td><?php echo $record->studenttype ?></td>
                      <td><?php echo $record->degreetittle ?></td>
                      <td><?php echo $record->noofyear ?></td>
                      <td><?php echo $record->firstext ?></td>
                      <td><?php echo $record->secondext ?></td>
                      <td>
                          <a href="<?php echo base_url().'setting/settings/settingExt/'.$record->id; ?>"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;</a>
                          <a href="#" data-userid="<?php echo $record->id; ?>" class="deleteext"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;</a>
                      </td>
                    </tr>
                    <?php
					$sn++;
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


        var table = $('#viewExtList').DataTable( {
            lengthChange: false,
            "scrollX": false,
            buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
            aLengthMenu: [[50, 25, 100, 150, 500, -1], [50, 25, 100, 150, 500, "All"]]
        } );
        table.buttons().container().appendTo( '#viewExtList_wrapper .col-sm-6:eq(0)' );
    });
</script>
