<?php get_header();?>
<?php $option = get_option('viiqi_options');  ?>

<img src="<?php bloginfo('template_directory'); ?>/images/border-up.png" alt="">

<div class="list-banner">

<h3>搜索结果</h3>

<p>Sou suo jie guo</p>

</div>

<img src="<?php bloginfo('template_directory'); ?>/images/boder-bottom.png" alt="">

<div class="wrap mianbao-nav">

<a href="<?php echo get_option('home'); ?>" >首页 /</a>

<a href="#" class="cuurent">搜索结果</a>

</div>

				<div class="main wrap clearfix">

					<div class="list-left fl">

						<div class="search-box relativ clearfix">
							<form action="<?php echo get_option('home'); ?>" method="get">

							<input type="text" name="s"  placeholder="搜索时输入的内容" style="width:653px;">

							<button></button>
							</form>

						</div>

						<ul class="clearfix news-lists" style="padding-top: 30px;">
							
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>">
<img src="<?php if ( has_post_thumbnail() ) { ?><?php $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');echo $full_image_url[0];?><?php } else {?><?php echo catch_first_image() ?><?php } ?>" alt="<?php the_title(); ?>">
									<div class="newsInfor">
<p class="p-tit" style="margin-bottom:3px;"><?php the_title_attribute(); ?></p>
<p class="m-subs" style="margin-bottom:20px;"><?php echo wp_trim_words( get_the_excerpt(), 36 );  ?></p>
										<div class="flex-wrap">
<span class="name"><?php the_tags('', '', ''); ?></span>
											<div class="icon-item">
												<span class="date-io"><?php the_time('Y.m.d'); ?></span>
												<span class="eye"><?php post_views(' ', ' '); ?></span>
											</div>
										</div>
									</div>
								</a>
							</li>
<?php endwhile; ?>
<?php else : ?>

<div class="seach-none">
<span class="filter">暂无搜索结果</span>
</div>
<?php endif; wp_reset_query();?>
							

						<div class="pages">
							
							
							<?php pagenavi(); ?>



						</div>

					</div>

					<div class="list-right fr" style="">

<?php if(is_dynamic_sidebar()) dynamic_sidebar('sidebar-2');?>


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

	</div>

	<div class="m-box">

		<div class="m-search-box flex-wrap" id="m-search-box">

			<div class="relative">
							<form action="<?php echo get_option('home'); ?>" method="get">

				<button class="button-search"></button>

				<input type="text" name="s"   placeholder="请输入关键字搜索">
							</form>

			</div>

<a href="#" onClick="javascript :history.back(-1);" ><span class="cancel">取消</span></a>

		</div>

		<div class="m-wrap hot-box">



			<div class="m-title-box flex-wrap">

				<span class="m-name">搜索结果</span>

			</div>

			<ul class="m-news-list">
				
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
				<li>

					<a href="<?php the_permalink() ?>">

						<div class="img-M-BOX">

								<div class="m-bg"></div>

							<img src="<?php if ( has_post_thumbnail() ) { ?><?php $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');echo $full_image_url[0];?><?php } else {?><?php echo catch_first_image() ?><?php } ?>" alt="<?php the_title(); ?>" >

							<div class="flex m-see-box">

								<img src="<?php bloginfo('template_directory'); ?>/images/m-eye.png" alt="">

								<span><?php post_views(' ', ' '); ?></span>

							</div>

						</div>

						<div class="m-news-info">

							<p class="m-news-tit"><?php the_title_attribute(); ?></p>

<div class="flex-wrap m-news-user-info"><?php the_tags('', ', ', ''); ?><span class="m-push-date"><?php  echo timeago(get_gmt_from_date(get_the_time('Y-m-d'))); ?></span></div>


						</div>

					</a>

				</li>
<?php endwhile; ?>
<?php else : ?>

<div class="seach-none">
<span class="filter">暂无搜索结果</span>
</div>
<?php endif; wp_reset_query();?>				
				
			

			</ul>
			
<div class="pages">
							
<?php pagenavi(); ?>

</div>
			
				<div class="m-title-box flex-wrap">

				<span class="m-name">热门关键字</span>

			</div>

			<div class="cj-list">

				<?php wp_tag_cloud('smallest=12&largest=12&'); ?>

			</div>		
			
			

		</div>

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


	
	$(".lang").hover(function (){

		$(this).find(".lan-lists").stop().slideToggle();

	})
	
	
		$(".nav > li").hover(function (){

		$(this).find(".sub-menu").stop().slideToggle();

	})
	var swiper2=new Swiper('.swiper-item',{

		pagination:'.span1',

		paginationClickable:true,

		prevButton:".left-btns",

		nextButton:".right-btns"

	})



	$(".nav > li").hover(function (){

		$(this).find(".drop-box").stop().slideToggle();

	})

</script>

</html>