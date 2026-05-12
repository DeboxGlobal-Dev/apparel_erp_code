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


$select='*';
$id=clean(decode($_GET['styleid']));
$where='id='.$id.'';
$rs=GetPageRecord($select,_QUERY_MASTER_,$where);
$resultpage=mysqli_fetch_array($rs);
?>
<div class="page-content">

		<div class="content-wrapper">

			<div class="content pt-0" style="margin-top:20px;">
  	           <?php include "top-style.php"; ?>
			    <div class="col-xl-12" style="padding:0px;">
				 <div class="card">
							 <div class="card-body navbar-green"  style="padding:7px !important;" >
							<div class="media">
									 <div class="col-xl-12">
									<h6 class="media-title font-weight-semibold"  style="    margin-top: 8px;">Sub TNA</h6>
									</div>

							</div>
						</div>
							<div class="card-body listc">





<div class="mobile-task" style="width:100%; display:none; text-align:right;">
<a class="writ-btn" style="background: #ffffff; color: #000 !important; padding: 5px; margin-bottom: 10px; display: inline-block; border: 1px solid #e0e0e0; width: 90px; text-align: center; font-weight: 600;">TNA</a>
<a class="writ-btn" style="background: #f1f1f1; color: #000 !important; padding: 5px; margin-bottom: 10px; display: inline-block; border: 1px solid #e0e0e0; width: 90px; text-align: center; font-weight: 600;">Sub TNA</a>

