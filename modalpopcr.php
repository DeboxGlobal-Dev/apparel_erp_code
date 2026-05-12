<?php

include "inc.php";

?>
<script>

$(document).ready(function() {

$(".select2").select2();

});

</script>
<?php if($_REQUEST['action']=='addemailaccount'){

if($_REQUEST['id']!=''){

$select='*';

 $where='id="'.$_REQUEST['id'].'"';

$rs=GetPageRecord($select,_EMAIL_SETTING_MASTER_,$where);

$emailsetting=mysqli_fetch_array($rs);



 }
}
 ?>
<?php if($_REQUEST['action']=='uploadatechpackpatterncrit'){ ?>
<form action="all.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
    <input name="action" type="hidden" id="action" value="uploadatechpackpatterncrit" />
  <div class="card-body">
    <div class="row">
	 <div class="col-md-6">
        <div class="form-group">
          <label>Attach File</label>
          <div class="uniform-uploader">
            <input type="file" name="poattach" id="poattach" class="form-input-styled" data-fouc="" required="required">
            <span class="filename" style="user-select: none;">No file selected</span> <span class="action btn btn-secondary" style="user-select: none;"><i style="margin-top: 3px" class="fa fa-upload"></i></span>
            <script>

							$('#poattach').on('change',function(){

							//get the file name

							var fileName = $(this).val();

							//replace the "Choose a file" label

							$(this).next('.filename').html(fileName);

							})
$( function(){
$("#uploadDate" ).datepicker({ minDate: 0 });
} );
						</script>
          </div>
        </div>
      </div>
	  <div class="col-md-6">
        <div class="form-group">
          <label>Date</label>
          <input name="uploadDate" type="text" class="form-control validate readonly" id="uploadDate" value="<?php if($uploadDate!=''){ echo ''; }else{ echo date('d-M-Y'); }?>"  required="required">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Stage</label>
          <select name="stage" id="stage" class="form-control validate"  required="required">
          <option>Select</option>

            <option value="Proto">Proto</option>
            <option value="Fit Sample 1">Fit Sample 1</option>
			<option value="Fit Sample 2">Fit Sample 2</option>
			<option value="Fit Sample 3">Fit Sample 3</option>
			<option value="PP Sample">PP Sample</option>
			<option value="For Production">For Production</option>


          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Remark</label>
          <input name="remark" type="text" class="form-control validate" id="remark" value=""  required="required">
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
     <input name="styleId" type="hidden" id="styleId" value="4" />
    <button type="submit" class="btn bg-info">Save</button>
  </div>
  </form>
 <?php } ?>