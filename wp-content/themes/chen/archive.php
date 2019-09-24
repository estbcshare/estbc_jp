<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">	

<title><?php if ( is_home() ) {   
            bloginfo('name');   
        } elseif ( is_category() ) {   
            single_cat_title(); echo " - "; bloginfo('name');   
        } elseif (is_single()) {   
            single_post_title();
			$cat_first=get_the_category($post->ID);
			echo "-";bloginfo('name');
        } elseif(is_page()){
		 single_post_title();
		 echo " - "; bloginfo('name'); 
		}elseif (is_search() ) {   
            echo "Search-".get_search_query(); 
			echo " - "; bloginfo('name');   
        } elseif (is_404() ) {   
            echo '页面未找到';   
        } else {   
            wp_title('',true);   
        } ?></title>

<?php
$option =get_option('viiqi_options');
if (is_home()) {

$keywords = $option["home_keyword"];
$description =$option["home_description"];
} else if (is_single()) {
$subject = mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 200,”……”);
$pattern = '/\n/';//去除换行
$description=preg_replace($pattern, '', $subject);
$keywords = get_the_title().",".$cat_first[0]->name;
} else if (is_category()) {
$description = category_description();
$keywords=get_cat_name($cat);
} 
?>
<meta name="keywords"  content="<?php echo $keywords?>"/>
<meta name="description"  content="<?php echo $description?>"/>
<?php wp_head(); ?>
<link rel="icon" href="<?php if($option["ico"]){echo $option["ico"];}else{echo get_bloginfo("template_url")."/images/ico.png";}?>" sizes="32x32" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/css.css">
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style.css">
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/swiper-3.4.2.min.css">

	<script src="<?php bloginfo('template_directory'); ?>/js/jquery-3.2.1.min.js" type="text/javascript" charset="utf-8"></script>

	<script src="<?php bloginfo('template_directory'); ?>/js/swiper-3.4.2.min.js"></script>

	<script src="<?php bloginfo('template_directory'); ?>/js/rem.js"></script>

	<script>

		window['adaptive'].desinWidth = 750;

		window['adaptive'].init();

	</script>
	
	
	

</head>



<body style="background-image:url(<?php bloginfo('template_directory'); ?>/images/list-bg1.png)">

	<div class="pc-box">

		<div class="topbox">

			<div class="wrap clearfix header-box relative">


<a href="<?php echo get_option('home'); ?>" class="logo">
<img src="<?php if($option["logo"]){echo $option["logo"];}else{echo get_bloginfo("template_url")."/images/logo.png";}?>" alt="<?php bloginfo('name'); ?>"></a>
<div class="lang fr relative">
<span class="lan-text">English</span>
<ul class="lan-lists">

						<li><a href="<?php echo get_option('home'); ?>">简体中文版</a></li>
						<li><a href="<?php echo get_option('home'); ?>?lang=zh-hant">繁体中文版</a></li>
						<li><a href="<?php echo get_option('home'); ?>?lang=en">English</a></li>
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

		<div class="list-banner">

			<h3><?php single_cat_title(); ?></h3>

			<p><?php
if(is_category()) {
$cat = get_query_var('cat');
$yourcat = get_category($cat);
echo  $yourcat->slug;
}
?></p>

		</div>

		<img src="<?php bloginfo('template_directory'); ?>/images/boder-bottom.png" alt="">

		<div class="wrap mianbao-nav">

<a href="<?php echo get_option('home'); ?>" >首页 /</a>
<a class="cuurent" href="<?php $category = get_the_category();if($category[0]){echo ''.get_category_link($category[0]->term_id ).'';}?>"><?php single_cat_title(); ?></a>

		</div>

		<div class="main wrap clearfix">

			<div class="list-left fl">

				<div class="title-box flex-wrap" style="padding-bottom:12px;">

					<span class="big-tit">最新文章</span>

					<div class="abox clearfix">

<?php
if(is_single()||is_category())
{
if(get_category_children(get_category_root_id(the_category_ID(false)))!= "" )
{
echo '';
echo wp_list_categories("child_of=".get_category_root_id(the_category_ID(false)). "&depth=0&hide_empty=0&title_li=0&orderby=id&order=ASC");
echo '';
}
}
?>	

					</div>

				</div>

				

				<ul class="clearfix news-lists">

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>">
<img src="<?php echo catch_first_image() ?>" alt="<?php the_title_attribute(); ?>">
									<div class="newsInfor">
<p class="p-tit" style="margin-bottom:3px;"><?php the_title_attribute(); ?></p>
<p class="m-subs" style="margin-bottom:20px;"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 70,"..."); ?></p>
										<div class="flex-wrap">
<span class="name"><?php foreach((get_the_category()) as $category){echo $category->cat_name;}?></span>
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
<?php endif; ?>


				</ul>

				<div class="pages">
					
					<?php pagenavi(); ?>


				</div>

			</div>

			<div class="list-right fr">

				<div class="search-box relativ clearfix">

							<form action="<?php echo get_option('home'); ?>" method="get">
							<input type="text" name="s" placeholder="搜索想要的...">
							<button></button>
							</form>

				</div>
				
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

	<div class="m-box">

		<div class="m-swiper swiper2">

			<div class="m-search-box">

<form action="<?php echo get_option('home'); ?>" method="get">
				<button class="button-search"></button>
