	<div class="page-content">
	    <div class="content-wrapper">

	        <div class="content pt-0" style="margin-top: 20px; width: 80%; margin-left: auto; margin-right: auto;">
	            <div class="row">
	                <div class="col-xl-12">
					<?php if($_GET['alt']==1){ ?>
	                    <div style='width: 100%; text-align: center; color: #00cf75; font-size: 20px; margin-bottom: 20px; font-weight: 600;'
	                        id='thanksmsg'>Updated Successfully</div>
	                    <?php } ?>

	                    <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
	                        <div class="col-xl-9">
	                            <h5 class="card-title"><?php echo $pageName; ?></h5>
	                        </div>
	                        <div class="col-xl-3" style="padding-right: 0px;">
	                            <div class="btn-group justify-content-center" style="float:right;">
	                            </div>
	                        </div>
	                    </div>
	                    <form action="ac.crm" method="post" enctype="multipart/form-data" name="popid" target="acf"
	                        id="popid">
	                        <input name="action" type="hidden" id="action" value="saverecorderinput" />
	                        <input name="module" type="hidden" id="module" value="<?php echo $_REQUEST['module']; ?>" />

	                        <div class="card border-left-3 border-left-danger-400 rounded-left-0"
	                            style="border: 1px solid #ccc !important;">


	                            <div class="card-body">
	                                <div class="recorder-selection">
	                                    <input name="fromDate" type="text" class="newDatePicker form-control" id="fromDate"
	                                        value="<?php if($editresult['fromDate']!=''){ echo date('d-m-Y', strtotime($editresult['fromDate'])); }else{ echo date('d-m-Y'); } ?>">
	                                </div>

	                                <div class="recorder-selection">
	                                    <select class="form-control" name="factoryId" id="factoryId"
	                                        onchange="selectFactory(this.value);">
	                                        <option value="">Select Factory</option>
	                                        <?php
									// if($_SESSION['userid']==1){
									// $fk=GetPageRecord('*','recorderMaster','1 group by factoryId');
									//  }else{
									// $fk=GetPageRecord('*','recorderMaster','1 and userid="'.$_SESSION['userid'].'" group by factoryId');
									// }

									$fk = GetPageRecord('*', 'factoryMaster', '1 order by name asc');

									while ($factoryData = mysqli_fetch_array($fk)) {

									  $a = GetPageRecord('*', 'factoryMaster', 'id="' . $factoryData['id'] . '"');

									  $selectdata = mysqli_fetch_array($a); ?>

									  <option value="<?php echo $factoryData['id']; ?>"> <?php echo $selectdata['name']; ?></option>

									<?php } ?>

	                                    </select>
	                                </div>

	                                <div class="recorder-selection">
	                                    <div id="loadrecorderinputlines">
	                                        <select class="form-control" name="line" id="line"
	                                            onchange="selectDataStyle();">
	                                            <option value="">Select Line</option>
	                                        </select>
	                                    </div>
	                                </div>


	                                <script>
	                                function selectFactory(id) {
	                                    $('#loadrecorderinputlines').load('loadrecorderinputlines.php?id=' + id +
	                                        '&selectId=<?php echo $editresult['line']; ?>');
	                                }
	                                </script>


	                                <div class="recorder-selection">
	                                    <select class="form-control" name="hours" id="hours">
	                                        <option value="">Hours</option>
	                                        <option value="1st Hour">1st Hour</option>
	                                        <option value="2nd Hour">2nd Hour</option>
	                                        <option value="3rd Hour">3rd Hour</option>
	                                        <option value="4th Hour">4th Hour</option>
	                                        <option value="5th Hour">5th Hour</option>
	                                        <option value="6th Hour">6th Hour</option>
	                                        <option value="7th Hour">7th Hour</option>
	                                        <option value="8th Hour">8th Hour</option>
											<option value="9th Hour">9th Hour</option>
											<option value="10th Hour">10th Hour</option>
											<option value="11th Hour">11th Hour</option>
											<option value="12th Hour">12th Hour</option>
	                                    </select>
	                                </div>
	                            </div>





	                            <div class="">
	                                <div class="col-xl-12" style="padding: 5px 21px;">
	                                    <div id="loadrstyleinfo"></div>
	                                </div>
	                            </div>

								<div class="card-body" style="border:0px !important;">
	                                <div class="col-xl-12">
	                                    <h6>Man power</h6>
	                                    <div class="media"
	                                        style="background-color: #fbfbfb; padding: 15px; margin-top:0px;">
	                                        <div class="media-body">
	                                            <span class="text-muted">Operator</span><br><input type="text"
	                                                name="operator" id="operator" onkeyup="caltotal();">
	                                        </div>
	                                        <div class="media-body">
	                                            <span class="text-muted">Helper</span><br><input type="text" name="helper"
	                                                id="helper" onkeyup="caltotal();">
	                                        </div>
	                                        <div class="media-body">
	                                            <span class="text-muted">Supervisor</span><br><input type="text"
	                                                name="supervisor" id="supervisor" onkeyup="caltotal();">
	                                        </div>
	                                        <div class="media-body">
	                                            <span class="text-muted">Checker</span><br><input type="text"
	                                                name="checker" id="checker" onkeyup="caltotal();">
	                                        </div>
	                                        <div class="media-body">
	                                            <span class="text-muted">Total</span><br><input type="text" name="total"
	                                                id="total" readonly="">
	                                        </div>

	                                    </div>

	                                </div>

	                            </div>

	                            <div class="card-body recorder-input">
	                                <div class="col-xl-12">
	                                    <h6>Inputs</h6>
	                                    <div class="media-new">
	                                        <div class="media-body">
	                                            <span class="text-muted">Loading</span><br><input type="text"
	                                                name="loading" id="loading">
	                                        </div>
	                                        <div class="media-body">
	                                            <span class="text-muted">Output</span><br><input type="text" name="output"
	                                                id="output">
	                                        </div>

	                                        <div class="media-body" style="width:50%;">
	                                            <span class="text-muted">Remarks</span><br><input type="text"
	                                                name="remarks" id="remarks">
	                                        </div>


	                                    </div>


	                                    <div class="" style="width: 100%; text-align: center; margin-top: 25px;">

	                                        <button type="submit" class="btn btn-primary" style="margin:0px;">Save<i
	                                                class="fa fa-floppy-o ml-2" aria-hidden="true"
	                                                style="margin:0px;"></i></button>

	                                    </div>
	                                </div>



	                            </div>




	                        </div>
	                    </form>

	                </div>

	            </div>



	        </div>
	        <!-- /main content -->

	    </div>

	    <script>
	    function caltotal() {
	        var operator = Number($('#operator').val());
	        var helper = Number($('#helper').val());
	        var supervisor = Number($('#supervisor').val());
	        var checker = Number($('#checker').val());

	        var totalfinal = operator + helper + supervisor + checker;
	        $('#total').val(totalfinal);
	    }
	    </script>


	    <style>
	    .recorder-selection {
	        width: 24%;
	        float: left;
	        margin: 0px 5px;
	    }

	    .recorder-input {
	        width: 100%;
	        margin: auto;
	        border: 0px !important;
	    }

	    .recorder-input .media-body {
	        width: 22%;
	        float: left;
	        margin: 0px 9px;
	    }

	    .recorder-input input {
	        width: 100%;
	    }

	    .media-new {
	        width: 100%;
	        text-align: left;
	        margin: auto;
	        display: flow-root;
	        background-color: #fbfbfb;
	        padding: 15px;
	    }

	    .styleinfo .media-body {
	        border: 1px solid #ccc;
	        text-align: center;
	        padding: 10px 0px;

	    }

	    .styleinfo .media-body .text-muted {
	        color: #676767 !important;
	    }


	    @media only screen and (max-width:767px) {
	        .pt-0 {
	            width: 100% !important;
	        }

	        .card-body {
	            width: 100% !important;
	        }

	        .recorder-selection {
	            width: 100% !important;
	            float: left !important;
	            margin: 0px !important;
	            margin-bottom: 10px !important;
	        }

	        .media {
	            all: unset !important;
	        }

	        .media-body input {
	            width: 100% !important;
	        }

	        .recorder-input .media-body {
	            width: 100% !important;
	            float: left !important;
	            margin: 0px !important;
	            margin-bottom: 10px !important;
	        }

	        textarea {
	            width: 100% !important;
	        }

	        .media-new {
	            background-color: unset !important;
	            padding: 0px !important;
	        }

	        h5 {
	            font-size: 14px;
	        }
	    </style>