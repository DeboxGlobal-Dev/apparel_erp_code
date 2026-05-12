<?php
include "inc.php";
?>
<?php if($_REQUEST['action']=='showlivevisitor'){ ?>
<script>
$('#liveusers').text(
    '<?php echo $toatlliveuser = countlisting('id','liveVisitorMaster',' where sessionTime>"'.date("Y-m-d H:i:s", (strtotime(date('Y-m-d H:i:s')) - 20)).'" '); ?>'
    );

<?php if($toatlliveuser!='0' && $toatlliveuser!=''){ ?>
$('#server-load').css('opacity', '1');
<?php } else { ?>
$('#server-load').css('opacity', '0');
<?php }
$n==0;
 $listofurls='';
	  	$selectl='';
		$wherel='';
		$rsl='';
		$selectl='*';
		$wherel=' sessionTime>"'.date("Y-m-d H:i:s", (strtotime(date('Y-m-d H:i:s')) - 20)).'" order by id desc';
		$rsl=GetPageRecord($selectl,'liveVisitorMaster',$wherel);
		while($resListingl=mysqli_fetch_array($rsl)){
      $listofurls.='<tr><td><div class="d-flex align-items-center"><div><a href="page.de?section=activechat&s='.encode($resListingl['id']).'">User-'.$resListingl['id'].'</a></div></div></td><td>'.$resListingl['city'].', '.$resListingl['country'].'</td><td><a href="'.$resListingl['pageURL'].'" target="_blank" class="text-default font-weight-semibold letter-icon-title">'.$resListingl['pageURL'].'</a></td></tr>';$n++;}

if($n=='0'){
  ?>

$('#nolivevisitor').show();

<?php
}
 ?>

$('#activeurls tbody').html('');
$('#activeurls tbody').append('<?php echo $listofurls; ?>');
</script>
<?php } ?>




<?php if($_REQUEST['action']=='showallvisitor'){ ?>
<table class="table text-nowrap">
    <thead>
        <tr>
            <th align="left">&nbsp;</th>
            <th align="left">User</th>
            <th align="left">IP</th>
            <th align="left">URL</th>
            <th align="center">
                <div align="center">Chats</div>
            </th>
            <th align="left">Location</th>
            <th align="left">Time</th>
        </tr>
        <?php
										$n=0;
										 $listofurls='';
	  	$selectl='';
		$wherel='';
		$rsl='';
		$selectl='*';
		$wherel=' sessionTime>"'.date("Y-m-d H:i:s", (strtotime(date('Y-m-d H:i:s')) - 20)).'" order by id desc';
		$rsl=GetPageRecord($selectl,'liveVisitorMaster',$wherel);
		while($resListingl=mysqli_fetch_array($rsl)){
		?>
        <tr>
            <td align="left"><span class="btn bg-warning-400 rounded-circle btn-icon btn-sm"
                    style="background-color:#009900;"><span class="letter-icon"
                        style="text-transform:uppercase;"><?php echo substr($resListingl['city'],'0','1'); ?></span></span>
            </td>
            <td align="left"><a href="<?php echo $resListingl['pageURL']; ?>" target="_blank"
                    class="text-default font-weight-semibold letter-icon-title">User-<?php echo $resListingl['id']; ?></a>
            </td>
            <td align="left"><?php echo substr($resListingl['userIP'],'0','100'); ?></td>
            <td align="left"><a href="<?php echo $resListingl['pageURL']; ?>" target="_blank"
                    class="text-default font-weight-semibold letter-icon-title"
                    style="font-weight:100px; color:#006699 !important;"><?php echo substr($resListingl['pageURL'],'0','100'); ?>...</a>
            </td>
            <td align="center">
                <div align="center">
                    <?php echo countlisting('id','visitorChat','where sessionId='.$resListingl['sessionId'].''); ?>
                </div>
            </td>
            <td align="left"><?php echo $resListingl['city'].', '.$resListingl['country']; ?></td>
            <td align="left"><?php echo makedatetime(strtotime($resListingl["updatedDateTime"])); ?></td>
        </tr>

        <?php  $n++; } ?>
        <script>
        $('#totoalusers').text('<?php echo $n; ?>');
        </script>
    </thead>
    <tbody>
    </tbody>
</table>
<?php if($n=='0' || $n==''){ ?><div style="padding:30px; text-align:center; color:#666666;">Currently No Live Visitor
</div><?php } ?>
<?php } ?>






<?php if($_REQUEST['action']=='searching'){


$keywordsearch = addslashes($_REQUEST['keywordsearch']);
$month = $_REQUEST['month'];


$searchmonth='';
if($month=='1'){
$searchmonth=' and  DATE(updatedDateTime)="'.date('Y-m-d').'"';
}

if($month=='2'){
$searchmonth=' and  DATE(updatedDateTime)="'.date('Y-m-d',strtotime("-1 days")).'"';

}


if($month=='3'){
$searchmonth=' and  DATE(updatedDateTime) between "'.date("Y-m-d", strtotime('monday this week')).'" and "'.date("Y-m-d", strtotime('sunday this week')).'"';
}


if($month=='4'){
$searchmonth=' and  DATE(updatedDateTime) between "'.date("Y-m-").'-1" and "'.date("Y-m-t").'"';

}

$searchkey='';
if($keywordsearch!=''){
$searchkey=' and id="'.$keywordsearch.'" or (userIP like "%'.$keywordsearch.'%" or pageURL like "%'.$keywordsearch.'%" or city like "%'.$keywordsearch.'%" or country like "%'.$keywordsearch.'%")';
}


 ?>
<table class="table text-nowrap">
    <thead>
        <tr>
            <th align="left">&nbsp;</th>
            <th align="left">User</th>
            <th align="left">IP</th>
            <th align="left">URL</th>
            <th align="center">
                <div align="center">Chats</div>
            </th>
            <th align="left">Location</th>
            <th align="left">Time</th>
        </tr>
        <?php
										$n=0;
										 $listofurls='';
	  	$selectl='';
		$wherel='';
		$rsl='';
		$selectl='*';
		$wherel=' 1 '.$searchmonth.' '.$searchkey.' and sessionId in (select sessionId from visitorChat where msgType=2) order by id desc';
		$rsl=GetPageRecord($selectl,'liveVisitorMaster',$wherel);
		while($resListingl=mysqli_fetch_array($rsl)){
		?>
        <tr>
            <td align="left"><span class="btn bg-warning-400 rounded-circle btn-icon btn-sm"
                    style="background-color:#009900;"><span class="letter-icon"
                        style="text-transform:uppercase;"><?php echo substr($resListingl['city'],'0','1'); ?></span></span>
            </td>
            <td align="left"><a href="page.de?section=activechat&s=<?php echo encode($resListingl['id']); ?>&a=1"
                    target="_blank">User-<?php echo $resListingl['id']; ?></a></td>
            <td align="left"><a href="page.de?section=activechat&s=<?php echo encode($resListingl['id']); ?>&a=1"
                    target="_blank"><?php echo substr($resListingl['userIP'],'0','100'); ?></a></td>
            <td align="left"><a href="<?php echo $resListingl['pageURL']; ?>" target="_blank"
                    class="text-default font-weight-semibold letter-icon-title"
                    style="font-weight:100px; color:#006699 !important;"><?php echo substr($resListingl['pageURL'],'0','100'); ?>...</a>
            </td>
            <td align="center">
                <div align="center">
                    <?php echo countlisting('id','visitorChat','where sessionId='.$resListingl['sessionId'].''); ?>
                </div>
            </td>
            <td align="left"><a href="page.de?section=activechat&s=<?php echo encode($resListingl['id']); ?>&a=1"
                    target="_blank"><?php echo $resListingl['city'].', '.$resListingl['country']; ?></a></td>
            <td align="left"><a href="page.de?section=activechat&s=<?php echo encode($resListingl['id']); ?>&a=1"
                    target="_blank"><?php echo date('j F Y, h:i a',strtotime($resListingl["updatedDateTime"])); ?></a>
            </td>
        </tr>

        <?php  $n++; } ?>
        <script>
        $('#totoalusers').text('<?php echo $n; ?>');
        </script>
    </thead>
    <tbody>
    </tbody>
</table>
<?php if($n=='0' || $n==''){ ?><div style="padding:30px; text-align:center; color:#666666;">No Chats</div><?php } ?>
<?php } ?>




<?php if($_REQUEST['action']=='showallliveuser'){ ?>
<?php
										$n=0;
										 $listofurls='';
	  	$selectl='';
		$wherel='';
		$rsl='';
		$selectl='*';
		$wherel=' sessionTime>"'.date("Y-m-d H:i:s", (strtotime(date('Y-m-d H:i:s')) - 20)).'" order by id desc';
		$rsl=GetPageRecord($selectl,'liveVisitorMaster',$wherel);
		while($resListingl=mysqli_fetch_array($rsl)){


		$select1='adminChatStatus';
$where1='msgType=2 and adminChatStatus=1 and sessionId='.$resListingl['sessionId'].'';
$rs1=GetPageRecord($select1,'visitorChat',$where1);
$visitormsg=mysqli_fetch_array($rs1);
		?>
<li>
    <a href="#" onclick="funloadchatuserwindow('<?php echo encode($resListingl['id']); ?>');"
        class="media <?php if($visitormsg['adminChatStatus']=='1'){?>newmsg<?php } ?>">

        <div class="media-body">
            <div class="media-title font-weight-semibold">User-<?php echo $resListingl['id']; ?></div>
            <span class="text-muted font-size-sm"><?php echo $resListingl['city'].', '.$resListingl['country']; ?> -
                <?php echo makedatetime(strtotime($resListingl["updatedDateTime"])); ?>
                (<?php echo countlisting('id','visitorChat','where sessionId='.$resListingl['sessionId'].''); ?>)</span>
        </div>
        <div class="align-self-center ml-3">
            <span class="badge badge-mark bg-success border-success"></span>
        </div>
    </a>
</li>
<?php $n++; } ?>
<script>
$('#totalusers').text('<?php echo $n; ?>');
</script>
<?php if($n=='0' || $n==''){ ?>
<div style="padding:20px; text-align:center;">No Online Visitor</div>
<?php } ?>
<?php } ?>



