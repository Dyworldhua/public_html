// JavaScript Document
	
	
	$(document).ready(function(){
		var inp1 = $(".name").val();
		var inp2 = $(".phone").val();
		
			$(".name").focus(function(){
				var inp1 = $(".name").val();
					if(inp1=="姓名："){
						$(".name").val("");
						}
				})
			$(".name").blur(function(){
				var inp1 = $(".name").val();
					if(inp1==""){
						$(".name").val("姓名：")
						}
				})
		
			$(".phone").focus(function(){
				var pho1 = $(".phone").val();
					if(pho1=="电话："){
						$(".phone").val("");
						}
				})
			$(".phone").blur(function(){
				var pho1 = $(".phone").val();
					if(pho1==""){
						$(".phone").val("电话：")
						}
				})
			$("textarea").focus(function(){
					var tex = $(this).val();
					if(tex=="留言框："){
						$(this).val("");
						}
				})
			
			$("textarea").blur(function(){
					var tex = $(this).val();
					if(tex==""){
						$(this).val("留言框：");
						}
				})
			$(".code").focus(function(){
				var cod = $(this).val();
				if(cod=="验证码："){
					$(this).val("")
					}
				})
			$(".code").blur(function(){
				var cod = $(this).val();
				if(cod==""){
					$(this).val("验证码：")
					}
				})
		
		})