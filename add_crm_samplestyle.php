<?php

//$updatepage='1';

if($_GET['id']==''){

$where=' subject="" and  addedBy='.$_SESSION['userid'].'';

deleteRecord('queryMaster',$where);



$dateAdded=time();

$namevalue ='subject="",addedBy='.$_SESSION['userid'].',dateAdded='.$dateAdded.'';

$lastId = addlistinggetlastid('queryMaster',$namevalue);



}



if($_GET['id']!=''){

//echo decode($_GET['id']);

$select1='*';

$where1='id="'.decode($_GET['id']).'"';

$rs1=GetPageRecord($select1,'queryMaster',$where1);

$editresult=mysqli_fetch_array($rs1);

$editId=clean($editresult['id']);

$lastId=$editresult['id'];

}

$mailid=decode($_REQUEST['mailid']);

if($mailid!=''){

include('incomingMailSetting.php');

$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to domain:' . imap_last_error());

$emails = imap_search($inbox,'ALL');

if($emails){

$output = '';

rsort($emails);

$totalmail=0;

$n=1;

foreach($emails as $email_number) {

if($email_number==$mailid){

$subject='';

$message='';

$body='';

$email='';

$date='';



$overview = imap_fetch_overview($inbox,$email_number,0);

$subject = $subject=$overview[0]->subject;

$message='';

$message = (imap_fetchbody($inbox,$email_number,'2'));

if (count(explode(' ', trim($message))) > 2) {} else {

$message = nl2br(imap_fetchbody($inbox,$email_number,1.1));

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

$maildate = date('Y-m-d H:i:s',$timestamp);

/* get information specific to this email */

$overview = imap_fetch_overview($inbox,$email_number,0);

$structure = imap_fetchstructure($inbox,$email_number);

$attachments = array();

if(isset($structure->parts) && count($structure->parts)) {

for($i = 0; $i < count($structure->parts); $i++) {

$attachments[$i] = array(

'is_attachment' => false,

'filename' => '',

'name' => '',

'attachment' => '');



if($structure->parts[$i]->ifdparameters) {

foreach($structure->parts[$i]->dparameters as $object) {

if(strtolower($object->attribute) == 'filename') {

$attachments[$i]['is_attachment'] = true;

$attachments[$i]['filename'] = $object->value;

}

}

}



if($structure->parts[$i]->ifparameters) {

foreach($structure->parts[$i]->parameters as $object) {

if(strtolower($object->attribute) == 'name') {

$attachments[$i]['is_attachment'] = true;

$attachments[$i]['name'] = $object->value;

}

}

}



if($attachments[$i]['is_attachment']) {

$attachments[$i]['attachment'] = imap_fetchbody($inbox, $email_number, $i+1);

if($structure->parts[$i]->encoding == 3) { // 3 = BASE64

$attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);

}

elseif($structure->parts[$i]->encoding == 4) { // 4 = QUOTED-PRINTABLE

$attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);

}

}

} // for($i = 0; $i < count($structure->parts); $i++)

} // if(isset($structure->parts) && count($structure->parts))



$filenames='';

if(count($attachments)!=0){

foreach($attachments as $at){

if($at['is_attachment']==1){



$filenames.=trim($at['filename']).',';



file_put_contents('attachment/'.date('d-m-Y-H:i:s',$timestamp).'-'.$at['filename'], $at['attachment']);

}

}

}



} }}


}



?>





<div class="page-content">

<!-- Main content -->

<div class="content-wrapper">

<!-- Content area -->

