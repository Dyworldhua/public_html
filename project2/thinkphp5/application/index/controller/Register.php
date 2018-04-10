<?php
    namespace app\index\Controller;
    use think\Controller;
    use think\Db;
    use app\index\controller\Base;

    class Register extends Base{
        public function register(){
            parent::_initialize(); // 调用Base设定模板赋值
            return view();
        }
        public function in(){
            // 获取前台页面数据，相当于$_POST[]
            $username = input('username');
            $password = input('password');
            $qrpassword = input('qrpassword');
            $phone = input('phone');
            $code = input('code');
            $email = input('email');
            //  将数据存入数组
            $data=array(
                'username' => input('username'),
                'password' => input('password'),
                'phone' => input('phone'),
                'email' => input('email'),
            );
            //  判断数据
            if(empty($username)){
                Alert("用户名不能为空",'-1');
                exit;
            }
            if(empty($password)){
                Alert("密码不能为空",'-1');
                exit;
            }
            if($password !== $qrpassword){
                Alert("密码不一致",'-1');
                exit;
            }
            $pattern_pho = '/^(13|15|17|18)\d{9}$/';
            $int_pho = preg_match($pattern_pho,$phone);
            if($int_pho !== 1){
                Alert("请填写正确的手机号码",'-1');
                exit;
            }
            if(empty($phone)){
                Alert("手机号码不能为空",'-1');
                exit;
            }
            /*
            if(empty($code)){
                Alert("验证码不能为空",'-1');
                exit;
            }
            */
            $pattern_ema = '/^\d{6,}@\w{2,}(\.com|cn)$/';
            $int_ema = preg_match($pattern_ema,$email);
            if($int_ema !== 1){
                Alert("请填写正确格式的邮箱",'-1');
                exit;
            }
            if(empty($email)){
                Alert("邮箱不能为空",'-1');
                exit;
            }
            //  将数据插入数据库中
            $insert = Db::table('user')->insert($data);
            if($insert){
                Alert("注册成功！",url('Login/login'));
            }
        }
    }
        