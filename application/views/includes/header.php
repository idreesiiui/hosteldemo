<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- DataTables Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />     
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    
    <link href="<?php echo base_url(); ?>assets/plugins/datepickers/datepicker3.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url(); ?>assets/plugins/dataTables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/plugins/dataTables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />  

    <!-- Fav Icon Start-->
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url(); ?>uploads/fav/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url(); ?>uploads/fav/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>uploads/fav/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>uploads/fav/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>uploads/fav/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url(); ?>uploads/fav/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url(); ?>uploads/fav/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url(); ?>uploads/fav/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>uploads/fav/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url(); ?>uploads/fav/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>uploads/fav/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url(); ?>uploads/fav/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>uploads/fav/favicon-16x16.png">
        <link rel="manifest" href="<?php echo base_url(); ?>uploads/fav/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?php echo base_url(); ?>uploads/fav/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
     
    <!-- Fac icon End -->
    
	<style>
    	.error{
    		color:red;
    		font-weight: normal;
    	}
		#date_time{
			color:#fff;
			line-height:3.7;
			margin-left:30%;
			}
		@media (max-width: 768px) { 
		#date_time{
			margin-left:auto;
			}
		#signupForm{
			min-width: 50%;
    		max-width: 0%;
			}

		}
/*Jquery loader css */
/* This only works with JavaScript, 
if it's not present, don't show loader */
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url(<?php echo base_url(); ?>assets/images/Preloader_2.gif) center no-repeat #fff;
}
	.menu-green {
	background-color:#44c553;
	color:#fff;
}	
	.icon-green {
	color:#44c553;
}	
    </style>
    
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>
    <script type="text/javascript">
        var baseURL = "<?php echo base_url(); ?>";
    </script>
   
    <script type="text/javascript">
       function date_time(id)
{
        date = new Date;
        year = date.getFullYear();
        month = date.getMonth();
        months = new Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec');
        d = date.getDate();
        day = date.getDay();
        days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        h = date.getHours();
        if(h<10)
        {
                h = "0"+h;
        }
        m = date.getMinutes();
        if(m<10)
        {
                m = "0"+m;
        }
        s = date.getSeconds();
        if(s<10)
        {
                s = "0"+s;
        }
        result = ''+days[day]+', '+d+'-'+months[month]+'-'+year+', '+h+':'+m+':'+s;
        document.getElementById(id).innerHTML = result;
        setTimeout('date_time("'+id+'");','1000');
        return true;
}
    </script>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
     <script type="text/javascript">
//paste this code under the head tag or in a separate js file.
	// Wait for window load
	$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
	});
  </script>
  <script>
      $(document).ready(function() {
         $('#calendar').datepicker({
          autoclose: true,
          format: 'yyyy-mm-dd',
          todayHighlight: true,
          todayBtn: true
        });
     });
  </script> 
  </head>
  <body class="skin-green sidebar-mini">
  <?php
  $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
