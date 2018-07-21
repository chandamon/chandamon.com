
(function( $ ) {
	$(function() {
		
		$(document).click(function(event) { 
		
		    if($(event.target).is("header > h2 > a") || $(event.target).is(".post-contentC > a > img")){
		

var div = $("div#OvertheTop");

if ($(event.target).is("img") ){
	
	var TargetID = $(event.target).parent().attr("id");
	
}

else {
	var TargetID = $(event.target).attr("id");
	
	
}


$.post('http://www.chandamon.com/home/wp-admin/admin-ajax.php', {
action: "tpp_comments",
post_id: TargetID
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


} //end of if

});


$(document).click(function(event) { 
	
	    if(!$(event.target).closest('#OvertheTop').length || $(event.target).is($('#ClosethisThing')) ){

  //  if( $(event.target).is( $('#ClosethisThing') )){
        if($('#OvertheTop > #post').is(":visible")) {
$("#OvertheTop > #post").remove();
$("#BigContainer").fadeOut();
$("#ClosethisThing").siblings().remove();

$("body").css("overflow","visible");
        }//end of 1st if

    }  //end of the 2nd if      

		    if($(event.target).is(".nav_ajax a")){
		

var div2 = $("div#OvertheTop");

$.post('http://www.chandamon.com/home/wp-admin/admin-ajax.php', {
action: "tpp_comments",
post_id: $(event.target).attr("id").replace("post-","")
}, function (data) {
	$("#ClosethisThing").siblings().remove();
	
div2.append($(data));


} //end of  data function
); //end of whole ajax
return false;


} //end of if

}); 

}) 


})( jQuery );


