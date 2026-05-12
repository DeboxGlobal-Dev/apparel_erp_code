<?php
include "inc.php";
include "config/logincheck.php";
$my = $_REQUEST['my'];
?>
<link href="css/main.css" rel="stylesheet" type="text/css">



<div id="timelinebox">
 <div class="postbox">
<form class="edit-layer" enctype="multipart/form-data"  method="post" action="frm_action.crm" target="actoinfrm" >  <div class="wbox">
   <textarea class="submittextfield" placeholder="Hey! What's up?" id="postsubmitfield" name="postsubmitfield" onBlur="showsubmitfrombtn();" onFocus="$('#submitpostbtndiv').show();"></textarea>
   <div class="attachtab" id="submitattach"><span>Attach</span><input type="file" id="attachpostsubmit" name="attachpostsubmit" onChange="attachsubmitpostfile();showsubmitfrombtn();">
   </div>
 </div>
 <div class="btnsec" id="submitpostbtndiv" style="display:none;"><input name="addnewuserbtn" type="submit" class="bluembutton submitbtn" id="addnewuserbtn" value="  Post  " ></div>
 <input name="action" type="hidden" id="action" value="submitpost">
 </form>
 </div>


 <h2>Posts</h2>
 <div class="loadposts">
<link href="css/default.css" rel="stylesheet" type="text/css">
 <?php
$select='';
$where='';
$rs='';
$select='*';
$where='userId='.$loginusersuperParentId.' and parentId=0 order by id dateAdded';
$rs=GetPageRecord($select,_TIMELINE_MASTER_,$where);
while($timeline=mysqli_fetch_array($rs)){

$select2='firstName,lastName,profilePhoto';
$where2='id='.$timeline['addedBy'].'';
$rs2=GetPageRecord($select2,_USER_MASTER_,$where2);
$userInfopost=mysqli_fetch_array($rs2);
?>
<div class="postmainbox">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="6%" valign="top"><div class="img"><img src="<?php if($userInfopost['profilePhoto']!=''){ ?>profilepic/<?php echo $userInfopost['profilePhoto']; ?><?php } else { ?>images/user.png<?php } ?>" /></div></td>
    <td width="94%" valign="top"><div class="name"><?php echo strip($userInfopost['firstName']); ?> <?php echo strip($userInfopost['lastName']); ?></div>
      <div class="datetime"><?php echo date_format($userInfopost['dateAdded'], 'g:ia jS F Y'); ?></div>
	  <div class="msg"><?php echo strip($userInfopost['firstName']); ?> <a href="#"><div class="attachedbox">Image Untitled</div></a></div>



	  <div class="boxedreply"><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="7%"><div class="img"><img src="images/user.png"></div></td>
    <td width="93%"><div class="name"><strong>Mohd Imran</strong> Hi how are you</div>
      <div class="datetime">5PM - 5 June 2017 </div><a href="#"><div class="attachedbox">Image Untitled</div></a></td>
  </tr>

</table>
</div>
	  <div class="boxedreply"><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="7%"><div class="img"><img src="images/user.png"></div></td>
    <td width="93%"><div class="name"><strong>Mohd Imran</strong> Hi how are you</div>
      <div class="datetime">5PM - 5 June 2017 </div></td>
  </tr>

</table>
</div>
	  <div class="boxedreply"><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="7%"><div class="img"><img src="images/user.png"></div></td>
    <td width="93%"><div class="name"><strong>Mohd Imran</strong> Hi how are you</div>
      <div class="datetime">5PM - 5 June 2017 </div></td>
  </tr>

</table>
</div>
	  <div class="boxedreply"><table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="7%"><div class="img"><img src="images/user.png"></div></td>
    <td width="93%"><div class="name"><strong>Mohd Imran</strong> Hi how are you</div>
      <div class="datetime">5PM - 5 June 2017 </div></td>
  </tr>

</table>
</div>

	  <div class="teplybox">
	  <div class="wbox2">
	  <input name="" type="text" class="replyfield">
	  </div>
	  <div class="btnboxreply">
	  <div class="replyattach">Attach File</div>
	  </div>
	  <div class="btninnerreply">
	    <table border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td><input name="addnewuserbtn" type="button" class="bluembutton3" id="addnewuserbtn" value="Submit" ></td>
            <td><a href="#">Cancel</a></td>
          </tr>
        </table>
	  </div>
	  </div>

	  </td>
  </tr>
</table>


 </div>
 <?php } ?>

 </div>

 </div>
<script>
stoptloading();
</script>