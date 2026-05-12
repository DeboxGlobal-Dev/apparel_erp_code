<?php
ob_start();
include "inc.php";
include "config/logincheck.php";

//Style Email template header
$mailbodyheader = '<table width="100%" style="max-width: 750px;margin: unset;background:#fff;border-left:1px solid #e4e4e4;border-right:1px solid #e4e4e4;border-bottom:1px solid #e4e4e4;font-family:Arial,Helvetica,sans-serif;" border="0" cellpadding="0" cellspacing="0" align="center">
  <tbody><tr>
    <td style="border-top: solid 4px #0d7444; line-height: 1;"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #e4e4e4;border-top:none">
        <tbody><tr>
          <td align="left" valign="top" style="padding:14px 0 0 11px">
	<a href="'.$fullurl.'" style="font-family:Arial,Helvetica,sans-serif;font-size:26px;color:#000;font-weight:700;text-decoration:none" target="_blank">
				<img src="'.$fullurl.'global_assets/images/woodland-logo2.png" alt="'.$fullurl.'global_assets/images/woodland-logo2.png">
			</a>
		</td>
          <td align="right" valign="top" style="padding:12px 11px 7px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#000">&nbsp;</td>
        </tr>
      </tbody></table></td>
</tr>
<tr>
<td>';

if(trim($_POST['action'])=='editaccount' && trim($_POST['name'])!='' && $_POST['editId']!=''){
$companyTypeId=clean($_POST['companyTypeId']);
$name=clean($_POST['name']);
$contactPerson=clean($_POST['contactPerson']);
$countryId=clean($_POST['countryId']);
$stateId=clean($_POST['stateId']);
$cityId=clean($_POST['cityId']);
$assignTo=($_POST['assignTo']);
$address1=clean($_POST['address1']);
$address2=clean($_POST['address2']);
$address3=clean($_POST['address3']);
$editedityes=clean($_POST['editedityes']);
$pinCode=clean($_POST['pinCode']);
$savenew=clean($_POST['savenew']);
$gstn=clean($_POST['gstn']);

$agreementattachment2=$_POST['agreementattachment2'];
$companyCategory=$_POST['companyCategory'];
$paymentTerm=$_POST['paymentTerm'];
$bussinessType=$_POST['bussinessType'];
$OpsAssignTo=$_POST['OpsAssignTo'];
$loginUserName=$_POST['loginUserName'];
$loginPassword=md5($_POST['loginPassword']);
if($loginPassword==""){
$loginPassword=trim($_POST['oldLoginPassword']);
}
$oldAtachment=trim($_POST['oldAtachment']);


$destpath = "attachment/";
$datef=time();

if(!empty($_FILES['attachment']['name']))
{
if($oldAtachment!=''){
unlink('attachment/'.$oldAtachment);
}
$source = $_FILES["attachment"]["tmp_name"];
$filename = $_FILES["attachment"]["name"];
$file_name= $datef.$_FILES["attachment"]["name"];
move_uploaded_file($source, $destpath . $datef . $filename) ;
}else{
$file_name=$oldAtachment;
}



$attachment=$file_name;
$modifyBy='0';
$dateAdded='0';

$modifyBy=$_SESSION['userid'];
$dateAdded=time();

$phone=clean($_POST['phone']);
$phone2=clean($_POST['phone2']);
$email=clean($_POST['email']);
$email2=clean($_POST['email2']);
$namevalue ='companyTypeId="'.$companyTypeId.'",name="'.$name.'",paymentTerm="'.$paymentTerm.'",contactPerson="'.$contactPerson.'",assignTo="'.$assignTo.'",modifyBy="'.$modifyBy.'",modifyDate="'.$dateAdded.'",agreement="'.$file_name.'",bussinessType="'.$bussinessType.'",companyCategory="'.$companyCategory.'",assignTo="'.$assignTo.'",phone="'.$phone.'",phone2="'.$phone2.'",email="'.$email.'",email2="'.$email2.'",address1="'.$address1.'",address2="'.$address2.'",cityId="'.$cityId.'",countryId="'.$countryId.'",loginUserName="'.$loginUserName.'",loginPassword="'.$loginPassword.'",attachment="'.$attachment.'"';
$where='id="'.decode($_POST['editId']).'"';
$update = updatelisting(_CORPORATE_MASTER_,$namevalue,$where);
if($update=='yes'){
generateLogs('accounts','update',decode($_POST['editId']));
?>
<script>
parent.window.location.href='page.de?section=accounts&view=yes&id=<?php echo $_POST['editId']; ?>&alt=<?php if($_REQUEST['editedityes']=='1'){ echo '2'; } else { echo '1'; } ?>';
</script>
<?php
 exit();
}
}



if(trim($_POST['action'])=='editcontacts' && trim($_POST['firstName'])!='' && $_POST['editId']!=''){
$contacttitleId=clean($_POST['contacttitleId']);
$firstName=clean($_POST['firstName']);
$lastName=clean($_POST['lastName']);
$designationId=clean($_POST['designationId']);
$birthDate=($_POST['birthDate']);
$anniversaryDate=($_POST['anniversaryDate']);
$countryId=clean($_POST['countryId']);
$stateId=clean($_POST['stateId']);
$cityId=clean($_POST['cityId']);
$assignTo=decode($_POST['assignTo']);
$address1=clean($_POST['address1']);
$address2=clean($_POST['address2']);
$address3=clean($_POST['address3']);
$editedityes=clean($_POST['editedityes']);
$pinCode=clean($_POST['pinCode']);
$savenew=clean($_POST['savenew']);
$twitter=clean($_POST['twitter']);
$facebook=$_POST['facebook'];
$linkedIn=$_POST['linkedIn'];
$birthDate=date("Y-m-d", strtotime($birthDate));
$anniversaryDate=date("Y-m-d", strtotime($anniversaryDate));
$modifyBy='0';
$dateAdded='0';
 $assignTo=$_POST['assignTo'];
$modifyBy=$_SESSION['userid'];
$dateAdded=time();

$phone=clean($_POST['phone']);
$phone2=clean($_POST['phone2']);
$email=clean($_POST['email']);
$email2=clean($_POST['email2']);
$accountId=clean($_POST['accountId']);
$namevalue ='contacttitleId="'.$contacttitleId.'",firstName="'.$firstName.'",lastName="'.$lastName.'",designationId="'.$designationId.'",birthDate="'.$birthDate.'",anniversaryDate="'.$anniversaryDate.'",countryId="'.$countryId.'",stateId="'.$stateId.'",cityId="'.$cityId.'",assignTo="'.$assignTo.'",address1="'.$address1.'",address2="'.$address2.'",address3="'.$address3.'",modifyBy="'.$modifyBy.'",modifyDate="'.$dateAdded.'",pinCode="'.$pinCode.'",facebook="'.$facebook.'",twitter="'.$twitter.'",linkedIn="'.$linkedIn.'",phone="'.$phone.'",phone2="'.$phone2.'",email="'.$email.'",email2="'.$email2.'",address1="'.$address1.'",address2="'.$address2.'",cityId="'.$cityId.'",countryId="'.$countryId.'",accountId="'.$accountId.'"';
$where='id="'.decode($_POST['editId']).'"';
$update = updatelisting(_CONTACT_MASTER_,$namevalue,$where);
if($update=='yes'){
generateLogs('contact','update',decode($_POST['editId']));
?>
<script>
parent.window.location.href='page.de?section=contacts&view=yes&id=<?php echo $_POST['editId']; ?>&alt=<?php if($_REQUEST['editedityes']=='1'){ echo '2'; } else { echo '1'; } ?>';
</script>
<?php
 exit();
}
}
if(trim($_POST['action'])=='editvendor' && trim($_POST['name'])!='' && $_POST['editId']!='' && $_POST['bussinessType']!=''){
$companyTypeId=clean($_POST['companyTypeId']);
$name=clean($_POST['name']);
$contactPerson=clean($_POST['contactPerson']);
$countryId=clean($_POST['countryId']);
$stateId=clean($_POST['stateId']);
$cityId=clean($_POST['cityId']);
$assignTo=($_POST['assignTo']);
$address1=clean($_POST['address1']);
$address2=clean($_POST['address2']);
$address3=clean($_POST['address3']);
$editedityes=clean($_POST['editedityes']);
$pinCode=clean($_POST['pinCode']);
$savenew=clean($_POST['savenew']);
$gstn=clean($_POST['gstn']);
;
$agreementattachment2=$_POST['agreementattachment2'];
$companyCategory=$_POST['companyCategory'];
$paymentTerm=$_POST['paymentTerm'];

$OpsAssignTo=$_POST['OpsAssignTo'];
$modifyBy='0';
$dateAdded='0';

$modifyBy=$_SESSION['userid'];
$dateAdded=time();

$loginUserName=$_POST['loginUserName'];
$loginPassword=md5($_POST['loginPassword']);
if($loginPassword==""){
$loginPassword=trim($_POST['oldLoginPassword']);
}


$phone=clean($_POST['phone']);
$phone2=clean($_POST['phone2']);
$email=clean($_POST['email']);
$email2=clean($_POST['email2']);
if(isset($_POST['bussinessType'])){
foreach($_POST['bussinessType'] as $k3=>$v3){
$bussinessType .= $_POST['bussinessType'][$k3].',';
}}
$bussinessType=str_replace('Array','',$bussinessType);
$namevalue ='companyTypeId="'.$companyTypeId.'",name="'.$name.'",paymentTerm="'.$paymentTerm.'",contactPerson="'.$contactPerson.'",assignTo="'.$assignTo.'",modifyBy="'.$modifyBy.'",modifyDate="'.$dateAdded.'",agreement="'.$file_name.'",bussinessType="'.$bussinessType.'",companyCategory="'.$companyCategory.'",assignTo="'.$assignTo.'",phone="'.$phone.'",phone2="'.$phone2.'",email="'.$email.'",email2="'.$email2.'",address1="'.$address1.'",address2="'.$address2.'",cityId="'.$cityId.'",countryId="'.$countryId.'",loginUserName="'.$loginUserName.'",loginPassword="'.$loginPassword.'"';
$where='id="'.decode($_POST['editId']).'"';
$update = updatelisting(_VENDOR_MASTER_,$namevalue,$where);

if($update=='yes'){
generateLogs('accounts','update',decode($_POST['editId']));
?>
<script>
parent.window.location.href='page.de?section=supplier&view=yes&id=<?php echo $_POST['editId']; ?>&alt=<?php if($_REQUEST['editedityes']=='1'){ echo '2'; } else { echo '1'; } ?>';
</script>
<?php
 exit();
}
}


 if(trim($_POST['action'])=='addemailaccount' && trim($_POST['from_name'])!='' && trim($_POST['email'])!='' && trim($_POST['password'])!='' && trim($_POST['smtp_server'])!='' && trim($_POST['port'])!='' && trim($_POST['security_type'])!='' && trim($_POST['incomingPort'])!=''){

$select='*';
$where='id="'.$_POST['editId'].'"';
$rs=GetPageRecord($select,_EMAIL_SETTING_MASTER_,$where);
$emailsetting=mysqli_fetch_array($rs);

$from_name=clean($_POST['from_name']);
$email=clean($_POST['email']);
$password=clean($_POST['password']);
$smtp_server=clean($_POST['smtp_server']);
$port=clean($_POST['port']);
$security_type=clean($_POST['security_type']);
$incomingPort=clean($_POST['incomingPort']);
$dateAdded=time();

if($_REQUEST['editId']!=''){
$namevalue ='from_name="'.$from_name.'",email="'.$email.'",password="'.$password.'",smtp_server="'.$smtp_server.'",port="'.$port.'",security_type="'.$security_type.'",modifyDate="'.$dateAdded.'",incomingPort="'.$incomingPort.'"';
$where='id="'.$_REQUEST['editId'].'"';
$update = updatelisting(_EMAIL_SETTING_MASTER_,$namevalue,$where);
$alt=2;
generateLogs('emailsettings','update',$_SESSION['userid']);
} else {
$namevalue ='from_name="'.$from_name.'",email="'.$email.'",password="'.$password.'",smtp_server="'.$smtp_server.'",port="'.$port.'",security_type="'.$security_type.'",dateAdded="'.$dateAdded.'",userId="'.$loginuserID.'",incomingPort="'.$incomingPort.'"';
addlisting(_EMAIL_SETTING_MASTER_,$namevalue);
$alt=1;
generateLogs('emailsettings','add',$_SESSION['userid']);
}


?>

<script>

parent.setupbox('showpage.crm?module=emailsetting');

</script>
<?php
 exit();

}









if($_REQUEST['action']=='createnewmail' && $_REQUEST['to']!='' && $_REQUEST['subject']!='' && $_REQUEST['description']!='' && $_REQUEST['from']!=''){

 $allvaluephone ='subject="'.addslashes($_REQUEST['subject']).'",mailBody="'.addslashes($_REQUEST['description']).'",mailDate="'.date('Y-m-d H:i:s').'",	mailStatus=3,mailAttachment="'.$file_name.'",mailFrom="'.$_REQUEST['to'].'",fromMail="'.$_REQUEST['from'].'",fromSection="'.$_REQUEST['fromMail'].'" ';
addlisting('mailSectionMaster',$allvaluephone);
$fromemail=$_REQUEST['from'];
$mailto=$_REQUEST['to'];
$mailsubject=stripslashes($_REQUEST['subject']);
$maildescription=stripslashes($_REQUEST['description']);
include('config/mail.php');
sendmailbox($fromemail,$mailto,$mailsubject,$maildescription,$ccmail,$file_name);
?>
<script>
parent.window.location.href='page.de?section=emails&alt=1';
</script>
<?php  }










 if(trim($_POST['action'])=='editcalls' && trim($_POST['parentId'])!='' && trim($_POST['assignTo'])!='' && trim($_POST['subject'])!='' && trim($_POST['fromDate'])!='' && trim($_POST['toDate'])!='' && trim($_POST['clientType'])!=''){

$queryId=clean($_POST['savenew']);
$companyId=($_POST['parentId']);
$editId=decode($_POST['editId']);
$companyName=clean($_POST['companyName']);
$assignTo=($_POST['assignTo']);
$description=clean($_POST['description']);
$fromDate=date("Y-m-d", strtotime($_POST['fromDate']));
$toDate=date("Y-m-d", strtotime($_POST['toDate']));
$followupdate=date("Y-m-d", strtotime($_POST['followupdate']));
$status=clean($_POST['status']);
$starttime=clean($_POST['starttime']);
$endtime=clean($_POST['endtime']);
$subject=clean($_POST['subject']);
$leadsource=clean($_POST['leadsource']);
$clientType=clean($_POST['clientType']);
$campaign=clean($_POST['campaign']);
$directiontype=clean($_POST['directiontype']);
$editedityes=clean($_POST['editedityes']);
$dateAdded=time();
if($_REQUEST['editId']!=''){
$modifyBy=$_SESSION['userid'];
$dateAdded=time();
generateLogs('calls','edit',$editId);
} else {
generateLogs('calls','add',$editId);
}
$remiderDate=date('Y-m-d H:i:s',strtotime($fromDate.' '.$starttime));
if($_REQUEST['editId']!=''){
$namevalue ='companyId="'.$companyId.'",deletestatus=0,assignTo="'.$assignTo.'",description="'.$description.'",fromDate="'.$fromDate.'",toDate="'.$toDate.'",status="'.$status.'",leadsource="'.$leadsource.'",subject="'.$subject.'",clientType="'.$clientType.'",campaign="'.$campaign.'",directiontype="'.$directiontype.'",followupdate="'.$followupdate.'",starttime="'.$starttime.'",endtime="'.$endtime.'",modifyBy="'.$modifyBy.'",dateAdded="'.$dateAdded.'",remiderDate="'.$remiderDate.'"';
$where='id='.decode($_REQUEST['editId']).'';
updatelisting(_CALLS_MASTER_,$namevalue,$where);
$where='parentId='.decode($_REQUEST['editId']).'';
$namevalue ='dateAdded="'.strtotime($remiderDate).'"';
updatelisting('salesTimeline',$namevalue,$where);
} else {
$namevalue ='companyId="'.$companyId.'",deletestatus=0,assignTo="'.$assignTo.'",description="'.$description.'",fromDate="'.$fromDate.'",toDate="'.$toDate.'",status="'.$status.'",leadsource="'.$leadsource.'",subject="'.$subject.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'",clientType="'.$clientType.'",campaign="'.$campaign.'",directiontype="'.$directiontype.'",followupdate="'.$followupdate.'",starttime="'.$starttime.'",endtime="'.$endtime.'",remiderDate="'.$remiderDate.'"';
$lasttid=addlistinggetlastid(_CALLS_MASTER_,$namevalue);
$namevalue ='dateAdded="'.strtotime($remiderDate).'",parentId="'.$lasttid.'",eventType="calls"';
addlistinggetlastid('salesTimeline',$namevalue);
}


 ?>
 <script>
 parent.reloadpage();
 </script>
 <?php

}
 if(trim($_POST['action'])=='editmeetings' && trim($_POST['parentId'])!='' && trim($_POST['assignTo'])!='' && trim($_POST['subject'])!='' && trim($_POST['fromDate'])!='' && trim($_POST['toDate'])!='' && trim($_POST['clientType'])!=''){

$queryId=clean($_POST['savenew']);
$companyId=($_POST['parentId']);
$editId=decode($_POST['editId']);
$companyName=clean($_POST['companyName']);
$assignTo=($_POST['assignTo']);
$description=clean($_POST['description']);
$fromDate=date("Y-m-d", strtotime($_POST['fromDate']));
$toDate=date("Y-m-d", strtotime($_POST['toDate']));
$followupdate=date("Y-m-d", strtotime($_POST['followupdate']));
$status=clean($_POST['status']);
$starttime=clean($_POST['starttime']);
$endtime=clean($_POST['endtime']);
$subject=clean($_POST['subject']);
$leadsource=clean($_POST['leadsource']);
$clientType=clean($_POST['clientType']);
$campaign=clean($_POST['campaign']);
$directiontype=clean($_POST['directiontype']);
$editedityes=clean($_POST['editedityes']);
$dateAdded=time();
if($_REQUEST['editId']!=''){
$modifyBy=$_SESSION['userid'];
$dateAdded=time();
generateLogs('calls','edit',$editId);
} else {
generateLogs('calls','add',$editId);
}
$remiderDate=date('Y-m-d H:i:s',strtotime($fromDate.' '.$starttime));
if($_REQUEST['editId']!=''){
$namevalue ='companyId="'.$companyId.'",deletestatus=0,assignTo="'.$assignTo.'",description="'.$description.'",fromDate="'.$fromDate.'",toDate="'.$toDate.'",status="'.$status.'",leadsource="'.$leadsource.'",subject="'.$subject.'",clientType="'.$clientType.'",campaign="'.$campaign.'",directiontype="'.$directiontype.'",followupdate="'.$followupdate.'",starttime="'.$starttime.'",endtime="'.$endtime.'",modifyBy="'.$modifyBy.'",dateAdded="'.$dateAdded.'",remiderDate="'.$remiderDate.'"';
$where='id='.decode($_REQUEST['editId']).'';
$update = updatelisting('meetingsMaster',$namevalue,$where);
$where='parentId='.decode($_REQUEST['editId']).'';
$namevalue ='dateAdded="'.strtotime($remiderDate).'"';
updatelisting('salesTimeline',$namevalue,$where);
} else {
$namevalue ='companyId="'.$companyId.'",deletestatus=0,assignTo="'.$assignTo.'",description="'.$description.'",fromDate="'.$fromDate.'",toDate="'.$toDate.'",status="'.$status.'",leadsource="'.$leadsource.'",subject="'.$subject.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'",clientType="'.$clientType.'",campaign="'.$campaign.'",directiontype="'.$directiontype.'",followupdate="'.$followupdate.'",starttime="'.$starttime.'",endtime="'.$endtime.'",remiderDate="'.$remiderDate.'"';
$lasttid = addlistinggetlastid('meetingsMaster',$namevalue);
$namevalue ='dateAdded="'.strtotime($remiderDate).'",parentId="'.$lasttid.'",eventType="meetings"';
addlistinggetlastid('salesTimeline',$namevalue);
}


 ?>
 <script>
 parent.reloadpage();
 </script>
 <?php

}
 if(trim($_POST['action'])=='edittasks'  && trim($_POST['assignTo'])!='' && trim($_POST['subject'])!='' && trim($_POST['fromDate'])!='' && trim($_POST['toDate'])!=''  ){

$queryId=clean($_POST['savenew']);
$companyId=($_POST['parentId']);
$editId=decode($_POST['editId']);
$companyName=clean($_POST['companyName']);
$assignTo=($_POST['assignTo']);
$description=clean($_POST['description']);
$fromDate=date("Y-m-d", strtotime($_POST['fromDate']));
$toDate=date("Y-m-d", strtotime($_POST['toDate']));
$followupdate=date("Y-m-d", strtotime($_POST['followupdate']));
$status=clean($_POST['status']);
$starttime=clean($_POST['starttime']);
$endtime=clean($_POST['endtime']);
$subject=clean($_POST['subject']);
$leadsource=clean($_POST['leadsource']);
$clientType=clean($_POST['clientType']);
$campaign=clean($_POST['campaign']);
$directiontype=clean($_POST['directiontype']);
$editedityes=clean($_POST['editedityes']);
$dateAdded=time();
if($_REQUEST['editId']!=''){
$modifyBy=$_SESSION['userid'];
$dateAdded=time();
generateLogs('calls','edit',$editId);
} else {
generateLogs('calls','add',$editId);
}
$remiderDate=date('Y-m-d H:i:s',strtotime($fromDate.' '.$starttime));
if($_REQUEST['editId']!=''){
$namevalue ='companyId="'.$companyId.'",deletestatus=0,assignTo="'.$assignTo.'",description="'.$description.'",fromDate="'.$fromDate.'",toDate="'.$toDate.'",status="'.$status.'",leadsource="'.$leadsource.'",subject="'.$subject.'",clientType="'.$clientType.'",campaign="'.$campaign.'",directiontype="'.$directiontype.'",followupdate="'.$followupdate.'",starttime="'.$starttime.'",endtime="'.$endtime.'",modifyBy="'.$modifyBy.'",dateAdded="'.$dateAdded.'",remiderDate="'.$remiderDate.'"';
$where='id='.decode($_REQUEST['editId']).'';
$update = updatelisting('tasksMaster',$namevalue,$where);
$where='parentId='.decode($_REQUEST['editId']).'';
$namevalue ='dateAdded="'.strtotime($remiderDate).'"';
updatelisting('salesTimeline',$namevalue,$where);
} else {
$namevalue ='companyId="'.$companyId.'",deletestatus=0,assignTo="'.$assignTo.'",description="'.$description.'",fromDate="'.$fromDate.'",toDate="'.$toDate.'",status="'.$status.'",leadsource="'.$leadsource.'",subject="'.$subject.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'",clientType="'.$clientType.'",campaign="'.$campaign.'",directiontype="'.$directiontype.'",followupdate="'.$followupdate.'",starttime="'.$starttime.'",endtime="'.$endtime.'",remiderDate="'.$remiderDate.'"';
$lasttid = addlistinggetlastid('tasksMaster',$namevalue);
$namevalue ='dateAdded="'.strtotime($remiderDate).'",parentId="'.$lasttid.'",eventType="tasks"';
addlistinggetlastid('salesTimeline',$namevalue);
}


 ?>
 <script>
 parent.reloadpage();
 </script>
 <?php

}
 if(trim($_POST['action'])=='edituser' && trim($_POST['firstName'])!='' && trim($_POST['email'])!='' && trim($_POST['profileId'])!=''){

$queryId=clean($_POST['savenew']);
$firstName=($_POST['firstName']);
$editId=decode($_POST['editId']);
$lastName=clean($_POST['lastName']);
$email=trim($_POST['email']);
$password=md5($_POST['password']);
 $status=clean($_POST['status']);
$roleId=clean($_POST['roleId']);
$profileId=clean($_POST['profileId']);
$phone=clean($_POST['phone']);
$userType=clean($_POST['userType']);
$empId=clean($_POST['empId']);
$dateAdded=time();
if($_REQUEST['editId']!=''){
$modifyBy=$_SESSION['userid'];
$dateAdded=time();
generateLogs('user','edit',$editId);
} else {
$select1='*';
$where1='email="'.$email.'"';
$rs1=GetPageRecord($select1,_USER_MASTER_,$where1);
$res=mysqli_fetch_array($rs1);
if($res['id']!=''){
?>
<script>
alert('User already exists');
</script>
<?php
exit();
}
generateLogs('user','add',$editId);
}

if($_REQUEST['editId']!=''){
$select1='*';
$where1='email="'.$email.'"';
$rs1=GetPageRecord($select1,_USER_MASTER_,$where1);
$res=mysqli_fetch_array($rs1);
$oldpassword =$res['password'];
if($oldpassword==$_POST['password']){
$password = $_POST['password'];
}else{
$password = md5($_POST['password']);
}

$namevalue ='firstName="'.$firstName.'",deletestatus=0,lastName="'.$lastName.'",email="'.$email.'",password="'.$password.'",status="'.$status.'",roleId="'.$roleId.'",profileId="'.$profileId.'",phone="'.$phone.'",userType="'.$userType.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",empId="'.$empId.'"';
$where='id='.decode($_REQUEST['editId']).'';
$update = updatelisting(_USER_MASTER_,$namevalue,$where);

} else {

$auto_password = rand(10,1000000);
$password = md5($auto_password);

$namevalue ='firstName="'.$firstName.'",deletestatus=0,lastName="'.$lastName.'",email="'.$email.'",password="'.$password.'",status="'.$status.'",roleId="'.$roleId.'",profileId="'.$profileId.'",phone="'.$phone.'",userType="'.$userType.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",empId="'.$empId.'"';
$lasttid = addlistinggetlastid(_USER_MASTER_,$namevalue);

//Send email to user when create account.
include('config/mail.php');
$mailsubject = "User created on woodland appreal ERP.";
$maildescription = 'Dear <b>'.$firstName.' '.$lastName.'</b> <br>
							<br>
							Greeting from '.$systemname.' - The Apparel ERP!</p>
<p>Your Account has been created successfully.</p>
<p>Please find the below credentials:</p>
<p>URL: '.$fullurl.' </p>
<p>Email: '.$email.'</p>
<p>Password: '.$auto_password.'</p>
<p>&nbsp;</p>
<p>Regards</p>
<p><b><i>Woodland- Aero Club</i></b></p>
<p><img src="'.$fullurl.'global_assets/images/woodland-logo2.png"></p>
';
$mailto = $email;
$ccmail='';
$file_name='';
$fromemail ='';
send_template_mail_query($fromemail,$mailto,$mailsubject,$maildescription,$ccmail);

}


 ?>
 <script>
 parent.reloadpage();
 </script>
 <?php

}
if(trim($_POST['action'])=='profilepic' && $_FILES["changeprofilepic"]["name"]!=''){
  $destpath = "profilepic/";
$datef=time();
while(list($key,$value) = each($_FILES["changeprofilepic"]["name"])) {

if(!empty($value))
{
if (($_FILES["changeprofilepic"]["type"][$key] == "image/gif")
|| ($_FILES["changeprofilepic"]["type"][$key] == "image/jpeg")
|| ($_FILES["changeprofilepic"]["type"][$key] == "image/pjpeg")
|| ($_FILES["changeprofilepic"]["type"][$key] == "image/png"))
    {
$source = $_FILES["changeprofilepic"]["tmp_name"][$key] ;
$filename = $_FILES["changeprofilepic"]["name"][$key] ;
move_uploaded_file($source, $destpath . $datef . $filename) ;
//echo "Uploaded: " . $destpath . $filename . "<br/>" ;
//thumbnail creation start//
$tsrc="profilepic/thumb/".$datef."".$_FILES["changeprofilepic"]["name"][$key];   // Path where thumb nail image will be stored
//echo $tsrc;
/*if (!($_FILES["changeprofilepic"]["type"] =="image/jpeg" OR $_FILES["changeprofilepic"]["type"] =="image/png" OR $_FILES["changeprofilepic"]["type"]=="image/gif")){echo "Your uploaded file must be of JPG or GIF. Other file types are not allowed<BR>";
}*/
$n_width=300;          // Fix the width of the thumb nail images
$n_height=199;         // Fix the height of the thumb nail imaage
/////////////////////////////////////////////// Starting of GIF thumb nail creation///////////
$add=$destpath . $filename;
if($_FILES["changeprofilepic"]["type"][$key]=="image/gif"){
//echo "hello";
$im=ImageCreateFromGIF($add);
$width=ImageSx($im);              // Original picture width is stored
$height=ImageSy($im);                  // Original picture height is stored
$max_size = 100;
$ratio    = $im[0] / $im[1];
if ($ratio >= 1) {
    $width  = $max_size;
    $height = round($max_size / $ratio);
} else {
    $width  = round($max_size * $ratio);
    $height = $max_size;
}
$newimage=imagecreatetruecolor($n_width,$n_height);
imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
if (function_exists("imagegif")) {
Header("Content-type: image/gif");
ImageGIF($newimage,$tsrc);
}
if (function_exists("imagejpeg")) {
Header("Content-type: image/jpeg");
ImageJPEG($newimage,$tsrc);
}
    }
//chmod("$tsrc",0777);
////////// end of gif file thumb nail creation//////////
$n_width=300;           // Fix the width of the thumb nail images
$n_height=199;         // Fix the height of the thumb nail imaage
////////////// starting of JPG thumb nail creation//////////
if($_FILES["changeprofilepic"]["type"][$key]=="image/jpeg"){
 $_FILES["changeprofilepic"]["name"][$key]."<br>";


$im=ImageCreateFromJPEG($add);
$width=ImageSx($im);              // Original picture width is stored
$height=ImageSy($im);             // Original picture height is stored
$max_size = 100;
$ratio    = $im[0] / $im[1];
if ($ratio >= 1) {
    $width  = $max_size;
    $height = round($max_size / $ratio);
} else {
    $width  = round($max_size * $ratio);
    $height = $max_size;
}
$newimage=imagecreatetruecolor($n_width,$n_height);
imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
ImageJpeg($newimage,$tsrc);
//chmod("$tsrc",0777);
}
////////////////  End of png thumb nail creation //////////
if($_FILES["changeprofilepic"]["type"][$key]=="image/png"){
//echo "hello";
$im=ImageCreateFromPNG($add);
$width=ImageSx($im);              // Original picture width is stored
$height=ImageSy($im);                  // Original picture height is stored
$newimage=imagecreatetruecolor($n_width,$n_height);
imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
if (function_exists("imagepng")) {
//Header("Content-type: image/png");
ImagePNG($newimage,$tsrc);
}
if (function_exists("imagejpeg")) {
//Header("Content-type: image/jpeg");
ImageJPEG($newimage,$tsrc);
}
    }
// thumbnail creation end---
    }
else{echo "error in upload";}
}

//image_fix_orientation('profilepic/'.$datef.''.$_FILES["changeprofilepic"]["name"][$key].'');
//generate_image_thumbnail('profilepic/'.$datef.''.$_FILES["changeprofilepic"]["name"][$key].'', 'profilepic/thumb/small'.$datef.''.$_FILES["changeprofilepic"]["name"][$key].'','48','48');
//generate_image_thumbnail('profilepic/'.$datef.''.$_FILES["changeprofilepic"]["name"][$key].'', 'profilepic/'.$datef.''.$_FILES["changeprofilepic"]["name"][$key].'','200','200');
//$img = 'upload/'.$datef.''.$_FILES["changeprofilepic"]["name"][$key].'';
//resize($img);
//adjustPicOrientation($img);
unlink('profilepic/'.$loginuserprofilePhoto);
unlink('profilepic/thumb/small'.$loginuserprofilePhoto);
$file_name= $datef.$_FILES["changeprofilepic"]["name"][$key];

 $sql_ins1="update "._USER_MASTER_." set  profilePhoto='$file_name' where id = '".$_SESSION['userid']."'";
$rs1=mysql_query($sql_ins1) or die(mysql_error());
}

 ?>
 <script>
 parent.reloadpage();
 </script>
 <?php

 exit();
}



