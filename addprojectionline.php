<?php
include "inc.php";

if($_REQUEST['add']==1){
$namevalueadd = 'addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'"';
addlistinggetlastid('projectionPlanMaster',$namevalueadd);
}

if($_REQUEST['deletestatus']=="yes" && $_REQUEST['id']!=''){
deleteRecord('projectionPlanMaster','id="'.$_REQUEST['id'].'"');
}

$aprilTotalQty='0';
$n=1;
$where12='1 order by id asc';
$rs12=GetPageRecord('*','projectionPlanMaster',$where12);
while($hotellist=mysqli_fetch_array($rs12)){

$aprilTotalQty = $aprilTotalQty+$hotellist['aprilQty'];

?>

<tr>
  <td ><i class="icon-trash" style="font-size:20px;cursor:pointer; color:#FF0000;" onclick="deleteRow<?php echo $hotellist['id']; ?>();" ></i></td>
  <td>
  <select name="buyerId" id="buyerId<?php echo $hotellist['id']; ?>" style="height: 30px;" onchange="saveprojectiondate<?php echo $hotellist['id']; ?>();">
  	<option value="">Select</option>
	<?php
	$rs=GetPageRecord('*','buyerMaster','1 and deletestatus=0 order by name asc');
	while($reslist=mysqli_fetch_array($rs)){
	?>
	<option value="<?php echo $reslist['id']; ?>" <?php if($hotellist['buyerId']==$reslist['id']){ echo "selected"; } ?>><?php echo $reslist['name']; ?></option>
	<?php } ?>
  </select>
  </td>
  <td><div align="center"><input type="number"  id="aprilQty<?php echo $hotellist['id']; ?>" onkeyup="saveprojectiondate<?php echo $hotellist['id']; ?>();" style="height: 30px; width: 60px; text-align:center;" value="<?php echo $hotellist['aprilQty']; ?>" placeholder="Qty" /></div></td>
  <td><div align="center"><input type="number"  id="aprilPrice<?php echo $hotellist['id']; ?>" onkeyup="saveprojectiondate<?php echo $hotellist['id']; ?>();" style="height: 30px; width: 60px; text-align:center;" value="<?php echo $hotellist['aprilPrice']; ?>" placeholder="Price" /></div></td>
  <td><div align="center"><input type="number"  id="mayQty<?php echo $hotellist['id']; ?>" onkeyup="saveprojectiondate<?php echo $hotellist['id']; ?>();" style="height: 30px; width: 60px; text-align:center;" value="<?php echo $hotellist['mayQty']; ?>" placeholder="Qty" /></div></td>
  <td><div align="center"><input type="number"  id="mayPrice<?php echo $hotellist['id']; ?>" onkeyup="saveprojectiondate<?php echo $hotellist['id']; ?>();" style="height: 30px; width: 60px; text-align:center;" value="<?php echo $hotellist['mayPrice']; ?>" placeholder="Price" /></div></td>
  <td><div align="center"><input type="number"  id="juneQty<?php echo $hotellist['id']; ?>" onkeyup="saveprojectiondate<?php echo $hotellist['id']; ?>();" style="height: 30px; width: 60px; text-align:center;" value="<?php echo $hotellist['juneQty']; ?>" placeholder="Qty" /></div></td>
  <td><div align="center"><input type="number"  id="junePrice<?php echo $hotellist['id']; ?>" onkeyup="saveprojectiondate<?php echo $hotellist['id']; ?>();" style="height: 30px; width: 60px; text-align:center;" value="<?php echo $hotellist['junePrice']; ?>" placeholder="Price" /></div></td>
  <td><div align="center"><input type="number"  id="julyQty<?php echo $hotellist['id']; ?>" onkeyup="saveprojectiondate<?php echo $hotellist['id']; ?>();" style="height: 30px; width: 60px; text-align:center;" value="<?php echo $hotellist['julyQty']; ?>" placeholder="Qty" /></div></td>
  <td><div align="center"><input type="number"  id="julyPrice<?php echo $hotellist['id']; ?>" onkeyup="saveprojectiondate<?php echo $hotellist['id']; ?>();" style="height: 30px; width: 60px; text-align:center;" value="<?php echo $hotellist['julyPrice']; ?>" placeholder="Price" /></div></td>
  <td><div align="center"><input type="number"  id="augQty<?php echo $hotellist['id']; ?>" onkeyup="saveprojectiondate<?php echo $hotellist['id']; ?>();" style="height: 30px; width: 60px; text-align:center;" value="<?php echo $hotellist['augQty']; ?>" placeholder="Qty" /></div></td>
  <td><div align="center"><input type="number"  id="augPrice<?php echo $hotellist['id']; ?>" onkeyup="saveprojectiondate<?php echo $hotellist['id']; ?>();" style="height: 30px; width: 60px; text-align:center;" value="<?php echo $hotellist['augPrice']; ?>" placeholder="Price" /></div></td>
  <td><div align="center"><input type="number"  id="sepQty<?php echo $hotellist['id']; ?>" onkeyup="saveprojectiondate<?php echo $hotellist['id']; ?>();" style="height: 30px; width: 60px; text-align:center;" value="<?php echo $hotellist['sepQty']; ?>" placeholder="Qty" /></div></td>
  <td><div align="center"><input type="number"  id="sepPrice<?php echo $hotellist['id']; ?>" onkeyup="saveprojectiondate<?php echo $hotellist['id']; ?>();" style="height: 30px; width: 60px; text-align:center;" value="<?php echo $hotellist['sepPrice']; ?>" placeholder="Price" /></div></td>
  <td><div align="center"><input type="number"  id="octQty<?php echo $hotellist['id']; ?>" onkeyup="saveprojectiondate<?php echo $hotellist['id']; ?>();" style="height: 30px; width: 60px; text-align:center;" value="<?php echo $hotellist['octQty']; ?>" placeholder="Qty" /></div></td>
  <td><div align="center"><input type="number"  id="octPrice<?php echo $hotellist['id']; ?>" onkeyup="saveprojectiondate<?php echo $hotellist['id']; ?>();" style="height: 30px; width: 60px; text-align:center;" value="<?php echo $hotellist['octPrice']; ?>" placeholder="Price" /></div></td>
  <td><div align="center"><input type="number"  id="novQty<?php echo $hotellist['id']; ?>" onkeyup="saveprojectiondate<?php echo $hotellist['id']; ?>();" style="height: 30px; width: 60px; text-align:center;" value="<?php echo $hotellist['novQty']; ?>" placeholder="Qty" /></div></td>
  <td><div align="center"><input type="number"  id="novPrice<?php echo $hotellist['id']; ?>" onkeyup="saveprojectiondate<?php echo $hotellist['id']; ?>();" style="height: 30px; width: 60px; text-align:center;" value="<?php echo $hotellist['novPrice']; ?>" placeholder="Price" /></div></td>
  <td><div align="center"><input type="number"  id="decQty<?php echo $hotellist['id']; ?>" onkeyup="saveprojectiondate<?php echo $hotellist['id']; ?>();" style="height: 30px; width: 60px; text-align:center;" value="<?php echo $hotellist['decQty']; ?>" placeholder="Qty" /></div></td>
  <td><div align="center"><input type="number"  id="decPrice<?php echo $hotellist['id']; ?>" onkeyup="saveprojectiondate<?php echo $hotellist['id']; ?>();" style="height: 30px; width: 60px; text-align:center;" value="<?php echo $hotellist['decPrice']; ?>" placeholder="Price" /></div></td>
  <td><div align="center"><input type="number"  id="janQty<?php echo $hotellist['id']; ?>" onkeyup="saveprojectiondate<?php echo $hotellist['id']; ?>();" style="height: 30px; width: 60px; text-align:center;" value="<?php echo $hotellist['janQty']; ?>" placeholder="Qty" /></div></td>
  <td><div align="center"><input type="number"  id="janPrice<?php echo $hotellist['id']; ?>" onkeyup="saveprojectiondate<?php echo $hotellist['id']; ?>();" style="height: 30px; width: 60px; text-align:center;" value="<?php echo $hotellist['janPrice']; ?>" placeholder="Price" /></div></td>
  <td><div align="center"><input type="number"  id="febQty<?php echo $hotellist['id']; ?>" onkeyup="saveprojectiondate<?php echo $hotellist['id']; ?>();" style="height: 30px; width: 60px; text-align:center;" value="<?php echo $hotellist['febQty']; ?>" placeholder="Qty" /></div></td>
  <td><div align="center"><input type="number"  id="febPrice<?php echo $hotellist['id']; ?>" onkeyup="saveprojectiondate<?php echo $hotellist['id']; ?>();" style="height: 30px; width: 60px; text-align:center;" value="<?php echo $hotellist['febPrice']; ?>" placeholder="Price" /></div></td>
  <td><div align="center"><input type="number"  id="marQty<?php echo $hotellist['id']; ?>" onkeyup="saveprojectiondate<?php echo $hotellist['id']; ?>();" style="height: 30px; width: 60px; text-align:center;" value="<?php echo $hotellist['marQty']; ?>" placeholder="Qty" /></div></td>
  <td><div align="center"><input type="number"  id="marPrice<?php echo $hotellist['id']; ?>" onkeyup="saveprojectiondate<?php echo $hotellist['id']; ?>();" style="height: 30px; width: 60px; text-align:center;" value="<?php echo $hotellist['marPrice']; ?>" placeholder="Price" /></div></td>
  <td><div align="center" id="totalQty<?php echo $hotellist['id']; ?>"><?php echo $hotellist['totalQty']; ?></div></td>
  <td><div align="center" id="totalDollerPrice<?php echo $hotellist['id']; ?>"><?php echo $hotellist['totalDollerPrice']; ?></div></td>
  <td><div align="center" id="totalInrPrice<?php echo $hotellist['id']; ?>"><?php echo round($hotellist['totalInrPrice'],2); ?></div></td>
</tr>


<script>
function deleteRow<?php echo $hotellist['id']; ?>(){
var checkyes = confirm('Are your sure you you want to delete?');
	if(checkyes==true){
		$('#addrow').load('addprojectionline.php?id=<?php echo $hotellist['id']; ?>&deletestatus=yes');
	}
}

function saveprojectiondate<?php echo $hotellist['id']; ?>(){

var buyerId = Number($('#buyerId<?php echo $hotellist['id']; ?>').val());
var aprilQty = Number($('#aprilQty<?php echo $hotellist['id']; ?>').val());
var aprilPrice = Number($('#aprilPrice<?php echo $hotellist['id']; ?>').val());
var mayQty = Number($('#mayQty<?php echo $hotellist['id']; ?>').val());
var mayPrice = Number($('#mayPrice<?php echo $hotellist['id']; ?>').val());
var juneQty = Number($('#juneQty<?php echo $hotellist['id']; ?>').val());
var junePrice = Number($('#junePrice<?php echo $hotellist['id']; ?>').val());
var julyQty = Number($('#julyQty<?php echo $hotellist['id']; ?>').val());
var julyPrice = Number($('#julyPrice<?php echo $hotellist['id']; ?>').val());
var augQty = Number($('#augQty<?php echo $hotellist['id']; ?>').val());
var augPrice = Number($('#augPrice<?php echo $hotellist['id']; ?>').val());
var sepQty = Number($('#sepQty<?php echo $hotellist['id']; ?>').val());
var sepPrice = Number($('#sepPrice<?php echo $hotellist['id']; ?>').val());
var octQty = Number($('#octQty<?php echo $hotellist['id']; ?>').val());
var octPrice = Number($('#octPrice<?php echo $hotellist['id']; ?>').val());
var novQty = Number($('#novQty<?php echo $hotellist['id']; ?>').val());
var novPrice = Number($('#novPrice<?php echo $hotellist['id']; ?>').val());
var decQty = Number($('#decQty<?php echo $hotellist['id']; ?>').val());
var decPrice = Number($('#decPrice<?php echo $hotellist['id']; ?>').val());
var janQty = Number($('#janQty<?php echo $hotellist['id']; ?>').val());
var janPrice = Number($('#janPrice<?php echo $hotellist['id']; ?>').val());
var febQty = Number($('#febQty<?php echo $hotellist['id']; ?>').val());
var febPrice = Number($('#febPrice<?php echo $hotellist['id']; ?>').val());
var marQty = Number($('#marQty<?php echo $hotellist['id']; ?>').val());
var marPrice = Number($('#marPrice<?php echo $hotellist['id']; ?>').val());

var totalQty = Number(aprilQty+mayQty+juneQty+julyQty+augQty+sepQty+octQty+novQty+decQty+janQty+febQty+marQty);
$('#totalQty<?php echo $hotellist['id']; ?>').text(totalQty);

var totalDollerPrice = Number(aprilPrice+mayPrice+junePrice+julyPrice+augPrice+sepPrice+octPrice+novPrice+decPrice+janPrice+febPrice+marPrice);
$('#totalDollerPrice<?php echo $hotellist['id']; ?>').text(totalDollerPrice);

var totalInrPrice = Number(totalDollerPrice*71.91);
$('#totalInrPrice<?php echo $hotellist['id']; ?>').text(totalInrPrice.toFixed(2));

//var totalaprilqty=0;

var aprilTotalQty = aprilQty;
var aprilTotalPrice = aprilPrice;
var mayTotalQty = mayQty;
var mayTotalPrice = mayPrice;

parent.$('#aprilTotalQty').text(aprilTotalQty);
parent.$('#aprilTotalPrice').text(aprilTotalPrice);
parent.$('#mayTotalQty').text(mayTotalQty);
parent.$('#mayTotalPrice').text(mayTotalPrice);

$('#saveprojectiondata').load('allaction.php?action=saveprojection&projectionid=<?php echo $hotellist['id']; ?>&buyerId='+buyerId+'&aprilQty='+aprilQty+'&aprilPrice='+aprilPrice+'&mayQty='+mayQty+'&mayPrice='+mayPrice+'&juneQty='+juneQty+'&junePrice='+junePrice+'&julyQty='+julyQty+'&julyPrice='+julyPrice+'&augQty='+augQty+'&augPrice='+augPrice+'&sepQty='+sepQty+'&sepPrice='+sepPrice+'&octQty='+octQty+'&octPrice='+octPrice+'&novQty='+novQty+'&novPrice='+novPrice+'&decQty='+decQty+'&decPrice='+decPrice+'&janQty='+janQty+'&janPrice='+janPrice+'&febQty='+febQty+'&febPrice='+febPrice+'&marQty='+marQty+'&marPrice='+marPrice+'&totalQty='+totalQty+'&totalDollerPrice='+totalDollerPrice+'&totalInrPrice='+totalInrPrice);

}


</script>

<?php $n++; } ?>

<tr id="saveprojectiondata" style="display:none;"></tr>



