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
	<div class="page-content">

		<div class="content-wrapper">
		 <?php include "savealert.php"; ?>

 	<div class="content pt-0" style="margin-top:20px;">


  	<?php include "top-style.php"; ?>


				<div class="row">

				<div class="col-xl-12">

				<div class="card">


				<div class="table-responsive">
			 			<table width="100%" class="table table-bordered table-responsive" style="margin-bottom:5px;">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body" style="text-align: center; background-color: #e1f1ff;">
                                <td width="100%" style="text-align:center;"><strong style="font-size: 16px; font-weight: 500;">LEAD TIME SYNOPSIS</strong></td>

                            </tr>
                          </tbody>
                        </table>
						<style>
.buyer-address td{
border:0px solid;
padding:0px;
}
</style>

					    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered table-responsive forbom summaryfinal" style="display: block; overflow: hidden; margin-bottom: 15px;">
                          <tbody style="width: 100%;display: inline-table;">


							<tr class="card-body" style="background-color: #f9f9f9;">
							  <td width="17%" align="left"><div align="center"><strong>TTL ORDER LEAD TIME </strong></div></td>
							<td width="15%" align="left"><div align="center"><strong>TTL FABRIC LEAD TIME </strong></div></td>
							<td width="17%" align="left"><div align="center"><strong>MERCHANDISING LEAD TIME </strong></div></td>
							<td width="29%" align="left"><div align="center"><strong>PRODUCTION LEAD TIME (INC. R&amp;D)</strong></div></td>
							</tr>
							<?php

