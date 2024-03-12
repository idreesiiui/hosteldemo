<?php

$bscredit = '';
$macredit = '';
$mscredit = '';
$phdcredit = '';
$bscreditfor = '';
$macreditfor = '';
$mscreditfor = '';
$phdcreditfor = '';
$semcode = '';
$status = '';
$id = '';
$type = '';                

if(!empty($CreditSettings))
{
    foreach ($CreditSettings as $uf)
    {
        $bscredit = $uf->BSPAK;
		$macredit = $uf->MAPAK;
		$mba1credit = $uf->MBA_1;
		$mba3credit = $uf->MBA3;
		$mscredit = $uf->MSPAK;
		$phdcredit = $uf->PHDPAK;
		$bscreditfor = $uf->BSFOREIGNER;
		$macreditfor = $uf->MAFOREIGNER;
		$mba1creditfor = $uf->MBA_1_FOREIGNER;
		$mba3creditfor = $uf->MBA3_FOREIGNER;
		$mscreditfor = $uf->MSFOREIGNER;
		$phdcreditfor = $uf->PHDFOREIGNER;
		$semcode = $uf->SEMCODE;
		$status = $uf->STATUS;
		$id = $uf->ID;
		$type = $uf->TYPE; 
    }
}


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Credit Hours Management
        <small>Add / Edit Credit Hours</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                 <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Credit Hours Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="credits" action="<?php echo base_url() ?>editcardInfo" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="hostelno">BS Credits (Pakistani)</label>
                                        <select class="form-control required" id="bscredit" name="bscredit">
                                           	<option value="0" <?php if(0 == $bscredit) {echo "selected=selected";} ?>>0</option>
                                            <option value="3" <?php if(3 == $bscredit) {echo "selected=selected";} ?>>3</option>
                                            <option value="6" <?php if(6 == $bscredit) {echo "selected=selected";} ?>>6</option>
                                            <option value="9" <?php if(9 == $bscredit) {echo "selected=selected";} ?>>9</option>
                                            <option value="12" <?php if(12 == $bscredit) {echo "selected=selected";} ?>>12</option>
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hostelno">MA/MSC Credits (Pakistani)</label>
                                        <select class="form-control required" id="macredit" name="macredit">
                                           <option value="0" <?php if(0 == $macredit) {echo "selected=selected";} ?>>0</option>
                                            <option value="3" <?php if(3 == $macredit) {echo "selected=selected";} ?>>3</option>
                                            <option value="6" <?php if(6 == $macredit) {echo "selected=selected";} ?>>6</option>
                                            <option value="9" <?php if(9 == $macredit) {echo "selected=selected";} ?>>9</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="hostelno">MBA(1.5) Credits (Pakistani)</label>
                                        <select class="form-control required" id="mba1credit" name="mba1credit">
                                           	<option value="0" <?php if(0 == $mba1credit) {echo "selected=selected";} ?>>0</option>
                                            <option value="3" <?php if(3 == $mba1credit) {echo "selected=selected";} ?>>3</option>
                                            <option value="6" <?php if(6 == $mba1credit) {echo "selected=selected";} ?>>6</option>
                                            <option value="9" <?php if(9 == $mba1credit) {echo "selected=selected";} ?>>9</option>
                                            
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hostelno">MBA(3.5) Credits (Pakistani)</label>
                                        <select class="form-control required" id="mba3credit" name="mba3credit">
                                           <option value="0" <?php if(0 == $mba3creditt) {echo "selected=selected";} ?>>0</option>
                                            <option value="3" <?php if(3 == $mba3credit) {echo "selected=selected";} ?>>3</option>
                                            <option value="6" <?php if(6 == $mba3credit) {echo "selected=selected";} ?>>6</option>
                                            <option value="9" <?php if(9 == $mba3credit) {echo "selected=selected";} ?>>9</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hostelno">MS Credits (Pakistani)</label>
                                        <select class="form-control required" id="mscredit" name="mscredit">
                                            <option value="0" <?php if(0 == $mscredit) {echo "selected=selected";} ?>>0</option>
                                            <option value="3" <?php if(3 == $mscredit) {echo "selected=selected";} ?>>3</option>
                                            <option value="6" <?php if(6 == $mscredit) {echo "selected=selected";} ?>>6</option>
                                            <option value="9" <?php if(9 == $mscredit) {echo "selected=selected";} ?>>9</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label for="hostelno">PHD Credits (Pakistani)</label>
                                        <select class="form-control required" id="phdcredit" name="phdcredit">
                                            <option value="0" <?php if(0 == $phdcredit) {echo "selected=selected";} ?>>0</option>
                                            <option value="3" <?php if(3 == $phdcredit) {echo "selected=selected";} ?>>3</option>
                                            <option value="6" <?php if(6 == $phdcredit) {echo "selected=selected";} ?>>6</option>
                                            <option value="9" <?php if(9 == $phdcredit) {echo "selected=selected";} ?>>9</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label for="hostelno">BS Credits (Foreigner)</label>
                                        <select class="form-control required" id="bscreditfor" name="bscreditfor">
                                            <option value="0" <?php if(0 == $bscreditfor) {echo "selected=selected";} ?>>0</option>
                                            <option value="3" <?php if(3 == $bscreditfor) {echo "selected=selected";} ?>>3</option>
                                            <option value="6" <?php if(6 == $bscreditfor) {echo "selected=selected";} ?>>6</option>
                                            <option value="9" <?php if(9 == $bscreditfor) {echo "selected=selected";} ?>>9</option>
                                             <option value="12" <?php if(12 == $bscreditfor) {echo "selected=selected";} ?>>12</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hostelno">MA/MSC Credits (Foreigner)</label>
                                        <select class="form-control required" id="macreditfor" name="macreditfor">
                                           <option value="0" <?php if(0 == $macreditfor) {echo "selected=selected";} ?>>0</option>
                                            <option value="3" <?php if(3 == $macreditfor) {echo "selected=selected";} ?>>3</option>
                                            <option value="6" <?php if(6 == $macreditfor) {echo "selected=selected";} ?>>6</option>
                                            <option value="9" <?php if(9 == $macreditfor) {echo "selected=selected";} ?>>9</option>
                                        </select>
                                    </div>
                                </div>    
                            </div>
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="hostelno">MBA(1.5) Credits (Foreigner)</label>
                                        <select class="form-control required" id="mba1creditfor" name="mba1creditfor">
                                           	<option value="0" <?php if(0 == $mba1creditfor) {echo "selected=selected";} ?>>0</option>
                                            <option value="3" <?php if(3 == $mba1creditfor) {echo "selected=selected";} ?>>3</option>
                                            <option value="6" <?php if(6 == $mba1creditfor) {echo "selected=selected";} ?>>6</option>
                                            <option value="9" <?php if(9 == $mba1creditfor) {echo "selected=selected";} ?>>9</option>
                                           
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hostelno">MBA(3.5) Credits (Foreigner)</label>
                                        <select class="form-control required" id="mba3creditfor" name="mba3creditfor">
                                           <option value="0" <?php if(0 == $mba3creditfor) {echo "selected=selected";} ?>>0</option>
                                            <option value="3" <?php if(3 == $mba3creditfor) {echo "selected=selected";} ?>>3</option>
                                            <option value="6" <?php if(6 == $mba3creditfor) {echo "selected=selected";} ?>>6</option>
                                            <option value="9" <?php if(9 == $mba3creditfor) {echo "selected=selected";} ?>>9</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label for="hostelno">MS Credits (Foreigner)</label>
                                        <select class="form-control required" id="mscreditfor" name="mscreditfor">
                                           <option value="0" <?php if(0 == $mscreditfor) {echo "selected=selected";} ?>>0</option>
                                            <option value="3" <?php if(3 == $mscreditfor) {echo "selected=selected";} ?>>3</option>
                                            <option value="6" <?php if(6 == $mscreditfor) {echo "selected=selected";} ?>>6</option>
                                            <option value="9" <?php if(9 == $mscreditfor) {echo "selected=selected";} ?>>9</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hostelno">PHD Credits (Foreigner)</label>
                                        <select class="form-control required" id="phdcreditfor" name="phdcreditfor">
                                            <option value="0" <?php if(0 == $phdcreditfor) {echo "selected=selected";} ?>>0</option>
                                            <option value="3" <?php if(3 == $phdcreditfor) {echo "selected=selected";} ?>>3</option>
                                            <option value="6" <?php if(6 == $phdcreditfor) {echo "selected=selected";} ?>>6</option>
                                            <option value="9" <?php if(9 == $phdcreditfor) {echo "selected=selected";} ?>>9</option>
                                        </select>
                                    </div>
                                </div>    
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label for="hostelno">Type</label>
                                         <select class="form-control required" id="type" name="type">
                                                 <option value="Allotment" <?php if('Allotment' == $type) {echo "selected=selected";} ?>>Allotment</option>
       										     <option value="ReAllotment" <?php if('ReAllotment' == $type) {echo "selected=selected";} ?>>ReAllotment</option>
                                        
                                        <input type="hidden" class="form-control required" id="id" name="id" readonly required maxlength="12" value="<?php echo $id?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hostelno">Status</label>
                                        <select class="form-control required" id="status" name="status">
                                            <option value="">Select Status</option>
                                           	<option value="1" <?php if(1 == $status) {echo "selected=selected";} ?>>Enable</option>
       										<option value="0" <?php if($status== 0) {echo "selected=selected";} ?>>Disable</option>
                                        </select>
                                    </div>
                                </div>    
                            </div>
                            <div class="row">
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hostelno">Semester</label>
                                        <select class="form-control required" id="semcode" name="semcode">
                                            <?php if($semesters){ 
											foreach($semesters as $semester){
												?>
                                           	<option value="<?php echo $semester->SEMCODE?>" <?php if($semester->SEMCODE == $semcode) {echo "selected=selected";} ?>><?php echo $semester->SEMCODE?></option>
       										<?php } }?>
                                        </select>
                                    </div>
                                </div> 
                            </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
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
    </section>
    
</div>
<script src="<?php echo base_url(); ?>assets/js/credits.js" type="text/javascript"></script>