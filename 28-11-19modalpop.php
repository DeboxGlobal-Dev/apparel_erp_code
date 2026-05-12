<?php
include "inc.php";
?>


<?php if($_REQUEST['action']=='addemailaccount'){

if($_REQUEST['id']!=''){
$select='*';
 $where='id="'.$_REQUEST['id'].'"';
$rs=GetPageRecord($select,_EMAIL_SETTING_MASTER_,$where);
$emailsetting=mysqli_fetch_array($rs);


 }

 ?>


	<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
		<div class="card-body">

									<div class="row">


										<div class="col-md-12">
											<div class="form-group">
												<label>Name</label>
				                                <input name="from_name" type="text" class="form-control" id="from_name" value="<?php echo $emailsetting['from_name']; ?>">
			                                </div>
										</div>
									</div>


	<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Email</label>
				                                <input name="email" type="text" class="form-control" id="email" value="<?php echo $emailsetting['email']; ?>">
			                                </div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Password </label>
				                                <input name="password" type="password" class="form-control" id="password" value="<?php echo $emailsetting['password']; ?>">
			                                </div>
										</div>


		  </div>

<div class="row">

										<div class="col-md-12">
											<div class="form-group">
												<label>SMTP Server</label>

												<input name="smtp_server" type="text" class="form-control" id="smtp_server" value="<?php echo $emailsetting['smtp_server']; ?>">
			                                </div>
										</div>
<div class="col-md-4">
											<div class="form-group">
												<label>Outgoing Port</label>

												<input name="port" type="number" class="form-control" id="port" value="<?php echo $emailsetting['port']; ?>">
			                                </div>
	  </div><div class="col-md-4">
											<div class="form-group">
												<label>Incoming Port</label>

												<input name="incomingPort" type="number" class="form-control" id="incomingPort" value="<?php echo $emailsetting['incomingPort']; ?>">
			                                </div>
										</div><div class="col-md-4">
											<div class="form-group">
												<label>Security Type</label>

											<select id="security_type" name="security_type" class="form-control validate" displayname="Security Type" autocomplete="off">
											<option value="false" <?php if($emailsetting['security_type']=='false'){ ?>selected="selected"<?php } ?>>None</option>
<option value="true" <?php if($emailsetting['security_type']=='true'){ ?>selected="selected"<?php } ?>>SSL</option>
											</select>
			                                </div>
										</div>



		  </div>

	      </div>




		<div class="modal-footer">
		<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
		<button type="submit" class="btn bg-info">  Save  </button>
		</div>
		<input name="action" type="hidden" id="action" value="addemailaccount">
		<input name="editId" type="hidden" id="editId" value="<?php echo  ($_REQUEST['id']); ?>">
		</form>
<?php } ?>





<?php if($_REQUEST['action']=='addcall'){

$fromDate=date("d-m-Y");
$toDate=date("d-m-Y");

$editassignTo=$_SESSION['userid'];

if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,_CALLS_MASTER_,$where1);
$editresult=mysqli_fetch_array($rs1);

$editassignTo=clean($editresult['assignTo']);
$editcompanyId=clean($editresult['companyId']);
$edittravelDate=clean($editresult['travelDate']);
$editfromDate=clean($editresult['fromDate']);
$edittoDate=clean($editresult['toDate']);
$editofficeBranch=clean($editresult['officeBranch']);
$destinationId=clean($editresult['destinationId']);
$editdescription=clean($editresult['description']);
$editremark=clean($editresult['remark']);
$editsubject=clean($editresult['subject']);
$addedBy=clean($editresult['addedBy']);
$dateAdded=clean($editresult['dateAdded']);
$modifyBy=clean($editresult['modifyBy']);
$modifyDate=clean($editresult['modifyDate']);
$lastId=$editresult['id'];
$lastqueryidmain=$editresult['id'];
$fromDate=date("d-m-Y", strtotime($editresult['fromDate']));
$toDate=date("d-m-Y", strtotime($editresult['toDate']));
$night=$editresult['night'];
$editstarttime=$editresult['starttime'];
$editendtime=$editresult['endtime'];
$followupdate=$editresult['followupdate'];
$directiontype=$editresult['directiontype'];
$campaign=$editresult['campaign'];
$leadsource=$editresult['leadsource'];
$clientType=$editresult['clientType'];
$statusedit=$editresult['status'];
}


 ?>


		<form action="ac.de" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
		<div class="card-body">
			                <div class="row">


										<div class="col-md-8">
											<div class="form-group">
												<label>Subject</label>
				                                <input name="subject" type="text" class="form-control" id="subject" value="<?php echo $editsubject; ?>"  displayname="Subject" maxlength="200" />
			                                </div>
										</div>

										 	<div class="col-md-4">
											<div class="form-group">
												<label>Status</label>
				                                <select id="status" name="status" class="form-control" autocomplete="off"   >

<?php

$select='';

$where='';

$rs='';

$select='*';

$where='id!="" order by id';

$rs=GetPageRecord($select,_CALLS_STATUS_MASTER_,$where);

while($rest=mysqli_fetch_array($rs)){

?>

<option value="<?php echo $rest['id']; ?>" <?php if($statusedit==$rest['id']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

<?php } ?>





</select>
			                                </div>
										</div>

									</div>



	<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label>Start Date</label>
				                                <input name="fromDate" type="text" class="form-control daterange-single" id="fromDate" value="<?php echo $fromDate; ?>">
			                                </div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Start Time</label>
				                                <select id="starttime" name="starttime" class="form-control" autocomplete="off"   >

<?php

$start=strtotime('00:00');

   $end=strtotime('23:30');



    for ($i=$start;$i<=$end;$i = $i + 15*60)

    { ?>

   <option value="<?php echo date('g:i A',$i); ?>" <?php if('10:00 AM'==date('g:i A',$i) && $_REQUEST['id']==''){ ?> selected="selected"<?php } ?> <?php if($editstarttime==date('g:i A',$i)){ ?> selected="selected"<?php } ?>><?php echo date('g:i A',$i); ?></option>

    <?php  }  ?>





</select>
			                                </div>
										</div>

										<div class="col-md-3">
											<div class="form-group">
												<label>End Date </label>
				                                <input name="toDate" type="text" class="form-control" id="toDate" value="<?php echo $toDate; ?>">
			                                </div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>End Time </label>
				                                <select id="endtime" name="endtime" class="form-control" autocomplete="off"   >

<?php

$start=strtotime('00:00');

   $end=strtotime('23:30');



    for ($i=$start;$i<=$end;$i = $i + 15*60)

    { ?>

    <option value="<?php echo date('g:i A',$i); ?>" <?php if('11:00 AM'==date('g:i A',$i) && $_REQUEST['id']==''){  ?> selected="selected"<?php } ?> <?php if($editendtime==date('g:i A',$i)){ ?> selected="selected"<?php } ?>><?php echo date('g:i A',$i); ?></option>

    <?php  }  ?>





</select>
			                                </div>
										</div>

		  </div>

		  <div class="row">


										<div class="col-md-4">
											<div class="form-group">
												<label>Client Type</label>
				                                <select id="clientType" name="clientType" class="form-control" displayname="Client Type" autocomplete="off" onchange="relatedtocompany();"    >
<option value="" <?php if(1==$clientType){ ?>selected="selected"<?php } ?>>Select</option>
<option value="1" <?php if(1==$clientType){ ?>selected="selected"<?php } ?>>Account</option>
<option value="2" <?php if(2==$clientType){ ?>selected="selected"<?php } ?>>Contact</option>
</select>
			                                </div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label>Related To</label>
				                                <select id="parentId" name="parentId" class="form-control" displayname="Client Type" autocomplete="off">
												<?php

												if($clientType!=''){

 if($clientType=='1'){
$select='';
$where='';
$rs='';
$select='*';
$where=' name!=""';
$rs=GetPageRecord($select,'accountsMaster',$where);
while($resListing=mysqli_fetch_array($rs)){

?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($editcompanyId==$resListing['id']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
<?php } } else {

$select='';
$where='';
$rs='';
$select='*';
$where=' firstName!=""';
$rs=GetPageRecord($select,'contactsMaster',$where);
while($resListing=mysqli_fetch_array($rs)){

?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($editcompanyId==$resListing['id']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['firstName']); ?> <?php echo strip($resListing['lastName']); ?></option>
<?php } }  }?>
</select>

<script>
function relatedtocompany(){
var clientType = $('#clientType').val();
$('#parentId').load('relatedtocompany.php?clientType='+clientType);
}
</script>
			                                </div>
										</div>


										<div class="col-md-4">
											<div class="form-group">
												<label>Assigned To</label>
				                                <select name="assignTo" class="form-control" id="assignTo">

 <?php
$select='';
$where='';
$rs='';
$select='firstName,id';
$where=' deletestatus=0  order by firstName asc';
$rs=GetPageRecord($select,_USER_MASTER_,$where);
while($resListing=mysqli_fetch_array($rs)){

?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editassignTo){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['firstName']); ?></option>
<?php } ?>
</select>

<script>
function relatedtocompany(){
var clientType = $('#clientType').val();
$('#parentId').load('relatedtocompany.php?clientType='+clientType);
}
</script>
			                                </div>
										</div>
									</div>

<div class="row">

										<div class="col-md-12">
											<div class="form-group">
												<label>Description</label>

												<textarea name="description" rows="3" class="form-control" id="description"><?php echo $editdescription; ?></textarea>
			                                </div>
										</div>




		  </div>

	      </div>




		<div class="modal-footer">
		<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
		<button type="submit" class="btn bg-info">  Save  </button>
		</div>
		<input name="action" type="hidden" id="action" value="editcalls" />
		<input name="editId" type="hidden" id="editId" value="<?php echo  ($_REQUEST['id']); ?>">
		</form>

		<script>
		$('#fromDate').Zebra_DatePicker({
		format: 'd-m-Y',
		});
				$('#toDate').Zebra_DatePicker({
		format: 'd-m-Y',
		});

		</script>
<?php } ?>


<?php if($_REQUEST['action']=='addmeeting'){
$editassignTo=$_SESSION['userid'];
$fromDate=date("d-m-Y");
$toDate=date("d-m-Y");

if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'meetingsMaster',$where1);
$editresult=mysqli_fetch_array($rs1);

$editassignTo=clean($editresult['assignTo']);
$editcompanyId=clean($editresult['companyId']);
$edittravelDate=clean($editresult['travelDate']);
$editfromDate=clean($editresult['fromDate']);
$edittoDate=clean($editresult['toDate']);
$editofficeBranch=clean($editresult['officeBranch']);
$destinationId=clean($editresult['destinationId']);
$editdescription=clean($editresult['description']);
$editremark=clean($editresult['remark']);
$editsubject=clean($editresult['subject']);
$addedBy=clean($editresult['addedBy']);
$dateAdded=clean($editresult['dateAdded']);
$modifyBy=clean($editresult['modifyBy']);
$modifyDate=clean($editresult['modifyDate']);
$lastId=$editresult['id'];
$lastqueryidmain=$editresult['id'];
$fromDate=date("d-m-Y", strtotime($editresult['fromDate']));
$toDate=date("d-m-Y", strtotime($editresult['toDate']));
$night=$editresult['night'];
$editstarttime=$editresult['starttime'];
$editendtime=$editresult['endtime'];
$followupdate=$editresult['followupdate'];
$directiontype=$editresult['directiontype'];
$campaign=$editresult['campaign'];
$leadsource=$editresult['leadsource'];
$clientType=$editresult['clientType'];
$statusedit=$editresult['status'];
}


 ?>


		<form action="ac.de" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
		<div class="card-body">
			                <div class="row">


										<div class="col-md-8">
											<div class="form-group">
												<label>Meeting Agenda</label>
				                                <input name="subject" type="text" class="form-control" id="subject" value="<?php echo $editsubject; ?>"  displayname="Subject" maxlength="200" />
			                                </div>
										</div>

										 	<div class="col-md-4">
											<div class="form-group">
												<label>Status</label>
				                                <select id="status" name="status" class="form-control" autocomplete="off"   >

<?php

$select='';

$where='';

$rs='';

$select='*';

$where='id!="" order by id';

$rs=GetPageRecord($select,_CALLS_STATUS_MASTER_,$where);

