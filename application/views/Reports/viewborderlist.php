<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Students Border List
        <small>View Border List</small>
      </h1>
     <?php //$this->load->helper('cias_helper'); 
	 get_instance()->load->helper('cias_helper');?>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                <a class="btn btn-default" style="float:left;" href="<?php echo base_url().'report/reports/borderlist/' ?>">Back</a>
                   <!-- <a class="btn btn-primary" href="<?php //echo base_url().'report/reports/printlist/'.$studentInfo[0]->PROTITTLE.$studentInfo[0]->SEMESTERCODE ?>">Print Report</a>-->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">              
                 <div id="feedback" style="float: right; width: 225px; display: none;" class="alert alert-success alert-dismissible">Rcords Save Successfully</div>   
                </div>
                 
                  <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
				<thead>
                    <tr>
                      <th>SNo.</th>
                      <th>Student Name</th>
                      <th>Reg No</th>
                      <th>Student Phone</th>
                      <!--<th>Father Occupation</th>-->
                      <!--<th>Father Phone</th>-->
                      <th>CNIC</th>
                      <th>Faculty</th>
                      <th>Programe</th>
                      <th>Allot Type</th>
                      <th>Dept Name</th>
                      <th>Province</th>
                      <!--<th>Batch Name</th>-->
                      <th>Address</th>
                      <th>Email</th>
                      <th>Country</th>
                      <th>Nationality</th>
                      <th>Hostel</th>
                      <th>Room</th>
                     <!-- <th>R-Type</th>
                      <th>Seat</th>
                      <th>Type</th>
                      <th>Fee</th>-->
                      <th>Ext</th>
                     
                    </tr>
                 </thead>
                    <?php
                    if(!empty($studentInfo) && !empty($batchname))
                    {   //echo $batchname[0][0]->REGNO.'<br>';
						//print_r($batchname);
						/*foreach($batchname as $ba)
						{
						echo $ba->REGNO;
						}
						exit();*/
						$total = count($studentInfo);
						$count = 1;
                        for($i=0;$i<$total;$i++)
						//foreach($studentInfo as $record)
                        {
                    ?>
                    <tr <?php if($studentInfo[$i]->ADMIN_VERIFY == 0) {?> style="background-color:#ED9B9D;" <?php }?>>
                      <td><?php echo $count ?></td>
                      <td><?php echo $studentInfo[$i]->STUDENTNAME ?></td>
                      <td><?php echo $studentInfo[$i]->REGNO; ?> </td>
                       <td><?php echo $studentInfo[$i]->STUDENTPHONE ?></td>
                       <!--<td><?php //echo $studentInfo[$i]->FATHEROCCUPATION ?></td>-->
                      <!--<td><?php //echo $studentInfo[$i]->FATHERPHONE ?></td>-->
                       <td><?php echo $studentInfo[$i]->CNIC ?></td>
                       <td><?php echo $studentInfo[$i]->FACULTY; ?></td>
                       <td><?php echo $studentInfo[$i]->PROTITTLE ?></td>
                      <td><?php echo $studentInfo[$i]->ALLOTTYPE; ?></td>
                      <td><?php echo $studentInfo[$i]->DEPARTNAME ?></td>
                      <td><?php echo $studentInfo[$i]->PROVINCE; ?></td>
                      <td><?php echo $studentInfo[$i]->ADDRESS ?></td>
                      <td><?php echo $studentInfo[$i]->email ?></td>
                      <td><?php echo $studentInfo[$i]->COUNTRY; ?></td>
                      <td><?php echo $studentInfo[$i]->NATIONALITY ?></td>
                      <td><?php echo $studentInfo[$i]->HOSTEL_NO ?></td>
                    <td><?php echo $studentInfo[$i]->ROOMDESC ?></td>
                      <!-- <td><?php //echo $studentInfo[$i]->ROOMTYPE ?>
                     <td><?php //echo $studentInfo[$i]->SEAT ?></td>
                      <td><?php //echo $studentInfo[$i]->ALLOTTYPE;//$status = substr($record->SEATSTATUS,0,1); ?></td>
                      <td><?php //echo $status = substr($studentInfo[$i]->SEATSTATUS,0,1); ?></td>-->
                      <td>
                          <?php if($studentInfo[$i]->EXT)
						?>
                        <select name="ext[]" id="ext" class="form-control selectboxit visible">
                        
                        <option value="0<?php echo $studentInfo[$i]->REGNO?>"<?php if($studentInfo[$i]->EXT == '0'){echo "selected=selected";}?> style="color:green; font-weight:bold">No Ext</option>
                        <option value="1<?php echo $studentInfo[$i]->REGNO?>"<?php if($studentInfo[$i]->EXT == '1'){echo "selected=selected";}?> style="color:#FF8C00; font-weight:bold">1st Ext</option>
                        <option value="2<?php echo $studentInfo[$i]->REGNO?>"<?php if($studentInfo[$i]->EXT == '2'){echo "selected=selected";}?> style="color:orange; font-weight:bold">2nd Ext</option>
                         <option value="3<?php echo $studentInfo[$i]->REGNO?>"<?php if($studentInfo[$i]->EXT == '3'){echo "selected=selected";}?> style="color:orange; font-weight:bold">3rd Ext</option>
                          <option value="4<?php echo $studentInfo[$i]->REGNO?>"<?php if($studentInfo[$i]->EXT == '4'){echo "selected=selected";}?> style="color:orange; font-weight:bold">4th Ext</option>
                           <option value="5<?php echo $studentInfo[$i]->REGNO?>"<?php if($studentInfo[$i]->EXT == '5'){echo "selected=selected";}?> style="color:orange; font-weight:bold">5th Ext</option>
                            <option value="6<?php echo $studentInfo[$i]->REGNO?>"<?php if($studentInfo[$i]->EXT == '6'){echo "selected=selected";}?> style="color:red; font-weight:bold">Block</option>
                             
                        </select>
						  
                      </td>
                    </tr>
                    <?php
                      $count++;  } 
					}
                  else{ 
					echo '<h4 style="color: red; text-align: center">No Record exist in database!</h4>';} ?>
                  </table>
				  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/ext.js" charset="utf-8"></script>
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