<div class="content pt-0" style="margin-top:20px;">



    <form action="ac.crm" method="post" class="submitstyleform" enctype="multipart/form-data" name="popid"
        target="acf" id="popid" style="display:non1e;">

        <!-- Dashboard content -->

        <div class="row">


            <div class="col-xl-<?php if($mailid!=''){ echo '7'; } else { echo '12'; } ?>">

                <div class="card">

                    <div class="card-header bg-white">

                        <h6 class="card-title" style="display: inline-block;">Sampling Style Information</h6>
                        <h6 class="" style="float:right;"><a
                                href="tcpdf/examples/generatesamplesty.php?pageurl=<?php echo $fullurl; ?>download-samplesty.php?id=<?php echo encode($editresult['id']); ?>"
                                target="_blank"
                                style="background: #e71c22; outline: none; color: #fff; padding: 5px; border-radius: 2px; cursor: pointer; width: 95px; display: block;">
                                <i class="fa fa-download" aria-hidden="true"></i> PDF</a></h6>

                    </div>



                    <div class="card-body">

                        <?php if($updatepage=='1'){ ?>

                        <span class="badge d-block badge-info form-text text-center"
                            style="margin-bottom: 20px; font-size: 12px; padding: 10px;">Successfully
                            Updated</span>

                        <?php } ?>



                        <div class="form-group">

                            <div class="row">

                                <div class="col-md-2">

                                    <div class="form-group">

                                        <label>Style Type</label>

                                        <select id="sampleStyle" name="sampleStyle" class="form-control"
                                            displayname="Brand" disabled="disabled">

                                            <option value="2" selected>Sample</option>

                                        </select>

                                    </div>

                                </div>





                                <div class="col-md-2">

                                    <div class="form-group">

                                        <label>Sample For</label>

                                        <select id="sampleFor" name="sampleFor" class="form-control validate "
                                            onchange="funcStyleType(this.value);">

                                            <option value="">Select</option>

                                            <option value="100"
                                                <?php if($editresult['sampleFor']=="100"){ ?>selected<?php } ?>>
                                                Self</option>

                                            <option value="2"
                                                <?php if($editresult['sampleFor']=="2"){ ?>selected<?php } ?>>
                                                Buyer Inspiration</option>

                                        </select>

                                    </div>

                                </div>

                                <script>
                                $(document).ready(function() {

                                    $(".select2").select2();

                                });
                                </script>



                                <div class="col-md-2">

                                    <div class="form-group">

                                        <label>Sample Stage</label>

                                        <select id="productionStage" name="productionStage"
                                            class="form-control validate "
                                            onchange="loadSampleType(this.value);">

                                            <option value="">Select</option>

                                            <?php

$rsList=GetPageRecord('id,name','productionStageMaster','1 and deletestatus=0 order by id asc');

