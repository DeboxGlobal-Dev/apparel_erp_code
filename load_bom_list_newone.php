<input type="hidden" name="cvId" id="cvId" value="" />

<input type="hidden" name="bomTotalCount" id="bomTotalCount" value="" />

<input type="hidden" name="bomTotalCountextra" id="bomTotalCountextra" value="" />

<?php

include "inc.php";



if($_REQUEST['loginuserprofileId']=='154'){

$wheresearchassign=' 1 and  FIND_IN_SET('.$_SESSION['userid'].',assignTo) and ';

}elseif($_REQUEST['loginuserprofileId']=='155'){

$wheresearchassign=' 1 and  FIND_IN_SET('.$_SESSION['userid'].',assignToPurMerchant) and ';

}else{

$wheresearchassign=' 1 and ';

}



//=================================Style Data===================================================

$squery=GetPageRecord('*','queryMaster','id="'.$_REQUEST['styleId'].'"');

$styleData=mysqli_fetch_array($squery);



$bquery=GetPageRecord('*',_BUYER_MASTER_,'1 and id="'.$styleData['buyerId'].'"');

$buyerData=mysqli_fetch_array($bquery);



$brquery=GetPageRecord('*','brandMaster','id="'.$styleData['brandId'].'"');

$brandData=mysqli_fetch_array($brquery);



//===============================================================================================================











if($_REQUEST['sr']!='' && $_REQUEST['costsheetVersionId']!=''){



$namevalue121 ='styleId="'.$_REQUEST['styleId'].'",sr="'.$_REQUEST['sr'].'",subCategoryId="'.$_REQUEST['subCategoryId'].'",materialType="'.$_REQUEST['materialtype'].'",costsheetVersionId="'.$_REQUEST['costsheetVersionId'].'",materialid="'.$_REQUEST['materialid'].'"';



addlisting('styleSubCategoryMaster',$namevalue121);



?>

<script>
tabhideshow<?php echo $_REQUEST['materialtype']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();
</script>

<?php

}





if($_REQUEST['updateid']!='' && $_REQUEST['newmaterial']!='' && $_REQUEST['costsheetVersionId']!=''){



$namevalue ='materialMasterId="'.$_REQUEST['newmaterial'].'",name="'.getMaterialName($_REQUEST['newmaterial']).'"';

$where='id="'.$_REQUEST['updateid'].'"';

updatelisting('styleSubCategoryMaster',$namevalue,$where);

?>

<script>
tabhideshow<?php echo $_REQUEST['materialtype']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();
</script>

<?php

}





if($_REQUEST['materialdescription']!='' && $_REQUEST['id']!='' && $_REQUEST['costsheetVersionId']!='' && $_REQUEST['materialtype']!=''){



$namevalue222 ='materialdescriptionid="'.$_REQUEST['materialdescription'].'",costsheetVersionId="'.$_REQUEST['costsheetVersionId'].'"';

$where222='id="'.$_REQUEST['id'].'"';

updatelisting('styleSubCategoryMaster',$namevalue222,$where222);

?>

<script>
tabhideshow<?php echo $_REQUEST['materialtype']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();
</script>

<?php

}





if($_REQUEST['deleteid']!='' && $_REQUEST['costsheetVersionId']!=''){

deleteRecord('styleSubCategoryMaster','id='.$_REQUEST['deleteid'].'');

deleteRecord('techPackDetailMaster','cid='.$_REQUEST['deleteid'].'');

?>

<script>
//load_bom_list_fun<?php echo $_REQUEST['costsheetVersionId']; ?>();

tabhideshow<?php echo $_REQUEST['materialtype']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();
</script>

<?php

}

?>

<?php

//delete all material

if($_REQUEST['action']=='allmaterialdelete'){

$deleteAlll = $_REQUEST['CheckUncheckMaterial'];



$array =  explode(',', $deleteAlll);

foreach($array as $id) {

$wheredelete='id="'.$id.'"';

deleteRecord('styleSubCategoryMaster',$wheredelete);

}



?>

<script>
tabhideshow<?php echo $_REQUEST['materialtype']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();
</script>

<?php

}

?>

<style type="text/css">
.style1 {
    font-weight: bold
}
</style>

<style>
.grand-total-class {

    padding: 10px 15px;

    font-size: 15px;

    cursor: pointer;

    background-color: #f7f7f7;

    font-weight: 500;

    color: #000000;

    width: 100%;

    box-sizing: border-box;

    border: 2px #ccc solid;

    margin-bottom: 10px;

}



.successcomment {

    display: none;

    width: 100%;

    margin: 10px 0px;

    padding: 10px 10px;

    background: #37c43d;

    color: #fff;

    font-size: 13px;

}
</style>

<script>
$('.newDatePicker').Zebra_DatePicker({

    format: 'd-m-Y',

});
</script>

<div class="specialclassforsheetsecond" style="display:none;">

    <table width="100%" class="table table-bordered table-responsive forbom" style="">

        <tbody style="width: 100%;display: inline-table;margin-bottom:20px;">

            <tr class="card-body" style="background: #e5fbfa;font-size: 15px;font-weight:600;">

                <td>M.R.P</td>

                <td>F.O.B</td>

                <td align="right">Margin</td>

            </tr>

            <tr class="card-body" style="background: #f7f7f7;font-size: 15px;font-weight: 500;">

                <td><?php

$rs31=GetPageRecord('*','costsheetVersionMaster','styleId="'.$_REQUEST['styleId'].'" and versionId="'.$_REQUEST['costsheetVersionId'].'"');

$resListing31=mysqli_fetch_array($rs31);

$totalmrp=$resListing31['totalmrp'];

$mrptotallast=$resListing31['mrptotallast'];

$finalgrandtotalwithmrp =$resListing31['finalgrandtotalwithmrp'];

?>

                    <input type="number" name="totalmrp<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="totalmrp<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        onkeyup="calculate_margin<?php echo $_REQUEST['costsheetVersionId']; ?>();"
                        value="<?php echo $totalmrp; ?>" min="0" />
                </td>

                <td><span class="" name="mrptotallast<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="mrptotallast<?php echo $_REQUEST['costsheetVersionId']; ?>"><?php echo $mrptotallast; ?></span>
                </td>

                <td align="right"><span class="finalgrandtotalwithmrp<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="finalgrandtotalwithmrp<?php echo $_REQUEST['costsheetVersionId']; ?>"><?php echo $finalgrandtotalwithmrp; ?></span>
                </td>

            </tr>

        </tbody>

    </table>

</div>

<div class="specialclassforsheetsecond" <?php //if($_REQUEST['page']!='costsheet') {?>style="display:none;"
    <?php //} ?>>

    <table width="100%" class="table table-bordered table-responsive forbom" style="">

        <tbody style="width: 100%;display: inline-table;margin-bottom:20px;">

            <tr class="card-body" style="background: #e5fbfa;font-size: 15px;font-weight:600;">

                <td align="center" colspan="3">Currency</td>

                <td width="17%" align="center">Effective FOB Price</td>

                <td width="16%" align="center">PRODUCT COST</td>

                <td width="16%" align="center">Profit/Loss</td>

            </tr>

            <tr class="card-body" style="background: #f7f7f7;font-size: 15px;font-weight: 500;">

                <?php

$rs31=GetPageRecord('*','costsheetVersionMaster','styleId="'.$_REQUEST['styleId'].'" and versionId="'.$_REQUEST['costsheetVersionId'].'"');

$resListing31=mysqli_fetch_array($rs31);

