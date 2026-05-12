<?php

if($_GET['id']!=''){
$rs=GetPageRecord('*','lineLayoutMaster','id="'.decode($_GET['id']).'"');
$editresult=mysqli_fetch_array($rs);
$lastId=$editresult['id'];
}

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

$styleId=$editresultstyle['id'];

}
?>
<style>
.apparelclass tr td{
border-top:0px solid #ccc !important;
border:1px solid #ccc !important;
vertical-align:middle !important;
padding:10px!important;
}
.erpint{
    border: 1px solid #b3acac;
    padding: 3px;
}
.form-control{
 padding-left:0.5rem!important;
  padding-right:0.5rem!important;
}
</style>
	<div class="page-content">
		<div class="content-wrapper">
		 <?php include "savealert.php"; ?>

 	<div class="content pt-0" style="margin-top:20px;">

		 <?php include "top-style.php"; ?>

				<div class="row">

				<div class="col-xl-12">

				<div class="card" style="padding:15px">

              <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
                  <input name="action" type="hidden" id="action" value="loadlinelayout" />
					<input type="hidden" name="styleid" id="styleid" value="<?php echo $_GET['styleid']; ?>" />

			      <table class="table table-hover no-footer apparelclass" width="80%">

					<tr style="padding: 5px; font-size: 13px; font-weight: 600; background-color: #F8F8F8; margin-top: 0; position: relative;">
                      <td align="center"><div style="text-transform:capitalize;">S.&nbsp;No</div></td>
                      <td align="center"><div style="text-transform:capitalize;">GRADE</div></td>
					  <td align="center"><div style="text-transform:capitalize;">ATTACH.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">ALLOCATED M/C</div></td>
					  <td align="center"><div style="text-transform:capitalize;">&nbsp;&nbsp;MACHINE&nbsp;&nbsp;</div></td>
					  <td align="center"><div style="text-transform:capitalize;">OPERATION</div></td>
					  <td align="center"><div style="text-transform:capitalize;">OPERATION</div></td>
					  <td align="center"><div style="text-transform:capitalize;">&nbsp;&nbsp;MACHINE&nbsp;&nbsp;</div></td>
					  <td align="center"><div style="text-transform:capitalize;">ALLOCATED M/C</div></td>
					  <td align="center"><div style="text-transform:capitalize;">ATTACH.</div></td>
					  <td align="center"><div style="text-transform:capitalize;">GRADE</div></td>
                      <!--<td align="center"><div style="text-transform:capitalize;">S.&nbsp;No</div></td>-->
					  <td align="center"><div style="text-transform:capitalize;"><i class="icon-add" style="font-size:18px;cursor:pointer;" onclick="addnewrow(1);"></i></div></td>
                    </tr>

				   <tbody id="loadrow"></tbody>
				   <script>
				  function addnewrow(id){
					if(id==1){
						$("#loadrow").load('loadaction.php?add=1&action=loadlinelayout&styleId=<?php echo encode($styleId); ?>');
					}else{
						$('#loadrow').load('loadaction.php?action=loadlinelayout&styleId=<?php echo encode($styleId); ?>');
					}
				  }
				  addnewrow(0);

				  function deleteRow(id){
					var checkyes = confirm('Are your sure you you want to delete?');
						if(checkyes==true){
							$('#loadrow').load('loadaction.php?id='+id+'&deletestatus=yes&action=loadlinelayout&styleId=<?php echo encode($styleId); ?>');
						}
				  }
				  </script>
				  <div id="savedata" style="display:none;"></div>


					<tr style="padding: 10px; font-size: 13px; font-weight: 600; background-color: #eefafd; margin-top: 0; position: relative;">
                      <td colspan="5" align="center"><div style="text-transform:capitalize;">LOADING TABLE</div></td>
					  <td align="center"><div style="text-transform:capitalize;">COMPONENT LOADING</div></td>
					  <td align="center"><div style="text-transform:capitalize;">COMPONENT LOADING</div></td>
                      <td colspan="6" align="center"><div style="text-transform:capitalize;">LOADING TABLE</div></td>
                    </tr>


					 </table>
					          <br>
            <button type="submit" class="btn btn-primary" style="float:right"  onClick="window.location.reload();">Save<i class="fa fa-floppy-o ml-2" aria-hidden="true" style="margin:0px;"></i></button>
                </form>




				</div>



</div>

			</div>

		</div>

	</div>
	</div>


