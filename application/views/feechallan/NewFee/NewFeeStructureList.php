<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        New Fee Structure Management
        <small>Add, Edit</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>feechallan/newfeechallan/newFeeStucture">Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">New Fee Structure List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="feeStructureListing" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                          <th>S.No.</th>
                          <th>Structure Type</th>
                          <th>Nationality</th>
                          <th>Program</th>
                          <th>Semester</th>
                          <th>created at</th>
                          <th>updated at</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                    </thead>
                    <?php 
                    if(!empty($Feerecords))
                    {
						$sno = 1;
                        foreach($Feerecords as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $sno ?></td>
                      <td><?php echo $record->structure_type ?></td>
                      <td><?php echo $record->nationality ?></td>
                      <td><?php echo $record->program ?></td>
                      <td><?php echo $record->fee_structure_semester ?></td>
                      <td><?php echo date("d-m-Y H:m:i", strtotime($record->created_at)) ?></td>
                      <td><?php 
                      if($record->updated_at != null){
                        echo date("d-m-Y H:m:i", strtotime($record->updated_at));
                      } else{
                        echo '';
                      } ?>
                          
                      </td>
           
                       <td>
					  	  <?php 
						  		if($record->status == 1){ ?>
								   <button type="button" class="btn btn-block btn-success btn-flat">Enable</button>
                          <?php
								}
								 else{ ?>
                                   <button type="button" class="btn btn-block btn-danger btn-flat">Disable</button>
						  <?php	 
								 }
						  ?>
                       </td>
                      <td>
                      	 <a href="<?php echo base_url().'feechallan/NewFeechallan/NeweditFeeStructure/'.$record->id ?>"><i class="fa fa-pencil"></i> Edit
                         </a>
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
                <div class="box-footer clearfix">
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
            jQuery("#searchList").attr("action", baseURL + "feeStructureListing/" + value);
            jQuery("#searchList").submit();
        });

        var table = $('#feeStructureListing').DataTable( {
                lengthChange: false,
                "scrollX": false,
                buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
                aLengthMenu: [[50, 25, 100, 150, 500, -1], [50, 25, 100, 150, 500, "All"]]
            } );
        table.buttons().container().appendTo( '#feeStructureListing_wrapper .col-sm-6:eq(0)' );
    });
</script>

