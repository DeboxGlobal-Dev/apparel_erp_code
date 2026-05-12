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

?>
	<div class="page-content">
 <?php include "left.php"; ?>
		 <div class="content-wrapper">
 <div class="content pt-0" style="margin-top:20px;">
  	<?php include "top-style.php"; ?>




<h3>criticalpath test</h3>

      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-white">
              <h6 class="card-title">Critical List</h6>
            </div>
            <div class="card-body">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
				  <table width="100%" border="1" cellspacing="2" cellpadding="8" style="border:1px solid #ccc;">

					  <thead style="background: #ffffed;">
						<th>Stage</th>
						<th>Date</th>
						<th>Remark</th>
						<th>Attachment</th>
					  </thead>
						<?php
						$no = 1;
						$rs1=GetPageRecord('*','criticpop',' and styleId="4" order by id desc');
						while($result1=mysqli_fetch_array($rs1)){
						?>
					   <tr>
						<td><?php echo $result1['stage']; ?></td>
						<td><?php echo date('d-M-Y',strtotime($result1['uploadDate'])); ?></td>
						<td><?php echo $result1['remark']; ?></td>
						<td><a href="images/<?php echo $result1['attachtp']; ?>" target="blank" ><i class="fa fa-download mr-2"></i>Download</a> </td>
					  </tr>
					  <?php }

					   ?>
					</table>
				  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

			 	<div class="row">
			 	<div class="col-xl-12">
				<div class="card">







	</div>
</div>
</div>
</div></div></div>



<style>
.nav-justified .nav-item {
    text-align: center;
    width: 50% !important;
    display: contents;
    float: left;
}

.nav-tabs-highlight .nav-link {
    width: 50% !important;
    float: left;

}
.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #333;
    background-color: #fff;
    border-color: #ddd #ddd #fff;
    background-color: #fff178 !important;
    border: 1px solid #ccc;
}
.nav-tabs-highlight .nav-link {
    width: 50% !important;
    float: left;
    border: 1px solid #e9e9e9;
    background-color: #f9f9f9 !important;
}
</style>

<style>
input[type=checkbox], input[type=radio] {

    display: none !important;
}
</style>