<?php if($_REQUEST['action']=='showallliveusertoday'){ ?>
<?php
										$n=0;
										 $listofurls='';
	  	$selectl='';
		$wherel='';
		$rsl='';
		$selectl='*';
		$wherel=' DATE(updatedDateTime)="'.date('Y-m-d').'" and sessionId in (select sessionId from visitorChat where msgType=2) order by id desc';
		$rsl=GetPageRecord($selectl,'liveVisitorMaster',$wherel);
		while($resListingl=mysqli_fetch_array($rsl)){
		$chattoday=countlisting('id','visitorChat','where sessionId='.$resListingl['sessionId'].' ');
		if($chattoday>0){
		?>
<li>
    <a href="page.de?section=activechat&s=<?php echo encode($resListingl['id']); ?>&a=1" class="media">

        <div class="media-body">
            <div class="media-title font-weight-semibold">User-<?php echo $resListingl['id']; ?></div>
            <span class="text-muted font-size-sm"><?php echo $resListingl['city'].', '.$resListingl['country']; ?> -
                <?php echo makedatetime(strtotime($resListingl["updatedDateTime"])); ?>
                (<?php echo $chattoday; ?>)</span>
        </div>
        <div class="align-self-center ml-3">

        </div>
    </a>
</li>
<?php $n++; } } ?>
<script>
$('#totalusers').text('<?php echo $n; ?>');
</script>
<?php if($n=='0' || $n==''){ ?>
<div style="padding:20px; text-align:center;">No Today's Chat</div>
<?php } ?>
<?php } ?>





<?php if($_REQUEST['action']=='loadchatwindowuser' && $_REQUEST['id']!=''){

$id=decode($_REQUEST['id']);


$select1='*';
$where1='id='.$id.'';
$rs1=GetPageRecord($select1,'liveVisitorMaster',$where1);
$editresult=mysqli_fetch_array($rs1);
 ?>


<div class="card-header header-elements-inline">
    <h6 class="card-title" style="position:relative; width:100%;">User-<?php echo $editresult['id']; ?> /
        <?php echo $editresult['city'].', '.$editresult['country']; ?> /
        <?php echo makedatetime(strtotime($editresult["updatedDateTime"])); ?> / <?php echo $editresult['userIP']; ?>
        <div style="position:absolute; right:0px; top:0px;"><a href="<?php echo $editresult['pageURL']; ?>"
                target="_blank" id="visitedurl">Visitor URL</a></div>
    </h6>

</div>

<div class="card-body">
    <ul class="media-list media-chat media-chat-scrollable mb-3" id="loadusermsgdiv"
        style="max-height:430px; overflow:auto;    min-height: 430px;">


        <?php
										$n=0;
										$listofurls='';
										$selectl='';
										$wherel='';
										$rsl='';
										$selectl='*';
										$wherel=' sessionId='.$editresult['sessionId'].' order by id asc';
										$rsl=GetPageRecord($selectl,'visitorChat',$wherel);
										while($chatdata=mysqli_fetch_array($rsl)){
										?>

        <?php if($chatdata['msgType']=='2'){ ?>
        <li class="media">
            <div class="media-body">
                <div class="media-chat-item"><?php echo stripslashes($chatdata['msg']); ?></div>
                <div class="font-size-sm text-muted mt-2">
                    <?php echo date('F j, Y, h:i a',strtotime($chatdata['dateTime'])); ?></div>
            </div>
        </li>
        <?php } ?>

        <?php if($chatdata['msgType']=='1'){ ?>
        <li class="media media-chat-item-reverse">
            <div class="media-body">
                <div class="media-chat-item"><?php echo stripslashes($chatdata['msg']); ?></div>
                <div class="font-size-sm text-muted mt-2">
                    <?php echo date('F j, Y, h:i a',strtotime($chatdata['dateTime'])); ?></div>
            </div>
            <div class="ml-3"></div>
        </li>
        <?php  } $lastmsgid=$chatdata['id'];  }


												$where='sessionId='.$editresult['sessionId'].'';
												$namevalue ='adminChatStatus=0';
												updatelisting('visitorChat',$namevalue,$where);
										 ?>

    </ul>
    <?php if($_REQUEST['a']!='1'){ ?>
    <input name="msg" autocomplete="off" type="text" class="form-control mb-3" id="msg" style="    font-size: 16px;
    padding: 13px;" value="" size="1" placeholder="Enter your message..." />

    <input name="lastmsgid" id="lastmsgid" type="hidden" value="<?php echo $lastmsgid; ?>" />

    <div class="d-flex align-items-center">


        <button onclick="sendmsg();" type="button" class="btn bg-teal-400 btn-labeled btn-labeled-right ml-auto"><b><i
                    class="icon-paperplane"></i></b> Send</button>
    </div><?php } ?>
</div>

<script>
function sendmsg() {
    var msg = encodeURI($('#msg').val());
    if (msg != '') {
        $('#msg').val('');
        $('#msgactiondiv').load('loadaction.php?action=msgtouser&msg=' + msg +
            '&sessionId=<?php echo $editresult['sessionId']; ?>&msgType=1');
    }
}


$("#msg").keypress(function(e) {
    if (e.which == 13) {
        sendmsg()
    }
});
$("#loadusermsgdiv").animate({
    scrollTop: $('#loadusermsgdiv').prop("scrollHeight")
}, 1000);

clearInterval(idinter);

var idinter = setInterval(function() {
    var lastmsgid = $('#lastmsgid').val();
    $('#msgactiondiv').load(
        'loadaction.php?action=getusermsg&sessionId=<?php echo $editresult['sessionId']; ?>&lastmsgid=' +
        lastmsgid);
}, 3000);
</script>
<div id="msgactiondiv" style="display:none;"></div>


<?php } ?>





<?php if($_REQUEST['action']=='getusermsg' && $_REQUEST['sessionId']!='' && $_REQUEST['lastmsgid']!=''){

$n=0;
$listofurls='';
$selectl='';
$wherel='';
$rsl='';
$selectl='*';
$wherel=' sessionId='.$_REQUEST['sessionId'].' and msgType=2 and id>'.$_REQUEST['lastmsgid'].' order by id asc limit 0,1';
$rsl=GetPageRecord($selectl,'visitorChat',$wherel);
while($chatdata=mysqli_fetch_array($rsl)){

 ?>
<script>
$('#lastmsgid').val('<?php echo stripslashes($chatdata['id']); ?>');
$('#loadusermsgdiv').append(
    '<li class="media"><div class="media-body"><div class="media-chat-item"><?php echo stripslashes($chatdata['msg']); ?></div><div class="font-size-sm text-muted mt-2"><?php echo date('F j, Y, h:i a',strtotime($chatdata['dateTime'])); ?></div></div>'
    );
$("#loadusermsgdiv").animate({
    scrollTop: $('#loadusermsgdiv').prop("scrollHeight")
}, 1000);
</script>

<?php

$where='id="'.$chatdata['id'].'"';
$namevalue ='status=0';
updatelisting('visitorChat',$namevalue,$where);
 }

?>

<?php
 }

?>







<?php if($_REQUEST['action']=='msgtouser' && $_REQUEST['sessionId']!='' && $_REQUEST['msgType']!='' && trim($_REQUEST['msg'])!=''){

if($_REQUEST['automsg']=='1'){

$rsl='';
$selectl='*';
$wherel=' sessionId='.$_REQUEST['sessionId'].' and msgType=1 order by id asc limit 0,1';
$rsl=GetPageRecord($selectl,'visitorChat',$wherel);
while($chatdata=mysqli_fetch_array($rsl)){
$automsgyes='1';
}

if($automsgyes!='1'){
$namevalue ='sessionId="'.$_REQUEST['sessionId'].'",msgType="'.$_REQUEST['msgType'].'",msg="'.addslashes($_REQUEST['msg']).'",dateTime="'.date('Y-m-d H:i:s').'"';
addlisting('visitorChat',$namevalue);
}


} else {

$namevalue ='sessionId="'.$_REQUEST['sessionId'].'",msgType="'.$_REQUEST['msgType'].'",msg="'.addslashes($_REQUEST['msg']).'",dateTime="'.date('Y-m-d H:i:s').'"';
addlisting('visitorChat',$namevalue);


?>

<script>
$('#loadusermsgdiv').append(
    '<li class="media media-chat-item-reverse"><div class="media-body"><div class="media-chat-item"><?php echo $_REQUEST['msg']; ?></div><div class="font-size-sm text-muted mt-2"><?php echo date('F j, Y, h:i a',strtotime(date('Y-m-d H:i:s'))); ?></div></div><div class="ml-3"></div></li>'
    );

$("#loadusermsgdiv").animate({
    scrollTop: $('#loadusermsgdiv').prop("scrollHeight")
}, 1000);
</script>

<?php
}



 }

  ?>












<!--------------------------------webchat------------------------------------------->









<?php if($_REQUEST['action']=='msgtoadmin' && $_REQUEST['sessionId']!='' && $_REQUEST['msgType']!='' && trim($_REQUEST['msg'])!=''){
$namevalue ='sessionId="'.$_REQUEST['sessionId'].'",msgType="'.$_REQUEST['msgType'].'",msg="'.addslashes($_REQUEST['msg']).'",dateTime="'.date('Y-m-d H:i:s').'"';
addlisting('visitorChat',$namevalue);

?>

<script>
$('#wechatbox').append(
    '<div class="chatmsgouter"><div class="msgboxright"><?php echo stripslashes($_REQUEST['msg']); ?><i class="fa fa-arrow-right" aria-hidden="true"></i></div></div>'
    );
$("#wechatbox").animate({
    scrollTop: $('#wechatbox').prop("scrollHeight")
}, 1000);
</script>

<?php

 }

  ?>


