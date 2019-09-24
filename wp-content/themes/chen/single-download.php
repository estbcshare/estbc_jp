<?php get_header();?>

<?php $option = get_option('viiqi_options');  ?>
 <!-- main -->
<div class="container">    
        <div class="row">

            <!-- right -->
            <div class="col-xs-12 col-sm-8 col-md-9" style="float:right"><div class="list_box"><h2 class="left_h1">下载中心</h2>
                    <div class="contents">
						
<h1 class="contents_title"><?php the_title_attribute(); ?></h1>
              <?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
						

<?php if (get_post_meta(get_the_ID(), '_download_shopurl', true)) {echo '<p class="download_btn"><a href="'.get_post_meta(get_the_ID(), '_download_shopurl', true ).'" class="btn btn-primary" role="button" target="_blank"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>&nbsp;点击下载</a></p>';}else { echo '';}?>
						

<?php the_content("Read More..."); ?>
<?php endwhile; ?>
<?php else : ?>
<?php endif; ?>
				
<div class="point">
    
<?php
$prev_post = get_previous_post();
if (!empty( $prev_post )): ?>
   <span class="to_prev col-xs-12 col-sm-6 col-md-6"> 上一篇：<a title="<?php echo $prev_post->post_title; ?>" href="<?php echo get_permalink( $prev_post->ID ); ?>" rel="external nofollow" ><?php echo $prev_post->post_title; ?></a></span>
<?php endif; ?>

<?php
$next_post = get_next_post();
if (!empty( $next_post )): ?>
  <span class="to_next col-xs-12 col-sm-6 col-md-6">
下一篇：<a title="<?php echo $next_post->post_title; ?>" href="<?php echo get_permalink( $next_post->ID ); ?>" rel="external nofollow" ><?php echo $next_post->post_title; ?></a></span>
<?php endif; ?>

                    </div>
				  
				  </div>
              </div>
            </div>

              <!-- left -->  

              <div class="col-xs-12 col-sm-4 col-md-3">
              
                  <div class="left_nav" id="categories">
                    <h1 class="left_h1">栏目导航</h1>
                    <ul class="left_nav_ul" id="firstpane">

<?php
echo str_replace("</ul></div>", "", ereg_replace("<div[^>]*><ul[^>]*>", "", wp_nav_menu(array('theme_location' => 'head_nav3', 'echo' => false)) ));
?> 
						
</ul>                  </div>
                  
                  <div class="left_news">
                    <h1 class="left_h1">新闻中心</h1>
                    <ul class="index_news">

<?php query_posts('post_type=news&showposts=6'); ?>
<?php while (have_posts()) : the_post(); ?> 
<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a><span class='news_time'><?php the_time('Y-m-d'); ?></span></li>
<?php endwhile; ?> 
<?php wp_reset_query(); ?>

</ul>                  </div>
                 <div class="index_contact">
<h1 class="about_h1">联系我们</h1><span class="about_span">CONTACT US</span>

    <p style="padding-top:20px;">联系人：<?php if($option["add1"]){echo $option["add1"];}else{echo me;}?></p>
    <p>手机：<?php if($option["add2"]){echo $option["add2"];}else{echo 6287451;}?></p>
    <p>电话： <?php if($option["add3"]){echo $option["add3"];}else{echo 13326882549;}?></p>
    <p>邮箱：<?php if($option["add4"]){echo $option["add4"];}else{echo qq;}?></p>
    <p>地址：<?php if($option["add5"]){echo $option["add5"];}else{echo address;}?></p>

</div>
              </div>

        </div>
    </div> 


<?php get_footer();?>