 <?php
include "inc.php";
?>
<div class="card-group-control card-group-control-right" style="margin-top:20px;">

<?php

$select='';
$where='';
$rs='';
$select='*';
if($_REQUEST['module']=="style"){
$where='styleid='.$_REQUEST['id'].' order by id desc';
}
if($_REQUEST['module']=="comparesuppliercost"){
$where='styleid='.$_REQUEST['id'].' and supplierid="'.$_REQUEST['supplierId'].'" order by id desc';
}

$rs=GetPageRecord($select,'supplierPurchasemail',$where);
while($supplierlisting=mysqli_fetch_array($rs)){

?>
<div class="card mb-2" style="border-radius: 0px !important;margin-bottom: 5px !important;">
								<div class="card-header" data-toggle="collapse" href="#buy<?php echo stripslashes($supplierlisting['id']); ?>" aria-expanded="false" style="cursor:pointer;"  onclick="showView();">
									<h6 class="card-title" style="font-weight:500;">
										<a style="font-size: 13px;font-weight:400;color:#000 !important;" class="text-default collapsed" data-toggle="collapse" href="#buy<?php echo stripslashes($supplierlisting['id']); ?>" aria-expanded="false" >
									<div style="display: inline-block;width: fit-content;left: -5px;position: relative;top: -1px;">

								 <i class="fa fa-reply" aria-hidden="true"></i>

		</div><?php echo ltrim(stripslashes($supplierlisting['subject']), '#'); ?></span>
<div style="position: absolute;right: 0px;top: 3px;color: #929292;font-weight: 400;font-size: 11px;"><?php echo date('d M, Y - h:i A ', $supplierlisting['adddate']); ?></div>

										</a>
									</h6>
								</div>

								<div id="buy<?php echo stripslashes($supplierlisting['id']); ?>" class="collapse"  style="padding-top:20px;">
						 <div class="card-body">

							<div class="row" style="padding:0px 5px;" id="supplierreply">

							<?php echo $supplierlisting['description']; ?>

							</div></div>


					</div>


					</div>

				<?php }  ?>



							</div>

<style>
.card-header:not([class*=bg-]):not([class*=alpha-]) {
background-color: transparent;
padding-top: 0.5rem;
padding-bottom: 0.5rem;
border-bottom-width: 0;
background-color: #f7f7f7;
}
.card-group-control .card-title>a.collapsed:before {
content: '';
}

.card-group-control .card-title>a:before {
content: '';
}
#supplierreply p{
margin-top:15px;
}
</style>