<div class="validationblackshade"  id="alertvalidation"><div class="alertbox">

 <div class="header" id="alertvalidationheader"></div>

 <div class="content" id="alertvalidationcontent" style="padding-bottom:10px;">

 

 </div><div style="padding:0px 0px 30px 0px; text-align:center;"><input type="button" name="button" value="OK" class="darkredbutton" style="margin-left:0px; position:inline-block; float:none;    width: 70px;" onclick="closeanydiv('alertvalidation');"  /></div>

 </div></div>
 
 
 
 <div id="alertnotificationsmainbox" style="display:none;">
 <div id="alertswhitebox"> 
 </div> 
 </div> 
 <script>
$(document).ready(function() {
$("#menudropdown,#menudropdownadd,#outerscroll,#rolelistscroll,#notificationbox").niceScroll({cursorborder:"",cursorcolor:"#bebebe",boxzoom:true});  
$("#body").niceScroll({cursorborder:"",cursorcolor:"#00F",boxzoom:true});  
});
</script>

<iframe id="actoinfrm" name="actoinfrm" src="" style="display:none;"></iframe>


 

<div id="pageloading"></div>
<div id="pageloader"><div id="loaderbox">Please Wait...</div></div>

<div id="actiondiv" style="display:none;"></div>
 


<?php if($_REQUEST['alt']==1 || $_REQUEST['alt']==2){ ?>

<div class="truefaulsmsgouter" id="truflsmsg">
<div class="truefaulsmsg"><table width="100%" border="0" align="center" cellpadding="7" cellspacing="0">
  <tr>
    <td width="3%" align="center" bgcolor="#3cb08b"><img src="images/check-circle-outline-32.png" width="32" height="32" /></td>
    <td width="97%" align="left">Successfully <?php if($_REQUEST['alt']==1){ echo 'Added'; } if($_REQUEST['alt']==2){ echo 'Updated'; } ?></td>
  </tr>
  
</table>
</div>
</div>
<script>
donesavingalt();


setTimeout(function() {   //calls click event after a certain time
   donesavingaltgo()
}, 2000);



</script>
<?php } ?>