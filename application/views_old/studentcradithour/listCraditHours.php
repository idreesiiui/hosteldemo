<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Cradit Hours Management
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                <a style="float:left !important" class="btn btn-default" href="<?php echo base_url(); ?>studentCraditHour/studentCraditHour">Back</a>
                   
                    <div class="col-md-6">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>                      

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Course Credit Hour List</h3>
                </div><!-- /.box-header -->
            <div class="box-body">
              <table id="studentCraditHours" class="table table-bordered table-striped">
                 <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Reg No</th>
                      <th>Semester</th>
                      <th>Course Name</th>
                      <th>Cradit Hours</th>
                    </tr>
              </thead>
                    <?php 
                    if(!empty($studentCraditHours))
                    {
						$sno = 1;
                        foreach($studentCraditHours as $record)
                        {
                    ?>
                    <tr>
                      <td> <?php echo $sno; ?> </td>
                      <td> <?php echo $record['REGNO']; ?> </td>
                      <td> <?php echo $record['SEMCODE'] ?> </td>
                      <td> <?php echo $record['COURSENAME'] ?> </td>
                      <td> <?php echo $record['CREDITHRS'] ?> </td>
                      
                    </tr>
                    <?php
					$sno++;
                        }
                    }
					else
						 echo '<h4 style="color: red; text-align: center">No Record exist in database!</h4>';
                    ?>
                  </table>
                  <h4>Total Credit Hours: <?php echo $studentTotalCraditHours; ?></h4>
                  
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        // jQuery('ul.pagination li a').click(function (e) {
        //     e.preventDefault();            
        //     var link = jQuery(this).get(0).href;            
        //     var value = link.substring(link.lastIndexOf('/') + 1);
        //     jQuery("#searchList").attr("action", baseURL + "userListing/" + value);
        //     jQuery("#searchList").submit();
        // });

        var table = $('#studentCraditHours').DataTable( {
                lengthChange: false,
                "scrollX": false,
                buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
                aLengthMenu: [[50, 25, 100, 150, 500, -1], [50, 25, 100, 150, 500, "All"]]
            } );
        table.buttons().container().appendTo( '#studentCraditHours_wrapper .col-sm-6:eq(0)' );

    });
</script>
