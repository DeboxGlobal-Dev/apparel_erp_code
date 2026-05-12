<?php
if($_REQUEST['sent']!='1'){
$sentpage='0';
include('incomingMailSetting.php');
$id=decode($_REQUEST['id']);

if($id!=''){
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to domain:' . imap_last_error());

$emails = imap_search($inbox,'ALL');

if($emails){
$output = '';
rsort($emails);
$totalmail=0;
$n=1;
foreach($emails as $email_number) {

if($email_number==$id){



$subject='';



$message='';



$body='';



$email='';



$date='';







$overview = imap_fetch_overview($inbox,$email_number,0);

$subject = utf8_decode(imap_utf8($subject=$overview[0]->subject));

$message='';



	$message = (imap_fetchbody($inbox,$email_number,2));



	if(count(explode(' ', trim($message))) > 2) {} else {

	 if (strpos($message, 'AAA') !== false) {

	 $message = nl2br(imap_fetchbody($inbox,$email_number,1));

	 } else {

	$message = (imap_fetchbody($inbox,$email_number,2));

	}

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

$structure = imap_fetchstructure($inbox, $email_number);

    $attachments = array();
        if(isset($structure->parts) && count($structure->parts))
        {

            for($i = 0; $i < count($structure->parts); $i++)

            {

                $attachments[$i] = array(

                    'is_attachment' => false,

                    'filename' => '',

                    'name' => '',

                    'attachment' => ''

                );



				if($structure->parts[$i]->ifdparameters)

				{

					foreach($structure->parts[$i]->dparameters as $object)

					{

						if(strtolower($object->attribute) == 'filename')

						{

							$attachments[$i]['is_attachment'] = true;

							$attachments[$i]['filename'] = $object->value;

						}

					}

				}



				if($structure->parts[$i]->ifparameters)

					{

						foreach($structure->parts[$i]->parameters as $object)

							{

                                if(strtolower($object->attribute) == 'name')

									{

									$attachments[$i]['is_attachment'] = true;

									$attachments[$i]['name'] = $object->value;

                            }

					}

				}







                if($attachments[$i]['is_attachment'])



                {



                    $attachments[$i]['attachment'] = imap_fetchbody($inbox, $email_number, $i+1);







                    if($structure->parts[$i]->encoding == 3)



                    {



                        $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);



                    }





                    elseif($structure->parts[$i]->encoding == 4)



                    {



                        $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);



                    }



                }



            }



        }







		$filenameupload='';
        foreach($attachments as $attachment)
        {



            if($attachment['is_attachment'] == 1)



            {



                $filename = $attachment['name'];



                if(empty($filename)) $filename = $attachment['filename'];



                if(empty($filename)) $filename = time() . ".dat";



                $folder = "attachment";



                if(!is_dir($folder))



                {



                     mkdir($folder);



                }



				$filenameupload.=time().$email_number.'-'.$filename.',';



                $fp = fopen("maildocument/".time().$email_number . "-" . $filename, "w+");



				$filenameupload.=time().$email_number."-".$filename.',';



                fwrite($fp, $attachment['attachment']);



                fclose($fp);



            }



        }







$filenameupload=$filenameupload;




     } }}

	 }

	 } else {

	 $sentpage='1';
	 $select1='*';
$where1='id='.decode($_REQUEST['id']).'';
$rs1=GetPageRecord($select1,'mailSectionMaster',$where1);
$editresult=mysqli_fetch_array($rs1);
$date= $editresult['mailDate'];
$subject= $editresult['subject'];
$mailUserName= $editresult['mailUserName'];
$email= $editresult['mailFrom'];
$message= stripslashes($editresult['mailBody']);

	 }
?>
<div class="page-content">

	<?php
