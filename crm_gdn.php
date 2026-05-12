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
 <?php if($addpermission==1){ ?> <a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes" class="btn bg-teal-400 addnotify" aria-expanded="false" style="    background-color: #03d873b8;"  ><i class="fa fa-plus" aria-hidden="true"></i> Create New</a> <?php } ?>
					</div></div>
					</div>
					<div class="card">


					<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"> <div class="datatable-scroll">
					<table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
						<thead>
							<tr role="row">
							<th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending">No#</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Factory&nbsp;Name</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Buyer&nbsp;Name</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Party&nbsp;Name</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Total&nbsp;Required</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Today&nbsp;Received</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Balance&nbsp;To&nbsp;Receive</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Rate</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Total&nbsp;Value</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Action</th>
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
						$where='where 1 and parentId=0 and factoryId!=0 and supplierId!=0 and status=1 order by id desc';
						$page=$_GET['page'];
						$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&';
						$rs=GetRecordList($select,'gdnMaster',$where,$limit,$page,$targetpage);
						$totalentry=$rs[1];
						$paging=$rs[2];
						while($resultlists=mysqli_fetch_array($rs[0])){
						$dateAdded=clean($resultlists['dateAdded']);
						$modifyDate=clean($resultlists['modifyDate']);
						?>
							<tr role="row" class="odd">
								<td tabindex="0" class="sorting_1"><a href="showpage.crm?module=grn&add=yes&id=<?php echo encode($resultlists['id']); ?>"><?php echo $resultlists['gdnNo']; ?></a></td>
								<td><?php
								  $rsList=GetPageRecord('name','factoryMaster','id="'.$resultlists['factoryId'].'"');
								 $rsListData=mysqli_fetch_array($rsList);
								 echo  $rsListData['name'];
								  ?></td>
								<td><?php
									$rsstatus=GetPageRecord('*','queryMaster','id="'.$resultlists['styleId'].'"');
									$result=mysqli_fetch_array($rsstatus);
									$rs1=GetPageRecord('*',_BUYER_MASTER_,'id="'.$result['buyerId'].'"');
									$resultlist1=mysqli_fetch_array($rs1);
									echo $resultlist1['name'];
									?></td>
								<td><?php
								  $rsList=GetPageRecord('name','suppliersMaster','id="'.$resultlists['supplierId'].'"');
								 $rsListData=mysqli_fetch_array($rsList);
								 echo  $rsListData['name'];
								  ?></td>
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
								<!--<?php $select2='';
								$where2='';
								$rs2='';
								$select2='firstName,lastName';
								$where2='id="'.$resultlists['addedBy'].'"';
								$rs2=GetPageRecord($select2,_USER_MASTER_,$where2);
								$userss=mysqli_fetch_array($rs2);
								echo $userss['firstName'].' '.$userss['lastName']; ?>
								 - <span style="font-size:12px; margin-top:2px; color:#999999;"><?php echo date('d-m-Y H:i',$dateAdded); ?></span>-->
								</td>
								<td></td>
								<td style=""></td>
								<td style=""></td>
							</tr>
<?php } ?>
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

