<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">	
<?php $option =get_option('viiqi_options');?>
<title><?php if($option["title"]){echo $option["title"];}else{echo '网站标题';}?></title>	
<meta name="keywords"  content="<?php echo $option["home_keyword"];?>"/>
<meta name="description"  content="<?php echo $option["home_description"];?>"/>
<?php wp_head(); ?>
<link rel="icon" href="<?php if($option["ico"]){echo $option["ico"];}else{echo get_bloginfo("template_url")."/images/ico.png";}?>" sizes="32x32" />

	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/css.css">
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style.css">
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/swiper-3.4.2.min.css">
	<script src="<?php bloginfo('template_directory'); ?>/js/jquery-3.2.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php bloginfo('template_directory'); ?>/js/swiper.min.js"></script>
	<script src="<?php bloginfo('template_directory'); ?>/js/rem.js"></script>
	<script>
		window['adaptive'].desinWidth = 750;
		window['adaptive'].init();
	</script>
</head>

<body>

<div class="pc-box">
<div class="topbox">
<div class="wrap clearfix header-box relative">
<a href="<?php echo get_option('home'); ?>" class="logo">
<img src="<?php if($option["logo"]){echo $option["logo"];}else{echo get_bloginfo("template_url")."/images/logo.png";}?>" alt="<?php bloginfo('name'); ?>"></a>
<div class="lang fr relative">
<span class="lan-text">English</span>
<ul class="lan-lists">

						<li><a href="http://www.estbc.org">简体中文版</a></li>
						<li><a href="http://www.estbc.org?lang=zh-hant">繁体中文版</a></li>
						<li><a href="http://www.estbc.org?lang=en">English</a></li>
						<li><a href="<?php echo get_option('home'); ?>?lang=ja">日本語</a></li>

					</ul>

				</div>

<ul class="fr nav clearfix">
<?php
 
$defaults = array(
	'theme_location'  => 'head_nav1',
	'menu'            => '',
	'container'       => '',
	'container_class' => '',
	'container_id'    => '',
	'menu_class'      => 'menu',
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '<i></i>',
	'link_after'      => '',
	'items_wrap'      => '%3$s',
	'depth'           => 0,
	'walker'          => ''
);

wp_nav_menu( $defaults );
?>

				</ul>

			</div>

		</div>

		<img src="<?php bloginfo('template_directory'); ?>/images/border-up.png" alt="">

		<div class="swiper">

			<div class="swiper-wrapper">

	<?php  
$sticky = get_option('sticky_posts');  
rsort( $sticky );  
$sticky = array_slice( $sticky, 0, 5);  
query_posts( array( 'post__in' => $sticky, 'caller_get_posts' => 1 ) );  
if (have_posts()) :  
while (have_posts()) : the_post();  
?>  
<div class="swiper-slide">
<a href="<?php the_permalink(); ?>">
<img src="<?php if (get_field('pcimg')) {echo ''.get_field('pcimg').'';}else { echo ''. get_bloginfo("template_url") .'/images/banner.jpg';}?>" alt="<?php the_title(); ?>">
<div class="title-box-swiper">
<div class="wrap">
<p>
<span class="date">[ <?php the_time('Y.m.d'); ?> ]</span>
<span class="tit"><?php the_title(); ?></span>
</p>
</div>
</div>
</a>
</div>
<?php endwhile; endif; ?>  			

				
				
				
			</div>

			<div class="btn-box">

				<div class="wrap clearfix">

					<div class="prev-btn swiper-btn"></div>

					<div class="next-btn swiper-btn"></div>

					<div class="span"></div>

				</div>

			</div>

		</div>

		<img src="<?php bloginfo('template_directory'); ?>/images/boder-bottom.png" alt="">

		<div class="main wrap">

			<div class="section1 clearfix">

				<div class="fl left-box">

					<div class="title-box flex-wrap">

						<span class="big-tit"><?php echo get_cat_name( 6 ); ?></span>

						<a href="<?php echo get_category_link( 1 );?>">過去の更新</a>

					</div>

					<ul class="clearfix news-lists">
						