while($productionName=mysqli_fetch_array($rsList)){

?>

                                            <option value="<?php echo $productionName['id']; ?>"
                                                <?php if($productionName['id']==$editresult['productionStage']){ echo 'selected'; }?>>
                                                <?php echo $productionName['name']; ?></option>

                                            <?php } ?>

                                        </select>

                                    </div>

                                </div>



                                <div class="col-md-2">

                                    <div class="form-group">

                                        <label>Sample Type</label>

                                        <select id="sampleType" name="sampleType"
                                            class="form-control validate ">



                                        </select>

                                    </div>

                                </div>



                                <div class="col-md-2">

                                    <div class="form-group">

                                        <label>Style</label>

                                        <select id="styleId" name="styleId" class="form-control "
                                            onchange="styleData(this.value);funChangeBrand();">



                                        </select>

                                    </div>

                                </div>



                                <div class="col-md-2">

                                    <div class="form-group">

                                        <label>Sample Style#</label>

                                        <input name="styleRefId" type="text"
                                            class="validate form-control <?php if($_GET['styleid']!=''){ echo 'readonly'; }?>"
                                            displayname="Sub Ref No." id="styleRefId"
                                            value="<?php echo $editresult['styleRefId']; ?>" maxlength="200">

                                    </div>

                                </div>



                                <div class="col-md-12" id="loaddiv">



                                </div>

                            </div>

                            <script>
                            function loadSampleType(id) {

                                $('#sampleType').load('loadaction.php?action=sampletypeaction&id=' + id +
                                    '&sampleType=<?php echo $editresult['sampleType']; ?>');

                            }

                            function styleData(id) {

                                var sampleType = $('#sampleType').val();
                                $('#loaddiv').load(
                                    'loadaction.php?action=getmaterialrequisition&edit=<?php echo $_GET['edit']; ?>&styleId=' +
                                    id + '&sampleType=' + sampleType);

                            }

                            function funcStyleType(id) {

                                $('#styleId').load('loadbuyerselfstyle.php?action=selectstyletype&id=' + id +
                                    '&sId=<?php echo encode($editresult['parentStyleId']); ?>');

                            }
                            </script>

                            <script>
                            <?php if($_REQUEST['id']!=''){?>

                            funcStyleType('<?php echo $editresult['sampleFor']; ?>');

                            loadSampleType('<?php echo $editresult['productionStage']; ?>');

                            styleData('<?php echo $editresult['parentStyleId']; ?>');

                            <?php } ?>
                            </script>

                            <div class="row" style="margin-top:20px;">

                                <div class="col-md-4">

                                    <div class="form-group">

                                        <label>Requested&nbsp;By</label>

                                        <input name="requestedBy" type="text" class="form-control"
                                            id="requestedBy" value="<?php echo $editresult['requestedBy']; ?>">

                                    </div>

                                </div>



                                <div class="col-md-4">

                                    <div class="form-group">

                                        <label>Requested&nbsp;Date</label>

                                        <input name="requestedDate" type="text" class="form-control readonly"
                                            id="requestedDate"
                                            value="<?php if($editresult['requestedDate']!=''){ echo date('d-m-Y', strtotime($editresult['requestedDate'])); }else{ echo date('d-m-Y'); } ?>"
                                            readonly="">

                                    </div>

                                </div>

                                <div class="col-md-3" style="display:none;">

                                    <div class="form-group">

                                        <label>Dispatch&nbsp;Date</label>

                                        <input name="dispatchDate" type="text" class="form-control"
                                            id="dispatchDate"
                                            value="<?php if($editresult['dispatchDate']!=''){ echo date('d-m-Y', strtotime($editresult['dispatchDate'])); }else{ echo date('d-m-Y'); } ?>"
                                            readonly="">

                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <div class="form-group">

                                        <label>Target&nbsp;Date</label>

                                        <input name="expectedDate" type="text" class="form-control"
                                            id="expectedDate"
                                            value="<?php if($editresult['expectedDate']!=''){ echo date('d-m-Y', strtotime($editresult['expectedDate'])); }else{ echo date('d-m-Y', strtotime('+1 days')); } ?>"
                                            readonly="">

                                    </div>

                                </div>





                            </div>



                            <div class="row" style="margin-top:20px;">

                                <div class="col-md-4">

                                    <div class="form-group">

                                        <label>Dispatch&nbsp;Details</label>

                                        <input name="dispatchDetail" type="text" class="form-control"
                                            id="dispatchDetail"
                                            value="<?php echo $editresult['dispatchDetail']; ?>">

                                    </div>

                                </div>
                                <div class="col-md-4" style="">

                                    <div class="form-group">

                                        <label>Size Range</label>

                                        <select id="sizerange" name="sizerange" class="form-control "
                                            displayname="" onchange="changeratio(this.value);">

                                            <option value="0">Select</option>

                                            <?php

$select='';

$where='';

$rs='';

$select='*';

$where='1 and deletestatus=0 and status=1 order by name asc';

$rs=GetPageRecord($select,'sizerangeMaster',$where);

while($resListing=mysqli_fetch_array($rs)){

?>

                                            <option value="<?php echo $resListing['id']; ?>"
                                                <?php if($resListing['id']==$editresult['sizerange']){ ?>selected="selected"
                                                <?php } ?>><?php echo strip($resListing['name']); ?></option>

                                            <?php } ?>

                                        </select>

                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <div class="form-group">

                                        <label>Size Ratio</label>

                                        <select name="sizeratio" type="number" class="form-control"
                                            id="sizeratio" value="<?php echo $editresult['sizeratio']; ?>"
                                            maxlength="200">

                                            <option> Select</option>

                                        </select>

                                    </div>

                                </div>
                                <div
                                    class="col-md-<?php if($editresult['attachmentFile']!=''){?>3<?php }else{ ?>6<?php } ?>">

                                    <!--   <div class="form-group">

