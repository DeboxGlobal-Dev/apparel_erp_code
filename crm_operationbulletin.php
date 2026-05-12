<?php
 if($loginuserprofileId==1){

$wheresearchassign=' 1 and ';

} else {

//$wheresearchassign=' ( assignTo in (select id from '._USER_MASTER_.' where  empId in (select id from employeeMaster where id ='.$_SESSION['empid'].')) or assignTo in (select id from '._USER_MASTER_.' where  empId in (select reportingTo from employeeMaster where id="'.$_SESSION['empid'].'"))) ';

//$wheresearchassign=' '.$wheresearchassign.' and ';
$wheresearchassign=' 1 and ';
}

?>

     <div class="page-content">
     <style>
.even{
background-color: #0097a71a;
}


 </style>

		<!-- Main sidebar -->

		 <?php include "left.php"; ?>
		<div class="content-wrapper">

		<!---Save Alert Notification---->

		<?php include "savealert.php"; ?>



			 <div class="content pt-0" style="margin-top:20px;">

				<div class="row">
				<div class="col-xl-12">


				        <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
						<div class="col-xl-9"><h5 class="card-title"><?php echo $pageName; ?></h5></div>
					    <div class="col-xl-3" style="padding-right: 0px;"><div class="btn-group justify-content-center" style="float:right;">


						</div>
						</div>

					    <!--<a href="download-operationbulletin.php" class="btn bg-teal-400 addnotify" aria-expanded="false" style="background-color: #03d873b8;">Download Excel</a>-->
						</div>


				 <div class="card">
					<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"> <div class="datatable-scroll">
					<table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
						<thead style="background-color: #f5f5f5;">
							<tr role="row">
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style&nbsp;Ref.&nbsp;Id</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style&nbsp;Name</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Category</th>
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Order&nbsp;Quantity</th>
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Buyer</th>
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Action</th>
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

if($_GET['stylestatus']!=''){
$stylestatus = 'and finalstatus="'.$_GET['stylestatus'].'"';
}

$where='where '.$wheresearchassign.' styleStatus!=0 and sampleStyle=1 and subject!="" '.$stylestatus.' and poAttachment!="" order by id desc';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
$rs=GetRecordList($select,_QUERY_MASTER_,$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

$selectimg='*';
$whereimg='parentId="'.$resultlists['id'].'" and galleryType="image_gallery" order by id asc';
$rsimg=GetPageRecord($selectimg,'imageGallery',$whereimg);
$imgresult=mysqli_fetch_array($rsimg);


$selectdays='*';
$wheredays='styleId="'.$resultlists['id'].'" and statusId in (19,20) order by id desc';
$rsdays=GetPageRecord($selectdays,'styleAssignmentMaster',$wheredays);
$resultdays=mysqli_fetch_array($rsdays);


?>

							<tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="background-color: #ff704359;" <?php } ?>>
							<td><a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes&styleid=<?php echo encode($resultlists['id']); ?>"><?php echo '#'.$resultlists['styleRefId']; ?>

							  </a></td>

								  <td><?php echo $resultlists['subject']; ?></td>

								 <td><?php echo getCategoryName($resultlists['categoryId']).' - '.getSubCategoryName($resultlists['subCategoryId']); ?></td>

								<td>-</td>
							    <td>-</td>

							     <td>

							          <div style="width:200px;">

						<a href="download-operationbullet.php?styleid=<?php echo encode($resultlists['id']); ?>" target="_blank" style="background: #0288d1; outline: none; color: #fff; padding: 5px; border-radius: 2px; cursor: pointer; width: 95px; display: block; float:left;  text-align:center;"><i class="fa fa-download" aria-hidden="true"></i> Excel</a>
						<a href="tcpdf/examples/generateopbullt.php?pageurl=<?php echo $fullurl; ?>operbulletpdf.php?styleid=<?php echo encode($resultlists['id']); ?>" target="_blank" style="background: #e71c22; outline: none; color: #fff; padding: 5px; border-radius: 2px; cursor: pointer; width: 95px; display: block; float:right; margin-left:5px; text-align:center;"><i class="fa fa-download" aria-hidden="true"></i> PDF</a>
						</div>


						</td>


							</tr>

                         <?php } ?>

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