<?php if($_REQUEST['action']=='getadminmsg' && $_REQUEST['sessionId']!=''){

$n=0;
$listofurls='';
$selectl='';
$wherel='';
$rsl='';
$selectl='*';
$wherel=' sessionId='.$_SESSION['sitevisitor'].' and status=1 and msgType=1 order by id asc';
$rsl=GetPageRecord($selectl,'visitorChat',$wherel);
while($chatdata=mysqli_fetch_array($rsl)){

 ?>
<script>
$('#wechatbox').append(
    '<div class="chatmsgouter"><div class="msgboxleft"><?php echo stripslashes($chatdata['msg']); ?><i class="fa fa-arrow-left" aria-hidden="true"></i></div></div>'
    );
$("#wechatbox").animate({
    scrollTop: $('#wechatbox').prop("scrollHeight")
}, 1000);

if (parent.$('#wechatboxfrm').css('display') == 'none') {
    parent.wechat();
    $("#wechatbox").animate({
        scrollTop: $('#wechatbox').prop("scrollHeight")
    }, 1000);
}
</script>

<?php

$where='id="'.$chatdata['id'].'"';
$namevalue ='status=0';
updatelisting('visitorChat',$namevalue,$where);
 }




$where='sessionId="'.$_SESSION['sitevisitor'].'"';
$namevalue ='sessionTime="'.date('Y-m-d H:i:s').'"';
$update = updatelisting('liveVisitorMaster',$namevalue,$where);

}

if($_REQUEST['action']=="getmaterialrequisition"){

$rs=GetPageRecord('*','queryMaster','id="'.$_REQUEST['styleId'].'"');
$editresultstyle=mysqli_fetch_array($rs);
@extract($editresultstyle);

$rs2=GetPageRecord('*',_BUYER_MASTER_,'id="'.$buyerId.'"');
$editresultstyle2=mysqli_fetch_array($rs2);
@extract($editresultstyle2);

$SampleTypeShortName = getSampleTypeName($_REQUEST['sampleType']);

?>

<div style="height:auto; margin-top:10px;">
    <div class="card border-left-3 border-left-danger-400 rounded-left-0"
        style="height: auto;border: 1px solid #e3e3e3 !important;  margin-bottom: 0px !important; background-color: #fdfdd6;">
        <div class="card-body">
            <div class="col-xl-12">
                <div class="media">
                    <div class="media-body" style="flex:auto !important; width:1% !important;">
                        <span class="text-muted">Buyer Short Name</span>
                        <div class="media-title font-weight-semibold">
                            <?php echo $buyerShortName;  ?>
                        </div>
                    </div>
                    <div class="media-body" style="flex:auto !important; width:1% !important;">
                        <span class="text-muted">Buyer Id</span>
                        <div class="media-title font-weight-semibold">
                            <?php echo $buyerId;  ?>
                        </div>
                    </div>
                    <div class="media-body" style="flex:auto !important; width:1% !important;">
                        <span class="text-muted">Brand</span>
                        <div class="media-title font-weight-semibold"><?php echo getBrandName($brandId); ?></div>
                    </div>
                    <div class="media-body" style="flex:auto !important; width:1% !important;">
                        <span class="text-muted">Season</span>
                        <div class="media-title font-weight-semibold"><?php echo getSeasonName($seasonId); ?></div>
                    </div>


                    <div class="media-body" style="flex:auto !important; width:1% !important;">
                        <span class="text-muted">Style</span>
                        <div class="media-title font-weight-semibold">#<?php echo $styleRefId; ?></div>
                    </div>


                    <div class="media-body" style="flex:auto !important; width:1% !important;">
                        <span class="text-muted">Category</span>
                        <div class="media-title font-weight-semibold"><?php echo getCategoryName($categoryId); ?></div>
                    </div>

                    <div class="media-body" style="flex:auto !important; width:1% !important;">
                        <span class="text-muted">Sub Category</span>
                        <div class="media-title font-weight-semibold"><?php echo getSubCategoryName($subCategoryId); ?>
                        </div>

                    </div>

                    <div class="media-body" style="flex:auto !important; width:1% !important;">
                        <span class="text-muted">Gender</span>
                        <div class="media-title font-weight-semibold"><?php echo getGenderName($gender); ?></div>

                    </div>





                    <!--<div class="media-body" style="flex:auto !important; width:1% !important;">
					<span class="text-muted">Buyer Style Ref. No.</span>
						<div class="media-title font-weight-semibold">
						-
						</div>
					</div>-->
                </div>
            </div>
        </div>
    </div>
</div>
<?php if($_REQUEST['edit']==''){

$rsCount=GetPageRecord('*','queryMaster','parentStyleId="'.$_REQUEST['styleId'].'" order by id desc');
$rsCountTotal=mysqli_num_rows($rsCount);
$rsCountTotal = $rsCountTotal+1;

?>
<script>
parent.$('#styleRefId').val('<?php echo $styleRefId.'_'.$rsCountTotal.'_'.$SampleTypeShortName.'_'.date('d/m/y'); ?>');
</script>
<?php
}
}

if($_REQUEST['action']=='loadshell'){

if($_REQUEST['add']==1){
$namevalueadd = 'addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",fabricType="shell",parentId="'.$_REQUEST['lastid'].'"';
addlistinggetlastid('samplingMaterialRequisition',$namevalueadd);
}

if($_REQUEST['deletestatus']=="yes" && $_REQUEST['id']!=''){
deleteRecord('samplingMaterialRequisition','id="'.$_REQUEST['id'].'"');
}

$totalqtyshell=0;
$rsList=GetPageRecord('*','samplingMaterialRequisition','1 and fabricType="shell" and parentId="'.$_REQUEST['lastid'].'"');
while($rsListData=mysqli_fetch_array($rsList)){
?>
<tr>
    <td style="width: 10%;">
        <select id="colorShell<?php echo $rsListData['id']; ?>" name="colorShell" class="form-control"
            onchange="submitValue<?php echo $rsListData['id']; ?>();">
            <option value="">Select</option>
            <?php
		$rs=GetPageRecord('*',_COLOR_CARD_MASTER_,'1 and deletestatus=0 order by name asc');
		while($resListing=mysqli_fetch_array($rs)){
		?>
            <option value="<?php echo $resListing['id']?>"
                <?php if($resListing['id']==$rsListData['colorId']){ echo "selected"; }?>>
                <?php echo $resListing['name']?></option>
            <?php } ?>
        </select>
    </td>
    <td><input type="text" name="size" value="<?php echo $rsListData['size']; ?>"
            id="size<?php echo $rsListData['id']; ?>" class="form-control"
            onkeyup="submitValue<?php echo $rsListData['id']; ?>();" /></td>
    <td>
        <div style="width: 80px;"><input type="number" name="qty" value="<?php echo $rsListData['qty']; ?>"
                id="qty<?php echo $rsListData['id']; ?>" class="form-control"
                onkeyup="submitValue<?php echo $rsListData['id']; ?>();" /></div>
    </td>
    <td>
        <div style="width: 200px;"><select name="supplierStore" id="supplierStore<?php echo $rsListData['id']; ?>"
                class="form-control" onchange="submitValue<?php echo $rsListData['id']; ?>();">
                <option value="">Select</option>
                <option value="0" <?php if($rsListData['supplierStore']=='0'){ echo "selected"; }?>>Store</option>
                <?php
			$rs=GetPageRecord('id,name','suppliersMaster','1 and deletestatus=0 order by name asc');
			while($resListing=mysqli_fetch_array($rs)){
			?>
                <option value="<?php echo $resListing['id']?>"
                    <?php if($resListing['id']==$rsListData['supplierStore']){ echo "selected"; }?>>
                    <?php echo $resListing['name']?></option>
                <?php } ?>
            </select></div>
    </td>
    <td>
        <select id="nominatedBy<?php echo $rsListData['id']; ?>" name="nominatedBy" class="form-control"
            onchange="submitValue<?php echo $rsListData['id']; ?>();">
            <option value="">Select</option>
            <option value="1" <?php if($rsListData['nominatedBy']=='1'){ echo 'selected'; }?>>Buyer</option>
            <option value="2" <?php if($rsListData['nominatedBy']=='2'){ echo 'selected'; }?>>Management</option>
        </select>
    </td>
    <td><input type="text" name="samplingY" value="<?php echo $rsListData['samplingY']; ?>"
            id="samplingY<?php echo $rsListData['id']; ?>" class="form-control"
            onkeyup="submitValue<?php echo $rsListData['id']; ?>();" /></td>
    <td><input type="text" name="avg" value="<?php echo $rsListData['avg']; ?>" id="avg<?php echo $rsListData['id']; ?>"
            class="form-control" onkeyup="submitValue<?php echo $rsListData['id']; ?>();" readonly /></td>
    <td><input type="text" name="estimatedPrice" value="<?php echo $rsListData['estimatedPrice']; ?>"
            id="estimatedPrice<?php echo $rsListData['id']; ?>" class="form-control"
            onkeyup="submitValue<?php echo $rsListData['id']; ?>();" /></td>
    <td><input type="text" name="estimatedValue" value="<?php echo $rsListData['estimatedValue']; ?>"
            id="estimatedValue<?php echo $rsListData['id']; ?>" class="form-control"
            onkeyup="submitValue<?php echo $rsListData['id']; ?>();" readonly /></td>
    <td> <input type="text" name="amount" value="<?php echo $rsListData['amount']; ?>"
            id="amount<?php echo $rsListData['id']; ?>" class="form-control"
            onkeyup="submitValue<?php echo $rsListData['id']; ?>();" /></td>
    <td><input type="text" name="detail" value="<?php echo $rsListData['billDetail']; ?>"
            id="detail<?php echo $rsListData['id']; ?>" class="form-control"
            onkeyup="submitValue<?php echo $rsListData['id']; ?>();" /></td>
    <td style="text-align:center;"><i class="fa fa-trash" style="font-size:20px;cursor:pointer; color:#FF0000;"
            onclick="deleteRow('<?php echo $rsListData['id']; ?>');"></i></td>
</tr>

<script>
function submitValue<?php echo $rsListData['id']; ?>() {
    var id = '<?php echo $rsListData['id']; ?>';
    var colorShell = $('#colorShell<?php echo $rsListData['id']; ?>').val();
    var size = encodeURI($('#size<?php echo $rsListData['id']; ?>').val());
    var samplingY = $('#samplingY<?php echo $rsListData['id']; ?>').val();
    var qty = $('#qty<?php echo $rsListData['id']; ?>').val();
    var supplierStore = $('#supplierStore<?php echo $rsListData['id']; ?>').val();
    var nominatedBy = $('#nominatedBy<?php echo $rsListData['id']; ?>').val();
    var amount = $('#amount<?php echo $rsListData['id']; ?>').val();
    var detail = $('#detail<?php echo $rsListData['id']; ?>').val();
    var countavg = Number(parseFloat(qty * samplingY).toFixed(2));
    $('#avg<?php echo $rsListData['id']; ?>').val(countavg);
    var avg = $('#avg<?php echo $rsListData['id']; ?>').val();
    var estimatedPrice = $('#estimatedPrice<?php echo $rsListData['id']; ?>').val();
    var countval = Number(parseFloat(avg * estimatedPrice).toFixed(2));
    $('#estimatedValue<?php echo $rsListData['id']; ?>').val(countval);
    var estimatedValue = $('#estimatedValue<?php echo $rsListData['id']; ?>').val();

    $('#savedata').load('allaction.php?action=saverequisitionshelldata&id=' + id + '&colorShell=' + colorShell +
        '&samplingY=' + samplingY + '&qty=' + qty + '&avg=' + avg + '&estimatedPrice=' + estimatedPrice +
        '&estimatedValue=' + estimatedValue + '&size=' + size + '&supplierStore=' + supplierStore +
        '&nominatedBy=' + nominatedBy + '&amount=' + amount + '&detail=' + detail);
}
</script>

<?php

}
?>

<?
}

