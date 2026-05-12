<?php
if($addpermission!=1 && $_GET['id']==''){
header('location:'.$fullurl.'');
}
if($editpermission!=1 && $_GET['id']!=''){
header('location:'.$fullurl.'');
}
if($_GET['id']==''){
$wheredel='addedBy='.trim($_SESSION['userid']).' and deletestatus=1';
//deleteRecord(_QUERY_MASTER_,$wheredel);
$dateAdded=time();
$namevalue ='deletestatus=1,addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'"';
$lastqueryidmain= addlistinggetlastid(_QUERY_MASTER_,$namevalue);
}
 /*--------------------------------------------------------LEAD SECTION START------------------------------------------------------------*/

 $filecode=decode($_REQUEST['leadId']);
 $filecode=trim($filecode);
 $multiemails=trim(decode($_REQUEST['salesEmail']));

if($filecode!='' && $filecode>0){
$select1='*';
$where1='id='.$filecode.' ';
$rs1=GetPageRecord($select1,_SALES_QUERY_MASTER_,$where1);
$resultlists=mysqli_fetch_array($rs1);
$clientType = $resultlists['clientType'];
$editcompanyId=trim($resultlists['companyId']);
$destinationId=trim($resultlists['destinationId']);
$leadsource=$resultlists['leadsource'];
$fromDate=date('d-m-Y');
$toDate=date('d-m-Y');
$night=1;
$editsubject=$resultlists['subject'];
$expectedSales=clean($resultlists['expectedSales']);
$closerDate=showdate(($resultlists['closerDate']));
$campaign=$resultlists['campaign'];
}
 /*--------------------------------------------------------LEAD SECTION END------------------------------------------------------------*/



if($_GET['id']!=''){
$id=clean(decode($_GET['id']));
$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,_QUERY_MASTER_,$where1);
$editresult=mysqli_fetch_array($rs1);
$editassignTo=clean($editresult['assignTo']);
$editcompanyId=clean($editresult['companyId']);
$edittravelDate=clean($editresult['travelDate']);
$editfromDate=clean($editresult['fromDate']);
$edittoDate=clean($editresult['toDate']);
$editofficeBranch=clean($editresult['officeBranch']);
$destinationId=clean($editresult['destinationId']);
$editadult=clean($editresult['adult']);
$editchild=clean($editresult['child']);
$editnight=clean($editresult['night']);
$edittourType=clean($editresult['tourType']);
$editdescription=clean($editresult['description']);
$editguest1=clean($editresult['guest1']);
$editguest2=clean($editresult['guest2']);
$editcategoryId=clean($editresult['categoryId']);
$needFlight=clean($editresult['needFlight']);
$editqueryCloseDetails=clean($editresult['queryCloseDetails']);
$editqueryCloseDate=clean($editresult['queryCloseDate']);
$editmultiemails=clean($editresult['multiemails']);
$editqueryStatus=clean($editresult['queryStatus']);
$quotationYes=clean($editresult['quotationYes']);
$editattachmentFileclean=($editresult['attachmentFile']);
$editremark=clean($editresult['remark']);
$editqueryId=clean($editresult['queryId']);
$editsubject=clean($editresult['subject']);
$hotelAccommodation=clean($editresult['hotelAccommodation']);
$needFlight=clean($editresult['needFlight']);
$hotelCategory=clean($editresult['hotelCategory']);
$cabforLocal=clean($editresult['cabforLocal']);
$fromdestinationId=clean($editresult['fromdestinationId']);
$addedBy=clean($editresult['addedBy']);
$dateAdded=clean($editresult['dateAdded']);
$guest1phone=clean($editresult['guest1phone']);
$guest1email=clean($editresult['guest1email']);
$modifyBy=clean($editresult['modifyBy']);
$modifyDate=clean($editresult['modifyDate']);
$lastId=$editresult['id'];
$clientType=$editresult['clientType'];
$lastqueryidmain=$editresult['id'];
$fromDate=date("d-m-Y", strtotime($editresult['fromDate']));
$toDate=date("d-m-Y", strtotime($editresult['toDate']));
$closerDate=date("d-m-Y", strtotime($editresult['closerDate']));
$night=$editresult['night'];
$multiemails=$editresult['multiemails'];
$occupancyType=$editresult['occupancyType'];
$rooms=$editresult['rooms'];
$edithotelBudget=$editresult['hotelBudget'];
$expectedSales=$editresult['expectedSales'];
$leadsource=$editresult['leadsource'];
$campaign=$editresult['campaign'];
$competitor=$editresult['competitor'];
$subDestination=$editresult['subDestination'];
$single=$editresult['single'];
$doubleocp=$editresult['doubleocp'];
$triple=$editresult['triple'];
$infant = $editresult['infant'];
$age1 = clean($editresult['age1']);
$age2 = clean($editresult['age2']);
$age3 = clean($editresult['age3']);
$referanceno = clean($editresult['referanceno']);
$filecode = clean($editresult['filecode']);
}
if($editresult['closerDate']=='0000-00-00' || $closerDate==''){
$closerDate='';
}
if($_REQUEST['id']==''){
$clientType='1';
}

if($_GET['id']=='' && $_GET['incomingid']!='' && $_GET['email']!=''){



include('incomingMailSetting.php');


$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to domain:' . imap_last_error());

$emails = imap_search($inbox,'ALL');
if($emails){
$output = '';
rsort($emails);
$totalmail=0;
$n=1;
foreach($emails as $email_number) {

if($email_number==decode($_REQUEST['incomingid'])){




$subject='';
$message='';
$body='';
$email='';
$date='';


$overview = imap_fetch_overview($inbox,$email_number,0);
$subject = $subject=$overview[0]->subject;
$message='';
$message = (imap_fetchbody($inbox,$email_number,'2'));
if(str_replace('<br>','',$message)==''){
$message = (imap_fetchbody($inbox,$email_number,'1'));

}

 } }}





$incomingid=clean(decode($_GET['incomingid']));
$incomingQeuryId=clean($editresult['id']);
$editdescription=stripslashes($message);
$editsubject=stripslashes($subject);
$date = date('d-m-Y',strtotime($editresult['mailDate']));


$select1='*';
$where1='email="'.trim(decode($_GET['email'])).'" and sectionType="corporate"';
$rs1=GetPageRecord($select1,'emailMaster',$where1);
$editresultmail=mysqli_fetch_array($rs1);



 if($editresultmail['masterId']!=''){

$select1='*';

$where1='id='.trim($editresultmail['masterId']).'';
$rs1=GetPageRecord($select1,'corporateMaster',$where1);
$editresultCorporate=mysqli_fetch_array($rs1);

$editcompanyId = $editresultCorporate['id'];
$clientnem = stripslashes($editresultCorporate['name']);
$clientnemdisplay = $editresultCorporate['contactPerson'];
$getemail = $editresultCorporate['getemail'];





 $select1='*';
$where1='masterId='.trim($editcompanyId['id']).'';
$rs1=GetPageRecord($select1,'phoneMaster',$where1);
$editresultphone=mysqli_fetch_array($rs1);

$getphone = $editresultphone['phoneNo'];
$mailId=stripslashes($editresult['id']);

}
}



$hotelCategory='6';

$editassignTo=$_SESSION['userid'];


?>
<script src="tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector: "#description",
        themes: "modern",
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    });

    </script>

	<style>
