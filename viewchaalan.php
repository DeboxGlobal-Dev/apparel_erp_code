<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

</head>
<body>
<?php


include('inc.php');


$rs2=GetPageRecord('*','chaalanMaster','id="'.decode($_REQUEST['d']).'"');
$userss=mysqli_fetch_array($rs2);

?>



						<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" bordercolor="#000000">
  <tr>
    <td align="center"><div style="font-size:16px; font-weight:bold; ">Challan <?php echo $userss['chaalanNo']; ?> </div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>

    <td><table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td width="50%" align="left" valign="top"><span style="font-size:16px;"> Shiv DVN LLP.</span><br>
          <span style="font-size:10px;">Plot No. 200, KH No - 13/2, Libaspur Road, Samaypur Badli<br>
          Tel: +91 9810075623<br>
          Email: info@shivdvn.com<br>
          Department: <?php $rs11=GetPageRecord('*','departmentMaster','id="'.$userss['departmentId'].'"');
$data11=mysqli_fetch_array($rs11); echo $data11['name'];  ?><br>
          GDI NO.:<br>
          Pick List No: <br></span>
          <br></td>
        <td width="50%" align="left" valign="top">From:<br />
          <span style="font-size:16px;">Shiv DVN LLP.</span><br />
          <span style="font-size:10px;">Plot No. 200, KH No - 13/2, Libaspur Road, Samaypur Badli<br />
Department: <?php $rs22=GetPageRecord('*','departmentMaster','id="'.$userss['fromDepartmentId'].'"');
$data22=mysqli_fetch_array($rs22); echo $data22['name'];  ?>  </span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="right" style="border-bottom:1px solid #000;">Supervisior: <?php echo $userss['supervisor']; ?>  &nbsp; &nbsp; Dispatch Type: Internal </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#000000">
      <tr style="color:#FFFFFF;">
        <td bgcolor="#333333"><strong>Style#</strong></td>
        <td bgcolor="#333333"><strong>Color</strong></td>
        <td bgcolor="#333333"><strong>Size</strong></td>
        <td bgcolor="#333333"><strong>Qty</strong></td>
        <td bgcolor="#333333"><strong>UOM</strong></td>
        <!-- <td bgcolor="#333333"><strong>Detail</strong></td> -->
      </tr>
      <?php
	  $total='';
	  $rsList=GetPageRecord('*','chaalanMaster','parentId="'.$userss['id'].'"');
	  while($rsListData=mysqli_fetch_array($rsList)){
	  $total = $total+$rsListData['quantity'];
	  ?>
	  <tr>
        <td><?php echo getStyleRefId($rsListData['styleId']); ?></td>
        <td><?php echo $rsListData['color']; ?></td>
        <td><?php echo $rsListData['size']; ?></td>
        <td><?php echo $rsListData['quantity']; ?></td>
        <td><?php echo 'pcs'; ?></td>
        <!-- <td><?php echo $rsListData['remark']; ?></td> -->
      </tr>
	  <?php } ?>
      <tr style="color:#FFFFFF;">
        <td bgcolor="#333333">&nbsp;</td>
        <td bgcolor="#333333">&nbsp;</td>
        <td bgcolor="#333333">&nbsp;</td>
        <td bgcolor="#333333"><?php echo $total; ?></td>
        <td bgcolor="#333333">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="left"> </td>
  </tr>
  <tr>
    <td align="left" style="border-bottom:1px solid #000;"><strong>Additional Charges Details:</strong> <?php echo $userss['chargesDetail']; ?></td>
  </tr>
   <tr>
    <td align="left" style="border-bottom:1px solid #000;">&nbsp;</td>
  </tr>
   <tr>
    <td align="left" style="border-bottom:1px solid #000;"><strong>GDI Remarks:</strong> <?php echo $userss['gdiRemark']; ?></td>
  </tr>
   <tr>
     <td align="left" style="border-bottom:1px solid #000;">&nbsp;</td>
   </tr>
   <tr>
    <td align="left" style="border-bottom:1px solid #000;"><table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td width="25%"><strong>Created By: </strong> <?php echo getUserName($userss['addedBy']); ?></td>
        <td width="25%"><strong></strong></td>
        <td width="25%"><strong></strong></td>
        <td width="25%"><strong>Received By: </strong> <?php echo getUserName($userss['receivedBy']); ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
</table>

 </body>
 </html>
