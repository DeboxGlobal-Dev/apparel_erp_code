<?php
include "inc.php";
include "config/logincheck.php";


$select1='*';
$where1='url="'.$_GET['module'].'"';
$rs1=GetPageRecord($select1,_MODULE_MASTER_,$where1);
$modfile=mysqli_fetch_array($rs1);

$pageFileName=$modfile['moduleFile'];

if($_GET['add']=='yes' || $_GET['edit']=='yes'){
$pageFileName='add_'.$modfile['moduleFile'];
}

if($_GET['view']=='yes'){
$pageFileName='view_'.$modfile['moduleFile'];
}

if($_GET['permissions']=='yes'){
$pageFileName='permissions_'.$modfile['moduleFile'];
}


if($_GET['edit']=='' && $_GET['add']=='' && $_GET['view']=='' && $_GET['permissions']==''){
$pageFileName=$modfile['moduleFile'];
}

$pageName=$modfile['moduleName'];

$selecta='*';
$wherea='profileId='.$loginuserprofileId.' and moduleId='.$modfile['id'].'';
$rsa=GetPageRecord($selecta,_PERMISSION_MASTER_,$wherea);
$permissionmst=mysqli_fetch_array($rsa);

$viewpermission=$permissionmst['view'];
$addpermission=$permissionmst['addentry'];
$editpermission=$permissionmst['edit'];
$deletepermission=$permissionmst['dlt'];
$importpermission=$permissionmst['import'];
$exportpermission=$permissionmst['export'];
$selectedPage=$modfile['id'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $pageName; ?> - <?php echo $systemname; ?></title>
<?php  include "headerinclude.php"; ?>


</head>

<body style="background-color:#FFFFFF;">
<?php  include "header.php"; ?>
<?php  include "left.php"; ?>
 <?php include $pageFileName;  ?>




<?php require "footer.php"; ?>


<script>
function createaccount(){
setupbox('page.de?module=<?php echo clean($_GET['module']); ?>&add=yes');
}

function editaccount(id){
setupbox('page.de?module=<?php echo clean($_GET['module']); ?>&edit=yes&id='+id+'');
}

function view(id){
setupbox('page.de?module=<?php echo clean($_GET['module']); ?>&view=yes&id='+id+'');
}

function permissions(id){
setupbox('page.de?module=<?php echo clean($_GET['module']); ?>&permissions=yes&id='+id+'');
}


function cancel(){
setupbox('page.de?module=<?php echo clean($_GET['module']); ?>');
}

</script>

<div style="display:none;" id="actiondiv"></div>
</body>
</html>
