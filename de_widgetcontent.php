<?php
if($_POST['onlineHeader']!='' &&  $_POST['offlineHeader']!=''){
$headerStatus = addslashes($_POST['headerStatus']);
$onlineHeader = addslashes($_POST['onlineHeader']);
$offlineHeader = addslashes($_POST['offlineHeader']);
$WidgetStatus = addslashes($_POST['WidgetStatus']);
$autoMsg = addslashes($_POST['autoMsg']);
$autoMsgTime = addslashes($_POST['autoMsgTime']);

$where='parentId="'.$_SESSION['userid'].'"';
$namevalue ='onlineHeader="'.$onlineHeader.'",offlineHeader="'.$offlineHeader.'",autoMsg="'.$autoMsg.'",autoMsgTime="'.$autoMsgTime.'",headerStatus="'.$headerStatus.'",WidgetStatus="'.$WidgetStatus.'"';
$update = updatelisting('userMaster',$namevalue,$where);
$updatepage='1';
}



$select1='*';
$where1='parentId='.$_SESSION['userid'].'';
$rs1=GetPageRecord($select1,'userMaster',$where1);
$editresult=mysqli_fetch_array($rs1);
?>
	<div class="page-content">

		<!-- Main sidebar -->
		<?php include "left.php"; ?>
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<div class="page-header">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><span class="font-weight-semibold">Chat Widget</span> -  Widget Content</h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>


				</div>
			</div>
			<!-- /page header -->


			<!-- Content area -->
			<div class="content pt-0">




				<!-- Dashboard content -->
				<div class="row">
				<div class="col-xl-6">
				<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title">
									<i class="icon-cog3 mr-2"></i>
									Widget Content Setting
								</h6>
							</div>

						<form action="" method="post" enctype="multipart/form-data">

							<div class="card-body">
							<?php if($updatepage=='1'){ ?>
							<span class="badge d-block badge-info form-text text-center" style="margin-bottom: 20px; font-size: 12px; padding: 10px;">Successfully Updated</span>
							<?php } ?>
							<div class="form-group">
									<label>Online (Header Status)</label>
									<input name="headerStatus" type="text" class="form-control" id="headerStatus" onfocus="onlinehdersontent();"   onkeyup="onlinehdersontent();" value="<?php echo stripslashes($editresult['headerStatus']); ?>" maxlength="30">
							  </div>

					  <div class="form-group">
									<label>Online (Header Content)</label>
									<input name="onlineHeader" type="text" class="form-control" id="onlineHeader" value="<?php echo stripslashes($editresult['onlineHeader']); ?>" onfocus="onlinehdersontent();"   onkeyup="onlinehdersontent();">
							  </div>

							  <div class="form-group">
									<label>Offline (Header Content)</label>
									<input name="offlineHeader" type="text" class="form-control" id="offlineHeader" value="<?php echo stripslashes($editresult['offlineHeader']); ?>" onfocus="offlinehedercontent();"   onkeyup="offlinehedercontent();">
							  </div>


							  <div class="form-group">
									<label>Auto Message</label>
									<input name="autoMsg" type="text" class="form-control" id="autoMsg" value="<?php echo stripslashes($editresult['autoMsg']); ?>" onfocus="automessagecontent();"   onkeyup="automessagecontent();">
							  </div>

							  <div class="form-group">
									<label>Auto Message Time </label>
									 <select name="autoMsgTime" class="form-control" id="autoMsgTime">
									   <option value="0" <?php if($editresult['autoMsgTime']=='0'){ ?>selected="selected"<?php } ?>>Never</option>
									   <option value="15" <?php if($editresult['autoMsgTime']=='15'){ ?>selected="selected"<?php } ?>>After 15  Sec.</option>
									   <option value="30" <?php if($editresult['autoMsgTime']=='30'){ ?>selected="selected"<?php } ?>>After 30 Sec.</option>
									   <option value="45" <?php if($editresult['autoMsgTime']=='45'){ ?>selected="selected"<?php } ?>>After 45 Sec.</option>
									   <option value="60" <?php if($editresult['autoMsgTime']=='60'){ ?>selected="selected"<?php } ?>>After 1 Min.</option>
							    </select>
							  </div>

							  <div class="form-group">
									<label>Default Widget Status</label>
									 <select name="WidgetStatus" class="form-control" id="WidgetStatus">
									   <option value="1" <?php if($editresult['WidgetStatus']=='1'){ ?>selected="selected"<?php } ?>>Maximize</option>
									   <option value="2" <?php if($editresult['WidgetStatus']=='2'){ ?>selected="selected"<?php } ?>>Minimize</option>
							    </select>
							  </div>

