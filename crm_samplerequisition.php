<?php
 if($loginuserprofileId==1){

$wheresearchassign=' 1 and ';

} else {

$wheresearchassign=' ( assignTo in (select id from '._USER_MASTER_.' where  empId in (select id from employeeMaster where id ='.$_SESSION['empid'].')) or assignTo in (select id from '._USER_MASTER_.' where  empId in (select reportingTo from employeeMaster where id="'.$_SESSION['empid'].'"))) ';

$wheresearchassign=' '.$wheresearchassign.' and ';

}?>
<div class="page-content">
<style>
.even{
background-color: #0097a71a;
}
.iconlistset {
width: 34px;
background-color: #000099;
padding: 5px 5px;
overflow: hidden;
float: left;
border-radius: 50px;
height: 34px;
margin: 0px 3px;
cursor: pointer;
}
.iconlistset img {
width: 16px;
margin-top: 6px;
mage-rendering: auto;
image-rendering: crisp-edges;
image-rendering: pixelated;
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
 <?php if($addpermission==1){ ?> <a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes" class="btn bg-teal-400 addnotify" aria-expanded="false" style="    background-color: #03d873b8;"  ><i class="fa fa-plus" aria-hidden="true"></i> Create New</a> <?php } ?>

						</div></div>
					</div>

				<div class="card">
					<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"> <div class="datatable-scroll">
					<table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
						<thead style="background-color: #f5f5f5;">
							<tr role="row">
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Sample For</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Production Stage</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Sample Type</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Style</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="">Request Date</th>
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
$limit='25';

$where='where 1 and productionStage!=0 order by id desc';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
$rs=GetRecordList($select,'samplingRequisitionMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){
@extract($resultlists);

$rsList=GetPageRecord('name','productionStageMaster','id="'.$productionStage.'"');
$productionName=mysqli_fetch_array($rsList);

$rsList1=GetPageRecord('name','sampleTypeMaster','id="'.$sampleType.'"');
$smapleList=mysqli_fetch_array($rsList1);
?>
<tr role="row" class="odd">
	<td><a href="showpage.crm?module=<?php echo $_GET['module']; ?>&edit=yes&id=<?php echo encode($resultlists['id']); ?>"><?php if($sampleFor==1){ echo 'Self'; }else{ echo 'Buyer Inspiration'; }?></a></td>
	<td><?php echo $productionName['name']; ?></td>
	<td><?php echo $smapleList['name']; ?></td>
	<td><?php echo '#'.getStyleRefId($styleId); ?></td>
	<td><?php echo date('d-m-Y',strtotime($requestedDate)); ?></td>
	<td align="center" class=""><a href="showpage.crm?module=<?php echo $_GET['module']; ?>&edit=yes&id=<?php echo encode($resultlists['id']); ?>" class="btn btn-primary" style="padding:5px;"><i class="fa fa-pencil" aria-hidden="true" style=" color: #fffffff1; font-size: 16px; "></i></a></td>
</tr>
<?php  } ?>
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

 <script>
$('#DataTables_Table_2').DataTable( {
"order": [[ 0, "desc" ]]
} );
</script>

