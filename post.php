<?php
/*

     WordPress免登录发布接口,支持最新Wordpress4.24版本。最新验证支持Wordpress4.24
     最后更新2015-08-18
     适用于火车头采集器等任意采集器或脚本程序进行日志发布。


 ■ 功能特性：

     1. 随机时间安排与预约发布功能： 可以设定发布时间以及启用预约发布功能
     2. 自动处理服务器时间与博客时间的时区差异
     xxxxxx3. 永久链接的自动翻译设置。根据标题自动翻译为英文并进行seo处理xxxxxxx
     5. 多标签处理(多个标签可以用火车头默认的tag|||tag2|||tag3的形式)
     6. 增加了发文后ping功能
     7. 增加了“pending review”的设置
     8. 增加了多作者功能，发布参数中指定post_author
     9. 增加了自定义域功能，发布参数指定post_meta_list=key1$$value1|||key2$$value2，不同域之间用|||隔开，名称与内容之间用$$隔开。
     10. 增加自动增加分类功能，如果网站内没有这个分类，会自动增加分类。
     -----------以下是20150715版本更新内容----------
     11. 增加上传图片功能，根据主题或网站后台设置自动生成缩略图，并自动设置第一张图片为文章的特色图片。
     12. 增加支持单篇文章多个栏目分类和tag   ，多个栏目之间请用英文逗号分开，设置分类时可以是分类名和分类ID，也可以混合写 如： 分类一,4,二分类,6  (注意是半角的逗号分开)。
     13. 增加多作者功能，可设置多个作者随机发布文章。
     -----------以下是20150813版本更新内容----------
     14. 修复发布时间为空的BUG，需要按采集的时间发布，请在发布参数中指定post_date，正确的时间格式为2015-08-12 23:45:55或者2015-08-12 23:45
     15. 增加随机文章阅读数功能，可定义固定值或随机值范围。
     16. 由于谷歌被墙，故删除原有永久链接自动翻译功能，改为永久链接自动判断是否为中文并自动转换成MD5值，可设置字符串长度。
     -----------以下是20150818版本更新内容----------
     17. 修正预约发布的BUG，如果POST过来的数据包涵时间，则以时间为准立即发布，反之则以接口文件配置时间发布。即可使用预约发布，保存为草稿等功能。
     18. 增加自定义作者功能，如果提交的数据为用户名的话，会自动检测系统是否存在该用户，如果已存在则以该用户发布，不存在则自动新建用户（接口以针对中文用户名进行了处理）。

   ■ 使用说明:（按照需求修改配置参数,添加配置时请注意添加引号）
     $post_author_default    = 1;    	  //默认作者的id，默认为admin（这里是作者ID号码，并非作者名）
     $post_status    = "publish"; //"future"：保存为草稿,"publish"：立即发布,"pending"：待审核
     $time_interval  = 60;        //发布时间间隔，单位为秒 。可设置随机数值表达式，如12345 * rand(0,17)，设置为负数可将发布时间设置为当前时间减去这里设置的时间
     $post_next      = "next"; //now:发布时间=当前时间+间隔时间值
                               //next: 发布时间=最后一篇时间+间隔时间值
     $post_ping      = false;  //发布后是否执行ping
     $translate_slug = false;  //是否将中文标题转换为MD5值，如需开启请设置为true或MD5值长度，建议设置为大于10，小于33的数字。
     $secretWord     = '123456';  //接口密码，如果不需要密码，则设为$secretWord=false ;
     $post_category  = '';     //分类，默认为系统获取的分类ID，如果提交的数据是分类名称的话，会自动检测系统是否存在同名的分类，否则将新建一个分类，并将文章发布到新建分类里。
     $pViews				 = false;	 //文章已阅读数，默认关闭，可设置随机数值表达式，如rand(100,200)，也可以设置固定值。
     关于发布时间优先级的说明：如果采集以采集到的时间作为发布时间，则本文件内的关于时间的设置无效，反之则以本文件内的相关时间配置来决定发布时间。

*/

//-------------------配置参数开始，根据需要修改-------------------------
$post_author_default    = 1;
$post_status    = "publish";
$time_interval  = 1;
$post_next      = "now";
$post_ping      = false;
$translate_slug = false;
$secretWord     = 'feihuan518';
$pViews					=	false;

//-------------------配置参数结束，以下请勿修改-------------------------
if (isset($_GET['action']))
{
  $hm_action=$_GET['action'];
} else
{
  die ("操作被禁止>");
}

$post=$_POST;
@$tax_input = $_POST[tax_input];
include "./wp-config.php";
if ( get_magic_quotes_gpc() )
{
  $post = array_map('stripslashes_deep', $_POST );
}

if ($post_ping) require_once("./wp-includes/comment.php");

if ( !class_exists("Snoopy") )	require_once ("./wp-includes/class-snoopy.php");
function hm_debug_info($msg)
{
  global $logDebugInfo;
  if ($logDebugInfo) echo $msg."<br/>\n";
}

