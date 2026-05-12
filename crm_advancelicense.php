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
					<table class="table table-bordered table-hover   no-footer" id="" role="grid" aria-describedby="">
						<thead>
							<tr role="row">
							<th class="sorting_desc" tabindex="0" aria-controls="" rowspan="1" colspan="1" aria-sort="descending">Style No</th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"></th>
							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Buyer&nbsp;Name</th>
							<!--<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0">From&nbsp;Department</th>	-->
							<!--<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0">To&nbsp;Department</th>	-->
							<!--<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" >Quantity</th>-->
							<!--<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Created&nbsp;By</th>-->
							<!--<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Actions</th>-->
							<!--<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"style="display:none;">Remark</th>-->
							</tr>
						</thead>
						<tbody>
						<?php
						$total='';
						$no=1;
						$select='*';
						$where='';
				$where='where '.$wheresearchassign.' subject!="" '.$stylerefCondition.' and sampleStyle=1 and deletestatus=0 order by id desc';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&stylerefid='.$_GET['stylerefid'].'&';

$rs=GetRecordList($select,_QUERY_MASTER_,$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){
						?>
							<tr role="row" class="odd">
								<td tabindex="0" class="sorting_1"><a href="showpage.crm?module=advancelicense&add=yes&styleid=<?php echo encode($resultlists['id']); ?>"><?php echo $resultlists['styleRefId']; ?></a></td>
								<td></td>
								<td><?php
									$rsstatus=GetPageRecord('*','queryMaster','id="'.$resultlists['styleId'].'"');
									$result=mysqli_fetch_array($rsstatus);

									$select1='*';
									$where1='id="'.$result['buyerId'].'"';
									$rs1=GetPageRecord($select1,_BUYER_MASTER_,$where1);
									$resultlist1=mysqli_fetch_array($rs1);
									echo $resultlist1['name'];
									?></td>

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

