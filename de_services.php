<?php
if($addpermission!=1 && $_GET['id']==''){
header('location:'.$fullurl.'');
}

$paymentTerm=1;
$select1='*';
$where1='id=1';
$rs1=GetPageRecord($select1,'services',$where1);
$editresult=mysqli_fetch_array($rs1);
$id=clean($editresult['id']);
$title=clean($editresult['title']);
$description=clean($editresult['description']);
 $updatedDate=clean($editresult['updatedDate']);

?>
	<script src="<?php echo $fullurl; ?>ckeditor/ckeditor.js"></script>
			<div class="content">
				<!-- Select2 selects -->
				<form action="ac.de" method="post" enctype="multipart/form-data" name="addedit" target="acf" id="addedit">
				<div class="row">
					<div class="col-md-12">
					<div class="page-header page-header-light">

				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
					<div class="page-title d-flex">
						<h4>About Us</h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
					</div>
					<div class="header-elements d-none"> <button type="button" class="btn btn-primary" onclick="formValidation('addedit','savebutton','0');" >Save&nbsp; <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
					</div>
				</div>
			</div>


						<div class="card">
							<div class="card-header header-elements-inline"> 							</div>
							<div class="card-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Title</label>
				                                <input name="title" type="text" class="form-control" id="title" value="<?php echo $title; ?>" >
			                                </div>
										</div>
										<div class="col-md-6">

										</div>

									</div>


	 								<div class="row">
										<div class="col-md-12">
										<div class="form-group">
										<label>Description</label>
									    <textarea name="description" class="form-control" id="description"><?php echo stripslashes($description); ?></textarea>

										</div>
										</div>
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
									</div>

						    </div>
						</div>


					</div>

				</div>
				    <input name="editid" type="hidden" id="editid" value="<?php echo encode($id); ?>" />
					<input name="module" type="hidden" id="module" value="services" />
					<input name="action" type="hidden" id="action" value="editservices" />
			</form>
			</div>