.gridlable{width:100% !important;}
</style>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<div class="rightsectionheader">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><div class="headingm" style="margin-left:20px;"><span id="topheadingmain">
        <?php if($_GET['id']!=''){ ?>
        Update <?php if($_REQUEST['salesquery']==1){ echo 'Sales'; } ?>
        <?php } else { ?>
        Add <?php if($_REQUEST['salesquery']==1){ echo 'Sales'; } ?>
        <?php } ?>
          <?php echo $pageName; ?> </span></div></td>
      <td align="right"><table border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td></td>
            <td><input name="addnewuserbtn2" type="button" class="bluembutton submitbtn" id="addnewuserbtn2" value="Save" onclick="$('#loadQueryPackage').html('');formValidation('addeditquery','submitbtn','0');" /></td>
            <td><input type="button" name="Submit3" value="Save and New" class="whitembutton submitbtn"onclick="$('#loadQueryPackage').html('');formValidation('addeditquery','submitbtn','1');"/></td>
            <td style="padding-right:20px;">
<?php if($_REQUEST['salesquery']==1){ ?>
<a href="showpage.crm?module=leads"><input type="button" name="Submit22" value="Cancel" class="whitembutton"  /></a>
<?php } else { ?>
<input type="button" name="Submit22" value="Cancel" class="whitembutton" <?php if($_get['id']!=''){ ?>onclick="view('<?php echo $_GET['id']; ?>');"<?php } else { ?>onclick="cancel();"<?php } ?>  />
<?php } ?>
</td>
          </tr>
      </table></td>
    </tr>
  </table>
</div>
<div id="pagelisterouter" style="padding-left:0px;margin-top: -20px;">
<form action="frm_action.crm" method="post" enctype="multipart/form-data" name="addeditquery" target="actoinfrm" id="addeditquery">

<div class="addeditpagebox">
  <input name="action" type="hidden" id="action" value="<?php if($_GET['id']!=''){ echo 'editquery';} else { echo 'addquery'; } ?>" />
<?php if($_GET['id']=='' && $_GET['incomingid']!=''){ ?>



  <input name="incomingqueryId" type="hidden" id="incomingqueryId" value="<?php echo $_GET['incomingid']; ?>" />



	<?php } ?>
  <input name="savenew" type="hidden" id="savenew" value="0" />
  <table width="100%" border="0" cellpadding="0" cellspacing="0">

  <tr>
    <td width="33%" align="left" valign="top" style="padding-right:20px;">

	<div class="griddiv">
	<label> <div class="gridlable">Client Type   <span class="redmind"></span></div>
	<select id="clientType" name="clientType" class="gridfield validate" displayname="Client Type" autocomplete="off" onchange="selectclienttypename();"    >
	<option value="">Select</option>
	<option value="1" <?php if(1==$clientType){ ?>selected="selected"<?php } ?>>Agent</option>
	<option value="2" <?php if(2==$clientType){ ?>selected="selected"<?php } ?>>B2C</option>
	</select>
	</label>
	</div>
	<div class="griddiv" id="selectclientbox" style="display:<?php if($clientType!=''){ ?>block<?php } else { ?>none<?php } ?>; overflow:visible;"><img src="images/companyicon.png" width="30" height="30" style="position:absolute; right:0px; cursor:pointer; right:4px; top:26px;" onclick="openselectCompanypop();" />
	<label>
	<script>
	function openselectCompanypop(){
	var clientType1 = $('#clientType').val();
	var incoming_query_email = '<?php echo $query_email; ?>';
	var incoming_query_mobile = '<?php echo $query_mobile; ?>';
	alertspopupopen('action=selectCorporate&clientType='+clientType1+'&incoming_query_email='+incoming_query_email+'&incoming_query_mobile='+incoming_query_mobile+'','600px','auto');
	}

	function selectclienttypename(){

		<?php if($editresultmail['masterId']==''){ ?>

	$('#companyName').val('');



	$('#companyId').val('');



	$('#agentb2cmail').val('');



	$('#agentb2cnumber').val('');



	var clientType = $('#clientType').val();



	if(clientType>0){



	$('#selectclientbox').show();



	$('#banumber').show();



	$('#baemail').show();



	if(clientType==1){



	$('#agentTypeDiv').text('Agent');



	$('#agentTypeemail').text('Agent Email');



	$('#agentTypemobile').text('Agent Mobile No');



	}



	if(clientType==2){



	$('#agentTypeDiv').text('B2C');



	$('#agentTypeemail').text('B2C Email');



	$('#agentTypemobile').text('B2C Mobile No');



	}







	} else {



	$('#selectclientbox').hide();



	$('#banumber').hide();



	$('#baemail').hide();



	}







	<?php } ?>

	}

	</script>
	<?php
	if($clientType==2 && $editcompanyId!='' && $editcompanyId!='0'){







	$select2='*';



$where2='id='.$editcompanyId.'';



$rs2=GetPageRecord($select2,_CONTACT_MASTER_,$where2);



$contantnamemain=mysqli_fetch_array($rs2);







$clientnemdisplay = $contantnamemain['firstName'].' '.$contantnamemain['lastName'];



$clientnem = $contantnamemain['firstName'].' '.$contantnamemain['lastName'];



$getphone =  getPrimaryPhone($contantnamemain['id'],'contacts');



$getemail =  getPrimaryEmail($contantnamemain['id'],'contacts');



}



if($clientType==1 && $editcompanyId!='' && $editcompanyId!='0'){











$select2='*';



$where2='id='.$editcompanyId.'';



$rs2=GetPageRecord($select2,_CORPORATE_MASTER_,$where2);



$contantnamemain=mysqli_fetch_array($rs2);











$clientnemdisplay = $contantnamemain['contactPerson'];



$clientnem = getCorporateCompany($editcompanyId);



$getemail = getPrimaryEmail($editcompanyId,"corporate");



$getphone = getPrimaryPhone($editcompanyId,"corporate");







}



?>
	<div class="gridlable"><c id="agentTypeDiv">Agent / B2C</c><span class="redmind"></span></div>

	<div style="width:100%; position:relative;">
	<input name="companyName" type="text" class="gridfield validate" id="companyName" value="<?php echo $clientnem; ?>"   displayname="Company" autocomplete="off"  onkeydown="searchcompanynamefuncCompany();" />
	<style>

