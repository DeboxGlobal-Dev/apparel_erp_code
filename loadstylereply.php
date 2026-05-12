<?php
include "inc.php";
include "config/logincheck.php";
?>

<form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf" id="popid">
<input name="styleid" type="hidden" id="styleid" value="<?php echo $_REQUEST['styleid']?>" />
<input name="action" type="hidden" id="action" value="stylemailreply" />

<button type="button" class="btn btn-light" id="popover-show" data-original-title="" title="" aria-describedby="popover394955" style="margin-bottom: 10px;"><span style="font-weight:600;">Assign To : </span>
<?php
$select1='*';
$id1=$_REQUEST['assignTo'];
$where1='id='.$id1.'';
$rs1=GetPageRecord($select1,'userMaster',$where1);
$resultpage1=mysqli_fetch_array($rs1);
echo $resultpage1['email'];

?>
</button>

<div class="row">
<div class="col-md-12">
	<div class="form-group">
	<label for="ccmail">Add More Emails (Comma Separated Emails)</label>
	<input name="ccmail" type="text" class="form-control" id="ccmail" placeholder="test1@gmail.com,test2@gmail.com">
	</div>
</div>
</div>


<textarea id="description" name="description"></textarea>

<div class="modal-footer" style="padding-right: 0px;margin-top: 10px;">
<button type="button" class="btn btn-link" data-dismiss="modal" onClick="cancelreply();">Close</button>
<button type="submit" class="btn bg-info">Send</button>
</div>
</form>

<script>
function cancelreply(){
 $('#stylemailreply').show();
 $('#loadstylereply').hide();
}
</script>


<style>
.mailusersbox strong {
display: block;
font-size: 10px;
font-weight: 500;
margin: 3px 0px;
background-color: #efefef;
padding: 4px;
color: #000000a3;
text-transform: uppercase;
}
.mailusers{
margin: 0px;
padding: 10px 0px;
background-color: #fff;
width: 100%;
display: flex;
}
.mailusers .mailusersbox {
    margin: 0px 0px 0px 0px;
    width: 30%;
    float: left;
    display: block;
}
</style>


<script>
ClassicEditor
   .create( document.querySelector( '#description' ) )
   .then( editor => {
       console.log( editor );
   } )
   .catch( error => {
       console.error( error );
   } );
</script>