function hm_tranlate($text)
{
  global $translate_slug;
  $pattern = '/[^\x00-\x80]/';
  if (preg_match($pattern,$text)) {
    $htmlret = substr(md5($text),0,$translate_slug);
  } else {
    $htmlret =  $text;
  }
  return $htmlret;
}

function hm_print_catogary_list()
{
  $cats = get_categories("hierarchical=0&hide_empty=0");
  foreach ((array) $cats as $cat) {
    echo '<<<'.$cat->cat_ID.'--'.$cat->cat_name.'>>>';
  }
}

function hm_get_post_time($post_next="normal")
{
  global $time_interval;
  global $wpdb;

  $time_difference = absint(get_option('gmt_offset')) * 3600;
  $tm_now = time()+$time_difference;

  if ($post_next=='now') {
    $tm=time()+$time_difference;
  } else { //if ($post_next=='next')
    $tm = time()+$time_difference;
    $posts = $wpdb->get_results( "SELECT post_date FROM $wpdb->posts ORDER BY post_date DESC limit 0,1" );
    foreach ( $posts as $post ) {
      $tm=strtotime($post->post_date);
    }
  }
  return $tm+$time_interval;
}

function hm_publish_pending_post()
{
  global $wpdb;
  $tm_now = time()+absint(get_option('gmt_offset')) * 3600;
  $now_date=date("Y-m-d H:i:s",$tm_now);
  $wpdb->get_results( "UPDATE $wpdb->posts set `post_status`='publish' WHERE `post_status`='pending' and `post_date`<'$now_date'" );
}

function hm_add_category($post_category)
{
  if (!function_exists('wp_insert_category')) @include "./wp-admin/includes/taxonomy.php";
  global $wpdb;
  $post_category_new=array();
  $post_category_list= array_unique(explode(",",$post_category));
  foreach ($post_category_list as $category) {
    $cat_ID =intval($category);
    if ($cat_ID==0) {
      $category = $wpdb->escape($category);
      $cat_ID = wp_insert_category(array('cat_name' => $category));
      $cat_ID = get_category_by_slug($category);
      array_push($post_category_new,$cat_ID ->term_id);
    } else {
      array_push($post_category_new,$cat_ID);
    }
  }
  return $post_category_new;
}

function hm_add_author($post_author)
{
  global $wpdb,$post_author_default;
  $User_ID =intval($post_author);
  if ($User_ID == 0) {
    $pattern = '/[^\x00-\x80]/';
    if (preg_match($pattern,$post_author)) {
      $LoginName = substr(md5($post_author),0,10);
    } else {
      $LoginName =  $post_author;
    }
    $User_ID = $wpdb->get_col("SELECT ID FROM $wpdb->users WHERE user_login = '$LoginName' ORDER BY ID");
    $User_ID = $User_ID[0];
    if (empty($User_ID)) {
      $website = 'http://'.$_SERVER['HTTP_HOST'];
      $userdata = array(
                    'user_login'  =>  "$LoginName",
                    'first_name'	=>	$post_author,
                    'user_nicename'    =>  $post_author,
                    'display_name'    =>  $post_author,
                    'nickname'    =>  $post_author,
                    'user_url'    =>  $website,
                    'role'    =>  'contributor',
                    'user_pass'   =>  NULL);
      $User_ID = wp_insert_user( $userdata );
    }
    $post_author = $User_ID;
  } else {
    $post_author = $post_author_default;
  }
  return $post_author;
}

function hm_strip_slashes($str)
{
  if (get_magic_quotes_gpc()) {
    return stripslashes($str);
  } else {
    return $str;
  }
}
function checkDatetime($str)
{
  $format="Y-m-d H:i";
  $format1="Y-m-d H:i:s";
  $unixTime=strtotime($str);
  $checkDate= date($format, $unixTime);
  $checkDate1= date($format1, $unixTime);
  if ($checkDate==$str or $checkDate1==$str) {
    return true;
  } else {
    return false;
  }
}

