<?php
if ( $loginuserprofileId == 1 ) {

$wheresearchassign = ' 1 and ';

} else {

$wheresearchassign = ' ( assignTo in (select id from '._USER_MASTER_.' where  empId in (select id from employeeMaster where id ='.$_SESSION[ 'empid' ].')) or assignTo in (select id from '._USER_MASTER_.' where  empId in (select reportingTo from employeeMaster where id="'.$_SESSION[ 'empid' ].'"))) ';

$wheresearchassign = ' '.$wheresearchassign.' and ';

}
?>
<div class='page-content'>
<style>
.even {
background-color: #0097a71a;
}
</style>

<!-- Main sidebar -->
<?php include 'left.php';
?>
<div class='content-wrapper'>

<!---Save Alert Notification---->
<?php include 'savealert.php';
?>

<div class='content pt-0' style='margin-top:20px;'>

<div class='row'>
<div class='col-xl-12'>

<div class='card-header header-elements-inline bg-blue-700' style='padding: 10px;'>
<div class='col-xl-9'>
<h5 class='card-title'><?php echo $pageName;
?></h5>
</div>
<div class='col-xl-3' style='    padding-right: 0px;'>
<div class='btn-group justify-content-center' style='float:right;'>

</div>
</div>
</div>

<div class='card'>
<div id='DataTables_Table_0_wrapper' class='dataTables_wrapper no-footer'>
<div class='datatable-scroll'>
	<table class='table table-bordered table-hover datatable-highlight dataTable no-footer'
		id='DataTables_Table_2' role='grid' aria-describedby='DataTables_Table_2_info'>
		<thead style='background-color: #f5f5f5;'>
			<tr role='row'>
				<th class='sorting' tabindex='0' aria-controls='DataTables_Table_0'
					rowspan='1' colspan='1'>Style&nbsp;
					Ref.&nbsp;
					Id</th>
				<th class='sorting' tabindex='0' aria-controls='DataTables_Table_0'
					rowspan='1' colspan='1'>GRN No.</th>
				<th class='sorting' tabindex='0' aria-controls='DataTables_Table_0'
					rowspan='1' colspan='1'>Purchase Order No.</th>
				<th class='sorting' tabindex='0' aria-controls='DataTables_Table_0'
					rowspan='1' colspan='1'>GRN Date</th>
				<th class='sorting' tabindex='0' aria-controls='DataTables_Table_0'
					rowspan='1' colspan='1'>Bill Date</th>
				<th class='sorting' tabindex='0' aria-controls='DataTables_Table_0'
					rowspan='1' colspan='1'>Bill Amount</th>
				<th class='sorting' tabindex='0' aria-controls='DataTables_Table_0'
					rowspan='1' colspan='1'>Paid Amount</th>
				<th class='sorting' tabindex='0' aria-controls='DataTables_Table_0'
					rowspan='1' colspan='1'>Variation Cost </th>
				<th class='sorting' tabindex='0' aria-controls='DataTables_Table_0'
					rowspan='1' colspan='1'>Time Lag ( Standard vs Actual )</th>
				<!-- <th>Action</th> -->
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

if ( $_GET[ 'stylestatus' ] != '' ) {
$stylestatus = 'and finalstatus="'.$_GET[ 'stylestatus' ].'"';
}

$where = 'where  grnNo!="" order by id desc';
$page = $_GET[ 'page' ];

$targetpage = $fullurl.'showpage.crm?module="'.$modfile[ 'moduleName' ].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET[ 'assignto' ].'&';
$rs = GetRecordList( $select, 'grnMaster', $where, $limit, $page, $targetpage );
$totalentry = $rs[ 1 ];
$paging = $rs[ 2 ];
while( $resultlists = mysqli_fetch_array( $rs[ 0 ] ) ) {

$where21 = 'parentId="'.$resultlists[ 'id' ].'"';
$rsimg21 = GetPageRecord( 'styleId,SUM(value) AS totalAmt', 'grnMaster', $where21 );
$imgresult21 = mysqli_fetch_array( $rsimg21 );

// $selectimg = '*';
// $whereimg = 'parentId="'.$resultlists[ 'id' ].'" and galleryType="image_gallery" order by id asc';
// $rsimg = GetPageRecord( $selectimg, 'imageGallery', $whereimg );
// $imgresult = mysqli_fetch_array( $rsimg );

// $selectdays = '*';
// $wheredays = 'styleId="'.$resultlists[ 'id' ].'" and statusId=2';
// $rsdays = GetPageRecord( $selectdays, 'styleAssignmentMaster', $wheredays );
// $resultdays = mysqli_fetch_array( $rsdays );

// $qtyTotal = 0;
// $grossTotal = 0;
// $selectqty = '*';
// $whereqty = 'styleId="'.$resultlists[ 'id' ].'"';
// $rsqty = GetPageRecord( $selectqty, 'buyerPurchaseOrderMaster', $whereqty );
// $resultqty = mysqli_fetch_array( $rsqty );
$timelag = GetPageRecord( 'eWayBillDate,SUM(paymentAmount) AS totalPaid', 'billMovementMaster', 'supplierPurchaseOrderId="'.$resultlists[ 'supplierPurchaseOrderId' ].'" and grnNo="'.$resultlists[ 'grnNo' ].'"' );
$timelagdate = mysqli_fetch_array( $timelag );
$ewaybilldate = '';
if ( $timelagdate[ 'eWayBillDate' ] != '' ) {
$ewaybilldate = date( 'Y-m-d', strtotime( $timelagdate[ 'eWayBillDate' ] ) );
}
if ( $ewaybilldate != '' ) {

?>

			<tr role='row' class='odd'>

				<td><a
						href="showpage.crm?module=billcomparison&add=yes&styleid=<?php echo encode($imgresult21['styleId']); ?>"><?php echo '#'.getStyleRefId( $imgresult21[ 'styleId' ] );
?></a></td>
				<td><?php echo $resultlists[ 'grnNo' ];
?></td>

				<td><?php echo $resultlists[ 'supplierPurchaseOrderId' ];
?></td>
				<td><?php

echo date( 'Y-m-d', strtotime( $resultlists[ 'docDate' ] ) );
?></td>
				<td>
					<?php

echo $ewaybilldate;
?></td>
				<td><?php echo $imgresult21['totalAmt']; ?></td>
				<td><?php if ( $timelagdate[ 'eWayBillDate' ] != '' ) { echo $timelagdate['totalPaid']; } ?></td>
				<td><?php if ( $timelagdate[ 'eWayBillDate' ] != '' ) { echo $imgresult21['totalAmt']-$timelagdate['totalPaid']; } ?></td>
				<td>
					<?php

$d1 = new DateTime( date( 'Y-m-d', strtotime( $resultlists[ 'docDate' ] ) ) );
$d2 = new DateTime( $ewaybilldate );
$days = $d2->diff( $d1 );

echo ( $ewaybilldate != '' ) ? "$days->d".' Days' : '-';

?>

				</td>

				<!-- <td>

<a href = "download-wip.php?styleid=<?php echo encode($resultlists['id']); ?>" target = '_blank' style = 'background: #0288d1; outline: none; color: #fff; padding: 5px; border-radius: 2px; cursor: pointer; width: 95px; display: block; float:left;  text-align:center;'><i class = 'fa fa-download' aria-hidden = 'true'></i> Excel</a>

</td>	 -->

			</tr>

			<?php }
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
'order': [
[0, 'desc']
]
});
</script>