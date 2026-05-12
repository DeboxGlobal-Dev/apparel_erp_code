<?php
ob_start();
include "inc.php";
if($_REQUEST['action']!='sendtosupplier'){
include "config/logincheck.php";
}
//====================random color
function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}
function random_color() {
    return random_color_part() . random_color_part() . random_color_part();
}
//====================================

//Style Email template header
$mailbodyheader = '<table width="100%" style="max-width: 750px;margin: unset;background:#fff;border-left:1px solid #e4e4e4;border-right:1px solid #e4e4e4;border-bottom:1px solid #e4e4e4;font-family:Arial,Helvetica,sans-serif;" border="0" cellpadding="0" cellspacing="0" align="center">
  <tbody><tr>
    <td style="border-top: solid 4px #0d7444; line-height: 1;"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #e4e4e4;border-top:none">
        <tbody><tr>
          <td align="left" valign="top" style="padding:14px 0 0 11px">
	<a href="'.$fullurl.'" style="font-family:Arial,Helvetica,sans-serif;font-size:26px;color:#000;font-weight:700;text-decoration:none" target="_blank">
				<img src="'.$fullurl.'global_assets/images/woodland-logo2.png" alt="'.$fullurl.'global_assets/images/woodland-logo2.png">
			</a>
		</td>A
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
if(trim($_POST['action'])=='edituser' && trim($_POST['firstName'])!='' && trim($_POST['email'])!='' && trim($_POST['profileId'])!='' && trim($_POST['userName'])!=''){

$queryId=clean($_POST['savenew']);
$firstName=($_POST['firstName']);
$editId=decode($_POST['editId']);
$lastName=clean($_POST['lastName']);
$email=trim($_POST['email']);
$userName=trim($_POST['userName']);
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
$namevalue ='firstName="'.$firstName.'",deletestatus=0,lastName="'.$lastName.'",email="'.$email.'",userName="'.$userName.'",password="'.$password.'",status="'.$status.'",roleId="'.$roleId.'",profileId="'.$profileId.'",phone="'.$phone.'",userType="'.$userType.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",empId="'.$empId.'"';
$where='id='.decode($_REQUEST['editId']).'';
$update = updatelisting(_USER_MASTER_,$namevalue,$where);

} else {
$auto_password = rand(10,1000000);
$password = md5($auto_password);
$namevalue ='firstName="'.$firstName.'",deletestatus=0,lastName="'.$lastName.'",email="'.$email.'",userName="'.$userName.'",password="'.$password.'",status="'.$status.'",roleId="'.$roleId.'",profileId="'.$profileId.'",phone="'.$phone.'",userType="'.$userType.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",empId="'.$empId.'"';
$lasttid = addlistinggetlastid(_USER_MASTER_,$namevalue);

//Send email to user when create account.
include('config/mail.php');
$mailsubject = "User created on '".$systemname."'";
$maildescription = 'Dear <b>'.$firstName.' '.$lastName.'</b> <br>
							<br>
							Greeting from '.$systemname.' - The Apparel ERP!</p>
<p>Your Account has been created successfully.</p>
<p>Please find the below credentials:</p>
<p>URL: '.$fullurl.' </p>
<p>Email: '.$userName.'</p>
<p>Password: '.$auto_password.'</p>
<p>&nbsp;</p>
<p>Regards</p>
<p><b><i>'.$systemname.' - The Apparel ERP!</i></b></p>
<p><img src="'.$fullurl.'global_assets/images/woodland-logo2.png"></p>
';
$mailto = $userName;
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
$buyerId=clean($_POST['buyerId']);
$dateAdded=time();
$namevalue ='seasonYear="'.$seasonYear.'",name="'.$name.'",startDate="'.$startDate.'",endDate="'.$endDate.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",buyerId="'.$buyerId.'"';
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
$buyerId=clean($_POST['buyerId']);
$where='id='.$_POST['editId'].'';
$namevalue ='seasonYear="'.$seasonYear.'",name="'.$name.'",startDate="'.$startDate.'",endDate="'.$endDate.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'",buyerId="'.$buyerId.'"';
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
$segmentId=clean($_POST['segmentId']);
$dateAdded=time();
$namevalue ='name="'.$name.'",description="'.$description.'",dateAdded="'.$dateAdded.'",segmentId="'.$segmentId.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting(_CATEGORY_MASTER_,$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>
<?php }
if(trim($_POST['action'])=='categorymaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$segmentId=clean($_POST['segmentId']);
$modifyDate=time();

$where='id='.decode($_POST['editId']).'';
$namevalue ='name="'.$name.'",description="'.$description.'",modifyDate="'.$modifyDate.'",segmentId="'.$segmentId.'",modifyBy="'.$_SESSION['userid'].'"';
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
if(trim($_POST['action'])=='colorcardmaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$colorCode=clean($_POST['colorCode']);
$reference=clean($_POST['reference']);
$buyerColorName=clean($_POST['buyerColorName']);
$buyerColorCode=clean($_POST['buyerColorCode']);
$buyerId=clean($_POST['buyerId']);
$brandId=clean($_POST['brandId']);
$dateAdded=time();
$namevalue ='name="'.$name.'",colorCode="'.$colorCode.'",reference="'.$reference.'",buyerColorName="'.$buyerColorName.'",buyerColorCode="'.$buyerColorCode.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",buyerId="'.$buyerId.'",brandId="'.$brandId.'"';
$adds = addlisting(_COLOR_CARD_MASTER_,$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=buyermaster&view=yes&id=<?php echo encode($buyerId); ?>');
</script>
<?php }
if(trim($_POST['action'])=='colorcardmaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$colorCode=clean($_POST['colorCode']);
$reference=clean($_POST['reference']);
$buyerColorName=clean($_POST['buyerColorName']);
$buyerColorCode=clean($_POST['buyerColorCode']);
$buyerId=clean($_POST['buyerId']);
$brandId=clean($_POST['brandId']);
$modifyDate=time();
$where='id='.$_POST['editId'].'';
$namevalue ='name="'.$name.'",colorCode="'.$colorCode.'",reference="'.$reference.'",buyerColorName="'.$buyerColorName.'",buyerColorCode="'.$buyerColorCode.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'",buyerId="'.$buyerId.'",brandId="'.$brandId.'"';
$update = updatelisting(_COLOR_CARD_MASTER_,$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=buyermaster&view=yes&id=<?php echo encode($buyerId); ?>');
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
$whereCheckref='styleRefId="'.$_POST['styleRefId'].'" and deletestatus=0';
$checkCoderef = checkduplicate(_QUERY_MASTER_,$whereCheckref);
if($checkCoderef=="no"){
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
$risk=clean($_POST['risk']);
$repeatorder=clean($_POST['repeatorder']);
$merchantname=clean($_POST['merchantname']);
$refrenceBy=clean($_POST['refrenceBy']);
$styleTypeId=clean($_POST['styleTypeId']);
$sampleTypestyle=clean($_POST['sampleTypestyle']);
$smv=clean($_POST['smv']);
$efficiency=clean($_POST['efficiency']);
$gender=clean($_POST['gender']);
$brandId=clean($_POST['brandId']);
$segment=clean($_POST['segment']);
$merchantStyleNo=clean($_POST['merchantStyleNo']);
$masterStyleNo=clean($_POST['masterStyleNo']);
$costingQty=clean($_POST['costingQty']);
$projecQty=clean($_POST['projecQty']);
$sizerange=clean($_POST['sizerange']);
$sizeratio=clean($_POST['sizeratio']);
$styleColor='#'.random_color();

$patternReadyDate=date("Y-m-d", strtotime($_POST['patternReadyDate']));
$patternRemark=clean($_POST['patternRemark']);
$cuttingReadyDate=date("Y-m-d", strtotime($_POST['cuttingReadyDate']));
$cuttingWip=clean($_POST['cuttingWip']);
$cuttingDispatch=clean($_POST['cuttingDispatch']);
$cuttingRemark=clean($_POST['cuttingRemark']);
$machineReadyDate=date("Y-m-d", strtotime($_POST['machineReadyDate']));
$machineWip=clean($_POST['machineWip']);
$machineDispatch=clean($_POST['machineDispatch']);
$machineMc=clean($_POST['machineMc']);
$machineRemark=clean($_POST['machineRemark']);
$washingReadyDate=date("Y-m-d", strtotime($_POST['washingReadyDate']));
$washingWip=clean($_POST['washingWip']);
$washingRemark=clean($_POST['washingRemark']);
$washingDispatch=clean($_POST['washingDispatch']);
$finishingReadyDate=date("Y-m-d", strtotime($_POST['finishingReadyDate']));
$finishingWip=clean($_POST['finishingWip']);
$finishingRemark=clean($_POST['finishingRemark']);
$finishingDispatch=clean($_POST['finishingDispatch']);
$qualityReadyDate=date("Y-m-d", strtotime($_POST['qualityReadyDate']));
$qualityWip=clean($_POST['qualityWip']);
$qualityDispatch=clean($_POST['qualityDispatch']);
$qualityRemark=clean($_POST['qualityRemark']);
$handoverReadyDate=date("Y-m-d", strtotime($_POST['handoverReadyDate']));
$handoverQty=clean($_POST['handoverQty']);
$handoverRemark=clean($_POST['handoverRemark']);

if($queryPriority=='1'){
$queryPriorityName ='Low';
} else if($queryPriority=='2'){
$queryPriorityName ='Medium';
} else{
$queryPriorityName ='High';
}
if($_POST['module']=="style"){
$sampleStlye = 1;
}else{
$sampleStlye = 2;
}
$receivedDate=date("Y-m-d", strtotime($_POST['receivedDate']));
$ocdDate=date("Y-m-d", strtotime($_POST['ocdDate']));
$pcdDate=date("Y-m-d", strtotime($_POST['pcdDate']));
$shipDate=date("Y-m-d", strtotime($_POST['shipDate']));


$sampleFor=clean($_POST['sampleFor']);
$productionStage=clean($_POST['productionStage']);
$sampleType=clean($_POST['sampleType']);
$parentStyleId=clean($_POST['styleId']);
$requestedDate=date("Y-m-d", strtotime($_POST['requestedDate']));
$expectedDate=date("Y-m-d", strtotime($_POST['expectedDate']));
$dispatchDate=date("Y-m-d", strtotime($_POST['dispatchDate']));
$dispatchDetail=clean($_POST['dispatchDetail']);
$requestedBy=clean($_POST['requestedBy']);

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
$parentStyleId=clean($_POST['styleId']);
if($_POST['module']=="style"){
$sampleStyle='1';
}else{
$sampleStyle='2';
$rsgetparent=GetPageRecord('*',_QUERY_MASTER_,'id="'.$parentStyleId.'"');
$rsgetparentresult=mysqli_fetch_array($rsgetparent);

$seasonId = $rsgetparentresult['seasonId'];
$brandId = $rsgetparentresult['brandId'];
$gender = $rsgetparentresult['gender'];
$buyerId = $rsgetparentresult['buyerId'];
$categoryId = $rsgetparentresult['categoryId'];
$subCategoryId = $rsgetparentresult['subCategoryId'];
$segment = $rsgetparentresult['segment'];
}
$attachmentNewMail=addslashes($_POST['attachmentNewMail']);

$namevalue ='subject="'.$subject.'",buyerId="'.$buyerId.'",styleRefId="'.$styleRefId.'",techpackattachment="'.$file_name.'",colorbreakup="'.$colorbreakup.'",buyerStyleRefNo="'.$buyerStyleRefNo.'",receivedDate="'.$receivedDate.'",categoryId="'.$categoryId.'",subCategoryId="'.$subCategoryId.'",seasonId="'.$seasonId.'",divisionId="'.$divisionId.'",departmentId="'.$departmentId.'",displayId="'.$displayId.'",mailId="'.$_REQUEST['mailId'].'",attachmentFile="'.$file_name.'",assignTo="'.$assignTo.'",orderQty="'.$orderQty.'",receivedDate="'.$receivedDate.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'",stylestatus="1",defaultcostsheetVersionId="1",queryPriority="'.$queryPriority.'",styleType="'.$styleType.'",styleTypeId="'.$styleTypeId.'",remark="'.$remark.'",refrenceBy="'.$refrenceBy.'",attachmentNewMail="'.$attachmentNewMail.'",smv="'.$smv.'",efficiency="'.$efficiency.'",gender="'.$gender.'",brandId="'.$brandId.'",segment="'.$segment.'",merchantStyleNo="'.$merchantStyleNo.'",masterStyleNo="'.$masterStyleNo.'",costingQty="'.$costingQty.'",projecQty="'.$projecQty.'",sizerange="'.$sizerange.'",sizeratio="'.$sizeratio.'",ocdDate="'.$ocdDate.'",pcdDate="'.$pcdDate.'",shipDate="'.$shipDate.'",sampleStyle="'.$sampleStlye.'",sampleFor="'.$sampleFor.'",productionStage="'.$productionStage.'",sampleType="'.$sampleType.'",parentStyleId="'.$parentStyleId.'",requestedDate="'.$requestedDate.'",expectedDate="'.$expectedDate.'",dispatchDate="'.$dispatchDate.'",dispatchDetail="'.$dispatchDetail.'",requestedBy="'.$requestedBy.'",riskPriority="'.$risk.'",repeatOrder="'.$repeatorder.'",merchant="'.$merchantname.'", styleColor="'.$styleColor.'",patternReadyDate="'.$patternReadyDate.'",patternRemark="'.$patternRemark.'",cuttingReadyDate="'.$cuttingReadyDate.'",cuttingWip="'.$cuttingWip.'",cuttingDispatch="'.$cuttingDispatch.'",cuttingRemark="'.$cuttingRemark.'",machineReadyDate="'.$machineReadyDate.'",machineWip="'.$machineWip.'",machineDispatch="'.$machineDispatch.'",machineMc="'.$machineMc.'",machineRemark="'.$machineRemark.'",washingReadyDate="'.$washingReadyDate.'",washingWip="'.$washingWip.'",washingRemark="'.$washingRemark.'",washingDispatch="'.$washingDispatch.'",finishingReadyDate="'.$finishingReadyDate.'",finishingWip="'.$finishingWip.'",finishingRemark="'.$finishingRemark.'",finishingDispatch="'.$finishingDispatch.'",qualityReadyDate="'.$qualityReadyDate.'",qualityWip="'.$qualityWip.'",qualityDispatch="'.$qualityDispatch.'",qualityRemark="'.$qualityRemark.'",handoverReadyDate="'.$handoverReadyDate.'",handoverQty="'.$handoverQty.'",handoverRemark="'.$handoverRemark.'"';



$where='id="'.decode($editId).'"';
$update = updatelisting(_QUERY_MASTER_,$namevalue,$where);
if($update=='yes'){
$namevalue ='convertQuery="'.decode($editId).'"';
$where='id="'.decode($incomingqueryId).'"';
$update = updatelisting('mailSectionMaster',$namevalue,$where);
//-----------------------Add color details---------------------------

$where=' styleId="'.decode($_POST['editId']).'"';
deleteRecord('styleColorDetailMaster',$where);
while($valuesAddrs <= $_POST['addcount']){
$colorId=trim($_POST["colorId".$valuesAddrs]);
$qty=trim($_POST["qty".$valuesAddrs]);
$valueEdition=trim($_POST["valueEdition".$valuesAddrs]);
$lining=trim($_POST['lining'.$valuesAddrs]);
$datew = $_POST['date'.$valuesAddrs];
if($colorId!='' && $qty!='' && $valueEdition!='' && $lining!=''){
$allvalueAddrs ='colorId="'.$colorId.'",qty="'.$qty.'",valueEdition="'.$valueEdition.'",lining="'.$lining.'",styleId="'.decode($_POST['editId']).'",dateAdded="'.$datew.'"';
$add = addlisting('styleColorDetailMaster',$allvalueAddrs);
}
$valuesAddrs++; }
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
$mailsubject='New Style #'.$styleRefId.' on '.$systemname.'.';
$maildescription=$querythanksmsg;
//send_template_mail_query($fromemail,$mailto,$mailsubject,$maildescription,$ccmail);
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
parent.$(".loader").css("display", "block");
parent.$('.loader').fadeIn('slow', function(){
parent.$('.loader').delay(1000).fadeOut();
});
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>');
</script>
<?php
}else{ ?>
<script>
alert('This style refrence number is already exist.');
</script>
<?php
}
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
$risk=clean($_POST['risk']);
$repeatorder=clean($_POST['repeatorder']);
$merchantname=clean($_POST['merchantname']);
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
$ocdDate=date("Y-m-d", strtotime($_POST['ocdDate']));
$pcdDate=date("Y-m-d", strtotime($_POST['pcdDate']));
$shipDate=date("Y-m-d", strtotime($_POST['shipDate']));

$remark=clean($_POST['remark']);
$editId=clean($_POST['editId']);
$editedityes=clean($_POST['editedityes']);
$incomingqueryId=clean($_POST['incomingqueryId']);
$refrenceBy=clean($_POST['refrenceBy']);
$styleTypeId=clean($_POST['styleTypeId']);
$sampleTypestyle=clean($_POST['sampleTypestyle']);
$smv=clean($_POST['smv']);
$efficiency=clean($_POST['efficiency']);
$gender=clean($_POST['gender']);
$brandId=clean($_POST['brandId']);
$segment=clean($_POST['segment']);
$merchantStyleNo=clean($_POST['merchantStyleNo']);
$masterStyleNo=clean($_POST['masterStyleNo']);
$costingQty=clean($_POST['costingQty']);
$projecQty=clean($_POST['projecQty']);
$sizerange=clean($_POST['sizerange']);
$sizeratio=clean($_POST['sizeratio']);
$sampleFor=clean($_POST['sampleFor']);
$productionStage=clean($_POST['productionStage']);
$sampleType=clean($_POST['sampleType']);
$parentStyleId=clean($_POST['styleId']);
$requestedDate=date("Y-m-d", strtotime($_POST['requestedDate']));
$expectedDate=date("Y-m-d", strtotime($_POST['expectedDate']));
$dispatchDate=date("Y-m-d", strtotime($_POST['dispatchDate']));
$dispatchDetail=clean($_POST['dispatchDetail']);
$requestedBy=clean($_POST['requestedBy']);

$patternReadyDate=date("Y-m-d", strtotime($_POST['patternReadyDate']));
$patternRemark=clean($_POST['patternRemark']);
$cuttingReadyDate=date("Y-m-d", strtotime($_POST['cuttingReadyDate']));
$cuttingWip=clean($_POST['cuttingWip']);
$cuttingDispatch=clean($_POST['cuttingDispatch']);
$cuttingRemark=clean($_POST['cuttingRemark']);
$machineReadyDate=date("Y-m-d", strtotime($_POST['machineReadyDate']));
$machineWip=clean($_POST['machineWip']);
$machineDispatch=clean($_POST['machineDispatch']);
$machineMc=clean($_POST['machineMc']);
$machineRemark=clean($_POST['machineRemark']);
$washingReadyDate=date("Y-m-d", strtotime($_POST['washingReadyDate']));
$washingWip=clean($_POST['washingWip']);
$washingRemark=clean($_POST['washingRemark']);
$washingDispatch=clean($_POST['washingDispatch']);
$finishingReadyDate=date("Y-m-d", strtotime($_POST['finishingReadyDate']));
$finishingWip=clean($_POST['finishingWip']);
$finishingRemark=clean($_POST['finishingRemark']);
$finishingDispatch=clean($_POST['finishingDispatch']);
$qualityReadyDate=date("Y-m-d", strtotime($_POST['qualityReadyDate']));
$qualityWip=clean($_POST['qualityWip']);
$qualityDispatch=clean($_POST['qualityDispatch']);
$qualityRemark=clean($_POST['qualityRemark']);
$handoverReadyDate=date("Y-m-d", strtotime($_POST['handoverReadyDate']));
$handoverQty=clean($_POST['handoverQty']);
$handoverRemark=clean($_POST['handoverRemark']);


$dateAdded=time();
if($_POST['module']=="style"){
$sampleStlye = 1;
}else{
$sampleStlye = 2;
}
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

$sampleFor=clean($_POST['sampleFor']);
$productionStage=clean($_POST['productionStage']);
$sampleType=clean($_POST['sampleType']);
$requestedDate=date("Y-m-d", strtotime($_POST['requestedDate']));
$expectedDate=date("Y-m-d", strtotime($_POST['expectedDate']));
$dispatchDate=date("Y-m-d", strtotime($_POST['dispatchDate']));
$dispatchDetail=clean($_POST['dispatchDetail']);
$requestedBy=clean($_POST['requestedBy']);
$parentStyleId=clean($_POST['styleId']);
if($_POST['module']=="style"){
$sampleStyle='1';
}else{
$sampleStyle='2';
$rsgetparent=GetPageRecord('*',_QUERY_MASTER_,'id="'.$parentStyleId.'"');
$rsgetparentresult=mysqli_fetch_array($rsgetparent);

$seasonId = $rsgetparentresult['seasonId'];
$brandId = $rsgetparentresult['brandId'];
$gender = $rsgetparentresult['gender'];
$buyerId = $rsgetparentresult['buyerId'];
$categoryId = $rsgetparentresult['categoryId'];
$subCategoryId = $rsgetparentresult['subCategoryId'];
$segment = $rsgetparentresult['segment'];
}
$namevalue ='subject="'.$subject.'",buyerId="'.$buyerId.'",styleRefId="'.$styleRefId.'",sizerange="'.$sizerange.'",techpackattachment="'.$file_name.'",sizeratio="'.$sizeratio.'",colorbreakup="'.$colorbreakup.'",buyerStyleRefNo="'.$buyerStyleRefNo.'",receivedDate="'.$receivedDate.'",categoryId="'.$categoryId.'",subCategoryId="'.$subCategoryId.'",seasonId="'.$seasonId.'",divisionId="'.$divisionId.'",departmentId="'.$departmentId.'",mailId="'.$_REQUEST['mailId'].'",attachmentFile="'.$file_name.'",assignTo="'.$assignTo.'",orderQty="'.$orderQty.'",receivedDate="'.$receivedDate.'",addedBy="'.$_SESSION['userid'].'",queryPriority="'.$queryPriority.'",styleType="'.$styleType.'",remark="'.$remark.'",refrenceBy="'.$refrenceBy.'",styleTypeId="'.$styleTypeId.'",smv="'.$smv.'",efficiency="'.$efficiency.'",gender="'.$gender.'",brandId="'.$brandId.'",segment="'.$segment.'",merchantStyleNo="'.$merchantStyleNo.'",masterStyleNo="'.$masterStyleNo.'",costingQty="'.$costingQty.'",projecQty="'.$projecQty.'",ocdDate="'.$ocdDate.'",pcdDate="'.$pcdDate.'",shipDate="'.$shipDate.'",sampleStyle="'.$sampleStyle.'",sampleFor="'.$sampleFor.'",productionStage="'.$productionStage.'",sampleType="'.$sampleType.'",parentStyleId="'.$parentStyleId.'",requestedDate="'.$requestedDate.'",expectedDate="'.$expectedDate.'",dispatchDate="'.$dispatchDate.'",dispatchDetail="'.$dispatchDetail.'",requestedBy="'.$requestedBy.'",riskPriority="'.$risk.'",repeatOrder="'.$repeatorder.'",merchant="'.$merchantname.'",patternReadyDate="'.$patternReadyDate.'",patternRemark="'.$patternRemark.'",cuttingReadyDate="'.$cuttingReadyDate.'",cuttingWip="'.$cuttingWip.'",cuttingDispatch="'.$cuttingDispatch.'",cuttingRemark="'.$cuttingRemark.'",machineReadyDate="'.$machineReadyDate.'",machineWip="'.$machineWip.'",machineDispatch="'.$machineDispatch.'",machineMc="'.$machineMc.'",machineRemark="'.$machineRemark.'",washingReadyDate="'.$washingReadyDate.'",washingWip="'.$washingWip.'",washingRemark="'.$washingRemark.'",washingDispatch="'.$washingDispatch.'",finishingReadyDate="'.$finishingReadyDate.'",finishingWip="'.$finishingWip.'",finishingRemark="'.$finishingRemark.'",finishingDispatch="'.$finishingDispatch.'",qualityReadyDate="'.$qualityReadyDate.'",qualityWip="'.$qualityWip.'",qualityDispatch="'.$qualityDispatch.'",qualityRemark="'.$qualityRemark.'",handoverReadyDate="'.$handoverReadyDate.'",handoverQty="'.$handoverQty.'",handoverRemark="'.$handoverRemark.'"';

$where='id="'.decode($editId).'"';
$update = updatelisting(_QUERY_MASTER_,$namevalue,$where);
if($update=='yes'){
$namevalue ='convertQuery="'.decode($editId).'"';
$where='id="'.decode($incomingqueryId).'"';
$update = updatelisting('mailSectionMaster',$namevalue,$where);
//-----------------------Add color details---------------------------

$wherecolor111='styleId="'.decode($_POST['editId']).'"';
deleteRecord('styleColorDetailMaster',$wherecolor111);
while($valuescolor <= $_POST['addcount']){
$colorId=trim($_POST['colorId'.$valuescolor]);
$qty=trim($_POST['qty'.$valuescolor]);
$valueEdition=trim($_POST['valueEdition'.$valuescolor]);
$lining=trim($_POST['lining'.$valuescolor]);
//$datew=$_POST['date'.$valuescolor];
if($colorId!='' && $qty!='' && $valueEdition!='' && $lining!=''){
$allvalueAddrs ='colorId="'.$colorId.'",qty="'.$qty.'",valueEdition="'.$valueEdition.'",lining="'.$lining.'",styleId="'.decode($_POST['editId']).'"';
$add = addlisting('styleColorDetailMaster',$allvalueAddrs);
}
$valuescolor++; }
}
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>
<?php
}
?>
<?php
//=============================================================ADD NEW COST SHEET VERSION=======================================================================
if(trim($_POST['action2'])=='techpackversion'){

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
		$costData=mysqli_fetch_array($rsversion);

		if($countversion!=''){
		$versionName = 'V'.($countversion+1);

		$versionIdNew = $countversion+1;

		}

		$k=GetPageRecord('*','costsheetVersionMaster','1 and styleId="'.decode($_POST['editId']).'" and versionId="'.$versionId.'"');
		$costDatafinal=mysqli_fetch_array($k);

	    $namevalue11 = 'styleId="'.decode($_POST['editId']).'",versionId="'.$versionIdNew.'",versionName="'.$versionName.'",dateAdded="'.time().'",addedBy="'.$_SESSION['userid'].'",factoryoverheadtext="'.$costDatafinal['factoryoverheadtext'].'",c16text="'.$costDatafinal['c16text'].'",totalmrp="'.$costDatafinal['totalmrp'].'",mrptotallast="'.$costDatafinal['mrptotallast'].'",finalgrandtotalwithmrp="'.$costDatafinal['finalgrandtotalwithmrp'].'",factoryoverheadafterper="'.$costDatafinal['factoryoverheadafterper'].'",totaljobworkcharges="'.$costDatafinal['totaljobworkcharges'].'",totalwithoutc16="'.$costDatafinal['totalwithoutc16'].'",c16percent="'.$costDatafinal['c16percent'].'",buyerStatus="'.$costDatafinal['buyerStatus'].'",buyerNotes="'.$costDatafinal['buyerNotes'].'",totalcostfob="'.$costDatafinal['totalcostfob'].'",customermarkup="'.$costDatafinal['customermarkup'].'",customermarkupvalue="'.$costDatafinal['customermarkupvalue'].'",discountsellingprice="'.$costDatafinal['discountsellingprice'].'",discountsellingpricevalue="'.$costDatafinal['discountsellingpricevalue'].'",sellingprice="'.$costDatafinal['sellingprice'].'",effectivesellingprice="'.$costDatafinal['effectivesellingprice'].'",profit="'.$costDatafinal['profit'].'",inrvalue="'.$costDatafinal['inrvalue'].'",profitlosspercent="'.$costDatafinal['profitlosspercent'].'",bidinrvalue="'.$costDatafinal['bidinrvalue'].'",buyerCostStatus="'.$_POST['buyerCostStatus'].'"';

$newversionId = addlistinggetlastid('costsheetVersionMaster',$namevalue11);


		$selectd='*';
		$whered='styleId="'.$editId.'" and costsheetVersionId="'.$versionId.'"';
		$rsd=GetPageRecord($selectd,'styleSubCategoryMaster',$whered);
		while($duplicateRecords=mysqli_fetch_array($rsd)){

		$namevalue121 ='name="'.$duplicateRecords['name'].'",materialid="'.$duplicateRecords['materialid'].'",materialType="'.$duplicateRecords['materialType'].'",subCategoryId="'.$duplicateRecords['subCategoryId'].'",status="'.$duplicateRecords['status'].'",styleId="'.$editId.'",sr="'.$duplicateRecords['sr'].'",assignTo="'.$duplicateRecords['assignTo'].'",costsheetVersionId="'.$versionIdNew.'",qtyStatus="'.$duplicateRecords['qtyStatus'].'",priceStatus="'.$duplicateRecords['priceStatus'].'",vendorStatus="'.$duplicateRecords['vendorStatus'].'",materialdescriptionid="'.$duplicateRecords['materialdescriptionid'].'",assignToPurMerchant="'.$duplicateRecords['assignToPurMerchant'].'",colorSeparate="'.$duplicateRecords['colorSeparate'].'",sizeSeparate="'.$duplicateRecords['sizeSeparate'].'"';
		$addddddd = addlisting('styleSubCategoryMaster',$namevalue121);
		}


		$whereCheckEx='styleId="'.$editId.'" and costsheetVersionId="'.$versionId.'"';
		$checkCodeEx = checkduplicate('extraChargesDetailMaster',$whereCheckEx);
		if($checkCodeEx == 'yes'){
			$selectd1='*';
			$whered1='styleId="'.$editId.'" and costsheetVersionId="'.$versionId.'"';
			$rsd1=GetPageRecord($selectd1,'extraChargesDetailMaster',$whered1);
			while($duplicateRecords1=mysqli_fetch_array($rsd1)){

			$namevalueex='styleId="'.$editId.'",costsheetVersionId="'.$versionIdNew.'",bomSerialNoextra="'.$duplicateRecords1['bomSerialNoextra'].'",bomAvgextra="'.$duplicateRecords1['bomAvgextra'].'",bomUnitextra="'.$duplicateRecords1['bomUnitextra'].'",bomUSDextra="'.$duplicateRecords1['bomUSDextra'].'",bomINRextra="'.$duplicateRecords1['bomINRextra'].'",bomRateextra="'.$duplicateRecords1['bomRateextra'].'",bomvalueonepcextra="'.$duplicateRecords1['bomvalueonepcextra'].'",addToCostextra="'.$duplicateRecords1['addToCostextra'].'",bomCommentextra="'.$duplicateRecords1['bomCommentextra'].'"';
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


			$namevaluetpDetail='costsheetVersionId="'.$versionIdNew.'",sectionType="'.$duplicateRecords12['sectionType'].'",styleId="'.$duplicateRecords12['styleId'].'",typeOfMachine="'.$duplicateRecords12['typeOfMachine'].'",remark="'.$duplicateRecords12['remark'].'",bomCategoryId="'.$duplicateRecords12['bomCategoryId'].'",bomSubCategoryId="'.$duplicateRecords12['bomSubCategoryId'].'",bomSerialNo="'.$duplicateRecords12['bomSerialNo'].'",bomQuality="'.$duplicateRecords12['bomQuality'].'",bomColorFirst="'.$duplicateRecords12['bomColorFirst'].'",bomColorSecond="'.$duplicateRecords12['bomColorSecond'].'",bomPlacement="'.$duplicateRecords12['bomPlacement'].'",bomAvg="'.$duplicateRecords12['bomAvg'].'",bomWidth="'.$duplicateRecords12['bomWidth'].'",bomUnit="'.$duplicateRecords12['bomUnit'].'",bomSupplier="'.$duplicateRecords12['bomSupplier'].'",bomExInhouseDate="'.$duplicateRecords12['bomExInhouseDate'].'",bomComment="'.$duplicateRecords12['bomComment'].'",bomStatus="'.$duplicateRecords12['bomStatus'].'",cid="'.$duplicateRecords12['cid'].'",bomUSD="'.$duplicateRecords12['bomUSD'].'",bomINR="'.$duplicateRecords12['bomINR'].'",bomRate="'.$duplicateRecords12['bomRate'].'",bomvalueonepc="'.$duplicateRecords12['bomvalueonepc'].'",wastagePersent="'.$duplicateRecords12['wastagePersent'].'",avgIncWastage="'.$duplicateRecords12['avgIncWastage'].'",storesupplier="'.$duplicateRecords12['storesupplier'].'",addToCost="'.$duplicateRecords12['addToCost'].'"';
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
<?php
 /////////////////image gallery///////////////////

if(trim($_POST['action'])=='styleimagegallery' && trim($_REQUEST['parentid'])!=''){
include "smart_resize_image.function.php";
$name=clean($_POST['name']);
$parentid=decode($_REQUEST['parentid']);

//if($_FILES['attachmentImage']['name']!=''){
//$file_name=$_FILES['attachmentImage']['name'];
//$file_name=time().'-'.$file_name;
//copy($_FILES['attachmentImage']['tmp_name'],"images/".$file_name);
//}

if(!empty($_FILES['attachmentImage']['name'])){

	$file_name = $_FILES['attachmentImage']['name'];
	$temp_img = $_FILES['attachmentImage']['tmp_name'];//full path of the image of OR temp path of the file
        $image1 = getfilename($file_name); // rename the file befor upload
        // get the full size image
        if(makeDir('images/') === true){
            $directoryName ='images/';
            $targetedFile = $directoryName.$image1; // save custom name and full path after upload/ foldeer to database
            $width      = 400; //$_POST['width'];
            $height     = 400; //$_POST['height'];
            $quality    = 80; //$_POST['quality'];
            smart_resize_image($temp_img , null, $width , $height , false , $targetedFile , false , false ,$quality ); //excute the code to resize image
        }
        // get the thumb image
        //if(makeDir('images/_thumb/') === true){
//            $directoryName ='images/_thumb/';
//            $targetedFile = $directoryName.$image1; // uploaded file path with customize name
//            $width      = 100; //$_POST['width'];
//            $height     = 50; //$_POST['height'];
//            $quality    = 80;//$_POST['quality'];
//            smart_resize_image($temp_img , null, $width , $height , false , $targetedFile , false , false ,$quality ); //excute the code to resize image
//        }
}

$file_name=$image1;

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
$tna=clean($_POST['tna']);
$totaldays=clean($_POST['totaldays']);
$dateAdded=time();
$modifyDate=time();

$criticalPath = $_POST['criticalPath'];
$tnatemplate = $_POST['tnatemplate'];

$namevalue ='criticalPath="'.$criticalPath.'",description="'.$description.'",name="'.$name.'",dateAdded="'.$dateAdded.'",tna="'.$tna.'",tnatemplate="'.$tnatemplate.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",totaldays="'.$totaldays.'",modifyBy="'.$_SESSION['userid'].'"';
$adds = addlisting('taskListMaster',$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1&stylerefid=<?php echo $_REQUEST['stylerefid']; ?>');
</script>
<?php }
if(trim($_POST['action'])=='tasklistmaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$tna=clean($_POST['tna']);
$totaldays=clean($_POST['totaldays']);

$criticalPath = $_POST['criticalPath'];
$tnatemplate = $_POST['tnatemplate'];
$status=clean($_POST['status']);

$modifyDate=time();
$where='id='.decode($_POST['editId']).'';
$namevalue ='criticalPath="'.$criticalPath.'",description="'.$description.'",name="'.$name.'",tna="'.$tna.'",status="'.$status.'",modifyDate="'.$modifyDate.'",totaldays="'.$totaldays.'",tnatemplate="'.$tnatemplate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('taskListMaster',$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2&stylerefid=<?php echo $_REQUEST['stylerefid']; ?>');
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
if(trim($_POST['action'])=='companymaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$companyId=clean($_POST['companyId']);
$shortname=clean($_POST['shortname']);
$bemail=clean($_POST['email']);
$bphone=clean($_POST['phone']);
$status=clean($_POST['status']);
$dateAdded=time();
$namevalue ='name="'.$name.'",companyId="'.$companyId.'",companyShortName="'.$shortname.'",email="'.$bemail.'",phone="'.$bphone.'",status="'.$status.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlistinggetlastid('companyMaster',$namevalue);
$cq=GetPageRecord('*','companyMaster','1 and name!="" and id!="'.$adds.'"  order by id desc limit 1');
$comData=mysqli_fetch_array($cq);

//=========================add company wise accounts==========================================

$kk=GetPageRecord('*','finalheadcreationmaster','1 and parent=0 and companyId="'.$comData['id'].'" order by id asc');
while($headeerCreationdetails=mysqli_fetch_array($kk)){
$namevalue11 ='label="'.$headeerCreationdetails['label'].'",parent="'.$headeerCreationdetails['parent'].'",description="'.$headeerCreationdetails['description'].'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",companyId="'.$adds.'"';
$lastId = addlistinggetlastid('finalheadcreationmaster',$namevalue11);
//=============================firstlevel

$kkkk=GetPageRecord('*','finalheadcreationmaster','1 and parent="'.$headeerCreationdetails['id'].'" and companyId="'.$comData['id'].'"');
while($subheadeerCreationdetails=mysqli_fetch_array($kkkk)){
$namevalu22e ='label="'.$subheadeerCreationdetails['label'].'",parent="'.$lastId.'",description="'.$subheadeerCreationdetails['description'].'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",companyId="'.$adds.'"';
$lastId2=addlistinggetlastid('finalheadcreationmaster',$namevalu22e);
//================================second level
$kkkmmmk=GetPageRecord('*','finalheadcreationmaster','1 and parent="'.$subheadeerCreationdetails['id'].'" and companyId="'.$comData['id'].'"');
while($subheadeerCreationdetailssecond=mysqli_fetch_array($kkkmmmk)){
$nameval33u22e ='label="'.$subheadeerCreationdetailssecond['label'].'",parent="'.$lastId2.'",description="'.$subheadeerCreationdetailssecond['description'].'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",companyId="'.$adds.'"';
$lastId3=addlistinggetlastid('finalheadcreationmaster',$nameval33u22e);
//================================third level
$kmmk =GetPageRecord('*','finalheadcreationmaster','1 and parent="'.$subheadeerCreationdetailssecond['id'].'" and companyId="'.$comData['id'].'"');
while($subheadeerCreationdetailthied=mysqli_fetch_array($kmmk)){
$nameweeval44u22e ='label="'.$subheadeerCreationdetailthied['label'].'",parent="'.$lastId3.'",description="'.$subheadeerCreationdetailthied['description'].'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",companyId="'.$adds.'"';
$lastId4=addlistinggetlastid('finalheadcreationmaster',$nameweeval44u22e);
//================================fourth  level
$kmmkkgkfkwew =GetPageRecord('*','finalheadcreationmaster','1 and parent="'.$subheadeerCreationdetailthied['id'].'" and companyId="'.$comData['id'].'"');
while($subheadeerCreationdetailfourth=mysqli_fetch_array($kmmkkgkfkwew)){
$nameweeval55u22e ='label="'.$subheadeerCreationdetailfourth['label'].'",parent="'.$lastId4.'",description="'.$subheadeerCreationdetailfourth['description'].'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",companyId="'.$adds.'"';
$lastId5=addlistinggetlastid('finalheadcreationmaster',$nameweeval55u22e);
//================================fifth  level
}
}
}
}
}

?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>
<?php }
if(trim($_POST['action'])=='companymaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$companyId=clean($_POST['companyId']);
$shortname=clean($_POST['shortname']);
$bemail=clean($_POST['email']);
$bphone=clean($_POST['phone']);
$status=clean($_POST['status']);
$currencyId=clean($_POST['currencyId']);

$businessSegmentabc = $_POST['businessSegment'];
$businessSegment = implode(",", $businessSegmentabc);
$productCategoryabc = $_POST['productCategory'];
$productCategory = implode(",", $productCategoryabc);
$financialbegin=date('Y-m-d', strtotime(clean($_POST['financialbegin'])));
$bookbegin=date('Y-m-d', strtotime(clean($_POST['bookbegin'])));

$modifyDate=time();

$where='id='.decode($_POST['editId']).'';

$namevalue ='name="'.$name.'",companyId="'.$companyId.'",companyShortName="'.$shortname.'",email="'.$bemail.'",phone="'.$bphone.'",status="'.$status.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",companyCurrency="'.$currencyId.'",modifyBy="'.$_SESSION['userid'].'",businessSegment="'.$businessSegment.'",productCategory="'.$productCategory.'",financialbegin="'.$financialbegin.'",bookbegin="'.$bookbegin.'"';
$update = updatelisting('companyMaster',$namevalue,$where);
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
$buyerId=clean($_POST['buyerId']);
$status=clean($_POST['status']);
$brandId=clean($_POST['brandId']);
$default=clean($_POST['default']);
$dateAdded=time();


$namevalue ='bydefault="'.$default.'",name="'.$name.'",startDate="'.$startDate.'",status="'.$status.'",enddate="'.$enddate.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",buyerId="'.$buyerId.'",brandId="'.$brandId.'"';
$adds = addlisting(_SEASON_MASTER_,$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=buyermaster&view=yes&id=<?php echo encode($buyerId); ?>');
</script>
<?php }
if(trim($_POST['action'])=='seasonmaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$startDate=date('Y-m-d', strtotime(clean($_POST['startDate'])));
$enddate=date('Y-m-d', strtotime(clean($_POST['enddate'])));
$buyerId=clean($_POST['buyerId']);
$status=clean($_POST['status']);
$brandId=clean($_POST['brandId']);
$default=clean($_POST['default']);
$modifyDate=time();
if($_POST['default']!=''){

// $rsseasona=GetPageRecord('*',_SEASON_MASTER_,'1 and id="'.decode($_POST['editId']).'"');
// $resultlistsa=mysqli_fetch_array($rsseasona);

$wherez='buyerId="'.$buyerId.'" ';
$namevaluez ='bydefault="0"';
$update = updatelisting(_SEASON_MASTER_,$namevaluez,$wherez);
}
$where='id='.decode($_POST['editId']).'';
$namevalue ='bydefault="'.$default.'",name="'.$name.'",status="'.$status.'",startDate="'.$startDate.'",enddate="'.$enddate.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'",buyerId="'.$buyerId.'",brandId="'.$brandId.'"';
$update = updatelisting(_SEASON_MASTER_,$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=buyermaster&view=yes&id=<?php echo encode($buyerId); ?>');
</script>
<?php }
/////////////////Sub Category Master///////////////////
if(trim($_POST['action'])=='subcategorymaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$categoryId=clean($_POST['categoryId']);
$description=clean($_POST['description']);
$status=clean($_POST['status']);
$gender=clean($_POST['gender']);

if(isset($_POST['sampleTaskId'])){
	foreach($_POST['sampleTaskId'] as $k1=>$v1){
		$sampleTaskId .= $_POST['sampleTaskId'][$k1].',';
	}
}
$sampleTaskId = str_replace('Array','',$sampleTaskId);
$dateAdded=time();
$string = $_POST['material'];
$str_arr = implode(",", $string);
$namevalue ='name="'.$name.'",categoryId="'.$categoryId.'",materialid="'.$str_arr.'",sampleTaskId="'.$sampleTaskId.'",description="'.$description.'",status="'.$status.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",gender="'.$gender.'"';
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
$gender=clean($_POST['gender']);
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
$namevalue ='name="'.$name.'",categoryId="'.$categoryId.'",materialid="'.$str_arr.'",sampleTaskId="'.$sampleTaskId.'",description="'.$description.'",status="'.$status.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",gender="'.$gender.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting(_SUB_CATEGORY_MASTER_,$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>
<?php }

/////////////////materal Master///////////////////
if(trim($_POST['action'])=='materialmaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!='' && trim($_POST['categoryId'])!=''){
$name=stripslashes($_POST['name']);
$categoryId=clean($_POST['categoryId']);
$description=stripslashes($_POST['description']);
$status=clean($_POST['status']);
$dateAdded=time();
$materialSubTypeId=clean($_POST['materialSubTypeId']);
$finishId=clean($_POST['finishId']);

$longDescription=stripslashes($_POST['longDescription']);
$shortDescription=stripslashes($_POST['shortDescription']);
$sapCode=stripslashes($_POST['sapCode']);
$materialStatus=clean($_POST['materialStatus']);
if($categoryId==1){
if($materialSubTypeId==31){
$randId = rand(6,100000);
$randId = 'G-'.$randId;
}else{
$randId = rand(6,100000);
$randId = 'F-'.$randId;
}
}elseif($categoryId==2){
$randId = rand(6,100000);
$randId = 'T-'.$randId;
}else{
$randId = rand(6,100000);
$randId = 'PKG-'.$randId;
}
if($_FILES['materialimage']['name']!=''){
$file_name=$_FILES['materialimage']['name'];
$file_name=time().'-'.str_replace(' ', '_',$file_name);
$file_name= str_replace('#', 'f',$file_name);
copy($_FILES['materialimage']['tmp_name'],"images/".$file_name);
}


$whereCheck='name="'.$name.'" and materialtype="'.$categoryId.'"';
$checkCode = checkduplicate(_MATERIAL_MASTER_,$whereCheck);
if($checkCode=='yes'){
?>
<script>
alert('This Material is aleready exist.');
</script>
<?php




} else{
$namevalue ='name="'.$name.'",materialtype="'.$categoryId.'",description="'.$description.'",materialimage="'.$file_name.'",status="'.$status.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",materialUniqueId="'.$randId.'",materialStatus="'.$materialStatus.'",materialSubTypeId="'.$materialSubTypeId.'",finishId="'.$finishId.'"';
$lasttid=addlistinggetlastid(_MATERIAL_MASTER_,$namevalue);

$namevalueee ='longDescription="'.$longDescription.'",shortDescription="'.$shortDescription.'",sapCode="'.$sapCode.'",materialTypeId="'.$categoryId.'",materialid="'.$lasttid.'"';
$addsee = addlisting('materialDescriptionMaster',$namevalueee);

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
 $materialSubTypeId=clean($_POST['materialSubTypeId']);
$finishId=clean($_POST['finishId']);
$longDescription=trim($_POST['longDescription']);
$shortDescription=clean($_POST['shortDescription']);
$sapCode=clean($_POST['sapCode']);
$materialStatus=clean($_POST['materialStatus']);
if($_POST['materialUniqueId']==''){
	if($categoryId==1){
		if($materialSubTypeId==31){
			$randId = rand(6,100000);
			$randId = 'G-'.$randId;
		}else{
			$randId = rand(6,100000);
			$randId = 'F-'.$randId;
		}
	}elseif($categoryId==2){
		$randId = rand(6,100000);
		$randId = 'T-'.$randId;
	}else{
		$randId = rand(6,100000);
		$randId = 'PKG-'.$randId;
	}
}else{
$randId = $_POST['materialUniqueId'];
}
if($_FILES['materialimage']['name']!=''){
$file_name=$_FILES['materialimage']['name'];
$file_name=time().'-'.str_replace(' ', '_',$file_name);
$file_name= str_replace('#', 'f',$file_name);
copy($_FILES['materialimage']['tmp_name'],"images/".$file_name);
}
else{
$file_name =$_POST['materialimageedit'];
}

$modifyDate=time();
$where='id='.decode($_POST['editId']).'';
$namevalue ='name="'.$name.'",materialtype="'.$categoryId.'",description="'.$description.'",materialimage="'.$file_name.'",status="'.$status.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'",materialUniqueId="'.$randId.'",materialStatus="'.$materialStatus.'",materialSubTypeId="'.$materialSubTypeId.'",finishId="'.$finishId.'"';
$update = updatelisting(_MATERIAL_MASTER_,$namevalue,$where);
$whereCheckref='materialid='.decode($_POST['editId']).' and materialTypeId="'.$categoryId.'"';

$checkCoderef = checkduplicate('materialDescriptionMaster',$whereCheckref);
if($checkCoderef=="yes"){
$update = updatelisting('materialDescriptionMaster','longDescription="'.$longDescription.'",shortDescription="'.$shortDescription.'",sapCode="'.$sapCode.'"','materialid='.decode($_POST['editId']).' and materialTypeId="'.$categoryId.'"');

}
else{
$namevalueee ='longDescription="'.$longDescription.'",shortDescription="'.$shortDescription.'",sapCode="'.$sapCode.'",materialTypeId="'.$categoryId.'",materialid="'.decode($_POST['editId']).'"';
$addsee = addlisting('materialDescriptionMaster',$namevalueee);

}

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
$departmentId=clean($_POST['departmentId']);
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
$namevalue ='name="'.$name.'",empCode="'.$empCode.'",empType="'.$empType.'",designationId="'.$designationId.'",email="'.$email.'",phone="'.$phone.'",address="'.$address.'",countryId="'.$countryId.'",stateId="'.$stateId.'",cityId="'.$cityId.'",pinCode="'.$pinCode.'",workLocation="'.$workLocation.'",status="'.$status.'",reportingTo="'.$reportingTo.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",categoryId="'.$categoryId.'",departmentId="'.$departmentId.'"';
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
$departmentId=clean($_POST['departmentId']);
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
$namevalue ='name="'.$name.'",empCode="'.$empCode.'",empType="'.$empType.'",designationId="'.$designationId.'",email="'.$email.'",phone="'.$phone.'",address="'.$address.'",countryId="'.$countryId.'",stateId="'.$stateId.'",cityId="'.$cityId.'",pinCode="'.$pinCode.'",workLocation="'.$workLocation.'",status="'.$status.'",reportingTo="'.$reportingTo.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'",categoryId="'.$categoryId.'",departmentId="'.$departmentId.'"';
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
if(trim($_POST['action'])=='buyermaster' && trim($_POST['name'])!='' && $_POST['editId']==''){

$name=clean($_POST['name']);
$buyerId=clean($_POST['buyerId']);
$shortname=clean($_POST['shortname']);
$bemail=clean($_POST['bemail']);
$bphone=clean($_POST['bphone']);
$status=clean($_POST['status']);
$modifyDate=time();
$namevalue ='name="'.$name.'",buyerId="'.$buyerId.'",buyerShortName="'.$shortname.'",buyeremail="'.$bemail.'",buyerphone="'.$bphone.'",status="'.$status.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'"';
$adds = addlisting(_BUYER_MASTER_,$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=buyermaster&alt=1');
</script>
<?php
}
//add supplier table data
if(trim($_POST['action'])=='addsupplier' && trim($_POST['suppliername'])!='' && $_POST['editId']==''){
$supplierid=addslashes($_POST['supplierid']);
$suppliername=clean($_POST['suppliername']);
$email=clean($_POST['email']);
$phone=clean($_POST['phone']);

$dateAdded=time();
$namevalue ='supplierId="'.$supplierid.'",name="'.$suppliername.'",email="'.$email.'",phone="'.$phone.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'",modifyBy="'.$_SESSION['userid'].'",modifyDate="'.$dateAdded.'"';
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
if(trim($_POST['action'])=='editsupplier' && trim($_POST['suppliername'])!='' && $_POST['editId']!='' && $_POST['companyId']!=''){
$supplierid=addslashes($_POST['supplierid']);
$suppliername=clean($_POST['suppliername']);
$email=clean($_POST['email']);
$phone=clean($_POST['phone']);
$supplierCurrency=clean($_POST['supplierCurrency']);
$dateAdded=time();
$modifyDate=time();
$companyId=clean($_POST['companyId']);
$leadTime=clean($_POST['leadTime']);
$transitTime=clean($_POST['transitTime']);

$where='id='.decode($_POST['editId']).'';
$namevalue ='supplierId="'.$supplierid.'",name="'.$suppliername.'",email="'.$email.'",phone="'.$phone.'",supplierCurrency="'.$supplierCurrency.'",addedBy="'.$_SESSION['userid'].'",modifyBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'",modifyDate="'.$modifyDate.'",companyId="'.$companyId.'",leadTime="'.$leadTime.'",transitTime="'.$transitTime.'"';
$update = updatelisting(_SUPPLIERS_MASTER_,$namevalue,$where);
$krsk=GetPageRecord('*','finalheadcreationmaster','companyId="'.$companyId.'" and label="Sundry Creditors"');
$headData=mysqli_fetch_array($krsk);

//==============check duplicate===================================================
$namevalue11 ='label="'.$suppliername.'",parent="'.$headData['id'].'",description="'.$suppliername.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",companyId="'.$companyId.'",type="suppliers"';
$whereCheckref='parent="'.$headData['id'].'" and  label="'.$suppliername.'"';
$checkCoderef = checkduplicate('finalheadcreationmaster',$whereCheckref);
if($checkCoderef=="no"){
$lastId = addlistinggetlastid('finalheadcreationmaster',$namevalue11);
} else{
$update = updatelisting('finalheadcreationmaster',$namevalue11,'parent="'.$headData['id'].'" and  label="'.$name.'"');

}


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
$dateAdded=time();
$namevalue ='supplierId="'.$supplierid.'",name="'.$suppliername.'",email="'.$email.'",phone="'.$phone.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'",modifyBy="'.$_SESSION['userid'].'",modifyDate="'.$dateAdded.'"';
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
$dateAdded=time();
$modifyDate=time();
$supplierCurrency=addslashes($_POST['supplierCurrency']);

$companyId=addslashes($_POST['companyId']);

$where='id='.decode($_POST['editId']).'';
$namevalue ='supplierId="'.$supplierid.'",name="'.$suppliername.'",email="'.$email.'",phone="'.$phone.'",supplierCurrency="'.$supplierCurrency.'",addedBy="'.$_SESSION['userid'].'",modifyBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'",modifyDate="'.$modifyDate.'",companyId="'.$companyId.'"';
$update = updatelisting(_VENDOR_MASTER_,$namevalue,$where);
$krsk=GetPageRecord('*','finalheadcreationmaster','companyId="'.$companyId.'" and label="Sundry Creditors"');
$headData=mysqli_fetch_array($krsk);
//==============check duplicate===================================================
$namevalue11 ='label="'.$suppliername.'",parent="'.$headData['id'].'",description="'.$suppliername.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",companyId="'.$companyId.'",type="vendors"';

$whereCheckref='parent="'.$headData['id'].'" and  label="'.$suppliername.'"';
$checkCoderef = checkduplicate('finalheadcreationmaster',$whereCheckref);
if($checkCoderef=="no"){
$lastId = addlistinggetlastid('finalheadcreationmaster',$namevalue11);
} else{
$update = updatelisting('finalheadcreationmaster',$namevalue11,'parent="'.$headData['id'].'" and  label="'.$name.'"');

}

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
$mailto=$listing1['userName'];
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
$mailtoadmin=$adminEmail['userName'];
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
include "config/mail.php";
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
$assignTo=clean($_POST['assignTo']);
if($assignTo!=''){
if($_POST['styleTypeId']==2){
$statusId=19;
}else{
$statusId=18;
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
$mailto=$listing1['userName'];
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

send_template_mail_query($fromemail,$mailto,$mailsubject,$maildescription,$ccmail);
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
$mailto=$listing1['userName'];
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
$mailtoadmin=$adminEmail['userName'];
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
//send_template_mail_query($fromemail,$mailtouser,$mailsubject,$mailDesuser,$ccmail);
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
$mailto=$listing1['userName'];
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
$mailtoadmin=$adminEmail['userName'];
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
$mailto=$resultpage1['userName'];
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
$category=clean($_POST['category']);
$defaultcharesvalue=clean($_POST['defaultcharesvalue']);
$dateAdded=time();
$namevalue ='name="'.$name.'",description="'.$description.'",chargestype="'.$chargestype.'",category="'.$category.'",status="'.$status.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$dateAdded.'",defaultcharesvalue="'.$defaultcharesvalue.'",modifyBy="'.$_SESSION['userid'].'"';
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
$category=clean($_POST['category']);
$defaultcharesvalue=clean($_POST['defaultcharesvalue']);

$modifyDate=time();
$where='id="'.decode($_POST['editId']).'"';
$namevalue ='name="'.$name.'",description="'.$description.'",chargestype="'.$chargestype.'",category="'.$category.'",status="'.$status.'",defaultcharesvalue="'.$defaultcharesvalue.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
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
if($qtyTotal!="" && $qtyTotal!="0"){
	$where2='id="'.$styleId.'"';
	$update = updatelisting('queryMaster','orderQty="'.$qtyTotal.'"',$where2);
}
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
$mailsubject=''.$systemname.' - New Material List For Style# '.getStyleRefId($styleId).'';
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
 </tbody></table>';

$dateAdded=time();
$maildescription1 = addslashes($maildescription);
$namevalue ='subject="'.$mailsubject.'",description="'.$maildescription1.'",adddate="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",styleid="'.$styleId.'",supplierid="'.$assignSupplierId.'",inHouseComment="'.$_POST['remark'].'",status="1"';
$lastidsupplieremail = addlistinggetlastid('supplierPurchasemail',$namevalue);
$maildescription = $maildescription.'<p><a href="'.$fullurl.'submit-supplier.php?st='.$_POST['styleId'].'&cv='.encode($_POST['costsheetVersionId']).'&s='.encode($assignSupplierId).'&emid='.encode($lastidsupplieremail).'" style="background-color: #11b76c; border-radius: 4px; color: #fff!important; padding: 8px 18px; font-size: 14px; text-decoration: none; display: inline-block;" target="_blank" class="showhide" >Submit Cost</a></p>
';
foreach($assignToMaterialInhouse as $materialId){
$inhouseRemark=$_POST['inhouseRemark'.$materialId];
$selectmtype='*';
$wheremtype='id="'.$materialId.'"';
$rstype=GetPageRecord($selectmtype,'styleSubCategoryMaster',$wheremtype);
$resListingtype=mysqli_fetch_array($rstype);
$namevalue ='materialTypeId="'.$resListingtype['materialType'].'",materialId="'.$materialId.'",styleId="'.$styleId.'",costsheetVersionId="'.$costsheetVersionId.'",supplierId="'.$assignSupplierId.'",inhouseRemark="'.$inhouseRemark.'",dateAdded="'.$dateAdded.'",supplierPurchaseEmailId="'.$lastidsupplieremail.'"';
$lastId = addlistinggetlastid('materialSendToSupplier',$namevalue);
}

send_template_mail_query($fromemail,$mailto,$mailsubject,$maildescription,$ccmail);
}
?>
<script>
parent.setupbox('showpage.crm?module=materialcost&add=yes&styleid=<?php echo $_POST['styleId']; ?>');
</script>
<?php
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
$mailsubject=''.$systemname.' - New Material List For Style# '.getStyleRefId($styleId).'';
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
$description=clean($_POST['description']);
$status=clean($_POST['status']);
$dateAdded=time();
$namevalue ='name="'.$name.'",line="'.$line.'",description="'.$description.'",status="'.$status.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$lastId = addlistinggetlastid('factoryMaster',$namevalue);
for($i=1;$i<=$line;$i++){
$namevalue ='factoryId="'.$lastId.'",status=1';
$adds = addlisting('factoryLineMaster',$namevalue);
}
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>
<?php }
if(trim($_POST['action'])=='factorymaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$line=clean($_POST['line']);
$description=clean($_POST['description']);
$status=clean($_POST['status']);
$modifyDate=time();

$where='id='.decode($_POST['editId']).'';
$namevalue ='name="'.$name.'",line="'.$line.'",description="'.$description.'",status="'.$status.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('factoryMaster',$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>
<?php }
if(trim($_POST['action'])=='changestyletype' && $_POST['editId']!='' && $_POST['assignTo']!='' ){
include "config/mail.php";
$styleId=decode($_POST['editId']);
$notes=clean($_POST['notes']);
$dateAdded=time();
$assignTo=clean($_POST['assignTo']);
$styleTypeId=clean($_POST['styleTypeId']);
$statusId='19';
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
$mailto=$listing1['userName'];
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
//Mail sent to Head or Merchant
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
$where1='id="'.$styleId.'"';
$namevalue1 ='styleTypeId="'.$styleTypeId.'"';
$update1 = updatelisting('queryMaster',$namevalue1,$where1);
?>
<script>
parent.setupbox('showpage.crm?module=style&view=yes&id=<?php echo encode($styleId); ?>');
</script>
<?php
}
if(trim($_POST['action'])=='assigntooutsourcemerchant' && $_POST['styleId']!='' && $_POST['assignTo']!=''){
include "config/mail.php";
$styleId=decode($_POST['styleId']);
$assignTo=clean($_POST['assignTo']);
$notes=clean($_POST['notes']);
$dateAdded=time();
$statusId = '21';
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
$mailto=$listing1['userName'];
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
$mailtoadmin=$adminEmail['userName'];
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
//send_template_mail_query($fromemail,$mailtoadmin,$mailsubject,$maildescriptionadmin,$ccmail);
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
$namevalue ='styleId="'.$styleId.'",assignTo="'.$assignTo.'",notes="'.$notes.'",statusId="'.$statusId.'",dateAdded="'.$dateAdded.'"';
$adds = addlisting('styleAssignmentMaster',$namevalue);
$whereassign='id="'.$styleId.'"';
if($loginuserprofileId==90){
$namevalueassign ='assignToVendor="'.$assignTo.'"';
}else{
$namevalueassign ='assignTo="'.$assignTo.'"';
}
$updateassign = updatelisting('queryMaster',$namevalueassign,$whereassign);
?>
<script>
parent.setupbox('showpage.crm?module=style&view=yes&id=<?php echo encode($styleId); ?>');
</script>
<?php
}
if(trim($_POST['action'])=='sendtopdoutsource' && $_POST['styleId']!='' && $_POST['pd']==1){
include "config/mail.php";
$vendorId=$_POST['vendorId'];
$pd=$_POST['pd'];
$styleId=decode($_POST['styleId']);
$dateAdded=time();
foreach($vendorId as $assignVendorId){
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
$mailsubject=''.$systemname.' - New Style# '.getStyleRefId($styleId).'';
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
				<p style="margin: 0; font-size: 14px; color: #1b1b1b; padding: 0 0px 8px 6px; line-height: 18px;">Please fill the final costing:</p>
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

</tbody></table>';
$dateAdded=time();
$maildescription1 = addslashes($maildescription);
$namevalue ='subject="'.$mailsubject.'",description="'.$maildescription1.'",adddate="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",styleid="'.$styleId.'",vendorid="'.$assignVendorId.'",inHouseComment="'.trim($_POST['notes']).'",status="1",pd=1';
$lastemailid = addlistinggetlastid('vendorPurchasemail',$namevalue);
$maildescription = $maildescription.'<p><a href="'.$fullurl.'submit-pdvendorcost.php?st='.$_POST['styleId'].'&s='.encode($assignVendorId).'&emid='.encode($lastemailid).'" style="background-color: #11b76c; border-radius: 4px; color: #fff!important; padding: 8px 18px; font-size: 14px; text-decoration: none; display: inline-block;" target="_blank" class="showhide" >Submit Cost</a></p>
';
$namevalue ='styleId="'.$styleId.'",vendorId="'.$assignVendorId.'",pd="'.$pd.'",dateAdded="'.$dateAdded.'",vendorPurchaseEmailId="'.$lastemailid.'"';
$lastId = addlistinggetlastid('materialSendToVendor',$namevalue);
send_template_mail_query($fromemail,$mailto,$mailsubject,$maildescription,$ccmail);
}
?>
<script>
parent.setupbox('showpage.crm?module=comparevendorcost&view=yes&styleid=<?php echo encode($styleId); ?>&pdoutsource=yes');
</script>
<?php
}
if(trim($_POST['action'])=='materialSendToInhouseOutsource' && $_POST['styleId']!='' && $_POST['vendorId']!='' && $_POST['pd']=='2' ){
include "config/mail.php";
$vendorId=$_POST['vendorId'];
$pd=$_POST['pd'];
$styleId=decode($_POST['styleId']);
$dateAdded=time();
foreach($vendorId as $assignvendorId){

$select='';
$where='';
$rs='';
$select='*';
$where='id="'.$assignvendorId.'"';
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
$mailsubject=''.$systemname.' - New Material List For Style# '.getStyleRefId($styleId).'';
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

</tbody></table>';
$dateAdded=time();
$maildescription1 = addslashes($maildescription);
$namevalue ='subject="'.$mailsubject.'",description="'.$maildescription1.'",adddate="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",styleid="'.$styleId.'",vendorid="'.$assignvendorId.'",inHouseComment="'.$_POST['remark'].'",status=1,pd=2';
$lastemailid = addlistinggetlastid('vendorPurchasemail',$namevalue);
$maildescription=$maildescription.'<p><a href="'.$fullurl.'submit-inhouseoutsource.php?st='.encode($styleId).'&cv='.encode(1).'&s='.encode($assignvendorId).'&emid='.encode($lastemailid).'" style="background-color: #11b76c; border-radius: 4px; color: #fff!important; padding: 8px 18px; font-size: 14px; text-decoration: none; display: inline-block;" target="_blank" class="showhide" >Submit Cost</a></p>
';
$rs1=GetPageRecord('*','styleSubCategoryMaster','styleId="'.$styleId.'" and costsheetVersionId=1');
while($resListingMaterial=mysqli_fetch_array($rs1)){

$whereCheck='styleId="'.$styleId.'" and costsheetVersionId=1 and vendorId="'.$assignvendorId.'" and materialTypeId="'.$resListingMaterial['materialType'].'" and materialId="'.$resListingMaterial['materialid'].'"';
$checkCode = checkduplicate('materialSendToVendor',$whereCheck);
//if($checkCode=='no'){
$namevalue ='materialTypeId="'.$resListingMaterial['materialType'].'",materialId="'.$resListingMaterial['materialid'].'",styleId="'.$styleId.'",costsheetVersionId=1,vendorId="'.$assignvendorId.'",pd="'.$pd.'",dateAdded="'.$dateAdded.'",vendorPurchaseEmailId="'.$lastemailid.'"';
$lastId = addlistinggetlastid('materialSendToVendor',$namevalue);
//}
/*else{
$where11='styleId="'.$styleId.'" and costsheetVersionId=1 and vendorId="'.$assignvendorId.'" and materialTypeId="'.$resListingMaterial['materialType'].'" and materialId="'.$resListingMaterial['materialid'].'"';
$namevalue11 ='materialTypeId="'.$resListingMaterial['materialType'].'",materialId="'.$resListingMaterial['materialid'].'",styleId="'.$styleId.'",costsheetVersionId=1,vendorId="'.$assignvendorId.'",pd="'.$pd.'",dateAdded="'.$dateAdded.'"';
updatelisting('materialSendToVendor',$namevalue11,$where11);
}*/
}

send_template_mail_query($fromemail,$mailto,$mailsubject,$maildescription,$ccmail);
}
?>
<script>
parent.setupbox('showpage.crm?module=comparevendorcost&view=yes&styleid=<?php echo encode($styleId); ?>&pdoutsource=yes');
</script>
<?php
}



/////////////////===============material descripton master-------------=================================///////////////////////////
if(trim($_REQUEST['action'])=="savematerialconfiguration" && $_REQUEST['categoryid']!=''){

$categoryid=trim($_REQUEST['categoryid']);
$fabric=addslashes($_REQUEST['fabric']);
$trim=addslashes($_REQUEST['trim']);
$packaging=addslashes($_REQUEST['packaging']);
$whereCheckref='categoryId="'.$categoryid.'"';
$checkCoderef = checkduplicate('materialConfigurationMaster',$whereCheckref);
if($checkCoderef=="yes"){
$namevalue ='fabric="'.$fabric.'",trim="'.$trim.'",packaging="'.$packaging.'"';
$where='categoryId="'.$categoryid.'"';
$update = updatelisting('materialConfigurationMaster',$namevalue,$where);
}
else{
$namevalue ='categoryid="'.$categoryid.'",fabric="'.$fabric.'",trim="'.$trim.'",packaging="'.$packaging.'"';
addlisting('materialConfigurationMaster',$namevalue);
}
}
/////////////////===============add line detail for apparel ERP-------------=================================///////////////////////////
if(trim($_REQUEST['action'])=="savelinedetails" && $_REQUEST['id']!=""){
$id=trim($_REQUEST['id']);
$lineName=addslashes($_REQUEST['linename']);
$workers=$_REQUEST['workers'];
$hours=$_REQUEST['hours'];
$minuteCapacity = trim($_REQUEST['minuteCapacity']);
$namevalue ='lineName="'.$lineName.'",workers="'.$workers.'",hours="'.$hours.'",minuteCapacity="'.$minuteCapacity.'"';
$where='id="'.$id.'"';
$update = updatelisting('factoryLineMaster',$namevalue,$where);
}
 /////////////////Slab master///////////////////
if(trim($_POST['action'])=='slabmaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$dateAdded=time();
$namevalue ='name="'.$name.'",description="'.$description.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$lastId = addlistinggetlastid('slabMaster',$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>
<?php }
if(trim($_POST['action'])=='slabmaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$modifyDate=time();

$where='id='.decode($_POST['editId']).'';
$namevalue ='name="'.$name.'",description="'.$description.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('slabMaster',$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>
<?php }
 /////////////////Add Slab Days master///////////////////
if(trim($_POST['action'])=='addslabdays' && trim($_POST['parentId'])!='' && trim($_POST['days'])!='' && trim($_POST['module'])!=''){

$days=clean($_POST['days']);
$efficiency=clean($_POST['efficiency']);
$parentId=decode($_POST['parentId']);
$dateAdded=time();
if(decode($_POST['editId'])==""){
$namevalue ='days="'.$days.'",efficiency="'.$efficiency.'",parentId="'.$parentId.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$lastId = addlistinggetlastid('slabMaster',$namevalue);
}
else{
$namevalue ='days="'.$days.'",efficiency="'.$efficiency.'",parentId="'.$parentId.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('slabMaster',$namevalue,'1 and id="'.decode($_POST['editId']).'"');
}
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&view=yes&id=<?php echo encode($parentId); ?>&alt=1');
</script>
<?php }
/*
if(trim($_POST['action'])=='addslabdays' && trim($_POST['parentId'])!='' && trim($_POST['days'])!='' && trim($_POST['module'])!=''){
$days=clean($_POST['days']);
$efficiency=clean($_POST['efficiency']);
$parentId=decode($_POST['parentId']);
$modifyDate=time();

$where='id='.decode($_POST['editId']).'';
$namevalue ='days="'.$days.'",efficiency="'.$efficiency.'",parentId="'.$parentId.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('slabMaster',$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&view=yes&id=<?php echo decode($_POST['parentId']); ?>&alt=2');
</script>
<?php }*/

 /////////////////Add SMV master///////////////////
if(trim($_POST['action'])=='smvmaster' && trim($_POST['editId'])!='' && trim($_POST['fromsmv'])!='' && trim($_POST['tosmv'])!='' && trim($_POST['module'])!=''){
$fromsmv=clean($_POST['fromsmv']);
$tosmv=clean($_POST['tosmv']);
$slabId=clean($_POST['slabId']);
$modifyDate=time();

$where='id='.decode($_POST['editId']).'';
$namevalue ='slabId="'.$slabId.'",modifyDate="'.$modifyDate.'",fromsmv="'.$fromsmv.'",tosmv="'.$tosmv.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('smvMaster',$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>
<?php }
 /////////////////Add SMV master///////////////////
if(trim($_POST['action'])=='smvmaster' && trim($_POST['editId'])=='' && trim($_POST['fromsmv'])!='' && trim($_POST['tosmv'])!='' && trim($_POST['module'])!=''){
$fromsmv=clean($_POST['fromsmv']);
$tosmv=clean($_POST['tosmv']);
$slabId=clean($_POST['slabId']);
$dateAdded=time();
$namevalue ='slabId="'.$slabId.'",dateAdded="'.$dateAdded.'",fromsmv="'.$fromsmv.'",tosmv="'.$tosmv.'",addedBy="'.$_SESSION['userid'].'"';
$lastId = addlistinggetlastid('smvMaster',$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>
<?php }
 /////////////////Create Chaalan///////////////////
if(trim($_POST['action'])=='chaalanmaster' && trim($_POST['styleId'])!='' && trim($_POST['module'])!=''){

$rs1=GetPageRecord('id','chaalanMaster','1 order by id desc');
$lastchaalanid=mysqli_fetch_array($rs1);
$ch=$lastchaalanid['id'];
if($ch==''){
$ch=1;
} else {
$ch=$ch+1;
}
$styleId=decode($_POST['styleId']);
$departmentId=clean($_POST['departmentId']);
$quantity=clean($_POST['qty']);
$quantityType=clean($_POST['quantityType']);
$remark=clean($_POST['remark']);
$chaalanno=date('Y-d').'/'.makeQueryId($styleId).'/'.makeQueryId($ch);
$dateAdded=date('Y-m-d H:i:s');
$namevalue ='styleId="'.$styleId.'",departmentId="'.$departmentId.'",quantity="'.$quantity.'",quantityType="'.$quantityType.'",remark="'.$remark.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",chaalanNo="'.$chaalanno.'"';
$lastId = addlistinggetlastid('chaalanMaster',$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>
<?php }
//====================add recorder masster==============================================
if(trim($_POST['action'])=='recordermaster' && $_POST['userid']!=''){

$factoryId=$_POST['factoryId'];
$userid=decode($_POST['userid']);
$lines=$_POST['lines'];
foreach($lines as $lineno){
$wheredelete='factoryId="'.$factoryId.'" and line="'.$lineno.'"';
deleteRecord('recorderMaster',$wheredelete);

$namevalue ='factoryId="'.$factoryId.'",userid="'.$userid.'",line="'.$lineno.'",addedBy="'.$_SESSION['userid'].'"';
addlisting('recorderMaster',$namevalue);
}
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_REQUEST['module']; ?>');
</script>
<?php
}
//====================add recorder input masster==============================================
if(trim($_POST['action'])=='saverecorderinput' && trim($_POST['styleId'])!='' && $_POST['hours']!=''){

$fromDate=date("Y-m-d", strtotime($_POST['fromDate']));
$factoryId=addslashes($_POST['factoryId']);
$line=addslashes($_POST['line']);
$hours=addslashes($_POST['hours']);
$styleId=decode(addslashes($_POST['styleId']));

$operator=addslashes($_POST['operator']);
$helper=addslashes($_POST['helper']);
$supervisor=addslashes($_POST['supervisor']);
$checker=addslashes($_POST['checker']);
$total=addslashes($_POST['total']);

$loading=addslashes($_POST['loading']);
$output=addslashes($_POST['output']);
$remarks=addslashes($_POST['remarks']);
$dateAdded=time();

$whereCheckref='fromDate="'.$fromDate.'" and factoryId="'.$factoryId.'" and line="'.$line.'" and hours="'.$hours.'" and styleId="'.$styleId.'"';
$checkCoderef = checkduplicate('recorderInputMaster',$whereCheckref);
$namevalue ='fromDate="'.$fromDate.'",factoryId="'.$factoryId.'",line="'.$line.'",hours="'.$hours.'",operator="'.$operator.'",helper="'.$helper.'",supervisor="'.$supervisor.'",checker="'.$checker.'",loading="'.$loading.'",output="'.$output.'",remarks="'.$remarks.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'",styleId="'.$styleId.'",total="'.$total.'"';

if($checkCoderef=="yes"){
$where='fromDate="'.$fromDate.'" and factoryId="'.$factoryId.'" and line="'.$line.'" and hours="'.$hours.'"';
$update = updatelisting('recorderInputMaster',$namevalue,$where);
}else{
addlisting('recorderInputMaster',$namevalue);
}
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_REQUEST['module']; ?>&alt=1');


</script>
<?php
}
if(trim($_REQUEST['action'])=="savetightcost"){
$styleId = decode($_POST['styleId']);
$avg = $_POST['avg'];
foreach($avg as $newavg){
$exparray = explode(',',$newavg );
$where=' styleId="'.$styleId.'" and materialTypeId="'.$exparray[1].'" and materialId="'.$exparray[2].'"';
deleteRecord('tightCostMaster',$where);
$namevalue ='materialTypeId="'.$exparray[1].'",materialId="'.$exparray[2].'",avg="'.$exparray[0].'",rate="'.$exparray[3].'",styleId="'.$styleId.'"';
$lastide = addlistinggetlastid('tightCostMaster',$namevalue);
}
?>
<script>
parent.setupbox('showpage.crm?module=comparevendorcost&view=yes&styleid=<?php echo encode($styleId); ?>&pdoutsource=yes');
</script>
<?
}
if(trim($_POST['action'])=='editgrn' && trim($_POST['editId'])!='' && trim($_POST['workPlaceId'])!='' && trim($_POST['supplierId'])!=''){
$editId= decode($_POST['editId']);
$factoryId = trim($_POST['factoryId']);
$supplierId = trim($_POST['supplierId']);
$docNo = trim($_POST['docNo']);
$docDate = date('Y-m-d',strtotime($_POST['docDate']));
$qcStatus = trim($_POST['qcStatus']);
$eWayBill = trim($_POST['eWayBill']);
$eWayBillDate = date('Y-m-d',strtotime($_POST['eWayBillDate']));
$ginNo = trim($_POST['ginNo']);
$ginDate = date('Y-m-d',strtotime($_POST['ginDate']));
$eSungamNo = trim($_POST['eSungamNo']);
$supplierPurchaseOrderId = trim($_POST['supplierPurchaseOrderId']);
$chargesDetail = trim($_POST['chargesDetail']);
$workPlaceId = trim($_POST['workPlaceId']);
$gateEntryNo = trim($_POST['gateEntryNo']);
$transporter = trim($_POST['transporter']);
$formNo = trim($_POST['formNo']);
$billitiNo = trim($_POST['billitiNo']);
$eWay = trim($_POST['eWay']);
$address = trim($_POST['address']);
$stateCode = trim($_POST['stateCode']);
$ieCode = trim($_POST['ieCode']);
$hsn = trim($_POST['hsn']);
$amount = trim($_POST['amount']);
$cgst = trim($_POST['cgst']);
$acceptBy = trim($_POST['acceptedBy']);
$preparedBy = trim($_POST['preparedBy']);
$prepareDate = date('Y-m-d',strtotime($_POST['preparedDate']));
$grnNo = 'DB'.makeQueryId($editId);
$where = 'id="'.$editId.'"';
$namevalue ='grnNo="'.$grnNo.'",factoryId="'.$factoryId.'",supplierId="'.$supplierId.'",docNo="'.$docNo.'",docDate="'.$docDate.'",qcStatus="'.$qcStatus.'",eWayBill="'.$eWayBill.'",eWayBillDate="'.$eWayBillDate.'",ginNo="'.$ginNo.'",ginDate="'.$ginDate.'",eSungamNo="'.$eSungamNo.'",supplierPurchaseOrderId="'.$supplierPurchaseOrderId.'",chargesDetail="'.$chargesDetail.'",workPlaceId="'.$workPlaceId.'",gateEntryNo="'.$gateEntryNo.'",formNo="'.$formNo.'",transporter="'.$transporter.'",billitiNo="'.$billitiNo.'",eWay="'.$eWay.'",address="'.$address.'",stateCode="'.$stateCode.'",ieCode="'.$ieCode.'",hsn="'.$hsn.'",amount="'.$amount.'",cgst="'.$cgst.'",acceptBy="'.$acceptBy.'",preparedBy="'.$preparedBy.'",prepareDate="'.$prepareDate.'"';
$update = updatelisting('grnMaster',$namevalue,$where);
$update = updatelisting('gateentrymaster','grnStatus=1','id="'.$gateEntryNo.'"');
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>');
</script>
<?php
}
/////////////////===============add status department wise-------------=================================///////////////////////////
if(trim($_REQUEST['action'])=="savestatuswisedepartment" && $_REQUEST['statusid']!='' && $_REQUEST['departmentName']!=''){

$statusid=trim($_REQUEST['statusid']);
$departmentName=trim($_REQUEST['departmentName']);
$update = updatelisting('statusMaster','departmentId="'.$departmentName.'"','id="'.$statusid.'"');
}


//add workplace master
if(trim($_POST['action'])=='addworkplace' && trim($_POST['type'])!='' && trim($_POST['name'])!='' && $_POST['editId']==''){
$type=addslashes($_POST['type']);
$name=clean($_POST['name']);
$email=clean($_POST['email']);
$phone=clean($_POST['phone']);
$address=clean($_POST['address']);
$countryId=clean($_POST['countryId']);
$stateId=clean($_POST['stateId']);
$cityId=clean($_POST['cityId']);
$dateAdded=time();
$namevalue ='type="'.$type.'",name="'.$name.'",email="'.$email.'",phone="'.$phone.'",address="'.$address.'",countryId="'.$countryId.'",stateId="'.$stateId.'",cityId="'.$cityId.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'"';
$adds = addlisting('workplaceMaster',$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=workplace&alt=1');
</script>
<?php
}
?>
<?php
//edit workplace master
if(trim($_POST['action'])=='editworkplace' && trim($_POST['type'])!='' && trim($_POST['name'])!='' && $_POST['editId']!=''){
$type=addslashes($_POST['type']);
$name=clean($_POST['name']);
$email=clean($_POST['email']);
$phone=clean($_POST['phone']);
$address=clean($_POST['address']);
$countryId=clean($_POST['countryId']);
$stateId=clean($_POST['stateId']);
$cityId=clean($_POST['cityId']);
$modifyDate=time();
$where='id='.decode($_POST['editId']).'';
$namevalue ='type="'.$type.'",name="'.$name.'",email="'.$email.'",phone="'.$phone.'",address="'.$address.'",countryId="'.$countryId.'",stateId="'.$stateId.'",cityId="'.$cityId.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'"';
$update = updatelisting('workplaceMaster',$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=workplace&alt=2');
</script>
<?php
}
//add prototypesample
if(trim($_POST['action'])=='dispatchdetailsave' && trim($_POST['styleId'])!='' && trim($_POST['module'])!=''){

$sampletype=addslashes($_POST['sampletype']);
$color=clean($_POST['color']);
$size=clean($_POST['size']);
$quantity=clean($_POST['quantity']);
$dispatchDate=date("Y-m-d", strtotime($_POST['dispatchDate']));
$pod=clean($_POST['pod']);
$remarks=clean($_POST['remarks']);
$styleId=decode(clean($_POST['styleId']));
$module=clean($_POST['module']);
$dateAdded=time();
if($_FILES['podattachment']['name']!=''){
$file_name=$_FILES['podattachment']['name'];
$file_name=time().'-'.str_replace(' ', '_',$file_name);
$file_name= str_replace('#', 'f',$file_name);
copy($_FILES['podattachment']['tmp_name'],"images/".$file_name);
}
else{
$file_name =$_POST['podattachmentEdit'];
}
$wheredelete=' styleid="'.$styleId.'" and module="'.$module.'"';
deleteRecord('sampleDispatchMaster',$wheredelete);
$namevalue ='sampletype="'.$sampletype.'",color="'.$color.'",size="'.$size.'",quantity="'.$quantity.'",dispatchDate="'.$dispatchDate.'",pod="'.$pod.'",remarks="'.$remarks.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'",styleid="'.$styleId.'",module="'.$module.'",podattachment="'.$file_name.'"';

$adds = addlisting('sampleDispatchMaster',$namevalue);

?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&add=yes&styleid=<?php echo $_POST['styleId']; ?>&alt=2');
</script>
<?php
}
//add addrress in buyer master
if(trim($_POST['action'])=='addressmaster' && trim($_POST['parentId'])!='' && $_POST['type']!=''){

$officeType=addslashes($_POST['officeType']);
$countryId=clean($_POST['countryId']);
$stateId=clean($_POST['stateId']);
$cityId=clean($_POST['cityId']);
$address=addslashes($_POST['address']);
$pinCode=addslashes($_POST['pinCode']);
$gstn=addslashes($_POST['gstn']);
$primaryAddress=addslashes($_POST['primaryAddress']);
$module=addslashes($_POST['module']);
$addressType=addslashes($_POST['type']);
if($addressType=='buyer'){
$module='buyermaster';
}
if($addressType=='supplier'){
$module='suppliers';
}
if($addressType=='vendors'){
$module='vendors';
}
$addressParent=decode($_POST['parentId']);
$dateAdded=time();
if($_POST['editId']==''){
$kk ='officeType="'.$officeType.'",countryId="'.$countryId.'",stateId="'.$stateId.'",cityId="'.$cityId.'",address="'.$address.'",pinCode="'.$pinCode.'",gstn="'.$gstn.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'",primaryAddress="'.$primaryAddress.'",addressType="'.$addressType.'",addressParent="'.$addressParent.'"';
$adds = addlisting('addressMaster',$kk);
} else {
$where='id='.decode($_POST['editId']).'';
$kk ='officeType="'.$officeType.'",countryId="'.$countryId.'",stateId="'.$stateId.'",cityId="'.$cityId.'",address="'.$address.'",pinCode="'.$pinCode.'",gstn="'.$gstn.'",modifyDate="'.$modifyDate.'",primaryAddress="'.$primaryAddress.'",addressType="'.$addressType.'",addressParent="'.$addressParent.'"';
$update = updatelisting('addressMaster',$kk,$where);

}
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $module; ?>&view=yes&id=<?php echo $_POST['parentId']; ?>');
</script>
<?php
}

//add contact information in buyer master
if(trim($_POST['action'])=='contactdetailmaster' && trim($_POST['buyerId'])!=''){

$contactPerson=addslashes($_POST['contactPerson']);
$email=clean($_POST['email']);
$phone=clean($_POST['phone']);
$designation=clean($_POST['designation']);
$buyerId=clean($_POST['buyerId']);

$type=addslashes($_POST['type']);
if($type=='buyer'){
$module='buyermaster';
}
if($type=='supplier'){
$module='suppliers';
}
if($type=='vendors'){
$module='vendors';
}

if($_POST['editId']==''){
$kk ='contactPerson="'.$contactPerson.'",email="'.$email.'",phone="'.$phone.'",designation="'.$designation.'",buyerId="'.$buyerId.'",type="'.$type.'"';
$adds = addlisting('contactPersonMaster',$kk);
} else{
$where='id='.decode($_POST['editId']).'';
$kk ='contactPerson="'.$contactPerson.'",email="'.$email.'",phone="'.$phone.'",designation="'.$designation.'",buyerId="'.$buyerId.'",type="'.$type.'"';
$update = updatelisting('contactPersonMaster',$kk,$where);

}
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $module; ?>&view=yes&id=<?php echo encode($_POST['buyerId']); ?>');
</script>
<?php
}
//add buyer brand buyer master
if(trim($_POST['action'])=='brandmaster' && trim($_POST['buyerId'])!=''){

$name=addslashes($_POST['name']);
$description=addslashes($_POST['description']);
$buyerId=clean($_POST['buyerId']);
$pdmerchant=clean($_POST['pdmerchant']);
$productionmerchant=clean($_POST['productionmerchant']);
$discount=clean($_POST['discount']);
$cpm=clean($_POST['cpm']);
$default=clean($_POST['default']);
if($_POST['editId']==''){
$kk ='bydefault="'.$default.'",name="'.$name.'",description="'.$description.'",buyerId="'.$buyerId.'",pdmerchant="'.$pdmerchant.'",productionmerchant="'.$productionmerchant.'",cpm="'.$cpm.'",discount="'.$discount.'"';
$adds = addlisting('brandMaster',$kk);
} else{


$wherez='buyerId='.$buyerId.'';
$namevaluez ='bydefault="0"';
$update = updatelisting("brandMaster",$namevaluez,$wherez);




$where='id='.decode($_POST['editId']).'';
$kk ='bydefault="'.$default.'",name="'.$name.'",description="'.$description.'",buyerId="'.$buyerId.'",pdmerchant="'.$pdmerchant.'",productionmerchant="'.$productionmerchant.'",cpm="'.$cpm.'",discount="'.$discount.'"';
$update = updatelisting('brandMaster',$kk,$where);

}
?>
<script>
parent.setupbox('showpage.crm?module=buyermaster&view=yes&id=<?php echo encode($_POST['buyerId']); ?>');
</script>
<?php
}
//add financial information
if(trim($_POST['action'])=='bankdetailmaster' && trim($_POST['masterId'])!=''){

$bankName=addslashes($_POST['bankName']);
$accountType=addslashes($_POST['accountType']);
$accountNumber=addslashes($_POST['accountNumber']);
$IFSCCode=addslashes($_POST['IFSCCode']);
$beneficiary=addslashes($_POST['beneficiary']);
$overdraftLimit=addslashes($_POST['overdraftLimit']);
$currencyId=addslashes($_POST['currencyId']);
$masterId=decode(addslashes($_POST['masterId']));

$type=addslashes($_POST['type']);
if($type=='buyer'){
$module='buyermaster';
}
if($type=='supplier'){
$module='suppliers';
}
if($type=='vendors'){
$module='vendors';
}
if($type=='company'){
$module='companymaster';
}
if($_POST['editId']==''){
$kk ='bankName="'.$bankName.'",accountType="'.$accountType.'",accountNumber="'.$accountNumber.'",IFSCCode="'.$IFSCCode.'",beneficiary="'.$beneficiary.'",overdraftLimit="'.$overdraftLimit.'",currencyId="'.$currencyId.'",masterId="'.$masterId.'",type="'.$type.'"';
$adds = addlisting('bankDetailsMaster',$kk);
} else{
$where='id='.decode($_POST['editId']).'';
$kk ='bankName="'.$bankName.'",accountType="'.$accountType.'",accountNumber="'.$accountNumber.'",IFSCCode="'.$IFSCCode.'",beneficiary="'.$beneficiary.'",overdraftLimit="'.$overdraftLimit.'",currencyId="'.$currencyId.'",masterId="'.$masterId.'",type="'.$type.'"';
$update = updatelisting('bankDetailsMaster',$kk,$where);
}

$krsk=GetPageRecord('*','finalheadcreationmaster','companyId="'.$masterId.'" and label="Bank Accounts"');
$headData=mysqli_fetch_array($krsk);
$bankNamefinal=$bankName.' '.$accountNumber;

$namevalue11 ='label="'.$bankNamefinal.'",parent="'.$headData['id'].'",description="'.$bankName.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",companyId="'.$masterId.'",type="bankaccounts"';
$lastId = addlistinggetlastid('finalheadcreationmaster',$namevalue11);

?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $module; ?>&view=yes&id=<?php echo $_POST['masterId']; ?>');
</script>
<?php
}
//add pcd
if(trim($_POST['action'])=='addpcd' && trim($_POST['editId'])!='' && trim($_POST['module'])!='' && $_POST['pcdDate']!=''){
$pcdDate=date('Y-m-d',strtotime($_POST['pcdDate']));
$shipDate=date('Y-m-d',strtotime($_POST['shipDate']));
$where='id="'.decode($_POST['editId']).'"';
$namevalue ='pcdDate="'.$pcdDate.'",shipDate="'.$shipDate.'"';
$update = updatelisting(_QUERY_MASTER_,$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>
<?php }
//add buyer Documents
if(trim($_POST['action'])=='addbuyerdocuments' && trim($_POST['masterId'])!=''  && $_POST['docType']!='' && $_POST['documentNo']!=''){

$docType=clean($_POST['docType']);
$documentNo=clean($_POST['documentNo']);
$issueDate=date("Y-m-d", strtotime($_POST['issueDate']));
$expiryDate=date("Y-m-d", strtotime($_POST['expiryDate']));
$countryId=clean($_POST['countryId']);
$status=clean($_POST['status']);
$dateAdded=time();
$type=addslashes($_POST['type']);
if($type=='buyer'){
$module='buyermaster';
}
if($type=='supplier'){
$module='suppliers';
}
if($type=='vendors'){
$module='vendors';
}

if($_FILES['attachment']['name']!=''){
$file_name=$_FILES['attachment']['name'];
$file_name=time().'-'.str_replace(' ', '_',$file_name);
$file_name= str_replace('#', 'f',$file_name);
copy($_FILES['attachment']['tmp_name'],"images/".$file_name);
}
else{
$file_name =$_POST['attachmentEdit'];
}
if($_POST['editId']==''){
$aaa ='docType="'.$docType.'",documentNo="'.$documentNo.'",issueDate="'.$issueDate.'",expiryDate="'.$expiryDate.'",countryId="'.$countryId.'",status="'.$status.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'",attachment="'.$file_name.'",type="'.$type.'",masterId="'.decode($_POST['masterId']).'"';
$adds = addlisting('documentMaster',$aaa);
}
else{
$where='id="'.decode($_POST['editId']).'"';
$aaa ='docType="'.$docType.'",documentNo="'.$documentNo.'",issueDate="'.$issueDate.'",type="'.$type.'",expiryDate="'.$expiryDate.'",countryId="'.$countryId.'",status="'.$status.'",attachment="'.$file_name.'",masterId="'.decode($_POST['masterId']).'"';
$update = updatelisting('documentMaster',$aaa,$where);
}
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $module; ?>&view=yes&id=<?php echo $_POST['masterId']; ?>&alt=2');
</script>
<?php
}
//assign to sourcing
if($_REQUEST['action']=='assigntosoursingteam' && $_REQUEST['assignToMaterial']!='' && $_REQUEST['assignto']!=''){
$description = $_POST['description'];
$styleId =decode($_POST['styleId']);
$costsheetversionid =$_POST['costsheetVersionId'];
$assignto = $_POST['assignto'];
$assignto = implode(",", $assignto);
$assignToMaterial2 = $_POST['assignToMaterial'];
$assignToMaterial1 = implode(",", $assignToMaterial2);
$assignToMaterial = rtrim($assignToMaterial1,',');
$array =  explode(',', $assignToMaterial);
foreach($array as $itennss) {
	 $update = updatelisting('indentCreationMaster','sendToBom="1"','techpackdetailId="'.$itennss.'"');

}
?>
<script>
parent.reload_page();
</script>
<?php
}
if($_REQUEST['action']=='indentSendtoBom' && $_POST['sellingValue']!=0 && $_POST['sellingValue']!=0){
$styleId = $_POST['styleId'];
$supplierId = $_POST['supplierId'];
$techpackdetailId = $_POST['techpackdetailId'];
$styleSubCateId = $_POST['styleSubCateId'];
$materialId = $_POST['materialId'];
$materialTypeId = $_POST['materialTypeId'];
$avg = $_POST['avg'];
$uom = $_POST['uom'];
$rate = $_POST['rate'];
$valueonepiece = $_POST['valueonepiece'];
$color = $_POST['color'];
$size = $_POST['size'];
$poQty = $_POST['poQty'];
$materialQty = $_POST['materialQty'];
$materialValue = $_POST['materialValue'];
$stockInStore = $_POST['stockInStore'];
$orderQty = $_POST['orderQty'];
$pendingQty = $_POST['pendingQty'];
$sellingRate = $_POST['sellingRate'];
$sellingValue = $_POST['sellingValue'];
$bomWidth = $_POST['bomWidth'];
$poTypeId = $_POST['poTypeId'];

$aaa ='styleId="'.$styleId.'",supplierId="'.$supplierId.'",techpackdetailId="'.$techpackdetailId.'",styleSubCatTableId="'.$styleSubCateId.'",materialId="'.$materialId.'",materialTypeId="'.$materialTypeId.'",avg="'.$avg.'",uom="'.$uom.'",rate="'.$rate.'",valueonepiece="'.$valueonepiece.'",color="'.$color.'",size="'.$size.'",poQty="'.$poQty.'",materialQty="'.$materialQty.'",materialValue="'.$materialValue.'",stockInStore="'.$stockInStore.'",orderQty="'.$orderQty.'",pendingQty="'.$pendingQty.'",status=1,dateAdded="'.time().'",sellingRate="'.$sellingRate.'",sellingValue="'.$sellingValue.'",bomWidth="'.$bomWidth.'",createdDate="'.date('Y-m-d').'",poTypeId="'.$poTypeId.'"';
$adds = addlisting('indentCreationMaster',$aaa);
?>
<script>
parent.reload_page();
</script>
<?php
}

if($_REQUEST['action']=='holidaycalender'){

$factoryId = $_POST['factoryId'];
$holidayType = $_POST['holidayType'];
$days = $_POST['days'];
$holidayName = $_POST['holidayName'];
$startDate=date('Y-m-d',strtotime($_POST['startDate']));
$endDate=date('Y-m-d',strtotime($_POST['endDate']));
$dateAdded=time();

if($factoryId==0){
$rsss=GetPageRecord('*','factoryMaster','1 and status=1 order by name asc');
while($facData=mysqli_fetch_array($rsss)){

if($holidayType==1){
deleteRecord('holidayMaster','factoryId="'.$facData['id'].'" and holidayType="'.$holidayType.'"');
$aaa ='factoryId="'.$facData['id'].'",holidayType="'.$holidayType.'",days="'.$days.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'"';
$adds = addlisting('holidayMaster',$aaa);
}
if($holidayType==2){
deleteRecord('holidayMaster','factoryId="'.$facData['id'].'" and holidayType="'.$holidayType.'" and holidayName="'.$holidayName.'" and startDate="'.$startDate.'" and endDate="'.$endDate.'"');
$aaa ='factoryId="'.$facData['id'].'",holidayType="'.$holidayType.'",holidayName="'.$holidayName.'",startDate="'.$startDate.'",endDate="'.$endDate.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'"';
$adds = addlisting('holidayMaster',$aaa);
}

}
}

else{
if($holidayType==1){
deleteRecord('holidayMaster','factoryId="'.$factoryId.'" and holidayType="'.$holidayType.'"');
$aaa ='factoryId="'.$factoryId.'",holidayType="'.$holidayType.'",days="'.$days.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'"';
$adds = addlisting('holidayMaster',$aaa);
}
if($holidayType==2){
deleteRecord('holidayMaster','factoryId="'.$factoryId.'" and holidayType="'.$holidayType.'" and holidayName="'.$holidayName.'" and startDate="'.$startDate.'" and endDate="'.$endDate.'"');
$aaa ='factoryId="'.$factoryId.'",holidayType="'.$holidayType.'",holidayName="'.$holidayName.'",startDate="'.$startDate.'",endDate="'.$endDate.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'"';
$adds = addlisting('holidayMaster',$aaa);
}
}

?>
<script>
parent.reload_page();
</script>
<?php
}
//====================Save quality inspection input========================================
if(trim($_POST['action'])=='savequalityinspect' && trim($_POST['styleId'])!='' && $_POST['hours']!=''){


$fromDate=date("Y-m-d", strtotime($_POST['fromDate']));
$factoryId=addslashes($_POST['factoryId']);
$line=addslashes($_POST['line']);
$hours=addslashes($_POST['hours']);
$styleId=decode(addslashes($_POST['styleId']));

$numberofdefects=addslashes($_POST['numberofdefects']);
$numberofpassgar=addslashes($_POST['numberofpassgar']);
$numberofdefgar=addslashes($_POST['numberofdefgar']);
$totalpricechck=addslashes($_POST['totalpricechck']);

$remarks=addslashes($_POST['remarks']);
$dateAdded=time();
$wheredelete='fromDate="'.$fromDate.'" and factoryId="'.$factoryId.'" and line="'.$line.'" and hours="'.$hours.'" and styleId="'.$styleId.'"';
deleteRecord('qualityInspectionMaster',$wheredelete);
$namevalue ='fromDate="'.$fromDate.'",factoryId="'.$factoryId.'",line="'.$line.'",hours="'.$hours.'",numberofdefects="'.$numberofdefects.'",numberofpassgar="'.$numberofpassgar.'",numberofdefgar="'.$numberofdefgar.'",totalpricechck="'.$totalpricechck.'",remarks="'.$remarks.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'",styleId="'.$styleId.'"';

addlisting('qualityInspectionMaster',$namevalue);

?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_REQUEST['module']; ?>&alt=1');

</script>
<?php
}
//====================Generate BOM PO========================================
if(trim($_POST['action'])=='generatebompo' && trim($_POST['supplierId'])!='' && $_POST['module']!=''  && $_POST['remark']!=''){

$supplierId=addslashes(decode($_POST['supplierId']));
$remark=addslashes($_POST['remark']);
$dateAdded=time();
$namevalue ='remark="'.$remark.'",supplierId="'.$supplierId.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'",status=1';
$lastId = addlistinggetlastid('bomPoMaster',$namevalue);
$update = updatelisting('indentCreationMaster','bomGenerateId="'.$lastId.'",bomPoStatus=1','supplierId="'.$supplierId.'" and bomPoStatus=0');
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_REQUEST['module']; ?>&alt=1');
</script>
<?php
}
//assign PO to Supplier
if($_REQUEST['action']=='assignpotosupplier' && $_REQUEST['assignToSupplier']!=''){
//$assignto = $_POST['assignto'];
$assignToSupplier = $_POST['assignToSupplier'];
$assignToSupplierl1 = implode(",", $assignToSupplier);
$assignToSupplier = rtrim($assignToSupplierl1,',');
$array =  explode(',', $assignToSupplier);
$today = date("ymd");
$rand = strtoupper(substr(uniqid(sha1(time())),0,3));
$uniqueOrderId1 = $today . $rand;
$uniquePonNumber = $uniqueOrderId1;
foreach($array as $itennss) {
	 $update = updatelisting('indentCreationMaster','bomPoStatus=1,poNumber="'.$uniquePonNumber.'"','id="'.$itennss.'"');

}
?>
<script>
parent.reload_page();
</script>
<?php
}
//=========================================================ACTION DISPLAY MASTER==================================================================================
if($_REQUEST['action']=='saveactionmaster' && $_REQUEST['id']!='' && $_REQUEST['deptid']!=''){
$id = $_REQUEST['id'];
$deptid = $_REQUEST['deptid'];
$dateAdded=time();
deleteRecord('actionDisplayMaster','deptid="'.$deptid.'" and  moduleid="'.$id.'"');
$namevalue ='deptid="'.$deptid.'",moduleid="'.$id.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';

$adds= addlistinggetlastid('actionDisplayMaster',$namevalue);

}
//===========================================================================NEW APPAREL 05-02-2020==========================================================
if(trim($_POST['action'])=='headcreation' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$companyId=clean($_POST['companyId']);
$dateAdded=time();
$namevalue ='label="'.$name.'",description="'.$description.'",companyId="'.$companyId.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting('finalheadcreationmaster',$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>
<?php }
if(trim($_POST['action'])=='headcreation' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$companyId=clean($_POST['companyId']);
$modifyDate=time();

$where='id='.decode($_POST['editId']).'';
$namevalue ='label="'.$name.'",description="'.$description.'",companyId="'.$companyId.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('finalheadcreationmaster',$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>
<?php }
if(trim($_POST['action'])=='accountcoa' && trim($_POST['editId'])!='' && trim($_POST['label'])!='' && trim($_POST['module'])!=''){
$label=clean($_POST['label']);
$newLabel=clean($_POST['newLabel']);
$companyId=clean($_POST['companyId']);
$trialbalance=clean($_POST['trialbalance']);

$where='id='.decode($_POST['editId']).'';
$namevalue ='label="'.$label.'",modifyDate="'.$modifyDate.'",companyId="'.$companyId.'",trialbalance="'.$trialbalance.'",trialparent="'.decode($_POST['editId']).'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('finalheadcreationmaster',$namevalue,$where);

if($newLabel!=''){
$dateAdded=time();
 $namevalueAdd ='label="'.$newLabel.'",parent="'.decode($_POST['editId']).'",companyId="'.$companyId.'",trialbalance="'.$trialbalance.'",trialparent="'.decode($_POST['editId']).'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting('finalheadcreationmaster',$namevalueAdd);
}
//*****************************************************
if($trialbalance==1){
//=========================add company wise accounts==========================================
$kk=GetPageRecord('*','finalheadcreationmaster','1 and parent="'.decode($_POST['editId']).'" and companyId="'.$companyId.'" order by id asc');
while($headeerCreationdetails=mysqli_fetch_array($kk)){
$namevalueaa ='trialparent="'.decode($_POST['editId']).'"';
$whereaa='parent='.decode($_POST['editId']).'';
$updateaa = updatelisting('finalheadcreationmaster',$namevalueaa,$whereaa);
//=============================firstlevel

$kkkk=GetPageRecord('*','finalheadcreationmaster','1 and parent="'.$headeerCreationdetails['id'].'" and companyId="'.$companyId.'"');
while($subheadeerCreationdetails=mysqli_fetch_array($kkkk)){
$namevaluebb ='trialparent="'.decode($_POST['editId']).'"';
$wherebb='id='.$subheadeerCreationdetails['id'].'';
$updatebb = updatelisting('finalheadcreationmaster',$namevaluebb,$wherebb);
//================================second level
$kkkmmmk=GetPageRecord('*','finalheadcreationmaster','1 and parent="'.$subheadeerCreationdetails['id'].'" and companyId="'.$companyId.'"');
while($subheadeerCreationdetailssecond=mysqli_fetch_array($kkkmmmk)){
$namevaluecc ='trialparent="'.decode($_POST['editId']).'"';
$wherecc='id='.$subheadeerCreationdetailssecond['id'].'';
$updatecc = updatelisting('finalheadcreationmaster',$namevaluecc,$wherecc);
//================================third level
$kmmk =GetPageRecord('*','finalheadcreationmaster','1 and parent="'.$subheadeerCreationdetailssecond['id'].'" and companyId="'.$companyId.'"');
while($subheadeerCreationdetailthied=mysqli_fetch_array($kmmk)){
$namevaluedd ='trialparent="'.decode($_POST['editId']).'"';
$wheredd='id='.$subheadeerCreationdetailthied['id'].'';
$updatedd = updatelisting('finalheadcreationmaster',$namevaluedd,$wheredd);
//================================fourth  level
$kmmkkgkfkwew =GetPageRecord('*','finalheadcreationmaster','1 and parent="'.$subheadeerCreationdetailthied['id'].'" and companyId="'.$companyId.'"');
while($subheadeerCreationdetailfourth=mysqli_fetch_array($kmmkkgkfkwew)){
$namevalueee ='trialparent="'.decode($_POST['editId']).'"';
$whereee='id='.$subheadeerCreationdetailfourth['id'].'';
$updateee = updatelisting('finalheadcreationmaster',$namevalueee,$whereee);
//================================fifth  level
}
}
}
}
}
}
//******************************************
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>
<?php }

if(trim($_POST['action'])=='bookWashingMaster' && trim($_POST['styleid'])!='' && trim($_POST['fromTime'])!='' && trim($_POST['toTime'])!='' && trim($_POST['approveLimit'])!=''){
$fromTime=clean($_POST['fromTime']);
$toTime=clean($_POST['toTime']);
$approveLimit=clean($_POST['approveLimit']);
$styleid=clean($_POST['styleid']);
$description=clean($_POST['description']);
$addDate=date('Y-m-d',strtotime($_POST['addDate']));
$dateAdded=time();
if($_POST['editId']==''){
$namevalue ='fromTime="'.$fromTime.'",description="'.$description.'",toTime="'.$toTime.'",approveLimit="'.$approveLimit.'",styleid="'.$styleid.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",addDate="'.$addDate.'"';
$adds = addlisting('bookWashingMaster',$namevalue);
} else{
$modifyDate=time();
$where='id="'.decode($_POST['editId']).'"';
$namevalue ='fromTime="'.$fromTime.'",description="'.$description.'",toTime="'.$toTime.'",approveLimit="'.$approveLimit.'",styleid="'.$styleid.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('bookWashingMaster',$namevalue,$where);
}
?>
<script>
parent.setupbox('showpage.crm?module=bookwasing&alt=1');
</script>
<?php }
if(trim($_POST['action'])=='bookembroideryMaster' && trim($_POST['styleid'])!='' && trim($_POST['fromTime'])!='' && trim($_POST['toTime'])!='' && trim($_POST['approveLimit'])!=''){
$fromTime=clean($_POST['fromTime']);
$toTime=clean($_POST['toTime']);
$approveLimit=clean($_POST['approveLimit']);
$styleid=clean($_POST['styleid']);
$description=clean($_POST['description']);
$addDate=date('Y-m-d',strtotime($_POST['addDate']));
$dateAdded=time();
if($_POST['editId']==''){
$namevalue ='fromTime="'.$fromTime.'",description="'.$description.'",toTime="'.$toTime.'",approveLimit="'.$approveLimit.'",styleid="'.$styleid.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",addDate="'.$addDate.'"';
$adds = addlisting('bookembroideryMaster',$namevalue);
} else{
$modifyDate=time();
$where='id="'.decode($_POST['editId']).'"';
$namevalue ='fromTime="'.$fromTime.'",description="'.$description.'",toTime="'.$toTime.'",approveLimit="'.$approveLimit.'",styleid="'.$styleid.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('bookembroideryMaster',$namevalue,$where);
}
?>
<script>
parent.setupbox('showpage.crm?module=bookembroidery&alt=1');
</script>
<?php }
 /////////////////Add Debit Voucher Master///////////////////
if(trim($_POST['action'])=='savedebitvoucher' && trim($_POST['editId'])!='' && trim($_POST['module'])!=''){
$creditaccounthead=clean($_POST['creditaccounthead']);
$remark=clean($_POST['description']);
$accountDate=date('Y-m-d',strtotime($_POST['fromDate']));
$companyid=clean($_POST['companyid']);
$totalamount=clean($_POST['totalamount']);
$modifyDate=time();

$where='id='.decode($_POST['editId']).'';
$namevalue ='creditaccounthead="'.$creditaccounthead.'",remark="'.$remark.'",accountDate="'.$accountDate.'",companyid="'.$companyid.'",totalamount="'.$totalamount.'"';
$update = updatelisting('accountsMaster',$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>
<?php }
 /////////////////Add opeation bulletin Master///////////////////
if(trim($_POST['action'])=='addoperationbulletin' && $_POST['opId']==0){

$costsheetVersionId=clean($_POST['costsheetVersionId']);
$target=clean($_POST['target']);
$output=clean($_POST['output']);
$createdby=clean($_POST['createdby']);
$efficiency=clean($_POST['efficiency']);
$workplaces=clean($_POST['workplaces']);
$sewingmc=clean($_POST['sewingmc']);
$totalsam=clean($_POST['totalsam']);
$mcsam=clean($_POST['mcsam']);
$manualsam=clean($_POST['manualsam']);
$clocktime=clean($_POST['clocktime']);
$pcs=clean($_POST['pcs']);
$status=clean($_POST['status']);
$line=clean($_POST['line']);
$operationdate=date('Y-m-d',strtotime($_POST['operationdate']));
$dateAdded=time();
$modifyDate=time();
if($_POST['editId']==''){
$namevalue ='styleId="'.decode($_POST['styleid']).'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'",target="'.$target.'",efficiency="'.$efficiency.'",workplaces="'.$workplaces.'",sewingmc="'.$sewingmc.'",totalsam="'.$totalsam.'",mcsam="'.$mcsam.'",manualsam="'.$manualsam.'",clocktime="'.$clocktime.'",operationdate="'.$operationdate.'",pcs="'.$pcs.'",status="'.$status.'",line="'.$line.'",costsheetVersionId="'.$costsheetVersionId.'",output="'.$output.'",createdBy="'.$createdby.'"';
addlisting('operationbulletinentry',$namevalue);

}
else{
$where='id="'.decode($_POST['editId']).'" and costsheetVersionId="'.$costsheetVersionId.'"';
$namevalue ='styleId="'.decode($_POST['styleid']).'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",target="'.$target.'",efficiency="'.$efficiency.'",workplaces="'.$workplaces.'",sewingmc="'.$sewingmc.'",totalsam="'.$totalsam.'",mcsam="'.$mcsam.'",manualsam="'.$manualsam.'",clocktime="'.$clocktime.'",operationdate="'.$operationdate.'",pcs="'.$pcs.'",status="'.$status.'",line="'.$line.'",costsheetVersionId="'.$costsheetVersionId.'",output="'.$output.'",createdBy="'.$createdby.'"';
$update = updatelisting('operationbulletinentry',$namevalue,$where);
}
?>
<script>
parent.setupbox('showpage.crm?module=operationbulletin&add=yes&styleid=<?php echo $_POST['styleid']; ?>');
</script>
<?php }

//create duplicate operation using bulletin=========================================
if(trim($_POST['action'])=='addoperationbulletin' && $_POST['opId']==1){
$costsheetVersionId=clean($_POST['costsheetVersionId']);

$dateAdded=time();
$modifyDate=time();
$rsversion=GetPageRecord('*','operationBulletinVersionMaster','styleId="'.decode($_POST['styleid']).'"');
$countversion=mysql_num_rows($rsversion);

if($countversion!=''){
$versionName = 'V'.($countversion+1);
$versionIdNew = $countversion+1;
}
$namevalue11 = 'styleId="'.decode($_POST['styleid']).'",versionName="'.$versionName.'",versionId="'.$versionIdNew.'",dateAdded="'.time().'",addedBy="'.$_SESSION['userid'].'"';
$newversionId = addlistinggetlastid('operationBulletinVersionMaster',$namevalue11);
$operquery=GetPageRecord('*','operationbulletinentry','styleId="'.decode($_POST['styleid']).'" and costsheetVersionId="'.$costsheetVersionId.'"');
$oprData=mysqli_fetch_array($operquery);
$namevalue ='styleId="'.decode($_POST['styleid']).'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'",target="'.$oprData['target'].'",efficiency="'.$oprData['efficiency'].'",workplaces="'.$oprData['workplaces'].'",sewingmc="'.$oprData['sewingmc'].'",totalsam="'.$oprData['totalsam'].'",mcsam="'.$oprData['mcsam'].'",manualsam="'.$oprData['manualsam'].'",clocktime="'.$oprData['clocktime'].'",operationdate="'.$oprData['operationdate'].'",pcs="'.$oprData['pcs'].'",status="'.$oprData['status'].'",line="'.$oprData['line'].'",costsheetVersionId="'.$versionIdNew.'",output="'.$oprData['output'].'",createdBy="'.$oprData['createdBy'].'"';
addlisting('operationbulletinentry',$namevalue);

$rs=GetPageRecord('*','operationbulletinamaster','styleId="'.decode($_REQUEST['styleid']).'" and costsheetVersionId="'.$costsheetVersionId.'" and status=1 and deletestatus=0 order by id asc');
while($resListing1=mysqli_fetch_array($rs)){

$namevalueee ='particular="'.$resListing1['particular'].'",sam="'.$resListing1['sam'].'",prodhrs="'.$resListing1['prodhrs'].'",machinetype="'.$resListing1['machinetype'].'",workads="'.$resListing1['workads'].'",oprreq="'.$resListing1['oprreq'].'",roundoff="'.$resListing1['roundoff'].'",costsheetVersionId="'.$versionIdNew.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",status=1,styleId="'.decode($_POST['styleid']).'"';
addlisting('operationbulletinamaster',$namevalueee);
}
?>
<script>
parent.setupbox('showpage.crm?module=operationbulletin&add=yes&styleid=<?php echo $_POST['styleid']; ?>');
</script>
<?php }
//========================add machine master
if(trim($_POST['action'])=='machinemaster' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$status=clean($_POST['status']);
$dateAdded=time();
if($_POST['editId']==''){
$namevalue ='name="'.$name.'",description="'.$description.'",status="'.$status.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting('machineMaster',$namevalue);
} else{
$modifyDate=time();
$where='id="'.decode($_POST['editId']).'"';
$namevalue ='name="'.$name.'",description="'.$description.'",status="'.$status.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('machineMaster',$namevalue,$where);
}
?>
<script>
parent.setupbox('showpage.crm?module=machinemaster&alt=1');
</script>
<?php }
//add opration bulletin
if(trim($_POST['action'])=='assemblyoperations' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$status=clean($_POST['status']);
$sam=clean($_POST['sam']);

$aaaaa = $_POST['machineId'];
$machineId = implode(",", $aaaaa);

$dateAdded=time();
if($_POST['editId']==''){
$namevalue ='name="'.$name.'",description="'.$description.'",status="'.$status.'",dateAdded="'.$dateAdded.'",machineId="'.$machineId.'",addedBy="'.$_SESSION['userid'].'",sam="'.$sam.'"';
$adds = addlisting('assemblyoperationsMaster',$namevalue);
} else{
$modifyDate=time();
$where='id="'.decode($_POST['editId']).'"';
$namevalue ='name="'.$name.'",description="'.$description.'",status="'.$status.'",modifyDate="'.$modifyDate.'",machineId="'.$machineId.'",modifyBy="'.$_SESSION['userid'].'",sam="'.$sam.'"';
$update = updatelisting('assemblyoperationsMaster',$namevalue,$where);
}
?>
<script>
parent.setupbox('showpage.crm?module=assemblyoperations&alt=1');
</script>
<?php }
//add skill matrix
if(trim($_POST['action'])=='skillmatrix' && trim($_POST['empCode'])!='' && trim($_POST['particulars'])!='' && trim($_POST['machineId'])!='' && trim($_POST['efficiency'])!=''){
$machineId=clean($_POST['machineId']);
$particulars=clean($_POST['particulars']);
$empCode=clean($_POST['empCode']);
$efficiency=clean($_POST['efficiency']);
$dateAdded=time();

if($_POST['editId']==''){
$namevalue ='machineId="'.$machineId.'",particulars="'.$particulars.'",empCode="'.$empCode.'",efficiency="'.$efficiency.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting('skillMatrix',$namevalue);
} else{
$modifyDate=time();
$where='id="'.decode($_POST['editId']).'"';
$namevalue ='machineId="'.$machineId.'",particulars="'.$particulars.'",empCode="'.$empCode.'",efficiency="'.$efficiency.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('skillMatrix',$namevalue,$where);
}
?>
<script>
parent.setupbox('showpage.crm?module=skillmatrix&alt=1');
</script>
<?php }
//add sampling material requisition
if($_POST['action']=='addmaterialrequisition' && $_POST['editId']!='' && $_POST['sampleFor']!=''){
$sampleFor=clean($_POST['sampleFor']);
$productionStage=clean($_POST['productionStage']);
$sampleType=clean($_POST['sampleType']);
$styleId=clean($_POST['styleId']);
$requestedDate=date('Y-m-d',strtotime($_POST['requestedDate']));
$expectedDate=date('Y-m-d',strtotime($_POST['expectedDate']));
$receivedDate=date('Y-m-d',strtotime($_POST['receivedDate']));
$dispatchDate=date('Y-m-d',strtotime($_POST['dispatchDate']));
$dateAdded=time();
$where='id="'.decode($_POST['editId']).'"';
$namevalue ='sampleFor="'.$sampleFor.'",productionStage="'.$productionStage.'",sampleType="'.$sampleType.'",styleId="'.$styleId.'",styleId="'.$styleId.'",requestedDate="'.$requestedDate.'",expectedDate="'.$expectedDate.'",receivedDate="'.$receivedDate.'",dispatchDate="'.$dispatchDate.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$update = updatelisting('samplingRequisitionMaster',$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>
<?php }

//save requisition shell data
if(trim($_REQUEST['action'])=="saverequisitionshelldata" && $_REQUEST['id']!=""){
$id=trim($_REQUEST['id']);
$colorShell=trim($_REQUEST['colorShell']);
$size=trim($_REQUEST['size']);
$samplingY=trim($_REQUEST['samplingY']);
$qty=trim($_REQUEST['qty']);
$supplierStore=trim($_REQUEST['supplierStore']);
$avg = trim($_REQUEST['avg']);
$estimatedPrice = trim($_REQUEST['estimatedPrice']);
$estimatedValue = trim($_REQUEST['estimatedValue']);
$nominatedBy = trim($_REQUEST['nominatedBy']);
$amount = trim($_REQUEST['amount']);
$detail = trim($_REQUEST['detail']);
$namevalue ='colorId="'.$colorShell.'",samplingY="'.$samplingY.'",qty="'.$qty.'",avg="'.$avg.'",estimatedPrice="'.$estimatedPrice.'",estimatedValue="'.$estimatedValue.'",size="'.$size.'",supplierStore="'.$supplierStore.'",nominatedBy="'.$nominatedBy.'",amount="'.$amount.'",billDetail="'.$detail.'"';
$where='id="'.$id.'"';
$update = updatelisting('samplingMaterialRequisition',$namevalue,$where);
}
//save requisition lining data
if(trim($_REQUEST['action'])=="saverequisitionliningdata" && $_REQUEST['id']!=""){
$id=trim($_REQUEST['id']);
$colorLining=trim($_REQUEST['colorLining']);
$size=trim($_REQUEST['size']);
$samplingY=trim($_REQUEST['samplingY']);
$qty=trim($_REQUEST['qty']);
$supplierStore=trim($_REQUEST['supplierStore']);
$avg = trim($_REQUEST['avg']);
$estimatedPrice = trim($_REQUEST['estimatedPrice']);
$estimatedValue = trim($_REQUEST['estimatedValue']);
$nominatedBy2 = trim($_REQUEST['nominatedBy2']);
$amount2 = trim($_REQUEST['amount2']);
$detail2 = trim($_REQUEST['detail2']);
$namevalue ='colorId="'.$colorLining.'",samplingY="'.$samplingY.'",qty="'.$qty.'",avg="'.$avg.'",estimatedPrice="'.$estimatedPrice.'",estimatedValue="'.$estimatedValue.'",size="'.$size.'",supplierStore="'.$supplierStore.'",nominatedBy="'.$nominatedBy2.'",amount="'.$amount2.'",billDetail="'.$detail2.'"';
$where='id="'.$id.'"';
$update = updatelisting('samplingMaterialRequisition',$namevalue,$where);
}
//Send to file handover
if(trim($_POST['action'])=='filehandver' && $_POST['styleId']!=''){
$module=clean($_POST['module']);
$styleId=decode($_POST['styleId']);
$notes=clean($_POST['notes']);
$assignTo = clean($_POST['assignTo']);
$dateAdded=time();
$namevalue ='styleId="'.$styleId.'",notes="'.$notes.'",assignTo="'.$assignTo.'",statusId=0,dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting('styleAssignmentMaster',$namevalue);
$handoverDate = date('Y-m-d',strtotime($_POST['pcd'].'+ 8 days'));
$namevaluequery ='handoverStatus=1,handoverBy="'.$assignTo.'",handoverDate="'.$handoverDate.'"';
$where='id="'.$styleId.'"';
$update = updatelisting('queryMaster',$namevaluequery,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $module; ?>');
</script>
<?php
}
//Send to file handover
if(trim($_POST['action'])=='filehandveraccept' && $_POST['styleId']!=''){
$module=clean($_POST['module']);
$styleId=decode($_POST['styleId']);
$notes=clean($_POST['notes']);
$handoverStatus = clean($_POST['handoverStatus']);
$dateAdded=time();
$namevalue ='styleId="'.$styleId.'",notes="'.$notes.'",statusId=0,dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting('styleAssignmentMaster',$namevalue);
$namevaluequery ='handoverStatus="'.$handoverStatus.'"';
$where='id="'.$styleId.'"';
$update = updatelisting('queryMaster',$namevaluequery,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $module; ?>');
</script>
<?php
}
//===========add buyer master new action
if(trim($_POST['action'])=='buyermaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!='' && trim($_POST['companyId'])!=''){
$name=clean($_POST['name']);
$buyerId=clean($_POST['buyerId']);
$shortname=clean($_POST['shortname']);
$bemail=clean($_POST['bemail']);
$bphone=clean($_POST['bphone']);
$status=clean($_POST['status']);
$buyerCurrency=clean($_POST['currencyId']);

$businessSegmentabc = $_POST['businessSegment'];
$businessSegment = implode(",", $businessSegmentabc);
$productCategoryabc = $_POST['productCategory'];
$productCategory = implode(",", $productCategoryabc);

$companyId=clean($_POST['companyId']);

$modifyDate=time();

$where='id='.decode($_POST['editId']).'';

$namevalue ='name="'.$name.'",buyerId="'.$buyerId.'",buyerShortName="'.$shortname.'",buyeremail="'.$bemail.'",buyerphone="'.$bphone.'",status="'.$status.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",buyerCurrency="'.$buyerCurrency.'",modifyBy="'.$_SESSION['userid'].'",businessSegment="'.$businessSegment.'",productCategory="'.$productCategory.'",companyId="'.$companyId.'"';
$update = updatelisting(_BUYER_MASTER_,$namevalue,$where);

$krsk=GetPageRecord('*','finalheadcreationmaster','companyId="'.$companyId.'" and label="Sundry Debtors"');
$headData=mysqli_fetch_array($krsk);
//==============check duplicate===================================================
$namevalue11 ='label="'.$name.'",parent="'.$headData['id'].'",description="'.$name.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",companyId="'.$companyId.'",type="buyers"';
$whereCheckref='parent="'.$headData['id'].'" and  label="'.$name.'"';
$checkCoderef = checkduplicate('finalheadcreationmaster',$whereCheckref);
if($checkCoderef=="no"){
$lastId = addlistinggetlastid('finalheadcreationmaster',$namevalue11);
} else{
$update = updatelisting('finalheadcreationmaster',$namevalue11,'parent="'.$headData['id'].'" and  label="'.$name.'"');

}
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>
<?php }
//=======================add journal approval============================
if(trim($_POST['action'])=='voucherapproval' && trim($_POST['editId'])!=''){
$changeStatus=clean($_POST['changeStatus']);
$notes=clean($_POST['notes']);

$where='id='.decode($_POST['editId']).'';

$namevalue ='changeStatus="'.$changeStatus.'",notes="'.$notes.'"';
$update = updatelisting('accountsMaster',$namevalue,$where);

?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['action']; ?>&alt=2');
</script>
<?php }
//========================end journal approval===========================

if(trim($_POST['action'])=='proformainvoice' && trim($_POST['editId'])!=''){
$invoiceType=clean($_POST['invoiceType']);

$where='id='.decode($_POST['editId']).'';

$namevalue ='invoiceType="'.$invoiceType.'",invoiceDate="'.time().'"';
$update = updatelisting('queryMaster',$namevalue,$where);

if($invoiceType==2){
$k=GetPageRecord('*','queryMaster','1 and id="'.decode($_POST['editId']).'"');
$styleData=mysqli_fetch_array($k);
$kk=GetPageRecord('*','buyerMaster','1 and id="'.$styleData['buyerId'].'"');
$buyerData=mysqli_fetch_array($kk);

//====================================create invoice approval=====================================================================
deleteRecord('accountsMaster','module="'.$_POST['module'].'" and addedBy="'.$_SESSION['userid'].'" and accountDate="0000-00-00"');
deleteRecord('debitvoucherMaster','addedBy="'.$_SESSION['userid'].'" and accountHeadId=0');
$where='1 and module="'.$_POST['module'].'" and accountDate!="0000-00-00" order by id desc';
$rs=GetPageRecord('*','accountsMaster',$where);
$accountData=mysqli_fetch_array($rs);
$autiid = explode('-',$accountData['displayId']);
$autoId = $autiid[1]+1;
$finalDisplayId='INV-000'.$autoId;

$namevalue ='module="'.$_POST['module'].'",dateAdded="'.time().'",addedBy="'.$_SESSION['userid'].'",displayId="'.$finalDisplayId.'"';
$lasttid=addlistinggetlastid('accountsMaster',$namevalue);

$rkdm=GetPageRecord('*','accountsMaster','1 and id="'.$lasttid.'"');
$editResult=mysqli_fetch_array($rkdm);

$accountDate=date('Y-m-d',time());
$modifyDate=time();
//======================
$rkrkrk=GetPageRecord('grossTotal','buyerPurchaseOrderMaster','styleId="'.decode($_POST['editId']).'"');
$resultqty=mysqli_fetch_array($rkrkrk);
$finalcostabcd=0;
$totalquantitynetTTT=0;
$kkk=GetPageRecord('*','loadpackinglistmaster','1 and styleId="'.decode($_POST['editId']).'" and carton_No!="" group by carton_No');
while($packagelistData=mysqli_fetch_array($kkk)){
//get total quantity
$kmm=GetPageRecord('*','loadpackinglistmaster','1 and styleId="'.decode($_POST['editId']).'" and  carton_No="'.$packagelistData['carton_No'].'" order by id desc');
$totalquantity=mysql_num_rows($kmm);

$kmkmkmmkkmkmkm=GetPageRecord('sum(totalqty) as totalqty','loadpackinglistmaster','1 and styleId="'.decode($_POST['editId']).'" and  carton_No="'.$packagelistData['carton_No'].'"');
$kjkjkj=mysqli_fetch_array($kmkmkmmkkmkmkm);
$totalquantitynetTTT=$kjkjkj['totalqty'];

$finalcostabc=$resultqty['grossTotal']*$totalquantitynetTTT;
$finalcostabcd=$finalcostabc+$finalcostabcd;
}
//====================

$where='id='.$lasttid.'';
$namevalue ='accountDate="'.$accountDate.'",companyid="'.$buyerData['companyId'].'",creditaccounthead="'.$buyerData['id'].'",code="'.$buyerData['buyerId'].'",styleId="'.decode($_POST['editId']).'",totalamount="'.$finalcostabcd.'",remark="'.$styleData['styleRefId'].'"';
$update = updatelisting('accountsMaster',$namevalue,$where);

//======================*****************************
//$krsk=GetPageRecord('*','finalheadcreationmaster','companyId="'.$buyerData['companyId'].'" and label="Sales Account"');
//$headData=mysqli_fetch_array($krsk);
//$namevalue11 ='label="'.$finalDisplayId.'",parent="'.$headData['id'].'",description="'.$finalDisplayId.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",companyId="'.$buyerData['companyId'].'",type="salesaccount"';
//$lastId = addlistinggetlastid('finalheadcreationmaster',$namevalue11);

//================*****************************************
//$kkkrsk=GetPageRecord('*','finalheadcreationmaster','companyId="'.$buyerData['companyId'].'" and label="'.$buyerData['name'].'"');
//$headDataaa=mysqli_fetch_array($kkkrsk);
//$namevalue1111 ='label="'.$finalDisplayId.'",parent="'.$headDataaa['id'].'",description="'.$finalDisplayId.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",companyId="'.$buyerData['companyId'].'",type="buyersincome"';
//$lastIddd = addlistinggetlastid('finalheadcreationmaster',$namevalue1111);

}
//===================================end invoice approval===========================================================================
?>
<script>
parent.window.location.href='<?php echo $fullurl; ?>tcpdf/examples/generateinvoice.php?pageurl=<?php echo $fullurl; ?>invoice.php?s=<?php echo $_REQUEST['editId']; ?>';
</script>
<?php }
//==========invoice Approval
if(trim($_POST['action'])=='invoiceapproval' && trim($_POST['editId'])!=''){
$changeStatus=clean($_POST['changeStatus']);
$notes=clean($_POST['notes']);

$where='id='.decode($_POST['editId']).'';

$namevalue ='changeStatus="'.$changeStatus.'",notes="'.$notes.'"';
$update = updatelisting('accountsMaster',$namevalue,$where);

?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['action']; ?>&alt=2');
</script>
<?php }
if(trim($_POST['action'])=='saveopeningbalance'){

$financialYear=clean($_POST['financialYear']);
$companyid=clean($_POST['companyid']);
$accountName=clean($_POST['accountName']);
$accountno=clean($_POST['accountno']);
$amount=clean($_POST['amount']);
$debitcredit=clean($_POST['debitcredit']);

$namevalue='financialYear="'.$financialYear.'",companyid="'.$companyid.'",accountName="'.$accountName.'",accountno="'.$accountno.'",amount="'.$amount.'",debitcredit="'.$debitcredit.'",dateAdded="'.time().'",addedBy="'.$_SESSION['userid'].'"';

if($_POST['editId']==""){
$adds = addlisting('balancesMaster',$namevalue);
}else{
$where='id='.decode($_POST['editId']).'';
$update = updatelisting('balancesMaster',$namevalue,$where);
}
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>
<?php }

//=================add fabric detail master===============================
if(trim($_POST['action'])=='fdsmaster'){
$dateAdded=time();
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$millArticleNo=addslashes($_POST['millArticleNo']);
$mfgName=clean($_POST['mfgName']);
$fdsCreationDate=date('Y-m-d',strtotime($_POST['fdsCreationDate']));
$countryOfOrigin=clean($_POST['countryOfOrigin']);
$contentstext=clean($_POST['contentstext']);
$minimumColorOrder=clean($_POST['minimumColorOrder']);
$uomminimumColorOrder=clean($_POST['uomminimumColorOrder']);
$minimumTotalOrder=clean($_POST['minimumTotalOrder']);
$uomminimumTotalOrder=clean($_POST['uomminimumTotalOrder']);
$capacitytext=clean($_POST['capacitytext']);
$uomcapacitytext=clean($_POST['uomcapacitytext']);
$suggestioninstruction=clean($_POST['suggestioninstruction']);
$commenttestinginfo=clean($_POST['commenttestinginfo']);
$remarks=clean($_POST['remarks']);
$fabricName=clean($_POST['fabricName']);
$finishText=clean($_POST['finishText']);
$fullwidthInches=clean($_POST['fullwidthInches']);
$cuttablewidthinches=clean($_POST['cuttablewidthinches']);
$fabricType=clean($_POST['fabricType']);
$price=clean($_POST['price']);
$priceCurrency=clean($_POST['priceCurrency']);
$validityTill=date('Y-m-d',strtotime($_POST['validityTill']));
$revalidityTill=date('Y-m-d',strtotime($_POST['revalidityTill']));
$bultleadTime=clean($_POST['bultleadTime']);
$sampleyardingleadtime=clean($_POST['sampleyardingleadtime']);
/////////////////////////////////////////////////////////////////////////////////////////////////
$countwarp=clean($_POST['countwarp']);
$countweft=clean($_POST['countweft']);
$constructionwarp=clean($_POST['constructionwarp']);
$constructionweft=clean($_POST['constructionweft']);
$shrinkagewarp=clean($_POST['shrinkagewarp']);
$shrinkageweft=clean($_POST['shrinkageweft']);
$stretchwarp=clean($_POST['stretchwarp']);
$stretchweft=clean($_POST['stretchweft']);
$minweightbeore=clean($_POST['minweightbeore']);
$maxweightbeore=clean($_POST['maxweightbeore']);
$minweightbeorefirst=clean($_POST['minweightbeorefirst']);
$minweightafter=clean($_POST['minweightafter']);
$maxweightafter=clean($_POST['maxweightafter']);
$minweightbeoresecond=clean($_POST['minweightbeoresecond']);
$mintorque=clean($_POST['mintorque']);
$maxtorque=clean($_POST['maxtorque']);
$minweightbeorethird=clean($_POST['minweightbeorethird']);
$tearwarp=clean($_POST['tearwarp']);
$tearlbs=clean($_POST['tearlbs']);
$testilewarp=clean($_POST['testilewarp']);
$testilelbs=clean($_POST['testilelbs']);
$seamslippage=clean($_POST['seamslippage']);
$seamslippagelbs=clean($_POST['seamslippagelbs']);
$seamstrength=clean($_POST['seamstrength']);
$seamstrengthlbs=clean($_POST['seamstrengthlbs']);
$surfaceFinish=clean($_POST['surfaceFinish']);
$surfacefinishsecond=clean($_POST['surfacefinishsecond']);
$sufacefinishtype=clean($_POST['sufacefinishtype']);
$sufacefinishlbl=clean($_POST['sufacefinishlbl']);
$performacefinish=clean($_POST['performacefinish']);
$performancefinishlabel=clean($_POST['performancefinishlabel']);
$highelongation=clean($_POST['highelongation']);
$highelongationlbl=clean($_POST['highelongationlbl']);
$typeofwash=clean($_POST['typeofwash']);
$typeofwashlbl=clean($_POST['typeofwashlbl']);
//////////////////////*********************************washed************************///////////////////////////////////////////////////////////////////////////
$wcountwarp=clean($_POST['wcountwarp']);
$wcountweft=clean($_POST['wcountweft']);
$wconstructionwarp=clean($_POST['wconstructionwarp']);
$wconstructionweft=clean($_POST['wconstructionweft']);
$wshrinkagewarp=clean($_POST['wshrinkagewarp']);
$wshrinkageweft=clean($_POST['wshrinkageweft']);
$wstretchwarp=clean($_POST['wstretchwarp']);
$wstretchweft=clean($_POST['wstretchweft']);
$wminweightbeore=clean($_POST['wminweightbeore']);
$wmaxweightbeore=clean($_POST['wmaxweightbeore']);
$wminweightbeorefirst=clean($_POST['wminweightbeorefirst']);
$wminweightafter=clean($_POST['wminweightafter']);
$wmaxweightafter=clean($_POST['wmaxweightafter']);
$wminweightbeoresecond=clean($_POST['wminweightbeoresecond']);
$wmintorque=clean($_POST['wmintorque']);
$wmaxtorque=clean($_POST['wmaxtorque']);
$wminweightbeorethird=clean($_POST['wminweightbeorethird']);
$wtearwarp=clean($_POST['wtearwarp']);
$wtearlbs=clean($_POST['wtearlbs']);
$wtestilewarp=clean($_POST['wtestilewarp']);
$wtestilelbs=clean($_POST['wtestilelbs']);
$wseamslippage=clean($_POST['wseamslippage']);
$wseamslippagelbs=clean($_POST['wseamslippagelbs']);
$wseamstrength=clean($_POST['wseamstrength']);
$wseamstrengthlbs=clean($_POST['wseamstrengthlbs']);
$wsurfaceFinish=clean($_POST['wsurfaceFinish']);
$wsurfacefinishsecond=clean($_POST['wsurfacefinishsecond']);
$wsufacefinishtype=clean($_POST['wsufacefinishtype']);
$wsufacefinishlbl=clean($_POST['wsufacefinishlbl']);
$wperformacefinish=clean($_POST['wperformacefinish']);
$wperformancefinishlabel=clean($_POST['wperformancefinishlabel']);
$whighelongation=clean($_POST['whighelongation']);
$whighelongationlbl=clean($_POST['whighelongationlbl']);
$wtypeofwash=clean($_POST['wtypeofwash']);
$wtypeofwashlbl=clean($_POST['wtypeofwashlbl']);
//=========================***********************************************PROCESS LEAD TIMES*******************************=====================================
$yarnleadtimesolid=clean($_POST['yarnleadtimesolid']);
$yarnleadtimeprint=clean($_POST['yarnleadtimeprint']);
$yarnleadtimeyarn=clean($_POST['yarnleadtimeyarn']);
$yarnleadtimeheather=clean($_POST['yarnleadtimeheather']);
$weavingleadtimesolid=clean($_POST['weavingleadtimesolid']);
$weavingleadtimeprint=clean($_POST['weavingleadtimeprint']);
$weavingleadtimeyarn=clean($_POST['weavingleadtimeyarn']);
$weavingleadtimeheather=clean($_POST['weavingleadtimeheather']);
$dyeingsolid=clean($_POST['dyeingsolid']);
$dyeingprint=clean($_POST['dyeingprint']);
$dyeingyarn=clean($_POST['dyeingyarn']);
$dyeingheather=clean($_POST['dyeingheather']);
$testingsolid=clean($_POST['testingsolid']);
$testingprint=clean($_POST['testingprint']);
$testingyarn=clean($_POST['testingyarn']);
$testingheather=clean($_POST['testingheather']);
$totalsolid=clean($_POST['totalsolid']);
$totalprint=clean($_POST['totalprint']);
$totalyarn=clean($_POST['totalyarn']);
$totalheather=clean($_POST['totalheather']);
//==========================********************************************==================================================================================
$specialcall1=clean($_POST['specialcall1']);
$specialcall2=clean($_POST['specialcall2']);
$specialcall3=clean($_POST['specialcall3']);
$specialcall4=clean($_POST['specialcall4']);
$specialcall5=clean($_POST['specialcall5']);


$kk ='millArticleNo="'.$millArticleNo.'",mfgName="'.$mfgName.'",fdsCreationDate="'.$fdsCreationDate.'",countryOfOrigin="'.$countryOfOrigin.'",contentstext="'.$contentstext.'",minimumColorOrder="'.$minimumColorOrder.'",uomminimumColorOrder="'.$uomminimumColorOrder.'",minimumTotalOrder="'.$minimumTotalOrder.'",uomminimumTotalOrder="'.$uomminimumTotalOrder.'",capacitytext="'.$capacitytext.'",uomcapacitytext="'.$uomcapacitytext.'",suggestioninstruction="'.$suggestioninstruction.'",commenttestinginfo="'.$commenttestinginfo.'",remarks="'.$remarks.'",fabricName="'.$fabricName.'",finishText="'.$finishText.'",fullwidthInches="'.$fullwidthInches.'",cuttablewidthinches="'.$cuttablewidthinches.'",fabricType="'.$fabricType.'",price="'.$price.'",priceCurrency="'.$priceCurrency.'",validityTill="'.$validityTill.'",revalidityTill="'.$revalidityTill.'",bultleadTime="'.$bultleadTime.'",sampleyardingleadtime="'.$sampleyardingleadtime.'",countwarp="'.$countwarp.'",countweft="'.$countweft.'",constructionwarp="'.$constructionwarp.'",constructionweft="'.$constructionweft.'",shrinkagewarp="'.$shrinkagewarp.'",shrinkageweft="'.$shrinkageweft.'",stretchwarp="'.$stretchwarp.'",stretchweft="'.$stretchweft.'",minweightbeore="'.$minweightbeore.'",maxweightbeore="'.$maxweightbeore.'",minweightbeorefirst="'.$minweightbeorefirst.'",minweightafter="'.$minweightafter.'",maxweightafter="'.$maxweightafter.'",minweightbeoresecond="'.$minweightbeoresecond.'",mintorque="'.$mintorque.'",maxtorque="'.$maxtorque.'",minweightbeorethird="'.$minweightbeorethird.'",tearwarp="'.$tearwarp.'",tearlbs="'.$tearlbs.'",testilewarp="'.$testilewarp.'",testilelbs="'.$testilelbs.'",seamslippage="'.$seamslippage.'",seamslippagelbs="'.$seamslippagelbs.'",seamstrength="'.$seamstrength.'",seamstrengthlbs="'.$seamstrengthlbs.'",surfaceFinish="'.$surfaceFinish.'",surfacefinishsecond="'.$surfacefinishsecond.'",sufacefinishtype="'.$sufacefinishtype.'",sufacefinishlbl="'.$sufacefinishlbl.'",performacefinish="'.$performacefinish.'",performancefinishlabel="'.$performancefinishlabel.'",highelongation="'.$highelongation.'",highelongationlbl="'.$highelongationlbl.'",typeofwash="'.$typeofwash.'",typeofwashlbl="'.$typeofwashlbl.'",dateAdded="'.$dateAdded.'",wcountwarp="'.$wcountwarp.'",wcountweft="'.$wcountweft.'",wconstructionwarp="'.$wconstructionwarp.'",wconstructionweft="'.$wconstructionweft.'",wshrinkagewarp="'.$wshrinkagewarp.'",wshrinkageweft="'.$wshrinkageweft.'",wstretchwarp="'.$wstretchwarp.'",wstretchweft="'.$wstretchweft.'",wminweightbeore="'.$wminweightbeore.'",wmaxweightbeore="'.$wmaxweightbeore.'",wminweightbeorefirst="'.$wminweightbeorefirst.'",wminweightafter="'.$wminweightafter.'",wmaxweightafter="'.$wmaxweightafter.'",wminweightbeoresecond="'.$wminweightbeoresecond.'",wmintorque="'.$wmintorque.'",wmaxtorque="'.$wmaxtorque.'",wminweightbeorethird="'.$wminweightbeorethird.'",wtearwarp="'.$wtearwarp.'",wtearlbs="'.$wtearlbs.'",wtestilewarp="'.$wtestilewarp.'",wtestilelbs="'.$wtestilelbs.'",wseamslippage="'.$wseamslippage.'",wseamslippagelbs="'.$wseamslippagelbs.'",wseamstrength="'.$wseamstrength.'",wseamstrengthlbs="'.$wseamstrengthlbs.'",wsurfaceFinish="'.$wsurfaceFinish.'",wsurfacefinishsecond="'.$wsurfacefinishsecond.'",wsufacefinishtype="'.$wsufacefinishtype.'",wsufacefinishlbl="'.$wsufacefinishlbl.'",wperformacefinish="'.$wperformacefinish.'",wperformancefinishlabel="'.$wperformancefinishlabel.'",whighelongation="'.$whighelongation.'",whighelongationlbl="'.$whighelongationlbl.'",wtypeofwash="'.$wtypeofwash.'",wtypeofwashlbl="'.$wtypeofwashlbl.'",yarnleadtimesolid="'.$yarnleadtimesolid.'",yarnleadtimeprint="'.$yarnleadtimeprint.'",yarnleadtimeyarn="'.$yarnleadtimeyarn.'",yarnleadtimeheather="'.$yarnleadtimeheather.'",weavingleadtimesolid="'.$weavingleadtimesolid.'",weavingleadtimeprint="'.$weavingleadtimeprint.'",weavingleadtimeyarn="'.$weavingleadtimeyarn.'",weavingleadtimeheather="'.$weavingleadtimeheather.'",dyeingsolid="'.$dyeingsolid.'",dyeingprint="'.$dyeingprint.'",dyeingyarn="'.$dyeingyarn.'",dyeingheather="'.$dyeingheather.'",testingsolid="'.$testingsolid.'",testingprint="'.$testingprint.'",testingyarn="'.$testingyarn.'",testingheather="'.$testingheather.'",totalsolid="'.$totalsolid.'",totalprint="'.$totalprint.'",totalyarn="'.$totalyarn.'",totalheather="'.$totalheather.'",specialcall1="'.$specialcall1.'",specialcall2="'.$specialcall2.'",specialcall3="'.$specialcall3.'",specialcall4="'.$specialcall4.'",specialcall5="'.$specialcall5.'"';


if($_POST['editId']==''){
$adds = addlisting('fabricDetailSheetMaster',$kk);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['action']; ?>');
</script>
<?php
} else {
$where='id='.decode($_POST['editId']).'';
$update = updatelisting('fabricDetailSheetMaster',$kk,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['action']; ?>&add=yes&id=<?php echo $_POST['editId']; ?>');
</script>
<?php
}

}
 /////////////////start sizerange master///////////////////
if(trim($_POST['action'])=='sizerangemaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$size = $_POST['size'];
$size = implode(":", $size);
$dateAdded=time();
$namevalue ='name="'.$name.'",size="'.$size.'",description="'.$description.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting('sizerangeMaster',$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>
<?php }
if(trim($_POST['action'])=='sizerangemaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$size = $_POST['size'];
$size = implode(":", $size);
$description=clean($_POST['description']);
$modifyDate=time();
$where='id='.decode($_POST['editId']).'';
$namevalue ='name="'.$name.'",size="'.$size.'",description="'.$description.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('sizerangeMaster',$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>
<?php }
/////////////////start value edition master///////////////////
if(trim($_POST['action'])=='valueeditionmaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$dateAdded=time();
$namevalue ='name="'.$name.'",description="'.$description.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting('valueEditionMaster',$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>
<?php }
if(trim($_POST['action'])=='valueeditionmaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$modifyDate=time();
$where='id='.decode($_POST['editId']).'';
$namevalue ='name="'.$name.'",description="'.$description.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('valueEditionMaster',$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>
<?php }

if(trim($_POST['action'])=='segmentmaster' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$brand=clean($_POST['brand']);
$description=clean($_POST['description']);
$dateAdded=time();
$modifyDate=time();
if($_POST['editId']==""){
$namevalue ='brand="'.$brand.'",name="'.$name.'",description="'.$description.'",dateAdded="'.$dateAdded.'",modifyDate="'.$modifyDate.'",addedBy="'.$_SESSION['userid'].'",modifyBy="'.$_SESSION['userid'].'"';
$adds = addlisting('segmenteMaster',$namevalue);
}
else{
$where='id='.decode($_POST['editId']).'';
$namevalue ='brand="'.$brand.'",name="'.$name.'",description="'.$description.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('segmenteMaster',$namevalue,$where);
}
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>
<?php }

if(trim($_POST['action'])=='hsncodemaster' && trim($_POST['harcode'])!='' && trim($_POST['module'])!=''){
$harcode=clean($_POST['harcode']);
$hardescription=clean($_POST['hardescription']);
$condescription=clean($_POST['condescription']);
$userdescription=clean($_POST['userdescription']);
$status=clean($_POST['status']);
$hsntype=clean($_POST['hsntype']);
$gsttemplate=clean($_POST['gsttemplate']);
$hsncategory=clean($_POST['hsncategory']);
$hardate=date("Y-m-d", strtotime($_POST['hardate']));


$dateAdded=time();
$modifyDate=time();
if($_POST['editId']==""){
$namevalue ='harcode="'.$harcode.'",hardescription="'.$hardescription.'",condescription="'.$condescription.'",userdescription="'.$userdescription.'",status="'.$status.'",hsntype="'.$hsntype.'",gsttemplate="'.$gsttemplate.'",hsncategory="'.$hsncategory.'",hardate="'.$hardate.'",dateAdded="'.$dateAdded.'",modifyDate="'.$modifyDate.'",addedBy="'.$_SESSION['userid'].'",modifyBy="'.$_SESSION['userid'].'"';
$adds = addlisting('hsncodeMaster',$namevalue);
}
else{
$where='id='.decode($_POST['editId']).'';
$namevalue ='harcode="'.$harcode.'",hardescription="'.$hardescription.'",condescription="'.$condescription.'",userdescription="'.$userdescription.'",status="'.$status.'",hsntype="'.$hsntype.'",gsttemplate="'.$gsttemplate.'",hsncategory="'.$hsncategory.'",hardate="'.$hardate.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('hsncodeMaster',$namevalue,$where);
}
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>
<?php }
 /////////////////start sizeratio master///////////////////
if(trim($_POST['action'])=='sizeratiomaster' && trim($_POST['editId'])==''  && trim($_POST['module'])!=''){
// $name=clean($_POST['name']);
$size = $_POST['size'];
$size = implode(":", $size);
$sizeRangeId=clean($_POST['sizeRangeId']);
$description=clean($_POST['description']);
$dateAdded=time();
$namevalue ='name="'.$size.'",sizeRangeId="'.$sizeRangeId.'",description="'.$description.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting('sizeRatioMaster',$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>
<?php }
if(trim($_POST['action'])=='sizeratiomaster' && trim($_POST['editId'])!=''  && trim($_POST['module'])!=''){
// $name=clean($_POST['name']);
$size = $_POST['size'];
$size = implode(":", $size);
$sizeRangeId=clean($_POST['sizeRangeId']);
$description=clean($_POST['description']);
$modifyDate=time();
$where='id='.decode($_POST['editId']).'';
$namevalue ='name="'.$size.'",sizeRangeId="'.$sizeRangeId.'",description="'.$description.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('sizeRatioMaster',$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>
<?php }

 /////////////////start material sub type master///////////////////
if(trim($_POST['action'])=='materialsubtypemaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$materialTypeId=clean($_POST['materialTypeId']);
$description=clean($_POST['description']);
$dateAdded=time();
$namevalue ='name="'.$name.'",description="'.$description.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'",materialTypeId="'.$materialTypeId.'"';
$adds = addlisting('materialSubType',$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>
<?php }
if(trim($_POST['action'])=='materialsubtypemaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$materialTypeId=clean($_POST['materialTypeId']);
$description=clean($_POST['description']);
$modifyDate=time();
$where='id='.decode($_POST['editId']).'';
$namevalue ='name="'.$name.'",description="'.$description.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'",materialTypeId="'.$materialTypeId.'"';
$update = updatelisting('materialSubType',$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>
<?php }
if(trim($_POST['action'])=='tnatemplatesmaster' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$status=clean($_POST['status']);
$cloneProfile=clean($_POST['cloneProfile']);

$dateAdded=time();
$modifyDate=time();
if($_POST['editId']==""){
$namevalue ='name="'.$name.'",description="'.$description.'",dateAdded="'.$dateAdded.'",modifyDate="'.$modifyDate.'",status="'.$status.'",addedBy="'.$_SESSION['userid'].'",modifyBy="'.$_SESSION['userid'].'"';
$lasttid=addlistinggetlastid('tnaTemplatesMaster',$namevalue);

//===========================CLONE PROFILE==================================================================================
$cq=GetPageRecord('*','taskListMaster',' 1 and tnatemplate="'.$cloneProfile.'"');
while($cloneData=mysqli_fetch_array($cq)){

$namevalue ='criticalPath="'.$cloneData['criticalPath'].'",description="'.$cloneData['description'].'",name="'.$cloneData['name'].'",dateAdded="'.time().'",tna="'.$cloneData['tna'].'",tnatemplate="'.$lasttid.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.time().'",totaldays="'.$cloneData['totaldays'].'",modifyBy="'.$_SESSION['userid'].'",sr="'.$cloneData['sr'].'"';

$adds = addlisting('taskListMaster',$namevalue);

}

//=============================================================================================================================================

}
else{
$where='id='.decode($_POST['editId']).'';
$namevalue ='name="'.$name.'",description="'.$description.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'",status="'.$status.'"';
$update = updatelisting('tnaTemplatesMaster',$namevalue,$where);
}
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>
<?php }
if(trim($_POST['action'])=='selecttnaTemplate' && trim($_POST['editId'])!=''){
$where='id='.decode($_POST['editId']).'';
$namevalue ='tnaTemplateId="'.$_POST['tnaTemplateId'].'"';
$update = updatelisting('queryMaster',$namevalue,$where);
//=======================add query to find TNA templates

//========================================================================================================================

?>
<script>
parent.reload_page();
</script>
<?php }
/////////////////Finish master///////////////////
if(trim($_POST['action'])=='finishmaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$dateAdded=time();
$namevalue ='name="'.$name.'",description="'.$description.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting('finishMaster',$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>
<?php }
if(trim($_POST['action'])=='finishmaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$modifyDate=time();
$where='id="'.decode($_POST['editId']).'"';
$namevalue ='name="'.$name.'",description="'.$description.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('finishMaster',$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>
<?php }
if(trim($_POST['action'])=='pullermaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$status=clean($_POST['status']);
$dateAdded=time();
if($_FILES['materialimage']['name']!=''){
$file_name=$_FILES['materialimage']['name'];
$file_name=time().'-'.str_replace(' ', '_',$file_name);
$file_name= str_replace('#', 'f',$file_name);
copy($_FILES['materialimage']['tmp_name'],"images/".$file_name);
}
$namevalue ='name="'.$name.'",description="'.$description.'",attachment="'.$file_name.'",status="'.$status.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$lasttid=addlistinggetlastid('pullerMaster',$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>
<?php }
if(trim($_POST['action'])=='pullermaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$status=clean($_POST['status']);
if($_FILES['materialimage']['name']!=''){
$file_name=$_FILES['materialimage']['name'];
$file_name=time().'-'.str_replace(' ', '_',$file_name);
$file_name= str_replace('#', 'f',$file_name);
copy($_FILES['materialimage']['tmp_name'],"images/".$file_name);
}
else{
$file_name =$_POST['materialimageedit'];
}
$modifyDate=time();
$where='id='.decode($_POST['editId']).'';
$namevalue ='name="'.$name.'",description="'.$description.'",attachment="'.$file_name.'",status="'.$status.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('pullerMaster',$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>
<?php }
if(trim($_POST['action'])=='slidermaster' && trim($_POST['editId'])=='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$status=clean($_POST['status']);
$dateAdded=time();
if($_FILES['materialimage']['name']!=''){
$file_name=$_FILES['materialimage']['name'];
$file_name=time().'-'.str_replace(' ', '_',$file_name);
$file_name= str_replace('#', 'f',$file_name);
copy($_FILES['materialimage']['tmp_name'],"images/".$file_name);
}
$namevalue ='name="'.$name.'",description="'.$description.'",attachment="'.$file_name.'",status="'.$status.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$lasttid=addlistinggetlastid('sliderMaster',$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>
<?php }
if(trim($_POST['action'])=='slidermaster' && trim($_POST['editId'])!='' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$status=clean($_POST['status']);
if($_FILES['materialimage']['name']!=''){
$file_name=$_FILES['materialimage']['name'];
$file_name=time().'-'.str_replace(' ', '_',$file_name);
$file_name= str_replace('#', 'f',$file_name);
copy($_FILES['materialimage']['tmp_name'],"images/".$file_name);
}
else{
$file_name =$_POST['materialimageedit'];
}
$modifyDate=time();
$where='id='.decode($_POST['editId']).'';
$namevalue ='name="'.$name.'",description="'.$description.'",attachment="'.$file_name.'",status="'.$status.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('sliderMaster',$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>
<?php }
//================================ADD ACTIVITY MASTER
if(trim($_POST['action'])=='tnaactivitymaster' && trim($_POST['name'])!='' && trim($_POST['module'])!=''){
$name=clean($_POST['name']);
$description=clean($_POST['description']);
$status=clean($_POST['status']);

$dateAdded=time();
$modifyDate=time();
$whereCheckref='name="'.$_POST['name'].'"';
$checkCoderef = checkduplicate('tnaActivityMaster',$whereCheckref);
if($checkCoderef=="yes" && $_POST['editId']==""){ ?>
<script>
alert("This activity is already exist.");
</script>
<?php } else{
if($_POST['editId']==""){
$namevalue ='name="'.$name.'",description="'.$description.'",dateAdded="'.$dateAdded.'",modifyDate="'.$modifyDate.'",status="'.$status.'",addedBy="'.$_SESSION['userid'].'",modifyBy="'.$_SESSION['userid'].'"';
$lasttid=addlistinggetlastid('tnaActivityMaster',$namevalue);


}
else{
$where='id='.decode($_POST['editId']).'';
$namevalue ='name="'.$name.'",description="'.$description.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'",status="'.$status.'"';
$update = updatelisting('tnaActivityMaster',$namevalue,$where);
}
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>
<?php } }
 ?>
<!--Add R and D  -->
<?php
 if(trim($_POST['action'])=='addrandd'){
$average=clean($_POST['average']);
$unit1=clean($_POST['uom1']);
$fullwidth=clean($_POST['fullwidth']);
$unit2=clean($_POST['uom2']);
$cutwidth=clean($_POST['cutwidth']);
$unit3=clean($_POST['uom3']);
$lengthwise=clean($_POST['lengthwise']);
$unit4=clean($_POST['uom4']);
$widthwise=clean($_POST['widthwise']);
$unit5=clean($_POST['uom5']);
$fullwidthb=clean($_POST['fullwidthb']);
$unit6=clean($_POST['uom6']);
$cutwidthb=clean($_POST['cutwidthb']);
$unit7=clean($_POST['uom7']);
$lengthwiseb=clean($_POST['lengthwiseb']);
$unit8=clean($_POST['uom8']);
$widthwiseb=clean($_POST['widthwiseb']);
$unit9=clean($_POST['uom9']);
$shellfab=clean($_POST['shellfab']);
$mrksize=clean($_POST['mrksize']);
$linefab=clean($_POST['linefab']);
$nestpiece=clean($_POST['nestpiece']);
$bprint=clean($_POST['bprint']);
$markeffi=clean($_POST['markeffi']);
$placement=clean($_POST['placement']);
$seamallow=clean($_POST['seamallow']);
$addprocess=clean($_POST['addprocess']);
$techname=clean($_POST['techname']);
$techapprove=clean($_POST['techapprove']);
$operation = $_POST['operation'];
$operation = implode(":", $operation);
$highSam = $_POST['highSam'];
$highSam = implode(":", $highSam);
$addoperate=$_POST['addoperate'];
$addoperate = implode(":", $addoperate);
if($_POST['editId']==''){
$namevalue ='styleId="'.decode($_POST['styleid']).'",average="'.$average.'",unit1="'.$unit1.'",fullWidth="'.$fullwidth.'",unit2="'.$unit2.'",cutWidth="'.$cutwidth.'",unit3="'.$unit3.'",lengthWise="'.$lengthwise.'",unit4="'.$unit4.'",widthWise="'.$widthwise.'",unit5="'.$unit5.'",fullWidthb="'.$fullwidthb.'",unit6="'.$unit6.'",cutWidthb="'.$cutwidthb.'",unit7="'.$unit7.'",lengthWiseb="'.$lengthwiseb.'",unit8="'.$unit8.'",widthWiseb="'.$widthwiseb.'",unit9="'.$unit9.'",shellFabric="'.$shellfab.'",markerSize="'.$mrksize.'",liningFabric="'.$linefab.'",nestedPiece="'.$nestpiece.'",borderPrint="'.$bprint.'",markerEff="'.$markeffi.'",placement="'.$placement.'",seamAllow="'.$seamallow.'",operation="'.$operation.'",addOperate="'.$addoperate.'",addProcess="'.$addprocess.'",techname="'.$techname.'",techFinal="'.$techapprove.'",highSam="'.$highSam.'"';
addlisting('randdMaster',$namevalue);

}
else{
$where='id="'.decode($_POST['editId']).'"';
$namevalue ='styleId="'.decode($_POST['styleid']).'",average="'.$average.'",unit1="'.$unit1.'",fullWidth="'.$fullwidth.'",unit2="'.$unit2.'",cutWidth="'.$cutwidth.'",unit3="'.$unit3.'",lengthWise="'.$lengthwise.'",unit4="'.$unit4.'",widthWise="'.$widthwise.'",unit5="'.$unit5.'",fullWidthb="'.$fullwidthb.'",unit6="'.$unit6.'",cutWidthb="'.$cutwidthb.'",unit7="'.$unit7.'",lengthWiseb="'.$lengthwiseb.'",unit8="'.$unit8.'",widthWiseb="'.$widthwiseb.'",unit9="'.$unit9.'",shellFabric="'.$shellfab.'",markerSize="'.$mrksize.'",liningFabric="'.$linefab.'",nestedPiece="'.$nestpiece.'",borderPrint="'.$bprint.'",markerEff="'.$markeffi.'",placement="'.$placement.'",seamAllow="'.$seamallow.'",operation="'.$operation.'",addOperate="'.$addoperate.'",addProcess="'.$addprocess.'",techname="'.$techname.'",techFinal="'.$techapprove.'",highSam="'.$highSam.'"';
$update = updatelisting('randdMaster',$namevalue,$where);
}
?>
<script>
parent.setupbox('showpage.crm?module=randd');
</script>
<?php }
?>
<!--Add Test Requistion Form -->
<?php
 if(trim($_POST['action'])=='testrequisitionform'){
$factoryid=clean($_POST['factoryname']);
$labid=clean($_POST['labname']);
$contactid=clean($_POST['contactperson']);
$invoice=clean($_POST['invoice']);
$charge=clean($_POST['charge']);
$companyid=clean($_POST['cname']);
$comment=clean($_POST['remarks']);
$retest=clean($_POST['retest']);
$returnsample=clean($_POST['returnsample']);
$reportnum=clean($_POST['reportnum']);
$testmethod=clean($_POST['testmethod']);
$commentallow = clean($_POST['comment']);
$dateAdded = date('Y-m-d');
$testdesc=$_POST['testdesc'];
$testdesc = implode(",", $testdesc);
$dimension = $_POST['dimension'];
$dimension = implode(",", $dimension);
$appear = $_POST['appear'];
$appear = implode(",", $appear);
$color = $_POST['color'];
$color = implode(",", $color);
$physical = $_POST['physical'];
$physical = implode(",", $physical);
$ecotest = $_POST['ecotest'];
$ecotest = implode(",", $ecotest);
if($_POST['editId']==''){
$namevalue ='styleId="'.decode($_POST['styleid']).'",factoryId="'.$factoryid.'",labId="'.$labid.'",contactId="'.$contactid.'",invoice="'.$invoice.'",charge="'.$charge.'",companyId="'.$companyid.'",testdesc="'.$testdesc.'",dimensionStable="'.$dimension.'",appearanceR="'.$appear.'",colorFastness="'.$color.'",	physical="'.$physical.'",ecoTest="'.$ecotest.'",testMethod="'.$testmethod.'",comment="'.$comment.'",reTest="'.$retest.'",returnSample="'.$returnsample.'",reportNumber="'.$reportnum.'",dateAdded="'.$dateAdded.'"';
addlisting('testRequisitionForm',$namevalue);

}
else{
$where='id="'.decode($_POST['editId']).'"';
$namevalue ='styleId="'.decode($_POST['styleid']).'",factoryId="'.$factoryid.'",labId="'.$labid.'",contactId="'.$contactid.'",invoice="'.$invoice.'",charge="'.$charge.'",companyId="'.$companyid.'",testdesc="'.$testdesc.'",appearanceR="'.$appear.'",colorFastness="'.$color.'",physical="'.$physical.'",ecoTest="'.$ecotest.'",dimensionStable="'.$dimension.'",testMethod="'.$testmethod.'",comment="'.$comment.'",reTest="'.$retest.'",returnSample="'.$returnsample.'",reportNumber="'.$reportnum.'",dateAdded="'.$dateAdded.'"';
$update = updatelisting('testRequisitionForm',$namevalue,$where);
if($commentallow == "No" ){

$where1='id="'.decode($_POST['editId']).'"';
$namevalue1 ='comment=""';

$update1 = updatelisting('testRequisitionForm',$namevalue1,$where1);

}
}
?>
<script>
parent.setupbox('showpage.crm?module=testrequisitionform');
</script>
<?php }
?>
<!--Add Line Layout -->
<?php
if(trim($_REQUEST['action'])=="linelayout" && $_REQUEST['id']!=""){
$id=trim($_REQUEST['id']);
$grade=$_REQUEST['grade'];
$gradeb=$_REQUEST['gradeb'];
$attachment=trim($_REQUEST['attachment']);
$attachmentb=trim($_REQUEST['attachmentb']);
$allocate=trim($_REQUEST['allocateMc']);
$allocateb=trim($_REQUEST['allocateMcb']);
$operation=trim($_REQUEST['operation']);
$operationb=trim($_REQUEST['operationb']);

$machine=trim($_REQUEST['machine']);
$machineb=trim($_REQUEST['machineb']);
$dateAdded = date('Y-m-d');
$namevalue ='grade="'.$grade.'",attachment="'.$attachment.'",allocateMc="'.$allocate.'",operationId="'.$operation.'",machineId="'.$machine.'",gradeb="'.$gradeb.'",attachmentb="'.$attachmentb.'",allocateMcb="'.$allocateb.'",operationIdb="'.$operationb.'",machineIdb="'.$machineb.'",dateAdded="'.$dateAdded.'"';
$where='id="'.$id.'"';
$update = updatelisting('lineLayoutMaster',$namevalue,$where);
}
?>
<!-- addcdn -->
<?php
if(trim($_POST['action']) == 'cdn' || trim($_POST['action']) == 'samplecdn') {
$brand=clean($_POST['brand']);
if(trim($_POST['action']) == 'cdn'){
  $cdntype='1';
}
else{
  $cdntype='2';
}
$cdnno=clean($_POST['cdnno']);
$cdndate=date('d-m-Y');
$factorylocation=clean($_POST['factorylocation']);
$buyer=clean($_POST['buyer']);
$currency=clean($_POST['curr']);
$ewbd=clean($_POST['ewbd']);
$ewbn=clean($_POST['ewbn']);
$ptm=clean($_POST['ptm']);
$deliverycenter=clean($_POST['delivery']);
$lrd=clean($_POST['lrd']);
$shipmentmode=clean($_POST['shipmentmode']);
$gate=clean($_POST['gate']);
$vehicletype=clean($_POST['vehicletype']);
$vehicleno=clean($_POST['vehicleno']);
$dln=clean($_POST['dln']);
$lrn=clean($_POST['lrn']);
$driversname=clean($_POST['driversname']);
$clearing=clean($_POST['clearing']);
$dmn=clean($_POST['dmn']);
$ind=clean($_POST['ind']);
$office=clean($_POST['office']);
$destadd=clean($_POST['destaddress']);
$carrier=clean($_POST['carrier']);
$cname=clean($_POST['cname']);
$awbno=clean($_POST['awbno']);
$rname=clean($_POST['recname']);
$sname=clean($_POST['senname']);
$etod=clean($_POST['etod']);
$etoa=clean($_POST['etoa']);
if($_FILES['pod']['name']!=''){
$pod=$_FILES['pod']['name'];
$pod=time().'-'.$pod;
copy($_FILES['pod']['tmp_name'],"attachment/".$pod);
}
else{
  $pod= $_POST['upload1'];
}
// $dateAdded=time();
if($_POST['editId']==''){
$namevalue ='cdntype="'.$cdntype.'",brandId="'.$brand.'",cdnno="'.$cdnno.'",cdndate="'.$cdndate.'",factorylocation="'.$factorylocation.'",buyerId="'.$buyer.'",currency="'.$currency.'",electronicdate="'.$ewbd.'",electronicno="'.$ewbn.'",ptm="'.$ptm.'",deliverycenter="'.$deliverycenter.'",lrd="'.$lrd.'",shipmentmode="'.$shipmentmode.'",gate="'.$gate.'",vehicletype="'.$vehicletype.'",vehicleno="'.$vehicleno.'",dln="'.$dln.'",lrn="'.$lrn.'",drivername="'.$driversname.'",clearing="'.$clearing.'",dmn="'.$dmn.'",ind="'.$ind.'",office="'.$office.'",destAddress="'.$destadd.'",carrier="'.$carrier.'",carrierName="'.$cname.'",awbNo="'.$awbno.'",rName="'.$rname.'",sName="'.$sname.'",etod="'.$etod.'",etoa="'.$etoa.'",pod="'.$pod.'"';
addlisting('cdnMaster',$namevalue);
}
else{
$where='id="'.decode($_POST['editId']).'"';
$namevalue ='cdntype="'.$cdntype.'",brandId="'.$brand.'",cdnno="'.$cdnno.'",cdndate="'.$cdndate.'",factorylocation="'.$factorylocation.'",buyerId="'.$buyer.'",currency="'.$currency.'",electronicdate="'.$ewbd.'",electronicno="'.$ewbn.'",ptm="'.$ptm.'",deliverycenter="'.$deliverycenter.'",lrd="'.$lrd.'",shipmentmode="'.$shipmentmode.'",gate="'.$gate.'",vehicletype="'.$vehicletype.'",vehicleno="'.$vehicleno.'",dln="'.$dln.'",lrn="'.$lrn.'",drivername="'.$driversname.'",clearing="'.$clearing.'",dmn="'.$dmn.'",ind="'.$ind.'",office="'.$office.'",destAddress="'.$destadd.'",carrier="'.$carrier.'",carrierName="'.$cname.'",awbNo="'.$awbno.'",rName="'.$rname.'",sName="'.$sname.'",etod="'.$etod.'",etoa="'.$etoa.'",pod="'.$pod.'"';
$update = updatelisting('cdnMaster',$namevalue,$where);
}
?>
<script>
var cdn = "<?php echo $_POST['action'] ?>";
parent.setupbox('showpage.crm?module='+cdn);
</script>
<?php }
?>
<?php
if(trim($_REQUEST['action']) == 'addcdn' && $_REQUEST['id']!=""){
$id=trim($_REQUEST['id']);
$style=trim($_REQUEST['style']);
$indent=trim($_REQUEST['indent']);
$req = trim($_REQUEST['requisition']);
$hsn=trim($_REQUEST['hsn']);
$invoice=trim($_REQUEST['invoice']);
$asn=trim($_REQUEST['asn']);
$bpo=trim($_REQUEST['bpo']);
$destination=trim($_REQUEST['destination']);
$quantity=trim($_REQUEST['quantity']);
$amount=trim($_REQUEST['amount']);
$packagesno=trim($_REQUEST['packagesno']);
$packagesform=trim($_REQUEST['packagesform']);
$packagesto=trim($_REQUEST['packagesto']);
$cbm=trim($_REQUEST['cbm']);
$value=trim($_REQUEST['value']);
$namevalue ='styleId="'.$style.'",indentNo="'.$indent.'",hsnCode="'.$hsn.'",invoiceNo="'.$invoice.'",asnNo="'.$asn.'",bpoNo="'.$bpo.'",destCenter="'.$destination.'",qty="'.$quantity.'",amnt="'.$amount.'",packageNo="'.$packagesno.'",pckgFrom="'.$packagesform.'",pckgTo="'.$packagesto.'",cbm="'.$cbm.'",value="'.$value.'",sampleReq="'.$req.'"';
$where='id="'.$id.'"';
$update = updatelisting('cdnStyleMaster',$namevalue,$where);
}
?>
<!-- add airfreight -->
<?php
 if(trim($_POST['action'])=='airfreight'){
$pfor=clean($_POST['pfor']);
$rfor=clean($_POST['rfor']);
$rdate=date('Y-m-d');
$department=clean($_POST['department']);
$bpo=clean($_POST['bpo']);
$dcpo=clean($_POST['dcpo']);
$indent=clean($_POST['indent']);
$idcpo=clean($_POST['idcpo']);
$cost=clean($_POST['cost']);
$orgfact=clean($_POST['orgfact']);
$destport=clean($_POST['destport']);
$shipcancel=clean($_POST['shipcancel']);
$qtyuom=clean($_POST['qtyuom']);
$factdate=clean($_POST['factdate']);
$fname=clean($_POST['fname']);
$candate=clean($_POST['candate']);
$sterm=clean($_POST['sterm']);
$invalue=clean($_POST['invalue']);
$reason=clean($_POST['reason']);
$usd=clean($_POST['usd']);
$tpayment=clean($_POST['tpayment']);
$inr=clean($_POST['inr']);
$icost=clean($_POST['icost']);
$status=clean($_POST['status']);
if($_POST['editId']==''){
$namevalue ='styleId="'.decode($_POST['styleid']).'",preparedBy="'.$pfor.'",requiredFor="'.$rfor.'",requiredDate="'.$rdate.'",departmentId="'.$department.'",buyerPo="'.$bpo.'",dcpo="'.$dcpo.'",indentNo="'.$indent.'",idcpo="'.$idcpo.'",costInc="'.$cost.'",orgfact="'.$orgfact.'",destPort="'.$destport.'",shipCancel="'.$shipcancel.'",qtyuom="'.$qtyuom.'",factDate="'.$factdate.'",fName="'.$fname.'",cancelDate="'.$candate.'",shipTerm="'.$sterm.'",invoiceVal="'.$invalue.'",reason="'.$reason.'",termPayment="'.$tpayment.'",usd="'.$usd.'",inr="'.$inr.'",costing="'.$icost.'",statusFinal="'.$status.'"';
addlisting('airFreightMaster',$namevalue);

}
else{
$where='id="'.decode($_POST['editId']).'"';
$namevalue ='styleId="'.decode($_POST['styleid']).'",preparedBy="'.$pfor.'",requiredFor="'.$rfor.'",requiredDate="'.$rdate.'",departmentId="'.$department.'",buyerPo="'.$bpo.'",dcpo="'.$dcpo.'",indentNo="'.$indent.'",idcpo="'.$idcpo.'",costInc="'.$cost.'",orgfact="'.$orgfact.'",destPort="'.$destport.'",shipCancel="'.$shipcancel.'",qtyuom="'.$qtyuom.'",factDate="'.$factdate.'",fName="'.$fname.'",cancelDate="'.$candate.'",shipTerm="'.$sterm.'",invoiceVal="'.$invalue.'",reason="'.$reason.'",termPayment="'.$tpayment.'",usd="'.$usd.'",inr="'.$inr.'",costing="'.$icost.'",statusFinal="'.$status.'"';
updatelisting('airFreightMaster',$namevalue,$where);
}
?>
<script>
parent.setupbox('showpage.crm?module=airprepaidpreauth');
</script>
<?php }
?>
<?php
 if(trim($_POST['action'])=='poManage'){
$potype=clean($_POST['potype']);
if($potype == '1'){
$ponumber=clean($_POST['ponumber']);
$poqty=clean($_POST['poqty']);
$rdate=date('Y-m-d');
$dterm=clean($_POST['dterm']);

$cdate=clean($_POST['cdate']);
$shipmode=clean($_POST['shipmode']);
$factstart=clean($_POST['factstart']);
$factend=clean($_POST['factend']);

if($_FILES['poattach']['name']!=''){
$file_name=$_FILES['poattach']['name'];
$file_name=time().'-'.$file_name;
copy($_FILES['poattach']['tmp_name'],"attachment/".$file_name);
}
$namevalue ='styleId="'.decode($_POST['styleid']).'",poNumber="'.$ponumber.'",requiredDate="'.$rdate.'",poQty="'.$poqty.'",attachFile="'.$file_name.'",factStart="'.$factstart.'",factEnd="'.$factend.'",shipMode="'.$shipmode.'",cutoffDate="'.$cdate.'",deliveryTerm="'.$dterm.'"';
addlisting('poManageMaster',$namevalue);

}
if($potype == '2'){
$ponumber=clean($_POST['ponumber']);
$dcponumber=clean($_POST['dcponumber']);
$poqty=clean($_POST['poqty']);
$rdate=date('Y-m-d');
$dterm=clean($_POST['dterm']);
$cdate=clean($_POST['cdate']);
$shipmode=clean($_POST['shipmode']);
$factstart=clean($_POST['factstart']);
$factend=clean($_POST['factend']);

if($_FILES['poattach']['name']!=''){
$file_name=$_FILES['poattach']['name'];
$file_name=time().'-'.$file_name;
copy($_FILES['poattach']['tmp_name'],"attachment/".$file_name);
}
$namevalue ='styleId="'.decode($_POST['styleid']).'",poNumber="'.$dcponumber.'",dcpoNumber="'.$ponumber.'",requiredDate="'.$rdate.'",dcpoQty="'.$poqty.'",attachFile="'.$file_name.'",factStart="'.$factstart.'",factEnd="'.$factend.'",shipMode="'.$shipmode.'",cutoffDate="'.$cdate.'",deliveryTerm="'.$dterm.'"';
addlisting('dcpoManageMaster',$namevalue);
}
?>
<script>
parent.setupbox('showpage.crm?module=buyerpo');
</script>
<?php }
?>
<?php
 if(trim($_POST['action'])=='poManageedit'){
$ponumber=clean($_POST['ponumber']);
$poqty=clean($_POST['poqty']);
$dterm=clean($_POST['dterm']);

$cdate=clean($_POST['cdate']);
$shipmode=clean($_POST['shipmode']);
$factstart=clean($_POST['factstart']);
$factend=clean($_POST['factend']);
if($_FILES['poattach']['name']!=''){
$file_name=$_FILES['poattach']['name'];
$file_name=time().'-'.$file_name;
copy($_FILES['poattach']['tmp_name'],"attachment/".$file_name);
}else{
 $file_name=$_POST['poattachhidden'];
}
$where='id="'.decode($_POST['editid']).'"';
$namevalue ='styleId="'.decode($_POST['styleId']).'",poNumber="'.$ponumber.'",poQty="'.$poqty.'",attachFile="'.$file_name.'",factStart="'.$factstart.'",factEnd="'.$factend.'",shipMode="'.$shipmode.'",cutoffDate="'.$cdate.'",deliveryTerm="'.$dterm.'"';
updatelisting('poManageMaster',$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=poManage');
</script>
<?php }
?>
<?php
 if(trim($_POST['action'])=='dcpoManageedit'){
$ponumber=clean($_POST['ponumber']);
$dcponumber=clean($_POST['dcponumber']);
$poqty=clean($_POST['poqty']);
$rdate=date('Y-m-d');
$dterm=clean($_POST['dterm']);
$cdate=clean($_POST['cdate']);
$shipmode=clean($_POST['shipmode']);
$factstart=clean($_POST['factstart']);
$factend=clean($_POST['factend']);

if($_FILES['poattach']['name']!=''){
$file_name=$_FILES['poattach']['name'];
$file_name=time().'-'.$file_name;
copy($_FILES['poattach']['tmp_name'],"attachment/".$file_name);
}else{
 $file_name=$_POST['poattachhidden'];
}
$where='id="'.decode($_POST['editid']).'"';
$namevalue ='styleId="'.decode($_POST['styleId']).'",poNumber="'.$dcponumber.'",dcpoNumber="'.$ponumber.'",requiredDate="'.$rdate.'",dcpoQty="'.$poqty.'",attachFile="'.$file_name.'",factStart="'.$factstart.'",factEnd="'.$factend.'",shipMode="'.$shipmode.'",cutoffDate="'.$cdate.'",deliveryTerm="'.$dterm.'"';
updatelisting('dcpoManageMaster',$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=dcpoManage');
</script>
<?php }
?>
<?php
 if(trim($_POST['action'])=='colorcriticalpath'){
 if($_FILES['devftp']['name']!=''){
$file_name1=$_FILES['devftp']['name'];
$file_name1=time().'-'.$file_name1;
copy($_FILES['devftp']['tmp_name'],"attachment/".$file_name1);
$date1 = date('d-m-Y');
}
else{
  $file_name1= $_POST['upload1'];
  $date1 = clean($_POST['date1']);
}

if($_FILES['finallinf']['name']!=''){
$file_name21=$_FILES['finallinf']['name'];
$file_name21=time().'-'.$file_name21;
copy($_FILES['finallinf']['tmp_name'],"attachment/".$file_name21);
$date21 = date('d-m-Y');
}
else{
  $file_name21= $_POST['upload21'];
  $date21 = clean($_POST['date21']);
}




if($_FILES['sublinpf']['name']!=''){
$file_name22=$_FILES['sublinpf']['name'];
$file_name22=time().'-'.$file_name22;
copy($_FILES['sublinpf']['tmp_name'],"attachment/".$file_name22);
$date22 = date('d-m-Y');
}
else{
  $file_name22= $_POST['upload22'];
  $date22 = clean($_POST['date22']);
}



if($_FILES['finalshellpf']['name']!=''){
$file_name23=$_FILES['finalshellpf']['name'];
$file_name23=time().'-'.$file_name23;
copy($_FILES['finalshellpf']['tmp_name'],"attachment/".$file_name23);
$date23 = date('d-m-Y');
}
else{
  $file_name23= $_POST['upload23'];
  $date23 = clean($_POST['date23']);
}


if($_FILES['subshellpf']['name']!=''){
$file_name24=$_FILES['subshellpf']['name'];
$file_name24=time().'-'.$file_name24;
copy($_FILES['subshellpf']['tmp_name'],"attachment/".$file_name24);
$date24 = date('d-m-Y');
}
else{
  $file_name24= $_POST['upload24'];
  $date24 = clean($_POST['date24']);
}

if($_FILES['bulklinpf']['name']!=''){
$file_name25=$_FILES['bulklinpf']['name'];
$file_name25=time().'-'.$file_name25;
copy($_FILES['bulklinpf']['tmp_name'],"attachment/".$file_name25);
$date25 = date('d-m-Y');
}
else{
  $file_name25= $_POST['upload25'];
  $date25 = clean($_POST['date25']);
}


if($_FILES['fobpf']['name']!=''){
$file_name26=$_FILES['fobpf']['name'];
$file_name26=time().'-'.$file_name26;
copy($_FILES['fobpf']['tmp_name'],"attachment/".$file_name26);
$date26 = date('d-m-Y');
}
else{
  $file_name26= $_POST['upload26'];
  $date26 = clean($_POST['date26']);
}

if($_FILES['shadepf']['name']!=''){
$file_name27=$_FILES['shadepf']['name'];
$file_name27=time().'-'.$file_name27;
copy($_FILES['shadepf']['tmp_name'],"attachment/".$file_name27);
$date27 = date('d-m-Y');
}
else{
  $file_name27= $_POST['upload27'];
  $date27 = clean($_POST['date27']);
}


if($_FILES['devgtp']['name']!=''){
$file_name2=$_FILES['devgtp']['name'];
$file_name2=time().'-'.$file_name2;
copy($_FILES['devgtp']['tmp_name'],"attachment/".$file_name2);
$date2 = date('d-m-Y');
}
else{
  $file_name2= $_POST['upload2'];
  $date2 = clean($_POST['date2']);
}
if($_FILES['bulkftp']['name']!=''){
$file_name3=$_FILES['bulkftp']['name'];
$file_name3=time().'-'.$file_name3;
copy($_FILES['bulkftp']['tmp_name'],"attachment/".$file_name3);
$date3 = date('d-m-Y');
}
else{
  $file_name3= $_POST['upload3'];
  $date3 = clean($_POST['date3']);
}
if($_FILES['ppsample']['name']!=''){
$file_name4=$_FILES['ppsample']['name'];
$file_name4=time().'-'.$file_name4;
copy($_FILES['ppsample']['tmp_name'],"attachment/".$file_name4);
$date4 = date('d-m-Y');
}
else{
  $file_name4= $_POST['upload4'];
  $date4 = clean($_POST['date4']);
}
if($_FILES['bulkgtp']['name']!=''){
$file_name5=$_FILES['bulkgtp']['name'];
$file_name5=time().'-'.$file_name5;
copy($_FILES['bulkgtp']['tmp_name'],"attachment/".$file_name5);
$date5 = date('d-m-Y');
}
else{
  $file_name5= $_POST['upload5'];
  $date5 = clean($_POST['date5']);
}
$addsampledate = clean($_POST['actualDate6']);
$topsampledate = clean($_POST['actualDate7']);
$addsample = clean($_POST['addsample']);
$topsample = clean($_POST['topsample']);



$subshellp=clean($_POST['subshellp']);
$finalshellp=clean($_POST['finalshellp']);

$sublinp=clean($_POST['sublinp']);

$finallinp=clean($_POST['finallinp']);

$bulklinp=clean($_POST['bulklinp']);

$fobp=clean($_POST['fobp']);

$shadep=clean($_POST['shadep']);





if($_POST['editId']==''){
$namevalue ='styleId="'.decode($_POST['styleid']).'",colorId="'.decode($_POST['poid']).'",devFtp="'.$file_name1.'",finallinf="'.$file_name21.'",finallinfDate="'.$date21.'",sublinpf="'.$file_name22.'",sublinpfDate="'.$date22.'",finalshellpf="'.$file_name23.'",finalshellpfDate="'.$date23.'",subshellpf="'.$file_name24.'",subshellpfDate="'.$date24.'",bulklinpf="'.$file_name25.'",bulklinpfDate="'.$date25.'",fobpf="'.$file_name26.'",fobpfDate="'.$date26.'",shadepf="'.$file_name27.'",shadepfDate="'.$date27.'",devGtp="'.$file_name2.'",bulkFtp="'.$file_name3.'",ppSample="'.$file_name4.'",bulkGtp="'.$file_name5.'",devFtpDate="'.$date1.'",devGtpDate="'.$date2.'",bulkFtpDate="'.$date3.'",ppSampleDate="'.$date4.'",bulkGtpDate="'.$date5.'",addSampleDate="'.$addsampledate.'",addSample="'.$addsample.'",topSampleDate="'.$topsampledate.'",topSample="'.$topsample.'",subshellp="'.$subshellp.'",finalshellp="'.$finalshellp.'",sublinp="'.$sublinp.'",finallinp="'.$finallinp.'",bulklinp="'.$bulklinp.'",fobp="'.$fobp.'",shadep="'.$shadep.'"';
addlisting('criticalPathMaster',$namevalue);
}
else{
$where='id="'.decode($_POST['editId']).'"';
$namevalue ='styleId="'.decode($_POST['styleid']).'",colorId="'.decode($_POST['poid']).'",devFtp="'.$file_name1.'",finallinf="'.$file_name21.'",finallinfDate="'.$date21.'",sublinpf="'.$file_name22.'",sublinpfDate="'.$date22.'",finalshellpf="'.$file_name23.'",finalshellpfDate="'.$date23.'",subshellpf="'.$file_name24.'",subshellpfDate="'.$date24.'",bulklinpf="'.$file_name25.'",bulklinpfDate="'.$date25.'",fobpf="'.$file_name26.'",fobpfDate="'.$date26.'",shadepf="'.$file_name27.'",shadepfDate="'.$date27.'",devGtp="'.$file_name2.'",bulkFtp="'.$file_name3.'",ppSample="'.$file_name4.'",bulkGtp="'.$file_name5.'",devFtpDate="'.$date1.'",devGtpDate="'.$date2.'",bulkFtpDate="'.$date3.'",ppSampleDate="'.$date4.'",bulkGtpDate="'.$date5.'",addSampleDate="'.$addsampledate.'",addSample="'.$addsample.'",topSampleDate="'.$topsampledate.'",topSample="'.$topsample.'",subshellp="'.$subshellp.'",finalshellp="'.$finalshellp.'",sublinp="'.$sublinp.'",finallinp="'.$finallinp.'",bulklinp="'.$bulklinp.'",fobp="'.$fobp.'",shadep="'.$shadep.'"';
$update = updatelisting('criticalPathMaster',$namevalue,$where);
}
?>
<script>
parent.setupbox('showpage.crm?module=criticalpath');
</script>
<?php }
?>
<?php
if(trim($_POST['action']) == 'merchantfilehandover' && isset($_POST["filesubmit"])){
$postatus=clean($_POST['postatus']);
$techpack=clean($_POST['techpack']);
$appseal=clean($_POST['appseal']);
$comments=clean($_POST['comments']);
$tna=clean($_POST['tna']);
$fabrictrim=clean($_POST['fabrictrim']);
$cadmarker=clean($_POST['cadmarker']);
$ftp=clean($_POST['ftp']);
$gtp=clean($_POST['gtp']);
$fob=clean($_POST['fob']);
$fobadd=clean($_POST['fobadd']);
$fabric=clean($_POST['fabric']);
$datefile = date('d-m-Y');


if($_POST['editId']==""){
$namevalue ='styleId="'.decode($_POST['styleid']).'",postatus="'.$postatus.'",techpack="'.$techpack.'",appseal="'.$appseal.'",comments="'.$comments.'",tna="'.$tna.'",fabrictrim="'.$fabrictrim.'",cadmarker="'.$cadmarker.'",ftp="'.$ftp.'",gtp="'.$gtp.'",fob="'.$fob.'",fobadd="'.$fobadd.'",fabric="'.$fabric.'",dateAdded="'.$datefile.'"';
addlisting('fileHandoverMaster',$namevalue);
}
else{
$where='id='.decode($_POST['editId']).'';
$namevalue ='styleId="'.decode($_POST['styleid']).'",postatus="'.$postatus.'",techpack="'.$techpack.'",appseal="'.$appseal.'",comments="'.$comments.'",tna="'.$tna.'",fabrictrim="'.$fabrictrim.'",cadmarker="'.$cadmarker.'",ftp="'.$ftp.'",gtp="'.$gtp.'",fob="'.$fob.'",fobadd="'.$fobadd.'",fabric="'.$fabric.'",dateAdded="'.$datefile.'"';
$update = updatelisting('fileHandoverMaster',$namevalue,$where);
}
?>
<script>
parent.setupbox('showpage.crm?module=filehandover');
</script>
<?php }
if(trim($_POST['action']) == 'merchantfilehandover' && isset($_POST["sendppc"])){
$postatus=clean($_POST['postatus']);
$techpack=clean($_POST['techpack']);
$appseal=clean($_POST['appseal']);
$comments=clean($_POST['comments']);
$tna=clean($_POST['tna']);
$fabrictrim=clean($_POST['fabrictrim']);
$cadmarker=clean($_POST['cadmarker']);
$ftp=clean($_POST['ftp']);
$gtp=clean($_POST['gtp']);
$fob=clean($_POST['fob']);
$fobadd=clean($_POST['fobadd']);
$fabric=clean($_POST['fabric']);
$datefile = date('d-m-Y');


if($_POST['editId']==""){
$namevalue ='styleId="'.decode($_POST['styleid']).'",postatus="'.$postatus.'",techpack="'.$techpack.'",appseal="'.$appseal.'",comments="'.$comments.'",tna="'.$tna.'",fabrictrim="'.$fabrictrim.'",cadmarker="'.$cadmarker.'",ftp="'.$ftp.'",gtp="'.$gtp.'",fob="'.$fob.'",fobadd="'.$fobadd.'",fabric="'.$fabric.'",dateAdded="'.$datefile.'",sendppc="1"';
addlisting('fileHandoverMaster',$namevalue);
}
else{
$where='id='.decode($_POST['editId']).'';
$namevalue ='styleId="'.decode($_POST['styleid']).'",postatus="'.$postatus.'",techpack="'.$techpack.'",appseal="'.$appseal.'",comments="'.$comments.'",tna="'.$tna.'",fabrictrim="'.$fabrictrim.'",cadmarker="'.$cadmarker.'",ftp="'.$ftp.'",gtp="'.$gtp.'",fob="'.$fob.'",fobadd="'.$fobadd.'",fabric="'.$fabric.'",dateAdded="'.$datefile.'",sendppc="1"';
$update = updatelisting('fileHandoverMaster',$namevalue,$where);
}
?>
<script>
parent.setupbox('showpage.crm?module=filehandover');
</script>
<?php
}
if(trim($_POST['action'])=='convsizeratiomaster' && trim($_POST['editId'])==''  && trim($_POST['module'])!=''){
// $name=clean($_POST['name']);
$destination = $_POST['destination'];
$buyerId=clean($_POST['buyerId']);
$brandId=clean($_POST['brandId']);
$subCategoryId=clean($_POST['subCategoryId']);
$SizeRangeId=clean($_POST['sizeRangeId']);
$Sizeratio=clean($_POST['sizeratio']);
$dateAdded=time();
$namevalue ='destination="'.$destination.'",buyerId="'.$buyerId.'",brandId="'.$brandId.'",subCategoryId="'.$subCategoryId.'",sizeRangeId="'.$SizeRangeId.'",SizeRatio="'.$Sizeratio.'",dateAdded="'.$dateAdded.'",addedBy="'.$_SESSION['userid'].'"';
$adds = addlisting('convSizeRatioMaster',$namevalue);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>
<?php }
if(trim($_POST['action'])=='convsizeratiomaster' && trim($_POST['editId'])!=''  && trim($_POST['module'])!=''){
// $name=clean($_POST['name']);
$destination = $_POST['destination'];
$buyerId=clean($_POST['buyerId']);
$brandId=clean($_POST['brandId']);
$subCategoryId=clean($_POST['subCategoryId']);
$SizeRangeId=clean($_POST['sizeRangeId']);
$Sizeratio=clean($_POST['sizeratio']);
$modifyDate=time();
$where='id='.decode($_POST['editId']).'';
$namevalue ='destination="'.$destination.'",buyerId="'.$buyerId.'",brandId="'.$brandId.'",subCategoryId="'.$subCategoryId.'",sizeRangeId="'.$SizeRangeId.'",SizeRatio="'.$Sizeratio.'",modifyDate="'.$modifyDate.'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('convSizeRatioMaster',$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=2');
</script>
<?php }
if(trim($_POST['action'])=='capacitymaster' && trim($_POST['factoryId'])!=''){
$factoryId=clean($_POST['factoryId']);
$totalLine=clean($_POST['totalLine']);
$operatorPerLine=clean($_POST['operatorPerLine']);
$avgHrs=clean($_POST['avgHrs']);
$minuteCapacity=clean($_POST['minuteCapacity']);
$avgSam=clean($_POST['avgSam']);
$avgEfficiency=clean($_POST['avgEfficiency']);
$outputDay=clean($_POST['outputDay']);
$outputMonth=clean($_POST['outputMonth']);
$outputSeason=clean($_POST['outputSeason']);
$seasonAllocation=clean($_POST['seasonAllocation']);
$numberOfStyle=clean($_POST['numberOfStyle']);
$avgQty=clean($_POST['avgQty']);
$module=clean($_POST['module']);
$whereCheckref='factoryId="'.$_POST['factoryId'].'"';
$checkCoderef = checkduplicate('capacityMaster',$whereCheckref);
if($checkCoderef=="no"){
$kk ='factoryId="'.$factoryId.'",totalLine="'.$totalLine.'",operatorPerLine="'.$operatorPerLine.'",avgHrs="'.$avgHrs.'",minuteCapacity="'.$minuteCapacity.'",avgSam="'.$avgSam.'",avgEfficiency="'.$avgEfficiency.'",addedBy="'.$_SESSION['userid'].'",outputDay="'.$outputDay.'",outputMonth="'.$outputMonth.'",outputSeason="'.$outputSeason.'",seasonAllocation="'.$seasonAllocation.'",numberOfStyle="'.$numberOfStyle.'",avgQty="'.$avgQty.'"';
$adds = addlisting('capacityMaster',$kk);
}else{
$where='factoryId="'.$factoryId.'"';
$kk ='factoryId="'.$factoryId.'",totalLine="'.$totalLine.'",operatorPerLine="'.$operatorPerLine.'",avgHrs="'.$avgHrs.'",minuteCapacity="'.$minuteCapacity.'",avgSam="'.$avgSam.'",avgEfficiency="'.$avgEfficiency.'",addedBy="'.$_SESSION['userid'].'",outputDay="'.$outputDay.'",outputMonth="'.$outputMonth.'",outputSeason="'.$outputSeason.'",seasonAllocation="'.$seasonAllocation.'",numberOfStyle="'.$numberOfStyle.'",avgQty="'.$avgQty.'"';
$update = updatelisting('capacityMaster',$kk,$where);
}
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $module; ?>');
</script>
<?php
}
?>
<?php
if(trim($_POST['action'])=='factorywisemaster'){
$quarter=clean($_POST['quarter']);
$factoryId=clean($_POST['factoryId']);
$totalLine=clean($_POST['line']);
$brand=clean($_POST['brandId']);
$shiftHrs=clean($_POST['shifthours']);
$operator=clean($_POST['operator']);
$avgSam=clean($_POST['avgSam']);
$avgEfficiency=clean($_POST['avgEfficiency']);
$outputLine=clean($_POST['outputline']);
$outputDay=clean($_POST['outputDay']);
$outputMonth=clean($_POST['outputMonth']);
$outputSeason=clean($_POST['outputquarter']);
$seasonAllocation=clean($_POST['seasonAllocation']);
$numberOfStyle=clean($_POST['numberOfStyle']);
$avgQty=clean($_POST['avgQty']);
$dateAdded=date('Y-m-d',strtotime($_POST['dateAdded']));
$module=clean($_POST['module']);
if($_POST['editId']==""){
$kk ='quarter="'.$quarter.'",factoryId="'.$factoryId.'",line="'.$totalLine.'",brandId="'.$brand.'",shiftHours="'.$shiftHrs.'",operator="'.$operator.'",avgSam="'.$avgSam.'",avgEfficiency="'.$avgEfficiency.'",addedBy="'.$_SESSION['userid'].'",outputLine="'.$outputLine.'",outputDay="'.$outputDay.'",outputMonth="'.$outputMonth.'",outputQuarter="'.$outputSeason.'",seasonAllocate="'.$seasonAllocation.'",styleNo="'.$numberOfStyle.'",avgQty="'.$avgQty.'",dateAdded="'.$dateAdded.'"';
$adds = addlisting('factoryBrandMaster',$kk);
}else{
$where='id="'.decode($_POST['editId']).'"';
$kk ='quarter="'.$quarter.'",factoryId="'.$factoryId.'",line="'.$totalLine.'",brandId="'.$brand.'",shiftHours="'.$shiftHrs.'",operator="'.$operator.'",avgSam="'.$avgSam.'",avgEfficiency="'.$avgEfficiency.'",addedBy="'.$_SESSION['userid'].'",outputLine="'.$outputLine.'",outputDay="'.$outputDay.'",outputMonth="'.$outputMonth.'",outputQuarter="'.$outputSeason.'",seasonAllocate="'.$seasonAllocation.'",styleNo="'.$numberOfStyle.'",avgQty="'.$avgQty.'",dateAdded="'.$dateAdded.'"';
$update = updatelisting('factoryBrandMaster',$kk,$where);
}
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $module; ?>');
</script>
<?php
}
?>
<?php
 if(trim($_POST['action'])=='subtna'){
$cadreceived=$_POST['cadreceived'];
$cadreceived= implode(",", $cadreceived);
$standardreceived=$_POST['standardreceived'];
$standardreceived= implode(",", $standardreceived);
$firstsubmitdate=$_POST['firstsubmitdate'];
$firstsubmitdate= implode(",", $firstsubmitdate);
$firstsubmitcomment=$_POST['firstsubmitcomment'];
$firstsubmitcomment = implode(",", $firstsubmitcomment);
$secondsubmitdate=$_POST['secondsubmitdate'];
$secondsubmitdate = implode(",", $secondsubmitdate);
$secondsubmitcomment=$_POST['secondsubmitcomment'];
$secondsubmitcomment = implode(",", $secondsubmitcomment);
$approvalcomment=$_POST['approvalcomment'];
$approvalcomment = implode(",", $approvalcomment);
$indentapproved=$_POST['indentapproved'];
$indentapproved = implode(",", $indentapproved);
$fobsubmit=$_POST['fobsubmit'];
$fobsubmit = implode(",", $fobsubmit);
$fptapproved=$_POST['fptapproved'];
$fptapproved = implode(",", $fptapproved);
$planned=$_POST['planned'];
$actual=$_POST['actual'];
$dateAdded = date('Y-m-d');
if($_POST['editId']==''){
$namevalue ='styleId="'.decode($_POST['styleid']).'",cadreceived="'.$cadreceived.'",standardreceived="'.$standardreceived.'",firstsubmitdate="'.$firstsubmitdate.'",firstsubmitcomment="'.$firstsubmitcomment.'",secondsubmitdate="'.$secondsubmitdate.'",secondsubmitcomment="'.$secondsubmitcomment.'",approvalcomment="'.$approvalcomment.'",indentapproved="'.$indentapproved.'",fobsubmit="'.$fobsubmit.'",fptapproved="'.$fptapproved.'",planneddate="'.$planned.'",actualdate="'.$actual.'", dateAdded="'.$dateAdded.'"';
addlisting('subtnaMaster',$namevalue);

}
else{
$where='id="'.decode($_POST['editId']).'"';
$namevalue ='styleId="'.decode($_POST['styleid']).'",cadreceived="'.$cadreceived.'",standardreceived="'.$standardreceived.'",firstsubmitdate="'.$firstsubmitdate.'",firstsubmitcomment="'.$firstsubmitcomment.'",secondsubmitdate="'.$secondsubmitdate.'",secondsubmitcomment="'.$secondsubmitcomment.'",approvalcomment="'.$approvalcomment.'",indentapproved="'.$indentapproved.'",fobsubmit="'.$fobsubmit.'",fptapproved="'.$fptapproved.'",planneddate="'.$planned.'",actualdate="'.$actual.'", dateAdded="'.$dateAdded.'"';
$update = updatelisting('subtnaMaster',$namevalue,$where);
}
?>
<script>
parent.setupbox('showpage.crm?module=subtna');
</script>
<?php }
?>
<?php
if($_REQUEST['action']=='approveindent' && $_REQUEST['assignToMaterial']!=''){
$assignToMaterial2 = $_POST['assignToMaterial'];
$assignToMaterial1 = implode(",", $assignToMaterial2);
$assignToMaterial = rtrim($assignToMaterial1,',');
$array =  explode(',', $assignToMaterial);
foreach($array as $itennss) {
  $aa=GetPageRecord('*','techPackDetailMaster','1 and id="'.$itennss.'"');
$facName=mysqli_fetch_array($aa);
   $update = updatelisting('styleSubCategoryMaster','approved="2"','id="'.$facName['stylesubtabid'].'"');
   $update = updatelisting('styleSubCategoryMaster','approved="2"','id="'.$itennss.'"');

}
?>
<script>
parent.reload_page();
</script>
<?php
}
?>
<?php
if(trim($_POST['action'])=='gateentrymaster' && isset($_POST["Submit1"])){

$entrydate=clean($_POST['entrydate']);
$entrytime=clean($_POST['entrytime']);
$gateno=clean($_POST['gateno']);
$registerno=clean($_POST['registerno']);
$potype=clean($_POST['potype']);
$ponumber=clean($_POST['ponumber']);
$supplier=clean($_POST['supplier']);
$billdate=clean($_POST['billdate']);
$billno=clean($_POST['billno']);
$vehiclein=clean($_POST['vehiclein']);
$vehicleout=clean($_POST['vehicleout']);
$drivername=clean($_POST['drivername']);
$drivernumber=clean($_POST['drivernumber']);
$challanno=clean($_POST['challanno']);
$movement=clean($_POST['movement']);
$factoryId=clean($_POST['factoryId']);
$vehicleNo=clean($_POST['vehicleNo']);

$ewaybill=clean($_POST['ewaybill']);
$partybill=clean($_POST['partybill']);
if($_POST['editId']!=''){
$where='id="'.decode($_POST['editId']).'"';
$kk ='ewaybill="'.$ewaybill.'",partybill="'.$partybill.'",entrydate="'.$entrydate.'",entrytime="'.$entrytime.'",gateno="'.$gateno.'",registerno="'.$registerno.'",potype="'.$potype.'",ponumber="'.$ponumber.'",supplier="'.$supplier.'",billdate="'.$billdate.'",billno="'.$billno.'",vehiclein="'.$vehiclein.'",vehicleout="'.$vehicleout.'",drivername="'.$drivername.'",drivernumber="'.$drivernumber.'",challanno="'.$challanno.'",movement="'.$movement.'",status="2",factoryId="'.$factoryId.'",vehicleNo="'.$vehicleNo.'"';
$update = updatelisting('gateentrymaster',$kk,$where);
}
?>
<script>
parent.setupbox('showpage.crm?module=gateentry');
</script>
<?php
}
?>


<?php
if(trim($_POST['action'])=='requisition'){
$requisitiontype=clean($_POST['requisitiontype']);
$department=clean($_POST['department']);
$styleno=clean($_POST['styleno']);
$indentno=clean($_POST['indentno']);
$duedate=clean($_POST['duedate']);
$orderqty=clean($_POST['orderqty']);
$brand=clean($_POST['brand']);
$lot=clean($_POST['lot']);
$requested=clean($_POST['requested']);
$requestedfrom=clean($_POST['requestedfrom']);
$modifyDate = time();
        $where='id="'.decode($_POST['editId']).'"';
    $kk ='requisitiontype="'.$requisitiontype.'",department="'.$department.'",styleId="'.$styleno.'",indentno="'.$indentno.'",duedate="'.$duedate.'",orderqty="'.$orderqty.'",brandId="'.$brand.'",lot="'.$lot.'",requested="'.$requested.'",requestedfrom="'.$requestedfrom.'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",viewlist=1';
    $update=updatelisting('requisitionmaster',$kk,$where);
?>
<script>
parent.setupbox('showpage.crm?module=requisition');
</script>
<?php
}
?>
<?php
if(trim($_REQUEST['action'])=='requisitiondetail'){
$id=trim($_REQUEST['id']);
$marker=trim($_REQUEST['marker']);
$size=trim($_REQUEST['size']);
$amount=trim($_REQUEST['amount']);
$pcs=trim($_REQUEST['packages']);
$reqtype=trim($_REQUEST['reqtype']);
$where='id="'.$id.'"';

    $kk ='quantity="'.$amount.'",requisitiontype="'.$reqtype.'",marker="'.$marker.'",size="'.$size.'",pcs="'.$pcs.'"';

 $update=  updatelisting('loadRequisitionMaster',$kk,$where);
}
?>
<?php
if(trim($_REQUEST['action'])=='gateentrydetail'){
$id=trim($_REQUEST['id']);
$qty=trim($_REQUEST['qty']);
$packages=trim($_REQUEST['packages']);
$amount=trim($_REQUEST['amount']);
$dispatch=trim($_REQUEST['dispatch']);
$netReceived=trim($_REQUEST['netReceived']);
$where='id="'.$id.'"';
$kk ='qty="'.$qty.'",packages="'.$packages.'",amount="'.$amount.'",dispatch="'.$dispatch.'",netReceived="'.$netReceived.'"';
$update=  updatelisting('gateentrymaster',$kk,$where);

}
?>
<?php
if(trim($_POST['action'])=='issuance'){
  $requisition=clean($_POST['requisition']);

  $materialId = $_POST['materialId'];

    $materialId = implode(",", $materialId);

    $colorId = $_POST['colorId'];

    $colorId = implode(",", $colorId);

  $styleno1=clean($_POST['styleno']);

   $rsnew=GetPageRecord('*','queryMaster','1 and styleRefId="'.$styleno1.'"');

    $rslistnew=mysqli_fetch_array($rsnew);

    $styleno= $rslistnew['id'];

    $dateAdded = time();

     $dateCreated = time();

    $issueqty = $_POST['issueqty'];

    $issueqty = implode(",", $issueqty);

    $balance = $_POST['balance'];

    $balance = implode(",", $balance);
      if($_POST['editId']==""){
    $kk = 'requisitionId="'.$requisition.'",styleId="'.$styleno.'",materialId="'.$materialId.'",color="'.$colorId.'",dateAdded="'.$dateAdded.'",dateCreated="'.$dateCreated.'",issueqty="'.$issueqty.'",balance="'.$balance.'",status="1"';
  $add = addlisting('issuanceMaster',$kk);
     $where1='id="'.$_POST['requisition'].'"';
      $where2='parentId="'.$_POST['requisition'].'"';
      $tt='status=1';
      $update=updatelisting('requisitionmaster',$tt,$where1);
      $update=updatelisting('loadRequisitionMaster',$tt,$where2);
         }
         else{
    $where='id="'.decode($_POST['editId']).'"';
     $kk = 'requisitionId="'.$requisition.'",styleId="'.$styleno.'",dateAdded="'.$dateAdded.'",materialId="'.$materialId.'",color="'.$colorId.'",issueqty="'.$issueqty.'",balance="'.$balance.'",status="1"';
     $update=updatelisting('issuanceMaster',$kk,$where);
   }
   ?>
   <script>

    parent.setupbox('showpage.crm?module=issuance');

   </script>
    <?php
  }
  ?>
<?php
if(trim($_REQUEST['action'])=='generateindent'){
$styleId = trim($_REQUEST['styleid']);
$indentNo = 'IND-'.date('dmy').'-'.$styleId;
$where='styleId="'.$styleId.'"';
$query = 'indentNumber="'.$indentNo.'"';
$update=updatelisting('buyerPurchaseOrderMaster',$query,$where);
?>
<script>
parent.$('#generatepo').show();
parent.$('#generatepo').text('Indent Generated Successfully. Indent No: <?php echo $indentNo; ?>');
</script>
<?
}
//=======================================================LOT DATE ENTRY============================================================
if(trim($_POST['action'])=='savelotdata' && $_POST['styleId']!="" && $_POST['lotIdupper']!=""){
$supplierName=clean($_POST['supplierName']);
$supplierNamefinished=clean($_POST['supplierNamefinished']);
$fabricwidthOrdered=clean($_POST['fabricwidthOrdered']);
$fabricconsumption=clean($_POST['fabricconsumption']);
$colorLot=clean($_POST['colorLot']);
$lotRecievedDate=date('Y-m-d',strtotime($_POST['lotRecievedDate']));
$lotfabricorderQty=clean($_POST['lotfabricorderQty']);
$recievedqtyforthislot=clean($_POST['recievedqtyforthislot']);
$totalreceivedtillnow=clean($_POST['totalreceivedtillnow']);
$balancelot=clean($_POST['balancelot']);
$itemcodefabric=clean($_POST['itemcodefabric']);
$pcscutlot=clean($_POST['pcscutlot']);
$fabricusages=clean($_POST['fabricusages']);
$totalinspectedqty=clean($_POST['totalinspectedqty']);
$inspectedDate=date('Y-m-d',strtotime($_POST['inspectedDate']));
$rollsinspected=clean($_POST['rollsinspected']);
$todaysinspection=clean($_POST['todaysinspection']);
$balanceinspection=clean($_POST['balanceinspection']);
$shrifdsfirst=clean($_POST['shrifdsfirst']);
$shrifdssecond=clean($_POST['shrifdssecond']);
$fptlot=clean($_POST['fptlot']);
$insreportmill=clean($_POST['insreportmill']);
$bowlingpermill=clean($_POST['bowlingpermill']);
$acceptedField=clean($_POST['acceptedField']);
$acceptedReason=clean($_POST['acceptedReason']);
$rejectedField=clean($_POST['rejectedField']);
$rejectedReason=clean($_POST['rejectedReason']);
$reprocessingField=clean($_POST['reprocessingField']);
$reprocessingReason=clean($_POST['reprocessingReason']);
$onholdField=clean($_POST['onholdField']);
$onholdReason=clean($_POST['onholdReason']);
$actionDate=date('Y-m-d',strtotime($_POST['actionDate']));
$closureBy=clean($_POST['closureBy']);
$closureDate=date('Y-m-d',strtotime($_POST['closureDate']));


$bowingRField=clean($_POST['bowingRField']);
$bowingAcceptReject=clean($_POST['bowingAcceptReject']);
$pointsRField=clean($_POST['pointsRField']);
$pointsAcceptReject=clean($_POST['pointsAcceptReject']);
$csvRField=clean($_POST['csvRField']);
$csvAcceptReject=clean($_POST['csvAcceptReject']);
$colormatchRField=clean($_POST['colormatchRField']);
$colormatchAcceptReject=clean($_POST['colormatchAcceptReject']);
$shadelotRField=clean($_POST['shadelotRField']);
$shadelotAcceptReject=clean($_POST['shadelotAcceptReject']);
$noofshadelotsRField=clean($_POST['noofshadelotsRField']);
$noofshadelotsAcceptReject=clean($_POST['noofshadelotsAcceptReject']);
$materialid=clean(decode($_POST['materialid']));
$colorid=clean(decode($_POST['colorid']));
$greigeOrderQty=clean($_POST['greigeOrderQty']);

if($_POST['editId']==""){
$kk ='supplierName="'.$supplierName.'",styleId="'.decode($_POST['styleId']).'",lotId="'.decode($_POST['lotIdupper']).'",dateAdded="'.time().'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.time().'",modifyBy="'.$_SESSION['userid'].'",supplierNamefinished="'.$supplierNamefinished.'",fabricwidthOrdered="'.$fabricwidthOrdered.'",fabricconsumption="'.$fabricconsumption.'",colorLot="'.$colorLot.'",lotRecievedDate="'.$lotRecievedDate.'",lotfabricorderQty="'.$lotfabricorderQty.'",recievedqtyforthislot="'.$recievedqtyforthislot.'",totalreceivedtillnow="'.$totalreceivedtillnow.'",balancelot="'.$balancelot.'",itemcodefabric="'.$itemcodefabric.'",pcscutlot="'.$pcscutlot.'",fabricusages="'.$fabricusages.'",totalinspectedqty="'.$totalinspectedqty.'",inspectedDate="'.$inspectedDate.'",rollsinspected="'.$rollsinspected.'",todaysinspection="'.$todaysinspection.'",balanceinspection="'.$balanceinspection.'",shrifdsfirst="'.$shrifdsfirst.'",shrifdssecond="'.$shrifdssecond.'",fptlot="'.$fptlot.'",insreportmill="'.$insreportmill.'",bowlingpermill="'.$bowlingpermill.'",acceptedField="'.$acceptedField.'",acceptedReason="'.$acceptedReason.'",rejectedField="'.$rejectedField.'",rejectedReason="'.$rejectedReason.'",reprocessingField="'.$reprocessingField.'",reprocessingReason="'.$reprocessingReason.'",onholdField="'.$onholdField.'",onholdReason="'.$onholdReason.'",actionDate="'.$actionDate.'",closureBy="'.$closureBy.'",closureDate="'.$closureDate.'",bowingRField="'.$bowingRField.'",bowingAcceptReject="'.$bowingAcceptReject.'",pointsRField="'.$pointsRField.'",pointsAcceptReject="'.$pointsAcceptReject.'",csvRField="'.$csvRField.'",csvAcceptReject="'.$csvAcceptReject.'",colormatchRField="'.$colormatchRField.'",colormatchAcceptReject="'.$colormatchAcceptReject.'",shadelotRField="'.$shadelotRField.'",shadelotAcceptReject="'.$shadelotAcceptReject.'",noofshadelotsRField="'.$noofshadelotsRField.'",noofshadelotsAcceptReject="'.$noofshadelotsAcceptReject.'",materialid="'.$materialid.'",colorid="'.$colorid.'",greigeOrderQty="'.$greigeOrderQty.'"';
$adds = addlisting('lotWiseData',$kk);
}
else{
$where='id="'.decode($_POST['editId']).'"';
$kk ='supplierName="'.$supplierName.'",styleId="'.decode($_POST['styleId']).'",lotId="'.decode($_POST['lotIdupper']).'",modifyDate="'.time().'",modifyBy="'.$_SESSION['userid'].'",supplierNamefinished="'.$supplierNamefinished.'",fabricwidthOrdered="'.$fabricwidthOrdered.'",fabricconsumption="'.$fabricconsumption.'",colorLot="'.$colorLot.'",lotRecievedDate="'.$lotRecievedDate.'",lotfabricorderQty="'.$lotfabricorderQty.'",recievedqtyforthislot="'.$recievedqtyforthislot.'",totalreceivedtillnow="'.$totalreceivedtillnow.'",balancelot="'.$balancelot.'",itemcodefabric="'.$itemcodefabric.'",pcscutlot="'.$pcscutlot.'",fabricusages="'.$fabricusages.'",totalinspectedqty="'.$totalinspectedqty.'",inspectedDate="'.$inspectedDate.'",rollsinspected="'.$rollsinspected.'",todaysinspection="'.$todaysinspection.'",balanceinspection="'.$balanceinspection.'",shrifdsfirst="'.$shrifdsfirst.'",shrifdssecond="'.$shrifdssecond.'",fptlot="'.$fptlot.'",insreportmill="'.$insreportmill.'",bowlingpermill="'.$bowlingpermill.'",acceptedField="'.$acceptedField.'",acceptedReason="'.$acceptedReason.'",rejectedField="'.$rejectedField.'",rejectedReason="'.$rejectedReason.'",reprocessingField="'.$reprocessingField.'",reprocessingReason="'.$reprocessingReason.'",onholdField="'.$onholdField.'",onholdReason="'.$onholdReason.'",actionDate="'.$actionDate.'",closureBy="'.$closureBy.'",closureDate="'.$closureDate.'",bowingRField="'.$bowingRField.'",bowingAcceptReject="'.$bowingAcceptReject.'",pointsRField="'.$pointsRField.'",pointsAcceptReject="'.$pointsAcceptReject.'",csvRField="'.$csvRField.'",csvAcceptReject="'.$csvAcceptReject.'",colormatchRField="'.$colormatchRField.'",colormatchAcceptReject="'.$colormatchAcceptReject.'",shadelotRField="'.$shadelotRField.'",shadelotAcceptReject="'.$shadelotAcceptReject.'",noofshadelotsRField="'.$noofshadelotsRField.'",noofshadelotsAcceptReject="'.$noofshadelotsAcceptReject.'",materialid="'.$materialid.'",colorid="'.$colorid.'",greigeOrderQty="'.$greigeOrderQty.'"';
$update = updatelisting('lotWiseData',$kk,$where);

}
?>
<script>
//parent.setupbox('showpage.crm?module=fabricinspectioninput&view=yes&styleid=<?php echo $_POST['styleId']; ?>&lotId=<?php echo $_POST['lotIdlink']; ?>&grnid=<?php echo $_POST['grnIdlink']; ?>&materialid=<?php echo $_POST['materialid']; ?>&colorid=<?php echo $_POST['colorid']; ?>');
parent.setupbox('showpage.crm?module=fabricinspectioninput');
</script>
<?php
}
?>
<?php
if(trim($_POST['action'])=='innvoice'){
   $eaddress=clean($_POST['eaddress']);
   $maddress=clean($_POST['maddress']);
   $gstno=clean($_POST['gstno']);
   $gstdate=clean($_POST['gstdate']);
   $cargono=clean($_POST['cargono']);
   $cargodate=clean($_POST['cargodate']);
   $ereference=clean($_POST['ereference']);
   $buyerpo=clean($_POST['buyerpo']);
   $styleId=clean($_POST['styleId']);
   $consignee=clean($_POST['consignee']);
   $exaddress=clean($_POST['exaddress']);
   $oreference=clean($_POST['oreference']);
   $precarriage=clean($_POST['precarriage']);
   $shipmode=clean($_POST['shipmode']);
   $flightno=clean($_POST['flightno']);
   $portland=clean($_POST['portland']);
   $portdischarge=clean($_POST['portdischarge']);
   $fdestination=clean($_POST['fdestination']);
   $countrygoods=clean($_POST['countrygoods']);
   $countryfinal=clean($_POST['countryfinal']);
   $pterms=clean($_POST['pterms']);
   $reversecharge=clean($_POST['reversecharge']);
   $adcode=clean($_POST['adcode']);
   $sclist=clean($_POST['sclist']);
   $hsnno=clean($_POST['hsnno']);
   $dclist=clean($_POST['dclist']);
   $schemecode=clean($_POST['schemecode']);
   $sqc=clean($_POST['sqc']);
   $dbk=clean($_POST['dbk']);
   $fta=clean($_POST['fta']);
   $gstcess=clean($_POST['gstcess']);
   $usedcode=clean($_POST['usedcode']);
   $rate=clean($_POST['rate']);
   $igst=clean($_POST['igst']);
   $inv=clean($_POST['inv']);
   $igstamount=clean($_POST['igstamount']);
   $ttlamount=clean($_POST['ttlamount']);
   $exrate=clean($_POST['exrate']);
   $ctns=clean($_POST['ctns']);
   $invoiceno=clean($_POST['invoiceno']);
   $gr=clean($_POST['gr']);

   $totalamount=clean($_POST['totalamount']);
   $netweight=clean($_POST['netweight']);
   $nnetweight=clean($_POST['nnetweight']);
   $cbm=clean($_POST['cbm']);
   $amount = $_POST['amount'];
  $amount = implode(",", $amount);
  if($_POST['editId']==''){
$kk = 'packingId="'.decode($_POST['packingId']).'",eaddress="'.$eaddress.'",invoiceNumber="'.$invoiceno.'",maddress="'.$maddress.'",gstno="'.$gstno.'",gstdate="'.$gstdate.'",cargono="'.$cargono.'",cargodate="'.$cargodate.'",ereference="'.$ereference.'",buyerpo="'.$buyerpo.'",styleId="'.$styleId.'",consignee="'.$consignee.'",exaddress="'.$exaddress.'",oreference="'.$oreference.'",precarriage="'.$precarriage.'",shipmode="'.$shipmode.'",flightno="'.$flightno.'",portland="'.$portland.'",portdischarge="'.$portdischarge.'",fdestination="'.$fdestination.'",countrygoods="'.$countrygoods.'",countryfinal="'.$countryfinal.'",pterms="'.$pterms.'",reversecharge="'.$reversecharge.'",adcode="'.$adcode.'",sclist="'.$sclist.'",hsnno="'.$hsnno.'",dclist="'.$dclist.'",schemecode="'.$schemecode.'",sqc="'.$sqc.'",dbk="'.$dbk.'",fta="'.$fta.'",gstcess="'.$gstcess.'",usedcode="'.$usedcode.'",rate="'.$rate.'",igst="'.$igst.'",inv="'.$inv.'",igstamount="'.$igstamount.'",ttlamount="'.$ttlamount.'",exrate="'.$exrate.'",ctns="'.$ctns.'",gr="'.$gr.'",netweight="'.$netweight.'",nnetweight="'.$nnetweight.'",cbm="'.$cbm.'",amount="'.$amount.'",dateAdded="'.time().'",totalamount="'.$totalamount.'",status="1"';
addlisting('innvoiceMaster',$kk);
$where1='id="'.decode($_POST['packingId']).'"';

       $where2='parentId="'.decode($_POST['packingId']).'"';
  $pp = 'status=2';
  $rr = 'status=2';
       $update=updatelisting('packinglistMaster',$rr,$where1);
        $update=updatelisting('loadpackinglistmaster',$pp,$where2);
}
else{
   $where='id="'.decode($_POST['editId']).'"';
$kk = 'packingId="'.decode($_POST['packingId']).'",eaddress="'.$eaddress.'",invoiceNumber="'.$invoiceno.'",maddress="'.$maddress.'",gstno="'.$gstno.'",gstdate="'.$gstdate.'",cargono="'.$cargono.'",cargodate="'.$cargodate.'",ereference="'.$ereference.'",buyerpo="'.$buyerpo.'",styleId="'.$styleId.'",consignee="'.$consignee.'",exaddress="'.$exaddress.'",oreference="'.$oreference.'",precarriage="'.$precarriage.'",shipmode="'.$shipmode.'",flightno="'.$flightno.'",portland="'.$portland.'",portdischarge="'.$portdischarge.'",fdestination="'.$fdestination.'",countrygoods="'.$countrygoods.'",countryfinal="'.$countryfinal.'",pterms="'.$pterms.'",reversecharge="'.$reversecharge.'",adcode="'.$adcode.'",sclist="'.$sclist.'",hsnno="'.$hsnno.'",dclist="'.$dclist.'",schemecode="'.$schemecode.'",sqc="'.$sqc.'",dbk="'.$dbk.'",fta="'.$fta.'",gstcess="'.$gstcess.'",usedcode="'.$usedcode.'",rate="'.$rate.'",igst="'.$igst.'",inv="'.$inv.'",igstamount="'.$igstamount.'",ttlamount="'.$ttlamount.'",exrate="'.$exrate.'",ctns="'.$ctns.'",gr="'.$gr.'",netweight="'.$netweight.'",nnetweight="'.$nnetweight.'",cbm="'.$cbm.'",amount="'.$amount.'",totalamount="'.$totalamount.'",status="1"';
  $update=updatelisting('innvoiceMaster',$kk,$where);
  $where1='id="'.decode($_POST['packingId']).'"';

       $where2='parentId="'.decode($_POST['packingId']).'"';
  $pp = 'status=2';
  $rr = 'status=2';
       $update=updatelisting('packinglistMaster',$rr,$where1);
        $update=updatelisting('loadpackinglistmaster',$pp,$where2);
}
      ?>
<script>
       parent.setupbox('showpage.crm?module=invoice');
     </script>
<?php  } ?>
<?php
    if(trim($_REQUEST['action']) == 'loadinvoice'){
     $id=trim($_REQUEST['id']);
     $style=trim($_REQUEST['style']);
     $desc=trim($_REQUEST['desc']);
     $color = trim($_REQUEST['color']);
     $amount=trim($_REQUEST['amount']);
      $packages=trim($_REQUEST['packages']);
       $quantity=trim($_REQUEST['quantity']);
        $mark=trim($_REQUEST['mark']);
        $rate=trim($_REQUEST['rate']);
        $namevalue ='style="'.$style.'",mark="'.$mark.'",description="'.$desc.'",color="'.$color.'",rate="'.$rate.'",quantity="'.$quantity.'",amount="'.$amount.'",packages="'.$packages.'"';  $where='id="'.$id.'"';
        $update = updatelisting('invoiceStyleMaster',$namevalue,$where);
         }

if(trim($_POST['action'])=='addinspectioninput' && $_POST['editId']!=""){
$styleId=clean($_POST['styleId']);
$inspectionType=clean($_POST['inspectionType']);
$placementQty=clean($_POST['placementQty']);
$dateField=date('Y-m-d',strtotime($_POST['dateField']));
$colorId=clean($_POST['colorId']);
$receivedfEmbroidery=clean($_POST['receivedfEmbroidery']);
$factoryId=clean($_POST['factoryId']);
$lineId=clean($_POST['lineId']);
$cutQty=clean($_POST['cutQty']);
$checkedBy=clean($_POST['checkedBy']);
$status=clean($_POST['status']);
$onMachine=clean($_POST['onMachine']);
$offMachine=clean($_POST['offMachine']);
$infinsihing=clean($_POST['infinsihing']);
$packed=clean($_POST['packed']);
$piecesavaiforinspection=clean($_POST['piecesavaiforinspection']);
$piecesinspected=clean($_POST['piecesinspected']);
$acceptanceLevel=clean($_POST['acceptanceLevel']);
$piecesRejected=clean($_POST['piecesRejected']);
$totalMajors=clean($_POST['totalMajors']);
$defectivePercentages=clean($_POST['defectivePercentages']);
$inspectionResults=clean($_POST['inspectionResults']);
$noofmachines=clean($_POST['noofmachines']);
$running=clean($_POST['running']);
$detailedComment=clean($_POST['detailedComment']);
$actionsproductions=clean($_POST['actionsproductions']);

$modifyDate=date('Y-m-d h:i:s A');
$where='id="'.decode($_POST['editId']).'"';
$kk ='styleId="'.$styleId.'",modifyBy="'.$_SESSION['userid'].'",modifyDate="'.$modifyDate.'",inspectionType="'.$inspectionType.'",placementQty="'.$placementQty.'",dateField="'.$dateField.'",colorId="'.$colorId.'",receivedfEmbroidery="'.$receivedfEmbroidery.'",factoryId="'.$factoryId.'",lineId="'.$lineId.'",cutQty="'.$cutQty.'",checkedBy="'.$checkedBy.'",status="'.$status.'",onMachine="'.$onMachine.'",offMachine="'.$offMachine.'",infinsihing="'.$infinsihing.'",packed="'.$packed.'",piecesavaiforinspection="'.$piecesavaiforinspection.'",piecesinspected="'.$piecesinspected.'",acceptanceLevel="'.$acceptanceLevel.'",piecesRejected="'.$piecesRejected.'",totalMajors="'.$totalMajors.'",defectivePercentages="'.$defectivePercentages.'",inspectionResults="'.$inspectionResults.'",noofmachines="'.$noofmachines.'",running="'.$running.'",detailedComment="'.$detailedComment.'",actionsproductions="'.$actionsproductions.'"';

$update = updatelisting('inspectioninput',$kk,$where);
//////////////////////////////////////////////////////////////////////////////////////////////
$deTypeDataq=GetPageRecord('id,name','inspectionDefectType','1 order by id');
while($deTypeData=mysqli_fetch_array($deTypeDataq)){
$defectDataq=GetPageRecord('id,name','inspectionDefectMaster','1 and defectType="'.$deTypeData['id'].'"');
while($defectData=mysqli_fetch_array($defectDataq)){
$whereCheckref='1 and defectiveType="'.$deTypeData['id'].'" and defectiveId="'.$defectData['id'].'" and inspectionId="'.decode($_POST['editId']).'"';
$checkCoderef = checkduplicate('inspectionsubinput',$whereCheckref);
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
$defectIdField=$_POST['defectIdField'.$deTypeData['id'].$defectData['id']];
$defectIdFieldMajor=$_POST['defectIdFieldMajor'.$deTypeData['id'].$defectData['id']];
$defectIdFieldMinor=$_POST['defectIdFieldMinor'.$deTypeData['id'].$defectData['id']];
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if($checkCoderef=="no"){
$inspectionsubinputfield ='defectIdField="'.$defectIdField.'",defectIdFieldMajor="'.$defectIdFieldMajor.'",defectIdFieldMinor="'.$defectIdFieldMinor.'",defectiveType="'.$deTypeData['id'].'",defectiveId="'.$defectData['id'].'",inspectionId="'.decode($_POST['editId']).'",dateAdded="'.time().'",addedBy="'.$_SESSION['userid'].'",modifyDate="'.time().'",modifyBy="'.$_SESSION['userid'].'"';
$adds = addlisting('inspectionsubinput',$inspectionsubinputfield);

} else{
$whereinspectionsubinputfield='defectiveType="'.$deTypeData['id'].'" and defectiveId="'.$defectData['id'].'" and inspectionId="'.decode($_POST['editId']).'"';
$inspectionsubinputfield ='defectIdField="'.$defectIdField.'",defectIdFieldMajor="'.$defectIdFieldMajor.'",defectIdFieldMinor="'.$defectIdFieldMinor.'",defectiveType="'.$deTypeData['id'].'",defectiveId="'.$defectData['id'].'",inspectionId="'.decode($_POST['editId']).'",modifyDate="'.time().'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('inspectionsubinput',$inspectionsubinputfield,$whereinspectionsubinputfield);

}

} }

?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>');
</script>
<?php }
 if(trim($_POST['action'])=='addPoBreakup'){
$destination=clean($_POST['destination']);
$color=clean($_POST['color']);
$ptype=clean($_POST['ptype']);
$size=clean($_POST['size']);
$quantity=clean($_POST['quantity']);
$editId=clean($_POST['editId']);
$styleId=clean($_POST['styleId']);
$parentId=clean($_POST['parentId']);

if($_POST['editId']==''){
$namevalue ='destination="'.$destination.'",color="'.$color.'",ptype="'.$ptype.'",size="'.$size.'",quantity="'.$quantity.'",styleId="'.$styleId.'",parentId="'.$parentId.'"';
addlisting('poSizeBreakupMaster',$namevalue);

}
else{
$where='id="'.$_POST['editId'].'"';
$namevalue ='destination="'.$destination.'",color="'.$color.'",ptype="'.$ptype.'",size="'.$size.'",quantity="'.$quantity.'",styleId="'.$styleId.'",parentId="'.$parentId.'"';
updatelisting('poSizeBreakupMaster',$namevalue,$where);
}
?>
<script>
parent.setupbox('showpage.crm?module=poManage&add=yes&styleid=<?php echo encode($styleId); ?>');
</script>
<?php }
 ?>
 <?php
  if(trim($_POST['action'])=='addDcpoBreakup'){
$destination=clean($_POST['destination']);
$color=clean($_POST['color']);
$ptype=clean($_POST['ptype']);
$size=clean($_POST['size']);
$quantity=clean($_POST['quantity']);
$editId=clean($_POST['editId']);
$styleId=clean($_POST['styleId']);
$parentId=clean($_POST['parentId']);

if($_POST['editId']==''){
$namevalue ='destination="'.$destination.'",color="'.$color.'",ptype="'.$ptype.'",size="'.$size.'",quantity="'.$quantity.'",styleId="'.$styleId.'",parentId="'.$parentId.'"';
addlisting('dcpoSizeBreakupMaster',$namevalue);

}
else{
$where='id="'.$_POST['editId'].'"';
$namevalue ='destination="'.$destination.'",color="'.$color.'",ptype="'.$ptype.'",size="'.$size.'",quantity="'.$quantity.'",styleId="'.$styleId.'",parentId="'.$parentId.'"';
updatelisting('dcpoSizeBreakupMaster',$namevalue,$where);
}
?>
<script>
parent.setupbox('showpage.crm?module=dcpoManage');
</script>
<?php }
 ?>
 <?php
if(trim($_POST['action'])=='packinglistaddnew'){
$purchaseNo=clean($_POST['purchaseNo']);
$styleno=clean($_POST['styleId']);
$consignee=clean($_POST['consignee']);
$shipmentfrom=clean($_POST['shipmentfrom']);
$shipmentto=clean($_POST['shipmentto']);
$paymentterm=clean($_POST['paymentterm']);
$poqty=clean($_POST['poqty']);

$port=clean($_POST['port']);
$orgexfactory=clean($_POST['orgexfactory']);
$actualexfactory=clean($_POST['actualexfactory']);
$orgshipmode=clean($_POST['orgshipmode']);
$actualshipmode=clean($_POST['actualshipmode']);

$bill=clean($_POST['bill']);
$uom=clean($_POST['uom']);
$dateAdded = time();
if($_POST['editpack'] == ""){
$where='id="'.decode($_POST['editId']).'"';
$kk = 'purchaseNo="'.$purchaseNo.'",styleId="'.$styleno.'",poqty="'.$poqty.'",toport="'.$port.'",orignalexfactory="'.$orgexfactory.'",actualexfactory="'.$actualexfactory.'",orignalshipmode="'.$orgshipmode.'",actualshipmode="'.$actualshipmode.'",consignee="'.$consignee.'",shipmentfrom="'.$shipmentfrom.'",shipmentto="'.$shipmentto.'",paymentterm="'.$paymentterm.'",bill="'.$bill.'",uom="'.$uom.'",dateAdded="'.$dateAdded.'"';
    $update=updatelisting('packinglistMaster',$kk,$where);
}
else{
$where='id="'.decode($_POST['editId']).'"';
$kk = 'purchaseNo="'.$purchaseNo.'",styleId="'.$styleno.'",poqty="'.$poqty.'",toport="'.$port.'",orignalexfactory="'.$orgexfactory.'",actualexfactory="'.$actualexfactory.'",orignalshipmode="'.$orgshipmode.'",actualshipmode="'.$actualshipmode.'",consignee="'.$consignee.'",shipmentfrom="'.$shipmentfrom.'",shipmentto="'.$shipmentto.'",paymentterm="'.$paymentterm.'",bill="'.$bill.'",uom="'.$uom.'",dateAdded="'.$dateAdded.'",status="2"';
    $update=updatelisting('packinglistMaster',$kk,$where);
}
?>
<script>
parent.setupbox('showpage.crm?module=packinglist');
</script>
<?php
}
?>
<?php
if(trim($_POST['action'])=='supplierdebitnote'){
$supplierId=clean($_POST['supplierId']);
$styleno=clean($_POST['styleId']);
$scode=clean($_POST['scode']);
$gstn=clean($_POST['gstn']);
$orderno=clean($_POST['orderno']);
$poNumber=clean($_POST['poNumber']);
$billdate=clean($_POST['billdate']);
$billno=clean($_POST['billno']);
$dateAdded = time();
$where='id="'.decode($_POST['editId']).'"';
$kk = 'supplierId="'.$supplierId.'",statecode="'.$scode.'",gstn="'.$gstn.'",styleId="'.$styleno.'",orderno="'.$orderno.'",poNumber="'.$poNumber.'",billNumber="'.$billno.'",billdate="'.$billdate.'",dateAdded="'.$dateAdded.'",status="1"';
    $update=updatelisting('debitNoteMaster',$kk,$where);
?>
<script>
parent.setupbox('showpage.crm?module=supdebitnote');
</script>
<?php
}
?>
<?php
if($_REQUEST['action']=="savesupplierdebitnote" && $_REQUEST['id']!=''){

$itemcode = clean($_REQUEST['itemcode']);
$hsncode = clean($_REQUEST['hsncode']);
$reason = clean($_REQUEST['reason']);
$uom = clean($_REQUEST['uom']);
$qty = clean($_REQUEST['qty']);
$rate = clean($_REQUEST['rate']);
$amnt = clean($_REQUEST['amnt']);
$billno = clean($_REQUEST['billno']);
$discamt = clean($_REQUEST['discamt']);
$taxvalue = clean($_REQUEST['taxvalue']);
$cgstamt = clean($_REQUEST['cgstamt']);
$cgstrate = clean($_REQUEST['cgstrate']);
$sgstamt = clean($_REQUEST['sgstamt']);
$sgstrate = clean($_REQUEST['sgstrate']);
$igstrate = clean($_REQUEST['igstrate']);
$igstamt = clean($_REQUEST['igstamt']);
$utgstamt = clean($_REQUEST['utgstamt']);
$utgstrate = clean($_REQUEST['utgstrate']);
$where='id="'.decode($_REQUEST['id']).'"';
$namevalue ='itemcode="'.$itemcode.'",hsncode="'.$hsncode.'",reason="'.$reason.'",uom="'.$uom.'",qty="'.$qty.'",rate="'.$rate.'",billno="'.$billno.'",amnt="'.$amnt.'",discamt="'.$discamt.'",taxvalue="'.$taxvalue.'",cgstrate="'.$cgstrate.'",cgstamt="'.$cgstamt.'",sgstrate="'.$sgstrate.'",sgstamt="'.$sgstamt.'",igstamt="'.$igstamt.'",igstrate="'.$igstrate.'",utgstrate="'.$utgstrate.'",utgstamt="'.$utgstamt.'"';

$update = updatelisting('loadDebitnoteMaster',$namevalue,$where);
}

if(trim($_POST['action'])=='amendaction'){
$styleId=clean($_POST['styleId']);
$amendType = trim($_POST['amendType']);
$requestedDate = date('Y-m-d');
$rand = rand(10,100);
$amendNumber = "AMD-".date('dmy').'-'.$rand;
$reason = trim($_POST['reason']);
$stylesubtabid=clean($_POST['stylesubtabid']);
$costsheetVersionId=clean($_POST['costsheetVersionId']);
$materialType=clean($_POST['materialType']);
$bomAvg = trim($_POST['bomAvg']);
$bomWidth = trim($_POST['bomWidth']);
$bomUnit = trim($_POST['bomUnit']);
$wastagePersent = trim($_POST['wastagePersent']);
$avgIncWastage = trim($_POST['avgIncWastage']);
$matCurrency = trim($_POST['matCurrency']);
$matPrice = trim($_POST['matPrice']);
$bomAvgOld = trim($_POST['bomAvgOld']);
$bomWidthOld = trim($_POST['bomWidthOld']);
$bomUnitOld = trim($_POST['bomUnitOld']);
$wastagePersentOld = trim($_POST['wastagePersentOld']);
$avgIncWastageOld = trim($_POST['avgIncWastageOld']);
$matCurrencyOld = trim($_POST['matCurrencyOld']);
$matPriceOld = trim($_POST['matPriceOld']);
$namevalue = 'styleId="'.$styleId.'",amendType="'.$amendType.'",requestedDate="'.$requestedDate.'",amendNumber="'.$amendNumber.'"';
$lasttid=addlistinggetlastid('amendmentMaster',$namevalue);
if($lasttid!=''){
$namevalue2 = 'amendmentId="'.$lasttid.'",styleId="'.$styleId.'",stylesubtabid="'.$stylesubtabid.'",costsheetVersionId="'.$costsheetVersionId.'",materialType="'.$materialType.'",reason="'.$reason.'",bomAvg="'.$bomAvg.'",bomWidth="'.$bomWidth.'",bomUnit="'.$bomUnit.'",wastagePersent="'.$wastagePersent.'",matPrice="'.$matPrice.'",bomAvgOld="'.$bomAvgOld.'",bomWidthOld="'.$bomWidthOld.'",bomUnitOld="'.$bomUnitOld.'",wastagePersentOld="'.$wastagePersentOld.'",matPriceOld="'.$matPriceOld.'"';
$lasttid2=addlistinggetlastid('bomAmendment',$namevalue2);
}
?>
<script>
parent.setupbox('showpage.crm?module=amendment&&view=yes&id=<?php echo encode($lasttid); ?>&styleid=<?php echo encode($styleId); ?>');
</script>
<?php
}
if(trim($_POST['action'])=='salesorderamedaction'){
$styleId=clean($_POST['styleId']);
$amendType = trim($_POST['amendType']);
$requestedDate = date('Y-m-d');
$rand = rand(10,100);
$amendNumber = "AMD-".date('dmy').'-'.$rand;
$reason = trim($_POST['reason']);
$finishOld = trim($_POST['finishOld']);
$colorOld = trim($_POST['colorOld']);
$sizeOld = trim($_POST['sizeOld']);
$gdQtyOld = trim($_POST['gdQtyOld']);
$sizeRowId = trim($_POST['sizeRowId']);
$finish = trim($_POST['finish']);
$color = trim($_POST['color']);
$size = trim($_POST['size']);
$gdQty = trim($_POST['gdQty']);
$gdQty = trim($_POST['gdQty']);
$namevalue = 'styleId="'.$styleId.'",amendType="'.$amendType.'",requestedDate="'.$requestedDate.'",amendNumber="'.$amendNumber.'",sectionType="saleorder"';
$lasttid=addlistinggetlastid('amendmentMaster',$namevalue);
if($lasttid!=''){
$namevalue2 = 'amendmentId="'.$lasttid.'",styleId="'.$styleId.'",finish="'.$finish.'",color="'.$color.'",size="'.$size.'",gdQty="'.$gdQty.'",finishOld="'.$finishOld.'",colorOld="'.$colorOld.'",sizeOld="'.$sizeOld.'",gdQtyOld="'.$gdQtyOld.'",reason="'.$reason.'",sizeRowId="'.$sizeRowId.'"';
$lasttid2=addlistinggetlastid('bomAmendment',$namevalue2);
}
?>
<script>
parent.setupbox('showpage.crm?module=amendment&&view=yes&id=<?php echo encode($lasttid); ?>&styleid=<?php echo encode($styleId); ?>');

</script>
<?php
}

if(trim($_POST['action'])=='viewamendaction'){
$styleId=decode($_POST['styleId']);
$id=decode($_POST['id']);

$newFobPrice= trim($_POST['newFobPrice']);
$upCharge= trim($_POST['upCharge']);
$liablitySattleDate= date('Y-m-d',strtotime($_POST['liablitySattleDate']));
$liablityAllocation= trim($_POST['liablityAllocation']);
$liablityOwner= trim($_POST['liablityOwner']);
$liablityValue= trim($_POST['liablityValue']);
$where='amendmentId="'.$id.'"';
$namevalue ='newFobPrice="'.$newFobPrice.'",upCharge="'.$upCharge.'",liablitySattleDate="'.$liablitySattleDate.'",liablityAllocation="'.$liablityAllocation.'",liablityOwner="'.$liablityOwner.'",liablityValue="'.$liablityValue.'"';

$update = updatelisting('bomAmendment',$namevalue,$where);

?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&view=yes&id=<?php echo encode($id); ?>&styleid=<?php echo encode($styleId); ?>');
</script>
<?php
}
?>
<?php
 if(trim($_POST['action'])=='uploadatechpackpattern'){
$stage=clean($_POST['stage']);
$remark=clean($_POST['remark']);
$rdate=date('Y-m-d');
$sectionType=clean($_POST['module']);
$styleId=decode($_POST['styleId']);

if($_FILES['poattach']['name']!=''){
$file_name=$_FILES['poattach']['name'];
$file_name=time().'-'.$file_name;
copy($_FILES['poattach']['tmp_name'],"images/".$file_name);
}
$namevalue ='styleId="'.$styleId.'",stage="'.$stage.'",remark="'.$remark.'",uploadDate="'.$rdate.'",attachtp="'.$file_name.'",sectionType="'.$sectionType.'"';
addlisting('techpackPatternMarkerUpload',$namevalue);

if($sectionType=="techpack"){
$where='id="'.$styleId.'"';
$namevalueupdate ='attachmentNewMail="'.$file_name.'"';
$update = updatelisting('queryMaster',$namevalueupdate,$where);
}

if($sectionType=="pattern"){
$patternDescription=clean($remark);

$patternAddDate=time();
$patternAddedBy=$_SESSION['userid'];
$where='id="'.$styleId.'"';
$namevalue ='patternDescription="'.$patternDescription.'",patternAttachment="'.$file_name.'",patternAddDate="'.$patternAddDate.'",patternAddedBy="'.$patternAddedBy.'"';
$update = updatelisting(_QUERY_MASTER_,$namevalue,$where);
//add note of pattern uploaded
$styleassignment = 'styleId="'.$styleId.'",statusId=4,notes="'.$patternDescription.'",assignTo="'.$patternAddedBy.'",dateAdded="'.time().'"';
addlisting('styleAssignmentMaster',$styleassignment);

}


?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $sectionType; ?>');
</script>
<?php }

if(trim($_POST['action'])=='editbillmovement' && trim($_POST['editId'])!='' && trim($_POST['grnNo'])!=''){
$editId= decode($_POST['editId']);
$grnNo = trim($_POST['grnNo']);

$grnDate = date('Y-m-d',strtotime($_POST['grnDate']));
$challanNo = trim($_POST['challanNo']);
$eWayBill = trim($_POST['eWayBill']);
$docNo = trim($_POST['docNo']);
$eWayBillDate = date('Y-m-d',strtotime($_POST['eWayBillDate']));
$supplierId = trim($_POST['supplierId']);
$supplierGst = trim($_POST['supplierGst']);
$departmentId = trim($_POST['departmentId']);
$costCenter = trim($_POST['costCenter']);
$paymentNo = trim($_POST['paymentNo']);
$gateEntryNo = trim($_POST['gateEntryNo']);
$attachment = trim($_POST['attachment']);
$perfInvoice = trim($_POST['perfInvoice']);

$where = 'id="'.$editId.'"';
$namevalue ='grnDate="'.$grnDate.'",challanNo="'.$challanNo.'",eWayBill="'.$eWayBill.'",docNo="'.$docNo.'",eWayBillDate="'.$eWayBillDate.'",supplierId="'.$supplierId.'",supplierGst="'.$supplierGst.'",departmentId="'.$departmentId.'",costCenter="'.$costCenter.'",paymentNo="'.$paymentNo.'",gateEntryNo="'.$gateEntryNo.'",attachment="'.$attachment.'",perfInvoice="'.$perfInvoice.'"';
$update = updatelisting('billMovementMaster',$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>');
</script>
<?php
}
?>



<?php
if(trim($_POST['action'])=='buyerpoconfirmationmaster' && isset($_POST["Submit1"])){

    $ship=1;


    $countv=$_POST['resc'];

    while($ship<=$countv){
        $revtwo=$_POST['revisedstart'.$countv];
$revone=$_POST['revisedend'.$countv];
if($revtwo!='' && $revone!=''){
        $kk ='revisedexfactoryend="'.$revtwo.'",revisedshipmode="'.$revone.'"';
$adds = addlisting('buyerpoConfirmationMaster',$kk);

        $ship++;
    }

    }


?>
<script>
parent.setupbox('showpage.crm?module=poconfirmation');
</script>



<?php
}

if(trim($_POST['action'])=='greigerequisition' && trim($_POST['module'])!=''){

$requisitionNo=clean($_POST['requisitionNo']);
$styleNo=clean($_POST['styleNo']);
$requisitionDate=date('Y-m-d',strtotime($_POST['requisitionDate']));
$brandId=$_POST['brandId'];
$brandId = implode(",",$brandId);
$seasonId=clean($_POST['seasonId']);
$addedBy=clean($_POST['addedBy']);
$status=clean($_POST['status']);
$currencyId=clean($_POST['currencyId']);
$indentStatus=0;
$indentNumber='';

if($status==1){
$indentStatus=1;
$indentNumber = 'G-IND-'.date('dmy').decode($_POST['editId']);
}

$namevalue ='requisitionNo="'.$requisitionNo.'",requisitionDate="'.$requisitionDate.'",brandId="'.$brandId.'",addedBy="'.$addedBy.'",status="'.$status.'",seasonId="'.$seasonId.'",indentStatus="'.$indentStatus.'",indentNumber="'.$indentNumber.'",styleNo="'.$styleNo.'",tabstatus="1",currencyId="'.$currencyId.'"';

if($_POST['editId']!=''){
$where='id="'.decode($_POST['editId']).'"';
$update = updatelisting('greigeRequisition',$namevalue,$where);
}else{
$lasttid=addlistinggetlastid('greigeRequisition',$namevalue);
}


?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>
<?php }












if(trim($_POST['action'])=='addflow'){

$flowquantity=clean($_POST['flowquantity']);
$planneddate=clean($_POST['planneddate']);
$actualdate=clean($_POST['actualdate']);

$actualquantity=clean($_POST['actualquantity']);



$colorid=clean($_POST['colorid']);

$styleid=clean($_POST['styleid']);

$fabricid=clean($_POST['fabricid']);

if($_POST['editid']==''){
$namevalue ='flowquantity="'.$flowquantity.'",planneddate="'.$planneddate.'",actualdate="'.$actualdate.'",actualquantity="'.$actualquantity.'",styleId="'.$styleid.'",fabricId="'.$fabricid.'",colorId="'.$colorid.'"';


$lasttid=addlisting('subTnaFlowMaster',$namevalue);

}
else{
$where='id="'.$_POST['editid'].'"';
$namevalue ='flowquantity="'.$flowquantity.'",planneddate="'.$planneddate.'",actualdate="'.$actualdate.'",actualquantity="'.$actualquantity.'",styleId="'.$styleid.'",fabricId="'.$fabricid.'",colorId="'.$colorid.'"';


$lasttid=updatelisting('subTnaFlowMaster',$namevalue,$where);
}

// $namevalue ='flowquantity="'.$flowquantity.'",planneddate="'.$planneddate.'",actualdate="'.$actualdate.'",styleId="'.$styleid.'",fabricId="'.$fabricid.'",colorId="'.$colorid.'"';


// $lasttid=addlisting('subTnaFlowMaster',$namevalue);



?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>');
</script>
<?php }

if($_REQUEST['action']=='greighindentSendpo' && $_POST['sellingValue']!=0 && $_POST['sellingValue']!=0){
$materialId = $_POST['materialId'];
$supplierId = $_POST['supplierId'];
$materialQty = $_POST['materialQty'];
$orderQty = $_POST['orderQty'];
$sellingRate = $_POST['sellingRate'];
$sellingValue = $_POST['sellingValue'];
$pendingQty = $_POST['pendingQty'];
$bomWidth = $_POST['bomWidth'];
$uom = $_POST['uom'];
$rate = $_POST['rate'];
$requisitionNo = $_POST['requisitionNo'];
$poTypeId = $_POST['poTypeId'];

$aaa ='materialId="'.$materialId.'",supplierId="'.$supplierId.'",materialQty="'.$materialQty.'",orderQty="'.$orderQty.'",sellingRate="'.$sellingRate.'",bomWidth="'.$bomWidth.'",sellingValue="'.$sellingValue.'",pendingQty="'.$pendingQty.'",uom="'.$uom.'",rate="'.$rate.'",requisitionNo="'.$requisitionNo.'",status=1,dateAdded="'.time().'",createdDate="'.date('Y-m-d').'",materialTypeId=1,poTypeId="'.$poTypeId.'"';
$adds = addlisting('indentCreationMaster',$aaa);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&add=yes&id=<?php echo $_POST['pageeditid']; ?>');
</script>
<?php
}

if(trim($_POST['action'])=='greigeallocation' && trim($_POST['module'])!=''){

$allocationNo=clean($_POST['allocationNo']);
$greigeStyleNo=clean($_POST['greigeStyleNo']);
$allocationDate=date('Y-m-d',strtotime($_POST['allocationDate']));
$brandId=$_POST['brandId'];
//$brandId = implode(",",$brandId);
$indentNumber=clean($_POST['indentNumber']);
$styleId=clean($_POST['styleId']);
$seasonId=clean($_POST['seasonId']);
$seasonUsedId=clean($_POST['seasonUsedId']);
$addedBy=clean($_POST['addedBy']);
$status=clean($_POST['status']);

$namevalue ='allocationNo="'.$allocationNo.'",greigeStyleNo="'.$greigeStyleNo.'",allocationDate="'.$allocationDate.'",brandId="'.$brandId.'",indentNumber="'.$indentNumber.'",styleId="'.$styleId.'",seasonId="'.$seasonId.'",seasonUsedId="'.$seasonUsedId.'",addedBy="'.$addedBy.'",status="'.$status.'",tabstatus="1"';

if($_POST['editId']!=''){
$where='id="'.decode($_POST['editId']).'"';
$update = updatelisting('greigeAllocation',$namevalue,$where);
}else{
$lasttid=addlistinggetlastid('greigeAllocation',$namevalue);
}


?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>
<?php }

?>











<?php
if(trim($_POST['action'])=='externalchallan'){
$supplier=clean($_POST['supplier']);
$address=clean($_POST['address']);
$phone=clean($_POST['phone']);
$gstn=clean($_POST['gstn']);
$state=clean($_POST['state']);
$stylenum=clean($_POST['stylenum']);
$indentnum=clean($_POST['indentnum']);
$process=clean($_POST['process']);
$challantype=clean($_POST['challantype']);
$personname=clean($_POST['personname']);
$dispatch=clean($_POST['dispatch']);
$date=date('Y-m-d');
$vehiclenum=clean($_POST['vehiclenum']);
$gatenum=clean($_POST['gatenum']);
$ewaynum=clean($_POST['ewaynum']);
$pono=clean($_POST['pono']);



$factoryname=clean($_POST['factoryname']);
$factoryaddress=clean($_POST['factoryaddress']);
$factoryphone=clean($_POST['factoryphone']);
$factorygstn=clean($_POST['factorygstn']);
$factorystate=clean($_POST['factorystate']);

// if($_POST['editId']==''){
// $kk ='supplier="'.$supplier.'",address="'.$address.'",phone="'.$phone.'",gstn="'.$gstn.'",state="'.$state.'",stylenum="'.$stylenum.'",indentnum="'.$indentnum.'",process="'.$process.'",challantype="'.$challantype.'",personname="'.$personname.'",dispatch="'.$dispatch.'",date="'.$date.'",vehiclenum="'.$vehiclenum.'",
// gatenum="'.$gatenum.'",ewaynum="'.$ewaynum.'",factoryname="'.$factoryname.'",factoryaddress="'.$factoryaddress.'",factoryphone="'.$factoryphone.'",factorygstn="'.$factorygstn.'",factorystate="'.$factorystate.'"';


// addlisting('externalChallan',$kk);
// }else{

  $where='id="'.$_POST['editId'].'"';

$kk ='supplier="'.$supplier.'",address="'.$address.'",phone="'.$phone.'",gstn="'.$gstn.'",state="'.$state.'",stylenum="'.$stylenum.'",indentnum="'.$indentnum.'",process="'.$process.'",challantype="'.$challantype.'",personname="'.$personname.'",dispatch="'.$dispatch.'",date="'.$date.'",vehiclenum="'.$vehiclenum.'",
gatenum="'.$gatenum.'",ewaynum="'.$ewaynum.'",factoryname="'.$factoryname.'",factoryaddress="'.$factoryaddress.'",factoryphone="'.$factoryphone.'",factorygstn="'.$factorygstn.'",factorystate="'.$factorystate.'",pono="'.$pono.'",status="1"';


updatelisting('externalChallan',$kk,$where);



?>
<script>
parent.setupbox('showpage.crm?module=externalchallan');
</script>
<?php

}


if(trim($_POST['action'])=='stockTransfer' && trim($_POST['module'])!=''){

$transferType=clean($_POST['transferType']);
$requisitionNo=clean($_POST['requisitionNo']);
$requisitionDate=date('Y-m-d',strtotime($_POST['requisitionDate']));
$fromStyle=clean($_POST['fromStyle']);
$toStyle=clean($_POST['toStyle']);
$categoryId=$_POST['categoryId'];
$fromIndent=clean($_POST['fromIndent']);
$toIndent=clean($_POST['toIndent']);
$reason=clean($_POST['reason']);
$fromStore=clean($_POST['fromStore']);
$toStore=clean($_POST['toStore']);
$loadIssuanceNumber=clean($_POST['loadIssuanceNumber']);
$addedBy=clean($_SESSION['userid']);
$status=clean($_POST['status']);

$namevalue ='transferType="'.$transferType.'",requisitionNo="'.$requisitionNo.'",requisitionDate="'.$requisitionDate.'",fromStyle="'.$fromStyle.'",toStyle="'.$toStyle.'",categoryId="'.$categoryId.'",fromIndent="'.$fromIndent.'",toIndent="'.$toIndent.'",reason="'.$reason.'",fromStore="'.$fromStore.'",toStore="'.$toStore.'",loadIssuanceNumber="'.$loadIssuanceNumber.'",addedBy="'.$addedBy.'",status="'.$status.'",tabstatus="1"';

if($_POST['editId']!=''){
$where='id="'.decode($_POST['editId']).'"';
$update = updatelisting('stockTransfer',$namevalue,$where);
}else{
$lasttid=addlistinggetlastid('stockTransfer',$namevalue);
}


?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>
<?php }
?>

<?php
if($_REQUEST['action']=="saveexternalchallan" && $_REQUEST['id']!=''){

$itemcode = clean($_REQUEST['itemcode']);
$hsncode = clean($_REQUEST['hsncode']);
$reason = clean($_REQUEST['reason']);
$uom = clean($_REQUEST['uom']);
$qty = clean($_REQUEST['qty']);
$rate = clean($_REQUEST['rate']);
$amnt = clean($_REQUEST['amnt']);
// $billno = clean($_REQUEST['billno']);
// $discamt = clean($_REQUEST['discamt']);
// $taxvalue = clean($_REQUEST['taxvalue']);
$cgstamt = clean($_REQUEST['cgstamt']);
$cgstrate = clean($_REQUEST['cgstrate']);
$sgstamt = clean($_REQUEST['sgstamt']);
$sgstrate = clean($_REQUEST['sgstrate']);
$igstrate = clean($_REQUEST['igstrate']);
$igstamt = clean($_REQUEST['igstamt']);
$utgstamt = clean($_REQUEST['utgstamt']);
$utgstrate = clean($_REQUEST['utgstrate']);
$where='id="'.decode($_REQUEST['id']).'"';
$namevalue ='itemcode="'.$itemcode.'",hsncode="'.$hsncode.'",reason="'.$reason.'",uom="'.$uom.'",qty="'.$qty.'",rate="'.$rate.'",amnt="'.$amnt.'",cgstrate="'.$cgstrate.'",cgstamt="'.$cgstamt.'",sgstrate="'.$sgstrate.'",sgstamt="'.$sgstamt.'",igstamt="'.$igstamt.'",igstrate="'.$igstrate.'",utgstrate="'.$utgstrate.'",utgstamt="'.$utgstamt.'"';

$update = updatelisting('loadExternalChallanMaster',$namevalue,$where);
}


?>

<?php

if(trim($_POST['action'])=='editpaymentprocessing' && trim($_POST['editId'])!=''){
$editId= decode($_POST['editId']);
$grnNo = trim($_POST['grnNo']);

$grnDate = date('Y-m-d',strtotime($_POST['grnDate']));
$challanNo = trim($_POST['challanNo']);
$eWayBill = trim($_POST['eWayBill']);
$docNo = trim($_POST['docNo']);
$eWayBillDate = date('Y-m-d',strtotime($_POST['eWayBillDate']));
$supplierId = trim($_POST['supplierId']);
$supplierGst = trim($_POST['supplierGst']);
$departmentId = trim($_POST['departmentId']);
$costCenter = trim($_POST['costCenter']);
$paymentNo = trim($_POST['paymentNo']);
// $gateEntryNo = trim($_POST['gateEntryNo']);
// $attachment = trim($_POST['attachment']);
// $perfInvoice = trim($_POST['perfInvoice']);

$where = 'id="'.$editId.'"';
$namevalue ='grnDate="'.$grnDate.'",challanNo="'.$challanNo.'",eWayBill="'.$eWayBill.'",docNo="'.$docNo.'",eWayBillDate="'.$eWayBillDate.'",supplierId="'.$supplierId.'",supplierGst="'.$supplierGst.'",departmentId="'.$departmentId.'",costCenter="'.$costCenter.'",paymentNo="'.$paymentNo.'",status="1"';
$update = updatelisting('paymentProcessingMaster',$namevalue,$where);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>');
</script>
<?php
}
?>



<?php
if($_REQUEST['action']=="savepaymentprocessing" && $_REQUEST['id']!=''){

$itemcode = clean($_REQUEST['itemcode']);
$hsncode = clean($_REQUEST['hsncode']);
$reason = clean($_REQUEST['reason']);
$uom = clean($_REQUEST['uom']);
$qty = clean($_REQUEST['qty']);
$rate = clean($_REQUEST['rate']);
$amnt = clean($_REQUEST['amnt']);
// $billno = clean($_REQUEST['billno']);
// $discamt = clean($_REQUEST['discamt']);
// $taxvalue = clean($_REQUEST['taxvalue']);
$cgstamt = clean($_REQUEST['cgstamt']);
$cgstrate = clean($_REQUEST['cgstrate']);
$sgstamt = clean($_REQUEST['sgstamt']);
$sgstrate = clean($_REQUEST['sgstrate']);
// $igstrate = clean($_REQUEST['igstrate']);
// $igstamt = clean($_REQUEST['igstamt']);
// $utgstamt = clean($_REQUEST['utgstamt']);
// $utgstrate = clean($_REQUEST['utgstrate']);
$where='id="'.decode($_REQUEST['id']).'"';
$namevalue ='itemcode="'.$itemcode.'",hsncode="'.$hsncode.'",reason="'.$reason.'",uom="'.$uom.'",qty="'.$qty.'",rate="'.$rate.'",amnt="'.$amnt.'",cgstrate="'.$cgstrate.'",cgstamt="'.$cgstamt.'",sgstrate="'.$sgstrate.'",sgstamt="'.$sgstamt.'"';

$update = updatelisting('loadpaymentprocessing',$namevalue,$where);
}

if(trim($_POST['action'])=='amendactiongreige'){
$requisitionId=clean($_POST['requisitionId']);
$amendType = trim($_POST['amendType']);
$requestedDate = date('Y-m-d');
$rand = rand(10,100);
$amendNumber = "AMD-".date('dmy').'-'.$rand;
$reason = trim($_POST['reason']);
$materialId=clean($_POST['materialId']);
$materialType=clean($_POST['materialType']);
$finalQty=clean($_POST['finalQty']);
$finalQtyOld = trim($_POST['finalQtyOld']);

$namevalue = 'styleId="'.$requisitionId.'",amendType="'.$amendType.'",requestedDate="'.$requestedDate.'",amendNumber="'.$amendNumber.'",sectionType="greigerequisition"';
$lasttid=addlistinggetlastid('amendmentMaster',$namevalue);
if($lasttid!=''){
$namevalue2 = 'amendmentId="'.$lasttid.'",styleId="'.$requisitionId.'",stylesubtabid="'.$materialId.'",costsheetVersionId="0",materialType="'.$materialType.'",reason="'.$reason.'",bomAvg="0",bomWidth="0",bomUnit="0",wastagePersent="0",matPrice="0",bomAvgOld="0",bomWidthOld="0",bomUnitOld="0",wastagePersentOld="0",matPriceOld="0",finalQty="'.$finalQty.'",finalQtyOld="'.$finalQtyOld.'"';
$lasttid2=addlistinggetlastid('bomAmendment',$namevalue2);
}
?>
<script>
parent.setupbox('showpage.crm?module=amendment');
</script>
<?php
}
?>



<?php
if(trim($_POST['action'])=='maintenancegi'){
    $requisitionno=clean($_POST['requisitionno']);

$requisitiondate=clean($_POST['requisitiondate']);

$requisitiontype=clean($_POST['requisitiontype']);
$department=clean($_POST['department']);
$duedate=clean($_POST['duedate']);
$requested=clean($_POST['requestedby']);
$requestedfrom=clean($_POST['requestedfrom']);
$modifyDate = time();
        $where='id="'.decode($_POST['editId']).'"';
    $kk ='requisitiontype="'.$requisitiontype.'",requesteddepartment="'.$department.'",duedate="'.$duedate.'",requestedby="'.$requested.'",requestedform="'.$requestedfrom.'",requisitionno="'.$requisitionno.'",requisitiondate="'.$requisitiondate.'",status=1';
    $update=updatelisting('maintenancegi_Master',$kk,$where);
?>
<script>
parent.setupbox('showpage.crm?module=maintenancegi');
</script>
<?php
}
?>
<?php
if($_REQUEST['action']=="savemaintenancegi" && $_REQUEST['id']!=''){

$itemcode = clean($_REQUEST['itemcode']);
$size = clean($_REQUEST['size']);
$requestedquantity = clean($_REQUEST['requestedquantity']);
$uom = clean($_REQUEST['uom']);
$purpose = clean($_REQUEST['purpose']);
$supplier = clean($_REQUEST['supplier']);
$price = clean($_REQUEST['price']);

$amount = clean($_REQUEST['amount']);
$currency = clean($_REQUEST['currency']);
$remark = clean($_REQUEST['remark']);

$where='id="'.decode($_REQUEST['id']).'"';
$namevalue ='item="'.$itemcode.'",size="'.$size.'",requestedquantity="'.$requestedquantity.'",uom="'.$uom.'",purpose="'.$purpose.'",supplier="'.$supplier.'",price="'.$price.'",amount="'.$amount.'",currency="'.$currency.'",remark="'.$remark.'"';

$update = updatelisting('loadmaintenance',$namevalue,$where);
}

?>



<?php
if(trim($_POST['action'])=='maintenancegeneral' && trim($_POST['material'])!='' && trim($_POST['module'])!=''){
$material=clean($_POST['material']);
$description=clean($_POST['description']);
$color=clean($_POST['color']);
$status=clean($_POST['status']);

$dateAdded=time();
$modifyDate=time();
if($_POST['editId']==""){
$namevalue ='material="'.$material.'",destination="'.$description.'",color="'.$color.'",status="'.$status.'",dateAdded="'.$dateAdded.'",modifyDate="'.$modifyDate.'",addedBy="'.$_SESSION['userid'].'",modifyBy="'.$_SESSION['userid'].'"';
$adds = addlisting('maintenancegeneral_Master',$namevalue);
}
else{
$where='id='.decode($_POST['editId']).'';
$namevalue ='material="'.$material.'",destination="'.$description.'",color="'.$color.'",status="'.$status.'",modifyDate="'.$modifyDate.'",addedBy="'.$_SESSION['userid'].'",modifyBy="'.$_SESSION['userid'].'"';
$update = updatelisting('maintenancegeneral_Master',$namevalue,$where);
}
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&alt=1');
</script>
<?php
}
?>


<?php
if(trim($_POST['action']) == 'maintenancegi' && isset($_POST["approve"])){

        $where='id="'.decode($_POST['editId']).'"';
    $kk ='approvedstatus="1"';
    $update=updatelisting('maintenancegi_Master',$kk,$where);
?>
<script>
parent.setupbox('showpage.crm?module=maintenancegi');
</script>
<?php } ?>


<?php

if($_REQUEST['action']=='requisitionindentSendpo' && $_POST['sellingValue']!=0 && $_POST['sellingValue']!=0){
$mainid = $_POST['mainid'];
$supplierId = $_POST['supplierId'];
$materialQty = $_POST['materialQty'];
$orderQty = $_POST['orderQty'];
$sellingRate = $_POST['sellingRate'];
$sellingValue = $_POST['sellingValue'];
$pendingQty = $_POST['pendingQty'];
$requisitionNo = $_POST['requisitionno'];

$aaa ='mainid="'.$mainid.'",supplierId="'.$supplierId.'",materialQty="'.$materialQty.'",orderQty="'.$orderQty.'",sellingRate="'.$sellingRate.'",sellingValue="'.$sellingValue.'",pendingQty="'.$pendingQty.'",requisitionno="'.$requisitionNo.'",status=1,dateAdded="'.time().'",createdDate="'.date('Y-m-d').'"';
$adds = addlisting('requisitionIndentMaster',$aaa);
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>&add=yes&id=<?php echo $_POST['pageeditid']; ?>');
</script>
<?php
}
?>

<?php
if($_REQUEST['action']=='releasedpo'){

//$assignto = $_POST['assignto'];
$date=time();
$assignToSupplier = $_POST['assignToSupplier'];
$assignToSupplierl1 = implode(",", $assignToSupplier);
$assignToSupplier = rtrim($assignToSupplierl1,',');

$array =  explode(',', $assignToSupplier);

$today = date("ymd");
$rand = strtoupper(substr(uniqid(sha1(time())),0,3));
$uniqueOrderId1 = $today . $rand;
$uniquePonNumber = $uniqueOrderId1;


foreach($array as $itennss) {
	 $update = updatelisting('requisitionIndentMaster','releasedpo=1,pogeneratedate="'.$date.'"','id="'.$itennss.'"');

}
?>
<script>
parent.reload_page();
</script>
<?php
}



?>





<?php
if($_REQUEST['action']=='setsizeinspection'){
$styleId= $_POST['styleId'];
$inspection_no= $_POST['inspection_no'];
$color = $_POST['color'];
$size_range = $_POST['size_range'];
$dat = $_POST['dat'];
$done_by = $_POST['done_by'];

$main_label1= $_POST['main_label1'];
$main_label2 = $_POST['main_label2'];
$main_label3 = $_POST['main_label3'];
$main_label4 = $_POST['main_label4'];
$polybag1 = $_POST['polybag1'];
$polybag2 = $_POST['polybag2'];
$polybag3 = $_POST['polybag3'];
$polybag4 = $_POST['polybag4'];
$book_fold1 = $_POST['book_fold1'];
$book_fold2= $_POST['book_fold2'];
$book_fold3 = $_POST['book_fold3'];
$book_fold4 = $_POST['book_fold4'];
$poly_bag_sticker1 = $_POST['poly_bag_sticker1'];
$poly_bag_sticker2 = $_POST['poly_bag_sticker2'];
$poly_bag_sticker3 = $_POST['poly_bag_sticker3'];
$poly_bag_sticker4 = $_POST['poly_bag_sticker4'];
$fac_code1 = $_POST['fac_code1'];
$fac_code2 = $_POST['fac_code2'];
$fac_code3= $_POST['fac_code3'];
$fac_code4 = $_POST['fac_code4'];
$lot_sticker1 = $_POST['lot_sticker1'];
$lot_sticker2 = $_POST['lot_sticker2'];
$lot_sticker3 = $_POST['lot_sticker3'];
$lot_sticker4 = $_POST['lot_sticker4'];

$hang_tag1 = $_POST['hang_tag1'];
$hang_tag2 = $_POST['hang_tag2'];
$hang_tag3 = $_POST['hang_tag3'];
$hang_tag4= $_POST['hang_tag4'];
$pre_pack_sticker1 = $_POST['pre_pack_sticker1'];
$pre_pack_sticker2 = $_POST['pre_pack_sticker2'];
$pre_pack_sticker3 = $_POST['pre_pack_sticker3'];
$pre_pack_sticker4 = $_POST['pre_pack_sticker4'];
$hanger1 = $_POST['hanger1'];
$hanger2 = $_POST['hanger2'];
$hanger3 = $_POST['hanger3'];
$hanger4 = $_POST['hanger4'];
$hanger4 = $_POST['hanger4'];

$carton_king1 = $_POST['carton_king1'];
$carton_king2 = $_POST['carton_king2'];
$carton_king3 = $_POST['carton_king3'];
$carton_king4 = $_POST['carton_king4'];
$washcare1 = $_POST['washcare1'];
$washcare2 = $_POST['washcare2'];
$washcare3 = $_POST['washcare3'];
$washcare4 = $_POST['washcare4'];
$placement1 = $_POST['placement1'];
$placement2 = $_POST['placement2'];
$placement3 = $_POST['placement3'];
$placement4 = $_POST['placement4'];
$interlining1 = $_POST['interlining1'];
$interlining2 = $_POST['interlining2'];
$interlining3 = $_POST['interlining3'];
$interlining4 = $_POST['interlining4'];
$folding1 = $_POST['folding1'];
$folding2 = $_POST['folding2'];
$folding3 = $_POST['folding3'];
$folding4 = $_POST['folding4'];
$snap1 = $_POST['snap1'];
$snap2 = $_POST['snap2'];
$snap3 = $_POST['snap3'];
$snap4 = $_POST['snap4'];
$spare_but_pos1 = $_POST['spare_but_pos1'];
$spare_but_pos2 = $_POST['spare_but_pos2'];
$spare_but_pos3 = $_POST['spare_but_pos3'];
$spare_but_pos4 = $_POST['spare_but_pos4'];
$elastic1 = $_POST['elastic1'];
$elastic2 = $_POST['elastic2'];
$elastic3 = $_POST['elastic3'];
$elastic4 = $_POST['elastic4'];
$print1 = $_POST['print1'];
$print2 = $_POST['print2'];
$print3 = $_POST['print3'];
$print4 = $_POST['print4'];
$button1 = $_POST['button1'];
$button2 = $_POST['button2'];
$button3 = $_POST['button3'];
$button4 = $_POST['button4'];
$layout1 = $_POST['layout1'];
$layout2 = $_POST['layout2'];
$layout3 = $_POST['layout3'];
$layout4 = $_POST['layout4'];
$hok_eye_bar1 = $_POST['hok_eye_bar1'];
$hok_eye_bar2= $_POST['hok_eye_bar2'];
$hok_eye_bar3 = $_POST['hok_eye_bar3'];
$hok_eye_bar4	 = $_POST['hok_eye_bar4	'];
$emb_thr_color1 = $_POST['emb_thr_color1'];
$emb_thr_color2 = $_POST['emb_thr_color2'];
$emb_thr_color3 = $_POST['emb_thr_color3'];
$emb_thr_color4 = $_POST['emb_thr_color4'];
$lace1 = $_POST['lace1'];
$lace2 = $_POST['lace2'];
$lace3 = $_POST['lace3'];
$lace4 = $_POST['lace4'];
$plcment1 = $_POST['plcment1'];
$plcment2 = $_POST['plcment2'];
$plcment3 = $_POST['plcment3'];
$plcment4 = $_POST['plcment4'];
$buckle1 = $_POST['buckle1'];
$buckle2 = $_POST['buckle2'];
$buckle3 = $_POST['buckle3'];
$buckle4 = $_POST['buckle4'];
$bead_seq1 = $_POST['bead_seq1'];
$bead_seq2 = $_POST['bead_seq2'];
$bead_seq3 = $_POST['bead_seq3'];
$bead_seq4 = $_POST['bead_seq4'];
$bead_seq_lay1 = $_POST['bead_seq_lay1'];
$bead_seq_lay2 = $_POST['bead_seq_lay2'];
$bead_seq_lay3 = $_POST['bead_seq_lay3'];
$bead_seq_lay4 = $_POST['bead_seq_lay4'];
$thread1 = $_POST['thread1'];
$thread2 = $_POST['thread2'];
$thread3 = $_POST['thread3'];
$thread4 = $_POST['thread4'];
$aft_treatment1 = $_POST['aft_treatment1'];
$aft_treatment2 = $_POST['aft_treatment2'];
$aft_treatment3 = $_POST['aft_treatment3'];
$aft_treatment4 = $_POST['aft_treatment4'];
$lining1 = $_POST['lining1'];
$lining2 = $_POST['lining2'];
$lining3 = $_POST['lining3'];
$lining4 = $_POST['lining4'];
$ph1 = $_POST['ph1'];
$ph2 = $_POST['ph2'];
$ph3 = $_POST['ph3'];
$ph4 = $_POST['ph4'];
$zipper1 = $_POST['zipper1'];
$zipper2 = $_POST['zipper2'];
$zipper3 = $_POST['zipper3'];
$zipper4 = $_POST['zipper4'];


 $grain_line= $_POST['grain_line'];
 $seam_allownce = $_POST['seam_allownce'];
$notches = $_POST['notches'];
$cutting_check = $_POST['cutting_check'];
$grade_nest = $_POST['grade_nest'];
$y_mini_marker = $_POST['y_mini_marker'];
$measr_space_sht = $_POST['measr_space_sht'];
$correct_imp = $_POST['correct_imp'];
$cutting_go_head = $_POST['cutting_go_head'];
$size_set_implmt= $_POST['size_set_implmt'];
$bulk_cut_width = $_POST['bulk_cut_width'];
$bulk_full_width = $_POST['bulk_full_width'];
$planned_size_date = $_POST['planned_size_date'];
$cut_quantity = $_POST['cut_quantity'];
$corctn_done = $_POST['corctn_done'];
$shell_shrn_len = $_POST['shell_shrn_len'];
$shell_shrn_wid = $_POST['shell_shrn_wid'];
$shell_patrn_len = $_POST['shell_patrn_len'];
$shell_patrn_wid= $_POST['shell_patrn_wid'];

//$requisitionNo = $_POST['requested_from'];
$created_at = date('Y-m-d H:i:s');
//$dateAdded=time();
if($_FILES['measurement_attach']['name']!=''){
$file_name=$_FILES['measurement_attach']['name'];
$file_name=time().'-'.$file_name;
copy($_FILES['measurement_attach']['tmp_name'],"images/".$file_name);
}

if($_POST['editId']==''){
$aaa ='main_label1="'.$main_label1.'",styleId="'.$styleId.'",inspection_no="'.$inspection_no.'",color="'.$color.'",size_range="'
.$size_range.'",dat="'.$dat.'",done_by="'.$done_by.'",measurement_attach="'.$file_name.'",main_label2="'.$main_label2.'",main_label3="'
.$main_label3.'",main_label4="'.$main_label4.'",polybag1="'.$polybag1.'",
polybag2="'.$polybag2.'",polybag3="'.$polybag3.'",polybag4="'.$polybag4.'",book_fold1="'.$book_fold1.'",
book_fold2="'.$book_fold2.'", book_fold3="'.$book_fold3.'", book_fold4="'.$book_fold4.'",
poly_bag_sticker1="'.$poly_bag_sticker1.'", poly_bag_sticker2="'.$poly_bag_sticker2.'",
poly_bag_sticker3="'.$poly_bag_sticker3.'", poly_bag_sticker4="'.$poly_bag_sticker4.'",
fac_code1="'.$fac_code1.'", fac_code2="'.$fac_code2.'", fac_code3="'.$fac_code3.'",
fac_code4="'.$fac_code4.'", lot_sticker1="'.$lot_sticker1.'",
lot_sticker2="'.$lot_sticker2.'", lot_sticker3="'.$lot_sticker3.'",
lot_sticker4="'.$lot_sticker4.'", hang_tag1="'.$hang_tag1.'",
hang_tag2="'.$hang_tag2.'", hang_tag3="'.$hang_tag3.'", hang_tag4="'.$hang_tag4.'",
pre_pack_sticker1="'.$pre_pack_sticker1.'", pre_pack_sticker2="'.$pre_pack_sticker2.'",
pre_pack_sticker3="'.$pre_pack_sticker3.'", pre_pack_sticker4="'.$pre_pack_sticker4.'",
hanger1="'.$hanger1.'", hanger2="'.$hanger2.'", hanger3="'.$hanger3.'",
hanger4="'.$hanger4.'", carton_king1="'.$carton_king1.'", carton_king2="'.$carton_king2.'",
carton_king3="'.$carton_king3.'", carton_king4="'.$carton_king4.'", washcare1="'.$washcare1.'",
washcare2="'.$washcare2.'", washcare3="'.$washcare3.'", washcare4="'.$washcare4.'", placement1="'.$placement1.'",
placement2="'.$placement2.'", placement3="'.$placement3.'", placement4="'.$placement4.'", interlining1="'.$interlining1.'",
interlining2="'.$interlining2.'", interlining3="'.$interlining3.'", interlining4="'.$interlining4.'",
folding1="'.$folding1.'", folding2="'.$folding2.'", folding3="'.$folding3.'", folding4="'.$folding4.'",
snap1="'.$snap1.'", snap2="'.$snap2.'", snap3="'.$snap3.'", snap4="'.$snap4.'",spare_but_pos1="'.$spare_but_pos1.'",
spare_but_pos2="'.$spare_but_pos2.'", spare_but_pos3="'.$spare_but_pos3.'", spare_but_pos4="'.$spare_but_pos4.'", elastic1="'.$elastic1.'",
elastic2="'.$elastic2.'", elastic3="'.$elastic3.'", elastic4="'.$elastic4.'", print1="'.$print1.'",
print2="'.$print2.'", print3="'.$print3.'", print4="'.$print4.'", button1="'.$button1.'",
button2="'.$button2.'", button3="'.$button3.'", button4="'.$button4.'", layout1="'.$layout1.'",
layout2="'.$layout2.'", layout3="'.$layout3.'", layout4="'.$layout4.'", hok_eye_bar1="'.$hok_eye_bar1.'", hok_eye_bar2="'.$hok_eye_bar2.'",
hok_eye_bar3="'.$hok_eye_bar3.'", hok_eye_bar4="'.$hok_eye_bar4.'",
emb_thr_color1="'.$emb_thr_color1.'", emb_thr_color2="'.$emb_thr_color2.'", emb_thr_color3="'.$emb_thr_color3.'", emb_thr_color4="'.$emb_thr_color4.'",
 lace1="'.$lace1.'", lace2="'.$lace2.'", lace3="'.$lace3.'", lace4="'.$lace4.'", plcment1="'.$plcment1.'",
 plcment2="'.$plcment2.'", plcment3="'.$plcment3.'", plcment4="'.$plcment4.'", buckle1="'.$buckle1.'",
  buckle2="'.$buckle2.'", buckle3="'.$buckle3.'", buckle4="'.$buckle4.'", bead_seq1="'.$bead_seq1.'", bead_seq2="'.$bead_seq2.'", bead_seq3="'.$bead_seq3.'",
  bead_seq4="'.$bead_seq4.'", bead_seq_lay1="'.$bead_seq_lay1.'", bead_seq_lay2="'.$bead_seq_lay2.'", bead_seq_lay3="'.$bead_seq_lay3.'",
  bead_seq_lay4="'.$bead_seq_lay4.'", thread1="'.$thread1.'", thread2="'.$thread2.'", thread3="'.$thread3.'", thread4="'.$thread4.'",
  aft_treatment1="'.$aft_treatment1.'", aft_treatment2="'.$aft_treatment2.'", aft_treatment3="'.$aft_treatment3.'",
  aft_treatment4="'.$aft_treatment4.'", lining1="'.$lining1.'", lining2="'.$lining2.'", lining3="'.$lining3.'",
  lining4="'.$lining4.'", ph1="'.$ph1.'", ph2="'.$ph2.'", ph3="'.$ph3.'", ph4="'.$ph4.'",
  zipper1="'.$zipper1.'", zipper2="'.$zipper2.'", zipper3="'.$zipper3.'", zipper4="'.$zipper4.'", grain_line="'.$grain_line.'",
seam_allownce="'.$seam_allownce.'", notches="'.$notches.'", cutting_check="'.$cutting_check.'",
grade_nest="'.$grade_nest.'", y_mini_marker="'.$y_mini_marker.'", measr_space_sht="'.$measr_space_sht.'",
correct_imp="'.$correct_imp.'", cutting_go_head="'.$cutting_go_head.'", size_set_implmt="'.$size_set_implmt.'",
bulk_cut_width="'.$bulk_cut_width.'",
bulk_full_width="'.$bulk_full_width.'",
planned_size_date="'.$planned_size_date.'", cut_quantity="'.$cut_quantity.'",
corctn_done="'.$corctn_done.'", shell_shrn_len="'.$shell_shrn_len.'",
shell_shrn_wid="'.$shell_shrn_wid.'", shell_patrn_len="'.$shell_patrn_len.'", shell_patrn_wid="'.$shell_patrn_wid.'", createdBy="'.$created_at.'",dateAdded=NOW()';
$adds = addlisting('setSizeInspection_acesrs',$aaa);
}else{

    $where='id="'.decode($_POST['editId']).'"';
$updatesizevalue ='inspection_no="'.$inspection_no.'",color="'.$color.'",size_range="'
.$size_range.'",dat="'.$dat.'",done_by="'.$done_by.'",measurement_attach="'.$file_name.'", main_label1="'.$main_label1.'", main_label2="'.$main_label2.'",main_label3="'
.$main_label3.'",main_label4="'.$main_label4.'",polybag1="'.$polybag1.'",
polybag2="'.$polybag2.'",polybag3="'.$polybag3.'",polybag4="'.$polybag4.'",book_fold1="'.$book_fold1.'",
book_fold2="'.$book_fold2.'", book_fold3="'.$book_fold3.'", book_fold4="'.$book_fold4.'",
poly_bag_sticker1="'.$poly_bag_sticker1.'", poly_bag_sticker2="'.$poly_bag_sticker2.'",
poly_bag_sticker3="'.$poly_bag_sticker3.'", poly_bag_sticker4="'.$poly_bag_sticker4.'",
fac_code1="'.$fac_code1.'", fac_code2="'.$fac_code2.'", fac_code3="'.$fac_code3.'",
fac_code4="'.$fac_code4.'", lot_sticker1="'.$lot_sticker1.'",
lot_sticker2="'.$lot_sticker2.'", lot_sticker3="'.$lot_sticker3.'",
lot_sticker4="'.$lot_sticker4.'", hang_tag1="'.$hang_tag1.'",
hang_tag2="'.$hang_tag2.'", hang_tag3="'.$hang_tag3.'", hang_tag4="'.$hang_tag4.'",
pre_pack_sticker1="'.$pre_pack_sticker1.'", pre_pack_sticker2="'.$pre_pack_sticker2.'",
pre_pack_sticker3="'.$pre_pack_sticker3.'", pre_pack_sticker4="'.$pre_pack_sticker4.'",
hanger1="'.$hanger1.'", hanger2="'.$hanger2.'", hanger3="'.$hanger3.'",
hanger4="'.$hanger4.'", carton_king1="'.$carton_king1.'", carton_king2="'.$carton_king2.'",
carton_king3="'.$carton_king3.'", carton_king4="'.$carton_king4.'", washcare1="'.$washcare1.'",
washcare2="'.$washcare2.'", washcare3="'.$washcare3.'", washcare4="'.$washcare4.'", placement1="'.$placement1.'",
placement2="'.$placement2.'", placement3="'.$placement3.'", placement4="'.$placement4.'", interlining1="'.$interlining1.'",
interlining2="'.$interlining2.'", interlining3="'.$interlining3.'", interlining4="'.$interlining4.'",
folding1="'.$folding1.'", folding2="'.$folding2.'", folding3="'.$folding3.'", folding4="'.$folding4.'",
snap1="'.$snap1.'", snap2="'.$snap2.'", snap3="'.$snap3.'", snap4="'.$snap4.'",spare_but_pos1="'.$spare_but_pos1.'",
spare_but_pos2="'.$spare_but_pos2.'", spare_but_pos3="'.$spare_but_pos3.'", spare_but_pos4="'.$spare_but_pos4.'", elastic1="'.$elastic1.'",
elastic2="'.$elastic2.'", elastic3="'.$elastic3.'", elastic4="'.$elastic4.'", print1="'.$print1.'",
print2="'.$print2.'", print3="'.$print3.'", print4="'.$print4.'", button1="'.$button1.'",
button2="'.$button2.'", button3="'.$button3.'", button4="'.$button4.'", layout1="'.$layout1.'",
layout2="'.$layout2.'", layout3="'.$layout3.'", layout4="'.$layout4.'", hok_eye_bar1="'.$hok_eye_bar1.'", hok_eye_bar2="'.$hok_eye_bar2.'",
hok_eye_bar3="'.$hok_eye_bar3.'", hok_eye_bar4="'.$hok_eye_bar4.'",
emb_thr_color1="'.$emb_thr_color1.'", emb_thr_color2="'.$emb_thr_color2.'", emb_thr_color3="'.$emb_thr_color3.'", emb_thr_color4="'.$emb_thr_color4.'",
 lace1="'.$lace1.'", lace2="'.$lace2.'", lace3="'.$lace3.'", lace4="'.$lace4.'", plcment1="'.$plcment1.'",
 plcment2="'.$plcment2.'", plcment3="'.$plcment3.'", plcment4="'.$plcment4.'", buckle1="'.$buckle1.'",
  buckle2="'.$buckle2.'", buckle3="'.$buckle3.'", buckle4="'.$buckle4.'", bead_seq1="'.$bead_seq1.'", bead_seq2="'.$bead_seq2.'", bead_seq3="'.$bead_seq3.'",
  bead_seq4="'.$bead_seq4.'", bead_seq_lay1="'.$bead_seq_lay1.'", bead_seq_lay2="'.$bead_seq_lay2.'", bead_seq_lay3="'.$bead_seq_lay3.'",
  bead_seq_lay4="'.$bead_seq_lay4.'", thread1="'.$thread1.'", thread2="'.$thread2.'", thread3="'.$thread3.'", thread4="'.$thread4.'",
  aft_treatment1="'.$aft_treatment1.'", aft_treatment2="'.$aft_treatment2.'", aft_treatment3="'.$aft_treatment3.'",
  aft_treatment4="'.$aft_treatment4.'", lining1="'.$lining1.'", lining2="'.$lining2.'", lining3="'.$lining3.'",
  lining4="'.$lining4.'", ph1="'.$ph1.'", ph2="'.$ph2.'", ph3="'.$ph3.'", ph4="'.$ph4.'",
  zipper1="'.$zipper1.'", zipper2="'.$zipper2.'", zipper3="'.$zipper3.'", zipper4="'.$zipper4.'", grain_line="'.$grain_line.'",
seam_allownce="'.$seam_allownce.'", notches="'.$notches.'", cutting_check="'.$cutting_check.'",
grade_nest="'.$grade_nest.'", y_mini_marker="'.$y_mini_marker.'", measr_space_sht="'.$measr_space_sht.'",
correct_imp="'.$correct_imp.'", cutting_go_head="'.$cutting_go_head.'", size_set_implmt="'.$size_set_implmt.'",
bulk_cut_width="'.$bulk_cut_width.'",
bulk_full_width="'.$bulk_full_width.'",
planned_size_date="'.$planned_size_date.'", cut_quantity="'.$cut_quantity.'",
corctn_done="'.$corctn_done.'", shell_shrn_len="'.$shell_shrn_len.'",
shell_shrn_wid="'.$shell_shrn_wid.'", shell_patrn_len="'.$shell_patrn_len.'",shell_patrn_wid="'.$shell_patrn_wid.'"';
$update = updatelisting('setSizeInspection_acesrs',$updatesizevalue,$where);
}
?>

 <script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>');
</script>
<?php
}
?>


<?php
if(trim($_POST['action'])=='maintenancegateentrymaster' && isset($_POST["Submit1"])){

$entrydate=clean($_POST['entrydate']);
$entrytime=clean($_POST['entrytime']);
$gateno=clean($_POST['gateno']);
$registerno=clean($_POST['registerno']);
$potype=clean($_POST['potype']);
$ponumber=clean($_POST['ponumber']);
$supplier=clean($_POST['supplier']);
$billdate=clean($_POST['billdate']);
$billno=clean($_POST['billno']);
$vehiclein=clean($_POST['vehiclein']);
$vehicleout=clean($_POST['vehicleout']);
$drivername=clean($_POST['drivername']);
$drivernumber=clean($_POST['drivernumber']);
$challanno=clean($_POST['challanno']);
$movement=clean($_POST['movement']);
$factoryId=clean($_POST['factoryId']);
$vehicleNo=clean($_POST['vehicleNo']);
if($_POST['editId']!=''){
$where='id="'.decode($_POST['editId']).'"';
$kk ='entrydate="'.$entrydate.'",entrytime="'.$entrytime.'",gateno="'.$gateno.'",registerno="'.$registerno.'",potype="'.$potype.'",ponumber="'.$ponumber.'",supplier="'.$supplier.'",billdate="'.$billdate.'",billno="'.$billno.'",vehiclein="'.$vehiclein.'",vehicleout="'.$vehicleout.'",drivername="'.$drivername.'",drivernumber="'.$drivernumber.'",challanno="'.$challanno.'",movement="'.$movement.'",status="2",factoryId="'.$factoryId.'",vehicleNo="'.$vehicleNo.'"';


// $kk ='registerno="'.$registerno.'"';


$update = updatelisting('maintenancegateentrymaster',$kk,$where);
}
?>
<script>
parent.setupbox('showpage.crm?module=gateentry');
</script>
<?php
}
?>

<?php
if(trim($_REQUEST['action'])=='maintenancegateentrydetail'){
$id=trim($_REQUEST['id']);
$qty=trim($_REQUEST['qty']);
$packages=trim($_REQUEST['packages']);
$amount=trim($_REQUEST['amount']);
$dispatch=trim($_REQUEST['dispatch']);
$netReceived=trim($_REQUEST['netReceived']);
$where='id="'.$id.'"';
$kk ='qty="'.$qty.'",packages="'.$packages.'",amount="'.$amount.'",dispatch="'.$dispatch.'",netReceived="'.$netReceived.'"';
$update=  updatelisting('maintenancegateentrymaster',$kk,$where);

}
?>

<?php
if(trim($_POST['action'])=='editmaintenancegrn' && trim($_POST['editId'])!='' && trim($_POST['workPlaceId'])!='' && trim($_POST['supplierId'])!=''){
$editId= decode($_POST['editId']);
$factoryId = trim($_POST['factoryId']);
$supplierId = trim($_POST['supplierId']);
$docNo = trim($_POST['docNo']);
$docDate = date('Y-m-d',strtotime($_POST['docDate']));
$qcStatus = trim($_POST['qcStatus']);
$eWayBill = trim($_POST['eWayBill']);
$eWayBillDate = date('Y-m-d',strtotime($_POST['eWayBillDate']));
$ginNo = trim($_POST['ginNo']);
$ginDate = date('Y-m-d',strtotime($_POST['ginDate']));
$eSungamNo = trim($_POST['eSungamNo']);
$supplierPurchaseOrderId = trim($_POST['supplierPurchaseOrderId']);
$chargesDetail = trim($_POST['chargesDetail']);
$workPlaceId = trim($_POST['workPlaceId']);
$gateEntryNo = trim($_POST['gateEntryNo']);
$transporter = trim($_POST['transporter']);
$formNo = trim($_POST['formNo']);
$billitiNo = trim($_POST['billitiNo']);
$eWay = trim($_POST['eWay']);
$address = trim($_POST['address']);
$stateCode = trim($_POST['stateCode']);
$ieCode = trim($_POST['ieCode']);
$hsn = trim($_POST['hsn']);
$amount = trim($_POST['amount']);
$cgst = trim($_POST['cgst']);
$acceptBy = trim($_POST['acceptedBy']);
$preparedBy = trim($_POST['preparedBy']);
$prepareDate = date('Y-m-d',strtotime($_POST['preparedDate']));
$grnNo = 'DB'.makeQueryId($editId);
$where = 'id="'.$editId.'"';
$namevalue ='grnNo="'.$grnNo.'",factoryId="'.$factoryId.'",supplierId="'.$supplierId.'",docNo="'.$docNo.'",docDate="'.$docDate.'",qcStatus="'.$qcStatus.'",eWayBill="'.$eWayBill.'",eWayBillDate="'.$eWayBillDate.'",ginNo="'.$ginNo.'",ginDate="'.$ginDate.'",eSungamNo="'.$eSungamNo.'",supplierPurchaseOrderId="'.$supplierPurchaseOrderId.'",chargesDetail="'.$chargesDetail.'",workPlaceId="'.$workPlaceId.'",gateEntryNo="'.$gateEntryNo.'",formNo="'.$formNo.'",transporter="'.$transporter.'",billitiNo="'.$billitiNo.'",eWay="'.$eWay.'",address="'.$address.'",stateCode="'.$stateCode.'",ieCode="'.$ieCode.'",hsn="'.$hsn.'",amount="'.$amount.'",cgst="'.$cgst.'",acceptBy="'.$acceptBy.'",preparedBy="'.$preparedBy.'",prepareDate="'.$prepareDate.'"';
$update = updatelisting('maintenancegrnMaster',$namevalue,$where);
$update = updatelisting('maintenancegateentrymaster','grnStatus=1','id="'.$gateEntryNo.'"');
?>
<script>
parent.setupbox('showpage.crm?module=<?php echo $_POST['module']; ?>');
</script>
<?php }
?>


<?php
if(trim($_POST['action'])=='yt'){
$uploadDate=clean($_POST['uploadDate']);
$stage=clean($_POST['stage']);
$parentId=clean($_POST['parentId']);
$styleid=clean($_POST['styleid']);
$datarow=clean($_POST['datarow']);

$remark=clean($_POST['remark']);

// if($_FILES['poattach']['name']!=''){
// $file_name=$_FILES['poattach']['name'];
// $file_name=time().'-'.$file_name;
// copy($_FILES['poattach']['tmp_name'],"images/".$file_name);
// }


foreach($_FILES['poattach']['name'] as $key => $name){
$newFilename = time() . "_" . $name;
move_uploaded_file($_FILES['poattach']['tmp_name'][$key], 'images/' . $newFilename);
$location = 'images/' . $newFilename;

}

//echo $location; die();

$namevalue1 ='datarow="'.$datarow.'",styleid="'.$styleid.'",uploadDate="'.$uploadDate.'",stage="'.$stage.'",parentId="'.$parentId.'",remark="'.$remark.'",attachtp="'.$location.'"';
addlisting('criticpop',$namevalue1);

?>

<script>
parent.reload_page();
</script>


<?php

}
?>


<?php

if(trim($_POST['action'])=='sendpoemailtosuppier' && $_FILES['supplierPoAttachment']!='' ){
    ?>
<script>
alert('sds');
</script>


<?php
// $queryId=clean($_POST['savenew']);
if($_FILES['supplierPoAttachment']['name']!=''){
$file_name=trim(addslashes($_FILES['supplierPoAttachment']['name']));
$file_name=time().'-'.str_replace(' ', '_',$file_name);
$file_name= str_replace('#', 'f',$file_name);
copy($_FILES['supplierPoAttachment']['tmp_name'],"images/".$file_name);
}


//Send email to user when create account.
include('config/mail.php');
$mailsubject = "User created on '".$systemname."'";
$maildescription = 'Dear <b>'.$firstName.' '.$lastName.'</b> <br>
							<br>
							Greeting from '.$systemname.' - The Apparel ERP!</p>
<p>Your Account has been created successfully.</p>
<p>Please find the below credentials:</p>
<p>URL: '.$fullurl.' </p>
<p>Email: '.$userName.'</p>
<p>Password: '.$auto_password.'</p>
<p>&nbsp;</p>
<p>Regards</p>
<p><b><i>'.$systemname.' - The Apparel ERP!</i></b></p>
<p><img src="'.$fullurl.'images/'.$file_name.'"></p>
';
$mailto = 'nitishkaushik526@gmail.com';
$ccmail='';
$file_name='';
$fromemail ='preetisn27@gmail.com';
send_template_mail_query($fromemail,$mailto,$mailsubject,$maildescription,$ccmail);




 ?>
<script>
 parent.reloadpage();
 </script>
<?php

}
?>





