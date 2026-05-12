<div class="page-content">



		<!-- Main sidebar -->

		<?php include "left.php"; ?>



<div class="content-wrapper">

	<div class="content pt-0" style="margin-top:20px;">

		<div class="row">

			<div class="col-xl-12">

				<div class="card-header header-elements-inline bg-info-700">

					<div class="col-xl-9"><h5 class="card-title"><?php echo $pageName; ?></h5></div>

					  <div class="col-xl-3" style="    padding-right: 0px;">
					  	<div class="btn-group justify-content-center" style="float:right;">

					  <a href="showpage.crm?module=masters"  class="btn bg-teal-400" aria-expanded="false" style="background-color: gray;"><i class="fa fa-arrow-left mr-2"></i>Back</a>

					  <a href="#" onclick="opmodalpop(' Add Factorywise Brand','modalpop.php?action=<?php echo $_GET['module']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-teal-400" aria-expanded="false" style="background-color: #03d873b8;"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>





					 </div></div>

					</div>

					<div class="card">



					<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"> <div class="datatable-scroll">

					<table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">

						<thead>

							<tr role="row">
							  <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" aria-sort="ascending"><div align="center">SR</div></th>

							<th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending">Quarter</th>

							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Brand</th>

							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Factory</th>

							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Line</th>

							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Avg&nbsp;SAM</th>

							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Avg&nbsp;Eff.</th>

							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Shift&nbsp;Hours</th>

							<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Operators</th>
							</tr>
						</thead>

						<tbody>

						<?php
						$no=0;
						$select='*';
						$where='where quarter!="" order by id asc';
						$rs='';
						$wheresearch='';
						$limit='20000';
						$page=$_GET['page'];
						$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
						$rs=GetRecordList($select,'factoryBrandMaster',$where,$limit,$page,$targetpage);
						$totalentry=$rs[1];
						$paging=$rs[2];
						while($resultlists=mysqli_fetch_array($rs[0])){

						?>

							<tr role="row" class="odd">
							  <td tabindex="0" class="sorting_1"><div align="center"><?php echo ++$no; ?></div></td>

								<td tabindex="0" class="sorting_1"> <a href="#" onclick="opmodalpop(' Add Factorywise Brand','modalpop.php?action=<?php echo $_GET['module']; ?>&id=<?php echo encode($resultlists['id']); ?>','600px','auto');" data-toggle="modal" data-target="#modalpop"><?php echo $resultlists['quarter']; ?></a></td>

								<td><?php
								$rs2=GetPageRecord('*','brandMaster','1 and id="'.$resultlists['brandId'].'"');
                                    $resListing1=mysqli_fetch_array($rs2);

                                    	echo $resListing1['name'] ?></td>

								<td><?php
								$rs3=GetPageRecord('*','factoryMaster','1 and id="'.$resultlists['factoryId'].'"');
                                    $resListing3=mysqli_fetch_array($rs3);

                                    	echo $resListing3['name'] ?></td>

								<td><?php echo $resultlists['line'] ?></td>

								<td><?php echo $resultlists['avgSam'] ?></td>

								<td><?php echo $resultlists['avgEfficiency'] ?></td>

								<td><?php echo $resultlists['shiftHours'] ?></td>

								<td><?php echo $resultlists['operator'] ?></td>
							</tr>

<?php } ?>
						</tbody>
					</table>
					</div>

					</div>





					</div>





				</div>

			</div>

		</div>

	</div>

</div>



</div>

<script>
$('#DataTables_Table_2').DataTable( {
"order": [[ 0, "desc" ]]
} );
</script>