while($rest=mysqli_fetch_array($rs)){

?>

<option value="<?php echo $rest['id']; ?>" <?php if($statusedit==$rest['id']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

<?php } ?>





</select>
			                                </div>
										</div>

									</div>



	<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label>Start Date</label>
				                                <input name="fromDate" type="text" class="form-control daterange-single" id="fromDate" value="<?php echo $fromDate; ?>">
			                                </div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Start Time</label>
				                                <select id="starttime" name="starttime" class="form-control" autocomplete="off"   >

<?php

$start=strtotime('00:00');

   $end=strtotime('23:30');



    for ($i=$start;$i<=$end;$i = $i + 15*60)

    { ?>

   <option value="<?php echo date('g:i A',$i); ?>" <?php if('10:00 AM'==date('g:i A',$i) && $_REQUEST['id']==''){ ?> selected="selected"<?php } ?> <?php if($editstarttime==date('g:i A',$i)){ ?> selected="selected"<?php } ?>><?php echo date('g:i A',$i); ?></option>

    <?php  }  ?>





</select>
			                                </div>
										</div>

										<div class="col-md-3">
											<div class="form-group">
												<label>End Date </label>
				                                <input name="toDate" type="text" class="form-control" id="toDate" value="<?php echo $toDate; ?>">
			                                </div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>End Time </label>
				                                <select id="endtime" name="endtime" class="form-control" autocomplete="off"   >

<?php

$start=strtotime('00:00');

   $end=strtotime('23:30');



    for ($i=$start;$i<=$end;$i = $i + 15*60)

    { ?>

    <option value="<?php echo date('g:i A',$i); ?>" <?php if('11:00 AM'==date('g:i A',$i) && $_REQUEST['id']==''){  ?> selected="selected"<?php } ?> <?php if($editendtime==date('g:i A',$i)){ ?> selected="selected"<?php } ?>><?php echo date('g:i A',$i); ?></option>

    <?php  }  ?>





</select>
			                                </div>
										</div>

		  </div>

		  <div class="row">


										<div class="col-md-4">
											<div class="form-group">
												<label>Client Type</label>
				                                <select id="clientType" name="clientType" class="form-control" displayname="Client Type" autocomplete="off" onchange="relatedtocompany();"    >
<option value="" <?php if(1==$clientType){ ?>selected="selected"<?php } ?>>Select</option>
<option value="1" <?php if(1==$clientType){ ?>selected="selected"<?php } ?>>Account</option>
<option value="2" <?php if(2==$clientType){ ?>selected="selected"<?php } ?>>Contact</option>
</select>
			                                </div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label>Related To</label>
				                                <select id="parentId" name="parentId" class="form-control" displayname="Client Type" autocomplete="off">
												<?php

												if($clientType!=''){

 if($clientType=='1'){
$select='';
$where='';
$rs='';
$select='*';
$where=' name!=""';
$rs=GetPageRecord($select,'accountsMaster',$where);
while($resListing=mysqli_fetch_array($rs)){

?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($editcompanyId==$resListing['id']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
<?php } } else {

$select='';
$where='';
$rs='';
$select='*';
$where=' firstName!=""';
$rs=GetPageRecord($select,'contactsMaster',$where);
while($resListing=mysqli_fetch_array($rs)){

?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($editcompanyId==$resListing['id']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['firstName']); ?> <?php echo strip($resListing['lastName']); ?></option>
<?php } }  }?>
</select>

<script>
function relatedtocompany(){
var clientType = $('#clientType').val();
$('#parentId').load('relatedtocompany.php?clientType='+clientType);
}
</script>
			                                </div>
										</div>


										<div class="col-md-4">
											<div class="form-group">
												<label>Assigned To</label>
				                                <select name="assignTo" class="form-control" id="assignTo">

 <?php
$select='';
$where='';
$rs='';
$select='firstName,id';
$where=' deletestatus=0  order by firstName asc';
$rs=GetPageRecord($select,_USER_MASTER_,$where);
while($resListing=mysqli_fetch_array($rs)){

?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editassignTo){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['firstName']); ?></option>
<?php } ?>
</select>

<script>
function relatedtocompany(){
var clientType = $('#clientType').val();
$('#parentId').load('relatedtocompany.php?clientType='+clientType);
}
</script>
			                                </div>
										</div>
									</div>

<div class="row">

										<div class="col-md-12">
											<div class="form-group">
												<label>Description</label>

												<textarea name="description" rows="3" class="form-control" id="description"><?php echo $editdescription; ?></textarea>
			                                </div>
										</div>




		  </div>

	      </div>




		<div class="modal-footer">
		<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
		<button type="submit" class="btn bg-info">  Save  </button>
		</div>
		<input name="action" type="hidden" id="action" value="editmeetings" />
		<input name="editId" type="hidden" id="editId" value="<?php echo  ($_REQUEST['id']); ?>">
		</form>

		<script>
		$('#fromDate').Zebra_DatePicker({
		format: 'd-m-Y',
		});
				$('#toDate').Zebra_DatePicker({
		format: 'd-m-Y',
		});

		</script>
<?php } ?>





<?php if($_REQUEST['action']=='addtask'){
$editassignTo=$_SESSION['userid'];
$fromDate=date("d-m-Y");
$toDate=date("d-m-Y");

if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'tasksMaster',$where1);
$editresult=mysqli_fetch_array($rs1);

$editassignTo=clean($editresult['assignTo']);
$editcompanyId=clean($editresult['companyId']);
$edittravelDate=clean($editresult['travelDate']);
$editfromDate=clean($editresult['fromDate']);
$edittoDate=clean($editresult['toDate']);
$editofficeBranch=clean($editresult['officeBranch']);
$destinationId=clean($editresult['destinationId']);
$editdescription=clean($editresult['description']);
$editremark=clean($editresult['remark']);
$editsubject=clean($editresult['subject']);
$addedBy=clean($editresult['addedBy']);
$dateAdded=clean($editresult['dateAdded']);
$modifyBy=clean($editresult['modifyBy']);
$modifyDate=clean($editresult['modifyDate']);
$lastId=$editresult['id'];
$lastqueryidmain=$editresult['id'];
$fromDate=date("d-m-Y", strtotime($editresult['fromDate']));
$toDate=date("d-m-Y", strtotime($editresult['toDate']));
$night=$editresult['night'];
$editstarttime=$editresult['starttime'];
$editendtime=$editresult['endtime'];
$followupdate=$editresult['followupdate'];
$directiontype=$editresult['directiontype'];
$campaign=$editresult['campaign'];
$leadsource=$editresult['leadsource'];
$clientType=$editresult['clientType'];
$statusedit=$editresult['status'];
}


 ?>


		<form action="ac.de" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
		<div class="card-body">
			                <div class="row">


										<div class="col-md-8">
											<div class="form-group">
												<label>Subject</label>
				                                <input name="subject" type="text" class="form-control" id="subject" value="<?php echo $editsubject; ?>"  displayname="Subject" maxlength="200" />
			                                </div>
										</div>

										 	<div class="col-md-4">
											<div class="form-group">
												<label>Status</label>
				                                <select id="status" name="status" class="form-control" autocomplete="off"   >

<?php

$select='';

$where='';

$rs='';

$select='*';

$where='id!="" order by id';

$rs=GetPageRecord($select,_CALLS_STATUS_MASTER_,$where);

while($rest=mysqli_fetch_array($rs)){

?>

<option value="<?php echo $rest['id']; ?>" <?php if($statusedit==$rest['id']){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>

<?php } ?>





</select>
			                                </div>
										</div>

									</div>



	<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label>Start Date</label>
				                                <input name="fromDate" type="text" class="form-control daterange-single" id="fromDate" value="<?php echo $fromDate; ?>">
			                                </div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Start Time</label>
				                                <select id="starttime" name="starttime" class="form-control" autocomplete="off"   >

<?php

$start=strtotime('00:00');

   $end=strtotime('23:30');



    for ($i=$start;$i<=$end;$i = $i + 15*60)

    { ?>

   <option value="<?php echo date('g:i A',$i); ?>" <?php if('10:00 AM'==date('g:i A',$i) && $_REQUEST['id']==''){ ?> selected="selected"<?php } ?> <?php if($editstarttime==date('g:i A',$i)){ ?> selected="selected"<?php } ?>><?php echo date('g:i A',$i); ?></option>

    <?php  }  ?>





</select>
			                                </div>
										</div>

										<div class="col-md-3">
											<div class="form-group">
												<label>End Date </label>
				                                <input name="toDate" type="text" class="form-control" id="toDate" value="<?php echo $toDate; ?>">
			                                </div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>End Time </label>
				                                <select id="endtime" name="endtime" class="form-control" autocomplete="off"   >

<?php

$start=strtotime('00:00');

   $end=strtotime('23:30');



    for ($i=$start;$i<=$end;$i = $i + 15*60)

    { ?>

    <option value="<?php echo date('g:i A',$i); ?>" <?php if('11:00 AM'==date('g:i A',$i) && $_REQUEST['id']==''){  ?> selected="selected"<?php } ?> <?php if($editendtime==date('g:i A',$i)){ ?> selected="selected"<?php } ?>><?php echo date('g:i A',$i); ?></option>

    <?php  }  ?>





</select>
			                                </div>
										</div>

		  </div>

		  <div class="row">


										<div class="col-md-4">
											<div class="form-group">
												<label>Client Type</label>
				                                <select id="clientType" name="clientType" class="form-control" displayname="Client Type" autocomplete="off" onchange="relatedtocompany();"    >
<option value="">Select</option>
<option value="1" <?php if(1==$clientType){ ?>selected="selected"<?php } ?>>Account</option>
<option value="2" <?php if(2==$clientType){ ?>selected="selected"<?php } ?>>Contact</option>
</select>
			                                </div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label>Related To</label>
				                                <select id="parentId" name="parentId" class="form-control" displayname="Client Type" autocomplete="off">
												 <option value="0" >Select Related To</option>
												<?php

												if($clientType!='' && $clientType>0){

 if($clientType=='1'){
$select='';
$where='';
$rs='';
$select='*';
$where=' name!=""';
$rs=GetPageRecord($select,'accountsMaster',$where);
while($resListing=mysqli_fetch_array($rs)){

?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($editcompanyId==$resListing['id']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
<?php } } else {

$select='';
$where='';
$rs='';
$select='*';
$where=' firstName!=""';
$rs=GetPageRecord($select,'contactsMaster',$where);
while($resListing=mysqli_fetch_array($rs)){

?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($editcompanyId==$resListing['id']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['firstName']); ?> <?php echo strip($resListing['lastName']); ?></option>
<?php } }  }?>
</select>

<script>
function relatedtocompany(){
var clientType = $('#clientType').val();
$('#parentId').load('relatedtocompany.php?clientType='+clientType);
}
</script>
			                                </div>
										</div>


										<div class="col-md-4">
											<div class="form-group">
												<label>Assigned To</label>
				                                <select name="assignTo" class="form-control" id="assignTo">

 <?php
$select='';
$where='';
$rs='';
$select='firstName,id';
$where=' deletestatus=0  order by firstName asc';
$rs=GetPageRecord($select,_USER_MASTER_,$where);
while($resListing=mysqli_fetch_array($rs)){

?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editassignTo){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['firstName']); ?></option>
<?php } ?>
</select>

<script>
function relatedtocompany(){
var clientType = $('#clientType').val();
$('#parentId').load('relatedtocompany.php?clientType='+clientType);
}
</script>
			                                </div>
										</div>
									</div>

<div class="row">

										<div class="col-md-12">
											<div class="form-group">
												<label>Description</label>

												<textarea name="description" rows="3" class="form-control" id="description"><?php echo $editdescription; ?></textarea>
			                                </div>
										</div>




		  </div>

	      </div>




		<div class="modal-footer">
		<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
		<button type="submit" class="btn bg-info">  Save  </button>
		</div>
		<input name="action" type="hidden" id="action" value="edittasks" />
		<input name="editId" type="hidden" id="editId" value="<?php echo  ($_REQUEST['id']); ?>">
		</form>

		<script>
		$('#fromDate').Zebra_DatePicker({
		format: 'd-m-Y',
		});
				$('#toDate').Zebra_DatePicker({
		format: 'd-m-Y',
		});

		</script>
<?php } ?>







<?php if($_REQUEST['action']=='adduser'){

if($_GET['id']!=''){
 $id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,_USER_MASTER_,$where1);
$editresult=mysqli_fetch_array($rs1);

$editfirstName=clean($editresult['firstName']);
$editlastName=clean($editresult['lastName']);
$editEmail=clean($editresult['email']);
$editPhone=clean($editresult['phone']);
$editPassword=clean($editresult['password']);
$editMobile=clean($editresult['mobile']);
$editStreet=clean($editresult['street']);
$editCity=clean($editresult['city']);
$editState=clean($editresult['state']);
$editZip=clean($editresult['zip']);
$editCountry=clean($editresult['country']);
$editNoofusers=clean($editresult['noofusers']);
$editServerspace=clean($editresult['serverspace']);
$editExpireDate=$editresult['expiryDate'];
$editCurrency=clean($editresult['currency']);
$editTimezone=clean($editresult['timeZone']);
$editTimeformat=clean($editresult['timeFormat']);
$editroleId=clean($editresult['roleId']);
$editprofileId=clean($editresult['profileId']);
$edituserType=clean($editresult['userType']);
$editdestinationList=clean($editresult['destinationList']);
$editemployee=clean($editresult['empId']);
}

if($_REQUEST['empid']!=''){

$select12='*';
$where12='id='.$_REQUEST['empid'].'';
$rs12=GetPageRecord($select12,_EMPLOYEE_MASTER_,$where12);
$editresult12=mysqli_fetch_array($rs12);

$editfirstName=clean($editresult12['name']);

$editEmail=clean($editresult12['email']);
$editPhone=clean($editresult12['phone']);
$editemployee=clean($_REQUEST['empid']);
}


 ?>


	 <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
		<div class="card-body">

			                <div class="row">


										<div class="col-md-6">
											<div class="form-group">
												<label>First Name</label>
				                                <input name="firstName" type="text" class="form-control" id="firstName" value="<?php echo $editfirstName; ?>"    maxlength="200" />
			                                </div>
										</div>

										 	<div class="col-md-6">
											<div class="form-group">
												<label>Last Name</label>
												<input name="lastName" type="text" class="form-control" id="lastName" value="<?php echo $editlastName; ?>"    maxlength="200" />

			                                </div>
										</div>

									</div>



	<div class="row">
										<div class="col-md-<?php if($_GET['id']!=''){ ?>6<?php }else{ ?>12<?php } ?>">
										  <div class="form-group">
												<label>Email</label>
											    <input name="email" type="text" class="form-control" id="email" value="<?php echo $editEmail; ?>"   maxlength="200" />
										  </div>
										</div>

										<?php if($_GET['id']!=''){ ?>
										<div class="col-md-6">
											<div class="form-group">
												<label>Password</label>
				                                <input name="password" type="password" class="form-control" id="password" value="<?php echo $editPassword; ?>"    maxlength="200" />   										</div>
										</div>
										<?php } ?>



		  </div>

		  <div class="row">


										<!--<div class="col-md-6">
											<div class="form-group">
												<label>Role</label>
				                                <select name="roleId" class="form-control" id="roleId">

 <?php
$select='';
$where='';
$rs='';
$select='*';
$where=' deletestatus=0  order by name asc';
$rs=GetPageRecord($select,'roleMaster',$where);
while($resListing=mysqli_fetch_array($rs)){

?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editroleId){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
<?php } ?>
</select>
			                                </div>
										</div>-->

										<div class="col-md-6">
											<div class="form-group">
												<label>Phone</label>
				                                <input name="phone" type="text" class="form-control" id="phone" value="<?php echo $editPhone; ?>"    maxlength="200" />
			                                </div>
										</div>

										<!--<div class="col-md-4">
											<div class="form-group">
												<label>Employee</label>
				                                <select id="userType" name="userType" class="form-control">
 													<option value="" <?php if('0'==$edituserType){ ?>selected="selected"<?php } ?>>Sales Person</option>
													<option value="0" <?php if('0'==$edituserType){ ?>selected="selected"<?php } ?>>Sales Person</option>
													<option value="1" <?php if('1'==$edituserType){ ?>selected="selected"<?php } ?>>Operations Person</option>
												</select>


			                                </div>
										</div>-->

										<div class="col-md-6">
											<div class="form-group">
												<label>Status</label>
				                                <select id="status" name="status" class="form-control">

<option value="1" <?php if('1'==$editresult['status']){ ?>selected="selected"<?php } ?>>Active</option>
<option value="0" <?php if('0'==$editresult['status']){ ?>selected="selected"<?php } ?>>Inactive</option>
</select>


			                                </div>
										</div>


							</div>

				<div class="row">

	<div class="col-md-6">
											<div class="form-group">
												<label>Profile</label>
				                                <select id="profileId" name="profileId" class="form-control" displayname="Profile" autocomplete="off" >
												<option value="">Select Profile</option>

 <?php
