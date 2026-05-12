<script src="//code.jquery.com/jquery-1.12.4.js?d=1570183053"></script>
<?php
include "inc.php";

$select12='*';
$where12='id="'.decode($_GET['st']).'"';
$rs12=GetPageRecord($select12,'queryMaster',$where12);
$resListing12=mysqli_fetch_array($rs12);


$selectimg='*';
$whereimg='parentId="'.$resListing12['id'].'" and galleryType="image_gallery" order by id asc';
$rsimg=GetPageRecord($selectimg,'imageGallery',$whereimg);
$imgresult=mysqli_fetch_array($rsimg);


?>
<form  method="post" action="outsourceaction.php" enctype="multipart/form-data">
<div id="firstdiv" class="card-body" style="width: 850px; padding: 20px; margin: 10px auto; border: 1px #dcdcdc solid; background-color: #fff; box-shadow: 0px 0px 10px #ccccccb5;font-family: Arial,Helvetica,sans-serif !important;">
 <table width="100%" style="width: 100%;margin: unset;background:#fff;border-left:1px solid #e4e4e4;border-right:1px solid #e4e4e4;border-bottom:1px solid #e4e4e4;font-family:Arial,Helvetica,sans-serif;" border="0" cellpadding="0" cellspacing="0" align="center">
  <tbody><tr>
    <td style="border-top: solid 4px #0d7444; line-height: 1;"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #e4e4e4;border-top:none">
        <tbody><tr>
          <td align="left" valign="top" style="padding:14px 0 0 11px">
	        <div style="font-family:Arial,Helvetica,sans-serif;font-size:26px;color:#000;font-weight:700;text-decoration:none">
				<img src="<?php echo $fullurl; ?>global_assets/images/woodland-logo2.png" alt="http://deboxcrm.com/woodland2/global_assets/images/woodland-logo2.png">
			</div>
		</td>

        </tr>
      </tbody></table></td>
</tr>
<tr>
<td>

		<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
		  <tr>
			 <td style="padding:19px 4px 0 4px;font-family:Arial,Helvetica,sans-serif;">
				<p style="margin:0;font-size:15px;color:#333;padding:0 0 8px 6px;line-height:18px">Dear <strong>Sir / Mam  </strong></p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Greeting from Woodland - The Apparel ERP! .</p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Please fill the final costing:</p>

<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">
<?php
$selecty='*';
$wherey='styleid="'.decode($_GET['st']).'" and vendorid="'.decode($_GET['s']).'" and id="'.decode($_GET['emid']).'"';
$rsy=GetPageRecord($selecty,'vendorPurchasemail',$wherey);
$remarks=mysqli_fetch_array($rsy); ?>
<?php if($remarks['inHouseComment']!=''){ ?>
<strong>Notes:&nbsp;</strong>
<?php } echo $remarks['inHouseComment'];?></p>

			</td>

        </tr>
      </tbody></table> </td>
  </tr>
      <tr>


    <td style="padding: 20px 10px; background: #f4f4f4;">
		 <p style="margin:0px;font-size:16px;padding:0 0 0 8px;    border-left: 3px solid #0d7544;height:25px;line-height:25px;color:#666">Style Information: </p>
		 <div style="clear:both;padding:0;margin:10px 0 0 0;border:1px solid #f5f5f5;background:#fff">

	   <table width="100%" border="0" cellspacing="0" cellpadding="5" style="border: 0.5px solid #ccc;">

   <tbody><tr>
 		<td width="18%" style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Style Image</td>
		<td width="21%" style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Style</td>
		<td width="16%" style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Category</td>
		<td width="15%" style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Sub Category</td>
		<td width="12%" style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Season</td>
		<td width="18%" style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Received Date</td>
  </tr>
  <tr>
   <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;"><img src="<?php echo $fullurl; ?>images/<?php echo $imgresult['attachmentImage']; ?>" style="width:90px;">
			</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">Style <?php echo $resListing12['subject']; ?></td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;"><?php echo getCategoryName($resListing12['categoryId']); ?></td>
	<td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;"><?php echo getSubCategoryName($resListing12['subCategoryId']); ?></td>
	<td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;"><?php echo seasonName($resListing12['seasonId']); ?></td>
	<td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;"><?php echo date('d M, Y',$resListing12['dateAdded']); ?></td>
  </tr>


</tbody></table>
</div>
</td>
  </tr>

</tbody></table>

