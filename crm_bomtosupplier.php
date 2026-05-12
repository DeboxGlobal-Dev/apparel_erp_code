<div class="page-content">

  <div class="content-wrapper">

    <?php include "savealert.php"; ?>

    <div class="content pt-0 filterable" style="margin-top:20px;">

      <div class="row">

        <div class="col-xl-12">

          <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">

            <div class="col-xl-12">

              <h5 class="card-title" ><?php echo $pageName; ?></h5>

            </div>



          </div>



          <div class="card">

            <div class="row" style="margin-top:20px;">

              <div class="col-md-12" style=" padding:0px 25px;">

                <!--<form action="" method="get">-->

                <!--  <div class="row">-->

                <!--    <div class="col-md-2">-->

                <!--      <div class="form-group">-->

                <!--        <input type="text" placeholder="Search:" name="filtersearch" id="filtersearch" class="form-control"/>-->

                <!--      </div>-->

                <!--    </div>-->

                <!--    <div class="col-md-2">-->

                <!--      <div class="form-group">-->

                <!--        <input name="" type="submit" id="" class=" btn btn-primary" value="Search" />-->

                <!--        <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />-->

                <!--      </div>-->

                <!--    </div>-->

                <!--  </div>-->

                <!--</form>-->

              </div>

            </div>

			<div id="collapsible-control-right-group1" class="collapse" style="display:block;">

            <div class="card-body">

              <ul class="nav nav-tabs nav-tabs-highlight nav-justified">

                <li class="nav-item"><a href="#highlighted-justified-tab1" class="nav-link active show" data-toggle="tab"><strong>Fabric/Trim/Packaging</strong></a></li>

                <li class="nav-item"><a href="#highlighted-justified-tab2" class="nav-link" data-toggle="tab"><strong>Maintenance & G.I</strong></a></li>

              </ul>

              <div class="tab-content">

                <div class="tab-pane fade active show" id="highlighted-justified-tab1">

                 <form name="listform" id="listform" method="get">

                <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />

				<div class="col-md-12" style="padding:0px;">
				   <label>
                    <select name="supplierId" id="supplierId" class="select2" style="margin-left: 10px; width: 250px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;">
                      <option value="">Select Supplier</option>
                      <?php
			 	$fcref=GetPageRecord('name,id','suppliersMaster',' 1 and deletestatus=0 order by name asc');
				while($refData=mysqli_fetch_array($fcref)){ ?>
                      <option value="<?php echo encode($refData['id']); ?>" <?php if(decode($_GET['supplierId'])==$refData['id']){ ?> selected="selected" <?php } ?>><?php echo $refData['name']; ?></option>
                      <?php } ?>
                    </select>
                    </label>

					<label>
                    <select name="styleId" id="styleId" class="select2" style="margin-left: 10px; width: 250px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;">
                      <option value="">Select Style</option>
                      <?php
			 	$fcref=GetPageRecord('*','queryMaster',''.$wheresearchassign.' deleteStatus=0 and subject!="" and sampleStyle=1 order by id desc');
				while($refData=mysqli_fetch_array($fcref)){ ?>
                      <option value="<?php echo encode($refData['id']); ?>" <?php if(decode($_GET['styleId'])==$refData['id']){ ?> selected="selected" <?php } ?>><?php echo $refData['styleRefId']; ?></option>
                      <?php } ?>
                    </select>
                    </label>
					 <label>
                    <input name="" type="submit" id="" class="" value="search" style="text-transform: uppercase; background-color: #03c28d; color: #fff; width: 150px; cursor:pointer;padding: 7px;"/>
                    </label>

                   </div>

                <div id="pageload">

                  <div id="" >

                    <div class="datatable-scroll">

                      <table class="table table-bordered" style="width:100%;">

                        <thead style="background-color: #f5f5f5;">

                          <tr role="row">



								<th>Supplier Name</th>

								<th>Supplier&nbsp;Id</th>

								<th  style="width: 30%;">Style&nbsp;Id&nbsp;-&nbsp;Buyer&nbspName&nbsp;-&nbsp;Brand</th>

								<th style="width: 10%;" align="center">Total&nbsp;Material</th>

								<th style="width: 10%;" align="center">Pending&nbsp;For&nbsp;PO</th>

								<th>Date</th>

					  </tr>

                        </thead>

                         <tbody id="allhotellisting">

                      <?php

