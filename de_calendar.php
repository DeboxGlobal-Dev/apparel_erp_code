<?php
$searchField=clean($_GET['searchField']);

 if($loginuserprofileId==1){

$wheresearchassign=' 1 and ';

} else {

$wheresearchassign=' ( assignTo in (select id from '._USER_MASTER_.' where  roleId in (select id from roleMaster where parentId ='.$LoginUserDetails['roleId'].') ) or assignTo in (select id from '._USER_MASTER_.' where  roleId in (select id from roleMaster where parentId in (select id from roleMaster where parentId ='.$LoginUserDetails['roleId'].')))  or assignTo in (select id from '._USER_MASTER_.' where  roleId in (select id from roleMaster where parentId in (select id from roleMaster where parentId in ( select id from roleMaster where parentId ='.$LoginUserDetails['roleId'].'))))  or assignTo in (select id from '._USER_MASTER_.' where  roleId in (select id from roleMaster where parentId in (select id from roleMaster where parentId in (select id from roleMaster where parentId in ( select id from roleMaster where parentId ='.$LoginUserDetails['roleId'].'))))) or assignTo in (select id from '._USER_MASTER_.' where  roleId in (select id from roleMaster where parentId in (select id from roleMaster where parentId in (select id from roleMaster where parentId in  (select id from roleMaster where parentId in ( select id from roleMaster where parentId ='.$LoginUserDetails['roleId'].')))))) or assignTo in (select id from '._USER_MASTER_.' where  roleId in (select id from roleMaster where parentId in (select id from roleMaster where parentId in (select id from roleMaster where parentId in (select id from roleMaster where parentId in  (select id from roleMaster where parentId in ( select id from roleMaster where parentId ='.$LoginUserDetails['roleId'].'))))))) or assignTo in (select id from '._USER_MASTER_.' where  roleId in (select id from roleMaster where parentId in (select id from roleMaster where parentId in (select id from roleMaster where parentId in (select id from roleMaster where parentId in  (select id from roleMaster where parentId in ( select id from roleMaster where parentId in ( select id from roleMaster where parentId ='.$LoginUserDetails['roleId'].')))))))))  ';

$wheresearchassign='( '.$wheresearchassign.'  or assignTo = '.$_SESSION['userid'].' or addedBy = '.$_SESSION['userid'].') and ';

}

$calwhere='';
?>

<link rel="stylesheet" href="bower_components/fullcalendar/dist/fullcalendar.min.css">
<link rel="stylesheet" href="bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
<style>
.badge {
    width: 100%;
}
</style>

<div class="page-content">



		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->

			<!-- /page header -->


			<!-- Content area -->
			<div class="content pt-0">




				<!-- Dashboard content -->
				<div class="row">


				<div class="col-xl-9">
				<div class="card" style="margin-top: 20px;">
					 <div class="card-header header-elements-inline bg-info-700">
						<div class="col-xl-9"><h5 class="card-title"><?php echo $modfile['moduleName']; ?></h5></div>
						 <div class="col-xl-3" style="    padding-right: 0px;"><div class="btn-group justify-content-center" style="float:right;">


 	<a href="#" class="btn bg-teal-400 dropdown-toggle" data-toggle="dropdown" aria-expanded="false"  style="    background-color: #0000004d;">Add Activity</a>

								<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(96px, 36px, 0px);">
									<a href="#" class="dropdown-item" data-toggle="modal" data-target="#modalpop" onclick="opmodalpop(' Schedule Call','modalpop.php?action=addcall','600px','auto');" >Schedule Call</a>
									<a href="#" class="dropdown-item" data-toggle="modal" data-target="#modalpop" onclick="opmodalpop(' Schedule Meeting','modalpop.php?action=addmeeting','600px','auto');">Schedule Meeting</a>
									<a href="#" class="dropdown-item" data-toggle="modal" data-target="#modalpop" onclick="opmodalpop(' Create Task','modalpop.php?action=addtask','600px','auto');">Create Task</a>

								</div>





							</div></div>
					</div>

				 <div id="calendar" style=" padding: 20px;"></div> </div>


					</div>

					 <div class="col-xl-3" style="margin-top:20px;">
					 	<div class="card">
							<div class="card-header header-elements-inline">
								<h6 class="card-title">Today's To-Do</h6>


							</div>

							<div class="card-body">
								<ul class="media-list">



									 <?php
									 $nn=0;
