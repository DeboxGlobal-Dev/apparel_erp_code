<?php
include "inc.php";
include "config/logincheck.php";

$id=$_REQUEST['id'];
$lastId=$_REQUEST['lastId'];
$sNo1a=$_REQUEST['sNo1a'];
$totalvarcounta=$_REQUEST['totalvarcounta'];

$firstQ=GetPageRecord('*','currencyMaster','1 and id=13');
$firstCurr=mysqli_fetch_array($firstQ);

$secondQ=GetPageRecord('*','currencyMaster','1 and id=14');
$secondCurr=mysqli_fetch_array($secondQ);

//echo $firstCurr['value'].'===================='.$secondCurr['value'].'**'.$sNo1.'--------'.$_REQUEST['costsheetVersionId'];

?>

<script>
var matPricevalueextra=0;
var matPricevalueextra = parent.$('#matPriceextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val();

<?php
if($id==13){ ?>
matPricevalueextra=matPricevalueextra*<?php echo $secondCurr['value']; ?>;
matPricevalueextra= Number(matPricevalueextra.toFixed(2));
parent.$('#matPriceextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val(matPricevalueextra);
<?php }else{ ?>
matPricevalueextra=matPricevalueextra/<?php echo $secondCurr['value']; ?>;
matPricevalueextra= Number(matPricevalueextra.toFixed(2));
parent.$('#matPriceextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val(matPricevalueextra);
<?php } ?>

parent.escape_landing_costa<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();
parent.value_on_pca<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();
parent.calTotalCosta<?php echo $totalvarcounta.$sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();


</script>