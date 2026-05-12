<?php
if($loginuserprofileId==1){
$wheresearchassign=' 1 and ';
} else {
$wheresearchassign=' ( assignTo in (select id from '._USER_MASTER_.' where  empId in (select id from employeeMaster where id ='.$_SESSION['empid'].')) or assignTo in (select id from '._USER_MASTER_.' where  empId in (select reportingTo from employeeMaster where id="'.$_SESSION['empid'].'"))) ';
$wheresearchassign=' '.$wheresearchassign.' and ';
}


?>
<div class="page-content">
    <style>
    .even {
        background-color: #0097a71a;
    }

    .iconlistset {
        width: 34px;
        background-color: #000099;
        padding: 5px 5px;
        overflow: hidden;
        float: left;
        border-radius: 50px;
        height: 34px;
        margin: 0px 3px;
        cursor: pointer;
    }

    .iconlistset img {
        width: 16px;
        margin-top: 6px;
        mage-rendering: auto;
        image-rendering: crisp-edges;
        image-rendering: pixelated;
    }
    </style>
    <!-- Main sidebar -->
    <?php include "left.php"; ?>
    <div class="content-wrapper">
        <!---Save Alert Notification---->
        <?php include "savealert.php"; ?>
        <div class="content pt-0" style="margin-top:20px;">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card-header header-elements-inline bg-blue-700" style="padding: 10px;">
                        <div class="col-xl-9">
                            <h5 class="card-title"><?php echo $pageName; ?></h5>
                        </div>
                        <div class="col-xl-3" style="    padding-right: 0px;">
                            <div class="btn-group justify-content-center" style="float:right;"> </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
                            <div class="hk-pg-wrapper" style="">
                                <ul class="nav nav-pills">
                                    <li class="active"><a data-toggle="pill" href="#home" onClick='loadtree(1,"home");'>Assets</a></li>
                                    <li><a data-toggle="pill" href="#menu1" onClick='loadtree(2,"menu1");'>Liabilities</a></li>
                                    <li><a data-toggle="pill" href="#menu2" onClick='loadtree(3,"menu2");'>Equity</a></li>
                                    <li><a data-toggle="pill" href="#menu3" onClick='loadtree(4,"menu3");'>Income</a></li>
                                    <li><a data-toggle="pill" href="#menu4" onClick='loadtree(5,"menu4");'>Expense</a></li>
                                </ul>
                                <div class="tab-content" id="group">

                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                         function loadtree(srNo,type){
                            $('#group').load('loadaccountgroup.php?srno='+srNo+"&type="+type);
                         }
                         loadtree(1,"home")
                    </script>
                    <script>
                    //function showgroup(id) {
                        //$(".subgroup" + id).show();
                        //$(".hgroup" + id).show();
                       // $(".sgroup" + id).hide();
                    //}

                    //function hidegroup(id) {
                       // $(".subgroup" + id).hide();
                       // $(".hgroup" + id).hide();
                       // $(".sgroup" + id).show();
                      //  $(".mgroup" + id).hide();
                    //}

                    // function showaccount(id) {
                    //     $(".account" + id).toggle();
                    // }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<style>
.hgte {
    background: #dcdcdc59;
}

.nav-pills li {
    background: #2f9e41;
    padding: 6px 40px;
    border: 1px solid #665f5f;
}

.nav-pills li a {
    color: white;
}

table tbody tr td {
    font-size: 14px !important;
    border: 1px solid black !important;
    border-bottom: none !important;
    padding-left: 10px !important;
}

table thead th {
    color: #14992a !important;
    font-size: 14px !important;
    border: 1px solid black !important;
}

table tbody tr:last-child td {
    border-bottom: 1px solid black !important;
    ;
}

table tbody tr:first-child td {
    border-top: none !important;
    ;
}

table {
    margin-top: 15px;
}

.iconPlus {
    background: #2f9e41;
    color: white;
    padding: 2px 3px;
    margin-right: 10px;
    cursor: pointer;
}

.btn-button {
    float: right;
    padding: 4px 11px;
    background: #2f9e41;
    color: white;
    border-radius: 3px;
}
</style>
<style>
.liststyleimg {
    float: left;
    width: 70px;
    margin-right: 15px;
    padding: 5px;
    border: 2px solid #e6e6e6;
}

.badge.dropdown-toggle:after {
    display: none;
}
</style>