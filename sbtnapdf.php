<?php
ob_start();
include "inc.php";
$assignto="download";

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

$select='*';
$id=clean(decode($_GET['styleid']));
$where='id='.$id.'';
$rs=GetPageRecord($select,_QUERY_MASTER_,$where);
$resultpage=mysqli_fetch_array($rs);

// header("Content-type: application/vnd.ms-excel;charset=UTF-8");
// header("Content-Disposition: attachment; filename=\"".$assignto."_".date('d-m-Y-H-i-s').".xls");
// header("Cache-control: private");

?>

                <?php

				$rrrr=GetPageRecord('*','subtnaMaster','1 and styleId="'.decode($_GET['styleid']).'"');
				$operationData=mysqli_fetch_array($rrrr);

				?>

	<table class="table table-bordered"  width="100%">
							<thead>
								<tr class="border-top-info" style="background-color: #fff7b3;text-align: left;">
									<th width="19%"><strong></strong></th>
									<?php
                    $tdr=GetPageRecord('*','styleColorDetailMaster','1 and styleId="'.$editresultstyle['id'].'"');
                                    while($temnamer=mysqli_fetch_array($tdr)){

                                    $tdra=GetPageRecord('*','colorCardMaster','1 and id="'.$temnamer['colorId'] .'"');
                                    $temnamera=mysqli_fetch_array($tdra);
                                    ?>
					           <th width="20%"><div align="center" style="color:black;"><?php echo $temnamera['name'] ?></div></th>
					          <?php } ?>

								</tr>
							</thead>
							<tbody>
			 <?php

                      $newdata = explode(',', $operationData['cadreceived']);
                      $newdata1 = explode(',', $operationData['standardreceived']);
                      $newdata2 = explode(',', $operationData['firstsubmitdate']);
                      $newdata3 = explode(',', $operationData['firstsubmitcomment']);
                      $newdata4 = explode(',', $operationData['secondsubmitdate']);
                      $newdata5 = explode(',', $operationData['secondsubmitcomment']);
                      $newdata6 = explode(',', $operationData['approvalcomment']);
                      $newdata7 = explode(',', $operationData['indentapproved']);
                      $newdata8 = explode(',', $operationData['fptapproved']);
                      $newdata9 = explode(',', $operationData['fobsubmit']);


                             ?>



								<tr class="border-top-info">
									<td>CAD Received Date</td>
									<?php
                    $tdr=GetPageRecord('*','styleColorDetailMaster','1 and styleId="'.$editresultstyle['id'].'"');
                                    $x= "0";
                                    while($temnamer=mysqli_fetch_array($tdr)){

                                    $tdra=GetPageRecord('*','colorCardMaster','1 and id="'.$temnamer['colorId'] .'"');
                                    $temnamera=mysqli_fetch_array($tdra);
                                    ?>

					                <td style="margin-left:90px;">
                                    <?php echo $newdata[$x]; ?>

					                 </td>
					<?php $x++; } ?>


								</tr>
								<tr class="border-top-info">
									<td>Standard Received Date</td>
									<?php
                    $tdr=GetPageRecord('*','styleColorDetailMaster','1 and styleId="'.$editresultstyle['id'].'"');
                                    while($temnamer=mysqli_fetch_array($tdr)){
                                    $x= "0";
                                    $tdra=GetPageRecord('*','colorCardMaster','1 and id="'.$temnamer['colorId'] .'"');
                                    $temnamera=mysqli_fetch_array($tdra);
                                    ?>
					                <td style="margin-left:90px;"><?php echo $newdata1[$x]; ?></td>
					<?php $x++; } ?>


								</tr>
								<tr class="border-top-info">
									<td>First Submit Date</td>
									<?php
                    $tdr=GetPageRecord('*','styleColorDetailMaster','1 and styleId="'.$editresultstyle['id'].'"');
                                    while($temnamer=mysqli_fetch_array($tdr)){
                                    $x= "0";
                                    $tdra=GetPageRecord('*','colorCardMaster','1 and id="'.$temnamer['colorId'] .'"');
                                    $temnamera=mysqli_fetch_array($tdra);
                                    ?>
					                <td style="margin-left:90px;"><?php echo $newdata2[$x]; ?></td>
					<?php $x++; } ?>


								</tr>
								<tr class="border-top-info">
									<td>First Submit Comments</td>
									<?php
                    $tdr=GetPageRecord('*','styleColorDetailMaster','1 and styleId="'.$editresultstyle['id'].'"');
                                    while($temnamer=mysqli_fetch_array($tdr)){
                                    $x= "0";
                                    $tdra=GetPageRecord('*','colorCardMaster','1 and id="'.$temnamer['colorId'] .'"');
                                    $temnamera=mysqli_fetch_array($tdra);
                                    ?>
					                <td style="margin-left:90px;">
					                	<?php echo $newdata3[$x]; ?>
					                	 </td>
					<?php $x++; } ?>


								</tr>
								<tr class="border-top-info">
									<td>Second Submit Date</td>
									<?php
                    $tdr=GetPageRecord('*','styleColorDetailMaster','1 and styleId="'.$editresultstyle['id'].'"');
                                    while($temnamer=mysqli_fetch_array($tdr)){
                                    $x= "0";
                                    $tdra=GetPageRecord('*','colorCardMaster','1 and id="'.$temnamer['colorId'] .'"');
                                    $temnamera=mysqli_fetch_array($tdra);
                                    ?>
				<td style="margin-left:90px;"><?php echo $newdata4[$x]; ?></td>
					<?php $x++; } ?>


								</tr>
								<tr class="border-top-info">
									<td>Second Submit Comments</td>
									<?php
                    $tdr=GetPageRecord('*','styleColorDetailMaster','1 and styleId="'.$editresultstyle['id'].'"');
                                    while($temnamer=mysqli_fetch_array($tdr)){
                                    $x= "0";
                                    $tdra=GetPageRecord('*','colorCardMaster','1 and id="'.$temnamer['colorId'] .'"');
                                    $temnamera=mysqli_fetch_array($tdra);
                                    ?>
			<td style="margin-left:90px;"><?php echo $newdata5[$x]; ?></td>
					<?php $x++; } ?>


								</tr>
								<tr class="border-top-info">
									<td>Approval Comments</td>
									<?php
                    $tdr=GetPageRecord('*','styleColorDetailMaster','1 and styleId="'.$editresultstyle['id'].'"');
                                    while($temnamer=mysqli_fetch_array($tdr)){
                                    $x= "0";
                                    $tdra=GetPageRecord('*','colorCardMaster','1 and id="'.$temnamer['colorId'] .'"');
                                    $temnamera=mysqli_fetch_array($tdra);
                                    ?>
		  <td style="margin-left:90px;"><?php echo $newdata6[$x]; ?></td>
					<?php $x++; } ?>


								</tr>
								<tr class="border-top-info">
									<td>Indent Approved</td>
									<?php
                    $tdr=GetPageRecord('*','styleColorDetailMaster','1 and styleId="'.$editresultstyle['id'].'"');
                                    while($temnamer=mysqli_fetch_array($tdr)){
                                    $x= "0";
                                    $tdra=GetPageRecord('*','colorCardMaster','1 and id="'.$temnamer['colorId'] .'"');
                                    $temnamera=mysqli_fetch_array($tdra);
                                    ?>
		<td style="margin-left:90px;"><?php echo $newdata7[$x]; ?></td>
					<?php $x++; } ?>


								</tr>
								<tr class="border-top-info">
									<td>FOB Submit</td>
									<?php
                    $tdr=GetPageRecord('*','styleColorDetailMaster','1 and styleId="'.$editresultstyle['id'].'"');
                                    while($temnamer=mysqli_fetch_array($tdr)){
                                    $x= "0";
                                    $tdra=GetPageRecord('*','colorCardMaster','1 and id="'.$temnamer['colorId'] .'"');
                                    $temnamera=mysqli_fetch_array($tdra);
                                    ?>
			<td style="margin-left:90px;"><?php echo $newdata8[$x]; ?></td>
					<?php $x++; } ?>


								</tr>
								<tr class="border-top-info">
									<td>FPT Approved Date</td>
									<?php
                    $tdr=GetPageRecord('*','styleColorDetailMaster','1 and styleId="'.$editresultstyle['id'].'"');
                                    while($temnamer=mysqli_fetch_array($tdr)){
                                    $x= "0";
                                    $tdra=GetPageRecord('*','colorCardMaster','1 and id="'.$temnamer['colorId'] .'"');
                                    $temnamera=mysqli_fetch_array($tdra);
                                    ?>
				<td style="margin-left:90px;"><?php echo $newdata9[$x]; ?></td>
					<?php $x++; } ?>


								</tr>

				</tbody>
						</table>



						 <table width="100%"  class="table erptab table-hover" style="overflow: hidden; width:100%;">



							<tr class="" style="background-color:#f9f9f9;width:100%;">
							<td><strong>Fabric</strong></td>
							<td><strong>Color </strong></td>
							<td><strong>Total Quantity</strong></td>


							<td>

							</td>


							</tr>
							<?php
							$count=1;
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

						?>
						 <tbody >
							<tr class="card-body" style="background-color: #f9f9f9;">



							  <td width="17%" align="left"><div style="cursor:pointer;color:#0288d1;font-weight:bold;"  id="togglepo<?php echo $count; ?>"><?php echo  $resListing1['name']; ?></div></td>

							<td>


							    <?php
								$rs11=GetPageRecord('*','colorCardMaster','id="'.$color.'"');
								$resListing11=mysqli_fetch_array($rs11);
									echo $colorarr = rtrim($resListing11['name'],',');

								?>

						   </td>
						   <td><?php  echo $orderQty; ?></td>


						<td></td>

							</tr>
							</tbody>

								<tbody id="thisbodyShow<?php echo $count; ?>" style="text-align: center;display:none;">
					<tr style="background-color:#a2a2a2; color:#FFFFFF;">
						<td colspan="">Planned Quantity</td>
						<td colspan="">Planned Date</td>
					<td colspan="" style="" >Actual Quantity</td>

						<td colspan="">Actual Date</td>

						<td></td>
					</tr>
										<?php


							$total=1;
								$rs2=GetPageRecord('*','subTnaFlowMaster','styleId="'.decode($_GET['styleid']).'" and colorId="'.$resListing11['id'] .'" and fabricId="'.$resListing1['id'].'"');
							        while($result2=mysqli_fetch_array($rs2)){



							?>

					<tr style="background-color: #fdffe0;">
						<td colspan=""><?php echo $result2['flowquantity']; ?></td>
						<td colspan=""><?php echo $result2['planneddate']; ?></td>
						<td><?php echo $result2['actualquantity']; ?></td>
						<td colspan=""><?php echo $result2['actualdate']; ?></td>


						<td><i class="fa fa-edit" onclick="opmodalpop('PO Breakup','modalpop.php?action=addflow&editid=<?php echo $result2['id']; ?>&styleId=<?php echo $editresultstyle['id']; ?>&fabricid=<?php echo $resListing1['id']; ?>&colorid=<?php echo $resListing11['id']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop" style="font-size: 16px; color: #FF0000; cursor:pointer;"></i></td>
					</tr>



			<?php  $total++; }
			if($total==1){
					?>
					<tr style="background-color: #fdffe0;">
						<td colspan="11" style="margin-right:20px;">No Record Found</td>
					</tr>
					<?php } ?>

				</tbody>

<?php $count++; } }  ?>

                        </table>