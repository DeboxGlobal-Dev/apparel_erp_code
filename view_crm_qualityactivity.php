<?php
//$updatepage='1';
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
	<div class="page-content">

	 	<?php include "left.php"; ?>
	 	<div class="content-wrapper">



		 	<div class="content pt-0" style="margin-top:20px; overflow:hidden;">
			 	<?php include "top-style.php"; ?>

				<div class="row" >

				<div class="col-xl-12">
				<form action="" method="post" enctype="multipart/form-data" name="popid" target="" id="">
				<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title">Quality Activity </h6>

							</div>


				<div class="card-body">
				<div class="form-group">


				<div class="row">


					<table width="100%" border="0" cellpadding="5" cellspacing="0" class="table" style="font-size:13px !important;">


  <tr height="35" style="padding: 10px; font-size: 15px; font-weight: 600; background-color: #F8F8F8; margin-top: 10px; position: relative;">
				<td width="13%"><div align="left">Activities</div></td>
				<td width="52%"><div align="left">Covers</div></td>
				<td width="4%"><div align="center">Status</div></td>
				<td width="31%"><div align="left">Remarks</div></td>
    </tr>


   <tr height="20">
    	<td><div>P.D  stage workings </div></td>
			<td><div>R.A on product-Fpt,Gpt&Operational Issues</div></td>

		<td align="center"><input type="checkbox" id="qualityactivitycheck" name="qualityactivitycheck[]" value="0" style="margin-right: 5px; width: 18px; height: 18px; margin: 0px;"  onclick="qualityactivitycheckff11();"> </td>



			<td height="20" align="right"><div align="center">
			  <input name="quality_remarks" type="text"  id="quality_remarks<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['quality_remarks']); ?>" autocomplete="off"  style=" width:100%; text-align:center;" onkeyup="savequalitydata<?php echo $resListing1['id']; ?>();">
			</div></td>


  </tr>

   <tr height="20">
    	<td><div>Line Review Meetings</div></td>
			<td><div>
			  <table cellspacing="0" cellpadding="0" style="width: 100%; border: 1px solid #ccc;">
                <col width="413" />
                <tr height="20">
                  <td height="20" width="413">R.A from    development stage</td>
                </tr>
                <tr height="20">
                  <td height="20">Supply chain    analysis for optimum production time.</td>
                </tr>
                <tr height="20">
                  <td height="20">Care    instructions Closers</td>
                </tr>
                <tr height="20">
                  <td height="20">Product    integrity-check points &amp; coverage</td>
                </tr>
                <tr height="20">
                  <td height="20">Identification    &amp; Declaration of High risk styles + Key styles.</td>
                </tr>
              </table>
			</div></td>

			<td align="center">
			<table class="multi-check">
			<tr><td><input type="checkbox" id="qualityactivitycheck" name="qualityactivitycheck[]" value="0" style="margin-right: 5px; width: 18px; height: 18px; margin: 0px;"  onclick="qualityactivitycheckff11();"></td></tr>
			<tr><td><input type="checkbox" id="qualityactivitycheck" name="qualityactivitycheck[]" value="0" style="margin-right: 5px; width: 18px; height: 18px; margin: 0px;"  onclick="qualityactivitycheckff11();"></td></tr>
			<tr><td><input type="checkbox" id="qualityactivitycheck" name="qualityactivitycheck[]" value="0" style="margin-right: 5px; width: 18px; height: 18px; margin: 0px;"  onclick="qualityactivitycheckff11();"></td></tr>
			<tr><td><input type="checkbox" id="qualityactivitycheck" name="qualityactivitycheck[]" value="0" style="margin-right: 5px; width: 18px; height: 18px; margin: 0px;"  onclick="qualityactivitycheckff11();"></td></tr>
			<tr><td><input type="checkbox" id="qualityactivitycheck" name="qualityactivitycheck[]" value="0" style="margin-right: 5px; width: 18px; height: 18px; margin: 0px;"  onclick="qualityactivitycheckff11();"></td></tr>

			</table>
		</td>



			<td height="20" align="right"><div align="center">
			  <input name="quality_remarks" type="text"  id="quality_remarks<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['quality_remarks']); ?>" autocomplete="off"  style=" width:100%; text-align:center;" onkeyup="savequalitydata<?php echo $resListing1['id']; ?>();">
			</div></td>


  </tr>


  <tr height="20">
    	<td><div>R&D Process</div></td>
			<td><div>
			  <table cellspacing="0" cellpadding="0" style="width:100%; border:1px solid #ccc;">
                <col width="413" />
                <tr height="20">
                  <td height="20" width="413">Styles's-    O.B &amp; Check points</td>
                </tr>
                <tr height="20">
                  <td height="20">Critical    operation &amp; Skill matrix</td>
                </tr>
                <tr height="20">
                  <td height="20">Inventory    inspections of Fabric &amp; Trims</td>
                </tr>
              </table>
			</div></td>

		 <td align="center">
			<table class="multi-check">
			<tr><td><input type="checkbox" id="qualityactivitycheck" name="qualityactivitycheck[]" value="0" style="margin-right: 5px; width: 18px; height: 18px; margin: 0px;"  onclick="qualityactivitycheckff11();"></td></tr>
			<tr><td><input type="checkbox" id="qualityactivitycheck" name="qualityactivitycheck[]" value="0" style="margin-right: 5px; width: 18px; height: 18px; margin: 0px;"  onclick="qualityactivitycheckff11();"></td></tr>
			<tr><td><input type="checkbox" id="qualityactivitycheck" name="qualityactivitycheck[]" value="0" style="margin-right: 5px; width: 18px; height: 18px; margin: 0px;"  onclick="qualityactivitycheckff11();"></td></tr>


			</table>
		</td>

			<td height="20" align="right"><div align="center">
			  <input name="quality_remarks" type="text"  id="quality_remarks<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['quality_remarks']); ?>" autocomplete="off"  style=" width:100%; text-align:center;" onkeyup="savequalitydata<?php echo $resListing1['id']; ?>();">
			</div></td>


  </tr>

  <tr height="20">
    	<td><div>Inventory Inspection</div></td>
			<td><div>On AQL(Fabric & Trims) + Bom confirmation</div></td>

