<?php   
 
//类ClassicOptions   
class ClassicOptions {      
  
    function getOptions() {    
        // 在数据库中获取选项组      
        $options = get_option('viiqi_options');      
        // 如果数据库中不存在该选项组, 设定这些选项的默认值, 并将它们插入数据库      
        if (!is_array($options)) {      
            //初始默认数据 
			$options['logo'] = ''; 
			$options['title'] = '';
			$options['home_description'] = '';
			$options['home_keyword'] = '';
			$options['phone'] = '';
			$options['mobile'] = '';
			$options['email'] = '';
			$options['copyright'] = '';
			$options['ico'] = '';


		
			$options['add1'] = '';
			$options['add2'] = '';
			$options['add3'] = '';
			$options['add4'] = '';
			$options['add5']= '';
			$options['add6'] = '';
			$options['add7'] = '';
			$options['add8']= '';
			
			$options['add9'] = '';
			$options['add10'] = '';
			$options['add11'] = '';
			$options['add12']= '';
			$options['add13'] = '';
			$options['add14'] = '';
			$options['add15']= '';
			

               
            //这里可添加更多设置选项   
               
            update_option('viiqi_options', $options);      
        }   
        // 返回选项组   
        return $options;   
    }   
    /* -- init函数 初始化 -- */     
    function init() {      
  
        if(isset($_POST['save_option'])) {      
      
            $options = ClassicOptions::getOptions();      
            // 数据处理         
            $options['logo'] =stripslashes($_POST['logo']);
			$options['title'] =stripslashes($_POST['title']);
			$options['home_keyword'] =stripslashes($_POST['home_keyword']);
			$options['phone'] =stripslashes($_POST['phone']);
			$options['mobile'] =stripslashes($_POST['mobile']);
			$options['email'] =stripslashes($_POST['email']);
			$options['copyright'] =stripslashes($_POST['copyright']);
					$options['ico'] =stripslashes($_POST['ico']);

			$options['home_description'] =stripslashes($_POST['home_description']);
			$options['add1'] =stripslashes($_POST['add1']);
			$options['add2'] =stripslashes($_POST['add2']);
			$options['add3'] =stripslashes($_POST['add3']);
			$options['add4'] =stripslashes($_POST['add4']);
			$options['add5'] =stripslashes($_POST['add5']);
			$options['add6'] =stripslashes($_POST['add6']);
			$options['add7'] =stripslashes($_POST['add7']);
			$options['add8'] =stripslashes($_POST['add8']);

			$options['add9'] =stripslashes($_POST['add9']);
			$options['add10'] =stripslashes($_POST['add10']);
			$options['add11'] =stripslashes($_POST['add11']);
			$options['add12'] =stripslashes($_POST['add12']);
			$options['add13'] =stripslashes($_POST['add13']);
			$options['add14'] =stripslashes($_POST['add14']);
			$options['add15'] =stripslashes($_POST['add15']);			
			
            //在这追加其他选项的限制处理      
               
            update_option('viiqi_options', $options);      
           
        } else {   
              
            ClassicOptions::getOptions();      
        }   
 
        add_menu_page("网站设置", "网站设置", 'edit_themes', "option_set", array('ClassicOptions', 'Class_display')); //添加后台菜单     
		 add_submenu_page( "option_set", '网站设置教程', '网站帮助', 'edit_themes', 'help-submenu-page', array('ClassicOptions', 'help_page_display')); 
    }      
    /* -- 标签页 -- */   
     function help_page_display()
	 { ?>
	 <div class="exlist">
	   <h2>网站使用帮助</h2>
	   <?php include(get_template_directory().'/help.php');?>
	   </div>
	 <?php }
    function Class_display() { 
	//加载upload.js文件
        wp_enqueue_script('my-upload', get_bloginfo( 'stylesheet_directory' ) . '/option/upload.js'); 
		wp_enqueue_style( 'viiqiadmin',  get_bloginfo( 'stylesheet_directory' ) . '/option/option.css' ); 
        //加载上传图片的js(wp自带)   
        wp_enqueue_script('thickbox');
        //加载css(wp自带)   
        wp_enqueue_style('thickbox');
	$options = ClassicOptions::getOptions();?>
	 <form method="post" enctype="multipart/form-data" name="classic_form" id="classic_form">   

      <div id="icon-options-general" class="icon32"><br>
      </div>
    <!--diy-->
        <div id="option_wrap" class="box">
  <div  class="left manu_wraper">
    <div id="logo" style="margin:60px 0px 20px;"> <img src="<?php if($options["logo"]){echo $options["logo"];}else{echo get_bloginfo("template_url")."/images/logo.png";}?>" width="163" height="87"/></div>
    <ul>
      <li id="option-list" class="base">基础设置</li>
      <li id="option-list" class="add">首页设置</li>
       <li id="option-list" class="add1">右侧客服设置</li>

    </ul>
  </div>
  <div  class="left content_wraper">
    <div class="content_wraper-top box">
      <div class="center">
        <p class="comp-name"><a href="http://www.518theme.com/" target="_blank">518主题巴士</a></p>
        <p class="shuoming">该主题由518主题巴士提供技术支持(网站内容由客户自行决定)，版权归企业所有(付费客户)，但是不得二次转售，否则有权取消系统免费更新和升级资格！</p>
        <p class="shuoming">当前版本v1.0（wordpress学习分享群(314756272):<a target="_blank" href="http://jq.qq.com/?_wv=1027&k=kmc0T1"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="wordpress学习交流" title="wordpress学习交流"></a>）</p>
      </div>
    </div>
	<ul id="option-content-box">
	<!--第一块-->
	<li id="option-content" class="content-base">
	<p class="option-content-big-title">基础设置</p>
	<p class="option-title">logo 设置</p>
	<p><input name="logo" id="logo" value="<?php echo $options['logo'];?>" type="text" size="50"> <input type="button" name="upload_button" value="上传" class="upbottom button button-primary"/></p>
	<p class="option-title">ICO 设置</p>
	<p><input name="ico" id="logo" value="<?php echo $options['ico'];?>" type="text" size="50"> <input type="button" name="upload_button" value="上传" class="upbottom button button-primary"/></p>		
<p class="option-title">首页标题 设置</p>
<p><input name="title" id="keyword" value="<?php echo $options['title'];?>" type="text" size="70"> </p>
	<p class="option-title">首页关键词 设置</p>
<p><input name="home_keyword" id="keyword" value="<?php echo $options['home_keyword'];?>" type="text" size="70"> </p>
<p class="option-title">首页描述 设置</p>
<p><textarea name="home_description" rows="3" cols="50" id="blacklist_keys" class="large-text code" innerHTML=""><?php echo $options['home_description'];?></textarea></p>
<p class="option-title">网站版权和统计代码添加</p>
<p><textarea name="copyright" rows="3" cols="50" id="blacklist_keys" class="large-text code" innerHTML=""><?php echo $options['copyright'];?></textarea></p>

	</li>
	<!--基础设置 end-->
	<li id="option-content" class="content-add">
	<p class="option-content-big-title">首页基础设置</p>

    <p><label>公司图片上传</label></p>
	<p><input name="add11" id="logo" value="<?php echo $options['add11'];?>" type="text" size="50"> <input type="button" name="upload_button" value="上传" class="upbottom button button-primary"/></p>
    <p><label>公司介绍</label></p>
<p><textarea name="add12" rows="12" cols="50" id="blacklist_keys" class="large-text code" innerHTML=""><?php echo $options['add12'];?></textarea></p>
    <p><label>公司介绍详情链接</label></p>
<p><textarea name="add13" rows="1" cols="50" id="blacklist_keys" class="large-text code" innerHTML=""><?php echo $options['add13'];?></textarea></p>
    <p><label>联系人</label></p>
<p><textarea name="add1" rows="2" cols="20" id="blacklist_keys" class="large-text code" innerHTML=""><?php echo $options['add1'];?></textarea></p>
    <p><label>手机</label></p>
<p><textarea name="add2" rows="2" cols="50" id="blacklist_keys" class="large-text code" innerHTML=""><?php echo $options['add2'];?></textarea></p>
    <p><label>电话</label></p>
<p><textarea name="add3" rows="2" cols="50" id="blacklist_keys" class="large-text code" innerHTML=""><?php echo $options['add3'];?></textarea></p>
    <p><label>邮箱</label></p>
<p><textarea name="add4" rows="2" cols="50" id="blacklist_keys" class="large-text code" innerHTML=""><?php echo $options['add4'];?></textarea></p>
    <p><label>地址</label></p>
<p><textarea name="add5" rows="2" cols="50" id="blacklist_keys" class="large-text code" innerHTML=""><?php echo $options['add5'];?></textarea></p>
	</li>
	<!--广告设置 end-->
	
	<li id="option-content" class="content-add1">
	<p class="option-content-big-title">右侧客服系统</p>

    <p><label>售前客服</label></p>
<p><textarea name="add9" rows="2" cols="20" id="blacklist_keys" class="large-text code" innerHTML=""><?php echo $options['add9'];?></textarea></p>
    <p><label>售后客服</label></p>
<p><textarea name="add10" rows="2" cols="50" id="blacklist_keys" class="large-text code" innerHTML=""><?php echo $options['add10'];?></textarea></p>
<p class="option-title">微信二维码上传</p>
    <p><input name="add15" id="add15" value="<?php echo $options['add15'];?>" type="text" size="50"> <input type="button" name="upload_button" value="上传" class="upbottom button button-primary"/></p>

	</li>
	<!--广告设置 end-->
	<!--基础设置 end-->
	 <p class="submit">
          <input type="submit" name="save_option" id="submit" class="button button-primary" value="保存更改">
        </p>
	</ul>
  </div>
</div>
        <!--diy end-->
	   
      </form>

    <div class="clear"></div>

  <!-- wpbody-content -->
  <div class="clear"></div>

  
 <!--html 结束-->   
         
<?php      
    }      
}    
    
/*初始化，执行ClassicOptions类的init函数*/     
add_action('admin_menu', array('ClassicOptions', 'init'));    


?>