 <?php

include_once('inc.php');

$id=decode($_GET['id']);

$a="SELECT * from userMaster WHERE id= '".$id."'";

			$b=mysql_query($a) or die(mysql_error());

			$chatuser=mysqli_fetch_array($b);

			if($chatuser["profilePhoto"]!=''){

			  $chatuserPhoto=$chatuser["profilePhoto"];

			  } else {

			  $chatuserPhoto='user-placeholder.jpg';

			  }

?>
<script src="https://virtualawfis.com/js/jquery.min.js"></script>

   <style type="text/css">

	.center_content{margin-bottom: 0;}

   </style>





 <div class="heddr">

 <?php if($mobile=='y'){ ?><a href="#" class="bck-btn" onclick="$('#msgchat').hide();$('.chat_list').show();$('#header').show();$('.container.main').css('padding-top','52px');"><i class="fa fa-arrow-left" aria-hidden="true"></i></a><?php }?>

         <div class="right-cht-had">

<?php
$select1='profileName';
$where1='id="'.$chatuser['profileId'].'"';
$rs1=GetPageRecord($select1,'profileMaster',$where1);
$res=mysqli_fetch_array($rs1);
?>


           <div class="grp-ttl"><?php echo $chatuser['firstName'];?> <?php echo $chatuser['lastName'].' - '.strip($res['profileName']);?>

		   </div>

         </div>

       </div>

       <div class="chats" id="loadchatusermsg" style="height:410px;padding-bottom: 10px;border-bottom: 2px solid #00a652;"></div>

       <div class="chat_fttr">



        <div class="chat-inpt">

        <span id="setchatarea">

        <textarea name="chatfieldfooter" id="chatfieldfooter" maxlength="800"  onclick="$('#selectbuttons').hide();" placeholder="Write a message here..."></textarea> </span>

       <form class="edit-layer" enctype="multipart/form-data" name="frmposthome2" id="frmposthome2" method="post" target="actionfrm" action="<?php echo $fullurl;?>common_action.php">

	   <span id="hpotohomeid"><input name="chatattachedfile" id="chatattachedfile" type="file"  onChange="uploaduserfilesfun();" style="display:none;" accept="image/x-png,image/gif,image/jpeg,application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf"></span>

	    <input type="hidden" name="action" id="action" value="chatattachedmsg" />

		<input type="hidden" name="contactchatuserid" id="contactchatuserid" value="" />

		<input type="hidden" name="loadmsgp" id="loadmsgp" value="0" />

	   </form>

	<script>

	function uploaduserfilesfun()

	{

	  $('#frmposthome2').submit();

	  $('#commonloader').show();



	 var hpotohomeid = $('#hpotohomeid').html();



	  $('#chatattachedfile').remove();

	  $('#hpotohomeid').html(hpotohomeid);



	}

	</script>

		   <ul class="emozi">

           <li class="emogi" style="margin-left:10px !important;">

           <a href="javascript:void(0)" class="emoji-toggle" onclick="$('.emoji-list').show()"><i class="fa fa-smile-o" aria-hidden="true" id="emogilist"></i></a>



           <ul class="emoji-list">

            <?php include('smily.php');?>

           </ul>

           </li>

		 <li class="atach" style="margin: -6px; font-size: 18px;"><a id="chatattachedbutton"><i class="fa fa-paperclip" aria-hidden="true"></i></a></li>



		 <li style="float:right;">

		 <div class="send-sec">



		   <?php

		   if($mobile=='y')

		   {

		  ?>

		  	<button class="send" id="sendbuttonchat" onclick="clicktosendchat();" style="background-color: rgb(71, 166, 220); display: block; padding: 4px;">Send</button>

		  <?php

		  }

		  else

		  {

		  ?>

			  <span id="sendpressenter">Press Enter to Send</span>

			  <button class="send" id="sendbuttonchat" onclick="clicktosendchat();" style="display: none; background-color: rgb(71, 166, 220); display: block; padding: 4px;" >Send</button>

			  <div class="click-btn">



			  <a id="sendclick"><i style="color: #47a6dc;"class="fa fa-ellipsis-h" aria-hidden="true" onclick="$('#selectbuttons').toggle();" id="openpressenter"></i></a>



			  <form class="edit-layer" enctype="multipart/form-data" name="frmposthome3" id="frmposthome3" method="post" target="actionfrm" action="<?php echo $fullurl;?>common_action.php">

			 <ul class="send-list" id="selectbuttons">

			   <li><label><input type="radio" name="setpressenter" id="pressenter" value="1" <?php if($_SESSION['sesssetpressenter']==1 || $_SESSION['sesssetpressenter']==''){?> checked="checked"<?php }?> onclick="$('#frmposthome3').submit();$('#sendpressenter').show();$('#sendbuttonchat').hide();$('#selectbuttons').hide();"><div class="presenter">Press Enter to Send</div></label></li>

			   <li><label><input type="radio" name="setpressenter" id="presssendbutton" value="2" onclick="$('#frmposthome3').submit();$('#sendpressenter').hide();$('#sendbuttonchat').show();$('#selectbuttons').hide();" <?php if($_SESSION['sesssetpressenter']==2){?> checked="checked"<?php }?>><div class="presenter">Click Send</div></label></li>

			 </ul>

			 </form>





			 </div>

		 <?php }?>



         </div></li>



       </ul>



      </div>

         <input type="hidden" name="chatuserid" id="chatuserid" value="<?php echo encode($id);?>" />

       </div>

	   <script>

		<?php if($_SESSION['sesssetpressenter']==2){?>

		$('#sendpressenter').hide();$('#sendbuttonchat').show();$('#selectbuttons').hide();

		<?php }else{?>

		$('#sendpressenter').show();$('#sendbuttonchat').hide();$('#selectbuttons').hide();

		<?php }?>



		<?php  if($mobile=='y'){?>

		$('#sendpressenter').hide();$('#sendbuttonchat').show();$('#selectbuttons').hide();

		<?php }?>

	  </script>

	   <script>

	   $(".chat-cont-user-list").removeClass('active1');

	   $("#chatlist<?php echo $id;?>").addClass('active1');



	   $("#chatfieldfooter").focus();

	    $("#loadchatusermsg").load('load_message.php?userId2=<?php echo encode($id);?>');





		function typeandsendchat(id){

//var chatfieldfooter = $('#chatfieldfooter').val();



var chatfieldfooter = $('#chatfieldfooter').val().replace(/\n/g, "<br />");

if(chatfieldfooter!="<br />")

{

	chatfieldfooter = encodeURIComponent($.trim(chatfieldfooter));



	if(chatfieldfooter!='' && id!=''){

	$('#textchatactiondiv').load('<?php echo $fullurl; ?>getchat.php?action=chat&contactId='+id+'&text='+chatfieldfooter);

	 $("#chatfieldfooter").focus();

	}

}

$("#chatfieldfooter").val('');



}



/*$("#chatfieldfooter").keypress(function(e) {

    if(e.which == 13) {

	var id = $('#chatuserid').val();

 	typeandsendchat(id);

    }

});*/



$("#chatfieldfooter").keypress(function(e) {

    if(e.which == 13) {

	var setpressenter = $('input[name=setpressenter]:checked').val();

	if(setpressenter==1)

	{

		var id = $('#chatuserid').val();

		typeandsendchat(id);

		e.preventDefault();

	}

    }

});



function clicktosendchat()

{

	var id = $('#chatuserid').val();

	typeandsendchat(id);

}



		//$("#loadchatusermsg").scrollTop($("#loadchatusermsg")[0].scrollHeight);





/*24-10-2017*/

$('#chatattachedbutton').click(function(){

    $('#chatattachedfile').click();

	var contactchatuserid=$('#chatuserid').val();

	$('#contactchatuserid').val(contactchatuserid);

	//alert($('#chatuserid').val());



});

/***********/

</script>