<label>Attach Tech Pack</label>

<div class="uniform-uploader btn-secondary">

<input type="file" name="patternAttachment" id="patternAttachment" class="form-input-styled" data-fouc="">

<span class="filename btn-secondary" style="user-select: none;">No file selected</span> <span class="action btn btn-secondary" style="user-select: none;"><i class="fa fa-upload"></i></span>

<script>

$('#patternAttachment').on('change',function(){

//get the file name

var fileName = $(this).val();

//replace the "Choose a file" label

$(this).next('.filename').html(fileName);

})

</script>

<input type="hidden" name="patternAttachmentEdit" id="patternAttachmentEdit" value="<?php echo $editresult['techpackattachment']; ?>"/>

</div>

</div>-->



                                </div>

                                <?php if($editresult['attachmentFile']!=''){?>

                                <!--<div class="col-md-3" style="margin-top:27px;">

<div class="form-group">

<?php if($editresult['attachmentFile']!=''){?>

<div> <a href="images/<?php echo $editresult['attachmentFile']; ?>" target="blank" class="btn btn-secondary" style="margin:0px;"><i class="fa fa-download"></i> Download Techpack</a> </div>

<?php } ?>

</div>

</div>-->

                                <?php } ?>



                                <script>
                                function changeratio(sizerange) {

                                    $('#sizeratio').load('loadbrand.php?sizerange=' + sizerange +
                                        '&action=changesizeratio');

                                }
                                </script>

                            </div>



                            <?php

$addno=1;

$select='';

$where='';

$rscolor='';

$where='1 and styleId='.$lastId.' order by id asc';

$rscolor=GetPageRecord('*','styleColorDetailMaster',$where);

