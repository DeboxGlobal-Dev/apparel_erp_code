<?php
include "inc.php";
?>

<?php
if($_REQUEST['add']==1){
$namevalueadd = 'parentId="'.decode($_REQUEST['parentId']).'",costsheetVersionId=1,addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",status=1';
addlistinggetlastid('loadpackinglistmaster',$namevalueadd);
}

if($_REQUEST['deletestatus']=="yes" && $_REQUEST['id']!=''){
deleteRecord('loadpackinglistmaster','id="'.$_REQUEST['id'].'"');
}

$sNo2 = 0;
$select='';
$where='';
$rs='';
$select='*';
$where='parentId="'.decode($_REQUEST['parentId']).'" and costsheetVersionId=1 and deletestatus=0 order by id asc';
$rs=GetPageRecord($select,'loadpackinglistmaster',$where);
while($resListing1=mysqli_fetch_array($rs)){ ?>

<?php
$sNo2++;
?>



<tr height="20">
  <td align="center"><i class="fa fa-trash" style="font-size: 20px; color:#FF0000; cursor:pointer;" onclick="deleteRow('<?php echo $resListing1['id']; ?>');"></i></td>

<td height="20" align="right"><div align="center">
  <input name="containfrom" type="text"  id="containfrom<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['containfrom']); ?>" autocomplete="off"  style="width:40px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" <?php if($resListing1['status'] == '2') { ?> readonly <?php } ?>>  -  <input name="containto" type="text"  id="containto<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['containto']); ?>" autocomplete="off"  style="width:40px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" <?php if($resListing1['status'] == '2') { ?> readonly <?php } ?>>
</div></td>

<td height="20" align="right"><div align="center">
  <input name="cartonfrom" type="text"  id="cartonfrom<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['cartonfrom']); ?>" autocomplete="off"  style="width:40px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" <?php if($resListing1['status'] == '2') { ?> readonly <?php } ?>>  -  <input name="cartonto" type="text"  id="cartonto<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['cartonto']); ?>" autocomplete="off"  style="width:40px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" <?php if($resListing1['status'] == '2') { ?> readonly <?php } ?>>
</div></td>

<td height="20" align="right"><div align="center">
  <input name="colorcode" type="text"  id="colorcode<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['colorcode']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" <?php if($resListing1['status'] == '2') { ?> readonly <?php } ?>>
</div></td>

<td height="20" align="right"><div align="center">
  <input name="colour" type="text"  id="colour<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['colour']); ?>" autocomplete="off"  style="width:95px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" <?php if($resListing1['status'] == '2') { ?> readonly <?php } ?>>
</div></td>

<td height="20" align="right"><div align="center">
  <input name="xxs" type="text" class="xxsmallclass" id="xxs<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['xxs']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" <?php if($resListing1['status'] == '2') { ?> readonly <?php } ?>>
</div></td>

<td height="20" align="right"><div align="center">
  <input name="xs" type="text" class="extrasmallclass" id="xs<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['xs']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" <?php if($resListing1['status'] == '2') { ?> readonly <?php } ?>>
</div></td>

<td height="20" align="right"><div align="center">
  <input name="s" type="text" class="sclass" id="s<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['s']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" <?php if($resListing1['status'] == '2') { ?> readonly <?php } ?>>
</div></td>

<td height="20" align="right"><div align="center">
  <input name="m" type="text" class="mclass" id="m<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['m']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" <?php if($resListing1['status'] == '2') { ?> readonly <?php } ?>>
</div></td>


<td height="20" align="right"><div align="center">
  <input name="l" type="text" class="lclass" id="l<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['l']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" <?php if($resListing1['status'] == '2') { ?> readonly <?php } ?>>
</div></td>


<td height="20" align="right"><div align="center">
  <input name="xl" type="text" class="xlclass" id="xl<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['xl']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" <?php if($resListing1['status'] == '2') { ?> readonly <?php } ?>>
</div></td>


<td height="20" align="right"><div align="center">
  <input name="x2l" type="text" class="x2lclass" id="x2l<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['x2l']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" <?php if($resListing1['status'] == '2') { ?> readonly <?php } ?>>
</div></td>

<td height="20" align="right"><div align="center">
  <input name="x3l" type="text" class="x3lclass" id="x3l<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['x3l']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" <?php if($resListing1['status'] == '2') { ?> readonly <?php } ?>>
</div></td>

  <td height="20" align="right"><div align="center">
  <input name="qtypercont" type="text" class="qtypercont" id="qtypercont<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['qtypercont']); ?>" autocomplete="off"  style="width:45px; text-align:center;border: 1px solid #ccc; background-color: #f7f7f7;" readonly="">
</div></td>

    <td height="20" align="right"><div align="center">
  <input name="contNo" type="text" class="contNo" id="contNo<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['contNo']); ?>" autocomplete="off"  style="width:45px; text-align:center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" <?php if($resListing1['status'] == '2') { ?> readonly <?php } ?>>
</div></td>

 <td height="20" align="right"><div align="center">
  <input name="totalqty" type="text" class="totalqtyclass" id="totalqty<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['totalqty']); ?>" autocomplete="off"  style="width: 95px; text-align: center; border: 1px solid #ccc; background-color: #f7f7f7;" readonly="">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="ctn_net" type="text" class="ctn_net_class" id="ctn_net<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['ctn_net']); ?>" autocomplete="off"  style="width: 95px; text-align: center;border: 1px solid #ccc; background-color: #f7f7f7;" readonly="">
</div></td>

 <td height="20" align="right"><div align="center">
  <input name="length" type="text" class="length" id="length<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['length']); ?>" autocomplete="off"  style="width: 30px; text-align: center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" <?php if($resListing1['status'] == '2') { ?> readonly <?php } ?>> *
   <input name="breadth" type="text" class="breadth" id="breadth<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['breadth']); ?>" autocomplete="off"  style="width: 30px; text-align: center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" <?php if($resListing1['status'] == '2') { ?> readonly <?php } ?>> *
    <input name="height" type="text" class="height" id="height<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['height']); ?>" autocomplete="off"  style="width: 30px; text-align: center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" <?php if($resListing1['status'] == '2') { ?> readonly <?php } ?>>
</div></td>

<td height="20" align="right"><div align="center">
  <input name="boxwt" type="text" class="boxwt" id="boxwt<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['boxwt']); ?>" autocomplete="off"  style="width: 95px; text-align: center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" <?php if($resListing1['status'] == '2') { ?> readonly <?php } ?>>
</div></td>

<td height="20" align="right"><div align="center">
  <input name="net_wt" type="text" class="net_wt" id="net_wt<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['net_wt']); ?>" autocomplete="off"  style="width: 95px; text-align: center;border: 1px solid #ccc; background-color: #f7f7f7;" readonly="">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="gwt" type="text" class="gwt" id="gwt<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['gwt']); ?>" autocomplete="off"  style="width: 95px; text-align: center;border: 1px solid #ccc; background-color: #f7f7f7;" readonly="">
</div></td>

<td height="20" align="right"><div align="center">
  <input name="nnwt" type="text" class="nnwt" id="nnwt<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['nnwt']); ?>" autocomplete="off"  style="width: 95px; text-align: center;border: 1px solid #ccc; background-color: #f7f7f7;" readonly="">
</div></td>

 <td height="20" align="right"><div align="center">
  <input name="nnwtperpcs" type="text" class="nnwtperpcs" id="nnwtperpcs<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['nnwtperpcs']); ?>" autocomplete="off"  style="width: 95px; text-align: center; border: 1px solid #ccc; background-color: #f7f7f7;" readonly="">
</div></td>

 <td height="20" align="right"><div align="center">
  <input name="sizeone" type="text" class="sizeone" id="sizeone<?php echo $resListing1['id']; ?>" value="<?php echo stripslashes($resListing1['sizeone']); ?>" autocomplete="off"  style="width: 95px; text-align: center;" onkeyup="savemeasurmentdata<?php echo $resListing1['id']; ?>();" <?php if($resListing1['status'] == '2') { ?> readonly <?php } ?>>
</div></td>



  </tr>

<script>
 savemeasurmentdata<?php echo $resListing1['id']; ?>();
function savemeasurmentdata<?php echo $resListing1['id']; ?>(){
var containfrm = encodeURI($('#containfrom<?php echo $resListing1['id']; ?>').val());
var containto = encodeURI($('#containto<?php echo $resListing1['id']; ?>').val());
var cartonfrm = encodeURI($('#cartonfrom<?php echo $resListing1['id']; ?>').val());
var cartonto = encodeURI($('#cartonto<?php echo $resListing1['id']; ?>').val());
var colour = encodeURI($('#colour<?php echo $resListing1['id']; ?>').val());
var colorcode = encodeURI($('#colorcode<?php echo $resListing1['id']; ?>').val());
var xxs = encodeURI($('#xxs<?php echo $resListing1['id']; ?>').val());
var xs = encodeURI($('#xs<?php echo $resListing1['id']; ?>').val());
var s = encodeURI($('#s<?php echo $resListing1['id']; ?>').val());
var m = encodeURI($('#m<?php echo $resListing1['id']; ?>').val());
var l = encodeURI($('#l<?php echo $resListing1['id']; ?>').val());
var xl = encodeURI($('#xl<?php echo $resListing1['id']; ?>').val());
var x2l = encodeURI($('#x2l<?php echo $resListing1['id']; ?>').val());
var x3l = encodeURI($('#x3l<?php echo $resListing1['id']; ?>').val());
var contNo = encodeURI($('#contNo<?php echo $resListing1['id']; ?>').val());
var boxwt = encodeURI($('#boxwt<?php echo $resListing1['id']; ?>').val());
var length = encodeURI($('#length<?php echo $resListing1['id']; ?>').val());
var breadth = encodeURI($('#breadth<?php echo $resListing1['id']; ?>').val());
var height = encodeURI($('#height<?php echo $resListing1['id']; ?>').val());
var sizeone = encodeURI($('#sizeone<?php echo $resListing1['id']; ?>').val());

var totalQuantity=Number(xxs)+Number(xs)+Number(s)+Number(m)+Number(l)+Number(xl)+Number(x2l)+Number(x3l);
$('#qtypercont<?php echo $resListing1['id']; ?>').val(totalQuantity);
var qtypercont = encodeURI($('#qtypercont<?php echo $resListing1['id']; ?>').val());

var totalQty=Number(totalQuantity*contNo);
$('#totalqty<?php echo $resListing1['id']; ?>').val(totalQty);
var totalqty = encodeURI($('#totalqty<?php echo $resListing1['id']; ?>').val());

var totalnetwt = Number(totalQty*sizeone).toFixed(3);
$('#net_wt<?php echo $resListing1['id']; ?>').val(totalnetwt);
var net_wt = encodeURI($('#net_wt<?php echo $resListing1['id']; ?>').val());

var totalnnwtperpcs = Number(sizeone-0.01).toFixed(3);
$('#nnwtperpcs<?php echo $resListing1['id']; ?>').val(totalnnwtperpcs);
var nnwtperpcs = encodeURI($('#nnwtperpcs<?php echo $resListing1['id']; ?>').val());

var totalgwt = (Number(contNo*boxwt)+Number(net_wt)).toFixed(3);
$('#gwt<?php echo $resListing1['id']; ?>').val(totalgwt);
var gwt = encodeURI($('#gwt<?php echo $resListing1['id']; ?>').val());

var totalctnwt = Number(totalgwt/contNo).toFixed(2);
$('#ctn_net<?php echo $resListing1['id']; ?>').val(totalctnwt);
var ctn_net = encodeURI($('#ctn_net<?php echo $resListing1['id']; ?>').val());

var totalnnwt = Number(totalqty*nnwtperpcs).toFixed(3);
$('#nnwt<?php echo $resListing1['id']; ?>').val(totalnnwt);
var nnwt = encodeURI($('#nnwt<?php echo $resListing1['id']; ?>').val());

$('#savemeasurmentdata').load('apparelbomaction.php?action=savepackinglist&id=<?php echo encode($resListing1['id']); ?>&colour='+colour+'&colorcode='+colorcode+'&containfrm='+containfrm+'&containto='+containto+'&cartonfrm='+cartonfrm+'&cartonto='+cartonto+'&xxs='+xxs+'&xs='+xs+'&s='+s+'&m='+m+'&l='+l+'&xl='+xl+'&x2l='+x2l+'&contNo='+contNo+'&qtypercont='+qtypercont+'&totalqty='+totalqty+'&length='+length+'&breadth='+breadth+'&height='+height+'&ctn_net='+ctn_net+'&netwt='+net_wt+'&boxwt='+boxwt+'&gwt='+gwt+'&nnwt='+nnwt+'&nnwtperpcs='+nnwtperpcs+'&sizeone='+sizeone+'&x3l='+x3l);


/////////////////////////////////////////////////////////////////////////////////
var xxsmallsum=0;
$('.xxsmallclass').each(function() {
        xxsmallsum += Number($(this).val());
});
xxsmallsum= parseFloat(xxsmallsum).toFixed(2);
$('#xxsmall').text(xxsmallsum);
/////////////////////////////////////////////////////////////////////////////////
var extrasmallsum=0;
$('.extrasmallclass').each(function() {
        extrasmallsum += Number($(this).val());
});
extrasmallsum= parseFloat(extrasmallsum).toFixed(2);
$('#extrasmall').text(extrasmallsum);

/////////////////////////////////////////////////////////////////////////////////
var sclasssum=0;
$('.sclass').each(function() {
        sclasssum += Number($(this).val());
});
sclasssum= parseFloat(sclasssum).toFixed(2);
$('#small').text(sclasssum);


/////////////////////////////////////////////////////////////////////////////////
var mclasssum=0;
$('.mclass').each(function() {
        mclasssum += Number($(this).val());
});
mclasssum= parseFloat(mclasssum).toFixed(2);
$('#medium').text(mclasssum);


/////////////////////////////////////////////////////////////////////////////////
var lclasssum=0;
$('.lclass').each(function() {
        lclasssum += Number($(this).val());
});
lclasssum= parseFloat(lclasssum).toFixed(2);
$('#large').text(lclasssum);



/////////////////////////////////////////////////////////////////////////////////
var xlclasssum=0;
$('.xlclass').each(function() {
        xlclasssum += Number($(this).val());
});
xlclasssum= parseFloat(xlclasssum).toFixed(2);
$('#extralarge').text(xlclasssum);

/////////////////////////////////////////////////////////////////////////////////
var x2lclasssum=0;
$('.x2lclass').each(function() {
        x2lclasssum += Number($(this).val());
});
x2lclasssum= parseFloat(x2lclasssum).toFixed(2);
$('#extraextralarge').text(x2lclasssum);

/////////////////////////////////////////////////////////////////////////////////
var x3lclasssum=0;
$('.x3lclass').each(function() {
  x3lclasssum += Number($(this).val());
});
x3lclasssum= parseFloat(x3lclasssum).toFixed(2);
$('#extraextralarge3xl').text(x3lclasssum);

/////////////////////////////////////////////////////////////////////////////////

var totalqtyclassssum=0;
$('.totalqtyclass').each(function() {
        totalqtyclassssum += Number($(this).val());
});
totalqtyclassssum= parseFloat(totalqtyclassssum).toFixed(2);
$('#totalqtyid').text(totalqtyclassssum);
$('#totalqtyid1').text(totalqtyclassssum);


/////////////////////////////////////////////////////////////////////////////////
var ctn_net_classsum=0;
$('.ctn_net_class').each(function() {
        ctn_net_classsum += Number($(this).val());
});
ctn_net_classsum= parseFloat(ctn_net_classsum).toFixed(2);
$('#netwt').text(ctn_net_classsum);
$('#netwt1').text(ctn_net_classsum);


/////////////////////////////////////////////////////////////////////////////////
var net_weight=0;
$('.net_wt').each(function() {
net_weight += Number($(this).val());
});
net_weight= parseFloat(net_weight).toFixed(2);
$('#netweight').text(net_weight);
$('#netweight1').text(net_weight);
/////////////////////////////////////////////////////////////////////////////////
var grosswt=0;
$('.gwt').each(function() {
grosswt += Number($(this).val());
});
grosswt= parseFloat(grosswt).toFixed(2);
$('#gweight').text(grosswt);
$('#gweight1').text(grosswt);
/////////////////////////////////////////////////////////////////////////////////
var nnwt=0;
$('.nnwt').each(function() {
 nnwt += Number($(this).val());
});
nnwt= parseFloat(nnwt).toFixed(2);
$('#nnweight').text(nnwt);
$('#nnweight1').text(nnwt);
/////////////////////////////////////////////////////////////////////////////////
var totalcont=0;
$('.contNo').each(function() {
 totalcont += Number($(this).val());
});
totalcont= parseFloat(totalcont).toFixed(2);
$('#totalcontainer').text(totalcont);
$('#totalcontainer1').text(totalcont);


}



</script>
  <?php } ?>
  <?php if($sNo2==0){ ?>

<tr style="padding:8px;text-align: center; width: 100%;background-color: #efefef;"><td colspan="50"><div align="center">No Record Found.</div></td></tr>




<div align="center">
  <?php } ?>
</div>
<tr id="savemeasurmentdata" style="display:none;"></tr>