$select='';
$where='';
$rs='';
$select='*';

$where=' deletestatus=0 order by profileName asc';
$rs=GetPageRecord($select,'profileMaster',$where);
while($timeformat=mysqli_fetch_array($rs)){
?>

<option value="<?php echo strip($timeformat['id']); ?>" <?php if($timeformat['id']==$editprofileId){ ?>selected="selected"<?php } ?>><?php echo strip($timeformat['profileName']); ?></option>
<?php }  ?>
</select>


			                                </div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Employee</label>
												<select id="empId" name="empId" class="form-control">
													<option value="">Select Employee</option>
													<?php
													$select='*';
													$where=' deletestatus=0 and status=1 order by name asc';
													$rs=GetPageRecord($select,_EMPLOYEE_MASTER_,$where);
													while($resListing=mysqli_fetch_array($rs)){
													?>
													<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editemployee){ ?>selected="selected"<?php } ?> ><?php echo strip($resListing['name']); ?></option>
													<?php } ?>
												</select>
											</div>
										</div>




									</div>



<div class="row">






		  </div>

	      </div>




		<div class="modal-footer">
		<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
		<?php if(decode($_REQUEST['id'])!='1'){ ?><button type="submit" class="btn bg-info">  Save  </button><?php } ?>
		</div>
		<?php if(decode($_REQUEST['id'])!='1'){ ?><input name="action" type="hidden" id="action" value="edituser" />
		<input name="editId" type="hidden" id="editId" value="<?php echo ($_REQUEST['id']); ?>"><?php } ?>
		</form>
<?php } ?>










<?php if($_REQUEST['action']=='adddestination'){
if($_GET['id']!=''){
 $id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'destinationMaster',$where1);
$editresult=mysqli_fetch_array($rs1);

}

 ?>


		<form action="ac.de" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
		<div class="card-body">
			                <div class="row">


										<div class="col-md-6">
											<div class="form-group">
												<label>Country</label>

										  <select id="countryId" name="countryId" class="form-control">
 <?php
$select='';
$where='';
$rs='';
$select='*';
$where=' name!="" order by id asc';
$rs=GetPageRecord($select,'countryMaster',$where);
while($resListing=mysqli_fetch_array($rs)){
?>
<option value="<?php echo strip($resListing['id']); ?>"  <?php if($resListing['id'] == $editresult['countryId']){ echo 'selected="selected"';  } ?>><?php echo strip($resListing['name']); ?></option>
<?php } ?>
</select>


			                                </div>
										</div>

										 	<div class="col-md-6">
											<div class="form-group">
												<label>Name</label>
												<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editresult['name']; ?>" >

			                                </div>
										</div>

									</div>



	<div class="row">






		  </div>








<div class="row">






		  </div>

	      </div>




		<div class="modal-footer">
		<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
	 <button type="submit" class="btn bg-info">  Save  </button>
		</div>
		<input name="action" type="hidden" id="action" value="editdestination" /><?php
		if($_GET['id']!=''){
		?>
		<input name="editedityes" type="hidden" id="editedityes" value="1" />
		<?php } ?><input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
		</form>

		<script>
		$('#fromDate').Zebra_DatePicker({
		format: 'd-m-Y',
		});
				$('#toDate').Zebra_DatePicker({
		format: 'd-m-Y',
		});

		</script>
<?php } ?>








<?php if($_REQUEST['action']=='addcity'){
if($_GET['id']!=''){
 $id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'cityMaster',$where1);
$editresult=mysqli_fetch_array($rs1);

}

 ?>


		<form action="ac.de" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
		<div class="card-body">
			                <div class="row">


										<div class="col-md-6">
											<div class="form-group">
												<label>Country</label>

										  <select id="countryId" name="countryId" class="form-control">
 <?php
$select='';
$where='';
$rs='';
$select='*';
$where=' name!="" order by id asc';
$rs=GetPageRecord($select,'countryMaster',$where);
while($resListing=mysqli_fetch_array($rs)){
?>
<option value="<?php echo strip($resListing['id']); ?>"  <?php if($resListing['id'] == $editresult['countryId']){ echo 'selected="selected"';  } ?>><?php echo strip($resListing['name']); ?></option>
<?php } ?>
</select>


			                                </div>
										</div>

										 	<div class="col-md-6">
											<div class="form-group">
												<label>Name</label>
												<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editresult['name']; ?>" >

			                                </div>
										</div>

									</div>



	<div class="row">






		  </div>








<div class="row">






		  </div>

	      </div>




		<div class="modal-footer">
		<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
	 <button type="submit" class="btn bg-info">  Save  </button>
		</div>
		<input name="action" type="hidden" id="action" value="editdcity" /><?php
		if($_GET['id']!=''){
		?>
		<input name="editedityes" type="hidden" id="editedityes" value="1" />
		<?php } ?><input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
		</form>

		<script>
		$('#fromDate').Zebra_DatePicker({
		format: 'd-m-Y',
		});
				$('#toDate').Zebra_DatePicker({
		format: 'd-m-Y',
		});

		</script>
<?php } ?>












<?php if($_REQUEST['action']=='addcountry'){
if($_GET['id']!=''){
 $id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'countryMaster',$where1);
$editresult=mysqli_fetch_array($rs1);

}

 ?>


		<form action="ac.de" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
		<div class="card-body">
			                <div class="row">




										 	<div class="col-md-12">
											<div class="form-group">
												<label>Name</label>
												<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editresult['name']; ?>" >

			                                </div>
										</div>

									</div>



	<div class="row">






		  </div>








<div class="row">






		  </div>

	      </div>




		<div class="modal-footer">
		<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
	 <button type="submit" class="btn bg-info">  Save  </button>
		</div>
		<input name="action" type="hidden" id="action" value="editcountry" /><?php
		if($_GET['id']!=''){
		?>
		<input name="editedityes" type="hidden" id="editedityes" value="1" />
		<?php } ?><input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
		</form>

		<script>
		$('#fromDate').Zebra_DatePicker({
		format: 'd-m-Y',
		});
				$('#toDate').Zebra_DatePicker({
		format: 'd-m-Y',
		});

		</script>
<?php } ?>



<?php if($_REQUEST['action']=='salesPoints'){
if($_GET['id']!=''){
 $id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'salesPointsMaster',$where1);
$editresult=mysqli_fetch_array($rs1);
}
 ?>
		<form action="ac.de" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
		<div class="card-body">
			                <div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Section Type</label>
												<select id="sectionType" name="sectionType" class="form-control">
												<option value="1"  <?php if(1 == $editresult['sectionType']){ echo 'selected="selected"';  } ?>>Transfer</option>
												<option value="2"  <?php if(2 == $editresult['sectionType']){ echo 'selected="selected"';  } ?>>Sightseeing</option>
												</select>
			                                </div>
										</div>

										 	<div class="col-md-6">
											<div class="form-group">
												<label>Name</label>
												<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editresult['name']; ?>" >

			                                </div>
										</div>
									</div>

	<div class="row">
			<div class="col-md-6">
											<div class="form-group">
												<label>Status</label>
												<select id="status" name="status" class="form-control">
												<option value="0"  <?php if(0 == $editresult['status']){ echo 'selected="selected"';  } ?>>Active</option>
												<option value="1"  <?php if(1 == $editresult['status']){ echo 'selected="selected"';  } ?>>InActive</option>
												</select>
			                                </div>
										</div>
		  </div>








<div class="row">
		  </div>
	      </div>
		<div class="modal-footer">
		<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
	 <button type="submit" class="btn bg-info">  Save  </button>
		</div>
		<input name="action" type="hidden" id="action" value="salesPoints" /><?php
		if($_GET['id']!=''){
		?>
		<input name="editedityes" type="hidden" id="editedityes" value="1" />
		<?php } ?><input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
		</form>

		<script>
		$('#fromDate').Zebra_DatePicker({
		format: 'd-m-Y',
		});
				$('#toDate').Zebra_DatePicker({
		format: 'd-m-Y',
		});

		</script>
<?php } ?>









<?php if($_REQUEST['action']=='inclusions'){
if($_GET['id']!=''){
 $id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'inclusionsMaster',$where1);
$editresult=mysqli_fetch_array($rs1);
}
 ?>
		<form action="ac.de" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
		<div class="card-body">
			                <div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Section Type</label>
												<select id="sectionType" name="sectionType" class="form-control">
												<option value="1"  <?php if(1 == $editresult['sectionType']){ echo 'selected="selected"';  } ?>>Transfer</option>
												<option value="2"  <?php if(2 == $editresult['sectionType']){ echo 'selected="selected"';  } ?>>Sightseeing</option>
												</select>
			                                </div>
										</div>

										 	<div class="col-md-6">
											<div class="form-group">
												<label>Name</label>
												<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editresult['name']; ?>" >

			                                </div>
										</div>
									</div>

	<div class="row">
			<div class="col-md-6">
											<div class="form-group">
												<label>Status</label>
												<select id="status" name="status" class="form-control">
												<option value="0"  <?php if(0 == $editresult['status']){ echo 'selected="selected"';  } ?>>Active</option>
												<option value="1"  <?php if(1 == $editresult['status']){ echo 'selected="selected"';  } ?>>InActive</option>
												</select>
			                                </div>
										</div>
		  </div>








<div class="row">
		  </div>
	      </div>
		<div class="modal-footer">
		<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
	 <button type="submit" class="btn bg-info">  Save  </button>
		</div>
		<input name="action" type="hidden" id="action" value="inclusions" /><?php
		if($_GET['id']!=''){
		?>
		<input name="editedityes" type="hidden" id="editedityes" value="1" />
		<?php } ?><input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
		</form>

		<script>
		$('#fromDate').Zebra_DatePicker({
		format: 'd-m-Y',
		});
				$('#toDate').Zebra_DatePicker({
		format: 'd-m-Y',
		});

		</script>
<?php } ?>





<?php if($_REQUEST['action']=='exclusions'){
if($_GET['id']!=''){
 $id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'exclusionsMaster',$where1);
$editresult=mysqli_fetch_array($rs1);
}
 ?>
		<form action="ac.de" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
		<div class="card-body">
			                <div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Section Type</label>
												<select id="sectionType" name="sectionType" class="form-control">
												<option value="1"  <?php if(1 == $editresult['sectionType']){ echo 'selected="selected"';  } ?>>Transfer</option>
												<option value="2"  <?php if(2 == $editresult['sectionType']){ echo 'selected="selected"';  } ?>>Sightseeing</option>
												</select>
			                                </div>
										</div>

										 	<div class="col-md-6">
											<div class="form-group">
												<label>Name</label>
												<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editresult['name']; ?>" >

			                                </div>
										</div>
									</div>

	<div class="row">
			<div class="col-md-6">
											<div class="form-group">
												<label>Status</label>
												<select id="status" name="status" class="form-control">
												<option value="0"  <?php if(0 == $editresult['status']){ echo 'selected="selected"';  } ?>>Active</option>
												<option value="1"  <?php if(1 == $editresult['status']){ echo 'selected="selected"';  } ?>>InActive</option>
												</select>
			                                </div>
										</div>
		  </div>








<div class="row">
		  </div>
	      </div>
		<div class="modal-footer">
		<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
	 <button type="submit" class="btn bg-info">  Save  </button>
		</div>
		<input name="action" type="hidden" id="action" value="exclusions" /><?php
		if($_GET['id']!=''){
		?>
		<input name="editedityes" type="hidden" id="editedityes" value="1" />
		<?php } ?><input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
		</form>

		<script>
		$('#fromDate').Zebra_DatePicker({
		format: 'd-m-Y',
		});
				$('#toDate').Zebra_DatePicker({
		format: 'd-m-Y',
		});

		</script>
<?php } ?>




<?php if($_REQUEST['action']=='categoryType'){
if($_GET['id']!=''){
 $id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'categoryTypeMaster',$where1);
$editresult=mysqli_fetch_array($rs1);
}
 ?>
		<form action="ac.de" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
		<div class="card-body">
			                <div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Category Type</label>
												<select id="categoryType" name="categoryType" class="form-control">
												<option value="1"  <?php if(transfer == $editresult['categoryType']){ echo 'selected="selected"';  } ?>>Transfer</option>
												<option value="2"  <?php if(sightseeing == $editresult['categoryType']){ echo 'selected="selected"';  } ?>>Sightseeing</option>
												</select>
			                                </div>
										</div>

										 	<div class="col-md-6">
											<div class="form-group">
												<label>Name</label>
												<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editresult['name']; ?>" >

			                                </div>
										</div>
									</div>

	<div class="row">
			<div class="col-md-6">
											<div class="form-group">
												<label>Status</label>
												<select id="status" name="status" class="form-control">
												<option value="0"  <?php if(0 == $editresult['status']){ echo 'selected="selected"';  } ?>>Active</option>
												<option value="1"  <?php if(1 == $editresult['status']){ echo 'selected="selected"';  } ?>>InActive</option>
												</select>
			                                </div>
										</div>
		  </div>








<div class="row">
		  </div>
	      </div>
		<div class="modal-footer">
		<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
	 <button type="submit" class="btn bg-info">  Save  </button>
		</div>
		<input name="action" type="hidden" id="action" value="categoryType" /><?php
		if($_GET['id']!=''){
		?>
		<input name="editedityes" type="hidden" id="editedityes" value="1" />
		<?php } ?><input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
		</form>

		<script>
		$('#fromDate').Zebra_DatePicker({
		format: 'd-m-Y',
		});
				$('#toDate').Zebra_DatePicker({
		format: 'd-m-Y',
		});

		</script>
<?php } ?>


<?php if($_REQUEST['action']=='addbanner'){

 ?>
		<form action="ac.de" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
		<div class="card-body">
									<div class="row">
										 	<div class="col-md-12">
											<div class="form-group">
												<label>Photo</label>
												<input name="photo" type="file" class="form-control" id="photo" >
			                                </div>
										</div>
									</div>
<div class="row">
		  </div>
	      </div>
		<div class="modal-footer">
		<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
	 <button type="submit" class="btn bg-info">  Save  </button>
		</div>
		<input name="action" type="hidden" id="action" value="addbanner" />
		</form>
<?php } ?>



<?php if($_REQUEST['action']=='categorymaster'){
if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,_CATEGORY_MASTER_,$where1);
$editresult=mysqli_fetch_array($rs1);
}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Name</label>
<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editresult['name']; ?>" >
</div>
</div>

