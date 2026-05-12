
<div class="row" style="margin-top:15px;">
						<div class="col-xl-2">
							<div class="card border-left-3 border-left-success-400 rounded-left-0" style="height:210px;">
								<?php
								$select2='*';
								$where2='id="'.$buyerId.'"';
								$rs2=GetPageRecord($select2,_BUYER_MASTER_,$where2);
								$editresultstyle2=mysqli_fetch_array($rs2);
								?>
								<div class="card-header bg-white">
									<h6 class="card-title">Buyer - <span style="color:#0223c1"><?php echo $editresultstyle2['name']; ?></span></h6>
								</div>

								<div class="card-body">
									<div class="media">
								<?php
								$where2='id="'.$editresultstyle['brandId'].'"';
								$rs2=GetPageRecord('*','brandMaster',$where2);
								$editresultstyle2=mysqli_fetch_array($rs2);
								?>

										<!--<div class="media-body">
											<span class="text-muted">Short Name</span>
											<div class="media-title font-weight-semibold"><?php echo $editresultstyle2['buyerShortName']; ?></div>
										</div>-->

										<div class="media-body">
											<span class="text-muted">Buyer Id</span>
											<div class="media-title font-weight-semibold"><?php echo $editresultstyle2['buyerId']; ?></div>
										</div>
										<div class="media-body">
											<span class="text-muted">Prod. Merch.</span>
											<div class="media-title font-weight-semibold"><?php echo getUserName($editresultstyle2['productionmerchant']);?></div>
										</div>
									</div>
									<div class="media">

										<div class="media-body">
											<span class="text-muted">PD Merch.</span>
											<div class="media-title font-weight-semibold"><?php echo getUserName($editresultstyle2['pdmerchant']);?></div>
										</div>


									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-3">
							<div class="card border-left-3 border-left-success-400 rounded-left-0" style="height:210px;">

								<div class="card-header bg-white">
									<h6 class="card-title">Brand  <span style="color:#0223c1"> - <?php echo $editresultstyle2['name']; ?></span></h6>
								</div>

								<div class="card-body">
									<div class="media">
										<div class="media-body">
											<span class="text-muted">Color</span>
											<div class="media-title font-weight-semibold">
