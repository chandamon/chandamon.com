<div id="sidebar1">
	<ul>

	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(2) ) : else : ?>

  
      	
        <li>
        <h2 class="alt"><img src="http://chandamon.com/site/headings/archiveh2.GIF" /></h2>
            <ul>
            <?php wp_get_archives('type=monthly'); ?>
            </ul>
        </li>
		
		<li>
        <h2 class="alt"><img src="http://chandamon.com/site/headings/misch2.GIF" /></h2>
            <ul>
<li><?php if( class_exists('Add_to_Any_Subscribe_Widget') ) { Add_to_Any_Subscribe_Widget::display(); } ?></li>
            <?php wp_register(); ?>
            <li><?php wp_loginout(); ?></li>
            <?php wp_meta(); ?>
            </ul>
        </li>
      <li>
       
        </li>
        
	<?php endif; ?>
	</ul>
	</div>
	<!-- end sidebar two -->