<?php
include "inc.php";
if($_SESSION['sitevisitor']==''){
$_SESSION['sitevisitor']=time();
}
$actual_link = $_REQUEST['url'];

if($_SESSION['sitevisitor']!=''){

$select='id';
$where='sessionId="'.$_SESSION['sitevisitor'].'"';
$rs=GetPageRecord($select,'liveVisitorMaster',$where);
$visitoryes=mysqli_fetch_array($rs);

if($visitoryes['id']!=''){

$where='sessionId="'.$_SESSION['sitevisitor'].'"';
$namevalue ='pageURL="'.$actual_link.'"';
$update = updatelisting('liveVisitorMaster',$namevalue,$where);

} else {

$details = json_decode(file_get_contents("http://ipinfo.io/".$_SERVER['REMOTE_ADDR'].""));
$city = $details->city;
$country = $details->country;

$namevalue ='sessionId="'.$_SESSION['sitevisitor'].'",userIP="'.$_SERVER['REMOTE_ADDR'].'",pageURL="'.$actual_link.'",city="'.$city.'",country="'.$country.'",updatedDateTime="'.date('Y-m-d H:i:s').'"';
addlisting('liveVisitorMaster',$namevalue);
}
}


$select1='cLogin';
$where1='parentId=1';
$rs1=GetPageRecord($select1,'userMaster',$where1);
$editresult=mysqli_fetch_array($rs1);



if(date("Y-m-d H:i:s", (strtotime(date($editresult['cLogin'])) + 20))<date('Y-m-d H:i:s')){

$where='parentId=1';
$namevalue ='onlineStatus=0';
$update = updatelisting('userMaster',$namevalue,$where);

}

$select1='*';
$where1='parentId=1';
$rs1=GetPageRecord($select1,'userMaster',$where1);
$editresult=mysqli_fetch_array($rs1);
?>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="js/jquery.js"></script>

<script>
<?php if($editresult['onlineStatus']=='1'){ ?>
parent.weonlinestatus('<?php echo stripslashes($editresult['headerStatus']); ?>');
<?php } else { ?>
parent.weonlinestatus('Offline');
<?php } ?>

<?php if($editresult['WidgetStatus']=='2'){ ?>
parent.wechat();
<?php } ?>
</script>

<style>
body{ margin:0px; padding:0px; font-family:Arial, Helvetica, sans-serif; font-size:13px; background-color:#fff; color:#333333;}
#weheaderouter{background-color:#<?php echo $editresult['headerBg']; ?>; padding:22px 15px 22px; color:#fff;  }
#weheaderouter #firstrow{margin-bottom:10px; position:relative;  }
#weheaderouter #firstrow .fa {
    position: absolute;
    right: 0px;
    top: 0px;
    font-size: 19px;
    color: #fff;
    cursor: pointer;
}
#weheaderouter #firstrow #wemenu {
    width: 180px;
    background-color: #FFFFFF;
    border: 1px solid #e5e5e5;
    position: absolute;
    right: -1px;
    top: 24px;
    padding: 12px;
    border-radius: 3px; display:none;
}

#weheaderouter #firstrow #wemenu a{padding:10px; color:#666666; display:block; text-decoration:none;border-radius: 3px;}
#weheaderouter #firstrow #wemenu a:hover{background-color:#E8E8E8; text-decoration:none;}
#weheaderouter #firstrow #headingname{font-size:16px; font-weight:500;}
#weheaderouter #contmsg{padding:10px; text-align:center; font-size:13px; padding-bottom:0px;}
#wechatbox{height:314px; overflow:auto;}
#wechatmsgfieldouter {
    padding: 3px;
    background-color: #FBFBFB;
    border-top: 2px solid #e5e5e5; position:relative;
}
#wechatmsgfieldouter #wemsgfield {
    padding: 12px;
    font-size: 14px;
    color: #333333;
    width: 100%;
    box-sizing: border-box;
    padding-right: 44px;
    outline: 0px;
    border: 0px;
    margin-bottom: 0px;
    background-color: #FBFBFB;
}
#wechatmsgfieldouter .fa {
    background-color: #<?php echo $editresult['headerBg']; ?>;
    padding: 10px;
    position: absolute;
    font-size: 14px;
    right: 6px;
    color: #<?php echo $editresult['headerText']; ?>;
    z-index: 999;
    border-radius: 50px;
    top: 7px; cursor:pointer;
}
#wechatmsgfieldouter ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
  color: #ccc;
  opacity: 1; /* Firefox */
}

