<?php

include "inc.php"; 

include "config/logincheck.php";  

$id=$_REQUEST['id'];



if($_REQUEST['action'] == 'style'){
?>
<div id="partyAddrsId<?php echo $id; ?>">
<table width="143%">
	<tr>	
<td style="padding: 0px;width: 70%">
      <table class="intable" width="100%">
        <tr>
          <td>
          	<i class="fa fa-trash" onClick="removeAddInfo(<?php echo $id; ?>);" style="cursor:pointer;border: 1px solid black;border-radius: 44%;padding: 3px;"> </i>
          	&nbsp;&nbsp;<input style="width:66%" type="text" class="erpint" name="">
          </td>
          <td><input style="width:100%" type="text" class="erpint" name=""></td>
          <td><input style="width:100%" type="text" class="erpint" name=""></td>
          <td><input style="width:100%" type="text" class="erpint" name=""></td>
          <td><input style="width:100%" type="text" class="erpint" name=""></td>
        </tr>     
      </table>
    </td>
    <td><input style="width: 100%" type="number" class="erpint" name=""></td>
    <td><input style="width: 100%" type="number" class="erpint" name=""></td>
    <td><input style="width: 100%" type="number" class="erpint" name=""></td>        	 
    </tr>
</table>
</div>
<?php }

if($_REQUEST['action'] == 'dimension'){
?>
<div id="partyAddrsId1<?php echo $id; ?>">
<table width="100%" class="table intable3" style="border-top: none!important;border-bottom: none!important">
  <tr> 
     <td><span style="visibility: hidden;"><strong>DIMENSIONS</strong></span></td>
    <td><i class="fa fa-trash" onClick="removeAddInfo1(<?php echo $id; ?>);" style="cursor:pointer;border: 1px solid black;border-radius: 44%;padding: 3px;"> </i></td>
    <td><input type="text" class="erpint" style="width: 90%" name=""></td>
    <td><input type="text" class="erpint" style="width: 90%" name=""></td>
    <td><input type="text" class="erpint" style="width: 90%" name=""></td>
    <td><input type="text" class="erpint" style="width: 90%"  name=""></td>
    <td style="width: 50%"></td>
    </tr>
</table>
</div>
<?php } ?>


