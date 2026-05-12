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
							<th class="sorting_desc" tabindex="0" aria-controls="" rowspan="1" colspan="1" aria-sort="descending">Bill#</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Supplier </th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Payment Due Date</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Payment Release Date</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Payment Amount</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" style="display:none;">Created&nbsp;By</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" style="display:none;">Actions</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"style="display:none;">Remark</th>
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
						$where='where 1 and parentId=0 and styleId!=0 and gateEntryNo!="" order by id desc';
						$page=$_GET['page'];
						$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&';
						$rs=GetRecordList($select,'billMovementMaster',$where,$limit,$page,$targetpage);
						$totalentry=$rs[1];
						$paging=$rs[2];
						while($resultlists=mysqli_fetch_array($rs[0])){

						$rs1=GetPageRecord('name','suppliersMaster','id="'.$resultlists['supplierId'].'"');
						$resListing1=mysqli_fetch_array($rs1);

						$billPaid=GetPageRecord('SUM(paymentAmount) AS totalAmount','billMovementMaster','parentId="'.$resultlists['id'].'"');
						$billPaidTotal=mysqli_fetch_array($billPaid);

						?>
							<tr role="row" class="odd">
								<td tabindex="0" class="sorting_1"><a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes&styleid=<?php echo encode($resultlists['styleId']); ?>&id=<?php echo encode($resultlists['id']); ?>"><?php echo makeQueryId($resultlists['id']); ?></a></td>
								<td><?php echo $resListing1['name']; ?></td>
								<td></td>
								<td><?php echo date('d-m-Y',strtotime($resultlists['eWayBillDate'])); ?></td>
								<td><?php echo $billPaidTotal['totalAmount']; ?></td>

								<td style="display:none;"></td>
								<td style="display:none;"></td>
								<td style="display:none;">	</td>
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

