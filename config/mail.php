<?php
require_once('PHPMailer/class.phpmailer.php');
include("PHPMailer/class.smtp.php");



function send_template_mail($fromemail,$to,$subject,$description)
{

 $select='*';
$where='id="'.$_SESSION['userid'].'" and email="'.$_SESSION['username'].'"';
$rs=GetPageRecord($select,_USER_MASTER_,$where);
$LoginUserDetails=mysqli_fetch_array($rs);

$select='*';

$where='email="'.$LoginUserDetails['email'].'"';


$rs=GetPageRecord($select,_EMAIL_SETTING_MASTER_,$where);
$emailsetting=mysqli_fetch_array($rs);


$from_name=clean($emailsetting['from_name']);
$email=clean($emailsetting['email']);
$password=clean($emailsetting['password']);
$smtp_server=clean($emailsetting['smtp_server']);
$port=clean($emailsetting['port']);
$security_type=clean($emailsetting['security_type']);


        $mail = new PHPMailer();

		$mail->IsSMTP();

		$mail->SMTPAuth = true;

		$mail->SMTPSecure = "tls";

		$mail->Host = $smtp_server;

		$mail->Port = $port;

		$mail->Username = $email;

		$mail->Password = $password;

		$mail->From = $email;

		$mail->FromName = $from_name;

		$mail->Subject = $subject;

		$mail->AltBody = "";

		$mail->MsgHTML($description);

		$mail->AddAddress($to, "");

		$mail->IsHTML(true);

		$mail->SMTPOptions = array(
		'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
		)
		);
		$mail->Send();

		?>


		<?php
}




