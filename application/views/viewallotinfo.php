<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View Allotment Detail
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>report/reports/printAllotment/<?php echo $allotinfo[0]->HOSTELID."/".$allotinfo[0]->ROOMID?>">Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title"  style="text-decoration:underline">Allotment List <?php echo $allotinfo[0]->SEMCODE?></h3>
                    
                </div><!-- /.box-header -->
                <div class="box-body">
                 <?php
                    if(!empty($allotinfo))
                    {
						
                        foreach($allotinfo as $record)
                        {
                    ?>
              		<div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Reg No#</label>
                                        <input type="text" class="form-control required" id="regno"  name="regno" maxlength="120" readonly value="<?php echo $record->REGNO ?>">
                                        
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Student Name</label>
                                        <input type="text" class="form-control required" id="studentname"  name="studentname" maxlength="120" readonly value="<?php echo $record->STUDENTNAME ?>">
                                         
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Hostel No</label>
                                        <input type="text" class="form-control required" id="regno"  name="regno" maxlength="120"readonly value="<?php echo $record->HOSTEL_NO ?>">
                                        
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Hostel Name</label>
                                        <input type="text" class="form-control required" id="studentname"  name="studentname" maxlength="120" readonly value="<?php echo $record->HOSTELDESC ?>">
                                         
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Floor</label>
                                        <input type="text" class="form-control required" id="regno"  name="regno" maxlength="120" readonly value="<?php echo $record->FLOOR ?>">
                                        
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Room No</label>
                                        <input type="text" class="form-control required" id="studentname"  name="studentname" maxlength="120" readonly value="<?php echo $record->ROOMDESC ?>">
                                         
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="roomdesc">Seat</label>
                                        <input type="text" class="form-control required" id="regno"  name="regno" maxlength="120" readonly value="<?php echo $record->SEAT ?>">
                                        
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Alloted</label>
                                        <input type="text" class="form-control required" id="studentname"  name="studentname" maxlength="120" readonly value="<?php $occupied = $record->OCCUPIED;
					  if($occupied == 1) echo "Yes"; else "No";?>">
                                         
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="occupy">Expiry Date</label>
                                        <input type="text" class="form-control required" id="studentname"  name="studentname" maxlength="120" readonly value="<?php echo $record->EXPIRYDATE ?>">
                                         
                                    </div>
                                </div>
                  </div>
                  <div class="box box-success"></div>
                   <?php
					$sno++;
                        }
                    }
					else
						 echo '<h4 style="color: red; text-align: center">No Record exist in database!</h4>';
                    ?>
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
