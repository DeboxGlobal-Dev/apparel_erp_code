 <div class="page-content">
<style>
.even{
background-color: #0097a71a;
}

</style>
<style>
.select2-selection--single:not([class*=bg-]):not([class*=border-]) {
    border-color: #ddd;
    width: 190px !important;
    margin-left: 10px;
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
				 <label style="display: none">
				<select name="" id="supplierId" style="margin-left: 10px; width: 200px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;">
				<option value="">Select Supplier</option>
				<?php
				$kk=GetPageRecord('*','suppliersMaster','1 order by name asc');
				while($supplierData=mysqli_fetch_array($kk)){ ?>
				<option value="<?php echo $supplierData['id']; ?>" <?php if($supplierData['id'] == $_GET['supplierId']){ echo "selected"; } ?>><?php echo $supplierData['name']; ?></option>
				<?php } ?>
                </select>
				</label>

				<label>
				<select name="styleId" id="styleId" style="" class="form-control">
				<option value="">Select Style</option>
				<?php
				$qq=GetPageRecord('*','queryMaster','1 and subject!="" and sampleStyle=1 and deletestatus=0 order by id desc');
				while($queryData=mysqli_fetch_array($qq)){ ?>
				<option value="<?php echo $queryData['id']; ?>" <?php if($queryData['id'] == $_GET['styleId']){ echo "selected"; } ?>><?php echo $queryData['subject']; ?></option>
				<?php } ?>
                </select>
				</label>

				<label>
				<select name="materialId" id="materialId" style="" class="form-control">
				<option value="">Select Fabric</option>
				<?php
				$grnDataq=GetPageRecord('*','grnMaster','1 and materialid in ( select id from styleSubCategoryMaster where materialType=1) group by color,materialId');

				while($grnData=mysqli_fetch_array($grnDataq)){

				$rs2=GetPageRecord('*','styleSubCategoryMaster','1 and id="'.$grnData['materialId'].'"');
				$matData=mysqli_fetch_array($rs2);
					?>
				<option value="<?php echo $matData['id']; ?>" <?php if($matData['id'] == $_GET['materialId']){ echo "selected"; } ?>><?php echo $matData['name']; ?></option>
				<?php } ?>
                </select>
				</label>



<script>
$(document).ready(function() {
//$("#styleId").select2();
});
</script>


<style>

.select2-selection--single:not([class*=bg-]):not([class*=border-]) {
    border-color: #ddd;
    width: 300px !important;
    margin-left: 10px;
}

</style>




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

					 		<div id="" > <div class="datatable-scroll" style="overflow:auto !important;">
					<table class="table table-bordered table-hover no-footer" style="width:100%;">
						<thead style="background-color: #f5f5f5;">
  							<tr role="row">
							<th width="5%" rowspan="1" class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Brand</th>
							<th width="8%" colspan="1" rowspan="1" class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Buyer</th>
							<th width="10%" colspan="1" rowspan="1" class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Style</th>
							<th width="8%" rowspan="1" class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Style&nbsp;Description</th>
							<th width="8%" rowspan="1" class="sorting" tabindex="0" aria-controls="DataTables_Table_0">PCD</th>
							<th width="9%" colspan="1" rowspan="1" class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Supplier</th>
							<th width="5%" colspan="1" rowspan="1" class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Fabric</th>
							<th width="5%" rowspan="1" class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Color</th>
							 <th width="8%" rowspan="1" class="sorting" tabindex="0" aria-controls="DataTables_Table_0">UOM</th>
							 <th width="8%" rowspan="1" class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Total&nbsp;Req.</th>
  							 <th width="9%" rowspan="1" class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Total&nbsp;&nbsp;Rec.</th>
  							 <th width="10%" rowspan="1" class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Bal.&nbsp;to&nbsp;Rec.</th>
  							 <th width="4%" rowspan="1" class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Rate</th>
  							 <th width="7%" rowspan="1" class="sorting" tabindex="0" aria-controls="DataTables_Table_0">Total&nbsp;Value</th>
  							</tr>
						</thead>

						<?php
$no=1;
$select='*';
$where='';
$rs='';
$wheresearch='';
$limit=clean($_GET['records']);

$page=$_GET['page'];

if($_GET['styleId']!=''){
$styleId='and styleId="'.$_GET['styleId'].'"';
}

if($_GET['materialId']!=''){
$materialId='and materialId="'.$_GET['materialId'].'"';
}

$where='where materialid in ( select id from styleSubCategoryMaster where materialType=1) '.$styleId.' '.$materialId.' group by color,materialId';

$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';

$rs=GetRecordListJs($select,'grnMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($listdata=mysqli_fetch_array($rs[0])){

	$querydataq=GetPageRecord('*','queryMaster','1 and id="'.$listdata['styleId'].'"');
       $resultlists=mysqli_fetch_array($querydataq);

       $where2='styleId="'.$listdata['styleId'].'" and materialType=1 and id="'.$listdata['materialId'].'"';
				$rs2=GetPageRecord('*','styleSubCategoryMaster',$where2);
				$matData=mysqli_fetch_array($rs2);

	$rsListitemq=GetPageRecord('*','indentCreationMaster','styleId="'.$listdata['styleId'].'" and materialTypeId=1 and materialId="'.$listdata['materialId'].'" and color="'.$listdata['color'].'"');
	$rsListitem=mysqli_fetch_array($rsListitemq);

       $tsq=GetPageRecord('bomPlacement,matPrice,storesupplier,supplierartname,bomAvg','techPackDetailMaster','1 and stylesubtabid='.$listdata['materialId'].'  order by id asc');
           $techShellData=mysqli_fetch_array($tsq);

           $rsgrnrec=GetPageRecord('sum(netReceived) as netReceivedTill,color,parentId','grnMaster','styleId="'.$listdata['styleId'].'" and materialId="'.$listdata['materialId'].'" and color="'.$listdata['color'].'"');
				$rsgrnrecTill=mysqli_fetch_array($rsgrnrec);

?>
                                <tbody>
							<tr role="row" class="odd">
							  <td align="left"><?php echo getbrandName($resultlists['brandId']); ?></td>
								<td align="left"><?php echo getBuyerName($resultlists['buyerId']); ?></td>
							 	<td>#<?php echo getStyleRefId($listdata['styleId']); ?></td>
							    <td><?php echo $resultlists['subject']; ?></td>
								  <td ><div style="width:70px;"><?php if($resultlists['pcdDate']!='0000-00-00'){ echo date('d-m-Y', strtotime($resultlists['pcdDate'])); }else{ echo '-'; } ?></div></td>
							    <td align="center"><?php echo getsupplierCompany($techShellData['storesupplier']); ?></td>
								<td><?php echo $matData['name']; ?></td>
								 <td><?php
						$rs112=GetPageRecord('name','colorCardMaster','id="'.$listdata['color'].'"');
						$resListing112=mysqli_fetch_array($rs112);
						echo $resListing112['name'];
						?></td>

							 <td align="center"><?php echo $listdata['uom'] ?></td>
						<td align="center"><?php echo $req = round($rsListitem['poQty']*$rsListitem['avg'],3); ?></td>
						<td align="center"><?php echo $rec = round($rsgrnrecTill['netReceivedTill'],3); ?></td>
							     <td align="center"><?php echo $req-$rec; ?></td>
							     <td align="center"><?php echo $rate =  $techShellData['matPrice']; ?></td>
							     <td align="center"><?php echo round($rec*$rate,3); ?></td>

							</tr>
							</tbody>

<?php } ?>

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
