<?php get_header(); ?>
		
 <?php include (TEMPLATEPATH . "/topcontent.php"); ?>

<div class="span-24">
<div class="span-11 colborder">    


<h3 class="alt"><a href="<?php echo get_category_link(9);?>"><img src="http://chandamon.com/site/headings/drawh2.GIF" border="0" /></a></h3>

<?php query_posts('cat=9&orderby=rand&showposts=1'); ?>
<?php while (have_posts()) : the_post(); ?>

<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
<div><?php  the_content(); ?></div>
            <div class="allinfos alt"><span class="date"><?php the_time('F jS, Y') ?></span> | <span class="comments"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?> </span> </div>
    
            <br />
            <div class="category alt"><?php the_tags('Tags: ', ', ', ' '); ?><?php edit_post_link('Edit', '[ ', ' ]'); ?></div>
            <br clear="all" />
			
            

<?php endwhile;?>

<hr />
			
<h3 class="alt"><a href="<?php echo get_category_link(348);?>"><img src="http://chandamon.com/site/headings/flickrh2.gif" border="0" /></a></h3>

<?php query_posts('cat=348&showposts=1'); ?>
<?php while (have_posts()) : the_post(); ?>

<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
<div><?php  the_content(); ?></div>
            <div class="category alt"><?php the_tags('Tags: ', ', ', ' '); ?><?php edit_post_link('Edit', '[ ', ' ]'); ?></div>
            <br clear="all" /><?php endwhile;?></div>

<div class="span-middle_middle colborder"> 

<h3 class="alt"><a href="<?php echo get_category_link(7);?>"><img src="http://chandamon.com/site/headings/randomh2.GIF" border="0" /></a></h3>

<?php query_posts('cat=7&orderby=rand&showposts=1'); ?>
<?php while (have_posts()) : the_post(); ?>

<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
<div><?php  the_content(); ?></div>
            <div class="allinfos alt"><span class="date"><?php the_time('F jS, Y') ?></span> | <span class="comments"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?> </span> </div>
    
            <br /><br />
            <div class="category alt">Posted in <?php the_category(', ') ?><br /><?php the_tags('Tags: ', ', ', ' '); ?><?php edit_post_link('Edit', '[ ', ' ]'); ?></div>
            <br clear="all" />
            

<?php endwhile;?>
<hr />
</div>
<div class="span-middle_right last">
<h3 class="alt"><img src="http://chandamon.com/site/headings/fotoh2.GIF" /></h3>
<?php
require_once("phpFlickr/phpFlickr.php");
// Create new phpFlickr object
$f = new phpFlickr("da9862032860ed10ae0b7f63f2cdbaee");
//$f->enableCache(
  //  "db",
    //"mysql://chandamon:smccxb@localhost/chandamo_restart2009"
//);

 
$i = 0;

    // Find the NSID of the username inputted via the form

    $person = $f->people_findByUsername('chandamon618');
    // Get the friendly URL of the user's photos
    $photos_url = $f->urls_getUserPhotos($person['id']); 
    // Get the user's first 36 public photos
    $photos = $f->people_getPublicPhotos($person['id'], NULL, NULL, 500);
 
    // Loop through the photos and output the html
	shuffle($photos['photos']['photo']);
    foreach ((array)$photos['photos']['photo'] as $photo) {
	
        echo "<a href=$photos_url$photo[id]>";
        echo "<img border='0' alt='$photo[title]' ". //>
            "src=" . $f->buildPhotoURL($photo, "Square") . " />";
        echo "</a>";
        $i++;
        // If it reaches the sixth photo, insert a line break
        if ($i % 2 == 0) {
            echo "<br />";
       
    }
	   if ($i == 8) {
break;	   }
}
?>

<?php
require_once("phpFlickr/phpFlickr.php");
// Create new phpFlickr object
$f = new phpFlickr("da9862032860ed10ae0b7f63f2cdbaee");
//$f->enableCache(
  //  "db",
    //"mysql://chandamon:smccxb@localhost/chandamo_restart2009"
//);

 
$i = 0;

    // Find the NSID of the username inputted via the form


    // Get the user's first 36 public photos
    $photos =  $f->tags_getClusterPhotos('oslo','norway/sogn/norge');
 shuffle($photos['photos']['photo']);
    foreach ((array)$photos['photos']['photo'] as $photo) {
	
        echo "<a href=http://www.flickr.com/photos/".$photo[owner]. "/" . $photo[id]. "/ >";
        echo "<img border='0' alt='$photo[title]' ". //>
            "src='http://farm" . $photo[farm]. ".static.flickr.com/".$photo[server]."/".$photo[id] . "_". $photo[secret]."_s.jpg' />";
        echo "</a>";
        $i++;
        // If it reaches the sixth photo, insert a line break
        if ($i % 2 == 0) {
            echo "<br />";
       
    }
	   if ($i == 8) {
break;	   }
}
?>
 

</div>
    
</div><!--span-24-->
        
        
<?php include (TEMPLATEPATH . "/bottomcontent.php"); ?>
        
<?php get_footer(); ?>
        
	</div><!--container-->


</body>
</html>