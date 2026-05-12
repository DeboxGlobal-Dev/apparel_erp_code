<div class="page-content">

		<!-- Main sidebar -->
		<?php include "left.php"; ?>

<div class="content-wrapper">
	<div class="content pt-0" style="margin-top:20px;">
		<div class="row">
			<div class="col-xl-12">
				<div class="card-header header-elements-inline bg-info-700">
					<div class="col-xl-9"><h5 class="card-title"><?php echo $pageName; ?></h5></div>
					  <div class="col-xl-3" style="    padding-right: 0px;"><div class="btn-group justify-content-center" style="float:right;">
					      							 <a href="showpage.crm?module=<?php echo $_GET['module']; ?>"  class="btn bg-teal-400" aria-expanded="false" style="background-color: gray;"><i class="fa fa-arrow-left mr-2"></i>Back</a>


					 </div></div>
					</div>
					<div class="card">

					<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"> <div class="datatable-scroll">
					<table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
						<thead>
							<tr role="row">
							<!-- <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 50px;">SR#</th> -->
							<!-- <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" aria-sort="ascending">Image </th> -->
							<th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending">Material&nbsp;Id</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Material&nbsp;Name</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Material&nbsp;Type</th>
							<!-- <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Material&nbsp;Type</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Material&nbsp;Sub&nbsp;Type</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Finish</th>	 -->
							<!--<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">SAP&nbsp;Code </th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Short&nbsp;Description</th>-->
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">In&nbsp;Stock</th>
				 			<!--<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Created&nbsp;By</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Modify&nbsp;By</th>-->
							<!-- <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Status</th> -->
							</tr>
						</thead>
						<tbody>
						<?php
						$inspectedQty=0;
						$no=1;
						$select='*';
						$where='';
						$rs='';
						$wheresearch='';
						$limit='20000';
						$where='where  name!="" order by id asc';
						$page=$_GET['page'];
						$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
						$rs=GetRecordList($select,_MATERIAL_MASTER_,$where,$limit,$page,$targetpage);
						$totalentry=$rs[1];
						$paging=$rs[2];
						$sNo=1;
						while($resultlists=mysqli_fetch_array($rs[0])){
						$dateAdded=clean($resultlists['dateAdded']);
						$modifyDate=clean($resultlists['modifyDate']);


						$kk=GetPageRecord('*','materialDescriptionMaster','1 and materialTypeId="'.$resultlists['materialtype'].'" and materialid="'.$resultlists['id'].'"');
						$materialDescription=mysqli_fetch_array($kk);



						?>
							<tr role="row" class="odd">
							<!-- <td align="center"><?php echo $sNo; ?></td> -->
							 <!-- <td tabindex="0" class="sorting_1">
								<div style="width: 80px; height: 80px; overflow: hidden;">
								<?php if($resultlists['materialimage']!=''){ ?>
								<img style="width:100%; height:100%;" src="<?php echo $fullurl; ?>images/<?php echo $resultlists['materialimage']; ?>" />
								<?php }else { ?>
								<img style="width:100%; height:100%;" src="<?php echo $fullurl; ?>images/image-not-found.png" />
								<?php } ?>
								</div></td> -->
								<td tabindex="0" class="sorting_1">
								<a href="#"><?php echo $resultlists['materialUniqueId']; ?></a>								</td>
								<td tabindex="0" class="sorting_1">
								<a href="#"><?php echo stripslashes($resultlists['name']); ?></a>
								</td>
								<td><?php

								$select3='';
								$where3='';
								$rs3='';
								$select3='*';
								$where3='id="'.$resultlists['materialtype'].'"';
								$rs3=GetPageRecord($select3,'materialTypeMaster',$where3);
								$userss3=mysqli_fetch_array($rs3);

								echo $userss3['name']; ?></td>
								<!--<td><?php

								$select3='';
								$where3='';
								$rs3='';
								$select3='*';
								$where3='id="'.$resultlists['materialSubTypeId'].'"';
								$rs3=GetPageRecord($select3,'materialSubType',$where3);
								$userss3=mysqli_fetch_array($rs3);

								echo $userss3['name']; ?>								</td>
								<td><?php

								$select3='';
								$where3='';
								$rs3='';
								$select3='*';
								$where3='id="'.$resultlists['finishId'].'"';
								$rs3=GetPageRecord($select3,'finishMaster',$where3);
								$userss3=mysqli_fetch_array($rs3);

								echo $userss3['name']; ?>								</td>								 -->
								<!--<td><?php echo stripslashes($materialDescription['sapCode']); ?></td>
								<td><?php echo stripslashes($materialDescription['shortDescription']); ?></td>-->
									<!--<td>
								<?php $select2='';
								$where2='';
								$rs2='';
								$select2='firstName,lastName';
								$where2='id="'.$resultlists['addedBy'].'"';
								$rs2=GetPageRecord($select2,_USER_MASTER_,$where2);
								$userss=mysqli_fetch_array($rs2);
								echo $userss['firstName'].' '.$userss['lastName']; ?>
								 - <span style="font-size:12px; margin-top:2px; color:#999999;"><?php echo showdatetime($dateAdded,$loginusertimeFormat);?></span>								</td>
							<td>
								<?php $select2='';
								$where2='';
								$rs2='';
								$select2='firstName,lastName';
								$where2='id="'.$resultlists['modifyBy'].'"';
								$rs2=GetPageRecord($select2,_USER_MASTER_,$where2);
								$userss=mysqli_fetch_array($rs2);
								echo $userss['firstName'].' '.$userss['lastName']; ?>
								- <span style="font-size:12px; margin-top:2px; color:#999999;"><?php echo showdatetime($modifyDate,$loginusertimeFormat);?></span>								</td>-->
								<td>
								<?php
								$inspectedQty=0;
								if($resultlists['materialtype']=='1'){
									$where2s = 'materialMasterId="'.$resultlists['id'].'"';
									$lotWiseDataFabricq=GetPageRecord('sum(acceptedField) as totalacceptedField','lotWiseData',$where2s);
									$lotWiseDataFabric=mysqli_fetch_array($lotWiseDataFabricq);
									$inspectedQty=$lotWiseDataFabric['totalacceptedField'];

								}
								if($resultlists['materialtype']=='2'){
									$qualityreportmasterDataq=GetPageRecord('sum(accepted) as totalaccepted','qualityreportmaster','type="triminspectioninput" and materialMasterId="'.$resultlists['id'].'"');
									$qualityreportmasterData=mysqli_fetch_array($qualityreportmasterDataq);
									 $inspectedQty=$qualityreportmasterData['totalaccepted'];
								}
								if($resultlists['materialtype']=='3'){
									$packagingqualityreportmasterDataq=GetPageRecord('sum(accepted) as totalaccepted','packagingqualityreportmaster','type="packagingtriminspectioninput" and materialMasterId="'.$resultlists['id'].'"');
									$packagingqualityreportmasterData=mysqli_fetch_array($packagingqualityreportmasterDataq);
									$inspectedQty=$packagingqualityreportmasterData['totalaccepted'];
								}


								$rsListfromissueance = GetPageRecord('sum(issueqty) as totalissueqty', 'issuanceMaster', 'materialId in (select id from styleSubCategoryMaster where name="'.$resultlists['name'].'")');
   								$totalLessQty = mysqli_fetch_array($rsListfromissueance);

								?>
								<?php echo  round($inspectedQty,2)-$totalLessQty['totalissueqty']; ?></td>
								<!-- <td class="text-center"><?php if($resultlists['status']==1){ ?><span class="badge badge-success">Active</span><?php } ?><?php if($resultlists['status']==2){ ?><span class="badge badge-secondary">Inactive</span><?php } ?></td> -->
							</tr>

<?php $sNo++; } ?>
						</tbody>
					</table>
					</div>
					</div>


					</div>


				</div>
			</div>
		</div>
	</div>
</div>

</div>

<script>
$('#DataTables_Table_2').DataTable( {
"order": [[ 0, "desc" ]]
} );
</script>