<?php query_posts('cat=182,185,189,194,199&showposts=3'); ?>
<?php while (have_posts()) : the_post(); ?> 

						<li>

							<a href="<?php the_permalink() ?>">

								<img src="<?php if ( has_post_thumbnail() ) { ?><?php $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');echo $full_image_url[0];?><?php } else {?><?php echo catch_first_image() ?><?php } ?>" alt="<?php the_title(); ?>">

								<div class="newsInfor">

<p class="p-tit" style="margin-bottom:3px;"><?php echo mb_strimwidth(get_the_title(), 0, 46, '...');  ?></p>
<p class="m-subs" style="margin-bottom:20px;"><?php echo wp_trim_words( get_the_excerpt(), 30 );  ?></p>
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

<?php endwhile; wp_reset_query(); ?>						

					</ul>

				</div>

				<div class="right-box fr">

					<div class="search-box relativ clearfix">
<form action="<?php echo get_option('home'); ?>" method="get">
<input name="s" type="text" placeholder="欲しいものを検索...">
<button></button>
</form>
					</div>

<div class="history-box">
<?php wp_tag_cloud('smallest=12&largest=12&'); ?>
	
					</div>

					<div class="yufa relative">

						<div class="yf-top flex-wrap">

							<span class="tit"><?php echo get_cat_name( 19 ); ?></span>
							
							<?php query_posts('cat=19&showposts=1'); ?>
<?php while (have_posts()) : the_post(); ?> 

							<span class="year">

								<strong><?php the_time('d'); ?></strong><?php the_time('m'); ?>

							</span>

						</div>
						<a href="<?php the_permalink() ?>">
						<p class="subtitle"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 150,"..."); ?></p>
						</a>

						<p class="zhaiz"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></p>
						
						<?php endwhile; wp_reset_query(); ?>

						

						<img src="<?php bloginfo('template_directory'); ?>/images/yinh.png" alt="" class="yinh">

					</div>

				</div>

			</div>
			<!--

			<div class="section2">

				<div class="title-box flex-wrap">

					<span class="big-tit"><?php echo get_cat_name( 121 ); ?></span>

					<div class="abox clearfix">
<?php
$categories=get_categories("child_of=121");
  foreach($categories as $category) {
	echo '<a href="'.get_category_link( $category->term_id ).'">'.$category->name.'</a>';
  }
?>
					</div>

				</div>

				<div class="swiper-item swiper3">

<div class="swiper-wrapper">

	
<div class="swiper-slide">

<?php query_posts("showposts=4&cat=121"); ?>
 <ul>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul>
