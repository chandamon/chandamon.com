<div class="span-8 colborder">    

<h3 class="alt"><img src="http://chandamon.com/site/headings/newh2.GIF" /></h3>
<?php include (TEMPLATEPATH . "/queries.php"); ?>
<ul class="fcontent"><div>
<?php query_posts('cat=-6,-340,-342,-348&showposts=1'); ?>
<?php while (have_posts()) : the_post(); ?>
</div>
<div class="widget-content">
<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
<span class="meta"><?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?> - <a href="<?php comments_link() ?>"><?php comments_number(); ?></a>︱<?php edit_post_link('Edit', '[ ', ' ]'); ?><?php edit_post_link('Edit', '[ ', ' ]'); ?></span>
 <div class="entry"><?php  the_content('&#30535;&#21698;&#20840;&#37096;&#21435;&#21862;&#65281;'); ?></div>
<?php endwhile;?>

<?php query_posts('cat=-6,-342,-340,-348&showposts=5&offset=1'); ?>
<?php while (have_posts()) : the_post(); ?>
<li><span class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></span><br /><?php the_content('&#30535;&#21698;&#20840;&#37096;&#21435;&#21862;&#65281;'); ?><br /><span class="meta"><?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?> - <a href="<?php comments_link() ?>"><?php comments_number(); ?></a><?php edit_post_link('Edit', '[ ', ' ]'); ?></span></li>      <br clear="all" />
    
   
<?php endwhile;?></ul>
<div class="alignleft alt"><?php next_posts_link('&laquo;   &#20043;&#21069;&#30340;&#25991;') ?></div>
</div>

<div class="span-9 colborder">
<h3 class="alt"><img src="http://chandamon.com/site/headings/commenth2.GIF" /></h3>
<ul class="fcontent"><?php src_simple_recent_comments(5); ?></ul>
<hr/>


<?php query_posts('cat=340&showposts=1'); ?>
<?php while (have_posts()) : the_post(); ?>
<h3 class="alt"><a href="<?php echo get_category_link(340);?>"><img src="http://chandamon.com/site/headings/videoh2.GIF" border="0"/></a></h3>
<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
<div><?php  the_content('&#30535;&#21698;&#20840;&#37096;&#21435;&#21862;&#65281;') ?></div>
            <div class="allinfos alt"><span class="date"><?php the_time('F jS, Y') ?></span> | <span class="comments"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?> </span> </div>
    
            <br clear="all" />
            

<?php endwhile;?><hr/>

<h3 class="alt"><a href="<?php echo get_category_link(339);?>"><img src="http://chandamon.com/site/headings/diskm2.GIF" border="0" /></a></h3>

<?php query_posts('cat=339&orderby=rand&showposts=1'); ?>
<?php while (have_posts()) : the_post(); ?>

<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
<div> <?php
$id =$post->ID;
$the_content =$wpdb->get_var("SELECT post_content FROM $wpdb->posts WHERE ID = $id");
$pattern = '!<img.*?src="(.*?)"!';
preg_match_all($pattern, $the_content, $matches);
$image_src = $matches['1'][0];
?>


        <div class="tumbr" style="border: 0px solid #333; width: 250px;height: 250px;background: url(<?php if($image_src != '') { echo $image_src; } else { ?><?php bloginfo('template_directory'); ?>/images/no-image.gif<?php } ?>) 0 0 no-repeat;"> </div></div>
            <div class="allinfos alt"><span class="date"><?php the_time('F jS, Y') ?></span> | <span class="comments"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?> </span> |<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">&#30535;&#21698;&#20840;&#25991;</a><?php edit_post_link('Edit', '[ ', ' ]'); ?></div>
    
          
            <br clear="all" />
            

<?php endwhile;?>
<hr />



<h3 class="alt"><a href="<?php echo get_category_link(341);?>"><img src="http://chandamon.com/site/headings/movieh2.GIF" border="0" /></a></h3>

<?php query_posts('cat=341&orderby=rand&showposts=1'); ?>
<?php while (have_posts()) : the_post(); ?>

<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
<div><?php
$id =$post->ID;
$the_content =$wpdb->get_var("SELECT post_content FROM $wpdb->posts WHERE ID = $id");
$pattern = '!<img.*?src="(.*?)"!';
preg_match_all($pattern, $the_content, $matches);
$image_src = $matches['1'][0];
?>


        <div class="tumbr" style="border: 0px solid #333; width: 250px;height: 250px;background: url(<?php if($image_src != '') { echo $image_src; } else { ?><?php bloginfo('template_directory'); ?>/images/no-image.gif<?php } ?>) 0 0 no-repeat;"> </div></div>
            <div class="allinfos alt"><span class="date"><?php the_time('F jS, Y') ?></span> | <span class="comments"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?> </span>|<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">&#30535;&#21698;&#20840;&#25991;</a> </div>
                          <div class="category alt"><?php the_tags('Tags: ', ', ', ' '); ?><?php edit_post_link('Edit', '[ ', ' ]'); ?></div>
            <br clear="all" />
            

<?php endwhile;?>
<hr />
<h3 class="alt"><a href="<?php echo get_category_link(347);?>"><img src="http://chandamon.com/site/headings/designh2.gif" border="0" /></a></h3>

<?php query_posts('cat=347&orderby=rand&showposts=1'); ?>
<?php while (have_posts()) : the_post(); ?>

