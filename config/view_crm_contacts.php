<?php
if($viewpermission!=1 && $_GET['id']!=''){
header('location:'.$fullurl.'');
}



if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,_CONTACT_MASTER_,$where1);
$editresult=mysqli_fetch_array($rs1);

$editassignTo=clean($editresult['assignTo']);
$editcontacttitleId=clean($editresult['contacttitleId']);
$editfirstName=clean($editresult['firstName']);
$editlastName=clean($editresult['lastName']);
$editdesignationId=clean($editresult['designationId']);
$editbirthDate=clean($editresult['birthDate']);
$editanniversaryDate=clean($editresult['anniversaryDate']);
$editcompanyTypeId=clean($editresult['companyTypeId']);
$editcountryId=clean($editresult['countryId']);
$editstateId=clean($editresult['stateId']);
$editcityId=clean($editresult['cityId']);
$edittitle=clean($editresult['title']);
$addedBy=clean($editresult['addedBy']);
$dateAdded=clean($editresult['dateAdded']);
$modifyBy=clean($editresult['modifyBy']);
$modifyDate=clean($editresult['modifyDate']);
$editsupId=clean($editresult['id']);
$editaddress1=clean($editresult['address1']);
$editaddress2=clean($editresult['address2']);
$editaddress3=clean($editresult['address3']);
$editpinCode=clean($editresult['pinCode']);
$editfacebook=clean($editresult['facebook']);
$edittwitter=clean($editresult['twitter']);
$editlinkedIn=clean($editresult['linkedIn']);
}


if($editassignTo!=''){

$select1='firstName,lastName,id';
$where1='id='.$editassignTo.'';
$rs1=GetPageRecord($select1,_USER_MASTER_,$where1);
$editOwnerresult=mysqli_fetch_array($rs1);

$assignfullName=strip($editOwnerresult['firstName'].' '.$editOwnerresult['lastName']);
$assignfullId=encode($editOwnerresult['id']);

}
?>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<div class="rightsectionheader"><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><div class="headingm" style="margin-left:20px;"><table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td style="padding-right:10px;"><img src="images/backicon.png" width="20" onclick="cancel();" style=" cursor:pointer;" /> </td>
    <td><?php echo $editfirstName.' '.$editlastName; ?></td>
  </tr>

</table>
</div></td>
    <td align="right"><?php if($editpermission==1){ ?><table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td style="padding-right:20px;"><input type="button" name="Submit2" value="Edit" class="whitembutton" onclick="edit('<?php echo $_GET['id']; ?>');" /></td>
      </tr>

    </table><?php } ?></td>
  </tr>

</table>
</div>

<div id="pagelisterouter" style="padding-left:0px;">

 <div class="addeditpagebox vieweditpagebox">
   <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top" ><div class="innerbox">
      <h2>Contact Information</h2>
    </div></td>
    </tr>
  <tr>
    <td width="50%" align="left" valign="top" style="padding-right:20px;">
	<div class="griddiv">
	  <div class="gridlable">Full Name</div>
	  <div class="gridtext"><?php echo getNameTitle($editcontacttitleId).' '.$editfirstName.' '.$editlastName; ?></div>
	</label>
	</div>
	<div class="griddiv" style="display:none;"><label><div class="gridlable">Designation</div>
	<div class="gridtext"><?php echo getDesignation($editdesignationId); ?></div>

	</label>
	</div>

	<div class="griddiv"><label><div class="gridlable">Date of Birth</div>
	<div class="gridtext"><?php if($editbirthDate=='1970-01-01'){ }else{ echo date("d-m-Y", strtotime($editbirthDate)); } ?></div>
	<!-- <div class="gridtext"><?php if($editbirthDate!=''){ echo date("d-m-Y", strtotime($editbirthDate)); } ?></div> -->

	</label>
	</div>

 <div class="griddiv"><label><div class="gridlable">Anniversary Date</div>
 	<div class="gridtext"><?php if($editanniversaryDate=='1970-01-01'){ }else{ echo date("d-m-Y", strtotime($editanniversaryDate)); } ?></div>
	<!-- <div class="gridtext"><?php if($editanniversaryDate!=''){ echo date("d-m-Y", strtotime($editanniversaryDate)); } ?></div> -->

	</label>
	</div>

	 <div class="griddiv"><label>
	 <div class="gridlable">Mobile / Landline / Fax</div>
	 <div class="gridtext">
  <?php
$phonen=1;
$select='';
$where='';
$rs='';
$select='*';
$where=' masterId='.$id.' and sectionType="contacts" order by id asc';
$rs=GetPageRecord($select,_PHONE_MASTER_,$where);
while($resListing=mysqli_fetch_array($rs)){

?>
  <div style="margin-bottom:2px;">
    <?php echo $resListing['phoneNo']; ?><span style="color:#7b7b7b; font-size:12px;"> - <?php echo getPhoneType($resListing['phoneType']); ?> <?php if($resListing['primaryvalue']==1){ ?><img src="images/greencheck.png" style="position: absolute; margin-left: 8px;" /><?php } ?></span>  </div>
  <?php } ?>