function send_template_mail_query($fromemail,$to,$subject,$description,$ccmail)
{
 $select='*';
$where='id="'.$_SESSION['userid'].'" and email="'.$_SESSION['username'].'"';
$rs=GetPageRecord($select,_USER_MASTER_,$where);
$LoginUserDetails=mysqli_fetch_array($rs);

$select='*';
if($LoginUserDetails['profileId']=='47' || $LoginUserDetails['profileId']=='48'){
$where='email="'.$LoginUserDetails['email'].'"';
} else {
$where='id=6';
}
$rs=GetPageRecord($select,_EMAIL_SETTING_MASTER_,$where);
$result=mysqli_fetch_array($rs);



        $mail = new PHPMailer();

		$mail->IsSMTP();

		$mail->SMTPAuth = $result['security_type'];

		$mail->SMTPSecure = $result['smtp_server'];

		$mail->Host = $result['smtp_server'];

		$mail->Port = $result['port'];

		$mail->Username = $result['email'];

		$mail->Password = $result['password'];

		$mail->From = $result['email'];

		$mail->FromName = $result['from_name'];

		$mail->Subject = $subject;

		$mail->AltBody = "";

		$mail->MsgHTML($description);

		 $mail->AddAddress(trim($to), "");

		$ccmail = explode(',', $ccmail);
		foreach ($ccmail as $ccaddress) {
   $mail->AddCC(trim($ccaddress));
}

		$mail->IsHTML(true);

		$mail->SMTPOptions = array(
		'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
		)
		);
		$mail->Send();



}


 function send_template_mail_query_with_attachment($fromemail,$to,$subject,$description,$ccmail,$attfilename,$filename)
{
 $select='*';
$where='id="'.$_SESSION['userid'].'" and email="'.$_SESSION['username'].'"';
$rs=GetPageRecord($select,_USER_MASTER_,$where);
$LoginUserDetails=mysqli_fetch_array($rs);

$select='*';
if($LoginUserDetails['profileId']=='47'){
$where='email="'.$LoginUserDetails['email'].'"';
} else {
$where='id=6';
}
$rs=GetPageRecord($select,_EMAIL_SETTING_MASTER_,$where);
$result=mysqli_fetch_array($rs);



        $mail = new PHPMailer();

		$mail->IsSMTP();

		$mail->SMTPAuth = $result['security_type'];

		$mail->SMTPSecure = $result['smtp_server'];

		$mail->Host = $result['smtp_server'];

		$mail->Port = $result['port'];

		$mail->Username = $result['email'];

		$mail->Password = $result['password'];

		$mail->From = $result['email'];

		$mail->FromName = $result['from_name'];

		$mail->Subject = $subject;

		$mail->AltBody = "";

		$mail->MsgHTML($description);

		 $mail->AddAddress(trim($to), "");

		 $mail->AddAttachment($attfilename, $filename);

		$ccmail = explode(',', $ccmail);
		foreach ($ccmail as $ccaddress) {
   $mail->AddCC(trim($ccaddress));
}

		$mail->IsHTML(true);

		$mail->SMTPOptions = array(
		'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
		)
		);
		$mail->Send();



}






 function send_package_mail_query_with_attachment($fromemail,$to,$subject,$description,$ccmail,$attfilename)
{
 $select='*';
$where='id="'.$_SESSION['userid'].'" and email="'.$_SESSION['username'].'"';
$rs=GetPageRecord($select,_USER_MASTER_,$where);
$LoginUserDetails=mysqli_fetch_array($rs);

$select='*';
if($LoginUserDetails['profileId']=='47'){
$where='email="'.$LoginUserDetails['email'].'"';
} else {
$where='id=6';
}
$rs=GetPageRecord($select,_EMAIL_SETTING_MASTER_,$where);
$result=mysqli_fetch_array($rs);



        $mail = new PHPMailer();

		$mail->IsSMTP();

		$mail->SMTPAuth = $result['security_type'];

		$mail->SMTPSecure = $result['smtp_server'];

		$mail->Host = $result['smtp_server'];

		$mail->Port = $result['port'];

		$mail->Username = $result['email'];

		$mail->Password = $result['password'];

		$mail->From = $result['email'];

		$mail->FromName = $result['from_name'];

		$mail->Subject = $subject;

		$mail->AltBody = "";

		$mail->MsgHTML($description);

		 $mail->AddAddress(trim($to), "");

		 $mail->AddAttachment('/home/'.$db_user.'/public_html/tcpdf/examples/package/'.$attfilename.'', $attfilename);

		$ccmail = explode(',', $ccmail);
		foreach ($ccmail as $ccaddress) {
   $mail->AddCC(trim($ccaddress));
}

		$mail->IsHTML(true);

		$mail->SMTPOptions = array(
		'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
		)
		);
		$mail->Send();



}


 function send_package_mail_query_with_attachmentb2c($fromemail,$to,$subject,$description,$ccmail,$attfilename)
{


$select='*';
 $select='*';
$where='id="'.$_SESSION['userid'].'" and email="'.$_SESSION['username'].'"';
$rs=GetPageRecord($select,_USER_MASTER_,$where);
$LoginUserDetails=mysqli_fetch_array($rs);

$select='*';
if($LoginUserDetails['profileId']=='47'){
$where='email="'.$LoginUserDetails['email'].'"';
} else {
$where='id=6';
}
$rs=GetPageRecord($select,_EMAIL_SETTING_MASTER_,$where);
$result=mysqli_fetch_array($rs);



        $mail = new PHPMailer();

		$mail->IsSMTP();

		$mail->SMTPAuth = $result['security_type'];

		$mail->SMTPSecure = $result['smtp_server'];

		$mail->Host = $result['smtp_server'];

		$mail->Port = $result['port'];

		$mail->Username = $result['email'];

		$mail->Password = $result['password'];

		$mail->From = $result['email'];

		$mail->FromName = $result['from_name'];

		$mail->Subject = $subject;

		$mail->AltBody = "";

		$mail->MsgHTML($description);

		 $mail->AddAddress(trim($to), "");
		 $mail->AddAttachment('packages/'.$attfilename.'', $attfilename);





		$ccmail = explode(',', $ccmail);
		foreach ($ccmail as $ccaddress) {
   $mail->AddCC(trim($ccaddress));
}

		$mail->IsHTML(true);

		$mail->SMTPOptions = array(
		'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
		)
		);
		$mail->Send();



}




 function send_attachment_mail($fromemail,$to,$subject,$description,$ccmail,$attfilename)
{
  $select='*';
if($fromemail==''){

$where='id="'.$_SESSION['userid'].'" and email="'.$_SESSION['username'].'"';
$rs=GetPageRecord($select,_USER_MASTER_,$where);
$LoginUserDetails=mysqli_fetch_array($rs);

if($LoginUserDetails['profileId']=='47'){
$where='email="'.$LoginUserDetails['email'].'"';
} else {
$where='id=6';
}
} else {
$where='email="'.$fromemail.'"';
}
$rs=GetPageRecord($select,_EMAIL_SETTING_MASTER_,$where);
$result=mysqli_fetch_array($rs);






        $mail = new PHPMailer();

		$mail->IsSMTP();

		$mail->SMTPAuth = $result['security_type'];

		$mail->SMTPSecure = $result['smtp_server'];

		$mail->Host = $result['smtp_server'];

		$mail->Port = $result['port'];

		$mail->Username = $result['email'];

		$mail->Password = $result['password'];

		$mail->From = $result['email'];

		$mail->FromName = $result['from_name'];

		$mail->Subject = $subject;

		$mail->AltBody = "";

		$mail->MsgHTML($description);

		 $mail->AddAddress(trim($to), "");

		 $mail->AddAttachment('/home/'.$db_user.'/public_html/demo2/upload/'.$attfilename.'', $attfilename);

		$ccmail = explode(',', $ccmail);
		foreach ($ccmail as $ccaddress) {
   $mail->AddCC(trim($ccaddress));
}

		$mail->IsHTML(true);

		$mail->SMTPOptions = array(
		'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
		)
		);
		$mail->Send();



}








