<div class="page-content">
  <div class="content-wrapper" style="overflow:hidden;">
    <div class="content pt-0" style="margin-top:20px;">
      <div class="row">
        <div class="col-xl-12">
          <div class="card-header header-elements-inline bg-blue-700" style="padding-left: 10px;">
            <div class="col-xl-12">
              <h5 class="card-title"><?php echo $pageName; ?></h5>
            </div>
          </div>

		  <div class="card">
            <div class="row" style="margin-top:20px;">
              <div class="col-md-12" style=" padding:0px 25px;">
                <form action="" method="get">
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <input type="text" placeholder="Search:" name="filtersearch" id="filtersearch" class="form-control"/>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>


		    <div class="card mystyle-cls" style="padding-left:0px !important;">
            <div class="card-header header-elements-sm-inline" style="background-color: #f7c40a96; padding-top: 5px; padding-bottom: 5px;">
              <h6 class="card-title" style="color: #000;">Sampling</h6>
            </div>
            <div class="card-body">
              <blockquote class="blockquote py-2 mb-0">

<?php
$a=GetPageRecord('*','moduleMaster','1 and parentId=334 and sr=1 order by srreport asc');
while($partyData=mysqli_fetch_array($a)){
?>


               <a title="<?php echo $partyData['moduleName']; ?>" href="<?php echo $fullurl; ?>showpage.crm?module=<?php echo $partyData['url']; ?>"> <i class="fa fa-dot-circle-o" aria-hidden="true" ></i><?php if($partyData['id']=='408' || $partyData['id']=='409'|| $partyData['id']=='416'|| $partyData['id']=='419'){ ?> <span style=" font-weight:500;"><?php echo $partyData['moduleName'];  ?></span><?php }else{ echo $partyData['moduleName']; }  ?></a>
                <?php } ?>
              </blockquote>
            </div>
          </div>
             <div class="card mystyle-cls" style="padding-left:0px !important;">
            <div class="card-header header-elements-sm-inline" style="background-color: #f7c40a96; padding-top: 5px; padding-bottom: 5px;">
              <h6 class="card-title" style="color: #000;">Merchandising</h6>
            </div>
            <div class="card-body">
              <blockquote class="blockquote py-2 mb-0">
                <?php
$a=GetPageRecord('*','moduleMaster','1 and parentId=334 and sr=2 order by srreport asc');
while($partyData=mysqli_fetch_array($a)){
?>
               <a title="<?php echo $partyData['moduleName']; ?>" href="<?php echo $fullurl; ?>showpage.crm?module=<?php echo $partyData['url']; ?>"> <i class="fa fa-dot-circle-o" aria-hidden="true" ></i><?php if($partyData['id']=='410' || $partyData['id']=='406' || $partyData['id']=='413' || $partyData['id']=='414'  || $partyData['id']=='424'  || $partyData['id']=='425'  || $partyData['id']=='422'){ ?> <span style=" font-weight:500;"><?php echo $partyData['moduleName'];  ?></span><?php }else{ echo $partyData['moduleName']; }  ?></a>
                <?php } ?>
              </blockquote>
            </div>
          </div>
		  <div class="card mystyle-cls" style="padding-left:0px !important;">
            <div class="card-header header-elements-sm-inline" style="background-color: #f7c40a96; padding-top: 5px; padding-bottom: 5px;">
              <h6 class="card-title" style="color: #000;">Supply Chain</h6>
            </div>
            <div class="card-body">
              <blockquote class="blockquote py-2 mb-0">
                <?php