while($resListingcolor=mysqli_fetch_array($rscolor)){

?>

                            <div class="row" style="margin-top:20px;" id="partyAddrsId<?php echo $addno; ?>">

                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label>Color</label>

                                        <select id="colorId<?php echo $addno; ?>"
                                            name="colorId<?php echo $addno; ?>" class=" form-control"
                                            displayname="">

                                            <option value="">Select</option>

                                            <?php

$select='';

$where='';

$rs='';

$select='*';

$where='1 and deletestatus=0 and status=1 and brandId="'.$editresult['brandId'].'" order by name asc';

$rs11=GetPageRecord('name,id','colorCardMaster',$where);

while($resListing11=mysqli_fetch_array($rs11)){

?>

                                            <option value="<?php echo strip($resListing11['id']); ?>"
                                                <?php if($resListingcolor['colorId']==$resListing11['id']){ ?>selected="selected"
                                                <?php } ?>><?php echo strip($resListing11['name']); ?></option>

                                            <?php } ?>

                                        </select>

                                    </div>

                                </div>



                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label>Color Qty.</label>

                                        <input name="qty<?php echo $addno; ?>" type="number"
                                            class="form-control" id="qty<?php echo $addno; ?>"
                                            value="<?php echo $resListingcolor['qty']?>">

                                    </div>

                                </div>


                                <?php
$newdata = explode(',', $resListingcolor['valueEdition']);
?>
                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label>Value&nbsp;Addition</label>

                                        <select id="valueEdition<?php echo $addno; ?>"
                                            name="valueEdition<?php echo $addno; ?>[]"
                                            class=" form-control select2" multiple="multiple">

                                            <option value="" disabled="disabled">Select</option>

                                            <?php

$select='';

$where='';

$rs='';

$select='*';

$where='1 and deletestatus=0 and status=1 order by name asc';

$rs12=GetPageRecord($select,'embroideryTypeMaster',$where);

while($resListing12=mysqli_fetch_array($rs12)){

?>

                                            <option value="<?php echo strip($resListing12['id']); ?>"
                                                <?php foreach($newdata as $key => $value) {  if($value == $resListing12['id']){ echo 'selected'; } }?>>
                                                <?php echo strip($resListing12['name']); ?></option>

                                            <?php } ?>

                                        </select>

                                    </div>

                                </div>



                                <div class="col-md-3">

                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">

                                        <tr>

                                            <td width="80%" align="left" style="">

                                                <div class="form-group">

                                                    <label>Lining</label>

                                                    <select id="lining<?php echo $addno; ?>"
                                                        name="lining<?php echo $addno; ?>" class=" form-control"
                                                        displayname="">

                                                        <option value="Yes"
                                                            <?php if($resListingcolor['lining']=='Yes'){ ?>selected="selected"
                                                            <?php } ?>>Yes</option>

                                                        <option value="No"
                                                            <?php if($resListingcolor['lining']=='No'){ ?>selected="selected"
                                                            <?php } ?>>No</option>

                                                    </select>

                                                </div>

                                            </td>

                                            <td width="10%" align="left" style="">

                                                <div class="form-group">

                                                    <label>&nbsp;</label>

                                                </div>

                                            </td>

                                            <td width="10%" align="left" style="">

                                                <div class="form-group">

                                                    <label>&nbsp;</label>

                                                    <?php if($addno==1){ ?>

                                                    <img src="images/addicon.png" width="20" height="20"
                                                        onclick="addPartyAdd();"
                                                        style="cursor:pointer; margin-top: 20px;" />

                                                    <?php } else { ?>

                                                    <img src="images/deleteicon.png"
                                                        onclick="removeAddInfo(<?php echo $addno; ?>);"
                                                        style="cursor:pointer; margin-top: 23px;" />

                                                    <?php } ?>

                                                </div>

                                            </td>

                                        </tr>

                                    </table>

                                </div>



                            </div>

                            <?php $addno++; } ?>



                            <?php if($addno==1){ ?>

                            <div class="row" style="margin-top:20px;" id="partyAddrsId1">

                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label>Color</label>

                                        <select id="colorId1" name="colorId1" class=" form-control"
                                            displayname="">



                                        </select>

                                    </div>

                                </div>

                                <script>
                                function funChangeBrand() {
                                    var selected = $('#styleId').find('option:selected');
                                    var brandId = selected.data('overlay');
                                    $('#colorId1').load(
                                        'loadBrandColorList.php?action=loadbrandcolorlist&brandId=' +
                                        brandId);
                                }
                                </script>





                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label>Color Qty.</label>

                                        <input name="qty1" type="number" class="form-control" id="qty1"
                                            value="">

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="form-group">

                                        <label>Value&nbsp;Addition</label>

                                        <select id="valueEdition1" name="valueEdition1[]"
                                            class="form-control select2" multiple="multiple">

                                            <option value="" disabled="disabled">Select</option>

                                            <?php

$select='';

$where='';

$rs='';

$select='*';

$where='1 and deletestatus=0 and status=1 order by name asc';

$rs12=GetPageRecord($select,'embroideryTypeMaster',$where);

while($resListing12=mysqli_fetch_array($rs12)){

?>

                                            <option value="<?php echo strip($resListing12['id']); ?>">
                                                <?php echo strip($resListing12['name']); ?></option>

                                            <?php } ?>

                                        </select>

                                    </div>

                                </div>



                                <div class="col-md-3">

                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">

                                        <tr>

                                            <td width="80%" align="left">

                                                <div class="form-group">

                                                    <label>Lining</label>

                                                    <select id="lining1" name="lining1" class="form-control"
                                                        displayname="">

                                                        <option value="Yes"
                                                            <?php if($editresult['lining']=='Yes'){ ?>selected="selected"
                                                            <?php } ?>>Yes</option>

                                                        <option value="No"
                                                            <?php if($editresult['lining']=='No'){ ?>selected="selected"
                                                            <?php } ?>>No</option>

                                                    </select>

                                                </div>

                                            </td>

                                            <td width="10%" align="left" style="">

                                                <div class="form-group">

                                                    <label>&nbsp;</label>

                                                </div>

                                            </td>

                                            <td width="10%" align="left" style="">

                                                <div class="form-group">

                                                    <label>&nbsp;</label>

                                                    <img src="images/addicon.png" width="20" height="20"
                                                        onclick="addPartyAdd();"
                                                        style="cursor:pointer; margin-top: 20px;" />

                                                </div>

                                            </td>

                                        </tr>

                                    </table>

                                </div>





                            </div>

                            <?php } ?>

                            <input name="addcount" type="hidden" id="addcount"
                                value="<?php if($addno==1){ echo '1'; } else { echo $addno; } ?>" />

                            <script>
                            function addPartyAdd() {
                                var selected = $('#styleId').find('option:selected');
                                var brandId = selected.data('overlay');
                                var addcount = $('#addcount').val();

                                //alert(empcount);

                                addcount = Number(addcount) + 1;

                                $.get("loadcolordetail.php?id=" + addcount +
                                    "&cityId=<?php echo $editcityId; ?>&brandId=" + brandId,
                                    function(data) {

                                        $("#loadpartyaddress").append(data);

                                    });

                                $('#addcount').val(addcount);

                                $

                            }



                            function removeAddInfo(id) {

                                $('#partyAddrsId' + id).remove();

                                var addcount = $('#addcount').val();

                                addcount = Number(addcount) - 1;

                                $('#addcount').val(addcount);

                            }
                            </script>



                            <div class="form-group" style="margin-top:20px;" id="loadpartyaddress">



                            </div>





                        </div>

                        <input type="hidden" name="editId" value="<?php echo encode($lastId); ?>">

                        <input type="hidden" name="module" value="<?php echo $_GET['module']; ?>">

                        <input type="hidden" name="action"
                            value="<?php if($_GET['id']!=''){ echo 'editquery'; } else { echo 'addquery'; } ?>">

                        <?php if($_GET['id']=='' && $_GET['incomingid']!=''){ ?>

                        <input name="incomingqueryId" type="hidden" id="incomingqueryId"
                            value="<?php echo $_GET['incomingid']; ?>" />

                        <?php } ?>

                        <input name="mailId" type="hidden" id="mailId"
                            value="<?php echo decode($_REQUEST['incomingid']); ?>" />

                        <?php

