<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Website Content Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>setting/settings/contentAdd">Add New</a>
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
                    <h3 class="box-title">Website Content</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
              <thead>
                    <tr>
                       <th>S.No</th>
                      <th>Circular Name</th>
                      <th>Circular Type</th>
                      <th>Date of Published</th>
                      <th>Status</th>
                      <th>Download</th>
                      <th>Actions</th>
                    </tr>
              </thead>
                     <?php
                    if(!empty($webcontents))
                    {  $sn = 1;
                        foreach($webcontents as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $sn ?></td>
                      <td><?php echo $record->upload_desc ?></td>
                      <td><?php echo $record->type ?></td>
                      <td><?php echo date('d-m-Y', strtotime($record->pubdate)); ?></td>
                      <td><?php if($record->status ==1) {echo '<span class="bg-green-active color-palette"> Active</span>';} else echo '<span class="bg-red-active color-palette"> InActive</span>'; ?></td>
                      <td><a href="<?php echo base_url().$record->path?>" target="_blank" rel="noopener noreferrer"><img width="80" height="25" src="<?php echo base_url().'assets/frontend/img/usis/download.png' ?>"></td>
                      <td>
                          <a href="<?php echo base_url().'setting/settings/contentEdit/'.$record->id; ?>"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;</a>
                          <a href="#" data-webid="<?php echo $record->id; ?>" class="deleteWeb"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;</a>
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
    });
</script>
