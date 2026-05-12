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
border:1px solid #ccc!important;
padding:0.55rem!important;
}
 .erptab1 tr td{
border:0px solid #ccc!important;
padding:0.55rem!important;
}
 .erptab1{
border:1px solid #ccc!important;
}
.erpint{
    border: 1px solid #b3acac;
    padding: 3px;
}
</style>
<?php

$rs1=GetPageRecord($select,'amendmentMaster','id="'.decode($_GET['id']).'"');
$editresult1=mysqli_fetch_array($rs1);


$rsamd=GetPageRecord('*','bomAmendment','amendmentId="'.$editresult1['id'].'"');
$rsamdList=mysqli_fetch_array($rsamd);

$rstype=GetPageRecord('name','materialTypeMaster','id="'.$rsamdList['materialType'].'"');
$resListingType=mysqli_fetch_array($rstype);

$rsCategory=GetPageRecord('name','categoryMaster','1 order by name desc');
$rsCategoryListing=mysqli_fetch_array($rsCategory);

$name=$rsCategoryListing['name'];

$name = rtrim($rsCategoryListing['name'],',');

?>


<div class="page-content">
  <?php include "left.php"; ?>
  <div class="content-wrapper">
    <div class="content pt-0" style="margin-top:20px;">
      <?php include "top-style.php"; ?>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
		  <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
            <div style="padding: 20px;">
              <table class="table erptab table-hover" style="width:100%">

				<tr style="background-color: #0288d1;color:#ffff">
					<td colspan="9" align="left">Amendment Number - <?php echo $editresult1['amendNumber']; ?></td>
				</tr>
				<tr style="background-color: #969696; color: #fff; font-weight: 600;">
                 <td colspan="9" align="left"><span> </span>
					<div style=""> <span style="color:#e4ff04;">Impact </span>
					<?php if($editresult1['sectionType']==''){ ?>
					<?php echo '- '; echo $resListingType['name']; ?> - <?php
					$rsunit11=GetPageRecord('name','styleSubCategoryMaster','id="'.$rsamdList['stylesubtabid'].'"');
					$resListingunit11=mysqli_fetch_array($rsunit11);
					echo $resListingunit11['name'];
					?>
					<?php } ?>
					</div>
				 </td>
                </tr>
				<tr style=" font-weight:700;">
					<td>Amendment Type</td>
					<td>Reason</td>
					<td>Before</td>
					<td>After</td>
					<td>Status</td>
				</tr>
				<tr >
					<td><?php
					$rs=GetPageRecord('name','amendmentTypeMaster','id="'.$editresult1['amendType'].'"');
					$resList=mysqli_fetch_array($rs);
					echo $resList['name'];
					?></td>
					<td><?php
					$rs1=GetPageRecord('name','reasonMaster','id="'.$rsamdList['reason'].'"');
					$resList1=mysqli_fetch_array($rs1);
					echo $resList1['name'];
					?></td>

					<!----Sales order change---->
					<?php if($editresult1['sectionType']==''){ ?>
					<?php if($rsamdList['bomAvgOld']!=$rsamdList['bomAvg']){ ?>
					<td><?php echo $rsamdList['bomAvgOld']; ?></td>
					<td><?php echo $rsamdList['bomAvg']; ?></td>
					<?php } ?>
					<?php if($rsamdList['bomWidthOld']!=$rsamdList['bomWidth']){ ?>
					<td><?php echo $rsamdList['bomWidthOld']; ?></td>
					<td><?php echo $rsamdList['bomWidth']; ?></td>
					<?php } ?>
					<?php if($rsamdList['bomUnitOld']!=$rsamdList['bomUnit']){ ?>
					<td><?php echo $rsamdList['bomUnitOld']; ?></td>
					<td><?php echo $rsamdList['bomUnit']; ?></td>
					<?php } ?>
					<?php if($rsamdList['wastagePersentOld']!=$rsamdList['wastagePersent']){ ?>
					<td><?php echo $rsamdList['wastagePersentOld']; ?></td>
					<td><?php echo $rsamdList['wastagePersent']; ?></td>
					<?php } ?>
					<?php if($rsamdList['matPriceOld']!=$rsamdList['matPrice']){ ?>
					<td><?php echo $rsamdList['matPriceOld']; ?></td>
					<td><?php echo $rsamdList['matPrice']; ?></td>
					<?php } ?>
					<?php } ?>


					<!----Sales order change---->
					<?php if($editresult1['sectionType']=='saleorder'){ ?>
					<?php if($rsamdList['finishOld']!=$rsamdList['finish']){ ?>
					<td><?php echo $rsamdList['finishOld']; ?></td>
					<td><?php echo $rsamdList['finish']; ?></td>
					<?php } ?>
					<?php if($rsamdList['colorOld']!=$rsamdList['color']){ ?>
					<td><?php echo $rsamdList['colorOld']; ?></td>
					<td><?php echo $rsamdList['color']; ?></td>
					<?php } ?>
					<?php if($rsamdList['sizeOld']!=$rsamdList['size']){ ?>
					<td><?php echo $rsamdList['sizeOld']; ?></td>
					<td><?php echo $rsamdList['sie']; ?></td>
					<?php } ?>
					<?php if($rsamdList['gdQtyOld']!=$rsamdList['gdQty']){ ?>
					<td><?php echo $rsamdList['gdQtyOld']; ?></td>
					<td><?php echo $rsamdList['gdQty']; ?></td>
					<?php } ?>
					<?php } ?>
					<td>
					<?php if($editresult1['status']==0){ ?><span class="badge" style="cursor:pointer;background-color:#e83333; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;" onclick="funcChangeAmend('<?php echo encode($editresult1['id']); ?>','<?php echo $editresult1['sectionType']; ?>');">Pending</span><?php }else{ ?><span class="badge" style="cursor:pointer;background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;">Approved</span><?php } ?>
					</td>
				</tr>
              </table>
              <p>&nbsp;</p>
