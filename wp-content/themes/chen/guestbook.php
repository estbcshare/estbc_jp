<?php
/*
Template Name:在线留言
*/
?>

<?php get_header();?>

<?php $option = get_option('viiqi_options');  ?>
 <!-- main -->
<div class="container">    
        <div class="row">

            <!-- right -->
            <div class="col-xs-12 col-sm-8 col-md-9" style="float:right">
              <div class="list_box">
                    <h2 class="left_h1"><?php the_title_attribute(); ?></h2>


      <div class="feedback">
		  
		  <?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<?php the_content("Read More..."); ?>
 
<?php endwhile; ?>
		  
	<?php comments_template(); ?>
	  
<?php else : ?>
<?php endif; ?>
		  
				  </div>
              </div>
            </div>

              <!-- left -->
              <div class="col-xs-12 col-sm-4 col-md-3">
              
                  <div class="left_nav" id="categories">
                    <h1 class="left_h1">栏目导航</h1>
                    <ul class="left_nav_ul" id="firstpane">					
						
<?php 
$pages = get_pages(); 
foreach ($pages as $pagg) {         
         echo '<li><a href="' . get_page_link($pagg->ID). '" title="' . sprintf( __( "View all posts in %s" ), $pagg->post_title ) . '" ' . '>' . $pagg->post_title.'</a></li>';
}
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