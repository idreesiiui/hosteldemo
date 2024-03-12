<style>
table {
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h2 align="center" style="text-decoration:underline">
        IIUI Hostels (Student Merit List Verified)
        <small><?php echo $studentInfo[0]->GENDER?> Campus</small>
      </h1>
    </section>
   		 <div class="col-xs-12 text-right">
                <div class="form-group">
                  </div>
            </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                   <h4 class="box-title">Student Merit List of <?php if(($programe != 'All')) 
					{ echo "<strong>(".$studentInfo[0]->PROTITTLE." ".$semstudentInfo[0]->SEMESTEROPENREG.")</strong>"; }
					else { echo "<strong>(".$programe." ".$semstudentInfo[0]->SEMESTEROPENREG.")</strong>" ;}?>
                    </h4>
                   
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>SNo.</th>
                      <th>Student Name</th>
                      <th>Reg No</th>
                      <th>Programe</th>
                      <th>Nationality</th>
                      <th>Tracker Id</th>
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
                      <td align="center"><?php echo $record->STUDENTID ?></td>
                      <td><?php echo $record->CREATEDDTM ?></td>
                    
                    </tr>
                    <?php
                      $count++;  } 
					}
                  else{ 
					echo '<h4 style="color: red; text-align: center">No verified Record exists !</h4>';} ?>
                  </table>
				  
                </div><!-- /.box-body -->
                <br>
                <div class="box-footer clearfix">
                    <?php date_default_timezone_set('Asia/Karachi'); echo "<b>"."Report genrated through Hostel Software on: ".date("d-m-Y H:i:s")."</b>"; ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>

