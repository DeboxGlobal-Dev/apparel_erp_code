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

	 	<div class="content pt-0 filterable" style="margin-top:20px;">

				<div class="row">
				<div class="col-xl-12">

				<div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
						<div class="col-xl-9"><h5 class="card-title" ><?php echo $pageName; ?></h5></div>
					 </div>

				<div class="card">


				<div id="DataTables_Table_2_filter" class="dataTables_filter">
				<div class="row">
				 <div class="col-md-12">

				<form action="" method="get">
				<label>
				<select name="buyerId" id="buyerId" style="margin-left: 0px; width: 200px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;">
				<option value="">Select Buyer</option>
				<?php
				$fc=GetPageRecord('*','buyerMaster','1 and status=1 and deleteStatus=0  order by name asc');
				while($userData=mysqli_fetch_array($fc)){ ?>
				<option value="<?php echo $userData['id']; ?>" <?php if($_GET['buyerId']==$userData['id']){ ?> selected="selected" <?php } ?>><?php echo $userData['name']; ?></option>
				<?php } ?>
                </select>
				</label>
				<label>
				<select name="CategoryId" id="CategoryId" style="margin-left: 10px; width: 200px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;">
				<option value="">Select Category</option>
				<?php
				$ck=GetPageRecord('*','categoryMaster','1 and status=1 and deleteStatus=0  order by name asc');
				while($categoryData=mysqli_fetch_array($ck)){ ?>
				<option value="<?php echo $categoryData['id']; ?>"><?php echo $categoryData['name']; ?></option>
				<?php } ?>
                </select>
				</label>


<style>
.multiselect-native-select .multiselect{
width: 300px !important;
}
</style>

				<label>&nbsp;&nbsp;<input name="" type="submit" id="" class="" value="search" style="text-transform: uppercase; background-color: #03c28d; color: #fff; width: 200px; cursor:pointer;"/></label>
				<input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
				</form>

			 </div>

				</div>

				</div>

					<form name="listform" id="listform" method="get">
					<input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
					<div id="pageload">

					 		<div id="" > <div class="datatable-scroll">
					<table class="table table-bordered table-hover no-footer" style="width:100%;">
						<thead style="background-color: #f5f5f5;">
  							<tr role="row">
							<th width="15%" rowspan="1" class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Buyer&nbsp;Id</th>
							<th width="24%" colspan="1" rowspan="1" class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Buyer</th>
							<th width="22%" colspan="1" rowspan="1" class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Category</th>
							<th width="12%" colspan="1" rowspan="1" class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Styles&nbsp;Received </th>
							<th width="13%" colspan="1" rowspan="1" class="sorting" tabindex="0" aria-controls="DataTables_Table_0"> Styles&nbsp;Confirmed </th>
							<th width="14%" rowspan="1" class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Order&nbsp;Quantity</th>
							 </tr>
						</thead>
						<tbody>
						<?php
$no=1;
$select='*';
$where='';
$rs='';
$wheresearch='';
$limit=clean($_GET['records']);

$page=$_GET['page'];

if($_GET['buyerId']!=''){
$buyerQuery='and id="'.$_GET['buyerId'].'"';
}

$where='where subject!="" and deletestatus=0 group by buyerId';

$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';

$rs=GetRecordListJs($select,'queryMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){


$fc=GetPageRecord('*','buyerMaster','1 and id="'.$resultlists['buyerId'].'"');
$buyerData=mysqli_fetch_array($fc);

$c='';
$categoryData='';
$c=GetPageRecord('*','categoryMaster','1 and status=1 and deletestatus=0 order by name asc');


$buyerPO=0;
while($categoryData=mysqli_fetch_array($c)){

//check style buyer po confirmed
$rkdm=GetPageRecord('*','queryMaster','1 and categoryId="'.$categoryData['id'].'" and buyerId="'.$buyerData['id'].'" and subject!="" and deletestatus=0 and poAttachment!=""');
$buyerPO=mysql_num_rows($rkdm);

$styleReceived=0;
$q=GetPageRecord('*','queryMaster','1 and categoryId="'.$categoryData['id'].'" and buyerId="'.$buyerData['id'].'" and subject!="" and deletestatus=0');
$styleReceived=mysql_num_rows($q);


if($styleReceived>0){
?>
							<tr role="row" class="odd">
							  <td align="left"><?php echo $buyerData['buyerId']; ?></td>
								<td align="left"><?php echo $buyerData['name']; ?></td>
							 	<td><?php echo $categoryData['name']; ?></td>
							    <td> <?php  echo $styleReceived; ?>  </td>
								<td><?php echo $buyerPO; ?></td>
								 <td>100</td>

							</tr>

<?php } } } ?>
						</tbody>
					</table>
						<div class="pagingdiv" style="width: 97%;margin: 20px auto;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody><tr>
<td><table border="0" cellpadding="0" cellspacing="0">
<tr>
<td style="padding-right:20px;"><?php echo $totalentry; ?> entries</td>
<td><select name="records" id="records" onChange="this.form.submit();" class="lightgrayfield" style="padding: 5px;border: 1px solid #ccc;">
<option value="25" <?php if($_GET['records']=='25'){ ?> selected="selected"<?php } ?>>25 Records Per Page</option>
<option value="50" <?php if($_GET['records']=='50'){ ?> selected="selected"<?php } ?>>50 Records Per Page</option>
<option value="100" <?php if($_GET['records']=='100'){ ?> selected="selected"<?php } ?>>100 Records Per Page</option>
<option value="200" <?php if($_GET['records']=='200'){ ?> selected="selected"<?php } ?>>200 Records Per Page</option>
<option value="300" <?php if($_GET['records']=='300'){ ?> selected="selected"<?php } ?>>300 Records Per Page</option>
</select></td>
</tr>
</table></td>
<td align="right"><div class="pagingnumbers"><?php echo $paging; ?></div></td>
</tr>
</tbody></table>
</div>
					</div>


					</div>


					</div>


			</form>


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
.pagingnumbers {
    border: 1px #EAEAEA solid;
    border-radius: 2px;
    overflow: hidden;
    float: right;
}
.pagingnumbers a {
    display: inline-block;
    padding: 8px 15px;
    min-width: 12px;
    text-align: center;
    color: #2c2c2c;
    text-decoration: none;
    border-right: #EAEAEA solid 1px;
    font-size: 12px;
    padding-top: 9px;
}
.pagingnumbers .disabled {
    display: inline-block;
    padding: 7px 8px;
    color: #CECECE;
}
.pagingnumbers .current {
    display: inline-block;
    padding: 8px 8px;
}
.pagingnumbers .current {
    background-color: #2ca1cc;
    color: #FFFFFF;
}
.dataTables_info,.dataTables_paginate,.dataTables_length {
	display:none !important;
 }

 </style>

<script>
$('#DataTables_Table_2').DataTable( {
"order": [[ 0, "desc" ]]
} );
</script>
