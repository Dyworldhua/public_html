<?php
	// 创建一个 admin 模块的控制器
	// 给你的控制器类，起一个命名空间
	namespace app\index\controller;
	use think\Controller;
	use think\Db;
	use app\index\controller\Base; 
	
	class Login extends Base{
		public function login() {
			parent::_initialize(); // 调用Base设定模板赋值
			return view();
		}
		public function in(){
			$username = input('username');
			$pwd = input('password');
			if(empty($username)){
				Alert("请输入用户名",'-1');
				exit;
			}
			if(empty($pwd)){
				Alert("请输入密码",'-1');
				exit;
			}
			$user_result = Db::table('user')->where('username',$username)->find();
			if($user_result){
				// var_dump($user_result);
				if($pwd == $user_result['password']){
					Alert("登录成功",url('User/user'));
				}else{
					Alert("密码错误！",'-1');
				}
			}else{
				Alert("用户名错误！",'-1');
			}
		}
	}