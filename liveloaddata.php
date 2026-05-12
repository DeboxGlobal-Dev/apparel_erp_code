<?php
include "inc.php";

$sno=1;
$rstype=GetPageRecord('*',_COLOR_CARD_MASTER_,'1 order by id asc');
while($resListingtype=mysqli_fetch_array($rstype)){

?>
<tr style="text-align:center;">
	<td><?php echo $sno; ?></td>
	<td><span class="spanColor" id="dataname<?php echo $resListingtype['id']; ?>"><?php echo $resListingtype['name']; ?></span></td>
	<td><span class="" ><?php echo $resListingtype['reference']; ?></span></td>
</tr>
 <script>
 setTimeout(function(){
 $("#dataname<?php echo $resListingtype['id']; ?>").hide().css('background', 'linear-gradient(red, transparent)').fadeIn(1500);
 }, 2000);
 </script>
<?php

 $sno++; } ?>

 <style>
 .spanColor{
 	color: white;
    background-color: blue;
    padding: 2px;
    border-radius: 4px;
    font-weight: 500;
 }
 </style>