include('mailleft.php');
?>





		<div class="content">
		<div class="flex-fill overflow-auto">

							<!-- Single mail -->
							<div class="card">

								<!-- Action toolbar -->
								<div class="bg-light rounded-top">
									<div class="navbar navbar-light bg-light navbar-expand-lg py-lg-2 rounded-top">
										<div class="text-center d-lg-none w-100">
											<button type="button" class="navbar-toggler w-100 h-100" data-toggle="collapse" data-target="#inbox-toolbar-toggle-read">
												<i class="icon-circle-down2"></i>
											</button>
										</div>

										<div class="navbar-collapse text-center text-lg-left flex-wrap collapse" id="inbox-toolbar-toggle-read">
											<div class="mt-3 mt-lg-0 mr-lg-3">
												<?php if($_REQUEST['sent']!='1'){ ?><div class="btn-group">
													<a href="page.de?section=emails&add=yes&replay=1&id=<?php echo $_REQUEST['id']; ?>"><button type="button" class="btn btn-light">
														<i class="icon-reply"></i>
														<span class="d-none d-lg-inline-block ml-2">Reply</span>
													</button>
													</a>
													 <a href="page.de?section=emails&add=yes&forward=1&id=<?php echo $_REQUEST['id']; ?>">
							                    	<button type="button" class="btn btn-light" style="margin-left:5px;">
							                    		<i class="icon-forward"></i>
							                    		<span class="d-none d-lg-inline-block ml-2">Forward</span>
						                    		</button>
							                    	 </a>

												</div><?php }  ?>
											</div>

											<div class="navbar-text ml-lg-auto"><?php echo date('h:i A',strtotime($date)); ?> - <?php if(date('Y-m-d',strtotime($date))==date('Y-m-d')){ ?> Today<?php } else {  echo date('d-m-Y',strtotime($date)); } ?></div>

											<div class="ml-lg-3 mb-3 mb-lg-0">
												<div class="btn-group">
													<button type="button" class="btn btn-light">
														<i class="icon-printer"></i>
														<span class="d-none d-lg-inline-block ml-2" onclick="printInfo()">Print</span>
													</button>

												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /action toolbar -->


								<!-- Mail details -->
								<div class="card-body">
									<div class="media flex-column flex-md-row">
										<a href="#" class="d-none d-md-block mr-md-3 mb-3 mb-md-0">
											<span class="btn bg-teal-400 btn-icon btn-lg rounded-round">
												<span class="letter-icon" style="text-transform:uppercase;"><?php if($mailUserName!=''){ echo stripslashes(substr($mailUserName,'0','1')); } else { echo stripslashes(substr($email,'0','1')); } ?></span>
											</span>
										</a>

										<div class="media-body">
											<h6 class="mb-0"><?php echo stripslashes($subject); ?></h6>
											<div class="letter-icon-title font-weight-semibold"><?php echo stripslashes($mailUserName); ?> <a href="mailto:<?php echo $email; ?>">&lt;<?php if($email!=''){ echo $email; } else {  echo stripslashes($mailUserName); } ?>&gt;</a></div>
										</div>


									</div>
								</div>
								<!-- /mail details -->


								<!-- Mail container -->
								<div class="card-body" id="printarea">
									<div class="overflow-auto mw-100">

									<?php echo str_replace('Content-Type: text/html; charset="UTF-8"','',str_replace('Content-Type: text/plain; charset="UTF-8"','',stripslashes(imap_qprint($message)))); ?>

									</div>
								</div>
								<!-- /mail container -->


								<!-- Attachments -->
								<div class="card-body border-top" id="attachmentdiv">
									<h6 class="mb-0"> Attachments</h6>

									<ul class="list-inline mb-0">

										<?php
										$nn=0;
	$value2='';
	$string='';
	$string = $filenameupload;
$string = preg_replace('/\.$/', '', $string); //Remove dot at end if exists
$array = explode(',', $string); //split string into array seperated by ', '
foreach($array as $value) //loop over values
{
if($value!='' && $value2!=$value){
$value2=$value;
?>

										<li class="list-inline-item">
											<div class="card bg-light py-2 px-3 mt-3 mb-0">
												<div class="media my-1">
													<div class="mr-3 align-self-center"><i class="fa fa-file-text" aria-hidden="true" style="font-size: 32px;"></i></div>
													<div class="media-body">
														<div class="font-weight-semibold"><?php echo $value; ?></div>

														<ul class="list-inline list-inline-condensed mb-0">
															<li class="list-inline-item"><a href="maildocument/<?php echo $value; ?>" target="_blank">Download</a></li>
														</ul>
													</div>
												</div>
											</div>
										</li>

										<?php $nn++; } } ?>

									</ul>
								</div>
								<!-- /attachments -->

							</div>
							<!-- /single mail -->

					</div>
		</div>
		</div>

			<?php if($nn<1){ ?>
										<script>

										$('#attachmentdiv').hide();
										</script>
										 <?php } ?>


<script>
function printInfo() {
var prtContent = document.getElementById("printarea");
var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
WinPrint.document.write(prtContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}
</script>
