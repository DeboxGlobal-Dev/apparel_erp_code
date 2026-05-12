<?php
 if($loginuserprofileId==1){

$wheresearchassign=' 1 and ';

} else {

$wheresearchassign=' ( assignTo in (select id from '._USER_MASTER_.' where  empId in (select id from employeeMaster where id ='.$_SESSION['empid'].')) or assignTo in (select id from '._USER_MASTER_.' where  empId in (select reportingTo from employeeMaster where id="'.$_SESSION['empid'].'"))) ';

$wheresearchassign=' '.$wheresearchassign.' and ';

}

if($_GET['status']!='' && $_GET['id']!='' && $_GET['sectionType']==''){

$id=decode($_GET['id']);

$amd=GetPageRecord('*','bomAmendment','amendmentId="'.$id.'"');
$amdData=mysqli_fetch_array($amd);

$whereval='styleId="'.$amdData['styleId'].'" and costsheetVersionId="'.$amdData['costsheetVersionId'].'" and stylesubtabid="'.$amdData['stylesubtabid'].'"';
$nameval='bomAvg="'.$amdData['bomAvg'].'",bomWidth="'.$amdData['bomWidth'].'",bomUnit="'.$amdData['bomUnit'].'",wastagePersent="'.$amdData['wastagePersent'].'",matPrice="'.$amdData['matPrice'].'"';
updatelisting('techPackDetailMaster',$nameval,$whereval);


$whereval='id="'.$id.'"';
updatelisting('amendmentMaster','status=1,approvedDate="'.date('Y-m-d').'"',$whereval);
}

if($_GET['status']!='' && $_GET['id']!='' && $_GET['sectionType']=='greigerequisition'){

$id=decode($_GET['id']);

$amd=GetPageRecord('*','bomAmendment','amendmentId="'.$id.'"');
$amdData=mysqli_fetch_array($amd);

$whereval='id="'.$id.'"';
updatelisting('amendmentMaster','status=1,approvedDate="'.date('Y-m-d').'"',$whereval);
}

if($_GET['status']!='' && $_GET['id']!='' && $_GET['sectionType']=='saleorder'){

$id=decode($_GET['id']);

$amd=GetPageRecord('*','bomAmendment','amendmentId="'.$id.'"');
$amdData=mysqli_fetch_array($amd);

$whereval='id="'.$amdData['sizeRowId'].'"';
$nameval='finish="'.$amdData['finish'].'",color="'.$amdData['color'].'",size="'.$amdData['size'].'",gdQty="'.$amdData['gdQty'].'"';
updatelisting('purchaseOrderStyleMaster',$nameval,$whereval);


$whereval='id="'.$id.'"';
updatelisting('amendmentMaster','status=1,approvedDate="'.date('Y-m-d').'"',$whereval);

}
?>

<div class="page-content">
  <style>
.even{
background-color: #0097a71a;
}
.iconlistset {
width: 34px;
background-color: #000099;
padding: 5px 5px;
overflow: hidden;
float: left;
border-radius: 50px;
height: 34px;
margin: 0px 3px;
cursor: pointer;
}
.iconlistset img {
width: 16px;
margin-top: 6px;
mage-rendering: auto;
image-rendering: crisp-edges;
image-rendering: pixelated;
}
</style>
  <!-- Main sidebar -->
  <?php include "left.php"; ?>
  <div class="content-wrapper">
    <!---Save Alert Notification---->
    <?php include "savealert.php"; ?>
    <div class="content pt-0" style="margin-top:20px;">
      <div class="row">
        <div class="col-xl-12">
          <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
            <div class="col-xl-9">
              <h5 class="card-title"><?php echo $pageName; ?></h5>
            </div>
            <div class="col-xl-3" style="    padding-right: 0px;">
              <div class="btn-group justify-content-center" style="float:right;">
              </div>
            </div>
          </div>
          <div class="card">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
              <div class="datatable-scroll">
                <table class="table table-bordered table-hover datatable-highlight dataTable no-footer" id="DataTables_Table_2" role="grid" aria-describedby="DataTables_Table_2_info">
                  <thead style="background-color: #f5f5f5;">
                    <tr role="row">
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Amendment&nbsp;No</th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Style#</th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Amendment&nbsp;Type</th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Requested&nbsp;Date</th>
                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
$no=1;
$select='*';
$where='';
$rs='';
$wheresearch='';
$limit='20000';


$where='where 1 order by id desc';
$page=$_GET['page'];

$targetpage=$fullurl.'showpage.crm?module="'.$modfile['moduleName'].'"&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&';
$rs=GetRecordList($select,'amendmentMaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

$pps=GetPageRecord('*','queryMaster','1 and styleRefId="'.$resultlists['styleId'].'"');
$user=mysqli_fetch_array($pps);

$requis=GetPageRecord('styleNo','greigeRequisition','id="'.$resultlists['styleId'].'"');
$requisList=mysqli_fetch_array($requis);


if($resultlists['sectionType']!="greigerequisition"){
$styleNo = '#'.getStyleRefId($resultlists['styleId']);
}else{
$styleNo = $requisList['styleNo'];
}

?>
                    <tr role="row" class="odd">
                      <td align="left"><a href="showpage.crm?module=<?php echo $_GET['module']; ?>&view=yes&id=<?php echo encode($resultlists['id']); ?>&styleid=<?php echo encode($resultlists['styleId']); ?>"><?php echo $resultlists['amendNumber']; ?></a></td>

                      <td align="left"><?php echo $styleNo; ?></td>
                      <td align="left"><?php
						$rsamend=GetPageRecord('name','amendmentTypeMaster','id="'.$resultlists['amendType'].'"');
						$rsamendtype=mysqli_fetch_array($rsamend);
						echo $rsamendtype['name'];
					  ?></td>
                      <td align="left"><?php echo date('d M, Y', strtotime($resultlists['requestedDate']));?></td>
                      <td align="left"><?php if($resultlists['status']==0){ ?><span class="badge" style="cursor:pointer;background-color:#e83333; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;" onclick="funcChangeAmend('<?php echo encode($resultlists['id']); ?>','<?php echo $resultlists['sectionType']; ?>');">Pending</span><?php }else{ ?><span class="badge" style="cursor:pointer;background-color:green; color:#fff; position: relative;width: 142px; font-size: 11px; padding: 6px;">Approved</span><?php } ?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
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
function funcChangeAmend(amdid,sectionType){
	var conf = confirm('Are you sure you want to approve this?');
	if(conf==true){
	window.location.href = 'showpage.crm?module=<?php echo $_GET['module']; ?>&status=1&id='+amdid+'&sectionType='+sectionType; //delete style
	}
}
</script>
<style>
 .liststyleimg{float: left;
    width: 70px;
    margin-right: 15px;
    padding: 5px;
    border: 2px solid #e6e6e6;}

	.badge.dropdown-toggle:after { display:none;
}


 </style>
<script>
$('#DataTables_Table_2').DataTable( {
"order": [[ 0, "desc" ]]
} );
</script>
