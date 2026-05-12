
<?php
include('inc.php');

if($_REQUEST['id']!=''){
$chaalanLastId = decode($_REQUEST['id']);

$rschaalan=GetPageRecord('*','chaalanMaster','id="'.$chaalanLastId.'"');
$userschaalan=mysqli_fetch_array($rschaalan);

$rsquery=GetPageRecord('defaultcostsheetVersionId','queryMaster','id="'.decode($_REQUEST['styleId']).'"');
$rsquerylist=mysqli_fetch_array($rsquery);

if($_REQUEST['addsize']==1 && $_REQUEST['id']!='' && $_REQUEST['action']=='addnewrow'){
	$namevalue ='parentId="'.decode($_REQUEST['id']).'",styleId="'.decode($_REQUEST['styleId']).'",status=1,addedBy="'.$_SESSION['userid'].'"';
	addlistinggetlastid('chaalanMaster',$namevalue);
}


if($_REQUEST['deletestatus']=="yes" && $_REQUEST['rowid']!=''){
deleteRecord('chaalanMaster','id="'.$_REQUEST['rowid'].'"');
}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
				<div class="card-body">
				<div class="form-group">
				<div class="row">


						<table width="100%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolor="#000000" style="border:1px #ccc;">
  <tr>
    <td align="center"><div style="font-size:16px; font-weight:bold; ">Challan <?php echo $userschaalan['chaalanNo']; ?></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
        <table width="100%" border="0" cellspacing="0" cellpadding="5">
	<tr>
        <td width="26%" align="left" valign="top"><span style="font-size:13px;">
          From:
		  <select  id="fromFactoryId" name="fromFactoryId"  class="form-control" onchange="saveChaalan();">
		  	<option>Select</option><?php $rs1=GetPageRecord('*','factoryMaster','1  and status=1 order by name asc');
	while($userss1=mysqli_fetch_array($rs1)){ ?><option value="<?php echo $userss1['id']; ?>" <?php if($userschaalan['fromFactoryId']==$userss1['id']){ echo "selected"; } ?>><?php echo $userss1['name']; ?></option><?php } ?>
		  </select>
          </td>
        <td width="26%" align="left" valign="top"><span style="font-size:13px;">
To:  <select id="toFactoryId" name="toFactoryId"  class="form-control" onchange="saveChaalan();">
		  	<option>Select</option><?php $rs1=GetPageRecord('*','factoryMaster','1  and status=1 order by name asc');
	while($userss1=mysqli_fetch_array($rs1)){ ?><option value="<?php echo $userss1['id']; ?>" <?php if($userschaalan['toFactoryId']==$userss1['id']){ echo "selected"; } ?>><?php echo $userss1['name']; ?></option><?php } ?>
		  </select></td>

        <td width="26%" align="left" valign="top"><span style="font-size:13px;">
          From Department:
		  <select  id="departmentId" name="departmentId" onchange="saveChaalan();" class="form-control">
		  	<option>Select</option>
		  	<?php
		  	//echo '1 and id in (53,61,69,68,55,56,70,71,63,57) and status=1 order by id asc';
		  	//$rs111111=GetPageRecord('*','departmentMaster','1 and id in (53,61,69,68,55,56,70,71,63,57) and status=1 order by field(id, 13,21,20,14,15,17,70,71,63,57)');
		  	$rs111111=GetPageRecord('*','departmentMaster','1 and id in (19,13,14,21,20,55,52,17,41) and status=1 order by field(id, 19,13,14,21,20,55,52,17,41)');
             	while($userss1111=mysqli_fetch_array($rs111111)){ ?>
	<option value="<?php echo $userss1111['id']; ?>" <?php if($userschaalan['departmentId']==$userss1111['id']){ echo "selected"; } ?>><?php echo $userss1111['name']; ?></option><?php } ?>
		  </select>
          </td>
        <td width="26%" align="left" valign="top"><span style="font-size:13px;">
To Department: <select id="fromDepartmentId" name="fromDepartmentId" onchange="saveChaalan();" class="form-control">
		  	<option>Select</option><?php $rs1=GetPageRecord('*','departmentMaster','1 and id in (19,13,14,21,20,55,52,17,41) and status=1 order by field(id, 19,13,14,21,20,55,52,17,41)');
	while($userss1=mysqli_fetch_array($rs1)){ ?><option value="<?php echo $userss1['id']; ?>" <?php if($userschaalan['fromDepartmentId']==$userss1['id']){ echo "selected"; } ?>><?php echo $userss1['name']; ?></option><?php } ?>
		  </select></span></td>

    </table></td>
  </tr>
  <tr>
  	<td align="left" style="border-bottom:1px solid #000;">Supervisior:
	  <input type="text" name="supervisor" id="supervisor" class="form-control" onblur="saveChaalan();" style="width:25%" value="<?php echo $userschaalan['supervisor']; ?>" /></td>
    <!-- <td align="right" style="border-bottom:1px solid #000;">Dispatch Type: Internal </td> -->
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#000000">
      <tr style="color:#FFFFFF;">
       <!-- <td bgcolor="#333333"><strong>Style#</strong></td>-->
	   <td bgcolor="#333333" class="forchallan"><strong>Material&nbsp;Name</strong></td>
        <td bgcolor="#333333"><strong>Color</strong></td>
        <td bgcolor="#333333" class="nochallan"><strong>Size</strong></td>
		<td bgcolor="#333333" class="nochallan"><strong>Rec.&nbsp;Qty.</strong></td>
		<td bgcolor="#333333" class="forchallan"><strong>Length</strong></td>
		<td bgcolor="#333333" class="forchallan"><strong>UOM</strong></td>
		<td bgcolor="#333333" class="forchallan"><strong>Avg.</strong></td>
		<td bgcolor="#333333" class="forchallan"><strong>UOM</strong></td>
		<td bgcolor="#333333" class="nochallan"><strong>From&nbsp;Serial&nbsp;No.</strong></td>
		<td bgcolor="#333333" class="nochallan"><strong>To&nbsp;Serial&nbsp;No.</strong></td>
        <td bgcolor="#333333" ><strong>Qty</strong></td>
        <!--<td bgcolor="#333333"><strong>UOM</strong></td>
        <td bgcolor="#333333"><strong>Detail</strong></td>-->
		<td bgcolor="#333333" align="center"><strong><a href="javascript:void(0);" onclick="addnewline('<?php echo encode($chaalanLastId); ?>');">+Add&nbsp;New</a></strong></td>
      </tr>

	<?php
	$wherenew='parentId="'.decode($_REQUEST['id']).'" order by id asc';
	$rsnew=GetPageRecord('*','chaalanMaster',$wherenew);
	while($rslistnew=mysqli_fetch_array($rsnew)){
	?>
      <tr>
       <!--	<td><strong><?php
		$styleId = decode($_REQUEST['styleId']);
		 echo '#'.getStyleRefId($styleId); ?></strong></td>-->
		 <td  class="forchallan">
		 <select name="materialId<?php echo $rslistnew['id']; ?>" id="materialId<?php echo $rslistnew['id']; ?>" class="form-control" onchange="savelinedetail<?php echo $rslistnew['id']; ?>();" >
		 	<option>Select Material</option>
		 	<?php
			$rs=GetPageRecord('*','styleSubCategoryMaster','costsheetVersionId="'.$rsquerylist['defaultcostsheetVersionId'].'" and styleId="'.decode($_REQUEST['styleId']).'" and materialType=1');
			while($resListing=mysqli_fetch_array($rs)){
			?>
			<option value="<?php echo $resListing['id']; ?>" <?php if($resListing['id']==$rslistnew['materialId']){ echo 'selected'; }?>><?php echo $resListing['name']; ?></option>
			<?php } ?>
		 </select>
		 </td>
    <td><input type="text" name="color" id="color<?php echo $rslistnew['id']; ?>" class="form-control" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" value="<?php echo $rslistnew['color']; ?>"  /></td>
        <td class="nochallan"><input type="text" name="size" id="size<?php echo $rslistnew['id']; ?>" class="form-control" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" value="<?php echo $rslistnew['size']; ?>"  /></td>
		<td class="nochallan"><input type="text" name="receivedQty" id="receivedQty<?php echo $rslistnew['id']; ?>" class="form-control" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" value="<?php echo $rslistnew['receivedQty']; ?>"  /></td>
		 <td class="forchallan"><input type="text" name="length" id="length<?php echo $rslistnew['id']; ?>" class="form-control"  onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" value="<?php echo $rslistnew['length']; ?>"  /></td>
		<td class="forchallan">
		<select id="lengthUom<?php echo $rslistnew['id']; ?>" class="form-control" onchange="savelinedetail<?php echo $rslistnew['id']; ?>();" ><option value="pcs" <?php if($rslistnew['lengthUom']=="pcs"){ echo 'selected'; } ?> >Pcs</option><option value="Meter" <?php if($rslistnew['lengthUom']=="Meter"){ echo 'selected'; } ?>>Meter</option><option value="Yard" <?php if($rslistnew['lengthUom']=="Yard"){ echo 'selected'; } ?>>Yard</option><option value="Kg" <?php if($rslistnew['lengthUom']=="Kg"){ echo 'selected'; } ?>>Kg</option></select>
		</td>
		<td class="forchallan"><input type="text" name="avg" id="avg<?php echo $rslistnew['id']; ?>" class="form-control"  onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" value="<?php echo $rslistnew['avg']; ?>"/></td>
		<td class="forchallan">
		<select id="avgUom<?php echo $rslistnew['id']; ?>" class="form-control" onchange="savelinedetail<?php echo $rslistnew['id']; ?>();"><option value="pcs" <?php if($rslistnew['avgUom']=="pcs"){ echo 'selected'; } ?>>Pcs</option><option value="Meter" <?php if($rslistnew['avgUom']=="Meter"){ echo 'selected'; } ?> >Meter</option><option value="Yard" <?php if($rslistnew['avgUom']=="Yard"){ echo 'selected'; } ?>>Yard</option><option value="Kg" <?php if($rslistnew['avgUom']=="Kg"){ echo 'selected'; } ?>>Kg</option></select>
		</td>
		 <td class="nochallan"><input type="number" name="fromSr" class="form-control" id="fromSr<?php echo $rslistnew['id']; ?>"  onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" value="<?php echo $rslistnew['fromSr']; ?>"/></td>
		  <td class="nochallan"><input type="number" name="toSr" class="form-control" id="toSr<?php echo $rslistnew['id']; ?>"  onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" value="<?php echo $rslistnew['toSr']; ?>"/></td>
        <td ><input type="number" name="quantity"  class="form-control" id="quantity<?php echo $rslistnew['id']; ?>"  onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" value="<?php echo $rslistnew['quantity']; ?>" /></td>
       <!-- <td><select id="quantityType<?php echo $rslistnew['id']; ?>" onchange="savelinedetail<?php echo $rslistnew['id']; ?>();"><option value="pcs">Pcs</option><option value="Meter">Meter</option><option value="Yard">Yard</option></select></td>
        <td><input type="text" name="remark" id="remark<?php echo $rslistnew['id']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" value="<?php echo $rslistnew['remark']; ?>"/> </td>-->
		<td align="center"><a href="javascript:void(0);" onclick="deleterow('<?php echo $rslistnew['id']; ?>');"><i class="icon-trash" style="font-size:13px;cursor:pointer; color:#FF0000;"></i></a></td>
      </tr>
    	<!--<script>
		function deleterow<?php echo $rslistnew['id']; ?>(){
			$('#loadchaalan').load('loadchaalan.php?deletestatus=yes&lineid=<?php echo $rslistnew['id']; ?>&styleId=<?php echo encode($rslistnew['styleId']); ?>');
		}
		</script>-->

<script>
function savelinedetail<?php echo $rslistnew['id']; ?>(){

var color = encodeURI($('#color<?php echo $rslistnew['id']; ?>').val());
var size = encodeURI($('#size<?php echo $rslistnew['id']; ?>').val());
var receivedQty = encodeURI($('#receivedQty<?php echo $rslistnew['id']; ?>').val());
var length = encodeURI($('#length<?php echo $rslistnew['id']; ?>').val());
var lengthUom = encodeURI($('#lengthUom<?php echo $rslistnew['id']; ?>').val());
var avg = encodeURI($('#avg<?php echo $rslistnew['id']; ?>').val());
var avgUom = encodeURI($('#avgUom<?php echo $rslistnew['id']; ?>').val());
var fromSr = Number($('#fromSr<?php echo $rslistnew['id']; ?>').val());
var toSr = Number($('#toSr<?php echo $rslistnew['id']; ?>').val());
if(toSr!=''){
var totalQty = Number(toSr)-Number(fromSr);
totalQty = totalQty+1;
Number($('#quantity<?php echo $rslistnew['id']; ?>').val(totalQty));
var quantity = Number($('#quantity<?php echo $rslistnew['id']; ?>').val());
}else{
	var quantity = Number($('#quantity<?php echo $rslistnew['id']; ?>').val());
}


var quantityType = encodeURI($('#quantityType<?php echo $rslistnew['id']; ?>').val());
var remark = encodeURI($('#remark<?php echo $rslistnew['id']; ?>').val());
var materialId = encodeURI($('#materialId<?php echo $rslistnew['id']; ?>').val());



$('#addcolordetail<?php echo $rslistnew['id']; ?>').load('savechaalandetail.php?color='+color+'&size='+size+'&receivedQty='+receivedQty+'&quantity='+quantity+'&quantityType='+quantityType+'&remark='+remark+'&fromSr='+fromSr+'&toSr='+toSr+'&length='+length+'&lengthUom='+lengthUom+'&avg='+avg+'&avgUom='+avgUom+'&materialId='+materialId+'&action=savepdfdetail&id=<?php echo $rslistnew['id']; ?>');

}
</script>
<div id="addcolordetail<?php echo $rslistnew['id']; ?>" style="display:nodne;"></div>
<?php }  ?>
	   <tr style="color:#FFFFFF;">
        <td bgcolor="#333333" colspan="50">&nbsp;</td>

      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> </td>
  </tr>
  <tr>
    <td style="border-bottom:1px solid #000;"><strong>Additional Charges Details:</strong> <input type="text" name="chargesDetail"  id="chargesDetail" onkeyup="saveChaalan();" value="<?php echo $userschaalan['chargesDetail']; ?>" /></td>
  </tr>
   <tr>
    <td style="border-bottom:1px solid #000;">&nbsp;</td>
  </tr>
   <tr>
    <td style="border-bottom:1px solid #000;"><strong>Remarks:</strong> <input type="text" name="gdiRemark"  id="gdiRemark" onkeyup="saveChaalan();" value="<?php echo $userschaalan['gdiRemark']; ?>" style="width:50%" /></td>
  </tr>
   <tr>
     <td style="border-bottom:1px solid #000;">&nbsp;</td>
   </tr>
   <tr>
    <td style="border-bottom:1px solid #000;"><table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td width="25%"><strong>Created By: </strong><?php echo getUserName($userschaalan['addedBy']); ?></td>
        <td width="25%"><input type="text" name="authorizedBy" id="authorizedBy" value="1" style="display:none;"/></td>
		<td width="25%">&nbsp;</td>
        <td width="25%"><strong>Received By: </strong>
		<select name="receivedBy" id="receivedBy" class="form-control" onChange="saveChaalan();">
			<option value="">Select</option>
			<?php
			$select='';
			$where='';
			$rs='';
			$select='*';
			$where=' deletestatus=0 and status=1 order by firstName asc';
			$rs=GetPageRecord($select,'userMaster',$where);
			while($resListing=mysqli_fetch_array($rs)){
			?>
			<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$userschaalan['receivedBy']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['firstName']).' '.strip($resListing['lastName']); ?></option>
			<?php } ?>

		</select>
	</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
				</div>
				</div>

				<input type="hidden" name="module" value="<?php echo $_GET['module']; ?>">
				<input type="hidden" name="styleId" value="<?php echo $_REQUEST['styleId']; ?>">
				<div class="text-right">
					<button type="buttton" style="margin:0px;" class="btn btn-primary" onclick="window.location.href='<?php echo $fullurl; ?>showpage.crm?module=chaalanmaster'">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true"></i></button>


				    <label>

				    </label>
				</div>
				</div>

				</form>

				<div id="savechaalandetail"></div>
