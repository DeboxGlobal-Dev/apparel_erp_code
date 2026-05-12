<div class="page-content">
  <style>
.select2-container{
width:190px !important;
}
</style>
  <!-- Main sidebar -->
  <div class="content-wrapper">
    <?php include "savealert.php"; ?>
    <div class="content pt-0" style="margin-top:20px;">
      <div class="row">
        <div class="col-xl-12">
          <div class="card-header header-elements-inline bg-blue-700 filterable" style="padding: 10px;">
            <div class="col-xl-9">
              <h5 class="card-title"><?php echo $pageName; ?></h5>
            </div>
            <div class="col-xl-3" style="padding-right: 0px;"> </div>
          </div>
          <div class="card">
            <div id="DataTables_Table_2_filter" class="dataTables_filter">
              <div class="row specialclass">
                <form action="" method="get">
                  <div class="col-md-12" style="padding:0px;">
                    <label>
                    <input type="text" placeholder="Search:" name="filtersearch" id="filtersearch" style="margin-left: 0px; width: 190px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;"/>
                    </label>
                    <label>
                    <select name="stylerefid" id="stylerefid" class="select2" style="margin-left: 10px; width: 190px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;">
                      <option value="">Select Style</option>
                      <?php
				$fcref=GetPageRecord('*','queryMaster','1 and subject!="" order by id desc');
				while($refData=mysqli_fetch_array($fcref)){ ?>
                      <option value="<?php echo encode($refData['id']); ?>" <?php if(decode($_GET['stylerefid'])==$refData['id']){ ?> selected="selected" <?php } ?>><?php echo $refData['styleRefId']; ?></option>
                      <?php } ?>
                    </select>
                    </label>
                    <label>
                     <input name="" type="submit" id="" class="" value="search" style="text-transform: uppercase; background-color: #03c28d; color: #fff; width: 200px; cursor:pointer; margin:0px !important;;"/>
                     </label>
                     <input name="module" id="module" type="hidden"  value="<?php echo $_REQUEST['module']; ?>" />
                     </div>
                </form>
              </div>
            </div>
            <form name="listform" id="listform" method="get">
              <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
              <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                <div class="datatable-scroll">
                  <table class="table table-bordered table-hover no-footer">
                    <thead style="background-color: #f5f5f5;">
                      <tr role="row">
					  	<th>Style#</th>
                        <th>Style&nbsp;Name</th>
                        <th>Buyer</th>
                        <th>Brand</th>
                        <th>PD&nbsp;Merchant</th>
						<th>Production&nbsp;Merchant</th>
						<th>Action</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody id="allhotellisting">
                      <?php
$no=0;
$select='*';
$where='';
$rs='';
$wheresearch='';
//$limit='20000';
$limit=clean($_GET['records']);


if($_GET['stylerefid']!=''){
$stylerefCondition = 'and id="'.decode($_GET['stylerefid']).'"';
}


$where='where '.$wheresearchassign.' subject!="" '.$stylerefCondition.' and sampleStyle=1 and deletestatus=0 order by id desc';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&stylerefid='.$_GET['stylerefid'].'&';

$rs=GetRecordList($select,_QUERY_MASTER_,$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){


$wherea='id="'.$resultlists['buyerId'].'"';
$selectstatus='*';
$rsstatusa=GetPageRecord($selectstatus,'buyerMaster',$wherea);
$resulta=mysqli_fetch_array($rsstatusa);

$whereas='id="'.$resultlists['brandId'].'"';
$rsstatusas=GetPageRecord($selectstatus,'brandMaster',$whereas);
$resultas=mysqli_fetch_array($rsstatusas);

$wherka='id="'.$resultlists['categoryId'].'"';
$rssrr=GetPageRecord($selectstatus,'categoryMaster',$wherka);
$resur=mysqli_fetch_array($rssrr);

$wherk='id="'.$resultlists['gender'].'"';
$rssr=GetPageRecord($selectstatus,'genderMaster',$wherk);
$resu=mysqli_fetch_array($rssr);


$selectstatus='*';
$wherestatus='styleId="'.$resultlists['id'].'" and statusId!=0 order by id desc';
$rsstatus=GetPageRecord($selectstatus,'styleAssignmentMaster',$wherestatus);
$result=mysqli_fetch_array($rsstatus);


$select1='*';
$where1='id="'.$result['statusId'].'" order by id desc';
$rs1=GetPageRecord($select1,'statusMaster',$where1);
$result1=mysqli_fetch_array($rs1);
?>
                      <tr>
					   <td><a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes&styleid=<?php echo encode($resultlists['id']); ?>"><?php echo '#'.$resultlists['styleRefId']; ?>



                          </a></td>
                        <td><?php echo $resultlists['subject']; ?></td>
                        <!--<td><a href="showpage.crm?module=timeandaction&add=yes&styleid=<?php echo encode($resultlists['id']); ?>"><?php echo $resur['name']; ?>- <?php echo $resu['name']; ?> </a></td>-->
                        <td><?php echo $resulta['name']; ?></td>
                        <td><?php echo $resultas['name']; ?> </td>
                        <!--<td><?php
								$select1='*';
								$where1='id="'.$resultlists['departmentId'].'"';
								$rs1=GetPageRecord($select1,_DEPARTMENT_MASTER_,$where1);
								$resultlist1=mysqli_fetch_array($rs1);
								echo $resultlist1['name'];
								?>
                        </td>-->
                        <td style=""><?php echo getUserName($resultas['pdmerchant']); ?></td>
						<td style=""><?php echo getUserName($resultas['productionmerchant']);?></td>



										    <td>
						<div>

						<a href="download-pd.php?styleId=<?php echo encode($resultlists['id']); ?>"
						target="_blank"
						style="background: #0288d1; outline: none; color: #fff; padding: 5px; border-radius: 2px; cursor: pointer;
						display: block; float:left;"><i class="fa fa-download" aria-hidden="true" style="font-size: 17px;"></i>&nbsp;&nbsp;Download Excel</a>
									</div>						</td>


                        <td align="left"><span class="badge" style="background-color:<?php echo $result1['statusColor']; ?>; color:#FFFFFF; position: relative;"> <?php echo $result1['name']; ?></span> </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  <div class="pagingdiv" style="width: 97%;margin: 20px auto;">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tbody>
                        <tr>
                          <td><table border="0" cellpadding="0" cellspacing="0">
                              <tr>
                                <td style="padding-right:20px;"><?php echo $totalentry; ?> entries</td>
                                <td><select name="records" id="records" onchange="this.form.submit();" class="lightgrayfield" style="padding: 5px;border: 1px solid #ccc; outline:none;">
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
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<style>
.dataTables_info,.dataTables_paginate,.dataTables_length {
	display:none !important;
 }
</style>
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
