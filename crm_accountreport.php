<div class="page-content">
		<?php include "left.php"; ?>

<style>
.col-md-3 a {
    background-color: #00b5ea;
    display: block;
    padding: 20px;
    margin: 20px 36px;
    font-size: 16px;
    color: #fff !important;
    border-radius: 10px;
    border: 2px solid #40434626;
}
</style>
</head>
<body>
<div class="content-wrapper">
	<div class="content pt-0" style="margin-top:20px;">
		<div class="row">
			<div class="col-xl-12">
				<div class="card-header header-elements-inline bg-info-700">
					<div class="col-xl-12"><h5 class="card-title"><?php echo $pageName; ?></h5></div>

					</div>
					<div class="card">

 					 <div class="report-section" style="background-image: url(images/reportbg.png); background-repeat: no-repeat; background-position: center bottom; background-size: 100%;">



<div id="pagelisterouter">
<div class="card" style="background-color: #ffffff0d; box-shadow: none !important; margin: 0px !important;">
   <div class="tab-content">
 <div class="container">
    <div class="row" style="text-align:center">

		<?php
		$rs=GetPageRecord('*','moduleMaster','1 and actionStatus=9 order by id asc');
		while($modulename=mysqli_fetch_array($rs)){

		?>
		<div class="col-md-3 col-sm-4 col-xs-12">
            <a href="showpage.crm?module=<?php echo $modulename['url']; ?>" id="button">
                <i class="fa fa-file" aria-hidden="true" style="font-size: 20px;margin-bottom: 15px !important;"></i><br><span><?php echo $modulename['moduleName']; ?></span>
            </a>
        </div>

		<?php } ?>


    </div>

</div>
        </div>
      </div>
</div> 	</td>
  </tr>

</tbody></table>
					 </div>


					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</div>

