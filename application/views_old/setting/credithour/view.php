<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Credit Hours Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>addnewCredit">Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Credit Hours Setting List</h3>
                    
                </div><!-- /.box-header -->
                <div class="box-body">
              <table id="creditHoursSettings" class="table table-bordered table-striped">
              <thead>
                    <tr>
                      <th>S.No</th>
                      <th>BS(PK)</th>
                      <th>MA/MSC(PK)</th>
                      <th>MBA(1.5)(PK)</th>
                      <th>MBA(3.5)(PK)</th>
                      <th>MS(PK)</th>
                      <th>PHD(PK)</th>
                      <th>BS(FORE)</th>
                      <th>MA/MSC(FORE)</th>
                      <th>MBA(1.5)(FORE)</th>
                      <th>MBA(3.5)(FORE)</th>
                      <th>MS(FORE)</th>
                      <th>PHD(FORE)</th>
                      <th>SEMCODE</th>
                      <th>STATUS</th>
                      <th>Actions</th>
                    </tr>
              </thead>
                    <?php
                    if(!empty($CreditSettings))
                    {
						$sno = 1;
                        foreach($CreditSettings as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $sno ?></td>
                      <td><?php echo $record->BSPAK ?></td>
                      <td><?php echo $record->MAPAK ?></td>
                      <td><?php echo $record->MBA_1 ?></td>
                      <td><?php echo $record->MBA3 ?></td>
                      <td><?php echo $record->MSPAK ?></td>
                      <td><?php echo $record->PHDPAK ?></td>
                      <td><?php echo $record->BSFOREIGNER ?></td>
                      <td><?php echo $record->MAFOREIGNER ?></td>
                      <td><?php echo $record->MBA_1_FOREIGNER ?></td>
                      <td><?php echo $record->MBA3_FOREIGNER ?></td>
                      <td><?php echo $record->MSFOREIGNER ?></td>
                      <td><?php echo $record->PHDFOREIGNER ?></td>
                      <td><?php echo $record->SEMCODE ?></td>
                      <td><?php if($record->STATUS == 1) echo 'Enable'; else echo 'Disable'; ?></td>
                      <td>
                          <a href="<?php echo base_url().'editcredit/'.$record->ID; ?>"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;</a>
                          <!--<a href="#" data-hostelid="<?php //echo $record->HOSTELID; ?>" class="deleteHostel"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;</a>-->
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


        var table = $('#creditHoursSettings').DataTable( {
        lengthChange: true,
    "scrollX": true,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
    aLengthMenu: [[50, 25, 100, 150, 500, -1], [50, 25, 100, 150, 500, "All"]]
    } );
  
  table.buttons().container()
        .appendTo( '#creditHoursSettings_wrapper .col-sm-6:eq(0)' );


    });
</script>
