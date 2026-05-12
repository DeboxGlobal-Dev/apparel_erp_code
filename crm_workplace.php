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
						 <div class="col-xl-3" style="    padding-right: 0px;"><div class="btn-group justify-content-center" style="float:right;">
						  <a href="showpage.crm?module=masters"  class="btn bg-teal-400" aria-expanded="false" style="background-color: gray;"><i class="fa fa-arrow-left mr-2"></i>Back</a>

                         <a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes" class="btn bg-teal-400" aria-expanded="false" style="    background-color: #03d873b8;"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>

						</div></div>
					</div>

				<div class="card">
					<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"> <div class="datatable-scroll">
					<table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
						<thead style="background-color: #f5f5f5;">
							<tr role="row">
								<th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending">Type</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Name</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Email</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Phone</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Address</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Country</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">State</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">City</th>
								<th class="text-center sorting_disabled" rowspan="1" colspan="1" style="width: 100px;" aria-label="Actions">Actions</th>
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

$where='where 1 order by id desc';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
$rs=GetRecordList($select,'workplaceMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){
?>
							<tr role="row" class="odd">

								<td tabindex="0" class="sorting_1">
								<div class=""> <?php if($resultlists['type']==1){ echo "Office"; } if($resultlists['type']==2){ echo "Factory"; }  ?> </div>
								</td>

								<td><a href="showpage.crm?module=workplace&edit=yes&id=<?php echo encode($resultlists['id']); ?>"><?php echo $resultlists['name']; ?></a></td>

								<td><?php echo $resultlists['email']; ?></td>
								<td><?php echo $resultlists['phone']; ?></td>
								<td><?php echo $resultlists['address']; ?></td>
								<td><?php
								$select1='*';
								$where1='id="'.$resultlists['countryId'].'"';
								$rs1=GetPageRecord($select1,_COUNTRY_MASTER_,$where1);
								$resultlist1=mysqli_fetch_array($rs1);
								echo $resultlist1['name'];
								?>
								</td>
								<td><?php
								$select1='*';
								$where1='id="'.$resultlists['stateId'].'"';
								$rs1=GetPageRecord($select1,_STATE_MASTER_,$where1);
								$resultlist1=mysqli_fetch_array($rs1);
								echo $resultlist1['name'];
								?>
								</td>
								<td><?php
								$select1='*';
								$where1='id="'.$resultlists['cityId'].'"';
								$rs1=GetPageRecord($select1,_CITY_MASTER_,$where1);
								$resultlist1=mysqli_fetch_array($rs1);
								echo $resultlist1['name'];
								?>
								</td>
								<td>
								<div class="btn-group">
								 <!-- <a href="showpage.crm?module=style&view=yes&id=<?php echo encode($resultlists['id']); ?>"> <button type="button" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true" style=" color: #fffffff1;   font-size: 16px;"></i></button></a>-->
								  <a href="showpage.crm?module=workplace&edit=yes&id=<?php echo encode($resultlists['id']); ?>"><button type="button" class="btn btn-warning" ><i class="fa fa-pencil" aria-hidden="true" style=" color: #fffffff1;   font-size: 16px;"></i></button></a>
								</div>
								</td>
							</tr>

<?php } ?>
						</tbody>
					</table></div>
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