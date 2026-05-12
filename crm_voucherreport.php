<div class="page-content">
<style>
.even{
background-color: #0097a71a;
}
</style>
  	<?php include "left.php"; ?>
		<div class="content-wrapper">
	 <?php include "savealert.php"; ?>

			<div class="content pt-0" style="margin-top:20px;">

				<div class="row">
				<div class="col-xl-12">

				<div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
						<div class="col-xl-9"><h5 class="card-title"><?php echo $pageName; ?></h5></div>
						 <div class="col-xl-3" style="    padding-right: 0px;"><div class="btn-group justify-content-center" style="float:right;">


						</div></div>
					</div>

				<div class="card">
					<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"> <div class="datatable-scroll">
					<table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
						<thead style="background-color: #f5f5f5;">
							<tr role="row">
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 50px;">SR#</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Voucher No. </th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Account Name </th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Amount </th>
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

$where='where '.$wheresearchassign.' styleStatus!=0 and subject!="" '.$stylestatus.' and poAttachment!="" order by id desc';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
$rs=GetRecordList($select,_QUERY_MASTER_,$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){


?>

							<tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="background-color: #ff704359;" <?php } ?>>
							<td align="center"><?php echo $resultlists['displayId']; ?></td>

								<td><a href="#"><div class="numberbubbol">CV-BAC-2020-02-07</div>
								  </a></td>

								<td>Aggregated Cash Credit Voucher of 2020-02-07</td>

								<td>0.00</td>

								<?php
							    $qtyTotal =0;
								$grossTotal = 0;
							  	$selectqty='*';
								$whereqty='styleId="'.$resultlists['id'].'"';
								$rsqty=GetPageRecord($selectqty,'buyerPurchaseOrderMaster',$whereqty);
								$resultqty=mysqli_fetch_array($rsqty);
								?>
							   <td>07-02-2020</td>
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