?>

                <td width="8%" align="center">1 USD</td>

                <td width="22%" align="center"><span>Bid price</span>

                    <input type="number" name="bidinrvalue<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="bidinrvalue<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        value="<?php if($resListing31['bidinrvalue']!=''){ echo $resListing31['bidinrvalue']; }else{ echo '71'; } ?>"
                        style="width:80px; text-align:center;" />

                    INR
                </td>

                <td width="21%" align="center"><span>Ask price</span>

                    <input type="number" name="inrvalue<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="inrvalue<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        value="<?php if($resListing31['inrvalue']!=''){ echo $resListing31['inrvalue']; }else{ echo '71'; } ?>"
                        style="width:80px; text-align:center;"
                        onkeyup="change_usd_value<?php echo $_REQUEST['costsheetVersionId']; ?>();" />

                    INR
                </td>

                <td align="center"><span class=""
                        name="effectivepriceselling<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="effectivepriceselling<?php echo $_REQUEST['costsheetVersionId']; ?>"><?php echo $resListing31['effectivesellingprice']; ?></span>
                </td>

                <td align="center"><span class="" name="totalfobcost<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="totalfobcost<?php echo $_REQUEST['costsheetVersionId']; ?>"><?php echo $resListing31['totalcostfob']; ?></span>
                </td>

                <td align="center"><span class="" name="totalallprofit<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="totalallprofit<?php echo $_REQUEST['costsheetVersionId']; ?>"><?php echo $resListing31['profit']; ?></span>
                    (<span class="" name="totalallprofitlosspercent<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="totalallprofitlosspercent<?php echo $_REQUEST['costsheetVersionId']; ?>"><?php echo $resListing31['profitlosspercent']; ?></span>%)
                </td>

            </tr>

        </tbody>

    </table>

</div>

<?php

							$allfunction ='';

							$countfortotal = 0;

							$firsrgrandtotoal = 0;

							$sNo1 = 0;

							$rowno=0;

							$select12='*';

							$where12='id="'.$_REQUEST['subCategoryId'].'" ';

							$rs12=GetPageRecord($select12,'subCategoryMaster',$where12);

							$resListing123=mysqli_fetch_array($rs12);



							$loopst=0;

							$where33='';

							$rs33='';

							$totalvarcount =0;

							$select33='id,name';

							$where33='1 order by id asc';

							$rs33=GetPageRecord($select33,'materialTypeMaster',$where33);

							$countfortotal=mysqli_num_rows($rs33);

							while($resListing=mysqli_fetch_array($rs33)){

							 $totalvarcount = $resListing['id'];

							 ?>

<div onclick="tabhideshow<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();"
    <?php if($_REQUEST['page']=='marker') { if($resListing['name']!='Fabric') { ?>style="display:none;" <?php }} ?>
    class="table-hide-show"
    id="table-hide-showw<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>">
    <?php echo $resListing['name']; ?> <span class="plusminusclass<?php echo $_REQUEST['costsheetVersionId']; ?>"
        style="position: absolute; right: 12px; font-size: 23px;  display:block; top: 10px;"
        id="tabplus<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"><i
            class="fa fa-plus-circle" aria-hidden="true"></i></span> <span
        style="position: absolute; right: 12px; font-size: 23px; display:none; top: 10px;"
        id="tabminus<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"><i
            class="fa fa-minus-circle" aria-hidden="true"></i></span>

    <script>
    function tabhideshow<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>() {



        $('#tableid<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').toggle();



        var tabplus = $('#tabplus<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').css(
            'display');



        if (tabplus == 'block') {

            $('#tabminus<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').show();

            $('#tabplus<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').hide();

        } else {

            $('#tabminus<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').hide();

            $('#tabplus<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').show();



        }



    }
    </script>

</div>

<table width="100%" class="table table-bordered table-responsive forbom"
    id="tableid<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" style="display:none;">

    <tbody style="width: 100%;display: inline-table;">

        <tr class="card-body"
            <?php if($_REQUEST['page']=='marker') { if($resListing['name']!='Fabric') { ?>style="display:none;"
            <?php }} ?>>

            <td align="center"
                <?php if($_REQUEST['page']=='marker' || $_REQUEST['page']=='materiallist' || $_REQUEST['page']=='costsheet' || $_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='addbom') {?>style="display:none;"
                <?php } ?>>
                <div class="btn-group justify-content-center"
                    style="cursor: pointer; float: left; padding: 1px; margin: 0px 0px 8px; border: 1px solid rgb(92, 107, 192); color: rgb(92, 107, 192); border-radius: 2px; font-size: 11px;  display: none;width: 100%; font-weight: 600;"
                    id="materialdeactivatebtn<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    onclick="delteAllMaterial<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>('<?php echo $resListing['id']; ?>','<?php echo $_REQUEST['costsheetVersionId']; ?>');">
                    Delete</div>

                <input
                    name="materialCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    type="checkbox" class="checkalldeletematerial"
                    id="materialCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    style="height: 15px;width: 15px;margin-top: 0;text-align: center;" />

            </td>

            <?php if($_REQUEST['loginuserprofileId']!='154' && $_REQUEST['loginuserprofileId']!='155'){ ?>

            <td align="center" <?php if($_REQUEST['page']!='materiallist') {?>style="display:none;" <?php } ?>><input
                    name="incCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    type="checkbox" class="style1"
                    id="incCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    style="height: 17px; width: 30px; margin-top: 4px; text-align: center;" /></td>

            <?php } ?>

            <?php if($_REQUEST['loginuserprofileId']=='154'){ ?>

            <td align="center" <?php if($_REQUEST['page']!='materiallist') {?>style="display:none;" <?php } ?>><input
                    name="purchasemerchantincCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    type="checkbox" class="style1"
                    id="purchasemerchantincCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    style="height: 17px; width: 30px; margin-top: 4px; text-align: center;" /></td>

            <?php } ?>

            <style>
            .foranalysismateriallist {

                width: 160px !important;

            }
            </style>

            <td align="left"><strong>Material&nbsp;Id</strong></td>

            <td align="left"><strong>Material&nbsp;Name</strong></td>

            <td align="left"><strong>Description</strong></td>
            <td align="left"><strong>GSM</strong></td>
            <td align="left"
                <?php if($_REQUEST['page']=='sampleanalysematerial' || $_REQUEST['page']=='samplingbom' || $_REQUEST['page']=='materiallist'){ ?>
                style="display:none;" <?php } ?>><strong>Finish</strong></td>

            <td align="center"
                class="<?php if($_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='marker') { ?>foranalysismateriallist<?php } ?>"
                <?php if($_REQUEST['page']=='materiallist' || $_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='costsheet'){ ?>
                style="display:none;" <?php } ?>><strong>Width/Size</strong></td>

            <td align="center"
                class="<?php if($_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='marker') { ?>foranalysismateriallist<?php } ?>"
                <?php if($_REQUEST['page']=='materiallist' || $_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='costsheet'){ ?>
                style="display:none;" <?php } ?>><strong>UOM</strong></td>

            <td align="center" <?php if($_REQUEST['page']=='prototypesample'){ ?> style="display:none;" <?php } ?>>
                <strong>Avg/Qty</strong></td>

            <td align="center" <?php if($_REQUEST['page']=='prototypesample'){ ?> style="display:none;" <?php } ?>>
                <strong>UOM</strong></td>

            <td align="center"
                <?php if($_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='marker' || $_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='sampleanalysematerial'){ ?>
                style="display:none;" <?php } ?>><strong>Wastage%</strong></td>

            <td align="center"
                <?php if($_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='marker' || $_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='sampleanalysematerial'){ ?>
                style="display:none;" <?php } ?>><strong>Avg&nbsp;Inc.&nbsp;Wastage</strong></td>

            <td align="center"
                <?php if($_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='marker' || $_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='sampleanalysematerial'){ ?>
                style="display:none;" <?php } ?>><strong>Price</strong></td>

            <td align="center"
                <?php if($_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='marker' || $_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='sampleanalysematerial'){ ?>
                style="display:none;" <?php } ?>><strong>Currency</strong></td>

            <td align="center" style="display:none;"><strong>INR</strong></td>

            <td align="center" style="display:none;"><strong>USD</strong></td>

            <td align="center"
                <?php if($_REQUEST['page']=='marker' || $_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='sampleanalysematerial' || $_REQUEST['page']=='samplingbom'){ ?>
                style="display:none;" <?php } ?>><strong>Landing&nbsp;Cost(%)</strong></td>

            <td align="center"
                <?php if($_REQUEST['page']=='marker' || $_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='sampleanalysematerial' || $_REQUEST['page']=='samplingbom'){ ?>
                style="display:none;" <?php } ?>><strong>Landed&nbsp;Cost</strong></td>

            <td align="center"
                <?php if($_REQUEST['page']=='marker' || $_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='sampleanalysematerial'){ ?>
                style="display:none;" <?php } ?>><strong>Material&nbsp;Cost</strong></td>

            <td align="center" <?php if($_REQUEST['page']!='addbom' && $_REQUEST['page']!='analysemateriallist'){ ?>
                style="display:none;" <?php } ?>><strong>Component Location</strong></td>

            <?php

$colorq=GetPageRecord('colorId','styleColorDetailMaster','1 and styleId="'.$_REQUEST['styleId'].'" order by id asc');

while($styleData=mysqli_fetch_array($colorq)){



$colornameq=GetPageRecord('name','colorCardMaster','1 and id="'.$styleData['colorId'].'"');

$colorNameQuery=mysqli_fetch_array($colornameq);



?>

            <td align="center" <?php if($_REQUEST['page']!='addbom' && $_REQUEST['page']!='samplingbom'){ ?>
                style="display:none;" <?php } ?>><strong><?php echo $resListing['name']; ?> Color for style <br />

                    <?php echo $colorNameQuery['name']; ?></strong></td>

            <?php } ?>

            <style>
            .bomhideshow {

                display: none;

            }
            </style>

            <script>
            $(".bomhideshowsecond").on('click', function(event) {

                $('.bomhideshow').removeClass('bomhideshow');

                $('.bomhideshowsecond').addClass('bomhideshow');

            });
            </script>

            <?php if(($_REQUEST['page']=='sampleanalysematerial' || $_REQUEST['page']=='analysemateriallist') && $resListing['id']==1) { ?><td
                align="center"><strong>Color&nbsp;Standard Approval</strong> </td><?php } ?>

            <td align="center"
                <?php if($_REQUEST['page']=='marker' || $_REQUEST['page']=='sampleanalysematerial' || $_REQUEST['page']=='samplingbom'){ ?>
                style="display:none;" <?php } ?>><strong>Merchant Comment</strong></td>

            <td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?>>
                <strong>Amendment</strong></td>

            <td align="center"
                style=" <?php if($_REQUEST['page']=='marker' || $_REQUEST['page']=='sampleanalysematerial' || $_REQUEST['page']=='samplingbom') { ?> display:none; <?php } ?> ">
                <strong>Remarks</strong></td>
            <?php if($_REQUEST['page']=='sampleanalysematerial') { ?> <td align="center" style=" ">
                <strong>Artwork&nbsp;No</strong></td> <?php } ?>
            <?php if(($_REQUEST['page']=='sampleanalysematerial' || $_REQUEST['page']=='analysemateriallist')  && $resListing['id']==1) { ?><td
                align="center" style="  "><strong>CAD&nbsp;Given Date</strong></td> <?php } ?>
            <?php if(($_REQUEST['page']=='sampleanalysematerial' || $_REQUEST['page']=='analysemateriallist')  && $resListing['id']==1) { ?><td
                align="center" style=" "><strong>Lab&nbsp;dip/Strike off/Mocks Approval</strong></td> <?php } ?>
            <?php if(($_REQUEST['page']=='sampleanalysematerial' || $_REQUEST['page']=='analysemateriallist') && $resListing['id']==1) { ?><td
                align="center" style=" "><strong>Lab&nbsp;dip/Strike off/Mocks submission</strong></td> <?php } ?>


            <td align="center" class="bomhideshowsecond"
                style=" position:relative; cursor:pointer; <?php if($_REQUEST['page']!='addbom'){ ?> display:none; <?php } ?> ">
                <span
                    style="position: absolute; top: 53px; right: -43px; color: #7985cb; font-weight: 600; transform: rotate(-91deg);"><i
                        class="fa fa-eye" aria-hidden="true"></i>&nbsp;Bom&nbsp;Approved&nbsp;Status</span></td>

            <td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?>
                class="bomhideshow"><strong>Supplier&nbsp;Article&nbsp;No.</strong></td>

            <td align="center" class=""><strong><?php if($_REQUEST['page']=='samplingbom'){ ?> Supplier Article No.
                    <?php } else { ?> Supplier&nbsp;Name <?php } ?></strong></td>
            <?php if($_REQUEST['page']=='samplingbom'){ ?> <td align="center" class="">
                <strong>Supplier&nbsp;Name</strong></td><?php } ?>

            <td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?>
                class="bomhideshow"><strong>Buyer&nbsp;Nominated</strong></td>

            <td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?>
                class="bomhideshow"><strong>Trim&nbsp;Image</strong></td>

            <td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?>
                class="bomhideshow"><strong>FINAL&nbsp;DATE&nbsp;FOR STANDARD&nbsp;HANDOVER</strong></td>

            <td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?>
                class="bomhideshow"><strong>MATERIAL&nbsp;BOOKING FINAL&nbsp;DATE</strong></td>

            <td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?>
                class="bomhideshow"><strong>FINAL&nbsp;FOR APPROVAL</strong></td>

            <td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?>
                class="bomhideshow"><strong>LEAD TIME</strong></td>

            <td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?>
                class="bomhideshow"><strong>TRANSIT TIME</strong></td>

            <td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?>
                class="bomhideshow"><strong>MATERIAL&nbsp;DISPATCH FINAL&nbsp;DATE</strong></td>

            <td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?>
                class="bomhideshow"><strong>IN/H&nbsp;DUE&nbsp;DATE</strong></td>

            <td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?>
                class="bomhideshow"><strong>IN/H&nbsp;ACTUAL DATE</strong></td>

            <td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?>
                class="bomhideshow"><strong>Q'nty Reqd.</strong></td>

            <td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?>
                class="bomhideshow"><strong>Q'nty Rcvd.</strong></td>

            <td align="center" style="display:none;"><strong>AMENDMENT DATE (IF ANY)</strong></td>

            <td align="center" <?php if($_REQUEST['page']!='costsheet'){ ?> style="display:none;" <?php } ?>>
                <strong>Add&nbsp;to&nbsp;Cost</strong> </td>

            <td align="center" style="display:none;"><strong>Quality</strong></td>

            <td align="center" style="display:none;"><strong>Color/Size</strong></td>

            <td align="center" style="display:none;"><strong>Status</strong></td>

            <?php if($_REQUEST['loginuserprofileId']!='154' && $_REQUEST['loginuserprofileId']!='155'){ ?>

            <td align="center" <?php if($_REQUEST['page']!='materiallist'){ ?> style="display:none;" <?php } ?>>
                <strong>Assign&nbsp;To</strong></td>

            <?php } ?>

            <?php if($_REQUEST['loginuserprofileId']=='154'){ ?>

            <td align="center" <?php if($_REQUEST['page']!='materiallist'){ ?> style="display:none;" <?php } ?>>
                <strong>Assigned&nbsp;Merchant</strong></td>

            <?php } ?>

            <!-- for prototype sample-->

            <td align="center" <?php if($_REQUEST['page']!='prototypesample') { ?> style="display:none;" <?php } ?>>
                <?php if($_REQUEST['loginuserprofileId']!=92) { ?>

                <div class="btn-group justify-content-center"
                    style="cursor: pointer; float: left; padding: 1px; margin: 0px 0px 8px; border: 1px solid rgb(92, 107, 192); color: rgb(92, 107, 192); border-radius: 2px; font-size: 11px;  display: none;width: 100%; font-weight: 600;"
                    id="qualitydeactivatebtn<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    onclick="requestAllQuality<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();opmodalpop('Quality','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=1&id=<?php echo $resListing1['id']; ?>&qualitySend=1','600px','auto');"
                    data-toggle="modal" data-target="#modalpop">Action</div>

                <?php } if($_REQUEST['loginuserprofileId']==92) { ?>

                <div class="btn-group justify-content-center"
                    style="cursor: pointer; float: left; padding: 1px; margin: 0px 0px 8px; border: 1px solid rgb(92, 107, 192); color: rgb(92, 107, 192); border-radius: 2px; font-size: 11px;  display: none;width: 100%; font-weight: 600;"
                    id="qualitydeactivatebtn<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    onclick="requestAllQuality<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();opmodalpop('Quality','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=1&id=<?php echo $resListing1['id']; ?>&fortTimeSlot=11&qualitySend=1','600px','auto');"
                    data-toggle="modal" data-target="#modalpop">Action</div>

                <?php } ?>

                <input
                    name="qualityCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    type="checkbox" class="qualityCheckClass"
                    id="qualityCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    style="height: 15px;width: 15px;margin-top: 0;text-align: center;" />

            </td>

            <td align="center" <?php if($_REQUEST['page']!='prototypesample') { ?> style="display:none;" <?php } ?>>
                <strong>Quality</strong></td>

            <td align="center" <?php if($_REQUEST['page']!='prototypesample') { ?> style="display:none;" <?php } ?>>
                <?php if($_REQUEST['loginuserprofileId']!=92) { ?>

                <div class="btn-group justify-content-center"
                    style="cursor: pointer; float: left; padding: 1px; margin: 0px 0px 8px; border: 1px solid rgb(92, 107, 192); color: rgb(92, 107, 192); border-radius: 2px; font-size: 11px;  display: none;width: 100%; font-weight: 600;"
                    id="pricedeactivatebtn<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    onclick="requestAllprice<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();opmodalpop('Price','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=2&id=<?php echo $resListing1['id']; ?>&priceSend=1','600px','auto');"
                    data-toggle="modal" data-target="#modalpop">Action</div>

                <?php } if($_REQUEST['loginuserprofileId']==92) { ?>

                <div class="btn-group justify-content-center"
                    style="cursor: pointer; float: left; padding: 1px; margin: 0px 0px 8px; border: 1px solid rgb(92, 107, 192); color: rgb(92, 107, 192); border-radius: 2px; font-size: 11px;  display: none;width: 100%; font-weight: 600;"
                    id="pricedeactivatebtn<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    onclick="requestAllprice<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();opmodalpop('Price','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=2&id=<?php echo $resListing1['id']; ?>&fortTimeSlot=11&priceSend=1','600px','auto');"
                    data-toggle="modal" data-target="#modalpop">Action</div>

                <?php } ?>

                <input
                    name="priceCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    type="checkbox" class="priceCheckClass"
                    id="priceCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    style="height: 15px;width: 15px;margin-top: 0;text-align: center;" />

            </td>

            <td align="center" <?php if($_REQUEST['page']!='prototypesample') { ?> style="display:none;" <?php } ?>>
                <strong>Price</strong></td>

            <td align="center" <?php if($_REQUEST['page']!='prototypesample') { ?> style="display:none;" <?php } ?>>
                <?php if($_REQUEST['loginuserprofileId']!=92) { ?>

                <div class="btn-group justify-content-center"
                    style="cursor: pointer; float: left; padding: 1px; margin: 0px 0px 8px; border: 1px solid rgb(92, 107, 192); color: rgb(92, 107, 192); border-radius: 2px; font-size: 11px;  display: none;width: 100%; font-weight: 600;"
                    id="vendordeactivatebtn<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    onclick="requestAllvendor<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();opmodalpop('Vendor','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=3&id=<?php echo $resListing1['id']; ?>&vendorSend=1','600px','auto');"
                    data-toggle="modal" data-target="#modalpop">Action</div>

                <?php } if($_REQUEST['loginuserprofileId']==92) { ?>

                <div class="btn-group justify-content-center"
                    style="cursor: pointer; float: left; padding: 1px; margin: 0px 0px 8px; border: 1px solid rgb(92, 107, 192); color: rgb(92, 107, 192); border-radius: 2px; font-size: 11px;  display: none;width: 100%; font-weight: 600;"
                    id="vendordeactivatebtn<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    onclick="requestAllvendor<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();opmodalpop('Vendor','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=3&id=<?php echo $resListing1['id']; ?>&fortTimeSlot=11&vendorSend=1','600px','auto');"
                    data-toggle="modal" data-target="#modalpop">Action</div>

                <?php } ?>

                <input
                    name="vendorCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    type="checkbox" class="vendorCheckClass"
                    id="vendorCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    style="height: 15px;width: 15px;margin-top: 0;text-align: center;" />

            </td>

            <td align="center" <?php if($_REQUEST['page']!='prototypesample') { ?> style="display:none;" <?php } ?>>
                <strong>Vendor</strong></td>

            <td align="left"
                <?php if($_REQUEST['page']!='analysemateriallist' && ($_REQUEST['page']!='sampleanalysematerial' || $resListing['id']!=2)) { ?>
                style="display:none;" <?php } ?>><?php if($_REQUEST['page']=='sampleanalysematerial'){ ?>

                <strong>Size</strong>

                <?php } else { ?>

                <strong style="width:110px; display:block;">Qty/Pri/Ven

                    <?php if($resListing['id']==2){ ?>

                    /Size

                    <?php } ?>

                </strong>

                <?php } ?>
            </td>

        </tr>

        <?php

	if($_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='marker' || $_REQUEST['page']=='costsheet' || $_REQUEST['page']=='materiallist' || $_REQUEST['page']=='prototypesample'){
	$greigeId = ' and sr<100';
	}

									$N=0;

									$factoryoverheadtext=0;

									$c16text=0;



									$totalpc=0;

									$srtype=0;

									$where22='';

									$rs22='';

									$select22='*';



									if($_REQUEST['page']!='addbom'){

								// 	$where22=''.$wheresearchassign.'  materialType="'.$resListing['id'].'" and styleId="'.$_REQUEST['styleId'].'" and costsheetVersionId="'.$_REQUEST['costsheetVersionId'].'" '.$greigeId.' and parentId=0 order by id asc';
									$where22=''.$wheresearchassign.'  materialType="'.$resListing['id'].'" and styleId="'.$_REQUEST['styleId'].'" and costsheetVersionId="'.$_REQUEST['costsheetVersionId'].'"  and parentId=0 order by id asc';

									}

									else{

									$where22=''.$wheresearchassign.'  materialType="'.$resListing['id'].'" and styleId="'.$_REQUEST['styleId'].'" and costsheetVersionId="'.$_REQUEST['costsheetVersionId'].'" and id not in (select parentId from styleSubCategoryMaster) order by id asc';


								// 	$where22=''.$wheresearchassign.'  materialType="'.$resListing['id'].'" and styleId="'.$_REQUEST['styleId'].'" and costsheetVersionId="'.$_REQUEST['costsheetVersionId'].'" '.$greigeId.' and id not in (select parentId from styleSubCategoryMaster) order by id asc';



									}



									$rs22=GetPageRecord($select22,'styleSubCategoryMaster',$where22);

									$srtype = mysqli_num_rows($rs22);

									while($resListing1=mysqli_fetch_array($rs22)){



									$loopst=$srtype;

									$rowno++;

									$sNo1=$rowno;



								//$rs1215a=GetPageRecord('*','techPackDetailMaster',' bomSerialNo="'.$sNo1.'" and sectionType="bom" and styleId="'.$_REQUEST['styleId'].'" and costsheetVersionId="'.$_REQUEST['costsheetVersionId'].'" order by id asc');

								//echo 'stylesubtabid="'.$resListing1['id'].'" and sectionType="bom" and styleId="'.$_REQUEST['styleId'].'" and costsheetVersionId="'.$_REQUEST['costsheetVersionId'].'" order by id asc';

								$rs1215a=GetPageRecord('*','techPackDetailMaster','stylesubtabid="'.$resListing1['id'].'" and sectionType="bom" and styleId="'.$_REQUEST['styleId'].'" and costsheetVersionId="'.$_REQUEST['costsheetVersionId'].'" order by id asc');



								$resListing12=mysqli_fetch_array($rs1215a);



						        //$allfunction=$allfunction.'saveallbom'.$_REQUEST['costsheetVersionId'].'('.$sNo1.','.$_REQUEST['costsheetVersionId'].');';



						 $allfunction=$allfunction.'saveallbom'.$_REQUEST['costsheetVersionId'].'('.$resListing1['id'].','.$sNo1.','.$_REQUEST['costsheetVersionId'].');';



								?>

        <tr class="card-body"
            <?php if($_REQUEST['page']=='marker') { if($resListing['name']!='Fabric') { ?>style="display:none;"
            <?php }} ?>>

            <td <?php if($_REQUEST['page']=='marker' || $_REQUEST['page']=='materiallist' || $_REQUEST['page']=='costsheet' || $_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='addbom') {?>style="display:none;"
                <?php } ?>>
                <div style="width:55px; position:relative;"><i class="icon-add" style="font-size:18px;cursor:pointer;"
                        onClick="add_load_bom_list_fun<?php echo $_REQUEST['costsheetVersionId']; ?>('<?php echo $sNo1; ?>','<?php echo $resListing['id']; ?>','<?php echo $_REQUEST['costsheetVersionId']; ?>','<?php echo $resListing1['id']; ?>');"></i>
                    &nbsp;<?php if($srtype > 1){   ?> <i class="icon-trash"
                        style="font-size:18px;cursor:pointer; color:#FF0000;"
                        onClick="delete_load_bom_list_fun<?php echo $_REQUEST['costsheetVersionId']; ?>('<?php echo $resListing1['id']; ?>','<?php echo $resListing['id']; ?>','<?php echo $_REQUEST['costsheetVersionId']; ?>');"></i><?php } ?>

                    <!--ADD CHECK ALL DELETE OPTION-->

                    <label class="analyselistclass<?php echo $resListing['id']; ?>">

                        <input type="checkbox"
                            style="position: absolute; opacity: 1; cursor: pointer; height: 15px; width: 15px; top: 3px; right: -9px;"
                            value="<?php echo $resListing1['id']; ?>" name="analysemateriallistdelete[]"
                            class="deletematerial<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" />

                    </label>

                </div>
            </td>

            <?php if($_REQUEST['loginuserprofileId']!='154' && $_REQUEST['loginuserprofileId']!='155'){ ?>

            <td align="center" class="materialcostcheckubcheck"
                <?php if($_REQUEST['page']!='materiallist') {?>style="display:none;" <?php } ?>><input type="checkbox"
                    value="<?php echo $resListing1['id']; ?>" name="assigntopurchase[]"
                    class="Checkedinc<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    onclick="sendmaterialvalue<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();"
                    style="height: 17px; width: 30px; margin-top: 4px; text-align: center;" />

            </td>

            <?php } ?>

            <?php if($_REQUEST['loginuserprofileId']=='154'){ ?>

            <td align="center" class="materialcostcheckubcheckpurchasemerchant"
                <?php if($_REQUEST['page']!='materiallist') {?>style="display:none;" <?php } ?>><input type="checkbox"
                    value="<?php echo $resListing1['id']; ?>" name="assigntopurchasemerchant[]"
                    class="purchaseMerchantCheckedinc<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    onclick="sendmaterialvaluepurchasemerchant<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();"
                    style="height: 17px; width: 30px; margin-top: 4px; text-align: center;" />

            </td>

            <?php } ?>

            <input type="hidden" name="materialid<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                value="<?php echo $resListing1['id']; ?>" />

            <input type="hidden" name="subcategoryid<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                value="<?php echo $resListing123['id']; ?>" />

            <input type="hidden" name="bomSerialNo<?php echo $sNo1; ?>" value="<?php echo $sNo1; ?>" />

            <?php

	  $unq=GetPageRecord('materialUniqueId,materialimage,finishId,id','materialMaster','1 and name="'.$resListing1['name'].'"');

	  $uniData=mysqli_fetch_array($unq);

	  ?>

            <td <?php if($_REQUEST['page']!='marker' && $_REQUEST['page']!='analysemateriallist'){ ?>
                style="width:65px;" <?php } ?>>
                <div style="width: 65px;"> <?php echo $uniData['materialUniqueId']; ?></div>
            </td>

            <td <?php if($_REQUEST['page']!='marker' && $_REQUEST['page']!='analysemateriallist'){ ?>
                style="width:140px;" <?php } ?>>
                <div style="width: 160px;">

                    <?php if($resListing1['name']!='') { ?>

                    <?php echo $resListing1['name']; if($resListing1['sizeName']!=""){ ?> for style size <span
                        style="color: #ff0000; margin-left: 0px; font-weight: 600; font-size: 18px;"><?php echo $resListing1['sizeName']; ?></span>

                    <?php } } else { ?>

                    <script>
                    function update_load_bom_list_fun<?php echo $resListing1['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>(
                        materialtype, costsheetVersionId) {

                        var newmaterial = $('#newmaterial<?php echo $resListing1['id']; ?>').val();

                        $('#load_bom_list<?php echo $_REQUEST['costsheetVersionId']; ?>').load(
                            "load_bom_list.php?styleId=<?php echo $_REQUEST['styleId'];?>&page=<?php echo $_REQUEST['page']; ?>&subCategoryId=<?php echo $_REQUEST['subCategoryId'];?>&updateid=<?php echo $resListing1['id']; ?>&newmaterial=" +
                            newmaterial + '&materialtype=' + materialtype + '&costsheetVersionId=' +
                            costsheetVersionId);

                    }
                    </script>

                    <select name="newmaterial<?php echo $resListing1['id']; ?>"
                        id="newmaterial<?php echo $resListing1['id']; ?>"
                        onchange="update_load_bom_list_fun<?php echo $resListing1['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>('<?php echo $resListing['id']; ?>','<?php echo $_REQUEST['costsheetVersionId']; ?>');"
                        style="width: 100%;padding: 5px;">

                        <option value="">Select</option>

                        <?php

$a=GetPageRecord('*','materialMaster','materialtype="'.$resListing1['materialType'].'" order by id asc');

while($materiallist=mysqli_fetch_array($a)){

$rsdescold=GetPageRecord('*','materialDescriptionMaster','materialid="'.$materiallist['id'].'"');

$resListingdescriptionold=mysqli_fetch_array($rsdescold);

 ?>

                        <option value="<?php echo $materiallist['id'];?>"><?php echo $materiallist['name'];?> <span
                                style="font-weight:700 !important;">(<?php echo $resListingdescriptionold['shortDescription'];?>)</span>
                        </option>

                        <?php } ?>

                    </select>

                    <?php  }  ?>

                </div>

                <script>
                $(document).ready(function() {

                    $('#newmaterial<?php echo $resListing1['id']; ?>').select2();

                });
                </script>
            </td>

            <td <?php if($_REQUEST['page']!='marker' && $_REQUEST['page']!='analysemateriallist'){ ?>
                style="width:200px;;" <?php } ?>>
                <div style="width: 150px; overflow: hidden; position: relative;">

                    <?php

			$rsdesc=GetPageRecord('*','materialDescriptionMaster','materialid="'.$uniData['id'].'"');

			$resListingdescription=mysqli_fetch_array($rsdesc);

			echo stripslashes($resListingdescription['shortDescription']);

			?>

                </div>
            </td>
            <td style="width:65px;">
                <div style="width: 65px;"><?php echo getGsmName($uniData['id']); ?></div>
            </td>
            <td <?php if($_REQUEST['page']=='sampleanalysematerial' || $_REQUEST['page']=='samplingbom' || $_REQUEST['page']=='materiallist'){ ?>
                style="display:none;" <?php } ?>>
                <div style="width: 150px; overflow: hidden; position: relative;">

                    <select name="finish<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="finish<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        style="width: 100%;text-align: center;padding: 5px;display:none;">

                        <option value="">Select</option>

                        <?php

$fquery=GetPageRecord('*','finishMaster','1 and status=1 order by name');

while($finishData=mysqli_fetch_array($fquery)){ ?>

                        <option value="<?php echo $finishData['id']; ?>"
                            <?php if($finishData['id']==$resListing12['finish']){ ?> selected="selected" <?php } ?>>
                            <?php echo $finishData['name']; ?></option>

                        <?php } ?>

                    </select>

                    <?php





$finishquery=GetPageRecord('*','finishMaster','id="'.$uniData['finishId'].'"');

$finishDataname=mysqli_fetch_array($finishquery);

echo $finishDataname['name'];

?>

                    <script>
                    $(document).ready(function() {

                        $('#finish<?php echo $resListing1['id']; ?>').select2();

                    });
                    </script>

                </div>
            </td>

            <td align="center"
                <?php if($_REQUEST['page']=='materiallist' || $_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='costsheet'){ ?>
                style="display:none;" <?php } ?>>
                 <input
                    name="bomWidth<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    onkeyup="value_on_pc<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();calTotalCost<?php echo $resListing['id'].$sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();"
                    type="text" id="bomWidth<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    value="<?php echo $resListing12['bomWidth']; ?>" autocomplete="off" maxlength="200"
                    style="width: 80px;text-align: center;"
                    placeholder="<?php if($resListing['name']=='Fabric') { ?>Width<?php }else{ ?>Size<?php } ?>" />
                </td>

            <td align="center"
                <?php if($_REQUEST['page']=='materiallist' || $_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='costsheet'){ ?>
                style="display:none;" <?php } ?>>
                <select name="bomWidthUnit<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    id="bomWidthUnit<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    value="<?php echo $resListing12['bomWidthUnit']; ?>"
                    style="width: fit-content;text-align: center;padding:5px;">

                    <?php
                    $rswidthunit=GetPageRecord('*','unitMaster','materialtype="'.$resListing['id'].'" order by name asc');

                    while($resListingwidthunit=mysqli_fetch_array($rswidthunit)){

                    ?>

                    <option value="<?php echo $resListingwidthunit['name']; ?>"
                        <?php if($resListingwidthunit['name']==$resListing12['bomWidthUnit']){ ?> selected <?php } ?>>
                        <?php echo $resListingwidthunit['name']; ?></option>

                    <?php } ?>

                </select>
                </td>

            <td align="center" <?php if($_REQUEST['page']=='prototypesample'){ ?> style="display:none;" <?php } ?>>
                <input name="bomAvg<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    onkeyup="value_on_pc<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();calTotalCost<?php echo $resListing['id'].$sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();"
                    type="text" id="bomAvg<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    value="<?php echo $resListing12['bomAvg']; ?>" autocomplete="off" maxlength="200"
                    style="width: 80px;text-align: center;" placeholder="Avg/Qty" />

            </td>

            <td align="center" <?php if($_REQUEST['page']=='prototypesample'){ ?> style="display:none;" <?php } ?>>
                <select name="bomUnit<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    id="bomUnit<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    value="<?php echo $resListing12['bomUnit']; ?>"
                    style="width: fit-content;text-align: center;padding:5px;">

                    <?php

$selectunit='*';

$whereunit='materialtype="'.$resListing['id'].'" order by name asc';

$rsunit=GetPageRecord($selectunit,'unitMaster',$whereunit);

while($resListingunit=mysqli_fetch_array($rsunit)){

?>

                    <option value="<?php echo $resListingunit['name']; ?>"
                        <?php if($resListingunit['name']==$resListing12['bomUnit']){ ?> selected <?php } ?>>
                        <?php echo $resListingunit['name']; ?></option>

                    <?php } ?>

                </select>

            </td>

            <td align="center"
                <?php if($_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='marker' || $_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='sampleanalysematerial'){ ?>
                style="display:none;" <?php } ?>><input type="text"
                    name="wastagePersent<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    style="width: 80px;text-align: center;" placeholder="Wastage %"
                    id="wastagePersent<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    value="<?php echo $resListing12['wastagePersent']; ?>" autocomplete="off" maxlength="200"
                    onkeyup="value_on_pc<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();calTotalCost<?php echo $resListing['id'].$sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();" />
            </td>

            <td align="center"
                <?php if($_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='marker' || $_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='sampleanalysematerial'){ ?>
                style="display:none;" <?php } ?>><input type="text"
                    name="avgIncWastage<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    style="width: 80px;text-align: center;" placeholder="Avg wstg"
                    id="avgIncWastage<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    value="<?php echo $resListing12['avgIncWastage']; ?>" autocomplete="off" maxlength="200"
                    onkeyup="value_on_pc<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();calTotalCost<?php echo $resListing['id'].$sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();" />
            </td>

            <td align="center"
                <?php if($_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='marker' || $_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='sampleanalysematerial'){ ?>
                style="display:none;" <?php } ?>><input type="text"
                    name="matPrice<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    style="width: 80px;text-align: center;" placeholder="Price"
                    id="matPrice<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    value="<?php echo $resListing12['matPrice']; ?>" autocomplete="off" maxlength="200"
                    onkeyup="escape_landing_cost<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();value_on_pc<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();calTotalCost<?php echo $resListing['id'].$sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();" />
            </td>

            <td align="center"
                <?php if($_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='marker' || $_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='sampleanalysematerial'){ ?>
                style="display:none;" <?php } ?>><select
                    name="matCurrency<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    id="matCurrency<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    style="width: fit-content; text-align: center; padding: 5px;"
                    onchange="change_currency<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>(this.value);">

                    <option value="">Select</option>

                    <?php

$cq=GetPageRecord('*','currencyMaster','1 order by id  ');

while($currData=mysqli_fetch_array($cq)){

?>

                    <option value="<?php echo $currData['id']; ?>"
                        <?php if($resListing12['matCurrency']!="" && $resListing12['matCurrency']!=0){ if($currData['id']==$resListing12['matCurrency']){ ?>
                        selected <?php } } ?>
                        <?php if($resListing12['matCurrency']=="" || $resListing12['matCurrency']==0){ if($buyerData['buyerCurrency']==$currData['id']){ ?>
                        selected="selected" <?php } } ?>>

                        <?php echo $currData['name']; ?>

                    </option>

                    <?php } ?>

                </select>

            </td>

            <td align="center" style="display:none;"><input
                    name="bomINR<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="text"
                    id="bomINR<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    onkeyup="escape_landing_cost<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();value_on_pc<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();calTotalCost<?php echo $resListing['id'].$sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();"
                    value="<?php echo $resListing12['bomINR']; ?>" autocomplete="off" maxlength="200"
                    style="width: 80px;text-align: center;" placeholder="INR" /></td>

            <td align="center" style="display:none;"><input
                    name="bomUSD<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="text"
                    id="bomUSD<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    onkeyup="convert_inr<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();value_of_rate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();value_on_pc<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();calTotalCost<?php echo $resListing['id'].$sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();"
                    value="<?php echo $resListing12['bomUSD']; ?>" autocomplete="off" maxlength="200"
                    style="width: 60px;text-align: center;" placeholder="USD" /></td>

            <td align="center"
                <?php if($_REQUEST['page']=='marker' || $_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='sampleanalysematerial' || $_REQUEST['page']=='samplingbom'){ ?>
                style="display:none;" <?php } ?>><input
                    name="landingcostper<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="text"
                    id="landingcostper<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    onkeyup="escape_landing_cost<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();value_of_rate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();value_on_pc<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();calTotalCost<?php echo $resListing['id'].$sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();"
                    value="<?php if($resListing12['landingcostper']==''){ echo 0; } else{ echo $resListing12['landingcostper']; } ?>"
                    autocomplete="off" maxlength="200" style="width: 80px;text-align: center;"
                    placeholder="Land. Cst." /></td>

            <td align="center"
                <?php if($_REQUEST['page']=='marker' || $_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='sampleanalysematerial' || $_REQUEST['page']=='samplingbom'){ ?>
                style="display:none;" <?php } ?>><input
                    name="bomRate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="text"
                    id="bomRate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    value="<?php echo $resListing12['bomRate']; ?>" autocomplete="off" maxlength="200"
                    style="width: 80px;text-align: center;" placeholder="Lan. Cost" /></td>

            <td align="center"
                <?php if($_REQUEST['page']=='marker' || $_REQUEST['page']=='analysemateriallist' || $_REQUEST['page']=='prototypesample' || $_REQUEST['page']=='sampleanalysematerial'){ ?>
                style="display:none;" <?php } ?>><input
                    name="bomvalueonepc<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="text"
                    id="bomvalueonepc<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    value="<?php echo $resListing12['bomvalueonepc']; $totalpc=$totalpc+$resListing12['bomvalueonepc']; ?>"
                    autocomplete="off" maxlength="200"
                    class="price<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    style="width: 80px;text-align: center;" placeholder="Mat. Cost" /></td>

            <td id="loadcurrencyvalue<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                style="display:none;"></td>

            <script>
            function change_currency<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>(id) {

                $('#loadcurrencyvalue<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').load(
                    "loadcurrencyvalue.php?id=" + id +
                    "&lastId=<?php echo $resListing12['matCurrency']; ?>&sNo1=<?php echo $sNo1; ?>&costsheetVersionId=<?php echo $_REQUEST['costsheetVersionId']; ?>&totalvarcount=<?php echo $totalvarcount; ?>"
                    );



            }



            function convert_inr<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>() {

                //var usdvalue = $('#bomUSD<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val();

                //var usdvalue = Number(usdvalue*71);

                //usdvalue= parseFloat(usdvalue).toFixed(4);

                //$('#bomINR<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val(usdvalue);

            }



            function value_of_rate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>() {

                //var inrvalue = $('#bomINR<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val();

                //var lancost =  $('#landingcostper<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val();

                //var lanper = Number(inrvalue*lancost/100);

                //var lanrate =Number(inrvalue)+lanper;

                //totalinrandlandcost= parseFloat(lanrate).toFixed(4);

                //$('#bomRate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val(totalinrandlandcost);

            }



            function value_on_pc<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>() {



                var bomAvg = Number($('#bomAvg<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>')
                .val());



                var bomRate = Number($('#bomRate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>')
                    .val());





                var wastagePersent = Number($(
                    '#wastagePersent<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val());



                var avgIncWastage = Number(bomAvg * wastagePersent / 100);



                avgIncWastage = Number(bomAvg + avgIncWastage);

                avgIncWastage = parseFloat(avgIncWastage).toFixed(4);



                Number($('#avgIncWastage<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val(
                    avgIncWastage));



                var wastagePersentfinal = avgIncWastage;



                //new code

                var bomvalueonepc = Number(bomRate * wastagePersentfinal);





                bomvalueonepc = parseFloat(bomvalueonepc).toFixed(4);

                $('#bomvalueonepc<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val(
                bomvalueonepc);

            }





            function calTotalCost<?php echo $totalvarcount.$sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>() {

                var sum = 0;

                // we use jQuery each() to loop through all the textbox with 'price' class

                // and compute the sum for each loop

                $('.price<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').each(
                function() {

                    sum += Number($(this).val());

                });



                sum = parseFloat(sum).toFixed(4);



                // set the computed value to 'totalPrice' textbox

                $('#totalPrice<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val(sum);



                document.getElementById(
                        "totalPrice<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>")
                    .innerHTML = sum;



                abc_totalgrand_first<?php echo $_REQUEST['costsheetVersionId']; ?>();

                abc_totalgrand_second<?php echo $_REQUEST['costsheetVersionId']; ?>();

                count_grand_total<?php echo $_REQUEST['costsheetVersionId']; ?>();

                calculate_factory_overhead<?php echo $_REQUEST['costsheetVersionId']; ?>();

            }



            function escape_landing_cost<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>() {



                //var usdvalue=0;

                //var inrvalue = $('#bomINR<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val();

                var lanper = 0;

                var matpricevalue = 0;

                var totalinrandlandcost = 0;

                var matpricevalue = $('#matPrice<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>')
                    .val();



                var inrvalue = $('#bomINR<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val();

                var lancost = $('#landingcostper<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>')
                    .val();



                if (lancost == 0 || lancost == "") {

                    lanper = 0;

                } else {

                    lanper = Number(matpricevalue * lancost / 100);

                }



                var lanrate = Number(matpricevalue) + lanper;

                totalinrandlandcost = parseFloat(lanrate).toFixed(4);



                $('#bomRate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val(
                totalinrandlandcost);

            }
            </script>

            <td align="center" <?php if($_REQUEST['page']!='addbom' && $_REQUEST['page']!='analysemateriallist'){ ?>
                style="display:none;" <?php } ?>><span style="width:170px;">

                    <select name="bomPlacement<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="bomPlacement<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        style="width: fit-content; text-align: center; padding: 5px;">

                        <option value="">Select</option>

                        <?php

$comQ=GetPageRecord('name','componentLocation','1 order by id');

while($compLocaData=mysqli_fetch_array($comQ)){ ?>

                        <option value="<?php echo $compLocaData['name']; ?>"
                            <?php if($compLocaData['name']==$resListing12['bomPlacement']){ ?> selected="selected"
                            <?php } ?>><?php echo $compLocaData['name']; ?></option>

                        <?php } ?>

                    </select>

                </span> </td>

            <?php

$kNo=1;

$colorq=GetPageRecord('colorId','styleColorDetailMaster','1 and styleId="'.$_REQUEST['styleId'].'" order by id asc');

while($styleData=mysqli_fetch_array($colorq)){



?>

            <td align="center" <?php if($_REQUEST['page']!='addbom' && $_REQUEST['page']!='samplingbom'){ ?>
                style="display:none;" <?php } ?>><span style="width:125px;">

                    <input name="trimColor<?php echo $kNo.$sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        type="text"
                        id="trimColor<?php echo $kNo.$sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        value="<?php echo $resListing12['trimColor'.$kNo]; ?>" autocomplete="off" maxlength="200"
                        placeholder=" Color" style="text-align:center;" />

                </span> </td>

            <?php $kNo++; } ?>
            <?php if(($_REQUEST['page']=='sampleanalysematerial' || $_REQUEST['page']=='analysemateriallist') && $resListing['id']==1) { ?>
            <td align="center"><span style="width:125px;">

                    <input name="qualityapproveddate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        type="text"
                        id="qualityapproveddate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        <?php if($resListing12['qualityapproveddate']!="" && $resListing12['qualityapproveddate']!="0000-00-00" && $resListing12['qualityapproveddate']!="1970-01-01"){ ?>
                        value="<?php echo date('d-m-Y',strtotime($resListing12['qualityapproveddate'])); ?>" <?php } ?>
                        autocomplete="off" class="newDatePicker" maxlength="200" placeholder="Quality approved"
                        style="text-align:center;" />

                </span> </td>
              <?php } ?>


            <td align="center"
                <?php if($_REQUEST['page']=='marker' || $_REQUEST['page']=='sampleanalysematerial' || $_REQUEST['page']=='samplingbom '){ ?>
                style="display:none;" <?php } ?>><input
                    name="bomComment<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="text"
                    id="bomComment<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    value="<?php echo $resListing12['bomComment']; ?>" autocomplete="off" maxlength="200"
                    style="width:200px; text-align:center;"></td>

            <td align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;" <?php } ?>>
                <a href="#"
                    onclick="opmodalpop('Amendment Style# <?php echo getStyleRefId($_REQUEST['styleId']); ?>','newpop.php?action=amendaction&styleId=<?php echo encode($_REQUEST['styleId']); ?>&stylesubtabid=<?php echo $resListing1['id']; ?>&costsheetVersionId=<?php echo $_REQUEST['costsheetVersionId']; ?>&bomAvg=<?php echo $resListing12['bomAvg']; ?>&bomWidth=<?php echo $resListing12['bomWidth']; ?>&bomUnit=<?php echo $resListing12['bomUnit']; ?>&wastagePersent=<?php echo $resListing12['wastagePersent']; ?>&avgIncWastage=<?php echo $resListing12['avgIncWastage']; ?>&matCurrency=<?php echo $resListing12['matCurrency']; ?>&matPrice=<?php echo $resListing12['matPrice']; ?>&materialType=<?php echo $resListing['id']; ?>','700px','auto');"
                    data-toggle="modal" data-target="#modalpop">Amend</a>
            </td>

            <td align="center"
                <?php if($_REQUEST['page']=='marker' || $_REQUEST['page']=='sampleanalysematerial' || $_REQUEST['page']=='samplingbom') { ?>
                style="display:none;" <?php } ?>><?php

											$select123='*';

											$where123='styleId="'.$_REQUEST['styleId'].'" and commnetType=0 and materialId="'.$resListing1['id'].'"';

											$rs123=GetPageRecord($select123,'materialCostChatMaster',$where123);

											$chatcount1=mysqli_num_rows($rs123);

											?>

                <div class="mr-2"> <a
                        onclick="opmodalpop('Comments','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=0&id=<?php echo $resListing1['id']; ?>','600px','auto');"
                        data-toggle="modal" data-target="#modalpop"
                        class="btn bg-transparent border-indigo-400 text-indigo-400 rounded-round border-2 btn-icon"
                        style="padding:8px;"> <i class="icon-comment" style="color: #5c6bc0;"></i>

                        <div class="add-cart-value"
                            style="position: absolute; top: -6px; border-radius: 50%; border: 1px solid #7985cb; background: #7985cb; right: -7px; width: 17px; height: 17px;">
                            <span style="color: #fff;font-size: 11px;"
                                name="messagevalcount<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                                id="messagevalcount<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"><?php echo $chatcount1; ?></span>
                        </div>

                    </a> </div>
            </td>

            <?php if($_REQUEST['page']=='sampleanalysematerial') { ?> <td align="center" style="">
                <input name="artworkno<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="text"
                    id="artworkno<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    value="<?php echo $resListing12['artworkno']; ?>" autocomplete="off" class="" maxlength="200"
                    placeholder="Artwork No." style="text-align:center;" />

                </span>

            </td><?php } ?>
            <?php if(($_REQUEST['page']=='sampleanalysematerial' || $_REQUEST['page']=='analysemateriallist') && $resListing['id']==1) { ?><td
                align="center">
                <input name="cadgivendate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="text"
                    id="cadgivendate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    <?php if($resListing12['cadgivendate']!="" && $resListing12['cadgivendate']!="0000-00-00" && $resListing12['cadgivendate']!="1970-01-01"){ ?>
                    value="<?php echo date('d-m-Y',strtotime($resListing12['cadgivendate'])); ?>" <?php } ?>
                    autocomplete="off" class="newDatePicker" maxlength="200" placeholder="CAD Given Date"
                    style="text-align:center;" />

                </span>

            </td><?php } ?>
            <?php if(($_REQUEST['page']=='sampleanalysematerial' || $_REQUEST['page']=='analysemateriallist') && $resListing['id']==1) { ?> <td
                align="center">
                <input name="labdipdate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="text"
                    id="labdipdate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    <?php if($resListing12['labdipdate']!="" && $resListing12['labdipdate']!="0000-00-00" && $resListing12['labdipdate']!="1970-01-01"){ ?>
                    value="<?php echo date('d-m-Y',strtotime($resListing12['labdipdate'])); ?>" <?php } ?>
                    autocomplete="off" class="newDatePicker" maxlength="200" placeholder="Lab Dip/Strike"
                    style="text-align:center;" />

                </span>

            </td><?php } ?>

            <?php if(($_REQUEST['page']=='sampleanalysematerial' || $_REQUEST['page']=='analysemateriallist') && $resListing['id']==1) { ?><td
                align="center">
                <input name="labdiproundtwo<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    type="text" id="labdiproundtwo<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    <?php if($resListing12['labdiproundtwo']!="" && $resListing12['labdiproundtwo']!="0000-00-00" && $resListing12['labdiproundtwo']!="1970-01-01"){ ?>
                    value="<?php echo date('d-m-Y',strtotime($resListing12['labdiproundtwo'])); ?>" <?php } ?>
                    autocomplete="off" class="newDatePicker" maxlength="200" placeholder="Lab Dip/Strike"
                    style="text-align:center;" />

                </span>

            </td><?php } ?>

            <td align="center" class="bomhideshowsecond"
                style=" position:relative; cursor:pointer; <?php if($_REQUEST['page']!='addbom'){ ?> display:none; <?php } ?>">
            </td>

            <td class="bomhideshow" align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;"
                <?php } ?>><input
                    name="supplierartname<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="text"
                    id="supplierartname<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    value="<?php echo $resListing12['supplierartname']; ?>" autocomplete="off" maxlength="200"
                    placeholder="Supplier art" style="width: 130px;text-align:center;" />

            </td>

            <td class="" align="center"><select
                    id="storesupplier<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    name="storesupplier<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    style="width: fit-content;text-align: center;padding:5px;">

                    <option>Select</option>

                    <?php

	$rssupplier=GetPageRecord('*','suppliersMaster','1 and deletestatus=0 order by name asc');

	while($rssupplierList=mysqli_fetch_array($rssupplier)){

	?>

                    <option value="<?php echo $rssupplierList['id']; ?>"
                        <?php if($rssupplierList['id']==$resListing12['storesupplier']){ ?> selected <?php } ?>>
                        <?php echo $rssupplierList['name']; ?></option>

                    <?php } ?>

                </select>

            </td>

            <td class="bomhideshow" align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;"
                <?php } ?>><select
                    name="buyerNominated<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    id="buyerNominated<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    style="width: 70px; padding: 4px 4px 3px;;">

                    <option value="1" <?php if($resListing12['buyerNominated']==1){ ?> selected="selected" <?php } ?>>
                        Yes</option>

                    <option value="2" <?php if($resListing12['buyerNominated']==2){ ?> selected="selected" <?php } ?>>No
                    </option>

                </select></td>

            <td class="bomhideshow" align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;"
                <?php } ?>>
                <div style="width: 50px; height: 50px; overflow: hidden;"> <img style="width:100%; height:100%;"
                        src="<?php echo $fullurl; ?>images/<?php if($uniData['materialimage']!=""){ echo $uniData['materialimage']; } else{ ?>image-not-found.png<?php } ?>">
                </div>
            </td>

            <?php

//==================LEAD TIME AND TRANSIT TIME

$ltq=GetPageRecord('*','suppliersMaster','1 and id="'.$resListing12['storesupplier'].'"');

$leadTData=mysqli_fetch_array($ltq);

//===================

?>

            <?php

$ssssquery=GetPageRecord('id,tnaTemplateId,orderQty','queryMaster','id="'.$_REQUEST['styleId'].'"');

$styleDataaaa=mysqli_fetch_array($ssssquery);







$ocdq=GetPageRecord('*','timeActionReport','1 and styleId="'.$styleDataaaa['id'].'" and temid="'.$styleDataaaa['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name="ORDER CONFIRM DATE")');

$ocdData=mysqli_fetch_array($ocdq);



$pcdq=GetPageRecord('*','timeActionReport','1 and styleId="'.$styleDataaaa['id'].'" and temid="'.$styleDataaaa['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name="PRODUCTION COMPLETION")');

$pcdData=mysqli_fetch_array($pcdq);





$inhouseduedate= date('d-m-Y', strtotime($pcdData['complitionDate']. ''.-$leadTData['leadTime'].' days'));

$materialdispatchdate= date('d-m-Y', strtotime($inhouseduedate. ''.-$leadTData['transitTime'].' days'));

$finalforapproval= date('d-m-Y', strtotime($inhouseduedate. ''.-$leadTData['leadTime'].' days'));

$materialbookingfinal=date('d-m-Y', strtotime($pcdData['complitionDate']. '+2 days'));

$finalstandardhandover=date('d-m-Y', strtotime($finalforapproval. '-14 days'));



?>

            <td class="bomhideshow" align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;"
                <?php } ?>><?php echo $finalstandardhandover; ?></td>

            <td class="bomhideshow" align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;"
                <?php } ?>><?php echo $materialbookingfinal; ?></td>

            <td class="bomhideshow" align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;"
                <?php } ?>><?php echo $finalforapproval; ?></td>

            <td class="bomhideshow" align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;"
                <?php } ?>><?php echo $leadTData['leadTime']; ?></td>

            <td class="bomhideshow" align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;"
                <?php } ?>><?php echo $leadTData['transitTime']; ?></td>

            <td class="bomhideshow" align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;"
                <?php } ?>><?php echo $materialdispatchdate; ?></td>

            <td class="bomhideshow" align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;"
                <?php } ?>><?php echo $inhouseduedate; ?></td>

            <td class="bomhideshow" align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;"
                <?php } ?>></td>

            <td class="bomhideshow" align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;"
                <?php } ?>><?php echo $styleDataaaa['orderQty']*$resListing12['avgIncWastage']; ?></td>

            <td class="bomhideshow" align="center" <?php if($_REQUEST['page']!='addbom'){ ?> style="display:none;"
                <?php } ?>>0</td>

            <td align="center" style="display:none;"><strong>-</strong></td>

            <td align="center" <?php if($_REQUEST['page']!='costsheet'){ ?> style="display:none;" <?php } ?>><select
                    name="addToCost<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    id="addToCost<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    style="width: 70px; padding: 4px 4px 3px;;">

                    <option value="1" <?php if($resListing12['addToCost']==1){ ?> selected="selected" <?php } ?>>Yes
                    </option>

                    <option value="2" <?php if($resListing12['addToCost']==2){ ?> selected="selected" <?php } ?>>No
                    </option>

                </select></td>

            <td align="center" style="display:none;">
                <div style="width:170px;">

                    <input name="bomQuality<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        type="text" id="bomQty<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        value="<?php echo $resListing12['bomQuality']; ?>" autocomplete="off" maxlength="200"
                        placeholder="Quality" style="text-align:center;" />

                </div>
            </td>

            <td align="center" style="display:none;"><input
                    name="bomColorFirst<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="text"
                    id="bomColorFirst<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    value="<?php echo $resListing12['bomColorFirst']; ?>" autocomplete="off" maxlength="200"
                    style="width:70px;text-align:center;" placeholder="Color/Size" />

            </td>

            <td align="center" style="display:none;"><input
                    name="bomStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" type="text"
                    id="bomStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    value="<?php echo $resListing12['bomStatus']; ?>" autocomplete="off" maxlength="200"
                    placeholder="Status" style="text-align:center;" />

                <input name="cid<?php echo $sNo1; ?>" type="hidden" id="cid<?php echo $sNo1; ?>"
                    value="<?php echo $resListing1['id']; ?>">

            </td>

            <?php if($_REQUEST['loginuserprofileId']!='154' && $_REQUEST['loginuserprofileId']!='155'){ ?>

            <td <?php if($_REQUEST['page']!='materiallist'){ ?> style="display:none;" <?php } ?>>
                <div style="width:fit-content;">

                    <?php



											$array =  explode(',', $resListing1['assignTo']);

											foreach ($array as $item) {



											$select121='*';

											$id121=$item;

											$where121='id="'.$id121.'"';

											$rs121=GetPageRecord($select121,'userMaster',$where121);

											$assigntouser=mysqli_fetch_array($rs121);

											?>

                    <?php if($id121!='') { ?>

                    <span class="badge bg-success"
                        style="margin-bottom:5px;"><?php echo $assigntouser['firstName'].' '.$assigntouser['lastName']; ?></span>

                    <?php } ?>

                    <?php

											}

											?>

                </div>
            </td>

            <?php } ?>

            <?php if($_REQUEST['loginuserprofileId']=='154' ){ ?>

            <td <?php if($_REQUEST['page']!='materiallist'){ ?> style="display:none;" <?php } ?>>
                <div style="width:fit-content;">

                    <?php



											$array =  explode(',', $resListing1['assignToPurMerchant']);

											foreach ($array as $item) {



											$select121='*';

											$id121=$item;

											$where121='id="'.$id121.'"';

											$rs121=GetPageRecord($select121,'userMaster',$where121);

											$assigntouser=mysqli_fetch_array($rs121);

											?>

                    <?php if($id121!='') { ?>

                    <span class="badge bg-success"
                        style="margin-bottom:5px;"><?php echo $assigntouser['firstName'].' '.$assigntouser['lastName']; ?></span>

                    <?php } ?>

                    <?php

											}

											?>

                </div>
            </td>

            <?php } ?>

            <!--PROTYPE sample-->

            <td align="center" <?php if($_REQUEST['page']!='prototypesample') { ?> style="display:none;" <?php } ?>><?php

