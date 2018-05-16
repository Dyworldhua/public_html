<?php
	// 创建一个 admin 模块的控制器
	// 给你的控制器类，起一个命名空间
	namespace app\index\controller;
	use think\Controller;
	use think\Db;
	use think\Session;
	use app\index\controller\Base; 
	
	class Login extends Base{
		public function login() {
			parent::_initialize(); // 调用Base设定模板赋值
			return view();
		}
		public function in(){
			$username = input('username'); // 获取当前用户名
			$pwd = input('password'); // 获取当前密码
			if(empty($username)){
				Alert("请输入用户名",'-1');
				exit;
			}
			if(empty($pwd)){
				Alert("请输入密码",'-1');
				exit;
			}
			$user_result = Db::table('user')->where('username',$username)->find(); // 通过当前用户名查询数据库中的用户名是否匹配
			if($user_result){  // 如果匹配则验证密码，错误返回用户名错误
				
				if($pwd == $user_result['password']){  // 查找数据库中用户名对应的密码是否匹配
					Alert("登录成功",'-2');
					Session::set('username',$username); // 将用户名存入Session中
					Session::set('id',$user_result['id']); // 将用户ID存入Session中
				}else{
					Alert("密码错误！",'-1');
				}
			}else{
				Alert("用户名错误！",'-1');
			}
		}
	}