<?php
$rs31=GetPageRecord('*','costsheetVersionMaster','styleId="'.$rsamdList['styleId'].'" and versionId="'.$rsamdList['costsheetVersionId'].'"');
$resListing31=mysqli_fetch_array($rs31);

?>
			  <table class="table erptab table-hover" style="width:100%">
                <tr style=" font-weight:700;">
					<td>FOB Price</td>
					<td>Revised FOB Price</td>
					<td>Requested Date</td>
					<td>Approve Date</td>
				</tr>
				<tr style="">
					<td><input type="text" name="fobPrice" id="fobPrice" value="<?php echo $resListing31['fobpricenew']; ?>" class="form-control" readonly/></td>
					<td><input type="text" name="newFobPrice" id="newFobPrice" value="<?php echo $rsamdList['newFobPrice']; ?>" class="form-control" /></td>
					<td><?php echo date('d-m-Y',strtotime($editresult1['requestedDate'])); ?></td>
					<td><?php if($editresult1['status']==1){ echo date('d-m-Y',strtotime($editresult1['approvedDate'])); }else{ echo '-'; } ?></td>
				</tr>
              </table>
			  <p>&nbsp;</p>
              <table cellspacing="0" cellpadding="8" border="1" style="border:1px solid #ccc;">
                <tr height="21" style="font-weight:600;background-color: #0288d1; color:#FFFFFF;">
                  <td colspan="11" height="21" width="1657">AMENDMENT IMPACT &amp; DETAIL</td>
                </tr>
                <tr>
                  <th>Color</th>
                 <?php if($editresult1['amendType']=='1' || $editresult1['amendType']=='10'){ ?> <th>Original Material&nbsp;(Qty)</th>
                  <th>Revised Material&nbsp;(Qty)</th><?php } ?>
                  <th>Upcharge Received</th>
				  <th>Liability Value</th>
				  <th>Liability Owner</th>
				  <th>Liability Settlement Date</th>
				  <th>Liability Allocation</th>
                  <th>Initial Price</th>
                  <th>Revised Price</th>
                </tr>
                <tr>
                 <!-- <td><?php echo $rsamdList['finish']; ?></td>-->
                  <td><?php
					$where='id="'.$rsamdList['color'].'"';
					$rs11=GetPageRecord('name','colorCardMaster',$where);
					$resListing11=mysqli_fetch_array($rs11);
					echo $resListing11['name'];
				   ?></td>
                  <?php if($editresult1['amendType']=='1' || $editresult1['amendType']=='10'){
				  $rs113=GetPageRecord('*','styleSubCategoryMaster','id="'.$rsamdList['stylesubtabid'].'"');
				  $resListing113=mysqli_fetch_array($rs113);

				  $rs121=GetPageRecord('*','techPackDetailMaster',' stylesubtabid="'.$resListing113['id'].'" and sectionType="bom" and styleId="'.decode($_GET['styleid']).'" order by id asc');
				$resListing12=mysqli_fetch_array($rs121);
				$totalMaterialQty =  round($editresultstyle['orderQty']*$resListing12['avgIncWastage'],3);
				  ?>
				  <td><?php  echo $totalMaterialQty; ?></td>
                  <td><?php  echo $totalMaterialQty; ?></td><?php } ?>
                  <td>
				  <select name="upCharge" class="form-control" onchange="upChargeFunc(this.value);">
				  	<option>Select</option>
				  	<option value="Yes" <?php if($rsamdList['upCharge']=="Yes"){ echo 'selected';}?>>Yes</option>
					<option value="No" <?php if($rsamdList['upCharge']=="No"){ echo 'selected';}?>>No</option>
				  </select></td>
                  <td><input type="text" name="liablityValue" value="<?php echo $rsamdList['liablityValue']; ?>" class="form-control"/></td>
                  <td>
				   <select name="liablityOwner" class="form-control">
				  	<option value="Brand" <?php if($rsamdList['liablityOwner']=="Brand"){ echo 'selected';}?>>Brand</option>
					<option value="Modelama" <?php if($rsamdList['liablityOwner']=="Modelama"){ echo 'selected';}?>>Modelama</option>
					<option value="Supplier" <?php if($rsamdList['liablityOwner']=="Supplier"){ echo 'selected';}?>>Supplier</option>
					<option value="NA" <?php if($rsamdList['liablityOwner']=="NA"){ echo 'selected';}?>>NA</option>
				  </select>
				  </td>
                  <td><input type="text" name="liablitySattleDate" id="liablitySattleDate" value="<?php if($rsamdList['liablitySattleDate']=='0000-00-00' || $rsamdList['liablitySattleDate']=='1970-01-01'){ echo  '';  }else{ echo date('d-m-Y',strtotime($rsamdList['liablitySattleDate'])); } ?>" class="form-control" readonly/></td>
                  <td><input type="text" name="liablityAllocation" value="<?php echo $rsamdList['liablityAllocation']; ?>" class="form-control"/></td>
                  <td><?php echo $rsamdList['matPriceOld']; ?></td>
                  <td><?php echo $rsamdList['matPrice']; ?></td>
                </tr>
              </table>
