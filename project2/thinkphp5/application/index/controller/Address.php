<?php
    namespace app\index\Controller;
    use think\Controller;
    use think\Db;
    use app\index\controller\Base;

    class Address extends Base{
        public function address(){
            parent::_initialize(); // 调用Base设定模板赋值
            // 将数据库中数据取出
            $address = Db::table('address')->order('id desc')->limit(2)->select();
            // 模板赋值将取出的数据
            $this->assign('address',$address);
            return view();
        }
        public function in(){

            // 获取前台数据
            $name = input('name');
            $phone = input('phone');
            $province = input('province');
            $city = input('city');
            $county = input('county');
            $village = input('village');
            $site = input('site');
            
            // 将前台数据存入数组中
            $data = array(
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
    }