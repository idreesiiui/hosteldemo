<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Students Allotment Slips
        <small>Seat Allotment</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Student Info List</h3>
                    
                </div><!-- /.box-header -->
                <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
              <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Reg No</th>
                      <th>Student Name</th>
                      <th>Permanent Address</th>
                      <th>Current Address</th>
                      <th>Mobile No</th>
                      <th>Hostel No</th>
                      <th>Hostel Name</th>
                      <th>Room No</th>
                      <th>Seat</th>
                      <th>Country</th>
                      <th>Province</th>
                      <th>Action</th>
                    </tr>
              </thead>
                    <?php
                    if(!empty($allotslip))
                    {
						$sno = 1;
                        foreach($allotslip as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $sno ?></td>
                      <td><?php echo $record->REGNO ?></td>
                      <td><?php echo $record->STUDENTNAME ?></td>
                      <td><?php echo $record->ADDRESS ?></td>
                      <td><?php echo $record->CADDRESS ?></td>
                      <td><?php echo $record->mobile ?></td>
                      <td><?php echo $record->HOSTEL_NO ?></td>
                      <td><?php echo $record->HOSTELDESC ?></td>
                      <td><?php echo $record->ROOMDESC ?></td>
                      <td><?php echo $record->SEAT ?></td>
                      <td><?php echo $record->COUNTRY ?></td>
                      <td><?php echo $record->PROVINCE ?></td>
                      <td>
                          <a href="<?php echo base_url().'report/reports/studentallot/'.$record->ALLOTMENT_ID; ?>" target="_blank"><i class="fa fa-file"></i>&nbsp;&nbsp;&nbsp;</a>
                          
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
    });
</script>
