<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        New Fee Challan Management
        <small>Add, Edit, View</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary mr-1" style="background-color:#3C8DBC; float:right" href="<?php echo base_url(); ?>feechallan/newfeechallan/addbulkfeechallan">Add New Batchwise Fee Challan</a>
                        <a class="btn btn-primary" style="background-color:#3C8DBC; float:right; margin-right: 2em;" href="<?php echo base_url(); ?>feechallan/newfeechallan/addregnowisefeechallan">Add New Fee Challan Regno wise</a>
                        <a target="_blank" class="btn btn-primary" style="background-color:#3C8DBC; float:right; margin-right: 2em;" href="<?php echo base_url(); ?>feechallan/newfeechallan/allfeechallan">All Fee Challan</a>
                        <a target="_blank" class="btn btn-primary" style="background-color:#3C8DBC; float:right; margin-right: 2em;" href="<?php echo base_url(); ?>feechallan/newfeechallan/allAllotmentfeechallan">All Allotment Fee Challan</a>
                        <a target="_blank" class="btn btn-primary" style="background-color:#3C8DBC; float:right; margin-right: 2em;" href="<?php echo base_url(); ?>feechallan/newfeechallan/allReAllotmentfeechallan">All ReAllotment Fee Challan</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">New Fee Challan List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="feeChallanListing" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                          <th>S.No.</th>
                          <th>Current Semester</th>
                          <th>Fee Structure</th>
                          <th>Fee Structure Type</th>
                          <th>Issue Date</th>
                          <th>Due Date</th>
                          <th>Months</th>
                          <th>No.of Challan</th>
                          <th>Published</th>
                          <th>created at</th>
                          <th>updated at</th>
                          <th>Actions</th>
                        </tr>
                    </thead>
                    <?php 
                    if(!empty($challaninfo))
                    {
						$sno = 1;
                        foreach($challaninfo as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $sno ?></td>
                      <td><?php echo $record->fee_challan_csem ?></td>
                      <td>
					       <?php 
						        $feestructureid = $record->new_fee_structure_id;
								$CI =& get_instance();
								$CI->load->model('feechallan_model');
								$result = $CI->feechallan_model->GetFeestructureInfo($feestructureid);
								$feetype =  $result->structure_type;
								$feenationality =  $result->nationality;
								$feestructsem =  $result->fee_structure_semester;
								$program =  $result->program;
																
								echo '<b>'.$feestructsem.'-'.$program.'-'.$feenationality.'</b>';
								
						   ?>
                      </td>
                      <td><?php echo $feetype ?></td>
                      <td><?php echo date("d-m-Y", strtotime($record->issuedate)) ?></td>
                      <td><?php echo date("d-m-Y", strtotime($record->duedate)) ?></td>
                      <td><?php echo $record->month ?></td>
                      <td><?php echo $record->total_challan ?></td>
                      <td>
					  	  <?php 
						  		if($record->publish == 1){ ?>
								   <button type="button" class="btn btn-block btn-success btn-flat">Yes</button>
                          <?php
								}
								 else{ ?>
                                   <button type="button" class="btn btn-block btn-danger btn-flat">No</button>
						  <?php	 
								 }
						  ?>
                       </td>
                      <td><?php echo date("d-m-Y H:m:i", strtotime($record->created_at)) ?></td>
                      <td><?php if(!empty($record->updated_at)) echo date("d-m-Y H:m:i", strtotime($record->updated_at)) ?></td>
           
                       
                      <td>
                      	 <a href="<?php echo base_url().'feechallan/NewFeechallan/NeweditFeeChallan/'.$record->id ?>"><i class="fa fa-pencil"></i> Edit
                         </a><br>
                          <a target="_blank" href="<?php echo base_url().'feechallan/NewFeechallan/NewviewFeeChallan/'.$feestructureid.'/'.$record->fee_challan_csem.'/'.$feenationality ?>"><i class="fa fa-eye"></i> View
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

        var table = $('#feeChallanListing').DataTable( {
                lengthChange: false,
                "scrollX": false,
                buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
                aLengthMenu: [[50, 25, 100, 150, 500, -1], [50, 25, 100, 150, 500, "All"]]
            } );
        table.buttons().container().appendTo( '#feeChallanListing_wrapper .col-sm-6:eq(0)' );
    });
</script>

