<?php
ob_start();
include "inc.php";
$assignto="Download";

header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment; filename=\"".$assignto."_".date('d-m-Y-H-i-s').".xls");
header("Cache-control: private");

?>
                     <table class="table table-bordered capacity-class" style="width:100%;">
         		     <thead>
                            <tr style="background-color: #e9fff8;">
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Brand</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style#</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Material Name</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Quantity Ordered</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Quantity Received</th>

							 <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Supplier </th>
							 <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">GE Number </th>
							 <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">GE Date </th>
							 <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">GRN Number </th>
							 <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">GRN Date  </th>
                             </tr>
                             </thead>
                             <tbody id="allhotellisting">
  <?php

if($_POST['stylerefid']!=''){
$stylerefCondition = 'and id="'.decode($_POST['stylerefid']).'"';
}

$bd=GetPageRecord('*','queryMaster','1 and subject!="" '.$stylerefCondition.' and deletestatus=0 and sampleStyle=1 and poAttachment!="" order by id desc');
while($queryData=mysqli_fetch_array($bd)){

$rsqty=GetPageRecord('qtyTotal','buyerPurchaseOrderMaster','styleId="'.$queryData['id'].'"');
$resultqty=mysqli_fetch_array($rsqty);

$tnadata="";
$tnadataaaaa="";
$tnadataq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$queryData['id'].'" and taskListId in (select id from taskListMaster where name in (select id from tnaActivityMaster where name="Ex-Factory Start Date")) order by id');
$tnadata=mysqli_fetch_array($tnadataq);

$tnadataaaaaq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$queryData['id'].'" and taskListId in (select id from taskListMaster where name in (select id from tnaActivityMaster where name="Ex-Factory End Date")) order by id');
$tnadataaaaa=mysqli_fetch_array($tnadataaaaaq);


$id=$queryData['id'];

// $materialType=decode($_GET['materialType']);
// $styleDataq=GetPageRecord('styleRefId,sampleStyle','queryMaster','1 and id="'.$id.'"');
// $styleData=mysqli_fetch_array($styleDataq);
// $matListDataq=GetPageRecord('name','materialTypeMaster','1 and id="'.$materialType.'"');
// $matListData=mysqli_fetch_array($matListDataq);

 $sr=1;
				 $gateEntryno='';
				 $rsListDatassq=GetPageRecord('*','grnMaster','1 and styleId="'.$id.'" and materialid in ( select id from styleSubCategoryMaster where materialType="1") group by color,materialId');
				 while($rsListDatass=mysqli_fetch_array($rsListDatassq)){


						 	$where2='styleId="'.$id.'" and materialType="1" and id="'.$rsListDatass['materialId'].'"';
				$rs2=GetPageRecord('*','styleSubCategoryMaster',$where2);
				while($matData=mysqli_fetch_array($rs2))
				{

				  $tsq=GetPageRecord('bomPlacement,storesupplier,supplierartname,bomAvg','techPackDetailMaster','1 and stylesubtabid='.$matData['id'].' order by id asc');
    	         $techShellData=mysqli_fetch_array($tsq);

    	       $rsd=GetPageRecord('*','grnMaster','1  and styleId="'.$queryData['styleId'].'"');
               $operationData3=mysqli_fetch_array($rsd);

               	$rsgrnrec=GetPageRecord('sum(netReceived) as netReceivedTill,color,parentId','grnMaster','styleId="'.$id.'" and materialId="'.$rsListDatass['materialId'].'" and color="'.$rsListDatass['color'].'"');
				$rsgrnrecTill=mysqli_fetch_array($rsgrnrec);

				$rsd=GetPageRecord('*','gateentrymaster','1  and registerno="Fabric"');
                $operationD=mysqli_fetch_array($rsd);

				?>

                                <tr>

                                <tr role="row" class="odd">
							    <td><?php echo getBrandName($queryData['brandId']); ?></td>
							    <td><?php echo $queryData['styleRefId'];?></td>





							<!--<td></td> -->

							 <td><?php echo $matData['name'];?></td>
							 <td><?php echo $resultqty['qtyTotal']; ?></td>
							 <td><?php echo round($rsgrnrecTill['netReceivedTill'],2); ?></td>



							 <td>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <?php echo getsupplierCompany($techShellData['storesupplier']); ?></td>
							 <td><?php
					$rsgrndata=GetPageRecord('*','grnMaster','styleId="'.$id.'" and materialId="'.$rsListDatass['materialId'].'" and color="'.$rsListDatass['color'].'"');
					while($rsgrndatalist=mysqli_fetch_array($rsgrndata)){
					$rsgrnno=GetPageRecord('gateEntryNo,grnNo','grnMaster','id="'.$rsgrndatalist['parentId'].'"');
					$rsgrnnolist=mysqli_fetch_array($rsgrnno);
					?>
                    <span style="font-weight:600; color:#00CC33;">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  <?php echo makeQueryId($rsgrnnolist['gateEntryNo']); ?></span>
                    <?php } ?>
                    </td>
							 <td><?php echo date('d-m-Y',strtotime($operationD['entrydate'])); ?></td>
							 <td><?php
					$rsgrndata=GetPageRecord('*','grnMaster','styleId="'.$id.'" and materialId="'.$rsListDatass['materialId'].'" and color="'.$rsListDatass['color'].'"');
					while($rsgrndatalist=mysqli_fetch_array($rsgrndata)){
					$rsgrnno=GetPageRecord('gateEntryNo,grnNo, docDate', 'grnMaster','id="'.$rsgrndatalist['parentId'].'"');
					$rsgrnnolist=mysqli_fetch_array($rsgrnno);
					?>
       <span style="font-weight:600; color: #0033FF;">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <?php echo $rsgrnnolist['grnNo']; ?></span>
                    <?php } ?>
                    </td>


							 <td><?php if($rsgrnnolist['docDate']!=''){ echo date('d-m-Y',strtotime($rsgrnnolist['docDate'])); }else{ echo '-'; } ?></td>

						     </tr>
                            <?php } } } ?>

                              <?php

