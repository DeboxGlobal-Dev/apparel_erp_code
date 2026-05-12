<iframe id="acf" name="acf" style="display:none;"></iframe>
<iframe name="actionfrm" id="actionfrm" style="display:none;"></iframe>

<div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text">
						&copy; <?php echo date('Y'); ?>. Powered By <a title="Debox Global It Solutions Private Limited" href="http://www.deboxglobal.com" target="_blank"><img src="<?php echo $fullurl;?>global_assets/images/debox-logo.png" style="width: 50px; margin-left: 5px;"></a>
					</span>

					<ul class="navbar-nav ml-lg-auto" style="float:right;">
						<li class="nav-item" style="padding-top:5px;"><a href="mailto:support@deboxglobal.com" class="navbar-nav-link" target="_blank" style="color: rgba(51,51,51,.85);"><i class="icon-lifebuoy mr-2"></i> Support</a></li>
					</ul>
				</div>

<style>
  .mandat{
    color:red;
  }
#navbar-footer {
    display: block !important;
    position: absolute;
    bottom: 0px;
}
body{
padding-bottom:50px;
overflow-anchor: none;
}

#modalpop #navbar-footer{
display:none !important;
}

</style>

<?php
$i = 0;
$select22='*';
$where22=' styleId="'.$lastId.'" order by id asc';
$rs22=GetPageRecord($select22,'costsheetVersionMaster',$where22);
while($resListing22=mysqli_fetch_array($rs22)){
$i++;
?>
<iframe id="techpackiframe<?php echo $i; ?>" name="techpackiframe<?php echo $i; ?>" style="display:none;"></iframe>
<?php } ?>
<script>
function opmodalpop(header,url,width,height){
$('#titleheader').text(header);
$('#modalpop').css('width',width);
$('#modalpop').css('height',height);
$('#loadurl').load(encodeURI(url));
}

function reloadpage(){
location.reload();
}

$( function(){
	$( ".datepick" ).datepicker();

} );

$('#galleryimaage').owlCarousel({
      nav: true,
      items: 1,
      responsiveClass: true,
      touchDrag: true,
      mouseDrag: true,
      loop: true,
      margin: 20,
      autoplay: false,
      autoplayTimeout: 1000,
      autoplayHoverPause: true,
      dots: false,
      autoHeight: false
    });

$('.galleryimaage').owlCarousel({
      nav: false,
      items: 1,
      responsiveClass: true,
      touchDrag: true,
      mouseDrag: true,
      loop: true,
      margin: 20,
      autoplay: false,
      autoplayTimeout: 1000,
      autoplayHoverPause: true,
      dots: false,
      autoHeight: false
    });


 $('.buyerslider').owlCarousel({
      nav: true,
      items: 1,
      responsiveClass: true,
      touchDrag: true,
      mouseDrag: true,
      loop: true,
      margin: 20,
      autoplay: false,
      autoplayTimeout: 2000,
	  smartSpeed: 2000,
      autoplayHoverPause: true,
      dots: false,
      autoHeight: false
    });

</script>
<div id="modalpop" class="modal fade" style="margin:auto;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h6 class="modal-title" id="titleheader">Info header</h6>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div id="loadurl">Loading</div>
    </div>
  </div>
</div>
<script>
function reload_page(){
location.reload();
}
</script>
<script>
setTimeout(function(){
  $('#suceess-message').remove();
}, 3000);

</script>
<script>

$(document).ready(function(){
    $('.filterable .btn-filter').click(function(){
        var $panel = $(this).parents('.filterable'),
        $filters = $panel.find('.filters input'),
        $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

    $('.filterable .filters input').keyup(function(e){
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
        inputContent = $input.val().toLowerCase(),
        $panel = $input.parents('.filterable'),
        column = $panel.find('.filters th').index($input.parents('th')),
        $table = $panel.find('.table'),
        $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function(){
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
        }
    });
});

</script>
<script>
$(document).ready(function() {
$(".select2").select2();
});
</script>

<script>
	function uploaduserfilesfun()
	{
	  $('#frmposthome2').submit();
	  $('#commonloader').show();

	 var hpotohomeidhtml = $('#hpotohomeidftr').html();

	  $('#chatattachedfile').remove();
	  $('#hpotohomeidftr').html(hpotohomeidhtml);

	}
	</script>

<?php if($_GET['module']=="chat"){ ?>
<div class="loader" id="commonloader" style="display:none;"><span><img src="<?php echo $fullurl;?>images/loader.gif">
   <span>Please wait...</span> </span>
</div>
<?php } ?>

<div id="getnotifications" style="display:none;"></div>

<script>
$('.newDatePicker').Zebra_DatePicker({
		format: 'd-m-Y',
		});
</script>



