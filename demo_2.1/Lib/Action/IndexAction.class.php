<?php
// 本文档自动生成，仅供测试运行
class IndexAction extends Action
{
    /**
    +----------------------------------------------------------
    * 默认操作
    +----------------------------------------------------------
    */
    public function index() {
     /*   // $this->display(THINK_PATH.'/Tpl/Autoindex/hello.html');
      $myConnect1 = 'mysql://root:123123@localhost:3306/test1'; 
       $User->addConnect($myConnect1,1);
       $User->switchConnect(1, 'user'); 
       echo $User->getLastSql();
       echo "ddddddddd";
      
  	import('@.Ext.Db');
//$db_dsn = "mysql://root:123123@localhost:3306/test2"; 
$db = new Db($db_dsn);
$db = M("user"); 
$db->query("select * from think_user where status=1");
//Model->db("1","mysql://root:123123@localhost:3306/test2");

//$db = new Db();
//$this->db(1, "mysql://root:123123@localhost:3306/test2")->query("select * from think_user where status=1");

    	//	import('@.Ext.Db');
//echo  $db->findAll();
//$User->select();
//echo $db->getLastSql();
//dump($db);
//db = Db::getInstance();
//$db->addConnect($db_dsn,1); // 添加数据库连接
//$db->switchConnect(1); //切换到连接1   


//双数据库增加数据
$User = M("User1"); // 实例化User1对象
$data['username'] = 'ThinkPHP';
$data['passwd'] = 'ThinkPdm';
echo $User->add($data);

$db_dsn = "mysql://root:123123@localhost:3306/test2";
$db = new Db($db_dsn); //另一个数据的连接
$db = Db::getInstance($db_dsn);
echo $db->execute("INSERT INTO `test2`.`think_user1` (`id` ,`username` ,`passwd`) VALUES ('', 'sdf', 'sss')");


//$User->data($data)->add(); //使用data方法连贯操作

//双数据库删除数据
$User = M("User1"); // 实例化User对象
echo $User->where('id=8')->delete(); 

$db_dsn = "mysql://root:123123@localhost:3306/test2";
$db = new Db($db_dsn); //另一个数据的连接
$db = Db::getInstance($db_dsn);
echo $db->execute("DELETE FROM `test2`.`think_user1` WHERE `think_user1`.`id` = 8");

////双数据库修改数据
$User = M("User1"); // 实例化User对象
$data['username'] = 'Thi111c';
$data['passwd'] = 'Think111c';
echo $User->where('id=7')->save($data); 

$db_dsn = "mysql://root:123123@localhost:3306/test2";
$db = new Db($db_dsn); //另一个数据的连接
$db = Db::getInstance($db_dsn);
echo $db->execute("UPDATE `test2`.`think_user1` SET `username` = 'Thin222c',`passwd` = 'sssc' WHERE `think_user1`.`id` =7");

////双数据库查询数据
$user = M("User");   //默认的数据连接
$list = $user->where('id=1')->find();
echo "ddddddddd<br>";
dump($list);

$db_dsn = "mysql://root:123123@localhost:3306/test2";
$db = new Db($db_dsn); //另一个数据的连接
$db = Db::getInstance($db_dsn);
$aaa = $db->query("select * from think_user where id = 1");  	
dump($aaa);


//Model->db("1","mysql://root:123123@localhost:3306/test2");
//$this->db(1, "mysql://root:123123@localhost:3306/test2")->query("select * from think_user where id = 1");


//import('Think.Db.Db');
//import('Think.Db.Driver.Dbmysql');
$db_dsn = "mysql://root:123123@localhost:3306/test2";
//$db = new Db($db_dsn); //另一个数据的连接
//$db = Db::getInstance($db_dsn);
//$db = M('User','AdvModel');
$db = new Db($db_dsn);
$db = Db::getInstance($db_dsn);
$db->addConnect($db_dsn,1);
$db->switchConnect(1); //切换到连接1
$aaa = $db->query("select * from think_user where id = 1");  	
dump($aaa);

*/
$myConnect1 = 'mysql://root:123123@localhost:3306/test2';
//$obj=new Model("IndexModel");
$obj = M('User','AdvModel');
$obj->addConnect($myConnect1,1);
$obj->switchConnect(0);
$result = $obj->query("select * from think_user where id = 1");  
dump($result);
echo THINK_VERSION;
//此时如果想切换到该数据库下的其他表，可以这样操作。
//$obj->switchConnect(1,"anotherTable");



/*
//$obj = M('think_user','AdvModel');
//$obj = D("think_user");
//$obj->addConnect($myConnect1,1);
//$obj->switchConnect(1);
//$result = $obj->where($where)->select();
//此时如果想切换到该数据库下的其他表，可以这样操作。
//$obj->switchConnect(1,"anotherTable");
$myConnect2 = C("myConnect1");
  $M = D('User','AdvModel');  // D() new Model() 都可以
  $M->addConnect($myConnect2,1);
  $M->switchConnect(1);
echo $myConnect2;
*/
  }

    /**
    +----------------------------------------------------------
    * 探针模式
    +----------------------------------------------------------
    
    public function checkEnv() {
        load('pointer',THINK_PATH.'/Tpl/Autoindex');//载入探针函数
        $env_table = check_env();//根据当前函数获取当前环境
        echo $env_table;
    }*/


    /**
    +----------------------------------------------------------
    * 探针模式
    +----------------------------------------------------------
    */
    public function checkEnv()
    {
        load('pointer',THINK_PATH.'/Tpl/Autoindex');//载入探针函数
        $env_table = check_env();//根据当前函数获取当前环境
        echo $env_table;
    }

}
?>