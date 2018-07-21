jQuery(document).ready( function($){

$("header > h2, #post-content").click( function() {

var div = $("div#OvertheTop");

$.post('http://www.chandamon.com/home/wp-admin/admin-ajax.php', {
action: "tpp_comments",
post_id: $(this).find("a").attr("id")
}, function (data) {
	
div.append($(data));
div.css("opacity","1");
div.css("display","block");
$("body").css("overflow","hidden");
$("#BigContainer").fadeIn();
$("#BigContainer").css("display","block");


}
);
return false;
});


$(document).click(function(event) { 
    if(!$(event.target).closest('#OvertheTop').length || $('#ClosethisThing') ){
        if($('#OvertheTop > #post').is(":visible")) {

$("#OvertheTop > #post").remove();
$("#BigContainer").fadeOut();
$("body").css("overflow","visible");
        }
    }        
})







});