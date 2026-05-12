
<div class="page-content">
  <div class="content-wrapper">
    <div class="content pt-0" style="margin-top:20px; overflow:hidden;">
      <div class="row" >
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-white">
              <div style="display:flex">
                <h6 class="card-title"><strong><?php echo $pageName; ?></strong></h6>
                <a href="showpage.crm?module=masters"  class="btn bg-teal-400" aria-expanded="false" style="background-color: gray;position: relative;left: 85%;"><i class="fa fa-arrow-left mr-2"></i>Back</a> </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <div class="row">
                  <table width="100%" border="0" cellpadding="5" cellspacing="0" class="table" style="font-size:11px !important;">
                    <tr height="50" style="padding: 10px; font-size: 11px; font-weight: 600; background-color: #F8F8F8; margin-top: 10px; position: relative;">
                      <td width="7%" align="center"><div align="center"><a onClick="addNewRow(1);" style="color:#0000FF; cursor: pointer;">+Add&nbsp;New</a>
                          </th>
                        </div></td>
                      <td width="6%"><div align="center">S.No.</div></td>
                      <td width="27%"><div align="left">Order Qty (Per Colour)</div></td>
                      <td width="15%"><div align="center">Allowed %</div></td>
                      <td width="15%"><div align="center">Extra for Emb.</div></td>
                      <td width="15%"><div align="center">Garment Dying</div></td>
                      <td width="15%"><div align="center">Printing</div></td>
                      <td width="15%"><div align="center">RFD</div></td>
                      <td width="15%"><div align="center">Solid Dyeing</div></td>
                      <td width="15%"><div align="center">Total allowance %</div></td>
                    </tr>
                    <tbody id="addrow">
                    </tbody>
                    <script>  
				function addNewRow(id){
				if(id==1){
				$("#addrow").load('loadrejectioninproduction.php?add=1&styleId=<?php echo encode($lastId); ?>');
				}else{
				$("#addrow").load('loadrejectioninproduction.php?styleId=<?php echo encode($lastId); ?>');
				}
				
				}
				addNewRow(0); 
				 
				function deleteRow(id){
				var checkyes = confirm('Are your sure you you want to delete?');
				if(checkyes==true){
				$('#addrow').load('loadrejectioninproduction.php?id='+id+'&deletestatus=yes&styleId=<?php echo encode($lastId); ?>');
				}
				}
				</script>
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
<style>
table tr td {
    border: 1px solid #ccc !important;
    padding: 5px 5px !important;
	    vertical-align: middle !important;
} 
 
</style>