#getcompanyName {
    position: absolute;
    background-color: #f5f5f5;
    border: 1px solid #ccc;
    z-index: 99;
    top: 39px;
    left: 0px;
    width: 100%;
    overflow: auto;
    max-height: 240px;
    box-shadow: 2px 2px 7px #0000003d;
}
	</style>
	<div id="getcompanyName" style="display:none;">

	</div>
	</div>
	<script>

	function searchcompanynamefuncCompany(){
	var searchcompanyname = encodeURIComponent($('#companyName').val());
	var clientType = encodeURIComponent($('#clientType').val());
	if(clientType!='' && clientType!='0'){
	$('#getcompanyName').load('getcompanyName.php?clientType='+clientType+'&searchcompanyname='+searchcompanyname);
	}
	$('#getcompanyName').show();
	}

	function selectCorporateCompany(name,email,phone,id,opsPerson,opsPersonId,contactperson){
	$('#companyName').val(name);
	$('#agentb2cmail').val(email);
	$('#agentb2cnumber').val(phone);
	$('#companyId').val(id);
	$('#agentb2cname').val(contactperson);


	if(opsPerson!=''){
	$('#ownerName').val(opsPerson);
	$('#assignTo').val(opsPersonId);
	}else {
	$('#ownerName').val('');
	$('#assignTo').val('');
	}
	$('#getcompanyName').hide();
	}
	</script>
	<input name="companyId" type="hidden" id="companyId" value="<?php echo encode($editcompanyId); ?>" />
	</label>
	</div>
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%"><div class="griddiv" id="banumber" style="display:<?php if($clientType!=''){ ?>block<?php } else { ?>none<?php } ?>;"><label>
	<div class="gridlable" >
	  <c >Contact Person </c>
	</div>
	<input name="agentb2cname" type="text" class="gridfield" id="agentb2cname"  displayname=""  readonly=""  value="<?php echo $clientnemdisplay; ?>" />

	</label>
	</div></td>
    <td width="50%"><div class="griddiv" id="banumber" style="display:<?php if($clientType!=''){ ?>block<?php } else { ?>none<?php } ?>;"><label>
	<div class="gridlable" ><c id="agentTypemobile" >Agent / B2C</c></div>
	<input name="agentb2cnumber" type="text" class="gridfield" id="agentb2cnumber"  displayname=""  readonly=""  value="<?php echo $getphone; ?>" />

	</label>
	</div></td>
  </tr>
</table>



	<div class="griddiv" id="baemail" style="display:<?php if($clientType!=''){ ?>block<?php } else { ?>none<?php } ?>;"><label>
	<div class="gridlable" ><c id="agentTypeemail" >Agent / B2C</c></div>
	<input name="agentb2cmail" type="text" class="gridfield" id="agentb2cmail"  displayname="" readonly=""   value="<?php echo $getemail; ?>" />

	</label>
	</div>




	<div class="griddiv" style="display:none !important;"><label>
	<div class="gridlable">Sub Destination</div>
	<input name="subDestination" type="text" class="gridfield" id="subDestination"  displayname="Sub Destination"    value="<?php echo $subDestination; ?>" />
	</label>
	</div>
	<div class="griddiv"style="display:none;">
	<label>

	<script>
	function selectOpsPersonfunction(){
	var destinationId = $('#destinationId').val();
	if(destinationId>0){
	$('#selectOpsPerson').load('selectOpsPerson.php?id='+destinationId);
	}
	}
	</script>

	<div class="gridlable" >Hotel Category  </div>
	<select id="categoryId" name="categoryId" class="gridfield " displayname="Hotel Category" autocomplete="off"   >
	 <option value="">Select</option>
 <?php
$select='';
$where='';
$rs='';
$select='*';
$where=' deletestatus=0 and status=1 order by name asc';
$rs=GetPageRecord($select,_HOTEL_CATEGORY_MASTER_,$where);
while($resListing=mysqli_fetch_array($rs)){
?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editcategoryId){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
<?php } ?>
</select></label>
	</div><?php if($clientType==''){ ?>
	<div class="griddiv"><label>
	<div class="gridlable">Attachment</div>
	<input name="attachmentFile" type="file" class="gridfield" id="attachmentFile"/>
	</label>
	</div>
	<?php } ?>  <div class="griddiv"><label>
	<div class="gridlable">Subject <span class="redmind"></span></div>
	<input name="subject" type="text" class="gridfield validate" id="subject" value="<?php echo $editsubject; ?>"  displayname="Subject" maxlength="250" />
	</label>
	</div>		  </td>
    <td width="25%" align="left" valign="top" style="padding-right:20px; display:none;"> <div class="griddiv" ><label>
	<div class="gridlable">Guest 1 </div>
	<input name="guest1" type="text" class="gridfield"  id="guest1"  value="<?php echo $editguest1; ?>" maxlength="100" />
	</label>
	</div>

	<div class="griddiv"><label>
	<div class="gridlable">Guest 1 Phone</div>
	<input name="guest1phone" type="text" class="gridfield"  id="guest1phone"  value="<?php echo $guest1phone; ?>" maxlength="100" />
	</label>
	</div>

	<div class="griddiv" ><label>
	<div class="gridlable">Guest 1 Email</div>
	<input name="guest1email" type="text" class="gridfield"  id="guest1email"  value="<?php echo $guest1email; ?>" maxlength="100" />
	</label>
	</div>
		<div class="griddiv"><label>
	<div class="gridlable">Guest 2   </div>
	<input name="guest2" type="text" class="gridfield"  id="guest2"  value="<?php echo $editguest2; ?>" maxlength="100" />
	</label>
	</div>

	<div class="griddiv" style="display:none;">
	<label>
	<div class="gridlable">Office Branch<span class="redmind"></span></div>
	<select id="officeBranch" name="officeBranch" class="gridfield validate" displayname="Office Branch" autocomplete="off" >
	<option value="1" <?php if($editofficeBranch==1){ ?>selected="selected"<?php } ?>>Head Office</option>
 <option value="2" <?php if($editofficeBranch==2){ ?>selected="selected"<?php } ?>>Branch Office</option>
</select></label>
	</div>	  	</td>
    <td width="33%" align="left" valign="top" style="padding-left:20px;">
<!--<div id="loaddatedistination"></div>
	<div style="border: 1px #e0e0e0 solid; padding:5px; text-align:right; margin-bottom:10px;" id="adddatedistinationdiv"><a href="#" style=" font-size: 12px;
    background-color: #4CAF50;
    color: #fff !important;
    padding: 5px 8px;
    margin-right: -4px;" onclick="$('#destinationfields').show();$('#adddatedistinationdiv').hide();">+ Add Destination</a></div>-->


	<table width="100%" border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td colspan="2" align="left" valign="top"><div class="griddiv">
	<label>

<style>
.adddest{color: #fff !important;
    background-color: #4CAF50;
    display: block;
    float: left;
    text-decoration: none;
    padding: 6px;
    margin-top: 48px;
    margin-left: 2px;
    text-align: center;
    border-radius: 9px;}
</style>

	<div class="gridlable">From Date  <span class="redmind"></span></div>
<input name="fromDate1" type="text" id="fromDate1" class="gridfield calfieldicon" displayname="From Travel Date" autocomplete="off" value="<?php echo $editfromDate1; ?>" readonly="readonly" style="position: relative; top: auto; right: auto; bottom: auto; left: auto;">
 </div></td>
    <td width="33%" align="left" valign="top"><div class="griddiv">
	<label>



	<div class="gridlable">To Date <span class="redmind"></span></div>
<input name="toDate1" type="text" id="toDate1"  class="gridfield calfieldicon" displayname="To Travel Date" autocomplete="off" value="<?php echo $edittoDate1; ?>" readonly="readonly" style="position: relative; top: auto; right: auto; bottom: auto; left: auto;">
</label>
	</div></td>
 <td width="16%" align="left" valign="top"><div class="griddiv" style="width: 84px !important ;"><label>
	<div class="gridlable">Total Nights <span class="redmind"></span></div>
	<input name="night1" type="number" class="gridfield validate" id="night1"  style="width: 84px !important ;" maxlength="3" max="99" min="1"  displayname="Night"  readonly="readonly"   value="<?php  echo $night; ?>" />
	</label>
	</div>
 <td width="17%" align="left" valign="top"><a href="#" style="font-size: 12px; background-color: #4CAF50; color: #fff !important; padding: 10px 8px; margin-right: -4px; margin-top: 20px; display: block;  text-align: center; margin-left: 1px;" onclick="$('#destinationfields').show();$('#adddatedistinationdiv').hide();">+ Add</a>
  </tr>
