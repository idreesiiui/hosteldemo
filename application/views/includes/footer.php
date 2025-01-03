

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>IIUI</b> Hostel Web Portal | Version 3.0
        </div>
        <strong>Copyright &copy; 2016-<?= date('Y'); ?> <a href="<?php echo base_url(); ?>">IIUI</a>.</strong> All rights reserved.
    </footer>
    
    <!-- jQuery UI 1.11.2 -->
    <!-- <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script> -->
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 3.3.2 JS -->
     <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
     <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
	 <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>  
     <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>  
     <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>  
     <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap.min.js"></script>  
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>  
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>  
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>  
     <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>  
     <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> 
     <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
     <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js" type="text/javascript"></script>
     <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
     <script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>
     <script src="<?php echo base_url(); ?>assets/js/semester.js" type="text/javascript"></script>
     <script src="<?php echo base_url(); ?>assets/plugins/select2/dist/js/select2.full.min.js" ></script>
     <script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    
    <script type="text/javascript">    
    $(document).ready(function() {
    var table = $('#example1').DataTable( {
        lengthChange: true,
		"scrollX": true,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
		aLengthMenu: [[50, 25, 100, 150, 500, -1], [50, 25, 100, 150, 500, "All"]]
    } );
	
	table.buttons().container()
        .appendTo( '#example1_wrapper .col-sm-6:eq(0)' );
	
	var table = $('#example2').DataTable( {
        lengthChange: true,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
		aLengthMenu: [[5000, 25, 100, 150, 500, -1], [5000, 25, 100, 150, 500, "All"]]
    } );
 
    table.buttons().container()
        .appendTo( '#example2_wrapper .col-sm-6:eq(0)' );
} );

 </script>

    
    <script>
  $(function () {
    $("#example3").DataTable();
    $('#example').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
	  "aLengthMenu": [[10, 25, 50,100,500, -1], [10, 25, 50,100,500, "All"]]
    });
  });
</script>
 
    <!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- / DataTables -->
    <script type="text/javascript">
        var windowURL = window.location.href;
        pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
        var x= $('a[href="'+pageURL+'"]');
            x.addClass('active');
            x.parent().addClass('active');
        var y= $('a[href="'+windowURL+'"]');
            y.addClass('active');
            y.parent().addClass('active');
    </script>
    
  </body>
</html>