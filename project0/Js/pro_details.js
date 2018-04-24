// JavaScript Document
	
	$(document).ready(function(){
		//点击图片切换
		$(".content .down .picture .foot li img").click(function(){
				var img1 = $(this).attr("src");
				console.log(img1)
				$(".content .down .picture .top img").attr("src",img1).css({"width":"520px","height":"516px"});
				$(this).parent("li").addClass("current").siblings().removeClass("current");
			})
		
		
		
		
		})