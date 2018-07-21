<?php if ( !empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>

<p style="text-align:center;">
  <?php _e('Enter your password to view comments.'); ?>
</p>
<?php return; endif; ?>
<div class="comment_div"> <span class="postitle" id="comments">
  <?php comments_number(__(''), __('1 person said...'), __('% people said...')); ?>
  </span>
  <?php if ( $comments ) : ?>
  <ol id="commentlist">
    <?php foreach ($comments as $comment) : ?>
    <li<?php if ($comment->comment_author_email == "your email goes here") { ?> class="author"<?php } else { ?> class="other" <?php } ?>>
    <div class="poster"> <a href="<?php comment_author_url(); ?>" class="title">
      <?php comment_author() ?>
      </a> <small>(<a href="#comment-<?php comment_ID() ?>" title="">
      <?php comment_date('Y-m-d') ?>
      </a>)</small> </div>
    <?php comment_text() ?>
    </li>
    <?php endforeach; ?>
  </ol>
  <div style="height:50px;">&nbsp;</div>
  <?php else : // If there are no comments yet ?>
  <?php endif; ?>
  <?php if ( comments_open() ) : ?>
  <h2>
    <?php _e('Speak your mind'); ?>
  </h2>
  <p> Line and paragraph breaks are automatic.<br>
    All posts are moderated. This may delay your comment, but there is no need to resubmit it.<br>
    Allowed tags: &lt;a href=""&gt; &lt;blockquote&gt; &lt;code&gt; &lt;em&gt; &lt;strong&gt;. </p>
  <form action="<?php echo get_settings('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
    <p>
      <label for="author">
      <?php _e('Name'); ?>
      </label>
      <?php if ($req) _e('(required)'); ?><br>
      <input type="text" name="author" id="author" class="textarea" value="<?php echo $comment_author; ?>" size="28" tabindex="1">
      <input type="hidden" name="comment_post_ID" value="<?php echo $post->ID; ?>">
      <input type="hidden" name="redirect_to" value="<?php echo wp_specialchars($_SERVER['REQUEST_URI']); ?>">
    </p>
    <p>
	   <label for="email">
      <?php _e('E-mail'); ?>
      </label>
      <?php if ($req) _e('(required)'); ?><br>
      <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="28" tabindex="2">
    </p>
    <p>
	  <label for="url">
      <?php _e('<acronym title="Uniform Resource Identifier">URI</acronym>'); ?>
      </label><br>
      <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="28" tabindex="3">
    </p>
    <p>
	  <label for="comment">
      <?php _e('Yes?'); ?><br>
      <textarea name="comment" id="comment" cols="60" rows="4" tabindex="4"></textarea>
      <br>
      <br>
      <input style="margin-left:400px;" name="submit" id="submit" type="submit" tabindex="5" value="<?php _e(' Talk To Me '); ?>">
      <br>
      </label>
    </p>
    <?php do_action('comment_form', $post->ID); ?>
  </form>
  <?php else : // Comments are closed ?>
  <!-- <h1 class="center">
      <?php // _e('Comments Closed.'); ?>
    </h1> -->
  <?php endif; ?>
</div>
