<?php
include_once('inc.php');

$search=clean($_REQUEST['searchmsgcontacts']);

if($search!='')

{
	$strWhere="and (firstName like '%".$search."%' OR lastName like '%".$search."%') ";
}
else
{
	$strWhere="";

}

?>

  <?php


		$n=0;

		//unset($selectFields);

		//unset($whereFields);

		//unset($whereVals);

		$sqlMessage="";

		//$sqlMessage="select * from "._CHAT_MASTER_TABLE_." where userId='".$_SESSION['sessUserId']."' GROUP BY contactId ORDER BY id DESC  ";

		//echo $sqlMessage="select * from userMaster where id IN (select contactId from chatMaster where userId='".$_SESSION['userid']."') GROUP BY userId ORDER BY onlineLastUpdate DESC  ";

		//$sqlMessage="select * from userMaster where 1 and deletestatus=0 GROUP BY id ORDER BY id DESC";

		$resMessage=GetPageRecord('*','userMaster','1 and deletestatus=0 and id!="'.$_SESSION['userid'].'" ORDER BY id ASC');

		//$resMessage=getRecords('chatMaster',$selectFields,$whereFields,$whereVals,_Y_,$sqlMessage);

		while($rowMessage=mysqli_fetch_array($resMessage))

			{

			$a="SELECT * from userMaster WHERE id= ".$rowMessage["id"]." ".$strWhere." ";

			$b=mysql_query($a) or die(mysql_error());

			$userres=mysqli_fetch_array($b);


			$ac="SELECT * from chatMaster WHERE userId= ".$_SESSION['userid']." and contactId=".$rowMessage["id"]." order by id desc ";

			$bcc=mysql_query($ac) or die(mysql_error());

			$chat=mysqli_fetch_array($bcc);


			//$friendnameurl=$userres['userurl'];

				if($userres["profilePhoto"]!='')

			{

			$userphoto=$userres["profilePhoto"];

			} else {

			$userphoto='user-placeholder.jpg';

			}

			//$mycountryName=$userres["countryName"];

			//$mystateName=$userres["cityName"];

			//$mylocationName=$userres["locationName"];

			if($userres["firstName"]!='')

			{

		  ?>

		  <li>

<div class="chat-cont-user-list <?php if($rowMessage["chatStatus"]==1){  $s=1; ?>active1<?php } ?>" id="chatlist<?php echo $userres['id']; ?>" onclick="openuserchatbox('<?php echo encode($userres['id']); ?>');<?php if($mobile=='y'){ ?>$('#msgchat').show();$('.chat_list').hide();$('#header').hide();$('.container.main').css('padding-top','0px');<?php }?>" >

<?php if($userres['onlineStatus']==1){?>

              <div class="online <?php if($userres['onlineLastUpdate']<strtotime("-5 minutes", time())){?>standby<?php }?>"></div>

			  <?php }else{?>

			  <div class="offline"></div>

			  <?php }?>

<div class="chat-cont-user-list-img" ><img src="<?php echo $fullurl;?>profilepic/<?php echo stripslashes(trim($userphoto));?>"></div>

<div  class="chat-cont-user-list-right">

<div  class="chat-cont-user-list-name"><?php echo stripslashes(trim($userres["firstName"]));?> <?php echo stripslashes(trim($userres["lastName"]));?></div>

<?php
$select1='profileName';
$where1='id="'.$rowMessage['profileId'].'"';
$rs1=GetPageRecord($select1,'profileMaster',$where1);
$res=mysqli_fetch_array($rs1);
?>
<div class="chat-cont-user-list-company" style="color: #47a6dc;"> - <?php echo strip($res['profileName']); ?></div>


<div class="chat-cont-user-list-company"><?php echo strip_tags($chat["chatText"]); ?></div>

</div>



</div>



</li>

<?php

		 }

		 $n++;  }


		  ?>







<?php if($s==1){ ?>

<script>

$('#mainfriedboxlist').addClass('active1');

</script>



<?php } else { ?>

<script>

//$('#mainfriedboxlist').removeClass('active1');

</script>

<?php } ?>

