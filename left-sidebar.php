<?php if($_SESSION["sessUserId"]!='' && $_SESSION["sessUserId"]!=0){ ?>
<div class="selct_popup" style="display:none;" id="friedrequestbox">
    <div class="popup_cont"  style="text-align:left; width:500px;">
      <h4 class="usrname" style="font-size:20px; margin-bottom:20px;">Contact requests you received ( pending)</h4>

	  <div id="contactrequest" style="max-height:300px; overflow:auto;">Loading...</div>

	  <script>
	  $('#contactrequest').load('<?php echo $fullurl;?>contact_request.php');
	  </script>
<script type="text/javascript">
/*$(window).scroll(function() {
    if ($(this).scrollTop() > 160){
        $(".left_menu_sec").addClass("fix-head");
    }
    else{
        $(".left_menu_sec").removeClass("fix-head");
    }
});
$(window).scroll(function() {
    if ($(this).scrollTop() > 10){
        $(".left_menu_sec").addClass("smallfix");
    }
    else{
        $(".left_menu_sec").removeClass("smallfix");
    }
});
*/
	  </script>
    </div>
  </div>


<div class="left_menu_sec">
    <div class="menu">
      <ul class="nav_list">
	  <?php

		unset($selectFields);
		unset($whereFields);
		unset($whereVals);

		$sqlLogin1="";
		$sqlLogin1="select id from "._CONTACT_MASTER_TABLE_." where userId='".$_SESSION["sessUserId"]."' and status=1 ";
		$resLogin1=getRecords(_CONTACT_MASTER_TABLE_,$selectFields,$whereFields,$whereVals,_Y_,$sqlLogin1);
		if($resLogin1)
		{
			$lefttotalcontacts=mysqli_num_rows($resLogin1);
		}
		else
		{
			$lefttotalcontacts=0;
		}

		unset($selectFields);
		unset($whereFields);
		unset($whereVals);

		$sqlLogin="";
		$sqlLogin="select userurl,firstName,lastName,userstype,jobTitle,coursename,departmentname,companyName,roleid from "._USERS_MASTER_TABLE_." where userId='".$_SESSION['sessUserId']."' ";
		$resLogin=getRecords(_USERS_MASTER_TABLE_,$selectFields,$whereFields,$whereVals,_Y_,$sqlLogin);
		if($resLogin)
		{
			while($rowLogin=mysqli_fetch_array($resLogin))
			{
			 	$sessuserurl=$rowLogin["userurl"];
				$sessfirstName=$rowLogin["firstName"];
				$sesslastName=$rowLogin["lastName"];
				$sessname=ucfirst($sessfirstName).' '.ucfirst($sesslastName);
				$sessjobTitle=$rowLogin["jobTitle"];
				$sesscoursename=$rowLogin["coursename"];
				$sessdepartmentname=$rowLogin["departmentname"];
				$sesscompanyName=$rowLogin["companyName"];
				$sessuserstype=$rowLogin["userstype"];
				$sessroleid=$rowLogin["roleid"];

		    }
		}
		 ?>
       <?php if($pageIndex==22 && $lefttotalcontacts!=0){ ?>
	    <li class="connections" style="display:block;">
		  <span>Your connections</span>
            <h1><a href="<?php echo $fullurl;?>my-contacts.html"><?php echo $lefttotalcontacts;?></a></h1>
            <ul class="konections">
		<?php

		unset($selectFields);
		unset($whereFields);
		unset($whereVals);


		$sqlLogin2="";
		$sqlLogin2="select * from "._USERS_MASTER_TABLE_." where userId IN (select contactId from "._CONTACT_MASTER_TABLE_." where userId='".$_SESSION["sessUserId"]."' and status=1) and profilePhoto!='' order by rand() limit 0,4";
		$resLogin2=getRecords(_USERS_MASTER_TABLE_,$selectFields,$whereFields,$whereVals,_Y_,$sqlLogin2);
		if($resLogin2)
		{
			while($rowLogin2=mysqli_fetch_array($resLogin2))
			{

			$a2="SELECT * from "._USERS_MASTER_TABLE_." WHERE userId= ".$rowLogin2["userId"]."";
			$b2=mysql_query($a2) or die(mysql_error());
			$userres2=mysqli_fetch_array($b2);

				$friendnameurl2=$userres2['userurl'];
				if($userres2["profilePhoto"]!='')
				{
				$userphoto2=$userres2["profilePhoto"];
				} else {
				$userphoto2='user-placeholder.jpg';
				}

		  ?>
                <li><a href="<?php echo $fullurl;?>my-contacts.html"><img src="<?php echo $fullurl;?>uploads/<?php echo stripslashes(trim($userphoto2));?>" alt="<?php echo $userres2["firstName"].' '.$userres2["lastName"];?>" title="<?php echo $userres2["firstName"].' '.$userres2["lastName"];?>"></a></li>
               <?php

		     }

		   }
		  ?>
            </ul>
			<a class="seealllinks" href="<?php echo $fullurl;?>my-contacts.html">All</a>
        </li>
		<?php }else{?>
        <li class="user" style="border-bottom: solid 12px #f0f0f0;">
        	<div class="usr-bg">
        		<div class="user-bg-cover">&nbsp;</div>
            <span class="img"><a href="<?php echo $fullurl;?>myprofile/<?php echo encodeStr($_SESSION['sessUserId']);?>/<?php echo $sessuserurl;?>.html"><img src="<?php echo $fullurl;?>uploads/<?php echo $myprofilePhoto; ?>"></a><!--<a><img src="<?php echo $fullurl;?>uploads/<?php echo $myprofilePhoto; ?>" onClick="imgpopupprofiles('<?php echo 'x_'.$myprofilePhoto;?>','1');"></a>--></span>
        </div>
            <div class="usr-right">
                <a href="<?php echo $fullurl;?>myprofile/<?php echo encodeStr($_SESSION['sessUserId']);?>/<?php echo $sessuserurl;?>.html"><span class="usrnme"><?php echo $sessname;?></span></a>
                <span class="usrdesc">
				<?php
				echo $sessjobTitle;
				 ?>
				</span>
                <span class="usrstatic"><?php echo $sesscompanyName;?></span>
            </div>
            <div class="usr-info">

            		<div class="connctn" onclick="location.href='<?php echo $fullurl;?>my-contacts.html';">
            			<span class="connct"><a>Contacts</a></span>
            			<span class="count"><?php echo $lefttotalcontacts;?></span>
            		</div>

            		<div class="connctn" onclick="location.href='<?php echo $fullurl;?>profile-views.html';">
            			 <span class="connct"><a>Views</a></span>  <span class="count">
						<?php
						$totalprofileview=0;
						$lasdate=$day_before = date( 'Y-m-d', strtotime( date('Y-m-d') . ' -90 day' ) );
						$sql_inssa="select count(*) as totalprofile from "._USER_PROFILE_VIEW_TABLE_." where userId='".$_SESSION["sessUserId"]."' and dateAdded>='".$lasdate."'";
						$resresultsa=mysql_query($sql_inssa) or die(mysql_error());
						$rowresultsa=mysqli_fetch_array($resresultsa);
						 if($rowresultsa['totalprofile']>0)
						 {
						 echo  $totalprofile=$rowresultsa['totalprofile'];
						 }
						 else
						 {
						 echo  $totalprofile='0';
						 }


						?></span>

            		</div>

            		<div class="connctn" onclick="location.href='<?php echo $fullurl;?>activity.html?view=<?php if($rowpostview['postType']==3){ echo '2';}else{ echo '1';}?>';">
            		<span class="connct"><a><?php if($userTotalActivity>1){ echo 'Actions';}else{ echo 'Actions';}?></a></span>  <span class="count">
					<?php
					unset($selectFields);
					unset($whereFields);
					unset($whereVals);
					$olddateAdded=strtotime(date('Y-m-d H:i:s',strtotime("-2 days")));
					$userTotalActivity=0;
							$sqlpost2="";
							$sqlpost2="select id from "._SHAREANDUPDATES_TABLE_." where userId='".$_SESSION["sessUserId"]."' and adType=0 and dateAdded>".$olddateAdded." and (postType=2 OR  postType=3) and articleBlogStatus=0";
							$resSqlpost2=getRecords(_SHAREANDUPDATES_TABLE_,$selectFields,$whereFields,$whereVals,_Y_,$sqlpost2);
							echo $userTotalActivity+=mysqli_num_rows($resSqlpost2);



					?></span>

            		</div>
            </div>



        </li>
        <?php }?>

	    <li style="display: none;">
			<a href="#" class="ripple"><i class="micon"><i class="fa fa-newspaper-o" aria-hidden="true"></i></i>
			<span class="tltp">News</span></a>
        </li>
		<li style="">
			<a href="<?php echo $fullurl;?>mailbox.html"  class="<?php if($pageIndex==51){ ?>active<?php } ?> ripple">
				<i class="micon" style="background-color: #ff7800;"><i class="fa fa-envelope" aria-hidden="true"></i></i>
			<span class="tltp">Mail</span></a>
        </li>
		<li style="">
			<a href="<?php echo $fullurl;?>task.html"  class="<?php if($pageIndex==3){ ?>active<?php } ?> ripple">
				<i class="micon" style="background-color: #ff7800;"><i class="fa fa-list" aria-hidden="true"></i></i>
			<span class="tltp">Tasks</span></a>
        </li>

		<li style="">
			<a href="<?php echo $fullurl;?>addressbook.html"  class="<?php if($pageIndex==52){ ?>active<?php } ?> ripple">
				<i class="micon" style="background-color: #ff7800;"><i class="fa fa-address-card" aria-hidden="true"></i></i>
			<span class="tltp">Address Book</span></a>
        </li>

		<li style="">
			<a href="<?php echo $fullurl;?>articles-and-trivia.html"  class="<?php if($pageIndex==7){ ?>active<?php } ?> ripple">
				<i class="micon" style="background-color: #ff7800;"><i class="fa fa-file-text-o" aria-hidden="true"></i></i>
			<span class="tltp">Articles & Blogs</span></a>
        </li>

		<li>
			<a href="<?php echo $fullurl;?>events.html"  class="<?php if($pageIndex==10){ ?>active<?php } ?> ripple">
			<i class="micon"><i class="fa fa-calendar" aria-hidden="true"></i></i>
			<span class="tltp">Events Calendar</span></a>
        </li>

		<li>
			<a href="<?php echo $fullurl;?>projects.html"  class="<?php if($pageIndex==11){ ?>active<?php } ?> ripple">
			<i class="micon" style="background-color: #1db055;"><i class="fa fa-globe" aria-hidden="true"></i></i>
			<span class="tltp">Projects By Freelancers</span></a>
        </li>

				<?php
		if($sessroleid=='1'){
		?>
        <li style="">
			<a href="<?php echo $fullurl;?>find-mentor.html"  class="<?php if($pageIndex==26){ ?>active<?php } ?> ripple">
				<i class="micon" style="background-color: #ff7800;"><i class="fa fa-handshake-o" aria-hidden="true"></i></i>
			<span class="tltp">Mentor - Mentee Connect</span></a>
        </li>
		<?php
		}else{ ?>
		<li style="">
			<a href="<?php echo $fullurl;?>become-a-mentor.html"  class="<?php if($pageIndex==27){ ?>active<?php } ?> ripple">
				<i class="micon" style="background-color: #ff7800;"><i class="fa fa-handshake-o" aria-hidden="true"></i></i>
			<span class="tltp">Mentor - Mentee Connect</span></a>
        </li>
		<?php
		}
		?>



		<li>
			<a href="<?php echo $fullurl;?>jobs.html"  class="<?php if($pageIndex==14){ ?>active<?php } ?> ripple">
			<i class="micon" style="background-color: #1db055;"><i class="fa fa-briefcase" aria-hidden="true"></i></i>
			<span class="tltp">Employee Referrals</span></a>
        </li>

		 <li>
			<a href="<?php echo $fullurl;?>talent-virual.html"  class="<?php if($pageIndex==13){ ?>active<?php } ?> ripple">
			<i class="micon"><i class="fa fa-star" aria-hidden="true"></i></i>
			<span class="tltp">Talent Profiles</span></a>
        </li>

		 <li style="display:none;">
			<a href="<?php echo $fullurl;?>companies.html"  class="<?php if($pageIndex==53){ ?>active<?php } ?> ripple">
				<i class="micon"><i class="fa fa-building-o" aria-hidden="true"></i></i>
			<span class="tltp">Company Profiles</span></a>
        </li>

		 <li>
			<a href="<?php echo $fullurl;?>trainings.html"  class="<?php if($pageIndex==8){ ?>active<?php } ?> ripple">
				<i class="micon"><i class="fa fa-building-o" aria-hidden="true"></i></i>
			<span class="tltp">Trainings & Feedbacks</span></a>
        </li>

        <li style="border-bottom: solid 2px #00a652;">
			<a href="<?php echo $fullurl;?>smb.html"  class="<?php if($pageIndex==12){ ?>active<?php } ?> ripple">
			<i class="micon" style="background-color: #ff7800;"><i class="fa fa-industry" aria-hidden="true"></i></i>
			<!--<img src="images/bl_739_talent_lamp_businessman_lamp_energy_creativity_idea-512.png">-->
			<span class="tltp">Knowledge Partners</span></a>
        </li>
        <li class="hiden-d">
			<a href="<?php echo $fullurl;?>settings.html" class="ripple">
			<i class="micon" style="background-color: #ff7800;"><i class="fa fa-cog" aria-hidden="true"></i></i>
			<span class="tltp">Setting</span></a>
        </li>
        <li class="hiden-d">
			<a href="<?php echo $fullurl;?>logout.html" class="ripple">
			<i class="micon"><i class="fa fa-sign-out" aria-hidden="true"></i></i>
			<span class="tltp">Logout</span></a>
        </li>
		<li class="hiden-d" style="padding:0px 15px;">
		   <div style="float:left;padding: 4px 0px;"><span class="tltp" style="color: #969696;">Powered by </span></div>
		   <div style="float:left"> <a href="http://deboxglobal.com/" style="padding: 0px 12px;"><img src="<?php echo $fullurl;?>images/Logo De Boxpng.png" style="width:50px;"></a></div>
		</li>
      </ul>
    </div>
	<script>
	function opendiffchatbox(id){
	 $('#msgchatguide').html('');
	 $('#msgchatguide').load('<?php echo $fullurl; ?>guide-messaging.html?msgchatId='+id);
	 }
	</script>
	<?php
	if($sessroleid=='2'){
	?>
    <div>
	  <ul class="studenmentlist111" style="text-align:right;">
	    <li class="mentetex1t111">Mentees</li>
		<?php
		unset($selectFields);
		unset($whereFields);
		unset($whereVals);

		$sqlLogin="";
		$sqlLogin="select * from "._STUDENT_REQUEST_MENTOR_FRND_MASTER_TABLE_." where mentorId='".$_SESSION['sessUserId']."'and status=1";
		$resLogin=getRecords(_STUDENT_REQUEST_MENTOR_FRND_MASTER_TABLE_,$selectFields,$whereFields,$whereVals,_Y_,$sqlLogin);

		if($resLogin)
		{
			while($rowLogin=mysqli_fetch_array($resLogin))
			{
				$a="SELECT * from "._USERS_MASTER_TABLE_." WHERE userId= ".$rowLogin["studentId"]."";
				$b=mysql_query($a) or die(mysql_error());
				$userres=mysqli_fetch_array($b);

				$unrmsg="SELECT count(*) as total from "._STUDENT_MENTOR_CHAT_MASTER_TABLE_." where userId='".$_SESSION['sessUserId']."' and contactId='".$rowLogin["studentId"]."' and status='0'";
		        $unrmsgQry=mysql_query($unrmsg) or die(mysql_error());
		        $unredmsg=mysqli_fetch_assoc($unrmsgQry);
				$non=$unredmsg['total'];

				$friendnameurl=$userres['userurl'];
				if($userres["profilePhoto"]!='')
				{
				$userphoto=$userres["profilePhoto"];
				} else {
				$userphoto='user-placeholder.jpg';
				}
		?>
		   <li>
			  <div class="reltposindiv">
			    <div class="usrprofileinewimg">
				   <?php if($userres['onlineStatus']==1){?>
                     <div id="vbonlineoffline" class="online <?php if($userres['onlineLastUpdate']<strtotime("-5 minutes", time())){?>standby<?php }?>">
					 </div>
			           <?php }else{?>
			             <div id="vbonlineoffline" class="offline"></div>
			            <?php }?>


					   <span class="frnd-tltp" id="messagenotificationnumber" style="<?php ?>"><?php echo $unredmsg['total'];?></span>

					<a href="<?php echo $fullurl;?>guide-messaging.html?msgchatId=<?php echo encodeStr($userres['userId']);?>">
					   <div class="userprofilechatimgdiv">
					     <img id ="chatusernum<?php echo $userres['userId'];?>" onclick ="opendiffchatbox('<?php echo encodeStr($userres['userId']);?>')" src="<?php echo $fullurl;?>uploads/<?php echo stripslashes(trim($userphoto));?>" style="cursor:pointer;">
					   </div>
					</a>
				</div>
				<div>
				 <span><?php echo preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $userres["firstName"]);?> <?php echo preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $userres["lastName"]);?></span>
				</div>
			  </div>
		   </li>
		<?php
		}
		}
		?>
	   </ul>
	</div>
	<?php
		}
		if($sessroleid=='1'){
		?>
	<div>
	  <ul class="studenmentlist111">
	    <li class="mentetex1t111">Mentors</li>
		<?php

		unset($selectFields);
		unset($whereFields);
		unset($whereVals);

		$sqlLogin="";
		$sqlLogin="select * from "._STUDENT_REQUEST_MENTOR_FRND_MASTER_TABLE_." where studentId='".$_SESSION['sessUserId']."'and status=1";
		$resLogin=getRecords(_STUDENT_REQUEST_MENTOR_FRND_MASTER_TABLE_,$selectFields,$whereFields,$whereVals,_Y_,$sqlLogin);
		if($resLogin)
		{
			while($rowLogin=mysqli_fetch_array($resLogin))
			{
				$a="SELECT * from "._USERS_MASTER_TABLE_." WHERE userId= ".$rowLogin["mentorId"]." limit 1";
				$b=mysql_query($a) or die(mysql_error());
				$userres=mysqli_fetch_array($b);

				$unrmsg="SELECT count(*) as totalm from "._STUDENT_MENTOR_CHAT_MASTER_TABLE_." where userId='".$_SESSION['sessUserId']."' and contactId='".$rowLogin["mentorId"]."' and status='0'";
		        $unrmsgQry=mysql_query($unrmsg) or die(mysql_error());
		        $unredmsg=mysqli_fetch_assoc($unrmsgQry);

				$friendnameurl=$userres['userurl'];
				if($userres["profilePhoto"]!='')
				{
				$userphoto=$userres["profilePhoto"];
				} else {
				$userphoto='user-placeholder.jpg';
				}
		?>
		   <li>
			  <div class="reltposindiv">
			    <div class="clearfix usrprofileinewimg">
				 <div id="vbonlineoffline" class="online <?php if($userres['onlineLastUpdate']<strtotime("-5 minutes", time())){?>standby<?php }?>"></div>
				 <span class="frnd-tltp" id="messagenotificationnumber" style=""><?php echo $unredmsg['totalm'];?></span>
			      <a href="<?php echo $fullurl;?>guide-messaging.html?msgchatId=<?php echo encodeStr($userres['userId']);?>" >
				  <img src="<?php echo $fullurl;?>uploads/<?php echo stripslashes(trim($userphoto));?>">
				  </a>
				</div>
				<div>
				 <span id ="chatusernum<?php echo $userres['userId'];?>" onclick ="opendiffchatbox('<?php echo encodeStr($userres['userId']);?>')" style="cursor:pointer;"><?php echo preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $userres["firstName"]);?> <?php echo preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $userres["lastName"]);?></span>
				</div>
			  </div>
		   </li>
		<?php
		}
		}
		?>
	   </ul>
	</div>
		<?php
		}
		?>
  </div>


  <?php }?>