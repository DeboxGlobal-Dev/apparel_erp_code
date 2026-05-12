<?php

include "inc.php";

?>
<script>
$(document).ready(function() {

    $(".select2").select2();

});
</script>
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
                    <input name="from_name" type="text" class="form-control" id="from_name"
                        value="<?php echo $emailsetting['from_name']; ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email</label>
                    <input name="email" type="text" class="form-control" id="email"
                        value="<?php echo $emailsetting['email']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Password </label>
                    <input name="password" type="password" class="form-control" id="password"
                        value="<?php echo $emailsetting['password']; ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>SMTP Server</label>
                    <input name="smtp_server" type="text" class="form-control" id="smtp_server"
                        value="<?php echo $emailsetting['smtp_server']; ?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Outgoing Port</label>
                    <input name="port" type="number" class="form-control" id="port"
                        value="<?php echo $emailsetting['port']; ?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Incoming Port</label>
                    <input name="incomingPort" type="number" class="form-control" id="incomingPort"
                        value="<?php echo $emailsetting['incomingPort']; ?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Security Type</label>
                    <select id="security_type" name="security_type" class="form-control validate"
                        displayname="Security Type" autocomplete="off">
                        <option value="false" <?php if($emailsetting['security_type']=='false'){ ?>selected="selected"
                            <?php } ?>>None</option>
                        <option value="true" <?php if($emailsetting['security_type']=='true'){ ?>selected="selected"
                            <?php } ?>>SSL</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
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
                    <input name="subject" type="text" class="form-control" id="subject"
                        value="<?php echo $editsubject; ?>" displayname="Subject" maxlength="200" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Status</label>
                    <select id="status" name="status" class="form-control" autocomplete="off">
                        <?php

$select='';

$where='';

$rs='';

$select='*';

$where='id!="" order by id';

$rs=GetPageRecord($select,_CALLS_STATUS_MASTER_,$where);

while($rest=mysqli_fetch_array($rs)){

?>
                        <option value="<?php echo $rest['id']; ?>"
                            <?php if($statusedit==$rest['id']){ ?>selected="selected" <?php } ?>>
                            <?php echo $rest['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Start Date</label>
                    <input name="fromDate" type="text" class="form-control daterange-single" id="fromDate"
                        value="<?php echo $fromDate; ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Start Time</label>
                    <select id="starttime" name="starttime" class="form-control" autocomplete="off">
                        <?php

$start=strtotime('00:00');

   $end=strtotime('23:30');

    for ($i=$start;$i<=$end;$i = $i + 15*60)

    { ?>
                        <option value="<?php echo date('g:i A',$i); ?>"
                            <?php if('10:00 AM'==date('g:i A',$i) && $_REQUEST['id']==''){ ?> selected="selected"
                            <?php } ?> <?php if($editstarttime==date('g:i A',$i)){ ?> selected="selected" <?php } ?>>
                            <?php echo date('g:i A',$i); ?>
                        </option>

                        ;



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
                    <select id="endtime" name="endtime" class="form-control" autocomplete="off">
                        <?php

$start=strtotime('00:00');

   $end=strtotime('23:30');

    for ($i=$start;$i<=$end;$i = $i + 15*60)

    { ?>
                        <option value="<?php echo date('g:i A',$i); ?>"
                            <?php if('11:00 AM'==date('g:i A',$i) && $_REQUEST['id']==''){  ?> selected="selected"
                            <?php } ?> <?php if($editendtime==date('g:i A',$i)){ ?> selected="selected" <?php } ?>>
                            <?php echo date('g:i A',$i); ?>
                        </option>

                        ;



                        <?php  }  ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Client Type</label>
                    <select id="clientType" name="clientType" class="form-control" displayname="Client Type"
                        autocomplete="off" onchange="relatedtocompany();">
                        <option value="" <?php if(1==$clientType){ ?>selected="selected" <?php } ?>>Select</option>
                        <option value="1" <?php if(1==$clientType){ ?>selected="selected" <?php } ?>>Account</option>
                        <option value="2" <?php if(2==$clientType){ ?>selected="selected" <?php } ?>>Contact</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Related To</label>
                    <select id="parentId" name="parentId" class="form-control" displayname="Client Type"
                        autocomplete="off">
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
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($editcompanyId==$resListing['id']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListing['name']); ?></option>
                        <?php } } else {

$select='';

$where='';

$rs='';

$select='*';

$where=' firstName!=""';

$rs=GetPageRecord($select,'contactsMaster',$where);

while($resListing=mysqli_fetch_array($rs)){

?>
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($editcompanyId==$resListing['id']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListing['firstName']); ?> <?php echo strip($resListing['lastName']); ?>
                        </option>
                        <?php } }  }?>
                    </select>
                    <script>
                    function relatedtocompany() {

                        var clientType = $('#clientType').val();

                        $('#parentId').load('relatedtocompany.php?clientType=' + clientType);

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
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id']==$editassignTo){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListing['firstName']); ?></option>
                        <?php } ?>
                    </select>
                    <script>
                    function relatedtocompany() {

                        var clientType = $('#clientType').val();

                        $('#parentId').load('relatedtocompany.php?clientType=' + clientType);

                    }
                    </script>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="3" class="form-control"
                        id="description"><?php echo $editdescription; ?></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
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
                    <input name="subject" type="text" class="form-control" id="subject"
                        value="<?php echo $editsubject; ?>" displayname="Subject" maxlength="200" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Status</label>
                    <select id="status" name="status" class="form-control" autocomplete="off">
                        <?php

$select='';

$where='';

$rs='';

$select='*';

$where='id!="" order by id';

$rs=GetPageRecord($select,_CALLS_STATUS_MASTER_,$where);

while($rest=mysqli_fetch_array($rs)){

?>
                        <option value="<?php echo $rest['id']; ?>"
                            <?php if($statusedit==$rest['id']){ ?>selected="selected" <?php } ?>>
                            <?php echo $rest['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Start Date</label>
                    <input name="fromDate" type="text" class="form-control daterange-single" id="fromDate"
                        value="<?php echo $fromDate; ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Start Time</label>
                    <select id="starttime" name="starttime" class="form-control" autocomplete="off">
                        <?php

$start=strtotime('00:00');

   $end=strtotime('23:30');

    for ($i=$start;$i<=$end;$i = $i + 15*60)

    { ?>
                        <option value="<?php echo date('g:i A',$i); ?>"
                            <?php if('10:00 AM'==date('g:i A',$i) && $_REQUEST['id']==''){ ?> selected="selected"
                            <?php } ?> <?php if($editstarttime==date('g:i A',$i)){ ?> selected="selected" <?php } ?>>
                            <?php echo date('g:i A',$i); ?>
                        </option>

                        ;



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
                    <select id="endtime" name="endtime" class="form-control" autocomplete="off">
                        <?php

$start=strtotime('00:00');

   $end=strtotime('23:30');

    for ($i=$start;$i<=$end;$i = $i + 15*60)

    { ?>
                        <option value="<?php echo date('g:i A',$i); ?>"
                            <?php if('11:00 AM'==date('g:i A',$i) && $_REQUEST['id']==''){  ?> selected="selected"
                            <?php } ?> <?php if($editendtime==date('g:i A',$i)){ ?> selected="selected" <?php } ?>>
                            <?php echo date('g:i A',$i); ?>
                        </option>

                        ;



                        <?php  }  ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Client Type</label>
                    <select id="clientType" name="clientType" class="form-control" displayname="Client Type"
                        autocomplete="off" onchange="relatedtocompany();">
                        <option value="" <?php if(1==$clientType){ ?>selected="selected" <?php } ?>>Select</option>
                        <option value="1" <?php if(1==$clientType){ ?>selected="selected" <?php } ?>>Account</option>
                        <option value="2" <?php if(2==$clientType){ ?>selected="selected" <?php } ?>>Contact</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Related To</label>
                    <select id="parentId" name="parentId" class="form-control" displayname="Client Type"
                        autocomplete="off">
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
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($editcompanyId==$resListing['id']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListing['name']); ?></option>
                        <?php } } else {

$select='';

$where='';

$rs='';

$select='*';

$where=' firstName!=""';

$rs=GetPageRecord($select,'contactsMaster',$where);

while($resListing=mysqli_fetch_array($rs)){

?>
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($editcompanyId==$resListing['id']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListing['firstName']); ?> <?php echo strip($resListing['lastName']); ?>
                        </option>
                        <?php } }  }?>
                    </select>
                    <script>
                    function relatedtocompany() {

                        var clientType = $('#clientType').val();

                        $('#parentId').load('relatedtocompany.php?clientType=' + clientType);

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
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id']==$editassignTo){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListing['firstName']); ?></option>
                        <?php } ?>
                    </select>
                    <script>
                    function relatedtocompany() {

                        var clientType = $('#clientType').val();

                        $('#parentId').load('relatedtocompany.php?clientType=' + clientType);

                    }
                    </script>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="3" class="form-control"
                        id="description"><?php echo $editdescription; ?></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
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
                    <input name="subject" type="text" class="form-control" id="subject"
                        value="<?php echo $editsubject; ?>" displayname="Subject" maxlength="200" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Status</label>
                    <select id="status" name="status" class="form-control" autocomplete="off">
                        <?php

$select='';

$where='';

$rs='';

$select='*';

$where='id!="" order by id';

$rs=GetPageRecord($select,_CALLS_STATUS_MASTER_,$where);

while($rest=mysqli_fetch_array($rs)){

?>
                        <option value="<?php echo $rest['id']; ?>"
                            <?php if($statusedit==$rest['id']){ ?>selected="selected" <?php } ?>>
                            <?php echo $rest['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Start Date</label>
                    <input name="fromDate" type="text" class="form-control daterange-single" id="fromDate"
                        value="<?php echo $fromDate; ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Start Time</label>
                    <select id="starttime" name="starttime" class="form-control" autocomplete="off">
                        <?php

$start=strtotime('00:00');

   $end=strtotime('23:30');

    for ($i=$start;$i<=$end;$i = $i + 15*60)

    { ?>
                        <option value="<?php echo date('g:i A',$i); ?>"
                            <?php if('10:00 AM'==date('g:i A',$i) && $_REQUEST['id']==''){ ?> selected="selected"
                            <?php } ?> <?php if($editstarttime==date('g:i A',$i)){ ?> selected="selected" <?php } ?>>
                            <?php echo date('g:i A',$i); ?>
                        </option>

                        ;



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
                    <select id="endtime" name="endtime" class="form-control" autocomplete="off">
                        <?php

$start=strtotime('00:00');

   $end=strtotime('23:30');

    for ($i=$start;$i<=$end;$i = $i + 15*60)

    { ?>
                        <option value="<?php echo date('g:i A',$i); ?>"
                            <?php if('11:00 AM'==date('g:i A',$i) && $_REQUEST['id']==''){  ?> selected="selected"
                            <?php } ?> <?php if($editendtime==date('g:i A',$i)){ ?> selected="selected" <?php } ?>>
                            <?php echo date('g:i A',$i); ?>
                        </option>

                        ;



                        <?php  }  ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Client Type</label>
                    <select id="clientType" name="clientType" class="form-control" displayname="Client Type"
                        autocomplete="off" onchange="relatedtocompany();">
                        <option value="">Select</option>
                        <option value="1" <?php if(1==$clientType){ ?>selected="selected" <?php } ?>>Account</option>
                        <option value="2" <?php if(2==$clientType){ ?>selected="selected" <?php } ?>>Contact</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Related To</label>
                    <select id="parentId" name="parentId" class="form-control" displayname="Client Type"
                        autocomplete="off">
                        <option value="0">Select Related To</option>
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
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($editcompanyId==$resListing['id']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListing['name']); ?></option>
                        <?php } } else {

$select='';

$where='';

$rs='';

$select='*';

$where=' firstName!=""';

$rs=GetPageRecord($select,'contactsMaster',$where);

while($resListing=mysqli_fetch_array($rs)){

?>
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($editcompanyId==$resListing['id']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListing['firstName']); ?> <?php echo strip($resListing['lastName']); ?>
                        </option>
                        <?php } }  }?>
                    </select>
                    <script>
                    function relatedtocompany() {

                        var clientType = $('#clientType').val();

                        $('#parentId').load('relatedtocompany.php?clientType=' + clientType);

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
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id']==$editassignTo){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListing['firstName']); ?></option>
                        <?php } ?>
                    </select>
                    <script>
                    function relatedtocompany() {

                        var clientType = $('#clientType').val();

                        $('#parentId').load('relatedtocompany.php?clientType=' + clientType);

                    }
                    </script>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="3" class="form-control"
                        id="description"><?php echo $editdescription; ?></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
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