<td align="center"><input type="checkbox" id="qualityactivitycheck" name="qualityactivitycheck[]" value="0" style="margin-right: 5px; width: 18px; height: 18px; margin: 0px;"  onclick="qualityactivitycheckff11();"> </td>

			<td height="20" align="right"><div align="center">
			  <input name="quality_remarks" type="text"  id="quality_remarks<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['quality_remarks']); ?>" autocomplete="off"  style=" width:100%; text-align:center;" onkeyup="savequalitydata<?php echo $resListing1['id']; ?>();">
			</div></td>


  </tr>


  <tr height="20">
    	<td><div>PPM</div></td>
			<td><div>
			  <table cellspacing="0" cellpadding="0" style="border:1px solid #ccc; width:100%;">
                <col width="413" />
                <tr height="20">
                  <td height="20" width="413">PD stage    working &amp;Test Results</td>
                </tr>
                <tr height="20">
                  <td height="20">L.R. / R.A.    Points</td>
                </tr>
                <tr height="20">
                  <td height="20">R&amp;D Check</td>
                </tr>
                <tr height="20">
                  <td height="20">Inventory    Inspection.</td>
                </tr>
                <tr height="20">
                  <td height="20">Supply chain    Status vs Daily flow</td>
                </tr>
                <tr height="20">
                  <td height="20">Styles    Operational Review &amp; Comments</td>
                </tr>
                <tr height="20">
                  <td height="20">Notes From Q.A</td>
                </tr>
                <tr height="20">
                  <td height="20">Size Set &amp;    Patterns W/Grading</td>
                </tr>
              </table>
			</div></td>


		 <td align="center">
			<table class="multi-check">
			<tr><td><input type="checkbox" id="qualityactivitycheck" name="qualityactivitycheck[]" value="0" style="margin-right: 5px; width: 18px; height: 18px; margin: 0px;"  onclick="qualityactivitycheckff11();"></td></tr>
			<tr><td><input type="checkbox" id="qualityactivitycheck" name="qualityactivitycheck[]" value="0" style="margin-right: 5px; width: 18px; height: 18px; margin: 0px;"  onclick="qualityactivitycheckff11();"></td></tr>
			<tr><td><input type="checkbox" id="qualityactivitycheck" name="qualityactivitycheck[]" value="0" style="margin-right: 5px; width: 18px; height: 18px; margin: 0px;"  onclick="qualityactivitycheckff11();"></td></tr>
			<tr><td><input type="checkbox" id="qualityactivitycheck" name="qualityactivitycheck[]" value="0" style="margin-right: 5px; width: 18px; height: 18px; margin: 0px;"  onclick="qualityactivitycheckff11();"></td></tr>
			<tr><td><input type="checkbox" id="qualityactivitycheck" name="qualityactivitycheck[]" value="0" style="margin-right: 5px; width: 18px; height: 18px; margin: 0px;"  onclick="qualityactivitycheckff11();"></td></tr>
			<tr><td><input type="checkbox" id="qualityactivitycheck" name="qualityactivitycheck[]" value="0" style="margin-right: 5px; width: 18px; height: 18px; margin: 0px;"  onclick="qualityactivitycheckff11();"></td></tr>
			<tr><td><input type="checkbox" id="qualityactivitycheck" name="qualityactivitycheck[]" value="0" style="margin-right: 5px; width: 18px; height: 18px; margin: 0px;"  onclick="qualityactivitycheckff11();"></td></tr>
			<tr><td><input type="checkbox" id="qualityactivitycheck" name="qualityactivitycheck[]" value="0" style="margin-right: 5px; width: 18px; height: 18px; margin: 0px;"  onclick="qualityactivitycheckff11();"></td></tr>


			</table>
		</td>



			<td height="20" align="right"><div align="center">
			  <input name="quality_remarks" type="text"  id="quality_remarks<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['quality_remarks']); ?>" autocomplete="off"  style=" width:100%; text-align:center;" onkeyup="savequalitydata<?php echo $resListing1['id']; ?>();">
			</div></td>


  </tr>


  <tr height="20">
    	<td><div>Inspection Stages ( with Inpsection Formats )</div></td>
			<td><div>
			  <table cellspacing="0" cellpadding="0" style="border:1px solid #ccc; width:100%;">
                <col width="413" />
                <tr height="20">
                  <td height="20" width="413">R&amp;D    Check -Must</td>
                </tr>
                <tr height="20">
                  <td height="20">Pilot -Must</td>
                </tr>
                <tr height="20">
                  <td height="20">In Line -    Based on style performance &amp; Q.A decision</td>
                </tr>
                <tr height="20">
                  <td height="20">Mid Line-    Based on style performance &amp; Q.A decision</td>
                </tr>
                <tr height="20">
                  <td height="20">Pre Final-    Based on style performance &amp; Q.A decision</td>
                </tr>
                <tr height="20">
                  <td height="20">Final - Must</td>
                </tr>
                <tr height="20">
                  <td height="20">DHU &amp; WIP Analysis&nbsp;</td>
                </tr>
                <tr height="20">
                  <td height="20">RTI with Po Management</td>
                </tr>
              </table>
			</div></td>

 <td align="center">
			<table class="multi-check">
			<tr><td><input type="checkbox" id="qualityactivitycheck" name="qualityactivitycheck[]" value="0" style="margin-right: 5px; width: 18px; height: 18px; margin: 0px;"  onclick="qualityactivitycheckff11();"></td></tr>
			<tr><td><input type="checkbox" id="qualityactivitycheck" name="qualityactivitycheck[]" value="0" style="margin-right: 5px; width: 18px; height: 18px; margin: 0px;"  onclick="qualityactivitycheckff11();"></td></tr>
			<tr><td><input type="checkbox" id="qualityactivitycheck" name="qualityactivitycheck[]" value="0" style="margin-right: 5px; width: 18px; height: 18px; margin: 0px;"  onclick="qualityactivitycheckff11();"></td></tr>
			<tr><td><input type="checkbox" id="qualityactivitycheck" name="qualityactivitycheck[]" value="0" style="margin-right: 5px; width: 18px; height: 18px; margin: 0px;"  onclick="qualityactivitycheckff11();"></td></tr>
			<tr><td><input type="checkbox" id="qualityactivitycheck" name="qualityactivitycheck[]" value="0" style="margin-right: 5px; width: 18px; height: 18px; margin: 0px;"  onclick="qualityactivitycheckff11();"></td></tr>
			<tr><td><input type="checkbox" id="qualityactivitycheck" name="qualityactivitycheck[]" value="0" style="margin-right: 5px; width: 18px; height: 18px; margin: 0px;"  onclick="qualityactivitycheckff11();"></td></tr>
			<tr><td><input type="checkbox" id="qualityactivitycheck" name="qualityactivitycheck[]" value="0" style="margin-right: 5px; width: 18px; height: 18px; margin: 0px;"  onclick="qualityactivitycheckff11();"></td></tr>
			<tr><td><input type="checkbox" id="qualityactivitycheck" name="qualityactivitycheck[]" value="0" style="margin-right: 5px; width: 18px; height: 18px; margin: 0px;"  onclick="qualityactivitycheckff11();"></td></tr>


			</table>
		</td>

			<td height="20" align="right"><div align="center">
			  <input name="quality_remarks" type="text"  id="quality_remarks<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['quality_remarks']); ?>" autocomplete="off"  style=" width:100%; text-align:center;" onkeyup="savequalitydata<?php echo $resListing1['id']; ?>();">
			</div></td>


  </tr>




</table>
 </div>
				</div>
				<div class="text-right">
					<button type="submit" style="margin:0px;" class="btn btn-primary">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true"></i></button>


				    <label>

				    </label>
				</div>
				</div>
				  	</div>
 				</form>
</div>
 </div>
 </div>
			 </div>
		 </div>

<style>
table tr td {
    border: 1px solid #ccc;
    padding: 10px !important;
}
</style>

<style>
/* Hide the browser's default checkbox */
.container input[type=checkbox] {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.container .checkmark {
    position: absolute;
    top: 1px;
    left: 0px;
    height: 17px;
    width: 20px;
    background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container input[type=checkbox] ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input[type=checkbox]:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.container .checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container input[type=checkbox]:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
    left: 8px;
    top: 2px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
.container {
    display: block;
    position: relative;
    padding-left: 25px;
    margin-bottom: 10px;
    cursor: pointer;
    font-size: 14px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    font-weight: 400;
 }
.multi-check {
border:0px solid #ccc;

}
.multi-check tr td{
border:0px solid #ccc;

}
</style>


