<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home of Damon Chan</title>
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900" rel="stylesheet">
      
      <meta name="description" content="Story of Damon's life" />
      
    <meta content="Damon Chan" name="title" />
    
    <meta name="keywords" content="Oslo, Norway, Chinese, Hong Kong, creative, Creativity, Webdesign, content management, freelance, Norsk, freelance" />
    <link href='https://fonts.googleapis.com/css?family=Alegreya+Sans:400,500,300,100,700,800,900' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,100,700' rel='stylesheet' type='text/css'>
    
    <!-- for Google -->
<meta name="description" content="" />
<meta name="keywords" content="Norway, Oslo, Damon, Chinese, Hong Kong, creative, web design, design, graphic, job" />

<meta name="author" content="Damon Chan" />
<meta name="copyright" content="Damon Chan" />
<meta name="application-name" content="" />

<!-- for Facebook -->          
<meta property="og:title" content="Damon Chan" />
<meta property="og:type" content="article" />
<meta property="og:image" content="http://chandamon.com/images/babyDamon.jpg" /><meta property="og:url" content="" />
<meta property="og:description" content="What Damon is on about"/>

<!-- for Twitter -->          
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="Damon Chan" />
<meta name="twitter:description" content="What is Damon  on about?" />
<meta name="twitter:image" content="http://chandamon.com/images/babyDamon.jpg" />







    <link rel="stylesheet" href="css/bootstrap.min.css" />
                                <link rel="stylesheet" href="css/foundation.css" />
                        
        <link type="image/x-icon" href="../images/favicon.ico" rel="icon">
<link type="image/x-icon" href="../images/favicon.ico" rel="shortcut icon">
        <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/modernizr.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-36589794-1', 'auto');
  ga('send', 'pageview');

</script>
                                        

  </head>
 <?php 
/* Short and sweet */
define('WP_USE_THEMES', false);
require('home/wp-blog-header.php');
?>
<?php
require('home/wp-blog-header.php');
?>

    
    <?php
// instagram user id lookup here https://codeofaninja.com/tools/find-instagram-user-id
$instagram_uid="271378805";
 
// instruction to get your access token here https://www.codeofaninja.com/2015/05/get-instagram-access-token.html
$access_token="271378805.1677ed0.ca4e90cc29d7471588eebaa009ed6ada";
$photo_count=1;
 
$json_link="https://api.instagram.com/v1/users/{$instagram_uid}/media/recent/?";
$json_link.="access_token={$access_token}&count={$photo_count}";
?>
  <body class="DamonHomePage">
                                                         <div class="ajax-popup"><div class="close-btn">X</div></div>

<!-- Preloader -->
<div id="preloader">
    <div id="status">&nbsp;</div>
</div>
    <div class="Bigwrapper">


    <a id="DamonsHome"></a>
    <div class="row">
        
      <div class="large-12 columns">

      <header>  <h2 class="headertitle">Damon Chan</h2></header>
  <hr>
      <section><div class="col-sm-2"><div>
        <h4 class="sidebar"><a href="#aboutPage">About</a></h4></div>


      <div>
        <h4 class="sidebar work-menu"><a href="">Works</a></h4>
          <div class="submenu works"><ul><li>3C Music </li><li>Hong Kong Talks Music </li><li>Sounds of the City</li></ul></div>
          </div>

      <div>
        <h4 class="sidebar article-menu"><a href="">Article archive</a></h4>
          <div class="submenu articles"><ul><li>樂評</li><li>音樂文章</li><li>電視</li><li>文化</li><li>城市</li><li>In English</li></ul></div></div>
                           <div><h4 class="sidebar"><a href="/home">Blog</a></h4></div></div></section>
                                                                      

          
          <div class="col-sm-5 main-frame">
            <?php $thumbnail_nopic = 'helloworld'; ?>
                           <?php
                                                                          
$args = array(
  'posts_per_page' => 1,
'cat' => -9);

                                                                          
              $my_query = new WP_Query($args);

  while ($my_query->have_posts()) : $my_query->the_post();
 $do_not_duplicate[] = $post->ID; 
query_posts(''); ?>

 <a class="post-title main-frame-title link-post" title="click here to more..." data-id="<?php the_ID(); ?>" data-title="<?php the_title(); ?>" data-slug="<?php global $post; echo $post->post_name; ?>" href=" <?php the_permalink(); ?> "><h2><?php the_title(); ?></h2></a>
