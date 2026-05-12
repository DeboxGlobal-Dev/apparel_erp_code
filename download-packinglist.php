<?php
ob_start();
include "inc.php";
$assignto="Download";
$where='id="'.decode($_REQUEST['parentId']).'"';
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment; filename=\"".$assignto."_".date('d-m-Y-H-i-s').".xls");
header("Cache-control: private");


$rsList=GetPageRecord('styleId,consignee','packinglistMaster','id="'.decode($_REQUEST['parentId']).'"');
$editresultList=mysqli_fetch_array($rsList);
?>
<table border="1">

</table>
<table class="table table-responsive table-bordered" border="1" style="font-size: 12px;">
  <tr>
    <td colspan="22" align="center"><b>Packing List</b></td>
  </tr>
  <tr>
    <td colspan="11">Ship To: <br> <?php echo $editresultList['consignee']; ?></td>
    <td colspan="11"> From: <br> SHIV DVN GARMENT LLP<br>C-127,SECTOR-63<br>NOIDA,UTTAR PRADESH-201301<br></td>
  </tr>
  <tr class="border-top-info">
    <th><div align="center">Style#</div></th>
    <th><div align="center">From&nbsp;-&nbsp;To</div></th>
    <th><div align="center">From&nbsp;-&nbsp;To</div></th>
    <th><div align="center">Color</div></th>
    <th><div align="center">XXS</div></th>
    <th><div align="center">XS</div></th>
    <th><div align="center">S</div></th>
    <th><div align="center">M</div></th>
    <th><div align="center">L</div></th>
    <th><div align="center">XL</div></th>
    <th><div align="center">XXL</div></th>
    <th><div align="center">Total Qty.</div></th>
    <th><div align="center"></div></th>
    <th><div align="center"></div></th>
    <th><div align="center">Kgs</div></th>
    <th><div align="center">L * W * H
      <?php if ($operationData['uom'] == '1') { ?>cms <?php } ?><?php if ($operationData['uom'] == '2') { ?>inches<?php } ?>
        </div>
    </th>
    <th><div align="center">Kgs</div></th>
    <th><div align="center">Kgs</div></th>
    <th><div align="center">Kgs</div></th>
    <th><div align="center">Kgs</div></th>
    <th><div align="center">per&nbsp;pcs</div></th>
    <th><div align="center">per&nbsp;pcs</div></th>
  </tr>
<?php
if($_REQUEST['add']==1){
$namevalueadd = 'parentId="'.decode($_REQUEST['parentId']).'",costsheetVersionId=1,addedBy="'.$_SESSION['userid'].'",dateAdded="'.time().'",status=1';
//addlistinggetlastid('loadpackinglistmaster',$namevalueadd);
}

if($_REQUEST['deletestatus']=="yes" && $_REQUEST['id']!=''){
//deleteRecord('loadpackinglistmaster','id="'.$_REQUEST['id'].'"');
}


$XXS = 0; $XS = 0; $S = 0; $M = 0; $L = 0;
$XL = 0; $XXL = 0; $qtyCut = 0; $noCut = 0; $ttlQty = 0;
$ctnWt = 0; $netWt = 0; $gWt = 0;
$nnWt = 0; $nnwtpc = 0; $sizeone = 0;

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


              <script>
var comsepval='';
</script>


<tr height="20">
<td height="20" align="right"><div align="center">
<?php echo getStyleRefId($editresultList['styleId']);  ?>
</div></td>

<td height="20" align="right"><div align="center">
<?php echo stripslashes($resListing1['containfrom']); ?>
</div></td>

<td height="20" align="right"><div align="center">
<?php echo stripslashes($resListing1['cartonto']); ?>
</div></td>

<td height="20" align="right"><div align="center">
<?php echo stripslashes($resListing1['colour']); ?>
</div></td>

<td height="20" align="right"><div align="center">
<?php echo stripslashes($resListing1['xxs']); $XXS+=$resListing1['xxs']; ?>
</div></td>

<td height="20" align="right"><div align="center">
<?php echo stripslashes($resListing1['xs']); $XS+=$resListing1['xs']; ?>
</div></td>

<td height="20" align="right"><div align="center">
<?php echo stripslashes($resListing1['s']); $S+=$resListing1['s']; ?>
</div></td>

<td height="20" align="right"><div align="center">
<?php echo stripslashes($resListing1['m']); $M+=$resListing1['m']; ?>
</div></td>


<td height="20" align="right"><div align="center">
<?php echo stripslashes($resListing1['l']); $L+=$resListing1['l']; ?>
</div></td>


<td height="20" align="right"><div align="center">
<?php echo stripslashes($resListing1['xl']); $XL+=$resListing1['xl']; ?>
</div></td>

<td height="20" align="right"><div align="center">
<?php echo stripslashes($resListing1['x2l']); $XXL+=$resListing1['x2l']; ?>
</div></td>

<td height="20" align="right"><div align="center">
  <?php echo stripslashes($resListing1['qtypercont']); $qtyCut+=$resListing1['qtypercont']; ?>
</div></td>

<td height="20" align="right"><div align="center">
    <?php echo stripslashes($resListing1['contNo']); $noCut+=$resListing1['contNo']; ?>