if(trim($_POST['action'])=='editdestination' && trim($_POST['name'])!='' && $_POST['countryId']!=''){
$countryId=clean($_POST['countryId']);
$name=clean($_POST['name']);
$modifyBy=$_SESSION['userid'];

$namevalue ='countryId="'.$countryId.'",name="'.$name.'",status="0",modifyBy="'.$modifyBy.'",modifyDate="'.date('d-m-Y H:i:a').'"';

if($_POST['editId']!=''){

$where='id="'.decode($_POST['editId']).'"';
$update = updatelisting('destinationMaster',$namevalue,$where);

} else {

addlistinggetlastid('destinationMaster',$namevalue);
}


?>
<script>
parent.window.location.href='page.de?section=destinationMaster';
</script>
<?php
 exit();
}







if(trim($_POST['action'])=='editcountry' && trim($_POST['name'])!=''  ){
$name=clean($_POST['name']);
$modifyBy=$_SESSION['userid'];

$namevalue ='name="'.$name.'",status="0",modifyBy="'.$modifyBy.'",modifyDate="'.date('d-m-Y H:i:a').'"';


if($_POST['editId']!=''){

$where='id="'.decode($_POST['editId']).'"';
$update = updatelisting('countryMaster',$namevalue,$where);

 } else {

addlistinggetlastid('countryMaster',$namevalue);
}



?>
<script>
parent.window.location.href='page.de?section=countryMaster';
</script>
<?php
 exit();

}




if(trim($_POST['action'])=='editdcity' && trim($_POST['name'])!='' && $_POST['countryId']!=''){
$countryId=clean($_POST['countryId']);
$name=clean($_POST['name']);
$modifyBy=$_SESSION['userid'];

echo $namevalue ='countryId="'.$countryId.'",name="'.$name.'",modifyBy="'.$modifyBy.'",modifyDate="'.date('d-m-Y H:i:a').'"';


if($_POST['editId']!=''){


$where='id="'.decode($_POST['editId']).'"';
$update = updatelisting('cityMaster',$namevalue,$where);

 } else {
addlistinggetlastid('cityMaster',$namevalue);
}
?>
<script>
 parent.window.location.href='page.de?section=cityMaster';
</script>
<?php
 exit();
}








if(trim($_POST['action'])=='salesPoints' && trim($_POST['name'])!='' && $_POST['sectionType']!='' && $_POST['status']!=''){

$sectionType=clean($_POST['sectionType']);
if($sectionType==1){
$sectionType="transfer";
}else{
$sectionType="sightseeing";
}

$status=clean($_POST['status']);
$name=clean($_POST['name']);


$namevalue ='sectionType="'.$sectionType.'",name="'.$name.'",status="'.$status.'"';


if($_POST['editId']!=''){


$where='id="'.decode($_POST['editId']).'"';
$update = updatelisting('salesPointsMaster',$namevalue,$where);

 } else {
addlistinggetlastid('salesPointsMaster',$namevalue);
}
?>
<script>
 parent.window.location.href='page.de?section=salesPointsMaster';
</script>
<?php
 exit();
}






if(trim($_POST['action'])=='inclusions' && trim($_POST['name'])!='' && $_POST['sectionType']!='' && $_POST['status']!=''){

$sectionType=clean($_POST['sectionType']);
if($sectionType==1){
$sectionType="transfer";
}else{
$sectionType="sightseeing";
}

$status=clean($_POST['status']);
$name=clean($_POST['name']);


$namevalue ='sectionType="'.$sectionType.'",name="'.$name.'",status="'.$status.'"';


if($_POST['editId']!=''){


$where='id="'.decode($_POST['editId']).'"';
$update = updatelisting('inclusionsMaster',$namevalue,$where);

 } else {
addlistinggetlastid('inclusionsMaster',$namevalue);
}
?>
<script>
 parent.window.location.href='page.de?section=inclusionsMaster';
</script>
<?php
 exit();
}







if(trim($_POST['action'])=='exclusions' && trim($_POST['name'])!='' && $_POST['sectionType']!='' && $_POST['status']!=''){

$sectionType=clean($_POST['sectionType']);
if($sectionType==1){
$sectionType="transfer";
}else{
$sectionType="sightseeing";
}

$status=clean($_POST['status']);
$name=clean($_POST['name']);


$namevalue ='sectionType="'.$sectionType.'",name="'.$name.'",status="'.$status.'"';


if($_POST['editId']!=''){


$where='id="'.decode($_POST['editId']).'"';
$update = updatelisting('exclusionsMaster',$namevalue,$where);
 } else {
addlistinggetlastid('exclusionsMaster',$namevalue);
}
?>
<script>
 parent.window.location.href='page.de?section=exclusionsMaster';
</script>
<?php
 exit();
}



if(trim($_POST['action'])=='categoryType' && trim($_POST['name'])!='' && $_POST['categoryType']!='' && $_POST['status']!=''){

$categoryType=clean($_POST['categoryType']);
if($categoryType==1){
$categoryType="transfer";
}else{
$categoryType="sightseeing";
}

$status=clean($_POST['status']);
$name=clean($_POST['name']);


$namevalue ='categoryType="'.$categoryType.'",name="'.$name.'",status="'.$status.'"';


if($_POST['editId']!=''){


$where='id="'.decode($_POST['editId']).'"';
$update = updatelisting('categoryTypeMaster',$namevalue,$where);
 } else {
addlistinggetlastid('categoryTypeMaster',$namevalue);
}
?>
<script>
 parent.window.location.href='page.de?section=categoryTypeMaster';
</script>
<?php
 exit();
}







if(trim($_POST['action'])=='editsightseeing' && trim($_POST['name'])!='' && $_POST['supplier']!='' && $_POST['status']!='' && $_POST['cost']!=''){

$status=clean($_POST['status']);
$supplier=trim(addslashes($_POST['supplier']));
$name=trim(addslashes($_POST['name']));
$cost=trim(addslashes($_POST['cost']));
$currency=trim(addslashes($_POST['currency']));
$country=trim(addslashes($_POST['country']));
$destinaton=trim(addslashes($_POST['destinaton']));
$duration=trim(addslashes($_POST['duration']));
$description=trim(addslashes($_POST['description']));
$inclusions=$_POST['inclusions'];
$inc='';
if($inclusions!=''){
foreach($inclusions as $value=>$key){
$inc.=$key.',';
}
}
$exclusions=$_POST['exclusions'];
$exe='';
if($exclusions!=''){
foreach($exclusions as $value=>$key){
$exe.=$key.',';
}
}
$VoucherRequirements=trim(addslashes($_POST['VoucherRequirements']));
$departureTime=trim(addslashes($_POST['departureTime']));
$departurePoint=trim(addslashes($_POST['departurePoint']));
$returnDetails=trim(addslashes($_POST['returnDetails']));
$salesPoints=$_POST['salesPoints'];
$salespt='';
if($salesPoints!=''){
foreach($salesPoints as $value=>$key){
$salespt.=$key.',';
}
}

$categoryTags=$_POST['categoryTags'];
$catTags='';
if($categoryTags!=''){
foreach($categoryTags as $value=>$key){
$catTags.=$key.',';
}
}
$starRating=trim(addslashes($_POST['starRating']));


$namevalue ='supplier="'.$supplier.'",name="'.$name.'",cost="'.$cost.'",currency="'.$currency.'",country="'.$country.'",destinaton="'.$destinaton.'",duration="'.$duration.'",description="'.$description.'",inclusions="'.rtrim($inc,',').'",exclusions="'.rtrim($exe,',').'",VoucherRequirements="'.$VoucherRequirements.'",departureTime="'.$departureTime.'",departurePoint="'.$departurePoint.'",returnDetails="'.$returnDetails.'",salesPoints="'.rtrim($salespt,',').'",categoryTags="'.rtrim($catTags,',').'",starRating="'.$starRating.'",updateDate="'.time().'",updateBy="'.$_SESSION['userid'].'",status="'.$status.'"';


if($_POST['editId']!=''){


$where='id="'.decode($_POST['editId']).'"';
$update = updatelisting('sightseeingMaster',$namevalue,$where);
 } else {
addlistinggetlastid('sightseeingMaster',$namevalue);
}
?>
<script>
 parent.window.location.href='page.de?section=sightseeingMaster';
</script>
<?php
 exit();
}










if(trim($_POST['action'])=='sightseeingGallary' && $_FILES['sightseeingGallary']!='' && trim($_POST['parentId'])!=''){

$sectionType = trim($_POST['sectionType']);
$parentId = trim($_POST['parentId']);

$countfile = count($_FILES['sightseeingGallary']['name']);
$destpath = 'images/imageGallary/';
$datef=time();
for($i=0; $i<=$countfile; $i++){
$source = $_FILES["sightseeingGallary"]["tmp_name"][$i] ;
$filename = $_FILES["sightseeingGallary"]["name"][$i] ;
$filename = str_replace(' ','',$filename);
if(move_uploaded_file($source, $destpath . $datef . $filename)){

$namevalue ='imgUrl="'.time().$filename.'",sectionType="'.$sectionType.'",parentId="'.decode($parentId).'"';
addlistinggetlastid('imageGalleryMaster',$namevalue);
}
}
?>
<script>
parent.window.location.href='page.de?section=sightseeingMaster&view=yes&id=<?php echo $parentId; ?>';
</script>
<?php
 exit();
}






if(trim($_POST['action'])=='edittransfer' && trim($_POST['name'])!='' && $_POST['supplier']!='' && $_POST['status']!='' && $_POST['cost']!=''){

$status=clean($_POST['status']);
$supplier=trim(addslashes($_POST['supplier']));
$name=trim(addslashes($_POST['name']));
$cost=trim(addslashes($_POST['cost']));
$currency=trim(addslashes($_POST['currency']));
$country=trim(addslashes($_POST['country']));
$destinaton=trim(addslashes($_POST['destinaton']));
$duration=trim(addslashes($_POST['duration']));
$description=trim(addslashes($_POST['description']));
$inclusions=$_POST['inclusions'];
$inc='';
if($inclusions!=''){
foreach($inclusions as $value=>$key){
$inc.=$key.',';
}
}
$exclusions=$_POST['exclusions'];
$exe='';
if($exclusions!=''){
foreach($exclusions as $value=>$key){
$exe.=$key.',';
}
}
$VoucherRequirements=trim(addslashes($_POST['VoucherRequirements']));
$departureTime=trim(addslashes($_POST['departureTime']));
$departurePoint=trim(addslashes($_POST['departurePoint']));
$returnDetails=trim(addslashes($_POST['returnDetails']));
$salesPoints=$_POST['salesPoints'];
$salespt='';
if($salesPoints!=''){
foreach($salesPoints as $value=>$key){
$salespt.=$key.',';
}
}

$categoryTags=$_POST['categoryTags'];
$catTags='';
if($categoryTags!=''){
foreach($categoryTags as $value=>$key){
$catTags.=$key.',';
}
}
$starRating=trim(addslashes($_POST['starRating']));


$namevalue ='supplier="'.$supplier.'",name="'.$name.'",cost="'.$cost.'",currency="'.$currency.'",country="'.$country.'",destinaton="'.$destinaton.'",duration="'.$duration.'",description="'.$description.'",inclusions="'.rtrim($inc,',').'",exclusions="'.rtrim($exe,',').'",VoucherRequirements="'.$VoucherRequirements.'",departureTime="'.$departureTime.'",departurePoint="'.$departurePoint.'",returnDetails="'.$returnDetails.'",salesPoints="'.rtrim($salespt,',').'",categoryTags="'.rtrim($catTags,',').'",starRating="'.$starRating.'",updateDate="'.time().'",updateBy="'.$_SESSION['userid'].'",status="'.$status.'"';


if($_POST['editId']!=''){


$where='id="'.decode($_POST['editId']).'"';
$update = updatelisting('transferMaster',$namevalue,$where);
 } else {
addlistinggetlastid('transferMaster',$namevalue);
}
?>
<script>
 parent.window.location.href='page.de?section=transferMaster';
</script>
<?php
 exit();
}




if(trim($_POST['action'])=='transferGallary' && $_FILES['transferGallary']!='' && trim($_POST['parentId'])!=''){

$sectionType = trim($_POST['sectionType']);
$parentId = trim($_POST['parentId']);

$countfile = count($_FILES['transferGallary']['name']);
$destpath = 'images/imageGallary/';
$datef=time();
for($i=0; $i<=$countfile; $i++){
$source = $_FILES["transferGallary"]["tmp_name"][$i] ;
$filename = $_FILES["transferGallary"]["name"][$i] ;
$filename = str_replace(' ','',$filename);
if(move_uploaded_file($source, $destpath . $datef . $filename)){

$namevalue ='imgUrl="'.time().$filename.'",sectionType="'.$sectionType.'",parentId="'.decode($parentId).'"';
addlistinggetlastid('imageGalleryMaster',$namevalue);
}
}
?>
<script>
parent.window.location.href='page.de?section=transferMaster&view=yes&id=<?php echo $parentId; ?>';
</script>
<?php
 exit();
}







if(trim($_POST['action'])=='editmission' && trim($_POST['title'])!='' && $_POST['description']!='' && $_POST['editid']!='' && $_POST['module']!=''){

$title=trim(addslashes($_POST['title']));
$description=trim(addslashes($_POST['description']));

$namevalue ='title="'.$title.'",description="'.$description.'",updatedDate="'.time().'"';


$where='id="'.decode($_POST['editid']).'"';
$update = updatelisting('aboutus',$namevalue,$where);

?>
<script>
 parent.window.location.href='page.de?section=<?php echo $_POST['module']; ?>';
</script>
<?php
 exit();
}



if(trim($_POST['action'])=='editservices' && trim($_POST['title'])!='' && $_POST['description']!='' && $_POST['editid']!='' && $_POST['module']!=''){

$title=trim(addslashes($_POST['title']));
$description=trim(addslashes($_POST['description']));

$namevalue ='title="'.$title.'",description="'.$description.'",updatedDate="'.time().'"';


$where='id="'.decode($_POST['editid']).'"';
$update = updatelisting('services',$namevalue,$where);

?>
<script>
 parent.window.location.href='page.de?section=<?php echo $_POST['module']; ?>';
</script>
<?php
 exit();
}









if(trim($_POST['action'])=='addbanner' && $_FILES['photo']!=''){
$photo='';

if($_FILES['photo']['name']!=""){
//$destpath = 'images/imageGallary/';
$destpath = 'images/imageGallary/';
$datef=time();
$source = $_FILES["photo"]["tmp_name"];
$filename = $_FILES["photo"]["name"];
$filename = str_replace(' ','',$filename);
if(move_uploaded_file($source, $destpath . $datef . $filename)){
$photo = time().$filename;
}
}


$namevalue ='imgUrl="'.$photo.'",updatedDate="'.time().'"';
addlistinggetlastid('banner',$namevalue);

?>
<script>
 parent.window.location.href='page.de?section=banner';
</script>
<?php
 exit();
}

 /////////////////start season master///////////////////