$selecty='*';

$wherey='styleId="'.$_REQUEST['styleId'].'" and commnetType=1 and materialId="'.$resListing1['id'].'" order by id desc limit 1';

$rsy=GetPageRecord($selecty,'materialCostChatMaster',$wherey);

$statusresult=mysqli_fetch_array($rsy);

$countqty=mysqli_num_rows($rsy);

?>

                <?php if($_REQUEST['loginuserprofileId']==92 && $resListing1['qtyStatus']=='1' && $countqty=='0') { echo '-'; } else{ ?>

                <?php if($resListing1['qtyStatus']=='1' && $statusresult['approvedStatus']!='1') { ?>

                <label class="qualityblockclass<?php echo $resListing['id']; ?>" style="position:relative;">

                    <input type="checkbox"
                        style="position: relative;opacity: 1;cursor: pointer;height: 15px;width: 15px;margin-top: 0;"
                        value="<?php echo $resListing1['id']; ?>" name="qualityCheckAllBox[]"
                        class="QualityyCheckClass<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" />

                </label>

                <?php } } ?>
            </td>

            <td align="center" <?php if($_REQUEST['page']!='prototypesample') { ?> style="display:none;" <?php } ?>>
                <?php if($resListing1['qtyStatus']=='1' && $countqty=='0' || $statusresult['approvedStatus']=='5'){ ?>

                <a id="qtyStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    <?php if($_REQUEST['loginuserprofileId']!=92) { ?>
                    onclick="opmodalpop('Quality','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=1&id=<?php echo $resListing1['id']; ?>','600px','auto');"
                    data-toggle="modal" data-target="#modalpop" <?php } ?>
                    class="btn bg-warning-400 ml-md-3 mt-3 mt-md-0"
                    style="margin: 0px !important;padding: 3px 10px;background: #5c6bc0;">Pending</a>

                <?php } else if($resListing1['qtyStatus']=='1' && $statusresult['approvedStatus']=='1') { ?>

                <?php /*?><a id="qtyStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    onclick="opmodalpop('Quality','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=1&id=<?php echo $resListing1['id']; ?>','600px','auto');"
                    data-toggle="modal" data-target="#modalpop" class="btn bg-success-400 ml-md-3 mt-3 mt-md-0"
                    style="margin: 0px !important;padding: 3px 10px;">Approved</a><?php */?>

                <a id="qtyStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    class="btn bg-success-400 ml-md-3 mt-3 mt-md-0"
                    style="margin: 0px !important;padding: 3px 10px;">Approved</a>

                <?php } else if($resListing1['qtyStatus']=='1' && $statusresult['approvedStatus']=='2') { ?>

                <a id="qtyStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    onclick="opmodalpop('Quality','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=1&id=<?php echo $resListing1['id']; ?>','600px','auto');"
                    data-toggle="modal" data-target="#modalpop" class="btn bg-info-400 ml-md-3 mt-3 mt-md-0"
                    style="margin: 0px !important;padding: 3px 10px;">Assigned</a>

                <?php } else if($resListing1['qtyStatus']=='1' && $statusresult['approvedStatus']=='4') { ?>

                <a id="qtyStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    onclick="opmodalpop('Quality','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=1&id=<?php echo $resListing1['id']; ?>','600px','auto');"
                    data-toggle="modal" data-target="#modalpop" class="btn bg-info-400 ml-md-3 mt-3 mt-md-0"
                    style="margin: 0px !important;padding: 3px 10px;background:#ff0000;">Rejected</a>

                <?php } else if($resListing1['qtyStatus']=='1' && $statusresult['approvedStatus']=='3') { ?>

                <?php if($_SESSION['userid']==$statusresult['assigedTo']){ ?>

                <a id="qtyStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    onclick="opmodalpop('Quality','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=1&id=<?php echo $resListing1['id']; ?>&fortTimeSlot=11','600px','auto');"
                    data-toggle="modal" data-target="#modalpop" class="btn bg-info-400 ml-md-3 mt-3 mt-md-0"
                    style="margin: 0px !important;padding: 3px 10px;background: #ff4a03;">Waiting For Approvel</a>

                <?php } else {  ?>

                <a id="qtyStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    onclick="opmodalpop('Quality','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=1&id=<?php echo $resListing1['id']; ?>','600px','auto');"
                    data-toggle="modal" data-target="#modalpop" class="btn bg-info-400 ml-md-3 mt-3 mt-md-0"
                    style="margin: 0px !important;padding: 3px 10px;background: #ffc803;">Pending For Approvel</a>

                <?php } ?>

                <?php } else { ?>

                <a id="qtyStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    class="btn bg-grey-400 ml-md-3 mt-3 mt-md-0"
                    style="margin: 0px !important;padding: 3px 10px;cursor: auto;">Not Required</a>

                <?php } ?>
            </td>

            <td align="center" <?php if($_REQUEST['page']!='prototypesample') { ?> style="display:none;" <?php } ?>><?php

