<div class="page-content">
<style>
.even{
background-color: #0097a71a;
}
</style>
		<!-- Main sidebar -->
		<?php include "left.php"; ?>
		<div class="content-wrapper">

			<div class="content pt-0" style="margin-top:20px;">

				<div class="row">
				<div class="col-xl-12">

				<div class="card-header header-elements-inline bg-info-700">
						<div class="col-xl-9"><h5 class="card-title"><?php echo $pageName; ?></h5></div>
						<div class="col-xl-1" style="padding-right: 0px;"> </div>
            <a href="showpage.crm?module=<?php echo $_REQUEST['module']; ?>&add=yes" class="btn bg-teal-400 addnotify" aria-expanded="false" style="    background-color: #03d873b8;"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>
					</div>

				<div class="card">
					<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"> <div class="datatable-scroll">
					<table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
						<thead style="background-color: #f5f5f5;">
							<tr role="row">
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Debit&nbsp;Note&nbsp;Number</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style&nbsp;Ref&nbsp;Id</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Order&nbsp;Number</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Date</th>

							</tr>
						</thead>
						<tbody>
						<?php
$no=1;
$select='*';
$where='';
$rs='';
$wheresearch='';
$limit='20000';

$where='where status="1"';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
$rs=GetRecordList($select,'debitNoteMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

	$rss=GetPageRecord('*','queryMaster','1 and id="'.$resultlists['styleId'].'"');
           $result=mysqli_fetch_array($rss);


?>
							<tr role="row" class="odd">
								<td tabindex="0" class="sorting_1">
		<a href="showpage.crm?module=supdebitnote&add=yes&styleid=<?php echo encode($resultlists['styleId']); ?>&id=<?php echo encode($resultlists['id']); ?>"><div class="numberbubbol"><?php echo 'DBT/'.date('y',$resultlists['dateAdded']).'/'.date('m',$resultlists['dateAdded']).'/'.makeQueryId($resultlists['id']) ?></div></a></td>


								<td>#<?php echo $result['styleRefId'] ?></td>
								<td><?php echo $resultlists['orderno'] ?></td>
								<td><?php echo date('d-m-Y',$resultlists['dateAdded']) ?></td>



							</tr>

<?php
}
?>
						</tbody>
					</table>
					</div>
					</div>


					</div>


				</div></div>




				</div>
				<!-- /dashboard content -->

			</div>
			<!-- /content area -->


			<!-- Footer -->

			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>

 <style>
 .liststyleimg{float: left;
    width: 70px;
    margin-right: 15px;
    padding: 5px;
    border: 2px solid #e6e6e6;}

	.badge.dropdown-toggle:after { display:none;
}
 </style>


 <script>
$('#DataTables_Table_2').DataTable( {
"order": [[ 0, "desc" ]]
} );
</script>

