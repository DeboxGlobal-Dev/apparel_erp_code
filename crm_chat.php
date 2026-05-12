<link rel="stylesheet" type="text/css" href="<?php echo $fullurl; ?>css/style.css">
<?php /*?><link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"><?php */?>
<?php /*?><script src="https://virtualawfis.com/js/jquery.min.js"></script><?php */?>
<?php /*?><script src="https://virtualawfis.com/js/main.js"></script>
<script src="https://virtualawfis.com/js/URI.js"></script><?php */?>

<style>
.center_content {
    margin-bottom: 0;
    padding-left: 0;
    width: 75%;
}
@media only screen and (min-width: 800px) and (max-width: 1024px) {
.center_content {
    margin-bottom: 0;
    padding-right: 0;
    width: 100%;
    padding-left: 0;
}
}
ul.cht_mmbr_list.message li .chat-cont-user-list.active1 {
background-color: rgb(231, 231, 231);
}

@media only screen and  (max-width: 767px) {
.copyright_cont{display: none;}
}

.chat_list {
    width: 20%;
    float: left;
    border-right: solid 1px #e7e7e7;
}

div#msgchat {
    float: left;
    width: 80%;
}
.center_content {
    margin-bottom: 0;
    padding-left: 0;
    width: 100%;
}

.chat_fttr {
    background-color: #ffffff;

}

</style>

<div class="content pt-0" style="margin-top:20px;">
        <div class="ffsdf" style="margin-top: 0 !important;">

      <div class="center_content">
  <div class="my-message grup-dtail">

	 <div class="chat_list">

	 <h3>Conversations <a href="#" class="bulkmsg"><i class="fa fa-pencil-square-o" aria-hidden="true" style="display:none;" onClick="funcommonpopupwin('520px','auto','<?php echo $fullurl;?>/common_popup_inner.php?type=sendbulkemails','New message');"></i></a></h3>
<div class="search-friend"><input type="text" name="searchmsgcontacts" id="searchmsgcontacts" value="" onKeyUp="msgsearch();" placeholder="Search contacts"><img src="images/search_icon.png" onClick="msgsearch();"></div>


       <ul class="cht_mmbr_list message" id="msgusers">

       </ul>
     </div>


     <div class="chat_box" id="msgchat">

     </div>


  </div>
  </div>
    </div>
  </div>

  <div id="textchatactiondiv"  style="display:none;"></div>
</div>
<script>
function msgsearch()
{
	var searchmsgcontacts = $("#searchmsgcontacts").val();
	searchmsgcontacts=encodeURIComponent(searchmsgcontacts);
	$('#msgusers').load('<?php echo $fullurl; ?>msgusers.php?searchmsgcontacts='+searchmsgcontacts);
}
$('#msgusers').load('<?php echo $fullurl; ?>msgusers.php');


function openuserchatbox(id){

$('#msgchat').html('');
$('#msgchat').load('<?php echo $fullurl; ?>msgchat.php?id='+id);
//$("#msgchat").scrollTop($("#loadchatusermsg")[0].scrollHeight);
$("#chatfieldfooter").focus();
}

function smilyfun(val)

{
  $('.emoji-list').hide();
   chatfieldfooter='';
   if($("#chatfieldfooter").val()!='')
   {
     var chatfieldfooter = $("#chatfieldfooter").val();
   }

    $("#chatfieldfooter").val(chatfieldfooter+' '+val);
    $("#chatfieldfooter").focus();
}


var handle = setInterval(function(){

$('#getnotifications').load('<?php echo $fullurl; ?>getallnotifications.php');

}, 10000);


<?php

	$sqlMessage="";
	$sqlMessage=mysql_query("select * from chatMaster where contactId='".$_SESSION['sessUserId']."' ORDER BY id DESC LIMIT 0,1  ");
	$getlastuser=mysqli_fetch_array($sqlMessage);
if($_GET["u"]!='')
{
?>
openuserchatbox('<?php echo $_GET["u"];?>');
<?php
}
else
{
?>
openuserchatbox('<?php echo encode($getlastuser['userId']);?>');
<?php
}
?>
function clearint(){
clearInterval(handle);
}
var blurvalue=2;
clearInterval(handle);


$(window).blur(function(e) {
$('#keywordsearch').val();
blurvalue=1;
});

$(window).focus(function(e) {
$('#keywordsearch').val();
blurvalue=2;
});

var handle2 = setInterval(function(){

if(blurvalue==2){
var id = $('#chatuserid').val();
$('#textchatactiondiv').load('<?php echo $fullurl; ?>getchat.php?action=getchat&contactId='+id);
//$('#msgusers').load('<?php echo $fullurl; ?>msgusers.php');
 }

}, 1500);


function meetingattend(id,userid,status)
{
$('#'+id+' ul li a').removeClass('active');

if(status==1)
{
	$('#'+id+' span').html('Yes i am attending');
	$('#'+id+' ul li a.yes').addClass('active');
}
if(status==2)
{
	$('#'+id+' span').html('Maybe i am attending');
	$('#'+id+' ul li a.maybe').addClass('active');
}
if(status==3)
{
	$('#'+id+' span').html('I am not attending');
	$('#'+id+' ul li a.no').addClass('active');
}

$('#textchatactiondiv').load('<?php $fullurl; ?>common_action.php?action=meetingstatus&chatId='+id+'&userid='+userid+'&status='+status);
}
</script>
</body>
</html>
