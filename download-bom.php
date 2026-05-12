<?php
ob_start();
include "inc.php";
$assignto='download';
$select='*';

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


// header("Content-type: application/vnd.ms-excel;charset=UTF-8");
// header("Content-Disposition: attachment; filename=\"".$assignto."_".date('d-m-Y-H-i-s').".xls");
// header("Cache-control: private");

?>

<?php

$rs31=GetPageRecord('*','costsheetVersionMaster','styleId="'.decode($_GET['styleid']).'" and versionId="'.$_REQUEST['costsheetVersionId'].'"');

$resListing31=mysqli_fetch_array($rs31);

$totalmrp=$resListing31['totalmrp'];

$mrptotallast=$resListing31['mrptotallast'];

$finalgrandtotalwithmrp =$resListing31['finalgrandtotalwithmrp'];

?>


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

                        <?php

include "inc.php";



if($_REQUEST['loginuserprofileId']=='154'){

$wheresearchassign=' 1 and  FIND_IN_SET('.$_SESSION['userid'].',assignTo) and ';

}elseif($_REQUEST['loginuserprofileId']=='155'){

$wheresearchassign=' 1 and  FIND_IN_SET('.$_SESSION['userid'].',assignToPurMerchant) and ';

}else{

$wheresearchassign=' 1 and ';

}



//=================================Style Data===================================================

$squery=GetPageRecord('*','queryMaster','id="'.$_REQUEST['styleId'].'"');

$styleData=mysqli_fetch_array($squery);



$bquery=GetPageRecord('*',_BUYER_MASTER_,'1 and id="'.$styleData['buyerId'].'"');

$buyerData=mysqli_fetch_array($bquery);



$brquery=GetPageRecord('*','brandMaster','id="'.$styleData['brandId'].'"');

$brandData=mysqli_fetch_array($brquery);



//===============================================================================================================











if($_REQUEST['sr']!='' && $_REQUEST['costsheetVersionId']!=''){



$namevalue121 ='styleId="'.$_REQUEST['styleId'].'",sr="'.$_REQUEST['sr'].'",subCategoryId="'.$_REQUEST['subCategoryId'].'",materialType="'.$_REQUEST['materialtype'].'",costsheetVersionId="'.$_REQUEST['costsheetVersionId'].'",materialid="'.$_REQUEST['materialid'].'"';



addlisting('styleSubCategoryMaster',$namevalue121);



?>

<script>

tabhideshow<?php echo $_REQUEST['materialtype']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();

</script>

<?php

}





if($_REQUEST['updateid']!='' && $_REQUEST['newmaterial']!='' && $_REQUEST['costsheetVersionId']!=''){



$namevalue ='name="'.$_REQUEST['newmaterial'].'"';

$where='id="'.$_REQUEST['updateid'].'"';

updatelisting('styleSubCategoryMaster',$namevalue,$where);

?>

<script>

tabhideshow<?php echo $_REQUEST['materialtype']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();

</script>

<?php

}





if($_REQUEST['materialdescription']!='' && $_REQUEST['id']!='' && $_REQUEST['costsheetVersionId']!='' && $_REQUEST['materialtype']!=''){



$namevalue222 ='materialdescriptionid="'.$_REQUEST['materialdescription'].'",costsheetVersionId="'.$_REQUEST['costsheetVersionId'].'"';

$where222='id="'.$_REQUEST['id'].'"';

updatelisting('styleSubCategoryMaster',$namevalue222,$where222);

?>

<script>

tabhideshow<?php echo $_REQUEST['materialtype']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();

</script>

<?php

}





if($_REQUEST['deleteid']!='' && $_REQUEST['costsheetVersionId']!=''){

deleteRecord('styleSubCategoryMaster','id='.$_REQUEST['deleteid'].'');

deleteRecord('techPackDetailMaster','cid='.$_REQUEST['deleteid'].'');

?>

<script>

//load_bom_list_fun<?php echo $_REQUEST['costsheetVersionId']; ?>();

tabhideshow<?php echo $_REQUEST['materialtype']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();

</script>

<?php

}

?>


                      <table width="100%" class="table table-bordered table-responsive forbom" id="tableid<?php echo $editresultstyle['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" style="display:none;">

  <tbody style="width: 100%;display: inline-table;">

    <tr class="card-body" <?php if($_REQUEST['page']=='marker') { if($resListing['name']!='Fabric') { ?>style="display:none;"<?php }} ?>>

      <td align="center" <?php if($_REQUEST['page']=='marker' || $_REQUEST['page']=='materiallist' || $_REQUEST['page']=='costsheet' || $_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='addbom') {?>style="display:none;"<?php } ?>><div class="btn-group justify-content-center" style="cursor: pointer; float: left; padding: 1px; margin: 0px 0px 8px; border: 1px solid rgb(92, 107, 192); color: rgb(92, 107, 192); border-radius: 2px; font-size: 11px;  display: none;width: 100%; font-weight: 600;" id="materialdeactivatebtn<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" onclick="delteAllMaterial<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>('<?php echo $resListing['id']; ?>','<?php echo $_REQUEST['costsheetVersionId']; ?>');">Delete</div>

        <input  name="materialCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="checkbox" class="checkalldeletematerial" id="materialCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" style="height: 15px;width: 15px;margin-top: 0;text-align: center;" />

      </td>

      <?php if($_REQUEST['loginuserprofileId']!='154' && $_REQUEST['loginuserprofileId']!='155'){ ?>

      <td align="center" <?php if($_REQUEST['page']!='materiallist') {?>style="display:none;"<?php } ?>><input  name="incCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="checkbox" class="style1" id="incCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" style="height: 17px; width: 30px; margin-top: 4px; text-align: center;" /></td>

      <?php } ?>

      <?php if($_REQUEST['loginuserprofileId']=='154'){ ?>

      <td align="center" <?php if($_REQUEST['page']!='materiallist') {?>style="display:none;"<?php } ?>><input  name="purchasemerchantincCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="checkbox" class="style1" id="purchasemerchantincCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" style="height: 17px; width: 30px; margin-top: 4px; text-align: center;" /></td>

      <?php } ?>

      <style>

.foranalysismateriallist{

	width:160px !important;

}

</style>

      <td align="left" ><strong>Material&nbsp;Id</strong></td>

      <td align="left"><strong>Material&nbsp;Name</strong></td>

      <td align="left"><strong>Description</strong></td>

      <td align="left" <?php if($_REQUEST['page']=='sampleanalysematerial' || $_REQUEST['page']=='samplingbom' || $_REQUEST['page']=='materiallist'){ ?> style="display:none;" <?php } ?>><strong>Finish</strong></td>

      <td align="center" class="<?php if($_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='marker') { ?>foranalysismateriallist<?php } ?>" <?php if($_REQUEST['page']=='materiallist' || $_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='costsheet'){ ?> style="display:none;" <?php } ?>><strong>Width/Size</strong></td>

      <td align="center" <?php if($_REQUEST['page']=='prototypesample'){ ?> style="display:none;" <?php } ?>><strong>Avg/Qty</strong></td>

      <td align="center" <?php if($_REQUEST['page']=='prototypesample'){ ?> style="display:none;" <?php } ?>><strong>UOM</strong></td>

      <td align="center" <?php if($_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='marker' || $_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='sampleanalysematerial'){ ?> style="display:none;" <?php } ?>><strong>Wastage%</strong></td>

      <td align="center" <?php if($_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='marker' || $_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='sampleanalysematerial'){ ?> style="display:none;" <?php } ?>><strong>Avg&nbsp;Inc.&nbsp;Wastage</strong></td>

      <td align="center" <?php if($_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='marker' || $_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='sampleanalysematerial'){ ?> style="display:none;" <?php } ?>><strong>Price</strong></td>

      <td align="center" <?php if($_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='marker' || $_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='sampleanalysematerial'){ ?> style="display:none;" <?php } ?>><strong>Currency</strong></td>

      <td align="center" style="display:none;"><strong>INR</strong></td>

      <td align="center" style="display:none;"><strong>USD</strong></td>

      <td align="center" <?php if($_REQUEST['page']=='marker' || $_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='sampleanalysematerial' || $_REQUEST['page']=='samplingbom'){ ?> style="display:none;" <?php } ?>><strong>Landing&nbsp;Cost(%)</strong></td>

      <td align="center" <?php if($_REQUEST['page']=='marker' || $_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='sampleanalysematerial' || $_REQUEST['page']=='samplingbom'){ ?> style="display:none;" <?php } ?>><strong>Landed&nbsp;Cost</strong></td>

      <td align="center" <?php if($_REQUEST['page']=='marker' || $_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='sampleanalysematerial'){ ?> style="display:none;" <?php } ?>><strong>Material&nbsp;Cost</strong></td>

      <td align="center" <?php if($_REQUEST['page']!='addbom' && $_REQUEST['page']!='analysemateriallist'){ ?> style="display:none;" <?php } ?>><strong>Component Location</strong></td>

      <?php

$colorq=GetPageRecord('colorId','styleColorDetailMaster','1 and styleId="'.decode($_GET['styleid']).'" order by id asc');

