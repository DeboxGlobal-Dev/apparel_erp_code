

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<?php
if($loginuserprofileId==1 || $loginuserprofileId==93){

$wheresearchassign=' 1 and ';

} else {

if($loginuserprofileId==92){

$wheresearchassign=' 1 and finalstatus="2" and assignTo in (select id from '._USER_MASTER_.' where empId in (select id from employeeMaster where reportingTo='.$_SESSION['empid'].')) or assignTo="'.$_SESSION['userid'].'" and ';
} else{

$wheresearchassign=' ( id in (select styleId from styleAssignmentMaster where assignTo="'.$_SESSION['userid'].'" and styleAssignTo=0))';

$wheresearchassign=' '.$wheresearchassign.' and ';

}

}


?>

<div class="page-content">
  <div class="content-wrapper">
    <?php include "savealert.php"; ?>
    <div class="content pt-0" style="margin-top:20px;">
      <div class="row">
        <div class="col-xl-12">
          <div class="card-header header-elements-inline bg-blue-700 filterable" style="padding: 10px;">
            <div class="col-xl-9">
              <h5 class="card-title"><?php echo $pageName; ?></h5>
            </div>
            <div class="col-xl-1" style="padding-right: 0px;"> </div>

              <a href="download-ratioanalysis.php" class="btn bg-teal-400 addnotify" aria-expanded="false" style="background-color: #03d873b8;">Download Excel</a>

          </div>
          <div class="card">

            <form name="listform" id="listform" method="get">
              <input name="module" id="module" type="hidden" value="<?php echo $_REQUEST['module']; ?>" />
              <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                <div class="datatable-scroll">
                 <table class="table table-bordered capacity-class" style="width:100%;">
         			   <thead>
                        <tr style="background-color: #e9fff8;">
                            <th><div align="center">Buyer</div></th>
                            <th><div align="center">Brand</div></th>

                            <th><div align="center">Style</div></th>

                            <th><div align="center">Sub&nbsp;Category</div></th>

                                                        <th><div align="center">Gender</div></th>

                            <th><div align="center">Value&nbsp;Addition</div></th>


                            <th><div align="center">Quantity</div></th>

                         </tr>
                      </thead>
                       <tbody id="allhotellisting">


                      <tr>


                                                <?php
$no=1;
$select='*';
$where='';
$rs='';
$wheresearch='';
//$limit='20000';
$limit=clean($_GET['records']);
if($_GET['stylestatus']!=''){
$stylestatus = 'and finalstatus="'.$_GET['stylestatus'].'"';
}

if($_GET['stylestatus']=='0'){
$stylestatus = 'and stylestatus="'.$_GET['stylestatus'].'"';
}

$assignTo='';
if($_GET['assignTo']!=''){
$assignTo = 'and assignTo="'.decode($_GET['assignTo']).'"';
}

$categoryId='';
if($_GET['categoryId']!=''){
$categoryId = 'and categoryId="'.decode($_GET['categoryId']).'"';
}

if($_GET['assignToMerchant']!=''){
$assignToMerchant = 'and assignTo in (select id from userMaster where empId in (select id from employeeMaster where reportingTo in (select empId from userMaster where id="'.decode($_GET['assignToMerchant']).'")))';
}

if($_GET['a']=='1' && $loginuserprofileId==92){
$wheresearchassign = '';
}

if($_GET['tatstatus']!=''){
$tatstatusCondition = 'and styleTatStatus="'.$_GET['tatstatus'].'"';
}

if($loginuserprofileId==92){
$where='where '.$wheresearchassign.'  subject!=""   and deletestatus=0 and sampleStyle="1" order by id desc';
}else{
$where='where '.$wheresearchassign.' subject!=""  and deletestatus=0 and sampleStyle="1" order by id desc';
}

$page=$_GET['page'];


$targetpage=$fullurl.'loadstyle.php?module='.$modfile['moduleName'].'&records='.$limit.'&searchField='.$searchField.'&assignto='.$_GET['assignto'].'&loginuserprofileId='.$loginuserprofileId.'&categoryId='.$_GET['categoryId'].'&';