<script>
function upChargeFunc(val){


	if(val=="Yes"){
		$('#newFobPrice').val(0);
	}else if(val=="No"){
		var fobPrice = $('#fobPrice').val();
		$('#newFobPrice').val(fobPrice);
	}else{
		$('#newFobPrice').val(0);
	}

}
upChargeFunc('<?php echo $rsamdList['upCharge']; ?>');
</script>
			<input type="hidden" name="action" value="viewamendaction"  />
			<input type="hidden" name="styleId" value="<?php echo $_GET['styleid']; ?>"  />
			<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"  />
			<input type="hidden" name="module" value="<?php echo $_GET['module']; ?>"  />
			<p>&nbsp;</p>
			<div class="text-right">
					<button type="submit" style="margin:0px;" class="btn btn-primary">Save<i class="fa fa-paper-plane ml-2" aria-hidden="true"></i></button>
			</div>
            </div>
		</form>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script>
$(function(){
	$( "#liablitySattleDate" ).datepicker();
});

function funcChangeAmend(amdid,sectionType){
	var conf = confirm('Are you sure you want to approve this?');
	if(conf==true){
	window.location.href = 'showpage.crm?module=<?php echo $_GET['module']; ?>&status=1&id='+amdid+'&sectionType='+sectionType; //delete style
	}
}
</script>
<style>
#marketingteam .owl-carousel .owl-nav button.owl-next, .owl-carousel .owl-nav button.owl-prev, .owl-carousel button.owl-dot {
	position: absolute;
	top: 40% !important;
	right: 19% !important;
	font-size: 40px !important;
	outline: none !important;
	text-decoration: none !important;
}

#marketingteam .owl-carousel .owl-nav button.owl-next, .owl-carousel .owl-nav button.owl-prev, .owl-carousel button.owl-dot {
    position: absolute;
    top: 40%;
    right: 19% !important;
    font-size: 40px !important;
    outline: none !important;
    text-decoration: none !important;
}

</style>
