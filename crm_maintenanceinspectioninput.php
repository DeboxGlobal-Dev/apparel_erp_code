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
								<!--<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 50px;">SR#</th>-->
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">GRN Number</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Supplier PO Number</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Material</th>
								<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Color </th>
							    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Status</th>
							    <!--<th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" style="display:none;">&nbsp;</th>-->
							</tr>
						</thead>
						<tbody>
		            <?php
$no=0;
$select='*';
$where='';
$rs='';
$wheresearch='';
// $limit='20000';
$limit=clean($_GET['records']);


if($_GET['stylerefid']!=''){
$stylerefCondition = 'and id="'.decode($_GET['stylerefid']).'"';
}
if($_REQUEST['module'] == 'cdn'){
$where='where cdntype=1 order by id desc';
}else{
  $where='';
}

$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&stylerefid='.$_GET['stylerefid'].'&';

$rs=GetRecordList($select,'maintenancegateentrymaster','where status="2"',$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

$rs1=GetPageRecord($select,'suppliersMaster','1  and id="'.$resultlists['supplier'].'"');
$resListing1=mysqli_fetch_array($rs1);

$rsgrn=GetPageRecord('*','maintenancegrnMaster','gateEntryNo="'.$resultlists['id'].'" and parentId=0');
$resListingGrn=mysqli_fetch_array($rsgrn);


$gateEntryNo = 'GE-'.date('dmy',strtotime($resultlists['entrydate'])).'-'.$resultlists['id'];
?>
			<tr role="row" class="odd" <?php if($resultlists['stylestatus']=='0'){ ?> style="background-color: #ff704359;" <?php } ?>>



   <td><a href="showpage.crm?module=maintenanceinspectioninput&add=yes&gateentryid=<?php echo encode($resultlists['id']); ?>"><?php echo  $gateEntryNo; ?></a></td>


                                        <td>
                                             <?php
                         	$rsLi=GetPageRecord('*','requisitionIndentMaster','id="'.$resultlists['ponumber'].'"');
				$queryLi=mysqli_fetch_array($rsLi);

				      $rssrt=GetPageRecord('*','loadmaintenance','1 and id="'.$queryLi['mainid'].'"');
		   $rrrrt=mysqli_fetch_array($rssrt);


				     $rssrtv=GetPageRecord('*','maintenancegi_Master','1 and id="'.$rrrrt['parentId'].'"');
		   $rrrrtv=mysqli_fetch_array($rssrtv);

                          if($rrrrtv['requisitiontype']==1) {
                                    echo 'GI-'. date('dmy',$rrrrtv['dateAdded']).'-'.$queryLi['id'];
                                }else{
                                    echo 'MN-'. date('dmy',$rrrrtv['dateAdded']).'-'.$queryLi['id'];
                                }
                         ?>

                                        </td>


                                        <td>
                                            <?php
                                            	$wherenew='id="'.$resultlists['ponumber'].'"';
	$rsnew=GetPageRecord('*','requisitionIndentMaster',$wherenew);
$rslistneww=mysqli_fetch_array($rsnew);

	$wherenewd='id="'.$rslistneww['mainid'].'"';
	$rsnewd=GetPageRecord('*','loadmaintenance',$wherenewd);
$rslistnewd=mysqli_fetch_array($rsnewd);

$wherenewde='id="'.$rslistnewd['item'].'"';
	$rsnewde=GetPageRecord('*','maintenancegeneral_Master',$wherenewde);
$rslistnewde=mysqli_fetch_array($rsnewde);

						echo $rslistnewde['material'];

                                            ?>
                                        </td>



                                        <td></td>

                                        <td></td>



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