$rs=GetRecordListJs($select,_QUERY_MASTER_,$where,$targetpage);
$totalentry=$rs[1];
$paging=$rs[2];
while($resultlists=mysqli_fetch_array($rs[0])){

$selectimg='*';
$whereimg='parentId="'.$resultlists['id'].'" and galleryType="image_gallery" order by id asc';
$rsimg=GetPageRecord($selectimg,'imageGallery',$whereimg);
$imgresult=mysqli_fetch_array($rsimg);
$selectdays='*';
$wheredays='styleId="'.$resultlists['id'].'" and statusId=2';
$rsdays=GetPageRecord($selectdays,'styleAssignmentMaster',$wheredays);
$resultdays=mysqli_fetch_array($rsdays);

$rsList=GetPageRecord('name','productionStageMaster','id="'.$productionStage.'"');
$productionName=mysqli_fetch_array($rsList);

$rsList1=GetPageRecord('name','sampleTypeMaster','id="'.$resultlists['sampleType'].'"');
$smapleList=mysqli_fetch_array($rsList1);


$rsList1w=GetPageRecord('*','seasonMaster','id="'.$resultlists['seasonId'].'"');
$smapleListw=mysqli_fetch_array($rsList1w);


$rsList1we=GetPageRecord('*','subCategoryMaster','id="'.$resultlists['subCategoryId'].'"');
$smapleListwe=mysqli_fetch_array($rsList1we);

$rsList1cc=GetPageRecord('name','sampleTypeMaster','id="'.$resultlists['sampleType'].'"');
$smapleListcc=mysqli_fetch_array($rsList1cc);
$counst=0;
$rsList1ccx=GetPageRecord('*','styleColorDetailMaster','styleId="'.$resultlists['id'].'"');
$smapleListccx=mysqli_fetch_array($rsList1ccx);

$rsList1ccxss=GetPageRecord('*','embroideryTypeMaster','id="'.$smapleListccx['valueEdition'].'"');
$smapleListccxss=mysqli_fetch_array($rsList1ccxss);




$rsList1ccxz=GetPageRecord('*','colorCardMaster','id="'.$smapleListccx['colorId'].'"');
$smapleListccxz=mysqli_fetch_array($rsList1ccxz);


$rsList1ccxz1=GetPageRecord('*','categoryMaster','id="'.$resultlists['categoryId'].'"');
$smapleListccxz1=mysqli_fetch_array($rsList1ccxz1);



$selectdays='*';
$wheredayses='id="'.$resultlists['gender'].'" ';
$rsdayses=GetPageRecord($selectdays,'genderMaster',$wheredayses);
$resultdayses=mysqli_fetch_array($rsdayses);



?>


                    <tr role="row" class="odd">

                  <td><div align="center"><?php echo getBuyerName($resultlists['buyerId']); ?></div></td>
                  <td><div align="center"><?php echo getBrandName($resultlists['brandId']); ?></div></td>
                                    <td><div align="center"> <?php echo $resultlists['styleRefId'] ?></div></td>

                  <td><div align="center"> <?php echo $smapleListwe['name'] ?></div></td>

                                   <td><div align="center"><?php echo $resultdayses['name']; ?></div></td>





                  <td><div align="center"><?php if ( $smapleListccxss['name']=="None"){ echo "no"; } else { echo "yes"; } ?>  </div></td>



                  <td><div align="center">
                      <?php echo $smapleListccx['qty'] ?>
                      </div></td>

						</tr>


						<?php


						} ?>

                    </tbody>
                  </table>



                        <?php
                        $rsList1ccx11=GetPageRecord('*','styleColorDetailMaster','  qty<7000');
$smapleListccx11=mysql_num_rows($rsList1ccx11);



