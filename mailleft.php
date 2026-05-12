<div class="sidebar sidebar-light sidebar-secondary sidebar-expand-md">

			<!-- Sidebar mobile toggler -->
			<div class="sidebar-mobile-toggler text-center">
				<a href="#" class="sidebar-mobile-secondary-toggle">
					<i class="icon-arrow-left8"></i>
				</a>
				<span class="font-weight-semibold">Secondary sidebar</span>
				<a href="#" class="sidebar-mobile-expand">
					<i class="icon-screen-full"></i>
					<i class="icon-screen-normal"></i>
				</a>
			</div>
			<!-- /sidebar mobile toggler -->


			<!-- Sidebar content -->
			<div class="sidebar-content">

				<!-- Actions -->
				<div class="card">
					<div class="card-header bg-transparent header-elements-inline">
						<span class="text-uppercase font-size-sm font-weight-semibold">Actions</span>
						<div class="header-elements">
							<div class="list-icons">
		                		<a class="list-icons-item" data-action="collapse"></a>
	                		</div>
                		</div>
					</div>

					<div class="card-body" style="">
						<a href="page.de?section=emails&add=yes" class="btn bg-indigo-400 btn-block">Compose mail</a>
					</div>
				</div>
				<!-- /actions -->


				<!-- Sub navigation -->
				<div class="card">
					<div class="card-header bg-transparent header-elements-inline">
						<span class="text-uppercase font-size-sm font-weight-semibold">Navigation</span>
						<div class="header-elements">
							<div class="list-icons">
		                		<a class="list-icons-item" data-action="collapse"></a>
	                		</div>
                		</div>
					</div>

					<div class="card-body p-0" style="">
						<ul class="nav nav-sidebar" data-nav-type="accordion">
							<li class="nav-item-header">Folders</li>
							<li class="nav-item">
								<a href="page.de?section=emails" class="nav-link<?php if($sentpage!='1'){ ?> active<?php } ?>">
									<i class="icon-drawer-in"></i>
									Inbox
									<span class="badge bg-success badge-pill ml-auto" id="newmailgreen">0</span>
								</a>
							</li>
							 
							<li class="nav-item">
								<a href="page.de?section=emails&sent=1" class="nav-link<?php if($sentpage=='1'){ ?> active<?php } ?>"><i class="icon-drawer-out"></i> Sent mail</a>
							</li>
							 
						</ul>
					</div>
				</div>
				<!-- /sub navigation -->
 

			</div>
			<!-- /sidebar content -->

		</div>