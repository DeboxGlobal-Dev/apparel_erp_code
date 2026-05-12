<?php
include "inc.php";
include "config/logincheck.php";


if($_REQUEST['action']=='showsize'){
     $where = 'id="'.$_REQUEST['id'].'"';
     $rs=GetPageRecord('*','sizerangeMaster',$where);
     $resListing=mysqli_fetch_array($rs);
     $sizes = $resListing['size'];
     $sizesArr = explode(':',$sizes);

?>

          <?php
          foreach($sizesArr as $sizedata){
          ?>
          <div class="grid-item"><label style="font-weight:700;width: 30px;"><?php echo $sizedata; ?></label>
               <input type="text" name="size[]" style="width: 60px;"  value="" />
          </div>

          <?php } ?>
          <input type="hidden" name="sizename" value="<?php echo $resListing['size']; ?>" >
<?php

}

?>