$edituserName=clean($editresult['userName']);

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
                    <input name="firstName" type="text" class="form-control" id="firstName"
                        value="<?php echo $editfirstName; ?>" maxlength="200" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Last Name</label>
                    <input name="lastName" type="text" class="form-control" id="lastName"
                        value="<?php echo $editlastName; ?>" maxlength="200" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Username (Login)</label>
                    <input name="email" type="text" class="form-control" id="email" value="<?php echo $editEmail; ?>"
                        maxlength="200" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email </label>
                    <input name="userName" type="text" class="form-control" id="userName"
                        value="<?php echo $edituserName; ?>" maxlength="200" />
                </div>
            </div>
            <?php if($_GET['id']!=''){ ?>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Password</label>
                    <input name="password" type="password" class="form-control" id="password"
                        value="<?php echo $editPassword; ?>" maxlength="200" />
                </div>
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
                    <input name="phone" type="text" class="form-control" id="phone" value="<?php echo $editPhone; ?>"
                        maxlength="200" />
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
                        <option value="1" <?php if('1'==$editresult['status']){ ?>selected="selected" <?php } ?>>Active
                        </option>
                        <option value="0" <?php if('0'==$editresult['status']){ ?>selected="selected" <?php } ?>>
                            Inactive</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Profile</label>
                    <select id="profileId" name="profileId" class="form-control" displayname="Profile"
                        autocomplete="off">
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
                        <option value="<?php echo strip($timeformat['id']); ?>"
                            <?php if($timeformat['id']==$editprofileId){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($timeformat['profileName']); ?></option>
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
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id']==$editemployee){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListing['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row"> </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <?php if(decode($_REQUEST['id'])!='1'){ ?>
        <button type="submit" class="btn bg-info"> Save </button>
        <?php } ?>
    </div>
    <?php if(decode($_REQUEST['id'])!='1'){ ?>
    <input name="action" type="hidden" id="action" value="edituser" />
    <input name="editId" type="hidden" id="editId" value="<?php echo ($_REQUEST['id']); ?>">
    <?php } ?>
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
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id'] == $editresult['countryId']){ echo 'selected="selected"';  } ?>>
                            <?php echo strip($resListing['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
        </div>
        <div class="row"> </div>
        <div class="row"> </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="editdestination" />
    <?php

		if($_GET['id']!=''){

		?>
    <input name="editedityes" type="hidden" id="editedityes" value="1" />
    <?php } ?>
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
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
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id'] == $editresult['countryId']){ echo 'selected="selected"';  } ?>>
                            <?php echo strip($resListing['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
        </div>
        <div class="row"> </div>
        <div class="row"> </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="editdcity" />
    <?php

		if($_GET['id']!=''){

		?>
    <input name="editedityes" type="hidden" id="editedityes" value="1" />
    <?php } ?>
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
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
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
        </div>
        <div class="row"> </div>
        <div class="row"> </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="editcountry" />
    <?php

		if($_GET['id']!=''){

		?>
    <input name="editedityes" type="hidden" id="editedityes" value="1" />
    <?php } ?>
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
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
                        <option value="1" <?php if(1 == $editresult['sectionType']){ echo 'selected="selected"';  } ?>>
                            Transfer</option>
                        <option value="2" <?php if(2 == $editresult['sectionType']){ echo 'selected="selected"';  } ?>>
                            Sightseeing</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select id="status" name="status" class="form-control">
                        <option value="0" <?php if(0 == $editresult['status']){ echo 'selected="selected"';  } ?>>Active
                        </option>
                        <option value="1" <?php if(1 == $editresult['status']){ echo 'selected="selected"';  } ?>>
                            InActive</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row"> </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="salesPoints" />
    <?php

		if($_GET['id']!=''){

		?>
    <input name="editedityes" type="hidden" id="editedityes" value="1" />
    <?php } ?>
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
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
                        <option value="1" <?php if(1 == $editresult['sectionType']){ echo 'selected="selected"';  } ?>>
                            Transfer</option>
                        <option value="2" <?php if(2 == $editresult['sectionType']){ echo 'selected="selected"';  } ?>>
                            Sightseeing</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select id="status" name="status" class="form-control">
                        <option value="0" <?php if(0 == $editresult['status']){ echo 'selected="selected"';  } ?>>Active
                        </option>
                        <option value="1" <?php if(1 == $editresult['status']){ echo 'selected="selected"';  } ?>>
                            InActive</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row"> </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="inclusions" />
    <?php

		if($_GET['id']!=''){

		?>
    <input name="editedityes" type="hidden" id="editedityes" value="1" />
    <?php } ?>
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
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
                        <option value="1" <?php if(1 == $editresult['sectionType']){ echo 'selected="selected"';  } ?>>
                            Transfer</option>
                        <option value="2" <?php if(2 == $editresult['sectionType']){ echo 'selected="selected"';  } ?>>
                            Sightseeing</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select id="status" name="status" class="form-control">
                        <option value="0" <?php if(0 == $editresult['status']){ echo 'selected="selected"';  } ?>>Active
                        </option>
                        <option value="1" <?php if(1 == $editresult['status']){ echo 'selected="selected"';  } ?>>
                            InActive</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row"> </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="exclusions" />
    <?php

		if($_GET['id']!=''){

		?>
    <input name="editedityes" type="hidden" id="editedityes" value="1" />
    <?php } ?>
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
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
                        <option value="1"
                            <?php if(transfer == $editresult['categoryType']){ echo 'selected="selected"';  } ?>>
                            Transfer</option>
                        <option value="2"
                            <?php if(sightseeing == $editresult['categoryType']){ echo 'selected="selected"';  } ?>>
                            Sightseeing</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select id="status" name="status" class="form-control">
                        <option value="0" <?php if(0 == $editresult['status']){ echo 'selected="selected"';  } ?>>Active
                        </option>
                        <option value="1" <?php if(1 == $editresult['status']){ echo 'selected="selected"';  } ?>>
                            InActive</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row"> </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="categoryType" />
    <?php

		if($_GET['id']!=''){

		?>
    <input name="editedityes" type="hidden" id="editedityes" value="1" />
    <?php } ?>
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
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
                    <input name="photo" type="file" class="form-control" id="photo">
                </div>
            </div>
        </div>
        <div class="row"> </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
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
                    <label>Segment</label>
                    <select name="segmentId" id="segmentId" class="form-control">
                        <option value="">Select</option>
                        <?php

$a=GetPageRecord('*','segmenteMaster','1 and name!="" order by name asc');

while($segData=mysqli_fetch_array($a)){

?>
                        <option value="<?php echo $segData['id']; ?>"
                            <?php if($segData['id']==$editresult['segmentId']){ ?> selected="selected" <?php } ?>>
                            <?php echo $segData['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <?php /*?><div class="col-md-6">

                <div class="form-group">

                    <label>Material</label>

                    <select id="multiselect" multiple="multiple" name="material[]">

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

                        <option value="<?php echo $rest['id']; ?>"
                            <?php foreach ($array as $item) { if($rest['id']==$item){ ?>selected <?php } }?>>
                            <?php echo $rest['name']; ?></option>

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
                    <input name="description" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['description']; ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
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
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Description</label>
                    <input name="description" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['description']; ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
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
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id']==$editresult['departmentId']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListing['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Category</label>
                    <select id="categoryId" name="categoryId" class="form-control" displayname="Category"
                        onchange="selectsubcategory();">
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
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id']==$editresult['categoryId']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListing['name']); ?></option>
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
                    function selectsubcategory() {

                        var categoryId = $('#categoryId').val();

                        $('#subCategoryId').load('loadsubcategory.php?id=' + categoryId +
                            '&selectId=<?php echo $editresult['subCategoryId']; ?>');

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
                    <input name="duration" type="number" class="form-control" id="duration" displayname="Name"
                        value="<?php echo $editresult['duration']; ?>" maxlength="100" />
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php }

if($_REQUEST['action']=='styleimagegallery' && $_REQUEST['id']!=''){

/*if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'imageGallery',$where1);

$editresult=mysqli_fetch_array($rs1);

}*/

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Title</label>
                    <input name="name" type="text" class="form-control" id="name" value="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Attach Image</label>
                    <div class="uniform-uploader">
                        <input type="file" name="attachmentImage" id="attachmentImage" class="form-input-styled"
                            data-fouc="" multiple="multiple">
                        <span class="filename" style="user-select: none;">No file selected</span><span
                            class="action btn btn-secondary" style="user-select: none;"><i
                                class="fa fa-upload"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="" />
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
                    <input name="name" type="text" class="form-control validate" id="name" value="">
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
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

$count = mysqli_num_rows($rsimg);

while($imgresult=mysqli_fetch_array($rsimg)){

?>
    <div class="gallery-image">
        <div class="img-magnifier-container zoomImage"><img src="images/<?php echo $imgresult['attachmentImage']; ?>"
                alt="<?php echo $imgresult['name']; ?>" id="myimage"></div>
        <?php if($imgresult['name']!='') { ?>
        <div class="gallery-content"><?php echo $imgresult['name']; ?></div>
    </div>
    <?php  } }  ?>
</div>
<?php

}

?>
<?php

}  ?>
<?php if($_REQUEST['action']=='tasklistmaster'){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'taskListMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<style>
.select2-container {

    width: 100% !important;

}
</style>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>TNA Template</label>
                    <select class="select2 form-control" name="tnatemplate" id="tnatemplate">
                        <option value="">Select</option>
                        <?php

		$rs1=GetPageRecord('id,name','tnaTemplatesMaster','1 order by id asc');

		while($resListinga=mysqli_fetch_array($rs1)){

		?>
                        <option value="<?php echo strip($resListinga['id']); ?>"
                            <?php if($resListinga['id']==$editresult['tnatemplate']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListinga['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Activity Name</label>
                    <select class="select2 form-control" name="name" id="name">
                        <option value="">Select</option>
                        <?php

		$kkkquery=GetPageRecord('id,name','tnaActivityMaster','1 order by id asc');

		while($tnaactivityData=mysqli_fetch_array($kkkquery)){

		?>
                        <option value="<?php echo strip($tnaactivityData['id']); ?>"
                            <?php if($tnaactivityData['id']==$editresult['name']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($tnaactivityData['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6" style="display:none;">
                <div class="form-group">
                    <label>Display Name</label>
                    <input name="description" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['description']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>No. of Days</label>
                    <input name="totaldays" type="text" class="form-control validate" id="totaldays"
                        value="<?php echo $editresult['totaldays']; ?>" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Critical Path</label>
                    <select id="criticalPath" name="criticalPath" class="select2 form-control validate" displayname="">
                        <option value="">Select</option>
                        <?php

	$rs=GetPageRecord('*','tnaActivityMaster','1 order by id asc');

    while($resListing=mysqli_fetch_array($rs)){

	?>
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id']==$editresult['criticalPath']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListing['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>TNA</label>
                    <select name="tna" id="tna" class="form-control validate">
                        <option value="2" <?php if($editresult['tna']=='2') { ?>selected="selected" <?php } ?>>Sub TNA
                        </option>
                        <option value="1" <?php if($editresult['tna']=='1') { ?>selected="selected" <?php } ?>>TNA
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control validate">
                        <option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active
                        </option>
                        <option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>
                            Inactive</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="stylerefid" type="hidden" id="stylerefid" value="<?php echo $_REQUEST['stylerefid']; ?>" />
</form>
<?php } ?>
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
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Description</label>
                    <input name="description" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['description']; ?>">
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
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo clean($editresult['name']); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Buyer ID</label>
                    <input name="buyerId" type="text" class="form-control validate" id="buyerId"
                        value="<?php echo $editresult['buyerId']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Buyer Short Name</label>
                    <input name="shortname" type="text" class="form-control validate" id="shortname"
                        value="<?php echo clean($editresult['buyerShortName']); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Buyer Email</label>
                    <input name="bemail" type="text" class="form-control validate" id="bemail"
                        value="<?php echo clean($editresult['buyeremail']); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Buyer Phone</label>
                    <input name="bphone" type="text" class="form-control validate" id="bphone"
                        value="<?php echo clean($editresult['buyerphone']); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control validate">
                        <option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active
                        </option>
                        <option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>
                            Inactive</option>
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
<?php if($_REQUEST['action']=='suppliers'){

if($_GET['id']!=''){

$select1='*';

$where1='id="'.decode($_GET['id']).'"';

$rs1=GetPageRecord($select1,_SUPPLIERS_MASTER_,$where1);

$editresult=mysqli_fetch_array($rs1);

$editId=clean($editresult['id']);

$lastId=$editresult['id'];

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Supplier ID</label>
                    <input name="supplierid" type="text" class="form-control" id="supplierid"
                        value="<?php echo $editresult['supplierId']; ?>" maxlength="200">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Supplier Name</label>
                    <input name="suppliername" type="text" class="form-control" id="suppliername"
                        value="<?php echo $editresult['name']; ?>" maxlength="200">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email</label>
                    <input name="email" type="text" class="form-control" id="email"
                        value="<?php echo $editresult['email']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Phone</label>
                    <input name="phone" type="text" class="form-control" id="phone"
                        value="<?php echo $editresult['phone']; ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info">Save</button>
    </div>
    <input name="action" type="hidden" id="action" value="addsupplier" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php } ?>
<?php if($_REQUEST['action']=='vendors'){

if($_GET['id']!=''){

$select1='*';

$where1='id="'.decode($_GET['id']).'"';

$rs1=GetPageRecord($select1,_VENDOR_MASTER_,$where1);

$editresult=mysqli_fetch_array($rs1);

$editId=clean($editresult['id']);

$lastId=$editresult['id'];

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Vendor ID</label>
                    <input name="supplierid" type="text" class="form-control" id="supplierid"
                        value="<?php echo $editresult['supplierid']; ?>" maxlength="200">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Vendor Name</label>
                    <input name="suppliername" type="text" class="form-control" id="suppliername"
                        value="<?php echo $editresult['suppliername']; ?>" maxlength="200">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email</label>
                    <input name="email" type="text" class="form-control" id="email"
                        value="<?php echo $editresult['email']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Phone</label>
                    <input name="phone" type="text" class="form-control" id="phone"
                        value="<?php echo $editresult['phone']; ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info">Save</button>
    </div>
    <input name="action" type="hidden" id="action" value="addvendor" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php } ?>
<?php if($_REQUEST['action']=='addressmaster' && $_REQUEST['parentId']!=''){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'addressMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Office Type</label>
                    <input name="officeType" type="text" class="form-control validate" id="officeType"
                        value="<?php echo $editresult['officeType']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Country</label>
                    <select id="countryId" name="countryId" class="form-control" displayname="State" autocomplete="off"
                        onchange="selectstate();">
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
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id']==$editresult['countryId']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListing['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>State</label>
                    <select id="stateId" name="stateId" class="form-control" displayname="State" autocomplete="off"
                        onchange="selectcity();">
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>City</label>
                    <select id="cityId" name="cityId" class="form-control" displayname="State" autocomplete="off">
                    </select>
                </div>
            </div>
            <script>
            function selectstate() {

                var countryId = $('#countryId').val();

                $('#stateId').load('loadstate.php?id=' + countryId + '&selectId=<?php echo $editresult['stateId']; ?>');

            }

            function selectcity() {

                var stateId = $('#stateId').val();

                $('#cityId').load('loadcity.php?id=' + stateId + '&selectId=<?php echo $editresult['cityId']; ?>');

            }
            </script>
            <script>
            <?php

if($_GET['id']!=''){

?>

            selectstate();

            <?php } ?>
            </script>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Address</label>
                    <input name="address" type="text" class="form-control validate" id="address"
                        value="<?php echo $editresult['address']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Pin code</label>
                    <input name="pinCode" type="text" class="form-control validate" id="pinCode"
                        value="<?php echo $editresult['pinCode']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>GSTN</label>
                    <input name="gstn" type="text" class="form-control validate" id="gstn"
                        value="<?php echo $editresult['gstn']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Primary Address</label>
                    <select name="primaryAddress" id="primaryAddress" class="form-control validate">
                        <option value="1" <?php if($editresult['primaryAddress']=='1') { ?>selected="selected"
                            <?php } ?>>Yes</option>
                        <option value="2" <?php if($editresult['primaryAddress']=='2') { ?>selected="selected"
                            <?php } ?>>No</option>
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
    <input name="parentId" type="hidden" id="parentId" value="<?php echo $_REQUEST['parentId']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['module']; ?>" />
    <input type="hidden" name="type" id="type" value="<?php echo $_REQUEST['type']; ?>" />
</form>
<?php } ?>
<?php if($_REQUEST['action']=='contactdetailmaster' && $_REQUEST['buyerId']!=''){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'contactPersonMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name</label>
                    <input name="contactPerson" type="text" class="form-control validate" id="contactPerson"
                        value="<?php echo $editresult['contactPerson']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email</label>
                    <input name="email" type="text" class="form-control validate" id="email"
                        value="<?php echo $editresult['email']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Phone</label>
                    <input name="phone" type="text" class="form-control validate" id="phone"
                        value="<?php echo $editresult['phone']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Designation</label>
                    <input name="designation" type="text" class="form-control validate" id="designation"
                        value="<?php echo $editresult['designation']; ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info">Save</button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="buyerId" type="hidden" id="parentId" value="<?php echo $_REQUEST['buyerId']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['module']; ?>" />
    <input type="hidden" name="type" id="type" value="<?php echo $_REQUEST['type']; ?>" />
</form>
<?php } ?>
<?php if($_REQUEST['action']=='brandmaster'){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'brandMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo clean($editresult['name']); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Description</label>
                    <input name="description" type="text" class="form-control validate" id="description"
                        value="<?php echo clean($editresult['description']); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Buyer</label>
                    <select id="buyerId" name="buyerId" class="form-control">
                        <option value="">Select</option>
                        <?php
              $select='';
              $where='';
              $rs='';
              $select='*';
              $where=' deletestatus=0 and status=1 order by name asc';
              $rs=GetPageRecord($select,_BUYER_MASTER_,$where);
              while($resListing=mysqli_fetch_array($rs)){
              ?>
                        <option value="<?php echo $resListing['id']; ?>"
                            <?php if($resListing['id']==$editresult['buyerId']){ ?> selected="selected" <?php } ?>>
                            <?php echo strip($resListing['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-md-6" style="display:none;">
                <div class="form-group">
                    <label>PD Merchant</label>
                    <select id="pdmerchant" name="pdmerchant" class="form-control">
                        <option value="">Select</option>
                        <?php

$rs=GetPageRecord('*','userMaster','1 and profileId=85 || profileId=161 and status=1');

while($resListing=mysqli_fetch_array($rs)){

?>
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id']==$editresult['pdmerchant']){ ?> selected="selected" <?php } ?>>
                            <?php echo strip($resListing['firstName']).' '.strip($resListing['lastName']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6" style="display:none;">
                <div class="form-group">
                    <label>Production Merchant</label>
                    <select id="productionmerchant" name="productionmerchant" class="form-control">
                        <option value="">Select</option>
                        <?php

$rs1=GetPageRecord('*','userMaster','1 and profileId=160 || profileId=161');

while($resListing1=mysqli_fetch_array($rs1)){

?>
                        <option value="<?php echo strip($resListing1['id']); ?>"
                            <?php if($resListing1['id']==$editresult['productionmerchant']){ ?> selected="selected"
                            <?php } ?>>
                            <?php echo strip($resListing1['firstName']).' '.strip($resListing1['lastName']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Cost Per Minute(CPM)</label>
                    <input name="cpm" type="text" class="form-control" id="cpm"
                        value="<?php echo $editresult['cpm']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Commission/Discount(%)</label>
                    <input name="discount" type="number" class="form-control" id="discount"
                        value="<?php echo $editresult['discount']; ?>">
                </div>
            </div>
            <div class="col-md-6" <?php if($editresult['id']==''){  ?> style="display:none;" <?php } ?>>
                <div class="form-group">
                    <label>By Default</label>
                    <select class="form-control " name="default" id="default">
                        <option>Select</option>
                        <option value="1" <?php if($editresult['bydefault']=='1') { ?> selected="selected" readonly
                            <?php } ?>>Yes</option>
                        <option value="0" <?php if($editresult['bydefault']=='0') { ?> selected="selected" readonly
                            <?php } ?>>No</option>
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
<?php if($_REQUEST['action']=='bankdetailmaster' && $_REQUEST['masterId']!=''){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'bankDetailsMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Bank Name</label>
                    <input name="bankName" type="text" class="form-control validate" id="bankName"
                        value="<?php echo $editresult['bankName']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Account Type</label>
                    <select name="accountType" id="accountType" class="form-control validate">
                        <option value="">Select</option>
                        <option value="1" <?php if($editresult['accountType']==1){ ?> selected="selected" <?php } ?>>
                            Current</option>
                        <option value="2" <?php if($editresult['accountType']==2){ ?> selected="selected" <?php } ?>>
                            Corporate</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Account Number</label>
                    <input name="accountNumber" type="text" class="form-control validate" id="accountNumber"
                        value="<?php echo $editresult['accountNumber']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>IFSC Code</label>
                    <input name="IFSCCode" type="text" class="form-control validate" id="IFSCCode"
                        value="<?php echo $editresult['IFSCCode']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Beneficiary Name</label>
                    <input name="beneficiary" type="text" class="form-control validate" id="beneficiary"
                        value="<?php echo $editresult['beneficiary']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Overdraft Limit</label>
                    <input name="overdraftLimit" type="text" class="form-control validate" id="overdraftLimit"
                        value="<?php echo $editresult['overdraftLimit']; ?>">
                </div>
            </div>
            <div class="col-md-6" style="display:none;">
                <div class="form-group">
                    <label>Currency</label>
                    <select name="currencyId" class="form-control validate" id="currencyId">
                        <option value="">Select</option>
                        <?php

$rs=GetPageRecord('*','queryCurrencyMaster','1 order by name asc');

while($resListing=mysqli_fetch_array($rs)){ ?>
                        <option value="<?php echo $resListing['id']; ?>"
                            <?php if($editresult['currencyId']==$resListing['id']){ ?> selected="selected" <?php } ?>>
                            <?php echo $resListing['name']; ?></option>
                        <?php } ?>
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
    <input name="masterId" type="hidden" id="masterId" value="<?php echo $_REQUEST['masterId']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['module']; ?>" />
    <input type="hidden" name="type" id="type" value="<?php echo $_REQUEST['type']; ?>" />
</form>
<?php } ?>
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

            <div class="col-md-12">
                <div class="form-group">
                    <label>Color Code</label>
                    <input name="colorCode" type="color" class="form-control validate" id="colorCode"
                        value="<?php echo $editresult['colorCode']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Color Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Reference</label>
                    <input name="reference" type="text" class="form-control validate" id="reference"
                        value="<?php echo $editresult['reference']; ?>">
                </div>
            </div>
            <div class="col-md-6" style="display:none;">
                <div class="form-group">
                    <label>Buyer Color Code</label>
                    <input name="buyerColorCode" type="color" class="form-control " id="buyerColorCode"
                        value="<?php echo $editresult['buyerColorCode']; ?>">
                </div>
            </div>
            <div class="col-md-6" style="display:none;">
                <div class="form-group">
                    <label>Buyer Color Name</label>
                    <input name="buyerColorName" type="text" class="form-control " id="buyerColorName"
                        value="<?php echo $editresult['buyerColorName']; ?>">
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
    <input name="buyerId" type="hidden" id="buyerId" value="<?php echo $_REQUEST['buyerId']; ?>" />
    <input name="brandId" type="hidden" id="brandId" value="<?php echo $_REQUEST['brandId']; ?>" />
</form>
<?php } ?>
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
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Description</label>
                    <input name="description" type="text" class="form-control validate" id="description"
                        value="<?php echo $editresult['description']; ?>">
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
                    <input name="subject" type="text" class="form-control validate" id="subject"
                        value="<?php echo $editresult['subject']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Broadcast Date</label>
                    <input name="broadcastDate" type="text" class="form-control" id="broadcastDate"
                        value="<?php if($editresult['broadcastDate']!=''){ echo date('d-m-Y', strtotime($editresult['broadcastDate'])); }else{ echo date('d-m-Y'); } ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Department</label>
                    <select id="departmentId" name="departmentId[]" multiple="multiple" class="form-control validate"
                        displayname="">
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
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php foreach($newdata as $key => $value) { if($value == $resListing['id']){ echo 'selected="selected"'; } }?>>
                            <?php echo strip($resListing['name']); ?></option>
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
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id']==$editresult['assignTo']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListing['firstName']).' '.strip($resListing['lastName']); ?></option>
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
            $(function() {

                $("#broadcastDate").datepicker();

            });
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

            <div class="col-md-12">
                <div class="form-group">
                    <label>Season Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Start Date</label>
                    <input name="startDate" type="text" class="form-control" id="startDate"
                        value="<?php if($editresult['startDate']!=''){ echo date('d-m-Y', strtotime($editresult['startDate'])); }else{ echo date('d-m-Y'); } ?>">
                    <script>
                    $(function() {

                        $("#startDate").datepicker();

                    });
                    </script>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>End Date</label>
                    <input name="enddate" type="text" class="form-control" id="enddate"
                        value="<?php if($editresult['endDate']!=''){ echo date('d-m-Y', strtotime($editresult['endDate'])); }else{ echo date('d-m-Y'); } ?>">
                    <script>
                    $(function() {

                        $("#enddate").datepicker();

                    });
                    </script>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control validate" name="status" id="status">
                        <option value="1" <?php if($editresult['status']=='1') { ?> selected="selected" <?php } ?>>
                            Active</option>
                        <option value="2" <?php if($editresult['status']=='2') { ?> selected="selected" <?php } ?>>
                            Inactive</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6" <?php if($editresult['id']==''){  ?> style="display:none;" <?php } ?>>
                <div class="form-group">
                    <label>By Default</label>
                    <select class="form-control " name="default" id="default">
                        <option>Select</option>
                        <option value="1" <?php if($editresult['bydefault']=='1') { ?> selected="selected" readonly
                            <?php } ?>>Yes</option>
                        <option value="0" <?php if($editresult['bydefault']=='0') { ?> selected="selected" readonly
                            <?php } ?>>No</option>
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
    <input name="buyerId" type="hidden" id="buyerId" value="<?php echo $_REQUEST['buyerId']; ?>" />
    <input name="brandId" type="hidden" id="brandId" value="<?php echo $_REQUEST['brandId']; ?>" />
</form>
<?php } ?>
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
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id']==$editresult['categoryId']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListing['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Sub Category</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Gender</label>
                    <select name="gender" id="gender" class="form-control">
                        <option value="">Select Gender</option>
                        <option value="1" <?php if($editresult['gender']==1){ ?> selected="selected" <?php } ?>>Man
                        </option>
                        <option value="2" <?php if($editresult['gender']==2){ ?> selected="selected" <?php } ?>>Woman
                        </option>
                        <option value="3" <?php if($editresult['gender']==3){ ?> selected="selected" <?php } ?>>Kids
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Material</label>
                    <select id="multiselect" multiple="multiple" name="material[]">
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
                        <option value="<?php echo $rest['id']; ?>"
                            <?php foreach ($array as $item) { if($rest['id']==$item){ ?>selected <?php } }?>>
                            <?php echo $rest['name']; ?></option>
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
                    <input name="description" type="text" class="form-control validate" id="description"
                        value="<?php echo $editresult['description']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control validate">
                        <option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active
                        </option>
                        <option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>
                            Inactive</option>
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
<?php if($_REQUEST['action']=='materialmaster'){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'materialMaster',$where1);

$editresult=mysqli_fetch_array($rs1);



$k=GetPageRecord('*','materialDescriptionMaster','1 and materialTypeId="'.$editresult['materialtype'].'" and materialid="'.$editresult['id'].'"');

$editresultdescription=mysqli_fetch_array($k);



}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Material Type</label>
                    <select id="categoryId" name="categoryId" class="form-control validate" required>
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
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id']==$editresult['materialtype']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListing['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Material Sub Type</label>
                    <select id="materialSubTypeId" name="materialSubTypeId" class="form-control validate">
                        <option value="">Select</option>
                        <?php

	$select='';

	$where='';

	$rs='';

	$select='*';

	$where=' deletestatus=0 and status=1 order by name asc';

	$rs=GetPageRecord($select,'materialSubType',$where);

	while($resListing=mysqli_fetch_array($rs)){

	?>
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id']==$editresult['materialSubTypeId']){ ?>selected="selected"
                            <?php } ?>><?php echo strip($resListing['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Material Status</label>
                    <select name="materialStatus" id="materialStatus" class="form-control validate">
                        <option value="None" <?php if($editresult['materialStatus']=='None') { ?>selected="selected"
                            <?php } ?>>None</option>
                        <option value="Local" <?php if($editresult['materialStatus']=='Local') { ?>selected="selected"
                            <?php } ?>>Local</option>
                        <option value="Imported"
                            <?php if($editresult['materialStatus']=='Imported') { ?>selected="selected" <?php } ?>>
                            Imported</option>
                        <option value="Defected"
                            <?php if($editresult['materialStatus']=='Defected') { ?>selected="selected" <?php } ?>>
                            Defected</option>
                        <option value="Sample" <?php if($editresult['materialStatus']=='Sample') { ?>selected="selected"
                            <?php } ?>>Sample</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Finish</label>
                    <select id="finishId" name="finishId" class="form-control validate">
                        <option value="">Select</option>
                        <?php

	$select='';

	$where='';

	$rs='';

	$select='*';

	$where=' deletestatus=0 and status=1 order by name asc';

	$rs=GetPageRecord($select,'finishMaster',$where);

	while($resListing=mysqli_fetch_array($rs)){

	?>
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id']==$editresult['finishId']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListing['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Material Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo htmlspecialchars(stripslashes($editresult['name'])); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Material Image</label>
                    <input name="materialimage" type="file" id="materialimage" class="form-control validate">
                </div>
            </div>
            <input type="hidden" name="materialimageedit" id="materialimageedit"
                value="<?php echo $editresult['materialimage']; ?>" />
            <div class="col-md-3">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control validate">
                        <option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active
                        </option>
                        <option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>
                            Inactive</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>GSM</label>
                    <input name="gsm" type="text" class="form-control validate" id="gsm"
                        value="<?php echo stripslashes($editresult['gsm']); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Material Short Description (SAP)</label>
                    <input name="shortDescription" type="text" class="form-control " id="shortDescription"
                        value="<?php echo htmlspecialchars(stripslashes($editresultdescription['shortDescription'])); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Material Code (SAP)</label>
                    <input name="sapCode" type="text" class="form-control " id="sapCode"
                        value="<?php echo htmlspecialchars(stripslashes($editresultdescription['sapCode'])); ?>" autocomplete="off">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="longDescription" id="longDescription"
                        class="form-control"><?php echo htmlspecialchars(stripslashes($editresultdescription['longDescription'])); ?></textarea>
                </div>
            </div>
            <div class="col-md-6" style="display:none;">
                <div class="form-group">
                    <label>Description</label>
                    <input name="description" type="text" class="form-control validate" id="description"
                        value="<?php echo htmlspecialchars(stripslashes($editresultdescription['description'])); ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>HSN Code</label>
                    <select id="hsnCodeId" name="hsnCodeId" class="form-control validate">
                        <option value="">Select</option>
                        <?php

                        $select='';

                        $where='';

                        $rs='';

                        $select='*';

                        $where=' 1 and status=1 order by id desc';

                        $rs=GetPageRecord($select,'hsncodeMaster',$where);

                        while($resListing=mysqli_fetch_array($rs)){

                        ?>
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id']==$editresult['hsnCodeId']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListing['hardescription']); ?>
                            [<?php echo strip($resListing['harcode']); ?>]</option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <?php
            $newdata = explode(',', $editresult['widthId']);
            ?>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Width</label>
                    <select id="widthId" name="widthId[]" class="form-control validate select2" multiple>
                        <option value="" disabled>Select</option>
                        <?php

                        $select='';

                        $where='';

                        $rs='';

                        $select='*';

                        $where=' 1 and status=1 order by id desc';

                        $rs=GetPageRecord($select,'widthMaster',$where);

                        while($resListing=mysqli_fetch_array($rs)){

                        ?>
                        <option value="<?php echo strip($resListing['id']); ?>" <?php foreach($newdata as $widthval){ if($widthval==$resListing['id']) { ?>selected="selected" <?php } } ?>>
                            <?php echo strip($resListing['name']); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info">Save</button>
    </div>
    <input name="materialUniqueId" type="hidden" id="materialUniqueId"
        value="<?php echo $editresult['materialUniqueId']; ?>" />
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="isforceaction" type="hidden" id="isforceaction" value="<?php echo $_REQUEST['isforceaction']; ?>" />
</form>
<?php } ?>
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
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Description</label>
                    <input name="description" type="text" class="form-control validate" id="description"
                        value="<?php echo $editresult['description']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control validate">
                        <option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active
                        </option>
                        <option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>
                            Inactive</option>
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
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id']==$editresult['materialTypeId']){ ?>selected="selected"
                            <?php } ?>><?php echo strip($resListing['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Material Short Description (SAP)</label>
                    <input name="shortDescription" type="text" class="form-control " id="shortDescription"
                        value="<?php echo $editresult['shortDescription']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Material Code (SAP)</label>
                    <input name="sapCode" type="text" class="form-control " id="sapCode"
                        value="<?php echo $editresult['sapCode']; ?>" autocomplete="off">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="longDescription" id="longDescription"
                        class="form-control "><?php echo $editresult['longDescription']; ?></textarea>
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
                    <input name="empCode" type="text" class="form-control validate" id="empCode"
                        value="<?php echo $editresult['empCode']; ?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Employee Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Employee Category</label>
                    <select id="empType" name="empType" class="form-control" autocomplete="off"
                        displayname="Employee Type" onchange="selectworkplace(this.value);">
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
                        <option value="<?php echo strip($resListingl['id']); ?>"
                            <?php if($resListingl['id']==$editresult['empType']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip(		      $resListingl['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Designation</label>
                    <select id="designationId" name="designationId" class="form-control" autocomplete="off"
                        displayname="">
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
                        <option value="<?php echo strip($resListingl['id']); ?>"
                            <?php if($resListingl['id']==$editresult['designationId']){ ?>selected="selected"
                            <?php } ?>><?php echo strip(		      $resListingl['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Department</label>
                    <select id="departmentId" name="departmentId" class="form-control" autocomplete="off"
                        displayname="">
                        <option value="">Select</option>
                        <?php

	  	$k=GetPageRecord('*','departmentMaster','1 and status=1 and deletestatus=0 order by name asc');

		while($departmentData=mysqli_fetch_array($k)){

	   ?>
                        <option value="<?php echo strip($departmentData['id']); ?>"
                            <?php if($departmentData['id']==$editresult['departmentId']){ ?>selected="selected"
                            <?php } ?>><?php echo strip(		      $departmentData['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Category</label>
                    <select id="categoryId" name="categoryId[]" class="form-control" autocomplete="off"
                        multiple="multiple">
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
                        <option value="<?php echo strip($resListingl['id']); ?>"
                            <?php foreach($newdata as $key => $value) { if($value == $resListingl['id']){ echo 'selected="selected"'; } }?>>
                            <?php echo strip($resListingl['name']); ?></option>
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
                    <input name="email" type="text" class="form-control validate" id="email"
                        value="<?php echo $editresult['email']; ?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Phone</label>
                    <input name="phone" type="number" class="form-control validate" id="phone"
                        value="<?php echo $editresult['phone']; ?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Address</label>
                    <input name="address" type="text" class="form-control" id="address" displayname="Address"
                        value="<?php echo $editresult['address']; ?>" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Country</label>
                    <select id="countryId" name="countryId" class="form-control" displayname="State" autocomplete="off"
                        onchange="selectstate();">
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
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id']==$editresult['countryId']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListing['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>State</label>
                    <select id="stateId" name="stateId" class="form-control" displayname="State" autocomplete="off"
                        onchange="selectcity();">
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
            function selectstate() {

                var countryId = $('#countryId').val();

                $('#stateId').load('loadstate.php?id=' + countryId + '&selectId=<?php echo $editresult['stateId']; ?>');

            }

            function selectcity() {

                var stateId = $('#stateId').val();

                $('#cityId').load('loadcity.php?id=' + stateId + '&selectId=<?php echo $editresult['cityId']; ?>');

            }
            </script>
            <script>
            <?php

if($_GET['id']!=''){

?>

            selectstate();

            <?php } ?>
            </script>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Pin</label>
                    <input name="pinCode" type="text" class="form-control" id="pinCode" displayname="pinCode"
                        value="<?php echo $editresult['pinCode']; ?>" />
                </div>
            </div>
            <script>
            function selectworkplace(empType) {

                $('#workLocation').load('loadworklocation.php?empType=' + empType +
                    '&selectId=<?php echo $editresult['workLocation']; ?>');

            }

            <?php if($_GET['id']!=''){ ?>

            var empType = $('#empType').val();

            selectworkplace(empType);

            <?php } ?>
            </script>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Work Location</label>
                    <select name="workLocation" id="workLocation" class="form-control validate">
                        <option value="">Select</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
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
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id']==$editresult['reportingTo']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListing['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control validate">
                        <option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active
                        </option>
                        <option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>
                            Inactive</option>
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
<?php if($_REQUEST['action']=='profile'){



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
                    <input name="profileName" type="text" class="form-control validate" id="profileName"
                        value="<?php echo $editresult['profileName']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Profile Description</label>
                    <input name="profileDetails" type="text" class="form-control validate" id="profileDetails"
                        value="<?php echo $editresult['profileDetails']; ?>">
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
                        <option value="<?php echo encode($timeformat['id']); ?>"
                            <?php if($timeformat['id']==$editTimeformat){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($timeformat['profileName']); ?></option>
                        <?php } } ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php } ?>
<?php if($_REQUEST['action']=='role'){

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
                    <input name="name" type="text" class="form-control validate" id="name" value="<?php echo $name; ?>">
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
                    <input name="roleDetails" type="text" class="form-control validate" id="roleDetails"
                        value="<?php echo $editresult['roleDetails']; ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
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
                    <input name="subject" type="text" class="form-control validate" id="subject"
                        value="<?php echo $editresult['name']; ?>" autocomplete="off">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Style Id</label>
                    <select name="styleId" id="styleId" class="form-control" autocomplete="off">
                        <option value="">Select</option>
                        <?php

$select='*';

$where='1 and subject!="" order by displayId asc';

$rs=GetPageRecord($select,_QUERY_MASTER_,$where);

while($editresult=mysqli_fetch_array($rs)){

?>
                        <option value="<?php echo $editresult['id']; ?>">
                            <?php echo makeQueryId($editresult['displayId']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Priority</label>
                    <select name="priority" id="priority" class="form-control" autocomplete="off">
                        <option value="1">Normal</option>
                        <option value="2">High</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control" autocomplete="off">
                        <option value="1">Open</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Assign To</label>
                    <select name="assignTo" id="assignTo" class="form-control" autocomplete="off">
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
<?php if($_REQUEST['action']=='techpackcategorymaster'){

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
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>" autocomplete="off">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control" autocomplete="off">
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
<?php if($_REQUEST['action']=='techpacksubcategorymaster'){

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
                    <select name="techpackcategoryid" id="techpackcategoryid" class="form-control" autocomplete="off">
                        <option value="">Select</option>
                        <?php

$select111='*';

$where111='status=1 and deleteStatus=0';

$rs111=GetPageRecord($select111,_TECHPACK_CATEGORY_MASTER_,$where111);

while($categoryresult=mysqli_fetch_array($rs111)){

 ?>
                        <option value="<?php echo $categoryresult['id'] ;?>"
                            <?php if($categoryresult['id']==$editresult['techpackcategoryid']) { ?> selected <?php } ?>>
                            <?php echo $categoryresult['name'] ;?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>" autocomplete="off">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control" autocomplete="off">
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
<?php if($_REQUEST['action']=='measurementchartmaster'){

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
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>" autocomplete="off">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control" autocomplete="off">
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
                        <option value="1" <?php if($_REQUEST['buyerStatus']=='1') { ?> selected <?php } ?>>Approve
                        </option>
                        <option value="2" <?php if($_REQUEST['buyerStatus']=='2') { ?> selected <?php } ?>>Cancel
                        </option>
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



if($_REQUEST['action']=='assignStyle'){

$styleId = decode($_REQUEST['styleId']);
$buyerId = clean($_REQUEST['buyerId']);
$brandId = clean($_REQUEST['brandId']);

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Role</label>
                    <select id="profileId" name="profileId" class="form-control" onchange="funcGetUser(this.value);" required>
                        <option value="">Select</option>
                        <?php
			$select='';
			$where='';
			$rs='';
			$select='*';
			$where=' buyerId="'.$buyerId.'" and brandId="'.$brandId.'" order by id asc';
			$rs=GetPageRecord($select,'resourceAllocationBrandWise',$where);
			while($resListing=mysqli_fetch_array($rs)){
			?>
                        <option value="<?php echo strip($resListing['profileId']); ?>"
                            data-id="<?php echo strip($resListing['id']); ?>">
                            <?php echo getProfileName($resListing['profileId']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>Assign To</label>
                    <select id="assignTo" name="assignTo" class="form-control" displayname="Assign To" required>

                    </select>
                </div>
            </div>

            <script>
            function funcGetUser(profileId) {
                var id = $('#profileId').find('option:selected').attr('data-id');
                $('#assignTo').load('loadAssignResourceUser.php?action=loadAssignedResourceUser&profileId=' +
                    profileId + '&id=' + id);
            }
            </script>

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
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="assignStyle" />
    <input name="styleId" type="hidden" id="styleId" value="<?php echo $_REQUEST['styleId']; ?>" />
</form>
<?php }

 ?>
<?php  if($_REQUEST['action']=='addnotes'){

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
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="addnotes" />
    <input name="styleId" type="hidden" id="styleId" value="<?php echo $_REQUEST['styleId']; ?>" />
</form>
<?php }

 ?>
<?php if($_REQUEST['action']=='assigntopurchase'){

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Assign To</label>
                    <select id="assignto" multiple="multiple" name="assignto[]">
                        <?php

$select='';

$where='';

$rs='';

$select='*';

$where='profileId=154';

$rs=GetPageRecord($select,'userMaster',$where);

while($rest=mysqli_fetch_array($rs)){

?>
                        <option value="<?php echo $rest['id']; ?>">
                            <?php echo $rest['firstName']." ".$rest['lastName'] ;?></option>
                        <?php } ?>
                    </select>
                    <input name="assignToMaterial[]" id="assignToMaterial" type="hidden" value="0" />
                    <input name="costsheetversionid" id="costsheetversionid" type="hidden"
                        value="<?php echo $_REQUEST['costsheetVersionId']?>" />
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

            var assignToMaterial = '';

            var abc = parent.$('#materialcosttype').val();



            $('input:checkbox.Checkedinc' + abc + '<?php echo $_REQUEST['costsheetVersionId']; ?>').each(function() {

                var sThisVal = (this.checked ? $(this).val() : "");



                if (sThisVal != '') {

                    assignToMaterial = assignToMaterial + sThisVal + ',';

                }

            });

            $('#assignToMaterial').val(assignToMaterial);
            </script>
            <div class="col-md-12" style="display:none;">
                <div class="form-group">
                    <label>Notes</label>
                    <input name="description" type="text" class="form-control validate" id="description" value="">
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
<?php if($_REQUEST['action']=='assigntopurchasemerchant'){

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Assign To</label>
                    <select id="assigntopurchasemerchant" multiple="multiple" name="assigntopurchasemerchant[]">
                        <?php

$select='';

$where='';

$rs='';

$select='*';

$where='profileId=155';

$rs=GetPageRecord($select,'userMaster',$where);

while($rest=mysqli_fetch_array($rs)){

?>
                        <option value="<?php echo $rest['id']; ?>">
                            <?php echo $rest['firstName']." ".$rest['lastName'] ;?></option>
                        <?php } ?>
                    </select>
                    <input name="assignToMaterial[]" id="assignToMaterial" type="hidden" value="0" />
                    <input name="costsheetversionid" id="costsheetversionid" type="hidden"
                        value="<?php echo $_REQUEST['costsheetVersionId']?>" />
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

            var assignToMaterial = '';

            var abc = parent.$('#materialcosttypepurchasemerchant').val();



            $('input:checkbox.purchaseMerchantCheckedinc' + abc + '<?php echo $_REQUEST['costsheetVersionId']; ?>')
                .each(function() {

                    var sThisVal = (this.checked ? $(this).val() : "");



                    if (sThisVal != '') {

                        assignToMaterial = assignToMaterial + sThisVal + ',';

                    }

                });

            $('#assignToMaterial').val(assignToMaterial);
            </script>
            <div class="col-md-12" style="display:none;">
                <div class="form-group">
                    <label>Notes</label>
                    <input name="description" type="text" class="form-control validate" id="description" value="">
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
<?php if($_REQUEST['action']=='estimatecostsheet'){

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Notes</label>
                    <input name="description" type="text" class="form-control validate" id="description" value="">
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
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id']==$editresult['materialtype']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListing['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Unit Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Description</label>
                    <input name="description" type="text" class="form-control validate" id="description"
                        value="<?php echo $editresult['description']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control validate">
                        <option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active
                        </option>
                        <option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>
                            Inactive</option>
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
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Description</label>
                    <input name="description" type="text" class="form-control validate" id="description"
                        value="<?php echo $editresult['description']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control validate">
                        <option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active
                        </option>
                        <option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>
                            Inactive</option>
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
            <div class="col-md-6" style="display:none;">
                <div class="form-group">
                    <label>Category</label>
                    <select id="category" name="category" class="form-control validate">
                        <option value="">Select</option>
                        <?php

	$selectk='*';

	$wherek=' deletestatus=0 and status=1 order by name asc';

	$rsk=GetPageRecord($selectk,'categoryMaster',$wherek);

	while($resListingk=mysqli_fetch_array($rsk)){

	?>
                        <option value="<?php echo strip($resListingk['id']); ?>"
                            <?php if($resListingk['id']==$editresult['category']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListingk['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
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
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id']==$editresult['chargestype']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListing['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Default Value</label>
                    <input name="defaultcharesvalue" type="text" class="form-control validate" id="defaultcharesvalue"
                        value="<?php echo $editresult['defaultcharesvalue']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Description</label>
                    <input name="description" type="text" class="form-control validate" id="description"
                        value="<?php echo $editresult['description']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control validate">
                        <option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active
                        </option>
                        <option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>
                            Inactive</option>
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

$countrow = mysqli_num_rows($rs);



if($countrow!='0') { ?>
<style>
.myclassforalign {

    max-height: 92px !important;

}
</style>
<div class="myclassforalign"
    style="margin-bottom: 0px; max-height: 215px; overflow-y: scroll; border: 2px solid #F7F7F7; padding-bottom: 20px;">
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
            .myClass {

                background-color: #baffbc;

            }
            </style>
            <li class="media <?php if($_REQUEST['n']==$resListing['id']) { ?> myClass <?php } ?>"
                style="padding: 10px;border-bottom: 1px solid #f1f1f1;margin-top:0px;">
                <div class="mr-3"> <a href="#"
                        class="btn bg-transparent border-indigo-400 text-indigo-400 rounded-round border-2 btn-icon"> <i
                            class="icon-comment"></i> </a> </div>
                <div class="media-body">
                    <div class="d-flex justify-content-between">
                        <div class="media-title"><a href="#">
                                <?php  echo getUserName($resListing['addedBy']); ?>
                            </a></div>
                        <span class="font-size-sm text-muted"><i class="fa fa-clock-o" aria-hidden="true"></i>
                            <?php echo date('d M, Y - h:i A',$resListing['dateAdded'])?></span>
                    </div>
                    <?php if($materiallistdetail['approvedStatus']=='1') { ?>
                    Approved By <strong><?php echo getUserName($materiallistdetail['addedBy']); ?></strong>
                    <?php } ?>
                    <?php if($materiallistdetail['approvedStatus']=='2') { ?>
                    Further Assigned By <strong><?php echo getUserName($materiallistdetail['addedBy']); ?></strong> To
                    <strong><?php echo getUserName($materiallistdetail['assigedTo']); ?></strong>
                    <?php } ?>
                    <?php if($materiallistdetail['approvedStatus']=='3') { ?>
                    Request For Approvel To
                    <strong><?php echo getUserName($materiallistdetail['assigedTo']); ?></strong> By
                    <strong><?php echo getUserName($materiallistdetail['addedBy']); ?></strong>
                    <?php } ?>
                    <?php if($materiallistdetail['approvedStatus']=='4') { ?>
                    Rejected By <strong><?php echo getUserName($materiallistdetail['addedBy']); ?></strong>
                    <?php } ?>
                    <?php if($materiallistdetail['approvedStatus']=='5') { ?>
                    Request Cancelled By <strong><?php echo getUserName($materiallistdetail['addedBy']); ?></strong>
                    <?php } ?>
                    <?php if($materiallistdetail['approvedStatus']=='1' || $materiallistdetail['approvedStatus']=='2' || $materiallistdetail['approvedStatus']=='3' || $materiallistdetail['approvedStatus']=='4') { ?>
                    <br>
                    Note -
                    <?php }?>
                    <?php echo $resListing['comment']; ?>
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
                        <option value="1" <?php if($materiallistdetail['approvedStatus']=='1') { ?> selected <?php } ?>>
                            Approve</option>
                        <?php } ?>
                        <?php if($_REQUEST['fortTimeSlot']=='11') { ?>
                        <option value="2" <?php if($materiallistdetail['approvedStatus']=='2') { ?> selected <?php } ?>>
                            Further Assign</option>
                        <?php } ?>
                        <?php if($_REQUEST['fortTimeSlot']!='11') { ?>
                        <option value="3" <?php if($materiallistdetail['approvedStatus']=='3') { ?> selected <?php } ?>>
                            Request for Approvel</option>
                        <?php } ?>
                        <?php if($_REQUEST['fortTimeSlot']=='11') { ?>
                        <option value="4" <?php if($materiallistdetail['approvedStatus']=='4') { ?> selected <?php } ?>>
                            Reject</option>
                        <?php } ?>
                        <?php if($_REQUEST['fortTimeSlot']!='11') { ?>
                        <option value="5">Cancel Request</option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <?php if($materiallistdetail['approvedStatus']!='2' || $materiallistdetail['approvedStatus']!='3'){ ?>
            <style>
            #assigntoclass {

                display: none;

            }
            </style>
            <?php } ?>
            <script>
            showassignuser();

            function showassignuser() {

                var changestatus = $('#productstatus').val();

                if (changestatus == '2' || changestatus == '3') {

                    document.getElementById("assigntoclass").style.display = "block";

                    <?php if($materiallistdetail['approvedStatus']=='3') { ?>

                    //showtimeslot();

                    <?php } ?>

                } else {

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
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id']==$materiallistdetail['assigedTo']){ ?>selected="selected"
                            <?php } ?>><?php echo strip($resListing['firstName']).' '.strip($resListing['lastName']); ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <?php if($materiallistdetail['approvedStatus']!='2' || $materiallistdetail['approvedStatus']!='3'){ ?>
            <style>
            #timeslotclasss {

                display: none;

            }
            </style>
            <?php } ?>
            <script>
            function showtimeslot() {

                var changestatus = $('#productstatus').val();

                var assignTo = $('#assignTo').val();

                if (assignTo != '' && changestatus == '3') {

                    document.getElementById("timeslotclasss").style.display = "block";

                    $('#timeslotclasss').load("loadtimeslot.php?assignTo=" + assignTo +
                        "&scheduleId=<?php echo $materiallistdetail['scheduleId']; ?>&styleId=<?php echo $styleId; ?>"
                    );

                } else {

                    document.getElementById("timeslotclasss").style.display = "none";

                }

            }
            </script>
            <div class="col-md-12" id="timeslotclasss"> </div>
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
    var actionAllQuality = parent.$('#actionAllQuality').val();

    $('#QualityCheckUncheck').val(actionAllQuality);
    </script>
    <input type="hidden" name="QualityCheckUncheck" id="QualityCheckUncheck" value="" />
    <?php } ?>
    <?php if($_REQUEST['priceSend']=='1'){ ?>
    <script>
    var actionAllprice = parent.$('#actionAllprice').val();

    $('#PriceCheckUncheck').val(actionAllprice);
    </script>
    <input type="hidden" name="PriceCheckUncheck" id="PriceCheckUncheck" value="" />
    <?php } ?>
    <?php if($_REQUEST['vendorSend']=='1'){ ?>
    <script>
    var actionAllvendor = parent.$('#actionAllvendor').val();

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

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>From Time</label>
                    <select id="fromTime" name="fromTime" class="form-control" autocomplete="off">
                        <?php

	$start=strtotime('10:00');

	$end=strtotime('20:00');

	for ($i=$start;$i<=$end;$i = $i + 60*60)

	{ ?>
                        <option value="<?php echo date('g:i A',$i); ?>"
                            <?php if('10:00 AM'==date('g:i A',$i) && $_REQUEST['id']==''){ if($editresult['fromTime']==date('g:i A',$i)){ ?>
                            selected="selected" <?php } } ?>><?php echo date('g:i A',$i); ?></option>
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
                        <option value="<?php echo date('g:i A',$i); ?>"
                            <?php if('10:00 AM'==date('g:i A',$i) && $_REQUEST['id']==''){ if($editresult['toTime']==date('g:i A',$i)){ ?>
                            selected="selected" <?php } } ?>><?php echo date('g:i A',$i); ?></option>
                        <?php  }  ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Limit</label>
                    <input name="approveLimit" type="text" class="form-control validate" id="approveLimit"
                        value="<?php echo $editresult['approveLimit']; ?>">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Notes</label>
                    <textarea name="description"
                        class="form-control"><?php echo $editresult['description']; ?></textarea>
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
<?php } ?>
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
                        <option value="<?php echo $resListing['id']; ?>">
                            <?php echo '#'.$resListing['styleRefId'].'-'.$resListing['subject']; ?></option>
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
    <input name="purchaseorderid" type="hidden" id="purchaseorderid"
        value="<?php echo $_REQUEST['purchaseorderid']; ?>" />
</form>
<?php } ?>
<?php if($_REQUEST['action']=='cdn'){

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
            <div class="col-md-6" style="display:none;">
                <div class="form-group">
                    <label>Category</label>
                    <select id="category" name="category" class="form-control validate">
                        <option value="">Select</option>
                        <?php

	$selectk='*';

	$wherek=' deletestatus=0 and status=1 order by name asc';

	$rsk=GetPageRecord($selectk,'categoryMaster',$wherek);

	while($resListingk=mysqli_fetch_array($rsk)){

	?>
                        <option value="<?php echo strip($resListingk['id']); ?>"
                            <?php if($resListingk['id']==$editresult['category']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListingk['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Brand</label>
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
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id']==$editresult['chargestype']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListing['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>CDN No.</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>CDN Date</label>
                    <input name="defaultcharesvalue" type="text" class="form-control validate" id="defaultcharesvalue"
                        value="<?php echo $editresult['defaultcharesvalue']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Factory Location</label>
                    <input name="description" type="text" class="form-control validate" id="description"
                        value="<?php echo $editresult['description']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Buyer</label>
                    <input name="description" type="text" class="form-control validate" id="description"
                        value="<?php echo $editresult['description']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control validate">
                        <option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active
                        </option>
                        <option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>
                            Inactive</option>
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

?>
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
                    <input name="name" type="text" class="form-control" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Value</label>
                    <input name="currencyvalue" type="text" class="form-control" id="currencyvalue"
                        value="<?php echo $editresult['value']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Description</label>
                    <input name="description" type="text" class="form-control" id="description"
                        value="<?php echo $editresult['description']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active
                        </option>
                        <option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>
                            Inactive</option>
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
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control validate">
                        <option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active
                        </option>
                        <option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>
                            Inactive</option>
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
                        <input type="file" name="uploadedCostsheet" id="uploadedCostsheet" class="form-input-styled"
                            data-fouc="">
                        <span class="filename" style="user-select: none;">No file selected</span> <span
                            class="action btn btn-secondary" style="user-select: none;"><i
                                class="fa fa-upload"></i></span>
                        <script>
                        $('#uploadedCostsheet').on('change', function() {

                            //get the file name

                            var fileName = $(this).val();

                            //replace the "Choose a file" label

                            $(this).next('.filename').html(fileName);

                        })
                        </script>
                        <input type="hidden" name="finaluploadedCostsheet" id="finaluploadedCostsheet"
                            value="<?php echo $uploadedCostsheet; ?>" />
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
                    <select name="statusId" id="statusId" class="form-control validate"
                        onchange="assignto(this.value);">
                        <option value="">Select</option>
                        <option value="20">Inhouse</option>
                        <option value="19">Outsource</option>
                    </select>
                </div>
            </div>
            <script>
            function assignto(id) {

                if (id == 20) {

                    $('#showpurchaseteamdiv').show();

                    $('#showvendordiv').hide();

                }

                if (id == 19) {

                    $('#showpurchaseteamdiv').hide();

                    $('#showvendordiv').show();

                }

            }
            </script>
            <div class="col-md-12" id="showvendordiv" style="display:none;">
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
            <div class="col-md-12" id="showpurchaseteamdiv" style="display:none;">
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
                    <input name="notes" type="text" class="form-control" id="notes"
                        value="<?php echo $editresult['notes']; ?>">
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
                    <input name="notes" type="text" class="form-control" id="notes"
                        value="<?php echo $editresult['notes']; ?>">
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
                    <input name="remark" type="text" class="form-control" id="remark" value="">
                </div>
            </div>
            <div class="col-xl-12">
                <div class="mb-0 rounded-bottom-0" style="max-height:380px; overflow-y:auto;">
                    <div class="panel panel-flat">
                        <div class="table-responsive">
                            <table width="100%" class="table table-bordered table-responsive" id="tableid11">
                                <tbody style="width: 100%;display: inline-table;">
                                    <tr class="card-body">
                                        <td width="5%" align="left"><input
                                                name="inhouseMaterial<?php echo $_REQUEST['costsheetVersionId']; ?>"
                                                type="checkbox" class="inhouseMaterialClass"
                                                id="inhouseMaterial<?php echo $_REQUEST['costsheetVersionId']; ?>"
                                                style="height: 17px; width: 30px; margin-top: 4px; text-align: center;"
                                                onclick="getMaterialIdforSelect<?php echo $_REQUEST['costsheetVersionId']; ?>();" />
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

$srtype = mysqli_num_rows($rs22);

while($resListing1=mysqli_fetch_array($rs22)){

$select3='*';

$where3='costsheetVersionId="'.$_REQUEST['costsheetVersionId'].'" and styleId="'.decode($_REQUEST['styleId']).'" and materialId="'.$resListing1['id'].'"';

$rstype3=GetPageRecord($select3,'materialSendToSupplier',$where3);

$resListingtype3=mysqli_fetch_array($rstype3);

?>
                                    <tr class="card-body">
                                        <td align="left"><input type="checkbox"
                                                value="<?php echo $resListing1['id']; ?>" name="inhouseMaterialCheck[]"
                                                class="Checkedinhouse<?php echo $_REQUEST['costsheetVersionId']; ?>"
                                                style="height: 17px; width: 30px; margin-top: 4px; text-align: center;"
                                                onclick="getMaterialId<?php echo $_REQUEST['costsheetVersionId']; ?>();" />
                                        </td>
                                        <td align="left"><?php echo $resListing1['name']; ?></td>
                                        <td align="left"><?php echo $resListing1['newmaterialdescription']; ?></td>
                                        <td align="center"><?php

					$select123='*';

					$where123='styleId="'.decode($_REQUEST['styleId']).'" and costVersionId="'.$_REQUEST['costsheetVersionId'].'" and commnetType=0 and materialId="'.$resListing1['id'].'" order by id asc limit 1';

					$rs123=GetPageRecord($select123,'materialCostChatMaster',$where123);

					$chatcount1=mysqli_fetch_array($rs123);

					?>
                                            <input name="inhouseRemark<?php echo $resListing1['id']; ?>" type="text"
                                                id="inhouseRemark<?php echo $resListing1['id']; ?>" autocomplete="off"
                                                style="width: 100%;"
                                                value="<?php if($resListingtype3['inhouseRemark']!=''){ echo $resListingtype3['inhouseRemark']; }else{ echo $chatcount1['comment']; } ?>" />
                                        </td>
                                        <td align="left"><?php

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
                                            <span class="badge bg-success"
                                                style="margin-bottom: 5px; padding: 6px 5px; font-size: 10px;"><?php echo $resListingtype['name']; ?></span>
                                            <?php } } ?>
                                        </td>
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
    <input name="costsheetVersionId" type="hidden" id="costsheetVersionId"
        value="<?php echo $_REQUEST['costsheetVersionId']; ?>" />
    <!--<div style="width: 50%; float: left; padding-left: 15px;"><a href="<?php echo $fullurl; ?>submit-supplier.php?st=<?php echo $_REQUEST['styleId']; ?>&cv=<?php echo encode($_REQUEST['costsheetVersionId']); ?>&s=<?php echo encode($assignSupplierId); ?>&p=1" target="_blank" class="btn bg-info" style="background-color: #009933 !important;">Preview</a></div>-->
    <div class="modal-footer" style="width:50%;float:right;">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info">Send</button>
    </div>
</form>
<script type="text/javascript">
$(document).ready(function() {

    // check uncheck all inclusions

    $("#inhouseMaterial<?php echo $_REQUEST['costsheetVersionId']; ?>").click(function() {

        if (this.checked) {

            $('.Checkedinhouse<?php echo $_REQUEST['costsheetVersionId']; ?>').each(function() {

                this.checked = true;





            })

        } else {

            $('.Checkedinhouse<?php echo $_REQUEST['costsheetVersionId']; ?>').each(function() {

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

function getMaterialId<?php echo $_REQUEST['costsheetVersionId']; ?>() {

    var assignToMaterialInhouse = '';

    $('input:checkbox.Checkedinhouse<?php echo $_REQUEST['costsheetVersionId']; ?>').each(function() {

        var sThisVal = (this.checked ? $(this).val() : "");



        if (sThisVal != '') {

            assignToMaterialInhouse = assignToMaterialInhouse + sThisVal + ',';

        }

    });

    $('#assignToMaterialInhouse').val(assignToMaterialInhouse);

}

function getMaterialIdforSelect<?php echo $_REQUEST['costsheetVersionId']; ?>() {

    var assignToMaterialInhouse = '';

    $('input:checkbox.Checkedinhouse<?php echo $_REQUEST['costsheetVersionId']; ?>').each(function() {

        var sThisVal = (this.checked ? "" : $(this).val());



        if (sThisVal != '') {

            assignToMaterialInhouse = assignToMaterialInhouse + sThisVal + ',';

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
                    <input name="notes" type="text" class="form-control" id="notes"
                        value="<?php echo $editresult['notes']; ?>">
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
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Line</label>
                    <input name="line" type="number" class="form-control validate" id="line"
                        value="<?php echo $editresult['line']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Detail</label>
                    <input name="description" type="text" class="form-control validate" id="description"
                        value="<?php echo $editresult['description']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control validate">
                        <option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active
                        </option>
                        <option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>
                            Inactive</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php } ?>
<?php if($_REQUEST['action']=='changestyletype'){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'queryMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Style Type</label>
                    <select id="styleTypeId" name="styleTypeId" class="form-control validate">
                        <option value="2" <?php if($editresult['styleTypeId']=='2'){ ?>selected="selected" <?php } ?>>
                            Outsource</option>
                        <?php if($editresult['analyzeMaterialListSave']==1){ ?>
                        <option value="3" <?php if($editresult['styleTypeId']=='3'){ ?>selected="selected" <?php } ?>>
                            Inhouse & Outsource</option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Assign To</label>
                    <select id="assignTo" name="assignTo" class="form-control" displayname="Assign To">
                        <option value="0">Select</option>
                        <?php

$select='*';

$where=' deletestatus=0 and status=1 and profileId=90 order by firstName asc';

$rs=GetPageRecord($select,'userMaster',$where);

while($resListing=mysqli_fetch_array($rs)){

?>
                        <option value="<?php echo strip($resListing['id']); ?>">
                            <?php echo strip($resListing['firstName']).' '.strip($resListing['lastName']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Notes</label>
                    <input name="notes" type="text" class="form-control validate" id="notes"
                        value="<?php echo $editresult['notes']; ?>">
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


if($_REQUEST['action']=='sendtopdoutsource' && $_REQUEST['styleId']!=''){

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
                    <input name="notes" type="text" class="form-control" id="notes"
                        value="<?php echo $editresult['notes']; ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info">Save</button>
    </div>
    <input type="hidden" name="styleId" value="<?php echo $_REQUEST['styleId']; ?>" />
    <?php if($_REQUEST['styleTypeId']==3){ ?>
    <input name="action" type="hidden" id="action" value="materialSendToInhouseOutsource" />
    <input type="hidden" name="pd" value="2" />
    <?php } else{ ?>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input type="hidden" name="pd" value="1" />
    <?php } ?>
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



if($_REQUEST['action']=='holidaycalender'){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'holidayMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

$today = date("D");

$today = date("D M j G:i:s T Y");





?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Factory</label>
                    <select name="factoryId" id="factoryId" class="form-control">
                        <option value="0">All</option>
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
            <div class="col-md-6">
                <div class="form-group">
                    <label>Holiday Type</label>
                    <select name="holidayType" id="holidayType" class="form-control"
                        onchange="selectHoliday(this.value);">
                        <option value="1">Weekend</option>
                        <option value="2">Holiday</option>
                    </select>
                </div>
            </div>
            <div id="weekend" style="display:none; width:100%;">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Days</label>
                        <select name="days" id="days" class="form-control">
                            <option value="Sunday">Sunday</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                        </select>
                    </div>
                </div>
            </div>
            <div style="display:none; width:100%;" id="holiday">
                <div class="col-md-4" style="float:left;">
                    <div class="form-group">
                        <label>Holiday&nbsp;Name</label>
                        <input name="holidayName" type="text" class="form-control validate" id="holidayName"
                            value="<?php echo $editresult['holidayName']; ?>">
                    </div>
                </div>
                <div class="col-md-4" style="float:left;">
                    <div class="form-group">
                        <label>Start&nbsp;Date</label>
                        <input name="startDate" type="text" readonly="" class="form-control" id="startDate" value="">
                    </div>
                </div>
                <div class="col-md-4" style="float:left;">
                    <div class="form-group">
                        <label>End&nbsp;Date</label>
                        <input name="endDate" type="text" readonly="" class="form-control" id="endDate" value="">
                    </div>
                </div>
            </div>
            <script>
            $('#weekend').show();

            function selectHoliday(id) {

                if (id == 1) {

                    $('#weekend').show();

                    $('#holiday').hide();

                } else {

                    $('#weekend').hide();

                    $('#holiday').show();

                }

            }
            </script>
            <script>
            $('#startDate').Zebra_DatePicker({

                format: 'd-m-Y',

            });

            $('#endDate').Zebra_DatePicker({

                format: 'd-m-Y',

            });
            </script>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php }



if($_REQUEST['action']=='recordermaster'){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'recorderMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Factory</label>
                    <select id="factoryId" name="factoryId" class="form-control" displayname="Factory Id"
                        onchange="loadLines(this.value);">
                        <option value="">Select</option>
                        <?php

	$select='';

	$where='';

	$rs='';

	$select='*';

	$where=' deletestatus=0 and status=1 order by name asc';

	$rs=GetPageRecord($select,'factoryMaster',$where);

	while($resListing=mysqli_fetch_array($rs)){

	?>
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id']==$editresult['factoryId']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListing['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Line</label>
                    <div id="loadlines">
                        <select id="lines" multiple="multiple" name="lines[]">
                        </select>
                    </div>
                </div>
            </div>
            <script>
            <?php

if($_GET['id']!=''){ ?>

            $factoryid = $('#factoryId').val();

            loadLines($factoryid);

            <?php } ?>

            function loadLines(id) {

                $('#loadlines').load('loadlines.php?id=' + id + '&selectId=<?php echo $editresult['line']; ?>');

            }
            </script>
            <script>
            $(function() {

                $('#lines').multiselect({

                    includeSelectAllOption: true,

                    enableFiltering: true,

                    enableCaseInsensitiveFiltering: true,

                    filterPlaceholder: 'Search...'

                });

            });
            </script>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info">Save</button>
    </div>
    <input type="hidden" name="userid" id="userid" value="<?php echo $_REQUEST['userid']; ?>" />
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php }



if($_REQUEST['action']=='slabmaster'){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'slabMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Slab&nbsp;Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Description</label>
                    <input name="description" type="text" class="form-control validate" id="description"
                        value="<?php echo $editresult['description']; ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php }



if($_REQUEST['action']=='addslabdays'){

$id=decode($_REQUEST['id']);

$parentid=decode($_REQUEST['parentid']);





if($_GET['id']!=''){

$where1='id="'.$id.'"';

$rs1=GetPageRecord('*','slabMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}



?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Days</label>
                    <input name="days" type="text" class="form-control validate" id="days"
                        value="<?php echo $editresult['days']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Efficiency</label>
                    <input name="efficiency" type="text" class="form-control validate" id="efficiency"
                        value="<?php echo $editresult['efficiency']; ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="parentId" type="hidden" id="parentId" value="<?php echo encode($parentid); ?>" />
    <input name="action" type="hidden" id="action" value="addslabdays" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($id); ?>" />
    <input name="module" type="hidden" id="module" value="slabmaster" />
</form>
<?php }



if($_REQUEST['action']=='smvmaster'){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'smvMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>From SMV&nbsp;(In Minutes)</label>
                    <input name="fromsmv" type="text" class="form-control validate" id="fromsmv"
                        value="<?php echo $editresult['fromsmv']; ?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>To SMV&nbsp;(In Minutes)</label>
                    <input name="tosmv" type="text" class="form-control validate" id="tosmv"
                        value="<?php echo $editresult['tosmv']; ?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Slab</label>
                    <select id="slabId" name="slabId" class="form-control">
                        <option value="">Select</option>
                        <?php

	$select='';

	$where='';

	$rs='';

	$select='*';

	$where='1 and status=1 and parentId=0 order by name asc';

	$rs=GetPageRecord($select,'slabMaster',$where);

	while($resListing=mysqli_fetch_array($rs)){

	?>
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id']==$editresult['slabId']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListing['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php }



if($_REQUEST['action']=='lineplan'){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'smvMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Style</label>
                    <select name="styleId" id="styleId" class="form-control">
                        <option value="">Select</option>
                        <?php

	$rs1=GetPageRecord('*','queryMaster','1 and styleRefId!="" and deletestatus=0 and finalStatus=2 order by id desc');

	while($userss1=mysqli_fetch_array($rs1)){

	?>
                        <option value="<?php echo $userss1['id']; ?>"><?php echo '#'.$userss1['styleRefId']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <script>
            $(document).ready(function() {

                $('#styleId').select2();

            });
            </script>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Factory</label>
                    <select name="factoryId" id="factoryId" class="form-control" onchange="selectfactory(this.value);">
                        <option value="">Select</option>
                        <?php

	$rs=GetPageRecord('*','factoryMaster','1 and status=1 order by name asc');

	while($userss=mysqli_fetch_array($rs)){

	?>
                        <option value="<?php echo $userss['id']; ?>"><?php echo $userss['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <script>
            function selectfactory(factoryId) {

                $('#lineId').load('loadline.php?id=' + factoryId);

            }
            </script>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Line</label>
                    <select name="lineId" id="lineId" class="form-control">
                        <option value="">Select</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Qty.</label>
                    <input name="qty" type="number" class="form-control" id="qty"
                        value="<?php echo $editresult['qty']; ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php }



if($_REQUEST['action']=='createchaalan'){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'chaalanMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Department</label>
                    <select name="departmentId" id="departmentId" class="form-control">
                        <option value="">Select</option>
                        <?php

	$rs1=GetPageRecord('*','departmentMaster','1 and name!="" and deletestatus=0 and status=1 order by name asc');

	while($userss1=mysqli_fetch_array($rs1)){

	?>
                        <option value="<?php echo $userss1['id']; ?>"><?php echo $userss1['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Style</label>
                    <select name="styleId" id="styleId" class="form-control">
                        <option value="">Select</option>
                        <?php

	$rs1=GetPageRecord('*','queryMaster','1 and styleRefId!="" and deletestatus=0 and finalStatus=2 order by id desc');

	while($userss1=mysqli_fetch_array($rs1)){

	?>
                        <option value="<?php echo $userss1['id']; ?>"><?php echo '#'.$userss1['styleRefId']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <script>
            $(document).ready(function() {

                $('#styleId').select2();

            });
            </script>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Qty.</label>
                    <input name="qty" type="number" class="form-control" id="qty"
                        value="<?php echo $editresult['qty']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Type</label>
                    <select name="quantityType" id="quantityType" class="form-control">
                        <option value="Pcs">Pcs</option>
                        <option value="Meter">Meter</option>
                        <option value="Yard">Yard</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Remark</label>
                    <textarea class="form-control" name="remark" rows="3"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php }  ?>
<?php if($_REQUEST['action']=='addbuyerdocuments' && $_REQUEST['masterId']!=''){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'documentMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Document Type</label>
                    <select name="docType" id="docType" class="form-control">
                        <option value="">Select</option>
                        <?php

$aa=GetPageRecord('*','documentCategoryMaster','1 and status=1 order by name asc');

while($documenttype=mysqli_fetch_array($aa)){

?>
                        <option value="<?php echo $documenttype['id']; ?>"
                            <?php if($editresult['docType']==$documenttype['id']){ ?> selected="selected" <?php } ?>>
                            <?php echo $documenttype['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Document No.</label>
                    <input name="documentNo" type="text" class="form-control validate" id="documentNo"
                        value="<?php echo $editresult['documentNo']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Issue Date </label>
                    <input name="issueDate" type="text" class="form-control" id="issueDate" placeholder="Issue Date"
                        <?php if($editresult['issueDate']!='1970-01-01' && $editresult['issueDate']!=''){ ?>
                        value="<?php echo date('d-m-Y',strtotime($editresult['issueDate'])); ?>" <?php } ?>>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Expiry Date </label>
                    <input name="expiryDate" type="text" class="form-control" id="expiryDate" placeholder="Expiry Date"
                        <?php if($editresult['expiryDate']!='1970-01-01' && $editresult['expiryDate']!=''){ ?>
                        value="<?php echo date('d-m-Y',strtotime($editresult['expiryDate'])); ?>" <?php } ?>>
                </div>
            </div>
            <script>
            $('#issueDate').Zebra_DatePicker({

                format: 'd-m-Y',

            });

            $('#expiryDate').Zebra_DatePicker({

                format: 'd-m-Y',

            });
            </script>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Country</label>
                    <select name="countryId" id="countryId" class="form-control">
                        <option value="">Select</option>
                        <?php

$bb=GetPageRecord('*','countryMaster','1 and status=1 and deletestatus=0 order by name asc');

while($countryname=mysqli_fetch_array($bb)){

?>
                        <option value="<?php echo $countryname['id']; ?>"
                            <?php if($editresult['countryId']==$countryname['id']){ ?> selected="selected" <?php } ?>>
                            <?php echo $countryname['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Attachment</label>
                    <input name="attachment" type="file" class="form-control" id="attachment">
                </div>
            </div>
            <input type="hidden" name="attachmentEdit" id="attachmentEdit"
                value="<?php echo $editresult['attachment']; ?>" />
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control validate">
                        <option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active
                        </option>
                        <option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>
                            Inactive</option>
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
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['module']; ?>" />
    <input name="masterId" type="hidden" id="masterId" value="<?php echo $_REQUEST['masterId']; ?>" />
    <input type="hidden" name="type" id="type" value="<?php echo $_REQUEST['type']; ?>" />
</form>
<?php }



?>
<?php if($_REQUEST['action']=='assigntosoursingteam'){

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Assign To</label>
                    <select id="assignto" multiple="multiple" name="assignto[]">
                        <?php

$select='';

$where='';

$rs='';

$select='*';

$where='profileId=159';

$rs=GetPageRecord($select,'userMaster',$where);

while($rest=mysqli_fetch_array($rs)){

?>
                        <option value="<?php echo $rest['id']; ?>">
                            <?php echo $rest['firstName']." ".$rest['lastName'] ;?></option>
                        <?php } ?>
                    </select>
                    <input name="assignToMaterial[]" id="assignToMaterial" type="hidden" value="0" />
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

            var assignToMaterial = '';



            $('input:checkbox.deletematerial').each(function() {

                var sThisVal = (this.checked ? $(this).val() : "");



                if (sThisVal != '') {

                    assignToMaterial = assignToMaterial + sThisVal + ',';

                }

            });

            $('#assignToMaterial').val(assignToMaterial);
            </script>
            <div class="col-md-12" style="display:none;">
                <div class="form-group">
                    <label>Notes</label>
                    <input name="description" type="text" class="form-control validate" id="description" value="">
                </div>
            </div>
        </div>
    </div>
    <input name="costsheetVersionId" type="hidden" id="costsheetVersionId"
        value="<?php echo $_REQUEST['costsheetVersionId'] ?>" />
    <input name="styleId" type="hidden" id="styleId" value="<?php echo $_REQUEST['styleId'] ?>" />
    <input name="action" type="hidden" id="action" value="assigntosoursingteam" />
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info">Save</button>
    </div>
</form>
<?php }



if($_REQUEST['action']=='indentSendtoBom'){

$styleId = $_REQUEST['styleId'];

$supplierId = $_REQUEST['supplierId'];

$techpackdetailId = $_REQUEST['techpackdetailId'];

$styleSubCateId = $_REQUEST['styleSubCateId'];

$materialId = $_REQUEST['materialId'];

$materialTypeId = $_REQUEST['materialTypeId'];

$avg = $_REQUEST['avg'];

$uom = $_REQUEST['uom'];

$rate = $_REQUEST['rate'];

$valueonepiece = $_REQUEST['valueonepiece'];

$color = $_REQUEST['color'];

$size = $_REQUEST['size'];

$poQty = $_REQUEST['poQty'];

$materialQty = $_REQUEST['materialQty'];

$materialValue = $_REQUEST['totalMaterialValue'];

$stockInStore = $_REQUEST['stockInStore'];

$bomWidth = $_REQUEST['bomWidth'];

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'indentCreationMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<div style="padding:10px;">
    <table width="100%" border="1" cellspacing="2" cellpadding="2" style="margin-top:5px;text-align: center;">
        <tr style="background-color: #33a4d0; font-weight: 600; color: #fff;">
            <td>Supplier&nbsp;Name</td>
            <td>Supplier&nbsp;Code</td>
            <td>Order&nbsp;Qty.</td>
            <td>Pending&nbsp;Qty.</td>
            <td>Rate</td>
            <td>Value</td>
            <td>Action</td>
        </tr>
        <?php

$pendingQty=0;
//echo 'styleId="'.$styleId.'" and techpackdetailId="'.$techpackdetailId.'" and styleSubCatTableId="'.$styleSubCateId.'" and color="'.$color.'" and size="'.$size.'"';
$rsindent=GetPageRecord('*','indentCreationMaster','styleId="'.$styleId.'" and styleSubCatTableId="'.$styleSubCateId.'" and color="'.$color.'" and size="'.$size.'"');

while($resListingIndent=mysqli_fetch_array($rsindent)){



  ?>
        <tr>
            <td><?php echo getSupplierName($resListingIndent['supplierId']); ?></td>
            <td><?php echo getSupplierCode($resListingIndent['supplierId']); ?></td>
            <td><?php echo $resListingIndent['orderQty']; $orderQty =  $orderQty+$resListingIndent['orderQty']; ?></td>
            <td><?php echo $resListingIndent['pendingQty'];  ?></td>
            <td><?php echo $resListingIndent['sellingRate']; ?></td>
            <td><?php echo $resListingIndent['sellingValue']; $sellingValue =  $sellingValue+$resListingIndent['sellingValue']; ?>
            </td>
            <td><?php if($resListingIndent['isCancel']=='no'){ ?><button id="cancelid<?php echo $resListingIndent['id']; ?>" onclick="cancelpo(<?php echo $resListingIndent['id']; ?>);">Cancel</button><?php }else{ ?><button>Canceled</button><?php } ?></td>
        </tr>
        <?php } ?>
        <tr style="background-color: #33a4d0; font-weight: 600; color: #fff;">
            <td>&nbsp;</td>
            <td>Total</td>
            <td><?php echo $orderQty; ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><?php echo $sellingValue; ?></td>
            <td>&nbsp;</td>
        </tr>
    </table>

</div>
<script>
    function cancelpo(cid){
        var connfmsg = confirm('Are you sure you want to cancel?');
        if(connfmsg==true){
            $('#cancelid'+cid).text('Loading...');
            $('#cancelid'+cid).load('newaction.php?action=cancelpo&cid='+cid);
        }

    }
</script>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label>PO&nbsp;Type</label>
                    <select id="poTypeId" class="form-control" name="poTypeId" required onchange="posubfunc()">
                        <option value="">Select</option>
                        <?php

$select='';

$where='';

$rs='';

$select='*';

$where='1 and subId!="1" order by name asc';

$rs=GetPageRecord($select,'poTypeMaster',$where);

while($rest=mysqli_fetch_array($rs)){

?>
                        <option value="<?php echo $rest['id']; ?>"><?php echo $rest['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2" id="sblockid" style="display:none;">
                <div class="form-group">
                    <label>Sub&nbsp;Type</label>
                    <select id="poSubTypeId" class="form-control" name="poSubTypeId">
                        <option value="">Select</option>
                        <?php

$select='';

$where='';

$rs='';

$select='*';

$where='1 and subId="1" order by name asc';

$rs=GetPageRecord($select,'poTypeMaster',$where);

while($rest=mysqli_fetch_array($rs)){

?>
                        <option value="<?php echo $rest['id']; ?>"><?php echo $rest['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <script>
            function posubfunc() {

                var tyr = $("#poTypeId").val();
                if (tyr == 1) {

                    $("#sblockid").css("display", "block")
                } else {

                    $("#sblockid").css("display", "none")
                }



            }
            </script>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Supplier&nbsp;Name</label>
                    <select id="supplierId" class="form-control " name="supplierId">
                        <option value="">Select</option>
                        <?php

$select='';

$where='';

$rs='';

$select='*';

$where='1 and deletestatus=0 order by name asc';

$rs=GetPageRecord($select,'suppliersMaster',$where);

while($rest=mysqli_fetch_array($rs)){

?>
                        <option value="<?php echo $rest['id']; ?>"
                            <?php if($supplierId==$rest['id']){ echo 'selected'; } ?>>
                            <?php echo $rest['name'].' - '.$rest['supplierId']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Material&nbsp;Qty.</label>
                    <input name="materialQty" type="text" class="form-control" id="materialQty"
                        value="<?php echo $materialQty; ?>" readonly="readonly">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Order&nbsp;Qty.</label>
                    <input name="orderQty" type="text" class="form-control" id="orderQty" value="" onblur="qtyCount();">
                    <!--<p style=" color:red; display:none;" id="qtycheck">Order qty. cant be greater then marerial qty.</p>-->
                </div>
            </div>
            <script>
            function qtyCount(orderQty) {

                var materialQty = Number($('#materialQty').val());

                var orderQty = Number($('#orderQty').val());



                //  if(orderQty<=materialQty){

                $('#qtycheck').hide();

                var pendingQty = Number(materialQty - orderQty);

                pendingQty = parseFloat(pendingQty).toFixed(2);

                var sellingRate = $('#sellingRate').val();

                var sellingValue = Number(orderQty * sellingRate);

                sellingValue = parseFloat(sellingValue).toFixed(2);

                $('#sellingValue').val(sellingValue);

                $('#pendingQty').val(pendingQty);

                //  }else{

                //  	$('#qtycheck').show();

                // 	$('#sellingValue').val(0);

                //  	$('#pendingQty').val(0);

                //  }



            }
            </script>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Rate</label>
                    <input name="sellingRate" type="text" class="form-control" id="sellingRate"
                        value="<?php echo $rate; ?>" onkeyup="qtyCount();" readonly>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Value</label>
                    <input name="sellingValue" type="text" class="form-control" id="sellingValue" value=""
                        readonly="readonly">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Pending&nbsp;Qty.</label>
                    <input name="pendingQty" type="text" class="form-control" id="pendingQty" value=""
                        onkeyup="qtyCount();" readonly="readonly">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Greige&nbsp;Fabric</label>
                    <input name="grefab" type="text" class="form-control" id="grefab"
                        value="<?php echo $_REQUEST['matqty']; ?>" readonly="readonly">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Allocate&nbsp;Qty.</label>
                    <input name="allocateq" type="text" class="form-control" id="allocateq"
                        value="<?php echo $_REQUEST['matqty']; ?>" readonly="readonly">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Issued Qty.</label>
                    <input name="greorder" type="text" class="form-control" id="greorder" value="">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info">Save</button>
    </div>
    <input name="action" type="hidden" id="action" value="indentSendtoBom" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" value="indentmpl" />
    <input name="styleId" type="hidden" value="<?php echo $styleId; ?>" />
    <input name="techpackdetailId" type="hidden" value="<?php echo $techpackdetailId; ?>" />
    <input name="styleSubCateId" type="hidden" value="<?php echo $styleSubCateId; ?>" />
    <input name="materialId" type="hidden" value="<?php echo $materialId; ?>" />
    <input name="materialTypeId" type="hidden" value="<?php echo $materialTypeId; ?>" />
    <input name="avg" type="hidden" value="<?php echo $avg; ?>" />
    <input name="uom" type="hidden" value="<?php echo $uom; ?>" />
    <input name="valueonepiece" type="hidden" value="<?php echo $valueonepiece; ?>" />
    <input name="color" type="hidden" value="<?php echo $color; ?>" />
    <input name="size" type="hidden" value="<?php echo $size; ?>" />
    <input name="poQty" type="hidden" value="<?php echo $poQty; ?>" />
    <input name="materialQty" type="hidden" value="<?php echo $materialQty; ?>" />
    <input name="materialValue" type="hidden" value="<?php echo $materialValue; ?>" />
    <input name="stockInStore" type="hidden" value="<?php echo $stockInStore; ?>" />
    <input name="bomWidth" type="hidden" id="bomWidth" value="<?php echo $bomWidth; ?>" />
    <input name="materialMasterId" type="hidden" value="<?php echo $_REQUEST['materialMasterId']; ?>" />
</form>
<?php }



if($_REQUEST['action']=='generatebompo'){

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <p style="font-size: 16px;text-align: center;">Are you sure you want to Generate PO?</p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Remark</label>
                <input name="remark" type="text" class="form-control" id="remark" value="">
            </div>
        </div>
    </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn bg-warning" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn bg-success">Generate</button>
    </div>
    <input name="supplierId" type="hidden" id="supplierId" value="<?php echo $_REQUEST['supplierId']; ?>" />
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="module" type="hidden" id="module" value="bomtosupplier" />
</form>
<?php }



if($_REQUEST['action']=='bomsuppliersentyes'){

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <!--<div class="form-group">

<label>Assign To</label>

  <select id="assignto"  name="assignto" >

   <?php

$select='';

$where='';

$rs='';

$select='*';

$where='id="'.decode($_REQUEST['supplierId']).'"';

$rs=GetPageRecord($select,'suppliersMaster',$where);

while($rest=mysqli_fetch_array($rs)){

?>

    <option value="<?php echo $rest['id']; ?>"><?php echo $rest['name'];?></option>

    <?php } ?>

</select>





  </div>-->
                <input name="assignToSupplier[]" id="assignToSupplier" type="hidden" value="0" />
                <span>Are you sure you want to generate PO for the selected materials?</span>
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

            var assignToMaterial = '';



            $('input:checkbox.deletematerial').each(function() {

                var sThisVal = (this.checked ? $(this).val() : "");



                if (sThisVal != '') {

                    assignToMaterial = assignToMaterial + sThisVal + ',';

                }

            });

            var poTypeId = $('#poTypeId').val();
            $('#poType').val(poTypeId);

            $('#assignToSupplier').val(assignToMaterial);
            </script>
            <div class="col-md-12" style="display:none;">
                <div class="form-group">
                    <label>Notes</label>
                    <input name="description" type="text" class="form-control validate" id="description" value="">
                </div>
            </div>
        </div>
    </div>
    <input name="action" type="hidden" id="action" value="assignpotosupplier" />
    <input name="poTypeId" id="poType" type="hidden" value="<?php echo $_POST['poTypeId']; ?>" />
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">No</button>
        <button type="submit" class="btn bg-info">Yes</button>
    </div>
</form>
<?php }



if($_REQUEST['action']=='sendpoemailtosuppier'){

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Attachment</label>
                    <input name="supplierPoAttachment" type="file" class="form-control" id="supplierPoAttachment">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Remark</label>
                    <input name="remark" type="text" class="form-control" id="remark" value="">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn bg-primary">Send</button>
    </div>
    <input name="supplierId" type="hidden" id="supplierId" value="<?php echo $_REQUEST['supplierId']; ?>" />
    <input name="poNumber" type="hidden" id="poNumber" value="<?php echo $_REQUEST['poNumber']; ?>" />
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="module" type="hidden" id="module" value="posupplier" />
</form>
<?php }

//Re-Assign for Vendor Outsource for price

if($_REQUEST['action']=='reassignoutsourceforprice'){

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Remark</label>
                    <textarea name="notes" id="notes" rows="3" class="form-control"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="styleId" type="hidden" id="styleId" value="<?php echo $_REQUEST['styleId']; ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['module']; ?>" />
</form>
<?php }

if($_REQUEST['action']=='cancelstyle'){

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Reason For Cancel</label>
                    <select name="cancelReason" id="cancelReason" class="form-control">
                        <option value="">Select</option>
                        <option value="1">Costing Not Meet</option>
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
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="cancelstyle" />
    <input name="styleId" type="hidden" id="styleId" value="<?php echo $_REQUEST['styleId']; ?>" />
</form>
<?php }

//===============================================================APPREL NEW FORM ACTION-05-02-2020=============================================================================

if($_REQUEST['action']=='headcreation'){

if($_GET['id']!='' && $_GET['companyId']!=''){

$id=clean(decode($_GET['id']));

$companyId=clean(decode($_GET['companyId']));

$select1='*';

$where1='id='.$id.' and companyId="'.$companyId.'"';

$rs1=GetPageRecord($select1,'finalheadcreationmaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Company</label>
                    <select class="form-control" name="companyId" id="companyId">
                        <option value="">Select</option>
                        <?php

								$rsk=GetPageRecord('*','companyMaster','1 order by name asc');

								while($comData=mysqli_fetch_array($rsk)){

								?>
                        <option value="<?php echo $comData['id']; ?>" <?php if($comData['id']==$companyId){ ?>
                            selected="selected" <?php } ?>><?php echo $comData['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Head Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['label']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Description</label>
                    <input name="description" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['description']; ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php }



if($_REQUEST['action']=='accountcoa'){

if($_REQUEST['id']!=''){

$id=clean($_REQUEST['id']);

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'finalheadcreationmaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Parent Head</label>
                    <input name="label" type="text" class="form-control validate" id="label"
                        value="<?php echo $editresult['label']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>New Head</label>
                    <input name="newLabel" type="text" class="form-control" id="newLabel" value="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Company</label>
                    <select name="companyId" id="companyId" class="form-control">
                        <?php

$cq=GetPageRecord('id,name','companyMaster','1 and id="'.$editresult['companyId'].'"');

$comName=mysqli_fetch_array($cq);

?>
                        <option value="<?php echo $comName['id']; ?>"><?php echo $comName['name']; ?></option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Trial Balance</label>
                    <select name="trialbalance" id="trialbalance" class="form-control">
                        <option value="0" <?php if($editresult['trialbalance']==0){ ?> selected="selected" <?php } ?>>No
                        </option>
                        <option value="1" <?php if($editresult['trialbalance']==1){ ?> selected="selected" <?php } ?>>
                            Yes</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer" style="width: 50%; float: left; align-items: unset !important; display: block;">
        <button type="button" onclick="deleteAccountDebit();" class="btn btn-link"
            style="background-color: #eb5252; color: #fff;"><i class="fa fa-times" aria-hidden="true"
                style="margin-right:2px;"></i> Delete</button>
    </div>
    <script>
    function deleteAccountDebit() {

        var delStyle = confirm('Are you sure you want to delete this head?');

        if (delStyle == true) {

            window.location.href =
                'showpage.crm?action=deleteaccounthead&module=<?php echo $_REQUEST['action']; ?>&editId=<?php echo encode($_REQUEST['id']); ?>';

        }

    }
    </script>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php }

if($_REQUEST['action']=='bookWashingMaster'){

if($_REQUEST['id']!=''){

$id=$_REQUEST['id'];

$select1='*';

$where1='id="'.$id.'"';

$rs1=GetPageRecord($select1,'bookWashingMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<?php

$adddate =$_REQUEST['adddate'];

$adddate =strtotime($adddate);

$currentdate=date('Y-m-d');

$currentdate =strtotime($currentdate);

 ?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>From Time</label>
                    <select id="fromTime" name="fromTime" class="form-control" autocomplete="off">
                        <?php

	$start=strtotime('10:00');

	$end=strtotime('20:00');

	for ($i=$start;$i<=$end;$i = $i + 60*60)

	{ ?>
                        <option value="<?php echo date('g:i A',$i); ?>"
                            <?php if('10:00 AM'==date('g:i A',$i) && $_REQUEST['id']==''){ if($editresult['fromTime']==date('g:i A',$i)){ ?>
                            selected="selected" <?php } } ?>><?php echo date('g:i A',$i); ?></option>
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
                        <option value="<?php echo date('g:i A',$i); ?>"
                            <?php if('10:00 AM'==date('g:i A',$i) && $_REQUEST['id']==''){ if($editresult['toTime']==date('g:i A',$i)){ ?>
                            selected="selected" <?php } } ?>><?php echo date('g:i A',$i); ?></option>
                        <?php  }  ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Limit</label>
                    <input name="approveLimit" type="text" class="form-control validate" id="approveLimit"
                        value="<?php echo $editresult['approveLimit']; ?>">
                </div>
            </div>
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
                        <option value="<?php echo $resListing['id']; ?>"
                            <?php if($editresult['styleid']==$resListing['id']){ ?> selected="selected" <?php } ?>>
                            <?php echo '#'.$resListing['styleRefId'].'-'.$resListing['subject']; ?></option>
                        <?php } ?>
                    </select>
                    <script>
                    $(document).ready(function() {

                        $("#styleid").select2();

                    });
                    </script>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Notes</label>
                    <textarea name="description"
                        class="form-control"><?php echo $editresult['description']; ?></textarea>
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
<?php }



if($_REQUEST['action']=='bookembroideryMaster'){

if($_REQUEST['id']!=''){

$id=$_REQUEST['id'];

$select1='*';

$where1='id="'.$id.'"';

$rs1=GetPageRecord($select1,'bookembroideryMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<?php

$adddate =$_REQUEST['adddate'];

$adddate =strtotime($adddate);

$currentdate=date('Y-m-d');

$currentdate =strtotime($currentdate);

 ?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>From Time</label>
                    <select id="fromTime" name="fromTime" class="form-control" autocomplete="off">
                        <?php

	$start=strtotime('10:00');

	$end=strtotime('20:00');

	for ($i=$start;$i<=$end;$i = $i + 60*60)

	{ ?>
                        <option value="<?php echo date('g:i A',$i); ?>"
                            <?php if('10:00 AM'==date('g:i A',$i) && $_REQUEST['id']==''){ if($editresult['fromTime']==date('g:i A',$i)){ ?>
                            selected="selected" <?php } } ?>><?php echo date('g:i A',$i); ?></option>
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
                        <option value="<?php echo date('g:i A',$i); ?>"
                            <?php if('10:00 AM'==date('g:i A',$i) && $_REQUEST['id']==''){ if($editresult['toTime']==date('g:i A',$i)){ ?>
                            selected="selected" <?php } } ?>><?php echo date('g:i A',$i); ?></option>
                        <?php  }  ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Limit</label>
                    <input name="approveLimit" type="text" class="form-control validate" id="approveLimit"
                        value="<?php echo $editresult['approveLimit']; ?>">
                </div>
            </div>
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
                        <option value="<?php echo $resListing['id']; ?>"
                            <?php if($editresult['styleid']==$resListing['id']){ ?> selected="selected" <?php } ?>>
                            <?php echo '#'.$resListing['styleRefId'].'-'.$resListing['subject']; ?></option>
                        <?php } ?>
                    </select>
                    <script>
                    $(document).ready(function() {

                        $("#styleid").select2();

                    });
                    </script>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Notes</label>
                    <textarea name="description"
                        class="form-control"><?php echo $editresult['description']; ?></textarea>
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
<?php }

//======================================================================================new modal 17-02-2020

if($_REQUEST['action']=='machinemaster'){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'machineMaster',$where1);

$editresult=mysqli_fetch_array($rs1);



}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Machine Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control validate">
                        <option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active
                        </option>
                        <option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>
                            Inactive</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Full Name</label>
                    <input name="description" type="text" class="form-control validate" id="description"
                        value="<?php echo $editresult['description']; ?>">
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

//===============================================opearation bulletin

if($_REQUEST['action']=='assemblyoperations'){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'assemblyoperationsMaster',$where1);

$editresult=mysqli_fetch_array($rs1);



}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Machine</label>
                    <select id="machineId" name="machineId[]" multiple="multiple" class="form-control validate"
                        displayname="">
                        <?php

	$rs=GetPageRecord('*','machineMaster','1 and name!="" order by name asc');

	$newdata = explode(',', $editresult['machineId']);

	while($resListing=mysqli_fetch_array($rs)){

	?>
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php foreach($newdata as $key => $value) { if($value == $resListing['id']){ echo 'selected="selected"'; } }?>>
                            <?php echo strip($resListing['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <script>
            $(function() {

                $('#machineId').multiselect({

                    includeSelectAllOption: true,

                    enableFiltering: true,

                    enableCaseInsensitiveFiltering: true,

                    filterPlaceholder: 'Search...'

                });

            });
            </script>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Description</label>
                    <input name="description" type="text" class="form-control validate" id="description"
                        value="<?php echo $editresult['description']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>SAM</label>
                    <input name="sam" type="text" class="form-control validate" id="sam"
                        value="<?php echo $editresult['sam']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control validate">
                        <option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active
                        </option>
                        <option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>
                            Inactive</option>
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

//========================skill matrix

if($_REQUEST['action']=='skillmatrix'){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'skillMatrix',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Employee Code</label>
                    <select id="empCode" name="empCode" class="select2 form-control validate" displayname="">
                        <?php

	$rs=GetPageRecord('*','employeeMaster','1 and name!="" order by name asc');

	while($resListing=mysqli_fetch_array($rs)){

	?>
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id']==$editresult['empCode']){ ?> selected="selected" <?php } ?>>
                            <?php echo $resListing['empCode'].' - '.strip($resListing['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Operation Name</label>
                    <select id="particulars" name="particulars" class="select2 form-control validate" displayname=""
                        onchange="loadmachineData();">
                        <option value="">Select</option>
                        <?php

	$on=GetPageRecord('*','assemblyoperationsMaster','1 and name!="" order by name asc');

	while($partiName=mysqli_fetch_array($on)){

	?>
                        <option value="<?php echo strip($partiName['id']); ?>"
                            <?php if($partiName['id']==$editresult['particulars']){ ?> selected="selected" <?php } ?>>
                            <?php echo strip($partiName['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Machine</label>
                    <select name="machineId" id="machineId" class="form-control">
                        <option value="">Select</option>
                    </select>
                    <script>
                    function loadmachineData() {

                        var particulars = $('#particulars').val();

                        $('#machineId').load('loadmachine.php?id=' + particulars +
                            '&selectId=<?php echo $editresult['machineId']; ?>');

                    }

                    var particulars = $('#particulars').val();

                    if (particulars != '') {

                        loadmachineData();

                    }
                    </script>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Efficiency</label>
                    <input name="efficiency" type="text" class="form-control validate" id="efficiency"
                        value="<?php echo $editresult['efficiency']; ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php }

//Send to file handover to IED Department

if($_REQUEST['action']=='filehandver' && $_REQUEST['styleId']!=''){

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>File Send To</label>
                    <select name="assignTo" id="assignTo" class="form-control">
                        <option value="">Select</option>
                        <?php

$select='';

$where='';

$rs='';

$select='*';

$where='profileId=72';

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
                    <input name="notes" type="text" class="form-control" id="notes"
                        value="<?php echo $editresult['notes']; ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info">Save</button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['module']; ?>" />
    <input name="pcd" type="hidden" id="pcd" value="<?php echo $_REQUEST['pcd']; ?>" />
    <input type="hidden" name="styleId" value="<?php echo $_REQUEST['styleId']; ?>" />
</form>
<?php }

//Accecpt and reject handover by IED

if($_REQUEST['action']=='filehandveraccept' && $_REQUEST['styleId']!=''){

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Accept/Reject</label>
                    <select name="handoverStatus" id="handoverStatus" class="form-control">
                        <option value="">Select</option>
                        <option value="2">Accept</option>
                        <option value="3">Reject</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Notes</label>
                    <input name="notes" type="text" class="form-control" id="notes"
                        value="<?php echo $editresult['notes']; ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info">Save</button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['module']; ?>" />
    <input type="hidden" name="styleId" value="<?php echo $_REQUEST['styleId']; ?>" />
</form>
<?php }

if($_REQUEST['action']=='companymaster'){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'companyMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Company Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Company ID</label>
                    <input name="companyId" type="text" class="form-control validate" id="companyId"
                        value="<?php echo $editresult['companyId']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Company Short Name</label>
                    <input name="shortname" type="text" class="form-control validate" id="shortname"
                        value="<?php echo $editresult['companyShortName']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Company Email</label>
                    <input name="email" type="text" class="form-control validate" id="email"
                        value="<?php echo $editresult['email']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Company Phone</label>
                    <input name="phone" type="text" class="form-control validate" id="phone"
                        value="<?php echo $editresult['phone']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control validate">
                        <option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active
                        </option>
                        <option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>
                            Inactive</option>
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

if($_REQUEST['action']=='emailCostSheet'){

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Buyer</label>
                    <select id="assignTo" name="assignTo" class="form-control" displayname="Assign To">
                        <option value="0">Select</option>
                        <?php



$rs=GetPageRecord('id,name','buyerMaster','1 order by name asc');

while($resListing=mysqli_fetch_array($rs)){

?>
                        <option value="<?php echo $resListing['id']; ?>"><?php echo $resListing['name']; ?></option>
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
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="emailCostSheet" />
    <input name="styleId" type="hidden" id="styleId" value="<?php echo $_REQUEST['styleId']; ?>" />
</form>
<?php }

//============add voucher Approval============================

if($_REQUEST['action']=='voucherapproval' && $_REQUEST['id']!=''){

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <?php if($_REQUEST['approvedStatus']==1){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'accountsMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
            <div
                style="padding: 15px 12px; background-color: #d2ffdd; width: 100%; display: block; font-size: 13px; border: 1px solid #ededed;">
                <?php echo $editresult['notes']; ?></div>
            <?php }else{ ?>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Change Status</label>
                    <select id="changeStatus" name="changeStatus" class="form-control" displayname="Change Status">
                        <option value="0">Select</option>
                        <option value="1">Approved</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Notes</label>
                    <textarea name="notes" id="notes" rows="3" class="form-control"></textarea>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php if($_REQUEST['approvedStatus']!=1){ ?>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <?php } ?>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
</form>
<?php }

//======================end voucher Approval======================

//===============add proforma invoice===============================

if($_REQUEST['action']=='proformainvoice' && $_REQUEST['id']!=''){

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Invoice Type</label>
                    <select id="invoiceType" name="invoiceType" class="form-control" displayname="Change Status">
                        <option value="0">Select</option>
                        <option value="1">Proforma</option>
                        <option value="2">Invoice</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
    <input name="pid" type="hidden" id="pid" value="<?php echo $_REQUEST['pid']; ?>" />
    <input name="inid" type="hidden" id="inid" value="<?php echo $_REQUEST['inid']; ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['module']; ?>" />
</form>
<?php }

if($_REQUEST['action']=='invoiceapproval' && $_REQUEST['id']!=''){

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <?php if($_REQUEST['approvedStatus']==1){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'accountsMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
            <div
                style="padding: 15px 12px; background-color: #d2ffdd; width: 100%; display: block; font-size: 13px; border: 1px solid #ededed;">
                <?php echo $editresult['notes']; ?></div>
            <?php }else{ ?>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Change Status</label>
                    <select id="changeStatus" name="changeStatus" class="form-control" displayname="Change Status">
                        <option value="0">Select</option>
                        <option value="1">Approved</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Notes</label>
                    <textarea name="notes" id="notes" rows="3" class="form-control"></textarea>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php if($_REQUEST['approvedStatus']!=1){ ?>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <?php } ?>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
</form>
<?php }

 ?>
<?php if($_REQUEST['action']=='sizerangemaster'){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'sizerangeMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Size Name</label>
                    <input name="name" type="text" class="form-control  validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <script>
            $(document).ready(function() {

                $("#size").select2();

            });
            </script>
            <?php

$newdata = explode(':', $editresult['size']);

?>
            <style>
            .select2-search__field {

                display: none;

            }
            </style>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Size</label>
                    <select name="size[]" id="size" class="form-control  validate" multiple="multiple">
                        <option value="" disabled="disabled">Select</option>
                        <?php
                        $rslSize=GetPageRecord('name','sizeMaster',' status=1 order by id asc');
                        while($resListinglSize=mysqli_fetch_array($rslSize)){
                        ?>
                        <option value="<?php echo $resListinglSize['name']; ?>" <?php foreach($newdata as $size){ if($size==$resListinglSize['name']) { ?>selected="selected" <?php } } ?>><?php echo $resListinglSize['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Description</label>
                    <input name="description" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['description']; ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php } ?>
<?php if($_REQUEST['action']=='valueeditionmaster'){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'valueEditionMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Description</label>
                    <input name="description" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['description']; ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php } ?>
<?php if($_REQUEST['action']=='segmentmaster'){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'segmenteMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Brand</label>
                    <select name="brand" id="brand" class="form-control validate">
                        <option>Select</option>
                        <?php
                $select1a='*';

$where1a='1';

$rs1a=GetPageRecord($select1a,'brandMaster',$where1a);

while($editresulta=mysqli_fetch_array($rs1a)){

                ?>
                        <option value="<?php echo $editresulta['id']; ?>"
                            <?php if($editresult['brand']==$editresulta['id']) { ?>selected="selected" <?php } ?>>
                            <?php echo $editresulta['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Description</label>
                    <input name="description" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['description']; ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php } ?>
<?php if($_REQUEST['action']=='hsncodemaster'){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'hsncodeMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

$hardate=date("d-m-Y", strtotime($editresult['hardate']));

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Harmonized Code</label>
                    <input name="harcode" type="text" class="form-control validate" id="harcode"
                        value="<?php echo $editresult['harcode']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Harmonized Description</label>
                    <input name="hardescription" type="text" class="form-control validate" id="hardescription"
                        value="<?php echo $editresult['hardescription']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Content Description</label>
                    <input name="condescription" type="text" class="form-control validate" id="condescription"
                        value="<?php echo $editresult['condescription']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>User Description</label>
                    <input name="userdescription" type="text" class="form-control validate" id="userdescription"
                        value="<?php echo $editresult['userdescription']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control validate">
                        <option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active
                        </option>
                        <option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>
                            Inactive</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Type</label>
                    <select name="hsntype" id="hsntype" class="form-control validate">
                        <option value="1" <?php if($editresult['hsntype']=='1') { ?>selected="selected" <?php } ?>>
                            MATERIAL</option>
                        <option value="2" <?php if($editresult['hsntype']=='2') { ?>selected="selected" <?php } ?>>
                            PRODUCT</option>
                        <option value="3" <?php if($editresult['hsntype']=='3') { ?>selected="selected" <?php } ?>>
                            PROCESS</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>GST Template(%)</label>
                    <input name="gsttemplate" type="text" class="form-control validate" id="gsttemplate"
                        value="<?php echo $editresult['gsttemplate']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>HSN Category</label>
                    <select name="hsncategory" id="hsncategory" class="form-control validate">
                        <option value="1" <?php if($editresult['hsncategory']=='1') { ?>selected="selected" <?php } ?>>
                            DOMESTIC</option>
                        <option value="2" <?php if($editresult['hsncategory']=='2') { ?>selected="selected" <?php } ?>>
                            INTERNATIONAL</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Harmonized Date</label>
                    <input name="hardate" type="text" class="form-control validate" id="hardate"
                        <?php if($hardate!="" && $hardate!="01-01-1970"){ ?> value="<?php echo $hardate; ?>" <?php } ?>>
                </div>
            </div>
            <script>
            $('#hardate').Zebra_DatePicker({

                format: 'd-m-Y',

            });
            </script>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php } ?>
<?php if($_REQUEST['action']=='sizeratiomaster'){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'sizeRatioMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Size Range</label>
                    <select name="sizeRangeId" id="sizeRangeId" class="form-control validate" onChange="changeRatio(this.value);">
                        <option value="">Select</option>
                        <?php

	$select='';

	$where='';

	$rs='';

	$select='*';

	$where=' deletestatus=0 and status=1 order by name asc';

	$rs=GetPageRecord($select,'sizerangeMaster',$where);

	while($resListing=mysqli_fetch_array($rs)){

	?>
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id']==$editresult['sizeRangeId']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListing['size']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <style>
            .select2-search__field {
                display: none;
            }
            .grid-container {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                grid-auto-rows: minmax(min-content, max-content);
            }
            .grid-item {
                margin: 5px;
            }
            </style>

            <div class="col-md-12">
                <div class="form-group">
                    <label>Size Ratio</label>
                    <div class="grid-container" id="sizeratiotable">
                    <?php if($_GET['id']!=''){ ?>
                        <?php
                        $sizesArr = explode(':',$editresult['sizeRangeName']);
                        $sizeratiodata = explode(':',$editresult['name']);
                        $sno=0;
                        foreach($sizesArr as $sizedata){
                        ?>
                        <div class="grid-item"><label style="font-weight:700;width: 30px;"><?php echo $sizedata; ?></label>
                            <input type="text" name="size[]" style="width: 60px;" value="<?php echo $sizeratiodata[$sno];?>" />
                        </div>
                        <?php $sno++; } ?>
                        <input type="hidden" name="sizename" value="<?php echo $editresult['sizeRangeName']; ?>" >
                    <?php } ?>
                   </div>
                </div>
            </div>
            <script>
                function changeRatio(id){
                    $('#sizeratiotable').load('loadsizeratiopage.php?action=showsize&id='+id);
                }

            </script>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Description</label>
                    <input name="description" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['description']; ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php } ?>
<?php if($_REQUEST['action']=='materialsubtypemaster'){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'materialSubType',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Material Type</label>
                    <select id="materialTypeId" name="materialTypeId" class="form-control validate" displayname="">
                        <option value="">Select</option>
                        <?php

	$select='';

	$where='';

	$rs='';

	$select='*';

	$where=' deletestatus=0 and status=1 order by name asc';

	$rs=GetPageRecord($select,'	materialTypeMaster',$where);

	while($resListing=mysqli_fetch_array($rs)){

	?>
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id']==$editresult['materialTypeId']){ ?>selected="selected"
                            <?php } ?>><?php echo strip($resListing['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Sub Type Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo htmlspecialchars(stripslashes($editresult['name'])); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Description</label>
                    <input name="description" type="text" class="form-control validate" id="description"
                        value="<?php echo htmlspecialchars(stripslashes($editresult['description'])); ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control validate">
                        <option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active
                        </option>
                        <option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>
                            Inactive</option>
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
<?php if($_REQUEST['action']=='tnatemplatesmaster'){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'tnaTemplatesMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Description</label>
                    <input name="description" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['description']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control validate">
                        <option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active
                        </option>
                        <option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>
                            Inactive</option>
                    </select>
                </div>
            </div>
            <style>
            .select2-container {

                width: 100% !important;

            }
            </style>
            <?php if($_GET['id']==''){ ?>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Clone Profile</label>
                    <select class="select2 form-control" name="cloneProfile" id="cloneProfile">
                        <option value="">Select</option>
                        <?php

		$rs1=GetPageRecord('id,name','tnaTemplatesMaster','1 order by id asc');

		while($resListinga=mysqli_fetch_array($rs1)){

		?>
                        <option value="<?php echo strip($resListinga['id']); ?>">
                            <?php echo strip($resListinga['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php } ?>
<?php if($_REQUEST['action']=='selecttnaTemplate'){ ?>
<style>
.select2-container {

    width: 100% !important;

}
</style>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>TNA Template</label>
                    <select class="select2 form-control" name="tnaTemplateId" id="tnaTemplateId">
                        <option value="">Select</option>
                        <?php

		$rs1=GetPageRecord('id,name','tnaTemplatesMaster','1 order by id desc');

		while($resListinga=mysqli_fetch_array($rs1)){

		?>
                        <option value="<?php echo strip($resListinga['id']); ?>"
                            <?php if($resListinga['id']==$editresult['tnatemplate']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListinga['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['styleid']; ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php } ?>
<?php if($_REQUEST['action']=='finishmaster'){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'finishMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Description</label>
                    <input name="description" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['description']; ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php } ?>
<?php if($_REQUEST['action']=='pullermaster'){

if($_REQUEST['id']!=''){

$id=clean(decode($_REQUEST['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'pullerMaster',$where1);

$editresult=mysqli_fetch_array($rs1);



}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Image</label>
                    <input name="materialimage" type="file" id="materialimage" class="form-control">
                </div>
            </div>
            <input type="hidden" name="materialimageedit" id="materialimageedit"
                value="<?php echo $editresult['attachment']; ?>" />
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control validate">
                        <option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active
                        </option>
                        <option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>
                            Inactive</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="description"
                        class="form-control"><?php echo $editresult['description']; ?></textarea>
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
<?php if($_REQUEST['action']=='slidermaster'){

if($_REQUEST['id']!=''){

$id=clean(decode($_REQUEST['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'sliderMaster',$where1);

$editresult=mysqli_fetch_array($rs1);



}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Image</label>
                    <input name="materialimage" type="file" id="materialimage" class="form-control">
                </div>
            </div>
            <input type="hidden" name="materialimageedit" id="materialimageedit"
                value="<?php echo $editresult['attachment']; ?>" />
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control validate">
                        <option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active
                        </option>
                        <option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>
                            Inactive</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="description"
                        class="form-control"><?php echo $editresult['description']; ?></textarea>
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
<?php if($_REQUEST['action']=='tnaactivitymaster'){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'tnaActivityMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Description</label>
                    <input name="description" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['description']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control validate">
                        <option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active
                        </option>
                        <option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>
                            Inactive</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php } ?>
<?php if($_REQUEST['action']=='poManage'){
?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Type</label>
                    <select name="potype" id="potype" class="form-control validate" required="required"
                        onchange="showpo(this.value);">
                        <option>Select</option>
                        <option value="1">PO</option>
                        <option value="2">DCPO</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><span class="changedcpo">PO</span> Number</label>
                    <input name="ponumber" type="text" class="form-control validate" id="ponumber" required="required">
                </div>
            </div>
            <div class="col-md-6 hidepo" style="display: none;">
                <div class="form-group">
                    <label>PO Number</label>
                    <select id="dcponumber" name="dcponumber" class="form-control">
                        <option value="">Select</option>
                        <?php
$rs=GetPageRecord('id,poNumber','poManageMaster','1');
while($resListing=mysqli_fetch_array($rs)){
?>
                        <option value="<?php echo strip($resListing['id']); ?>"><?php echo $resListing['poNumber']; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><span class="changedcpo">PO</span> Quantity</label>
                    <input name="poqty" type="text" class="form-control validate" id="poqty" required="required">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Ex-Factory Start</label>
                    <input name="factstart" type="date" class="form-control validate" id="factstart"
                        required="required">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Ex-Factory End</label>
                    <input name="factend" type="date" class="form-control validate" id="factend" required="required">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Attach File</label>
                    <div class="uniform-uploader">
                        <input type="file" name="poattach" id="poattach" class="form-input-styled" data-fouc=""
                            required="required">
                        <span class="filename" style="user-select: none;">No file selected</span> <span
                            class="action btn btn-secondary" style="user-select: none;"><i style="margin-top: 3px"
                                class="fa fa-upload"></i></span>
                        <script>
                        $('#poattach').on('change', function() {

                            //get the file name

                            var fileName = $(this).val();

                            //replace the "Choose a file" label

                            $(this).next('.filename').html(fileName);

                        })

                        function showpo(id) {
                            if (id == '2') {
                                $('.changedcpo').text('DCPO');
                                $('.hidepo').show();
                            } else {
                                $('.changedcpo').text('PO');
                                $('.hidepo').hide();
                            }

                        }
                        </script>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Ship&nbsp;Mode</label>
                    <input name="shipmode" type="text" class="form-control validate" id="shipmode" required="required">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Delivery&nbsp;Term</label>
                    <input name="dterm" type="text" class="form-control validate" id="dterm" required="required">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Cutoff&nbsp;Date</label>
                    <input name="cdate" type="date" class="form-control validate" id="cdate" required="required">
                </div>
            </div>
            <div class="col-md-6" style="display: none;">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control validate">
                        <option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active
                        </option>
                        <option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>
                            Inactive</option>
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
    <input name="styleid" type="hidden" id="styleid" value="<?php echo $_REQUEST['styleId']; ?>" />
</form>
<?php }

?>
<?php if($_REQUEST['action']=='poManageedit'){

		$count=1;
		$rrrr=GetPageRecord('*','poManageMaster','1 and id="'.decode($_REQUEST['poid']).'"');
		$operationData=mysqli_fetch_array($rrrr);

		?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>PO Number</label>
                    <input name="ponumber" type="text" class="form-control validate" id="ponumber"
                        value="<?php echo $operationData['poNumber']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>PO Quantity</label>
                    <input name="poqty" type="text" class="form-control validate" id="poqty"
                        value="<?php echo $operationData['poQty']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Ex-Factory Start</label>
                    <input name="factstart" type="date" class="form-control validate" id="factstart"
                        value="<?php echo $operationData['factStart']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Ex-Factory End</label>
                    <input name="factend" type="date" class="form-control validate" id="factend"
                        value="<?php echo $operationData['factEnd']; ?>" required="required">
                </div>
            </div>
            <div class="col-md-6" style="">
                <div class="form-group">
                    <label>Attach File</label>
                    <div class="uniform-uploader">
                        <input type="file" name="poattach" id="poattach" class="form-input-styled" data-fouc=""
                            value="<?php echo $operationData['attachFile']; ?>">
                        <input type="hidden" name="poattachhidden" id="poattachhidden"
                            value="<?php echo $operationData['attachFile']; ?>">
                        <span class="filename" style="user-select: none;">No file selected</span> <span
                            class="action btn btn-secondary" style="user-select: none;"><i style="margin-top: 3px"
                                class="fa fa-upload"></i></span>
                        <script>
                        $('#poattach').on('change', function() {

                            //get the file name

                            var fileName = $(this).val();

                            //replace the "Choose a file" label

                            $(this).next('.filename').html(fileName);

                        })
                        </script>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Ship&nbsp;Mode</label>
                    <input name="shipmode" type="text" class="form-control validate" id="shipmode"
                        value="<?php echo $operationData['shipMode']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Delivery&nbsp;Term</label>
                    <input name="dterm" type="text" class="form-control validate" id="dterm"
                        value="<?php echo $operationData['deliveryTerm']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Cutoff&nbsp;Date</label>
                    <input name="cdate" type="date" class="form-control validate" id="cdate"
                        value="<?php echo $operationData['cutoffDate']; ?>">
                </div>
            </div>
            <div class="col-md-6" style="display: none;">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control validate">
                        <option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active
                        </option>
                        <option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>
                            Inactive</option>
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
    <input name="editid" type="hidden" id="editid" value="<?php echo encode($operationData['id']); ?>" />
    <input name="styleId" type="hidden" id="editid" value="<?php echo encode($operationData['styleId']); ?>" />
</form>
<?php }
?>
<?php if($_REQUEST['action']=='dcpoManageedit'){

    $count=1;
    $rrrr=GetPageRecord('*','dcpoManageMaster','1 and id="'.decode($_REQUEST['dcpoid']).'"');
    $operationData=mysqli_fetch_array($rrrr);

    ?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>PO Number</label>
                    <select id="dcponumber" name="dcponumber" class="form-control">
                        <option value="">Select</option>
                        <?php
$rs=GetPageRecord('id,poNumber','poManageMaster','1');
while($resListing=mysqli_fetch_array($rs)){
?>
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id'] == $operationData['poNumber']){ echo 'selected'; } ?>>
                            <?php echo $resListing['poNumber']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>DCPO Number</label>
                    <input name="ponumber" type="text" class="form-control validate" id="ponumber"
                        value="<?php echo $operationData['dcpoNumber']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>DCPO Quantity</label>
                    <input name="poqty" type="text" class="form-control validate" id="poqty"
                        value="<?php echo $operationData['dcpoQty']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Ex-Factory Start</label>
                    <input name="factstart" type="date" class="form-control validate" id="factstart"
                        value="<?php echo $operationData['factStart']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Ex-Factory End</label>
                    <input name="factend" type="date" class="form-control validate" id="factend"
                        value="<?php echo $operationData['factEnd']; ?>" required="required">
                </div>
            </div>
            <div class="col-md-6" style="">
                <div class="form-group">
                    <label>Attach File</label>
                    <div class="uniform-uploader">
                        <input type="file" name="poattach" id="poattach" class="form-input-styled" data-fouc=""
                            value="<?php echo $operationData['attachFile']; ?>">
                        <input type="hidden" name="poattachhidden" id="poattachhidden"
                            value="<?php echo $operationData['attachFile']; ?>">
                        <span class="filename" style="user-select: none;">No file selected</span> <span
                            class="action btn btn-secondary" style="user-select: none;"><i style="margin-top: 3px"
                                class="fa fa-upload"></i></span>
                        <script>
                        $('#poattach').on('change', function() {

                            //get the file name

                            var fileName = $(this).val();

                            //replace the "Choose a file" label

                            $(this).next('.filename').html(fileName);

                        })
                        </script>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Ship&nbsp;Mode</label>
                    <input name="shipmode" type="text" class="form-control validate" id="shipmode"
                        value="<?php echo $operationData['shipMode']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Delivery&nbsp;Term</label>
                    <input name="dterm" type="text" class="form-control validate" id="dterm"
                        value="<?php echo $operationData['deliveryTerm']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Cutoff&nbsp;Date</label>
                    <input name="cdate" type="date" class="form-control validate" id="cdate"
                        value="<?php echo $operationData['cutoffDate']; ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info">Save</button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editid" type="hidden" id="editid" value="<?php echo encode($operationData['id']); ?>" />
    <input name="styleId" type="hidden" id="styleId" value="<?php echo encode($operationData['styleId']); ?>" />
</form>
<?php }
?>
<?php if($_REQUEST['action']=='convsizeratiomaster'){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'convSizeRatioMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Destination</label>
                    <input name="destination" type="text" class="form-control validate" id="destination"
                        value="<?php echo $editresult['destination']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Buyer</label>
                    <select id="buyerId" name="buyerId" class="form-control" displayname="Buyer"
                        onchange="changeBuyer(this.value);">
                        <option value="">Select</option>
                        <?php

$select='';

$where='';

$rs='';

$select='*';

$where=' deletestatus=0 and status=1 order by name asc';

$rs=GetPageRecord($select,_BUYER_MASTER_,$where);

while($resListing=mysqli_fetch_array($rs)){

?>
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id']==$editresult['buyerId']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListing['name']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Brand</label>
                    <select id="brandId" name="brandId" class="form-control" displayname="Brand">
                        <option value="">Select</option>
                    </select>
                </div>
            </div>
            <style>
            .select2-search__field {

                display: none;

            }
            </style>
            <script>
            function changeBuyer(buyerId) {

                $('#brandId').load('loadbrand.php?buyerId=' + buyerId +
                    '&selectId=<?php echo $editresult['brandId']; ?>&action=changebrandaction');

            }

            <?php

if($_GET['id']!=''){

?>

            changeBuyer(<?php echo $editresult['buyerId']; ?>);

            <?php } ?>
            </script>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Sub-Category</label>
                    <select id="subCategoryId" name="subCategoryId" class="form-control" displayname="subCategory">
                        <option value="">Select</option>
                        <?php

$select='';

$where='';

$rs='';

$select='*';

$where=' deletestatus=0 and status=1 order by id asc';

$rs=GetPageRecord($select,subCategoryMaster,$where);

while($category=mysqli_fetch_array($rs)){

?>
                        <option value="<?php echo strip($category['id']); ?>"
                            <?php if($category['id']==$editresult['subCategoryId']){ ?>selected="selected" <?php } ?>>
                            <?php echo $category['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Size Range</label>
                    <select name="sizeRangeId" id="sizeRangeId" class="form-control validate">
                        <option value="">Select</option>
                        <?php

	$select='';

	$where='';

	$rs='';

	$select='*';

	$where=' deletestatus=0 and status=1 order by name asc';

	$rs=GetPageRecord($select,'sizerangeMaster',$where);

	while($resListing=mysqli_fetch_array($rs)){

	?>
                        <option value="<?php echo strip($resListing['id']); ?>"
                            <?php if($resListing['id']==$editresult['sizeRangeId']){ ?>selected="selected" <?php } ?>>
                            <?php echo strip($resListing['size']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Size Ratio</label>
                    <input name="sizeratio" type="text" class="form-control validate" id="sizeratio"
                        value="<?php echo $editresult['sizeRatio']; ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php }

if($_REQUEST['action']=='capacitymaster'){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='factoryId='.$id.'';

$rs1=GetPageRecord($select1,'factoryLineMaster',$where1);

$factoryline=mysqli_fetch_array($rs1);

$factorylinecount=mysqli_num_rows($rs1);

$where2='factoryId='.$id.'';

$rs2=GetPageRecord('*','capacityMaster',$where2);

$editresult=mysqli_fetch_array($rs2);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <input type="hidden" name="factoryId" value="<?php echo $id; ?>" />
            <div class="col-md-3">
                <div class="form-group">
                    <label>Line</label>
                    <input name="totalLine" type="number" class="form-control validate" id="totalLine"
                        value="<?php echo $factorylinecount; ?>" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Operator</label>
                    <input name="operatorPerLine" type="number" class="form-control validate" id="operatorPerLine"
                        value="<?php echo $factoryline['workers']; ?>" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Hours</label>
                    <input name="avgHrs" type="number" class="form-control validate" id="avgHrs"
                        value="<?php echo $factoryline['hours']; ?>" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Minutes</label>
                    <input name="minuteCapacity" type="number" class="form-control validate" id="minuteCapacity"
                        value="<?php echo $factorylinecount*$factoryline['workers']*$factoryline['hours']*60; ?>"
                        readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Avg. SAM</label>
                    <input name="avgSam" type="number" class="form-control validate" id="avgSam"
                        value="<?php echo $editresult['avgSam']; ?>" onkeyup="calculateVlaue();">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Avg. Eff.(%)</label>
                    <input name="avgEfficiency" type="number" class="form-control validate" id="avgEfficiency"
                        value="<?php echo $editresult['avgEfficiency']; ?>" onkeyup="calculateVlaue();">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Output/Day</label>
                    <input name="outputDay" type="number" class="form-control validate" id="outputDay"
                        value="<?php echo $editresult['outputDay']; ?>" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Output/Month</label>
                    <input name="outputMonth" type="number" class="form-control validate" id="outputMonth"
                        value="<?php echo $editresult['outputMonth']; ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Output/Quarter</label>
                    <input name="outputSeason" type="number" class="form-control validate" id="outputSeason"
                        value="<?php echo $editresult['outputSeason']; ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Season Allocation</label>
                    <input name="seasonAllocation" type="number" class="form-control validate" id="seasonAllocation"
                        value="<?php echo $editresult['seasonAllocation']; ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>No Of Style</label>
                    <input name="numberOfStyle" type="number" class="form-control validate" id="numberOfStyle"
                        value="<?php echo $editresult['numberOfStyle']; ?>" onkeyup="calculateVlaue();">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Avg. Qty</label>
                    <input name="avgQty" type="text" class="form-control validate" id="avgQty"
                        value="<?php echo $editresult['avgQty']; ?>" readonly>
                </div>
            </div>
            <script>
            function calculateVlaue() {

                var avgSam = $('#avgSam').val();

                var avgEfficiency = $('#avgEfficiency').val();

                var minuteCapacity = $('#minuteCapacity').val();

                var outputday = Math.round(Number(minuteCapacity * avgEfficiency / avgSam) / 100);

                $('#outputDay').val(outputday);

                var outputnewday = $('#outputDay').val();

                var outputmonth = Number(outputnewday * 26);

                $('#outputMonth').val(outputmonth);

                $('#outputSeason').val(outputmonth * 3);

                $('#seasonAllocation').val(outputmonth * 3);

                var numberOfStyle = $('#numberOfStyle').val();

                $('#avgQty').val(outputmonth / numberOfStyle);

            }

            calculateVlaue();
            </script>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php } ?>
<?php

if($_REQUEST['action']=='factorywisemaster'){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));



$where2='id='.$id.'';

$rs2=GetPageRecord('*','factoryBrandMaster',$where2);

$editresult=mysqli_fetch_array($rs2);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Quarter</label>
                    <select name="quarter" id="quarter" class="form-control">
                        <option value="">Select</option>
                        <?php

$select='';

$where='';

$rs='';

$select='*';

$where='1 order by name asc';

$rs=GetPageRecord($select,'quarterMaster',$where);

while($resListing=mysqli_fetch_array($rs)){

?>
                        <option value="<?php echo $resListing['name']; ?>"
                            <?php if($editresult['quarter']==$resListing['name']){ ?> selected="selected" <?php } ?>>
                            <?php echo $resListing['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Brand</label>
                    <select name="brandId" class="form-control " id="brandId">
                        <option value="">Select</option>
                        <?php

$rs=GetPageRecord('*','brandMaster','1');

while($resListing=mysqli_fetch_array($rs)){ ?>
                        <option value="<?php echo $resListing['id']; ?>"
                            <?php if($editresult['brandId']==$resListing['id']){ ?> selected="selected" <?php } ?>>
                            <?php echo $resListing['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Factory</label>
                    <select name="factoryId" id="factoryId" class="form-control" onchange="changeline(this.value);">
                        <option value="">Select</option>
                        <?php

$select='';

$where='';

$rs='';

$select='*';

$where='1 order by name asc';

$rs=GetPageRecord($select,'factoryMaster',$where);

while($resListing=mysqli_fetch_array($rs)){

?>
                        <option value="<?php echo $resListing['id']; ?>"
                            <?php if($editresult['factoryId']==$resListing['id']){ ?> selected="selected" <?php } ?>>
                            <?php echo $resListing['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group" id="linechange">
                    <label>Line</label>
                    <input name="line" type="number" class="form-control validate"
                        value="<?php echo $editresult['line'] ?>" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Avg. SAM</label>
                    <input name="avgSam" type="text" class="form-control validate" id="avgSam"
                        value="<?php echo $editresult['avgSam']; ?>" onkeyup="calculateVlaue();">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Avg. Eff.(%)</label>
                    <input name="avgEfficiency" type="text" class="form-control validate" id="avgEfficiency"
                        value="<?php echo $editresult['avgEfficiency']; ?>" onkeyup="calculateVlaue();">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Shift Hours</label>
                    <input name="shifthours" type="text" class="form-control validate" id="shifthours"
                        value="<?php echo $editresult['shiftHours']; ?>" onkeyup="calculateVlaue();">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Operator</label>
                    <input name="operator" type="text" class="form-control validate" id="operator"
                        value="<?php echo $editresult['operator']; ?>" onkeyup="calculateVlaue();">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Output/Line</label>
                    <input name="outputline" type="text" class="form-control validate" id="outputline"
                        value="<?php echo $editresult['outputLine']; ?>" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Output/Day</label>
                    <input name="outputDay" type="number" class="form-control validate" id="outputDay"
                        value="<?php echo $editresult['outputDay']; ?>" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Output/Month</label>
                    <input name="outputMonth" type="number" class="form-control validate" id="outputMonth"
                        value="<?php echo $editresult['outputMonth']; ?>" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Output/Quarter</label>
                    <input name="outputquarter" type="number" class="form-control validate" id="outputquarter"
                        value="<?php echo $editresult['outputQuarter']; ?>" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Season Allocation</label>
                    <input name="seasonAllocation" type="number" class="form-control validate" id="seasonAllocation"
                        value="<?php echo $editresult['seasonAllocate']; ?>" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>No Of Style</label>
                    <input name="numberOfStyle" type="number" class="form-control validate" id="numberOfStyle"
                        value="<?php echo $editresult['styleNo']; ?>" onkeyup="calculateVlaue();">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Avg. Qty</label>
                    <input name="avgQty" type="text" class="form-control validate" id="avgQty"
                        value="<?php echo $editresult['avgQty']; ?>" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Year</label>
                    <input name="dateAdded" type="text" class="form-control validate" id="dateAdded"
                        value="<?php if($editresult['dateAdded']=='0000-00-00' || $editresult['dateAdded']=='1970-01-01'){ echo date('d-M-Y'); }elseif($editresult['dateAdded']!=''){ echo date('d-M-Y',strtotime($editresult['dateAdded'])); }?>"
                        readonly>
                </div>
            </div>
            <script>
            $("#dateAdded").datepicker({
                format: "YYYY",
                viewMode: "years",
                minViewMode: "years"
            });


            function changeline(factory) {

                $('#linechange').load('loadbrand.php?action=changeline&factory=' + factory);

            }

            function calculateVlaue() {

                var avgSam = $('#avgSam').val();

                var avgEfficiency = $('#avgEfficiency').val();

                var shifthours = $('#shifthours').val();

                var operator = $('#operator').val();

                var outputlines = Number((avgEfficiency / 100) * operator * shifthours * 60 / avgSam);

                $('#outputline').val(outputlines);

                var y = $('#outputline').val();

                var line = "<?php echo $editresult['line'] ?>";

                var outputdays = Number(y * line);

                $('#outputDay').val(outputdays);

                var z = $('#outputDay').val();

                var outputmonth = Number(z * 26);

                $('#outputMonth').val(outputmonth);

                $('#outputquarter').val(outputmonth * 3);

                var quarter = Math.round(outputmonth * 3);

                $('#seasonAllocation').val(quarter);

                var numberOfStyle = $('#numberOfStyle').val();

                $('#avgQty').val((quarter / numberOfStyle).toFixed(3));

            }
            </script>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php } ?>
<?php

if($_REQUEST['action']=='viewfactorywiseallocation'){

$finalTotal=0;

$brandId=clean(decode($_GET['brandId']));

$quarterId=clean($_GET['quarterId']);

$where2='brandId="'.$brandId.'" and quarter="'.$quarterId.'" order by id';

$rs2=GetPageRecord('*','factoryBrandMaster',$where2);

?>
<table class="table table-bordered capacity-class" style="width:100%;margin: 20px 0px;">
    <tr style="background-color: #fff7b3;">
        <th>
            <div align="left">Quarter</div>
        </th>
        <th>
            <div align="left">Factory</div>
        </th>
        <th>
            <div align="left">Output/Quarter</div>
        </th>
    </tr>
    <?php

while($editresult=mysqli_fetch_array($rs2)){

$aa=GetPageRecord('name','factoryMaster','1 and id="'.$editresult['factoryId'].'"');

$facName=mysqli_fetch_array($aa);

?>
    <tr>
        <td>
            <div align="left"><?php echo $quarterId; ?></div>
        </td>
        <td>
            <div align="left"><?php echo $facName['name']; ?></div>
        </td>
        <td>
            <div align="left">
                <?php echo round($editresult['outputQuarter'],2);$finalTotal=$finalTotal+round($editresult['outputQuarter'],2); ?>
            </div>
        </td>
    </tr>
    <?php } ?>
    <tr>
        <td colspan="2" style="text-align:center;">
            <div align="center"><strong>TOTAL</strong></div>
        </td>
        <td>
            <div align="left"><strong><?php echo $finalTotal; ?></strong></div>
        </td>
    </tr>
</table>
<?php } ?>
<?php if($_REQUEST['action']=='approveindent'){

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Do you want to approve the Indent.</label>
                    <input name="assignToMaterial[]" id="assignToMaterial" type="hidden" value="0" />
                </div>
            </div>
            <script>
            var assignToMaterial = '';



            $('input:checkbox.deletematerial').each(function() {

                var sThisVal = (this.checked ? $(this).val() : "");

                if (sThisVal != '') {

                    assignToMaterial = assignToMaterial + sThisVal + ',';

                }

            });

            $('#assignToMaterial').val(assignToMaterial);
            </script>
        </div>
    </div>
    <input name="styleId" type="hidden" id="styleId" value="<?php echo $_REQUEST['styleId'] ?>" />
    <input name="action" type="hidden" id="action" value="approveindent" />
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">No</button>
        <button type="submit" class="btn bg-info">Yes</button>
    </div>
</form>
<?php } ?>
<?php if($_REQUEST['action']=='addPoBreakup'){
if($_GET['editId']!=''){
$id=$_GET['editId'];
$where2='id='.$id.'';
$rs2=GetPageRecord('*','poSizeBreakupMaster',$where2);
$editresult=mysqli_fetch_array($rs2);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Destination</label>
                    <input name="destination" type="text" class="form-control" id="destination"
                        value="<?php echo $editresult['destination'];  ?>" required="required">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Color</label>
                    <input name="color" type="text" class="form-control" id="color"
                        value="<?php echo $editresult['color'];  ?>" required="required">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Packing Type</label>
                    <select name="ptype" class="form-control" id="ptype" value="<?php echo $editresult['ptype'];  ?>"
                        required="required">
                        <option value="">Select</option>
                        <option value="1">Pre-Pack</option>
                        <option value="2">Bulk</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Size</label>
                    <input name="size" type="text" class="form-control" id="size"
                        value="<?php echo $editresult['size'];  ?>" required="required">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Qty.</label>
                    <input name="quantity" type="number" class="form-control" id="quantity"
                        value="<?php echo $editresult['quantity'];  ?>" required="required">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
            <button type="submit" class="btn bg-info">Save</button>
        </div>
        <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
        <input name="editId" type="hidden" id="editId" value="<?php echo $editresult['id']; ?>" />
        <input name="styleId" type="hidden" id="styleid" value="<?php echo $_REQUEST['styleId']; ?>" />
        <input name="parentId" type="hidden" id="parentId" value="<?php echo $_REQUEST['id']; ?>" />
</form>
<?php }
?>
<?php if($_REQUEST['action']=='addDcpoBreakup'){
if($_GET['editId']!=''){
$id=$_GET['editId'];
$where2='id='.$id.'';
$rs2=GetPageRecord('*','dcpoSizeBreakupMaster',$where2);
$editresult=mysqli_fetch_array($rs2);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Destination</label>
                    <input name="destination" type="text" class="form-control" id="destination"
                        value="<?php echo $editresult['destination'];  ?>" required="required">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Color</label>
                    <input name="color" type="text" class="form-control" id="color"
                        value="<?php echo $editresult['color'];  ?>" required="required">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Packing Type</label>
                    <select name="ptype" class="form-control" id="ptype" required="required">
                        <option value="">Select</option>
                        <option value="1" <?php if($editresult['ptype'] == '1'){ echo 'selected';} ?>>Pre-Pack</option>
                        <option value="2" <?php if($editresult['ptype'] == '2'){ echo 'selected';} ?>>Bulk</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Size</label>
                    <input name="size" type="text" class="form-control" id="size"
                        value="<?php echo $editresult['size'];  ?>" required="required">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Qty.</label>
                    <input name="quantity" type="number" class="form-control" id="quantity"
                        value="<?php echo $editresult['quantity'];  ?>" required="required">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
            <button type="submit" class="btn bg-info">Save</button>
        </div>
        <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
        <input name="editId" type="hidden" id="editId" value="<?php echo $editresult['id']; ?>" />
        <input name="styleId" type="hidden" id="styleid" value="<?php echo $_REQUEST['styleId']; ?>" />
        <input name="parentId" type="hidden" id="parentId" value="<?php echo $_REQUEST['id']; ?>" />
</form>
<?php }

?>
<?php if($_REQUEST['action']=='uploadatechpackpattern'){ ?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Attach File</label>
                    <div class="uniform-uploader">
                        <input type="file" name="poattach" id="poattach" class="form-input-styled" data-fouc=""
                            required="required">
                        <span class="filename" style="user-select: none;">No file selected</span> <span
                            class="action btn btn-secondary" style="user-select: none;"><i style="margin-top: 3px"
                                class="fa fa-upload"></i></span>
                        <script>
                        $('#poattach').on('change', function() {

                            //get the file name

                            var fileName = $(this).val();

                            //replace the "Choose a file" label

                            $(this).next('.filename').html(fileName);

                        })
                        $(function() {
                            $("#uploadDate").datepicker({
                                minDate: 0
                            });
                        });
                        </script>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Date</label>
                    <input name="uploadDate" type="text" class="form-control validate readonly" id="uploadDate"
                        value="<?php if($uploadDate!=''){ echo ''; }else{ echo date('d-M-Y'); }?>" required="required">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Stage</label>
                    <select name="stage" id="stage" class="form-control validate" required="required">
                        <option>Select</option>
                        <?php if($_REQUEST['module']=='techpack'){ ?>
                        <option value="Proto">Proto</option>
                        <option value="Fit Sample 1">Fit Sample 1</option>
                        <option value="Fit Sample 2">Fit Sample 2</option>
                        <option value="Fit Sample 3">Fit Sample 3</option>
                        <option value="PP Sample">PP Sample</option>
                        <option value="For Production">For Production</option>
                        <option value="Reference Fit Sample">Reference Fit Sample</option>
                        <option value="CLO">CLO</option>
                        <option value="Rough Body">Rough Body</option>
                        <option value="SMS">SMS</option>
                        <?php }
			elseif($_REQUEST['module']=='pattern'){ ?>
                        <option value="Pattern 1">Pattern 1</option>
                        <option value="Pattern 2">Pattern 2</option>
                        <option value="Pattern 3">Pattern 3</option>
                        <option value="Final">Final</option>
                        <?php }
			elseif($_REQUEST['module']=='marker'){ ?>
                        <option value="Marker 1">Marker 1</option>
                        <option value="Marker 2">Marker 2</option>
                        <option value="Marker 3">Marker 3</option>
                        <option value="Final">Final</option>
                        <?php }else{ } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Remark</label>
                    <input name="remark" type="text" class="form-control validate" id="remark" value=""
                        required="required">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info">Save</button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="styleId" type="hidden" id="styleId" value="<?php echo $_REQUEST['styleId']; ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['module']; ?>" />
</form>
<?php }


if($_REQUEST['action']=='greighindentSendpo'){

$requisitionNo = $_REQUEST['requisitionNo'];
$materialId = $_REQUEST['materialId'];
$construction = $_REQUEST['construction'];
$greWidth = $_REQUEST['greWidth'];
$qty = $_REQUEST['qty'];
$uom = $_REQUEST['uom'];
$processLoss = $_REQUEST['processLoss'];
$shrinkage = $_REQUEST['shrinkage'];
$materialQty = $_REQUEST['materialQty'];


$supplierId = $_REQUEST['supplier'];
$rate = $_REQUEST['price'];
$currency = $_REQUEST['currency'];
$materialMasterId = $_REQUEST['materialMasterId'];


if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'indentCreationMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<div style="padding:10px;">
    <table width="100%" border="1" cellspacing="2" cellpadding="2" style="margin-top:5px;text-align: center;">
        <tr style="background-color: #33a4d0; font-weight: 600; color: #fff;">
            <td>Supplier&nbsp;Name</td>
            <td>Supplier&nbsp;Code</td>
            <td>Order&nbsp;Qty.</td>
            <td>Pending&nbsp;Qty.</td>
            <td>Rate</td>
            <td>Value</td>
            <td>Action</td>
        </tr>
        <?php
	$no=1;
	$pendingQty=0;
	$wh = '1 and requisitionNo="'.$requisitionNo.'" and materialId="'.$materialId.'" and bomWidth="'.$greWidth.'" order by id desc';
	$rsindent=GetPageRecord('*','indentCreationMaster',$wh);
	while($resListingIndent=mysqli_fetch_array($rsindent)){
	?>
        <tr>
            <td><?php echo getSupplierName($resListingIndent['supplierId']); ?></td>
            <td><?php echo getSupplierCode($resListingIndent['supplierId']); ?></td>
            <td><?php echo $resListingIndent['orderQty']; $orderQty =  $orderQty+$resListingIndent['orderQty']; ?></td>
            <td><?php echo $resListingIndent['pendingQty'];  ?></td>
            <td><?php echo $resListingIndent['sellingRate']; ?></td>
            <td><?php echo $resListingIndent['sellingValue']; $sellingValue =  $sellingValue+$resListingIndent['sellingValue']; ?>
            </td>
            <td><?php if($resListingIndent['isCancel']=='no'){ ?><button id="cancelid<?php echo $resListingIndent['id']; ?>" onclick="cancelpo(<?php echo $resListingIndent['id']; ?>);">Cancel</button><?php }else{ ?><button>Canceled</button><?php } ?></td>
        </tr>
        <?php $no++; }
	if($no==1){
	 ?>
        <tr>
            <td colspan="6" align="center"> No Record Found.</td>
        </tr>
        <?php } ?>
        <tr style="background-color: #33a4d0; font-weight: 600; color: #fff;">
            <td>&nbsp;</td>
            <td>Total</td>
            <td><?php echo $orderQty; ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><?php echo $sellingValue; ?></td>
            <td>&nbsp;</td>
        </tr>
    </table>
    <script>
    function cancelpo(cid){
        var connfmsg = confirm('Are you sure you want to cancel?');
        if(connfmsg==true){
            $('#cancelid'+cid).text('Loading...');
            $('#cancelid'+cid).load('newaction.php?action=cancelpo&cid='+cid);
        }

    }
</script>
</div>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label>PO&nbsp;Type</label>
                    <select id="poTypeId" class="form-control" name="poTypeId" required onchange="posubfunc()">
                        <option value="">Select</option>
                        <?php

$select='';

$where='';

$rs='';

$select='*';

$where='1 and subId!="1" order by name asc';

$rs=GetPageRecord($select,'poTypeMaster',$where);

while($rest=mysqli_fetch_array($rs)){

?>
                        <option value="<?php echo $rest['id']; ?>"><?php echo $rest['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2" id="sblockid" style="display:none;">
                <div class="form-group">
                    <label>Sub&nbsp;Type</label>
                    <select id="poSubTypeId" class="form-control" name="poSubTypeId">
                        <option value="">Select</option>
                        <?php

$select='';

$where='';

$rs='';

$select='*';

$where='1 and subId="1" order by name asc';

$rs=GetPageRecord($select,'poTypeMaster',$where);

while($rest=mysqli_fetch_array($rs)){

?>
                        <option value="<?php echo $rest['id']; ?>"><?php echo $rest['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <script>
            function posubfunc() {

                var tyr = $("#poTypeId").val();
                if (tyr == 1) {

                    $("#sblockid").css("display", "block")
                } else {

                    $("#sblockid").css("display", "none")
                }



            }
            </script>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Supplier&nbsp;Name</label>
                    <select id="supplierId" class="form-control " name="supplierId">
                        <option value="">Select</option>
                        <?php

$select='';

$where='';

$rs='';

$select='*';

$where='1 and deletestatus=0 order by name asc';

$rs=GetPageRecord($select,'suppliersMaster',$where);

while($rest=mysqli_fetch_array($rs)){

?>
                        <option value="<?php echo $rest['id']; ?>"
                            <?php if($supplierId==$rest['id']){ echo 'selected'; } ?>>
                            <?php echo $rest['name'].' - '.$rest['supplierId']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Item Name</label>
                    <input name="itemName" type="text" class="form-control"
                        value="<?php echo getMaterialName($materialMasterId); ?>" readonly="readonly">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Qty.</label>
                    <input name="materialQty" type="text" class="form-control" id="materialQty"
                        value="<?php echo $materialQty; ?>" readonly="readonly">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Order&nbsp;Qty.</label>
                    <input name="orderQty" type="text" class="form-control" id="orderQty" value="" onblur="qtyCount();">
                    <p style=" color:red; display:none;" id="qtycheck">Order qty. cant be greater then marerial qty.</p>
                </div>
            </div>
            <script>
            function qtyCount(orderQty) {

                var materialQty = Number($('#materialQty').val());

                var orderQty = Number($('#orderQty').val());



                //  if(orderQty<=materialQty){

                $('#qtycheck').hide();

                var pendingQty = Number(materialQty - orderQty);

                pendingQty = parseFloat(pendingQty).toFixed(2);

                var sellingRate = $('#sellingRate').val();

                var sellingValue = Number(orderQty * sellingRate);

                sellingValue = parseFloat(sellingValue).toFixed(2);

                $('#sellingValue').val(sellingValue);

                $('#pendingQty').val(pendingQty);

                //  }else{

                //  	$('#qtycheck').show();

                // 	$('#sellingValue').val(0);

                //  	$('#pendingQty').val(0);

                //  }



            }
            </script>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Rate</label>
                    <input name="sellingRate" type="text" class="form-control" id="sellingRate"
                        value="<?php echo $rate; ?>" onkeyup="qtyCount();" readonly>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Value</label>
                    <input name="sellingValue" type="text" class="form-control" id="sellingValue" value=""
                        readonly="readonly">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Pending&nbsp;Qty.</label>
                    <input name="pendingQty" type="text" class="form-control" id="pendingQty" value=""
                        onkeyup="qtyCount();" readonly="readonly">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info">Save</button>
    </div>
    <input name="action" type="hidden" id="action" value="greighindentSendpo" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="pageeditid" type="hidden" id="pageeditid" value="<?php echo $_GET['pageeditid']; ?>" />
    <input name="module" type="hidden" value="greigeindent" />
    <input name="requisitionNo" type="hidden" value="<?php echo $requisitionNo; ?>" />
    <input name="materialId" type="hidden" value="<?php echo $materialId; ?>" />
    <input name="uom" type="hidden" value="<?php echo $uom; ?>" />
    <input name="bomWidth" type="hidden" value="<?php echo $greWidth; ?>" />
    <input name="materialQty" type="hidden" value="<?php echo $materialQty; ?>" />
    <input name="styleId" type="hidden" value="<?php echo $_REQUEST['styleId']; ?>" />
    <input name="materialMasterId" type="hidden" value="<?php echo $materialMasterId; ?>" />
</form>
<?php }

?>
<?php if($_REQUEST['action']=='addflow'){

    if($_GET['editid']!=''){
$id=$_GET['editid'];
$where2='id='.$id.'';
$rs2=GetPageRecord('*','subTnaFlowMaster',$where2);
$editresult=mysqli_fetch_array($rs2);

}


// if($_GET['id']!=''){

// $id=clean(decode($_GET['id']));

// $select1='*';

// $where1='id='.$id.'';

// $rs1=GetPageRecord($select1,'chargesMaster',$where1);

// $editresult=mysqli_fetch_array($rs1);

// }

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Planned Quantity</label>
                    <input name="flowquantity" type="text" class="form-control validate" id="flowquantity"
                        value="<?php echo $editresult['flowquantity'];  ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Planned Date</label>
                    <input name="planneddate" type="date" class="form-control validate" id="planneddate"
                        value="<?php echo $editresult['planneddate'];  ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Actual Quantity</label>
                    <input name="actualquantity" type="text" class="form-control validate" id="actualquantity"
                        value="<?php echo $editresult['actualquantity'];  ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Actual Date</label>
                    <input name="actualdate" type="date" class="form-control validate" id="actualdate"
                        value="<?php echo $editresult['actualdate'];  ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info">Save</button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="colorid" type="hidden" id="colorid" value="<?php echo $_REQUEST['colorid']; ?>" />
    <input name="styleid" type="hidden" id="styleid" value="<?php echo $_REQUEST['styleId']; ?>" />
    <input name="fabricid" type="hidden" id="fabricid" value="<?php echo $_REQUEST['fabricid']; ?>" />
    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['editid']; ?>" />
    <input name="module" type="hidden" id="module"
        value="subtna&add=yes&styleid=<?php echo encode($_REQUEST['styleId']); ?>" />
</form>
<?php }

?>
<?php if($_REQUEST['action']=='maintenancegeneral'){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'maintenancegeneral_Master',$where1);

$editresult=mysqli_fetch_array($rs1);

$hardate=date("d-m-Y", strtotime($editresult['hardate']));

}
 $rs1d=GetPageRecord('MAX(id) as gtt','maintenancegeneral_Master','1');

$editresultd=mysqli_fetch_array($rs1d);

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Material Name</label>
                    <input name="material" type="text" class="form-control validate" id="harcode"
                        value="<?php echo $editresult['material']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Color</label>
                    <input name="color" type="text" class="form-control validate" id="hardescription"
                        value="<?php echo $editresult['color']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Description</label>
                    <input name="description" type="text" class="form-control validate" id="condescription"
                        value="<?php echo $editresult['destination']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control validate">
                        <option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active
                        </option>
                        <option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>
                            Inactive</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="unikid" type="hidden" id="unikid" value="<?php  echo $editresultd['gtt']; ?>" />
    < </form>
        <?php } ?>
        <?php
if($_REQUEST['action']=='requisitionindentSendpo'){

$requisitionNo = $_REQUEST['requisitionNo'];
$requestedquantity= $_REQUEST['requestedquantity'];
$rate = $_REQUEST['price'];
$requisitionno = $_REQUEST['requisitionno'];
$mainid = $_REQUEST['mainid'];
$supplierId = $_REQUEST['supplier'];


if($_GET['mainid']!=''){

$id=clean($_GET['mainid']);

$select1='*';

$where1='mainid='.$id.'';

$rs1=GetPageRecord($select1,'requisitionIndentMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}


?>
        <div style="padding:10px;">
            <table width="100%" border="1" cellspacing="2" cellpadding="2" style="margin-top:5px;text-align: center;">
                <tr style="background-color: #33a4d0; font-weight: 600; color: #fff;">
                    <td>Supplier&nbsp;Name</td>
                    <td>Supplier&nbsp;Code</td>
                    <td>Order&nbsp;Qty.</td>
                    <td>Pending&nbsp;Qty.</td>
                    <td>Rate</td>
                    <td>Value</td>
                </tr>
                <?php
	$no=1;
	$pendingQty=0;
	$wh = '1 and mainid="'.$_GET['mainid'].'" order by id desc';
	$rsindent=GetPageRecord('*','requisitionIndentMaster',$wh);
	while($resListingIndent=mysqli_fetch_array($rsindent)){


	    $wherenewxcz='id="'.$resListingIndent['supplierId'].'"';
						    	$rsnewxcz=GetPageRecord('*','suppliersMaster',$wherenewxcz);
						$rslistnewxcz=mysqli_fetch_array($rsnewxcz);

	?>
                <tr>
                    <td><?php echo $rslistnewxcz['name']; ?></td>
                    <td><?php echo getSupplierCode($resListingIndent['supplierId']); ?></td>
                    <td><?php echo $resListingIndent['orderQty']; $orderQty =  $orderQty+$resListingIndent['orderQty']; ?>
                    </td>
                    <td><?php echo $resListingIndent['pendingQty'];  ?></td>
                    <td><?php echo $resListingIndent['sellingRate']; ?></td>
                    <td><?php echo $resListingIndent['sellingValue']; $sellingValue =  $sellingValue+$resListingIndent['sellingValue']; ?>
                    </td>
                </tr>
                <?php $no++; }
	if($no==1){
	 ?>
                <tr>
                    <td colspan="6" align="center"> No Record Found.</td>
                </tr>
                <?php } ?>
                <tr style="background-color: #33a4d0; font-weight: 600; color: #fff;">
                    <td>&nbsp;</td>
                    <td>Total</td>
                    <td><?php echo $orderQty; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><?php echo $sellingValue; ?></td>
                </tr>
            </table>
        </div>
        <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>PO&nbsp;Type</label>
                            <select name="potype" class="form-control ">
                                <option>Select</option>
                                <option value="Jobwork">Jobwork</option>
                                <option value="Procurement">Procurement</option>
                                <option value="Service">Service</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Supplier&nbsp;Name</label>
                            <select id="supplierId" class="form-control readonly" name="supplierId">
                                <option value="">Select</option>
                                <?php

$select='';

$where='';

$rs='';

$select='*';

$where='1 and deletestatus=0 order by name asc';

$rs=GetPageRecord($select,'suppliersMaster',$where);

while($rest=mysqli_fetch_array($rs)){

?>
                                <option value="<?php echo $rest['id']; ?>"
                                    <?php if($supplierId==$rest['id']){ echo 'selected'; } ?>>
                                    <?php echo $rest['name'].' - '.$rest['supplierId']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Qty.</label>
                            <input name="materialQty" type="text" class="form-control" id="materialQty"
                                value="<?php echo $requestedquantity; ?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Order&nbsp;Qty.</label>
                            <input name="orderQty" type="text" class="form-control" id="orderQty" value=""
                                onblur="qtyCount();">
                            <p style=" color:red; display:none;" id="qtycheck">Order qty. cant be greater then marerial
                                qty.</p>
                        </div>
                    </div>
                    <script>
                    function qtyCount(orderQty) {

                        var materialQty = Number($('#materialQty').val());

                        var orderQty = Number($('#orderQty').val());



                        if (orderQty <= materialQty) {

                            $('#qtycheck').hide();

                            var pendingQty = Number(materialQty - orderQty);

                            pendingQty = parseFloat(pendingQty).toFixed(2);

                            var sellingRate = $('#sellingRate').val();

                            var sellingValue = Number(orderQty * sellingRate);

                            sellingValue = parseFloat(sellingValue).toFixed(2);

                            $('#sellingValue').val(sellingValue);

                            $('#pendingQty').val(pendingQty);

                        } else {

                            $('#qtycheck').show();

                            $('#sellingValue').val(0);

                            $('#pendingQty').val(0);

                        }



                    }
                    </script>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Rate</label>
                            <input name="sellingRate" type="text" class="form-control" id="sellingRate"
                                value="<?php echo $rate; ?>" onkeyup="qtyCount();" readonly>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Value</label>
                            <input name="sellingValue" type="text" class="form-control" id="sellingValue" value=""
                                readonly="readonly">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Pending&nbsp;Qty.</label>
                            <input name="pendingQty" type="text" class="form-control" id="pendingQty" value=""
                                onkeyup="qtyCount();" readonly="readonly">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="submit" class="btn bg-info">Save</button>
            </div>
            <input name="action" type="hidden" id="action" value="requisitionindentSendpo" />
            <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
            <input name="pageeditid" type="hidden" id="pageeditid" value="<?php echo $_GET['pageeditid']; ?>" />
            <input name="module" type="hidden" value="requisitionindent" />
            <input name="requisitionno" type="hidden" value="<?php echo $requisitionno; ?>" />
            <input name="mainid" type="hidden" value="<?php echo $mainid; ?>" />
            <!--<input name="uom" type="hidden" value="<?php echo $uom; ?>" />-->
            <!--<input name="bomWidth" type="hidden" value="<?php echo $greWidth; ?>" />-->
            <!--<input name="materialQty" type="hidden" value="<?php echo $materialQty; ?>" />-->
        </form>
        <?php }

?>
        <?php
if($_REQUEST['action']=='releasedpo'){

?>
        <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <!--<div class="form-group">

<label>Assign To</label>

  <select id="assignto"  name="assignto" >

   <?php

$select='';

$where='';

$rs='';

$select='*';

$where='id="'.decode($_REQUEST['supplierId']).'"';

$rs=GetPageRecord($select,'suppliersMaster',$where);

while($rest=mysqli_fetch_array($rs)){

?>

    <option value="<?php echo $rest['id']; ?>"><?php echo $rest['name'];?></option>

    <?php } ?>

</select>





  </div>-->
                        <input name="assignToSupplier[]" id="assignToSupplier" type="hidden" value="0" />
                        <span>Are you sure you want to generate PO for the selcted materials?</span>
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

                    var assignToMaterial = '';



                    $('input:checkbox.deletematerial').each(function() {

                        var sThisVal = (this.checked ? $(this).val() : "");



                        if (sThisVal != '') {

                            assignToMaterial = assignToMaterial + sThisVal + ',';

                        }

                    });

                    $('#assignToSupplier').val(assignToMaterial);
                    </script>
                    <div class="col-md-12" style="display:none;">
                        <div class="form-group">
                            <label>Notes</label>
                            <input name="description" type="text" class="form-control validate" id="description"
                                value="">
                        </div>
                    </div>
                </div>
            </div>
            <input name="action" type="hidden" id="action" value="releasedpo" />
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">No</button>
                <button type="submit" class="btn bg-info">Yes</button>
            </div>
        </form>
        <?php }
?>
        <?php
    if($_REQUEST['action']=='upsc'){

    ?>
        <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" class="hide_form">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="text" id="uploadDate" name="uploadDate"
                                value="<?php if($uploadDate!=''){ echo ''; }else{ echo date('d-M-Y'); }?>"
                                class="form-control validate readonly">
                            <label style="<?php if($_REQUEST['poId']==''){ ?>display:none;<?php } ?>">Stage</label>
                            <select name="stage" id="stage" class="form-control validate" style="<?php if($_REQUEST['poId']==''){ ?>display:none;<?php } ?>">
                                <option value="">Select</option>
                                <option value="Proto">Proto</option>
                                <option value="Fit Sample 1">Fit Sample 1</option>
                                <option value="Fit Sample 2">Fit Sample 2</option>
                                <option value="Fit Sample 3">Fit Sample 3</option>
                                <option value="PP Sample">PP Sample</option>
                                <option value="For Production">For Production</option>
                            </select>
                            <script>
                            $('#poattach').on('change', function() {

                                //get the file name

                                var fileName = $(this).val();

                                //replace the "Choose a file" label

                                $(this).next('.filename').html(fileName);

                            })
                            $(function() {
                                $("#uploadDate").datepicker({
                                    minDate: 0
                                });
                            });
                            </script>
                            <label>Remark</label>
                            <input type="text" id="remark" name="remark" class="form-control">
                            <label>Attach File</label>
                            <div class="uniform-uploader">
                                <input type="file" name="poattach[]" id="poattach" class="form-input-styled"
                                    data-fouc="" multiple required="required">
                                <span class="filename" style="user-select: none;">No file selected</span> <span
                                    class="action btn btn-secondary" style="user-select: none;"><i
                                        style="margin-top: 3px" class="fa fa-upload"></i></span>
                                <input name="action" type="hidden" id="action" value="yt" />
                                <input name="parentId" type="hidden" id="parentId"
                                    value="<?php echo decode($_REQUEST['poId']); ?>" />
                                <input name="styleid" type="hidden" id="styleid"
                                    value="<?php echo decode($_REQUEST['styleid']); ?>" />
                                <input name="datarow" type="hidden" id="datarow"
                                    value="<?php echo $_REQUEST['datarow']; ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">No</button>
                    <button type="submit" class="btn bg-info" id="Mybtn">Save</button>
                </div>
        </form>
        <?php
         }
         ?>
        <?php


if($_REQUEST['action']=='yarnindentSendpo'){

$requisitionNo = $_REQUEST['requisitionNo'];
$materialId = $_REQUEST['materialId'];
$uom = $_REQUEST['uom'];
$shrinkage = $_REQUEST['shrinkage'];
// $materialQty = $_REQUEST['materialQty'];

$materialQty = round($_REQUEST['materialQty'],2);



$supplierId = $_REQUEST['supplier'];
$rate = $_REQUEST['price'];
$currency = $_REQUEST['currency'];
$materialMasterId = $_REQUEST['materialMasterId'];

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'indentCreationMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
        <div style="padding:10px;">
            <table width="100%" border="1" cellspacing="2" cellpadding="2" style="margin-top:5px;text-align: center;">
                <tr style="background-color: #33a4d0; font-weight: 600; color: #fff;">
                    <td>Supplier&nbsp;Name</td>
                    <td>Supplier&nbsp;Code</td>
                    <td>Order&nbsp;Qty.</td>
                    <td>Pending&nbsp;Qty.</td>
                    <td>Rate</td>
                    <td>Value</td>
                    <td>Action</td>
                </tr>
                <?php
	$no=1;
	$pendingQty=0;
	$wh = '1 and requisitionNo="'.$requisitionNo.'" and materialId="'.$materialId.'" order by id desc';
	$rsindent=GetPageRecord('*','indentCreationMaster',$wh);
	while($resListingIndent=mysqli_fetch_array($rsindent)){
	?>
                <tr>
                    <td><?php echo getSupplierName($resListingIndent['supplierId']); ?></td>
                    <td><?php echo getSupplierCode($resListingIndent['supplierId']); ?></td>
                    <td><?php echo $resListingIndent['orderQty']; $orderQty =  $orderQty+$resListingIndent['orderQty']; ?>
                    </td>
                    <td><?php echo $resListingIndent['pendingQty'];  ?></td>
                    <td><?php echo $resListingIndent['sellingRate']; ?></td>
                    <td><?php echo $resListingIndent['sellingValue']; $sellingValue =  $sellingValue+$resListingIndent['sellingValue']; ?>
                    </td>
                    <td><?php if($resListingIndent['isCancel']=='no'){ ?><button id="cancelid<?php echo $resListingIndent['id']; ?>" onclick="cancelpo(<?php echo $resListingIndent['id']; ?>);">Cancel</button><?php }else{ ?><button>Canceled</button><?php } ?></td>
                </tr>
                <?php $no++; }
	if($no==1){
	 ?>
                <tr>
                    <td colspan="6" align="center"> No Record Found.</td>
                </tr>
                <?php } ?>
                <tr style="background-color: #33a4d0; font-weight: 600; color: #fff;">
                    <td>&nbsp;</td>
                    <td>Total</td>
                    <td><?php echo $orderQty; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><?php echo $sellingValue; ?></td>
                    <td>&nbsp;</td>
                </tr>
            </table>
            <script>
    function cancelpo(cid){
        var connfmsg = confirm('Are you sure you want to cancel?');
        if(connfmsg==true){
            $('#cancelid'+cid).text('Loading...');
            $('#cancelid'+cid).load('newaction.php?action=cancelpo&cid='+cid);
        }

    }
</script>
        </div>
        <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>PO&nbsp;Type</label>
                            <select id="poTypeId" class="form-control" name="poTypeId" required onchange="posubfunc()">
                                <option value="">Select</option>
                                <?php

$select='';

$where='';

$rs='';

$select='*';

$where='1 and subId!="1"order by name asc';

$rs=GetPageRecord($select,'poTypeMaster',$where);

while($rest=mysqli_fetch_array($rs)){

?>
                                <option value="<?php echo $rest['id']; ?>"><?php echo $rest['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2" id="sblockid" style="display:none;">
                        <div class="form-group">
                            <label>Sub&nbsp;Type</label>
                            <select id="poSubTypeId" class="form-control" name="poSubTypeId">
                                <option value="">Select</option>
                                <?php

$select='';

$where='';

$rs='';

$select='*';

$where='1 and subId="1" order by name asc';

$rs=GetPageRecord($select,'poTypeMaster',$where);

while($rest=mysqli_fetch_array($rs)){

?>
                                <option value="<?php echo $rest['id']; ?>"><?php echo $rest['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <script>
                    function posubfunc() {

                        var tyr = $("#poTypeId").val();
                        if (tyr == 1) {

                            $("#sblockid").css("display", "block")
                        } else {

                            $("#sblockid").css("display", "none")
                        }



                    }
                    </script>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Supplier&nbsp;Name</label>
                            <select id="supplierId" class="form-control " name="supplierId">
                                <option value="">Select</option>
                                <?php

$select='';

$where='';

$rs='';

$select='*';

$where='1 and deletestatus=0 order by name asc';

$rs=GetPageRecord($select,'suppliersMaster',$where);

while($rest=mysqli_fetch_array($rs)){

?>
                                <option value="<?php echo $rest['id']; ?>"
                                    <?php if($supplierId==$rest['id']){ echo 'selected'; } ?>>
                                    <?php echo $rest['name'].' - '.$rest['supplierId']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Item Name</label>
                            <input name="itemName" type="text" class="form-control"
                                value="<?php echo getMaterialName($materialMasterId); ?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Qty.</label>
                            <input name="materialQty" type="text" class="form-control" id="materialQty"
                                value="<?php echo $materialQty; ?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Order&nbsp;Qty.</label>
                            <input name="orderQty" type="text" class="form-control" id="orderQty" value=""
                                onblur="qtyCount();">
                            <p style=" color:red; display:none;" id="qtycheck">Order qty. cant be greater then marerial
                                qty.</p>
                        </div>
                    </div>
                    <script>
                    function qtyCount(orderQty) {

                        var materialQty = Number($('#materialQty').val());

                        var orderQty = Number($('#orderQty').val());



                        //  if(orderQty<=materialQty){

                        $('#qtycheck').hide();

                        var pendingQty = Number(materialQty - orderQty);

                        pendingQty = parseFloat(pendingQty).toFixed(2);

                        var sellingRate = $('#sellingRate').val();

                        var sellingValue = Number(orderQty * sellingRate);

                        sellingValue = parseFloat(sellingValue).toFixed(2);

                        $('#sellingValue').val(sellingValue);

                        $('#pendingQty').val(pendingQty);

                        //  }else{

                        //  	$('#qtycheck').show();

                        // 	$('#sellingValue').val(0);

                        //  	$('#pendingQty').val(0);

                        //  }



                    }
                    </script>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Rate</label>
                            <input name="sellingRate" type="text" class="form-control" id="sellingRate"
                                value="<?php echo $rate; ?>" onkeyup="qtyCount();" readonly>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Value</label>
                            <input name="sellingValue" type="text" class="form-control" id="sellingValue" value=""
                                readonly="readonly">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Pending&nbsp;Qty.</label>
                            <input name="pendingQty" type="text" class="form-control" id="pendingQty" value=""
                                onkeyup="qtyCount();" readonly="readonly">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="submit" class="btn bg-info">Save</button>
            </div>
            <input name="action" type="hidden" id="action" value="yarnindentSendpo" />
            <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
            <input name="pageeditid" type="hidden" id="pageeditid" value="<?php echo $_GET['pageeditid']; ?>" />
            <input name="module" type="hidden" value="greigeindent" />
            <input name="requisitionNo" type="hidden" value="<?php echo $requisitionNo; ?>" />
            <input name="materialId" type="hidden" value="<?php echo $materialId; ?>" />
            <input name="uom" type="hidden" value="<?php echo $uom; ?>" />
            <input name="styleId" type="hidden" value="<?php echo $_REQUEST['styleId']; ?>" />
            <input name="materialQty" type="hidden" value="<?php echo $materialQty; ?>" />
            <input name="materialMasterId" type="hidden" value="<?php echo $materialMasterId; ?>" />
        </form>
        <?php }

if($_REQUEST['action']=='indentSendtoBomInventory'){

$styleId = $_REQUEST['styleId'];
$materialId = $_REQUEST['materialIdOld'];
$poQty = $_REQUEST['poQty'];
$materialQty = $_REQUEST['materialQty'];
$stockInStore = $_REQUEST['stockInStore'];
$uom = $_REQUEST['uom'];
$count = $_REQUEST['count'];
$gsm = $_REQUEST['gsm'];
$fabricWidth = $_REQUEST['fabricWidth'];
$parentId = $_REQUEST['parentId'];
$requisitionNo = $_REQUEST['requisitionNo'];


if(substr($requisitionNo, 0, 1)=="G"){
    $rs=GetPageRecord('brandId','greigeRequisition','requisitionNo="'.$requisitionNo.'"');
    $editresultstyle=mysqli_fetch_array($rs);
    $brandid = $editresultstyle['brandId'];
}elseif(substr($requisitionNo, 0, 1)=="Y"){
    $rs=GetPageRecord('brandId','yarnRequisition','requisitionNo="'.$requisitionNo.'"');
    $editresultstyle=mysqli_fetch_array($rs);
    $brandid = $editresultstyle['brandId'];
}


if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'indentCreationMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
        <div style="padding:10px;">
            <table width="100%" border="1" cellspacing="2" cellpadding="2" style="margin-top:5px;text-align: center;">
                <tr style="background-color: #33a4d0; font-weight: 600; color: #fff;">
                    <td>Supplier&nbsp;Name</td>
                    <td>Supplier&nbsp;Code</td>
                    <td>Order&nbsp;Qty.</td>
                    <td>Pending&nbsp;Qty.</td>
                    <td>Rate</td>
                    <td>Value</td>
                    <td>Action</td>
                </tr>
                <?php

$pendingQty=0;
//echo 'styleId="'.$styleId.'" and techpackdetailId="'.$techpackdetailId.'" and styleSubCatTableId="'.$styleSubCateId.'" and color="'.$color.'" and size="'.$size.'"';
$rsindent=GetPageRecord('*','indentCreationMaster','styleId="'.$styleId.'" and final_or_died_yarn!=0 and parentId="'.$parentId.'"');

while($resListingIndent=mysqli_fetch_array($rsindent)){



  ?>
                <tr>
                    <td><?php echo getSupplierName($resListingIndent['supplierId']); ?></td>
                    <td><?php echo getSupplierCode($resListingIndent['supplierId']); ?></td>
                    <td><?php echo $resListingIndent['orderQty']; $orderQty =  $orderQty+$resListingIndent['orderQty']; ?>
                    </td>
                    <td><?php echo $resListingIndent['pendingQty'];  ?></td>
                    <td><?php echo $resListingIndent['sellingRate']; ?></td>
                    <td><?php echo $resListingIndent['sellingValue']; $sellingValue =  $sellingValue+$resListingIndent['sellingValue']; ?>
                    </td>
                    <td><span style="color:#0000FF; cursor:pointer;"
                            onclick="getEditDetails('<?php echo $resListingIndent['id']; ?>');">Edit</span>
                        <span><?php if($resListingIndent['isCancel']=='no'){ ?><button id="cancelid<?php echo $resListingIndent['id']; ?>" onclick="cancelpo(<?php echo $resListingIndent['id']; ?>);">Cancel</button><?php }else{ ?><button>Canceled</button><?php } ?></span>
                    </td>
                </tr>
                <?php } ?>
                <tr style="background-color: #33a4d0; font-weight: 600; color: #fff;">
                    <td>&nbsp;</td>
                    <td>Total</td>
                    <td><?php echo $orderQty; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><?php echo $sellingValue; ?></td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>
<script>
    function cancelpo(cid){
        var connfmsg = confirm('Are you sure you want to cancel?');
        if(connfmsg==true){
            $('#cancelid'+cid).text('Loading...');
            $('#cancelid'+cid).load('newaction.php?action=cancelpo&cid='+cid);
        }

    }
</script>
        <script>
        function getEditDetails(editId) {
            $('#editidcheck').load('loadbrand.php?action=geteditdetail&editid=' + editId);
        }
        </script>
        <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>PO&nbsp;Type</label>
                            <select id="poTypeId" class="form-control" name="poTypeId" required>
                                <option value="">Select</option>
                                <?php
			$select='';
			$where='';
			$rs='';
			$select='*';
			$where=' 1 and deletestatus=0 order by id asc';
			$rspl=GetPageRecord($select,'processLossMaster',$where);
			while($rsplList=mysqli_fetch_array($rspl)){
			?>
                                <option value="<?php echo $rsplList['id']; ?>"
                                    data-myTag="<?php echo $rsplList['persantage']; ?>"><?php echo $rsplList['name']; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <script>
                    $(function() {
                        $("#poTypeId").change(function() {
                            var myTag = $('#poTypeId').find('option:selected').attr('data-myTag');
                            $('#processLoss').val(myTag);
                            var processLoss = $('#processLoss').val();
                            var materialQty = $('#materialQty').val();
                            var finalQty = Number(materialQty * processLoss / 100);

                            $('#orderQty').val(materialQty - finalQty);
                        });
                    });
                    </script>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Supplier&nbsp;Name</label>
                            <select id="supplierId" class="form-control" name="supplierId">
                                <option value="">Select</option>
                                <?php

$select='';

$where='';

$rs='';

$select='*';

$where='1 and deletestatus=0 order by name asc';

$rs=GetPageRecord($select,'suppliersMaster',$where);

while($rest=mysqli_fetch_array($rs)){

?>
                                <option value="<?php echo $rest['id']; ?>"
                                    <?php if($supplierId==$rest['id']){ echo 'selected'; } ?>>
                                    <?php echo $rest['name'].' - '.$rest['supplierId']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Count</label>
                            <input name="count" type="text" class="form-control" id="count"
                                value="<?php echo $count; ?>" readonly="readonly">
                        </div>
                    </div>
                    <?php if($gsm!=''){ ?>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>GSM</label>
                            <input name="gsm" type="text" class="form-control" id="gsm" value="<?php echo $gsm; ?>"
                                readonly="readonly">
                        </div>
                    </div>
                    <?php } ?>
                    <?php if($fabricWidth!=''){ ?>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Fabric Width</label>
                            <input name="fabricWidth" type="text" class="form-control" id="fabricWidth"
                                value="<?php echo $fabricWidth; ?>" readonly="readonly">
                        </div>
                    </div>
                    <?php } ?>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Item to be issued</label>
                            <input name="materialName" type="text" class="form-control" id="materialName"
                                value="<?php echo getMaterialName($materialId); ?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Quantity to be Issued</label>
                            <input name="materialQty" type="text" class="form-control" id="materialQty"
                                value="<?php //echo $materialQty; ?>" onkeyup="qtyIssueCount();">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Quantity In-Stock</label>
                            <input name="inStockQty" type="text" class="form-control" id="inStockQty" value="<?php echo $stockInStore; ?>"
                                readonly="readonly">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>PL(%)</label>
                            <input name="processLoss" type="text" class="form-control" id="processLoss" value=""
                                readonly="readonly">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Final Item</label>
                            <select name="materialId" class="form-control " id="materialId">
                                <option value="">Select</option>
                                <?php

$rsMaterial=GetPageRecord('id,name','materialMaster','1 and materialType=1 order by name asc');
while($rsMaterialDetail=mysqli_fetch_array($rsMaterial)){

?>
                                <option value="<?php echo $rsMaterialDetail['id']; ?>">
                                    <?php echo $rsMaterialDetail['name']; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Final Quantity</label>
                            <input name="orderQty" type="text" class="form-control" id="orderQty" value="">
                            <!--<p style=" color:red; display:none;" id="qtycheck">Order qty. cant be greater then marerial qty.</p>-->
                        </div>
                    </div>
                    <script>
                    function qtyIssueCount() {
                        var myTag = $('#poTypeId').find('option:selected').attr('data-myTag');
                        $('#processLoss').val(myTag);
                        var processLoss = $('#processLoss').val();
                        var materialQty = $('#materialQty').val();
                        var finalQty = Number(materialQty * processLoss / 100).toFixed(2);

                        $('#orderQty').val(Number(materialQty - finalQty).toFixed(2));
                    }
                    </script>
                    <script>
                    function qtyCount(orderQty) {

                        var materialQty = Number($('#materialQty').val());

                        var orderQty = Number($('#orderQty').val());
                        var inStockQty = Number(<?php echo $materialQty; ?>);


                        //  if(orderQty<=materialQty){

                        $('#qtycheck').hide();

                        var pendingQty = Number(inStockQty - materialQty);

                        pendingQty = parseFloat(pendingQty).toFixed(2);

                        var sellingRate = $('#sellingRate').val();

                        var sellingValue = Number(orderQty * sellingRate);

                        sellingValue = parseFloat(sellingValue).toFixed(2);

                        $('#sellingValue').val(sellingValue);

                        $('#pendingQty').val(pendingQty);

                        //  }else{

                        //  	$('#qtycheck').show();

                        // 	$('#sellingValue').val(0);

                        //  	$('#pendingQty').val(0);

                        //  }



                    }
                    </script>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Rate</label>
                            <input name="sellingRate" type="text" class="form-control" id="sellingRate"
                                value="<?php echo $rate; ?>" onkeyup="qtyCount();">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Value</label>
                            <input name="sellingValue" type="text" class="form-control" id="sellingValue" value="">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Pending&nbsp;Qty.</label>
                            <input name="pendingQty" type="text" class="form-control" id="pendingQty" value=""
                                onkeyup="qtyCount();" readonly="readonly">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Color</label>
                            <select class="form-control" name="color" id="color">
                                <option value="">Select</option>
                                <?php
				$rsColor=GetPageRecord('id,name',_COLOR_CARD_MASTER_,'brandId="'.$brandid.'"');
				while($rsColorList=mysqli_fetch_array($rsColor)){
				?>
                                <option value="<?php echo $rsColorList['id']; ?>"><?php echo $rsColorList['name']; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Final Item</label>
                            <select class="form-control" name="isFinal" id="isFinal">
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="col-md-2">
        <div class="form-group">
          <label>Greige&nbsp;Fabric</label>
          <input name="grefab" type="text" class="form-control" id="grefab"
                        value="<?php echo $_REQUEST['matqty']; ?>" readonly="readonly">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label>Allocate&nbsp;Qty.</label>
          <input name="allocateq" type="text" class="form-control" id="allocateq"
                        value="<?php echo $_REQUEST['matqty']; ?>" readonly="readonly">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label>Issued Qty.</label>
          <input name="greorder" type="text" class="form-control" id="greorder" value="">
        </div>
      </div>-->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="submit" class="btn bg-info">Save</button>
            </div>
            <input name="action" type="hidden" id="action" value="indentSendtoBomInventory" />
            <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
            <input name="module" type="hidden" value="yarninventory" />
            <input name="requisitionNo" type="hidden" value="<?php echo $_REQUEST['requisitionNo']; ?>" />
            <input name="id" type="hidden" value="<?php echo $_REQUEST['id']; ?>" />
            <input name="styleId" type="hidden" value="<?php echo $styleId; ?>" />
            <input name="techpackdetailId" type="hidden" value="<?php echo $techpackdetailId; ?>" />
            <input name="styleSubCateId" type="hidden" value="<?php echo $styleSubCateId; ?>" />
            <input name="uom" type="hidden" value="<?php echo $uom; ?>" />
            <input name="poQty" type="hidden" value="<?php echo $poQty; ?>" />
            <!--<input name="materialQty" type="hidden" value="<?php echo $materialQty; ?>" />-->
            <input name="materialValue" type="hidden" value="<?php echo $materialValue; ?>" />
            <input name="stockInStore" type="hidden" value="<?php echo $stockInStore; ?>" />
            <input name="editidcheck" id="editidcheck" type="hidden" value="" />
            <input name="parentId" id="parentId" type="hidden" value="<?php echo $parentId; ?>" />
            <input name="oldMaterialId" id="oldMaterialId" type="hidden" value="<?php echo $materialId; ?>" />
        </form>
        <?php } ?>

<?php if($_REQUEST['action']=='colorcardmasterfromsyle'){

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

            <div class="col-md-12">
                <div class="form-group">
                    <label>Color Code</label>
                    <input name="colorCode" type="color" class="form-control validate" id="colorCode"
                        value="<?php echo $editresult['colorCode']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Color Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Reference</label>
                    <input name="reference" type="text" class="form-control validate" id="reference"
                        value="<?php echo $editresult['reference']; ?>">
                </div>
            </div>
            <div class="col-md-6" style="display:none;">
                <div class="form-group">
                    <label>Buyer Color Code</label>
                    <input name="buyerColorCode" type="color" class="form-control " id="buyerColorCode"
                        value="<?php echo $editresult['buyerColorCode']; ?>">
                </div>
            </div>
            <div class="col-md-6" style="display:none;">
                <div class="form-group">
                    <label>Buyer Color Name</label>
                    <input name="buyerColorName" type="text" class="form-control " id="buyerColorName"
                        value="<?php echo $editresult['buyerColorName']; ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal" id="closeBtn">Close</button>
        <button type="submit" class="btn bg-info">Save</button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="buyerId" type="hidden" id="buyerId" value="<?php echo $_REQUEST['buyerId']; ?>" />
    <input name="brandId" type="hidden" id="brandId" value="<?php echo $_REQUEST['brandId']; ?>" />
</form>
<?php } ?>
<?php if($_REQUEST['action']=='sizemaster'){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'sizeMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Description</label>
                    <input name="description" type="text" class="form-control validate" id="description"
                        value="<?php echo $editresult['description']; ?>">
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

 if($_REQUEST['action']=='uoloadopeningbalance'){

?>
    <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Attach File</label>
                <div class="">
                    <input type="file" name="attachmentFile" id="attachmentFile" class="form-control">
                </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
      </div>
      <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
      <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['module']; ?>" />
    </form>
    <?php }

             ?>
<?php if($_REQUEST['action']=='widthmaster'){

if($_GET['id']!=''){

$id=clean(decode($_GET['id']));

$select1='*';

$where1='id='.$id.'';

$rs1=GetPageRecord($select1,'widthMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

}

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Width</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="<?php echo $editresult['name']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Description</label>
                    <input name="description" type="text" class="form-control validate" id="description"
                        value="<?php echo $editresult['description']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control validate">
                        <option value="1" <?php if($editresult['status']=='1') { ?>selected="selected" <?php } ?>>Active
                        </option>
                        <option value="2" <?php if($editresult['status']=='2') { ?>selected="selected" <?php } ?>>
                            Inactive</option>
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

if($_REQUEST['action']=='addactivity'){

    if($_GET['id']!=''){

    $id=clean(decode($_GET['id']));

    $select1='*';

    $where1='id='.$id.'';

    $rs1=GetPageRecord($select1,'samplingActivityMaster',$where1);

    $editresult=mysqli_fetch_array($rs1);

    }

    ?>
    <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Activity</label>
                        <select id="activityId" name="activityId" class="form-control" displayname="Activity">
                            <option value="">Select</option>
                            <?php
                            $select='';
                            $where='';
                            $rs='';
                            $select='*';
                            $where=' 1 and status=1 order by name asc';
                            $rs=GetPageRecord($select,'activityTypeMaster',$where);
                            while($resListing=mysqli_fetch_array($rs)){

                            ?>
                            <option value="<?php echo strip($resListing['id']); ?>"
                                <?php if($resListing['id']==$editresult['activityId']){ ?>selected="selected" <?php } ?>>
                                <?php echo strip($resListing['name']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Planned Date</label>
                        <input name="plannedDate" type="text" class="form-control" id="plannedDate" value="<?php if($editresult['plannedDate']=="0000-00-00" || $editresult['plannedDate']==""){ echo date('d-m-Y'); }else{ echo date('d-m-Y',strtotime($editresult['plannedDate'])); }  ?>" maxlength="8" />
                    </div>
                </div>
                <script>
                $('#plannedDate').Zebra_DatePicker({
                    format: 'd-m-Y',
                });
                </script>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Color</label>
                        <select id="colorId" name="colorId" class="form-control" displayname="color">
                            <option value="">Select</option>
                            <?php
                            $select='';
                            $where='';
                            $rs='';
                            $select='*';
                            $where='1 and deletestatus=0 and status=1 and brandId="2" order by name asc';
                            $rs=GetPageRecord($select,'colorCardMaster',$where);
                            while($resListing=mysqli_fetch_array($rs)){

                            ?>
                            <option value="<?php echo strip($resListing['colorId']); ?>"
                                <?php if($resListing['id']==$editresult['colorId']){ ?>selected="selected" <?php } ?>>
                                <?php echo getColorName($resListing['id']); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
            <button type="submit" class="btn bg-info"> Save </button>
        </div>
        <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
        <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
        <input name="styleId" type="hidden" id="styleId" value="<?php echo $_REQUEST['styleId']; ?>" />
        <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
    </form>
    <?php }

if($_REQUEST['action']=='editactivity'){

    if($_REQUEST['id']!=''){

    $id=clean(decode($_REQUEST['id']));

    $select1='*';

    $where1='id='.$id.'';

    $rs1=GetPageRecord($select1,'samplingActivityMaster',$where1);

    $editresult=mysqli_fetch_array($rs1);

    $where='';
    $rs='';
    $where='styleId="'.decode($_REQUEST['styleId']).'" and colorId="'.$editresult['colorId'].'"';
    $rs=GetPageRecord('qty','styleColorDetailMaster',$where);
    $resListing=mysqli_fetch_array($rs);

    if($editresult['wip']==''){
        $wip = $resListing['qty'];
    }else{
        $wip = $editresult['wip'];
    }


    }

    ?>
    <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Activity</label>
                        <input type="text" class="form-control" value="<?php echo getActivityTypeName($editresult['activityId']); ?>" readonly />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Planned Date</label>
                        <input name="plannedDate" type="text" class="form-control" id="plannedDate" value="<?php echo date('d-m-Y',strtotime($editresult['plannedDate']));  ?>" readonly maxlength="8" />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Color</label>
                        <input type="text" class="form-control" value="<?php echo getColorName($editresult['colorId']); ?>" readonly />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>WIP</label>
                        <input type="text" name="wip" class="form-control" value="<?php echo $wip; ?>" readonly />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Dispatch</label>
                        <input name="dispatch" type="text" class="form-control" id="dispatch" value=""/>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Total Dispatch</label>
                        <input name="totalDispatch" type="text" class="form-control" id="totalDispatch" value="<?php echo $editresult['totalDispatch']; ?>" readonly />
                    </div>
                </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
            <button type="submit" class="btn bg-info"> Save </button>
        </div>
        <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
        <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
        <input name="styleId" type="hidden" id="styleId" value="<?php echo $_REQUEST['styleId']; ?>" />
        <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
        <input name="totalWip" type="hidden" id="totalWip" value="<?php echo $resListing['qty']; ?>" />
    </form>
    <?php }

?>
<?php if($_REQUEST['action']=='accountgroup'){

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Group Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Group Type</label>
                    <select name="accountGroup" id="status" class="form-control validate" required>
                        <option value="">Select Type</option>
                        <option value="1" <?php if($_REQUEST['groupid']==1){ ?>selected="selected" <?php } ?>>Assets</option>
        				<option value="2" <?php if($_REQUEST['groupid']==2){ ?>selected="selected" <?php } ?>>Liability</option>
        				<option value="3" <?php if($_REQUEST['groupid']==3){ ?>selected="selected" <?php } ?>>Equity</option>
        				<option value="4" <?php if($_REQUEST['groupid']==4){ ?>selected="selected" <?php } ?>>Income</option>
        				<option value="5" <?php if($_REQUEST['groupid']==5){ ?>selected="selected" <?php } ?>>Expense</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php } ?>

<?php if($_REQUEST['action']=='accountsubgroup'){

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Sub Group Name</label>
                    <input name="name" type="text" class="form-control validate" id="name"
                        value="" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Group Name</label>
                    <select name="accountGroup" id="status" class="form-control validate" required>
                        <option value="<?php echo $_REQUEST['groupId']; ?>"><?php echo $_REQUEST['groupName']; ?> </option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Ledger Id</label>
                    <input name="ledgerId" type="text" class="form-control validate" id="ledgerId" value="" required>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php } ?>

<?php if($_REQUEST['action']=='accountnamemaster'){

?>
<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Account Name</label>
                    <input name="AccountName" type="text" class="form-control validate" id="name"
                        value="" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Sub Group</label>
                    <select name="GroupId" id="GroupId" class="form-control validate" required>
                        <option value="<?php echo $_REQUEST['groupId']; ?>"><?php echo $_REQUEST['groupName']; ?> </option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Status</label>
                    <select name="Status" id="status" class="form-control validate" required>
                        <option value="1">Active</option>
                        <option value="0">In-Active</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="submit" class="btn bg-info"> Save </button>
    </div>
    <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
    <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
    <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
</form>
<?php }


if($_REQUEST['action']=='othersmaster'){

    if($_GET['id']!=''){

    $id=clean(decode($_GET['id']));

    $select1='*';

    $where1='id='.$id.'';

    $rs1=GetPageRecord($select1,'othersMaster',$where1);

    $editresult=mysqli_fetch_array($rs1);

    }

    ?>
    <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Name</label>
                        <input name="name" type="text" class="form-control validate" id="name"
                            value="<?php echo $editresult['name']; ?>" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Code</label>
                        <input name="code" type="text" class="form-control validate" id="code"
                            value="<?php echo $editresult['code']; ?>" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Status</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="1" <?php echo ($editresult['status']=='1') ? 'selected' : ''; ?>>Active</option>
                            <option value="2" <?php echo ($editresult['status']=='2') ? 'selected' : ''; ?>>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
            <button type="submit" class="btn bg-info"> Save </button>
        </div>
        <input name="action" type="hidden" id="action" value="<?php echo $_REQUEST['action']; ?>" />
        <input name="editId" type="hidden" id="editId" value="<?php echo encode($editresult['id']); ?>" />
        <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['action']; ?>" />
    </form>
    <?php }

?>
