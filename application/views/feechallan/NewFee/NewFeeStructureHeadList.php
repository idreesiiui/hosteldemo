<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        New Fee Structure Head Management
        <small>Add, Edit</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>feechallan/newfeechallan/newFeeStuctureHead">Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">New Fee Structure Head List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="feeStructurHeadListing" class="table table-bordered table-striped">
                    <thead>
                       <tr>
                       	  <th>S.No.</th>
                          <th>Head Name</th>
                          <th>Head Code</th>
                          <th>Fee Structure Semester</th>
                          <th>Amount</th>
                          <th>Created By</th>
                          <th>Created at</th>
                          <th>Updated at</th>
                          <th>Status</th>
                          <th>Actions</th>
                       </tr>
                    </thead>
                    <?php 
                    if(!empty($Feeheads))
                    {
						$sno = 1;
                        foreach($Feeheads as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $sno ?></td>
                      <td><?php echo $record->head_name ?></td>
                      <td><?php echo $record->head_code ?></td>
                      <td><b><?php echo $record->fee_structure_semester.' ('.$record->structure_type.'-'.$record->nationality.'-'.$record->program.')' ?></b></td>
                      <td><?php echo $record->amount ?></td>
                      <td><?php echo $record->name ?></td>
                      <td><?php echo date("d-m-Y", strtotime($record->created_at)) ?></td>
                      <td><?php if($record->updated_at != '') echo date("d-m-Y", strtotime($record->updated_at)) ?></td>
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
                      	 <a href="<?php echo base_url().'feechallan/NewFeechallan/NeweditHeadFeeStructure/'.$record->id ?>"><i class="fa fa-pencil"></i> Edit
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
            jQuery("#searchList").attr("action", baseURL + "feeStructurHeadListing/" + value);
            jQuery("#searchList").submit();
        });
        var table = $('#feeStructurHeadListing').DataTable( {
        lengthChange: false,
        "scrollX": false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
        aLengthMenu: [[50, 25, 100, 150, 500, -1], [50, 25, 100, 150, 500, "All"]]
    } );
        table.buttons().container().appendTo( '#feeStructurHeadListing_wrapper .col-sm-6:eq(0)' );
    });
</script>

