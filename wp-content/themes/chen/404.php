<?php get_header();?>

	
				<img src="<?php bloginfo('template_directory'); ?>/images/border-up.png" alt="">
				<div class="list-banner">
					<h3>404页面</h3>
					<p></p>
				</div>
				<img src="<?php bloginfo('template_directory'); ?>/images/boder-bottom.png" alt="">
				<div class="wrap mianbao-nav">
<a href="<?php echo get_option('home'); ?>" >/</a>
404页面
				</div>
				<div class="main wrap clearfix">
					<div class="list-left fl">
						<div class="article-box">
							<div class="article-title"><?php the_title_attribute(); ?></div>
							<p class="sub"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 150,"..."); ?></p>
						</div>
						
						<div class="flex-wrap bot">
							<div class="flex keyword">
								<?php the_tags('', ', ', ''); ?>
							</div>
							<span class="date-io" id="date-io"><?php the_time('Y.m.d'); ?></span>
						</div>
						<div class="ar-content">
							<p>
								
暂无内容
							
							</p>
							
						</div>
						
						
					</div>
					
					<div class="list-right fr">
						
						<div class="search-box relativ clearfix">
							<form action="<?php echo get_option('home'); ?>" method="get">
							<input type="text" name="s" placeholder="搜索想要的...">
							<button></button>
							</form>
						</div>
										
			<?php if(is_dynamic_sidebar()) dynamic_sidebar('sidebar-1');?>
						
						
					</div>
					
				</div>
		


				<div class="footer">
					<div class="foot-nav">
				<?php   
echo strip_tags(wp_nav_menu(   
        array('theme_location' => 'head_nav2',   
            'container_class' => 'user_menu',   
            'echo' => false,   
            'items_wrap' => '%3$s')   
), '<a>');   
?> 
						<img src="<?php bloginfo('template_directory'); ?>/images/foot-logo.png" alt="">
								<?php   
echo strip_tags(wp_nav_menu(   
        array('theme_location' => 'head_nav2',   
            'container_class' => 'user_menu',   
            'echo' => false,   
            'items_wrap' => '%3$s')   
), '<a>');   
?> 
					</div>
<p class="copy"><?php if($option["copyright"]){echo $option["copyright"];}else{echo '';}?></p>
				</div>
	</div>
	<div class="m-box">
		<div class="m-article-banner">
			<img src="<?php if ( has_post_thumbnail() ) { ?><?php $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');echo $full_image_url[0];?><?php } else {?><?php bloginfo('template_url'); ?>/images/pic1.png<?php } ?>" alt="<?php the_title(); ?>">
<a href="#" onClick="javascript :history.back(-1);" class="back"></a>
<a href="<?php echo get_option('home'); ?>" class="m-home"></a>
		</div>
		<div class="m-ar-box">
			<h3 class="m-ar-title">404页面</h3>
			<div class="flex-wrap m-ar-b">
				
			</div>
			<div class="m-ar-con">
			
暂无内容

			</div>
		</div>
	</div>
	<div class="m-right-nav hidden">
		<a href="javascript:;" class="goTop"></a>

</div>
	

	
</body>

<script src="<?php bloginfo('template_directory'); ?>/js/index.js"></script>
<script>
	var swiper1=new Swiper('.swiper',{
		pagination:'.span',
		paginationClickable:true,
		autoplay:'2500',
		prevButton:".prev-btn",
		nextButton:".next-btn"
	})

	var swiper2=new Swiper('.swiper-item',{
		pagination:'.span1',
		paginationClickable:true,
		prevButton:".left-btns",
		nextButton:".right-btns"
	})

		
	$(".lang").hover(function (){

		$(this).find(".lan-lists").stop().slideToggle();

	})
	
	
		$(".nav > li").hover(function (){

		$(this).find(".sub-menu").stop().slideToggle();

	})
	$(".nav > li").hover(function (){
		$(this).find(".drop-box").stop().slideToggle();
	})

	$(".goTop").click(function (){
		$("body,html").animate({
			scrollTop:0
		})
	})

	$(".download").click(function (){
		$(".bgs").fadeIn();
		$(".m-right-nav").hide();
		$('.ani').addClass('ss_animate');
	})

	$("#ss_toggle").click(function (){
		$(".bgs").fadeOut();
		$(".m-right-nav").show();
	})
</script>
</html>