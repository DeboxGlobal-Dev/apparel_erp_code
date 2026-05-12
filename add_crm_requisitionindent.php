<?php

if($_GET['id']!=''){
$select='*';
$where='id="'.decode($_GET['id']).'"';
$rs=GetPageRecord($select,'maintenancegi_Master',$where);
$editresultstyle=mysqli_fetch_array($rs);

}


?>

<div class="page-content">
  <!-- Main sidebar -->
  <?php include "left.php"; ?>
  <!-- /main sidebar -->
  <!-- Main content -->
  <div class="content-wrapper">
    <!-- Content area -->
    <div class="content pt-0" style="margin-top:20px;">
      <!-- Dashboard content -->
	  <div class="row">
				<div class="col-xl-12">
			 	<div class="card mb-0 rounded-bottom-0" style="padding:15px;">
				 	<div class="panel panel-flat">
					<div class="table-responsive">
			 			<table width="100%" class="table table-bordered table-responsive" style="margin-bottom:5px;">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body">
                              <td width="16%"></td>
							  <td width="64%" style="text-align:center;"><strong style="font-size:23px;">INDENT</strong></td>
							  <td width="16%" style="text-align:right;"><?php //echo date('d-m-Y h:i:s A'); ?></td>
                            </tr>
                          </tbody>
                        </table>
						<table width="100%" class="table table-bordered table-responsive" style="margin-bottom:5px;">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body">
                              <td width="25%"> <strong>Indent No: </strong><span class="badge badge-warning" style="font-size: 11px;"><?php echo 'R-IND'.date('dmy',($editresultstyle['dateAdded'])); ?>00<?php echo decode($_GET['id']); ?></span></td>
							  <td width="25%"><strong>Indent Date: </strong><?php echo date('d-m-Y',($editresultstyle['dateAdded'])); ?>  </td>
							  <td width="25%"><strong>Requisition No:  </strong><?php echo $editresultstyle['requisitionno']; ?></td>

							</tr>
                          </tbody>
     					</table>



				        <div id="add_indentmpl">
					    <table width="100%" class="table table-bordered table-responsive forbom" id="tableid11" style="display:block;">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body" style="background-color: #fff7b3;;">
							<!-- <th width="15%" align="center"><strong></strong><input  name="materialCheckAll" type="checkbox" class="checkalldeletematerial" id="materialCheckAll" style="height: 17px;width: 50px;margin-top: 0;text-align: center;" /></th>-->
                              <th>Item&nbsp;Name</th>
							<th>Color</th>
							<th>Size</th>
							<th>Quantity&nbsp;Requested</th>
							<th>Supplier</th>
							<th>Price</th>
							<th>Amount</th>
							<th>Purpose.</th>

						  </tr>
						  <tr class="card-body">
							<?php
						$no = 1;
						$wherenew='parentId="'.decode($_GET['id']).'" order by id asc';
						$rsnew=GetPageRecord('*','loadmaintenance',$wherenew);
						while($rslistnew=mysqli_fetch_array($rsnew)){

						    $wherenewxc='id="'.$rslistnew['item'].'"';
						    	$rsnewxc=GetPageRecord('*','maintenancegeneral_Master',$wherenewxc);
						$rslistnewxc=mysqli_fetch_array($rsnewxc);

						$wherenewxcz='id="'.$rslistnew['supplier'].'"';
						    	$rsnewxcz=GetPageRecord('*','suppliersMaster',$wherenewxcz);
						$rslistnewxcz=mysqli_fetch_array($rsnewxcz);


						?>
                        <tr>

							<td>
							    <a href ="#" onclick="opmodalpop('','modalpop.php?action=requisitionindentSendpo&pageeditid=<?php echo $_GET['id']; ?>&requestedquantity=<?php echo $rslistnew['requestedquantity']; ?>&price=<?php echo $rslistnew['price']; ?>&requisitionno=<?php echo $editresultstyle['requisitionno']; ?>&mainid=<?php echo $rslistnew['id']; ?>&supplier=<?php echo addslashes($rslistnew['supplier']); ?>','900px','auto');" data-toggle="modal" data-target="#modalpop">

							    <?php echo $rslistnewxc['material']; ?> </a>
							</td>
							<td><?php echo $rslistnewxc['color']; ?></td>
							<td><?php echo $rslistnew['size']; ?></td>
							<td><?php echo $rslistnew['requestedquantity']; ?></td>
							<td><?php echo $rslistnewxcz['name']; ?></td>
							<td><?php echo $rslistnew['price']; ?></td>

							<?php
							$as=$rslistnew['price']*$rslistnew['requestedquantity'];
							?>
							<td><?php echo $as; ?></td>
							<td><?php echo $rslistnew['purpose']; ?></td>

						</tr>
						<?php } ?>
                            </tr>
						  </tbody>
                        </table>
						</div>
					  </div>
					</div>
				  </div>



				 </div>
				 </div>



    </div>
    <!-- /dashboard content -->
  </div>
  <!-- /content area -->
</div>
<!-- /main content -->
</div>
<script type="text/javascript">
		$(document).ready(function(){
		// check uncheck all inclusions
		$("#materialCheckAll").click(function(){
		if(this.checked){
			$('.deletematerial').each(function(){
				this.checked = true;
			})
		}else{
			$('.deletematerial').each(function(){
				this.checked = false;
			})
		}
		});

		});
</script>

<script>
window.setInterval(function(){
      checked = $("#add_indentmpl input[type=checkbox]:checked").length;
      if(!checked) {
	  $("#deactivatebtnpurchasemerchant").hide();
      } else {
	  $("#deactivatebtnpurchasemerchant").show();
	  }
}, 100);
</script>
