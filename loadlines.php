<?php
include "inc.php";
include "config/logincheck.php";

$id=$_REQUEST['id'];
$selectId=$_REQUEST['selectId'];

?>
 <select id="lines" multiple="multiple" name="lines[]" >
<?php
$select='*';
$where='1 and factoryId="'.$id.'" order by id asc';
$rs=GetPageRecord($select,'factoryLineMaster',$where);
while($rest=mysqli_fetch_array($rs)){  ?>
<option value="<?php echo $rest['id']; ?>"><?php echo $rest['lineName']; ?></option>
<?php } ?>
</select>

<script>
$(function() {
$('#lines').multiselect({
includeSelectAllOption: true,
enableFiltering: true,
enableCaseInsensitiveFiltering: true,
filterPlaceholder: 'Search...'
});
});
</script>