</table>
<div id="loaddatedistination"></div>
	<div style="border: 1px #e0e0e0 solid; padding:5px; text-align:right; margin-bottom:10px;" id="adddatedistinationdiv"></div>




	<div id="destinationfields" style="display:none;">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
	<td width="103" align="left" valign="top"><div class="griddiv">
	<label>
	<select name="travelfromdestinationId" size="1" class="gridfield" id="travelfromdestinationId"   displayname="From Destination" autocomplete="off"  >
	 <option value="">Select</option>
 <?php
$select='';
$where='';
$rs='';
$select='*';
$where=' deletestatus=0 and status=1 order by name asc';
$rs=GetPageRecord($select,_DESTINATION_MASTER_,$where);
while($resListing=mysqli_fetch_array($rs)){
?>
<option value="<?php echo strip($resListing['id']); ?>"  ><?php echo strip($resListing['name']); ?></option>
<?php } ?>
</select>
	</label>
	</div></td>
    <td width="183" align="left" valign="top"><div class="griddiv">
	<label>
	<input name="fromDate" type="text" id="fromDate" class="gridfield calfieldicon"  displayname="From Travel Date" autocomplete="off" value="" />
	</label>
	</div></td>
    <td colspan="2" align="left" valign="top"><div class="griddiv">
	<label>
	<input name="toDate" type="text" id="toDate" class="gridfield calfieldicon" displayname="To Travel Date" autocomplete="off" value=""   />
	</label>
	</div></td>
	 </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td width="66" align="left" valign="top">&nbsp;</td>
    <td width="80" align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="left" valign="top"><div class="griddiv" style="margin-top: -15px;">
	<label>
	<div class="gridlable">Remarks Here<span class="redmind"></span></div>
	<input name="remarkDestination" type="text" id="remarkDestination"  class="gridfield"  displayname="Remarks..."   autocomplete="off" value="" />
	</label>
	</div></td>

    <td align="left" valign="top"><a href="#" onclick="adddestinations();" class="adddest" style="margin-top: 5px; padding: 10px; border-radius: 0px;">+&nbsp;Destination</a></td>
  </tr>
	 <div id="autoItinerary"></div>
	<tr>
    <td colspan="4" align="center" valign="top"></td>
  </tr>
</table>
</div>

	<script>
	function deletedestination(did){
	$('#loaddatedistination').load('loaddatedistination.php?id=<?php echo $lastqueryidmain; ?>&did='+did);
	}


function adddestinations(){
var fromDate = $('#fromDate').val();
var toDate = $('#toDate').val();

var fromDate2 = $('#fromDate1').val();
var todate2 = $('#toDate1').val();

/*============================================Days Count==============================================*/
var dates = fromDate;
var dates1 = dates.split("-");
var newDate = dates1[1]+"/"+dates1[0]+"/"+dates1[2];
var fromDateTimestamp = new Date(newDate).getTime();

var todates = toDate;
var todates1 = todates.split("-");
var tonewDate = todates1[1]+"/"+todates1[0]+"/"+todates1[2];
var toDateTimestamp = new Date(tonewDate).getTime();

var dayscount = Math.round((toDateTimestamp-fromDateTimestamp)/(1000*60*60*24)+1);

/*=====================================================================================================*/

var nightsdestination = Number(dayscount-1);
if(nightsdestination==0){ alert('Add Destination limit exceed..'); $('#fromDate').val(''); $('#toDate').val(''); return false;  }
if(fromDate < fromDate2){ alert('From Date should be greater than From travel date..'); $('#fromDate').val(''); $('#toDate').val(''); return false;  }
if(toDateTimestamp < fromDateTimestamp){ alert('To Date should be greater than From travel date..'); $('#fromDate').val(''); $('#toDate').val(''); return false;  }
if(toDate > todate2){ alert('To Date should be smaller from To travel date..'); $('#fromDate').val(''); $('#toDate').val(''); return false;  }




var travelfromdestinationId = $('#travelfromdestinationId').val();
var remarkDestination = $('#remarkDestination').val();
var remarkDestination = encodeURI(remarkDestination);

var night1 = $('#night1').val();
var night2 = Number(dayscount-1);
if(night1==night2){
$('#destinationfields').hide();
$('#suggestedItinerary').show();
}
 $('#autoItinerary').load('frmaction.php?cityId='+travelfromdestinationId+'&nights='+dayscount+'&action=addqueryhotelcity&packageId=<?php echo $lastqueryidmain; ?>');

$('#loaddatedistination').load('loaddatedistination.php?id=<?php echo $lastqueryidmain; ?>&fromDate='+fromDate+'&toDate='+toDate+'&travelfromdestinationId='+travelfromdestinationId+'&remarkDestination='+remarkDestination);

$('#fromDate').val(toDate);
$('#toDate').val(todate2);
$('#travelfromdestinationId').val('');
$('#remarkDestination').val('');


}


	$('#loaddatedistination').load('loaddatedistination.php?id=<?php echo $lastqueryidmain; ?>');

      function changefromdateto(){
      var fromDate = $('#fromDate').val();
      var toDate = $('#toDate').val();
      var closerDate = $('#closerDate').val(0);
      var night = $('#night').val(0);
        $('#toDate').val('');
        $('#toDate').val(fromDate);
        $('#night').val('');
        $('#night').val('1');
        $('#closerDate').val(fromDate);
      }
   </script>



	<div id="destinationfields" style="display:none;">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">


  <tr>
    <td width="33%" align="left" valign="top"><div class="griddiv">
	<label>

	<input name="fromDate" type="text" id="fromDate"  class="gridfield calfieldicon"  displayname="From Travel Date"   autocomplete="off" value="" />
	</label>
	</div></td>
    <td width="33%" align="left" valign="top"><div class="griddiv">
	<label>

	<input name="toDate" type="text" id="toDate" class="gridfield calfieldicon" displayname="To Travel Date" autocomplete="off" value=""   />
	</label>
	</div></td>
    <td width="32%" align="left" valign="top"><div class="griddiv">
	<label>

	<select name="travelfromdestinationId" size="1" class="gridfield" id="travelfromdestinationId"   displayname="From Destination" autocomplete="off"  >
	 <option value="">Select</option>
 <?php
$select='';
$where='';
$rs='';
$select='*';
$where=' deletestatus=0 and status=1 order by name asc';
$rs=GetPageRecord($select,_DESTINATION_MASTER_,$where);
while($resListing=mysqli_fetch_array($rs)){
?>
<option value="<?php echo strip($resListing['id']); ?>"  ><?php echo strip($resListing['name']); ?></option>
<?php } ?>
</select>
	</label>
	</div></td>
    <!--<td width="2%" align="center" valign="top"><a href="#" onclick="adddestinations();" style="color: #fff !important;
    background-color: #4CAF50;
    display: block;
    float: left;
    text-decoration: none;
    padding: 10px 7px;
    margin-top: 5px;">Add</a></td>-->
  </tr>

