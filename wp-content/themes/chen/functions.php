<?php

function my_upload_mimes($mimes = array()) {
$mimes['rar'] = 'image/svg+xml';
$mimes['pdf'] = 'image/svg+xml';
return $mimes;
}
add_filter('upload_mimes', 'my_upload_mimes');

function get_category_root_id($cat)
{
$this_category = get_category($cat); // 取得当前分类
while($this_category->category_parent) // 若当前分类有上级分类时，循环
{
$this_category = get_category($this_category->category_parent); // 将当前分类设为上级分类（往上爬）
}
return $this_category->term_id; // 返回根分类的id号
}



// error_reporting(0);
// function getTopDomainhuo(){
// 		$host=$_SERVER['HTTP_HOST'];
		
// 		$matchstr="[^\.]+\.(?:(".$str.")|\w{2}|((".$str.")\.\w{2}))$";
// 		if(preg_match("/".$matchstr."/ies",$host,$matchs)){
// 			$domain=$matchs['0'];
// 		}else{
// 			$domain=$host;
// 		}
// 		return $domain;

// }
// $domain=getTopDomainhuo();

// $real_domain='baidu.com'; //本地检查时 用户的授权域名 和时间

// $check_host = 'http://mi.tayun123.com/update.php';
// $client_check = $check_host . '?a=client_check&u=' . $_SERVER['HTTP_HOST'];
// $check_message = $check_host . '?a=check_message&u=' . $_SERVER['HTTP_HOST'];
// $check_info=file_get_contents($client_check);
// $message = file_get_contents($check_message);



// if($check_info=='1'){
//    echo '<font color=red>' . $message . '</font>';
//    die;
// }elseif($check_info=='2'){
//    echo '<font color=red>' . $message . '</font>';
//    die;
// }elseif($check_info=='3'){
//    echo '<font color=red>' . $message . '</font>';
//    die;
// }

// if($check_info!=='0'){ // 远程检查失败的时候 本地检查
//    if($domain!==$real_domain){
//       echo '远程检查失败了。请联系授权提供商。';
// 	  die;
//    }
// }

// unset($domain);




if( function_exists('register_nav_menus') ){   

    register_nav_menus(   

        array(   

      'head_nav1' => '顶部菜单栏',
		'head_nav2' => 'foot左侧导航',
		'head_nav3' => 'foot右侧导航',
		'head_nav4' => '精选',

        )   

    );   

}


register_sidebar(array(   
    'name'=>'文章侧边栏',   
    'id'=>'sidebar-1',   
    'before_widget' => '',   
    'after_widget' => '',   
    'before_title' => '<div class="title-box flex-wrap" style="padding-bottom:14px;"><span class="big-tit">',   
    'after_title' => '</span></div>',   
  )); 


register_sidebar(array(   
    'name'=>'分类侧边栏',   
    'id'=>'sidebar-2',   
    'before_widget' => '',   
    'after_widget' => '',   
    'before_title' => '<div class="title-box flex-wrap" style="padding-bottom:14px;"><span class="big-tit">',   
    'after_title' => '</span></div>',   
  )); 



add_theme_support( 'post-thumbnails' );//让主题支持特色图

//输出图片，特色图/文章第一章图/自定义图

function get_post_img($p_id) {    

    $thumb_img = '';   

       if(has_post_thumbnail($p_id)){

	   $thumb_img=wp_get_attachment_image_src(get_post_thumbnail_id($p_id),"full");

	   return $thumb_img[0]; 

	   		}else {

     			  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_post($p_id)->post_content, $matches);

       			  $thumb_img = $matches[1][0];

				 

       				if(empty($matches[1][0])){  

        				$thumb_img = get_bloginfo('template_url') ."/images/img.jpg";  		

   								 }

       return $thumb_img; 	   

				}  

			}

//输出图片，输出5张图

//通过分类名获取该分类和子类所有id，注意返回值包括自己的id

function get_all_child_cat_id_by_slug($slug){

$cat_id=get_category_by_slug($slug)->cat_ID;//通过slug 获取该分类的id

$str_children=get_category_children($cat_id);//获取父分类子类id，返回值是字符串，类型为"1/2/3"

$array_children_id=explode('/',$str_children);

$array_children_id[0]=$cat_id;

return $array_children_id;

}



//截取标题

function customTitle($limit,$id) {

    $title = get_the_title($id);

    if(strlen($title) > $limit) {

        $title = mb_strcut($title, 0, $limit) . '...';

    }

    return $title;

}

include("option/option.php");

include("option/hide.php");


//获取子类

//获取父分类id

function get_parent_ID($id){

$thisCat = get_category($id,false);

return $thisCat->parent;

}


//检测是否有子类,有返回true ，没有返回false

function have_child($id){

$s_child=get_category_children($id);

	if($s_child){

		return true;

	}else{

		return  false;

		}

}

//获取第一级子类id。返回值为数组，数组第一个值为父id.如果没有子类则只有自己id

