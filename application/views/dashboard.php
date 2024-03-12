<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
    </section>
    
    <section class="content">
    <?php 
             if($role == ROLE_ADMIN || $role == ROLE_MANAGER || $role == ROLE_EMPLOYEE)
            {
            ?>
        <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $totalapplication; ?></h3>
                  <p>Total No. of Application</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
                <a href="<?php echo base_url() ?>report/reports/reportListing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $verifyapplication; ?><sup style="font-size: 20px"></sup></h3>
                  <p>Verified Applications</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?php echo base_url() ?>report/reports/reportListing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $pendingapplication; ?></h3>
                  <p>Pending Application</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
                <a href="<?php echo base_url() ?>report/reports/reportListing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $cancelapplication; ?></h3>
                  <p>Cancel Application</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="<?php echo base_url() ?>report/reports/reportListing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div>

          <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-black"><i class="fa fa-building"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">No.of Hostel</span>
              <span class="info-box-number"><?php echo $totalhostel; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-orange"><i class="fa fa-building-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">NO. OF ROOM</span>
              <span class="info-box-number"><?php echo $totalroom; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-bed"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><b style="font-size:8px">Vaccant Seat</b> / NO. OF SEAT</span>
              <span class="info-box-number"><?php echo '<b style="color:green">'.$totalvseat.'</b>'.' / '.'<b style="color:black">'.$totalseat.'</b>'?></span><small>Occupied Seats <?php echo '<b style="color:red">'.$totaloseat.'</b>'?></small>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-purple"><i class="fa fa-key"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">NO.OF  ROOM ITEMS</span>
              <span class="info-box-number"><?php echo $totalitem; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">TOTAL ALLOTMENT</span>
              <span class="info-box-number"><?php echo $totalallotment; ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: <?php 
                echo number_format(($totalallotment/$totalseat)*100, 2);
                ?>%">
                
              </div>
              </div>
                  <span class="progress-description">
                    <?php echo number_format(($totalallotment/$totalseat)*100, 2); ?>% Progress 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">VERIFIED ALLOTMENT</span>
              <span class="info-box-number"><?php echo $verifyallotment ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 
                <?php if($verifyallotment > 0){

                  echo number_format(($verifyallotment/$totalallotment)*100, 2); 
                }

                ?>%">
                
              </div>
              </div>
                  <span class="progress-description">
                    <?php if($verifyallotment > 0)echo number_format(($verifyallotment/$totalallotment)*100, 2) ?>% Progress 30 Days</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">PENDING ALLOTMNET</span>
              <span class="info-box-number"><?php echo $pendingallotment; ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: <?php if($pendingallotment > 0)echo number_format(($pendingallotment/$totalallotment)*100, 2)?>%"></div>
              </div>
                  <span class="progress-description">
                    <?php if($pendingallotment > 0)echo number_format(($pendingallotment/$totalallotment)*100, 2)?>% Progress 30 Day</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-thumbs-o-down"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">CANCEL ALLOTMENT</span>
              <span class="info-box-number"><?php echo $cancelallotment; ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: <?php 
                if($cancelallotment > 0){
                  echo number_format(($cancelallotment/$totalallotment)*100, 2);
                }
              ?>%"></div>
              </div>
                  <span class="progress-description">
                    <?php 
                    if($cancelallotment > 0){
                      echo number_format(($cancelallotment/$totalallotment)*100, 2);
                    }
                  ?>% Progress 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- Reallotment start -->
      
            <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">TOTAL REALLOTMENT</span>
              <span class="info-box-number"><?php echo $totalreallotment; ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: <?php 
                if($totalreallotment > 0){
                  echo number_format(($totalreallotment/$totalseat)*100, 2);
                }
              ?>%"></div>
              </div>
                  <span class="progress-description">
                    <?php 
                    if($totalreallotment > 0){
                    echo number_format(($totalreallotment/$totalseat)*100, 2);
                  }
                ?>% Progress 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">VERIFIED REALLOTMENT</span>
              <span class="info-box-number"><?php echo $verifyreallotment; ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: <?php if($verifyreallotment > 0)echo number_format(($verifyreallotment/$totalreallotment)*100, 2)?>%"></div>
              </div>
                  <span class="progress-description">
                    <?php 
                    if($verifyreallotment > 0){
                      echo number_format(($verifyreallotment/$totalreallotment)*100, 2);
                    }
                  ?>% Progress 30 Days</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">PENDING REALLOTMNET</span>
              <span class="info-box-number"><?php echo $pendingreallotment; ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: <?php 
                if($pendingreallotment > 0){
                  echo number_format(($pendingreallotment/$totalreallotment)*100, 2);
                }
              ?>%"></div>
              </div>
                  <span class="progress-description">
                    <?php 
                    if($pendingreallotment > 0){
                      echo number_format(($pendingreallotment/$totalreallotment)*100, 2);
                    }
                  ?>% Progress 30 Day</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-thumbs-o-down"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">CANCEL REALLOTMENT</span>
              <span class="info-box-number"><?php echo $cancelreallotment; ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: <?php 
                if($cancelreallotment > 0){
                  echo number_format(($cancelreallotment/$totalreallotment)*100, 2);
                }
            ?>%"></div>
              </div>
                  <span class="progress-description">
                    <?php if($cancelreallotment > 0){
                      echo number_format(($cancelreallotment/$totalreallotment)*100, 2);
                    }
                  ?>% Progress 30 Days
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      
      
      <!-- Reallotment End -->
       <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $totalallotment + $totalreallotment; ?></h3>
                  <p>Total No. of Border Students</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $totaldefault; ?><sup style="font-size: 20px"></sup></h3>
                  <p>Total No. of Defaulter Students</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
                <a href="<?php echo base_url()?>report/reports/allallot" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $totalclearance; ?></h3>
                  <p>Total No. of Clearance</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
                <a href="<?php echo base_url()?>clearance/Clearance/viewClearanceDetail" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $totalblacklist; ?></h3>
                  <p>Total No. of Blacklist</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
                <a href="<?php echo base_url()?>blacklist/blacklist/blacklistdetail" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div> 
      
          <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Quick Links</h3>
                </div>
                <div class="box-body">
                 
                                        <a class="btn btn-app" href="<?php echo base_url() ?>hostel/hostel/viewHostelDetail">
                        <i class="fa fa-building-o"></i> Hostels                    </a>
                                        <a class="btn btn-app" href="<?php echo base_url() ?>room/Room/viewRoomDetail">
                        <i class="fa fa-building"></i> Rooms                    </a>
                                        <a class="btn btn-app" href="<?php echo base_url() ?>seat/Seat/viewSeatDetail">
                        <i class="fa fa-th"></i> Seats                    </a>
                    <a class="btn btn-app" href="<?php echo base_url() ?>allotment/Allotment/view">
                        <!-- <span class="badge bg-yellow">1</span> -->
                        <i class="fa fa-bell-o"></i> Allotment                   </a>
                                        <a class="btn btn-app" href="<?php echo base_url() ?>reallotment/ReAllotment/viewreAllotmentDetail">
                        <i class="fa fa-folder-open"></i> Re-Allotment                    </a>
                    <a class="btn btn-app" href="<?php echo base_url() ?>attachment/Attachment/viewAttachmentDetail">
                        <i class="fa fa-star-o"></i> Attachment                   </a>
                    <a class="btn btn-app" href="<?php echo base_url() ?>clearance/Clearance/viewClearanceDetail">
                        <i class="fa fa-bar-chart-o"></i> Clearance                    </a>
                                        <a class="btn btn-app" href="<?php echo base_url() ?>visitor/Visitor/viewVisitorDetail">
                        <i class="fa fa-users"></i> Visitors                   </a>
                    <a class="btn btn-app" href="<?php echo base_url() ?>setting/settings/">
                        <i class=" fa fa-cogs"></i> System settings             </a>
                         <a class="btn btn-app" href="<?php echo base_url() ?>feechallan/Feechallan/viewfeeDetail">
                        <i class="fa fa-file-pdf-o"></i> Fee Challan              </a>
                    <a class="btn btn-app" href="<?php echo base_url() ?>semester/semester/viewsemesterDetail">

                        <i class="fa fa-reorder"></i> Semester                    </a>
                    <?php if($role == ROLE_ADMIN){ ?>
                    <a class="btn btn-app" href="<?php echo base_url() ?>userListing">
                        <i class="fa fa-user"></i> User
                      </a>
                     <?php } ?>    
                    <a class="btn btn-app" href="<?php echo base_url() ?>freallot/reallotbyAdmin">
                        <i class="fa fa-users"></i> Student Re Allotment                   </a>
                        
                        <a class="btn btn-app" href="<?php echo base_url() ?>seatswap/interchange">
                        <i class="fa fa-archive"></i>Seat Interchange </a>
                        
                         <a class="btn btn-app" href="<?php echo base_url() ?>card/Cards/viewCardsDetail">
                        <i class="fa fa-credit-card"></i> Hostel Cards                   </a>
                        
                        <a class="btn btn-app" href="<?php echo base_url() ?>blacklist/blacklist/blacklistdetail">
                        <i class="fa fa-user-secret"></i> Black list Users                   </a>

                                        <a class="btn btn-app" href="<?php echo base_url() ?>report/reports">
                        <i class="fa  fa-file"></i> Reports                   </a>
                                    </div>
         
                     
                   <?php }
				   elseif($role == ROLE_STUDENT)
				   { 
					  if($role == ROLE_STUDENT)
				   {
				   ?>
                   <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Quick Links</h3>
                </div>
                 <div class="box-body">
                 
                        <?php 
						$feestatus = $this->session->userdata('feestatus');
						     
						if(isset($feestatus) && ($feestatus == 'NEW HOSTEL FEE' || $feestatus == 'HOSTEL SECURITY'))
						{ ?>
                        <a target="_blank" class="btn btn-app" href="<?php echo base_url();?>feechallan/NewFeechallan/printAllotmentFeeChallanByRegno/<?php echo 'NEWHOSTELFEE'?>">
                        <i class="fa  fa-money"></i> Fee challan </a>
                        <?php 
						} 
						elseif((isset($feestatus) && $feestatus == 'HOSTEL RENEWAL FEE') || !isset($feestatus)){ 
						if($feestatus == 'HOSTEL RENEWAL FEE'){
							$feestatus = 'RENEWALHOSTELFEE';
						}
						?>
                        
                        <a class="btn btn-app" href="<?php echo base_url() ?>reallotment/reAllotment/studentreallotapply">
                        <i class="fa  fa-history"></i> Apply for ReNew Hostel Seat </a>
                        <!--<a class="btn btn-app" href="<?php //echo base_url() ?>report/reports/studentallotByName">
                        <i class="fa  fa-file"></i> Student Allotment Slip Download </a>-->
                        <a class="btn btn-app" href="<?php echo base_url() ?>seatswap/Interchange/Fseatchange">
                        <i class="fa  fa-bars"></i> Seat Change / Interchange </a>
                        <a class="btn btn-app" target="_blank" href="<?php echo base_url();?>feechallan/NewFeechallan/printAllotmentFeeChallanByRegno/<?php echo $feestatus;?>">
                        <i class="fa  fa-money"></i> ReNew Hostel Fee Challan </a>
                        <!-- <a class="btn btn-app" href="<?php //echo base_url() ?>report/reports/uploadChallane">
                        <i class="fa  fa-upload"></i> Upload Fee Challane Slip </a>-->
                        
						<?php
						     
						}
						?>

                   </div>
                           
                <?php 
				}
				elseif($role == ROLE_STUDENT && $studtype == 0)
				   {
				?>
                <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Quick Links</h3>
                </div>
                 <div class="box-body">
                 
                                        
                        <a class="btn btn-app" href="<?php echo base_url();?>feechallan/Feechallan/viewFeeChallanByStud">
                        <i class="fa  fa-money"></i> Fee challan </a>
                         

                                    </div>
                 <?php
				     }
				   }
                 elseif($role == ROLE_WARDEN)
				   {
					   
				   ?>
                   <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Quick Links</h3>
                </div>
                 <div class="box-body">
                 
                                        <a class="btn btn-app" href="<?php echo base_url() ?>clearance/Clearance/viewClearanceDetail">
                        <i class="fa fa-bar-chart-o"></i> Clearance                    </a>
                         <a class="btn btn-app" href="<?php echo base_url() ?>report/reports/getallStInfo">
                        <i class="fa fa-bars"></i>Student Information System (SIS)</a>
                       

                                    </div>
                           
                <?php } 
                 elseif($role == ROLE_FEE)
				   {
					   
				   ?>
                   <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Quick Links</h3>
                </div>
                 <div class="box-body">
                 
                                        
                         <a class="btn btn-app" href="<?php echo base_url() ?>report/reports/getallStInfo">
                        <i class="fa fa-bars"></i>Student Information System (SIS)</a>
                       <a class="btn btn-app" href="<?php echo base_url() ?>report/reports">
                        <i class="fa  fa-file"></i> Reports                   </a>

                                    </div>
                           
                <?php } ?>
              
            </div>
    </section>
</div>