if($_REQUEST['action']=='loadlining'){

if($_REQUEST['add']==1){
$namevalueadd = 'addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",fabricType="lining",parentId="'.$_REQUEST['lastid'].'"';
addlistinggetlastid('samplingMaterialRequisition',$namevalueadd);
}

if($_REQUEST['deletestatus']=="yes" && $_REQUEST['id']!=''){
deleteRecord('samplingMaterialRequisition','id="'.$_REQUEST['id'].'"');
}


$rsList=GetPageRecord('*','samplingMaterialRequisition','1 and fabricType="lining" and parentId="'.$_REQUEST['lastid'].'"');
while($rsListData=mysqli_fetch_array($rsList)){
?>
<tr>
    <td style="width: 10%;">
        <select id="colorLining2<?php echo $rsListData['id']; ?>" name="colorLining2" class="form-control"
            onchange="submitValue2<?php echo $rsListData['id']; ?>();">
            <option value="">Select</option>
            <?php
		$rs=GetPageRecord('*',_COLOR_CARD_MASTER_,'1 and deletestatus=0 order by name asc');
		while($resListing=mysqli_fetch_array($rs)){
		?>
            <option value="<?php echo $resListing['id']?>"
                <?php if($resListing['id']==$rsListData['colorId']){ echo "selected"; }?>>
                <?php echo $resListing['name']?></option>
            <?php } ?>
        </select>
    </td>
    <td><input type="text" name="size2" value="<?php echo $rsListData['size']; ?>"
            id="size2<?php echo $rsListData['id']; ?>" class="form-control"
            onkeyup="submitValue2<?php echo $rsListData['id']; ?>();" /></td>
    <td>
        <div style="width: 80px;"><input type="number" name="qty2" value="<?php echo $rsListData['qty']; ?>"
                id="qty2<?php echo $rsListData['id']; ?>" class="form-control"
                onkeyup="submitValue2<?php echo $rsListData['id']; ?>();" /></div>
    </td>
    <td>
        <div style="width: 200px;"><select name="supplierStore2" id="supplierStore2<?php echo $rsListData['id']; ?>"
                class="form-control" onchange="submitValue2<?php echo $rsListData['id']; ?>();">
                <option value="">Select</option>
                <option value="0" <?php if($rsListData['supplierStore']=='0'){ echo "selected"; }?>>Store</option>
                <?php
			$rs=GetPageRecord('id,name','suppliersMaster','1 and deletestatus=0 order by name asc');
			while($resListing=mysqli_fetch_array($rs)){
			?>
                <option value="<?php echo $resListing['id']?>"
                    <?php if($resListing['id']==$rsListData['supplierStore']){ echo "selected"; }?>>
                    <?php echo $resListing['name']?></option>
                <?php } ?>
            </select></div>
    </td>
    <td>
        <select id="nominatedBy2<?php echo $rsListData['id']; ?>" name="nominatedBy2" class="form-control"
            onchange="submitValue2<?php echo $rsListData['id']; ?>();">
            <option value="">Select</option>
            <option value="1" <?php if($rsListData['nominatedBy']=='1'){ echo 'selected'; }?>>Buyer</option>
            <option value="2" <?php if($rsListData['nominatedBy']=='2'){ echo 'selected'; }?>>Management</option>
        </select>
    </td>
    <td><input type="text" name="samplingY2" value="<?php echo $rsListData['samplingY']; ?>"
            id="samplingY2<?php echo $rsListData['id']; ?>" class="form-control"
            onkeyup="submitValue2<?php echo $rsListData['id']; ?>();" /></td>
    <td><input type="text" name="avg2" value="<?php echo $rsListData['avg']; ?>"
            id="avg2<?php echo $rsListData['id']; ?>" class="form-control"
            onkeyup="submitValue2<?php echo $rsListData['id']; ?>();" readonly /></td>
    <td><input type="text" name="estimatedPrice2" value="<?php echo $rsListData['estimatedPrice']; ?>"
            id="estimatedPrice2<?php echo $rsListData['id']; ?>" class="form-control"
            onkeyup="submitValue2<?php echo $rsListData['id']; ?>();" /></td>
    <td><input type="text" name="estimatedValue2" value="<?php echo $rsListData['estimatedValue']; ?>"
            id="estimatedValue2<?php echo $rsListData['id']; ?>" class="form-control"
            onkeyup="submitValue2<?php echo $rsListData['id']; ?>();" readonly /></td>
    <td> <input type="text" name="amount2" value="<?php echo $rsListData['amount']; ?>"
            id="amount2<?php echo $rsListData['id']; ?>" class="form-control"
            onkeyup="submitValue2<?php echo $rsListData['id']; ?>();" /></td>
    <td><input type="text" name="detail2" value="<?php echo $rsListData['billDetail']; ?>"
            id="detail2<?php echo $rsListData['id']; ?>" class="form-control"
            onkeyup="submitValue2<?php echo $rsListData['id']; ?>();" /></td>
    <td style="text-align:center;"><i class="fa fa-trash" style="font-size:20px;cursor:pointer; color:#FF0000; "
            onclick="deleteliningRow('<?php echo $rsListData['id']; ?>');"></i></td>
</tr>
<script>
function submitValue2<?php echo $rsListData['id']; ?>() {
    var id2 = '<?php echo $rsListData['id']; ?>';
    var colorLining2 = $('#colorLining2<?php echo $rsListData['id']; ?>').val();
    var size2 = encodeURI($('#size2<?php echo $rsListData['id']; ?>').val());
    var samplingY2 = $('#samplingY2<?php echo $rsListData['id']; ?>').val();
    var qty2 = $('#qty2<?php echo $rsListData['id']; ?>').val();
    var nominatedBy2 = $('#nominatedBy2<?php echo $rsListData['id']; ?>').val();
    var amount2 = $('#amount2<?php echo $rsListData['id']; ?>').val();
    var detail2 = $('#detail2<?php echo $rsListData['id']; ?>').val();
    var supplierStore2 = $('#supplierStore2<?php echo $rsListData['id']; ?>').val();
    var countavg2 = Number(parseFloat(qty2 * samplingY2).toFixed(2));
    $('#avg2<?php echo $rsListData['id']; ?>').val(countavg2);
    var avg2 = $('#avg2<?php echo $rsListData['id']; ?>').val();
    var estimatedPrice2 = $('#estimatedPrice2<?php echo $rsListData['id']; ?>').val();
    var countval2 = Number(parseFloat(avg2 * estimatedPrice2).toFixed(2));
    $('#estimatedValue2<?php echo $rsListData['id']; ?>').val(countval2);
    var estimatedValue2 = $('#estimatedValue2<?php echo $rsListData['id']; ?>').val();

    $('#savedata').load('allaction.php?action=saverequisitionliningdata&id=' + id2 + '&colorLining=' + colorLining2 +
        '&samplingY=' + samplingY2 + '&qty=' + qty2 + '&avg=' + avg2 + '&estimatedPrice=' + estimatedPrice2 +
        '&estimatedValue=' + estimatedValue2 + '&size=' + size2 + '&supplierStore=' + supplierStore2 +
        '&nominatedBy2=' + nominatedBy2 + '&amount2=' + amount2 + '&detail2=' + detail2);
}
</script>
<?php
}

}

if($_REQUEST['action']=='sampletypeaction' && $_REQUEST['id']!=''){

$id = $_REQUEST['id'];
$sampleId = $_REQUEST['sampleType'];
?>
<option value="">Select</option>
<?php
$rsList=GetPageRecord('id,name','sampleTypeMaster','prodStageId="'.$id.'" order by id asc');
while($sampleType=mysqli_fetch_array($rsList)){
?>
<option value="<?php echo $sampleType['id']; ?>" <?php if($sampleType['id']==$sampleId){ echo 'selected'; }?>>
    <?php echo $sampleType['name']; ?></option>
<?php
}
}


