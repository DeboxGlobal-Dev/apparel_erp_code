<?php
include('inc.php');

if($_REQUEST['addsize']==1 && $_REQUEST['lineid']!=''){

$namevalue ='parentId="'.$_REQUEST['lineid'].'",styleId="'.decode($_REQUEST['styleId']).'",sectionType=1';
addlistinggetlastid('chaalanMaster',$namevalue);



$selectnew='*';
$wherenew='1 and sectionType=1 and styleId="'.decode($_REQUEST['styleId']).'" and parentId="'.$_REQUEST['lineid'].'"';
$rsnew=GetPageRecord($selectnew,'chaalanMaster',$wherenew);
while($rslistnew=mysqli_fetch_array($rsnew)){
?>
      <tr>
       	<td><?php
		$styleId = decode($_REQUEST['styleId']);
		 echo '#'.getStyleRefId($styleId); ?></td>
        <td><input type="text" name="color" id="color" /></td>
        <td><input type="text" name="size" id="size" /></td>
        <td><input type="number" name="quantity" id="quantity" /></td>
        <td><select><option value="pcs">Pcs</option><option value="Meter">Meter</option><option value="Yard">Yard</option></select></td>
        <td><input type="text" name="remark" id="remark" /> </td>
      </tr>
      <tr style="color:#FFFFFF;">
        <td bgcolor="#333333">&nbsp;</td>
        <td bgcolor="#333333">&nbsp;</td>
        <td bgcolor="#333333">&nbsp;</td>
        <td bgcolor="#333333">&nbsp;</td>
        <td bgcolor="#333333">&nbsp;</td>
        <td bgcolor="#333333">&nbsp;</td>
      </tr>
<?php } } ?>