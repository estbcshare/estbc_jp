function showSubnav() {
	$(this).addClass('open');
	$('.m-sub-menu').addClass('left');
	$('.m-box').addClass('left');
}
function hideSubnav() {
	$('.m-sub-menu').removeClass('left');
	$('.m-box').removeClass('left');
}
    $(".m-tab-box").before('<div class="nav_m"><div class="swiper-container"><div class="swiper-wrapper"></div></div></div>');
	$(".nav_m .swiper-wrapper").html($(".m-tab-box").html());
	$(".m-tab-box").remove();
	$(".nav_m .swiper-container li a").unwrap();
	$(".nav_m .swiper-wrapper a").wrap('<div class="swiper-slide"></div>');

var myNav = new Swiper('.nav_m .swiper-container', {
            spaceBetween: 10,
            slidesPerView : 3,
            watchSlidesProgress : true,
            watchSlidesVisibility : true,
            on:{
                tap: function(){
                    myPage.slideTo( myNav.clickedIndex)
                }
            }
        })
var title = $("title").text();
$(".nav_m .swiper-slide").each(function(){
	if(title.indexOf($(this).text())!==-1)
	{
		$(".nav_m .swiper-slide:eq(0)").before($(this));
		$(this).addClass("on");
		$(this).siblings().removeClass("on");
		}
		$(".nav_m .swiper-slide:eq(0)").addClass("on");
	})	


$(".newsInfor").prev().wrap('<div class="pic_1"><div class="p_1"></div></div>');

//PC缩略图
$(".news-lists li").each(function(){
	img_url_1 = $(this).find(".pic_1").find("img").attr("src");
	img_bg_1 = "url("+img_url_1+")"+" center/auto 100% no-repeat border-box border-box";
	$(this).find(".pic_1").css("background",img_bg_1);
	$(this).find(".pic_1").find("img").remove();
	});
//手机缩略图
$(".img-M-BOX").each(function(){
	img_url = $(this).find(".m-bg").next().attr("src");
	img_bg = "url("+img_url+")"+" center/auto 100% no-repeat border-box border-box";
	$(this).css("background",img_bg);
	$(this).find(".m-bg").next().remove();
	});

$(".nav_m .swiper-wrapper a").wrap('<div class="swiper-slide"></div>');
$(".title-box-swiper .wrap").before('<div class="bg_11"></div>');

$(".news-lists li").each(function(){
	$(this).find(".icon-item").parent().wrapInner('<div class="tags"></div');
	var html_1 = $(this).find(".icon-item");
	$(this).find(".tags").after(html_1);
	});