if($_REQUEST['action']=="loadsamplehidediv"){

$rsList11=GetPageRecord('*','samplingRequisitionMaster','1 and productionStage="'.$_REQUEST['prodStage'].'" and sampleType="'.$_REQUEST['sampleType'].'" and styleId="'.$_REQUEST['styleId'].'"');
$result=mysqli_fetch_array($rsList11);
$count=mysqli_num_rows($rsList11);
if($count>0){
?>

<table width="100%" border="1" cellspacing="2" cellpadding="5"
    style="border:2px solid #ccc;margin-top:10px; padding:10px;display:non1e;">
    <tr style=" font-weight:700; text-align:left; background-color:#e8fff9;">
        <td>Shell Color</td>
        <td>Size/Sizes</td>
        <td>Qty.</td>
        <td>Store/Supplier</td>
        <td>Nominated By</td>
        <td>Sampling Shell YY</td>
        <td>Shell</td>
        <td>Estimated Price/Meter</td>
        <td>Estimated Value</td>
        <td>Amount</td>
        <td>Bill Detail</td>
    </tr>
    <?php
$rsList=GetPageRecord('*','samplingMaterialRequisition','parentId="'.$result['id'].'" and fabricType="shell"');
while($rsListData=mysqli_fetch_array($rsList)){
$rs=GetPageRecord('name',_COLOR_CARD_MASTER_,'id="'.$rsListData['colorId'].'"');
$resListing=mysqli_fetch_array($rs);
?>
    <tr>
        <td style="width: 15%;"><?php echo $resListing['name']; ?></td>
        <td><?php echo $rsListData['size']; ?></td>
        <td><?php echo $rsListData['qty']; ?></td>
        <td><?php
	$rs=GetPageRecord('id,name','suppliersMaster','id="'.$rsListData['supplierStore'].'"');
	$resListing=mysqli_fetch_array($rs);
	 echo $resListing['name']; ?>
        </td>
        <td>-</td>
        <td><?php echo $rsListData['samplingY']; ?></td>
        <td><?php echo $rsListData['avg']; ?></td>
        <td><?php echo $rsListData['estimatedPrice']; ?></td>
        <td><?php echo $rsListData['estimatedValue']; ?></td>
        <td>-</td>
        <td>-</td>
    </tr>
    <?php } ?>
    <tr style="font-weight:700; text-align:left; background-color:#e8e8e8;">
        <td></td>
        <td>Total</td>
        <td><span id="shellTotal"></span></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>

<table width="100%" border="1" cellspacing="2" cellpadding="5"
    style="border:2px solid #ccc;margin-top:10px; padding:10px;display:n1one;">
    <tr style="font-weight:700; text-align:left; background-color:#e8fff9;">
        <td>Lining Color</td>
        <td>Size/Sizes</td>
        <td>Qty.</td>
        <td>Store/Supplier</td>
        <td>Nominated By</td>
        <td>Sampling Lining YY</td>
        <td>Lining</td>
        <td>Estimated Price/Meter</td>
        <td>Estimated Value</td>
        <td>Amount</td>
        <td>Bill Detail</td>
    </tr>
    <?php
				$rsList2=GetPageRecord('*','samplingMaterialRequisition','parentId="'.$result['id'].'" and fabricType="lining"');
				while($rsListData2=mysqli_fetch_array($rsList2)){

				$rs2=GetPageRecord('name',_COLOR_CARD_MASTER_,'id="'.$rsListData2['colorId'].'"');
				$resListing2=mysqli_fetch_array($rs2);
				?>
    <tr>
        <td style="width: 15%;"><?php echo $resListing2['name']; ?></td>
        <td><?php echo $rsListData2['size']; ?></td>
        <td><?php echo $rsListData2['qty']; ?></td>
        <td><?php
					$rs2=GetPageRecord('id,name','suppliersMaster','id="'.$rsListData2['supplierStore'].'"');
					$resListing2=mysqli_fetch_array($rs2);
					 echo $resListing2['name']; ?>
        </td>
        <td>-</td>
        <td><?php echo $rsListData2['samplingY']; ?></td>
        <td><?php echo $rsListData2['avg']; ?></td>
        <td><?php echo $rsListData2['estimatedPrice']; ?></td>
        <td><?php echo $rsListData2['estimatedValue']; ?></td>
        <td>-</td>
        <td>-</td>
    </tr>
    <?php } ?>
    <tr style="font-weight:700; text-align:left; background-color:#e8e8e8;">
        <td></td>
        <td>Total</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>

<?php
}
}

if($_REQUEST['action']=='loadlinelayout'){
$styleId=decode($_REQUEST['styleId']);

if($_REQUEST['add']==1){
	$dateAdded=date('Y-m-d');
	$namevalue ='styleId="'.$styleId.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'"';
	$lastId = addlistinggetlastid('lineLayoutMaster',$namevalue);
}

if($_REQUEST['deletestatus']=="yes" && $_REQUEST['id']!=''){
	deleteRecord('lineLayoutMaster','id="'.$_REQUEST['id'].'"');
}

$sno=1;
$rsList=GetPageRecord('*','lineLayoutMaster','1 and styleId="'.$styleId.'" order by id desc');
$count = mysqli_num_rows($rsList);
while($rsListData=mysqli_fetch_array($rsList)){
?>
<tr>
    <td>
        <div align="center"><?php echo $sno; ?></div>
    </td>
    <td>
        <div align="center"><input name="grade" type="text" class="form-control validate"
                id="grade<?php echo $rsListData['id']; ?>"
                value="<?php echo str_replace('%','+',$rsListData['grade']); ?>"
                onkeyup="submitValue<?php echo $rsListData['id']; ?>();"></div>
    </td>
    <td>
        <div align="center"><input name="attachment" type="text" class="form-control validate"
                id="attachment<?php echo $rsListData['id']; ?>" value="<?php echo $rsListData['attachment']; ?>"
                onkeyup="submitValue<?php echo $rsListData['id']; ?>();"></div>
    </td>
    <td>
        <div align="center"><input name="allocateMc" type="text" class="form-control validate"
                id="allocateMc<?php echo $rsListData['id']; ?>" value="<?php echo $rsListData['allocateMc']; ?>"
                onkeyup="submitValue<?php echo $rsListData['id']; ?>();"></div>
    </td>
    <td>
        <div align="center">
            <select name="machine" id="machine<?php echo $rsListData['id']; ?>" class="form-control validate"
                onchange="submitValue<?php echo $rsListData['id']; ?>();">
                <option value="">Select</option>
                <?php
	$abc=GetPageRecord('*','machineMaster','1 and status=1 and deletestatus=0 order by name asc');
	while($machine=mysqli_fetch_array($abc)) {

	?>
                <option value="<?php echo $machine['id']?>"
                    <?php if($machine['id']==$rsListData['machineId']){ echo "selected"; }?>>
                    <?php echo $machine['name'] ?>
                </option>
                <?php } ?>
            </select>
        </div>
    </td>

    <td>
        <div align="center">
            <select name="operation" id="operation<?php echo $rsListData['id']; ?>" class="form-control validate"
                onchange="submitValue<?php echo $rsListData['id']; ?>();">
                <option value="">Select</option>
                <?php
	$abc=GetPageRecord('*','assemblyoperationsMaster','1 and status=1 and deletestatus=0 order by name asc');
	while($critical=mysqli_fetch_array($abc)) {

	?>
                <option value="<?php echo $critical['id']?>"
                    <?php if($critical['id']==$rsListData['operationId']){ echo "selected"; }?>>
                    <?php echo $critical['name'] ?>
                </option>
                <?php } ?>
            </select>
        </div>
    </td>
    <td>
        <div align="center">
            <select name="operationb" id="operationb<?php echo $rsListData['id']; ?>" class="form-control validate"
                onchange="submitValue<?php echo $rsListData['id']; ?>();">
                <option value="">Select</option>
                <?php
	$abc=GetPageRecord('*','assemblyoperationsMaster','1 and status=1 and deletestatus=0 order by name asc');
	while($critical=mysqli_fetch_array($abc)) {

	?>
                <option value="<?php echo $critical['id']?>"
                    <?php if($critical['id']==$rsListData['operationIdb']){ echo "selected"; }?>>
                    <?php echo $critical['name'] ?>
                </option>
                <?php } ?>
            </select>
        </div>
    </td>
    <td>
        <div align="center">
            <select name="machineb" id="machineb<?php echo $rsListData['id']; ?>" class="form-control validate"
                onchange="submitValue<?php echo $rsListData['id']; ?>();">
                <option value="">Select</option>
                <?php
	$abc=GetPageRecord('*','machineMaster','1 and status=1 and deletestatus=0 order by name asc');
	while($machine=mysqli_fetch_array($abc)) {

	?>
                <option value="<?php echo $machine['id']?>"
                    <?php if($machine['id']==$rsListData['machineIdb']){ echo "selected"; }?>>
                    <?php echo $machine['name'] ?>
                </option>
                <?php } ?>
            </select>
        </div>
    </td>
    <td>
        <div align="center"><input name="allocateMcb" type="text" class="form-control validate"
                id="allocateMcb<?php echo $rsListData['id']; ?>" value="<?php echo $rsListData['allocateMcb']; ?>"
                onkeyup="submitValue<?php echo $rsListData['id']; ?>();"></div>
    </td>
    <td>
        <div align="center"><input name="attachmentb" type="text" class="form-control validate"
                id="attachmentb<?php echo $rsListData['id']; ?>" value="<?php echo $rsListData['attachmentb']; ?>"
                onkeyup="submitValue<?php echo $rsListData['id']; ?>();"></div>
    </td>
    <td>
        <div align="center"><input name="gradeb" type="text" class="form-control validate"
                id="gradeb<?php echo $rsListData['id']; ?>"
                value="<?php echo str_replace('%','+',$rsListData['gradeb']); ?>"
                onkeyup="submitValue<?php echo $rsListData['id']; ?>();"></div>
    </td>
    <!--<td> <div align="center"> </div></td>-->
    <td>
        <div align="center"></div><i class="icon-trash" style="font-size:18px;cursor:pointer; color:#FF0000;"
            onclick="deleteRow('<?php echo $rsListData['id']; ?>');"></i>
    </td>
</tr>

<script>
function submitValue<?php echo $rsListData['id']; ?>() {

    var id = '<?php echo $rsListData['id']; ?>';

    var grade = $('#grade<?php echo $rsListData['id']; ?>').val();
    var gradea = grade.replace("+", "%");
    var gradeb = $('#gradeb<?php echo $rsListData['id']; ?>').val();
    var gradec = gradeb.replace("+", "%");
    var attachment = $('#attachment<?php echo $rsListData['id']; ?>').val();
    var attachmentb = $('#attachmentb<?php echo $rsListData['id']; ?>').val();
    var allocateMc = $('#allocateMc<?php echo $rsListData['id']; ?>').val();
    var allocateMcb = $('#allocateMcb<?php echo $rsListData['id']; ?>').val();
    var machine = $('#machine<?php echo $rsListData['id']; ?>').val();
    var machineb = $('#machineb<?php echo $rsListData['id']; ?>').val();
    var operation = $('#operation<?php echo $rsListData['id']; ?>').val();
    var operationb = $('#operationb<?php echo $rsListData['id']; ?>').val();



    $('#savedata').load('allaction.php?action=linelayout&id=' + id + '&grade=' + gradea + '&gradeb=' + gradec +
        '&attachment=' + attachment + '&attachmentb=' + attachmentb + '&allocateMc=' + allocateMc +
        '&allocateMcb=' + allocateMcb + '&machine=' + machine + '&operation=' + operation + '&operationb=' +
        operationb + '&machineb=' + machineb);
}
</script>

<?php

$sno++; }
if($count=='0'){ ?>
<tr>
    <td colspan="13">
        <div style="text-align: center;">No Record Found</div>
    </td>
</tr>
<?php }

}


