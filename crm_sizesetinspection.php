
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
						<div class="col-xl-3" style="    padding-right: 0px;"><div class="btn-group justify-content-center" style="float:right;">
 <?php if($addpermission==1){ ?>
                <a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes" class="btn bg-teal-400 addnotify" aria-expanded="false" style="    background-color: #03d873b8;"  ><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>
                <?php } ?>

						</div></div>
					</div>

				<div class="card">
					<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"> <div class="datatable-scroll">
					<table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
						<thead style="background-color: #f5f5f5;">
							<tr role="row">
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Inspection No.</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style</th>
								<!--<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Brand</th>-->
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Color</th>
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Date</th>

								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Status</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Done By</th>
							</tr>
						</thead>
						<tbody>

					    <?php
						$where='1';
                        $rs=GetPageRecord($select,'setSizeInspection_acesrs','1 ORDER BY id DESC');
                        while($operationData=mysqli_fetch_array($rs)){
                           $sty =$operationData['styleId'];
						?>

						 <tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="background-color: #ff704359;" <?php } ?>>

							<!--<td><a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes&styleid=<?php echo encode($resultlists['id']); ?>">-->
							<!--<?php echo '#'.$resultlists['styleRefId']; ?>-->

							 <!--</a></td>-->

						<td><a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes&opertaiono=<?php echo encode($operationData['inspection_no']); ?>"><?php echo $operationData['inspection_no']; ?></a></td>
						<td><?php echo substr($sty, 2,100);  ?></td>
						<td><?php echo $operationData['color']; ?></td>

					    <td><?php echo $operationData['dat']; ?></td>



								<!--<td><?php //echo $resultlists['subject']; ?></td>-->

								<td><?php echo getCategoryName($resultlists['categoryId']).' - '.getSubCategoryName($resultlists['subCategoryId']); ?></td>



							<td><?php echo $operationData['done_by']; ?></td>
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

