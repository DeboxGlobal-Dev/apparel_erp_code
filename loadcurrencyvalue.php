<?php
include "inc.php";
include "config/logincheck.php";

$id=$_REQUEST['id'];
$lastId=$_REQUEST['lastId'];
$sNo1=$_REQUEST['sNo1'];
$totalvarcount=$_REQUEST['totalvarcount'];


$firstQ=GetPageRecord('*','currencyMaster','1 and id=13');
$firstCurr=mysqli_fetch_array($firstQ);

$secondQ=GetPageRecord('*','currencyMaster','1 and id=14');
$secondCurr=mysqli_fetch_array($secondQ);

//echo $firstCurr['value'].'===================='.$secondCurr['value'].'**'.$sNo1.'--------'.$_REQUEST['costsheetVersionId'];

?>

<script>
var matPricevalue=0;
var matPricevalue = parent.$('#matPrice<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val();

<?php
if($id==13){ ?>
matPricevalue=matPricevalue*<?php echo $secondCurr['value']; ?>;
matPricevalue= Number(matPricevalue.toFixed(2));
parent.$('#matPrice<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val(matPricevalue);
<?php }else{ ?>
matPricevalue=matPricevalue/<?php echo $secondCurr['value']; ?>;
matPricevalue= Number(matPricevalue.toFixed(2));
parent.$('#matPrice<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val(matPricevalue);
<?php } ?>
parent.escape_landing_cost<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();
parent.value_on_pc<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();
parent.calTotalCost<?php echo $totalvarcount.$sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();
</script>