$(document).mouseup(function(e) 
{
    var container = $(".downarrow"); 
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        $('#menudropdown').hide(); 
		$('.downarrow').removeClass('active');
    } else {
		$('#menudropdown').show();
		$('.downarrow').addClass('active');
	}
	
	
	 var container = $(".salesmenu"); 
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        $('#salesmenumenudropdown').hide(); 
		$('.salesmenu').removeClass('active');
    } else {
		$('#salesmenumenudropdown').show();
		$('.salesmenu').addClass('active');
	}
	
	
	 var container = $(".addmod"); 
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        $('#menudropdownadd').hide(); 
		$('.addmod').removeClass('active');
    } else {
		$('#menudropdownadd').show();
		$('.addmod').addClass('active');
	}
	
	 var container = $(".settingmod"); 
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        $('#menudropdownsetting').hide(); 
		$('.settingmod').removeClass('active');
    } else {
		$('#menudropdownsetting').show();
		$('.settingmod').addClass('active');
	}
	
	var container = $("#datepicker"); 
	if (!container.is(e.target) && container.has(e.target).length === 0) 
    {  
		$('#datepicker').removeClass('active');
    } else { 
		$('#datepicker').addClass('active');
	}
	
	 var container = $(".bellicon"); 
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        $('#notificationbox').hide();  
    } 
});



function comtabopenclose(closeclass,openid){
	$('.'+closeclass).slideUp();
	$('#'+openid).slideDown();
}


function checkallbox(){ 
  if ($("#checkAll").is(':checked')) { 
            $(".chk").prop("checked", true); 
        } else { 
            $(".chk").prop("checked", false); 
        }	 

}





$('input:checkbox.chk').each(function () { 
       var sThisVal = (this.checked ? $(this).val() : ""); 
	   
  });
 


function setupbox(url){
startloading();
window.location.href=url;	
}


function submitfieldfrm(frmname){
startloading();
$('#'+frmname).submit();
}



function alertspopupopen(filename,width,height){
$('#alertswhitebox').html('<div class="lds-css ng-scope"><div style="width:100%;height:100%" class="lds-ripple"><div></div> <div></div></div>');
$('#alertnotificationsmainbox').show();
$("#alertswhitebox").animate({width:""+width+""},400);
$("#alertswhitebox").animate({height:""+height+""},400);
$('#alertswhitebox').load('loadalertbox.php?'+filename);
$('body').css('overflow','hidden');
}

function alertspopupopenClose(){
$('#alertnotificationsmainbox').hide();
$('body').css('overflow','visible');
}

function startloading(){
$('#pageloading').show();	
$('#pageloader').show();	
$("#pageloader").animate({top:'53px'}, 120)	
}

 
function permissiononoff(id,modid){
var userid = $('#id').val(); 

$('#actiondiv').load('frm_action.crm?action=changepermission&userId='+userid+'&moduleId='+modid+'&btnid='+id);

}



function userpermissiononoff(id,modid,pagepermission){
var editid = $('#editid').val(); 

$('#actiondiv').load('frm_action.crm?action=profilepermission&editid='+editid+'&moduleId='+modid+'&pagepermission='+pagepermission+'&btnid='+id);

}




function opencloserolltabs(divid){ 
var classatr = $('#tabdiv'+divid).attr('class'); 
if(classatr=='hminus'){
$('#tabdiv'+divid).removeClass('hminus');
$('#tabdiv'+divid).addClass('hplus');
$('#rdiv'+divid).slideUp();	
} else {
$('#tabdiv'+divid).removeClass('hplus');
$('#tabdiv'+divid).addClass('hminus');	
$('#rdiv'+divid).slideDown();	
}

}

function loadroleinner(id){
var roleId = $('#roleId').val(); 
$('#rdiv'+id).load('crm_role_load.php?id='+id);	
}

function loadroleinnerselect(id){
var roleId = $('#roleId').val(); 
$('#rdiv'+id).load('crm_role_load_select.php?id='+id+'&roleId='+roleId);	
}

function selectrollbox(id,name){
	$('#roleidname').val(name);
	$('#roleId').val(id);
	alertspopupopenClose();
}







function donesavingalt(){ 
$("#truflsmsg").animate({top:'54px'}, 220)	
}
function donesavingaltgo(){ 
$("#truflsmsg").animate({top:'0px'}, 220)	
}



function sendtestmail(){
$("#buttonsbox").hide();	
$("#mailsending").show();	
$("#sendtestmailresult").show();
$('#sendtestmailresult').load('frm_action.crm?action=sendtestmail');
}



function changemodulelable(id,fid){
var name = encodeURI($('#editmod'+fid).val());

$('#actiondiv').load('frm_action.crm?action=changemodulename&name='+name+'&moduleid='+id);
}


function stoptloading(){
$('#pageloading').hide();	
$('#pageloader').hide();	
$("#pageloader").animate({top:'0px'}, 120)	
}




function masters_alertspopupopen(filename,width,height){
$('#alertswhitebox').html('<div class="lds-css ng-scope"><div style="width:100%;height:100%" class="lds-ripple"><div></div> <div></div></div>');
$('#alertnotificationsmainbox').show();
$("#alertswhitebox").animate({width:""+width+""},400);
$("#alertswhitebox").animate({height:""+height+""},400);
//$('#alertswhitebox').css('height',height);
//$('#alertswhitebox').css('width',width);
$('#alertswhitebox').load('masters_loadalertbox.php?'+filename);
$('body').css('overflow','hidden');
}

function masters_alertspopupopenClose(){
$('#alertnotificationsmainbox').hide();
$('body').css('overflow','visible');
}




function numericFilter(txb) {
   txb.value = txb.value.replace(/[^\0-9]/ig, "");
}