<?php
$selectmid='*';
$wheremid='styleId="'.decode($_GET['st']).'" and vendorId="'.decode($_GET['s']).'" and vendorPurchaseEmailId="'.decode($_GET['emid']).'" and pd=1 order by id desc';
$rsmid=GetPageRecord($selectmid,'materialSendToVendor',$wheremid);
$resListingmid=mysqli_fetch_array($rsmid);
?>

<div style="margin-bottom:10px;font-size: 14px;">
  <div style="padding:10px; background-color:#e5fff9"><strong>Costing</strong></div>
  <div style="padding:10px; border: 1px #a5f3e5 solid; margin-bottom:10px;">
 <input type="number" name="valueOnePiece" id="valueOnePiece" onkeyup="submitvendorData();" value="<?php echo $resListingmid['valueOnePiece']; ?>" <?php if($resListingmid['valueOnePiece']!='' && $resListingmid['valueOnePiece']!='0'){ echo "readonly"; }?> style="height: 30px; width: 100%;border: 1px solid #ccc; padding: 5px;" />
</div>
</div>


<div style="margin-bottom:10px;font-size: 14px;">
  <div style="padding:10px; background-color:#e5fff9"><strong>Remarks</strong></div>
  <div style="padding:10px; border: 1px #a5f3e5 solid; margin-bottom:10px;">
 <textarea name="vendorRemark" cols="" rows="" onkeyup="submitvendorData();" id="vendorRemark" style="height: 80px; width: 100%;border: 1px solid #ccc; padding: 5px;" <?php if($resListingmid['vendorRemark']!=''){ echo "readonly"; }?>><?php echo $resListingmid['vendorRemark']; ?></textarea>
</div>
</div>

<input type="file" name="attachmentFile" id="attachmentFile"/>
<input type="hidden" name="editvendorattachment" value="<?php echo $resListingmid['attachment']; ?>" />

<?php if($resListingmid['valueOnePiece']=='' || $resListingmid['vendorRemark']==''){ ?>
<div style="text-align:right;">
  <input type="submit" style="padding:10px 0px; color:#FFFFFF; background-color:#009933; border:0px; font-size:16px; width:200px;" value="Send" onclick="showmessage();">
</div>
<?php } ?>

<input type="hidden" name="action" value="vendorattachment" />
<input type="hidden" name="mid" value="<?php echo $resListingmid['id']; ?>" />
<input type="hidden" name="emid" value="<?php echo $_GET['emid']; ?>"  />

<?php if($resListingmid['attachment']!=''){ ?>
<div style="margin-top:10px;"><a href="<?php echo $fullurl.'images/'.$resListingmid['attachment']; ?>" target="_blank" style="font-size:12px;">Download Attachment</a></div>
  <?php } ?>
</div>



</form>
<script>
function submitvendorData(){
	var valueOnePiece = Number($('#valueOnePiece').val());
	var vendorRemark = encodeURI($('#vendorRemark').val());
	var sheet = $('#sheet').val();

	$.ajax({
	type: "POST",
	url: 'outsourceaction.php?id=<?php echo encode($resListingmid['id']); ?>&action=costRecivedFromVendor&valueOnePiece='+valueOnePiece+'&vendorRemark='+vendorRemark+'&sheet='+sheet,
	success: function(response)
	{
		$("#submitvendordata").html(response);
	}
	});


}
</script>

<div id="success" style="display:none;width: 850px;padding: 20px;margin: 10px auto;border: 1px #dcdcdc solid;background-color: #fff;box-shadow: 0px 0px 10px #ccccccb5;font-family:Arial, Helvetica, sans-serif;background-image:url(images/46586356d879e6a.png);background-repeat:repeat-x;background-position:left bottom;background-size: 100% 100%;">
<div style="text-align:center; color:#009933; font-size:26px; margin-bottom:10px; padding-top:150px;"><img src="<?php echo $fullurl; ?>global_assets/images/woodland-logo2.png"><br>
<br>
Successfully Submitted</div>
<div style="text-align:center; font-size:17px; margin-bottom:10px;">Your data has been submitted successfully. We will get back to you shortly. </div>
<div style="text-align:center; font-size:17px; margin-bottom:10px; padding-bottom:150px;"><strong>Thank you for your cost. </strong></div>
</div>

<script>
function showmessage(){
$('#success').show();
$('#firstdiv').hide();
}
</script>
<div id="submitvendordata" ></div>




