<?php
ob_start();
include "inc.php";
$assignto="Download";

header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment; filename=\"".$assignto."_".date('d-m-Y-H-i-s').".xls");
header("Cache-control: private");

?>

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

$i=1;
while($i<6){

$select='*';
$id=clean(decode($_GET['styleid']));
$where='id='.$id.'';
$rs=GetPageRecord($select,_QUERY_MASTER_,$where);
$resultpage=mysqli_fetch_array($rs);

if($_GET['styleid']!='' && $resultpage['tnaTemplateId']!='0'){

$selecttask='*';
//$wheretask='1 and status=1 and tnatemplate="'.$resultpage['tnaTemplateId'].'" order by id asc';

$wheretask='1 and tnatemplate="'.$resultpage['tnaTemplateId'].'" order by id asc';

$rstask=GetPageRecord($selecttask,'taskListMaster',$wheretask);

while($reslisttask1=mysqli_fetch_array($rstask)){

//echo $reslisttask1['name'].'==<br>';

$wherecheck='styleId="'.$id.'" and taskListId="'.$reslisttask1['id'].'" and temid="'.$resultpage['tnaTemplateId'].'"';

$addnewyes = checkduplicate('timeActionReport',$wherecheck);

if($addnewyes!='yes'){

//============================================///////////////////////////

//echo '1 and criPath in (select criticalPath from taskListMaster where name="'.$reslisttask1['name'].'" and tnatemplate="'.$resultpage['tnaTemplateId'].'") and styleId="'.$id.'"';

$a=GetPageRecord('complitionDate','timeActionReport','1 and criPath in (select criticalPath from taskListMaster where name="'.$reslisttask1['name'].'" and tnatemplate="'.$resultpage['tnaTemplateId'].'") and styleId="'.$id.'"');
$criData=mysqli_fetch_array($a);

//echo $criData.'==========';

$aaaaaa=GetPageRecord('id','taskListMaster','1 and tnatemplate="'.$resultpage['tnaTemplateId'].'" and id="'.$reslisttask1['id'].'" and criticalPath in (select criPath from timeActionReport where complitionDate!="" and complitionDate!="1970-00-00" and complitionDate!="0000-00-00" and styleId="'.$id.'")');

$counttimeaction=0;

$counttimeaction=mysql_num_rows($aaaaaa);

//echo "==========".$reslisttask1['criticalPath'].'===';

if($reslisttask1['criticalPath']==0 || $counttimeaction>0){

$comDate= date('Y-m-d', strtotime($criData['complitionDate']. ''.$reslisttask1['totaldays'].' days'));

if($reslisttask1['name']==3){
$comDate=$editresultstyle['ocdDate'];
}

if($reslisttask1['name']==49){
$comDate=$editresultstyle['shipDate'];
}

$namevaluetask ='taskListId="'.$reslisttask1['id'].'",styleId="'.$id.'",status=1,complitionDate="'.$comDate.'",actualDate="1970-01-01",totaldays="'.$reslisttask1['totaldays'].'",temid="'.$resultpage['tnaTemplateId'].'",criPath="'.$reslisttask1['name'].'"';

addlistinggetlastid('timeActionReport',$namevaluetask);
}

}
}

}

$i++;
}


