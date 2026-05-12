<?php
include "inc.php";
include "config/logincheck.php";
$id=$_REQUEST['id'];

?>
<select class="form-control" name="line[]" id="line" multiple="multiple">
<?php
$select='*';
$where='1 and factoryId="'.$id.'" order by id asc';
$rs=GetPageRecord($select,'recorderMaster',$where);
while($rest=mysqli_fetch_array($rs)){

$kr=GetPageRecord('*','factoryLineMaster','id="'.$rest['line'].'"');
$linename=mysqli_fetch_array($kr);

?>
<option value="<?php echo $rest['line']; ?>"><?php echo $linename['lineName']; ?></option>
<?php } ?>
</select>

<script>
$(function() {
$('#line').multiselect({
includeSelectAllOption: true,
enableFiltering: true,
enableCaseInsensitiveFiltering: true,
filterPlaceholder: 'Search...'
});
});
</script>
