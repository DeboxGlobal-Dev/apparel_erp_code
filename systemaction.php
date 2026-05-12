<?php
include "inc.php";


if($_REQUEST['action']=='onlineadmin'){
$where='parentId="'.$_SESSION['userid'].'"';
$namevalue ='onlineStatus=1,cLogin="'.date('Y-m-d H:i:s').'"';
$update = updatelisting('userMaster',$namevalue,$where);

$select1='userSound';
$where1='userSound=1';
$rs1=GetPageRecord($select1,'liveVisitorMaster',$where1);
$usersoundyes=mysqli_fetch_array($rs1);

if($usersoundyes['userSound']=='1'){?>
<audio src="sms-alert-3-daniel_simon.mp3" controls autoplay></audio>
<?php

}

$select1='adminChatStatus';
$where1='msgType=2 and adminChatStatus=1 and dateTime>"'.date("Y-m-d H:i:s", (strtotime(date('Y-m-d H:i:s')) - 20)).'"';
$rs1=GetPageRecord($select1,'visitorChat',$where1);
$visitormsg=mysqli_fetch_array($rs1);

if($visitormsg['adminChatStatus']=='1'){?>
<audio src="sms-alert-4-daniel_simon.mp3" controls autoplay></audio>

<script>
(function titleScroller(text) {
    document.title = text;
    setTimeout(function () {
        titleScroller(text.substr(1) + text.substr(0, 1));
    }, 500);
}(" New Chat Message - WI Chat "));
</script>
<?php

} else { ?>

<script>
(function titleScroller(text) {
    document.title = text;

}(" <?php echo $systemname; ?> "));
</script>
<?php

}



$where='1';
$namevalue ='userSound=0';
updatelisting('liveVisitorMaster',$namevalue,$where);




}


if($_REQUEST['action']=='savecontactfrm' && $_REQUEST['name']!='' &&  $_REQUEST['email']!='' && $_REQUEST['mobile']!='' && $_REQUEST['visitorLocation']!='' && $_REQUEST['message']!='' && $_REQUEST['userId']!=''){

$name=addslashes($_REQUEST['name']);
$email=addslashes($_REQUEST['email']);
$mobile=addslashes($_REQUEST['mobile']);
$visitorLocation=addslashes($_REQUEST['visitorLocation']);
$message=addslashes($_REQUEST['message']);
 $userId=addslashes($_REQUEST['userId']);
$visitorDate=date('Y-m-d H:i:s');

$namevalue ='name="'.$name.'",email="'.$email.'",mobile="'.$mobile.'",visitorLocation="'.$visitorLocation.'",message="'.$message.'",visitorDate="'.$visitorDate.'",userId="'.$userId.'"';
addlisting('VisitorMasterQuery',$namevalue);

$select1='contactEmail,siteName,emailTo';
$where1='parentId=1';
$rs1=GetPageRecord($select1,'userMaster',$where1);
$editresult=mysqli_fetch_array($rs1);


$to = $editresult['contactEmail'];
$subject = 'Visitor enquiry from '.$editresult['siteName'].'';
$from=$editresult['emailTo'];
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: ". $from . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$message = '<p><strong>Name: </strong>'.$name.'<br><strong>Email: </strong>'.$email.'<br><strong>Mobile/Phone: </strong>'.$mobile.'<br><strong>Location: </strong>'.$visitorLocation.'<br><strong>Message: </strong>'.$message.'</p>';
mail($to, $subject, $message, $headers);


?>
<script>
$('.offlineformouter').hide();
$('#thankmsg').show();
</script>
<?php
}



?>