?>

                     	<table class="table table-bordered" style="font-size: 12px;" width="100%">
							<thead>

								<tr class="border-top-info" style="background-color: #fff7b3;text-align: left;">
								  <th width="7%" align="center"><div align="center"><strong>SR</strong></div></th>
									<th width="19%"><strong>Key&nbsp;Processes </strong></th>
									<th width="10%">Planned</th>
									<th width="9%">Actual</th>

								</tr>
							</thead>
							<tbody style="background:#f5f5f5;">
								<?php
								$snoo=0;
								//$rs=GetPageRecord('*','taskListMaster','deletestatus=0 and status=1 and tnatemplate="'.$editresultstyle['tnaTemplateId'].'" and tna=1 order by id asc');

								$rs=GetPageRecord('*','taskListMaster','1 and tnatemplate="'.$editresultstyle['tnaTemplateId'].'" order by sr asc');
								while($reslisttask=mysqli_fetch_array($rs)){

								$where1='taskListId="'.$reslisttask['id'].'" and styleId="'.$resultpage['id'].'" and status=1';
								$rs1=GetPageRecord('*','timeActionReport',$where1);
								$data=mysqli_fetch_array($rs1);


								?>

								  <tr class="border-top-info">
								  <td align="center"><?php echo ++$snoo; ?></td>
								   <?php
                                    $activityquery=GetPageRecord('name','tnaActivityMaster','1 and id="'.$reslisttask['name'].'"');
                                    $activityData=mysqli_fetch_array($activityquery);
                                    //$names=$activityData['name'];
                                    ?>

								   <td><?php  echo $activityData['name'];?></td>



									<td style="background-color: #f5f5f5; font-size: 16px;"><?php if($data['complitionDate']!='' && $data['complitionDate']!='1970-01-01' && $data['complitionDate']!='0000-00-00'){ echo date('d-m-Y', strtotime($data['complitionDate'])); } ?></td>

									<td style=""><?php if($data['actualDate']!='' && $data['actualDate']!='1970-01-01' && $data['actualDate']!='0000-00-00'){ echo date('d-m-Y', strtotime($data['actualDate'])); } ?></td>

								</tr>



<script>
function addremarks<?php echo $data['id']; ?>(){
	var taskListId = '<?php echo $data['id']; ?>';
	var remark = encodeURI($('#remark<?php echo $data['id'];?>').val());
$('#hiddentasklistremarkrkr').load('loadtimeaction.php?action=timeactionremarks&styleid=<?php echo $resultpage['id'];?>&taskid='+taskListId+'&remark='+remark);
}
</script>
<div id="hiddentasklistremarkrkr" style=" display:none;"></div>

<?php  }  ?>
								</tbody>
						  </table>

                       <td width="100%" style="text-align:center;"><strong style="font-size: 25; font-weight: 700;">Fabric Status</strong></td>

                       <table width="100%" class="table table-bordered table-responsive forbom" id="tableid11" style="display:block;" >
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body" style="background-color: #fff7b3;;">

                              <td width="" align="center"><strong>Material/Item&nbsp;Name</strong></td>
                             <td width="" align="center"><strong>Supplier</strong></td>

							  <td width="" align="center"><strong>Material&nbsp;Qty</strong></td>
							<!--  <td width="12%" align="center"><strong>Stock&nbsp;In&nbsp;Store</strong></td>-->
							 <!-- <td width="12%" align="center"><strong>Total&nbsp;allowance(%)</strong></td>-->
							  <td width="" align="center"><strong>Order&nbsp;Qty</strong></td>
							  					 <td width="" align="center"><strong>Received</strong></td>

                      <td width="12%" align="center"><strong>Balance</strong></td>


							</tr>






<?php






$rs1=GetPageRecord('*','styleSubCategoryMaster','styleId="'.decode($_GET['styleid']).'" and costsheetVersionId="'.$editresultstyle['defaultcostsheetVersionId'].'" and materialType="1" and parentId=0 order by sr asc');
while($resListing1=mysqli_fetch_array($rs1)){
$color='';
$rowno++;
$sNo1=$rowno;

$colorno=1;
$rs12=GetPageRecord('*','purchaseOrderStyleMaster','styleId="'.decode($_GET['styleid']).'" and sectionType=0 order by id asc');
while($result1=mysqli_fetch_array($rs12)){








$orderQty='';
$size='';
$totalMaterialQty = '0';

$rs2=GetPageRecord('*','purchaseOrderStyleMaster','parentId="'.$result1['id'].'"');
while($result2=mysqli_fetch_array($rs2)){
$size.=$result2['size'].',';
$orderQty+=$result2['gdQty'];
$orderQty = round($orderQty);
$color = $result2['color'];

}


$rs121=GetPageRecord('*','techPackDetailMaster',' stylesubtabid="'.$resListing1['id'].'" and sectionType="bom" and styleId="'.$resListing1['styleId'].'" and costsheetVersionId="'.$editresultstyle['defaultcostsheetVersionId'].'" order by id asc');
$resListing12=mysqli_fetch_array($rs121);

$totalallowance=0;
$totalallow = 0;
$rspro=GetPageRecord('*','rejectioninproductionmaster','1 and qty>'.$orderQty.'');
$resultpro=mysqli_fetch_array($rspro);
$totalallowance = $resultpro['totalallwance'];
$orderQty = round($orderQty+(($orderQty*$totalallowance)/100));

$totalMaterialQty =  round($orderQty*$resListing12['avgIncWastage'],3);

$totalMaterialValue = round($totalMaterialQty*$resListing12['bomRate'],3);

?>

<tr class="card-body">


<td width="15%" align="center">
<div  data-toggle="modal" data-target=""><?php echo  $resListing1['name']; ?></div>
</td>

<td width="12%" align="center"><?php  echo getSupplierName($resListing12['storesupplier']); ?></td>


<td width="12%" align="center">
    <?php
    $rsListitemq=GetPageRecord('*','indentCreationMaster','styleId="'.decode($_GET['styleid']).'" and materialTypeId="1" and materialId="'.$resListing1['id'].'" and color="'.$color.'"');
				$rsListitem=mysqli_fetch_array($rsListitemq);
				$a=$rsListitem['poQty']*$rsListitem['avg'];
				echo $a;
    ?>

</td>


<td width="12%" align="center">

<?php
$rsgrnrec=GetPageRecord('sum(netReceived) as netReceivedTill,color,parentId','grnMaster','styleId="'.decode($_GET['styleid']).'" and materialId="'.$resListing1['id'].'" and color="'.$color.'"');
$rsgrnrecTill=mysqli_fetch_array($rsgrnrec);

echo round($rsgrnrecTill['netReceivedTill'],2);

?>
</td>
<td width="12%" align="center"><?php echo round($rsgrnrecTill['netReceivedTill'],2); ?></td>


<?php

$fire=$rsgrnrecTill['netReceivedTill'];
$fire1=$rsgrnrecTill['netReceivedTill'];


?>
<td><?php echo $fire-$fire1; ?></td>

</tr>
<?php  } }  ?>
</tbody>
</table>


