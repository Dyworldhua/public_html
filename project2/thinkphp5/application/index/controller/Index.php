<?php
	namespace app\index\controller;
	use think\Controller;
	use think\Db;
	use app\index\controller\Base;

	class Index extends Base{
		public function index(){
			parent::_initialize(); // 调用Base设定模板赋值
			// 首页产品内容分类 新品上市
			$sub_type1 = Db::table('index_sub_type')
			->where('id',1)
			->find();
			$this->assign('subtype1',$sub_type1);

			// 首页产品内容分类 热门推荐
			$sub_type2 = Db::table('index_sub_type')
			->where('id',2)
			->find();
			$this->assign('subtype2',$sub_type2);

			// 首页产品内容分类 爆款产品
			$sub_type3 = Db::table('index_sub_type')
			->where('id',3)
			->find();
			$this->assign('subtype3',$sub_type3);

			// 首页产品内容分类 热门产品
			$sub_type4 = Db::table('index_sub_type')
			->where('id',4)
			->find();
			$this->assign('subtype4',$sub_type4);


			// 取出产品表中属于新品上市的产品
			$new_product = Db::table('product')
			->where('sub_type',1)
			->order('id desc')
			->limit(11)
			->select();
			$this->assign('new_product',$new_product);
			// 取出新品上市广告产品
			$adver_new_product = Db::table('product')
			->where('sub_type',1)
			->where('default_id',1)
			->find();
			$this->assign('adver_product1',$adver_new_product);

			// 取出产品表中属于热门推荐的产品
			$hot_product = Db::table('product')
			->where('sub_type',2)
			->order('id desc')
			->limit(5)
			->select();
			$this->assign('hot_product',$hot_product);
			// 热门推荐广告产品
			$adver_hot_product = Db::table('product')
			->where('sub_type',2)
			->where('default_id',1)
			->find();
			$this->assign('adver_product2',$adver_hot_product);

			// 取出产品表中属于爆款产品的产品
			$sale_product = Db::table('product')
			->where('sub_type',3)
			->order('id desc')
			->limit(11)
			->select();
			$this->assign('sale_product',$sale_product);

			// 取出产品表中属于热门产品的产品
			$door_product = Db::table('product')
			->where('sub_type',4)
			->order('id desc')
			->limit(15)
			->select();
			$this->assign('door_product',$door_product);
			
			return view();
		}
	}

