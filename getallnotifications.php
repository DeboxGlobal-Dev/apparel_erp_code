<?php
include_once('inc.php');


	$sqlMessage="";

	$sqlMessage=mysql_query("select id,userId,contactId from "._CHAT_MASTER_TABLE_." where userId='".$_SESSION['sessUserId']."' and status=0 ORDER BY id DESC");

	 $getlasttotal=mysql_num_rows($sqlMessage);

?>

<script>

<?php if($getlasttotal>0){

while($getactivemsg=mysqli_fetch_array($sqlMessage))

{

?>

$('#chatlist<?php echo $getactivemsg["userId"];?>').addClass('active');

<?php

$sqlLastmsg="SELECT id,firstName,lastName,userurl from "._USER_MASTER_." WHERE id= ".$getactivemsg["contactId"]."";

$ressqlLastmsg = mysql_query($sqlLastmsg);

$getLsatUser=mysqli_fetch_array($ressqlLastmsg);



}

?>



parent.$("#msgnotificationnumber").show();

parent.$("#msgnotificationnumber").text('<?php echo $getlasttotal;?>');


//openuserchatbox('<?php echo encodeStr($getLsatUser['userId']);?>','<?php echo stripslashes(trim($getLsatUser["firstName"]));?> <?php echo stripslashes(trim($getLsatUser["lastName"]));?>','<?php echo $fullurl;?>profile/<?php echo encodeStr($getLsatUser['userId']);?>/<?php echo $getLsatUser["userurl"];?>.html');


<?php }else{ ?>

parent.$('title').text('<?php echo $companNameTitle;?>');

parent.$("#msgnotificationnumber").hide();

parent.$("#msgnotificationnumber").text('0');

<?php }?>

</script>
<?php
closeConn();
?>