$selecty1='*';

$wherey1='styleId="'.$_REQUEST['styleId'].'" and commnetType=2 and materialId="'.$resListing1['id'].'" order by id desc limit 1';

$rsy1=GetPageRecord($selecty1,'materialCostChatMaster',$wherey1);

$statusresult1=mysqli_fetch_array($rsy1);

$countqty1=mysqli_num_rows($rsy1);

?>

                <?php if($_REQUEST['loginuserprofileId']==92 && $resListing1['priceStatus']=='1' && $countqty1=='0') { echo '-'; } else{ ?>

                <?php if($resListing1['priceStatus']=='1' && $statusresult1['approvedStatus']!='1') { ?>

                <label class="priceblockclass<?php echo $resListing['id']; ?>" style="position:relative;">

                    <input type="checkbox"
                        style="position: relative;opacity: 1;cursor: pointer;height: 15px;width: 15px;margin-top: 0;"
                        value="<?php echo $resListing1['id']; ?>" name="priceCheckAllBox[]"
                        class="priceCheckClass<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" />

                </label>

                <?php } } ?>
            </td>

            <td align="center" <?php if($_REQUEST['page']!='prototypesample') { ?> style="display:none;" <?php } ?>>
                <?php if($resListing1['priceStatus']=='1' && $countqty1=='0' || $statusresult1['approvedStatus']=='5'){ ?>

                <a id="priceStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    <?php if($_REQUEST['loginuserprofileId']!=92) { ?>
                    onclick="opmodalpop('Price','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=2&id=<?php echo $resListing1['id']; ?>','600px','auto');"
                    data-toggle="modal" data-target="#modalpop" <?php } ?>
                    class="btn bg-warning-400 ml-md-3 mt-3 mt-md-0"
                    style="margin: 0px !important;padding: 3px 10px;background: #5c6bc0;">Pending</a>

                <?php }  else if($resListing1['priceStatus']=='1' && $statusresult1['approvedStatus']=='1') { ?>

                <?php /*?><a id="priceStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    onclick="opmodalpop('Price','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=2&id=<?php echo $resListing1['id']; ?>','600px','auto');"
                    data-toggle="modal" data-target="#modalpop" class="btn bg-success-400 ml-md-3 mt-3 mt-md-0"
                    style="margin: 0px !important;padding: 3px 10px;">Approved</a><?php */?>

                <a id="priceStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    class="btn bg-success-400 ml-md-3 mt-3 mt-md-0"
                    style="margin: 0px !important;padding: 3px 10px;">Approved</a>

                <?php } else if($resListing1['priceStatus']=='1' && $statusresult1['approvedStatus']=='2') { ?>

                <a id="priceStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    onclick="opmodalpop('Price','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=2&id=<?php echo $resListing1['id']; ?>','600px','auto');"
                    data-toggle="modal" data-target="#modalpop" class="btn bg-info-400 ml-md-3 mt-3 mt-md-0"
                    style="margin: 0px !important;padding: 3px 10px;">Assigned</a>

                <?php } else if($resListing1['priceStatus']=='1' && $statusresult1['approvedStatus']=='4') { ?>

                <a id="priceStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    onclick="opmodalpop('Price','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=2&id=<?php echo $resListing1['id']; ?>','600px','auto');"
                    data-toggle="modal" data-target="#modalpop" class="btn bg-info-400 ml-md-3 mt-3 mt-md-0"
                    style="margin: 0px !important;padding: 3px 10px;background:#ff0000;">Rejected</a>

                <?php } else if($resListing1['priceStatus']=='1' && $statusresult1['approvedStatus']=='3') { ?>

                <?php if($_SESSION['userid']==$statusresult1['assigedTo']){ ?>

                <a id="priceStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    onclick="opmodalpop('Price','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=2&id=<?php echo $resListing1['id']; ?>&fortTimeSlot=11','600px','auto');"
                    data-toggle="modal" data-target="#modalpop" class="btn bg-info-400 ml-md-3 mt-3 mt-md-0"
                    style="margin: 0px !important;padding: 3px 10px;background: #ff4a03;">Waiting For Approvel</a>

                <?php } else { ?>

                <a id="priceStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    onclick="opmodalpop('Price','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=2&id=<?php echo $resListing1['id']; ?>','600px','auto');"
                    data-toggle="modal" data-target="#modalpop" class="btn bg-info-400 ml-md-3 mt-3 mt-md-0"
                    style="margin: 0px !important;padding: 3px 10px;background: #ffc803;">Pending For Approvel</a>

                <?php } ?>

                <?php } else { ?>

                <a id="priceStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    class="btn bg-grey-400 ml-md-3 mt-3 mt-md-0"
                    style="margin: 0px !important;padding: 3px 10px;cursor: auto;">Not Required</a>

                <?php } ?>
            </td>

            <td align="center" <?php if($_REQUEST['page']!='prototypesample') { ?> style="display:none;" <?php } ?>><?php

$selecty1='*';

$wherey2='styleId="'.$_REQUEST['styleId'].'" and commnetType=3 and materialId="'.$resListing1['id'].'" order by id desc limit 1';

$rsy2=GetPageRecord($selecty1,'materialCostChatMaster',$wherey2);

$statusresult2=mysqli_fetch_array($rsy2);

