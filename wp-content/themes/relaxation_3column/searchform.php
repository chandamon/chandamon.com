<form method="get" id="searchform" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<div><input type="text" alt="searched for: <?php echo wp_specialchars($s, 1); ?>" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" />
</div>
</form>