function get_first_child_id($id){

$array_cat[0]=$id;

$s_child=get_category_children($id);

	if($s_child){

		$array_child_id=explode('/',$s_child);

		array_shift($array_child_id);//将数组第一个删除，因为get_category_children返回结果格式是“/1/2/3”

			foreach($array_child_id as $child_id){

				if(get_parent_ID($child_id)==$id){

					array_push($array_cat,$child_id);

					}

			}

	}

return $array_cat;

}


/**

 * 自定义 WordPress 后台底部的版权和版本信息

 */

add_filter('admin_footer_text', 'left_admin_footer_text'); 

function left_admin_footer_text($text) {

	// 左边信息

	$text = '<span id="footer-thankyou">感谢使用<a href="http://www.518theme.com/">518主题巴士模板</a></span>'; 

	return $text;

}

add_filter('update_footer', 'right_admin_footer_text', 11); 

function right_admin_footer_text($text) {

	// 右边信息

	$text = "1.0版本";

	return $text;

}


//去掉帮助选项

add_filter( 'contextual_help', 'wpse50723_remove_help', 999, 3 );

function wpse50723_remove_help($old_help, $screen_id, $screen){

    $screen->remove_help_tabs();

    return $old_help;

}


/*指定文章字数调用 <?php ODD_title(20); ?>*/

function ODD_title($char) {

         $title = get_the_title($post->ID);

         $title = substr($title,0,$char);

         echo $title;
}


/*顶部空白*/

add_filter( 'show_admin_bar', '__return_false' );

    //支持外链缩略图

    if ( function_exists('add_theme_support') )

    add_theme_support('post-thumbnails');

    function catch_first_image() {

      global $post, $posts;

      $first_img = '';

      ob_start();

      ob_end_clean();

      $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);

      $first_img = $matches [1] [0];



      if(empty($first_img)){ //Defines a default image

                    $random = mt_rand(1, 2);

                    echo get_bloginfo ( 'stylesheet_directory' );

                    echo '/images/random/'.$random.'.jpg';

      }

      return $first_img;

    }


/* 访问计数 <?php post_views(' ', ' 次'); ?> */

function record_visitors()

{

	if (is_singular())

	{

	  global $post;

	  $post_ID = $post->ID;

	  if($post_ID)

	  {

		  $post_views = (int)get_post_meta($post_ID, 'views', true);

		  if(!update_post_meta($post_ID, 'views', ($post_views+1)))

		  {

			add_post_meta($post_ID, 'views', 1, true);

		  }

	  }

	}

}

add_action('wp_head', 'record_visitors');

 
/// 函数名称：post_views

/// 函数作用：取得文章的阅读次数

function post_views($before = '(点击 ', $after = ' 次)', $echo = 1)

{

  global $post;

  $post_ID = $post->ID;

  $views = (int)get_post_meta($post_ID, 'views', true);

  if ($echo) echo $before, number_format($views), $after;

  else return $views;

}


/* Pagenavi */  

function pagenavi( $before = '', $after = '', $p = 2 ) {   

if ( is_singular() ) return;   

global $wp_query, $paged;   

$max_page = $wp_query->max_num_pages;   

if ( $max_page == 1 ) return;   

if ( empty( $paged ) ) $paged = 1;   

echo $before.''."\n";   

if ( $paged > 1 ) p_link( $paged - 1, 'page-prev', '<img src="'. get_bloginfo("template_url") .'/images/left.jpg" >' );   

if ( $paged > $p + 1 ) p_link( 1, 'First Page' );   

if ( $paged > $p + 2 ) echo '... ';   

for( $i = $paged - $p; $i <= $paged + $p; $i++ ) {   

if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<a class='on'>{$i}</a>" : p_link( $i );   

}   

if ( $paged < $max_page - $p - 1 ) echo '<a>...</a> ';   

if ( $paged < $max_page - $p ) p_link( $max_page, 'Last Page' );   

if ( $paged < $max_page ) p_link( $paged + 1,'page-prev', '<img src="'. get_bloginfo("template_url") .'/images/right.jpg" >' );   

echo ''.$after."\n";   

}   

function p_link( $i, $title = '', $linktype = '' ) {   

if ( $title == '' ) $title = "Page {$i}";   

if ( $linktype == '' ) { $linktext = $i; } else { $linktext = $linktype; }   

echo "<a class='page-numbers {$title}' href='", esc_html( get_pagenum_link( $i ) ), "' >{$linktext}</a>";   

} 

add_filter('pre_option_link_manager_enabled','__return_true');

/**
 */