<script>
function saveChaalan(){
var departmentId = $('#departmentId').val();
var fromDepartmentId = $('#fromDepartmentId').val();
var gdiRemark = encodeURI($('#gdiRemark').val());
var chargesDetail = encodeURI($('#chargesDetail').val());
var styleId = '<?php echo $_REQUEST['styleId']; ?>';
var chaalanId = '<?php echo encode($chaalanLastId); ?>';
var fromFactoryId = $('#fromFactoryId').val();
var toFactoryId = $('#toFactoryId').val();
var authorizedBy = $('#authorizedBy').val();
var receivedBy = $('#receivedBy').val();
var supervisor = encodeURI($('#supervisor').val());

if(departmentId==19){
	$('.nochallan').hide()
	$('.forchallan').show()
}else{
	$('.forchallan').hide()
	$('.nochallan').show()
}

$('#savechaalandetail').load('savechaalandetail.php?action=savechaalanparentdetail&id='+chaalanId+'&departmentId='+departmentId+'&fromDepartmentId='+fromDepartmentId+'&gdiRemark='+gdiRemark+'&chargesDetail='+chargesDetail+'&styleId='+styleId+'&fromFactoryId='+fromFactoryId+'&toFactoryId='+toFactoryId+'&authorizedBy='+authorizedBy+'&receivedBy='+receivedBy+'&supervisor='+supervisor);

}
saveChaalan();
</script>
<?php } ?>