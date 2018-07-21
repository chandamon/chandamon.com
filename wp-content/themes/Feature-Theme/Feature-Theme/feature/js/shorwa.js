// Javascrip Hover Effect

$(document).ready(function(){
$(".port-thumba img, .port-thumb2a img").fadeTo("slow", 1.0);
$(".port-thumba img, .port-thumb img, .port-thumb2a img, .port-thumb2 img").hover(function(){
$(this).fadeTo("fast", 0.5);
},function(){
$(this).fadeTo("slow", 1.0);
});
});