<div class="main-post-img" style="background-image:url(<?php has_post_thumbnail() ? the_post_thumbnail_url('large') : print 'http://www.chandamon.com/home/wp-content/uploads/2016/07/27387923803_0d154f2991_k-2-785x589.jpg' ; ?>)"></div>
    <div class="meta-row"><span class="meta-data"><?php the_time('F j, Y'); ?></span>
 <span class="meta-data meta-cat"><?php the_category (','); ?></span>
        </div>
                                                                  <?php  the_content(true); ?> 
            <?php                                                                            echo "<div class='meta-row tag-row'>";
              the_tags('',' ');
              echo "</div>"; ?>
<?php endwhile; ?>




    </div>
          
          <div class="right-side col-sm-2">
         
                <div class="doodle-col">
          <?php
              
              $my_query = new WP_Query('cat=9&posts_per_page=1');

  while ($my_query->have_posts()) : $my_query->the_post();

if ( $post->ID == $do_not_duplicate ) continue;
query_posts(''); ?>
                        <a class="link-post" data-id="<?php the_ID(); ?>" data-title="<?php the_title(); ?>" data-slug="<?php global $post; echo $post->post_name; ?>" href="<?php the_permalink(); ?>" >
<?php 
the_post_thumbnail('large');

echo "</a>";
endwhile;
?></div>
                 <div class="video-col">
          <?php

              $my_query = new WP_Query(array(
      'cat'  =>  3,
      'post__not_in'  =>  $do_not_duplicate,
      'posts_per_page'  =>  1
  ));

  while ($my_query->have_posts()) : $my_query->the_post();

$do_not_duplicate[] = $post->ID;
                     query_posts(''); ?>
                     
                                             <a class="link-post main-frame-title" data-id="<?php the_ID(); ?>" data-title="<?php the_title(); ?>" data-slug="<?php global $post; echo $post->post_name; ?>" href="<?php the_permalink(); ?>" >

<?php              the_title( '<h2>', '</h2>' );
              echo "</a>";
the_post_thumbnail('large');
              echo "<div class='meta-row tag-row'>";
              the_tags('',' ');
              echo "</div>";

endwhile;
?></div>
          </div>
          <div class="col-sm-3"><a class="twitter-timeline" href="https://twitter.com/chandadadamon" data-widget-id="728945965990871040" data-chrome="noheader nofooter noborders"></a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
          <div class="music-col">
          <?php
              
              $my_query = new WP_Query(array(
      'cat'  =>  2,
      'post__not_in'  =>  $do_not_duplicate,
      'posts_per_page'  =>  1));
  while ($my_query->have_posts()) : $my_query->the_post();

  $do_not_duplicate = $post->ID; //This is the magic line
query_posts(''); ?>
             <a href="<?php the_permalink(); ?>" class='link-post main-frame-title' data-id="<?php the_ID(); ?>" data-title="<?php the_title(); ?>" data-slug="<?php global $post; echo $post->post_name; ?>" >
                 <?php 
              the_title( '<h2>', '</h2>' );
              echo "</a>";
the_post_thumbnail('large');
              echo "<div class='meta-row tag-row'>";
              the_tags('',' ');
              echo "</div>";

endwhile;
?></div>
          </div>
          
      
          </div>
    </div></div>
    
		<div class="spacer s1"></div>
    <div class="Bigwrapper2">
    <a id="aboutPage"></a>
    <div class="row">
      <div class="large-12 columns">
      <nav><a href="#DamonsHome"></a></nav>
      <header>  <h2 class="DamonHome">About myself</h2></header>
      <section class="ChangeableContent">
      
      <div id="ChangeTextHere" class="ProfileMain col-sm-12">
      
      <div class="simpleInfo contact-col col-sm-3 bio-col">
            <p>#Name: Damon Chan </p>
            <p>#Contact: <a href="mailto:chandamon@gmail.com">Email</a> - <a href="http://instagram.com/chandamon" title="Damonn at Instagram" target="_blank">Instagram</a> - <a href="http://www.fb.com/chandamon" title="Damon at Facebook">Facebook</a> - <a href="http://flickr.com/chandamon618" title="Damon at Flickr">Flickr</a></p>


      </div>
          
                 <div class=" col-sm-3 pic-2-col bio-col ">
<div></div>

      </div>
      <div class=" col-sm-5  bio-col selfdes-col">
          <p>Based in Oslo, raised and nurtured in Hong Kong, Damon is a frontend-developer, who specialises in UI, UX and Graphic design during daytime, and a creative writer / freelance journalist (music, culture, city, travel...) by night. </p>


      </div>
          <div class=" col-sm-1 empty-1-col bio-col">
<div></div>

      </div>
          
           <div class=" col-sm-2 pic-1-col bio-col">
<div></div>

      </div>
           <div class=" col-sm-3 bio-col current-col">
          <p>Currently working for Hava Media, a start-up that focuses on web services, including projects like N4G, Releases.com. </p>


      </div>
           <div class=" col-sm-5 bio-col pic-3-col">