<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
<div><?php
$id =$post->ID;
$the_content =$wpdb->get_var("SELECT post_content FROM $wpdb->posts WHERE ID = $id");
$pattern = '!<img.*?src="(.*?)"!';
preg_match_all($pattern, $the_content, $matches);
$image_src = $matches['1'][0];
?>


        <div class="tumbr" style="border: 0px solid #333; width: 250px;height: 150px;background: url(<?php if($image_src != '') { echo $image_src; } else { ?><?php bloginfo('template_directory'); ?>/images/no-image.gif<?php } ?>) 0 0 no-repeat;"> </div></div>
            <div class="allinfos alt"><span class="date"><?php the_time('F jS, Y') ?></span> | <span class="comments"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?> </span> |<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">&#30535;&#21698;&#20840;&#25991;</a></div>
    
          
            <br clear="all" />
            

<?php endwhile;?>

</div>

<div class="span-4 last">
<h3 class="alt"><a href="<?php echo get_category_link(6);?>"><img src="http://chandamon.com/site/headings/damoh2.GIF" border="0" /></a></h3>
<img src="http://chandamon.com/site/damonlogo2009jan.gif" /><br />

<?php query_posts('cat=6&showposts=2'); ?>

<?php while (have_posts()) : the_post(); ?>
<div class="allinfos alt"><span class="date"><?php the_time('F jS, Y') ?>@<?php the_time('g:i a'); ?></span></div>
<div><?php  the_content(); ?></div>
            <div class="allinfos alt comments"><?php comments_popup_link('&#20871;&#20154;&#22238;&#25033;:(', '1 &#22238;&#25033;', '% &#22238;&#25033;s'); ?>   </div>
    
                
            <br clear="all" />
            

<?php endwhile;?><hr />

<h3 class="alt"><img src="http://chandamon.com/site/headings/thingsh2.GIF" /></h3>

<?php query_posts('cat=342&showposts=1'); ?>
<?php while (have_posts()) : the_post(); ?>

<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
<div><?php  the_content(); ?></div>
            <div class="allinfos alt"><span class="comments"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?> </span> </div>
              
            <br clear="all" />
            

<?php endwhile;?>
<hr />
<style type="text/css">table.lfmWidgetchart_77256b4bb64b514acab1db3cc5b62036 td {margin:0 !important;padding:0 !important;border:0 !important;}table.lfmWidgetchart_77256b4bb64b514acab1db3cc5b62036 tr.lfmHead a:hover {background:url(http://cdn.last.fm/widgets/images/en/header/chart/weeklyartists_regular_blue.png) no-repeat 0 0 !important;}table.lfmWidgetchart_77256b4bb64b514acab1db3cc5b62036 tr.lfmEmbed object {float:left;}table.lfmWidgetchart_77256b4bb64b514acab1db3cc5b62036 tr.lfmFoot td.lfmConfig a:hover {background:url(http://cdn.last.fm/widgets/images/en/footer/blue.png) no-repeat 0px 0 !important;;}table.lfmWidgetchart_77256b4bb64b514acab1db3cc5b62036 tr.lfmFoot td.lfmView a:hover {background:url(http://cdn.last.fm/widgets/images/en/footer/blue.png) no-repeat -150px 0 !important;}table.lfmWidgetchart_77256b4bb64b514acab1db3cc5b62036 tr.lfmFoot td.lfmPopup a:hover {background:url(http://cdn.last.fm/widgets/images/en/footer/blue.png) no-repeat -150px 0 !important;}</style>
<table class="lfmWidgetchart_77256b4bb64b514acab1db3cc5b62036" cellpadding="0" cellspacing="0" border="0" style="width:150px;"><tr class="lfmHead"><td><a title="chandamon: Weekly Top Artists" href="http://www.last.fm/user/chandamon/charts?charttype=weekly&subtype=artist" target="_blank" style="display:block;overflow:hidden;height:15px;width:150px;background:url(http://cdn.last.fm/widgets/images/en/header/chart/weeklyartists_regular_blue.png) no-repeat 0 -20px;text-decoration:none;border:0;"></a></td></tr><tr class="lfmEmbed"><td><object type="application/x-shockwave-flash" data="http://cdn.last.fm/widgets/chart/19.swf" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" id="lfmEmbed_1686911272" width="150" height="160"> <param name="movie" value="http://cdn.last.fm/widgets/chart/19.swf" /> <param name="flashvars" value="type=weeklyartistchart&amp;user=chandamon&amp;theme=blue&amp;lang=en&amp;widget_id=chart_77256b4bb64b514acab1db3cc5b62036" /> <param name="allowScriptAccess" value="always" /> <param name="allowNetworking" value="all" /> <param name="allowFullScreen" value="true" /> <param name="quality" value="high" /> <param name="bgcolor" value="6598cd" /> <param name="wmode" value="transparent" /> <param name="menu" value="true" /> </object></td></tr><tr class="lfmFoot"><td style="background:url(http://cdn.last.fm/widgets/images/footer_bg/blue.png) repeat-x 0 0;text-align:right;"><table cellspacing="0" cellpadding="0" border="0" style="width:150px;"><tr><td class="lfmConfig"><a href="http://www.last.fm/widgets/?colour=blue&amp;chartType=weeklyartists&amp;user=chandamon&amp;chartFriends=1&amp;from=code&amp;widget=chart" title="Get your own widget" target="_blank" style="display:block;overflow:hidden;width:150px;height:15px;float:right;background:url(http://cdn.last.fm/widgets/images/en/footer/blue.png) no-repeat 0px -20px;text-decoration:none;border:0;"></a></td></table></td></tr></table>
<hr />
    <li>
        <h2 class="alt"><img src="http://chandamon.com/site/headings/linkh2.GIF" /></h2>
            <ul>

             <?php wp_list_bookmarks(); ?>
             </ul>
        </li>
</div>

<hr />