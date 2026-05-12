<?php
if($_REQUEST['sent']!='1'){
include('incomingMailSetting.php');
?>
<div class="page-content">

	<?php
include('mailleft.php');
?>






		<div class="content-wrapper">


			<!-- Content area -->
			<div class="content">

				<!-- Single line -->
				<div class="card">
					<div class="card-header bg-transparent header-elements-inline">
						<h6 class="card-title"><i class="icon-drawer-in"></i> &nbsp;Inbox</h6>

						<div class="btn-group ml-3">
						<div class="header-elements d-none" style="margin-right:10px;">
						<form action="page.de?section=emails" method="get" name="section" id="section">
							<div class="form-group form-group-feedback form-group-feedback-right">
								<input name="searchkeyword" type="search" class="form-control wmin-200" id="searchkeyword" placeholder="Search messages" value="<?php echo $_REQUEST['searchkeyword']; ?>">
								<input name="section" type="hidden" value="emails" /><div class="form-control-feedback">
									<i class="icon-search4 font-size-base text-muted" style="margin-top: 12px;"></i>
								</div>
							</div>
						</form>
					</div>



					  </div>
					</div>

				 <style>
				 .maillisttext{
    width: 30px;
    height: 30PX;
    background-color: #ef5350;
    color: #FFFFFF;
    text-align: CENTER;
    border-radius: 40px;
    padding-top: 5px;
    font-weight: 400;
}
				 </style>


					<!-- Table -->
					<div class="table-responsive">
						<table class="table table-inbox">
							<tbody data-link="row" class="rowlink">

<?php

$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to domain:' . imap_last_error());

$searchkeyword = trim($_REQUEST['searchkeyword']);

if($searchkeyword!=''){
$keyword='BODY "'.$searchkeyword.'"';

if (strpos($searchkeyword, '@') !== false) {

 $keyword='FROM "'.$searchkeyword.'"';
}

} else {
$keyword='ALL';
}


$emails = imap_search($inbox,''.$keyword.'');
if($emails){
$output = '';

rsort($emails);
$totalmail=0;
$n=0;
foreach($emails as $email_number) {

if($totalmail<100){




$subject='';
$message='';
$body='';
$email='';
$date='';


$overview = imap_fetch_overview($inbox,$email_number,0);
$subject = utf8_decode(imap_utf8($subject=$overview[0]->subject));



$messagestatus =  $overview[0]->seen ? 'read' : 'unread';

$mailUserName = addslashes(strip_tags($overview[0]->from));
$email=$from=$overview[0]->from;

$ccemail=$from=$overview[0]->cc;
preg_match_all('/[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}/i', $email, $found_mails);
$email= str_replace('["','',json_encode($found_mails[0]));
$email=  str_replace('"]','',$email);
$structure = imap_fetchstructure($inbox, $email_number);

$timestamp = strtotime($date=$overview[0]->date);
date_default_timezone_set('asia/kolkata');
$date = date('Y-m-d H:i:s',$timestamp);
?>
								<tr class="<?php if($messagestatus=='unread'){ ?> unread<?php } ?>">

									<td class="table-inbox-image">

										<div class="maillisttext"><?php echo stripslashes(substr($mailUserName,'0','1')); ?></div>				</td>
									<td class="table-inbox-name">
										<a href="page.de?section=emails&view=yes&id=<?php echo encode($email_number); ?>">
											<div class="letter-icon-title text-default">&nbsp;&nbsp;&nbsp;<?php echo stripslashes($mailUserName); ?></div>
										</a>									</td>
									<td class="table-inbox-message">
										<a href="page.de?section=emails&view=yes&id=<?php echo encode($email_number); ?>" style="color:#333"><span class="table-inbox-subject"><?php if(date('Y-m-d',strtotime($date))==date('Y-m-d')){ ?><span class="badge bg-success mr-2">Today</span><?php }  ?> <?php echo substr(stripslashes($subject),0,500); ?></span></a>						  </td>

									<td class="table-inbox-time">
										 <a href="page.de?section=emails&view=yes&id=<?php echo encode($email_number); ?>"style="color:#333"><?php if(date('Y-m-d',strtotime($date))==date('Y-m-d')){ echo date('H:i a',strtotime($date)); } else {  echo date('j M',strtotime($date)); } ?></a>									</td>
								</tr>

								<?php  if($messagestatus=='unread'){ $n++;} $totalmail++;  } } }   ?>
	<script>
	$('#newmailgreen').text('<?php echo $n; ?>');
	</script>

							</tbody>
						</table>
					</div>
					<!-- /table -->

				</div>
				<!-- /single line -->


				<!-- Multiple lines -->

				<!-- /multiple lines -->

			</div>
			<!-- /content area -->


		</div>

		</div>

		<?php } else { $sentpage='1'; ?>

		<div class="page-content">

	<?php
include('mailleft.php');
?>






		<div class="content-wrapper">


			<!-- Content area -->
			<div class="content">

				<!-- Single line -->
				<div class="card">
					<div class="card-header bg-transparent header-elements-inline">
						<h6 class="card-title"><i class="icon-drawer-out"></i> &nbsp;Sent Mail</h6>

						<div class="btn-group ml-3">
						<div class="header-elements d-none" style="margin-right:10px;">
						<form action="page.de?section=emails" method="get" name="section" id="section">
							<div class="form-group form-group-feedback form-group-feedback-right">
								<input name="searchkeyword" type="search" class="form-control wmin-200" id="searchkeyword" placeholder="Search messages" value="<?php echo $_REQUEST['searchkeyword']; ?>">
								<input name="section" type="hidden" value="emails" /><input name="sent" type="hidden" value="1" /><div class="form-control-feedback">
									<i class="icon-search4 font-size-base text-muted" style="margin-top: 12px;"></i>
								</div>
							</div>
						</form>
					</div>



					  </div>
					</div>

				 <style>
				 .maillisttext{
    width: 30px;
    height: 30PX;
    background-color: #ef5350;
    color: #FFFFFF;
    text-align: CENTER;
    border-radius: 40px;
    padding-top: 5px;
    font-weight: 400;
}
				 </style>


					<!-- Table -->
					<div class="table-responsive">
						<table class="table table-inbox">
							<tbody data-link="row" class="rowlink">

<?php
$select='';
$where='';
$rs='';
$select='*';
$wheremain='';
if($_REQUEST['searchkeyword']!=''){
$wheremain=' and (subject like "%'.$_REQUEST['searchkeyword'].'%" or fromMail like "%'.$_REQUEST['searchkeyword'].'%" or mailFrom like "%'.$_REQUEST['searchkeyword'].'%")';
}
 $where='1 '.$wheremain.' order by id desc';
$rs=GetPageRecord($select,'mailSectionMaster',$where);
while($rest=mysqli_fetch_array($rs)){
$date= $rest['mailDate'];
?>
								<tr>

									<td class="table-inbox-image">

										<div class="maillisttext" style="text-transform:uppercase;"><?php echo stripslashes(substr($rest['mailFrom'],'0','1')); ?></div>				</td>
									<td class="table-inbox-name">
										<a href="page.de?section=emails&view=yes&id=<?php echo encode($rest['id']); ?>&sent=1">
											<div class="letter-icon-title text-default" style="white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;">&nbsp;&nbsp;&nbsp;<?php echo stripslashes($rest['mailFrom']); ?></div>
										</a>									</td>
									<td class="table-inbox-message">
										<a href="page.de?section=emails&view=yes&id=<?php echo encode($rest['id']); ?>&sent=1" style="color:#333"><span class="table-inbox-subject"><?php if(date('Y-m-d',strtotime($date))==date('Y-m-d')){ ?><span class="badge bg-success mr-2">Today</span><?php }  ?> <?php echo substr(stripslashes($rest['subject']),0,500); ?></span></a>						  </td>

									<td class="table-inbox-time">
										 <a href="page.de?section=emails&view=yes&id=<?php echo encode($rest['id']); ?>&sent=1"style="color:#333"><?php if(date('Y-m-d',strtotime($date))==date('Y-m-d')){ echo date('H:i a',strtotime($date)); } else {  echo date('j M',strtotime($date)); } ?></a>									</td>
								</tr>

								<?php   }   ?>


							</tbody>
						</table>
					</div>
					<!-- /table -->

				</div>
				<!-- /single line -->


				<!-- Multiple lines -->

				<!-- /multiple lines -->

			</div>
			<!-- /content area -->


		</div>

		</div>

		<?php } ?>