<div></div>

      </div>
          <div class=" col-sm-2 bio-col empty-2-col">
<div></div>

      </div>
           <div class=" col-sm-3 col-sm-offset-1 bio-col pic-4-col">
<div></div>

      </div>
           <div class=" col-sm-3 bio-col current-2-col">
          <p>Articles have been published on Mingpao, HKEJ, Nuyou and on his self-founded music website 3CMusic.com. </p>


      </div>
            </div>

      
      
      </section>
   
      </div></div>
    </div>
    
<script>
$("#ChangeNowContent").click(function(){

$('#ChangeTextHere').load('shortinfo.php');})



$("#ChangeNowContent4").click(function(){

$('#ChangeTextHere').load('music.php');})

$("#ChangeNowContent2").click(function(){

$('#ChangeTextHere').load('test.php');})


$("#ChangeNowContent5").click(function(){

$('#ChangeTextHere').load('writing.php');})


$("#ChangeNowContent3").click(function(){

$('#ChangeTextHere').load('age.php');})


</script>
    <script src="js/foundation.min.js"></script>
      <script>
      $(document).foundation();
	  
	  $(document).ready(function(){
resizeDiv();
});

   var WidthSize = $(window).width();


window.onresize = function(event) {
resizeDiv();
}

function resizeDiv() {
vpw = $(window).width();
vph = $(window).height();
vphHH = $(window).height() / 15;
vphHHH = $(window).height() / 1.3;



$("body").css("height", vph);
$("body").css("max-height", vph);

$("div.Bigwrapper").css("height", vph);
$("div.Bigwrapper2").css("height", vph);

if (WidthSize > 400) {
	$("div#ChangeTextHere").css("height", vphHHH);

	}


$("h4.DamonHome").css("margin-top", vphHH);
$("h4.DamonHome").css("margin-bottom", vphHH);



}
          
             $('.article-menu').click(function(e) { 
                     e.preventDefault();

    $('.articles').toggleClass('active');        
})
             
               $('.work-menu').click(function(e) { 
                     e.preventDefault();

    $('.works').toggleClass('active');        
})


//menu Scrolling

          
          $(document).click(function(event) { 
    if(!$(event.target).closest('.post-container').length  && !$(event.target).is('.post-container')||$(event.target).is('.close-btn')) {
        if($('.ajax-popup').hasClass("active")) {
                        $('.ajax-popup').removeClass("active");

        }
    }        
})
          
          $('.link-post').on('click', function(e) {
    e.preventDefault();

    var post_id = $(this).data('id'), // data-id attribute for .post-link
        projectTitle = $(this).data('title'), // data-title attribute for .post-link
        projectSlug = $(this).data('slug'), // data-slug attribute for .post-link
        ajaxURL ='http://chandamon.com/home/wp-admin/admin-ajax.php'; // Ajax URL localized from functions.php

    $.ajax({
        type: 'POST',
        url: ajaxURL,
        context: this,
        data: {'action': 'load-content', post_id: post_id },
        success: function(response) {
            $('.ajax-popup').html(response);
                        $('.ajax-popup').addClass("active");
                        $('.ajax-popup').append("<div class='close-btn'>X</div>");

            return false;
        }
    });
});



$('a[href^="#DamonsHome"]').on('click', function(event) {
	    var target = $( $(this).attr('href') );
    if( target.length ) {
    event.preventDefault();
    $('html, body').animate({
    scrollTop: target.offset().top
    }, 1000);
    }
    });


$('a[href^="#aboutPage"]').on('click', function(event) {
	    var target = $( $(this).attr('href') );
    if( target.length ) {
    event.preventDefault();
    $('html, body').animate({
    scrollTop: target.offset().top
    }, 1000);
    }
    });
   //Preloader
   
   //<![CDATA[
		$(window).load(function() { // makes sure the whole site is loaded
			$('#status').fadeOut(); // will first fade out the loading animation
			$('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
			$('body').delay(350).css({'overflow':'hidden'});
		})
	//]]>
	
	
if ( Modernizr.touch ) {
			$('body').css({'overflow':'visible'});
						$('div.Bigwrapper2').css({'overflow':'visible'});
					$('div.bottomMenuAbout').css({'overflow':'visible'});	
					$('div#ChangeTextHere').css({'height':'100%'});	
				
	
   }
   
   if (WidthSize < 400 ){
	   
	   $('div.Bigwrapper2').css({'overflow':'visible'});
					$('div.bottomMenuAbout').css({'overflow':'visible'});	
	   $('div#ChangeTextHere').css({'height':'100%'});	
	   }
   
   
   


    </script>
    
    
  </body>
</html>
