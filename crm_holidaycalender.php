<div class="page-content">
 <?php include "left.php"; ?>
 <div class="content-wrapper">
	<div class="content pt-0" style="margin-top:20px;">
		<div class="row">
			<div class="col-xl-12">
				<div class="card-header header-elements-inline bg-info-700">
					<div class="col-xl-6"><h5 class="card-title"><?php echo $pageName; ?></h5></div>

					<form name"search" method="GET" action="" id="actionsubmit">
			 	     <input type="hidden"  name="module" value="<?php echo $_GET['module']; ?>"/>
				  	<div class="col-xl-6" style="padding-right: 0px;"><div class="btn-group justify-content-center">
				  	  <a href="showpage.crm?module=masters"  class="btn bg-teal-400" aria-expanded="false" style="background-color: gray;"><i class="fa fa-arrow-left mr-2"></i>Back</a>


					<select name="factoryId" id="factoryId" class="form-control"  style="margin-right: 4px; width:200px;">
						<option>Select Factory</option>
						<?php
						$select='';
						$where='';
						$rs='';
						$select='*';
						$where='1 order by name asc';
						$rs=GetPageRecord($select,'factoryMaster',$where);
						while($resListing=mysqli_fetch_array($rs)){
						?>
						<option value="<?php echo $resListing['id']; ?>" <?php if($_GET['factoryId']==$resListing['id']){ ?> selected="selected" <?php } ?>><?php echo $resListing['name']; ?></option>
						<?php } ?>
					</select>
					<input name="search" type="submit" class="btn bg-teal-400" id="search" value="Search">


					 <a href="#" onClick="opmodalpop(' Add Holiday','modalpop.php?action=<?php echo $_GET['module']; ?>','600px','auto');" data-toggle="modal" data-target="#modalpop" class="btn bg-teal-400" aria-expanded="false" style="background-color: #03d873b8;"><i class="fa fa-plus" aria-hidden="true"></i> Add Holiday</a>
					 </div></div>

				</form>

					</div>
					<div class="card">
					<div id="calendar" style="margin-top: 0px; padding: 20px;" ></div>


<link rel="stylesheet" href="bower_components/fullcalendar/dist/fullcalendar.min.css">
<link rel="stylesheet" href="bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">

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
<script type="text/javascript" src="bower_components/bootstrap-datepicker/js/bootstrap-datepicker.js" charset="UTF-8"></script>
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

	  //==============================================

	  events    : [
		<?php
	    $rs=GetPageRecord('*','holidayMaster','1 and factoryId="'.$_GET['factoryId'].'" and holidayType=2 order by id asc');
		while($calldata=mysqli_fetch_array($rs)){

		?>
	  	{
          title          : '<?php echo $calldata['holidayName']; ?>',
          start          : '<?php  echo date('Y-m-d H:i:s',strtotime($calldata['startDate'])); ?>',
          end            : '<?php  echo date('Y-m-d H:i:s',strtotime($calldata['endDate'])); ?>',
          allDay         : false,
		 <?php if($calldata['startDate']==date('Y-m-d') || $calldata['startDate']>date('Y-m-d')){ ?>  url            : 'clicknew(<?php echo $calldata['id']; ?>);', <?php } ?>
          backgroundColor: '<?php if($calldata['startDate']==date('Y-m-d')){?>#ffa500<?php } ?><?php if($calldata['startDate'] > date('Y-m-d')){?>#0c9f62<?php } ?><?php if($calldata['startDate'] < date('Y-m-d')){?>#969798<?php } ?>', //Success (green)
          borderColor    : '<?php if($calldata['startDate']==date('Y-m-d')){?>#ffa500<?php } ?><?php if($calldata['startDate'] > date('Y-m-d')){?>#0c9f62<?php } ?><?php if($calldata['startDate'] < date('Y-m-d')){?>#969798<?php } ?>' //Success (green)
        },
		<?php  } ?>
		 //=====================================================

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

	opmodalpop('Holiday','modalpop.php?action=holidaycalender&adddate='+mid+'','600px','auto');

	}
});



function clicknew(id){
opmodalpop('Holiday','modalpop.php?action=holidaycalender&id='+id+'','600px','auto');
}


setTimeout(function(){
$('.fc-view').attr('data-toggle', 'modal');
$('.fc-view').attr('data-target', '#modalpop');

 }, 1500);
</script>''


<style>
body {
    background-color: #fff !important;
}
.fc-head{
background-color: #324148 !important;
}
.fc-day-header{
padding: 8px !important;
color:#FFFFFF;
}
.fc-day-grid-event {
    color: #fff !important;
    padding: 6px;
    font-size: 12px;
    font-weight: 400;
}
.fc-time{color:#fff !important;}
.fc-title{color:#fff !important;}

<?php
$kra=GetPageRecord('*','holidayMaster','1 and factoryId="'.$_REQUEST['factoryId'].'" and holidayType=1');
$holidayDataa=mysqli_fetch_array($kra);
$daynameee=$holidayDataa['days'];
$daysuus=strtolower(substr($daynameee,0,3));
?>

td.fc-<?php echo $daysuus; ?> {
        background-color: #f9f9f9 !important;
	    border-color: #ddd !important;
}

td.fc-<?php echo $daysuus; ?>:after {
    content: "Weekend";
    padding: 40% 0px 22% 0%;
    text-align: center;
    width: 100%;
    display: block;
    font-size: 13px;
}
body {
    padding: 0px !important;
}

</style>