</div>

	</label>
	</div>


	 <div class="griddiv"><label>
	 <div class="gridlable">Email</div>
	 <div class="gridtext">
  <?php
$phonen=1;
$select='';
$where='';
$rs='';
$select='*';
$where=' masterId='.$id.' and sectionType="contacts" order by id asc';
$rs=GetPageRecord($select,_EMAIL_MASTER_,$where);
while($resListing=mysqli_fetch_array($rs)){

?>
  <div style="margin-bottom:2px;">
    <a href="mailto:<?php echo $resListing['email']; ?>"><?php echo $resListing['email']; ?></a><span style="color:#7b7b7b; font-size:12px;"> - <?php echo getEmailType($resListing['emailType']); ?> <?php if($resListing['primaryvalue']==1){ ?><img src="images/greencheck.png" style="position: absolute; margin-left: 8px;"/><?php } ?></span>  </div>
  <?php } ?>
</div>

	</label>
	</div>




	 	<div class="griddiv"><label>
	<div class="gridlable">Created By </div>
		<div class="gridtext"><?php
$select='';
$where='';
$rs='';
$select='firstName,lastName';
$where='id="'.$addedBy.'"';
$rs=GetPageRecord($select,_USER_MASTER_,$where);
while($userss=mysqli_fetch_array($rs)){

echo $userss['firstName'].' '.$userss['lastName'];

}
?><div style="font-size:12px; margin-top:2px; color:#999999;"><?php echo showdatetime($dateAdded,$loginusertimeFormat);?></div>
</div>
	</label>
	</div>


	<?php if($modifyDate!='0'){ ?>
	<div class="griddiv"><label>
	<div class="gridlable">Modified By </div>
		<div class="gridtext"><?php
$select='';
$where='';
$rs='';
$select='firstName,lastName';
$where='id="'.$modifyBy.'"';
$rs=GetPageRecord($select,_USER_MASTER_,$where);
while($userss=mysqli_fetch_array($rs)){

echo $userss['firstName'].' '.$userss['lastName'];

}
?>
<div style="font-size:12px; margin-top:2px; color:#999999;"><?php if($modifyDate!='0'){ echo showdatetime($modifyDate,$loginusertimeFormat); } ?></div>
</div>
	</label>
	</div>
	<?php } ?>	<div class="griddiv" style="border-bottom:0px;">
	<strong>Contact Documents</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a onclick="alertspopupopen('action=addeditdocument&sectionType=contacts&masterId=<?php echo $_GET['id']; ?>','700px','auto');"  style="text-decoration:underline; position:absolute; right:0px;">+ Add Document</a>
	  <form action="frm_action.crm" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm" style="display:none;">
	  <input name="uploaddocuments" type="file" id="uploaddocuments" onchange="uploaddocumentfunc();" />
	  <input name="editId" type="hidden" id="editId" value="<?php echo $_GET['id']; ?>" />
	  <input name="action" type="hidden" id="action" value="attachdocument" />
	  <input name="sectionType" type="hidden" id="sectionType" value="contacts" />
	  </form>
	  <script>
	  function deletedocument(id){
	   $('#loaddocuments').html('<div style="text-align:center; padding:10px; backgroud-color:#fff;"><img src="images/ajax-loader.gif" /></div>');

	  $('#loaddocuments').load('loaddocuments.php?id=<?php echo $id; ?>&dltid='+id+'&sectionType='+$('#sectionType').val());
	  }

	  function deleteconfirm(id){
	  if (confirm("Do you want to delete this document?")){
    deletedocument(id);
}
	  }

	  function uploaddocumentfunc(){
	  $('#addeditfrm').submit();
	  $('#loaddocuments').html('<div style="text-align:center; padding:10px; backgroud-color:#fff;"><img src="images/ajax-loader.gif" /></div>');
	  }

	  $('#my-button').click(function(){
    $('#uploaddocuments').click();
});
	  function loaddocumentfunc(){
$('#loaddocuments').load('loaddocuments.php?id=<?php echo $id; ?>&sectionType='+$('#sectionType').val());
}
	  </script>
	  </div>
	 </td>
    <td width="50%" align="left" valign="top" style="padding-left:20px;">
<div class="griddiv"><label><div class="gridlable">Country</div>
	<div class="gridtext"><?php echo getCountryName($editcountryId); ?></div>

	</label>
	</div>	<div class="griddiv"><label><div class="gridlable">State</div>
	<div class="gridtext"><?php echo getStateName($editstateId); ?></div>

	</label>
	</div>

	  <div class="griddiv">
	    <div class="gridlable">City </div>
	    <div class="gridtext">