$a=GetPageRecord('*','moduleMaster','1 and parentId=334 and sr=3 order by srreport asc');
while($partyData=mysqli_fetch_array($a)){
?>
                <a title="<?php echo $partyData['moduleName']; ?>" href="<?php echo $fullurl; ?>showpage.crm?module=<?php echo $partyData['url']; ?>"> <i class="fa fa-dot-circle-o" aria-hidden="true" ></i><?php if($partyData['id']=='428' || $partyData['id']=='406' || $partyData['id']=='413' || $partyData['id']=='414' || $partyData['id']=='426' || $partyData['id']=='427' || $partyData['id']=='429' || $partyData['id']=='430' || $partyData['id']=='431' || $partyData['id']=='432' || $partyData['id']=='484' || $partyData['id']=='486'|| $partyData['id']=='487' || $partyData['id']=='493'){ ?> <span style=" font-weight:500;"><?php echo $partyData['moduleName'];  ?></span><?php }else{ echo $partyData['moduleName']; }  ?></a>
                <?php } ?>
              </blockquote>
            </div>
          </div>

		  <div class="card mystyle-cls" style="padding-left:0px !important;">
            <div class="card-header header-elements-sm-inline" style="background-color: #f7c40a96; padding-top: 5px; padding-bottom: 5px;">
              <h6 class="card-title" style="color: #000;">Production</h6>
            </div>
            <div class="card-body">
              <blockquote class="blockquote py-2 mb-0">
                <?php
$a=GetPageRecord('*','moduleMaster','1 and parentId=334 and sr=4 and id not in (444,442) order by srreport asc');
while($partyData=mysqli_fetch_array($a)){
?>
                <a title="<?php echo $partyData['moduleName']; ?>" href="<?php echo $fullurl; ?>showpage.crm?module=<?php echo $partyData['url']; ?>"><i class="fa fa-dot-circle-o" aria-hidden="true" ></i><?php if($partyData['id']=='440' || $partyData['id']=='445' || $partyData['id']=='443' || $partyData['id']=='441' || $partyData['id']=='433' || $partyData['id']=='492' || $partyData['id']=='491' ) { ?><span style=" font-weight:500;"> <?php echo $partyData['moduleName']; ?></span><?php }else{ echo $partyData['moduleName']; }  ?></a>
                <?php } ?>
              </blockquote>
            </div>
          </div>

		  <div class="card mystyle-cls" style="padding-left:0px !important;">
            <div class="card-header header-elements-sm-inline" style="background-color: #f7c40a96; padding-top: 5px; padding-bottom: 5px;">
              <h6 class="card-title" style="color: #000;">Logistic & Shipping</h6>
            </div>
            <div class="card-body">
              <blockquote class="blockquote py-2 mb-0">
                <?php
$a=GetPageRecord('*','moduleMaster','1 and parentId=334 and sr=5 and id not in (448,451,450,489,490) order by srreport asc');
while($partyData=mysqli_fetch_array($a)){
?>
                <a title="<?php echo $partyData['moduleName']; ?>" href="<?php echo $fullurl; ?>showpage.crm?module=<?php echo $partyData['url']; ?>"><i class="fa fa-dot-circle-o" aria-hidden="true" ></i> <?php if($partyData['id']=='447' || $partyData['id']=='449' ) { ?><span style=" font-weight:500;"> <?php echo $partyData['moduleName']; ?></span><?php }else{ echo $partyData['moduleName']; }  ?></a>
                <?php } ?>
              </blockquote>
            </div>
          </div>

		  <div class="card mystyle-cls" style="padding-left:0px !important; display: none;">
            <div class="card-header header-elements-sm-inline" style="background-color: #f7c40a96; padding-top: 5px; padding-bottom: 5px;">
              <h6 class="card-title" style="color: #000;">Audit & Finance</h6>
            </div>
            <div class="card-body">
              <blockquote class="blockquote py-2 mb-0">
                <?php
$a=GetPageRecord('*','moduleMaster','1 and parentId=334 and sr=6 and id not in (435,454,456,505) order by srreport asc');
while($partyData=mysqli_fetch_array($a)){
?>
                <a title="<?php echo $partyData['moduleName']; ?>" href="<?php echo $fullurl; ?>showpage.crm?module=<?php echo $partyData['url']; ?>"><i class="fa fa-dot-circle-o" aria-hidden="true" ></i> <?php echo $partyData['moduleName']; ?></a>
                <?php } ?>
              </blockquote>
            </div>
          </div>

		  <!--<div class="card mystyle-cls" style="padding-left:0px !important;">
            <div class="card-header header-elements-sm-inline" style="background-color: #f7c40a96; padding-top: 5px; padding-bottom: 5px;">
              <h6 class="card-title" style="color: #000;">Business Intelligence Desk</h6>
            </div>
            <div class="card-body">
              <blockquote class="blockquote py-2 mb-0">
                <?php
