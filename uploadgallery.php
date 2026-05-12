<?php
ob_start();  
include "inc.php";  
include "config/logincheck.php"; 

if($_FILES['attachmentImage']['name']!=''){ 
$file_name=$_FILES['attachmentImage']['name']; 
$file_name=time().'-'.$file_name; 
copy($_FILES['attachmentImage']['tmp_name'],"images/imageGallary/".$file_name); 


$namevalue ='attachmentImage="'.$file_name.'",parentId="'.$_POST['parentId'].'",galleryParentId="'.$_POST['galleryParentId'].'",galleryType="protoImageGallery"';   
addlistinggetlastid('imageGallery',$namevalue);
}
?>
<script>
parent.window.location.href='showpage.crm?module=prototypesample&add=yes&styleid=<?php echo encode($_POST['parentId']); ?>'; 
</script>