///////////////////////////////////////////////////////////
$exfastaDataq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$editresultstyle['id'].'" and temid="'.$editresultstyle['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=47)');
$exfastaData=mysqli_fetch_array($exfastaDataq);
//////////////////////////////////////////////////////////
$ocdq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$editresultstyle['id'].'" and temid="'.$editresultstyle['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=3)');
$ocdData=mysqli_fetch_array($ocdq);
///////////////////////////////////////////////////////////
$fabricinhousstDataq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$editresultstyle['id'].'" and temid="'.$editresultstyle['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=22)');
$fabricinhousstData=mysqli_fetch_array($fabricinhousstDataq);
///////////////////////////////////////////////////////////
$filehanderDataq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$editresultstyle['id'].'" and temid="'.$editresultstyle['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=38)');
$filehanderData=mysqli_fetch_array($filehanderDataq);
///////////////////////////////////////////////////////////
$exfacendDataq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$editresultstyle['id'].'" and temid="'.$editresultstyle['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=49)');
$exfacendData=mysqli_fetch_array($exfacendDataq);
///////////////////////////////////////////////////////////
$cuttingstatrDataq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$editresultstyle['id'].'" and temid="'.$editresultstyle['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=42)');
$cuttingstatrData=mysqli_fetch_array($cuttingstatrDataq);

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$ttlorderleadtime=date_diff(date_create($exfastaData['complitionDate']),date_create($ocdData['complitionDate']));
$ttfabricleadtime=date_diff(date_create($fabricinhousstData['complitionDate']),date_create($ocdData['complitionDate']));
$merhcleadtime=date_diff(date_create($filehanderData['complitionDate']),date_create($ocdData['complitionDate']));
$prodleadtime=date_diff(date_create($exfacendData['complitionDate']),date_create($cuttingstatrData['complitionDate']));

							  ?>
							<tr class="card-body" style="background-color: #f9f9f9;">
							  <td width="17%" align="left"><div align="center"><?php echo str_replace('-','',$ttlorderleadtime->format("%R%a Days")); ?></div></td>
							<td width="15%" align="center"><div align="center"><?php echo str_replace('-','',$ttfabricleadtime->format("%R%a Days")); ?></div></td>
							<td width="17%" align="center"><div align="center"><?php echo str_replace('-','',$merhcleadtime->format("%R%a Days")); ?></div></td>
							<td width="29%" align="center"><div align="center"><?php echo str_replace('-','',$prodleadtime->format("%R%a Days")); ?></div></td>
							</tr>
                          </tbody>
                        </table>

				  </div>



				</div>


		 <?php
		$i = 0;
		$buyerstatus=0;
		$costsheetVersionId='0';
		$selectversion='*';
		$whereversion='styleId="'.decode($_GET['styleid']).'" and versionId in(select defaultcostsheetVersionId from queryMaster where defaultcostsheetVersionId>0 and id="'.decode($_GET['styleid']).'")';
		$rsversion=GetPageRecord($selectversion,'costsheetVersionMaster',$whereversion);
		while($resListingVer=mysqli_fetch_array($rsversion)){
		$costsheetVersionId = $resListingVer['versionId'];
		$buyerCostStatus=$resListingVer['buyerCostStatus'];
		$i++;

		if($resListingVer['buyerCostStatus']==0){ ?>
          <style>
		.btn-primaryy<?php echo $resListingVer['buyerCostStatus']; ?>{ display:none !important;}
		</style>
          <?php } ?>


		<div id="accordion-group<?php echo $resListingVer['id']; ?>" style="margin-bottom: 10px;">



		<div class="card mb-0 rounded-bottom-0">

<style>

.abcspecial-class:hover{
cursor:pointer;
background-color: #d8ff001f !important;
}
</style>


		<div class="abcspecial-class card-header collapsed" data-toggle="collapse" href="#accordion-item-group<?php echo $resListingVer['id']; ?>">
			<h6 class="card-title "> <a onclick="showfobbydefault<?php echo $costsheetVersionId;?>();" data-toggle="collapse" href="#accordion-item-group<?php echo $resListingVer['id']; ?>" class="text-default collapsed" style="color: #000000; width: fit-content; float: left; display: inline-block;margin-bottom: 10px;">BOM</strong></a> <a onclick="showfobbydefault<?php echo $costsheetVersionId;?>();" class="text-default collapsed" data-toggle="collapse" href="#accordion-item-group<?php echo $resListingVer['id']; ?>" aria-expanded="false" style="text-align: left; color: #000; font-size: 13px; width: fit-content; float: left; margin-top: 2px; margin-left: 2px;">-&nbsp;<?php echo date('d M, Y - h:ia',$resListingVer['dateAdded']); ?></a>
                  <?php
				$rssssversion=GetPageRecord('id','costsheetVersionMaster','styleId="'.decode($_GET['styleid']).'" and buyerCostStatus=1');
				$countbuyerstatus=mysqli_num_rows($rssssversion);
				if($countbuyerstatus==0){
				?>
                  <button type="button" class="btn btn-danger" style="float: right; margin: 0px; margin-bottom: 10px; display:none;" onclick="duplicateCostsheet<?php echo $costsheetVersionId; ?>();">Create Buyer Cost Sheet <i class="fa fa-copy ml-2" aria-hidden="true" style="margin:0px;"></i></button>
                  <?php } ?>
                  <style>
div.options > label > input {
    visibility: hidden;
}

.options{
width: fit-content; float: right; margin-right: 0px; font-size: 13px;
}

div.options > label {
    display: block;
    margin: 0 0 0 -10px;
    padding: 0px;
    height: 20px;
    width: fit-content;
}

div.options > label > img {
    display: inline-block;
    padding: 0px;
    height: 18px;
    margin-left: 5px;
    width: 20px;
}

div.options > label > input:checked +img {
    background: url(http://cdn1.iconfinder.com/data/icons/onebit/PNG/onebit_34.png);
    background-repeat: no-repeat;
    background-position: center center;
    background-size: 10px 10px;
}


</style>
                  <script>
function showfobbydefault<?php echo $costsheetVersionId;?>(){
var showfobdefault = $('#showfobdefault<?php echo $costsheetVersionId;?>').css('display');
	 if(showfobdefault=='block'){
	 $('#showfobdefault<?php echo $costsheetVersionId;?>').css('display','none');
	 } else {
	 $('#showfobdefault<?php echo $costsheetVersionId;?>').css('display','block');
	 }
}
</script>
                  <?php
$rs31=GetPageRecord('*','costsheetVersionMaster','styleId="'.$lastId.'" and versionId="'.$costsheetVersionId.'"');
$resListing31=mysqli_fetch_array($rs31);

$totalmrp=$resListing31['totalmrp'];
$mrptotallast=$resListing31['mrptotallast'];
$finalgrandtotalwithmrp =$resListing31['finalgrandtotalwithmrp'];
?>

                  <div id="savecostsheetversion<?php echo $costsheetVersionId;?>" name="savecostsheetversion<?php echo $costsheetVersionId;?>" style="display:none;"></div>
                  <script>
function submitcostsheetver<?php echo $costsheetVersionId;?>(vid){

var x = confirm("Are you sure you want to set as default?");
if (x == true) {
$('#savecostsheetversion<?php echo $costsheetVersionId;?>').load("load_costsheet_version.php?styleId=<?php echo $editresultstyle['id'];?>&costsheetVersionId=<?php echo $costsheetVersionId; ?>&action=setdefault");
} else{

}
location.reload();
}
</script>
              </h6>

		</div>

		<div id="accordion-item-group<?php echo $resListingVer['id']; ?>" class="collapse" data-parent="#accordion-group<?php echo $resListingVer['id']; ?>">


			<div class="card-body" style="padding:0px;">
		<div id="collapsible-control-right-group<?php echo $i; ?>" class="collapse" style="display:block;">
				<div class="card-body">



				<div class="tab-content">
						<fieldset class="card-body" style="padding: 10px;">

<form action="ac.crm" method="post" class="submitstyleform" enctype="multipart/form-data" name="techPackFormV<?php echo $i; ?>" target="techpackiframe<?php echo $i; ?>" id="techPackFormV<?php echo $i; ?>" style="">
<input type="hidden" name="action2" value="techpackversion" />
<input type="hidden" name="versionId" value="<?php echo encode($resListingVer['versionId']); ?>" />
<input type="hidden" name="editId" value="<?php echo encode($lastId); ?>">
<input type="hidden" name="module" value="<?php echo $_GET['module']; ?>">
<div class="row" id="load_bom_list<?php echo $costsheetVersionId; ?>">  </div>

			<div class="text-right" style="width: 100%;display: block;margin-top: 25px;">
			<?php
							if($_SESSION['userid']==1){
							?>
							<a href="#" class="btn btn-success"> <i class="fa fa-shirtsinbulk  mr-3" aria-hidden="true"></i>Approve</a>
			  				<?php
							}else{
							$where='';
							$where=' 1 and pageId=3 and buyerId="'.$editresultstyle['buyerId'].'" and brandId="'.$editresultstyle['brandId'].'" and profileId="'.$loginuserprofileId.'" and (assignTo="'.$_SESSION['userid'].'" or assignTo="0")';
							$rsapp=GetPageRecord('*','resourceApprovalBrandWise',$where);
							$resListingApp=mysqli_fetch_array($rsapp);
							if($resListingApp['assignTo']!=''){
							?>
							<a href="#" class="btn btn-success"> <i class="fa fa-shirtsinbulk  mr-3" aria-hidden="true"></i>Approve</a>
			  				<?php }
							 } ?>


			 <!-- <button type="button" class="btn btn-primary" style=" float: left;">Create Duplicate<i class="fa fa-copy ml-2" aria-hidden="true" style="margin:0px;"></i></button>  -->


			<button type="button" onclick="delete_material<?php echo $costsheetVersionId; ?>();delete_material_extra<?php echo $costsheetVersionId; ?>();addfinaldata<?php echo $costsheetVersionId; ?>();" class="btn btn-primary" style="margin:0px;">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>

			</div>


</form>



<script>
function load_bom_list_fun<?php echo $costsheetVersionId; ?>(){
$('#load_bom_list<?php echo $costsheetVersionId; ?>').load("load_bom_list.php?styleId=<?php echo $editresultstyle['id'];?>&subCategoryId=<?php echo $editresultstyle['subCategoryId'];?>&page=addbom&costsheetVersionId=<?php echo $costsheetVersionId; ?>");
}

load_bom_list_fun<?php echo $costsheetVersionId; ?>();

 </script>


					  </fieldset>
					</div>



			    </div>


</div>







			</div>
		</div>
	</div>



</div>

		<?php } ?>
</div>

			</div>

		</div>

	</div>


