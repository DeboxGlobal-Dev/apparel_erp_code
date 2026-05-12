<?php
include "inc.php";

//Cost Received from vendor start
if(trim($_REQUEST['action'])=='costRecivedFromVendor'){


$id=decode($_REQUEST['id']);
$valueOnePiece=addslashes($_REQUEST['valueOnePiece']);
$vendorRemark=addslashes($_REQUEST['vendorRemark']);

$namevalue ='valueOnePiece="'.$valueOnePiece.'",vendorRemark="'.$vendorRemark.'"';
$where='id="'.$id.'"';
$update = updatelisting('materialSendToVendor',$namevalue,$where);

}

//Cost Received from vendor with attachment
if(trim($_POST['action'])=='vendorattachment' && trim($_POST['mid'])!=''){
include "config/mail.php";

$id = trim($_POST['mid']);
$emid = decode($_POST['emid']);

$selectvendor='';
$wherevendor='';
$rsvendor='';
$selectvendor='*';
$wherevendor='id="'.$id.'"';
$rsvendor=GetPageRecord($selectvendor,'materialSendToVendor',$wherevendor);
$resListingvendor=mysqli_fetch_array($rsvendor);

$assignVendorId = $resListingvendor['vendorId'];
$styleId = $resListingvendor['styleId'];

if($_FILES['attachmentFile']['name']!=''){
$file_name=trim(addslashes($_FILES['attachmentFile']['name']));
$file_name=time().'-'.str_replace(' ', '_',$file_name);
$file_name= str_replace('#', 'f',$file_name);
copy($_FILES['attachmentFile']['tmp_name'],"images/".$file_name);
}else{
$file_name = $_POST['editvendorattachment'];
}



$namevalue = 'attachment="'.$file_name.'"';
$where='id="'.$id.'"';
$update = updatelisting('materialSendToVendor',$namevalue,$where);

if($resListingvendor['valueOnePiece']!=''){

$select='';
$where='';
$rs='';
$select='*';
$where='id="'.$assignVendorId.'"';
$rs=GetPageRecord($select,'vendorMaster',$where);
$resListing=mysqli_fetch_array($rs);

$select12='*';
$where12='id="'.$styleId.'"';
$rs12=GetPageRecord($select12,'queryMaster',$where12);
$resListing12=mysqli_fetch_array($rs12);

$select1='*';
$where1='id="'.$resListing12['assignTo'].'"';
$rs1=GetPageRecord($select1,_USER_MASTER_,$where1);
$res=mysqli_fetch_array($rs1);

$selectimg='*';
$whereimg='parentId="'.$styleId.'" and galleryType="image_gallery" order by id asc';
$rsimg=GetPageRecord($selectimg,'imageGallery',$whereimg);
$imgresult=mysqli_fetch_array($rsimg);



$fromemail ='';
$mailto=$res['userName'];
$ccmail='';
$mailsubject='Re: Woodland Appreal ERP - New Style# '.getStyleRefId($styleId).'';

$mailbodyheader = '<table width="100%" style="max-width: 750px;margin: unset;background:#fff;border-left:1px solid #e4e4e4;border-right:1px solid #e4e4e4;border-bottom:1px solid #e4e4e4;font-family:Arial,Helvetica,sans-serif;" border="0" cellpadding="0" cellspacing="0" align="center">
  <tbody><tr>
    <td style="border-top: solid 4px #0d7444; line-height: 1;"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #e4e4e4;border-top:none">
        <tbody><tr>
          <td align="left" valign="top" style="padding:14px 0 0 11px">
	<a href="'.$fullurl.'" style="font-family:Arial,Helvetica,sans-serif;font-size:26px;color:#000;font-weight:700;text-decoration:none" target="_blank">
				<img src="'.$fullurl.'global_assets/images/woodland-logo2.png" alt="'.$fullurl.'global_assets/images/woodland-logo2.png">
			</a>
		</td>
          <td align="right" valign="top" style="padding:12px 11px 7px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#000">&nbsp;</td>
        </tr>
      </tbody></table></td>
</tr>
<tr>
<td>';


$maildescription = '<table style="width: 100%;margin: unset;background:#fff;border-left:1px solid #e4e4e4;border-right:1px solid #e4e4e4;border-bottom:1px solid #e4e4e4;font-family:Arial,Helvetica,sans-serif;" border="0" cellpadding="0" cellspacing="0" align="center">
  <tbody><tr>
    <td style="border-top: solid 4px #0d7444; line-height: 1;"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #e4e4e4;border-top:none">
        <tbody><tr>
          <td align="left" valign="top" style="padding:14px 0 0 11px">
	        <div style="font-family:Arial,Helvetica,sans-serif;font-size:26px;color:#000;font-weight:700;text-decoration:none">
				<img src="'.$fullurl.'global_assets/images/woodland-logo2.png" alt="">
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
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Greeting from '.$systemname.' - The Apparel ERP! .</p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Cost received from vendor: '.$resListing['name'].'</p>
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
   <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;"><img src="'.$fullurl.'images/'.$imgresult['attachmentImage'].'" style="width:90px;">
			</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">Style '.$resListing12['subject'].'</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.getCategoryName($resListing12['categoryId']).'</td>
	<td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.getSubCategoryName($resListing12['subCategoryId']).'</td>
	<td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.seasonName($resListing12['seasonId']).'</td>
	<td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.date('d M, Y',$resListing12['dateAdded']).'</td>
  </tr>


</tbody></table>
</div>
</td>
  </tr>

</tbody></table>
<p><a href="'.$fullurl.'submit-pdvendorcost.php?st='.encode($styleId).'&s='.encode($assignVendorId).'&emid='.encode($emid).'" style="background-color: #11b76c; border-radius: 4px; color: #fff!important; padding: 8px 18px; font-size: 14px; text-decoration: none; display: inline-block;" target="_blank" class="showhide" >View Cost</a></p>
';

$dateAdded=time();
$maildescription1 = addslashes($maildescription);
$namevalue ='subject="'.$mailsubject.'",description="'.$maildescription1.'",adddate="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",styleid="'.$styleId.'",vendorid="'.$assignVendorId.'",inHouseComment="'.trim($_POST['notes']).'",status="2",pd=1';
$adds = addlisting('vendorPurchasemail',$namevalue);

send_template_mail_query($fromemail,$mailto,$mailsubject,$maildescription,$ccmail);

}

?>
<script>
parent.window.location.href='submit-pdvendorcost.php?st=<?php echo encode($resListingvendor['styleId']); ?>&s=<?php echo encode($resListingvendor['vendorId']); ?>&emid=<?php echo encode($emid); ?>';
</script>
<?php
}

