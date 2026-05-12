<?php

include_once('inc.php');

if($_REQUEST['contactId']!='' && $_REQUEST['action']=='chat' && trim($_REQUEST['text'])!=''){

include('mail.php');

$dateAdded=time();

$text=normalclean($_REQUEST["text"]);

$text=preg_replace('/^(?:<br\s*\/?>\s*)+/', '', $text);

if(trim($_REQUEST['text'])!=''){

$sql_ins="insert into chatMaster set status=1,userId='".$_SESSION["userid"]."',contactId='".decode($_REQUEST["contactId"])."',chatBy='".$_SESSION["userid"]."',dateAdded='$dateAdded',chatText= '".$text."'";
mysql_query($sql_ins) or die(mysql_error());
$lastchatid=mysql_insert_id();

$sql_ins="insert into chatMaster set status=0,userId='".decode($_REQUEST["contactId"])."',contactId='".$_SESSION["sessUserId"]."',chatBy='".$_SESSION["sessUserId"]."',dateAdded='$dateAdded',chatText= '".$text."'";
mysql_query($sql_ins) or die(mysql_error());

$sql_ins="UPDATE userMaster SET onlineLastUpdate=".time()." WHERE id=".$_SESSION["userid"]."  ";

mysql_query($sql_ins) or die(mysql_error());

?>
<div id="sendalert" style="display:none;"></div>


<script>
$('#loadchatusermsg').append('<div class="userchatboxmain"><div class="userchatboxmain_me"><div  class="userchatboxmain_name_me" >&nbsp;</div><div class="userchatboxmain_text_me"><div class="chatmsg"><?php echo showsmily($text); ?></div><div  class="userchatboxmain_time_me" id="usermsgid<?php echo $lastchatid;?>"><?php echo date("h:i A");?></div></div></div></div>');
$("#loadchatusermsg").scrollTop($("#loadchatusermsg")[0].scrollHeight);

</script>

<?php

$contactId=decode($_REQUEST['contactId']);

$a="SELECT * from userMaster WHERE id= ".$contactId." ";

		$b=mysql_query($a) or die(mysql_error());

		$userres=mysqli_fetch_array($b);

		$email=$userres['email'];
 			 //////////////////////

}

}


if(trim($_REQUEST['contactId'])!='' && $_REQUEST['action']=='getchat'){

$dateAdded=time();

$n=0;

	//unset($selectFields);

	//unset($whereFields);

	//unset($whereVals);

$sqlLogin="";

//$sqlLogin="select * from chatMaster where userId='".$_SESSION['userid']."' and contactId='".decode($_REQUEST['contactId'])."' and status=0 ORDER BY dateAdded asc LIMIT 0,1";

$resLogin=GetPageRecord('*','chatMaster','userId="'.$_SESSION['userid'].'" and contactId="'.decode($_REQUEST['contactId']).'" and status=0 ORDER BY dateAdded asc LIMIT 0,1');

	//$resLogin=getRecords(_CHAT_MASTER_TABLE_,$selectFields,$whereFields,$whereVals,_Y_,$sqlLogin);

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



$msgid=$row["id"];



$contentimg= 'x_'.$row["chatFileName"];

  ?>



<script>

var contentimg='<?php echo $contentimg;?>';


$('#loadchatusermsg').append('<div class="userchatboxmain"><div class="userchatboxmain_user"><div class="userchatboxmain_name">&nbsp;</div><div class="userchatboxmain_text" <?php if($img==1){ ?>style=" padding:0px !important;"<?php } ?>><?php if($img==0){?><div class="chatmsg<?php if (strpos($row["chatText"], 'maps/place') !== false) { ?> iframehave<?php } ?>"><?php echo nl2br(showsmily(str_replace("'","&#39;",$row["chatText"])));?></div><?php } else { ?><div class="imgbox"><img src="<?php echo $fullurl;?>uploads/<?php echo $row["chatFileName"]; ?>" style="width:200px;" onClick="imagepopupmain(\''+contentimg+'\');" /></div><?php } ?><div class="userchatboxmain_time"><?php echo date("h:i A",$row['dateAdded']); ?></div></div></div></div>');


$('#chatlist<?php echo ($_REQUEST['contactId']); ?>').removeClass('active');

$("#loadchatusermsg").scrollTop($("#loadchatusermsg")[0].scrollHeight);

</script>



<?php

$sql_ins="UPDATE chatMaster SET status=1 WHERE contactId= '".decode($_REQUEST['contactId'])."' AND userId='".$_SESSION["userid"]."' and id='".$msgid."' ";

mysql_query($sql_ins) or die(mysql_error());


if($row["meeting"]==1 && $row["status"]==0){

?>
<script>
parent.$('#loadchatusermsg').load("<?php echo $fullurl; ?>load_chat_user_msg.php?userId2=<?php echo $_REQUEST['contactId'];?>");

</script>

<?php }?>



<?php



}


//======================================

$sqlLogin2="";

//$sqlLogin2="select id,readDate,dateAdded from chatMaster where userId='".$_SESSION['userid']."' and contactId='".decode($_REQUEST['contactId'])."' and status=1 ORDER BY dateAdded desc LIMIT 0,1";

$resLogin2=GetPageRecord('*','chatMaster','userId="'.$_SESSION['userid'].'" and contactId="'.decode($_REQUEST['contactId']).'" and status=1 ORDER BY dateAdded asc LIMIT 0,1');

	//$resLogin2=getRecords(_CHAT_MASTER_TABLE_,$selectFields,$whereFields,$whereVals,_Y_,$sqlLogin2);

	  	while($row2=mysqli_fetch_array($resLogin2))

			{



		$aa="SELECT readDate from chatMaster where contactId='".$_SESSION['userid']."' and userId='".decode($_REQUEST['contactId'])."'  ORDER BY dateAdded desc						 LIMIT 0,1";

			$res5 = mysql_query($aa);


			$getread=mysqli_fetch_array($res5);

			if($getread['readDate']!=0 && $getread['readDate']!='')

			{

				?>

				<script>

				$('.fa-check-circle span').remove();

			$('.fa-check-circle').removeClass('fa-check-circle');

			$('#usermsgid<?php echo $row2['id']; ?>').html('<i class="fa fa-check-circle" aria-hidden="true"> <span>Read</span></i><?php echo date("h:i A",$row2['dateAdded']); ?>');

			</script>

				<?php



			}

 $sql_ins="UPDATE chatMaster SET readDate=".time()." WHERE readDate=0 and  contactId= '".decode($_REQUEST['contactId'])."' AND userId='".$_SESSION["userid"]."' ";

mysql_query($sql_ins) or die(mysql_error());

			}

}

closeConn();

?>