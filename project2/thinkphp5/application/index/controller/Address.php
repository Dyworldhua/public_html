<?php
    namespace app\index\Controller;
    use think\Controller;
    use think\Db;
    use think\Session;
    use app\index\controller\Base;
    use think\Request;

    class Address extends Base{
        public function address(){
            parent::_initialize(); // 调用Base设定模板赋值
            // 将数据库中数据取出
            $address = Db::table('address')->order('id desc')->limit(3)->select();
            // 模板赋值将取出的数据
            $this->assign('address',$address);
            return view();
        }
        public function in(){
            $user_id = Session::get('id'); // 通过Session获取用户ID
            // 获取地址参数
            $name = input('name');
            $phone = input('phone');
            $province = input('province');
            $city = input('city');
            $county = input('county');
            $village = input('village');
            $site = input('site');
            $default_id = empty(input('default'))? 0:input('default');
            
            // 将前台数据存入数组中
            $data = array(
                'user_id' => $user_id,
                'default_id' => $default_id,
                'name' => $name,
                'phone' => $phone,
                'province' => $province,
                'city' => $city,
                'county' => $county,
                'village' => $village,
                'site' => $site,
            );

            // 判断数据
            if(empty($name)){
                Alert("姓名不能为空",'-1');
                exit;
            }
            if(empty($phone)){
                Alert("电话不能为空",'-1');
                exit;
            }
            $pattern = '/^(13|15|17|18)\d{9}$/'; // 判断电话格式是否正确
            $int = preg_match($pattern,$phone);
            if($int !== 1){
                Alert("请填写正确格式电话",'-1');
                exit;
            }
            if(empty($province)){
                Alert("省份不能为空",'-1');
                exit;
            }
            if(empty($city)){
                Alert("城市不能为空",'-1');
                exit;
            }
            if(empty($county)){
                Alert("区/县不能为空",'-1');
                exit;
            }
            if(empty($village)){
                Alert("乡镇/街道不能为空",'-1');
                exit;
            }
            if(empty($site)){
                Alert("详细地址不能为空",'-1');
                exit;
            }

            // 将数据添加到数据库中
            $insert = Db::table('Address')->insert($data);
            if($insert){
                Alert("地址添加成功",url('Address/address'));
            }else{
                Alert("地址添加失败",'-1');
            }
        }

        // 默认地址修改
        public function default_address(Request $request){
            if($request->isPost()){
                $add_id = $_POST['aid']; // 获取当前收货地址ID
                $default_address = Db::table('address')->where('default_id',1)->update(['default_id'=>0]); // 将原有默认地址ID修改为0
                $new_default_address = Db::table('address')->where('id',$add_id)->update(['default_id'=>1]); // 设置新的默认地址
                if($new_default_address){
                    $info = [
                        'code' => 1
                    ];
                    echo json_encode($info);exit;
                }
            }
        }

        //  地址修改
        public function edit(){
            $id = $_GET['id']; // 获取当前地址ID
            $address = Db::table('address')->where('id',$id)->find(); // 查找当前地址
            $this->assign('address',$address);
            return view();
        }
        //地址更新
        public function update(){
            $id = input('id'); // 获取当前地址ID
            $user_id = Session::get('id');
            // 地址参数
            $name = input('name');
            $phone = input('phone');
            $province = input('province');
            $city = input('city');
            $county = input('county');
            $village = input('village');
            $site = input('site');
            $default_id = empty(input('default'))? 0:input('default');
            // 将地址参数存入数组中
            $data = array(
                'user_id' => $user_id,
                'default_id' => $default_id,
                'name' => $name,
                'phone' => $phone,
                'province' => $province,
                'city' => $city,
                'county' => $county,
                'village' => $village,
                'site' => $site,
            );
            // 地址更新
            $update = Db::table('address')->where('id',$id)->update($data);
            if($update){
                Alert('更新成功',url('address'));
            }
        }

        public function delete(){
            $id = $_GET['id']; // 获取当前地址ID
            $delete = Db::table('address')->where('id',$id)->delete(); // 删除当前地址
            if($delete){
                Alert('删除成功','-1');
            }
        }
    }