<?php /*?><div class="col-md-6">
<div class="form-group">
<label>Material</label>
  <select id="multiselect" multiple="multiple" name="material[]" >
   <?php
$select='';
$where='';
$rs='';
$select='*';
$where='1 order by id desc';
$rs=GetPageRecord($select,'materialMaster',$where);
$array =  explode(',', $editresult['materialid']);

while($rest=mysqli_fetch_array($rs)){
?>
    <option value="<?php echo $rest['id']; ?>" <?php foreach ($array as $item) { if($rest['id']==$item){ ?>selected <?php } }?>><?php echo $rest['name']; ?></option>
    <?php } ?>
</select>

  </div>
</div>

<script>
$(function() {
$('#multiselect').multiselect({
includeSelectAllOption: true,
enableFiltering: true,
enableCaseInsensitiveFiltering: true,
filterPlaceholder: 'Search...'
});
});
</script><?php */?>


<div class="col-md-6">
<div class="form-group">
<label>Description</label>
<input name="description" type="text" class="form-control validate" id="name" value="<?php echo $editresult['description']; ?>" >
</div>
</div>
</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">  Save  </button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>

<?php } ?>

<?php if($_REQUEST['action']=='departmentmaster'){
if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,_DEPARTMENT_MASTER_,$where1);
$editresult=mysqli_fetch_array($rs1);
}
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Name</label>
<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editresult['name']; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Description</label>
<input name="description" type="text" class="form-control validate" id="name" value="<?php echo $editresult['description']; ?>" >
</div>
</div>
</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">  Save  </button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>

<?php }

if($_REQUEST['action']=='departmenttimeline'){
if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,_DEPARTMENT_TIMELINE_MASTER_,$where1);
$editresult=mysqli_fetch_array($rs1);
}
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-3">
	<div class="form-group">
	<label>Department</label>
	<select id="departmentId" name="departmentId" class="form-control" displayname="Department">
		 <option value="">Select</option>
		 <?php
		$select='';
		$where='';
		$rs='';
		$select='*';
		$where=' deletestatus=0 and status=1 order by name asc';
		$rs=GetPageRecord($select,_DEPARTMENT_MASTER_,$where);
		while($resListing=mysqli_fetch_array($rs)){
		?>
		<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editresult['departmentId']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
		<?php } ?>
		</select>
	</div>
</div>
<div class="col-md-3">
	<div class="form-group">
	<label>Category</label>
	<select id="categoryId" name="categoryId" class="form-control" displayname="Category" onchange="selectsubcategory();">
		 <option value="">Select</option>
		 <?php
		$select='';
		$where='';
		$rs='';
		$select='*';
		$where=' deletestatus=0 and status=1 order by name asc';
		$rs=GetPageRecord($select,_CATEGORY_MASTER_,$where);
		while($resListing=mysqli_fetch_array($rs)){
		?>
		<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editresult['categoryId']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
		<?php } ?>
		</select>
	</div>
</div>
<div class="col-md-3">
	<div class="form-group">
	<label>Sub Category</label>
	<select id="subCategoryId" name="subCategoryId" class="form-control" displayname="Sub Category">
	</select>
	<script>
	function selectsubcategory(){
	var categoryId = $('#categoryId').val();
	$('#subCategoryId').load('loadsubcategory.php?id='+categoryId+'&selectId=<?php echo $editresult['subCategoryId']; ?>');
	}
	<?php
	if($_GET['id']!=''){
	?>
	selectsubcategory();
	<?php } ?>
	</script>
	</div>
</div>
<div class="col-md-3">
	<div class="form-group">
	<label>TAT (in Days)</label>
	<input name="duration" type="number" class="form-control" id="duration" displayname="Name" value="<?php echo $editresult['duration']; ?>" maxlength="100" />
	</div>
</div>
</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">  Save  </button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>

<?php }

if($_REQUEST['action']=='styleimagegallery' && $_REQUEST['id']!=''){

if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'imageGallery',$where1);
$editresult=mysqli_fetch_array($rs1);
}
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
		<label>Title</label>
		<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editresult['name']; ?>" >
		</div>
</div>
	<div class="col-md-6">
		<div class="form-group">
		<label>Attach Image</label>
		<div class="uniform-uploader">
		<input type="file" name="attachmentImage" id="attachmentImage" class="form-input-styled" data-fouc="" multiple="multiple"><span class="filename" style="user-select: none;">No file selected</span><span class="action btn btn-secondary" style="user-select: none;"><i class="fa fa-upload"></i></span>
		</div>
	</div>
</div>
</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">  Save  </button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="parentid" type="hidden" id="parentid" value="<?php echo $_REQUEST['id']; ?>" />
</form>


<?php }

if($_REQUEST['action']=='protoimagegallery' && $_REQUEST['id']!=''){

if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'imageGallery',$where1);
$editresult=mysqli_fetch_array($rs1);
}
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
		<label>Gallery Name</label>
		<input name="name" type="text" class="form-control validate" id="name" value="" >
		</div>
</div>

</div>
</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">  Save  </button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="" />
<input name="parentid" type="hidden" id="parentid" value="<?php echo $_REQUEST['id']; ?>" />
</form>


<?php }

include "footer.php";
if($_REQUEST['action']=='imagegalleryview' && $_REQUEST['id']!=''){

if($_REQUEST['id']!=''){
$id=clean(decode($_REQUEST['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'imageGallery',$where1);
$editresult=mysqli_fetch_array($rs1);
?>
<div id="galleryimaage" class="owl-carousel owl-theme owl-loaded">

<?php
$i=0;
$selectimg='*';
$whereimg='parentId="'.$id.'" and galleryType="image_gallery" order by id asc';
$rsimg=GetPageRecord($selectimg,'imageGallery',$whereimg);
$count = mysql_num_rows($rsimg);
while($imgresult=mysqli_fetch_array($rsimg)){
?>

<div class="gallery-image"><img src="images/<?php echo $imgresult['attachmentImage']; ?>" alt="<?php echo $imgresult['name']; ?>">
<?php if($imgresult['name']!='') { ?><div class="gallery-content"><?php echo $imgresult['name']; ?></div></div>


<?php  } }  ?>

</div>

<?php
}
}

?>
<?php if($_REQUEST['action']=='tasklistmaster'){
if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'taskListMaster',$where1);
$editresult=mysqli_fetch_array($rs1);
}
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Task Name</label>
<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editresult['name']; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Description</label>
<input name="description" type="text" class="form-control validate" id="name" value="<?php echo $editresult['description']; ?>" >
</div>
</div>
</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">  Save  </button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>

<?php } ?>


<!--add edit embroidtypemaster-->

<?php if($_REQUEST['action']=='embroiderytype'){
if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'embroideryTypeMaster',$where1);
$editresult=mysqli_fetch_array($rs1);
}
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Embroidery Name</label>
<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editresult['name']; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Description</label>
<input name="description" type="text" class="form-control validate" id="name" value="<?php echo $editresult['description']; ?>" >
</div>
</div>
</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>

<?php } ?>

<!--add edit buyer master-->

<?php if($_REQUEST['action']=='buyermaster'){
if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,_BUYER_MASTER_,$where1);
$editresult=mysqli_fetch_array($rs1);
}
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Buyer Name</label>
<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editresult['name']; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Buyer ID</label>
<input name="buyerId" type="text" class="form-control validate" id="buyerId" value="<?php echo $editresult['buyerId']; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Buyer Short Name</label>
<input name="shortname" type="text" class="form-control validate" id="shortname" value="<?php echo $editresult['buyerShortName']; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Buyer Email</label>
<input name="bemail" type="text" class="form-control validate" id="bemail" value="<?php echo $editresult['buyeremail']; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Buyer Phone</label>
<input name="bphone" type="text" class="form-control validate" id="bphone" value="<?php echo $editresult['buyerphone']; ?>" >
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Status</label>
<select name="status" id="status" class="form-control validate">
<option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active</option>
<option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>Inactive</option>

</select>
</div>
</div>

</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>

<?php } ?>


<!--add edit color carts master-->

<?php if($_REQUEST['action']=='colorcardmaster'){
if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'colorCardMaster',$where1);
$editresult=mysqli_fetch_array($rs1);
}
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Color Code</label>
<input name="colorCode" type="color" class="form-control validate" id="colorCode" value="<?php echo $editresult['colorCode']; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Color Name</label>
<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editresult['name']; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Reference</label>
<input name="reference" type="text" class="form-control validate" id="reference" value="<?php echo $editresult['reference']; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Buyer Color Code</label>
<input name="buyerColorCode" type="color" class="form-control validate" id="buyerColorCode" value="<?php echo $editresult['buyerColorCode']; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Buyer Color Name</label>
<input name="buyerColorName" type="text" class="form-control validate" id="buyerColorName" value="<?php echo $editresult['buyerColorName']; ?>" >
</div>
</div>
</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>

<?php } ?>

<!--add edit samplingtaskmaster-->

<?php if($_REQUEST['action']=='samplingtaskmaster'){
if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'sampleTaskMaster',$where1);
$editresult=mysqli_fetch_array($rs1);
}
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Name</label>
<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editresult['name']; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Description</label>
<input name="description" type="text" class="form-control validate" id="description" value="<?php echo $editresult['description']; ?>" >
</div>
</div>
</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>

<?php } ?>
<?php if($_REQUEST['action']=='messages'){
if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'timelineMaster',$where1);
$editresult=mysqli_fetch_array($rs1);
}
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Subject</label>
<input name="subject" type="text" class="form-control validate" id="subject" value="<?php echo $editresult['subject']; ?>" >
</div>
</div>


<div class="col-md-6">
<div class="form-group">
<label>Broadcast Date</label>
	<input name="broadcastDate" type="text" class="form-control" id="broadcastDate" value="<?php if($editresult['broadcastDate']!=''){ echo date('d-m-Y', strtotime($editresult['broadcastDate'])); }else{ echo date('d-m-Y'); } ?>">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Department</label>
<select id="departmentId" name="departmentId[]" multiple="multiple" class="form-control validate" displayname="">
	  <option value="">Select</option>
	 <?php
	$select='';
	$where='';
	$rs='';
	$select='*';
	$where=' deletestatus=0 and status=1 order by name asc';
	$rs=GetPageRecord($select,_DEPARTMENT_MASTER_,$where);
	$newdata = explode(',', $editresult['departmentId']);
	while($resListing=mysqli_fetch_array($rs)){
	?>
	<option value="<?php echo strip($resListing['id']); ?>" <?php foreach($newdata as $key => $value) { if($value == $resListing['id']){ echo 'selected="selected"'; } }?>><?php echo strip($resListing['name']); ?></option>
	<?php } ?>

	 </select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>User</label>
<select id="userfor" name="userfor" class="form-control">
<option value="">Select</option>
<?php
$select='';
$where='';
$rs='';
$select='*';
$where=' deletestatus=0 and status=1 order by firstName asc';
$rs=GetPageRecord($select,'userMaster',$where);
while($resListing=mysqli_fetch_array($rs)){
?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editresult['assignTo']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['firstName']).' '.strip($resListing['lastName']); ?></option>
<?php } ?>
</select>
</div>
</div>

<script>
$(document).ready(function() {
$("#departmentId").select2();
});
</script>

<div class="col-md-12">
<div class="form-group">
<label>Description</label>
<textarea row="6" name="postText" id="postText" class="form-control"></textarea>
</div>
</div>


<script>
$( function(){
	$( "#broadcastDate" ).datepicker();
} );
</script>
</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>

<?php } ?>


<!--add edit seasonmaster-->
<?php if($_REQUEST['action']=='seasonmaster'){
if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'seasonMaster',$where1);
$editresult=mysqli_fetch_array($rs1);
}
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Season Name</label>
<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editresult['name']; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Start Date</label>
<input name="startDate" type="text" class="form-control" id="startDate" value="<?php if($editresult['startDate']!=''){ echo date('d-m-Y', strtotime($editresult['startDate'])); }else{ echo date('d-m-Y'); } ?>">
<script>
$( function(){
	$( "#startDate" ).datepicker();

} );
</script>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>End Date</label>
<input name="enddate" type="text" class="form-control" id="enddate" value="<?php if($editresult['endDate']!=''){ echo date('d-m-Y', strtotime($editresult['endDate'])); }else{ echo date('d-m-Y'); } ?>">
<script>
$( function(){
	$( "#enddate" ).datepicker();

} );
</script>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Status</label>
<select class="form-control validate" name="status" id="status">
<option value="1" <?php if($editresult['status']=='1') { ?>  selected="selected" <?php } ?>>Active</option>
<option value="2" <?php if($editresult['status']=='2') { ?>  selected="selected" <?php } ?>>Inactive</option>
</select>
</div>
</div>

</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>

<?php } ?>



<!--addSub Category Master -->


<?php if($_REQUEST['action']=='subcategorymaster'){
if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'subCategoryMaster',$where1);
$editresult=mysqli_fetch_array($rs1);

}
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Category Name</label>
<select id="categoryId" name="categoryId" class="form-control validate" displayname="Category">
	 <option value="">Select</option>
	 <?php
	$select='';
	$where='';
	$rs='';
	$select='*';
	$where=' deletestatus=0 and status=1 order by name asc';
	$rs=GetPageRecord($select,_CATEGORY_MASTER_,$where);
	while($resListing=mysqli_fetch_array($rs)){
	?>
	<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editresult['categoryId']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
	<?php } ?>
	</select>

</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Sub Category</label>
<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editresult['name']; ?>" >
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Material</label>
  <select id="multiselect" multiple="multiple" name="material[]" >
   <?php
$select='';
$where='';
$rs='';
$select='*';
$where='1 order by id desc';
$rs=GetPageRecord($select,'materialMaster',$where);
$array =  explode(',', $editresult['materialid']);

while($rest=mysqli_fetch_array($rs)){
?>
    <option value="<?php echo $rest['id']; ?>" <?php foreach ($array as $item) { if($rest['id']==$item){ ?>selected <?php } }?>><?php echo $rest['name']; ?></option>
    <?php } ?>
</select>

  </div>
</div>

<script>
$(function() {
$('#multiselect').multiselect({
includeSelectAllOption: true,
enableFiltering: true,
enableCaseInsensitiveFiltering: true,
filterPlaceholder: 'Search...'
});
});
</script>


<div class="col-md-6">
<div class="form-group">
<label>Description</label>
<input name="description" type="text" class="form-control validate" id="description" value="<?php echo $editresult['description']; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Status</label>
<select name="status" id="status" class="form-control validate">
<option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active</option>
<option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>Inactive</option>
</select>
</div>
</div>

</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>


<?php } ?>



<!--add material master -->

