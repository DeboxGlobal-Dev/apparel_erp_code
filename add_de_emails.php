<?php
include('incomingMailSetting.php');
$id=decode($_REQUEST['id']);
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
?>

<script>

var MailListWrite = function() {


    //
    // Setup module components
    //

    // Summernote
    var _componentSummernote = function() {
        if (!$().summernote) {
            console.warn('Warning - summernote.min.js is not loaded.');
            return;
        }

        // Initialize
        $('.summernote').summernote();
    };

    // Uniform
    var _componentUniform = function() {
        if (!$().uniform) {
            console.warn('Warning - uniform.min.js is not loaded.');
            return;
        }

        // Initialize
        $('.note-image-input').uniform({
            fileButtonClass: 'action btn bg-warning-400'
        });
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _componentSummernote();
            _componentUniform();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    MailListWrite.init();
});

</script>

<div class="page-content">

	<?php
include('mailleft.php');
?>



		<script>
		function copycontenttofield(){
	 	var noteeditable = $('.note-editable').html();
		$('#description').val(noteeditable);
		}
		</script>

		<form action="ac.de" onSubmit="copycontenttofield();" method="post" enctype="multipart/form-data" name="addedit" target="acf" id="addedit" style="width:100%;" > <div class="content">
		<div class="flex-fill overflow-auto">

							<!-- Single mail -->
							<div class="card">

								<!-- Action toolbar -->
								<div class="bg-light rounded-top">
									<div class="navbar navbar-light bg-light navbar-expand-lg py-lg-2 rounded-top">
										<div class="text-center d-lg-none w-100">
											<button type="button" class="navbar-toggler w-100 h-100" data-toggle="collapse" data-target="#inbox-toolbar-toggle-write">
												<i class="icon-circle-down2"></i>
											</button>
										</div>

										<div class="navbar-collapse text-center text-lg-left flex-wrap collapse" id="inbox-toolbar-toggle-write">

											<div class="mt-3 mt-lg-0 mr-lg-3">
												<button type="submit" class="btn bg-blue"><i class="icon-paperplane mr-2"></i> Send mail</button>
											</div>


											<div class="mt-3 mt-lg-0 mr-lg-3">
												<div class="btn-group">

													<a href="page.de?section=emails"><button type="button" class="btn btn-light">
														<i class="icon-cross2"></i>
														<span class="d-none d-lg-inline-block ml-2">Cancel</span>
													</button></a>

												</div>
											</div>



										</div>
									</div>
								</div>
								<!-- /action toolbar -->


								<!-- Mail details -->
							  <div class="table-responsive">
									<table class="table">
										<tbody>
											<tr>
											  <td class="align-top py-0" style="width: 1%"><div class="py-2 mr-sm-3">From:</div></td>
											  <td class="align-top py-0">
											 <style>.select2-selection{margin-top:2px;}</style>
											  <select id="from" name="from" class="form-control select select2-hidden-accessible" displayname="Business Type" autocomplete="off" >
<?php
$select='';
$where='';
$rs='';
$select='*';
$where='1 order by id asc';
$rs=GetPageRecord($select,_EMAIL_SETTING_MASTER_,$where);
while($rest=mysqli_fetch_array($rs)){
?>
<option value="<?php echo $rest['email']; ?>" ><?php echo $rest['from_name']; ?>&lt;<?php echo $rest['email']; ?>&gt;</option>
<?php } ?>
</select></td>
										  </tr>
											<tr>
												<td class="align-top py-0" style="width: 1%">
													<div class="py-2 mr-sm-3">To:</div>												</td>
												<td class="align-top py-0">
													<div class="d-sm-flex flex-sm-wrap">
														<input name="to" type="text" class="form-control flex-fill w-auto py-2 px-0 border-0 rounded-0" id="to" value="<?php  if($_REQUEST['replay']==1){  echo $email; } ?>" placeholder="Add recipients">
													</div>												</td>
											</tr>
											<tr>
												<td class="align-top py-0">
													<div class="py-2 mr-sm-3">Subject:</div>												</td>
												<td class="align-top py-0">
													<input name="subject" type="text" class="form-control py-2 px-0 border-0 rounded-0" id="subject" value="<?php if($_REQUEST['replay']==1){ echo 'Re: '; } ?><?php echo stripslashes($subject); ?>" placeholder="Add subject">												</td>
											</tr>
										</tbody>
									</table><input name="action" type="hidden" id="action" value="createnewmail" />
								</div>
								<!-- /mail details -->


								<!-- Mail container -->
								<div class="card-body p-0">
									<div class="overflow-auto mw-100">
										<div class="summernote summernote-borderless">
 <?php echo str_replace('Content-Type: text/html; charset="UTF-8"','',str_replace('Content-Type: text/plain; charset="UTF-8"','',stripslashes(imap_qprint($message)))); ?>

										</div><textarea name="description" id="description" style="display:none;" ></textarea>
									</div>
								</div>
								<!-- /mail container -->


								<!-- Attachments -->

								<!-- /attachments -->

							</div>
							<!-- /single mail -->

					</div>
		</div></form>
		</div>