if($_REQUEST['action']=='cdnstyle'){

$parentId= decode($_REQUEST['parentId']);

if($_REQUEST['add']==1){
	$dateAdded=date('Y-m-d');
	$namevalue ='parentId="'.$parentId.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'"';
	$lastId = addlistinggetlastid('cdnStyleMaster',$namevalue);
}

if($_REQUEST['deletestatus']=="yes" && $_REQUEST['id']!=''){
	deleteRecord('cdnStyleMaster','id="'.$_REQUEST['id'].'"');
}

$sno=1;
//echo '1 and parentId="'.$parentId.'" order by id desc';
$rsList=GetPageRecord('*','cdnStyleMaster','1 and parentId="'.$parentId.'" order by id desc');
$count = mysqli_num_rows($rsList);
while($rsListData=mysqli_fetch_array($rsList)){
?>
<tr>
    <td>
        <div align="center"></div><i class="fa fa-trash" style="font-size:18px;cursor:pointer; color:#FF0000;"
            onclick="deleteRow('<?php echo $rsListData['id']; ?>');"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span
            style="font-weight: 500"><?php echo $sno; ?>.</span>
    </td>
    <td>

        <div align="center" style=" width: 100px;">
            <select name="style" style="width:100px" id="style<?php echo $rsListData['id']; ?>"
                class="form-control validate"
                onchange="submitValue<?php echo $rsListData['id']; ?>();changeStyle<?php echo $rsListData['id']; ?>();changeReq<?php echo $rsListData['id']; ?>();">
                <option value="">Select</option>
                <?php
	$rs=GetPageRecord('*','queryMaster','1 and deletestatus=0 and subject!="" and sampleStyle=1 order by id asc');
											while($resultStyle=mysqli_fetch_array($rs)){
											?>
                <option value="<?php echo $resultStyle['id']; ?>"
                    <?php if($rsListData['styleId']==$resultStyle['id']){ echo "selected"; }?>>
                    <?php echo '#'.$resultStyle['styleRefId']; ?></option>
                <?php } ?>
            </select>
        </div>

    </td>

    <?php if($_REQUEST['module']=='cdn'){ ?><td>
        <div align="center">
            <select name="indent" style="width:115px;" id="indent<?php echo $rsListData['id']; ?>" class="form-control"
                onchange="submitValue<?php echo $rsListData['id']; ?>();">
                <option value="">Select</option>
                <?php
	$rs=GetPageRecord('*','indentCreationMaster','1 and poNumber!="" ');
	while($resultStyle=mysqli_fetch_array($rs)){
	?>
                <option value="<?php echo $resultStyle['id']; ?>"
                    <?php if($rsListData['indentNo']==$resultStyle['id']){ echo "selected"; }?>>
                    <?php echo $resultStyle['poNumber']; ?> [<?php echo getStyleRefId($resultStyle['styleId']); ?>]</option>
                <?php } ?>
            </select>
        </div>
    </td>
    <?php } ?>

    <?php if($_REQUEST['module']=='samplecdn'){ ?><td>

        <div align="center" style=" width: auto;">
            <select name="requisition" style="width:100px"
                onchange="submitValue<?php echo $rsListData['id']; ?>();changesample<?php echo $rsListData['id']; ?>();"
                id="requisition<?php echo $rsListData['id']; ?>" class="form-control validate">
                <option value="">Select</option>
            </select>
        </div>

    </td>
    <?php } ?>


    <?php if($_REQUEST['module']=='samplecdn'){ ?><td>
        <div align="center" id="sample<?php echo $rsListData['id']; ?>"></div>
    </td><?php }  ?>

    <?php if($_REQUEST['module']=='cdn' || $_REQUEST['module']=='samplecdn'){ ?><td>
        <div align="center" id="description<?php echo $rsListData['id']; ?>"></div>
    </td><?php }  ?>

    <?php if($_REQUEST['module']=='cdn'){ ?><td>
        <div align="center"><input name="hsn" type="text" class="form-control validate"
                id="hsn<?php echo $rsListData['id']; ?>" value="<?php echo $rsListData['hsnCode'] ?>"
                onkeyup="submitValue<?php echo $rsListData['id']; ?>();"></div>
    </td><?php }  ?>

    <?php if($_REQUEST['module']=='cdn'){ ?><td>
        <div align="center"><input name="invoice" type="text" class="form-control validate"
                id="invoice<?php echo $rsListData['id']; ?>" value="<?php echo $rsListData['invoiceNo'] ?>"
                onkeyup="submitValue<?php echo $rsListData['id']; ?>();"></div>
    </td><?php }  ?>

    <?php if($_REQUEST['module']=='cdn'){ ?><td>
        <div align="center"><input name="asn" type="text" class="form-control validate"
                id="asn<?php echo $rsListData['id']; ?>" value="<?php echo $rsListData['asnNo'] ?>"
                onkeyup="submitValue<?php echo $rsListData['id']; ?>();"></div>
    </td><?php }  ?>

    <?php if($_REQUEST['module']=='cdn'){ ?><td>
        <div align="center"><input name="bpo" type="text" class="form-control validate"
                id="bpo<?php echo $rsListData['id']; ?>" value="<?php echo $rsListData['bpoNo'] ?>"
                onkeyup="submitValue<?php echo $rsListData['id']; ?>();"></div>
    </td><?php }  ?>

    <?php if($_REQUEST['module']=='cdn'){ ?><td>
        <div align="center"><input name="destination" type="text" class="form-control validate"
                id="destination<?php echo $rsListData['id']; ?>" value="<?php echo $rsListData['destCenter'] ?>"
                onkeyup="submitValue<?php echo $rsListData['id']; ?>();"></div>
    </td><?php }  ?>

    <?php if($_REQUEST['module']=='cdn' || $_REQUEST['module']=='samplecdn'){ ?><td>
        <div style="width: 65px;" align="center"><input name="quantity" type="number" min="0"
                class="form-control validate" id="quantity<?php echo $rsListData['id']; ?>"
                value="<?php echo $rsListData['qty'] ?>" onkeyup="submitValue<?php echo $rsListData['id']; ?>();"></div>
    </td><?php }  ?>

    <?php if($_REQUEST['module']=='cdn' || $_REQUEST['module']=='samplecdn'){ ?><td>
        <div style="width: 65px;" align="center"><input name="amount" min="0" type="number"
                class="form-control validate" id="amount<?php echo $rsListData['id']; ?>"
                value="<?php echo $rsListData['amnt'] ?>" onkeyup="submitValue<?php echo $rsListData['id']; ?>();">
        </div>
    </td><?php }  ?>

    <?php if($_REQUEST['module']=='samplecdn'){ ?><td>
        <div align="center"><input name="value" type="text" class="form-control validate"
                id="value<?php echo $rsListData['id']; ?>" value="<?php echo $rsListData['value']; ?>"
                onkeyup="submitValue<?php echo $rsListData['id']; ?>();" readonly></div>
    </td><?php }  ?>


    <?php if($_REQUEST['module']=='cdn' || $_REQUEST['module']=='samplecdn'){ ?><td>
        <div align="center"><input name="packagesno" type="text" class="form-control validate"
                id="packagesno<?php echo $rsListData['id']; ?>" value="<?php echo $rsListData['packageNo'] ?>"
                onkeyup="submitValue<?php echo $rsListData['id']; ?>();"></div>
    </td><?php }  ?>

    <?php if($_REQUEST['module']=='cdn'){ ?><td>
        <div align="center"><input name="packagesnform" type="text" class="form-control validate"
                id="packagesform<?php echo $rsListData['id']; ?>" value="<?php echo $rsListData['pckgFrom'] ?>"
                onkeyup="submitValue<?php echo $rsListData['id']; ?>();"></div>
    </td><?php }  ?>

    <?php if($_REQUEST['module']=='cdn'){ ?><td>
        <div align="center"><input name="packagesto" type="text" class="form-control validate"
                id="packagesto<?php echo $rsListData['id']; ?>" value="<?php echo $rsListData['pckgTo'] ?>"
                onkeyup="submitValue<?php echo $rsListData['id']; ?>();"></div>
    </td><?php }  ?>

    <?php if($_REQUEST['module']=='cdn'){ ?><td>
        <div style="width: 60px;" align="center"><input name="cbm" type="text" class="form-control validate"
                id="cbm<?php echo $rsListData['id']; ?>" value="<?php echo $rsListData['cbm'] ?>"
                onkeyup="submitValue<?php echo $rsListData['id']; ?>();"></div>
    </td><?php }  ?>

</tr>
<script>
function changeStyle<?php echo $rsListData['id']; ?>() {
    var style = $('#style<?php echo $rsListData['id']; ?>').val();
    $('#description<?php echo $rsListData['id']; ?>').load('loadbrand.php?action=changestyle&styleId=' + style);
}

function changeReq<?php echo $rsListData['id']; ?>() {
    var style = $('#style<?php echo $rsListData['id']; ?>').val();
    $('#requisition<?php echo $rsListData['id']; ?>').load('loadbrand.php?action=changereq&styleId=' + style +
        '&sample=<?php echo $rsListData['sampleReq'] ?>');
}

function changesample<?php echo $rsListData['id']; ?>() {
    $('#sample<?php echo $rsListData['id']; ?>').load(
        'loadbrand.php?action=changesample&sample=<?php echo $rsListData['sampleReq'] ?>');
}

changeStyle<?php echo $rsListData['id']; ?>();
changeReq<?php echo $rsListData['id']; ?>();
changesample<?php echo $rsListData['id']; ?>();


function submitValue<?php echo $rsListData['id']; ?>() {



    var id = '<?php echo $rsListData['id']; ?>';
    var style = $('#style<?php echo $rsListData['id']; ?>').val();
    var requisition = $('#requisition<?php echo $rsListData['id']; ?>').val();
    var indent = $('#indent<?php echo $rsListData['id']; ?>').val();
    var hsn = $('#hsn<?php echo $rsListData['id']; ?>').val();
    var invoice = $('#invoice<?php echo $rsListData['id']; ?>').val();
    var asn = $('#asn<?php echo $rsListData['id']; ?>').val();
    var bpo = $('#bpo<?php echo $rsListData['id']; ?>').val();
    var destination = $('#destination<?php echo $rsListData['id']; ?>').val();
    var quantity = $('#quantity<?php echo $rsListData['id']; ?>').val();
    var amount = $('#amount<?php echo $rsListData['id']; ?>').val();
    var packagesno = $('#packagesno<?php echo $rsListData['id']; ?>').val();
    var packagesform = $('#packagesform<?php echo $rsListData['id']; ?>').val();
    var packagesto = $('#packagesto<?php echo $rsListData['id']; ?>').val();
    var cbm = $('#cbm<?php echo $rsListData['id']; ?>').val();
    // var value = $('#value<?php echo $rsListData['id']; ?>').val();
    var value = Number(quantity * amount);
    $('#value<?php echo $rsListData['id']; ?>').val(value);

    $('#savedata').load('allaction.php?action=addcdn&id=' + id + '&style=' + style + '&indent=' + indent + '&hsn=' +
        hsn + '&invoice=' + invoice + '&asn=' + asn + '&bpo=' + bpo + '&destination=' + destination + '&quantity=' +
        quantity + '&amount=' + amount + '&packagesno=' + packagesno + '&packagesform=' + packagesform +
        '&packagesto=' + packagesto + '&cbm=' + cbm + '&value=' + value + '&requisition=' + requisition);

}
</script>




<?php

$sno++; }

if($count != "0"){
?>
<tr style="background-color: #e6e6fa">
    <td>
        <div style="text-align: center;font-weight: 500;">Total</div>
    </td>
    <td>
        <div style="text-align: center;font-weight: 500;">
            <?php echo $count; ?> Styles
        </div>
    </td>
    <td>
        <div style="text-align: center;"></div>
    </td>
    <?php if($_REQUEST['module']=='samplecdn') { ?>
    <td>
        <div style="text-align: center;"></div>
    </td>
    <?php } ?>
    <td>
        <div style="text-align: center;"></div>
    </td>
    <td>
        <div style="text-align: center;font-weight: 500;">
            <?php
	$sum = "0";
$rs=GetPageRecord('*','cdnStyleMaster','1 and parentId="'.$parentId.'"');
while($addvalue=mysqli_fetch_array($rs)){
$sum = $sum + $addvalue['qty']; }
if($_REQUEST['module']=='samplecdn') { echo $sum; }
?></div>
    </td>
    <?php if($_REQUEST['module']=='cdn') { ?>
    <td>
        <div style="text-align: center;"></div>
    </td>
    <td>
        <div style="text-align: center;"></div>
    </td>
    <td>
        <div style="text-align: center;"></div>
    </td>
    <td>
        <div style="text-align: center;"></div>
    </td>
    <?php } ?>
    <td>
        <div style="text-align: center;font-weight: 500;">
            <?php
	$sum = "0";
$rs=GetPageRecord('*','cdnStyleMaster','1 and parentId="'.$parentId.'"');
while($addvalue=mysqli_fetch_array($rs)){
if($_REQUEST['module']=='samplecdn'){
	$sum = $sum + $addvalue['amnt'];
}else{
	$sum = $sum + $addvalue['qty'];
}
}
echo $sum;
?>
        </div>
    </td>
    <td>
        <div style="text-align: center;font-weight: 500;">
            <?php
	$sum1 = "0";
$rs1=GetPageRecord('*','cdnStyleMaster','1 and parentId="'.$parentId.'"');
while($addvalue1=mysqli_fetch_array($rs1)){
if($_REQUEST['module']=='samplecdn'){
	$sum1 = $sum1 + $addvalue1['value'];
}else{
	$sum1 = $sum1 + $addvalue1['amnt'];
}
}
echo $sum1;
?>
        </div>
    </td>
    <td>
        <div style="text-align: center;font-weight: 500;">
            <?php
	$sum = "0";
$rs=GetPageRecord('*','cdnStyleMaster','1 and parentId="'.$parentId.'"');
while($addvalue=mysqli_fetch_array($rs)){
$sum = $sum + $addvalue['packageNo']; } echo $sum;
?>
        </div>
    </td>
    <?php if($_REQUEST['module']=='cdn') { ?>
    <td>
        <div style="text-align: center;"></div>
    </td>
    <td>
        <div style="text-align: center;"></div>
    </td>
    <td>
        <div style="text-align: center;"></div>
    </td>
    <?php } ?>
</tr>
<?php
}
if($count=='0'){ ?>
<tr>
    <td colspan="14">
        <div style="text-align: center;">No Record Found</div>
    </td>
</tr>
<?php }

}