$this->output->set_header('Pragma: no-cache');
$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  
  ?>
  <!--Loader jquery-->
  <div class="se-pre-con"></div>
  <!-- Jquery loader End -->
    <div class="wrapper">
      
      <header class="main-header" >
        <!-- Logo -->
        <a href="<?php echo base_url(); ?>" class="logo" style="background-color:#44c553;color:#fff; padding-bottom:2px;">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><img src="<?php echo base_url(); ?>assets/dist/img/iiui.png" class="user-image" alt="User Image"/  style="float:left;"></span>
          <!-- logo for regular state and mobile devices -->
         <img src="<?php echo base_url(); ?>assets/dist/img/iiui.png" class="user-image" alt="User Image"/ style="float:left;"> <span class="logo-lg">Hostels Portal</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" style="background-color:#44c553;color:#fff;" role="navigation">
        <a id="date_time"></a>
            <script type="text/javascript">window.onload = date_time('date_time');</script>
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav" >
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu" >
              <?php 
			  $this->load->model('login_model');
			  $CI =& get_instance();
			  $studregno = $this->session->userdata('studregno');
			  $studpics = $CI->login_model->StudPic($studregno);
			  if(!empty($studpics))
			  $studpic = $studpics[0]->STUDPIC;
			  if(empty($studpics)) { ?>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" >
                  <img src="<?php echo base_url(); ?>assets/dist/img/avatar_<?php echo $gender; ?>.png" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo preg_replace('/\d+/u', '',$name); ?></span>
                </a>
                <?php }
				else {
				 ?>
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown" >
                 <?php
				  echo '<img src ="data:image/jpeg;base64,'.base64_encode($studpics[0]->STUDPIC).'" class="user-image" alt="User Image"/>';?>
                   <span class="hidden-xs"><?php echo preg_replace('/\d+/u', '',$name); ?></span>
                </a>
                <?php } ?>
                <ul class="dropdown-menu" >
                  <!-- User image -->
                   <?php if(empty($studpic)) { ?>
                  <li class="user-header" style="background-color:#44c553;color:#fff;">
                    <img src="<?php echo base_url(); ?>assets/dist/img/avatar_<?php echo $gender; ?>.png" class="img-circle" alt="User Image" />
                    <p>
                      <?php echo $name; ?>
                      <small><?php echo $role_text; ?></small>
                    </p>
                  </li>
                  <?php } else {?>
                   <li class="user-header" style="background-color:#44c553;color:#fff;">
                   <?php echo '<img src ="data:image/jpeg;base64,'.base64_encode($studpic).'" class="img-circle" alt="User Image"/>';?>
                    <p>
                      <?php echo $name; ?>
                      <small><?php echo $role_text; ?></small>
                    </p>
                  </li>
                  <?php } ?>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo base_url(); ?>profile" class="btn btn-success btn-flat" style="background-color:#44c553;color:#fff;border:#fff"><i class="fa fa-user-circle"></i> Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url(); ?>logout" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar"  style="background-color:#565656;">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" >
            <li class="header" style="background-color:#565656;color:#FFF;">MAIN NAVIGATION</li>
            <li class="treeview" >
              <a href="<?php echo base_url(); ?>dashboard">
                <i class="fa fa-dashboard icon-green"></i> <span style="color:#FFF;">Dashboard</span></i>
              </a>
            </li>
            <?php 
            if($role == ROLE_ADMIN || $role == ROLE_MANAGER || $role == ROLE_EMPLOYEE)
            {

            if($name == 'Muhammad Idrees'){
            ?>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>user/studentRecord">
                <i class="fa fa-building icon-green"></i>
                <span style="color:#FFF;">Registration No Update</span>
              </a>
            </li>
            <?php } ?>
            <li class="treeview">
              <a href="<?= base_url('add-remarks'); ?>">
                <i class="fa fa-bars icon-green"></i>
                <span style="color:#FFF;">Remakrs</span>
              </a>
            </li>

            
            <li class="treeview">
              <a href="<?php echo base_url(); ?>hostel/hostel/viewHostelDetail">
                <i class="fa fa-building icon-green"></i>
                <span style="color:#FFF;">Hostel</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url();?>room/Room/viewRoomDetail">
                <i class="fa fa-building-o icon-green"></i>
                <span style="color:#FFF;">Room</span>
              </a>
            </li>
             <li class="treeview">
              <a href="<?php echo base_url();?>seat/Seat/viewSeatDetail">
                <i class="fa fa-bed icon-green"></i>
                <span style="color:#FFF;">Seat</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url();?>allotmenthistory/Allotmenthistory/view">
                <i class="fa fa-clock-o icon-green"></i>
                <span style="color:#FFF;">Allotment History</span>
              </a>
            </li>
             <li class="treeview">
              <a href="<?php echo base_url();?>allotment/Allotment/view">
                <i class="fa fa-bars icon-green"></i>
                <span style="color:#FFF;">Allotment</span>
              </a>
            </li>
             <li class="treeview">
              <a href="<?php echo base_url();?>reallotment/ReAllotment/view">
                <i class="fa fa-bars icon-green"></i>
                <span style="color:#FFF;">Re-Allotment</span>
              </a>
            </li>
             <li class="treeview">
              <a href="<?php echo base_url();?>seatswap/interchange">
                <i class="fa fa-archive icon-green"></i>
                <span style="color:#FFF;">Seat Interchange</span>
              </a>
            </li>
             <li class="treeview">
              <a href="<?php echo base_url();?>attachment/Attachment/viewAttachmentDetail">
                <i class="fa fa-bars icon-green"></i>
                <span style="color:#FFF;">Attachment</span>
              </a>
            </li>
             <li class="treeview">
              <a href="<?php echo base_url();?>clearance/clearance/viewclearance">
                <i class="fa fa-bars icon-green"></i>
                <span style="color:#FFF;">Clearance</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url();?>blacklist/blacklist/blacklistdetail">
                <i class="fa fa-user-secret icon-green"></i>
                <span style="color:#FFF;">Black List</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url();?>visitor/Visitor/viewVisitorDetail">
                <i class="fa fa-bars icon-green"></i>
                <span style="color:#FFF;">Visitor</span>
              </a>
            </li>
            
             <li class="treeview">
              <a href="<?php echo base_url();?>semester/semester/viewsemesterDetail">
                <i class="fa fa-circle icon-green"></i>
                <span style="color:#FFF;">Semester</span>
              </a>
            </li>
            
           <?php }?>
           <?php
            if($role == ROLE_ADMIN || $role == ROLE_FEE || $role == ROLE_MANAGER)
            {
            ?>
             <li>
              <a href="#"><i class="fa fa-money icon-green"></i> <span style="color:#FFF;">Fee Management</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>feechallan/newfeechallan/feeStructureListing" style="color:#FFF;"><i class="fa fa-file icon-green"></i>New Fee Structure</a></li>
                <li><a href="<?php echo base_url();?>feechallan/newfeechallan/feeStructureHeadListing" style="color:#FFF;"><i class="fa fa-file icon-green"></i>Fee Structure Head</a></li>
                <li><a href="<?php echo base_url();?>feechallan/newfeechallan/newfeechallans" style="color:#FFF;"><i class="fa fa-file icon-green"></i>New Fee Challan</a></li>
                <li><a href="<?php echo base_url();?>feechallan/feechallan/viewAllFeechallan" style="color:#FFF;"><i class="fa fa-calculator icon-green"></i>Old Fee Challan</a></li>
                <!--<li><a href="<?php //echo base_url();?>feechallan/feechallan/ViewFeestucture" style="color:#FFF;"><i class="fa fa-file icon-green"></i>Fee Structure</a></li>
                <li><a href="<?php //echo base_url();?>feechallan/feechallan/viewAllFeechallan" style="color:#FFF;"><i class="fa fa-calculator icon-green"></i>Fee Challan Batch Wise</a></li>
                <li><a href="<?php //echo base_url();?>feechallan/feechallan/viewAllFeechallanregno" style="color:#FFF;"><i class="fa fa-calculator icon-green"></i>Fee Challan Regno</a></li>-->
              </ul>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url();?>report/reports">
                <i class="fa fa-files-o icon-green"></i>
                <span style="color:#FFF;">Reports</span>
              </a>
            </li>
            <?php
			}
			?>
            <?php
            if($role == ROLE_ADMIN || $role == ROLE_MANAGER)
            {
            ?>
            <li class="treeview">
              <a href="<?php echo base_url();?>setting/settings/">
                <i class="fa fa-thumb-tack icon-green"></i>
                <span style="color:#FFF;">System Settings</span>
              </a>
            </li>
            <?php
            }
			 if($role == ROLE_ADMIN || $role == ROLE_MANAGER || $role == ROLE_EMPLOYEE)
            {
            ?>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>card/Cards/viewCardsDetail">
                <i class="fa fa-credit-card icon-green"></i>
                <span style="color:#FFF;">Hostel Cards</span>
              </a>
            </li>
            <?php 
            if($role == ROLE_ADMIN )
            {
            ?>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>userListing">
                <i class="fa fa-users icon-green"></i>
                <span style="color:#FFF;">Users</span>
              </a>
            </li>
             <li class="treeview">
              <a href="<?= base_url();?>api/sendsms">
                <i class="fa fa-file-pdf-o icon-green"></i>
                <span style="color:#FFF;">Send Messages</span>
              </a>
            </li>
           
            <?php 
			}
			?>
            <?php
            }
            ?>
            <?php
			  $feestatus = $this->session->userdata('feestatus');

        //echo $feestatus;

        if($role == ROLE_STUDENT && $gender == 'Female'){ ?>

          <li class="treeview">
              <a href="http://192.168.20.248/iiui/leave?regno=<?php echo base64_encode($studregno); ?>">
                <i class="fa fa-history icon-green"></i>
                <span style="color:#FFF;">Apply for Leave</span>
              </a>
            </li>

       <?php }
		
            if($role == ROLE_STUDENT && (isset($feestatus) && $feestatus == 'HOSTEL RENEWAL FEE') || !isset($feestatus))
            {
				if($feestatus == 'HOSTEL RENEWAL FEE'){
					$feestatus = 'RENEWALHOSTELFEE';
				}
            ?>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>reallotment/reAllotment/studentreallotapply">
                <i class="fa fa-history icon-green"></i>
                <span style="color:#FFF;">Apply for ReNew Hostel Seat</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url();?>reallotment/reAllotment/RenewalForm">
                <i class="fa fa-bars icon-green"></i>
                <span style="color:#FFF;">ReNew Hostel Seat Form</span>
              </a>
            </li>
            <li class="treeview">
              <!--<a href="<?php //echo base_url();?>feechallan/Feechallan/viewFeeDetailByStudent">-->
               <a target="_blank" href="<?php echo base_url();?>feechallan/NewFeechallan/printAllotmentFeeChallanByRegno/<?php echo $feestatus;?>">
                <i class="fa fa-file-pdf-o icon-green"></i>
                <span style="color:#FFF;">ReNew Hostel Fee Challan</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url();?>seatswap/Interchange/Fseatchange">
                <i class="fa fa-bars icon-green"></i>
                <span style="color:#FFF;">Seat Change/Interchange</span>
              </a>
            </li>
            <li class="treeview">
            <a href="http://usis.iiu.edu.pk:64453/hostel/uploads/notifications/female/notifications/Notification-22042412" target="_blank" rel="noopener noreferrer">Available Seats For Seat Change</a>
            </li>
           <!--  <li class="treeview">
              <a href="<?php //echo base_url();?>assets/images/AVAILABLE_SEATS_FOR_SEAT_CHANGE_SPRING_2024.pdf" target="_blank" rel="noopener noreferrer">
                <i class="fa fa-upload icon-green"></i>
                <span style="color:#FFF;">Available Seats For Seat Change</span>
              </a>
            </li> -->
            <?php
            }
			elseif($role == ROLE_STUDENT || (isset($feestatus) && $feestatus == 'NEW HOSTEL FEE'))
            {
            ?>
            <li class="treeview">
              <!--<a href="<?php //echo base_url();?>feechallan/Feechallan/viewFeeDetailByStudent">-->
               <a target="_blank" href="<?php echo base_url();?>feechallan/NewFeechallan/printAllotmentFeeChallanByRegno/<?php echo 'NEWHOSTELFEE'?>">
                <i class="fa fa-file-pdf-o icon-green"></i>
                <span style="color:#FFF;">Allotment Fee Challan</span>
              </a>
            </li>
            <?php
			}
			?>
            <?php
            if($role == ROLE_WARDEN)
            {
            ?>

            <?php
            if($gender === 'Female')
            {
            ?>

            <li class="treeview">
              <a href="<?php echo base_url();?>clearance/Clearance/viewClearanceDetail">
                <i class="fa fa-bars icon-green"></i>
                <span style="color:#FFF;">Clearance</span>
              </a>
            </li>
          <?php } ?>
            <li class="treeview">
              <a href="<?php echo base_url();?>reallotment/ReAllotment/view">
                <i class="fa fa-bars icon-green"></i>
                <span style="color:#FFF;">Re-Allotment</span>
              </a>
            </li>
            <!-- 
            <li class="treeview">
            <a href="<?php //echo base_url();?>feechallan/feechallan/viewAllFeechallan" style="color:#FFF;">
            <i class="fa fa-calculator icon-green"></i>Fee Challan Batch Wise</a></li> -->
            <?php
            if($gender === 'Female')
            {
            ?>
            <li class="treeview">
              <a href="<?php echo base_url() ?>report/reports/getallStInfo">
                <i class="fa fa-bars icon-green"></i>
                <span style="color:#FFF;">SIS</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url() ?>report/reports/getallstudentsearch">
                <i class="fa fa-search icon-green"></i>
                <span style="color:#FFF;">Search Student</span>
              </a>
            </li>
             <?php
           }
            }

            if($role == ALW && $role != ROLE_STUDENT){
            ?>
            <li class="treeview">
              <a href="<?php echo base_url();?>visitor/Visitor/viewVisitorDetail">
                <i class="fa fa-bars icon-green"></i>
                <span style="color:#FFF;">Visitor</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url();?>students_contact_info">
                <i class="fa fa-bars icon-green"></i>
                <span style="color:#FFF;">Students Contact Info</span>
              </a>
            </li>
          <?php } ?>

          <?php if($role == ROLE_WARDEN && $name == 'Umar (hostel)'){ ?>
            <li class="treeview">
              <a href="<?php echo base_url();?>clearance/Clearance/viewClearanceDetail">
                <i class="fa fa-bars icon-green"></i>
                <span style="color:#FFF;">Clearance</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url();?>allotmenthistory/Allotmenthistory/view">
                <i class="fa fa-clock-o icon-green"></i>
                <span style="color:#FFF;">Allotment History</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?= base_url('add-remarks'); ?>">
                <i class="fa fa-bars icon-green"></i>
                <span style="color:#FFF;">Add Remakrs</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url() ?>report/reports/getallstudentsearch">
                <i class="fa fa-search icon-green"></i>
                <span style="color:#FFF;">Search Student</span>
              </a>
            </li>
          <?php } ?>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>