</div></td>

 <td height="20" align="right"><div align="center">
 <?php echo stripslashes($resListing1['totalqty']); $ttlQty+=$resListing1['totalqty']; ?>
</div></td>

<td height="20" align="right"><div align="center">
<?php echo stripslashes($resListing1['ctn_net']); $ctnWt+=$resListing1['ctn_net']; ?>
</div></td>

 <td height="20" align="right"><div align="center">
 <?php echo stripslashes($resListing1['length']); ?> *
 <?php echo stripslashes($resListing1['breadth']); ?> *
 <?php echo stripslashes($resListing1['height']); ?>
</div></td>

<td height="20" align="right"><div align="center">
<?php echo stripslashes($resListing1['boxwt']); ?>
</div></td>

<td height="20" align="right"><div align="center">
<?php echo stripslashes($resListing1['net_wt']); $netWt+=$resListing1['net_wt']; ?>
</div></td>

<td height="20" align="right"><div align="center">
<?php echo stripslashes($resListing1['gwt']); $gWt+=$resListing1['gwt']; ?>
</div></td>

<td height="20" align="right"><div align="center">
<?php echo stripslashes($resListing1['nnwt']); $nnWt+=$resListing1['nnwt']; ?>
</div></td>

 <td height="20" align="right"><div align="center">
 <?php echo stripslashes($resListing1['nnwtperpcs']); $nnwtpc+=$resListing1['nnwtperpcs']; ?>
</div></td>

 <td height="20" align="right"><div align="center">
 <?php echo stripslashes($resListing1['sizeone']); $sizeone+=$resListing1['sizeone']; ?>
</div></td>

         </tr>
      <?php } ?>
          <tr>

              <td colspan="4">Total: </td>
              <td><?php echo $XXS; ?></td>
              <td><?php echo $XS; ?></td>
              <td><?php echo $S; ?></td>
              <td><?php echo $M; ?></td>
              <td><?php echo $L; ?></td>
              <td><?php echo $XL; ?></td>
              <td><?php echo $XXL; ?></td>
              <td><?php echo $qtyCut; ?></td>
              <td><?php echo $noCut; ?></td>
              <td><?php echo $ttlQty; ?></td>
              <td><?php echo $ctnWt; ?></td>
              <td> </td>
              <td></td>
              <td><?php echo $netWt; ?></td>
              <td><?php echo $gWt; ?></td>
              <td><?php echo $nnWt; ?></td>
              <td><?php echo $nnwtpc; ?></td>
              <td><?php echo $sizeone; ?></td>
          </tr>
            </table>

            <table class="table table-bordered" border="1">
                    <tr>
                      <td colspan="2"><div align="center" style="color: black;font-weight: 600">Summary</div></td>
                    </tr>
                    <tr>
                      <td><div>Total Qty Units </div></td>
                      <td><?php echo $ttlQty; ?></td>
                    </tr>
                    <tr>
                      <td><div>Total Gross Wt.(kgs) </div></td>
                      <td><?php echo $netWt; ?></td>
                    </tr>
                    <tr>
                      <td><div>Total Net Wt.(kgs) </div></td>
                      <td><?php echo $gWt; ?></td>
                    </tr>
                    <tr>
                      <td><div>Total Net Net wt.(kgs) </div></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><div>Total Cartons</div></td>
                      <td><?php echo $noCut; ?></td>
                    </tr>

                  </table>





           <!--- <table class="table table-bordered" width="100%" style="display:none;">
                    <tr style="background-color: #fdffe0;">
                      <th><div align="center">Length</div></th>
                      <th><div align="center">Width</div></th>
                      <th><div align="center">Height</div></th>
                      <th><div align="center">No.&nbsp;of&nbsp;CTN</div></th>
                      <th><div align="center">CBM</div></th>
                      <th><div align="center">Vol.</div></th>
                    </tr>
                     <?php
                  $rrp=GetPageRecord('length,breadth,height,SUM(contNo) AS totalctn','loadpackinglistmaster','parentId="'.decode($_GET['parentId']).'" group by length,breadth,height');
                while($operation=mysqli_fetch_array($rrp)) {
                ?>
                    <tr>
                      <td><div align="center"><?php echo $operation['length'] ?></div></td>
                      <td><div align="center"><?php echo $operation['breadth'] ?></div></td>
                      <td><div align="center"><?php echo $operation['height'] ?></div></td>
                      <td><div align="center"><?php
                       echo $operation['totalctn'];
                        ?></div></td>
                      <td><div align="center">
                        <?php
                        if($operationData['uom'] == '1'){
            $totalcbm = ($operation['length']*$operation['breadth']*$operation['height']*$operation['totalctn'])/6000;
                      } else {
            $totalcbm = ($operation['length']*$operation['breadth']*$operation['height']*$operation['totalctn'])/366;
                      }
                          echo round($totalcbm,2);
                        ?>
                      </div></td>
                      <td><div align="center">
                        <?php
                        $totalcbm = ($operation['length']*$operation['breadth']*$operation['height']*$operation['totalctn'])/6000;
                        echo round($totalcbm,2);
                        ?>
                      </div></td>

                    </tr>
                  <?php } ?>

                  </table>---->