<?php if($_REQUEST['action']=='materialmaster'){
if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'materialMaster',$where1);
$editresult=mysqli_fetch_array($rs1);

}
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Material Type</label>
<select id="categoryId" name="categoryId" class="form-control validate">
	 <option value="">Select</option>
	 <?php
	$select='';
	$where='';
	$rs='';
	$select='*';
	$where=' deletestatus=0 and status=1 order by name asc';
	$rs=GetPageRecord($select,'materialTypeMaster',$where);
	while($resListing=mysqli_fetch_array($rs)){
	?>
	<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editresult['materialtype']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
	<?php } ?>
	</select>

</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Material Name</label>
<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editresult['name']; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Description</label>
<input name="description" type="text" class="form-control validate" id="description" value="<?php echo $editresult['description']; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Status</label>
<select name="status" id="status" class="form-control validate">
<option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active</option>
<option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>Inactive</option>
</select>
</div>
</div>

</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>


<?php } ?>

<!--add material type master -->
<?php if($_REQUEST['action']=='materialtype'){
if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'materialTypeMaster',$where1);
$editresult=mysqli_fetch_array($rs1);

}
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Material Type</label>
<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editresult['name']; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Description</label>
<input name="description" type="text" class="form-control validate" id="description" value="<?php echo $editresult['description']; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Status</label>
<select name="status" id="status" class="form-control validate">
<option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active</option>
<option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>Inactive</option>
</select>
</div>
</div>

</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>


<?php } ?>

<!--add material description master -->

<?php if($_REQUEST['action']=='materialdescriptionmaster'){
if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'materialDescriptionMaster',$where1);
$editresult=mysqli_fetch_array($rs1);

}
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Material Type</label>
<select id="materialTypeId" name="materialTypeId" class="form-control validate">
	 <option value="">Select</option>
	 <?php
	$select='';
	$where='';
	$rs='';
	$select='*';
	$where=' deletestatus=0 and status=1 order by name asc';
	$rs=GetPageRecord($select,'materialTypeMaster',$where);
	while($resListing=mysqli_fetch_array($rs)){
	?>
	<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editresult['materialTypeId']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
	<?php } ?>
	</select>

</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Material Short Description (SAP)</label>
<input name="shortDescription" type="text" class="form-control " id="shortDescription" value="<?php echo $editresult['shortDescription']; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Material Code (SAP)</label>
<input name="sapCode" type="text" class="form-control " id="sapCode" value="<?php echo $editresult['sapCode']; ?>" autocomplete="off">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Description</label>

<textarea name="longDescription" id="longDescription" class="form-control "><?php echo $editresult['longDescription']; ?></textarea>
</div>
</div>

</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>


<?php } ?>



<!--add edit  master-->

<?php if($_REQUEST['action']=='employeemaster'){
if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,_EMPLOYEE_MASTER_,$where1);
$editresult=mysqli_fetch_array($rs1);
}
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-4">
<div class="form-group">
<label>Employee Code</label>
<input name="empCode" type="text" class="form-control validate" id="empCode" value="<?php echo $editresult['empCode']; ?>" >
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>Employee Name</label>
<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editresult['name']; ?>" >
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>Employee Category</label>
<select id="empType" name="empType" class="form-control"  autocomplete="off" displayname="Employee Type">
      <option value="">Select</option>
	  <?php
	  	$selectl='';
		$wherel='';
		$rsl='';
		$selectl='*';
		$wherel=' status=1 order by id asc';
		$rsl=GetPageRecord($selectl,_EMPLOYEE_TYPE_,$wherel);
		while($resListingl=mysqli_fetch_array($rsl)){
	   ?>
      <option value="<?php echo strip($resListingl['id']); ?>" <?php if($resListingl['id']==$editresult['empType']){ ?>selected="selected"<?php } ?>><?php echo strip(		      $resListingl['name']); ?></option>
	  <?php } ?>
    </select>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>Designation</label>
<select id="designationId" name="designationId" class="form-control"  autocomplete="off" displayname="">
      <option value="">Select</option>
	  <?php
	  	$selectl='';
		$wherel='';
		$rsl='';
		$selectl='*';
		$wherel=' status=1 order by id asc';
		$rsl=GetPageRecord($selectl,_DESIGNATION_MASTER_,$wherel);
		while($resListingl=mysqli_fetch_array($rsl)){
	   ?>
      <option value="<?php echo strip($resListingl['id']); ?>" <?php if($resListingl['id']==$editresult['designationId']){ ?>selected="selected"<?php } ?>><?php echo strip(		      $resListingl['name']); ?></option>
	  <?php } ?>
    </select>
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Category</label>
<select id="categoryId" name="categoryId[]" class="form-control"  autocomplete="off"  multiple="multiple">
      <option value="">Select</option>
	  <?php
	  	$selectl='';
		$wherel='';
		$rsl='';
		$selectl='*';
		$wherel=' status=1 order by id asc';
		$newdata = explode(',', $editresult['categoryId']);
		$rsl=GetPageRecord($selectl,_CATEGORY_MASTER_,$wherel);
		while($resListingl=mysqli_fetch_array($rsl)){
	   ?>
      <option value="<?php echo strip($resListingl['id']); ?>" <?php foreach($newdata as $key => $value) { if($value == $resListingl['id']){ echo 'selected="selected"'; } }?>><?php echo strip($resListingl['name']); ?></option>
	  <?php } ?>
    </select>
</div>
</div>
<script>
$(document).ready(function() {
$("#categoryId").select2();
});
</script>
<div class="col-md-4">
<div class="form-group">
<label>Email</label>
<input name="email" type="text" class="form-control validate" id="email" value="<?php echo $editresult['email']; ?>" >
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Phone</label>
<input name="phone" type="number" class="form-control validate" id="phone" value="<?php echo $editresult['phone']; ?>" >
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Address</label>
<input name="address" type="text" class="form-control" id="address" displayname="Address" value="<?php echo $editresult['address']; ?>" />
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Country</label>
<select id="countryId" name="countryId" class="form-control" displayname="State" autocomplete="off" onchange="selectstate();" >
	 <option value="">Select</option>
	 <?php
	$select='';
	$where='';
	$rs='';
	$select='*';
	$where=' deletestatus=0 and status=1 order by name asc';
	$rs=GetPageRecord($select,_COUNTRY_MASTER_,$where);
	while($resListing=mysqli_fetch_array($rs)){
	?>
	<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editresult['countryId']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
	<?php } ?>
	</select>

<!--<select id="countryId" name="countryId" class="form-control select-search select2-hidden-accessible js-example-basic-single1">
	<option>aaa</option>
	<option>bbbb</option>
	<option>cccc</option>
</select>
<script>
 $(document).ready(function() {
	 $('.js-example-basic-single1').select2();
 });
</script>-->
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>State</label>
<select id="stateId" name="stateId" class="form-control" displayname="State" autocomplete="off" onchange="selectcity();" >

</select>
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>City</label>
<select id="cityId" name="cityId" class="form-control" displayname="State" autocomplete="off">

</select>
</div>
</div>

<script>
function selectstate(){
var countryId = $('#countryId').val();
$('#stateId').load('loadstate.php?id='+countryId+'&selectId=<?php echo $editresult['stateId']; ?>');
}

function selectcity(){
var stateId = $('#stateId').val();
$('#cityId').load('loadcity.php?id='+stateId+'&selectId=<?php echo $editresult['cityId']; ?>');
}
</script>
<script>
<?php
if($_GET['id']!=''){
?>
selectstate();
<?php } ?>
</script>

<div class="col-md-4">
<div class="form-group">
<label>Pin</label>
<input name="pinCode" type="text" class="form-control" id="pinCode" displayname="pinCode" value="<?php echo $editresult['pinCode']; ?>" />
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>Work Location</label>
<input name="workLocation" type="text" class="form-control" id="workLocation" displayname="" value="<?php echo $editresult['workLocation']; ?>" />
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Reporting Manager</label>
<select name="reportingTo" id="reportingTo" class="form-control validate">
<option value="">Select</option>
	 <?php
	$select='';
	$where='';
	$rs='';
	$select='*';
	$where=' deletestatus=0 and status=1 order by name asc';
	$rs=GetPageRecord($select,_EMPLOYEE_MASTER_,$where);
	while($resListing=mysqli_fetch_array($rs)){
	?>
	<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editresult['reportingTo']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
	<?php } ?></select>
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Status</label>
<select name="status" id="status" class="form-control validate">
<option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active</option>
<option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>Inactive</option>

</select>
</div>
</div>


</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>

<?php } ?>


<?php


//add new profile

if($_REQUEST['action']=='profile'){

if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,_PROFILE_MASTER_,$where1);
$editresult=mysqli_fetch_array($rs1);
}
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Profile Name</label>
<input name="profileName" type="text" class="form-control validate" id="profileName" value="<?php echo $editresult['profileName']; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Profile Description</label>
<input name="profileDetails" type="text" class="form-control validate" id="profileDetails" value="<?php echo $editresult['profileDetails']; ?>" >
</div>
</div>


<div class="col-md-6">
<div class="form-group">
<label>Clone Profile</label>

<select id="profileclone" name="profileclone" class="form-control validate">
<option value="">Select</option>
 <?php

$select='';
$where='';
$rs='';
$select='*';
$where='1 order by id asc';
$rs=GetPageRecord($select,_PROFILE_MASTER_,$where);
while($timeformat=mysqli_fetch_array($rs)){
if($timeformat['deletestatus']!=1){
?>
<option value="<?php echo encode($timeformat['id']); ?>" <?php if($timeformat['id']==$editTimeformat){ ?>selected="selected"<?php } ?>><?php echo strip($timeformat['profileName']); ?></option>
<?php } } ?>
</select>

</div>
</div>


</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">  Save  </button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>

<?php } ?>



<?php



//add new role
if($_REQUEST['action']=='role'){



if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.' and userId='.$loginusersuperParentId.'';
$rs1=GetPageRecord($select1,_ROLE_MASTER_,$where1);
$editresult=mysqli_fetch_array($rs1);

$name=clean($editresult['name']);
$roleDetails=clean($editresult['roleDetails']);
$roleId=clean($editresult['id']);
$roleparentId=$editresult['parentId'];
$relatedroleid=$roleparentId;
}

if($_GET['sid']!=''){
$select1='*';
$where1='id='.$relatedroleid.'';
$rs1=GetPageRecord($select1,_ROLE_MASTER_,$where1);
$relatedroleidname=mysqli_fetch_array($rs1);
}



?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Role Name</label>
<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $name; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Reported To</label>
<select name="roleidname" id="parentId" class="form-control validate">
<option value="">Select</option>
<option value="1">Admin</option>
</select>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Role Detail</label>
<input name="roleDetails" type="text" class="form-control validate" id="roleDetails" value="<?php echo $editresult['roleDetails']; ?>" >
</div>
</div>


</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">  Save  </button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>

<?php } ?>
<?php if($_REQUEST['action']=='complaintmaster'){
if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,_COMPLAINT_MASTER_,$where1);
$editresult=mysqli_fetch_array($rs1);
}
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Subject</label>
<input name="subject" type="text" class="form-control validate" id="subject" value="<?php echo $editresult['name']; ?>" autocomplete="off">
</div>
</div>


<div class="col-md-6">
<div class="form-group">
<label>Style Id</label>
<select name="styleId" id="styleId" class="form-control" autocomplete="off"   >
<option value="">Select</option>
<?php
$select='*';
$where='1 and subject!="" order by displayId asc';
$rs=GetPageRecord($select,_QUERY_MASTER_,$where);
while($editresult=mysqli_fetch_array($rs)){
?>
<option value="<?php echo $editresult['id']; ?>"><?php echo makeQueryId($editresult['displayId']); ?></option>
<?php } ?>
</select>

</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Priority</label>
<select name="priority" id="priority" class="form-control" autocomplete="off"   >
<option value="1">Normal</option>
<option value="2">High</option>
</select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Status</label>
<select name="status" id="status"  class="form-control" autocomplete="off"   >
<option value="1">Open</option>
</select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Assign To</label>
<select name="assignTo" id="assignTo" class="form-control" autocomplete="off"   >
<option value="">Select</option>
<option value="1">Rohit</option>
<option value="2">Satendra</option>
</select>
</div>
</div>


<div class="col-md-12">
<div class="form-group">
<label>Description</label>
<textarea name="description" id="description" class="form-control" rows="3"></textarea>
</div>
</div>

</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>

<?php } ?>

<?php
//techpackcategorymaster
if($_REQUEST['action']=='techpackcategorymaster'){
if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,_TECHPACK_CATEGORY_MASTER_,$where1);
$editresult=mysqli_fetch_array($rs1);
}
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Name</label>
<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editresult['name']; ?>" autocomplete="off">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Status</label>
<select name="status" id="status" class="form-control" autocomplete="off" >
<option value="1" <?php if($editresult['status']=='1') {?> selected<?php }?>>Active</option>
<option value="2" <?php if($editresult['status']=='2') {?> selected<?php }?>>Inactive</option>
</select>
</div>
</div>

</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>

<?php } ?>

<?php
//techpack subcategory master
if($_REQUEST['action']=='techpacksubcategorymaster'){
if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,_TECHPACK_SUBCATEGORY_MASTER_,$where1);
$editresult=mysqli_fetch_array($rs1);
}
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Category</label>
<select name="techpackcategoryid" id="techpackcategoryid" class="form-control" autocomplete="off" >
<option value="">Select</option>
<?php
$select111='*';
$where111='status=1 and deleteStatus=0';
$rs111=GetPageRecord($select111,_TECHPACK_CATEGORY_MASTER_,$where111);
while($categoryresult=mysqli_fetch_array($rs111)){
 ?>
<option value="<?php echo $categoryresult['id'] ;?>" <?php if($categoryresult['id']==$editresult['techpackcategoryid']) { ?> selected <?php } ?>><?php echo $categoryresult['name'] ;?></option>
<?php } ?>
</select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Name</label>
<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editresult['name']; ?>" autocomplete="off">
</div>
</div>


<div class="col-md-6">
<div class="form-group">
<label>Status</label>
<select name="status" id="status" class="form-control" autocomplete="off" >
<option value="1" <?php if($editresult['status']=='1') {?> selected<?php }?>>Active</option>
<option value="2" <?php if($editresult['status']=='2') {?> selected<?php }?>>Inactive</option>
</select>
</div>
</div>

</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>

<?php } ?>


<?php
//techpack measurement chart master
if($_REQUEST['action']=='measurementchartmaster'){
if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,_MEASUREMENT_CHART_MASTER_,$where1);
$editresult=mysqli_fetch_array($rs1);
}
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Name</label>
<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editresult['name']; ?>" autocomplete="off">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Status</label>
<select name="status" id="status" class="form-control" autocomplete="off" >
<option value="1" <?php if($editresult['status']=='1') {?> selected<?php }?>>Active</option>
<option value="2" <?php if($editresult['status']=='2') {?> selected<?php }?>>Inactive</option>
</select>
</div>
</div>