?>

<?php
if($_REQUEST['action']=='requisition'){

$parentId= decode($_REQUEST['parentId']);

if($_REQUEST['add']==1){
	$dateAdded=date('Y-m-d');
	$namevalue ='parentId="'.$parentId.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'"';
	$lastId = addlistinggetlastid('requisitiondetailmaster',$namevalue);
}

if($_REQUEST['deletestatus']=="yes" && $_REQUEST['id']!=''){
	deleteRecord('requisitiondetailmaster','id="'.$_REQUEST['id'].'"');
}

$sno=1;
$rsList=GetPageRecord('*','requisitiondetailmaster','1 and parentId="'.$parentId.'" order by id desc');
$count = mysqli_num_rows($rsList);
while($rsListData=mysqli_fetch_array($rsList)){
?>
<tr>
    <td>
        <div align="center"></div><i class="fa fa-trash" style="font-size:18px;cursor:pointer; color:#FF0000;"
            onclick="deleteRow('<?php echo $rsListData['id']; ?>');"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span
            style="font-weight: 500"><?php echo $sno; ?>.</span>
    </td>

    <td>
        <div align="center"><input name="color" type="text" class="form-control validate"
                id="color<?php echo $rsListData['id']; ?>" value="<?php echo $rsListData['color']; ?>"
                onkeyup="submitValue<?php echo $rsListData['id']; ?>();"></div>
    </td>

    <td>
        <div align="center"><input name="marker" type="text" class="form-control validate"
                id="marker<?php echo $rsListData['id']; ?>" value="<?php echo $rsListData['marker']; ?>"
                onkeyup="submitValue<?php echo $rsListData['id']; ?>();"></div>
    </td>

    <td>
        <div align="center"><input name="size" type="text" class="form-control validate"
                id="size<?php echo $rsListData['id']; ?>" value="<?php echo $rsListData['size']; ?>"
                onkeyup="submitValue<?php echo $rsListData['id']; ?>();"></div>
    </td>

    <td>
        <div align="center"><input name="average" type="text" class="form-control validate"
                id="average<?php echo $rsListData['id']; ?>" value="<?php echo $rsListData['average']; ?>"
                onkeyup="submitValue<?php echo $rsListData['id']; ?>();"></div>
    </td>

    <td>
        <div align="center"><input name="pcs" type="text" class="form-control validate"
                id="pcs<?php echo $rsListData['id']; ?>" value="<?php echo $rsListData['pcs']; ?>"
                onkeyup="submitValue<?php echo $rsListData['id']; ?>();"></div>
    </td>

    <td>
        <div align="center"><input name="fabric" type="text" class="form-control validate"
                id="fabric<?php echo $rsListData['id']; ?>" value="<?php echo $rsListData['fabric']; ?>"
                onkeyup="submitValue<?php echo $rsListData['id']; ?>();"></div>
    </td>


</tr>
<script>
function submitValue<?php echo $rsListData['id']; ?>() {



    var id = '<?php echo $rsListData['id']; ?>';
    var color = $('#color<?php echo $rsListData['id']; ?>').val();
    var marker = $('#marker<?php echo $rsListData['id']; ?>').val();
    var size = $('#size<?php echo $rsListData['id']; ?>').val();
    var pcs = $('#pcs<?php echo $rsListData['id']; ?>').val();
    var average = $('#average<?php echo $rsListData['id']; ?>').val();
    var fabric = $('#fabric<?php echo $rsListData['id']; ?>').val();
    console.log(color + pcs + marker + size + average + fabric);
    $('#savedata').load('allaction.php?action=requisitiondetail&id=' + id + '&color=' + color + '&marker=' + marker +
        '&size=' + size + '&pcs=' + pcs + '&average=' + average + '&fabric=' + fabric);

}
</script>




<?php

$sno++; }

if($count=='0'){ ?>
<tr>
    <td colspan="14">
        <div style="text-align: center;">No Record Found</div>
    </td>
</tr>
<?php }

}

?>

