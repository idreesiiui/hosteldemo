<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>IIUI Hostel Cards</title>
<style>
.pagebreak { page-break-after: always; }
.card-main-class{
	margin:30px 70px;
	width:383px;
	float:left;
	}
.card-main-class-back{
	margin:30px 70px;
	width:383px;
	float:left;
	}	
@media print
{    

.card-main-class-back{
	margin:95px 52px;
	width:383px;
	float:left;
	height:250px;
	}
.card-main-class{
	margin:90px 40px;
	width:383px;
	float:left;
	height:250px;
	}
	
    .no-print, .no-print *
    {
        display: none !important;
		
    }
	.pagebreak { page-break-after: always; }
	
}
</style>
</head>

<body>

<button onclick="myFunction()" class="no-print" style=" 
border: 1px solid black;padding: 8px 15px;text-align: center;text-decoration: none;font-size: 16px;margin: 4px 2px;cursor: pointer; position: absolute;
    right: 13em;"><img src="<?php echo base_url() ?>/assets/images/print.png" width=30 height=30 style="position: relative; top: 1px;left: -8px;margin-bottom: -7px;" >Print</button>
   
<?php 
//$blobimg = $viewcardsPic[0]->STUDPIC;
//$cardregno = $viewcardsPic[0]->REGNO;
//print_r($viewcardsPic);
//header('Content-type: image/jpeg');
//echo '<img src ="data:image/jpeg;base64,'.base64_encode($blobimg).'"/>';
//exit();
?>
<?php if(!empty($viewcardsInfo)) {
	//$cardregno = $viewcardsPic[0]->STUDPIC;
	 //echo '<img src ="data:image/jpeg;base64,'.base64_encode($cardregno).'" style="margin-left: 74%;margin-top: -20%;" width=78 height=78 border=0/>';
	//$count = count($viewcardsInfo);
	
	
$count = count($viewcardsInfo);
	//echo $viewcardsInfo[1];
	//print_r($viewcardsInfo);
	 //exit;
foreach($viewcardsInfo as $key => $viewcard )
{   //$i++;
	//echo $viewcard->REGNO;
	//$regno = $viewcard->REGNO;
	//$cardregno = $viewcardsPic[$i]->REGNO;
	//$blobimg = $viewcardsPic[0]->STUDPIC;
	//echo "Reh no:".$viewcard['reg'];
	//print_r($viewcard);
	//exit;
	$blobimg = $viewcard['pic'];
?>
<!--<?php //echo base_url() ?>/uploads/image/bgpic.jpg-->


<div style="width:100%;">
<div   class="card-main-class">
    <img src="<?php echo base_url() ?>/uploads/image/wbgpic.jpg" class="responsive-image" width="402" height="247" border=1>
    <div style="font:bold italic 9pt Arial;color:#000000;margin-top:-42%; margin-left:20%"><?php echo $viewcard['name']?></div>
 <?php echo '<img src ="data:image/jpeg;base64,'.base64_encode($blobimg).'" style="margin-left: 81%;margin-top: -20%;" width=78 height=78 border=0/>';?>
   
    <div style="font:bold italic 9pt Arial;color:#000000; margin-top:-3%; margin-left:32%"><?php echo $viewcard['fathername']?></div>
    <div style="font:bold italic 9pt Arial;color:#000000; margin-top:1.4%; margin-left:20%"><?php echo $viewcard['reg']?></div>
    <div style="font:bold italic 9pt Arial;color:#000000; margin-top:3%; margin-left:36%"><?php echo $viewcard['roomdesc'].'-'.$viewcard['seat'].'/'.$viewcard['hosteldesc']?></div>
    <div style="font:bold italic 9pt Arial;color:#000000; margin-top:1.5%; margin-left:23%"><?php echo $viewcard['issuedate']?></div>
    <div style="font:bold italic 9pt Arial;color:#000000; margin-top:3%; margin-left:23%"><?php   echo $viewcard['expdate']?></div>

</div>

<?php
	 
   }
}
?>
<div class="pagebreak" style="clear:both;" > </div>
<?php 

for($i = 0; $i<$count; $i++) { ?>
<div  class="card-main-class-back">
    <img src="<?php echo base_url() ?>/uploads/image/backside.jpg" class="responsive-image" width="402" height="247" border=1>
    
</div>

<?php } ?>


</body>
<script>
function myFunction() {
    window.print();
}
</script>
</html>