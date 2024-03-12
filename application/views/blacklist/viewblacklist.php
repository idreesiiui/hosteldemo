<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Black List Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>blacklist/blacklist/addNew">Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Black List Students</h3>
                    
                </div><!-- /.box-header -->
                <div class="box-body">
              <table id="blackListDetail" class="table table-bordered table-striped">
              <thead>
                    <tr>
                      <th>S.No</th>
                      <th>REG NO.</th>
                      <th>STUDENT NAME</th>
                      <th>CNIC NO.</th>
                      <th>STATUS</th>
                      <th>DATED</th>
                      <th>ACTIONS</th>
                    </tr>
              </thead>
                    <?php
                    if(!empty($blacklistRecords))
                    {
						$sno = 1;
                        foreach($blacklistRecords as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $sno ?></td>
                      <td><?php echo $record->REGNO ?></td>
                      <td><?php echo $record->STUDENTNAME ?></td>
                      <td><?php echo $record->BCNIC?></td>
                      <td><?php if($record->BSTATUS == 1) echo '<span class="bg-red-active color-palette">Activeted</span>';else echo '<span class="bg-green-active color-palette">Deactivated</span>' ?></td>
                      <td><?php echo $record->BDATE ?></td>
                      <td>
                          <a href="<?php echo base_url().'blacklist/blacklist/revertBlackListAllallot/'.$record->BLACKLIST_ID; ?>"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;</a>
                          <a href="#" data-hostelid="<?php echo $record->BLACKLIST_ID; ?>" class="deleteHostel"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;</a>
                          <?php if($record->BSTATUS == 1) { ?>
                          <a href="<?php echo base_url().'blacklist/blacklist/blackliststatus/'.$record->BLACKLIST_ID.'/'.'0'; ?>"><i class="btn btn-block btn-success">Deactivate</i>&nbsp;&nbsp;&nbsp;</a>
                          <?php } elseif($record->BSTATUS == 0) {?>
                          <a href="<?php echo base_url().'blacklist/blacklist/blackliststatus/'.$record->BLACKLIST_ID.'/'.'1'; ?>"><i class="btn btn-block btn-danger">Activate</i>&nbsp;&nbsp;&nbsp;</a>
                          <?php }?>
                          
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

        var table = $('#blackListDetail').DataTable( {
                lengthChange: false,
                "scrollX": false,
                buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
                aLengthMenu: [[50, 25, 100, 150, 500, -1], [50, 25, 100, 150, 500, "All"]]
            } );
        table.buttons().container().appendTo( '#blackListDetail_wrapper .col-sm-6:eq(0)' );
    });
</script>
