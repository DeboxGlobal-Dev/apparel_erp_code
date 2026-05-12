<?php
ob_start();  
include "inc.php";  
include "config/logincheck.php";  
ini_set('post_max_size', '200M'); 
ini_set('upload_max_filesize', '200M');  
?>
<script>alert('<?php echo $_POST['action']; ?>');</script>
<?
if(trim($_POST['action'])=='materialcostchat' && trim($_POST['editId'])!='' && trim($_POST['comment'])!=''){ 

$editId=clean(decode($_POST['editId'])); 
$bomSerialNo=clean($_POST['bomSerialNo']); 
$materialType=clean($_POST['materialType']); 
$materialId=clean($_POST['materialId']); 
$comment=clean($_POST['comment']); 
$status=clean($_POST['status']);

$dateAdded=time();
$namevalue ='styleId="'.$editId.'",bomSerialNo="'.$bomSerialNo.'",materialType="'.$materialType.'",materialId="'.$materialId.'",comment="'.$comment.'",addedBy="'.$_SESSION['userid'].'",dateAdded="'.$dateAdded.'"';  
$adds = addlisting('materialCostChatMaster',$namevalue); 
?>

<?php }

?>