//-------------------Mailchimp Integration-------------------------







function rudr_mailchimp_subscriber_status( $email, $status, $list_id, $api_key, $merge_fields, $tags){
	$data = array(
		'apikey'        => 'f766b68a4ff1b82b215fc3586a871c47-us17',
    	'email_address' => $email,
		'status'        => $status,
		'merge_fields'  => $merge_fields
	);
	$mch_api = curl_init(); // initialize cURL connection

	curl_setopt($mch_api, CURLOPT_URL, 'https://' . substr($api_key,strpos($api_key,'-')+1) . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/' . md5(strtolower($data['email_address'])));
	curl_setopt($mch_api, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic '.base64_encode( 'user:'.$api_key )));
	curl_setopt($mch_api, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
	curl_setopt($mch_api, CURLOPT_RETURNTRANSFER, true); // return the API response
	curl_setopt($mch_api, CURLOPT_CUSTOMREQUEST, 'PUT'); // method PUT
	curl_setopt($mch_api, CURLOPT_TIMEOUT, 10);
	curl_setopt($mch_api, CURLOPT_POST, true);
	curl_setopt($mch_api, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($mch_api, CURLOPT_POSTFIELDS, json_encode($data) ); // send data in json

	$result = curl_exec($mch_api);
	return $result;
}



function send_bulk_mail($fromemail,$to,$subject,$description)
{

$select='email';
$where='from_name="Bulk Email"';
$rs=GetPageRecord($select,_EMAIL_SETTING_MASTER_,$where);
$emailsetting=mysqli_fetch_array($rs);


$from_name=clean($emailsetting['from_name']);
$email=clean($emailsetting['email']);
$password=clean($emailsetting['password']);
$smtp_server=clean($emailsetting['smtp_server']);
$port=clean($emailsetting['port']);
$security_type=clean($emailsetting['security_type']);


        $mail = new PHPMailer();

		$mail->IsSMTP();

		$mail->SMTPAuth = true;

		$mail->SMTPSecure = "tls";

		$mail->Host = $smtp_server;

		$mail->Port = $port;

		$mail->Username = $email;

		$mail->Password = $password;

		$mail->From = $email;

		$mail->FromName = $from_name;

		$mail->Subject = $subject;

		$mail->AltBody = "";

		$mail->MsgHTML($description);

		$mail->AddAddress($to, "");

		$mail->IsHTML(true);

		$mail->SMTPOptions = array(
		'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
		)
		);
		$mail->Send();


}





function send_template_mail_OTP($fromemail,$to,$subject,$description,$ccmail)
{
		$select='*';
		$where='id=6';
		$rs=GetPageRecord($select,_EMAIL_SETTING_MASTER_,$where);
		$result=mysqli_fetch_array($rs);

		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = $result['security_type'];
		$mail->SMTPSecure = $result['smtp_server'];
		$mail->Host = $result['smtp_server'];
		$mail->Port = $result['port'];
		$mail->Username = $result['email'];
		$mail->Password = $result['password'];
		$mail->From = $result['email'];
		$mail->FromName = $result['from_name'];
		$mail->Subject = $subject;
		$mail->AltBody = "";
		$mail->MsgHTML($description);
		$mail->AddAddress(trim($to), "");
		$ccmail = explode(',', $ccmail);
		foreach ($ccmail as $ccaddress) {
		$mail->AddCC(trim($ccaddress));
		}
		$mail->addBcc("deboxglobal@gmail.com");
		$mail->IsHTML(true);
		$mail->SMTPOptions = array(
		'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
		)
		);
		$mail->Send();
		return 'true';
}


function send_template_mail_query_by_web($fromemail,$to,$subject,$description)
{

 $select='*';
$where='id=6';
$rs=GetPageRecord($select,_EMAIL_SETTING_MASTER_,$where);
$emailsetting=mysqli_fetch_array($rs);


$from_name=clean($emailsetting['from_name']);
$email=clean($emailsetting['email']);
$password=clean($emailsetting['password']);
$smtp_server=clean($emailsetting['smtp_server']);
$port=clean($emailsetting['port']);
$security_type=clean($emailsetting['security_type']);


        $mail = new PHPMailer();

		$mail->IsSMTP();

		$mail->SMTPAuth = true;

		$mail->SMTPSecure = "tls";

		$mail->Host = $smtp_server;

		$mail->Port = $port;

		$mail->Username = $email;

		$mail->Password = $password;

		$mail->From = $email;

		$mail->FromName = $from_name;

		$mail->Subject = $subject;

		$mail->AltBody = "";

		$mail->MsgHTML($description);

		$mail->AddAddress($to, "");

		$mail->IsHTML(true);

		$mail->SMTPOptions = array(
		'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
		)
		);
		$mail->Send();

		?>


		<?php
}



?>