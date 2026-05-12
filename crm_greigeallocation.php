                    <?php
                    if($loginuserprofileId==1){

                    $wheresearchassign=' 1 and ';

                    } else {

                    if($loginuserprofileId==92){

                    $wheresearchassign=' 1 and finalstatus="2" and assignTo in (select id from '._USER_MASTER_.' where empId in (select id from employeeMaster where (reportingTo='.$_SESSION['empid'].')) or assignTo="'.$_SESSION['userid'].'") and ';
                    } else{

                    $wheresearchassign=' ( id in (select styleId from styleAssignmentMaster where assignTo="'.$_SESSION['userid'].'" and styleAssignTo=0))';
                    $wheresearchassign=' '.$wheresearchassign.' and ';
                    }

                    }

                    if($loginuserprofileId==93){
                    $wheresearchassign='1 and finalstatus=2 and addedBy="'.$_SESSION['userid'].'" and ';
                    }

                    ?>

                    <div class="page-content">
                    <style>
                    .even{
                    background-color: #0097a71a;
                    }
                    </style>
                    <!-- Main sidebar -->
                    <div class="content-wrapper">
                    <!---Save Alert Notification---->
                    <?php include "savealert.php"; ?>
                    <div class="content pt-0" style="margin-top:20px;">
                    <div class="row">
                    <div class="col-xl-12">
                    <div class="card-header header-elements-inline bg-blue-700 filterable" style="padding: 10px;">
                    <div class="col-xl-9">
                    <h5 class="card-title"><?php echo $pageName; ?></h5>
                    </div>

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
                    <!--<select name="stylerefid" id="stylerefid" class="select2" style="margin-left: 10px; width: 190px; padding: .4375rem .875rem; font-size: .8125rem; line-height: 1.5385; color: #333; background-color: #fff; background-clip: padding-box; border: 1px solid #ddd; border-radius: .1875rem; box-shadow: 0 0 0 0 transparent; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 2.25003rem; outline: none !important;">
                    <option value="">Select Style</option>
                    <?php
                    $fcref=GetPageRecord('*','queryMaster',''.$wheresearchassign.' deleteStatus=0 and subject!="" order by id desc');
                    while($refData=mysqli_fetch_array($fcref)){ ?>
                    <option value="<?php echo encode($refData['id']); ?>" <?php if(decode($_GET['stylerefid'])==$refData['id']){ ?> selected="selected" <?php } ?>><?php echo $refData['styleRefId']; ?></option>
                    <?php } ?>
                    </select>-->
                    </label>



                    <label>
                    <input name="" type="submit" id="" class="" value="search" style="text-transform: uppercase; background-color: #03c28d; color: #fff; width: 200px; cursor:pointer; margin:0px !important;;"/>
                    </label>
                    <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
                    </div>
                    </form>
                    </div>
                    </div>



                    <div id="collapsible-control-right-group1" class="collapse" style="display:block;">
                    <div class="card-body">
                    <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                    <li class="nav-item"><a href="#highlighted-justified-tab1" class="nav-link active show" data-toggle="tab"><strong><?php echo $pageName; ?></strong></a></li>
                    <li class="nav-item"><a href="#highlighted-justified-tab2" class="nav-link" data-toggle="tab"><strong>Yarn Allocation</strong></a></li>
                    </ul>
                    <div class="tab-content">





                    <div class="tab-pane fade active show" id="highlighted-justified-tab1">

                    <div class="col-xl-12" style="padding-bottom: 57px;"><div class="btn-group justify-content-center" style="float:right;">
                    <a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes" class="btn bg-teal-400 addnotify" aria-expanded="false" style="    background-color: #03d873b8;"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>
                    </div> </div>


                    <form name="listform" id="listform" method="get">
                    <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                    <div class="datatable-scroll">
                    <table class="table table-bordered table-hover no-footer">
                    <thead style="background-color: #f5f5f5;">
                    <tr role="row">
                    <th>Allocation&nbsp;No.</th>
                    <th>Requested&nbsp;Date</th>
                    <th>Greige&nbsp;Style</th>
                    <th>Requested By</th>
                    <th>Transfer Status</th>
                    <th>Action</th>
                    <th style="display:none;">Requested By</th>
                    <th style="display:none;">Approved By</th>
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


                    $where='where 1 and greigeStyleNo!="" order by id desc';
                    $page=$_GET['page'];

                    $targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&stylerefid='.$_GET['stylerefid'].'&';

                    $rs=GetRecordList($select,'greigeAllocation',$where,$limit,$page,$targetpage);
                    $totalentry=$rs[1];
                    $paging=$rs[2];
                    while($resultlists=mysqli_fetch_array($rs[0])){

                    ?>
                    <tr role="row" class="odd">
                    <td><a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes&id=<?php echo encode($resultlists['id']); ?>"><?php echo $resultlists['allocationNo']; ?></a></td>
                    <td><?php echo date('d-M-y', strtotime($resultlists['allocationDate'])); ?></td>
                    <td><?php echo $resultlists['greigeStyleNo']; ?></td>
                    <td><?php echo getUserName($resultlists['addedBy']); ?></td>
                    <td>
                    <?php if($resultlists['status']!=0){ ?>
                    <span class="badge badge-success" style="width: 47px;">Sent</span>
                    <?php }else{ ?>
                    <span class="badge badge-warning" style="width: 47px; cursor:pointer;" onclick="funcApprove('<?php echo $resultlists['id']; ?>');">Pending</span>
                    <?php } ?>
                    </td>
                    <td style="display:none;"><?php echo getUserName($resultlists['addedBy']); ?></td>
                    <td style="display:none;"><?php if($resultlists['status']==0){ echo '-'; }else{ echo getUserName($resultlists['addedBy']);} ?></td>
                    <td><a href="tcpdf/examples/generategreigeallocation.php?pageurl=<?php echo $fullurl; ?>download-greigeallocation.php?id=<?php echo encode($resultlists['id']); ?>" target="_blank" style="background: #e71c22; outline: none; color: #fff; padding: 5px; border-radius: 2px; cursor: pointer; width: 95px; display: block;">
                    <i class="fa fa-download" aria-hidden="true"></i> PDF</a>
                    </td>
                    </tr>
                    <?php  }  ?>
                    <div id="loaddiv" style="display:none;"></div>
                    <script>
                    function funcApprove(id){
                    var conf = confirm('Are you sure you want to transfer?');
                    if(conf==true){
                    $('#loaddiv').load('loadgreigeallocation.php?action=addmaterialtoindent&id='+id);
                    }
                    }
                    </script>
                    </tbody>
                    </table>
                    <br>
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


                    <div class="tab-pane fade" id="highlighted-justified-tab2">
                    <div class="col-xl-12" style="padding-bottom: 57px;"><div class="btn-group justify-content-center" style="float:right;">
                    <a href="showpage.crm?module=yarnallocation&add=yes" class="btn bg-teal-400 addnotify" aria-expanded="false" style="    background-color: #03d873b8;"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>
                    </div> </div>


                    <form name="listform" id="listform" method="get">
                    <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                    <div class="datatable-scroll">
                    <table class="table table-bordered table-hover no-footer">
                    <thead style="background-color: #f5f5f5;">
                    <tr role="row">
                    <th>Allocation&nbsp;No.</th>
                    <th>Requested&nbsp;Date</th>
                    <th>Greige&nbsp;Style</th>
                    <th>Requested By</th>
                    <th>Transfer Status</th>
                    <th>Action</th>
                    <th style="display:none;">Requested By</th>
                    <th style="display:none;">Approved By</th>
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


                    $where='where 1 and greigeStyleNo!="" order by id desc';
                    $page=$_GET['page'];

                    $targetpage=$fullurl.'showpage.crm?module='.$modfile['url'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&stylerefid='.$_GET['stylerefid'].'&';

                    $rs=GetRecordList($select,'yarnAllocation',$where,$limit,$page,$targetpage);
                    $totalentry=$rs[1];
                    $paging=$rs[2];
                    while($resultlists=mysqli_fetch_array($rs[0])){

                    ?>
                    <tr role="row" class="odd">
                    <td><a href="showpage.crm?module=yarnallocation&add=yes&id=<?php echo encode($resultlists['id']); ?>"><?php echo $resultlists['allocationNo']; ?></a></td>
                    <td><?php echo date('d-M-y', strtotime($resultlists['allocationDate'])); ?></td>
                    <td><?php echo $resultlists['greigeStyleNo']; ?></td>
                    <td><?php echo getUserName($resultlists['addedBy']); ?></td>
                    <td>
                    <?php if($resultlists['status']!=0){ ?>
                    <span class="badge badge-success" style="width: 47px;">Sent</span>
                    <?php }else{ ?>
                    <span class="badge badge-warning" style="width: 47px; cursor:pointer;" onclick="funcApproves('<?php echo $resultlists['id']; ?>','<?php echo $resultlists['indentNumber']; ?>');">Pending</span>
                    <?php } ?>
                    </td>
                    <td style="display:none;"><?php echo getUserName($resultlists['addedBy']); ?></td>
                    <td style="display:none;"><?php if($resultlists['status']==0){ echo '-'; }else{ echo getUserName($resultlists['addedBy']);} ?></td>
                    <td><a href="tcpdf/examples/generategreigeallocation.php?pageurl=<?php echo $fullurl; ?>download-greigeallocation.php?id=<?php echo encode($resultlists['id']); ?>" target="_blank" style="background: #e71c22; outline: none; color: #fff; padding: 5px; border-radius: 2px; cursor: pointer; width: 95px; display: block;">
                    <i class="fa fa-download" aria-hidden="true"></i> PDF</a>
                    </td>
                    </tr>
                    <?php  }  ?>
                    <div id="loaddivas" style="display:none;"></div>
                    <script>
                    function funcApproves(id,indentNumber){
                        var conf = confirm('Are you sure you want to transfer?');
                        if(conf==true){
                            $('#loaddivas').load('loadyarnallocation.php?action=addmaterialtoindent&id='+id+'&indentNumber='+indentNumber);
                        }
                    }
                    </script>
                    </tbody>
                    </table>
                    <br>
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
                    </div>
                    </div>
                    </div>
                    </div>
                    <style>
                    .dataTables_info,.dataTables_paginate,.dataTables_length {
                    display:none !important;
                    }
                    .specialclass label{
                    margin:0px !important;
                    margin-left:5px !important;
                    }
                    .select2-container {
                    width: 190px !important;
                    }
                    .select2-search--dropdown .select2-search__field {
                    width: 160px !important;
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
