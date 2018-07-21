// Javascrip Hover Effect

$(document).ready(function(){
$(".portfolio-contenthma img, .portfolio-contenthm img, .hm2-lyut2thumb2a img, .hm2-lyut2thumb2 img, .mnbya img, .mnby img").fadeTo("slow", 1.0);
$(".portfolio-contenthma img, .portfolio-contenthm img, .hm2-lyut2thumb2a img, .hm2-lyut2thumb2 img, .mnbya img, .mnby img").hover(function(){
$(this).fadeTo("slow", 0.5);
},function(){
$(this).fadeTo("slow", 1.0);
});
});









