<?php

include('inc.php');



deleteRecord('issuanceMaster','parentId="'.decode($_REQUEST['id']).'" and requisitionId !="'.$_REQUEST['reqtype'].'"');

if($_REQUEST['addsize']==1 && $_REQUEST['id']!='' && $_REQUEST['action']=='addnewrow'){

 $wherenew='parentId="'.$_REQUEST['reqtype'].'" and parentId != "0" order by id asc';

          $rsnew=GetPageRecord('*','requisitionmaster',$wherenew);

          while($rslistnew=mysqli_fetch_array($rsnew)){

      $namevalue ='parentId="'.decode($_REQUEST['id']).'",materialId="'.$rslistnew['materialId'].'",styleId="'.$rslistnew['styleId'].'",techpackId="'.$rslistnew['techpackId'].'",color="'.$rslistnew['color'].'",requisitionId="'.$_REQUEST['reqtype'].'",addedBy="'.$_SESSION['userid'].'",marker="'.$rslistnew['marker'].'",size="'.$rslistnew['size'].'",pcs="'.$rslistnew['pcs'].'",quantity="'.$rslistnew['quantity'].'"';

                      addlistinggetlastid('issuanceMaster',$namevalue);


                     }


}


if($_REQUEST['deletestatus']=="yes" && $_REQUEST['rowid']!=''){

deleteRecord('issuanceMaster','id="'.$_REQUEST['rowid'].'"');

}



          $no = 1;

          $wherenew='parentId="'.decode($_REQUEST['id']).'" and parentId!= "0" order by id asc';

          $rsnew=GetPageRecord('*','issuanceMaster',$wherenew);

          while($rslistnew=mysqli_fetch_array($rsnew)){

                $rs1113=GetPageRecord('*','techPackDetailMaster','id="'.$rslistnew['techpackId'].'"');
                       $resListing1113=mysqli_fetch_array($rs1113);

                $rs1112=GetPageRecord('*','styleSubCategoryMaster','id="'.$rslistnew['materialId'].'"');
                       $resListing1112=mysqli_fetch_array($rs1112);

          ?>

                  <tr>
                    <td><a href="javascript:void(0);" onclick="deleterow('<?php echo $rslistnew['id']; ?>');"><i class="icon-trash" style="font-size:13px;cursor:pointer; color:#FF0000;"></i></a>&nbsp;<strong><?php echo $no; ?>.</strong></td>

                    <td style="text-align: center;"><?php echo $resListing1112['name'];?></td>

                   <td align="center"><?php echo $rslistnew['color']; ?></td>

                   <td align="center"><?php echo $resListing1113['bomUnit']; ?></td>

                    <td style="text-align: center;"><?php echo $rslistnew['quantity']; ?></td>

                    <td style="text-align: center;"><input type="text" name="issueqty[]" id="issueqty<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['issueqty']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;"></td>

                    <td style="text-align: center;"><input type="text" name="balance[]" id="balance<?php echo $rslistnew['id']; ?>" value="<?php echo $rslistnew['balance']; ?>" onkeyup="savelinedetail<?php echo $rslistnew['id']; ?>();" style="width:80px;" readonly></td>

                    <td style="text-align: center;"><?php echo $rslistnew['marker']; ?></td>

                    <td style="text-align: center;"><?php echo $rslistnew['size']; ?></td>

                    <td style="text-align: center;"><?php echo $resListing1113['avgIncWastage']; ?></td>

                    <td style="text-align: center;"><?php echo $rslistnew['pcs']; ?></td>

                  </tr>



        <script>

        function savelinedetail<?php echo $rslistnew['id']; ?>(){

        var issueqty = $('#issueqty<?php echo $rslistnew['id']; ?>').val();

        var quantity = "<?php echo $rslistnew['quantity']; ?>";

        var amount1 = Number(quantity-issueqty);

        $('#balance<?php echo $rslistnew['id']; ?>').val(amount1);

        var balance = $('#balance<?php echo $rslistnew['id']; ?>').val();



        $('#savedata').load('allaction.php?action=issuancedetail&id=<?php echo $rslistnew['id']; ?>&issueqty='+issueqty+'&balance='+balance);



        }

        </script>



                  <?php $no++; }  ?>



          <?php

          if($no==1){

          ?>

          <tr>

          <td colspan="50" style="text-align: center;">No record found.</td>

          </tr>

          <?php
           }
           ?>




