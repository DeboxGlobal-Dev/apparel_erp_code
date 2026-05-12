<div class="page-content">
    <div class="content-wrapper">
        <div class="content pt-0" style="margin-top:20px;">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
                        <div class="col-xl-9">
                            <h5 class="card-title"><?php echo $pageName; ?></h5>
                        </div>
                        <div class="col-xl-3" style="padding-right: 0px;"></div>
                    </div>
                    <div class="card" style="padding-bottom:0px;">
                        <?php
$quarterIdvalue=$_POST['quarterId'];
?>
                        <div class="col-md-12" style="margin-top: 20px; padding: 0px 15px;">
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" placeholder="Search:" name="filtersearch"
                                                id="filtersearch" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <select name="stylerefid" id="stylerefid" class="select2 form-control">
                                                <option value="">Select Style</option>
                                                <?php
			 	$fcref=GetPageRecord('*','queryMaster','1 and deleteStatus=0 and subject!=""  order by id desc');
				while($refData=mysqli_fetch_array($fcref)){ ?>
                                                <option value="<?php echo encode($refData['id']); ?>"
                                                    <?php if(decode($_POST['stylerefid'])==$refData['id']){ ?>
                                                    selected="selected" <?php } ?>><?php echo $refData['styleRefId']; ?>
                                                </option>
                                                <?php } ?>
                                            </select>


                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <select name="quarterId[]" id="quarterId" multiple="multiple"
                                                class="form-control">
                                                <?php