<?php echo getCityName($editcityId); ?></div>
	 </label>
	</div>

	<div class="griddiv">
	  <div class="gridlable">Address 1 </div>
	  <div class="gridtext">

<?php echo $editaddress1; ?></div>
	 </label>
	</div>

	<div class="griddiv"><label>
	<div class="gridlable">Address 2</div>
		<div class="gridtext"><?php echo $editaddress2; ?></div>
	</label>
	</div>
	 <div class="griddiv">
	   <label> </label>
	   <div class="gridlable">Address 3 </div>
	   <div class="gridtext"><?php echo $editaddress3; ?></div>
	   </div>

	  <div class="griddiv">
	   <label> </label>
	   <div class="gridlable">Pin Code  </div>
	   <div class="gridtext"><?php echo $editpinCode; ?></div>
	   </div><div class="griddiv"><div class="gridlable">Sales&nbsp;Person </div><div class="gridtext">

<?php echo getUserName($editassignTo); ?></div>
	 </label>
	</div>

	<?php if($editfacebook!=''){ ?>
	<div class="griddiv">
	  <div class="gridlable">Facebook  </div>
	  <div class="gridtext">

<a href="<?php echo $editfacebook; ?>" target="_blank"><img src="images/facebookprofile.png" /></a>

</div>
	 </label>
	</div>
	<?php } ?>

	<?php if($edittwitter!=''){ ?>
	<div class="griddiv">
	  <div class="gridlable">Twitter  </div>
	  <div class="gridtext">

<a href="<?php echo $edittwitter; ?>" target="_blank"><img src="images/twitterprofile.png" /></a>

</div>
	 </label>
	</div>
	<?php } ?>


	<?php if($editlinkedIn!=''){ ?>
	<div class="griddiv">
	  <div class="gridlable">LinkedIn  </div>
	  <div class="gridtext">

<a href="<?php echo $editlinkedIn; ?>" target="_blank"><img src="images/linkedprofile.png" /></a>

</div>
	 </label>
	</div>
	<?php } ?>


		    </td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top" style="padding-right:20px;" id="loaddocuments">Loading... </td>

  </tr>

  <tr>
    <td colspan="2" align="left" valign="top"  >
    	<div class="innerbox" style="border-top:1px #eee solid; padding-top:30px;">
      		<h2>Bank Details &nbsp;&nbsp;&nbsp;<a  onclick="alertspopupopen('action=addeditbankinfo&sectionType=contacts&masterId=<?php echo $_GET['id']; ?>','700px','auto');" style="text-decoration:underline; font-size:13px;">+ Add Bank Detail</a>
      		</h2>
    	</div>
	</td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top" style="padding-right:20px;" >&nbsp; </td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top" style="padding-right:20px;" id="loadbankdetails">Loading...</td>
    </tr>

	<tr>
    <td colspan="2" align="left" valign="top" style="padding-right:20px;" >&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top" style="padding-right:20px;" id="loadsalesmodule" >Loading...</td>
  </tr>
</table>
<script>
	   	loaddocumentfunc();

	   </script>
<script>
function funloadsalesmodule(){
$('#loadsalesmodule').load('loadsalesmodule.php?id=<?php echo $editsupId; ?>&clientType=2&parentType=lead');
}
funloadsalesmodule();


function deletebank(id){
	   $('#loadbankdetails').html('<div style="text-align:center; padding:10px; backgroud-color:#fff;"><img src="images/ajax-loader.gif" /></div>');
	  $('#loadbankdetails').load('loadbankdetails.php?id=<?php echo $id; ?>&dltid='+id+'&sectionType='+$('#sectionType').val());
	  }

	  function deleteconfirmbank(id){
	  if (confirm("Do you want to delete this bank detail?")){
    deletebank(id);
}
	  }

function loadbankdetailsfunc(){
$('#loadbankdetails').load('loadbankdetails.php?id=<?php echo $id; ?>&sectionType='+$('#sectionType').val());
}
loadbankdetailsfunc();

</script>

</div>



</div>
<script>
comtabopenclose('linkbox','op2');
</script>

<?php
include "config/mail.php";
$email = getPrimaryEmail($editresult['id'],'contacts');
$status = 'subscribed'; // "subscribed" or "unsubscribed" or "cleaned" or "pending"
$list_id = '5b7106e07c'; // where to get it read above
$merge_fields = array('FNAME' => ''.$editfirstName.'','LNAME' => ''.$editlastName.'','ADDRESS' => 'delhi','PHONE' => ''.getPrimaryPhone($editresult['id'],'contacts').'');
rudr_mailchimp_subscriber_status($email, $status, $list_id, $merge_fields);
?>