<ul >
<?php query_posts("showposts=4&cat=121&offset=5"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >
<ul >
<?php query_posts("showposts=4&cat=121&offset=9"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >
</div>

<div class="swiper-slide">

<ul >
<?php query_posts("showposts=4&cat=121&offset=13"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >

<ul >
<?php query_posts("showposts=4&cat=121&offset=17"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >

<ul >
<?php query_posts("showposts=4&cat=121&offset=21"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >

						</div>

<div class="swiper-slide">

<ul >
<?php query_posts("showposts=4&cat=121&offset=25"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >

<ul >
<?php query_posts("showposts=4&cat=121&offset=29"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >

<ul >
<?php query_posts("showposts=4&cat=121&offset=33"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >

</div>
	

					</div>

					<div class="swiper-2-box">

						<div class="left-btns"></div>

						<div class="span2"></div>

						<div class="right-btns"></div>

					</div>

				</div>

			</div>
			-->

			<div class="section3">

				<div class="title-box flex-wrap">

					<span class="big-tit"><?php echo get_cat_name( 8 ); ?></span>

					<div class="abox clearfix">

<?php
$categories=get_categories("child_of=8");
  foreach($categories as $category) {
	echo '<a href="'.get_category_link( $category->term_id ).'">'.$category->name.'</a>';
  }
?>

					</div>

				</div>

				<div class="swiper-item swiper3">

					<div class="swiper-wrapper">

						
						
<div class="swiper-slide">

<?php query_posts("showposts=4&cat=8"); ?>
 <ul>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul>
<ul >
<?php query_posts("showposts=4&cat=8&offset=5"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >
<ul >
<?php query_posts("showposts=4&cat=8&offset=9"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >
</div>

<div class="swiper-slide">

<ul >
<?php query_posts("showposts=4&cat=8&offset=13"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >

<ul >
<?php query_posts("showposts=4&cat=8&offset=17"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >

<ul >
<?php query_posts("showposts=4&cat=8&offset=21"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >

						</div>

<div class="swiper-slide">

<ul >
<?php query_posts("showposts=4&cat=8&offset=25"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >

<ul >
<?php query_posts("showposts=4&cat=8&offset=29"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >

<ul >
<?php query_posts("showposts=4&cat=8&offset=33"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >

</div>
				</div>

					<div class="swiper-2-box">

						<div class="left-btns"></div>

						<div class="span1"></div>

						<div class="right-btns"></div>

					</div>

				</div>

			</div>

			<div class="section3">

				<div class="title-box flex-wrap">

					<span class="big-tit"><?php echo get_cat_name( 126 ); ?></span>

					<div class="abox clearfix">

<?php
$categories=get_categories("child_of=126");
  foreach($categories as $category) {
	echo '<a href="'.get_category_link( $category->term_id ).'">'.$category->name.'</a>';
  }
?>

					</div>

				</div>

				<div class="swiper-item swiper3">

					<div class="swiper-wrapper">

<div class="swiper-slide">

<?php query_posts("showposts=4&cat=126"); ?>
 <ul>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul>
<ul >
<?php query_posts("showposts=4&cat=126&offset=5"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >
<ul >
<?php query_posts("showposts=4&cat=126&offset=9"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >
</div>

<div class="swiper-slide">

<ul >
<?php query_posts("showposts=4&cat=126&offset=13"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >

<ul >
<?php query_posts("showposts=4&cat=126&offset=17"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >

<ul >
<?php query_posts("showposts=4&cat=126&offset=21"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >

						</div>

<div class="swiper-slide">

<ul >
<?php query_posts("showposts=4&cat=126&offset=25"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >

<ul >
<?php query_posts("showposts=4&cat=126&offset=29"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >

<ul >
<?php query_posts("showposts=4&cat=126&offset=33"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >

</div>
				</div>

					<div class="swiper-2-box">

						<div class="left-btns"></div>

						<div class="span1"></div>

						<div class="right-btns"></div>

					</div>

				</div>

			</div>

			<div class="section3">

				<div class="title-box flex-wrap">

					<span class="big-tit"><?php echo get_cat_name( 127 ); ?></span>

					<div class="abox clearfix">

<?php
$categories=get_categories("child_of=127");
  foreach($categories as $category) {
	echo '<a href="'.get_category_link( $category->term_id ).'">'.$category->name.'</a>';
  }
?>

					</div>

				</div>

				<div class="swiper-item swiper3">

					<div class="swiper-wrapper">

						<div class="swiper-slide">

<?php query_posts("showposts=4&cat=127"); ?>
 <ul>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul>
<ul >
<?php query_posts("showposts=4&cat=127&offset=5"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >
<ul >
<?php query_posts("showposts=4&cat=127&offset=9"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >
</div>

<div class="swiper-slide">

<ul >
<?php query_posts("showposts=4&cat=127&offset=13"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >

<ul >
<?php query_posts("showposts=4&cat=127&offset=17"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >

<ul >
<?php query_posts("showposts=4&cat=127&offset=21"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >

						</div>

<div class="swiper-slide">

<ul >
<?php query_posts("showposts=4&cat=127&offset=25"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >

<ul >
<?php query_posts("showposts=4&cat=127&offset=29"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >

<ul >
<?php query_posts("showposts=4&cat=127&offset=33"); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a></li>
<?php endwhile; ?>
</ul >

</div>
				</div>

					<div class="swiper-2-box">

						<div class="left-btns"></div>

						<div class="span1"></div>

						<div class="right-btns"></div>

					</div>

				</div>

			</div>

			<div class="section4">

				<div class="title-box flex-wrap">

					<span class="big-tit"><?php echo get_cat_name( 41 ); ?></span>

					<div class="abox clearfix">

<?php
$categories=get_categories("child_of=41");
  foreach($categories as $category) {
	echo '<a href="'.get_category_link( $category->term_id ).'">'.$category->name.'</a>';
  }
?>

					</div>

				</div>

				<div class="swiper-item swiper3">
				
					<div class="swiper-wrapper">

						<div class="swiper-slide">

<?php query_posts("showposts=4&cat=41"); ?>
 <ul>
<?php while (have_posts()) : the_post(); ?>
<li>							
<?php if (get_field('pdf')) {echo '<img src="'. get_bloginfo("template_url") .'/images/pdf1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('music')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('vedio')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>									
<?php if (get_field('img')) {echo '<img src="'. get_bloginfo("template_url") .'/images/jpg.jpg" alt="">';}else { echo '';}?>									
<a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a>
</li><?php endwhile; ?>
</ul>
<ul >
<?php query_posts("showposts=4&cat=41&offset=5"); ?>
<?php while (have_posts()) : the_post(); ?>
<li>							
<?php if (get_field('pdf')) {echo '<img src="'. get_bloginfo("template_url") .'/images/pdf1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('music')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('vedio')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>									
<?php if (get_field('img')) {echo '<img src="'. get_bloginfo("template_url") .'/images/jpg.jpg" alt="">';}else { echo '';}?>									
<a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a>
</li><?php endwhile; ?>
</ul >
<ul >
<?php query_posts("showposts=4&cat=41&offset=9"); ?>
<?php while (have_posts()) : the_post(); ?>
<li>							
<?php if (get_field('pdf')) {echo '<img src="'. get_bloginfo("template_url") .'/images/pdf1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('music')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('vedio')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>									
<?php if (get_field('img')) {echo '<img src="'. get_bloginfo("template_url") .'/images/jpg.jpg" alt="">';}else { echo '';}?>									
<a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a>
</li><?php endwhile; ?>
</ul >
</div>

<div class="swiper-slide">

<ul >
<?php query_posts("showposts=4&cat=41&offset=13"); ?>
<?php while (have_posts()) : the_post(); ?>
<li>							
<?php if (get_field('pdf')) {echo '<img src="'. get_bloginfo("template_url") .'/images/pdf1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('music')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('vedio')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>									
<?php if (get_field('img')) {echo '<img src="'. get_bloginfo("template_url") .'/images/jpg.jpg" alt="">';}else { echo '';}?>									
<a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a>
</li><?php endwhile; ?>
</ul >

<ul >
<?php query_posts("showposts=4&cat=41&offset=17"); ?>
<?php while (have_posts()) : the_post(); ?>
<li>							
<?php if (get_field('pdf')) {echo '<img src="'. get_bloginfo("template_url") .'/images/pdf1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('music')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('vedio')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>									
<?php if (get_field('img')) {echo '<img src="'. get_bloginfo("template_url") .'/images/jpg.jpg" alt="">';}else { echo '';}?>									
<a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a>
</li><?php endwhile; ?>
</ul >

<ul >
<?php query_posts("showposts=4&cat=41&offset=21"); ?>
<?php while (have_posts()) : the_post(); ?>
<li>							
<?php if (get_field('pdf')) {echo '<img src="'. get_bloginfo("template_url") .'/images/pdf1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('music')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('vedio')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>									
<?php if (get_field('img')) {echo '<img src="'. get_bloginfo("template_url") .'/images/jpg.jpg" alt="">';}else { echo '';}?>									
<a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a>
</li><?php endwhile; ?>
</ul >

						</div>

<div class="swiper-slide">

<ul >
<?php query_posts("showposts=4&cat=41&offset=25"); ?>
<?php while (have_posts()) : the_post(); ?>
<li>							
<?php if (get_field('pdf')) {echo '<img src="'. get_bloginfo("template_url") .'/images/pdf1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('music')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('vedio')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>									
<?php if (get_field('img')) {echo '<img src="'. get_bloginfo("template_url") .'/images/jpg.jpg" alt="">';}else { echo '';}?>									
<a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a>
</li><?php endwhile; ?>
</ul >

<ul >
<?php query_posts("showposts=4&cat=41&offset=29"); ?>
<?php while (have_posts()) : the_post(); ?>
<li>							
<?php if (get_field('pdf')) {echo '<img src="'. get_bloginfo("template_url") .'/images/pdf1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('music')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('vedio')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>									
<?php if (get_field('img')) {echo '<img src="'. get_bloginfo("template_url") .'/images/jpg.jpg" alt="">';}else { echo '';}?>									
<a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a>
</li>
	<?php endwhile; ?>
</ul >

<ul >
<?php query_posts("showposts=4&cat=41&offset=33"); ?>
<?php while (have_posts()) : the_post(); ?>
<li>							
<?php if (get_field('pdf')) {echo '<img src="'. get_bloginfo("template_url") .'/images/pdf1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('music')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('vedio')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>									
<?php if (get_field('img')) {echo '<img src="'. get_bloginfo("template_url") .'/images/jpg.jpg" alt="">';}else { echo '';}?>									
<a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a>
</li>
	<?php endwhile; ?>
</ul >

</div>
				</div>
				
					<div class="swiper-2-box">
				
						<div class="left-btns"></div>
				
						<div class="span1"></div>
				
						<div class="right-btns"></div>
				
					</div>
				
				</div>

			</div>

			<div class="section4">

				<div class="title-box flex-wrap">

					<span class="big-tit"><?php echo get_cat_name( 42 ); ?></span>

					<div class="abox clearfix">



					</div>

				</div>

				<div class="swiper-item swiper3">

					<div class="swiper-wrapper">

						<div class="swiper-slide">

<?php query_posts("showposts=4&cat=42"); ?>
 <ul>
<?php while (have_posts()) : the_post(); ?>
<li>							
<?php if (get_field('pdf')) {echo '<img src="'. get_bloginfo("template_url") .'/images/pdf1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('music')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('vedio')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>									
<?php if (get_field('img')) {echo '<img src="'. get_bloginfo("template_url") .'/images/jpg.jpg" alt="">';}else { echo '';}?>									
<a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a>
</li><?php endwhile; ?>
</ul>
<ul >
<?php query_posts("showposts=4&cat=42&offset=5"); ?>
<?php while (have_posts()) : the_post(); ?>
<li>							
<?php if (get_field('pdf')) {echo '<img src="'. get_bloginfo("template_url") .'/images/pdf1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('music')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('vedio')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>									
<?php if (get_field('img')) {echo '<img src="'. get_bloginfo("template_url") .'/images/jpg.jpg" alt="">';}else { echo '';}?>									
<a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a>
</li><?php endwhile; ?>
</ul >
<ul >
<?php query_posts("showposts=4&cat=42&offset=9"); ?>
<?php while (have_posts()) : the_post(); ?>
<li>							
<?php if (get_field('pdf')) {echo '<img src="'. get_bloginfo("template_url") .'/images/pdf1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('music')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('vedio')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>									
<?php if (get_field('img')) {echo '<img src="'. get_bloginfo("template_url") .'/images/jpg.jpg" alt="">';}else { echo '';}?>									
<a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a>
</li><?php endwhile; ?>
</ul >
</div>

<div class="swiper-slide">

<ul >
<?php query_posts("showposts=4&cat=42&offset=13"); ?>
<?php while (have_posts()) : the_post(); ?>
<li>							
<?php if (get_field('pdf')) {echo '<img src="'. get_bloginfo("template_url") .'/images/pdf1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('music')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('vedio')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>									
<?php if (get_field('img')) {echo '<img src="'. get_bloginfo("template_url") .'/images/jpg.jpg" alt="">';}else { echo '';}?>									
<a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a>
</li><?php endwhile; ?>
</ul >

<ul >
<?php query_posts("showposts=4&cat=42&offset=17"); ?>
<?php while (have_posts()) : the_post(); ?>
<li>							
<?php if (get_field('pdf')) {echo '<img src="'. get_bloginfo("template_url") .'/images/pdf1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('music')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('vedio')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>									
<?php if (get_field('img')) {echo '<img src="'. get_bloginfo("template_url") .'/images/jpg.jpg" alt="">';}else { echo '';}?>									
<a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a>
</li><?php endwhile; ?>
</ul >

<ul >
<?php query_posts("showposts=4&cat=42&offset=21"); ?>
<?php while (have_posts()) : the_post(); ?>
<li>							
<?php if (get_field('pdf')) {echo '<img src="'. get_bloginfo("template_url") .'/images/pdf1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('music')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('vedio')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>									
<?php if (get_field('img')) {echo '<img src="'. get_bloginfo("template_url") .'/images/jpg.jpg" alt="">';}else { echo '';}?>									
<a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a>
</li><?php endwhile; ?>
</ul >

						</div>

<div class="swiper-slide">

<ul >
<?php query_posts("showposts=4&cat=42&offset=25"); ?>
<?php while (have_posts()) : the_post(); ?>
<li>							
<?php if (get_field('pdf')) {echo '<img src="'. get_bloginfo("template_url") .'/images/pdf1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('music')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('vedio')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>									
<?php if (get_field('img')) {echo '<img src="'. get_bloginfo("template_url") .'/images/jpg.jpg" alt="">';}else { echo '';}?>									
<a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a>
</li><?php endwhile; ?>
</ul >

<ul >
<?php query_posts("showposts=4&cat=42&offset=29"); ?>
<?php while (have_posts()) : the_post(); ?>
<li>							
<?php if (get_field('pdf')) {echo '<img src="'. get_bloginfo("template_url") .'/images/pdf1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('music')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('vedio')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>									
<?php if (get_field('img')) {echo '<img src="'. get_bloginfo("template_url") .'/images/jpg.jpg" alt="">';}else { echo '';}?>									
<a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a>
</li>
	<?php endwhile; ?>
</ul >

<ul >
<?php query_posts("showposts=4&cat=42&offset=33"); ?>
<?php while (have_posts()) : the_post(); ?>
<li>							
<?php if (get_field('pdf')) {echo '<img src="'. get_bloginfo("template_url") .'/images/pdf1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('music')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>
<?php if (get_field('vedio')) {echo '<img src="'. get_bloginfo("template_url") .'/images/mov1.jpg" alt="">';}else { echo '';}?>									
<?php if (get_field('img')) {echo '<img src="'. get_bloginfo("template_url") .'/images/jpg.jpg" alt="">';}else { echo '';}?>									
<a href="<?php the_permalink() ?>"><?php the_title_attribute(); ?></a>
</li>
	<?php endwhile; ?>
</ul >

</div>
				</div>

					<div class="swiper-2-box">

						<div class="left-btns"></div>

						<div class="span1"></div>

						<div class="right-btns"></div>

					</div>

				</div>

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
        array('theme_location' => 'head_nav3',   
            'container_class' => 'user_menu',   
            'echo' => false,   
            'items_wrap' => '%3$s')   
), '<a>');   
?> 

			</div>
<?php $option =get_option('viiqi_options');?>
<p class="copy"><?php if($option["copyright"]){echo $option["copyright"];}else{echo '';}?></p>
</div>

	</div>
	

	<div class="m-box">

		<div class="m-swiper swiper2">

			<div class="m-search-box">
<form action="<?php echo get_option('home'); ?>" method="get">
				<button class="button-search"></button>
<input type="text" name="s"   placeholder="キーワード検索を入力してください">
							</form>

			</div>

			<div class="swiper-wrapper">
				
	<?php  
$sticky = get_option('sticky_posts');  
rsort( $sticky );  
$sticky = array_slice( $sticky, 0, 5);  
query_posts( array( 'post__in' => $sticky, 'caller_get_posts' => 1 ) );  
if (have_posts()) :  
while (have_posts()) : the_post();  
?>  
<div class="swiper-slide">
<a href="<?php the_permalink(); ?>">
<img src="<?php if (get_field('wapimg')) {echo ''.get_field('wapimg').'';}else { echo ''. get_bloginfo("template_url") .'/images/m-banner.jpg';}?>" alt="<?php the_title(); ?>">
						<div class="m-swiper-tilt flex-wrap">
							<span><?echo mb_strimwidth(get_the_title(), 0, 30, '...'); ?></span>
							<span id="m-year"> <strong><?php the_time('m'); ?></strong><span><?php the_time('d'); ?></span></span>
						</div>

	</a>
				</div>
<?php endwhile; endif; ?>  	
			
			</div>
    <div class="swiper-pagination1"></div>
			

		</div>

		<div class="m-section-1">

			<div class="m-title-box flex-wrap" style="margin-top:0;">

				<span class="m-name">一乗顕密注目の</span>

				<img src="<?php bloginfo('template_directory'); ?>/images/menu.jpg" alt="" class="menu" onclick="showSubnav();">

			</div>

			<div class="m-tab-box clearfix">

<?php
 
$defaults = array(
	'theme_location'  => 'head_nav4',
	'menu'            => '',
	'container'       => '',
	'container_class' => '',
	'container_id'    => '',
	'menu_class'      => 'menu',
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '%3$s',
	'depth'           => 0,
	'walker'          => ''
);

wp_nav_menu( $defaults );
?>

			</div>

		</div>

		<div class="m-section-2">

			<div class="m-wrap">

				<div class="m-title-box flex-wrap" style="margin-top:0;">

					<span class="m-name"><?php echo get_cat_name( 19 ); ?></span>

					<img src="<?php bloginfo('template_directory'); ?>/images/yinhao.png" alt="" class="yinhao">

				</div>

<?php query_posts('cat=19&showposts=1'); ?>
<?php while (have_posts()) : the_post(); ?> 
				<a href="<?php the_permalink() ?>">
				<p class="con-m">
					<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 150,"..."); ?>
				</p>
					</a>
<div class="flex-wrap zhaizi-boxs">
<span class="m-zhai"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></span>
<span class="m-fabu-date"><?php the_time('m-d'); ?></span>
</div>
				
<?php endwhile; wp_reset_query(); ?>


			</div>

		</div>

		<div class="m-section-3">

			<div class="m-wrap">

				<div class="m-title-box flex-wrap" style="margin-top:0;">

					<span class="m-name">ニュース</span>

				</div>

				<ul class="m-news-list">

<?php query_posts('cat=182,185,189,194,199&showposts=5'); ?>
<?php while (have_posts()) : the_post(); ?> 
<li>
					<a href="<?php the_permalink() ?>">
						<div class="img-M-BOX">
								<div class="m-bg"></div>
							<img src="<?php if ( has_post_thumbnail() ) { ?><?php $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');echo $full_image_url[0];?><?php } else {?><?php echo catch_first_image() ?><?php } ?>" alt="<?php the_title(); ?>">
							<div class="flex m-see-box">
								<img src="<?php bloginfo('template_directory'); ?>/images/m-eye.png" alt="">
								<span><?php post_views(' ', ' '); ?></span>
							</div>
						</div>
						<div class="m-news-info">
							<p class="m-news-tit"><?php the_title_attribute(); ?></p>
<div class="flex-wrap m-news-user-info"><?php the_tags('', '', ''); ?><span class="m-push-date"><?php  echo timeago(get_gmt_from_date(get_the_time('Y-m-d'))); ?></span></div>
						</div>
					</a>
				</li>
<?php endwhile; wp_reset_query(); ?>
				</ul>

			</div>

		</div>

		<div class="m-section-3">

			<div class="m-wrap">

				<div class="m-title-box flex-wrap" style="margin-top:0;">

					<span class="m-name">共通のシーン</span>

				</div>

				<div class="cj-list">

<?php wp_tag_cloud('smallest=12&largest=12&'); ?>

				</div>

			</div>

		</div>

	</div>

	<div class="m-sub-menu hidden">

		<span class="close" onclick="hideSubnav();"></span>

		<div class="m-menu-top"> 

			<a href="<?php  
$page_id = 1469;  
$page_data = get_page( $page_id );  
echo $page_data->guid;      // 调用页面标题  
?>" class="flex m-item">

				<img src="<?php bloginfo('template_directory'); ?>/images/a1.png" alt="" class="a1">

				<span><?php  
$page_id = 1469;  
$page_data = get_page( $page_id );  
echo $page_data->post_title;      // 调用页面标题  
?></span>

			</a>

			<a href="<?php echo get_category_link( 157 );?>" class="flex m-item">

				<img src="<?php bloginfo('template_directory'); ?>/images/a2.png" alt="" class="a2">

				<span><?php echo get_cat_name( 157 ); ?></span>

			</a>

			<a href="<?php  
$page_id = 1471;  
$page_data = get_page( $page_id );  
echo $page_data->guid;      // 调用页面标题  
?>" class="flex m-item">

				<img src="<?php bloginfo('template_directory'); ?>/images/a3.png" alt="" class="a3">

				<span><?php  
$page_id = 1471;  
$page_data = get_page( $page_id );  
echo $page_data->post_title;      // 调用页面标题  
?></span>

			</a>

			<a href="<?php  
$page_id = 1475;  
$page_data = get_page( $page_id );  
echo $page_data->guid;      // 调用页面标题  
?>" class="flex m-item">

				<img src="<?php bloginfo('template_directory'); ?>/images/a4.png" alt="" class="a4">

				<span><?php  
$page_id =1475;  
$page_data = get_page( $page_id );  
echo $page_data->post_title;      // 调用页面标题  
?></span>

			</a>

			<a href="<?php  
$page_id = 1477;  
$page_data = get_page( $page_id );  
echo $page_data->guid;      // 调用页面标题  
?>" class="flex m-item">

				<img src="<?php bloginfo('template_directory'); ?>/images/a5.png" alt="" class="a5">

				<span><?php  
$page_id = 1477;  
$page_data = get_page( $page_id );  
echo $page_data->post_title;      // 调用页面标题  
?></span>

			</a>

		</div>

		
		<div class="m-lan-box">

			<a href="http://www.estbc.org" class="flex m-item">

				<img src="<?php bloginfo('template_directory'); ?>/images/a7.png" alt="" class="a6">

				<span>简体中文版</span>

			</a>

			<a href="http://www.estbc.org?lang=zh-hant" class="flex m-item">

				<img src="<?php bloginfo('template_directory'); ?>/images/a8.png" alt="" class="a7">

				<span>繁体中文版</span>

			</a>

			<a href="http://www.estbc.org?lang=en" class="flex m-item">

				<img src="<?php bloginfo('template_directory'); ?>/images/a9.png" alt="" class="a8">

				<span>English</span>

			</a>

			<a href="<?php echo get_option('home'); ?>?lang=ja" class="flex m-item">

				<img src="<?php bloginfo('template_directory'); ?>/images/a10.png" alt="" class="a9">

				<span>日本語</span>

			</a>

		</div>

	</div>

	

</body>



<script src="<?php bloginfo('template_directory'); ?>/js/index.js"></script>
	
<script>
		
	$(".swiper3 .swiper-slide").each(function(){
		if($(this).find("ul").find("li").length==0)
		{
			$(this).remove();
			}
		});

	var swiper1=new Swiper('.swiper',{

		pagination:'.span',

		paginationClickable:true,

		autoplay: {
        delay: 3200,
        disableOnInteraction: false,
      },
	  navigation: {
      nextEl: '.prev-btn',
      prevEl: '.next-btn',
    }

	})


var swiper2=new Swiper('.swiper2',{

		paginationClickable:true,
		
		pagination: {
      el: '.swiper-pagination1',
    },

		
		navigation: {
      nextEl: '.left-btns',
      prevEl: '.right-btns',
    },
		
		autoplay: {
        delay: 3200,
        disableOnInteraction: false
      },
	loop: true

	})



	$(".nav > li").hover(function (){

		$(this).find(".drop-box").stop().slideToggle();

	})


$(".m-d-swiper .swiper-slide").each(function(){
	if($(".m-d-swiper .swiper-slide").length>2)
	{
		var mySwiper = new Swiper('.m-d-swiper', {

             slidesPerView: 'auto',

                slidesPerView: 2.6,

                spaceBetween: 20,

                loop: true,

     });
		}
		else
		{
			$(".m-d-swiper").addClass("nav_2");
			}
	});
 	

	function gdjz(div, cssname, offset, ele) {

		var a, b, c, d;

		d = $(div).offset().top;

		a = eval(d + offset);

		b = $(window).scrollTop();

		c = $(window).height();

		console.log(b + c)

		console.log(a)



		if (b + c > a + 300) {

			$(ele).addClass((cssname));

		} else {

			$(ele).removeClass((cssname));

		}

	}


	
	$(".lang").hover(function (){

		$(this).find(".lan-lists").stop().slideToggle();

	})
	
			$(".nav > li").hover(function (){

		$(this).find(".sub-menu").stop().slideToggle();

	})



	$(document).ready(function (e) {

		$(window).scroll(function () {

			gdjz(".m-swiper", 'active', 400, '.m-section-1');

		})

	})

</script>

	
</html>