<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Students Details
        <small>Student Info System</small>
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
                      <th>Father Name</th>
                      <!-- <th>Cell No</th> -->
                      <th>DOB</th>
                      <th>CNIC</th>
                      <th>Faculty</th>
                      <th>Department</th>
                      <th>Programe</th>
                      <th>Nationality</th>
                      <th>Credit Hrs</th>
                      <th>Permanent Address</th>
                      <th>Current Address</th>
                    </tr>
              </thead>
                    <?php

                    $CI =& get_instance();                 



                    if(!empty($studentInfo))
                    {
						$sno = 1;
                        foreach($studentInfo as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $sno ?></td>
                      <td><?php echo $record->REGNO ?></td>
                      <td><?php echo $record->STUDENTNAME ?></td>
                      <td><?php echo $record->FATHERNAME ?></td>
                      <!-- <td><?php //echo $record->STUDENTNUMBER ?></td> -->
                      <td><?php echo $record->STUDENTDOB ?></td>
                      <td><?php echo $record->CNIC ?></td>
                      <td><?php echo $record->FACULTY ?></td>
                      <td><?php echo $record->DEPARTMENTNAME ?></td>
                      <td><?php echo $record->PROTITTLE ?></td>
                      <td><?php echo $record->NATIONALITY//number_format($record->CGPA, 2) ?></td>
                      <td><?php 

                      $criditHrs = $CI->report_model->getStudentCreditHours($record->REGNO, $currentSemester);

                      echo $criditHrs[0]->CREDITHRS; 


                  ?></td> 
                      <td><?php echo $record->PERMANENT ?></td>
                      <td><?php echo $record->PREADD ?></td>
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
