<div id="sidebar2">
	<ul>

	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(2) ) : else : ?>

         <h2 class="alt"><img src="http://chandamon.com/site/headings/tagh2.GIF" /></h2>
            <ul>
           <?php wp_tag_cloud('number=0'); ?>
            </ul>
    


        
	<?php endif; ?>
	</ul>
	</div>
	<!-- end sidebar two -->