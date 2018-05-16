<?php 
    namespace app\index\Controller;
    use think\Controller;
    use think\Db;
    use app\index\controller\Base;
    class Prolist extends Base{
        public function pro_list(){
            parent::_initialize(); // 继承Base控制器
            $type_id = isset($_GET['type_id'])?$_GET['type_id']:1; // 获取当前产品类型ID，如果没有选择则默认为1
            $sex_id = isset($_GET['sex_id'])?$_GET['sex_id']:1; // 获取当前性别类型ID，如果没有选择则默认为1
            $age_id = isset($_GET['age_id'])?$_GET['age_id']:1; // 获取当前热点类型ID，如果没有选择则默认为1
            $hot_id = isset($_GET['hot_id'])?$_GET['hot_id']:1; // 获取当前热点类型ID，如果没有选择则默认为1
            $season_id = isset($_GET['season_id'])?$_GET['season_id']:1; // 获取当前季节类型ID，如果没有选择则默认为1
            $thick_id = isset($_GET['thick_id'])?$_GET['thick_id']:1; // 获取当前厚薄类型ID，如果没有选择则默认为1
            $this->assign([
                'type_id' => $type_id,
                'sex_id' => $sex_id,
                'age_id' => $age_id,
                'hot_id' => $hot_id,
                'season_id' => $season_id,
                'thick_id' => $thick_id
            ]);
            
            $page_all = Db::table('product')->count(); // 获取数据总条数
            $page_max = ceil($page_all/20); // 获取最大页数
            $this->assign('page_max',$page_max);
            if(isset($_POST['page_num'])){  // 判断页数输入框是否有输入值
                $current_page = input('page_num');
            }elseif(isset($_GET['page'])){  // 如果页数输入框没有输入值，则判断是否有选择页数
                $current_page = $_GET['page'];
            }else{
                $current_page = 1; // 如果页数输入框为空且没有选择页数，则默认输出为第一页
            }
            $this->assign('current_page',$current_page);
            $offset = ($current_page-1)*20;

            if(empty($_GET['sub']) or $_GET['sub']==1){  // 当产品列表次级分类选择综合时，则以ID倒序作为排列顺序
                // 查找类型表中与当前类型相匹配的数据
                $product = Db::table('product') 
                ->where('type',$type_id)
                ->where('sex',$sex_id)
                ->where('age',$age_id)
                ->where('hot',$hot_id)
                ->where('season',$season_id)
                ->where('thickness',$thick_id)
                ->order('id desc')
                ->limit($offset,20)
                ->select();
            }elseif($_GET['sub']==2){ // 当产品列表次级分类选择热销时，则以销量倒序作为排列顺序
                $product = Db::table('product') 
                ->where('type',$type_id)
                ->where('sex',$sex_id)
                ->where('age',$age_id)
                ->where('hot',$hot_id)
                ->where('season',$season_id)
                ->where('thickness',$thick_id)
                ->order('sale desc')
                ->limit($offset,20)
                ->select();
            }elseif($_GET['sub']==3){ // 当产品列表次级分类选择新品时，则以发布倒序作为排列顺序
                $product = Db::table('product') 
                ->where('type',$type_id)
                ->where('sex',$sex_id)
                ->where('age',$age_id)
                ->where('hot',$hot_id)
                ->where('season',$season_id)
                ->where('thickness',$thick_id)
                ->order('id desc')
                ->limit($offset,20)
                ->select();
            }elseif($_GET['sub']==4){ // 当产品列表次级分类选择价格时，则以价格倒序作为排列顺序
                $product = Db::table('product') 
                ->where('type',$type_id)
                ->where('sex',$sex_id)
                ->where('age',$age_id)
                ->where('hot',$hot_id)
                ->where('season',$season_id)
                ->where('thickness',$thick_id)
                ->order('price desc')
                ->limit($offset,20)
                ->select();
            }
            $this->assign('product',$product);
            return view();
        }
        
    }   