$a=GetPageRecord('*','moduleMaster','1 and parentId=334 and sr=7  order by srreport asc');
while($partyData=mysqli_fetch_array($a)){
?>
                <a title="<?php echo $partyData['moduleName']; ?>" href="<?php echo $fullurl; ?>showpage.crm?module=<?php echo $partyData['url']; ?>"><i class="fa fa-dot-circle-o" aria-hidden="true" ></i> <?php echo $partyData['moduleName']; ?></a>
                <?php } ?>
              </blockquote>
            </div>
          </div>-->



		  	  <div class="card mystyle-cls" style="padding-left:0px !important;">
            <div class="card-header header-elements-sm-inline" style="background-color: #f7c40a96; padding-top: 5px; padding-bottom: 5px;">
              <h6 class="card-title" style="color: #000;">Order Analytics</h6>
            </div>
            <div class="card-body">
              <blockquote class="blockquote py-2 mb-0">
                <?php
$a=GetPageRecord('*','moduleMaster','1 and parentId=334 and sr=8 order by srreport asc');
while($partyData=mysqli_fetch_array($a)){
?>
                <a title="<?php echo $partyData['moduleName']; ?>" href="<?php echo $fullurl; ?>showpage.crm?module=<?php echo $partyData['url']; ?>"><i class="fa fa-dot-circle-o" aria-hidden="true" ></i><?php if($partyData['id']=='411' || $partyData['id']=='412' ) { ?><span style=" font-weight:500;"> <?php echo $partyData['moduleName']; ?></span><?php }else{ echo $partyData['moduleName']; }  ?></a>
                <?php } ?>
              </blockquote>
            </div>
          </div>

          <div class="card mystyle-cls" style="padding-left:0px !important;">
            <div class="card-header header-elements-sm-inline" style="background-color: #f7c40a96; padding-top: 5px; padding-bottom: 5px;">
              <h6 class="card-title" style="color: #000;"> New Dashboard Reports</h6>
            </div>
            <div class="card-body">
              <blockquote class="blockquote py-2 mb-0">
                <?php
$a=GetPageRecord('*','moduleMaster','1 and parentId=334 and sr=9 order by srreport asc');
while($partyData=mysqli_fetch_array($a)){
?>
                <a title="<?php echo $partyData['moduleName']; ?>" href="<?php echo $fullurl; ?>showpage.crm?module=<?php echo $partyData['url']; ?>"><i class="fa fa-dot-circle-o" aria-hidden="true" ></i><?php if($partyData['id']=='411' || $partyData['id']=='412' ) { ?><span style=" font-weight:500;"> <?php echo $partyData['moduleName']; ?></span><?php }else{ echo $partyData['moduleName']; }  ?></a>
                <?php } ?>
              </blockquote>
            </div>
          </div>




        </div>
      </div>
    </div>
  </div>
</div>
</div>
<style>
.mystyle-cls a {
    color: #0097a7;
    line-height: 24px;
    font-size: 12px;
	display:block;
    width: 230px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.mystyle-cls {
    width: 20%;
    display: block;
    float: left;
    margin-left: 0px;
    border: 1px solid #f7f7f7;
}
.fa-dot-circle-o{
margin-right:5px;
}

.mystyle-cls .card-body {
    height: 250px;
    overflow-y: auto;
}

</style>
<script>
$(document).ready(function(){
$("#filtersearch").on("keyup", function() {
var value = $(this).val().toLowerCase();
$(".blockquote a").filter(function() {
$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
});
});
});
</script>
