var allowLeaveConfirm = false;
var WIN_CLOSE_MSG = $("#leave_page_message").html();

function leaveWindow(){
    if(allowLeaveConfirm)
        return WIN_CLOSE_MSG;
    else allowLeaveConfirm = true;
}

$(function(){
    $(window).bind('load', function(){
        window.onbeforeunload = leaveWindow;
    });
});