<td width="100%" style="text-align:center;"><strong style="font-size: 25px; font-weight: 700;">Trim Status</strong></td>
<table width="100%" class="table table-bordered table-responsive forbom" id="tableid11" style="display:block;" >
<tbody style="width: 100%;display: inline-table;">
<tr class="card-body" style="background-color: #fff7b3;;">

<td width="" align="center"><strong>Material/Item&nbsp;Name</strong></td>
<td width="" align="center"><strong>Supplier</strong></td>

<td width="" align="center"><strong>Material&nbsp;Qty</strong></td>
<!--  <td width="12%" align="center"><strong>Stock&nbsp;In&nbsp;Store</strong></td>-->
<!-- <td width="12%" align="center"><strong>Total&nbsp;allowance(%)</strong></td>-->
<td width="" align="center"><strong>Order&nbsp;Qty</strong></td>
<td width="" align="center"><strong>Received</strong></td>


<td width="12%" align="center"><strong>Balance</strong></td>




</tr>
<?php
$no="1";
$sNo1=0;
$rowno=0;
$rstype=GetPageRecord('*','materialTypeMaster',' 1 and id="2" order by id asc');
while($resListingtype=mysqli_fetch_array($rstype)){
?>

<?php
$rs1=GetPageRecord('*','styleSubCategoryMaster','styleId="'.decode($_GET['styleid']).'" and costsheetVersionId="'.$editresultstyle['defaultcostsheetVersionId'].'" and materialType="'.$resListingtype['id'].'" and parentId=0 order by sr asc');
while($resListing1=mysqli_fetch_array($rs1)){
$color='';
$rowno++;
$sNo1=$rowno;

$colorno=1;
$rs12=GetPageRecord('*','purchaseOrderStyleMaster','styleId="'.decode($_GET['styleid']).'" and sectionType=0 order by id asc');
while($result1=mysqli_fetch_array($rs12)){

$orderQty='';
$size='';
$totalMaterialQty = '0';

$rs2=GetPageRecord('*','purchaseOrderStyleMaster','parentId="'.$result1['id'].'"');
while($result2=mysqli_fetch_array($rs2)){
$size.=$result2['size'].',';
$orderQty+=$result2['gdQty'];
$orderQty = round($orderQty);
$color = $result2['color'];

}


$rs121=GetPageRecord('*','techPackDetailMaster',' stylesubtabid="'.$resListing1['id'].'" and sectionType="bom" and styleId="'.$resListing1['styleId'].'" and costsheetVersionId="'.$editresultstyle['defaultcostsheetVersionId'].'" order by id asc');
$resListing12=mysqli_fetch_array($rs121);

$totalallowance=0;
$totalallow = 0;
$rspro=GetPageRecord('*','rejectioninproductionmaster','1 and qty>'.$orderQty.'');
$resultpro=mysqli_fetch_array($rspro);
$totalallowance = $resultpro['totalallwance'];
$orderQty = round($orderQty+(($orderQty*$totalallowance)/100));

$totalMaterialQty =  round($orderQty*$resListing12['avgIncWastage'],3);

$totalMaterialValue = round($totalMaterialQty*$resListing12['bomRate'],3);

?>

<?php
$tillTotalMaterialQty=0;
if($resListing1['sizeSeparate']==0){
$tillTotalMaterialQty=0;
$rsindent=GetPageRecord('SUM(orderQty) as tillorderQty','indentCreationMaster','styleId="'.$resListing1['styleId'].'" and techpackdetailId="'.$resListing12['id'].'" and styleSubCatTableId="'.$resListing1['id'].'" and color="'.$color.'" and size="'.$size.'"');
$resListingIndent1=mysqli_fetch_array($rsindent);

$tillTotalMaterialQty= $totalMaterialQty-$resListingIndent1['tillorderQty'];

?>

<tr class="card-body">

<td width="15%" align="center">
<div  data-toggle="modal" data-target=""><?php echo  $resListing1['name']; ?></div>
</td>
<td width="12%" align="center"><?php  echo getSupplierName($resListing12['storesupplier']); ?></td>


<td width="12%" align="center">

    <?php
    $rsListitemqs=GetPageRecord('*','indentCreationMaster','styleId="'.decode($_GET['styleid']).'" and materialTypeId="2" and materialId="'.$resListing1['id'].'" and color="'.$color.'"');
				$rsListitems=mysqli_fetch_array($rsListitemqs);
				$sa=$rsListitems['poQty']*$rsListitems['avg'];
				echo $sa;
    ?>

</td>

<td width="12%" align="center">
<?php
$rsgrnrecs=GetPageRecord('sum(netReceived) as netReceivedTill,color,parentId','grnMaster','styleId="'.decode($_GET['styleid']).'" and materialId="'.$resListing1['id'].'" and color="'.$color.'"');
$rsgrnrecTills=mysqli_fetch_array($rsgrnrecs);

echo round($rsgrnrecTills['netReceivedTill'],2);

?></td>


<td width="12%" align="center"><?php  echo round($rsgrnrecTills['netReceivedTill'],2); ?></td>
<?php

$fire=$rsgrnrecTills['netReceivedTill'];
$fire1=$rsgrnrecTills['netReceivedTill'];


?>

<td><?php echo $fire-$fire1; ?></td>

</tr>
<?php  } } } } ?>
</tbody>
</table>


   <td width="100%" style="text-align:center;"><strong style="font-size: 25px; font-weight: 700;">PO&nbsp;&&nbsp;CD&nbsp;Summary</strong></td>
