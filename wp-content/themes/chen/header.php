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

<body>

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
		