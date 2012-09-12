<?php
// 本文档自动生成，仅供测试运行
class UserAction extends Action
{
    /**
    +----------------------------------------------------------
    * 默认操作
    +----------------------------------------------------------
    */
    public function index() {
       // $this->display(THINK_PATH.'/Tpl/Autoindex/hello.html');
            //$User = D('user'); 
   //$User = M("user"); 
   // $User->select();
//echo "dsf";
   // echo $User->getLastSql();

    // 输出的SQL语句为 select * from user.think_user 
     $User = M("User");
        // 按照id排序显示前6条记录
        $list = $User->order('id desc')->limit(6)->select();
        echo $User->getLastSql();
        //$this->assign('list', $list);
        //$this->display();
    }
    public function info() {
       // $this->display(THINK_PATH.'/Tpl/Autoindex/hello.html');
            //$User = D('user'); 
   //$User = M("user"); 
   // $User->select();
//echo "dsf";
   // echo $User->getLastSql();

    // 输出的SQL语句为 select * from user.think_user 
     //$Info = M("Info");
         $User = M('Info.user','user'); 
        // 按照id排序显示前6条记录
        //$list = $User->order('id desc')->limit(6)->select();
        echo $Info->getLastSql();
        //$this->assign('list', $list);
        //$this->display();
    }
    /**
    +----------------------------------------------------------
    * 探针模式
    +----------------------------------------------------------
    */
    public function checkEnv() {
        load('pointer',THINK_PATH.'/Tpl/Autoindex');//载入探针函数
        $env_table = check_env();//根据当前函数获取当前环境
        echo $env_table;
    }

}
?>