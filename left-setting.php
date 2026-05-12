<div class="col-xl-2">

				<div class="sidebar sidebar-light bg-transparent sidebar-component wmin-300 border-0 shadow-0 order-1 order-md-2 sidebar-expand-md">

						<!-- Sidebar content -->
						<div class="sidebar-content">



							<!-- Navigation -->
							<div class="card">
								<div class="card-header bg-transparent header-elements-inline">
									<span class="card-title font-weight-semibold">Setting</span>
									<div class="header-elements">
										<div class="list-icons">
					                		<a class="list-icons-item" data-action="collapse" style="display:none;"></a>
				                		</div>
			                		</div>
								</div>

								<div class="card-body p-0" style="">
									<ul class="nav nav-sidebar my-2">
										<li class="nav-item">

										<?php
										$select1='*';
										$where1='1';
										$rs1=GetPageRecord($select1,_USER_MASTER_,$where1);
										$countuser=mysqli_num_rows($rs1);

										?>
											<a href="showpage.crm?module=users" class="nav-link <?php if($_GET['module']=='users') { ?> active <?php } ?>">
												<i class="icon-users"></i>
												Users
												<span class="badge bg-danger badge-pill ml-auto" style="background-color: #0097a7!important;"><?php echo $countuser; ?></span>
											</a>
										</li>
										<li class="nav-item" style="display:none;">
											<a href="showpage.crm?module=role" class="nav-link <?php if($_GET['module']=='role') { ?> active <?php } ?>">
												<i class="icon-people"></i>
												Role

											</a>
										</li>

										<li class="nav-item">
											<?php
										$select11='*';
										$where11='1';
										$rs11=GetPageRecord($select11,_PROFILE_MASTER_,$where11);
										$countprofile=mysqli_num_rows($rs11);

										?>

											<a href="showpage.crm?module=profile" class="nav-link <?php if($_GET['module']=='profile') { ?> active <?php } ?>">
												<i class="icon-stack2"></i>
												Profile
												<span class="badge bg-danger badge-pill ml-auto" style="background-color: #0097a7!important;"><?php echo $countprofile; ?></span>
											</a>
										</li>



											<li class="nav-item">
											<?php
										$select1='*';
										$where1='1';
										$rs1=GetPageRecord($select1,_EMAIL_SETTING_MASTER_,$where1);
										$countemail=mysqli_num_rows($rs1);

										?>
											<a href="showpage.crm?module=emailsetting" class="nav-link <?php if($_GET['module']=='emailsetting') { ?> active <?php } ?>">
												<i class="icon-envelop2"></i>
												Email Setting
												<span class="badge bg-danger badge-pill ml-auto" style="background-color: #0097a7!important;"><?php echo $countemail; ?></span>

											</a>
										</li>


										<li class="nav-item" style="display:none;">
											<a href="showpage.crm?module=emailtemplates" class="nav-link">
												<i class="icon-envelop2"></i>
												Email Templates
											</a>
										</li>

										<li class="nav-item">

											<a href="showpage.crm?module=materialconfiguration" class="nav-link <?php if($_GET['module']=='materialconfiguration') { ?> active <?php } ?>">
												<i class="fa fa-cogs" aria-hidden="true"></i>
												Material Setting
										 	</a>
										</li>




									</ul>
								</div>
							</div>
							<!-- /navigation -->

						</div>
						<!-- /sidebar content -->

					</div>



				</div>

<style>
.wmin-300 {
    min-width: 100% !important;
	width:100% !important;
}
</style>
