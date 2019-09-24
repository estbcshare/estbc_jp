		
		
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

		<div class="m-swiper">

			<div class="m-search-box">

				<button class="button-search"></button>

				<input type="text" placeholder="请输入关键字搜索">

			</div>

			<div class="swiper-wrapper">

				<div class="swiper-slide">

					<a href="">

						<img src="<?php bloginfo('template_directory'); ?>/images/m-banner.jpg" alt="">

						<div class="m-swiper-tilt flex-wrap">

							<span>智广阿阇梨教你轻松度化众生2</span>

							<span id="m-year"> <strong>28</strong><span>10</span></span>

						</div>

						<div class="line-m"></div>

					</a>

				</div>

			</div>

		</div>

		<div class="m-section-1">

			<div class="m-title-box flex-wrap" style="margin-top:0;">

				<span class="m-name">一乘显密精选</span>

				<img src="<?php bloginfo('template_directory'); ?>/images/menu.jpg" alt="" class="menu" onclick="showSubnav();">

			</div>

			<div class="m-tab-box clearfix">

				<a href="" class="active">推荐</a>

				<a href="">道次第修行</a>

				<a href="">阿阇梨著述</a>

			</div>

		</div>

		<div class="m-section-2">

			<div class="m-wrap">

				<div class="m-title-box flex-wrap" style="margin-top:0;">

					<span class="m-name">智慧法语</span>

					<img src="<?php bloginfo('template_directory'); ?>/images/yinhao.png" alt="" class="yinhao">

				</div>

				<p class="con-m">

						人的痛苦来自哪里？固执、执着。执着不放就是

						痛苦如果我们知道切诸法都是无常的，真正地看

						到了所有事物的真相都是无常我们就能够接受任

						何的事实。

				</p>

				<div class="flex-wrap zhaizi-boxs">

					<span class="m-zhai">摘自《一生吉祥的三十八个秘诀》</span>

					<span class="m-fabu-date">08-30</span>

				</div>

			</div>

		</div>

		<div class="m-section-3">

			<div class="m-wrap">

				<div class="m-title-box flex-wrap" style="margin-top:0;">

					<span class="m-name">要闻</span>

				</div>

				<ul class="m-news-list">

					<li>

						<a href="">

							<div class="img-M-BOX">

								<img src="<?php bloginfo('template_directory'); ?>/images/m-img.png" alt="">

								<div class="flex m-see-box">

									<img src="<?php bloginfo('template_directory'); ?>/images/m-eye.png" alt="">

									<span>280</span>

								</div>

							</div>

							<div class="m-news-info">

								<p class="m-news-tit">准提法门的弘扬对建设和谐

										社会准提法门</p>

								<div class="flex-wrap m-news-user-info">

									<span>#唐密</span>

									<span class="m-push-date">1天前</span>

								</div>

							</div>

						</a>

					</li>

					<li>

						<a href="">

							<div class="img-M-BOX">

								<img src="<?php bloginfo('template_directory'); ?>/images/m-img.png" alt="">

								<div class="flex m-see-box">

									<img src="<?php bloginfo('template_directory'); ?>/images/m-eye.png" alt="">

									<span>280</span>

								</div>

							</div>

							<div class="m-news-info">

								<p class="m-news-tit">准提法门的弘扬对建设和谐

										社会准提法门</p>

								<div class="flex-wrap m-news-user-info">

									<span>#唐密</span>

									<span class="m-push-date">1天前</span>

								</div>

							</div>

						</a>

					</li>

					<li>

						<a href="">

							<div class="img-M-BOX">

								<img src="<?php bloginfo('template_directory'); ?>/images/m-img.png" alt="">

								<div class="flex m-see-box">

									<img src="<?php bloginfo('template_directory'); ?>/images/m-eye.png" alt="">

									<span>280</span>

								</div>

							</div>

							<div class="m-news-info">

								<p class="m-news-tit">准提法门的弘扬对建设和谐

										社会准提法门</p>

								<div class="flex-wrap m-news-user-info">

									<span>#唐密</span>

									<span class="m-push-date">1天前</span>

								</div>

							</div>

						</a>

					</li>

				</ul>

			</div>

		</div>

		<div class="m-section-3">

			<div class="m-wrap">

				<div class="m-title-box flex-wrap" style="margin-top:0;">

					<span class="m-name">常用场景</span>

				</div>

				<div class="cj-list">

					<a href="" class="active">亲人离世</a>

					<a href="">唐密真言宗</a>

					<a href="">出离心</a>

					<a href="">菩提心</a>

					<a href="">禅定</a>

					<a href="">空性</a>

					<a href="">心经</a>

					<a href="">88番巡礼</a>

					<a href="">财神法</a>

					<a href="">药师道场</a>

					<a href="">清明</a>

					<a href="">天台宗</a>

					<a href="">标签</a>

				</div>

			</div>

		</div>

	</div>

	<div class="m-sub-menu hidden">

		<span class="close" onclick="hideSubnav();"></span>

		<div class="m-menu-top"> 

			<a href="" class="flex m-item">

				<img src="<?php bloginfo('template_directory'); ?>/images/a1.png" alt="" class="a1">

				<span>一乘简介</span>

			</a>

			<a href="" class="flex m-item">

				<img src="<?php bloginfo('template_directory'); ?>/images/a2.png" alt="" class="a2">

				<span>导师简介</span>

			</a>

			<a href="" class="flex m-item">

				<img src="<?php bloginfo('template_directory'); ?>/images/a3.png" alt="" class="a3">

				<span>一乘显密讲修院</span>

			</a>

			<a href="" class="flex m-item">

				<img src="<?php bloginfo('template_directory'); ?>/images/a4.png" alt="" class="a4">

				<span>招贤启事</span>

			</a>

			<a href="" class="flex m-item">

				<img src="<?php bloginfo('template_directory'); ?>/images/a5.png" alt="" class="a5">

				<span>联系我们</span>

			</a>

		</div>

		<div class="m-lan-box">

			<a href="" class="flex m-item">

				<img src="<?php bloginfo('template_directory'); ?>/images/a7.png" alt="" class="a6">

				<span>简体中文版</span>

			</a>

			<a href="" class="flex m-item">

				<img src="<?php bloginfo('template_directory'); ?>/images/a8.png" alt="" class="a7">

				<span>繁体中文版</span>

			</a>

			<a href="" class="flex m-item">

				<img src="<?php bloginfo('template_directory'); ?>/images/a9.png" alt="" class="a8">

				<span>English</span>

			</a>

			<a href="" class="flex m-item">

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



	var swiper2=new Swiper('.swiper-item',{

		pagination:'.span1',

		paginationClickable:true,

		prevButton:".left-btns",

		nextButton:".right-btns"

	})



	$(".nav > li").hover(function (){

		$(this).find(".drop-box").stop().slideToggle();

	})

		$(".nav > li").hover(function (){

		$(this).find(".sub-menu").stop().slideToggle();

	})
	

	$(".lang").hover(function (){

		$(this).find(".lan-lists").stop().slideToggle();

	})

	function gdjz(div,cssname,offset,ele){

		var a,b,c,d;

		d=$(div).offset().top;

		a=eval(d + offset);

		b=$(window).scrollTop(); 

		c=$(window).height();

		console.log(b+c)

		console.log(a)



		if(b+c>a+300){

			$(ele).addClass((cssname));

		}else{

			$(ele).removeClass((cssname));

		}

	}

		

	$(document).ready(function(e) {
		var h_1 = $(".m-section-1").offset().top;
		$(window).scroll(function(){
			
			var targetTop = $(this).scrollTop();
			if (targetTop >= h_1){
			$(".m-section-1").addClass("active");

		}else{
			$(".m-section-1").removeClass("active");
		}


		})

	})

</script>

</html>