<?php
include "inc.php";
include "config/logincheck.php";

$id=$_REQUEST['id'];
$lineid=$_REQUEST['lineid'];

?>

<option value="">Select Line</option>
<?php
/*$select='*';
$where='1 and factoryId="'.$id.'" order by id asc';
$rs=GetPageRecord($select,'recorderMaster',$where);
while($rest=mysqli_fetch_array($rs)){ */
//echo 'factoryId="'.$id.'"';
$kr=GetPageRecord('*','factoryLineMaster','factoryId="'.$id.'"');
while($linename=mysqli_fetch_array($kr)){

?>
<option value="<?php echo $linename['id']; ?>" ><?php echo $linename['lineName']; ?></option>

<?php } ?>