if($_GET['id']!=''){

?>

                        <input name="editedityes" type="hidden" id="editedityes" value="1" />

                        <?php } ?>

                        <div class="text-right">

                            <button type="button" name="submitbtn" id="submitbtn pnotify-solid-success"
                                class="btn btn-primary" onclick="formValidation('popid','submitbtn','0');"
                                style="margin:0px;">Save<i class="fa fa-floppy-o ml-2"
                                    aria-hidden="true"></i></button>



                            <label>



                                <input type="hidden" name="maildate" id="maildate"
                                    value="<?php echo $maildate; ?>">

                            </label>

                        </div>

                    </div>

                </div>

            </div>



        </div>

    </form>

    <div class="row">

        <div class="col-xl-12">

            <!---Image Part--->

            <div class="card">

                <div class="col-md-12">

                    <div class="page-header page-header-light">

                        <div class="page-header-content header-elements-md-inline" style="padding:0px 15px;">

                            <div class="page-title d-flex">

                                <h4><span class="font-weight-semibold">Sampling Activity</span></h4>

                                <a href="#" class="header-elements-toggle text-default d-md-none"><i
                                        class="icon-more"></i></a>
                            </div>

                            <div class="header-elements d-none">

                                <button type="button" class="btn btn-primary"
                                    onclick="opmodalpop(' Add Activity','modalpop.php?action=addactivity&styleId=<?php echo encode($lastId); ?>','600px','auto');"
                                    data-toggle="modal" data-target="#modalpop" aria-expanded="false"
                                    style="margin:0px;">Add&nbsp; <i class="fa fa-plus"
                                        aria-hidden="true"></i></button>

                            </div>

                        </div>

                    </div>

                    <div class="row" style="padding:20px;">

                        <div class="col-sm-12 col-lg-12">
                            <table class="tbl tbl-responsive" width="100%" border="1" cellspacing="2"
                                cellpadding="10" style="border: 1px solid #ccc;">
                                <tr>
                                    <th>SR#</th>
                                    <th>Activity</th>
                                    <th>Color</th>
                                    <th>Planned Date</th>
                                    <th>WIP</th>
                                    <th>Dispatch</th>
                                    <th>Actual Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                <tbody id="loadplanningdate">



                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="row">

        <div class="col-xl-12">

            <!---Image Part--->

            <div class="card">

                <div class="col-md-12">

                    <div class="page-header page-header-light">

                        <div class="page-header-content header-elements-md-inline" style="padding:0px 15px;">

                            <div class="page-title d-flex">

                                <h4><span class="font-weight-semibold">Image Gallery</span></h4>

                                <a href="#" class="header-elements-toggle text-default d-md-none"><i
                                        class="icon-more"></i></a>
                            </div>

                            <div class="header-elements d-none">

                                <button type="button" class="btn btn-primary"
                                    onclick="opmodalpop(' Add Image','modalpop.php?action=styleimagegallery&id=<?php echo encode($lastId); ?>','600px','auto');"
                                    data-toggle="modal" data-target="#modalpop" aria-expanded="false"
                                    style="margin:0px;">Add&nbsp; <i class="fa fa-plus"
                                        aria-hidden="true"></i></button>

                            </div>

                        </div>

                    </div>

                    <div class="row" style="margin-top:20px;">

                        <div id="loadimagegrid"
                            style="width:100%;text-align:center;margin:auto;padding-bottom:15px;">Loading...
                        </div>

                    </div>

                </div>

            </div>

            <!---Image Part--->



        </div>

    </div>


