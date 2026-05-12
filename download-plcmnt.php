<?php
ob_start();
include "inc.php";
$assignto="download";


header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment; filename=\"".$assignto."_".date('d-m-Y-H-i-s').".xls");
header("Cache-control: private");

?>


                           <table class="table table-bordered table-responsive">
              <tr style="background-color: #e5fbfa; color: #000;">
                <td>Style</td>
                <td>Brand</td>
                <td>Buyer</td>
                <td>Season</td>
                <td>Color</td>
                <td>Placement&nbsp;Quantity</td>
                <td>SAM</td>
                <td>Value&nbsp;Addition</td>
                <td>Shell&nbsp;Fabric </td>
                <td>Shell&nbsp;Fabric&nbsp;Supplier</td>
                <td>Lining&nbsp;Fabric</td>
                <td>Lining&nbsp;Fabric&nbsp;Supplier</td>
                <td>PCD</strong></td>
                <td>Ex.&nbsp;Factory&nbsp;Date</td>

                </tr>
			   <tbody id="allhotellisting">
			            <?php

$no=1;
$select='*';
$where='';
$rs='';
$wheresearch='';
$page=$_GET['page'];
$limit=clean($_GET['records']);

if($_GET['buyerId']!=''){
$buyerId = 'and buyerId="'.$_GET['buyerId'].'"';
}

if($_GET['brandId']!=''){
$brandId = 'and brandId="'.$_GET['brandId'].'"';
}

if($_GET['valueEdition']!=''){
$valueEdition = 'and id in (select styleId from styleColorDetailMaster where valueEdition="'.$_GET['valueEdition'].'")';
}

$where='where '.$wheresearchassign.' deletestatus=0 and sampleStyle=1 and orderQty!=0 '.$buyerId.' '.$brandId.' '.$valueEdition.' and buyerId!="" and buyerId!=0 order by id desc';

$targetpage=$fullurl.'showpage.crm?module='.$_GET['module'].'&records='.$limit.'&searchField='.$searchField.'&buyerId='.$_GET['buyerId'].'&brandId='.$_GET['brandId'].'&valueEdition='.$_GET['valueEdition'].'&';

$rs=GetRecordList($select,_QUERY_MASTER_,$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($qdata=mysqli_fetch_array($rs[0])){

?>
              <tr style="border: 2px solid black;">
                <td><?php echo $qdata['styleRefId']; ?>
                </td>
                <td><?php echo getbrandName($qdata['brandId']); ?></td>
                <td><?php echo getBuyerName($qdata['buyerId']); ?></td>
                <td><?php echo getSeasonName($qdata['seasonId']); ?> </td>
                <td>
				<?php
					$proColor="";
					$rscolor=GetPageRecord('colorId','styleColorDetailMaster','1 and styleId='.$qdata['id'].' order by id asc');
					while($resListingcolor=mysqli_fetch_array($rscolor)){
					$ccq=GetPageRecord('name','colorCardMaster','1 and id="'.$resListingcolor['colorId'].'"');
				    $colName=mysqli_fetch_array($ccq);
					$proColor.=$colName['name'].',';
					}
					echo rtrim($proColor,',');
				?>
				</td>

				<td><?php echo $qdata['projecQty']; ?></td>
                <td><?php echo $qdata['smv']; ?></td>
                <td>

				    <?php
				$proValueAddition="";
				$rscolorem=GetPageRecord('valueEdition','styleColorDetailMaster','1 and styleId='.$qdata['id'].' order by id asc');
				while($resListingcolorem=mysqli_fetch_array($rscolorem)){
				$valq=GetPageRecord('name','embroideryTypeMaster','1 and id="'.$resListingcolorem['valueEdition'].'"');
				$valAddData=mysqli_fetch_array($valq);
				$proValueAddition.=$valAddData['name'].',';
				}
				echo rtrim($proValueAddition,',');
				?>
		         </td>
                <td>
				<?php
$shellNameFinal="";
$shellSupplierFinal="";

$shellFq=GetPageRecord('id,name','styleSubCategoryMaster','1 and styleId='.$qdata['id'].' and id in (select stylesubtabid from techPackDetailMaster where bomPlacement="Shell") order by id asc');
while($shellData=mysqli_fetch_array($shellFq)){

$shellNameFinal.=$shellData['name'].',';

$tsq=GetPageRecord('storesupplier','techPackDetailMaster','1 and stylesubtabid='.$shellData['id'].' order by id asc');
while($techShellData=mysqli_fetch_array($tsq)){
$shellSupplierFinal.=getsupplierCompany($techShellData['storesupplier']).',';
}


}
echo rtrim($shellNameFinal,',');
?>
			</td>

				<td><?php echo rtrim($shellSupplierFinal,','); ?></td>

                <td>
<?php
$liningNameFinal="";
$liningSupplierFinal="";
$liningFq=GetPageRecord('id,name','styleSubCategoryMaster','1 and styleId='.$qdata['id'].' and id in (select stylesubtabid from techPackDetailMaster where bomPlacement="Lining") order by id asc');
while($liningData=mysqli_fetch_array($liningFq)){
$liningNameFinal.=$liningData['name'].',';

$tlq=GetPageRecord('storesupplier','techPackDetailMaster','1 and stylesubtabid='.$liningData['id'].' order by id asc');
while($techLiningData=mysqli_fetch_array($tlq)){
$liningSupplierFinal.=getsupplierCompany($techLiningData['storesupplier']).',';
}


}
echo rtrim($liningNameFinal,',');
?>

				</td>
				 <td><?php echo rtrim($liningSupplierFinal,','); ?></td>
                <td><?php if($qdata['pcdDate']!='0000-00-00' && $qdata['pcdDate']!='' && $qdata['pcdDate']!='1970-01-01'){  echo date('d-m-Y', strtotime($qdata['pcdDate'])); } ?></td>
                <td style="text-aling:center;">
                  <?php if($qdata['shipDate']!='0000-00-00' && $qdata['shipDate']!='' && $qdata['shipDate']!='1970-01-01'){  echo date('d-m-Y', strtotime($qdata['shipDate'])); } ?>
</td>


                </tr>



              <?php } ?>
			  </tbody>
            </table>