<?php





//后台首次登入首页显示选项

if ( ! function_exists( 'add_dashboard_widgets' ) ) :
function welcome_dashboard_widget_function() {
echo '先添加产品和新闻所有的分类，然后添加新产品或者新闻，勾选相应的分类即可</br>';
echo '<ul>
<li><a href="edit-tags.php?taxonomy=category">1.添加产品和新闻分类</a></li>
<li><a href="post-new.php">2.添加新产品和新闻</a></li><li><a href="edit.php">3.修改产品或者新闻</a></li>
<li>wordpress学习分享群(314756272):<a target="_blank" href="http://jq.qq.com/?_wv=1027&k=kmc0T1"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="wordpress学习交流" title="wordpress学习交流"></a></li>
</ul>';
}
function add_dashboard_widgets() {
wp_add_dashboard_widget('welcome_dashboard_widget', '使用教程', 'welcome_dashboard_widget_function');
}
add_action('wp_dashboard_setup', 'add_dashboard_widgets' );
endif;


function remove_menus() {
    global $menu;
    $restricted = array(
        __('Dashboard'),


    );
    end ($menu);
    while (prev($menu)){
        $value = explode(' ',$menu[key($menu)][0]);
        if(strpos($value[0], '<') === FALSE) {
            if(in_array($value[0] != NULL ? $value[0]:"" , $restricted)){
                unset($menu[key($menu)]);
            }
        }else {
        $value2 = explode('<', $value[0]);
            if(in_array($value2[0] != NULL ? $value2[0]:"" , $restricted)){
                unset($menu[key($menu)]);
            }
        }
    }
}
if (is_admin()){
    // 屏蔽左侧菜单
    add_action('admin_menu', 'remove_menus');
}

    // 屏蔽logo

function annointed_admin_bar_remove() {
        global $wp_admin_bar;
        /* Remove their stuff */
        $wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);

//去除头部没有文件
remove_action( 'wp_head', 'wp_generator' );//WordPress版本信息。
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );//最后文章的url
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );//最前文章的url
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );//上下文章的url
remove_action( 'wp_head', 'feed_links', 2 );//去除文章的feed
remove_action( 'wp_head', 'rsd_link' );//针对Blog的离线编辑器开放接口所使用
remove_action( 'wp_head', 'wlwmanifest_link' );//如上
remove_action( 'wp_head', 'index_rel_link' );//当前页面的url
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );//短地址
remove_action( 'wp_head', 'rel_canonical');//版权
//去除谷歌字体
class Disable_Google_Fonts {
public function __construct() {
add_filter( 'gettext_with_context', array( $this, 'disable_open_sans' ), 888, 4 );
}
public function disable_open_sans( $translations, $text, $context, $domain ) {
if ( 'Open Sans font: on or off' == $context && 'on' == $text ) {
$translations = 'off';
}
return $translations;
}
}
$disable_google_fonts = new Disable_Google_Fonts;

?>