<div class="text-right">
								<button type="submit" class="btn btn-primary">Save <i class="icon-paperplane ml-2"></i></button>
							</div>
							</div>

							</form>
						</div>


					</div>

					<div class="col-xl-6">
				<div class="card">
							<div class="card-header bg-white">
								<h6 class="card-title">
									<i class="icon-cog3 mr-2"></i>
									Widget Preview
								</h6>
							</div>

							<div class="card-body" style="height:579px;">
								 <div id="wouter" style="width:<?php echo $editresult['widgetWidth']; ?>px; margin:auto; border:1px solid #ccc;border-radius:4px; overflow:hidden; min-width:100px;    margin-top: 50px;">
								 <div style="padding:15px 12px; color:#<?php echo $editresult['headerText']; ?>; background-color:#<?php echo $editresult['headerBg']; ?>;" id="chatheader">
								 <div style=" font-size:15px; font-weight:500; position:relative;"><span id="onlinetext"><?php echo $editresult['headerStatus']; ?></span> <i class="fa fa-bars" aria-hidden="true" style="right:5px; font-size: 18px; position:absolute;"></i></div>
								 <div style="padding-top:15px; text-align:center;" id="headercontent">We are live and ready to chat with you now. Say something to start a live chat.</div>

								 </div>

								 <div id="wechatbox">
								<div id="trmsg">
								 <div class="chatmsgouter" style="margin-top:50px;">
								 <div class="msgboxleft">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<i class="fa fa-arrow-left" aria-hidden="true"></i></div>
								 </div>

								 <div class="chatmsgouter">
								 <div class="msgboxright">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<i class="fa fa-arrow-right" aria-hidden="true"></i></div>
								 </div>
								 </div>

								 <div id="formoffline" style=" display:none;">
								  <div class="offlineformouter">
								  <div class="lable" >Name</div>
								<input name="" type="text" class="frmfield"/>

								<div class="lable" >Email</div>
								<input name="" type="text" class="frmfield"/>


								<div class="lable" >Mobile/Phone</div>
								<input name="" type="text" class="frmfield"/>

								<div class="lable" >Message</div>
								<textarea name="" rows="3" class="frmfield"></textarea>

								<input name="" type="button" class="submitbtnfrm" value="Submit" />
								  </div>

								 </div>

								 </div>

								 <div id="wechatmsgfieldouter"><input name="" type="text" id="wemsgfield" placeholder="Write a reply"><i class="fa fa-paper-plane" aria-hidden="true"></i></div>
								 </div>

							</div>
						</div>


					</div>
				</div>
				<!-- /dashboard content -->

			</div>
			<!-- /content area -->


			<!-- Footer -->

			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
 <style>
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
    z-index: 999 ;
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

#wechatbox{height:280px; overflow:auto; }

#wechatbox .chatmsgouter{padding:5px 10px; overflow:hidden; font-size:13px;}
#wechatbox .chatmsgouter .msgboxleft{width:80%; padding: 8px 10px; float:left; border-radius:4px; background-color:#<?php echo $editresult['agentMessageBg']; ?>; color:#<?php echo $editresult['agentMessageText']; ?>; position:relative;}
#wechatbox .chatmsgouter .msgboxright{width:80%;padding: 8px 10px; float:right; border-radius:4px; background-color:#<?php echo $editresult['visitorMessageBg']; ?>; color:#<?php echo $editresult['visitorMessageText']; ?>; position:relative;}
 #wechatbox .chatmsgouter .msgboxright .fa{position:absolute; right:10px; top:5px; color:#e5e5e5;}

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

 </style>


 <script>

 function onlinehdersontent(){
 var onlineHeader = $('#onlineHeader').val();
 $('#headercontent').text(onlineHeader);
 $('#onlinetext').text('<?php echo $editresult['headerStatus']; ?>');

  $('#trmsg').show();
  $('#formoffline').hide();
 }

 function offlinehedercontent(){
 var offlineHeader = $('#offlineHeader').val();
 $('#headercontent').text(offlineHeader);
 $('#onlinetext').text('Offline');
  $('#trmsg').hide();
  $('#formoffline').show();
 }

  function automessagecontent(){
 var onlineHeader = $('#onlineHeader').val();
 var autoMsg = $('#autoMsg').val();
 $('#headercontent').text(onlineHeader);
 $('#onlinetext').text('<?php echo $editresult['headerStatus']; ?>');
 $('.msgboxleft').text(autoMsg);
   $('#trmsg').show();
  $('#formoffline').hide();
 }

onlinehdersontent();
</script>