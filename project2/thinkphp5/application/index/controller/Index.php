<?php
	namespace app\index\controller;
	use think\Controller;
	use think\Db;
	use app\index\controller\Base;

	class Index extends Base{
		public function index(){
			parent::_initialize(); // 调用Base设定模板赋值
			return view();
		}
	}