</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>

<?php } ?>

<?php if($_REQUEST['action']=='assigntopattern'){
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Assign To</label>
<select id="assignTo" name="assignTo" class="form-control" displayname="Assign To">
<option value="">Select</option>
<?php
$select='';
$where='';
$rs='';
$select='*';
/*if($_SESSION['userid']!='1'){
$wheresearch = 'id in (select id from userMaster where empId in (select id from employeeMaster where reportingTo="'.$_SESSION['empid'].'")) and';
}*/
$where='  deletestatus=0 and status=1 and profileId in (81,82,153) order by firstName asc';

$rs=GetPageRecord($select,'userMaster',$where);
while($resListing=mysqli_fetch_array($rs)){
?>
<option value="<?php echo strip($resListing['id']); ?>" ><?php echo strip($resListing['firstName']).' '.strip($resListing['lastName']); ?></option>
<?php } ?>
</select>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<label>Notes</label>
<textarea name="notes" id="notes" rows="3" class="form-control"></textarea>
</div>
</div>
</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">  Save  </button>
</div>
<input name="action" type="hidden" id="action" value="assigntopattern" />
<input name="styleId" type="hidden" id="styleId" value="<?php echo $_REQUEST['styleId']; ?>" />
</form>

<?php }

if($_REQUEST['action']=='acceptreject'){
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Status</label>
<select id="status" name="status" class="form-control">
<option value="1">Accept</option>
<option value="0">Reject</option>
</select>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<label>Notes</label>
<textarea name="notes" id="notes" rows="3" class="form-control"></textarea>
</div>
</div>
</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">  Save  </button>
</div>
<input name="action" type="hidden" id="action" value="acceptreject" />
<input name="styleId" type="hidden" id="styleId" value="<?php echo $_REQUEST['styleId']; ?>" />
</form>
<?php }

if($_REQUEST['action']=='approvecancelsample' && $_REQUEST['styleId']!=''){
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Status</label>
<select id="buyerStatus" name="buyerStatus" class="form-control">
<option value="1" <?php if($_REQUEST['buyerStatus']=='1') { ?> selected <?php } ?>>Approve</option>
<option value="2" <?php if($_REQUEST['buyerStatus']=='2') { ?> selected <?php } ?>>Cancel</option>
</select>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<label>Notes</label>
<textarea name="notes" id="notes" rows="3" class="form-control"></textarea>
</div>
</div>
</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
<input name="action" type="hidden" id="action" value="approvecancelsammple" />
<input name="styleId" type="hidden" id="styleId" value="<?php echo $_REQUEST['styleId']; ?>" />
</form>
<?php }


if($_REQUEST['action']=='waitingforassignment'){
?>

<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Assign To</label>
<select id="assignTo" name="assignTo" class="form-control" displayname="Assign To">
<option value="">Select</option>
<?php
$select='';
$where='';
$rs='';
$select='*';
if($_REQUEST['pd']=='1'){
$where=' deletestatus=0 and status=1 and profileId=92 order by firstName asc';
}else{
$where='id in (select id from userMaster where empId in (select id from employeeMaster where reportingTo="'.$_SESSION['empid'].'")) and deletestatus=0 and status=1 and profileId=85 order by firstName asc';
}
$rs=GetPageRecord($select,'userMaster',$where);
while($resListing=mysqli_fetch_array($rs)){
?>
<option value="<?php echo strip($resListing['id']); ?>"><?php echo strip($resListing['firstName']).' '.strip($resListing['lastName']); ?></option>
<?php } ?>
</select>

</div>
</div>
<div class="col-md-12">
<div class="form-group">
<label>Notes</label>
<textarea name="notes" id="notes" rows="3" class="form-control"></textarea>
</div>
</div>
</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">  Save  </button>
</div>
<input name="action" type="hidden" id="action" value="waitingforassignment" />
<input name="pd" type="hidden" id="pd" value="<?php echo $_REQUEST['pd']; ?>" />
<input name="styleId" type="hidden" id="styleId" value="<?php echo $_REQUEST['styleId']; ?>" />
</form>
<?php }



if($_REQUEST['action']=='assigntomarker'){
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Assign To</label>
<select id="assignTo" name="assignTo" class="form-control" displayname="Assign To">
<option value="">Select</option>
<?php
$select='';
$where='';
$rs='';
$select='*';
/*if($_SESSION['userid']!='1'){
$wheresearch = 'id in (select id from userMaster where empId in (select id from employeeMaster where reportingTo="'.$_SESSION['empid'].'")) and';
}*/
$where=' deletestatus=0 and status=1 and profileId in (81,82,153) order by firstName asc';
$rs=GetPageRecord($select,'userMaster',$where);
while($resListing=mysqli_fetch_array($rs)){
?>
<option value="<?php echo strip($resListing['id']); ?>" ><?php echo strip($resListing['firstName']).' '.strip($resListing['lastName']); ?></option>
<?php } ?>
</select>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<label>Notes</label>
<textarea name="notes" id="notes" rows="3" class="form-control"></textarea>
</div>
</div>
</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">  Save  </button>
</div>
<input name="action" type="hidden" id="action" value="assigntomarker" />
<input name="styleId" type="hidden" id="styleId" value="<?php echo $_REQUEST['styleId']; ?>" />
</form>

<?php }

 ?>

<?php
//add notes
if($_REQUEST['action']=='addnotes'){
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Notes</label>
<textarea name="notes" id="notes" rows="3" class="form-control"></textarea>
</div>
</div>
</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">  Save  </button>
</div>
<input name="action" type="hidden" id="action" value="addnotes" />
<input name="styleId" type="hidden" id="styleId" value="<?php echo $_REQUEST['styleId']; ?>" />
</form>

<?php }

 ?>




<!--Assign to purchase -->
<?php if($_REQUEST['action']=='assigntopurchase'){
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Assign To</label>
  <select id="assignto" multiple="multiple" name="assignto[]" >
   <?php
$select='';
$where='';
$rs='';
$select='*';
$where='profileId=154';
$rs=GetPageRecord($select,'userMaster',$where);

while($rest=mysqli_fetch_array($rs)){
?>
    <option value="<?php echo $rest['id']; ?>"><?php echo $rest['firstName']." ".$rest['lastName'] ;?></option>

    <?php } ?>
</select>
   <input name="assignToMaterial[]" id="assignToMaterial" type="hidden" value="0" />
   <input name="costsheetversionid" id="costsheetversionid" type="hidden" value="<?php echo $_REQUEST['costsheetVersionId']?>" />


  </div>
</div>

<script>
$(function() {
$('#assignto').multiselect({
includeSelectAllOption: true,
enableFiltering: true,
enableCaseInsensitiveFiltering: true,
filterPlaceholder: 'Search...'
});
});

var assignToMaterial='';

var abc= parent.$('#materialcosttype').val();

$('input:checkbox.Checkedinc'+abc+'<?php echo $_REQUEST['costsheetVersionId']; ?>').each(function () {
var sThisVal = (this.checked ? $(this).val() : "");


if(sThisVal!=''){
assignToMaterial = assignToMaterial+sThisVal+',';

}

});
$('#assignToMaterial').val(assignToMaterial);


</script>


<div class="col-md-12" style="display:none;">
<div class="form-group">
<label>Notes</label>
<input name="description" type="text" class="form-control validate" id="description" value="" >
</div>
</div>
</div>
</div>

<input name="action" type="hidden" id="action" value="assigntopurchase" />


<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
</form>


<?php } ?>

<!--Assign to purchase -->
<?php if($_REQUEST['action']=='assigntopurchasemerchant'){
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Assign To</label>
  <select id="assigntopurchasemerchant" multiple="multiple" name="assigntopurchasemerchant[]" >
   <?php
$select='';
$where='';
$rs='';
$select='*';
$where='profileId=155';
$rs=GetPageRecord($select,'userMaster',$where);

while($rest=mysqli_fetch_array($rs)){
?>
    <option value="<?php echo $rest['id']; ?>"><?php echo $rest['firstName']." ".$rest['lastName'] ;?></option>

    <?php } ?>
</select>
   <input name="assignToMaterial[]" id="assignToMaterial" type="hidden" value="0" />
   <input name="costsheetversionid" id="costsheetversionid" type="hidden" value="<?php echo $_REQUEST['costsheetVersionId']?>" />


  </div>
</div>

<script>
$(function() {
$('#assigntopurchasemerchant').multiselect({
includeSelectAllOption: true,
enableFiltering: true,
enableCaseInsensitiveFiltering: true,
filterPlaceholder: 'Search...'
});
});

var assignToMaterial='';

var abc= parent.$('#materialcosttypepurchasemerchant').val();

$('input:checkbox.purchaseMerchantCheckedinc'+abc+'<?php echo $_REQUEST['costsheetVersionId']; ?>').each(function () {
var sThisVal = (this.checked ? $(this).val() : "");


if(sThisVal!=''){
assignToMaterial = assignToMaterial+sThisVal+',';

}

});
$('#assignToMaterial').val(assignToMaterial);


</script>


<div class="col-md-12" style="display:none;">
<div class="form-group">
<label>Notes</label>
<input name="description" type="text" class="form-control validate" id="description" value="" >
</div>
</div>
</div>
</div>

<input name="action" type="hidden" id="action" value="assigntopurchasemerchant" />


<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
</form>


<?php } ?>



<!--estimate Cost sheet status-->
<?php if($_REQUEST['action']=='estimatecostsheet'){
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">

<div class="col-md-12">
<div class="form-group">
<label>Notes</label>
<input name="description" type="text" class="form-control validate" id="description" value="" >
</div>
</div>
</div>
</div>

<input name="action" type="hidden" id="action" value="estimatecostsheet" />
<input name="styleId" type="hidden" id="styleId" value="<?php echo $_REQUEST['styleId']; ?>" />


<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
</form>

<?php } ?>


<!--add unit master -->

<?php if($_REQUEST['action']=='unitmaster'){
if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'unitMaster',$where1);
$editresult=mysqli_fetch_array($rs1);

}
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Material Type</label>
<select id="materialType" name="materialType" class="form-control validate">
	 <option value="">Select</option>
	 <?php
	$select='';
	$where='';
	$rs='';
	$select='*';
	$where=' deletestatus=0 and status=1 order by name asc';
	$rs=GetPageRecord($select,'materialTypeMaster',$where);
	while($resListing=mysqli_fetch_array($rs)){
	?>
	<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editresult['materialtype']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
	<?php } ?>
	</select>

</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Unit Name</label>
<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editresult['name']; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Description</label>
<input name="description" type="text" class="form-control validate" id="description" value="<?php echo $editresult['description']; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Status</label>
<select name="status" id="status" class="form-control validate">
<option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active</option>
<option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>Inactive</option>
</select>
</div>
</div>

</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>


<?php } ?>



<!--add extra charges master -->

<?php if($_REQUEST['action']=='chargestype'){
if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'chargesTypeMaster',$where1);
$editresult=mysqli_fetch_array($rs1);

}
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Name</label>
<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editresult['name']; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Description</label>
<input name="description" type="text" class="form-control validate" id="description" value="<?php echo $editresult['description']; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Status</label>
<select name="status" id="status" class="form-control validate">
<option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active</option>
<option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>Inactive</option>
</select>
</div>
</div>

</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>


<?php } ?>


<!--add charges master -->

<?php if($_REQUEST['action']=='chargesmaster'){
if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'chargesMaster',$where1);
$editresult=mysqli_fetch_array($rs1);

}
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Charges Type</label>
<select id="chargestype" name="chargestype" class="form-control validate">
	 <option value="">Select</option>
	 <?php
	$select='';
	$where='';
	$rs='';
	$select='*';
	$where=' deletestatus=0 and status=1 order by name asc';
	$rs=GetPageRecord($select,'chargesTypeMaster',$where);
	while($resListing=mysqli_fetch_array($rs)){
	?>
	<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$editresult['chargestype']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['name']); ?></option>
	<?php } ?>
	</select>

</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Name</label>
<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editresult['name']; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Description</label>
<input name="description" type="text" class="form-control validate" id="description" value="<?php echo $editresult['description']; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Status</label>
<select name="status" id="status" class="form-control validate">
<option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active</option>
<option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>Inactive</option>
</select>
</div>
</div>

</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>


<?php }

