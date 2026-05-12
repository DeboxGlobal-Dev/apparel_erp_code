<?php
include "inc.php";
include "config/logincheck.php";

$id=$_REQUEST['id'];
$lineid=$_REQUEST['lineid'];

?>
<select class="form-control" name="line" id="line" onchange="selectDataStyle(this.value);">
<option value="">Select Line</option>
<?php
$select='*';
$where='1 and factoryId="'.$id.'" order by id asc';
$rs=GetPageRecord($select,'recorderMaster',$where);
while($rest=mysqli_fetch_array($rs)){

$kr=GetPageRecord('*','factoryLineMaster','id="'.$rest['line'].'"');
$linename=mysqli_fetch_array($kr);

?>
<option value="<?php echo $rest['line']; ?>" <?php if($lineid==$rest['line']){ ?> selected="selected" <?php } ?>><?php echo $linename['lineName']; ?></option>
<?php } ?>
</select>

<script>
function selectDataStyle(lineid){
var factoryId='<?php echo $id; ?>';
var line=lineid;
var fromDate=$('#fromDate').val();

$('#loadrstyleinfo').load('loadstyleinfo.php?factoryId='+factoryId+'&line='+line+'&fromDate='+fromDate);

}
</script>