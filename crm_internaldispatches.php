<div class="page-content">

		<!-- Main sidebar -->
		<?php include "left.php"; ?>

<div class="content-wrapper">
	<div class="content pt-0" style="margin-top:20px;">
		<div class="row">
			<div class="col-xl-12">
				<div class="card-header header-elements-inline bg-info-700">
					<div class="col-xl-9"><h5 class="card-title"><?php echo $pageName; ?></h5></div>
					<div class="col-xl-1" style="padding-right: 0px;"> </div>
					<a href="download-internaldispatches.php" class="btn bg-teal-400 addnotify" aria-expanded="false" style="    background-color: #03d873b8;"> Download Excel</a>
					</div>
					<div class="card">

					<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"> <div class="datatable-scroll">
					<table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
						<thead>
							<tr role="row">
							<th class="sorting_desc" tabindex="0" aria-controls="" rowspan="1" colspan="1" aria-sort="descending">Chaalan#</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Style</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Buyer&nbsp;Name</th>
														<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Brand&nbsp;Name</th>

							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0">From&nbsp;Department</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0">To&nbsp;Department</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" >Quantity</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Created&nbsp;By-Date</th>
						<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Price</th>


							</tr>
						</thead>
						<tbody>
						<?php
						$total='';
						$no=1;
						$select='*';
						$where='';
						$rs='';
						$wheresearch='';
						$limit='25';
						$where='where 1 and departmentId!=0 and fromDepartmentId!=0 order by id desc';
						$page=$_GET['page'];
						$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&';
						$rs=GetRecordList($select,'chaalanMaster',$where,$limit,$page,$targetpage);
						$totalentry=$rs[1];
						$paging=$rs[2];
						while($resultlists=mysqli_fetch_array($rs[0])){
						$dateAdded=clean($resultlists['dateAdded']);
						$modifyDate=clean($resultlists['modifyDate']);
						if($resultlists['styleId']!=''){
						?>
							<tr role="row" class="odd">
								<td tabindex="0" class="sorting_1"><?php echo $resultlists['chaalanNo']; ?></td>
								<td><?php echo '#'.getStyleRefId($resultlists['styleId']);?></td>
								<td><?php
									$rsstatus=GetPageRecord('*','queryMaster','id="'.$resultlists['styleId'].'"');
									$result=mysqli_fetch_array($rsstatus);

									$select1='*';
									$where1='id="'.$result['buyerId'].'"';
									$rs1=GetPageRecord($select1,_BUYER_MASTER_,$where1);
									$resultlist1=mysqli_fetch_array($rs1);
									echo $resultlist1['name'];
									?></td>
										<td><?php


									$select1='*';
									$where13='id="'.$result['brandId'].'"';
									$rs13=GetPageRecord($select1,'brandMaster',$where13);
									$resultlist13=mysqli_fetch_array($rs13);
									echo $resultlist13['name'];
									?></td>
								<td><?php echo getDepartmentName($resultlists['departmentId']);?></td>
								<td><?php echo getDepartmentName($resultlists['fromDepartmentId']);?></td>
								<td>
								 <?php
								  $total='';
								  $rsList=GetPageRecord('quantity','chaalanMaster','parentId="'.$resultlists['id'].'"');
								  while($rsListData=mysqli_fetch_array($rsList)){
								  $total = $total+$rsListData['quantity'];
								  }
								  echo $total;
								  ?>
								</td>
								<td>
								<?php $select2='';
								$where2='';
								$rs2='';
								$select2='firstName,lastName';
								$where2='id="'.$resultlists['addedBy'].'"';
								$rs2=GetPageRecord($select2,_USER_MASTER_,$where2);
								$userss=mysqli_fetch_array($rs2);
								echo $userss['firstName'].' '.$userss['lastName']; ?>
								 - <span style="font-size:12px; margin-top:2px; color:#999999;"><?php echo date('d-m-Y H:i',$dateAdded); ?></span>
								</td>
								<td></td>
							</tr>
<?php } } ?>
						</tbody>
					</table></div>
					</div>


				    	</div>


				</div>
			</div>
		</div>
	</div>
</div>

</div>

 <style>


     .datatable-header{
         display:none;
     }
 </style>