$select='';
$where='';
$rs='';
$select='*';
$where='  dateAdded >= '.strtotime(date('Y-m-d H:i:s')).' order by dateAdded desc';
$rs=GetPageRecord($select,'salesTimeline',$where);
while($resListing=mysqli_fetch_array($rs)){

if($resListing['eventType']=='calls'){
$table='callsMaster';
$jsfunciton='callme('.encode($resListing['id']).',"call");';
}
if($resListing['eventType']=='meetings'){
$table='meetingsMaster';
$jsfunciton='callme('.encode($resListing['id']).',"meeting");';
}

if($resListing['eventType']=='tasks'){
$table='tasksMaster';

}



$select1='*';
$where1='id='.$resListing['parentId'].' and	assignTo='.$_SESSION['userid'].'';
$rs1=GetPageRecord($select1,$table,$where1);
$editresult=mysqli_fetch_array($rs1);

if($editresult['id']!=''){

?>
		 						<li   title="<?php if($resListing['eventType']=='calls'){ ?>Calls<?php } if($resListing['eventType']=='meetings'){ ?>Meeting<?php }if($resListing['eventType']=='tasks'){?>Task<?php } ?>" class="media<?php if($editresult['remiderDate']>=date('Y-m-d H:i:s')){ ?> active<?php } ?>" data-toggle="modal" data-target="#modalpop"  href="#" onclick="<?php if($resListing['eventType']=='calls'){ ?>opmodalpop(' View Call','modalpop.php?action=addcall&id=<?php echo encode($editresult['id']); ?>','600px','auto');<?php } if($resListing['eventType']=='meetings'){ ?>opmodalpop(' View Meeting','modalpop.php?action=addmeeting&id=<?php echo encode($editresult['id']); ?>','600px','auto');<?php }if($resListing['eventType']=='tasks'){?>opmodalpop(' View Task','modalpop.php?action=addtask&id=<?php echo encode($editresult['id']); ?>','600px','auto');<?php } ?>" style="cursor:pointer;">
										<div class="mr-3">
											<a class="btn bg-transparent border-primary text-primary rounded-round border-2 btn-icon">
												<?php if($resListing['eventType']=='calls'){ ?><i class="fa fa-phone" aria-hidden="true" style="font-size: 20px;"></i><?php } ?>
												<?php if($resListing['eventType']=='meetings'){ ?><i class="fa fa-users" aria-hidden="true" style="font-size: 17px; padding-top: 3px; padding-bottom: 3px;
"></i><?php } ?>
												<?php if($resListing['eventType']=='tasks'){ ?><i class="fa fa-tasks" aria-hidden="true" style="font-size: 17px; padding-top:2px; padding-bottom:2px;"></i><?php } ?>
											</a>
										</div>

										<div class="media-body">
											<a data-toggle="modal" data-target="#modalpop"  href="#" onclick="<?php if($resListing['eventType']=='calls'){ ?>opmodalpop(' View Call','modalpop.php?action=addcall&id=<?php echo encode($editresult['id']); ?>','600px','auto');<?php } if($resListing['eventType']=='meetings'){ ?>opmodalpop(' View Meeting','modalpop.php?action=addmeeting&id=<?php echo encode($editresult['id']); ?>','600px','auto');<?php }if($resListing['eventType']=='tasks'){?>opmodalpop(' View Task','modalpop.php?action=addtask&id=<?php echo encode($editresult['id']); ?>','600px','auto');<?php } ?>"><?php echo stripslashes($editresult['subject']); ?></a> <?php if($editresult['status']==1){?><span class="badge badge-info">Scheduled</span><?php } if($editresult['status']==2){ ?><span class="badge badge-success">Held</span><?php } if($editresult['status']==3){?><span class="badge badge-danger">Canceled</span><?php }?>
											<div class="text-muted font-size-sm"><?php echo date('h:i a',($resListing['dateAdded'])); ?></div>
										</div>
									</li>
<?php $nn++; } } if($nn<1){ ?>
<div style="text-align:center; padding:20px; color:#666666; ">No To-Do</div>
							<?php } ?>
								</ul>



<style>
.media-list li{border-bottom: 1px #bebebe dashed; padding:5px 10px; padding-top:10px;}
.media-list li:hover{ background-color:#F2F2F2;}
.media-list .active {
    background-color: #fbf8e5;
    border: 1px solid #ffb50e;
}
</style>
							</div>
						</div>


					 </div>
				</div>
				<!-- /dashboard content -->

			</div>
			<!-- /content area -->


			<!-- Footer -->

			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>




  <script type="text/javascript" src="js/jscolor.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- fullCalendar -->
<script src="bower_components/moment/moment.js"></script>
<script src="bower_components/fullcalendar/dist/fullcalendar.min.js"></script>

<!-- Page specific script -->
<script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()




    $('#calendar').fullCalendar({
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'today',
        month: 'month',
        week : 'week',
        day  : 'day'
      },
      //Random default events
      events    : [

		<?php
$select='';
$where='';
$rs='';
$select='*';
if($_SESSION['userid']=='1'){
$where='1 order by id asc';
} else {
$where=' assignTo='.$_SESSION['userid'].' order by id asc';
}
$rs=GetPageRecord($select,_CALLS_MASTER_,$where);
while($calldata=mysqli_fetch_array($rs)){
?> {
          title          : '<?php echo strip($calldata['subject']); ?>',
          start          : '<?php  echo date('Y-m-d H:i:s',strtotime($calldata['fromDate'].' '.$calldata['starttime'])); ?>',
          end            : '<?php  echo date('Y-m-d H:i:s',strtotime($calldata['fromDate'].' '.$calldata['starttime'])); ?>',
          allDay         : false,
		  url            : 'callme("<?php echo encode($calldata['id']); ?>","call");',
          backgroundColor: '#0c9f62', //Success (green)
          borderColor    : '#0c9f62' //Success (green)
        },
		<?php } ?>


		<?php
$select='';
$where='';
$rs='';
$select='*';
if($_SESSION['userid']=='1'){
$where='1  order by id asc';
} else {
$where=' assignTo='.$_SESSION['userid'].' order by id asc';
}
$rs=GetPageRecord($select,_MEETINGS_MASTER_,$where);
while($calldata=mysqli_fetch_array($rs)){
?> {
          title          : '<?php echo strip($calldata['subject']); ?>',
          start          : '<?php  echo date('Y-m-d H:i:s',strtotime($calldata['fromDate'].' '.$calldata['starttime'])); ?>',
          end            : '<?php  echo date('Y-m-d H:i:s',strtotime($calldata['fromDate'].' '.$calldata['starttime'])); ?>',
          allDay         : false,
		  url            : 'callme("<?php echo encode($calldata['id']); ?>","meeting");',
          backgroundColor: '#ff6600', //Success (green)
          borderColor    : '#ff6600' //Success (green)
        },
		<?php } ?>


		<?php
$select='';
$where='';
$rs='';
$select='*';
if($_SESSION['userid']=='1'){
$where='1 order by id asc';
} else {
$where=' assignTo='.$_SESSION['userid'].' order by id asc';
}
$rs=GetPageRecord($select,_TASKS_MASTER_,$where);
while($calldata=mysqli_fetch_array($rs)){
?> {
          title          : '<?php echo strip($calldata['subject']); ?>',
          start          : '<?php  echo date('Y-m-d H:i:s',strtotime($calldata['fromDate'].' '.$calldata['starttime'])); ?>',
          end            : '<?php  echo date('Y-m-d H:i:s',strtotime($calldata['fromDate'].' '.$calldata['starttime'])); ?>',
          allDay         : false,
		  url            : 'callme("<?php echo encode($calldata['id']); ?>","task");',
          backgroundColor: '#3399ff', //Success (green)
          borderColor    : '#3399ff' //Success (green)
        },
		<?php } ?>

      ],
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject')

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject)

        // assign it the date that was reported
        copiedEventObject.start           = date
        copiedEventObject.allDay          = allDay
        copiedEventObject.backgroundColor = $(this).css('background-color')
        copiedEventObject.borderColor     = $(this).css('border-color')

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
       // $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove()
        }

      }




    })

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Add draggable funtionality
      init_events(event)

      //Remove event from text input
      $('#new-event').val('')
    })
  })




$(document).on('click',function(e) {
  $this = $(e.target);
 if (typeof $this.attr('data-date') === "undefined") {} else {
    var mid= $this.attr('data-date');
	//alertspopupopen('action=addevent&adddate='+mid+'','600px','auto');
	}
});

function callme(id,type){

 $("#divid").click();

if(id!='' && type=='call'){
opmodalpop(' View Call','modalpop.php?action=addcall&id='+id+'','600px','auto');
}

if(id!='' && type=='meeting'){
opmodalpop(' View Meeting','modalpop.php?action=addmeeting&id='+id+'','600px','auto');
}

if(id!='' && type=='task'){
opmodalpop(' View Task','modalpop.php?action=addtask&id='+id+'','600px','auto');

}

}






 </script>
 <a href="#" data-toggle="modal" data-target="#modalpop" id="divid" style="display:none;">test</a>

 <script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<style>
.fc-day-grid-event {
    color: #fff !important;
    padding: 6px;
    font-size: 12px;
    font-weight: 400;
}
.fc-time{color:#fff !important;}
.fc-title{color:#fff !important;}
</style>
