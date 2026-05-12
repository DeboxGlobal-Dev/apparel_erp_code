<?php
include "inc.php";
$id=$_REQUEST['id'];

$select='*';
echo $where='id='.$id.'';
$rs=GetPageRecord($select,_QUERYMAILS_MASTER_,$where);
$resultpage=mysqli_fetch_array($rs);

?>

<div class="card-body navbar-light">
									<div class="media flex-column flex-md-row">
										<a href="#" class="d-none d-md-block mr-md-3 mb-3 mb-md-0">
											<span class="btn bg-teal-400 btn-icon btn-lg rounded-round">
												<span class="letter-icon"><?php echo substr($resultpage['fromMail'],0,1); ?></span>
											</span>
										</a>

										<div class="media-body">
											<h6 class="mb-0"><?php echo stripslashes($resultpage['subject']); ?></h6>
											<div class="letter-icon-title font-weight-semibold"><?php echo 'From: '.$resultpage['fromMail']; ?></div>
										</div>


										<div class="align-self-md-center ml-md-3 mt-3 mt-md-0">
											<ul class="list-inline list-inline-condensed mb-0">



										<li class="list-inline-item">
													<a href="showpage.crm?module=sent" class="btn btn-sm bg-transparent border-slate-300 text-slate rounded-round border-dashed">Back to all mails</a>
									</li>

											</ul>
										</div>
									</div>

									<div class="card-body">
<?php echo $resultpage['description'] ;?>
</div>

</div>


								</div>

