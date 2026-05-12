<div class="page-content">

		<!-- Main sidebar -->
		<?php include "left.php"; ?>

<div class="content-wrapper" style="overflow:hidden;">
	<div class="content pt-0" style="margin-top:20px;">
		<div class="row">
			<div class="col-xl-12">
				<div class="card-header header-elements-inline bg-blue-700" style="padding-left: 10px;">
					<div class="col-xl-12"><h5 class="card-title"><?php echo $pageName; ?></h5></div>
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
<h6 class="card-title" style="color: #000;">Party</h6>
</div>

<div class="card-body">
<blockquote class="blockquote py-2 mb-0">

<?php
$a=GetPageRecord('*','moduleMaster','1 and parentId=21 and sr=1 order by moduleName asc');
while($partyData=mysqli_fetch_array($a)){
?>
<a title="<?php echo $partyData['moduleName']; ?>" href="<?php echo $fullurl; ?>showpage.crm?module=<?php echo $partyData['url']; ?>"><i class="fa fa-dot-circle-o" aria-hidden="true" ></i> <?php echo $partyData['moduleName']; ?></a>
<?php } ?>
</blockquote>
</div>
</div>



<div class="card mystyle-cls">

<div class="card-header header-elements-sm-inline" style="background-color: #f7c40a96; padding-top: 5px; padding-bottom: 5px;">
<h6 class="card-title" style="color: #000;">Operations</h6>
</div>

<div class="card-body">
<blockquote class="blockquote py-2 mb-0">

<?php
$a=GetPageRecord('*','moduleMaster','1 and parentId=21 and sr=2 order by id asc');
while($partyData=mysqli_fetch_array($a)){
?>
<a title="<?php echo $partyData['moduleName']; ?>" href="<?php echo $fullurl; ?>showpage.crm?module=<?php echo $partyData['url']; ?>"><i class="fa fa-dot-circle-o" aria-hidden="true" ></i> <?php echo $partyData['moduleName']; ?></a>
<?php } ?>
</blockquote>
</div>


</div>


<div class="card mystyle-cls">
<div class="card-header header-elements-sm-inline" style="background-color: #f7c40a96; padding-top: 5px; padding-bottom: 5px;">
<h6 class="card-title" style="color: #000;">Factory</h6>
</div>

<div class="card-body">
<blockquote class="blockquote py-2 mb-0">

<?php
$a=GetPageRecord('*','moduleMaster','1 and parentId=21 and sr=3 order by moduleName asc');
while($partyData=mysqli_fetch_array($a)){
?>
<a title="<?php echo $partyData['moduleName']; ?>" href="<?php echo $fullurl; ?>showpage.crm?module=<?php echo $partyData['url']; ?>"><i class="fa fa-dot-circle-o" aria-hidden="true" ></i> <?php echo $partyData['moduleName']; ?></a>
<?php } ?>
</blockquote>
</div>
</div>

<div class="card mystyle-cls">
<div class="card-header header-elements-sm-inline" style="background-color: #f7c40a96; padding-top: 5px; padding-bottom: 5px;">
<h6 class="card-title" style="color: #000;">Costing</h6>
</div>

<div class="card-body">
<blockquote class="blockquote py-2 mb-0">

<?php
$a=GetPageRecord('*','moduleMaster','1 and parentId=21 and sr=4 order by moduleName asc');
while($partyData=mysqli_fetch_array($a)){
?>
<a title="<?php echo $partyData['moduleName']; ?>" href="<?php echo $fullurl; ?>showpage.crm?module=<?php echo $partyData['url']; ?>"><i class="fa fa-dot-circle-o" aria-hidden="true" ></i> <?php echo $partyData['moduleName']; ?></a>
<?php } ?>
</blockquote>
</div>
</div>


<div class="card mystyle-cls">
<div class="card-header header-elements-sm-inline" style="background-color: #f7c40a96; padding-top: 5px; padding-bottom: 5px;">
<h6 class="card-title" style="color: #000;">Stage / Category</h6>
</div>

<div class="card-body">
<blockquote class="blockquote py-2 mb-0">

<?php
$a=GetPageRecord('*','moduleMaster','1 and parentId=21 and sr=5 order by moduleName asc');
while($partyData=mysqli_fetch_array($a)){
?>
<a title="<?php echo $partyData['moduleName']; ?>" href="<?php echo $fullurl; ?>showpage.crm?module=<?php echo $partyData['url']; ?>"><i class="fa fa-dot-circle-o" aria-hidden="true" ></i> <?php echo $partyData['moduleName']; ?></a>
<?php } ?>
</blockquote>
</div>
</div>


<div class="card mystyle-cls">
<div class="card-header header-elements-sm-inline" style="background-color: #f7c40a96; padding-top: 5px; padding-bottom: 5px;">
<h6 class="card-title" style="color: #000;">Accounts</h6>
</div>

<div class="card-body">
<blockquote class="blockquote py-2 mb-0">

<?php
$a=GetPageRecord('*','moduleMaster','1 and parentId=21 and sr=6 order by moduleName asc');
while($partyData=mysqli_fetch_array($a)){
?>
<a title="<?php echo $partyData['moduleName']; ?>" href="<?php echo $fullurl; ?>showpage.crm?module=<?php echo $partyData['url']; ?>"><i class="fa fa-dot-circle-o" aria-hidden="true" ></i> <?php echo $partyData['moduleName']; ?></a>
<?php } ?>
</blockquote>
</div>
</div>


<div class="card mystyle-cls">
 <div class="card-header header-elements-sm-inline" style="background-color: #f7c40a96; padding-top: 5px; padding-bottom: 5px;">
<h6 class="card-title" style="color: #000;">Allowance</h6>
</div>

<div class="card-body">
<blockquote class="blockquote py-2 mb-0">

<?php
$a=GetPageRecord('*','moduleMaster','1 and parentId=21 and sr=7 order by id asc');
while($partyData=mysqli_fetch_array($a)){
?>
<a title="<?php echo $partyData['moduleName']; ?>" href="<?php echo $fullurl; ?>showpage.crm?module=<?php echo $partyData['url']; ?>"><i class="fa fa-dot-circle-o" aria-hidden="true" ></i> <?php echo $partyData['moduleName']; ?></a>
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