//Cost received from Supplier
if(trim($_REQUEST['action'])=='sendtosupplier'){

$id=decode($_REQUEST['id']);
$valueOnePiece=addslashes($_REQUEST['valueOnePiece']);
$supplierRemark=addslashes($_REQUEST['supplierRemark']);

$namevalue ='valueOnePiece="'.$valueOnePiece.'",supplierRemark="'.$supplierRemark.'"';
$where='id="'.$id.'"';
$update = updatelisting('materialSendToSupplier',$namevalue,$where);

}

if(trim($_REQUEST['action'])=='sendtoinhouseoutsourcevendor'){

$id=decode($_REQUEST['id']);
$valueOnePiece=addslashes($_REQUEST['valueOnePiece']);
$vendorRemark=addslashes($_REQUEST['vendorRemark']);
$avg=addslashes($_REQUEST['avg']);
$unitName=addslashes($_REQUEST['unitName']);

$namevalue ='valueOnePiece="'.$valueOnePiece.'",vendorRemark="'.$vendorRemark.'",avg="'.$avg.'",unitName="'.$unitName.'"';
$where='id="'.$id.'"';
$update = updatelisting('materialSendToVendor',$namevalue,$where);

}

if(trim($_POST['action'])=='costreceivedinhouseoutsource' && trim($_POST['st'])!=''){
include "config/mail.php";

$styleId= decode($_POST['st']);
$vendorId= decode($_POST['s']);
$remarks= trim($_POST['remarks']);
$emid= decode($_POST['emid']);

$select='';
$where='';
$rs='';
$select='*';
$where='id="'.$vendorId.'"';
$rs=GetPageRecord($select,'vendorMaster',$where);
$resListing=mysqli_fetch_array($rs);

$select12='*';
$where12='id="'.$styleId.'"';
$rs12=GetPageRecord($select12,'queryMaster',$where12);
$resListing12=mysqli_fetch_array($rs12);

$select1='*';
$where1='id="'.$resListing12['assignTo'].'"';
$rs1=GetPageRecord($select1,_USER_MASTER_,$where1);
$res=mysqli_fetch_array($rs1);

$selectimg='*';
$whereimg='parentId="'.$styleId.'" and galleryType="image_gallery" order by id asc';
$rsimg=GetPageRecord($selectimg,'imageGallery',$whereimg);
$imgresult=mysqli_fetch_array($rsimg);



$fromemail ='';
$mailto=$res['userName'];
$ccmail='';
$mailsubject='Re: Woodland Appreal ERP - New Style# '.getStyleRefId($styleId).'';

$mailbodyheader = '<table width="100%" style="max-width: 750px;margin: unset;background:#fff;border-left:1px solid #e4e4e4;border-right:1px solid #e4e4e4;border-bottom:1px solid #e4e4e4;font-family:Arial,Helvetica,sans-serif;" border="0" cellpadding="0" cellspacing="0" align="center">
  <tbody><tr>
    <td style="border-top: solid 4px #0d7444; line-height: 1;"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #e4e4e4;border-top:none">
        <tbody><tr>
          <td align="left" valign="top" style="padding:14px 0 0 11px">
	<a href="'.$fullurl.'" style="font-family:Arial,Helvetica,sans-serif;font-size:26px;color:#000;font-weight:700;text-decoration:none" target="_blank">
				<img src="'.$fullurl.'global_assets/images/woodland-logo2.png" alt="'.$fullurl.'global_assets/images/woodland-logo2.png">
			</a>
		</td>
          <td align="right" valign="top" style="padding:12px 11px 7px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#000">&nbsp;</td>
        </tr>
      </tbody></table></td>
</tr>
<tr>
<td>';


$maildescription = '<table style="width: 100%;margin: unset;background:#fff;border-left:1px solid #e4e4e4;border-right:1px solid #e4e4e4;border-bottom:1px solid #e4e4e4;font-family:Arial,Helvetica,sans-serif;" border="0" cellpadding="0" cellspacing="0" align="center">
  <tbody><tr>
    <td style="border-top: solid 4px #0d7444; line-height: 1;"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #e4e4e4;border-top:none">
        <tbody><tr>
          <td align="left" valign="top" style="padding:14px 0 0 11px">
	        <div style="font-family:Arial,Helvetica,sans-serif;font-size:26px;color:#000;font-weight:700;text-decoration:none">
				<img src="'.$fullurl.'global_assets/images/woodland-logo2.png" alt="">
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
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Greeting from '.$systemname.' - The Apparel ERP! .</p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Cost received from vendor: '.$resListing['name'].'</p>
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
   <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;"><img src="'.$fullurl.'images/'.$imgresult['attachmentImage'].'" style="width:90px;">
			</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">Style '.$resListing12['subject'].'</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.getCategoryName($resListing12['categoryId']).'</td>
	<td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.getSubCategoryName($resListing12['subCategoryId']).'</td>
	<td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.seasonName($resListing12['seasonId']).'</td>
	<td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.date('d M, Y',$resListing12['dateAdded']).'</td>
  </tr>


</tbody></table>
</div>
</td>
  </tr>

</tbody></table>
<p><a href="'.$fullurl.'submit-inhouseoutsource.php?st='.encode($styleId).'&cv='.encode(1).'&s='.encode($vendorId).'&emid='.encode($emid).'" style="background-color: #11b76c; border-radius: 4px; color: #fff!important; padding: 8px 18px; font-size: 14px; text-decoration: none; display: inline-block;" target="_blank" class="showhide" >View Cost</a></p>
';

if($_FILES['attachmentFile']['name']!=''){
$file_name=trim(addslashes($_FILES['attachmentFile']['name']));
$file_name=time().'-'.str_replace(' ', '_',$file_name);
$file_name= str_replace('#', 'f',$file_name);
copy($_FILES['attachmentFile']['tmp_name'],"images/".$file_name);
}else{
$file_name = $_POST['editvendorattachment'];
}

$dateAdded=time();
$maildescription1 = addslashes($maildescription);
$namevalue ='subject="'.$mailsubject.'",description="'.$maildescription1.'",adddate="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",styleid="'.$styleId.'",vendorid="'.$vendorId.'",supplierComment="'.addslashes($remarks).'",attachement="'.$file_name.'",status="2",pd=2';
$adds = addlisting('vendorPurchasemail',$namevalue);

$where11='id="'.$emid.'"';
$namevalue11 ='supplierComment="'.addslashes($remarks).'",attachement="'.$file_name.'"';
updatelisting('vendorPurchasemail',$namevalue11,$where11);

send_template_mail_query($fromemail,$mailto,$mailsubject,$maildescription,$ccmail);

?>
<script>
parent.window.location.href='submit-inhouseoutsource.php?st=<?php echo encode($styleId); ?>&cv=<?php echo encode(1); ?>&s=<?php echo encode($vendorId); ?>&emid=<?php echo encode($emid); ?>';
</script>
<?php

}

