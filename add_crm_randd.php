<?php

if($_GET['styleid']!=''){
$select='*';
$where='id="'.decode($_GET['styleid']).'"';
$rs=GetPageRecord($select,'queryMaster',$where);
$editresultstyle=mysqli_fetch_array($rs);
$buyerId = $editresultstyle['buyerId'];
$buyerStyleRefNo = $editresultstyle['buyerStyleRefNo'];
$subject = $editresultstyle['subject'];
$displayId = $editresultstyle['displayId'];
$seasonId = $editresultstyle['seasonId'];
$categoryId = $editresultstyle['categoryId'];
$subCategoryId = $editresultstyle['subCategoryId'];
$departmentId = $editresultstyle['departmentId'];
$receivedDate = $editresultstyle['receivedDate'];
$patternDescription = $editresultstyle['patternDescription'];
$patternAttachment = $editresultstyle['patternAttachment'];
$patternAttachment = $editresultstyle['patternAttachment'];
$attachmentFile = $editresultstyle['attachmentFile'];
$techpackdescription = $editresultstyle['techpackdescription'];
$lastId=$editresultstyle['id'];

 }

?>
   <style>
    .erptab tr td{
border-top:0px solid #ccc!important;
padding:0.55rem!important;
}
.erptab1 tr td{
border-top:0px solid #ccc!important;
padding:0.40rem!important;
}
.erptab{
border:1px solid #ccc !important;
}
.erptab1{
border:1px solid black !important;
}
.erpint{
    border: 1px solid #b3acac;
    padding: 3px;
}
</style>
	<div class="page-content">
 <?php include "left.php"; ?>
		 <div class="content-wrapper">
 <div class="content pt-0" style="margin-top:20px;">
  	<?php include "top-style.php"; ?>

			 	 <div class="row">
			 	 <div class="col-xl-12">
				 <div class="card">

				<?php

				$rrrr=GetPageRecord('*','randdMaster','1 and styleId="'.decode($_GET['styleid']).'"');
				$operationData=mysqli_fetch_array($rrrr);


				?>

			     <div style="padding: 25px;">
			 	 <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
					<input name="action" type="hidden" id="action" value="addrandd" />
					<input type="hidden" name="styleid" id="styleid" value="<?php echo $_GET['styleid']; ?>" />
					<input name="editId" type="hidden" id="editId" value="<?php echo encode($operationData['id']); ?>">

                    <table class="table erptab" width="100%">
                     <tr>
                         <td><div style="text-transform:capitalize;"><b>Average</b></div></td>
                         <td><input style="width:55%;" type="text" class="erpint <?php if($operationData['average']!=''){ echo 'readonly'; } ?>" name="average"  id="" value="<?php echo $operationData['average'] ?>">&nbsp;
                         <select style="width:26%;" class="erpint <?php if($operationData['unit1']!=''){ echo 'readonly'; } ?>" name="uom1" id="">

                             <option value="meter" <?php if($operationData['unit1'] == "meter") {?> selected <?php } ?>>meters</option>
                             <option value="cms" <?php if($operationData['unit1'] == "cms") {?> selected <?php } ?>>cms</option>

                           </select>
                         </td>
                         <td></td>
                         <td></td>
                     </tr>
                     <tr>
                           <td colspan="2" style="width:55%;border-top:1px solid #ccc!important;border:1px solid #ccc">
                             <?php
                               $rsfab=GetPageRecord('*','styleSubCategoryMaster','materialType=1 and styleId="'.$editresultstyle['id'].'" and costsheetVersionId="'.$editresultstyle['defaultcostsheetVersionId'].'" and name!=""');
					  $resultfab=mysqli_fetch_array($rsfab);

					  $rss=GetPageRecord('*','fabricDetailSheetMaster','fabricName in (select id from materialMaster where name="'.$resultfab['name'].'")');
					  $rslistss=mysqli_fetch_array($rss);
					  ?>
                             <table class="table-hover" width="100%">
                         <tr>

                         <td><div style="text-transform:capitalize"><b>FDS&nbsp;Full&nbsp;width</b></div></td>
                         <td style="width:22%">
                             <input style="width:45%;" type="text" class="erpint <?php if($operationData['fullwidthInches']!=''){ echo 'readonly'; } ?>" name="fullwidth" id="" value="<?php echo $rslistss['fullwidthInches']; ?> " readonly="readonly">&nbsp;
                             <!--<?php echo $operationData['fullWidth'] ?>-->
                             <select style="width:45%;" class="erpint <?php if($operationData['unit2']!=''){ echo 'readonly'; } ?>" name="uom2" id="">
                             <option value="meter" <?php if($operationData['unit2'] == "meter") {?> selected <?php } ?>>meters</option>
                             <option value="cms" <?php if($operationData['unit2'] == "cms") {?> selected <?php } ?>>cms</option>
                             <option value="inches" <?php if($operationData['unit2'] == "inches") {?> selected <?php } ?>>inches</option>

                           </select>
                           </td>
                           <td><div style="text-transform:capitalize"><b>Bulk&nbsp;Full&nbsp;width</b></div></td>
                         <td style="width:22%">
                             <input style="width:45%;" type="text" class="erpint <?php if($operationData['fullWidthb']!=''){ echo 'readonly'; } ?>" name="fullwidthb" id="" value="<?php echo $operationData['fullWidthb'] ?>">&nbsp;
                             <select style="width:45%;" class="erpint <?php if($operationData['unit6']!=''){ echo 'readonly'; } ?>" name="uom6" id="">
                             <option value="meter" <?php if($operationData['unit6'] == "meter") {?> selected <?php } ?>>meters</option>
                             <option value="cms" <?php if($operationData['unit6'] == "cms") {?> selected <?php } ?>>cms</option>
                            <option value="inches" <?php if($operationData['unit6'] == "inches") {?> selected <?php } ?>>inches</option>

                           </select>
                           </td>

                        </tr>
                        <tr>
                         <td><div style="text-transform:capitalize"><b>FDS&nbsp;Cut&nbsp;width</b></div></td>
                         <td><input style="width:45%;" type="text" class="erpint  <?php if($operationData['cuttablewidthinches']!=''){ echo 'readonly'; } ?>" name="cutwidth" id="" value="<?php echo $rslistss['cuttablewidthinches']; ?>" readonly="readonly">&nbsp;
                         <!--<?php echo $operationData['cutWidth'] ?>-->
                         <select style="width:45%;" class="erpint" name="uom4" id="">
                             <option value="meter" <?php if($operationData['unit4'] == "meter") {?> selected <?php } ?>>meters</option>

                         <option value="cms" <?php if($operationData['unit4'] == "cms") {?> selected <?php } ?>>cms</option>
                              <option value="inches" <?php if($operationData['unit4'] == "inches") {?> selected <?php } ?>>inches</option>

                           </select>
                         </td>
                          <td><div style="text-transform:capitalize"><b>Bulk&nbsp;Cut&nbsp;width</b></div></td>
                         <td><input style="width:45%;" type="text" class="erpint <?php if($operationData['cutWidthb']!=''){ echo 'readonly'; } ?>" name="cutwidthb" id="" value="<?php echo $operationData['cutWidthb'] ?>">&nbsp;
                         <select style="width:45%;" class="erpint <?php if($operationData['unit7']!=''){ echo 'readonly'; } ?>" name="uom7" id="">
                             <option value="meter" <?php if($operationData['unit7'] == "meter") {?> selected <?php } ?>>meters</option>
                             <option value="cms" <?php if($operationData['unit7'] == "cms") {?> selected <?php } ?>>cms</option>
                              <option value="inches" <?php if($operationData['unit7'] == "inches") {?> selected <?php } ?>>inches</option>

                         </select>
                         </td>
                         </tr>
                         <tr>
                              <td><div style="text-transform:capitalize"><b>FDS&nbsp;Shrinkage&nbsp;Lengthwise</b></div></td>
                         <td><input style="width:45%;" type="text" class="erpint <?php if($operationData['shrinkagewarp']!=''){ echo 'readonly'; } ?>" name="lengthwise" id="" value="<?php echo $rslistss['shrinkagewarp']; ?>" readonly="readonly">&nbsp;
                         <!--<?php echo $operationData['lengthWise'] ?>-->
                         <select style="width:45%;" class="erpint <?php if($operationData['unit3']!=''){ echo 'readonly'; } ?>" name="uom3" id="">
                             <option value="meter" <?php if($operationData['unit3'] == "meter") {?> selected <?php } ?>>meters</option>
                             <option value="cms" <?php if($operationData['unit3'] == "cms") {?> selected <?php } ?>>cms</option>
                             <option value="inches" <?php if($operationData['unit3'] == "inches") {?> selected <?php } ?>>inches</option>


                           </select>
                         </td>

                         <td><div style="text-transform:capitalize"><b>Bulk&nbsp;Shrinkage&nbsp;Lengthwise</b></div></td>
                         <td><input style="width:45%;" type="text" class="erpint <?php if($operationData['lengthWiseb']!=''){ echo 'readonly'; } ?>" name="lengthwiseb" id="" value="<?php echo $operationData['lengthWiseb'] ?>" >&nbsp;

                         <select style="width:45%;" class="erpint <?php if($operationData['unit8']!=''){ echo 'readonly'; } ?>" name="uom8" id="">
                             <option value="meter" <?php if($operationData['unit8'] == "meter") {?> selected <?php } ?>>meters</option>
                             <option value="cms" <?php if($operationData['unit8'] == "cms") {?> selected <?php } ?>>cms</option>
                                <option value="inches" <?php if($operationData['unit8'] == "inches") {?> selected <?php } ?>>inches</option>

                           </select>
                         </td>
                        </tr>
                        <tr>
                        <td><div style="text-transform:capitalize"><b>FDS&nbsp;Shrinkage&nbsp;Widthwise</b></div></td>
                         <td><input style="width:45%;" type="text" class="erpint <?php if($operationData['shrinkageweft']!=''){ echo 'readonly'; } ?>" name="widthwise" id="" value="<?php echo $rslistss['shrinkageweft']; ?>" readonly="readonly">&nbsp;
                         <!--<?php echo $operationData['widthWise'] ?>-->
                         <select style="width:45%;" class="erpint <?php if($operationData['unit5']!=''){ echo 'readonly'; } ?>" name="uom5" id="">
                             <option value="meter" <?php if($operationData['unit5'] == "meter") {?> selected <?php } ?>>meters</option>
                             <option value="cms" <?php if($operationData['unit5'] == "cms") {?> selected <?php } ?>>cms</option>
                               <option value="inches" <?php if($operationData['unit5'] == "inches") {?> selected <?php } ?>>inches</option>

                           </select>
                         </td>
                         <td><div style="text-transform:capitalize"><b>Bulk&nbsp;Shrinkage&nbsp;Widthwise</b></div></td>
                         <td><input style="width:45%;" type="text" class="erpint <?php if($operationData['widthWiseb']!=''){ echo 'readonly'; } ?>" name="widthwiseb" id="" value="<?php echo $operationData['widthWiseb'] ?>">&nbsp;
                         <select style="width:45%;" class="erpint <?php if($operationData['unit9']!=''){ echo 'readonly'; } ?>" name="uom9" id="">
                             <option value="meter" <?php if($operationData['unit9'] == "meter") {?> selected <?php } ?>>meters</option>
                             <option value="cms" <?php if($operationData['unit9'] == "cms") {?> selected <?php } ?>>cms</option>
                               <option value="inches" <?php if($operationData['unit9'] == "inches") {?> selected <?php } ?>>inches</option>

                           </select>
                         </td>
                        </tr>
                     </table>
                     </td>
                         <td colspan="2"  style="border-top:1px solid #ccc!important;border:1px solid #ccc">
                             <table class="table-hover" width="100%">
                        <tr>
                         <td><div style="text-transform:capitalize"><b>Shell Fabric</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint <?php if($operationData['shellFabric']!=''){ echo 'readonly'; } ?>" name="shellfab" id="" value="<?php echo $operationData['shellFabric'] ?>"></td>
                         <td><div style="text-transform:capitalize"><b>Marker Size</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint <?php if($operationData['markerSize']!=''){ echo 'readonly'; } ?>" name="mrksize" id="" value="<?php echo $operationData['markerSize'] ?>"></td>
                        </tr>
                        <tr>
                         <td><div style="text-transform:capitalize"><b>Lining Fabric</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint <?php if($operationData['liningFabric']!=''){ echo 'readonly'; } ?>" name="linefab" id="" value="<?php echo $operationData['liningFabric'] ?>"></td>
                         <td><div style="text-transform:capitalize"><b>Nested Pieces</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint <?php if($operationData['nestedPiece']!=''){ echo 'readonly'; } ?>" name="nestpiece" id="" value="<?php echo $operationData['nestedPiece'] ?>"></td>
                        </tr>
                        <tr>
                         <td><div style="text-transform:capitalize"><b>Border Print</b></div></td>
                         <td>

                            <select style="width:100%" name="bprint" class="erpint <?php if($operationData['borderPrint']!=''){ echo 'readonly'; } ?>">
                         <option>Select</option>
            <option value="1" <?php if($operationData['borderPrint'] == "1") { ?>selected="selected" <?php } ?>>Yes</option>
            <option value="2" <?php if($operationData['borderPrint'] == "2") { ?>selected="selected" <?php } ?>>No</option>
            <option value="3" <?php if($operationData['borderPrint'] == "3") { ?>selected="selected" <?php } ?>>Engineered Print</option>
            <option value="4" <?php if($operationData['borderPrint'] == "4") { ?>selected="selected" <?php } ?>>One Way Print</option>
                         </select>


                     </td>
                         <td><div style="text-transform:capitalize"><b>Marker Efficiency</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint <?php if($operationData['markerEff']!=''){ echo 'readonly'; } ?>" name="markeffi" id="" value="<?php echo $operationData['markerEff'] ?>"></td>
                        </tr>
                        <tr>
                         <td><div style="text-transform:capitalize"><b>Grain/Print Placement</b></div></td>
                         <td>
                             <select style="width:100%" name="placement" class="erpint <?php if($operationData['placement']!=''){ echo 'readonly'; } ?>">
                         <option>Select</option>
                         <option value="1" <?php if($operationData['placement'] == "1") { ?>selected="selected" <?php } ?>>Straight Grain</option>
                         <option value="2" <?php if($operationData['placement'] == "2") { ?>selected="selected" <?php } ?>>Biased Grain</option>
                         </select>
                         </td>
                         <td><div style="text-transform:capitalize"><b>Seam Allowance</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint <?php if($operationData['seamallow']!=''){ echo 'readonly'; } ?>" name="seamallow" id="" value="<?php echo $operationData['seamAllow'] ?>"></td>
                        </tr>
                        </table>
                     </td>
                     </tr>
                     <tr>