</table>
</div>

<!--	<script>
	function deletedestination(did){
	$('#loaddatedistination').load('loaddatedistination.php?id=<?php echo $lastqueryidmain; ?>&did='+did);
	}

	function adddestinations(){
	var fromDate = $('#fromDate').val();
	var toDate = $('#toDate').val();
	var travelfromdestinationId = $('#travelfromdestinationId').val();
	$('#loaddatedistination').load('loaddatedistination.php?id=<?php echo $lastqueryidmain; ?>&fromDate='+fromDate+'&toDate='+toDate+'&travelfromdestinationId='+travelfromdestinationId);
	$('#fromDate').val('');
	$('#toDate').val('');
	$('#travelfromdestinationId').val('');
	}


	$('#loaddatedistination').load('loaddatedistination.php?id=<?php echo $lastqueryidmain; ?>');

      function changefromdateto(){
      var fromDate = $('#fromDate').val();
      var toDate = $('#toDate').val();
      var closerDate = $('#closerDate').val(0);
      var night = $('#night').val(0);
        $('#toDate').val('');
        $('#toDate').val(fromDate);
        $('#night').val('');
        $('#night').val('1');
        $('#closerDate').val(fromDate);
      }
   </script>-->

<table width="100%" border="0" cellpadding="0" cellspacing="0" >

</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:15px; display:none;" >
  <tr>
    <td colspan="2" align="left" valign="top"><div class="griddiv">
	<label>

	<div class="gridlable">From Destination  <span class="redmind"></span></div>
	<select name="fromdestinationId" size="1" class="gridfield validate" id="fromdestinationId"   displayname="From Destination" autocomplete="off" >
	 <option value="">Select</option>
 <?php
$select='';
$where='';
$rs='';
$select='*';
$where=' deletestatus=0 and status=1 order by name asc';
$rs=GetPageRecord($select,_DESTINATION_MASTER_,$where);
while($resListing=mysqli_fetch_array($rs)){
?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($fromdestinationId==$resListing['id']){ echo 'selected="selected"'; } ?>><?php echo strip($resListing['name']); ?></option>
<?php } ?>
</select> </div></td>
    <td width="33%" align="left" valign="top"><div class="griddiv">
	<label>



	<div class="gridlable">To Destination  <span class="redmind"></span></div>
	<select name="destinationId[]" size="1"  class="gridfield validate" id="destinationId"  field_min_length="1"  displayname="To Destination" autocomplete="off" style="pointer-events:none;"  >
	 <option value="">Select</option>
 <?php
$select='';
$where='';
$rs='';
$select='*';
$where=' deletestatus=0 and status=1 order by name asc';
$rs=GetPageRecord($select,_DESTINATION_MASTER_,$where);
$newdata = explode(',', $destinationId);
while($resListing=mysqli_fetch_array($rs)){
?>
<option value="<?php echo strip($resListing['id']); ?>" <?php foreach ($newdata as $key => $value) { if($value == $resListing['id']){ echo 'selected="selected"'; } }?>><?php echo strip($resListing['name']); ?></option>
<?php } ?>
</select>
</label>
	</div></td>
 <td width="33%" align="left" valign="top"><div class="griddiv"><label>
	<div class="gridlable">Total Nights <span class="redmind"></span></div>
	<input name="night" type="number" class="gridfield validate" id="night" maxlength="3" max="99" min="1"  displayname="Night"  readonly="readonly"   value="<?php echo $night; ?>" />
	</label>
	</div></tr>
</table>

	<div class="griddiv">

	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>

    <td width="33%" align="left" valign="top"><label>
	<div class="gridlable">Adult<span class="redmind"></span></div>
	<input name="adult" type="text" class="gridfield validate" onKeyUp="numericFilter(this);" id="adult" displayname="Adult" value="<?php echo $editadult; ?>" maxlength="3" />
	</label></td>
    <td width="33%" align="left" valign="top"><label>
	<div class="gridlable">Child</div>
	<input name="child" type="text" class="gridfield" id="child" onKeyUp="numericFilter(this);appendchildage(5);" displayname="Child" value="<?php echo $editchild; ?>" maxlength="3" />
	</label></td>
    <td width="33%" align="left" valign="top"><label>
	<div class="gridlable">Infant</div>
	<input name="infant" type="text" class="gridfield" id="infant" onKeyUp="numericFilter(this);" displayname="Infant" value="<?php echo $infant; ?>" maxlength="3" />
	</label></td>
  </tr>
</table>
	</div>
	<div class="griddiv" id="childfielddiv" style="display:none;">
	<table width="100%" border="0" cellpadding="4" cellspacing="0">
  <tr>
  <script>


  var childnumber=1;
  function appendchildage(no){
   $('.childagedivchilds').html('');
  	var child=$('#child').val();
	if(child>0){
	$('#childfielddiv').show();
	}else{
	$('#childfielddiv').hide();
	}
	for(c=1;c<=child; c++)
	{
  $('#childagediv').append('<div style="float:left; margin-right:5px;margin-bottom:8px; width:24%;"><label><div class="gridlable" style="width:100%;">Child '+c+' Age</div><input name="childrensage[]" type="text" class="gridfield childage" id="childrensage'+c+'"  displayname="Child1 Age"  onKeyUp="numericFilter(this);calculateage('+c+');"  maxlength="2" value="<?php echo $age1; ?>" placeholder="Max Age 12 Years"/></label></div>');
  }
  childnumber++; }

  function calculateage(id){
  var childrensage = $('#childrensage'+id).val();
  if(childrensage>12){
  alert('Child age should not be greater than 12 years');
  $('#childrensage'+id).val('');
  }

  }
  </script>
    <td style="padding-left:0px;" id="childagediv" class="childagedivchilds">	</td>
  </tr>
</table>
	</div>






<table width="100%" border="0" cellpadding="0" cellspacing="0" style="display:none;">
  <tr>
    <td colspan="2" align="left" valign="top"></td>
    <td width="50%" align="left" valign="top">

	<div class="griddiv">
	<label>



	<div class="gridlable">Hotel Category  </div>
	<select id="hotelCategory" name="hotelCategory" class="gridfield" displayname="Hotel Category" autocomplete="off"   >
	<option value="0" >Select Category</option>
	 <?php
$select='';
$where='';
$rs='';
$select='*';
//$where=' id in (select roomType from '._DMC_ROOM_TARIFF_MASTER_.' where serviceid = '.$hotelId.') and deletestatus=0 and status=1 order by id asc';
$where=' status=1 order by id asc';
$rs=GetPageRecord($select,'hotelCategoryMaster',$where);
while($resListing=mysqli_fetch_array($rs)){
?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$hotelCategory){ ?>selected="selected"<?php } ?>  ><?php echo strip($resListing['name']); ?></option>
<?php } ?>
</select></label>
	</div>

	</td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><div class="griddiv">
	<label>



	<div class="gridlable">Package Type  <span class="redmind"></span></div>
	<select id="quotationYes" name="quotationYes" class="gridfield" displayname="Package Type" autocomplete="off"   >
	 <option value="0" <?php if($quotationYes=='0'){ ?>selected="selected"<?php  } ?>>Itinerary</option>
	 <option value="1" <?php if($quotationYes=='1'){ ?>selected="selected"<?php  } ?>>Quotation</option>
