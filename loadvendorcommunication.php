 <?php
include "inc.php";
?>


<div class="card-group-control card-group-control-right" style="margin-top:20px;">



<?php
$sr=1;
$select='';
$where='';
$rs='';
$select='*';
if($_REQUEST['module']=="style"){
$where='styleid='.$_REQUEST['id'].' order by id desc';
}
if($_REQUEST['module']=="comparevendorcost"){
$where='styleid='.$_REQUEST['id'].' and vendorid="'.$_REQUEST['vendorId'].'" and pd="'.$_REQUEST['pd'].'" order by id desc';
}
$rs=GetPageRecord($select,'vendorPurchasemail',$where);
while($supplierlisting=mysqli_fetch_array($rs)){

$rsk=GetPageRecord('sum(valueOnePiece) as totalCost','materialSendToVendor','vendorPurchaseEmailId="'.$supplierlisting['id'].'"');
$rkdm=mysqli_fetch_array($rsk);
$totalCost=$rkdm['totalCost'];

?>
<table cellpadding="5" cellspacing="0" width="100%">
<tr>
<td style="width:85%;border:1px solid #dedede;"> <div class="card mb-2" style="border-radius: 0px !important;margin-bottom: 5px !important;">
								<div class="card-header" data-toggle="collapse" href="#buy<?php echo stripslashes($supplierlisting['id']); ?>" aria-expanded="false" style="cursor:pointer;"  onclick="showView();">
									<h6 class="card-title" style="font-weight:500;">
										<a style="font-size: 13px;font-weight:400;color:#000 !important;" class="text-default collapsed" data-toggle="collapse" href="#buy<?php echo stripslashes($supplierlisting['id']); ?>" aria-expanded="false" >
									<div style="display: inline-block;width: fit-content;left: -5px;position: relative;top: -1px;">
									<?php if($supplierlisting['status']==1){ ?>
								 <i class="fa fa-reply" aria-hidden="true"></i>
 									<?php }else{ ?>
									 <i class="fa fa-share" aria-hidden="true"></i>
									<?php } ?>
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


					</div> </td>

<script>
function abc(){
$('#totalCost<?php echo $supplierlisting['id']; ?>').text('<?php echo $totalCost;  ?>');
}
abc();
</script>

<td style="width:10%;border:1px solid #dedede; text-align:center;"><span id="totalCost<?php echo $supplierlisting['id']; ?>" style="color: #00ad00; font-weight: 500; font-size: 21px;"><?php echo $totalCost; ?></span></td>
<td style="width:50%;border:1px solid #dedede; text-align:center;"><?php if($supplierlisting['status']==1){ ?><?php if($supplierlisting['attachement']!=''){ ?><div><a href="<?php echo $fullurl.'images/'.$supplierlisting['attachement']; ?>" target="_blank"><i class="fa fa-download" aria-hidden="true" style="font-size: 20px;"></i></a></div><?php }else{ echo '-'; } } ?></td>

</tr>
</table>


				<?php $sr++; }  ?>



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