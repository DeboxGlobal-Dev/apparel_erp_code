<div class="page-content">
<style>
.even{
background-color: #0097a71a;
}
</style>
	 	<?php include "left.php"; ?>
		<div class="content-wrapper">

			<div class="content pt-0" style="margin-top:20px;">

				<div class="row">
				<div class="col-xl-12">

				<div class="card-header header-elements-inline bg-info-700">
						<div class="col-xl-9"><h5 class="card-title"><?php echo $pageName; ?></h5></div>
						 <div class="col-xl-3" style="padding-right: 0px;"><div class="btn-group justify-content-center" style="float:right;">
  <a href="showpage.crm?module=<?php echo $_GET['module']; ?>"><button type="button" class="btn bg-grey-400 btn-labeled btn-labeled-right ml-auto"><b><i class="fa fa-arrow-left" aria-hidden="true" style="    font-size: 17px;"></i></b>Back</button></a>

						</div>

						</div>
					</div>

				<div class="card">
					<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"> <div class="datatable-scroll">
					<table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
						<thead style="background-color: #f5f5f5;">
							<tr role="row">
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style&nbsp;Ref.&nbsp;Id</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style&nbsp;Name</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Category</th>
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Date</th>
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Time</th>
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Limit</th>
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Description</th>
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

$where='where  1 order by id desc';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
$rs=GetRecordList($select,'bookWashingMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){


$rks=GetPageRecord('*','queryMaster','1 and id="'.$resultlists['styleid'].'"');
$queryData=mysqli_fetch_array($rks);

?>
							<tr role="row" class="odd">
								<td tabindex="0" class="sorting_1">
								<a href="showpage.crm?module=style&view=yes&id=<?php echo encode($queryData['id']); ?>"><?php echo '#'.$queryData['styleRefId']; ?></a> 								</td>
								<td><?php echo $queryData['subject']; ?></td>
								<td><?php echo getCategoryName($queryData['categoryId']).' - '.getSubCategoryName($queryData['subCategoryId']); ?></td>
							    <td><div style="width:100px;"><?php echo date('d-m-Y',strtotime($resultlists['addDate'])); ?></div></td>
							    <td><div style="width:140px;"><?php echo $resultlists['fromTime'].' - '.$resultlists['toTime']; ?></div></td>
							    <td><?php echo $resultlists['approveLimit']; ?></td>
							    <td><?php echo $resultlists['description']; ?></td>
							</tr>

<?php } ?>
						</tbody>
					</table>
					</div>
					</div>


					</div>


				</div></div>
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
 </style>


 <script>
$('#DataTables_Table_2').DataTable( {
"order": [[ 0, "desc" ]]
} );
</script>

