<?php
$select1='*';
$where1='parentId='.$_SESSION['userid'].'';
$rs1=GetPageRecord($select1,'userMaster',$where1);
$editresult=mysqli_fetch_array($rs1);
?>
	<div class="page-content">

		<!-- Main sidebar -->
		<?php include "left.php"; ?>
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<div class="page-header">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><span class="font-weight-semibold">Chat Widget</span> -  <?php if($_REQUEST['a']=='1'){ ?>Chat History <?php } else {  ?>Active Chats<?php } ?></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>


				</div>
			</div>
			<!-- /page header -->


			<!-- Content area -->
			<div class="content pt-0">




				<!-- Dashboard content -->
				<div class="row">
				<div class="col-xl-<?php if($_REQUEST['a']!='1'){ ?>9<?php } else { ?>12<?php } ?>">
				<div class="card" id="loadchatuserwindow">
								<div style="padding:10% 0%; text-align:center;"><img src="images/no-visitor.png" width="292" /><br />
								  <br />
								  No Visitor Selected<br />
				  Please select visitor from online visitors </div>
				  </div>
							<script>
							function funloadchatuserwindow(id){
							$('#loadchatuserwindow').load('loadaction.php?action=loadchatwindowuser&id='+id);
							}
							</script>


					</div>
					<?php if($_REQUEST['a']!='1'){ ?>
<div class="col-xl-3">
				<div class="card">
								<div class="card-header bg-transparent header-elements-inline">
									<span class="card-title font-weight-semibold">Online Visitors</span>
									<div class="header-elements">
										<span class="badge bg-success badge-pill" id="totalusers">0</span>
			                		</div>
				  </div>

								<ul class="media-list media-list-linked my-2" id="loadallonlineuser">
<div style="padding:20px; text-align:center;">Loading Visitors</div>


								</ul>
		  </div>


					</div>
					 <?php } ?>
				</div>
				<!-- /dashboard content -->

			</div>
			<!-- /content area -->


			<!-- Footer -->

			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>

 <style>
 .media-list-linked a.media {
    border-bottom: 1px solid #ededed; padding:7px 14px !important;
}

.newmsg{background-color: #ffa2003d !important;}
 </style>

<script>
<?php if($_REQUEST['s']!=''){ ?>
funloadchatuserwindow('<?php echo $_REQUEST['s']; ?>&a=<?php echo $_REQUEST['a']; ?>');
<?php } ?>
<?php if($_REQUEST['s']==''){ ?>
setInterval(function() {
$('#loadallonlineuser').load('loadaction.php?action=showallliveuser');
}, 3000);
<?php } ?>
</script>