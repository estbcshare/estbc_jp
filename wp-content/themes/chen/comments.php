<?php
	if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
<!-- Comment's List -->
		
<?php
if ( !comments_open() ) :
// If registration required and not logged in.
elseif ( get_option('comment_registration') && !is_user_logged_in() ) :
?>
<p>你必须 <a href="<?php echo wp_login_url( get_permalink() ); ?>">登录</a> 才能发表评论.</p>
<?php else  : ?>
<!-- Comment Form -->
<form class="form-horizontal" name="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">

        <?php if ( !is_user_logged_in() ) : ?>
		
		   <div class="form-group">
         <label for="title" class="col-sm-3 control-label">留言标题：</label>
         <div class="col-sm-6">
          <input type="text" name="author" class="form-control" value="<?php echo $comment_author; ?>" id="title" placeholder="必填" />
         </div>
        </div>
		
		        <div class="form-group">
         <label for="tel" class="col-sm-3 control-label">联系电话：</label>
         <div class="col-sm-6">
          <input type="text" name="url" class="form-control" value="<?php echo $comment_author_url; ?>"  id="tel" placeholder="必填" />
         </div>
        </div>
		
		  <div class="form-group">
         <label for="inputEmail" class="col-sm-3 control-label">电子邮箱：</label>
         <div class="col-sm-6">
          <input type="email" name="email" value="<?php echo $comment_author_email; ?>" class="form-control" id="inputEmail" />
         </div>
        </div>

        <?php else : ?>
        		 <div class="form-group">
         <label for="contents" class="col-sm-3 control-label">
			 您已登录:<a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="退出登录">退出 &raquo;</a></label>
		 <div class="col-sm-6">

					 </div>
		
		</div>
        <?php endif; ?>
		
		 <div class="form-group">
         <label for="contents" class="col-sm-3 control-label">留言内容：</label>
         <div class="col-sm-6">
          <textarea name="comment" class="form-control" rows="3"></textarea>
         </div>
        </div>
		
        <div class="form-group" style="margin-top:30px;">
         <div class="col-sm-offset-3 col-sm-10">
          <button type="submit" name="button" value="Send" class="btn btn-danger">提交留言</button>&nbsp; 
          <button type="reset" name="reset" class="btn btn-default">重新填写</button>
         </div>
        </div>


    <?php comment_id_fields(); ?>
    <?php do_action('comment_form', $post->ID); ?>
</form>
<?php endif; ?>