<?php
if($_REQUEST['delId']!=''){
$update = updatelisting('finalheadcreationmaster','deletestatus=1','id="'.decode($_REQUEST['delId']).'"');
?>
<script>
window.location.href ='<?php echo $fullurl; ?>showpage.crm?module=headcreation';
</script>
<?php
}

if($_REQUEST['id']!=''){
$update = updatelisting('finalheadcreationmaster','gl="'.$_REQUEST['glId'].'"','id="'.decode($_REQUEST['id']).'"');
?>
<script>
window.location.href ='<?php echo $fullurl; ?>showpage.crm?module=headcreation';
</script>
<?php
}

?>
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
.container input[type=checkbox] ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input[type=checkbox]:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.container .checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container input[type=checkbox]:checked ~ .checkmark:after {
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
    padding-left: 25px;
    margin-bottom: 10px;
    cursor: pointer;
    font-size: 14px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    font-weight: 400;
 }
</style>
<div class="page-content">
<div class="content-wrapper">
  <div class="content pt-0" style="margin-top: 20px; width: 100%; margin-left: auto; margin-right: auto;">
    <div class="row">
      <div class="col-xl-12">
      <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
          <div class="col-xl-9">
            <h5 class="card-title"><?php echo $pageName; ?></h5>
          </div>
          <div class="col-xl-3" style="    padding-right: 0px;">

            <div class="btn-group justify-content-center" style="float:right;">
                 <a href="showpage.crm?module=masters"  class="btn bg-teal-400" aria-expanded="false" style="background-color: gray;"><i class="fa fa-arrow-left mr-2"></i>Back</a>

                 <a href="#" onclick="opmodalpop(' Add Head','modalpop.php?action=<?php echo $_GET['module']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-teal-400" aria-expanded="false" style="background-color: #03d873b8;"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a> </div>
          </div>
        </div>
        <div class="card border-left-3 border-left-danger-400 rounded-left-0" style="border: 1px solid #ccc !important;">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <form name"search" method="GET" action="">
                  <input type="hidden"  name="module" value="<?php echo $_GET['module']; ?>"/>
                  <div class="row" style="padding:15px 0px;">
                    <div class="col-md-2">
                      <div class="">
                        <input type="text" placeholder="Search:" name="filtersearch" id="filtersearch" class="form-control" />
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="">
                        <select class="form-control" name="companyId" id="companyId">
                          <option value="">Select</option>
                          <?php
								$rsk=GetPageRecord('*','companyMaster','1 order by name asc');
								while($comData=mysqli_fetch_array($rsk)){
								?>
                          <option value="<?php echo $comData['id']; ?>" <?php if($comData['id']==$_GET['companyId']){ ?> selected="selected" <?php } ?>><?php echo $comData['name']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="">
                        <input name="search" type="submit" class="btn bg-teal-400" id="search" value="Search">
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="col-md-12">
			     <form name="listform" id="listform" method="get">
              <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
                 <table class="table table-bordered table-hover no-footer">
                  <tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                    <td align="center">SR</td>
                    <td align="center"><div align="left">Head&nbsp;Name</div></td>
                    <td align="center"><div align="left">Parent</div></td>
                    <td align="center"><div align="left">Company</div></td>
                    <td align="center"><div align="left">Description</div></td>
                    <td align="center">Created By</td>
                    <td align="center"><div align="left">GL</div></td>
                    <td align="center">Trial&nbsp;Balance</td>
                    <td align="center"><div align="left">Status</div></td>
                    <td align="center"><div align="left">Actions</div></td>
                  </tr>
                  <tbody id="allhotellisting">
                    <?php
$sNo=0;
if($_GET['companyId']!=''){
$companyIdQ='and companyId="'.$_GET['companyId'].'"';
}

$page=$_GET['page'];
$limit=clean($_GET['records']);

$where='where label!="" '.$companyIdQ.'  and deletestatus=0 order by id desc';

$targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&companyId='.$_GET['companyId'].'&';

$rs=GetRecordList($select,'finalheadcreationmaster',$where,$limit,$page,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){
$dateAdded=clean($resultlists['dateAdded']);
$modifyDate=clean($resultlists['modifyDate']);

									?>
                    <tr>
                      <td align="center"><?php echo  ++$sNo; ?></td>
                      <td><a href="#" onclick="opmodalpop(' Edit Head','modalpop.php?action=<?php echo $_GET['module']; ?>&id=<?php echo encode($resultlists['id']); ?>&companyId=<?php echo encode($resultlists['companyId']); ?>','600px','auto');" data-toggle="modal" data-target="#modalpop"><?php echo $resultlists['label']; ?></a></td>
                      <td><?php if($resultlists['parent']!=0){ ?>
                        <span style="padding: 5px 10px; background-color: #02c681; color: #fff; margin-right: 2px; font-size: 12px; width: 150px; margin-bottom: 5px; display: inline-block; text-align: center;">
                        <?php
$rkkk=GetPageRecord('label','finalheadcreationmaster','id="'.$resultlists['parent'].'"');
$parentname=mysqli_fetch_array($rkkk);
echo $parentname['label'];
?>
                        </span>
                        <?php } ?>                      </td>
                      <td><?php
								$cq=GetPageRecord('name','companyMaster','1 and id="'.$resultlists['companyId'].'"');
								$comName=mysqli_fetch_array($cq);
								echo $comName['name'];
								?>                      </td>
                      <td><?php echo $resultlists['description']; ?></td>
                      <td><?php $select2='';
								$where2='';
								$rs2='';
								$select2='firstName,lastName';
								$where2='id="'.$resultlists['addedBy'].'"';
								$rs2=GetPageRecord($select2,_USER_MASTER_,$where2);
								$userss=mysqli_fetch_array($rs2);
								echo $userss['firstName'].' '.$userss['lastName']; ?>
                        - <span style="font-size:12px; margin-top:2px; color:#999999;"><?php echo showdatetime($dateAdded,$loginusertimeFormat);?></span> </td>
                      <td><label class="container">
                        <input type="checkbox" name="gl" value="<?php echo $resultlists['gl']; ?>" class="form-control" onclick="isLedger('<?php echo encode($resultlists['id']); ?>','<?php echo $resultlists['gl']; ?>');"  <?php if($resultlists['gl']==1){ ?> checked="checked" <?php } ?>  style="margin-right: 5px; display:block;" />
                        <span class="checkmark"></span></label></td>

                      <td><?php if($resultlists['trialbalance']==1){ echo 'Yes'; } ?></td>
                      <td><?php if($resultlists['status']==1){ ?>
                        <span class="badge badge-success">Active</span>
                        <?php } ?>
                        <?php if($resultlists['status']==2){ ?>
                        <span class="badge badge-secondary">Inactive</span>
                        <?php } ?></td>
                      <td><?php if($resultlists['parent']!=0){ ?>
                        <i class="fa fa-trash" style="font-size: 20px; color:#FF0000; cursor:pointer;" onclick="deleteHead('<?php echo encode($resultlists['id']); ?>');"></i>
                        <?php } ?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
				 <div class="pagingdiv" style="width: 100%;margin: 20px auto;">
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
			    </form>
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
<script>
 function isLedger(id,glId){

	if(glId=='0'){
		var conf = confirm('Are you sure you want to create General Ledger?');
		if(conf==true){
			window.location.href ='<?php echo $fullurl; ?>showpage.crm?module=headcreation&id='+id+'&glId=1';
		}
	}else{
		var conf = confirm('Are you sure you want to remove from General Ledger?');
		if(conf==true){
		window.location.href ='<?php echo $fullurl; ?>showpage.crm?module=headcreation&id='+id+'&glId=0';
		}
	}
 }


 function deleteHead(delId){
 	var conf = confirm('Are you sure you want delete?');
	if(conf==true){
		window.location.href ='<?php echo $fullurl; ?>showpage.crm?module=headcreation&delId='+delId;
	}
 }
 </script>

<style>
.apparelclass tr td{
border:1px solid #ccc !important;
vertical-align:middle !important;

}
</style>
