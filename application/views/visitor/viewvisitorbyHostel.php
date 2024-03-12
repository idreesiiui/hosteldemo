<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Visitor Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
              <div class="form-group">
                <?php if(!empty($viewallotments)){
				$hostelid =  $viewallotments[0]->HOSTELID;?>
                    <!--<a class="btn btn-primary" href="<?php //echo base_url(); ?>visitor/Visitor/viewHostelVisitor/<?php //echo $hostelid?>">View Visitor Details</a>-->
                
                    <?php } ?>
                </div>  
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Visitors List</h3>
                    <h4 class="col-xs-12 text-center" style="text-decoration:underline;"><b><?php echo $viewallotments[0]->HOSTELDESC.' ('.$viewallotments[0]->HOSTEL_NO.')';?></b></h4>
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php 
				$hostel = $this->uri->segment('4');
				
					//if(empty($viewallotments[0]->VNAME))
					//echo '<h4 style="color: red; text-align: center">No Visitors Existed agaisnt given RegNo </h4>';?>
              <table id="example1" class="table table-bordered table-striped">
              <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Reg No</th>
                      <th>STUDENT NAME</th>
                      <th>FATHER NAME</th>
                      <th>FATHER NO</th>
                      <th>VISITOR NAME</th>
                      <th>VISITOR NO</th>
                     <!-- <th>VISITOR NAME2</th>
                      <th>VISITOR NO2</th>-->
                      <th>Room No</th>
                      <th>SEAT</th>
                      <th>ADDRESS</th>
                      <th>PAYMENT</th>
                      <th>NATIONALITY</th>
                      <th>Status</th>
                    </tr>
              </thead>
                    <?php
                    if(!empty($viewallotments))
                    {
						$sno = 1;
                        foreach($viewallotments as $key=>$record)
                        { 
							
                    ?>
                    <tr>
                      <td><?php echo $sno ?></td>
                      <td><?php echo $record->REGNO ?></td>
                      <td><?php echo $record->NAME ?></td>
                      <td><?php echo $record->FNAME ?></td>
                      <td><?php
					         $regno = $record->REGNO; $gender = $record->GENDER;
					         $CI =& get_instance();
							 $fnumber = $CI->visitor_model->StudAppInfo($regno, $gender);
							 $visitor = $CI->visitor_model->VisitorInfo($regno, $gender); 
							 if($visitor[0]->REGNO)  
							   {	
								  echo $visitor[0]->CONTACTNO; 
							   }
							 elseif($fnumber[0]->FATHERNUMBER) 
								{
								  echo $fnumber[0]->FATHERNUMBER;
								}
							?></td>
                      <td><?php if($visitor[0]->REGNO) echo $visitor[0]->VNAME2; elseif($fnumber[0]->EPERSONNAME) echo $fnumber[0]->EPERSONNAME; ?></td>
                      <td><?php if($visitor[0]->REGNO) echo $visitor[0]->CONTACTNO2; elseif($fnumber[0]->EPERSONNUMBER) echo $fnumber[0]->EPERSONNUMBER;  ?></td>
                      <!--<td><?php //if($visitor[0]->REGNO) echo $visitor[0]->VNAME2 ?></td>
                      <td><?php //if($visitor[0]->REGNO) echo $visitor[0]->CONTACTNO2 ?></td>-->
                      <td><?php echo $record->ROOMDESC ?></td>
                      <td><?php echo $record->SEAT ?></td>
                      <td><?php echo $record->ADDRESS ?></td>
                      <td><?php echo $record->SEATSTATUS ?></td>
                      <td><?php echo $record->NATIONALITY ?></td>
                      <td>
                    <?php  if(empty($hostel)) {?>
                    
                          <a href="<?php echo base_url().'visitor/Visitor/addNewHostel/'.base64_encode($record->REGNO); ?>" target="_blank"><i class="fa fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;</a>
                          <!--<a href="#" data-allotid="<?php //echo $record->VISITORID; ?>" class="deleteAllotment"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;</a>-->
                      
                      <?php 
					  }
					  else
					  {
						  ?>
						<a href="<?php echo base_url().'visitor/Visitor/editOld/'.$record->VISITORID; ?>"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;</a>  
					 <?php }
					  ?>
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

