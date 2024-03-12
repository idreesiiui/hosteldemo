<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Website Content Management
        <small>Add / Edit Ext</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Website Content Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="addUser" action="<?php echo base_url() ?>setting/settings/UpdateWebContent" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="gender">Content Type</label>
                                        <select class="form-control required" id="type" name="type">
                                        <?php
										if($content[0]->type != '' && isset($content[0]->type))
										{
										?>
                                            <option value="Notification" <?php if($content[0]->type == 'Notification') {echo "selected=selected";} ?>> <?php echo 'Notification' ?> </option>
                                            <option value="List" <?php if($content[0]->type == 'List') {echo "selected=selected";} ?>> List</option>
                                      </select>
                                      <?php } ?>
                                    </div>
                                    
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Content Description</label>
                                         <textarea name="desc" id="desc" class="form-control required" required><?php echo $content[0]->upload_desc?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="noofyear">Publish Date</label>
                                        <input type="date" class="form-control required" id="pubdate"  name="pubdate" value="<?php echo $content[0]->pubdate?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Content Upload</label>
                                          <input type="file" class="form-control" id="image" name="image" accept="application/pdf,image/*" >
                                           <input type="hidden" class="form-control required" id="id"  name="id" value="<?php echo $content[0]->id?>">
                                    </div>
                                </div>
                            </div>
                          	<div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="gender">Status</label>
                                        <select class="form-control required" id="status" name="status">
                                        <option value="1" <?php if($content[0]->status == 1) {echo "selected=selected";} ?>> <?php echo 'Enable' ?> </option>
                                            <option value="0" <?php if($content[0]->status == 0) {echo "selected=selected";} ?>> Disable</option>
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
<script src="<?php echo base_url(); ?>assets/js/addExt.js" type="text/javascript"></script>