<?php
$colorr = '';
$rsColorDetail22=GetPageRecord('*','styleColorDetailMaster','styleId="'.$editresultstyle['id'].'"');
while($rsColorDetailList22=mysqli_fetch_array($rsColorDetail22)){
	$colorr.=getColorName($rsColorDetailList22['colorId']).',';
}
echo rtrim($colorr,',');
?>
											</div>
										</div>
										<div class="media-body">
											<span class="text-muted">Season</span>
											<div class="media-title font-weight-semibold">Summer</div>
										</div>
										<div class="media-body">
											<span class="text-muted">CPM</span>
											<div class="media-title font-weight-semibold"><?php echo $editresultstyle2['cpm']; ?></div>
										</div>
									</div>
									<div class="media">
										<div class="media-body">
											<span class="text-muted">Order No.</span>
											<div class="media-title font-weight-semibold"><?php if($editresultstyle['masterStyleNo']!=''){ echo $editresultstyle['masterStyleNo']; }else{ echo '-'; } ?></div>
										</div>
										<div class="media-body">
											<span class="text-muted">DVN</span>
											<div class="media-title font-weight-semibold"><?php if($editresultstyle['merchantStyleNo']!=''){ echo $editresultstyle['merchantStyleNo']; }else{ echo '-'; } ?></div>
										</div>
									</div>
								</div>
							</div>
						</div>

							<div class="col-xl-7" style="height:210px;">
								<div class="card border-left-3 border-left-danger-400 rounded-left-0" style="height: 210px;">
								<div class="card-header bg-white">
									<h6 class="card-title">Style  - <span style="color:#0223c1"><?php echo $subject; ?></span></h6>
						<?php if($editresultstyle['attachmentFile']!='') { ?>

									<div class="btn-group justify-content-center" style="float:right;">

 <a href="images/<?php echo $editresultstyle['attachmentFile']; ?>" target="blank" class="btn bg-teal-400" aria-expanded="false" style="    background-color: #777777; position:absolute; right:-16px; top:-30px;"><i class="fa fa-download mr-2"></i>Download Techpack </a>

	<?php if($_GET['module']=="sampletobuyer" || $_GET['module']=="costsheet"){ ?>
	<a href="showpage.crm?module=<?php echo $_GET['module']; ?>" class="btn bg-teal-400" aria-expanded="false" style="    background-color: #777777; position:absolute; right:166px; top:-30px;border-radius: 3px;">Back  </a>
	<?php } ?>
						</div>

						<?php } ?>



								</div>
									<div class="card-body">

										<div class="col-xl-2" style="float:left;">
											<div class="" style="width: auto;display: block;">
												<?php
												$selectimg='*';
												$whereimg='parentId="'.$editresultstyle['id'].'" and galleryType="image_gallery" order by id asc limit 1';
												$rsimg=GetPageRecord($selectimg,'imageGallery',$whereimg);
												$count = mysqli_num_rows($rsimg);
												while($imgresult=mysqli_fetch_array($rsimg)){
												?>

												<div class="image-block">
						 <a style="cursor:pointer;display:block;" herf="#"  onclick="opmodalpop(' Image Gallery','modalpop.php?action=imagegalleryview&id=<?php echo encode($editresultstyle['id']); ?>','800px','auto');" data-toggle="modal" data-target="#modalpop"> <img src="<?php echo $fullurl; ?>images/<?php echo $imgresult['attachmentImage']; ?>" alt="<?php echo $imgresult['name']; ?>" style="width: auto;max-height: 100px;"></a>
												</div>

												<?php } ?>
											</div>
										</div>


										<div class="col-xl-<?php if($count!='0') { ?>10<?php } else { ?>12<?php } ?> " style="float:right;">

										<div class="media">

										<div class="media-body" style="flex:auto !important; width:1% !important;">
											<span class="text-muted">Style#</span>
											<div class="media-title font-weight-semibold" ><?php echo $editresultstyle['styleRefId']; ?></div>
										</div>
										<div class="media-body" style="flex:auto !important; width:1% !important;">
										<span class="text-muted">Segment</span>
											<div class="media-title font-weight-semibold">Apparel</div>

										</div>
										<div class="media-body" style="flex:auto !important; width:1% !important;">
											<span class="text-muted">Category</span>
											<div class="media-title font-weight-semibold"><?php
										$select1='name';
										$where1='id="'.$categoryId.'"';
										$rs1=GetPageRecord($select1,_CATEGORY_MASTER_,$where1);
										$resultlist1=mysqli_fetch_array($rs1);
										echo $resultlist1['name'];


										?></div>

										</div>

										<div class="media-body">
										<span class="text-muted">Sub Category</span>
											<div class="media-title font-weight-semibold">
											<?php
												$select1='name';
										$where1='id="'.$subCategoryId.'"';
										$rs1=GetPageRecord($select1,_SUB_CATEGORY_MASTER_,$where1);
										$resultlist1=mysqli_fetch_array($rs1);
										echo $resultlist1['name'];
											?>
											</div>
										</div>

										<div class="media-body" style="flex:auto !important; width:1% !important;">
										<span class="text-muted">Gender</span>
											<div class="media-title font-weight-semibold">
											<?php
											$rs=GetPageRecord('name','genderMaster','id="'.$editresultstyle['gender'].'"');
											$resListingGender=mysqli_fetch_array($rs);
											 echo $resListingGender['name'];
											?></div>

										</div>
										<div class="media-body" style="flex:auto !important; width:1% !important;">
										<span class="text-muted">Received Date</span>
											<div class="media-title font-weight-semibold"><?php echo date('d-m-Y',strtotime($editresultstyle['receivedDate'])); ?></div>

										</div>





									</div>
										<div class="media">
										<div class="media-body" style="flex:auto !important; width:1% !important;">
										<span class="text-muted">OCD</span>
											<div class="media-title font-weight-semibold">
											<?php if($editresultstyle['ocdDate']=='0000-00-00' || $editresultstyle['ocdDate']=='1970-01-01' ){ echo '-';}else{ echo date('d-m-Y',strtotime($editresultstyle['ocdDate']));   } ?>
											</div>
										</div>



										<div class="media-body" style="flex:auto !important; width:1% !important;">
										<span class="text-muted">PCD</span>

												<div class="media-title font-weight-semibold">
											<?php if($editresultstyle['pcdDate']=='0000-00-00' || $editresultstyle['pcdDate']=='1970-01-01' ){ echo '-';}else{ echo date('d-m-Y',strtotime($editresultstyle['pcdDate']));   } ?>
											</div>
										</div>

										<div class="media-body" style="flex:auto !important; width:1% !important;">
										<span class="text-muted">Ex Fac. Date</span>

												<div class="media-title font-weight-semibold">
											<?php if($editresultstyle['shipDate']=='0000-00-00' || $editresultstyle['shipDate']=='1970-01-01' ){ echo '-';}else{ echo date('d-m-Y',strtotime($editresultstyle['shipDate']));   } ?>
											</div>

										</div>

										<div class="media-body" style="flex:auto !important; width:1% !important;">
										<span class="text-muted">SAM/Efficiency</span>
											<div class="media-title font-weight-semibold">
											<?php echo $editresultstyle['smv']; ?> / <?php echo $editresultstyle['efficiency']; ?>
											</div>
										</div>


										<div class="media-body" style="flex:auto !important; width:1% !important;">
										<span class="text-muted">Placement&nbsp;Qty.</span>
											<div class="media-title font-weight-semibold">
												<?php echo $editresultstyle['orderQty']; ?>
											</div>
										</div>

										<div class="media-body" style="flex:auto !important; width:1% !important;">
										<!-- <span class="text-muted">File H/O</span> -->
											<div class="media-title font-weight-semibold">

											</div>
										</div>

										</div>

										</div>

									</div>

									<!--<div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
										<span>Due: <span class="font-weight-semibold">23 hours</span></span>
									</div>-->
								</div>
							</div>

			</div>