$countqty2=mysqli_num_rows($rsy2);

?>

                <?php if($_REQUEST['loginuserprofileId']==92 && $resListing1['vendorStatus']=='1'  && $countqty2=='0') { echo '-';} else{ ?>

                <?php if($resListing1['vendorStatus']=='1' && $statusresult2['approvedStatus']!='1') { ?>

                <label class="vendorblockclass<?php echo $resListing['id']; ?>" style="position:relative;">

                    <input type="checkbox"
                        style="position: relative;opacity: 1;cursor: pointer;height: 15px;width: 15px;margin-top: 0;"
                        value="<?php echo $resListing1['id']; ?>" name="vendorCheckAllBox[]"
                        class="vendorCheckClass<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" />

                </label>

                <?php } } ?>
            </td>

            <td align="center" <?php if($_REQUEST['page']!='prototypesample') { ?> style="display:none;" <?php } ?>>
                <?php if($resListing1['vendorStatus']=='1'  && $countqty2=='0' || $statusresult2['approvedStatus']=='5'){ ?>

                <a id="vendorStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    <?php if($_REQUEST['loginuserprofileId']!=92) { ?>
                    onclick="opmodalpop('Vendor','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=3&id=<?php echo $resListing1['id']; ?>','600px','auto');"
                    data-toggle="modal" data-target="#modalpop" <?php } ?>
                    class="btn bg-warning-400 ml-md-3 mt-3 mt-md-0"
                    style="margin: 0px !important;padding: 3px 10px;background: #5c6bc0;">Pending</a>

                <?php }



