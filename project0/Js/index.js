// JavaScript Document

	$(document).ready(function(){
		// 一个li的长度
		var len = $(".content .details ul li").length;
		
		console.log(len);
		// 一个li的宽度
		var wid = $(".content .details ul li").outerWidth(true);
		console.log(wid);

		// 布尔值
		var boolen = true;
		$(".content .details ul").css({"width":len*wid+"px"});	
		//点击右按钮切换图片
		$(".content .details .next").click(function(){  
			if(len>3){
			if(boolen){
				boolen = false;
				$(".content .details ul").animate({"margin-left":-wid + "px"},function(){
					$(".content .details ul li").eq(0).appendTo(".content .details ul")
					$(this).css({"marginLeft":0+"px"})
					boolen = true;
				}); 
			}
		}
		})
		//点击左按钮切换图片
		$(".content .details .prev").click(function(){
			if(len>3){
			if (boolen) {
				boolen = false;
				$(".content .details ul li").eq(len-1).prependTo(".content .details ul");
				$(".content .details ul").css({"marginLeft":-wid+"px"});
				$(".content .details ul").animate({"marginLeft":0+"px"},function(){
					
					boolen = true;
				})
			}
		}
		})
		//产品自动播放
		var set1 = setInterval(function(){
			if(len>3){
				if(boolen){
					boolen = false;
					$(".content .details ul").animate({"margin-left":-wid + "px"},function(){
						$(".content .details ul li").eq(0).appendTo(".content .details ul")
						$(this).css({"marginLeft":0+"px"})
						boolen = true;
					}); 
				}
			}
		},2000)
		//鼠标经过停止播放
		$(".content .details").hover(
			function(){
				clearInterval(set1);
				}
			,function(){
				set1 = setInterval(function(){
			if(len>3){
				if(boolen){
					boolen = false;
					$(".content .details ul").animate({"margin-left":-wid + "px"},function(){
						$(".content .details ul li").eq(0).appendTo(".content .details ul")
						$(this).css({"marginLeft":0+"px"})
						boolen = true;
					}); 
				}
			}
		},2000)
				})
		$(".content .product .prev",".content .product .next").hover(
			function(){
				clearInterval(set1);
				}
			,function(){
				set1 = setInterval(function(){
			if(len>3){
				if(boolen){
					boolen = false;
					$(".content .product ul").animate({"margin-left":-wid + "px"},function(){
						$(".content .product ul li").eq(0).appendTo(".content .product ul")
						$(this).css({"marginLeft":0+"px"})
						boolen = true;
					}); 
				}
			}
		},2000)
			})
		
	
		})