if($_POST['stylerefid']!=''){
$stylerefCondition = 'and id="'.decode($_POST['stylerefid']).'"';
}

$bd=GetPageRecord('*','queryMaster','1 and subject!="" '.$stylerefCondition.' and deletestatus=0 and sampleStyle=1 and poAttachment!="" order by id desc');
while($queryData=mysqli_fetch_array($bd)){

$rsqty=GetPageRecord('qtyTotal','buyerPurchaseOrderMaster','styleId="'.$queryData['id'].'"');
$resultqty=mysqli_fetch_array($rsqty);

$tnadata="";
$tnadataaaaa="";
$tnadataq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$queryData['id'].'" and taskListId in (select id from taskListMaster where name in (select id from tnaActivityMaster where name="Ex-Factory Start Date")) order by id');
$tnadata=mysqli_fetch_array($tnadataq);

$tnadataaaaaq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$queryData['id'].'" and taskListId in (select id from taskListMaster where name in (select id from tnaActivityMaster where name="Ex-Factory End Date")) order by id');
$tnadataaaaa=mysqli_fetch_array($tnadataaaaaq);


$id=$queryData['id'];

// $materialType=decode($_GET['materialType']);

// $styleDataq=GetPageRecord('styleRefId,sampleStyle','queryMaster','1 and id="'.$id.'"');
// $styleData=mysqli_fetch_array($styleDataq);

