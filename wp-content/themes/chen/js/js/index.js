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
		$(this).addClass("on");
		}
	})	


$(".newsInfor").prev().wrap('<div class="pic_1"><div class="p_1"></div></div>');

//手机缩略图
$(".img-M-BOX").each(function(){
	img_url = $(this).find(".m-bg").next().attr("src");
	img_bg = "url("+img_url+")"+" center center no-repeat";
	$(this).css("background",img_bg);
	$(this).find(".m-bg").next().remove();
	});

$(".nav_m .swiper-wrapper a").wrap('<div class="swiper-slide"></div>');