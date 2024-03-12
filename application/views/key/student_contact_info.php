<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Student Contact Info Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
       <section class="content">
        
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Student Registration Number</h3>
                    
                    
                    <form class="form-horizontal" method="post" action="<?php echo base_url() ?>key/key/get_student_contact_info" >
              <div class="box-body">
                <div class="form-group">
                  <label style="width:80px" for="text" class="col-sm-2 control-label">Reg No</label>

                  <div class="col-sm-3">
                   <input type="text" class="form-control" name="regno">
                  </div>
                  
                 
                <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit"/>
                <input type="reset" class="btn btn-secondary" value="Reset"/>
                </div>
             </form>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
    <section class="content">
        <!-- <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php //echo base_url(); ?>room/room/addNew">Add New</a>
                </div>
            </div>
        </div> -->
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Student Contact Info</h3>
                    
                </div><!-- /.box-header -->
                <div class="box-body">
              <table id="roomDetail" class="table table-bordered table-striped">
              <thead>
              <tr>
                      <th>S.No</th>
                      <th>Student Name</th>
                      <th>Registration No</th>
                      <th>Gender</th>
                      <th>CNIC</th>
                      <th>Email</th>
                      <th>Actions</th>
                    </tr>
                   </thead>
                   <tbody>
                    <?php
                    if(!empty($from_student_contact_info))
                    {
                        $sno = 1;
                        foreach($from_student_contact_info as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $sno; ?></td>
                      <td><?php echo $record->student_name; ?></td>
                        <td><?php echo $record->regno; ?></td>
                      <td><?php echo $record->gender; ?></td>
                      <td><?php echo $record->cnic; ?></td>
                      <td><?php echo $record->student_email; ?></td>
                      <td>
                          <!-- <a href="<?php //echo base_url().'key/key/update_contact_info/'.$record->id; ?>"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;</a> -->
                          <!-- <a href="#" data-semid="<?php //echo $record->ID; ?>" class="deleteSemester"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;</a> -->
                      </td>
                    </tr>
                    <?php
                    $sno++;
                        }
                    }
                    else if(!empty($from_tbl_hstd)){
                        $sno = 1;
                        foreach($from_tbl_hstd as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $sno; ?></td>
                      <td><?php echo $record->STUDENTNAME; ?></td>
                        <td><?php echo $record->REGNO; ?></td>
                      <td><?php echo $record->GENDER; ?></td>
                      <td><?php echo $record->CNIC; ?></td>
                      <td><?php echo $record->STUDENTEMAIL; ?></td>
                      <td>
                          <a href="<?php echo base_url().'key/key/insert_contact_info/'.base64_encode($record->REGNO); ?>"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;</a>
                          <!-- <a href="#" data-semid="<?php echo $record->ID; ?>" class="deleteSemester"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;</a> -->
                      </td>
                    </tr>
                    <?php
                    $sno++;
                        }

                    }?>
                    </tbody>
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

        var table = $('#roomDetail').DataTable( {
        lengthChange: false,
        "scrollX": false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
        aLengthMenu: [[50, 25, 100, 150, 500, -1], [50, 25, 100, 150, 500, "All"]]
    } );
         table.buttons().container().appendTo( '#roomDetail_wrapper .col-sm-6:eq(0)' );
    });
</script>