$rsList1ccx112=GetPageRecord('*','styleColorDetailMaster','qty>7000');
$smapleListccx112=mysql_num_rows($rsList1ccx112);


                        ?>
                        <div style="display:flex;">
                        <div id="columnchart_values" style="width: 800px; height: 400px;margin-top:20px;"></div>

                        <div id="columnchart_values1" style="width: 800px; height: 400px;margin-top:20px;"></div>

                        </div>



                        <div style="display:flex;">

                        <div id="columnchart_values2" style="width: 800px; height: 400px;"></div>
                        <div id="columnchart_values3" style="width: 800px; height: 400px;;"></div>

                        </div>




                        <div>


                        <div id="columnchart_values4" style="width: 800px; height: 400px;;"></div>


                        </div>

   <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Number", { role: "style" } ],
        ["<7000", <?php echo $smapleListccx11;  ?>, "blue"],
        [">7000", <?php echo $smapleListccx112;  ?>, "blue"],

      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Small vs Big Order-By Style",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>

  <?php

                        $rsList1ccx114=GetPageRecord('*','queryMaster','brandId="11" and deletestatus=0 and sampleStyle="1" and subject!=""');
                           while($smapleListccx114=mysqli_fetch_assoc($rsList1ccx114)){


$rsList1ccx1125=GetPageRecord('*','styleColorDetailMaster','styleId="'.$smapleListccx114['id'].'" and qty<7000');
$smapleListccx1125=mysql_num_rows($rsList1ccx1125);

$rsList1ccx11254=GetPageRecord('*','styleColorDetailMaster','styleId="'.$smapleListccx114['id'].'" and qty>7000');
$smapleListccx11254=mysql_num_rows($rsList1ccx11254);

}


                        $rsList1ccx114e=GetPageRecord('*','queryMaster','brandId="16" and deletestatus=0 and sampleStyle="1" and subject!=""');
                           while($smapleListccx114e=mysqli_fetch_assoc($rsList1ccx114e)){


$rsList1ccx1125e=GetPageRecord('*','styleColorDetailMaster','styleId="'.$smapleListccx114e['id'].'" and qty<7000');
$smapleListccx1125e=mysql_num_rows($rsList1ccx1125e);

$rsList1ccx11254e=GetPageRecord('*','styleColorDetailMaster','styleId="'.$smapleListccx114e['id'].'" and qty>7000');
$smapleListccx11254e=mysql_num_rows($rsList1ccx11254e);

}
$a=0;
$b=0;
  $gap=GetPageRecord('*','queryMaster','brandId="20" and deletestatus=0 and sampleStyle="1" and subject!=""');
                           while($gap1=mysqli_fetch_assoc($gap)){


$gap2=GetPageRecord('*','styleColorDetailMaster','styleId="'.$gap1['id'].'" and qty<7000');
$gap3=mysql_num_rows($gap2);
$a=$a+$gap3;
$gap4=GetPageRecord('*','styleColorDetailMaster','styleId="'.$gap1['id'].'" and qty>7000');
$gap5=mysql_num_rows($gap4);
$b=$b+$gap5;


}


$ao=0;
$ab=0;
  $aeo=GetPageRecord('*','queryMaster','brandId="19" and deletestatus=0 and sampleStyle="1" and subject!=""');
                           while($aeo1=mysqli_fetch_assoc($aeo)){


$aeo2=GetPageRecord('*','styleColorDetailMaster','styleId="'.$aeo1['id'].'" and qty<7000');
$aeo3=mysql_num_rows($aeo2);
$ao=$ao+$aeo3;
$aeo4=GetPageRecord('*','styleColorDetailMaster','styleId="'.$aeo1['id'].'" and qty>7000');
$aeo5=mysql_num_rows($aeo4);
$ab=$ab+$aeo5;

}

$ad=0;
$ad1=0;
  $and=GetPageRecord('*','queryMaster','brandId="18" and deletestatus=0 and sampleStyle="1" and subject!=""');
                           while($and1=mysqli_fetch_assoc($and)){


$and2=GetPageRecord('*','styleColorDetailMaster','styleId="'.$and1['id'].'" and qty<7000');
$and3=mysql_num_rows($and2);
$ad=$ad+$and3;
$and4=GetPageRecord('*','styleColorDetailMaster','styleId="'.$and1['id'].'" and qty>7000');
$and5=mysql_num_rows($and4);
$ad1=$ad1+$and5;


}

$cma=0;
$cmb=0;
  $cm=GetPageRecord('*','queryMaster','brandId="15" and deletestatus=0 and sampleStyle="1" and subject!=""');
                           while($cm1=mysqli_fetch_assoc($cm)){


$cm2=GetPageRecord('*','styleColorDetailMaster','styleId="'.$cm1['id'].'" and qty<7000');
$cm3=mysql_num_rows($cm2);
$cma=$cma+$cm3;
$cm4=GetPageRecord('*','styleColorDetailMaster','styleId="'.$cm1['id'].'" and qty>7000');
$cm5=mysql_num_rows($cm4);
$cmb=$cmb+$cm5;


}


