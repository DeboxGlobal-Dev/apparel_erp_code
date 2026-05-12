<?php
function chagetohexcolor($color){
$color = str_replace('rgb(','',$color);
$color = str_replace(')','',$color);
$rgb = ($color);
$rgbarr = explode(",",$rgb,3);
return  sprintf("%02x%02x%02x", $rgbarr[0], $rgbarr[1], $rgbarr[2]);
}

function chagetohexcolortorgb($color){
$hex = $color;
list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
return  "rgb($r, $g, $b)";
}



if($_POST['widgetWidth']!='' &&  $_POST['headerBg']!='' &&  $_POST['agentMessageBg']!='' &&  $_POST['visitorMessageBg']!='' &&  $_POST['headerText']!='' &&  $_POST['agentMessageText']!='' &&  $_POST['visitorMessageText']!=''){

$widgetWidth = $_POST['widgetWidth'];
$headerBg = chagetohexcolor($_POST['headerBg']);
$agentMessageBg = chagetohexcolor($_POST['agentMessageBg']);
$visitorMessageBg = chagetohexcolor($_POST['visitorMessageBg']);
$headerText = chagetohexcolor($_POST['headerText']);
$agentMessageText = chagetohexcolor($_POST['agentMessageText']);
$visitorMessageText = chagetohexcolor($_POST['visitorMessageText']);

$where='parentId="'.$_SESSION['userid'].'"';
$namevalue ='widgetWidth="'.$widgetWidth.'",headerBg="'.$headerBg.'",agentMessageBg="'.$agentMessageBg.'",visitorMessageBg="'.$visitorMessageBg.'",headerText="'.$headerText.'",agentMessageText="'.$agentMessageText.'",visitorMessageText="'.$visitorMessageText.'"';
$update = updatelisting('userMaster',$namevalue,$where);
$updatepage='1';
$genratetextstring='';
$genratetextstring.='function wechat(){var x = document.getElementById("wechatboxfrm");if (x.style.display === "none") { x.style.display = "block"; } else { x.style.display = "none"; } var y = document.getElementById("weminbtn");if (y.style.display === "none") { y.style.display = "block"; } else { y.style.display = "none"; } var z = document.getElementById("minwechatbox");if (z.style.display === "none") { z.style.display = "block"; } else { z.style.display = "none"; } }function weonlinestatus(status){document.getElementById("weonlinestatus").innerHTML = status;}';
$genratetextstring.='var wediv = document.createElement("div");wediv.innerHTML = \'<div style="width:'.$widgetWidth.'px; box-shadow: 0px 0px 10px #00000008; position:fixed; right:10px; bottom:-6px; overflow:hidden;  font-family:Arial, Helvetica, sans-serif; z-index:999999;"><div style="position:relative; "><div style="z-index: 999999; right: 16px; color: #fff; position: absolute; padding: 4px; font-size: 40px; line-height: 12px; top: 22px;cursor: pointer;background-color: #0000001f;" onclick="wechat();" id="weminbtn">-</div><iframe id="wechatboxfrm" style="width:100%; height:478px; border-radius: 4px; border: 1px solid #ededed; box-sizing: border-box; background-color: #fff;" frameborder="0" scrolling="no" src="'.$fullurl.'chatwidget.php?url=\'+window.location.href+\'" ></iframe></div><div style="background-color:#'.$headerBg.'; padding10px; color:#'.$headerText.'; font-size:14px;border-radius:4px; padding: 12px; display:none;cursor: pointer;" id="minwechatbox"  onclick="wechat();"><span class="weonlinestatus" id="weonlinestatus">Online</div></div></div>\';document.body.appendChild(wediv);';


$fileLocation = "js/wechat.js";
  $file = fopen($fileLocation,"w");
  $content = $genratetextstring;
  fwrite($file,$content);
  fclose($file);
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
						<h4><span class="font-weight-semibold">Chat Widget</span> - Widget Appearance</h4>
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
									Widget Colors
								</h6>
							</div>

						<form action="" method="post" enctype="multipart/form-data">

							<div class="card-body">
							<?php if($updatepage=='1'){ ?>
							<span class="badge d-block badge-info form-text text-center" style="margin-bottom: 20px; font-size: 12px; padding: 10px;">Successfully Updated</span>
							<?php } ?>


					 <div style="height:300px;">

					 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><div class="form-group row">
										<label class="col-lg-8 col-form-label">Widget Width (px)</label>

										<div class="col-lg-4">
											<input type="number" class="form-control" value="<?php echo $editresult['widgetWidth']; ?>" name="widgetWidth" id="widgetWidth" >
										</div>
									</div></td>
    <td width="2%">&nbsp;</td>
    <td width="49%" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">

<div class="form-group row">
										<label class="col-lg-8 col-form-label">Header Background</label>
										<div class="col-lg-4">
											<input type="text" class="form-control colorpicker-basic" value="<?php echo chagetohexcolortorgb('#'.$editresult['headerBg']);?>" name="headerBg" id="headerBg" data-fouc>
										</div>
									</div>

    <div class="form-group row">
										<label class="col-lg-8 col-form-label">Agent Message Background</label>
										<div class="col-lg-4">
											<input type="text" class="form-control colorpicker-basic"  value="<?php echo chagetohexcolortorgb('#'.$editresult['agentMessageBg']);?>" name="agentMessageBg" id="agentMessageBg" data-fouc>
										</div>
									</div>
    <div class="form-group row">
										<label class="col-lg-8 col-form-label">Visitor Message Background</label>
										<div class="col-lg-4">
											<input type="text" class="form-control colorpicker-basic"  value="<?php echo chagetohexcolortorgb('#'.$editresult['visitorMessageBg']);?>" name="visitorMessageBg" id="visitorMessageBg" data-fouc>
										</div>
									</div>	</td>
    <td>&nbsp;</td>
    <td colspan="2">

<div class="form-group row">
										<label class="col-lg-8 col-form-label">Header Text</label>
										<div class="col-lg-4">
											<input type="text" class="form-control colorpicker-basic"  value="<?php echo chagetohexcolortorgb('#'.$editresult['headerText']);?>" name="headerText" id="headerText" data-fouc>
										</div>
									</div>

    <div class="form-group row">
										<label class="col-lg-8 col-form-label">Agent Message Text</label>
										<div class="col-lg-4">
											<input type="text" class="form-control colorpicker-basic"  value="<?php echo chagetohexcolortorgb('#'.$editresult['agentMessageText']);?>" name="agentMessageText" id="agentMessageText" data-fouc>
										</div>
									</div>
    <div class="form-group row">
										<label class="col-lg-8 col-form-label">Visitor Message Text</label>
										<div class="col-lg-4">
											<input type="text" class="form-control colorpicker-basic"  value="<?php echo chagetohexcolortorgb('#'.$editresult['visitorMessageText']);?>" name="visitorMessageText" id="visitorMessageText"  data-fouc>
										</div>
									</div>	</td>
  </tr>
</table>

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

							<div class="card-body" style="height:376px;">
								 <div id="wouter" style="width:350px; margin:auto; border:1px solid #ccc;border-radius:4px; overflow:hidden; min-width:100px;">
								 <div style="padding:15px 12px; color:#fff; background-color:#72b626;" id="chatheader">
								 <div style=" font-size:15px; font-weight:500; position:relative;">Online <i class="fa fa-bars" aria-hidden="true" style="right:5px; font-size: 18px; position:absolute;"></i></div>
								 <div style="padding-top:15px; text-align:center;">We are live and ready to chat with you now. Say something to start a live chat.</div>

								 </div>

								 <div id="wechatbox">
								 <div class="chatmsgouter" style="margin-top:50px;">
								 <div class="msgboxleft">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<i class="fa fa-arrow-left" aria-hidden="true"></i></div>
								 </div>

								 <div class="chatmsgouter">
								 <div class="msgboxright">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<i class="fa fa-arrow-right" aria-hidden="true"></i></div>
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
    background-color: #72b626;
    padding: 10px;
    position: absolute;
    font-size: 14px;
    right: 6px;
    color: #fff;
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

#wechatbox{height:190px; overflow:auto; }

#wechatbox .chatmsgouter{padding:5px 10px; overflow:hidden; font-size:13px;}
#wechatbox .chatmsgouter .msgboxleft{width:80%; padding: 8px 10px; float:left; border-radius:4px; background-color:#72b626; color:#fff; position:relative;}
#wechatbox .chatmsgouter .msgboxright{width:80%;padding: 8px 10px; float:right; border-radius:4px; background-color:#e5e5e5; color:#000; position:relative;}
 #wechatbox .chatmsgouter .msgboxright .fa{position:absolute; right:10px; top:5px; color:#e5e5e5;}

 #wechatbox .chatmsgouter .msgboxleft .fa {
    position: absolute;
    left: -5px;
    top: 5px;
    color: #72b626;
}

 #wechatbox .chatmsgouter .msgboxright .fa {
    position: absolute;
    right: -5px;
    top: 5px;
    color: #e5e5e5;
}

 </style>


 <script>
setInterval(function() {
var headerBg = $('#headerBg').val();
$('#chatheader').css('background-color',''+headerBg+'');
$('#wechatmsgfieldouter .fa').css('background-color',''+headerBg+'');

var agentMessageBg = $('#agentMessageBg').val();
$('.msgboxleft').css('background-color',''+agentMessageBg+'');
$('.msgboxleft .fa').css('color',''+agentMessageBg+'');

var visitorMessageBg = $('#visitorMessageBg').val();
$('.msgboxright').css('background-color',''+visitorMessageBg+'');
$('.msgboxright .fa').css('color',''+visitorMessageBg+'');

var headerText = $('#headerText').val();
$('#chatheader').css('color',''+headerText+'');

var agentMessageText = $('#agentMessageText').val();
$('.msgboxleft').css('color',''+agentMessageText+'');

var visitorMessageText = $('#visitorMessageText').val();
$('.msgboxright').css('color',''+visitorMessageText+'');

var widgetWidth = $('#widgetWidth').val();
$('#wouter').css('width',''+widgetWidth+'px');


}, 100);

</script>