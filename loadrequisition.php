<?php

include('inc.php');



if($_REQUEST['id']!=''){


$grnLastId = decode($_REQUEST['id']);


$rschaalan=GetPageRecord('*','loadRequisitionMaster','id="'.$grnLastId.'"');

$userschaalan=mysqli_fetch_array($rschaalan);
deleteRecord('loadRequisitionMaster','quantity=""');

deleteRecord('loadRequisitionMaster','parentId="'.$grnLastId.'" and requisitiontype!="'.$_REQUEST['reqtype'].'"');



if($_REQUEST['addsize']==1 && $_REQUEST['id']!='' && $_REQUEST['action']=='addnewrow'){

  $rstype=GetPageRecord('*','materialTypeMaster','1 and id="'.$_REQUEST['reqtype'].'"');
              while($resListingtype=mysqli_fetch_array($rstype)){

               $rs1=GetPageRecord('*','styleSubCategoryMaster','styleId="'.$_REQUEST['style'].'" and costsheetVersionId="'.$_REQUEST['costsheet'].'" and materialType="'.$resListingtype['id'].'" and parentId=0 order by sr asc');
              while($resListing1=mysqli_fetch_array($rs1)){
              $color='';
              $colorno=1;






$rsw=GetPageRecord('*','queryMaster','id="'.$_REQUEST['style'].'"');

$userrsw=mysqli_fetch_array($rsw);


    if($userrsw['sampleStyle']==1){


         $rs12=GetPageRecord('*','purchaseOrderStyleMaster','styleId="'.$_REQUEST['style'].'" and sectionType=0 order by id asc');
              while($result1=mysqli_fetch_array($rs12)){


              $rs2=GetPageRecord('*','purchaseOrderStyleMaster','parentId="'.$result1['id'].'"');
              while($result2=mysqli_fetch_array($rs2)){
                $color = $result2['color'];

              }


              $rs121=GetPageRecord('*','techPackDetailMaster',' stylesubtabid="'.$resListing1['id'].'" and sectionType="bom" and styleId="'.$resListing1['styleId'].'" and costsheetVersionId="'.$_REQUEST['costsheet'].'" order by id asc');
              $resListing12=mysqli_fetch_array($rs121);


             if($resListing1['sizeSeparate']==0){

                if($resListingtype['id']==1 || $resListingtype['id']==3 || $resListingtype['id']==2){
                $rs11=GetPageRecord('name','colorCardMaster','id="'.$color.'"');
                $resListing11=mysqli_fetch_array($rs11);
                  $colorarr = rtrim($resListing11['name'],',');
                }


               $namevalue ='parentId="'.decode($_REQUEST['id']).'",materialId="'.$resListing1['id'].'",color="'.$colorarr.'",styleId="'.$_REQUEST['style'].'",techpackId="'.$resListing12['id'].'",colorId="'.$color.'"';

                      addlistinggetlastid('loadRequisitionMaster',$namevalue);

                    }

              $rs1111=GetPageRecord('*','styleSubCategoryMaster','parentId="'.$resListing1['id'].'"');
              while($resListing1111=mysqli_fetch_array($rs1111)){
              $newsize = $resListing1111['sizeName'];

              if($resListingtype['id']==2){
                $colorone =  $resListing12['trimColor'.$colorno];
              }
      $namevalue ='parentId="'.decode($_REQUEST['id']).'",materialId="'.$resListing1['id'].'",color="'.$colorarr.'",styleId="'.$_REQUEST['style'].'",techpackId="'.$resListing12['id'].'",colorId="'.$color.'"';

                      addlistinggetlastid('loadRequisitionMaster',$namevalue);

               }

              }





    }  else{


      	$colorno=1;
							$rs12=GetPageRecord('*','styleColorDetailMaster','styleId="'.$resListing1['styleId'].'"');
							while($result1=mysqli_fetch_array($rs12)){
							$color='';
							$orderQty='';
							$size='';
							$totalMaterialQty = '0';

							$orderQty+=$result1['qty'];
							$color = $result1['colorId'];

              $rs121=GetPageRecord('*','techPackDetailMaster',' stylesubtabid="'.$resListing1['id'].'" and sectionType="bom" and styleId="'.$resListing1['styleId'].'" and costsheetVersionId="'.$_REQUEST['costsheet'].'" order by id asc');
              $resListing12=mysqli_fetch_array($rs121);


             if($resListing1['sizeSeparate']==0){

                if($resListingtype['id']==1 || $resListingtype['id']==3 || $resListingtype['id']==2){
                $rs11=GetPageRecord('name','colorCardMaster','id="'.$color.'"');
                $resListing11=mysqli_fetch_array($rs11);
                  $colorarr = rtrim($resListing11['name'],',');
                }


               $namevalue ='parentId="'.decode($_REQUEST['id']).'",materialId="'.$resListing1['id'].'",color="'.$colorarr.'",styleId="'.$_REQUEST['style'].'",techpackId="'.$resListing12['id'].'",colorId="'.$color.'"';

                      addlistinggetlastid('loadRequisitionMaster',$namevalue);

                    }

              $rs1111=GetPageRecord('*','styleSubCategoryMaster','parentId="'.$resListing1['id'].'"');
              while($resListing1111=mysqli_fetch_array($rs1111)){
              $newsize = $resListing1111['sizeName'];

              if($resListingtype['id']==2){
                $colorone =  $resListing12['trimColor'.$colorno];
              }
      $namevalue ='parentId="'.decode($_REQUEST['id']).'",materialId="'.$resListing1['id'].'",color="'.$colorarr.'",styleId="'.$_REQUEST['style'].'",techpackId="'.$resListing12['id'].'",colorId="'.$color.'"';

                      addlistinggetlastid('loadRequisitionMaster',$namevalue);

               }

              }

    }

              } }

}


if($_REQUEST['deletestatus']=="yes" && $_REQUEST['rowid']!=''){

deleteRecord('loadRequisitionMaster','id="'.$_REQUEST['rowid'].'"');


}



?>

<?php

          $no = 1;

          $wherenew='parentId="'.$grnLastId.'" order by id asc';

          $rsnew=GetPageRecord('*','loadRequisitionMaster',$wherenew);
          $inspectedQty='0';
          while($rslistnew=mysqli_fetch_array($rsnew)){

            $style=GetPageRecord('id,materialMasterId,materialType,allocationNo,addMaterialFrom','styleSubCategoryMaster','1 and id="'.$rslistnew['materialId'].'"');

          $stylename=mysqli_fetch_array($style);

           $color=GetPageRecord('*','colorCardMaster','1 and name="'.$rslistnew['color'].'" order by id desc');

          $colorname=mysqli_fetch_array($color);

          if($stylename['materialType'] == 1){

            if($stylename['allocationNo']!=''){

              if($stylename['addMaterialFrom']=='yarn'){

                $checkid=GetPageRecord('*','yarnAllocation','allocationNo="'.$stylename['allocationNo'].'"');
                $checkidlist21=mysqli_fetch_array($checkid);

                $checkid2=GetPageRecord('*','yarnRequisition','styleNo="'.$checkidlist21['greigeStyleNo'].'"');
                $checkidlist2=mysqli_fetch_array($checkid2);
                $styid = $checkidlist2['id'];

              }elseif($stylename['addMaterialFrom']=='greige'){
                $checkid=GetPageRecord('*','greigeAllocation','allocationNo="'.$stylename['allocationNo'].'"');
                $checkidlist=mysqli_fetch_array($checkid);

                $checkid2=GetPageRecord('*','greigeRequisition','styleNo="'.$checkidlist['greigeStyleNo'].'"');
                $checkidlist2=mysqli_fetch_array($checkid2);
                $styid = $checkidlist2['id'];
              }

              $data=GetPageRecord('sum(acceptedField) as totalacceptedField','lotWiseData','1 and styleId="'.$styid.'" and materialid="'.$stylename['materialMasterId'].'" and colorid="'.$rslistnew['colorId'].'"');
              $dataname11=mysqli_fetch_array($data);
              $inspectedQty=$dataname11['totalacceptedField'];

            }else{
              $data=GetPageRecord('sum(acceptedField) as totalacceptedField','lotWiseData','1 and styleId="'.$rslistnew['styleId'].'" and materialid="'.$rslistnew['materialId'].'" and colorid="'.$colorname['id'].'"');
              $dataname=mysqli_fetch_array($data);
              $inspectedQty=$dataname['totalacceptedField'];
            }

      }
      if($stylename['materialType'] == 2){
        $data=GetPageRecord('sum(accepted) as totalaccepted','qualityreportmaster','1 and styleId="'.$rslistnew['styleId'].'" and materialid="'.$rslistnew['materialId'].'" and type="triminspectioninput" and colorid="'.$colorname['id'].'"');
        $dataname=mysqli_fetch_array($data);
        $inspectedQty=$dataname['totalaccepted'];
      }
      if($stylename['materialType'] == 3){

$data=GetPageRecord('sum(accepted) as totalaccepted','packagingqualityreportmaster','1 and styleId="'.$rslistnew['styleId'].'" and type="packagingtriminspectioninput" and materialid="'.$rslistnew['materialId'].'" and colorid="'.$colorname['id'].'"');
$dataname=mysqli_fetch_array($data);
$inspectedQty=$dataname['totalaccepted'];

        }



          ?>

<tr>

    <td><a href="javascript:void(0);" onclick="deleterow('<?php echo $rslistnew['id']; ?>');"><i class="icon-trash"
                style="font-size:13px;cursor:pointer; color:#FF0000;"></i></a></td>

    <td style="text-align: center;"><?php
                     $rs1112=GetPageRecord('*','styleSubCategoryMaster','id="'.$rslistnew['materialId'].'"');
                       $resListing1112=mysqli_fetch_array($rs1112);

                    echo $resListing1112['name'];
                     ?></td>

    <td align="center"><?php echo $rslistnew['color']; ?></td>

    <td style="text-align: center;"><input type="text" name="marker" id="marker<?php echo $rslistnew['id']; ?>"
            value="<?php echo $rslistnew['marker']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();"
            style="width:80px;" <?php if($rslistnew['status'] == '1') { ?> disabled <?php } ?> /></td>

    <td style="text-align: center;"><input type="text" name="size" id="size<?php echo $rslistnew['id']; ?>"
            value="<?php echo $rslistnew['size']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();"
            style="width:80px;" <?php if($rslistnew['status'] == '1') { ?> disabled <?php } ?> /></td>
    <?php
                $rs1113=GetPageRecord('*','techPackDetailMaster','id="'.$rslistnew['techpackId'].'"');
                       $resListing1113=mysqli_fetch_array($rs1113);

                ?>
    <td><input type="text" name="average" id="average<?php echo $rslistnew['id']; ?>"
            value="<?php echo $resListing1113['avgIncWastage']; ?>" style="width:80px;" readonly></td>

    <td style="text-align: center;"><input type="text" name="packages" id="packages<?php echo $rslistnew['id']; ?>"
            value="<?php echo $rslistnew['pcs']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();"
            style="width:80px;" <?php if($rslistnew['status'] == '1') { ?> disabled <?php } ?> /></td>

    <td style="text-align: center;"><input type="text" name="amount" id="amount<?php echo $rslistnew['id']; ?>"
            value="<?php echo $rslistnew['quantity']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();"
            style="width:80px;" readonly></td>


    <?php



 $sr=1;
				 $gateEntryno='';
				 $rs_t=GetPageRecord('*','grnMaster','1 and styleId="'.$_REQUEST['style'].'" and materialId ="'.$rslistnew['materialId'].'" and color="'.$rslistnew['colorId'].'"');
		          $rs_ta=mysqli_fetch_array($rs_t);


                 $i=0;$totalissuetilldate=0;
                 $issuance=GetPageRecord('*','issuanceMaster','1 and styleId="'.$_REQUEST['style'].'"');
                 while($dataissue=mysqli_fetch_array($issuance)){

        $newdata = explode(',', $dataissue['materialId']);
        $newdata1 = explode(',', $dataissue['color']);
        $newdata2 = explode(',', $dataissue['issueqty']);
        for($i=0;$i < count($newdata);$i++){


            // echo $newdata[$i].'<br>';
        if($newdata[$i] == $rslistnew['materialId'] && $newdata1[$i] == $rs_ta['color']) {
         $totalissuetilldate+=$newdata2[$i];



        }



				 }


        }
$rsgrnrec=GetPageRecord('sum(netReceived) as netReceivedTill,color,parentId','grnMaster','styleId="'.$_REQUEST['style'].'" and materialId="'.$rslistnew['materialId'].'" and color="'.$rslistnew['colorId'].'"');
				$rsgrnrecTill=mysqli_fetch_array($rsgrnrec);





$rswx=GetPageRecord('*','queryMaster','id="'.$_REQUEST['style'].'"');

$userrswx=mysqli_fetch_array($rswx);




?>



    <td style="text-align: center;">
        <input type="text" name="available" id="available<?php echo $rslistnew['id']; ?>"
            value="<?php if($userrswx['sampleStyle']==2 || $userrswx['sampleStyle']==1){
               echo round($rsgrnrecTill['netReceivedTill'],2)- $totalissuetilldate ;
               //echo $inspectedQty;
               }else {
                echo $inspectedQty - $totalissuetilldate;
                //echo $inspectedQty;
                } ?>"
            onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;"
            <?php if($rslistnew['status'] == '1') { ?> disabled <?php } ?> readonly>
    </td>

    <!--<td><?php if($userrswx['sampleStyle']==2){ echo round($rsgrnrecTill['netReceivedTill'],2)- $totalissuetilldate ;}else { echo $inspectedQty - $totalissuetilldate; } ?></td>-->


</tr>



<script>
savelinedetail<?php echo $rslistnew['id']; ?>();

function savelinedetail<?php echo $rslistnew['id']; ?>() {

    var marker = $('#marker<?php echo $rslistnew['id']; ?>').val();

    var size = $('#size<?php echo $rslistnew['id']; ?>').val();

    var packages = $('#packages<?php echo $rslistnew['id']; ?>').val();

    var average = $('#average<?php echo $rslistnew['id']; ?>').val();

    var amount1 = Number(packages * average);

    $('#amount<?php echo $rslistnew['id']; ?>').val(amount1);

    var amount = $('#amount<?php echo $rslistnew['id']; ?>').val();

    var available = $('#available<?php echo $rslistnew['id']; ?>').val();

    var checkpckge = Number(available / average);

    /*if (packages > checkpckge) {
        alert('Quantity should not be greater than Available Quantity');
        // $('#packages<?php echo $rslistnew['id']; ?>').val(0);
        // $('#amount<?php echo $rslistnew['id']; ?>').val(0);
    }*/


    $('#savedata').load('allaction.php?action=requisitiondetail&id=<?php echo $rslistnew['id']; ?>&marker=' + marker +
        '&packages=' + packages + '&amount=' + amount + '&size=' + size + '&available=' + available +
        '&reqtype=<?php echo $_REQUEST['reqtype'] ?>');



}
</script>



<?php $no++; }  ?>



<?php

          if($no==1){

          ?>

<tr>

    <td colspan="50" style="text-align: center;">No record found.</td>

</tr>

<?php } } ?>