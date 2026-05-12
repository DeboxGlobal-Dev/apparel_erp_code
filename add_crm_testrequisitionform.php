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
border:1px solid #ccc!important;
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

		<div class="content-wrapper">
		 <?php include "savealert.php"; ?>

 	   <div class="content pt-0" style="margin-top:20px;">

			<div class="row" style="margin-bottom:10px; ">
						<div class="col-xl-12">
							<div class="card mb-0 rounded-bottom-0" style="padding:15px;">
								<div class="col-xl-3">
									<div class="panel panel-flat">
									   <select id="styleId" name="styleId" class="form-control" onChange="selectStyle();">
											<option value="">Select Style</option>
											<?php
											$styleId = decode($_GET['styleid']);
											$rs=GetPageRecord($select,'queryMaster','1 and deletestatus=0 and subject!="" order by id asc');
											while($resultStyle=mysqli_fetch_array($rs)){
											?>
											<option value="<?php echo encode($resultStyle['id']); ?>" <?php if($styleId==$resultStyle['id']){ echo 'selected'; } ?>><?php echo '#'.$resultStyle['styleRefId']; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								</div>
							</div>
						</div>

			<script>
			function selectStyle(){
			var styleId = $('#styleId').val()
				if(styleId!=''){
					 window.location.href = '<?php echo $fullurl; ?>showpage.crm?module=testrequisitionform&add=yes&styleid='+styleId;
				}
			}
			</script>

			<?php
			if($_GET['styleid']!=''){
				include "top-style.php";
			}
			?>


				<div class="row">

				<div class="col-xl-12">
				<div class="card">
				    <div style="padding: 25px;">
				        <?php

				$rrrr=GetPageRecord('*','testRequisitionForm','1 and styleId="'.decode($_GET['styleid']).'"');
				$operationData=mysqli_fetch_array($rrrr);

				?>
				<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
					<input name="action" type="hidden" id="action" value="testrequisitionform" />
					<input type="hidden" name="styleid" id="styleid" value="<?php echo $_GET['styleid']; ?>" />
					<input name="editId" type="hidden" id="editId" value="<?php echo encode($operationData['id']); ?>">

               <table class="table erptab table-hover" style="width:100%">
                     <tr>
                         <td style="width:18%"><div style="text-transform:capitalize;"><b>Factory Name</b></div></td>
                         <td>
                             <select style="width:100%;" class="erpint" name="factoryname" id="">
                                 <option value="">Select</option>
                                   <?php
				$rrrr=GetPageRecord('*','factoryMaster','1 and deletestatus=0');
				while($factory=mysqli_fetch_array($rrrr)){
				?>
				<option value="<?php echo $factory['id'] ?>" <?php if($factory['id'] == $operationData['factoryId']){ ?> selected<?php } ?>><?php echo $factory['name'] ?></option>
				<?php } ?>
                             </select>
                         </td>
                         <td></td>
                         <td></td>

                     </tr>
                     <div style="display:none;" id="loaddata"></div>
<script>
function getLabDetail(id){
	$('#loaddata').load('loadotherdetails.php?action=labdetail&id='+id);
}
getLabDetail('<?php echo $operationData['labId']; ?>');
</script>
                          <tr>
                        <td><div style="text-transform:capitalize;"><b>Lab</b></div></td>
                         <td>
                        <select style="width:100%;" class="erpint" name="labname" id="labname" onchange="getLabDetail(this.value);">
							<option value="">Select</option>
							<?php
							$rrrr=GetPageRecord('*','labMaster',1);
							while($lab=mysqli_fetch_array($rrrr)){
							?>
							<option value="<?php echo $lab['id'] ?>" <?php if($lab['id'] == $operationData['labId']){ ?> selected<?php } ?>><?php echo strip($lab['labname']); ?></option>
							<?php } ?>
                         </select>
                         </td>
                          <td style="width:26%"><div style="text-transform:capitalize;text-align:end"><b>Email (Lab)</b></div></td>
                          <td><input style="width:100%;" type="text" class="erpint" name="lemail" id="lemail" readonly="readonly" value=""></td>
                     </tr>

                     <tr>
                         <td><div style="text-transform:capitalize"><b>Address (Lab)</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="address" id="address" readonly="readonly" value=""></td>
                         <td><div style="text-transform:capitalize;text-align:end"><b>Mobile (Lab)</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="phone" id="phone" readonly="readonly" value=""></td>
                     </tr>
<script>
function getContDetail(id){
	$('#loaddata').load('loadotherdetails.php?action=contactdetail&id='+id);
}
getContDetail('<?php echo $operationData['contactId']; ?>');
</script>
                     <tr>
                         <td><div style="text-transform:capitalize"><b>Contact Person</b></div></td>
                         <td>
                         <select style="width:100%;" class="erpint" name="contactperson" id="contactperson" onchange="getContDetail(this.value);">
							<option value="">Select</option>
							<?php
							$rrrr=GetPageRecord('*','userMaster','1 and profileId=85');
							while($user=mysqli_fetch_array($rrrr)){
							?>
							<option value="<?php echo $user['id'] ?>" <?php if($user['id'] == $operationData['contactId']){ ?> selected<?php } ?>><?php echo strip($user['firstName']); ?> <?php echo strip($user['lastName']); ?></option>
							<?php } ?>
                             </select>
                         </td>
         				<td><div style="text-transform:capitalize;text-align:end"><b>Email</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="email" id="contactEmail" readonly="readonly" value=""></td>

                     </tr>
                     <tr>
                         <td style="width:%"><div style="text-transform:capitalize"><b>Mobile</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="mobile" id="contactPhone" readonly="readonly" value=""> </td>
                         <td></td>
                         <td></td>
                     </tr>
               </table>

               <br>
               <table class="table erptab table-hover" style="width:100%">
                     <tr>
                         <td style="width:18%;"><div style="text-transform:capitalize;"><b>Invoice Info</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="invoice" id="" value="<?php echo $operationData['invoice'] ?>"></td>
                         <td></td>
                         <td></td>
                     </tr>
                          <tr>
                         <td><div style="text-transform:capitalize"><b>To be charged on</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="charge" id="" value="<?php echo $operationData['charge'] ?>"></td>
                         <td></td>
                         <td></td>
                     </tr>
                     <tr>
                         <td><div style="text-transform:capitalize"><b>Company Name</b></div></td>
                         <td>
                        <select style="width:100%;" class="erpint" name="cname" id="cname" onchange="getCompDetail(this.value);">
                                 <option value="">Select</option>
                                 <?php
				$rrrr=GetPageRecord('*','companyMaster','1 and status=1 and deletestatus=0');
				while($company=mysqli_fetch_array($rrrr)){
				?>
				<option value="<?php echo $company['id'] ?>" <?php if($company['id'] == $operationData['companyId']){ ?> selected<?php } ?>><?php echo $company['name'] ?></option>
				<?php } ?>
                             </select>
                         </td>

<script>
function getCompDetail(id){
	$('#loaddata').load('loadotherdetails.php?action=companydetail&id='+id);
}
getCompDetail('<?php echo $operationData['companyId']; ?>');
</script>
                         <td style="text-align:end;width:26%"><div style="text-transform:capitalize"><b>Email</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="cemail" id="cemail" readonly="readonly"> </td>
                     </tr>
                     <tr>

                         <td><div style="text-transform:capitalize"><b>Address</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="caddress" id="caddress" readonly="readonly"></td>
                        <td></td>
                        <td></td>
                     </tr>
                      <tr>

                         <td><div style="text-transform:capitalize"><b>Contact No.</b></div></td>
                         <td><input style="width:100%;" type="text" class="erpint" name="cmobile" id="cmobile" readonly="readonly"></td>
                        <td></td>
                        <td></td>
                     </tr>
                     </table>
                 <br>
               <table class="table erptab table-hover" width="100%">
               <tr>
               <td style="width:18%"><div style="text-transform:capitalize;"><b>Test Description</b></div></td>

         <style>
.select2-search__field{
display:none;
}
.select2-container{
width: 40%!important;
}
</style>
<?php
$newdesc = explode(',', $operationData['testdesc']);
?>
                               <td>
                             <select style="width:100%;padding:10px;border:1px solid #b3acac" name="testdesc[]" id="testdesc" class="form-control select2 validate" multiple="multiple">
                                 <option value="" disabled>Select</option>
                                 <option value="1" <?php foreach($newdesc as $testdesc){ if($testdesc == "1") { ?> selected="selected" <?php } } ?>>Development Fabric Package Test</option>
                                 <option value="2" <?php foreach($newdesc as $testdesc){ if($testdesc == "2") { ?> selected="selected" <?php } } ?>>Development Garment Package Test</option>
                                 <option value="3" <?php foreach($newdesc as $testdesc){ if($testdesc == "3") { ?> selected="selected" <?php } } ?>>Bulk Garment Full Package Test</option>
                                 <option value="4" <?php foreach($newdesc as $testdesc){ if($testdesc == "4") { ?> selected="selected" <?php } } ?>>Bulk Fabric Full Package Test</option>
                                 <option value="5" <?php foreach($newdesc as $testdesc){ if($testdesc == "5") { ?> selected="selected" <?php } } ?>>Trim Test</option>
                             </select>
                         </td>
                         <td style="width:30%;"></td>
                     </tr>
               </table>
                <?php
                      $newdata = explode(',', $operationData['dimensionStable']);
                      $newdata1 = explode(',', $operationData['appearanceR']);
                      $newdata2 = explode(',', $operationData['colorFastness']);
                      $newdata3 = explode(',', $operationData['physical']);
                      $newdata4 = explode(',', $operationData['ecoTest']);
                             ?>
               <br>
               <table class="table erptab" width="100%">

                    <tr style="background: #0288d1;">
                         <td colspan="4"><div style="text-transform:capitalize;color:white;font-size: 15px;">Care Instructions and/or Symbols:
                         &nbsp;&nbsp;<i class="fa fa-circle" style="font-size:20px"></i>&nbsp;
                         &nbsp;<i class="fa fa-play" style="font-size:20px;transform: rotate(-90deg);"></i>&nbsp;
                         &nbsp;<i class="fa fa-stop" style="font-size:20px"></i>
                         </div>
                         </td>
                     </tr>
                     <tr>
                         <td colspan="5"><div><b>Test (s) Required: </b>(Please fill all the information and tick appropriate boxes)</div></td>
                     </tr>
                     <tr>
                         <td colspan="5" style="padding-bottom:0px!important;">
                         <table class="erptab1" width="100%">
                      <tr>
                         <td colspan="5"><div style="text-decoration:underline"><b>Test (s) Required: </b></div></td>
                     </tr>
                     <tr>
                         <td><div style="text-transform:capitalize"><b>Dimensional Stability</b></div></td>
                         <td><div style="text-transform:capitalize"><b>Physical</b></div></td>
                        <td><input type="checkbox" class="erpint" name="physical[]" id="" value="16" <?php foreach($newdata3 as $physical){ if($physical == "16") { ?>checked <?php } } ?>>&nbsp;Zipper Strength</td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>

                         <td><input type="checkbox" class="erpint" name="dimension[]" id="" value="1" <?php foreach($newdata as $dimension){ if($dimension == "1") { ?>checked <?php } } ?>>&nbsp;Washing</td>
                         <td><input type="checkbox" class="erpint" name="physical[]" id="" value="1" <?php foreach($newdata3 as $physical){ if($physical == "1") { ?>checked <?php } } ?>>&nbsp;Spirality</td>
                        <td><div style="text-transform:capitalize"><b>ECO Test</b></div></td>
                        <td style="border-top: 1px solid black!important;border-left: 1px solid black;border-right: 1px solid black;"><div style="text-transform:capitalize"><b>Test Method reference to</b></div></td>
                        <td></td>
                     </tr>
                     <tr>
                         <td><input type="checkbox" class="erpint" name="dimension[]" id="" value="2" <?php foreach($newdata as $dimension){ if($dimension == "2") { ?>checked <?php } } ?>>&nbsp;Dry-cleaning</td>
                         <td><input type="checkbox" class="erpint" name="physical[]" id="" value="2" <?php foreach($newdata3 as $physical){ if($physical == "2") { ?>checked <?php } } ?>>&nbsp;Tensile Strength</td>
                        <td><input type="checkbox" class="erpint" name="ecotest[]" id="" value="1" <?php foreach($newdata4 as $ecotest){ if($ecotest == "1") { ?>checked <?php } } ?>>&nbsp;pH Value</td>
                        <td style="border-left: 1px solid black;border-right: 1px solid black;"><input type="radio" class="erpint" name="testmethod" value="1" id="" <?php if( $operationData['testMethod'] == "1"){ ?> checked <?php } ?>>&nbsp;AATCC/ASTM (<b>U.S.A</b>)</td>
                        <td></td>
                     </tr>
                     <tr>
                         <td><div style="text-transform:capitalize"><b>Appearance Retention</b></div></td>
                         <td><input type="checkbox" class="erpint" name="physical[]" id="" value="3" <?php foreach($newdata3 as $physical){ if($physical == "3") { ?>checked <?php } } ?>>&nbsp;Tear Strength</td>
                        <td><input type="checkbox" class="erpint" name="ecotest[]" id="" value="2" <?php foreach($newdata4 as $ecotest){ if($ecotest == "2") { ?>checked <?php } } ?>>&nbsp;Formadehyde Content</td>
                        <td style="border-left: 1px solid black;border-right: 1px solid black;"><input type="radio" class="erpint" name="testmethod" value="2" id="" <?php if( $operationData['testMethod'] == "2"){ ?> checked <?php } ?>>&nbsp;ISO (<b>International</b>)</td>
                        <td></td>
                     </tr>
                     <tr>
                         <td><input type="checkbox" class="erpint" name="appear[]" id="" value="1" <?php foreach($newdata1 as $appear){ if($appear == "1") { ?>checked <?php } } ?>>&nbsp;After Laundering</td>
                         <td><input type="checkbox" class="erpint" name="physical[]" id="" value="4" <?php foreach($newdata3 as $physical){ if($physical == "4") { ?>checked <?php } } ?>>&nbsp;Seam Slippage</td>
                        <td><input type="checkbox" class="erpint" name="ecotest[]" id="" value="3" <?php foreach($newdata4 as $ecotest){ if($ecotest == "3") { ?>checked <?php } } ?>>&nbsp;Banned AZO Dyes</td>
                        <td style="border-left: 1px solid black;border-right: 1px solid black;"><input type="radio" class="erpint" name="testmethod" value="3" id="" <?php if( $operationData['testMethod'] == "3"){ ?> checked <?php } ?>>&nbsp;BS (<b>U.K</b>)</td>
                        <td></td>
                     </tr>
                     <tr>
                         <td><input type="checkbox" class="erpint" name="appear[]" id="" value="2" <?php foreach($newdata1 as $appear){ if($appear == "2") { ?>checked <?php } } ?>>&nbsp;After Dry-cleaning</td>
                         <td><input type="checkbox" class="erpint" name="physical[]" id="" value="5" <?php foreach($newdata3 as $physical){ if($physical == "5") { ?>checked <?php } } ?>>&nbsp;Seam Strength</td>
                        <td><input type="radio" class="erpint" name="ecotest[]" id="" value="41" <?php foreach($newdata4 as $ecotest){ if($ecotest == "41") { ?>checked <?php } } ?>>&nbsp;Mixed Test&nbsp;&nbsp;<input type="radio" class="erpint" name="ecotest[]" id="" value="42" <?php foreach($newdata4 as $ecotest){ if($ecotest == "42") { ?>checked <?php } } ?>>&nbsp;Individual Test </td>
                        <td style="border-left: 1px solid black;border-right: 1px solid black;"><input type="radio" class="erpint" name="testmethod" value="4" id="" <?php if( $operationData['testMethod'] == "4"){ ?> checked <?php } ?>>&nbsp;Other (<b>Please Specify</b>)</td>
                        <td></td>
                     </tr>
                      <tr>
                         <td><div style="text-transform:capitalize"><b>Colour Fastness</b></div></td>
                         <td><input type="checkbox" class="erpint" name="physical[]" id="" value="6" <?php foreach($newdata3 as $physical){ if($physical == "6") { ?>checked <?php } } ?>>&nbsp;Bursting Strength</td>
                        <td><input type="checkbox" class="erpint" name="ecotest[]" id="" value="5" <?php foreach($newdata4 as $ecotest){ if($ecotest == "5") { ?>checked <?php } } ?>>&nbsp;Extractable Heavy Metals</td>
                        <td style="border-left: 1px solid black;border-right: 1px solid black;"></td>
                        <td></td>
                     </tr>
                      <tr>
                         <td><input type="checkbox" class="erpint" name="color[]" id="" value="1" <?php foreach($newdata2 as $color){ if($color == "1") { ?>checked <?php } } ?>>&nbsp;Washing</td>
                         <td><input type="checkbox" class="erpint" name="physical[]" id="" value="7" <?php foreach($newdata3 as $physical){ if($physical == "7") { ?>checked <?php } } ?>>&nbsp;Pilling Resistance</td>
                        <td><input type="checkbox" class="erpint" name="ecotest[]" id="" value="6" <?php foreach($newdata4 as $ecotest){ if($ecotest == "6") { ?>checked <?php } } ?>>&nbsp;PCP</td>
                        <td style="border: 1px solid black!important;"><div style="text-transform:capitalize"><b>Exported to Market : </b></div></td>
                         <td></td>
                     </tr>
                     <tr>
                         <td><input type="checkbox" class="erpint" name="color[]" id="" value="2" <?php foreach($newdata2 as $color){ if($color == "2") { ?>checked <?php } } ?>>&nbsp;Dry-cleaning</td>
                         <td><input type="checkbox" class="erpint" name="physical[]" id="" value="8" <?php foreach($newdata3 as $physical){ if($physical == "8") { ?>checked <?php } } ?>>&nbsp;Abrasion Resistance</td>
                        <td><input type="checkbox" class="erpint" name="ecotest[]" id="" value="7" <?php foreach($newdata4 as $ecotest){ if($ecotest == "9") { ?>checked <?php } } ?>>&nbsp;Phthalates</td>
                        <td></td>
                        <td></td>
                     </tr>
                     <tr>
                         <td><input type="checkbox" class="erpint" name="color[]" id="" value="3" <?php foreach($newdata2 as $color){ if($color == "3") { ?>checked <?php } } ?>>&nbsp;Rubbing / Crocking</td>
                         <td><input type="checkbox" class="erpint" name="physical[]" id="" value="9" <?php foreach($newdata3 as $physical){ if($physical == "9") { ?>checked <?php } } ?>>&nbsp;Thread per inch</td>
                        <td><input type="checkbox" class="erpint" name="ecotest[]" id="" value="8" <?php foreach($newdata4 as $ecotest){ if($ecotest == "8") { ?>checked <?php } } ?>>&nbsp;Total Cadmium</td>
                        <td></td>
                        <td></td>
                     </tr>
                     <tr>
                         <td><input type="checkbox" class="erpint" name="color[]" id="" value="4" <?php foreach($newdata2 as $color){ if($color == "4") { ?>checked <?php } } ?>>&nbsp;Light</td>
                         <td><input type="checkbox" class="erpint" name="physical[]" id="" value="10" <?php foreach($newdata3 as $physical){ if($physical == "10") { ?>checked <?php } } ?>>&nbsp;Yam Count</td>
                        <td><input type="checkbox" class="erpint" name="ecotest[]" id="" value="9" <?php foreach($newdata4 as $ecotest){ if($ecotest == "9") { ?>checked <?php } } ?>>&nbsp;Release of Nickel</td>
                        <td></td>
                        <td></td>
                     </tr>
                     <tr>
                         <td><input type="checkbox" class="erpint" name="color[]" id="" value="5" <?php foreach($newdata2 as $color){ if($color == "5") { ?>checked <?php } } ?>>&nbsp;Perspiration</td>
                         <td><input type="checkbox" class="erpint" name="physical[]" id="" value="11" <?php foreach($newdata3 as $physical){ if($physical == "11") { ?>checked <?php } } ?>>&nbsp;Fabric Weight</td>
                        <td><input type="checkbox" class="erpint" name="ecotest[]" id="" value="10" <?php foreach($newdata4 as $ecotest){ if($ecotest == "10") { ?>checked <?php } } ?>>&nbsp;Lead Content</td>
                        <td></td>
                        <td></td>
                     </tr>
                     <tr>
                         <td><input type="checkbox" class="erpint" name="color[]" id="" value="6" <?php foreach($newdata2 as $color){ if($color == "6") { ?>checked <?php } } ?>>&nbsp;Water</td>
                         <td><input type="checkbox" class="erpint" name="physical[]" id="" value="12" <?php foreach($newdata3 as $physical){ if($physical == "12") { ?>checked <?php } } ?>>&nbsp;Care Label Recommendations</td>
                        <td></td>
                        <td></td>
                        <td></td>
                     </tr>
                     <tr>
                         <td><input type="checkbox" class="erpint" name="color[]" id="" value="7" <?php foreach($newdata2 as $color){ if($color == "7") { ?>checked <?php } } ?>>&nbsp;Actual Laundering</td>
                         <td><input type="checkbox" class="erpint" name="physical[]" id="" value="13" <?php foreach($newdata3 as $physical){ if($physical == "13") { ?>checked <?php } } ?>>&nbsp;Print Durability</td>
                        <td></td>
                        <td></td>
                        <td></td>
                     </tr>
                     <tr>
                         <td><input type="checkbox" class="erpint" name="color[]" id="" value="8" <?php foreach($newdata2 as $color){ if($color == "8") { ?>checked <?php } } ?>>&nbsp;Chlorine Bleach</td>
                         <td><input type="checkbox" class="erpint" name="physical[]" id="" value="14" <?php foreach($newdata3 as $physical){ if($physical == "14") { ?>checked <?php } } ?>>&nbsp;Fibre Content</td>
                        <td></td>
                        <td></td>
                        <td></td>
                     </tr>
                     <tr>
                         <td><input type="checkbox" class="erpint" name="color[]" id="" value="9" <?php foreach($newdata2 as $color){ if($color == "9") { ?>checked <?php } } ?>>&nbsp;Non-Chlorine Bleach</td>
                         <td><input type="checkbox" class="erpint" name="physical[]" id="" value="15" <?php foreach($newdata3 as $physical){ if($physical == "15") { ?>checked <?php } } ?>>&nbsp;Flammability</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        </tr>
                        </table>
                     </td>
                     </tr>
                     <tr>
                     <td style="padding-top:0px!important;">
                   <table class="erptab" width="100%">
                     <tr>
                         <td style="border: 1px solid black!important;border-top:none!important" colspan="5"><div><b>Other Tests (Please indicate test method if possible or special request) </b></div></td>
                     </tr>
                     <tr>
                          <td style="border-bottom:1px solid black;border-left:1px solid black;"><div><b>Comment on test results</b></div></td>
                          <td style="border-bottom:1px solid black">
                             <input type="radio" class="erpint" name="comment" value="Yes" <?php if($operationData['comment'] != ""){ ?> checked <?php } ?>>&nbsp;Yes
                             &nbsp;&nbsp;&nbsp;&nbsp;
                             <input type="radio" class="erpint" name="comment" value="No" <?php if($operationData['comment'] == ""){ ?> checked <?php } ?>>&nbsp;No
                             </td>
                         <td colspan="3" style="border-bottom:1px solid black;border-right:1px solid black;"><input type="text" style="width:100%;border:1px solid black;padding:5px;" name="remarks" placeholder="Remarks" value="<?php echo $operationData['comment'] ?>"></td>
                     </tr>
                     <tr>
                         <td style="border-left:1px solid black;"><div><b>Is it a re-test ?</b></div></td>
                         <td><input type="radio" class="erpint" name="retest" id="" value="yes" <?php if($operationData['reTest'] == "yes"){ ?> checked <?php } ?> >&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;
                         <input type="radio" class="erpint" name="retest" id="" value="no" <?php if($operationData['reTest'] == "no"){ ?> checked <?php } ?> >&nbsp;No</td>
                         <td><div><b>Returned Remained Sample</b></div></td>
                         <td><input type="radio" class="erpint" name="returnsample" id="" value="yes" <?php if($operationData['returnSample'] == "yes"){ ?> checked <?php } ?>>&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;
                         <input type="radio" class="erpint" name="returnsample" id="" value="no" <?php if($operationData['returnSample'] == "no"){ ?> checked <?php } ?>>&nbsp;No</td>
                         <td style="border-right:1px solid black;"></td>
                     </tr>
                     <tr>
                         <td style="border: 1px solid black!important;border-top:none!important" colspan="5"><b>If yes, Please enter mention previous report number</b>&nbsp;&nbsp;&nbsp;<input type="text" class="erpint" name="reportnum" value="<?php echo $operationData['reportNumber'] ?>" id="">
                         </td>
                     </tr>
                     </table>
                     </td>
                     </tr>


                     </table>
                   <br>
            <button type="submit" class="btn btn-primary" style="float:right">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>
                </form>
				</div>


				</div>

</div>

			</div>

		</div>

	</div>

</div>