#wechatmsgfieldouter :-ms-input-placeholder { /* Internet Explorer 10-11 */
  color: #ccc;
}

#wechatmsgfieldouter ::-ms-input-placeholder { /* Microsoft Edge */
  color: #ccc;
}

#wechatbox .chatmsgouter{padding: 10px 10px 10px; overflow:hidden; font-size:13px;}
#wechatbox .chatmsgouter .msgboxleft{max-width:80%; padding: 11px 10px; float:left; border-radius:4px; background-color:#<?php echo $editresult['agentMessageBg']; ?>; color:#<?php echo $editresult['agentMessageText']; ?>; position:relative;font-size: 13px;}
#wechatbox .chatmsgouter .msgboxright{max-width:80%; padding: 11px 10px; float:right; border-radius:4px; background-color:#<?php echo $editresult['visitorMessageBg']; ?>; color:#<?php echo $editresult['visitorMessageText']; ?>; position:relative;font-size: 13px;}
 #wechatbox .chatmsgouter .msgboxright .fa{position:absolute; right:10px; top:5px; color:#<?php echo $editresult['visitorMessageText']; ?>;}

  #wechatbox .chatmsgouter .msgboxleft .fa {
    position: absolute;
    left: -5px;
    top: 5px;
    color: #<?php echo $editresult['agentMessageText']; ?>;
}

 #wechatbox .chatmsgouter .msgboxright .fa {
    position: absolute;
    right: -5px;
    top: 5px;
    color: #<?php echo $editresult['visitorMessageText']; ?>;
}



.offlineformouter {
    border: 1px solid #cccccc87;
    margin: 10px;
    padding: 10px;
    border-radius: 4px;
}


.offlineformouter .frmfield {
    padding: 6px;
    border: 2px solid #ccc;
    color: #333333;
    outline: 0px;
    border-radius: 4px;
    width: 100%;
    box-sizing: border-box;
    margin-bottom: 12px;
}

.offlineformouter .lable {margin-bottom:3px; font-size:13px;}
.offlineformouter .submitbtnfrm {
    outline: 0px;
    padding: 10px;
    background-color: #<?php echo $editresult['headerBg']; ?>;
    color: #<?php echo $editresult['headerText']; ?>;
    text-align: center;
    font-size: 15px;
    font-weight: 500;
    border: 0px;
    width: 100%;
    box-sizing: border-box;
    border-radius: 4px;
}


 #wechatbox .chatmsgouter .msgboxleft .fa {
    position: absolute;
    left: -5px;
    top: 5px;
    color: #<?php echo $editresult['agentMessageBg']; ?>;
}

 #wechatbox .chatmsgouter .msgboxright .fa {
    position: absolute;
    right: -5px;
    top: 5px;
    color: #<?php echo $editresult['visitorMessageBg']; ?>;
}
</style>
<div id="weheaderouter">
<div id="firstrow">
<div id="headingname"><?php if($editresult['onlineStatus']=='1'){ echo stripslashes($editresult['headerStatus']); } else { echo 'Offline'; } ?></div>
<i class="fa fa-bars" aria-hidden="true" onClick="$('#wemenu').toggle();" style="right:30px; display:none;"></i>
<div id="wemenu">
<a href="#">Pop out widget</a>
<a href="#">End this chat session</a>
</div>
</div>
<div id="contmsg"><?php if($editresult['onlineStatus']=='1'){ echo stripslashes($editresult['onlineHeader']); } else { echo stripslashes($editresult['offlineHeader']); } ?></div>
</div>
<div id="wechatbox">

