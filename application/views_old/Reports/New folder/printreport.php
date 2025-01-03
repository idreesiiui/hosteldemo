<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Student Merit List
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
   		 <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>report/reports/printpdf">Download Report</a>
                </div>
            </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title" style="margin-left:50%; font-weight:bold; text-decoration:underline">Student Merit List</h3>
                   
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>SNo.</th>
                      <th>Student Name</th>
                      <th>Reg No</th>
                      <th>Programe</th>
                      <th>Nationality</th>
                      <th>Application Submit Date</th>
                                          </tr>
                    <?php
                    if(!empty($studentInfo))
                    {
						$count = 1;
                        foreach($studentInfo as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $count ?></td>
                      <td><?php echo $record->STUDENTNAME ?></td>
                      <td><?php echo $record->REGNO ?></td>
                      <td><?php echo $record->PROGRAME ?></td>
                      <td><?php echo $record->NATIONALITY ?></td>
                      <td><?php echo $record->CREATEDDTM ?></td>
                    
                    </tr>
                    <?php
                      $count++;  } 
					}
                  else{ 
					echo '<h4 style="color: red; text-align: center">No Record exist in database!</h4>';} ?>
                  </table>
				  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php //echo $this->pagination->create_links(); ?>
                </div>
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
