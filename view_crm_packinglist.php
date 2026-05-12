<?php
if($_GET['styleid']!=''){
$select='*';
$where='id="'.decode($_GET['styleid']).'"';
$rs=GetPageRecord($select,'queryMaster',$where);
$editresultstyle=mysqli_fetch_array($rs);
$buyerId = $editresultstyle['buyerId'];
$buyerStyleRefNo = $editresultstyle['buyerStyleRefNo'];
$subject = $editresultstyle['subject'];
$displayId = $editresultstyle['displayId'];
$seasonId = $editresultstyle['seasonId'];
$categoryId = $editresultstyle['categoryId'];
$subCategoryId = $editresultstyle['subCategoryId'];
$departmentId = $editresultstyle['departmentId'];
$receivedDate = $editresultstyle['receivedDate'];
$patternDescription = $editresultstyle['patternDescription'];
$patternAttachment = $editresultstyle['patternAttachment'];
$lastId=$editresultstyle['id'];
}

?>
<style>

.form-control {
     padding: 4px;
}

.toggle.btn {
    min-width: 59px;
    min-height: 34px;
    width: auto !important;
    height: auto !important;
    margin: 0px !important;
}


.listc .table thead th {
    vertical-align: middle;
    border-bottom: 1px solid #b7b7b7;
    padding: 9px;
}
.listc .table-bordered td, .table-bordered th {
    border: 1px solid #ddd;
    padding: 8px;
}
.icon-calendar3{
	position: absolute;
    top: 18px;
    right: 0px;
}
</style>
<div class="page-content">

		<div class="content-wrapper">

			<div class="content pt-0" style="margin-top:20px;">
  	        <?php include "top-style.php"; ?>

			    <div class="col-xl-12" style="padding:0px;">
				 <div class="card">
							 <div class="card-body navbar-green"  style="padding:7px !important;" >
							<div class="media">
									 <div class="col-xl-6">
									<h6 class="media-title font-weight-semibold"  style="margin-top: 8px;">Packing List Report</h6>
									</div>
									<div class="col-xl-6" style="text-align:right;">
									<div class="d-flex align-items-center" style="float:right; ">

		                    	</div>

									</div>

							</div>
						</div>

							<div class="card-body listc">

								<table class="table table-bordered" style="font-size: 12px;">
							<thead style="background-color: #f9f8f8;">
								<tr class="border-top-info" style="background-color: #f9f8f8;">
								  <th width="89">&nbsp;</th>
									<th width="101">&nbsp; </th>
									<th width="85">&nbsp; </th>
									<th colspan="6" align="center" style="text-align:center;">Size</th>
									<th width="103">&nbsp; </th>
									<th width="148">&nbsp; </th>
									<th width="123">&nbsp; </th>
									<th width="139">&nbsp; </th>
								</tr>
								<tr class="border-top-info">
								  <th>&nbsp;</th>
									<th><div align="center">Carton No</div></th>
									<th><div align="center">Colour</div></th>
									<th width="64"><div align="center">XS</div></th>
									<th width="66"><div align="center">S</div></th>
									<th width="86"><div align="center">M</div></th>
									<th width="67"><div align="center">L</div></th>
									<th width="78"><div align="center">XL</div></th>
									<th width="88"><div align="center">2XL</div></th>
									<th><div align="center">Total Qty</div></th>

									<th><div>CTN Measurement (cm)</div></th>
									<th><div align="center">CTN Net Wt (Kg)</div></th>
									<th><div align="center">CTN Gross Wt (Kg)</div></th>
								</tr>
							</thead>



							<?php

							$sNo2 = 0;
							$select='';
							$where='';
							$rs='';
							$select='*';

							$where=' styleId="'.decode($_REQUEST['styleid']).'" and costsheetVersionId=1 and status=1 and deletestatus=0 order by id asc';
							$rs=GetPageRecord($select,'loadpackinglistmaster',$where);

							while($resListing1=mysqli_fetch_array($rs)){ ?>

							<?php
							$sNo2++;

							if($resListing1['carton_No']!=''){
							?>


<tr height="20">
  <td>&nbsp;</td>
  <td height="20" align="center"><?php echo stripslashes($resListing1['carton_No']); ?></td>

<td height="20" align="center"><?php echo stripslashes($resListing1['colour']); ?></td>

<td height="20" align="center"><?php echo stripslashes($resListing1['xs']); ?></td>

<td height="20" align="center"><?php echo stripslashes($resListing1['s']); ?></td>

<td height="20" align="center"><?php echo stripslashes($resListing1['m']); ?></td>

<td height="20" align="center"><?php echo stripslashes($resListing1['l']); ?></td>

<td height="20" align="center"><?php echo stripslashes($resListing1['xl']); ?></td>

<td height="20" align="center"><?php echo stripslashes($resListing1['x2l']); ?></td>

<td height="20" align="center"><?php echo stripslashes($resListing1['totalqty']); ?></td>

<td height="20" align="center"><?php echo stripslashes($resListing1['ctn_Measurement']); ?></td>

<td height="20" align="center"><?php echo stripslashes($resListing1['ctn_net']); ?></td>
<td height="20" align="center"><?php echo stripslashes($resListing1['ctn_gross']); ?></td>
  </tr>


   <?php } } ?>
  <?php if($sNo2==0){ ?>

<tr style="padding:8px;text-align: center; width: 100%;background-color: #efefef;"><td colspan="50"><div align="center">No Record Found.</div></td></tr>

  <?php } ?>


  <?php

$a=GetPageRecord('*','loadpackinglistmaster','1 and styleId="'.decode($_REQUEST['styleid']).'" and costsheetVersionId=1 and carton_No!="" and status=1 and deletestatus=0 group by carton_No');
$totalcarton=mysqli_num_rows($a);

$b=GetPageRecord('sum(xs) as totalxs,sum(s) as totals,sum(m) as totalm,sum(l) as totall,sum(xl) as totalxl,sum(x2l) as totalx2l,sum(totalqty) as totaltotalqty,sum(ctn_net) as totalctn_net,sum(ctn_gross) as totalctn_gross','loadpackinglistmaster','1 and styleId="'.decode($_REQUEST['styleid']).'" and costsheetVersionId=1 and status=1 and deletestatus=0 order by id desc');
$totalSum=mysqli_fetch_array($b);

  ?>

							<tr class="border-top-info" style="font-weight: 500; font-size: 13px; background-color: #9aabff; color:#fff;">
							<th><div align="center">TOTAL</div></th>
							<th><div align="center"><?php echo $totalcarton; ?></div></th>
							<th><div align="center"> </div></th>
							<th><div align="center" ><?php echo $totalSum['totalxs']; ?></div></th>
							<th><div align="center" ><?php echo $totalSum['totals']; ?></div></th>
							<th><div align="center" ><?php echo $totalSum['totalm']; ?></div></th>
							<th><div align="center" ><?php echo $totalSum['totall']; ?></div></th>
							<th><div align="center" ><?php echo $totalSum['totalxl']; ?></div></th>
							<th><div align="center" ><?php echo $totalSum['totalx2l']; ?></div></th>
							<th><div align="center" ><?php echo $totalSum['totaltotalqty']; ?></div></th>
							<th><div align="center"></div></th>
							<th><div align="center" ><?php echo $totalSum['totalctn_net']; ?></div></th>
							<th><div align="center" ><?php echo $totalSum['totalctn_gross']; ?></div></th>
							</tr>
						</table>

							</div>

						</div>
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

.btn-float i {
display: block;
top: 0;
font-size: 20px;
}
.card-group-control-right .card-body{width:100%;}

</style>