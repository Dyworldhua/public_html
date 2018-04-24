// JavaScript Document

	$(document).ready(function(){
		
		//设置初始值
		$(".slider .banner li").eq(0).show().siblings().hide();
		$(".slider .point li").eq(0).addClass("current").siblings().removeClass("current");
		var len = $(".slider .banner>ul li").length;
		var a = 0;
		
		
		
		//自动播放
		var set1 = setInterval(function(){
			a++
				if(a>=len){
						a = 0;
					}
					$(".slider .banner li").eq(a).fadeIn().siblings().fadeOut();
					$(".slider .point li").eq(a).addClass("current").siblings().removeClass("current");
			},2000)
		
		
		//鼠标经过停止播放
		$(".slider").hover(
		function(){
			clearInterval(set1)
			}
		,function(){
			set1 = setInterval(function(){
			a++
				if(a>=len){
						a = 0;
					}
					$(".slider .banner li").eq(a).fadeIn().siblings().fadeOut();
					$(".slider .point li").eq(a).addClass("current").siblings().removeClass("current");
			},2000)
			})
		
		
		//轮播点切换
		$(".slider .banner .point li").click(function(){
				var num = $(this).index();
				$(".slider .banner li").eq(num).fadeIn().siblings().fadeOut();
				$(".slider .point li").eq(num).addClass("current").siblings().removeClass("current");
				return a = num;	
			})
		
	})
		
		