else if($resListing1['vendorStatus']=='1' && $statusresult2['approvedStatus']=='1') { ?>

                <?php /*?><a id="vendorStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    onclick="opmodalpop('Vendor','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=3&id=<?php echo $resListing1['id']; ?>','600px','auto');"
                    data-toggle="modal" data-target="#modalpop" class="btn bg-success-400 ml-md-3 mt-3 mt-md-0"
                    style="margin: 0px !important;padding: 3px 10px;">Approved</a><?php */?>

                <a id="vendorStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    class="btn bg-success-400 ml-md-3 mt-3 mt-md-0"
                    style="margin: 0px !important;padding: 3px 10px;">Approved</a>

                <?php } else if($resListing1['vendorStatus']=='1' && $statusresult2['approvedStatus']=='4') { ?>

                <a id="vendorStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    onclick="opmodalpop('Vendor','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=3&id=<?php echo $resListing1['id']; ?>','600px','auto');"
                    data-toggle="modal" data-target="#modalpop" class="btn bg-info-400 ml-md-3 mt-3 mt-md-0"
                    style="margin: 0px !important;padding: 3px 10px;background:#ff0000;">Rejected</a>

                <?php } else if($resListing1['vendorStatus']=='1' && $statusresult2['approvedStatus']=='2') { ?>

                <a id="vendorStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    onclick="opmodalpop('Vendor','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=3&id=<?php echo $resListing1['id']; ?>','600px','auto');"
                    data-toggle="modal" data-target="#modalpop" class="btn bg-info-400 ml-md-3 mt-3 mt-md-0"
                    style="margin: 0px !important;padding: 3px 10px;">Assigned</a>

                <?php } else if($resListing1['vendorStatus']=='1' && $statusresult2['approvedStatus']=='3') { ?>

                <?php if($_SESSION['userid']==$statusresult2['assigedTo']){ ?>

                <a id="vendorStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    onclick="opmodalpop('Vendor','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=3&id=<?php echo $resListing1['id']; ?>&fortTimeSlot=11','600px','auto');"
                    data-toggle="modal" data-target="#modalpop" class="btn bg-info-400 ml-md-3 mt-3 mt-md-0"
                    style="margin: 0px !important;padding: 3px 10px;background: #ff4a03;">Waiting For Approvel</a>

                <?php } else { ?>

                <a id="vendorStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    onclick="opmodalpop('Vendor','modalpop.php?action=materialcostchat&styleId=<?php echo encode($_REQUEST['styleId']); ?>&srno=<?php echo $sNo1; ?>&materialType=<?php echo $resListing['id']; ?>&materialId=<?php echo $resListing1['id']; ?>&costversionid=<?php echo $_REQUEST['costsheetVersionId']; ?>&commnetType=3&id=<?php echo $resListing1['id']; ?>','600px','auto');"
                    data-toggle="modal" data-target="#modalpop" class="btn bg-info-400 ml-md-3 mt-3 mt-md-0"
                    style="margin: 0px !important;padding: 3px 10px;background: #ffc803;">Pending For Approvel</a>

                <?php } ?>

                <?php } else { ?>

                <a id="vendorStatus<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    class="btn bg-grey-400 ml-md-3 mt-3 mt-md-0"
                    style="margin: 0px !important;padding: 3px 10px;cursor: auto;">Not Required</a>

                <?php } ?>
            </td>

            <!--hidden div for status-->

            <div id="qualitycheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                name="qualitycheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                style="display:none;"></div>

            <!--end-->

            <td align="center"
                <?php if($_REQUEST['page']!='analysemateriallist' && ($_REQUEST['page']!='sampleanalysematerial' || $resListing['id']!=2)) { ?>
                style="display:none;" <?php } ?>><?php 	if($_REQUEST['page']!='sampleanalysematerial') { ?>

                <label class="container">

                    <input type="checkbox"
                        id="qtystatuscheckuncheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        name="qtystatuscheckuncheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        value="<?php if($resListing1['qtyStatus']=='1') { echo '0';  } else { echo '1'; } ?>"
                        style="margin-right: 5px;" <?php if($resListing1['qtyStatus']=='1') { ?> checked="checked"
                        <?php } ?>
                        onclick="qualityonoff<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>('<?php echo $resListing1['id']; ?>');">

                    <span class="checkmark"></span></label>

                <label class="container">

                    <input type="checkbox"
                        id="pricestatuscheckuncheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        name="pricestatuscheckuncheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        value="<?php if($resListing1['priceStatus']=='1') { echo '0';  } else { echo '1'; } ?>"
                        style="margin-right: 5px;" <?php if($resListing1['priceStatus']=='1') { ?> checked="checked"
                        <?php } ?>
                        onclick="priceonoff<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>('<?php echo $resListing1['id']; ?>');">

                    <span class="checkmark"></span></label>

                <label class="container">

                    <input type="checkbox"
                        id="vendorstatuscheckuncheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        name="vendorstatuscheckuncheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        value="<?php if($resListing1['vendorStatus']=='1') { echo '0';  } else { echo '1'; } ?>"
                        style="margin-right: 5px;" <?php if($resListing1['vendorStatus']=='1') { ?> checked="checked"
                        <?php } ?>
                        onclick="vendoronoff<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>('<?php echo $resListing1['id']; ?>');">

                    <span class="checkmark"></span></label>

                <label class="container" style="display:none;">

                    <input type="checkbox"
                        id="colorSeparate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        name="colorSeparate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        value="<?php if($resListing1['colorSeparate']=='1') { echo '0';  } else { echo '1'; } ?>"
                        style="margin-right: 5px;" <?php if($resListing1['colorSeparate']=='1') { ?> checked="checked"
                        <?php } ?>
                        onclick="colorseparationonoff<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>('<?php echo $resListing1['id']; ?>');">

                    <span class="checkmark"></span></label>

                <?php } ?>

                <?php if($resListing['id']==2){ ?>

                <label class="container">

                    <input type="checkbox"
                        id="sizeSeparate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        name="sizeSeparate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        value="<?php if($resListing1['sizeSeparate']=='1') { echo '0';  } else { echo '1'; } ?>"
                        style="margin-right: 5px;" <?php if($resListing1['sizeSeparate']=='1') { ?> checked="checked"
                        <?php } ?>
                        onclick="sizeseparationonoff<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>('<?php echo $resListing1['id']; ?>');">

                    <span class="checkmark"></span></label>

                <?php } ?>

            </td>

            <script>
            function qualityonoff<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>(id) {

                var qtystatus = $(
                    '#qtystatuscheckuncheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>')
                .val();

                $('#qualitycheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').load(
                    "load_costsheet_version.php?action=qualityrequired&qtystatus=" + qtystatus + '&id=' + id);



            }
            </script>

            <script>
            function priceonoff<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>(id) {

                var priceStatus = $(
                        '#pricestatuscheckuncheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>')
                    .val();

                $('#qualitycheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').load(
                    "load_costsheet_version.php?action=pricerequired&priceStatus=" + priceStatus + '&id=' + id);



            }
            </script>

            <script>
            function vendoronoff<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>(id) {

                var vendorStatus = $(
                        '#vendorstatuscheckuncheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>')
                    .val();

                $('#qualitycheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').load(
                    "load_costsheet_version.php?action=vendorrequired&vendorStatus=" + vendorStatus + '&id=' + id);



            }
            </script>

            <script>
            function colorseparationonoff<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>(id) {

                var colorSeparate = $(
                    '#colorSeparate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val();



                $('#qualitycheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').load(
                    "load_costsheet_version.php?action=colorseparation&colorSeparate=" + colorSeparate + '&id=' + id
                    );

            }
            </script>

            <script>
            function sizeseparationonoff<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>(id) {



                var x = confirm("Are you sure you want to separate size wise material?");

                if (x == true) {



                    var sizeSeparate = $(
                        '#sizeSeparate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val();



                    if ($('#sizeSeparate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').is(
                            ":checked")) {

                        sizeSeparate = 1;

                    } else {

                        sizeSeparate = 0;

                    }





                    $('#qualitycheck<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').load(
                        "load_costsheet_version.php?styleId=<?php echo $_REQUEST['styleId']; ?>&action=sizeseparation&sizeSeparate=" +
                        sizeSeparate + '&id=' + id);

                } else {



                    $("#sizeSeparate<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>").removeAttr(
                        'checked');



                }



            }
            </script>

        </tr>

        <?php $N++;  } ?>

        <style>
        <?php if($_REQUEST['loginuserprofileId']=='154'|| $_REQUEST['loginuserprofileId']=='155') {

            if($N=='0') {
                ?>#table-hide-showw<?php echo $resListing['id'];
                ?><?php echo $_REQUEST['costsheetVersionId'];
                ?>,
                #tableid<?php echo $resListing['id'];
                ?><?php echo $_REQUEST['costsheetVersionId'];
                ?>,
                #totalprice<?php echo $resListing['id'];
                ?><?php echo $_REQUEST['costsheetVersionId'];

                ?> {

                    display: none !important;

                }

                <?php
            }
        }

        ?>
        </style>

    </tbody>



</table>

<style>
.total-price {

    display: none;

}
</style>

<div id="totalprice<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>" class="total-price"
    <?php if($_REQUEST['page']=='costsheet' || $_REQUEST['page']=='materiallist') { ?> style="display:block;"
    <?php } ?>>Total: <span
        class="totalPrice<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
        id="totalPrice<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>">

        <?php $firsrgrandtotoal = $firsrgrandtotoal+$totalpc; echo $totalpc; ?>

    </span> </div>

<script>
function abc_totalgrand_first<?php echo $_REQUEST['costsheetVersionId']; ?>() {

    var totalpriceval;

    var finaltotalcostsheet = 0;

    var costsheetid = <?php echo $_REQUEST['costsheetVersionId']; ?>;

    for (var ijk = 1; ijk <= <?php echo $countfortotal; ?>; ijk++) {



        totalpriceval = document.getElementById('totalPrice' + ijk + costsheetid).innerText;



        finaltotalcostsheet = Number(finaltotalcostsheet) + Number(totalpriceval);

    }



    finaltotalcostsheet = parseFloat(finaltotalcostsheet).toFixed(4);

    document.getElementById("finaltotalcostsheet<?php echo $_REQUEST['costsheetVersionId']; ?>").innerHTML =
        finaltotalcostsheet;



}
</script>

<script type="text/javascript">
$(document).ready(function() {

    // check uncheck all inclusions

    $("#incCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>").click(
        function() {

            if (this.checked) {

                $('.Checkedinc<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>')
                    .each(function() {

                        this.checked = true;



                        $('#materialcosttype').val('<?php echo $resListing['id']; ?>');



                    })

            } else {

                $('.Checkedinc<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>')
                    .each(function() {

                        this.checked = false;



                        $('#materialcosttype').val('<?php echo $resListing['id']; ?>');



                    })

            }

        });



});
</script>

<!--ASSIGN TO PURCHASE MERCHANT-->

<script type="text/javascript">
$(document).ready(function() {

    // check uncheck all inclusions

    $("#purchasemerchantincCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>")
        .click(function() {

            if (this.checked) {

                $('.purchaseMerchantCheckedinc<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>')
                    .each(function() {

                        this.checked = true;



                        $('#materialcosttypepurchasemerchant').val('<?php echo $resListing['id']; ?>');



                    })

            } else {

                $('.purchaseMerchantCheckedinc<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>')
                    .each(function() {

                        this.checked = false;



                        $('#materialcosttypepurchasemerchant').val('<?php echo $resListing['id']; ?>');



                    })

            }

        });



});
</script>

<script>
function sendmaterialvaluepurchasemerchant<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>() {

    $('#materialcosttypepurchasemerchant').val('<?php echo $resListing['id']; ?>');

}
</script>

<script>
window.setInterval(function() {

    checked = $(
        "#load_bom_list<?php echo $_REQUEST['costsheetVersionId']; ?> .materialcostcheckubcheckpurchasemerchant input[type=checkbox]:checked"
        ).length;

    if (!checked) {

        $("#deactivatebtnpurchasemerchant<?php echo $_REQUEST['costsheetVersionId']; ?>").hide();

    } else {

        $("#deactivatebtnpurchasemerchant<?php echo $_REQUEST['costsheetVersionId']; ?>").show();

    }

}, 100);
</script>

<!--ASSIGN TO PURCHASE MERCHANT-->

<!--DELETE ALL MATERIAL TOGETHER-->

<script type="text/javascript">
$(document).ready(function() {

    // check uncheck all inclusions

    $("#materialCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>").click(
        function() {

            if (this.checked) {

                $('.deletematerial<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>')
                    .each(function() {

                        this.checked = true;





                    })

            } else {

                $('.deletematerial<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>')
                    .each(function() {

                        this.checked = false;



                    })

            }

        });



});
</script>

<script>
window.setInterval(function() {

    checked = $(
        "#load_bom_list<?php echo $_REQUEST['costsheetVersionId']; ?> .analyselistclass<?php echo $resListing['id']; ?> input[type=checkbox]:checked"
        ).length;

    if (!checked) {

        $("#materialdeactivatebtn<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>")
            .hide();

    } else {

        $("#materialdeactivatebtn<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>")
            .show();

    }

}, 100);
</script>

<script>
function delteAllMaterial<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>(materialtype,
    costsheetVersionId) {



    var deleteeAllMaterial = '';



    $('input:checkbox.deletematerial<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>')
        .each(function() {

            var sThisVal = (this.checked ? $(this).val() : "");





            if (sThisVal != '') {

                deleteeAllMaterial = deleteeAllMaterial + sThisVal + ',';



            }



        });



    $('#allMatertiallistt').val(deleteeAllMaterial);



    var CheckUncheckMaterial = $('#allMatertiallistt').val();

    var r = confirm("Are you sure you want to delete this records?");

    if (r == true) {

        $('#load_bom_list<?php echo $_REQUEST['costsheetVersionId']; ?>').load(
            "load_bom_list.php?styleId=<?php echo $_REQUEST['styleId'];?>&action=allmaterialdelete&page=<?php echo $_REQUEST['page']; ?>&materialtype=" +
            materialtype + '&costsheetVersionId=' + costsheetVersionId + '&CheckUncheckMaterial=' +
            CheckUncheckMaterial);

    }



}
</script>

<input type="hidden" name="allMatertiallistt" id="allMatertiallistt" value="0" />

<!--END DELETE MATERIAL-->

<script>
function sendmaterialvalue<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>() {

    $('#materialcosttype').val('<?php echo $resListing['id']; ?>');

}
</script>

<script>
window.setInterval(function() {

    checked = $(
        "#load_bom_list<?php echo $_REQUEST['costsheetVersionId']; ?> .materialcostcheckubcheck input[type=checkbox]:checked"
        ).length;

    if (!checked) {

        $("#deactivatebtn<?php echo $_REQUEST['costsheetVersionId']; ?>").hide();

    } else {

        $("#deactivatebtn<?php echo $_REQUEST['costsheetVersionId']; ?>").show();

    }

}, 100);
</script>

<!--ADD QUALITY APPROVEL ALL-->

<script type="text/javascript">
$(document).ready(function() {

    // check uncheck all inclusions

    $("#qualityCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>").click(
        function() {

            if (this.checked) {

                $('.QualityyCheckClass<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>')
                    .each(function() {

                        this.checked = true;

                    })

            } else {

                $('.QualityyCheckClass<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>')
                    .each(function() {

                        this.checked = false;



                    })

            }

        });



});
</script>

<script>
window.setInterval(function() {

    checked = $(
        "#load_bom_list<?php echo $_REQUEST['costsheetVersionId']; ?> .qualityblockclass<?php echo $resListing['id']; ?> input[type=checkbox]:checked"
        ).length;

    if (!checked) {

        $("#qualitydeactivatebtn<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>")
            .hide();

    } else {

        $("#qualitydeactivatebtn<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>")
            .show();

    }

}, 100);
</script>

<script>
function requestAllQuality<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>() {



    var actionAllQuality = '';



    $('input:checkbox.QualityyCheckClass<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>')
        .each(function() {

            var sThisVal = (this.checked ? $(this).val() : "");





            if (sThisVal != '') {

                actionAllQuality = actionAllQuality + sThisVal + ',';



            }



        });



    $('#actionAllQuality').val(actionAllQuality);



}
</script>

<input type="hidden" name="actionAllQuality" id="actionAllQuality" value="0" />

<!--ADD QUALITY APPROVEL ALL-->

<!--ADD PRICE APPROVEL ALL-->

<script type="text/javascript">
$(document).ready(function() {

    // check uncheck all inclusions

    $("#priceCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>").click(
        function() {

            if (this.checked) {

                $('.priceCheckClass<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>')
                    .each(function() {

                        this.checked = true;

                    })

            } else {

                $('.priceCheckClass<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>')
                    .each(function() {

                        this.checked = false;



                    })

            }

        });



});
</script>

<script>
window.setInterval(function() {

    checked = $(
        "#load_bom_list<?php echo $_REQUEST['costsheetVersionId']; ?> .priceblockclass<?php echo $resListing['id']; ?> input[type=checkbox]:checked"
        ).length;

    if (!checked) {

        $("#pricedeactivatebtn<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>")
            .hide();

    } else {

        $("#pricedeactivatebtn<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>")
            .show();

    }

}, 100);
</script>

<script>
function requestAllprice<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>() {



    var actionAllprice = '';



    $('input:checkbox.priceCheckClass<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>')
        .each(function() {

            var sThisVal2 = (this.checked ? $(this).val() : "");





            if (sThisVal2 != '') {

                actionAllprice = actionAllprice + sThisVal2 + ',';



            }



        });



    $('#actionAllprice').val(actionAllprice);



}
</script>

<input type="hidden" name="actionAllprice" id="actionAllprice" value="0" />

<!--ADD PRICE APPROVEL ALL-->

<!--ADD VENDOR APPROVEL ALL-->

<script type="text/javascript">
$(document).ready(function() {

    // check uncheck all inclusions

    $("#vendorCheckAll<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>").click(
        function() {

            if (this.checked) {

                $('.vendorCheckClass<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>')
                    .each(function() {

                        this.checked = true;

                    })

            } else {

                $('.vendorCheckClass<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>')
                    .each(function() {

                        this.checked = false;



                    })

            }

        });



});
</script>

<script>
window.setInterval(function() {

    checked = $(
        "#load_bom_list<?php echo $_REQUEST['costsheetVersionId']; ?> .vendorblockclass<?php echo $resListing['id']; ?> input[type=checkbox]:checked"
        ).length;

    if (!checked) {

        $("#vendordeactivatebtn<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>")
            .hide();

    } else {

        $("#vendordeactivatebtn<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>")
            .show();

    }

}, 100);
</script>

<script>
function requestAllvendor<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>() {



    var actionAllvendor = '';



    $('input:checkbox.vendorCheckClass<?php echo $resListing['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>')
        .each(function() {

            var sThisVal3 = (this.checked ? $(this).val() : "");





            if (sThisVal3 != '') {

                actionAllvendor = actionAllvendor + sThisVal3 + ',';



            }



        });



    $('#actionAllvendor').val(actionAllvendor);



}
</script>

<input type="hidden" name="actionAllvendor" id="actionAllvendor" value="0" />

<!--ADD VENDOR APPROVEL ALL-->

<?php } ?>

<!--Change value based on currecncy-->

<script>
function change_usd_value<?php echo $_REQUEST['costsheetVersionId']; ?>() {

    //alert("Price Changed");

    //escape_landing_cost<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();

    //value_on_pc<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();

    //calTotalCost<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();

}
</script>

<!--Change value based on currecncy-->

<input type="hidden" name="xxy" id="xxy" value="<?php echo $sNo1; ?>" />

<script>
function bom_total_count() {

    var xxy = $("#xxy").val();

    $("#bomTotalCount").val(xxy);

}

bom_total_count();
</script>

<style>
.total-price {

    padding: 10px 15px;

    font-size: 16px;

    cursor: pointer;

    background-color: #f7f7f7;

    font-weight: 500;

    color: #000000;

    width: 100%;

    box-sizing: border-box;

    text-align: right;

    border: 2px #ccc solid;

    margin-bottom: 10px;

    border-top: 0px;

}

.table-hide-show {

    padding: 10px 15px;

    border: 1px solid #3fd7de;

    font-size: 16px;

    cursor: pointer;

    background-color: #e5fbfa;

    position: relative;

    font-weight: 500;

    color: #000000;

    width: 100%;

    box-sizing: border-box;

}
</style>

<!--add extra charges-->

<div class="specialclassforsheet" <?php if($_REQUEST['page']!='costsheet') { ?> style="display:none;" <?php } ?>>

    <?php

$allfunctionexcharges ='';

$countfortotalsecond=0;

							$secondgrandtotal=0;

     						$sNo1a = 0;

							$rownoa=0;

							$loopsta=0;

						    $where33a='';

							$rs33a='';

							$totalvarcounta =0;

							$select33a='id,name';

							$where33a='1 order by id asc';

							$rs33a=GetPageRecord($select33a,'chargesTypeMaster',$where33a);

							$countfortotalsecond=mysqli_num_rows($rs33a);

							while($resListinga=mysqli_fetch_array($rs33a)){

							$totalvarcounta = $resListinga['id'];



							 ?>

    <div onclick="tabhideshowa<?php echo $resListinga['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();"
        class="table-hide-show"><?php echo $resListinga['name']; ?> <span
            class="plusminusclass<?php echo $_REQUEST['costsheetVersionId']; ?>"
            style="position: absolute; right: 12px; font-size: 23px;  display:block; top: 10px;"
            id="tabplusa<?php echo $resListinga['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"><i
                class="fa fa-plus-circle" aria-hidden="true"></i></span> <span
            style="position: absolute; right: 12px; font-size: 23px; display:none; top: 10px;"
            id="tabminusa<?php echo $resListinga['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"><i
                class="fa fa-minus-circle" aria-hidden="true"></i></span>

        <script>
        function tabhideshowa<?php echo $resListinga['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>() {

            $('#tableida<?php echo $resListinga['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').toggle();



            var tabplusa<?php echo $_REQUEST['costsheetVersionId']; ?> = $(
                '#tabplusa<?php echo $resListinga['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').css(
                'display');



            if (tabplusa<?php echo $_REQUEST['costsheetVersionId']; ?> == 'block') {

                $('#tabminusa<?php echo $resListinga['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').show();

                $('#tabplusa<?php echo $resListinga['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').hide();

            } else {

                $('#tabminusa<?php echo $resListinga['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').hide();

                $('#tabplusa<?php echo $resListinga['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').show();



            }



        }
        </script>

    </div>

    <script>
    function abc_totalgrand_second<?php echo $_REQUEST['costsheetVersionId']; ?>() {

        var totalpricevall;

        var secondwalagrandtotal = 0;



        var costsheetidsecond = <?php echo $_REQUEST['costsheetVersionId']; ?>;



        for (var ijkl = 1; ijkl <= <?php echo $countfortotalsecond; ?>; ijkl++) {



            totalpricevall = document.getElementById('totalPricea' + ijkl + costsheetidsecond).innerText;



            secondwalagrandtotal = Number(secondwalagrandtotal) + Number(totalpricevall);

        }



        secondwalagrandtotal = parseFloat(secondwalagrandtotal).toFixed(4);



        document.getElementById("secondwalagrandtotal<?php echo $_REQUEST['costsheetVersionId']; ?>").innerHTML =
            secondwalagrandtotal;



    }



    function count_grand_total<?php echo $_REQUEST['costsheetVersionId']; ?>() {

        var firsttotal = Number(document.getElementById(
            "finaltotalcostsheet<?php echo $_REQUEST['costsheetVersionId']; ?>").innerText);

        var secondtotal = Number(document.getElementById(
            "secondwalagrandtotal<?php echo $_REQUEST['costsheetVersionId']; ?>").innerText);











        var final = Number(firsttotal) + Number(secondtotal);



        final = parseFloat(final).toFixed(4);



        document.getElementById("grandtotalsum<?php echo $_REQUEST['costsheetVersionId']; ?>").innerHTML = final;



        //calculate total cost

        var totalcostfob = 0;

        totalcostfob = document.getElementById("totalcostfob<?php echo $_REQUEST['costsheetVersionId']; ?>").innerHTML =
            final;



    }

    function calculate_factory_overhead<?php echo $_REQUEST['costsheetVersionId']; ?>() {

        var factoryoverheadtext = $('#factoryoverheadtext<?php echo $_REQUEST['costsheetVersionId']; ?>').val();

        var c16text = $('#c16text<?php echo $_REQUEST['costsheetVersionId']; ?>').val();



        var c16tenpercent = 0;

        var fcharges = 0;

        var jobcharges = 0;

        var totaljobextracharges = 0;

        var totalwithoutc16 = 0;

        var lastgrandtotal = 0;



        // we use jQuery each() to loop through all the textbox with 'price' class

        // and compute the sum for each loop

        jobcharges = Number(document.getElementById("totalPricea2<?php echo $_REQUEST['costsheetVersionId']; ?>")
            .innerText);





        fcharges = Number(factoryoverheadtext * jobcharges) / 100;







        // set the computed value to 'totalPrice' textbox

        fcharges = parseFloat(fcharges).toFixed(4);







        document.getElementById("factoryoverhead<?php echo $_REQUEST['costsheetVersionId']; ?>").innerHTML = fcharges;



        //total job charges + overhead charges



        var totaljobextracharges = Number(jobcharges) + Number(fcharges);



        totaljobextracharges = parseFloat(totaljobextracharges).toFixed(4);



        document.getElementById("totaljobworkcharges<?php echo $_REQUEST['costsheetVersionId']; ?>").innerHTML =
            totaljobextracharges;



        var totalall = document.getElementById("grandtotalsum<?php echo $_REQUEST['costsheetVersionId']; ?>").innerText;







        totalwithoutc16 = Number(totalall) + Number(totaljobextracharges);





        totalwithoutc16 = parseFloat(totalwithoutc16).toFixed(4);



        totalwithoutc16 = (totalwithoutc16 - jobcharges);





        document.getElementById("totalwithoutc16<?php echo $_REQUEST['costsheetVersionId']; ?>").innerHTML =
            totalwithoutc16;





        ///////////////////





        c16tenpercent = Number(totalwithoutc16 * c16text) / 100;

        c16tenpercent = parseFloat(c16tenpercent).toFixed(4);

        document.getElementById("c16percent<?php echo $_REQUEST['costsheetVersionId']; ?>").innerHTML = c16tenpercent;





        totaljobextracharges = Number(c16tenpercent) + Number(totalwithoutc16);

        totaljobextracharges = parseFloat(totaljobextracharges).toFixed(4);

        document.getElementById("lastgrandtotal<?php echo $_REQUEST['costsheetVersionId']; ?>").innerHTML =
            totaljobextracharges;





        <!--add chcha grand total-- >

        var mrptotallast = 0;

        mrptotallast = document.getElementById('lastgrandtotal<?php echo $_REQUEST['costsheetVersionId']; ?>')
        .innerText;

        document.getElementById("mrptotallast<?php echo $_REQUEST['costsheetVersionId']; ?>").innerHTML = mrptotallast;











    }





    function calculate_customer_markup<?php echo $_REQUEST['costsheetVersionId']; ?>() {





        var totalcostfob = 0;

        var customermarkup = 0;

        var customermarkupvalueee = 0;

        var customermarkupvalue = 0;

        var sellingprice = 0;

        var sellingpriceww = 0;

        var discountsellingpriceeee = 0;

        var discountsellingpriceeeedsd = 0;

        var effectivesellingpriceaaa = 0;

        var profitaaa = 0;



        var profitlast = 0;

        var totalcostfoblast = 0;

        var finalprofitloss = 0;





        totalcostfob = document.getElementById("totalcostfob<?php echo $_REQUEST['costsheetVersionId']; ?>").innerHTML;



        //customermarkup=Number($('#customermarkup<?php echo $_REQUEST['costsheetVersionId']; ?>').val());



        fobpricenew = Number($('#fobpricenew<?php echo $_REQUEST['costsheetVersionId']; ?>').val());



        customermarkupvalueee = (fobpricenew - totalcostfob);



        //customermarkupvalueee=(customermarkup*totalcostfob)/100;



        customermarkupvalueee = parseFloat(customermarkupvalueee).toFixed(4);



        customermarkupvalue = document.getElementById(
            "customermarkupvalue<?php echo $_REQUEST['costsheetVersionId']; ?>").innerHTML = customermarkupvalueee;





        sellingpriceww = Number(customermarkupvalue) + Number(totalcostfob);



        sellingpriceww = parseFloat(sellingpriceww).toFixed(4);



        document.getElementById("sellingprice<?php echo $_REQUEST['costsheetVersionId']; ?>").innerHTML =
        sellingpriceww;





        discountsellingpriceeee = Number($('#discountsellingprice<?php echo $_REQUEST['costsheetVersionId']; ?>')
    .val());



        discountsellingpriceeeedsd = (sellingpriceww * discountsellingpriceeee) / 100;



        discountsellingpriceeeedsd = parseFloat(discountsellingpriceeeedsd).toFixed(4);





        document.getElementById("discountsellingpricevalue<?php echo $_REQUEST['costsheetVersionId']; ?>").innerHTML =
            discountsellingpriceeeedsd;





        effectivesellingpriceaaa = Number(sellingpriceww) - Number(discountsellingpriceeeedsd);



        effectivesellingpriceaaa = parseFloat(effectivesellingpriceaaa).toFixed(4);



        document.getElementById("effectivesellingprice<?php echo $_REQUEST['costsheetVersionId']; ?>").innerHTML =
            effectivesellingpriceaaa;



        var totalcostfobfinal = 0;

        var effectivesellingpricefinal = 0;

        totalcostfobfinal = document.getElementById("totalcostfob<?php echo $_REQUEST['costsheetVersionId']; ?>")
            .innerHTML;

        effectivesellingpricefinal = document.getElementById(
            "effectivesellingprice<?php echo $_REQUEST['costsheetVersionId']; ?>").innerHTML;



        profitaaa = Number(effectivesellingpricefinal) - Number(totalcostfobfinal);

        profitaaa = parseFloat(profitaaa).toFixed(4);



        document.getElementById("profit<?php echo $_REQUEST['costsheetVersionId']; ?>").innerHTML = profitaaa;



        //add profit and loss

        profitlast = document.getElementById("profit<?php echo $_REQUEST['costsheetVersionId']; ?>").innerHTML;

        totalcostfob = document.getElementById("totalcostfob<?php echo $_REQUEST['costsheetVersionId']; ?>").innerHTML;





        finalprofitloss = Number(profitlast / totalcostfob * 100);

        finalprofitloss = parseFloat(finalprofitloss).toFixed(4);

        document.getElementById("profitlosspercent<?php echo $_REQUEST['costsheetVersionId']; ?>").innerHTML =
            finalprofitloss;





    }





    function calculate_margin<?php echo $_REQUEST['costsheetVersionId']; ?>() {

        var finalmrpmargin = 0;

        var mrptotal = 0;

        var totalmrp = 0;

        totalmrp = $('#totalmrp<?php echo $_REQUEST['costsheetVersionId']; ?>').val();

        mrptotal = document.getElementById('lastgrandtotal<?php echo $_REQUEST['costsheetVersionId']; ?>').innerText;



        finalmrpmargin = Number(totalmrp) / Number(mrptotal);

        finalmrpmargin = parseFloat(finalmrpmargin).toFixed(4);

        document.getElementById("finalgrandtotalwithmrp<?php echo $_REQUEST['costsheetVersionId']; ?>").innerHTML =
            finalmrpmargin;



    }
    </script>

    <table width="100%" class="table table-bordered table-responsive forbom"
        id="tableida<?php echo $resListinga['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
        style="display:none;">

        <tbody style="width: 100%;display: inline-table;">

            <tr class="card-body">

                <td><strong>Name</strong></td>

                <td align="center" style="display:none;"><strong>Avg.</strong></td>

                <td align="center" style="display:none;"><strong>UOM</strong></td>

                <?php if($resListinga['id']==2){ ?>

                <td align="center"><strong>Overhead %</strong></td>

                <?php } ?>

                <td align="center"><strong>Price</strong></td>

                <td align="center"><strong>Currency</strong></td>

                <td align="center" style="display:none;"><strong>INR</strong></td>

                <td align="center" style="display:none;"><strong>USD</strong></td>

                <td align="center" style="display:none;"><strong>Landing Cost(%)</strong></td>

                <td align="center" style="display:none;"><strong>Rate</strong></td>

                <td align="center" style="display:none;"><strong>Value of 1 PC</strong></td>

                <td align="center"><strong>Add to Cost</strong></td>

                <td align="center"><strong>Remarks</strong></td>

            </tr>

            <?php



									$k=GetPageRecord('*','queryMaster','subCategoryId="'.$_REQUEST['subCategoryId'].'"');

									$categoryId=mysqli_fetch_array($k);



									$totalPricea=0;

									$srtypea=0;

									$where22a='';

									$rs22a='';

									$select22a='*';

									//$where22a='chargestype="'.$resListinga['id'].'" and category="'.$categoryId['categoryId'].'" order by id asc';

									$where22a='chargestype="'.$resListinga['id'].'" and status=1 order by id asc';

									$rs22a=GetPageRecord($select22a,'chargesMaster',$where22a);

									$srtypea = mysqli_num_rows($rs22a);

									while($resListing1a=mysqli_fetch_array($rs22a)){

								    $loopsta=$srtypea;

								    $rownoa++;

								    $sNo1a=$rownoa;



									$rs121a=GetPageRecord('*','extraChargesDetailMaster',' bomSerialNoextra="'.$sNo1a.'" and styleId="'.$_REQUEST['styleId'].'" and costsheetVersionId="'.$_REQUEST['costsheetVersionId'].'" order by id desc');







								$resListing12a=mysqli_fetch_array($rs121a);



	$allfunctionexcharges=$allfunctionexcharges.'saveallbomexcharges'.$_REQUEST['costsheetVersionId'].'('.$sNo1a.','.$_REQUEST['costsheetVersionId'].');';







								?>

            <tr class="card-body">

                <td><input type="hidden" name="bomSerialNoextra<?php echo $sNo1a; ?>" value="<?php echo $sNo1a; ?>" />

                    <div><?php echo $resListing1a['name']; ?></div>
                </td>

                <td align="center" style="display:none;"><input
                        name="bomAvgextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        type="text" id="bomAvgextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        onkeyup="value_on_pca<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();calTotalCosta<?php echo $totalvarcounta.$sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();"
                        value="<?php echo $resListing12a['bomAvgextra']; ?>" autocomplete="off" maxlength="200"
                        style="width: 80px;text-align: center;" placeholder="Avg." />

                </td>

                <td align="center" style="display:none;"><select
                        name="bomUnitextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="bomUnitextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        value="<?php echo $resListing12a['bomUnitextra']; ?>"
                        style="width: fit-content;text-align: center;padding:3px;">

                        <?php

$selectunita='*';

$whereunita='1 group by name asc';

$rsunita=GetPageRecord($selectunita,'unitMaster',$whereunita);

while($resListingunita=mysqli_fetch_array($rsunita)){

?>

                        <option value="<?php echo $resListingunita['name']; ?>"
                            <?php if($resListingunita['name']==$resListing12a['bomUnitextra']){ ?> selected <?php } ?>>
                            <?php echo $resListingunita['name']; ?></option>

                        <?php } ?>

                    </select>

                </td>

                <?php

$totalsam=0;

$totalsam=$_REQUEST['cpm']*$_REQUEST['sam'];

?>

                <?php if($resListinga['id']==2){ ?>

                <td align="center"><input type="text"
                        name="overheadper<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        style="width: 80px;text-align: center;" placeholder="Overhead %"
                        id="overheadper<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        value="<?php echo $resListing12a['overheadper']; ?>" autocomplete="off" maxlength="200"
                        onkeyup="escape_landing_costa<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();value_on_pca<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();calTotalCosta<?php echo $totalvarcounta.$sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();" />
                </td>

                <?php } ?>

                <td align="center"><input type="text"
                        name="matPriceextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        style="width: 80px;text-align: center;<?php if($resListing1a['name']=="CM (Cut Make)"){ ?> border: 0px; padding: 4px;background-color: #f3f3f3; <?php } ?><?php if($resListinga['id']==2){ ?>background-color: #f3f3f3;<?php } ?>"
                        placeholder="Price"
                        id="matPriceextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        value="<?php if($resListing1a['name']=="CM (Cut Make)"){ if($totalsam>0){ echo $totalsam; } } else{ if($resListing12a['matPriceextra']!=''){ echo $resListing12a['matPriceextra']; } else { echo $resListing1a['defaultcharesvalue']; } } ?>"
                        autocomplete="off" maxlength="200"
                        onkeyup="escape_landing_costa<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();value_on_pca<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();calTotalCosta<?php echo $totalvarcounta.$sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();" />

                </td>

                <td align="center"><select
                        name="matCurrencyextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="matCurrencyextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        style="width: fit-content; text-align: center; padding: 5px;"
                        onchange="change_currencya<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>(this.value);">

                        <option value="">Select</option>

                        <?php

$cqq=GetPageRecord('*','currencyMaster','1 order by id asc');

while($currDataq=mysqli_fetch_array($cqq)){

?>

                        <option value="<?php echo $currDataq['id']; ?>"
                            <?php if($resListing12a['matCurrencyextra']!="" && $resListing12a['matCurrencyextra']!=0){ if($currDataq['id']==$resListing12a['matCurrencyextra']){ ?>
                            selected <?php } } ?>
                            <?php if($resListing12a['matCurrencyextra']=="" || $resListing12a['matCurrencyextra']==0){ if($buyerData['buyerCurrency']==$currDataq['id']){ ?>
                            selected <?php } } ?>>

                            <?php echo $currDataq['name']; ?>

                        </option>

                        <?php } ?>

                    </select>

                </td>

                <td align="center" style="display:none;"><input
                        name="bomINRextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        type="text" id="bomINRextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        onkeyup="escape_landing_costa<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();value_on_pca<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();calTotalCosta<?php echo $totalvarcounta.$sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();"
                        value="<?php if($resListing12a['bomINRextra']!=''){ echo $resListing12a['bomINRextra']; } else { echo $resListing1a['defaultcharesvalue']; } ?>"
                        autocomplete="off" maxlength="200" style="width: 80px;text-align: center;" placeholder="INR" />
                </td>

                <td align="center" style="display:none;"><input
                        name="bomUSDextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        type="text" id="bomUSDextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        onkeyup="convert_inra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();value_of_ratea<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();value_on_pca<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();calTotalCosta<?php echo $totalvarcounta.$sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();"
                        value="<?php echo $resListing12a['bomUSDextra']; ?>" autocomplete="off" maxlength="200"
                        style="width: 80px;text-align: center;" placeholder="USD" /></td>

                <td align="center" style="display:none;"><input
                        name="landingcostperextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        type="text"
                        id="landingcostperextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        onkeyup="value_of_ratea<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();value_on_pca<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();calTotalCosta<?php echo $totalvarcounta.$sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();"
                        value="40" autocomplete="off" maxlength="200" style="width: 80px;text-align: center;"
                        placeholder="Lnnd. Cst." /></td>

                <td align="center" style="display:none;"><input
                        name="bomRateextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        type="text" id="bomRateextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        value="<?php echo $resListing12a['bomRateextra']; ?>" autocomplete="off" maxlength="200"
                        style="width: 100px;text-align: center;" placeholder="Rate" /></td>

                <td align="center" style="display:none;"><input
                        name="bomvalueonepcextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        type="text"
                        id="bomvalueonepcextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        value="<?php echo $resListing12a['bomvalueonepcextra']; $totalPricea=$totalPricea+$resListing12a['bomvalueonepcextra']; ?>"
                        autocomplete="off" maxlength="200"
                        class="pricea<?php echo $resListinga['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        style="width: 100px;text-align: center;" placeholder="Value 1PC" /></td>

                <td align="center"><select
                        name="addToCostextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="addToCostextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        style="width: 70px; padding: 4px 4px 3px;;">

                        <option value="1" <?php if($resListing12a['addToCostextra']==1){ ?> selected="selected"
                            <?php } ?>>Yes</option>

                        <option value="2" <?php if($resListing12a['addToCostextra']==2){ ?> selected="selected"
                            <?php } ?>>No</option>

                    </select></td>

                <td align="center"><input
                        name="bomCommentextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        type="text"
                        id="bomCommentextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        value="<?php echo $resListing12a['bomCommentextra']; ?>" autocomplete="off" maxlength="200"
                        style="width:200px; text-align:center;">

                </td>

                <td id="loadcurrencyvalueextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                    style="display:none;"></td>

                <script>
                function change_currencya<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>(id) {

                    $('#loadcurrencyvalueextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>')
                        .load("loadcurrencyvalueextra.php?id=" + id +
                            "&lastId=<?php echo $resListing12a['matCurrencyextra']; ?>&sNo1a=<?php echo $sNo1a; ?>&costsheetVersionId=<?php echo $_REQUEST['costsheetVersionId']; ?>&totalvarcounta=<?php echo $totalvarcounta; ?>"
                            );



                }



                function convert_inra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>() {

                    //var usdvaluea = $('#bomUSDextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val();

                    //var usdvaluea = Number(usdvaluea*71);

                    //usdvaluea= parseFloat(usdvaluea).toFixed(4);

                    //$('#bomINRextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val(usdvaluea);

                }



                function value_of_ratea<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>() {



                    var inrvaluea = $('#bomINRextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>')
                        .val();

                    var lancosta = $(
                            '#landingcostperextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>')
                        .val();

                    var lanpera = Number(inrvaluea * lancosta / 100);

                    var lanratea = Number(inrvaluea) + lanpera;



                    totalinrandlandcosta = parseFloat(lanratea).toFixed(4);



                    $('#bomRateextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val(
                        totalinrandlandcosta);

                }



                function value_on_pca<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>() {



                    var bomAvga = $('#bomAvgextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>')
                        .val();



                    var bomRatea = $('#bomRateextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>')
                        .val();



                    //var bomINRextra = $('#bomINRextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val();



                    //***************************************************************************



                    <?php if($resListinga['id']==2){ ?>

                    var afterminustotal = 0;

                    var pricecal = 0;

                    var overheadper = $(
                        '#overheadper<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val();

                    var totalcostfob = $('#totalcostfob<?php echo $_REQUEST['costsheetVersionId']; ?>').text();

                    var totalpricevalsecond = document.getElementById(
                        'totalPricea<?php echo $resListinga['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>'
                        ).innerText;

                    afterminustotal = Number(totalcostfob - totalpricevalsecond);

                    pricecal = (afterminustotal * overheadper) / 100;



                    <?php if($resListing1a['name']=="Business Promotion" || $resListing1a['name']=="Duty Remission"){ ?>

                    var fobpricenewnewCal = $('#fobpricenew<?php echo $_REQUEST['costsheetVersionId']; ?>').val();

                    pricecal = (fobpricenewnewCal * overheadper) / 100;

                    <?php } ?>



                    <?php } ?>





                    <?php if($resListinga['id']==2){ ?>

                    var bomINRextra = pricecal;



                    var bomvalueonepca = Number(bomINRextra);

                    bomvalueonepca = parseFloat(bomvalueonepca).toFixed(4);



                    $('#matPriceextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val(
                        bomvalueonepca);

                    <?php }else{ ?>

                    var bomINRextra = $(
                        '#matPriceextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val();

                    var bomvalueonepca = Number(bomINRextra);

                    bomvalueonepca = parseFloat(bomvalueonepca).toFixed(4);

                    <?php } ?>





                    $('#bomvalueonepcextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val(
                        bomvalueonepca);

                }





                function calTotalCosta<?php echo $totalvarcounta.$sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>() {

                    var suma = 0;

                    // we use jQuery each() to loop through all the textbox with 'price' class

                    // and compute the sum for each loop

                    $('.pricea<?php echo $resListinga['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').each(
                        function() {

                            suma += Number($(this).val());

                        });



                    // set the computed value to 'totalPrice' textbox

                    $('#totalPricea<?php echo $resListinga['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>')
                        .val(suma);



                    suma = parseFloat(suma).toFixed(4);



                    document.getElementById(
                        "totalPricea<?php echo $resListinga['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
                        ).innerHTML = suma;



                    abc_totalgrand_first<?php echo $_REQUEST['costsheetVersionId']; ?>();

                    abc_totalgrand_second<?php echo $_REQUEST['costsheetVersionId']; ?>();

                    count_grand_total<?php echo $_REQUEST['costsheetVersionId']; ?>();

                    calculate_factory_overhead<?php echo $_REQUEST['costsheetVersionId']; ?>();





                }



                function escape_landing_costa<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>() {

                    //var usdvalue=0;

                    //var inrvaluea = $('#bomINRextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val();

                    //var currencyvalue=$('#inrvalue<?php echo $_REQUEST['costsheetVersionId']; ?>').val();

                    var matpricevalueextra = 0;

                    matpricevalueextra = $(
                        '#matPriceextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val();



                    //usdvalue=Number(inrvaluea)/Number(currencyvalue);

                    //usdvalue= parseFloat(usdvalue).toFixed(4);

                    //$('#bomUSDextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val(usdvalue);



                    $('#landingcostperextra<?php echo $sNo1; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val(0);



                    matpricevalueextra = parseFloat(matpricevalueextra).toFixed(4);

                    $('#bomRateextra<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>').val(
                        matpricevalueextra);

                }
                </script>

                <?php if($resListing1a['defaultcharesvalue']!=''){ ?>

                <script>
                escape_landing_costa<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();

                value_on_pca<?php echo $sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();

                calTotalCosta<?php echo $totalvarcounta.$sNo1a; ?><?php echo $_REQUEST['costsheetVersionId']; ?>();



                calculate_customer_markup<?php echo $_REQUEST['costsheetVersionId']; ?>();
                </script>

                <?php } ?>

            </tr>

            <?php  }  ?>

        </tbody>

    </table>

    <style>
    .total-price-extra {

        display: block;

    }
    </style>

    <div class="total-price total-price-extra">Total: <span
            class="totalPricea<?php echo $resListinga['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>"
            id="totalPricea<?php echo $resListinga['id']; ?><?php echo $_REQUEST['costsheetVersionId']; ?>">

            <?php $secondgrandtotal = $secondgrandtotal+$totalPricea; echo $totalPricea; ?>

        </span> </div>

    <?php } ?>

    <input type="hidden" name="xxy1" id="xxy1" value="<?php echo $sNo1a; ?>" />

    <script>
    function bom_total_count_extra() {

        var xxy1 = $("#xxy1").val();

        $("#bomTotalCountextra").val(xxy1);

    }

    bom_total_count_extra();
    </script>

</div>

<style>
.forbom tr:hover {

    background: #efececa6;

}
</style>

<!--end of extra charges-->

<div class="specialclassforsheet" style="display:none;">

    <table width="100%" class="table table-bordered table-responsive forbom" style="">

        <tbody style="width: 100%;display: inline-table;">

            <tr class="card-body">

                <td width="94%">Factory Overhead :</td>

                <?php

$rs1211=GetPageRecord('*','costsheetVersionMaster','styleId="'.$_REQUEST['styleId'].'" and versionId="'.$_REQUEST['costsheetVersionId'].'"');

$resListing121=mysqli_fetch_array($rs1211);

$factoryoverheadtext=$resListing121['factoryoverheadtext'];

$c16text=$resListing121['c16text'];

?>

                <td width="4%"><input type="number"
                        name="factoryoverheadtext<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="factoryoverheadtext<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        onkeyup="calculate_factory_overhead<?php echo $_REQUEST['costsheetVersionId']; ?>();"
                        value="<?php if($factoryoverheadtext!='') { echo $factoryoverheadtext;  } else { echo '60'; } ?>"
                        style="width: 50px; text-align: center;   height: auto; padding: 0px;" /></td>

                <td width="2%" align="right">%</td>

                <td width="2%" align="right"><span class="factoryoverhead<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="factoryoverhead<?php echo $_REQUEST['costsheetVersionId']; ?>"></span></td>

            </tr>

            <tr class="card-body">

                <td>Total job work charges of factory:</td>

                <td>&nbsp;</td>

                <td align="right">&nbsp;</td>

                <td align="right"><span class="totaljobworkcharges<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="totaljobworkcharges<?php echo $_REQUEST['costsheetVersionId']; ?>"></span></td>

            </tr>

            <tr class="card-body">

                <td>Total:</td>

                <td>&nbsp;</td>

                <td align="right">&nbsp;</td>

                <td align="right"><span class="totalwithoutc16<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="totalwithoutc16<?php echo $_REQUEST['costsheetVersionId']; ?>"></span></td>

            </tr>

            <tr class="card-body">

                <td>C-16 :</td>

                <td><input type="number" name="c16text<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="c16text<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        onkeyup="calculate_factory_overhead<?php echo $_REQUEST['costsheetVersionId']; ?>();"
                        value="<?php if($c16text!='') { echo $c16text;  } else { echo '10'; } ?>"
                        style="width: 50px; text-align: center;  height: auto; padding: 0px;" />

                </td>

                <td align="right">%</td>

                <td align="right"><span name="c16percent<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="c16percent<?php echo $_REQUEST['costsheetVersionId']; ?>"></span></td>

            </tr>

            <tr class="card-body">

                <td>Grand Total:</td>

                <td>&nbsp;</td>

                <td align="right">&nbsp;</td>

                <td align="right">
                    <div style="text-align:right;display:none;"><span class="grandtotal"
                            id="grandtotal<?php echo $_REQUEST['costsheetVersionId']; ?>"></span></div>

                    <span class="lastgrandtotal"
                        id="lastgrandtotal<?php echo $_REQUEST['costsheetVersionId']; ?>"></span>

                    <div style="text-align:right;display:none;"><span class="grandtotalsum"
                            id="grandtotalsum<?php echo $_REQUEST['costsheetVersionId']; ?>"></span></div>

                    <div style="text-align:right;display:none;"><span class="finaltotalcostsheet"
                            id="finaltotalcostsheet<?php echo $_REQUEST['costsheetVersionId']; ?>"></span></div>

                    <div style="text-align:right;display:none;"><span class="secondwalagrandtotal"
                            id="secondwalagrandtotal<?php echo $_REQUEST['costsheetVersionId']; ?>"></span></div>
                </td>

            </tr>

        </tbody>

    </table>

</div>

<!--new apparel configuration-->

<div class="specialclassforsheet" <?php if($_REQUEST['page']!='costsheet') { ?> style="display:none;" <?php } ?>>

    <table width="100%" class="table table-bordered table-responsive forbom" style=" overflow:hidden !important;">

        <tbody style="width: 100%;display: inline-table;">

            <tr class="card-body">

                <?php

$rs1211=GetPageRecord('*','costsheetVersionMaster','styleId="'.$_REQUEST['styleId'].'" and versionId="'.$_REQUEST['costsheetVersionId'].'"');

$resListing121=mysqli_fetch_array($rs1211);

?>

            <tr class="card-body">

                <td>PRODUCT COST :</td>

                <td>&nbsp;</td>

                <td align="right">&nbsp;</td>

                <td align="right"><span class="totalcostfob<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="totalcostfob<?php echo $_REQUEST['costsheetVersionId']; ?>"><?php echo $resListing121['totalcostfob']; ?></span>
                </td>

            </tr>

            <tr class="card-body">

                <td width="94%">Markup :</td>

                <td width="4%"><input type="number" name="customermarkup<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="customermarkup<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        onkeyup="calculate_customer_markup<?php echo $_REQUEST['costsheetVersionId']; ?>();"
                        value="<?php echo $resListing121['customermarkupvalue']; ?>"
                        style="width: 50px; text-align: center;   height: auto; padding: 0px; display:none;" /></td>

                <td width="2%" align="right">&nbsp;</td>

                <td width="2%" align="right"><span
                        class="customermarkupvalue<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="customermarkupvalue<?php echo $_REQUEST['costsheetVersionId']; ?>"><?php echo $resListing121['customermarkupvalue']; ?></span>
                </td>

            </tr>

            <tr class="card-body">

                <td>FOB Price :</td>

                <td><input type="number" name="fobpricenew<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="fobpricenew<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        onkeyup="calculate_customer_markup<?php echo $_REQUEST['costsheetVersionId']; ?>();"
                        value="<?php echo $resListing121['fobpricenew']; ?>"
                        style="width: 95px; text-align: center;   height: auto; padding: 0px;" /></td>

                <td align="right">&nbsp;</td>

                <td align="right"><span class="sellingprice<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="sellingprice<?php echo $_REQUEST['costsheetVersionId']; ?>"><?php echo $resListing121['sellingprice']; ?></span>
                </td>

            </tr>

            <tr class="card-body">

                <td width="94%">Commission/Discount on FOB Price :</td>

                <td width="4%"><input type="text"
                        name="discountsellingprice<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="discountsellingprice<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        onkeyup="calculate_customer_markup<?php echo $_REQUEST['costsheetVersionId']; ?>();"
                        value="<?php echo $brandData['discount']; ?>"
                        style="width: 95px; text-align: center;   height: auto; padding: 0px; background-color:#f3f3f3;"
                        readonly="" /></td>

                <td width="2%" align="right">%</td>

                <td width="2%" align="right"><span
                        class="discountsellingpricevalue<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="discountsellingpricevalue<?php echo $_REQUEST['costsheetVersionId']; ?>"><?php echo $resListing121['discountsellingpricevalue']; ?></span>
                </td>

            </tr>

            <tr class="card-body">

                <td>Effective FOB Price :</td>

                <td>&nbsp;</td>

                <td align="right">&nbsp;</td>

                <td align="right"><span class="effectivesellingprice<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="effectivesellingprice<?php echo $_REQUEST['costsheetVersionId']; ?>"><?php echo $resListing121['effectivesellingprice']; ?></span>
                </td>

            </tr>

            <tr class="card-body">

                <td>Profit/Loss :</td>

                <td>&nbsp;</td>

                <td align="right">&nbsp;</td>

                <td align="right"><span class="profit<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="profit<?php echo $_REQUEST['costsheetVersionId']; ?>"><?php echo $resListing121['profit']; ?></span>
                </td>

            </tr>

            <tr class="card-body">

                <td>Profit/Loss % :</td>

                <td>&nbsp;</td>

                <td align="right">&nbsp;</td>

                <td align="right" style="background-color: #f7f7f7;font-weight: 600;"><span
                        class="profitlosspercent<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="profitlosspercent<?php echo $_REQUEST['costsheetVersionId']; ?>"><?php echo $resListing121['profitlosspercent']; ?></span>
                </td>

            </tr>

            <tr class="card-body" style="display:none;">

                <td width="94%">Factory Overhead :</td>

                <?php

$rs1211=GetPageRecord('*','costsheetVersionMaster','styleId="'.$_REQUEST['styleId'].'" and versionId="'.$_REQUEST['costsheetVersionId'].'"');

$resListing121=mysqli_fetch_array($rs1211);

$factoryoverheadtext=$resListing121['factoryoverheadtext'];

$c16text=$resListing121['c16text'];

?>

                <td width="4%"><input type="number"
                        name="factoryoverheadtext<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="factoryoverheadtext<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        onkeyup="calculate_factory_overhead<?php echo $_REQUEST['costsheetVersionId']; ?>();"
                        value="<?php if($factoryoverheadtext!='') { echo $factoryoverheadtext;  } else { echo '60'; } ?>"
                        style="width: 50px; text-align: center;   height: auto; padding: 0px;" /></td>

                <td width="2%" align="right">%</td>

                <td width="2%" align="right"><span class="factoryoverhead<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="factoryoverhead<?php echo $_REQUEST['costsheetVersionId']; ?>"></span></td>

            </tr>

            <tr class="card-body" style="display:none;">

                <td>Total job work charges of factory:</td>

                <td>&nbsp;</td>

                <td align="right">&nbsp;</td>

                <td align="right"><span class="totaljobworkcharges<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="totaljobworkcharges<?php echo $_REQUEST['costsheetVersionId']; ?>"></span></td>

            </tr>

            <tr class="card-body" style="display:none;">

                <td>Total:</td>

                <td>&nbsp;</td>

                <td align="right">&nbsp;</td>

                <td align="right"><span class="totalwithoutc16<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="totalwithoutc16<?php echo $_REQUEST['costsheetVersionId']; ?>"></span></td>

            </tr>

            <tr class="card-body" style="display:none;">

                <td>C-16 :</td>

                <td><input type="number" name="c16text<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="c16text<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        onkeyup="calculate_factory_overhead<?php echo $_REQUEST['costsheetVersionId']; ?>();"
                        value="<?php if($c16text!='') { echo $c16text;  } else { echo '10'; } ?>"
                        style="width: 50px; text-align: center;  height: auto; padding: 0px;" />

                </td>

                <td align="right">%</td>

                <td align="right"><span name="c16percent<?php echo $_REQUEST['costsheetVersionId']; ?>"
                        id="c16percent<?php echo $_REQUEST['costsheetVersionId']; ?>"></span></td>

            </tr>

            <tr class="card-body" style="display:none;">

                <td>Grand Total:</td>

                <td>&nbsp;</td>

                <td align="right">&nbsp;</td>

                <td align="right">
                    <div style="text-align:right;display:none;"><span class="grandtotal"
                            id="grandtotal<?php echo $_REQUEST['costsheetVersionId']; ?>"></span></div>

                    <span class="lastgrandtotal"
                        id="lastgrandtotal<?php echo $_REQUEST['costsheetVersionId']; ?>"></span>

                    <div style="text-align:right;display:none;"><span class="grandtotalsum"
                            id="grandtotalsum<?php echo $_REQUEST['costsheetVersionId']; ?>"></span></div>

                    <div style="text-align:right;display:none;"><span class="finaltotalcostsheet"
                            id="finaltotalcostsheet<?php echo $_REQUEST['costsheetVersionId']; ?>"></span></div>

                    <div style="text-align:right;display:none;"><span class="secondwalagrandtotal"
                            id="secondwalagrandtotal<?php echo $_REQUEST['costsheetVersionId']; ?>"></span></div>
                </td>

            </tr>

        </tbody>

    </table>

</div>

<!--new apparel configuration-->

<style>
.main-class {

    width: 50% !important;

    float: right !important;

    display: block !important;

    margin-left: 50% !important;

    background-color: #fffad5;

}
</style>

<!--find grand total-->

<script>
abc_totalgrand_first<?php echo $_REQUEST['costsheetVersionId']; ?>();

abc_totalgrand_second<?php echo $_REQUEST['costsheetVersionId']; ?>();





count_grand_total<?php echo $_REQUEST['costsheetVersionId']; ?>();



calculate_factory_overhead<?php echo $_REQUEST['costsheetVersionId']; ?>();
</script>

<script>
function add_load_bom_list_fun<?php echo $_REQUEST['costsheetVersionId']; ?>(sr, materialtype, costsheetVersionId,
    materialid) {

    $('#load_bom_list<?php echo $_REQUEST['costsheetVersionId']; ?>').load(
        "load_bom_list.php?styleId=<?php echo $_REQUEST['styleId'];?>&page=<?php echo $_REQUEST['page']; ?>&subCategoryId=<?php echo $_REQUEST['subCategoryId'];?>&sr=" +
        sr + '&materialtype=' + materialtype + '&costsheetVersionId=' + costsheetVersionId + '&materialid=' +
        materialid);
}



function delete_load_bom_list_fun<?php echo $_REQUEST['costsheetVersionId']; ?>(id, materialtype, costsheetVersionId) {



    var r = confirm("Are you sure you want to delete this record?");

    if (r == true) {

        $('#load_bom_list<?php echo $_REQUEST['costsheetVersionId']; ?>').load(
            "load_bom_list.php?styleId=<?php echo $_REQUEST['styleId'];?>&page=<?php echo $_REQUEST['page']; ?>&subCategoryId=<?php echo $_REQUEST['subCategoryId'];?>&deleteid=" +
            id + '&materialtype=' + materialtype + '&costsheetVersionId=' + costsheetVersionId);

    }





}
</script>

<style>
.specialclassforsheet {

    width: 100%;

}

.specialclassforsheetsecond {

    width: 100%;

}
</style>

<style>
/* Hide the browser's default checkbox */

.container input[type=checkbox] {

    position: absolute;

    opacity: 0;

    cursor: pointer;

    height: 0;

    width: 0;

}



/* Create a custom checkbox */

.container .checkmark {

    position: absolute;

    top: 1px;

    left: 0px;

    height: 17px;

    width: 20px;

    background-color: #eee;

}



/* On mouse-over, add a grey background color */

.container input[type=checkbox]~.checkmark {

    background-color: #ccc;

}



/* When the checkbox is checked, add a blue background */

.container input[type=checkbox]:checked~.checkmark {

    background-color: #2196F3;

}



/* Create the checkmark/indicator (hidden when not checked) */

.container .checkmark:after {

    content: "";

    position: absolute;

    display: none;

}



/* Show the checkmark when checked */

.container input[type=checkbox]:checked~.checkmark:after {

    display: block;

}



/* Style the checkmark/indicator */

.container .checkmark:after {

    left: 8px;

    top: 2px;

    width: 5px;

    height: 10px;

    border: solid white;

    border-width: 0 3px 3px 0;

    -webkit-transform: rotate(45deg);

    -ms-transform: rotate(45deg);

    transform: rotate(45deg);

}

.container {

    display: block;

    position: relative;

    padding-left: 0px;

    margin-bottom: 10px;

    cursor: pointer;

    font-size: 14px;

    user-select: none;

    font-weight: 400;

    width: 19px;

    float: left;

    margin-right: 5px;

}
</style>

<!--use loader till data has loaded-->

<div class="loader"></div>

<!--end of loader-->

<script>
function saveallmaterial<?php echo $_REQUEST['costsheetVersionId']; ?>() {

    $(".loader").css("display", "block");

    $('.loader').fadeIn('slow', function() {

        $('.loader').delay(1000).fadeOut();

    });



    <?php echo $allfunction; ?>

}



function saveallbom<?php echo $_REQUEST['costsheetVersionId']; ?>(stylesubtabid, sr, vid) {



    var bomAvg = $('#bomAvg' + sr + vid).val();

    var bomUnit = $('#bomUnit' + sr + vid).val();

    var wastagePersent = $('#wastagePersent' + sr + vid).val();

    var avgIncWastage = $('#avgIncWastage' + sr + vid).val();

    var bomUSD = $('#bomUSD' + sr + vid).val();

    var bomINR = $('#bomINR' + sr + vid).val();

    var landingcostper = $('#landingcostper' + sr + vid).val();

    var bomRate = $('#bomRate' + sr + vid).val();

    var bomvalueonepc = $('#bomvalueonepc' + sr + vid).val();

    var cvId = $('#cvId').val();



    var storesupplier = encodeURI($('#storesupplier' + sr + vid).val());

    var bomComment = encodeURI($('#bomComment' + sr + vid).val());

    var addToCost = $('#addToCost' + sr + vid).val();



    var bomWidth = $('#bomWidth' + sr + vid).val();
    var bomWidthUnit = $('#bomWidthUnit' + sr + vid).val();
    var matPrice = $('#matPrice' + sr + vid).val();

    var matCurrency = $('#matCurrency' + sr + vid).val();

    var bomPlacement = $('#bomPlacement' + sr + vid).val();

    var qualityapproveddate = $('#qualityapproveddate' + sr + vid).val();
    var artworkno = $('#artworkno' + sr + vid).val();
    var cadgivendate = $('#cadgivendate' + sr + vid).val();
    var labdipdate = $('#labdipdate' + sr + vid).val();
    var labdiproundtwo = $('#labdiproundtwo' + sr + vid).val();

    var supplierartname = $('#supplierartname' + sr + vid).val();

    var buyerNominated = $('#buyerNominated' + sr + vid).val();

    var finish = $('#finish' + sr + vid).val();



    var trimColor1 = encodeURI($('#trimColor1' + sr + vid).val());

    var trimColor2 = encodeURI($('#trimColor2' + sr + vid).val());

    var trimColor3 = encodeURI($('#trimColor3' + sr + vid).val());

    var trimColor4 = encodeURI($('#trimColor4' + sr + vid).val());

    var trimColor5 = encodeURI($('#trimColor5' + sr + vid).val());

    var trimColor6 = encodeURI($('#trimColor6' + sr + vid).val());

    var trimColor7 = encodeURI($('#trimColor7' + sr + vid).val());

    var trimColor8 = encodeURI($('#trimColor8' + sr + vid).val());

    var trimColor9 = encodeURI($('#trimColor9' + sr + vid).val());

    var trimColor10 = encodeURI($('#trimColor10' + sr + vid).val());



    if (bomAvg != '' || bomWidth != '') {

        $('#loadallaction<?php echo $costsheetVersionId; ?>').load("newaction.php?action2=techpackversion&versionId=" +
            vid + "&editId=<?php echo encode($_REQUEST['styleId']); ?>&bomAvg=" + bomAvg + "&bomUnit=" + bomUnit +
            "&bomUSD=" + bomUSD + "&bomINR=" + bomINR + "&landingcostper=" + landingcostper + "&bomRate=" +
            bomRate + "&bomvalueonepc=" + bomvalueonepc + "&bomSerialNo=" + sr + "&cvId=" + cvId + "&bomWidth=" +
            bomWidth + "&wastagePersent=" + wastagePersent + "&avgIncWastage=" + avgIncWastage + "&storesupplier=" +
            storesupplier + "&bomComment=" + bomComment + "&addToCost=" + addToCost + "&stylesubtabid=" +
            stylesubtabid + "&matPrice=" + matPrice + "&matCurrency=" + matCurrency + "&bomPlacement=" +
            bomPlacement + "&qualityapproveddate=" + qualityapproveddate + "&supplierartname=" + supplierartname +
            "&buyerNominated=" + buyerNominated + "&finish=" + finish + "&trimColor1=" + trimColor1 +
            "&trimColor2=" + trimColor2 + "&trimColor3=" + trimColor3 + "&trimColor4=" + trimColor4 +
            "&trimColor5=" + trimColor5 + "&trimColor6=" + trimColor6 + "&trimColor7=" + trimColor7 +
            "&trimColor8=" + trimColor8 + "&trimColor9=" + trimColor9 + "&trimColor10=" + trimColor10 +
            "&artworkno=" + artworkno + "&cadgivendate=" + cadgivendate + "&labdipdate=" + labdipdate +
            "&labdiproundtwo=" + labdiproundtwo+"&bomWidthUnit=" + bomWidthUnit);

    }



}



function delete_material<?php echo $_REQUEST['costsheetVersionId']; ?>() {

    $('#loadallactiondelete<?php echo $costsheetVersionId; ?>').load(
        "newaction.php?action=materiallistdelete&versionId=<?php echo $_REQUEST['costsheetVersionId']; ?>&editId=<<?php echo encode($_REQUEST['styleId']); ?>"
        );

}
</script>

<div id="loadallaction<?php echo $costsheetVersionId; ?>" style="display:none;"></div>

<div id="loadallactiondelete<?php echo $costsheetVersionId; ?>" style="display:none;"></div>

<script>
function saveallmaterialextra<?php echo $_REQUEST['costsheetVersionId']; ?>() {

    $(".loader").css("display", "block");

    $('.loader').fadeIn('slow', function() {

        $('.loader').delay(1000).fadeOut();

    });



    <?php echo $allfunctionexcharges; ?>

}



function saveallbomexcharges<?php echo $_REQUEST['costsheetVersionId']; ?>(sr, vid) {

    var bomAvg = $('#bomAvgextra' + sr + vid).val();

    var bomUnit = $('#bomUnitextra' + sr + vid).val();

    var bomUSD = $('#bomUSDextra' + sr + vid).val();

    var bomINR = $('#bomINRextra' + sr + vid).val();

    var landingcostper = $('#landingcostperextra' + sr + vid).val();



    var matPriceextra = $('#matPriceextra' + sr + vid).val();

    var matCurrencyextra = $('#matCurrencyextra' + sr + vid).val();

    var overheadper = $('#overheadper' + sr + vid).val();



    var addToCostextra = $('#addToCostextra' + sr + vid).val();

    var bomCommentextra = encodeURI($('#bomCommentextra' + sr + vid).val());





    var bomRate = $('#bomRateextra' + sr + vid).val();

    var bomvalueonepc = $('#bomvalueonepcextra' + sr + vid).val();

    var cvId = $('#cvId').val();



    if (matPriceextra != '' && matCurrencyextra != '') {



        $('#loadallactionextra<?php echo $costsheetVersionId; ?>').load(
            "newaction.php?action3=techpackversionextra&versionId=" + vid +
            "&editId=<?php echo encode($_REQUEST['styleId']); ?>&bomAvg=" + bomAvg + "&bomUnit=" + bomUnit +
            "&bomUSD=" + bomUSD + "&bomINR=" + bomINR + "&landingcostper=" + landingcostper + "&bomRate=" +
            bomRate + "&bomvalueonepc=" + bomvalueonepc + "&bomSerialNo=" + sr + "&cvId=" + cvId +
            "&addToCostextra=" + addToCostextra + "&bomCommentextra=" + bomCommentextra + "&matPriceextra=" +
            matPriceextra + "&matCurrencyextra=" + matCurrencyextra + "&overheadper=" + overheadper);

    }

}



function delete_material_extra<?php echo $_REQUEST['costsheetVersionId']; ?>() {

    $('#loadallactionextradelete<?php echo $costsheetVersionId; ?>').load(
        "newaction.php?action=materiallistdeleteextra&versionId=<?php echo $_REQUEST['costsheetVersionId']; ?>&editId=<<?php echo encode($_REQUEST['styleId']); ?>"
        );

}



function addfinaldata<?php echo $_REQUEST['costsheetVersionId']; ?>() {

    var vid = '<?php echo $_REQUEST['costsheetVersionId']; ?>';

    var factoryoverheadtext = $('#factoryoverheadtext<?php echo $_REQUEST['costsheetVersionId']; ?>').val();

    var c16text = $('#c16text<?php echo $_REQUEST['costsheetVersionId']; ?>').val();

    var totalmrp = $('#totalmrp<?php echo $_REQUEST['costsheetVersionId']; ?>').val();



    var mrptotallast = document.getElementById('mrptotallast<?php echo $_REQUEST['costsheetVersionId']; ?>').innerText;

    var finalgrandtotalwithmrp = document.getElementById(
        'finalgrandtotalwithmrp<?php echo $_REQUEST['costsheetVersionId']; ?>').innerText;





    //////////////////new cost sheet column///////////

    var factoryoverheadafterper = $('#factoryoverhead<?php echo $_REQUEST['costsheetVersionId']; ?>').text();

    var totaljobworkcharges = $('#totaljobworkcharges<?php echo $_REQUEST['costsheetVersionId']; ?>').text();

    var totalwithoutc16 = $('#totalwithoutc16<?php echo $_REQUEST['costsheetVersionId']; ?>').text();

    var c16percent = $('#c16percent<?php echo $_REQUEST['costsheetVersionId']; ?>').text();

    ////////////END////////////


    // add new cost sheet apparel save

    var totalcostfob = $('#totalcostfob<?php echo $_REQUEST['costsheetVersionId']; ?>').text();

    var customermarkup = $('#customermarkup<?php echo $_REQUEST['costsheetVersionId']; ?>').val();



    var fobpricenew = $('#fobpricenew<?php echo $_REQUEST['costsheetVersionId']; ?>').val();



    var sellingprice = $('#sellingprice<?php echo $_REQUEST['costsheetVersionId']; ?>').text();

    var customermarkupvalue = $('#customermarkupvalue<?php echo $_REQUEST['costsheetVersionId']; ?>').text();

    var discountsellingprice = $('#discountsellingprice<?php echo $_REQUEST['costsheetVersionId']; ?>').val();

    var discountsellingpricevalue = $('#discountsellingpricevalue<?php echo $_REQUEST['costsheetVersionId']; ?>')
.text();

    var effectivesellingprice = $('#effectivesellingprice<?php echo $_REQUEST['costsheetVersionId']; ?>').text();

    var profit = $('#profit<?php echo $_REQUEST['costsheetVersionId']; ?>').text();



    var inrvalue = $('#inrvalue<?php echo $_REQUEST['costsheetVersionId']; ?>').val();

    var bidinrvalue = $('#bidinrvalue<?php echo $_REQUEST['costsheetVersionId']; ?>').val();





    var profitlosspercent = $('#profitlosspercent<?php echo $_REQUEST['costsheetVersionId']; ?>').text();



    // add new cost sheet apparel save




    $('#loadfinalall<?php echo $costsheetVersionId; ?>').load("newaction.php?action=toaladdfinal&versionId=" + vid +
        "&editId=<?php echo encode($_REQUEST['styleId']); ?>&factoryoverheadtext=" + factoryoverheadtext +
        "&c16text=" + c16text + "&totalmrp=" + totalmrp + "&mrptotallast=" + mrptotallast +
        "&finalgrandtotalwithmrp=" + finalgrandtotalwithmrp + "&factoryoverheadafterper=" +
        factoryoverheadafterper + "&totaljobworkcharges=" + totaljobworkcharges + "&totalwithoutc16=" +
        totalwithoutc16 + "&c16percent=" + c16percent + "&totalcostfob=" + totalcostfob + "&customermarkup=" +
        customermarkup + "&customermarkupvalue=" + customermarkupvalue + "&discountsellingprice=" +
        discountsellingprice + "&discountsellingpricevalue=" + discountsellingpricevalue +
        "&effectivesellingprice=" + effectivesellingprice + "&profit=" + profit + "&sellingprice=" + sellingprice +
        "&inrvalue=" + inrvalue + "&profitlosspercent=" + profitlosspercent + "&bidinrvalue=" + bidinrvalue +
        "&fobpricenew=" + fobpricenew);

}
</script>

<div id="loadallactionextra<?php echo $costsheetVersionId; ?>" style="display:none;"></div>

<div id="loadallactionextradelete<?php echo $costsheetVersionId; ?>" style="display:none;"></div>

<div id="loadfinalall<?php echo $costsheetVersionId; ?>" style="display:none;"></div>

<div id="success" class="successcomment"><i class="fa fa-check" style="margin-right:5px;"></i>Your data has been
    Submitted Successfully</div>

<style>
.forbom [class*=bg-]:not(.bg-transparent):not(.bg-light):not(.bg-white):not(.btn-outline):not(body) {

    color: #fff;

    width: 135px !important;

    font-size: 12px;

}



.loader {

    position: fixed;

    display: none;

    left: 0px;

    top: 0px;

    width: 100%;

    height: 100%;

    z-index: 9999;

    background: url(images/pageLoader.gif) 50% 50% no-repeat rgb(236, 240, 241);

    opacity: 0.8;

}

.table-hide-show {

    text-transform: uppercase;

}



.select2-container {

    width: 100% !important;

}

.fa-plus-circle,
.fa-minus-circle {

    font-size: 23px;

}
</style>

<?php

$k=GetPageRecord('*','queryMaster','subCategoryId="'.$_REQUEST['subCategoryId'].'"');

$categoryId=mysqli_fetch_array($k);



$r=GetPageRecord('*','materialConfigurationMaster','categoryId="'.$categoryId['categoryId'].'"');

$materialConfi=mysqli_fetch_array($r);

?>

<script>
//$('#table-hide-showw11').text("<?php echo $materialConfi['fabric']; ?>");

//$('#table-hide-showw21').text("<?php echo $materialConfi['trim']; ?>");

//$('#table-hide-showw31').text("<?php echo $materialConfi['packaging']; ?>");
</script>