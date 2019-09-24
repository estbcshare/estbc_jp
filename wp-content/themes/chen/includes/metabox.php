<?php      

//自定义面板类的实例化      

/**********title*************/     

$options = array();      

//page参数为在页面和文章中都添加面板 ，可以添加自定义文章类型   

//context参数为面板在后台的位置，比如side则显示在侧栏      

$boxinfo = array('title' => '产品信息', 'id'=>'ashubox', 'page'=>array('','post'), 'context'=>'normal', 'priority'=>'low', 'callback'=>'');  
    
$options[] = array(      

            "name" => "产品介绍：",      

            "desc" => "",      

            "id" => "intro",      

            "size"=>"80",      

            "std" => "",      

            "type" => "tinymce"     

            ); 
$options[] = array(      

            "name" => "缩略图1：",      

            "desc" => "",      

            "id" => "img1",      

            "size"=>"60",      

            "std" => "",      

            "type" => "media"     

            ); 

$options[] = array(      

            "name" => "缩略图2：",      

            "desc" => "",      

            "id" => "img2",      

            "size"=>"60",      

            "std" => "",      

            "type" => "media"     

            ); 

$options[] = array(      

            "name" => "缩略图3：",      

            "desc" => "",      

            "id" => "img3",      

            "size"=>"60",      

            "std" => "",      

            "type" => "media"     

            ); 
$options[] = array(      

            "name" => "缩略图4：",      

            "desc" => "",      

            "id" => "img4",      

            "size"=>"60",      

            "std" => "",      

            "type" => "media"     

            ); 

$new_box = new ashu_meta_box($options, $boxinfo);      

?>