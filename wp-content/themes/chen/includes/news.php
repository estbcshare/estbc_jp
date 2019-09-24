<?php

	/*	
	*	Goodlayers news Option File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Goodlayers
	* 	@link		http://goodlayers.com
	* 	@copyright	Copyright (c) Goodlayers
	*	---------------------------------------------------------------------
	*	This file create and contains the news post_type meta elements
	*	---------------------------------------------------------------------
	*/
	
	add_action( 'init', 'create_news' );
	function create_news() {
		$news_translation = get_option(THEME_SHORT_NAME.'_gdl_news_slug','news');
		
		$labels = array(
			'name' => _x('新闻', 'news General Name', 'gdl_back_office'),
			'singular_name' => _x('news Item', 'news Singular Name', 'gdl_back_office'),
			'add_new' => _x('添加新闻', 'Add New news Name', 'gdl_back_office'),
			'add_new_item' => __('Add New news', 'gdl_back_office'),
			'edit_item' => __('Edit news', 'gdl_back_office'),
			'new_item' => __('New news', 'gdl_back_office'),
			'view_item' => __('View news', 'gdl_back_office'),
			'search_items' => __('Search news', 'gdl_back_office'),
			'not_found' =>  __('Nothing found', 'gdl_back_office'),
			'not_found_in_trash' => __('Nothing found in Trash', 'gdl_back_office'),
			'parent_item_colon' => ''
		);
		
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			//'menu_icon' => GOODLAYERS_PATH . '/include/images/news-icon.png',
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => 5,
			'supports' => array('title','editor','author','thumbnail','excerpt','comments','custom-fields'),
			'rewrite' => array('slug' => $news_translation, 'with_front' => false)
		  ); 
		  
		register_post_type( 'news' , $args);
		
		register_taxonomy(
			"news-category", array("news"), array(
				"hierarchical" => true,
				"label" => "新闻分类", 
				"singular_label" => "news Categories", 
				"rewrite" => true));
		register_taxonomy_for_object_type('news-category', 'news');
		
		register_taxonomy(
			"news-tag", array("news"), array(
				"hierarchical" => false, 
				"label" => "新闻标签", 
				"singular_label" => "news Tag", 
				"rewrite" => true));
		register_taxonomy_for_object_type('news-tag', 'news');
		
	}
	
	// filter for news first page
	add_filter("manage_edit-news_columns", "show_news_column");	
	function show_news_column($columns){
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => "Title",
			"author" => "Author",
			"news-tags" => "news Tags",
			"news-category" => "news Categories",
			"date" => "date");
		return $columns;
	}
	add_action("manage_posts_custom_column","news_custom_columns");
	function news_custom_columns($column){
		global $post;

		switch ($column) {
			case "news-tags":
			echo get_the_term_list($post->ID, 'news-tag', '', ', ','');
			break;
			
			case "news-category":
			echo get_the_term_list($post->ID, 'news-category', '', ', ','');
			break;
		}
	}	
	
	// add news tag to tag cloud	
	//function custom_tag_cloud_widget($args) {
	//	$args['taxonomy'] = array('post_tag', 'news-tag');
	//	return $args;
	//}
	//add_filter( 'widget_tag_cloud_args', 'custom_tag_cloud_widget' );	
	
	// starting to edit news 
	$news_meta_boxes = array(	
		
		// general options
		"Sidebar Template" => array(
			'title'=> __('SIDEBAR TEMPLATE', 'gdl_back_office'), 
			'name'=>'post-option-sidebar-template', 
			'type'=>'radioimage', 
			'default'=>'no-sidebar',
			'hr'=>'none',
			'options'=>array(
				'1'=>array('value'=>'right-sidebar','default'=>'selected','image'=>'/include/images/right-sidebar.png'),
				'2'=>array('value'=>'left-sidebar','image'=>'/include/images/left-sidebar.png'),
				'3'=>array('value'=>'both-sidebar','image'=>'/include/images/both-sidebar.png'),
				'4'=>array('value'=>'no-sidebar','image'=>'/include/images/no-sidebar.png'))),
	
		"Choose Left Sidebar" => array(
			'title'=> __('CHOOSE LEFT SIDEBAR', 'gdl_back_office'),
			'name'=>'post-option-choose-left-sidebar',
			'type'=>'combobox',
			'hr'=>'none'
		),		
		
		"Choose Right Sidebar" => array(
			'title'=> __('CHOOSE RIGHT SIDEBAR', 'gdl_back_office'),
			'name'=>'post-option-choose-right-sidebar',
			'type'=>'combobox',
		),

		"Post Caption" => array(
			'title'=> __('POST CAPTION', 'gdl_back_office'),
			'name'=>'post-option-caption',
			'type'=>'textarea'
		),		
		
		"Clients Name" => array(
			'title'=> __('CLIENTS NAME', 'gdl_back_office'),
			'name'=>'post-option-clients-name',
			'type'=>'inputtext',
			'description'=>'Clients name is at the left side of news page. Leave it blank if you want to hide it.'),		
		
		"Website Url" => array(
			'title'=> __('WEBSITE URL', 'gdl_back_office'),
			'name'=>'post-option-website-url',
			'type'=>'inputtext',
			'description'=>'A website to actual news url. It is also at the left side of news page. You can also have a link to website button at the news thumbnail of page item.'),

		"Author Infomation" => array(
			'title'=> __('SHOW AUTHOR INFORMATION', 'gdl_back_office'),
			'name'=>'post-option-author-info-enabled',
			'type'=>'combobox', 
			'options'=>array('0'=>'Yes','1'=>'No'),
			'description'=>'Show the author information in the blog page'),			
			
		"Social Sharing" => array(
			'title'=> __('SOCIAL NETWORK SHARING', 'gdl_back_office'),
			'name'=>'post-option-social-enabled',
			'type'=>'combobox', 
			'default'=>'No',
			'options'=>array('0'=>'Yes','1'=>'No'),
			'description'=>'Show the social network sharing in the blog page.'),
		
			
		// thumbnail
		"Thumbnail Types" => array(
			'title'=> __('THUMBNAIL TYPES', 'gdl_back_office'),
			'name'=>'post-option-thumbnail-types',
			'options'=>array(
				'0'=>'Image',
				'1'=>'Video',
				'2'=>'Slider'),
			'type'=>'combobox',
			'hr'=>'none',
			'description'=>'This is the thumbnail of the news when using the news item in page options.'),
			
		// image thumbnail
		"Open Thumbnail Image" => array('type'=>'open','id'=>'thumbnail-feature-image'),
			
		"Thumbnail Image Type" => array(
			'title'=> __('USE FEATURED IMAGE AS', 'gdl_back_office'),
			'name'=>'post-option-featured-image-type',
			'type'=>'combobox',
			'hr'=>'none',
			'options'=>array(
				'0'=>'Link to Current Post', 
				'1'=>'Link to URL',
				'2'=>'Lightbox to Current Thumbnail', 
				'3'=>'Lightbox to Picture',
				'4'=>'Lightbox to Video',)
			),
			
		"Thumbnail Image URL" => array(
			'title'=> __('SPECIFIC URL', 'gdl_back_office'),
			'name'=>'post-option-featured-image-url',
			'type'=>'inputtext',
			),		
			
		"Close Thumbnail Image" => array('type'=>'close'),
		
		// video thumbnail
		"Open Thumbnail Video" => array('type'=>'open','id'=>'thumbnail-video'),
		
		"Thumbnail Video Url" => array(
			'title'=> __('VIDEO URL', 'gdl_back_office'),
			'name'=>'post-option-thumbnail-video',
			'type'=>'inputtext',
			'description'=>'Place the url of video you want here. This theme only supports video from Youtube and Vimeo.'),
		
		"Close Thumbnail Video" => array('type'=>'close'),
		
		// slider thumbnail
		"Open Thumbnail Slider" => array('type'=>'open','id'=>'thumbnail-slider'),
		
		"Thumbnail Slider" => array(
			'type'=> 'imagepicker',
			'title'=> __('SELECT IMAGES', 'gdl_back_office'),
			'xml'=>'post-option-thumbnail-xml',
			'name'=>array(
				'image'=>'post-option-thumbnail-slider-image',
				'title'=>'post-option-thumbnail-slider-title',
				'caption'=>'post-option-thumbnail-slider-caption',
				'link'=>'post-option-thumbnail-slider-link',
				'linktype'=>'post-option-thumbnail-slider-linktype'),
			'hr'=>'none'
		),
		
		"Close Thumbnail Slider" => array('type'=>'close'),
		
		// inside post thumbnails
		"Inside Thumbnail Types" => array(
			'title'=> __('INSIDE POST THUMBNAIL TYPES', 'gdl_back_office'),
			'name'=>'post-option-inside-thumbnail-types',
			'options'=>array(
				'0'=>'Image',
				'1'=>'Video',
				'2'=>'Slider'),
			'type'=>'combobox',
			'hr'=>'none',
			'description'=>'This is the thumbnail inside news post.'),
		
		// inside post thumbnail image
		"Open Inside Thumbnail Image" => array('type'=>'open','id'=>'inside-thumbnail-image'),
			
		"Inside Thumbnail Image" => array(
			'title'=> __('SELECT IMAGE', 'gdl_back_office'),
			'name'=>'post-option-inside-thumbnial-image',
			'type'=>'upload',
			'hr'=>'none'),
			
		"Close Inside Thumbnail Image" => array('type'=>'close'),
		
		// inside post thumbnail video
		"Open Inside Thumbnail Video" => array('type'=>'open','id'=>'inside-thumbnail-video'),
		
		"Inside Thumbnail Video Url" => array(
			'title'=> __('VIDEO URL', 'gdl_back_office'),
			'name'=>'post-option-inside-thumbnail-video',
			'type'=>'inputtext',
			'hr'=>'none',
			'description'=>'Place the url of video you want here. This theme only supports video from Youtube and Vimeo.'),
		
		"Close Inside Thumbnail Video" => array('type'=>'close'),
		
		// inside post thumbnail slider
		"Open Inside Thumbnail Slider" => array('type'=>'open','id'=>'inside-thumbnail-slider'),
		
		"Inside Thumbnail Slider" => array(
			'type'=>'imagepicker',
			'title'=> __('SELECT IMAGES', 'gdl_back_office'),
			'xml'=>'post-option-inside-thumbnail-xml',
			'name'=>array(
				'image'=>'post-option-inside-thumbnail-slider-image',
				'title'=>'post-option-inside-thumbnail-slider-title',
				'caption'=>'post-option-inside-thumbnail-slider-caption',
				'link'=>'post-option-inside-thumbnail-slider-link',
				'linktype'=>'post-option-inside-thumbnail-slider-linktype'),
			'hr'=>'none'
		),
		
		"Close Inside Thumbnail Slider" => array('type'=>'close'),
	);
	



?>