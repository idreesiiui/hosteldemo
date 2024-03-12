<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Semester Wise Students Allotment and Reallotment Detail        
      </h1>
     
    </section>
    <!--<section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php //echo base_url(); ?>addNew">Add New</a>
                </div>
            </div>
        </div>-->
        <?php $semesters = array('SPR-2023','FALL-2022','SUM-2022','SPR-2022','FALL-2021','SPR-2021','FALL-2020','SPR-2020','FALL-2019','SPR-2019','FALL-2018','FALL-2017','SPR-2018','SPR-2017','FALL-2016','SPR-2016'); 

        for($i = 0; $i <= 7; $i++){
        ?>



        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3>Allotment Detail <?= $semesters[$i]; ?></h3>
                   <div class="row">

                    <?php //var_dump($reallotment); ?>
                    <?php //var_dump($allotment); ?>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="ion-ios-people-outline"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Allotment</span>
          <span class="info-box-number"><?php echo $allotment[$i]; ?></span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div><!-- /.col -->


    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Reallotment</span>
          <span class="info-box-number"><?php echo $reallotment[$i]; ?></span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div><!-- /.col -->
   
    
  </div>
              
                            
                 
                </div><!-- /.box-header -->
            
				
                 
                  
                  
                  
                  <div id="feedback" style="color:green"></div>
                  
               
              </div><!-- /.box -->
            </div>
        </div>

<?php } ?>


    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/reportallot.js" charset="utf-8"></script>
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