<?php
if($_REQUEST['action'] == 'loadinvoice'){

$parentId= decode($_REQUEST['parentId']);

if($_REQUEST['add']==1){
  $dateAdded=date('Y-m-d');
  $namevalue ='parentId="'.$parentId.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'"';
  $lastId = addlistinggetlastid('invoiceStyleMaster',$namevalue);
}

if($_REQUEST['deletestatus']=="yes" && $_REQUEST['id']!=''){
  deleteRecord('invoiceStyleMaster','id="'.$_REQUEST['id'].'"');
}

$sno=1;
$rsList=GetPageRecord('*','invoiceStyleMaster','1 and parentId="'.$parentId.'" order by id desc');
$count = mysqli_num_rows($rsList);
while($rsListData=mysqli_fetch_array($rsList)){

?>
<div>
    <table width="143%">
        <tr>
            <td style="padding: 0px;width: 70%">
                <table class="intable" width="100%">
                    <tr>
                        <td>
                            <i class="fa fa-trash" onclick="deleteRow('<?php echo $rsListData['id']; ?>');"
                                style="cursor:pointer;border: 1px solid black;border-radius: 44%;padding: 3px;"> </i>
                            &nbsp;&nbsp;<input style="width:66%" type="text" class="erpint"
                                id="mark<?php echo $rsListData['id']; ?>"
                                onkeyup="submitValue<?php echo $rsListData['id']; ?>();">
                        </td>
                        <td><input style="width:100%" type="text" class="erpint"
                                id="packages<?php echo $rsListData['id']; ?>"
                                onkeyup="submitValue<?php echo $rsListData['id']; ?>();"></td>
                        <td><input style="width:100%" type="text" class="erpint"
                                id="desc<?php echo $rsListData['id']; ?>"
                                onkeyup="submitValue<?php echo $rsListData['id']; ?>();"></td>
                        <td><input style="width:100%" type="text" class="erpint"
                                id="style<?php echo $rsListData['id']; ?>"
                                onkeyup="submitValue<?php echo $rsListData['id']; ?>();"></td>
                        <td><input style="width:100%" type="text" class="erpint"
                                id="color<?php echo $rsListData['id']; ?>"
                                onkeyup="submitValue<?php echo $rsListData['id']; ?>();"></td>
                    </tr>
                </table>
            </td>
            <td><input style="width: 100%" type="number" class="erpint" id="quantity<?php echo $rsListData['id']; ?>"
                    onkeyup="submitValue<?php echo $rsListData['id']; ?>();"></td>
            <td><input style="width: 100%" type="number" class="erpint" id="rate<?php echo $rsListData['id']; ?>"
                    onkeyup="submitValue<?php echo $rsListData['id']; ?>();"></td>
            <td><input style="width: 100%" type="number" class="erpint" id="amount<?php echo $rsListData['id']; ?>">
            </td>
        </tr>
    </table>
</div>


<script>
function submitValue<?php echo $rsListData['id']; ?>() {

    var id = '<?php echo $rsListData['id']; ?>';
    var mark = $('#mark<?php echo $rsListData['id']; ?>').val();
    var packages = $('#packages<?php echo $rsListData['id']; ?>').val();
    var desc = $('#desc<?php echo $rsListData['id']; ?>').val();
    var style = $('#style<?php echo $rsListData['id']; ?>').val();
    var desc = $('#desc<?php echo $rsListData['id']; ?>').val();
    var color = $('#color<?php echo $rsListData['id']; ?>').val();
    var quantity = $('#quantity<?php echo $rsListData['id']; ?>').val();
    var rate = $('#rate<?php echo $rsListData['id']; ?>').val();
    var amount1 = Number(quantity * rate);
    $('#amount<?php echo $rsListData['id']; ?>').val(amount1);
    var amount = $('#amount<?php echo $rsListData['id']; ?>').val();
    console.log(amount + color + mark + rate + quantity + style + desc + packages);

    $('#savedata').load('allaction.php?action=loadinvoice&id=' + id + '&color=' + color + '&mark=' + mark +
        '&packages=' + packages + '&desc=' + desc + '&style=' + style + '&quantity=' + quantity + '&amount=' +
        amount + '&rate=' + rate);

}
</script>




<?php

$sno++; }

if($count=='0'){

}

}


if($_REQUEST['action']=='loadstyleworkflow'){
	$styleId=decode($_REQUEST['styleId']);

	if($_REQUEST['add']==1){
		$dateAdded=date('Y-m-d');
		$namevalue ='styleId="'.$styleId.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'"';
		$lastId = addlistinggetlastid('styleWorkFlowMaster',$namevalue);
	}

	if($_REQUEST['deletestatus']=="yes" && $_REQUEST['id']!=''){
		deleteRecord('styleWorkFlowMaster','id="'.$_REQUEST['id'].'"');
	}

	$sno=1;
	$rsList=GetPageRecord('*','styleWorkFlowMaster','1 and styleId="'.$styleId.'" order by id desc');
	$count = mysqli_num_rows($rsList);
	while($rsListData=mysqli_fetch_array($rsList)){
	?>
<tr>
    <!-- <td>
        <div align="center"><?php echo $sno; ?></div>
    </td> -->
    <td>
        <div align="center"><input name="sequenceNo" type="text" class="form-control validate"
                id="sequenceNo<?php echo $rsListData['id']; ?>"
                value="<?php echo $rsListData['sequenceNo']; ?>"
                onkeyup="submitValue<?php echo $rsListData['id']; ?>();"></div>
    </td>
    <td>
        <div align="center">
            <select name="departmentId" id="departmentId<?php echo $rsListData['id']; ?>" class="form-control validate"
                onchange="submitValue<?php echo $rsListData['id']; ?>();">
                <option value="">Select</option>
                <?php
		$abc=GetPageRecord('*','departmentMaster','1 and status=1 and deletestatus=0 order by name asc');
		while($machine=mysqli_fetch_array($abc)) {

		?>
                <option value="<?php echo $machine['id']?>"
                    <?php if($machine['id']==$rsListData['departmentId']){ echo "selected"; }?>>
                    <?php echo $machine['name'] ?>
                </option>
                <?php } ?>
            </select>
        </div>
    </td>

    <td>
        <div align="center">
            <select name="operationId" id="operationId<?php echo $rsListData['id']; ?>" class="form-control validate"
                onchange="submitValue<?php echo $rsListData['id']; ?>();">
                <option value="">Select</option>
                <?php
		$abc=GetPageRecord('*','assemblyoperationsMaster','1 and status=1 and deletestatus=0 order by name asc');
		while($critical=mysqli_fetch_array($abc)) {

		?>
                <option value="<?php echo $critical['id']?>"
                    <?php if($critical['id']==$rsListData['operationId']){ echo "selected"; }?>>
                    <?php echo $critical['name'] ?>
                </option>
                <?php } ?>
            </select>
        </div>
    </td>
    <td>
        <div align="center">
            <input type="checkbox" class="form-control" name="checkVal" id="checkVal<?php echo $rsListData['id']; ?>" onchange="submitValue<?php echo $rsListData['id']; ?>();" <?php if($rsListData['checkVal']=="true"){ echo 'checked'; } ?> value="<?php echo $rsListData['checkVal']; ?>" />
        </div>
    </td>
    <td>
        <div align="center">
            <select name="operatorId" id="operatorId<?php echo $rsListData['id']; ?>" class="form-control validate"
                onchange="submitValue<?php echo $rsListData['id']; ?>();">
                <option value="">Select</option>
				<?php
                $rs=GetPageRecord('id,name','employeeMaster','1 and status=1 and empType=2 || empType=3 || empType=1 order by name asc ');
                while($resListing=mysqli_fetch_array($rs)){

                $user=GetPageRecord('id','userMaster','empId="'.$resListing['id'].'"');
                $userdata=mysqli_fetch_array($user);

                ?>
                <option value="<?php echo $resListing['id']?>" myTag="<?php echo $userdata['id']; ?>"
                    <?php if($resListing['id']==$rsListData['operatorId']){ echo "selected"; }?>>
                    <?php echo strip($resListing['name']); ?>
                </option>
                <?php } ?>
            </select>
        </div>
    </td>
    <td>
        <div align="center">
            <select name="uom" id="uom<?php echo $rsListData['id']; ?>" class="form-control validate"
                onchange="submitValue<?php echo $rsListData['id']; ?>();">
                <option value="">Select</option>
                <?php
		$abc=GetPageRecord('*','unitMaster','1 and status=1 and deletestatus=0 and materialType=2 order by name asc');
		while($critical=mysqli_fetch_array($abc)) {

		?>
                <option value="<?php echo $critical['id']?>"
                    <?php if($critical['id']==$rsListData['uom']){ echo "selected"; }?>><?php echo $critical['name'] ?>
                </option>
                <?php } ?>
            </select>
        </div>
    </td>
    <td>
        <div align="center"></div><i class="icon-trash" style="font-size:18px;cursor:pointer; color:#FF0000;"
            onclick="deleteRow('<?php echo $rsListData['id']; ?>');"></i>
    </td>
</tr>

<script>
function submitValue<?php echo $rsListData['id']; ?>() {

    var id = '<?php echo $rsListData['id']; ?>';

    var sequenceNo = $('#sequenceNo<?php echo $rsListData['id']; ?>').val();
    var departmentId = $('#departmentId<?php echo $rsListData['id']; ?>').val();
    var operationId = $('#operationId<?php echo $rsListData['id']; ?>').val();
    var operatorId = $('#operatorId<?php echo $rsListData['id']; ?>').val();
    var user = $("#operatorId<?php echo $rsListData['id']; ?> option:selected").attr("myTag");
    var uom = $('#uom<?php echo $rsListData['id']; ?>').val();
    var checkVal = $('#checkVal<?php echo $rsListData['id']; ?>').is(':checked');
    if(checkVal==0){
        $('#checkVal<?php echo $rsListData['id']; ?>').val("0");
    }else{
        $('#checkVal<?php echo $rsListData['id']; ?>').val("1");
    }

    $('#savedata').load('allaction.php?action=loadstyleworkflow&id=' + id + '&sequenceNo='+sequenceNo+'&departmentId='+departmentId+'&operationId='+operationId+'&operatorId='+operatorId+'&uom='+uom+'&checkVal='+checkVal+'&userId='+user);
}
</script>

<?php

$sno++; }
if($count=='0'){ ?>
<tr>
    <td colspan="13">
        <div style="text-align: center;">No Record Found</div>
    </td>
</tr>
<?php }

}

?>