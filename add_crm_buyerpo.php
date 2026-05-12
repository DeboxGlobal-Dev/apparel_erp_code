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
$patternAttachment = $editresultstyle['patternAttachment'];
$attachmentFile = $editresultstyle['attachmentFile'];
$techpackdescription = $editresultstyle['techpackdescription'];

$lastId=$editresultstyle['id'];

}

?>
	<div class="page-content">
 	<?php include "left.php"; ?>
	 <div class="content-wrapper">

		  <div class="content pt-0" style="margin-top:20px;">
 	<?php include "top-style.php"; ?>
			 	<div class="row">

				<div class="col-md-12">
				<div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Buyer Purchase Order </h5>
						<div class="header-elements">
							<div class="list-icons">

		                	</div>
	                	</div>
					</div>


					<div class="buyer-to-po" style="padding:15px 20px;">
					<div class="pdf-checker" style="width:44%; float: left; display: block; height:820px; padding: 0px;">
					<?php if($editresultstyle['poAttachment']!='') { ?>
							<object data="<?php echo $fullurl; ?>attachment/<?php echo $editresultstyle['poAttachment']; ?>" type="application/pdf" style="height: 100%;width: 100%;display: block;">
							</object>
					<?php } else { ?>
					<div>No Purchase order found</div>
					<?php } ?>
					</div>

					<div class="pdf-manual" style="width:55%;float:right; overflow:auto;" id="loadBuyerPo">


					</div>
					<script>
					$('#loadBuyerPo').load('loadBuyerPo.php?styleId=<?php echo decode($_REQUEST['styleid']); ?>&module=<?php echo $_GET['module']; ?>');
					</script>

					<div id="poAction" style="display:none;"></div>

					</div>


				</div>
			</div>


					</div>

			</div>
				 </div>
		 </div>
		 </div>

<style>
#marketingteam .owl-carousel .owl-nav button.owl-next, .owl-carousel .owl-nav button.owl-prev, .owl-carousel button.owl-dot {
	position: absolute;
	top: 40% !important;
	right: 19% !important;
	font-size: 40px !important;
	outline: none !important;
	text-decoration: none !important;
}

#marketingteam .owl-carousel .owl-nav button.owl-next, .owl-carousel .owl-nav button.owl-prev, .owl-carousel button.owl-dot {
    position: absolute;
    top: 40%;
    right: 19% !important;
    font-size: 40px !important;
    outline: none !important;
    text-decoration: none !important;
}

</style>

