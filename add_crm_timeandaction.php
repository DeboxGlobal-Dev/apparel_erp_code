                    <?php



                    if($_GET['styleid']!=''){

                    $select='*';

                    $where='id="'.decode($_GET['styleid']).'"';

                    $rs=GetPageRecord($select,'queryMaster',$where);

                    $editresultstyle=mysqli_fetch_array($rs);

                    $buyerId = $editresultstyle['buyerId'];

                    $buyerStyleRefNo = $editresultstyle['buyerStyleRefNo'];

                    $subject = $editresultstyle['subject'];

                    $displayId = $editresultstyle['displayId'];

                    $seasonId = $editresultstyle['seasonId'];

                    $categoryId = $editresultstyle['categoryId'];

                    $subCategoryId = $editresultstyle['subCategoryId'];

                    $departmentId = $editresultstyle['departmentId'];

                    $receivedDate = $editresultstyle['receivedDate'];

                    $patternDescription = $editresultstyle['patternDescription'];

                    $patternAttachment = $editresultstyle['patternAttachment'];



                    $lastId=$editresultstyle['id'];



                    }



                    $i=1;

                    while($i<6){



                    $select='*';

                    $id=clean(decode($_GET['styleid']));

                    $where='id='.$id.'';

                    $rs=GetPageRecord($select,_QUERY_MASTER_,$where);

                    $resultpage=mysqli_fetch_array($rs);



                    if($_GET['styleid']!='' && $resultpage['tnaTemplateId']!='0'){



                    $selecttask='*';

                    //$wheretask='1 and status=1 and tnatemplate="'.$resultpage['tnaTemplateId'].'" order by id asc';



                    $wheretask='1 and tnatemplate="'.$resultpage['tnaTemplateId'].'" and status=1 order by id asc';



                    $rstask=GetPageRecord($selecttask,'taskListMaster',$wheretask);



                    while($reslisttask1=mysqli_fetch_array($rstask)){



                    //echo $reslisttask1['name'].'==<br>';



                    $wherecheck='styleId="'.$id.'" and taskListId="'.$reslisttask1['id'].'" and temid="'.$resultpage['tnaTemplateId'].'"';



                    $addnewyes = checkduplicate('timeActionReport',$wherecheck);



                    if($addnewyes!='yes'){



                    //============================================///////////////////////////



                    //echo '1 and criPath in (select criticalPath from taskListMaster where name="'.$reslisttask1['name'].'" and tnatemplate="'.$resultpage['tnaTemplateId'].'") and styleId="'.$id.'"';



                    $a=GetPageRecord('complitionDate','timeActionReport','1 and criPath in (select criticalPath from taskListMaster where name="'.$reslisttask1['name'].'" and status=1 and tnatemplate="'.$resultpage['tnaTemplateId'].'") and styleId="'.$id.'"');

                    $criData=mysqli_fetch_array($a);



                    //echo $criData.'==========';



                    $aaaaaa=GetPageRecord('id','taskListMaster','1 and tnatemplate="'.$resultpage['tnaTemplateId'].'" and status=1 and id="'.$reslisttask1['id'].'" and criticalPath in (select criPath from timeActionReport where complitionDate!="" and complitionDate!="1970-00-00" and complitionDate!="0000-00-00" and styleId="'.$id.'")');



                    $counttimeaction=0;



                    $counttimeaction=mysql_num_rows($aaaaaa);



                    //echo "==========".$reslisttask1['criticalPath'].'===';



                    if($reslisttask1['criticalPath']==0 || $counttimeaction>0){



                    $comDate= date('Y-m-d', strtotime($criData['complitionDate']. ''.$reslisttask1['totaldays'].' days'));



                    if($reslisttask1['name']==3){

                    $comDate=$editresultstyle['ocdDate'];

                    }



                    if($reslisttask1['name']==49){

                    $comDate=$editresultstyle['shipDate'];

                    }



                    $namevaluetask ='taskListId="'.$reslisttask1['id'].'",styleId="'.$id.'",status=1,complitionDate="'.$comDate.'",actualDate="1970-01-01",totaldays="'.$reslisttask1['totaldays'].'",temid="'.$resultpage['tnaTemplateId'].'",criPath="'.$reslisttask1['name'].'"';



                    addlistinggetlastid('timeActionReport',$namevaluetask);

                    }



                    }

                    }



                    }



                    $i++;

                    }





                    ?>

                    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

                    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

                    <style>



                    .form-control {

                    padding: 4px;

                    }



                    .toggle.btn {

                    min-width: 59px;

                    min-height: 34px;

                    width: auto !important;

                    height: auto !important;

                    margin: 0px !important;

                    }





                    .listc .table thead th {

                    vertical-align: middle;

                    border-bottom: 1px solid #b7b7b7;

                    padding: 9px;

                    }

                    .listc .table-bordered td, .table-bordered th {

                    border: 1px solid #ddd;

                    padding: 8px;

                    }

                    .icon-calendar3{

                    position: absolute;

                    top: 18px;

                    right: 0px;

                    }

                    </style>

                    <div class="page-content">





                    <div class="content-wrapper">



                    <div class="content pt-0" style="margin-top:20px;">

                    <?php include "top-style.php"; ?>

                    <div class="col-xl-12" style="padding:0px;">

                    <div class="card">

                    <div class="card-body navbar-green"  style="padding:7px !important;" >

                    <div class="media">

                    <div class="col-xl-6">

                    <h6 class="media-title font-weight-semibold"  style="    margin-top: 8px;">TNA(Time & Action) </h6>

                    </div>

                    <div class="col-xl-6" style="text-align:right;">

                    <div class="d-flex align-items-center" style="float:right; ">

                    <?php if($_GET['editid']==''){ ?> <div class="btn-group justify-content-center" style="float:right;">



                    <?php if($editresultstyle['tnaTemplateId']==0){ ?>

                    <a href="#" onclick="opmodalpop(' Select TNA Template','modalpop.php?action=selecttnaTemplate&styleid=<?php echo encode($editresultstyle['id']); ?>','400px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-teal-400" aria-expanded="false" style="background-color: #e6141a;">Select Template</a>

                    <?php }else{

                    $td=GetPageRecord('name','tnaTemplatesMaster','1 and id="'.$editresultstyle['tnaTemplateId'].'"');

                    $temname=mysqli_fetch_array($td);

                    ?>

                    <span style="width: auto; display: block; margin-right: 30px; padding: 10px; background-color: #fff7b3; color: #000; font-weight: 500;">TNA Template - <?php echo $temname['name']; ?></span>

                    <?php } ?>



                    <?php if($editresultstyle['tnaTemplateId']!=0){ ?>
                        <?php if($addpermission==1){ ?>
                    <a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes&styleid=<?php echo encode($resultpage['id']); ?>&editid=<?php echo encode($resultpage['id']); ?>" class="btn bg-primary-400" aria-expanded="false" style=""><i class="fa fa-pencil" ></i> Edit</a>
                    <?php } ?>
                    <?php } ?>



                    </div> <?php }else{ ?>

                    <div class="d-flex align-items-center" style="float:right;margin-right:0px;">

                    <a href="showpage.crm?module=<?php echo $_GET['module']; ?>&add=yes&styleid=<?php echo encode($resultpage['id']); ?>"><button type="button" class="btn bg-grey-400 btn-labeled btn-labeled-right ml-auto"><b><i class="fa fa-arrow-left" aria-hidden="true" style="    font-size: 17px;"></i></b>Back</button></a>

                    </div>

                    <?php } ?>



                    </div>



                    </div>



                    </div>

                    </div>

                    <?php if($_GET['editid']==''){ ?>

                    <div class="card-body listc">







                    <div class="table-responsive">

                    <table width="100%" class="table table-bordered table-responsive" style="margin-bottom:5px;">

                    <tbody style="width: 100%;display: inline-table;">

                    <tr class="card-body" style="text-align: center; background-color: #e1f1ff;">

                    <td width="100%" style="text-align:center;"><strong style="font-size: 16px; font-weight: 500;">LEAD TIME SYNOPSIS</strong></td>



                    </tr>

                    </tbody>

                    </table>

                    <style>

                    .buyer-address td{

                    border:0px solid;

                    padding:0px;

                    }

                    </style>



                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered table-responsive forbom summaryfinal" style="display: block; overflow: hidden; margin-bottom: 15px;">

                    <tbody style="width: 100%;display: inline-table;">





                    <tr class="card-body" style="background-color: #f9f9f9;">

                    <td width="17%" align="left"><div align="center"><strong>TTL ORDER LEAD TIME </strong></div></td>

                    <td width="15%" align="left"><div align="center"><strong>TTL FABRIC LEAD TIME </strong></div></td>

                    <td width="17%" align="left"><div align="center"><strong>MERCHANDISING LEAD TIME </strong></div></td>

                    <td width="29%" align="left"><div align="center"><strong>PRODUCTION LEAD TIME (INC. R&amp;D)</strong></div></td>

                    </tr>

                    <?php



                    ///////////////////////////////////////////////////////////

                    $exfastaDataq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$editresultstyle['id'].'" and temid="'.$editresultstyle['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=47 and status=1)');

                    $exfastaData=mysqli_fetch_array($exfastaDataq);

                    //////////////////////////////////////////////////////////

                    $ocdq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$editresultstyle['id'].'" and temid="'.$editresultstyle['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=3 and status=1)');

                    $ocdData=mysqli_fetch_array($ocdq);

                    ///////////////////////////////////////////////////////////

                    $fabricinhousstDataq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$editresultstyle['id'].'" and temid="'.$editresultstyle['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=22 and status=1)');

                    $fabricinhousstData=mysqli_fetch_array($fabricinhousstDataq);

                    ///////////////////////////////////////////////////////////

                    $filehanderDataq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$editresultstyle['id'].'" and temid="'.$editresultstyle['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=38 and status=1)');

                    $filehanderData=mysqli_fetch_array($filehanderDataq);

                    ///////////////////////////////////////////////////////////

                    $exfacendDataq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$editresultstyle['id'].'" and temid="'.$editresultstyle['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=49 and status=1)');

                    $exfacendData=mysqli_fetch_array($exfacendDataq);

                    ///////////////////////////////////////////////////////////

                    $cuttingstatrDataq=GetPageRecord('complitionDate','timeActionReport','1 and styleId="'.$editresultstyle['id'].'" and temid="'.$editresultstyle['tnaTemplateId'].'" and status=1 and taskListId in (select id from taskListMaster where name=42 and status=1)');

                    $cuttingstatrData=mysqli_fetch_array($cuttingstatrDataq);



                    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                    $ttlorderleadtime=date_diff(date_create($exfastaData['complitionDate']),date_create($ocdData['complitionDate']));

                    $ttfabricleadtime=date_diff(date_create($fabricinhousstData['complitionDate']),date_create($ocdData['complitionDate']));

                    $merhcleadtime=date_diff(date_create($filehanderData['complitionDate']),date_create($ocdData['complitionDate']));

                    $prodleadtime=date_diff(date_create($exfacendData['complitionDate']),date_create($cuttingstatrData['complitionDate']));



                    ?>

                    <tr class="card-body" style="background-color: #f9f9f9;">

                    <td width="17%" align="left"><div align="center"><?php echo str_replace('-','',$ttlorderleadtime->format("%R%a Days")); ?></div></td>

                    <td width="15%" align="center"><div align="center"><?php echo str_replace('-','',$ttfabricleadtime->format("%R%a Days")); ?></div></td>

                    <td width="17%" align="center"><div align="center"><?php echo str_replace('-','',$merhcleadtime->format("%R%a Days")); ?></div></td>

                    <td width="29%" align="center"><div align="center"><?php echo str_replace('-','',$prodleadtime->format("%R%a Days")); ?></div></td>

                    </tr>

                    </tbody>

                    </table>



                    </div>



                    <table class="table table-bordered" style="font-size: 12px;" width="100%">

                    <thead>

                    <tr class="border-top-info" style="background-color: #fff7b3;text-align: left;">

                    <th width="7%" align="center"><div align="center"><strong>SR</strong></div></th>

                    <th width="19%"><strong>Key&nbsp;Processes </strong></th>

                    <th width="10%">Planned</th>

                    <th width="20%">Critical&nbsp;Path </th>

                    <th width="9%">Actual</th>

                    <th width="8%"><div align="center">No of Days </div></th>

                    <th width="11%">Responsibility</th>

                    <th width="16%">Remark</th>

                    </tr>

                    </thead>

                    <tbody>

                    <?php

                    $snoo=0;

                    //$rs=GetPageRecord('*','taskListMaster','deletestatus=0 and status=1 and tnatemplate="'.$editresultstyle['tnaTemplateId'].'" and tna=1 order by id asc');



                    $rs=GetPageRecord('*','taskListMaster','1 and tnatemplate="'.$editresultstyle['tnaTemplateId'].'" and status=1 order by sr asc');

                    while($reslisttask=mysqli_fetch_array($rs)){



                    $where1='taskListId="'.$reslisttask['id'].'" and styleId="'.$resultpage['id'].'" and status=1';

                    $rs1=GetPageRecord('*','timeActionReport',$where1);

                    $data=mysqli_fetch_array($rs1);





                    ?>

                    <tr class="border-top-info">

                    <td align="center"><?php echo ++$snoo; ?></td>

                    <td>



                    <?php

                    $activityquery=GetPageRecord('name','tnaActivityMaster','1 and id="'.$reslisttask['name'].'"');

                    $activityData=mysqli_fetch_array($activityquery);

                    echo $activityData['name'];

                    ?>



                    </td>

                    <td style="background-color: #f9f9f9;"><?php if($data['complitionDate']!='' && $data['complitionDate']!='1970-01-01' && $data['complitionDate']!='0000-00-00'){ echo date('d-m-Y', strtotime($data['complitionDate'])); } ?></td>

                    <td>



                    <?php

                    $rs22=GetPageRecord('name','tnaActivityMaster','1 and id="'.$reslisttask['criticalPath'].'"');

                    $userss2=mysqli_fetch_array($rs22);

                    echo $userss2['name'];

                    ?>



                    </td>

                    <td style="background-color: #ffecfd;"><?php if($data['actualDate']!='' && $data['actualDate']!='1970-01-01' && $data['actualDate']!='0000-00-00'){ echo date('d-m-Y', strtotime($data['actualDate'])); } ?></td>



                    <td><div align="center"><?php echo $data['totaldays']; ?></div></td>



                    <td><?php echo getEmployeeName($data['responsiblity']); ?></td>

                    <td><input type="text" name="remark" id="remark<?php echo $data['id'];?>" value="<?php echo $data['remark']; ?>" style="width:100%;" onkeyup="addremarks<?php echo $data['id']; ?>();" /></td>

                    </tr>







                    <script>

                    function addremarks<?php echo $data['id']; ?>(){

                    var taskListId = '<?php echo $data['id']; ?>';

                    var remark = encodeURI($('#remark<?php echo $data['id'];?>').val());

                    $('#hiddentasklistremarkrkr').load('loadtimeaction.php?action=timeactionremarks&styleid=<?php echo $resultpage['id'];?>&taskid='+taskListId+'&remark='+remark);

                    }

                    </script>

                    <div id="hiddentasklistremarkrkr" style=" display:none;"></div>



                    <?php  }  ?>

                    </tbody>

                    </table>

                    </div>

                    <?php }else{ ?>

                    <div class="card-body listc">

                    <table class="table table-bordered" style="font-size: 12px;" width="100%">

                    <thead>

                    <tr class="border-top-info" style="background-color: #fff7b3;text-align: left;">

                    <th width="48" align="center"><div align="center">SR</div></th>

                    <th width="426">Key&nbsp;Processes </th>

                    <th width="218"><div align="center">Planned</div></th>

                    <th width="210"><div align="center">Actual</div></th>

                    <th width="289">Responsibility</th>

                    <th width="98" align="center" style="width:80px; display:none;">&nbsp;</th>

                    </tr>

                    </thead>

                    <tbody>

                    <?php

                    $select='';

                    $where='';

                    $rs='';

                    $select='*';

                    $where=' deletestatus=0 and status=1 and tnatemplate="'.$editresultstyle['tnaTemplateId'].'" order by sr asc';

                    $rs=GetPageRecord($select,'taskListMaster',$where);

                    $snono=0;

                    while($resListing=mysqli_fetch_array($rs)){



                    $select1='';

                    $where1='';

                    $select1='*';



                    $where1='taskListId="'.$resListing['id'].'" and styleId="'.$resultpage['id'].'"';

                    $rs1=GetPageRecord($select1,'timeActionReport',$where1);

                    $data=mysqli_fetch_array($rs1);

                    ?>

                    <tr class="border-top-info">

                    <td align="center"><?php echo ++$snono; ?></td>

                    <td>

                    <?php

                    $activityquery=GetPageRecord('name','tnaActivityMaster','1 and id="'.$resListing['name'].'"');

                    $activityData=mysqli_fetch_array($activityquery);

                    echo $activityData['name'];

                    ?>

                    <input type="hidden" name="taskListId" id="taskListId<?php echo $resListing['id']; ?>"/></td>

                    <td style="position: relative;padding: 5px;background-color: #f9f9f9;"><div align="center">

                    <input  name="complitionDate" type="text" class="form-control" id="complitionDate<?php echo $resListing['id']; ?>" style="position: relative; width: 140px; text-align: center;background-color: white;"  onchange="addTaskList<?php echo $resListing['id']; ?>();" value="<?php if($data['complitionDate']!='' && $data['complitionDate']!='1970-01-01'){ echo date('d-m-Y', strtotime($data['complitionDate'])); }if(1=='1970-01-01'){ echo  ''; } ?>"   maxlength="200" readonly="readonly">

                    </div></td>



                    <td style="position: relative;padding: 5px;background-color: #f9f9f9;"><div align="center">

                    <input  name="actualDate" type="text" class="form-control" id="actualDate<?php echo $resListing['id']; ?>" style="position: relative; width: 140px; text-align: center;background-color: white;" min="" onchange="addTaskList<?php echo $resListing['id']; ?>();"



                    value="<?php if($data['actualDate']!='' && $data['actualDate']!='0000-00-00' && $data['actualDate']!='1970-01-01'){ echo date('d-m-Y', strtotime($data['actualDate'])); }if($data['actualDate']=='0000-00-00' && $data['actualDate']!='1970-01-01'){ echo  ''; } ?>"   maxlength="200" readonly="readonly">



                    </div></td>





                    <td style="position: relative;">

                    <select name="responsiblity" id="responsiblity<?php echo $resListing['id']; ?>" onchange="addTaskList<?php echo $resListing['id']; ?>();" class="form-control">

                    <option value="">Select</option>

                    <?php

                    $mlk=GetPageRecord('id,empCode,name','employeeMaster','1 and name!="" order by name asc');

                    while($empData=mysqli_fetch_array($mlk)){

                    ?>

                    <option value="<?php echo $empData['id']; ?>" <?php if($empData['id']==$data['responsiblity']){ ?> selected="selected" <?php } ?>><?php echo $empData['name']; ?></option>

                    <?php } ?>

                    </select>



                    </td>

                    <td align="center" style="display:none;"><label class="checkbox-inline"> <input type="checkbox" onchange="addTaskList<?php echo $resListing['id']; ?>();" <?php if($data['status']=='1'){ ?> checked <?php } ?> data-toggle="toggle" name="status" id="status<?php echo $resListing['id']; ?>" value="1"></label></td>



                    </tr>



                    <script>

                    $( function(){

                    $( "#actualDate<?php echo $resListing['id']; ?>").datepicker();





                    } );



                    // $( function() {

                    //     var newdate=$('#complitionDate<?php echo $resListing['id'];?>').val();

                    //    			$( "#actualDate<?php echo $resListing['id']; ?>" ).datepicker({

                    //    				minDate: newdate

                    //    			});

                    //   		});





                    $( function(){

                    $( "#complitionDate<?php echo $resListing['id']; ?>").datepicker();

                    } );









                    function addTaskList<?php echo $resListing['id']; ?>(){



                    var taskListId = '<?php echo $resListing['id'];?>';



                    var actualDate = $('#actualDate<?php echo $resListing['id'];?>').val();



                    var complitionDate  = $('#complitionDate<?php echo $resListing['id'];?>').val();



                    var responsiblity = $('#responsiblity<?php echo $resListing['id'];?>').val();



                    var status1 =  $('input[id=status<?php echo $resListing['id'];?>]:checked').val();



                    if(status1==true){

                    status=1;

                    }else{

                    status=0;

                    }

                    $('#hiddentasklist').load('loadtimeaction.php?finalId=<?php echo $data['id'];?>&taskid='+taskListId+'&complitionDate='+complitionDate+'&actualDate='+actualDate+'&status='+status+'&responsiblity='+responsiblity+'&action=timeaction&styleid='+<?php echo $resultpage['id'];?>);



                    }

                    </script>

                    <div id="hiddentasklist" style=" display:none;"></div>



                    <?php  } ?>

                    </table>

                    <div class="text-right" style="padding-top: 10px;">

                    <button type="submit" style="margin:0px;" class="btn btn-primary" onClick="window.location.reload();">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true"></i></button>

                    </div>

                    </div>

                    <?php } ?>



                    </div>



                    </div>



                    </div>

                    </div>

                    </div>



                    </div>



                    </div>



                    <style>

                    .liststyleimg{float: left;

                    width: 70px;

                    margin-right: 15px;

                    padding: 5px;

                    border: 2px solid #e6e6e6;}



                    .badge.dropdown-toggle:after { display:none;

                    }



                    .btn-float i {

                    display: block;

                    top: 0;

                    font-size: 20px;

                    }



                    .card-group-control-right .card-body{width:100%;}



                    .table td, .table th {

                    vertical-align: middle !important;

                    }



                    .form-control {

                    display: block;

                    width: 100%;

                    font-size: .8125rem;

                    line-height: 1.5385;

                    color: #5d5d5d;

                    background-color: #fff;

                    background-clip: padding-box;

                    border: 1px solid #d8d8d8;

                    border-radius: 2px;

                    box-shadow: 0 0 0 0 transparent;

                    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;

                    }

                    .listc .table-bordered td, .table-bordered th {

                    border: 1px solid #ddd !important;

                    padding: 8px;

                    }





                    </style>