</select></label>
	</div></td>
    <td width="50%" align="left" valign="top"><div class="griddiv"><img src="images/userrole.png" style="position:absolute; right:0px; cursor:pointer; right:4px; top:26px;" onclick="alertspopupopen('action=selectParent&userType=1','600px','auto');" />
	<label>
	<div class="gridlable" style="width:100%;">Operations Person<span class="redmind"></span></div>
	<div id="selectOpsPerson"><input name="ownerName" type="text" class="gridfield validate" id="ownerName" value="<?php echo getUserName($editassignTo); ?>" readonly="true" displayname="Assign To" autocomplete="off" onclick="alertspopupopen('action=selectParent&userType=1','600px','auto');" />
	<input name="assignTo" type="hidden" id="assignTo" value="<?php echo encode($editassignTo); ?>" /></div>
	</label>
	</div></td>
  </tr>
</table>


	<div class="griddiv"><label>
	<div class="gridlable" style="width:100%;">Add More Emails  (Comma Separated Emails)   </div>
	<input name="multiemails" type="text" class="gridfield" id="multiemails" placeholder="test@example.com,test@example.com"   value="<?php echo $multiemails; ?>"/>
	</label>
	</div>
	<div class="griddiv"  style="display:none;">
	<label>

	<div class="gridlable">Show Service Price  <span class="redmind"></span></div>
	<select id="servicePrice" name="servicePrice" class="gridfield" autocomplete="off"   >
	 <option value="1">No</option>
	 <option value="2">Yes</option>
</select></label>
	</div>


	<div class="griddiv" style="display:none;">
	<label>

	<div class="gridlable">Attach Itinerary  <span class="redmind"></span></div>
	<select id="attachitinerary" name="attachitinerary" class="gridfield" autocomplete="off"   >
	 <option value="1">No</option>
	 <option value="2">Yes</option>
</select></label>
	</div>

	<script>
	function calroom(){
	var single = Number($('#single').val());
	var double = Number($('#double').val());
	var triple = Number($('#triple').val());
	$('#rooms').val('');
	$('#rooms').val(single+double+triple);
	}

	</script>








	<script>
	function selectstate(){
	var countryId = $('#countryId').val();
	$('#stateId').load('loadstate.php?id='+countryId+'&selectId=<?php echo $editcountryId; ?>');
	}

	function selectcity(){
	var stateId = $('#stateId').val();
	$('#cityId').load('loadcity.php?id='+stateId+'&selectId=<?php echo $editstateId; ?>');
	}

	<?php
	if($_GET['id']!=''){
	?>
	selectstate();
	selectcity();
	<?php } ?>
	</script>		 	 </td>
    <td width="33%" align="left" valign="top" style="padding-left:20px;">

	<div style="background-color:#f5f5f5; padding:10px; border:1px solid #f5f5f5; border:1px #ccc solid; cursor:pointer;" onclick="$('#showmorefield').toggle();">More Options</div>
	<div style="display:none; border:1px #ccc solid; padding:10px;border-top:0px; " id="showmorefield">

	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top"><div class="griddiv">
	<label>
	<div class="gridlable">Priority</div>
	<select id="queryPriority" name="queryPriority" class="gridfield"  autocomplete="off" >
	<option value="3">High</option>
	<option value="2" selected="selected">Medium</option>
 <option value="1">Low</option>
</select></label>
	</div></td>
    <td width="50%" align="left" valign="top"><div class="griddiv">
	<label>
	<div class="gridlable">TAT</div>
	<select id="tat" name="tat" class="gridfield"  autocomplete="off" >
	<option >None</option>
	<option value="30" selected="selected" >30 Minutes</option>
	<option value="45" >45 Minutes</option>
	<option value="60" >1 Hour</option>
	<option value="120" >2 Hour</option>
	<option value="240" >4 Hour</option>
	<option value="360" >6 Hour</option>
	<option value="480" >8 Hour</option>
	<option value="720" >12 Hour</option><!--
	<option value="<?php echo date("Y-m-d h:i:s", strtotime("+1 day")); ?>" >1 Day</option>
	<option value="<?php echo date("Y-m-d h:i:s", strtotime("+2 day")); ?>" >2 Day</option> -->
</select></label>
	</div></td>
  </tr>

</table>





	<div class="gridlable" style="display:none;">Occupancy Type  </div>
	<div class="griddiv" style="display:none;">
	<table width="100%" border="0" cellpadding="4" cellspacing="0">
  <tr>
    <td style="padding-left:0px;"><label>
	<div class="gridlable">Single  </div>
	<input name="single" type="text" class="gridfield" id="single"  displayname="Sub Destination"    value="<?php echo $single; ?>"  onkeyup="calroom();numericFilter(this);" /></label></td>
    <td><label>
	<div class="gridlable">Double  </div>
	<input name="double" type="text" class="gridfield" id="double"  displayname="Sub Destination"    value="<?php echo $doubleocp; ?>" onkeyup="calroom();numericFilter(this);"/></label></td>
    <td><label>
	<div class="gridlable">Triple  </div>
	<input name="triple" type="text" class="gridfield" id="triple"  displayname="Sub Destination"    value="<?php echo $triple; ?>" onkeyup="calroom();numericFilter(this);"/></label></td>
  </tr>
</table>
	</div>



	<div class="griddiv" style="display:none;">
	<label>



	<div class="gridlable">Occupancy Type  </div>
	<select id="occupancyType" name="occupancyType" class="gridfield" autocomplete="off"  onchange="setoccupancy();" >


<option value="1" <?php if(1==$occupancyType){ ?>selected="selected"<?php } ?>>Single</option>
<option value="2" <?php if(2==$occupancyType){ ?>selected="selected"<?php } ?>>Double</option>
<option value="3" <?php if(3==$occupancyType){ ?>selected="selected"<?php } ?>>Triple</option>
</select></label>
	</div>

	<script>
	function setoccupancy(){
	var adult = $('#adult').val();
	if(adult>0){
	var occupancyType = $('#occupancyType').val();
	if(occupancyType==1){
	$('#rooms').val(adult);
	}

	if(occupancyType==2){
	adult=Math.ceil(Number(adult/2));
	$('#rooms').val(adult);
	}

	if(occupancyType==3){
	adult=Math.ceil(Number(adult/3));
	$('#rooms').val(adult);
	}
	}
	}
	</script>

	<div class="griddiv" style="display:none;"><label>
	<div class="gridlable">Rooms</div>
	<input name="rooms" type="text" class="gridfield" onKeyUp="numericFilter(this);" id="rooms" displayname="Rooms"   value="<?php echo $rooms; ?>" maxlength="3" />
	</label>
	</div>
	<script>
	calroom();
	</script>
	<div class="griddiv" style="display:none;"><label>
	<div class="gridlable">Hotel Budget</div>
	<input name="hotelBudget" type="text" class="gridfield" id="hotelBudget" onKeyUp="numericFilter(this);"  value="<?php echo $edithotelBudget; ?>" maxlength="10" />
	</label>
	</div>
	<div class="griddiv" style="display:none;"><label>
	<div class="gridlable">Payment Mode</div>
	<select id="paymentMode" name="paymentMode" class="gridfield"  autocomplete="off" >
      <option value="1">BTC</option>
      <option value="2">Direct Payment</option>
    </select>
	</label>
	</div>



	<div class="griddiv" style="display:none;"><label>
	<div class="gridlable" style="width:100%;">Reference No.</div>
	<input name="referanceno" type="text" class="gridfield" id="referanceno" placeholder="Referance No."   value="<?php echo $referanceno; ?>"/>
	</label>
	</div>
	 <div class="griddiv" style="display:none;"><label>
	<div class="gridlable" style="width:100%;">File Code </div>
	<input name="filecode" type="text" class="gridfield" id="filecode"   value="<?php echo $filecode; ?>"/>
	</label>
	</div>
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><div class="griddiv"><label><div class="gridlable">Tour Type <span class="redmind"></span></div>
	<select id="tourType" name="tourType" class="gridfield validate" displayname="Tour Type" autocomplete="off"   >
	 <option value="10">Holiday Packages</option>
 <?php