<?php
$newdata = explode(':', $operationData['operation']);
?>
<style>
.select2-search__field{
display:none;
}
.select2-container {
    width: 333px!important;
}
</style>
                     <td colspan="4">
                        <table class="table-hover" width="100%">
                        <tr>
                         <td style="width:16%"><div style="text-transform:capitalize"><b>Critical Operation</b></div></td>
                         <td>
                        <select style="width:45%" name="operation[]" id="operation" class="form-control select2 validate <?php if($operationData['operation']!=''){ echo 'readonly'; } ?>" multiple="multiple">
							<option value=""  disabled="disabled">Select</option>
							<?php
							$abc=GetPageRecord('*','assemblyoperationsMaster','1 and status=1 and deletestatus=0 order by name asc');
							while($critical=mysqli_fetch_array($abc)) {

							?>
							<option value="<?php echo $critical['name'] ?>" <?php foreach($newdata as $operation){ if($operation == $critical['name']) { ?>selected="selected" <?php } } ?>><?php echo $critical['name'] ?>
							</option>
							<?php } ?>
						</select>
                         </td>
                         <?php
$newdata = explode(':', $operationData['highSam']);
?>
                         <td style="width:16%"><div style="text-transform:capitalize"><b>High SAM Operation</b></div></td>
                         <td>

                           <select style="width:45%" name="highSam[]" id="highSam" class="form-control select2 validate <?php if($operationData['highSam']!=''){ echo 'readonly'; } ?>" multiple="multiple">
                            <option value=""  disabled="disabled">Select</option>
                            <?php
                            $abf=GetPageRecord('*','assemblyoperationsMaster','1 and status=1 and deletestatus=0 order by name asc');
                            while($sam=mysqli_fetch_array($abf)) {

                            ?>
                            <option value="<?php echo $sam['name'] ?>" <?php foreach($newdata as $highsam){ if($highsam == $sam['name']) { ?>selected="selected" <?php } } ?>><?php echo $sam['name'] ?>
                            </option>
                            <?php } ?>
                        </select>
                        </td>
                        </tr>
                        </table>
                     </tr>
                     <tr>
                     <td colspan="4">
                             <table class="table-hover" width="100%">
                        <tr>
                         <td style="width:16%"><div style="text-transform:capitalize"><b>Additional Operation</b></div></td>
    <?php