$fc=GetPageRecord('*','materialTypeMaster','1 order by id');
while($catData=mysqli_fetch_array($fc)){
$checked='';
if(in_array($catData['id'],$quarterIdvalue)){
$checked='selected';
}
?>
                                                <option value="<?php echo $catData['id']; ?>" <?php echo $checked; ?>>
                                                    <?php echo $catData['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <script>
                                    $(function() {
                                        $('#quarterId').multiselect({
                                            includeSelectAllOption: true,
                                            enableFiltering: true,
                                            enableCaseInsensitiveFiltering: true,
                                            filterPlaceholder: 'Search...'
                                        });
                                    });
                                    </script>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <input name="" type="submit" id="" class=" btn btn-primary"
                                                value="Search" />
                                            <input name="module" id="module" type="hidden"
                                                value="<?php echo $_REQUEST['module']; ?>" />

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <!-- <div class="form-group">

                                            <a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes"
                                                class=" btn btn-primary"> View Opening Balance</a>
                                        </div> -->
                                    </div>
                                    <div class="col-md-2">
                                        <!-- <div class="form-group">

                                            <a href="showpage.crm?module=materialwiseinventory"
                                                class=" btn btn-success"> Material Wise Inventory</a>
                                        </div> -->
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div>
                            <table class="table table-bordered capacity-class" style="width:100%;">
                                <?php
						$qq=GetPageRecord('*','materialTypeMaster','1 order by id');
						while($matrialData=mysqli_fetch_array($qq)){
						if(in_array($matrialData['id'],$quarterIdvalue) || $quarterIdvalue==""){
						?>
                                <tr style="background-color: #fff7b3;">
                                    <th colspan="8" align="left">
                                        <div align="left" style="text-transform:uppercase; ">
                                            <?php echo $matrialData['name']; ?></div>
                                    </th>
                                </tr>
                                <tr style="background-color:#fff;">
                                    <td colspan="8">
                                        <table class="" style="width:100%;">
                                            <tr style="background-color: #e9fff8;">
                                                <th>
                                                    <div align="left">Style</div>
                                                </th>

                                                <th>
                                                    <div align="left">Style Type</div>
                                                </th>

                                                <th>
                                                    <div align="left">Brand</div>
                                                </th>
                                                <th>
                                                    <div align="left">Merchant</div>
                                                </th>
                                                <th>
                                                    <div align="left">Order Qty. </div>
                                                </th>
                                                <th>
                                                    <div align="left">PCD</div>
                                                </th>
                                                <!-- <th>
                                                    <div align="left">Coverage Bar</div>
                                                </th> -->
                                                <th>
                                                    <div align="left">X/F Start </div>
                                                </th>
                                                <th>
                                                    <div align="left">X/F End</div>
                                                </th>
                                            </tr>
                                            <tbody id="allhotellisting">

                                                <?php

if($_POST['stylerefid']!=''){
$stylerefCondition = 'and id="'.decode($_POST['stylerefid']).'"';
}

// $bd=GetPageRecord('*','queryMaster','1 and subject!="" '.$stylerefCondition.' and deletestatus=0 and sampleStyle=1 and poAttachment!="" order by id desc');

$bd=GetPageRecord('*','queryMaster','1 and subject!="" '.$stylerefCondition.' and deletestatus=0  and  ( (poAttachment!="" and sampleStyle=1 )or  sampleStyle=2 ) order by id desc');

while($queryData=mysqli_fetch_array($bd)){

$rsqty=GetPageRecord('qtyTotal','buyerPurchaseOrderMaster','styleId="'.$queryData['id'].'"');
$resultqty=mysqli_fetch_array($rsqty);

$tnadata="";
$tnadataaaaa="";
$tnadataq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$queryData['id'].'" and taskListId in (select id from taskListMaster where name in (select id from tnaActivityMaster where name="Ex-Factory Start Date")) order by id');
$tnadata=mysqli_fetch_array($tnadataq);

$tnadataaaaaq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$queryData['id'].'" and taskListId in (select id from taskListMaster where name in (select id from tnaActivityMaster where name="Ex-Factory End Date")) order by id');
$tnadataaaaa=mysqli_fetch_array($tnadataaaaaq);


						?>

                                                <tr>
                                                    <td>
                                                        <div align="left"><a
                                                                href="showpage.crm?module=<?php echo $_GET['module']; ?>&view=yes&id=<?php echo encode($queryData['id']); ?>&materialType=<?php echo encode($matrialData['id']); ?>"><?php echo '#'.$queryData['styleRefId']; ?>
                                                            </a></div>
                                                    </td>
                                                    <td><?php if($queryData['sampleStyle']==1){ ?> Bulk Style
                                                        <?php }elseif($queryData['sampleStyle']==2) { ?> Sampling Style
                                                        <?php  }  ?></td>

                                                    <td>
                                                        <div align="left">
                                                            <?php echo getBrandName($queryData['brandId']); ?></div>
                                                    </td>
                                                    <td>
                                                        <div align="left">
                                                            <?php echo getUserName($queryData['assignTo']); ?></div>
                                                    </td>
                                                    <td>
                                                        <div align="left"><?php echo $resultqty['qtyTotal']; ?></div>
                                                    </td>
                                                    <td>
                                                        <div align="left">
                                                            <?php if($queryData['pcdDate']!='0000-00-00' && $queryData['pcdDate']!='' && $queryData['pcdDate']!='1970-01-01'){  echo date('d-m-Y', strtotime($queryData['pcdDate'])); } ?>
                                                        </div>
                                                    </td>
                                                    <!-- <td>
                                                        <div align="left">-</div>
                                                    </td> -->
                                                    <td>
                                                        <div align="left">
                                                            <?php if($tnadata['complitionDate']!='' && $tnadata['complitionDate']!='1970-01-01' && $tnadata['complitionDate']!='0000-00-00'){ echo date('d-m-Y', strtotime($tnadata['complitionDate'])); } ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div align="left">
                                                            <?php if($tnadataaaaa['complitionDate']!='' && $tnadataaaaa['complitionDate']!='1970-01-01' && $tnadataaaaa['complitionDate']!='0000-00-00'){ echo date('d-m-Y', strtotime($tnadataaaaa['complitionDate'])); } ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <?php } } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
$(document).ready(function() {
    $("#filtersearch").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#allhotellisting tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>