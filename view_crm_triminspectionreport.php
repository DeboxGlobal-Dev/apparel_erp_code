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
				<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title">Trim  Inspection Report </h6>

							</div>


				<div class="card-body">
				<div class="form-group">


				<div class="row">
				<table width="100%" border="0" cellpadding="5" cellspacing="0" class="table table-bordered table-responsive input-table" style="font-size:11px !important;">

  <tr height="61" style="padding: 10px; font-size: 11px; font-weight: 600; background-color: #F8F8F8; margin-top: 10px; position: relative;">
    <td height="109" width="37"><div align="left"><strong>Lot</strong></div></td>
    <td  height="109" width="46"><div align="center">Item/Trim</div></td>
    <td  width="34"><div align="center">Item&nbsp;Code</div></td>
    <td width="108" align="center"><div align="center">Vendor&nbsp;name</div></td>
    <td width="81" align="center"><div align="center">P.O&nbsp;No.</div></td>
    <td width="72"><div align="center">Required&nbsp;Qty.</div></td>
    <td width="56"><div align="center">Total&nbsp;order&nbsp;qty</div></td>
    <td width="42"><div align="center">Lot&nbsp;receiving&nbsp;date</div></td>
    <td width="53"><div align="center">Rcvd&nbsp;qty&nbsp;for&nbsp;this&nbsp;lot</div></td>
    <td width="87"><div align="center">Total&nbsp;rcvd&nbsp;till&nbsp;now</div></td>
    <td  width="87"><div align="center">Balance&nbsp;to&nbsp;receive</div></td>
    <td  width="87"><div align="center">Inspection&nbsp;date</div></td>
    <td  width="87"><div align="center">Okay&nbsp;Qty.</div></td>
    <td  width="87"><div align="center">Rejected&nbsp;Qty.</div></td>
    <td width="87"><div align="center">Disputed&nbsp;Qty</div></td>
    <td  width="87"><div align="center">Remarks</div></td>
  </tr>

  <?php
  $sNo2 = 0;
$select='';
$where='';
$rs='';
$select='*';
$where=' styleId="'.decode($_GET['styleid']).'" and costsheetVersionId=1 and status=1 and deletestatus=0 and lotNoMaster="'.decode($_REQUEST['lotId']).'" order by id asc';
$rs=GetPageRecord($select,'trimdatamaster',$where);
while($resListing1=mysqli_fetch_array($rs)){
$sNo2++;
?>

<tr height="20">

<td height="20"><div align="left" style="width: 40px;">
<?php
$lotDataq=GetPageRecord('name','lotMaster','1 and id="'.$resListing1['lotNoMaster'].'" order by id');
$lotData=mysqli_fetch_array($lotDataq);
echo $lotData['name']; ?>
</div></td>



<td height="20"><div align="center"><?php echo stripslashes($resListing1['item_trims']); ?></div></td>

<td height="20" align="right"><div align="center"><?php echo stripslashes($resListing1['item_code']); ?></div></td>

<td height="20" align="right"><div align="center"><?php echo stripslashes($resListing1['vendor_name']); ?></div></td>


<td height="20" align="right"><div align="center"><?php echo stripslashes($resListing1['pono']); ?></div></td>

<td height="20" align="right"><div align="center"><?php echo stripslashes($resListing1['receivedqty']); ?></div></td>

<td height="20" align="right"><div align="center"><?php echo stripslashes($resListing1['totalorderqty']); ?></div></td>


<td height="20" align="right"><div align="center" style="width:80px;"><?php echo stripslashes(date('d-m-Y',strtotime($resListing1['lotreceiveddate']))); ?></div></td>



<td height="20" align="right"><div align="center"><?php echo stripslashes($resListing1['recievedutytlot']); ?></div></td>


<td height="20" align="right"><div align="center"><?php echo stripslashes($resListing1['recievedutytillnow']); ?></div></td>


<td height="20" align="right"><div align="center"><?php echo stripslashes($resListing1['balancetoreceive']); ?></div></td>

<td height="20" align="right"><div align="center" style="width: 80px;"><?php echo stripslashes(date('d-m-Y',strtotime($resListing1['inspectiondate']))); ?></div></td>


<td height="20" align="right"><div align="center"><?php echo stripslashes($resListing1['okayqty']); ?></div></td>


<td height="20" align="right"><div align="center"><?php echo stripslashes($resListing1['rejectedqty']); ?></div></td>


<td height="20" align="right"><div align="center"><?php echo stripslashes($resListing1['disputedqty']); ?></div></td>


<td width="53" align="center"><div align="center" style="width:200px;"><?php echo stripslashes($resListing1['remarks']); ?></div></td>
  </tr>

  <?php } ?>
</table>


 </div>

 <div class="row" style="    margin-top: 20px;">
<?php
$rl=GetPageRecord('*','qualityreportmaster',' styleId="'.decode($_REQUEST['styleid']).'" and type="triminspectioninput" and lotId="'.decode($_REQUEST['lotId']).'"');
$trimData=mysqli_fetch_array($rl);
?>
 <table cellpadding="5" cellspacing="0" style="width:100%;">
 <tr>
 <td colspan="6" style="padding:0px !important;"><div style="padding: 10px 15px; border: 1px solid #ccc; font-size: 16px; cursor: pointer; background-color: #f8f8f8; position: relative; font-weight: 500; color: #000000; width: 100%; box-sizing: border-box;">Closure Type</div></td>
 </tr>
 <tr style="background-color:#fff;">
 <td width="13%"><div align="center">Accpeted</div></td>
 <td width="18%"><div align="center">Re-processing</div></td>
 <td width="19%"><div align="center">Rejected /Replaced	</div></td>
 <td width="17%"><div align="center">On Hold</div></td>
 <td width="17%"><div align="center">Date</div></td>
  <td width="16%"><div align="center">Closure By</div></td>
 </tr>

  <tr height="30" style="padding: 10px 15px; border: 1px solid #00b5ea; font-size: 14px; cursor: pointer; background-color: #00b5ea; position: relative; font-weight: 500; color: #ffffff; width: 100%; box-sizing: border-box;">
 <td> <div align="center">
  <?php echo stripslashes($trimData['accepted']); ?>
 </div></td>
 <td> <div align="center">
     <?php echo stripslashes($trimData['reprocessing']); ?>
 </div></td>
 <td> <div align="center">
    <?php echo stripslashes($trimData['rejectedreplaced']); ?>
 </div></td>
 <td> <div align="center">
    <?php echo stripslashes($trimData['onhold']); ?>
 </div></td>


<td height="20" align="right"><div align="center">
    <?php if($trimData['closurDate']!="" && $trimData['closurDate']!="0000-00-00" && $trimData['closurDate']!="1970-01-01"){echo stripslashes(date('d-m-Y',strtotime($trimData['closurDate']))); } ?></div></td>

 <td> <div align="center">
  <?php echo stripslashes($trimData['closureby']); ?>
  </div></td>


 </tr>
 </table>

 </div>


			  	  </div>

</div>
 </div>
 </div>
	  </div>






</div>

<style>
.input-table tr td, .input-table tr th {
    padding: 5px !important;
}
</style>