<table class="table erptab table-hover" style="width:100%">
                     <tr style="background-color: #fff7b3;">


<td><div style="text-transform:capitalize;color: black;"><b>PO Number</b></div></td>
<td><div style="text-transform:capitalize;color:  black;"><b>Ship Mode</b></div></td>

<td><div style="text-transform:capitalize;color:  black;"><b>Delivery Term</b></div></td>
<td><div style="text-transform:capitalize;color:  black;"><b>PO Quantity</b></div></td>
<td><div style="text-transform:capitalize;color:  black;"><b>Ex-factory Start</b></div></td>
<td><div style="text-transform:capitalize;color:  black;"><b>Ex-factory End</b></div></td>
<td><div style="text-transform:capitalize;color:  black;"><b>Cutoff Date</b></div></td>
<td><div style="text-transform:capitalize;color:  black;"><b>CD's Received Date</b></div></td>
<td><div style="text-transform:capitalize;color:  black;"><b>Actual Ex-Factory Date</b></div></td>


</tr>
	   	 <?php
		 $count=1;
		$rrrr=GetPageRecord('*','poManageMaster','1  and styleId="'.decode($_GET['styleid']).'"');
		while($operationData=mysqli_fetch_array($rrrr)){
		?>
		<tbody>
			<tr>


              <td><?php echo $operationData['poNumber']; ?></td>
              <td><?php echo $operationData['shipMode']; ?></td>
               <td><?php echo $operationData['deliveryTerm']; ?></td>
              <td><?php echo $operationData['poQty']; ?></td>
              <td> <?php if($operationData['factStart']!="") { echo date('d-m-Y',strtotime($operationData['factStart'])); } else{ echo "-"; } ?> </td>
              <td> <?php if($operationData['factEnd']!="") { echo date('d-m-Y',strtotime($operationData['factEnd'])); } else{ echo "-"; } ?> </td>
			  <td> <?php if($operationData['cutoffDate'] !="") { echo date('d-m-Y',strtotime($operationData['cutoffDate'])); } else{ echo "-"; } ?> </td>
			    <td>-</td>
			   <td>-</td>
			</tr>
		</tbody>
		<?php $count++; } ?>
 </tr>
 </table>

  <style>
 .liststyleimg{float: left;
    width: 70px;
    margin-right: 15px;
    padding: 5px;
    border: 2px solid #e6e6e6;}

	.badge.dropdown-toggle:after { display:none;
}

.btn-float i {
    display: block;
    top: 0;
    font-size: 20px;
}

.card-group-control-right .card-body{width:100%;}

.table td, .table th {
    vertical-align: middle !important;
}

.form-control {
    display: block;
    width: 100%;
    font-size: .8125rem;
    line-height: 1.5385;
    color: #5d5d5d;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #d8d8d8;
    border-radius: 2px;
    box-shadow: 0 0 0 0 transparent;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.listc .table-bordered td, .table-bordered th {
    border: 1px solid #ddd !important;
    padding: 8px;
}


 </style>