<div class="page-content">
<style>
.even {
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
<div class="col-xl-9">
<h5 class="card-title"><?php echo $pageName; ?></h5>
</div>
<div class="col-xl-1" style="padding-right: 0px;"> </div>
<a href="showpage.crm?module=<?php echo $_REQUEST['module']; ?>&add=yes" class="btn bg-teal-400 addnotify" aria-expanded="false" style="    background-color: #03d873b8;"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>
</div>
<div class="card">
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
<div class="datatable-scroll">
<table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
	<thead style="background-color: #f5f5f5;">
		<tr role="row">
			<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style&nbsp;Ref.&nbsp;Id</th>
			<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">PO&nbsp;Number</th>
			<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Invoice&nbsp;Number</th>
			<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Mode</th>
			<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Payment&nbsp;Terms</th>
			<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Quantity</th>
			<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Action</th>
			<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Download</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$no = 1;
		$select = '*';
		$where = '';
		$rs = '';
		$wheresearch = '';
		$limit = '20000';
		$where = 'where styleId!=0 and status != "0" ';
		$page = $_GET['page'];
		$targetpage = $fullurl . 'showpage.crm?module="' . $modfile['moduleName'] . '"&records=' . $limit . '&searchField=' . $searchField . '&assignto=' . $_GET['assignto'] . '&';
		$rs = GetRecordList($select, 'packinglistMaster', $where, $limit, $page, $targetpage);
		$totalentry = $rs[1];
		$paging = $rs[2];
		while ($resultlists = mysqli_fetch_array($rs[0])) {
			$rss = GetPageRecord('*', 'queryMaster', '1 and id="' . $resultlists['styleId'] . '"');
			$result = mysqli_fetch_array($rss);
			$rsss = GetPageRecord('*', 'poManageMaster', '1 and id="' . $resultlists['purchaseNo'] . '"');
			$results = mysqli_fetch_array($rsss);
			$rsssp = GetPageRecord('*', 'innvoiceMaster', '1 and packingId="' . $resultlists['id'] . '"');
			$resultss = mysqli_fetch_array($rsssp);
		?>
			<tr role="row" class="odd">
				<td tabindex="0" class="sorting_1">
					<a href="showpage.crm?module=packinglist&add=yes&styleid=<?php echo encode($resultlists['styleId']); ?>&id=<?php echo encode($resultlists['id']); ?>">
						<div class="numberbubbol">
							<?php
							echo '#' . $result['styleRefId'];
							?>
						</div>
					</a>
				</td>
				<td><?php
					echo $results['poNumber']
					?></td>
				<td><?php echo $resultlists['invoiceNo'] ?></td>
				<td><?php echo $resultlists['vessel'] ?></td>
				<td><?php echo $resultlists['paymentterm'] ?></td>
				<?php
				$rsssf = GetPageRecord('sum(totalqty) as qtys', 'loadpackinglistmaster', ' parentId="' . $resultlists['id'] . '"');
				$resultsf = mysqli_fetch_array($rsssf);
				$fr = $resultsf['qtys'];
				?>
				<td><?php echo $fr; ?> </td>
				<td>
					<?php
					if ($resultlists['status'] == '2') { ?>
						<div><span class="badge" style="background-color: #03c28d;color: white">Invoice Generated</span></div>
					<?php } else { ?>
						<a href="showpage.crm?module=invoice&add=yes&pid=<?php echo encode($resultlists['id']); ?>&id=<?php echo encode($resultss['id']); ?>&s=<?php echo encode($result['id']); ?>"><span class="badge" style="background-color: #00b5ea;color: white">Generate Invoice</span></a>
					<?php } ?>
				</td>
				<td>
					<div>
						<a href="download-packinglist.php?parentId=<?php echo encode($resultlists['id']); ?>" target="_blank" style="background: #0288d1; outline: none; color: #fff; padding: 5px; border-radius: 2px; cursor: pointer;
display: block; float:left;"><i class="fa fa-download" aria-hidden="true" style="font-size: 17px;"></i>&nbsp;&nbsp;Download Excel</a>
					</div>
				</td>
			</tr>
		<?php
		}
		?>
	</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
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
.liststyleimg {
float: left;
width: 70px;
margin-right: 15px;
padding: 5px;
border: 2px solid #e6e6e6;
}

.badge.dropdown-toggle:after {
display: none;
}
</style>
<script>
$('#DataTables_Table_2').DataTable({
"order": [
[0, "desc"]
]
});
</script>