if($_REQUEST['action']=='materialcostchat'){
$styleId=clean(decode($_REQUEST['styleId']));
$materialType=clean($_REQUEST['materialType']);
$materialId=clean($_REQUEST['materialId']);
$srNo=clean($_REQUEST['srno']);
$costversionid=clean($_REQUEST['costversionid']);
$id=clean($_REQUEST['id']);

$selectbb='*';
$wherebb='styleId="'.$styleId.'" and bomSerialNo="'.$srNo.'" and commnetType="'.$_REQUEST['commnetType'].'" order by id desc limit 1';
$rsbb=GetPageRecord($selectbb,'materialCostChatMaster',$wherebb);
$materiallistdetail=mysqli_fetch_array($rsbb);
?>

<?php
$select='';
$where='';
$rs='';
$select='*';
$where='styleId="'.$styleId.'" and bomSerialNo="'.$srNo.'" and commnetType="'.$_REQUEST['commnetType'].'" order by id desc';
$rs=GetPageRecord($select,'materialCostChatMaster',$where);
$countrow = mysql_num_rows($rs);

if($countrow!='0') { ?>
<style>
.myclassforalign{
     max-height: 92px !important;
}
</style>

<div class="myclassforalign" style="margin-bottom: 0px; max-height: 215px; overflow-y: scroll; border: 2px solid #F7F7F7; padding-bottom: 20px;">

							<div class="card-body">

								<ul class="media-list">
									<?php
									while($resListing=mysqli_fetch_array($rs)){

									$select1='id';
									$where1='styleId="'.$styleId.'" and bomSerialNo="'.$srNo.'" order by id desc limit 1';
									$rs1=GetPageRecord($select1,'materialCostChatMaster',$where1);
									$lastchatid=mysqli_fetch_array($rs1);

									?>

									<style>
									.myClass{
									    background-color: #baffbc;
									}
									</style>
									<li class="media <?php if($_REQUEST['n']==$resListing['id']) { ?> myClass <?php } ?>" style="padding: 10px;border-bottom: 1px solid #f1f1f1;margin-top:0px;">
										<div class="mr-3">
											<a href="#" class="btn bg-transparent border-indigo-400 text-indigo-400 rounded-round border-2 btn-icon">
												<i class="icon-comment"></i>
											</a>
										</div>

										<div class="media-body">
											<div class="d-flex justify-content-between">
												<div class="media-title"><a href="#"><?php  echo getUserName($resListing['addedBy']); ?></a></div>
												<span class="font-size-sm text-muted"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('d M, Y - h:i A',$resListing['dateAdded'])?></span>
											</div>

<?php if($materiallistdetail['approvedStatus']=='1') { ?>
Approved By <strong><?php echo getUserName($materiallistdetail['addedBy']); ?></strong>
<?php } ?>

<?php if($materiallistdetail['approvedStatus']=='2') { ?>
Further Assigned By <strong><?php echo getUserName($materiallistdetail['addedBy']); ?></strong> To <strong><?php echo getUserName($materiallistdetail['assigedTo']); ?></strong>
<?php } ?>

<?php if($materiallistdetail['approvedStatus']=='3') { ?>
Request For Approvel To <strong><?php echo getUserName($materiallistdetail['assigedTo']); ?></strong> By <strong><?php echo getUserName($materiallistdetail['addedBy']); ?></strong>
<?php } ?>

<?php if($materiallistdetail['approvedStatus']=='4') { ?>
Rejected By <strong><?php echo getUserName($materiallistdetail['addedBy']); ?></strong>
<?php } ?>

<?php if($materiallistdetail['approvedStatus']=='5') { ?>
Request Cancelled By <strong><?php echo getUserName($materiallistdetail['addedBy']); ?></strong>
<?php } ?>



<?php if($materiallistdetail['approvedStatus']=='1' || $materiallistdetail['approvedStatus']=='2' || $materiallistdetail['approvedStatus']=='3' || $materiallistdetail['approvedStatus']=='4') { ?><br>Note - <?php }?> <?php echo $resListing['comment']; ?>
										</div>
									</li>
									<?php  } ?>
								</ul>
							</div>
						</div>
<?php } ?>

<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">

<?php if($_REQUEST['commnetType']!='0'){ ?>
<div class="col-md-6">
<div class="form-group">
<label>Change Status</label>
<select id="productstatus" name="productstatus" class="form-control" onchange="showassignuser();">

<?php if($_REQUEST['fortTimeSlot']=='11') { ?>
<option value="1" <?php if($materiallistdetail['approvedStatus']=='1') { ?> selected <?php } ?>>Approve</option>
<?php } ?>



<?php if($_REQUEST['fortTimeSlot']=='11') { ?>
<option value="2" <?php if($materiallistdetail['approvedStatus']=='2') { ?> selected <?php } ?>>Further Assign</option>
<?php } ?>

<?php if($_REQUEST['fortTimeSlot']!='11') { ?>
<option value="3" <?php if($materiallistdetail['approvedStatus']=='3') { ?> selected <?php } ?>>Request for Approvel</option>
<?php } ?>

<?php if($_REQUEST['fortTimeSlot']=='11') { ?>
<option value="4" <?php if($materiallistdetail['approvedStatus']=='4') { ?> selected <?php } ?>>Reject</option>
<?php } ?>

<?php if($_REQUEST['fortTimeSlot']!='11') { ?>
<option value="5">Cancel Request</option>
<?php } ?>


</select>
</div>
</div>

<?php if($materiallistdetail['approvedStatus']!='2' || $materiallistdetail['approvedStatus']!='3'){ ?>
<style>
#assigntoclass{
display:none;
}
</style>
<?php } ?>

<script>

showassignuser();

function showassignuser(){
var changestatus =$('#productstatus').val();
if(changestatus=='2' || changestatus=='3'){
document.getElementById("assigntoclass").style.display = "block";
<?php if($materiallistdetail['approvedStatus']=='3') { ?>
//showtimeslot();
<?php } ?>
}
else{
document.getElementById("assigntoclass").style.display = "none";
}
}
</script>

<div class="col-md-6" id="assigntoclass">
<div class="form-group">
<label>Assign To</label>
<!--<select id="assignTo" name="assignTo" class="form-control" onchange="showtimeslot();">-->
<select id="assignTo" name="assignTo" class="form-control">
<?php
$select='';
$where='';
$rs='';
$select='*';
$where=' id in (select id from userMaster where empId in (select reportingTo from employeeMaster where id="'.$_SESSION['empid'].'")) and deletestatus=0 and status=1  order by firstName asc';

$rs=GetPageRecord($select,'userMaster',$where);
while($resListing=mysqli_fetch_array($rs)){
?>
<option value="<?php echo strip($resListing['id']); ?>" <?php if($resListing['id']==$materiallistdetail['assigedTo']){ ?>selected="selected"<?php } ?>><?php echo strip($resListing['firstName']).' '.strip($resListing['lastName']); ?></option>
<?php } ?>

</select>
</div>
</div>


<?php if($materiallistdetail['approvedStatus']!='2' || $materiallistdetail['approvedStatus']!='3'){ ?>
<style>
#timeslotclasss{
display:none;
}
</style>
<?php } ?>

<script>
function showtimeslot(){
var changestatus =$('#productstatus').val();
var assignTo =$('#assignTo').val();
if(assignTo!='' && changestatus=='3'){
document.getElementById("timeslotclasss").style.display = "block";

$('#timeslotclasss').load("loadtimeslot.php?assignTo="+assignTo+"&scheduleId=<?php echo $materiallistdetail['scheduleId']; ?>&styleId=<?php echo $styleId; ?>");

}
else{
document.getElementById("timeslotclasss").style.display = "none";
}
}
</script>

<div class="col-md-12" id="timeslotclasss">
</div>

<?php } ?>

<script>
<?php if($materiallistdetail['approvedStatus']=='3' || $materiallistdetail['approvedStatus']=='2') { ?>
showassignuser();
<?php } ?>
</script>




<div class="col-md-12">
<div class="form-group">
<label>Remarks</label>
<input type="text" name="comment" class="form-control" id="comment" />

</div>
</div>


</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>

<?php if($_REQUEST['qualitySend']=='1'){ ?>
<script>
var actionAllQuality= parent.$('#actionAllQuality').val();

$('#QualityCheckUncheck').val(actionAllQuality);

</script>
<input type="hidden" name="QualityCheckUncheck" id="QualityCheckUncheck" value="" />
<?php } ?>


<?php if($_REQUEST['priceSend']=='1'){ ?>
<script>
var actionAllprice= parent.$('#actionAllprice').val();

$('#PriceCheckUncheck').val(actionAllprice);

</script>
<input type="hidden" name="PriceCheckUncheck" id="PriceCheckUncheck" value="" />
<?php } ?>


<?php if($_REQUEST['vendorSend']=='1'){ ?>
<script>
var actionAllvendor= parent.$('#actionAllvendor').val();

$('#VendorCheckUncheck').val(actionAllvendor);

</script>
<input type="hidden" name="VendorCheckUncheck" id="VendorCheckUncheck" value="" />
<?php } ?>


<input name="action" type="hidden" id="action" value="materialcostchat" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($styleId); ?>" />
<input name="bomSerialNo" type="hidden" id="bomSerialNo" value="<?php echo $_REQUEST['srno']; ?>" />
<input name="materialType" type="hidden" id="materialType" value="<?php echo $_REQUEST['materialType']; ?>" />
<input name="materialId" type="hidden" id="materialId" value="<?php echo $_REQUEST['materialId']; ?>" />
<input name="module" type="hidden" id="module" value="materialcost" />
<input type="hidden" name="costversionid" id="costversionid" value="<?php echo $costversionid; ?>" />
<input type="hidden" name="commnetType" id="commnetType" value="<?php echo $_REQUEST['commnetType']; ?>" />
<input type="hidden" name="id" id="id" value="<?php echo $_REQUEST['id']; ?>" />
<input type="hidden" name="fortTimeSlot" id="fortTimeSlot" value="<?php echo $_REQUEST['fortTimeSlot']; ?>" />

</form>


<?php }

if($_REQUEST['action']=='schedulemaster'){
if($_REQUEST['id']!=''){
$id=$_REQUEST['id'];

$select1='*';
$where1='id="'.$id.'"';
$rs1=GetPageRecord($select1,'sheduleMaster',$where1);
$editresult=mysqli_fetch_array($rs1);
}
?>


<?php
$adddate =$_REQUEST['adddate'];
$adddate =strtotime($adddate);
$currentdate=date('Y-m-d');
$currentdate =strtotime($currentdate);
if($adddate>=$currentdate){ ?>

<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">

<div class="col-md-4">
<div class="form-group">
<label>From Time</label>
<select id="fromTime" name="fromTime" class="form-control" autocomplete="off"   >
	<?php
	$start=strtotime('10:00');
	$end=strtotime('20:00');
	for ($i=$start;$i<=$end;$i = $i + 60*60)
	{ ?>
	<option value="<?php echo date('g:i A',$i); ?>" <?php if('10:00 AM'==date('g:i A',$i) && $_REQUEST['id']==''){ if($editresult['fromTime']==date('g:i A',$i)){ ?> selected="selected"<?php } } ?>><?php echo date('g:i A',$i); ?></option>
	<?php  }  ?>
</select>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>To Time</label>
<select id="toTime" name="toTime" class="form-control" autocomplete="off">
	<?php
	$start=strtotime('10:00');
	$end=strtotime('20:00');
	for ($i=$start;$i<=$end;$i = $i + 60*60){
	?>
	<option value="<?php echo date('g:i A',$i); ?>" <?php if('10:00 AM'==date('g:i A',$i) && $_REQUEST['id']==''){ if($editresult['toTime']==date('g:i A',$i)){ ?> selected="selected"<?php } } ?>><?php echo date('g:i A',$i); ?></option>
	<?php  }  ?>
</select>
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Limit</label>
<input name="approveLimit" type="text" class="form-control validate" id="approveLimit" value="<?php echo $editresult['approveLimit']; ?>" >
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<label>Notes</label>
<textarea name="description" class="form-control"><?php echo $editresult['description']; ?></textarea>
</div>
</div>

</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="addDate" type="hidden" id="addDate" value="<?php echo $_REQUEST['adddate']; ?>" />
</form>

<?php } else { ?>
<div style="padding: 20px;">You Can not set schedule of Previous date.</div>
<?php } ?>
<?php } ?>



<!--attach prchasse order-->
<?php if($_REQUEST['action']=='attachtopurchaseorder' && $_REQUEST['purchaseorderid']!=''){
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Style No</label>

<select id="styleid" name="styleid" class="form-control">
	 <option value="">Select</option>
	 <?php
	$select='*';
	$where='';
	$rs='';
	$where='1 and subject!="" order by id desc';
	$rs=GetPageRecord($select,'queryMaster',$where);
	while($resListing=mysqli_fetch_array($rs)){
	?>
	<option value="<?php echo $resListing['id']; ?>"><?php echo '#'.$resListing['styleRefId'].'-'.$resListing['subject']; ?></option>
	<?php } ?>

</select>

<script>
$(document).ready(function() {
$("#styleid").select2();
});
</script>

</div>
</div>

</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
<input name="action" type="hidden" id="action" value="attachtopurchaseorder" />
<input name="purchaseorderid" type="hidden" id="purchaseorderid" value="<?php echo $_REQUEST['purchaseorderid']; ?>" />
</form>

<?php } ?>

<!--add currency master -->

<!--attach prchasse order-->
<?php if($_REQUEST['action']=='currencymaster'){
if($_REQUEST['id']!=''){
$id=decode($_REQUEST['id']);

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'currencyMaster',$where1);
$editresult=mysqli_fetch_array($rs1);
}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Name</label>
<input name="name" type="text" class="form-control" id="name" value="<?php echo $editresult['name']; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Value</label>
<input name="currencyvalue" type="text" class="form-control" id="currencyvalue" value="<?php echo $editresult['value']; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Description</label>
<input name="description" type="text" class="form-control" id="description" value="<?php echo $editresult['description']; ?>" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Status</label>
<select name="status" id="status" class="form-control">
<option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active</option>
<option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>Inactive</option>
</select>
</div>
</div>

</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>

<?php } ?>

<!--add material type master -->
<?php if($_REQUEST['action']=='designationmaster'){
if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'designationMaster',$where1);
$editresult=mysqli_fetch_array($rs1);

}
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Name</label>
<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editresult['name']; ?>" >
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Status</label>
<select name="status" id="status" class="form-control validate">
<option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active</option>
<option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>Inactive</option>
</select>
</div>
</div>

</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>


<?php } ?>

<!--upload cost sheet  -->
<?php if($_REQUEST['action']=='uploadcostsheet'){
if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'queryMaster',$where1);
$editresult=mysqli_fetch_array($rs1);
$uploadedCostsheet =$editresult['uploadedCostsheet'];

}
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">

<div class="col-md-12">
						<div class="form-group">
						<label>Attach File</label>
						<div class="uniform-uploader">
						<input type="file" name="uploadedCostsheet" id="uploadedCostsheet" class="form-input-styled" data-fouc="">

						<span class="filename" style="user-select: none;">No file selected</span>
						<span class="action btn btn-secondary" style="user-select: none;"><i class="fa fa-upload"></i></span>


						<script>
							$('#uploadedCostsheet').on('change',function(){
							//get the file name
							var fileName = $(this).val();
							//replace the "Choose a file" label
							$(this).next('.filename').html(fileName);
							})
						</script>

						<input type="hidden" name="finaluploadedCostsheet" id="finaluploadedCostsheet" value="<?php echo $uploadedCostsheet; ?>"/>

						</div>

						</div>
					</div>

</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
<input name="action" type="hidden" id="action" value="uploadcostsheet" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
</form>


<?php }

