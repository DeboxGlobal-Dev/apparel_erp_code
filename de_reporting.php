<div class="page-content">

		<!-- Main sidebar -->
		<?php include "left.php"; ?>
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<div class="page-header">
				<div class="page-header-content header-elements-md-inline"style="position:relative;"><div style="position:absolute; right:20px; top:40px;"><table width="200" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="2"> 
      <input type="text" name="textfield" id="keywordsearch" style="    padding: 7px;
    border: 1px solid #ccc;
    border-radius: 2px;" placeholder="Keyword" onkeyup="searching();"/> </td>
    <td> 
      <select name="select"  id="month"  onchange="searching();" style="    padding: 9px;
    border: 1px solid #ccc;
    border-radius: 2px;">
        <option value="1">Today</option>
        <option value="2">Yesterday</option>
        <option value="3">This Week</option>
        <option value="4">This Month</option>
      </select>
 </td>
  </tr>
  
</table>
</div>
					<div class="page-title d-flex" >
					
						<h4><span class="font-weight-semibold">Chat Widget</span> -  Reporting (<span id="totoalusers"></span>)</h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					 
				</div>
			</div>
			<!-- /page header -->


			<!-- Content area -->
			<div class="content pt-0">

				 
 

				<!-- Dashboard content -->
				<div class="row">
				<div class="col-xl-12">
				<div class="card">
				<div class="table-responsive">
						<div class="table-responsive" id="activeurls">
							<div style="padding:20px; text-align:center;">Searching....</div>	
				  </div>
				  </div>
						</div> 
 

					</div>

					 
				</div>
				<!-- /dashboard content -->

			</div>
			<!-- /content area -->


			<!-- Footer -->
			 
			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
 
 <script>
function searching(){
var keywordsearch = encodeURI($('#keywordsearch').val());
var month = encodeURI($('#month').val());
$('#activeurls').load('loadaction.php?action=searching&month='+month+'&keywordsearch='+keywordsearch);
 }
 searching();
</script>