$select='';
$where='';
$rs='';
$select='*';
$where=' deletestatus=0 and status=1 order by name asc';
$rs=GetPageRecord($select,_TOUR_TYPE_MASTER_,$where);
while($resListing=mysqli_fetch_array($rs)){
?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$edittourType){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
<?php } ?>
</select></label>
	</div></td>
    <td width="50%"><div class="griddiv"><label>
	<div class="gridlable">Lead Source</div>
	<select id="leadsource" name="leadsource" class="gridfield"  autocomplete="off" >
      <option value="0">Select</option>
	  <?php
	  	$selectl='';
		$wherel='';
		$rsl='';
		$selectl='*';
		$wherel=' status=1 order by name asc';
		$rsl=GetPageRecord($selectl,_LEADSSOURCE_MASTER_,$wherel);
		while($resListingl=mysqli_fetch_array($rsl)){
	   ?>
      <option value="<?php echo strip($resListingl['id']); ?>" <?php if($resListingl['id']==$leadsource){ ?>selected="selected"<?php } ?>><?php echo strip($resListingl['name']); ?></option>
	  <?php } ?>
    </select>
	</label>
	</div></td>
  </tr>
</table>
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2">




	</td>
    <td width="50%"></td>
  </tr>
</table>


	<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>

     <td colspan="2" align="left" valign="top"><div class="griddiv">
	<label>



	<div class="gridlable">Hotel   </div>
	<select id="hotelAccommodation" name="hotelAccommodation" class="gridfield" displayname="Package Type" autocomplete="off"   >
	 <option value="1" <?php if($hotelAccommodation=='1'){ ?>selected="selected"<?php  } ?>>Yes</option>
	 <option value="0" <?php if($hotelAccommodation=='0'){ ?>selected="selected"<?php  } ?>>No</option>
</select></label>
	</div></td>
    <td colspan="2" align="left" valign="top"><div class="griddiv">
	<label>



	<div class="gridlable">Need Flight / Train  <span class="redmind"></span></div>
	<select id="needFlight" name="needFlight" class="gridfield" displayname="Package Type" autocomplete="off"   >
	 <option value="1" <?php if($needFlight=='1'){ ?>selected="selected"<?php  } ?>>Yes</option>
	 <option value="0" <?php if($needFlight=='0'){ ?>selected="selected"<?php  } ?>>No</option>
</select></label>
	</div></td>
    <td width="33%" align="left" valign="top"><div class="griddiv">
	<label>



	<div class="gridlable">Cab / Transfer <span class="redmind"></span></div>
	<select id="cabforLocal" name="cabforLocal" class="gridfield" displayname="Package Type" autocomplete="off"   >
	 <option value="1" <?php if($cabforLocal=='1'){ ?>selected="selected"<?php  } ?>>Yes</option>
	 <option value="0" <?php if($cabforLocal=='0'){ ?>selected="selected"<?php  } ?>>No</option>
</select></label>
	</div></td>
  </tr>
</table>

</div>
	</td>
  </tr>
  <tr>
    <td colspan="4" align="left" valign="top"></td>
  </tr>
  <tr>

      <tr align="left" valign="top">
	<td></td>
</tr>
      <tr align="left" valign="top">&nbsp;</tr>
      <tr>
        <td colspan="4" align="left" valign="top" id="loadQueryPackage" style="display:none;" >Loading...</td>
<!--<script>
	function funloadQueryPackage(){
	var night = $('#night').val();
	var fromDate = $('#fromDate').val();
	$('#loadQueryPackage').load('loadQueryPackage.php?id=<?php echo $lastqueryidmain; ?>&night='+night+'&fromDate='+fromDate);
	}
    funloadQueryPackage();
	var night = $('#night').val();

	function deleteItinerary(){
	var r=confirm("Are you sure want to delete this Itinerary?");
    if (r==true)
    {
		$('#loadQueryPackage').load('loadQueryPackage.php?id=<?php echo $lastqueryidmain; ?>&dlt=1&night='+night);
	}
	}
</script>-->
      </tr>
      <td colspan="4" align="left" valign="top">
      <h2 style="margin-bottom:0px; margin-top:20px; padding:20px; background-color:#f5f5f5; border: 1px #ccc solid; cursor:pointer;" onclick="salesopncls();"><span id="plusminus"><?php if($_REQUEST['salesquery']==1){ echo '+'; } else { echo '-'; } ?></span> Sales Information</h2>

	  <div style="padding:20PX; background-color:#fbfbfb; border:1px solid #ccc;" id="mainsalesmodule"><table width="100%" border="0" cellpadding="0" cellspacing="0">
       <tr>
    <td width="50%" align="left" valign="top"style="padding-right:20px;"><div class="griddiv"><label>
	<div class="gridlable">Budget</div>
	<input name="expectedSales" type="text" class="gridfield" id="expectedSales" onKeyUp="numericFilter(this);"  value="<?php echo $expectedSales; ?>" maxlength="15" />
	</label>
	</div>



	<div class="griddiv">
	<label>



	<div class="gridlable">Competitor</div>
	<select id="competitor" name="competitor" class="gridfield" autocomplete="off"   >