if(trim($_POST['action'])=='supplierattachment' && trim($_POST['st'])!=''){


include "config/mail.php";

$styleId= decode($_POST['st']);
$supplierId= decode($_POST['s']);
$remarks= trim($_POST['remarks']);
$emid= decode($_POST['emid']);

$select='';
$where='';
$rs='';
$select='*';
$where='id="'.$supplierId.'"';
$rs=GetPageRecord($select,'suppliersMaster',$where);
$resListing=mysqli_fetch_array($rs);

$select12='*';
$where12='id="'.$styleId.'"';
$rs12=GetPageRecord($select12,'queryMaster',$where12);
$resListing12=mysqli_fetch_array($rs12);

$select1='*';
$where1='id="'.$resListing12['assignTo'].'"';
$rs1=GetPageRecord($select1,_USER_MASTER_,$where1);
$res=mysqli_fetch_array($rs1);

$selectimg='*';
$whereimg='parentId="'.$styleId.'" and galleryType="image_gallery" order by id asc';
$rsimg=GetPageRecord($selectimg,'imageGallery',$whereimg);
$imgresult=mysqli_fetch_array($rsimg);



$fromemail ='';
$mailto=$res['userName'];
$ccmail='';
$mailsubject='Re: Woodland Appreal ERP - New Style# '.getStyleRefId($styleId).'';

$mailbodyheader = '<table width="100%" style="max-width: 750px;margin: unset;background:#fff;border-left:1px solid #e4e4e4;border-right:1px solid #e4e4e4;border-bottom:1px solid #e4e4e4;font-family:Arial,Helvetica,sans-serif;" border="0" cellpadding="0" cellspacing="0" align="center">
  <tbody><tr>
    <td style="border-top: solid 4px #0d7444; line-height: 1;"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #e4e4e4;border-top:none">
        <tbody><tr>
          <td align="left" valign="top" style="padding:14px 0 0 11px">
	<a href="'.$fullurl.'" style="font-family:Arial,Helvetica,sans-serif;font-size:26px;color:#000;font-weight:700;text-decoration:none" target="_blank">
				<img src="'.$fullurl.'global_assets/images/woodland-logo2.png" alt="'.$fullurl.'global_assets/images/woodland-logo2.png">
			</a>
		</td>
          <td align="right" valign="top" style="padding:12px 11px 7px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#000">&nbsp;</td>
        </tr>
      </tbody></table></td>
</tr>
<tr>
<td>';


$maildescription = '<table style="width: 100%;margin: unset;background:#fff;border-left:1px solid #e4e4e4;border-right:1px solid #e4e4e4;border-bottom:1px solid #e4e4e4;font-family:Arial,Helvetica,sans-serif;" border="0" cellpadding="0" cellspacing="0" align="center">
  <tbody><tr>
    <td style="border-top: solid 4px #0d7444; line-height: 1;"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #e4e4e4;border-top:none">
        <tbody><tr>
          <td align="left" valign="top" style="padding:14px 0 0 11px">
	        <div style="font-family:Arial,Helvetica,sans-serif;font-size:26px;color:#000;font-weight:700;text-decoration:none">
				<img src="'.$fullurl.'global_assets/images/woodland-logo2.png" alt="">
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
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Greeting from '.$systemname.' - The Apparel ERP! .</p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Cost received from vendor: '.$resListing['name'].'</p>
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
   <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;"><img src="'.$fullurl.'images/'.$imgresult['attachmentImage'].'" style="width:90px;">
			</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">Style '.$resListing12['subject'].'</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.getCategoryName($resListing12['categoryId']).'</td>
	<td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.getSubCategoryName($resListing12['subCategoryId']).'</td>
	<td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.seasonName($resListing12['seasonId']).'</td>
	<td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.date('d M, Y',$resListing12['dateAdded']).'</td>
  </tr>


</tbody></table>
</div>
</td>
  </tr>

</tbody></table>
<p><a href="'.$fullurl.'submit-supplier.php?st='.encode($styleId).'&cv='.encode(1).'&s='.encode($supplierId).'&emid='.encode($emid).'" style="background-color: #11b76c; border-radius: 4px; color: #fff!important; padding: 8px 18px; font-size: 14px; text-decoration: none; display: inline-block;" target="_blank" class="showhide" >View Cost</a></p>
';

if($_FILES['attachmentFile']['name']!=''){
$file_name=trim(addslashes($_FILES['attachmentFile']['name']));
$file_name=time().'-'.str_replace(' ', '_',$file_name);
$file_name= str_replace('#', 'f',$file_name);
copy($_FILES['attachmentFile']['tmp_name'],"images/".$file_name);
}else{
$file_name = $_POST['editvendorattachment'];
}

$dateAdded=time();
$maildescription1 = addslashes($maildescription);
$namevalue ='subject="'.$mailsubject.'",description="'.$maildescription1.'",adddate="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",styleid="'.$styleId.'",supplierid="'.$supplierId.'",supplierComment="'.addslashes($remarks).'",attachement="'.$file_name.'",status="2"';
$adds = addlisting('supplierPurchasemail',$namevalue);

$where11='id="'.$emid.'"';
$namevalue11 ='supplierComment="'.addslashes($remarks).'",attachement="'.$file_name.'"';
updatelisting('supplierPurchasemail',$namevalue11,$where11);

send_template_mail_query($fromemail,$mailto,$mailsubject,$maildescription,$ccmail);

?>
<script>
parent.window.location.href='submit-supplier.php?st=<?php echo encode($styleId); ?>&cv=<?php echo encode(1); ?>&s=<?php echo encode($supplierId); ?>&emid=<?php echo encode($emid); ?>';
</script>
<?php

}

?>