<?php if($editresult['onlineStatus']=='1'){

									$select1='*';
									$where1='sessionId='.$_SESSION['sitevisitor'].'';
									$rs1=GetPageRecord($select1,'liveVisitorMaster',$where1);
									$visitor=mysqli_fetch_array($rs1);

										$n=0;
										$listofurls='';
										$selectl='';
										$wherel='';
										$rsl='';
										$selectl='*';
										$wherel=' sessionId='.$visitor['sessionId'].' order by id asc';
										$rsl=GetPageRecord($selectl,'visitorChat',$wherel);
										while($chatdata=mysqli_fetch_array($rsl)){
										?>
										<?php if($chatdata['msgType']=='1'){ ?>
								 <div class="chatmsgouter">
								 <div class="msgboxleft"><?php echo stripslashes($chatdata['msg']); ?><i class="fa fa-arrow-left" aria-hidden="true"></i></div>
								 </div>
								 <?php } if($chatdata['msgType']=='2'){ ?>
								 <div class="chatmsgouter">
								 <div class="msgboxright"><?php echo stripslashes($chatdata['msg']); ?><i class="fa fa-arrow-right" aria-hidden="true"></i></div>
								 </div>

								 <?php  } } ?>




<?php } else {

$details = json_decode(file_get_contents("http://ipinfo.io/".$_SERVER['REMOTE_ADDR'].""));
$city = $details->city;
$country = $details->country;
$offline='1';
?>
<div style="margin:15px; background-color:#F3FFE6; padding:10px; font-size:14px; text-align:center; font-weight:500; line-height:20px; border:1px solid #EBFFC6; display:none;" id="thankmsg">Thank you for your details! <br />
  We will get back to you shortly.</div>
<div class="offlineformouter">
								  <div class="lable" >Name <span style="color:#CC3300;">*</span></div>
								<input name="name" type="text" class="frmfield" id="name" size="30"/>

								<div class="lable" >Email <span style="color:#CC3300;">*</span></div>
								<input name="email" type="text" class="frmfield" id="email" maxlength="60"/>


								<div class="lable" >Mobile/Phone <span style="color:#CC3300;">*</span></div>
								<input name="mobile" type="text" class="frmfield" id="mobile" maxlength="14"/>

								<div class="lable" >Message <span style="color:#CC3300;">*</span>
								  <input name="visitorLocation" type="hidden" id="visitorLocation" value="<?php echo $city.', '.$country; ?>" />
								</div>
								<textarea name="message" rows="3" class="frmfield" id="message"></textarea>

								<input name="" type="button" class="submitbtnfrm" value="Submit" onclick="wecontactfrm();" />
  </div>

  <script>
  function wecontactfrm(){
  var name = encodeURI($('#name').val());
  var email = encodeURI($('#email').val());
  var mobile = encodeURI($('#mobile').val());
  var visitorLocation = encodeURI($('#visitorLocation').val());
  var message = encodeURI($('#message').val());
  $('#actiondiv').load('systemaction.php?name='+name+'&email='+email+'&mobile='+mobile+'&visitorLocation='+visitorLocation+'&message='+message+'&action=savecontactfrm&userId=<?php echo $_SESSION['sitevisitor']; ?>');
  }

  $('#wechatbox').css('height','364px');
  </script>

<?php } ?>

</div>


<div id="actiondiv" style="display:none;"></div>
<?php if($offline!='1'){ ?><div id="wechatmsgfieldouter"><input name="msg" autocomplete="off"  type="text" id="wemsgfield" placeholder="Write a reply"><i class="fa fa-paper-plane" aria-hidden="true" onclick="sendmsg();"></i></div><?php } ?>


<script>
$("#wechatbox").animate({ scrollTop: $('#wechatbox').prop("scrollHeight")}, 1000);

function sendmsg(){
var msg = encodeURI($('#wemsgfield').val());
if(msg!=''){
$('#wemsgfield').val('');
$('#msgactiondiv').load('loadaction.php?action=msgtoadmin&msg='+msg+'&sessionId=<?php echo $visitor['sessionId']; ?>&msgType=2');
}
}


$("#wemsgfield").keypress(function(e) {
if(e.which == 13) {
sendmsg()
}
});
	clearInterval(idinter);
<?php if($offline!='1'){ ?>
var idinter = setInterval(function() {
$('#msgactiondiv').load('loadaction.php?action=getadminmsg&sessionId=<?php echo $visitor['sessionId']; ?>');
}, 5000);
<?php } ?>

<?php if($offline!='1'){ ?>
<?php
$select1='autoMsgTime,autoMsg';
$where1='parentId=1';
$rs1=GetPageRecord($select1,'userMaster',$where1);
$editresult=mysqli_fetch_array($rs1);

if($editresult['autoMsgTime']!='0' || $editresult['autoMsgTime']!='' || trim($editresult['autoMsg'])!=''){ ?>

setTimeout(function(){
var msg = encodeURI('<?php echo stripslashes($editresult['autoMsg']); ?>');
$('#msgactiondiv').load('loadaction.php?action=msgtouser&msg='+msg+'&sessionId=<?php echo $_SESSION['sitevisitor']; ?>&msgType=1&automsg=1');
}, 5000);


<?php } } ?>
</script>

<div id="msgactiondiv" style="display:none;"></div>