<input type="text" name="s"   placeholder="请输入关键字搜索">
							</form>

			</div>

			<div class="swiper-wrapper">

                   <?php
                    $singleurl = get_permalink($post_id);
                    $cats = wp_get_post_categories($post->ID);
                    if ($cats) {
                    $args = array(
                    'category__in' => array( $cats[0] ),                    
                    'showposts' => 5,
                    'caller_get_posts' => 1
                    );
                    query_posts($args);
                    if (have_posts()) :
                    while (have_posts()) : the_post(); update_post_caches($posts); ?>

<div class="swiper-slide">
<a href="<?php the_permalink(); ?>">
<img src="<?php if (get_field('wapimg')) {echo ''.get_field('wapimg').'';}else { echo ''. get_bloginfo("template_url") .'/images/m-banner.jpg';}?>" alt="<?php the_title(); ?>">
						<div class="m-swiper-tilt flex-wrap">
							<span><?php the_title(); ?></span>
							<span id="m-year"> <strong><?php the_time('m'); ?></strong><span><?php the_time('d'); ?></span></span>
						</div>
						<div class="line-m"></div>
					</a>
				</div>
                  <?php endwhile; else : ?>

                   <?php endif; wp_reset_query(); } ?>				
				
				
			</div>
<div class="span2"></div>
		</div>

		<div class="m-section-1">

			<div class="m-title-box flex-wrap" style="margin-top:0;">

				<span class="m-name">一乘显密精选</span>

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

					<span class="m-name">相关栏目</span>

				</div>

				<div class="m-d-swiper">

					<div class="swiper-wrapper">
						
<?php
$categories=get_categories("child_of=".get_category_root_id(the_category_ID(false))."");
  foreach($categories as $category) {
if (function_exists('z_taxonomy_image_url'))
echo z_taxonomy_image_url();	
echo '<div class="swiper-slide">
<a href="'.get_category_link( $category->term_id ).'">
<div class="m-pic-bg">
<img src="'.z_taxonomy_image_url( $category->term_id ).'" alt="'.$category->name.'">
<div class="m-bg"></div>
<div class="swi-title">'.$category->name.'</div>
</div></a>
</div>';
 }
?>				

					</div>

				</div>

			</div>

		</div>

		<div class="m-section-3">

			<div class="m-wrap">

				<div class="m-title-box flex-wrap" style="margin-top:0;">

					<span class="m-name"><?php single_cat_title(); ?></span>

				</div>

				<ul class="m-news-list">

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<li>
					<a href="<?php the_permalink() ?>">
						<div class="img-M-BOX">
								<div class="m-bg"></div>
							<img src="<?php echo catch_first_image() ?>" alt="">
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
<?php endif; wp_reset_query();?>				
					

				</ul>
				
<div class="pages">
							
<?php pagenavi(); ?>

</div>

			</div>

		</div>

		

	</div>

	<div class="m-sub-menu hidden">

		<span class="close" onclick="hideSubnav();"></span>

		<div class="m-menu-top"> 

			<a href="<?php  
$page_id = 1169;  
$page_data = get_page( $page_id );  
echo $page_data->guid;      // 调用页面标题  
?>" class="flex m-item">

				<img src="<?php bloginfo('template_directory'); ?>/images/a1.png" alt="" class="a1">

				<span><?php  
$page_id = 1169;  
$page_data = get_page( $page_id );  
echo $page_data->post_title;      // 调用页面标题  
?></span>

			</a>

			<a href="<?php echo get_category_link( 157 );?>" class="flex m-item">

				<img src="<?php bloginfo('template_directory'); ?>/images/a2.png" alt="" class="a2">

				<span><?php echo get_cat_name( 157 ); ?></span>

			</a>

			<a href="<?php  
$page_id = 1173;  
$page_data = get_page( $page_id );  
echo $page_data->guid;      // 调用页面标题  
?>" class="flex m-item">

				<img src="<?php bloginfo('template_directory'); ?>/images/a3.png" alt="" class="a3">

				<span><?php  
$page_id = 1173;  
$page_data = get_page( $page_id );  
echo $page_data->post_title;      // 调用页面标题  
?></span>

			</a>

			<a href="<?php  
$page_id = 2;  
$page_data = get_page( $page_id );  
echo $page_data->guid;      // 调用页面标题  
?>" class="flex m-item">

				<img src="<?php bloginfo('template_directory'); ?>/images/a4.png" alt="" class="a4">

				<span><?php  
$page_id = 2;  
$page_data = get_page( $page_id );  
echo $page_data->post_title;      // 调用页面标题  
?></span>

			</a>

			<a href="<?php  
$page_id = 19;  
$page_data = get_page( $page_id );  
echo $page_data->guid;      // 调用页面标题  
?>" class="flex m-item">

				<img src="<?php bloginfo('template_directory'); ?>/images/a5.png" alt="" class="a5">

				<span><?php  
$page_id = 19;  
$page_data = get_page( $page_id );  
echo $page_data->post_title;      // 调用页面标题  
?></span>

			</a>

		</div>

		
		<div class="m-lan-box">

			<a href="<?php echo get_option('home'); ?>" class="flex m-item">

				<img src="<?php bloginfo('template_directory'); ?>/images/a7.png" alt="" class="a6">

				<span>简体中文版</span>

			</a>

			<a href="<?php echo get_option('home'); ?>?lang=zh-hant" class="flex m-item">

				<img src="<?php bloginfo('template_directory'); ?>/images/a8.png" alt="" class="a7">

				<span>繁体中文版</span>

			</a>

			<a href="<?php echo get_option('home'); ?>?lang=en" class="flex m-item">

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

	var swiper1=new Swiper('.swiper',{

		pagination:'.span',

		paginationClickable:true,

		autoplay:'2500',

		prevButton:".prev-btn",

		nextButton:".next-btn"

	})



	var swiper2=new Swiper('.swiper2',{

		pagination:'.span2',

		paginationClickable:true,

		prevButton:".left-btns",

		nextButton:".right-btns"

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