<?php
include "inc.php";


?>
<script>
$('#converttoquerybtn').hide();
$('#gotoquerybtn').hide();
</script>

<?php

$select1='*';
$select1='*';
if($LoginUserDetails['profileId']=='47'){
$where1='email="'.$LoginUserDetails['email'].'"';
} else {
$where1='id='.($_REQUEST['mailid']).'';
}

$rs1=GetPageRecord($select1,_EMAIL_SETTING_MASTER_,$where1);
$mainmailid=mysqli_fetch_array($rs1);



if($_REQUEST['status']!='' && $_REQUEST['id']!='' && $_REQUEST['mailtype']!=''){
$namevalue ='mailStatus="'.$_REQUEST['status'].'"';
$where='id="'.$_REQUEST['id'].'" ';
$update = updatelisting(_MAIL_SECTION_MASTER_,$namevalue,$where);

} ?>




 <script>
$('.mailarearight .heading').hide();
$('#newmailcreate').show();
$('#showloadmailloading').hide();

</script>



		 <?php if($_REQUEST['s']==''){ ?>

	 <table class="table table-inbox">
							<tbody data-link="row" class="rowlink">

							<?php
$newmailtoday=0;
$wheremail='';
$where2='';

if($_REQUEST['mailtype']=='8'){
$where2=' and mailStatus=1 ';
}






include('incomingMailSetting.php');

//echo $hostname.'-------'.$username.'+++'.$password;

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
$n=1;
foreach($emails as $email_number) {

if($totalmail<100){




$subject='';
$message='';
$body='';
$email='';
$date='';


$overview = imap_fetch_overview($inbox,$email_number,0);
$subject = $subject=$overview[0]->subject;



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

 if($subject!='Mail delivery failed: returning message to sender' && $subject!='Undelivered Mail Returned to Sender' && $subject!='OTP for Apparel ERP login'  && $subject!='Mail Delivery System'){
 if (strpos($subject, '#00') !== false) { } else {

$select1='*';
 $where1='mailId="'.$email_number.'" and deletestatus=0';
$rs1=GetPageRecord($select1,_QUERY_MASTER_,$where1);
$editresult2=mysqli_fetch_array($rs1);

?>

								<tr <?php if($messagestatus=='unread'){ $newmailtoday=$newmailtoday+1; ?> class="unread"<?php } ?>  onclick="funreadmailsection('<?php echo $email_number; ?>');">
									<td class="table-inbox-star rowlink-skip">&nbsp;</td>
									<td class="table-inbox-image">
										<span class="btn bg-indigo-400 rounded-circle btn-icon btn-sm">
											<span class="letter-icon" style="text-transform:uppercase;"><?php echo substr($mailUserName,0,1); ?></span>
										</span>									</td>
									<td class="table-inbox-name">
										<a href="#">
											<div class="letter-icon-title text-default"><?php echo stripslashes($mailUserName); ?></div>
										</a>									</td>
									<td class="table-inbox-message">
										<span class="table-inbox-subject"><?php echo substr(stripslashes($subject),0,500); ?></span>
										 									</td>
									<td class="table-inbox-attachment"><?php

									$select='maildate';
									$where='maildate="'.$date.'"';
									$rs=GetPageRecord($select,'querymails',$where);
									$count = mysqli_num_rows($rs);

									 if($count=='1'){ ?><span class="badge bg-success-400">Converted</span><?php } ?></td>
									<td class="table-inbox-attachment">&nbsp;</td>
									<td class="table-inbox-time"><?php if(date('Y-m-d',strtotime($date))==date('Y-m-d')){ ?> <?php echo date('h:i A',strtotime($date)); ?> <?php } else {  echo date('j M',strtotime($date)); } ?></td>
								</tr>


<?php  if($messagestatus=='unread'){ $n++;} $totalmail++;  } } }} }  ?>
							</tbody>
						</table>

						<?php } ?>


						 <?php if($_REQUEST['s']=='sent'){
						 if($_REQUEST['mailtype']==5){
$n=1;
$select='';
$where='';
$rs='';
$select='*';
$where=' mailStatus=5  and fromSection="'.$mainmailid['email'].'" order by mailDate desc limit 0,200';
$rs=GetPageRecord($select,_MAIL_SECTION_MASTER_,$where);
while($maillist=mysqli_fetch_array($rs)){

?>
		<div onclick="funreadmailsection('<?php echo $maillist['id']; ?>');" class="list<?php if($maillist['mailStatus']==1){ ?> new<?php } ?>" id="mailiddiv<?php echo $maillist['id']; ?>">
		<div class="dateright"><?php echo date('h:i A',strtotime($maillist['mailDate'])); ?> - <?php if(date('Y-m-d',strtotime($maillist['mailDate']))==date('Y-m-d')){ ?> Today<?php } else {  echo date('d-m-Y',strtotime($maillist['mailDate'])); } ?></div>
		<div class="heading"><?php echo stripslashes($maillist['mailUserName']); ?></div>
		<div class="shorttext"><?php echo substr(stripslashes($maillist['subject']),0,100); ?>...</div>
		</div>
	<?php   } ?>

 <script>
$('.mailarearight .fa').hide();
</script>

	 <?php } ?>
						<?php } ?>

<script>
$('#newmailtoday').text('<?php echo $newmailtoday; ?> Unread Mails');
$('#unreadmailsleft').text('<?php echo $newmailtoday; ?>');

</script>