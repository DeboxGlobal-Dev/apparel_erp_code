<div class="page-content">
<?php include "left.php"; ?>
<link rel="stylesheet" href="css/fullcalendar.css" />
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
<script src="bower_components/moment/moment.js"></script>
<script src="bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<script type="text/javascript" src="bower_components/bootstrap-datepicker/js/bootstrap-datepicker.js" charset="UTF-8"></script>

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
		$select='';
		$where='';
		$rs='';
		$select='*';

		$where=' 1 and addedBy="'.$_SESSION['userid'].'" order by id asc';

		$rs=GetPageRecord($select,'sheduleMaster',$where);
		while($calldata=mysqli_fetch_array($rs)){

		?>
	  	{
          title          : '<?php echo $calldata['description'].' - Limit: '.$calldata['approveLimit']; ?>',
          start          : '<?php  echo date('Y-m-d H:i:s',strtotime($calldata['addDate'].' '.$calldata['fromTime'])); ?>',
          end            : '<?php  echo date('Y-m-d H:i:s',strtotime($calldata['addDate'].' '.$calldata['toTime'])); ?>',
          allDay         : false,
		 <?php if($calldata['addDate']==date('Y-m-d') || $calldata['addDate']>date('Y-m-d')){ ?>  url            : 'clicknew(<?php echo $calldata['id']; ?>);', <?php } ?>
          backgroundColor: '<?php if($calldata['addDate']==date('Y-m-d')){?>#ffa500<?php } ?><?php if($calldata['addDate'] > date('Y-m-d')){?>#0c9f62<?php } ?><?php if($calldata['addDate'] < date('Y-m-d')){?>#969798<?php } ?>', //Success (green)
          borderColor    : '<?php if($calldata['addDate']==date('Y-m-d')){?>#ffa500<?php } ?><?php if($calldata['addDate'] > date('Y-m-d')){?>#0c9f62<?php } ?><?php if($calldata['addDate'] < date('Y-m-d')){?>#969798<?php } ?>' //Success (green)
        },
		<?php } ?>
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

	opmodalpop('Schedule','modalpop.php?action=schedulemaster&adddate='+mid+'','600px','auto');

	}
});



function clicknew(id){
opmodalpop('Schedule','modalpop.php?action=schedulemaster&id='+id+'','600px','auto');
}


setTimeout(function(){
$('.fc-view').attr('data-toggle', 'modal');
$('.fc-view').attr('data-target', '#modalpop');

 }, 1500);
</script>

<div class="content-wrapper">
	<div class="content pt-0" style="margin-top:20px;">
		<div class="row">
			<div class="col-xl-12">
				<div class="card-header header-elements-inline bg-info-700">
					<div class="col-xl-12"><h5 class="card-title"><?php echo $pageName; ?></h5></div>
					 </div>
					<div class="card">

                            <div style="padding:15px 25px;"><div id="calendar"></div></div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<style>
.fc-day-header{
background-color: #0097a7;
color: #fff;
}
body {
overflow: auto !important;
padding: 0px !important;
}
.fc-day-grid-event{
background-color: #0c9f62;
border-color: #0c9f62;
padding: 1px 8px;
border-radius: 0px;
font-size: 9px;
}
</style>