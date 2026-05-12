

	<!-- Page content -->
	<div class="page-content">




		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<div class="page-header">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><span class="font-weight-semibold">Chat Widget</span> - Dashboard</h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>


				</div>
			</div>
			<!-- /page header -->


			<!-- Content area -->
			<div class="content pt-0">


<div class="row"><div class="col-lg-4">

								<!-- Current server load -->
								<div class="card bg-pink-400">
									<div class="card-body">
										<div class="d-flex">
											<h3 class="font-weight-semibold mb-0" id="liveusers">0</h3>

					                	</div>

					                	<div>
											Live Visitors
											  <div class="font-size-sm opacity-75">&nbsp;</div>
										</div>
									</div>

									<div id="server-load" style="opacity:0;"></div>
								</div>
								<!-- /current server load -->

							</div>
							<div class="col-lg-8">

								<!-- Members online -->

									<div class="card" style="padding:12px;    height: 163px;">
								<div style="padding:20px;"><table width="100%" border="0" cellpadding="8" cellspacing="0" style="    border: 5px #f3eeee solid;">
  <tr>
    <td width="25%" align="center" bgcolor="#e3ffe6" style="    font-size: 35px; line-height: 35px;    padding-top: 12px;">



				<?php
				$n=0;
				$listofurls='';
				$selectl='';
				$wherel='';
				$rsl='';
				$selectl='id';
				$wherel=' 1 and  DATE(updatedDateTime)="'.date('Y-m-d').'" order by id desc';
				$rsl=GetPageRecord($selectl,'liveVisitorMaster',$wherel);
				while($resListingl=mysqli_fetch_array($rsl)){
				$n;
				$n++; }
				echo $n;
				?></td>
    <td width="25%" align="center" bgcolor="#fff6e3"><span style="font-size: 35px; line-height: 35px;    padding-top: 12px;"><?php
				$n=0;
				$listofurls='';
				$selectl='';
				$wherel='';
				$rsl='';
				$selectl='id';
				$wherel=' 1 and  DATE(updatedDateTime)="'.date('Y-m-d',strtotime("-1 days")).'" order by id desc';
				$rsl=GetPageRecord($selectl,'liveVisitorMaster',$wherel);
				while($resListingl=mysqli_fetch_array($rsl)){
				$n;
				$n++; }
				echo $n;
				?></span></td>
    <td width="25%" align="center" bgcolor="#e3f4ff"><span style="font-size: 35px; line-height: 35px;    padding-top: 12px;"><?php
				$n=0;
				$listofurls='';
				$selectl='';
				$wherel='';
				$rsl='';
				$selectl='id';
				$wherel=' 1 and  DATE(updatedDateTime) between "'.date("Y-m-d", strtotime('monday this week')).'" and "'.date("Y-m-d", strtotime('sunday this week')).'" order by id desc';
				$rsl=GetPageRecord($selectl,'liveVisitorMaster',$wherel);
				while($resListingl=mysqli_fetch_array($rsl)){
				$n;
				$n++; }
				echo $n;
				?></span></td>
    <td width="25%" align="center" bgcolor="#ffe3fc"><span style="font-size: 35px; line-height: 35px;    padding-top: 12px;"><?php
				$n=0;
				$listofurls='';
				$selectl='';
				$wherel='';
				$rsl='';
				$selectl='id';
				$wherel=' 1 and  DATE(updatedDateTime) between "'.date("Y-m-").'-1" and "'.date("Y-m-t").'" order by id desc';
				$rsl=GetPageRecord($selectl,'liveVisitorMaster',$wherel);
				while($resListingl=mysqli_fetch_array($rsl)){
				$n;
				$n++; }
				echo $n;
				?></span></td>
  </tr>
  <tr>
    <td width="25%" align="center" bgcolor="#e3ffe6" style="    padding-bottom: 12px;">Today's Visits </td>
    <td width="25%" align="center" bgcolor="#fff6e3" style="    padding-bottom: 12px;">Yesterday Visits </td>
    <td width="25%" align="center" bgcolor="#e3f4ff" style="    padding-bottom: 12px;">This Week Visits </td>
    <td width="25%" align="center" bgcolor="#ffe3fc" style="    padding-bottom: 12px;">This Month Visits </td>
  </tr>
</table></div>


				  </div>

								<!-- /members online -->

							</div>




						</div>

				<!-- Dashboard content -->
				<div class="row">
					<div class="col-xl-8">


						<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title">
									<i class="fa fa-user" aria-hidden="true"></i>
									&nbsp;&nbsp;Live Visitors
								</h6>
							</div>

							<div class="table-responsive" id="activeurls">
								<table class="table text-nowrap">
									<thead>
										<tr>
											<th>User</th>
											<th>Location</th>
											<th>URL</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>

								<div style="padding:30px; text-align:center; color:#666666; display:none;" id="nolivevisitor">Currently No Live Visitor</div>
							</div>
						</div>




					</div>

					<div class="col-xl-4">

						<!-- Progress counters -->
						<div class="card">
								<div class="card-header bg-transparent header-elements-inline">
									<span class="card-title font-weight-semibold">
			Today's Chats
			</span>
									<div class="header-elements">
										<span class="badge bg-success badge-pill" id="totalusers">0</span>
			                		</div>
				  </div>

								<ul class="media-list media-list-linked my-2" id="loadallonlineuser">
<div style="padding:20px; text-align:center;">Loading Chats</div>


								</ul>
		  </div>


					</div>
				</div>
				<!-- /dashboard content -->

			</div>
			<!-- /content area -->


			<!-- Footer -->

			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

<div style="display:none;" id="actiondiv"></div>
<script>
setInterval(function() {
$('#actiondiv').load('loadaction.php?action=showlivevisitor');
}, 2000);
</script>

<script>
setInterval(function() {
$('#loadallonlineuser').load('loadaction.php?action=showallliveusertoday');
}, 3000);
</script>

 <style>
 .media-list-linked a.media {
    border-bottom: 1px solid #ededed; padding:7px 14px !important;
}

.newmsg{background-color: #ffa2003d !important;}
 </style>