if(trim($_POST['action'])=='addedit_seasonmaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$startDate=date('Y-m-d',strtotime($_POST['startDate']));
$endDate=date('Y-m-d',strtotime($_POST['endDate']));
$seasonYear=clean($_POST['seasonYear']);
$dateAdded=time();
$namevalue ='seasonYear="'.$seasonYear.'",name="'.$name.'",startDate="'.$startDate.'",endDate="'.$endDate.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting(_SEASON_MASTER_,$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php }

if(trim($_POST['action'])=='addedit_seasonmaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$startDate=date('Y-m-d',strtotime($_POST['startDate']));
$endDate=date('Y-m-d',strtotime($_POST['endDate']));
$seasonYear=clean($_POST['seasonYear']);
$modifyDate=time();

$where='id='.$_POST['editId'].'';
$namevalue ='seasonYear="'.$seasonYear.'",name="'.$name.'",startDate="'.$startDate.'",endDate="'.$endDate.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting(_SEASON_MASTER_,$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>

<?php }

 /////////////////start category master///////////////////
if(trim($_POST['action'])=='categorymaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$dateAdded=time();
$namevalue ='name="'.$name.'",description="'.$description.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting(_CATEGORY_MASTER_,$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php }

if(trim($_POST['action'])=='categorymaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);


$modifyDate=time();

$where='id='.decode($_POST['editId']).'';
$namevalue ='name="'.$name.'",description="'.$description.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting(_CATEGORY_MASTER_,$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>

<?php }

 /////////////////start sub category master///////////////////
if(trim($_POST['action'])=='addedit_subcategory' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$categoryId=clean($_POST['categoryId']);
$description=clean($_POST['description']);

if(isset($_POST['sampleTaskId'])){
	foreach($_POST['sampleTaskId'] as $k1=>$v1){
		$sampleTaskId .= $_POST['sampleTaskId'][$k1].',';
	}
}
$sampleTaskId = str_replace('Array','',$sampleTaskId);

$dateAdded=time();
$namevalue ='name="'.$name.'",categoryId="'.$categoryId.'",sampleTaskId="'.$sampleTaskId.'",description="'.$description.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting(_SUB_CATEGORY_MASTER_,$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php }

if(trim($_POST['action'])=='addedit_subcategory' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$categoryId=clean($_POST['categoryId']);
$description=clean($_POST['description']);

if(isset($_POST['sampleTaskId'])){
	foreach($_POST['sampleTaskId'] as $k1=>$v1){
		$sampleTaskId .= $_POST['sampleTaskId'][$k1].',';
	}
}
$sampleTaskId = str_replace('Array','',$sampleTaskId);


$modifyDate=time();

$where='id='.$_POST['editId'].'';
$namevalue ='name="'.$name.'",categoryId="'.$categoryId.'",sampleTaskId="'.$sampleTaskId.'",description="'.$description.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting(_SUB_CATEGORY_MASTER_,$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>

<?php }

 /////////////////start SAMPLING TASK master///////////////////
if(trim($_POST['action'])=='addedit_sampletask' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$dateAdded=time();
$namevalue ='name="'.$name.'",description="'.$description.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting(_SAMPLE_TASK_MASTER_,$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php }

if(trim($_POST['action'])=='addedit_sampletask' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$modifyDate=time();
$where='id='.$_POST['editId'].'';
$namevalue ='name="'.$name.'",description="'.$description.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting(_SAMPLE_TASK_MASTER_,$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>

<?php }

 /////////////////start wash type master///////////////////
if(trim($_POST['action'])=='addedit_washtypemaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$dateAdded=time();
$namevalue ='name="'.$name.'",description="'.$description.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting(_WASH_TYPE_MASTER_,$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php }

if(trim($_POST['action'])=='addedit_washtypemaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$modifyDate=time();
$where='id='.$_POST['editId'].'';
$namevalue ='name="'.$name.'",description="'.$description.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting(_WASH_TYPE_MASTER_,$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>

<?php }

 /////////////////start Embroidery Type master///////////////////
if(trim($_POST['action'])=='addedit_embroiderytype' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$dateAdded=time();
$namevalue ='name="'.$name.'",description="'.$description.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting(_EMBROIDERY_TYPE_MASTER_,$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php }

if(trim($_POST['action'])=='addedit_embroiderytype' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$modifyDate=time();
$where='id='.$_POST['editId'].'';
$namevalue ='name="'.$name.'",description="'.$description.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting(_EMBROIDERY_TYPE_MASTER_,$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>

<?php }

 /////////////////start Material Master///////////////////
if(trim($_POST['action'])=='addedit_materialmaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$categoryId=clean($_POST['categoryId']);
$dateAdded=time();

$namevalue ='name="'.$name.'",categoryId="'.$categoryId.'",description="'.$description.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting(_MATERIAL_MASTER_,$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php }


if(trim($_POST['action'])=='addedit_materialmaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$categoryId=clean($_POST['categoryId']);
$modifyDate=time();
$where='id='.$_POST['editId'].'';
$namevalue ='name="'.$name.'",categoryId="'.$categoryId.'",description="'.$description.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting(_MATERIAL_MASTER_,$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>

<?php }



 /////////////////start departnent Master///////////////////
if(trim($_POST['action'])=='departmentmaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);

$dateAdded=time();
$namevalue ='name="'.$name.'",description="'.$description.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting(_DEPARTMENT_MASTER_,$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php }

if(trim($_POST['action'])=='departmentmaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);

$modifyDate=time();
$where='id='.decode($_POST['editId']).'';
$namevalue ='name="'.$name.'",description="'.$description.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting(_DEPARTMENT_MASTER_,$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>

<?php }



 /////////////////start departnent timeline Master///////////////////
if(trim($_POST['action'])=='departmenttimeline' && trim($_POST['editId'])=='' && trim($_POST['duration'])!='' && trim($_POST['module'])!=''){

$duration=clean($_POST['duration']);
$departmentId=clean($_POST['departmentId']);
$categoryId=clean($_POST['categoryId']);
$subCategoryId=clean($_POST['subCategoryId']);

$dateAdded=time();
$namevalue ='duration="'.$duration.'",departmentId="'.$departmentId.'",categoryId="'.$categoryId.'",subCategoryId="'.$subCategoryId.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting(_DEPARTMENT_TIMELINE_MASTER_,$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php }

if(trim($_POST['action'])=='departmenttimeline' && trim($_POST['editId'])!='' && trim($_POST['duration'])!='' && trim($_POST['module'])!=''){
$duration=clean($_POST['duration']);
$departmentId=clean($_POST['departmentId']);
$categoryId=clean($_POST['categoryId']);
$subCategoryId=clean($_POST['subCategoryId']);

$modifyDate=time();
$where='id='.decode($_POST['editId']).'';
$namevalue ='duration="'.$duration.'",departmentId="'.$departmentId.'",categoryId="'.$categoryId.'",subCategoryId="'.$subCategoryId.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting(_DEPARTMENT_TIMELINE_MASTER_,$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>

<?php }


/////////////////start color code master///////////////////
if(trim($_POST['action'])=='addedit_colorcardsmaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$colorCode=clean($_POST['colorCode']);
$reference=clean($_POST['reference']);
$buyerColorName=clean($_POST['buyerColorName']);
$buyerColorCode=clean($_POST['buyerColorCode']);

$dateAdded=time();
$namevalue ='name="'.$name.'",colorCode="'.$colorCode.'",reference="'.$reference.'",buyerColorName="'.$buyerColorName.'",buyerColorCode="'.$buyerColorCode.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting(_COLOR_CARD_MASTER_,$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php }

if(trim($_POST['action'])=='addedit_colorcardsmaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$colorCode=clean($_POST['colorCode']);
$reference=clean($_POST['reference']);
$buyerColorName=clean($_POST['buyerColorName']);
$buyerColorCode=clean($_POST['buyerColorCode']);

$modifyDate=time();
$where='id='.$_POST['editId'].'';
$namevalue ='name="'.$name.'",colorCode="'.$colorCode.'",reference="'.$reference.'",buyerColorName="'.$buyerColorName.'",buyerColorCode="'.$buyerColorCode.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting(_COLOR_CARD_MASTER_,$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>

<?php }


if(trim($_POST['action'])=='addquery' && $_POST['editId']!='' && $_POST['styleRefId']!=''){
include "config/mail.php";

$maildata=addslashes($_POST['maildata']);

if($_POST['subject']!=''){
$subject=clean($_POST['subject']);
}else{
$subject= '#'.$_POST['styleRefId'].' '.getCategoryName($_POST['categoryId']).' '.getSubCategoryName($_POST['subCategoryId']);
}

$buyerId=clean($_POST['buyerId']);
$styleRefId=clean($_POST['styleRefId']);
$buyerStyleRefNo=clean($_POST['buyerStyleRefNo']);
$receivedDate=clean($_POST['receivedDate']);
$categoryId=clean($_POST['categoryId']);
$subCategoryId=clean($_POST['subCategoryId']);
$seasonId=clean($_POST['seasonId']);
$divisionId=clean($_POST['divisionId']);
$departmentId=clean($_POST['departmentId']);
$assignTo=clean($_POST['assignTo']);
$orderQty=clean($_POST['orderQty']);
$queryPriority=clean($_POST['queryPriority']);
$styleType=clean($_POST['styleType']);
$remark=clean($_POST['remark']);
$refrenceBy=clean($_POST['refrenceBy']);

if($queryPriority=='1'){
$queryPriorityName ='Low';
} else if($queryPriority=='2'){
$queryPriorityName ='Medium';
} else{
$queryPriorityName ='High';
}


$receivedDate=date("Y-m-d", strtotime($_POST['receivedDate']));

$editId=clean($_POST['editId']);
$editedityes=clean($_POST['editedityes']);
$incomingqueryId=clean($_POST['incomingqueryId']);
$dateAdded=time();

if($_FILES['attachmentFile']['name']!=''){
$file_name=trim(addslashes($_FILES['attachmentFile']['name']));
$file_name=time().'-'.str_replace(' ', '_',$file_name);
$file_name= str_replace('#', 'f',$file_name);
copy($_FILES['attachmentFile']['tmp_name'],"images/".$file_name);
}

$selectd='';
$whered='';
$rsd='';
$selectd='displayId';
$whered='subject!="" and deletestatus=0 order by displayId desc ';
$rsd=GetPageRecord($selectd,_QUERY_MASTER_,$whered);
$display=mysqli_fetch_array($rsd);
$displayId = $display['displayId']+1;



if(isset($_POST['sizerange'])){
	foreach($_POST['sizerange'] as $k1=>$v1){
		$sizerange .= $_POST['sizerange'][$k1].',';
	}
}
$sizerange = str_replace('Array','',$sizerange);

if(isset($_POST['sizeratio'])){
	foreach($_POST['sizeratio'] as $k21=>$v21){
		$sizeratio .= $_POST['sizeratio'][$k21].',';
	}
}
$sizeratio = str_replace('Array','',$sizeratio);
$colorbreakup=clean($_POST['colorbreakup']);


if($_FILES['patternAttachment']['name']!=''){
$file_name=$_FILES['patternAttachment']['name'];
$file_name=time().'-'.str_replace(' ', '_',$file_name);
$file_name= str_replace('#', 'f',$file_name);
copy($_FILES['patternAttachment']['tmp_name'],"images/".$file_name);
}
else{
$file_name =$_POST['patternAttachmentEdit'];
}


//Add first version for costsheet.
$namevalue11 = 'styleId="'.decode($_POST['editId']).'",versionName="V1",dateAdded="'.$dateAdded.'",versionId="1",addedBy="'.$_SESSION['userid'].'"';
$versionId = addlistinggetlastid('costsheetVersionMaster',$namevalue11);

//add new style subcategory masster
//add material subcategory in stylesubcategorymaster
$select12='*';
$where12='id="'.$subCategoryId.'" ';
$rs12=GetPageRecord($select12,'subCategoryMaster',$where12);
$resListing123=mysqli_fetch_array($rs12);

$where33='';
$rs33='';
$select33='id,name';
$where33='1 order by id asc';
$rs33=GetPageRecord($select33,'materialTypeMaster',$where33);
$sr=0;
while($resListing=mysqli_fetch_array($rs33)){

$array =  explode(',', $resListing123['materialid']);
foreach ($array as $item) {
$where22='';
$rs22='';
$select22='*';
$where22='id="'.$item.'" and materialtype="'.$resListing['id'].'" order by id asc';
$rs22=GetPageRecord($select22,'materialMaster',$where22);


while($resListing1=mysqli_fetch_array($rs22)){
$sr++;
$namevalue121 ='name="'.$resListing1['name'].'",materialType="'.$resListing1['materialtype'].'",materialid="'.$resListing1['id'].'",subCategoryId="'.$subCategoryId.'",styleId="'.decode($editId).'",sr="'.$sr.'",costsheetVersionId="1"';
$addddddd = addlisting('styleSubCategoryMaster',$namevalue121);

} } }


$namevalue ='subject="'.$subject.'",buyerId="'.$buyerId.'",styleRefId="'.$styleRefId.'",sizerange="'.$sizerange.'",techpackattachment="'.$file_name.'",sizeratio="'.$sizeratio.'",colorbreakup="'.$colorbreakup.'",buyerStyleRefNo="'.$buyerStyleRefNo.'",receivedDate="'.$receivedDate.'",categoryId="'.$categoryId.'",subCategoryId="'.$subCategoryId.'",seasonId="'.$seasonId.'",divisionId="'.$divisionId.'",departmentId="'.$departmentId.'",displayId="'.$displayId.'",mailId="'.$_REQUEST['mailId'].'",attachmentFile="'.$file_name.'",assignTo="'.$assignTo.'",orderQty="'.$orderQty.'",receivedDate="'.$receivedDate.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'",stylestatus="1",defaultcostsheetVersionId="1",queryPriority="'.$queryPriority.'",styleType="'.$styleType.'",remark="'.$remark.'",refrenceBy="'.$refrenceBy.'"';

$where='id="'.decode($editId).'"';
$update = updatelisting(_QUERY_MASTER_,$namevalue,$where);

if($update=='yes'){
$namevalue ='convertQuery="'.decode($editId).'"';
$where='id="'.decode($incomingqueryId).'"';
$update = updatelisting('mailSectionMaster',$namevalue,$where);
}

$mailbodyfooter = '</td>
  </tr>
      <tr>
    <td style="padding: 20px 10px; background: #f4f4f4;">
		  <p style="margin:0px;font-size:18px;padding:0 0 0 8px;    border-left: 3px solid #0d7544;height:25px;line-height:25px;color:#666">Details of the Style is as under:</p>
		 <div style="clear:both;padding:0;margin:10px 0 0 0;border:1px solid #f5f5f5;background:#fff">

	   <table width="100%" border="0" cellspacing="0" cellpadding="5" style="border: 0.5px solid #ccc;">

   <tr>
    <td style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Style</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">Style '.$subject.'</td>
  </tr>
   <tr>
    <td style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Category</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.getCategoryName($categoryId).'</td>
  </tr>
   <tr>
    <td style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Sub Category</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;"> '.getSubCategoryName($subCategoryId).' </td>
  </tr>
  <tr>
    <td style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Season</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.seasonName($seasonId).'</td>
  </tr>
  <tr>
    <td style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Received Date</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.date('d M, Y',strtotime($receivedDate)).'</td>
  </tr>

</table>
</div>
</td>
  </tr>
    <tr>

  </tr>
</tbody></table>';


$tabledatashow = ''.$mailbodyheader.'
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody><tr>
			 <td style="padding:19px 4px 0 4px;font-family:Arial,Helvetica,sans-serif">
				<p style="margin:0;font-size:15px;color:#333;padding:0 0 8px 6px;line-height:18px">Dear <strong>'.getUserName($_SESSION['userid']).'</strong></p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Greeting from '.$systemname.' - The Apparel ERP! .</p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Style #'.$styleRefId.' has been created by you for your action. Please work on the same and update in the ERP to the person concern for the next process. </p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Details of the Style is as under:</p>
			</td>
        </tr>
      </tbody></table> '.$mailbodyfooter.'';

$querythanksmsg=''.$tabledatashow.'';

$selectAdminMail='email';
$whereAdminMail='id=1';
$rsAdminMail=GetPageRecord($selectAdminMail,_USER_MASTER_,$whereAdminMail);
$adminEmail=mysqli_fetch_array($rsAdminMail);

$fromemail ='';
$mailto =$_SESSION['username'];
$ccmail=$adminEmail['email'];
$mailsubject='New Style #'.$styleRefId.' on Woodland Appreal ERP.';
$maildescription=$querythanksmsg;

send_template_mail_query($fromemail,$mailto,$mailsubject,$maildescription,$ccmail);

$optionquery.=$queryHtml.$queryHtml2.$description.'<br><br>'.$downloadLink;

$select='emailsignature';

$where='id="'.$_SESSION['userid'].'" and email="'.$_SESSION['username'].'"';

$rs=GetPageRecord($select,_USER_MASTER_,$where);

$LoginUserDetails=mysqli_fetch_array($rs);

$description=addslashes($querythanksmsg.$optionquery.$attachmentvar);

$description2=str_replace('client_read_mail.php','',$description);

$subject='#'.makeQueryId($resultquery['displayId']).' '.$subject;

if($maildata!=''){
$namevalue ='subject="'.$subject.'",description="'.$maildata.'",adddate="'.date('Y-m-d H:i:s').'",queryid="'.decode($editId).'",maildate="'.$_REQUEST['maildate'].'",qmailId=1';
$adds = addlisting(_QUERYMAILS_MASTER_,$namevalue);
}


$namevalue ='subject="'.$subject.'",description="'.$description2.'",attachmentFile="'.$attachmentvar.'",adddate="'.date('Y-m-d H:i:s').'",queryid="'.decode($editId).'",qmailId=1';
$adds = addlisting(_QUERYMAILS_MASTER_,$namevalue);


//Add first version for style.
$namevalue11 = 'styleId="'.decode($_POST['editId']).'",dateAdded="'.$dateAdded.'"';
$versionId = addlistinggetlastid('styleTechPackMaster',$namevalue11);

//Add First Note of Style Status
//$notes="<strong>Style created</strong> by <span class='assignClass'> ".getUserName($_SESSION['userid'])." </span> and assign to  <span class='assignClass'> ".getUserName($assignTo)."</span>";
$notes="<strong>Style created</strong> by <span class='assignClass'> ".getUserName($_SESSION['userid'])." </span> and Pending For Acceptance";
$styleassignment = 'styleId="'.decode($_POST['editId']).'",statusId=13,notes="'.$notes.'",assignTo="'.$assignTo.'",dateAdded="'.$dateAdded.'"';
addlisting('styleAssignmentMaster',$styleassignment);



?>

<script>

parent.setupbox('showpage.crm?module=style&alt=1');

</script>

<?php

}


if(trim($_POST['action'])=='editquery' && $_POST['editId']!='' && $_POST['styleRefId']!=''){

include "config/mail.php";

if($_POST['subject']!=''){
$subject=clean($_POST['subject']);
}else{
$subject= '#'.$_POST['styleRefId'].' '.getCategoryName($_POST['categoryId']).' '.getSubCategoryName($_POST['subCategoryId']);
}
$buyerId=clean($_POST['buyerId']);
$styleRefId=clean($_POST['styleRefId']);

$buyerStyleRefNo=clean($_POST['buyerStyleRefNo']);
$receivedDate=clean($_POST['receivedDate']);
$categoryId=clean($_POST['categoryId']);
$subCategoryId=clean($_POST['subCategoryId']);
$seasonId=clean($_POST['seasonId']);
$queryPriority=clean($_POST['queryPriority']);
$styleType=clean($_POST['styleType']);

$divisionId=clean($_POST['divisionId']);
$departmentId=clean($_POST['departmentId']);
$assignTo=clean($_POST['assignTo']);
$orderQty=clean($_POST['orderQty']);
$receivedDate=date("Y-m-d", strtotime($_POST['receivedDate']));
$remark=clean($_POST['remark']);
$editId=clean($_POST['editId']);
$editedityes=clean($_POST['editedityes']);
$incomingqueryId=clean($_POST['incomingqueryId']);
$refrenceBy=clean($_POST['refrenceBy']);

$dateAdded=time();

if($_FILES['attachmentFile']['name']!=''){
$file_name=trim(addslashes($_FILES['attachmentFile']['name']));
$file_name=time().'-'.str_replace(' ', '_',$file_name);
$file_name= str_replace('#', 'f',$file_name);
copy($_FILES['attachmentFile']['tmp_name'],"images/".$file_name);
}

$selectd='';
$whered='';
$rsd='';
$selectd='displayId';
$whered='subject!="" and deletestatus=0 order by displayId desc ';
$rsd=GetPageRecord($selectd,_QUERY_MASTER_,$whered);
$display=mysqli_fetch_array($rsd);
$displayId = $display['displayId'];


if(isset($_POST['sizerange'])){
	foreach($_POST['sizerange'] as $k1=>$v1){
		$sizerange .= $_POST['sizerange'][$k1].',';
	}
}
$sizerange = str_replace('Array','',$sizerange);

if(isset($_POST['sizeratio'])){
	foreach($_POST['sizeratio'] as $k21=>$v21){
		$sizeratio .= $_POST['sizeratio'][$k21].',';
	}
}
$sizeratio = str_replace('Array','',$sizeratio);
$colorbreakup=clean($_POST['colorbreakup']);


if($_FILES['patternAttachment']['name']!=''){
$file_name=$_FILES['patternAttachment']['name'];
$file_name=time().'-'.str_replace(' ', '_',$file_name);
$file_name= str_replace('#', 'f',$file_name);
copy($_FILES['patternAttachment']['tmp_name'],"images/".$file_name);
}
else{
$file_name =$_POST['patternAttachmentEdit'];
}



$namevalue ='subject="'.$subject.'",buyerId="'.$buyerId.'",styleRefId="'.$styleRefId.'",sizerange="'.$sizerange.'",techpackattachment="'.$file_name.'",sizeratio="'.$sizeratio.'",colorbreakup="'.$colorbreakup.'",buyerStyleRefNo="'.$buyerStyleRefNo.'",receivedDate="'.$receivedDate.'",categoryId="'.$categoryId.'",subCategoryId="'.$subCategoryId.'",seasonId="'.$seasonId.'",divisionId="'.$divisionId.'",departmentId="'.$departmentId.'",mailId="'.$_REQUEST['mailId'].'",attachmentFile="'.$file_name.'",assignTo="'.$assignTo.'",orderQty="'.$orderQty.'",receivedDate="'.$receivedDate.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'",queryPriority="'.$queryPriority.'",styleType="'.$styleType.'",remark="'.$remark.'",refrenceBy="'.$refrenceBy.'"';

$where='id="'.decode($editId).'"';
$update = updatelisting(_QUERY_MASTER_,$namevalue,$where);

if($update=='yes'){
$namevalue ='convertQuery="'.decode($editId).'"';
$where='id="'.decode($incomingqueryId).'"';
$update = updatelisting('mailSectionMaster',$namevalue,$where);
}

?>

<script>

parent.setupbox('showpage.crm?module=style&alt=1');

</script>

<?php

}
?>

<?php

//add duplicate version
if(trim($_POST['action2'])=='techpackversion' && $_POST['cvId']=='1'){

$editId=decode($_POST['editId']);
$versionId = decode($_POST['versionId']);

	$whereCheck='styleId="'.$editId.'" and costsheetVersionId="'.$versionId.'"';
	$checkCode = checkduplicate('styleSubCategoryMaster',$whereCheck);
	if($checkCode == 'yes'){
		//create version of costsheet.
		$selectversion = '*';
		$whereversion='styleId="'.decode($_POST['editId']).'"';
		$rsversion=GetPageRecord($selectversion,'costsheetVersionMaster',$whereversion);
		$countversion=mysql_num_rows($rsversion);

		if($countversion!=''){
		$versionName = 'V'.($countversion+1);
		$versionIdNew = $countversion+1;
		}

	$namevalue11 = 'styleId="'.decode($_POST['editId']).'",versionName="'.$versionName.'",versionId="'.$versionIdNew.'",dateAdded="'.time().'",addedBy="'.$_SESSION['userid'].'"';
		$newversionId = addlistinggetlastid('costsheetVersionMaster',$namevalue11);

		$selectd='*';
		$whered='styleId="'.$editId.'" and costsheetVersionId="'.$versionId.'"';
		$rsd=GetPageRecord($selectd,'styleSubCategoryMaster',$whered);
		while($duplicateRecords=mysqli_fetch_array($rsd)){

		$namevalue121 ='name="'.$duplicateRecords['name'].'",materialType="'.$duplicateRecords['materialType'].'",materialid="'.$duplicateRecords['materialid'].'",subCategoryId="'.$duplicateRecords['subCategoryId'].'",styleId="'.$editId.'",sr="'.$duplicateRecords['sr'].'",costsheetVersionId="'.$versionIdNew.'",materialdescriptionid="'.$duplicateRecords['materialdescriptionid'].'"';
		$addddddd = addlisting('styleSubCategoryMaster',$namevalue121);

		}

		$whereCheckEx='styleId="'.$editId.'" and costsheetVersionId="'.$versionId.'"';
		$checkCodeEx = checkduplicate('extraChargesDetailMaster',$whereCheckEx);
		if($checkCodeEx == 'yes'){
			$selectd1='*';
			$whered1='styleId="'.$editId.'" and costsheetVersionId="'.$versionId.'"';
			$rsd1=GetPageRecord($selectd1,'extraChargesDetailMaster',$whered1);
			while($duplicateRecords1=mysqli_fetch_array($rsd1)){

			$namevalueex='bomAvgextra="'.$duplicateRecords1['bomAvgextra'].'",bomUnitextra="'.$duplicateRecords1['bomUnitextra'].'",bomUSDextra="'.$duplicateRecords1['bomUSDextra'].'",bomINRextra="'.$duplicateRecords1['bomINRextra'].'",bomRateextra="'.$duplicateRecords1['bomRateextra'].'",bomvalueonepcextra="'.$duplicateRecords1['bomvalueonepcextra'].'",bomSerialNoextra="'.$duplicateRecords1['bomSerialNoextra'].'",styleId="'.$editId.'",costsheetVersionId="'.$versionIdNew.'"';
			$adddddddex = addlisting('extraChargesDetailMaster',$namevalueex);

			}
		}

		$whereChecktpDetail='styleId="'.$editId.'" and costsheetVersionId="'.$versionId.'"';
		$checkCodetpDetail = checkduplicate('techPackDetailMaster',$whereChecktpDetail);
		if($checkCodetpDetail == 'yes'){
			$selectd12='*';
			$whered12='styleId="'.$editId.'" and costsheetVersionId="'.$versionId.'"';
			$rsd12=GetPageRecord($selectd12,'techPackDetailMaster',$whered12);
			while($duplicateRecords12=mysqli_fetch_array($rsd12)){

			$namevaluetpDetail='bomCategoryId="'.$duplicateRecords12['bomCategoryId'].'",bomSubCategoryId="'.$duplicateRecords12['bomSubCategoryId'].'",bomQuality="'.$duplicateRecords12['bomQuality'].'",bomColorFirst="'.$duplicateRecords12['bomColorFirst'].'",bomColorSecond="'.$duplicateRecords12['bomColorSecond'].'",bomPlacement="'.$duplicateRecords12['bomPlacement'].'",bomAvg="'.$duplicateRecords12['bomAvg'].'",bomUnit="'.$duplicateRecords12['bomUnit'].'",bomSupplier="'.$duplicateRecords12['bomSupplier'].'",bomExInhouseDate="'.$duplicateRecords12['bomExInhouseDate'].'",bomStatus="'.$duplicateRecords12['bomStatus'].'",bomSerialNo="'.$duplicateRecords12['bomSerialNo'].'",styleTechPackId="'.$duplicateRecords12['styleTechPackId'].'",cid="'.$duplicateRecords12['cid'].'",sectionType="bom",bomUSD="'.$duplicateRecords12['bomUSD'].'",bomINR="'.$duplicateRecords12['bomINR'].'",bomRate="'.$duplicateRecords12['bomRate'].'",bomvalueonepc="'.$duplicateRecords12['bomvalueonepc'].'",styleId="'.$editId.'",costsheetVersionId="'.$versionIdNew.'"';
			$adddddddex = addlisting('techPackDetailMaster',$namevaluetpDetail);

			}
		}


	}


?>
<script>
parent.reload_page();
</script>
<?php
}
?>


<?php /*?><?php
if(trim($_POST['action2'])=='techpackversion' && $_POST['versionId']!='' && $_POST['cvId']==''){


echo $_POST['bomTotalCount']."+++++++++++";
echo $_POST['bomTotalCountextra']."--------";

print_r($_POST);

$editId=decode($_POST['editId']);
$versionId = decode($_POST['versionId']);

//Update Tech-Pack
$dateAdded=time();
$namevalue1 = 'styleId="'.$editId.'",dateAdded="'.$dateAdded.'"';
$whereval='id="'.$versionId.'"';
updatelisting('styleTechPackMaster',$namevalue1,$whereval);

$wheredelete=' styleId="'.decode($_POST['editId']).'" and  styleTechPackId="'.$versionId.'" and sectionType="construction"';
deleteRecord('techPackDetailMaster',$wheredelete);

while($constCount <= $_POST['constructTotalCount']){

	$techPackSubCategoryId=clean($_POST["techPackSubCategoryId".$constCount]);
	$techPackCategoryId=clean($_POST["techPackCategoryId".$constCount]);
	$typeOfMachine=clean($_POST["typeOfMachine".$constCount]);
	$remark=clean($_POST["remark".$constCount]);

	if($typeOfMachine!='' || $remark!=''){



	$allvalue ='techPackSubCategoryId="'.$techPackSubCategoryId.'",techPackCategoryId="'.$techPackCategoryId.'",typeOfMachine="'.$typeOfMachine.'",remark="'.$remark.'",styleId="'.decode($_POST['editId']).'",styleTechPackId="'.$versionId.'",sectionType="construction"';



	$add = addlisting('techPackDetailMaster',$allvalue);

	}
	 $constCount++;
}

$wheredelete=' styleId="'.decode($_POST['editId']).'" and  styleTechPackId="'.$versionId.'" and sectionType="measurement"';
deleteRecord('techPackDetailMaster',$wheredelete);

while($measurementCount <= $_POST['measurementCount']){
	$measureId=clean($_POST["measureId".$measurementCount]);
	$measureSmall=clean($_POST["measureSmall".$measurementCount]);
	$measureMedium=clean($_POST["measureMedium".$measurementCount]);
	$measureLarge=clean($_POST["measureLarge".$measurementCount]);
	$measureXL=clean($_POST["measureXL".$measurementCount]);
	$measureXXL=clean($_POST["measureXXL".$measurementCount]);
	$measureTOL=clean($_POST["measureTOL".$measurementCount]);

	if($measureSmall!='' || $measureMedium!='' || $measureLarge!='' || $measureXL!='' || $measureXXL!='' || $measureTOL!=''){
	$allvalue2 ='measureId="'.$measureId.'",measureSmall="'.$measureSmall.'",measureMedium="'.$measureMedium.'",measureLarge="'.$measureLarge.'",measureXL="'.$measureXL.'",measureXXL="'.$measureXXL.'",measureTOL="'.$measureTOL.'",styleId="'.decode($_POST['editId']).'",styleTechPackId="'.$versionId.'",sectionType="measurement"';
	$add = addlisting('techPackDetailMaster',$allvalue2);
	}
	 $measurementCount++;
}


$wheredelete=' styleId="'.decode($_POST['editId']).'" and  costsheetVersionId="'.$versionId.'" and sectionType="bom"';
deleteRecord('techPackDetailMaster',$wheredelete);

while($valuesbom <= $_POST['bomTotalCount']){
	$bomCategoryId=clean($_POST["bomCategoryId".$valuesbom.$versionId]);
	$bomSubCategoryId=clean($_POST["bomSubCategoryId".$valuesbom.$versionId]);
	$bomQuality=clean($_POST["bomQuality".$valuesbom.$versionId]);
	$bomColorFirst=clean($_POST["bomColorFirst".$valuesbom.$versionId]);
	$bomColorSecond=clean($_POST["bomColorSecond".$valuesbom.$versionId]);
	$bomPlacement=clean($_POST["bomPlacement".$valuesbom.$versionId]);
	$bomAvg=clean($_POST["bomAvg".$valuesbom.$versionId]);
	$bomUnit=clean($_POST["bomUnit".$valuesbom.$versionId]);
	$bomUSD=clean($_POST["bomUSD".$valuesbom.$versionId]);
	$bomINR=clean($_POST["bomINR".$valuesbom.$versionId]);
	$bomRate=clean($_POST["bomRate".$valuesbom.$versionId]);
	$bomvalueonepc=clean($_POST["bomvalueonepc".$valuesbom.$versionId]);
	$bomSupplier=clean($_POST["bomSupplier".$valuesbom.$versionId]);
	$bomExInhouseDate=clean($_POST["bomExInhouseDate".$valuesbom.$versionId]);
	//$bomComment=clean($_POST["bomComment".$valuesbom]);
	$bomStatus=clean($_POST["bomStatus".$valuesbom.$versionId]);
	$bomSerialNo=clean($_POST["bomSerialNo".$valuesbom]);
	$cid=clean($_POST["cid".$valuesbom]);

	if($bomAvg!=''){
	$allvalue3 ='bomCategoryId="'.$bomCategoryId.'",bomSubCategoryId="'.$bomSubCategoryId.'",bomQuality="'.$bomQuality.'",bomColorFirst="'.$bomColorFirst.'",bomColorSecond="'.$bomColorSecond.'",bomPlacement="'.$bomPlacement.'",bomAvg="'.$bomAvg.'",bomUnit="'.$bomUnit.'",bomSupplier="'.$bomSupplier.'",bomExInhouseDate="'.$bomExInhouseDate.'",bomStatus="'.$bomStatus.'",bomSerialNo="'.$bomSerialNo.'",styleId="'.decode($_POST['editId']).'",styleTechPackId="'.$versionId.'",costsheetVersionId="'.$versionId.'",cid="'.$cid.'",sectionType="bom",bomUSD="'.$bomUSD.'",bomINR="'.$bomINR.'",bomRate="'.$bomRate.'",bomvalueonepc="'.$bomvalueonepc.'"';
	$add = addlisting('techPackDetailMaster',$allvalue3);
	}
	 $valuesbom++;
}

//add chat for material list

$commentedBy=$_SESSION['userid'];
$commentAddDate=time();

while($valuesbomcomment <= $_POST['bomTotalCount']){
	$bomSerialNo=clean($_POST["bomSerialNo".$valuesbomcomment]);
	$bomComment=clean($_POST["bomComment".$valuesbomcomment]);

	if($bomComment!=''){
	$allvaluecost ='bomSerialNo="'.$bomSerialNo.'",styleId="'.decode($_POST['editId']).'",comment="'.$bomComment.'",addedBy="'.$commentedBy.'",dateAdded="'.$commentAddDate.'"';
	$addcost = addlisting('materialCostChatMaster',$allvaluecost);
	}
	 $valuesbomcomment++;
}

$wheredeleteex=' styleId="'.decode($_POST['editId']).'" and costsheetVersionId="'.$versionId.'"';
deleteRecord('extraChargesDetailMaster',$wheredeleteex);

//add extra charges insert
while($valuesbomextracharges <= $_POST['bomTotalCountextra']){
	$bomAvgextra=clean($_POST["bomAvgextra".$valuesbomextracharges.$versionId]);
	$bomUnitextra=clean($_POST["bomUnitextra".$valuesbomextracharges.$versionId]);
	$bomUSDextra=clean($_POST["bomUSDextra".$valuesbomextracharges.$versionId]);
	$bomINRextra=clean($_POST["bomINRextra".$valuesbomextracharges.$versionId]);
	$bomRateextra=clean($_POST["bomRateextra".$valuesbomextracharges.$versionId]);
	$bomvalueonepcextra=clean($_POST["bomvalueonepcextra".$valuesbomextracharges.$versionId]);
	$bomSerialNoextra=clean($_POST["bomSerialNoextra".$valuesbomextracharges]);

	if($bomAvgextra!='' && $bomUnitextra!='' && $bomINRextra!='' && $bomRateextra!='' && $bomvalueonepcextra!='' && $bomSerialNo!=''){
	$allvalue31 ='bomAvgextra="'.$bomAvgextra.'",bomUnitextra="'.$bomUnitextra.'",bomUSDextra="'.$bomUSDextra.'",bomINRextra="'.$bomINRextra.'",bomRateextra="'.$bomRateextra.'",bomvalueonepcextra="'.$bomvalueonepcextra.'",bomSerialNoextra="'.$bomSerialNoextra.'",styleId="'.decode($_POST['editId']).'",costsheetVersionId="'.$versionId.'"';
	$add1 = addlisting('extraChargesDetailMaster',$allvalue31);
	}
	 $valuesbomextracharges++;
}

?>

<?php if($_POST['markeruploaded']=='markeruploaded') {

$markerAddDate=time();
$markerAddedBy=$_SESSION['userid'];
$markerDescription =$_POST['markerDescription'];

$where='id="'.decode($_POST['editId']).'"';
$namevalue ='markerAddDate="'.$markerAddDate.'",markerAddedBy="'.$markerAddedBy.'",markerDescription="'.$markerDescription.'"';
$update = updatelisting(_QUERY_MASTER_,$namevalue,$where);


//add to marker uploaded
$styleassignment = 'styleId="'.decode($_POST['editId']).'",statusId=6,dateAdded="'.time().'"';
addlisting('styleAssignmentMaster',$styleassignment);


?>

<?php }?>
<script>
//parent.reload_page();
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&edit=yes&styleid=<?php echo $_POST['editId']; ?>&alt=1');
</script>

<?php
} <?php */?>




<?php
 /////////////////image gallery///////////////////
if(trim($_POST['action'])=='styleimagegallery' && trim($_POST['editId'])=='' && trim($_REQUEST['parentid'])!=''){

$name=clean($_POST['name']);
$parentid=decode($_REQUEST['parentid']);

if($_FILES['attachmentImage']['name']!=''){
$file_name=$_FILES['attachmentImage']['name'];
$file_name=time().'-'.$file_name;
copy($_FILES['attachmentImage']['tmp_name'],"images/".$file_name);
}

$dateAdded=time();
$namevalue ='name="'.$name.'",parentid="'.$parentid.'",attachmentImage="'.$file_name.'",galleryType="image_gallery"';
$adds = addlisting('imageGallery',$namevalue);
?>
<script>
parent.loadimagefunc();
parent.$('#modalpop').hide();
parent.$('.modal-backdrop').hide();
//parent.$('.modal-open').scroll();
parent.document.body.style.overflow= "scroll";
</script>

<?php }

 /////////////////start category master///////////////////
if(trim($_POST['action'])=='tasklistmaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$dateAdded=time();
$namevalue ='name="'.$name.'",description="'.$description.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting('taskListMaster',$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php }

if(trim($_POST['action'])=='tasklistmaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$modifyDate=time();

$where='id='.decode($_POST['editId']).'';
$namevalue ='name="'.$name.'",description="'.$description.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('taskListMaster',$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>

<?php }

?>

<script>
parent.$('#pageloading').hide();
parent.$('#pageloader').hide();
</script>

<?php


/////////////////start embroiderytype master///////////////////
if(trim($_POST['action'])=='embroiderytype' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$dateAdded=time();
$namevalue ='name="'.$name.'",description="'.$description.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting(_EMBROIDERY_TYPE_MASTER_,$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php }

if(trim($_POST['action'])=='embroiderytype' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$modifyDate=time();

$where='id='.decode($_POST['editId']).'';
$namevalue ='name="'.$name.'",description="'.$description.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting(_EMBROIDERY_TYPE_MASTER_,$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>

<?php }


/////////////////start buyer master///////////////////
if(trim($_POST['action'])=='buyermaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$buyerId=clean($_POST['buyerId']);
$shortname=clean($_POST['shortname']);
$bemail=clean($_POST['bemail']);
$bphone=clean($_POST['bphone']);
$status=clean($_POST['status']);
$dateAdded=time();
$namevalue ='name="'.$name.'",buyerId="'.$buyerId.'",buyerShortName="'.$shortname.'",buyeremail="'.$bemail.'",buyerphone="'.$bphone.'",status="'.$status.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';

$adds = addlisting(_BUYER_MASTER_,$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php }

if(trim($_POST['action'])=='buyermaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$buyerId=clean($_POST['buyerId']);
$shortname=clean($_POST['shortname']);
$bemail=clean($_POST['bemail']);
$bphone=clean($_POST['bphone']);
$status=clean($_POST['status']);

$modifyDate=time();

$where='id='.decode($_POST['editId']).'';

$namevalue ='name="'.$name.'",buyerId="'.$buyerId.'",buyerShortName="'.$shortname.'",buyeremail="'.$bemail.'",buyerphone="'.$bphone.'",status="'.$status.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting(_BUYER_MASTER_,$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>

<?php }


//sampling task master
if(trim($_POST['action'])=='samplingtaskmaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$dateAdded=time();
$namevalue ='name="'.$name.'",description="'.$description.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';

$adds = addlisting(_SAMPLE_TASK_MASTER_,$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php }

if(trim($_POST['action'])=='samplingtaskmaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$modifyDate=time();
$where='id='.decode($_POST['editId']).'';
$namevalue ='name="'.$name.'",description="'.$description.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting(_SAMPLE_TASK_MASTER_,$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>

<?php }


//messages
if(trim($_POST['action'])=='messages' && trim($_POST['editId'])=='' && trim($_POST['subject'])!='' && trim($_POST['module'])!=''){
$subject=clean($_POST['subject']);
$postText=clean($_POST['postText']);
$dateAdded=time();
$namevalue ='subject="'.$subject.'",postText="'.$postText.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';

$adds = addlisting('timelineMaster',$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php }

/////////////////startSeason Master///////////////////
if(trim($_POST['action'])=='seasonmaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);

$startDate=date('Y-m-d', strtotime(clean($_POST['startDate'])));
$enddate=date('Y-m-d', strtotime(clean($_POST['enddate'])));

$status=clean($_POST['status']);

$dateAdded=time();
$namevalue ='name="'.$name.'",startDate="'.$startDate.'",status="'.$status.'",enddate="'.$enddate.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting(_SEASON_MASTER_,$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php }


if(trim($_POST['action'])=='seasonmaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$startDate=date('Y-m-d', strtotime(clean($_POST['startDate'])));
$enddate=date('Y-m-d', strtotime(clean($_POST['enddate'])));

$status=clean($_POST['status']);

$modifyDate=time();
$where='id='.decode($_POST['editId']).'';
$namevalue ='name="'.$name.'",status="'.$status.'",startDate="'.$startDate.'",enddate="'.$enddate.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting(_SEASON_MASTER_,$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>
<?php }


/////////////////Sub Category Master///////////////////
if(trim($_POST['action'])=='subcategorymaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$categoryId=clean($_POST['categoryId']);
$description=clean($_POST['description']);
$status=clean($_POST['status']);
if(isset($_POST['sampleTaskId'])){
	foreach($_POST['sampleTaskId'] as $k1=>$v1){
		$sampleTaskId .= $_POST['sampleTaskId'][$k1].',';
	}
}
$sampleTaskId = str_replace('Array','',$sampleTaskId);
$dateAdded=time();

$string = $_POST['material'];
$str_arr = implode(",", $string);

$namevalue ='name="'.$name.'",categoryId="'.$categoryId.'",materialid="'.$str_arr.'",sampleTaskId="'.$sampleTaskId.'",description="'.$description.'",status="'.$status.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting(_SUB_CATEGORY_MASTER_,$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php }


if(trim($_POST['action'])=='subcategorymaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$categoryId=clean($_POST['categoryId']);
$description=clean($_POST['description']);
$status=clean($_POST['status']);

if(isset($_POST['sampleTaskId'])){
	foreach($_POST['sampleTaskId'] as $k1=>$v1){
		$sampleTaskId .= $_POST['sampleTaskId'][$k1].',';
	}
}
$sampleTaskId = str_replace('Array','',$sampleTaskId);

$string = $_POST['material'];
$str_arr = implode(",", $string);


$modifyDate=time();
$where='id='.decode($_POST['editId']).'';
$namevalue ='name="'.$name.'",categoryId="'.$categoryId.'",materialid="'.$str_arr.'",sampleTaskId="'.$sampleTaskId.'",description="'.$description.'",status="'.$status.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting(_SUB_CATEGORY_MASTER_,$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>
<?php }



/////////////////materal Master///////////////////
if(trim($_POST['action'])=='materialmaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!='' && trim($_POST['categoryId'])!=''){
$name=clean($_POST['name']);
$categoryId=clean($_POST['categoryId']);
$description=clean($_POST['description']);
$status=clean($_POST['status']);
$dateAdded=time();

$whereCheck='name="'.$name.'" and materialtype="'.$categoryId.'"';
$checkCode = checkduplicate(_MATERIAL_MASTER_,$whereCheck);
if($checkCode=='yes'){
?>
<script>
alert('This Material is aleready exist.');
</script>
<?php
} else{

$namevalue ='name="'.$name.'",materialtype="'.$categoryId.'",description="'.$description.'",status="'.$status.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting(_MATERIAL_MASTER_,$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>
<?php } }

if(trim($_POST['action'])=='materialmaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$categoryId=clean($_POST['categoryId']);
$description=clean($_POST['description']);
$status=clean($_POST['status']);
$modifyDate=time();
$where='id='.decode($_POST['editId']).'';
$namevalue ='name="'.$name.'",materialtype="'.$categoryId.'",description="'.$description.'",status="'.$status.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting(_MATERIAL_MASTER_,$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>
<?php }

/////////////////materal description Master///////////////////
if(trim($_POST['action'])=='materialdescriptionmaster' && trim($_POST['editId'])=='' && trim($_POST['longDescription'])!='' && trim($_POST['module'])!=''){
$longDescription=clean($_POST['longDescription']);
$shortDescription=clean($_POST['shortDescription']);
$sapCode=clean($_POST['sapCode']);
$materialTypeId=clean($_POST['materialTypeId']);
$dateAdded=time();

$namevalue ='longDescription="'.$longDescription.'",shortDescription="'.$shortDescription.'",sapCode="'.$sapCode.'",materialTypeId="'.$materialTypeId.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting('materialDescriptionMaster',$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php }


if(trim($_POST['action'])=='materialdescriptionmaster' && trim($_POST['editId'])!='' && trim($_POST['longDescription'])!='' && trim($_POST['module'])!=''){
$longDescription=clean($_POST['longDescription']);
$shortDescription=clean($_POST['shortDescription']);
$sapCode=clean($_POST['sapCode']);
$materialTypeId=clean($_POST['materialTypeId']);
$modifyDate=time();
$where='id='.decode($_POST['editId']).'';
$namevalue ='longDescription="'.$longDescription.'",shortDescription="'.$shortDescription.'",sapCode="'.$sapCode.'",materialTypeId="'.$materialTypeId.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('materialDescriptionMaster',$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>
<?php } ?>



<?php
/////////////////materal type Master///////////////////
if(trim($_POST['action'])=='materialtype' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$status=clean($_POST['status']);
$dateAdded=time();

$namevalue ='name="'.$name.'",description="'.$description.'",status="'.$status.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting('materialTypeMaster',$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php }


if(trim($_POST['action'])=='materialtype' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$status=clean($_POST['status']);
$modifyDate=time();
$where='id='.decode($_POST['editId']).'';
$namevalue ='name="'.$name.'",description="'.$description.'",status="'.$status.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('materialTypeMaster',$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>
<?php }  ?>


<?php

//add pattern
if(trim($_POST['action'])=='addpattern' && trim($_POST['editId'])!='' && trim($_POST['module'])!='' && ($_FILES['patternAttachment']!='' || $_POST['patternAttachmentEdit']!='')){
$patternDescription=clean($_POST['patternDescription']);


if($_FILES['patternAttachment']['name']!=''){
$file_name=$_FILES['patternAttachment']['name'];
$file_name=time().'-'.$file_name;
copy($_FILES['patternAttachment']['tmp_name'],"images/".$file_name);
}
else{
$file_name =$_POST['patternAttachmentEdit'];
}


$patternAddDate=time();
$patternAddedBy=$_SESSION['userid'];

$where='id="'.decode($_POST['editId']).'"';
$namevalue ='patternDescription="'.$patternDescription.'",patternAttachment="'.$file_name.'",patternAddDate="'.$patternAddDate.'",patternAddedBy="'.$patternAddedBy.'"';
$update = updatelisting(_QUERY_MASTER_,$namevalue,$where);

//add note of pattern uploaded
$styleassignment = 'styleId="'.decode($_POST['editId']).'",statusId=4,notes="'.$patternDescription.'",assignTo="'.$patternAddedBy.'",dateAdded="'.time().'"';
addlisting('styleAssignmentMaster',$styleassignment);


?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>
<?php }

/////////////////Employee Master///////////////////
if(trim($_POST['action'])=='employeemaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){

$name=clean($_POST['name']);
$empCode=clean($_POST['empCode']);
$empType=clean($_POST['empType']);
$designationId=clean($_POST['designationId']);
$email=clean($_POST['email']);
$phone=clean($_POST['phone']);
$address=clean($_POST['address']);
$countryId=clean($_POST['countryId']);
$stateId=clean($_POST['stateId']);
$cityId=clean($_POST['cityId']);
$pinCode=clean($_POST['pinCode']);
$workLocation = clean($_POST['workLocation']);
$status=clean($_POST['status']);
$reportingTo=clean($_POST['reportingTo']);
$dateAdded=time();

if(isset($_POST['categoryId'])){
	foreach($_POST['categoryId'] as $k1=>$v1){
		$categoryId .= $_POST['categoryId'][$k1].',';
	}
}
$categoryId = str_replace('Array','',$categoryId);

$namevalue ='name="'.$name.'",empCode="'.$empCode.'",empType="'.$empType.'",designationId="'.$designationId.'",email="'.$email.'",phone="'.$phone.'",address="'.$address.'",countryId="'.$countryId.'",stateId="'.$stateId.'",cityId="'.$cityId.'",pinCode="'.$pinCode.'",workLocation="'.$workLocation.'",status="'.$status.'",reportingTo="'.$reportingTo.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",categoryId="'.$categoryId.'"';
$adds = addlisting(_EMPLOYEE_MASTER_,$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php }


if(trim($_POST['action'])=='employeemaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$empCode=clean($_POST['empCode']);
$empType=clean($_POST['empType']);
$designationId=clean($_POST['designationId']);
$email=clean($_POST['email']);
$phone=clean($_POST['phone']);
$address=clean($_POST['address']);
$countryId=clean($_POST['countryId']);
$stateId=clean($_POST['stateId']);
$cityId=clean($_POST['cityId']);
$pinCode=clean($_POST['pinCode']);
$workLocation = clean($_POST['workLocation']);
$status=clean($_POST['status']);
$reportingTo=clean($_POST['reportingTo']);
$modifyDate=time();

if(isset($_POST['categoryId'])){
	foreach($_POST['categoryId'] as $k1=>$v1){
		$categoryId .= $_POST['categoryId'][$k1].',';
	}
}
$categoryId = str_replace('Array','',$categoryId);

$where='id='.decode($_POST['editId']).'';
$namevalue ='name="'.$name.'",empCode="'.$empCode.'",empType="'.$empType.'",designationId="'.$designationId.'",email="'.$email.'",phone="'.$phone.'",address="'.$address.'",countryId="'.$countryId.'",stateId="'.$stateId.'",cityId="'.$cityId.'",pinCode="'.$pinCode.'",workLocation="'.$workLocation.'",status="'.$status.'",reportingTo="'.$reportingTo.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'",categoryId="'.$categoryId.'"';
$update = updatelisting(_EMPLOYEE_MASTER_,$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>
<?php }


if(trim($_REQUEST['action'])=='deleteuseremail'){
echo $where='id='.decode($_REQUEST['did']).'';
die();
$namevalue ='deleteStatus="0"';
$update = updatelisting(_EMAIL_SETTING_MASTER_,$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=emailsetting');
</script>

<?php } ?>


<?php
//add new profile

if(trim($_POST['action'])=='profile' && trim($_POST['profileName'])!='' && trim($_POST['profileclone'])!='' && trim($_POST['editId'])==''){

$profileName=clean($_POST['profileName']);
$profileclone=clean(decode($_POST['profileclone']));
$profileDetails=clean($_POST['profileDetails']);
$superParentId=$loginusersuperParentId;
$dateAdded=time();
$s=1;
$namevalue ='profileName="'.$profileName.'",profileDetails="'.$profileDetails.'",modifyDate="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",userId="'.$loginusersuperParentId.'",dateAdded="'.$dateAdded.'"';
$add = addlisting(_PROFILE_MASTER_,$namevalue);

if($add=='yes'){
$select='id';
$where='userId="'.$loginusersuperParentId.'" and addedBy='.$_SESSION['userid'].' order by id desc';
$rs=GetPageRecord($select,_PROFILE_MASTER_,$where);
$userdetails=mysqli_fetch_array($rs);


$select='*';
$where='profileId = "'.$profileclone.'" order by id asc';
$rs=GetPageRecord($select,_PERMISSION_MASTER_,$where);
while($permissoinlists=mysqli_fetch_array($rs)){


$namevalue ='profileId='.$userdetails['id'].',moduleId='.$permissoinlists['moduleId'].',view='.$permissoinlists['view'].',edit='.$permissoinlists['edit'].',import='.$permissoinlists['import'].',export='.$permissoinlists['export'].',dlt='.$permissoinlists['dlt'].',addentry='.$permissoinlists['addentry'].'';
addlisting(_PERMISSION_MASTER_,$namevalue);
}

generateLogs('profile','add',$userdetails['id']);

  ?>

<script>

parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');

</script>

<?php

 exit();

}

}

?>



<?php
if(trim($_POST['action'])=='profile' && trim($_POST['profileName'])!='' && trim($_POST['editid'])!=''){

$profileName=clean($_POST['profileName']);
$editid=decode(clean($_POST['editid']));
$profileclone=clean(decode($_POST['profileclone']));
$profileDetails=clean($_POST['profileDetails']);
$superParentId=$loginusersuperParentId;
$dateAdded=time();


$where='id="'.decode($_POST['editid']).'" and userId='.$loginusersuperParentId.'';

$namevalue ='profileName="'.$profileName.'",profileDetails="'.$profileDetails.'",modifyBy="'.$_SESSION['userid'].'",modifyDate="'.$dateAdded.'"';

$update = updatelisting(_PROFILE_MASTER_,$namevalue,$where);

if($update=='yes'){

}

 generateLogs('profile','update',$editid);

  ?>

<script>

parent.setupbox('showpage.crm?module=profile&alt=2');

</script>

<?php

 exit();

}



?>


<?php
//add role master

if(trim($_POST['action'])=='role' && trim($_POST['name'])!='' && trim($_POST['editId'])==''){

$name=clean($_POST['name']);
$roleDetails=($_POST['roleDetails']);
$parentId=($_POST['parentId']);
$dateAdded=time();
$modifyDate=time();

$namevalue ='name="'.$name.'",roleDetails="'.$roleDetails.'",parentId="'.$parentId.'",userId="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting(_ROLE_MASTER_,$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php } ?>


<?php

//edit profile
if(trim($_POST['action'])=='profile' && trim($_POST['profileName'])!='' && trim($_POST['profileDetails'])!='' && trim($_POST['editId'])!=''){

$name=clean($_POST['name']);
$roleDetails=($_POST['roleDetails']);
$parentId=($_POST['parentId']);
$dateAdded=time();
$modifyDate=time();


$where='id='.decode($_POST['editId']).'';
$namevalue ='name="'.$name.'",roleDetails="'.$roleDetails.'",parentId="'.$parentId.'",userId="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting(_ROLE_MASTER_,$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>

<?php } ?>


<?php
if(trim($_REQUEST['editid'])!='' && trim($_REQUEST['moduleId'])!='' && trim($_REQUEST['btnid'])!='' && trim($_REQUEST['action'])=='profilepermission' && trim($_REQUEST['pagepermission'])!=''){

$editid=decode($_REQUEST['editid']);

$moduleId=decode($_REQUEST['moduleId']);

$btnid=$_REQUEST['btnid'];

$pagepermission=$_REQUEST['pagepermission'];

$select=$pagepermission;

$where='profileId='.$editid.' and moduleId='.$moduleId.'';

$rs=GetPageRecord($select,_PERMISSION_MASTER_,$where);

$modedetails=mysqli_fetch_array($rs);

if($pagepermission=='view'){

if($modedetails['view']==1){

$namevalue ='view=0';

  ?>

<script>

$("#<?php echo $btnid; ?>").attr("class", "switchouter switchouteroff");

</script>

<?php

} else {

$namevalue ='view=1';  ?>

<script>

$("#<?php echo $btnid; ?>").attr("class", "switchouter switchouteron");

</script>

<?php

}

}



if($pagepermission=='addentry'){

if($modedetails['addentry']==1){

$namevalue ='addentry=0';

  ?>

<script>

$("#<?php echo $btnid; ?>").attr("class", "switchouter switchouteroff");

</script>

<?php

} else {

$namevalue ='addentry=1';  ?>

<script>

$("#<?php echo $btnid; ?>").attr("class", "switchouter switchouteron");

</script>

<?php

}

}

if($pagepermission=='edit'){

if($modedetails['edit']==1){

$namevalue ='edit=0';

  ?>

<script>

$("#<?php echo $btnid; ?>").attr("class", "switchouter switchouteroff");

</script>

<?php

} else {

$namevalue ='edit=1';  ?>

<script>

$("#<?php echo $btnid; ?>").attr("class", "switchouter switchouteron");

</script>

<?php

}}

if($pagepermission=='dlt'){

if($modedetails['dlt']==1){

$namevalue ='dlt=0';

 ?>

<script>

$("#<?php echo $btnid; ?>").attr("class", "switchouter switchouteroff");

</script>

<?php

} else {

$namevalue ='dlt=1';  ?>

<script>

$("#<?php echo $btnid; ?>").attr("class", "switchouter switchouteron");

</script>

<?php

}

}

if($pagepermission=='import'){

if($modedetails['import']==1){

$namevalue ='import=0';

 ?>

<script>

$("#<?php echo $btnid; ?>").attr("class", "switchouter switchouteroff");

</script>

<?php

} else {

$namevalue ='import=1';  ?>

<script>

$("#<?php echo $btnid; ?>").attr("class", "switchouter switchouteron");

</script>

<?php

} }

if($pagepermission=='export'){

if($modedetails['export']==1){

$namevalue ='export=0';

 ?>

<script>

$("#<?php echo $btnid; ?>").attr("class", "switchouter switchouteroff");

</script>

<?php

} else {

$namevalue ='export=1';  ?>

<script>

$("#<?php echo $btnid; ?>").attr("class", "switchouter switchouteron");

</script>

<?php

}

}

$where='profileId='.$editid.' and moduleId='.$moduleId.'';

$update = updatelisting(_PERMISSION_MASTER_,$namevalue,$where);

}








if(trim($_REQUEST['action'])=='changepermission' && trim($_REQUEST['userId'])!='' && trim($_REQUEST['moduleId'])!='' && trim($_REQUEST['btnid'])!=''){

$userId=decode($_REQUEST['userId']);

$moduleId=decode($_REQUEST['moduleId']);

$btnid=$_REQUEST['btnid'];

$select='status';

$where='userId='.$userId.' and id='.$moduleId.'';

$rs=GetPageRecord($select,_USER_MODULE_MASTER_,$where);

$modedetails=mysqli_fetch_array($rs);

if($modedetails['status']==1){

$status=0; ?>

<script>

$("#<?php echo $btnid; ?>").attr("class", "switchouter switchouteroff");

</script>

<?php

} else {

$status=1; ?>

<script>

$("#<?php echo $btnid; ?>").attr("class", "switchouter switchouteron");

</script>

<?php

}

$namevalue ='status='.$status.'';

$where='userId="'.$userId.'" and id="'.$moduleId.'"';

$update = updatelisting(_USER_MODULE_MASTER_,$namevalue,$where);

}

if($_POST['action']=='complaintmaster' && trim($_POST['subject'])!='' && trim($_POST['description'])!='' && trim($_POST['styleId'])!=''){
$subject=clean($_POST['subject']);
$styleId=clean($_POST['styleId']);
$priority=clean($_POST['priority']);
$status=clean($_POST['status']);
$assignTo=clean($_POST['assignTo']);
$description=($_POST['description']);

$complaintDate=date("Y-m-d");

$dateAdded=time();

/*if(isset($_FILES['attachpostsubmit'])) {
if($_FILES['attachpostsubmit']['size'] < 20971520) {
$ext = substr($_FILES['attachpostsubmit']['name'], strrpos($_FILES['attachpostsubmit']['name'], '.') + 1);

if($ext=='jpg' || $ext=='jpeg' || $ext=='JPG' || $ext=='JPEG' || $ext=='png' || $ext=='PNG' || $ext=='GIF' || $ext=='gif' || $ext=='txt' || $ext=='psd' || $ext=='docx' || $ext=='doc' || $ext=='xlsx' || $ext=='xlsm' || $ext=='xls' || $ext=='pptx' || $ext=='pdf' || $ext=='PDF' || $ext=='ppt' || $ext=='zip'){

$file_name=$_FILES['attachpostsubmit']['name'];
$ext=getExtension($file_name);
$file_name=str_replace(".","",substr($file_name, 0, strpos($file_name, '.')));
$file_name2=str_replace(" ","",$file_name.'-'.$datef).'.'.$ext;
copy($_FILES['attachpostsubmit']['tmp_name'],"dirfiles/".$file_name2);
$finalefileName=$file_name2;
}
}
}*/


$namevalue ='subject="'.$subject.'",styleId="'.$styleId.'",priority="'.$priority.'",status="'.$status.'",assignTo="'.$assignTo.'",complaintDate="'.$complaintDate.'",description="'.$description.'",dateAdded="'.time().'",addedBy="'.$_SESSION['userid'].'"';
$lastid = addlistinggetlastid(_COMPLAINT_MASTER_,$namevalue);
 ?>
<script>
parent.setupbox('showpage.crm?module=complaintmaster&alt=1');
</script>

 <?php
 exit();

}

if($_POST['action']=='complaintremark' && trim($_POST['complaintId'])!=''  && trim($_POST['status'])!='' && trim($_POST['description'])!=''){

$complaintId=clean($_POST['complaintId']);
$description=clean($_POST['description']);
$status=clean($_POST['status']);
$feedback=clean($_POST['feedback']);
$dateAdded=time();
$complaintDate=date('Y-m-d');
$complaintcloseDate='';

if($status==3 || $status==1){
$namevalue ='complaintId="'.$complaintId.'",status="'.$status.'",complaintDate="'.$complaintDate.'",description="'.$description.'",dateAdded="'.time().'",addedBy="'.$_SESSION['userid'].'"';
}else{

$namevalue ='complaintId="'.$complaintId.'",status="'.$status.'",feedback="'.$feedback.'",complaintDate="'.$complaintDate.'",description="'.$description.'",dateAdded="'.time().'",addedBy="'.$_SESSION['userid'].'"';
 }
$lastid = addlistinggetlastid(_COMPLAINT_REMARK_MASTER_,$namevalue);

if($status==2){
$complaintcloseDate=date('Y-m-d');
$namevalue ='status="'.$status.'",complaintcloseDate="'.$complaintcloseDate.'",feedback="'.$feedback.'"';
$where='id="'.$complaintId.'"';
$update = updatelisting(_COMPLAINT_MASTER_,$namevalue,$where);

}


?>
<script>
parent.setupbox('showpage.crm?module=complaintmaster&view=yes&id=<?php echo encode($complaintId); ?>&alt=1');
</script>

 <?php
 exit();

}

/*if($_POST['action']=='styleteckpackimage' && trim($_POST['styleId'])!=''){
	while($valuesImage <= $_POST['imageCount']){
		$imageName=clean($_POST["imageName".$valuesImage]);

		$allvalueImage =' imageName="'.$imageName.'",styleId="'.decode($_POST['styleId']).'"';
		$add = addlisting('techPackImageMaster',$allvalueImage);

		 $valuesImage++;
	}
}
*/


?>


<?php
 /////////////////start techpackcategory master///////////////////
if(trim($_POST['action'])=='techpackcategorymaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$status=clean($_POST['status']);
$dateAdded=time();
$modifyDate=time();
$namevalue ='name="'.$name.'",status="'.$status.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$adds = addlisting(_TECHPACK_CATEGORY_MASTER_,$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php }

if(trim($_POST['action'])=='techpackcategorymaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$status=clean($_POST['status']);

$modifyDate=time();

$where='id='.decode($_POST['editId']).'';

$namevalue ='name="'.$name.'",status="'.$status.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting(_TECHPACK_CATEGORY_MASTER_,$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>

<?php } ?>



<?php
 /////////////////start techpack subcategory master///////////////////
if(trim($_POST['action'])=='techpacksubcategorymaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$techpackcategoryid=clean($_POST['techpackcategoryid']);
$name=clean($_POST['name']);
$status=clean($_POST['status']);
$dateAdded=time();
$modifyDate=time();
$namevalue ='name="'.$name.'",status="'.$status.'",techpackcategoryid="'.$techpackcategoryid.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';

$adds = addlisting(_TECHPACK_SUBCATEGORY_MASTER_,$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php } ?>

<?php
if(trim($_POST['action'])=='techpacksubcategorymaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$techpackcategoryid=clean($_POST['techpackcategoryid']);
$name=clean($_POST['name']);
$status=clean($_POST['status']);

$modifyDate=time();

$where='id='.decode($_POST['editId']).'';

$namevalue ='name="'.$name.'",status="'.$status.'",techpackcategoryid="'.$techpackcategoryid.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting(_TECHPACK_SUBCATEGORY_MASTER_,$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>

<?php } ?>


<?php
 /////////////////start measurementchart master///////////////////
if(trim($_POST['action'])=='measurementchartmaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$status=clean($_POST['status']);
$dateAdded=time();
$modifyDate=time();
$namevalue ='name="'.$name.'",status="'.$status.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';

$adds = addlisting(_MEASUREMENT_CHART_MASTER_,$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php } ?>

<?php
if(trim($_POST['action'])=='measurementchartmaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$status=clean($_POST['status']);

$modifyDate=time();

$where='id='.decode($_POST['editId']).'';

$namevalue ='name="'.$name.'",status="'.$status.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting(_MEASUREMENT_CHART_MASTER_,$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>

<?php } ?>



<?php
//add supplier table data
if(trim($_POST['action'])=='addsupplier' && trim($_POST['suppliername'])!='' && $_POST['editId']==''){
$supplierid=addslashes($_POST['supplierid']);
$suppliername=clean($_POST['suppliername']);
$email=clean($_POST['email']);
$phone=clean($_POST['phone']);
$address=clean($_POST['address']);
$countryId=clean($_POST['countryId']);
$stateId=clean($_POST['stateId']);
$cityId=clean($_POST['cityId']);

// use of implode
$string = $_POST['bomsubcategoryid'];
$str_arr = implode(",", $string);

$dateAdded=time();

$namevalue ='supplierId="'.$supplierid.'",name="'.$suppliername.'",email="'.$email.'",phone="'.$phone.'",address="'.$address.'",countryId="'.$countryId.'",stateId="'.$stateId.'",cityId="'.$cityId.'",bomsubcategoryid="'.$str_arr.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'",modifyBy="'.$_SESSION['userid'].'",modifyDate="'.$dateAdded.'"';
$adds = addlisting(_SUPPLIERS_MASTER_,$namevalue);
?>

<script>

parent.setupbox('showpage.crm?module=suppliers&alt=1');

</script>

<?php

}
?>

<?php
//edit supplier
if(trim($_POST['action'])=='editsupplier' && trim($_POST['suppliername'])!='' && $_POST['editId']!='' ){
$supplierid=addslashes($_POST['supplierid']);
$suppliername=clean($_POST['suppliername']);
$email=clean($_POST['email']);
$phone=clean($_POST['phone']);
$address=clean($_POST['address']);
$countryId=clean($_POST['countryId']);
$stateId=clean($_POST['stateId']);
$cityId=clean($_POST['cityId']);
$dateAdded=time();
$modifyDate=time();

// use of implode
$string = $_POST['bomsubcategoryid'];
$str_arr = implode(",", $string);

$where='id='.decode($_POST['editId']).'';
$namevalue ='supplierId="'.$supplierid.'",name="'.$suppliername.'",email="'.$email.'",phone="'.$phone.'",address="'.$address.'",countryId="'.$countryId.'",stateId="'.$stateId.'",cityId="'.$cityId.'",bomsubcategoryid="'.$str_arr.'",addedBy="'.$_SESSION['userid'].'",modifyBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'",modifyDate="'.$modifyDate.'"';
$update = updatelisting(_SUPPLIERS_MASTER_,$namevalue,$where);
?>

<script>
parent.setupbox('showpage.crm?module=suppliers&alt=2');
</script>

<?php

} ?>


<?php
//add and edit vendor code
if(trim($_POST['action'])=='addvendor' && trim($_POST['suppliername'])!='' && $_POST['editId']==''){
$supplierid=addslashes($_POST['supplierid']);
$suppliername=clean($_POST['suppliername']);
$email=clean($_POST['email']);
$phone=clean($_POST['phone']);
$address=clean($_POST['address']);
$countryId=clean($_POST['countryId']);
$stateId=clean($_POST['stateId']);
$cityId=clean($_POST['cityId']);
$dateAdded=time();

$namevalue ='supplierId="'.$supplierid.'",name="'.$suppliername.'",email="'.$email.'",phone="'.$phone.'",address="'.$address.'",countryId="'.$countryId.'",stateId="'.$stateId.'",cityId="'.$cityId.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'",modifyBy="'.$_SESSION['userid'].'",modifyDate="'.$dateAdded.'"';
$adds = addlisting(_VENDOR_MASTER_,$namevalue);
?>

<script>

parent.setupbox('showpage.crm?module=vendors&alt=1');

</script>

<?php

}
?>

<?php
//edit supplier
if(trim($_POST['action'])=='editvendor' && trim($_POST['suppliername'])!='' && $_POST['editId']!='' ){
$supplierid=addslashes($_POST['supplierid']);
$suppliername=clean($_POST['suppliername']);
$email=clean($_POST['email']);
$phone=clean($_POST['phone']);
$address=clean($_POST['address']);
$countryId=clean($_POST['countryId']);
$stateId=clean($_POST['stateId']);
$cityId=clean($_POST['cityId']);
$dateAdded=time();
$modifyDate=time();

$where='id='.decode($_POST['editId']).'';
$namevalue ='supplierId="'.$supplierid.'",name="'.$suppliername.'",email="'.$email.'",phone="'.$phone.'",address="'.$address.'",countryId="'.$countryId.'",stateId="'.$stateId.'",cityId="'.$cityId.'",addedBy="'.$_SESSION['userid'].'",modifyBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'",modifyDate="'.$modifyDate.'"';
$update = updatelisting(_VENDOR_MASTER_,$namevalue,$where);
?>

<script>
parent.setupbox('showpage.crm?module=vendors&alt=2');
</script>

<?php

}

if(trim($_POST['action'])=='assigntopattern' && $_POST['styleId']!='' ){
include "config/mail.php";
$styleId=decode($_POST['styleId']);
$assignTo=clean($_POST['assignTo']);
$notes=clean($_POST['notes']);
$dateAdded=time();

$whereCheck='styleId="'.$styleId.'" and statusId=3';
$checkCode = checkduplicate('styleAssignmentMaster',$whereCheck);

if($checkCode=='yes'){
$select='*';
$where='styleId="'.$styleId.'" and statusId=3';
$rs=GetPageRecord($select,'styleAssignmentMaster',$where);
while($resListing=mysqli_fetch_array($rs)){

$where1='id="'.$resListing['id'].'"';
$namevalue1 ='styleAssignTo=1';
$update1 = updatelisting('styleAssignmentMaster',$namevalue1,$where1);
}
}

$select12='*';
$where12='id="'.$styleId.'"';
$rs12=GetPageRecord($select12,_QUERY_MASTER_,$where12);
$listing12=mysqli_fetch_array($rs12);

$selectAdminMail='*';
$whereAdminMail='id=1';
$rsAdminMail=GetPageRecord($selectAdminMail,_USER_MASTER_,$whereAdminMail);
$adminEmail=mysqli_fetch_array($rsAdminMail);

$select1='*';
$where1='id="'.$assignTo.'"';
$rs1=GetPageRecord($select1,_USER_MASTER_,$where1);
$listing1=mysqli_fetch_array($rs1);


$mailbodyfooter = '</td>
  </tr>
      <tr>
    <td style="padding: 20px 10px; background: #f4f4f4;">
		  <p style="margin:0px;font-size:18px;padding:0 0 0 8px;    border-left: 3px solid #0d7544;height:25px;line-height:25px;color:#666">Details of the Style is as under:</p>
		 <div style="clear:both;padding:0;margin:10px 0 0 0;border:1px solid #f5f5f5;background:#fff">

	   <table width="100%" border="0" cellspacing="0" cellpadding="5" style="border: 0.5px solid #ccc;">

   <tr>
    <td style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Style</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">Style '.$listing12['subject'].'</td>
  </tr>
   <tr>
    <td style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Category</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.getCategoryName($listing12['categoryId']).'</td>
  </tr>
   <tr>
    <td style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Sub Category</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.getSubCategoryName($listing12['subCategoryId']).'</td>
  </tr>
  <tr>
    <td style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Season</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.getSeasonName($listing12['seasonId']).'</td>
  </tr>
  <tr>
    <td style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Received Date</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.date('d M, Y',$listing12['dateAdded']).'</td>
  </tr>

</table>
</div>
</td>
  </tr>
    <tr>

  </tr>
</tbody></table>';

$fromemail ='';
$mailto=$listing1['email'];
$ccmail='';
$mailsubject='Style '.$listing12['subject'].'';

$maildescription=' '.$mailbodyheader.'
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody><tr>
			 <td style="padding:19px 4px 0 4px;font-family:Arial,Helvetica,sans-serif">
				<p style="margin:0;font-size:15px;color:#333;padding:0 0 8px 6px;line-height:18px">Dear <strong>'.getUserName($listing1['id']).'</strong></p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Greeting from '.$systemname.' - The Apparel ERP! .</p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">An style #'.getStyleRefId($styleId).' is Assign to You for working please check the below detail:</p>
			</td>
        </tr>
      </tbody></table> '.$mailbodyfooter.'';

send_template_mail_query($fromemail,$mailto,$mailsubject,$maildescription,$ccmail);

$mailtoadmin=$adminEmail['email'];
$maildescriptionadmin=' '.$mailbodyheader.'
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody><tr>
			 <td style="padding:19px 4px 0 4px;font-family:Arial,Helvetica,sans-serif">
				<p style="margin:0;font-size:15px;color:#333;padding:0 0 8px 6px;line-height:18px">Dear <strong>'.getUserName($adminEmail['id']).'</strong></p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Greeting from '.$systemname.' - The Apparel ERP! .</p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">An style #'.getStyleRefId($styleId).' is Assign to '.getUserName($listing1['id']).'.</p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Please check the below detail:</p>
			</td>
        </tr>
      </tbody></table> '.$mailbodyfooter.'';

send_template_mail_query($fromemail,$mailtoadmin,$mailsubject,$maildescriptionadmin,$ccmail);

$mailtouser=$_SESSION['username'];
$mailDesuser=' '.$mailbodyheader.'
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody><tr>
			 <td style="padding:19px 4px 0 4px;font-family:Arial,Helvetica,sans-serif">
				<p style="margin:0;font-size:15px;color:#333;padding:0 0 8px 6px;line-height:18px">Dear <strong>'.getUserName($_SESSION['userid']).'</strong></p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Greeting from '.$systemname.' - The Apparel ERP! .</p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Style# '.getStyleRefId($styleId).' is Assign to '.getUserName($listing1['id']).'</p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Please check the below detail:</p>
			</td>
        </tr>
      </tbody></table> '.$mailbodyfooter.'';

send_template_mail_query($fromemail,$mailtouser,$mailsubject,$mailDesuser,$ccmail);


$descriptiontoQueryMailMaster=' '.$mailbodyheader.'
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody><tr>
			 <td style="padding:19px 4px 0 4px;font-family:Arial,Helvetica,sans-serif">
				<p style="margin:0;font-size:15px;color:#333;padding:0 0 8px 6px;line-height:18px">Dear <strong>Sir / Mam</strong></p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Greeting from '.$systemname.' - The Apparel ERP! .</p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Style# '.getStyleRefId($styleId).' is Assigned to '.getUserName($listing1['id']).'</p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Please check the below detail:</p>
			</td>
        </tr>
      </tbody></table> '.$mailbodyfooter.'';

$namevalue11 ='queryid="'.$styleId.'",subject="'.addslashes($mailsubject).'",description="'.addslashes($descriptiontoQueryMailMaster).'",multiemails="'.$ccmail.'",queryStatus=22222,adddate="'.date('Y-m-d H:i:s').'"';
$adds = addlisting(_QUERYMAILS_MASTER_,$namevalue11);

$namevalue ='styleId="'.$styleId.'",assignTo="'.$assignTo.'",notes="'.$notes.'",statusId=3,dateAdded="'.$dateAdded.'"';
$adds = addlisting('styleAssignmentMaster',$namevalue);
?>

<script>
parent.setupbox('showpage.crm?module=style&view=yes&id=<?php echo encode($styleId); ?>');
</script>

<?php
} ?>


<?php
//accept reject
if(trim($_POST['action'])=='acceptreject' && $_POST['styleId']!='' ){

$styleId=decode($_POST['styleId']);
$notes=clean($_POST['notes']);
$dateAdded=time();
$status=clean($_POST['status']);

$where1='id="'.decode($_POST['styleId']).'"';

if($status=='1') {
//if 2 then it is  a selected accepted query
$namevalue1 ='stylestatus="'.$status.'",finalstatus="2"';
$namevalue ='styleId="'.$styleId.'",notes="'.$notes.'",statusId=14,dateAdded="'.$dateAdded.'"';
$adds = addlisting('styleAssignmentMaster',$namevalue);
$update1 = updatelisting('queryMaster',$namevalue1,$where1);
} else{
$namevalue1 ='stylestatus="'.$status.'"';
$namevalue ='styleId="'.$styleId.'",notes="'.$notes.'",statusId=15,dateAdded="'.$dateAdded.'"';
$adds = addlisting('styleAssignmentMaster',$namevalue);
$update1 = updatelisting('queryMaster',$namevalue1,$where1);
}
?>
<script>
parent.setupbox('showpage.crm?module=style&view=yes&id=<?php echo encode($styleId); ?>');
</script>
<?php
} ?>


<?php
//assignmnet assign
if(trim($_POST['action'])=='waitingforassignment' && $_POST['styleId']!='' && $_POST['assignTo']!='' ){
include "config/mail.php";
$styleId=decode($_POST['styleId']);
$subject=clean($_POST['subject']);
$notes=clean($_POST['notes']);
$dateAdded=time();
$assignTo=clean($_POST['assignTo']);

if($_POST['pd']=='1'){
$statusId='18';

}else{
$statusId='2';
}

$select='*';
$where='id="'.$styleId.'"';
$rs=GetPageRecord($select,_QUERY_MASTER_,$where);
$listing=mysqli_fetch_array($rs);

$selectAdminMail='*';
$whereAdminMail='id=1';
$rsAdminMail=GetPageRecord($selectAdminMail,_USER_MASTER_,$whereAdminMail);
$adminEmail=mysqli_fetch_array($rsAdminMail);

$select1='*';
$where1='id="'.$assignTo.'"';
$rs1=GetPageRecord($select1,_USER_MASTER_,$where1);
$listing1=mysqli_fetch_array($rs1);



$fromemail ='';
$mailto=$listing1['email'];
$ccmail='';
$mailsubject='Style '.$listing['subject'].'';

$mailbodyfooter = '</td>
  </tr>
      <tr>
    <td style="padding: 20px 10px; background: #f4f4f4;">
		  <p style="margin:0px;font-size:18px;padding:0 0 0 8px;    border-left: 3px solid #0d7544;height:25px;line-height:25px;color:#666">Details of the Style is as under:</p>
		 <div style="clear:both;padding:0;margin:10px 0 0 0;border:1px solid #f5f5f5;background:#fff">

	   <table width="100%" border="0" cellspacing="0" cellpadding="5" style="border: 0.5px solid #ccc;">

   <tr>
    <td style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Style</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">Style '.$listing['subject'].'</td>
  </tr>
   <tr>
    <td style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Category</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.getCategoryName($listing['categoryId']).'</td>
  </tr>
   <tr>
    <td style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Sub Category</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.getSubCategoryName($listing['subCategoryId']).'</td>
  </tr>
  <tr>
    <td style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Season</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.getSeasonName($listing['seasonId']).'</td>
  </tr>
  <tr>
    <td style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Received Date</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.date('d M, Y',$listing['dateAdded']).'</td>
  </tr>

</table>
</div>
</td>
  </tr>
    <tr>

  </tr>
</tbody></table>';
//Mail sent to PD Head or Merchant
$maildescription=' '.$mailbodyheader.'
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody><tr>
			 <td style="padding:19px 4px 0 4px;font-family:Arial,Helvetica,sans-serif">
				<p style="margin:0;font-size:15px;color:#333;padding:0 0 8px 6px;line-height:18px">Dear <strong>'.getUserName($listing1['id']).'</strong></p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Greeting from '.$systemname.' - The Apparel ERP! .</p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">An style #'.getStyleRefId($styleId).' is Assign to You for working please check the below detail:</p>
			</td>
        </tr>
      </tbody></table> '.$mailbodyfooter.'';

send_template_mail_query($fromemail,$mailto,$mailsubject,$maildescription,$ccmail);

//Mail sent to admin

$mailtoadmin=$adminEmail['email'];
$maildescriptionadmin=' '.$mailbodyheader.'
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody><tr>
			 <td style="padding:19px 4px 0 4px;font-family:Arial,Helvetica,sans-serif">
				<p style="margin:0;font-size:15px;color:#333;padding:0 0 8px 6px;line-height:18px">Dear <strong>'.getUserName($adminEmail['id']).'</strong></p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Greeting from '.$systemname.' - The Apparel ERP! .</p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">An style #'.getStyleRefId($styleId).' is Assign to '.getUserName($listing1['id']).'.</p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Please check the below detail:</p>
			</td>
        </tr>
      </tbody></table> '.$mailbodyfooter.'';

send_template_mail_query($fromemail,$mailtoadmin,$mailsubject,$maildescriptionadmin,$ccmail);

$mailtouser=$_SESSION['username'];
$mailDesuser=' '.$mailbodyheader.'
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody><tr>
			 <td style="padding:19px 4px 0 4px;font-family:Arial,Helvetica,sans-serif">
				<p style="margin:0;font-size:15px;color:#333;padding:0 0 8px 6px;line-height:18px">Dear <strong>'.getUserName($_SESSION['userid']).'</strong></p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Greeting from '.$systemname.' - The Apparel ERP! .</p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Style# '.getStyleRefId($styleId).' is Assign to '.getUserName($listing1['id']).'</p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Please check the below detail:</p>
			</td>
        </tr>
      </tbody></table> '.$mailbodyfooter.'';

send_template_mail_query($fromemail,$mailtouser,$mailsubject,$mailDesuser,$ccmail);


$descriptiontoQueryMailMaster=' '.$mailbodyheader.'
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody><tr>
			 <td style="padding:19px 4px 0 4px;font-family:Arial,Helvetica,sans-serif">
				<p style="margin:0;font-size:15px;color:#333;padding:0 0 8px 6px;line-height:18px">Dear <strong>Sir / Mam</strong></p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Greeting from '.$systemname.' - The Apparel ERP! .</p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Style# '.getStyleRefId($styleId).' is Assigned to '.getUserName($listing1['id']).'</p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Please check the below detail:</p>
			</td>
        </tr>
      </tbody></table> '.$mailbodyfooter.'';

$namevalue11 ='queryid="'.$styleId.'",subject="'.addslashes($mailsubject).'",description="'.addslashes($descriptiontoQueryMailMaster).'",multiemails="'.$ccmail.'",queryStatus=22222,adddate="'.date('Y-m-d H:i:s').'"';
$adds = addlisting(_QUERYMAILS_MASTER_,$namevalue11);

$whereCheck='styleId="'.$styleId.'" and statusId="'.$statusId.'"';
$checkCode = checkduplicate('styleAssignmentMaster',$whereCheck);

if($checkCode=='yes'){
$select='*';
$where='styleId="'.$styleId.'" and statusId="'.$statusId.'"';
$rs=GetPageRecord($select,'styleAssignmentMaster',$where);
while($resListing=mysqli_fetch_array($rs)){

$where1='id="'.$resListing['id'].'"';
$namevalue1 ='styleAssignTo=1';
$update1 = updatelisting('styleAssignmentMaster',$namevalue1,$where1);
}
}

$namevalue ='styleId="'.$styleId.'",notes="'.$notes.'",assignTo="'.$assignTo.'",statusId="'.$statusId.'",dateAdded="'.$dateAdded.'"';
$adds = addlisting('styleAssignmentMaster',$namevalue);

$where1='id="'.decode($_POST['styleId']).'"';
$namevalue1 ='assignTo="'.$assignTo.'"';
$update1 = updatelisting('queryMaster',$namevalue1,$where1);

?>

<script>
parent.setupbox('showpage.crm?module=style&view=yes&id=<?php echo encode($styleId); ?>');
</script>

<?php
} ?>


<?php
if(trim($_POST['action'])=='assigntomarker' && $_POST['styleId']!='' && $_POST['assignTo']!=''){
include "config/mail.php";
$styleId=decode($_POST['styleId']);
$assignTo=clean($_POST['assignTo']);
$notes=clean($_POST['notes']);
$dateAdded=time();

$whereCheck='styleId="'.$styleId.'" and statusId=5';
$checkCode = checkduplicate('styleAssignmentMaster',$whereCheck);

if($checkCode=='yes'){
$select='*';
$where='styleId="'.$styleId.'" and statusId=5';
$rs=GetPageRecord($select,'styleAssignmentMaster',$where);
while($resListing=mysqli_fetch_array($rs)){

$where1='id="'.$resListing['id'].'"';
$namevalue1 ='styleAssignTo=1';
$update1 = updatelisting('styleAssignmentMaster',$namevalue1,$where1);
}
}

$select12='*';
$where12='id="'.$styleId.'"';
$rs12=GetPageRecord($select12,_QUERY_MASTER_,$where12);
$listing12=mysqli_fetch_array($rs12);

$selectAdminMail='*';
$whereAdminMail='id=1';
$rsAdminMail=GetPageRecord($selectAdminMail,_USER_MASTER_,$whereAdminMail);
$adminEmail=mysqli_fetch_array($rsAdminMail);

$select1='*';
$where1='id="'.$assignTo.'"';
$rs1=GetPageRecord($select1,_USER_MASTER_,$where1);
$listing1=mysqli_fetch_array($rs1);


$mailbodyfooter = '</td>
  </tr>
      <tr>
    <td style="padding: 20px 10px; background: #f4f4f4;">
		  <p style="margin:0px;font-size:18px;padding:0 0 0 8px;    border-left: 3px solid #0d7544;height:25px;line-height:25px;color:#666">Details of the Style is as under:</p>
		 <div style="clear:both;padding:0;margin:10px 0 0 0;border:1px solid #f5f5f5;background:#fff">

	   <table width="100%" border="0" cellspacing="0" cellpadding="5" style="border: 0.5px solid #ccc;">

   <tr>
    <td style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Style</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">Style '.$listing12['subject'].'</td>
  </tr>
   <tr>
    <td style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Category</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.getCategoryName($listing12['categoryId']).'</td>
  </tr>
   <tr>
    <td style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Sub Category</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.getSubCategoryName($listing12['subCategoryId']).'</td>
  </tr>
  <tr>
    <td style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Season</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.getSeasonName($listing12['seasonId']).'</td>
  </tr>
  <tr>
    <td style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Received Date</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.date('d M, Y',$listing12['dateAdded']).'</td>
  </tr>

</table>
</div>
</td>
  </tr>
    <tr>

  </tr>
</tbody></table>';

$fromemail ='';
$mailto=$listing1['email'];
$ccmail='';
$mailsubject='Style '.$listing12['subject'].'';

$maildescription=' '.$mailbodyheader.'
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody><tr>
			 <td style="padding:19px 4px 0 4px;font-family:Arial,Helvetica,sans-serif">
				<p style="margin:0;font-size:15px;color:#333;padding:0 0 8px 6px;line-height:18px">Dear <strong>'.getUserName($listing1['id']).'</strong></p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Greeting from '.$systemname.' - The Apparel ERP! .</p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">An style #'.getStyleRefId($styleId).' is Assign to You for working please check the below detail:</p>
			</td>
        </tr>
      </tbody></table> '.$mailbodyfooter.'';

send_template_mail_query($fromemail,$mailto,$mailsubject,$maildescription,$ccmail);

$mailtoadmin=$adminEmail['email'];
$maildescriptionadmin=' '.$mailbodyheader.'
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody><tr>
			 <td style="padding:19px 4px 0 4px;font-family:Arial,Helvetica,sans-serif">
				<p style="margin:0;font-size:15px;color:#333;padding:0 0 8px 6px;line-height:18px">Dear <strong>'.getUserName($adminEmail['id']).'</strong></p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Greeting from '.$systemname.' - The Apparel ERP! .</p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">An style #'.getStyleRefId($styleId).' is Assign to '.getUserName($listing1['id']).'.</p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Please check the below detail:</p>
			</td>
        </tr>
      </tbody></table> '.$mailbodyfooter.'';

send_template_mail_query($fromemail,$mailtoadmin,$mailsubject,$maildescriptionadmin,$ccmail);

$mailtouser=$_SESSION['username'];
$mailDesuser=' '.$mailbodyheader.'
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody><tr>
			 <td style="padding:19px 4px 0 4px;font-family:Arial,Helvetica,sans-serif">
				<p style="margin:0;font-size:15px;color:#333;padding:0 0 8px 6px;line-height:18px">Dear <strong>'.getUserName($_SESSION['userid']).'</strong></p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Greeting from '.$systemname.' - The Apparel ERP! .</p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Style# '.getStyleRefId($styleId).' is Assign to '.getUserName($listing1['id']).'</p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Please check the below detail:</p>
			</td>
        </tr>
      </tbody></table> '.$mailbodyfooter.'';

send_template_mail_query($fromemail,$mailtouser,$mailsubject,$mailDesuser,$ccmail);

//Mail save in query mail master
$descriptiontoQueryMailMaster=' '.$mailbodyheader.'
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody><tr>
			 <td style="padding:19px 4px 0 4px;font-family:Arial,Helvetica,sans-serif">
				<p style="margin:0;font-size:15px;color:#333;padding:0 0 8px 6px;line-height:18px">Dear <strong>Sir / Mam</strong></p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Greeting from '.$systemname.' - The Apparel ERP! .</p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Style# '.getStyleRefId($styleId).' is Assigned to '.getUserName($listing1['id']).'</p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Please check the below detail:</p>
			</td>
        </tr>
      </tbody></table> '.$mailbodyfooter.'';

$namevalue11 ='queryid="'.$styleId.'",subject="'.addslashes($mailsubject).'",description="'.addslashes($descriptiontoQueryMailMaster).'",multiemails="'.$ccmail.'",queryStatus=22222,adddate="'.date('Y-m-d H:i:s').'"';
$adds = addlisting(_QUERYMAILS_MASTER_,$namevalue11);



$namevalue ='styleId="'.$styleId.'",assignTo="'.$assignTo.'",notes="'.$notes.'",statusId=5,dateAdded="'.$dateAdded.'"';
$adds = addlisting('styleAssignmentMaster',$namevalue);
?>

<script>
parent.setupbox('showpage.crm?module=style&view=yes&id=<?php echo encode($styleId); ?>');
</script>

<?php
}

?>


<?php
//add notes block
if(trim($_POST['action'])=='addnotes' && $_POST['styleId']!='' && $_POST['notes']!=''){

$styleId=decode($_POST['styleId']);
$notes=clean($_POST['notes']);
$dateAdded=time();


$namevalue ='styleId="'.$styleId.'",notes="'.$notes.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting('styleAssignmentMaster',$namevalue);
?>

<script>
parent.setupbox('showpage.crm?module=style&view=yes&id=<?php echo encode($styleId); ?>');
</script>

<?php
}

?>


<?php
//Style mail reply
if(trim($_POST['action'])=='stylemailreply' && $_POST['styleid']!='' && $_POST['description']!=''){
include "config/mail.php";

$select='*';
$id=clean($_POST['styleid']);
$where='id='.$id.'';
$rs=GetPageRecord($select,_QUERY_MASTER_,$where);
$resultpage=mysqli_fetch_array($rs);

$styleId=addslashes($_POST['styleid']);
$subject='#'.addslashes($resultpage['subject']);
$description=addslashes($_POST['description']);
$ccmail=addslashes($_POST['ccmail']);
$sendstatus='22222';
//send mail reply
$select1='*';
$id1=$resultpage['assignTo'];
$where1='id='.$id1.'';
$rs1=GetPageRecord($select1,'userMaster',$where1);
$resultpage1=mysqli_fetch_array($rs1);
$fromemail='';
$mailto=$resultpage1['email'];
$ccmail=$ccmail;
$mailsubject=$subject;
$maildescription=$description;

send_template_mail_query($fromemail,$mailto,$mailsubject,$maildescription,$ccmail);


$namevalue ='queryid="'.$styleId.'",subject="'.$subject.'",description="'.$description.'",multiemails="'.$ccmail.'",queryStatus="'.$sendstatus.'",adddate="'.date('Y-m-d H:i:s').'"';
$adds = addlisting(_QUERYMAILS_MASTER_,$namevalue);

?>

<script>
parent.setupbox('showpage.crm?module=style&view=yes&id=<?php echo encode($_POST['styleid']) ?>');
</script>

<?php
}

?>



<?php
//compose mail
if($_REQUEST['action']=='composemail' && $_REQUEST['sendstatus']=='11111' && $_REQUEST['subject']!='' && $_REQUEST['tomail']!=''){
include "config/mail.php";
$fromMail=addslashes($_POST['fromMail']);
$tomail=addslashes($_POST['tomail']);
$subject=addslashes($_POST['subject']);
$description=addslashes($_POST['description']);
$sendstatus= addslashes($_REQUEST['sendstatus']);

$namevalue ='subject="'.$subject.'",description="'.$description.'",queryStatus="'.$sendstatus.'",adddate="'.date('Y-m-d H:i:s').'",fromMail="'.$fromMail.'",multiemails="'.$tomail.'"';
$adds = addlisting(_QUERYMAILS_MASTER_,$namevalue);

$fromemail=$fromMail;
$mailto=$tomail;
$ccmail='';
$mailsubject=$subject;
$maildescription=$description;

send_template_mail_query($fromemail,$mailto,$mailsubject,$maildescription,$ccmail);

?>

<script>
parent.setupbox('showpage.crm?module=mail&status=1');
</script>

<?php  }
?>


<?php
//assign to purchase
if($_REQUEST['action']=='assigntopurchase' && $_REQUEST['assignToMaterial']!='' && $_REQUEST['assignto']!=''){
$description = $_POST['description'];

$costsheetversionid =$_POST['costsheetversionid'];
$assignto = $_POST['assignto'];
$assignto = implode(",", $assignto);

$assignToMaterial2 = $_POST['assignToMaterial'];
$assignToMaterial1 = implode(",", $assignToMaterial2);
$assignToMaterial = rtrim($assignToMaterial1,',');

$array =  explode(',', $assignToMaterial);


foreach($array as $id) {
	$where1='id="'.$id.'"';
	$namevalue1 ='assignTo="'.$assignto.'",costsheetVersionId="'.$costsheetversionid.'"';
    $update1 = updatelisting('styleSubCategoryMaster',$namevalue1,$where1);
}
?>
<script>
parent.reload_page();
</script>



<?php
}

//assign to purchase merchant
if($_REQUEST['action']=='assigntopurchasemerchant' && $_REQUEST['assignToMaterial']!='' && $_REQUEST['assigntopurchasemerchant']!=''){
$description = $_POST['description'];

$costsheetversionid =$_POST['costsheetversionid'];
$assigntopurchasemerchant = $_POST['assigntopurchasemerchant'];
$assignto = implode(",", $assigntopurchasemerchant);

$assignToMaterial2 = $_POST['assignToMaterial'];
$assignToMaterial1 = implode(",", $assignToMaterial2);
$assignToMaterial = rtrim($assignToMaterial1,',');

$array =  explode(',', $assignToMaterial);


foreach($array as $id) {
	$where1='id="'.$id.'"';
	$namevalue1 ='assignToPurMerchant="'.$assignto.'",costsheetVersionId="'.$costsheetversionid.'"';
    $update1 = updatelisting('styleSubCategoryMaster',$namevalue1,$where1);
}
?>
<script>
parent.reload_page();
</script>



<?php
}

?>


<?php
//assign to purchase
if(trim($_REQUEST['action'])=='assigntopurchasestatus' && $_REQUEST['styleId']!=''){

$styleId=decode($_REQUEST['styleId']);
$notes=clean($_REQUEST['description']);
$dateAdded=time();

$namevalue ='styleId="'.$styleId.'",notes="'.$notes.'",assignTo="'.$_SESSION['userid'].'",statusId=16,dateAdded="'.$dateAdded.'"';
$adds = addlisting('styleAssignmentMaster',$namevalue);

$where1='id="'.decode($_POST['styleId']).'"';
$namevalue1 ='materialsheetassignTo="'.$_SESSION['userid'].'",materialsheetdateAdded="'.$dateAdded.'"';
$update1 = updatelisting('queryMaster',$namevalue1,$where1);

?>

<script>
parent.setupbox('showpage.crm?module=style&view=yes&id=<?php echo encode($styleId); ?>');
</script>

<?php
} ?>


<?php
//estimate cost sheet status
if(trim($_REQUEST['action'])=='estimatecostsheet' && $_REQUEST['styleId']!=''){
$styleId=decode($_REQUEST['styleId']);
$notes=clean($_REQUEST['description']);
$dateAdded=time();

$namevalue ='styleId="'.$styleId.'",notes="'.$notes.'",assignTo="'.$_SESSION['userid'].'",statusId=17,dateAdded="'.$dateAdded.'"';
$adds = addlisting('styleAssignmentMaster',$namevalue);

$where1='id="'.decode($_POST['styleId']).'"';
$namevalue1 ='costsheetassignTo="'.$_SESSION['userid'].'",costsheetdateAdded="'.$dateAdded.'"';
$update1 = updatelisting('queryMaster',$namevalue1,$where1);

?>

<script>
parent.setupbox('showpage.crm?module=style&view=yes&id=<?php echo encode($styleId); ?>');
</script>

<?php
} ?>

<?php
 /////////////////start unit Master///////////////////
if(trim($_POST['action'])=='unitmaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!='' && trim($_POST['materialType'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$materialType=clean($_POST['materialType']);
$status=clean($_POST['status']);

$dateAdded=time();
$namevalue ='name="'.$name.'",materialtype="'.$materialType.'",status="'.$status.'",description="'.$description.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$dateAdded.'",modifyBy="'.$_SESSION['userid'].'"';
$adds = addlisting('unitMaster',$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php } ?>


<?php
//edit unit master

if(trim($_POST['action'])=='unitmaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!='' && trim($_POST['materialType'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$materialType=clean($_POST['materialType']);
$status=clean($_POST['status']);
$modifyDate=time();
$where='id="'.decode($_POST['editId']).'"';
$namevalue ='name="'.$name.'",materialtype="'.$materialType.'",status="'.$status.'",description="'.$description.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';

$update = updatelisting('unitMaster',$namevalue,$where);


?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>

<?php } ?>




<?php
 /////////////////start extra charges Master///////////////////
if(trim($_POST['action'])=='chargestype' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$status=clean($_POST['status']);
$dateAdded=time();
$namevalue ='name="'.$name.'",description="'.$description.'",status="'.$status.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$dateAdded.'",modifyBy="'.$_SESSION['userid'].'"';
$adds = addlisting('chargesTypeMaster',$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php } ?>


<?php
//edit extra charges master
if(trim($_POST['action'])=='chargestype' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$status=clean($_POST['status']);
$modifyDate=time();
$where='id="'.decode($_POST['editId']).'"';
$namevalue ='name="'.$name.'",description="'.$description.'",status="'.$status.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';

$update = updatelisting('chargesTypeMaster',$namevalue,$where);


?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>

<?php } ?>




<?php
 /////////////////start charges Master///////////////////
if(trim($_POST['action'])=='chargesmaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!='' && trim($_POST['chargestype'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$status=clean($_POST['status']);
$chargestype=clean($_POST['chargestype']);
$dateAdded=time();
$namevalue ='name="'.$name.'",description="'.$description.'",chargestype="'.$chargestype.'",status="'.$status.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$dateAdded.'",modifyBy="'.$_SESSION['userid'].'"';
$adds = addlisting('chargesMaster',$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php } ?>


<?php
//edit charges master
if(trim($_POST['action'])=='chargesmaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!='' && trim($_POST['chargestype'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$status=clean($_POST['status']);
$chargestype=clean($_POST['chargestype']);
$modifyDate=time();
$where='id="'.decode($_POST['editId']).'"';
$namevalue ='name="'.$name.'",description="'.$description.'",chargestype="'.$chargestype.'",status="'.$status.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('chargesMaster',$namevalue,$where);


?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>

<?php }




if(trim($_POST['action'])=='materialcostchat' && trim($_POST['editId'])!='' && (trim($_POST['comment'])!='' || $_POST['productstatus']!='')){

$editId=clean(decode($_POST['editId']));
$bomSerialNo=clean($_POST['bomSerialNo']);
$materialType=clean($_POST['materialType']);
$materialId=clean($_POST['materialId']);
$comment=clean($_POST['comment']);
$status=clean($_POST['status']);
$costversionid=$_POST['costversionid'];
$id=$_POST['id'];
$commnetType=$_POST['commnetType'];
//for assign to and approve
$approvedStatus=$_POST['productstatus'];


$assigedTo=$_POST['assignTo'];

$timeSlot=$_POST['timeSlot'];

$fortTimeSlot=$_POST['fortTimeSlot'];

$dateAdded=time();


$whereCheck='styleId="'.$editId.'" and materialId="'.$materialId.'" and commnetType="'.$commnetType.'"';
$checkCode = checkduplicate('materialCostChatMaster',$whereCheck);

if($checkCode=='yes'){
$select='*';
$where='styleId="'.$editId.'" and materialId="'.$materialId.'" and commnetType="'.$commnetType.'"';
$rs=GetPageRecord($select,'materialCostChatMaster',$where);
while($resListing=mysqli_fetch_array($rs)){

$where1='id="'.$resListing['id'].'"';
$namevalue1 ='materialFinalStatus=0';



$update1 = updatelisting('materialCostChatMaster',$namevalue1,$where1);
}
}

if($_POST['QualityCheckUncheck']=='' && $_POST['PriceCheckUncheck']=='' && $_POST['VendorCheckUncheck']==''){
$namevalue ='styleId="'.$editId.'",bomSerialNo="'.$bomSerialNo.'",materialType="'.$materialType.'",materialId="'.$materialId.'",comment="'.$comment.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'",commnetType="'.$_REQUEST['commnetType'].'",approvedStatus="'.$approvedStatus.'",assigedTo="'.$assigedTo.'",scheduleId="'.$timeSlot.'"';
$adds = addlistinggetlastid('materialCostChatMaster',$namevalue);
}

if($_REQUEST['commnetType']=='0'){
$heading='Comments';
}
if($_REQUEST['commnetType']=='1'){
$heading='Quality';
}
if($_REQUEST['commnetType']=='2'){
$heading='Price';
}
if($_REQUEST['commnetType']=='3'){
$heading='Vendor';
}


if($approvedStatus=='1'){
$changeQPVStatus='Approved';
$backcolor='#66bb6a !important';
}
if($approvedStatus=='2'){
$changeQPVStatus='Assigned';
$backcolor='#26c6da !important';
}
if($approvedStatus=='3'){
$changeQPVStatus='Pending For Approvel';
$backcolor='#ffc803 !important';
}
if($approvedStatus=='4'){
$changeQPVStatus='Rejected';
$backcolor='#ff0000 !important';
}
if($approvedStatus=='5'){
$changeQPVStatus='Pending';
$backcolor='#5c6bc0 !important';
}

?>


<?php
//quality all select
if($_POST['QualityCheckUncheck']!='' || $_POST['PriceCheckUncheck']!='' || $_POST['VendorCheckUncheck']!=''){
$QualityCheckUncheck=$_POST['QualityCheckUncheck'];
$PriceCheckUncheck=$_POST['PriceCheckUncheck'];
$VendorCheckUncheck=$_POST['VendorCheckUncheck'];

if(isset($_POST['QualityCheckUncheck'])){
$qualitypricevendor = rtrim($QualityCheckUncheck,',');
}
if(isset($_POST['PriceCheckUncheck'])){
$qualitypricevendor = rtrim($PriceCheckUncheck,',');
}
if(isset($_POST['VendorCheckUncheck'])){
$qualitypricevendor = rtrim($VendorCheckUncheck,',');
}

$arrayyyy =  explode(",", rtrim($qualitypricevendor,","));

foreach($arrayyyy as $materiallid) {


$whereCheck='styleId="'.$editId.'" and materialId="'.$materiallid.'" and commnetType="'.$commnetType.'"';
$checkCode = checkduplicate('materialCostChatMaster',$whereCheck);

if($checkCode=='yes'){
$select='*';
$where='styleId="'.$editId.'" and materialId="'.$materiallid.'" and commnetType="'.$commnetType.'"';
$rs=GetPageRecord($select,'materialCostChatMaster',$where);
while($resListing=mysqli_fetch_array($rs)){

$where1='id="'.$resListing['id'].'"';
$namevalue1 ='materialFinalStatus=0';



$update1 = updatelisting('materialCostChatMaster',$namevalue1,$where1);
}
}




$selecta='sr';
$wherea='styleId="'.$editId.'" and id="'.$materiallid.'" and costsheetVersionId="'.$costversionid.'"';
$rsa=GetPageRecord($selecta,'styleSubCategoryMaster',$wherea);
$resListinga=mysqli_fetch_array($rsa);
?>


<?php
$namevalue1 ='styleId="'.$editId.'",bomSerialNo="'.$resListinga['sr'].'",materialType="'.$materialType.'",materialId="'.$materiallid.'",comment="'.$comment.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'",commnetType="'.$_REQUEST['commnetType'].'",approvedStatus="'.$approvedStatus.'",assigedTo="'.$assigedTo.'",scheduleId="'.$timeSlot.'"';
$adds1 = addlistinggetlastid('materialCostChatMaster',$namevalue1);

?>
<script>
parent.load_bom_list_fun<?php echo $costversionid; ?>();
parent.tabhideshow<?php echo $materialType; ?><?php echo $costversionid; ?>();
</script>
<?php

}

}
//end all
?>



<?php  if($_REQUEST['commnetType']=='0'){ ?>
<script>
var abc= parent.document.getElementById('messagevalcount<?php echo $bomSerialNo; ?><?php echo $costversionid; ?>').innerText;
var finalcommetcount =Number(abc)+1;
parent.document.getElementById('messagevalcount<?php echo $bomSerialNo; ?><?php echo $costversionid; ?>').innerHTML= finalcommetcount;
</script>
<?php } ?>

<?php if($_POST['QualityCheckUncheck']==''){ ?>

<?php  if($_REQUEST['commnetType']=='1'){ ?>
<script>
var abc= parent.document.getElementById('qtyStatus<?php echo $bomSerialNo; ?><?php echo $costversionid; ?>').innerText;
var finalcommetcount ='<?php echo $changeQPVStatus; ?>';
var backcolor='<?php echo $backcolor; ?>';
parent.document.getElementById('qtyStatus<?php echo $bomSerialNo; ?><?php echo $costversionid; ?>').innerHTML= finalcommetcount;
parent.$('#qtyStatus<?php echo $bomSerialNo; ?><?php echo $costversionid; ?>').css('background-color',backcolor);
</script>
<?php }   ?>

<?php  if($_REQUEST['commnetType']=='2'){ ?>
<script>
var abc= parent.document.getElementById('priceStatus<?php echo $bomSerialNo; ?><?php echo $costversionid; ?>').innerText;
var finalcommetcount ='<?php echo $changeQPVStatus; ?>';
var backcolor='<?php echo $backcolor; ?>';
parent.document.getElementById('priceStatus<?php echo $bomSerialNo; ?><?php echo $costversionid; ?>').innerHTML= finalcommetcount;
parent.$('#priceStatus<?php echo $bomSerialNo; ?><?php echo $costversionid; ?>').css('background-color',backcolor);
</script>
<?php } ?>

<?php if($_REQUEST['commnetType']=='3'){ ?>
<script>
var abc= parent.document.getElementById('vendorStatus<?php echo $bomSerialNo; ?><?php echo $costversionid; ?>').innerText;
var finalcommetcount ='<?php echo $changeQPVStatus; ?>';
var backcolor='<?php echo $backcolor; ?>';
parent.document.getElementById('vendorStatus<?php echo $bomSerialNo; ?><?php echo $costversionid; ?>').innerHTML= finalcommetcount;
parent.$('#vendorStatus<?php echo $bomSerialNo; ?><?php echo $costversionid; ?>').css('background-color',backcolor);
</script>
<?php } ?>

<?php } ?>

<?php  if($_REQUEST['commnetType']=='0'){ ?>
<script>
parent.opmodalpop('<?php echo $heading; ?>','modalpop.php?action=materialcostchat&styleId=<?php echo $_POST['editId']; ?>&srno=<?php echo $bomSerialNo; ?>&materialType=<?php echo $materialType; ?>&materialId=<?php echo $materialId; ?>&costversionid=<?php echo $costversionid; ?>&commnetType=<?php echo $_REQUEST['commnetType']; ?>&n=<?php echo $adds; ?>&id=<?php echo $id; ?>&fortTimeSlot=<?php echo $fortTimeSlot; ?>','600px','auto');
</script>
<?php } else { ?>
<script>
parent.$('#modalpop').modal('hide');
parent.$('body').removeClass('modal-open');
parent.$('body').css('padding-right', '0px');
parent.$('.modal-backdrop').remove();
</script>
<?php } } ?>



<?php
//add pattern
if(trim($_POST['action'])=='updateTechPack' && trim($_POST['editId'])!='' && trim($_POST['module'])!='' && ($_FILES['attachmentFile']!='' || $_POST['attachmentFileEdit']!='')){
$techpackdescription=clean($_POST['techpackdescription']);


if($_FILES['attachmentFile']['name']!=''){
$file_name=trim(addslashes($_FILES['attachmentFile']['name']));
$file_name=time().'-'.str_replace(' ', '_',$file_name);
$file_name= str_replace('#', 'f',$file_name);
copy($_FILES['attachmentFile']['tmp_name'],"images/".$file_name);
}
else{
$file_name =str_replace(' ', '_',$_POST['attachmentFileEdit']);
$file_name= str_replace('#', 'f',$file_name);
}


$techpackAddDate=time();
$techpackAddedBy=$_SESSION['userid'];

$where='id="'.decode($_POST['editId']).'"';
$namevalue ='techpackdescription="'.$techpackdescription.'",attachmentFile="'.$file_name.'",attachmentFile="'.$file_name.'",techpackAddDate="'.$techpackAddDate.'",techpackAddedBy="'.$techpackAddedBy.'"';
$update = updatelisting(_QUERY_MASTER_,$namevalue,$where);

//add note of techpeck uploaded
//$styleassignment = 'styleId="'.decode($_POST['editId']).'",statusId=4,notes="'.$patternDescription.'",assignTo="'.$patternAddedBy.'",dateAdded="'.time().'"';
//addlisting('styleAssignmentMaster',$styleassignment);


?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>
<?php }

 /////////////////Scheduler Add///////////////////
if(trim($_POST['action'])=='schedulemaster' && trim($_POST['editId'])=='' && trim($_POST['fromTime'])!='' && trim($_POST['toTime'])!=''){
$fromTime=clean($_POST['fromTime']);
$toTime=clean($_POST['toTime']);
$approveLimit=clean($_POST['approveLimit']);
$description=clean($_POST['description']);
$addDate=date('Y-m-d',strtotime($_POST['addDate']));
$dateAdded=time();
$namevalue ='fromTime="'.$fromTime.'",description="'.$description.'",toTime="'.$toTime.'",approveLimit="'.$approveLimit.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",addDate="'.$addDate.'"';
$adds = addlisting('sheduleMaster',$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=wcalendar&alt=1');
</script>

<?php }

//edit Scheduler Add
if(trim($_POST['action'])=='schedulemaster' && trim($_POST['editId'])!='' && trim($_POST['fromTime'])!='' && trim($_POST['toTime'])!=''){
$fromTime=clean($_POST['fromTime']);
$toTime=clean($_POST['toTime']);
$approveLimit=clean($_POST['approveLimit']);
$description=clean($_POST['description']);

$modifyDate=time();
$where='id="'.decode($_POST['editId']).'"';
$namevalue ='fromTime="'.$fromTime.'",description="'.$description.'",toTime="'.$toTime.'",approveLimit="'.$approveLimit.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';

$update = updatelisting('sheduleMaster',$namevalue,$where);


?>
<script>
parent.setupbox('showpage.crm?module=wcalendar&alt=1');
</script>

<?php }

 /////////////////image gallery///////////////////
if(trim($_POST['action'])=='protoimagegallery' && trim($_POST['editId'])=='' && trim($_REQUEST['parentid'])!=''){

$name=clean($_POST['name']);
$parentid=decode($_REQUEST['parentid']);

$dateAdded=time();
$namevalue ='name="'.$name.'",parentid="'.$parentid.'",galleryType="protoImageGallery"';
$adds = addlisting('imageGallery',$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=prototypesample&add=yes&styleid=<?php echo $_REQUEST['parentid']; ?>');
</script>

<?php }

 ?>

<?php
 /////////////////add purchase order///////////////////
if(trim($_POST['action'])=='attachtopurchaseorder' && $_REQUEST['purchaseorderid']!='' && $_POST['styleid']!=''){
$styleid=clean($_POST['styleid']);
$purchaseorderid=$_REQUEST['purchaseorderid'];
$where='id="'.$styleid.'"';
$namevalue ='poAttachment="'.$purchaseorderid.'"';
$update = updatelisting('queryMaster',$namevalue,$where);

?>
<script>
parent.setupbox('showpage.crm?module=buyerpo&add=yes&styleid=<?php echo encode($styleid); ?>');
</script>

<?php }

 ?>

<?php
//aapprove and reject in sample to buyer

if(trim($_POST['action'])=='approvecancelsammple' && trim($_POST['styleId'])!=''){
$buyerStatus=clean($_POST['buyerStatus']);
$buyerNotes=clean($_POST['notes']);
$where='styleId="'.decode($_POST['styleId']).'"';
$namevalue ='buyerStatus="'.$buyerStatus.'",buyerNotes="'.$buyerNotes.'"';
$update = updatelisting('costsheetVersionMaster',$namevalue,$where);

?>
<script>
parent.setupbox('showpage.crm?module=sampletobuyer');
</script>

<?php } ?>


<?php
/////////////////add currency Master///////////////////
if(trim($_POST['action'])=='currencymaster' && trim($_POST['editId'])=='' && trim($_POST['module'])!='' && trim($_POST['name'])!='' && trim($_POST['currencyvalue'])!=''){
$name=clean($_POST['name']);
$value=clean($_POST['currencyvalue']);
$description=clean($_POST['description']);
$status=clean($_POST['status']);
$dateAdded=time();
$modifyDate=time();

$namevalue ='name="'.$name.'",description="'.$description.'",status="'.$status.'",value="'.$value.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$adds = addlisting('currencyMaster',$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php }

if(trim($_POST['action'])=='currencymaster' && trim($_POST['editId'])!='' && trim($_POST['module'])!='' && trim($_POST['name'])!='' && trim($_POST['currencyvalue'])!=''){
$name=clean($_POST['name']);
$value=clean($_POST['currencyvalue']);
$description=clean($_POST['description']);
$status=clean($_POST['status']);
$dateAdded=time();
$modifyDate=time();

$where='id='.decode($_POST['editId']).'';

$namevalue ='name="'.$name.'",description="'.$description.'",value="'.$value.'",status="'.$status.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('currencyMaster',$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php } ?>

<?php
/////////////////materal type Master///////////////////
if(trim($_POST['action'])=='designationmaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);

$status=clean($_POST['status']);
$dateAdded=time();

$namevalue ='name="'.$name.'",status="'.$status.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting('designationMaster',$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php }


if(trim($_POST['action'])=='designationmaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);

$status=clean($_POST['status']);
$modifyDate=time();
$where='id='.decode($_POST['editId']).'';
$namevalue ='name="'.$name.'",status="'.$status.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('designationMaster',$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>
<?php }  ?>



<?php
if(trim($_POST['action'])=='uploadcostsheet' && $_POST['editId']!=''){


if($_FILES['uploadedCostsheet']['name']!=''){
$file_name=$_FILES['uploadedCostsheet']['name'];
$file_name=time().'-'.str_replace(' ', '_',$file_name);
$file_name= str_replace('#', 'f',$file_name);
copy($_FILES['uploadedCostsheet']['tmp_name'],"images/".$file_name);
}
else{
$file_name =$_POST['finaluploadedCostsheet'];
}

$costsheetdateAdded=time();

$where1='id='.decode($_POST['editId']).'';
$namevalue1 ='uploadedCostsheet="'.$file_name.'",costsheetdateAdded="'.$costsheetdateAdded.'",costsheetassignTo="'.$_SESSION['userid'].'"';
$update = updatelisting('queryMaster',$namevalue1,$where1);

?>
<script>
parent.setupbox('showpage.crm?module=costsheet&alt=1');
</script>

<?php }

if(trim($_REQUEST['styleId'])!='' && trim($_REQUEST['buyerPurchaseId'])!='' && trim($_REQUEST['buyerId'])!=''){

$buyerPurchaseId=addslashes($_REQUEST['buyerPurchaseId']);
$styleId=addslashes($_REQUEST['styleId']);
$buyerId=addslashes($_REQUEST['buyerId']);
$orderNo=addslashes($_REQUEST['orderNo']);
$buyerPurchaseId=addslashes($_REQUEST['buyerPurchaseId']);
$orderDate=addslashes($_REQUEST['orderDate']);
$orderTime=addslashes($_REQUEST['orderTime']);
$department=addslashes($_REQUEST['department']);
$purchaseOrderNo=addslashes($_REQUEST['purchaseOrderNo']);
$purchaseOrderDate=addslashes($_REQUEST['purchaseOrderDate']);
$deliveryDate=addslashes($_REQUEST['deliveryDate']);
$docType=addslashes($_REQUEST['docType']);
$docDescription=addslashes($_REQUEST['docDescription']);
$discount=addslashes($_REQUEST['discount']);
$totalEd=addslashes($_REQUEST['totalEd']);
$totalVat=addslashes($_REQUEST['totalVat']);
$grossTotal=addslashes($_REQUEST['grossTotal']);
$amtTotal=addslashes($_REQUEST['amtTotal']);
$remark=addslashes($_REQUEST['remark']);
$qtyTotal=addslashes($_REQUEST['qtyTotal']);

$namevalue ='orderNo="'.$orderNo.'",orderDate="'.$orderDate.'",orderTime="'.$orderTime.'",department="'.$department.'",purchaseOrderNo="'.$purchaseOrderNo.'",purchaseOrderDate="'.$purchaseOrderDate.'",deliveryDate="'.$deliveryDate.'",docType="'.$docType.'",docDescription="'.$docDescription.'",discount="'.$discount.'",totalEd="'.$totalEd.'",totalVat="'.$totalVat.'",grossTotal="'.$grossTotal.'",amtTotal="'.$amtTotal.'",remark="'.$remark.'",dateAdded="'.date('Y-m-d H:i:s').'",qtyTotal="'.$qtyTotal.'"';
$where='styleId="'.$styleId.'"';
$update = updatelisting('buyerPurchaseOrderMaster',$namevalue,$where);


}


if(trim($_REQUEST['action'])=='savebuyerorderdetail'){

$buyerPurchaseId=addslashes($_REQUEST['buyerPurchaseId']);
$styleId=addslashes($_REQUEST['styleId']);
$articleNo=addslashes($_REQUEST['articleNo']);
$description=addslashes($_REQUEST['description']);
$qty=addslashes($_REQUEST['qty']);
$uom=addslashes($_REQUEST['uom']);
$discount=addslashes($_REQUEST['discount']);
$ed=addslashes($_REQUEST['ed']);
$vat=addslashes($_REQUEST['vat']);
$price=addslashes($_REQUEST['price']);
$mrp=addslashes($_REQUEST['mrp']);
$amt=addslashes($_REQUEST['amt']);
$orderStyleId=addslashes($_REQUEST['orderStyleId']);


$namevalue ='styleId="'.$styleId.'",articleNo="'.$articleNo.'",description="'.$description.'",qty="'.$qty.'",uom="'.$uom.'",discount="'.$discount.'",ed="'.$ed.'",vat="'.$vat.'",price="'.$price.'",mrp="'.$mrp.'",amt="'.$amt.'"';
$where='id="'.$orderStyleId.'"';
$update = updatelisting('purchaseOrderStyleMaster',$namevalue,$where);

}

if(trim($_REQUEST['action'])=='savecolordetail'){

$finish=addslashes($_REQUEST['finish']);
$color=addslashes($_REQUEST['color']);
$size=addslashes($_REQUEST['size']);
$gdQty=addslashes($_REQUEST['gdQty']);
$parentid=addslashes($_REQUEST['parentid']);

$namevalue ='finish="'.$finish.'",color="'.$color.'",size="'.$size.'",gdQty="'.$gdQty.'"';
$where='id="'.$parentid.'"';
$update = updatelisting('purchaseOrderStyleMaster',$namevalue,$where);

}

//Send to Outsource/Inhouse
if(trim($_POST['action'])=='sendtoinhouseoutsource' && $_POST['styleId']!=''){

$statusId=clean($_POST['statusId']);
$styleId=decode($_POST['styleId']);
$notes=clean($_POST['notes']);

if($statusId=='19'){
$whereCheck='styleId="'.$styleId.'" and statusId=20';
$assignTo = clean($_POST['assignTo']);
$statusIdNew = '20';
}
if($statusId=='20'){
$whereCheck='styleId="'.$styleId.'" and statusId=19';
$assignTo = clean($_POST['merchandisingId']);
$statusIdNew = '19';
}



$checkCode = checkduplicate('styleAssignmentMaster',$whereCheck);

if($checkCode=='yes'){
$select='*';
$where='styleId="'.$styleId.'" and statusId="'.$statusIdNew.'"';
$rs=GetPageRecord($select,'styleAssignmentMaster',$where);
while($resListing=mysqli_fetch_array($rs)){

$where1='id="'.$resListing['id'].'"';
$namevalue1 ='styleAssignTo=1';
$update1 = updatelisting('styleAssignmentMaster',$namevalue1,$where1);
}
}

$dateAdded=time();

$namevalue ='styleId="'.$styleId.'",notes="'.$notes.'",assignTo="'.$assignTo.'",statusId="'.$statusId.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting('styleAssignmentMaster',$namevalue);

?>

<script>
parent.setupbox('showpage.crm?module=buyerpo');
</script>

<?php
}

//Send to Outsource Merchant


if(trim($_POST['action'])=='sendtooutsourcemerchant' && $_POST['styleId']!=''){
$statusId=21;
$styleId=decode($_POST['styleId']);
$notes=clean($_POST['notes']);
$assignTo = clean($_POST['assignTo']);

$whereCheck='styleId="'.$styleId.'" and statusId="'.$statusId.'"';
$checkCode = checkduplicate('styleAssignmentMaster',$whereCheck);

if($checkCode=='yes'){
$select='*';
$where='styleId="'.$styleId.'" and statusId="'.$statusId.'"';
$rs=GetPageRecord($select,'styleAssignmentMaster',$where);
while($resListing=mysqli_fetch_array($rs)){

$where1='id="'.$resListing['id'].'"';
$namevalue1 ='styleAssignTo=1';
$update1 = updatelisting('styleAssignmentMaster',$namevalue1,$where1);
}
}

$dateAdded=time();

$namevalue ='styleId="'.$styleId.'",notes="'.$notes.'",assignTo="'.$assignTo.'",statusId="'.$statusId.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting('styleAssignmentMaster',$namevalue);

?>

<script>
parent.setupbox('showpage.crm?module=vendoroutsourcing');
</script>

<?php
}

//Material Send to supplier
if(trim($_POST['action'])=='materialSendToSupplier' && $_POST['styleId']!='' && $_POST['costsheetVersionId']!='' && $_POST['supplierId']!='' && $_POST['assignToMaterialInhouse']!='0'){


include "config/mail.php";
$supplierId=$_POST['supplierId'];
$assignToMaterialInhouse=$_POST['assignToMaterialInhouse'];
$assignToMaterialInhouse = explode(',',rtrim($assignToMaterialInhouse,','));

$styleId=decode($_POST['styleId']);
$costsheetVersionId=clean($_POST['costsheetVersionId']);

$dateAdded=time();
//$inhouseRemark = array_filter($inhouseRemark);

foreach($supplierId as $assignSupplierId){

foreach($assignToMaterialInhouse as $materialId){
$inhouseRemark=$_POST['inhouseRemark'.$materialId];

$selectmtype='*';
$wheremtype='id="'.$materialId.'"';
$rstype=GetPageRecord($selectmtype,'styleSubCategoryMaster',$wheremtype);
$resListingtype=mysqli_fetch_array($rstype);

$whereCheck='styleId="'.$styleId.'" and costsheetVersionId="'.$costsheetVersionId.'" and supplierId="'.$assignSupplierId.'" and materialTypeId="'.$resListingtype['materialType'].'" and materialId="'.$materialId.'"';
$checkCode = checkduplicate('materialSendToSupplier',$whereCheck);

if($checkCode=='no'){

$namevalue ='materialTypeId="'.$resListingtype['materialType'].'",materialId="'.$materialId.'",styleId="'.$styleId.'",costsheetVersionId="'.$costsheetVersionId.'",supplierId="'.$assignSupplierId.'",inhouseRemark="'.$inhouseRemark.'",dateAdded="'.$dateAdded.'"';
$lastId = addlistinggetlastid('materialSendToSupplier',$namevalue);

}else{

$where11='styleId="'.$styleId.'" and costsheetVersionId="'.$costsheetVersionId.'" and supplierId="'.$assignSupplierId.'" and materialId="'.$materialId.'" and materialTypeId="'.$resListingtype['materialType'].'"';
$namevalue11 ='materialTypeId="'.$resListingtype['materialType'].'",materialId="'.$materialId.'",styleId="'.$styleId.'",costsheetVersionId="'.$costsheetVersionId.'",supplierId="'.$assignSupplierId.'",inhouseRemark="'.$inhouseRemark.'",dateAdded="'.$dateAdded.'"';
updatelisting('materialSendToSupplier',$namevalue11,$where11);

}


}

$select='';
$where='';
$rs='';
$select='*';
$where='id="'.$assignSupplierId.'"';
$rs=GetPageRecord($select,'suppliersMaster',$where);
$resListing=mysqli_fetch_array($rs);

$select12='*';
$where12='id="'.$styleId.'"';
$rs12=GetPageRecord($select12,'queryMaster',$where12);
$resListing12=mysqli_fetch_array($rs12);


$selectimg='*';
$whereimg='parentId="'.$resListing12['id'].'" and galleryType="image_gallery" order by id asc';
$rsimg=GetPageRecord($selectimg,'imageGallery',$whereimg);
$imgresult=mysqli_fetch_array($rsimg);

$fromemail ='';
$mailto=$resListing['email'];
$ccmail='';
$mailsubject='Woodland Appreal ERP - New Material List For Style# '.getStyleRefId($styleId).'';
$maildescription = '<table style="width: 100%;margin: unset;background:#fff;border-left:1px solid #e4e4e4;border-right:1px solid #e4e4e4;border-bottom:1px solid #e4e4e4;font-family:Arial,Helvetica,sans-serif;" border="0" cellpadding="0" cellspacing="0" align="center">
  <tbody><tr>
    <td style="border-top: solid 4px #0d7444; line-height: 1;"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #e4e4e4;border-top:none">
        <tbody><tr>
          <td align="left" valign="top" style="padding:14px 0 0 11px">
	        <div style="font-family:Arial,Helvetica,sans-serif;font-size:26px;color:#000;font-weight:700;text-decoration:none">
				<img src="'.$fullurl.'global_assets/images/woodland-logo2.png" alt="">
			</div>
		</td>

        </tr>
      </tbody></table></td>
</tr>
<tr>
<td>

		<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
		  <tr>
			 <td style="padding:19px 4px 0 4px;font-family:Arial,Helvetica,sans-serif;">
				<p style="margin:0;font-size:15px;color:#333;padding:0 0 8px 6px;line-height:18px">Dear <strong>Sir / Mam  </strong></p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Greeting from '.$systemname.' - The Apparel ERP! .</p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Please fill the rates of below mentioned materials:</p>
			</td>

        </tr>
      </tbody></table> </td>
  </tr>
      <tr>


    <td style="padding: 20px 10px; background: #f4f4f4;">
		 <p style="margin:0px;font-size:16px;padding:0 0 0 8px;    border-left: 3px solid #0d7544;height:25px;line-height:25px;color:#666">Style Information: </p>
		 <div style="clear:both;padding:0;margin:10px 0 0 0;border:1px solid #f5f5f5;background:#fff">

	   <table width="100%" border="0" cellspacing="0" cellpadding="5" style="border: 0.5px solid #ccc;">

   <tbody><tr>
 		<td width="18%" style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Style Image</td>
		<td width="21%" style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Style</td>
		<td width="16%" style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Category</td>
		<td width="15%" style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Sub Category</td>
		<td width="12%" style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Season</td>
		<td width="18%" style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Received Date</td>
  </tr>
  <tr>
   <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;"><img src="'.$fullurl.'images/'.$imgresult['attachmentImage'].'" style="width:90px;">
			</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">Style '.$resListing12['subject'].'</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.getCategoryName($resListing12['categoryId']).'</td>
	<td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.getSubCategoryName($resListing12['subCategoryId']).'</td>
	<td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.seasonName($resListing12['seasonId']).'</td>
	<td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.date('d M, Y',$resListing12['dateAdded']).'</td>
  </tr>


</tbody></table>
</div>
</td>
  </tr>

</tbody></table>
<p><a href="'.$fullurl.'submit-supplier.php?st='.$_POST['styleId'].'&cv='.encode($_POST['costsheetVersionId']).'&s='.encode($assignSupplierId).'" style="background-color: #11b76c; border-radius: 4px; color: #fff!important; padding: 8px 18px; font-size: 14px; text-decoration: none; display: inline-block;" target="_blank" class="showhide" >Submit Cost</a></p>
';



$dateAdded=time();
$maildescription1 = addslashes($maildescription);
$namevalue ='subject="'.$mailsubject.'",description="'.$maildescription1.'",adddate="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",styleid="'.$styleId.'",supplierid="'.$assignSupplierId.'",inHouseComment="'.$_POST['remark'].'",status="1"';
$adds = addlisting('supplierPurchasemail',$namevalue);

send_template_mail_query($fromemail,$mailto,$mailsubject,$maildescription,$ccmail);

}
?>

<script>
parent.setupbox('showpage.crm?module=materialcost&add=yes&styleid=<?php echo $_POST['styleId']; ?>');
</script>

<?php
}

if(trim($_REQUEST['action'])=='sendtosupplier'){

$id=decode($_REQUEST['id']);
$valueOnePiece=addslashes($_REQUEST['valueOnePiece']);
$supplierRemark=addslashes($_REQUEST['supplierRemark']);

$namevalue ='valueOnePiece="'.$valueOnePiece.'",supplierRemark="'.$supplierRemark.'"';
$where='id="'.$id.'"';
$update = updatelisting('materialSendToSupplier',$namevalue,$where);

}

if($_REQUEST['updateId']!='' && trim($_REQUEST['action'])=='savesppliercost'){

$styleId=$_REQUEST['styleId'];
$costsheetVersionId=$_REQUEST['costsheetVersionId'];
$materialId = $_REQUEST['materialId'];
$supplierid = $_REQUEST['updateId'];
$valueOnePiece = $_REQUEST['valueOnePiece'];
$bomsrno = $_REQUEST['bomsrno'];

$namevalue112 ='bomvalueonepc="'.$valueOnePiece.'"';
$where112='styleId="'.$styleId.'" and costsheetVersionId="'.$costsheetVersionId.'" and bomSerialNo="'.$bomsrno.'"';
$update = updatelisting('techPackDetailMaster',$namevalue112,$where112);

$namevalue113 ='defaultSupplier="'.$supplierid.'"';
$where113='styleId="'.$styleId.'" and costsheetVersionId="'.$costsheetVersionId.'" and materialId="'.$materialId.'"';
$update = updatelisting('materialSendToSupplier',$namevalue113,$where113);

?>

<script>
parent.setupbox('showpage.crm?module=comparesuppliercost&view=yes&styleid=<?php echo encode($styleId); ?>&costsheetVersionId=<?php echo $costsheetVersionId;  ?>');
</script>
<?php
}

if(trim($_POST['action'])=='sendtovendor' && $_POST['styleId']!='' && $_POST['costsheetVersionId']!='' && $_POST['vendorId']!=''){


include "config/mail.php";
$vendorId=$_POST['vendorId'];

$styleId=decode($_POST['styleId']);
$costsheetVersionId=clean($_POST['costsheetVersionId']);

$dateAdded=time();

foreach($vendorId as $assignVendorId){

$namevalue ='styleId="'.$styleId.'",costsheetVersionId="'.$costsheetVersionId.'",vendorId="'.$assignVendorId.'",dateAdded="'.$dateAdded.'"';
$lastId = addlistinggetlastid('materialSendToVendor',$namevalue);

$select='';
$where='';
$rs='';
$select='*';
$where='id="'.$assignVendorId.'"';
$rs=GetPageRecord($select,'vendorMaster',$where);
$resListing=mysqli_fetch_array($rs);

$select12='*';
$where12='id="'.$styleId.'"';
$rs12=GetPageRecord($select12,'queryMaster',$where12);
$resListing12=mysqli_fetch_array($rs12);


$selectimg='*';
$whereimg='parentId="'.$resListing12['id'].'" and galleryType="image_gallery" order by id asc';
$rsimg=GetPageRecord($selectimg,'imageGallery',$whereimg);
$imgresult=mysqli_fetch_array($rsimg);

$fromemail ='';
$mailto=$resListing['email'];
$ccmail='';
$mailsubject='Woodland Appreal ERP - New Material List For Style# '.getStyleRefId($styleId).'';
$maildescription = '<table style="width: 100%;margin: unset;background:#fff;border-left:1px solid #e4e4e4;border-right:1px solid #e4e4e4;border-bottom:1px solid #e4e4e4;font-family:Arial,Helvetica,sans-serif;" border="0" cellpadding="0" cellspacing="0" align="center">
  <tbody><tr>
    <td style="border-top: solid 4px #0d7444; line-height: 1;"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #e4e4e4;border-top:none">
        <tbody><tr>
          <td align="left" valign="top" style="padding:14px 0 0 11px">
	        <div style="font-family:Arial,Helvetica,sans-serif;font-size:26px;color:#000;font-weight:700;text-decoration:none">
				<img src="'.$fullurl.'global_assets/images/woodland-logo2.png" alt="">
			</div>
		</td>

        </tr>
      </tbody></table></td>
</tr>
<tr>
<td>

		<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
		  <tr>
			 <td style="padding:19px 4px 0 4px;font-family:Arial,Helvetica,sans-serif;">
				<p style="margin:0;font-size:15px;color:#333;padding:0 0 8px 6px;line-height:18px">Dear <strong>Sir / Mam  </strong></p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Greeting from '.$systemname.' - The Apparel ERP! .</p>
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Please fill the rates of below mentioned materials:</p>
			</td>

        </tr>
      </tbody></table> </td>
  </tr>
      <tr>


    <td style="padding: 20px 10px; background: #f4f4f4;">
		 <p style="margin:0px;font-size:16px;padding:0 0 0 8px;    border-left: 3px solid #0d7544;height:25px;line-height:25px;color:#666">Style Information: </p>
		 <div style="clear:both;padding:0;margin:10px 0 0 0;border:1px solid #f5f5f5;background:#fff">

	   <table width="100%" border="0" cellspacing="0" cellpadding="5" style="border: 0.5px solid #ccc;">

   <tbody><tr>
 		<td width="18%" style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Style Image</td>
		<td width="21%" style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Style</td>
		<td width="16%" style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Category</td>
		<td width="15%" style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Sub Category</td>
		<td width="12%" style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Season</td>
		<td width="18%" style="font-size: 14px;font-weight: bold;color:#333;line-height:20px;padding:5px;border: 1px solid #ccc;">Received Date</td>
  </tr>
  <tr>
   <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;"><img src="'.$fullurl.'images/'.$imgresult['attachmentImage'].'" style="width:90px;">
			</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">Style '.$resListing12['subject'].'</td>
    <td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.getCategoryName($resListing12['categoryId']).'</td>
	<td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.getSubCategoryName($resListing12['subCategoryId']).'</td>
	<td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.seasonName($resListing12['seasonId']).'</td>
	<td style="font-size:14px;color:#666;line-height:20px;padding:5px;border: 1px solid #ccc;">'.date('d M, Y',$resListing12['dateAdded']).'</td>
  </tr>


</tbody></table>
</div>
</td>
  </tr>

</tbody></table>
<p><a href="'.$fullurl.'submit-supplier.php?st='.$_POST['styleId'].'&cv='.encode($_POST['costsheetVersionId']).'&s='.encode($assignVendorId).'" style="background-color: #11b76c; border-radius: 4px; color: #fff!important; padding: 8px 18px; font-size: 14px; text-decoration: none; display: inline-block;" target="_blank" class="showhide" >Submit Cost</a></p>
';

$dateAdded=time();
$maildescription1 = addslashes($maildescription);
$namevalue ='subject="'.$mailsubject.'",description="'.$maildescription1.'",adddate="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",styleid="'.$styleId.'",vendorid="'.$assignVendorId.'",inHouseComment="'.$_POST['remark'].'",status="1"';
$adds = addlisting('vendorPurchasemail',$namevalue);

send_template_mail_query($fromemail,$mailto,$mailsubject,$maildescription,$ccmail);

}
?>

<script>
parent.setupbox('showpage.crm?module=vendoroutsourcing');
</script>

<?php
}

 /////////////////Factory master///////////////////
if(trim($_POST['action'])=='factorymaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$line=clean($_POST['line']);
$workers=clean($_POST['workers']);
$description=clean($_POST['description']);
$dateAdded=time();
$namevalue ='name="'.$name.'",line="'.$line.'",workers="'.$workers.'",description="'.$description.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting('factoryMaster',$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>

<?php }

if(trim($_POST['action'])=='factorymaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$line=clean($_POST['line']);
$workers=clean($_POST['workers']);
$description=clean($_POST['description']);


$modifyDate=time();

$where='id='.decode($_POST['editId']).'';
$namevalue ='name="'.$name.'",line="'.$line.'",workers="'.$workers.'",description="'.$description.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('factoryMaster',$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>

<?php }


?>




