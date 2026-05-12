<?php
include "inc.php";
include "config/logincheck.php";

$id=$_REQUEST['id'];
$selectId=$_REQUEST['selectId'];

?>
<select id="line" name="line" class="form-control" onchange="selectDataStyle(this.value);">
<?php
$select='*';
$where='1 and factoryId="'.$id.'" order by id asc';
$rs=GetPageRecord($select,'factoryLineMaster',$where);
while($rest=mysqli_fetch_array($rs)){  ?>
<option value="<?php echo $rest['id']; ?>" <?php if($rest['id']==$selectId){ ?> selected="selected" <?php } ?>><?php echo $rest['lineName']; ?></option>
<?php } ?>
</select>


<script>
function selectDataStyle(lineid){
var factoryId='<?php echo $id; ?>';
var line=lineid;
var fromDate=$('#fromDate').val();

$('#loadrstyleinfo').load('loadstyleinfo.php?factoryId='+factoryId+'&line='+line+'&fromDate='+fromDate);

}
lineid=$('#line').val();
selectDataStyle(lineid);
</script>

