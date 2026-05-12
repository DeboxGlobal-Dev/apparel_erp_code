<?php

include_once('inc.php'); 
 
$imgId=$_REQUEST['imgId'];
 
?> 

 <div class="img-inner-pop">

    <a class="img-clos" onclick="$('#imagepopup').hide();"><i class="fa fa-times"></i> </a>
 
	<img src="<?php echo $fullurl;?>uploads/<?php echo $imgId; ?>">
 
  </div>