$aus1=0;
$aus2=0;
  $austin=GetPageRecord('*','queryMaster','brandId="15" and deletestatus=0 and sampleStyle="1" and subject!=""');
                           while($austin1=mysqli_fetch_assoc($austin)){


$austin2=GetPageRecord('*','styleColorDetailMaster','styleId="'.$austin1['id'].'" and qty<7000');
$austin3=mysql_num_rows($austin2);
$aus1=$aus1+$austin3;
$austin4=GetPageRecord('*','styleColorDetailMaster','styleId="'.$austin1['id'].'" and qty>7000');
$austin5=mysql_num_rows($austin4);
$aus2=$aus2+$austin5;


}


$denim1=0;
$denim2=0;
  $dd=GetPageRecord('*','queryMaster','brandId="15" and deletestatus=0 and sampleStyle="1" and subject!=""');
                           while($dd1=mysqli_fetch_assoc($dd)){


$dd2=GetPageRecord('*','styleColorDetailMaster','styleId="'.$dd1['id'].'" and qty<7000');
$dd3=mysql_num_rows($dd2);
$denim1=$denim1+$dd3;
$austin4=GetPageRecord('*','styleColorDetailMaster','styleId="'.$dd1['id'].'" and qty>7000');
$dd5=mysql_num_rows($dd4);
$denim2=$denim2+$dd5;


}


$fc=0;
$fc1=0;
$ddr=GetPageRecord('*','queryMaster',' deletestatus=0 and sampleStyle="1" and subject!=""');
                           while($dd1r=mysqli_fetch_assoc($ddr)){


$rsList1ccxm=GetPageRecord('*','styleColorDetailMaster','styleId="'.$dd1r['id'].'"');
$smapleListccxm=mysqli_fetch_array($rsList1ccxm);


$rsList1ccxssv=GetPageRecord('*','embroideryTypeMaster','id="'.$smapleListccxm['valueEdition'].'" and name="none"');
$smapleListccxssv=mysql_num_rows($rsList1ccxssv);

$fc=$fc+$smapleListccxssv;

$rsList1ccxssv1=GetPageRecord('*','embroideryTypeMaster','id="'.$smapleListccxm['valueEdition'].'" and name!="none"');
$smapleListccxssv1=mysql_num_rows($rsList1ccxssv1);
$fc1=$fc1+$smapleListccxssv1;
}

  ?>


  <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', '>7000', '<7000'],


          ['Leather ', <?php  echo $smapleListccx1125; ?>, <?php  echo $smapleListccx11254; ?>],
                    ['Milange ', <?php  echo $smapleListccx1125e; ?>, <?php  echo $smapleListccx11254e; ?>],

          ['GAP ',  <?php  echo $a; ?>,  <?php  echo $b; ?>],

          ['AEO ', <?php  echo $ao; ?>, <?php  echo $ab; ?>],

          ['Club Monaco ', <?php  echo $cma; ?>, <?php  echo $cmb; ?>],

          ['Austin ', <?php  echo $aus1; ?>, <?php  echo $aus2; ?>],

          ['Denim Deck ',  <?php  echo $denim1; ?>,  <?php  echo $denim2; ?>],

          ['AND ', <?php  echo $ad; ?>, <?php  echo $ad1; ?>],




        ]);

        var options = {
          chart: {
            title: 'Small vs Big Order-By Style',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_values1'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>


     <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Gender", { role: "style" } ],
        ["Yes",  <?php  echo $fc1; ?>, "#82b767"],
        ["No",  <?php  echo $fc; ?>, "#82b767"],



      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Style With Value Addition",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values2"));
      chart.draw(view, options);
  }
  </script>



     <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
        ["Women", 0.5, "#0288d1"],
        ["Men", 2.5, "#0288d1"],
        ["Infants", 2.5, "#0288d1"],


      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Style by Gender",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values3"));
      chart.draw(view, options);
  }
  </script>


     <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
        ["Top", 0.5, "#0288d1"],
        ["Bottom", 2.5, "#0288d1"],
        ["Dress", 2.5, "#0288d1"],


      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "No. of Style by Category",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values4"));
      chart.draw(view, options);
  }
  </script>






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