while($styleData=mysqli_fetch_array($colorq)){



$colornameq=GetPageRecord('name','colorCardMaster','1 and id="'.$styleData['colorId'].'"');

$colorNameQuery=mysqli_fetch_array($colornameq);



?>

      <td align="center" <?php if($_REQUEST['page']!='addbom' && $_REQUEST['page']!='samplingbom'){ ?> style="display:none;" <?php } ?>><strong><?php echo $resListing['name']; ?> Color for style <br />

        <?php echo $colorNameQuery['name']; ?></strong></td>

      <?php } ?>

      <style>

.bomhideshow {

display:none;

}

</style>

      <script>

$(".bomhideshowsecond").on('click', function(event){

     $('.bomhideshow').removeClass('bomhideshow');

	 $('.bomhideshowsecond').addClass('bomhideshow');

});



</script>

      <td align="center"><strong>Color&nbsp;Standard Approval</strong> </td>

      <td align="center" <?php if($_REQUEST['page']=='marker' || $_REQUEST['page']=='sampleanalysematerial' || $_REQUEST['page']=='samplingbom'){ ?> style="display:none;" <?php } ?>><strong>Merchant Comment</strong></td>

	   <td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?>><strong>Amendment</strong></td>

      <td align="center" style=" <?php if($_REQUEST['page']=='marker' || $_REQUEST['page']=='sampleanalysematerial' || $_REQUEST['page']=='samplingbom') { ?> display:none; <?php } ?> "><strong>Remarks</strong></td>
		<?php if($_REQUEST['page']=='sampleanalysematerial') { ?> <td align="center" style=" "><strong>Artwork&nbsp;No</strong></td> <?php } ?>
		<?php if($_REQUEST['page']=='sampleanalysematerial') { ?><td align="center" style="  "><strong>CAD&nbsp;Given Date</strong></td> <?php } ?>
		<?php if($_REQUEST['page']=='sampleanalysematerial') { ?><td align="center" style=" "><strong>Lab&nbsp;dip/Strike off Approval</strong></td> <?php } ?>
		<?php if($_REQUEST['page']=='sampleanalysematerial') { ?><td align="center" style=" "><strong>Lab&nbsp;dip/Strike off Approval</strong></td> <?php } ?>


      <td align="center" class="bomhideshowsecond" style=" position:relative; cursor:pointer; <?php if($_REQUEST['page']!='addbom'){ ?> display:none; <?php } ?> "><span style="position: absolute; top: 53px; right: -43px; color: #7985cb; font-weight: 600; transform: rotate(-91deg);"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;Bom&nbsp;Approved&nbsp;Status</span></td>

      <td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?> class="bomhideshow"><strong>Supplier&nbsp;Article&nbsp;No.</strong></td>

      <td align="center"  class=""><strong>Supplier&nbsp;Name</strong></td>

      <td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?> class="bomhideshow"><strong>Buyer&nbsp;Nominated</strong></td>

      <td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?> class="bomhideshow"><strong>Trim&nbsp;Image</strong></td>

      <td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?> class="bomhideshow"><strong>FINAL&nbsp;DATE&nbsp;FOR STANDARD&nbsp;HANDOVER</strong></td>

      <td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?> class="bomhideshow"><strong>MATERIAL&nbsp;BOOKING FINAL&nbsp;DATE</strong></td>

      <td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?> class="bomhideshow"><strong>FINAL&nbsp;FOR APPROVAL</strong></td>

      <td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?> class="bomhideshow"><strong>LEAD TIME</strong></td>

      <td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?> class="bomhideshow"><strong>TRANSIT TIME</strong></td>

      <td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?> class="bomhideshow"><strong>MATERIAL&nbsp;DISPATCH FINAL&nbsp;DATE</strong></td>

      <td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?> class="bomhideshow"><strong>IN/H&nbsp;DUE&nbsp;DATE</strong></td>

      <td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?> class="bomhideshow"><strong>IN/H&nbsp;ACTUAL DATE</strong></td>

      <td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?> class="bomhideshow"><strong>Q'nty Reqd.</strong></td>

      <td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?> class="bomhideshow"><strong>Q'nty Rcvd.</strong></td>

      <td align="center" style="display:none;"><strong>AMENDMENT DATE (IF ANY)</strong></td>

      <td align="center" <?php if($_REQUEST['page']!='costsheet'){ ?> style="display:none;" <?php } ?>><strong>Add&nbsp;to&nbsp;Cost</strong> </td>

      <td align="center" style="display:none;"><strong>Quality</strong></td>

      <td align="center" style="display:none;"><strong>Color/Size</strong></td>

      <td align="center" style="display:none;"><strong>Status</strong></td>

      <?php if($_REQUEST['loginuserprofileId']!='154' && $_REQUEST['loginuserprofileId']!='155'){ ?>

      <td align="center" <?php if($_REQUEST['page']!='materiallist'){ ?> style="display:none;" <?php } ?>><strong>Assign&nbsp;To</strong></td>

      <?php } ?>

      <?php if($_REQUEST['loginuserprofileId']=='154'){ ?>

      <td align="center" <?php if($_REQUEST['page']!='materiallist'){ ?> style="display:none;" <?php } ?>><strong>Assigned&nbsp;Merchant</strong></td>

      <?php } ?>

      <!-- for prototype sample-->

      <td align="center" <?php if($_REQUEST['page']!='prototypesample') { ?> style="display:none;"<?php } ?>><?php if($_REQUEST['loginuserprofileId']!=92) { ?>

        <div class="btn-group justify-content-center" style="cursor: pointer; float: left; padding: 1px; margin: 0px 0px 8px; border: 1px solid rgb(92, 107, 192); color: rgb(92, 107, 192); border-radius: 2px; font-size: 11px;  display: none;width: 100%; font-weight: 600;" id="qualitydeactivatebtn<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" onclick="requestAllQuality<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();opmodalpop('Quality','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=1&id=<?php echo $resListing1['id']; ?>&qualitySend=1','600px','auto');" data-toggle="modal" data-target="#modalpop">Action</div>

        <?php } if($_REQUEST['loginuserprofileId']==92) { ?>

        <div class="btn-group justify-content-center" style="cursor: pointer; float: left; padding: 1px; margin: 0px 0px 8px; border: 1px solid rgb(92, 107, 192); color: rgb(92, 107, 192); border-radius: 2px; font-size: 11px;  display: none;width: 100%; font-weight: 600;" id="qualitydeactivatebtn<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" onclick="requestAllQuality<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();opmodalpop('Quality','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=1&id=<?php echo $resListing1['id']; ?>&fortTimeSlot=11&qualitySend=1','600px','auto');" data-toggle="modal" data-target="#modalpop">Action</div>

        <?php } ?>

        <input  name="qualityCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="checkbox" class="qualityCheckClass" id="qualityCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" style="height: 15px;width: 15px;margin-top: 0;text-align: center;" />

      </td>

      <td align="center" <?php if($_REQUEST['page']!='prototypesample') { ?> style="display:none;"<?php } ?>><strong>Quality</strong></td>

      <td align="center" <?php if($_REQUEST['page']!='prototypesample') { ?> style="display:none;"<?php } ?>><?php if($_REQUEST['loginuserprofileId']!=92) { ?>

        <div class="btn-group justify-content-center" style="cursor: pointer; float: left; padding: 1px; margin: 0px 0px 8px; border: 1px solid rgb(92, 107, 192); color: rgb(92, 107, 192); border-radius: 2px; font-size: 11px;  display: none;width: 100%; font-weight: 600;" id="pricedeactivatebtn<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" onclick="requestAllprice<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();opmodalpop('Price','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=2&id=<?php echo $resListing1['id']; ?>&priceSend=1','600px','auto');" data-toggle="modal" data-target="#modalpop" >Action</div>

        <?php } if($_REQUEST['loginuserprofileId']==92) { ?>

        <div class="btn-group justify-content-center" style="cursor: pointer; float: left; padding: 1px; margin: 0px 0px 8px; border: 1px solid rgb(92, 107, 192); color: rgb(92, 107, 192); border-radius: 2px; font-size: 11px;  display: none;width: 100%; font-weight: 600;" id="pricedeactivatebtn<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" onclick="requestAllprice<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();opmodalpop('Price','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=2&id=<?php echo $resListing1['id']; ?>&fortTimeSlot=11&priceSend=1','600px','auto');" data-toggle="modal" data-target="#modalpop">Action</div>

        <?php } ?>

        <input  name="priceCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="checkbox" class="priceCheckClass" id="priceCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" style="height: 15px;width: 15px;margin-top: 0;text-align: center;" />

      </td>

      <td align="center" <?php if($_REQUEST['page']!='prototypesample') { ?> style="display:none;"<?php } ?>><strong>Price</strong></td>

      <td align="center" <?php if($_REQUEST['page']!='prototypesample') { ?> style="display:none;"<?php } ?>><?php if($_REQUEST['loginuserprofileId']!=92) { ?>

        <div class="btn-group justify-content-center" style="cursor: pointer; float: left; padding: 1px; margin: 0px 0px 8px; border: 1px solid rgb(92, 107, 192); color: rgb(92, 107, 192); border-radius: 2px; font-size: 11px;  display: none;width: 100%; font-weight: 600;" id="vendordeactivatebtn<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" onclick="requestAllvendor<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();opmodalpop('Vendor','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=3&id=<?php echo $resListing1['id']; ?>&vendorSend=1','600px','auto');" data-toggle="modal" data-target="#modalpop">Action</div>

        <?php } if($_REQUEST['loginuserprofileId']==92) { ?>

        <div class="btn-group justify-content-center" style="cursor: pointer; float: left; padding: 1px; margin: 0px 0px 8px; border: 1px solid rgb(92, 107, 192); color: rgb(92, 107, 192); border-radius: 2px; font-size: 11px;  display: none;width: 100%; font-weight: 600;" id="vendordeactivatebtn<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" onclick="requestAllvendor<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();opmodalpop('Vendor','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=3&id=<?php echo $resListing1['id']; ?>&fortTimeSlot=11&vendorSend=1','600px','auto');" data-toggle="modal" data-target="#modalpop">Action</div>

        <?php } ?>

        <input  name="vendorCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="checkbox" class="vendorCheckClass" id="vendorCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" style="height: 15px;width: 15px;margin-top: 0;text-align: center;" />

      </td>

      <td align="center" <?php if($_REQUEST['page']!='prototypesample') { ?> style="display:none;"<?php } ?>><strong>Vendor</strong></td>

      <td align="left" <?php if($_REQUEST['page']!='analysemateriallist' && ($_REQUEST['page']!='sampleanalysematerial' || $resListing['id']!=2)) { ?> style="display:none;"<?php } ?>><?php if($_REQUEST['page']=='sampleanalysematerial'){ ?>

        <strong>Size</strong>

        <?php } else { ?>

        <strong style="width:110px; display:block;">Qty/Pri/Ven

        <?php if($resListing['id']==2){ ?>

        /Size

        <?php } ?>

        </strong>

        <?php } ?></td>

    </tr>

    <?php

	if($_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='marker' || $_REQUEST['page']=='costsheet' || $_REQUEST['page']=='materiallist' || $_REQUEST['page']=='prototypesample'){
	$greigeId = ' and sr<100';
	}

									$N=0;

									$factoryoverheadtext=0;

									$c16text=0;



									$totalpc=0;

									$srtype=0;

									$where22='';

									$rs22='';

									$select22='*';



									if($_REQUEST['page']!='addbom'){

									$where22=''.$wheresearchassign.'  materialType="'.$resListing['id'].'" and styleId="'.decode($_GET['styleid']).'" and costsheetVersionId="'.$_REQUEST['costsheetVersionId'].'" '.$greigeId.' and parentId=0 order by id asc';

									}

									else{



									$where22=''.$wheresearchassign.'  materialType="'.$resListing['id'].'" and styleId="'.decode($_GET['styleid']).'" and costsheetVersionId="'.$_REQUEST['costsheetVersionId'].'" '.$greigeId.' and id not in (select parentId from styleSubCategoryMaster) order by id asc';



									}



									$rs22=GetPageRecord($select22,'styleSubCategoryMaster',$where22);

									$srtype = mysql_num_rows($rs22);

									while($resListing1=mysqli_fetch_array($rs22)){



									$loopst=$srtype;

									$rowno++;

									$sNo1=$rowno;



								//$rs121=GetPageRecord('*','techPackDetailMaster',' bomSerialNo="'.$sNo1.'" and sectionType="bom" and styleId="'.$_REQUEST['styleId'].'" and costsheetVersionId="'.$_REQUEST['costsheetVersionId'].'" order by id asc');



								$rs121=GetPageRecord('*','techPackDetailMaster','stylesubtabid="'.$resListing1['id'].'" and sectionType="bom" and styleId="'.$_REQUEST['styleId'].'" and costsheetVersionId="'.$_REQUEST['costsheetVersionId'].'" order by id asc');



								$resListing12=mysqli_fetch_array($rs121);



						        //$allfunction=$allfunction.'saveallbom'.$_REQUEST['costsheetVersionId'].'('.$sNo1.','.$_REQUEST['costsheetVersionId'].');';



						 $allfunction=$allfunction.'saveallbom'.$_REQUEST['costsheetVersionId'].'('.$resListing1['id'].','.$sNo1.','.$_REQUEST['costsheetVersionId'].');';



								?>

    <tr class="card-body" <?php if($_REQUEST['page']=='marker') { if($resListing['name']!='Fabric') { ?>style="display:none;"<?php }} ?>>

      <td  <?php if($_REQUEST['page']=='marker' || $_REQUEST['page']=='materiallist' || $_REQUEST['page']=='costsheet' || $_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='addbom') {?>style="display:none;"<?php } ?>><div style="width:55px; position:relative;"><i class="icon-add" style="font-size:18px;cursor:pointer;" onClick="add_load_bom_list_fun<?php echo $_REQUEST['costsheetVersionId']; ?>('<?php echo $sNo1; ?>','<?php echo $resListing['id']; ?>','<?php echo $_REQUEST['costsheetVersionId']; ?>','<?php echo $resListing1['id']; ?>');"></i> &nbsp;<i class="icon-trash" style="font-size:18px;cursor:pointer; color:#FF0000;" onClick="delete_load_bom_list_fun<?php echo $_REQUEST['costsheetVersionId']; ?>('<?php echo $resListing1['id']; ?>','<?php echo $resListing['id']; ?>','<?php echo $_REQUEST['costsheetVersionId']; ?>');"></i>

          <!--ADD CHECK ALL DELETE OPTION-->

          <label class="analyselistclass<?php echo $resListing['id']; ?>">

          <input type="checkbox" style="position: absolute; opacity: 1; cursor: pointer; height: 15px; width: 15px; top: 3px; right: -9px;" value="<?php echo $resListing1['id']; ?>" name="analysemateriallistdelete[]" class="deletematerial<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" />

          </label>

        </div></td>

      <?php if($_REQUEST['loginuserprofileId']!='154' && $_REQUEST['loginuserprofileId']!='155'){ ?>

      <td align="center" class="materialcostcheckubcheck" <?php if($_REQUEST['page']!='materiallist') {?>style="display:none;"<?php } ?>><input type="checkbox" value="<?php echo $resListing1['id']; ?>" name="assigntopurchase[]" class="Checkedinc<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" onclick="sendmaterialvalue<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();" style="height: 17px; width: 30px; margin-top: 4px; text-align: center;" />

      </td>

      <?php } ?>

      <?php if($_REQUEST['loginuserprofileId']=='154'){ ?>

      <td align="center" class="materialcostcheckubcheckpurchasemerchant" <?php if($_REQUEST['page']!='materiallist') {?>style="display:none;"<?php } ?>><input type="checkbox" value="<?php echo $resListing1['id']; ?>" name="assigntopurchasemerchant[]" class="purchaseMerchantCheckedinc<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" onclick="sendmaterialvaluepurchasemerchant<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();" style="height: 17px; width: 30px; margin-top: 4px; text-align: center;" />

      </td>

      <?php } ?>

      <input type="hidden" name="materialid<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"  value="<?php echo $resListing1['id']; ?>" />

      <input type="hidden" name="subcategoryid<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"  value="<?php echo $resListing123['id']; ?>" />

      <input type="hidden" name="bomSerialNo<?php echo $sNo1; ?>"  value="<?php echo $sNo1; ?>" />

      <?php

	  $unq=GetPageRecord('materialUniqueId,materialimage,finishId,id','materialMaster','1 and name="'.$resListing1['name'].'" or id="'.$resListing1['materialid'].'"');

	  $uniData=mysqli_fetch_array($unq);

	  ?>

      <td <?php if($_REQUEST['page']!='marker' && $_REQUEST['page']!='analysemateriallist'){ ?> style="width:65px;" <?php } ?>><div style="width: 65px;"> <?php echo $uniData['materialUniqueId']; ?></div></td>

      <td <?php if($_REQUEST['page']!='marker' && $_REQUEST['page']!='analysemateriallist'){ ?> style="width:140px;" <?php } ?>><div style="width: 160px;">

          <?php if($resListing1['name']!='') { ?>

          <?php echo $resListing1['name']; if($resListing1['sizeName']!=""){ ?> for style size <span style="color: #ff0000; margin-left: 0px; font-weight: 600; font-size: 18px;"><?php echo $resListing1['sizeName']; ?></span>

          <?php } } else { ?>

          <script>

function update_load_bom_list_fun<?php echo $resListing1['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>(materialtype,costsheetVersionId){

var newmaterial = encodeURI($('#newmaterial<?php echo $resListing1['id']; ?>').val());



$('#load_bom_list<?php echo $_REQUEST['costsheetVersionId']; ?>').load("load_bom_list.php?styleId=<?php echo $_REQUEST['styleId'];?>&page=<?php echo $_REQUEST['page']; ?>&subCategoryId=<?php echo $_REQUEST['subCategoryId'];?>&updateid=<?php echo $resListing1['id']; ?>&newmaterial="+newmaterial+'&materialtype='+materialtype+'&costsheetVersionId='+costsheetVersionId);

}

</script>

          <select name="newmaterial<?php echo $resListing1['id']; ?>"  id="newmaterial<?php echo $resListing1['id']; ?>" onchange="update_load_bom_list_fun<?php echo $resListing1['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>('<?php echo $resListing['id']; ?>','<?php echo $_REQUEST['costsheetVersionId']; ?>');"  style="width: 100%;padding: 5px;">

            <option value="">Select</option>

            <?php

$a=GetPageRecord('*','materialMaster','materialtype="'.$resListing1['materialType'].'" order by id asc');

while($materiallist=mysqli_fetch_array($a)){

$rsdescold=GetPageRecord('*','materialDescriptionMaster','materialid="'.$materiallist['id'].'"');

$resListingdescriptionold=mysqli_fetch_array($rsdescold);

 ?>

            <option value="<?php echo $materiallist['name'];?>"><?php echo $materiallist['name'];?> <span style="font-weight:700 !important;">(<?php echo $resListingdescriptionold['shortDescription'];?>)</span></option>

            <?php } ?>

          </select>

          <?php  }  ?>

        </div>

        <script>

$(document).ready(function() {

$('#newmaterial<?php echo $resListing1['id']; ?>').select2();

});

</script></td>

      <td <?php if($_REQUEST['page']!='marker' && $_REQUEST['page']!='analysemateriallist'){ ?> style="width:200px;;" <?php } ?>><div style="width: 150px; overflow: hidden; position: relative;">

          <?php

			$rsdesc=GetPageRecord('*','materialDescriptionMaster','materialid="'.$uniData['id'].'"');

			$resListingdescription=mysqli_fetch_array($rsdesc);

			echo stripslashes($resListingdescription['shortDescription']);

			?>

        </div></td>

      <td <?php if($_REQUEST['page']=='sampleanalysematerial' || $_REQUEST['page']=='samplingbom' || $_REQUEST['page']=='materiallist'){ ?> style="display:none;" <?php } ?>><div style="width: 150px; overflow: hidden; position: relative;">

          <select name="finish<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" id="finish<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" style="width: 100%;text-align: center;padding: 5px;display:none;">

            <option value="">Select</option>

            <?php

$fquery=GetPageRecord('*','finishMaster','1 and status=1 order by name');

while($finishData=mysqli_fetch_array($fquery)){ ?>

            <option value="<?php echo $finishData['id']; ?>" <?php if($finishData['id']==$resListing12['finish']){ ?> selected="selected" <?php } ?>><?php echo $finishData['name']; ?></option>

            <?php } ?>

          </select>

          <?php





$finishquery=GetPageRecord('*','finishMaster','id="'.$uniData['finishId'].'"');

$finishDataname=mysqli_fetch_array($finishquery);

echo $finishDataname['name'];

?>

          <script>

$(document).ready(function() {

$('#finish<?php echo $resListing1['id']; ?>').select2();

});

</script>

        </div></td>

      <td align="center" <?php if($_REQUEST['page']=='materiallist' || $_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='costsheet'){ ?> style="display:none;" <?php } ?>><input name="bomWidth<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" onkeyup="value_on_pc<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();calTotalCost<?php echo $resListing['id'].$sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();" type="text" id="bomWidth<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" value="<?php echo $resListing12['bomWidth']; ?>" autocomplete="off"  maxlength="200" style="width: 80px;text-align: center;" placeholder="<?php if($resListing['name']=='Fabric') { ?>Width<?php }else{ ?>Size<?php } ?>" /></td>

      <td align="center" <?php if($_REQUEST['page']=='prototypesample'){ ?> style="display:none;" <?php } ?>><input name="bomAvg<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" onkeyup="value_on_pc<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();calTotalCost<?php echo $resListing['id'].$sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();" type="text" id="bomAvg<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" value="<?php echo $resListing12['bomAvg']; ?>" autocomplete="off"  maxlength="200" style="width: 80px;text-align: center;" placeholder="Avg/Qty" />

      </td>

      <td align="center" <?php if($_REQUEST['page']=='prototypesample'){ ?> style="display:none;" <?php } ?>><select name="bomUnit<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" id="bomUnit<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" value="<?php echo $resListing12['bomUnit']; ?>" style="width: fit-content;text-align: center;padding:5px;">

          <?php

$selectunit='*';

$whereunit='materialtype="'.$resListing['id'].'" order by name asc';

$rsunit=GetPageRecord($selectunit,'unitMaster',$whereunit);

while($resListingunit=mysqli_fetch_array($rsunit)){

?>

          <option value="<?php echo $resListingunit['name']; ?>" <?php if($resListingunit['name']==$resListing12['bomUnit']){ ?> selected <?php } ?>><?php echo $resListingunit['name']; ?></option>

          <?php } ?>

        </select>

      </td>

      <td align="center" <?php if($_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='marker' || $_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='sampleanalysematerial'){ ?> style="display:none;" <?php } ?>><input type="text" name="wastagePersent<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" style="width: 80px;text-align: center;" placeholder="Wastage %" id="wastagePersent<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" value="<?php echo $resListing12['wastagePersent']; ?>" autocomplete="off"  maxlength="200" onkeyup="value_on_pc<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();calTotalCost<?php echo $resListing['id'].$sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();" /></td>

      <td align="center" <?php if($_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='marker' || $_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='sampleanalysematerial'){ ?> style="display:none;" <?php } ?>><input type="text" name="avgIncWastage<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" style="width: 80px;text-align: center;" placeholder="Avg wstg" id="avgIncWastage<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" value="<?php echo $resListing12['avgIncWastage']; ?>" autocomplete="off"  maxlength="200" onkeyup="value_on_pc<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();calTotalCost<?php echo $resListing['id'].$sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();" /></td>

      <td align="center" <?php if($_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='marker' || $_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='sampleanalysematerial'){ ?> style="display:none;" <?php } ?>><input type="text" name="matPrice<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" style="width: 80px;text-align: center;" placeholder="Price" id="matPrice<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" value="<?php echo $resListing12['matPrice']; ?>" autocomplete="off"  maxlength="200" onkeyup="escape_landing_cost<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();value_on_pc<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();calTotalCost<?php echo $resListing['id'].$sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();" /></td>

      <td align="center" <?php if($_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='marker' || $_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='sampleanalysematerial'){ ?> style="display:none;" <?php } ?>><select name="matCurrency<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" id="matCurrency<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" style="width: fit-content; text-align: center; padding: 5px;" onchange="change_currency<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>(this.value);">

          <option value="">Select</option>

          <?php

$cq=GetPageRecord('*','currencyMaster','1 order by id asc');

while($currData=mysqli_fetch_array($cq)){

?>

          <option value="<?php echo $currData['id']; ?>" <?php if($resListing12['matCurrency']!="" && $resListing12['matCurrency']!=0){ if($currData['id']==$resListing12['matCurrency']){ ?> selected <?php } } ?> <?php if($resListing12['matCurrency']=="" || $resListing12['matCurrency']==0){ if($buyerData['buyerCurrency']==$currData['id']){ ?> selected="selected" <?php } } ?>>

          <?php echo $currData['name']; ?>

          </option>

          <?php } ?>

        </select>

      </td>

      <td align="center" style="display:none;"><input name="bomINR<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="text"  id="bomINR<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" onkeyup="escape_landing_cost<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();value_on_pc<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();calTotalCost<?php echo $resListing['id'].$sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();" value="<?php echo $resListing12['bomINR']; ?>" autocomplete="off"  maxlength="200" style="width: 80px;text-align: center;" placeholder="INR" /></td>

      <td align="center" style="display:none;"><input name="bomUSD<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="text"  id="bomUSD<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" onkeyup="convert_inr<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();value_of_rate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();value_on_pc<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();calTotalCost<?php echo $resListing['id'].$sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();" value="<?php echo $resListing12['bomUSD']; ?>" autocomplete="off"  maxlength="200" style="width: 60px;text-align: center;" placeholder="USD" /></td>

      <td align="center" <?php if($_REQUEST['page']=='marker' || $_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='sampleanalysematerial' || $_REQUEST['page']=='samplingbom'){ ?> style="display:none;" <?php } ?>><input name="landingcostper<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="text"  id="landingcostper<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" onkeyup="escape_landing_cost<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();value_of_rate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();value_on_pc<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();calTotalCost<?php echo $resListing['id'].$sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();" value="<?php if($resListing12['landingcostper']==''){ echo 0; } else{ echo $resListing12['landingcostper']; } ?>" autocomplete="off"  maxlength="200" style="width: 80px;text-align: center;" placeholder="Land. Cst." /></td>

      <td align="center" <?php if($_REQUEST['page']=='marker' || $_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='sampleanalysematerial' || $_REQUEST['page']=='samplingbom'){ ?> style="display:none;" <?php } ?>><input name="bomRate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="text"  id="bomRate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" value="<?php echo $resListing12['bomRate']; ?>" autocomplete="off"  maxlength="200" style="width: 80px;text-align: center;" placeholder="Lan. Cost" /></td>

      <td align="center" <?php if($_REQUEST['page']=='marker' || $_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='sampleanalysematerial'){ ?> style="display:none;" <?php } ?>><input name="bomvalueonepc<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="text"  id="bomvalueonepc<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" value="<?php echo $resListing12['bomvalueonepc']; $totalpc=$totalpc+$resListing12['bomvalueonepc']; ?>" autocomplete="off"  maxlength="200" class="price<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" style="width: 80px;text-align: center;" placeholder="Mat. Cost" /></td>

      <td id="loadcurrencyvalue<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" style="display:none;"></td>

      <script>



function change_currency<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>(id){

$('#loadcurrencyvalue<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').load("loadcurrencyvalue.php?id="+id+"&lastId=<?php echo $resListing12['matCurrency']; ?>&sNo1=<?php echo $sNo1; ?>&costsheetVersionId=<?php echo $_REQUEST['costsheetVersionId']; ?>&totalvarcount=<?php echo $totalvarcount; ?>");



}



function convert_inr<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>(){

//var usdvalue = $('#bomUSD<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val();

//var usdvalue = Number(usdvalue*71);

//usdvalue= parseFloat(usdvalue).toFixed(4);

//$('#bomINR<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val(usdvalue);

}



function value_of_rate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>(){

//var inrvalue = $('#bomINR<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val();

//var lancost =  $('#landingcostper<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val();

//var lanper = Number(inrvalue*lancost/100);

//var lanrate =Number(inrvalue)+lanper;

//totalinrandlandcost= parseFloat(lanrate).toFixed(4);

//$('#bomRate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val(totalinrandlandcost);

}



function value_on_pc<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>(){



var bomAvg = Number($('#bomAvg<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val());



var bomRate = Number($('#bomRate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val());





var wastagePersent = Number($('#wastagePersent<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val());



var avgIncWastage = Number(bomAvg*wastagePersent/100);



avgIncWastage = Number(bomAvg+avgIncWastage);

avgIncWastage=parseFloat(avgIncWastage).toFixed(4);



Number($('#avgIncWastage<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val(avgIncWastage));



var wastagePersentfinal=avgIncWastage;



//new code

var bomvalueonepc = Number(bomRate*wastagePersentfinal);





bomvalueonepc= parseFloat(bomvalueonepc).toFixed(4);

$('#bomvalueonepc<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val(bomvalueonepc);

}





function calTotalCost<?php echo $totalvarcount.$sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>(){

 var sum = 0;

    // we use jQuery each() to loop through all the textbox with 'price' class

    // and compute the sum for each loop

    $('.price<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').each(function() {

        sum += Number($(this).val());

    });



   sum= parseFloat(sum).toFixed(4);



    // set the computed value to 'totalPrice' textbox

    $('#totalPrice<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val(sum);



	document.getElementById("totalPrice<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>").innerHTML = sum;



abc_totalgrand_first<?php echo $_REQUEST['costsheetVersionId']; ?>();

abc_totalgrand_second<?php echo $_REQUEST['costsheetVersionId']; ?>();

count_grand_total<?php echo $_REQUEST['costsheetVersionId']; ?>();

calculate_factory_overhead<?php echo $_REQUEST['costsheetVersionId']; ?>();

}



function escape_landing_cost<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>(){



//var usdvalue=0;

//var inrvalue = $('#bomINR<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val();

var lanper=0;

var matpricevalue=0;

var totalinrandlandcost=0;

var matpricevalue = $('#matPrice<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val();



var inrvalue = $('#bomINR<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val();

var lancost =  $('#landingcostper<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val();



if(lancost==0 || lancost==""){

lanper = 0;

}else{

lanper = Number(matpricevalue*lancost/100);

}



var lanrate =Number(matpricevalue)+lanper;

totalinrandlandcost= parseFloat(lanrate).toFixed(4);



$('#bomRate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val(totalinrandlandcost);

}



</script>

      <td align="center" <?php if($_REQUEST['page']!='addbom' && $_REQUEST['page']!='analysemateriallist'){ ?> style="display:none;" <?php } ?>><span style="width:170px;">

        <select name="bomPlacement<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" id="bomPlacement<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" style="width: fit-content; text-align: center; padding: 5px;">

          <option value="">Select</option>

          <?php

$comQ=GetPageRecord('name','componentLocation','1 order by id');

while($compLocaData=mysqli_fetch_array($comQ)){ ?>

          <option value="<?php echo $compLocaData['name']; ?>" <?php if($compLocaData['name']==$resListing12['bomPlacement']){ ?> selected="selected" <?php } ?>><?php echo $compLocaData['name']; ?></option>

          <?php } ?>

        </select>

        </span> </td>

      <?php

$kNo=1;

$colorq=GetPageRecord('colorId','styleColorDetailMaster','1 and styleId="'.$_REQUEST['styleId'].'" order by id asc');

while($styleData=mysqli_fetch_array($colorq)){



?>

      <td align="center" <?php if($_REQUEST['page']!='addbom' && $_REQUEST['page']!='samplingbom'){ ?> style="display:none;" <?php } ?> ><span style="width:125px;">

        <input name="trimColor<?php echo $kNo.$sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="text" id="trimColor<?php echo $kNo.$sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" value="<?php echo $resListing12['trimColor'.$kNo]; ?>" autocomplete="off"  maxlength="200" placeholder="Trim Color" style="text-align:center;" />

        </span> </td>

      <?php $kNo++; } ?>

      <td align="center"><span style="width:125px;">

        <input name="qualityapproveddate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="text" id="qualityapproveddate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" <?php if($resListing12['qualityapproveddate']!="" && $resListing12['qualityapproveddate']!="0000-00-00" && $resListing12['qualityapproveddate']!="1970-01-01"){ ?> value="<?php echo date('d-m-Y',strtotime($resListing12['qualityapproveddate'])); ?>" <?php } ?> autocomplete="off" class="newDatePicker"  maxlength="200" placeholder="Quality approved" style="text-align:center;" />

        </span> </td>

      <td align="center" <?php if($_REQUEST['page']=='marker' || $_REQUEST['page']=='sampleanalysematerial' || $_REQUEST['page']=='samplingbom '){ ?> style="display:none;" <?php } ?> ><input name="bomComment<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="text" id="bomComment<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" value="<?php echo $resListing12['bomComment']; ?>" autocomplete="off"  maxlength="200" style="width:200px; text-align:center;" ></td>

	<td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?> >
	<a href="#" onclick="opmodalpop('Amendment Style# <?php echo getStyleRefId($_REQUEST['styleId']); ?>','newpop.php?action=amendaction&styleId=<?php echo encode($_REQUEST['styleId']); ?>&stylesubtabid=<?php echo $resListing1['id']; ?>&costsheetVersionId=<?php echo $_REQUEST['costsheetVersionId']; ?>&bomAvg=<?php echo $resListing12['bomAvg']; ?>&bomWidth=<?php echo $resListing12['bomWidth']; ?>&bomUnit=<?php echo $resListing12['bomUnit']; ?>&wastagePersent=<?php echo $resListing12['wastagePersent']; ?>&avgIncWastage=<?php echo $resListing12['avgIncWastage']; ?>&matCurrency=<?php echo $resListing12['matCurrency']; ?>&matPrice=<?php echo $resListing12['matPrice']; ?>&materialType=<?php echo $resListing['id']; ?>','700px','auto');" data-toggle="modal" data-target="#modalpop">Amend</a>
	</td>

      <td align="center" <?php if($_REQUEST['page']=='marker' || $_REQUEST['page']=='sampleanalysematerial' || $_REQUEST['page']=='samplingbom') { ?> style="display:none;"<?php } ?>><?php

											$select123='*';

											$where123='styleId="'.$_REQUEST['styleId'].'" and commnetType=0 and materialId="'.$resListing1['id'].'"';

											$rs123=GetPageRecord($select123,'materialCostChatMaster',$where123);

											$chatcount1=mysql_num_rows($rs123);

											?>

        <div class="mr-2"> <a onclick="opmodalpop('Comments','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=0&id=<?php echo $resListing1['id']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-transparent border-indigo-400 text-indigo-400 rounded-round border-2 btn-icon" style="padding:8px;"> <i class="icon-comment" style="color: #5c6bc0;"></i>

          <div class="add-cart-value" style="position: absolute; top: -6px; border-radius: 50%; border: 1px solid #7985cb; background: #7985cb; right: -7px; width: 17px; height: 17px;"><span style="color: #fff;font-size: 11px;" name="messagevalcount<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" id="messagevalcount<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"><?php echo $chatcount1; ?></span></div>

          </a> </div></td>

	 <?php if($_REQUEST['page']=='sampleanalysematerial') { ?>  <td align="center" style="">
	    <input name="artworkno<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="text" id="artworkno<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"  value="<?php echo $resListing12['artworkno']; ?>" autocomplete="off" class=""  maxlength="200" placeholder="Artwork No." style="text-align:center;" />

        </span>

	  </td><?php } ?>
	   <?php if($_REQUEST['page']=='sampleanalysematerial') { ?><td align="center" >
	    <input name="cadgivendate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="text" id="cadgivendate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" <?php if($resListing12['cadgivendate']!="" && $resListing12['cadgivendate']!="0000-00-00" && $resListing12['cadgivendate']!="1970-01-01"){ ?> value="<?php echo date('d-m-Y',strtotime($resListing12['cadgivendate'])); ?>" <?php } ?> autocomplete="off" class="newDatePicker"  maxlength="200" placeholder="CAD Given Date" style="text-align:center;" />

        </span>

	  </td><?php } ?>
	<?php if($_REQUEST['page']=='sampleanalysematerial') { ?>   <td align="center">
	    <input name="labdipdate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="text" id="labdipdate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" <?php if($resListing12['labdipdate']!="" && $resListing12['labdipdate']!="0000-00-00" && $resListing12['labdipdate']!="1970-01-01"){ ?> value="<?php echo date('d-m-Y',strtotime($resListing12['labdipdate'])); ?>" <?php } ?> autocomplete="off" class="newDatePicker"  maxlength="200" placeholder="Lab Dip/Strike" style="text-align:center;" />

        </span>

	  </td><?php } ?>

	   <?php if($_REQUEST['page']=='sampleanalysematerial') { ?><td align="center" >
	    <input name="labdiproundtwo<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="text" id="labdiproundtwo<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" <?php if($resListing12['labdiproundtwo']!="" && $resListing12['labdiproundtwo']!="0000-00-00" && $resListing12['labdiproundtwo']!="1970-01-01"){ ?> value="<?php echo date('d-m-Y',strtotime($resListing12['labdiproundtwo'])); ?>" <?php } ?> autocomplete="off" class="newDatePicker"  maxlength="200" placeholder="Lab Dip/Strike" style="text-align:center;" />

        </span>

	  </td><?php } ?>

      <td align="center" class="bomhideshowsecond" style=" position:relative; cursor:pointer; <?php if($_REQUEST['page']!='addbom'){ ?> display:none; <?php } ?>"></td>

      <td class="bomhideshow" align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?>><input name="supplierartname<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="text" id="supplierartname<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" value="<?php echo $resListing12['supplierartname']; ?>" autocomplete="off"  maxlength="200" placeholder="Supplier art" style="width: 130px;text-align:center;" />

      </td>

      <td class="" align="center" ><select id="storesupplier<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" name="storesupplier<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" style="width: fit-content;text-align: center;padding:5px;">

          <option>Select</option>

          <?php

	$rssupplier=GetPageRecord('*','suppliersMaster','1 and deletestatus=0 order by name asc');

	while($rssupplierList=mysqli_fetch_array($rssupplier)){

	?>

          <option value="<?php echo $rssupplierList['id']; ?>" <?php if($rssupplierList['id']==$resListing12['storesupplier']){ ?> selected <?php } ?>><?php echo $rssupplierList['name']; ?></option>

          <?php } ?>

        </select>

      </td>

      <td class="bomhideshow" align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?>><select name="buyerNominated<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" id="buyerNominated<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" style="width: 70px; padding: 4px 4px 3px;;">

          <option value="1" <?php if($resListing12['buyerNominated']==1){ ?> selected="selected" <?php } ?>>Yes</option>

          <option value="2" <?php if($resListing12['buyerNominated']==2){ ?> selected="selected" <?php } ?>>No</option>

        </select></td>

      <td class="bomhideshow" align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?>><div style="width: 50px; height: 50px; overflow: hidden;"> <img style="width:100%; height:100%;" src="<?php echo $fullurl; ?>images/<?php if($uniData['materialimage']!=""){ echo $uniData['materialimage']; } else{ ?>image-not-found.png<?php } ?>"> </div></td>

      <?php

//==================LEAD TIME AND TRANSIT TIME

$ltq=GetPageRecord('*','suppliersMaster','1 and id="'.$resListing12['storesupplier'].'"');

$leadTData=mysqli_fetch_array($ltq);

//===================

?>

      <?php

$ssssquery=GetPageRecord('id,tnaTemplateId,orderQty','queryMaster','id="'.$_REQUEST['styleId'].'"');

$styleDataaaa=mysqli_fetch_array($ssssquery);







$ocdq=GetPageRecord('*','timeActionReport','1 and styleId="'.$styleDataaaa['id'].'" and temid="'.$styleDataaaa['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name="ORDER CONFIRM DATE")');

$ocdData=mysqli_fetch_array($ocdq);



$pcdq=GetPageRecord('*','timeActionReport','1 and styleId="'.$styleDataaaa['id'].'" and temid="'.$styleDataaaa['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name="PRODUCTION COMPLETION")');

$pcdData=mysqli_fetch_array($pcdq);





$inhouseduedate= date('d-m-Y', strtotime($pcdData['complitionDate']. ''.-$leadTData['leadTime'].' days'));

$materialdispatchdate= date('d-m-Y', strtotime($inhouseduedate. ''.-$leadTData['transitTime'].' days'));

$finalforapproval= date('d-m-Y', strtotime($inhouseduedate. ''.-$leadTData['leadTime'].' days'));

$materialbookingfinal=date('d-m-Y', strtotime($pcdData['complitionDate']. '+2 days'));

$finalstandardhandover=date('d-m-Y', strtotime($finalforapproval. '-14 days'));



?>

      <td class="bomhideshow" align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?>><?php echo $finalstandardhandover; ?></td>

      <td class="bomhideshow" align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?>><?php echo $materialbookingfinal; ?></td>

      <td class="bomhideshow" align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?>><?php echo $finalforapproval; ?></td>

      <td class="bomhideshow" align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?>><?php echo $leadTData['leadTime']; ?></td>

      <td class="bomhideshow" align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?>><?php echo $leadTData['transitTime']; ?></td>

      <td class="bomhideshow" align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?>><?php echo $materialdispatchdate; ?></td>

      <td class="bomhideshow" align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?>><?php echo $inhouseduedate; ?></td>

      <td class="bomhideshow" align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?>></td>

      <td class="bomhideshow" align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?>><?php echo $styleDataaaa['orderQty']*$resListing12['avgIncWastage']; ?></td>

      <td class="bomhideshow" align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?>>0</td>

      <td align="center" style="display:none;"><strong>-</strong></td>

      <td align="center" <?php if($_REQUEST['page']!='costsheet'){ ?> style="display:none;" <?php } ?>><select name="addToCost<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" id="addToCost<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" style="width: 70px; padding: 4px 4px 3px;;">

          <option value="1" <?php if($resListing12['addToCost']==1){ ?> selected="selected" <?php } ?>>Yes</option>

          <option value="2" <?php if($resListing12['addToCost']==2){ ?> selected="selected" <?php } ?>>No</option>

        </select></td>

      <td align="center" style="display:none;"><div style="width:170px;">

          <input name="bomQuality<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="text"  id="bomQty<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" value="<?php echo $resListing12['bomQuality']; ?>" autocomplete="off"  maxlength="200" placeholder="Quality" style="text-align:center;" />

        </div></td>

      <td align="center" style="display:none;"><input name="bomColorFirst<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="text"  id="bomColorFirst<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" value="<?php echo $resListing12['bomColorFirst']; ?>" autocomplete="off"  maxlength="200" style="width:70px;text-align:center;" placeholder="Color/Size"  />

      </td>

      <td align="center" style="display:none;"><input name="bomStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="text" id="bomStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" value="<?php echo $resListing12['bomStatus']; ?>" autocomplete="off"  maxlength="200" placeholder="Status" style="text-align:center;" />

        <input name="cid<?php echo $sNo1; ?>" type="hidden" id="cid<?php echo $sNo1; ?>" value="<?php echo $resListing1['id']; ?>">

      </td>

      <?php if($_REQUEST['loginuserprofileId']!='154' && $_REQUEST['loginuserprofileId']!='155'){ ?>

      <td <?php if($_REQUEST['page']!='materiallist'){ ?> style="display:none;" <?php } ?>><div style="width:fit-content;">

          <?php



											$array =  explode(',', $resListing1['assignTo']);

											foreach ($array as $item) {



											$select121='*';

											$id121=$item;

											$where121='id="'.$id121.'"';

											$rs121=GetPageRecord($select121,'userMaster',$where121);

											$assigntouser=mysqli_fetch_array($rs121);

											?>

          <?php if($id121!='') { ?>

          <span class="badge bg-success" style="margin-bottom:5px;"><?php echo $assigntouser['firstName'].' '.$assigntouser['lastName']; ?></span>

          <?php } ?>

          <?php

											}

											?>

        </div></td>

      <?php } ?>

      <?php if($_REQUEST['loginuserprofileId']=='154' ){ ?>

      <td <?php if($_REQUEST['page']!='materiallist'){ ?> style="display:none;" <?php } ?>><div style="width:fit-content;">

          <?php



											$array =  explode(',', $resListing1['assignToPurMerchant']);

											foreach ($array as $item) {



											$select121='*';

											$id121=$item;

											$where121='id="'.$id121.'"';

											$rs121=GetPageRecord($select121,'userMaster',$where121);

											$assigntouser=mysqli_fetch_array($rs121);

											?>

          <?php if($id121!='') { ?>

          <span class="badge bg-success" style="margin-bottom:5px;"><?php echo $assigntouser['firstName'].' '.$assigntouser['lastName']; ?></span>

          <?php } ?>

          <?php

											}

											?>

        </div></td>

      <?php } ?>

      <!--PROTYPE sample-->

      <td align="center" <?php if($_REQUEST['page']!='prototypesample') { ?> style="display:none;"<?php } ?>><?php

$selecty='*';

$wherey='styleId="'.$_REQUEST['styleId'].'" and commnetType=1 and materialId="'.$resListing1['id'].'" order by id desc limit 1';

$rsy=GetPageRecord($selecty,'materialCostChatMaster',$wherey);

$statusresult=mysqli_fetch_array($rsy);

$countqty=mysql_num_rows($rsy);

?>

        <?php if($_REQUEST['loginuserprofileId']==92 && $resListing1['qtyStatus']=='1' && $countqty=='0') { echo '-'; } else{ ?>

        <?php if($resListing1['qtyStatus']=='1' && $statusresult['approvedStatus']!='1') { ?>

        <label class="qualityblockclass<?php echo $resListing['id']; ?>" style="position:relative;">

        <input type="checkbox" style="position: relative;opacity: 1;cursor: pointer;height: 15px;width: 15px;margin-top: 0;" value="<?php echo $resListing1['id']; ?>" name="qualityCheckAllBox[]" class="QualityyCheckClass<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" />

        </label>

        <?php } } ?></td>

      <td align="center" <?php if($_REQUEST['page']!='prototypesample') { ?> style="display:none;"<?php } ?>><?php if($resListing1['qtyStatus']=='1' && $countqty=='0' || $statusresult['approvedStatus']=='5'){ ?>

        <a id="qtyStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" <?php if($_REQUEST['loginuserprofileId']!=92) { ?> onclick="opmodalpop('Quality','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=1&id=<?php echo $resListing1['id']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop" <?php } ?>  class="btn bg-warning-400 ml-md-3 mt-3 mt-md-0" style="margin: 0px !important;padding: 3px 10px;background: #5c6bc0;">Pending</a>

        <?php } else if($resListing1['qtyStatus']=='1' && $statusresult['approvedStatus']=='1') { ?>

        <?php /*?><a id="qtyStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" onclick="opmodalpop('Quality','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=1&id=<?php echo $resListing1['id']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop"  class="btn bg-success-400 ml-md-3 mt-3 mt-md-0" style="margin: 0px !important;padding: 3px 10px;">Approved</a><?php */?>

        <a id="qtyStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" class="btn bg-success-400 ml-md-3 mt-3 mt-md-0" style="margin: 0px !important;padding: 3px 10px;">Approved</a>

        <?php } else if($resListing1['qtyStatus']=='1' && $statusresult['approvedStatus']=='2') { ?>

        <a id="qtyStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" onclick="opmodalpop('Quality','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=1&id=<?php echo $resListing1['id']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop"  class="btn bg-info-400 ml-md-3 mt-3 mt-md-0" style="margin: 0px !important;padding: 3px 10px;">Assigned</a>

        <?php } else if($resListing1['qtyStatus']=='1' && $statusresult['approvedStatus']=='4') { ?>

        <a id="qtyStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" onclick="opmodalpop('Quality','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=1&id=<?php echo $resListing1['id']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop"  class="btn bg-info-400 ml-md-3 mt-3 mt-md-0" style="margin: 0px !important;padding: 3px 10px;background:#ff0000;">Rejected</a>

        <?php } else if($resListing1['qtyStatus']=='1' && $statusresult['approvedStatus']=='3') { ?>

        <?php if($_SESSION['userid']==$statusresult['assigedTo']){ ?>

        <a id="qtyStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" onclick="opmodalpop('Quality','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=1&id=<?php echo $resListing1['id']; ?>&fortTimeSlot=11','600px','auto');" data-toggle="modal" data-target="#modalpop"  class="btn bg-info-400 ml-md-3 mt-3 mt-md-0" style="margin: 0px !important;padding: 3px 10px;background: #ff4a03;">Waiting For Approvel</a>

        <?php } else {  ?>

        <a id="qtyStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" onclick="opmodalpop('Quality','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=1&id=<?php echo $resListing1['id']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop"  class="btn bg-info-400 ml-md-3 mt-3 mt-md-0" style="margin: 0px !important;padding: 3px 10px;background: #ffc803;">Pending For Approvel</a>

        <?php } ?>

        <?php } else { ?>

        <a id="qtyStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" class="btn bg-grey-400 ml-md-3 mt-3 mt-md-0" style="margin: 0px !important;padding: 3px 10px;cursor: auto;">Not Required</a>

        <?php } ?></td>

      <td align="center" <?php if($_REQUEST['page']!='prototypesample') { ?> style="display:none;"<?php } ?>><?php

$selecty1='*';

$wherey1='styleId="'.$_REQUEST['styleId'].'" and commnetType=2 and materialId="'.$resListing1['id'].'" order by id desc limit 1';

$rsy1=GetPageRecord($selecty1,'materialCostChatMaster',$wherey1);

$statusresult1=mysqli_fetch_array($rsy1);

$countqty1=mysql_num_rows($rsy1);

?>

        <?php if($_REQUEST['loginuserprofileId']==92 && $resListing1['priceStatus']=='1' && $countqty1=='0') { echo '-'; } else{ ?>

        <?php if($resListing1['priceStatus']=='1' && $statusresult1['approvedStatus']!='1') { ?>

        <label class="priceblockclass<?php echo $resListing['id']; ?>" style="position:relative;">

        <input type="checkbox" style="position: relative;opacity: 1;cursor: pointer;height: 15px;width: 15px;margin-top: 0;" value="<?php echo $resListing1['id']; ?>" name="priceCheckAllBox[]" class="priceCheckClass<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" />

        </label>

        <?php } } ?></td>

      <td align="center" <?php if($_REQUEST['page']!='prototypesample') { ?> style="display:none;"<?php } ?>><?php if($resListing1['priceStatus']=='1' && $countqty1=='0' || $statusresult1['approvedStatus']=='5'){ ?>

        <a id="priceStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" <?php if($_REQUEST['loginuserprofileId']!=92) { ?> onclick="opmodalpop('Price','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=2&id=<?php echo $resListing1['id']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop" <?php } ?> class="btn bg-warning-400 ml-md-3 mt-3 mt-md-0" style="margin: 0px !important;padding: 3px 10px;background: #5c6bc0;">Pending</a>

        <?php }  else if($resListing1['priceStatus']=='1' && $statusresult1['approvedStatus']=='1') { ?>

        <?php /*?><a id="priceStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" onclick="opmodalpop('Price','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=2&id=<?php echo $resListing1['id']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-success-400 ml-md-3 mt-3 mt-md-0" style="margin: 0px !important;padding: 3px 10px;">Approved</a><?php */?>

        <a id="priceStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" class="btn bg-success-400 ml-md-3 mt-3 mt-md-0" style="margin: 0px !important;padding: 3px 10px;">Approved</a>

        <?php } else if($resListing1['priceStatus']=='1' && $statusresult1['approvedStatus']=='2') { ?>

        <a id="priceStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" onclick="opmodalpop('Price','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=2&id=<?php echo $resListing1['id']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-info-400 ml-md-3 mt-3 mt-md-0" style="margin: 0px !important;padding: 3px 10px;">Assigned</a>

        <?php } else if($resListing1['priceStatus']=='1' && $statusresult1['approvedStatus']=='4') { ?>

        <a id="priceStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" onclick="opmodalpop('Price','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=2&id=<?php echo $resListing1['id']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-info-400 ml-md-3 mt-3 mt-md-0" style="margin: 0px !important;padding: 3px 10px;background:#ff0000;">Rejected</a>

        <?php } else if($resListing1['priceStatus']=='1' && $statusresult1['approvedStatus']=='3') { ?>

        <?php if($_SESSION['userid']==$statusresult1['assigedTo']){ ?>

        <a id="priceStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" onclick="opmodalpop('Price','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=2&id=<?php echo $resListing1['id']; ?>&fortTimeSlot=11','600px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-info-400 ml-md-3 mt-3 mt-md-0" style="margin: 0px !important;padding: 3px 10px;background: #ff4a03;">Waiting For Approvel</a>

        <?php } else { ?>

        <a id="priceStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" onclick="opmodalpop('Price','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=2&id=<?php echo $resListing1['id']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-info-400 ml-md-3 mt-3 mt-md-0" style="margin: 0px !important;padding: 3px 10px;background: #ffc803;">Pending For Approvel</a>

        <?php } ?>

        <?php } else { ?>

        <a id="priceStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" class="btn bg-grey-400 ml-md-3 mt-3 mt-md-0" style="margin: 0px !important;padding: 3px 10px;cursor: auto;">Not Required</a>

        <?php } ?></td>

      <td align="center" <?php if($_REQUEST['page']!='prototypesample') { ?> style="display:none;"<?php } ?>><?php

$selecty1='*';

$wherey2='styleId="'.$_REQUEST['styleId'].'" and commnetType=3 and materialId="'.$resListing1['id'].'" order by id desc limit 1';

$rsy2=GetPageRecord($selecty1,'materialCostChatMaster',$wherey2);

$statusresult2=mysqli_fetch_array($rsy2);

$countqty2=mysql_num_rows($rsy2);

?>

        <?php if($_REQUEST['loginuserprofileId']==92 && $resListing1['vendorStatus']=='1'  && $countqty2=='0') { echo '-';} else{ ?>

        <?php if($resListing1['vendorStatus']=='1' && $statusresult2['approvedStatus']!='1') { ?>

        <label class="vendorblockclass<?php echo $resListing['id']; ?>" style="position:relative;">

        <input type="checkbox" style="position: relative;opacity: 1;cursor: pointer;height: 15px;width: 15px;margin-top: 0;" value="<?php echo $resListing1['id']; ?>" name="vendorCheckAllBox[]" class="vendorCheckClass<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" />

        </label>

        <?php } } ?></td>

      <td align="center" <?php if($_REQUEST['page']!='prototypesample') { ?> style="display:none;"<?php } ?>><?php if($resListing1['vendorStatus']=='1'  && $countqty2=='0' || $statusresult2['approvedStatus']=='5'){ ?>

        <a id="vendorStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" <?php if($_REQUEST['loginuserprofileId']!=92) { ?> onclick="opmodalpop('Vendor','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=3&id=<?php echo $resListing1['id']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop" <?php } ?> class="btn bg-warning-400 ml-md-3 mt-3 mt-md-0" style="margin: 0px !important;padding: 3px 10px;background: #5c6bc0;">Pending</a>

        <?php }



else if($resListing1['vendorStatus']=='1' && $statusresult2['approvedStatus']=='1') { ?>

        <?php /*?><a id="vendorStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" onclick="opmodalpop('Vendor','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=3&id=<?php echo $resListing1['id']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-success-400 ml-md-3 mt-3 mt-md-0" style="margin: 0px !important;padding: 3px 10px;">Approved</a><?php */?>

        <a id="vendorStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" class="btn bg-success-400 ml-md-3 mt-3 mt-md-0" style="margin: 0px !important;padding: 3px 10px;">Approved</a>

        <?php } else if($resListing1['vendorStatus']=='1' && $statusresult2['approvedStatus']=='4') { ?>

        <a id="vendorStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" onclick="opmodalpop('Vendor','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=3&id=<?php echo $resListing1['id']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-info-400 ml-md-3 mt-3 mt-md-0" style="margin: 0px !important;padding: 3px 10px;background:#ff0000;">Rejected</a>

        <?php } else if($resListing1['vendorStatus']=='1' && $statusresult2['approvedStatus']=='2') { ?>

        <a id="vendorStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" onclick="opmodalpop('Vendor','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=3&id=<?php echo $resListing1['id']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-info-400 ml-md-3 mt-3 mt-md-0" style="margin: 0px !important;padding: 3px 10px;">Assigned</a>

        <?php } else if($resListing1['vendorStatus']=='1' && $statusresult2['approvedStatus']=='3') { ?>

        <?php if($_SESSION['userid']==$statusresult2['assigedTo']){ ?>

        <a id="vendorStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" onclick="opmodalpop('Vendor','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=3&id=<?php echo $resListing1['id']; ?>&fortTimeSlot=11','600px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-info-400 ml-md-3 mt-3 mt-md-0" style="margin: 0px !important;padding: 3px 10px;background: #ff4a03;">Waiting For Approvel</a>

        <?php } else { ?>

        <a id="vendorStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" onclick="opmodalpop('Vendor','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=3&id=<?php echo $resListing1['id']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-info-400 ml-md-3 mt-3 mt-md-0" style="margin: 0px !important;padding: 3px 10px;background: #ffc803;">Pending For Approvel</a>

        <?php } ?>

        <?php } else { ?>

        <a id="vendorStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" class="btn bg-grey-400 ml-md-3 mt-3 mt-md-0" style="margin: 0px !important;padding: 3px 10px;cursor: auto;">Not Required</a>

        <?php } ?></td>

      <!--hidden div for status-->

      <div id="qualitycheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" name="qualitycheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" style="display:none;"></div>

      <!--end-->

      <td align="center" <?php if($_REQUEST['page']!='analysemateriallist' && ($_REQUEST['page']!='sampleanalysematerial' || $resListing['id']!=2)) { ?> style="display:none;"<?php } ?>><?php 	if($_REQUEST['page']!='sampleanalysematerial') { ?>

        <label class="container">

        <input type="checkbox" id="qtystatuscheckuncheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" name="qtystatuscheckuncheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" value="<?php if($resListing1['qtyStatus']=='1') { echo '0';  } else { echo '1'; } ?>" style="margin-right: 5px;" <?php if($resListing1['qtyStatus']=='1') { ?> checked="checked" <?php } ?> onclick="qualityonoff<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>('<?php echo $resListing1['id']; ?>');" >

        <span class="checkmark"></span></label>

        <label class="container">

        <input type="checkbox" id="pricestatuscheckuncheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" name="pricestatuscheckuncheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" value="<?php if($resListing1['priceStatus']=='1') { echo '0';  } else { echo '1'; } ?>" style="margin-right: 5px;" <?php if($resListing1['priceStatus']=='1') { ?> checked="checked" <?php } ?> onclick="priceonoff<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>('<?php echo $resListing1['id']; ?>');" >

        <span class="checkmark"></span></label>

        <label class="container">

        <input type="checkbox" id="vendorstatuscheckuncheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" name="vendorstatuscheckuncheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" value="<?php if($resListing1['vendorStatus']=='1') { echo '0';  } else { echo '1'; } ?>" style="margin-right: 5px;" <?php if($resListing1['vendorStatus']=='1') { ?> checked="checked" <?php } ?> onclick="vendoronoff<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>('<?php echo $resListing1['id']; ?>');" >

        <span class="checkmark"></span></label>

        <label class="container" style="display:none;">

        <input type="checkbox" id="colorSeparate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" name="colorSeparate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" value="<?php if($resListing1['colorSeparate']=='1') { echo '0';  } else { echo '1'; } ?>" style="margin-right: 5px;" <?php if($resListing1['colorSeparate']=='1') { ?> checked="checked" <?php } ?> onclick="colorseparationonoff<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>('<?php echo $resListing1['id']; ?>');">

        <span class="checkmark"></span></label>

        <?php } ?>

        <?php if($resListing['id']==2){ ?>

        <label class="container">

        <input type="checkbox" id="sizeSeparate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" name="sizeSeparate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" value="<?php if($resListing1['sizeSeparate']=='1') { echo '0';  } else { echo '1'; } ?>" style="margin-right: 5px;" <?php if($resListing1['sizeSeparate']=='1') { ?> checked="checked" <?php } ?> onclick="sizeseparationonoff<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>('<?php echo $resListing1['id']; ?>');" >

        <span class="checkmark"></span></label>

        <?php } ?>

      </td>

      <script>

		function qualityonoff<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>(id){

		var qtystatus= $('#qtystatuscheckuncheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val();

		$('#qualitycheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').load("load_costsheet_version.php?action=qualityrequired&qtystatus="+qtystatus+'&id='+id);



		}

		</script>

      <script>

		function priceonoff<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>(id){

		var priceStatus= $('#pricestatuscheckuncheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val();

		$('#qualitycheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').load("load_costsheet_version.php?action=pricerequired&priceStatus="+priceStatus+'&id='+id);



		}

		</script>

      <script>

		function vendoronoff<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>(id){

		var vendorStatus= $('#vendorstatuscheckuncheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val();

		$('#qualitycheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').load("load_costsheet_version.php?action=vendorrequired&vendorStatus="+vendorStatus+'&id='+id);



		}

		</script>

      <script>

		function colorseparationonoff<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>(id){

		var colorSeparate= $('#colorSeparate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val();



		$('#qualitycheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').load("load_costsheet_version.php?action=colorseparation&colorSeparate="+colorSeparate+'&id='+id);

		}

		</script>

      <script>

		function sizeseparationonoff<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>(id){



		var x = confirm("Are you sure you want to separate size wise material?");

if (x == true) {



		var sizeSeparate= $('#sizeSeparate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val();



		if($('#sizeSeparate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').is(":checked")){

		sizeSeparate=1;

		}else{

		sizeSeparate=0;

		}





		$('#qualitycheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').load("load_costsheet_version.php?styleId=<?php echo $_REQUEST['styleId']; ?>&action=sizeseparation&sizeSeparate="+sizeSeparate+'&id='+id);

		}else{



	 	$("#sizeSeparate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>").removeAttr('checked');



		}



		}





		</script>

    </tr>

    <?php $N++;  } ?>

  <style>

<?php

if($_REQUEST['loginuserprofileId']=='154' || $_REQUEST['loginuserprofileId']=='155'){

if($N=='0') { ?>

#table-hide-showw<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>,#tableid<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>,#totalprice<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>{

display:none !important;

}

<?php } } ?>



</style>

  </tbody>



</table>