// $matListDataq=GetPageRecord('name','materialTypeMaster','1 and id="'.$materialType.'"');
// $matListData=mysqli_fetch_array($matListDataq);

 $sr=1;
				 $gateEntryno='';
				 $rsListDatassq=GetPageRecord('*','grnMaster','1 and styleId="'.$id.'" and materialid in ( select id from styleSubCategoryMaster where materialType="2") group by color,materialId');
				 while($rsListDatass=mysqli_fetch_array($rsListDatassq)){


				$where2='styleId="'.$id.'" and materialType="2" and id="'.$rsListDatass['materialId'].'"';
				$rs2=GetPageRecord('*','styleSubCategoryMaster',$where2);
				while($matData=mysqli_fetch_array($rs2))
				{

				  $tsq=GetPageRecord('bomPlacement,storesupplier,supplierartname,bomAvg','techPackDetailMaster','1 and stylesubtabid='.$matData['id'].' order by id asc');
    	         $techShellData=mysqli_fetch_array($tsq);

    	         $rsd=GetPageRecord('*','grnMaster','1  and styleId="'.$queryData['styleId'].'"');
               $operationData3=mysqli_fetch_array($rsd);

               	$rsgrnrec=GetPageRecord('sum(netReceived) as netReceivedTill,color,parentId','grnMaster','styleId="'.$id.'" and materialId="'.$rsListDatass['materialId'].'" and color="'.$rsListDatass['color'].'"');
				$rsgrnrecTill=mysqli_fetch_array($rsgrnrec);

				$rsd=GetPageRecord('*','gateentrymaster','1  and registerno="Trim"');
               $operationD=mysqli_fetch_array($rsd);

						?>

                                <tr>

                                <tr role="row" class="odd">
							    <td><?php echo getBrandName($queryData['brandId']); ?></td>
							    <td><?php echo $queryData['styleRefId'];?></td>





							<!--<td></td> -->

							 <td><?php echo $matData['name'];?></td>
							 <td><?php echo $resultqty['qtyTotal']; ?></td>
							 <td><?php echo round($rsgrnrecTill['netReceivedTill'],2); ?></td>



							 <td><?php echo getsupplierCompany($techShellData['storesupplier']); ?></td>
							 <td><?php
					$rsgrndata=GetPageRecord('*','grnMaster','styleId="'.$id.'" and materialId="'.$rsListDatass['materialId'].'" and color="'.$rsListDatass['color'].'"');
					while($rsgrndatalist=mysqli_fetch_array($rsgrndata)){
					$rsgrnno=GetPageRecord('gateEntryNo,grnNo,docDate', 'grnMaster','id="'.$rsgrndatalist['parentId'].'"');
					$rsgrnnolist=mysqli_fetch_array($rsgrnno);
					?>
                    <span style="font-weight:600; color:#00CC33;"><?php echo makeQueryId($rsgrnnolist['gateEntryNo']); ?></span>
                    <?php } ?>
                    </td>
					<td><?php echo date('d-m-Y',strtotime($operationD['entrydate'])); ?></td>
					<td><?php
					$rsgrndata=GetPageRecord('*','grnMaster','styleId="'.$id.'" and materialId="'.$rsListDatass['materialId'].'" and color="'.$rsListDatass['color'].'"');
					while($rsgrndatalist=mysqli_fetch_array($rsgrndata)){
					$rsgrnno=GetPageRecord('gateEntryNo,grnNo,docDate','grnMaster','id="'.$rsgrndatalist['parentId'].'"');
					$rsgrnnolist=mysqli_fetch_array($rsgrnno);
					?>
                    <span style="font-weight:600; color: #0033FF;"><?php echo $rsgrnnolist['grnNo']; ?></span>
                    <?php } ?>
                    </td>


							 <td><?php if($rsgrnnolist['docDate']!=''){ echo date('d-m-Y',strtotime($rsgrnnolist['docDate'])); }else{ echo '-'; } ?></td>

						     </tr>
                            <?php } } } ?>

                                        <?php

if($_POST['stylerefid']!=''){
$stylerefCondition = 'and id="'.decode($_POST['stylerefid']).'"';
}

$bd=GetPageRecord('*','queryMaster','1 and subject!="" '.$stylerefCondition.' and deletestatus=0 and sampleStyle=1 and poAttachment!="" order by id desc');
while($queryData=mysqli_fetch_array($bd)){

$rsqty=GetPageRecord('qtyTotal','buyerPurchaseOrderMaster','styleId="'.$queryData['id'].'"');
$resultqty=mysqli_fetch_array($rsqty);

$tnadata="";
$tnadataaaaa="";
$tnadataq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$queryData['id'].'" and taskListId in (select id from taskListMaster where name in (select id from tnaActivityMaster where name="Ex-Factory Start Date")) order by id');
$tnadata=mysqli_fetch_array($tnadataq);

$tnadataaaaaq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$queryData['id'].'" and taskListId in (select id from taskListMaster where name in (select id from tnaActivityMaster where name="Ex-Factory End Date")) order by id');
$tnadataaaaa=mysqli_fetch_array($tnadataaaaaq);


$id=$queryData['id'];

// $materialType=decode($_GET['materialType']);

