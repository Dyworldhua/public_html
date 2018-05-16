<?php 
    namespace app\index\controller;
    use think\Controller;
    use app\index\controller\Base;
    use think\Db;
    use think\Session;
    use think\Request;
    class Shopcar extends Base{
        public function shopcar(Request $request){
            
            if($request->isPost())
            {   
                // 判断用户是否登录
                $username = Session::get('username'); // 通过session获取登录用户名    
                if(empty($username)){
                    $info = [
                        'code'=>3,
                        'msg'=>'成功',
                        'point'=>'请先登录',
                        'url'=>url('login/login')
                    ];
                    echo json_encode($info);exit;
                }
                $para = $_POST; // 获取ajax传参数据
                if(!empty($para['pid'])){
                    $id = $para['pid']; // 获取当前产品ID
                    $product = Db::table('product')->where('id',$id)->find(); // 查找当前商品信息
                    // 购物车产品参数
                    $data = [
                        'user_id' => $para['user_id'],
                        'product_id' => $product['id'],
                        'pro_picture' => $product['picture'],
                        'pro_color' => $para['cid'],
                        'pro_height' => $para['hid'],
                        'pro_title' => $product['title'],
                        'pro_type' => $product['type'],
                        'pro_price' => $product['price'],
                        'pro_num' => $para['num']
                    ];
                    $shop_car = Db::table('shop_car')->insert($data); // 将当前产品信息插入数据库中
                    if($shop_car)
                    {
                            
                        // 如果数据插入成功， 返回ajax
                        // 立即购买
                        if($para['mid'] == 0){
                            $info = [
                                'code'=>1,
                                'msg'=>'成功',
                                'url'=>url('shopcar/shopcar')
                            ];
                            echo json_encode($info);exit;
                        }
                        // 加入购物车
                        elseif($para['mid'] == 1){
                            $info = [
                                'code' => 2,
                                'msg' => '成功',
                                'prompt' => '加入成功'
                            ];
                            echo json_encode($info);exit;
                        }
                    }
                    else
                    {
                        echo json_encode(array('code'=>0,'msg'=>'失败'));exit;
                    } 
                }
            }
            else
            {   
                // 判断用户是否登录
                $username = Session::get('username'); // 通过session获取登录用户名 
                if(empty($username)){
                    Alert('请先登录',url('login/login'));
                }
                $shop_car_list = Db::table('shop_car')->select(); // 查询当前购物车产品
                foreach($shop_car_list as $key => $value){
                    $type = Db::table('pro_type')->where('id',$value['pro_type'])->find(); // 查找当前产品类型ID对应的类型
                    $shop_car_list[$key]['type'] = $type['type']; // 将类型赋值给购物车列表
                    $color = Db::table('color')->where('id',$value['pro_color'])->find(); // 查找当前产品颜色ID对应的颜色
                    $shop_car_list[$key]['color'] = $color['color']; // 将颜色赋值给购物车表
                    $height = Db::table('pro_height')->where('id',$value['pro_height'])->find(); // 查找当前产品身高ID对应的身高
                    $shop_car_list[$key]['height'] = $height['height']; // 将身高赋值给购物车表
                }
                $this->assign('product',$shop_car_list); 
                return view();
            }  
           
            $shop_car_list = Db::table('shop_car')->select(); // 查询当前购物车产品
            foreach($shop_car_list as $key => $value){
                $type = Db::table('pro_type')->where('id',$value['pro_type'])->find(); // 查找当前产品类型ID对应的类型
                $shop_car_list[$key]['type'] = $type['type']; // 将类型赋值给购物车列表
            }
            $this->assign('product',$shop_car_list); 
            return view();
        }
        
        // 购物车产品删除
        public function delete(){ 
            $id = $_GET['id']; // 获取当前购物车产品ID
            $delete = Db::table('shop_car')->where('id',$id)->delete(); // 删除当前购物车产品
            if($delete){
                Alert('删除成功',url('shopcar'));
            }
        }
        // 批量删除
        public function datadelete(){ 
            $id = $_POST['del_id']; // 获取当前需要删除的购物车产品ID
            $del_id['id'] = array("in",$id); 
            $delete = Db::table('shop_car')->where($del_id)->delete();
            if($delete){
                $info = [
                    'code'=>1,
                    'msg'=>'成功',
                    'id'=>$id
                ];
                echo json_encode($info);exit;
            }
        }
        
        // 产品结算
        public function settlement(Request $request){ 
            if($request->isPost()){
                if(empty($_POST['pro_id'])){
                    $info = [
                        'code'=>1,
                    ];
                    echo json_encode($info);exit;
                }
                $pro_id = $_POST['pro_id']; // 获取勾选产品ID
                Session::set('pro_id',$pro_id); 
                if($pro_id){
                    $info = [
                        'code'=>2,
                        'url'=>url('shopcar/settlement')
                    ];
                    echo json_encode($info);exit;
                }
            }
            $proid = Session::get('pro_id');
            $shop_list = Db::table('shop_car')->select();
            foreach($shop_list as $key => $value){
                $type = Db::table('pro_type')->where('id',$value['pro_type'])->find(); // 查找当前产品类型ID对应的类型
                $shop_list[$key]['type'] = $type['type']; // 将类型赋值给购物车列表
                $color = Db::table('color')->where('id',$value['pro_color'])->find(); // 查找当前产品颜色ID对应的颜色
                $shop_list[$key]['color'] = $color['color']; // 将颜色赋值给购物车列表
            }
            $user_id = Session::get('id'); // 获取用户ID
            $address = Db::table('address')->where('user_id',$user_id)->select(); // 查找当前用户收货地址
            $this->assign([
                'select_id' => $proid,
                'shop_list' => $shop_list,
                'address' => $address
            ]);
            return view();
        }

        // 支付
        public function pay(Request $request){
            if($request->isPost()){
                $user_id = Session::get('id'); // 获取用户ID
                $car_id = Session::get('pro_id'); // 获取购物车产品ID
                $pro_id['id'] = array("in",$car_id); // 拼接当前购物车产品ID
                $shop_car = Db::table('shop_car')->where($pro_id)->select(); // 查找当前购物车产品对应的产品ID
                $product = []; // 定义一个空数组
                foreach($shop_car as $key => $value){
                    $product[] = $value['product_id']; // 将购物车表中的产品ID赋给定义好的数组中
                }
                $product_id = json_encode($product); 
                $address_id = $_POST['aid']; // 获取地址ID
                $text = empty($_POST['text'])?'无':$_POST['text']; // 获取留言内容
                $number = date('Ymd').rand(10000,99999);
                $data = [
                    'number' => $number,
                    'user_id' => $user_id,
                    'pro_id' => $product_id,
                    'address_id' => $address_id,
                    'text' => $text
                ];
                $settle = Db::table('settle')->insert($data); // 将数据插入订单表中
                if($settle){
                    $info = [
                        'code' => 1
                    ];
                }
                echo json_encode($info);exit;
            }
            $car_id = Session::get('pro_id'); // 获取购物车产品ID
            $pro_id['id'] = array("in",$car_id); // 拼接当前购物车产品ID
            $product_sum = Db::table('settle')->where('user_id',Session::get('id'))->order('id desc')->limit(1)->find(); // 取出订单表中最新的订单数据
            $pro_sum['id'] = array('in',json_decode($product_sum['pro_id'])); // 将订单产品ID拼接
            $price_sum = Db::table('product')->where($pro_sum)->sum('price'); // 计算当前订单总价
            Session::set('price',$price_sum); // 将总价存入Session中
            $delete = Db::table('shop_car')->where($pro_id)->delete(); // 清空购物车对应的结算产品
            // $truncate = Db::execute('TRUNCATE table shop_car');   清空购物车
            $this->assign('price',$price_sum);
            return view();
        }

        public function pay_success(){
            $settle = Db::table('settle')->order('id desc')->limit(1)->find(); // 取出订单表中最新的订单信息
            $address = Db::table('address')->where('user_id',Session::get('id'))->where('id',$settle['address_id'])->find(); // 取出收货地址
            $this->assign([
                'settle' => $settle,
                'address' => $address
            ]);
            return view();
        }
    }