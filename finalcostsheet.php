<div class="specialclassforsheetsecond" <?php if($_REQUEST['page']!='costsheet' && $_REQUEST['page']!='prototypesample') { ?> style="display:none;" <?php } ?>>

<table width="100%" class="table table-bordered table-responsive forbom" style="">			
<tbody style="width: 100%;display: inline-table;margin-bottom:20px;">
		<tr class="card-body" style="background: #e5fbfa;font-size: 15px;font-weight:600;">
		<td>M.R.P</td>
		<td>F.O.B</td>
		<td align="right">Margin</td>
		</tr>	
		
		<tr class="card-body" style="background: #f7f7f7;font-size: 15px;font-weight: 500;">
		<td><input type="number"  name="totalmrp<?php echo $_REQUEST['costsheetVersionId']; ?>" id="totalmrp<?php echo $_REQUEST['costsheetVersionId']; ?>" onkeyup="calculate_margin<?php echo $_REQUEST['costsheetVersionId']; ?>();" /></td>
		
		<td><span class="" name="mrptotallast<?php echo $_REQUEST['costsheetVersionId']; ?>" id="mrptotallast<?php echo $_REQUEST['costsheetVersionId']; ?>"></span></td>
		
		<td align="right"><span class="finalgrandtotalwithmrp<?php echo $_REQUEST['costsheetVersionId']; ?>" id="finalgrandtotalwithmrp<?php echo $_REQUEST['costsheetVersionId']; ?>">0.00</span></td>
		</tr>	
		
					
</tbody>
</table>

</div>