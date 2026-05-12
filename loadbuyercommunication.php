 <?php
include "inc.php";
?>
<div class="card-group-control card-group-control-right" style="margin-top:20px;">

<?php

$select='';

$where='';

$rs='';

$select='*';
$where='queryid='.$_GET['id'].' order by adddate desc';
$rs=GetPageRecord($select,_QUERYMAILS_MASTER_,$where);
while($querylisting=mysqli_fetch_array($rs)){
$queryemaildate=$querylisting['adddate'];
$querydate=date("Y-m-d H:i:s",$resultpage['dateAdded']);
$mailbodydetails=$querylisting['description'];






?>
<div class="card mb-2" style="border-radius: 0px !important;margin-bottom: 5px !important;">
								<div class="card-header" data-toggle="collapse" href="#buy<?php echo stripslashes($querylisting['id']); ?>" aria-expanded="false" style="cursor:pointer;">
									<h6 class="card-title" style="font-weight:500;">
										<a style="font-size: 13px;font-weight:400;color:#000 !important;" class="text-default collapsed" data-toggle="collapse" href="#buy<?php echo stripslashes($querylisting['id']); ?>" aria-expanded="false">
									<div style="display: inline-block;width: fit-content;left: -5px;position: relative;top: -1px;">

									<?php if($querylisting['queryStatus']=='22222') { ?><i class="fa fa-reply" aria-hidden="true"></i><?php } else { ?> <i class="fa fa-share" aria-hidden="true"></i> <?php } ?>




									</div><?php echo ltrim(stripslashes($querylisting['subject']), '#'); ?>&nbsp;-&nbsp;<span style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis; position: absolute;max-width: 105px;"><?php  echo  strip_tags($mailbodydetails); ?></span>
		<div style="position: absolute;right: 0px;top: 3px;color: #929292;font-weight: 400;font-size: 11px;"><?php echo date('d M, Y - h:i A ', strtotime($queryemaildate)); ?></div>






										</a>
									</h6>
								</div>

								<div id="buy<?php echo stripslashes($querylisting['id']); ?>" class="collapse"  style="padding-top:20px;">
						 <div class="card-body">

							<div class="row" style="padding:0px 05px;">
							<?php  echo $mailbodydetails; ?>
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
							</style>