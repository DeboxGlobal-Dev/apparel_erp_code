<?php
include "inc.php";

$s = decode($_REQUEST['s']);

$k = GetPageRecord('*', 'queryMaster', 'id="' . $s . '"');
$styleData = mysqli_fetch_array($k);

$kk = GetPageRecord('*', 'buyerMaster', 'id="' . $styleData['buyerId'] . '"');
$buyerData = mysqli_fetch_array($kk);

if ($s != '') {

  $rs = GetPageRecord('*', 'innvoiceMaster', 'id="' . $s . '"');
  $editresult = mysqli_fetch_array($rs);
  $gateLastId = $editresult['id'];
}

if ($_GET['pid'] != '') {
  $rss = GetPageRecord('*', 'packinglistMaster', 'id="' . decode($_GET['pid']) . '"');
  $rsListing = mysqli_fetch_array($rss);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title>Untitled Document</title>
</head>
<body>
  <table width="700" cellpadding="10" cellspacing="0" border="1" style="font-size:10px;font-family: Arial, Helvetica, sans-serif;">
    <tr>
      <td align="center" colspan="2"><strong style="font-size:13px;">COMMERCIAL INVOICE</strong></td>
    </tr>
    <tr>
      <td width="50%" align="left"><?php echo $editresult['maddress']; ?></td>
      <td width="50%" align="left"><strong>Invoice No.: </strong><?php echo $editresult['gstno']; ?><br />
              <strong>Invoice Date.: </strong><?php echo $editresult['gstdate']; ?><br />
              <strong>Invoice Ref. No & Dt: </strong><?php echo $editresult['cargono']; ?>, DT. <?php echo $editresult['cargodate']; ?></td>
    </tr>
    <tr>
      <td width="50%" align="left"><strong>Buyer: </strong> <?php echo $editresult['consignee']; ?></td>
      <td width="50%" align="left"><strong>Delivery Address: </strong> <?php echo $editresult['consignee']; ?></td>
    </tr>
    <tr>
      <td width="15%" align="left"><strong>Style</strong></td>
      <td width="10%" align="left"><strong>HSN</strong></td>
      <td width="10%" align="left"><strong>Unit</strong></td>
      <td width="15%" align="left"><strong>Quantity</strong></td>
      <td width="10%" align="left"><strong>Rate</strong></td>
      <td width="10%" align="left"><strong>GST Rate</strong></td>
      <td width="15%" align="left"><strong>GST Amt.</strong></td>
      <td width="15%" align="left"><strong>Amount</strong></td>
    </tr>
    <?php
    //$newdata = explode(',', $editresult['amount']);
    $totalQty=0;
    $totalGstAmt=0;
    $totalAmt=0;
    $rrp = GetPageRecord('*', 'loadpackinglistmaster', 'parentId="' . $editresult['packingId'] . '"');
    while ($operation1 = mysqli_fetch_array($rrp)) {
    ?>
    <tr>
      <td align="left"><?php echo $editresult['styleId']; ?></td>
      <td align="left"><?php echo $editresult['hsnno']; ?></td>
      <td align="left">-</td>
      <td align="left"><?php $totalQty += $operation1['totalqty']; echo $operation1['totalqty']; ?></td>
      <td align="left"><?php echo $editresult['rate']; ?></td>
      <td align="left"><?php echo $editresult['igst']; ?></td>
      <td align="left"><?php $totalGstAmt += $editresult['igstamount']; echo $editresult['igstamount']; ?></td>
      <td align="left"><?php $totalAmt += $editresult['ttlamount']; echo $editresult['ttlamount']; ?></td>
    </tr>
    <?php } ?>
    <tr>
      <td align="center" colspan="3"><strong>Total</strong></td>
      <td align="left"><strong><?php echo $totalQty; ?></strong></td>
      <td align="left">-</td>
      <td align="left">-</td>
      <td align="left"><strong><?php echo $totalGstAmt; ?></strong></td>
      <td align="left"><strong><?php echo $totalAmt; ?></strong></td>
    </tr>
    <tr>
      <td colspan="3" align="left"><strong>Total Invoice Amount in Words: </strong>
      <?php echo convertNumberToWord($editresult['ttlamount']); ?>
      </td>
      <td colspan="4" align="left">
      <table>
        <tr>
          <td align="right">Subtotal Discount: Taxable Value: </td>
        </tr>
        <tr>
          <td align="right">CGST: </td>
        </tr>
        <tr>
          <td align="right">SGST: </td>
        </tr>
        <tr>
          <td align="right">IGST: </td>
        </tr>
      </table>
      </td>
      <td align="left">
      <table>
        <tr>
          <td align="left"><?php echo $totalAmt; ?></td>
        </tr>
        <tr>
          <td align="left"></td>
        </tr>
        <tr>
          <td align="left"></td>
        </tr>
        <tr>
          <td align="left"><?php echo $editresult['igst']; ?></td>
        </tr>
      </table>
      </td>
    </tr>
    <tr>
      <td width="100%" align="left"><strong>Declaration: </strong> <br />
        1-We declare that this invoice shows the actual price of the
        goods described and that all particulars are true and correct. <br />
        2-Interest will be charged as per MSMED Act 2006 on the
        payment after due date as mention above. <br />
        3-All Disputes are subject to delhi jurisdiction only.
      </td>
    </tr>
    <tr>
      <td width="50%" rowspan="2" align="center" valign="bottom"><strong>Authorised Signatory</strong></td>
      <td width="50%" align="left"></td>
    </tr>
  </table>
</body>

</html>