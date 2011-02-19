<?php
// Do not delete these lines
  if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Please do not load this page directly. Thanks!');

  if ( post_password_required() ) { ?>
    <p class="nocomments">This post is password protected. Enter the password to view comments.</p>
  <?php
    return;
  }
?>

<?php if ( have_comments() ) : ?>
  <article id="comments">
    <header>
      <nav class="floatwrapper">
        <p class="floatleft"><?php previous_comments_link() ?></p>
        <p class="floatright"><?php next_comments_link() ?></p>
      </nav>
      <h4><?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h4>
    </header>
    <ol>
      <?php wp_list_comments(); ?>
    </ol>
    <footer>
      <nav class="floatwrapper">
        <p class="floatleft"><?php previous_comments_link() ?></p>
        <p class="floatright"><?php next_comments_link() ?></p>
      </nav>
    </footer>
 <?php else : // this is displayed if there are no comments so far ?>
  <?php if ( comments_open() ) : ?>
    <!-- If comments are open, but there are no comments. -->
   <?php else : // comments are closed ?>
    <!-- If comments are closed. -->
    <p class="nocomments">Comments are closed.</p>
  <?php endif; ?>
<?php endif; ?>

<?php if ( comments_open() ) : ?>
  <div id="respond">
    <h4><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h4>
    <div class="cancel-comment-reply">
      <p class="small"><?php cancel_comment_reply_link(); ?></p>
    </div>
    <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
      <p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
    <?php else : ?>
      <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
        <?php if ( is_user_logged_in() ) : ?>
          <p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
        <?php else : ?>
          <p><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> /><label for="author"><p class="small">Name <?php if ($req) echo "(required)"; ?></p></label></p>
          <p><input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> /><label for="email"><p class="small">Mail (will not be published) <?php if ($req) echo "(required)"; ?></p></label></p>
          <p><input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" /><label for="url"><p class="small">Website</p></label></p>
        <?php endif; ?>
        <p><textarea name="comment" id="comment" rows="10" tabindex="4"></textarea></p>
        <p id="submit"><input name="submit" type="submit" tabindex="5" value="Submit Comment" /><?php comment_id_fields(); ?></p>
        <?php do_action('comment_form', $post->ID); ?>
      </form>
    <?php endif; // If registration required and not logged in ?>
  </div>
<?php endif; // if you delete this the sky will fall on your head ?>
