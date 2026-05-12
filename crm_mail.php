<?php



if($_REQUEST['showemail']!=''){

$select1='*';

$where1='id='.($_REQUEST['showemail']).'';

$rs1=GetPageRecord($select1,_EMAIL_SETTING_MASTER_,$where1);

$editresult2=mysqli_fetch_array($rs1);



} else {

$select1='*';

$where1='id=6';

$rs1=GetPageRecord($select1,_EMAIL_SETTING_MASTER_,$where1);

$editresult2=mysqli_fetch_array($rs1);

}

?>


<div class="page-content">

		<!-- Main sidebar -->
		<?php include "left.php"; ?>

 <form method="get" id="showmailform" style="display:none;">

	<select id="showemail" name="showemail" autocomplete="off"   style="padding:10px; font-size:14px; width:100%; box-sizing:border-box;  border: 1px #ccc solid;" onChange="$('#showmailform').submit();"   >

<?php

$select='';

$where='';

$rs='';

$select='*';

if($_SESSION['userid']==37){

$where=' status=1 order by id asc';

} else {

$where=' status=1 and email="'.$LoginUserDetails['email'].'" order by id asc';

}

$rs=GetPageRecord($select,_EMAIL_SETTING_MASTER_,$where);

while($rest=mysqli_fetch_array($rs)){

?>

<option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$_REQUEST['showemail']){ ?>selected="selected"<?php } ?>><?php echo $rest['email']; ?></option>

<?php } ?>

</select><input name="module" id="module" type="hidden" value="incomingquery">

</form>
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
				<!--<div class="card">
					<div class="card-header bg-transparent header-elements-inline">
						<span class="text-uppercase font-size-sm font-weight-semibold">Actions</span>

					</div>

					<div class="card-body" style="">
						<a href="#" class="btn bg-indigo-400 btn-block">Compose mail</a>
					</div>
				</div>-->
				<!-- /actions -->


				<!-- Sub navigation -->
				<div class="card">
					<div class="card-header bg-transparent header-elements-inline">
						<span class="text-uppercase font-size-sm font-weight-semibold">Navigation</span>

					</div>

					<div class="card-body">
					<a class="btn bg-indigo-400 btn-block" onclick="createnewmail();">Compose mail</a>
					</div>



					<div class="card-body p-0">
						<ul class="nav nav-sidebar" data-nav-type="accordion">
							<li class="nav-item-header">Folders</li>
							<li class="nav-item">
								<a href="showpage.crm?module=mail" class="nav-link active">
									<i class="icon-drawer-in"></i>
									Inbox
									<span class="badge bg-success badge-pill ml-auto" id="unreadmailsleft">0</span>
								</a>
							</li>

							<li class="nav-item">
								<a href="showpage.crm?module=sent" class="nav-link">
									<i class="icon-drawer-out"></i>
									Sent

								</a>
							</li>


						</ul>
					</div>
				</div>

			</div>
			<!-- /sidebar content -->

		</div>




		<div class="content-wrapper">

			<!-- Page header -->
			<div class="page-header page-header-light">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4> <span class="font-weight-semibold">Mailbox</span> - List</h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					<div class="header-elements d-none">


						<form action="#">
							<div class="form-group form-group-feedback form-group-feedback-right">
								<input name="searchkeyword" type="search" class="form-control wmin-200" id="searchkeyword" placeholder="Search messages"  onKeyUp="loadmails('1');">
								<div class="form-control-feedback">
									<i class="icon-search4 font-size-base text-muted" style="    top: 12px;"></i>
								</div>
							</div>
						</form>





					</div>


				</div>


			</div>
			<!-- /page header -->


			<!-- Content area -->
			<div class="content">

			<?php if($_REQUEST['status']=='1'){ ?>
			<span class="badge d-block badge-info form-text text-center" style="margin-bottom: 20px; font-size: 12px; padding: 10px;">Mail Sent</span>
			<?php } ?>

	           <div id="loadnewmail"></div>

				<!-- Single line -->
				<div class="card" id="myinbox">
					<div class="card-header bg-transparent header-elements-inline">
						<h6 class="card-title"><?php echo 'My Inbox';?></h6>

						<div class="header-elements">
							<span class="badge bg-blue" id="newmailtoday"></span>
	                	</div>
					</div>


					<!-- Table -->
					<div class="table-responsive" id="shortmail">

					</div>

					<!-- /table -->

				</div>


			</div>


		</div>

</div>

 <style>
 .table td, .table th {
    padding: .75rem 0.5rem;
}
 </style>


<script>
function loadmails(id){

$('#showloadmailloading').show();
var searchkeyword = encodeURIComponent($('#searchkeyword').val());
if(searchkeyword!=''){
searchkeyword=searchkeyword;
} else {
searchkeyword='';
}
$('#shortmail').load('load_short_mail.php?mailid=<?php echo $editresult2['id']; ?>&s=<?php echo $_REQUEST['s']; ?>&mailtype='+id+'&searchkeyword='+searchkeyword);
$('#shortmail').load('load_send_mail.php?mailid=<?php echo $editresult2['id']; ?>&s=<?php echo $_REQUEST['s']; ?>&mailtype='+id+'&searchkeyword='+searchkeyword);
}


function funreadmailsection(id){
$('#showloadmailloading').show();
$('#shortmail').load('load_read_mail.php?mailid=<?php echo $editresult2['id']; ?>&id='+id);
$('.list').removeClass('active');
$('#mailiddiv'+id).addClass('active');
}

function funreadmailsectionsent2(id){
$('#readmailsection').load('load_read_mail.php?mailid=<?php echo $editresult2['id']; ?>&id='+id+'&sent=1');
$('.list').removeClass('active');
$('#mailiddiv'+id).addClass('active');
}

loadmails('1');

</script>

<?php if($_REQUEST['new']=='1'){ ?>
<script>
changetb('8');
loadmails('8');
</script>


<?php } ?>

<script>
function createnewmail(){
 $('#loadnewmail').load('loadcomposemail.php');
 $('#myinbox').hide();
}
</script>