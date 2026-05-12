<?php

include_once('inc.php');

$userId2=$_REQUEST['userId2'];

$msgdate='';

	//unset($selectFields);

	//unset($whereFields);

	//unset($whereVals);

   $sqlTotal="0";

   $sqlTotal=mysqli_num_rows(mysql_query("select id from chatMaster where userId='".$_SESSION['userid']."' and contactId='".decode($userId2)."'"));

if($sqlTotal-20>0)

{

?>

    <div id="pageid2"><a class="loadmoremessagesclass" onclick="loadmorechatboxmessage('<?php echo ($sqlTotal-20);?>','<?php echo $userId2;?>');">Load more messages</a>

	</div>

<?php

}



$sql_ins="UPDATE chatMaster SET status=1 WHERE contactId= '".decode($userId2)."' AND userId='".$_SESSION["userid"]."' ";

mysql_query($sql_ins) or die(mysql_error());


	$n=0;



	if($sqlTotal==''){

	$sqlTotal=0;

	}

	 if($sqlTotal<30){

	 $lsatsqlTotal=0;

	 } else {

	 $lsatsqlTotal=$sqlTotal-20;

	 }


$sqlLogin="";

$sqlLogin="select * from chatMaster where userId='".$_SESSION['sessUserId']."' and contactId='".decode($userId2)."' ORDER BY dateAdded ASC LIMIT ".$lsatsqlTotal.",".$sqlTotal."";

$resLogin=mysql_query($sqlLogin);

$totalMsqlRow=mysqli_num_rows($resLogin);

	if($totalMsqlRow>0)

	{

		while($row=mysqli_fetch_array($resLogin))

			{


if($row["chatFileName"]!=''){

 $fileExt=findExtension($row["chatFileName"]);


if($fileExt=='jpeg'  || $fileExt=='JPEG' || $fileExt=='jpg'  || $fileExt=='JPG' || $fileExt=='png'  || $fileExt=='PNG')

{


$img=1;


} else {

$img=0;


}



 } else {



 $img=0;

 }



?>

<?php if($msgdate!=date("Y-m-d",$row['dateAdded'])){?>

<div class="chat-date stimedate"><?php echo date("j F Y",$row['dateAdded']);?></div>

<?php }?>

<?php if($row["chatBy"]!=$_SESSION['sessUserId']){ ?>

<?php if($row["meeting"]==0){ ?>

<div class="userchatboxmain"><div class="userchatboxmain_user"><div class="userchatboxmain_name">&nbsp;</div><div class="userchatboxmain_text chatmsg<?php if (strpos($row["chatText"], 'iframe') !== false) { ?> iframehave<?php } ?>" <?php if($img==1){ ?>style=" padding:0px !important;" <?php } ?>>



<?php if($img==0){ echo nl2br(showsmily($row["chatText"])); } else { ?><div class="imgbox">

<img src="uploads/<?php echo $row["chatFileName"]; ?>" style="width:200px;"  onClick="imagepopupmain('<?php echo 'x_'.$row["chatFileName"];?>');"/></div><?php } ?>



<div class="userchatboxmain_time"><?php echo date("h:i A",$row['dateAdded']); ?></div></div></div></div>

<?php }else{ ?>

<div class="userchatboxmain"><div class="userchatboxmain_user"><div  class="userchatboxmain_name" >&nbsp;</div><div class="userchatboxmain_text">



<div class="chatmsg" id="meeting<?php echo $row['id'];?>"><?php echo nl2br(showsmily($row["chatText"]));?></div>

<script>

$('#meeting<?php echo $row['id'];?>').load('<?php echo $fullurl; ?>meeting_inner.php?id=<?php echo $row['id'];?>&myId=<?php echo $_SESSION['sessUserId'];?>&user=1');

</script>

<div  class="userchatboxmain_time" id="usermsgid<?php echo $row['id'];?>"><?php if($row['readDate']!=0){echo date("h:i A",$row['readDate']);}else{ ?><?php echo date("h:i A");?><?php }?></div></div></div></div>

<?php }} else { ?>



<?php if($row["meeting"]==0){ ?>

<div class="userchatboxmain"><div class="userchatboxmain_me"><div  class="userchatboxmain_name_me" >&nbsp;</div><div class="userchatboxmain_text_me chatmsg<?php if (strpos($row["chatText"], 'iframe') !== false) { ?> iframehave<?php } ?>" <?php if($img==1){ ?>style=" padding:0px !important;"<?php } ?>>



<?php if($img==0){ echo nl2br(showsmily($row["chatText"])); } else { ?><div class="imgbox">

<img src="uploads/<?php echo $row["chatFileName"]; ?>" style="width:200px;" onClick="imagepopupmain('<?php echo 'x_'.$row["chatFileName"];?>');"/></div><?php } ?>



<div  class="userchatboxmain_time_me" id="usermsgid<?php echo $row['id'];?>"><?php if($row['readDate']!=0){echo date("h:i A",$row['readDate']);}else{ ?><?php echo date("h:i A");?><?php }?></div></div></div></div>



<?php }else{ ?>

<div class="userchatboxmain"><div class="userchatboxmain_me"><div  class="userchatboxmain_name_me" >&nbsp;</div>

 <div class="userchatboxmain_text_me">

	<div class="chatmsg" id="meeting<?php echo $row['id'];?>"><?php echo nl2br(showsmily($row["chatText"]));?></div>

	<script>

	$('#meeting<?php echo $row['id'];?>').load('<?php echo $fullurl; ?>meeting_inner.php?id=<?php echo $row['id'];?>&myId=<?php echo $_SESSION['sessUserId'];?>');

	</script>

	  <div  class="userchatboxmain_time_me" id="usermsgid<?php echo $row['id'];?>"><?php if($row['readDate']!=0){echo date("h:i A",$row['readDate']);}else{ ?><?php echo date("h:i A");?><?php }?>

	  </div>

 </div></div></div>

<?php } } ?>



 <?php

	 if($msgdate!=date("Y-m-d",$row['dateAdded']))

	{

	$msgdate=date("Y-m-d",$row['dateAdded']);

	}

} }





//$sql_ins="UPDATE "._CONTACT_MASTER_TABLE_." SET chatStatus=0 WHERE contactId= '".decode($userId2)."' AND userId='".$_SESSION["userid"]."' ";

//mysql_query($sql_ins) or die(mysql_error());









  ?>

<?php if($msgdate!=date("Y-m-d")){?>

<div class="chat-date"><?php echo date("j F Y");?></div>

<?php }?>



	<script>

	$("#loadchatusermsg").scrollTop($("#loadchatusermsg")[0].scrollHeight);

	setTimeout(function() {

		$("#loadchatusermsg").scrollTop($("#loadchatusermsg")[0].scrollHeight);

	  }, 500);





	window.setTimeout(function(){

		$('#loadchatusermsg').animate({

			scrollTop: $('#loadchatusermsg')[0].scrollHeight}, 2000);

	}, 1000);//unsued

	</script>



<input type="hidden" name="livechattotalpage" id="livechattotalpage" value="1" />