function hm_do_save_post($post_detail)
{
  global $post_author,$post_ping,$post_status,$translate_slug,$autoAddCategory,$post_next,$pViews,$tax_input;
  extract($post_detail);
  $post_title=trim(hm_strip_slashes($post_title));
  $post_name=$post_title;
  if ($translate_slug) $post_name=hm_tranlate($post_name);
  $post_name=sanitize_title( $post_name);
  if ( strlen($post_name) < 2 ) $post_name="";
  $post_content=hm_strip_slashes($post_content);
  $tags_input=str_replace("|||",",",$tags_input);
  if (isset($post_date) && $post_date && checkDatetime($post_date)) {
    $tm=strtotime($post_date);
    $time_difference =  absint(get_option('gmt_offset')) * 3600;
    $post_date=date("Y-m-d H:i:s",$tm);
    $post_date_gmt = gmdate('Y-m-d H:i:s', $tm-$time_difference);
  } else {
    $tm=hm_get_post_time($post_next);
    $time_difference = absint(get_option('gmt_offset')) * 3600;
    $post_date=date("Y-m-d H:i:s",$tm);
    $post_date_gmt = gmdate('Y-m-d H:i:s', $tm-$time_difference);
    if ($post_status=='next') $post_status='publish';
  }
  $post_category=hm_add_category($post_category);
  $post_data = compact('post_author', 'post_date', 'post_date_gmt', 'post_content', 'post_title', 'post_category', 'post_status', 'post_excerpt', 'post_name','tags_input');
  $post_data = add_magic_quotes($post_data);
  $postID = wp_insert_post($post_data);
  if (!empty($fujianid)) {
    require_once('./wp-includes/post.php');
    set_post_thumbnail($postID,$fujianid);
  }
  if (!empty($post_meta_list)) {
    $post_meta_array= array_unique(explode("|||",$post_meta_list));
    foreach ($post_meta_array as $ppm) {
      $pp2=explode("$$",$ppm);
      if (!empty($pp2[0])&&!empty($pp2[1])) add_post_meta($postID,$pp2[0],$pp2[1],true);
    }
  }
  if (!empty($pViews) && $pViews) add_post_meta($postID,'views',$pViews,true);
  if (!empty($tax_input)) {
    foreach(array_unique(array_filter($tax_input)) as $key => $value) {
      add_post_meta($postID,$key,$value,true);
    }
  }
  if ($post_ping)  generic_ping();
}

if ($hm_action== "list")
{
  hm_print_catogary_list();
}
elseif($hm_action== "update")
{
  hm_publish_pending_post();
}
elseif($hm_action == "save")
{
  if (isset($secretWord)&&($secretWord!=false)) {
    if (!isset($_GET['secret']) || $_GET['secret'] != $secretWord) {
      die('接口密码错误，请修改配置文件或者修改发布参数，保持两者统一。');
    }
  }
  extract($post);
  if ($post_title=='[标题]'||$post_title=='') die('标题为空');
  if ($post_content=='[内容]'||$post_content=='') die('内容为空');
  if ($post_category=='[分类id]'||$post_category=='') die('分类id为空');
  if ($tag=='[SY_tag]') {
    $tag='';
  }
  if (!isset($post_date) ||strlen($post_date)<8) $post_date=false;
  if (!isset($post_author)) {
    $post_author=$post_author_default;
  } else {
    $post_author=hm_add_author($post_author);
  }
  if (!isset($post_meta_list)) $post_meta_list="";
  /*附件处理*/

  if (!empty($_FILES[fujian0][name])) {
    require_once('./wp-load.php');
    require_once('./wp-admin/includes/file.php');
    require_once('./wp-admin/includes/image.php');
    $i = 0;
    while (isset($_FILES['fujian'.$i])) {
      $fujian[$i] = $_FILES['fujian'.$i];
      $filename = $fujian[$i]['name'];
      $fileHouZ=array_pop(explode(".",$filename));
      //附件保存格式【时间】
      $upFileTime=date("YmdHis");
      //更改上传文件的文件名为时间+随机数+后缀
      $fujian[$i]['name'] = $upFileTime."-".mt_rand(1,100).".".$fileHouZ;
      $uploaded_file = wp_handle_upload($fujian[$i],array('test_form' => false));
      $post_content = str_replace("\'".$filename."\'","\"".$uploaded_file[url]."\"",$post_content);
      $post_content = str_replace($filename,$uploaded_file[url],$post_content);
      if (isset($uploaded_file['error']))wp_die($uploaded_file['error']);
      $file = $uploaded_file['file'];
      $new_file = iconv('GBK','UTF-8',$file);
      $url = iconv('GBK','UTF-8',$uploaded_file['url']);
      $type = $uploaded_file['type'];
      $attachment = array(
                      'guid' => $url,
                      'post_mime_type' => $type,
                      'post_title' => $filename,
                      'post_content' => '',
                      'post_status' => 'inherit'
                    );
      $attach_id = wp_insert_attachment($attachment,$new_file);
      if ($i==0)$fujianid=$attach_id;
      $attach_data = wp_generate_attachment_metadata($attach_id,$file);
      $attach_data['file'] = iconv('GBK','UTF-8',$attach_data['file']);
      foreach ($attach_data['sizes'] as $key => $sizes) {
        $sizes['file'] = iconv('GBK','UTF-8',$sizes['file']);
        $attach_data['sizes'][$key]['file'] = $sizes['file'];
      }
      wp_update_attachment_metadata($attach_id,$attach_data);
      $i++;
    }
  }
  hm_do_save_post(array('post_title'=>$post_title,
                        'post_content'=>$post_content,
                        'post_category'=>$post_category,
                        'tags_input'=>$tag,
                        'post_date'=>$post_date,
                        'post_author'=>$post_author,
                        'post_meta_list'=>$post_meta_list,
                        'fujianid'=>$fujianid));
  echo '发布成功';
}
else
{
  echo '非法操作['.$hm_action.']';
}
?>