</div>

</div>

</div>



<script>
$(function() {

$("#receivedDate").datepicker();

$("#ocdDate").datepicker();

$("#pcdDate").datepicker();

$("#shipDate").datepicker();

$("#dispatchDate").datepicker({
minDate: 0
});

$("#requestedDate").datepicker();

$("#expectedDate").datepicker({
minDate: 1
});


$("#patternReadyDate").datepicker({
minDate: 0
});
$("#cuttingReadyDate").datepicker({
minDate: 0
});
$("#machineReadyDate").datepicker({
minDate: 0
});
$("#washingReadyDate").datepicker({
minDate: 0
});
$("#finishingReadyDate").datepicker({
minDate: 0
});
$("#qualityReadyDate").datepicker({
minDate: 0
});
$("#handoverReadyDate").datepicker({
minDate: 0
});
});



function loadimagefunc() {

$('#loadimagegrid').load('loadimage.php?id=<?php echo encode($lastId); ?>');

}
loadimagefunc();

function loadplanning(){
    $('#loadplanningdate').load('loadplanningdates.php?styleid=<?php echo encode($lastId); ?>');
}

loadplanning();
</script>
<style>
.loader {

position: fixed;

display: none;

left: 0px;

top: 0px;

width: 100%;

height: 100%;

z-index: 9999;

background: url(images/pageLoader.gif) 50% 50% no-repeat rgb(236, 240, 241);

opacity: 0.8;

}
</style>

<style>
.nav-justified .nav-item {

text-align: center;

width: 100% !important;

display: block;

float: left;

}



.nav-tabs-highlight .nav-link {

width: 100% !important;

float: left;



}

.nav-tabs .nav-item.show .nav-link,
.nav-tabs .nav-link.active {

color: #333;

background-color: #fff;

border-color: #ddd #ddd #fff;

background-color: #fff178 !important;

border: 1px solid #ccc;

}

.nav-tabs-highlight .nav-link {

width: 100% !important;

float: left;

border: 1px solid #e9e9e9;

background-color: #f9f9f9 !important;

}
</style>









<div class="loader"></div>



<style>
.select2-form-group .select2-container {

width: 305px !important;

}
</style>