</div>


							  <?php

				$rrrr=GetPageRecord('*','subtnaMaster','1 and styleId="'.decode($_GET['styleid']).'"');
				$operationData=mysqli_fetch_array($rrrr);

				?>
				<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
					<input name="action" type="hidden" id="action" value="subtna" />
					<input type="hidden" name="styleid" id="styleid" value="<?php echo $_GET['styleid']; ?>" />
					<input name="editId" type="hidden" id="editId" value="<?php echo encode($operationData['id']); ?>">

								<table class="table table-bordered" style="font-size: 12px;" width="100%">
							<thead>
								<tr class="border-top-info" style="background-color: #fff7b3;text-align: left;">
									<th width="19%"><strong></strong></th>
									<?php
                    $tdr=GetPageRecord('*','styleColorDetailMaster','1 and styleId="'.$editresultstyle['id'].'"');
                                    while($temnamer=mysqli_fetch_array($tdr)){

                                    $tdra=GetPageRecord('*','colorCardMaster','1 and id="'.$temnamer['colorId'] .'"');
                                    $temnamera=mysqli_fetch_array($tdra);
                                    ?>
					<th width="10%"><div align="center" style="color: <?php echo $temnamera['colorCode'] ?>"><?php echo $temnamera['name'] ?></div></th>
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
					                <td align="center"><div>
	<input style="padding:7px;" type="date" name="cadreceived[]" value="<?php echo $newdata[$x]; ?>">

					     </div></td>
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
					                <td align="center"><div><input style="padding:7px;" type="date" name="standardreceived[]" value="<?php echo $newdata1[$x]; ?>"></div></td>
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
					                <td align="center"><div><input style="padding:7px;" type="date" name="firstsubmitdate[]" value="<?php echo $newdata2[$x]; ?>"></div></td>
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
					                <td align="center">
					                	<div>
					                		<input style="padding:7px;" type="date" name="firstsubmitcomment[]" value="<?php echo $newdata3[$x]; ?>">
					                	</div></td>
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
				<td align="center"><div><input style="padding:7px;" type="date" name="secondsubmitdate[]" value="<?php echo $newdata4[$x]; ?>"></div></td>
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
			<td align="center"><div><input style="padding:7px;" type="date" name="secondsubmitcomment[]" value="<?php echo $newdata5[$x]; ?>"></div></td>
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
		  <td align="center"><div><input style="padding:7px;" type="date" name="approvalcomment[]" value="<?php echo $newdata6[$x]; ?>"></div></td>
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
		<td align="center"><div><input style="padding:7px;" type="date" name="indentapproved[]" value="<?php echo $newdata7[$x]; ?>"></div></td>
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
			<td align="center"><div><input style="padding:7px;" type="date" name="fobsubmit[]" value="<?php echo $newdata8[$x]; ?>"></div></td>
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
				<td align="center"><div><input style="padding:7px;" type="date" name="fptapproved[]" value="<?php echo $newdata9[$x]; ?>"></div></td>
					<?php $x++; } ?>


								</tr>

				</tbody>
						</table>
						  <br>





						  <!--<under process>-->

						  <!--<table class="table table-bordered" style="font-size: 12px;" width="100%">-->
						  <!--    <tbody>-->
						  <!--       			<tr class="border-top-info">-->
								<!--	<td style="width:283px">Fabric Flow</td>-->
								<?php
                $tdr=GetPageRecord('*','styleColorDetailMaster','1 and styleId="'.$editresultstyle['id'].'"');
                                while($temnamer=mysqli_fetch_array($tdr)){

                               $tdra=GetPageRecord('*','colorCardMaster','1 and id="'.$temnamer['colorId'] .'"');
                                    $temnamera=mysqli_fetch_array($tdra);
                                ?>
					                 <!--<td  style="width:200px"align=""><div style="color: <?php echo $temnamera['colorCode'] ?>;font-weight:bold;"><?php echo $temnamera['name']; ?><div style="height:14px;background:<?php echo $temnamera['colorCode'] ?>"></div></div></td> -->




<?php  } ?>
								<!--		<td>Planned Date&nbsp;&nbsp;&nbsp;&nbsp;<input style="padding:7px;" type="date" name="planned" value="<?php echo $operationData['planneddate']; ?>"></td>-->
								<!--		<td>Actual Date&nbsp;&nbsp;&nbsp;&nbsp;<input style="padding:7px;" type="date" name="actual" value="<?php echo $operationData['actualdate']; ?>"></td>-->

								<!-- </tr> -->

						  <!--    </tbody>-->
						  <!--</table>-->



						  <div class="card-header header-elements-inline bg-info-700">
					<div class="col-xl-9"><h5 class="card-title">Fabric Flow</h5></div>
					<div class="col-xl-3" style="    padding-right: 0px;"><div class="btn-group justify-content-center" style="float:right;">
					 </div></div>
					</div>





						    <table width="100%"  class="table erptab table-hover" style=" overflow: hidden; margin: 10px;width:100%;">



							<tr class="" style="background-color: #f9f9f9;width:100%;">
							  <td width="28%" align="left"><div align="center"><strong>Fabric </strong></div></td>
							<td width="25%" align="left"><div align="center"><strong>Color </strong></div></td>
							<td width="40%" align="left"><div align="center"><strong>Total Quantity</strong></div></td>
														<td width="40%" align="left"><div align="center"><strong>Action</strong></div></td>

							<td></td>


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

							<td width="15%" align="center"><div align="center">


							    <?php
								$rs11=GetPageRecord('*','colorCardMaster','id="'.$color.'"');
								$resListing11=mysqli_fetch_array($rs11);
									echo $colorarr = rtrim($resListing11['name'],',');

								?>

							</div></td>
							<td width="17%" align="center"><div align="center"><?php  echo $orderQty; ?></div></td>





<td width="15%" align="center"><div align="center"><i class="fa fa-search-plus mr-2"  style="cursor:pointer;" onclick="opmodalpop('Add Flow','modalpop.php?action=addflow&styleId=<?php echo $editresultstyle['id']; ?>&fabricid=<?php echo $resListing1['id']; ?>&colorid=<?php echo $resListing11['id']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop">Add&nbsp;Flow</i></div></td>

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
						<td colspan="11"><div align="center">No Record Found</div></td>
					</tr>
					<?php } ?>

				</tbody>
<script>
$("#togglepo<?php echo $count; ?>").click(function(){
    $("#thisbodyShow<?php echo $count; ?>").toggle();

});
</script>











							<?php $count++; } }  ?>

                        </table>
























						  						  <!--</under process>-->





						  <br>
            <button type="submit" class="btn btn-primary" style="float:right">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>
</form>
							</div>

				   </div>
				 </div>

				</div>
			</div>
			</div>

		</div>

	</div>

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