$newdata = explode(':', $operationData['addOperate']);
?>
                         <td>
                           <select style="width:45%" name="addoperate[]" id="addoperate" class="form-control select2 validate <?php if($operationData['addoperate']!=''){ echo 'readonly'; } ?>" multiple="multiple">
                            <option value=""  disabled="disabled">Select</option>
                            <?php
                            $abj=GetPageRecord('*','assemblyoperationsMaster','1 and status=1 and deletestatus=0 order by name asc');
                            while($operate=mysqli_fetch_array($abj)) {

                            ?>
                 <option value="<?php echo $operate['name'] ?>" <?php foreach($newdata as $addop){ if($addop == $operate['name']) { ?>selected="selected" <?php } } ?>>
                    <?php echo $operate['name'] ?>
                            </option>
                            <?php } ?>
                        </select>
                         </td>
                         <td style="text-align:center"><div style="text-transform:capitalize"><b>Additional Process</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint <?php if($operationData['addProcess']!=''){ echo 'readonly'; } ?>" name="addprocess" id="" value="<?php echo $operationData['addProcess'] ?>"></td>
                        </tr>
                        </table>
                     </tr>
                     <tr>
					 <?php
					 if($operationData['techName']==''){
					 	$techName = getUserName($_SESSION['userid']);
					 }else{
					 	$techName = $operationData['techName'];
					 }
					 ?>
                     <td colspan="4">
                       <table class="table-hover" width="100%">
                        <tr>
                         <td style="width:16%"><div style="text-transform:capitalize"><b>Technical Name</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint <?php if($techName!=''){ echo 'readonly'; } ?>" name="techname" id="" value="<?php echo $techName; ?>"></td>
                         <td style="text-align:end;width:23%"><div style="text-transform:capitalize"><b>Technical Approval/Submission</b></div></td>
                         <td>
						 <select style="width:100%" name="techapprove" id="techapprove" class="erpint <?php if($operationData['techFinal']!=''){ echo 'readonly'; } ?>" >
							<option value="1" <?php if($operationData['techFinal']=='1'){ echo "Selected"; }?>>WIP</option>
							<option value="2" <?php if($operationData['techFinal']=='2'){ echo "Selected"; }?>>Complete</option>
						 </select>
						 </td>
                        </tr>
                        </table>
                     </tr>



               </table>
               <br>
               <button type="submit" class="btn btn-primary" style="float:right">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>

               </form>
				</div>






	</div>
</div>
</div>
</div></div></div>



<style>
.nav-justified .nav-item {
    text-align: center;
    width: 50% !important;
    display: contents;
    float: left;
}

.nav-tabs-highlight .nav-link {
    width: 50% !important;
    float: left;

}
.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #333;
    background-color: #fff;
    border-color: #ddd #ddd #fff;
    background-color: #fff178 !important;
    border: 1px solid #ccc;
}
.nav-tabs-highlight .nav-link {
    width: 50% !important;
    float: left;
    border: 1px solid #e9e9e9;
    background-color: #f9f9f9 !important;
}
</style>