// $styleDataq=GetPageRecord('styleRefId,sampleStyle','queryMaster','1 and id="'.$id.'"');
// $styleData=mysqli_fetch_array($styleDataq);

// $matListDataq=GetPageRecord('name','materialTypeMaster','1 and id="'.$materialType.'"');
// $matListData=mysqli_fetch_array($matListDataq);

 $sr=1;
				 $gateEntryno='';
				 $rsListDatassq=GetPageRecord('*','grnMaster','1 and styleId="'.$id.'" and materialid in ( select id from styleSubCategoryMaster where materialType="3") group by color,materialId');
				 while($rsListDatass=mysqli_fetch_array($rsListDatassq)){


				$where2='styleId="'.$id.'" and materialType="3" and id="'.$rsListDatass['materialId'].'"';
				$rs2=GetPageRecord('*','styleSubCategoryMaster',$where2);
				while($matData=mysqli_fetch_array($rs2))
				{

				  $tsq=GetPageRecord('bomPlacement,storesupplier,supplierartname,bomAvg','techPackDetailMaster','1 and stylesubtabid='.$matData['id'].' order by id asc');
    	         $techShellData=mysqli_fetch_array($tsq);

    	         $rsd=GetPageRecord('*','grnMaster','1  and styleId="'.$queryData['styleId'].'"');
               $operationData3=mysqli_fetch_array($rsd);

               	$rsgrnrec=GetPageRecord('sum(netReceived) as netReceivedTill,color,parentId','grnMaster','styleId="'.$id.'" and materialId="'.$rsListDatass['materialId'].'" and color="'.$rsListDatass['color'].'"');
				$rsgrnrecTill=mysqli_fetch_array($rsgrnrec);

				$rsd=GetPageRecord('*','gateentrymaster','1  and registerno="Packaging"');
               $operationD=mysqli_fetch_array($rsd);

						?>

                                <tr>

                                <tr role="row" class="odd">
							    <td><?php echo getBrandName($queryData['brandId']); ?></td>
							    <td><?php echo $queryData['styleRefId'];?></td>





							<!--<td></td> -->

							 <td><?php echo $matData['name'];?></td>
							 <td><?php echo $resultqty['qtyTotal']; ?></td>
							 <td><?php echo round($rsgrnrecTill['netReceivedTill'],2); ?></td>



							 <td><?php echo getsupplierCompany($techShellData['storesupplier']); ?></td>
							 <td><?php
					$rsgrndata=GetPageRecord('*','grnMaster','styleId="'.$id.'" and materialId="'.$rsListDatass['materialId'].'" and color="'.$rsListDatass['color'].'"');
					while($rsgrndatalist=mysqli_fetch_array($rsgrndata)){
					$rsgrnno=GetPageRecord('gateEntryNo,grnNo, docDate','grnMaster','id="'.$rsgrndatalist['parentId'].'"');
					$rsgrnnolist=mysqli_fetch_array($rsgrnno);
					?>
                    <span style="font-weight:600; color:#00CC33;"><?php echo makeQueryId($rsgrnnolist['gateEntryNo']); ?></span>
                    <?php } ?>
                    </td>
					<td><?php echo date('d-m-Y',strtotime($operationD['entrydate'])); ?></td>
					<td><?php
					$rsgrndata=GetPageRecord('*','grnMaster','styleId="'.$id.'" and materialId="'.$rsListDatass['materialId'].'" and color="'.$rsListDatass['color'].'"');
					while($rsgrndatalist=mysqli_fetch_array($rsgrndata)){
					$rsgrnno=GetPageRecord('gateEntryNo,grnNo,docDate','grnMaster','id="'.$rsgrndatalist['parentId'].'"');
					$rsgrnnolist=mysqli_fetch_array($rsgrnno);
					?>
                    <span style="font-weight:600; color: #0033FF;"><?php echo $rsgrnnolist['grnNo']; ?></span>
                    <?php } ?>
                    </td>


							 <td><?php if($rsgrnnolist['docDate']!=''){ echo date('d-m-Y',strtotime($rsgrnnolist['docDate'])); }else{ echo '-'; } ?></td>

						     </tr>
                            <?php } } } ?>

                              </tbody>
                              </table>