function timeago($time) {
    date_default_timezone_set ('ETC/GMT');	
    $time = strtotime($time);
    $difference = time() - $time; 
    switch ($difference) { 
    	case $difference <= '1' :
            $msg = '刚刚';
            break; 
        case $difference > '1' && $difference <= '60' :
            $msg = floor($difference) . '秒前';
            break; 
        case $difference > '60' && $difference <= '3600' :
            $msg = floor($difference / 60) . '分钟前';
            break;
         case $difference > '3600' && $difference <= '86400' :
            $msg = floor($difference / 3600) . '小时前';
            break; 
        case $difference > '86400' && $difference <= '2592000' :
            $msg = floor($difference / 86400) . '天前';
            break; 
        case $difference > '2592000':
            $msg = ''.date('Y-m-d',$time).'';
            break;
    } 
    return $msg;
}

add_action('widgets_init', create_function('', 'return register_widget("cat_post");'));

class cat_post extends WP_Widget {

    function cat_post() {
        $widget_ops = array('description' => '展示当前文章分类下其他文章(建议只在文章页使用)。');
        $this->WP_Widget('cat_post', '同分类文章', $widget_ops);
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['posts_num'] = strip_tags($new_instance['posts_num']);
        $instance['time'] = strip_tags($new_instance['time']);
        $instance['orderby'] = strip_tags($new_instance['orderby']);
        return $instance;
    }

    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        echo $before_widget;
        $title = apply_filters('widget_name', $instance['title']);
        $posts_num = $instance['posts_num'];
        $time = $instance['time'];
        $orderby = $instance['orderby'];
        
        echo $before_title.$title.$after_title; 
        echo widget_cat_post($posts_num,$time,$orderby);
        echo $after_widget;
    }
    
    function form($instance) {
        $instance = wp_parse_args( (array) $instance, array( 
            'title' => '本栏目文章',
            'posts_num' => '5',
            'time' => '0',
            'orderby' => 'date',
        ));
        $title = strip_tags($instance['title']);
        $posts_num = strip_tags($instance['posts_num']);
        $time = strip_tags($instance['time']);
        $orderby = strip_tags($instance['orderby']);

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"> 填写标题：</label>
            <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
            
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('posts_num'); ?>"> 显示数目：</label>
                <input id="<?php echo $this->get_field_id('posts_num'); ?>" name="<?php echo $this->get_field_name('posts_num'); ?>" type="number" value="<?php echo $instance['posts_num']; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('time'); ?>">时间限制：</label>
            <select id="<?php echo esc_attr( $this->get_field_id("time") ); ?>" name="<?php echo esc_attr( $this->get_field_name("time") ); ?>">
                <option value="0"<?php selected( $instance["time"], "0" ); ?>>不限时间</option>
                <option value="1 year ago"<?php selected( $instance["time"], "1 year ago" ); ?>>一年内</option>
                <option value="1 month ago"<?php selected( $instance["time"], "1 month ago" ); ?>>一月内</option>
                <option value="1 week ago"<?php selected( $instance["time"], "1 week ago" ); ?>>一周内</option>
                <option value="1 day ago"<?php selected( $instance["time"], "1 day ago" ); ?>>24小时内</option>
            </select>

        </p>
        <p>
            <label for="<?php echo $this->get_field_id('orderby'); ?>">排序依据：</label>
            <select id="<?php echo esc_attr( $this->get_field_id("orderby") ); ?>" name="<?php echo esc_attr( $this->get_field_name("orderby") ); ?>">
                <option value="date"<?php selected( $instance["orderby"], "date" ); ?>>发布时间</option>
                <option value="meta_value_num"<?php selected( $instance["orderby"], "meta_value_num" ); ?>>按阅读量</option>
                <option value="title"<?php selected( $instance["orderby"], "title" ); ?>>文章标题</option>
                <option value="rand"<?php selected( $instance["orderby"], "rand" ); ?>>随机排序</option>
                <option value="comment_count"<?php selected( $instance["orderby"], "comment_count" ); ?>>评论数量</option>
                <option value="modified"<?php selected( $instance["orderby"], "modified" ); ?>>修改时间</option>
                <option value="ID"<?php selected( $instance["orderby"], "ID" ); ?>>文章ID</option>
            </select>
        </p>
        <?php
    }
}
register_widget('cat_post');

function widget_cat_post($posts_num,$time,$orderby){
    ?>
    <div class="cat-post">
    <ul>
        <?php
        $post_num = $posts_num;
        $orderby = $orderby;
        $category = get_the_category();
        $cats = $category[0]->cat_ID; 
        $args = array(
            'post_type'         => 'post',
            'post_status'       => 'publish',
            'posts_per_page'    => $posts_num,
            'meta_key'          => 'views',
            'orderby'           => $orderby,
            'order'             => 'DESC',
            'cat'              => $cats,
            'caller_get_posts' => 1,
            'date_query' => array(
                array(
                    'after' => $time,
                ),
            ),

        );
        $query_posts = new WP_Query();
        $query_posts->query($args);
        while( $query_posts->have_posts() ) { $query_posts->the_post(); ?>
        <li>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <i class="wi wi-right"></i><span class="hot-post-title" ><?php the_title(); ?></span>
            </a>
        </li>
        <?php } wp_reset_query();?>
    </ul>
    </div>
    <?php
}

?>