<option>Select</option>
<?php
$select='';
$where='';
$rs='';
$select='*';
$where='id!="" order by id';
$rs=GetPageRecord($select,_COMPETITOR_MASTER_,$where);
while($rest=mysqli_fetch_array($rs)){
?>
<option value="<?php echo $rest['id']; ?>" <?php if($competitor==$rest['id']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>
<?php } ?>
</select>

</label>
	</div>





	</td>
    <td width="50%" align="left" valign="top"style="padding-left:20px;" ><div class="griddiv">
	<label>
	<div class="gridlable">Expected Closer Date<span class="redmind"></span></div>
	<input name="closerDate" type="text" id="closerDate" class="gridfield calfieldicon"  displayname="Expected Closer Date"   autocomplete="off" value="<?php echo $closerDate; ?>" />
	<?php if($closerDate=='' || $closerDate=='0000-00-00'){ ?>
	<script>
	$('#closerDate').val('');
	</script>
	<?php } ?>
	</label>
	</div>
	<div class="griddiv">
	<label>



	<div class="gridlable">Campaign  </div>
	<select id="campaign" name="campaign" class="gridfield" autocomplete="off"   >
<option>Select</option>
<?php
$select='';
$where='';
$rs='';
$select='*';
$where='id!="" order by id';
$rs=GetPageRecord($select,_CAMPAIN_MASTER_,$where);
while($rest=mysqli_fetch_array($rs)){
?>
<option value="<?php echo $rest['id']; ?>" <?php if($campaign==$rest['id']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>
<?php } ?>
</select>

</label>
	</div>	</td>
  </tr>

    </table></div>

	<script>
	function salesopncls(){
	var plusminus = $('#plusminus').text();
	if(plusminus=='+'){
	$('#mainsalesmodule').show();
	$('#plusminus').text('-');
	} else {
	$('#mainsalesmodule').hide();
	$('#plusminus').text('+');
	}

	}

	salesopncls();
	</script> </td>
  </tr>


  <tr>
    <td colspan="4" align="left" valign="top">



	<div class="griddiv"><label>
	<div class="gridlable">Description</div>
	<textarea name="description" rows="10" class="gridfield" id="description"><?php echo $editdescription; ?></textarea>
	</label>
	</div></td>
    </tr>
</table>
</div>
<div class="rightfootersectionheader"><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right"><table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td>
		<input name="editId" type="hidden" id="editId" value="<?php if($lastqueryidmain!=''){ echo encode($lastqueryidmain); } ?>" />
		<input name="salesquery" type="hidden" id="salesquery" value="<?php echo $_REQUEST['salesquery']; ?>" />
		<input name="queryedityes" type="hidden" id="queryedityes" value="<?php if($clientType!=''){ echo 'yes'; } else { echo 'no'; }?>" />

		<input name="editedityes" type="hidden" id="editedityes" value="1" /><input name="action2" type="hidden" id="action2" value="addQueryCost" />
	 <input name="mailId" type="hidden" id="mailId" value="<?php echo decode($_REQUEST['incomingid']); ?>" />
		</td>
        <td><input name="addnewuserbtn" type="button" class="bluembutton submitbtn" id="addnewuserbtn" value="Save" onclick="$('#loadQueryPackage').html('');formValidation('addeditquery','submitbtn','0');" />






		<input name="totalQueryCost" type="hidden" id="totalQueryCost" value="0" />
		</td>
        <td><input type="button" name="Submit" value="Save and New" class="whitembutton submitbtn"onclick="$('#loadQueryPackage').html('');formValidation('addeditquery','submitbtn','1');"/></td>
        <td style="padding-right:20px;"><?php if($_REQUEST['salesquery']==1){ ?>
<a href="showpage.crm?module=leads"><input type="button" name="Submit22" value="Cancel" class="whitembutton"  /></a>
<?php } else { ?>
<input type="button" name="Submit22" value="Cancel" class="whitembutton" <?php if($_get['id']!=''){ ?>onclick="view('<?php echo $_GET['id']; ?>');"<?php } else { ?>onclick="cancel();"<?php } ?>  />
<?php } ?></td>
      </tr>

    </table></td>
  </tr>

</table>
</div>

</form>

</div>
<script>
   function changePriority(){
   var adult = $('#adult').val();
   if(adult>9){
   $('#queryPriority').val('3');
   }


   }

   window.setInterval(function(){
   changePriority()
   }, 1000);



   comtabopenclose('linkbox','op2');

   function toTimestamp(strDate){
      var datum = Date.parse(strDate);
      return datum/1000;
   }



   function showDays(firstDate,secondDate){
                     var startDay = new Date(firstDate);
                     var endDay = new Date(secondDate);
                     var millisecondsPerDay = 1000 * 60 * 60 * 24;

                     var millisBetween = startDay.getTime() - endDay.getTime();
                     var days = millisBetween / millisecondsPerDay;

                     // Round down.
                     return ( Math.floor(days));

                 }



   function changedatefunction(){
     var fromDate = $('#fromDate').val().split("-").reverse().join("-");
     var toDate = $('#toDate').val().split("-").reverse().join("-");


     var fromDatestamp = toTimestamp(''+fromDate+'');
     var toDatestamp = toTimestamp(''+toDate+'');

    /*if(fromDate!= '' && fromDate!= '' && fromDatestamp>= toDatestamp)
       {
       alert("Please ensure that the To Travel Date is greater than From Travel Date.");
       $('#toDate').val('');
       }*/
     var totaldays = showDays(toDate,fromDate);
     if(totaldays!='' || totaldays=='0'){
     $('#night').val(totaldays);


     var date = new Date(fromDate);
       var newdate = new Date(date);

       newdate.setDate(newdate.getDate() - 7);

       var dd = newdate.getDate();
       var mm = newdate.getMonth() + 1;
       var y = newdate.getFullYear();

       var someFormattedDate = ('0'+dd).slice(-2) + '-' + ('0'+mm).slice(-2) + '-' + y;

     $('#closerDate').val(someFormattedDate);

     var night = totaldays;
   if(night<6){
   $('#queryPriority').val('3');
   }
     }
   }

    function changedatefromtodate(){
      // $('#payment_due_date').val($('#toDate').val());
     var fromDate = $('#fromDate').val().split("-").reverse().join("-");
     var toDate = $('#toDate').val().split("-").reverse().join("-");
    var editId = $('#editId').val();
     $.ajax({
            url:"walker.php",
            method:"POST",
            data:{tod:toDate,editId:editId},
            success:function(data){}

         });

     var fromDatestamp = toTimestamp(''+fromDate+'');
     var toDatestamp = toTimestamp(''+toDate+'');

    if(fromDate!= '' && fromDate!= '' && fromDatestamp> toDatestamp)
       {
       alert("Please ensure that the To Travel Date is greater than From Travel Date.");
       $('#toDate').val('');
       }
     var totaldays = showDays(toDate,fromDate);
     if(totaldays!=''){
     $('#night').val(totaldays);


     var date = new Date(fromDate);
       var newdate = new Date(date);

       newdate.setDate(newdate.getDate() - 6);

       var dd = newdate.getDate();
       var mm = newdate.getMonth() + 1;
       var y = newdate.getFullYear();

       var someFormattedDate = ('0'+dd).slice(-2) + '-' + ('0'+mm).slice(-2) + '-' + y;

     $('#closerDate').val(someFormattedDate);

     var night = totaldays;
   if(night<6){
   $('#queryPriority').val('3');
   }
     }
     if( totaldays==''){
     $('#night').val(1);


     var date = new Date(fromDate);
       var newdate = new Date(date);

       newdate.setDate(newdate.getDate() - 6);

       var dd = newdate.getDate();
       var mm = newdate.getMonth() + 1;
       var y = newdate.getFullYear();

       var someFormattedDate = ('0'+dd).slice(-2) + '-' + ('0'+mm).slice(-2) + '-' + y;

     $('#closerDate').val(someFormattedDate);

     var night = totaldays;
   if(night<6){
   $('#queryPriority').val('3');
   }
     }
   }
   <?php if($_REQUEST['id']=='' && $filecode==''){ ?>selectclienttypename();<?php }?>

function changeintienery(){
}
 fillincomingdata();
 changedatefromtodate();
 selectOpsPersonfunction();
</script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.js"></script>
<script src="plugins/select2/select2.full.min.js"></script>
<script>
  $(document).ready(function() {
  $('.select2').select2();

  });
  </script>
<style>
.addeditpagebox .griddiv .Zebra_DatePicker_Icon_Wrapper {
    width: 100% !important;
}
</style>
<?php if($_REQUEST['id']==''){



?>



<script>



//selectclienttypename();



</script>



<?php } ?>

