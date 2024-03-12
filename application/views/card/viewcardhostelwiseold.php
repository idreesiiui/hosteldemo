<style>
.pagebreak { page-break-before: always; }
</style>


<?php if(!empty($viewcardsInfo)) {
	
	
foreach($viewcardsInfo as $viewcard )
{
?>

<span style="position: relative; top:0.0pt;left:0.0pt; width:247.5pt;height:157.5pt; "><img src="<?php echo base_url() ?>/uploads/image/bgpic.jpg" width=330 height=210 border=0"> </span>
<style>#f1{font:bold 6pt Verdana;color:#000000}</style>
<span style="position:absolute;top: 30pt;left: 85pt;font-size: 14px;" id=f1>Girls Hostel</span>
<style>#f2{font:bold italic 9pt Arial;color:#000000}</style>
<span style="position:relative;top:-93pt;left:-200pt" id=f2><?php echo $viewcard->STUDENTNAME?></span>
<style>#f2{font:bold italic 9pt Arial;color:#000000}</style>
<span style="position:relative;top:70pt;left:74pt" id=f2><?php echo $viewcard->FATHERNAME?></span>
<style>#f3{font:italic 9pt Arial;color:#000000;font-weight:bolder}</style>
<span style="position:relative;top:-65pt;left:-248pt" id=f3><?php echo $viewcard->REGNO?></span>
<span style="position: absolute; top:30.5pt;left:184.5pt; width:58.5pt;height:58.5pt; "><img src="<?php echo base_url() ?>/uploads/image/<?php echo $viewcard->ALLOTMENT_ID?>.jpg" width=78 height=78 border=0"> </span>
<style>#f4{font:italic 9pt Arial;color:#000000; font-weight:bolder}</style>
<span style="position:relative;top:-52pt;left:-300pt" id=f4><?php echo $viewcard->ROOMDESC.'-'.$viewcard->SEAT.'/'.$viewcard->HOSTELDESC?></span>
<span style="position:relative;top:-37pt;left:-455pt" id=f3><?php echo $viewcard->ISSUEDATE?></span>
<span style="position:relative;top:-20pt;left:-504pt" id=f3><?php echo $viewcard->EXPIRYDATE?></span>

<!--<div style="position: absolute; top:611pt;left:1pt;">
<hr size=5 noshade>
</div>-->

<!--<div style="position: absolute; top:612pt;left:1pt;">

</div>-->
<div class="pagebreak"> </div>
<style>#f5{font:bold 7pt Arial Black;color:#000000}</style>
<span style="position:absolute;top:612pt;left:9pt" id=f5><?php echo $viewcard->STUDENTNAME.''.$viewcard->REGNO?></span>
<div style="position:absolute;top:612.0pt;left:3.5pt;width:320.8;height:181.5;padding-top:173.8;font:0pt Arial;border-width:1.4; border-style:solid;border-color:#ffffff;"><table></table></div>
<span style="position:absolute;top:616pt;left:73pt" id=f3>Powered by IT Centre</span>
<style>#f6{font:bold italic 12pt Times New Roman;color:#000000}</style>
<span style="position:absolute;top:666pt;left:9pt" id=f6>Instructions:</span>
<span style="position:absolute;top:679pt;left:9pt" id=f4>Loss of the Card must be reported to the issuing authority immediately</span>
<span style="position:absolute;top:697pt;left:9pt" id=f4>This Card is non-transferable.</span>
<span style="position:absolute;top:688pt;left:9pt" id=f4>This Card must be returned to issuing authority when leaving the University</span>
<div style="position:absolute;top:710.0pt;left:4.5pt;width:295.5;height:4.2;padding-top:-6.2;font:0pt Arial;border-width:2.7 0 0 0; border-style:solid;border-color:#000000;"><table></table></div>
<div style="position:absolute;top:715pt;left:9pt" id=f4>Students Affairs Section</div>
<div style="position:absolute;top:723pt;left:9pt" id=f4>New Campus, Sector H-10</div>
<div style="position:absolute;top:731pt;left:9pt" id=f4>Islamabad-Pakistan</div>

<!--<div style="position: absolute; top:1223pt;left:1pt;">
<hr size=5 noshade>
</div>-->

<div style="position: relative; top:1225pt;left:0pt;">

<?php 

}
}
?>

