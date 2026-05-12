<?php
include "inc.php";

if($_REQUEST['id']!='' && $_REQUEST['id']!='na'){
include('incomingMailSetting.php');
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to domain:' . imap_last_error());
$emails = imap_search($inbox,'ALL');
if($emails){
$output = '';
rsort($emails);
$totalmail=0;
$n=1;
foreach($emails as $email_number) {
if($email_number==$_REQUEST['id']){
$subject='';
$message='';
$body='';
$email='';
$date='';

$overview = imap_fetch_overview($inbox,$email_number,0);
$subject = $subject=$overview[0]->subject;
$message='';
	$message = (imap_fetchbody($inbox,$email_number,'2'));
	if (count(explode(' ', trim($message))) > 2) {} else {
	$message = nl2br(imap_fetchbody($inbox,$email_number,1.1));
	$g='1';

	}



	if(trim($message)=='' && $g!='1'){

	$message = nl2br(imap_fetchbody($inbox,$email_number,'1'));
	}





   $mailUserName = addslashes(strip_tags($overview[0]->from));
$email=$mailUserName=$overview[0]->from;
$ccemail=$from=$overview[0]->cc;



preg_match_all('/[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}/i', $email, $found_mails);
$email= str_replace('["','',json_encode($found_mails[0]));
$email=  str_replace('"]','',$email);

$timestamp = strtotime($date=$overview[0]->date);
date_default_timezone_set('asia/kolkata');
$date = date('Y-m-d H:i:s',$timestamp);










    /* get information specific to this email */
    $overview = imap_fetch_overview($inbox,$email_number,0);
    $structure = imap_fetchstructure($inbox,$email_number);




     $attachments = array();
       if(isset($structure->parts) && count($structure->parts)) {
         for($i = 0; $i < count($structure->parts); $i++) {
           $attachments[$i] = array(
              'is_attachment' => false,
              'filename' => '',
              'name' => '',
              'attachment' => '');

           if($structure->parts[$i]->ifdparameters) {
             foreach($structure->parts[$i]->dparameters as $object) {
               if(strtolower($object->attribute) == 'filename') {
                 $attachments[$i]['is_attachment'] = true;
                 $attachments[$i]['filename'] = $object->value;
               }
             }
           }

           if($structure->parts[$i]->ifparameters) {
             foreach($structure->parts[$i]->parameters as $object) {
               if(strtolower($object->attribute) == 'name') {
                 $attachments[$i]['is_attachment'] = true;
                 $attachments[$i]['name'] = $object->value;
               }
             }
           }

           if($attachments[$i]['is_attachment']) {
             $attachments[$i]['attachment'] = imap_fetchbody($inbox, $email_number, $i+1);
             if($structure->parts[$i]->encoding == 3) { // 3 = BASE64
               $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
             }
             elseif($structure->parts[$i]->encoding == 4) { // 4 = QUOTED-PRINTABLE
               $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
             }
           }
         } // for($i = 0; $i < count($structure->parts); $i++)
       } // if(isset($structure->parts) && count($structure->parts))

	$filenames='';
    if(count($attachments)!=0){
        foreach($attachments as $at){
            if($at['is_attachment']==1){

			 $filenames.=trim($at['filename']).',';

                file_put_contents('attachment/'.date('d-m-Y-H:i:s',$timestamp).'-'.$at['filename'], $at['attachment']);
            }
        }
    }






     } }}


	 }


?>

<div class="card-body navbar-light">
									<div class="media flex-column flex-md-row">
										<a href="#" class="d-none d-md-block mr-md-3 mb-3 mb-md-0">
											<span class="btn bg-teal-400 btn-icon btn-lg rounded-round">
												<span class="letter-icon"><?php echo substr($mailUserName,0,1); ?></span>
											</span>
										</a>

										<div class="media-body">
											<h6 class="mb-0"><?php echo stripslashes($mailUserName); ?></h6>
											<div class="letter-icon-title font-weight-semibold"><?php if($email!=''){ echo 'From: '.$email; } else {  echo stripslashes($mailUserName); } ?> </div>
										</div>

										<div class="align-self-md-center ml-md-3 mt-3 mt-md-0">
											<ul class="list-inline list-inline-condensed mb-0">



												<li class="list-inline-item">
													<span class="btn btn-sm bg-transparent border-slate-300 text-slate rounded-round border-dashed" onclick="loadmails('1');">Back to all mails</span>
												</li>

												<?php
												$select='maildate,queryid';
												$where='maildate="'.$date.'"';
												$rs=GetPageRecord($select,'querymails',$where);
												$resListing=mysqli_fetch_array($rs);
												$count = mysqli_num_rows($rs);

												if($count=='0'){  ?>
												<li class="list-inline-item">
												<a href="showpage.crm?module=style&add=yes&mailid=<?php echo encode($_REQUEST['id']); ?>"><span class="btn btn-sm bg-transparent border-slate-300 text-slate rounded-round border-dashed" onclick="loadmails('1');" style="    background-color: #5ca50c !important;
    color: #fff; border: 1px solid #4f8812;">Convert to Style</span></a>
												</li>

												<?php }else{ ?>
												<li class="list-inline-item">
												<a href="showpage.crm?module=style&view=yes&id=<?php echo encode($resListing['queryid']); ?>"><span class="btn btn-sm bg-transparent border-slate-300 text-slate rounded-round border-dashed" onclick="loadmails('1');" style="    background-color: #ec2626c2 !important;
    color: #fff; border: 1px solid #ff422f;">Converted</span></a>
												</li>
												<?php } ?>
											</ul>
										</div>
									</div>
								</div>



<div class="card-body">
<?php echo stripslashes(imap_qprint($message)); ?>

</div>
<?php if($filenames!=''){ ?>
<div class="card-body border-top">
<h6 class="mb-0">Attachment</h6>

<ul class="list-inline mb-0">
<?php
if($filenames!=''){
$string = rtrim($filenames,',');
$string = preg_replace('/\.$/', '', $string);
$array = explode(',', $string);
foreach($array as $value)
{ ?>
<li class="list-inline-item">
<div class="card bg-light py-2 px-3 mt-3 mb-0">
<div class="media my-1">
<div class="mr-3 align-self-center"><i class="fa fa-file-text" aria-hidden="true" style="font-size:30px;"></i></div>
<div class="media-body">
<div class="font-weight-semibold" style="max-width:200px;"><?php echo $value; ?></div>

<ul class="list-inline list-inline-condensed mb-0">
<li class="list-inline-item"><a href="<?php echo $fullurl; ?>attachment/<?php echo date('d-m-Y-H:i:s',$timestamp) ; ?>-<?php echo $value; ?>" target="_blank">Download</a></li>
<li class="list-inline-item" style="float:right;color:#2196f3"><a style="cursor:pointer;" onclick="opmodalpop('Purchase order attach to style','modalpop.php?action=attachtopurchaseorder&purchaseorderid=<?php echo date('d-m-Y-H:i:s',$timestamp) ; ?>-<?php echo $value; ?>','350px','auto');" data-toggle="modal" data-target="#modalpop">Attach PO</a></li>
</ul>
</div>
</div>
</div>
</li>

<?php } } ?>

</ul>
</div>
<?php } ?>