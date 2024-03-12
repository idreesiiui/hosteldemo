<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>IIUI Hostel Cards</title>

</head>

<body>

<?php if(!empty($viewcardsInfo)) {
	$count = count($viewcardsInfo);
	//echo count($viewcardsInfo);exit();
	
foreach($viewcardsInfo as $key => $viewcard )
{
	//echo $viewcard['id'];
//}
	//exit();
?>
<?php if($viewcard['gender'] == 'Female') {?>
<div style="position:relative; top:0.0pt;left:0.0pt; width:247.5pt;height:157.5pt; "><img src="<?php echo base_url() ?>/uploads/image/bgpic2.jpg" width=430 height=311 border=0"> </div>
<?php 
}
elseif($viewcard['gender'] == 'Male') {?>
<div style="position:relative; top:-6pt;left:-6pt; width:247.5pt;height:157.5pt; "><img src="<?php echo base_url() ?>/uploads/image/bgpic1.jpg" width="500" border=0"> </div>
<?php } ?>
<div style="position:fixed;top:7pt;left:3pt; color:#fff;"><img src="<?php echo base_url() ?>/uploads/image/iiui.png" width=40 height=35 border=0"></div>
<div style="position:fixed;top:10pt;left:37pt; color:#fff;font:bold 15pt Arial;">International Islamic University, Islamabad</div>
<div style="position:fixed;top:27pt;left:115pt; color:#fff;font:bold italic 14pt Arial">Office of <?php echo $viewcard['gender'] ?> Provost</div>
<div style="position:fixed;top:46pt;left:297pt; text-decoration:underline;" id=f2>ID:<?php echo $viewcard['id'] ?></div>
<style>#f1{font:bold 6pt Verdana;color:#fff;}</style>
<!--<div style="position:fixed;top: 30pt;left: 85pt;font-size: 14px;" id=f1>Girls Hostel</div>-->
<style>#f2{font:bold italic 14pt Arial;color:#fff;}</style>
<div style="position:fixed;top:53pt;left:10pt; color:#000000;" id=f2>Name</div>
<div style="position:fixed;top:53pt;left:50pt" id=f2><?php echo $viewcard['name']?></div>

<?php 
    // }
?>

<?php
   }
}
?>



</body>
<!--<script>
function myFunction() {
    window.print();
}
</script>-->
</html>