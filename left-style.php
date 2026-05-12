<div class="col-xl-3">


				<div class="card">
				<div class="card-body navbar-dark">
							<div class="media">
								<div class="mr-3 align-self-center">
									<h6 class="media-title font-weight-semibold">ID: <?php echo '#'.$resultpage['styleRefId']; ?></h6>
								</div>

								<div class="media-body text-right">
									<span class="opacity-75"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('d/m/Y - h:i A',$resultpage['dateAdded']); ?></span>
								</div>
							</div>
						</div>
							 <div style="height:200px; text-align:center; margin-top:10px;">
							 <?php if($imgresult['attachmentImage']!='') { ?>

							 <a style="cursor:pointer;" herf="#"  onclick="opmodalpop(' Image Gallery','modalpop.php?action=imagegalleryview&id=<?php echo encode($resultpage['id']); ?>','800px','auto');" data-toggle="modal" data-target="#modalpop"><img class="card-img img-fluid" src="images/<?php if($imgresult['attachmentImage']!=''){?><?php echo $imgresult['attachmentImage']; ?><?php }else{ ?>noimage.png<?php } ?>" style=" height:100%; width:auto;"  ></a>

							 <?php } else { ?>
							 <img class="card-img img-fluid" src="images/noimage.png" style=" height:100%; width:auto;"  >
							 <?php } ?>

							 </div>

					    	<div class="card-body text-center">
					    		<h6 class="font-weight-semibold"><a herf="showpage.crm?module=style"><?php echo stripslashes($resultpage['subject']); ?></a></h6>

								<div class="list-group-item list-group-divider"></div>

							<?php if($resultpage['attachmentFile']!=''){?>

								<a href="images/<?php echo $resultpage['attachmentFile']; ?>" target="blank" class="list-group-item list-group-item-action">
								<i class="fa fa-download mr-3" aria-hidden="true"></i>
								Download Tech-Pack
								</a>
							<?php } ?>

					    	</div>





				    	</div>










				<div class="card">

<div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
										<span style="font-weight:600;">Style Information </span>

									</div>
							<div class="card-body">
								<div class="list-feed">
									<div class="list-feed-item border-blue-400">
										<div class="text-muted font-size-sm mb-1">Season</div>
										<?php
										$select1='name,seasonYear';
										$where1='id="'.$resultpage['seasonId'].'"';
										$rs1=GetPageRecord($select1,_SEASON_MASTER_,$where1);
										$resultlist1=mysqli_fetch_array($rs1);
										echo $resultlist1['name'].' '.$resultlist1['seasonYear'];
										?>
									</div>
									<div class="list-feed-item border-blue-400">
										<div class="text-muted font-size-sm mb-1">Segment</div>
										<?php
										$select1='name';
										$where1='id="'.$resultpage['segment'].'"';
										$rs1=GetPageRecord($select1,'segmenteMaster',$where1);
										$resultlist1=mysqli_fetch_array($rs1);
										echo $resultlist1['name'];
										?>
									</div>
									<div class="list-feed-item border-blue-400">
										<div class="text-muted font-size-sm mb-1">Category - Sub&nbsp;Category</div>
										<?php echo getCategoryName($resultpage['categoryId']).' - '.getSubCategoryName($resultpage['subCategoryId']); ?>
									</div>
									<div class="list-feed-item border-blue-400">
										<div class="text-muted font-size-sm mb-1">Priority</div>
										<?php if($resultpage['queryPriority']==1){ ?>
										<span class="badge badge-secondary" style="width: 47px;">Low</span>
										<?php }elseif($resultpage['queryPriority']==2){ ?>
										<span class="badge badge-primary" style="width: 47px;">Medium</span>
										<?php }else{ ?>
										<span class="badge badge-danger" style="width: 47px;">High</span>
										<?php } ?>
									</div>


									<div class="list-feed-item border-blue-400">
										<div class="text-muted font-size-sm mb-1">Remark</div>
										<?php if($resultpage['remark']!=''){ echo stripslashes($resultpage['remark']); }else{ echo '-'; }   ?>
									</div>


								</div>
							</div>
						</div>


					<div class="card">
					<div class="card-footer d-sm-flex justify-content-sm-between align-items-sm-center">
						<span style="font-weight:600;">Buyer Information </span>
  					</div>
							<div class="card-body">
								<div class="list-feed">
									<div class="text-muted font-size-sm mb-1">Buyer Name</div>
									<?php
									$select1='*';
									$where1='id="'.$resultpage['buyerId'].'"';
									$rs1=GetPageRecord($select1,_BUYER_MASTER_,$where1);
									$resultlist1=mysqli_fetch_array($rs1);
									echo $resultlist1['name'];
									?>
									<div class="text-muted font-size-sm mb-1">Buyer Id</div>
									<?php echo $resultlist1['buyerId']; ?>
									</div>
									<div class="text-muted font-size-sm mb-1">Buyer Short Name</div>
									<?php echo $resultlist1['buyerShortName']; ?>
									<div class="text-muted font-size-sm mb-1">Email</div>
									<?php echo $resultlist1['buyeremail']; ?>
									<div class="text-muted font-size-sm mb-1">Phone</div>
									<?php echo $resultlist1['buyerphone']; ?>
									<div class="text-muted font-size-sm mb-1">Default Currency</div>
									<?php
									$a=GetPageRecord('*','queryCurrencyMaster','1 and id="'.$resultlist1['buyerCurrency'].'"');
									$currenname=mysqli_fetch_array($a);
									echo $currenname['name'];
									?>

							</div>
						</div>


				 </div>