if($_REQUEST['action']=='sendtoinhouseoutsource' && $_REQUEST['styleId']!=''){

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">

<div class="col-md-12">
<div class="form-group">
<label>Inhouse/Outsource</label>
<select name="statusId" id="statusId" class="form-control validate" onchange="assignto(this.value);">
<option value="">Select</option>
<option value="20">Inhouse</option>
<option value="19">Outsource</option>
</select>
</div>
</div>

<script>
function assignto(id){
	if(id==20){
		$('#showpurchaseteamdiv').show();
		$('#showvendordiv').hide();
	}
	if(id==19){
		$('#showpurchaseteamdiv').hide();
		$('#showvendordiv').show();
	}
}



</script>

<div class="col-md-12" id="showvendordiv"  style="display:none;">
<div class="form-group">
<label>Assign To Outsource</label>
<select name="assignTo" id="assignTo" class="form-control">
<option value="">Select</option>
<?php
$select='';
$where='';
$rs='';
$select='*';
$where='profileId=90';
$rs=GetPageRecord($select,'userMaster',$where);
while($rest=mysqli_fetch_array($rs)){
?>
<option value="<?php echo $rest['id']; ?>"><?php echo $rest['firstName'].' '.$rest['lastName
']; ?></option>
<?php } ?>
</select>
</div>
</div>

<div class="col-md-12" id="showpurchaseteamdiv"  style="display:none;">
<div class="form-group">
<label>Assign To Merchandising</label>
<select name="merchandisingId" id="merchandisingId" class="form-control">
<option value="">Select</option>
<?php
$select='';
$where='';
$rs='';
$select='*';
$where='profileId=88';
$rs=GetPageRecord($select,'userMaster',$where);
while($rest=mysqli_fetch_array($rs)){
?>
<option value="<?php echo $rest['id']; ?>"><?php echo $rest['firstName'].' '.$rest['lastName
']; ?></option>
<?php } ?>
</select>
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Notes</label>
<input name="notes" type="text" class="form-control" id="notes" value="<?php echo $editresult['notes']; ?>" >
</div>
</div>


</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="module" type="hidden" id="module" value="buyerpo>" />
<input type="hidden" name="styleId" value="<?php echo $_REQUEST['styleId']; ?>" />
</form>


<?php }

if($_REQUEST['action']=='sendtooutsourcemerchant' && $_REQUEST['styleId']!=''){

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">

<div class="col-md-12" id="showvendordiv">
<div class="form-group">
<label>Assign To</label>
<select name="assignTo" id="assignTo" class="form-control">
<option value="">Select</option>
<?php
$select='';
$where='';
$rs='';
$select='*';
$where='id in (select id from userMaster where empId in (select id from employeeMaster where reportingTo="'.$_SESSION['empid'].'")) and deletestatus=0 and status=1 and profileId=156 order by firstName asc';
$rs=GetPageRecord($select,'userMaster',$where);
while($rest=mysqli_fetch_array($rs)){
?>
<option value="<?php echo $rest['id']; ?>"><?php echo $rest['firstName'].' '.$rest['lastName
']; ?></option>
<?php } ?>
</select>
</div>
</div>



<div class="col-md-12">
<div class="form-group">
<label>Notes</label>
<input name="notes" type="text" class="form-control" id="notes" value="<?php echo $editresult['notes']; ?>" >
</div>
</div>


</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="module" type="hidden" id="module" value="vendoroutsourcing>" />
<input type="hidden" name="styleId" value="<?php echo $_REQUEST['styleId']; ?>" />
</form>


<?php }

//Material Send to supplier

if($_REQUEST['action']=='materialSendToSupplier'){

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">

<div class="col-xl-4">
<div class="form-group">
<label>Select Supplier</label>
					<select id="supplierId" multiple="multiple" name="supplierId[]">
					<?php
					$select='';
					$where='';
					$rs='';
					$select='*';
					$where='1 order by name asc';
					$rs=GetPageRecord($select,'suppliersMaster',$where);

					while($rest=mysqli_fetch_array($rs)){
					?>
					<option value="<?php echo $rest['id']; ?>"><?php echo $rest['name']; ?></option>
					<?php } ?>
					</select>
</div>
</div>

<div class="col-xl-8">
<div class="form-group">
<label>Remark</label>
<input name="remark" type="text" class="form-control" id="remark" value="" >
</div>
</div>

<div class="col-xl-12">

				 <div class="mb-0 rounded-bottom-0" style="max-height:380px; overflow-y:auto;">
				 	<div class="panel panel-flat">
					 <div class="table-responsive">
					    <table width="100%" class="table table-bordered table-responsive" id="tableid11">
                          <tbody style="width: 100%;display: inline-table;">
                            <tr class="card-body">
						     <td width="5%" align="left">
							 <input  name="inhouseMaterial<?php echo $_REQUEST['costsheetVersionId']; ?>" type="checkbox" class="inhouseMaterialClass" id="inhouseMaterial<?php echo $_REQUEST['costsheetVersionId']; ?>" style="height: 17px; width: 30px; margin-top: 4px; text-align: center;" onclick="getMaterialIdforSelect<?php echo $_REQUEST['costsheetVersionId']; ?>();"/>


							  </td>
							 <td width="15%" align="left"><strong>Name</strong></td>
                             <td width="30%" align="left"><strong>Description</strong></td>
                             <td width="30%" align="center"><strong>Comment</strong></td>
							<td width="25%" align="left"><strong>Send&nbsp;To</strong></td>

                            </tr>
<?php
$selectz='profileid';
$wherez='id="'.$_SESSION['userid'].'"';
$rsz=GetPageRecord($selectz,'userMaster',$wherez);
$resListingz=mysqli_fetch_array($rsz);
$profileid=$resListingz['profileid'];

$select22='*';
if($profileid=='154'){
$wheresearchassign=' 1 and  FIND_IN_SET('.$_SESSION['userid'].',assignTo) and ';
}else{
$wheresearchassign=' 1 and  FIND_IN_SET('.$_SESSION['userid'].',assignToPurMerchant) and ';
}

$where22=''.$wheresearchassign.' styleId="'.decode($_REQUEST['styleId']).'" and costsheetVersionId="'.$_REQUEST['costsheetVersionId'].'" order by sr asc';

$rs22=GetPageRecord($select22,'styleSubCategoryMaster',$where22);
$srtype = mysql_num_rows($rs22);
while($resListing1=mysqli_fetch_array($rs22)){

$select3='*';
$where3='costsheetVersionId="'.$_REQUEST['costsheetVersionId'].'" and styleId="'.decode($_REQUEST['styleId']).'" and materialId="'.$resListing1['id'].'"';
$rstype3=GetPageRecord($select3,'materialSendToSupplier',$where3);
$resListingtype3=mysqli_fetch_array($rstype3);
?>
					<tr class="card-body">
					 <td align="left">
					   <input type="checkbox" value="<?php echo $resListing1['id']; ?>" name="inhouseMaterialCheck[]" class="Checkedinhouse<?php echo $_REQUEST['costsheetVersionId']; ?>" style="height: 17px; width: 30px; margin-top: 4px; text-align: center;" onclick="getMaterialId<?php echo $_REQUEST['costsheetVersionId']; ?>();"/>
					  </td>


					<td align="left"><?php echo $resListing1['name']; ?></td>
					<td align="left"><?php echo getDescriptionName($resListing1['materialdescriptionid']); ?></td>
					<td align="center">
					<?php
					$select123='*';
					$where123='styleId="'.decode($_REQUEST['styleId']).'" and costVersionId="'.$_REQUEST['costsheetVersionId'].'" and commnetType=0 and materialId="'.$resListing1['id'].'" order by id asc limit 1';
					$rs123=GetPageRecord($select123,'materialCostChatMaster',$where123);
					$chatcount1=mysqli_fetch_array($rs123);
					?>
					<input name="inhouseRemark<?php echo $resListing1['id']; ?>" type="text" id="inhouseRemark<?php echo $resListing1['id']; ?>" autocomplete="off" style="width: 100%;"  value="<?php if($resListingtype3['inhouseRemark']!=''){ echo $resListingtype3['inhouseRemark']; }else{ echo $chatcount1['comment']; } ?>" />
					</td>
					<td align="left">
					<?php
					$select123='*';
					$where123='styleId="'.decode($_REQUEST['styleId']).'" and costsheetVersionId="'.$_REQUEST['costsheetVersionId'].'"';
					$rs123=GetPageRecord($select123,'materialSendToSupplier',$where123);
					while($resListing123=mysqli_fetch_array($rs123)){

					if($resListing123['materialId']==$resListing1['id']){
						$select='*';
						$where='id="'.$resListing123['supplierId'].'"';
						$rstype=GetPageRecord($select,'suppliersMaster',$where);
						$resListingtype=mysqli_fetch_array($rstype);
					?>
					<span class="badge bg-success" style="margin-bottom: 5px; padding: 6px 5px; font-size: 10px;"><?php echo $resListingtype['name']; ?></span>

				  <?php } } ?></td>




												 </tr>
<?php } ?>
                          </tbody>

                        </table>
					  </div>
					</div>
				  </div>



				 </div>

</div>
</div>

<input name="assignToMaterialInhouse" id="assignToMaterialInhouse" type="hidden" value="0" />
<input name="action" type="hidden" id="action" value="materialSendToSupplier" />
<input name="styleId" type="hidden" id="styleId" value="<?php echo $_REQUEST['styleId']; ?>" />
<input name="costsheetVersionId" type="hidden" id="costsheetVersionId" value="<?php echo $_REQUEST['costsheetVersionId']; ?>" />
<!--<div style="width: 50%; float: left; padding-left: 15px;"><a href="<?php echo $fullurl; ?>submit-supplier.php?st=<?php echo $_REQUEST['styleId']; ?>&cv=<?php echo encode($_REQUEST['costsheetVersionId']); ?>&s=<?php echo encode($assignSupplierId); ?>&p=1" target="_blank" class="btn bg-info" style="background-color: #009933 !important;">Preview</a></div>-->


<div class="modal-footer" style="width:50%;float:right;">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Send</button>
</div>
</form>


<script type="text/javascript">
		$(document).ready(function(){
		// check uncheck all inclusions
		$("#inhouseMaterial<?php echo $_REQUEST['costsheetVersionId']; ?>").click(function(){
		if(this.checked){
		$('.Checkedinhouse<?php echo $_REQUEST['costsheetVersionId']; ?>').each(function(){
		this.checked = true;


		})
		}else{
		$('.Checkedinhouse<?php echo $_REQUEST['costsheetVersionId']; ?>').each(function(){
		this.checked = false;
	   })
		}
		});

		});
</script>


<script>
$(function() {
$('#supplierId').multiselect({
includeSelectAllOption: true,
enableFiltering: true,
enableCaseInsensitiveFiltering: true,
filterPlaceholder: 'Search...'
});
});

function getMaterialId<?php echo $_REQUEST['costsheetVersionId']; ?>(){
var assignToMaterialInhouse='';
  $('input:checkbox.Checkedinhouse<?php echo $_REQUEST['costsheetVersionId']; ?>').each(function () {
var sThisVal = (this.checked ? $(this).val() : "");

if(sThisVal!=''){
assignToMaterialInhouse = assignToMaterialInhouse+sThisVal+',';

}

});
$('#assignToMaterialInhouse').val(assignToMaterialInhouse);
}

function getMaterialIdforSelect<?php echo $_REQUEST['costsheetVersionId']; ?>(){
var assignToMaterialInhouse='';
  $('input:checkbox.Checkedinhouse<?php echo $_REQUEST['costsheetVersionId']; ?>').each(function () {
var sThisVal = (this.checked ? "" : $(this).val());

if(sThisVal!=''){
assignToMaterialInhouse = assignToMaterialInhouse+sThisVal+',';

}

});
$('#assignToMaterialInhouse').val(assignToMaterialInhouse);

}
</script>



<?php }

if($_REQUEST['action']=='sendtovendor' && $_REQUEST['styleId']!=''){

$defaultcostsheetVersionId = $_REQUEST['defaultcostsheetVersionId'];
$styleId = $_REQUEST['styleId'];

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">

<div class="col-md-12" id="showvendordiv">
<div class="form-group">
<label>Select Vendor</label>
<select name="vendorId[]" id="vendorId" class="form-control" multiple="multiple">
<?php
$select='';
$where='';
$rs='';
$select='*';
$where='1 order by name asc';
$rs=GetPageRecord($select,'vendorMaster',$where);
while($rest=mysqli_fetch_array($rs)){
?>
<option value="<?php echo $rest['id']; ?>"><?php echo $rest['name']; ?></option>
<?php } ?>
</select>
</div>
</div>


<div class="col-md-12">
<div class="form-group">
<label>Notes</label>
<input name="notes" type="text" class="form-control" id="notes" value="<?php echo $editresult['notes']; ?>" >
</div>
</div>


</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">Save</button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input type="hidden" name="styleId" value="<?php echo $_REQUEST['styleId']; ?>" />
<input type="hidden" name="costsheetVersionId" value="<?php echo $defaultcostsheetVersionId; ?>" />
</form>

<script>
$(function() {
$('#vendorId').multiselect({
includeSelectAllOption: true,
enableFiltering: true,
enableCaseInsensitiveFiltering: true,
filterPlaceholder: 'Search...'
});
});

</script>

<?php }

//Factory Master
if($_REQUEST['action']=='factorymaster'){
if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'factoryMaster',$where1);
$editresult=mysqli_fetch_array($rs1);
}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-4">
<div class="form-group">
<label>Name</label>
<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editresult['name']; ?>" >
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Line</label>
<input name="line" type="number" class="form-control validate" id="line" value="<?php echo $editresult['line']; ?>" >
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Workers</label>
<input name="workers" type="number" class="form-control validate" id="workers" value="<?php echo $editresult['workers']; ?>" >
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Detail</label>
<textarea name="description" id="description" class="form-control"><?php echo $editresult['description']; ?></textarea>
</div>
</div>
</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">  Save  </button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>

<?php }

//Holiday Calender Master
if($_REQUEST['action']=='holidaycalender'){
if($_GET['id']!=''){
$id=clean(decode($_GET['id']));

$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'holidayMaster',$where1);
$editresult=mysqli_fetch_array($rs1);
}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Factory</label>
<select name="factoryId" id="factoryId" class="form-control">
	<option>Select</option>
<?php
$select='';
$where='';
$rs='';
$select='*';
$where='1 order by name asc';
$rs=GetPageRecord($select,'factoryMaster',$where);
while($resListing=mysqli_fetch_array($rs)){
?>
<option value="<?php echo $resListing['id']; ?>"><?php echo $resListing['name']; ?></option>
<?php } ?>
</select>
</div>
</div>

<!--<div class="col-md-4">
<div class="form-group">
<label>Weekend</label>
<input name="weekend" type="text" class="form-control validate" id="weekend" value="<?php echo $editresult['weekend']; ?>" >
</div>
</div>-->

<div class="col-md-6">
<div class="form-group">
<label>Holiday&nbsp;Name</label>
<input name="name" type="text" class="form-control validate" id="name" value="<?php echo $editresult['name']; ?>" >
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Start&nbsp;Date</label>
<input name="line" type="number" class="form-control validate" id="line" value="<?php echo $editresult['line']; ?>" >
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>End&nbsp;Date</label>
<input name="workers" type="number" class="form-control validate" id="workers" value="<?php echo $editresult['workers']; ?>" >
</div>
</div>


</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
<button type="submit" class="btn bg-info">  Save  </button>
</div>
<input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
<input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
<input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>

<?php }

 ?>


