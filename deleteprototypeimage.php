<?php
include "inc.php"; 
include "config/logincheck.php"; 
$id=$_REQUEST['id'];
deleteRecord('imageGallery','id='.$_REQUEST['id'].'');
?>
<script>
parent.location.reload();
</script>