$no=1;

$select='*';

$where='';

$rs='';

$wheresearch='';

//$limit='20000';

$limit=clean($_GET['records']);

if($_GET['supplierId']!=''){
	$supplierId = ' and supplierId="'.decode($_GET['supplierId']).'"';
}

if($_GET['styleId']!=''){
	$styleId = ' and styleId="'.decode($_GET['styleId']).'"';
}

$where='where 1 '.$supplierId.'  '.$styleId.'  group By createdDate,supplierId order by createdDate desc';



$page=$_GET['page'];



$targetpage=$fullurl.'showpage.crm?module="'.$modfile['url'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';



$rs=GetRecordList($select,'indentCreationMaster',$where,$limit,$page,$targetpage);

$totalentry=$rs[1];

if($totalentry=1){

$totalentry=2;

}

$paging=$rs[2];

while($resultlists=mysqli_fetch_array($rs[0])){



if($resultlists['supplierId']!=0){



$list=GetPageRecord('*','indentCreationMaster','1 and supplierId="'.$resultlists['supplierId'].'" and createdDate="'.$resultlists['createdDate'].'"');

$count=mysql_num_rows($list);





$list2=GetPageRecord('*','indentCreationMaster','1 and supplierId="'.$resultlists['supplierId'].'" and createdDate="'.$resultlists['createdDate'].'" and bomPoStatus=0');

$countPending=mysql_num_rows($list2);



?>

                      <tr role="row">

					  	<td><a href="showpage.crm?module=bomtosupplier&add=yes&supplierId=<?php echo encode($resultlists['supplierId']); ?>&createdDate=<?php echo $resultlists['createdDate']; ?>&po=<?php echo $resultlists['poNumber']; ?>"><?php echo getSupplierName($resultlists['supplierId']); ?></a></td>

						<td><?php echo getSupplierCode($resultlists['supplierId']); ?></td>

						<td><div><?php

						if($resultlists['requisitionNo']==""){

						$rsList=GetPageRecord('styleId','indentCreationMaster','supplierId="'.$resultlists['supplierId'].'" and createdDate="'.$resultlists['createdDate'].'"  group by styleId');

						while($productionName=mysqli_fetch_array($rsList)){

						$rsListbuyer=GetPageRecord('buyerId,brandId','queryMaster','id="'.$productionName['styleId'].'"');

						$queryList=mysqli_fetch_array($rsListbuyer);

						?>

						<span style="padding: 5px 10px; background-color: #0097a7; color: #fff; margin-right: 2px; font-size: 12px; margin-bottom:5px;display: inline-block;">#<?php echo getStyleRefId($productionName['styleId']); ?></span> - <span style="padding: 5px 10px; background-color: #d1e8d7ab; color: #fb002e; font-weight: 500; margin-right: 2px; font-size: 12px; margin-bottom:5px;display: inline-block;"><?php echo getBuyerName($queryList['buyerId']); ?></span> - <span style="padding: 5px 10px; background-color: #d1e8d7ab;font-weight: 500; color: #fb002e; margin-right: 2px; font-size: 12px; margin-bottom:5px;display: inline-block;"><?php echo getbrandName($queryList['brandId']); ?></span><br />							<?php

						}

						}else{

						$rsList=GetPageRecord('requisitionNo','indentCreationMaster','supplierId="'.$resultlists['supplierId'].'" and createdDate="'.$resultlists['createdDate'].'"  group by requisitionNo');

						while($productionName=mysqli_fetch_array($rsList)){



						$rsListbuyer=GetPageRecord('brandId','greigeRequisition','requisitionNo="'.$productionName['requisitionNo'].'"');

						$queryList=mysqli_fetch_array($rsListbuyer);



						$rsLi=GetPageRecord('buyerId','brandMaster','id="'.$queryList['brandId'].'"');

						$queryLi=mysqli_fetch_array($rsLi);



						?>

						<span style="padding: 5px 10px; background-color: #0097a7; color: #fff; margin-right: 2px; font-size: 12px; margin-bottom:5px;display: inline-block;"><?php echo $productionName['requisitionNo']; ?></span> - <span style="padding: 5px 10px; background-color: #d1e8d7ab; color: #fb002e; font-weight: 500; margin-right: 2px; font-size: 12px; margin-bottom:5px;display: inline-block;"><?php echo getBuyerName($queryLi['buyerId']); ?></span> - <span style="padding: 5px 10px; background-color: #d1e8d7ab;font-weight: 500; color: #fb002e; margin-right: 2px; font-size: 12px; margin-bottom:5px;display: inline-block;"><?php echo getbrandName($queryList['brandId']); ?></span><br />

						<?php

						}

						}

						?></div></td>

						<td align="center"><?php echo  $count;  ?></td>

						<td align="center"><?php if($countPending!=0){ ?><span class="badge" style="cursor:pointer;background-color:#e83333; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;">Pending(<?php echo $countPending; ?>)</span><?php }else{ ?><span class="badge" style="cursor:pointer;background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;">Completed</span><?php }?></td>

						<td><?php echo date('d-M-Y',strtotime($resultlists['createdDate'])); ?></td>

					  </tr>



                      <?php } } ?>

                    </tbody>

                      </table>

                      <div class="pagingdiv" style="width: 97%;margin: 20px auto;">

                        <table width="100%" border="0" cellpadding="0" cellspacing="0">

                          <tbody>

                            <tr>

                              <td><table border="0" cellpadding="0" cellspacing="0">

                                  <tr>

                                    <td style="padding-right:20px;"><?php echo $totalentry; ?> entries</td>

                                    <td><select name="records" id="records" onchange="this.form.submit();" class="lightgrayfield" style="padding: 5px;border: 1px solid #ccc;">

                                        <option value="25" <?php if($_GET['records']=='25'){ ?> selected="selected"<?php } ?>>25 Records Per Page</option>

                                        <option value="50" <?php if($_GET['records']=='50'){ ?> selected="selected"<?php } ?>>50 Records Per Page</option>

                                        <option value="100" <?php if($_GET['records']=='100'){ ?> selected="selected"<?php } ?>>100 Records Per Page</option>

                                        <option value="200" <?php if($_GET['records']=='200'){ ?> selected="selected"<?php } ?>>200 Records Per Page</option>

                                        <option value="300" <?php if($_GET['records']=='300'){ ?> selected="selected"<?php } ?>>300 Records Per Page</option>

                                      </select></td>

                                  </tr>

                                </table></td>

                              <td align="right"><div class="pagingnumbers"><?php echo $paging; ?></div></td>

                            </tr>

                          </tbody>

                        </table>

                      </div>

                    </div>

                  </div>

                </div>

              </form>

            	</div>

				<div class="tab-pane fade" id="highlighted-justified-tab2">

                  <form name="listform" id="listform" method="get">

                <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />

                <div id="pageload">

                  <div id="" >

                    <div class="datatable-scroll">

                      <table class="table table-bordered" style="width:100%;">

                        <thead style="background-color: #f5f5f5;">

                          <tr>

                            <td><strong>Supplier</strong></td>

                            <td><strong>Supplier Id</strong></td>

                            <td><strong>Requisition No-Department</strong></td>

                            <td><strong>Total Material </strong></td>

                         <td><strong>Date </strong></td>



                          </tr>

                        </thead>

                        <tbody id="allhotellisting">

                        <?php

                        $no=1;

$select='*';

$whered='';

$rss='';

$wheresearch='';

//$limit='20000';

$limit=clean($_GET['records']);



$whered='where 1 group By createdBy,supplier order by createdBy desc';



$page=$_GET['page'];



$targetpage=$fullurl.'showpage.crm?module="'.$modfile['url'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';



$rss=GetRecordList($select,'loadmaintenance',$whered,$limit,$page,$targetpage);

$totalentry=$rss[1];

if($totalentry=1){

$totalentry=2;

}

$paging=$rss[2];

$resultlistsxq=mysql_num_rows($rss[0]);



while($resultlistsx=mysqli_fetch_array($rss[0])){



if($resultlistsx['supplier']!=0){







    $rsLi=GetPageRecord('*','suppliersMaster','id="'.$resultlistsx['supplier'].'"');

						$queryLi=mysqli_fetch_array($rsLi);



						 $rsLier=GetPageRecord('*','maintenancegi_Master','id="'.$resultlistsx['parentId'].'"');

						$queryLier=mysqli_fetch_array($rsLier);





    $rsLid=GetPageRecord('*','loadmaintenance','supplier="'.$resultlistsx['supplier'].'" and createdBy="'.$resultlistsx['createdBy'].'"');

		$queryLid=mysql_num_rows($rsLid);







		  // $rssz=GetPageRecord('*',' requisitionIndentMaster','1 and mainid="'.$resultlistsx['id'].'" and releasedpo!="1"');

		  // while($a=mysql_num_rows($rssz)){

		  //     echo $a;



		  // }







                        ?>

                          <tr>

                            <td align="left"><div align="left"><a href="showpage.crm?module=maintenancepo&view=yes&supplier=<?php echo encode($resultlistsx['supplier']); ?>"><?php echo $queryLi['name']; ?></a></div></td>

                            <td><div align="left"><?php echo $queryLi['supplierId']; ?></div></td>

                            <td><div align="left"><?php echo $queryLier['requisitionno']; ?></div></td>

                            <td><div style="max-height: 200px; "><?php echo $queryLid; ?></td>

                        <td><div style=""><?php echo $resultlistsx['createdBy']; ?></td>



                               </tr>

                               <?php }  }?>



                            </tbody>



                                </table>

                              </div></td>

                          </tr>



                        </tbody>

                      </table>

                      <div class="pagingdiv" style="width: 97%;margin: 20px auto;">

                        <table width="100%" border="0" cellpadding="0" cellspacing="0">

                          <tbody>

                            <tr>

                              <td><table border="0" cellpadding="0" cellspacing="0">

                                  <tr>

                                    <td style="padding-right:20px;"><?php echo $totalentry; ?> entries</td>

                                    <td><select name="records" id="records" onchange="this.form.submit();" class="lightgrayfield" style="padding: 5px;border: 1px solid #ccc;">

                                        <option value="25" <?php if($_GET['records']=='25'){ ?> selected="selected"<?php } ?>>25 Records Per Page</option>

                                        <option value="50" <?php if($_GET['records']=='50'){ ?> selected="selected"<?php } ?>>50 Records Per Page</option>

                                        <option value="100" <?php if($_GET['records']=='100'){ ?> selected="selected"<?php } ?>>100 Records Per Page</option>

                                        <option value="200" <?php if($_GET['records']=='200'){ ?> selected="selected"<?php } ?>>200 Records Per Page</option>

                                        <option value="300" <?php if($_GET['records']=='300'){ ?> selected="selected"<?php } ?>>300 Records Per Page</option>

                                      </select></td>

                                  </tr>

                                </table></td>

                              <td align="right"><div class="pagingnumbers"><?php echo $paging; ?></div></td>

                            </tr>

                          </tbody>

                        </table>

                      </div>

                    </div>

                  </div>

                </div>

              </form>

                </div>

              </div>

            </div>

			</div>

          </div>







          </div>

        </div>

    </div>

  </div>

</div>

</div>

<script>

$(document).ready(function(){

$("#filtersearch").on("keyup", function() {

var value = $(this).val().toLowerCase();

$("#allhotellisting tr").filter(function() {

$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)

});

});

});

</script>

